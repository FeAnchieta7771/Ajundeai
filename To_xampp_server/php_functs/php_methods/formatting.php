<?php 
// ===========================================================================================
// FUNÇÃO DE TRATAMENTOS DE TELEFONE

function Is_phone_correct($phone){
    // (##) ####-#### ou // (##) #####-####
    return preg_match('/^\(\d{2}\) \d{4,5}-\d{4}$/', $phone) === 1;
}

function Convert_phone_to_db($phone){
    // (##) ####-####
    $search = array("(",")"," ","-");
    $replace = array("","","","");
    $phone_for_db = str_replace($search, $replace, $phone);

    return $phone_for_db;
}

function Convert_phone_to_show($phone){

    if (strlen($phone) == 10){
        // ########## => (##) ####-####
        $phone_for_show = "(" . substr($phone, 0, 2) .
                            ") " . substr($phone, 2, 4) .
                            "-" . substr($phone, 6, 4);

    } else if (strlen($phone) == 11){
        // ########### => (##) #####-####
        $phone_for_show = "(" . substr($phone, 0, 2) .
                            ") " . substr($phone, 2, 5) .
                            "-" . substr($phone, 7, 4);
    }
    
    return $phone_for_show;
}

// ===========================================================================================
// FUNÇÃO DE TRATAMENTOS DE WHATSAPP

function Is_whats_correct($whats){
    // +55 (##) #####-####
    return !isset($whats) || preg_match('/^\+55 \(\d{2}\) \d{4,5}-\d{4}$/', $whats) === 1;
}

function Convert_whats_to_db($whats){
    // (##) ####-####
    $search = array("+","(",")"," ","-");
    $replace = array("","","","","");
    $whats_for_db = str_replace($search, $replace, $whats);

    return $whats_for_db;
}

function Convert_whats_to_show($whats){
    // ############# => (##) ####-####
    $whats_for_show = "+55 (" . substr($whats, 2, 2) .
                        ") " . substr($whats, 4, 5) .
                        "-" . substr($whats, 9, 4);
    
    return $whats_for_show;
}

// ===========================================================================================
// FUNÇÃO DE TRATAMENTOS DE WHATSAPP

function Is_cpf_correct($cpf){
    // +55 (##) #####-####
    return strlen($cpf) == 12;
}

function Convert_cpf_to_db($cpf){
    // (##) ####-####
    $search = array("-");
    $replace = array("");
    $cpf_for_db = str_replace($search, $replace, $cpf);

    return $cpf_for_db;
}

function Convert_cpf_to_show($cpf){
    // ############# => (##) ####-####
    $cpf_for_show = substr($cpf, 0, 9) .
                    "-" . substr($cpf, 8, 2);
    
    return $cpf_for_show;
}



?>