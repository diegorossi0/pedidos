<?php
    session_start();
    if($_SESSION["cliente"]==0)
        include "cabecalhoadm.html";
    else
        include "cabecalho.html";
    include "Conexao.php";
?>
        <div id="login">
            <form method="POST">
                <div class="col-xs-12 col-sm-offset-2 col-sm-8">
                    <label style="width:80%">Escolha o fornecedor para realizar o pedido</label>
                    <select name="txtRep" class="campo form-control">
                        <?php
                            $sql="SELECT * FROM fornecedor";
                
                            $resultado= $conexao->query($sql);
                            if($resultado->num_rows > 0){
                                while($linha=$resultado->fetch_array()){
                                    echo "<option value='".$linha["idfornecedor"]."'>".$linha["nome"]."</option>";
                                }
                            }
                        ?>
                    </select>
                    <br>
                    <input type="submit" class="btn btn-primary" name="bt" value="Inserir Produtos">
                    <br><br><br>
                </div>  
            </form>
        </div>
        <?php
            if(isset($_POST["bt"])){
               $representante = $_POST["txtRep"];
               $usuario = $_SESSION["idusu"];

                $sql="INSERT INTO pedido(usuario_idusuario, aprovado, observacao, data) VALUES ($usuario, 0, '', current_date) ";
            
            
            
            if($conexao->query($sql)){
                $idpedido = $conexao->insert_id;
                header("location: itempedido.php?idfornecedor=$representante&idpedido=$idpedido");
            }else{
                echo "<script>alert('Erro ao criar o pedido, tente novamente mais tarde');</script>";
            }
        }
        ?>
    
<?php
    include "rodape.html";
?>

