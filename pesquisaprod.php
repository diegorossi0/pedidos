<?php
    include "Conexao.php";

    $idproduto = $_GET["idproduto"];
    $sql = "SELECT * FROM produto WHERE idproduto = $idproduto";

    $resultado= $conexao->query($sql);
    while($linha=$resultado->fetch_array()){
        echo $linha["preco"];
    }
?>