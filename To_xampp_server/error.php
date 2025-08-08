<?php
session_start();

include 'php_functs/php_methods/functions.php';

// salva a url atual de telas dinâmicas
$_SESSION['tela_anterior'] = $_SERVER['REQUEST_URI'];

// busca situação de login do usuário
$login_state = is_logged();

// busca quem está logado
$is_ong = is_ong_logged();

// setar botões do header
$buttons_header = set_model_buttons_header($login_state, $is_ong);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link
      href="https://cdn.boxicons.com/fonts/basic/boxicons.min.css"
      rel="stylesheet"
    />
    <link rel="icon" href="img\Logo_Aba.png" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@40,400,0,0&icon_names=database_off" />
    <title>AjundeAi • Ops!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\header.css">

    <style>
        body{
            height: 100%; /* Altura da viewport */
            font-family: 'Poppins', sans-serif;
        }

        .error{
            display: grid;
            place-items: center;
            background-color: rgb(242, 242, 242);
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

    <div class="error">
        <span class="material-symbols-outlined" style="color: rgb(180, 180, 180); font-size: 20rem;">
        database_off
        </span>
        <h3 style="  text-align: center; color: gray"><i style="font-size: 3rem;">Ops!</i> <br>ocorreu um Erro ao tentar conectar ao servidor</h3>
        <h4 style="  text-align: center;">Tente Novamente mais Tarde</h4>
    </div>
    
</body>
</html>