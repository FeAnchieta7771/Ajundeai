<!-- Tela de exibição da situação das vagas da Ong registrada -->
<!-- Acima de tudo -->
<?php
session_start();

// salva a url atual de telas dinâmicas (telas que o usuário fica indo e voltando normalmente durante o mesmo uso)
// ! Tabelas como login, criação de conta, vagas, voluntários não precisam disso
$_SESSION['tela_anterior'] = $_SERVER['REQUEST_URI'];

include 'php_functs/functions.php';

// busca situação de login do usuário
$login_state = is_logged();

// busca quem está logado
$is_ong = is_ong_logged();

// setar botões do header
$buttons_header = set_model_buttons_header($login_state, $is_ong);
?>

 <!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link
      href="https://cdn.boxicons.com/fonts/basic/boxicons.min.css"
      rel="stylesheet"
    />
  <link rel="icon" href="img/Logo_Aba.png">
  <title>AjundeAi • Vagas da ONG</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/header.css">

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

    .painel-bar {
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: #004d61;
      padding: 20px 0;
    }

    .painel-bar h1 {
      color: white;
      font-size: 2rem;
    }

    main {
      padding: 40px 20px;
      max-width: 900px;         /* Limita a largura máxima */
      margin: 0 auto;           /* Centraliza na tela */
    }

    .section-title {
      font-weight: bold;
      color: #004d61;
      font-size: 1.2rem;
      margin-bottom: 20px;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    .engloba {
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    .vaga-card form{
        all: unset;
        cursor: pointer;
        display: contents;

    }

    .vaga-card {
      border: 2px solid #196e78;
      padding: 20px;
      display: flex;
      gap: 20px;
      align-items: center;
      background-color: #f9f9f9;
      flex-wrap: wrap;
      height: 170px;
      align-items: center;     /* Alinha verticalmente no centro */
      transition: .15s;
    }

    .vaga-card button{
        all: unset;
        cursor: pointer;
        display: contents;
        width: 100%;
        height: 100%;

    }

    .vaga-card:hover{
      background-color: rgb(161, 255, 247);
    }

    .vaga-card:hover h4{
      color:#e76f00;
      font-size: 1.52rem;
    }

    .vaga-card img {
      width: 120px;
      height: 120px;
      object-fit: contain;
    }

    .vaga-info {
      flex: 1;
      min-width: 200px;
    }

    .vaga-info h4 {
      color: #0075f2;
      font-size: 1.5rem;
      font-weight: bold;
      font-family: 'Horizon', sans-serif;
      transition: .2s;
    }

    .vaga-info h3 {
      color: #0075f2;
      font-size: 1.5rem;
      font-weight: bold;
      font-family: 'Horizon', sans-serif;
      transition: .2s;
    }

    .vaga-info p {
      font-size: 1rem;
      color: #444;
      max-width: 600px;
    }

    .vaga-extra {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      color: #004d61;
      font-size: 1.2rem;
      font-weight: bold;
      min-width: 80px;
    }

    .vaga-extra i {
      font-size: 60px;
      margin-bottom: 5px;
    }

    .button_add{
      color: white;
      background-color: #0075f2;
      box-shadow: 0px 10px 15px -3px rgba(0, 117, 242, 0.46);
      width: 100px;
      height: 100px;
      border-width: 0px;
      border-radius: 100px;
      display: flex;               
      justify-content: center;
      align-items: center;         
      gap: 10px;                   
      cursor: pointer;
      transition: .1s;
    }

    .button_add:hover{
      width: 200px;
    }

    .button_add:hover span{
      display: block;
    }

    .button_add span{
      display: none;
      font-size: 1.2rem;
      font-family: 'Horizon', sans-serif;
    }

    .add_vaga{
      display: flex;
        align-items: center;
  justify-content: center; 
      vertical-align: middle;
      position: fixed;
      bottom: 32px;
      right: 32px;
    }
  </style>
</head>

<body>
<header>
    <div class="logo">
        <a href="index.php">
            <img src="img\Logo_Header.png" alt="Logo AjundeAi" />
        </a>
    </div>
    <?php echo $buttons_header; ?>
</header>

  <div class="painel-bar">
    <h1>PAINEL DE CONTROLE</h1>
  </div>

  <div class="add_vaga">
    <form method="GET" action="create_slot_ong.php">
    <button type="submit" class="button_add">
      <i class='bx  bx-plus' style="font-size: 40px; line-height: 1; display: inline-block;" ></i>  
      <span>Criar Vaga</span>
    </button>
    </form>
  </div>
  <main>
    <div class="section-title">Suas Vagas</div>
    <?php include 'php_functs\filter_dashboard.php'; do_dashboard(); ?>
    <!-- <div class="engloba">
      <div class="vaga-card">
        <img src="img/icons_orange/outro.png" alt="Ícone da vaga" />
        <div class="vaga-info">
          <h4>NOME DA VAGA</h4>
          <p>Descrição pequena que está dentro do banco que o Guilherme ainda tem que fazer e passar o arquivo para mim. E sim, isso é um texto exemplo.</p>
        </div>
        <div class="vaga-extra" aria-label="Quantidade de candidatos">
          <i class='bx bxs-user' ></i>
          5/10
        </div>
      </div> -->

      <!-- Adicione outros cards abaixo -->
    </div>
  </main>
</body>
</html>