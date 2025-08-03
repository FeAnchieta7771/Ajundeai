<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function Show_error(){
        $_SESSION['LOGIN_email'] = $_POST['email'];
        $_SESSION['LOGIN_password'] = $_POST['password'];

        echo "<script>
                localStorage.setItem('Botao_guia', '".$_POST['login_state']."');
                window.alert('Ocorreu algo no Servidor, tente novamente mais tarde');
                window.location.href = '../login.php';
            </script>";
        exit();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    // include 'php_db/conexao.php';
    $_SESSION['login'] = $_POST['login_state'];
    $table_login = $_POST['login_state'];

    // auxílio de pesquisa ao sql e salvar nome ao sistema
    $auxiliar_name = "nome_".$table_login;

    $name_email = $_POST['email'];
    $password = $_POST['password'];

    // ! Filtros do Login
    // Busca da senha pelo nome
    // Busca da senha pelo email

    try{
        $sql = "SELECT id, senha,".$auxiliar_name." FROM ".$table_login." WHERE
         ".$table_login.".".$auxiliar_name." = ? OR ".$table_login.".email = ?";

        include '../php_db/methods.php';
        $result = select($sql,[$name_email,$name_email]);

    } catch(PDOException $e) {
        Show_error();
    }

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

                if(isset($_SESSION['tela_de_vaga'])){
                    
                    header('Location: '.$_SESSION['tela_de_vaga']);
                }
                header('Location: '.$_SESSION['tela_anterior']);
                exit();
            }
        }
    }

    // Exibição de Erro
    // caso nenhum valor a cima tenha funciona,
    // significa que não foi encontrado
    Show_error();
    exit();
}

?>