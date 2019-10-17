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
$loginVerificacao = false;

$paginaRetorno = $_GET["paginaRetorno"];
$mensagemErro = "";
$mensagemSucesso = "";


//Exclusão dos cookies.
//setcookie($GLOBALS['configNomeCookie'] . "_" . $GLOBALS['configSessionNomeUsuarioMaster'], "", time() - 3600, "/");
CookiesFuncoes::CookieExcluir($GLOBALS['configNomeCookie'] . "_" . $GLOBALS['configSessionNomeUsuarioMaster']);
CookiesFuncoes::CookieExcluir($GLOBALS['configNomeCookie'] . "_" . $GLOBALS['configSessionNomeUsuario']);

$mensagemSucesso = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusSucesso2");


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