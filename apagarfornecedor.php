<?php

    include 'Conexao.php';
    $id = $_GET["id"];
    $sql = "DELETE FROM fornecedor WHERE idfornecedor=$id";
    
    $conexao->query($sql);
    
    header("location: fornecedor.php");
    
?>
