<?php

namespace App\Models;

use App\Core\Database;
use PDOException;

class Categoria
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Listar todas as categoriasativas
    public function getCategorias()
    {
        $this->db->query('SELECT * FROM categorias_cursos ORDER BY nome_categoria ASC');
        return $this->db->resultSet();
    }

    // Adicionar categoria
    public function addCategoria($data)
    {
        $this->db->query('INSERT INTO categorias_cursos (nome_categoria, preco_total, descricao, duracao_meses) VALUES (:nome, :preco, :descricao, :duracao)');
        $this->db->bind(':nome', $data['nome']);
        $this->db->bind(':preco', $data['preco']);
        $this->db->bind(':descricao', $data['descricao']);
        $this->db->bind(':duracao', $data['duracao']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Buscar por ID
    public function getCategoriaById($id)
    {
        $this->db->query('SELECT * FROM categorias_cursos WHERE id_categoria = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    // Editar categoria
    public function updateCategoria($data)
    {
        $this->db->query('UPDATE categorias_cursos SET nome_categoria = :nome, preco_total = :preco, descricao = :descricao, duracao_meses = :duracao, estado = :estado WHERE id_categoria = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':nome', $data['nome']);
        $this->db->bind(':preco', $data['preco']);
        $this->db->bind(':descricao', $data['descricao']);
        $this->db->bind(':duracao', $data['duracao']);
        $this->db->bind(':estado', $data['estado']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Eliminar categoria
    public function deleteCategoria($id)
    {
        try {
            $this->db->query('DELETE FROM categorias_cursos WHERE id_categoria = :id');
            $this->db->bind(':id', $id);
            return $this->db->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
}
