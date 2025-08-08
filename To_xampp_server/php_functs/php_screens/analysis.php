<?php

include '../php_db/methods.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


function Show_error($e)
{
    $_SESSION['erro'] = $e;
    $_SESSION['account_state'] = $_POST['account_state'];
    $_SESSION['notification'] = 'server_error';

    header('Location: ../../analysis_voluntary_ong.php');
    exit();
}

function Show_incorrect_text($text, $type_notfication)
{
    $_SESSION['message'] = $text;
    $_SESSION['account_state'] = $_POST['account_state'];
    $_SESSION['notification'] = $type_notfication;

    header('Location: ../../analysis_voluntary_ong.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $action_analysis    = $_POST['action_analysis'];
    $id_vaga            = $_POST['id_vaga'];
    $id_voluntario      = $_POST['id_voluntario'];

    if ($action_analysis == 'approve'){
        aproved($id_vaga,$id_voluntario);
        
    } else if ($action_analysis == 'disapprove'){
        
        disapprove($id_vaga,$id_voluntario);
    }

    header('Location: ../../source.php');
    exit();


}

function disapprove($id_vaga,$id_voluntario){
    
    // registro ao banco em que o usuário em questão foi negado para a vaga
    try {
        $sql = "UPDATE registro SET situacao = ? WHERE id_vaga = ? AND id_voluntario = ?";
        $result = update($sql, ['negado',$id_vaga, $id_voluntario]);

    } catch (PDOException $e) {
        Show_incorrect_text($e);
    }

    // adicionar uma nova oportunidade ao um novo voluntário para preencher a vaga negada
    try {
        $sql = "UPDATE vaga SET quant_atual = quant_atual - 1 WHERE id = ?";
        $result = update($sql, [$id_vaga]);

    } catch (PDOException $e) {
        Show_incorrect_text($e);
    }
}

function aproved($id_vaga, $id_voluntario){

     try {
        $sql = "UPDATE registro SET situacao = ? WHERE id_vaga = ? AND id_voluntario = ?";
        $result = update($sql, ['aprovado',$id_vaga, $id_voluntario]);

    } catch (PDOException $e) {
        Show_incorrect_text("Norberto é uma gostosa e o william tbm",$e);
    }
    
}