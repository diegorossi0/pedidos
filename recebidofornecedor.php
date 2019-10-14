<?php 
    include 'Conexao.php';
    include 'util.inc';
                $id=$_GET["id"];
               
                $sql="UPDATE pedido SET aprovado = 2 WHERE idpedido = $id";

                $conexao->query($sql);
                
                $sql="SELECT f.* FROM itemPedido ip INNER JOIN produto p ON ip.produto_idproduto = p.idproduto INNER JOIN fornecedor f  ON p.fornecedor_idfornecedor=f.idfornecedor WHERE ip.pedido_idpedido=$id";
                $resultado = $conexao->query($sql);
                $linha=mysqli_fetch_array($resultado);
                $titulo = leitura("tituloemail.txt");
                disparoEmail($linha["email"], leitura('recebidofornecedorftxt.txt'), "$titulo $id");

                $sql="SELECT u.* FROM pedido p INNER JOIN usuario u ON p.usuario_idusuario=u.idusuario WHERE idpedido=$id";
                $resultado = $conexao->query($sql);
                $linha=mysqli_fetch_array($resultado);
                
                $link = "<a href='http://gisa.diegorossi.com.br/concluirpedido.php?id=$id'>Clique aqui para concluir o Pedido!</a>";
                disparoEmail($linha["email"], leitura('recebidofornecedorctxt.txt').$link, "$titulo $id" );
                
                $sql="INSERT INTO conclusao(idpedido, etapa, dataconclusao) VALUES ($id, 2, current_date)";
                $conexao->query($sql);
                

                if(mysqli_errno($conexao) == 0){
                    echo "<script>alert('Pedido recebido'); window.location.href='pedidofornecedor.php?id=$id';</script>";
                }else{
                    echo "<script>alert('Erro ao receber o pedido'); window.location.href='aprovar.php?id=$id';</script>";
                }

                
?>