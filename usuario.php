<?php
    session_start();
    include "cabecalhologin.html";
    include "Conexao.php";
?>
        
        <div id="login">
            <form method="POST">
                <div class="col-xs-12 col-sm-offset-2 col-sm-8 col-lg-offset-4 col-lg-4">
                    <label>Nome:</label>
                    <input type="name" name="txtName" class="campo form-control">                   
                    <br><label>Email:</label>
                    <input type="email" name="txtEmail" class="campo form-control">
                    <br><label>CPF/CNPJ:</label>
                    <input type="text" name="txtCpf" class="campo form-control">
                    <br><label>Senha:</label>
                    <input type="password" name="txtSenha" class="campo form-control">
                    <br><label>Telefone:</label>
                    <input type="tel" name="txtTel" class="campo form-control">
                    <br><label>Logradouro:</label>
                    <input type="log" name="txtLog" class="campo form-control">
                    <br><label>Número:</label>
                    <input type="num" name="txtNum" class="campo form-control">
                    <br><label>Complemento:</label>
                    <input type="comp" name="txtComp" class="campo form-control">
                    <br><label>Bairro:</label>
                    <input type="bairro" name="txtBairro" class="campo form-control">
                    <br><label>Cidade:</label>
                    <input type="cidade" name="txtCidade" class="campo form-control">
                    
                    <br><label>UF:</label>
                    <select name="txtUF" class="campo form-control">
                        <option value=""> </option>
                        <option value="ac"> AC - Acre</option>
                        <option value="al"> AL - Alagoas</option>
                        <option value="ap"> AP - Amapá</option>
                        <option value="mg"> AM - Amazonas</option> 
                        <option value="mg"> BA - Bahia</option>
                        <option value="mg"> CE - Ceará</option>
                        <option value="mg"> DF - Distrito Federal</option>
                        <option value="mg"> ES - Espírito Santo</option>
                        <option value="mg"> GO - Goiás</option>
                        <option value="mg"> MA - Maranhão</option>
                        <option value="mg"> MT - Mato Grosso</option>
                        <option value="mg"> MS - M. Grosso do Sul</option>
                        <option value="mg"> MG - Minas Gerais</option>
                        <option value="mg"> PA - Pará</option>
                        <option value="mg"> PB - Paraíba</option>
                        <option value="mg"> PR - Paraná</option>
                        <option value="mg"> PE - Pernambuco</option>
                        <option value="mg"> PI - Piauí</option>
                        <option value="mg"> RJ - Rio de Janeiro</option>
                        <option value="mg"> RN - Rio G. do Norte</option>
                        <option value="mg"> RS - Rio G. do Sul</option>
                        <option value="mg"> RO - Rondônia</option>
                        <option value="mg"> RR - Roraima</option>
                        <option value="mg"> SC - Santa Catarina</option>
                        <option value="mg"> SP - São Paulo</option>
                        <option value="mg"> SE - Sergipe</option>
                        <option value="mg"> TO - Tocantins</option>
                    </select>
                    
                    <br><label>Cep:</label>
                    <input type="cep" name="txtCep" class="campo form-control">
                    <br>
                                        
                    
                    <input type="submit" value="Cadastrar-se" name="btGravar" class="btn btn-primary" >
                    <br><br><br>
                </div>  
            </form>
        </div>
        
        <?php
           
           if(isset($_POST["btGravar"])){
               $nome=$_POST["txtName"];
               $email=$_POST["txtEmail"];
               $senha=$_POST["txtSenha"];
               $telefone=$_POST["txtTel"];
               $logradouro=$_POST["txtLog"];
               $numero=$_POST["txtNum"];
               $complemento=$_POST["txtComp"];
               $bairro=$_POST["txtBairro"];
               $cidade=$_POST["txtCidade"];
               $uf=$_POST["txtUF"];
               $cep=$_POST["txtCep"];
               $cpf=$_POST["txtCpf"];
               //Capturar todos os campos
               
            $sql="INSERT INTO usuario (nome, email, senha, telefone, logradouro, numero, complemento, bairro, cidade, uf, cep, cpf ) 
            VALUES ('$nome', '$email', '$senha', '$telefone', '$logradouro', '$numero', '$complemento', '$bairro', '$cidade', '$uf', '$cep', '$cpf')";
            
            $conexao->query($sql);

            if($conexao->errno == 0){
                echo "<script>alert('Usuário cadastrado com sucesso!');</script>";
            }else{
                echo "<script>alert('Erro ao cadastrar o usuário');</script>";
            }
        }
        ?>
    
<?php
    include "rodape.html";
?>

