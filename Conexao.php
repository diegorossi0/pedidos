<?php
    $servidor = 'sql50.main-hosting.eu';
    $usuario = 'u980558249_gisa';
    $senha = 'ccrof8f0e';
    $bd = 'u980558249_gisa';

    $conexao = new mysqli($servidor, $usuario, $senha, $bd);

    if(mysqli_connect_errno()){
        echo "Erro ao conectar com o banco";
        exit();
    }
?>
