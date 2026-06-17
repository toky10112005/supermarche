<?php

namespace App\Controllers;

use App\Models\CaisseModel;
use App\Models\ProduitModel;
use App\Models\AchatModel;
use App\Models\UtilisateurModel;

class CaisseController extends BaseController
{
    public function login()
    {
        $session = session();
        if ($session->get('utilisateur')) {
            return redirect()->to('/');
        }
        return view('login');
    }

    public function doLogin()
    {
        $username = $this->request->getPost('nom_utilisateur');
        $password = $this->request->getPost('mot_de_passe');

        if (empty($username) || empty($password)) {
            return redirect()->to('/login')->with('error', 'Veuillez remplir tous les champs.');
        }

        $model = new UtilisateurModel();
        $user  = $model->authenticate($username, $password);

        if (!$user) {
            return redirect()->to('/login')->with('error', 'Nom d\'utilisateur ou mot de passe incorrect.');
        }

        session()->set('utilisateur', $user);
        return redirect()->to('/');
    }

    public function index()
    {
        $session = session();
        if (!$session->get('utilisateur')) {
            return redirect()->to('/login');
        }

        $model   = new CaisseModel();
        $caisses = $model->getAllCaisses();

        return view('accueil', ['caisses' => $caisses]);
    }

    public function selectCaisse()
    {
        $session  = session();
        if (!$session->get('utilisateur')) {
            return redirect()->to('/login');
        }

        $idCaisse = (int) $this->request->getPost('id_caisse');

        if ($idCaisse <= 0) {
            return redirect()->to('/')->with('error', 'Veuillez sélectionner une caisse.');
        }

        $model  = new CaisseModel();
        $caisse = $model->find($idCaisse);

        if (!$caisse) {
            return redirect()->to('/')->with('error', 'Caisse introuvable.');
        }

        $session->set('caisse', $caisse);
        return redirect()->to('/achats');
    }

    public function achats()
    {
        $session = session();
        if (!$session->get('utilisateur')) {
            return redirect()->to('/login');
        }

        $caisse = $session->get('caisse');
        if (!$caisse) {
            return redirect()->to('/');
        }

        $produitModel = new ProduitModel();
        $achatModel   = new AchatModel();

        $produits = $produitModel->getAllProduits();
        $achats   = $achatModel->getAchatsByCaisse((int) $caisse['id_caisse']);

        $totalGeneral = array_sum(array_column($achats, 'total'));

        return view('achats', [
            'caisse'       => $caisse,
            'produits'     => $produits,
            'achats'       => $achats,
            'totalGeneral' => $totalGeneral,
        ]);
    }

    public function addAchat()
    {
        $session = session();
        if (!$session->get('utilisateur')) {
            return redirect()->to('/login');
        }

        $caisse = $session->get('caisse');
        if (!$caisse) {
            return redirect()->to('/');
        }

        $idProduit = (int) $this->request->getPost('id_produit');
        $quantite  = (int) $this->request->getPost('quantite');

        if ($idProduit <= 0 || $quantite <= 0) {
            return redirect()->to('/achats')->with('error', 'Produit ou quantité invalide.');
        }

        $produitModel = new ProduitModel();
        $produit      = $produitModel->find($idProduit);

        if (!$produit) {
            return redirect()->to('/achats')->with('error', 'Produit introuvable.');
        }

        if ($quantite > $produit['quantite_stock']) {
            return redirect()->to('/achats')->with('error', 'Stock insuffisant. Disponible : ' . $produit['quantite_stock']);
        }

        $achatModel = new AchatModel();
        $achatModel->insert([
            'id_produit' => $idProduit,
            'id_caisse'  => (int) $caisse['id_caisse'],
            'quantite'   => $quantite,
            'date_achat' => date('Y-m-d H:i:s'),
        ]);

        $produitModel->update($idProduit, [
            'quantite_stock' => $produit['quantite_stock'] - $quantite,
        ]);

        return redirect()->to('/achats')->with('success', 'Achat enregistré avec succès.');
    }

    public function cloturerAchat()
    {
        $session = session();
        if (!$session->get('utilisateur')) {
            return redirect()->to('/login');
        }

        $caisse = $session->get('caisse');
        if (!$caisse) {
            return redirect()->to('/');
        }

        $achatModel = new AchatModel();
        $achatModel->cloturerAchatsByCaisse((int) $caisse['id_caisse']);

        return redirect()->to('/achats')->with('success', 'Achat clôturé. Prêt pour le prochain client.');
    }

    public function logout()
    {
        session()->remove('caisse');
        return redirect()->to('/');
    }

    public function fullLogout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
