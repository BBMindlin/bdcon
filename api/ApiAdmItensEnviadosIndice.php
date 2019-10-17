<?php
//Importação dos arquivos de configuração.
require_once "../sistema/IncludeConfig.php"; //Deve vir antes do db.
require_once "../sistema/IncludeConexao.php";
require_once "../sistema/IncludeFuncoes.php";
//require_once "IncludeLayout.php";
//require_once "IncludeLayoutSite.php";


//Resgate de variáveis.
$apiFormato = $_GET["apiFormato"]; //json | xml

$idTbCadastro = $_GET["idTbCadastro"];
$apiKey = $_GET["apiKey"];

													
//Verificação de autenticação.
if(LoginAutenticacao::AutenticacaoAPI($idTbCadastro, $apiKey, 1) == true)
{
	
	//Itens enviados.
	$idsItensEnviadosCadastroSemAvaliacao = "";
	
	$arrIdsItensEnviadosCadastro = array();
	$idsItensEnviadosCadastro = DbFuncoes::GetCampoGenerico06("tb_itens_enviados", 
															"id_item", 
															"id_tb_cadastro_destinatario", 
															$idTbCadastro, 
															"", 
															"", 
															1, 
															"", 
															"", 
															"tipo_interatividade", 
															"1", 
															"", 
															"");
															
	//Loop pelo resultado para verificar qual recebeu o status desejado.
	if($idsItensEnviadosCadastro <> "")
	{
		$arrIdsItensEnviadosCadastro = 	explode(",", $idsItensEnviadosCadastro);
	}
	
	for($countArray = 0; $countArray < count($arrIdsItensEnviadosCadastro); $countArray++)
	{
		$idTbAulaItensEnviadosCadastro = $arrIdsItensEnviadosCadastro[$countArray];
		$arrIdTbAulaItensEnviadosCadastroLog = array();
		$idsTbAulaItensEnviadosCadastroLog = DbFuncoes::GetCampoGenerico06("tb_log", 
																			"id", 
																			"id_registro", 
																			$idTbAulaItensEnviadosCadastro, 
																			"", 
																			"", 
																			1, 
																			"", 
																			"", 
																			"log_tipo", 
																			"21", 
																			"id_tb_cadastro", 
																			$idTbCadastro);
		
		//Loop pelos ids do tb_log.
		if($idsTbAulaItensEnviadosCadastroLog <> "")
		{
			$arrIdTbAulaItensEnviadosCadastroLog = explode(",", $idsTbAulaItensEnviadosCadastroLog);
			
			for($countArrayLog = 0; $countArrayLog < count($arrIdTbAulaItensEnviadosCadastroLog); $countArrayLog++)
			{
				$flagIdTbAulaItensEnviadosCadastroLogSemAvaliacaoIncluir = false;
				$flagIdTbAulaItensEnviadosCadastroLogAvaliacao = DbFuncoes::GetCampoGenerico06("tb_log_relacao_complemento", 
																							"id_tb_log", 
																							"id_tb_log", 
																							$arrIdTbAulaItensEnviadosCadastroLog[$countArrayLog], 
																							"", 
																							"", 
																							1, 
																							"", 
																							"", 
																							"tipo_complemento", 
																							"21", 
																							"", 
																							"");
																			
				if($flagIdTbAulaItensEnviadosCadastroLogAvaliacao == "")
				{
					//Não foi avaliado.
					//echo "não foi avaliado" . "<br/>";
				}else{
					//Foi avaliado.
					//echo "foi avaliado" . "<br/>";
					$flagIdTbAulaItensEnviadosCadastroLogSemAvaliacaoIncluir = true;
				}
				
				//Verificação de erro - debug.
				//echo "arrIdTbAulaItensEnviadosCadastroLog[]=" .  $arrIdTbAulaItensEnviadosCadastroLog[$countArrayLog] . "<br/>";
				/*
				echo "GetCampoGenerico06=" .  DbFuncoes::GetCampoGenerico06("tb_log_relacao_complemento", 
																			"id_tb_log", 
																			"id_tb_log", 
																			$arrIdTbAulaItensEnviadosCadastroLog[$countArrayLog], 
																			"", 
																			"", 
																			1, 
																			"", 
																			"", 
																			"tipo_complemento", 
																			"21", 
																			"", 
																			"") . "<br/>";
				*/
			}	
			
			//verificação de que o id foi achado.
			if($flagIdTbAulaItensEnviadosCadastroLogSemAvaliacaoIncluir == false)
			{
				$idsItensEnviadosCadastroSemAvaliacao .= $idTbAulaItensEnviadosCadastro . ",";
			}
																			
 																
		}
		
		//Verificação de erro - debug.
		//echo "arrIdsItensEnviadosCadastro=" .  $arrIdsItensEnviadosCadastro[$countArray] . "<br/>";
		//echo "GetCampoGenerico01=" . DbFuncoes::GetCampoGenerico01($arrIdsItensEnviadosCadastro[$countArray], "tb_log", "id_registro") . "<br/>";
		
		//echo "idTbAulaItensEnviadosCadastro=" .  $idTbAulaItensEnviadosCadastro . "<br/>";
		//echo "idsTbAulaItensEnviadosCadastroLog=" .  $idsTbAulaItensEnviadosCadastroLog . "<br/>";

	}													
	
	/*
	$idsLog21Cadastro = DbFuncoes::GetCampoGenerico06("tb_log", 
													"id", 
													"id_tb_cadastro", 
													$idTbCadastro, 
													"", 
													"", 
													1, 
													"", 
													"", 
													"log_tipo", 
													"21", 
													"", 
													"");
	*/
													
	
	//Tratamento da variável para retirar a última vírgula.
	if($idsItensEnviadosCadastroSemAvaliacao <> "")
	{
		$idsItensEnviadosCadastroSemAvaliacao = Funcoes::IdsFormatar01($idsItensEnviadosCadastroSemAvaliacao);
	}	
													
	//echo "idsItensEnviadosCadastro=" . $idsItensEnviadosCadastro . "<br/>";
	//echo "idsLog21CadastroAula=" . $idsLog21Cadastro . "<br/>";
	echo "idsItensEnviadosCadastroSemAvaliacao=" . $idsItensEnviadosCadastroSemAvaliacao . "<br/>";



	//JSon.
	//----------
	if($apiFormato == "json")
	{
		
		/*
		echo "JSonConverterDados01=" . JSonConverterDados01("tb_aulas", 
															array("id", "id_parent"), 
															"", 
															"", 
															1,
															"", 
															"", 
															"", 
															"", 
															"", 
															"", 
															"", 
															"", 
															null) . "<br/>";
		//Funcionando.													
		echo "JSonConverterDados01=" . json_encode(JSonConverterDados01("tb_aulas", 
															array("id", "id_parent"), 
															"", 
															"", 
															1,
															"", 
															"", 
															"", 
															"", 
															"", 
															"", 
															"", 
															"", 
															null)) . "<br/>";
		*/
		
		//Impressão de itens enviados.
		echo json_encode(JsonFuncoes::JSonConverterDados01("tb_itens_enviados", 
															array("id", "id_tb_cadastro_remetente", "id_tb_cadastro_destinatario", "id_item", "tipo_categoria", "tipo_interatividade", "tabela"), 
															"", 
															"", 
															1,
															"", 
															"", 
															"id_tb_cadastro_destinatario", 
															$idTbCadastro, 
															"", 
															"", 
															"", 
															"", 
															null));
															
		//Impressão de aulas.
		/*
		if($idsItensEnviadosCadastroSemAvaliacao <> "")
		{
			echo json_encode(JsonFuncoes::JSonConverterDados01("tb_aulas", 
																array("id", 
																	"id_parent", 
																	"id_tb_cadastro_usuario", 
																	"id_tb_cadastro1", 
																	"n_classificacao", 
																	"data_criacao", 
																	"data_aula", 
																	"tema", 
																	"descricao", 
																	"ativacao", 
																	"reposicao"), 
																"", 
																"", 
																1,
																"id", 
																$idsItensEnviadosCadastroSemAvaliacao, 
																"", 
																"", 
																"", 
																"", 
																"", 
																"", 
																null));
		}
		*/
															
	}


}else{
	//key erro - retorno vazio.	
}


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>