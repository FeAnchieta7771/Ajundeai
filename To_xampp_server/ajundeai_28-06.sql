-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 29/06/2025 às 00:17
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
(1, 1, 'Feira Cultural Solidária', 'Eventos', 'Centro', 'Organizar evento cultural com artesãos locais', 'Evento com 30 estandes e apresentações musicais.', 30, 26),
(2, 2, 'Campanha de Adoção de Pets', 'Animais', 'Vila Arens', 'Divulgar adoção de animais resgatados', 'Evento com 20 cães e gatos disponíveis para adoção.', 20, 18),
(3, 3, 'Reforço Escolar Comunitário', 'Educação', 'Jardim Bonfiglioli', 'Oferecer aulas de reforço para crianças', 'Aulas semanais de português e matemática para 40 crianças.', 40, 35),
(4, 4, 'Plantio de Árvores Nativas', 'Meio Ambiente', 'Parque da Cidade', 'Recuperar áreas verdes urbanas', 'Plantio de 100 mudas nativas com participação da comunidade.', 100, 95),
(5, 5, 'Brinquedoteca Solidária', 'Crianças', 'Jardim Paulista', 'Criar espaço de brincadeiras para crianças', 'Espaço interativo com brinquedos educativos e oficinas recreativas.', 50, 45),
(6, 6, 'Curso de Programação para Jovens', 'Tecnologia', 'Jardim Cica', 'Ensinar lógica e programação básica', 'Curso introdutório para 25 adolescentes de escolas públicas.', 25, 20),
(7, 7, 'Mutirão da Saúde', 'Saúde', 'Vila Progresso', 'Oferecer exames gratuitos para população', 'Campanha com exames de glicemia, pressão e orientação médica.', 150, 140),
(8, 8, 'Grupo de Apoio Psicológico', 'Assistência Social', 'Vila Esperança', 'Apoiar emocionalmente famílias carentes', 'Sessões semanais com psicólogos voluntários para 20 famílias.', 20, 18),
(9, 9, 'Capacitação de Jovens Líderes', 'Administração', 'Centro', 'Formar lideranças comunitárias', 'Curso prático sobre liderança, comunicação e gestão.', 15, 12),
(10, 10, 'Feira de Agricultura Urbana', 'Meio Ambiente', 'Vila Arens II', 'Divulgar hortas comunitárias', 'Feira com produtores locais e oficinas sobre compostagem.', 25, 23),
(11, 11, 'Distribuição de Marmitas', 'Assistência Social', 'Centro Expandido', 'Oferecer refeições a moradores de rua', 'Distribuição noturna de marmitas e água a 200 pessoas.', 200, 185),
(12, 12, 'Oficina de Currículo e Entrevista', 'Administração', 'Jardim Santa Adélia', 'Preparar jovens para o mercado de trabalho', 'Workshop com simulação de entrevistas e montagem de currículo.', 30, 27),
(13, 1, 'Roda de Leitura Infantil', 'Educação', 'Jardim Tamoio', 'Estimular leitura entre crianças', 'Leitura de histórias com voluntários para 25 crianças.', 25, 22),
(14, 2, 'PetCare Comunitário', 'Animais', 'Jardim América', 'Atendimento veterinário gratuito', 'Vacinação e cuidados básicos para animais de famílias carentes.', 60, 52),
(15, 3, 'Projeto Reescrevendo o Futuro', 'Educação', 'Jardim do Lago', 'Ajudar jovens com alfabetização tardia', 'Aulas de reforço e leitura para adolescentes fora da escola.', 20, 18),
(16, 4, 'Recicla Jundiaí', 'Meio Ambiente', 'Jardim Tarumã', 'Educar sobre reciclagem', 'Campanha porta-a-porta de coleta seletiva e oficinas.', 80, 76),
(17, 5, 'Oficina de Artes para Crianças', 'Crianças', 'Jardim São Camilo', 'Ensinar artes plásticas a crianças', 'Aulas semanais com produção de obras e exposição final.', 35, 30),
(18, 6, 'Inclusão Digital para Idosos', 'Tecnologia', 'Jardim Copacabana', 'Ensinar uso básico de celular e computador', 'Curso voltado para inclusão digital com apostilas práticas.', 15, 12),
(19, 7, 'Campanha de Prevenção à Dengue', 'Saúde', 'Jardim Santa Gertrudes', 'Conscientizar sobre combate ao mosquito', 'Distribuição de panfletos e orientações nas residências.', 100, 88),
(20, 8, 'Roupas para Todos', 'Assistência Social', 'Vila Aparecida', 'Arrecadar e distribuir roupas', 'Campanha de inverno para 300 pessoas em situação de rua.', 300, 260),
(21, 9, 'Gestão Transparente para ONGs', 'Administração', 'Centro', 'Treinar equipes em prestação de contas', 'Capacitação para lideranças comunitárias sobre contabilidade social.', 10, 8),
(22, 10, 'Cinema na Praça', 'Eventos', 'Vila Hortolândia', 'Promover sessões gratuitas de cinema', 'Filmes infantis e educativos com pipoca e roda de conversa.', 70, 60),
(23, 11, 'Higiene Solidária', 'Assistência Social', 'Jardim São Vicente', 'Distribuir kits de higiene pessoal', 'Kits com escova, pasta, sabonete e álcool para população vulnerável.', 150, 135),
(24, 12, 'Curso de Planilhas para Mulheres', 'Tecnologia', 'Jardim Novo Horizonte', 'Ensinar Excel para microempreendedoras', 'Turma com 20 mulheres de comunidades periféricas.', 20, 18),
(25, 1, 'Artesanato com Materiais Recicláveis', 'Cultura', 'Centro', 'Ensinar reaproveitamento de materiais', 'Oficina com confecção de produtos recicláveis e feira final.', 30, 26),
(26, 2, 'Semana de Bem-estar Animal', 'Animais', 'Jardim Ana Maria', 'Promover cuidados e adoções', 'Eventos diários com adoção, banho e vacinação de pets.', 100, 95),
(27, 3, 'Curso de Alfabetização Adulto', 'Educação', 'Jardim do Lírio', 'Alfabetizar adultos', 'Projeto com professores voluntários para 25 adultos.', 25, 22),
(28, 4, 'Horta Urbana Educativa', 'Meio Ambiente', 'Jardim do Lago II', 'Criar horta em escola pública', 'Alunos plantam e cuidam dos alimentos, integrando à merenda.', 50, 48),
(29, 5, 'Sábado Brincante', 'Crianças', 'Jardim Tulipas', 'Oferecer recreação e contação de histórias', 'Evento lúdico com oficinas e teatro infantil.', 45, 40),
(30, 6, 'Hackathon Social', 'Tecnologia', 'Centro de Inovação', 'Criar soluções para ONGs', 'Desafio de programação com premiação para melhores ideias.', 40, 35),
(31, 7, 'Vacinação Voluntária', 'Saúde', 'CEU das Artes', 'Aplicar vacinas básicas em comunidades', 'Ação com enfermeiros voluntários em bairros afastados.', 60, 52),
(32, 8, 'Oficina de Direitos Humanos', 'Assistência Social', 'Centro', 'Educar sobre direitos sociais', 'Rodas de conversa e atividades educativas para jovens.', 25, 20),
(33, 9, 'Consultoria para Pequenas ONGs', 'Administração', 'Jardim Danúbio', 'Ajudar ONGs iniciantes com estruturação', 'Mentoria com especialistas em gestão do terceiro setor.', 15, 12),
(34, 10, 'Feira do Troca-Troca', 'Eventos', 'Parque da Uva', 'Trocar objetos em vez de comprar', 'Feira de trocas de livros, brinquedos, roupas e utensílios.', 100, 90),
(35, 11, 'Marmita Vegana Solidária', 'Assistência Social', 'Jardim Pacaembu', 'Entregar alimentação vegana a moradores de rua', 'Ação semanal com distribuição de refeições e diálogo.', 120, 115),
(36, 12, 'Mentoria em Informática', 'Tecnologia', 'Jardim Santa Clara', 'Oferecer mentoria para iniciantes em tecnologia', 'Aulas práticas de Word, PowerPoint e internet segura.', 25, 22),
(37, 1, 'Pintando a Escola', 'Educação', 'Jardim São Marcos', 'Mutirão de pintura em escola pública', 'Voluntários revitalizam salas, muros e quadras.', 20, 18),
(38, 2, 'Pet Day Jundiaí', 'Animais', 'Vila Rio Branco', 'Evento com banho, tosa e adoção', 'Mais de 30 animais atendidos por veterinários e cuidadores.', 30, 28),
(39, 3, 'Biblioteca Móvel', 'Educação', 'Região Sul', 'Levar livros a comunidades sem acesso', 'Van com livros infantis e atividades lúdicas itinerantes.', 80, 72),
(40, 4, 'EcoCaminhada', 'Meio Ambiente', 'Serra do Japi', 'Conscientizar com caminhada ecológica', 'Trilha educativa com coleta de lixo e palestra.', 40, 35),
(41, 5, 'Brincando nas Férias', 'Crianças', 'Jardim Shangai', 'Oficinas culturais durante o recesso escolar', 'Arte, música e culinária infantil por 2 semanas.', 60, 55),
(42, 6, 'GameLab Inclusivo', 'Tecnologia', 'CEU Jundiaí', 'Ensinar desenvolvimento de jogos', 'Oficina de criação de jogos educativos com ferramentas gratuitas.', 25, 20),
(43, 7, 'Saúde na Praça', 'Saúde', 'Praça da Matriz', 'Oferecer atendimento básico à população', 'Tendas com enfermeiros e orientação em nutrição e prevenção.', 200, 180),
(44, 8, 'Café com Dignidade', 'Assistência Social', 'Região Central', 'Oferecer café da manhã a moradores de rua', 'Distribuição semanal com apoio de padarias locais.', 80, 70),
(45, 9, 'Treinamento de Voluntariado', 'Administração', 'Sede ONG Vida', 'Capacitar novos voluntários', 'Encontro com dinâmicas e integração para novos integrantes.', 25, 22),
(46, 10, 'Festival da Consciência Negra', 'Eventos', 'Teatro Polytheama', 'Evento sobre cultura afro-brasileira', 'Rodas de conversa, shows e feira de afroempreendedorismo.', 100, 90),
(47, 11, 'Banho Solidário', 'Assistência Social', 'Praça Rui Barbosa', 'Fornecer banho e higiene a moradores de rua', 'Caminhão adaptado com duchas, toalhas e produtos de higiene.', 50, 48),
(48, 12, 'Inclusão Digital em Libras', 'Tecnologia', 'Jardim do Trevo', 'Ensinar informática para surdos', 'Curso com intérprete de libras e recursos visuais adaptados.', 15, 12),
(49, 1, 'Cine Comunidade', 'Eventos', 'Jardim Esplanada', 'Sessões de cinema itinerante', 'Filmes educativos ao ar livre com pipoca e bate-papo.', 60, 55),
(50, 2, 'Resgate e Cuidado Animal', 'Animais', 'Jardim Bonfiglioli', 'Resgatar animais em situação de risco', 'Ações de resgate com acolhimento temporário até adoção.', 30, 28);

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
(1, 'Ana Carolina Silva', 'ana.silva@email.com', '(11) 98765-4321', 'An@2023!', 'Estudante de Serviço Social que ama ajudar pessoas em situação de vulnerabilidade.'),
(2, 'Carlos Eduardo Santos', 'carlos.santos@email.com', '(21) 99876-5432', 'C@rl0s_2023', 'Engenheiro aposentado buscando contribuir com projetos sociais.'),
(3, 'Mariana Oliveira', 'mariana.oliveira@email.com', '(31) 98765-1234', 'M@ri2024', 'Professora que deseja voluntariar nas horas vagas.'),
(4, 'João Pedro Almeida', 'joao.almeida@email.com', '(41) 91234-5678', 'J0@oP3dr0', 'Estudante de medicina interessado em ações de saúde comunitária.'),
(5, 'Luiza Fernandes Costa', 'luiza.costa@email.com', '(51) 92345-6789', 'LuiZA#99', 'Designer gráfica que quer usar suas habilidades para causas sociais.'),
(6, 'Rafael Gonçalves', 'rafael.goncalves@email.com', '(85) 93456-7890', 'R@fael123', 'Profissional de TI buscando ajudar ONGs com tecnologia.'),
(7, 'Fernanda Lima', 'fernanda.lima@email.com', '(71) 94567-8901', 'F3rn@nda!', 'Aposentada que dedica seu tempo a projetos de cuidado com idosos.'),
(8, 'Lucas Martins', 'lucas.martins@email.com', '(48) 95678-9012', 'LucasM@rt', 'Educador físico voluntário em projetos esportivos para jovens.'),
(9, 'Juliana Ribeiro', 'juliana.ribeiro@email.com', '(61) 96789-0123', 'JuL!2023', 'Advogada atuando em projetos de assistência jurídica gratuita.'),
(10, 'Pedro Henrique Souza', 'pedro.souza@email.com', '(92) 97890-1234', 'P3dr0S0uza', 'Estudante de veterinária que ajuda em projetos de proteção animal.'),
(11, 'Amanda Torres', 'amanda.torres@email.com', '(19) 98901-2345', '@mAndaT1', 'Psicóloga oferecendo apoio emocional em projetos sociais.'),
(12, 'Rodrigo Neves', 'rodrigo.neves@email.com', '(27) 99012-3456', 'R0driG0*', 'Chef de cozinha voluntário em projetos de alimentação solidária.'),
(13, 'Bruno Almeida', 'bruno.almeida@email.com', '(11) 91234-0001', 'Bruno@2024', 'Graduando em Ciências Ambientais, entusiasta em projetos de reflorestamento.'),
(14, 'Daniela Pires', 'daniela.pires@email.com', '(21) 92345-0002', 'Dan!ela24', 'Publicitária e fotógrafa amadora que atua em projetos culturais.'),
(15, 'Eduardo Freitas', 'eduardo.freitas@email.com', '(31) 93456-0003', 'Edu#Frei', 'Voluntário atuante em logística de eventos solidários.'),
(16, 'Tatiane Souza', 'tatiane.souza@email.com', '(41) 94567-0004', 'TatiS2024', 'Psicóloga com experiência em grupos de apoio emocional.'),
(17, 'Igor Mello', 'igor.mello@email.com', '(51) 95678-0005', 'Igor@M35', 'Estudante de Engenharia interessado em soluções para ONGs.'),
(18, 'Camila Ferreira', 'camila.ferreira@email.com', '(61) 96789-0006', 'C@MILA', 'Professora de inglês oferecendo reforço escolar gratuito.'),
(19, 'Vinícius Costa', 'vinicius.costa@email.com', '(85) 97890-0007', 'V!ni#90', 'Desenvolvedor web que oferece apoio técnico para ONGs locais.'),
(20, 'Larissa Lopes', 'larissa.lopes@email.com', '(71) 98901-0008', 'Lari@2023', 'Voluntária em abrigos para mulheres vítimas de violência.'),
(21, 'Marcelo Lima', 'marcelo.lima@email.com', '(48) 99012-0009', 'MarcL#89', 'Fisioterapeuta que realiza atendimentos voluntários em comunidades.'),
(22, 'Natalia Gomes', 'natalia.gomes@email.com', '(61) 90123-0010', 'Nati@22', 'Administradora envolvida em capacitação de ONGs.'),
(23, 'Guilherme Rocha', 'guilherme.rocha@email.com', '(11) 91234-0011', 'Gui@Roch', 'Amante de pets, voluntário em eventos de adoção.'),
(24, 'Helena Castro', 'helena.castro@email.com', '(21) 92345-0012', 'HeLeNa#', 'Estudante de enfermagem atuando em campanhas de saúde.'),
(25, 'Tiago Nascimento', 'tiago.nascimento@email.com', '(31) 93456-0013', 'Tnasc2025', 'Fotógrafo que registra ações de ONGs para divulgação.'),
(26, 'Isabela Mendes', 'isabela.mendes@email.com', '(41) 94567-0014', 'IsaMend!', 'Voluntária em programas de alfabetização de adultos.'),
(27, 'Fábio Henrique', 'fabio.henrique@email.com', '(51) 95678-0015', 'F@b!0H', 'Formado em contabilidade, auxilia ONGs na prestação de contas.'),
(28, 'Renata Martins', 'renata.martins@email.com', '(61) 96789-0016', 'RenMart#1', 'Organizadora de eventos beneficentes.'),
(29, 'Leandro Souza', 'leandro.souza@email.com', '(85) 97890-0017', 'Leo@2024', 'Educador voluntário em escolas públicas.'),
(30, 'Amanda Castro', 'amanda.castro@email.com', '(71) 98901-0018', 'AmaCast1', 'Atua em projetos de prevenção à violência doméstica.'),
(31, 'Caio Silva', 'caio.silva@email.com', '(48) 99012-0019', 'Ca1oS!', 'Trabalha com audiovisual em campanhas sociais.'),
(32, 'Patrícia Dias', 'patricia.dias@email.com', '(61) 90123-0020', 'PatDias@', 'Psicóloga atuante em centros de acolhimento.'),
(33, 'Douglas Nogueira', 'douglas.nogueira@email.com', '(11) 91234-0021', 'D0ugN0g!', 'Motorista voluntário em entregas de cestas básicas.'),
(34, 'Beatriz Almeida', 'beatriz.almeida@email.com', '(21) 92345-0022', 'BeaA23@', 'Jovem universitária envolvida com tutoria escolar.'),
(35, 'Alexandre Gomes', 'alexandre.gomes@email.com', '(31) 93456-0023', 'Alex#GM!', 'Professor de história voluntário em escolas públicas.'),
(36, 'Rafaela Costa', 'rafaela.costa@email.com', '(41) 94567-0024', 'RafaC!', 'Ajuda na organização de feiras de adoção e eventos comunitários.'),
(37, 'Luiz Otávio', 'luiz.otavio@email.com', '(51) 95678-0025', 'LuiZ0Tav', 'Auxiliar técnico de enfermagem em campanhas de saúde.'),
(38, 'Mirela Andrade', 'mirela.andrade@email.com', '(61) 96789-0026', 'MirAnd@', 'Trabalha com crianças em situação de vulnerabilidade.'),
(39, 'Henrique Barbosa', 'henrique.barbosa@email.com', '(85) 97890-0027', 'HenB@2023', 'Arquiteto ajudando projetos de urbanismo social.'),
(40, 'Tatiana Rocha', 'tatiana.rocha@email.com', '(71) 98901-0028', 'T@tiaRo', 'Envolvida em ações culturais com foco em comunidades.'),
(41, 'Joana Brito', 'joana.brito@email.com', '(48) 99012-0029', 'J@Brito24', 'Especialista em inclusão digital de idosos.'),
(42, 'Rogério Dias', 'rogerio.dias@email.com', '(61) 90123-0030', 'R0g3rD!', 'Oferece aulas de reforço para crianças carentes.'),
(43, 'Érica Nunes', 'erica.nunes@email.com', '(11) 91234-0031', 'EriN@uNeS', 'Voluntária em campanhas de arrecadação de alimentos.'),
(44, 'Murilo Teixeira', 'murilo.teixeira@email.com', '(21) 92345-0032', 'MurT@x', 'Formado em gastronomia, cozinha para moradores de rua.'),
(45, 'Simone Freitas', 'simone.freitas@email.com', '(31) 93456-0033', 'SimFr#22', 'Auxilia em ações de combate ao analfabetismo.'),
(46, 'Diego Ramos', 'diego.ramos@email.com', '(41) 94567-0034', 'DieR@mOS', 'Técnico em informática voluntário em oficinas digitais.'),
(47, 'Suelen Dias', 'suelen.dias@email.com', '(51) 95678-0035', 'SuD@i45', 'Atua como recreadora em projetos infantis.'),
(48, 'Felipe Marques', 'felipe.marques@email.com', '(61) 96789-0036', 'F3l!peM', 'Trabalha com fotografia em projetos sociais.'),
(49, 'Elisa Prado', 'elisa.prado@email.com', '(85) 97890-0037', 'Eli$Prado', 'Voluntária em campanhas de vacinação.'),
(50, 'Ricardo Pena', 'ricardo.pena@email.com', '(71) 98901-0038', 'RicPen@23', 'Estudante de direito que atua em núcleos de apoio jurídico.');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de tabela `vaga`
--
ALTER TABLE `vaga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de tabela `voluntario`
--
ALTER TABLE `voluntario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

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
