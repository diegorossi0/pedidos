<?php
    session_start();
    include "cabecalhologin.html";
    
?>


        <?php
            include "Conexao.php";
            
        ?>
        <div id="login">
            <form method="POST">
                <div class="col-xs-12 col-sm-offset-2 col-sm-8 col-lg-offset-4 col-lg-4">
                    <label>Email:</label>
                    <input type="email" name="txtEmail" class="campo form-control">
                    <br><label>Senha:</label>
                    <input type="password" name="txtSenha" class="campo form-control"><br>
                    <input type="submit" value="Entrar" name="btGravar" class="btn btn-primary" >
                    <br><br><br>
                </div>  
            </form>
        </div>
        <?php
            if(isset($_POST["btGravar"])){
               $email=$_POST["txtEmail"];
               $senha=$_POST["txtSenha"];
                
                $sql="SELECT * FROM usuario WHERE Email LIKE '$email' AND Senha LIKE '$senha'";
                
                $resultado= $conexao->query($sql);
                
                if($resultado->num_rows == 1){
                    $linha = $resultado->fetch_array();
                    $_SESSION["logado"] = true;
                    $_SESSION["idusu"] = $linha["idusuario"];
                    $_SESSION["cliente"] = $linha["cliente"];
                    header("location: selecao.php");
                }else{
                    echo "<script>alert('Usuário e/ou senha incorreto');</script>";
                }
            }
        ?>
    
<?php
    include "rodape.html";
?>

