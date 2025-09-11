<?php
session_start();

$_SESSION['tela_anterior'] = $_SERVER['REQUEST_URI'];

include 'php_functs/php_methods/functions.php';

// busca situação de login do usuário
$login_state = is_logged();

if(!$login_state){
  header('Location: index.php');
  exit();
}

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
  <title>AjundeAi - Perfil Voluntário</title>
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Poppins', sans-serif; }
    body { background: #fff; }

    /* Layout principal */
    .painel {
      display: flex;
      justify-content: space-between;
      gap: 20px;
      padding: 30px;
    }

    /* Painel do perfil */
    .perfil {
      flex: 2;
      background: rgba(200,200,200,0.3);
      border: 2px solid #e76f00;
      border-radius: 6px;
      padding: 0;
      transition: all .3s ease;
      position: relative;
    }
    .perfil.editando {
      background: #004d61;
      border-color: #004d61;
      color: #fff;
    }

    .perfil-header {
      background: #e76f00;
      color: #fff;
      padding: 15px;
      font-weight: bold;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 10px;
      border-bottom: 2px solid #e76f00;
    }
    .perfil-header .left {
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .btn-trash {
      background: transparent;
      border: none;
      color: #fff;
      font-size: 22px;
      cursor: pointer;
    }
    .btn-trash:hover { color: #ffd6cc; }

    form {
      padding: 20px;
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 15px;
    }

    form input, form textarea {
      width: 100%;
      padding: 10px;
      border: 2px solid #004d61;
      border-radius: 6px;
      background: #eee;
      color: #000;
      font-size: 0.95rem;
    }

    form textarea {
      grid-column: span 2;
      height: 120px;
      resize: vertical;
    }

    form input:disabled, form textarea:disabled {
      background: #ddd;
      color: #777;
      cursor: not-allowed;
    }

    .perfil.editando form input,
    .perfil.editando form textarea {
      background: #fff;
      color: #004d61;
      border-color: #fff;
    }

    .botoes {
      grid-column: span 2;
      display: flex;
      gap: 10px;
      justify-content: flex-end;
    }
    .btn {
      padding: 10px 16px;
      border: none;
      border-radius: 6px;
      font-weight: bold;
      cursor: pointer;
    }
    .btn-editar { background: #007bff; color: #fff; }
    .btn-alterar { background: #28a745; color: #fff; }
    .btn-cancelar { background: #dc3545; color: #fff; }

    /* Painel lateral */
    .vagas-box {
      flex: 1;
      background: #f9f9f9;
      border: 2px solid #00c4b4;
      border-radius: 6px;
      padding: 15px;
      height: fit-content; /* ocupa só o necessário */
    }

    .vagas-box h3 {
      color: #004d61;
      margin-bottom: 5px;
    }
    .vagas-box small {
      display: block;
      margin-bottom: 15px;
      color: #555;
    }

    .btn-controle {
      display: block;
      width: 100%;
      background: #007bff;
      color: #fff;
      padding: 10px;
      border: none;
      border-radius: 6px;
      margin-bottom: 15px;
      cursor: pointer;
      font-weight: bold;
    }

    .vaga-item {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: #fff;
      border: 1px solid #ddd;
      padding: 8px 10px;
      margin-bottom: 10px;
      border-radius: 6px;
    }
    .vaga-item button {
      background: #dc3545;
      border: none;
      color: #fff;
      padding: 6px 10px;
      border-radius: 6px;
      cursor: pointer;
    }

    .input-nome { grid-column: span 2; }

    body::-webkit-scrollbar {
    display: none; /* Para navegadores baseados em WebKit (Chrome, Safari) */
    }

  </style>
</head>

  <title>AjundeAi • Perfil de usuário</title>

     

  <link
    href="https://cdn.boxicons.com/fonts/basic/boxicons.min.css"
    rel="stylesheet"
  />

  <link rel="stylesheet" href="css/notification.css">

<body>
<div class="notifications"></div>

<header>
    <div class="logo">
        <a href="index.php">
            <img src="img\Logo_Header.png" alt="Logo AjundeAi" />
        </a>
    </div>
    <?php echo $buttons_header; ?>
</header>
<?php show_message(); ?>

  <!-- Conteúdo principal -->
  <div class="painel">
    <!-- Perfil Voluntário -->
    <div class="perfil" id="perfilBox">
      <div class="perfil-header">
        <div class="left">
          <i class='bx bxs-user' style="font-size:22px;"></i>
          <span>TIPO DA CONTA: VOLUNTÁRIO</span>
        </div>
        <button class="btn-trash" title="Excluir conta">
          <i class='bx bxs-trash'></i>
        </button>
      </div>
      <form id="formPerfil">
        <input type="text" name="nome" placeholder="Nome" disabled>
        <input type="text" name="cpf" placeholder="CPF" disabled>
        <input type="email" name="email" placeholder="Email" disabled>
        <input type="password" name="senha" placeholder="Senha" disabled>
        <input type="text" name="telefone" placeholder="Telefone" disabled>
        <input type="text" name="whatsapp" placeholder="WhatsApp" disabled>
        <input type="text" name="categoria" placeholder="Categoria de preferência" disabled>
        <input type="text" name="periodo" placeholder="Período" disabled>
        <input type="text" name="situacao" placeholder="Situação atual" disabled>
        <input type="text" name="deficiencia" placeholder="Deficiência" disabled>
        <textarea name="sobre" placeholder="Conte um pouco sobre você e suas experiências" disabled></textarea>

        <div class="botoes">
          <button type="button" class="btn btn-editar" id="btnEditar">Editar</button>
          <button type="button" class="btn btn-cancelar" id="btnCancelar" style="display:none;">Cancelar</button>
          <button type="submit" class="btn btn-alterar" id="btnAlterar" style="display:none;">Alterar</button>
        </div>
      </form>
    </div>

    <!-- Vagas Cadastradas -->
    <div class="vagas-box">
      <h3>Vagas Cadastradas</h3>
      <small>1/3 cadastros permitidos</small>
      <button class="btn-controle">Ver Controle de Vagas</button>

      <div class="vaga-item"><span>Vaga 1</span><button>Sair</button></div>
      <div class="vaga-item"><span>Vaga 2</span><button>Sair</button></div>
      <div class="vaga-item"><span>Vaga 3</span><button>Sair</button></div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.2/dist/confetti.browser.min.js" defer></script>
  <script src='js/notification.js' defer></script>
  <script>
    const form = document.getElementById('formPerfil');
    const perfilBox = document.getElementById('perfilBox');
    const btnEditar = document.getElementById('btnEditar');
    const btnCancelar = document.getElementById('btnCancelar');
    const btnAlterar = document.getElementById('btnAlterar');
    const inputs = form.querySelectorAll('input, textarea');

    btnEditar.addEventListener('click', () => {
      inputs.forEach(el => el.disabled = false);
      perfilBox.classList.add('editando');
      btnEditar.style.display = 'none';
      btnCancelar.style.display = 'inline-block';
      btnAlterar.style.display = 'inline-block';
    });

    btnCancelar.addEventListener('click', () => {
      inputs.forEach(el => el.disabled = true);
      perfilBox.classList.remove('editando');
      btnEditar.style.display = 'inline-block';
      btnCancelar.style.display = 'none';
      btnAlterar.style.display = 'none';
    });

    form.addEventListener('submit', (e) => {
      e.preventDefault();
      alert('Alterações salvas!');
      inputs.forEach(el => el.disabled = true);
      perfilBox.classList.remove('editando');
      btnEditar.style.display = 'inline-block';
      btnCancelar.style.display = 'none';
      btnAlterar.style.display = 'none';
    });
  </script>
</body>
</html>
