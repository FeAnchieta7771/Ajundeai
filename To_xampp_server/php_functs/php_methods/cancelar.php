<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    header('Location: ../../source.php');
    exit();
}

?>