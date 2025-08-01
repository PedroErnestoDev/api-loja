<?php 

if ($_SERVER['REQUEST_METHOD'] !== "DELETE") {
    http_response_code(405);
    echo json_encode(['error' => 'Método não permitido, use DELETE']);
    exit;
}

require "../config/db.php";

$db = new db();
$conn = $db->conexao();

$data = json_decode(file_get_contents("php://input"));

if (!isset($data->id)) {
    http_response_code(400);
    echo json_encode(['error' => 'Campos obrigatórios: id']);
    exit;
}

$sql = "DELETE FROM produtos WHERE id = :id";
$stmt = $conn->prepare($sql);

$stmt->bindParam(':id', $data->id);

if ($stmt->execute()) {
    http_response_code(201);
    echo json_encode(['mensagem' => 'Produto deletado com sucesso']);
} else {
    http_response_code(500);
    echo json_encode(['erro' => 'Erro ao deletar produto']);
}