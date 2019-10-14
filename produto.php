<?php
    session_start();
    if($_SESSION["cliente"]==0)
        include "cabecalhoadm.html";
    else
        include "cabecalho.html";
    include "Conexao.php";
    include "util.inc";
    disparoEmail("diego.rossi@ifsudestemg.edu.br", "OK!");
?>
        <div id="login">
            <form method="POST" enctype="multipart/form-data">
                <div class="col-xs-12 col-sm-offset-2 col-sm-8 col-lg-offset-4 col-lg-4">
                    <label>Fornecedor:</label>
                    <select name="txtForn" class="campo form-control">
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
                    <br><label>Descrição:</label>
                    <input type="text" name="txtDesc" class="campo form-control">
                    <br><label>Preço:</label>
                    <input type="text" name="txtPreco" class="campo form-control">
                    <br><label>Imagem:</label>
                    <input type="file" name="txtImagem" class="campo form-control">
                    <br><label>Observação:</label>
                    <textarea name="txtObs" class="campo form-control"></textarea>
                    <br><label>
                    <input type="checkbox" value="1" name="txtInativo" class="form-check-input"> Inativo</label><br>
                    <input type="submit" value="Entrar" name="btGravar" class="btn btn-primary" >
                    <br><br><br>
                </div>  
            </form>
        </div>
        <?php
            if(isset($_POST["btGravar"])){
                $idfornecedor=$_POST["txtForn"];
                $descricao=$_POST["txtDesc"];
                $preco=limpaValor($_POST["txtPreco"]);
                $imagemTmp=$_FILES["txtImagem"]["tmp_name"];
                $imagem=date("dmyHis").$_FILES["txtImagem"]["name"];
                $observacao=$_POST["txtObs"];

                //enviar a imagem
                if($_FILES["txtImagem"]["error"]!=0){
                    echo "Não foi possível cadastrar o produto, erro na imagem";
                    exit;
                }

                move_uploaded_file($imagemTmp, "prod/".$imagem);

                if(isset($_POST["txtInativo"]))
                    $inativo=$_POST["txtInativo"];
                else
                    $inativo=0;
               
                $sql="INSERT INTO produto (fornecedor_idfornecedor, descricao, preco, observacao, inativo, imagem ) 
                    VALUES ($idfornecedor, '$descricao', '$preco', '$observacao', $inativo, '$imagem')";

                $conexao->query($sql);

                if($conexao->errno == 0){
                    echo "<script>alert('Produto cadastrado com sucesso!');</script>";
                }else{
                    echo "<script>alert('Erro ao cadastrar o produto');</script>";
                }
            }
        ?>

        <div calss="col-xs-12">
            <table class="table table-hover">
            <tr>
                <th>Descrição</th>
                <th>Preço</th>
                <th> </th>
                <th> </th>
                <th> </th>
            </tr>
            <?php
                //Exibir os itens gravados
                $sql = "SELECT * FROM produto";
                $resultado= $conexao->query($sql);
                while($linha=$resultado->fetch_array()){
                    echo "<tr>";
                    echo "<td>".$linha["descricao"]."</td>";
                    echo "<td>".formatavalor($linha["preco"])."</td>";
                    echo "<td>"."<a href='imagem.php?id=".$linha["idproduto"]."'><i class='fas fa-images'></i></a>"."</td>";
                    echo "<td><a href='alterarproduto.php?id=".$linha["idproduto"].
                    "'>Alterar</a></td>";
                    echo "<td><a href='apagarproduto.php?id=".$linha["idproduto"].
                    "'>Apagar</a></td>";
                    echo "</tr>";
                }
            ?>
            </table>
        </div>
    
<?php
    include "rodape.html";
?>

