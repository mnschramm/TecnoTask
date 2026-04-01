<?php

class Database {
    public $host;
    public $database_name;
    public $username;
    public $password;
    public $connection;

    public function __construct() {
        
        $env_host = getenv('DB_HOST');
        $env_name = getenv('DB_NAME');
        $env_user = getenv('DB_USER');
        $env_pass = getenv('DB_PASS');

        if ($env_host) {
            $this->host = $env_host;
        } else {
            $this->host = "localhost"; 
        }

        if ($env_name) {
            $this->database_name = $env_name;
        } else {
            $this->database_name = "tecnofit_ranking";
        }

        if ($env_user) {
            $this->username = $env_user;
        } else {
            $this->username = "root";
        }

        if ($env_pass) {
            $this->password = $env_pass;
        } else {
            $this->password = "";
        }
    }

    public function getConnection() {
        $this->connection = null;
        try {
            $this->connection = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->database_name,
                $this->username,
                $this->password
            );
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->exec("set names utf8");
        } catch(PDOException $exception) {
            error_log("Erro de conexão: " . $exception->getMessage());
            return null;
        }
        return $this->connection;
    }
}