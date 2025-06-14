<?php
session_start();

include 'php_functs/functions.php';

// busca situação de login do usuário
$login_state = is_logged();
// busca quem está logado
$is_ong = is_ong_logged();
// busca botões do header
$buttons_header = set_model_buttons_header($login_state, $is_ong);
?>

<!-- Tela de Login -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="icon" href="img\Logo_Aba.png">
    <title>AjundeAi • Login</title>
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

        .log {
            background-image: url("https://assets.onecompiler.app/43h62qpv7/3y5x8jr6s/login.png");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            width: 100%;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
            text-align: center;
            color: white;
        }

        .fh1 {
            font-size: 60px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .fh1 span {
            display: block;
        }

        .form-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
        }

        .role-selector {
            background-color: #53d3d1;
            border-radius: 4px;
            margin-bottom: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            font-weight: bold;
            color: #004652;
            width: 500px;
        }

        .role-selector input {
            margin-right: 5px;
        }

        .role-selector .divider {
            color: #004652;
        }

        .form-container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 30px;
            border-radius: 8px;
            width: 500px;
            color: #004652;
            text-align: left;
            border-radius: 0px 0px 8px 8px;
        }

        .forms label {
            margin-top: 10px;
            font-weight: bold;
            display: block;
        }

        .forms input {
            padding: 10px;
            border: 1px solid #004652;
            border-radius: 4px;
            margin-top: 5px;
            width: 100%;
        }

        .signup {
            margin: 10px 0;
            color: #53d3d1;
            font-size: 14px;
        }

        .signup a {
            color: #53d3d1;
            font-weight: bold;
            text-decoration: none;
        }

        .signup a:hover {
            text-decoration: underline;
        }

        .btlog {
            background-color: #f26b1d;
            border: none;
            padding: 12px;
            border-radius: 6px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            margin-top: 10px;
            font-size: 20px;
            width: 500px;
            transition: .15s;
        }

        .btlog:hover {
            transform: scale(1.02);
            background-color: white;
            color: #f26b1d;
        }

        /*  */

        .content {
    display: none
}

.content.show{
    display: flex;
    gap: 14px;
}

#container{
    padding: 20px;
    box-shadow: 0px 10px 15px -3px rgba(0, 0, 0, 0.1);
}

.tab-buttons{
    display: flex;
    gap: 6px;
    width: 500px;
    justify-items: center;
    justify-content: center;
}

.tab-btn {
    width: 100%;
    border: none;
    color: black;
    font-weight: bold;
    padding: 8px;
    cursor: pointer;
    transition: background-color .2s ease;
    background-color: rgba(137, 151, 172, 0.8);
    color: rgba(31, 39, 49, 0.8);
}
.tab-btn.active{
    background-color:rgba(255, 255, 255, 0.8);
    color: #004652;
    font-size: 20px;
}

.tab-btn:hover{
    background-color:rgba(255, 255, 255, 0.59)
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

    <div class="log">
        <div class="fh1">
            BEM VINDO DE VOLTA!<br><span>FAÇA SEU LOGIN!</span>
        </div>
        <div id="container">
          <div class="tab-buttons">
            <button class="tab-btn active" content-id="home">
              <i class='bx bxs-user-circle' ></i> Voluntário
            </button>

            <button class="tab-btn" content-id="services">
              <i class='bx bxs-buildings' ></i> ONG
            </button>

          </div>

          <div class="tab-contents">

            <div class="content show" id="home">
              <div class="form-wrapper">
                  <form class="forms" method="POST" action="php_functs/doLogin.php">

                      <input type="hidden" name="login_state" value="voluntario">
                      <div class="form-container">
                          <label for="email">NOME OU EMAIL</label>
                          <input type="text" name="email" placeholder="Insira nome ou email aqui">
                          <br>
                          <br>
                          <label for="password">SENHA</label>
                          <input type="password" name="password" placeholder="Insira sua senha aqui">
                      </div>

                      <p class="signup">Não possui uma conta? <a href="#">CADASTRE-SE</a></p>
                      <button class="btlog" type="submit">LOGIN</button>
                  </form>
              </div>
            </div>

            <div class="content" id="services">
              <div class="form-wrapper">
                  <form class="forms" method="POST" action="php_functs/doLogin.php">
                    
                      <input type="hidden" name="login_state" value="ong">
                      <div class="form-container">
                          <label for="email">NOME OU EMAIL DA ONG</label>
                          <input type="text" name="email" placeholder="Insira nome ou email aqui">
                          <br>
                          <br>
                          <label for="password">SENHA DE REGISTRO</label>
                          <input type="password" name="password" placeholder="Insira sua senha aqui">
                      </div>

                      <p class="signup">Não possui uma conta? <a href="#">CADASTRE-SE</a></p>
                      <button class="btlog" type="submit">LOGIN</button>
                  </form>
              </div>
            </div>

          </div>
        </div>
    </div>

    <script>
        // pego todos os botões
        const tabs = document.querySelectorAll('.tab-btn');

        // atribuição da função á todos eles
        tabs.forEach( tab => tab.addEventListener('click', () => tabClicked(tab)))

        // função a caso sejam clicados
        const tabClicked = (tab) => {

            tabs.forEach(tab => tab.classList.remove('active'));
            tab.classList.add('active');
            // pego todos os paineis
            const contents = document.querySelectorAll('.content');

            //desativação dos paineis visíveis
            contents.forEach(content => content.classList.remove('show'));

            // pegar atributo do botão clicado
            const contentId = tab.getAttribute('content-id');

            // pegar painel com o mesmo ID do atributo do botão
            const content = document.getElementById(contentId);

            content.classList.add('show');
        }
    </script>
</body>
</html>
