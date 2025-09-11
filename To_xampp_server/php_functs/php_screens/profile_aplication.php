<?php

include "php_functs\php_db\methods.php";

$usuario = $_POST['type_usuario'];
    try{
        
    if($usuario == "voluntario"){

        $name       = $_POST['nome'];
        $ema        = $_POST['email'];
        $password   = $_POST['password'];
        $telephone  = $_POST['telephone'];
        $whats      = $_POST['whats'] ?? '';
        $about      = $_POST['about'];
    
        $cpf        = $_POST['cpf'] ?? '';
        $cat_vol    = $_POST['cat_vol'] ?? '';
        $periodo    = $_POST['periodo'] ?? '';
        $estado     = $_POST['estado'] ?? '';
        $pcd        = $_POST['pcd'] ?? '';
    
        
        if (!check_unique_name($accout, $name)) {
            Show_incorrect_text("Já existe um Registro com esse Nome, Insira outro", 'name_repated_error');
        }

        if ($accout == 'voluntario' && !Is_cpf_correct($cpf)) {
            Show_incorrect_text("O Número de CPF é invalido, Por favor verifique", 'cpf_error');
        }

        if (!Is_phone_correct($telephone)) {
            Show_incorrect_text("O Número de Telefone é invalido, Por favor verifique", 'phone_error');
        }

        if (!strlen($whats) == 0 && !Is_whats_correct($whats)) {
            Show_incorrect_text("O Número do Whatsapp é invalido, Por favor verifique", 'whatsapp_error');
        }

        $telephone_to_db = Convert_phone_to_db($telephone);
        $whats_to_db = Convert_whats_to_db($whats);
        $cpf_to_db = Convert_cpf_to_db($cpf);

        $sql = "UPDATE voluntario SET nome_voluntario= ?, email= ?, senha= ?, telefone= ?, whatsapp=?, categoria_trabalho, periodo= ?, cpf= ?, pcd= ?, estado_social= ?, sobre ? WHERE id= ?";

        update(null,$sql_command,[$name,$email,$password,$telephone_to_db,$whats_to_db,$cat_vol,$periodo,$cpf_to_db,$pcd,$estado,$about, $_SESSION['id']]);

    }

    else{

        
        if (!Is_phone_correct($telephone)) {
            Show_incorrect_text("O Número de Telefone é invalido, Por favor verifique", 'phone_error');
        }

        if (!strlen($whats) == 0 && !Is_whats_correct($whats)) {
            Show_incorrect_text("O Número do Whatsapp é invalido, Por favor verifique", 'whatsapp_error');
        }

        $telephone_to_db = Convert_phone_to_db($telephone);
        $whats_to_db = Convert_whats_to_db($whats);
        
        $sql = "UPDATE ong SET nome_ong= ?, email= ?, senha= ?, sobre= ?, telefone= ?, whatsapp= ? WHERE id= ?";

        update(null,$sql_command,[$name,$email,$password,$about,$telephone_to_db,$whats_to_db, $_SESSION['id']]);

        }

    }
    catch (Exception $e) {

        Show_error($e);

    }
?>