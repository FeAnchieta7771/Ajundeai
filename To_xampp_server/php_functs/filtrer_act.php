<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'conexao.php';

// apenas executa o código apenas se ele for chamado
if ($_SERVER['REQUEST_METHOD'] == 'POST'){


    $type_filter = $_POST['type'];

    
    if($type_filter == 'home_search'){

        // receber filtro escrito pelo usuário
        $filter_user = $_POST['filter_user'];

        // iniciar tentiva de consulta
        try{
            $sql = "SELECT * FROM vaga WHERE nome LIKE '%".$filter_user."%' OR categoria_vaga LIKE'%".$filter_user."%'";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // exibir número de vagas encontradas
            $numLinhas = count($result);


            #exibição das vagas encontradas
            foreach($result as $user_result){

                // terminar código quando a tela filter.php for feita
                echo "$numLinhas foram encontradas";
            }

        } finally {
            
        }

    } else if ($type_filter == 'home_category'){

    } else if($type_filter == 'filter'){

    }

    
// buscar no banco
// exibir as vagas
// nome, categoria
//ja volto, vou ali no banheiro 
}

?>
