<?php 

class ProdutoModel {
    private $pdo;
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }
    public function listarProduto(){
        // get
        $stmt = $this->pdo->query("SELECT * FROM produtos");
        $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $produtos;
    }
    public function atualizarProduto($nome, $preco, $qtd, $id){
        // put
        $stmt = $this->pdo->prepare("UPDATE produtos SET nome = :nome, preco = :preco, qtd = :qtd WHERE id = :id");

        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':preco', $preco);
        $stmt->bindParam(':qtd', $qtd);
        $stmt->bindParam(':id', $id);

        $produtoAtualizado = $stmt->execute();
        return $produtoAtualizado;
    }
    public function criarProduto($nome, $preco, $qtd){
        // post
        $stmt = $this->pdo->prepare("INSERT INTO produtos (nome, preco, qtd) VALUES (:nome, :preco, :qtd)");
 
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':preco', $preco);
        $stmt->bindParam(':qtd', $qtd);

        $produtoCriado = $stmt->execute();
        return $produtoCriado;
    }
    public function deletarProduto($id){
        $stmt = $this->pdo->prepare("DELETE FROM produtos WHERE id = :id");

        $stmt->bindParam(':id', $id);

        $produtoDeletado = $stmt->execute();
        return $produtoDeletado;
    }
}