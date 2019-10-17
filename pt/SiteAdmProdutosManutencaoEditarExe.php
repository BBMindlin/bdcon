<?php
//Recurso para permitir o redirecionamento (evitar duplicidade de header).
ob_start();


//Importação dos arquivos de configuração.
require_once "../sistema/IncludeConfig.php"; //Deve vir antes do db.
require_once "../sistema/IncludeConexao.php";
require_once "../sistema/IncludeFuncoes.php";
//require_once "IncludeLayout.php";
require_once "IncludeLayoutSite.php";


//Verificação de login de cadastro.
LoginAutenticacao::CadastroLoginVerificacao();


//Resgate de variáveis.
$id = $_POST["idTbProdutosComplemento"];
$tipoComplemento = $_POST["tipo_complemento"];
//$complemento = $_POST["complemento"];
$complemento = Funcoes::ConteudoMascaraGravacao01($_POST["complemento"]);
//$descricao = $_POST["descricao"];
$descricao = Funcoes::ConteudoMascaraGravacao01($_POST["descricao"]);

$idItem = $_POST["idItem"];
$configCaixaSelecao = $_POST["configCaixaSelecao"];

$paginaRetorno = $_POST["paginaRetorno"];
$mensagemErro = "";
$mensagemSucesso = "";

$queryPadrao = "&paginaRetorno=" . $paginaRetorno .
"&idItem=" . $idItem . 
"&configCaixaSelecao=" . $configCaixaSelecao . 
"&masterPageSiteSelect=" . $masterPageSiteSelect;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Montagem do query de update.
//----------
$strSqlProdutosManutencaoUpdate = "";
$strSqlProdutosManutencaoUpdate .= "UPDATE tb_produtos_complemento ";
$strSqlProdutosManutencaoUpdate .= "SET ";
//$strSqlProdutosManutencaoUpdate .= "id = :id, ";
$strSqlProdutosManutencaoUpdate .= "tipo_complemento = :tipo_complemento, ";
$strSqlProdutosManutencaoUpdate .= "complemento = :complemento, ";
$strSqlProdutosManutencaoUpdate .= "descricao = :descricao ";
$strSqlProdutosManutencaoUpdate .= "WHERE id = :id ";
//----------


//Parâmetros.
//----------
$statementProdutosManutencaoUpdate = $dbSistemaConPDO->prepare($strSqlProdutosManutencaoUpdate);

if ($statementProdutosManutencaoUpdate !== false)
{
	$statementProdutosManutencaoUpdate->execute(array(
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
unset($strSqlProdutosManutencaoUpdate);
unset($statementProdutosManutencaoUpdate);
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