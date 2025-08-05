CRUD de Produtos
Este projeto é um sistema simples de cadastro de produtos (CRUD) feito com PHP no backend e HTML/CSS/JavaScript no frontend. Ele permite cadastrar, listar e excluir produtos de forma prática e rápida.

Funcionalidades
Cadastro de produtos (nome, quantidade, preço)
Listagem de todos os produtos cadastrados
Exclusão de produtos
Integração frontend-backend via API RESTful
Backend estruturado em MVC
Página 404 personalizada
Tecnologias Utilizadas
PHP (com PDO para acesso ao banco de dados)
HTML5, CSS3 e JavaScript puro
Banco de dados MySQL/MariaDB
Fetch API para comunicação assíncrona

Como Executar

Clone o repositório:

git clone https://github.com/seu-usuario/seu-repositorio.git

Configure o banco de dados:

Crie um banco de dados chamado loja e uma tabela produtos

CREATE TABLE produtos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(255) NOT NULL,
  preco DECIMAL(10,2) NOT NULL,
  qtd INT NOT NULL
);

Ajuste as credenciais do banco em api/config/db.php.
Inicie o servidor PHP:

cd loja/api
php -S localhost:8000

loja/
│
├── index.html                # Frontend
└── api/
    ├── index.php             # Roteador principal da API
    ├── controllers/
    │   └── ProdutoController.php
    ├── models/
    │   └── ProdutoModel.php
    ├── config/
    │   └── db.php
    └── 404.php               # Página de erro personalizada
