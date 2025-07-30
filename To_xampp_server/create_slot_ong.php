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
    <!-- Dentro do header -->
        <div class="logo">
            <a href="index.php">
            <img src="img\Logo_Header.png" alt="Logo AjundeAi" />
            </a>
        </div>
        <?php echo $buttons_header; ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AjundeAi • Criar vaga</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            color: #333;
            position: relative;
            background-color: #f9f9f9;
            
        }

        body::-webkit-scrollbar {
            display: none; /* Para navegadores baseados em WebKit (Chrome, Safari) */
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
            padding-bottom: 15px;
            border-bottom: 1px solid #ddd;
        }
        
        .logo-title {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .logo-img {
            width: 50px;
            height: 50px;
        }
        
        .app-name {
            font-size: 24px;
            font-weight: bold;
            color: #2c3e50;
        }
        
        .logout-btn {
            padding: 8px 20px;
            background-color: #e74c3c;
            color: white;
            border: none;
            border-radius: 4px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
        }
        
        h1 {
            text-align: center;
            font-size: 22px;
            margin-bottom: 30px;
            color: #2c3e50;
        }
        
        .form-container {
            background-color: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .form-row {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .form-group {
            flex: 1;
        }
        
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
            color: #2c3e50;
        }
        
        .form-group input, .form-group textarea, .form-group select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }
        
        .form-group textarea {
            height: 150px;
            resize: vertical;
        }
        
        .description-group {
            margin-bottom: 25px;
        }
        
        .description-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
            color: #2c3e50;
        }
        
        .button-group {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            margin-top: 30px;
            flex-direction: row-reverse; 
        }
        
        .btn {
            padding: 12px 25px;
            border: none;
            border-radius: 4px;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        .btn-primary {
            background-color: #27ae60;
            color: white;
        }
        
        .btn-primary:hover {
            background-color: #2ecc71;
        }
        
        .btn-secondary {
            background-color: #bdc3c7;
            color: #2c3e50;
        }
        
        .btn-secondary:hover {
            background-color: #95a5a6;
        }
    </style>
</head>
<body>
    <!--Colocar a imagem do background -->
    <img src="background.png" alt="Background" class="background">
    
    <div class="header">
        <div class="logo-title">
            <!-- Colocar a imagem da logo principal aqui -->
            <img src="ajundeai-logo.png" alt="AJUNDEAI Logo" class="logo-img">
        </div>
        <a href="#" class="logout-btn">SAIR DA CONTA</a>
    </div>
    
    <div class="form-container">
        <form class="forms" method="POST" action="php_functs/create_slotONG.php">
        <h1>INSIRA OS DADOS<br>PARA CRIAR A VAGA</h1>
        
        <div class="form-row">
            <div class="form-group">
                <label for="job-name">NOME DA VAGA:</label>
                <input type="text" id="job-name" name="nome_vaga" placeholder="Digite o nome da vaga" required>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label for="category">CATEGORIA:</label>
                <input list="category" name="categoria_vaga" id="category" placeholder="Insira uma ou escolha">

                <datalist id="category">
                <option value="Maçã">
                <option value="Banana">
                <option value="Laranja">
                <option value="Morango">
                <option value="Uva">
                </datalist>
                <!-- <input type="text" id="category" placeholder="Categoria de tal vaga" required> -->
            </div>
            <div class="form-group">
                <label for="location">LOCALIZAÇÃO:</label>
                <input type="text" name="localizacao" id="location" placeholder="Localização da vaga" required>
            </div>
            <div class="form-group">
                <label for="volunteers-needed">COTA DE VOLUNTÁRIOS:</label>
                <input type="number" name="quant_limite" min="1" id="volunteers-needed" placeholder="Numero de voluntários" required>
            </div>
        </div>
        
        <div class="description-group">
            <label for="welcome-message">APRESENTE SUA VAGA BREVEMENTE AOS VOLUNTÁRIOS:</label>
            <textarea name="descr_obj" id="welcome-message"  placeholder="Diga uma palavra aos seus voluntariados" required></textarea>
        </div>
        
        <div class="description-group">
            <label for="job-description">INTRODUZA TODA A DESCRIÇÃO DA VAGA:</label>
            <textarea name="descr_total" id="job-description" placeholder="Descreva detalhadamente tua vaga" required></textarea>
        </div>
        
        <div class="button-group">
            <button class="btn btn-primary">CRIAR VAGA</button>
        
        </form>
        <form class="forms" method="GET" action="php_functs/cancelar.php">
            <button class="btn btn-secondary">CANCELAR</button>
        </form>

        </div>
    
    </div>
</body>
</html>