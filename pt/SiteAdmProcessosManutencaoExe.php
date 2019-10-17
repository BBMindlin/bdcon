<?php
//Recurso para permitir o redirecionamento (evitar duplicidade de header).
ob_start();


//Importação dos arquivos de configuração.
require_once "../sistema/IncludeConfig.php"; //Deve vir antes do db.
require_once "../sistema/IncludeConexao.php";
require_once "../sistema/IncludeFuncoes.php";
//require_once "IncludeLayout.php";
require_once "IncludeLayoutSite.php";


//Verificação de login de processos.
LoginAutenticacao::CadastroLoginVerificacao();


//Resgate de variáveis.
$id = ContadorUniversal::ContadorUniversalUpdate(1);
$tipoComplemento = $_POST["tipo_complemento"];
//$complemento = $_POST["complemento"];
$complemento = Funcoes::ConteudoMascaraGravacao01($_POST["complemento"]);
//$descricao = $_POST["descricao"];
$descricao = Funcoes::ConteudoMascaraGravacao01($_POST["descricao"]);

$paginaRetorno = $_POST["paginaRetorno"];
$mensagemErro = "";
$mensagemSucesso = "";


//Query de inclusão.
//----------
$strSqlProcessosManutencaoInsert = "";
$strSqlProcessosManutencaoInsert .= "INSERT INTO tb_processos_complemento ";
$strSqlProcessosManutencaoInsert .= "SET ";
$strSqlProcessosManutencaoInsert .= "id = :id, ";
$strSqlProcessosManutencaoInsert .= "tipo_complemento = :tipo_complemento, ";
$strSqlProcessosManutencaoInsert .= "complemento = :complemento, ";
$strSqlProcessosManutencaoInsert .= "descricao = :descricao ";
//----------


//Parâmetros.
//----------
$statementProcessosManutencaoInsert = $dbSistemaConPDO->prepare($strSqlProcessosManutencaoInsert);

if ($statementProcessosManutencaoInsert !== false)
{
	$statementProcessosManutencaoInsert->execute(array(
		"id" => $id,
		"tipo_complemento" => $tipoComplemento,
		"complemento" => $complemento,
		"descricao" => $descricao
	));
	
	$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus2");
}else{
	//echo "erro";
	$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus3");
}
//----------


//Limpeza de objetos.
//----------
unset($strSqlProcessosManutencaoInsert);
unset($statementProcessosManutencaoInsert);
//----------


//Montagem do URL de retorno.
//$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
$URLRetorno = $configUrl . "/" . $visualizacaoAtivaSistema . "/" . $paginaRetorno . "?" .
"tipoComplemento=" . $tipoComplemento .
$queryPadrao .
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