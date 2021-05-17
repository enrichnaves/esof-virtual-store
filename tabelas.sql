-- Geração de Modelo físico
-- Sql ANSI 2003 - brModelo.



CREATE TABLE usuarios (
cpf varchar(14) PRIMARY KEY,
endereco varchar(100),
senha varchar(255),
telefone varchar(13),
nome varchar(100),
usuario varchar(16) UNIQUE
);

CREATE TABLE admins (
login varchar(10) PRIMARY KEY,
senha varchar(255)
);

CREATE TABLE produto (
id integer PRIMARY KEY,
nome varchar(100),
preco decimal
);

CREATE TABLE compra (
id_compra serial PRIMARY KEY ,
id_produtos varchar(100),
data_compra varchar(30),
valor decimal,
num_cartao varchar(19),
cvv integer,
val_cartao date,
cpf varchar(14),
FOREIGN KEY(cpf) REFERENCES usuarios(cpf)
);