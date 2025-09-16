<?php
session_start();

include 'php_functs/php_methods/functions.php';

// salva a url atual de telas dinâmicas
$_SESSION['tela_anterior'] = $_SERVER['REQUEST_URI'];

$_SESSION['oi'] = '10';
// busca situação de login do usuário
$login_state = is_logged();
// busca quem está logado
$is_ong = is_ong_logged();
// busca botões do header
$buttons_header = set_model_buttons_header($login_state, $is_ong);

// print_r($_SESSION);
function is_checked_before($name)
{
  if (isset($_GET[$name])) {

    echo 'checked';
  }
}
?>

<!-- Tela de Resultado da Pesquisa do Filtro -->
<!-- nome do form: filter -->
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.boxicons.com/fonts/basic/boxicons.min.css" rel="stylesheet" />
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=search_off" />
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=database_off" />
  <link rel="icon" href="img\Logo_Aba.png">
  <title>AjundeAi • Pesquisa</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/header.css">
  <link rel="stylesheet" href="css/notification.css">
  <link rel="stylesheet" href="css\css_screens\filter.css">
  <style>
    body::-webkit-scrollbar {
      display: none;
      /* Para navegadores baseados em WebKit (Chrome, Safari) */
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
    <!-- botões do header -->
    <?php echo $buttons_header; ?>
  </header>

  <form method="GET" action="filter.php">
    <input type="hidden" name="type" value="filter_base" />
    <header class="search-bar-imag">
      <div class="search-bar">
        <input type="text" name="filter_user" placeholder="Pesquise sua vaga solicitada" value="<?php if (isset($_GET['filter_user'])) {
          echo $_GET['filter_user'];
        } ?>" />
        <button class="btn btn-buscar" style="font-family: 'Horizon', sans-serif; font-size: 15px">BUSCAR</button>
      </div>
    </header>

    <main class="container">
      <aside class="filtros">
        <h2>FILTROS</h2>
        <label><input type="checkbox" value="saúde" name="saúde" <?php is_checked_before("saúde"); ?>> Saúde</label>
        <label><input type="checkbox" value="eventos" name="eventos" <?php is_checked_before("eventos"); ?>>
          Eventos</label>
        <label><input type="checkbox" value="animais" name="animais" <?php is_checked_before("animais"); ?>>
          Animais</label>
        <label><input type="checkbox" value="crianças" name="crianças" <?php is_checked_before("crianças"); ?>>
          Crianças</label>
        <label><input type="checkbox" value="educação" name="educação" <?php is_checked_before("educação"); ?>>
          Educação</label>
        <label><input type="checkbox" value="tecnologia" name="tecnologia" <?php is_checked_before("tecnologia"); ?>>
          Tecnologia</label>
        <label><input type="checkbox" value="assistencia" name="assistencia" <?php is_checked_before("assistencia"); ?>>
          Assist. Social</label>
        <label><input type="checkbox" value="administração" name="administração" <?php is_checked_before("administração"); ?>> Administração</label>
        <label><input type="checkbox" value="meio ambiente" name="meio_ambiente" <?php is_checked_before("meio_ambiente"); ?>> Meio Ambiente</label>
        <button class="btn btn-buscar" style="font-family: 'Horizon', sans-serif; font-size: 18px">BUSCAR</button>
      </aside>
  </form>

  <section class="vagas">
    <?php include 'php_functs/php_screens/filter_act.php';
    do_filter(); ?>

    <!-- <div class="quantSlot">
          <h3>[N] VAGAS DE [FILTRO] FORAM ENCONTRADAS</h3>
      </div>
      <div class="scroll-wrapper"> -->
    <!-- Aqui os blocos podem ser gerados via PHP   -->
    <!-- <div class="vaga-card">
          <img src="img\icons_orange\outro.png" alt="Ícone" />
          <div class="vaga-info">
            <h4>NOME DA VAGA</h4>
            <span>5/10 • Nome da ONG</span>
            <p>Descrição pequena que está dentro do banco que o Guilherme ainda tem que fazer e passar o arquivo pra mim.</p>
          </div>
        </div> -->
    <!-- Repita o .vaga-card conforme necessário -->

    </div>
  </section>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.2/dist/confetti.browser.min.js" defer></script>
  <script src='js/notification.js' defer></script>
</body>

</html>