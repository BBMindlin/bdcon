<?php
//Importação dos arquivos de configuração.
require_once "../sistema/IncludeConfig.php"; //Deve vir antes do db.
require_once "../sistema/IncludeConexao.php";
require_once "../sistema/IncludeFuncoes.php";
//require_once "IncludeLayout.php";
require_once "IncludeLayoutSite.php";


//Resgate de variáveis.
$idTbFormularios = $_POST["idTbFormularios"];
//$emailCorpoMensagemTexto = "";
//$emailCorpoMensagemHTML = "";

$mensagemErro = "";
$mensagemSucesso = "";


//Query de pesquisa.
//----------
$strSqlFormulariosDetalhesSelect = "";
$strSqlFormulariosDetalhesSelect .= "SELECT ";
//$strSqlFormulariosDetalhesSelect .= "* ";
$strSqlFormulariosDetalhesSelect .= "id, ";
$strSqlFormulariosDetalhesSelect .= "id_tb_categorias, ";
$strSqlFormulariosDetalhesSelect .= "nome_formulario, ";
$strSqlFormulariosDetalhesSelect .= "assunto_formulario, ";
$strSqlFormulariosDetalhesSelect .= "nome_email_destinatario, ";
$strSqlFormulariosDetalhesSelect .= "email_destinatario, ";
$strSqlFormulariosDetalhesSelect .= "email_copia, ";
$strSqlFormulariosDetalhesSelect .= "config_mensagem_sucesso ";
$strSqlFormulariosDetalhesSelect .= "FROM tb_formularios ";
$strSqlFormulariosDetalhesSelect .= "WHERE id <> 0 ";
//$strSqlFormulariosDetalhesSelect .= "AND id_tb_categorias = :id_tb_categorias ";
$strSqlFormulariosDetalhesSelect .= "AND id = :id ";
//$strSqlFormulariosDetalhesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";


$statementFormulariosDetalhesSelect = $dbSistemaConPDO->prepare($strSqlFormulariosDetalhesSelect);

if ($statementFormulariosDetalhesSelect !== false)
{
	$statementFormulariosDetalhesSelect->execute(array(
		"id" => $idTbFormularios
	));
}

//$resultadoFormulariosDetalhes = $dbSistemaConPDO->query($strSqlFormulariosDetalhesSelect);
$resultadoFormulariosDetalhes = $statementFormulariosDetalhesSelect->fetchAll();

if (empty($resultadoFormulariosDetalhes))
{
	//echo "Nenhum registro encontrado";
}else{
	foreach($resultadoFormulariosDetalhes as $linhaFormulariosDetalhes)
	{
		//Definição das variáveis de detalhes.
		$tbFormulariosId = $linhaFormulariosDetalhes['id'];
		$tbFormulariosIdTbCategorias = $linhaFormulariosDetalhes['id_tb_categorias'];
		$tbFormulariosNomeFormulario = Funcoes::ConteudoMascaraLeitura($linhaFormulariosDetalhes['nome_formulario']);
		$tbFormulariosAssuntoFormulario = Funcoes::ConteudoMascaraLeitura($linhaFormulariosDetalhes['assunto_formulario']);
		$tbFormulariosNomeEmailDestinatario = Funcoes::ConteudoMascaraLeitura($linhaFormulariosDetalhes['nome_email_destinatario']);
		$tbFormulariosEmailDestinatario = Funcoes::ConteudoMascaraLeitura($linhaFormulariosDetalhes['email_destinatario']);
		$tbFormulariosEmailCopia = Funcoes::ConteudoMascaraLeitura($linhaFormulariosDetalhes['email_copia']);
		$tbFormulariosConfigMensagemSucesso = Funcoes::ConteudoMascaraLeitura($linhaFormulariosDetalhes['config_mensagem_sucesso']);
		
		//Verificação de erro.
		//echo "tbFormulariosId=" . $tbFormulariosId . "<br>";
		//echo "tbFormulariosTitulo=" . $tbFormulariosTitulo . "<br>";
		//echo "tbFormulariosAtivacao=" . $tbFormulariosAtivacao . "<br>";
	}
}

?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo $GLOBALS['configNomeCliente']; ?>
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
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteFormulariosTituloPaginaEnvio"); ?>
<?php 
$pageSite->cphTituloLinkAtual = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Conteúdo principal.?>
<?php //**************************************************************************************?>
<?php ob_start(); /*cphConteudoPrincipal*/ ?>

<?php 
//Verificação de erro - debug.
//echo "emailCorpoMensagemTexto=" . $emailCorpoMensagemTexto . "<br>";


//Envio de e-mail.
//----------
$resultadoEnvioEmail = Email::EnviarEmail($GLOBALS['configEmailRemetente'], 
				utf8_encode($GLOBALS['configEmailRemetenteNome']), 
				$tbFormulariosEmailDestinatario, 
				$tbFormulariosNomeEmailDestinatario, 
				"", 
				"", 
				"", 
				"", 
				$tbFormulariosAssuntoFormulario, 
				Formularios::FormularioConteudo($idTbFormularios, false), 
				Formularios::FormularioConteudo($idTbFormularios, true), 
				0, 
				$GLOBALS['configFormatoEmail']);
				
if($resultadoEnvioEmail == true)
{
	//Sucesso.
	if($GLOBALS['habilitarFormulariosConfigMensageSucesso'] == 1)
	{
		$mensagemSucesso = $tbFormulariosConfigMensagemSucesso;
	}else{
		$mensagemSucesso = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteMensagemFormulariosEnvio");
	}
	
	//Gravação de log.
}else{
	//erro.
	$mensagemErro = "(" . $resultadoEnvioEmail . ")";
}
//----------
?>

    <div align="center" class="AdmErro">
        <?php echo $mensagemErro;?>
    </div>
    <div align="center" class="FormulariosTextoSucesso">
        <?php echo $mensagemSucesso;?>
    </div>

<?php 
$pageSite->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php
//Limpeza de objetos.
//----------
unset($strSqlFormulariosDetalhesSelect);
unset($statementFormulariosDetalhesSelect);
unset($resultadoFormulariosDetalhes);
unset($linhaFormulariosDetalhes);
//----------


//Inclusão do template do layout.
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>