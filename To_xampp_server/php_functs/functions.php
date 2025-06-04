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

// depois criar função de apresentação do modelo de exibição do usuário
// ! junto aos botões personalizados
?>
