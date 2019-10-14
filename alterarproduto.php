<?php
    session_start();
    if($_SESSION["cliente"]==0)
        include "cabecalhoadm.html";
    else
        include "cabecalho.html";
    include "Conexao.php";
    include "util.inc";
    $id = $_GET["id"];
    
    $sql = "SELECT * FROM produto WHERE idproduto=$id";
    $resultado = $conexao->query($sql);
    $linha = mysqli_fetch_array($resultado);
   
?>
        <div id="login">
            <form method="POST" enctype="multipart/form-data">
                <div class="col-xs-12 col-sm-offset-2 col-sm-8 col-lg-offset-4 col-lg-4">
                    <br><label>Descrição:</label>
                    <input type="text" name="txtDesc" class="campo form-control" value="<?php echo $linha["descricao"]; ?>">
                    <br><label>Preço:</label>
                    <input type="text" name="txtPreco" class="campo form-control" value="<?php echo formataValor($linha["preco"]); ?>">
                    <br><label>Imagem:</label>
                    <input type="file" name="txtImagem" class="campo form-control" value="<?php echo $linha["imagem"]; ?>">
                    <br><label>Observação:</label>
                    <textarea name="txtObs" class="campo form-control" value="<?php echo $linha["observacao"]; ?>"></textarea>
                    <br><label>
                    <input type="checkbox" value="1" name="txtInativo" class="form-check-input"> Inativo</label><br>
                    <input type="submit" value="Alterar" name="btGravar" class="btn btn-primary" >
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
               
                $sql="UPDATE produto SET descricao='$descricao', preco='$preco', observacao='$observacao', imagem='$imagem' WHERE idproduto=$id";
                   
                $Conexao->query($sql);

                if($Conexao->errno == 0){
                    echo "<script>alert('Produto cadastrado com sucesso!');</script>";
                }else{
                    echo "<script>alert('Erro ao cadastrar o produto');</script>";
                }
            }
        ?>
    
<?php
    include "rodape.html";
?>

