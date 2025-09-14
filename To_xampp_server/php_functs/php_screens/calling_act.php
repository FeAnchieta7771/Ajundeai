<?php
include '../php_db/methods.php';
include '../php_methods/send_email.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $result_email = setEmail('calling', $_GET['name_slot'], $_SESSION['nome_vol'], $_SESSION['email_login'], $_SESSION['email_vol']);

    if ($result_email) {
        $_SESSION['notification'] = 'callEmailSend';
        header('Location: ' . $_SESSION['looking_voluntary']);
        exit();

    } else {
        $_SESSION['notification'] = 'callEmailNotSend';
        header('Location: ../../source.php');
        exit();
    }


}
?>