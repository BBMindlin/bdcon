<?php
//Recurso para permitir o redirecionamento (evitar duplicidade de header).
ob_start();


//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
//require_once "IncludeUsuarioVerificacao.php";
require_once "IncludeLayout.php";


//Resgate de variáveis.
$id = $_POST["idTbCadastroComplemento"];
$tipoComplemento = $_POST["tipo_complemento"];
//$complemento = $_POST["complemento"];
$complemento = Funcoes::ConteudoMascaraGravacao01($_POST["complemento"]);
//$descricao = $_POST["descricao"];
$descricao = Funcoes::ConteudoMascaraGravacao01($_POST["descricao"]);

$paginaRetorno = $_POST["paginaRetorno"];
$mensagemErro = "";
$mensagemSucesso = "";


//Montagem do query de update.
//----------
$strSqlCadastroManutencaoUpdate = "";
$strSqlCadastroManutencaoUpdate .= "UPDATE tb_cadastro_complemento ";
$strSqlCadastroManutencaoUpdate .= "SET ";
//$strSqlCadastroManutencaoUpdate .= "id = :id, ";
$strSqlCadastroManutencaoUpdate .= "tipo_complemento = :tipo_complemento, ";
$strSqlCadastroManutencaoUpdate .= "complemento = :complemento, ";
$strSqlCadastroManutencaoUpdate .= "descricao = :descricao ";
$strSqlCadastroManutencaoUpdate .= "WHERE id = :id ";
//----------


//Parâmetros.
//----------
$statementCadastroManutencaoUpdate = $dbSistemaConPDO->prepare($strSqlCadastroManutencaoUpdate);

if ($statementCadastroManutencaoUpdate !== false)
{
	$statementCadastroManutencaoUpdate->execute(array(
		"id" => $id,
		"tipo_complemento" => $tipoComplemento,
		"complemento" => $complemento,
		"descricao" => $descricao
	));
	
	$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus7");
}else{
	//echo "erro";
	$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus8");
}
//----------


//Limpeza de objetos.
//----------
unset($strSqlCadastroManutencaoUpdate);
unset($statementCadastroManutencaoUpdate);
//----------


//Fechamento da conexão.
$dbSistemaConPDO = null;


//Montagem do URL de retorno.
//"idParentCategorias=" . $idParentCategorias .
$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
"mensagemSucesso=" . $mensagemSucesso .
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
