<?php

namespace App\Models;

use App\Core\Database;

class Estudante
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Listar todos os estudantes com o nome da categoria
    public function getEstudantes()
    {
        $this->db->query('
            SELECT e.*, c.nome_categoria, c.preco_total 
            FROM estudantes e 
            JOIN categorias_cursos c ON e.categoria_id = c.id_categoria
            ORDER BY e.nome_completo ASC
        ');
        return $this->db->resultSet();
    }

    // Adicionar estudante
    public function addEstudante($data)
    {
        $this->db->query('INSERT INTO estudantes (nome_completo, sexo, data_nascimento, telefone, email, endereco, categoria_id, data_inscricao, data_inicio_curso, data_fim_curso) VALUES (:nome, :sexo, :nasc, :tel, :email, :endereco, :cat_id, :insc, :inicio, :fim)');

        $this->db->bind(':nome', $data['nome']);
        $this->db->bind(':sexo', $data['sexo']);
        $this->db->bind(':nasc', $data['nascimento']);
        $this->db->bind(':tel', $data['telefone']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':endereco', $data['endereco']);
        $this->db->bind(':cat_id', $data['categoria_id']);
        $this->db->bind(':insc', $data['data_inscricao']);
        $this->db->bind(':inicio', $data['data_inicio']);
        $this->db->bind(':fim', $data['data_fim']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Buscar perfil do estudante com saldo
    public function getEstudanteById($id)
    {
        $this->db->query('
            SELECT e.*, c.nome_categoria, c.preco_total,
            (SELECT IFNULL(SUM(p.valor_pago), 0) FROM pagamentos p WHERE p.estudante_id = e.id_estudante) as total_pago
            FROM estudantes e
            JOIN categorias_cursos c ON e.categoria_id = c.id_categoria
            WHERE e.id_estudante = :id
        ');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
}
