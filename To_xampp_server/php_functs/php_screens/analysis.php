<?php

include '../php_db/methods.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../PHPMailer/src/Exception.php';
require '../../PHPMailer/src/PHPMailer.php';
require '../../PHPMailer/src/SMTP.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


function Show_error($e)
{
    $_SESSION['erro'] = $e;
    $_SESSION['notification'] = 'server_error';

    header('Location: '.$_SESSION['tela_anterior']);
    exit();
}

function Show_incorrect_text($text, $type_notfication)
{
    $_SESSION['message'] = $text;
    $_SESSION['notification'] = $type_notfication;

    header('Location: '.$_SESSION['tela_anterior']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $action_analysis    = $_POST['action_analysis'];
    $id_vaga            = $_POST['id_vaga'];
    $id_voluntario      = $_POST['id_voluntario'];
    $name_slot          = $_POST['name_slot'];
    $name_vol           = $_POST['name_vol'];

    if ($action_analysis == 'approve'){
        aproved($id_vaga,$id_voluntario,$name_slot,$name_vol);
        
    } else if ($action_analysis == 'disapprove'){
        
        disapprove($id_vaga,$id_voluntario,$name_slot,$name_vol);
    }

    header('Location: ../../source.php');
    exit();


}

function disapprove($id_vaga,$id_voluntario,$name_slot,$name_vol){
    
    try {
        // registro ao banco em que o usuário em questão foi negado para a vaga
        include '../php_db/conexao.php';

        $conn->beginTransaction();

        $sql = "UPDATE registro SET situacao = ? WHERE id_vaga = ? AND id_voluntario = ?";
        $result = update($conn,$sql, ['negado',$id_vaga, $id_voluntario]);

        // =========================================================================================

        // adicionar uma nova oportunidade ao um novo voluntário para preencher a vaga negada
        $sql = "UPDATE vaga SET quant_atual = quant_atual - 1 WHERE id = ?";
        $result = update($conn,$sql, [$id_vaga]);

        // =========================================================================================

        $sql = "UPDATE voluntario SET quant_cadastro = quant_cadastro - 1 WHERE id = ?";
        $result = update($conn,$sql, [$id_voluntario]);

        $conn->commit();

        setEmail('disapprove',$name_slot,$name_vol);

    } catch (Exception $e) {
        
        $conn->rollBack();
        Show_incorrect_text($e);
    }
    // // registro ao banco em que o usuário em questão foi negado para a vaga
    
    // try {
    //     $sql = "UPDATE registro SET situacao = ? WHERE id_vaga = ? AND id_voluntario = ?";
    //     $result = update(null,$sql, ['negado',$id_vaga, $id_voluntario]);

    // } catch (Exception $e) {
    //     Show_incorrect_text($e);
    // }

    // // adicionar uma nova oportunidade ao um novo voluntário para preencher a vaga negada
    // try {
    //     $sql = "UPDATE vaga SET quant_atual = quant_atual - 1 WHERE id = ?";
    //     $result = update($sql, [$id_vaga]);

    // } catch (Exception $e) {
    //     Show_incorrect_text($e);
    // }
}

function aproved($id_vaga, $id_voluntario, $name_slot,$name_vol){

     try {
        $sql = "UPDATE registro SET situacao = ? WHERE id_vaga = ? AND id_voluntario = ?";
        $result = update(null,$sql, ['aprovado',$id_vaga, $id_voluntario]);

        setEmail('aprroved',$name_slot,$name_vol);

    } catch (Exception $e) {
        Show_incorrect_text("",$e);
    }
    
}

function setEmail($type, $name_slot,$name_vol) {

    include '../../db/gmail_params/code/cAJU.php';
    include '../../db/gmail_params/gmail/gAJU.php';

    $g_jundiai = $gmail_ajundeai;
    $c_jundiai = $code_ajundeai;
    // ----------------------
    // Configurações da vaga
    // ----------------------
    $candidate_name = $name_vol;
    $position_name  = $name_slot;
    $org_name       = $_SESSION['name'];
    $portal_link    = 'https://ajundeai.org/vagas/analista-dados';

    // ----------------------
    // PHPMailer
    // ----------------------
    $mail = new PHPMailer(true);

    try {
        // Configuração do SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';        // servidor SMTP
        $mail->SMTPAuth   = true;
        $mail->Username   = $g_jundiai;  // e-mail do serviço
        $mail->Password   = $c_jundiai;    // senha de app
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // TLS
        $mail->Port       = 587;
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';

        // Remetente
        $mail->setFrom('ajundeai.service@gmail.com', 'Ajundeai');
        $mail->addReplyTo($_POST['email_ong'], $org_name); // ONG pode responder

        // Destinatário
        $mail->addAddress($_POST['email_vol'], $candidate_name);

        // Conteúdo do e-mail
        $mail->isHTML(true);

        if ($type == 'aprroved'){
            $mail->Subject = "| NOTIFICAÇÃO AJUNDEAI | Aprovação na vaga $position_name — ONG $org_name";

            // Corpo HTML
            $mail->Body = "
            <p>Olá $candidate_name,</p>
            <p>Temos uma ótima notícia! A ONG <strong>$org_name</strong>, após analisar o seu currículo, confirmou sua <strong>aprovação</strong> para a vaga <strong>$name_slot</strong>.</p>
            <p>Para consultar orientações, próximos passos e mensagens, acesse o portal do <strong>Ajundeai</strong>, faça o login, e vá até a aba 'Vagas':
            <br><a href='$portal_link'>$portal_link</a></p>
            <p>Este e-mail foi enviado automaticamente pelo sistema <strong>Ajundeai</strong> em nome da ONG <strong>$org_name</strong>.
            Se tiver dúvidas, responda a esta mensagem ou entre em contato diretamente com a ONG.</p>
            <p>Atenciosamente,<br>
            Equipe Ajundeai<br>
            <a href='https://ajundeai.org'>ajundeai.org</a></p>
            ";

            // Corpo em texto simples (alternativo)
            $mail->AltBody = "Olá $candidate_name,
                
            Temos uma ótima notícia! A ONG $org_name, após analisar o seu currículo, confirmou sua aprovação para a vaga $position_name.
            
            Para consultar orientações, próximos passos e mensagens, acesse o portal do Ajundeai, faça o login, e vá até a aba 'Vagas':
            $portal_link
            
            Este e-mail foi enviado automaticamente pelo sistema Ajundeai em nome da ONG $org_name.
            Se tiver dúvidas, responda a esta mensagem ou entre em contato diretamente com a ONG.
            
            Atenciosamente,
            Equipe Ajundeai
            https://ajundeai.org
            ";

        }  else if ($type == 'disapprove'){
            $mail->Subject = "| NOTIFICAÇÃO AJUNDEAI | Atualização sobre sua candidatura à vaga $position_name — ONG $org_name";

            // Corpo HTML
            $mail->Body = "
            <p>Olá $candidate_name,</p>
            <p>Agradecemos sua candidatura para a vaga <strong>$position_name</strong>, vinculada à ONG <strong>$org_name</strong>.</p>
            <p>Após análise do seu currículo, infelizmente você não foi selecionado(a) para esta oportunidade.
            Sua participação foi muito importante, e recomendamos que continue acompanhando novas vagas no Ajundeai, pois podem surgir oportunidades alinhadas ao seu perfil.</p>
            <p>Recomendamos que continue acompanhando novas vagas no <strong>Ajundeai</strong>, pois podem surgir oportunidades alinhadas ao seu perfil e interesses:
            <br>Acesse: <a href='$portal_link'>'portal_link'</a></p>
            <p>Este e-mail foi enviado automaticamente pelo sistema <strong>Ajundeai</strong> em nome da ONG <strong>$org_name</strong>.  
            Em caso de dúvidas, você pode responder a esta mensagem ou contatar diretamente a ONG.</p>
            <p>Desejamos sucesso em seus próximos passos!<br>
            Equipe Ajundeai<br>
            <a href='https://ajundeai.org'>ajundeai.org</a></p>";

            // Corpo em texto simples (alternativo)
            $mail->AltBody = "Olá $candidate_name,
            
            Agradecemos sua candidatura para a vaga $position_name, vinculada à ONG $org_name.
            
            Após análise do seu currículo, infelizmente você não foi selecionado(a) para esta oportunidade.  
            Sua participação foi muito importante, e recomendamos que continue acompanhando novas vagas no Ajundeai, pois podem surgir oportunidades alinhadas ao seu perfil.
            Acesse: $portal_link
            
            Este e-mail foi enviado automaticamente pelo sistema Ajundeai em nome da ONG $org_name.  
            Em caso de dúvidas, você pode responder a esta mensagem ou contatar diretamente a ONG.
            
            Desejamos sucesso em seus próximos passos!
            Equipe Ajundeai
            https://ajundeai.org";
        }
        // Enviar
        $mail->send();
        // echo "E-mail de aprovação enviado com sucesso!";
        $_SESSION['notification'] = 'protocolWithSucess_emailSend';

    } catch (Exception $e) {
        $_SESSION['notification'] = 'protocolWithSucess_emailNotSend';
    }

}
?>