<?php
// Função Principal
function do_filter(){
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // TODO filtro tem a mesma base de pesquisas, sendo apenas condições diferentes
    // variável constante nas buscas sql
    $base_sql = "SELECT vaga.*, ong.nome_ong FROM vaga JOIN ong ON ong.id = vaga.id_ong WHERE vaga.quant_atual < vaga.quant_limite ";
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    // apenas executa o código apenas se ele for chamado
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        include 'conexao.php';
        $type_filter = $_POST['type'];



        // ! ESSE FILTRO VAI PARA PESQUISAS FEITAS PELA
        // BARRA DE PESQUISA DA TELA DE HOME
        if($type_filter == 'home_search'){
            
            // receber filtro escrito pelo usuário
            $filter_user = $_POST['filter_user'];
            
            // ! Filtros da pesquisa
            // Nome da ONG a partir do ID da Ong da vaga registrada
            // Apenas exibir vagas disponíveis
            // Busca do texto pelo nome da Ong
            // Busca do texto pelo nome da vaga
            // Busca do texto pelo nome da categoria

            $sql =  $base_sql; 
            $sql .= "AND ( ong.nome_ong LIKE '%$filter_user%' OR vaga.nome LIKE '%$filter_user%' OR vaga.categoria_vaga LIKE '%$filter_user%')";
            
            $result = return_select($sql);
            show_filter($result);
            

        // ! ESSE FILTRO VAI PARA PESQUISAS FEITAS PELOS
        // BOTÕES CONFIGURADOS NO HOME
        } else if ($type_filter == 'home_category'){
        
            $filter_user = $_POST['category_button'];

            $sql =  $base_sql;
            $sql .= "AND vaga.categoria_vaga LIKE '%$filter_user%'";
            
            $result = return_select($sql);
            show_filter($result);
        

        // ! ESSE FILTRO VAI PARA PESQUISAS FEITAS 
        // DIRETAMENTE A TELA DE FILTRO
        } else if($type_filter == 'filter_base'){


        // ! ESSE FILTRO VAI PARA PESQUISAS DE VAGAS SALVAS 
        // PELO VOLUNTÁRIO
        } else if($type_filter == 'save_filter'){


        // ! ESSE FILTRO VAI PARA PESQUISAS DE VAGAS CADASTRADAS 
        // PELO VOLUNTÁRIO
        } else if($type_filter == 'sign_filter'){


        }
    
        // ! ESSE FILTRO PESQUISA TODOS OS ITEMS
        // USADO APENAS AO BOTÃO "Pesquisa de Vaga" QUE DIRECIONA AO FILTRO
        // como não é acessivel via POST, ele é acessível por SESSION
    } else if(isset($_SESSION['nothing_else']) AND  $_SESSION['nothing_else']){

            // Não terá nenhuma condição extra além de vagas disponíveis
            // este filtro apenas funciona para introduz a tela de filtro direcionada por um botão
            
            $sql = $base_sql;
            
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

    }catch(PDOException) {
        echo "<script>window.alert('Não foi capaz de realizar o Filtro, tente outra hora');</script>";
        exit();
    }
}

// A FUNÇÃO fará a exibição dos resultados entregues á ela
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

function show_filter($result){

        // iniciar tentiva de consulta
        $numLinhas = count($result);

        if($numLinhas <= 0){
            echo "<h3>NENHUMA VAGA ENCONTRADA, PROCURE POR OUTRA</h3>";
            exit();
        }

        $plural_foi = "I";
        $plural_s = "";

        if($numLinhas > 1){
            $plural_s = "S";
            $plural_foi = "RAM";
        }
        echo "<h3>".$numLinhas. " VAGA".$plural_s." FO".$plural_foi." ENCONTRADA".$plural_s."</h3>";
        echo "<div class='scroll-wrapper'>";

        #exibição das vagas encontradas
        foreach($result as $user_result){
            // busca a imagem a partir da categoria da vaga
            $url = image_filter($user_result['categoria_vaga']);


          echo "<div class='vaga-card'>";

          echo "  <img src='$url' alt='Ícone' />";
          echo "  <div class='vaga-info'>";
          echo "    <h4>".$user_result['nome']."</h4>";
          echo "    <span>".$user_result['quant_atual']."/".$user_result['quant_limite']." • ".$user_result['nome_ong']."</span>";
          echo "    <p>".$user_result['descr_obj']."</p>";
          echo "  </div>";
          echo "</div>";
        }

        echo "</div>";
}

function pick_the_input_user(){

    if(isset($_POST['filter_user'])){

        return $_POST['filter_user'];

    } else{
        return '';
    }
}

?>
