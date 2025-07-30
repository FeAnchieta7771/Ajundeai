<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajundiai - Criação de Conta</title>
    <style>
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
    <div class="form-container">
        <div class="header">
            <img src="logo_ajundiai.png" alt="Ajundiai Logo" class="logo">
            <button class="logout-btn">Sair da Conta</button>
        </div>
        
        <h2>VOLUNTÁRIO [NOME]</h2>
        
        <form action="process_account.php" method="post">
            <div class="form-group">
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
            </div>
            
            <div class="button-group">
                <button type="submit" name="action" value="approve" class="btn approve-btn">Aprovar</button>
                <button type="submit" name="action" value="disapprove" class="btn disapprove-btn">Desaprovar</button>
            </div>
<!-- 
            <div class="status-container">
                <img src="status_logo.png" alt="Status Logo" class="status-logo">
                <span class="status-text">Aprovado</span>
            </div>
            
            <div class="status-container">
                <img src="status_logo.png" alt="Status Logo" class="status-logo">
                <span class="status-text">Desaprovado</span>
            </div> -->
        </form>
        
        <button class="btn back-btn">Voltar à Vaga</button>
    </div>
</body>
</html>