<?php
session_start();

$_SESSION['tela_retrasada_profile'] = $_SESSION['tela_anterior'];
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
// echo $_SESSION['id'];
// print_r($_SESSION);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.boxicons.com/fonts/basic/boxicons.min.css" rel="stylesheet" />
  <link rel="icon" href="img/Logo_Aba.png" />
  <title>AjundeAi - Perfil Voluntário</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="css/notification.css">
  <link rel="stylesheet" href="css\css_screens\profile.css">
  <link rel="stylesheet" href="css/header.css" />
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

  <?php include "php_functs\php_screens\profile_act.php";
  account_type($is_ong); ?>
  <!-- 

  Conteúdo principal
  <div class="painel">
    Perfil Voluntário
    <div class="perfil" id="perfilBox">
      <div class="perfil-header">
        <div class="left">
          <i class='bx bxs-user' style="font-size:22px;"></i>
          <span>TIPO DA CONTA: VOLUNTÁRIO</span>
        </div>
        <button class="btn-trash" title="Excluir conta">
          <i class='bx bxs-trash'></i>
        </button>
      </div>
      <form id="formPerfil">
        <input type="text" name="nome" placeholder="Nome" disabled>
        <input type="text" name="cpf" placeholder="CPF" disabled>
        <input type="email" name="email" placeholder="Email" disabled>
        <input type="password" name="senha" placeholder="Senha" disabled>
        <input type="text" name="telefone" placeholder="Telefone" disabled>
        <input type="text" name="whatsapp" placeholder="WhatsApp" disabled>
        <input type="text" name="categoria" placeholder="Categoria de preferência" disabled>
        <input type="text" name="periodo" placeholder="Período" disabled>
        <input type="text" name="situacao" placeholder="Situação atual" disabled>
        <input type="text" name="deficiencia" placeholder="Deficiência" disabled>
        <textarea name="sobre" placeholder="Conte um pouco sobre você e suas experiências" disabled></textarea>

        <div class="botoes">
          <button type="button" class="btn btn-editar" id="btnEditar">Editar</button>
          <button type="button" class="btn btn-cancelar" id="btnCancelar" style="display:none;">Cancelar</button>
          <button type="submit" class="btn btn-alterar" id="btnAlterar" style="display:none;">Alterar</button>
        </div>
      </form>
    </div>

    Vagas Cadastradas
    <div class="vagas-box">
      <h3>Vagas Cadastradas</h3>
      <small>1/3 cadastros permitidos</small>
      <button class="btn-controle">Ver Controle de Vagas</button>

      COMO O PHP CHAMA ESSE BOTÃO
      <button><div class='vaga-item'><span>" . $vaga['nome'] . "</span><span>" . $vaga['nome_ong'] . "</span></div></button></form>"

    </div>
  </div> -->

  <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.2/dist/confetti.browser.min.js" defer></script>
  <script src='js/notification.js' defer></script>
  <script src="js/whatsapp.js"></script>
  <script src="js/phone.js"></script>
  <script src="js/cpf.js"></script>
  <script>
    const form = document.getElementById('formPerfil');
    const perfilBox = document.getElementById('perfilBox');
    const btnEditar = document.getElementById('btnEditar');
    const btnCancelar = document.getElementById('btnCancelar');
    const btnAlterar = document.getElementById('btnAlterar');
    const inputs = form.querySelectorAll('input, textarea');

    const labels = document.querySelectorAll('div.form-row label');

    const values = []

    inputs.forEach((input, i) => {

      values[i] = input.value;
    });

    btnEditar.addEventListener('click', () => {
      inputs.forEach(el => el.disabled = false);
      labels.forEach(label => label.style.color = 'white');

      perfilBox.classList.add('editando');
      btnEditar.style.display = 'none';
      btnCancelar.style.display = 'inline-block';
      btnAlterar.style.display = 'inline-block';
    });

    btnCancelar.addEventListener('click', () => {
      inputs.forEach(el => el.disabled = true);
      inputs.forEach((el, i) => el.value = values[i]);
      labels.forEach(label => label.style.color = '#004652');

      perfilBox.classList.remove('editando');
      btnEditar.style.display = 'inline-block';
      btnCancelar.style.display = 'none';
      btnAlterar.style.display = 'none';
    });

  </script>
</body>

</html>