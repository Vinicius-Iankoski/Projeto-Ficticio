<?php
class Database {
    private $host = "localhost";
    private $db_name = "portfolio";
    private $username = "root"; // Usuário padrão do WAMP
    private $password = ""; // Senha padrão do WAMP é vazia
    public $conn;

    public function getConnection() {
        $this->conn = null; // Inicializa a conexão como nula

        try {
            // Tenta criar uma nova conexão PDO com o banco de dados MySQL
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);

            // Configura o conjunto de caracteres para UTF-8
            $this->conn->exec("set names utf8");

        } catch(PDOException $exception) {
            // Captura e exibe uma mensagem de erro caso ocorra uma exceção PDO
            echo "Connection error: " . $exception->getMessage();
        }

        // Retorna o objeto de conexão PDO, que pode ser usado para executar consultas SQL
        return $this->conn;
    }
}
?>