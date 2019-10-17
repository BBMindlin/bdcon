<?php
$nome = $_GET['nome']; 
$email = $_GET['email']; 
$cel = $_GET['cel']; 
$aniversario = $_GET['aniversario']; 
$endereco = $_GET['endereco']; 
$bairro = $_GET['bairro']; 
$ja_esteve = $_GET['ja_esteve']; 
$conta_mais = $_GET['conta_mais']; 
$receber_novidades = $_GET['receber_novidades']; 
$receber_mensagens = $_GET['receber_mensagens'];
 
$como1 = $_GET['como1']; 
$como2 = $_GET['como2']; 
$como3 = $_GET['como3']; 
$como4 = $_GET['como4']; 
$como5 = $_GET['como5']; 
$como6 = $_GET['como6']; 
$como7 = $_GET['como7']; 
$como8 = $_GET['como8']; 

$to      = 'jm@planejamentovisual.com.br';
$subject = 'Envio de Contato';
$message = "Nome: ".$nome."\n"."e-mail: ".$email."\n"."Celular: ".$cel."\n"."Aniversário: ".$aniversario."\n"."Endereço: ".$endereco."\n"."Bairro: ".$bairro."\n"."Já Esteve no Tropeço? ".$ja_esteve."\n"."Conta Mais: ".$conta_mais."\n"."Gostaria de receber novidades por e-mail: ".$receber_novidades."\n"."Gostaria de receber mensagens de celular com informações e promoções exclusivas: ".$receber_mensagens."\n\n"."Variedade no cardápio: ".$como1."\n"."Sabor e Apresentação dos drinks: ".$como2."\n"."Temperatura do Chopp: ".$como3."\n"."Qualidade e rapidez da cozinha: ".$como4."\n"."Atendimento: ".$como5."\n"."Nosso ambiente: ".$como6."\n"."Preço: ".$como7."\n"."Impressão geral: ".$como8."\n";

// To send HTML mail, the Content-type header must be set
//$headers  = 'MIME-Version: 1.0' . "\r\n";
//$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

$headers = 'From:contato@bartropeco.com.br' . "\r\n" .
    'Reply-To: contato@bartropeco.com.br' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);
?> 
