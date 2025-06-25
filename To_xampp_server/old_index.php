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

<!-- Tela de Menu -->
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

/* fim css dos botões de acesso ao login ===================== */

    .hero {
      background: linear-gradient(135deg, #003a45 60%, #005e55 100%);
      position: relative;
      padding: 180px 20px;
      text-align: center;
      color: white;
      overflow: hidden;
    }

    .hero::before {
      content: '';
      position: absolute;
      top: -100px;
      left: -100px;
      width: 300px;
      height: 300px;
      background: rgba(255, 255, 255, 0.08);
      border-radius: 50%;
    }

    .hero h1 {
      font-size: 2.5rem;
      font-weight: bold;
      margin-bottom: 40px;
      position: relative;
      z-index: 1;
    }

    .search-bar {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 10px;
      position: relative;
      z-index: 1;
      align-items: center;
    }

    .search-input {
      padding: 15px;
      width: 400px;
      border-radius: 8px;
      border: none;
      font-size: 1rem;
    }

    .search-button {
      flex-wrap: wrap;
      background-color: #007f79;
      color: white;
      border: none;
      border-radius: 8px;
      padding: 15px 30px;
      font-weight: bold;
      font-size: 1rem;
      cursor: pointer;
      font-family: 'Poppins', sans-serif;
      align-items: center;
      gap: 10px;
      padding: auto;
      transition: .15s;
    }

    .search-button:hover{
      transform: scale(1.02);
      background-color: white;
      color: #007f79;
    }

    .search-button img {
      height: 20px;
    }

    .categories {
      padding: 60px 20px;
      background-color: white;
      text-align: center;
    }

    .categories-title {
      color: #e76f00;
      font-weight: bold;
      font-size: 1.5rem;
      margin-bottom: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
    }

    .categories-title img {
      height: 30px;
    }

    .category-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
      gap: 35px;
      width: 40%;
      margin: 0 auto;
    }

    .category-item {
      color: white;
      border-radius: 8px;
      padding: 30px 10px;
      font-weight: bold;
      cursor: pointer;
      transition: 0.3s;
      font-size: 1.35rem;
      width: 210px;
      margin: 5px;
      border: none;
      margin-bottom: 10px;
      transition: 0.15s
    }

    .category-item:hover {
      /* opacity: 0.9; */
      background-color: #e76f00;
      transform: scale(1.02);
    }

    /* Cores específicas */
    .eventos { background-color: #40d9cd; }
    .animais, .criancas, .assistencia {
      background-color: #00a89a; /* Mesma cor azul para os 3 */
    }
    .educacao { background-color: #007f79; }
    .meioambiente { background-color: #40d9cd; }
    .tecnologia { background-color: #007f79; }
    .saude { background-color: #40d9cd; }
    .administracao { background-color: #007f79; }

    footer {
      background-color: #e76f00;
      padding: 20px 30px;
      color: white;
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      font-size: 0.9rem;
    }

    .social-footer {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .social-footer img {
      width: 30px;
      height: 30px;
    }

    .contact-info {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .footer-logo img {
      height: 60px;
      width: 170px;
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

  <div class="hero">
    <h1>ENCONTRE SUA VAGA<br/>DE VOLUNTARIADO.</h1>
    <div class="search-bar">
      <form method="POST" action="filter.php">
        <input type="hidden" name="type" value="home_search"/>
        <input class="search-input" type="text" placeholder="Vaga de meio ambiente, cuidadores, ONG ..." name="filter_user"/>
        <button class="search-button">BUSCAR <i class='bx  bx-search-alt'></i> 
      </button>
    </form>
  </div>
</div>

<div class="categories">
  <div class="categories-title">
    <i class='bx bxs-circle' style='color:#40d9cd'></i> 
    VEJA ALGUMAS DISPONÍVEIS 
  </div>
  <!-- nome do form: home_category -->
  <div class="category-grid">
    <form method="POST" action="filter.php">   
      <input type="hidden" name="type" value="home_category"/>
      
      <button type='submit' name='category_button' value = 'eventos' class="category-item eventos">EVENTOS</button>
      <button type='submit' name='category_button' value = 'animais' class="category-item animais">ANIMAIS</button>
      <button type='submit' name='category_button' value = 'educação' class="category-item educacao">EDUCAÇÃO</button>
      <button type='submit' name='category_button' value = 'meio ambiente' class="category-item meioambiente">MEIO AMBIENTE</button>
      <button type='submit' name='category_button' value = 'crianças' class="category-item criancas">CRIANÇAS</button>
      <button type='submit' name='category_button' value = 'tecnologia' class="category-item tecnologia">TECNOLOGIA</button>
      <button type='submit' name='category_button' value = 'saúde' class="category-item saude">SAÚDE</button>
      <button type='submit' name='category_button' value = 'assistencia' class="category-item assistencia">ASSIST. SOCIAL</button>
      <button type='submit' name='category_button' value = 'administração' class="category-item administracao">ADMINISTRAÇÃO</button>
      
    </form>
    </div>
  </div>

  <footer>
    <div class="contact-info">
      <img src="https://img.icons8.com/ios-filled/50/ffffff/new-post.png" alt="Email Icon" />
      <span>ajundeai_anchieta@gmail.com</span>
      <img src="https://img.icons8.com/ios-filled/50/ffffff/instagram-new.png" alt="Instagram Icon" />
      <span>@ajundeai_anchieta</span>
    </div>
    <div class="footer-logo">
      <!--s Substitua -->
      <img src="img\Logo_Header.png" alt="Logo AjundeAi" />
    </div>
  </footer>
</body>
</html>
