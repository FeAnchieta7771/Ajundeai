<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function show_filter($sql, $is_show_saved, $is_show_cadastred){

        // iniciar tentiva de consulta
        $result  = return_select($sql);
        $numLinhas = count($result);

        #exibição das vagas encontradas
        foreach($result as $user_result){

            // terminar código quando a tela filter.php for feita
            echo "$numLinhas foram encontradas";
        }
}

function return_select( $sql){
    try{
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    }catch {

    }
}

include 'conexao.php';

// apenas executa o código apenas se ele for chamado
if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $type_filter = $_POST['type'];

    
    if($type_filter == 'home_search'){

        // receber filtro escrito pelo usuário
        $filter_user = $_POST['filter_user'];
        $sql = "SELECT * FROM vaga WHERE nome LIKE '%".$filter_user."%' OR categoria_vaga LIKE'%".$filter_user."%' OR categoria_vaga LIKE'%".$filter_user."%'";
        $result_1 = return_select($sql);

        $sql = "SELECT * FROM vaga WHERE nome LIKE '%".$filter_user."%' OR categoria_vaga LIKE'%".$filter_user."%' OR categoria_vaga LIKE'%".$filter_user."%'";
        show_filter($sql, false, false);

    } else if ($type_filter == 'home_category'){
        
        $filter_user = $_POST['category_button'];
        $sql = "SELECT * FROM vaga WHERE categoria_vaga LIKE'%".$filter_user."%'";

        show_filter($sql, false, false);

    } else if($type_filter == 'filter_base'){

    } else if($type_filter == 'save_filter'){

    } else if($type_filter == 'sign_filter'){

    }

    
// buscar no banco
// exibir as vagas
// nome, categoria
}

?>
