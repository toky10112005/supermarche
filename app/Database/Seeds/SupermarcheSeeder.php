<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SupermarcheSeeder extends Seeder
{
    public function run(): void
    {
        // Produits
        $produits = [
            ['designation' => 'Riz 1kg',   'prix' => 3500, 'quantite_stock' => 100],
            ['designation' => 'Huile 1L',  'prix' => 8000, 'quantite_stock' => 50],
            ['designation' => 'Sucre 1kg', 'prix' => 4200, 'quantite_stock' => 80],
            ['designation' => 'Savon',     'prix' => 1500, 'quantite_stock' => 120],
            ['designation' => 'Lait 1L',   'prix' => 4500, 'quantite_stock' => 60],
        ];

        foreach ($produits as $p) {
            $this->db->table('produit')->insert($p);
        }

        // Caisses
        $caisses = [
            ['numero_caisse' => 'Caisse 1', 'caissier' => 'Jean'],
            ['numero_caisse' => 'Caisse 2', 'caissier' => 'Marie'],
            ['numero_caisse' => 'Caisse 3', 'caissier' => 'Paul'],
        ];

        foreach ($caisses as $c) {
            $this->db->table('caisse')->insert($c);
        }
    }
}
