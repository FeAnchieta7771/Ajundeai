<?php
include 'php_functs/php_db/methods.php';

$allparams = [];
// Função Principal
/////////////////////////////////////////////////////////////////////////
// ! Este arquivo está disposto a executar os filtros da tela "filter.php"
/////////////////////////////////////////////////////////////////////////
function Show_error($e)
{
    $html = text_html_header_error();
    $html .= text_html_main_error($e);
    $html .= text_html_buttons_error();
    echo $html;
    exit();
}

function do_select($sql, $param = [])
{

    try {
        $result = select(null, $sql, $param);
        return $result;

    } catch (Throwable $e) {
        Show_error($e);
    }
}
function do_voluntary_searcher()
{
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // apenas executa o código apenas se ele for chamado
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {

        global $allparams;
        $allparams = [];

        $name_slot = $_GET['name_slot'];

        $sql = "SELECT nome_voluntario, id, categoria_trabalho, sobre FROM voluntario ";
        // nome, id do viado, categoria de trabalho, e deixa eu ver, o sobre
        // se não tiver algo do filtro, ele conta categoria do input de texto
        $sql = filter_base_checkbox($sql);
        // print($sql);
        // print_r($allparams);
        // echo $sql;
        // $result = return_select($sql);
                // echo $sql;
        $result = do_select($sql, $allparams);
        show_filter($result,$name_slot);

    }

}

// A FUNÇÃO fará a exibição dos resultados entregues á ela
function show_filter($result,$name_slot)
{

    // iniciar tentiva de consulta
    $numLinhas = count($result);

    if ($numLinhas <= 0) {
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

        $plural_foi = "L";
        $plural_s = "";

        if ($numLinhas > 1) {
            $plural_s = "S";
            $plural_foi = "IS";
        }
        echo "<div class='quantSlot'><h3>" . $numLinhas . " VOLUNTÁRIO" . $plural_s . " DISPONÍVE" . $plural_foi . " PARA A VAGA!</h3>";
        echo "</div><div class='scroll-wrapper'>";

        #exibição das vagas encontradas
        foreach ($result as $user_result) {
            // busca a imagem a partir da categoria da vaga
            $url = image_filter($user_result['categoria_trabalho']);

            echo "<form method='GET' action='../call_voluntary.php'>";
            echo "<input type='hidden' name='id_voluntario' value=" . $user_result['id'] . ">";
            echo "<input type='hidden' name='name_slot' value=" . $name_slot . ">";
            echo "<button class='vaga-card' type='submit'>";

            echo "<i class='bxs-user' ></i>";
            echo '<img src="'.$url.'" alt="Ícone" />';
            echo "<div class='vaga-info'>";
            echo "<h4>" . $user_result['nome_voluntario'] ."</h4>";
            echo "<span>Preferência: <strong>" . $user_result['categoria_trabalho'] . "</strong></span>";
            echo "<p>".$user_result['sobre']."</p>";
            echo " </div>";

            echo "</button>";
            echo "</form>";
            echo "</div>";
        }

        echo "</div>";
    }
}

// busca pelo caminho da imagem á ser mostrado na vaga
function image_filter($categoriaImagem)
{

    $categoriaImagem = strtolower($categoriaImagem);

    if (
        str_contains($categoriaImagem, "administração")
    ) {
        return "img/icons_blue/administracao.png";
    } elseif (
        str_contains($categoriaImagem, "animais")
    ) {
        return "img/icons_blue/animais.png";
    } elseif (
        str_contains($categoriaImagem, "assistência")
    ) {
        return "img/icons_blue/assistencia.png";
    } elseif (
        str_contains($categoriaImagem, "crianças")
    ) {
        return "img/icons_blue/criancas.png";
    } elseif (
        str_contains($categoriaImagem, "educação")
    ) {
        return "img/icons_blue/educacao.png";
    } elseif (
        str_contains($categoriaImagem, "eventos")
    ) {
        return "img/icons_blue/eventos.png";
    } elseif (
        str_contains($categoriaImagem, "meio ambiente")
    ) {
        return "img/icons_blue/meio_ambiente.png";
    } elseif (
        str_contains($categoriaImagem, "saúde")
    ) {
        return "img/icons_blue/saude.png";
    } elseif (
        str_contains($categoriaImagem, "tecnologia")
    ) {
        return "img/icons_blue/tecnologia.png";
    } else {
        return "img/icons_blue/outro.png";
    }
}

// retorna o sql completo para a pesquisa segundo os filtros e a barra de pesquisa
function filter_base_checkbox($sql)
{
    global $allparams;
    $quant_filter = 0;

    $sql .= "WHERE ";

    if (isset($_GET["manha"])) {
        $quant_filter += 1;
        $sql .= "voluntario.periodo LIKE ? OR ";
        $allparams[] = '%manha%';
    }

    if (isset($_GET["tarde"])) {
        $quant_filter += 1;
        $sql .= "voluntario.periodo LIKE ? OR ";
        $allparams[] = '%tarde%';
    }

    if (isset($_GET["noite"])) {
        $quant_filter += 1;
        $sql .= "voluntario.periodo LIKE ? OR ";
        $allparams[] = '%noite%';
    }

    if (isset($_GET["madrugada"])) {
        $quant_filter += 1;
        $sql .= "voluntario.periodo LIKE ? OR ";
        $allparams[] = '%madrugada%';
    }

    if (isset($_GET["integral"])) {
        $quant_filter += 1;
        $sql .= "voluntario.periodo LIKE ? OR ";
        $allparams[] = '%integral%';
    }

    if (isset($_GET["estudante-F"])) {
        $quant_filter += 1;
        $sql .= "voluntario.estado_social LIKE ? OR ";
        $allparams[] = '%Estudante Fundamental%';
    }

    if (isset($_GET["estudante-M"])) {
        $quant_filter += 1;
        $sql .= "voluntario.estado_social LIKE ? OR ";
        $allparams[] = '%Estudante Médio%';
    }

    if (isset($_GET["formado"])) {
        $quant_filter += 1;
        $sql .= "voluntario.estado_social LIKE ? OR ";
        $allparams[] = '%Formado%';
    }
    
    if (isset($_GET["universitário"])) {
        $quant_filter += 1;
        $sql .= "voluntario.estado_social LIKE ? OR ";
        $allparams[] = '%Estudante Universitário%';
    }
    
    if (isset($_GET["empregado"])) {
        $quant_filter += 1;
        $sql .= "voluntario.estado_social LIKE ? OR ";
        $allparams[] = '%Empregado%';
    }
    
    if (isset($_GET["aposentado"])) {
        $quant_filter += 1;
        $sql .= "voluntario.estado_social LIKE ? OR ";
        $allparams[] = '%Aposentado%';
    }

    if ($quant_filter > 0) {

        // remoção do OR restante
        $sql = substr($sql, 0, strlen($sql) - 3);

        if (isset($_GET["categoria_trabalho"])) {
            $sql .= " ORDER BY CASE WHEN voluntario.categoria_trabalho = ? THEN 1 ELSE 2 END";
            $allparams[] = $_SESSION['categoria_vaga'];
        }

        $allparams = array_values($allparams);


    } else if ($quant_filter == 0) {
        // remoção do WHERE restante
        $sql = substr($sql, 0, strlen($sql) - 6);
    }

    return $sql;
}
?>