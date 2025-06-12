<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    include 'conexao.php';

    $table_login = $_POST['login_state'];

    // auxílio de pesquisa ao sql e salvar nome ao sistema
    $auxiliar_name = "nome_".$table_login;

    $name_email = $_POST['email'];
    $password = $_POST['password'];

    // ! Filtros do Login
    // Busca da senha pelo nome
    // Busca da senha pelo email
    $sql = "SELECT senha,".$auxiliar_name." FROM ".$table_login." WHERE ".$table_login.".".$auxiliar_name." = '".$name_email."' OR ".$table_login.".email = '".$name_email."'";
    // Coleta o resultado
    $result = return_select($sql);

    // Procura se algum dos registros possui a senha informada
    foreach($result as $user){

        if ($user['senha'] == $password){

            $_SESSION['whoLogged'] = $table_login;
            $_SESSION['name'] = $user[$auxiliar_name];
            $_SESSION['isLogin'] = true;
            header('Location: ../index.php');
            exit();
        }
    }

    echo "<script>window.alert('Nome/Email ou Senha Incorreta');</script>";
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
        echo "<script>window.alert('Não foi capaz de realizar o Filtro, tente outra hora');</script>";
        exit();
    }
}

?>