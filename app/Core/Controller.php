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
        $file = APPROOT . '/Views/' . $view . '.php';
        if (file_exists($file)) {
            // Extrai as chaves do array em variáveis 
            extract($data);
            require_once $file;
        } else {
            die('View does not exist: ' . $view);
        }
    }
}
