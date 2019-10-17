<?php
$_GET["masterPageSiteSelect"] = "LayoutSitePainel.php";


//Importação dos arquivos de configuração.
require_once "../sistema/IncludeConfig.php"; //Deve vir antes do db.
require_once "../sistema/IncludeConexao.php";
require_once "../sistema/IncludeFuncoes.php";
//require_once "IncludeLayout.php";
require_once "IncludeLayoutSite.php";


//Verificação de login de cadastro.
LoginAutenticacao::CadastroLoginVerificacao();


//Resgate de variáveis.
$idParentProdutos = $_GET["idParentProdutos"];
$idParentCategoriasRaiz = $_GET["idParentCategoriasRaiz"];
if($idParentCategoriasRaiz == "")
{
	$idParentCategoriasRaiz = 0;
}

$idsTbProdutos = $_GET["idsTbProdutos"];

$idTbCadastroLogado = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura(CookiesFuncoes::CookieValorLer_Login()), 2);
//$idTbCadastroUsuario = $idTbCadastroLogado;

$dataProdutosOnLoad = Funcoes::DataLeitura01(date("Y") . "-" . date("m") . "-" . date("d"), $GLOBALS['configSiteFormatoData'], "1");

$palavraChave = $_GET["palavraChave"];

//Busca detalhada - filtros.
$arrIdsProdutosFiltroGenerico = array();

$idsProdutosTipo = $_GET["idsProdutosTipo"];
$tipoProdutosComplemento = "";

$arrIdsProdutosFiltroGenerico01 = $_GET["idsProdutosFiltroGenerico01"];
$arrIdsProdutosFiltroGenerico02 = $_GET["idsProdutosFiltroGenerico02"];
$arrIdsProdutosFiltroGenerico03 = $_GET["idsProdutosFiltroGenerico03"];
$arrIdsProdutosFiltroGenerico04 = $_GET["idsProdutosFiltroGenerico04"];
$arrIdsProdutosFiltroGenerico05 = $_GET["idsProdutosFiltroGenerico05"];
$arrIdsProdutosFiltroGenerico06 = $_GET["idsProdutosFiltroGenerico06"];
$arrIdsProdutosFiltroGenerico07 = $_GET["idsProdutosFiltroGenerico07"];
$arrIdsProdutosFiltroGenerico08 = $_GET["idsProdutosFiltroGenerico08"];
$arrIdsProdutosFiltroGenerico09 = $_GET["idsProdutosFiltroGenerico09"];
$arrIdsProdutosFiltroGenerico10 = $_GET["idsProdutosFiltroGenerico10"];
$arrIdsProdutosFiltroGenerico11 = $_GET["idsProdutosFiltroGenerico11"];
$arrIdsProdutosFiltroGenerico12 = $_GET["idsProdutosFiltroGenerico12"];
$arrIdsProdutosFiltroGenerico13 = $_GET["idsProdutosFiltroGenerico13"];
$arrIdsProdutosFiltroGenerico14 = $_GET["idsProdutosFiltroGenerico14"];
$arrIdsProdutosFiltroGenerico15 = $_GET["idsProdutosFiltroGenerico15"];
$arrIdsProdutosFiltroGenerico16 = $_GET["idsProdutosFiltroGenerico16"];
$arrIdsProdutosFiltroGenerico17 = $_GET["idsProdutosFiltroGenerico17"];
$arrIdsProdutosFiltroGenerico18 = $_GET["idsProdutosFiltroGenerico18"];
$arrIdsProdutosFiltroGenerico19 = $_GET["idsProdutosFiltroGenerico19"];
$arrIdsProdutosFiltroGenerico20 = $_GET["idsProdutosFiltroGenerico20"];
$arrIdsProdutosFiltroGenerico21 = $_GET["idsProdutosFiltroGenerico21"];
$arrIdsProdutosFiltroGenerico22 = $_GET["idsProdutosFiltroGenerico22"];
$arrIdsProdutosFiltroGenerico23 = $_GET["idsProdutosFiltroGenerico23"];
$arrIdsProdutosFiltroGenerico24 = $_GET["idsProdutosFiltroGenerico24"];
$arrIdsProdutosFiltroGenerico25 = $_GET["idsProdutosFiltroGenerico25"];
$arrIdsProdutosFiltroGenerico26 = $_GET["idsProdutosFiltroGenerico26"];
$arrIdsProdutosFiltroGenerico27 = $_GET["idsProdutosFiltroGenerico27"];
$arrIdsProdutosFiltroGenerico28 = $_GET["idsProdutosFiltroGenerico28"];
$arrIdsProdutosFiltroGenerico29 = $_GET["idsProdutosFiltroGenerico29"];
$arrIdsProdutosFiltroGenerico30 = $_GET["idsProdutosFiltroGenerico30"];

//Combinar arrays.
if(!empty($idsProdutosTipo) && $idsProdutosTipo[0] <> "")
{
	//array_merge($arrIdsProdutosFiltroGenerico, $arrIdsProdutosFiltroGenerico01);
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $idsProdutosTipo;
}

if(!empty($arrIdsProdutosFiltroGenerico01) && $arrIdsProdutosFiltroGenerico01[0] <> "")
{
	//array_merge($arrIdsProdutosFiltroGenerico, $arrIdsProdutosFiltroGenerico01);
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico01;
}
if(!empty($arrIdsProdutosFiltroGenerico02) && $arrIdsProdutosFiltroGenerico02[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico02;
}
if(!empty($arrIdsProdutosFiltroGenerico03) && $arrIdsProdutosFiltroGenerico03[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico03;
}
if(!empty($arrIdsProdutosFiltroGenerico04) && $arrIdsProdutosFiltroGenerico04[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico04;
}
if(!empty($arrIdsProdutosFiltroGenerico05) && $arrIdsProdutosFiltroGenerico05[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico05;
}
if(!empty($arrIdsProdutosFiltroGenerico06) && $arrIdsProdutosFiltroGenerico06[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico06;
}
if(!empty($arrIdsProdutosFiltroGenerico07) && $arrIdsProdutosFiltroGenerico07[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico07;
}
if(!empty($arrIdsProdutosFiltroGenerico08) && $arrIdsProdutosFiltroGenerico08[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico08;
}
if(!empty($arrIdsProdutosFiltroGenerico09) && $arrIdsProdutosFiltroGenerico09[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico09;
}
if(!empty($arrIdsProdutosFiltroGenerico10) && $arrIdsProdutosFiltroGenerico10[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico10;
}
if(!empty($arrIdsProdutosFiltroGenerico11) && $arrIdsProdutosFiltroGenerico11[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico11;
}
if(!empty($arrIdsProdutosFiltroGenerico12) && $arrIdsProdutosFiltroGenerico12[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico12;
}
if(!empty($arrIdsProdutosFiltroGenerico13) && $arrIdsProdutosFiltroGenerico13[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico13;
}
if(!empty($arrIdsProdutosFiltroGenerico14) && $arrIdsProdutosFiltroGenerico14[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico14;
}
if(!empty($arrIdsProdutosFiltroGenerico15) && $arrIdsProdutosFiltroGenerico15[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico15;
}
if(!empty($arrIdsProdutosFiltroGenerico16) && $arrIdsProdutosFiltroGenerico16[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico16;
}
if(!empty($arrIdsProdutosFiltroGenerico17) && $arrIdsProdutosFiltroGenerico17[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico17;
}
if(!empty($arrIdsProdutosFiltroGenerico18) && $arrIdsProdutosFiltroGenerico18[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico18;
}
if(!empty($arrIdsProdutosFiltroGenerico19) && $arrIdsProdutosFiltroGenerico19[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico19;
}
if(!empty($arrIdsProdutosFiltroGenerico20) && $arrIdsProdutosFiltroGenerico20[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico20;
}
if(!empty($arrIdsProdutosFiltroGenerico21) && $arrIdsProdutosFiltroGenerico21[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico21;
}
if(!empty($arrIdsProdutosFiltroGenerico22) && $arrIdsProdutosFiltroGenerico22[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico22;
}
if(!empty($arrIdsProdutosFiltroGenerico23) && $arrIdsProdutosFiltroGenerico23[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico23;
}
if(!empty($arrIdsProdutosFiltroGenerico24) && $arrIdsProdutosFiltroGenerico24[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico24;
}
if(!empty($arrIdsProdutosFiltroGenerico25) && $arrIdsProdutosFiltroGenerico25[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico25;
}
if(!empty($arrIdsProdutosFiltroGenerico26) && $arrIdsProdutosFiltroGenerico26[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico26;
}
if(!empty($arrIdsProdutosFiltroGenerico27) && $arrIdsProdutosFiltroGenerico27[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico27;
}
if(!empty($arrIdsProdutosFiltroGenerico28) && $arrIdsProdutosFiltroGenerico28[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico28;
}
if(!empty($arrIdsProdutosFiltroGenerico29) && $arrIdsProdutosFiltroGenerico29[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico29;
}
if(!empty($arrIdsProdutosFiltroGenerico30) && $arrIdsProdutosFiltroGenerico30[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico30;
}

if(!empty($arrIdsProdutosFiltroGenerico))
{
	/**/
	if($idsTbProdutos <> "")
	{
		//Lógica or.
		/*$idsTbVeiculos .= "," . DbFuncoes::GetIdsByTipoComplemento_FromArray(implode(",",$arrIdsVeiculosFiltroGenerico), 
																			"tb_cadastro_relacao_complemento", 
																			"id_tb_cadastro_complemento", 
																			"id_tb_cadastro");*/
																			
		//Lógica and.
		$idsTbProdutos .= "," . DbFuncoes::GetIdsByTipoComplemento_FromArray02(implode(",",$arrIdsProdutosFiltroGenerico), 
																			"tb_produtos_relacao_complemento", 
																			"id_tb_produtos_complemento", 
																			"id_tb_produtos", 
																			"2");
	}else{
		//Lógica or.
		/*$idsTbVeiculos .= DbFuncoes::GetIdsByTipoComplemento_FromArray(implode(",",$arrIdsVeiculosFiltroGenerico), 
																		"tb_cadastro_relacao_complemento", 
																		"id_tb_cadastro_complemento", 
																		"id_tb_cadastro");*/
																		
		//Lógica and.
		$idsTbProdutos .= DbFuncoes::GetIdsByTipoComplemento_FromArray02(implode(",",$arrIdsProdutosFiltroGenerico), 
																		"tb_produtos_relacao_complemento", 
																		"id_tb_produtos_complemento", 
																		"id_tb_produtos", 
																		"2");
	}
	
	if($idsTbProdutos == "")
	{
		$idsTbProdutos = "0";
	}
}

//Manutenção - acesso.
$configManutencaoLink = 3;//0 - não exibir | 1 - página com todos as opções | 2 - página com opções específicas | 3 - ajax
$configManutencaoLinkFlag = true;

$paginaRetorno = "SiteAdmProdutosIndice.php";
$paginaRetornoExclusao = "SiteAdmProdutosEditar.php";
$variavelRetorno = "idParentProdutos";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];

//Paginação.
if($GLOBALS['habilitarProdutosSistemaPaginacao'] == "1"){
	$paginacaoNRegistros = $GLOBALS['configProdutosSistemaPaginacaoNRegistros'];
	$paginacaoNumero = $_GET["paginacaoNumero"];
	if($paginacaoNumero == "")
	{
		$paginacaoNumero = 1;
	}
	//$paginacaoTotalRegistros = DbFuncoes::CountRegistrosGenericos("tb_produtos", "id_parent", $idParentProdutos); //Quantidade de registros.
	//$paginacaoTotal = ceil($paginacaoTotalRegistros / $paginacaoNRegistros);
	$paginacaoInicio = ($paginacaoNumero-1) * $paginacaoNRegistros;
}

//Montagem de query padrão de retorno.
//"&masterPageSiteSelect=" . $masterPageSiteSelect . 
$queryPadrao = "&idParentProdutos=" . $idParentProdutos . 
"&paginaRetorno=" . $paginaRetorno . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&variavelRetorno=" . $variavelRetorno . 
"&palavraChave=" . $palavraChave;
if(!empty($idsProdutosTipo))
{
	$queryPadrao .= "&idsProdutosTipo[0]=" . $idsProdutosTipo[0];
	$tipoProdutosComplemento = DbFuncoes::GetCampoGenerico01($idsProdutosTipo[0], "tb_produtos_complemento", "complemento");
}
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Query de pesquisa.
//----------
$strSqlProdutosSelect = "";
$strSqlProdutosSelect .= "SELECT ";
//$strSqlProdutosSelect .= "* ";
$strSqlProdutosSelect .= "id, ";
$strSqlProdutosSelect .= "id_tb_categorias, ";
$strSqlProdutosSelect .= "id_tb_cadastro_usuario, ";
$strSqlProdutosSelect .= "data_produto, ";
$strSqlProdutosSelect .= "cod_produto, ";
$strSqlProdutosSelect .= "n_classificacao, ";
$strSqlProdutosSelect .= "produto, ";
$strSqlProdutosSelect .= "descricao01, ";
$strSqlProdutosSelect .= "descricao02, ";
$strSqlProdutosSelect .= "descricao03, ";
$strSqlProdutosSelect .= "descricao04, ";
$strSqlProdutosSelect .= "descricao05, ";
/*
$strSqlProdutosSelect .= "informacao_complementar1, ";
$strSqlProdutosSelect .= "informacao_complementar1, ";
$strSqlProdutosSelect .= "informacao_complementar2, ";
$strSqlProdutosSelect .= "informacao_complementar3, ";
$strSqlProdutosSelect .= "informacao_complementar4, ";
$strSqlProdutosSelect .= "informacao_complementar5, ";
$strSqlProdutosSelect .= "informacao_complementar6, ";
$strSqlProdutosSelect .= "informacao_complementar7, ";
$strSqlProdutosSelect .= "informacao_complementar8, ";
$strSqlProdutosSelect .= "informacao_complementar9, ";
$strSqlProdutosSelect .= "informacao_complementar10, ";
$strSqlProdutosSelect .= "informacao_complementar11, ";
$strSqlProdutosSelect .= "informacao_complementar12, ";
$strSqlProdutosSelect .= "informacao_complementar13, ";
$strSqlProdutosSelect .= "informacao_complementar14, ";
$strSqlProdutosSelect .= "informacao_complementar15, ";
*/
if($GLOBALS['habilitarProdutosIc1'] == 1){
	$strSqlProdutosSelect .= "informacao_complementar1, ";
}
if($GLOBALS['habilitarProdutosIc2'] == 1){
	$strSqlProdutosSelect .= "informacao_complementar2, ";
}
if($GLOBALS['habilitarProdutosIc3'] == 1){
	$strSqlProdutosSelect .= "informacao_complementar3, ";
}
if($GLOBALS['habilitarProdutosIc4'] == 1){
	$strSqlProdutosSelect .= "informacao_complementar4, ";
}
if($GLOBALS['habilitarProdutosIc5'] == 1){
	$strSqlProdutosSelect .= "informacao_complementar5, ";
}
if($GLOBALS['habilitarProdutosIc6'] == 1){
	$strSqlProdutosSelect .= "informacao_complementar6, ";
}
if($GLOBALS['habilitarProdutosIc7'] == 1){
	$strSqlProdutosSelect .= "informacao_complementar7, ";
}
if($GLOBALS['habilitarProdutosIc8'] == 1){
	$strSqlProdutosSelect .= "informacao_complementar8, ";
}
if($GLOBALS['habilitarProdutosIc9'] == 1){
	$strSqlProdutosSelect .= "informacao_complementar9, ";
}
if($GLOBALS['habilitarProdutosIc10'] == 1){
	$strSqlProdutosSelect .= "informacao_complementar10, ";
}
if($GLOBALS['habilitarProdutosIc11'] == 1){
	$strSqlProdutosSelect .= "informacao_complementar11, ";
}
if($GLOBALS['habilitarProdutosIc12'] == 1){
	$strSqlProdutosSelect .= "informacao_complementar12, ";
}
if($GLOBALS['habilitarProdutosIc13'] == 1){
	$strSqlProdutosSelect .= "informacao_complementar13, ";
}
if($GLOBALS['habilitarProdutosIc14'] == 1){
	$strSqlProdutosSelect .= "informacao_complementar14, ";
}
if($GLOBALS['habilitarProdutosIc15'] == 1){
	$strSqlProdutosSelect .= "informacao_complementar15, ";
}
if($GLOBALS['habilitarProdutosIc16'] == 1){
	$strSqlProdutosSelect .= "informacao_complementar16, ";
}
if($GLOBALS['habilitarProdutosIc17'] == 1){
	$strSqlProdutosSelect .= "informacao_complementar17, ";
}
if($GLOBALS['habilitarProdutosIc18'] == 1){
	$strSqlProdutosSelect .= "informacao_complementar18, ";
}
if($GLOBALS['habilitarProdutosIc19'] == 1){
	$strSqlProdutosSelect .= "informacao_complementar19, ";
}
if($GLOBALS['habilitarProdutosIc20'] == 1){
	$strSqlProdutosSelect .= "informacao_complementar20, ";
}
if($GLOBALS['habilitarProdutosIc21'] == 1){
	$strSqlProdutosSelect .= "informacao_complementar21, ";
}
if($GLOBALS['habilitarProdutosIc22'] == 1){
	$strSqlProdutosSelect .= "informacao_complementar22, ";
}
if($GLOBALS['habilitarProdutosIc23'] == 1){
	$strSqlProdutosSelect .= "informacao_complementar23, ";
}
if($GLOBALS['habilitarProdutosIc24'] == 1){
	$strSqlProdutosSelect .= "informacao_complementar24, ";
}
if($GLOBALS['habilitarProdutosIc25'] == 1){
	$strSqlProdutosSelect .= "informacao_complementar25, ";
}
if($GLOBALS['habilitarProdutosIc26'] == 1){
	$strSqlProdutosSelect .= "informacao_complementar26, ";
}
if($GLOBALS['habilitarProdutosIc27'] == 1){
	$strSqlProdutosSelect .= "informacao_complementar27, ";
}
if($GLOBALS['habilitarProdutosIc28'] == 1){
	$strSqlProdutosSelect .= "informacao_complementar28, ";
}
if($GLOBALS['habilitarProdutosIc29'] == 1){
	$strSqlProdutosSelect .= "informacao_complementar29, ";
}
if($GLOBALS['habilitarProdutosIc30'] == 1){
	$strSqlProdutosSelect .= "informacao_complementar30, ";
}
if($GLOBALS['habilitarProdutosIc31'] == 1){
	$strSqlProdutosSelect .= "informacao_complementar31, ";
}
if($GLOBALS['habilitarProdutosIc32'] == 1){
	$strSqlProdutosSelect .= "informacao_complementar32, ";
}
if($GLOBALS['habilitarProdutosIc33'] == 1){
	$strSqlProdutosSelect .= "informacao_complementar33, ";
}
if($GLOBALS['habilitarProdutosIc34'] == 1){
	$strSqlProdutosSelect .= "informacao_complementar34, ";
}
if($GLOBALS['habilitarProdutosIc35'] == 1){
	$strSqlProdutosSelect .= "informacao_complementar35, ";
}
if($GLOBALS['habilitarProdutosIc36'] == 1){
	$strSqlProdutosSelect .= "informacao_complementar36, ";
}
if($GLOBALS['habilitarProdutosIc37'] == 1){
	$strSqlProdutosSelect .= "informacao_complementar37, ";
}
if($GLOBALS['habilitarProdutosIc38'] == 1){
	$strSqlProdutosSelect .= "informacao_complementar38, ";
}
if($GLOBALS['habilitarProdutosIc39'] == 1){
	$strSqlProdutosSelect .= "informacao_complementar39, ";
}
if($GLOBALS['habilitarProdutosIc40'] == 1){
	$strSqlProdutosSelect .= "informacao_complementar40, ";
}
if($GLOBALS['habilitarProdutosIc41'] == 1){
	$strSqlProdutosSelect .= "informacao_complementar41, ";
}
if($GLOBALS['habilitarProdutosIc42'] == 1){
	$strSqlProdutosSelect .= "informacao_complementar42, ";
}
if($GLOBALS['habilitarProdutosIc43'] == 1){
	$strSqlProdutosSelect .= "informacao_complementar43, ";
}
if($GLOBALS['habilitarProdutosIc44'] == 1){
	$strSqlProdutosSelect .= "informacao_complementar44, ";
}
if($GLOBALS['habilitarProdutosIc45'] == 1){
	$strSqlProdutosSelect .= "informacao_complementar45, ";
}
if($GLOBALS['habilitarProdutosIc46'] == 1){
	$strSqlProdutosSelect .= "informacao_complementar46, ";
}
if($GLOBALS['habilitarProdutosIc47'] == 1){
	$strSqlProdutosSelect .= "informacao_complementar47, ";
}
if($GLOBALS['habilitarProdutosIc48'] == 1){
	$strSqlProdutosSelect .= "informacao_complementar48, ";
}
if($GLOBALS['habilitarProdutosIc49'] == 1){
	$strSqlProdutosSelect .= "informacao_complementar49, ";
}
if($GLOBALS['habilitarProdutosIc50'] == 1){
	$strSqlProdutosSelect .= "informacao_complementar50, ";
}
$strSqlProdutosSelect .= "palavras_chave, ";
$strSqlProdutosSelect .= "valor, ";
$strSqlProdutosSelect .= "valor1, ";
$strSqlProdutosSelect .= "valor2, ";
$strSqlProdutosSelect .= "peso, ";
$strSqlProdutosSelect .= "coeficiente, ";
$strSqlProdutosSelect .= "estoque, ";
$strSqlProdutosSelect .= "ativacao, ";
$strSqlProdutosSelect .= "ativacao_promocao, ";
$strSqlProdutosSelect .= "ativacao_home, ";
$strSqlProdutosSelect .= "ativacao_home_categoria, ";
$strSqlProdutosSelect .= "acesso_restrito, ";
$strSqlProdutosSelect .= "n_questoes_aprovacao, ";
$strSqlProdutosSelect .= "id_tb_produtos_status, ";
$strSqlProdutosSelect .= "imagem, ";
$strSqlProdutosSelect .= "anotacoes_internas, ";
$strSqlProdutosSelect .= "n_visitas ";

//Paginação (subquery).
if($GLOBALS['habilitarProdutosSistemaPaginacao'] == "1"){
	$strSqlProdutosSelect .= ", (SELECT COUNT(id) ";
	$strSqlProdutosSelect .= "FROM tb_produtos ";
	$strSqlProdutosSelect .= "WHERE id <> 0 ";
	if($idsTbProdutos <> "")
	{
		$strSqlProdutosSelect .= "AND id IN (" . Funcoes::ConteudoMascaraGravacao01($idsTbProdutos) . ") ";
	}
	if($idParentProdutos <> "")
	{
		$strSqlProdutosSelect .= "AND id_tb_categorias = :id_tb_categorias ";
	}
	if($idTbCadastroUsuario <> "")
	{
		$strSqlProdutosSelect .= "AND id_tb_cadastro_usuario = :id_tb_cadastro_usuario ";
	}
	if($palavraChave <> "")
	{
		$strSqlProdutosSelect .= "AND (produto LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		/*
		*/
		$strSqlProdutosSelect .= "OR descricao01 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlProdutosSelect .= "OR descricao02 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlProdutosSelect .= "OR descricao03 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlProdutosSelect .= "OR descricao04 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlProdutosSelect .= "OR descricao05 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlProdutosSelect .= "OR palavras_chave LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		/*
		$strSqlProdutosSelect .= "OR informacao_complementar1 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlProdutosSelect .= "OR informacao_complementar2 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlProdutosSelect .= "OR informacao_complementar3 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlProdutosSelect .= "OR informacao_complementar4 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlProdutosSelect .= "OR informacao_complementar5 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlProdutosSelect .= "OR informacao_complementar6 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlProdutosSelect .= "OR informacao_complementar7 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlProdutosSelect .= "OR informacao_complementar8 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlProdutosSelect .= "OR informacao_complementar9 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlProdutosSelect .= "OR informacao_complementar10 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlProdutosSelect .= "OR informacao_complementar11 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlProdutosSelect .= "OR informacao_complementar12 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlProdutosSelect .= "OR informacao_complementar13 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlProdutosSelect .= "OR informacao_complementar14 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlProdutosSelect .= "OR informacao_complementar15 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		*/
		if($GLOBALS['habilitarProdutosIc1'] == 1){
			$strSqlProdutosSelect .= "OR informacao_complementar1 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		}
		if($GLOBALS['habilitarProdutosIc2'] == 1){
			$strSqlProdutosSelect .= "OR informacao_complementar2 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		}
		if($GLOBALS['habilitarProdutosIc3'] == 1){
			$strSqlProdutosSelect .= "OR informacao_complementar3 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		}
		if($GLOBALS['habilitarProdutosIc4'] == 1){
			$strSqlProdutosSelect .= "OR informacao_complementar4 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		}
		if($GLOBALS['habilitarProdutosIc5'] == 1){
			$strSqlProdutosSelect .= "OR informacao_complementar5 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		}
		if($GLOBALS['habilitarProdutosIc6'] == 1){
			$strSqlProdutosSelect .= "OR informacao_complementar6 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		}
		if($GLOBALS['habilitarProdutosIc7'] == 1){
			$strSqlProdutosSelect .= "OR informacao_complementar7 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		}
		if($GLOBALS['habilitarProdutosIc8'] == 1){
			$strSqlProdutosSelect .= "OR informacao_complementar8 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		}
		if($GLOBALS['habilitarProdutosIc9'] == 1){
			$strSqlProdutosSelect .= "OR informacao_complementar9 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		}
		if($GLOBALS['habilitarProdutosIc10'] == 1){
			$strSqlProdutosSelect .= "OR informacao_complementar10 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		}
		if($GLOBALS['habilitarProdutosIc11'] == 1){
			$strSqlProdutosSelect .= "OR informacao_complementar11 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		}
		if($GLOBALS['habilitarProdutosIc12'] == 1){
			$strSqlProdutosSelect .= "OR informacao_complementar12 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		}
		if($GLOBALS['habilitarProdutosIc13'] == 1){
			$strSqlProdutosSelect .= "OR informacao_complementar13 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		}
		if($GLOBALS['habilitarProdutosIc14'] == 1){
			$strSqlProdutosSelect .= "OR informacao_complementar14 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		}
		if($GLOBALS['habilitarProdutosIc15'] == 1){
			$strSqlProdutosSelect .= "OR informacao_complementar15 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		}
		if($GLOBALS['habilitarProdutosIc16'] == 1){
			$strSqlProdutosSelect .= "OR informacao_complementar16 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		}
		if($GLOBALS['habilitarProdutosIc17'] == 1){
			$strSqlProdutosSelect .= "OR informacao_complementar17 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		}
		if($GLOBALS['habilitarProdutosIc18'] == 1){
			$strSqlProdutosSelect .= "OR informacao_complementar18 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		}
		if($GLOBALS['habilitarProdutosIc19'] == 1){
			$strSqlProdutosSelect .= "OR informacao_complementar19 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		}
		if($GLOBALS['habilitarProdutosIc20'] == 1){
			$strSqlProdutosSelect .= "OR informacao_complementar20 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		}
		if($GLOBALS['habilitarProdutosIc21'] == 1){
			$strSqlProdutosSelect .= "OR informacao_complementar21 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		}
		if($GLOBALS['habilitarProdutosIc22'] == 1){
			$strSqlProdutosSelect .= "OR informacao_complementar22 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		}
		if($GLOBALS['habilitarProdutosIc23'] == 1){
			$strSqlProdutosSelect .= "OR informacao_complementar23 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		}
		if($GLOBALS['habilitarProdutosIc24'] == 1){
			$strSqlProdutosSelect .= "OR informacao_complementar24 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		}
		if($GLOBALS['habilitarProdutosIc25'] == 1){
			$strSqlProdutosSelect .= "OR informacao_complementar25 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		}
		if($GLOBALS['habilitarProdutosIc26'] == 1){
			$strSqlProdutosSelect .= "OR informacao_complementar26 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		}
		if($GLOBALS['habilitarProdutosIc27'] == 1){
			$strSqlProdutosSelect .= "OR informacao_complementar27 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		}
		if($GLOBALS['habilitarProdutosIc28'] == 1){
			$strSqlProdutosSelect .= "OR informacao_complementar28 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		}
		if($GLOBALS['habilitarProdutosIc29'] == 1){
			$strSqlProdutosSelect .= "OR informacao_complementar29 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		}
		if($GLOBALS['habilitarProdutosIc30'] == 1){
			$strSqlProdutosSelect .= "OR informacao_complementar30 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		}
		if($GLOBALS['habilitarProdutosIc31'] == 1){
			$strSqlProdutosSelect .= "OR informacao_complementar31 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		}
		if($GLOBALS['habilitarProdutosIc32'] == 1){
			$strSqlProdutosSelect .= "OR informacao_complementar32 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		}
		if($GLOBALS['habilitarProdutosIc33'] == 1){
			$strSqlProdutosSelect .= "OR informacao_complementar33 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		}
		if($GLOBALS['habilitarProdutosIc34'] == 1){
			$strSqlProdutosSelect .= "OR informacao_complementar34 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		}
		if($GLOBALS['habilitarProdutosIc35'] == 1){
			$strSqlProdutosSelect .= "OR informacao_complementar35 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		}
		if($GLOBALS['habilitarProdutosIc36'] == 1){
			$strSqlProdutosSelect .= "OR informacao_complementar36 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		}
		if($GLOBALS['habilitarProdutosIc37'] == 1){
			$strSqlProdutosSelect .= "OR informacao_complementar37 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		}
		if($GLOBALS['habilitarProdutosIc38'] == 1){
			$strSqlProdutosSelect .= "OR informacao_complementar38 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		}
		if($GLOBALS['habilitarProdutosIc39'] == 1){
			$strSqlProdutosSelect .= "OR informacao_complementar39 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		}
		if($GLOBALS['habilitarProdutosIc40'] == 1){
			$strSqlProdutosSelect .= "OR informacao_complementar40 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		}
		if($GLOBALS['habilitarProdutosIc41'] == 1){
			$strSqlProdutosSelect .= "OR informacao_complementar41 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		}
		if($GLOBALS['habilitarProdutosIc42'] == 1){
			$strSqlProdutosSelect .= "OR informacao_complementar42 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		}
		if($GLOBALS['habilitarProdutosIc43'] == 1){
			$strSqlProdutosSelect .= "OR informacao_complementar43 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		}
		if($GLOBALS['habilitarProdutosIc44'] == 1){
			$strSqlProdutosSelect .= "OR informacao_complementar44 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		}
		if($GLOBALS['habilitarProdutosIc45'] == 1){
			$strSqlProdutosSelect .= "OR informacao_complementar45 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		}
		if($GLOBALS['habilitarProdutosIc46'] == 1){
			$strSqlProdutosSelect .= "OR informacao_complementar46 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		}
		if($GLOBALS['habilitarProdutosIc47'] == 1){
			$strSqlProdutosSelect .= "OR informacao_complementar47 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		}
		if($GLOBALS['habilitarProdutosIc48'] == 1){
			$strSqlProdutosSelect .= "OR informacao_complementar48 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		}
		if($GLOBALS['habilitarProdutosIc49'] == 1){
			$strSqlProdutosSelect .= "OR informacao_complementar49 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		}
		if($GLOBALS['habilitarProdutosIc50'] == 1){
			$strSqlProdutosSelect .= "OR informacao_complementar50 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		}
		$strSqlProdutosSelect .= ") ";
	}
	$strSqlProdutosSelect .= ") totalRegistros ";
}

$strSqlProdutosSelect .= "FROM tb_produtos ";
$strSqlProdutosSelect .= "WHERE id <> 0 ";
if($idsTbProdutos <> "")
{
	$strSqlProdutosSelect .= "AND id IN (" . Funcoes::ConteudoMascaraGravacao01($idsTbProdutos) . ") ";
}
if($idParentProdutos <> "")
{
	$strSqlProdutosSelect .= "AND id_tb_categorias = :id_tb_categorias ";
}
if($idTbCadastroUsuario <> "")
{
	$strSqlProdutosSelect .= "AND id_tb_cadastro_usuario = :id_tb_cadastro_usuario ";
}
if($palavraChave <> "")
{
	$strSqlProdutosSelect .= "AND (produto LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	/*
	*/
	$strSqlProdutosSelect .= "OR descricao01 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlProdutosSelect .= "OR descricao02 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlProdutosSelect .= "OR descricao03 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlProdutosSelect .= "OR descricao04 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlProdutosSelect .= "OR descricao05 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlProdutosSelect .= "OR palavras_chave LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	/*
	$strSqlProdutosSelect .= "OR informacao_complementar1 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlProdutosSelect .= "OR informacao_complementar2 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlProdutosSelect .= "OR informacao_complementar3 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlProdutosSelect .= "OR informacao_complementar4 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlProdutosSelect .= "OR informacao_complementar5 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlProdutosSelect .= "OR informacao_complementar6 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlProdutosSelect .= "OR informacao_complementar7 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlProdutosSelect .= "OR informacao_complementar8 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlProdutosSelect .= "OR informacao_complementar9 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlProdutosSelect .= "OR informacao_complementar10 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlProdutosSelect .= "OR informacao_complementar11 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlProdutosSelect .= "OR informacao_complementar12 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlProdutosSelect .= "OR informacao_complementar13 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlProdutosSelect .= "OR informacao_complementar14 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlProdutosSelect .= "OR informacao_complementar15 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	*/
	if($GLOBALS['habilitarProdutosIc1'] == 1){
		$strSqlProdutosSelect .= "OR informacao_complementar1 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarProdutosIc2'] == 1){
		$strSqlProdutosSelect .= "OR informacao_complementar2 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarProdutosIc3'] == 1){
		$strSqlProdutosSelect .= "OR informacao_complementar3 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarProdutosIc4'] == 1){
		$strSqlProdutosSelect .= "OR informacao_complementar4 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarProdutosIc5'] == 1){
		$strSqlProdutosSelect .= "OR informacao_complementar5 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarProdutosIc6'] == 1){
		$strSqlProdutosSelect .= "OR informacao_complementar6 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarProdutosIc7'] == 1){
		$strSqlProdutosSelect .= "OR informacao_complementar7 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarProdutosIc8'] == 1){
		$strSqlProdutosSelect .= "OR informacao_complementar8 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarProdutosIc9'] == 1){
		$strSqlProdutosSelect .= "OR informacao_complementar9 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarProdutosIc10'] == 1){
		$strSqlProdutosSelect .= "OR informacao_complementar10 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarProdutosIc11'] == 1){
		$strSqlProdutosSelect .= "OR informacao_complementar11 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarProdutosIc12'] == 1){
		$strSqlProdutosSelect .= "OR informacao_complementar12 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarProdutosIc13'] == 1){
		$strSqlProdutosSelect .= "OR informacao_complementar13 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarProdutosIc14'] == 1){
		$strSqlProdutosSelect .= "OR informacao_complementar14 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarProdutosIc15'] == 1){
		$strSqlProdutosSelect .= "OR informacao_complementar15 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarProdutosIc16'] == 1){
		$strSqlProdutosSelect .= "OR informacao_complementar16 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarProdutosIc17'] == 1){
		$strSqlProdutosSelect .= "OR informacao_complementar17 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarProdutosIc18'] == 1){
		$strSqlProdutosSelect .= "OR informacao_complementar18 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarProdutosIc19'] == 1){
		$strSqlProdutosSelect .= "OR informacao_complementar19 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarProdutosIc20'] == 1){
		$strSqlProdutosSelect .= "OR informacao_complementar20 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarProdutosIc21'] == 1){
		$strSqlProdutosSelect .= "OR informacao_complementar21 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarProdutosIc22'] == 1){
		$strSqlProdutosSelect .= "OR informacao_complementar22 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarProdutosIc23'] == 1){
		$strSqlProdutosSelect .= "OR informacao_complementar23 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarProdutosIc24'] == 1){
		$strSqlProdutosSelect .= "OR informacao_complementar24 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarProdutosIc25'] == 1){
		$strSqlProdutosSelect .= "OR informacao_complementar25 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarProdutosIc26'] == 1){
		$strSqlProdutosSelect .= "OR informacao_complementar26 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarProdutosIc27'] == 1){
		$strSqlProdutosSelect .= "OR informacao_complementar27 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarProdutosIc28'] == 1){
		$strSqlProdutosSelect .= "OR informacao_complementar28 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarProdutosIc29'] == 1){
		$strSqlProdutosSelect .= "OR informacao_complementar29 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarProdutosIc30'] == 1){
		$strSqlProdutosSelect .= "OR informacao_complementar30 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarProdutosIc31'] == 1){
		$strSqlProdutosSelect .= "OR informacao_complementar31 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarProdutosIc32'] == 1){
		$strSqlProdutosSelect .= "OR informacao_complementar32 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarProdutosIc33'] == 1){
		$strSqlProdutosSelect .= "OR informacao_complementar33 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarProdutosIc34'] == 1){
		$strSqlProdutosSelect .= "OR informacao_complementar34 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarProdutosIc35'] == 1){
		$strSqlProdutosSelect .= "OR informacao_complementar35 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarProdutosIc36'] == 1){
		$strSqlProdutosSelect .= "OR informacao_complementar36 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarProdutosIc37'] == 1){
		$strSqlProdutosSelect .= "OR informacao_complementar37 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarProdutosIc38'] == 1){
		$strSqlProdutosSelect .= "OR informacao_complementar38 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarProdutosIc39'] == 1){
		$strSqlProdutosSelect .= "OR informacao_complementar39 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarProdutosIc40'] == 1){
		$strSqlProdutosSelect .= "OR informacao_complementar40 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarProdutosIc41'] == 1){
		$strSqlProdutosSelect .= "OR informacao_complementar41 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarProdutosIc42'] == 1){
		$strSqlProdutosSelect .= "OR informacao_complementar42 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarProdutosIc43'] == 1){
		$strSqlProdutosSelect .= "OR informacao_complementar43 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarProdutosIc44'] == 1){
		$strSqlProdutosSelect .= "OR informacao_complementar44 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarProdutosIc45'] == 1){
		$strSqlProdutosSelect .= "OR informacao_complementar45 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarProdutosIc46'] == 1){
		$strSqlProdutosSelect .= "OR informacao_complementar46 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarProdutosIc47'] == 1){
		$strSqlProdutosSelect .= "OR informacao_complementar47 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarProdutosIc48'] == 1){
		$strSqlProdutosSelect .= "OR informacao_complementar48 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarProdutosIc49'] == 1){
		$strSqlProdutosSelect .= "OR informacao_complementar49 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarProdutosIc50'] == 1){
		$strSqlProdutosSelect .= "OR informacao_complementar50 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	$strSqlProdutosSelect .= ") ";
}

$strSqlProdutosSelect .= "ORDER BY " . $GLOBALS['configClassificacaoProdutos'] . " ";

//Paginação.
if($GLOBALS['habilitarProdutosSistemaPaginacao'] == "1"){ 
	if($configTipoDB == 2)
	{
		$strSqlProdutosSelect .= "LIMIT " . $paginacaoInicio . ", " . $paginacaoNRegistros . "";
	}
}
//----------


//Parâmetros.
//----------
$statementProdutosSelect = $dbSistemaConPDO->prepare($strSqlProdutosSelect);

if ($statementProdutosSelect !== false)
{
	if($idParentProdutos <> "")
	{
		$statementProdutosSelect->bindParam(':id_tb_categorias', $idParentProdutos, PDO::PARAM_STR);
	}
	if($idTbCadastroUsuario <> "")
	{
		$statementProdutosSelect->bindParam(':id_tb_cadastro_usuario', $idTbCadastroUsuario, PDO::PARAM_STR);
	}
	$statementProdutosSelect->execute();
	/*
	$statementProdutosSelect->execute(array(
		"id_tb_categorias" => $idParentProdutos
	));
	*/
}
//----------

//$resultadoProdutos = $dbSistemaConPDO->query($strSqlProdutosSelect);
$resultadoProdutos = $statementProdutosSelect->fetchAll();

//Paginação.
if($GLOBALS['habilitarProdutosSistemaPaginacao'] == "1"){
	//$paginacaoTotalRegistros = DbFuncoes::CountRegistrosGenericos("tb_cadastro", "id_tb_categorias", $idParentCadastro); //Quantidade de registros.
	//$paginacaoTotalRegistros = DbFuncoes::CountRegistrosGenericos("tb_cadastro", "id_tb_categorias", $idParentCadastro, "", "", "", "", "", ""); //Quantidade de registros.
	$paginacaoTotalRegistros = $resultadoProdutos[0]['totalRegistros'];
	$paginacaoTotal = ceil($paginacaoTotalRegistros / $paginacaoNRegistros);
}


//Definição de variáveis.
if($idParentProdutos <> ""){
	$tituloLinkAtual = DbFuncoes::GetCampoGenerico01($idParentProdutos, "tb_categorias", "categoria") . " - " . $tipoProdutosComplemento;
}
if($idTbCadastroUsuario <> ""){
	$tituloLinkAtual = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAdmPainelProdutosAdministrar");
}
if($palavraChave <> ""){
	$tituloLinkAtual = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaResultados");
}
if($tituloLinkAtual == ""){
	$tituloLinkAtual = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaResultados");
}
$metaTitulo = $tituloLinkAtual . " - " . Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloSite'], "IncludeConfig");


//Verificação de erro - debug.
//echo "strSqlProdutosSelect=" . $strSqlProdutosSelect . "<br />";
//echo "idParentVeiculos=" . $idParentVeiculos . "<br />";
//echo "cookie(idTbCadastroUsuario)=" . CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroUsuario") . "<br>";
//echo "cookie(idTbCadastroUsuario2)=" . CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroUsuario2") . "<br>";
//echo "cookie(idTbCadastroUsuario3)=" . CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroUsuario3") . "<br>";
?>
<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo $metaTitulo; ?>
<?php 
$pageSite->cphTitle = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>
<?php //Head.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphHead*/ ?>
    <meta name="description" content="<?php echo $metaDescricao; ?>" /><?php //Abaixo de 160 caracteres.?>
    <meta name="keywords" content="<?php echo $metaPalavrasChave; ?>" /><?php //Abaixo de 100 caracteres.?>
    <meta name="title" content="<?php echo $metaTitulo; ?>" /><?php //Abaixo de 60 caracteres.?>
<?php 
$pageSite->cphHead = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>
<?php //Título atual.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphConteudoCabecalho*/ ?>
	<?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAdmPainelProcessosAdministrar"); ?>
	<?php echo $tituloLinkAtual; ?>
<?php 
$pageSite->cphTituloLinkAtual = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>
<?php //Conteúdo principal.?>
<?php //**************************************************************************************?>
<?php ob_start(); /*cphConteudoPrincipal*/ ?>
    <div align="center" class="AdmErro">
        <?php echo $mensagemErro;?>
    </div>
    <div align="center" class="AdmSucesso">
        <?php echo $mensagemSucesso;?>
    </div>
    <div align="center" class="AdmAlerta">
        <?php echo $mensagemAlerta;?>
    </div>

    
	<?php //Opções gerais.?>
    <?php //----------------------?>
    <?php 
	//Definição de variáveis do include.
	$includeAdmOpcoes_tipoOpcoes = "1";
	$includeAdmOpcoes_configOpcoes = "";
	?>
    
    <?php include "IncludeAdmOpcoes.php";?>
    <?php //----------------------?>
    
    
    
    <?php
	if (empty($resultadoProdutos))
	{
        //echo "Nenhum registro encontrado";
    ?>
        <div align="center" class="TextoErro">
            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatus1"); ?>
        </div>
    <?php
    }else{
    ?>

        <form name="formProdutosAcoes" id="formProdutosAcoes" action="SiteAdmRegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_produtos" />
            <input name="idParentProdutos" id="idParentProdutos" type="hidden" value="<?php echo $idParentProdutos; ?>" />

            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php //echo $paginaRetorno; ?>SiteAdm.php" />
            <input name="masterPageSiteSelect" type="hidden" id="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
            <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            <div style="position: relative; display: block; width: 100%; height: 300px; /**/border: 1px solid #000000; background-color: #ffffff; overflow: auto;/**/">
            <table width="100%" class="AdmTabelaDados01" style="table-layout: auto;">
              <tr class="">
                <td width="20" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmErro">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemExcluir"); ?>
                    </div>
                </td>
                <td width="20" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                    </div>
                </td>

              	<?php if($GLOBALS['habilitarProdutosNClassificacao'] == 1){ ?>
                <td width="50" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNClassificacaoA"); ?>
                    </div>
                </td>
                <?php } ?>
                
              	<?php if($GLOBALS['ativacaoProdutosVisualizacaoImagem'] == 1){ ?>
                <td width="1" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemImagem"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['ativacaoProdutosVisualizacaoData'] == 1){ ?>
                <td width="100" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosData"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <td width="150" class="AdmTabelaDados01Celula">
                    <div class="AdmTexto02">
						<?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProduto"); ?>
                        <!--Identifica&ccedil;&atilde;o-->
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc1'], "IncludeConfig"); ?>
                    </div>
                </td>
                
                <td width="150" class="AdmTabelaDados01Celula">
                    <div class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosCodigo"); ?>
                    </div>
                </td>
                
                <td class="AdmTabelaDados01Celula">
                    <div class="AdmTexto02">
						<?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProduto"); ?>
                        Identifica&ccedil;&atilde;o
                        <?php //echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc1'], "IncludeConfig"); ?>
                    </div>
                </td>
                
                <?php if($GLOBALS['habilitarProdutosTipo'] == "1"){ ?>
                <td width="100" class="AdmTabelaDados01Celula">
                    <div class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosTipo"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <td width="100" class="AdmTabelaDados01Celula" style="display: none;">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFuncoes"); ?>
                    </div>
                </td>
                
                <td width="30" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao"); ?>
                    </div>
                </td>
                
                <?php if($GLOBALS['habilitarProdutosAtivacaoPromocoes'] == 1){ ?>
                <td width="30" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosAtivacaoPromocoes"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarProdutosAtivacaoHome'] == 1){ ?>
                <td width="30" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosAtivacaoHome"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarProdutosAtivacaoCategoria'] == 1){ ?>
                <td width="30" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosAtivacaoHomeCategoria"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarProdutosAtivacaoAcesso'] == 1){ ?>
                <td width="50" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAcesso"); ?>
                    </div>
                </td>
                <?php } ?>
                
              </tr>
              <?php
                $countTabelaFundo = 0;
				
				if($GLOBALS['habilitarProdutosTipo'] == "1")
				{
					$arrProdutosTipo = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 2);
				}

                //Loop pelos resultados.
                foreach($resultadoProdutos as $linhaProdutos)
                {
					if($GLOBALS['habilitarProdutosTipo'] == "1")
					{
						$arrProdutosTipoSelecao = array();
						$arrProdutosTipoSelecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($linhaProdutos['id'], "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", "2", "", ",", "", "1"));
					}
              ?>
              <tr class="">
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
						<?php if(CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroUsuario") <> ""){ ?>
							<?php 
                            if(DbFuncoes::GetCampoGenerico10("tb_historico", 
                                                                "id", 
                                                                array("id_parent; " . $linhaProdutos['id'] . ";i"), 
                                                                "", 
                                                                "", 
                                                                1) == "")
                            {
                            ?>
                            <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaProdutos['id'];?>" class="AdmCampoCheckBox01" />
                            <?php } ?>
						<?php } ?>
                    </div>
                </td>
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <a href="SiteAdmProdutosEditar.php?idTbProdutos=<?php echo $linhaProdutos['id'];?><?php echo $queryPadrao;?>" class="AdmLinks01">
                            <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                            <img src="img/btoEditar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>" />
                        </a>
                    </div>
                </td>
              
              	<?php if($GLOBALS['habilitarProdutosNClassificacao'] == 1){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <?php echo $linhaProdutos['n_classificacao'];?>
                    </div>
                </td>
                <?php } ?>
                
              	<?php if($GLOBALS['ativacaoProdutosVisualizacaoImagem'] == 1){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
						<?php if(!empty($linhaProdutos['imagem'])){ ?>
							<?php //Sem pop-up. ?>
                            <?php if($GLOBALS['configImagemPopUp'] == 0){ ?>
                                <img src="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>/t<?php echo $linhaProdutos['imagem'];?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutos['produto']); ?>" />
                            <?php } ?>
                        
                            <?php //SlimBox 2 - JQuery. ?>
                            <?php if($GLOBALS['configImagemPopUp'] == 1){ ?>
                                <a href="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>/g<?php echo $linhaProdutos['imagem'];?>" rel="lightbox" title="">
                                    <img src="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>/t<?php echo $linhaProdutos['imagem'];?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutos['produto']); ?>" />
                                </a>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['ativacaoProdutosVisualizacaoData'] == 1){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <?php //echo $linhaProdutos['data_produto'];?>
                        <?php echo Funcoes::DataLeitura01($linhaProdutos['data_produto'], $GLOBALS['configSiteFormatoData'], "1");?>
                    </div>
                </td>
                <?php } ?>
                
                <td class="AdmTabelaDados01Celula">
                    <div class="AdmTexto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutos['cod_produto']);?>
                    </div>
                </td>
                
                <td class="AdmTabelaDados01Celula">
                    <div class="AdmTexto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutos['informacao_complementar1']);?>
                    </div>
                </td>
                
                <td class="AdmTabelaDados01Celula">
                    <div class="AdmTexto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutos['produto']);?>
                    </div>
                    <div class="AdmTexto01" style="display: none;">
                    	<?php if($GLOBALS['habilitarProdutosValor'] == 1){ ?>
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosValor"); ?>: 
                            </strong>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>
                            <?php echo Funcoes::MascaraValorLer($linhaProdutos['valor'], $GLOBALS['configSistemaMoeda']);?>
                        <?php } ?>
                        
                    	<?php if($GLOBALS['habilitarProdutosValor1'] == 1){ ?>
                            <strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosValor1Nome'], "IncludeConfig"); ?>: 
                            </strong>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosValor1Moeda'], "IncludeConfig"); ?>
                            <?php echo Funcoes::MascaraValorLer($linhaProdutos['valor1'], $GLOBALS['configSistemaMoeda']);?>
                        <?php } ?>
                        
                    	<?php if($GLOBALS['habilitarProdutosValor2'] == 1){ ?>
                            <strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosValor2Nome'], "IncludeConfig"); ?>: 
                            </strong>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosValor2Moeda'], "IncludeConfig"); ?>
                            <?php echo Funcoes::MascaraValorLer($linhaProdutos['valor2'], $GLOBALS['configSistemaMoeda']);?>
                        <?php } ?>
                        
                    	<?php if($GLOBALS['habilitarProdutosPeso'] == 1){ ?>
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosPeso"); ?>: 
                            </strong>
                            <?php echo $linhaProdutos['peso'];?>
                            <?php echo " " . Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaPeso'], "IncludeConfig"); ?>
                        <?php } ?>
                    </div>
                    <div class="AdmTexto01" style="display: none;">
                    	<?php if($GLOBALS['habilitarProdutosFotos'] == 1){ ?>
                            [
                            <a href="SiteAdmArquivosIndice.php?idParent=<?php echo $linhaProdutos['id'];?>&tipoArquivo=1&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutos['produto']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirFotos"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarProdutosVideos'] == 1){ ?>
                            [
                            <a href="SiteAdmArquivosIndice.php?idParent=<?php echo $linhaProdutos['id'];?>&tipoArquivo=2&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutos['produto']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirVideos"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarProdutosArquivos'] == 1){ ?>
                            [
                            <a href="SiteAdmArquivosIndice.php?idParent=<?php echo $linhaProdutos['id'];?>&tipoArquivo=3&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutos['produto']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirArquivos"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarProdutosZip'] == 1){ ?>
                            [
                            <a href="SiteAdmArquivosIndice.php?idParent=<?php echo $linhaProdutos['id'];?>&tipoArquivo=4&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutos['produto']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirZip"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarProdutosSwfs'] == 1){ ?>
                            [
                            <a href="SiteAdmArquivosIndice.php?idParent=<?php echo $linhaProdutos['id'];?>&tipoArquivo=5&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutos['produto']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirSWFs"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarProdutosConteudo'] == 1){ ?>
                            [
                            <a href="SiteAdmConteudoIndice.php?idParentConteudo=<?php echo $linhaProdutos['id'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutos['produto']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirConteudo"); ?>
                            </a>
                            ] 
                        <?php } ?>
                        
                    	<?php if($GLOBALS['habilitarProdutosHistorico'] == 1){ ?>
                            [
                            <a href="SiteAdmHistoricoIndice.php?idParent=<?php echo $linhaProdutos['id'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutos['produto']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirHistorico"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarProdutosModulos'] == 1){ ?>
                            [
                            <a href="SiteAdmModulosIndice.php?idParentModulos=<?php echo $linhaProdutos['id'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutos['produto']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirModulos"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarProdutosAulas'] == 1){ ?>
                            [
                            <a href="SiteAdmAulasIndice.php?idParentAulas=<?php echo $linhaProdutos['id'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutos['produto']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirAulas"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    </div>
                    
					<?php if($GLOBALS['habilitarProdutosCadastroUsuario'] == 1){ ?>
						<?php if($idTbCadastroUsuario == ""){ ?>
                            <div class="AdmTexto01" style="display: none;">
                                <?php if($linhaProdutos['id_tb_cadastro_usuario'] <> 0){ ?>
                                    <strong>
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosCadastroUsuario"); ?>:  
                                    </strong>
                                    <a href="SiteAdmCadastroAdministrar.php?idTbCadastro=<?php echo $linhaProdutos['id_tb_cadastro_usuario'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
                                        <?php //echo Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaTarefas['id_parent'], "tb_cadastro", "nome"); ?>
                                        <?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaProdutos['id_tb_cadastro_usuario'], "tb_cadastro", "nome"), 
                                        DbFuncoes::GetCampoGenerico01($linhaProdutos['id_tb_cadastro_usuario'], "tb_cadastro", "razao_social"), 
                                        DbFuncoes::GetCampoGenerico01($linhaProdutos['id_tb_cadastro_usuario'], "tb_cadastro", "nome_fantasia"), 
                                        1)); ?>
                                    </a>
                                <?php } ?>
                            </div>
                        <?php } ?>
					<?php } ?>
                </td>
                
                <?php if($GLOBALS['habilitarProdutosTipo'] == "1"){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div class="AdmTexto01">
                        <?php 
						for($countArray = 0; $countArray < count($arrProdutosTipo); $countArray++)
						{
						?>
                        	<?php if(in_array($arrProdutosTipo[$countArray][0], $arrProdutosTipoSelecao)){ ?>
                                <div>
                                    <?php echo $arrProdutosTipo[$countArray][1];?>
                                </div>
                            <?php } ?>
                        <?php 
						}
						?>
                    </div>
                </td>
                <?php } ?>
                
                <td class="AdmTabelaDados01Celula" style="display: none;">
                    <div align="center" class="AdmTexto01">
                    	<a href="../<?php echo $GLOBALS['visualizacaoAtivaSistema'];?>/SiteProdutosDetalhes.php?idTbProdutos=<?php echo $linhaProdutos['id'];?>" target="_blank" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemVisualizacao"); ?>
                        </a>
                    </div>
                    
					<?php if($GLOBALS['habilitarProdutosCadastroVinculosMultiplos'] == 1){ ?>
                    <div align="center" class="AdmTexto01">
                        <a href="ItensRelacaoRegistrosIndice.php?idItem=<?php echo $linhaProdutos['id'];?>&tipoCategoria=13&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutos['produto']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemGerenciarCadastros"); ?>
                        </a>
                    </div>
                    <?php } ?>
                </td>
                
                <td class="<?php if($linhaProdutos['ativacao'] == 1){/*echo "AdmTbFundoClaro";*/}else{echo "AdmTbFundoDesativado";}?> AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                    	<?php if(CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroUsuario") <> ""){ ?>
                    	<a href="SiteAdmRegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaProdutos['id'];?>&statusAtivacao=<?php echo $linhaProdutos['ativacao'];?>&strTabela=tb_produtos&strCampo=ativacao<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="AdmLinks01">
                        	<?php if($linhaProdutos['ativacao'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao0"); ?>
                            <?php } ?>
                        	<?php if($linhaProdutos['ativacao'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao1"); ?>
                            <?php } ?>
                        </a>
                    	<?php }else{ ?>
                        	<?php if($linhaProdutos['ativacao'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao0"); ?>
                            <?php } ?>
                        	<?php if($linhaProdutos['ativacao'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao1"); ?>
                            <?php } ?>
                    	<?php } ?>
						<?php //echo $linhaProdutos['ativacao'];?>
                    </div>
                </td>
                
                <?php if($GLOBALS['habilitarProdutosAtivacaoPromocoes'] == 1){ ?>
                <td class="<?php if($linhaProdutos['ativacao_promocao'] == 1){/*echo "AdmTbFundoClaro";*/}else{echo "AdmTbFundoDesativado";}?> AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                    	<a href="SiteAdmRegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaProdutos['id'];?>&statusAtivacao=<?php echo $linhaProdutos['ativacao_promocao'];?>&strTabela=tb_produtos&strCampo=ativacao_promocao<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="AdmLinks01">
                        	<?php if($linhaProdutos['ativacao_promocao'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao0"); ?>
                            <?php } ?>
                        	<?php if($linhaProdutos['ativacao_promocao'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao1"); ?>
                            <?php } ?>
                        </a>
						<?php //echo $linhaProdutos['ativacao'];?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarProdutosAtivacaoHome'] == 1){ ?>
                <td class="<?php if($linhaProdutos['ativacao_home'] == 1){/*echo "AdmTbFundoClaro";*/}else{echo "AdmTbFundoDesativado";}?> AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                    	<a href="SiteAdmRegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaProdutos['id'];?>&statusAtivacao=<?php echo $linhaProdutos['ativacao_home'];?>&strTabela=tb_produtos&strCampo=ativacao_home<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="AdmLinks01">
                        	<?php if($linhaProdutos['ativacao_home'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao0"); ?>
                            <?php } ?>
                        	<?php if($linhaProdutos['ativacao_home'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao1"); ?>
                            <?php } ?>
                        </a>
						<?php //echo $linhaProdutos['ativacao'];?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarProdutosAtivacaoCategoria'] == 1){ ?>
                <td class="<?php if($linhaProdutos['ativacao_home_categoria'] == 1){/*echo "AdmTbFundoClaro";*/}else{echo "AdmTbFundoDesativado";}?> AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                    	<a href="SiteAdmRegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaProdutos['id'];?>&statusAtivacao=<?php echo $linhaProdutos['ativacao_home_categoria'];?>&strTabela=tb_produtos&strCampo=ativacao_home_categoria<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="AdmLinks01">
                        	<?php if($linhaProdutos['ativacao_home_categoria'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao0"); ?>
                            <?php } ?>
                        	<?php if($linhaProdutos['ativacao_home_categoria'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao1"); ?>
                            <?php } ?>
                        </a>
						<?php //echo $linhaProdutos['ativacao'];?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarProdutosAtivacaoAcesso'] == 1){ ?>
                <td class="<?php if($linhaProdutos['acesso_restrito'] == 0){/*echo "AdmTbFundoClaro";*/}else{echo "AdmTbFundoDesativado";}?> AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                    	<a href="SiteAdmRegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaProdutos['id'];?>&statusAtivacao=<?php echo $linhaProdutos['acesso_restrito'];?>&strTabela=tb_produtos&strCampo=acesso_restrito<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="AdmLinks01">
                        	<?php if($linhaProdutos['acesso_restrito'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAcesso0"); ?>
                            <?php } ?>

                        	<?php if($linhaProdutos['acesso_restrito'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAcesso1"); ?>
                            <?php } ?>
                        </a>
                        <?php //echo $linhaProdutos['acesso_restrito'];?>
                    </div>
                </td>
                <?php } ?>

              </tr>
              <?php } ?>
            </table>
            </div>
            <div align="right" style="float: right; display: none;">
            
                <input type="image" name="submit" value="Submit" src="img/btoExcluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoExcluir"); ?>" />
            </div>
        </form>
	<?php } ?>
    
    
    
    <?php if(!empty($idParentProdutos)){ ?>
	<script type="text/javascript">
		$(document).ready(function () {
			
			/*
			$.validator.addMethod(
					"alphabetsOnly",
					function(value, element, regexp) {
						var re = new RegExp(regexp);
						return this.optional(element) || re.test(value);
					},
					"Please check your input values again!!!."
			);
			*/
			//Parâmetro personalizado.
			//**************************************************************************************
			jQuery.validator.addMethod("accept", function(value, element, param) {
				//return value.match(new RegExp("^" + param + "$"));
				return value.match(new RegExp(param));
			});	
			//**************************************************************************************

				
			//Validação de formulário (JQuery).
			//**************************************************************************************
			$('#formProdutos').validate({ //Inicialização do plug-in.
			
			
				//Estilo da mensagem de erro.
				//----------------------
				errorClass: "TextoErro",
				//----------------------
				
				
				//Validação
				//----------------------
				rules: {
					n_classificacao: {
						required: true,
						//regex: /-?\d+(\.\d{1,3})?/
						number: true
					},
					valor: {
						required: true,
						//regex: /-?\d+(\.\d{1,3})?/
						//regex: /-?[0-9]+(?:\.?[0-9]*)?,?[0-9]+(?:\.?[0-9]*)?/
						//pattern: /-?[0-9]+(?:\.?[0-9]*)?,?[0-9]+(?:\.?[0-9]*)?/
						//pattern: /^(\d+|\d+,\d{1,2})$/
						//pattern: /[0-9]+([\.|,][0-9]+)?/
						accept: "-?[0-9]+(?:\.?[0-9]*)?,?[0-9]+(?:\.?[0-9]*)?"
						//number: true
					},
					valor1: {
						required: true,
						//regex: /-?\d+(\.\d{1,3})?/
						//regex: /-?[0-9]+(?:\.?[0-9]*)?,?[0-9]+(?:\.?[0-9]*)?/
						//pattern: /-?[0-9]+(?:\.?[0-9]*)?,?[0-9]+(?:\.?[0-9]*)?/
						//pattern: /^(\d+|\d+,\d{1,2})$/
						//pattern: /[0-9]+([\.|,][0-9]+)?/
						accept: "-?[0-9]+(?:\.?[0-9]*)?,?[0-9]+(?:\.?[0-9]*)?"
						//number: true
					},
					valor2: {
						required: true,
						//regex: /-?\d+(\.\d{1,3})?/
						//regex: /-?[0-9]+(?:\.?[0-9]*)?,?[0-9]+(?:\.?[0-9]*)?/
						//pattern: /-?[0-9]+(?:\.?[0-9]*)?,?[0-9]+(?:\.?[0-9]*)?/
						//pattern: /^(\d+|\d+,\d{1,2})$/
						//pattern: /[0-9]+([\.|,][0-9]+)?/
						accept: "-?[0-9]+(?:\.?[0-9]*)?,?[0-9]+(?:\.?[0-9]*)?"
						//number: true
					}//,
				},
				
				
				//Mensagens.
				//----------------------
				messages: {
					//n_classificacao: "Please specify your name"//,
					n_classificacao: {
					  //required: "Campo obrigatório.",
					  required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>",
					  //regex: "Campo numérico."
					  //number: "Campo numérico."
					  number: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica1"); ?>"
					},
					valor: {
					  //required: "Campo obrigatório.",
					  required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>",
					  //pattern: "echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica3");"
					  accept: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica3"); ?>"
					  //number: "Campo numérico."
					},
					valor1: {
					  //required: "Campo obrigatório.",
					  required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>",
					  //pattern: "echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica3");"
					  accept: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica3"); ?>"
					  //number: "Campo numérico."
					},
					valor2: {
					  //required: "Campo obrigatório.",
					  required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>",
					  //pattern: "echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica3");"
					  accept: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica3"); ?>"
					  //number: "Campo numérico."
					}//,
				},		
				//----------------------
				
				
				/*
				errorPlacement: function(error, element) {
					if(element.attr("name") == "n_classificacao")
					{
						error.insertAfter(".nomedadiv");
					}
					else if  (element.attr("name") == "phone" )
						error.insertAfter(".some-other-class");
					else
						error.insertAfter(element);
				}
				*/
			});
			//**************************************************************************************

		});	
	</script>
	<script type="text/javascript">
        //Variável para conter todos os campos que funcionam com o DatePicker.
        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
        var strDatapickerAgendaPtCampos = "";
        var strDatapickerAgendaEnCampos = "";
    </script>
    <form name="formProdutos" id="formProdutos" action="SiteAdmProdutosIndiceExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <table class="AdmTabelaCampos01" style="display: none;">
            <tr>
                <td class="AdmTbFundoEscuro" colspan="4">
                    <div align="center" class="AdmTexto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosTbProdutos"); ?>
                        </strong>
                    </div>
                </td>
            </tr>
            
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosData"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro">
                    <div align="left">
                    	<?php //JQuery DatePicker. ?>
                    	<?php //---------------------- ?>
						<?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                        	<?php if($GLOBALS['configSiteFormatoData'] == 1){ ?>
								<script type="text/javascript">
                                    //Variável para conter todos os campos que funcionam com o DatePicker.
                                    //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                    //var strDatapickerAgendaPtCampos = "#data_abertura";
                                    strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data_produto;";
                                </script>
                            <?php } ?>
                            <?php if($GLOBALS['configSiteFormatoData'] == 2){ ?>
								<script type="text/javascript">
                                    //Variável para conter todos os campos que funcionam com o DatePicker.
                                    //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                    //var strDatapickerAgendaEnCampos = "#data_abertura";
                                    strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data_produto;";
                                </script>
                            <?php } ?>
                            <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                        
                            <input type="text" name="data_produto" id="data_produto" class="AdmCampoData01" maxlength="10" value="<?php echo $dataProdutosOnLoad; ?>" />
                            <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                        <?php } ?>
                    	<?php //---------------------- ?>
                    </div>
                </td>
                
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosCodigo"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaColuna01">
                    <div align="left">
                        <input type="text" name="cod_produto" id="cod_produto" class="AdmCampoTexto02" maxlength="255" />
                    </div>
                </td>
            </tr>
            
            <?php if($GLOBALS['habilitarProdutosCadastroUsuario'] == 1){ ?>
				<?php if($idTbCadastroUsuario == ""){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosCadastroUsuario"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrProdutosUsuario = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbCadastroProdutosUsuario'], $GLOBALS['configIdTbTipoCadastroProdutosUsuario'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoCadastroProdutosUsuario'], $GLOBALS['configProdutosCadastroUsuarioMetodo']);
                            ?>
                            <select name="id_tb_cadastro_usuario" id="id_tb_cadastro_usuario" class="AdmCampoDropDownMenu01">
                                <option value="0" selected="selected"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosUsuario); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosUsuario[$countArray][0];?>"><?php echo $arrProdutosUsuario[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        </div>
                    </td>
                </tr>
                <?php }else{ ?>
                    <input type="hidden" id="id_tb_cadastro_usuario" name="id_tb_cadastro_usuario" value="<?php echo $idTbCadastroUsuario?>" />
                <?php } ?>
            <?php } ?>
            
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProduto"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula"<?php if($GLOBALS['habilitarProdutosNClassificacao'] <> "1"){ ?> colspan="3"<?php } ?>>
                    <div align="left">
                        <input type="text" name="produto" id="produto" class="AdmCampoTexto02" maxlength="255" />
                    </div>
                </td>
				<?php if($GLOBALS['habilitarProdutosNClassificacao'] == 1){ ?>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNClassificacao"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaColuna01 TabelaCampos01Celula">
                    <div>
                        <input type="text" name="n_classificacao" id="n_classificacao" class="AdmCampoNumerico01" maxlength="10" value="0" />
                    </div>
                </td>
                <?php } ?>
            </tr>
            
            <?php if($GLOBALS['habilitarProdutosTipo'] == "1"){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosTipo"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    	<?php 
							$arrProdutosTipo = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 2);
						?>
                        
                        <?php 
						for($countArray = 0; $countArray < count($arrProdutosTipo); $countArray++)
						{
						?>
                        	<div>
                                <input name="idsProdutosTipo[]" type="checkbox" <?php if(in_array($arrProdutosTipo[$countArray][0], $arrIdsProdutosFiltroGenerico)){ ?> checked="checked"<?php } ?>value="<?php echo $arrProdutosTipo[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrProdutosTipo[$countArray][1];?>
                            </div>
                        <?php 
						}
						?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico01'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico01Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
						$arrProdutosFiltroGenerico01 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 12);
                        ?>
                        
                        <?php if($GLOBALS['configProdutosFiltroGenerico01CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico01); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsProdutosFiltroGenerico01[]" type="checkbox" value="<?php echo $arrProdutosFiltroGenerico01[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrProdutosFiltroGenerico01[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico01CaixaSelecao'] == 2){ ?>
                            <select id="idsProdutosFiltroGenerico01" name="idsProdutosFiltroGenerico01[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico01); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico01[$countArray][0];?>"><?php echo $arrProdutosFiltroGenerico01[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico01CaixaSelecao'] == 3){ ?>
                            <select id="idsProdutosFiltroGenerico01" name="idsProdutosFiltroGenerico01[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico01); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico01[$countArray][0];?>"><?php echo $arrProdutosFiltroGenerico01[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
						<?php 
                        $flagManutencaoLink = $configManutencaoLinkFlag;
                        if($configManutencaoLinkFlag != true)
                        {
                            if(empty($arrProdutosFiltroGenerico01))
                            { 
                                $flagManutencaoLink = true;
                            }else{
                                $flagManutencaoLink = false;
                            }
                        }
						
						//Debug.
						//echo "configManutencaoLinkFlag=" . $configManutencaoLinkFlag . "<br/>";
						//echo "flagManutencaoLink=" . $flagManutencaoLink . "<br/>";
                        ?>
                        <?php if($flagManutencaoLink == true){ ?>
                            <?php if($configManutencaoLink == 1){ ?>
                                <a href="SiteAdmProdutosManutencao.php" class="AdmLinks01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 2){ ?>
                                <a href="SiteAdmProdutosManutencao.php?tipoComplemento=12&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 3){ ?>
                                <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmProdutosManutencao.php?tipoComplemento=12&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                            divShow('divManutencaoAjax');
                                            HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_produtos_complemento&tipoComplemento=12&tipoRetorno=3\', \'idsProdutosFiltroGenerico01\', \'<?php echo $GLOBALS['configProdutosFiltroGenerico01CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>                                
                        <?php } ?>                                
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico02'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico02Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
						$arrProdutosFiltroGenerico02 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 13);
                        ?>
                        
                        <?php if($GLOBALS['configProdutosFiltroGenerico02CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico02); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsProdutosFiltroGenerico02[]" type="checkbox" value="<?php echo $arrProdutosFiltroGenerico02[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrProdutosFiltroGenerico02[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico02CaixaSelecao'] == 2){ ?>
                            <select id="idsProdutosFiltroGenerico02" name="idsProdutosFiltroGenerico02[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico02); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico02[$countArray][0];?>"><?php echo $arrProdutosFiltroGenerico02[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico02CaixaSelecao'] == 3){ ?>
                            <select id="idsProdutosFiltroGenerico02" name="idsProdutosFiltroGenerico02[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico02); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico02[$countArray][0];?>"><?php echo $arrProdutosFiltroGenerico02[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
						<?php 
                        $flagManutencaoLink = $configManutencaoLinkFlag;
                        if($configManutencaoLinkFlag != true)
                        {
                            if(empty($arrProdutosFiltroGenerico02))
                            { 
                                $flagManutencaoLink = true;
                            }else{
                                $flagManutencaoLink = false;
                            }
                        }
                        ?>
                        <?php if($flagManutencaoLink == true){ ?>
                            <?php if($configManutencaoLink == 1){ ?>
                                <a href="SiteAdmProdutosManutencao.php" class="AdmLinks01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 2){ ?>
                                <a href="SiteAdmProdutosManutencao.php?tipoComplemento=13&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 3){ ?>
                                <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmProdutosManutencao.php?tipoComplemento=13&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                            divShow('divManutencaoAjax');
                                            HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_produtos_complemento&tipoComplemento=13&tipoRetorno=3\', \'idsProdutosFiltroGenerico02\', \'<?php echo $GLOBALS['configProdutosFiltroGenerico02CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>                                
                        <?php } ?>                                
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico03'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico03Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
						$arrProdutosFiltroGenerico03 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 14);
                        ?>
                        
                        <?php if($GLOBALS['configProdutosFiltroGenerico03CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico03); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsProdutosFiltroGenerico03[]" type="checkbox" value="<?php echo $arrProdutosFiltroGenerico03[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrProdutosFiltroGenerico03[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico03CaixaSelecao'] == 2){ ?>
                            <select id="idsProdutosFiltroGenerico03" name="idsProdutosFiltroGenerico03[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico03); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico03[$countArray][0];?>"><?php echo $arrProdutosFiltroGenerico03[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico03CaixaSelecao'] == 3){ ?>
                            <select id="idsProdutosFiltroGenerico03" name="idsProdutosFiltroGenerico03[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico03); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico03[$countArray][0];?>"><?php echo $arrProdutosFiltroGenerico03[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
						<?php 
                        $flagManutencaoLink = $configManutencaoLinkFlag;
                        if($configManutencaoLinkFlag != true)
                        {
                            if(empty($arrProdutosFiltroGenerico03))
                            { 
                                $flagManutencaoLink = true;
                            }else{
                                $flagManutencaoLink = false;
                            }
                        }
                        ?>
                        <?php if($flagManutencaoLink == true){ ?>
                            <?php if($configManutencaoLink == 1){ ?>
                                <a href="SiteAdmProdutosManutencao.php" class="AdmLinks01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 2){ ?>
                                <a href="SiteAdmProdutosManutencao.php?tipoComplemento=14&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 3){ ?>
                                <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmProdutosManutencao.php?tipoComplemento=14&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                            divShow('divManutencaoAjax');
                                            HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_produtos_complemento&tipoComplemento=14&tipoRetorno=3\', \'idsProdutosFiltroGenerico03\', \'<?php echo $GLOBALS['configProdutosFiltroGenerico03CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>                                
                        <?php } ?>                                
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico04'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico04Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
						$arrProdutosFiltroGenerico04 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 15);
                        ?>
                        
                        <?php if($GLOBALS['configProdutosFiltroGenerico04CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico04); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsProdutosFiltroGenerico04[]" type="checkbox" value="<?php echo $arrProdutosFiltroGenerico04[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrProdutosFiltroGenerico04[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico04CaixaSelecao'] == 2){ ?>
                            <select id="idsProdutosFiltroGenerico04" name="idsProdutosFiltroGenerico04[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico04); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico04[$countArray][0];?>"><?php echo $arrProdutosFiltroGenerico04[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico04CaixaSelecao'] == 3){ ?>
                            <select id="idsProdutosFiltroGenerico04" name="idsProdutosFiltroGenerico04[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico04); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico04[$countArray][0];?>"><?php echo $arrProdutosFiltroGenerico04[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
						<?php 
                        $flagManutencaoLink = $configManutencaoLinkFlag;
                        if($configManutencaoLinkFlag != true)
                        {
                            if(empty($arrProdutosFiltroGenerico04))
                            { 
                                $flagManutencaoLink = true;
                            }else{
                                $flagManutencaoLink = false;
                            }
                        }
                        ?>
                        <?php if($flagManutencaoLink == true){ ?>
                            <?php if($configManutencaoLink == 1){ ?>
                                <a href="SiteAdmProdutosManutencao.php" class="AdmLinks01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 2){ ?>
                                <a href="SiteAdmProdutosManutencao.php?tipoComplemento=15&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 3){ ?>
                                <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmProdutosManutencao.php?tipoComplemento=15&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                            divShow('divManutencaoAjax');
                                            HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_produtos_complemento&tipoComplemento=15&tipoRetorno=3\', \'idsProdutosFiltroGenerico04\', \'<?php echo $GLOBALS['configProdutosFiltroGenerico04CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>                                
                        <?php } ?>                                
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico05'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico05Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
						$arrProdutosFiltroGenerico05 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 16);
                        ?>
                        
                        <?php if($GLOBALS['configProdutosFiltroGenerico05CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico05); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsProdutosFiltroGenerico05[]" type="checkbox" value="<?php echo $arrProdutosFiltroGenerico05[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrProdutosFiltroGenerico05[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico05CaixaSelecao'] == 2){ ?>
                            <select id="idsProdutosFiltroGenerico05" name="idsProdutosFiltroGenerico05[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico05); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico05[$countArray][0];?>"><?php echo $arrProdutosFiltroGenerico05[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico05CaixaSelecao'] == 3){ ?>
                            <select id="idsProdutosFiltroGenerico05" name="idsProdutosFiltroGenerico05[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico05); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico05[$countArray][0];?>"><?php echo $arrProdutosFiltroGenerico05[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
						<?php 
                        $flagManutencaoLink = $configManutencaoLinkFlag;
                        if($configManutencaoLinkFlag != true)
                        {
                            if(empty($arrProdutosFiltroGenerico05))
                            { 
                                $flagManutencaoLink = true;
                            }else{
                                $flagManutencaoLink = false;
                            }
                        }
                        ?>
                        <?php if($flagManutencaoLink == true){ ?>
                            <?php if($configManutencaoLink == 1){ ?>
                                <a href="SiteAdmProdutosManutencao.php" class="AdmLinks01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 2){ ?>
                                <a href="SiteAdmProdutosManutencao.php?tipoComplemento=16&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 3){ ?>
                                <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmProdutosManutencao.php?tipoComplemento=16&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                            divShow('divManutencaoAjax');
                                            HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_produtos_complemento&tipoComplemento=16&tipoRetorno=3\', \'idsProdutosFiltroGenerico05\', \'<?php echo $GLOBALS['configProdutosFiltroGenerico05CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>                                
                        <?php } ?>                                
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico06'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico06Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
						$arrProdutosFiltroGenerico06 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 17);
                        ?>
                        
                        <?php if($GLOBALS['configProdutosFiltroGenerico06CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico06); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsProdutosFiltroGenerico06[]" type="checkbox" value="<?php echo $arrProdutosFiltroGenerico06[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrProdutosFiltroGenerico06[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico06CaixaSelecao'] == 2){ ?>
                            <select id="idsProdutosFiltroGenerico06" name="idsProdutosFiltroGenerico06[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico06); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico06[$countArray][0];?>"><?php echo $arrProdutosFiltroGenerico06[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico06CaixaSelecao'] == 3){ ?>
                            <select id="idsProdutosFiltroGenerico06" name="idsProdutosFiltroGenerico06[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico06); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico06[$countArray][0];?>"><?php echo $arrProdutosFiltroGenerico06[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
						<?php 
                        $flagManutencaoLink = $configManutencaoLinkFlag;
                        if($configManutencaoLinkFlag != true)
                        {
                            if(empty($arrProdutosFiltroGenerico06))
                            { 
                                $flagManutencaoLink = true;
                            }else{
                                $flagManutencaoLink = false;
                            }
                        }
                        ?>
                        <?php if($flagManutencaoLink == true){ ?>
                            <?php if($configManutencaoLink == 1){ ?>
                                <a href="SiteAdmProdutosManutencao.php" class="AdmLinks01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 2){ ?>
                                <a href="SiteAdmProdutosManutencao.php?tipoComplemento=17&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 3){ ?>
                                <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmProdutosManutencao.php?tipoComplemento=17&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                            divShow('divManutencaoAjax');
                                            HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_produtos_complemento&tipoComplemento=17&tipoRetorno=3\', \'idsProdutosFiltroGenerico06\', \'<?php echo $GLOBALS['configProdutosFiltroGenerico06CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>                                
                        <?php } ?>                                
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico07'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico07Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
						$arrProdutosFiltroGenerico07 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 18);
                        ?>
                        
                        <?php if($GLOBALS['configProdutosFiltroGenerico07CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico07); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsProdutosFiltroGenerico07[]" type="checkbox" value="<?php echo $arrProdutosFiltroGenerico07[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrProdutosFiltroGenerico07[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico07CaixaSelecao'] == 2){ ?>
                            <select id="idsProdutosFiltroGenerico07" name="idsProdutosFiltroGenerico07[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico07); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico07[$countArray][0];?>"><?php echo $arrProdutosFiltroGenerico07[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico07CaixaSelecao'] == 3){ ?>
                            <select id="idsProdutosFiltroGenerico07" name="idsProdutosFiltroGenerico07[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico07); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico07[$countArray][0];?>"><?php echo $arrProdutosFiltroGenerico07[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
						<?php 
                        $flagManutencaoLink = $configManutencaoLinkFlag;
                        if($configManutencaoLinkFlag != true)
                        {
                            if(empty($arrProdutosFiltroGenerico07))
                            { 
                                $flagManutencaoLink = true;
                            }else{
                                $flagManutencaoLink = false;
                            }
                        }
                        ?>
                        <?php if($flagManutencaoLink == true){ ?>
                            <?php if($configManutencaoLink == 1){ ?>
                                <a href="SiteAdmProdutosManutencao.php" class="AdmLinks01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 2){ ?>
                                <a href="SiteAdmProdutosManutencao.php?tipoComplemento=18&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 3){ ?>
                                <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmProdutosManutencao.php?tipoComplemento=18&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                            divShow('divManutencaoAjax');
                                            HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_produtos_complemento&tipoComplemento=18&tipoRetorno=3\', \'idsProdutosFiltroGenerico07\', \'<?php echo $GLOBALS['configProdutosFiltroGenerico07CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>                                
                        <?php } ?>                                
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico08'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico08Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
						$arrProdutosFiltroGenerico08 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 19);
                        ?>
                        
                        <?php if($GLOBALS['configProdutosFiltroGenerico08CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico08); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsProdutosFiltroGenerico08[]" type="checkbox" value="<?php echo $arrProdutosFiltroGenerico08[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrProdutosFiltroGenerico08[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico08CaixaSelecao'] == 2){ ?>
                            <select id="idsProdutosFiltroGenerico08" name="idsProdutosFiltroGenerico08[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico08); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico08[$countArray][0];?>"><?php echo $arrProdutosFiltroGenerico08[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico08CaixaSelecao'] == 3){ ?>
                            <select id="idsProdutosFiltroGenerico08" name="idsProdutosFiltroGenerico08[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico08); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico08[$countArray][0];?>"><?php echo $arrProdutosFiltroGenerico08[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
						<?php 
                        $flagManutencaoLink = $configManutencaoLinkFlag;
                        if($configManutencaoLinkFlag != true)
                        {
                            if(empty($arrProdutosFiltroGenerico08))
                            { 
                                $flagManutencaoLink = true;
                            }else{
                                $flagManutencaoLink = false;
                            }
                        }
                        ?>
                        <?php if($flagManutencaoLink == true){ ?>
                            <?php if($configManutencaoLink == 1){ ?>
                                <a href="SiteAdmProdutosManutencao.php" class="AdmLinks01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 2){ ?>
                                <a href="SiteAdmProdutosManutencao.php?tipoComplemento=19&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 3){ ?>
                                <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmProdutosManutencao.php?tipoComplemento=19&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                            divShow('divManutencaoAjax');
                                            HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_produtos_complemento&tipoComplemento=19&tipoRetorno=3\', \'idsProdutosFiltroGenerico08\', \'<?php echo $GLOBALS['configProdutosFiltroGenerico08CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>                                
                        <?php } ?>                                
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico09'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico09Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
						$arrProdutosFiltroGenerico09 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 20);
                        ?>
                        
                        <?php if($GLOBALS['configProdutosFiltroGenerico09CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico09); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsProdutosFiltroGenerico09[]" type="checkbox" value="<?php echo $arrProdutosFiltroGenerico09[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrProdutosFiltroGenerico09[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico09CaixaSelecao'] == 2){ ?>
                            <select id="idsProdutosFiltroGenerico09" name="idsProdutosFiltroGenerico09[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico09); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico09[$countArray][0];?>"><?php echo $arrProdutosFiltroGenerico09[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico09CaixaSelecao'] == 3){ ?>
                            <select id="idsProdutosFiltroGenerico09" name="idsProdutosFiltroGenerico09[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico09); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico09[$countArray][0];?>"><?php echo $arrProdutosFiltroGenerico09[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
						<?php 
                        $flagManutencaoLink = $configManutencaoLinkFlag;
                        if($configManutencaoLinkFlag != true)
                        {
                            if(empty($arrProdutosFiltroGenerico09))
                            { 
                                $flagManutencaoLink = true;
                            }else{
                                $flagManutencaoLink = false;
                            }
                        }
                        ?>
                        <?php if($flagManutencaoLink == true){ ?>
                            <?php if($configManutencaoLink == 1){ ?>
                                <a href="SiteAdmProdutosManutencao.php" class="AdmLinks01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 2){ ?>
                                <a href="SiteAdmProdutosManutencao.php?tipoComplemento=20&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 3){ ?>
                                <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmProdutosManutencao.php?tipoComplemento=20&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                            divShow('divManutencaoAjax');
                                            HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_produtos_complemento&tipoComplemento=20&tipoRetorno=3\', \'idsProdutosFiltroGenerico09\', \'<?php echo $GLOBALS['configProdutosFiltroGenerico09CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>                                
                        <?php } ?>                                
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico10'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico10Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
						$arrProdutosFiltroGenerico10 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 21);
                        ?>
                        
                        <?php if($GLOBALS['configProdutosFiltroGenerico10CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico10); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsProdutosFiltroGenerico10[]" type="checkbox" value="<?php echo $arrProdutosFiltroGenerico10[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrProdutosFiltroGenerico10[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico10CaixaSelecao'] == 2){ ?>
                            <select id="idsProdutosFiltroGenerico10" name="idsProdutosFiltroGenerico10[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico10); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico10[$countArray][0];?>"><?php echo $arrProdutosFiltroGenerico10[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico10CaixaSelecao'] == 3){ ?>
                            <select id="idsProdutosFiltroGenerico10" name="idsProdutosFiltroGenerico10[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico10); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico10[$countArray][0];?>"><?php echo $arrProdutosFiltroGenerico10[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
						<?php 
                        $flagManutencaoLink = $configManutencaoLinkFlag;
                        if($configManutencaoLinkFlag != true)
                        {
                            if(empty($arrProdutosFiltroGenerico10))
                            { 
                                $flagManutencaoLink = true;
                            }else{
                                $flagManutencaoLink = false;
                            }
                        }
                        ?>
                        <?php if($flagManutencaoLink == true){ ?>
                            <?php if($configManutencaoLink == 1){ ?>
                                <a href="SiteAdmProdutosManutencao.php" class="AdmLinks01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 2){ ?>
                                <a href="SiteAdmProdutosManutencao.php?tipoComplemento=21&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 3){ ?>
                                <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmProdutosManutencao.php?tipoComplemento=21&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                            divShow('divManutencaoAjax');
                                            HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_produtos_complemento&tipoComplemento=21&tipoRetorno=3\', \'idsProdutosFiltroGenerico10\', \'<?php echo $GLOBALS['configProdutosFiltroGenerico10CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>                                
                        <?php } ?>                                
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico11'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico11Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
						$arrProdutosFiltroGenerico11 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 22);
                        ?>
                        
                        <?php if($GLOBALS['configProdutosFiltroGenerico11CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico11); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsProdutosFiltroGenerico11[]" type="checkbox" value="<?php echo $arrProdutosFiltroGenerico11[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrProdutosFiltroGenerico11[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico11CaixaSelecao'] == 2){ ?>
                            <select id="idsProdutosFiltroGenerico11" name="idsProdutosFiltroGenerico11[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico11); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico11[$countArray][0];?>"><?php echo $arrProdutosFiltroGenerico11[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico11CaixaSelecao'] == 3){ ?>
                            <select id="idsProdutosFiltroGenerico11" name="idsProdutosFiltroGenerico11[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico11); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico11[$countArray][0];?>"><?php echo $arrProdutosFiltroGenerico11[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
						<?php 
                        $flagManutencaoLink = $configManutencaoLinkFlag;
                        if($configManutencaoLinkFlag != true)
                        {
                            if(empty($arrProdutosFiltroGenerico11))
                            { 
                                $flagManutencaoLink = true;
                            }else{
                                $flagManutencaoLink = false;
                            }
                        }
                        ?>
                        <?php if($flagManutencaoLink == true){ ?>
                            <?php if($configManutencaoLink == 1){ ?>
                                <a href="SiteAdmProdutosManutencao.php" class="AdmLinks01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 2){ ?>
                                <a href="SiteAdmProdutosManutencao.php?tipoComplemento=22&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 3){ ?>
                                <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmProdutosManutencao.php?tipoComplemento=22&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                            divShow('divManutencaoAjax');
                                            HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_produtos_complemento&tipoComplemento=22&tipoRetorno=3\', \'idsProdutosFiltroGenerico11\', \'<?php echo $GLOBALS['configProdutosFiltroGenerico11CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>                                
                        <?php } ?>                                
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico12'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico12Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
						$arrProdutosFiltroGenerico12 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 23);
                        ?>
                        
                        <?php if($GLOBALS['configProdutosFiltroGenerico12CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico12); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsProdutosFiltroGenerico12[]" type="checkbox" value="<?php echo $arrProdutosFiltroGenerico12[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrProdutosFiltroGenerico12[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico12CaixaSelecao'] == 2){ ?>
                            <select id="idsProdutosFiltroGenerico12" name="idsProdutosFiltroGenerico12[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico12); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico12[$countArray][0];?>"><?php echo $arrProdutosFiltroGenerico12[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico12CaixaSelecao'] == 3){ ?>
                            <select id="idsProdutosFiltroGenerico12" name="idsProdutosFiltroGenerico12[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico12); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico12[$countArray][0];?>"><?php echo $arrProdutosFiltroGenerico12[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
						<?php 
                        $flagManutencaoLink = $configManutencaoLinkFlag;
                        if($configManutencaoLinkFlag != true)
                        {
                            if(empty($arrProdutosFiltroGenerico12))
                            { 
                                $flagManutencaoLink = true;
                            }else{
                                $flagManutencaoLink = false;
                            }
                        }
                        ?>
                        <?php if($flagManutencaoLink == true){ ?>
                            <?php if($configManutencaoLink == 1){ ?>
                                <a href="SiteAdmProdutosManutencao.php" class="AdmLinks01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 2){ ?>
                                <a href="SiteAdmProdutosManutencao.php?tipoComplemento=23&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 3){ ?>
                                <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmProdutosManutencao.php?tipoComplemento=23&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                            divShow('divManutencaoAjax');
                                            HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_produtos_complemento&tipoComplemento=23&tipoRetorno=3\', \'idsProdutosFiltroGenerico12\', \'<?php echo $GLOBALS['configProdutosFiltroGenerico12CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>                                
                        <?php } ?>                                
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico13'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico13Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
						$arrProdutosFiltroGenerico13 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 24);
                        ?>
                        
                        <?php if($GLOBALS['configProdutosFiltroGenerico13CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico13); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsProdutosFiltroGenerico13[]" type="checkbox" value="<?php echo $arrProdutosFiltroGenerico13[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrProdutosFiltroGenerico13[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico13CaixaSelecao'] == 2){ ?>
                            <select id="idsProdutosFiltroGenerico13" name="idsProdutosFiltroGenerico13[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico13); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico13[$countArray][0];?>"><?php echo $arrProdutosFiltroGenerico13[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico13CaixaSelecao'] == 3){ ?>
                            <select id="idsProdutosFiltroGenerico13" name="idsProdutosFiltroGenerico13[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico13); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico13[$countArray][0];?>"><?php echo $arrProdutosFiltroGenerico13[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
						<?php 
                        $flagManutencaoLink = $configManutencaoLinkFlag;
                        if($configManutencaoLinkFlag != true)
                        {
                            if(empty($arrProdutosFiltroGenerico13))
                            { 
                                $flagManutencaoLink = true;
                            }else{
                                $flagManutencaoLink = false;
                            }
                        }
                        ?>
                        <?php if($flagManutencaoLink == true){ ?>
                            <?php if($configManutencaoLink == 1){ ?>
                                <a href="SiteAdmProdutosManutencao.php" class="AdmLinks01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 2){ ?>
                                <a href="SiteAdmProdutosManutencao.php?tipoComplemento=24&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 3){ ?>
                                <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmProdutosManutencao.php?tipoComplemento=24&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                            divShow('divManutencaoAjax');
                                            HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_produtos_complemento&tipoComplemento=24&tipoRetorno=3\', \'idsProdutosFiltroGenerico13\', \'<?php echo $GLOBALS['configProdutosFiltroGenerico13CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>                                
                        <?php } ?>                                
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico14'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico14Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
						$arrProdutosFiltroGenerico14 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 25);
                        ?>
                        
                        <?php if($GLOBALS['configProdutosFiltroGenerico14CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico14); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsProdutosFiltroGenerico14[]" type="checkbox" value="<?php echo $arrProdutosFiltroGenerico14[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrProdutosFiltroGenerico14[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico14CaixaSelecao'] == 2){ ?>
                            <select id="idsProdutosFiltroGenerico14" name="idsProdutosFiltroGenerico14[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico14); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico14[$countArray][0];?>"><?php echo $arrProdutosFiltroGenerico14[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico14CaixaSelecao'] == 3){ ?>
                            <select id="idsProdutosFiltroGenerico14" name="idsProdutosFiltroGenerico14[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico14); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico14[$countArray][0];?>"><?php echo $arrProdutosFiltroGenerico14[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
						<?php 
                        $flagManutencaoLink = $configManutencaoLinkFlag;
                        if($configManutencaoLinkFlag != true)
                        {
                            if(empty($arrProdutosFiltroGenerico14))
                            { 
                                $flagManutencaoLink = true;
                            }else{
                                $flagManutencaoLink = false;
                            }
                        }
                        ?>
                        <?php if($flagManutencaoLink == true){ ?>
                            <?php if($configManutencaoLink == 1){ ?>
                                <a href="SiteAdmProdutosManutencao.php" class="AdmLinks01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 2){ ?>
                                <a href="SiteAdmProdutosManutencao.php?tipoComplemento=25&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 3){ ?>
                                <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmProdutosManutencao.php?tipoComplemento=25&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                            divShow('divManutencaoAjax');
                                            HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_produtos_complemento&tipoComplemento=25&tipoRetorno=3\', \'idsProdutosFiltroGenerico24\', \'<?php echo $GLOBALS['configProdutosFiltroGenerico24CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>                                
                        <?php } ?>                                
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico15'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico15Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
						$arrProdutosFiltroGenerico15 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 26);
                        ?>
                        
                        <?php if($GLOBALS['configProdutosFiltroGenerico15CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico15); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsProdutosFiltroGenerico15[]" type="checkbox" value="<?php echo $arrProdutosFiltroGenerico15[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrProdutosFiltroGenerico15[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico15CaixaSelecao'] == 2){ ?>
                            <select id="idsProdutosFiltroGenerico15" name="idsProdutosFiltroGenerico15[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico15); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico15[$countArray][0];?>"><?php echo $arrProdutosFiltroGenerico15[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico15CaixaSelecao'] == 3){ ?>
                            <select id="idsProdutosFiltroGenerico15" name="idsProdutosFiltroGenerico15[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico15); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico15[$countArray][0];?>"><?php echo $arrProdutosFiltroGenerico15[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
						<?php 
                        $flagManutencaoLink = $configManutencaoLinkFlag;
                        if($configManutencaoLinkFlag != true)
                        {
                            if(empty($arrProdutosFiltroGenerico15))
                            { 
                                $flagManutencaoLink = true;
                            }else{
                                $flagManutencaoLink = false;
                            }
                        }
                        ?>
                        <?php if($flagManutencaoLink == true){ ?>
                            <?php if($configManutencaoLink == 1){ ?>
                                <a href="SiteAdmProdutosManutencao.php" class="AdmLinks01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 2){ ?>
                                <a href="SiteAdmProdutosManutencao.php?tipoComplemento=26&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 3){ ?>
                                <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmProdutosManutencao.php?tipoComplemento=26&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                            divShow('divManutencaoAjax');
                                            HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_produtos_complemento&tipoComplemento=26&tipoRetorno=3\', \'idsProdutosFiltroGenerico15\', \'<?php echo $GLOBALS['configProdutosFiltroGenerico15CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>                                
                        <?php } ?>                                
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico16'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico16Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
						$arrProdutosFiltroGenerico16 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 27);
                        ?>
                        
                        <?php if($GLOBALS['configProdutosFiltroGenerico16CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico16); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsProdutosFiltroGenerico16[]" type="checkbox" value="<?php echo $arrProdutosFiltroGenerico16[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrProdutosFiltroGenerico16[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico16CaixaSelecao'] == 2){ ?>
                            <select id="idsProdutosFiltroGenerico16" name="idsProdutosFiltroGenerico16[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico16); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico16[$countArray][0];?>"><?php echo $arrProdutosFiltroGenerico16[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico16CaixaSelecao'] == 3){ ?>
                            <select id="idsProdutosFiltroGenerico16" name="idsProdutosFiltroGenerico16[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico16); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico16[$countArray][0];?>"><?php echo $arrProdutosFiltroGenerico16[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
						<?php 
                        $flagManutencaoLink = $configManutencaoLinkFlag;
                        if($configManutencaoLinkFlag != true)
                        {
                            if(empty($arrProdutosFiltroGenerico16))
                            { 
                                $flagManutencaoLink = true;
                            }else{
                                $flagManutencaoLink = false;
                            }
                        }
                        ?>
                        <?php if($flagManutencaoLink == true){ ?>
                            <?php if($configManutencaoLink == 1){ ?>
                                <a href="SiteAdmProdutosManutencao.php" class="AdmLinks01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 2){ ?>
                                <a href="SiteAdmProdutosManutencao.php?tipoComplemento=27&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 3){ ?>
                                <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmProdutosManutencao.php?tipoComplemento=27&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                            divShow('divManutencaoAjax');
                                            HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_produtos_complemento&tipoComplemento=27&tipoRetorno=3\', \'idsProdutosFiltroGenerico16\', \'<?php echo $GLOBALS['configProdutosFiltroGenerico16CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>                                
                        <?php } ?>                                
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico17'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico17Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
						$arrProdutosFiltroGenerico17 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 28);
                        ?>
                        
                        <?php if($GLOBALS['configProdutosFiltroGenerico17CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico17); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsProdutosFiltroGenerico17[]" type="checkbox" value="<?php echo $arrProdutosFiltroGenerico17[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrProdutosFiltroGenerico17[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico17CaixaSelecao'] == 2){ ?>
                            <select id="idsProdutosFiltroGenerico17" name="idsProdutosFiltroGenerico17[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico17); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico17[$countArray][0];?>"><?php echo $arrProdutosFiltroGenerico17[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico17CaixaSelecao'] == 3){ ?>
                            <select id="idsProdutosFiltroGenerico17" name="idsProdutosFiltroGenerico17[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico17); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico17[$countArray][0];?>"><?php echo $arrProdutosFiltroGenerico17[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
						<?php 
                        $flagManutencaoLink = $configManutencaoLinkFlag;
                        if($configManutencaoLinkFlag != true)
                        {
                            if(empty($arrProdutosFiltroGenerico17))
                            { 
                                $flagManutencaoLink = true;
                            }else{
                                $flagManutencaoLink = false;
                            }
                        }
                        ?>
                        <?php if($flagManutencaoLink == true){ ?>
                            <?php if($configManutencaoLink == 1){ ?>
                                <a href="SiteAdmProdutosManutencao.php" class="AdmLinks01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 2){ ?>
                                <a href="SiteAdmProdutosManutencao.php?tipoComplemento=28&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 3){ ?>
                                <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmProdutosManutencao.php?tipoComplemento=28&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                            divShow('divManutencaoAjax');
                                            HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_produtos_complemento&tipoComplemento=28&tipoRetorno=3\', \'idsProdutosFiltroGenerico17\', \'<?php echo $GLOBALS['configProdutosFiltroGenerico17CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>                                
                        <?php } ?>                                
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico18'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico18Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
						$arrProdutosFiltroGenerico18 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 29);
                        ?>
                        
                        <?php if($GLOBALS['configProdutosFiltroGenerico18CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico18); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsProdutosFiltroGenerico18[]" type="checkbox" value="<?php echo $arrProdutosFiltroGenerico18[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrProdutosFiltroGenerico18[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico18CaixaSelecao'] == 2){ ?>
                            <select id="idsProdutosFiltroGenerico18" name="idsProdutosFiltroGenerico18[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico18); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico18[$countArray][0];?>"><?php echo $arrProdutosFiltroGenerico18[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico18CaixaSelecao'] == 3){ ?>
                            <select id="idsProdutosFiltroGenerico18" name="idsProdutosFiltroGenerico18[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico18); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico18[$countArray][0];?>"><?php echo $arrProdutosFiltroGenerico18[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
						<?php 
                        $flagManutencaoLink = $configManutencaoLinkFlag;
                        if($configManutencaoLinkFlag != true)
                        {
                            if(empty($arrProdutosFiltroGenerico18))
                            { 
                                $flagManutencaoLink = true;
                            }else{
                                $flagManutencaoLink = false;
                            }
                        }
                        ?>
                        <?php if($flagManutencaoLink == true){ ?>
                            <?php if($configManutencaoLink == 1){ ?>
                                <a href="SiteAdmProdutosManutencao.php" class="AdmLinks01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 2){ ?>
                                <a href="SiteAdmProdutosManutencao.php?tipoComplemento=29&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 3){ ?>
                                <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmProdutosManutencao.php?tipoComplemento=29&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                            divShow('divManutencaoAjax');
                                            HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_produtos_complemento&tipoComplemento=29&tipoRetorno=3\', \'idsProdutosFiltroGenerico18\', \'<?php echo $GLOBALS['configProdutosFiltroGenerico18CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>                                
                        <?php } ?>                                
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico19'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico19Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
						$arrProdutosFiltroGenerico19 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 30);
                        ?>
                        
                        <?php if($GLOBALS['configProdutosFiltroGenerico19CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico19); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsProdutosFiltroGenerico19[]" type="checkbox" value="<?php echo $arrProdutosFiltroGenerico19[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrProdutosFiltroGenerico19[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico19CaixaSelecao'] == 2){ ?>
                            <select id="idsProdutosFiltroGenerico19" name="idsProdutosFiltroGenerico19[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico19); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico19[$countArray][0];?>"><?php echo $arrProdutosFiltroGenerico19[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico19CaixaSelecao'] == 3){ ?>
                            <select id="idsProdutosFiltroGenerico19" name="idsProdutosFiltroGenerico19[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico19); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico19[$countArray][0];?>"><?php echo $arrProdutosFiltroGenerico19[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
						<?php 
                        $flagManutencaoLink = $configManutencaoLinkFlag;
                        if($configManutencaoLinkFlag != true)
                        {
                            if(empty($arrProdutosFiltroGenerico19))
                            { 
                                $flagManutencaoLink = true;
                            }else{
                                $flagManutencaoLink = false;
                            }
                        }
                        ?>
                        <?php if($flagManutencaoLink == true){ ?>
                            <?php if($configManutencaoLink == 1){ ?>
                                <a href="SiteAdmProdutosManutencao.php" class="AdmLinks01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 2){ ?>
                                <a href="SiteAdmProdutosManutencao.php?tipoComplemento=30&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 3){ ?>
                                <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmProdutosManutencao.php?tipoComplemento=30&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                            divShow('divManutencaoAjax');
                                            HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_produtos_complemento&tipoComplemento=30&tipoRetorno=3\', \'idsProdutosFiltroGenerico19\', \'<?php echo $GLOBALS['configProdutosFiltroGenerico19CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>                                
                        <?php } ?>                                
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico20'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico20Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
						$arrProdutosFiltroGenerico10 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 31);
                        ?>
                        
                        <?php if($GLOBALS['configProdutosFiltroGenerico20CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico20); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsProdutosFiltroGenerico20[]" type="checkbox" value="<?php echo $arrProdutosFiltroGenerico20[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrProdutosFiltroGenerico20[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico10CaixaSelecao'] == 2){ ?>
                            <select id="idsProdutosFiltroGenerico20" name="idsProdutosFiltroGenerico20[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico20); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico20[$countArray][0];?>"><?php echo $arrProdutosFiltroGenerico20[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico10CaixaSelecao'] == 3){ ?>
                            <select id="idsProdutosFiltroGenerico20" name="idsProdutosFiltroGenerico20[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico20); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico20[$countArray][0];?>"><?php echo $arrProdutosFiltroGenerico20[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
						<?php 
                        $flagManutencaoLink = $configManutencaoLinkFlag;
                        if($configManutencaoLinkFlag != true)
                        {
                            if(empty($arrProdutosFiltroGenerico20))
                            { 
                                $flagManutencaoLink = true;
                            }else{
                                $flagManutencaoLink = false;
                            }
                        }
                        ?>
                        <?php if($flagManutencaoLink == true){ ?>
                            <?php if($configManutencaoLink == 1){ ?>
                                <a href="SiteAdmProdutosManutencao.php" class="AdmLinks01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 2){ ?>
                                <a href="SiteAdmProdutosManutencao.php?tipoComplemento=31&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 3){ ?>
                                <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmProdutosManutencao.php?tipoComplemento=31&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                            divShow('divManutencaoAjax');
                                            HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_produtos_complemento&tipoComplemento=31&tipoRetorno=3\', \'idsProdutosFiltroGenerico20\', \'<?php echo $GLOBALS['configProdutosFiltroGenerico20CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>                                
                        <?php } ?>                                
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico21'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico21Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
						$arrProdutosFiltroGenerico21 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 32);
                        ?>
                        
                        <?php if($GLOBALS['configProdutosFiltroGenerico21CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico21); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsProdutosFiltroGenerico21[]" type="checkbox" value="<?php echo $arrProdutosFiltroGenerico21[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrProdutosFiltroGenerico21[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico21CaixaSelecao'] == 2){ ?>
                            <select id="idsProdutosFiltroGenerico21" name="idsProdutosFiltroGenerico21[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico21); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico21[$countArray][0];?>"><?php echo $arrProdutosFiltroGenerico21[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico21CaixaSelecao'] == 3){ ?>
                            <select id="idsProdutosFiltroGenerico21" name="idsProdutosFiltroGenerico21[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico21); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico21[$countArray][0];?>"><?php echo $arrProdutosFiltroGenerico21[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
						<?php 
                        $flagManutencaoLink = $configManutencaoLinkFlag;
                        if($configManutencaoLinkFlag != true)
                        {
                            if(empty($arrProdutosFiltroGenerico21))
                            { 
                                $flagManutencaoLink = true;
                            }else{
                                $flagManutencaoLink = false;
                            }
                        }
                        ?>
                        <?php if($flagManutencaoLink == true){ ?>
                            <?php if($configManutencaoLink == 1){ ?>
                                <a href="SiteAdmProdutosManutencao.php" class="AdmLinks01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 2){ ?>
                                <a href="SiteAdmProdutosManutencao.php?tipoComplemento=32&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 3){ ?>
                                <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmProdutosManutencao.php?tipoComplemento=32&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                            divShow('divManutencaoAjax');
                                            HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_produtos_complemento&tipoComplemento=32&tipoRetorno=3\', \'idsProdutosFiltroGenerico21\', \'<?php echo $GLOBALS['configProdutosFiltroGenerico21CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>                                
                        <?php } ?>                                
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico22'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico22Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
						$arrProdutosFiltroGenerico22 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 33);
                        ?>
                        
                        <?php if($GLOBALS['configProdutosFiltroGenerico22CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico22); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsProdutosFiltroGenerico22[]" type="checkbox" value="<?php echo $arrProdutosFiltroGenerico22[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrProdutosFiltroGenerico22[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico22CaixaSelecao'] == 2){ ?>
                            <select id="idsProdutosFiltroGenerico22" name="idsProdutosFiltroGenerico22[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico22); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico22[$countArray][0];?>"><?php echo $arrProdutosFiltroGenerico22[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico22CaixaSelecao'] == 3){ ?>
                            <select id="idsProdutosFiltroGenerico22" name="idsProdutosFiltroGenerico22[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico22); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico22[$countArray][0];?>"><?php echo $arrProdutosFiltroGenerico22[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
						<?php 
                        $flagManutencaoLink = $configManutencaoLinkFlag;
                        if($configManutencaoLinkFlag != true)
                        {
                            if(empty($arrProdutosFiltroGenerico22))
                            { 
                                $flagManutencaoLink = true;
                            }else{
                                $flagManutencaoLink = false;
                            }
                        }
                        ?>
                        <?php if($flagManutencaoLink == true){ ?>
                            <?php if($configManutencaoLink == 1){ ?>
                                <a href="SiteAdmProdutosManutencao.php" class="AdmLinks01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 2){ ?>
                                <a href="SiteAdmProdutosManutencao.php?tipoComplemento=33&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 3){ ?>
                                <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmProdutosManutencao.php?tipoComplemento=33&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                            divShow('divManutencaoAjax');
                                            HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_produtos_complemento&tipoComplemento=33&tipoRetorno=3\', \'idsProdutosFiltroGenerico22\', \'<?php echo $GLOBALS['configProdutosFiltroGenerico22CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>                                
                        <?php } ?>                                
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico23'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico23Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
						$arrProdutosFiltroGenerico23 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 34);
                        ?>
                        
                        <?php if($GLOBALS['configProdutosFiltroGenerico23CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico23); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsProdutosFiltroGenerico23[]" type="checkbox" value="<?php echo $arrProdutosFiltroGenerico23[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrProdutosFiltroGenerico23[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico23CaixaSelecao'] == 2){ ?>
                            <select id="idsProdutosFiltroGenerico23" name="idsProdutosFiltroGenerico23[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico23); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico23[$countArray][0];?>"><?php echo $arrProdutosFiltroGenerico23[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico23CaixaSelecao'] == 3){ ?>
                            <select id="idsProdutosFiltroGenerico23" name="idsProdutosFiltroGenerico23[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico23); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico23[$countArray][0];?>"><?php echo $arrProdutosFiltroGenerico23[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
						<?php 
                        $flagManutencaoLink = $configManutencaoLinkFlag;
                        if($configManutencaoLinkFlag != true)
                        {
                            if(empty($arrProdutosFiltroGenerico23))
                            { 
                                $flagManutencaoLink = true;
                            }else{
                                $flagManutencaoLink = false;
                            }
                        }
                        ?>
                        <?php if($flagManutencaoLink == true){ ?>
                            <?php if($configManutencaoLink == 1){ ?>
                                <a href="SiteAdmProdutosManutencao.php" class="AdmLinks01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 2){ ?>
                                <a href="SiteAdmProdutosManutencao.php?tipoComplemento=34&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 3){ ?>
                                <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmProdutosManutencao.php?tipoComplemento=34&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                            divShow('divManutencaoAjax');
                                            HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_produtos_complemento&tipoComplemento=34&tipoRetorno=3\', \'idsProdutosFiltroGenerico23\', \'<?php echo $GLOBALS['configProdutosFiltroGenerico23CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>                                
                        <?php } ?>                                
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico24'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico24Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
						$arrProdutosFiltroGenerico24 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 35);
                        ?>
                        
                        <?php if($GLOBALS['configProdutosFiltroGenerico24CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico24); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsProdutosFiltroGenerico24[]" type="checkbox" value="<?php echo $arrProdutosFiltroGenerico24[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrProdutosFiltroGenerico24[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico24CaixaSelecao'] == 2){ ?>
                            <select id="idsProdutosFiltroGenerico24" name="idsProdutosFiltroGenerico24[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico24); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico24[$countArray][0];?>"><?php echo $arrProdutosFiltroGenerico24[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico24CaixaSelecao'] == 3){ ?>
                            <select id="idsProdutosFiltroGenerico24" name="idsProdutosFiltroGenerico24[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico24); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico24[$countArray][0];?>"><?php echo $arrProdutosFiltroGenerico24[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
						<?php 
                        $flagManutencaoLink = $configManutencaoLinkFlag;
                        if($configManutencaoLinkFlag != true)
                        {
                            if(empty($arrProdutosFiltroGenerico24))
                            { 
                                $flagManutencaoLink = true;
                            }else{
                                $flagManutencaoLink = false;
                            }
                        }
                        ?>
                        <?php if($flagManutencaoLink == true){ ?>
                            <?php if($configManutencaoLink == 1){ ?>
                                <a href="SiteAdmProdutosManutencao.php" class="AdmLinks01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 2){ ?>
                                <a href="SiteAdmProdutosManutencao.php?tipoComplemento=35&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 3){ ?>
                                <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmProdutosManutencao.php?tipoComplemento=35&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                            divShow('divManutencaoAjax');
                                            HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_produtos_complemento&tipoComplemento=35&tipoRetorno=3\', \'idsProdutosFiltroGenerico24\', \'<?php echo $GLOBALS['configProdutosFiltroGenerico24CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>                                
                        <?php } ?>                                
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico25'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico25Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
						$arrProdutosFiltroGenerico25 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 36);
                        ?>
                        
                        <?php if($GLOBALS['configProdutosFiltroGenerico25CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico25); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsProdutosFiltroGenerico25[]" type="checkbox" value="<?php echo $arrProdutosFiltroGenerico25[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrProdutosFiltroGenerico25[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico25CaixaSelecao'] == 2){ ?>
                            <select id="idsProdutosFiltroGenerico25" name="idsProdutosFiltroGenerico25[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico25); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico25[$countArray][0];?>"><?php echo $arrProdutosFiltroGenerico25[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico25CaixaSelecao'] == 3){ ?>
                            <select id="idsProdutosFiltroGenerico25" name="idsProdutosFiltroGenerico25[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico25); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico25[$countArray][0];?>"><?php echo $arrProdutosFiltroGenerico25[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
						<?php 
                        $flagManutencaoLink = $configManutencaoLinkFlag;
                        if($configManutencaoLinkFlag != true)
                        {
                            if(empty($arrProdutosFiltroGenerico25))
                            { 
                                $flagManutencaoLink = true;
                            }else{
                                $flagManutencaoLink = false;
                            }
                        }
                        ?>
                        <?php if($flagManutencaoLink == true){ ?>
                            <?php if($configManutencaoLink == 1){ ?>
                                <a href="SiteAdmProdutosManutencao.php" class="AdmLinks01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 2){ ?>
                                <a href="SiteAdmProdutosManutencao.php?tipoComplemento=36&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 3){ ?>
                                <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmProdutosManutencao.php?tipoComplemento=36&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                            divShow('divManutencaoAjax');
                                            HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_produtos_complemento&tipoComplemento=36&tipoRetorno=3\', \'idsProdutosFiltroGenerico25\', \'<?php echo $GLOBALS['configProdutosFiltroGenerico25CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>                                
                        <?php } ?>                                
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico26'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico26Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
						$arrProdutosFiltroGenerico26 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 37);
                        ?>
                        
                        <?php if($GLOBALS['configProdutosFiltroGenerico26CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico26); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsProdutosFiltroGenerico26[]" type="checkbox" value="<?php echo $arrProdutosFiltroGenerico26[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrProdutosFiltroGenerico26[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico26CaixaSelecao'] == 2){ ?>
                            <select id="idsProdutosFiltroGenerico26" name="idsProdutosFiltroGenerico26[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico26); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico26[$countArray][0];?>"><?php echo $arrProdutosFiltroGenerico26[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico26CaixaSelecao'] == 3){ ?>
                            <select id="idsProdutosFiltroGenerico26" name="idsProdutosFiltroGenerico26[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico26); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico26[$countArray][0];?>"><?php echo $arrProdutosFiltroGenerico26[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
						<?php 
                        $flagManutencaoLink = $configManutencaoLinkFlag;
                        if($configManutencaoLinkFlag != true)
                        {
                            if(empty($arrProdutosFiltroGenerico26))
                            { 
                                $flagManutencaoLink = true;
                            }else{
                                $flagManutencaoLink = false;
                            }
                        }
                        ?>
                        <?php if($flagManutencaoLink == true){ ?>
                            <?php if($configManutencaoLink == 1){ ?>
                                <a href="SiteAdmProdutosManutencao.php" class="AdmLinks01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 2){ ?>
                                <a href="SiteAdmProdutosManutencao.php?tipoComplemento=37&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 3){ ?>
                                <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmProdutosManutencao.php?tipoComplemento=37&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                            divShow('divManutencaoAjax');
                                            HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_produtos_complemento&tipoComplemento=37&tipoRetorno=3\', \'idsProdutosFiltroGenerico26\', \'<?php echo $GLOBALS['configProdutosFiltroGenerico26CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>                                
                        <?php } ?>                                
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico27'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico27Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
						$arrProdutosFiltroGenerico27 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 38);
                        ?>
                        
                        <?php if($GLOBALS['configProdutosFiltroGenerico27CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico27); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsProdutosFiltroGenerico27[]" type="checkbox" value="<?php echo $arrProdutosFiltroGenerico27[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrProdutosFiltroGenerico27[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico27CaixaSelecao'] == 2){ ?>
                            <select id="idsProdutosFiltroGenerico27" name="idsProdutosFiltroGenerico27[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico27); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico27[$countArray][0];?>"><?php echo $arrProdutosFiltroGenerico27[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico27CaixaSelecao'] == 3){ ?>
                            <select id="idsProdutosFiltroGenerico27" name="idsProdutosFiltroGenerico27[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico27); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico27[$countArray][0];?>"><?php echo $arrProdutosFiltroGenerico27[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
						<?php 
                        $flagManutencaoLink = $configManutencaoLinkFlag;
                        if($configManutencaoLinkFlag != true)
                        {
                            if(empty($arrProdutosFiltroGenerico27))
                            { 
                                $flagManutencaoLink = true;
                            }else{
                                $flagManutencaoLink = false;
                            }
                        }
                        ?>
                        <?php if($flagManutencaoLink == true){ ?>
                            <?php if($configManutencaoLink == 1){ ?>
                                <a href="SiteAdmProdutosManutencao.php" class="AdmLinks01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 2){ ?>
                                <a href="SiteAdmProdutosManutencao.php?tipoComplemento=38&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 3){ ?>
                                <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmProdutosManutencao.php?tipoComplemento=38&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                            divShow('divManutencaoAjax');
                                            HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_produtos_complemento&tipoComplemento=38&tipoRetorno=3\', \'idsProdutosFiltroGenerico27\', \'<?php echo $GLOBALS['configProdutosFiltroGenerico27CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>                                
                        <?php } ?>                                
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico28'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico28Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
						$arrProdutosFiltroGenerico28 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 39);
                        ?>
                        
                        <?php if($GLOBALS['configProdutosFiltroGenerico28CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico28); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsProdutosFiltroGenerico28[]" type="checkbox" value="<?php echo $arrProdutosFiltroGenerico28[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrProdutosFiltroGenerico28[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico28CaixaSelecao'] == 2){ ?>
                            <select id="idsProdutosFiltroGenerico28" name="idsProdutosFiltroGenerico28[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico28); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico28[$countArray][0];?>"><?php echo $arrProdutosFiltroGenerico28[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico28CaixaSelecao'] == 3){ ?>
                            <select id="idsProdutosFiltroGenerico28" name="idsProdutosFiltroGenerico28[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico28); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico28[$countArray][0];?>"><?php echo $arrProdutosFiltroGenerico28[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
						<?php 
                        $flagManutencaoLink = $configManutencaoLinkFlag;
                        if($configManutencaoLinkFlag != true)
                        {
                            if(empty($arrProdutosFiltroGenerico28))
                            { 
                                $flagManutencaoLink = true;
                            }else{
                                $flagManutencaoLink = false;
                            }
                        }
                        ?>
                        <?php if($flagManutencaoLink == true){ ?>
                            <?php if($configManutencaoLink == 1){ ?>
                                <a href="SiteAdmProdutosManutencao.php" class="AdmLinks01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 2){ ?>
                                <a href="SiteAdmProdutosManutencao.php?tipoComplemento=39&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 3){ ?>
                                <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmProdutosManutencao.php?tipoComplemento=39&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                            divShow('divManutencaoAjax');
                                            HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_produtos_complemento&tipoComplemento=39&tipoRetorno=3\', \'idsProdutosFiltroGenerico28\', \'<?php echo $GLOBALS['configProdutosFiltroGenerico28CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>                                
                        <?php } ?>                                
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico29'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico29Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
						$arrProdutosFiltroGenerico29 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 40);
                        ?>
                        
                        <?php if($GLOBALS['configProdutosFiltroGenerico29CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico29); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsProdutosFiltroGenerico29[]" type="checkbox" value="<?php echo $arrProdutosFiltroGenerico29[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrProdutosFiltroGenerico29[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico29CaixaSelecao'] == 2){ ?>
                            <select id="idsProdutosFiltroGenerico29" name="idsProdutosFiltroGenerico29[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico29); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico29[$countArray][0];?>"><?php echo $arrProdutosFiltroGenerico29[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico29CaixaSelecao'] == 3){ ?>
                            <select id="idsProdutosFiltroGenerico29" name="idsProdutosFiltroGenerico29[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico29); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico29[$countArray][0];?>"><?php echo $arrProdutosFiltroGenerico29[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
						<?php 
                        $flagManutencaoLink = $configManutencaoLinkFlag;
                        if($configManutencaoLinkFlag != true)
                        {
                            if(empty($arrProdutosFiltroGenerico29))
                            { 
                                $flagManutencaoLink = true;
                            }else{
                                $flagManutencaoLink = false;
                            }
                        }
                        ?>
                        <?php if($flagManutencaoLink == true){ ?>
                            <?php if($configManutencaoLink == 1){ ?>
                                <a href="SiteAdmProdutosManutencao.php" class="AdmLinks01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 2){ ?>
                                <a href="SiteAdmProdutosManutencao.php?tipoComplemento=40&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 3){ ?>
                                <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmProdutosManutencao.php?tipoComplemento=40&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                            divShow('divManutencaoAjax');
                                            HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_produtos_complemento&tipoComplemento=40&tipoRetorno=3\', \'idsProdutosFiltroGenerico29\', \'<?php echo $GLOBALS['configProdutosFiltroGenerico29CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>                                
                        <?php } ?>                                
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico30'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico30Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
						$arrProdutosFiltroGenerico30 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 41);
                        ?>
                        
                        <?php if($GLOBALS['configProdutosFiltroGenerico30CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico30); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsProdutosFiltroGenerico30[]" type="checkbox" value="<?php echo $arrProdutosFiltroGenerico30[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrProdutosFiltroGenerico30[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico30CaixaSelecao'] == 2){ ?>
                            <select id="idsProdutosFiltroGenerico30" name="idsProdutosFiltroGenerico30[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico30); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico30[$countArray][0];?>"><?php echo $arrProdutosFiltroGenerico30[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico30CaixaSelecao'] == 3){ ?>
                            <select id="idsProdutosFiltroGenerico30" name="idsProdutosFiltroGenerico30[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico30); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico30[$countArray][0];?>"><?php echo $arrProdutosFiltroGenerico30[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
						<?php 
                        $flagManutencaoLink = $configManutencaoLinkFlag;
                        if($configManutencaoLinkFlag != true)
                        {
                            if(empty($arrProdutosFiltroGenerico30))
                            { 
                                $flagManutencaoLink = true;
                            }else{
                                $flagManutencaoLink = false;
                            }
                        }
                        ?>
                        <?php if($flagManutencaoLink == true){ ?>
                            <?php if($configManutencaoLink == 1){ ?>
                                <a href="SiteAdmProdutosManutencao.php" class="AdmLinks01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 2){ ?>
                                <a href="SiteAdmProdutosManutencao.php?tipoComplemento=41&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 3){ ?>
                                <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmProdutosManutencao.php?tipoComplemento=41&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                            divShow('divManutencaoAjax');
                                            HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_produtos_complemento&tipoComplemento=41&tipoRetorno=3\', \'idsProdutosFiltroGenerico30\', \'<?php echo $GLOBALS['configProdutosFiltroGenerico30CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>                                
                        <?php } ?>                                
                    </div>
                </td>
            </tr>
            <?php } ?>
                        
            <?php if($GLOBALS['habilitarProdutosDescricao01'] == "1"){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php //echo htmlentities($GLOBALS['configProdutosDescricao01Titulo']); ?> 
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosDescricao01Titulo'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div>
                        <?php //Sem formatação.?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                            <textarea name="descricao01" id="descricao01" class="AdmCampoTextoMultilinha01"></textarea>
                        <?php } ?>
                        
                        <?php //Formatação básica (CLEditor).?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                            
                            <script type="text/javascript">
                                //Caixa básica.
                                $(document).ready(function () {
                                    $("#descricao01").cleditor(
                                        {
                                            //Controles disponíveis na barra de ferramentas.
                                            controls:
                                            CLEditorBasicoControles
                                            , 
                                    
                                            //Fontes disponíveis.
                                            fonts:        
                                            CLEditorBasicoFontes
                                        }
                                    );
                                });
                            </script>
                            <textarea name="descricao01" id="descricao01"></textarea>
                        <?php } ?>
                        
                        <?php //Formatação avançada (CLEditor).?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                            <script type="text/javascript">
                                $(document).ready(function () {
                                    $("#descricao01").cleditor(
                                        {
                                            //Controles disponíveis na barra de ferramentas.
                                            controls:
                                            CLEditorAvancadoControles
                                            , 
                                    
                                            //Fontes disponíveis.
                                            fonts:        
                                            CLEditorAvancadoFontes
                                        }
                                    );
                                });
                            </script>
                            <textarea name="descricao01" id="descricao01"></textarea>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosDescricao02'] == "1"){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosDescricao02Titulo'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div>
                        <?php //Sem formatação.?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                            <textarea name="descricao02" id="descricao02" class="AdmCampoTextoMultilinha01"></textarea>
                        <?php } ?>
                        
                        <?php //Formatação básica (CLEditor).?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                            
                            <script type="text/javascript">
                                //Caixa básica.
                                $(document).ready(function () {
                                    $("#descricao02").cleditor(
                                        {
                                            //Controles disponíveis na barra de ferramentas.
                                            controls:
                                            CLEditorBasicoControles
                                            , 
                                    
                                            //Fontes disponíveis.
                                            fonts:        
                                            CLEditorBasicoFontes
                                        }
                                    );
                                });
                            </script>
                            <textarea name="descricao02" id="descricao02"></textarea>
                        <?php } ?>
                        
                        <?php //Formatação avançada (CLEditor).?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                            <script type="text/javascript">
                                $(document).ready(function () {
                                    $("#descricao02").cleditor(
                                        {
                                            //Controles disponíveis na barra de ferramentas.
                                            controls:
                                            CLEditorAvancadoControles
                                            , 
                                    
                                            //Fontes disponíveis.
                                            fonts:        
                                            CLEditorAvancadoFontes
                                        }
                                    );
                                });
                            </script>
                            <textarea name="descricao02" id="descricao02"></textarea>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosDescricao03'] == "1"){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosDescricao03Titulo'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div>
                        <?php //Sem formatação.?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                            <textarea name="descricao03" id="descricao03" class="AdmCampoTextoMultilinha01"></textarea>
                        <?php } ?>
                        
                        <?php //Formatação básica (CLEditor).?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                            
                            <script type="text/javascript">
                                //Caixa básica.
                                $(document).ready(function () {
                                    $("#descricao03").cleditor(
                                        {
                                            //Controles disponíveis na barra de ferramentas.
                                            controls:
                                            CLEditorBasicoControles
                                            , 
                                    
                                            //Fontes disponíveis.
                                            fonts:        
                                            CLEditorBasicoFontes
                                        }
                                    );
                                });
                            </script>
                            <textarea name="descricao03" id="descricao03"></textarea>
                        <?php } ?>
                        
                        <?php //Formatação avançada (CLEditor).?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                            <script type="text/javascript">
                                $(document).ready(function () {
                                    $("#descricao03").cleditor(
                                        {
                                            //Controles disponíveis na barra de ferramentas.
                                            controls:
                                            CLEditorAvancadoControles
                                            , 
                                    
                                            //Fontes disponíveis.
                                            fonts:        
                                            CLEditorAvancadoFontes
                                        }
                                    );
                                });
                            </script>
                            <textarea name="descricao03" id="descricao03"></textarea>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosDescricao04'] == "1"){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosDescricao04Titulo'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div>
                        <?php //Sem formatação.?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                            <textarea name="descricao04" id="descricao04" class="AdmCampoTextoMultilinha01"></textarea>
                        <?php } ?>
                        
                        <?php //Formatação básica (CLEditor).?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                            
                            <script type="text/javascript">
                                //Caixa básica.
                                $(document).ready(function () {
                                    $("#descricao04").cleditor(
                                        {
                                            //Controles disponíveis na barra de ferramentas.
                                            controls:
                                            CLEditorBasicoControles
                                            , 
                                    
                                            //Fontes disponíveis.
                                            fonts:        
                                            CLEditorBasicoFontes
                                        }
                                    );
                                });
                            </script>
                            <textarea name="descricao04" id="descricao04"></textarea>
                        <?php } ?>
                        
                        <?php //Formatação avançada (CLEditor).?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                            <script type="text/javascript">
                                $(document).ready(function () {
                                    $("#descricao04").cleditor(
                                        {
                                            //Controles disponíveis na barra de ferramentas.
                                            controls:
                                            CLEditorAvancadoControles
                                            , 
                                    
                                            //Fontes disponíveis.
                                            fonts:        
                                            CLEditorAvancadoFontes
                                        }
                                    );
                                });
                            </script>
                            <textarea name="descricao04" id="descricao04"></textarea>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosDescricao05'] == "1"){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosDescricao05Titulo'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div>
                        <?php //Sem formatação.?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                            <textarea name="descricao05" id="descricao05" class="AdmCampoTextoMultilinha01"></textarea>
                        <?php } ?>
                        
                        <?php //Formatação básica (CLEditor).?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                            
                            <script type="text/javascript">
                                //Caixa básica.
                                $(document).ready(function () {
                                    $("#descricao05").cleditor(
                                        {
                                            //Controles disponíveis na barra de ferramentas.
                                            controls:
                                            CLEditorBasicoControles
                                            , 
                                    
                                            //Fontes disponíveis.
                                            fonts:        
                                            CLEditorBasicoFontes
                                        }
                                    );
                                });
                            </script>
                            <textarea name="descricao05" id="descricao05"></textarea>
                        <?php } ?>
                        
                        <?php //Formatação avançada (CLEditor).?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                            <script type="text/javascript">
                                $(document).ready(function () {
                                    $("#descricao05").cleditor(
                                        {
                                            //Controles disponíveis na barra de ferramentas.
                                            controls:
                                            CLEditorAvancadoControles
                                            , 
                                    
                                            //Fontes disponíveis.
                                            fonts:        
                                            CLEditorAvancadoFontes
                                        }
                                    );
                                });
                            </script>
                            <textarea name="descricao05" id="descricao05"></textarea>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosPalavrasChave'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPalavrasChave01"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <textarea name="palavras_chave" id="palavras_chave" class="AdmCampoTextoMultilinha01"></textarea>
                        <br />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPalavrasChave02"); ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosIc1'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc1'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc1'] == 1){ ?>
                            <input type="text" name="informacao_complementar1" id="informacao_complementar1" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosBoxIc1'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar1" id="informacao_complementar1" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar1").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar1" id="informacao_complementar1"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar1").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar1" id="informacao_complementar1"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosIc2'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc2'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc2'] == 1){ ?>
                            <input type="text" name="informacao_complementar2" id="informacao_complementar2" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosBoxIc2'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar2" id="informacao_complementar2" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar2").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar2" id="informacao_complementar2"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar2").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar2" id="informacao_complementar2"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc3'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc3'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc3'] == 1){ ?>
                            <input type="text" name="informacao_complementar3" id="informacao_complementar3" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosBoxIc3'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar3" id="informacao_complementar3" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar3").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar3" id="informacao_complementar3"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar3").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar3" id="informacao_complementar3"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc4'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc4'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc4'] == 1){ ?>
                            <input type="text" name="informacao_complementar4" id="informacao_complementar4" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosBoxIc4'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar4" id="informacao_complementar4" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar4").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar4" id="informacao_complementar4"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar4").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar4" id="informacao_complementar4"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc5'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc5'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc5'] == 1){ ?>
                            <input type="text" name="informacao_complementar5" id="informacao_complementar5" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosBoxIc5'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar5" id="informacao_complementar5" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar5").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar5" id="informacao_complementar5"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar5").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar5" id="informacao_complementar5"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosIc6'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc6'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc6'] == 1){ ?>

                            <input type="text" name="informacao_complementar6" id="informacao_complementar6" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosBoxIc6'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar6" id="informacao_complementar6" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar6").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar6" id="informacao_complementar6"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar6").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar6" id="informacao_complementar6"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosIc7'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc7'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc7'] == 1){ ?>
                            <input type="text" name="informacao_complementar7" id="informacao_complementar7" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosBoxIc2'] == 7){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar7" id="informacao_complementar7" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar7").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar7" id="informacao_complementar7"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar7").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar7" id="informacao_complementar7"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc8'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc8'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc8'] == 1){ ?>
                            <input type="text" name="informacao_complementar8" id="informacao_complementar8" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosBoxIc8'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar8" id="informacao_complementar8" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar8").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar8" id="informacao_complementar8"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar8").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar8" id="informacao_complementar8"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc9'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc9'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc9'] == 1){ ?>
                            <input type="text" name="informacao_complementar9" id="informacao_complementar9" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosBoxIc9'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar9" id="informacao_complementar9" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar9").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar9" id="informacao_complementar9"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar9").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar9" id="informacao_complementar9"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc10'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc10'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc10'] == 1){ ?>
                            <input type="text" name="informacao_complementar10" id="informacao_complementar10" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosBoxIc10'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar10" id="informacao_complementar10" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar10").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar10" id="informacao_complementar10"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar10").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar10" id="informacao_complementar10"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosIc11'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc11'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc11'] == 1){ ?>
                            <input type="text" name="informacao_complementar11" id="informacao_complementar11" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosBoxIc11'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar11" id="informacao_complementar11" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar11").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar11" id="informacao_complementar11"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar11").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar11" id="informacao_complementar11"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosIc12'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc12'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc12'] == 1){ ?>
                            <input type="text" name="informacao_complementar12" id="informacao_complementar12" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosBoxIc12'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar12" id="informacao_complementar12" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar12").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar12" id="informacao_complementar12"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar12").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar12" id="informacao_complementar12"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc13'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc13'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc13'] == 1){ ?>
                            <input type="text" name="informacao_complementar13" id="informacao_complementar13" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosBoxIc13'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar13" id="informacao_complementar13" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar13").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar13" id="informacao_complementar13"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar13").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar13" id="informacao_complementar13"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc14'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc14'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc14'] == 1){ ?>
                            <input type="text" name="informacao_complementar14" id="informacao_complementar14" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosBoxIc14'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar14" id="informacao_complementar14" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar14").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar14" id="informacao_complementar14"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar14").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar14" id="informacao_complementar14"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc15'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc15'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc15'] == 1){ ?>
                            <input type="text" name="informacao_complementar15" id="informacao_complementar15" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosBoxIc15'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar15" id="informacao_complementar15" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar15").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar15" id="informacao_complementar15"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar15").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar15" id="informacao_complementar15"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosIc16'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc16'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc16'] == 1){ ?>
                            <input type="text" name="informacao_complementar16" id="informacao_complementar16" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosBoxIc16'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar16" id="informacao_complementar16" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar16").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar16" id="informacao_complementar16"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar16").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar16" id="informacao_complementar16"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosIc17'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc17'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc17'] == 1){ ?>
                            <input type="text" name="informacao_complementar17" id="informacao_complementar17" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosBoxIc12'] == 7){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar17" id="informacao_complementar17" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar17").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar17" id="informacao_complementar17"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar17").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar17" id="informacao_complementar17"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc18'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc18'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc18'] == 1){ ?>
                            <input type="text" name="informacao_complementar18" id="informacao_complementar18" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosBoxIc18'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar18" id="informacao_complementar18" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar18").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar18" id="informacao_complementar18"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar18").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar18" id="informacao_complementar18"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc19'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc19'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc19'] == 1){ ?>
                            <input type="text" name="informacao_complementar19" id="informacao_complementar19" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosBoxIc19'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar19" id="informacao_complementar19" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar19").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar19" id="informacao_complementar19"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar19").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar19" id="informacao_complementar19"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc20'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc20'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc20'] == 1){ ?>
                            <input type="text" name="informacao_complementar20" id="informacao_complementar20" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosBoxIc20'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar20" id="informacao_complementar20" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar20").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar20" id="informacao_complementar20"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar20").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar20" id="informacao_complementar20"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosIc21'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc21'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc21'] == 1){ ?>
                            <input type="text" name="informacao_complementar21" id="informacao_complementar21" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosBoxIc21'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar21" id="informacao_complementar21" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar21").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar21" id="informacao_complementar21"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar21").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar21" id="informacao_complementar21"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosIc22'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc22'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc22'] == 1){ ?>
                            <input type="text" name="informacao_complementar22" id="informacao_complementar22" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosBoxIc22'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar22" id="informacao_complementar22" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar22").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar22" id="informacao_complementar22"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar22").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar22" id="informacao_complementar22"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc23'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc23'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc23'] == 1){ ?>
                            <input type="text" name="informacao_complementar23" id="informacao_complementar23" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosBoxIc23'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar23" id="informacao_complementar23" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar23").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar23" id="informacao_complementar23"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar23").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar23" id="informacao_complementar23"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc24'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc24'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc24'] == 1){ ?>
                            <input type="text" name="informacao_complementar24" id="informacao_complementar24" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosBoxIc24'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar24" id="informacao_complementar24" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar24").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar24" id="informacao_complementar24"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar24").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar24" id="informacao_complementar24"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc25'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc25'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc25'] == 1){ ?>
                            <input type="text" name="informacao_complementar25" id="informacao_complementar25" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosBoxIc25'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar25" id="informacao_complementar25" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar25").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar25" id="informacao_complementar25"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar25").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar25" id="informacao_complementar25"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosIc26'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc26'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc26'] == 1){ ?>
                            <input type="text" name="informacao_complementar26" id="informacao_complementar26" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosBoxIc26'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar26" id="informacao_complementar26" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar26").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar26" id="informacao_complementar26"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar26").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar26" id="informacao_complementar26"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosIc27'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc27'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc27'] == 1){ ?>
                            <input type="text" name="informacao_complementar27" id="informacao_complementar27" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosBoxIc22'] == 7){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar27" id="informacao_complementar27" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar27").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar27" id="informacao_complementar27"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar27").cleditor(
                                            {

                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar27" id="informacao_complementar27"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc28'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc28'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc28'] == 1){ ?>
                            <input type="text" name="informacao_complementar28" id="informacao_complementar28" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosBoxIc28'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar28" id="informacao_complementar28" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar28").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar28" id="informacao_complementar28"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar28").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar28" id="informacao_complementar28"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc29'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc29'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>

                        <?php if($GLOBALS['configProdutosBoxIc29'] == 1){ ?>
                            <input type="text" name="informacao_complementar29" id="informacao_complementar29" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosBoxIc29'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar29" id="informacao_complementar29" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar29").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar29" id="informacao_complementar29"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar29").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar29" id="informacao_complementar29"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc30'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc30'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc30'] == 1){ ?>
                            <input type="text" name="informacao_complementar30" id="informacao_complementar30" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosBoxIc30'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar30" id="informacao_complementar30" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar30").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar30" id="informacao_complementar30"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar30").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar30" id="informacao_complementar30"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosIc31'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc31'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc31'] == 1){ ?>
                            <input type="text" name="informacao_complementar31" id="informacao_complementar31" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosBoxIc31'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar31" id="informacao_complementar31" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar31").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar31" id="informacao_complementar31"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar31").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar31" id="informacao_complementar31"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosIc32'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc32'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc32'] == 1){ ?>
                            <input type="text" name="informacao_complementar32" id="informacao_complementar32" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosBoxIc32'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar32" id="informacao_complementar32" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar32").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar32" id="informacao_complementar32"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar32").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar32" id="informacao_complementar32"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc33'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc33'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc33'] == 1){ ?>
                            <input type="text" name="informacao_complementar33" id="informacao_complementar33" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosBoxIc33'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar33" id="informacao_complementar33" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar33").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar33" id="informacao_complementar33"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar33").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar33" id="informacao_complementar33"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc34'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc34'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc34'] == 1){ ?>
                            <input type="text" name="informacao_complementar34" id="informacao_complementar34" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosBoxIc34'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar34" id="informacao_complementar34" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar34").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar34" id="informacao_complementar34"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar34").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar34" id="informacao_complementar34"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc35'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc35'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc35'] == 1){ ?>
                            <input type="text" name="informacao_complementar35" id="informacao_complementar35" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosBoxIc35'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar35" id="informacao_complementar35" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar35").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar35" id="informacao_complementar35"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar35").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar35" id="informacao_complementar35"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosIc36'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc36'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc36'] == 1){ ?>
                            <input type="text" name="informacao_complementar36" id="informacao_complementar36" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosBoxIc36'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar36" id="informacao_complementar36" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar36").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar36" id="informacao_complementar36"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar36").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar36" id="informacao_complementar36"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosIc37'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc37'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc37'] == 1){ ?>
                            <input type="text" name="informacao_complementar37" id="informacao_complementar37" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosBoxIc32'] == 7){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar37" id="informacao_complementar37" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar37").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar37" id="informacao_complementar37"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar37").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar37" id="informacao_complementar37"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc38'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc38'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc38'] == 1){ ?>
                            <input type="text" name="informacao_complementar38" id="informacao_complementar38" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosBoxIc38'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar38" id="informacao_complementar38" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar38").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar38" id="informacao_complementar38"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar38").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar38" id="informacao_complementar38"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc39'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc39'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>

                        <?php if($GLOBALS['configProdutosBoxIc39'] == 1){ ?>
                            <input type="text" name="informacao_complementar39" id="informacao_complementar39" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosBoxIc39'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar39" id="informacao_complementar39" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar39").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar39" id="informacao_complementar39"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar39").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar39" id="informacao_complementar39"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc40'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc40'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc40'] == 1){ ?>
                            <input type="text" name="informacao_complementar40" id="informacao_complementar40" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosBoxIc40'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar40" id="informacao_complementar40" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar40").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar40" id="informacao_complementar40"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar40").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar40" id="informacao_complementar40"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosIc41'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc41'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc41'] == 1){ ?>
                            <input type="text" name="informacao_complementar41" id="informacao_complementar41" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosBoxIc41'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar41" id="informacao_complementar41" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar41").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar41" id="informacao_complementar41"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar41").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar41" id="informacao_complementar41"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosIc42'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc42'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc42'] == 1){ ?>
                            <input type="text" name="informacao_complementar42" id="informacao_complementar42" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosBoxIc42'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar42" id="informacao_complementar42" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar42").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar42" id="informacao_complementar42"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar42").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar42" id="informacao_complementar42"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc43'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc43'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc43'] == 1){ ?>
                            <input type="text" name="informacao_complementar43" id="informacao_complementar43" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosBoxIc43'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar43" id="informacao_complementar43" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar43").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar43" id="informacao_complementar43"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar43").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar43" id="informacao_complementar43"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc44'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc44'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc44'] == 1){ ?>
                            <input type="text" name="informacao_complementar44" id="informacao_complementar44" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosBoxIc44'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar44" id="informacao_complementar44" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar44").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar44" id="informacao_complementar44"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar44").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar44" id="informacao_complementar44"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc45'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc45'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc45'] == 1){ ?>
                            <input type="text" name="informacao_complementar45" id="informacao_complementar45" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosBoxIc45'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar45" id="informacao_complementar45" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar45").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar45" id="informacao_complementar45"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar45").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar45" id="informacao_complementar45"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosIc46'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc46'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc46'] == 1){ ?>
                            <input type="text" name="informacao_complementar46" id="informacao_complementar46" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosBoxIc46'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar46" id="informacao_complementar46" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar46").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar46" id="informacao_complementar46"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar46").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar46" id="informacao_complementar46"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosIc47'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc47'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc47'] == 1){ ?>
                            <input type="text" name="informacao_complementar47" id="informacao_complementar47" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosBoxIc42'] == 7){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar47" id="informacao_complementar47" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar47").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar47" id="informacao_complementar47"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar47").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar47" id="informacao_complementar47"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc48'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc48'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc48'] == 1){ ?>
                            <input type="text" name="informacao_complementar48" id="informacao_complementar48" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosBoxIc48'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar48" id="informacao_complementar48" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar48").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar48" id="informacao_complementar48"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar48").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar48" id="informacao_complementar48"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc49'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc49'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>

                        <?php if($GLOBALS['configProdutosBoxIc49'] == 1){ ?>
                            <input type="text" name="informacao_complementar49" id="informacao_complementar49" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosBoxIc49'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar49" id="informacao_complementar49" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar49").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar49" id="informacao_complementar49"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar49").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar49" id="informacao_complementar49"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc50'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc50'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc50'] == 1){ ?>
                            <input type="text" name="informacao_complementar50" id="informacao_complementar50" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosBoxIc50'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar50" id="informacao_complementar50" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar50").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar50" id="informacao_complementar50"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar40").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar50" id="informacao_complementar50"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosValor'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosValor"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">

                    <div class="AdmTexto01">
                    	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>
                        <input type="text" name="valor" id="valor" class="AdmCampoNumerico02" maxlength="255" value="<?php echo Funcoes::MascaraValorLer("0", $GLOBALS['configSistemaMoeda']); ?>" />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemValorDescicao01"); ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosValor1'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosValor1Nome'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                    	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosValor1Moeda'], "IncludeConfig"); ?>
                        <input type="text" name="valor1" id="valor1" class="AdmCampoNumerico02" maxlength="255" value="<?php echo Funcoes::MascaraValorLer("0", $GLOBALS['configSistemaMoeda']); ?>" />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemValorDescicao01"); ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosValor2'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosValor2Nome'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                    	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosValor2Moeda'], "IncludeConfig"); ?>
                        <input type="text" name="valor2" id="valor2" class="AdmCampoNumerico02" maxlength="255" value="<?php echo Funcoes::MascaraValorLer("0", $GLOBALS['configSistemaMoeda']); ?>" />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemValorDescicao01"); ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosPeso'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosPeso"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <input type="text" name="peso" id="peso" class="AdmCampoNumerico02" maxlength="255" value="0" />
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaPeso'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosCoeficiente'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosCoeficienteNome'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosCoeficienteTipo'], "IncludeConfig"); ?>
                        <input type="text" name="coeficiente" id="coeficiente" class="AdmCampoNumerico02" maxlength="255" value="0" />
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao3"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <select name="ativacao" id="ativacao" class="AdmCampoDropDownMenu01">
                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao4"); ?></option>
                            <option value="1" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao5"); ?></option>
                        </select>
                    </div>
                </td>
            </tr>
            
            <?php if($GLOBALS['habilitarProdutosStatus'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosStatus"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrProdutosStatus = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 1);
                        ?>
                        <select name="id_tb_produtos_status" id="id_tb_produtos_status" class="AdmCampoDropDownMenu01">
                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                            <?php 
                            for($countArray = 0; $countArray < count($arrProdutosStatus); $countArray++)
                            {
                            ?>
                                <option value="<?php echo $arrProdutosStatus[$countArray][0];?>"><?php echo $arrProdutosStatus[$countArray][1];?></option>
                            <?php 
                            }
                            ?>
                        </select>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
			<?php if($GLOBALS['ativacaoProdutosImagens'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemImagem"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <input type="file" name="ArquivoUpload1" id="ArquivoUpload1" class="AdmCampoArquivoUpload01">
                    </div>
                </td>
            </tr>
            <?php } ?>

        </table>
        <div style="position: relative; display: block; width: 100%;">
            <div style="float:left;">
            	<?php if(CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroUsuario") <> "" || CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroUsuario2") <> "" || CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroUsuario3") <> ""){ ?>
                <div class="AdmDivBto01" onclick="btoClick_onEvent('btoProdutosIncluir');">
                    <a class="AdmLinks01">
                        Incluir Nova Obra
                    </a>
                </div>
                
                <input id="btoProdutosIncluir" type="image" name="submit" value="Submit" src="img/btoIncluirObra.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoIncluir"); ?>" style="display: none;" />
                <?php } ?>
                
                <input type="hidden" id="id_tb_categorias" name="id_tb_categorias" value="<?php echo $idParentProdutos; ?>" />
                <input type="hidden" id="ativacao_promocao" name="ativacao_promocao" value="0" />
                <input type="hidden" id="ativacao_home" name="ativacao_home" value="0" />
                <input type="hidden" id="ativacao_home_categoria" name="ativacao_home_categoria" value="0" />
                <input type="hidden" id="acesso_restrito"  name="acesso_restrito" value="0" />
                
                <input type="hidden" id="paginaRetorno" name="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                <input type="hidden" id="masterPageSiteSelect" name="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
            </div>
            
            <?php if(CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroUsuario") <> ""){ ?>
            <div style="float:right;">
                <div class="AdmDivBto01" onclick="formularioSubmit('formProdutosAcoes', '', '', '');" style="margin-right: 0px;">
                    <a class="AdmLinks01">
                        Remover
                    </a>
                </div>
            
                <img src="img/btoExcluir.png" onclick="formularioSubmit('formProdutosAcoes', '', '', '');" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoExcluir"); ?>" style="cursor: pointer; display: none;" />
            </div>
            <?php } ?>
        </div>
    </form>
    <br />
	<?php } ?>
    
    
	<?php //Paginação. ?>
    <?php //************************************************************************************** ?>
    <?php if($GLOBALS['habilitarProdutosSistemaPaginacao'] == "1"){ ?>
		<?php if($paginacaoTotal > 1){ //Verifica se existe mais de uma página.?>
            <div align="center" class="AdmTexto01">
                <div style="position: relative; display: inline; margin: 2px;">
                    <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=1<?php echo $queryPadrao; ?>" class="Links03">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPaginacaoPrimeira"); ?>
                    </a>
                </div>
                
                <?php if($paginacaoNumero > 1){ ?>
                    <div style="position: relative; display: inline; margin: 2px;">
                        <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=<?php echo $paginacaoNumero - 1 ?><?php echo $queryPadrao; ?>" class="Links03">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPaginacaoAnterior"); ?>
                        </a>
                    </div>
                <?php } ?>
                
                <?php //Numeração de páginas. ?>
                <?php if($GLOBALS['habilitarVeiculosSistemaPaginacaoNumeracao'] == "1"){ ?>
                    <?php for($countPaginas = 1; $countPaginas <= $paginacaoTotal; $countPaginas++){ ?>
                        <div style="position: relative; display: inline; margin: 2px;">
                            <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=<?php echo $countPaginas; ?><?php echo $queryPadrao; ?>" class="Links03">
                                <?php echo $countPaginas; ?>
                            </a>
                        </div>
                    <?php } ?>
                <?php } ?>
                
                <?php if($paginacaoNumero <> $paginacaoTotal){ ?>
                    <div style="position: relative; display: inline; margin: 2px;">
                        <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=<?php echo $paginacaoNumero + 1 ?><?php echo $queryPadrao; ?>" class="Links03">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPaginacaoProxima"); ?>
                        </a>
                    </div>
                <?php } ?>
                
                <div style="position: relative; display: inline; margin: 2px;">
                    <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=<?php echo $paginacaoTotal; ?><?php echo $queryPadrao; ?>" class="Links03">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPaginacaoUltima"); ?>
                    </a>
                </div>
            </div>
            
            <?php //Contagem de páginas. ?>
            <div align="center" class="AdmTexto01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePaginacaoPaginaContador01"); ?> 
                <?php echo $paginacaoNumero; ?> / <?php echo $paginacaoTotal; ?>
            </div>
        <?php } ?>
	<?php } ?>
	<?php //************************************************************************************** ?>
    
    
    <?php //Manutenção - Ajax.?>
    <div id="divManutencaoAjax" class="AdmDivPopupAjaxContainer" style="">
        <div class="AdmDivPopupAjax" style="">
        	<div style="position: absolute; display: block; height: 25px; top: -25px; right: 0px;">
            	<a id="linkManutencaoAjaxFechar" onclick="" class="AdmLinksFechar01" style="cursor: pointer;">
                    <img src="img/btoFecharJanela.png" border="0" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoFechar"); ?>" />
                </a>
            </div>
            <iframe id="iframeManutencaoAjax" name="iframeManutencaoAjax" src="" class="AdmTabelaIFrame01" scrolling="auto" frameborder="0" width="100%" height="100%">
            </iframe>
        </div>
    </div>
    
    
    <?php //Progress bar.?>
    <div id="updtProgressManutencao" class="ProgressBarGenerico01Container" style="display: none;">
        <div class="ProgressBarGenerico01">
            <img src="img/ProgressBar01.gif" border="0" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteImagemProgressBarra"); ?>" />
        </div>
    </div>
<?php 
$pageSite->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>
<?php
//Limpeza de objetos.
//----------
unset($strSqlProdutosSelect);
unset($statementProdutosSelect);
unset($resultadoProdutos);
unset($linhaProdutos);
//----------


//Inclusão do template do layout.
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>