<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// busca se o usuário está logado
// retorna True ou False 
function is_logged()
{
    if (isset($_SESSION['isLogin']) && $_SESSION['isLogin']) {

        // o usuário está logado
        return true;
    } else {

        // o usuário não está logado
        return false;
    }

}

// busca se o usuário logado é uma ong
// retorna True ou False
function is_ong_logged()
{

    if (isset($_SESSION['whoLogged']) && $_SESSION['whoLogged'] == 'ong') {

        // o usuário está logado
        return true;
    } else {

        // o usuário não está logado
        return false;
    }
}

// retorno do modelo a partir da situação de login do usuário
// retorna o modelo a ser utilizado
function set_model_buttons_header($is_logged, $is_ong)
{
    if ($is_logged) {

        $piece = "<div class='menu-container'>";

        if ($is_ong) {
            // Botão para o usuário de ONG
            $piece .= "<button class='menu-button'><i class='bx bxs-buildings' style='font-size: 30px; flex-shrink: 0;'></i>";
            $piece .= "<span class='menu-text'><strong>" . htmlspecialchars($_SESSION['name']) . "</strong></span>";
            $piece .= "</button>";
            $piece .= "<div class='submenu'>";
            $piece .= "<form method='POST' action='../php_functs/php_methods/action_buttons_login.php'>";
            $piece .= "<input type='hidden' name='type' value='slot_created_ong'/>";
            $piece .= "<button name='button_header' value='ong_painel'><i class='bx  bx-dock-top-right-alt' style='font-size: 20px; margin-right: 5px; margin-top: 5px;' ></i><span> Painel de Controle</span></button>";
            $piece .= "<button name='button_header' value='ong_vaga'><i class='bx  bx-plus-circle' style='font-size: 20px; margin-right: 5px; margin-top: 5px;' ></i><span> Adicionar Vaga</span></button>";
            $piece .= "<button name='button_header' value='out'><i class='bx  bx-arrow-out-left-square-half' style='font-size: 20px; margin-right: 5px; margin-top: 5px;' ></i><span><strong>Sair da Conta </strong></span></button>";
            $piece .= "</form></div> </div>";

        } else {
            // Botão para o usuário de voluntário
            $piece .= "<button class='menu-button'><i class='bx bxs-user-circle' style='font-size: 30px; flex-shrink: 0;'></i>";
            $piece .= "<span class='menu-text'><strong>" . htmlspecialchars($_SESSION['name']) . "</strong></span>";
            $piece .= "</button>";
            $piece .= "<div class='submenu'>";
            $piece .= "<form method='POST' action='../php_functs/php_methods/action_buttons_login.php'>";
            $piece .= "<input type='hidden' name='type' value='nothing_else'/>";
            $piece .= "<button name='button_header' value='volu_painel'><i class='bx  bx-dock-top-right-alt' style='font-size: 20px; margin-right: 5px; margin-top: 5px;' ></i>Painel de Controle</button>";
            $piece .= "<button name='button_header' value='volu_vaga'><i class='bx  bx-search' style='font-size: 20px; margin-right: 5px; margin-top: 5px;' ></i> Pesquisa de Vaga</button>";
            $piece .= "<button name='button_header' value='out'><i class='bx  bx-arrow-out-left-square-half' style='font-size: 20px; margin-right: 5px; margin-top: 5px;' ></i><strong>Sair da Conta</strong></button>";
            $piece .= "</form></div> </div>";

        }

        return $piece;

    } else {

        $piece = "<div class='header-buttons'>";
        $piece .= "<a href='../login.php' class='btn login' >ENTRAR</a>";
        $piece .= "<a href='../account.php' class='btn register'>CADASTRE-SE</a>";
        $piece .= "</div>";
        return $piece;
    }
}

function show_message(){

    include 'php_functs/php_methods/notificator.php';

    if(isset($_SESSION['notification'])){

        echo "
        <script>
            console.log('1');
            localStorage.setItem('2');
        </script>";

        notificator(htmlspecialchars($_SESSION['notification']));

        unset($_SESSION['notification']);
    }
}


?>