<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bem-Vindo</title>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@700&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Barlow Condensed', sans-serif;
      font-weight: 700;
      background-color: #000;
      color: #fff;
    }

    header {
      background-color: #1a1d34;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 10px 20px;
      height: 75px;
    }

    header img {
      height: 300%;
    }

    .icon-style {
    font-size: 250%; 
    vertical-align: middle; 
    padding: 1px;
    }

    .icon-style:hover {
    vertical-align: middle; 
    color: #007bff;
    }

    .butlog {
      background-color: #98CEFF;
      color: black;
      padding: 10px 20px;
      font-size: 18px;
      transition: all 0.3s ease;
      width: fit-content;
      vertical-align: middle;
      border: #98CEFF;
    }

    .butdlogout{
      background-color: #F23030;
      color: white;
      padding: 10px 20px;
      font-size: 18px;
      transition: all 0.3s ease;
      width: fit-content;
      vertical-align: middle;
      border: #98CEFF;
    }

    .icon-log {
    font-size: 130%; 
    padding-right: 10px;
    }

    #mainContainer {
      display: flex;
      height: calc(100vh - 75px);
      width: 100vw;
    }

    .left-panel {
      flex: 1;
      background-color: #000;
      display: flex;
      flex-direction: column;
      justify-content: center;
      padding: 60px;
      background-image: url('img/FUNDO_HOME.png');
      background-repeat: no-repeat;
      background-position: bottom right;
      background-size: contain;
    }

    .h1 {
      font-size: 4.5rem;
      color: #008cff;
      font-style: italic;
      margin-bottom: 20px;
      margin-left: 20%;
    }

    .p {
      font-size: 20px;
      margin-bottom: 80px;
      margin-left: 20%;
    }

    .button {
      background-color: #007bff;
      color: white;
      border: 3px solid #007bff;
      padding: 15px 30px;
      font-size: 12px;
      cursor: pointer;
      transition: all 0.3s ease;
      text-transform: uppercase;
      width: fit-content;
      margin-left: 20%;
    }

    .button:hover {
      background-color: #000;
      color: white;
    }

    .right-panel {
      flex: 0.9;
      background-image: url('https://blog.saninternet.com/wp-content/uploads/2024/04/inteligencia-artificial.png');
      background-size: cover;
      background-position: center;
      background-color: white;
    }

    @media (max-width: 800px) {
      #mainContainer {
        flex-direction: column;
      }

      .left-panel, .right-panel {
        width: 100%;
        height: 50vh;
        padding: 30px;
      }

      .h1 {
        font-size: 3rem; /* 1rem = -+ 16px  */
      }

      .p {
        font-size: 1rem;
      }

      .button {
        font-size: 1.1rem;
        padding: 15px 25px;
      }
      
      .right-panel {
      border-top: 2px solid #007bff;
      }
    }
  </style>
</head>
<body>

  <header>
    <img src="img/logo_bar.png">
    <div>
      <i class='bx bx-home-alt icon-style'></i>
      <i class='bx bxs-group icon-style'></i>
      <button class= "butlog"><i class='bx bx-user icon-log'></i>Login</button>
      
    </div>
  </header>

  <main id="mainContainer">
    <section class="left-panel">
      <h1 class= "h1">BEM VINDO</h1>
      <p class= "p">Tenha uma ótima experiência com nossa nova IA por interação de voz.</p>
      <button class= "button">Converse com a ISA</button>
    </section>
    <aside class="right-panel"></aside>
  </main>

</body>
</html>
