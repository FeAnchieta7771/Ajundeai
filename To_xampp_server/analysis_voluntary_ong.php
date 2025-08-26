<?php
session_start();

include 'php_functs/php_methods/functions.php';

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
        
        .form-row-3 {
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
            border: none;
            background-color: #ffffff30;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }
        
        textarea {
            resize: none;
            font-size: 16px;
            padding: 12px;
            border: none;
            background-color: #ffffff30;
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
   
        .btapro {
            background-color:rgb(13, 221, 65);
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

        .btvol {
            background-color:rgb(13, 138, 221);
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
            text-decoration: none;
        }

        .btcan {
            background-color:rgb(255, 0, 0);
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
            /* display: flex; */
            align-items: center;
            font-size: 60px;
            font-weight: bold;
            font-family: "Horizon", sans-serif;
            font-style: italic;
            justify-content: center;
        }

        .color_name strong{
            color: #00c4b4;
        }

        .approve-btn {
            background-color: #4CAF50;
            color: white;
        }
        .disapprove-btn {
            background-color: #f44336;
            color: white;
        }
                .button-group {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 20px;
        }
                .button-cancel {
            display: flex;
            gap: 10px;
            width: 100%;
            /* margin-top: 20px; */
        }
        .button-cancel a{
            width: 100%;
        }

        .butn {
            padding: 12px 0;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            flex: 1;
            text-align: center;
        }
        .back-btn {
            background-color: #2196F3;
            color: white;
            margin-top: 10px;
            width: 100%;
            padding: 12px 0;
        }
        .status-container {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-top: 20px;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }
        .status-logo {
            height: 40px;
        }
        .status-text {
            font-size: 16px;
            font-weight: bold;
            color: #333;
        }
    </style>
</head>
<body>

    <header>
        <div class="logo">
            <a href="index.php">
                <img src="img\Logo_Header.png" alt="Logo pfp" />
            </a>
        </div>
        <?php echo $buttons_header; ?>
    </header>


<div class="log">
<div class="logo">
            <a href="index.php">
                
            </a>
        </div>

                 <?php
         include 'php_functs/php_methods/get_voluntary_values.php';
         disfuncaoeretil();
         ?>
         <?php include 'php_functs/php_methods/buttons_analysis.php'; get_buttons(); ?>
        <!-- <div class="fh1">
           <div class="color_name">VOLUNTARIO[NOME]</div>
        </div>
        
        <div id="container">
          

          </div>

            <div class="tab-contents">

                <div class="content show" id="home">

                    <div class="form-container">
                        <form class="forms" method="POST" action="php_functs/doAccount.php">
                            <input type="hidden" name="account_state" value="voluntario">
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="name">NOME:</label>
                                    <input type="text" id="name" name="nome" placeholder="Nome do voluntariado:" required>
                                </div>
                            </div> -->
            
                            <!-- Linha do Telefone (voluntário) e Senha (ambos) -->
                            <!-- <div class="form-row-3">
                                <div class="form-group">
                                    <label for="password">TELEFONE:</label>
                                    <input type="localiza" id="localiza" name="localiza" placeholder="Seu telefone:" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">E-MAIL:</label>
                                    <input type="email" id="email" name="email" placeholder="Seu e-mail:" required>
                                </div>
                            </div>
            
                            <div class="bio-container">
                                <p id="bio-label">CURRICULO:</p>
                                <textarea maxlength="1000" rows="9" cols="120" name="about" required placeholder="Descreva suas habilidades, competências, qualificações, experiências, etc."></textarea>
                            </div>
                    </div>
                            <br>
                            <button class="btapro" id="btcan_vol" type="cancel">APROVAR</button>
                            <button class="btcan" id="btcan_vol" type="cancel">DESAPROVAR</button>
                            
                        </form>
                        <br> -->
                        <div class="button-cancel">
                            <a href="<?php echo $_SESSION['tela_anterior']; ?>" class="btvol">Voltar à Vaga</a>
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