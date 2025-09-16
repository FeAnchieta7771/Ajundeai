<?php

include 'functions.php';
include '../php_db/methods.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $id_vaga = $_GET['id_vaga'];

    if ($_GET['button_slot'] == 'save_button') {

        save_button($id_vaga);
        $_SESSION['notification'] = 'save_button';

    } else if ($_GET['button_slot'] == 'unsave_button') {

        unsave_button($id_vaga);
        $_SESSION['notification'] = 'unsave_button';

    } else if ($_GET['button_slot'] == 'send_button') {

        send_button($id_vaga);
        $_SESSION['notification'] = 'send_button';

    } else if ($_GET['button_slot'] == 'unsend_button') {

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

            $result = insert(null, $sql, [$id_vaga, $_SESSION['id'], 'salvo', 'nada']);

            if ($result) {

            } else {
                echo "Erro na inserção.";
            }

        } catch (Throwable $e) {
            Show_error();
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

        $result = delete(null, $sql, [$id_vaga, $_SESSION['id']]);

        if ($result == 0) {
            echo "Erro na inserção.";
        }

    } catch (Throwable $e) {
        Show_error();
    }

}

function send_button($id_vaga)
{

    if (is_logged()) {

        $permission = is_permited_send_limit($_SESSION['id']);

        if ($permission) {

            if (is_registry_before($id_vaga, $_SESSION['id'])) {


                // quando salvar ele cria regsitro / um insert.
                try {

                    include '../php_db/conexao.php';
                    $conn->beginTransaction();
                    // ================================================================

                    $sql = "INSERT INTO registro (id_vaga, id_voluntario, categoria_registro, situacao) 
                    VALUES (?, ?, ?, ?)";

                    $result = insert($conn, $sql, [$id_vaga, $_SESSION['id'], 'cadastrado', 'aguarde']);

                    if ($result == 0) {
                        $conn->rollBack();

                        Show_error();
                        exit();
                    }
                    // ================================================================

                    $sql = "UPDATE vaga
                    SET quant_atual = quant_atual + 1
                    WHERE id = ?";

                    $result = update($conn, $sql, [$id_vaga]);

                    if ($result == 0) {
                        $conn->rollBack();

                        Show_error();
                        exit();
                    }
                    // ================================================================

                    $sql = "UPDATE voluntario
                    SET quant_cadastro = quant_cadastro + 1
                    WHERE id = ?";

                    $result = update($conn, $sql, [$_SESSION['id']]);

                    if ($result == 0) {
                        $conn->rollBack();

                        Show_error();
                        exit();
                    }
                    // ================================================================
                    $conn->commit();

                } catch (Throwable $e) {
                    $conn->rollBack();
                    Show_error();

                }

            } else {

                // da um update no registro ja salvo e verifica se esta logado
                try {
                    include '../php_db/conexao.php';
                    $conn->beginTransaction();
                    // ================================================================

                    $sql = "UPDATE registro
                    SET categoria_registro = ?, situacao = ?
                    WHERE id_vaga = ? AND id_voluntario = ?";

                    $result = update($conn, $sql, ['cadastrado', 'aguarde', $id_vaga, $_SESSION['id']]);

                    if ($result == 0) {
                        $conn->rollBack();

                        Show_error();
                        exit();
                    }
                    // ================================================================

                    $sql = "UPDATE vaga
                    SET quant_atual = quant_atual + 1
                    WHERE id = ?";

                    $result = update($conn, $sql, [$id_vaga]);

                    if ($result == 0) {
                        $conn->rollBack();

                        Show_error();
                    }
                    // ================================================================

                    $sql = "UPDATE voluntario
                    SET quant_cadastro = quant_cadastro + 1
                    WHERE id = ?";

                    $result = update($conn, $sql, [$_SESSION['id']]);

                    if ($result == 0) {
                        $conn->rollBack();

                        Show_error();
                        exit();
                    }
                    // ================================================================
                    $conn->commit();

                } catch (Throwable $e) {
                    $conn->rollBack();
                    Show_error();
                }
            }

        } else {
            $_SESSION['notification'] = 'not_permited';
            unset($_SESSION['tela_de_vaga']);

            header('Location: ../../source.php');
            exit();
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

        include '../php_db/conexao.php';
        $conn->beginTransaction();
        // ================================================================

        $sql = "DELETE FROM registro WHERE id_vaga = ? AND id_voluntario = ?";

        $result = delete($conn, $sql, [$id_vaga, $_SESSION['id']]);

        if ($result == 0) {
            $conn->rollBack();

            Show_error();
        }
        // ================================================================

        $sql = "UPDATE vaga
        SET quant_atual = quant_atual - 1
        WHERE id = ?";

        $result = update($conn, $sql, [$id_vaga]);

        if ($result == 0) {
            $conn->rollBack();

            Show_error();
        }
        // ================================================================

        $sql = "UPDATE voluntario
        SET quant_cadastro = quant_cadastro - 1
        WHERE id = ?";

        $result = update($conn, $sql, [$_SESSION['id']]);

        if ($result == 0) {
            $conn->rollBack();

            Show_error();
            exit();
        }
        // ================================================================
        $conn->commit();

    } catch (Throwable $e) {
        $conn->rollBack();
        Show_error();
    }

}

function is_registry_before($id_vaga, $id)
{
    try {
        $sql = "SELECT COUNT(*) as 'lines' FROM registro WHERE id_vaga = ? AND id_voluntario = ?";
        $result_search = select(null, $sql, [$id_vaga, $id]);

        if ($result_search[0]['lines'] == 0) {
            return true;
        } else {
            return false;
        }

    } catch (Throwable $e) {
        Show_error();
    }
}

function is_permited_send_limit($id_vol)
{
    try {
        $sql = "SELECT quant_cadastro FROM voluntario WHERE id = ?";
        $result_search = select(null, $sql, [$id_vol]);

        if ($result_search[0]['quant_cadastro'] < 3) {
            return true;
        } else {
            return false;
        }

    } catch (Throwable $e) {
        Show_error();
    }
}
?>