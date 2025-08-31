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

    body::-webkit-scrollbar {
            display: none; 
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