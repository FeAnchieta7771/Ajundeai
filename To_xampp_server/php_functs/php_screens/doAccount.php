<?php

include '../php_db/methods.php';
include '../php_methods/phones.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function check_unique_name($table, $name){
    try{
        $sql = "SELECT COUNT(*) as 'lines' FROM $table WHERE nome_$table = ?";
        $result = select($sql,[$name]);

        if ($result[0]['lines'] > 0){
            return false;
        }
        else{
            return true;
        }
    } catch(PDOException $e) {
        Show_error($e);
    }
}

function Show_error($e){
    $_SESSION['message']       = 'Eita! Ocorreu algo no Servidor, tente novamente mais tarde';
    $_SESSION['erro']          = $e;
    $_SESSION['account_state'] = $_POST['account_state'];
    // echo "<script>
    // window.alert('Eita! Ocorreu algo no Servidor, tente novamente mais tarde');
    // <script>console.log('Erro Server: " . $e . "' );</script>
    // localStorage.setItem('Botao_guia', '".$_POST['account_state']."');
    // </script>";
    header('Location: ../../account.php');
    exit();
}

function Show_incorrect_text($text){
    $_SESSION['message']       = $text;
    $_SESSION['account_state'] = $_POST['account_state'];
    // echo "<script>
    // window.alert('Eita! Ocorreu algo no Servidor, tente novamente mais tarde');
    // <script>console.log('Erro Server: " . $e . "' );</script>
    // localStorage.setItem('Botao_guia', '".$_POST['account_state']."');
    // </script>";
    header('Location: ../../account.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    include '../php_db/conexao.php';

    $accout     = $_SESSION['account_state'] = $_POST['account_state'];

    $name       = $_SESSION['nome']          = $_POST['nome'];
    $email      = $_SESSION['email']         = $_POST['email'];
    $password   = $_SESSION['password']      = $_POST['password'];
    $telephone  = $_SESSION['telephone']     = $_POST['telephone'];
    $whats      = $_SESSION['whats']         = $_POST['whats'] ?? '';
    $about      = $_SESSION['about']         = $_POST['about'];

    if (!check_unique_name($accout,$name)) {
        Show_incorrect_text("Já existe um Registro com esse Nome, Insira outro");
    }

    if( !Is_phone_correct($telephone) ){
        Show_incorrect_text("O Número de Telefone é invalido, Por favor verifique");
    }

    if( !Is_whats_correct($whats) ){
        Show_incorrect_text("O Número do Whatsapp é invalido, Por favor verifique");
    }

    $telephone_to_db = Convert_phone_to_db($telephone);
    $whats_to_db     = Convert_whats_to_db($whats);
    $id = last_id($accout);

    if ($accout == 'voluntario'){

        $sql_command = "INSERT INTO $accout(nome_voluntario,email,telefone,senha,sobre,whatsapp)
        VALUES ('$name','$email','$telephone_to_db','$password','$about','$whats_to_db')";

    } else if ($accout == 'ong'){

        $sql_command = "INSERT INTO $accout(nome_ong,email,senha,sobre,telefone,whatsapp)
        VALUES ('$name','$email','$password','$about','$telephone_to_db','$whats_to_db')";
    }

    try{
        $stmt = $conn->prepare($sql_command);
        $stmt->execute();

        $_SESSION['whoLogged']  = $accout;
        $_SESSION['name']       = $name;
        $_SESSION['id']         = $id;
        $_SESSION['isLogin']    = true;

        if ($accout == 'ong'){

            header('Location: ../dashboard_ong.php');
            exit();

        } else if($accout == 'voluntario'){

            if(isset($_SESSION['tela_de_vaga'])){
                
                header('Location: '.$_SESSION['tela_de_vaga']);
            }
            header('Location: '.$_SESSION['tela_anterior']);
            exit();
        }


    }catch(PDOException $e) {

        echo "<script>
            window.alert('Ocorreu algo no Servidor, tente novamente mais tarde');
        </script>";

        header('Location: ../account.php');
        exit();
    }
}

function last_id($table){

    
    try{
        $sql = "SELECT id FROM $table ORDER BY id DESC LIMIT 1;";
        
        $result = select($sql,[]);

        return $result[0]['id'] + 1;

    }catch(PDOException $e) {

        Show_error($e);
    }
}
?>