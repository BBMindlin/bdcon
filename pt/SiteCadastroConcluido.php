<?php
//Importação dos arquivos de configuração.
require_once "../sistema/IncludeConfig.php"; //Deve vir antes do db.
require_once "../sistema/IncludeConexao.php";
require_once "../sistema/IncludeFuncoes.php";
//require_once "IncludeLayout.php";
require_once "IncludeLayoutSite.php";


//Resgate de variáveis.
$idTbCadastro = $_GET["idTbCadastro"];
$idTbCadastro = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura($idTbCadastro, 2), 2);
$idParentConteudo = $_GET["idParentConteudo"];

$tituloLinkAtual = "";
$metaTitulo = "";
$metaDescricao = "";
$metaPalavrasChave = "";

$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];


//Redirecionamento para o painel de controle.
//$dbSistemaConPDO = null;
//$URLRetorno = $configUrl . "/" . $visualizacaoAtivaSistema . "/SiteAdm.php";
//"?" .
//"&mensagemSucesso=" . $mensagemSucesso .
//"&mensagemErro=" . $mensagemErro;
//header("Location: " . $URLRetorno);
//die();


//Montagem das meta tags.
//----------
$tituloLinkAtual = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroConcluido");
$metaTitulo = Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloSite'], "IncludeConfig") . " - " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroConcluido");
//----------


//Verificação de erro - debug.
//echo "idCePedidos=" . $idCePedidos . "<br>";
//echo "idTbCadastroCliente=" . $idTbCadastroCliente . "<br>";
//echo "cookie=" . $_COOKIE[$GLOBALS['configNomeCookie'] . "_" . $GLOBALS['configSessionNomeUsuarioMaster']] . "<br>";
//echo "cookie(decrypt)=" . $tbUsuariosSenha = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura($_COOKIE[$GLOBALS['configNomeCookie'] . "_" . $GLOBALS['configSessionNomeUsuarioMaster']], 2), 2) . "<br>";
/*
echo "PedidosEnviar=" . Email::PedidosEnviar($idCePedidos, 
											"contato@jorgemauricio.com", 
											"Joge Mauricio", 
											1) . "<br>";
*/											
//echo "CadastroConteudo=" . Email::CadastroConteudo(DbFuncoes::GetCampoGenerico01($idCePedidos, "ce_pedidos", "id_tb_cadastro_cliente"), 1, 0, 1) . "<br>";
//echo "PedidosConteudo=" . Email::PedidosConteudo($idCePedidos, 1, 0) . "<br>";
//echo "PedidosItensConteudo=" . Email::PedidosItensConteudo($idCePedidos, 1, 0) . "<br>";


/*
echo "cookie (idTbCadastroCliente)=" . CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroCliente") . "<br>";
echo "cookie (idTbCadastroUsuario)=" . CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroUsuario") . "<br>";
echo "cookie (idTbCadastroUsuarioVendedor)=" . CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroUsuarioVendedor") . "<br>";
echo "cookie (idTbCadastroUsuarioRH)=" . CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroUsuarioRH") . "<br>";
echo "cookie (idTbCadastroUsuarioVendedor)=" . CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroUsuarioVendedor") . "<br>";
echo "cookie (idTbCadastroAssinante)=" . CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroAssinante") . "<br>";
echo "cookie (idTbCadastroSimples)=" . CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroSimples") . "<br>";
*/
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
    <meta name="description" content="" /><?php //Abaixo de 160 caracteres.?>
    <meta name="keywords" content="" /><?php //Abaixo de 100 caracteres.?>
    <meta name="title" content="<?php echo $metaTitulo;?>" /><?php //Abaixo de 60 caracteres.?>
<?php 
$pageSite->cphHead = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Título atual.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphConteudoCabecalho*/ ?>
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
    
    
	<?php //Informações. ?>
	<?php //**************************************************************************************?>
    <div align="center" class="CadastroTexto" style="position: relative; display: block;">
    	<?php if($GLOBALS['habilitarCadastroConfirmacaoAtivacaoEmail'] == 1){ ?>
			<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroConcluidoMensagemSucesso2"); ?>
    	<?php }else{ ?>
			<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroConcluidoMensagemSucesso1"); ?>
    	<?php } ?>
    </div>
	<?php //**************************************************************************************?>
    
    
	<?php //Cadastro - Detalhes.?>
    <?php //----------------------?>
    <?php if($idTbCadastro <> 0){?>
    <div align="center" style="position: relative; display: none;">
        <?php 
        //Definição de variáveis do include.
        $includeCadastroDetalhes_idTbCadastro = $idTbCadastro;
        $includeCadastro_configTipoDiagramacao = "1";
        ?>
        
        <?php include "IncludeCadastroDetalhes.php";?>
    </div>
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