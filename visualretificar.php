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
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>CPF</th>
                <th>Endereço</th>
                <th>Forma de Pagamento</th>
                <th>Observação</th>
            </tr>
         <?php
                $idpedido=$_GET["id"];
                //Exibir os itens gravados
                $sql = "SELECT * FROM pedido p INNER JOIN usuario u 
                ON u.idusuario = p.usuario_idusuario
                WHERE p.idpedido = $idpedido";
                $resultado= $conexao->query($sql);
                while($linha=$resultado->fetch_array()){
                    echo" <tr>";
                    echo "<td>".$linha["idPedido"]."</td>";
                    echo "<td>".$linha["nome"]."</td>";
                    echo "<td>".$linha["email"]."</td>";
                    echo "<td>".$linha["telefone"]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
                    echo "<td>".$linha["cpf"]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
                    echo "<td>".$linha["logradouro"]."&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;";
                    echo "".$linha["numero"]."&nbsp;&nbsp;&nbsp;";
                    echo "".$linha["complemento"]."&nbsp;&nbsp;&nbsp;";
                    echo "".$linha["bairro"]."&nbsp;&nbsp;&nbsp;";
                    echo "".$linha["cidade"]."&nbsp;&nbsp;&nbsp;";
                    echo "".$linha["uf"]."&nbsp;&nbsp;&nbsp;";
                    echo "".$linha["cep"]."&nbsp;&nbsp;&nbsp;</td>";
                    echo "<td>".$linha["formapagamento"]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
                    echo "<td>".$linha["observacao"]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
                   
                    echo"</tr>";
                }
?>
</table>
</div>
<div calss="col-xs-12">
    Fornecedor
            <table class="table table-hover">
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Endereço</th>
                <th>Políticas da empresa</th>
  
                
                
            </tr>
<?php
                  //Exibir os itens gravados
                $sql = "SELECT * FROM pedido p INNER JOIN itemPedido ip  

                ON ip.pedido_idpedido = p.idpedido
                INNER JOIN produto pr 
                ON pr.idproduto=ip.produto_idproduto 
                INNER JOIN fornecedor f 
                ON f.idfornecedor=pr.fornecedor_idfornecedor
                WHERE p.idpedido = $idpedido";
                $resultado= $conexao->query($sql);
                while($linha=$resultado->fetch_array()){
                   echo" <tr>";
                    echo "<td>".$linha["nome"]."</td>";
                    echo "<td>".$linha["email"]."</td>";
                    echo "<td>".$linha["telefone"]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
                    echo "<td>".$linha["logradouro"]."&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;";
                    echo "".$linha["numero"]."&nbsp;&nbsp;&nbsp;";
                    echo "".$linha["complemento"]."&nbsp;&nbsp;&nbsp;";
                    echo "".$linha["bairro"]."&nbsp;&nbsp;&nbsp;";
                    echo "".$linha["cidade"]."&nbsp;&nbsp;&nbsp;";
                    echo "".$linha["uf"]."&nbsp;&nbsp;&nbsp;";
                    echo "".$linha["cep"]."&nbsp;&nbsp;&nbsp;</td>";
                    echo "<td>".$linha["regras"]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
  
                    echo"</tr>";
                }
            ?>
        </table>
</div><br><br>
        <div calss="col-xs-12">
            <table class="table table-hover">
            <tr>
                <th>Descrição</th>
                <th>Quantidade</th>
                <th>Valor Unitário</th>
                <th>Total</th>
                <th>Observação</th>
            </tr>
            <?php


                //Exibir os itens gravados
                $sql = "SELECT p.descricao, ip.qtde, ip.valor, ip.total, ip.observacao FROM itemPedido ip INNER JOIN produto p 
                ON p.idproduto = ip.produto_idproduto
                WHERE pedido_idpedido = $idpedido";
                $resultado= $conexao->query($sql);
                while($linha=$resultado->fetch_array()){
                    echo "<tr>";
                    echo "<td>".$linha["descricao"]."</td>";
                    echo "<td>".$linha["qtde"]."</td>";
                    echo "<td>".formataValor($linha["valor"])."</td>";
                    echo "<td>".formataValor($linha["total"])."</td>";
                    echo "<td>".$linha["observacao"]."</td>";
                    echo "</tr>";
                }
            ?>
            </table>
            <p class="text-right">
            Total do pedido: <span class="badge badge-light">
            <?php
                $sql="SELECT * FROM pedido WHERE idpedido = $idpedido";
    
                $resultado= $conexao->query($sql);
                while($linha=$resultado->fetch_array()){
                    echo formataValor($linha["totalgeral"]);
                }
            ?></span></p>
            
            
            <a href="retificado.php?id=<?php echo $idpedido; ?>" class="btn btn-danger">Retificar Pedido</a>
        </div>
<?php
    include "rodape.html";
?>