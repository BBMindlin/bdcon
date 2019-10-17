<?php
//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
//require_once "IncludeUsuarioVerificacao.php";
require_once "IncludeLayout.php";


//Verificação de login Master.
LoginAutenticacao::UsuarioLoginVerificacao();


//Verificação de login Master.
//$idTbUsuarios = $_GET["idTbUsuarios"];
$idTbUsuarios = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura($_COOKIE[$GLOBALS['configNomeCookie'] . "_" . $GLOBALS['configSessionNomeUsuario']], 2), 2);
$dataAtual = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");

$paginaRetorno = "Main.php";
$paginaRetornoExclusao = "Main.php";
//$variavelRetorno = "idTbUsuarios";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];


//Montagem de query padrão de retorno.
//"&idTbCadastroUsuario=" . $idTbCadastroUsuario . 
//"&variavelRetorno=" . $variavelRetorno
$queryPadrao = "&paginaRetorno=" . $paginaRetorno . "&paginaRetornoExclusao=" . $paginaRetornoExclusao;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Query de pesquisa.
//----------
$strSqlUsuariosDetalhesSelect = "";
$strSqlUsuariosDetalhesSelect .= "SELECT ";
$strSqlUsuariosDetalhesSelect .= "id, ";
$strSqlUsuariosDetalhesSelect .= "nome, ";
$strSqlUsuariosDetalhesSelect .= "usuario, ";
$strSqlUsuariosDetalhesSelect .= "senha, ";
$strSqlUsuariosDetalhesSelect .= "email, ";
$strSqlUsuariosDetalhesSelect .= "obs, ";
$strSqlUsuariosDetalhesSelect .= "usuario_data, ";
$strSqlUsuariosDetalhesSelect .= "usuario_tipo, ";
$strSqlUsuariosDetalhesSelect .= "ativacao ";
$strSqlUsuariosDetalhesSelect .= "FROM tb_usuarios ";
$strSqlUsuariosDetalhesSelect .= "WHERE id <> 0 ";
//$strSqlUsuariosDetalhesSelect .= "AND id_tb_categorias = :id_tb_categorias ";
$strSqlUsuariosDetalhesSelect .= "AND id = :id ";
//$strSqlUsuariosDetalhesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";


$statementUsuariosDetalhesSelect = $dbSistemaConPDO->prepare($strSqlUsuariosDetalhesSelect);

if ($statementUsuariosDetalhesSelect !== false)
{
	$statementUsuariosDetalhesSelect->execute(array(
		"id" => $idTbUsuarios
	));
}

//$resultadoUsuariosDetalhes = $dbSistemaConPDO->query($strSqlUsuariosDetalhesSelect);
$resultadoUsuariosDetalhes = $statementUsuariosDetalhesSelect->fetchAll();


if (empty($resultadoUsuariosDetalhes))
{
	//echo "Nenhum registro encontrado";
}else{
	foreach($resultadoUsuariosDetalhes as $linhaUsuariosDetalhes)
	{
		//Definição das variáveis de detalhes.
		$tbUsuariosId = $linhaUsuariosDetalhes['id'];
		$tbUsuariosNome = Funcoes::ConteudoMascaraLeitura($linhaUsuariosDetalhes['nome']);
		$tbUsuariosUsuario = Funcoes::ConteudoMascaraLeitura($linhaUsuariosDetalhes['usuario']);
		
		//$tbUsuariosSenha = Funcoes::ConteudoMascaraLeitura($linhaUsuariosDetalhes['usuario']);
		if($GLOBALS['configCadastroMetodoSenha'] == 1){
			$tbUsuariosSenha = "";
        }
		
		if($GLOBALS['configCadastroMetodoSenha'] == 2){
        	if($GLOBALS['configCadastroSenha'] == 1){
            	$tbUsuariosSenha = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura($linhaUsuariosDetalhes['senha'], 2), 2);
            }
        }
		
		$tbUsuariosEmail = $linhaUsuariosDetalhes['email'];
		$tbUsuariosOBS = Funcoes::ConteudoMascaraLeitura($linhaUsuariosDetalhes['obs']);
		$tbUsuariosUsuarioData = $linhaUsuariosDetalhes['usuario_data'];
		$tbUsuariosUsuarioTipo = $linhaUsuariosDetalhes['usuario_tipo'];
		$tbUsuariosAtivacao = $linhaUsuariosDetalhes['ativacao'];
		//Verificação de erro.
		//echo "tbCadastroId=" . $tbUsuariosId . "<br>";
		//echo "tbCadastroNome=" . $tbUsuariosNome . "<br>";
	}
}
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistema"); ?> - <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configNomeCliente'], "IncludeConfig"); ?>
<?php 
$page->cphTitle = ob_get_clean(); 
?>
<?php //**************************************************************************************?>


<?php //Head.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphHead*/ ?>
	
<?php 
$page->cphHead = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Cabeçalho.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphConteudoCabecalho*/ ?>
    <div align="left" class="TextoTitulo01">
    	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaMainTitulo"); ?>
    </div>
<?php 
$page->cphConteudoCabecalho = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Conteúdo principal.?>
<?php //**************************************************************************************?>
<?php ob_start(); /*cphConteudoPrincipal*/ ?>
    <div align="center" class="TextoErro">
        <?php echo $mensagemErro;?>
    </div>
    <div align="center" class="TextoSucesso">
        <?php echo $mensagemSucesso;?>
    </div>
    
    
    <div align="left" class="Texto01" style="/*min-height: 400px;*/">
		<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaMainBemvindo"); ?>, 
        <?php echo $tbUsuariosNome;?>
        <br />
        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaMainLogado"); ?>: <?php echo $tbUsuariosUsuario;?>
    </div>
    
    
	<?php //Turmas - Aviso Data Final.?>
    <?php //**************************************************************************************?>
    <?php 
	if($habilitarTurmasAvisoDataFinal == 1){ 
	
	$arrConfigTurmasAvisoDataFinal = explode(";", $configTurmasAvisoDataFinal);
	$configTurmasAvisoDataFinalPeriodo = $arrConfigTurmasAvisoDataFinal[0];
	$configTurmasAvisoDataFinalTipoIntervalo = $arrConfigTurmasAvisoDataFinal[1];
	?>
    	<?php
		//Query de pesquisa.
		//----------
		$strSqlTurmasSelect = "";
		$strSqlTurmasSelect .= "SELECT ";
		//$strSqlTurmasSelect .= "* ";
		$strSqlTurmasSelect .= "id, ";
		$strSqlTurmasSelect .= "id_parent, ";
		$strSqlTurmasSelect .= "id_tb_cadastro1, ";
		$strSqlTurmasSelect .= "id_tb_cadastro2, ";
		$strSqlTurmasSelect .= "id_tb_cadastro3, ";
		$strSqlTurmasSelect .= "id_tb_cadastro4, ";
		$strSqlTurmasSelect .= "id_tb_cadastro5, ";
		/*
		$strSqlTurmasSelect .= "n_classificacao, ";
		*/
		$strSqlTurmasSelect .= "data_criacao, ";
		$strSqlTurmasSelect .= "data_inicio, ";
		$strSqlTurmasSelect .= "data_final, ";
		$strSqlTurmasSelect .= "data1, ";
		$strSqlTurmasSelect .= "data2, ";
		$strSqlTurmasSelect .= "data3, ";
		$strSqlTurmasSelect .= "data4, ";
		$strSqlTurmasSelect .= "data5, ";
		$strSqlTurmasSelect .= "data6, ";
		$strSqlTurmasSelect .= "data7, ";
		$strSqlTurmasSelect .= "data8, ";
		$strSqlTurmasSelect .= "data9, ";
		$strSqlTurmasSelect .= "data10, ";
		$strSqlTurmasSelect .= "nome_turma, ";
		/*
		$strSqlTurmasSelect .= "cod_turma, ";
		$strSqlTurmasSelect .= "descricao, ";
		$strSqlTurmasSelect .= "id_tb_turmas_status, ";
		$strSqlTurmasSelect .= "palavras_chave, ";
		$strSqlTurmasSelect .= "valor, ";
		$strSqlTurmasSelect .= "valor1, ";
		$strSqlTurmasSelect .= "valor2, ";
		$strSqlTurmasSelect .= "valor3, ";
		$strSqlTurmasSelect .= "valor4, ";
		$strSqlTurmasSelect .= "valor5, ";
		$strSqlTurmasSelect .= "url1, ";
		$strSqlTurmasSelect .= "url2, ";
		$strSqlTurmasSelect .= "url3, ";
		$strSqlTurmasSelect .= "url4, ";
		$strSqlTurmasSelect .= "url5, ";
		$strSqlTurmasSelect .= "informacao_complementar1, ";
		$strSqlTurmasSelect .= "informacao_complementar2, ";
		$strSqlTurmasSelect .= "informacao_complementar3, ";
		$strSqlTurmasSelect .= "informacao_complementar4, ";
		$strSqlTurmasSelect .= "informacao_complementar5, ";
		$strSqlTurmasSelect .= "informacao_complementar6, ";
		$strSqlTurmasSelect .= "informacao_complementar7, ";
		$strSqlTurmasSelect .= "informacao_complementar8, ";
		$strSqlTurmasSelect .= "informacao_complementar9, ";
		$strSqlTurmasSelect .= "informacao_complementar10, ";
		
		$strSqlTurmasSelect .= "informacao_complementar11, ";
		$strSqlTurmasSelect .= "informacao_complementar12, ";
		$strSqlTurmasSelect .= "informacao_complementar13, ";
		$strSqlTurmasSelect .= "informacao_complementar14, ";
		$strSqlTurmasSelect .= "informacao_complementar15, ";
		$strSqlTurmasSelect .= "informacao_complementar16, ";
		$strSqlTurmasSelect .= "informacao_complementar17, ";
		$strSqlTurmasSelect .= "informacao_complementar18, ";
		$strSqlTurmasSelect .= "informacao_complementar19, ";
		$strSqlTurmasSelect .= "informacao_complementar20, ";
		$strSqlTurmasSelect .= "informacao_complementar21, ";
		$strSqlTurmasSelect .= "informacao_complementar22, ";
		$strSqlTurmasSelect .= "informacao_complementar23, ";
		$strSqlTurmasSelect .= "informacao_complementar24, ";
		$strSqlTurmasSelect .= "informacao_complementar25, ";
		$strSqlTurmasSelect .= "informacao_complementar26, ";
		$strSqlTurmasSelect .= "informacao_complementar27, ";
		$strSqlTurmasSelect .= "informacao_complementar28, ";
		$strSqlTurmasSelect .= "informacao_complementar29, ";
		$strSqlTurmasSelect .= "informacao_complementar30, ";
		$strSqlTurmasSelect .= "informacao_complementar31, ";
		$strSqlTurmasSelect .= "informacao_complementar32, ";
		$strSqlTurmasSelect .= "informacao_complementar33, ";
		$strSqlTurmasSelect .= "informacao_complementar34, ";
		$strSqlTurmasSelect .= "informacao_complementar35, ";
		$strSqlTurmasSelect .= "informacao_complementar36, ";
		$strSqlTurmasSelect .= "informacao_complementar37, ";
		$strSqlTurmasSelect .= "informacao_complementar38, ";
		$strSqlTurmasSelect .= "informacao_complementar39, ";
		$strSqlTurmasSelect .= "informacao_complementar40, ";
		$strSqlTurmasSelect .= "informacao_complementar41, ";
		$strSqlTurmasSelect .= "informacao_complementar42, ";
		$strSqlTurmasSelect .= "informacao_complementar43, ";
		$strSqlTurmasSelect .= "informacao_complementar44, ";
		$strSqlTurmasSelect .= "informacao_complementar45, ";
		$strSqlTurmasSelect .= "informacao_complementar46, ";
		$strSqlTurmasSelect .= "informacao_complementar47, ";
		$strSqlTurmasSelect .= "informacao_complementar48, ";
		$strSqlTurmasSelect .= "informacao_complementar49, ";
		$strSqlTurmasSelect .= "informacao_complementar50, ";
		$strSqlTurmasSelect .= "informacao_complementar51, ";
		$strSqlTurmasSelect .= "informacao_complementar52, ";
		$strSqlTurmasSelect .= "informacao_complementar53, ";
		$strSqlTurmasSelect .= "informacao_complementar54, ";
		$strSqlTurmasSelect .= "informacao_complementar55, ";
		$strSqlTurmasSelect .= "informacao_complementar56, ";
		$strSqlTurmasSelect .= "informacao_complementar57, ";
		$strSqlTurmasSelect .= "informacao_complementar58, ";
		$strSqlTurmasSelect .= "informacao_complementar59, ";
		$strSqlTurmasSelect .= "informacao_complementar60, ";
		$strSqlTurmasSelect .= "ativacao, ";
		$strSqlTurmasSelect .= "ativacao1, ";
		$strSqlTurmasSelect .= "ativacao2, ";
		$strSqlTurmasSelect .= "ativacao3, ";
		$strSqlTurmasSelect .= "ativacao4, ";
		$strSqlTurmasSelect .= "anotacoes_internas, ";
		$strSqlTurmasSelect .= "n_visitas, ";
		*/
		$strSqlTurmasSelect .= "acesso_restrito ";
		$strSqlTurmasSelect .= "FROM tb_turmas ";
		$strSqlTurmasSelect .= "WHERE id <> 0 ";
		/*
		if($idParentTurmas <> "")
		{
			$strSqlTurmasSelect .= "AND id_parent = :id_parent ";
		}
		*/
		$strSqlTurmasSelect .= "ORDER BY " . $GLOBALS['configClassificacaoTurmas'] . " ";
		
		//Paginação.
		if($GLOBALS['habilitarTurmasSistemaPaginacao'] == "1"){ 
			if($configTipoDB == 2)
			{
				$strSqlTurmasSelect .= "LIMIT " . $paginacaoInicio . ", " . $paginacaoNRegistros . "";
			}
		}
		
		$statementTurmasSelect = $dbSistemaConPDO->prepare($strSqlTurmasSelect);
		
		if ($statementTurmasSelect !== false)
		{
			/*
			if($idParentTurmas <> "")
			{
				$statementTurmasSelect->bindParam(':id_parent', $idParentTurmas, PDO::PARAM_STR);
			}
			*/
			$statementTurmasSelect->execute();
			
			/*
			$statementTurmasSelect->execute(array(
				"id_parent" => $idParentTurmas
			));
			*/
		}
		
		//$resultadoTurmas = $dbSistemaConPDO->query($strSqlTurmasSelect);
		$resultadoTurmas = $statementTurmasSelect->fetchAll();
		?>
        
        
        <div align="left" class="Texto01" style="position: relative; display: block; margin-top: 20px;">
			<?php if(empty($resultadoTurmas)){ ?>
                
            <?php }else{ ?>
        		<?php foreach($resultadoTurmas as $linhaTurmas){ ?>
                	<?php 
					//Verificação de registros a serem enviados.
					//----------
					if($linhaTurmas['data_final'] <> NULL)
					{
						
						//$intervaloDataFinal = Funcoes::DataIntervalo02("h", Funcoes::DataLeitura01($linhaTurmas['data_final'], $GLOBALS['configSistemaFormatoData'], "11"), Funcoes::DataLeitura01($dataAtual, $GLOBALS['configSistemaFormatoData'], "11"));
						$intervaloDataFinal = Funcoes::DataIntervalo02($configTurmasAvisoDataFinalTipoIntervalo, Funcoes::DataLeitura01($linhaTurmas['data_final'], $GLOBALS['configSistemaFormatoData'], "11"), Funcoes::DataLeitura01($dataAtual, $GLOBALS['configSistemaFormatoData'], "11"));
						
						
						//if($intervaloDataFinal < 100)
						if($intervaloDataFinal < $configTurmasAvisoDataFinalPeriodo)
						{
							//Verificação se o item já foi enviado.
							if(DbFuncoes::GetCampoGenerico06("tb_itens_enviados", 
															"id", 
															"id_item", 
															$linhaTurmas['id'], 
															"", 
															"", 
															2,
															"", 
															"", 
															"tipo_interatividade", 
															"1", 
															"id_tb_cadastro_destinatario", 
															"0") == "")
															{
																//Intervalo entre data atual e data pesquisada.
																$assuntoEmail = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaTurmasLembreteEnvioAssuntoEmail") . "Final de Turma: " . Funcoes::ConteudoMascaraLeitura($linhaTurmas['nome_turma']);
																
																
																//Montagem da mensagem.							
																$emailCorpoMensagemTexto = "";
																$emailCorpoMensagemTexto .= "Lembrete de final de turma:" . $GLOBALS['configQuebraLinha'];
																$emailCorpoMensagemTexto .= Funcoes::ConteudoMascaraLeitura($linhaTurmas['nome_turma']);
																//$emailCorpoMensagemTexto .= "";
																
																$emailCorpoMensagemHTML = "";
																$emailCorpoMensagemHTML .= "Lembrete de final de turma:" . $GLOBALS['configQuebraLinha'];
																$emailCorpoMensagemHTML .= Funcoes::ConteudoMascaraLeitura($linhaTurmas['nome_turma']);
																
																
																//Envio de e-mail de lembrete.
																///*
																$resultadoEnvioEmail = Email::EnviarEmail($GLOBALS['configEmailRemetente'], 
																										utf8_encode($GLOBALS['configEmailRemetenteNome']), 
																										$GLOBALS['configEmailDestinatario'], 
																										utf8_encode($GLOBALS['configEmailDestinatarioNome']), 
																										"", 
																										"", 
																										"", 
																										"", 
																										$assuntoEmail, 
																										$emailCorpoMensagemTexto, 
																										$emailCorpoMensagemHTML, 
																										0, 
																										$GLOBALS['configFormatoEmail']);
																//*/
																
																if($resultadoEnvioEmail == true)
																{
																	//Gravação de log.
																	if(DbFuncoes::ItensEnviadosGravar(0, 
																									"0", 
																									$linhaTurmas['id'], 
																									1, 
																									0, 
																									"tb_turmas", 
																									Funcoes::ConteudoMascaraLeitura($GLOBALS['configEmailRemetenteNome'], "IncludeConfig"), 
																									$GLOBALS['configEmailRemetente'], 
																									Funcoes::ConteudoMascaraLeitura($GLOBALS['configEmailRemetenteNome'], "IncludeConfig"), 
																									$GLOBALS['configEmailDestinatario'], 
																									$assuntoEmail, 
																									$emailCorpoMensagemTexto, 
																									"", 
																									"") == true)
																									{
																										//Sucesso
																										echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaTurmasLembreteEnvioAssuntoEmail") . 
																										$linhaTurmas['nome_turma'] . "-" . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus18") . 
																										"<br/>";
																									}else{
																										//Erro na gravação do log.
																										echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaTurmasLembreteEnvioAssuntoEmail") . 
																										$linhaTurmas['nome_turma'] . "-" . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus23e") . 
																										"<br/>";
																									}	
																	
																	
																}
																
																
																//Verificação de erro - debug.
																//echo "nome_turma=" . $linhaTurmas['nome_turma'] . "<br/>";
																//echo "intervaloDataFinal=" . $intervaloDataFinal . "<br/>";
																/*echo "intervaloDataFinal=" . DbFuncoes::GetCampoGenerico06("tb_itens_enviados", 
																															"id", 
																															"id_item", 
																															$linhaTurmas['id'], 
																															"", 
																															"", 
																															2,
																															"", 
																															"", 
																															"tipo_interatividade", 
																															"1", 
																															"id_tb_cadastro_destinatario", 
																															"0") . "<br/>"*/;
															}
																						
																													
						}
						
						
						//Verificação de erro - debug.
						//echo "id=" . $linhaTurmas['id'] . "<br/>";
						//echo "DataIntervalo02 = " . Funcoes::DataIntervalo02("h", "2016-12-04", "2016-12-02") . "<br/>";
						//echo "DataIntervalo02 = " . Funcoes::DataIntervalo02("h", "2016-12-04T12:00:00", "2016-12-02T12:00:00") . "<br/>";
						//echo "DataIntervalo02 = " . Funcoes::DataIntervalo02("h", "2016-12-02T12:00:00", "2016-12-04T12:00:00") . "<br/>";
						//echo "DataIntervalo02 = " . Funcoes::DataIntervalo02("h", "2006-04-14T11:30:00", "2006-04-12T12:30:00") . "<br/>";
						//echo "DataIntervalo02 = " . Funcoes::DataIntervalo02("h", "2016-12-04T00:00:00", "2016-12-02T00:00:00") . "<br/>";
						//echo "dataAtual=" . $dataAtual . "<br/>";
						//echo "DataLeitura01=" . Funcoes::DataLeitura01($dataAtual, $GLOBALS['configSistemaFormatoData'], "11") . "<br/>";
						//echo "DataIntervalo02 = " . Funcoes::DataIntervalo02("h", Funcoes::DataLeitura01($linhaTurmas['data_final'], $GLOBALS['configSistemaFormatoData'], "11"), Funcoes::DataLeitura01($dataAtual, $GLOBALS['configSistemaFormatoData'], "11")) . "<br/>";
						//echo "configTurmasAvisoDataFinalPeriodo=" . $configTurmasAvisoDataFinalPeriodo . "<br/>";
						//echo "configTurmasAvisoDataFinalTipoIntervalo=" . $configTurmasAvisoDataFinalTipoIntervalo . "<br/>";
					}
					//----------
					?>
				<?php } ?>
        	<?php } ?>
        </div>
        
        <?php
		//Limpeza de objetos.
		//----------
		unset($strSqlTurmasSelect);
		unset($statementTurmasSelect);
		unset($resultadoTurmas);
		unset($linhaTurmas);
		//----------
		?>
   
    <?php 
	} 
	?>
    <?php //**************************************************************************************?>
<?php 
$page->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php
//Limpeza de objetos.
//----------
unset($strSqlUsuariosDetalhesSelect);
unset($statementUsuariosDetalhesSelect);
unset($resultadoUsuariosDetalhes);
unset($linhaUsuariosDetalhes);
//----------
?>


<?php 
//Inclusão do template do layout.
include_once $page->LayoutSistema;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>