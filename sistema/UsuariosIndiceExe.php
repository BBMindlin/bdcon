<?php
//Recurso para permitir o redirecionamento (evitar duplicidade de header).
ob_start();


//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeUsuarioVerificacao.php";
require_once "IncludeLayout.php";


//Resgate de variáveis.
$id = ContadorUniversal::ContadorUniversalUpdate(1);
//$idTbCategorias = $_POST["id_tb_categorias"];

$nome = Funcoes::ConteudoMascaraGravacao01($_POST["nome"]);
$usuario = Funcoes::ConteudoMascaraGravacao01($_POST["usuario"]);

if($GLOBALS['configUsuariosMetodoSenha'] == 1)
{
	//$senha = Crypto::EncryptValue(Funcoes::ConteudoMascaraLeitura($_POST["senha"]), 2);
	//$senha = Crypto::EncryptValue(Funcoes::ConteudoMascaraGravacao01($_POST["senha"]), 2);
	$senha = Crypto::EncryptValue(Funcoes::ConteudoMascaraGravacao01($_POST["senha"]), $GLOBALS['configUsuariosMetodoSenha']);
	//$senha = Crypto::EncryptValue($_POST["senha"], 2);
}

if($GLOBALS['configUsuariosMetodoSenha'] == 2)
{
	//$senha = Crypto::EncryptValue(Funcoes::ConteudoMascaraLeitura($_POST["senha"]), 2);
	//$senha = Crypto::EncryptValue(Funcoes::ConteudoMascaraGravacao01($_POST["senha"]), 2);
	$senha = Crypto::EncryptValue(Funcoes::ConteudoMascaraGravacao01($_POST["senha"]), $GLOBALS['configUsuariosMetodoSenha']);
	//$senha = Crypto::EncryptValue($_POST["senha"], 2);
}

$email = "";
$obs = "";
$usuarioData = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");
$usuarioTipo = "0";
//$ativacao = $_POST["ativacao"];
$ativacao = "1";

$paginaRetorno = $_POST["paginaRetorno"];
$mensagemErro = "";
$mensagemSucesso = "";


//Inclusão de registro no BD.
//----------
$strSqlUsuariosInsert = "";
$strSqlUsuariosInsert .= "INSERT INTO tb_usuarios ";
$strSqlUsuariosInsert .= "SET ";
$strSqlUsuariosInsert .= "id = :id, ";
$strSqlUsuariosInsert .= "nome = :nome, ";
$strSqlUsuariosInsert .= "usuario = :usuario, ";
$strSqlUsuariosInsert .= "senha = :senha, ";
$strSqlUsuariosInsert .= "email = :email, ";
$strSqlUsuariosInsert .= "obs = :obs, ";
$strSqlUsuariosInsert .= "usuario_data = :usuario_data, ";
$strSqlUsuariosInsert .= "usuario_tipo = :usuario_tipo, ";
$strSqlUsuariosInsert .= "ativacao = :ativacao ";


$statementUsuariosInsert = $dbSistemaConPDO->prepare($strSqlUsuariosInsert);

if ($statementUsuariosInsert !== false)
{
	$statementUsuariosInsert->execute(array(
		"id" => $id,
		"nome" => $nome,
		"usuario" => $usuario,
		"senha" => $senha,		
		"email" => $email,		
		"obs" => $obs,		
		"usuario_data" => $usuarioData,
		"usuario_tipo" => $usuarioTipo,
		"ativacao" => $ativacao
	));
	
	$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus2");
	//Obs: Colocar um flag de verificação de gravação.
}else{
	//echo "erro";
	$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus3");
}


//Limpeza de objetos.
unset($strSqlUsuariosInsert);
unset($statementUsuariosInsert);
//----------


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
//$dbSistemaConMysqli->close();
$dbSistemaConPDO = null;


//Montagem do URL de retorno.
$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
"&mensagemSucesso=" . $mensagemSucesso .
"&mensagemErro=" . $mensagemErro;

//Limpeza do buffer de saída.
///*
while (ob_get_status()) 
{
    ob_end_clean();
}
//*/

//Redirecionamento de página.
//exit();
header("Location: " . $URLRetorno);
die();
?>