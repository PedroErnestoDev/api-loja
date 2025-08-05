Primeiros Passos Para Testar a API

CREATE DATABASE loja;

USE loja;

CREATE TABLE produtos(
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome varchar(250),
  preco decimal(10, 2),
  qtd INT
)

METODO GET

Apenas use o GET,

METODO POST

{
  "nome":"Camisa Verde",
  "preco":"39.99",
  "qtd":"10"
}

METODO PUT

O id deve ser oque aparecer na consulta do get.

{
  "id":"1",
  "nome":"Camisa Verde",
  "preco":"38.99",
  "qtd":"5"
}

METODO DELETE

O id deve ser oque aparecer na consulta do get.

{
  "id":"1",
}
