<?php 
    include 'Conexao.php';
                $id=$_GET["id"];
               
                $sql="UPDATE pedido SET aprovado = 1 WHERE idpedido = $id";

                $conexao->query($sql);

                if($conexao->errno == 0){
                    echo "<script>alert('Pedido Aprovado'); window.location.href='aprovar.php';</script>";
                }else{
                    echo "<script>alert('Erro ao aprovar o pedido'); window.location.href='aprovar.php';</script>";
                }

                $sql="INSERT INTO conclusao(idpedido, etapa, dataconclusao) VALUES ($id, 2, current_date)";
                $conexao->query($sql);

                

                
?>