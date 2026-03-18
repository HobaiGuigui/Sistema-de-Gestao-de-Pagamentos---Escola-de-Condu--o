<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>EC 3 de Agosto | Acesso Restrito</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="<?php echo URLROOT; ?>/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #0059b3;
            /* Blue from logo */
            --primary-dark: #003d7a;
            --text: #1f2937;
            --glass: rgba(255, 255, 255, 0.9);
        }

        body {
            background: url("<?php echo URLROOT; ?>/logo.jpg") no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Inter', sans-serif;
            margin: 0;
            position: relative;
            overflow: hidden;
            /* Prevent scroll on login */
        }

        /* Overlay to darken background slightly for better readability */
        body::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(15, 23, 42, 0.5);
            /* Semi-transparent overlay */
            z-index: 1;
        }

        .login-container {
            width: 90%;
            max-width: 440px;
            padding: 20px;
            position: relative;
            z-index: 2;
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
            background: var(--glass);
            backdrop-filter: blur(8px);
            padding: 40px 30px;
            border-radius: 28px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        @media (max-width: 480px) {
            .login-card {
                padding: 30px 20px;
            }

            .brand h2 {
                font-size: 24px;
            }
        }

        .brand {
            text-align: center;
            margin-bottom: 35px;
        }

        .brand h2 {
            font-weight: 800;
            letter-spacing: -1.5px;
            color: var(--text);
            margin: 0;
        }

        .brand span {
            color: var(--primary);
        }

        .brand p {
            color: #6b7280;
            margin-top: 5px;
            font-size: 14px;
            font-weight: 500;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: 600;
            font-size: 12px;
            color: #4b5563;
            margin-bottom: 6px;
            display: block;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-control {
            height: 52px;
            border-radius: 14px;
            border: 2px solid #e5e7eb;
            padding: 10px 16px;
            font-size: 15px;
            transition: all 0.3s;
            box-shadow: none !important;
            width: 100%;
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
            border-radius: 14px;
            font-weight: 700;
            font-size: 16px;
            margin-top: 10px;
            transition: all 0.3s;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0, 89, 179, 0.3);
        }

        .btn-login:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
            box-shadow: 0 8px 15px rgba(0, 89, 179, 0.4);
        }

        .error-msg {
            background: #fef2f2;
            color: #dc2626;
            padding: 12px;
            border-radius: 12px;
            font-size: 13px;
            margin-bottom: 20px;
            border: 1px solid #fee2e2;
            display: none;
            text-align: center;
        }

        <?php if (!empty($email_err) || !empty($password_err)): ?>
            .error-msg {
                display: block;
            }

        <?php endif; ?>

        .footer-text {
            text-align: center;
            margin-top: 25px;
            font-size: 12px;
            color: rgba(255, 255, 255, 0.9);
            /* Brighter for readability on dark overlay */
            line-height: 1.5;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
        }

        .footer-text b {
            color: #fff;
            text-decoration: none;
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

            <form action="<?php echo URLROOT; ?>/auth/login" method="post">
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

        <p>Desenvolvido por [Hiobaldine Sá](https://www.linkedin.com/in/hiobaldine/) © 2026 tel.:+245955502845</p>
    </div>

    <script src="<?php echo URLROOT; ?>/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo URLROOT; ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>