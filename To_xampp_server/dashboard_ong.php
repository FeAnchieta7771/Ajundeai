<!-- Tela de exibição da situação das vagas da Ong registrada -->
<!-- Acima de tudo -->
<?php
session_start();

// salva a url atual de telas dinâmicas (telas que o usuário fica indo e voltando normalmente durante o mesmo uso)
// ! Tabelas como login, criação de conta, vagas, voluntários não precisam disso
$_SESSION['tela_anterior'] = $_SERVER['REQUEST_URI'];

include 'php_functs/php_methods/functions.php';

// busca situação de login do usuário
$login_state = is_logged();

if (!$login_state) {
  header('Location: index.php');
  exit();
}

// busca quem está logado
$is_ong = is_ong_logged();

// setar botões do header
$buttons_header = set_model_buttons_header($login_state, $is_ong);

// echo "<pre>"; // Para melhor formatação
// print_r($_SESSION);
// echo "</pre>";
?>
<!-- Tela de exibição da situação das vagas da Ong registrada -->
<!-- Acima de tudo -->

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.boxicons.com/fonts/basic/boxicons.min.css" rel="stylesheet" />
  <link rel="icon" href="img/Logo_Aba.png">
  <title>AjundeAi • Vagas da ONG</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/header.css">
  <link rel="stylesheet" href="css/notification.css">
  <link rel="stylesheet" href="css\css_screens\dashboard_ong.css">

  <style>
    body::-webkit-scrollbar {
      display: none;
      /* Para navegadores baseados em WebKit (Chrome, Safari) */
    }

    .vaga-info p {
      font-size: 1rem;
      color: #444;
      width: 100%;
      /* ou defina uma largura fixa, se preferir */
      line-height: 1.4;
      display: -webkit-box;
      -webkit-line-clamp: 3;
      -webkit-box-orient: vertical;
      overflow: hidden;

      /* Importante para funcionar corretamente */
      text-overflow: ellipsis;
      word-break: break-word;
      /* quebra palavras longas */
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
  </div>

  <div class="add_vaga">
    <form method="GET" action="create_slot_ong.php">
      <button type="submit" class="button_add">
        <i class='bx  bx-plus' style="font-size: 40px; line-height: 1; display: inline-block;"></i>
        <span>Criar Vaga</span>
      </button>
    </form>
  </div>
  <main>
    <div class="section-title">Suas Vagas</div>
    <?php include 'php_functs/php_screens/filter_dashboard.php';
    do_dashboard(); ?>
    <!-- <div class="engloba">
      <div class="vaga-card">
        <img src="img/icons_orange/outro.png" alt="Ícone da vaga" />
        <div class="vaga-info">
          <h4>NOME DA VAGA hfhedschshdhcswjbjfjfgbfdcgdhvhgdhvhdhvhgdgcvgfdhcgdghvhdbhvhd</h4>
          <p>Descrição pequena que está dentro do banco que o Guilherme ainda tem que fazer e passar o arquivo para mim. E sim, isso é um texto exemplo.kkkkkkkkkkssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssdssdsdsdsdsdsdsdsdsdsdsdskkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkk</p>
        </div>
        <div class="vaga-extra" aria-label="Quantidade de candidatos">
          <i class='bx bxs-user' ></i>
          5/10
        </div>
      </div> -->

    <!-- Adicione outros cards abaixo -->
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.2/dist/confetti.browser.min.js" defer></script>
  <script src='js/notification.js' defer></script>
</body>

</html>