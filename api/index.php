<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Se for um pré-flight (OPTIONS), responde e sai
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}
require_once __DIR__ . '/./controllers/ProdutoController.php';
require __DIR__ . "/../config/db.php";

$path = explode('/', trim($_SERVER['REQUEST_URI'], '/')); 
// Exemplo: /api/users/5
$resource = $path[1] ?? null;  // 'users'
$id = $path[2] ?? null;
$method = $_SERVER['REQUEST_METHOD'];

$db = new db();
$conn = $db->conexao();

switch ($resource) {
    case 'produtos':
        $controller = new ProdutoController($conn);
        switch ($method) {
            case 'GET':
                $controller->getAll();
                break;
            case 'POST':
                $controller->create();
                break;
            case 'PUT':
                $controller->update($id);
                break;
            case 'DELETE':
                $controller->delete($id);
                break;
            default:
                http_response_code(405);
                echo json_encode(['error' => 'Method not allowed']);
        }
        break;

    default:
        http_response_code(404);
        header("location: ./404.php");
}