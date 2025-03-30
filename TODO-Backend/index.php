<?php
// Habilitar CORS
header("Access-Control-Allow-Origin: *");  // Permite todas las solicitudes de cualquier origen
header("Access-Control-Allow-Methods: GET, POST, PATCH, DELETE, OPTIONS");  // Permite estos métodos
header("Access-Control-Allow-Headers: Content-Type, Authorization");  // Permite estos encabezados

// Si es una solicitud OPTIONS (pre-vuelo), respondemos con un 200 OK
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit;
}

require_once __DIR__ . '/src/config/Database.php';
require_once __DIR__ . '/src/models/Todo.php';
require_once __DIR__ . '/src/controllers/TodoController.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

$controller = new TodoController();

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if (isset($uri[2])) {
            $controller->getTodoById($uri[2]);
        } else {
            $controller->getAllTodos();
        }
        break;
    case 'POST':
        $controller->createTodo();
        break;
    case 'PATCH':
        $controller->updateTodo($uri[1]);
        break;
    case 'DELETE':
        $controller->deleteTodo($uri[2]);
        break;
    default:
        http_response_code(405);
        echo json_encode(["message" => "Método no permitido"]);
        break;
}
