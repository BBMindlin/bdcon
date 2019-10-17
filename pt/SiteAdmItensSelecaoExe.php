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
//LoginAutenticacao::CadastroLoginVerificacao();


//Verificação de qual botão foi acionado (form).
$strOperacao = ""; //'1 - adicionar | -1 - limpar | 0 - cancelar

//if(isset($_POST['submitProdutosComprar']))
if(isset($_POST['submitItensSelecionar_x'])) //Para funcionar no firefox também.
{
	$strOperacao = "1";
}else{
	
}
//if(isset($_POST['submitProdutosCancelar'])) 
if(isset($_POST['submitItensCancelar_x'])) 
{
	$strOperacao = "0";
}else{
	
}

if(isset($_POST['submitItensLimpar_x'])) 
{
	$strOperacao = "-1";
}else{
	
}


//Resgate de variáveis.
$nClassificacao = "0";
$idTbCadastro = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura(CookiesFuncoes::CookieValorLer("")), 2);
$idItem = $_POST["idItem"];
$tipoCategoria = $_POST["tipoCategoria"];
$descricao = $_POST["descricao"];
$valorSelecao = "0";
$ativacao = $_POST["ativacao"];
$strObs = $_POST["strObs"];
//$strQuantidade = $_POST["strQuantidade"];
//$idTbCadastroUsuario = "0";


$masterPageSiteSelect = $_POST["masterPageSiteSelect"];
//$paginaRetorno = $_POST["paginaRetorno"];
$paginaRetorno = "SiteBusca.php";
//$paginaRetornoExclusao = $_POST["paginaRetornoExclusao"];
$variavelRetorno = $_POST["variavelRetorno"];
$idRetorno = $_POST["idRetorno"];
$mensagemErro = "";
$mensagemSucesso = "";

$paginacaoNumero = $_POST["paginacaoNumero"];


//Verificação de erro - debug.
/*
echo "idItem=" . $idItem . "<br>";
echo "strTabela=" . $strTabela . "<br>";
echo "strQuantidade=" . $strQuantidade . "<br>";
echo "strOperacao=" . $strOperacao . "<br>";
echo "submitProdutosComprar_x=" . $_POST["submitProdutosComprar_x"] . "<br>";
echo "submitProdutosComprar_y=" . $_POST["submitProdutosComprar_y"] . "<br>";
echo "strPost=" . var_dump($_POST) . "<br>";

echo "idTbCadastroCliente=" . $idTbCadastroCliente . "<br>";
echo "idTbCadastroUsuario=" . $idTbCadastroUsuario . "<br>";

echo "masterPageSiteSelect=" . $masterPageSiteSelect . "<br>";
echo "paginaRetorno=" . $paginaRetorno . "<br>";
echo "variavelRetorno=" . $variavelRetorno . "<br>";
echo "idRetorno=" . $idRetorno . "<br>";
echo "mensagemErro=" . $mensagemErro . "<br>";
echo "mensagemSucesso=" . $mensagemSucesso . "<br>";
echo "paginacaoNumero=" . $paginacaoNumero . "<br>";
*/


//Adicionar seleção.
//----------
if($strOperacao == "1")
{
	if(DbInsert::ItensSelecionarInsert($idItem, 
	$nClassificacao, 
	$idTbCadastro, 
	$tipoCategoria, 
	$descricao, 
	$valorSelecao, 
	$ativacao, 
	$strObs) == true)
	{
		//Sucesso.
		$mensagemSucesso = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteMensagemSelecaoEnvio");	
	}
}
//----------


//Excluir seleção.
//----------
if($strOperacao == "0")
{
	if(DbExcluir::ExcluirRegistrosGenerico02($idItem, 
	"tb_itens_selecao", 
	"id_tb_item",
	"id_tb_cadastro", 
	$idTbCadastro, 
	"tipo_categoria", 
	$tipoCategoria) == true)
	{
		//Sucesso.
		$mensagemSucesso = "";
	}
}
//----------


//Limpar seleção.
//----------
if($strOperacao == "-1")
{
	if(DbExcluir::ExcluirRegistrosGenerico02($idTbCadastro, 
	"tb_itens_selecao", 
	"id_tb_cadastro",
	"", 
	"", 
	"tipo_categoria", 
	$tipoCategoria) == true)
	{
		//Sucesso.
		$mensagemSucesso = "";
	}
}
//----------


//Fechamento da conexão.
$dbSistemaConPDO = null;


//Montagem do URL de retorno.
//$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
$URLRetorno = $configUrl . "/" . $visualizacaoAtivaSistema . "/" . $paginaRetorno . "?" .
$variavelRetorno . "=" . $idRetorno .
"&tipoPublicacao=" . $tipoPublicacao .
"&tipoArquivo=" . $tipoArquivo .
"&tipoComplemento=" . $tipoComplemento .
"&paginacaoNumero=" . $paginacaoNumero .
"&palavraChave=" . $palavraChave .
"&masterPageSiteSelect=" . $masterPageSiteSelect . 
"&detalhe01=" . $detalhe01 .
"&detalhe02=" . $detalhe02 .
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