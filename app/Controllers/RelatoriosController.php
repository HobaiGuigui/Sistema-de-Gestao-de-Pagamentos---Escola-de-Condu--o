<?php

namespace App\Controllers;

use App\Core\Controller;

class RelatoriosController extends Controller
{
    public function __construct()
    {
        if (!isset($_SESSION['user_id'])) {
            header('location: /auth/login');
            exit;
        }
    }

    public function index()
    {
        $data = [
            'title' => 'Relatórios do Sistema',
            'activePage' => 'relatorios'
        ];
        $this->view('relatorios/index', $data);
    }

    public function pagamentos()
    {
        $db = new \App\Core\Database();
        $db->query('
            SELECT p.*, e.nome_completo, c.nome_categoria 
            FROM pagamentos p 
            JOIN estudantes e ON p.estudante_id = e.id_estudante 
            JOIN categorias_cursos c ON e.categoria_id = c.id_categoria
            ORDER BY p.data_pagamento DESC
        ');
        $pagamentos = $db->resultSet();

        $data = [
            'title' => 'Relatório de Pagamentos',
            'activePage' => 'relatorios',
            'pagamentos' => $pagamentos
        ];
        $this->view('relatorios/pagamentos', $data);
    }

    public function export_csv()
    {
        $db = new \App\Core\Database();
        $db->query('
            SELECT p.id_pagamento, e.nome_completo, c.nome_categoria, p.valor_pago, p.data_pagamento, p.forma_pagamento
            FROM pagamentos p 
            JOIN estudantes e ON p.estudante_id = e.id_estudante 
            JOIN categorias_cursos c ON e.categoria_id = c.id_categoria
        ');
        $results = $db->resultSet();

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="relatorio_pagamentos_' . date('Ymd') . '.csv"');

        $output = fopen('php://output', 'w');
        fputcsv($output, array('ID', 'Estudante', 'Categoria', 'Valor (CFA)', 'Data', 'Forma'));

        foreach ($results as $row) {
            fputcsv($output, (array) $row);
        }
        fclose($output);
        exit;
    }
}
