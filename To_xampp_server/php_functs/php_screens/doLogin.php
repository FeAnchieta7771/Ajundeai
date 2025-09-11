<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function Show_error($e)
{
    $_SESSION['erro'] = $e;
    $_SESSION['login_state'] = $_POST['login_state'];
    $_SESSION['notification'] = 'server_error';

    header('Location: ../../login.php');
    exit();
}

function Show_incorrect_text($type_notfication)
{
    $_SESSION['login_state'] = $_POST['login_state'];
    $_SESSION['notification'] = $type_notfication;

    header('Location: ../../login.php');
    exit();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // include 'php_db/conexao.php';
    $table_login = $_SESSION['login_state'] = $_POST['login_state'];

    // auxílio de pesquisa ao sql e salvar nome ao sistema
    $auxiliar_name = "nome_" . $table_login;

    $name_email = $_SESSION['nome_email']   = $_POST['email'];
    $password   = $_SESSION['password']     = $_POST['password'];

    // ! Filtros do Login
    // Busca da senha pelo nome
    // Busca da senha pelo email

    try {
        $sql = "SELECT id, senha," . $auxiliar_name . " FROM " . $table_login . " WHERE
         " . $table_login . "." . $auxiliar_name . " = ? OR " . $table_login . ".email = ?";

        include '../php_db/methods.php';
        $result = select(null,$sql, [$name_email, $name_email]);

    } catch (Exception $e) {
        Show_error($e);
    }

    // Procura se algum dos registros possui a senha informada
    foreach ($result as $user) {

        if ($user['senha'] == $password) {

            $_SESSION['whoLogged'] = $table_login;
            $_SESSION['name'] = $user[$auxiliar_name];
            $_SESSION['id'] = $user['id'];
            $_SESSION['isLogin'] = true;

            $_SESSION['notification'] = 'login_sucess';

            if ($table_login == 'ong') {

                header('Location: ../../dashboard_ong.php');
                exit();

            } else if ($table_login == 'voluntario') {

                header('Location: ../../source.php');
                exit();
            }
        }
    }

    // Exibição de Erro
    // caso nenhum valor a cima tenha funciona,
    // significa que não foi encontrado
    Show_incorrect_text("login_error");
    exit();
}

?>