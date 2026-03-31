CREATE DATABASE smile_system;
USE smile_system;

CREATE TABLE agendamentos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  nascimento DATE NOT NULL,
  email VARCHAR(100) NOT NULL,
  telefone VARCHAR(20) NOT NULL,
  data_agendada TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
