<!-- Tela de aprestação das vagas salvas pelo usuário -->
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

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
  <link rel="icon" href="img\Logo_Aba.png">
  <title>AjundeAi • Controle de Vags</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/header.css">
      <link rel="stylesheet" href="css/notification.css">
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Poppins', sans-serif;
    }

    body {
      background-color: #ffffff;
    }

    body::-webkit-scrollbar {
    display: none; /* Para navegadores baseados em WebKit (Chrome, Safari) */
    }

    .container {
      display: flex;
      flex-wrap: wrap;
      padding: 25px 40px;
      gap: 40px;
    }

    .filtros {
      background-color: #196e78;
      color: white;
      padding: 20px;
      border-radius: 10px;
      width: 250px;
      flex-shrink: 0;
      height: fit-content;
    }

    .filtros h2 {
      margin-bottom: 20px;
      border-bottom: 2px solid white;
      padding-bottom: 10px;
      font-size: 1.3rem;
    }

    .filtros label {
      display: block;
      margin-bottom: 10px;
      cursor: pointer;
    }

    .filtros input[type="radio"] {
      margin-right: 8px;
    }

    .filtros .btn-buscar {
      width: 100%;
      margin-top: 15px;
    }

    .vagas {
      flex: 1;
      min-width: 280px;
    }

    .vagas h3 {
      color: #003f5c;
      margin-bottom: 20px;
      font-weight: bold;
    }


    .vaga-card {
      border: 2px solid #e66922;
      padding: 20px;
      margin-bottom: 20px;
      display: flex;
      gap: 20px;
      align-items: flex-start;
      background-color: #f9f9f9;
      height: 170px;
      align-items: center;
      /* Alinha verticalmente no centro */
      width: 85%;
      transition: .15s;
    }

        .vaga-wrapper {
      position: relative;
      display: flex;
      align-items: center;
      margin-bottom: 30px;
    }

    .vaga-card img {
      width: 120px;
      height: 120px;
    }

    .vaga-info h4 {
      color: #e76f00;
      font-size: 1.6rem;
      margin-bottom: 5px;
    }

    .vaga-info span {
      display: block;
      margin-bottom: 5px;
      color: #196e78;
      font-weight: bold;
    }

    .vaga-info p {
      font-size: 1.2rem;
      color: #444;
    }

    .engloba {
      display: flex;
      align-items: center;
    }

    .btn-azul {
      padding: 20px;
      font-size: 30px;
      margin-left: 75px;
      height: 74px;
      display: flex;
      align-items: center;
      background-color: #2289e6;
      color: white;
      border: 1px solid #2289e6;
    }

    .btn-azul:hover {
      background-color: white;
      color: #2289e6;
    }

    .painel-bar {
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: #004d61;
      padding: 10px 0;

      background-image: url("../../img/detalhe-painel.png");
      background-repeat: no-repeat;
    }

    .painel-bar h1 {
      color: white;
      font-size: 3rem;
    }

    .painel-bar a{
      color: white;
      margin: 10px;
    }

        .vaga-info h3 {
      color: #e76f00;
      font-size: 1.7rem;
      margin-bottom: 5px;
      font-family: 'Horizon', sans-serif;
      transition: .2s;
    }

      .slot{
        all: unset;
        cursor: pointer;
        display: contents;
        width: 100%;
        height: 100%;
        

    }

        .vaga-card form{
        all: unset;
        cursor: pointer;
        display: contents;
      }
        
        .vaga-card-btn{
        background: none;
        border: none;
        padding: 0;
        cursor: pointer;
        text-align: left;
        width: 100%;
        }

    
  </style>
</head>

<body>
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

    <a href="save_voluntary.php">Vagas Salvas</a>
    <a href="register_voluntary.php">Vacas Cadastradas</a>
  </div>
  <forms>
    <form method="GET" action="save_voluntary.php">
    <h1 style="color: #2289e6; margin-top: 40px; margin-left: 40px;">SUAS VAGAS SALVAS</h1>
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

  <section class="vagas">
    <?php include 'php_functs\php_screens\filter_save_slot.php'; do_filter_save_slot(); ?>
    <!-- ! AVISO GUILHERME,  -->

     <!-- <div class="scroll-wrapper"> -->
      <!-- Aqui os blocos podem ser gerados via PHP -->
       <!-- <forms>
        <div class="engloba">
          <div class="vaga-card">
            <img src="img\icons_orange\outro.png" alt="Ícone" />
            <div class="vaga-info">
              <h4>NOME DA VAGA</h4>
              <span>5/10 • Nome da ONG</span>
              <p>Descrição pequena que está dentro do banco que o Guilherme
                ainda tem que fazer e passar o arquivo pra mim.</p>
            </div>
          </div>
          <button class="btn-azul"><i class='bx bxs-bookmark'></i></button>
        </div>
      </forms>  -->

      <!-- Repita o .vaga-card conforme necessário -->
    </div>

  </section>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.2/dist/confetti.browser.min.js" defer></script>
<script src='js/notification.js' defer></script>
</body>

</html>