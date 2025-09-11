<!-- inicio do código, tenho que verificar qual tipo de conta está logada, e em seguida puxar os dados dessa conta no banco 
esses dados precisam ser salvos em uma variavel -->

<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


function account_type($is_ong){
    // se for verdadeiro é ong se der falso é voluntario
    if ($is_ong){
        try{
            $sql = "SELECT * FROM ong WHERE id = ?";
            $result = select(null,$sql, [$_SESSION['id']]);

        }
        catch (Exception $e) {
        Show_error($e);
    }
       
    } else {
        try{
            $sql = "SELECT * FROM voluntario WHERE id = ?";
            $result = select(null,$sql, [$_SESSION['id']]);
        }
        catch (Exception $e) {
        Show_error($e);
        }
    }



}

function voluntary_profile($result){

    echo "
    <div class='painel'>
        <!-- Perfil Voluntário -->
        <div class='perfil' id='perfilBox'>
        <div class='perfil-header'>
            <div class='left'>
            <i class='bx bxs-user' style='font-size:22px;'></i>
            <span>TIPO DA CONTA: VOLUNTÁRIO</span>
            </div>
            <button class='btn-trash' title='Excluir conta'>
            <i class='bx bxs-trash'></i>
            </button>
        </div>
        <form method= 'POST' action= 'php_functs/php_screens/profile_aplication.php' id='formPerfil'>
            <input type='text' name='nome' placeholder='Nome' value='".$result[0]["nome_voluntario"]."' disabled>
            <input type='hidden' name= 'type_usuario' value ='voluntario'>
            <input type='text' name='cpf' placeholder='CPF' value='".$result[0]["cpf"]."' disabled>
            <input type='email' name='email' placeholder='Email' value='".$result[0]["email"]."' disabled>
            <input type='password' name='senha' placeholder='Senha' value='".$result[0]["senha"]."' disabled>
            <input type='text' name='telefone' placeholder='Telefone' value='".$result[0]["telefone"]."' disabled>
            <input type='text' name='whatsapp' placeholder='WhatsApp' value='".$result[0]["whatsapp"]."' disabled>
            <input type='text' name='categoria' placeholder='Categoria de preferência' value='".$result[0]["categoria_trabalho"]."' disabled>
            <input type='text' name='periodo' placeholder='Período' value='".$result[0]["periodo"]."' disabled>
            <input type='text' name='situacao' placeholder='Situação atual' value='".$result[0]["estado_social"]."' disabled>
            <input type='text' name='deficiencia' placeholder='Deficiência' value='".$result[0]["pcd"]."' disabled>
            <textarea name='sobre' placeholder='Conte um pouco sobre você e suas experiências' value='".$result[0]["sobre"]."' disabled></textarea>

            <div class='botoes'>
            <button type='button' class='btn btn-editar' id='btnEditar'>Editar</button>
            <button type='button' class='btn btn-cancelar' id='btnCancelar' style='display:none;'>Cancelar</button>
            <button type='submit' class='btn btn-alterar' id='btnAlterar' style='display:none;'>Alterar</button>
            </div>
        </form>
        </div>
    </div>
    ";

}

function ong_profile($result){

    echo "    
    <div class='perfil' id='perfilBox'>

    <div class='perfil-header'>

        <div class='left'>

        <i class='bx bxs-buildings' style='font-size:22px;'></i>

        <span>TIPO DA CONTA: ONG</span>

        </div>

    </div>

    <form method= 'POST' action= 'php_functs/php_screens/user_profile.php'id=' formPerfil'>

        <input type='text' name='nome' placeholder='Nome' class='input-nome' value='".$result[0]["nome_ong"]."' disabled>

        <input type='hidden' name= 'type_usuario' value ='ong'>

        <input type='email' name='email' placeholder='Email' value='".$result[0]["email"]."' disabled>

        <input type='password' name='senha' placeholder='Senha' value='".$result[0]["senha"]."' disabled>

        <input type='text' name='telefone' placeholder='Telefone' value='".$result[0]["telefone"]."' disabled>

        <input type='text' name='whatsapp' placeholder='WhatsApp' value='".$result[0]["whatsapp"]."' disabled>

        <textarea name='sobre' placeholder='Conte um pouco mais sobre a ONG/Instituição' value='".$result[0]["sobre"]."' disabled></textarea>


        <div class='botoes'>

        <button type='button' class='btn btn-editar' id='btnEditar'>Editar</button>

        <button type='button' class='btn btn-cancelar' id='btnCancelar' style='display:none;'>Cancelar</button>

        <button type='submit' class='btn btn-alterar' id='btnAlterar' style='display:none;'>Alterar</button>

        </div>

    </form>

    </div>

    </div>
";

}

?>