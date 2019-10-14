<?php
    function formataValor($valor){
        $valor = "R$ ".number_format($valor, 2, ",", ".");
        return $valor;
    }

    function limpaValor($valor){
        //troca , por .
        $valor=str_replace(',', '.', $valor);
        //troca R$ por nada
        $valor=str_replace('R$', '', $valor);
        //troca espaço por nada
        $valor=str_replace(' ', '', $valor);
        return $valor;
    }

    function dataBR($data){
        return date("d/m/Y", strtotime($data));
    }
?>

<?php

/*require 'PHPMailer/class.phpmailer.php';*/

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

function disparoEmail($emaildest, $mensagem, $assunto){

$emaildest="diego.rossi@yahoo.com.br";

$mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = 'smtp.hostinger.com.br';
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Username = 'gisa@diegorossi.com.br';
    $mail->Password = '6z5t5lnrq';
    $mail->Port = 587;
     
    $mail->setFrom('gisa@diegorossi.com.br', 'Contato');
    $mail->addAddress($emaildest);
     
    $mail->isHTML(true);
     
    $mail->Subject = "$assunto";
    $mail->Body    = $mensagem;
    $mail->AltBody = strip_tags($mensagem);
     
    if(!$mail->send()) {
        echo 'Não foi possível enviar a mensagem.<br>';
        echo 'Erro: ' . $mail->ErrorInfo;
    } 
}

function leitura($caminhoarquivo){
    $arquivo = fopen ($caminhoarquivo, 'r');
    $linha="";
    while(!feof($arquivo)){
        $linha = $linha.fgets($arquivo, 1024);
    }
    fclose($arquivo);
    return $linha;
}

?>
