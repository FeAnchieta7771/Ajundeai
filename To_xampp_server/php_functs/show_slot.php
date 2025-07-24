<?php
// Função Principal
/////////////////////////////////////////////////////////////////////////
// ! Este arquivo está disposto a executar os filtros da tela "filter.php"
/////////////////////////////////////////////////////////////////////////
function do_slot(){

    // apenas executa o código apenas se ele for chamado
    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
        
        include 'conexao.php';

        $type_filter = $_GET['type'];
        $id = $_GET['id_vaga'];
        // echo $id;

    ////////////////////////////////////////////////////////////////////
    
    // ! ESSE FILTRO VAI PARA PESQUISAS FEITAS PELA

        // @exibição da vaga ao voluntário
        if($type_filter == 'filter_base'){
            
            // receber filtro escrito pelo usuário
            $filter_user = $_GET['filter_user'];

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

    $sql_register = "SELECT * FROM registro WHERE id = ".$id_vaga." AND id_voluntario = ".$id_user;
    $result_register = return_select($sql_register);

    if( !empty($result_register) AND $result_register[0]['categoria_registro'] == 'cadastrado'){
        // como o usuário está cadastrado, o número de vagas é irrelevante

        $sql = $sql = "SELECT vaga.*, ong.nome_ong FROM vaga JOIN ong ON ong.id = vaga.id_ong WHERE id = ".$id_vaga;
        $result = return_select($sql);

        $html = text_html_header($result[0]['nome'],$result[0]['nome_ong']);

        $html .= text_html_main($result[0]['quant_atual'], $result[0]['quant_limite'],$result[0]['descr_total']);


        // usuário em cadastro possui três estados, logo três opções de botões
        switch($result_register[0]['situacao']){
            case 'aguarde':
                $html .= text_html_buttons('[MODELO DE BOTÃO EM AGUARDE]', $result[0]['localizacao']);
                break;
            case 'aprovado':
                $html .= text_html_buttons('[MODELO DE BOTÃO EM APROVAÇÃO]', $result[0]['localizacao']);
                break;
            case 'negado':
                $html .= text_html_buttons('[MODELO DE BOTÃO EM NEGAÇÃO]', $result[0]['localizacao']);
                break;
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

     $sql = "SELECT vaga.*, ong.nome_ong FROM vaga JOIN ong ON ong.id = vaga.id_ong WHERE vaga.id = ".$id_vaga;
    // echo $sql_vaga;

    $result_slot = return_select($sql);

    // Pesquisa de voluntários que se cadastraram a vaga
    // Requisitos: Nome do voluntário e seu estado de aprovação

    // priorização dos voluntários em aguarde de resposta, depois os aprovados, em último os negados
    $sql = "SELECT voluntario.nome_voluntario, registro.situacao FROM registro JOIN voluntario ON registro.id_voluntario = voluntario.id 
    WHERE registro.id_vaga = $id_vaga AND registro.categoria_registro = 'cadastrado'  
    ORDER BY CASE WHEN registro.situacao = 'aguarde' THEN 1 WHEN registro.situacao = 'aprovado' THEN 2 ELSE 3 END";

    $result_register = return_select($sql);

    // Exibição final dos resultados
    // Exibição dos valores da vaga pelo @result_slot
    $html = text_html_header($result_slot[0]['nome'],$result_slot[0]['nome_ong']);
    $html .= text_html_main($result_slot[0]['quant_atual'], $result_slot[0]['quant_limite'],$result_slot[0]['descr_total']);

    echo $html;
    // Exibição dos valores da vaga pelo @result_register
    text_html_voluntarys($result_register);
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
        $html = text_html_header_error();
        $html .= text_html_main_error($e);
        $html .= text_html_buttons_error();
        echo $html;
        exit();
    }
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
    echo "<h4><i class='bx  bx-contact-book' style='font-size: 35px;'></i> VOLUNTARIOS</h4>";
    echo '<div class="fixa-scroll">';

    if($numLinhas == 0){
        echo '<div class="fixa"><p>Nenhum voluntário se inscreveu na Vaga ainda...</p><br><br></div></div></div></div></main>';
        exit();
    }

    foreach($result_register as $voluntarys){
        echo '<div class="fixa">
            <i class="bx bxs-user"></i>
            <div class="fixa-buton">
            <form method="GET" action="...">
            <button class="voluntario-btn">'.htmlspecialchars($voluntarys['nome_voluntario']).'</button>
            </form>
            </div>
            <span class="status-aguarde">';

            if($voluntarys['situacao'] == 'aguarde'){
                echo 'EM '.strtoupper($voluntarys['situacao']).'</span>';

            } else{

                echo strtoupper($voluntarys['situacao']).'</span>';
            }
            echo '</div>';
    }
    echo '</div></div></div></main>';
}

function user_not_logged($is_logged, $id_vaga){
    //quando usuario nao esta logado, id nao existe
    // dependente da quantidade de pessoas na vaga
    // → Lotado: Mensagem de lotado
    // → Livre: exigição da vaga


    $sql_vaga = "SELECT vaga.*, ong.nome_ong FROM vaga JOIN ong ON ong.id = vaga.id_ong WHERE vaga.id = ".$id_vaga;
    // echo $sql_vaga;
    $result = return_select($sql_vaga);
//     echo "<pre>";
// print_r($result);
// echo "</pre>";
    
    $html = text_html_header($result[0]['nome'],$result[0]['nome_ong']);

    $html .= text_html_main($result[0]['quant_atual'], $result[0]['quant_limite'],$result[0]['descr_total']);

    if( !empty($result) AND $result[0]['quant_atual'] == $result[0]['quant_limite']){
        // falta o botao para quando o estiver lotado.
        $html .= text_html_buttons('[MODELO DE BOTÃO LOTADA]', $result[0]['localizacao']);
    }

    else{

        if($is_logged){
            $html .= text_html_buttons('[MODELO DE BOTÃO SALVO]', $result[0]['localizacao']);
        }
        // está livre
        $html .= text_html_buttons('[MODELO DE BOTÃO PADRÃO]', $result[0]['localizacao']);
    }
    echo $html;
}

?>


<!-- MOSTRAR VAGA
- nome
- NOME DA ong
- dESCRIÇÃO TOTAL
- numero de pessoas
  = número de vaga é importante na verificação quando está slaov ou livre

- BOTÕES
  = cadastrar salvar
  = cadastrar desalvar
  = cancelar envio (icone de aguarde)
  = aprovado
  = negado

- localização -->