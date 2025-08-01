<?php 

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Método não permitido, use POST']);
    exit;
}

require "../config/db.php";

$db = new db();
$conn = $db->conexao();

$data = json_decode(file_get_contents("php://input"));

if (!isset($data->nome) || !isset($data->preco) || !isset($data->qtd)) {
    http_response_code(400);
    echo json_encode(['error' => 'Campos obrigatórios: nome, preco, qtd']);
    exit;
}

$sql = "INSERT INTO produtos (nome, preco, qtd) VALUES (:nome, :preco, :qtd)";
$stmt = $conn->prepare($sql);

$stmt->bindParam(':nome', $data->nome);
$stmt->bindParam(':preco', $data->preco);
$stmt->bindParam(':qtd', $data->qtd);

if ($stmt->execute()) {
    http_response_code(201);
    echo json_encode(['mensagem' => 'Produto cadastrado com sucesso']);
} else {
    http_response_code(500);
    echo json_encode(['erro' => 'Erro ao cadastrar produto']);
}