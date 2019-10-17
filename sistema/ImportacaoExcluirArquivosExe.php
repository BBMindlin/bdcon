<?php
//Recurso para permitir o redirecionamento (evitar duplicidade de header).
ob_start();


//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeUsuarioVerificacao.php";
require_once "IncludeLayout.php";


//Verificação de login Master.
LoginAutenticacao::UsuarioLoginVerificacao();


//Variáveis.
//$id = ContadorUniversal::ContadorUniversalUpdate(5);
$paginaRetorno = $_GET["paginaRetorno"];
$detalhe01 = $_GET["detalhe01"];
$detalhe02 = $_GET["detalhe02"];
$mensagemErro = "";
$mensagemSucesso = "";

//Montagem de query padrão de retorno.
$queryPadrao = "&tipoArquivo=" . $tipoArquivo . 
"&paginaRetorno=" . $paginaRetorno . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&variavelRetorno=" . $variavelRetorno . 
"&masterPageSelect=" . $masterPageSelect . 
"&detalhe01=" . $detalhe01 . 
"&detalhe01=" . $detalhe01;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Pesquisar arquivos descompactados.
$arrArquivosDiretorio = Arquivo::ArquivosDiretorioScan_Array01($GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioMaterialEnviado']);

//Loop pelos arquivos encontrados.
foreach($arrArquivosDiretorio as &$vArquivoPDF) 
{
	
	$arquivoPDF = $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioMaterialEnviado'] . "/" . $vArquivoPDF;
	
	//Exclusão do arquivo pdf.
	if(Arquivo::ExcluirArquivos02($vArquivoPDF, $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioMaterialEnviado'], "") == true)
	{
		//Sucesso.
		$mensagemSucesso = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus6");
	}else{
		//Erro.
		$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus23e");
	}
}


//Verificação de erro - debug.
//echo "arquivosDiretorioUpload=" . $arquivosDiretorioUpload . "<br />";
//$dbSistemaConPDO = null;
//exit();
//die();


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
//$dbSistemaConMysqli->close();
$dbSistemaConPDO = null;


//Montagem do URL de retorno.
$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
"idParent=" . $idParent .
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