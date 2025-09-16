<!-- Tela de controle de registrados á vaga selecionada da Ong registrada -->
<!-- Apresentação da vaga selecionada ao usuário -->
<?php
session_start();

// salva a url atual de telas dinâmicas (telas que o usuário fica indo e voltando normalmente durante o mesmo uso)
// ! Tabelas como login, criação de conta, vagas, voluntários não precisam disso
$_SESSION['tela_retrasada'] = $_SESSION['tela_anterior'];
$_SESSION['tela_anterior'] = $_SERVER['REQUEST_URI'];

include 'php_functs/php_methods/functions.php';

// busca situação de login do usuário
$login_state = is_logged();

if (!$login_state) {
  header('Location: ../../index.php');
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
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@40,400,0,0&icon_names=diversity_1" />

  <link href="https://cdn.boxicons.com/fonts/basic/boxicons.min.css" rel="stylesheet" />
  <link rel="icon" href="img\Logo_Aba.png" />
  <link rel="stylesheet" href="css/header.css">
  <link rel="stylesheet" href="css/notification.css">
  <link rel="stylesheet" href="css\css_screens\control_slot.css">
  <title>AjundeAi • Controle de Vaga</title>
  <style>
    body::-webkit-scrollbar {
      display: none;
      /* Para navegadores baseados em WebKit (Chrome, Safari) */
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

  <!-- <?php //include 'php_functs/show_slot.php'; do_slot(); ?>
         <header class="header2">
          <img src="img\office-building.png" alt="Ícone" class="vaga-name-img"/>
          <div class="vaga-name">
            <h4>NOME DA VAGA</h4>
            <span>Nome da ONG</span>
          </div>
    </header> -->

  <?php include 'php_functs/php_screens/show_slot.php';
  echo do_slot(); ?>
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
  <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.2/dist/confetti.browser.min.js" defer></script>
  <script src='js/notification.js' defer></script>
</body>

</html>