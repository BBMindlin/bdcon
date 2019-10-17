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
$id = ContadorUniversal::ContadorUniversalUpdate(1);
$tipoComplemento = $_POST["tipo_complemento"];
//$complemento = $_POST["complemento"];
$complemento = Funcoes::ConteudoMascaraGravacao01($_POST["complemento"]);
//$descricao = $_POST["descricao"];
$descricao = Funcoes::ConteudoMascaraGravacao01($_POST["descricao"]);

$idItem = $_POST["idItem"];
$configCaixaSelecao = $_POST["configCaixaSelecao"];

$paginaRetorno = $_POST["paginaRetorno"];
$masterPageSiteSelect = $_POST["masterPageSiteSelect"];
$mensagemErro = "";
$mensagemSucesso = "";

//Montagem de query padrão de retorno.
//"&funcaoRetorno=1" . 
$queryPadrao = "&paginaRetorno=" . $paginaRetorno . 
"&idItem=" . $idItem . 
"&configCaixaSelecao=" . $configCaixaSelecao . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&masterPageSiteSelect=" . $masterPageSiteSelect;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Query de inclusão.
//----------
$strSqlProdutosManutencaoInsert = "";
$strSqlProdutosManutencaoInsert .= "INSERT INTO tb_produtos_complemento ";
$strSqlProdutosManutencaoInsert .= "SET ";
$strSqlProdutosManutencaoInsert .= "id = :id, ";
$strSqlProdutosManutencaoInsert .= "tipo_complemento = :tipo_complemento, ";
$strSqlProdutosManutencaoInsert .= "complemento = :complemento, ";
$strSqlProdutosManutencaoInsert .= "descricao = :descricao ";
//----------


//Parâmetros.
//----------
$statementProdutosManutencaoInsert = $dbSistemaConPDO->prepare($strSqlProdutosManutencaoInsert);

if ($statementProdutosManutencaoInsert !== false)
{
	$statementProdutosManutencaoInsert->execute(array(
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
unset($strSqlProdutosManutencaoInsert);
unset($statementProdutosManutencaoInsert);
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