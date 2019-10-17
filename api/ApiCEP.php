<?php
//Importação dos arquivos de configuração.
require_once "../sistema/IncludeConfig.php"; //Deve vir antes do db.
require_once "../sistema/IncludeConexao.php";
require_once "../sistema/IncludeFuncoes.php";


//Resgate de variáveis.
$apiFormato = $_GET["apiFormato"]; //json | xml
$apiKey = $_GET["apiKey"];

$cepConsulta = Funcoes::SomenteNum($_GET["cepConsulta"]);
$strJason = "";

if(strlen($cepConsulta) == 8)
{
	/*
	$strJason .= "{";
	$strJason .= "\"pais\": ";
	$strJason .= "\"" . CEP::CEPFill($cepConsulta, "pais") . "\", ";
	$strJason .= "\"paisCodigo\": ";
	$strJason .= "\"" . CEP::CEPFill($cepConsulta, "paisCodigo") . "\", ";
	$strJason .= "\"uf\": ";
	$strJason .= "'" . CEP::CEPFill($cepConsulta, "uf") . "\", ";
	$strJason .= "\"ufCodigo\": ";
	$strJason .= "\"" . CEP::CEPFill($cepConsulta, "ufCodigo") . "\", ";
	$strJason .= "\"cidade\": ";
	$strJason .= "\"" . CEP::CEPFill($cepConsulta, "cidade") . "\", ";
	$strJason .= "\"cidadeCodigo\": ";
	$strJason .= "\"" . CEP::CEPFill($cepConsulta, "cidadeCodigo") . "\", ";
	$strJason .= "\"bairro\": ";
	$strJason .= "\"" . CEP::CEPFill($cepConsulta, "bairro") . "\", ";
	$strJason .= "\"bairroCodigo\": ";
	$strJason .= "\"" . CEP::CEPFill($cepConsulta, "bairroCodigo") . "\", ";
	$strJason .= "\"pais\": ";
	$strJason .= "\"" . CEP::CEPFill($cepConsulta, "pais") . "\", ";
	$strJason .= "\"logradouro\": ";
	$strJason .= "\"" . CEP::CEPFill($cepConsulta, "logradouro") . "\", ";
	$strJason .= "\"logradouroCodigo\": ";
	$strJason .= "\"" . CEP::CEPFill($cepConsulta, "logradouroCodigo") . "\"";
	$strJason .= "}";
	*/
	
	//'pais' => CEP::CEPFill($cepConsulta, "pais"),
	/**/
	//		(object)array()
	//$strPais = CEP::CEPFill($cepConsulta, "pais");
	///*
	$arrStrJson = array(
		"pais" => CEP::CEPFill($cepConsulta, "pais"),
		"paisCodigo" => CEP::CEPFill($cepConsulta, "paisCodigo"),
		"uf" => CEP::CEPFill($cepConsulta, "uf"),
		"ufCodigo" => CEP::CEPFill($cepConsulta, "ufCodigo"),
		"cidade" => CEP::CEPFill($cepConsulta, "cidade"),
		"cidadeCodigo" => CEP::CEPFill($cepConsulta, "cidadeCodigo"),
		"bairro" => CEP::CEPFill($cepConsulta, "bairro"),
		"bairroCodigo" => CEP::CEPFill($cepConsulta, "bairroCodigo"),
		"logradouro" => CEP::CEPFill($cepConsulta, "logradouro"),
		"logradouroCodigo" => CEP::CEPFill($cepConsulta, "logradouroCodigo"),
	);
	//*/
	//$arrStrJson = array();
	//var_dump($arrStrJson);
	
	
	//Debug.
	/*
	echo "CEP::CEPFill (logradouro)=" . CEP::CEPFill($cepConsulta, "logradouro") . "<br />";
	echo "CEP::CEPFill (logradouroCodigo)=" . CEP::CEPFill($cepConsulta, "logradouroCodigo") . "<br />";
	echo "CEP::CEPFill (bairro)=" . CEP::CEPFill($cepConsulta, "bairro") . "<br />";
	echo "CEP::CEPFill (bairroCodigo)=" . CEP::CEPFill($cepConsulta, "bairroCodigo") . "<br />";
	echo "CEP::CEPFill (cidade)=" . CEP::CEPFill($cepConsulta, "cidade") . "<br />";
	echo "CEP::CEPFill (cidadeCodigo)=" . CEP::CEPFill($cepConsulta, "cidadeCodigo") . "<br />";
	echo "CEP::CEPFill (uf)=" . CEP::CEPFill($cepConsulta, "uf") . "<br />";
	echo "CEP::CEPFill (ufCodigo)=" . CEP::CEPFill($cepConsulta, "ufCodigo") . "<br />";
	echo "CEP::CEPFill (pais)=" . CEP::CEPFill($cepConsulta, "pais") . "<br />";
	*/
}

//echo json_encode($strJason);
echo json_encode($arrStrJson);



//Debug
//echo "{\"post code\": \"90210\", \"country\": \"United States\", \"country abbreviation\": \"US\"}";
//echo json_encode("{\"post code\": \"90210\", \"country\": \"United States\", \"country abbreviation\": \"US\"}");
//echo "CEPFill=" . CEP::CEPFill($cepConsulta, "pais") . "<br />";
//echo "CEPFill=" . $arrStrJson["pais"] . "<br />";

//[{"paisCodigo":"","uf":"S\u00e3o Paulo","ufCodigo":"SP","cidade":"S\u00e3o Paulo","cidadeCodigo":"9668","bairro":"Carandiru","bairroCodigo":"25270","logradouro":"Rua dos Camar\u00e9s","logradouroCodigo":"619633"}]
$dbSistemaConPDO = null;
?>
