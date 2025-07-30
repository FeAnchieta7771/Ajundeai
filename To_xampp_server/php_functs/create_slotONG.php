<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
function return_select($sql){
    include 'php_db/conexao.php';
    try{
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;

    }catch(PDOException) {

        $_SESSION['LOGIN_email'] = $_POST['email'];
        $_SESSION['LOGIN_password'] = $_POST['password'];
        echo "<script>
            localStorage.setItem('Botao_guia', '".$_POST['login_state']."');
            window.alert('Ocorreu algo no Servidor, tente novamente mais tarde');
            window.location.href = '../create_slot_ong.php';
        </script>";
        exit();
    }
}

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include 'php_db/conexao.php';

    $nome = $_POST['nome_vaga'] ?? '';
    $categoria_vaga = $_POST['categoria_vaga'] ?? '';
    $localizacao = $_POST['localizacao'] ?? '';
    $quant_limite = $_POST['quant_limite'] ?? 0;
    $descr_obj = $_POST['descr_obj'] ?? '';
    $descr_total = $_POST['descr_total'] ?? '';
    }

    try {
        $stmt = $conn->prepare("INSERT INTO vaga (id_ong, nome, categoria_vaga, localizacao, descr_obj, descr_total, quant_limite, quant_atual) VALUES (:id_ong, :nome, :categoria_vaga, :localizacao, :descr_obj, :descr_total, :quant_limite, :quant_atual)");
        $stmt->bindParam(':id_ong', $_SESSION['id'],PDO::PARAM_INT);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':categoria_vaga', $categoria_vaga);
        $stmt->bindParam(':localizacao', $localizacao);
        $stmt->bindParam(':descr_obj',$descr_obj);
        $stmt->bindParam(':descr_total', $descr_total);
        $stmt->bindParam(':quant_limite', $quant_limite, PDO::PARAM_INT);
        $initial_quant_atual = 0; // sempre começa com 0 para vagas novas
        $stmt->bindParam(':quant_atual', $initial_quant_atual, PDO::PARAM_INT);

        $stmt->execute();

        }catch(PDOException) {


        echo "<script>
            window.alert('Ocorreu um erro na criação da vaga.');
            window.location.href = '../create_slot_ong.php';
        </script>";
        exit();
    }
        
            header('Location: '.$_SESSION['tela_anterior']);
            exit();

?>