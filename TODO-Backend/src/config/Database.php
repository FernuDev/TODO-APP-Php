<?php
class Database {
    private $host = "localhost";
    private $dbname = "todoapp";
    private $username = "root";
    private $password = "Y#4Kj8v@Tz!fX3&hC$9LqW";
    private $connection;

    public function __construct() {
        try {
            $this->connection = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->dbname,
                $this->username,
                $this->password
            );
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    // Agregar este método para retornar la conexión
    public function getConnection() {
        return $this->connection;
    }    
}
?>
