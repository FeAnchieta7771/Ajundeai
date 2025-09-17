<?php
session_start();

$_SESSION['tela_anterior'] = $_SERVER['REQUEST_URI'];

include 'php_functs/php_methods/functions.php';

// busca situação de login do usuário
$login_state = is_logged();

if(!$login_state){
  header('Location: index.php');
  exit();
}

// busca quem está logado
$is_ong = is_ong_logged();

// setar botões do header
$buttons_header = set_model_buttons_header($login_state, $is_ong);

function is_checked_before($name){
  if(isset($_GET[$name])){

    echo 'checked';
  }
}
?>

<!-- Tela de Apresentação das vagas cadastradas pelo usuário -->
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
  <link rel="icon" href="img\Logo_Aba.png">

    <link
      href="https://cdn.boxicons.com/fonts/basic/boxicons.min.css"
      rel="stylesheet"
    />

  <link rel="stylesheet" href="css/notification.css">

  <title>AjundeAi • Controle de Vagas</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/header.css">
      <link rel="stylesheet" href="css/notification.css">
      <link rel="stylesheet" href="css\css_screens\save_voluntary.css">
  <style>

    body::-webkit-scrollbar {
      display: none; /* Para navegadores baseados em WebKit (Chrome, Safari) */
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

      <a class="painel-a1" href="save_voluntary.php"style="color: #e76f00" ><strong>VAGAS SALVAS</strong></a>
      <a class="painel-a2" href="register_voluntary.php"><strong>Vacas Cadastradas</strong></a>
    </div>

  <forms>
    <form method="GET" action="save_voluntary.php">
    <main class="container">
      <aside class="filtros">
        <h2>FILTROS</h2>
               <label><input type="checkbox" value="saúde"         name="saúde"         <?php is_checked_before("saúde"); ?>> Saúde</label>
               <label><input type="checkbox" value="eventos"       name="eventos"       <?php is_checked_before("eventos"); ?>> Eventos</label>
               <label><input type="checkbox" value="animais"       name="animais"       <?php is_checked_before("animais"); ?>> Animais</label>
               <label><input type="checkbox" value="crianças"      name="crianças"      <?php is_checked_before("crianças"); ?>> Crianças</label>
               <label><input type="checkbox" value="educação"      name="educação"      <?php is_checked_before("educação"); ?>> Educação</label>
               <label><input type="checkbox" value="tecnologia"    name="tecnologia"    <?php is_checked_before("tecnologia"); ?>> Tecnologia</label>
               <label><input type="checkbox" value="assistencia"   name="assistencia"   <?php is_checked_before("assistencia"); ?>> Assist. Social</label>
               <label><input type="checkbox" value="administração" name="administração" <?php is_checked_before("administração"); ?>> Administração</label>
               <label><input type="checkbox" value="meio ambiente" name="meio_ambiente" <?php is_checked_before("meio_ambiente"); ?>> Meio Ambiente</label>
        <button class="btn btn-buscar">BUSCAR</button>
      </aside>
    </form>
  </forms>

    <!-- Bloco de Vagas-->
    <section class="vagas">
      <?php include 'php_functs\php_screens\filter_save_slot.php'; do_filter_save_slot(); ?>
      
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
</html>