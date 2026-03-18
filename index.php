<?php
/**
 * Ponto de entrada para XAMPP/WAMP (redireciona para public/)
 */

// Define as constantes de caminho antes de incluir o index real
define('APPROOT', __DIR__ . '/app');

// Inclui o arquivo principal da aplicação
require_once __DIR__ . '/public/index.php';
