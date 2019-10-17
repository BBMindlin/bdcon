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
$id = ContadorUniversal::ContadorUniversalUpdate(1);
$idParent = $_POST["id_parent"];

$idTbCadastroUsuario = $_POST["id_tb_cadastro_usuario"];
if($idTbCadastroUsuario == "")
{
	$idTbCadastroUsuario = 0;
}

$dataAtual = "";
if($configSistemaFormatoData == 1)
{
	$dataAtual = date("d") . "/" . date("m") . "/" . date("Y");
	
}
if($configSistemaFormatoData == 2)
{
	$dataAtual = date("m") . "/" . date("d") . "/" . date("Y");
}
if($GLOBALS['configCadastroHistoricoAdmDataEdicao'] == 0){
	$dataInteracao = Funcoes::DataGravacaoSql($dataAtual, $GLOBALS['configSistemaFormatoData']) . " " . date("H") . ":" . date("i") . ":" . date("s");
}
if($GLOBALS['configCadastroHistoricoAdmDataEdicao'] == 1){
	$dataInteracao = Funcoes::DataGravacaoSql($_POST["data_interacao"], $GLOBALS['configSistemaFormatoData']) . " " . date("H") . ":" . date("i") . ":" . date("s");
}

$assunto = Funcoes::ConteudoMascaraGravacao01($_POST["assunto"]);
$interacao = Funcoes::ConteudoMascaraGravacao01($_POST["interacao"]);


$paginaRetorno = $_POST["paginaRetorno"];
$mensagemErro = "";
$mensagemSucesso = "";

//Montagem de query padrão de retorno.
$queryPadrao = "&masterPageSelect=" . $masterPageSelect;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Inclusão de registro no BD.
//----------
$strSqlHistoricoInteracaoInsert = "";
$strSqlHistoricoInteracaoInsert .= "INSERT INTO tb_historico_interacao ";
$strSqlHistoricoInteracaoInsert .= "SET ";
$strSqlHistoricoInteracaoInsert .= "id = :id, ";
$strSqlHistoricoInteracaoInsert .= "id_parent = :id_parent, ";
$strSqlHistoricoInteracaoInsert .= "id_tb_cadastro_usuario = :id_tb_cadastro_usuario, ";
$strSqlHistoricoInteracaoInsert .= "data_interacao = :data_interacao, ";
$strSqlHistoricoInteracaoInsert .= "assunto = :assunto, ";
$strSqlHistoricoInteracaoInsert .= "interacao = :interacao ";
//----------


//Componentes e parâmetros.
//----------
$statementHistoricoInteracaoInsert = $dbSistemaConPDO->prepare($strSqlHistoricoInteracaoInsert);

if ($statementHistoricoInteracaoInsert !== false)
{
	$statementHistoricoInteracaoInsert->execute(array(
		"id" => $id,
		"id_parent" => $idParent,
		"id_tb_cadastro_usuario" => $idTbCadastroUsuario,
		"data_interacao" => $dataInteracao,
		"assunto" => $assunto,
		"interacao" => $interacao
	));
	
	$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus2");
	//Obs: Colocar um flag de verificação de gravação.
}else{
	//echo "erro";
	$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus3");
}
//----------


//Limpeza de objetos.
//----------
unset($strSqlHistoricoInteracaoInsert);
unset($statementHistoricoInteracaoInsert);
//----------


//Envio de mensagem.
//**************************************************************************************
if($habilitarCadastroHistoricoEnvioAutomatico == 1)
{
	//Infomações do cadastro.
	//----------
	$idTbCadastroDestinatario = DbFuncoes::GetCampoGenerico01($idParent, "tb_historico", "id_parent");
	$emailDestinatario = DbFuncoes::GetCampoGenerico01($idTbCadastroDestinatario, "tb_cadastro", "email_principal");
	$nomeDestinatario = Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($idTbCadastroDestinatario, "tb_cadastro", "nome"), 
			DbFuncoes::GetCampoGenerico01($idTbCadastroDestinatario, "tb_cadastro", "razao_social"), 
			DbFuncoes::GetCampoGenerico01($idTbCadastroDestinatario, "tb_cadastro", "nome_fantasia"), 
			1);
	//----------
	
	//Informações da mensagem.
	//----------
	$assuntoEmail = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoInteracaoEnvioAssuntoEmail") . Funcoes::ConteudoMascaraLeitura(DbFuncoes::GetCampoGenerico01($idParent, "tb_historico", "assunto"));
	
	$emailCorpoMensagemTexto = Email::HistoricoInteracaoConteudo($id, false);
	$emailCorpoMensagemHTML = Email::HistoricoInteracaoConteudo($id, true);
	//----------

	
	//Envio de e-mail.
	//----------
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
		
		//$mensagemSucesso = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus18");
		
		//Gravação de log.
		if(DbFuncoes::ItensEnviadosGravar(0, 
		$idTbCadastroDestinatario, 
		$id, 
		1, 
		0, 
		"tb_historico_interacao", 
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
		
	}else{
		//erro.
		$mensagemErro = "(" . $resultadoEnvioEmail . ")";
	}
	//----------
	
	
	//Cópia da mensagem - sistema.
	//----------
	if($habilitarCadastroHistoricoEnvioAutomaticoCopia == 1)
	{
		$idTbCadastroDestinatario = 0; //0 - Sistema.
		$emailDestinatario = $GLOBALS['configEmailDestinatario'];
		$nomeDestinatario = $GLOBALS['configEmailDestinatarioNome'];
				
		//Envio de e-mail.
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
					
						
		if($resultadoEnvioEmail == true)
		{
			
			//$mensagemSucesso = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus18");
			
		}else{
			//erro.
			$mensagemErro = "(" . $resultadoEnvioEmail . ")";
		}
	}
	//----------
	
	
	//Cópia da mensagem - cadastro (vínculo) - id_tb_cadastro1.
	//----------
	$tbCadastroIdTbCadastro1 = DbFuncoes::GetCampoGenerico01(DbFuncoes::GetCampoGenerico01($idParent, "tb_historico", "id_parent"), "tb_cadastro", "id_tb_cadastro1");
	if($tbCadastroIdTbCadastro1 <> 0)
	{
		//Infomações do cadastro.
		$idTbCadastroDestinatario = $tbCadastroIdTbCadastro1;
		$emailDestinatario = DbFuncoes::GetCampoGenerico01($tbCadastroIdTbCadastro1, "tb_cadastro", "email_principal");
		$nomeDestinatario = Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($tbCadastroIdTbCadastro1, "tb_cadastro", "nome"), 
				DbFuncoes::GetCampoGenerico01($tbCadastroIdTbCadastro1, "tb_cadastro", "razao_social"), 
				DbFuncoes::GetCampoGenerico01($tbCadastroIdTbCadastro1, "tb_cadastro", "nome_fantasia"), 
				1);
				
		//Envio de e-mail.
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
					
						
		if($resultadoEnvioEmail == true)
		{
			
			//$mensagemSucesso = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus18");
			
		}else{
			//erro.
			$mensagemErro = "(" . $resultadoEnvioEmail . ")";
		}
	}
	//----------
	
	
	//Cópia da mensagem - histórico - usuário.
	//----------
	$tbHistoricoInteracaoIdTbCadastroUsuario = DbFuncoes::GetCampoGenerico01($id, "tb_historico_interacao", "id_tb_cadastro_usuario");
	if($tbHistoricoInteracaoIdTbCadastroUsuario <> 0)
	{
		//Infomações do cadastro.
		$idTbCadastroDestinatario = $tbHistoricoInteracaoIdTbCadastroUsuario;
		$emailDestinatario = DbFuncoes::GetCampoGenerico01($tbHistoricoInteracaoIdTbCadastroUsuario, "tb_cadastro", "email_principal");
		$nomeDestinatario = Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($tbHistoricoInteracaoIdTbCadastroUsuario, "tb_cadastro", "nome"), 
				DbFuncoes::GetCampoGenerico01($tbHistoricoInteracaoIdTbCadastroUsuario, "tb_cadastro", "razao_social"), 
				DbFuncoes::GetCampoGenerico01($tbHistoricoInteracaoIdTbCadastroUsuario, "tb_cadastro", "nome_fantasia"), 
				1);
				
		//Envio de e-mail.
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
					
						
		if($resultadoEnvioEmail == true)
		{
			
			//$mensagemSucesso = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus18");
			
		}else{
			//erro.
			$mensagemErro = "(" . $resultadoEnvioEmail . ")";
		}
	}
	//----------
}
//**************************************************************************************


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
//$dbSistemaConMysqli->close();
$dbSistemaConPDO = null;


//Montagem do URL de retorno.
//$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
$URLRetorno = $configUrl . "/" . $visualizacaoAtivaSistema . "/" . $paginaRetorno . "?" .
"idParent=" . $idParent .
$queryPadrao .
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