<?php
    session_start();
    if($_SESSION["cliente"]==0)
        include "cabecalhoadm.html";
    else
        header("location:selecao.php");
    include "Conexao.php";
    $id = $_GET["id"];
    $sql = "SELECT * FROM fornecedor WHERE idfornecedor=$id";
    $resultado = $conexao->query($sql);
    $linha = mysqli_fetch_array($resultado);        
?>
        <div id="login">
            <form method="POST">
                <div class="col-xs-12 col-sm-offset-2 col-sm-8 col-lg-offset-4 col-lg-4">
                    <label>Nome:</label>
                    <input type="text" name="txtNome" class="campo form-control" value="<?php echo $linha["nome"]; ?>">
                    <br><label>Email:</label>
                    <input type="email" name="txtEmail" class="campo form-control" value="<?php echo $linha["email"]; ?>">
                    <br><label>Telefone:</label>
                    <input type="text" name="txtTel" class="campo form-control" value="<?php echo $linha["telefone"]; ?>">
                    <br><label>Logradouro:</label>
                    <input type="text" name="txtLog" class="campo form-control" value="<?php echo $linha["logradouro"]; ?>">
                    <br><label>Número:</label>
                    <input type="text" name="txtNum" class="campo form-control" value="<?php echo $linha["numero"]; ?>">
                    <br><label>Complemento:</label>
                    <input type="text" name="txtComp" class="campo form-control" value="<?php echo $linha["complemento"]; ?>">
                    <br><label>Bairro:</label>
                    <input type="text" name="txtBairro" class="campo form-control" value="<?php echo $linha["bairro"]; ?>">
                    <br><label>Cidade:</label>
                    <input type="text" name="txtCidade" class="campo form-control" value="<?php echo $linha["cidade"]; ?>">
                    <br><label>UF:</label>
                    <select name="txtUF" id="txtUF"  class="campo form-control" value="<?php echo $linha["uf"]; ?>">
                        <option value=""> </option>
                        <option value="ac"> AC - Acre</option>
                        <option value="al"> AL - Alagoas</option>
                        <option value="ap"> AP - Amapá</option>
                        <option value="am"> AM - Amazonas</option> 
                        <option value="ba"> BA - Bahia</option>
                        <option value="ce"> CE - Ceará</option>
                        <option value="df"> DF - Distrito Federal</option>
                        <option value="es"> ES - Espírito Santo</option>
                        <option value="go"> GO - Goiás</option>
                        <option value="ma"> MA - Maranhão</option>
                        <option value="mt"> MT - Mato Grosso</option>
                        <option value="ms"> MS - M. Grosso do Sul</option>
                        <option value="mg"> MG - Minas Gerais</option>
                        <option value="pa"> PA - Pará</option>
                        <option value="pb"> PB - Paraíba</option>
                        <option value="pr"> PR - Paraná</option>
                        <option value="pe"> PE - Pernambuco</option>
                        <option value="pi"> PI - Piauí</option>
                        <option value="rj"> RJ - Rio de Janeiro</option>
                        <option value="rn"> RN - Rio G. do Norte</option>
                        <option value="rs"> RS - Rio G. do Sul</option>
                        <option value="ro"> RO - Rondônia</option>
                        <option value="rr"> RR - Roraima</option>
                        <option value="sc"> SC - Santa Catarina</option>
                        <option value="sp"> SP - São Paulo</option>
                        <option value="se"> SE - Sergipe</option>
                        <option value="to"> TO - Tocantins</option>
                    </select>
                    <br><label>CEP:</label>
                    <input type="text" name="txtCep" class="campo form-control" value="<?php echo $linha["cep"]; ?>"><br>
                    
                    <label>Políticas da empresa:</label>
                    <textarea name="txtRegras" class="campo form-control" value="<?php echo $linha["regras"]; ?>"></textarea><br>
                   
                    
                    <br><label>Razão Social:</label>
                    <input type="text" name="txtRS" class="campo form-control" value="<?php echo $linha["razao"]; ?>"><br>
                    
                    <br><label>Inscrição Estadual:</label>
                    <input type="text" name="txtIE" class="campo form-control" value="<?php echo $linha["inscricao"]; ?>"><br>
                    <br><input type="submit" value="Entrar" name="btGravar" class="btn btn-primary" ><br><br><br><br>
                    
                </div>  
            </form>
            
        </div>
        
        <?php
            if(isset($_POST["btGravar"])){
                $nome=$_POST["txtNome"];
                $email=$_POST["txtEmail"];
                $telefone=$_POST["txtTel"];
                $logradouro=$_POST["txtLog"];
                $numero=$_POST["txtNum"];
                $complemento=$_POST["txtComp"];
                $bairro=$_POST["txtBairro"];
                $cidade=$_POST["txtCidade"];
                $uf=$_POST["txtUF"];
                $cep=$_POST["txtCep"];
                $regras=$_POST["txtRegras"];
                $razaos=$_POST["txtRS"];
                $iestadual=$_POST["txtIE"];

                $sql="UPDATE fornecedor SET nome='$nome', email='$email', telefone='$telefone', logradouro='$logradouro', numero='$numero', complemento='$complemento', bairro='$bairro', cidade='$cidade', uf='$uf', cep='$cep', regras='$regras', razao='$razaos', inscricao='$iestadual'  WHERE idfornecedor=$id"; 
                   
                $conexao->query($sql);

                if($conexao->errno == 0){
                    echo "<script>alert('Fornecedor cadastrado com sucesso!');window.location.href = 'fornecedor.php';</script>";
                }else{
                    echo "<script>alert('Erro ao cadastrar o fornecedor');</script>";

                }
            }
            ?>

            <script>
                <?php echo "$('#txtUF').val('".$linha['uf']."');"; ?>
            </script>
    
<?php
    include "rodape.html";
?>

