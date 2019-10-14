<?php 
    include 'Conexao.php';
                $id=$_GET["id"];
               
                $sql="UPDATE pedido SET aprovado = 0 WHERE idpedido = $id";

                $conexao->query($sql);

                if($conexao->errno == 0){
                    echo "<script>alert('Retornado para a análise com sucesso'); window.location.href='aprovar.php';</script>";
                }else{
                    echo "<script>alert('Erro ao retornar para a análise'); window.location.href='aprovar.php';</script>";
                }

                
?>