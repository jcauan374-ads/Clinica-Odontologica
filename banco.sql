-- Banco de dados da Clínica Odontológica
-- Compatível com MySQL 8.0+

CREATE DATABASE IF NOT EXISTS smile_system
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE smile_system;

CREATE TABLE IF NOT EXISTS agendamentos (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  nome VARCHAR(120) NOT NULL,
  nascimento DATE NOT NULL,
  email VARCHAR(160) NOT NULL,
  telefone VARCHAR(20) NOT NULL,
  data_consulta DATE NOT NULL,
  hora_consulta TIME NOT NULL,
  status ENUM('pendente', 'confirmado', 'cancelado', 'concluido') NOT NULL DEFAULT 'pendente',
  observacoes VARCHAR(500) NULL,
  criado_em TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  atualizado_em TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY uq_agendamento_horario (data_consulta, hora_consulta),
  KEY idx_agendamentos_email (email),
  KEY idx_agendamentos_status_data (status, data_consulta),
  CONSTRAINT chk_nascimento_antes_consulta CHECK (nascimento < data_consulta)
) ENGINE=InnoDB;

-- Para consultar horários ocupados:
-- SELECT data_consulta, hora_consulta
-- FROM agendamentos
-- WHERE status IN ('pendente', 'confirmado')
--   AND data_consulta >= CURRENT_DATE()
-- ORDER BY data_consulta, hora_consulta;
