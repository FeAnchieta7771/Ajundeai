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

    ////////////////////////////////////////////////////////////////////
    
    // ! ESSE FILTRO VAI PARA PESQUISAS FEITAS PELA
        // BARRA DE PESQUISA DA TELA DE HOME
        if($type_filter == 'filter_base'){
            
            // receber filtro escrito pelo usuário
            $filter_user = $_POST['filter_user'];

            if(isset($_SESSION['id'])){

                do_slot_with_user_logged($id, $_SESSION['id']);
            } else{
                user_not_logged(false, $id, $_SESSION['id']);
                
            }

            $sql = "SELECT vaga.*, ong.nome_ong FROM vaga JOIN ong ON ong.id = vaga.id_ong AND vaga.id = ".$id." WHERE ";
            
            // ! Filtros da pesquisa
            
            $sql = "SELECT vaga.*, ong.nome_ong FROM vaga JOIN ong ON ong.id = vaga.id_ong WHERE";
            $sql .= "";
            
            $result = return_select($sql);
            show_filter($result);
            
        } 
}
}

function do_slot_with_user_logged($id_vaga, $id_user){

    $sql_register = "SELECT * FROM registro WHERE id_vaga = ".$id_vaga." AND id_voluntario = ".$id_user;
    $result_register = return_select($sql_register);

    if( isset($result_register) AND $result_register['categoria_registro'] == 'cadastrado'){
        // como o usuário está cadastrado, o número de vagas é irrelevante

        $sql = $sql = "SELECT vaga.*, ong.nome_ong FROM vaga JOIN ong ON ong.id = vaga.id_ong WHERE id_vaga = ".$id_vaga;
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
        user_not_logged(true, $id_vaga, $id_user);
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
// A FUNÇÃO fará a exibição dos resultados entregues á ela
// function show_filter($result){

//         // iniciar tentiva de consulta
//         $numLinhas = count($result);

//         if($numLinhas <= 0){
//             echo "<h3>NADA ENCONTRADO</h3>";
//             echo "<div class='scroll-wrapper'>";
//             echo "<div class='vaga-card' style='background-color:rgb(222, 222, 222); border: none;'>";
          
//             echo "  <img src='img/icons_orange/not_found.png' alt='Ícone' />";
//             echo "  <div class='vaga-info'>";
//             echo "    <h4 style='display: flex;'>Infelizmente, sua busca não retornou nenhuma vaga.</h4>";
//             echo "    <span>Tente alterar os filtros ou pesquisar com outros termos.</span>";
//             echo "  </div>";
//             echo "</div>";
//             echo "</div>";
//             exit();
//         }

//         $plural_foi = "I";
//         $plural_s = "";

//         if($numLinhas > 1){
//             $plural_s = "S";
//             $plural_foi = "RAM";
//         }
//         echo "<h3>".$numLinhas. " VAGA".$plural_s." FO".$plural_foi." ENCONTRADA".$plural_s."!</h3>";
//         echo "<div class='scroll-wrapper'>";

//         #exibição das vagas encontradas
//         foreach($result as $user_result){
//             // busca a imagem a partir da categoria da vaga
//             $url = image_filter($user_result['categoria_vaga']);
            
            
//           echo "<div class='vaga-card'>";
          
//           echo "  <img src='$url' alt='Ícone' />";
//           echo "  <div class='vaga-info'>";
//           echo "    <h4 style='font-family: 'Horizon', sans-serif;'><a style='text-decoration: none'>".$user_result['nome']."</a></h4>";
//           echo "    <span><i class='bx bxs-user' style='font-size: 20px;'></i> ".$user_result['quant_atual']."/".$user_result['quant_limite']." • ".$user_result['nome_ong']."</span>";
//           echo "    <p>".$user_result['descr_obj']."</p>";
//           echo "  </div>";
//           echo "</div>";
//         }

//         echo "</div>";
// }

function user_not_logged($is_logged, $id_vaga, $id_user){
    //quando usuario nao esta logado, id nao existe
    // dependente da quantidade de pessoas na vaga
    // → Lotado: Mensagem de lotado
    // → Livre: exigição da vaga


    $sql_vaga = "SELECT * FROM vaga WHERE id_vaga = ".$id_vaga." AND id_voluntario = ".$id_user;
    $result = return_select($sql_vaga);
    
    $html = text_html_header($result['nome'],$result['nome_ong']);

    $html .= text_html_main($result['quant_atual'], $result['quant_limite'],$result['descr_total']);

    if( isset($result) AND $result ==['quant_atual'] == 'quant_limite'){
        // falta o botao para quando o estiver lotado.
        $html .= text_html_buttons('[MODELO DE BOTÃO LOTADA]', 'localizacao');
    }

    else{

        if($is_logged){
            $html .= text_html_buttons('[MODELO DE BOTÃO SALVO]', 'localizacao');
        }
        // está livre
        $html .= text_html_buttons('[MODELO DE BOTÃO PADRÃO]', 'localizacao');
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