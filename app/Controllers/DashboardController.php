<?php

namespace App\Controllers;

use App\Core\Controller;

class DashboardController extends Controller
{
    public function __construct()
    {
        // Verificar se está logado (DESATIVADO TEMPORARIAMENTE)
        /*
        if (!isset($_SESSION['user_id'])) {
            header('location: /auth/login');
            exit;
        }
        */
    }

    public function index()
    {
        $db = new \App\Core\Database();

        // Total Estudantes
        $db->query('SELECT COUNT(*) as total FROM estudantes');
        $total = $db->single()->total ?? 0;

        // Género
        $db->query('SELECT COUNT(*) as total FROM estudantes WHERE sexo = "M"');
        $masc = $db->single()->total ?? 0;
        $db->query('SELECT COUNT(*) as total FROM estudantes WHERE sexo = "F"');
        $fem = $db->single()->total ?? 0;

        // Receita Total
        $db->query('SELECT SUM(valor_pago) as total FROM pagamentos');
        $receita = $db->single()->total ?? 0;

        // Pagamentos do Mês
        $db->query('SELECT COUNT(*) as total FROM pagamentos WHERE MONTH(data_pagamento) = MONTH(CURRENT_DATE) AND YEAR(data_pagamento) = YEAR(CURRENT_DATE)');
        $pagMonth = $db->single()->total ?? 0;

        $data = [
            'title' => 'Painel Administrativo',
            'activePage' => 'dashboard',
            'stats' => [
                'total_estudantes' => $total,
                'estudantes_m' => $masc,
                'estudantes_f' => $fem,
                'pagamentos_mes' => $pagMonth,
                'receita_total' => $receita
            ]
        ];

        $this->view('dashboard/index', $data);
    }
}
