<!-- Tela de Login -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="icon" href="img/Aj.png">
    <title>AjundeAi</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #ffffff;
        }

        header {
            background-color: #e76f00;
            padding: 15px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo img {
            height: 55px;
            width: 100px;
        }

        .header-buttons {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 10px 20px;
            font-weight: bold;
            border-radius: 8px;
            font-size: 0.9rem;
            cursor: pointer;
            border: none;
        }

        .btn.login {
            background-color: #ffffff;
            color: #00c4b4;
            border: 2px solid #00c4b4;
        }

        .btn.register {
            background-color: #00c4b4;
            color: white;
        }

        .log {
            background-image: url("https://assets.onecompiler.app/43h62qpv7/3y5x8jr6s/login.png");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            width: 100%;
            height: 100vh;
            display: flex;
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
        }

        .fh1 span {
            display: block;
        }

        .form-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
        }

        .role-selector {
            background-color: #53d3d1;
            border-radius: 4px;
            margin-bottom: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            font-weight: bold;
            color: #004652;
            width: 500px;
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
            width: 500px;
            color: #004652;
            text-align: left;
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

        .signup {
            margin: 10px 0;
            color: #53d3d1;
            font-size: 14px;
        }

        .signup a {
            color: #53d3d1;
            font-weight: bold;
            text-decoration: none;
        }

        .signup a:hover {
            text-decoration: underline;
        }

        .btlog {
            background-color: #f26b1d;
            border: none;
            padding: 12px;
            border-radius: 6px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            margin-top: 10px;
            font-size: 20px;
            width: 500px;
        }

        button:hover {
            background-color: #d85f1a;
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
        <div class="header-buttons">
            <button class="btn login">ENTRAR</button>
            <button class="btn register">CADASTRE-SE</button>
        </div>
    </header>

    <div class="log">
        <div class="fh1">
            BEM VINDO DE VOLTA!<br><span>FAÇA SEU LOGIN!</span>
        </div>

        <div class="form-wrapper">
            <form class="forms">
                <div class="role-selector">
                    <label><input type="radio" name="role" checked> VOLUNTÁRIO</label>
                    <span class="divider">|</span>
                    <label><input type="radio" name="role"> ONG RESPONSÁVEL</label>
                </div>

                <div class="form-container">
                    <label for="email">NOME OU EMAIL</label>
                    <input type="text" id="email" placeholder="Insira nome ou email aqui">
                    <br>
                    <br>
                    <label for="password">SENHA</label>
                    <input type="password" id="password" placeholder="Insira sua senha aqui">
                </div>

                <p class="signup">Não possui uma conta? <a href="#">CADASTRE-SE</a></p>
                <button class="btlog" type="submit">LOGIN</button>
            </form>
        </div>
    </div>

</body>
</html>
