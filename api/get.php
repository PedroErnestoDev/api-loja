<?php
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['error' => 'Método não permitido, use GET']);
    exit;
}

header("Content-Type: application/json");

require "../config/db.php";

$db = new db();
$conn = $db->conexao();

$stmt = $conn->query("SELECT * FROM produtos");
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($produtos);