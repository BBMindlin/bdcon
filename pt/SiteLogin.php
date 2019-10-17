<?php
//$masterPageSiteSelect = "LayoutSitePainel.php";
$_GET["masterPageSiteSelect"] = "LayoutSitePainel.php";

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
//echo "CookieValorLer=" . CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "URLReferenciaLogin")  . "<br>";
?>
<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloSite'], "IncludeConfig"); ?> - <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteLoginTitulo"); ?>
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
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteLoginTitulo"); ?>
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
    
	<?php //Login.?>
    <?php //----------------------?>
    <?php 
	//Definição de variáveis do include.
	$includeLogin_tipoLogin = "1";
	$includeLogin_origemLogin = "1";
	?>
    
    <?php include "IncludeLogin.php";?>
    <?php //----------------------?>
    
    <div class="ConteudoTextoCorrido" style="position: relative; display: block; overflow: hidden; margin-top: 20px; text-align: justify;">
        <strong>
            Licen&ccedil;a de Uso
        </strong>
        <br />
        Esse software foi desenvolvido pela <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configNomeCliente'], "IncludeConfig"); ?> para gest&atilde;o de dados de conserva&ccedil;&atilde;o e restauro de obras. &Eacute; de distribui&ccedil;&atilde;o gratuita e c&oacute;digo aberto. Pode ser customizado pela Institui&ccedil;&atilde;o usu&aacute;ria, desde que mantido o nome da BBM/USP.
        <br />
        <br />
        Cr&eacute;ditos
        <br />
        - Desenvolvimento de conte&uacute;do: Isis Baldini e Andr&eacute;ia Wojcicki Ruberti
        <br />
        - Desenvolvimento do software: Maur&iacute;cio Nunes e <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configNomeDesenvolvedor'], "IncludeConfig"); ?>
        <br />
        - Apoio: BNDES
        S&atilde;o Paulo, mar&ccedil;o de 2019.

    </div>
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