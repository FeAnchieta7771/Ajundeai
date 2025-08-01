<?php
// Função Principal
/////////////////////////////////////////////////////////////////////////
// ! Este arquivo está disposto a executar os filtros da tela "filter.php"
/////////////////////////////////////////////////////////////////////////
function do_filter(){
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // TODO filtro tem a mesma base de pesquisas, sendo apenas condições diferentes
    // variável constante nas buscas sql
    $base_sql = "SELECT vaga.*, ong.nome_ong FROM vaga JOIN ong ON ong.id = vaga.id_ong WHERE vaga.quant_atual < vaga.quant_limite ";
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    // apenas executa o código apenas se ele for chamado
    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
        
        include 'php_db/conexao.php';

        if(!isset($_GET['type'])){
            // Não terá nenhuma condição extra além de vagas disponíveis
            // este filtro apenas funciona para introduz a tela de filtro direcionada por um botão
            $sql = $base_sql;
            
            $result = return_select($sql);
            show_filter($result, "");
            exit();
        }

        $type_filter = $_GET['type'];

    ////////////////////////////////////////////////////////////////////
    
    // ! ESSE FILTRO VAI PARA PESQUISAS FEITAS PELA
        // BARRA DE PESQUISA DA TELA DE HOME
        if($type_filter == 'home_search'){
            
            // receber filtro escrito pelo usuário
            $filter_user = $_GET['filter_user'];
            
            // ! Filtros da pesquisa
            // Nome da ONG a partir do ID da Ong da vaga registrada
            // Apenas exibir vagas disponíveis
            // Busca do texto pelo nome da Ong
            // Busca do texto pelo nome da vaga
            // Busca do texto pelo nome da categoria
            
            $sql =  $base_sql; 
            $sql .= "AND ( ong.nome_ong LIKE '%$filter_user%' OR vaga.nome LIKE '%$filter_user%' OR vaga.categoria_vaga LIKE '%$filter_user%')";
            
            $result = return_select($sql);
            show_filter($result, $filter_user);
            
    ////////////////////////////////////////////////////////////////////
            
        // ! ESSE FILTRO VAI PARA PESQUISAS FEITAS PELOS
        // BOTÕES CONFIGURADOS NO HOME
        } else if ($type_filter == 'home_category'){
        
            $filter_user = $_GET['category_button'];

            $sql =  $base_sql;
            $sql .= "AND vaga.categoria_vaga LIKE '%$filter_user%'";
            
            $result = return_select($sql);
            show_filter($result, "");
        
    ////////////////////////////////////////////////////////////////////
    
        // ! ESSE FILTRO VAI PARA PESQUISAS FEITAS 
        // DIRETAMENTE A TELA DE FILTRO
        } else if($type_filter == 'filter_base'){


            $filter_user = $_GET['filter_user'];

            $sql =  $base_sql;
            // se não tiver algo do filtro, ele conta categoria do input de texto
            $sql = filter_base_checkbox($sql,$filter_user);

            // echo $sql;
            $result = return_select($sql);
            show_filter($result, $filter_user);
        }

    ////////////////////////////////////////////////////////////////////
    }
}


// função de execução do SELECT
function return_select($sql){
    include 'php_db/conexao.php';
    try{
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
        
    }catch(PDOException $e) {
        echo "<div class='quantSlot'><h3>NADA ENCONTRADO</h3></div>";
        echo "<div class='scroll-wrapper' style='height: 300px'>";
        echo "<div class='vaga-card' style='background-color:rgb(222, 222, 222); border: none;'>";
        echo "  <img src='img/icons_orange/problem_data.png' alt='Ícone' />";
        echo "  <div class='vaga-info'>";
        echo "    <h3 style='display: flex;'>";
        echo "     Ops! Ocorreu um erro ao conectar ao servidor.</h3>";
        echo "    <span>Tente de novo mais tarde.</span>";
        echo "    <p style='font-size: 10px'>".$e."</p>";
        echo "  </div>";
        echo "</div>";
        echo "</div>";
        exit();
    }
}

// A FUNÇÃO fará a exibição dos resultados entregues á ela
function show_filter($result, $filter_user){

        // iniciar tentiva de consulta
        $numLinhas = count($result);

        if($numLinhas <= 0){
            echo "<div class='quantSlot'>
            <h3>NADA ENCONTRADO</h3></div>";
            echo "<div class='scroll-wrapper'>";
            echo "<div class='vaga-card' style='background-color:rgb(222, 222, 222); border: none;'>";
          
            echo "  <img src='img/icons_orange/not_found.png' alt='Ícone' />";
            echo "  <div class='vaga-info'>";
            echo "    <h3 style='display: flex;'>Infelizmente, sua busca não retornou nenhuma vaga.</h3>";
            echo "    <span>Tente alterar os filtros ou pesquisar com outros termos.</span>";
            echo "  </div>";
            echo "</div>";
            echo "</div>";
            exit();
        }

        $plural_foi = "I";
        $plural_s = "";

        if($numLinhas > 1){
            $plural_s = "S";
            $plural_foi = "RAM";
        }
        echo "<div class='quantSlot'><h3>".$numLinhas. " VAGA".$plural_s." FO".$plural_foi." ENCONTRADA".$plural_s."!</h3>";
        echo "</div><div class='scroll-wrapper'>";

        #exibição das vagas encontradas
        foreach($result as $user_result){
            // busca a imagem a partir da categoria da vaga
            $url = image_filter($user_result['categoria_vaga']);
            
            
          echo "<div class='vaga-card'>";
          
          echo "<form method='GET' action='../show_slot_voluntary.php'>";
          echo "<input type='hidden' name='type' value='filter_base'>";
          echo "<input type='hidden' name='filter_user' value='".$filter_user."'>";
          echo "<input type='hidden' name='id_vaga' value=".$user_result['id'].">";
          echo "<button type='submit'>";
          echo "  <img src='$url' alt='Ícone' />";
          echo "  <div class='vaga-info'>";
          echo "    <h4 style='font-family: 'Horizon', sans-serif;'><a style='text-decoration: none'>".$user_result['nome']."</a></h4>";
          echo "    <span><i class='bx bxs-user' style='font-size: 20px;'></i> ".$user_result['quant_atual']."/".$user_result['quant_limite']." • ".$user_result['nome_ong']."</span>";
          echo "    <p>".$user_result['descr_obj']."</p>";
          echo "  </div>";
          echo "</button>";
          echo "</form>";
          echo "</div>";
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
