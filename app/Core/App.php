<?php

namespace App\Core;

class App
{
    protected $controller = 'DashboardController';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->parseUrl();

        // 1. Controller
        if (isset($url[0])) {
            $controllerName = ucfirst($url[0]) . 'Controller';
            $controllerFile = dirname(__DIR__) . '/Controllers/' . $controllerName . '.php';
            if (file_exists($controllerFile)) {
                $this->controller = $controllerName;
                unset($url[0]);
            }
        }

        $controllerClass = '\\App\\Controllers\\' . $this->controller;
        $this->controller = new $controllerClass;

        // 2. Method
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // 3. Params
        $this->params = $url ? array_values($url) : [];

        // Chama o método com os params
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl()
    {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }

        $path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
        
        // Remove URLROOT do path para o roteamento funcionar em subdiretórios
        if (defined('URLROOT') && URLROOT !== '' && strpos($path, URLROOT) === 0) {
            $path = substr($path, strlen(URLROOT));
        }
        
        $path = trim((string) $path, '/');

        if ($path === '' || $path === 'index.php') {
            return [];
        }

        $segments = explode('/', filter_var($path, FILTER_SANITIZE_URL));
        $segments = array_values(array_filter($segments, static function ($segment) {
            return $segment !== '' && $segment !== 'index.php';
        }));

        return $segments;
    }
}
