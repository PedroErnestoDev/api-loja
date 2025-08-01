<?php 

if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
    http_response_code(405);
    echo json_encode(['error' => 'Método não permitido, use PUT']);
    exit;
}

require "../config/db.php";

$db = new db();
$conn = $db->conexao();

$data = json_decode(file_get_contents("php://input"));

if (!isset($data->id) || !isset($data->nome) || !isset($data->preco) || !isset($data->qtd)) {
    http_response_code(400);
    echo json_encode(['error' => 'Campos obrigatórios: id, nome, preco, qtd']);
    exit;
}


$sql = "UPDATE produtos SET nome = :nome, preco = :preco, qtd = :qtd WHERE id = :id";
$stmt = $conn->prepare($sql);

$stmt->bindParam(':nome', $data->nome);
$stmt->bindParam(':preco', $data->preco);
$stmt->bindParam(':qtd', $data->qtd);
$stmt->bindParam(':id', $data->id);

if ($stmt->execute()) {
    http_response_code(201);
    echo json_encode(['mensagem' => 'Produto atualizado com sucesso']);
} else {
    http_response_code(500);
    echo json_encode(['erro' => 'Erro ao atualizar produto']);
}