<?php
session_start();

$_SESSION['tela_anterior'] = $_SERVER['REQUEST_URI'];

include 'php_functs/php_methods/functions.php';

// busca situação de login do usuário
$login_state = is_logged();


// busca quem está logado
$is_ong = is_ong_logged();

if (!$login_state and $is_ong) {
  header('Location: index.php');
  exit();
}
// setar botões do header
$buttons_header = set_model_buttons_header($login_state, $is_ong);
?>

<!-- Tela de Apresentação das vagas cadastradas pelo usuário -->
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
  <link rel="icon" href="img\Logo_Aba.png">

  <link href="https://cdn.boxicons.com/fonts/basic/boxicons.min.css" rel="stylesheet" />

  <link rel="stylesheet" href="css/notification.css">

  <title>AjundeAi • Controle de Vagas</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/header.css">
  <link rel="stylesheet" href="css/notification.css">
  <link rel="stylesheet" href="css\css_screens\register_voluntary.css">
  <style>
    body::-webkit-scrollbar {
      display: none;
      /* Para navegadores baseados em WebKit (Chrome, Safari) */
    }
  </style>
</head>

<body>
  <!-- Header com logo e botões -->
  <div class="notifications"></div>
  <header>
    <div class="logo">
      <a href="index.php">
        <img src="img\Logo_Header.png" alt="Logo AjundeAi" />
      </a>
    </div>
    <?php echo $buttons_header; ?>
  </header>
  <?php show_message(); ?>

  <div class="painel-bar">
    <h1>PAINEL DE CONTROLE</h1>

    <a class="painel-a1" href="save_voluntary.php"><strong>Vagas Salvas</strong></a>
    <a class="painel-a2" href="save_voluntary.php"style="color: #e76f00" ><strong>VAGAS CADASTRADAS</strong></a>
  </div>

  <!-- Conteúdo principal -->
  <main class="container">
    <!-- Painel de Filtros
    <forms>
      <aside class="filtros">
        <h2>FILTROS</h2>

        Situação com seta
        <div class="situacao-titulo"
          onclick="document.querySelector('.situacao-opcoes').classList.toggle('ativo');this.querySelector('i').classList.toggle('bx-chevron-up');this.querySelector('i').classList.toggle('bx-chevron-down')">
          <span>SITUAÇÃO</span>
          <i class='bx bx-chevron-down'></i>
        </div>
        <div class="situacao-opcoes">
          <label><input type="checkbox" name="situacao"> Em aguarde</label>
          <label><input type="checkbox" name="situacao"> Aprovado</label>
          <label><input type="checkbox" name="situacao"> Negado</label>
        </div>
        <hr style="margin: 15px 0; border-color: white;">-->

    <!-- Categorias 
        <label><input type="checkbox" name="filtro"> Saúde</label>
        <label><input type="checkbox" name="filtro"> Eventos</label>
        <label><input type="checkbox" name="filtro"> Animais</label>
        <label><input type="checkbox" name="filtro"> Crianças</label>
        <label><input type="checkbox" name="filtro"> Educação</label>
        <label><input type="checkbox" name="filtro"> Tecnologia</label>
        <label><input type="checkbox" name="filtro"> Assist. Social</label>
        <label><input type="checkbox" name="filtro"> Administração</label>
        <label><input type="checkbox" name="filtro"> Meio Ambiente</label>
        <button class="btn-buscar">BUSCAR</button>
      </aside>
    </forms> -->

    <!-- Bloco de Vagas-->
    <section class="vagas">
      <?php include 'php_functs\php_screens\filter_register_slot.php';
      do_filter_registered_slots(); ?>

      <!--- <div class="vaga-wrapper">
        <div class="vaga-card">
          <img src="img\icons_orange\outro.png" alt="Ícone" />
          <div class="vaga-info">
            <h4>NOME DA VAGA</h4>
            <span>5/10 • Nome da ONG</span>
            <p>Descrição pequena que está dentro do banco que o Guilherme ainda tem que fazer e passar o arquivo pra
              mim.</p>
          </div>
        </div>
        <button class="btn-azul btn-preto"><i class='bx bxs-hourglass'></i></button>

      </div>

      <div class="vaga-wrapper">
        <div class="vaga-card">
          <img src="img\icons_orange\outro.png" alt="Ícone" />
          <div class="vaga-info">
            <h4>NOME DA VAGA</h4>
            <span>5/10 • Nome da ONG</span>
            <p>Descrição pequena que está dentro do banco que o Guilherme ainda tem que fazer e passar o arquivo pra
              mim.</p>
          </div>
        </div>
        <button class="btn-azul btn-verde"><i class='bx bx-check'></i></button>

      </div>

      <div class="vaga-wrapper">
        <div class="vaga-card">
          <img src="img\icons_orange\outro.png" alt="Ícone" />
          <div class="vaga-info">
            <h4>NOME DA VAGA</h4>
            <span>5/10 • Nome da ONG</span>
            <p>Descrição pequena que está dentro do banco que o Guilherme ainda tem que fazer e passar o arquivo pra
              mim.</p>
          </div>
        </div>
        <button class="btn-azul btn-vermelho"><i class='bx bx-x'></i></button>

      </div>-->

    </section>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.2/dist/confetti.browser.min.js" defer></script>
  <script src='js/notification.js' defer></script>
</body>