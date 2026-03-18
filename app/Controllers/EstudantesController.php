<?php

namespace App\Controllers;

use App\Core\Controller;

class EstudantesController extends Controller
{
    private $estudanteModel;
    private $categoriaModel;

    public function __construct()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . URLROOT . '/auth/login');
            exit;
        }
        $this->estudanteModel = $this->model('Estudante');
        $this->categoriaModel = $this->model('Categoria');
    }

    public function index()
    {
        $estudantes = $this->estudanteModel->getEstudantes();
        $data = [
            'title' => 'Gestão de Pagamentos de Estudantes',
            'activePage' => 'estudantes',
            'estudantes' => $estudantes
        ];
        $this->view('estudantes/index', $data);
    }

    public function cadastrar()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'nome' => trim($_POST['nome_completo']),
                'sexo' => $_POST['sexo'],
                'nascimento' => $_POST['data_nascimento'],
                'telefone' => trim($_POST['telefone']),
                'email' => trim($_POST['email']),
                'endereco' => trim($_POST['endereco']),
                'categoria_id' => $_POST['categoria_id'],
                'data_inscricao' => date('Y-m-d'),
                'data_inicio' => $_POST['data_inicio'],
                'data_fim' => $_POST['data_fim']
            ];

            if ($this->estudanteModel->addEstudante($data)) {
                header('Location: ' . URLROOT . '/estudantes');
            } else {
                die('Erro ao cadastrar');
            }
        } else {
            $categorias = $this->categoriaModel->getCategorias();
            $data = [
                'title' => 'Novo Estudante',
                'activePage' => 'estudantes',
                'categorias' => $categorias
            ];
            $this->view('estudantes/cadastrar', $data);
        }
    }

    public function perfil($id)
    {
        $estudante = $this->estudanteModel->getEstudanteById($id);

        // Buscar pagamentos
        $pagamentoModel = $this->model('Pagamento');
        $pagamentos = $pagamentoModel->getPagamentosByEstudante($id);

        $data = [
            'title' => 'Perfil do Estudante',
            'activePage' => 'estudantes',
            'estudante' => $estudante,
            'pagamentos' => $pagamentos
        ];
        $this->view('estudantes/perfil', $data);
    }
}
