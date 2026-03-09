<?php

namespace App\Core;

use PDO;
use PDOException;

class Database
{
    private $host = 'localhost';
    private $user = 'root'; // DEFAULT XAMPP
    private $pass = '';     // DEFAULT XAMPP
    private $dbname = 'escola_conducao_3agosto';

    private $dbh;
    private $error;
    private $stmt;

    public function __construct()
    {
        // Set DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname . ';charset=utf8mb4';

        // Options
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        // Create PDO instance
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo "Aviso: " . $this->error . " (Certifique-se de importar o database.sql)";
        }
    }

    // Query builder
    public function query($sql)
    {
        $this->stmt = $this->dbh->prepare($sql);
    }

    // Bind values
    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    // Execute the statement
    public function execute()
    {
        return $this->stmt->execute();
    }

    // Retorna todos os resultados como objeto
    public function resultSet()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Retorna único resultado
    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    // Retorna o last insert id
    public function lastInsertId()
    {
        return $this->dbh->lastInsertId();
    }

    // Retorna numero de relatórios/linhas (count)
    public function rowCount()
    {
        return $this->stmt->rowCount();
    }
}
