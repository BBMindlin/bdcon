<?php
//Definição de variáveis.
$IdTbHistorico = $includeHistoricoDetalhes_idTbHistorico;
$ConfigTipoDiagramacao = $includeHistoricoDetalhes_configTipoDiagramacao; //1 - Resumido | 2 - ADM | 3 - tabela ADM | 4 -Avaliações + Resumo

$resultadoHistoricoComplemento = DbFuncoes::TabelaGenericaFill01_FetchAll("tb_historico_complemento", 
								NULL, 
								"complemento", 
								"");
$resultadoHistoricoComplementoRelacao = DbFuncoes::FiltrosGenericosSelect02_FetchAll("tb_historico_relacao_complemento", 
																					$IdTbHistorico, 
																					"id_tb_historico");


//Query de pesquisa.
//----------
$strSqlHistoricoDetalhesSelect = "";
$strSqlHistoricoDetalhesSelect .= "SELECT ";
//$strSqlHistoricoDetalhesSelect .= "* ";
$strSqlHistoricoDetalhesSelect .= "id, ";
$strSqlHistoricoDetalhesSelect .= "id_parent, ";
$strSqlHistoricoDetalhesSelect .= "id_tb_cadastro_usuario, ";
$strSqlHistoricoDetalhesSelect .= "data_historico, ";
$strSqlHistoricoDetalhesSelect .= "data1, ";
$strSqlHistoricoDetalhesSelect .= "data2, ";
$strSqlHistoricoDetalhesSelect .= "data3, ";
$strSqlHistoricoDetalhesSelect .= "data4, ";
$strSqlHistoricoDetalhesSelect .= "data5, ";
$strSqlHistoricoDetalhesSelect .= "assunto, ";
$strSqlHistoricoDetalhesSelect .= "historico, ";
$strSqlHistoricoDetalhesSelect .= "id_tb_cadastro1, ";
$strSqlHistoricoDetalhesSelect .= "id_tb_cadastro2, ";
$strSqlHistoricoDetalhesSelect .= "id_tb_cadastro3, ";
$strSqlHistoricoDetalhesSelect .= "id_tb_cadastro4, ";
$strSqlHistoricoDetalhesSelect .= "id_tb_cadastro5, ";
$strSqlHistoricoDetalhesSelect .= "id_tb_cadastro6, ";
$strSqlHistoricoDetalhesSelect .= "id_tb_cadastro7, ";
$strSqlHistoricoDetalhesSelect .= "id_tb_cadastro8, ";
$strSqlHistoricoDetalhesSelect .= "id_tb_cadastro9, ";
$strSqlHistoricoDetalhesSelect .= "id_tb_cadastro10, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar1, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar2, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar3, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar4, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar5, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar6, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar7, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar8, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar9, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar10, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar11, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar12, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar13, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar14, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar15, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar16, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar17, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar18, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar19, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar20, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar21, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar22, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar23, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar24, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar25, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar26, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar27, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar28, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar29, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar30, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar31, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar32, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar33, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar34, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar35, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar36, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar37, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar38, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar39, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar40, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar41, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar42, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar43, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar44, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar45, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar46, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar47, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar48, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar49, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar50, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar51, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar52, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar53, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar54, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar55, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar56, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar57, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar58, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar59, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar60, ";
$strSqlHistoricoDetalhesSelect .= "id_tb_historico_status ";
$strSqlHistoricoDetalhesSelect .= "FROM tb_historico ";
$strSqlHistoricoDetalhesSelect .= "WHERE id <> 0 ";
//$strSqlHistoricoDetalhesSelect .= "AND id_tb_categorias = :id_tb_categorias ";
$strSqlHistoricoDetalhesSelect .= "AND id = :id ";
//$strSqlHistoricoDetalhesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
//----------


//Parâmetros.
//----------
$statementHistoricoDetalhesSelect = $dbSistemaConPDO->prepare($strSqlHistoricoDetalhesSelect);

if($statementHistoricoDetalhesSelect !== false)
{
	$statementHistoricoDetalhesSelect->execute(array(
		"id" => $IdTbHistorico
	));
}
//----------


//Dados.
//----------
//$resultadoHistoricoDetalhes = $dbSistemaConPDO->query($strSqlHistoricoDetalhesSelect);
$resultadoHistoricoDetalhes = $statementHistoricoDetalhesSelect->fetchAll();

if(empty($resultadoHistoricoDetalhes))
{
	//echo "Nenhum registro encontrado";
}else{
	foreach($resultadoHistoricoDetalhes as $linhaHistoricoDetalhes)
	{
		//Definição das variáveis de detalhes.
		$tbHistoricoId = $linhaHistoricoDetalhes['id'];
		$tbHistoricoIdParent = $linhaHistoricoDetalhes['id_parent'];
		
		$tbHistoricoIdTbCadastroUsuario = $linhaHistoricoDetalhes['id_tb_cadastro_usuario'];
		$tbHistoricoIdTbCadastroUsuario_print = Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($tbHistoricoIdTbCadastroUsuario, "tb_cadastro", "nome"), 
																			DbFuncoes::GetCampoGenerico01($tbHistoricoIdTbCadastroUsuario, "tb_cadastro", "razao_social"), 
																			DbFuncoes::GetCampoGenerico01($tbHistoricoIdTbCadastro3, "tb_cadastro", "nome_fantasia"), 
																			1);
		$tbHistoricoDataHistorico = Funcoes::DataLeitura01($linhaHistoricoDetalhes['data_historico'], $GLOBALS['configSiteFormatoData'], "1");
		if($linhaHistoricoDetalhes['data1'] == NULL)
		{
			$tbHistoricoData1 = "";
		}else{
			$tbHistoricoData1 = Funcoes::DataLeitura01($linhaHistoricoDetalhes['data1'], $GLOBALS['configSiteFormatoData'], "1");
		}
		if($linhaHistoricoDetalhes['data2'] == NULL)
		{
			$tbHistoricoData2 = "";
		}else{
			$tbHistoricoData2 = Funcoes::DataLeitura01($linhaHistoricoDetalhes['data2'], $GLOBALS['configSiteFormatoData'], "1");
		}
		if($linhaHistoricoDetalhes['data3'] == NULL)
		{
			$tbHistoricoData3 = "";
		}else{
			$tbHistoricoData3 = Funcoes::DataLeitura01($linhaHistoricoDetalhes['data3'], $GLOBALS['configSiteFormatoData'], "1");
		}
		if($linhaHistoricoDetalhes['data4'] == NULL)
		{
			$tbHistoricoData4 = "";
		}else{
			$tbHistoricoData4 = Funcoes::DataLeitura01($linhaHistoricoDetalhes['data4'], $GLOBALS['configSiteFormatoData'], "1");
		}
		if($linhaHistoricoDetalhes['data5'] == NULL)
		{
			$tbHistoricoData5 = "";
		}else{
			$tbHistoricoData5 = Funcoes::DataLeitura01($linhaHistoricoDetalhes['data5'], $GLOBALS['configSiteFormatoData'], "1");
		}
		
		$tbHistoricoAssunto = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['assunto']);
		$tbHistoricoHistorico = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['historico']);

		$tbHistoricoIdTbCadastro1 = $linhaHistoricoDetalhes['id_tb_cadastro1'];
		$tbHistoricoIdTbCadastro1_print = Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($tbHistoricoIdTbCadastro1, "tb_cadastro", "nome"), 
																	DbFuncoes::GetCampoGenerico01($tbHistoricoIdTbCadastro1, "tb_cadastro", "razao_social"), 
																	DbFuncoes::GetCampoGenerico01($tbHistoricoIdTbCadastro1, "tb_cadastro", "nome_fantasia"), 
																	1);
		$tbHistoricoIdTbCadastro2 = $linhaHistoricoDetalhes['id_tb_cadastro2'];
		$tbHistoricoIdTbCadastro2_print = Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($tbHistoricoIdTbCadastro2, "tb_cadastro", "nome"), 
																	DbFuncoes::GetCampoGenerico01($tbHistoricoIdTbCadastro2, "tb_cadastro", "razao_social"), 
																	DbFuncoes::GetCampoGenerico01($tbHistoricoIdTbCadastro2, "tb_cadastro", "nome_fantasia"), 
																	1);
		$tbHistoricoIdTbCadastro3 = $linhaHistoricoDetalhes['id_tb_cadastro3'];
		$tbHistoricoIdTbCadastro3_print = Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($tbHistoricoIdTbCadastro3, "tb_cadastro", "nome"), 
																	DbFuncoes::GetCampoGenerico01($tbHistoricoIdTbCadastro3, "tb_cadastro", "razao_social"), 
																	DbFuncoes::GetCampoGenerico01($tbHistoricoIdTbCadastro3, "tb_cadastro", "nome_fantasia"), 
																	1);
		$tbHistoricoIdTbCadastro4 = $linhaHistoricoDetalhes['id_tb_cadastro4'];
		$tbHistoricoIdTbCadastro4_print = Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($tbHistoricoIdTbCadastro4, "tb_cadastro", "nome"), 
																	DbFuncoes::GetCampoGenerico01($tbHistoricoIdTbCadastro4, "tb_cadastro", "razao_social"), 
																	DbFuncoes::GetCampoGenerico01($tbHistoricoIdTbCadastro4, "tb_cadastro", "nome_fantasia"), 
																	1);
		$tbHistoricoIdTbCadastro5 = $linhaHistoricoDetalhes['id_tb_cadastro5'];
		$tbHistoricoIdTbCadastro5_print = Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($tbHistoricoIdTbCadastro5, "tb_cadastro", "nome"), 
																	DbFuncoes::GetCampoGenerico01($tbHistoricoIdTbCadastro5, "tb_cadastro", "razao_social"), 
																	DbFuncoes::GetCampoGenerico01($tbHistoricoIdTbCadastro5, "tb_cadastro", "nome_fantasia"), 
																	1);
		$tbHistoricoIdTbCadastro6 = $linhaHistoricoDetalhes['id_tb_cadastro6'];
		$tbHistoricoIdTbCadastro6_print = Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($tbHistoricoIdTbCadastro6, "tb_cadastro", "nome"), 
																	DbFuncoes::GetCampoGenerico01($tbHistoricoIdTbCadastro6, "tb_cadastro", "razao_social"), 
																	DbFuncoes::GetCampoGenerico01($tbHistoricoIdTbCadastro6, "tb_cadastro", "nome_fantasia"), 
																	1);
		$tbHistoricoIdTbCadastro7 = $linhaHistoricoDetalhes['id_tb_cadastro7'];
		$tbHistoricoIdTbCadastro7_print = Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($tbHistoricoIdTbCadastro7, "tb_cadastro", "nome"), 
																	DbFuncoes::GetCampoGenerico01($tbHistoricoIdTbCadastro7, "tb_cadastro", "razao_social"), 
																	DbFuncoes::GetCampoGenerico01($tbHistoricoIdTbCadastro7, "tb_cadastro", "nome_fantasia"), 
																	1);
		$tbHistoricoIdTbCadastro8 = $linhaHistoricoDetalhes['id_tb_cadastro8'];
		$tbHistoricoIdTbCadastro8_print = Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($tbHistoricoIdTbCadastro8, "tb_cadastro", "nome"), 
																	DbFuncoes::GetCampoGenerico01($tbHistoricoIdTbCadastro8, "tb_cadastro", "razao_social"), 
																	DbFuncoes::GetCampoGenerico01($tbHistoricoIdTbCadastro8, "tb_cadastro", "nome_fantasia"), 
																	1);
		$tbHistoricoIdTbCadastro9 = $linhaHistoricoDetalhes['id_tb_cadastro9'];
		$tbHistoricoIdTbCadastro9_print = Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($tbHistoricoIdTbCadastro9, "tb_cadastro", "nome"), 
																	DbFuncoes::GetCampoGenerico01($tbHistoricoIdTbCadastro9, "tb_cadastro", "razao_social"), 
																	DbFuncoes::GetCampoGenerico01($tbHistoricoIdTbCadastro9, "tb_cadastro", "nome_fantasia"), 
																	1);
		$tbHistoricoIdTbCadastro10 = $linhaHistoricoDetalhes['id_tb_cadastro10'];
		$tbHistoricoIdTbCadastro10_print = Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($tbHistoricoIdTbCadastro10, "tb_cadastro", "nome"), 
																	DbFuncoes::GetCampoGenerico01($tbHistoricoIdTbCadastro10, "tb_cadastro", "razao_social"), 
																	DbFuncoes::GetCampoGenerico01($tbHistoricoIdTbCadastro10, "tb_cadastro", "nome_fantasia"), 
																	1);

		$tbHistoricoIC1 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar1']);
		$tbHistoricoIC2 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar2']);
		$tbHistoricoIC3 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar3']);
		$tbHistoricoIC4 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar4']);
		$tbHistoricoIC5 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar5']);
		$tbHistoricoIC6 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar6']);
		$tbHistoricoIC7 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar7']);
		$tbHistoricoIC8 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar8']);
		$tbHistoricoIC9 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar9']);
		$tbHistoricoIC10 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar10']);
		$tbHistoricoIC10 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar10']);
		$tbHistoricoIC11 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar11']);
		$tbHistoricoIC12 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar12']);
		$tbHistoricoIC13 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar13']);
		$tbHistoricoIC14 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar14']);
		$tbHistoricoIC15 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar15']);
		$tbHistoricoIC16 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar16']);
		$tbHistoricoIC17 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar17']);
		$tbHistoricoIC18 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar18']);
		$tbHistoricoIC19 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar19']);
		$tbHistoricoIC20 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar20']);
		$tbHistoricoIC21 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar21']);
		$tbHistoricoIC22 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar22']);
		$tbHistoricoIC23 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar23']);
		$tbHistoricoIC24 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar24']);
		$tbHistoricoIC25 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar25']);
		$tbHistoricoIC26 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar26']);
		$tbHistoricoIC27 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar27']);
		$tbHistoricoIC28 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar28']);
		$tbHistoricoIC29 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar29']);
		$tbHistoricoIC30 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar30']);
		$tbHistoricoIC31 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar31']);
		$tbHistoricoIC32 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar32']);
		$tbHistoricoIC33 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar33']);
		$tbHistoricoIC34 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar34']);
		$tbHistoricoIC35 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar35']);
		$tbHistoricoIC36 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar36']);
		$tbHistoricoIC37 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar37']);
		$tbHistoricoIC38 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar38']);
		$tbHistoricoIC39 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar39']);
		$tbHistoricoIC40 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar40']);
		$tbHistoricoIC41 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar41']);
		$tbHistoricoIC42 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar42']);
		$tbHistoricoIC43 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar43']);
		$tbHistoricoIC44 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar44']);
		$tbHistoricoIC45 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar45']);
		$tbHistoricoIC46 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar46']);
		$tbHistoricoIC47 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar47']);
		$tbHistoricoIC48 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar48']);
		$tbHistoricoIC49 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar49']);
		$tbHistoricoIC50 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar50']);
		$tbHistoricoIC51 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar51']);
		$tbHistoricoIC52 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar52']);
		$tbHistoricoIC53 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar53']);
		$tbHistoricoIC54 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar54']);
		$tbHistoricoIC55 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar55']);
		$tbHistoricoIC56 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar56']);
		$tbHistoricoIC57 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar57']);
		$tbHistoricoIC58 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar58']);
		$tbHistoricoIC59 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar59']);
		$tbHistoricoIC60 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar60']);

		$tbHistoricoIdTbHistoricoStatus = $linhaHistoricoDetalhes['id_tb_historico_status'];
		$tbHistoricoIdTbHistoricoStatus_print = Funcoes::ConteudoMascaraLeitura(DbFuncoes::GetCampoGenerico01($tbHistoricoIdTbHistoricoStatus, "tb_cadastro_complemento", "complemento"));

		
		//Verificação de erro.
		//echo "tbHistoricoId=" . $tbHistoricoId . "<br>";
		//echo "tbHistoricoAssunto=" . $tbHistoricoAssunto . "<br>";
		//echo "tbPaginasAtivacao=" . $tbPaginasAtivacao . "<br>";
	}
}
//----------



$idTipoProduto = DbFuncoes::FiltrosGenericosSelect03($tbHistoricoIdParent, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", "2", "", ",", "", "1");

//Verificação de erro.
//echo "IdTbHistorico=" . $IdTbHistorico . "<br>";
//echo "ConfigTipoDiagramacao=" . $ConfigTipoDiagramacao . "<br>";
?>


<?php if(!empty($resultadoHistoricoDetalhes)){?>
	<?php //Diagramação 3 (Tabela ADM).?>
    <?php //**************************************************************************************?>
    <?php if($ConfigTipoDiagramacao == "3"){ ?>
    <div align="center" class="AdmTexto01" style="position: relative; display: block; overflow: hidden;">
        <!--Livro.-->
        <?php if($idTipoProduto == "3486"){ ?>
            <?php include "SiteHistoricoDetalhesInclude3486.php"; ?>
        <?php } ?>
        <!--Livro.-->
        
        
        <!--Diplomas.-->
        <?php if($idTipoProduto == "3483"){ ?>
            <?php include "SiteHistoricoDetalhesInclude3483.php"; ?>
        <?php } ?>
        <!--Diplomas.-->
        
        
        <!--Documentos.-->
        <?php if($idTipoProduto == "3484"){ ?>
            <?php include "SiteHistoricoDetalhesInclude3484.php"; ?>
        <?php } ?>
        <!--Documentos.-->
        
        
        <!--Fotografia.-->
        <?php if($idTipoProduto == "3485"){ ?>
            <?php include "SiteHistoricoDetalhesInclude3485.php"; ?>
        <?php } ?>
        <!--Fotografia.-->
        
        
        <!--Mapa.-->
        <?php if($idTipoProduto == "3487"){ ?>
            <?php include "SiteHistoricoDetalhesInclude3487.php"; ?>
        <?php } ?>
        <!--Mapa.-->
        
        
        <!--Obras de Arte.-->
        <?php if($idTipoProduto == "3488"){ ?>
            <?php include "SiteHistoricoDetalhesInclude3488.php"; ?>
        <?php } ?>
        <!--Obras de Arte.-->
    
    </div>
    <?php } ?>
    <?php //**************************************************************************************?>
<?php } ?>


<?php
//Limpeza de objetos.
//----------
unset($strSqlHistoricoDetalhesSelect);
unset($statementHistoricoDetalhesSelect);
unset($resultadoHistoricoDetalhes);
unset($linhaHistoricoDetalhes);
//----------
?>