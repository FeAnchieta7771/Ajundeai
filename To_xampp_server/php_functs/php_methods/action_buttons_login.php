<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $method = $_POST['button_header'];
    $_SESSION['nothing_else'] = true;

    switch($method){
        case 'volu_painel':
            header('Location: ../../register_voluntary.php');
            break;
        
        case 'volu_vaga':
            header('Location: ../../filter.php');
            break;
        
        case 'ong_painel':
            header('Location: ../../dashboard_ong.php');
            break;

        case 'ong_vaga':
            header('Location: ../../create_slot_ong.php');
            break;

        case 'out':
            header('Location: ../../logout.php');
            break;
        
    }

}
?>