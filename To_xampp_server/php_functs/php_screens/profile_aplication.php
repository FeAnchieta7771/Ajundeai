<?php

include "../php_db/methods.php";
include '../php_methods/formatting.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function Show_error($result)
{
    $_SESSION['notification'] = 'server_error';
    header('Location: '.$_SESSION['tela_anterior']);
    exit();
    // header('Location: ../../login.php');
}

function check_unique_name($table, $name)
{
    try {
        $sql = "SELECT COUNT(*) as 'lines' FROM $table WHERE nome_$table = ? AND id != ?";
        $result = select(null, $sql, [$name, $_SESSION['id']]);

        if ($result[0]['lines'] > 0) {
            return false;
        } else {
            return true;
        }
    } catch (Throwable $e) {
        Show_error();
    }
}

function Show_incorrect_text($type_notfication)
{
    $_SESSION['notification'] = $type_notfication;

    header('Location: '.$_SESSION['tela_anterior']);
    exit();
}

$usuario = $_POST['type_usuario'];
try {

    $name = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $telephone = $_POST['telephone'];
    $whats = $_POST['whats'] ?? '';
    $about = $_POST['sobre'];

    $cpf = $_POST['cpf'] ?? '';
    $cat_vol = $_POST['categoria'] ?? '';
    $periodo = $_POST['periodo'] ?? '';
    $estado = $_POST['situacao'] ?? '';
    $pcd = $_POST['deficiencia'] ?? '';

    if ($usuario == "voluntario") {

        $cpf = Convert_cpf_to_db($cpf);

        if (!check_unique_name($usuario, $name)) {
            Show_incorrect_text('name_repated_error');
        }

        if ($usuario == 'voluntario' && !Is_cpf_correct($cpf)) {
            Show_incorrect_text('cpf_error');
        }

        if (!Is_phone_correct($telephone)) {
            Show_incorrect_text('phone_error');
        }

        if (!strlen($whats) == 0 && !Is_whats_correct($whats)) {
            Show_incorrect_text('whatsapp_error');
        }

        $whats = Convert_whats_to_db($whats);
        $telephone = Convert_phone_to_db($telephone);

        $sql = "UPDATE voluntario SET nome_voluntario= ?, email= ?, senha= ?, telefone= ?, whatsapp=?, categoria_trabalho = ?, periodo= ?, cpf= ?, pcd= ?, estado_social= ?, sobre = ? WHERE id= ?";
        $result = update(null, $sql, [$name, $email, $senha, $telephone, $whats, $cat_vol, $periodo, $cpf, $pcd, $estado, $about, $_SESSION['id']]);

    } else {


        if (!Is_phone_correct($telephone)) {
            Show_incorrect_text('phone_error');
        }

        if (!strlen($whats) == 0 && !Is_whats_correct($whats)) {
            Show_incorrect_text('whatsapp_error');
        }

        $telephone_to_db = Convert_phone_to_db($telephone);
        $whats_to_db = Convert_whats_to_db($whats);

        $sql = "UPDATE ong SET nome_ong= ?, email= ?, senha= ?, sobre= ?, telefone= ?, whatsapp= ? WHERE id= ?";

        $result = update(null, $sql, [$name, $email, $senha, $about, $telephone_to_db, $whats_to_db, $_SESSION['id']]);

    }

    $_SESSION['name'] = $name;
    $_SESSION['email_login'] = $email;

} catch (Throwable $e) {
    Show_incorrect_text('profile_error');
    // Show_error($result);

}

$_SESSION['notification'] = 'profile_sucess';
    header('Location: '.$_SESSION['tela_anterior']);
?>