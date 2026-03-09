<?php

// Router para PHP Built-in Server
if (php_sapi_name() === 'cli-server') {
    $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $file = __DIR__ . $url;
    if (is_file($file)) {
        return false; // Serve o arquivo estático
    }
}

// Inicia sessão
session_start();

// Autoload simples para classes PSR-4 (App\...)
spl_autoload_register(function ($class_name) {
    // Prefixo base do namespace
    $prefix = 'App\\';

    // Diretório base dos arquivos (sobe um nível de public/ para app/)
    $base_dir = __DIR__ . '/../app/';

    // O tamanho do prefixo
    $len = strlen($prefix);

    if (strncmp($prefix, $class_name, $len) !== 0) {
        return;
    }

    // Nome relativo da classe
    $relative_class = substr($class_name, $len);

    // Substitui separadores de namespace por separadores de diretório
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});

// Inicializa a Aplicação
$app = new App\Core\App();
