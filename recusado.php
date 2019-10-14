<?php 
    include 'Conexao.php';
                $id=$_GET["id"];
               
                $sql="UPDATE pedido SET aprovado = 4 WHERE idpedido = $id";

                $conexao->query($sql);

                if($conexao->errno == 0){
                    echo "<script>alert('Pedido Recusado'); window.location.href='aprovar.php';</script>";
                }else{
                    echo "<script>alert('Erro ao recusar o pedido'); window.location.href='aprovar.php';</script>";
                }

                
?>