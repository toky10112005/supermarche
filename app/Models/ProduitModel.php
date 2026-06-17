<?php

namespace App\Models;

use CodeIgniter\Model;

class ProduitModel extends Model
{
    protected $table      = 'produit';
    protected $primaryKey = 'id_produit';
    protected $allowedFields = ['designation', 'prix', 'quantite_stock'];
    protected $returnType = 'array';

    public function getAllProduits(): array
    {
        return $this->findAll();
    }
}
