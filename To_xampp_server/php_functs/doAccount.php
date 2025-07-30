<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    include 'php_db/conexao.php';
    $accout = $_POST['account_state'];

    $name = $_POST['nome'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $telephone = $_POST['telephone'];
    $whats = $_POST['whats'];
    $about = $_POST['about'];

    if ($accout == 'voluntario'){

        $sql_command = "INSERT INTO $accout(nome_voluntario,email,telefone,senha,sobre,whatsapp)
        VALUES ('$name','$email','$telephone','$password','$about','$whats')";

    } else if ($accout == 'ong'){

        $sql_command = "INSERT INTO $accout(nome_ong,email,senha,sobre,telefone,whatsapp)
        VALUES ('$name','$email','$password','$about','$telephone','$whats')";
    }

    try{
        $stmt = $conn->prepare($sql_command);
        $stmt->execute();

        $id = last_id($accout);

        $_SESSION['whoLogged'] = $accout;
        $_SESSION['name'] = $name;
        $_SESSION['id'] = $id[0]['id'];
        $_SESSION['isLogin'] = true;

        if ($accout == 'ong'){

            header('Location: ../dashboard_ong.php');
            exit();

        } else if($accout == 'voluntario'){

            header('Location: '.$_SESSION['tela_anterior']);
            exit();
        }


    }catch(PDOException) {

        echo "<script>
            window.alert('Ocorreu algo no Servidor, tente novamente mais tarde');
            window.location.href = '../account.php';
        </script>";
        exit();
    }
}

function last_id($table){
    include 'conexao.php';

    $sql = "SELECT id FROM $table ORDER BY id DESC LIMIT 1;";

    try{
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;

    }catch(PDOException) {

        echo "<script>
            window.alert('Eita! Ocorreu algo no Servidor, tente novamente mais tarde');
            window.location.href = '../account.php';
        </script>";
        exit();
    }
}
?>