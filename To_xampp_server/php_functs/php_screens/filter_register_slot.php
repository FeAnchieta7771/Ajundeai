<?php
include 'php_functs\php_db\methods.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Função Principal
/////////////////////////////////////////////////////////////////////////
// ! Este arquivo está disposto a executar os filtros da tela "filter.php"
/////////////////////////////////////////////////////////////////////////
function Show_error($e){
    $html = text_html_header_error();
        $html .= text_html_main_error($e);
        $html .= text_html_buttons_error();
        echo $html;
        exit();
}

function do_select($sql, $param = []){

    try{
        $result = select(null,$sql, $param);
        return $result;

    } catch (PDOException $e) {
        Show_error($e);
    }
}   
    function do_filter_registered_slots() {
    $sql = "SELECT vaga.*, ong.nome_ong, registro.situacao FROM vaga JOIN registro ON registro.id_vaga = vaga.id JOIN ong ON ong.id = vaga.id_ong WHERE registro.id_voluntario = ? AND registro.categoria_registro = 'cadastrado'";
    $result = do_select($sql, [$_SESSION['id']]);

    show_registered_slots($result);
}
// ... seu código acima ...

function show_registered_slots($result) {
    $numLinhas = count($result);

    if ($numLinhas <= 0) {
        // Mensagem quando o voluntário não tem vagas cadastradas
        echo "<div class='quantSlot'><h3>VOCÊ NÃO ESTÁ CADASTRADO EM NENHUMA VAGA</h3></div>";
        echo "<div class='scroll-wrapper'>";
        echo "<div class='vaga-card' style='background-color:rgb(222, 222, 222); border: none;'>";
        echo "  <img src='img/icons_orange/not_found.png' alt='Ícone' />";
        echo "  <div class='vaga-info'>";
        echo "    <h3 style='display: flex;'>Você ainda não se candidatou para nenhuma vaga.</h3>";
        echo "    <span>Acesse a tela de filtro para encontrar oportunidades!</span>";
        echo "  </div>";
        echo "</div>";
        echo "</div>";

    } else {
        $plural_s = ($numLinhas > 1) ? "S" : "";
        $plural_foi = ($numLinhas > 1) ? "RAM" : "I";
        echo "<div class='quantSlot'><h3>VOCÊ SE CADASTROU EM ".$numLinhas. "/3 VAGA".$plural_s." PERMITIDAS!</h3></div>";
        echo "<div class='scroll-wrapper'>";

        foreach ($result as $vaga) {
            $url = image_filter($vaga['categoria_vaga']);

            // Variáveis para o botão de status
            $button_class = '';
            $icon_class = '';
            
            // Definição do botão e ícone com base no status
            switch ($vaga['situacao']) {
                case 'aprovado':
                    $button_class = 'btn-verde';
                    $icon_class = 'bx bx-check';
                    break;
                case 'aguarde':
                    $button_class = 'btn-preto';
                    $icon_class = 'bx bxs-hourglass';
                    break;
                case 'negado':
                    $button_class = 'btn-vermelho';
                    $icon_class = 'bx bx-x';
                    break;
                default:
                    // Caso o status seja 'nada' ou outro valor
                    $button_class = 'btn-cinza';
                    $icon_class = 'bx bxs-info-circle';
                    break;
            }
            
            echo "<form method='GET' action='../show_slot_voluntary.php'>";
            echo "  <input type='hidden' name='id_vaga' value='".$vaga['id']."'>";
            echo "<input type='hidden' name='type' value='filter_base'>";
            echo "  <div class='vaga-wrapper'>"; // Contêiner flexível para o card e o botão de status
            echo "    <button type='submit' class='slot'>"; // Botão que envolve o card para tornar tudo clicável
            echo "      <div class='vaga-card'>";
            echo "        <img src='$url' alt='Ícone' />";
            echo "        <div class='vaga-info'>";
            echo "          <h4>".$vaga['nome']."</h4>";
            echo "          <span><i class='bx bxs-user'></i> ".$vaga['quant_atual']."/".$vaga['quant_limite']." • ".$vaga['nome_ong']."</span>";
            echo "          <p>".$vaga['descr_obj']."</p>";
            echo "        </div>";
            echo "      </div>";
            echo "    </button>";
            echo "    <button type='button' class='btn-azul ".$button_class."'>"; // Botão de status separado
            echo "      <i class='".$icon_class."'></i>";
            echo "    </button>";
            echo "  </div>";
            echo "</form>";
        }
        echo "</div>";
    }
}
// essa bosta de TCC ta me deixando maluco das ideia AAAAAAAAAAAAAAAAAAAAAAA
// auxiliar para definir a cor do status
function get_status_color($status) {
    switch ($status) {
        case 'aprovado':
            return 'green';
        case 'aguarde':
            return 'black';
        case 'negado':
            return 'red';
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

?>