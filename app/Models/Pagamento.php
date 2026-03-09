<?php

namespace App\Models;

use App\Core\Database;

class Pagamento
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Listar pagamentos de um estudante
    public function getPagamentosByEstudante($estudante_id)
    {
        $this->db->query('SELECT * FROM pagamentos WHERE estudante_id = :id ORDER BY data_pagamento DESC');
        $this->db->bind(':id', $estudante_id);
        return $this->db->resultSet();
    }

    // Registar novo pagamento
    public function addPagamento($data)
    {
        $this->db->query('INSERT INTO pagamentos (estudante_id, valor_pago, data_pagamento, forma_pagamento, observacao) VALUES (:est_id, :valor, :data, :forma, :obs)');

        $this->db->bind(':est_id', $data['estudante_id']);
        $this->db->bind(':valor', $data['valor_pago']);
        $this->db->bind(':data', $data['data_pagamento']);
        $this->db->bind(':forma', $data['forma_pagamento']);
        $this->db->bind(':obs', $data['observacao']);

        if ($this->db->execute()) {
            return $this->db->lastInsertId();
        } else {
            return false;
        }
    }
}
