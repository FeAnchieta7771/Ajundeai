<?php
// apagar o registro da tabela registro e o id tambem, obs:
//  ao apagar o registro, devo tirar o usuario da vaga cadastrada tambêm. 

include "../php_db/methods.php";

function Show_error()
{
    $_SESSION['notification'] = 'server_error';

    header('Location: ' . $_SESSION['tela_retrasada_profile']);
    exit();
}


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

        try {

            // registro ao banco em que o usuário em questão foi negado para a vaga
            include '../php_db/conexao.php';

            $conn->beginTransaction();

            // diminuir em 1 todas as vagas cadastradas por esse usuario
            $sql = "UPDATE vaga join registro on vaga.id = registro.id_vaga SET vaga.quant_atual = vaga.quant_atual -1 WHERE registro.id_voluntario = ? AND registro.categoria_registro = 'cadastrado'";
            $result = delete($conn, $sql, [$_SESSION['id']]);

            $sql = "DELETE FROM voluntario WHERE id = ?";
            $result = delete($conn, $sql, [$_SESSION['id']]);
            
            
            $conn->commit();
        } catch (Exception $e) {

            $conn->rollBack();
            Show_error($e);
        }

        $_SESSION['notification'] = 'delete_account_sucess';
        $_SESSION['tela_anterior'] = '/index.php';
        header('Location: ../../logout.php');


?>

// UPDATE vaga join registro on vaga.id = registro.id_vaga SET vaga.quant_atual = vaga.quant_atual -1 WHERE registro.id_voluntario = $_SESSION['id'] AND registro.categoria_registro = "cadastrado";



// diminuir em 1 todas as vagas cadastradas pelo usuário
// registro
// categoria_registro = 'cadastrado'
// id_voluntario
// id_vaga
