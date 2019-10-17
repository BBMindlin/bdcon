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
$idRegistro = $_GET["idRegistro"];
$idParentCategorias = $_GET["idParentCategorias"];

$idParentPublicacoes = $_GET["idParentPublicacoes"];
$tipoPublicacao = $_GET["tipoPublicacao"];

$statusAtivacao = $_GET["statusAtivacao"];
$strCampo = $_GET["strCampo"];
$strTabela = $_GET["strTabela"];

$idTbCadastroUsuario = $_GET["idTbCadastroUsuario"];
$masterPageSiteSelect = $_GET["masterPageSiteSelect"];
//$paginaRetorno = $_GET["paginaRetorno"];
$paginaRetornoExclusao = $_GET["paginaRetornoExclusao"];
$variavelRetorno = $_GET["variavelRetorno"];
$mensagemErro = "";
$mensagemSucesso = "";

$paginacaoNumero = $_GET["paginacaoNumero"];


//Tratamento de array de imagens.
$arrImagemTamanhos = $GLOBALS['arrImagemPadrao'];
$nomeCampoArquivo = "";

//tb_categorias
//----------
if($strTabela == "tb_categorias")
{
	if($GLOBALS['ativacaoImagensPadrao'] == 0)
	{
		$arrImagemTamanhos = $GLOBALS['arrImagemCategoria'];
	}
	$nomeCampoArquivo = "imagem";
}
//----------


//Resgate do nome do arquivo para exclusão do arquivo físico.
$nomeArquivo = DbFuncoes::GetCampoGenerico01($idRegistro, $strTabela, $nomeCampoArquivo);

//Verificação de erro - debug
//echo "idRegistro=" . $idRegistro . "<br />";
//echo "strTabela=" . $strTabela . "<br />";
//echo "strCampo=" . $strCampo . "<br />";
//echo "arrImagemTamanhos=" . $arrImagemTamanhos . "<br />";
//exit();

//Update do registro da exclusão do arquivo.
$resultadoUpdate = DbUpdate::DbRegistroGenericoUpdate01("", $idRegistro, $strTabela, $strCampo);
if ($resultadoUpdate == true) 
{
	//Exclusão dos arquivos físicos.
	Arquivo::ExcluirArquivos($nomeArquivo, $arrImagemTamanhos); //Exclusão de arquivos.
	$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus10");
}else{
	//$mensagemErro .= $resultadoUpdate;
	$mensagemErro .= XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus15");
	//$mensagemSucesso = "";
}


//Fechamento da conexão.
$dbSistemaConPDO = null;


//Montagem do URL de retorno.
//$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
//$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetornoExclusao . "?" .
$URLRetorno = $configUrl . "/" . $visualizacaoAtivaSistema . "/" . $paginaRetornoExclusao . "?" .
$variavelRetorno . "=" . $idRegistro .
"&idParentCategorias=" . $idParentCategorias .
"&idParentPublicacoes=" . $idParentPublicacoes .
"&tipoPublicacao=" . $tipoPublicacao .
"&idTbCadastroUsuario=" . $idTbCadastroUsuario .
"&masterPageSiteSelect=" . $masterPageSiteSelect . 
"&paginacaoNumero=" . $paginacaoNumero .
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