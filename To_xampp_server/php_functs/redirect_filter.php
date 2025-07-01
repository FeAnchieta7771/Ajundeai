<?php 

if(isset($_GET['category_button'])){
    $button = $_GET['category_button'];
    header("Location: ../filter.php?type=".$_GET['type']."&category_button=$button&$button=on");
    exit();
}
?>