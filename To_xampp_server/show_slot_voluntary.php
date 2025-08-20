<!-- Apresentação da vaga selecionada ao usuário -->
<?php
session_start();

include 'php_functs/php_methods/functions.php';

// salva a url atual de telas dinâmicas
$_SESSION['tela_de_vaga'] = $_SERVER['REQUEST_URI'];
$_SESSION['tela_anterior'] = $_SERVER['REQUEST_URI'];

// busca situação de login do usuário
$login_state = is_logged();

// busca quem está logado
$is_ong = is_ong_logged();

// setar botões do header
$buttons_header = set_model_buttons_header($login_state, $is_ong);

// print_r($_SESSION);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@40,400,0,0&icon_names=diversity_1"
    />

        <link
      href="https://cdn.boxicons.com/fonts/basic/boxicons.min.css"
      rel="stylesheet"
    />
  <link rel="icon" href="img\Logo_Aba.png" />
  <link rel="stylesheet" href="css/header.css">
  <link rel="stylesheet" href="css/notification.css">
  <link rel="stylesheet" href="css\css_screens\show_slot.css">
  <title>AjundeAi • Vaga</title>
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
            display: none; 
    }

    .search-bar-imag{
      background-image: url("../../img/detalhe-painel.png");
      background-repeat: no-repeat;
      background-color: #004d61;
      justify-content: center;
    }

    .search-bar {
      display: flex;
      align-items: center;
      gap: 10px;
      flex: 1;
      max-width: 400px;
    }

    .search-bar input {
      padding: 10px 15px;
      flex: 1;
      border-radius: 8px;
      border: none;
      font-size: 1rem;
    }
    
    .header2 {
      background-color: #e68c22;
      padding: 15px 30px;
      display: flex;
      align-items: center;
      justify-content: left;
    }

    .vaga-name {
      align-items: center;
      justify-content: center;
      margin-left: 5px;
    }

    .vaga-name h4 {
      color:rgb(255, 255, 255);
      font-size: 2.5rem;
      font-family: 'Horizon', sans-serif;
    }

    .vaga-name span {
      display: block;
      margin-bottom: 5px;
      color:rgb(255, 255, 255);
      font-weight: bold;
      font-family: 'Antique', sans-serif;
    }

    .vaga-name-img {
      margin-left: 20%;
      width: 140px;
      height: 140px;
    }
   
    .vaga-container {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      padding: 30px;
      background-color: white;
      margin-top: 1.5%;
    }
   
    .vaga-descricao {
        flex: 1;
        width: 70%;
        margin-left: 20%;
        margin-right: 150px;
    }
   
    .vaga-descricao-titulo {
      color: #2289e6;
      font-size: 2rem;
      margin-bottom: 15px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
   
    .vaga-descricao-titulo span {
      font-size: 1.6rem;
      color: #2289e6;
    }
   
    .vaga-descricao-texto {
      line-height: 1.6;
      color: #003e53;
    }
   
    .vaga-lateral {
      width: 20%;
      margin-right: 10%;
      display: flex;
      flex-direction: column;
    }

    .card-curriculo {
      display: flex;
      align-items: center;
      /* justify-content: space-between; */
      gap: 8px;
      /* padding: 12px; */
      /* border-radius: 4px; */
      padding-bottom: 1rem;
      border-bottom: solid 3px #e76f00;
      width: 100%; 
    }

    .btn-curriculo {
      background-color: #e76f00;
      border: solid 1px #e76f00;
      color: white;
      font-weight: bold;
      font-size: 1rem;
      padding: 15px;
      cursor: pointer;
      transition: .15s;
      /* width: 100%; */
      flex: 1;
    }

    .btn-curriculo:hover{
      background-color: white;
      color: #e76f00;
    }
   
    .btn-curriculo-negado {
      background-color: #ff3131;
      border: none;
      color: white;
      font-weight: bold;
      font-size: 1rem;
      padding: 15px;
      /* cursor: pointer; */
      width: 100%;
    }
   
    .btn-curriculo-aceito {
      background-color: #29b226;
      border: none;
      color: white;
      font-weight: bold;
      font-size: 1rem;
      padding: 15px;
      /* cursor: pointer; */
      width: 100%;
    }
   
    .btn-curriculo-lotado {
      background-color: black;
      border: none;
      color: white;
      font-weight: bold;
      font-size: 1rem;
      padding: 15px;
      cursor: pointer;
      width: 100%;
    }

    .btn-icon-salvar {
      padding: 10px;
      font-size: 1.5rem;
      padding: 15px 15px;
      /* margin-left: 50px; */
      /* height: 74px; */
      display: flex;
      align-items: center;
      background-color: #2289e6;
      color: white;
      border: 1px solid #2289e6;
      cursor: pointer;
      transition: .15s;
      flex: 0;
    }

    .btn-icon-salvar:hover{
      background-color: white;
      color: #2289e6
    }
   
    .btn-icon-desalvar {
      /* padding: 20px; */
      padding: 10px;
      font-size: 1.5rem;
      /* margin-left: 50px; */
      /* height: 74px; */
      /* display: flex;  */
      align-items: center;
      background-color: #ffffffff;
      color: #2289e6;
      border: 1px solid #2289e6;
      cursor: pointer;
      transition: .15s;
    }

    .btn-icon-desalvar:hover {
      background-color: #031c31ff;
      color: white;
    }
   
    .btn-icon-aguarde {
      /* padding: 20px; */
      padding: 10px;
      font-size: 1.5rem;
      /* margin-left: 50px; */
      /* height: 74px; */
      /* display: flex; */
      align-items: center;
      background-color: black;
      color: #ffffffff;
      border: 1px solid black;
    }
   
    .vaga-localizacao {
      border: 2px solid #004d61;
      padding: 15px;
    }
   
    .vaga-localizacao h4 {
      color: #e76f00;
      font-weight: bold;
      font-size: 1.1rem;
      border-bottom: 2px solid #a54ff0;
      display: inline-block;
      margin-bottom: 10px;
    }
   
    .vaga-localizacao p {
      color: #004d61;
      font-style: italic;
      font-size: 0.9rem;
      line-height: 1.4;
      word-break: break-word;
    }

    .alert_limit{
      font-style: italic;
      font-family: 'Antique', sans-serif;
      font-size: 0.8rem;
      margin-bottom: 1rem;
      color: #919191ff;
    }

    .alert_limit_busy{
      color: #451313ff;
      font-style: italic;
      font-family: 'Antique', sans-serif;
      font-size: 0.8rem;
    }

    .alert_limit_busy a{
      color: #ff0000ff;
      font-size: 0.9rem;
      font-weight: bold;
      cursor: pointer;
    }

    .alert_limit_busy a:hover{
      text-decoration: underline 2px;
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
        <!-- botões do header -->
        <?php echo $buttons_header; ?>
    </header>
  <?php show_message(); ?>
  
        <form method="GET" action="filter.php">
          <input type="hidden" name="type" value="filter_base"/>
          <header class="search-bar-imag">
          <div class="search-bar">
               <input type="text" name="filter_user" placeholder="Pesquise sua vaga solicitada" value="<?php if(isset($_GET['filter_user'])){ echo $_GET['filter_user'];}?>"/>
               <button class="btn btn-buscar" style="font-family: 'Horizon', sans-serif; font-size: 15px">BUSCAR</button>
          </div>
          </header>

           
        </form>

        <?php include 'php_functs/php_screens/show_slot.php'; do_slot(); ?>
    <!-- <header class="header2">
          <img src="img\office-building.png" alt="Ícone" class="vaga-name-img"/>
          <div class="vaga-name">
            <h4>NOME DA VAGA</h4>
            <span>Nome da ONG</span>
          </div>
    </header>
   
    <main class="vaga-container">
      <div class="vaga-descricao">
        <h3 class="vaga-descricao-titulo">DESCRIÇÃO DA VAGA <div><i class='bx bxs-user' ></i> 25/50</div> </h3>
        <p class="vaga-descricao-texto">
          CSEIUOGHSSOKJNGFCLKGMJLCDKWEÇMHNGFJHKJHL Kbvuhftrhntgthudycetretxrxr
          efS6tdgoyoi7oioloioioi767767676767676767676767
          676767676767676767676767676 vtrd vtrd vtrd vtrd
          vtrd vtrd vtrd vtrd vtrd vtrd vtrd vtrd vtrd vtrd
          vtrd vtrd vtrd vtrd vtrd vtrd vtrd vtrd vtrd vtrd
          vtrd vtrd vtrd vtrd vtrd vtrd vtrd vtrd vtrd vtrd
          vtrd vtrd vtrd vtrd vtrd vtrd vtrd vtrd vtrd vtrd
          vtrd vtrd vtrd vtrd vtrd vtrd vtrd
          vttrdgfuyfgbktunnjnl.lh.lolkj..
          asiufuhdfvkfjvkvfivfvvfvfvfvfvfkfjrkehnhh. Sim.
        </p>
      </div> -->


      <!-- NOVOS BOTÕES -->
      <!-- <div class="vaga-lateral"> -->
        <!--<div class="card-curriculo">
          <button class="btn-curriculo">ENVIAR CURRÍCULO</button>
          <button class="btn-icon-salvar"><i class='bx bxs-bookmark'></i></button>
        </div>
        
        <div class="card-curriculo">
          <button class="btn-curriculo">ENVIAR CURRÍCULO</button>
          <button class="btn-icon-desalvar"><i class='bx bxs-bookmark'></i></button>
        </div>
        -->
        <!-- <div class="card-curriculo">
          <button class="btn-curriculo" style="background-color: #003e53;">CANCELAR ENVIO</button>
          <button class="btn-icon-aguarde"><i class='bx bxs-hourglass'></i></button>
        </div> -->
        <!--
        <div class="card-curriculo">
          <button class="btn-curriculo-negado">NEGADO PARA VAGA...</button>
        </div>
       
        <div class="card-curriculo">
          <button class="btn-curriculo-aceito">APROVADO PARA VAGA!</button>
        </div>
        
        <div class="card-curriculo">
          <button class="btn-curriculo-lotado">VAGA LOTADA</button>
        </div>
       -->
        <!-- <div class="vaga-localizacao">
          <h4>LOCALIZAÇÃO</h4>
          <p><em>GSEIUOGHSSOKJNGFÇLKGMJLÇDKWEÇ<br>MHNGFJHKJHLK</em></p>
        </div>
      </div>
    </main> -->
  </main>
  <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.2/dist/confetti.browser.min.js" defer></script>
  <script src='js/notification.js' defer></script>
</body>
</html>