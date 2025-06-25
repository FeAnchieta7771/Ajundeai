<?php
session_start();

include 'php_functs/functions.php';

// busca situação de login do usuário
$login_state = is_logged();
// busca quem está logado
$is_ong = is_ong_logged();
// busca botões do header
$buttons_header = set_model_buttons_header($login_state, $is_ong);
?>

<!-- Tela de Resultado da Pesquisa do Filtro -->
     <!-- nome do form: filter -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=search_off" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=database_off" />
  <link rel="icon" href="img\Logo_Aba.png">
  <title>AjundeAi • Pesquisa</title>
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

    .container {
      display: flex;
      flex-wrap: wrap;
      padding: 40px 10px 0px 40px;
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
      font-size: 1.6rem;
      font-family: "Horizon", sans-serif;
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
      color: #2289e6;
      margin-bottom: 20px;
      font-weight: bold;
      font-family: 'Horizon', sans-serif;
      font-size: 1.3rem;
    }

    .scroll-wrapper {
      overflow-y: auto;
      max-height: 63vh;
      padding-right: 10px;
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
    }

    .vaga-card img {
      width: 120px;
      height: 120px;
    }

    .vaga-info h4 {
      color: #e76f00;
      font-size: 1.7rem;
      margin-bottom: 5px;
      font-family: 'Horizon', sans-serif;
    }

    .vaga-info span {
      display: block;
      margin-bottom: 5px;
      align-items: center; 
      color: #196e78;
      font-weight: bold;
      font-family: 'Antique', sans-serif;
    }

    .vaga-info p {
      font-size: 1.2rem;
      color: #444;
    }

    /* .scroll-wrapper h3{
      border-bottom: 5px;
      color: blue;
    } */
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
               <input type="text" name="filter_user" placeholder="Pesquise sua vaga solicitada" value="<?php if(isset($_POST['filter_user'])){ echo $_POST['filter_user'];}?>"/>
               <button class="btn btn-buscar" style="font-family: 'Horizon', sans-serif; font-size: 15px">BUSCAR</button>
          </div>
          </header>

          <main class="container">
          <aside class="filtros">
               <h2>FILTROS</h2>
               <label><input type="checkbox" value="saúde" name="saúde"> Saúde</label>
               <label><input type="checkbox" value="eventos" name="eventos"> Eventos</label>
               <label><input type="checkbox" value="animais" name="animais"> Animais</label>
               <label><input type="checkbox" value="crianças" name="crianças"> Crianças</label>
               <label><input type="checkbox" value="educação" name="educação"> Educação</label>
               <label><input type="checkbox" value="tecnologia" name="tecnologia"> Tecnologia</label>
               <label><input type="checkbox" value="assistencia" name="assistencia"> Assist. Social</label>
               <label><input type="checkbox" value="administração" name="administração"> Administração</label>
               <label><input type="checkbox" value="meio ambiente" name="meio_ambiente"> Meio Ambiente</label>
               <button class="btn btn-buscar" style="font-family: 'Horizon', sans-serif; font-size: 18px">BUSCAR</button>
          </aside>
    </form>

    <section class="vagas">
      <?php include 'php_functs/filter_act.php'; do_filter(); ?>

      <!-- <h3>[N] VAGAS DE [FILTRO] FORAM ENCONTRADAS</h3>
      <div class="scroll-wrapper">
        Aqui os blocos podem ser gerados via PHP  
        <div class="vaga-card">
          <img src="img\icons_orange\outro.png" alt="Ícone" />
          <div class="vaga-info">
            <h4>NOME DA VAGA</h4>
            <span>5/10 • Nome da ONG</span>
            <p>Descrição pequena que está dentro do banco que o Guilherme ainda tem que fazer e passar o arquivo pra mim.</p>
          </div>
        </div>
        Repita o .vaga-card conforme necessário

      </div> -->
    </section>
  </main>
</body>
</html>
