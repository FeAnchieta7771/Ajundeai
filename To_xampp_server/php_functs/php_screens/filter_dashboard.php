<?php
include 'php_functs/php_db/methods.php';
// Função Principal
/////////////////////////////////////////////////////////////////////////
// ! Este arquivo está disposto a executar os filtros da tela "filter.php"
/////////////////////////////////////////////////////////////////////////
function Show_error($e){
    echo '<div class="engloba">';
    echo '<div class="vaga-card" style="background-color:rgb(222, 222, 222); border: none;">';
    echo "<img src='img/icons_orange/problem_data.png' alt='Ícone' />";
    echo '<div class="vaga-info">';
    echo '<h3>Ops! Ocorreu um erro ao conectar ao servidor.</h3>';
    echo '<p>Tente de novo mais tarde.</p>';
    // echo '<p>'.$e.'.</p>';
    echo '</div>';
    echo '<div class="vaga-extra" aria-label="Quantidade de candidatos">';
    echo '</div>';
    echo '</div>';
    exit();
}
function do_dashboard(){
    
    // apenas executa o código apenas se ele for chamado
    if ($_SERVER['REQUEST_METHOD'] == 'GET'){

        $id_ong = $_SESSION['id'];

        $sql = "SELECT vaga.*, ong.nome_ong FROM vaga JOIN ong ON ong.id = vaga.id_ong WHERE vaga.id_ong = ?";

        // pegue todas as vaga s que contenham o mesmo id da ong
        try{
            $result = select($sql,[$id_ong]);

        } catch (PDOException $e) {
            Show_error($e);
        }
        show_filter($result);

    }
}

// A FUNÇÃO fará a exibição dos resultados entregues á ela
function show_filter($result){

        // iniciar tentiva de consulta
        $numLinhas = count($result);

        if($numLinhas <= 0){
            echo '<div class="engloba">';
            echo '<div class="vaga-card" style="background-color:rgb(222, 222, 222); border: none;">';
            echo "<img src='img/icons_orange/nothing_happend.png' alt='Ícone' />";
            echo '<div class="vaga-info">';
            echo '<h3>Você ainda não criou nenhuma Vaga!</h3>';
            echo '<p>Clique no botão + para criar sua primeira vaga...</p>';
            echo '</div>';
            echo '<div class="vaga-extra" aria-label="Quantidade de candidatos">';
            echo '</div>';
            echo '</div>';

        } else{

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
?>