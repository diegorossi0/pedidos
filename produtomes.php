<?php
    session_start();
    if($_SESSION["cliente"]==0)
        include "cabecalhoadm.html";
    else
        include "cabecalho.html";
    include "Conexao.php";
    include "util.inc"; 
    $ano=$_GET["ano"];
    $mes=$_GET["mes"];
?>
       
<div class="col-xs-12">
        <h2>Produtos Vendidos em <?php echo $mes."/".$ano  ?></h2>
            <table class="table table-hover">
            <tr>
                <th>Produto</th>
                <th>Quantidade</th>
                
            </tr>
         <?php
               
                //Exibir os itens gravados
                $sql = "SELECT pr.descricao, SUM(ip.qtde) as qtde FROM pedido p 
                INNER JOIN itemPedido ip ON p.idPedido = ip.pedido_idPedido 
                INNER JOIN produto pr ON pr.idproduto = ip.produto_idproduto
                INNER JOIN fornecedor f on f.idfornecedor = pr.fornecedor_idfornecedor 
                WHERE MONTH(p.data)= $mes AND YEAR(p.data)= $ano 
                GROUP BY descricao";
                
                $resultado= $conexao->query($sql);
                while($linha=$resultado->fetch_array()){
                    echo" <tr>";
                    echo "<td>".$linha["descricao"]."</td>";
                    echo "<td>".$linha["qtde"]."</td>";
                    echo"</tr>";
                }
?>

<?php
    include "rodape.html";
?>

