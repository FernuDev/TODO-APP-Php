<?php
class Todo {
    private $connection;
    public $title;
    public $completed;

    public function __construct($db) {
        $this->connection = $db; // Debe ser un objeto PDO
    }
    public function create() {
        $query = "INSERT INTO todos (title, completed) VALUES (:title, :completed)";
        $stmt = $this->connection->prepare($query);
    
        $stmt->bindParam(":title", $this->title);
        
        // Asegurar que completed sea un valor numérico (0 o 1)
        $completedValue = $this->completed ? 1 : 0;
        $stmt->bindParam(":completed", $completedValue, PDO::PARAM_INT);
    
        return $stmt->execute();
    }
    

    public function getAll() {
        $query = "SELECT * FROM todos";
        $stmt = $this->connection->prepare($query); // Usar $this->connection
        $stmt->execute();
        return $stmt;
    }

    public function update($id) {
        $query = "UPDATE todos SET title = :title, completed = :completed WHERE id = :id";
        $stmt = $this->connection->prepare($query);
    
        $stmt->bindParam(":title", $this->title);
        
        // Aseguramos que completed sea 0 o 1
        $completedValue = $this->completed ? 1 : 0;
        $stmt->bindParam(":completed", $completedValue, PDO::PARAM_INT);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    
        return $stmt->execute();
    }
    
}
?>
