CREATE DATABASE DB_reporte;
USE DB_reporte;

CREATE TABLE usuarios (
	id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    senha VARCHAR(50) NOT NULL
);

CREATE TABLE ocorrencias (

	id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    titulo VARCHAR(50) NOT NULL,
    localizacao VARCHAR(100) NOT NULL,
    statusP INT NOT NULL,
    dataRegistro DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    responsavel VARCHAR(100),
    detalhes TEXT
);



-- Inserindo os Usuários

INSERT INTO usuarios (nome, email, senha) VALUES
('Gabriel', 'gabriel123@gmail.com', 'gabriel123');




