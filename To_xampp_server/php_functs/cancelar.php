<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    header('Location: '.$_SESSION['tela_anterior']);
    exit();
}

?>