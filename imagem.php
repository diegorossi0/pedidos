<?php
    session_start();
    if($_SESSION["cliente"]==0)
        include "cabecalhoadm.html";
    else
        include "cabecalho.html";
    include "Conexao.php";
    include "util.inc"
?>
        <div id="login">
            <form method="POST" enctype="multipart/form-data">
                <div class="col-xs-12  col-sm-12 col-lg-12 text-center">
                    
                    <a href="produto.php" class="btn btn-danger"><i class="fas fa-arrow-circle-left"></i> Voltar</a><br>
                    
                    <br><label>Imagem:</label>
                    <input type="file" name="txtImagem" class="campo form-control">
                    <br>
                    <input type="submit" value="Gravar" name="btGravar" class="btn btn-primary" >
                    <br><br><br>
                </div>  
            </form>
       
        <?php
            $id=$_GET["id"];
            if(isset($_POST["btGravar"])){
                
                $imagemTmp=$_FILES["txtImagem"]["tmp_name"];
                $imagem=date("dmyHis").$_FILES["txtImagem"]["name"];
                

                //enviar a imagem
                if($_FILES["txtImagem"]["error"]!=0){
                    echo "Não foi possível adcionar imagem.";
                    exit;
                }

                $nomeimg = $_FILES["txtImagem"]["name"];
                $sql="SELECT imagem from produto where imagem like '%$nomeimg%' and idproduto = $id ";
                $resultado =  $conexao->query($sql);
                if ( mysqli_num_rows($resultado) > 0) {
                    echo "<script>alert('Imagem duplicada, escolha outro arquivo ou mude o nome da imagem');</script>";
                exit;
                }

                move_uploaded_file($imagemTmp, "prod/".$imagem);

               
                $sql="UPDATE produto SET imagem = concat(imagem,'/', '$imagem') WHERE idproduto = $id";


                $conexao->query($sql);

               

                if($conexao->errno == 0){
                    echo "<script>alert('Imagem cadastrada com sucesso!');</script>";
                }else{
                    echo "<script>alert('Erro ao cadastrar a imagem');</script>";
                }
            }
             $sql="SELECT imagem from produto where idproduto = $id ";
                $resultado =  $conexao->query($sql);
                $imags = mysqli_fetch_array($resultado);
                $vimg = explode ("/", $imags[0] );

                for ($i = 0;$i < sizeof($vimg); $i++ ){
                    $img = $vimg [$i];


                    echo"<div class='col-xs-6 col-md-4'>";
                    echo"<img class='img-responsive img-thumbnail'  src='prod/$img'></div>";

                } 
                echo"<div style = 'clear:both;'>
                
                
                
                </div>";
        ?>
     </div>
<?php
    include "rodape.html";
?>

