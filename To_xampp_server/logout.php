<?php

session_start();
session_unset(); // Remove todas as variáveis da sessão
session_destroy(); // Destrói a sessão
session_start();
// salva a url atual de telas dinâmicas
$_SESSION['tela_anterior'] = '/index.php';
header('Location: login.php');
exit();
?>