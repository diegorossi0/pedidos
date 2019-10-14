<?php
include "Conexao.php";
include "cabecalho.html";
?>

<div class="col-xs-12">
            <table class="table table-hover">
            <tr>
                <th>Regras</th>
         <?php
                $id=$_GET["id"];
                //Exibir os itens gravados
                $sql = "SELECT regras FROM fornecedor WHERE idfornecedor = $id";
                $resultado= $conexao->query($sql);
                while($linha=$resultado->fetch_array()){
                    echo" <tr>";
                    echo "<td>".$linha["regras"]."</td>";
                    echo"</tr>";
                }
   

?>
</div>
</table>