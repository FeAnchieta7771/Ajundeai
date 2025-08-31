<?php

include '../php_db/methods.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


function Show_error($e)
{
    $_SESSION['erro'] = $e;
    $_SESSION['account_state'] = $_POST['account_state'];
    $_SESSION['notification'] = 'server_error';

    header('Location: ../../analysis_voluntary_ong.php');
    exit();
}

function Show_incorrect_text($text, $type_notfication)
{
    $_SESSION['message'] = $text;
    $_SESSION['account_state'] = $_POST['account_state'];
    $_SESSION['notification'] = $type_notfication;

    header('Location: ../../analysis_voluntary_ong.php');
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

    } catch (PDOException $e) {
        
        $conn->rollBack();
        Show_incorrect_text($e);
    }
    // // registro ao banco em que o usuário em questão foi negado para a vaga
    
    // try {
    //     $sql = "UPDATE registro SET situacao = ? WHERE id_vaga = ? AND id_voluntario = ?";
    //     $result = update(null,$sql, ['negado',$id_vaga, $id_voluntario]);

    // } catch (PDOException $e) {
    //     Show_incorrect_text($e);
    // }

    // // adicionar uma nova oportunidade ao um novo voluntário para preencher a vaga negada
    // try {
    //     $sql = "UPDATE vaga SET quant_atual = quant_atual - 1 WHERE id = ?";
    //     $result = update($sql, [$id_vaga]);

    // } catch (PDOException $e) {
    //     Show_incorrect_text($e);
    // }
}

function aproved($id_vaga, $id_voluntario, $name_slot,$name_vol){

     try {
        $sql = "UPDATE registro SET situacao = ? WHERE id_vaga = ? AND id_voluntario = ?";
        $result = update(null,$sql, ['aprovado',$id_vaga, $id_voluntario]);

        setEmail('aprroved',$name_slot,$name_vol);

    } catch (PDOException $e) {
        Show_incorrect_text("Norberto é uma gostosa e o william tbm",$e);
    }
    
}

function setEmail($type, $name_slot,$name_vol) {

    $email_vol = $_POST['email_vol'];
    $email_ong = $_POST['email_ong'];

    $candidate_name = $name_vol;
    $org_name       = $_SESSION['name'];
    $org_email      = $email_ong;
    $to             = $email_vol;
    $subject        = "APROVAÇÃO na vaga $name_slot — próximos passos";

    if ($type == 'aprroved'){

        $portal_link    = 'https://portal.exemplo.org/vagas/analista-dados';

        // Partes do e-mail
        $textBody = "Olá $candidate_name,\n\n"
            ."Temos uma ótima notícia! A ONG $org_name, após analisar o seu currículo, confirmou sua aprovação para a vaga $name_slot.\n\n"
            ."Para consultar orientações, próximos passos e mensagens, acesse o portal do Ajundeai, faça o login, e vá até a aba 'Vagas':\n"
            ."$portal_link\n\n"
            ."Este e-mail foi enviado automaticamente pelo sistema Ajundeai em nome da ONG $org_name\n."
            ."Se tiver dúvidas, responda a esta mensagem ou entre em contato diretamente com a ONG.\n\n"
            ."Atenciosamente,\n"
            ."Equipe Ajundeai\n"
            ."https://ajundeai.org \n";

        $htmlBody = "<p>Olá {{candidate_name}},</p>"
            ."<p>Temos uma ótima notícia! A ONG <strong>$org_name</strong>, após analisar o seu currículo, confirmou sua <strong>aprovação</strong> para a vaga <strong>$name_slot</strong>.</p>"
            ."<p>Para consultar orientações, próximos passos e mensagens, acesse o portal do <strong>Ajundeai</strong>, faça o login, e vá até a aba 'Vagas':"
            ."<br><a href='$portal_link'>{{portal_link}}</a></p>"
            ."<p>Este e-mail foi enviado automaticamente pelo sistema <strong>Ajundeai</strong> em nome da ONG <strong>$org_name</strong>."
            ."Se tiver dúvidas, responda a esta mensagem ou entre em contato diretamente com a ONG.</p>"
            ."<p>Atenciosamente,<br>"
            ."Equipe Ajundeai<br>"
            ."<a href='https://ajundeai.org'>ajundeai.org</a></p>";

    } else if ($type == 'disapprove'){

        $portal_link    = 'https://portal.exemplo.org/vagas/analista-dados';

        // Partes do e-mail
        $textBody = "Olá $candidate_name,\n\n"
            ."Agradecemos sua candidatura para a vaga $name_slot, vinculada à ONG $org_name.\n\n"
            ."Após análise do seu currículo, infelizmente você não foi selecionado(a) para esta oportunidade.\n"  
            ."Sua participação foi muito importante, e recomendamos que continue acompanhando novas vagas no Ajundeai, pois podem surgir oportunidades alinhadas ao seu perfil.\n"
            ."Acesse: $portal_link\n\n"
            ."Este e-mail foi enviado automaticamente pelo sistema Ajundeai em nome da ONG $org_name.\n"  
            ."Em caso de dúvidas, você pode responder a esta mensagem ou contatar diretamente a ONG.\n\n"
            ."Desejamos sucesso em seus próximos passos!\n"
            ."Equipe Ajundeai\n"
            ."https://ajundeai.org \n";

        $htmlBody = "<p>Olá {{candidate_name}},</p>"
            ."<p>Agradecemos sua candidatura para a vaga <strong>$name_slot</strong>, vinculada à ONG <strong>$org_name</strong>.</p>"
            ."<p>Após análise do seu currículo, infelizmente você não foi selecionado(a) para esta oportunidade." 
            ."Sua participação foi muito importante, e recomendamos que continue acompanhando novas vagas no Ajundeai, pois podem surgir oportunidades alinhadas ao seu perfil.</p>"
            ."<p>Recomendamos que continue acompanhando novas vagas no <strong>Ajundeai</strong>, pois podem surgir oportunidades alinhadas ao seu perfil e interesses:"
            ."<br>Acesse: <a href='$portal_link'>'portal_link'</a></p>"
            ."<p>Este e-mail foi enviado automaticamente pelo sistema <strong>Ajundeai</strong> em nome da ONG <strong>$org_name</strong>."  
            ."Em caso de dúvidas, você pode responder a esta mensagem ou contatar diretamente a ONG.</p>"
            ."<p>Desejamos sucesso em seus próximos passos!<br>"
            ."Equipe Ajundeai<br>"
            ."<a href='https://ajundeai.org'>ajundeai.org</a></p>";
    }

    // Fronteira MIME
    $boundary = md5(uniqid(time(), true));

    // Cabeçalhos
    $headers  = "From: $org_name <$org_email>\r\n";
    $headers .= "Reply-To: $org_email\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: multipart/alternative; boundary=\"$boundary\"\r\n";

    // Corpo MIME
    $message  = "--$boundary\r\n";
    $message .= "Content-Type: text/plain; charset=UTF-8\r\n";
    $message .= "Content-Transfer-Encoding: 8bit\r\n\r\n";
    $message .= $textBody . "\r\n";
    $message .= "--$boundary\r\n";
    $message .= "Content-Type: text/html; charset=UTF-8\r\n";
    $message .= "Content-Transfer-Encoding: 8bit\r\n\r\n";
    $message .= $htmlBody . "\r\n";
    $message .= "--$boundary--";

    // Envio
    $ok = mail($to, $subject, $message, $headers);

    if ($ok) {
    echo "E-mail enviado com sucesso.";
    } else {
    echo "Falha ao enviar e-mail.";
    }

}
?>