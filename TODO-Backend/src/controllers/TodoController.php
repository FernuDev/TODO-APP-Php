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

    public function updateTodo($id) {
        $data = json_decode(file_get_contents("php://input"));
    
        // Validar que el ID esté presente
        if (!isset($data->id)) {
            echo json_encode(["message" => "ID no proporcionado"]);
            return;
        }
    
        // Verificar si 'completed' está presente
        if (!isset($data->completed)) {
            echo json_encode(["message" => "El estatus de 'completed' no ha sido proporcionado"]);
            return;
        }
    
        // Validar que 'completed' sea un valor booleano
        $completed = filter_var($data->completed, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
        
        if ($completed === null) {
            echo json_encode(["message" => "Valor de 'completed' no válido"]);
            return;
        }
    
        // Solo actualizamos el campo 'completed'
        $this->todo->completed = $completed;
    
        // Llamar al método para actualizar solo el campo 'completed'
        if ($this->todo->update($data->id)) {
            echo json_encode(["message" => "Tarea actualizada"]);
        } else {
            echo json_encode(["message" => "Error al actualizar tarea"]);
        }
    }
    
    
    
    
    public function deleteTodo() {
        $data = json_decode(file_get_contents("php://input"));
    
        // Validar que venga un ID numérico
        if (!isset($data->id) || !is_numeric($data->id)) {
            echo json_encode(["message" => "ID no proporcionado o no válido"]);
            return;
        }
    
        // Asegúrate de que el ID se envía como entero
        $id = intval($data->id);
    
        if ($this->todo->delete($id)) {
            echo json_encode(["message" => "Tarea eliminada"]);
        } else {
            echo json_encode(["message" => "Error al eliminar tarea"]);
        }
    }
    
}
?>
