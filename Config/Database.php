<?php
class Database {
    public $host;
    public $database_name;
    public $username;
    public $password;
    public $connection;

    public function __construct() {

    //docker
        $env_host = getenv('DB_HOST');
        $env_name = getenv('DB_NAME');
        $env_user = getenv('DB_USER');
        $env_pass = getenv('DB_PASS');


        if ($env_host) {
            $this->host = $env_host;
        } else {
            
            $this->host = "db"; 
        }

        // 3. Lógica de Banco
        $this->database_name = $env_name ? $env_name : "tecnofit_ranking";

        // 4. Lógica de Usuário
        $this->username = $env_user ? $env_user : "tecno_user";

        // 5. Lógica de Senha
        $this->password = $env_pass ? $env_pass : "tecno_pass";
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