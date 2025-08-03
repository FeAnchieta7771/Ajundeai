<?php

include '../php_db/methods.php';
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
        $result = select($sql, $param);
        return $result;

    } catch (PDOException $e) {
        Show_error($e);
    }
}

function button_types($type_button){
    /*
    Devolução do botão html pedido

    Parametros: $type_button
    - basic: normal para enviar currículo e salvar
    - saved: normal para enviar currículo e dessalvar
    - submited: currículo mandado, esperando resposta
    - aproved: a ONG aprovou o currículo
    - denied: a ONG negou o currículo
    - busy: a vaga lotou

    Retorno: Retorna o código HTML do botão escolhido

    */
    // ! TERMINAR DE AJEITAR ISSO !!!
    switch($type_button){
        case "basic":
          return '
                <input type="hidden" name="button_slot" value="send_button">
                <input type="hidden" name="id_vaga" value="'.$_GET['id_vaga'].'">
                <button class="btn-curriculo">ENVIAR CURRÍCULO</button>
            </form>
            <form method="POST" action="php_functs/button_functions.php">
                <input type="hidden" name="button_slot" value="save_button">
                <input type="hidden" name="id_vaga" value="'.$_GET['id_vaga'].'">
                <button class="btn-icon-salvar"><i class="bx bxs-bookmark"></i></button>
            </form>';
            
        
        case "saved":
            return ' 
            <input type="hidden" name="button_slot" value="send_button">
            <input type="hidden" name="id_vaga" value="'.$_GET['id_vaga'].'">
            <input type="hidden" name="login_state" value="voluntario">
            <button class="btn-curriculo">ENVIAR CURRÍCULO</button>
            </form>
            <form method="POST" action="php_functs/button_functions.php">
            <input type="hidden" name="id_vaga" value="'.$_GET['id_vaga'].'">
            <input type="hidden" name="button_slot" value="unsave_button">
            <button class="btn-icon-desalvar"><i class="bx bxs-bookmark"></i></button>
            </form>';

        case "submited":
            return '
            <input type="hidden" name="button_slot" value="unsend_button">          
            <input type="hidden" name="id_vaga" value="'.$_GET['id_vaga'].'">
            <button class="btn-curriculo" style="background-color: #003e53;">CANCELAR ENVIO</button>
            </form>
            <button class="btn-icon-aguarde"><i class="bx bxs-hourglass"></i></button>';

        case "aproved":
            return '</form><button class="btn-curriculo-aceito">APROVADO PARA VAGA!</button>';

        case "denied":
            return '</form><button class="btn-curriculo-negado">NEGADO PARA VAGA...</button>';
        
        case "busy":
            return '</form><button class="btn-curriculo-lotado">VAGA LOTADA</button>';

    }
}

function do_slot(){

    // apenas executa o código apenas se ele for chamado
    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
        

        $type_filter = $_GET['type'];
        $id = $_GET['id_vaga'];
    ////////////////////////////////////////////////////////////////////
    
    // ! ESSE FILTRO VAI PARA PESQUISAS FEITAS PELA

        // @exibição da vaga ao voluntário
        if($type_filter == 'filter_base'){

            if(isset($_SESSION['id'])){

                do_slot_with_user_logged($id, $_SESSION['id']);

            } else{
                user_not_logged(false, $id);
                
            }
            
        } else if($type_filter == 'filter_ctrl'){
            // @exibição da vaga a ONG
            do_slot_to_ong($id);
        }
}
}

function do_slot_with_user_logged($id_vaga, $id_user){

    $result_register = do_select("SELECT * FROM registro WHERE id_vaga = ? AND id_voluntario = ?",[$id_vaga,$id_user]);

    if( !empty($result_register)){
        // como o usuário está cadastrado, o número de vagas é irrelevante

        $result = do_select("SELECT vaga.*, ong.nome_ong FROM vaga JOIN ong ON ong.id = vaga.id_ong WHERE vaga.id = ?",[$id_vaga]);

        // print_r($result);
        // echo '<br>';
        // print_r($result_register);

        $html = text_html_header($result[0]['nome'],$result[0]['nome_ong']);

        $html .= text_html_main($result[0]['quant_atual'], $result[0]['quant_limite'],$result[0]['descr_total']);

        if($result_register[0]['categoria_registro'] == 'cadastrado'){
            // usuário em cadastro possui três estados, logo três opções de botões
            switch($result_register[0]['situacao']){
                case 'aguarde':
                    $status_button = button_types('submited');
                    $html .= text_html_buttons($status_button, $result[0]['localizacao']);
                    break;
                case 'aprovado':
                    $status_button = button_types('aproved');
                    $html .= text_html_buttons($status_button, $result[0]['localizacao']);
                    break;
                case 'negado':
                    $status_button = button_types('denied');
                    $html .= text_html_buttons($status_button, $result[0]['localizacao']);
                    break;
            }

        } else if($result_register[0]['categoria_registro'] == 'salvo'){

            $status_button = button_types('saved');
            $html .= text_html_buttons($status_button, $result[0]['localizacao']);            
        }
        
        echo $html;
        
    } else if( !empty($result_register) AND $result_register[0]['categoria_registro'] == 'salvo'){
        
        user_not_logged(true, $id_vaga);
    } else {
        
        user_not_logged(false, $id_vaga);
    }

}

// função de exibição de vaga a ONG
// Param:
//    @id_vaga: identificação de qual vaga foi aberta

// Retorno:
//    -> Exibição da descrição, número de cadastrados, nome da vaga
//    -> Exibição dos cadastrados integrados a um botão para que possam ser:
//        = aprovados
//        = negados
function do_slot_to_ong($id_vaga){

     $sql = "SELECT vaga.*, ong.nome_ong FROM vaga JOIN ong ON ong.id = vaga.id_ong WHERE vaga.id = ?";

    $result_slot = do_select($sql, [$id_vaga]);

    // Pesquisa de voluntários que se cadastraram a vaga
    // Requisitos: Nome do voluntário e seu estado de aprovação

    // priorização dos voluntários em aguarde de resposta, depois os aprovados, em último os negados
    $sql = "SELECT voluntario.nome_voluntario, registro.situacao FROM registro JOIN voluntario ON registro.id_voluntario = voluntario.id 
    WHERE registro.id_vaga = ? AND registro.categoria_registro = 'cadastrado'  
    ORDER BY CASE WHEN registro.situacao = 'aguarde' THEN 1 WHEN registro.situacao = 'aprovado' THEN 2 ELSE 3 END";

    $result_register = do_select($sql,[$id_vaga]);

    // Exibição final dos resultados
    // Exibição dos valores da vaga pelo @result_slot
    $html = text_html_header($result_slot[0]['nome'],$result_slot[0]['nome_ong']);
    $html .= text_html_main($result_slot[0]['quant_atual'], $result_slot[0]['quant_limite'],$result_slot[0]['descr_total']);

    echo $html;
    // Exibição dos valores da vaga pelo @result_register
    text_html_voluntarys($result_register);
}

function text_html_header($name_vaga, $name_ong){
    return '<header class="header2">
          <img src="img\office-building.png" alt="Ícone" class="vaga-name-img"/>
            <div class="vaga-name">
            <h4>'.htmlspecialchars($name_vaga).'</h4>
            <span>'.htmlspecialchars($name_ong).'</span>
            </div>
            </header>';
}

function text_html_header_error(){
    return '<header class="header2">
          <img src="img\error_db_white.png" alt="Ícone" class="vaga-name-img"/>
            <div class="vaga-name">
            <h4>ERRO AO PROCURAR NO SERVIDOR</h4>
            <span>TENTE DE NOVO MAIS TARDE</span>
            </div>
            </header>';
}
function text_html_main($num_vaga_atual, $num_vagas_total, $description){
    return '    <main class="vaga-container">
      <div class="vaga-descricao">
        <h3 class="vaga-descricao-titulo">DESCRIÇÃO DA VAGA <div><i class="bx bxs-user" ></i> '.$num_vaga_atual.'/'.$num_vagas_total.'</div> </h3>
        <p class="vaga-descricao-texto">
          '.htmlspecialchars($description).'
        </p>
      </div>';
}

function text_html_main_error($description){
    return '    <main class="vaga-container">
      <div class="vaga-descricao">
        <h3 class="vaga-descricao-titulo">ERRO DE SERVIDOR </h3>
        <p class="vaga-descricao-texto">
          '.$description.'
        </p>
      </div>';
}

function text_html_buttons($buttons, $location){
    return       '<div class="vaga-lateral">
        <div class="card-curriculo">
        <form method="POST" action="php_functs/button_functions.php">
          '.$buttons.'
        </div>
        <div class="vaga-localizacao">
          <h4>LOCALIZAÇÃO</h4>
          <p><em>'.$location.'</em></p>
        </div>
      </div>

    </main>';
}

function text_html_buttons_error(){
    return       '<div class="vaga-lateral">
        <div class="card-curriculo">
        </div>
      </div>

    </main>';
}

//Retorno: exibição dinâmica dos voluntários cadastrados á vaga
function text_html_voluntarys($result_register){

    $numLinhas = count($result_register);

    echo '<div class="vaga-lateral"><div class="voluntarios">';
    echo "<h4><i class='bx  bx-contact-book' style='font-size: 35px;'></i> VOLUNTARIOS</h4><br>";
    echo '<div class="fixa-scroll">';

    if($numLinhas == 0){
        echo '<div class="fixa"><p>Nenhum voluntário se inscreveu na Vaga ainda...</p><br><br></div></div></div></div></main>';
        exit();
    }

    foreach($result_register as $voluntarys){
        echo '<div class="fixa">
            <form method="GET" action="analysis_voluntary_ong.php">
            <button class="voluntario-btn">
            <div class="fixa-buton">
            <i class="bx bxs-user"></i>
            <p class="voluntario-btn">'.htmlspecialchars($voluntarys['nome_voluntario']).'</button>    
            <br>                                                                     
            <span class="status-'.$voluntarys['situacao'].'">';

            if($voluntarys['situacao'] == 'aguarde'){
                echo 'EM '.strtoupper($voluntarys['situacao']).'</span>';

            } else{

                echo strtoupper($voluntarys['situacao']).'</span>';
            }
            echo '</button></form></div></div>';
    }
    echo '</div></div></div></main>';
}

function user_not_logged($is_logged, $id_vaga){
    //quando usuario nao esta logado, id nao existe
    // dependente da quantidade de pessoas na vaga
    // → Lotado: Mensagem de lotado
    // → Livre: exigição da vaga


    $sql_vaga = "SELECT vaga.*, ong.nome_ong FROM vaga JOIN ong ON ong.id = vaga.id_ong WHERE vaga.id = ?";
    $result = do_select($sql_vaga,[$id_vaga]);

    
    $html = text_html_header($result[0]['nome'],$result[0]['nome_ong']);

    $html .= text_html_main($result[0]['quant_atual'], $result[0]['quant_limite'],$result[0]['descr_total']);

    if( !empty($result) AND $result[0]['quant_atual'] == $result[0]['quant_limite']){
        // falta o botao para quando o estiver lotado.
        $status_button = button_types('busy');
        $html .= text_html_buttons($status_button, $result[0]['localizacao']);
    }

    else{

        if($is_logged){
            $status_button = button_types('saved');
            $html .= text_html_buttons($status_button, $result[0]['localizacao']);
        }
        // está livre
        $status_button = button_types('basic');
        $html .= text_html_buttons($status_button, $result[0]['localizacao']);
    }
    echo $html;
}

?>