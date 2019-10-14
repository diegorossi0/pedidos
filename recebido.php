<?php 
    include 'Conexao.php';
    include 'util.inc';
                $id=$_GET["id"];
               
                $sql="UPDATE pedido SET aprovado = 1 WHERE idpedido = $id";

                $conexao->query($sql);
                
                $sql="SELECT f.* FROM pedido p INNER JOIN itemPedido ip ON p.idpedido=ip.pedido_idpedido INNER JOIN produto pr ON pr.idproduto=ip.produto_idproduto INNER JOIN fornecedor f ON pr.fornecedor_idfornecedor=f.idfornecedor WHERE idpedido=$id";
                $resultado = $conexao->query($sql);
                $linha=mysqli_fetch_array($resultado);
                $link =  "<a href='http://gisa.diegorossi.com.br/pedidofornecedor.php?id=$id'>Clique aqui para vizualizar o Pedido!</a>";
                $titulo = leitura("tituloemail.txt");
                disparoEmail($linha["email"], leitura('recebidoftxt.txt').$link, "$titulo $id");
                
                $sql="INSERT INTO conclusao(idpedido, etapa, dataconclusao) VALUES ($id, 1, current_date)";
                $conexao->query($sql);
                
                if($conexao->errno == 0){
                    echo "<script>alert('Pedido recebido'); window.location.href='aprovar.php';</script>";
                }else{
                    echo "<script>alert('Erro ao receber o pedido'); window.location.href='aprovar.php';</script>";
                }

                
?>