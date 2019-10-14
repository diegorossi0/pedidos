<?php
    session_start();
    if($_SESSION["cliente"]==0)
        include "cabecalhoadm.html";
    else
        header("location:selecao.php");
    include "Conexao.php";        
?>
        <div id="login">
        <div calss="col-xs-12">
            <table class="table table-hover">
            <tr>
                <th>Ano</th>
                <th>Mês</th>
                <th> </th>

            </tr>
                        <?php
                         $sql="SELECT DISTINCT MONTH(data) as mes, YEAR(data) as ano FROM pedido ORDER BY data DESC LIMIT 18";
                         $resultado = $conexao->query($sql);
                
                         while($linha=$resultado->fetch_array()){
                            echo "<tr>";
                            echo "<td>".$linha["ano"]."</td>";
                            echo "<td>".$linha["mes"]."</td>";
                            echo "<td><a href='produtomes.php?ano=".$linha["ano"]."&mes=".$linha["mes"]."'>X</a></td>";
                            echo "</tr>";
                        }
                  
                         ?>
                        </option>
                    </select>
                </div>  
            </form>
        </div>

<?php
    include "rodape.html";
?>

