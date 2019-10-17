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
$id = $_POST["idTbHistoricoComplemento"];
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

//Montagem de query padrão de retorno.
$queryPadrao = "&paginaRetorno=" . $paginaRetorno . 
"&idItem=" . $idItem . 
"&configCaixaSelecao=" . $configCaixaSelecao . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&masterPageSiteSelect=" . $masterPageSiteSelect;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Montagem do query de update.
//----------
$strSqlHistoricoManutencaoUpdate = "";
$strSqlHistoricoManutencaoUpdate .= "UPDATE tb_historico_complemento ";
$strSqlHistoricoManutencaoUpdate .= "SET ";
//$strSqlHistoricoManutencaoUpdate .= "id = :id, ";
$strSqlHistoricoManutencaoUpdate .= "tipo_complemento = :tipo_complemento, ";
$strSqlHistoricoManutencaoUpdate .= "complemento = :complemento, ";
$strSqlHistoricoManutencaoUpdate .= "descricao = :descricao ";
$strSqlHistoricoManutencaoUpdate .= "WHERE id = :id ";
//----------


//Parâmetros.
//----------
$statementHistoricoManutencaoUpdate = $dbSistemaConPDO->prepare($strSqlHistoricoManutencaoUpdate);

if ($statementHistoricoManutencaoUpdate !== false)
{
	$statementHistoricoManutencaoUpdate->execute(array(
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
unset($strSqlHistoricoManutencaoUpdate);
unset($statementHistoricoManutencaoUpdate);
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