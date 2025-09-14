<?php

include '../php_db/methods.php';
include '../php_methods/send_email.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


function Show_error()
{
    $_SESSION['notification'] = 'server_error';

    header('Location: '.$_SESSION['tela_anterior']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $action_analysis    = $_POST['action_analysis'];
    $id_vaga            = $_POST['id_vaga'];
    $id_voluntario      = $_POST['id_voluntario'];
    $name_slot          = $_POST['name_slot'];
    $name_vol           = $_POST['name_vol'];

    if ($action_analysis == 'approve'){
        aproved($id_vaga,$id_voluntario,$name_slot,$name_vol);
        
    } else if ($action_analysis == 'disapprove'){
        
        disapprove($id_vaga,$id_voluntario,$name_slot,$name_vol);
    }

    header('Location: ../../source.php');
    exit();


}

function disapprove($id_vaga,$id_voluntario,$name_slot,$name_vol){
    
    try {
        // registro ao banco em que o usuário em questão foi negado para a vaga
        include '../php_db/conexao.php';

        $conn->beginTransaction();

        $sql = "UPDATE registro SET situacao = ? WHERE id_vaga = ? AND id_voluntario = ?";
        $result = update($conn,$sql, ['negado',$id_vaga, $id_voluntario]);

        // =========================================================================================

        // adicionar uma nova oportunidade ao um novo voluntário para preencher a vaga negada
        $sql = "UPDATE vaga SET quant_atual = quant_atual - 1 WHERE id = ?";
        $result = update($conn,$sql, [$id_vaga]);

        // =========================================================================================

        $sql = "UPDATE voluntario SET quant_cadastro = quant_cadastro - 1 WHERE id = ?";
        $result = update($conn,$sql, [$id_voluntario]);

        $conn->commit();

        $result_email = setEmail('disapprove',$name_slot,$name_vol, $_POST['email_ong'], $_POST['email_vol']);

        if($result_email){
            $_SESSION['notification'] = 'protocolWithSucess_emailSend';
        } else {
            $_SESSION['notification'] = 'protocolWithSucess_emailNotSend';
        }

    } catch (Throwable $e) {
        
        $conn->rollBack();
        Show_error();
    }
}

function aproved($id_vaga, $id_voluntario, $name_slot,$name_vol){

     try {
        $sql = "UPDATE registro SET situacao = ? WHERE id_vaga = ? AND id_voluntario = ?";
        $result = update(null,$sql, ['aprovado',$id_vaga, $id_voluntario]);

        $result_email = setEmail('aprroved',$name_slot,$name_vol, $_SESSION['email_login'], $_POST['email_vol']);

        if($result_email){
            $_SESSION['notification'] = 'protocolWithSucess_emailSend';
        } else {
            $_SESSION['notification'] = 'protocolWithSucess_emailNotSend';
        }


    } catch (Throwable $e) {
        Show_error();
    }
    
}
?>