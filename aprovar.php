<?php
    session_start();
    if($_SESSION["cliente"]==0)
        include "cabecalhoadm.html";
    else
        include "cabecalho.html";
        
    include "Conexao.php";
?>
            <div class="col-xs-12 col-sm-offset-2 col-sm-8">
                <h3 class="text-center"><span class="badge badge-secondary">Pedidos em análise</span></h3>
                <br>
            <table class="table table-hover">
            <?php
                $id=$_SESSION["idusu"];
                    
                    $sql="SELECT DISTINCT p.* FROM pedido p INNER JOIN itemPedido ip ON p.idpedido = ip.pedido_idpedido WHERE aprovado = 0 ORDER BY p.idpedido DESC";
                    
                    $resultado= $conexao->query($sql);
                    if($resultado->num_rows > 0){
            ?>
                <tr>
                        <td>Nº Pedido</td>
                        <td>Status</td>
                        <td>Observação</td>
                        <td></td>
                </tr>
            <?php    
                        while($linha = $resultado->fetch_array()){
                            echo "<tr>";
                            echo "<td>";
                            echo $linha[0];
                            echo "</td>";
                            echo "<td>";
                            if($linha[2]==0)
                                echo "Aguardando análise";
                            echo "</td>";
                            echo "<td>";
                            echo $linha[3];
                            echo "</td>";
                            echo "<td>";
                            if($linha[2]==0)
                                echo "<a href='visual.php?id=".$linha[0]."'><i class='fas fa-eye'></i></a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    }else{
                        echo "<script>alert('Sem pedido para analisar');</script>";
                    }
            ?>
            </table>
        </div>
        <div class="col-xs-12 col-sm-offset-2 col-sm-8">
                <h3 class="text-center"><span class="badge badge-secondary">Pedidos Recebidos</span></h3>
                <br>
            <table class="table table-hover">
            <?php
                $id=$_SESSION["idusu"];
                    
                    $sql="SELECT DISTINCT p.* FROM pedido p INNER JOIN itemPedido ip ON p.idpedido = ip.pedido_idpedido WHERE aprovado = 1 ORDER BY idpedido DESC";
                    
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
                            if($linha[2]==1)
                                echo "Aguardando aprovação";
                            echo "</td>";
                            echo "<td>";
                            echo $linha[3];
                            echo "</td>";
                            echo "<td>";
                            echo "<a href='visualreceber.php?id=".$linha[0]."'><i class='fas fa-eye'></i></a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    }
            ?>
            </table>
        </div>

         <div class="col-xs-12 col-sm-offset-2 col-sm-8">
                <h3 class="text-center"><span class="badge badge-secondary">Pedidos Aprovado</span></h3>
                <br>
            <table class="table table-hover">
            <?php
                $id=$_SESSION["idusu"];
                    
                    $sql="SELECT DISTINCT p.* FROM pedido p INNER JOIN itemPedido ip ON p.idpedido = ip.pedido_idpedido WHERE aprovado = 2 ORDER BY idpedido DESC";
                    
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
                            echo "Aprovado pelo fabricante";
                            echo "</td>";
                            echo "<td>";
                            echo $linha[3];
                            echo "</td>";
                            echo "<td>";
                            echo "<a href='visualcancelar.php?id=".$linha[0]."'><i class='fas fa-eye'></i></a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    }
            ?>
            </table>
        </div>

         <div class="col-xs-12 col-sm-offset-2 col-sm-8">
                <h3 class="text-center"><span class="badge badge-secondary">Pedido Enviado</span></h3>
                <br>
            <table class="table table-hover">
            <?php
                $id=$_SESSION["idusu"];
                    
                    $sql="SELECT DISTINCT p.* FROM pedido p INNER JOIN itemPedido ip ON p.idpedido = ip.pedido_idpedido WHERE aprovado = 3 ORDER BY idpedido DESC";
                    
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
                            echo "Enviado pelo fabricante";
                            echo "</td>";
                            echo "<td>";
                            echo $linha[3];
                            echo "</td>";
                            echo "<td>";
                            echo "<a href='visualcancelar.php?id=".$linha[0]."'><i class='fas fa-eye'></i></a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    }
            ?>
            </table>
        </div>

         <div class="col-xs-12 col-sm-offset-2 col-sm-8">
                <h3 class="text-center"><span class="badge badge-secondary">Pedidos Cancelado</span></h3>
                <br>
            <table class="table table-hover">
            <?php
                $id=$_SESSION["idusu"];
                    
                    $sql="SELECT DISTINCT p.* FROM pedido p INNER JOIN itemPedido ip ON p.idpedido = ip.pedido_idpedido WHERE aprovado = 4 ORDER BY idpedido DESC";
                    
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
                            echo "Cancelado";
                            echo "</td>";
                            echo "<td>";
                            echo $linha[3];
                            echo "</td>";
                            echo "<td>";
                            echo "<a href='visualretificar.php?id=".$linha[0]."'><i class='fas fa-eye'></i></a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    }
            ?>
            </table>
        <br><br><br></div>
<?php
    include "rodape.html";
?>

