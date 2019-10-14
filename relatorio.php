<?php
    session_start();
    if($_SESSION["cliente"]==0)
        include "cabecalhoadm.html";
    else
        include "cabecalho.html";
    include "Conexao.php";
    include "util.inc"
?>
            <div calss="col-xs-12">
            <h2>Relatório de Clientes</h2> 
            <table class="table table-hover">
            <tr> 
               
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone de Contato</th>
                <th></th>
            </tr>
            
            <?php
                $sql = "SELECT * FROM usuario WHERE idusuario NOT IN (SELECT usuario_idusuario FROM pedido WHERE data > current_date-90)";
                $resultado= $conexao->query($sql);
                while($linha=$resultado->fetch_array()){
                    echo "<tr>";
                    echo "<td>".$linha["nome"]."</td>";
                    echo "<td>".$linha["email"]."</td>";
                    echo "<td>".$linha["telefone"]."</td>";
                    echo "<td><a href='visual.php?id=".$linha["idusuario"]."'>X</a></td>";
                    echo "</tr>";
                }
            ?>
            </table>
        </div>
    
<?php
    include "rodape.html";
?>

