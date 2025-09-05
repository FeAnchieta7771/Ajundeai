<?php
session_start();

include 'php_functs/php_methods/functions.php';

// busca situação de login do usuário
$login_state = is_logged();

// busca quem está logado
$is_ong = is_ong_logged();

// setar botões do header
$buttons_header = set_model_buttons_header($login_state, $is_ong);
print_r($_SESSION);
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
    <link rel="stylesheet" href="css\css_screens\analysis_voluntary_ong.css">

    <style>
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
        <?php include 'php_functs/php_methods/buttons_analysis.php';
        get_buttons($_SESSION['name_slot']); ?>
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
</body>