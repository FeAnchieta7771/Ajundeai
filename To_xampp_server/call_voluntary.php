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

// print_r($_GET);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <link href="https://cdn.boxicons.com/fonts/basic/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/notification.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css\css_screens\analysis_voluntary_ong.css">
    <title>AjundeAi • Voluntário</title>
    <link rel="icon" href="img\Logo_Aba.png">

    <style>

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


    <div class="log">
        <div class="logo">
            <a href="index.php">

            </a>
        </div>

                <?php
        include 'php_functs/php_methods/get_voluntary_values.php';
        disfuncaoeretil($_GET['id_voluntario']);
        ?>

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
                        <div class="form-group">
                            <label for="name">NOME:</label>
                            <input type="text" id="name" name="nome" placeholder="Nome do voluntariado:" required>
                        </div>
                        <br>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="name">E-MAIL:</label>
                                <input type="text" id="name" name="email" placeholder="E-mail do voluntariado:"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="name">CPF:</label>
                                <input type="text" id="cpf" name="cpf" placeholder="Cpf do voluntariado:" required>
                            </div>
                        </div>

                        Linha do Telefone (voluntário) e Senha (ambos)
                        <div class="form-row">
                            <div class="form-group">
                                <label for="password">TELEFONE:</label>
                                <input type="localiza" id="localiza" name="localiza" placeholder="Seu telefone:"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="email">WHATSAPP:</label>
                                <input type="email" id="categoria" name="email" placeholder="Seu Whatsapp:" required>
                            </div>
                        </div>

                        Linha de categoria e periodo (ambos)
                        <div class="form-row">
                            <div class="form-group">
                                <label for="password">CATEGORIA DE PREFERENCIA:</label>
                                <input type="localiza" id="localiza" name="localiza" placeholder="Sua categoria:"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="email">PERIODO:</label>
                                <input type="email" id="categoria" name="email" placeholder="Seu periodo:" required>
                            </div>
                        </div>

                        Linha de situação atual e deficiencia (ambos)
                        <div class="form-row">
                            <div class="form-group">
                                <label for="password">SITUAÇÃO ATUAL:</label>
                                <input type="localiza" id="localiza" name="localiza" placeholder="Sua situação:"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="email">DEFICIENCIA:</label>
                                <input type="email" id="categoria" name="email" placeholder="Deficiencia (se houver):"
                                    required>
                            </div>
                        </div>
                        <br>
                        <div class="bio-container">
                            <p id="bio-label">CONTE UM POUCO SOBRE VOCE E SUAS EXPERIENCIAS:</p>
                            <textarea maxlength="1000" rows="9" cols="120" name="about" required
                                placeholder="Descreva suas habilidades, competências, qualificações, experiências, etc."></textarea>
                        </div>
                </div> -->
                <br>
                <form method="POST" action="php_functs\php_screens\profile_act.php">
                <input type='hidden' name='name_slot' value="<?php echo $_GET['name_slot']; ?>">
                <button class="btcall" id="btcan_vol" type="submit">CHAMAR VOLUNTARIO</button>
                </form>
                <br>

                <div class="button-cancel">
                    <a href="<?php echo $_SESSION['looking_voluntary']; ?>" class="btvol">VOLTAR AO FILTRO</a>
                </div>



            </div>



        </div>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.2/dist/confetti.browser.min.js" defer></script>
    <script src='js/notification.js' defer></script>
    <script>

        // pego todos os botões
        const tabs = document.querySelectorAll('.tab-btn');

        // atribuição da função á todos eles
        tabs.forEach(tab => tab.addEventListener('click', () => tabClicked(tab)))

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

        if (botao_guia !== null) {

            if (botao_guia == 'ong') {
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