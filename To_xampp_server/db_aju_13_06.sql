-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 13/06/2025 às 14:28
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
  `nome_ong` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `senha` varchar(20) NOT NULL,
  `sobre` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `ong`
--

INSERT INTO `ong` (`id`, `nome_ong`, `email`, `senha`, `sobre`) VALUES
(1, 'ONGguacamole', 'guacamoleongs@gmail.com', '123', 'gostamos de comer guacamole e rola mole'),
(2, 'ONGpitaya', 'pitayasongs@gmail.com', '123', 'gostamos de comer pitaya e a zendaya casou com o tom roludo'),
(3, 'Projeto Vida Nova', 'vidanova@email.com', 'senha123', 'Trabalhamos com resgates de animais abandonados e promoção de adoção responsável.'),
(4, 'Cidadania em Ação', 'cidadania@email.com', 'senha456', 'Atuamos em comunidades carentes, promovendo educação e cidadania.'),
(5, 'Mãos que Ajudam', 'maosajudam@email.com', 'senha789', 'Fornecemos apoio psicológico e material para famílias em situação de vulnerabilidade social.'),
(6, 'EcoVida', 'ecovida@email.com', 'senha101112', 'Projetos voltados à preservação ambiental e sustentabilidade em áreas urbanas.'),
(7, 'Sorriso do Futuro', 'sorrisodofuturo@email.com', 'senha131415', 'Focamos em projetos educacionais para crianças e adolescentes em risco.'),
(8, 'Refúgio Esperança', 'refugioesperanca@email.com', 'senha161718', 'Abrigo de apoio a mulheres em situação de violência doméstica e seus filhos.'),
(9, 'Caminho da Paz', 'caminhopaz@email.com', 'senha192021', 'Apoiamos comunidades em conflito, promovendo a resolução pacífica de disputas.'),
(10, 'Amigos do Meio Ambiente', 'amigosmeioambiente@email.com', 'senha222324', 'Realizamos plantios e preservação de áreas verdes em zonas urbanas.'),
(11, 'Esperança na Rua', 'esperancanarua@email.com', 'senha252627', 'Oferecemos assistência a moradores de rua, com alimentação e apoio psicossocial.'),
(12, 'Nova Chance', 'novachance@email.com', 'senha282930', 'Ajudamos ex-detentos a se reintegrar à sociedade através de cursos e trabalho.');

-- --------------------------------------------------------

--
-- Estrutura para tabela `registro`
--

CREATE TABLE `registro` (
  `id` int(11) NOT NULL,
  `id_vaga` int(11) DEFAULT NULL,
  `id_voluntario` int(11) DEFAULT NULL,
  `categoria_registro` enum('salvo','cadastrado') DEFAULT NULL,
  `situacao` enum('aguarde','aprovado','negado') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(25, 1, 'Evento Cultural Jundiaí', 'Eventos', 'Centro', 'Organizar evento cultural com apresentações artísticas locais', 'Evento com 20 apresentações culturais', 20, 18),
(26, 2, 'Adoção Responsável', 'Animais', 'Vila Arens', 'Promover a adoção responsável de animais resgatados', 'Adoção de 15 animais', 15, 12),
(27, 3, 'Educação para Todos', 'Educação', 'Jardim Bonfiglioli', 'Oferecer aulas de reforço escolar para crianças em situação de vulnerabilidade', 'Aulas de reforço para 30 crianças', 30, 25),
(28, 4, 'Recuperação Ambiental', 'Meio Ambiente', 'Parque da Cidade', 'Realizar plantio de árvores nativas para recuperação ambiental', 'Plantio de 100 árvores nativas', 100, 85),
(29, 5, 'Brincando e Aprendendo', 'Crianças', 'Jardim Paulista', 'Oferecer atividades recreativas e educativas para crianças', 'Atividades para 50 crianças', 50, 45),
(30, 6, 'Inovação Digital', 'Tecnologia', 'Jardim Cica', 'Promover oficinas de programação para jovens', 'Oficinas para 20 jovens', 20, 18),
(31, 7, 'Saúde Preventiva', 'Saúde', 'Vila Progresso', 'Realizar campanhas de conscientização sobre saúde preventiva', 'Campanhas para 200 pessoas', 200, 180),
(32, 8, 'Apoio Social', 'Assistência Social', 'Vila Esperança', 'Oferecer suporte psicológico para famílias em situação de vulnerabilidade', 'Atendimentos para 40 famílias', 40, 35),
(33, 9, 'Gestão Eficiente', 'Administração', 'Centro', 'Implementar práticas de gestão eficiente em organizações sociais', 'Treinamentos para 10 gestores', 10, 8),
(34, 10, 'Feira de Artesanato', 'Eventos', 'Vila Arens II', 'Organizar feira de artesanato com participação de artesãos locais', 'Feira com 30 estandes', 30, 28),
(35, 11, 'Cuidados Veterinários', 'Animais', 'Jardim Ana Maria', 'Oferecer serviços veterinários gratuitos para animais de rua', 'Atendimentos para 100 animais', 100, 90),
(36, 12, 'Tecnologia para Todos', 'Tecnologia', 'Jardim Santa Adélia', 'Oferecer cursos de informática básica para idosos', 'Cursos para 15 idosos', 15, 12);

-- --------------------------------------------------------

--
-- Estrutura para tabela `voluntario`
--

CREATE TABLE `voluntario` (
  `id` int(11) NOT NULL,
  `nome_voluntario` varchar(200) NOT NULL,
  `email` varchar(150) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `senha` varchar(20) NOT NULL,
  `sobre` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `voluntario`
--

INSERT INTO `voluntario` (`id`, `nome_voluntario`, `email`, `telefone`, `senha`, `sobre`) VALUES
(1, 'Ana Carolina Silva', 'ana.silva@email.com', '(11) 98765-4321', 'An@2023!', 'Estudante de Serviço Social que ama ajudar pessoas em situação de vulnerabilidade'),
(2, 'Carlos Eduardo Santos', 'carlos.santos@email.com', '(21) 99876-5432', 'C@rl0s_2023', 'Engenheiro aposentado buscando contribuir com projetos sociais'),
(3, 'Mariana Oliveira', 'mariana.oliveira@email.com', '(31) 98765-1234', 'M@ri2024', 'Professora que deseja voluntariar nas horas vagas'),
(4, 'João Pedro Almeida', 'joao.almeida@email.com', '(41) 91234-5678', 'J0@oP3dr0', 'Estudante de medicina interessado em ações de saúde comunitária'),
(5, 'Luiza Fernandes Costa', 'luiza.costa@email.com', '(51) 92345-6789', 'LuiZA#99', 'Designer gráfica que quer usar suas habilidades para causas sociais'),
(6, 'Rafael Gonçalves', 'rafael.goncalves@email.com', '(85) 93456-7890', 'R@fael123', 'Profissional de TI buscando ajudar ONGs com tecnologia'),
(7, 'Fernanda Lima', 'fernanda.lima@email.com', '(71) 94567-8901', 'F3rn@nda!', 'Aposentada que dedica seu tempo a projetos de cuidado com idosos'),
(8, 'Lucas Martins', 'lucas.martins@email.com', '(48) 95678-9012', 'LucasM@rt', 'Educador físico voluntário em projetos esportivos para jovens'),
(9, 'Juliana Ribeiro', 'juliana.ribeiro@email.com', '(61) 96789-0123', 'JuL!2023', 'Advogada atuando em projetos de assistência jurídica gratuita'),
(10, 'Pedro Henrique Souza', 'pedro.souza@email.com', '(92) 97890-1234', 'P3dr0S0uza', 'Estudante de veterinária que ajuda em projetos de proteção animal'),
(11, 'Amanda Torres', 'amanda.torres@email.com', '(19) 98901-2345', '@mAndaT1', 'Psicóloga oferecendo apoio emocional em projetos sociais'),
(12, 'Rodrigo Neves', 'rodrigo.neves@email.com', '(27) 99012-3456', 'R0driG0*', 'Chef de cozinha voluntário em projetos de alimentação solidária');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `ong`
--
ALTER TABLE `ong`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome_ong`);

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
  ADD UNIQUE KEY `nome` (`nome`),
  ADD KEY `id_ong` (`id_ong`);

--
-- Índices de tabela `voluntario`
--
ALTER TABLE `voluntario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome_voluntario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `ong`
--
ALTER TABLE `ong`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `registro`
--
ALTER TABLE `registro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `vaga`
--
ALTER TABLE `vaga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de tabela `voluntario`
--
ALTER TABLE `voluntario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
