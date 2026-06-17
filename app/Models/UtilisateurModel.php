<?php

namespace App\Models;

use CodeIgniter\Model;

class UtilisateurModel extends Model
{
    protected $table      = 'utilisateur';
    protected $primaryKey = 'id_utilisateur';
    protected $allowedFields = ['nom_utilisateur', 'mot_de_passe'];
    protected $returnType = 'array';

    public function authenticate(string $username, string $password): ?array
    {
        return $this->where('nom_utilisateur', $username)
                    ->where('mot_de_passe', $password)
                    ->first();
    }
}
