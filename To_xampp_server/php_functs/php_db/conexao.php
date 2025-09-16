<?php


include 'C:/xampp/htdocs/db/db_params/server/server.php';
include 'C:/xampp/htdocs/db/db_params/database/database.php';
include 'C:/xampp/htdocs/db/db_params/user/user.php';
include 'C:/xampp/htdocs/db/db_params/password/password.php';

$host = $server;
$dbname = $database_name;
$user = $user_acess;
$password_db = $password_to_acess;

try{
    // ========================================
    // TESTE PARA XAMPP DA PORTA 3307
    // $port = '3307';
    // $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname",$user,$password);
    // ========================================
    $conn = new PDO("mysql:host=$host;dbname=$dbname",$user,$password_db);

} catch (Throwable $e){
        // Escapa a mensagem para não quebrar o JS
        $errorMsg = addslashes($e->getMessage());

        echo "<script>
            console.log('Erro Server: $errorMsg');
        </script>";
        
        header('Location: ../../error.php');
        exit();
}
?>
