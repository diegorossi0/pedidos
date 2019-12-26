<?php
include "cabecalho.html";
include "Conexao.php";
include "util.inc";

header('Content-Type: text/html; charset=utf-8');
?>

<div calss="col-xs-12">
<table class="table table-hover">
<tr>
    <th>Políticas da Empresa</th>
    <th></th>
</tr>
<?php
    //Exibir os itens gravados
    $id=$_GET["idpedido"];
    $idfornecedor=$_GET["idfornecedor"];

    $sql = "SELECT * FROM fornecedor WHERE idfornecedor=$idfornecedor";
    $resultado= $conexao->query($sql);
    while($linha=$resultado->fetch_array()){
        echo "<tr>";
        echo "<td>".$linha["regras"]."</td>";
        echo "</tr>";
    }
?>
</table>
</div> <br><br><br>



<div class="col-xs-12 col-sm-offset-2 col-sm-8 col-lg-offset-4 col-lg-4">
<form method="POST">
    <label style="width : 300px;"><input type="checkbox" name="chConcordo" id="chConcordo">Concordo com as regras da empresa</label>
    <br><br>
    <label>Forma de Pagamento:</label>
    <textarea id="txtpag" name="txtpag" class="campo form-control" disabled></textarea><br>
    <input id="btpg" type="submit" value="Concluir" name="btGravar" class="btn btn-primary" href="selecao.php" disabled>
    <br><br>
</form>
</div>

<?php
        
        if(isset($_POST["btGravar"])){
            $pag=$_POST["txtpag"];

            
            $sql="UPDATE pedido SET formapagamento ='$pag' WHERE idpedido = $id";
                   
            $conexao->query($sql);

            if($conexao->errno == 0){
                $sql="SELECT u.* FROM pedido p INNER JOIN usuario u ON p.usuario_idusuario=u.idusuario WHERE idpedido=$id";
                $resultado = $conexao->query($sql);
                $linha=mysqli_fetch_array($resultado);
                $titulo = leitura("tituloemail.txt");
                disparoEmail($linha["email"], leitura('recebidoctxt.txt'), "$titulo");
                echo "<script>alert('Pedido Concluído com sucesso!');  window.location.href='selecao.php';</script>";
            }else{
                echo "<script>alert('Erro ao concluir o pedido!');</script>";

            }
        }
?>

<script>
    $('#chConcordo').click(function(){
        var selecionado = $('#chConcordo').prop("checked");
        $("#btpg").prop( "disabled", !selecionado );
        $("#txtpag").prop( "disabled", !selecionado );
    })
</script>
            