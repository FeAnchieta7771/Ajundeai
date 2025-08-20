<?php
session_start();
include 'php_functs/php_methods/functions.php';

function save_value($name, $for)
{
  if (isset($_SESSION[$name], $_SESSION['login_state']) && $_SESSION['login_state'] == $for) {
    return htmlspecialchars($_SESSION[$name]);
  }

  return '';
}

// busca situação de login do usuário
$login_state = is_logged();
// busca quem está logado
$is_ong = is_ong_logged();
// busca botões do header
$buttons_header = set_model_buttons_header($login_state, $is_ong);

// print_r($_SESSION);
?>

<!-- Tela de Login -->
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link
      href="https://cdn.boxicons.com/fonts/basic/boxicons.min.css"
      rel="stylesheet"
    />
  <link rel="icon" href="img\Logo_Aba.png">
  <title>AjundeAi • Login</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/header.css">
  <link rel="stylesheet" href="css/css_screens/login.css">
  <link rel="stylesheet" href="css/notification.css">

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
    <!-- botões do header -->
    <?php echo $buttons_header; ?>
  </header>

  <?php show_message(); ?>

  <div class="log">
    <div class="fh1">
      BEM VINDO DE VOLTA!<br><span>realize seu login.</span>
    </div>
    <div id="container">
      <div class="tab-buttons">
        <button class="tab-btn active" content-id="home">
          <i class='bx bxs-user-circle'></i> Voluntário
        </button>

        <button class="tab-btn" content-id="services">
          <i class='bx bxs-buildings'></i> ONG
        </button>

      </div>

      <div class="tab-contents">

        <div class="content show" id="home">
          <div class="form-wrapper">
            <form class="forms" method="POST" action="php_functs/php_screens/doLogin.php">

              <input type="hidden" name="login_state" value="voluntario">
              <div class="form-container">
                <label for="email">NOME OU EMAIL</label>
                <input type="text" name="email" placeholder="Insira nome ou email aqui" maxlength="150" required
                  value='<?php echo save_value('nome_email','voluntario');?>'>
                <br>
                <br>
                <label for="password">SENHA</label>
                <input type="password" name="password" placeholder="Insira sua senha aqui" maxlength="20" required
                  value='<?php echo save_value('password','voluntario');?>'>
              </div>

              <p class="signup">Não possui uma conta? <a href="account.php">CADASTRE-SE</a></p>
              <button class="btlog" type="submit">LOGIN</button>
            </form>
          </div>
        </div>

        <div class="content" id="services">
          <div class="form-wrapper">
            <form class="forms" method="POST" action="php_functs/php_screens/doLogin.php">

              <input type="hidden" name="login_state" value="ong">
              <div class="form-container">
                <label for="email">NOME OU EMAIL DA ONG</label>
                <input type="text" name="email" placeholder="Insira nome ou email aqui" maxlength="150"
                  value='<?php echo save_value('nome_email','ong');?>'>
                <br>
                <br>
                <label for="password">SENHA DE REGISTRO</label>
                <input type="password" name="password" placeholder="Insira sua senha aqui" maxlength="20"
                  value='<?php echo save_value('password','ong');?>'>
              </div>

              <p class="signup">Não possui uma conta? <a href="account.php">CADASTRE-SE</a></p>
              <button class="btlog" type="submit">LOGIN</button>
            </form>
          </div>
        </div>

      </div>
    </div>
  </div>
  <script src='js/notification.js' defer></script>
  <script src="js/direct_forms.js"></script>

</body>

</html>