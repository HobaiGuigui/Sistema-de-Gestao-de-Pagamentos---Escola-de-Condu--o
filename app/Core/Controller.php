<?php

namespace App\Core;

class Controller
{
    // Carrega um modelo
    public function model($model)
    {
        $modelClass = '\\App\\Models\\' . $model;
        return new $modelClass();
    }

    // Carrega uma view
    public function view($view, $data = [])
    {
        if (file_exists('../app/Views/' . $view . '.php')) {
            // Extrai as chaves do array em variáveis 
            extract($data);
            require_once '../app/Views/' . $view . '.php';
        } else {
            die('View does not exist: ' . $view);
        }
    }
}
