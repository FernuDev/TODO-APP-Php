<?php
require_once __DIR__ . '/../config/Database.php'; // Ajusta el path según tu estructura

class TodoController {
    private $todo;

    public function __construct() {
        $db = new Database();
        $this->todo = new Todo($db->getConnection()); // Usar getConnection()
    }
    

    public function getAllTodos() {
        $stmt = $this->todo->getAll();
        $todos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($todos);
    }

    public function createTodo() {
        $data = json_decode(file_get_contents("php://input"));
        $this->todo->title = $data->title;
        $this->todo->completed = $data->completed;

        if ($this->todo->create()) {
            echo json_encode(["message" => "Tarea creada"]);
        } else {
            echo json_encode(["message" => "Error al crear tarea" + "\n"]);
        }
    }

    public function updateTodo() {
        $data = json_decode(file_get_contents("php://input"));
    
        // Validamos que venga un ID
        if (!isset($data->id)) {
            echo json_encode(["message" => "ID no proporcionado"]);
            return;
        }
    
        $this->todo->title = $data->title;
        $this->todo->completed = filter_var($data->completed, FILTER_VALIDATE_BOOLEAN);
    
        if ($this->todo->update($data->id)) {
            echo json_encode(["message" => "Tarea actualizada"]);
        } else {
            echo json_encode(["message" => "Error al actualizar tarea"]);
        }
    }
    
}
?>
