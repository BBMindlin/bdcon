<?php
//Recurso para permitir o redirecionamento (evitar duplicidade de header).
ob_start();

//Importação dos arquivos de configuração.
require_once "../sistema/IncludeConfig.php"; //Deve vir antes do db.
require_once "../sistema/IncludeConexao.php";
require_once "../sistema/IncludeFuncoes.php";
//require_once "IncludeLayout.php";
require_once "IncludeLayoutSite.php";


//Resgate de variáveis.
$paginaRetorno = $_GET["paginaRetorno"];
if($paginaRetorno == "")
{
	$paginaRetorno = "SiteLogoff.php";
}

$mensagemErro = "";
$mensagemSucesso = "";

//CookiesFuncoes::CookieLogin_Logoff();
//$mensagemSucesso = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteLogoffMensagem01");


if(CookiesFuncoes::CookieLogin_Logoff() == true)
{
	//Sucesso.
	//$mensagemSucesso = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteLogoffMensagem01"); //está causando erro - talvez por causa da quebra de linha do texto.
}


//Fechamento da conexão.
$dbSistemaConPDO = null;

//Montagem do URL de retorno.
$URLRetorno = $configUrl . "/" . $visualizacaoAtivaSistema . "/" . $paginaRetorno . "?" .
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