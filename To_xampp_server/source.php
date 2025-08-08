<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    
    if (isset($_SESSION['tela_de_vaga'])) {
        
        $tela_vaga = $_SESSION['tela_de_vaga'] ?? '/index.php';
        header('Location: ' . $tela_vaga);

    } else {
        $tela = $_SESSION['tela_anterior'] ?? '/index.php';
        header('Location: ' . $tela);
    }

?>