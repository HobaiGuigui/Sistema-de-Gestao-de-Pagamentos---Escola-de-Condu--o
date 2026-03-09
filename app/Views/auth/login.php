<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>EC 3 de Agosto | Acesso Restrito</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #007bff;
            --primary-dark: #0056b3;
            --bg: #f8f9fa;
            --text: #333;
        }

        body {
            background: var(--bg);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Inter', sans-serif;
            margin: 0;
            overflow: hidden;
        }

        /* Animação de fundo */
        body::before {
            content: "";
            position: absolute;
            width: 150%;
            height: 150%;
            background: radial-gradient(circle, rgba(0, 123, 255, 0.05) 0%, rgba(255, 255, 255, 0) 70%);
            top: -25%;
            left: -25%;
            z-index: -1;
            animation: pulse 15s infinite alternate;
        }

        @keyframes pulse {
            from {
                transform: scale(1);
            }

            to {
                transform: scale(1.1);
            }
        }

        .login-container {
            width: 100%;
            max-width: 420px;
            padding: 20px;
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-card {
            background: white;
            padding: 45px;
            border-radius: 24px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(0, 0, 0, 0.02);
        }

        .brand {
            text-align: center;
            margin-bottom: 40px;
        }

        .brand h2 {
            font-weight: 800;
            letter-spacing: -1.5px;
            color: var(--text);
            margin: 0;
            font-size: 28px;
        }

        .brand span {
            color: var(--primary);
        }

        .brand p {
            color: #888;
            margin-top: 8px;
            font-size: 15px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: 600;
            font-size: 13px;
            color: #555;
            margin-bottom: 8px;
            display: block;
        }

        .form-control {
            height: 54px;
            border-radius: 12px;
            border: 2px solid #f1f1f1;
            padding: 10px 18px;
            font-size: 15px;
            transition: all 0.3s;
            box-shadow: none !important;
        }

        .form-control:focus {
            border-color: var(--primary);
            background: #fff;
        }

        .btn-login {
            background: var(--primary);
            color: white;
            border: none;
            height: 54px;
            width: 100%;
            border-radius: 12px;
            font-weight: 700;
            font-size: 16px;
            margin-top: 10px;
            transition: all 0.3s;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-login:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 123, 255, 0.2);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .error-msg {
            background: #fff5f5;
            color: #d9534f;
            padding: 12px;
            border-radius: 10px;
            font-size: 13px;
            margin-bottom: 20px;
            border-left: 4px solid #d9534f;
            display: none;
        }

        <?php if (!empty($email_err) || !empty($password_err)): ?>
            .error-msg {
                display: block;
            }

        <?php endif; ?>

        .footer-text {
            text-align: center;
            margin-top: 30px;
            font-size: 13px;
            color: #aaa;
        }
    </style>
</head>

<body>

    <div class="login-container">
        <div class="login-card">
            <div class="brand">
                <h2>EC 3 <span>de Agosto</span></h2>
                <p>Gestão Financeira</p>
            </div>

            <div class="error-msg">
                <?php echo $email_err ?: $password_err; ?>
            </div>

            <form action="/auth/login" method="post">
                <div class="form-group">
                    <label class="form-label">Endereço de Email</label>
                    <input type="email" name="email" class="form-control" placeholder="nome@escola.com"
                        value="<?php echo $email; ?>" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Palavra-passe</label>
                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>

                <button type="submit" class="btn-login">
                    Entrar no Sistema
                </button>
            </form>
        </div>

        <p class="footer-text">&copy; <?php echo date('Y'); ?> Todos os direitos reservados ao Engº. <b href:"https://linkedin.com/Hiobaldine">Hiobaldine</b> tel.:955502845</p>
    </div>

    <script src="/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>
