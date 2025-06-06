<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Função Principal
function do_filter(){
    
    // apenas executa o código apenas se ele for chamado
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        include 'conexao.php';
        $type_filter = $_POST['type'];

        
        if($type_filter == 'home_search'){

            // receber filtro escrito pelo usuário
            $filter_user = $_POST['filter_user'];
            $sql = "SELECT vaga.* FROM vaga JOIN ong ON ong.id = vaga.id WHERE ong.nome LIKE '%$filter_user%' OR vaga.nome LIKE '%$filter_user%' OR vaga.categoria_vaga LIKE '%$filter_user%'";
            
            $result = return_select($sql);
            show_filter($result);

        } else if ($type_filter == 'home_category'){
            
            $filter_user = $_POST['category_button'];
            $sql = "SELECT * FROM vaga WHERE categoria_vaga LIKE'%".$filter_user."%'";

            $result = return_select($sql);
            show_filter($result);

        } else if($type_filter == 'filter_base'){

        } else if($type_filter == 'save_filter'){

        } else if($type_filter == 'sign_filter'){

        }
    }
}

// função de execução do SELECT
function return_select($sql){
    global $conn;
    try{
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;

    }catch(PDOException) {
        echo "<script>window.alert('Não foi capaz de realizar o Filtro, tente outra hora');</script>";
        exit();
    }
}

// A FUNÇÃO fará a exibição dos resultados entregues á ela
function show_filter($result){

        // iniciar tentiva de consulta
        $numLinhas = count($result);

        #exibição das vagas encontradas
        foreach($result as $user_result){

            // terminar código quando a tela filter.php for feita
            echo "$numLinhas foram encontradas";
        }
}


?>
