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

        $piece =  "<div class='menu-container'>";
        
        if($is_ong){
            // Botão para o usuário de ONG
            $piece .= "<button class='menu-button'><i class='bx bxs-buildings' style='font-size: 30px; flex-shrink: 0;'></i>";
            $piece .= "<span class='menu-text'><strong>".htmlspecialchars($_SESSION['name'])."</strong></span>";
            $piece .= "</button>";
            $piece .= "<div class='submenu'>";
            $piece .= "<form method='POST' action='../php_functs/action_buttons_login.php'>";
            $piece .= "<input type='hidden' name='type' value='slot_created_ong'/>";
            $piece .= "<button name='button_header' value='ong_painel'>Painel de Controle</button>";
            $piece .= "<button name='button_header' value='ong_vaga'>Adicionar Vaga</button>";
            $piece .= "<button name='button_header' value='out'><strong>Sair da Conta</strong></button>";
            $piece .= "</form></div> </div>";

        } else {
            // Botão para o usuário de voluntário
            $piece .= "<button class='menu-button'><i class='bx bxs-user-circle' style='font-size: 30px; flex-shrink: 0;'></i>";
            $piece .= "<span class='menu-text'><strong>".htmlspecialchars($_SESSION['name'])."</strong></span>";
            $piece .= "</button>";
            $piece .= "<div class='submenu'>";
            $piece .= "<form method='POST' action='../php_functs/action_buttons_login.php'>";
            $piece .= "<input type='hidden' name='type' value='nothing_else'/>";
            $piece .= "<button name='button_header' value='volu_painel'>Painel de Controle</button>";
            $piece .= "<button name='button_header' value='volu_vaga'>Pesquisa de Vaga</button>";
            $piece .= "<button name='button_header' value='out'><strong>Sair da Conta</strong></button>";
            $piece .= "</form></div> </div>";

        }

        return $piece;

    }else{
        
        $piece =  "<div class='header-buttons'>";
        $piece .= "<a href='login.php' class='btn login' >ENTRAR</a>";
        $piece .= "<a href='account.php' class='btn register'>CADASTRE-SE</a>";
        $piece .= "</div>";
        return $piece;
    }
}



?>
