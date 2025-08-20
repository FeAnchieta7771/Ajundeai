<!-- Tela de Apresentação das vagas cadastradas pelo usuário -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
  <title>AjundeAi - Painel de Vagas</title>
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
      padding: 15px 30px;
      background-color: #004d61;
      color: white;
      justify-content: center;
    }

    .painel-bar h1 {
      margin-right: auto;
    }

    .buttons {
      margin-left: 20px;
      background-color: transparent;
      border: none;
      color: white;
      text-decoration: underline;
      font-weight: bold;
      font-size: 0.9rem;
      cursor: pointer;
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

    .filtros input[type="checkbox"] {
      margin-right: 8px;
    }

    .filtros .btn-buscar {
      width: 100%;
      margin-top: 15px;
      background-color: #00c4b4;
      color: white;
      padding: 10px;
      border: none;
      border-radius: 6px;
      font-weight: bold;
      cursor: pointer;
    }

    .vagas {
      flex: 1;
      min-width: 300px;
    }

    .vagas h3 {
      color: #003f5c;
      margin-bottom: 20px;
      font-weight: bold;
      font-size: 1.5rem;
    }

    .vaga-wrapper {
      position: relative;
      display: flex;
      align-items: center;
      margin-bottom: 30px;
    }


    .vaga-card {
      border: 2px solid #196e78;
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
      font-size: 1.4rem;
      margin-bottom: 8px;
    }

    .vaga-info span {
      display: block;
      margin-bottom: 6px;
      color: #196e78;
      font-weight: bold;
    }

    .vaga-info p {
      font-size: 1rem;
      color: #444;
    }

    .status-icon-externo {
      position: absolute;
      right: -20px; /* Ajustado para aproximar os ícones */
      font-size: 28px;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100%;
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
   


    .icon-legenda {
      display: flex;
      gap: 30px;
      margin-top: 30px;
      font-weight: bold;
      color: #004d61;
    }

    .icon-legenda i {
      margin-right: 6px;
      font-size: 20px;
    }
   
  /* Estilo básico do botão */
.btn-azul {
  padding: 20px;
  font-size: 30px;
  margin-left: 75px;
  height: 74px;
  display: flex;
  align-items: center;
  background-color: #2289e6;
  color: white;
  border: 1px solid #2289e6;
}


/* Estilo para o botão verde (check) */
.btn-verde {
  background-color: #28a745;
  border-color: #28a745;
}


/* Estilo para o botão vermelho (X) */
.btn-vermelho {
  background-color: #dc3545;
  border-color: #dc3545;
}


/* Estilo para o botão preto (ampulheta) */
.btn-preto {
  background-color: #000000;
  border-color: #000000;
}

.situacao-titulo{
  display:flex;
  align-items:center;
  justify-content:space-between;
  cursor:pointer;
  margin-bottom:10px
}
.situacao-opcoes{
  display:none;
  margin-bottom:15px
}

.situacao-opcoes.ativo{
  display:block
}
   
  </style>
</head>

<body>
  <!-- Header com logo e botões -->
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

  <!-- Título -->
  <h3 style="margin-left: 40px; margin-top: 30px;">SUAS VAGAS APLICADAS</h3>

  <!-- Conteúdo principal -->
  <main class="container">
    <!-- Painel de Filtros -->
   <forms>
    <aside class="filtros">
      <h2>FILTROS</h2>

      <!-- Situação com seta -->
      <div class="situacao-titulo" onclick="document.querySelector('.situacao-opcoes').classList.toggle('ativo');this.querySelector('i').classList.toggle('bx-chevron-up');this.querySelector('i').classList.toggle('bx-chevron-down')">
        <span>SITUAÇÃO</span>
        <i class='bx bx-chevron-down'></i>
      </div>
      <div class="situacao-opcoes">
        <label><input type="checkbox" name="situacao"> Em aguarde</label>
        <label><input type="checkbox" name="situacao"> Aprovado</label>
        <label><input type="checkbox" name="situacao"> Negado</label>
      </div>
      <hr style="margin: 15px 0; border-color: white;">

      <!-- Categorias -->
      <label><input type="checkbox" name="filtro"> Saúde</label>
      <label><input type="checkbox" name="filtro"> Eventos</label>
      <label><input type="checkbox" name="filtro"> Animais</label>
      <label><input type="checkbox" name="filtro"> Crianças</label>
      <label><input type="checkbox" name="filtro"> Educação</label>
      <label><input type="checkbox" name="filtro"> Tecnologia</label>
      <label><input type="checkbox" name="filtro"> Assist. Social</label>
      <label><input type="checkbox" name="filtro"> Administração</label>
      <label><input type="checkbox" name="filtro"> Meio Ambiente</label>
      <button class="btn-buscar">BUSCAR</button>
    </aside>
    </forms>

    <!-- Bloco de Vagas -->
    <section class="vagas">
      <!-- Vaga Em Aguarde -->
      <div class="vaga-wrapper">
        <div class="vaga-card">
                    <img src="img\icons_orange\outro.png" alt="Ícone" />
          <div class="vaga-info">
            <h4>NOME DA VAGA</h4>
            <span>5/10 • Nome da ONG</span>
            <p>Descrição pequena que está dentro do banco que o Guilherme ainda tem que fazer e passar o arquivo pra mim.</p>
          </div>
        </div>
<button class="btn-azul btn-preto"><i class='bx bxs-hourglass'></i></button>

      </div>

      <!-- Vaga Aprovada -->
      <div class="vaga-wrapper">
        <div class="vaga-card">
          <img src="img\icons_orange\outro.png" alt="Ícone" />
          <div class="vaga-info">
            <h4>NOME DA VAGA</h4>
            <span>5/10 • Nome da ONG</span>
            <p>Descrição pequena que está dentro do banco que o Guilherme ainda tem que fazer e passar o arquivo pra mim.</p>
          </div>
        </div>
  <button class="btn-azul btn-verde"><i class='bx bx-check'></i></button>
 
      </div>

      <!-- Vaga Negada -->
      <div class="vaga-wrapper">
        <div class="vaga-card">
          <img src="img\icons_orange\outro.png" alt="Ícone" />
          <div class="vaga-info">
            <h4>NOME DA VAGA</h4>
            <span>5/10 • Nome da ONG</span>
            <p>Descrição pequena que está dentro do banco que o Guilherme ainda tem que fazer e passar o arquivo pra mim.</p>
          </div>
        </div>
<button class="btn-azul btn-vermelho"><i class='bx bx-x'></i></button>

      </div>

    </section>
  </main>
</body>