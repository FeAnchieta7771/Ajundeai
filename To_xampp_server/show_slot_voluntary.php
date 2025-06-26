<!-- Apresentação da vaga selecionada ao usuário -->
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
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@40,400,0,0&icon_names=diversity_1"
    />

        <link
      href="https://cdn.boxicons.com/fonts/basic/boxicons.min.css"
      rel="stylesheet"
    />
  <link rel="stylesheet" href="css/header.css">
  <title>AjundeAi - Vagas</title>
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

    .search-bar {
      display: flex;
      align-items: center;
      gap: 10px;
      flex: 1;
      max-width: 400px;
    }

    .search-bar input {
      padding: 10px 15px;
      flex: 1;
      border-radius: 20px;
      border: none;
      font-size: 1rem;
    }

    .buttons {
      display: flex;
      gap: 10px;
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

    .header2 {
      background-color: #e68c22;
      padding: 15px 30px;
      display: flex;
      align-items: center;
      justify-content: left;
    }

    .vaga-name {
      align-items: center;
      justify-content: center;
      margin-left: 5px;
    }

    .vaga-name h4 {
      color:rgb(255, 255, 255);
      font-size: 2.5rem;
      font-family: 'Horizon', sans-serif;
    }

    .vaga-name span {
      display: block;
      margin-bottom: 5px;
      color:rgb(255, 255, 255);
      font-weight: bold;
      font-family: 'Antique', sans-serif;
    }

    .vaga-name-img {
      margin-left: 20%;
      width: 140px;
      height: 140px;
    }
   
    .vaga-container {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      padding: 30px;
      background-color: white;
      margin-top: 1.5%;
    }
   
    .vaga-descricao {
        flex: 1;
        width: 70%;
        margin-left: 20%;
        margin-right: 150px;
    }
   
    .vaga-descricao-titulo {
      color: #2289e6;
      font-size: 2rem;
      margin-bottom: 15px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
   
    .vaga-descricao-titulo span {
      font-size: 1.6rem;
      color: #2289e6;
    }
   
    .vaga-descricao-texto {
      line-height: 1.6;
      color: #003e53;
    }
   
    .vaga-lateral {
      width: 20%;
      margin-right: 10%;
      display: flex;
      flex-direction: column;
    }
   
    .card-curriculo {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 12px;
      border-radius: 4px;
    }
   
    .btn-curriculo {
      background-color: #e76f00;
      border: none;
      color: white;
      font-weight: bold;
      font-size: 1rem;
      padding: 22px;
      cursor: pointer;
      width: 250px;
    }
   
    .curriculo-icon {
      background-color: #007bff;
      color: white;
      padding: 20px;
      font-size: 1rem;
    }
   
    .vaga-localizacao {
      border: 2px solid #004d61;
      padding: 15px;
    }
   
    .vaga-localizacao h4 {
      color: #e76f00;
      font-weight: bold;
      font-size: 1.1rem;
      border-bottom: 2px solid #a54ff0;
      display: inline-block;
      margin-bottom: 10px;
    }
   
    .vaga-localizacao p {
      color: #004d61;
      font-style: italic;
      font-size: 0.9rem;
      line-height: 1.4;
      word-break: break-word;
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
        <!-- botões do header -->
        <?php echo $buttons_header; ?>
    </header>
        <form method="POST" action="filter.php">
          <input type="hidden" name="type" value="filter_base"/>
            <header style="background-color: #004d61; justify-content: center;">
            <div class="search-bar">
                <input type="text" placeholder="Pesquise sua vaga solicitada" name='filter_user' value="<?php if(isset($_POST['filter_user'])){ echo $_POST['filter_user'];}?>"/>
                <button class="btn btn-buscar">BUSCAR</button>
            </div>
            </header>

           
        </form>

        <?php include 'php_functs/show_slot.php'; do_slot(); ?>
    <!-- <header class="header2">
          <img src="img\office-building.png" alt="Ícone" class="vaga-name-img"/>
          <div class="vaga-name">
            <h4>NOME DA VAGA</h4>
            <span>Nome da ONG</span>
          </div>
    </header>
   
    <main class="vaga-container">
      <div class="vaga-descricao">
        <h3 class="vaga-descricao-titulo">DESCRIÇÃO DA VAGA <div><i class='bx bxs-user' ></i> 25/50</div> </h3>
        <p class="vaga-descricao-texto">
          CSEIUOGHSSOKJNGFCLKGMJLCDKWEÇMHNGFJHKJHL Kbvuhftrhntgthudycetretxrxr
          efS6tdgoyoi7oioloioioi767767676767676767676767
          676767676767676767676767676 vtrd vtrd vtrd vtrd
          vtrd vtrd vtrd vtrd vtrd vtrd vtrd vtrd vtrd vtrd
          vtrd vtrd vtrd vtrd vtrd vtrd vtrd vtrd vtrd vtrd
          vtrd vtrd vtrd vtrd vtrd vtrd vtrd vtrd vtrd vtrd
          vtrd vtrd vtrd vtrd vtrd vtrd vtrd vtrd vtrd vtrd
          vtrd vtrd vtrd vtrd vtrd vtrd vtrd
          vttrdgfuyfgbktunnjnl.lh.lolkj..
          asiufuhdfvkfjvkvfivfvvfvfvfvfvfkfjrkehnhh. Sim.
        </p>
      </div>
   
      <div class="vaga-lateral">
        <div class="card-curriculo">
          <button class="btn-curriculo">ENVIAR CURRÍCULO</button>
          <span class="curriculo-icon">&#128278;</span>
        </div>
        <div class="vaga-localizacao">
          <h4>LOCALIZAÇÃO</h4>
          <p><em>GSEIUOGHSSOKJNGFÇLKGMJLÇDKWEÇ<br>MHNGFJHKJHLK</em></p>
        </div>
      </div>

    </main> -->

  </main>
</body>
</html>