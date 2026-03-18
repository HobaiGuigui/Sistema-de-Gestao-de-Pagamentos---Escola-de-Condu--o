<?php

namespace App\Controllers;

use App\Core\Controller;

class DespesasController extends Controller
{
    private $despesaModel;

    public function __construct()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . URLROOT . '/auth/login');
            exit;
        }
        $this->despesaModel = $this->model('Despesa');
    }

    public function index()
    {
        $despesas = $this->despesaModel->getDespesas();
        $total = $this->despesaModel->getTotalDespesas();

        $data = [
            'despesas' => $despesas,
            'total' => $total,
            'title' => 'Gestão de Despesas',
            'activePage' => 'despesas'
        ];

        $this->view('despesas/index', $data);
    }

    public function adicionar()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'descricao' => trim($_POST['descricao']),
                'valor' => trim($_POST['valor']),
                'data_despesa' => trim($_POST['data_despesa']),
                'categoria' => trim($_POST['categoria']),
                'observacao' => trim($_POST['observacao']),
                'title' => 'Adicionar Despesa',
                'activePage' => 'despesas'
            ];

            if ($this->despesaModel->addDespesa($data)) {
                header('Location: ' . URLROOT . '/despesas');
                exit;
            } else {
                die('Erro ao guardar despesa');
            }
        } else {
            $data = [
                'title' => 'Adicionar Despesa',
                'activePage' => 'despesas'
            ];
            $this->view('despesas/adicionar', $data);
        }
    }

    public function eliminar($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->despesaModel->deleteDespesa($id)) {
                header('Location: ' . URLROOT . '/despesas');
                exit;
            } else {
                die('Erro ao eliminar');
            }
        } else {
            header('Location: ' . URLROOT . '/despesas');
        }
    }
}
