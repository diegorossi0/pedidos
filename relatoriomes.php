<?php
    session_start();
    if($_SESSION["cliente"]==0)
        include "cabecalhoadm.html";
    else
        include "cabecalho.html";
    include "Conexao.php";
    include "util.inc"
?>
            <div class="col-xs-12">
            Relatório Mensal de Vendas
            <table class="table table-hover">
            <tr> 
               
                <th>Produto</th>
                <th>Descrição</th>
                <th>Imagem</th>
            </tr>
            
            <?php
                $sql = "SELECT * FROM produto WHERE idproduto NOT IN (SELECT produto_idproduto FROM pedido WHERE data = current_date-30)";
                $resultado= $conexao->query($sql);
                while($linha=$resultado->fetch_array()){
                    echo "<tr>";
                    echo "<td>".$linha["idproduto"]."</td>";
                    echo "<td>".$linha["descricao"]."</td>";
                    echo "<td>".$linha["imagem"]."</td>";
                    echo "</tr>";
                }
            ?>
            </table>
        </div>
    
<?php
    include "rodape.html";
?>

