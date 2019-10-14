<?php
    session_start();
    if($_SESSION["cliente"]==0)
        include "cabecalhoadm.html";
    else
        include "cabecalho.html";
    include "Conexao.php";
    include "util.inc";
?>
       
<div class="col-xs-12">
    Cliente
            <table class="table table-hover">
            <tr>
                <th>Id Pedido</th>
                <th>Data</th>
                <th>Total Geral</th>
                <th>Nome</th>
                <th>CPF</th>
            </tr>
         <?php
                $idpedido=$_GET["id"];
                //Exibir os itens gravados
                $sql = "SELECT DISTINCT p.idPedido, p.data, p.totalgeral, f.nome 
                FROM pedido p INNER JOIN itemPedido ip ON p.idPedido=ip.pedido_idPedido 
                INNER JOIN produto pr ON pr.idproduto=ip.produtop_idproduto 
                INNER JOIN fornecedor f ON f.idfornecedor=pr.idfornecedor_idfornecedor 
                WHERE usuario_idusuario=1;
                
                $resultado= $conexao->query($sql);
                while($linha=$resultado->fetch_array()){
                    echo" <tr>";
                    echo "<td>".$linha["idPedido"]."</td>";
                    echo "<td>".$linha["data"]."</td>";
                    echo "<td>".$linha["totalgeral"]."</td>";
                    echo "<td>".$linha["nome"].";
                    echo"</tr>";
                }
?>

<?php
    include "rodape.html";
?>

