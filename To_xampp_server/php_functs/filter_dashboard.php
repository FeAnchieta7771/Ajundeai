<?php
// Função Principal
/////////////////////////////////////////////////////////////////////////
// ! Este arquivo está disposto a executar os filtros da tela "filter.php"
/////////////////////////////////////////////////////////////////////////
function do_dashboard(){
    
    // apenas executa o código apenas se ele for chamado
    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
        
        include 'conexao.php';

        $id_ong = $_SESSION['id'];

        $sql = "SELECT vaga.*, ong.nome_ong FROM vaga JOIN ong ON ong.id = vaga.id_ong WHERE vaga.id_ong = $id_ong";

        // pegue todas as vaga s que contenham o mesmo id da ong

        $result = return_select($sql);
        show_filter($result);

    }
}


// função de execução do SELECT
function return_select($sql){
    include 'conexao.php';
    try{
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
        
    }catch(PDOException $e) {
        
        echo '<div class="engloba">';
        echo '<div class="vaga-card">';
        echo "<img src='img/icons_orange/problem_data.png' alt='Ícone' />";
        echo '<div class="vaga-info">';
        echo '<h3>Ops! Ocorreu um erro ao conectar ao servidor.</h3>';
        echo '<p>Tente de novo mais tarde.</p>';
        echo '</div>';
        echo '<div class="vaga-extra" aria-label="Quantidade de candidatos">';
        echo '</div>';
        echo '</div>';
        exit();
    }
}

// A FUNÇÃO fará a exibição dos resultados entregues á ela
function show_filter($result){

        // iniciar tentiva de consulta
        $numLinhas = count($result);

        if($numLinhas <= 0){
            echo '<div class="engloba">';
            echo '<div class="vaga-card">';
            echo "<img src='img/icons_orange/not_found.png' alt='Ícone' />";
            echo '<div class="vaga-info">';
            echo '<h3>Você ainda não criou nenhuma Vaga!</h3>';
            echo '<p>Clique no botão + para criar sua primeira vaga...</p>';
            echo '</div>';
            echo '<div class="vaga-extra" aria-label="Quantidade de candidatos">';
            echo '</div>';
            echo '</div>';
            exit();
        }

        echo '<div class="engloba">';

        #exibição das vagas encontradas
        foreach($result as $user_result){
            // busca a imagem a partir da categoria da vaga
            $url = image_filter($user_result['categoria_vaga']);
            
            
            echo '<div class="vaga-card">';
            echo "<form method='GET' action='../control_slot_ong.php'>";
            echo "<input type='hidden' name='type' value='filter_ctrl'>";
            echo "<input type='hidden' name='id_vaga' value=".$user_result['id'].">";
            echo "<button type='submit'>";
            echo "<img src='$url' alt='Ícone da vaga' />";
            echo '<div class="vaga-info">';
            echo '<h4>'.$user_result['nome'].'</h4>';
            echo '<p>'.$user_result['descr_obj'].'</p>';
            echo '</div>';
            echo '<div class="vaga-extra" aria-label="Quantidade de candidatos">';
            echo '<i class="bx bxs-user" ></i>';
            echo '  '.$user_result['quant_atual']."/".$user_result['quant_limite'].'';
            echo '</div>';
            echo "</button>";
            echo "</form>";
            echo '</div>';

        }

        echo "</div>";
}

// busca pelo caminho da imagem á ser mostrado na vaga
function image_filter($categoriaImagem){
    
        $categoriaImagem = strtolower($categoriaImagem);
        
        if(
            str_contains($categoriaImagem,"administração")
        ){return "img/icons_orange/administracao.png";}
        elseif(
            str_contains($categoriaImagem,"animais")
        ){return "img/icons_orange/animais.png";}
        elseif(
            str_contains($categoriaImagem,"assistência")
        ){return "img/icons_orange/assistencia.png";}
        elseif(
            str_contains($categoriaImagem,"crianças")
        ){return "img/icons_orange/criancas.png";}
        elseif(
            str_contains($categoriaImagem,"educação")
        ){return "img/icons_orange/educacao.png";}
        elseif(
            str_contains($categoriaImagem,"eventos")
        ){return "img/icons_orange/eventos.png";}
        elseif(
            str_contains($categoriaImagem,"meio ambiente")
        ){return "img/icons_orange/meio_ambiente.png";}
        elseif(
            str_contains($categoriaImagem,"saúde")
        ){return "img/icons_orange/saude.png";}
        elseif( 
            str_contains($categoriaImagem,"tecnologia")
        ){return "img/icons_orange/tecnologia.png";}
        else{return "img/icons_orange/outro.png";}
}

// retorna o sql completo para a pesquisa segundo os filtros e a barra de pesquisa
function filter_base_checkbox($sql, $filter_user){
            $quant_filter = 0;

            $sql .= "AND (ong.nome_ong LIKE '%$filter_user%' OR vaga.nome LIKE '%$filter_user%' OR vaga.categoria_vaga LIKE '%$filter_user%') AND (";

            if(isset($_GET["saúde"]))
            {
                $quant_filter += 1;
                $sql .= "vaga.categoria_vaga LIKE '%saúde%' OR ";
            }

            if(isset($_GET["eventos"]))
            {
                $quant_filter += 1;
                $sql .= "vaga.categoria_vaga LIKE '%eventos%' OR ";
            }

            if(isset($_GET["animais"]))
            {
                $quant_filter += 1;
                $sql .= "vaga.categoria_vaga LIKE '%animais%' OR ";
            }

            if(isset($_GET["crianças"]))
            {
                $quant_filter += 1;
                $sql .= "vaga.categoria_vaga LIKE '%crianças%' OR ";
            }

            if(isset($_GET["educação"]))
            {
                $quant_filter += 1;
                $sql .= "vaga.categoria_vaga LIKE '%educação%' OR ";
            }

            if(isset($_GET["tecnologia"]))
            {
                $quant_filter += 1;
                $sql .= "vaga.categoria_vaga LIKE '%tecnologia%' OR ";
            }

            if(isset($_GET["assistencia"]))
            {
                $quant_filter += 1;
                $sql .= "vaga.categoria_vaga LIKE '%assistencia%' OR ";
            }

            if(isset($_GET["administração"]))
            {
                $quant_filter += 1;
                $sql .= "vaga.categoria_vaga LIKE '%administração%' OR ";
            }

            if(isset($_GET["meio_ambiente"]))
            {
                $quant_filter += 1;
                $sql .= "vaga.categoria_vaga LIKE '%meio ambiente%' OR ";
            }


            
            if($quant_filter > 0){
                $filter_category = " OR vaga.categoria_vaga LIKE '%$filter_user%'";
                $sql = str_replace($filter_category,"",$sql);
                
                // remoção do OR restante
                $sql = substr($sql, 0, strlen($sql) - 3);


            }else if($quant_filter == 0){
                $sql = substr($sql, 0, strlen($sql) - 7);
            }
            
            $sql .= ")";

            return $sql;
}
?>
