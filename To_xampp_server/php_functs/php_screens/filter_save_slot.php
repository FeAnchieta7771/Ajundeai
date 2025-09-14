<?php
include 'php_functs/php_db/methods.php';

$allparams = [];
// Função Principal
/////////////////////////////////////////////////////////////////////////
// ! Este arquivo está disposto a executar os filtros da tela "filter.php"
/////////////////////////////////////////////////////////////////////////
function Show_error(){
    echo "<div class='quantSlot'>
        <h3>ERRO AO SERRVIDOR</h3></div>";
    echo "<div class='scroll-wrapper'>";
    echo "<div class='vaga-card' style='background-color:rgb(222, 222, 222); border: none;'>";

    echo "  <img src='img/icons_orange/problem_data.png' alt='Ícone' />";
    echo "  <div class='vaga-info'>";
    echo "    <h3 style='display: flex;'>Infelizmente, ocorreu um erro ao servidor.</h3>";
    echo "    <span>Tente novamente mais tarde.</span>";
    echo "  </div>";
    echo "</div>";
    echo "</div>";
    exit();
}

function do_select($sql, $param = []){

    try{
        $result = select(null,$sql, $param);
        return $result;

    } catch (Throwable $e) {
        Show_error();
    }
}
function do_filter_save_slot(){
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // TODO filtro tem a mesma base de pesquisas, sendo apenas condições diferentes
    // variável constante nas buscas sql
    $base_sql = "SELECT vaga.*, ong.nome_ong
                FROM registro
                JOIN vaga ON registro.id_vaga = vaga.id
                JOIN ong  ON ong.id = vaga.id_ong
                WHERE registro.id_voluntario = ? AND registro.categoria_registro = 'salvo' ";
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    // apenas executa o código apenas se ele for chamado
    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
        
        global $allparams;
        $allparams = [];

        $sql =  $base_sql;

        // se não tiver algo do filtro, ele conta categoria do input de texto
        $sql = filter_base_save_checkbox($sql);
        // print($sql);
        // print_r($allparams);
        // echo $sql;
        // $result = return_select($sql);
        $allparams[] = $_SESSION['id'];
        $result = do_select($sql,$allparams);
        show_filter($result);

    } else {

        $result = do_select($base_sql,[$_SESSION['id']]);
        show_filter($result);
    }

    ////////////////////////////////////////////////////////////////////
}


// A FUNÇÃO fará a exibição dos resultados entregues á ela
function show_filter($result){

        // iniciar tentiva de consulta
        $numLinhas = count($result);

        if($numLinhas <= 0){

            // echo "<div class='scroll-wrapper'> 
            //   <forms>
            //     <div class='engloba'>
            //         <div class='vaga-card'>
            //             <img src='img\icons_orange\outro.png' alt='Ícone' />
            //             <div class='vaga-info'>
            //                 <h4>NOME DA VAGA</h4>
            //                 <span>5/10 • Nome da ONG</span>
            //                 <p>Descrição pequena que está dentro do banco que o Guilherme
            //                     inda tem que fazer e passar o arquivo pra mim.</p>
            //             </div>
            //         </div>

            //         <button class='btn-azul'><i class='bx bxs-bookmark'></i></button>
            //     </div>
            //   </forms>

            // </div>";
            
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
        } else {

            $plural_s = "";

            if($numLinhas > 1){
                $plural_s = "S";
            }
            echo "<div class='quantSlot'><h3 style='color: #2289e6;'>PAINEL DE VAGAS SALVAS  •  ".$numLinhas. " VAGA".$plural_s."</h3>";
            echo "</div><div class='scroll-wrapper'>";

            #exibição das vagas encontradas
            foreach($result as $user_result){
                // busca a imagem a partir da categoria da vaga
                $url = image_filter($user_result['categoria_vaga']);
            
                echo "<form method='GET' action='../show_slot_voluntary.php'>";
                echo "<input type='hidden' name='type' value='filter_base'>";
                echo "<input type='hidden' name='id_vaga' value=".$user_result['id'].">";
                echo "<div class='vaga-wrapper'><button type='submit' class='slot'>";
                echo "     
                                <div class='vaga-card'>";
                echo "              <img src=$url alt='Ícone' />
                                    <div class='vaga-info'>";
                echo "                  <h4>".$user_result['nome']."</h4>
                                        <span>".$user_result['quant_atual']."/".$user_result['quant_limite']." • ".$user_result['nome_ong']."</span>
                                        <p>".$user_result['descr_obj']."</p>
                                    </div>
                                </div>
                                </button>";
                     
                echo"       <button class='btn-azul'><i class='bx bxs-bookmark'></i></button>";
                echo "</div></div>";
                
            // echo "<div class='vaga-card'>";
            
            // echo "<form method='GET' action='../show_slot_voluntary.php'>";
            // echo "<input type='hidden' name='type' value='filter_base'>";
            // echo "<input type='hidden' name='id_vaga' value=".$user_result['id'].">";
            // echo "<button type='submit'>";
            // echo "  <img src='$url' alt='Ícone' />";
            // echo "  <div class='vaga-info'>";
            // echo "    <h4 style='font-family: 'Horizon', sans-serif;'><a style='text-decoration: none'>".$user_result['nome']."</a></h4>";
            // echo "    <span><i class='bx bxs-user' style='font-size: 20px;'></i> ".$user_result['quant_atual']."/".$user_result['quant_limite']." • ".$user_result['nome_ong']."</span>";
            // echo "    <p>".$user_result['descr_obj']."</p>";
            // echo "  </div>";
            // echo "</button>";
            // echo "</form>";
            // echo "</div>";
            }

            echo "</div>";
        }
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
function filter_base_save_checkbox($sql){
            global $allparams;
            $quant_filter = 0;

            function add_components($quant_filter){
                if($quant_filter == 0){
                    return "AND (";
                } else {
                    return "";
                }
            }

            if(isset($_GET["saúde"]))
            {
                $sql .= add_components($quant_filter);
                $quant_filter += 1;
                $sql .= "vaga.categoria_vaga LIKE ? OR ";
                $allparams[] = '%saúde%';
            }

            if(isset($_GET["eventos"]))
            {
                $sql .= add_components($quant_filter);
                $quant_filter += 1;
                $sql .= "vaga.categoria_vaga LIKE ? OR ";
                $allparams[] = '%eventos%';
            }

            if(isset($_GET["animais"]))
            {
                $sql .= add_components($quant_filter);
                $quant_filter += 1;
                $sql .= "vaga.categoria_vaga LIKE ? OR ";
                $allparams[] = '%animais%';
            }

            if(isset($_GET["crianças"]))
            {
                $sql .= add_components($quant_filter);
                $quant_filter += 1;
                $sql .= "vaga.categoria_vaga LIKE ? OR ";
                $allparams[] = '%crianças%';
            }

            if(isset($_GET["educação"]))
            {
                $sql .= add_components($quant_filter);
                $quant_filter += 1;
                $sql .= "vaga.categoria_vaga LIKE ? OR ";
                $allparams[] = '%educação%';
            }

            if(isset($_GET["tecnologia"]))
            {
                $sql .= add_components($quant_filter);
                $quant_filter += 1;
                $sql .= "vaga.categoria_vaga LIKE ? OR ";
                $allparams[] = '%tecnologia%';
            }

            if(isset($_GET["assistencia"]))
            {
                $sql .= add_components($quant_filter);
                $quant_filter += 1;
                $sql .= "vaga.categoria_vaga LIKE ? OR ";
                $allparams[] = '%assistencia%';
            }

            if(isset($_GET["administração"]))
            {
                $sql .= add_components($quant_filter);
                $quant_filter += 1;
                $sql .= "vaga.categoria_vaga LIKE ? OR ";
                $allparams[] = '%administração%';
            }

            if(isset($_GET["meio_ambiente"]))
            {
                $sql .= add_components($quant_filter);
                $quant_filter += 1;
                $sql .= "vaga.categoria_vaga LIKE ? OR ";
                $allparams[] = '%meio ambiente%';
            }


            
            if($quant_filter > 0){
                
                // remoção do OR restante
                $sql = substr($sql, 0, strlen($sql) - 3); 
                $sql .= ")";
            }

            return $sql;
}
?>