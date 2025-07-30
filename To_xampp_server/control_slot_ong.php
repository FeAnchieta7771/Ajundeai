<!-- Tela de controle de registrados á vaga selecionada da Ong registrada -->
<!-- Apresentação da vaga selecionada ao usuário -->
<?php
session_start();

// salva a url atual de telas dinâmicas (telas que o usuário fica indo e voltando normalmente durante o mesmo uso)
// ! Tabelas como login, criação de conta, vagas, voluntários não precisam disso
$_SESSION['tela_anterior'] = $_SERVER['REQUEST_URI'];

include 'php_functs/functions.php';

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
  <title>AjundeAi • Controle de Vaga</title>
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
      border-radius: 20px;
      border: none;
      font-size: 1rem;
    }

    .buttons {
      display: flex;
      gap: 10px;
    }

    .btn-entrar {
      background-color: white;
      color: #e76f00;
      border: 2px solid #e76f00;
    }

    .btn-cadastro {
      background-color: #00c4b4;
      color: white;
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
   
    .btn-curriculo {
      background-color: #e76f00;
      border: none;
      color: white;
      font-weight: bold;
      font-size: 1rem;
      padding: 22px;
      cursor: pointer;
      width: 250px;
    }
   
    .curriculo-icon {
      background-color: #007bff;
      color: white;
      padding: 20px;
      font-size: 1rem;
    }
   
    .voluntarios {
      border: 2px solid #2289e6;
      padding: 15px;
      max-height: 300px;
    }
   
    .voluntarios h4 {
      font-family: 'Horizon';
      vertical-align: middle;
      color: #e76f00;
      font-weight: bold;
      font-size: 2rem;
      display: inline-block;
      margin-bottom: 10px;
    }
   
    .fixa-scroll {
      overflow-y: auto;
      max-height: 200px; /* ajuste a altura máxima */
      padding-right: 10px;
    }
   
    .fixa {
      display: flex;
      align-items: center;
      margin-bottom: 10px;
    }

    .fixa p{
      color: #afafafff;
      font-family: 'Antique';
    }
   
    .fixa i {
      color: #2289e6;
      font-size: 24px;
      margin-right: 8px;
    }
   
    .fixa-buton {
      flex: 1;
    }
   
    .voluntario-btn {
      background: none;
      border: none;
      color: #2289e6;
      font-weight: bold;
      cursor: pointer;
      font-size: 1rem;
    }
   
    .voluntario-btn:hover {
      text-decoration: underline;
    }
   
    .voluntario-nome {
      color: #2289e6;
      font-weight: bold;
    }
   
    .status-aguarde {
      display: block;
      font-size: 0.9rem;
      color: #000;
      font-weight: bold;
    }
   
    .status-aprovado {
      display: block;
      font-size: 0.9rem;
      color: green;
      font-weight: bold;
    }
   
    .status-negado {
      display: block;
      font-size: 0.9rem;
      color: red;
      font-weight: bold;
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

        <!-- <?php //include 'php_functs/show_slot.php'; do_slot(); ?>
         <header class="header2">
          <img src="img\office-building.png" alt="Ícone" class="vaga-name-img"/>
          <div class="vaga-name">
            <h4>NOME DA VAGA</h4>
            <span>Nome da ONG</span>
          </div>
    </header> -->
   
    <?php include 'php_functs/show_slot.php'; echo do_slot();?>
    <!-- <main class="vaga-container">
      <div class="vaga-descricao">
        <h3 class="vaga-descricao-titulo">DESCRIÇÃO DA VAGA <div><i class='bx bxs-user' ></i> 25/50</div> </h3>
        <p class="vaga-descricao-texto"> 
          puxar descrição do banco de dados -->
        <!-- </p>
      </div>
   
      <div class="vaga-lateral">
        <div class="voluntarios">
          <h4>VOLUNTARIOS</h4>
         
          <div class="fixa-scroll">
             Exemplo de voluntário EM AGUARDE -->
            <!-- <div class="fixa">
              <i class='bx bxs-user'></i>
              <div class="fixa-buton">
                <form method="GET" action="...">
                <button class="voluntario-btn">Voluntário1</button>
                </form>
              </div>
              <span class="status-aguarde">Em Aguarde</span>
            </div> -->
         
            <!-- Exemplo de voluntário APROVADO -->
            <!-- <div class="fixa">
              <i class='bx bxs-user'></i>
              <div class="fixa-buton">
                <span class="voluntario-nome">Voluntário2</span>
              </div>
              <span class="status-aprovado">Aprovado</span>
            </div> -->
         
            <!-- Exemplo de voluntário NEGADO -->
            <!-- <div class="fixa">
              <i class='bx bxs-user'></i>
              <div class="fixa-buton">
                <span class="voluntario-nome">Voluntário3</span>
              </div>
              <span class="status-negado">Negado</span>
            </div> -->
<!--            
            <div class="fixa">
              <i class='bx bxs-user'></i>
              <div class="fixa-buton">
                <span class="voluntario-nome">Voluntário3</span>
              </div>
              <span class="status-negado">Negado</span>
            </div>
            <div class="fixa">
              <i class='bx bxs-user'></i>
              <div class="fixa-buton">
                <span class="voluntario-nome">Voluntário3</span>
              </div>
              <span class="status-negado">Negado</span>
            </div>
            <div class="fixa">
              <i class='bx bxs-user'></i>
              <div class="fixa-buton">
                <span class="voluntario-nome">Voluntário3</span>
              </div>
              <span class="status-negado">Negado</span>
            </div>
            <div class="fixa">
              <i class='bx bxs-user'></i>
              <div class="fixa-buton">
                <span class="voluntario-nome">Voluntário3</span>
              </div>
              <span class="status-negado">Negado</span>
            </div>
            <div class="fixa">
              <i class='bx bxs-user'></i>
              <div class="fixa-buton">
                <span class="voluntario-nome">Voluntário3</span>
              </div>
              <span class="status-negado">Negado</span>
            </div>
            <div class="fixa">
              <i class='bx bxs-user'></i>
              <div class="fixa-buton">
                <span class="voluntario-nome">Voluntário3</span>
              </div>
              <span class="status-negado">Negado</span>
            </div>
            <div class="fixa">
              <i class='bx bxs-user'></i>
              <div class="fixa-buton">
                <span class="voluntario-nome">Voluntário3</span>
              </div>
              <span class="status-negado">Negado</span>
            </div> -->
         
            <!-- ...outros voluntários aqui... -->
          <!-- </div>
         
        </div>
      </div>

    </main>

  </main> --> 
</body>
</html>