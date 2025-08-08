<?php

include 'functions.php';
include '../php_db/methods.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id_vaga = $_POST['id_vaga'];

    if ($_POST['button_slot'] == 'save_button') {

        save_button($id_vaga);
        $_SESSION['notification'] = 'save_button';

    } else if ($_POST['button_slot'] == 'unsave_button') {

        unsave_button($id_vaga);
        $_SESSION['notification'] = 'unsave_button';

    } else if ($_POST['button_slot'] == 'send_button') {

        send_button($id_vaga);
        $_SESSION['notification'] = 'send_button';

    } else if ($_POST['button_slot'] == 'unsend_button') {

        unsend_button($id_vaga);
        $_SESSION['notification'] = 'unsend_button';
    }

    unset($_SESSION['tela_de_vaga']);

    header('Location: ../../source.php');
    exit();

}

function Show_error($e)
{
    $_SESSION['erro'] = $e;
    $_SESSION['notification'] = 'server_error';

    header('Location: ../../show_slot_voluntary.php');
    exit();
}

function save_button($id_vaga)
{

    if (is_logged()) {
        // quando salvar ele cria regsitro / um insert.
        try {
            $sql = "INSERT INTO registro (id_vaga, id_voluntario, categoria_registro, situacao) 
             VALUES (?, ?, ?, ?)";

            $result = insert($sql, [$id_vaga, $_SESSION['id'], 'salvo', 'nada']);

            if ($result) {

            } else {
                echo "Erro na inserção.";
            }

        } catch (PDOException $e) {
            Show_error($e);
        }

    } else {
        header("Location: ../../login.php");
        exit();
    }
}

function unsave_button($id_vaga)
{
    //usar delete para retirar da tabela utilizando where para procurar pelo id_vaga e id_voluntario
    try {
        $sql = "DELETE FROM registro WHERE id_vaga = ? AND id_voluntario = ?";

        $result = delete($sql, [$id_vaga, $_SESSION['id']]);

        if ($result == 0) {
            echo "Erro na inserção.";
        }

    } catch (PDOException $e) {
        Show_error($e);
    }

}

function send_button($id_vaga)
{

    if (is_logged()) {

        if (is_registry_before($id_vaga, $_SESSION['id'])) {

            // quando salvar ele cria regsitro / um insert.
            try {
                $sql = "INSERT INTO registro (id_vaga, id_voluntario, categoria_registro, situacao) 
                VALUES (?, ?, ?, ?)";

                $result = insert($sql, [$id_vaga, $_SESSION['id'], 'cadastrado', 'aguarde']);

                if ($result == 0) {
                    Show_error('');
                    exit();
                }

                $sql = "UPDATE vaga
                SET quant_atual = quant_atual + 1
                WHERE id = ?";

                $result = update($sql, [$id_vaga]);

                if ($result == 0) {
                    Show_error('');
                    exit();
                }

            } catch (PDOException $e) {

                Show_error($e);

            }

        } else {
            // da um update no registro ja salvo e verifica se esta logado
            try {
                $sql = "UPDATE registro
                SET categoria_registro = ?, situacao = ?
                WHERE id_vaga = ? AND id_voluntario = ?";

                $result = update($sql, ['cadastrado', 'aguarde', $id_vaga, $_SESSION['id']]);

                if ($result == 0) {
                    Show_error('');
                    exit();
                }

                $sql = "UPDATE vaga
                SET quant_atual = quant_atual + 1
                WHERE id = ?";

                $result = update($sql, [$id_vaga]);

                if ($result == 0) {
                    Show_error('');
                }

            } catch (PDOException $e) {
                Show_error($e);
            }
        }

    } else {
        header("Location: ../../login.php");
        exit();
    }

}

function unsend_button($id_vaga)
{
    //usar delete para retirar da tabela utilizando where para procurar pelo id_vaga e id_voluntario
    try {
        $sql = "DELETE FROM registro WHERE id_vaga = ? AND id_voluntario = ?";

        $result = delete($sql, [$id_vaga, $_SESSION['id']]);

        if ($result == 0) {
            Show_error('');
        }

        $sql = "UPDATE vaga
        SET quant_atual = quant_atual - 1
        WHERE id = ?";

        $result = update($sql, [$id_vaga]);

        if ($result == 0) {
            Show_error('');
        } 

    } catch (PDOException $e) {
        Show_error($e);
    }

}

function is_registry_before($id_vaga, $id)
{
    try {
        $sql = "SELECT COUNT(*) as 'lines' FROM registro WHERE id_vaga = ? AND id_voluntario = ?";
        $result_search = select($sql, [$id_vaga, $id]);

        if ($result_search[0]['lines'] == 0) {
            return true;
        } else {
            return false;
        }

    } catch (PDOException $e) {
        Show_error($e);
    }
}
?>