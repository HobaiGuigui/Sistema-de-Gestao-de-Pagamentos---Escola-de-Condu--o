<?php

namespace App\Controllers;

use App\Core\Controller;

class CategoriasController extends Controller
{
    private $categoriaModel;

    public function __construct()
    {
        // if (!isset($_SESSION['user_id'])) { header('location: /auth/login'); exit; }
        $this->categoriaModel = $this->model('Categoria');
    }

    public function index()
    {
        $categorias = $this->categoriaModel->getCategorias();
        $status = $_GET['status'] ?? '';
        $feedback = '';
        $feedbackType = 'info';

        if ($status === 'updated') {
            $feedback = 'Categoria atualizada com sucesso.';
            $feedbackType = 'success';
        } elseif ($status === 'deleted') {
            $feedback = 'Categoria eliminada com sucesso.';
            $feedbackType = 'success';
        } elseif ($status === 'delete_error') {
            $feedback = 'Nao foi possivel eliminar a categoria. Verifique se existem estudantes vinculados.';
            $feedbackType = 'danger';
        }

        $data = [
            'title' => 'Gestao de Categorias',
            'activePage' => 'categorias',
            'categorias' => $categorias,
            'feedback' => $feedback,
            'feedback_type' => $feedbackType
        ];
        $this->view('categorias/index', $data);
    }

    public function adicionar()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'nome' => trim($_POST['nome_categoria']),
                'preco' => trim($_POST['preco_total']),
                'descricao' => trim($_POST['descricao']),
                'duracao' => trim($_POST['duracao_meses']),
                'nome_err' => '',
                'preco_err' => ''
            ];

            if (empty($data['nome'])) {
                $data['nome_err'] = 'Insira o nome da categoria';
            }
            if (empty($data['preco'])) {
                $data['preco_err'] = 'Insira o preco';
            }

            if (empty($data['nome_err']) && empty($data['preco_err'])) {
                if ($this->categoriaModel->addCategoria($data)) {
                    header('location: /categorias');
                    exit;
                }
                die('Erro ao guardar');
            }

            $data['title'] = 'Nova Categoria';
            $data['activePage'] = 'categorias';
            $this->view('categorias/adicionar', $data);
            return;
        }

        $data = [
            'title' => 'Nova Categoria',
            'activePage' => 'categorias',
            'nome' => '',
            'preco' => '',
            'descricao' => '',
            'duracao' => 3,
            'nome_err' => '',
            'preco_err' => ''
        ];
        $this->view('categorias/adicionar', $data);
    }

    public function editar($id = null)
    {
        if ($id === null || !is_numeric($id)) {
            header('location: /categorias');
            exit;
        }

        $categoria = $this->categoriaModel->getCategoriaById((int) $id);
        if (!$categoria) {
            header('location: /categorias');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $estado = trim($_POST['estado'] ?? 'ativo');
            if (!in_array($estado, ['ativo', 'inativo'], true)) {
                $estado = 'ativo';
            }

            $data = [
                'title' => 'Editar Categoria',
                'activePage' => 'categorias',
                'id' => (int) $id,
                'nome' => trim($_POST['nome_categoria'] ?? ''),
                'preco' => trim($_POST['preco_total'] ?? ''),
                'descricao' => trim($_POST['descricao'] ?? ''),
                'duracao' => trim($_POST['duracao_meses'] ?? ''),
                'estado' => $estado,
                'nome_err' => '',
                'preco_err' => '',
                'geral_err' => ''
            ];

            if (empty($data['nome'])) {
                $data['nome_err'] = 'Insira o nome da categoria';
            }
            if ($data['preco'] === '' || !is_numeric($data['preco'])) {
                $data['preco_err'] = 'Insira um preco valido';
            }

            if (empty($data['nome_err']) && empty($data['preco_err'])) {
                if ($this->categoriaModel->updateCategoria($data)) {
                    header('location: /categorias?status=updated');
                    exit;
                }
                $data['geral_err'] = 'Erro ao atualizar categoria.';
            }

            $this->view('categorias/editar', $data);
            return;
        }

        $data = [
            'title' => 'Editar Categoria',
            'activePage' => 'categorias',
            'id' => (int) $categoria->id_categoria,
            'nome' => $categoria->nome_categoria,
            'preco' => $categoria->preco_total,
            'descricao' => $categoria->descricao,
            'duracao' => $categoria->duracao_meses,
            'estado' => $categoria->estado,
            'nome_err' => '',
            'preco_err' => '',
            'geral_err' => ''
        ];

        $this->view('categorias/editar', $data);
    }

    public function eliminar($id = null)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || $id === null || !is_numeric($id)) {
            header('location: /categorias');
            exit;
        }

        if ($this->categoriaModel->deleteCategoria((int) $id)) {
            header('location: /categorias?status=deleted');
            exit;
        }

        header('location: /categorias?status=delete_error');
        exit;
    }
}
