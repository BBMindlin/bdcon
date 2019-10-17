<?php
//Importação dos arquivos de configuração.
require_once "../sistema/IncludeConfig.php"; //Deve vir antes do db.
require_once "../sistema/IncludeConexao.php";
require_once "../sistema/IncludeFuncoes.php";
//require_once "IncludeLayout.php";
require_once "IncludeLayoutSite.php";


//Verificação de login de cadastro.
LoginAutenticacao::CadastroLoginVerificacao();


//Resgate de variáveis.
$idTbCadastroLogado = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura(CookiesFuncoes::CookieValorLer_Login()), 2);

$idParentCategorias = $_GET["idParentCategorias"];
$idParentCategoriasRaiz = $_GET["idParentCategoriasRaiz"];
$idTbCadastroUsuario = $_GET["idTbCadastroUsuario"];
$idsTbCategorias = $_GET["idsTbCategorias"];
$tipoCategoria = $_GET["tipoCategoria"];

$configTipoDiagramacao = $_GET["configTipoDiagramacao"];

$paginaRetorno = "SiteAdmCategoriasIndice.php";
$criterioClassificacao = $_GET["criterioClassificacao"];
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];

//Montagem de query padrão de retorno.
$queryPadrao = "&paginaRetorno=" . $paginaRetorno .
"&masterPageSiteSelect=" . $masterPageSiteSelect;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Verificação de erro - debug.
//echo "cookie=" . $_COOKIE[$GLOBALS['configNomeCookie'] . "_" . $GLOBALS['configSessionNomeUsuarioMaster']] . "<br>";
//echo "idParentCategorias=" . $idParentCategorias . "<br>";
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloSite'], "IncludeConfig"); ?> - <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAdmPainelTitulo"); ?> - <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCategoriasTitulo"); ?>
<?php 
$pageSite->cphTitle = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Head.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphHead*/ ?>
    <meta name="description" content="" /><?php //Abaixo de 160 caracteres.?>
    <meta name="keywords" content="" /><?php //Abaixo de 100 caracteres.?>
    <meta name="title" content="" /><?php //Abaixo de 60 caracteres.?>
<?php 
$pageSite->cphHead = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Título atual.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphConteudoCabecalho*/ ?>
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCategoriasTitulo"); ?>
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
    
    
    <br />
	<?php //Opções principais.?>
    <?php //----------------------?>
    <?php 
	//Definição de variáveis do include.
	$includeAdmOpcoes_tipoOpcoes = "2";
	$includeAdmOpcoes_configOpcoes = "";
	?>
    
    <?php include "IncludeAdmOpcoes.php";?>
    <?php //----------------------?>

    
    <br />
	<?php //Opções de informações complementares.?>
    <?php //----------------------?>
    <?php 
	//Definição de variáveis do include.
	$includeAdmOpcoes_tipoOpcoes = "ic1";
	$includeAdmOpcoes_configOpcoes = "";
	?>
    
    <?php include "IncludeAdmOpcoes.php";?>
    <?php //----------------------?>
    
    
    
	<?php //Categorias - ADM.?>
    <?php //----------------------?>
    <?php if($configTipoDiagramacao == "1"){ ?>
		<?php 
        //Definição de variáveis do include.
        $includeAdmCategorias_idParentCategorias = $idParentCategorias;
        $includeAdmCategorias_idParentCategoriasRaiz = $idParentCategoriasRaiz;
        $includeAdmCategorias_idTbCadastroUsuario = $idTbCadastroUsuario;
        $includeAdmCategorias_idsTbCategorias = $idsTbCategorias;
        $includeAdmCategorias_tipoCategoria = $tipoCategoria;
        $includeAdmCategorias_habilitarCategoriasSubniveis = "";
        
        $includeAdmCategorias_configTipoDiagramacao = "1";
        $includeAdmCategorias_configCategoriasNRegistros = "";
        $includeAdmCategorias_paginaRetorno = $paginaRetorno;
        ?>
        
        <?php include "IncludeAdmCategoriasIndice.php";?>
    <?php } ?>
    <?php //----------------------?>

    
	<?php //Categorias - ADM.?>
    <?php //----------------------?>
    <?php if($configTipoDiagramacao == "2"){ ?>
		<?php 
        //Definição de variáveis do include.
        $includeAdmCategorias_idParentCategorias = $idParentCategorias;
        $includeAdmCategorias_idParentCategoriasRaiz = $idParentCategoriasRaiz;
        $includeAdmCategorias_idTbCadastroUsuario = $idTbCadastroUsuario;
        $includeAdmCategorias_idsTbCategorias = $idsTbCategorias;
        $includeAdmCategorias_tipoCategoria = $tipoCategoria;
        $includeAdmCategorias_habilitarCategoriasSubniveis = "";
        
        $includeAdmCategorias_configTipoDiagramacao = "2";
        $includeAdmCategorias_configCategoriasNRegistros = "";
        $includeAdmCategorias_paginaRetorno = $paginaRetorno;
        ?>
        
        <?php include "IncludeAdmCategoriasIndice.php";?>
    <?php } ?>
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