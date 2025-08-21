<?php
session_start();
include 'php_functs/php_methods/functions.php';

function save_value($name, $for){
    if(isset($_SESSION[$name], $_SESSION['account_state']) && $_SESSION['account_state'] == $for){
        return htmlspecialchars($_SESSION[$name]);
    }

    return '';
}

function save_value_select($name, $option){
    if(isset($_SESSION[$name], $_SESSION['account_state']) && $_SESSION[$name] == $option){
        echo 'selected';
    }
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
                                <div class="form-group">
                                    <label for="password">SENHA:</label>
                                    <input type="password" id="password" name="password" placeholder="Sua senha:" maxlength="20" required value='<?php echo save_value('password','voluntario'); ?>'>
                                </div>
                            </div>
            
                            <!-- Linha do Telefone (voluntário) e Senha (ambos) -->
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="email">E-MAIL:</label>
                                    <input type="email" id="email" name="email" placeholder="Seu e-mail:" maxlength="150" required value='<?php echo save_value('email','voluntario'); ?>'>
                                </div>
                                <div class="form-group">
                                    <label for="cpf">CPF:</label>
                                    <input type="text" id="cpf" name="cpf" placeholder="#########-##" maxlength="12" required value='<?php echo save_value('cpf','voluntario'); ?>'>
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

                            <div class="form-row">
                                <div class="form-group phone-field">
                                    <label for="cat_vol">Qual Opção de Vaga prefere?</label>
                                    <select class="select" id="cat_vol" name="cat_vol" required>
                                        <option value="" selected disabled> selecione sua preferencia </option>
                                        <option value="saúde"         <?php save_value_select('cat_vol','saúde');         ?> >Saúde</option>
                                        <option value="eventos"       <?php save_value_select('cat_vol','eventos');       ?> >Eventos</option>
                                        <option value="animais"       <?php save_value_select('cat_vol','animais');       ?> >Animais</option>
                                        <option value="crianças"      <?php save_value_select('cat_vol','crianças');      ?> >Crianças</option>
                                        <option value="educação"      <?php save_value_select('cat_vol','educação');      ?> >Educação</option>
                                        <option value="tecnologia"    <?php save_value_select('cat_vol','tecnologia');    ?> >Tecnologia</option>
                                        <option value="assistencia"   <?php save_value_select('cat_vol','assistencia');   ?> >Assistencia</option>
                                        <option value="administração" <?php save_value_select('cat_vol','administração'); ?> >Administração</option>
                                        <option value="meio ambiente" <?php save_value_select('cat_vol','meio ambiente'); ?> >Meio Ambiente</option>
                                        <option value="outros"                                                                             >Outras Diversificações...</option>
                                    </select>
                                </div>
                                <div class="form-group phone-field">
                                    <label for="periodo">Periodo de Participação:</label>
                                    <select class="select" id="periodo" name="periodo" required>
                                        <option value="" selected disabled> selecione seu periodo </option>
                                        <option value="manhã"       <?php save_value_select('periodo','manhã');       ?> >Manhã</option>
                                        <option value="tarde"       <?php save_value_select('periodo','tarde');       ?> >Tarde</option>
                                        <option value="noite"       <?php save_value_select('periodo','noite');       ?> >Noite</option>
                                        <option value="madrugada"   <?php save_value_select('periodo','madrugada');   ?> >Madrugada</option>
                                        <option value="integral"    <?php save_value_select('periodo','integral');    ?> >Integral</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group phone-field">
                                    <label for="estado">Qual é a sua Situação Atual?</label>
                                    <select class="select" id="estado" name="estado" required>
                                        <option value="" selected disabled> selecione sua situação </option>
                                        <option value="Estudante Fundamental"   <?php save_value_select('estado','Estudante Fundamental');   ?> >Estudante Fundamental</option>
                                        <option value="Estudante Médio"         <?php save_value_select('estado','Estudante Médio');         ?> >Estudante Médio</option>
                                        <option value="Formado"                 <?php save_value_select('estado','Formado');                 ?> >Formado</option>
                                        <option value="Estudante Universitário" <?php save_value_select('estado','Estudante Universitário'); ?> >Estudante Universitário</option>
                                        <option value="Empregado"               <?php save_value_select('estado','Empregado');               ?> >Empregado</option>
                                        <option value="Aposentado"              <?php save_value_select('estado','Aposentado');              ?> >Aposentado</option>
                                    </select>
                                </div>
                                <div class="form-group phone-field">
                                    <label for="pcd">Você possui alguma Deficiência?</label>
                                    <input type="tel" id="pcd" name="pcd" list="pcd_options" value='<?php echo save_value('pcd','voluntario'); ?>'>

                                    <datalist id="pcd_options">
                                        <option value="Não"></option>
                                        <option value="Prefiro não dizer..."></option>
                                    </datalist>
                                </div>
                            </div>
            
                            <div class="bio-container">
                                <p id="bio-label">CONTE UM POUCO SOBRE VOCÊ E SUAS EXPERIÊNCIAS.</p>
                                <textarea maxlength="1000" rows="5" cols="120" name="about" placeholder="Descreva suas habilidades, competências, experiências, etc." required value='<?php echo save_value('about','voluntario'); ?>'
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
  <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.2/dist/confetti.browser.min.js" defer></script>
  <script src='js/notification.js' defer></script>
<script src="js/whatsapp.js"></script>
<script src="js/phone.js"></script>
<script src="js/cpf.js"></script>
<script src="js/terms_accept.js"></script>
<script src="js/direct_forms.js"></script>
</body>
</html>