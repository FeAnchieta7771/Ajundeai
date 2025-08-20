<!-- Tela de aprestação das vagas salvas pelo usuário -->
 <!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
  <link rel="icon" href="img\Logo_Aba.png">
  <title>AjundeAi</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/header.css">
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
      height: 60px;
      width: 170px;
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
      text-decoration: none
    }

    .btn.register {
      background-color: #00c4b4;
      color: white;
      text-decoration: none
    }

    .painel-bar {
      display: flex;
      align-items: center;
      gap: 10px;
      flex: 1;
      max-width: 400px;
    }

    .buttons {
      display: flex;
      gap: 10px;
      background-color: #004d61;
      color: white;
      text-decoration: underline;
      font-weight: bold;
      font-size: 0.9rem;
      cursor: pointer;
      border: none;
      padding: 20px;
    }

    .btn-entrar {
      background-color: white;
      color: #e76f00;
      border: 2px solid #e76f00;
    }

    .btn-cadastro {
      background-color: #00c4b4;
      color: white;
    }

    .container {
      display: flex;
      flex-wrap: wrap;
      padding: 25px 40px;
      gap: 40px;
    }

    .filtros {
      background-color: #196e78;
      color: white;
      padding: 20px;
      border-radius: 10px;
      width: 250px;
      flex-shrink: 0;
      height: fit-content;
    }

    .filtros h2 {
      margin-bottom: 20px;
      border-bottom: 2px solid white;
      padding-bottom: 10px;
      font-size: 1.3rem;
    }

    .filtros label {
      display: block;
      margin-bottom: 10px;
      cursor: pointer;
    }

    .filtros input[type="radio"] {
      margin-right: 8px;
    }

    .filtros .btn-buscar {
      width: 100%;
      margin-top: 15px;
    }

    .vagas {
      flex: 1;
      min-width: 280px;
    }

    .vagas h3 {
      color: #003f5c;
      margin-bottom: 20px;
      font-weight: bold;
    }

    .scroll-wrapper {
      overflow-y: auto;
      max-height: 70vh;
      padding-right: 10px;
    }

    .vaga-card {
      border: 2px solid #e66922;
      padding: 20px;
      margin-bottom: 20px;
      display: flex;
      gap: 20px;
      align-items: flex-start;
      background-color: #f9f9f9;
      height: 170px;
      align-items: center;     /* Alinha verticalmente no centro */
      width: 85%;
    }

    .vaga-card img {
      width: 120px;
      height: 120px;
    }

    .vaga-info h4 {
      color: #e76f00;
      font-size: 1.6rem;
      margin-bottom: 5px;
    }

    .vaga-info span {
      display: block;
      margin-bottom: 5px;
      color: #196e78;
      font-weight: bold;
    }

    .vaga-info p {
      font-size: 1.2rem;
      color: #444;
    }
   
    .engloba {
      display: flex;
      align-items: center;
    }
   
    .btn-azul {
      padding: 20px;
      font-size: 30px;
      margin-left: 75px;
      height: 74px;
      display: flex; /* Adicionado para que align-items funcione */
      align-items: center;
      background-color: #2289e6;
      color: white;
      border: 1px solid #2289e6;
      color: white;
    }
   
    .btn-azul:hover {
      background-color: white;
      color: #2289e6;
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
      <a href="login.php" class="btn login" >ENTRAR</a>
      <a href="account.php" class="btn register">CADASTRE-SE</a>
    </div>
  </header>
  <header style="background-color: #004d61; justify-content: center;">
    <div class="painel-bar">
        <h1 style="color:white; margin-left:30%;">PAINEL</h1>
        <button class="buttons" style="margin-left: 500px;">SALVOS</button>
        <button class="buttons">APLICADOS</button>
    </div>
  </header>
    <forms>
      <h1 style="color: #2289e6; margin-top: 40px; margin-left: 40px;">SUAS VAGAS SALVAS</h1>
      <main class="container">
      <aside class="filtros">
        <h2>FILTROS</h2>
        <label><input type="checkbox" name="filtro"> Saúde</label>
        <label><input type="checkbox" name="filtro"> Eventos</label>
        <label><input type="checkbox" name="filtro"> Animais</label>
        <label><input type="checkbox" name="filtro"> Crianças</label>
        <label><input type="checkbox" name="filtro"> Educação</label>
        <label><input type="checkbox" name="filtro"> Tecnologia</label>
        <label><input type="checkbox" name="filtro"> Assist. Social</label>
        <label><input type="checkbox" name="filtro"> Administração</label>
        <label><input type="checkbox" name="filtro"> Meio Ambiente</label>
        <button class="btn btn-buscar">BUSCAR</button>
      </aside>
    </forms>

    <section class="vagas">
      <div class="scroll-wrapper">
        <!-- Aqui os blocos podem ser gerados via PHP -->
        <forms>
          <div class="engloba">
            <div class="vaga-card">
              <img src="img\icons_orange\outro.png" alt="Ícone" />
              <div class="vaga-info">
                <h4>NOME DA VAGA</h4>
                <span>5/10 • Nome da ONG</span>
                <p>Descrição pequena que está dentro do banco que o Guilherme
                ainda tem que fazer e passar o arquivo pra mim.</p>
              </div>
            </div>
            <button class="btn-azul"><i class='bx bxs-bookmark'></i></button>
          </div>
        </forms>
       
        <!-- Repita o .vaga-card conforme necessário -->
      </div>
    </section>
  </main>
</body>
</html>