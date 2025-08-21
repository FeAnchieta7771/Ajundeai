<?php
function notificator($type_notfication)
{

    switch ($type_notfication) {

        case 'name_repated_error':
            name_repated_error();
            break;

        case 'phone_error':
            phone_error();
            break;

        case 'cpf_error':
            cpf_error();
            break;

        case 'whatsapp_error':
            whatsapp_error();
            break;

        case 'server_error':
            server_error();
            break;

        case 'create_account_sucess':
            create_account_sucess();
            break;

        case 'login_sucess':
            login_sucess();
            break;

        case 'login_error':
            login_error();
            break;
        case 'save_button':
            save_button();
            break;
        case 'unsave_button':
            unsave_button();
            break;
        case 'send_button':
            send_button();
            break;
        case 'unsend_button':
            unsend_button();
            break;
        case 'not_permited':
            not_permited();
            break;
    }
}

function js_notification($type, $icon, $title, $text){

    echo "<script>
        window.addEventListener('load', function(){
        createToast($type, $icon, $title, $text);
        });
    </script>";
}

function name_repated_error()
{
    $title = json_encode("Já existe um Registro com esse Nome");
    $text = json_encode("Insira outro nome...");
    $type = json_encode("error");
    $icon = json_encode("bx bx-list-x");

    js_notification($type, $icon, $title, $text);
}

function phone_error()
{

    $title = json_encode("Número de Telefone Inválido");
    $text = json_encode("Verifique o campo de Telefone...");
    $type = json_encode("error");
    $icon = json_encode("bx  bx-phone-x");

    js_notification($type, $icon, $title, $text);
}
function cpf_error()
{

    $title = json_encode("Número de CPF Inválido");
    $text = json_encode("Verifique o campo de cpf...");
    $type = json_encode("error");
    $icon = json_encode("bx  bx-user-id-card");

    js_notification($type, $icon, $title, $text);
}

function whatsapp_error()
{

    $title = json_encode("Número de Whatsapp Inválido");
    $text = json_encode("Verifique o campo de Whatsapp...");
    $type = json_encode("error");
    $icon = json_encode("bx  bx-phone-x");

    js_notification($type, $icon, $title, $text);
}

function server_error()
{

    $title = json_encode("Ops! Ocorreu um Erro no Servidor");
    $text = json_encode("Tente novamente mais tarde...");
    $type = json_encode("error");
    $icon = json_encode("bx  bx-server");

    js_notification($type, $icon, $title, $text);
}

function create_account_sucess()
{

    $title = json_encode("BEM VINDO AO AJUNDEAI!");
    $text = json_encode("Conta criada com sucesso...");
    $type = json_encode("victory");
    $icon = json_encode("bx  bxs-check-circle");

    js_notification($type, $icon, $title, $text);
}

function login_sucess()
{

    $title = json_encode("BEM VINDO DE VOLTA!");
    $text = json_encode("login realizado com sucesso...");
    $type = json_encode("sucess");
    $icon = json_encode("bx  bxs-check-circle");

    js_notification($type, $icon, $title, $text);
}

function login_error()
{

    $title = json_encode("Nome/Email ou Senha Incorreta");
    $text = json_encode("Verifique as informações...");
    $type = json_encode("error");
    $icon = json_encode("bx  bxs-x-circle");

    js_notification($type, $icon, $title, $text);
}

function save_button()
{

    $title = json_encode("Vaga Salva na Conta");
    $text = json_encode("Entre no painel de controle para acessar...");
    $type = json_encode("save");
    $icon = json_encode("bx bxs-bookmark");

    js_notification($type, $icon, $title, $text);
}

function unsave_button()
{

    $title = json_encode("Você removeu a Vaga do Salvos");
    $text = json_encode("...");
    $type = json_encode("unsave");
    $icon = json_encode("bx bx-bookmark");

    js_notification($type, $icon, $title, $text);
}
function send_button()
{

    $title = json_encode("Você se Cadastrou na Vaga!");
    $text = json_encode("Aguarde uma resposta no painel de controle...");
    $type = json_encode("send");
    $icon = json_encode("bx  bxs-send-alt");

    js_notification($type, $icon, $title, $text);
}
function unsend_button()
{

    $title = json_encode("Você cancelou o Cadrasto à Vaga");
    $text = json_encode("Continue procurando por outras melhores...");
    $type = json_encode("unsend");
    $icon = json_encode("bx  bxs-send-alt-2");

    js_notification($type, $icon, $title, $text);
}

function not_permited()
{

    $title = json_encode("Você chegou no Limite de Cadastro Permitido");
    $text = json_encode("O limite de 3 cadastros foram atingidos...");
    $type = json_encode("error");
    $icon = json_encode("bx  bxs-alert-triangle");

    js_notification($type, $icon, $title, $text);
}
?>