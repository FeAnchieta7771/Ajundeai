<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// busca se o usuário está logado
// retorna True ou False 
function is_logged(){
    if(isset($_SESSION['isLogin']) && $_SESSION['isLogin']){

        // o usuário está logado
        return true;
    } else {

        // o usuário não está logado
        return false;
    }

}

// busca se o usuário logado é uma ong
// retorna True ou False
function is_ong_logged(){

    if(isset($_SESSION['whoLogged']) && $_SESSION['whoLogged'] == 'ong'){

        // o usuário está logado
        return true;
    } else {

        // o usuário não está logado
        return false;
    }
}

// retorno do modelo a partir da situação de login do usuário
// retorna o modelo a ser utilizado
function set_model_buttons_header($is_logged, $is_ong){
    if($is_logged){

        $piece = "<div class='logo'>
                <a href='index.php'>
                <img src='img\Logo_Header.png' alt='Logo AjundeAi' />
                </a>
                </div>
                <div class='menu-container'>
                <button class='menu-button'><i class='bx bxs-user-circle' style='font-size: 30px; flex-shrink: 0;'></i> 
                <span class='menu-text'><strong>Nome do cidadão</strong></span>
                </button>";
        
        if($is_ong){
            $piece = $piece . "<div class='submenu'>
            <form method='POST' action=''>
            <button name='button_header' value='ong_painel'>Painel de Controle</button>
            <button name='button_header' value='ong_vaga'>Adicionar Vaga</button>
            <button name='button_header' value='out'><strong>Sair da Conta</strong></button>
            </form>
            </div> 
            </div> ";
        } else {

            $piece = $piece . "<div class='submenu'>
            <form method='POST' action=''>
            <button name='button_header' value='volu_painel'>Painel de Controle</button>
            <button name='button_header' value='volu_vaga'>Pesquisa de Vaga</button>
            <button name='button_header' value='out'><strong>Sair da Conta</strong></button>
            </form>
            </div> 
            </div> ";
        }

        return $piece;
    }else{
        
        return "<div class='header-buttons'><a href='login.php' class='btn login' >ENTRAR</a><a href='account.php' class='btn register'>CADASTRE-SE</a></div>";
    }
}
?>
