<?php
session_start();

include 'php_functs/functions.php';

// busca situação de login do usuário
$login_state = is_logged();

// busca quem está logado
$is_ong = is_ong_logged();

// setar botões do header
$buttons_header = set_model_buttons_header($login_state, $is_ong);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
        <link
      href="https://cdn.boxicons.com/fonts/basic/boxicons.min.css"
      rel="stylesheet"
    />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/header.css">
    <title>AjundeAi • Criação de contas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            color: #333;
            position: relative;
        }
        
        .background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            opacity: 0.1;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        
        .logo-title {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .logo-img {
            width: 40px;
            height: 40px;
        }
        
        h1 {
            font-size: 24px;
            margin: 0;
        }
        
        .header-buttons {
            display: flex;
            gap: 10px;
        }
        
        h2 {
            text-align: center;
            font-size: 20px;
            margin-bottom: 30px;
        }
        
        .account-type {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-bottom: 30px;
        }
        
        .account-option {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }
        
        .account-option input {
            margin: 0;
        }
        
        .account-logo {
            width: 24px;
            height: 24px;
        }
        
        .form-row {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }
        
        .form-group {
            flex: 1;
        }
        
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .form-group input, .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }
        
        .form-group textarea {
            height: 200px;
            resize: vertical;
        }
        
        .phone-field {
            transition: all 0.3s ease;
        }
        
        .hidden {
            display: none;
        }
        
        .bio-container {
            margin-bottom: 20px;
        }
        
        .bio-container p {
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .divider {
            border-top: 1px solid #ccc;
            margin: 30px 0;
        }
        
        .terms {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .terms label {
            font-size: 14px;
            cursor: pointer;
            margin-left: 8px;
        }
        
        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 4px;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            display: inline-block;
        }
        
        .btn-primary {
            background-color: #4CAF50;
            color: white;
        }
        
        .btn-secondary {
            background-color: #f0f0f0;
            color: #333;
            border: 1px solid #ccc;
        }
        
        .register-btn {
            width: 100%;
            margin-top: 20px;
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

<div class="log">
        <div class="fh1">
            <h2>BEM VINDO !<br>
            <strong>CRIE SUA CONTA</strong></h2>
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

                    <div class="form-container">
                        <form class="forms" method="POST" action="php_functs/doLogin.php">
                            <input type="hidden" name="login_state" value="voluntario">
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="name">NOME:</label>
                                    <input type="text" id="name" placeholder="Seu nome:" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">E-MAIL:</label>
                                    <input type="email" id="email" placeholder="Seu e-mail:" required>
                                </div>
                            </div>
            
                            <!-- Linha do Telefone (voluntário) e Senha (ambos) -->
                            <div class="form-row">
                                <div class="form-group phone-field">
                                    <label for="phone">TELEFONE:</label>
                                    <input type="tel" id="phone" placeholder="(00)00000-0000" maxlength="15" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">SENHA:</label>
                                    <input type="password" id="password" placeholder="Sua senha:" required>
                                </div>
                            </div>
            
                            <div class="bio-container">
                                <p id="bio-label">CONTE UM POUCO SOBRE VOCÊ E SUAS EXPERIÊNCIAS.</p>
                                <textarea required></textarea>
                            </div>
                    </div>
        
                            <div class="terms">
                                <input type="checkbox" id="terms" required>
                                <label for="terms">Aceito que dados como Nome, Telefone, Email e minhas experiências estarão visíveis para as Ongs as quais eu me voluntariar</label>
                            </div>
                            
                            <div class="divider"></div>
                            
                            <button class="btn btn-primary register-btn">CADASTRAR-SE</button>
                        </form>

                </div>

                <div class="content" id="services">
                    <div class="form-container">
                        <form class="forms" method="POST" action="php_functs/doLogin.php">
                            <input type="hidden" name="login_state" value="ong"> 

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="name">NOME:</label>
                                    <input type="text" id="name" placeholder="nome da ONG:" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">E-MAIL:</label>
                                    <input type="email" id="email" placeholder="Seu e-mail:" required>
                                </div>
                            </div>
    
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="password">SENHA:</label>
                                    <input type="password" id="password" placeholder="Sua senha:" required>
                                </div>
                            </div>
    
                            <div class="bio-container">
                                <p id="bio-label">INFORME SOBRE SUA INSTITUIÇÃO/ONG...</p>
                                <textarea required></textarea>
                            </div>
                    </div>
    
                    <div class="terms">
                        <input type="checkbox" id="terms" required>
                        <label for="terms">Aceito que dados como Nome, Email e as informações sobre a ONG seram visíveis à todos os voluntários do site</label>
                    </div>

                    <div class="divider"></div>
                    
                    <button class="btn btn-primary register-btn">CADASTRAR-SE</button>
                        </form>

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

    const botao_guia = localStorage.getItem('Botao_guia');

    console.log(botao_guia);

    if(botao_guia !== null){

        if(botao_guia == 'ong'){
            // pega os botões
            const tabs = document.querySelectorAll('.tab-btn');

            // remover a classe do todos os botões
            tabs.forEach(tab => tab.classList.remove('active'));

            // pegar atributo desses elementos
            const dataInfoValue = Array.from(tabs).map(tab => tab.getAttribute("content-id"));

            // pegar o botão da ong
            const indice = dataInfoValue.findIndex(item => item === 'services');
            const tab = tabs[indice];
            tab.classList.add('active');

            const contents = document.querySelectorAll('.content');

            //desativação dos paineis visíveis
            contents.forEach(content => content.classList.remove('show'));

            // pegar atributo do botão clicado
            const contentId = tab.getAttribute('content-id');

            // pegar painel com o mesmo ID do atributo do botão
            const content = document.getElementById(contentId);

            content.classList.add('show');
        }
    }
    </script>
</body>
</html>