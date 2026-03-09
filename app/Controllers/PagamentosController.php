<?php

namespace App\Controllers;

use App\Core\Controller;

class PagamentosController extends Controller
{
    private $pagamentoModel;
    private $estudanteModel;

    public function __construct()
    {
        if (!isset($_SESSION['user_id'])) {
            header('location: /auth/login');
            exit;
        }
        $this->pagamentoModel = $this->model('Pagamento');
        $this->estudanteModel = $this->model('Estudante');
    }

    public function index()
    {
        $db = new \App\Core\Database();
        $db->query('
            SELECT p.*, e.id_estudante, e.nome_completo, c.nome_categoria
            FROM pagamentos p
            JOIN estudantes e ON p.estudante_id = e.id_estudante
            JOIN categorias_cursos c ON e.categoria_id = c.id_categoria
            ORDER BY p.data_pagamento DESC, p.id_pagamento DESC
        ');
        $pagamentos = $db->resultSet();

        $data = [
            'title' => 'Histórico de Pagamentos',
            'activePage' => 'pagamentos',
            'activeTab' => 'pagamentos',
            'pagamentos' => $pagamentos
        ];

        $this->view('pagamentos/index', $data);
    }

    public function registar($estudante_id)
    {
        if (!is_numeric($estudante_id)) {
            header('location: /pagamentos');
            exit;
        }

        $estudante = $this->estudanteModel->getEstudanteById((int) $estudante_id);

        if (!$estudante) {
            $data = [
                'title' => 'Registar Pagamento',
                'activePage' => 'pagamentos',
                'activeTab' => 'pagamentos',
                'estudante' => null,
                'valor_pago' => '',
                'data_pagamento' => date('Y-m-d'),
                'forma_pagamento' => 'dinheiro',
                'observacao' => '',
                'valor_err' => '',
                'geral_err' => 'Estudante não encontrado(a).'
            ];
            $this->view('pagamentos/registar', $data);
            return;
        }

        $saldoAtual = (float) $estudante->preco_total - (float) $estudante->total_pago;
        if ($saldoAtual < 0) {
            $saldoAtual = 0;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $valorRaw = str_replace(',', '.', trim($_POST['valor_pago'] ?? ''));
            $formaPagamento = trim($_POST['forma_pagamento'] ?? '');
            $dataPagamento = trim($_POST['data_pagamento'] ?? '');

            $data = [
                'title' => 'Registar Pagamento',
                'activePage' => 'pagamentos',
                'activeTab' => 'pagamentos',
                'estudante' => $estudante,
                'saldo_atual' => $saldoAtual,
                'valor_pago' => $valorRaw,
                'data_pagamento' => $dataPagamento,
                'forma_pagamento' => $formaPagamento,
                'observacao' => trim($_POST['observacao'] ?? ''),
                'valor_err' => '',
                'geral_err' => ''
            ];

            if (!is_numeric($valorRaw)) {
                $data['valor_err'] = 'Informe um valor de pagamento valido.';
            } elseif ((float) $valorRaw <= 0) {
                $data['valor_err'] = 'O valor do pagamento deve ser maior que zero.';
            } elseif ((float) $valorRaw > $saldoAtual) {
                $data['valor_err'] = 'O valor nao pode ultrapassar o saldo atual do estudante.';
            }

            if ($saldoAtual <= 0) {
                $data['geral_err'] = 'Este estudante já liquidou o valor total da categoria.';
            }

            if (empty($data['valor_err']) && empty($data['geral_err'])) {
                if (!in_array($formaPagamento, ['dinheiro', 'transferência', 'cartão'], true)) {
                    $data['geral_err'] = 'Forma de pagamento invalida.';
                    $this->view('pagamentos/registar', $data);
                    return;
                }

                $payload = [
                    'estudante_id' => (int) $estudante_id,
                    'valor_pago' => number_format((float) $valorRaw, 2, '.', ''),
                    'data_pagamento' => $dataPagamento,
                    'forma_pagamento' => $formaPagamento,
                    'observacao' => $data['observacao']
                ];

                $pagamento_id = $this->pagamentoModel->addPagamento($payload);
                if ($pagamento_id) {
                    header('location: /pagamentos/fatura/' . $pagamento_id);
                    exit;
                }

                $data['geral_err'] = 'Erro ao registar pagamento.';
            }

            $this->view('pagamentos/registar', $data);
            return;
        }

        $data = [
            'title' => 'Registar Pagamento',
            'activePage' => 'pagamentos',
            'activeTab' => 'pagamentos',
            'estudante' => $estudante,
            'saldo_atual' => $saldoAtual,
            'valor_pago' => '',
            'data_pagamento' => date('Y-m-d'),
            'forma_pagamento' => 'dinheiro',
            'observacao' => '',
            'valor_err' => '',
            'geral_err' => ''
        ];
        $this->view('pagamentos/registar', $data);
    }

    public function fatura($pagamento_id)
    {
        $db = new \App\Core\Database();
        $db->query('
            SELECT p.*, e.nome_completo, e.endereco, e.telefone, c.nome_categoria, c.preco_total,
            (SELECT SUM(p2.valor_pago) FROM pagamentos p2 WHERE p2.estudante_id = e.id_estudante AND p2.id_pagamento <= p.id_pagamento) as total_pago_ate_agora
            FROM pagamentos p
            JOIN estudantes e ON p.estudante_id = e.id_estudante
            JOIN categorias_cursos c ON e.categoria_id = c.id_categoria
            WHERE p.id_pagamento = :id
        ');
        $db->bind(':id', $pagamento_id);
        $pagamento = $db->single();

        $data = [
            'pagamento' => $pagamento
        ];

        if (file_exists('../app/Views/pagamentos/fatura.php')) {
            require_once '../app/Views/pagamentos/fatura.php';
        } else {
            die('Fatura view nao encontrada');
        }
    }
}
