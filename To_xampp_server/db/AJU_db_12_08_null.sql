-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 12/08/2025 às 15:12
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ajundeai`
--
CREATE DATABASE IF NOT EXISTS `ajundeai` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `ajundeai`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `ong`
--

CREATE TABLE `ong` (
  `id` int(11) NOT NULL,
  `nome_ong` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `senha` varchar(20) NOT NULL,
  `sobre` varchar(1000) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `whatsapp` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `ong`
--

INSERT INTO `ong` (`id`, `nome_ong`, `email`, `senha`, `sobre`, `telefone`, `whatsapp`) VALUES
(1, 'ONGAY', 'brunogay@gmail.com', '123', '1112131231', '11111111111', '5511111111111'),
(2, 'rgjuihrdgnh', 'brunogay@gmail.com', '123', '111111111111111111', '11111111111', '5511111111111');

-- --------------------------------------------------------

--
-- Estrutura para tabela `registro`
--

CREATE TABLE `registro` (
  `id` int(11) NOT NULL,
  `id_vaga` int(11) DEFAULT NULL,
  `id_voluntario` int(11) DEFAULT NULL,
  `categoria_registro` enum('salvo','cadastrado') DEFAULT NULL,
  `situacao` enum('aguarde','aprovado','negado','nada') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `registro`
--

INSERT INTO `registro` (`id`, `id_vaga`, `id_voluntario`, `categoria_registro`, `situacao`) VALUES
(3, 1, 1, 'cadastrado', 'aguarde'),
(5, 2, 1, 'cadastrado', 'aguarde'),
(7, 3, 1, 'cadastrado', 'aguarde');

-- --------------------------------------------------------

--
-- Estrutura para tabela `vaga`
--

CREATE TABLE `vaga` (
  `id` int(11) NOT NULL,
  `id_ong` int(11) DEFAULT NULL,
  `nome` varchar(200) NOT NULL,
  `categoria_vaga` varchar(100) NOT NULL,
  `localizacao` varchar(100) DEFAULT NULL,
  `descr_obj` varchar(200) DEFAULT NULL,
  `descr_total` varchar(1000) DEFAULT NULL,
  `quant_limite` int(11) DEFAULT NULL,
  `quant_atual` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `vaga`
--

INSERT INTO `vaga` (`id`, `id_ong`, `nome`, `categoria_vaga`, `localizacao`, `descr_obj`, `descr_total`, `quant_limite`, `quant_atual`) VALUES
(1, 1, 'Peida nao xerequinha', 'xereca', 'peido', '12412', '41234', 30, 1),
(2, 1, '31241', '4134', '41234', '123423', '41234314', 134134, 1),
(3, 1, 'senhor dos anais', 'anal', 'cu', '4234', '1234324', 2147483647, 1),
(4, 1, 'harry potter', 'platão', 'hogwarts', '2141234', '1234234', 69, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `voluntario`
--

CREATE TABLE `voluntario` (
  `id` int(11) NOT NULL,
  `nome_voluntario` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `senha` varchar(20) NOT NULL,
  `sobre` varchar(1000) NOT NULL,
  `whatsapp` varchar(20) DEFAULT NULL,
  `quant_cadastro` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `voluntario`
--

INSERT INTO `voluntario` (`id`, `nome_voluntario`, `email`, `telefone`, `senha`, `sobre`, `whatsapp`, `quant_cadastro`) VALUES
(1, 'GOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOZEI', 'gozaemmimbolsonaro@gmail.com', '11111111111', '123', '1234412', '5511111111111', 3);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `ong`
--
ALTER TABLE `ong`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome_ong` (`nome_ong`);

--
-- Índices de tabela `registro`
--
ALTER TABLE `registro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_vaga` (`id_vaga`),
  ADD KEY `id_voluntario` (`id_voluntario`);

--
-- Índices de tabela `vaga`
--
ALTER TABLE `vaga`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ong` (`id_ong`);

--
-- Índices de tabela `voluntario`
--
ALTER TABLE `voluntario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome_voluntario` (`nome_voluntario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `ong`
--
ALTER TABLE `ong`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `registro`
--
ALTER TABLE `registro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `vaga`
--
ALTER TABLE `vaga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `voluntario`
--
ALTER TABLE `voluntario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `registro`
--
ALTER TABLE `registro`
  ADD CONSTRAINT `registro_ibfk_1` FOREIGN KEY (`id_vaga`) REFERENCES `vaga` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `registro_ibfk_2` FOREIGN KEY (`id_voluntario`) REFERENCES `voluntario` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `vaga`
--
ALTER TABLE `vaga`
  ADD CONSTRAINT `vaga_ibfk_1` FOREIGN KEY (`id_ong`) REFERENCES `ong` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
