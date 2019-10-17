<?php
//Importação dos arquivos de configuração.
require_once "../sistema/IncludeConfig.php"; //Deve vir antes do db.
require_once "../sistema/IncludeConexao.php";
require_once "../sistema/IncludeFuncoes.php";


//Resgate de variáveis
$apiKey = $_GET["apiKey"];

$placaConsulta = Funcoes::RemoverCaracteresEspeciais($_GET["placaConsulta"]);

$tbVeiculosID = "";
$strRetorno = "0"; //0 - não exitente | 1 - existente


//Verificação de placa existente.
//----------
if($placaConsulta <> "")
{
	$tbVeiculosID = DbFuncoes::GetCampoGenerico06("tb_veiculos", 
												"id", 
												"placa", 
												$placaConsulta, 
												"", 
												"", 
												2, 
												"", 
												"", 
												"", 
												"", 
												"", 
												"");
	if($tbVeiculosID <> "")
	{
		$strRetorno = "1";
	}											
}
//----------


//echo json_encode($strJason);
//echo json_encode($arrStrJson);
echo $strRetorno;


//Debug
//echo "{\"post code\": \"90210\", \"country\": \"United States\", \"country abbreviation\": \"US\"}";
//echo json_encode("{\"post code\": \"90210\", \"country\": \"United States\", \"country abbreviation\": \"US\"}");
//echo "CEPFill=" . CEP::CEPFill($cepConsulta, "pais") . "<br />";
//echo "CEPFill=" . $arrStrJson["pais"] . "<br />";
//echo "placaConsulta=" . $placaConsulta . "<br />";

//[{"paisCodigo":"","uf":"S\u00e3o Paulo","ufCodigo":"SP","cidade":"S\u00e3o Paulo","cidadeCodigo":"9668","bairro":"Carandiru","bairroCodigo":"25270","logradouro":"Rua dos Camar\u00e9s","logradouroCodigo":"619633"}]
$dbSistemaConPDO = null;
?>