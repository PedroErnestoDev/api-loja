<?php

require_once __DIR__ . "/../models/ProdutoModel.php";

class ProdutoController {
    private $model;

    public function __construct($pdo)
    {
        $this->model = new ProdutoModel($pdo); 
    }

    public function getAll(){
        $data = $this->model->listarProduto();
        return $this->respond($data);
    }

    public function create() {
        $input = json_decode(file_get_contents('php://input'), true);
        $nome = $input["nome"];
        $preco = $input["preco"];
        $qtd = $input["qtd"];
        if (!$this->validate($input)) return $this->respond(['error' => 'Invalid data'], 400);
        $success = $this->model->criarProduto($nome, $preco, $qtd);
        return $this->respond(['success' => $success], $success ? 201 : 500);
    }

    public function update($id) {
        if (!$id) return $this->respond(['error' => 'ID required'], 400);
        $input = json_decode(file_get_contents('php://input'), true);
        $nome = $input["nome"];
        $preco = $input["preco"];
        $qtd = $input["qtd"];
        if (!$this->validate($input)) return $this->respond(['error' => 'Invalid data'], 400);
        $success = $this->model->atualizarProduto($nome, $preco, $qtd, $id);
        return $this->respond(['success' => $success], $success ? 200 : 500);
    }

    public function delete($id) {
        if (!$id) return $this->respond(['error' => 'ID required'], 400);
        $success = $this->model->deletarProduto($id);
        return $this->respond(['success' => $success], $success ? 200 : 500);
    }

    private function respond($data, $status = 200) {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    private function validate($data) {
        return true;
    }
}
