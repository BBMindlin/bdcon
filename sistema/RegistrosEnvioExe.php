<?php
//Recurso para permitir o redirecionamento (evitar duplicidade de header).
ob_start();


//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeLayout.php";


//Verificação de login Master.
LoginAutenticacao::UsuarioLoginVerificacao();


//Verificação de login Master.
$idRegistro = $_GET["idRegistro"];
$strTabela = $_GET["strTabela"];
$tipoCategoria = $_GET["tipoCategoria"];

$idTbCadastroDestinatario = $_GET["idTbCadastroDestinatario"];
$idsTbCadastroDestinatario = $_GET["idsTbCadastroDestinatario"];

$assuntoEmail = "";
$emailCorpoMensagemTexto = "";
$emailCorpoMensagemHTML = "";

$paginaRetorno = $_GET["paginaRetorno"];
$variavelRetorno = $_GET["variavelRetorno"];
$variavelRetornoValor = $_GET["variavelRetornoValor"];
$masterPageSelect = $_GET["masterPageSelect"];
$mensagemErro = "";
$mensagemSucesso = "";

$paginacaoNumero = $_GET["paginacaoNumero"];
$palavraChave = $_GET["palavraChave"];


//Tarefas.
//----------
if($strTabela == "tb_tarefas")
{
	$assuntoEmail = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaTarefasLembreteEnvioAssuntoEmail") . Funcoes::ConteudoMascaraLeitura(DbFuncoes::GetCampoGenerico01($idRegistro, "tb_tarefas", "tarefa"));
	
	$emailCorpoMensagemTexto = Email::TarefasConteudo($idRegistro, false);
	$emailCorpoMensagemHTML = Email::TarefasConteudo($idRegistro, true);
}
//----------


//Aulas.
//----------
if($strTabela == "tb_aulas")
{
	$assuntoEmail = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaAulasEnvioAssuntoEmail") . Funcoes::ConteudoMascaraLeitura(DbFuncoes::GetCampoGenerico01($idRegistro, "tb_aulas", "tema"));
	
	//$emailCorpoMensagemTexto = Email::TarefasConteudo($idRegistro, false);
	//$emailCorpoMensagemHTML = Email::TarefasConteudo($idRegistro, true);
	
	$emailCorpoMensagemTexto = "";
	$emailCorpoMensagemTexto .= "Acesse o link abaixo:" . $GLOBALS['configQuebraLinha']; //substituir por tb_conteudo
	$emailCorpoMensagemTexto .= $GLOBALS['configUrlSSL'] . "/" . $GLOBALS['visualizacaoAtivaSistema'] . "/" . "SiteAdmAulasAdministrar.php?idTbAulas=" . $idRegistro;
	//$emailCorpoMensagemTexto .= "";
	
	$emailCorpoMensagemHTML = "";
	$emailCorpoMensagemHTML .= "Acesse o link abaixo:" . $GLOBALS['configQuebraLinha']; //substituir por tb_conteudo
	$emailCorpoMensagemHTML .= "<a href='";
	$emailCorpoMensagemHTML .= $GLOBALS['configUrlSSL'] . "/" . $GLOBALS['visualizacaoAtivaSistema'] . "/" . "SiteAdmAulasAdministrar.php?idTbAulas=" . $idRegistro;
	$emailCorpoMensagemHTML .= "'>";
	$emailCorpoMensagemHTML .= $GLOBALS['configUrlSSL'] . "/" . $GLOBALS['visualizacaoAtivaSistema'] . "/" . "SiteAdmAulasAdministrar.php?idTbAulas=" . $idRegistro;
	$emailCorpoMensagemHTML .= "</a>";
}
//----------


//Envio de e-mail.
//**************************************************************************************
if($idsTbCadastroDestinatario <> "")
{
	//Múltiplos destinatários.
	$arrIdsTbCadastroDestinatario = array();
	$emailDestinatarioMultiplo = "";
	$nomeDestinatarioMultiplo = "";
	
	$arrIdsTbCadastroDestinatario = explode(",", $idsTbCadastroDestinatario);
	
	for($countArrayEnvio = 0; $countArrayEnvio < count($arrIdsTbCadastroDestinatario); $countArrayEnvio++)
	{
		//Limpleza de variáveis.
		$emailDestinatarioMultiplo = "";
		$nomeDestinatarioMultiplo = "";
		
		$nomeDestinatarioMultiplo = Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($arrIdsTbCadastroDestinatario[$countArrayEnvio], "tb_cadastro", "nome"), 
																								DbFuncoes::GetCampoGenerico01($arrIdsTbCadastroDestinatario[$countArrayEnvio], "tb_cadastro", "razao_social"), 
																								DbFuncoes::GetCampoGenerico01($arrIdsTbCadastroDestinatario[$countArrayEnvio], "tb_cadastro", "nome_fantasia"), 1));
		$emailDestinatarioMultiplo = DbFuncoes::GetCampoGenerico01($arrIdsTbCadastroDestinatario[$countArrayEnvio], "tb_cadastro", "email_principal");
	
		$resultadoEnvioEmail = Email::EnviarEmail($GLOBALS['configEmailRemetente'], 
												utf8_encode($GLOBALS['configEmailRemetenteNome']), 
												$emailDestinatarioMultiplo, 
												$nomeDestinatarioMultiplo, 
												"", 
												"", 
												"", 
												"", 
												$assuntoEmail, 
												$emailCorpoMensagemTexto, 
												$emailCorpoMensagemHTML, 
												0, 
												$GLOBALS['configFormatoEmail']);
						
		//Verificação de erro - debug.
		//echo "arrIdsTbCadastroDestinatario[$countArrayEnvio]=" . $arrIdsTbCadastroDestinatario[$countArrayEnvio] . "<br />";
		//echo "nomeDestinatarioMultiplo=" . $nomeDestinatarioMultiplo . "<br />";
		//echo "emailDestinatarioMultiplo=" . $emailDestinatarioMultiplo . "<br />";
		//echo "resultadoEnvioEmail=" . $resultadoEnvioEmail . "<br />";
						
		//Gravação de log.
		//----------
		if($resultadoEnvioEmail == true)
		{
			if(DbFuncoes::ItensEnviadosGravar(0, 
											$arrIdsTbCadastroDestinatario[$countArrayEnvio], 
											$idRegistro, 
											1, 
											0, 
											$strTabela, 
											htmlentities($GLOBALS['configEmailRemetenteNome']), 
											$GLOBALS['configEmailRemetente'], 
											$nomeDestinatarioMultiplo, 
											$emailDestinatarioMultiplo, 
											$assuntoEmail, 
											$emailCorpoMensagemTexto, 
											"", 
											"") == true){
												
											}else{
												//Erro na gravação do log.
												//$mensagemErro = "Erro na gravação do log.";
											}	
		}else{
			//erro.
			$mensagemErro = "(" . $resultadoEnvioEmail . ")";
		}
		//----------

	}
	
}else{

	//Somente um destinatário.
	$nomeDestinatario = Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($idTbCadastroDestinatario, "tb_cadastro", "nome"), DbFuncoes::GetCampoGenerico01($idTbCadastroDestinatario, "tb_cadastro", "razao_social"), DbFuncoes::GetCampoGenerico01($idTbCadastroDestinatario, "tb_cadastro", "nome_fantasia"), 1));
	$emailDestinatario = DbFuncoes::GetCampoGenerico01($idTbCadastroDestinatario, "tb_cadastro", "email_principal");
	
	$resultadoEnvioEmail = Email::EnviarEmail($GLOBALS['configEmailRemetente'], 
					utf8_encode($GLOBALS['configEmailRemetenteNome']), 
					$emailDestinatario, 
					$nomeDestinatario, 
					"", 
					"", 
					"", 
					"", 
					$assuntoEmail, 
					$emailCorpoMensagemTexto, 
					$emailCorpoMensagemHTML, 
					0, 
					$GLOBALS['configFormatoEmail']);
	
					
	//$resultadoEnvioEmail = true; //teste			
	if($resultadoEnvioEmail == true)
	{
		
		$mensagemSucesso = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus18");
		
		//Gravação de log.
		//----------
		if(DbFuncoes::ItensEnviadosGravar(0, 
										$idTbCadastroDestinatario, 
										$idRegistro, 
										1, 
										0, 
										$strTabela, 
										htmlentities($GLOBALS['configEmailRemetenteNome']), 
										$GLOBALS['configEmailRemetente'], 
										$nomeDestinatario, 
										$emailDestinatario, 
										$assuntoEmail, 
										$emailCorpoMensagemTexto, 
										"", 
										"") == true){
											
										}else{
											//Erro na gravação do log.
											//$mensagemErro = "Erro na gravação do log.";
										}	
		//----------
		
	}else{
		//erro.
		$mensagemErro = "(" . $resultadoEnvioEmail . ")";
	}
}
//**************************************************************************************


//Verificação de erro.
//echo "idRegistro=" . $idRegistro . "<br>";
//echo "strTabela=" . $strTabela . "<br>";
//echo "tipoCategoria=" . $tipoCategoria . "<br>";

//echo "idTbCadastroDestinatario=" . $idTbCadastroDestinatario . "<br>";
//echo "nomeDestinatario=" . $nomeDestinatario . "<br>";
//echo "emailDestinatario=" . $emailDestinatario . "<br>";

//echo "tbTarefasId=" . $tbTarefasId . "<br>";
//echo "tbTarefasIdParent=" . $tbTarefasIdParent . "<br>";
//echo "tbTarefasDataRegistroTarefa=" . $tbTarefasDataRegistroTarefa . "<br>";
//echo "tbTarefasDataTarefa=" . $tbTarefasDataTarefa . "<br>";
//echo "tbTarefasTarefa=" . $tbTarefasTarefa . "<br>";
//echo "tbTarefasDescricao=" . $tbTarefasDescricao . "<br>";

//echo "assuntoEmail=" . $assuntoEmail . "<br>";
//echo "EmailCorpoMensagemTexto=" . $emailCorpoMensagemTexto . "<br>";
//echo "EmailCorpoMensagemHTML=" . $emailCorpoMensagemHTML . "<br>";

//echo "EmailCorpoMensagemHTML=" . $emailCorpoMensagemHTML . "<br>";


//Fechamento da conexão.
$dbSistemaConPDO = null;


//Montagem do URL de retorno.
$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
$variavelRetorno . "=" . $variavelRetornoValor .
"&masterPageSelect=" . $masterPageSelect .
"&paginacaoNumero=" . $paginacaoNumero .
"&palavraChave=" . $palavraChave .
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