<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function Show_incorrect_text($text, $e)
{
    $_SESSION['erro'] = $e;
    $_SESSION['notification'] = 'server_error';

    header('Location: '.$_SESSION['tela_retrasada']);
    exit();
}

function get_buttons($name_slot)
{
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {

        $id_vaga = $_GET['id_vaga'];
        $id_voluntario = $_GET['id_voluntario'];

        try {
            include 'php_functs/php_db/conexao.php';
            $conn->beginTransaction();

            $sql = "SELECT situacao FROM registro WHERE id_vaga = ? AND id_voluntario = ?";
            $result = select($conn, $sql, [$id_vaga, $id_voluntario]);

            $sql = "SELECT email FROM ong WHERE id = ?";
            $email_ong = select($conn,$sql,[$_SESSION['id']]);

            $conn->commit();

        } catch (Exception $e) {
            $conn->rollBack();
            Show_incorrect_text("Algo deu Errado no Servidor, tente novamente mais tarde", $e);
        }

        switch ($result[0]['situacao']) {

            case 'aguarde':
                echo '<div class="button-group">
                    <form style="width: 100%" action="php_functs\php_screens\analysis.php" method="POST">

                        <input type="hidden" name="action_analysis" value="approve">
                        <input type="hidden" name="id_voluntario" value="' . $id_voluntario . '">
                        <input type="hidden" name="email_ong" value="' . $email_ong[0]['email'] . '">
                        <input type="hidden" name="email_vol" value="' . $_SESSION['email_vol'] . '">
                        <input type="hidden" name="name_slot" value="' . $name_slot . '">
                        <input type="hidden" name="name_vol" value="' . $_SESSION['nome_vol'] . '">
                        <input type="hidden" name="id_vaga" value="' . $id_vaga . '"/>
                        <button class="btapro" id="btcan_vol" type="cancel">APROVAR</button>
                    </form>

                    <form style="width: 100%" action="php_functs\php_screens\analysis.php" method="POST">

                        <input type="hidden" name="action_analysis" value="disapprove">
                        <input type="hidden" name="id_voluntario" value="' . $id_voluntario . '">
                        <input type="hidden" name="email_ong" value="' . $email_ong[0]['email'] . '">
                        <input type="hidden" name="email_vol" value="' . $_SESSION['email_vol'] . '">
                        <input type="hidden" name="name_slot" value="' . $name_slot . '">
                        <input type="hidden" name="name_vol" value="' . $_SESSION['nome_vol'] . '">
                        <input type="hidden" name="id_vaga" value="' . $id_vaga . '"/>
                        <button class="btcan" id="btcan_vol" type="cancel">DESAPROVAR</button>
                    </form>
                </div>';
                break;

            case 'aprovado':
                echo '<div class="status-container">
                    <img src="img/approved.png" alt="Status Logo" class="status-logo">
                    <span class="status-text">Aprovado</span>
                </div>';
                break;

            case 'negado':
                echo '<div class="status-container">
                    <img src="img/denied.png" alt="Status Logo" class="status-logo">
                    <span class="status-text">Desaprovado</span>
                </div>';
                break;

            default:
                Show_incorrect_text("Algo de Errado ocorreu nesse Voluntário, tente outros", "");
                break;

        }

        unset($_SESSION['email_vol'],$_SESSION['nome_vol']);

    }
}

?>