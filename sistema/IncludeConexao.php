<?php
//DB Sistema.
//**************************************************************************************
//require_once 'login.php';
$dbSistemaHost = 'localhost'; //127.0.0.1 | localhost
//Obs: UOL - endereço do servidor
$dbSistemaBancoDados = 'rel_db_uspbdc';
$dbSistemaUsuario = '<usuÃ¡rio>';
$dbSistemaSenha = '<senha>';

//$db_server = mysql_connect($db_hostname, $db_username, $db_password);
$dbSistemaCon = mysqli_connect($dbSistemaHost, $dbSistemaUsuario, $dbSistemaSenha, $dbSistemaBancoDados);
if (!$dbSistemaCon)
{
	die("Unable to connect to MySQL: " . mysqli_error());
}

//mysqli conexão para parametrização (Object Oriented.
$dbSistemaConMysqli = new mysqli($dbSistemaHost, $dbSistemaUsuario, $dbSistemaSenha, $dbSistemaBancoDados); 

if ($dbSistemaConMysqli->connect_error) {
    die('Connect Error (' . $dbSistemaConMysqli->connect_errno . ') ' . $dbSistemaConMysqli->connect_error);
}else{
	//utilizar o character set UTF8
	$dbSistemaConMysqli->set_charset("utf8");
}

//PDO - Concexão para diversos tipos de banco de dados.
try {
    $dbSistemaConPDO = new PDO("mysql:host=".$dbSistemaHost.";dbname=".$dbSistemaBancoDados."", $dbSistemaUsuario, $dbSistemaSenha);
	$dbSistemaConPDO->exec("set names utf8");
	$dbSistemaConPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Mostrar erros.
}catch(PDOException $erroDBPDO) {
    //print "Error!: " . $erroDBPDO->getMessage() . "<br/>";
    die("Error!: " . $erroDBPDO->getMessage() . "<br />");
}

/*
if (mysqli_connect_errno())
   {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
   }
*/   

/*
exemplo bom de msg de erro:
function mysql_fatal_error($msg)
{
$msg2 - mysql_error();
echo <<< _END
We are sorry, but it was not possible to complete
the requested task. The error message we got was:
<p>$msg: $msg2</p>
Please click the back button on your browser
and try again. If you are still having problems,
Querying a MySQL Database with PHP | 227
Download at Boykma.Com
www.it-ebooks.info
please <a href="mailto:admin@server.com">email
our administrator</a>. Thank you.
_END;
}
*/
//**************************************************************************************
?>
