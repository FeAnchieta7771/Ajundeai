<?php

include 'php_functs\php_db\methods.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


function Show_error($e)
{
    echo $e;
    exit();
}

function disfuncaoeretil(){

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $id_voluntario = $_GET['id_voluntario'];

        try {
        $sql = "SELECT nome_voluntario, email, telefone, whatsapp, sobre, whatsapp FROM voluntario WHERE id = ?";

        $result = select(null,$sql, [$id_voluntario]);

        } catch (PDOException $e) {
            Show_error($e);
        }
    
        echo '<div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" value= '.$result[0]['nome_voluntario'].' readonly>
        </div>
        <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" value = '.$result[0]['email'].' readonly>
        </div>
            
        <div class="form-row">
            <div class="form-group">
                <label for="telefone">Telefone:</label>
                <input type="tel" id="telefone" name="telefone" value= "'.$result[0]['telefone']. '" readonly>
            </div>
            <div class="form-group">
                <label for="whatsapp">Whatsapp:</label>
                <input type="whatsapp" id="whatsapp" name="whatsapp" value= '.$result[0]['whatsapp'].' readonly>
            </div>
        </div>
            
        <div class="form-group">
            <label for="curriculo">Currículo:</label>
            <textarea id="curriculo" name="curriculo" readonly>'.$result[0]['sobre'].' </textarea>
        </div>';


}

}

?>
