<?php
// Função Principal
/////////////////////////////////////////////////////////////////////////
// ! Este arquivo está disposto a executar os filtros da tela "filter.php"
/////////////////////////////////////////////////////////////////////////
function do_slot(){

    // apenas executa o código apenas se ele for chamado
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        include 'conexao.php';
        $type_filter = $_POST['type'];
        $id = $_POST['id_vaga'];
        echo $id;

    ////////////////////////////////////////////////////////////////////
    
    // ! ESSE FILTRO VAI PARA PESQUISAS FEITAS PELA
        // BARRA DE PESQUISA DA TELA DE HOME
        if($type_filter == 'filter_base'){
            
            // receber filtro escrito pelo usuário
            $filter_user = $_POST['filter_user'];

            if(isset($_SESSION['id'])){

                do_slot_with_user_logged($id, $_SESSION['id']);

            } else{
                user_not_logged(false, $id);
                
            }
            
        } 
}
}

function do_slot_with_user_logged($id_vaga, $id_user){

    $sql_register = "SELECT * FROM registro WHERE id = ".$id_vaga." AND id_voluntario = ".$id_user;
    $result_register = return_select($sql_register);

    if( isset($result_register) AND $result_register['categoria_registro'] == 'cadastrado'){
        // como o usuário está cadastrado, o número de vagas é irrelevante

        $sql = $sql = "SELECT vaga.*, ong.nome_ong FROM vaga JOIN ong ON ong.id = vaga.id_ong WHERE id = ".$id_vaga;
        $result = return_select($sql);

        $html = text_html_header($result['nome'],$result['nome_ong']);

        $html .= text_html_main($result['quant_atual'], $result['quant_limite'],$result['descr_total']);


        // usuário em cadastro possui três estados, logo três opções de botões
        switch($result_register['situacao']){
            case 'aguarde':
                $html .= text_html_buttons('[MODELO DE BOTÃO EM AGUARDE]', $result['localizacao']);
                break;
            case 'aprovado':
                $html .= text_html_buttons('[MODELO DE BOTÃO EM APROVAÇÃO]', $result['localizacao']);
                break;
            case 'negado':
                $html .= text_html_buttons('[MODELO DE BOTÃO EM NEGAÇÃO]', $result['localizacao']);
                break;
        }
        
        echo $html;
        
    } else {
        user_not_logged(true, $id_vaga);
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
    }
}

function text_html_header($name_vaga, $name_ong){
    return '<header class="header2">
          <img src="img\office-building.png" alt="Ícone" class="vaga-name-img"/>
            <div class="vaga-name">
            <h4>'.$name_vaga.'</h4>
            <span>'.$name_ong.'</span>
            </div>
            </header>';
}

function text_html_main($num_vaga_atual, $num_vagas_total, $description){
    return '    <main class="vaga-container">
      <div class="vaga-descricao">
        <h3 class="vaga-descricao-titulo">DESCRIÇÃO DA VAGA <div><i class="bx bxs-user" ></i> '.$num_vaga_atual.'/'.$num_vagas_total.'</div> </h3>
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

function user_not_logged($is_logged, $id_vaga){
    //quando usuario nao esta logado, id nao existe
    // dependente da quantidade de pessoas na vaga
    // → Lotado: Mensagem de lotado
    // → Livre: exigição da vaga


    $sql_vaga = "SELECT vaga.*, ong.nome_ong FROM vaga JOIN ong ON ong.id = vaga.id_ong WHERE vaga.id = ".$id_vaga;
    echo $sql_vaga;
    $result = return_select($sql_vaga);
//     echo "<pre>";
// print_r($result);
// echo "</pre>";
    
    $html = text_html_header($result[0]['nome'],$result[0]['nome_ong']);

    $html .= text_html_main($result[0]['quant_atual'], $result[0]['quant_limite'],$result[0]['descr_total']);

    if( isset($result) AND $result[0]['quant_atual'] == $result[0]['quant_limite']){
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