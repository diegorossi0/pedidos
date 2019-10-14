<?php

    include 'Conexao.php';
    $id = $_GET["id"];
    $sql = "DELETE FROM produto WHERE idproduto=$id";
    
    $conexao->query($sql);
    
    header("location: produto.php");
    
?>
