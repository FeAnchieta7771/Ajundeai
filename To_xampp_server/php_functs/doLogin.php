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