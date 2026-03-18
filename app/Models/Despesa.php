<?php

namespace App\Models;

use App\Core\Database;

class Despesa
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Listar todas as despesas
    public function getDespesas()
    {
        $this->db->query('SELECT * FROM despesas ORDER BY data_despesa DESC');
        return $this->db->resultSet();
    }

    // Adicionar despesa
    public function addDespesa($data)
    {
        $this->db->query('INSERT INTO despesas (descricao, valor, data_despesa, categoria, observacao) VALUES (:descricao, :valor, :data, :categoria, :obs)');
        $this->db->bind(':descricao', $data['descricao']);
        $this->db->bind(':valor', $data['valor']);
        $this->db->bind(':data', $data['data_despesa']);
        $this->db->bind(':categoria', $data['categoria']);
        $this->db->bind(':obs', $data['observacao']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Buscar despesa por ID
    public function getDespesaById($id)
    {
        $this->db->query('SELECT * FROM despesas WHERE id_despesa = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    // Eliminar despesa
    public function deleteDespesa($id)
    {
        $this->db->query('DELETE FROM despesas WHERE id_despesa = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    // Total de despesas por período
    public function getTotalDespesas()
    {
        $this->db->query('SELECT SUM(valor) as total FROM despesas');
        $row = $this->db->single();
        return $row->total ?? 0;
    }
}
