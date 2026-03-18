<?php
$title = $title ?? 'Painel Administrativo';
$requestPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
// Remove URLROOT do path para o menu ativo funcionar
if (URLROOT !== '' && strpos($requestPath, URLROOT) === 0) {
    $requestPath = substr($requestPath, strlen(URLROOT));
}
$segments = array_values(array_filter(explode('/', trim((string) $requestPath, '/'))));
$routeSection = $segments[0] ?? 'dashboard';
$routeAction = $segments[1] ?? '';

if ($routeSection === '') {
    $routeSection = 'dashboard';
}

$activePage = $activePage ?? $routeSection;
$activeTab = $activeTab ?? $activePage;

if ($routeSection === 'estudantes' && $routeAction === 'cadastrar') {
    $activeTab = 'estudantes.add';
} elseif ($routeSection === 'categorias' && $routeAction === 'adicionar') {
    $activeTab = 'categorias.add';
} elseif ($routeSection === 'relatorios' && $routeAction === 'pagamentos') {
    $activeTab = 'relatorios.pagamentos';
}

$isEstudantesActive = (strpos($activeTab, 'estudantes') === 0);
$isCategoriasActive = (strpos($activeTab, 'categorias') === 0);
$isPagamentosActive = (strpos($activeTab, 'pagamentos') === 0);
$isRelatoriosActive = (strpos($activeTab, 'relatorios') === 0);
$isDashboardActive = ($activeTab === 'dashboard');
$userNome = $_SESSION['user_nome'] ?? 'Utilizador';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>EC 3 de Agosto | <?php echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="<?php echo URLROOT; ?>/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

    <style>
        :root {
            --brand: #0059b3; /* Blue from logo */
            --brand-dark: #003d7a;
            --brand-soft: #e8f3ff;
            --bg: #f8fafc;
            --surface: #ffffff;
            --text: #0f172a;
            --muted: #64748b;
            --border: #e2e8f0;
            --shadow-soft: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: "Segoe UI", -apple-system, BlinkMacSystemFont, Roboto, Helvetica, Arial, sans-serif;
            background: radial-gradient(circle at top left, #eff6ff 0%, #f4f7fc 38%, #f4f7fc 100%);
            color: var(--text);
        }

        .wrapper {
            min-height: 100vh;
            position: relative;
        }

        .main-sidebar {
            width: 270px;
            background: var(--surface);
            border-right: 1px solid var(--border);
            box-shadow: var(--shadow-soft);
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            z-index: 1100;
            transition: transform 0.25s ease;
            overflow-y: auto;
        }

        .sidebar-brand {
            padding: 24px 22px 18px;
            font-size: 20px;
            font-weight: 800;
            color: var(--brand);
            border-bottom: 1px solid var(--border);
            letter-spacing: -0.4px;
        }

        .sidebar-menu {
            padding: 16px 0 18px;
            margin: 0;
            list-style: none;
        }

        .sidebar-menu li a {
            display: block;
            padding: 11px 22px;
            text-decoration: none;
            color: #334155;
            font-weight: 600;
            border-left: 3px solid transparent;
            transition: all 0.2s ease;
        }

        .sidebar-menu li a i {
            width: 20px;
            margin-right: 10px;
            text-align: center;
            color: #64748b;
        }

        .sidebar-menu li a:hover {
            background: #f8fbff;
            color: var(--brand);
        }

        .sidebar-menu li a:hover i {
            color: var(--brand);
        }

        .sidebar-menu li.active>a {
            color: var(--brand);
            border-left-color: var(--brand);
            background: var(--brand-soft);
        }

        .sidebar-menu li.active>a i {
            color: var(--brand);
        }

        .sidebar-menu .submenu-item a {
            padding-left: 52px;
            font-size: 13px;
            font-weight: 600;
            color: #64748b;
        }

        .sidebar-menu .submenu-item.active a {
            color: var(--brand);
            background: #f1f6ff;
            border-left-color: #7aa2ff;
        }

        .sidebar-menu .menu-separator {
            margin-top: 18px;
            padding: 12px 22px 8px;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 700;
            color: #94a3b8;
        }

        .main-header {
            margin-left: 270px;
            height: 72px;
            border-bottom: 1px solid var(--border);
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(4px);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 22px;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 0;
        }

        .sidebar-toggle {
            display: none;
            border: 1px solid var(--border);
            background: #fff;
            color: #334155;
            width: 38px;
            height: 38px;
            border-radius: 10px;
            line-height: 1;
        }

        .page-title h4 {
            margin: 0;
            font-size: 19px;
            font-weight: 750;
            letter-spacing: -0.2px;
            color: #0f172a;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .header-cta {
            border-radius: 10px;
            padding: 8px 14px;
            font-weight: 700;
            box-shadow: 0 8px 14px rgba(29, 78, 216, 0.15);
            white-space: nowrap;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--muted);
            font-size: 13px;
        }

        .user-profile strong {
            color: #0f172a;
        }

        .content-wrapper {
            margin-left: 270px;
            padding: 24px;
            transition: all 0.3s ease;
        }

        .card-stat,
        .table-container {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 14px;
            box-shadow: var(--shadow-soft);
        }

        .card-stat {
            padding: 22px;
            margin-bottom: 22px;
        }

        .card-stat h4 {
            margin: 0 0 12px;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            color: #6b7280;
            font-weight: 700;
        }

        .card-stat .value {
            font-size: 27px;
            line-height: 1.1;
            color: #111827;
            font-weight: 800;
        }

        .table-container {
            padding: 18px;
        }

        .section-toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            margin-bottom: 22px;
            flex-wrap: wrap;
        }

        .section-title {
            margin: 0;
            font-weight: 700;
            color: #0f172a;
            font-size: 18px;
        }

        .section-subtitle {
            margin: 6px 0 0;
            color: #64748b;
            font-size: 13px;
        }

        .table>thead>tr>th {
            border-bottom: 1px solid #e2e8f0;
            color: #475569;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .table>tbody>tr>td {
            vertical-align: middle;
            border-top-color: #edf2f7;
        }

        .btn {
            border-radius: 9px;
        }

        .btn-primary {
            background: var(--brand);
            border-color: var(--brand);
        }

        .btn-primary:hover,
        .btn-primary:focus {
            background: #1e40af;
            border-color: #1e40af;
        }

        .btn-action {
            border-radius: 8px;
            padding: 5px 10px;
        }

        .label {
            border-radius: 999px;
            padding: 6px 10px;
            font-weight: 600;
        }

        .layout-overlay {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.35);
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.2s ease;
            z-index: 1090;
            border: 0;
        }

        @media (max-width: 991px) {
            .main-sidebar {
                transform: translateX(-100%);
            }

            .main-header,
            .content-wrapper {
                margin-left: 0;
            }

            .content-wrapper {
                padding: 16px; /* Less padding on small screens */
            }

            .sidebar-toggle {
                display: inline-flex;
                align-items: center;
                justify-content: center;
            }

            .header-cta {
                display: none;
            }

            .wrapper.sidebar-open .main-sidebar {
                transform: translateX(0);
            }

            .wrapper.sidebar-open .layout-overlay {
                opacity: 1;
                pointer-events: auto;
            }

            .page-title h4 {
                font-size: 16px; /* Smaller title on mobile */
            }
        }
    </style>
</head>

<body>
    <div class="wrapper" id="appWrapper">
        <aside class="main-sidebar">
            <div class="sidebar-brand">
                <img src="<?php echo URLROOT; ?>/logo.jpg" alt="Logo" style="width: 40px; height: 40px; border-radius: 8px; margin-right: 10px; vertical-align: middle;">
                EC 3 de Agosto
            </div>
            <ul class="sidebar-menu">
                <li class="<?php echo $isDashboardActive ? 'active' : ''; ?>">
                    <a href="<?php echo URLROOT; ?>/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a>
                </li>
                <li class="<?php echo $isEstudantesActive ? 'active' : ''; ?>">
                    <a href="<?php echo URLROOT; ?>/estudantes"><i class="fa fa-users"></i> Estudantes</a>
                </li>
                <li class="submenu-item <?php echo ($activeTab === 'estudantes.add') ? 'active' : ''; ?>">
                    <a href="<?php echo URLROOT; ?>/estudantes/cadastrar"><i class="fa fa-user-plus"></i> Adicionar Estudante</a>
                </li>
                <li class="<?php echo $isCategoriasActive ? 'active' : ''; ?>">
                    <a href="<?php echo URLROOT; ?>/categorias"><i class="fa fa-list"></i> Categorias</a>
                </li>
                <li class="<?php echo ($data['activePage'] == 'pagamentos' || $data['activePage'] == 'despesas') ? 'active' : ''; ?>">
                    <a href="#"><i class="fa fa-money"></i> <span>FINANCEIRO</span><i
                            class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li class="<?php echo ($data['activePage'] == 'pagamentos') ? 'active' : ''; ?>">
                            <a href="<?php echo URLROOT; ?>/pagamentos"><i class="fa fa-circle-o"></i> Pagamentos Recebidos</a>
                        </li>
                        <li class="<?php echo ($data['activePage'] == 'despesas') ? 'active' : ''; ?>">
                            <a href="<?php echo URLROOT; ?>/despesas"><i class="fa fa-circle-o"></i> Gestão de Despesas</a>
                        </li>
                    </ul>
                </li>
                <li class="<?php echo $isRelatoriosActive ? 'active' : ''; ?>">
                    <a href="<?php echo URLROOT; ?>/relatorios"><i class="fa fa-file-pdf-o"></i> Relatórios</a>
                </li>
                <li class="menu-separator">Sessão</li>
                <li>
                    <a href="<?php echo URLROOT; ?>/auth/logout" style="color: #dc2626;"><i class="fa fa-sign-out"></i> Sair</a>
                </li>
            </ul>
        </aside>

        <button class="layout-overlay" id="layoutOverlay" aria-label="Fechar menu lateral"></button>

        <div class="main-header">
            <div class="header-left">
                <button type="button" class="sidebar-toggle" id="sidebarToggle" aria-label="Abrir menu">
                    <i class="fa fa-bars"></i>
                </button>
                <div class="page-title">
                    <h4><?php echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></h4>
                </div>
            </div>
            <div class="header-right">
                <a href="<?php echo URLROOT; ?>/estudantes/cadastrar" class="btn btn-primary btn-sm header-cta">
                    <i class="fa fa-user-plus"></i> Adicionar Estudante
                </a>
                <div class="user-profile">
                    <span>Ola, <strong><?php echo htmlspecialchars($userNome, ENT_QUOTES, 'UTF-8'); ?></strong></span>
                    <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($userNome); ?>&background=1d4ed8&color=fff"
                        class="img-circle" width="35" alt="Avatar do utilizador">
                </div>
            </div>
        </div>

        <div class="content-wrapper">
