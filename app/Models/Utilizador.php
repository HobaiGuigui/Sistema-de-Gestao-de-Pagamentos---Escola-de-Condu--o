<?php

namespace App\Models;

use App\Core\Database;

class Utilizador
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Login por email
    public function login($email, $senha)
    {
        $this->db->query('SELECT * FROM utilizadores WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        if ($row) {
            $storedPassword = (string) $row->senha_hash;
            if ((string) $senha === $storedPassword) {
                return $row;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    // Buscar utilizador por ID
    public function getUtilizadorById($id)
    {
        $this->db->query('SELECT * FROM utilizadores WHERE id = :id');
        $this->db->bind(':id', $id);

        $row = $this->db->single();

        return $row;
    }
}
