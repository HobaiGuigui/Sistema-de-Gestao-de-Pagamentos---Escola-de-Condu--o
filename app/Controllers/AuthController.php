<?php

namespace App\Controllers;

use App\Core\Controller;

class AuthController extends Controller
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = $this->model('Utilizador');
    }

    public function login()
    {
        // Se já estiver logado, redirecionar para dashboard
        if (isset($_SESSION['user_id'])) {
            header('location: /dashboard');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitizar dados (Evitando o depreciado FILTER_SANITIZE_STRING)
            $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
            $password = trim($_POST['password']);

            $data = [
                'email' => $email,
                'password' => $password,
                'email_err' => '',
                'password_err' => '',
            ];

            // Validar Email
            if (empty($data['email'])) {
                $data['email_err'] = 'Por favor insira o email.';
            }

            // Validar Password
            if (empty($data['password'])) {
                $data['password_err'] = 'Por favor insira a password.';
            }

            // Verificar se não há erros
            if (empty($data['email_err']) && empty($data['password_err'])) {
                // Tentar login
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);

                if ($loggedInUser) {
                    // Criar Sessão
                    $this->createUserSession($loggedInUser);
                } else {
                    $data['password_err'] = 'Password incorreta ou utilizador não encontrado.';
                    $this->view('auth/login', $data);
                }
            } else {
                // Carregar view com erros
                $this->view('auth/login', $data);
            }

        } else {
            // Dados iniciais
            $data = [
                'email' => '',
                'password' => '',
                'email_err' => '',
                'password_err' => '',
            ];

            // Carregar view
            $this->view('auth/login', $data);
        }
    }

    public function createUserSession($user)
    {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_nome'] = $user->nome;
        header('location: /dashboard');
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_nome']);
        session_destroy();
        header('location: /auth/login');
    }

    public function isLoggedIn()
    {
        if (isset($_SESSION['user_id'])) {
            return true;
        } else {
            return false;
        }
    }
}
