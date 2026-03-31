<?php
// Config/Database.php
class Database {
    private $host = "127.0.0.1";
    private $db_name = "tecnofit_ranking";
    private $username = "root";
    private $password = ""; // Laragon por padrão vem vazio
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Erro de conexão: " . $exception->getMessage();
        }
        return $this->conn;
    }
}