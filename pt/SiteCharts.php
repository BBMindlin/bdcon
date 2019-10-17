<?php
//Importação dos arquivos de configuração.
require_once "../sistema/IncludeConfig.php"; //Deve vir antes do db.
require_once "../sistema/IncludeConexao.php";
require_once "../sistema/IncludeFuncoes.php";
//require_once "IncludeLayout.php";
require_once "IncludeLayoutSite.php";


//Resgate de variáveis.
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];

//Verificação de erro - debug.
//echo "cookie=" . $_COOKIE[$GLOBALS['configNomeCookie'] . "_" . $GLOBALS['configSessionNomeUsuarioMaster']] . "<br>";
//echo "cookie(decrypt)=" . $tbUsuariosSenha = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura($_COOKIE[$GLOBALS['configNomeCookie'] . "_" . $GLOBALS['configSessionNomeUsuarioMaster']], 2), 2) . "<br>";
//echo "cookie(CookieValorLer_Login)=" . Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura(CookiesFuncoes::CookieValorLer_Login(), 2), 2) . "<br>";

//$mensagemSucesso = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteLogoffMensagem01");
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo htmlentities($GLOBALS['configTituloSite']); ?>
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
	<?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteLogoffTitulo"); ?>
<?php 
$pageSite->cphTituloLinkAtual = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Conteúdo principal.?>
<?php //**************************************************************************************?>
<?php ob_start(); /*cphConteudoPrincipal*/ ?>

	<?php //Charts.?>
    <?php //----------------------?>
    <?php 
    //Definição de variáveis do include.
    $includeCharts_chartID = $_GET["includeCharts_chartID"];
    $includeCharts_chartTipo = $_GET["includeCharts_chartTipo"]; //1 - Canvas JS
    $includeCharts_chartEstilo = $_GET["includeCharts_chartEstilo"]; //Canvas JS (line, column, bar, area, spline, splineArea, stepLine, scatter, bubble, stackedColumn, stackedBar, stackedArea, stackedColumn100, stackedBar100, stackedArea100, pie, doughnut)
    $includeCharts_chartW = $_GET["includeCharts_chartW"]; //pixels (120px) ou % (100%)
    $includeCharts_chartH = $_GET["includeCharts_chartH"]; //pixels (120px) ou % (100%)
    
    $includeCharts_chartBarraW = $_GET["includeCharts_chartBarraW"]; //15
    $includeCharts_chartCorBarraPadrao = $_GET["includeCharts_chartCorBarraPadrao"]; //#cccccc
    $includeCharts_chartCorTextos = $_GET["includeCharts_chartCorTextos"]; //#cccccc
    $includeCharts_chartCorGrafico = $_GET["includeCharts_chartCorGrafico"]; //#cccccc
    $includeCharts_chartLinhaGraficoXEspessura = $_GET["includeCharts_chartLinhaGraficoXEspessura"]; //0 - invisível
    $includeCharts_chartLinhaGraficoYEspessura = $_GET["includeCharts_chartLinhaGraficoYEspessura"]; //0 - invisível
    $includeCharts_chartEixoXMaximo = $_GET["includeCharts_chartEixoXMaximo"]; //
    $includeCharts_chartEixoYMaximo = $_GET["includeCharts_chartEixoYMaximo"]; //
    $includeCharts_chartEixoYIntervalo = $_GET["includeCharts_chartEixoYIntervalo"]; //

    $includeCharts_chartTitulo = $_GET["includeCharts_chartTitulo"];
    $includeCharts_chartTituloX = $_GET["includeCharts_chartTituloX"];
    $includeCharts_chartTituloY = $_GET["includeCharts_chartTituloY"];
    
    //$includeCharts_chartDados = "";
    $includeCharts_chartDados = $_GET["includeCharts_chartDados"];
    /*
    ex:
    {label: 'apple', y: 50, color: '#ccc'},
    {label: 'orange', y: 15},
    {label: 'banana', y: 25},
    {label: 'mango', y: 30},
    {label: 'grape', y: 28}
    
    $includeCharts_chartDados = "
    {label: 'apple', y: 50, color: '#ccc'},
    {label: 'orange', y: 15},
    {label: 'banana', y: 25},
    {label: 'mango', y: 30},
    {label: 'grape', y: 28}
    ";
    */
    $includeCharts_chartDadosMultiplos = $_GET["includeCharts_chartDadosMultiplos"];
    //$includeCharts_chartDadosMultiplos = Funcoes::GetQueryString("includeCharts_chartDadosMultiplos"); //alternativa para servidores com limitação de tamanho de querystring (suhosin.get.max_value_length);
	
	//Verificação de erro - debug.
	//echo "includeCharts_chartID=" . $includeCharts_chartID . "<br/>";
	//echo "includeCharts_chartTipo=" . $includeCharts_chartTipo . "<br/>";
	//echo "includeCharts_chartEstilo=" . $includeCharts_chartEstilo . "<br/>";
	//echo "includeCharts_chartW=" . $includeCharts_chartW . "<br/>";
	//echo "includeCharts_chartH=" . $includeCharts_chartH . "<br/>";
	//echo "includeCharts_chartBarraW=" . $includeCharts_chartBarraW . "<br/>";
	//echo "includeCharts_chartCorBarraPadrao=" . $includeCharts_chartCorBarraPadrao . "<br/>";
	//echo "includeCharts_chartCorTextos=" . $includeCharts_chartCorTextos . "<br/>";
	//echo "includeCharts_chartCorGrafico=" . $includeCharts_chartCorGrafico . "<br/>";
	//echo "includeCharts_chartLinhaGraficoXEspessura=" . $includeCharts_chartLinhaGraficoXEspessura . "<br/>";
	//echo "includeCharts_chartLinhaGraficoYEspessura=" . $includeCharts_chartLinhaGraficoYEspessura . "<br/>";
	//echo "includeCharts_chartDados=" . $includeCharts_chartDados . "<br/>";
    ?>
    
    <?php include "IncludeCharts.php";?>
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