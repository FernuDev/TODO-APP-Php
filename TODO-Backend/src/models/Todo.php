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
        $query = "UPDATE todos SET completed = :completed WHERE id = :id";
        $stmt = $this->connection->prepare($query);
    
        // Vinculamos el parámetro 'completed' que se pasa en la solicitud
        $stmt->bindParam(":completed", $this->completed, PDO::PARAM_BOOL);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    
        // Ejecutar la consulta
        return $stmt->execute();
    }
    
    
    

    public function delete($id) {
        $query = "DELETE FROM todos WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    
        // Depuración
        echo "ID Recibido: $id\n";
    
        if ($stmt->execute()) {
            $rowCount = $stmt->rowCount();
            if ($rowCount > 0) {
                echo json_encode(["message" => "Tarea eliminada correctamente", "filas_afectadas" => $rowCount]);
                return true;
            } else {
                echo json_encode(["message" => "No se encontró el registro para eliminar", "filas_afectadas" => $rowCount]);
                return false;
            }
        } else {
            $errorInfo = $stmt->errorInfo(); // Capturar error
            echo json_encode(["message" => "Error en la eliminación", "error" => $errorInfo]);
            return false;
        }
    }
    
    
    
}
?>
