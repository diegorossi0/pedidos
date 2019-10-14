<?php
    session_start();
    if($_SESSION["cliente"]==0)
        include "cabecalhoadm.html";
    else
        include "cabecalho.html";
    include "Conexao.php";
    include "util.inc";
    
?>
        <div id="login">
            <form method="POST">
                <div class="col-xs-12 col-md-8">
                    <div class="col-xs-12 col-sm-8">
                        <label>Produto:</label>
                        <select name="txtProduto" id="txtProduto" class="campo form-control">
                            <option value="">Selecione um produto</option>
                            <?php
                                $idfornecedor = $_GET['idfornecedor'];
                                $sql="SELECT * FROM produto WHERE fornecedor_idfornecedor = $idfornecedor";
                    
                                $resultado= $conexao->query($sql);
                                while($linha=$resultado->fetch_array()){
                                    echo "<option value='".$linha["idproduto"]."'>".$linha["descricao"]."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <label>Quantidade:</label>
                        <input type="number" name="txtQuantidade" id="txtQuantidade" class="campo form-control">
                    </div>
                    <div class="col-xs-12">&nbsp;</div>
                    <div class="col-xs-12 col-sm-8">
                        <label>Observação:</label>
                        <textarea name="txtObs" class="campo form-control"></textarea>
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <label>Valor Unitário:</label>
                        <input type="text" name="txtValor" id="txtValor" class="campo form-control form-control-sm" readonly required>
                        <label>Total:</label>
                        <input type="text" name="txtTotal" id="txtTotal" class="campo form-control form-control-sm" readonly required>
                    </div>
                    <div class="col-xs-12">
                        <br>
                        <input type="submit" value="Adicionar Produto" name="btGravar" class="btn btn-primary float-right" >
                        <br><br>
                    </div>
                </div>
                <div class="col-xs-12 col-md-4">
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol id="divindica" class="carousel-indicators">
                            <!--ADICIONADO DINÂMICAMENTE VIA JS-->
                            <!--<li data-target="#carousel-example-generic" data-slide-to="1"></li>-->
                        </ol>

                        <!-- Wrapper for slides -->
                        <div id="divimg" class="carousel-inner" role="listbox">
                            <!--ADICIONADO DINÂMICAMENTE VIA JS-->
                            <!--        
                            <div class="item">
                                <img src="img/2.jpg" alt="...">
                            </div>
                            -->
                        </div>

                        <!-- Controls -->
                        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>  
            </form>
        </div>
        <?php
            $idpedido=$_GET["idpedido"];
            $idfornecedor=$_GET["idfornecedor"];

            if(isset($_POST["btGravar"])){
               $idproduto=$_POST["txtProduto"];
               $quantidade=$_POST["txtQuantidade"];
               $observacao=$_POST["txtObs"];
               $valor=limpaValor($_POST["txtValor"]);
               $total=limpaValor($_POST["txtTotal"]);

               
               $sql="INSERT INTO itemPedido (pedido_idpedido, produto_idproduto, qtde, observacao, valor, total ) 
               VALUES ($idpedido, $idproduto, $quantidade, '$observacao', $valor, $total)";

                $conexao->query($sql);
              
               
          
   
               if($conexao->errno != 0){
                   echo "<script>alert('Erro ao cadastrar o item');</script>";
               }
            }


        ?>
        <div class="col-xs-12">
            <table class="table table-hover">
            <tr>
                <th>Descrição</th>
                <th>Quantidade</th>
                <th>Valor Unitário</th>
                <th>Total</th>
            </tr>
            <?php
                //Exibir os itens gravados
                $sql = "SELECT * FROM itemPedido ip INNER JOIN produto p 
                ON p.idproduto = ip.produto_idproduto
                WHERE pedido_idpedido = $idpedido";
                $resultado= $conexao->query($sql);
                while($linha=$resultado->fetch_array()){
                    echo "<tr>";
                    echo "<td>".$linha["descricao"]."</td>";
                    echo "<td>".$linha["qtde"]."</td>";
                    echo "<td>".formataValor($linha["valor"])."</td>";
                    echo "<td>".formataValor($linha["total"])."</td>";
                    echo "</tr>";
                }
            ?>
            </table>
            <p class="text-right">
            Total do pedido: <span class="badge badge-light">
            <?php
                $sql="SELECT * FROM pedido WHERE idpedido = $idpedido";
    
                $resultado= $conexao->query($sql);
                while($linha=$resultado->fetch_array()){
                    echo formataValor($linha["totalgeral"]);
                }
            ?></span></p>
        
           
    
            <a href="fpag.php?idfornecedor=<?php echo"$idfornecedor"?>&idpedido=<?php echo"$idpedido"?>"class="btn btn-primary btn-sm btn-block">Finalizar Pedido</a>
            <?php
            
        
        ?>
        </div>
        </div>
    <script>
        $( "#txtProduto" ).change(function() {
            valorProduto($( "#txtProduto" ).val());
            imagemProduto($("#txtProduto").val());
        });

        $( "#txtQuantidade" ).change(function() {
            var valor =  limpaValor($( "#txtValor" ).val());
            var qtde = $( "#txtQuantidade" ).val();
            var total = valor*qtde;
            $( "#txtTotal" ).val(formataValor(total));
        });

        function valorProduto(valor){
            var url  = "pesquisaprod.php?idproduto="+valor;
            console.log(url);
            $.get(url , function( data ) {
                $( "#txtValor" ).val( formataValor(data) );
                $( "#txtTotal" ).val( "" );
            });
        }

        function imagemProduto(valor){
            var url  = "pesquisaimgprod.php?idproduto="+valor;
            $.get(url , function( data ) {
                var imgs = data.split("/");
                var i = 0;
                while(i < imgs.length){
                    console.log(imgs[i]);
                    if(i==0){
                        $('#divindica').html('<li data-target="#carousel-example-generic" data-slide-to="'+i+'" class="active"></li>');
                        $('#divimg').html('<div class="item active"><img src="prod/'+imgs[i]+'"></div>');
                    }else{
                        $('#divindica').append('<li data-target="#carousel-example-generic" data-slide-to="'+i+'" ></li>');
                        $('#divimg').append('<div class="item"><img src="prod/'+imgs[i]+'"></div>');
                    }
                    
                    i++;
                }
                //$( "#txtTotal" ).val( "" );
            });
        }

        function formataValor(valor){
            var res = parseFloat(valor).toFixed(2);
            res = res.replace(".", ",");
            return "R$ "+res;
        }

        function limpaValor(valor){
            var res = valor.replace(",", ".");
            res = res.replace("R$ ", "");
            return res;
        }
    </script>
<?php
    include "rodape.html";
?>

