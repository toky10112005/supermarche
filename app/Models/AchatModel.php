<?php

namespace App\Models;

use CodeIgniter\Model;

class AchatModel extends Model
{
    protected $table      = 'achat';
    protected $primaryKey = 'id_achat';
    protected $allowedFields = ['id_produit', 'id_caisse', 'quantite', 'date_achat', 'cloture'];
    protected $returnType = 'array';

    public function getAchatsByCaisse(int $idCaisse): array
    {
        return $this->db->table('achat a')
            ->select('a.id_achat, p.designation, p.prix, a.quantite, (p.prix * a.quantite) AS total, a.date_achat')
            ->join('produit p', 'p.id_produit = a.id_produit')
            ->where('a.id_caisse', $idCaisse)
            ->where('a.cloture', 0)
            ->orderBy('a.date_achat', 'DESC')
            ->get()
            ->getResultArray();
    }

    public function cloturerAchatsByCaisse(int $idCaisse): void
    {
        $this->db->table('achat')
            ->where('id_caisse', $idCaisse)
            ->where('cloture', 0)
            ->update(['cloture' => 1]);
    }
}
