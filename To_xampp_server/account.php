<?php
session_start();
include 'php_functs/php_methods/functions.php';

function save_value($name, $for){
    if(isset($_SESSION[$name], $_SESSION['account_state']) && $_SESSION['account_state'] == $for){
        return htmlspecialchars($_SESSION[$name]);
    }

    return '';
}

// busca situação de login do usuário
$login_state = is_logged();

// busca quem está logado
$is_ong = is_ong_logged();

// setar botões do header
$buttons_header = set_model_buttons_header($login_state, $is_ong);

// echo "<pre>"; // Para melhor formatação
// print_r($_SESSION);
// echo "</pre>";
// busca por erros anteriores
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
    <link rel="stylesheet" href="css/css_screens/account.css">
    <link rel="stylesheet" href="css/notification.css">
    <title>AjundeAi • Criar Conta</title>
    <link rel="icon" href="img\Logo_Aba.png">
    <style>

        body::-webkit-scrollbar {
            display: none; /* Para navegadores baseados em WebKit (Chrome, Safari) */
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
                        <form class="forms" method="POST" action="php_functs/php_screens/doAccount.php">
                            <input type="hidden" name="account_state" value="voluntario">
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="name">NOME:</label>
                                    <input type="text" id="name" name="nome" placeholder="Seu nome:" maxlength="100" required value='<?php echo save_value('nome','voluntario');?>'>
                                </div>
                            </div>
            
                            <!-- Linha do Telefone (voluntário) e Senha (ambos) -->
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="email">E-MAIL:</label>
                                    <input type="email" id="email" name="email" placeholder="Seu e-mail:" maxlength="150" required value='<?php echo save_value('email','voluntario'); ?>'>
                                </div>
                                <div class="form-group">
                                    <label for="password">SENHA:</label>
                                    <input type="text" id="password" name="password" placeholder="Sua senha:" maxlength="20" required value='<?php echo save_value('password','voluntario'); ?>'>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group phone-field">
                                    <label for="phone">TELEFONE:</label>
                                    <input type="tel" id="phone" name="telephone" placeholder="(##) ####-####" maxlength="20" required value='<?php echo save_value('telephone','voluntario'); ?>'>
                                </div>
                                <div class="form-group phone-field">
                                    <label for="whats">WHATSAPP (opcional):</label>
                                    <input type="tel" id="whats" name="whats" placeholder="+55 (##) #####-####" maxlength="20" value='<?php echo save_value('whats','voluntario'); ?>'>
                                </div>
                            </div>
            
                            <div class="bio-container">
                                <p id="bio-label">CONTE UM POUCO SOBRE VOCÊ E SUAS EXPERIÊNCIAS.</p>
                                <textarea maxlength="1000" rows="10" cols="120" name="about" placeholder="Descreva suas habilidades, competências, qualificações, experiências, etc." required value='<?php echo save_value('about','voluntario'); ?>'
                                ><?php echo save_value('about','voluntario'); ?></textarea>
                            </div>
                    </div>
        
                            <div class="terms">
                                <input type="checkbox" class="check_vol" id="terms" required>
                                <label for="terms">Aceito que dados como <strong>Nome, Telefone, Email, Whatsapp e minhas experiências</strong> <br>estarão visíveis para as Ongs as quais eu me voluntariar</label>
                            </div>
                            
                            <div class="divider"></div>
                            
                            <button class="btlog" id="btlog_vol" name="btlog" type="submit">CADASTRAR-SE</button>
                        </form>

                </div>

                <div class="content" id="services">
                    <div class="form-container">
                        <form class="forms" method="POST" action="php_functs/php_screens/doAccount.php">
                            <input type="hidden" name="account_state" value="ong"> 

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="name">NOME DA ONG:</label>
                                    <input type="text" id="name" name="nome" placeholder="nome da ONG:" maxlength="100" required value='<?php echo save_value('nome','ong');?>'>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="email">E-MAIL ASSOCIADO:</label>
                                    <input type="email" id="email" name="email" placeholder="Seu e-mail:" maxlength="150" required value='<?php echo save_value('email','ong');?>'>
                                </div>
                                <div class="form-group">
                                    <label for="password">SENHA DE ACESSO:</label>
                                    <input type="password" id="password" name="password" placeholder="Sua senha:" maxlength="20" required value='<?php echo save_value('password','ong');?>'>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="phone">TELEFONE ASSOCIADO:</label>
                                    <input type="tel" id="phone" name="telephone" placeholder="(##) ####-####" required maxlength="20" value='<?php echo save_value('telephone','ong');?>'>
                                </div>
                                <div class="form-group">
                                    <label for="whats">WHATSAPP (opcional):</label>
                                    <input type="tel" id="whats" name="whats" placeholder="+55 (##) #####-####" maxlength="20" value='<?php echo save_value('whats','ong');?>'>
                                </div>
                            </div>
    
                            <div class="bio-container">
                                <p id="bio-label">INFORME SOBRE SUA INSTITUIÇÃO/ONG...</p>
                                <textarea maxlength="1000" id="ong_textarea" rows="10" cols="120" name="about" required placeholder="Insira uma descrição sobre o que sua ONG oferece de serviços, suas demandas gerais, etc." value='<?php echo save_value('about','ong');?>'
                                ><?php echo save_value('about','ong'); ?></textarea>
                            </div>
                    </div>
    
                    <div class="terms">
                        <input type="checkbox" class="check_ong" id="terms" required>
                        <label for="terms">Aceito que dados como <strong>Nome, Email e as informações sobre a ONG</strong> <br> seram visíveis à todos os voluntários do site</label>
                    </div>

                    <div class="divider"></div>
                    
                    <button class="btlog" id="btlog_ong" name="btlog" type="submit">CADASTRAR ONG</button>
                    <div id="error" style="color: red;"></div>
                        </form>

                </div>

            </div>
        </div>
</div>
<script src='js/notification.js' defer></script>
<script src="js/whatsapp.js"></script>
<script src="js/phone.js"></script>
<script src="js/terms_accept.js"></script>
<script src="js/direct_forms.js"></script>
</body>
</html>