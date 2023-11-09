-- Cria o banco de dados se ele não existir
CREATE DATABASE IF NOT EXISTS imc_db;

-- Seleciona o banco de dados
USE imc_db;

-- Cria a tabela se ela não existir
CREATE TABLE IF NOT EXISTS pessoas (
    nome VARCHAR(50) NOT NULL,
    idade INT NOT NULL,
    altura DECIMAL(4,2) NOT NULL,
    peso DECIMAL(5,2) NOT NULL,
    imc DECIMAL(4,2) NOT NULL
);

-- Insere os dados da pessoa na tabela
INSERT INTO pessoas (nome, idade, altura, peso, imc)
VALUES ('João', 25, 1.75, 80.5, 26.29);

-- Exibe os dados da tabela
SELECT * FROM pessoas;