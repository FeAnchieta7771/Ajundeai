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
    <link href="https://cdn.boxicons.com/fonts/basic/boxicons.min.css" rel="stylesheet" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/header.css">
    <title>AjundeAi • Criação de contas</title>
    <link rel="icon" href="img\Logo_Aba.png">
        <link rel="stylesheet" href="css/notification.css">
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
            display: none;
            /* Para navegadores baseados em WebKit (Chrome, Safari) */
        }

        header {
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
            display: block;
            align-items: center;
            font-size: 60px;
            font-weight: bold;
            margin-bottom: 20px;
            font-family: "Horizon", sans-serif;
            font-style: italic;
        }

        .fh1 span {
            font-family: "Horizon", sans-serif;
            font-style: italic;
            font-size: 30px;
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
            flex: 0.7;
        }

        .form-group-localizacao {
            flex: 0.4;
        }

        .form-group-cota {
            flex: 0.3
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group-localizacao label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group-cota label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }

        .form-group-cota input,
        .form-group-cota textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }

        .form-group-localizacao input,
        .form-group-localizacao textarea {
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

        .content.show {
            display: block;
            gap: 14px;
        }

        #container {
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
            font-size: 30px;
            width: 100%;
            transition: .15s;
        }

        .btcan {
            background-color: rgb(81, 227, 238);
            font-family: "Horizon", sans-serif;
            border: none;
            padding: 12px;
            border-radius: 6px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            margin-top: 10px;
            font-size: 20px;
            width: 100%;
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

        .btcan:hover {
            transform: scale(1.02);
            background-color: white;
            color: rgb(81, 227, 238);
        }

        .btlog_desativado:hover {}

        .tab-buttons {
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

        .tab-btn.active {
            background-color: rgba(255, 255, 255, 0.8);
            color: #004652;
            font-size: 20px;
            display: flex;
            align-items: center;
            justify-content: center
        }

        .tab-btn:hover {
            background-color: rgba(255, 255, 255, 0.59)
        }

        .color_name {
            display: flex;
            align-items: center;
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
            <div class="color_name">CRIA SUA VAGA</div><span>PREENCHA OS DADOS</span>
        </div>

        <div id="container">


        </div>

        <div class="tab-contents">

            <div class="content show" id="home">

                <div class="form-container">
                    <form class="forms" method="POST" action="php_functs\php_screens\create_slotONG.php">
                        <input type="hidden" name="account_state" value="voluntario">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="name">NOME DA VAGA:</label>
                                <input type="text" id="name" name="nome_vaga" maxlength="200" placeholder="Nome de sua vaga:"
                                    required>
                            </div>
                        </div>

                        <!-- Linha do Telefone (voluntário) e Senha (ambos) -->
                        <div class="form-row-3 space">
                            <div class="form-group-localizacao">
                                <!-- <i class='bx  bxs-user'  ></i>  -->
                                <label for="password">CATEGORIA:</label>
                                <input id="cota" name="categoria_vaga" list="cat"
                                    placeholder="Insira a categoria" required>

                                <datalist id="cat">
                                    <option value="Saúde"></option>
                                    <option value="Eventos"></option>
                                    <option value="Animais"></option>
                                    <option value="Crianças"></option>
                                    <option value="Educação"></option>
                                    <option value="Tecnologia"></option>
                                    <option value="Assist. Social"></option>
                                    <option value="Administração"></option>
                                    <option value="Meio Ambiente"></option>
                                </datalist>
                            </div>

                            <div class="form-group">
                                <label for="password">LOCALIZAÇÃO:</label>
                                <input type="localiza" id="localiza" name="localizacao" placeholder="Sua localização:"
                                    required>
                            </div>
                            <!-- <i class='bx  bxs-user'  ></i>  -->
                            <div class="form-group-cota">
                                <!-- <i class='bx  bxs-user'  ></i>  -->
                                <label for="password">COTA DE VOLUNTARIOS:</label>
                                <input type="number" id="cota" name="quant_limite" min="0" max="500" step="10"
                                    placeholder="Seu núm. de cota:" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                            </div>

                            <div class="bio-container">
                                <p id="bio-label">APRESENTE SUA VAGA BREVEMENTE AOS VOLUNTARIOS.</p>
                                <textarea maxlength="1000" rows="2" cols="120" name="descr_obj" required
                                    placeholder="Descreva sua vaga aos teus voluntariados."></textarea>
                            </div>
                        </div>

                        <div class="bio-container">
                            <p id="bio-label">INTRODUZA TODA A DESCRIÇÃO DA VAGA.</p>
                            <textarea maxlength="1000" rows="9" cols="120" name="descr_total" required
                                placeholder="Descreva suas habilidades, competências, qualificações, experiências, etc."></textarea>
                        </div>
                </div>
                        <br>
                        <button class="btlog" id="btlog_vol" type="submit">CRIAR A VAGA</button>
                    </form>
                <br>
                <form method="GET" action="php_functs\php_methods\cancelar.php">
                    <button class="btcan" id="btcan_vol" type="cancel">CANCELAR</button>

                </form>

            </div>



        </div>
    </div>
    </div>

      <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.2/dist/confetti.browser.min.js" defer></script>
  <script src='js/notification.js' defer></script>
</body>

</html>