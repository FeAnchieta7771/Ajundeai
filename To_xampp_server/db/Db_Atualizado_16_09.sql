-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 16/09/2025 às 13:25
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
(16, 'ONG Amigos do Meio Ambiente', 'contato@ongamigosdoambiente.org', 'greenpass123', 'Dedicada à preservação de ecossistemas locais, plantio de árvores e conscientização ambiental.', '11987654321', '5511987654321'),
(17, 'Instituto Esperança Viva', 'faleconosco@esperancaviva.com', 'esperanca_2024', 'Focada em oferecer apoio psicológico e social para crianças em situação de vulnerabilidade.', '21998765432', '5521998765432'),
(18, 'Cão e Gato Solidário', 'ajuda@caosolidario.com', 'miau_auau!', 'Resgate e reabilitação de animais abandonados, além de campanhas de adoção responsável.', '31987651234', '5531987651234'),
(19, 'ONG Futuro Brilhante', 'contato@futurobrilhante.org', 'futuro-brilhante', 'Oferece aulas de reforço escolar e atividades extracurriculares para jovens de comunidades carentes.', '41987655678', '5541987655678'),
(20, 'Mãos Unidas contra a Fome', 'fomezero@maosunidas.com', 'maosunidas!', 'Distribuição de alimentos e cestas básicas para famílias em insegurança alimentar.', '51991234567', '5551991234567'),
(21, 'Associação Viver Melhor', 'vivermelhor@viver.org', 'vivermelhor_abc', 'Fomenta a inclusão social de pessoas com deficiência através de oficinas de arte e esporte.', '61987659876', '5561987659876'),
(22, 'ONG Semente da Paz', 'paz@sementedapaz.org', 'semente-paz', 'Promoção de mediação de conflitos e cultura de paz em bairros de alta violência.', '71998769876', '5571998769876'),
(23, 'Instituto de Pesquisa Marítima', 'contato@pesquisamaritima.com', 'maritima2024', 'Estuda a vida marinha e os impactos da poluição nos oceanos.', '81998765432', '5581998765432'),
(24, 'ONG Guardiões da Floresta', 'floresta@guardioes.org', 'floresta_protegida', 'Atua na proteção de áreas de mata nativa contra desmatamento ilegal e queimadas.', '91987650123', '5591987650123'),
(25, 'ONG Amiga da Terceira Idade', 'idoso@ongamiga.com', 'terceiraidade!', 'Proporciona atividades de lazer, saúde e integração para idosos.', '11998760987', '5511998760987'),
(26, 'Instituto Conectando Vidas', 'contato@conectandovidas.org', 'vida_online_10', 'Promove a inclusão digital para a população mais velha.', '21987651234', '5521987651234'),
(27, 'ONG Resgate Animal', 'resgate@ongresgateanimal.com', 'resgatepet!', 'Especializada no resgate de animais silvestres feridos.', '31991234567', '5531991234567'),
(28, 'ONG Sorriso no Rosto', 'sorriso@sorrisonorosto.org', 'sorriso_smile', 'Levar alegria e brincadeiras para crianças em hospitais.', '41998765432', '5541998765432'),
(29, 'ONG Acolhendo Refugiados', 'refugiados@acolher.org', 'acolher_100', 'Oferece abrigo e apoio para refugiados e imigrantes em busca de uma nova vida.', '51987651234', '5551987651234'),
(30, 'Instituto de Artes e Cultura', 'arteecultura@artes.com', 'artes_on', 'Incentivo à produção artística e cultural em comunidades de baixa renda.', '61998767890', '5561998767890'),
(31, 'ONG Coração Amigo', 'coracaoamigo@ong.org', 'amigo_coracao', 'Apoio a famílias de crianças com doenças crônicas.', '71987654321', '5571987654321'),
(32, 'ONG Cidadania Ativa', 'contato@cidadaniaativa.com', 'cidadania_br', 'Promove a educação cívica e a participação cidadã.', '81998769876', '5581998769876'),
(33, 'Grupo de Apoio para Mulheres', 'mulheres@grupoapoio.org', 'poder_feminino', 'Oferece suporte jurídico e psicológico para mulheres vítimas de violência.', '91987654321', '5591987654321'),
(34, 'ONG Escola Verde', 'escola@escola_verde.org', 'verde_escola', 'Criação de hortas escolares e educação ambiental para crianças.', '11998761234', '5511998761234'),
(35, 'ONG Plantando o Bem', 'contato@plantandoobem.com', 'plantar_bem_!', 'Coleta seletiva e reciclagem de lixo em áreas urbanas.', '21987655678', '5521987655678'),
(36, 'ONG Salva Vidas', 'salvavidas@ong.org', 'vida_salva_!', 'Apoio a projetos de doação de sangue e órgãos.', '31991237890', '5531991237890'),
(37, 'ONG Crescer Juntos', 'crescerjuntos@ong.com', 'crescerjuntos_22', 'Desenvolvimento de habilidades profissionais em jovens.', '41987650123', '5541987650123'),
(38, 'ONG Amigos do Hospital', 'amigohospital@hospital.org', 'amigo_hospital_!', 'Ajuda na manutenção de hospitais públicos e na compra de equipamentos.', '51998765432', '5551998765432'),
(39, 'ONG Consciência Animal', 'contato@conscienciaanimal.com', 'animal_consciente', 'Campanhas de conscientização sobre o bem-estar animal.', '61987659876', '5561987659876'),
(40, 'Instituto Cuidar do Próximo', 'cuidar@cuidardoproximo.org', 'proximo_cuidar', 'Distribuição de roupas e cobertores para pessoas em situação de rua.', '71998761234', '5571998761234'),
(41, 'ONG Gênios do Amanhã', 'geniosdoamanha@genios.com', 'genios_futuro', 'Incentivo à ciência e tecnologia entre crianças e adolescentes.', '81987655678', '5581987655678'),
(42, 'ONG Vagalume Cultural', 'vagalume@vagalume.org', 'vagalume_arte', 'Promoção de eventos culturais gratuitos em praças e parques.', '91991234567', '5591991234567'),
(43, 'ONG Corrente do Bem', 'contato@correntedobem.com', 'corrente_dobem', 'Arrecadação de fundos para diversas causas sociais.', '11987657890', '5511987657890'),
(44, 'ONG Raízes da Amazônia', 'amazonas@raizesdaamazonia.org', 'amazonia_2024', 'Proteção da floresta amazônica e apoio a comunidades locais.', '21998769876', '5521998769876'),
(45, 'ONG Criança Feliz', 'criancafeliz@ong.com', 'feliz_crianca', 'Oferece atividades recreativas e educativas para crianças carentes.', '31987650123', '5531987650123'),
(46, 'ONG Voz da Natureza', 'vozdanatureza@natureza.org', 'voz_da_natureza!', 'Atua na denúncia de crimes ambientais e na fiscalização de áreas de preservação.', '41998765432', '5541998765432'),
(47, 'ONG Amigos da Educação', 'educacao@amigosdaeducacao.com', 'educa_agora', 'Oferece bolsas de estudo e mentoria para estudantes de baixa renda.', '51987651234', '5551987651234'),
(48, 'ONG Resgate do Patrimônio', 'patrimonio@resgate.org', 'resgate_historico', 'Restauração e conservação de edifícios e monumentos históricos.', '61998767890', '5561998767890'),
(49, 'ONG Ajudando a Vencer', 'contato@ajudandoavencer.com', 'vencer_sempre', 'Apoio a pessoas com doenças raras e suas famílias.', '71987654321', '5571987654321'),
(50, 'ONG Caminhos para a Saúde', 'saude@caminhosparasaude.org', 'saude_e_bem', 'Promove campanhas de saúde preventiva e acesso a consultas médicas.', '81998769876', '5581998769876'),
(51, 'ONG Esporte e Inclusão', 'esporte@esporteinclusao.com', 'esporte_agora', 'Uso do esporte como ferramenta de inclusão social e desenvolvimento pessoal.', '91987654321', '5591987654321'),
(52, 'ONG Amigos do Bairro', 'bairro@amigosdobairro.org', 'bairro_unido', 'Projetos de melhoria de infraestrutura e segurança em bairros carentes.', '11998761234', '5511998761234'),
(53, 'ONG Cuidadores da Vida', 'cuidadores@cuidadoresdavida.com', 'cuidar_vidas', 'Oferece suporte para cuidadores de pessoas com doenças degenerativas.', '21987655678', '5521987655678'),
(54, 'ONG Sabor Solidário', 'sabor@saborsolidario.org', 'sabor_amigo', 'Oficinas de culinária para jovens e distribuição de refeições.', '31991237890', '5531991237890'),
(55, 'ONG Cultura e Cidadania', 'cultura@culturaecidadania.com', 'cultura_cidada', 'Incentivo à leitura e à participação em atividades culturais.', '41987650123', '5541987650123'),
(56, 'ONG Abrigo para Todos', 'abrigo@abrigoparatodos.org', 'abrigo_seguro', 'Oferece moradia temporária e assistência para famílias em situação de rua.', '51998765432', '5551998765432'),
(57, 'ONG Defensores dos Direitos', 'direitos@defensoresdosdireitos.com', 'defensores_!', 'Atua na defesa dos direitos humanos e na conscientização social.', '61987659876', '5561987659876'),
(58, 'ONG Rede de Solidariedade', 'rede@rededesolidariedade.org', 'solidariedade', 'Conecta voluntários com projetos sociais em diversas áreas.', '71998761234', '5571998761234'),
(59, 'ONG Lado a Lado', 'ladoalado@ong.com', 'lado_a_lado', 'Apoio a famílias com crianças que possuem doenças raras.', '81987655678', '5581987655678'),
(60, 'ONG Sem Fronteiras', 'semfronteiras@ong.org', 'fronteiras_!', 'Apoio a refugiados e imigrantes em áreas de fronteira.', '91991234567', '5591991234567'),
(61, 'ONG Voz da Floresta', 'vozdafloresta@voz.com', 'floresta_voz', 'Proteção da fauna e flora em biomas brasileiros.', '11987657890', '5511987657890'),
(62, 'ONG Coração na Mão', 'coracaonamao@ong.org', 'coracao_maao', 'Oferece atendimento médico e odontológico para comunidades carentes.', '21998769876', '5521998769876'),
(63, 'ONG Abrace a Vida', 'abraceavida@abrace.com', 'abrace_a_vida', 'Prevenção ao suicídio e apoio a pessoas com transtornos mentais.', '31987650123', '5531987650123'),
(64, 'ONG Reciclar para Transformar', 'reciclar@reciclaretransformar.org', 'recicla_trans', 'Incentivo à reciclagem e ao empreendedorismo social.', '41998765432', '5541998765432'),
(65, 'ONG Amigos do Bem', 'amigosdobem@ong.com', 'bem_amigos!', 'Apoio a famílias em situação de vulnerabilidade com cestas básicas e itens de higiene.', '51987651234', '5551987651234');

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
(3, 16, 'Voluntário para Plantio de Árvores', 'Meio Ambiente', 'Rua das Flores, 123 - Centro, Jundiaí-SP', 'Apoiar em ações de plantio e cuidado com mudas em áreas de reflorestamento.', 'Participar das ações de plantio e cuidado com as mudas em áreas de reflorestamento na região de Jundiaí.', 5, 0),
(4, 17, 'Voluntário de Apoio Psicológico', 'Saúde e Bem-Estar', 'Avenida Nove de Julho, 456 - Vianelo, Jundiaí-SP', 'Oferecer suporte psicológico a crianças e famílias vulneráveis.', 'Oferecer suporte psicológico a crianças e famílias em situação de vulnerabilidade.', 3, 0),
(5, 18, 'Voluntário de Resgate de Animais', 'Proteção Animal', 'Rua Barão de Jundiaí, 789 - Centro, Jundiaí-SP', 'Participar do resgate e transporte de cães e gatos abandonados.', 'Participar do resgate e transporte de cães e gatos abandonados para a clínica veterinária.', 2, 0),
(6, 19, 'Tutor Voluntário de Matemática', 'Educação', 'Rua do Rosário, 101 - Vila Arens, Jundiaí-SP', 'Apoio escolar para jovens com dificuldades em matemática.', 'Apoio escolar para jovens em dificuldades em matemática.', 4, 0),
(7, 20, 'Voluntário para Coleta de Alimentos', 'Assistência Social', 'Rua Prudente de Moraes, 321 - Centro, Jundiaí-SP', 'Ajudar na coleta e distribuição de alimentos para famílias carentes.', 'Ajudar na coleta e organização de alimentos para distribuição a famílias carentes.', 6, 0),
(8, 21, 'Oficineiro de Artes', 'Inclusão Social', 'Rua da Lapa, 555 - Ponte de Campinas, Jundiaí-SP', 'Conduzir oficinas de arte para pessoas com deficiência.', 'Conduzir oficinas de arte para pessoas com deficiência.', 3, 0),
(9, 22, 'Mediador Comunitário', 'Paz e Cidadania', 'Rua do Retiro, 888 - Anhangabaú, Jundiaí-SP', 'Participar de ações de mediação de conflitos na comunidade.', 'Participar de ações de mediação de conflitos e promoção da cultura de paz.', 2, 0),
(10, 23, 'Voluntário para Monitoramento Marinho', 'Meio Ambiente', 'Rua Vinte e Três de Maio, 999 - Vila Progresso, Jundiaí-SP', 'Apoiar o monitoramento de poluição nos oceanos.', 'Apoiar o projeto de monitoramento dos impactos da poluição nos oceanos.', 1, 0),
(11, 24, 'Guardião da Floresta Voluntário', 'Meio Ambiente', 'Estrada da Boiada, 101 - Traviú, Jundiaí-SP', 'Ajudar no monitoramento de áreas de mata nativa.', 'Ajudar no monitoramento de áreas de mata nativa e prevenção de queimadas.', 5, 0),
(12, 25, 'Voluntário de Acolhimento à Terceira Idade', 'Assistência Social', 'Rua João Ferrara, 202 - Jardim Paulista, Jundiaí-SP', 'Apoiar idosos em atividades sociais e de lazer.', 'Acompanhar e oferecer apoio a idosos em atividades sociais e de lazer.', 4, 0),
(13, 26, 'Instrutor de Inclusão Digital', 'Educação', 'Avenida Coleta de Matos, 333 - Vila Hortolândia, Jundiaí-SP', 'Ensinar o uso de tecnologia para a população mais velha.', 'Ensinar o uso de computadores e internet para a população mais velha.', 3, 0),
(14, 27, 'Voluntário de Resgate Silvestre', 'Proteção Animal', 'Avenida Quatorze de Dezembro, 444 - Vila Rami, Jundiaí-SP', 'Apoiar no resgate e cuidado de animais silvestres feridos.', 'Apoiar no resgate e cuidado de animais silvestres feridos.', 2, 0),
(15, 28, 'Recreador Hospitalar', 'Saúde e Bem-Estar', 'Rua Doutor João da Silva, 555 - Vila Ana, Jundiaí-SP', 'Realizar atividades recreativas com crianças internadas.', 'Realizar atividades recreativas e brincadeiras com crianças internadas.', 4, 0),
(16, 29, 'Voluntário de Apoio a Refugiados', 'Assistência Social', 'Rua do Vintém, 666 - Centro, Jundiaí-SP', 'Auxiliar no acolhimento e na integração de refugiados.', 'Auxiliar no acolhimento e na integração de refugiados na comunidade.', 3, 0),
(17, 30, 'Monitor de Oficinas de Arte', 'Cultura', 'Avenida Dom Pedro I, 777 - Jardim Guanabara, Jundiaí-SP', 'Ajudar na condução de oficinas de pintura e desenho.', 'Ajudar na condução de oficinas de pintura e desenho para jovens.', 5, 0),
(18, 31, 'Voluntário de Suporte Familiar', 'Saúde e Bem-Estar', 'Rua da Conceição, 888 - Vila Boaventura, Jundiaí-SP', 'Oferecer apoio para famílias de crianças com doenças crônicas.', 'Oferecer apoio e escuta para famílias de crianças com doenças crônicas.', 2, 0),
(19, 32, 'Educador Cívico Voluntário', 'Paz e Cidadania', 'Rua da Liberdade, 999 - Centro, Jundiaí-SP', 'Promover palestras sobre direitos e deveres do cidadão.', 'Promover palestras e workshops sobre direitos e deveres do cidadão.', 3, 0),
(20, 33, 'Apoio Jurídico para Mulheres', 'Assistência Social', 'Rua Campos Sales, 1234 - Vila Célia, Jundiaí-SP', 'Oferecer orientação jurídica e assistência para mulheres em situação de violência.', 'Oferecer orientação jurídica e assistência para mulheres em situação de violência.', 2, 0),
(21, 34, 'Educador Ambiental para Escolas', 'Educação', 'Rua da Mata, 10 - Medeiros, Jundiaí-SP', 'Ensinar crianças sobre a importância das hortas escolares.', 'Ensinar crianças sobre a importância das hortas escolares.', 4, 0),
(22, 35, 'Voluntário de Coleta Seletiva', 'Meio Ambiente', 'Rua do Glicério, 100 - Centro, Jundiaí-SP', 'Apoiar na coleta e separação de materiais recicláveis.', 'Apoiar na coleta e separação de materiais recicláveis.', 5, 0),
(23, 36, 'Voluntário de Doação de Sangue', 'Saúde e Bem-Estar', 'Rua Votorantim, 20 - Colônia, Jundiaí-SP', 'Ajudar na organização de campanhas de doação de sangue.', 'Ajudar na organização de campanhas de doação de sangue.', 3, 0),
(24, 37, 'Orientador de Carreira Voluntário', 'Educação', 'Rua São Lázaro, 50 - Vila Esperança, Jundiaí-SP', 'Oferecer mentoria e orientação profissional para jovens.', 'Oferecer mentoria e orientação profissional para jovens.', 2, 0),
(25, 38, 'Voluntário de Apoio Hospitalar', 'Saúde e Bem-Estar', 'Rua Tamoio, 123 - Vila Alvorada, Jundiaí-SP', 'Apoiar na logística e organização de doações para hospitais públicos.', 'Apoiar na logística e organização de doações para hospitais públicos.', 4, 0),
(26, 39, 'Educador de Bem-Estar Animal', 'Proteção Animal', 'Rua da Fonte, 345 - Caxambu, Jundiaí-SP', 'Promover palestras sobre os cuidados e direitos dos animais.', 'Promover palestras sobre os cuidados e direitos dos animais.', 3, 0),
(27, 40, 'Voluntário para Pessoas em Situação de Rua', 'Assistência Social', 'Avenida José Gomes da Rocha, 678 - Vila Rio Branco, Jundiaí-SP', 'Ajudar na distribuição de roupas, cobertores e alimentos.', 'Ajudar na distribuição de roupas, cobertores e alimentos.', 5, 0),
(28, 41, 'Monitor de Robótica', 'Educação', 'Rua Líbano, 910 - Ponte São João, Jundiaí-SP', 'Auxiliar no ensino de robótica e programação para crianças.', 'Auxiliar no ensino de robótica e programação para crianças.', 2, 0),
(29, 42, 'Organizador de Eventos Culturais', 'Cultura', 'Avenida Jundiaí, 1111 - Anhangabaú, Jundiaí-SP', 'Ajudar na produção de eventos culturais gratuitos.', 'Ajudar na produção de eventos culturais gratuitos em praças públicas.', 4, 0),
(30, 43, 'Voluntário de Captação de Fundos', 'Assistência Social', 'Rua da Boa Vista, 222 - Vianelo, Jundiaí-SP', 'Apoiar nas campanhas de arrecadação de doações.', 'Apoiar nas campanhas de arrecadação de doações.', 3, 0),
(31, 44, 'Voluntário de Proteção Ambiental', 'Meio Ambiente', 'Rua do Dourado, 333 - Eloy Chaves, Jundiaí-SP', 'Participar de ações de proteção da floresta amazônica.', 'Participar de ações de proteção da floresta amazônica.', 5, 0),
(32, 45, 'Recreador para Crianças', 'Educação', 'Avenida dos Imigrantes, 444 - Colônia, Jundiaí-SP', 'Organizar jogos e brincadeiras para crianças carentes.', 'Organizar jogos e brincadeiras para crianças em comunidades carentes.', 4, 0),
(33, 46, 'Fiscal Voluntário Ambiental', 'Meio Ambiente', 'Rua do Bosque, 555 - Medeiros, Jundiaí-SP', 'Apoiar na denúncia e monitoramento de crimes ambientais.', 'Apoiar na denúncia e monitoramento de crimes ambientais.', 2, 0),
(34, 47, 'Tutor Voluntário', 'Educação', 'Rua dos Pinheiros, 666 - Vila Rami, Jundiaí-SP', 'Oferecer aulas de reforço para estudantes.', 'Oferecer aulas de reforço para estudantes.', 3, 0),
(35, 48, 'Voluntário de Restauração', 'Cultura', 'Rua das Palmeiras, 777 - Jardim Ana Maria, Jundiaí-SP', 'Ajudar na restauração e conservação de monumentos históricos.', 'Ajudar na restauração e conservação de monumentos históricos.', 2, 0),
(36, 49, 'Voluntário de Suporte', 'Saúde e Bem-Estar', 'Avenida Nove de Julho, 888 - Centro, Jundiaí-SP', 'Oferecer apoio para pessoas com doenças raras e suas famílias.', 'Oferecer apoio para pessoas com doenças raras e suas famílias.', 2, 0),
(37, 50, 'Voluntário de Campanhas de Saúde', 'Saúde e Bem-Estar', 'Rua da Saúde, 999 - Vila Progresso, Jundiaí-SP', 'Participar da organização de campanhas de saúde preventiva.', 'Participar da organização de campanhas de saúde preventiva.', 4, 0),
(38, 51, 'Instrutor de Esportes Voluntário', 'Inclusão Social', 'Avenida Quinze de Novembro, 123 - Centro, Jundiaí-SP', 'Conduzir aulas de esportes para jovens em comunidades.', 'Conduzir aulas de esportes para jovens em comunidades.', 5, 0),
(39, 52, 'Voluntário de Melhoria do Bairro', 'Paz e Cidadania', 'Rua São Bento, 321 - Vila Arens, Jundiaí-SP', 'Apoiar em projetos de limpeza e melhoria de infraestrutura local.', 'Apoiar em projetos de limpeza e melhoria da infraestrutura local.', 6, 0),
(40, 53, 'Voluntário de Aconselhamento', 'Saúde e Bem-Estar', 'Rua da Alegria, 456 - Jardim Santa Gertrudes, Jundiaí-SP', 'Oferecer apoio e escuta a cuidadores de pessoas com doenças degenerativas.', 'Oferecer apoio e escuta a cuidadores de pessoas com doenças degenerativas.', 2, 0),
(41, 54, 'Voluntário de Culinária', 'Assistência Social', 'Rua do Comércio, 789 - Centro, Jundiaí-SP', 'Ajudar a preparar e distribuir refeições para pessoas necessitadas.', 'Ajudar a preparar e distribuir refeições para pessoas necessitadas.', 4, 0),
(42, 55, 'Voluntário em Biblioteca Comunitária', 'Cultura', 'Rua do Sabiá, 10 - Jardim Florestal, Jundiaí-SP', 'Ajudar na organização e promoção de atividades de leitura.', 'Ajudar na organização e promoção de atividades de leitura.', 3, 0),
(43, 56, 'Voluntário de Abrigo', 'Assistência Social', 'Rua da Paz, 11 - Vila Rami, Jundiaí-SP', 'Oferecer suporte para famílias em moradia temporária.', 'Oferecer moradia temporária e assistência para famílias em situação de rua.', 3, 0),
(44, 57, 'Voluntário de Direitos Humanos', 'Paz e Cidadania', 'Avenida Paulista, 22 - Centro, Jundiaí-SP', 'Apoiar na conscientização sobre os direitos humanos.', 'Atua na defesa dos direitos humanos e na conscientização social.', 2, 0),
(45, 58, 'Organizador de Voluntários', 'Assistência Social', 'Rua da Saudade, 33 - Vianelo, Jundiaí-SP', 'Conectar voluntários a projetos sociais.', 'Conecta voluntários com projetos sociais em diversas áreas.', 2, 0),
(46, 59, 'Apoio a Famílias', 'Saúde e Bem-Estar', 'Rua da Esperança, 44 - Jardim Santa Gertrudes, Jundiaí-SP', 'Oferecer apoio e escuta para famílias de crianças com doenças raras.', 'Oferecer apoio e escuta para famílias com crianças que possuem doenças raras.', 2, 0),
(47, 60, 'Voluntário de Acolhimento a Imigrantes', 'Assistência Social', 'Avenida das Nações Unidas, 55 - Vila Alvorada, Jundiaí-SP', 'Apoiar na integração de imigrantes em áreas de fronteira.', 'Apoio a refugiados e imigrantes em áreas de fronteira.', 3, 0),
(48, 61, 'Protetor da Fauna Voluntário', 'Proteção Animal', 'Rua das Orquídeas, 66 - Caxambu, Jundiaí-SP', 'Ajudar no monitoramento e proteção da fauna e flora.', 'Ajudar no monitoramento e proteção da fauna e flora em biomas brasileiros.', 5, 0),
(49, 62, 'Voluntário de Atendimento Médico', 'Saúde e Bem-Estar', 'Rua da Várzea, 77 - Vila Progresso, Jundiaí-SP', 'Apoiar na organização de atendimentos médicos e odontológicos.', 'Oferece atendimento médico e odontológico para comunidades carentes.', 3, 0),
(50, 63, 'Apoio Psicológico', 'Saúde e Bem-Estar', 'Avenida Nove de Julho, 88 - Anhangabaú, Jundiaí-SP', 'Oferecer apoio psicológico a pessoas em situação de risco.', 'Oferecer apoio psicológico a pessoas em situação de risco.', 2, 0),
(51, 64, 'Voluntário para Reciclagem', 'Meio Ambiente', 'Rua da Reciclagem, 99 - Centro, Jundiaí-SP', 'Conduzir oficinas sobre reciclagem e sustentabilidade.', 'Conduzir oficinas sobre reciclagem e sustentabilidade.', 4, 0),
(52, 65, 'Voluntário de Apoio a Famílias', 'Assistência Social', 'Avenida Antiga, 123 - Vila Alvorada, Jundiaí-SP', 'Ajudar na distribuição de cestas básicas e itens de higiene.', 'Ajudar na distribuição de cestas básicas e itens de higiene.', 6, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `voluntario`
--

CREATE TABLE `voluntario` (
  `id` int(11) NOT NULL,
  `nome_voluntario` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `senha` varchar(20) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `whatsapp` varchar(20) DEFAULT NULL,
  `categoria_trabalho` varchar(100) NOT NULL,
  `periodo` enum('manhã','tarde','noite','madrugada','integral') NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `estado_social` enum('Estudante Fundamental','Estudante Médio','Formado','Estudante Universitário','Empregado','Aposentado') NOT NULL,
  `pcd` varchar(300) DEFAULT NULL,
  `sobre` varchar(1000) NOT NULL,
  `quant_cadastro` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT de tabela `registro`
--
ALTER TABLE `registro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `vaga`
--
ALTER TABLE `vaga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de tabela `voluntario`
--
ALTER TABLE `voluntario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
