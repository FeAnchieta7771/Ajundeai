<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../PHPMailer/src/Exception.php';
require '../../PHPMailer/src/PHPMailer.php';
require '../../PHPMailer/src/SMTP.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function setEmail($type, $name_slot,$name_vol, $email_ong, $email_vol) {

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
            <p style='font-size: 12px; color: #777;'>Este e-mail foi enviado automaticamente pelo sistema <strong>Ajundeai</strong> em nome da ONG <strong>$org_name</strong>.
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
            <p style='font-size: 12px; color: #777;'>Este e-mail foi enviado automaticamente pelo sistema <strong>Ajundeai</strong> em nome da ONG <strong>$org_name</strong>.  
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
         else if ($type == 'calling'){
            $mail->Subject = "| NOTIFICAÇÃO AJUNDEAI | Convite para vaga: $position_name — ONG $org_name";

            // Corpo HTML
            $mail->Body = "
            <p>Olá $candidate_name,</p>

            <p>A ONG <b>'$org_name'</b> identificou em seu perfil um grande potencial 
            para contribuir em nossa missão e gostaria de convidá-lo(a) para participar da oportunidade:</p>
            
            <p style='margin: 10px 0; font-size: 16px;'>
                <b>Vaga:</b> '$position_name'
            </p>
            
            <p>O trabalho voluntário nesta função é essencial para fortalecer nossas ações e 
            ampliar o impacto positivo em nossa comunidade. 
            Sua participação pode fazer a diferença na vida de muitas pessoas.</p>
            
            <p>Caso tenha interesse em se engajar conosco, pedimos que acesse o 
            <b>portal Ajundeai</b> e confirme sua participação na vaga.</p>
            
            <p>Estamos ansiosos para contar com sua colaboração.<br>
            <b>'$org_name'</b></p>
            
            <hr>
            <p style='font-size: 12px; color: #777;'>
                Esta mensagem foi enviada automaticamente pelo sistema Ajundeai. 
                Por favor, não responda a este e-mail diretamente.
            </p>
            Equipe Ajundeai<br>
            <a href='https://ajundeai.org'>ajundeai.org</a></p>";

            // Corpo em texto simples (alternativo)
            $mail->AltBody = "Olá $candidate_name,
            
            A ONG '$org_name' identificou em seu perfil um grande potencial 
            para contribuir em nossa missão e gostaria de convidá-lo(a) para participar da oportunidade:

            Vaga: $position_name
            
            O trabalho voluntário nesta função é essencial para fortalecer nossas ações e 
            ampliar o impacto positivo em nossa comunidade. 
            Sua participação pode fazer a diferença na vida de muitas pessoas.
            
            Caso tenha interesse em se engajar conosco, pedimos que acesse o 
            portal Ajundeai e confirme sua participação na vaga.
            
            Estamos ansiosos para contar com sua colaboração.
            $org_name
            
            Esta mensagem foi enviada automaticamente pelo sistema Ajundeai. 
            Por favor, não responda a este e-mail diretamente.
            </p>
            Equipe Ajundeai
            https://ajundeai.org";
        }
        // Enviar
        $mail->send();
        // echo "E-mail de aprovação enviado com sucesso!";
        return true;

    } catch (Exception $e) {
        return false;
    }

}

?>