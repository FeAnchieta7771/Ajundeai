<?php
session_start();

if(isset($_SESSION['login'])){

    $_SESSION['login'] = '';
}
include 'php_functs/functions.php';

// busca situação de login do usuário
$login_state = is_logged();
// busca quem está logado
$is_ong = is_ong_logged();
// busca botões do header
$buttons_header = set_model_buttons_header($login_state, $is_ong);

// print_r($_SESSION);
?>

<!-- Tela de Login -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="icon" href="img\Logo_Aba.png">
    <title>AjundeAi • Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/css_screens/login.css">

    <style>
        body::-webkit-scrollbar {
            display: none; /* Para navegadores baseados em WebKit (Chrome, Safari) */
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

    <div class="log">
        <div class="fh1">
            BEM VINDO DE VOLTA!<br><span>realize seu login.</span>
        </div>
        <div id="container">
          <div class="tab-buttons">
            <button class="tab-btn active" content-id="home">
              <i class='bx bxs-user-circle' ></i> Voluntário
            </button>

            <button class="tab-btn" content-id="services">
              <i class='bx bxs-buildings' ></i> ONG
            </button>

          </div>

          <div class="tab-contents">

            <div class="content show" id="home">
              <div class="form-wrapper">
                  <form class="forms" method="POST" action="php_functs/doLogin.php">

                      <input type="hidden" name="login_state" value="voluntario">
                      <div class="form-container">
                          <label for="email">NOME OU EMAIL</label>
                          <input type="text" name="email" placeholder="Insira nome ou email aqui" value="<?php if(isset($_SESSION['LOGIN_email']) && $_SESSION['login'] == 'voluntario'){ echo $_SESSION['LOGIN_email'];}?>">
                          <br>
                          <br>
                          <label for="password">SENHA</label>
                          <input type="password" name="password" placeholder="Insira sua senha aqui" value="<?php if(isset($_SESSION['LOGIN_password']) && $_SESSION['login'] == 'voluntario'){ echo $_SESSION['LOGIN_password'];}?>">
                      </div>

                      <p class="signup">Não possui uma conta? <a href="account.php">CADASTRE-SE</a></p>
                      <button class="btlog" type="submit">LOGIN</button>
                  </form>
              </div>
            </div>

            <div class="content" id="services">
              <div class="form-wrapper">
                  <form class="forms" method="POST" action="php_functs/doLogin.php">
                    
                      <input type="hidden" name="login_state" value="ong">
                      <div class="form-container">
                          <label for="email">NOME OU EMAIL DA ONG</label>
                          <input type="text" name="email" placeholder="Insira nome ou email aqui" value="<?php if(isset($_SESSION['LOGIN_email']) && $_SESSION['login'] == 'ong'){ echo $_SESSION['LOGIN_email'];}?>">
                          <br>
                          <br>
                          <label for="password">SENHA DE REGISTRO</label>
                          <input type="password" name="password" placeholder="Insira sua senha aqui" value="<?php if(isset($_SESSION['LOGIN_password']) && $_SESSION['login'] == 'ong'){ echo $_SESSION['LOGIN_password'];}?>">
                      </div>

                      <p class="signup">Não possui uma conta? <a href="account.php">CADASTRE-SE</a></p>
                      <button class="btlog" type="submit">LOGIN</button>
                  </form>
              </div>
            </div>

          </div>
        </div>
    </div>

    <script>
        // pego todos os botões
        const tabs = document.querySelectorAll('.tab-btn');

        // atribuição da função á todos eles
        tabs.forEach( tab => tab.addEventListener('click', () => tabClicked(tab)))

        // função a caso sejam clicados
        const tabClicked = (tab) => {

            tabs.forEach(tab => tab.classList.remove('active'));
            tab.classList.add('active');
            // pego todos os paineis
            const contents = document.querySelectorAll('.content');

            //desativação dos paineis visíveis
            contents.forEach(content => content.classList.remove('show'));

            // pegar atributo do botão clicado
            const contentId = tab.getAttribute('content-id');

            // pegar painel com o mesmo ID do atributo do botão
            const content = document.getElementById(contentId);

            content.classList.add('show');
        }

    const botao_guia = localStorage.getItem('Botao_guia');

    console.log(botao_guia);

    if(botao_guia !== null){

        if(botao_guia == 'ong'){
            // pega os botões
            const tabs = document.querySelectorAll('.tab-btn');

            // remover a classe do todos os botões
            tabs.forEach(tab => tab.classList.remove('active'));

            // pegar atributo desses elementos
            const dataInfoValue = Array.from(tabs).map(tab => tab.getAttribute("content-id"));

            // pegar o botão da ong
            const indice = dataInfoValue.findIndex(item => item === 'services');
            const tab = tabs[indice];
            tab.classList.add('active');

            const contents = document.querySelectorAll('.content');

            //desativação dos paineis visíveis
            contents.forEach(content => content.classList.remove('show'));

            // pegar atributo do botão clicado
            const contentId = tab.getAttribute('content-id');

            // pegar painel com o mesmo ID do atributo do botão
            const content = document.getElementById(contentId);

            content.classList.add('show');
        }
    }
    </script>
</body>
</html>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    include 'conexao.php';
    $_SESSION['login'] = $_POST['login_state'];
    $table_login = $_POST['login_state'];

    // auxílio de pesquisa ao sql e salvar nome ao sistema
    $auxiliar_name = "nome_".$table_login;

    $name_email = $_POST['email'];
    $password = $_POST['password'];

    // ! Filtros do Login
    // Busca da senha pelo nome
    // Busca da senha pelo email
    $sql = "SELECT id, senha,".$auxiliar_name." FROM ".$table_login." WHERE ".$table_login.".".$auxiliar_name." = '".$name_email."' OR ".$table_login.".email = '".$name_email."'";
    // Coleta o resultado
    $result = return_select($sql);

    // Procura se algum dos registros possui a senha informada
    foreach($result as $user){

        if ($user['senha'] == $password){

            $_SESSION['whoLogged'] = $table_login;
            $_SESSION['name'] = $user[$auxiliar_name];
            $_SESSION['id'] = $user['id'];
            $_SESSION['isLogin'] = true;

            unset($_SESSION['LOGIN_email']);
            unset($_SESSION['LOGIN_password']);
            unset($_SESSION['login']);

            if ($table_login == 'ong'){

                header('Location: ../dashboard_ong.php');
                exit();

            } else if($table_login == 'voluntario'){

                header('Location: '.$_SESSION['tela_anterior']);
                exit();
            }
        }
    }

    $_SESSION['LOGIN_email'] = $_POST['email'];
    $_SESSION['LOGIN_password'] = $_POST['password'];

    echo "<script>
        localStorage.setItem('Botao_guia', '".$_POST['login_state']."');
        window.alert('Nome/Email ou Senha Incorreta');
        window.location.href = '../login.php';
    </script>";
    exit();
}

function return_select($sql){
    include 'conexao.php';
    try{
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;

    }catch(PDOException) {

        $_SESSION['LOGIN_email'] = $_POST['email'];
        $_SESSION['LOGIN_password'] = $_POST['password'];
        echo "<script>
            localStorage.setItem('Botao_guia', '".$_POST['login_state']."');
            window.alert('Ocorreu algo no Servidor, tente novamente mais tarde');
            window.location.href = '../login.php';
        </script>";
        exit();
    }
}

?>
