<?php
session_start();

include 'php_functs/php_methods/functions.php';
// busca situação de login do usuário
$login_state = is_logged();

if(!$login_state){
  header('Location: index.php');
  exit();
}

// print_r($_SESSION);
// busca quem está logado
$is_ong = is_ong_logged();

// setar botões do header
$buttons_header = set_model_buttons_header($login_state, $is_ong);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/notification.css">
    <link
      href="https://cdn.boxicons.com/fonts/basic/boxicons.min.css"
      rel="stylesheet"
    />

    <link rel="stylesheet" href="css/notification.css">

    <title>AjundeAi • Ánalise de Voluntário</title>
    <style>

        body::-webkit-scrollbar {
    display: none; /* Para navegadores baseados em WebKit (Chrome, Safari) */
}

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .logo {
            height: 50px;
        }
        .logout-btn {
            background-color: #ff4444;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
        }
        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            max-width: 600px;
            margin: 0 auto;
        }
        h2 {
            color: #333;
            margin-top: 0;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-row {
            display: flex;
            gap: 15px;
        }
        .form-row .form-group {
            flex: 1;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="tel"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        textarea {
            height: 100px;
            resize: vertical;
        }
        .button-group {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }
        .btn {
            padding: 12px 0;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            flex: 1;
            text-align: center;
        }
        .approve-btn {
            background-color: #4CAF50;
            color: white;
        }
        .disapprove-btn {
            background-color: #f44336;
            color: white;
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
        
        <!-- <h2>VOLUNTÁRIO [NOME]</h2> -->
        <!-- procura no banco informações do voluntario 
         e exibir mostrar situação, aprovado ou desaprovado . -->
         
         <?php
         include 'php_functs/php_methods/get_voluntary_values.php';
         disfuncaoeretil();
         ?>
        
            <!-- <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" readonly>
            </div>
            <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" readonly>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="telefone">Telefone:</label>
                    <input type="tel" id="telefone" name="telefone" readonly>
                </div>
                <div class="form-group">
                    <label for="whatsapp">Whatsapp:</label>
                    <input type="whatsapp" id="whatsapp" name="whatsapp" readonly>
                </div>
            </div>
            
            <div class="form-group">
                <label for="curriculo">Currículo:</label>
                <textarea id="curriculo" name="curriculo" readonly></textarea>
            </div> -->





            <?php include 'php_functs/php_methods/buttons_analysis.php'; get_buttons(); ?>
            <!-- <div class="button-group">
                <form action="" method="POST">
                    <button type="submit" name="action" class="btn approve-btn">Aprovar</button>
                </form>

                <form action="" method="POST"></form>
                    <button type="submit" name="action" class="btn disapprove-btn">Desaprovar</button>
                </form>
            </div> -->
<!-- 
            <div class="status-container">
                <img src="status_logo.png" alt="Status Logo" class="status-logo">
                <span class="status-text">Aprovado</span>
            </div>
            
            <div class="status-container">
                <img src="status_logo.png" alt="Status Logo" class="status-logo">
                <span class="status-text">Desaprovado</span>
            </div> -->
        
        <a href="<?php echo $_SESSION['tela_anterior']; ?>" class="btn back-btn">Voltar à Vaga</a>
    </div>

    <script src='js/notification.js' defer></script>
</body>
</html>