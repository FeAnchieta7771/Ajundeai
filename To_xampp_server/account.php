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
    <link rel="icon" href="img\Logo_Aba.png">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #004d61;
            /* background-image: url("https://assets.onecompiler.app/43h62qpv7/3y5x8jr6s/login.png"); */
            background-image: url("img/Background_account.png");
            background-size: cover;
            background-repeat: no-repeat;
            
        }

        body::-webkit-scrollbar {
            display: none; /* Para navegadores baseados em WebKit (Chrome, Safari) */
        }

        header{
            margin-bottom: 40px;
        }

        .log {
            width: 100%;
            display: flex;
            position: absolute;
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
            font-family: "Horizon", sans-serif;
            font-style: italic;
        }

        .fh1 span {
            font-family: "Horizon", sans-serif;
            font-style: italic;
            font-size: 50px;
            display: block;
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
        
        textarea {
            resize: none;
            font-size: 16px;
            padding: 12px;
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
            justify-content: center;
            margin: 20px 0px;
            padding: 0px 200px;
        }
        
        .terms label {
            font-size: 14px;
            cursor: pointer;
            margin-left: 8px;
            text-align: justify;
        }

        .terms input[type="checkbox"] {
            accent-color: #e76f00;
            width: 20px;
            height: 20px;
            cursor: pointer;
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
            color: #004652;
            text-align: left;
            border-radius: 0px 0px 8px 8px;
            flex-direction: column;
            align-items: center;
            width: 100%;
        }


        .content {
            display: none
        }

        .content.show{
            display: block;
            gap: 14px;
        }

        #container{
            padding: 20px;
            box-shadow: 0px 10px 15px -3px rgba(0, 0, 0, 0.1);
            transition: .15s
        }

        .btlog {
            background-color: #f26b1d;
            font-family: "Horizon", sans-serif;
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

        .btlog_desativado {
            background-color: #f26b1d;
            font-family: "Horizon", sans-serif;
            border: none;
            padding: 12px;
            border-radius: 6px;
            color: white;
            font-weight: bold;
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

        .btlog_desativado:hover {
        }

        .tab-buttons{
            display: flex;
            gap: 6px;
            width: 100%;
            justify-items: center;
            justify-content: center;
        }

        .tab-btn {
            display: flex;
            align-items: center;
            justify-content: center;
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
            display: flex;
            align-items: center;
            justify-content: center
        }

        .tab-btn:hover{
            background-color:rgba(255, 255, 255, 0.59)
        } 

        .color_name{
            display: flex;
            align-items: center;
            font-size: 60px;
            font-weight: bold;
            font-family: "Horizon", sans-serif;
            font-style: italic;
        }

        .color_name_AJUNDE{
            color: #40d9cd;
            margin-left: 8px;
            font-size: 60px;
            font-weight: bold;
            font-family: "Horizon", sans-serif;
            font-style: italic;
        }

        .color_name_AI{
            color: #e76f00;
            font-size: 60px;
            font-weight: bold;
            font-family: "Horizon", sans-serif;
            font-style: italic;
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
           <div class="color_name"> BEM VINDO AO <div class="color_name_AJUNDE"> AJUNDE</div><div class="color_name_AI">AI</div>!</div><span>crie sua conta.</span>
        </div>
        
        <div id="container">
          <div class="tab-buttons">
            <button class="tab-btn active" content-id="home">
              <i class='bx bxs-user-circle' style="margin-right: 5px;"></i> Conta de Voluntário
            </button>

            <button class="tab-btn" content-id="services">
              <i class='bx bxs-buildings' style="margin-right: 5px;"></i> Conta de ONG
            </button>

          </div>

            <div class="tab-contents">

                <div class="content show" id="home">

                    <div class="form-container">
                        <form class="forms" method="POST" action="php_functs/doAccount.php">
                            <input type="hidden" name="account_state" value="voluntario">
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="name">NOME:</label>
                                    <input type="text" id="name" name="nome" placeholder="Seu nome:" required>
                                </div>
                            </div>
            
                            <!-- Linha do Telefone (voluntário) e Senha (ambos) -->
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="email">E-MAIL:</label>
                                    <input type="email" id="email" name="email" placeholder="Seu e-mail:" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">SENHA:</label>
                                    <input type="password" id="password" name="password" placeholder="Sua senha:" required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group phone-field">
                                    <label for="phone">TELEFONE:</label>
                                    <input type="tel" id="phone" name="telephone" placeholder="(00)00000-0000" maxlength="15" required>
                                </div>
                                <div class="form-group phone-field">
                                    <label for="phone">WHATSAPP (opcional):</label>
                                    <input type="tel" id="phone" name="whats" placeholder="(00)00000-0000" maxlength="15">
                                </div>
                            </div>
            
                            <div class="bio-container">
                                <p id="bio-label">CONTE UM POUCO SOBRE VOCÊ E SUAS EXPERIÊNCIAS.</p>
                                <textarea maxlength="1000" rows="10" cols="120" name="about" required placeholder="Descreva suas habilidades, competências, qualificações, experiências, etc."></textarea>
                            </div>
                    </div>
        
                            <div class="terms">
                                <input type="checkbox" class="check_vol" id="terms" required>
                                <label for="terms">Aceito que dados como <strong>Nome, Telefone, Email, Whatsapp e minhas experiências</strong> <br>estarão visíveis para as Ongs as quais eu me voluntariar</label>
                            </div>
                            
                            <div class="divider"></div>
                            
                            <button class="btlog" id="btlog_vol" type="submit">CADASTRAR-SE</button>
                        </form>

                </div>

                <div class="content" id="services">
                    <div class="form-container">
                        <form class="forms" method="POST" action="php_functs/doAccount.php">
                            <input type="hidden" name="account_state" value="ong"> 

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="name">NOME DA ONG:</label>
                                    <input type="text" id="name" name="nome" placeholder="nome da ONG:" required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="email">E-MAIL ASSOCIADO:</label>
                                    <input type="email" id="email" name="email" placeholder="Seu e-mail:" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">SENHA DE ACESSO:</label>
                                    <input type="password" id="password" name="password" placeholder="Sua senha:" required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="email">TELEFONE ASSOCIADO:</label>
                                    <input type="tel" id="email" name="telephone" placeholder="(00)00000-0000" required maxlength="15">
                                </div>
                                <div class="form-group">
                                    <label for="password">WHATSAPP (opcional):</label>
                                    <input type="password" id="password" name="whats" placeholder="(00)00000-0000" maxlength="15">
                                </div>
                            </div>
    
                            <div class="bio-container">
                                <p id="bio-label">INFORME SOBRE SUA INSTITUIÇÃO/ONG...</p>
                                <textarea maxlength="1000" rows="10" cols="120" name="about" required placeholder="Insira uma descrição sobre o que sua ONG oferece de serviços, suas demandas gerais, etc."></textarea>
                            </div>
                    </div>
    
                    <div class="terms">
                        <input type="checkbox" class="check_ong" id="terms" required>
                        <label for="terms">Aceito que dados como <strong>Nome, Email e as informações sobre a ONG</strong> <br> seram visíveis à todos os voluntários do site</label>
                    </div>

                    <div class="divider"></div>
                    
                    <button class="btlog" id="btlog_ong" type="submit">CADASTRAR ONG</button>
                    <div id="error" style="color: red;"></div>
                        </form>

                </div>

            </div>
        </div>
</div>
    
    <script>

        const uphover = (element) => {
            element.classList.remove('btlog_desativado');
            element.classList.add('btlog');
        }

        const downhover = (element) => {
            element.classList.remove('btlog');
            element.classList.add('btlog_desativado');
        }

        const bt_ative = (element) => {
                uphover(element);
                element.disabled = false;
                element.style.opacity = 1;
        }

        const bt_desative = (element) => {
                downhover(element);
                element.disabled = true;
                element.style.opacity = opacity;
        }

        var checkbox_terms_vol = document.getElementsByClassName('check_vol')[0];
        var checkbox_terms_ong = document.getElementsByClassName('check_ong')[0];
        const btlog_vol = document.getElementById('btlog_vol');
        const btlog_ong = document.getElementById('btlog_ong');
        const error = document.getElementById('error');

        const opacity = 0.5;

        bt_desative(btlog_vol);
        bt_desative(btlog_ong);

        checkbox_terms_vol.addEventListener('change', function() {
            if(checkbox_terms_vol.checked){
                bt_ative(btlog_vol);

            } else{
                bt_desative(btlog_vol);
            }
        });

        checkbox_terms_ong.addEventListener('change', function() {
            if(checkbox_terms_ong.checked){
                bt_ative(btlog_ong);

            } else{
                bt_desative(btlog_ong);
            }
        });


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