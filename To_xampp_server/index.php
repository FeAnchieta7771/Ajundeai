<!-- Tela de Menu -->
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.boxicons.com/fonts/basic/boxicons.min.css"
      rel="stylesheet"
    />
    <link rel="icon" href="img\Logo_Aba.png" />
    <title>AjundeAi</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@40,400,0,0&icon_names=diversity_1"
    />
    <link rel="stylesheet" href="css/header.css" />
    <link rel="stylesheet" href="css/home/body_index.css" />
    <link rel="stylesheet" href="css/home/style.css" />

    <style>
      * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        font-family: "Poppins", sans-serif;
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
        content: "";
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
        font-family: "Horizon", sans-serif;
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
        font-family: "Poppins", sans-serif;
        align-items: center;
        gap: 10px;
        padding: auto;
        transition: 0.15s;
      }

      .search-button:hover {
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
        transition: 0.15s;
      }

      .category-item:hover {
        /* opacity: 0.9; */
        background-color: #e76f00;
        transform: scale(1.02);
      }

      /* Cores específicas */
      .eventos {
        background-color: #40d9cd;
      }
      .animais,
      .criancas,
      .assistencia {
        background-color: #00a89a; /* Mesma cor azul para os 3 */
      }
      .educacao {
        background-color: #007f79;
      }
      .meioambiente {
        background-color: #40d9cd;
      }
      .tecnologia {
        background-color: #007f79;
      }
      .saude {
        background-color: #40d9cd;
      }
      .administracao {
        background-color: #007f79;
      }

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
      <?php echo $buttons_header; ?>
    </header>

    <div class="hero">
      <h1>ENCONTRE SUA VAGA<br />DE VOLUNTARIADO.</h1>
      <div class="search-bar">
        <form method="POST" action="filter.php">
          <input type="hidden" name="type" value="home_search" />
          <input
            class="search-input"
            type="text"
            placeholder="Vaga de meio ambiente, cuidadores, ONG ..."
            name="filter_user"
          />
          <button class="search-button">
            BUSCAR <i class="bx bx-search-alt"></i>
          </button>
        </form>
      </div>
    </div>
    <div class="tryLogin">
      <h2>Cadastre sua Ajuda</h2>
      <p style="color: rgb(110, 110, 110)">
        Faça sua parte como Voluntário ou crie oportunidades como uma ONG
      </p>
      <br />
      <br />
      <div class="buts">
        <a class="buttonTryLogin1" id="Cadastro_volunt" href="account.php"
          >Criar conta de <strong>Voluntário</strong></a
        >
        <p>OU</p>
        <a class="buttonTryLogin2" id="Cadastro_ong" href="account.php">Criar conta de <strong>ONG</strong></a>
      </div>
    </div>
    <div class="parent">
      <div class="div1">
        <h2>PORQUE SE VOLUNTARIAR?</h2>
        <div class="objects">
          <p>
            Ser voluntário é muito mais do que doar tempo — é fazer a diferença
            na vida de outras pessoas e, ao mesmo tempo, transformar a sua
            própria. O voluntariado fortalece a comunidade, promove a empatia e
            cria redes de apoio que geram impacto real no mundo.
          </p>
          <a class="buttonTryLogin3"
            ><span class="material-symbols-outlined">diversity_1</span>
            <strong> Fazer parte da Diferença!</strong></a
          >
        </div>
      </div>
      <div class="div2">
        <img
          class="image_div"
          src="img/imgHome1.png"
          style="width: 100%; max-height: 500px; object-fit: fill; height: auto"
        />
      </div>

      <div class="div3">
        <img
          class="image_div"
          src="img/imgHome3.png"
          style="width: 100%; max-height: 500px; object-fit: fill; height: auto"
        />
      </div>

      <div class="div4">
        <div class="objects">
          <p>
            Além de contribuir para causas que você acredita, você desenvolve
            novas habilidades, conhece pessoas incríveis e amplia sua visão de
            mundo. Cada pequena ação tem o poder de gerar grandes mudanças. Seja
            a diferença que você quer ver no mundo.<strong>Participe!</strong>
          </p>
          <a class="buttonTryLogin3"
            ><span class="material-symbols-outlined">diversity_1</span>
            <strong> Fazer parte da Diferença!</strong></a
          >
        </div>
      </div>
    </div>

    <div class="CategoryA">
      <div class="titleCategory">
        <h2>Quais vagas posso me Voluntariar?</h2>
        <i class="bx bxs-circle" style="color: #40d9cd"></i>
        <p style="color: rgb(110, 110, 110)">
          Algumas das vagas mais selecionadas pelos nossos usuários
        </p>
      </div>
      <br />
      <br />

      <div class="parentB">
        <form method="POST" action="filter.php">
          <input type="hidden" name="type" value="home_category"/>

          <div class="divB1">
            <button type='submit' name='category_button' value = 'eventos'>
              <section class="titleCard">
                <br />
                <i class="bx bx-calendar-event" style="font-size: 60px"></i>
                <h2>EVENTOS</h2>
              </section>

              <section class="bodyCard">
                <p>
                  Ajude na organização, recepção e suporte durante os eventos.
                  Uma chance de desenvolver habilidades, fazer conexões e
                  colaborar de forma prática!
                </p>
              </section>
            </button>
          </div>

          <div class="divB2">
            <button type='submit' name='category_button' value = 'animais'>
              <section class="titleCard">
                <br />
                <i class="bx bx-bird-alt" style="font-size: 60px"></i>
                <h2>ANIMAIS</h2>
              </section>

              <section class="bodyCard">
                <p>
                  Apoie no cuidado, alimentação, higiene e bem-estar dos
                  animais. Contribua oferecendo amor, atenção e ajudando na
                  rotina dos abrigos ou campanhas de adoção.
                </p>
              </section>
            </button>
          </div>

          <div class="divB3">
            <button type='submit' name='category_button' value = 'educação'>
              <section class="titleCard">
                <br />
                <i class="bx bxs-education" style="font-size: 60px"></i>
                <h2>EDUCAÇÃO</h2>
              </section>

              <section class="bodyCard">
                <p>
                  Contribua com apoio escolar, reforço, oficinas ou atividades
                  educativas. Ajude a transformar vidas compartilhando
                  conhecimento e incentivando o aprendizado.
                </p>
              </section>
            </button>
          </div>

          <div class="divB4">
            <button type='submit' name='category_button' value = 'meio ambiente'>
              <section class="titleCard">
                <br />
                <i class="bx bxs-florist" style="font-size: 60px"></i>
                <h2>MEIO AMBIENTE</h2>
              </section>

              <section class="bodyCard">
                <p>
                  Participe de ações como plantio, limpeza, reciclagem e
                  conservação. Ajude a cuidar da natureza e a promover um futuro
                  mais sustentável.
                </p>
              </section>
            </button>
          </div>

          <div class="divB5">
            <button type='submit' name='category_button' value = 'crianças'>
              <section class="titleCard">
                <br />
                <i class="bx bxs-parent-child" style="font-size: 60px"></i>
                <h2>CRIANÇAS</h2>
              </section>

              <section class="bodyCard">
                <p>
                  Ajude em atividades recreativas, educativas e de cuidado. Leve
                  carinho, atenção e diversão para fazer a diferença na vida de
                  muitas crianças.
                </p>
              </section>
            </button>
          </div>

          <div class="divB6">
            <button type='submit' name='category_button' value = 'tecnologia'>
              <section class="titleCard">
                <br />
                <i class="bx bxs-robot" style="font-size: 60px"></i>
                <h2>TECNOLOGIA</h2>
              </section>

              <section class="bodyCard">
                <p>
                  Apoie com oficinas, mentorias ou suporte técnico. Use seus
                  conhecimentos para ajudar projetos, ensinar e promover
                  inclusão digital.
                </p>
              </section>
            </button>
          </div>

          <div class="divB7">
            <button type='submit' name='category_button' value = 'saúde'>
              <section class="titleCard">
                <br />
                <i class="bx bxs-heart-plus" style="font-size: 60px"></i>
                <h2>SAÚDE</h2>
              </section>

              <section class="bodyCard">
                <p>
                  Apoie em campanhas, orientações, triagens ou atividades de
                  bem-estar. Leve cuidado, informação e apoio para quem mais
                  precisa.
                </p>
              </section>
            </button>
          </div>

          <div class="divB8">
            <button type='submit' name='category_button' value = 'assistencia'>
              <section class="titleCard">
                <br />
                <i class="bx bxs-help-circle" style="font-size: 60px"></i>
                <h2>ASSISTÊNCIA SOCIAL</h2>
              </section>

              <section class="bodyCard">
                <p>
                  Ajude no acolhimento, na distribuição de doações e no suporte
                  a famílias em situação de vulnerabilidade. Faça parte de ações
                  que transformam vidas.
                </p>
              </section>
            </button>
          </div>

          <div class="divB9">
            <button type='submit' name='category_button' value = 'administração'>
              <section class="titleCard">
                <br />
                <i
                  class="bx bxs-message-circle-exclamation"
                  style="font-size: 60px"
                ></i>
                <h2>ADMINISTRAÇÃO</h2>
              </section>

              <section class="bodyCard">
                <p>
                  Apoie em tarefas organizacionais, cadastros, comunicação,
                  controle de materiais e apoio interno. Ajude a manter os
                  projetos funcionando!
                </p>
              </section>
            </button>
          </div>
        </form>
      </div>
    </div>
    <div class="Creator" id="catgory_creator">
      <div class="titleCategory">
        <h2 style="color: #e76f00">COLABORADORES</h2>
        <i class="bx bxs-circle" style="color: #40d9cd"></i>
        <p style="color: rgb(110, 110, 110)">
          Pessoas que ajudaram para este site existir
        </p>
      </div>
    </div>
    <div class="creators">
      <div class="slider">
        <div class="item">
          <img src="img/creators/guilherme.png" alt="" />
          <h1>GUILHERME LUIZ SIMON</h1>
          Estudante Anchienta, 3º médio informática. Desenvolvedor da programação
          interna do sistema, funcionamento do banco de dados, auxiliar no desenvolvimento
          do wireframe.
        </div>
        <div class="item">
          <img src="img/creators/miguel.png" alt="" />
          <h1>MIGUEL GEME STELLA</h1>
          Estudante Anchienta, 3º médio informática. Desenvolvedor das principais telas e
          serviços do site sobre código HTML e Css, desenvolvimento da 
          lógica de utilidades ao site.
        </div>
        <div class="item">
          <img src="img/creators/felipe.png" alt="" />
          <h1>FELIPE CAPELLETTI ANDREA</h1>
          Estudante Anchienta, 3º médio informática. Desenvolvedor da programação
          interna do sistema, auxiliar no desenvolvimento wireframe, auxiliar no desenvolvimento
          das telas HTML e Css.
        </div>
        <div class="item">
          <img src="img/creators/mauela.png" alt="" />
          <h1>MANUELA SOBRAL DA PAZ</h1>
          Estudante Anchienta, 3º médio informática. Desenvolvedor da programação
          interna do sistema, auxiliar no desenvolvimento do wireframe, desenvolvimento da 
          lógica de utilidades ao site.
        </div>
        <div class="item">
          <img src="img/creators/bruno.png" alt="" />
          <h1>BRUNO GAINO LIGIERI</h1>
          Estudante Anchienta, 3º médio informática. Desenvolvedor das principais telas e
          serviços do site sobre código HTML e Css.
        </div>

        <button id="next">></button>
        <button id="prev"><</button>
      </div>
    </div>
    <br />
    <br />
    <br />
    <br />
    <br />
    <p
      style="
        justify-self: center;
        margin-bottom: 5px;
        color: rgb(110, 110, 110);
        font-family: 'Antique', sans-serif;
      "
    >
      Copyright 2025
    </p>
    <script src="js/home.js"></script>
    <footer>
      <div class="contact-info">
        <img
          src="https://img.icons8.com/ios-filled/50/ffffff/new-post.png"
          alt="Email Icon"
        />
        <span>ajundeai_anchieta@gmail.com</span>
        <img
          src="https://img.icons8.com/ios-filled/50/ffffff/instagram-new.png"
          alt="Instagram Icon"
        />
        <span>@ajundeai_anchieta</span>
      </div>
      <div class="footer-logo">
        <!--s Substitua -->
        <img src="img\Logo_Header.png" alt="Logo AjundeAi" />
      </div>
    </footer>
  </body>
</html>
