<?php
$_GET["masterPageSiteSelect"] = "LayoutSitePainel.php";

$labelAlternativo = "1";

//Importação dos arquivos de configuração.
require_once "../sistema/IncludeConfig.php"; //Deve vir antes do db.
//require_once "../sistema/IncludeConfigLabelsEspeciais.php"; //Nomes de labelas especiais.
require_once "../sistema/IncludeConexao.php";
require_once "../sistema/IncludeFuncoes.php";
//require_once "IncludeLayout.php";
require_once "IncludeLayoutSite.php";


//Verificação de login de cadastro.
LoginAutenticacao::CadastroLoginVerificacao();


//Resgate de variáveis.
$idTbCadastroLogin = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura(CookiesFuncoes::CookieValorLer_Login()), 2);

$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];


//Detalhes do cadastro logado.
$ocdCadastroLogado = new ObjetoCadastroDetalhes(); //Criação de objeto com os detalhes do cadastro.
if($idTbCadastroLogin <> "")
{
	//$resultadoCadastroDetalhes = DbFuncoes::TabelaGenericaFill01_FetchAll("tb_cadastro", array("id;" . $idTbCadastroLogado . ";i"));	
	
	//Definição dos valores do cadastro logado.
	$ocdCadastroLogado->CadastroDetalhesResultado($idTbCadastroLogin, 1);
}


//Definição de variáveis.
$tituloLinkAtual = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAdmPainelRelatorios");


//Montagem das meta tags.
//----------
$metaTitulo = $tituloLinkAtual . " - " . Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloSite'], "IncludeConfig");
$metaTitulo = Funcoes::LimitadorCatecteres(Funcoes::RemoverHTML01($metaTitulo), 60);

$metaDescricao = "";
$metaPalavrasChave = "";
//----------


//Verificação de erro - debug.
//echo "cookie=" . $_COOKIE[$GLOBALS['configNomeCookie'] . "_" . $GLOBALS['configSessionNomeUsuarioMaster']] . "<br>";
//echo "cookie(decrypt)=" . $tbUsuariosSenha = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura($_COOKIE[$GLOBALS['configNomeCookie'] . "_" . $GLOBALS['configSessionNomeUsuarioMaster']], 2), 2) . "<br>";
//echo "cookie(idTbCadastroCliente)=" . $_COOKIE[$GLOBALS['configNomeCookie'] . "_" . "idTbCadastroCliente"] . "<br>";
//echo "cookie(idTbCadastroCliente)=" . Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura($_COOKIE[$GLOBALS['configNomeCookie'] . "_" . "idTbCadastroCliente"], 2), 2) . "<br>";

//echo "cookie(idTbCadastroCliente)=" . CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroCliente") . "<br>";
//echo "cookie(idTbCadastroCliente)=" . Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura(CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroCliente"), 2), 2) . "<br>";

//echo "cookie(CookieValorLer_Login)=" . CookiesFuncoes::CookieValorLer_Login() . "<br>";
//echo "cookie(CookieValorLer_Login)=" . Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura(CookiesFuncoes::CookieValorLer_Login(), 2), 2) . "<br>";

/*
echo "tbCadastroNome=" . $ocdCadastroLogado->tbCadastroNome . "<br>";
echo "tbCadastroRazaoSocial=" . $ocdCadastroLogado->tbCadastroRazaoSocial . "<br>";
echo "tbCadastroNomeFantasia=" . $ocdCadastroLogado->tbCadastroNomeFantasia . "<br>";
echo "tbCadastroNomePreferencial=" . $ocdCadastroLogado->tbCadastroNomePreferencial . "<br>";
echo "tbCadastroNomePreferencial=" . $ocdCadastroLogado->tbCadastroNomePreferencial . "<br>";
*/
?>
<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloSite'], "IncludeConfig"); ?> - <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAdmPainelTitulo"); ?> - <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAdmPainelRelatorios"); ?>
<?php 
$pageSite->cphTitle = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>
<?php //Head.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphHead*/ ?>
    <meta name="description" content="<?php echo $metaDescricao;?>" /><?php //Abaixo de 160 caracteres.?>
    <meta name="keywords" content="<?php echo $metaPalavrasChave;?>" /><?php //Abaixo de 100 caracteres.?>
    <meta name="title" content="<?php echo $metaTitulo;?>" /><?php //Abaixo de 60 caracteres.?>
<?php 
$pageSite->cphHead = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>
<?php //Título atual.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphConteudoCabecalho*/ ?>
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAdmPainelRelatorios"); ?>
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
    
    
	<?php //Opções gerais.?>
    <?php //----------------------?>
    <?php 
	//Definição de variáveis do include.
	$includeAdmOpcoes_tipoOpcoes = "1";
	$includeAdmOpcoes_configOpcoes = "";
	?>
    
    <?php include "IncludeAdmOpcoes.php";?>
    <?php //----------------------?>
    
    
	<?php //Busca.?>
    <?php //----------------------?>
    <?php 
	//Definição de variáveis do include.
	$includeBusca_tipoBusca = "historico2";
	$includeBusca_origemBusca = "";
	$includeBusca_idTbCategoriaEscolha = "";
	
	$includeBusca_paginaDestino = "SiteHistoricoIndice.php";
	$includeBusca_formTarget = "_blank";
	?>
    
    <?php include "IncludeBusca.php";?>
    <?php //----------------------?>
    
<?php 
$pageSite->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>
<?php
//Inclusão do template do layout.
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>