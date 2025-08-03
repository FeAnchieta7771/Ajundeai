<?php 

function select($sql, $param = []){
    /*
    Executa o comando SQL SELECT ao banco

    Parametros: $sql-> comando sql, 
                $param-> dados a serem usados como parametros ao $sql

    Retorno: em sucesso, retorna os valores buscados do comando
                em erro, retorna o erro encontrado

    */
    include "conexao.php";

    try{

        $stmt = $conn->prepare($sql);
        $stmt->execute($param);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e){
        
        throw new Exception($e->getMessage());
    }
}


function insert($sql, $param = []){
    /*
    Executa o comando SQL INSERT ao banco

    Parametros: $sql-> comando sql, 
                $param-> dados a serem usados como parametros ao $sql

    Retorno: em sucesso, retorna true se a inserção funcionou
                         retorna false se não funciou apesar de não ter dado erro no sql
                         
                em erro, retorna o erro encontrado

    */
    include "conexao.php";

    try{
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute($param);
        
        return $result;

    } catch (PDOException $e){
        
        throw new Exception($e->getMessage());
    }
}

function delete($sql, $condictions = []){
    /*
    Executa o comando SQL DELETE ao banco

    Parametros: $sql-> comando sql, 
                $condictions -> condições para encontrar o valor a ser deletado

    Retorno: em sucesso, retorna true se a exclusão funcionou
                         retorna false se não funciou apesar de não ter dado erro no sql
                         
                em erro, retorna o erro encontrado

    */
    include "conexao.php";

    try{
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute($condictions);
        
        return $result;

    } catch (PDOException $e){
        
        throw new Exception($e->getMessage());
    }
}

function update($sql, $param = []){
    /*
    Executa o comando SQL UPDATE ao banco

    Parametros: $sql-> comando sql, s
                $condictions -> condições para encontrar o valor a ser deletado

    Retorno: em sucesso, retorna true se a exclusão funcionou
                         retorna false se não funciou apesar de não ter dado erro no sql
                         
                em erro, retorna o erro encontrado

    */
    include "conexao.php";

    try{
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute($param);
        
        return $result;

    } catch (PDOException $e){
        
        throw new Exception($e->getMessage());
    }
}
?>