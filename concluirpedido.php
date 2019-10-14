<?php 
session_start();
    include "cabecalhologin.html";
    include 'Conexao.php';
    include 'util.inc';
                $id=$_GET["id"];
?>

<div id="login">
            <form method="POST">
                <div class="col-xs-12 col-sm-offset-2 col-sm-8">
                    <label style="width:80%">Digite o Código de rastreio do pedido</label>
                    <input type="text" name="txtcod" class="campo form-control">
                    <br>
                    <input type="submit" class="btn btn-primary" name="bt" value="Inserir Produtos">
                    <br><br><br>
                </div>  
            </form>
        </div>

        <?php
            if(isset($_POST["bt"])){
                $sql="UPDATE pedido SET aprovado = 3 WHERE idpedido = $id";

                $conexao->query($sql);

                $sql="INSERT INTO conclusao(idpedido, etapa, dataconclusao) VALUES ($id, 3, current_date)";
                $conexao->query($sql);
                
                
                if(mysqli_errno($conexao) == 0){
                    echo "<script>alert('Pedido Conluido com Sucesso!');</script>";
                }else{
                    echo "<script>alert('Erro ao receber o pedido');</script>";
                }
                
                $codigo = $_POST["txtcod"];

                $sql="UPDATE pedido SET rastreamento='$codigo' WHERE idpedido=$id";
            
                if($conexao->query($sql)){
                    echo"Pedido concluído com Sucesso";
                }

                $sql="SELECT u.* FROM pedido p INNER JOIN usuario u ON p.usuario_idusuario=u.idusuario WHERE idpedido=$id";
                $resultado = $conexao->query($sql);
                $linha=mysqli_fetch_array($resultado);
                $titulo = leitura("tituloemail.txt");
                disparoEmail($linha["email"], leitura('concluidotxt.txt'), "$titulo $id");
                
            }

        ?>
<?php
    include "rodape.html";
?>