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
    <link rel="stylesheet" href="css\css_screens\create_slot_ong.css">
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
                                <input type="text" id="name" name="nome_vaga" maxlength="200"
                                    placeholder="Nome de sua vaga:" required>
                            </div>
                        </div>

                        <!-- Linha do Telefone (voluntário) e Senha (ambos) -->
                        <div class="form-row-3 space">
                            <div class="form-group-localizacao">
                                <!-- <i class='bx  bxs-user'  ></i>  -->
                                <label for="password">CATEGORIA:</label>
                                <input id="cota" name="categoria_vaga" list="cat" placeholder="Insira a categoria"
                                    required>

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