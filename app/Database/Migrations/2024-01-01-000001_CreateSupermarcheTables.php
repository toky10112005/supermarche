<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSupermarcheTables extends Migration
{
    public function up(): void
    {
        // Table produit
        $this->forge->addField([
            'id_produit'     => ['type' => 'INTEGER', 'auto_increment' => true],
            'designation'    => ['type' => 'TEXT', 'null' => false],
            'prix'           => ['type' => 'REAL', 'null' => false],
            'quantite_stock' => ['type' => 'INTEGER', 'null' => false],
        ]);
        $this->forge->addPrimaryKey('id_produit');
        $this->forge->createTable('produit', true);

        // Table caisse
        $this->forge->addField([
            'id_caisse'     => ['type' => 'INTEGER', 'auto_increment' => true],
            'numero_caisse' => ['type' => 'TEXT', 'null' => false],
            'caissier'      => ['type' => 'TEXT', 'null' => true],
        ]);
        $this->forge->addPrimaryKey('id_caisse');
        $this->forge->createTable('caisse', true);

        // Table achat
        $this->forge->addField([
            'id_achat'   => ['type' => 'INTEGER', 'auto_increment' => true],
            'id_produit' => ['type' => 'INTEGER', 'null' => false],
            'id_caisse'  => ['type' => 'INTEGER', 'null' => false],
            'quantite'   => ['type' => 'INTEGER', 'null' => false],
            'date_achat' => ['type' => 'DATETIME', 'null' => true, 'default' => 'CURRENT_TIMESTAMP'],
        ]);
        $this->forge->addPrimaryKey('id_achat');
        $this->forge->createTable('achat', true);
    }

    public function down(): void
    {
        $this->forge->dropTable('achat', true);
        $this->forge->dropTable('caisse', true);
        $this->forge->dropTable('produit', true);
    }
}
