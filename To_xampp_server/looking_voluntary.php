<?php
session_start();

$_SESSION['looking_voluntary'] = $_SERVER['REQUEST_URI'];
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

if (isset($_GET['voltar'])) {
    header("Location: " . $_SESSION['tela_retrasada']);
    exit();
}

// print_r($_SESSION);
?>

<!-- Tela de Apresentação das vagas cadastradas pelo usuário -->
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.boxicons.com/fonts/basic/boxicons.min.css"
      rel="stylesheet"
    />

    <link rel="stylesheet" href="css/notification.css">
  <link rel="icon" href="img\Logo_Aba.png">

    <link
      href="https://cdn.boxicons.com/fonts/basic/boxicons.min.css"
      rel="stylesheet"
    />

  <link rel="stylesheet" href="css/notification.css">

  <title>AjundeAi • Procura de Voluntário</title>
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
      background-image: url("../../img/backgraud-deashboard.png");
      background-repeat: no-repeat;
      background-size: cover;

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
      width: 360px;
      flex-shrink: 0;
      height: fit-content;
    }

    .filtros h2 {
      margin-bottom: 20px;
      border-bottom: 2px solid #15728a;
      padding-bottom: 2px;
      font-size: 1.3rem;
      font-family: "Horizon", sans-serif;
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
      background-color: #5cd1d8;
      color: white
    }

    .vagas {
      flex: 1;
      min-width: 300px;
    }

    .vagas h3 {
      margin-bottom: 20px;
      font-weight: bold;
      font-size: 1.5rem;
    }

    .vaga-wrapper {
      position: relative;
      display: flex;
      align-items: center;
      margin-bottom: 30px;
    }


    .vaga-card {
      border: 2px solid #008cff;
      padding: 20px;
      margin-bottom: 20px;
      display: flex;
      gap: 20px;
      align-items: flex-start;
      background-color: #f9f9f9;
      height: 170px;
      align-items: center;
      /* Alinha verticalmente no centro */
      width: 100%;
      text-align: left;
      transition: .15s;
    }

    .vaga-card:hover {
      background-color: rgb(193, 250, 246);
      cursor:pointer;
    }

    .vaga-card:hover h4 {
        color: #008cff#196e78;
        font-size: 1.72rem;
    }

    .vaga-card button {
        all: unset;
        cursor: pointer;
        display: contents;
        width: 100%;
        height: 100%;
    }

    .vaga-card img {
        width: 120px;
        height: 120px;
    }

    .vaga-info{
        width: 100%;
        text-align: left;
        display: grid;
    }

    .vaga-info h4 {
        color: #008cff;
        font-size: 1.7rem;
        margin-bottom: 5px;
        font-family: 'Horizon', sans-serif;
        transition: .2s;
        /* width: 10rem; */
      overflow: hidden;
      text-overflow: ellipsis;
      display: -webkit-box;
      -webkit-line-clamp: 1;
      /* number of lines to show */
      line-clamp: 1;
      -webkit-box-orient: vertical;
    }

    .vaga-info p {
      font-size: 1rem;
      color: #444;
      text-overflow: ellipsis;
      text-align: left;
      flex: 1;
    
      /* width: 10rem; */
      overflow: hidden;
      text-overflow: ellipsis;
      display: -webkit-box;
      -webkit-line-clamp: 1;
      /* number of lines to show */
      line-clamp: 1;
      -webkit-box-orient: vertical;
    }

    .status-icon-externo {
      position: absolute;
      right: -20px;
      /* Ajustado para aproximar os ícones */
      font-size: 28px;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100%;
    }

    .icon-legenda {
      display: flex;
      gap: 30px;
      margin-top: 30px;
      font-weight: bold;
      color: #004d61;
    }

    .icon-legenda i {
      margin-right: 6px;
      font-size: 20px;
    }

    .situacao-titulo {
      display: flex;
      align-items: center;
      justify-content: space-between;
      cursor: pointer;
      margin-bottom: 10px
    }

    .situacao-opcoes {
      display: none;
      margin-bottom: 15px
    }

    .situacao-opcoes.ativo {
      display: block
    }

    .painel-bar {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 100%;
      background-color: #004d61;
      padding: 10px 0;
      background-image: url("../../img/detalhe-painel.png");
      background-repeat: no-repeat;
    }

    .painel-bar h1 {
      color: white;
      font-size: 2rem;
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

    .quantSlot{
      border-bottom: 5px solid #e66922;
      padding-bottom: -20px;
      margin-bottom: 1rem;
      margin-right: 10px;
      color: #e66922 !important
    }

    .bxs-user{
        font-size: 120px;
        color: #2289e6;
        margin-right: 10px;
    }

    .btn-volt-vag{
        width: 100%;
        margin-bottom: 15px;
        border-radius: none;
        color: white;
        background-color: black;
        border: none;
        font-size: 2rex;
        border: 1px solid black
    }

    .btn-volt-vag:hover {
        background-color: white;
        color: black;
        border: 1px solid black
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
      <h1>PROCURANDO VOLUNTARIOS</h1>
    </div>

    <form method="GET">
    <input type="hidden" name="name_slot" value="<?php echo $_GET['name_slot'] ?>" />
    <main class="container">
        <div>
            <form method="GET" >
            <button class="btn-volt-vag" name="voltar"><strong>VOLTAR A VAGA</strong></button>
            </form>
            <aside class="filtros">
                <h2>FILTROS</h2>
                    <label><input type="checkbox" value="categoria_trabalho"         name="categoria_trabalho"         <?php is_checked_before("categoria_trabalho"); ?>> Preferencia da Categoria dessa vaga</label>
                <h2></h2>
                <h4>PERIODO</h4>
                    <label><input type="checkbox" value="manha"       name="manha"       <?php is_checked_before("manha"); ?>> Manhã</label>
                    <label><input type="checkbox" value="tarde"       name="tarde"       <?php is_checked_before("tarde"); ?>> Tarde</label>
                    <label><input type="checkbox" value="noite"       name="noite"      <?php is_checked_before("noite"); ?>> Noite</label>
                    <label><input type="checkbox" value="madrugada"   name="madrugada"      <?php is_checked_before("madrugada"); ?>> Madrugada</label>
                    <label><input type="checkbox" value="integral"    name="integral"    <?php is_checked_before("integral"); ?>> Integral</label>
                <h2></h2>
                <h4>SITUAÇÃO</h4>
                    <label><input type="checkbox" value="estudante-F"   name="estudante-F"   <?php is_checked_before("estudante-F"); ?>> Estudante Funda.</label>
                    <label><input type="checkbox" value="estudante-M" name="estudante-M" <?php is_checked_before("estudante-M"); ?>> Estudante Médio</label>
                    <label><input type="checkbox" value="formado" name="formado" <?php is_checked_before("formado"); ?>> Formado</label>
                    <label><input type="checkbox" value="universitário"   name="universitário"   <?php is_checked_before("universitário"); ?>> Universitário</label>
                    <label><input type="checkbox" value="empregado" name="empregado" <?php is_checked_before("empregado"); ?>> Empregado</label>
                    <label><input type="checkbox" value="aposentado" name="aposentado" <?php is_checked_before("aposentado"); ?>> Aposentado</label>
                <h2></h2>
                <button class="btn btn-buscar">BUSCAR</button>
            </aside>
        </div>
    </form>

    <!-- Bloco de Vagas-->
    <section class="vagas">
    <?php include 'php_functs/php_screens/voluntary_searcher.php';
    do_voluntary_searcher(); ?>

    <!-- <div class="vaga-wrapper"> -->
        <!-- <div class="vaga-card">
          <i class='bxs-user' ></i>
          <img src="img\icons_blue\outro.png" alt="Ícone" />
          <div class="vaga-info">
            <h4>NOME DA VAGA</h4>
            <p>Descrição pequena que está dentro do banco que o Guilherme ainda tem que fazer e passar o arquivo pra
              mim.</p>
          </div>
        </div> -->
    </div>

    </section>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.2/dist/confetti.browser.min.js" defer></script>
  <script src='js/notification.js' defer></script>
</body>
</html>