<?php
    session_start();
    if($_SESSION["cliente"]==0)
        include "cabecalhoadm.html";
    else
        header("location:selecao.php");
    include "Conexao.php";        
?>
        <div id="login">
            <form method="POST">
                <div class="col-xs-12 col-sm-offset-2 col-sm-8 col-lg-offset-4 col-lg-4">
                    <label>Nome:</label>
                    <input type="text" name="txtNome" class="campo form-control">
                    <br><label>Email:</label>
                    <input type="email" name="txtEmail" class="campo form-control">
                    <br><label>Telefone:</label>
                    <input type="text" name="txtTel" class="campo form-control">
                    <br><label>Logradouro:</label>
                    <input type="text" name="txtLog" class="campo form-control">
                    <br><label>Número:</label>
                    <input type="text" name="txtNum" class="campo form-control">
                    <br><label>Complemento:</label>
                    <input type="text" name="txtComp" class="campo form-control">
                    <br><label>Bairro:</label>
                    <input type="text" name="txtBairro" class="campo form-control">
                    <br><label>Cidade:</label>
                    <input type="text" name="txtCidade" class="campo form-control">
                    <br><label>UF:</label>
                    <select name="txtUF" class="campo form-control">
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
                    <input type="text" name="txtCep" class="campo form-control"><br>
                    
                    <label>Políticas da empresa:</label>
                    <textarea name="txtRegras" class="campo form-control"></textarea><br>
                   
                    
                    <br><label>Razão Social:</label>
                    <input type="text" name="txtRS" class="campo form-control"><br>
                    
                    <br><label>Inscrição Estadual:</label>
                    <input type="text" name="txtIE" class="campo form-control"><br>
                    
                    <br><label>CNPJ:</label>
                    <input type="text" name="txtCNPJ" class="campo form-control"><br>
                    <br><input type="submit" value="Entrar" name="btGravar" class="btn btn-primary" ><br><br>
                    
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
                $cnpj=$_POST["txtCNPJ"];

                $sql="INSERT INTO fornecedor (nome, email, telefone, logradouro, numero, complemento, bairro, cidade, uf, cep, regras, razao, inscricao, cnpj) 
                    VALUES ('$nome', '$email', '$telefone', '$logradouro', '$numero', '$complemento', '$bairro', '$cidade', '$uf', '$cep', '$regras', '$razaos', '$iestadual', '$cnpj')";
                
                $conexao->query($sql);
                
                if($conexao->errno == 0){
                    echo "<script>alert('Fornecedor cadastrado com sucesso!');</script>";
                }else{
                    echo "<script>alert('Erro ao cadastrar o fornecedor');</script>";

                }
            }
            ?>

         <div calss="col-xs-12">
            <table class="table table-hover">
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th> </th>
                <th> </th>
            </tr>
            <?php
                //Exibir os itens gravados
                $sql = "SELECT * FROM fornecedor";
                $resultado= $conexao->query($sql);
                while($linha=$resultado->fetch_array()){
                    echo "<tr>";
                    echo "<td>".$linha["nome"]."</td>";
                    echo "<td>".$linha["email"]."</td>";
                    echo "<td><a href='alterarfornecedor.php?id=".$linha["idfornecedor"].
                                "'>Alterar</a></td>";
                     echo "<td><a href='apagarfornecedor.php?id=".$linha["idfornecedor"].
                                "'>Apagar</a></td>";
                    echo "</tr>";
                }
            ?>
            </table>
        </div>
    
<?php
    include "rodape.html";
?>

