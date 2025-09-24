<!-- inicio do código, tenho que verificar qual tipo de conta está logada, e em seguida puxar os dados dessa conta no banco 
esses dados precisam ser salvos em uma variavel -->


<?php

include "php_functs\php_db\methods.php";
include 'php_functs/php_methods/formatting.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function Show_error()
{
    $_SESSION['notification'] = 'server_error';

    header('Location: ' . $_SESSION['tela_retrasada_profile']);
    exit();
}

function account_type($is_ong)
{

    // se for verdadeiro é ong se der falso é voluntario
    if ($is_ong) {
        try {
            $sql = "SELECT * FROM ong WHERE id = ?";
            $result = select(null, $sql, [$_SESSION['id']]);

            $result[0]['telefone'] = Convert_phone_to_show($result[0]['telefone']);

            if (!empty($result[0]['whatsapp'])) {
                $result[0]['whatsapp'] = Convert_whats_to_show($result[0]['whatsapp']);
            }

            ong_profile($result);

        } catch (Exception $e) {
            Show_error($e);
        }

    } else {

        try {
            // registro ao banco em que o usuário em questão foi negado para a vaga
            include 'php_functs\php_db/conexao.php';

            $conn->beginTransaction();

            $sql = "SELECT * FROM voluntario WHERE id = ?";
            $result = select($conn, $sql, [$_SESSION['id']]);

            $result[0]['telefone'] = Convert_phone_to_show($result[0]['telefone']);
            $result[0]['cpf'] = Convert_cpf_to_show($result[0]['cpf']);

            if (!empty($result[0]['whatsapp'])) {
                $result[0]['whatsapp'] = Convert_whats_to_show($result[0]['whatsapp']);
            }

            $sql = "SELECT vaga.nome, ong.nome_ong, vaga.id FROM voluntario JOIN registro ON voluntario.id = registro.id_voluntario 
                        JOIN vaga ON registro.id_vaga = vaga.id 
                        JOIN ong ON vaga.id_ong = ong.id WHERE voluntario.id = ? AND registro.categoria_registro = 'cadastrado'";

            $result_vaga = select($conn, $sql, [$_SESSION['id']]);

            $conn->commit();

            voluntary_profile($result, $result_vaga);

        } catch (Exception $e) {

            $conn->rollBack();
            Show_error($e);
        }
    }



}

function voluntary_profile($result, $result_vaga)
{
    $numLinhas = count($result_vaga);

    echo "
    <div class='painel'>
        <!-- Perfil Voluntário -->
        <div class='perfil' id='perfilBox'>
        <div class='perfil-header'>
            <div class='left'>
            <i class='bx bxs-user' style='font-size:22px;'></i>
            <span>TIPO DA CONTA: VOLUNTÁRIO</span>
            </div>
            <form method='POST' action='php_functs/php_methods/excluir_profile.php'>
            <button class='btn-trash' title='Excluir conta'>
            <i class='bx bxs-trash'></i>
            </button>
            </form>
        </div>
        <div class='form-container'>
        <form class='form' method= 'POST' action= 'php_functs/php_screens/profile_aplication.php' id='formPerfil'>
        <div class='form-row'>
            <div class='form-group'>
                <label for='nome'>NOME:</label>
                <input type='text' id='nome' name='nome' placeholder='Nome' value='" . $result[0]["nome_voluntario"] . "' disabled>
                <input type='hidden' name= 'type_usuario' value ='voluntario'>
            </div>

            <div class='form-group'>
                <label for='cpf'>CPF:</label>
                <input type='text' id='cpf' name='cpf' placeholder='#########-##' maxlength='12' value='" . $result[0]['cpf'] . "' disabled>
            </div>
        </div>

        <div class='form-row'>
            <div class='form-group'>
                <label for='email'>E-MAIL:</label>
                <input type='email' id='email' name='email' placeholder='Email' value='" . $result[0]["email"] . "' disabled>
            </div>

            <div class='form-group'>
                <label for='password'>SENHA:</label>
                <input type='password' id='password' name='senha' placeholder='Senha' value='" . $result[0]["senha"] . "' disabled>
            </div>
        </div>

        <div class='form-row'>
            <div class='form-group'>
                <label for='telephone'>TELEFONE:</label>
                <input type='text' id='telephone' name='telephone' placeholder='Telefone' value='" . $result[0]["telefone"] . "' disabled>
            </div>

            <div class='form-group'>
                <label for='whats'>WHATSAPP:</label>
                <input type='text' id='whats' name='whats' placeholder='WhatsApp' value='" . $result[0]["whatsapp"] . "' disabled>
            </div>
        </div>

        <div class='form-row'>
            <div class='form-group'>
            <label for='cat_vol'>VAGA DE PREFERÊNCIA:</label>
            <input type='text' id='cat_vol' name='categoria' placeholder='Categoria de preferência' value='" . $result[0]["categoria_trabalho"] . "' disabled>
            </div>

            <div class='form-group'>
            <label for='periodo'>PERÍODO:</label>
            <input type='text' id='periodo' name='periodo' placeholder='Período' value='" . $result[0]["periodo"] . "' disabled>
            </div>
        </div>

        <div class='form-row'>
            <div class='form-group'>
            <label for='estado'>SITUAÇÃO:</label>
            <input type='text' id='estado' name='situacao' placeholder='Situação atual' value='" . $result[0]["estado_social"] . "' disabled>
            </div>

            <div class='form-group'>
            <label for='pcd'>DEFICIÊNCIA:</label>
            <input type='text' id='pcd' name='deficiencia' placeholder='Deficiência' value='" . $result[0]["pcd"] . "' disabled>
            </div>
        </div>

        <div class='form-row'>
            <label style='display: block; font-weight: bold; margin-bottom: 5px;' for='sobre'>SOBRE:</label>
            <textarea name='sobre' id='sobre' placeholder='Conte um pouco sobre você e suas experiências' disabled>" . $result[0]["sobre"] . "</textarea>
 
            <div class='botoes'>
            <button type='button' class='btn btn-editar' id='btnEditar'>Editar</button>
            <button type='button' class='btn btn-cancelar' id='btnCancelar' style='display:none;'>Cancelar</button>
            <button type='submit' class='btn btn-alterar' id='btnAlterar' style='display:none;'>Alterar</button>
            </div>
        </div>

        </form>
        </div>

        </div>

        <div class='vagas-box'>
            <h3>Vagas Cadastradas</h3>
            <small>" . $numLinhas . "/3 cadastros permitidos</small>
            <a class='btn-controle' href='../../register_voluntary.php'> <i class='bx bx-search-alt'></i> Ver Controle de Vagas</a>";

    if ($numLinhas > 0) {

        foreach ($result_vaga as $vaga) {
            echo "<form method='GET' action='../show_slot_voluntary.php'>
                <input type='hidden' name='type' value='filter_base'>
                <input type='hidden' name='id_vaga' value=" . $vaga['id'] . ">
                <button class='button_vaga'>
                <img src='img/icons_blue/outro.png' width='50' height='50' alt='Ícone' />
                <div class='vaga-info'>
                <h4 style='font-family: 'Horizon', sans-serif;'><a style='text-decoration: none'>" . $vaga['nome'] . "</a></h4>
                <span>" . $vaga['nome_ong'] . "
                </span></div></button></form>";
        }

        //foreach ($result_vaga as $vaga) {
        //     echo "<form method='GET' action='../show_slot_voluntary.php'>
        //         <input type='hidden' name='type' value='filter_base'>
        //         <input type='hidden' name='id_vaga' value=" . $vaga['id'] . ">
        //         <button><div class='vaga-item'><span>" . $vaga['nome'] . "</span><span>" . $vaga['nome_ong'] . "</span></div></button></form>";
        // }
    }

    echo "
    </div>
    </div>
    ";

}

function ong_profile($result)
{

    echo "    
    <div class='painel'>
        <div class='perfil' id='perfilBox'>
            <div class='perfil-header'>
                <div class='left'>

                <i class='bx bxs-buildings' style='font-size:22px;'></i>
                <span>TIPO DA CONTA: ONG</span>

                </div>
            </div>

            <form method= 'POST' class='form' action= 'php_functs/php_screens/profile_aplication.php'id='formPerfil'>
                <div class='form-row'>
                    <div class='form-group' style='grid-column: span 2;'>
                        <label for='nome'>NOME:</label>
                        <input type='text' id='nome' name='nome' placeholder='Nome' value='" . $result[0]["nome_ong"] . "' disabled>
                        <input type='hidden' name= 'type_usuario' value ='ong'>
                    </div>
                </div>

                <div class='form-row'>
                    <div class='form-group'>
                        <label for='email'>E-MAIL:</label>
                        <input type='email' id='email' name='email' placeholder='Email' value='" . $result[0]["email"] . "' disabled>
                    </div>

                    <div class='form-group'>
                        <label for='password'>SENHA:</label>
                        <input type='password' id='password' name='senha' placeholder='Senha' value='" . $result[0]["senha"] . "' disabled>
                    </div>
                </div>

                <div class='form-row'>
                    <div class='form-group'>
                        <label for='telephone'>TELEFONE:</label>
                        <input type='text' id='telephone' name='telephone' placeholder='Telefone' value='" . $result[0]["telefone"] . "' disabled>
                    </div>

                    <div class='form-group'>
                        <label for='whats'>WHATSAPP:</label>
                        <input type='text' id='whats' name='whats' placeholder='WhatsApp' value='" . $result[0]["whatsapp"] . "' disabled>
                    </div>
                </div>

                <div class='form-row'>
                    <label style='display: block; font-weight: bold; margin-bottom: 5px;' for='sobre'>SOBRE:</label>
                    <textarea name='sobre' id='sobre' placeholder='Conte um pouco sobre você e suas experiências' disabled>" . $result[0]["sobre"] . "</textarea>
        
                    <div class='botoes'>
                    <button type='button' class='btn btn-editar' id='btnEditar'>Editar</button>
                    <button type='button' class='btn btn-cancelar' id='btnCancelar' style='display:none;'>Cancelar</button>
                    <button type='submit' class='btn btn-alterar' id='btnAlterar' style='display:none;'>Alterar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
";

}

?>