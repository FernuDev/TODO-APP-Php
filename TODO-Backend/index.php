<?php
header("Content-Type: application/json");

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
    case 'PUT':
        $controller->updateTodo($uri[2]);
        break;
    case 'DELETE':
        if (isset($uri[2])) {
            $controller->deleteTodo($uri[2]);
        }
        break;
    default:
        http_response_code(405);
        echo json_encode(["message" => "Método no permitido"]);
        break;
}
