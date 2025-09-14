<?php

include 'php_functs\php_db\methods.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


function Show_error()
{
    $_SESSION['notification'] = 'server_error';

    header('Location: '.$_SESSION['tela_retrasada']);
    exit();
}

function disfuncaoeretil($id_voluntario)
{

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {

        try {
            $sql = "SELECT * FROM voluntario WHERE id = ?";

            $result = select(null, $sql, [$id_voluntario]);

        } catch (Throwable $e) {
            Show_error();
        }

        $_SESSION['email_vol'] = $result[0]['email'];
        $_SESSION['nome_vol'] = $result[0]['nome_voluntario'];

        include 'php_functs/php_methods/formatting.php';

        $phone_for_show = Convert_phone_to_show($result[0]['telefone']);
        $cpf_for_show = Convert_cpf_to_show($result[0]['cpf']);

        if(!empty($result[0]['whatsapp'])){
            $whats_for_show = Convert_whats_to_show($result[0]['whatsapp']);
        }


        echo '        <div class="fh1">
           <div class="color_name"><i class="bx  bxs-user"  ></i> VOLUNTARIO <strong>' . strtoupper($result[0]['nome_voluntario']) . '</strong></div>
        </div>
        
        <div id="container">
          

          </div>

            <div class="tab-contents">

                <div class="content show" id="home">
                <div class="form-container">
                        <input type="hidden" name="account_state" value="voluntario">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="name">NOME:</label>
                                <input type="text" id="name" name="nome" value="' . $result[0]['nome_voluntario'] . '" readonly>
                            </div>
                        </div>
                
                        <div class="form-row-3">
                                <div class="form-group">
                                    <label for="email">E-MAIL:</label>
                                    <input type="email" id="email" name="email" value = "' . $result[0]['email'] . '" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="email">CPF:</label>
                                    <input type="text" id="email" name="email" value = "' . $cpf_for_show . '" readonly>
                                </div>
                        </div>

                        <div class="form-row-3">
                                <div class="form-group">
                                    <label for="password">TELEFONE:</label>
                                    <input type="localiza" id="localiza" name="localiza" value= "' . $phone_for_show . '" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="email">WHATSAPP:</label>
                                    <input type="text" id="email" name="email" value = "' . $whats_for_show . '" readonly>
                                </div>
                        </div>

                        <div class="form-row-3">
                                <div class="form-group">
                                    <label for="password">PREFERÊNCIA DE VAGA:</label>
                                    <input type="localiza" id="localiza" name="localiza" value= "' . $result[0]['categoria_trabalho'] . '" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="email">PERÍODO DE PARTICIPAÇÃO:</label>
                                    <input type="text" id="email" name="email" value = ' . $result[0]['periodo'] . ' readonly>
                                </div>
                        </div>

                        <div class="form-row-3">
                                <div class="form-group">
                                    <label for="password">SITUAÇÃO ATUAL:</label>
                                    <input type="localiza" id="localiza" name="localiza" value= "' . $result[0]['estado_social'] . '" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="email">DEFICIÊNCIA:</label>
                                    <input type="text" id="email" name="email" value = ' . $result[0]['pcd'] . ' readonly>
                                </div>
                        </div>
            
                            <div class="bio-container">
                                <p id="bio-label">CURRICULO:</p>
                                <textarea maxlength="1000" rows="5" cols="120" name="about" readonly>' . $result[0]['sobre'] . '</textarea>
                            </div>
                </div>';


    }

}

?>