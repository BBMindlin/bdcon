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
//$id = ContadorUniversal::ContadorUniversalUpdate(1);
$id = $_POST["idTbUsuarios"];

$nome = Funcoes::ConteudoMascaraGravacao01($_POST["nome"]);
$usuario = Funcoes::ConteudoMascaraGravacao01($_POST["usuario"]);

if($GLOBALS['configUsuariosMetodoSenha'] == 1)
{
	if(empty($_POST["senha"]))
	{
		$senha = DbFuncoes::GetCampoGenerico01($id, "tb_usuarios", "senha");
	}else{
		//$senha = Crypto::EncryptValue(Funcoes::ConteudoMascaraLeitura($_POST["senha"]), 2);
		//$senha = Crypto::EncryptValue(Funcoes::ConteudoMascaraGravacao01($_POST["senha"]), 2);
		$senha = Crypto::EncryptValue(Funcoes::ConteudoMascaraGravacao01($_POST["senha"]), $GLOBALS['configUsuariosMetodoSenha']);
		//$senha = Crypto::EncryptValue($_POST["senha"], 2);
	}
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
//$usuarioData = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");
$usuarioTipo = $_POST["usuario_tipo"];
//$usuarioTipo = "0";
$ativacao = $_POST["ativacao"];
//$ativacao = "1";


$paginaRetorno = $_POST["paginaRetorno"];
$mensagemErro = "";
$mensagemSucesso = "";


//Update de registro no BD.
//----------
$strSqlUsuariosUpdate = "";
$strSqlUsuariosUpdate .= "UPDATE tb_usuarios ";
$strSqlUsuariosUpdate .= "SET ";
//$strSqlUsuariosUpdate .= "id = :id, ";
$strSqlUsuariosUpdate .= "nome = :nome, ";
$strSqlUsuariosUpdate .= "usuario = :usuario, ";
$strSqlUsuariosUpdate .= "senha = :senha, ";
$strSqlUsuariosUpdate .= "email = :email, ";
$strSqlUsuariosUpdate .= "obs = :obs, ";
//$strSqlUsuariosUpdate .= "usuario_data = :usuario_data, ";
$strSqlUsuariosUpdate .= "usuario_tipo = :usuario_tipo, ";
$strSqlUsuariosUpdate .= "ativacao = :ativacao ";

$strSqlUsuariosUpdate .= "WHERE id = :id ";
//echo "strSqlCategoriasUpdate = " . $strSqlUsuariosUpdate . "<br />";
//----------


$statementUsuariosUpdate = $dbSistemaConPDO->prepare($strSqlUsuariosUpdate);


/*
"usuario_data" => $usuarioData,
*/
if ($statementUsuariosUpdate !== false)
{
	$statementUsuariosUpdate->execute(array(
		"id" => $id,
		"nome" => $nome,
		"usuario" => $usuario,
		"senha" => $senha,		
		"email" => $email,		
		"obs" => $obs,		
		"usuario_tipo" => $usuarioTipo,
		"ativacao" => $ativacao
	));
	
	$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus7");
}else{
	//echo "erro";
	$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus8");
}

//Limpeza de objetos.
unset($strSqlUsuariosUpdate);
unset($statementUsuariosUpdate);
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