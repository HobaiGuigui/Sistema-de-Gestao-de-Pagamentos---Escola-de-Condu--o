-- phpMyAdmin SQL Dump
-- Database: `escola_conducao_3agosto`

CREATE DATABASE IF NOT EXISTS `escola_conducao_3agosto` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `escola_conducao_3agosto`;

-- --------------------------------------------------------

--
-- Table structure for table `utilizadores`
--

CREATE TABLE `utilizadores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha_hash` varchar(255) NOT NULL,
  `criado_em` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert Default Admin (Password in plain text: admin123)
INSERT INTO `utilizadores` (`nome`, `email`, `senha_hash`) VALUES
('Administrador Geral', 'nick@escola3agosto.com', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `categorias_cursos`
--

CREATE TABLE `categorias_cursos` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `nome_categoria` varchar(50) NOT NULL,
  `preco_total` decimal(10,2) NOT NULL,
  `descricao` text,
  `duracao_meses` int(11) NOT NULL DEFAULT '3',
  `estado` enum('ativo','inativo') NOT NULL DEFAULT 'ativo',
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert Default Categories
INSERT INTO `categorias_cursos` (`nome_categoria`, `preco_total`, `descricao`, `duracao_meses`) VALUES
('Categoria A (Motociclos)', '90000.00', 'Carta de condução para motociclos', 3),
('Categoria B (Ligeiros Profissional)', '123000.00', 'Carta de condução para veículos ligeiros', 3),
('Categoria C (Pesados)', '150000.00', 'Carta de condução para veículos pesados de mercadorias', 3),
('Categoria D (Passageiros)', '180000.00', 'Carta de condução para veículos pesados de passageiros', 3);

-- --------------------------------------------------------

--
-- Table structure for table `estudantes`
--

CREATE TABLE `estudantes` (
  `id_estudante` int(11) NOT NULL AUTO_INCREMENT,
  `nome_completo` varchar(150) NOT NULL,
  `sexo` enum('M','F') NOT NULL,
  `data_nascimento` date NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `endereco` varchar(255) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `data_inscricao` date NOT NULL,
  `data_inicio_curso` date DEFAULT NULL,
  `data_fim_curso` date DEFAULT NULL,
  `estado` enum('ativo','concluido','desistente') NOT NULL DEFAULT 'ativo',
  PRIMARY KEY (`id_estudante`),
  KEY `categoria_id` (`categoria_id`),
  CONSTRAINT `estudantes_fk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias_cursos` (`id_categoria`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pagamentos`
--

CREATE TABLE `pagamentos` (
  `id_pagamento` int(11) NOT NULL AUTO_INCREMENT,
  `estudante_id` int(11) NOT NULL,
  `valor_pago` decimal(10,2) NOT NULL,
  `data_pagamento` date NOT NULL,
  `forma_pagamento` enum('dinheiro','transferencia','cartao') NOT NULL,
  `observacao` varchar(255) DEFAULT NULL,
  `registado_por` int(11) DEFAULT NULL, -- Optional tracking of who recorded the payment
  PRIMARY KEY (`id_pagamento`),
  KEY `estudante_id` (`estudante_id`),
  CONSTRAINT `pagamentos_fk_1` FOREIGN KEY (`estudante_id`) REFERENCES `estudantes` (`id_estudante`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Views and Dynamic tables/queries are done directly from models. The requested `relatorios` was not explicitly requested as a table to store data, 
-- but rather a function of the system. However, for audit, we could add logs, but it's not strictly necessary according to the initial proposal.
