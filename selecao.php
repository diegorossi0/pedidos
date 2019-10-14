<?php
    session_start();
    if($_SESSION["cliente"]==0)
        include "cabecalhoadm.html";
    else
        include "cabecalho.html";
        
    include "Conexao.php";
?>
            <div class="col-xs-12 col-sm-offset-2 col-sm-8">
            <a href="pedido.php" class="btn btn-primary btn-sm btn-block">Novo Pedido</a>
            <br>
        <table class="table table-hover">
        <?php
               $id=$_SESSION["idusu"];
                
                $sql="SELECT DISTINCT p.* FROM pedido p INNER JOIN itemPedido ip ON p.idpedido = ip.pedido_idpedido WHERE usuario_idusuario = $id";
                
                $resultado= $conexao->query($sql);
                if($resultado->num_rows > 0){
        ?>
            <tr>
                    <td>Nº Pedido</td>
                    <td>Status</td>
                    <td>Observação</td>
                    <td>Cancelar</td>
            </tr>
        <?php    
                    while($linha = $resultado->fetch_array()){
                        echo "<tr>";
                        echo "<td>";
                        echo $linha[0];
                        echo "</td>";
                        echo "<td>";
                        if($linha[2]==0)
                            echo "Aguardando aprovação";
                        if($linha[2]==1)
                            echo "Aprovado";
                        if($linha[2]==2)
                            echo "Cancelado";
                        echo "</td>";
                        echo "<td>";
                        echo $linha[3];
                        echo "</td>";
                        echo "<td>";
                        if($linha[2]==0)
                            echo "<a href='cancelar.php?id=".$linha[0]."'>X</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                }else{
                    echo "<script>alert('Usuário sem pedido cadastrado');</script>";
                }
        ?>
        </table>
        </div>
<?php
    include "rodape.html";
?>

