-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 22/12/2024 às 14:54
-- Versão do servidor: 8.3.0
-- Versão do PHP: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `health_sales`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `orcamentos`
--

DROP TABLE IF EXISTS `orcamentos`;
CREATE TABLE IF NOT EXISTS `orcamentos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cod_solicitacao` int NOT NULL,
  `id_user_visualizar` json NOT NULL,
  `id_user_editar` json NOT NULL,
  `id_tabela_precos` int NOT NULL,
  `valor_procedimento1` decimal(10,2) DEFAULT NULL,
  `valor_procedimento2` decimal(10,2) DEFAULT NULL,
  `valor_procedimento3` decimal(10,2) DEFAULT NULL,
  `valor_procedimento4` decimal(10,2) DEFAULT NULL,
  `valor_procedimento5` decimal(10,2) DEFAULT NULL,
  `valor_procedimento6` decimal(10,2) DEFAULT NULL,
  `valor_procedimento7` decimal(10,2) DEFAULT NULL,
  `valor_procedimento8` decimal(10,2) DEFAULT NULL,
  `valor_procedimento9` decimal(10,2) DEFAULT NULL,
  `valor_procedimento10` decimal(10,2) DEFAULT NULL,
  `valor_procedimento11` decimal(10,2) DEFAULT NULL,
  `valor_procedimento12` decimal(10,2) DEFAULT NULL,
  `valor_procedimento13` decimal(10,2) DEFAULT NULL,
  `valor_procedimento14` decimal(10,2) DEFAULT NULL,
  `valor_procedimento15` decimal(10,2) DEFAULT NULL,
  `status` enum('Pendente','Concluído','Cancelado') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pendente',
  PRIMARY KEY (`id`),
  KEY `cod_solicitacao` (`cod_solicitacao`),
  KEY `id_tabela_precos` (`id_tabela_precos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `solicitacoes_orcamentos`
--

DROP TABLE IF EXISTS `solicitacoes_orcamentos`;
CREATE TABLE IF NOT EXISTS `solicitacoes_orcamentos` (
  `solicitante` varchar(255) NOT NULL,
  `nome_solicitante` varchar(255) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `canal_contato` varchar(50) NOT NULL,
  `codigo_solicitacao` int NOT NULL AUTO_INCREMENT,
  `data_solicitacao` datetime DEFAULT CURRENT_TIMESTAMP,
  `protocolo` varchar(20) NOT NULL,
  `origem_orcamento` varchar(255) NOT NULL,
  `tipo_orcamento` varchar(255) NOT NULL,
  `convenio` varchar(255) NOT NULL,
  `observacoes_adicionais` text,
  `nome_paciente` varchar(255) NOT NULL,
  `data_nascimento` date NOT NULL,
  `cidade` varchar(255) NOT NULL,
  `comorbidades` tinyint(1) DEFAULT '0',
  `descricao_comorbidades` text,
  `resumo_procedimento` text,
  `detalhes_procedimento` text,
  `tempo_cirurgia` time DEFAULT NULL,
  `data_provavel` date DEFAULT NULL,
  `diarias_enfermaria` int DEFAULT '0',
  `diarias_apartamento` int DEFAULT '0',
  `diarias_uti` int DEFAULT '0',
  `anestesia_raqui` tinyint(1) DEFAULT '0',
  `anestesia_sma` tinyint(1) DEFAULT '0',
  `anestesia_peridural` tinyint(1) DEFAULT '0',
  `anestesia_sedacao` tinyint(1) DEFAULT '0',
  `anestesia_externo` tinyint(1) DEFAULT '0',
  `anestesia_bloqueio` tinyint(1) DEFAULT '0',
  `anestesia_local` tinyint(1) DEFAULT '0',
  `anestesia_outros` varchar(255) DEFAULT NULL,
  `observacoes` text,
  `status` varchar(50) DEFAULT 'Pendente',
  `id_usuario` int DEFAULT NULL,
  `arquivo_pdf` varchar(255) DEFAULT NULL,
  `urgencia` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`codigo_solicitacao`),
  UNIQUE KEY `protocolo` (`protocolo`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `solicitacoes_orcamentos`
--

INSERT INTO `solicitacoes_orcamentos` (`solicitante`, `nome_solicitante`, `telefone`, `email`, `canal_contato`, `codigo_solicitacao`, `data_solicitacao`, `protocolo`, `origem_orcamento`, `tipo_orcamento`, `convenio`, `observacoes_adicionais`, `nome_paciente`, `data_nascimento`, `cidade`, `comorbidades`, `descricao_comorbidades`, `resumo_procedimento`, `detalhes_procedimento`, `tempo_cirurgia`, `data_provavel`, `diarias_enfermaria`, `diarias_apartamento`, `diarias_uti`, `anestesia_raqui`, `anestesia_sma`, `anestesia_peridural`, `anestesia_sedacao`, `anestesia_externo`, `anestesia_bloqueio`, `anestesia_local`, `anestesia_outros`, `observacoes`, `status`, `id_usuario`, `arquivo_pdf`, `urgencia`) VALUES
('medico', 'HUGO MOREIRA BARBOSA BARBOSA', '66984442055', 'hugomoreirabarbosa2@gmail.com', 'telefone', 1, '2024-12-14 11:16:45', 'PRT346192', '', 'cirurgia', 'nenhum', NULL, 'HUGO MOREIRA BARBOSA', '2024-10-01', 'Sinop', 0, 'Teste Comorbidades', 'Teste Resumo', 'Teste Descrição', '00:00:13', '2024-12-27', 3, 2, 1, 1, 0, 0, 0, 0, 0, 1, 'Teste Anestesia', 'Teste Obs', 'Aguardando', 5, NULL, 0),
('medico', 'Teste Teste', 'Teste', 'teste@gmail.com', 'email', 2, '2024-12-19 15:48:14', 'PRT968288', '', 'cirurgia', 'particular', NULL, 'Teste', '2024-12-13', 'Teste', 0, 'Teste', 'Teste', 'Teste', '00:00:02', '2024-12-12', 1, 2, 3, 1, 0, 0, 0, 0, 1, 0, 'Teste Anestesia', 'Teste', 'Aguardando', 5, NULL, 0),
('medico', 'HUGO MOREIRA BARBOSA BARBOSA', '66984442055', 'hugomoreirabarbosa2@gmail.com', 'telefone', 3, '2024-12-19 18:46:27', 'PRT742561', '', 'cirurgia', 'particular', NULL, 'aaaa', '2024-12-05', 'Sinop', 0, 'Descr', 'aaaa', 'aaaa', '00:00:02', '2024-12-26', 1, 1, 1, 1, 0, 0, 0, 1, 0, 0, 'Teste Anestesia', 'aaaaa', 'Aguardando', 5, NULL, 0),
('medico', ' BARBOSA', '', '', 'telefone', 5, '2024-12-21 14:04:43', 'PRT591743', '', 'cirurgia', 'nenhum', NULL, 'Baral', '2024-12-13', 'Sinop', 0, '', 'Aaaaaa', 'Aaaaaaaaaaaaaaaaaaaaaaa', '00:00:01', '2024-12-31', 1, 1, 1, 1, 0, 0, 1, 0, 0, 0, '', 'aaa', 'Pendente', NULL, 'uploads/6766f52b7cef8.pdf', 0),
('paciente', ' Barbosa', '', '', 'email', 6, '2024-12-21 15:13:36', 'PRT303686', '', 'cirurgia', 'cartaoDesconto', NULL, 'Elias Moreira', '2024-12-02', 'Sinop', 0, '', 'aaaaa', '', '00:00:00', '2024-12-31', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 'aaa', 'Pendente', NULL, 'uploads/67670550adb14.pdf', 1),
('medico', ' Barbosa', '', '', 'email', 7, '2024-12-21 15:15:12', 'PRT217796', '', 'cirurgia', 'cartaoDesconto', NULL, 'Elias Moreira', '2024-12-13', 'Sinop', 0, '', 'aaaa', 'aaaaa', '00:00:01', '2024-12-28', 1, 1, 0, 1, 0, 0, 0, 0, 0, 0, '', 'aaa', 'Pendente', NULL, 'uploads/676705b06c903.pdf', 1);

--
-- Acionadores `solicitacoes_orcamentos`
--
DROP TRIGGER IF EXISTS `before_insert_solicitacoes_orcamentos`;
DELIMITER $$
CREATE TRIGGER `before_insert_solicitacoes_orcamentos` BEFORE INSERT ON `solicitacoes_orcamentos` FOR EACH ROW BEGIN
    SET NEW.protocolo = CONCAT('PRT', LPAD(FLOOR(RAND() * 1000000), 6, '0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tabela_de_precos`
--

DROP TABLE IF EXISTS `tabela_de_precos`;
CREATE TABLE IF NOT EXISTS `tabela_de_precos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome_tabela` varchar(255) NOT NULL,
  `procedimento1` decimal(10,2) DEFAULT NULL,
  `procedimento2` decimal(10,2) DEFAULT NULL,
  `procedimento3` decimal(10,2) DEFAULT NULL,
  `procedimento4` decimal(10,2) DEFAULT NULL,
  `procedimento5` decimal(10,2) DEFAULT NULL,
  `procedimento6` decimal(10,2) DEFAULT NULL,
  `procedimento7` decimal(10,2) DEFAULT NULL,
  `procedimento8` decimal(10,2) DEFAULT NULL,
  `procedimento9` decimal(10,2) DEFAULT NULL,
  `procedimento10` decimal(10,2) DEFAULT NULL,
  `procedimento11` decimal(10,2) DEFAULT NULL,
  `procedimento12` decimal(10,2) DEFAULT NULL,
  `procedimento13` decimal(10,2) DEFAULT NULL,
  `procedimento14` decimal(10,2) DEFAULT NULL,
  `procedimento15` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `tabela_de_precos`
--

INSERT INTO `tabela_de_precos` (`id`, `nome_tabela`, `procedimento1`, `procedimento2`, `procedimento3`, `procedimento4`, `procedimento5`, `procedimento6`, `procedimento7`, `procedimento8`, `procedimento9`, `procedimento10`, `procedimento11`, `procedimento12`, `procedimento13`, `procedimento14`, `procedimento15`) VALUES
(1, 'Tabela 1', 45.00, 28.00, 20.00, 46.00, 32.00, 65.00, 120.00, 78.00, 14.00, 19.00, 25.00, 33.00, 15.00, 12.00, 124.00),
(5, 'Tabela 2', 28.00, 20.00, 46.00, 32.00, 65.00, 120.00, 78.00, 14.00, 19.00, 25.00, 33.00, 15.00, 12.00, 124.00, 74.50),
(6, 'Tabela Teste', 10.50, 25.00, 15.00, 14.75, 75.00, 50.00, 120.00, 99.99, 78.00, 65.00, 89.50, 71.00, 125.00, 100.99, 69.90);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(140) NOT NULL,
  `senha` varchar(16) NOT NULL,
  `usuario` varchar(140) DEFAULT NULL,
  `acesso` varchar(50) DEFAULT 'Externo',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `senha`, `usuario`, `acesso`) VALUES
(3, 'admin@admin', 'admin', 'Administrador', 'Administrador'),
(4, 'hugomoreirabarbosa2@gmail.com', '1234', 'Hugo', 'Externo'),
(5, 'agente@gmail.com', '1234', 'Agente', 'Agente');

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `orcamentos`
--
ALTER TABLE `orcamentos`
  ADD CONSTRAINT `orcamentos_ibfk_1` FOREIGN KEY (`cod_solicitacao`) REFERENCES `solicitacoes_orcamentos` (`codigo_solicitacao`),
  ADD CONSTRAINT `orcamentos_ibfk_2` FOREIGN KEY (`id_tabela_precos`) REFERENCES `tabela_de_precos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
