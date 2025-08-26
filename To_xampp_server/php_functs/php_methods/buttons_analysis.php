<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function Show_incorrect_text($text, $e)
{
    echo $text;
    echo "<script>console.log($e)</script>";
    exit();
}

function get_buttons()
{
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {

        $id_vaga = $_GET['id_vaga'];
        $id_voluntario = $_GET['id_voluntario'];

        try {
            $sql = "SELECT situacao FROM registro WHERE id_vaga = ? AND id_voluntario = ?";
            $result = select(null, $sql, [$id_vaga, $id_voluntario]);

        } catch (PDOException $e) {
            Show_incorrect_text("Algo deu Errado no Servidor, tente novamente mais tarde", $e);
        }

        switch ($result[0]['situacao']) {

            case 'aguarde':
                echo '<div class="button-group">
                    <form action="php_functs\php_screens\analysis.php" method="POST">

                        <input type="hidden" name="action_analysis" value="approve">
                        <input type="hidden" name="id_voluntario" value="' . $id_voluntario . '">
                        <input type="hidden" name="id_vaga" value="' . $id_vaga . '"/>
                        <button class="btapro" id="btcan_vol" type="cancel">APROVAR</button>
                    </form>

                    <form action="php_functs\php_screens\analysis.php" method="POST">

                        <input type="hidden" name="action_analysis" value="disapprove">
                        <input type="hidden" name="id_voluntario" value="' . $id_voluntario . '">
                        <input type="hidden" name="id_vaga" value="' . $id_vaga . '"/>
                        <button class="btcan" id="btcan_vol" type="cancel">DESAPROVAR</button>
                    </form>
                </div>';
                break;

            case 'aprovado':
                echo '<div class="status-container">
                    <img src="status_logo.png" alt="Status Logo" class="status-logo">
                    <span class="status-text">Aprovado</span>
                </div>';
                break;

            case 'negado':
                echo '<div class="status-container">
                    <img src="status_logo.png" alt="Status Logo" class="status-logo">
                    <span class="status-text">Desaprovado</span>
                </div>';
                break;

            default:
                Show_incorrect_text("Algo de Errado ocorreu nesse Voluntário, tente outros", "");
                break;

        }

    }
}

?>