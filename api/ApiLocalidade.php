<?php
//Importação dos arquivos de configuração.
require_once "../sistema/IncludeConfig.php"; //Deve vir antes do db.
require_once "../sistema/IncludeConexao.php";
require_once "../sistema/IncludeFuncoes.php";


//Resgate de variáveis
$apiFormato = $_GET["apiFormato"]; //json | xml | html
$apiKey = $_GET["apiKey"];

//$cepConsulta = Funcoes::SomenteNum($_GET["cepConsulta"]);
//$strJason = "";
$strHTML = "";

//Variáveis de seleção de localidade.
$id_db_cep_tblUF = $_GET["id_db_cep_tblUF"];
$id_db_cep_tblCidades = $_GET["id_db_cep_tblCidades"];
$id_db_cep_tblBairros = $_GET["id_db_cep_tblBairros"];
//$id_db_cep_tblLogradouros = $_GET["id_db_cep_tblLogradouros"];

$tipoLocalizacao = $_GET["tipoLocalizacao"]; //3 - db_cep
$tipoRetorno = $_GET["tipoRetorno"]; //3 - options (dropdown)
if($tipoRetorno == "")
{
	$tipoRetorno = 3;
}


//db_cep.
//**************************************************************************************
if($tipoLocalizacao == 3)
{
	//Estados.
	if($id_db_cep_tblUF == "" && $id_db_cep_tblCidades == "" && $id_db_cep_tblBairros == "")
	{
		//Pesquisa.
		$resultadoCEPTblUF = CEP::Db_CEPFill_FetchAll("tblUF", "", "");
		
		
		//Loop pelos resultados.
		/**/
		if (empty($resultadoCEPTblUF))
		{
			//Nenhum resultado encontrado.
		}else{
			foreach($resultadoCEPTblUF as $linhaCEPTblUF)
			{
				//option
				if($tipoRetorno == 3)
				{
					$strHTML .= "<option value='" . Funcoes::ConteudoMascaraLeitura($linhaCEPTblUF["Codigo"]) . "'>" . Funcoes::ConteudoMascaraLeitura($linhaCEPTblUF["Codigo"]) . "</option>";
				}
				
				
				//Debug.
				//echo "Codigo=" . Funcoes::ConteudoMascaraLeitura($linhaCEPTblUF["Codigo"]) . "<br />";
			}
		}
	}
	
	
	//Cidades.
	if($id_db_cep_tblUF <> "")
	{
		//Pesquisa.
		$resultadoCEPTblCidades = CEP::Db_CEPFill_FetchAll("tblCidades", "UF", $id_db_cep_tblUF);
		
		//Loop pelos resultados.
		/**/
		if (empty($resultadoCEPTblCidades))
		{
			//Nenhum resultado encontrado.
		}else{
			foreach($resultadoCEPTblCidades as $linhaCEPTblCidades)
			{
				//option
				if($tipoRetorno == 3)
				{
					$strHTML .= "<option value='" . Funcoes::ConteudoMascaraLeitura($linhaCEPTblCidades["Codigo"]) . "'>" . Funcoes::ConteudoMascaraLeitura($linhaCEPTblCidades["Descricao"]) . "</option>";
				}
				
				
				//Debug.
				//echo "Codigo=" . Funcoes::ConteudoMascaraLeitura($linhaCEPTblUF["Codigo"]) . "<br />";
			}
		}
	}
	
	
	//Bairros.
	if($id_db_cep_tblCidades <> "")
	{
		//Pesquisa.
		$resultadoCEPTblBairros = CEP::Db_CEPFill_FetchAll("tblBairros", "CodigoCidade", $id_db_cep_tblCidades);
		
		//Loop pelos resultados.
		/**/
		if (empty($resultadoCEPTblBairros))
		{
			//Nenhum resultado encontrado.
		}else{
			foreach($resultadoCEPTblBairros as $linhaCEPTblBairros)
			{
				//option
				if($tipoRetorno == 3)
				{
					$strHTML .= "<option value='" . Funcoes::ConteudoMascaraLeitura($linhaCEPTblBairros["Codigo"]) . "'>" . Funcoes::ConteudoMascaraLeitura($linhaCEPTblBairros["Descricao"]) . "</option>";
				}
				
				
				//Debug.
				//echo "Codigo=" . Funcoes::ConteudoMascaraLeitura($linhaCEPTblUF["Codigo"]) . "<br />";
			}
		}
	}
	
	
	//Logradouros.
	if($id_db_cep_tblBairros <> "")
	{
		//Pesquisa.
		$resultadoCEPTblLogradouros = CEP::Db_CEPFill_FetchAll("tblLogradouros", "CodigoBairro", $id_db_cep_tblBairros);
		
		//Loop pelos resultados.
		/**/
		if (empty($resultadoCEPTblLogradouros))
		{
			//Nenhum resultado encontrado.
		}else{
			foreach($resultadoCEPTblLogradouros as $linhaCEPTblLogradouros)
			{
				//option
				if($tipoRetorno == 3)
				{
					$strHTML .= "<option value='" . Funcoes::ConteudoMascaraLeitura($linhaCEPTblLogradouros["Codigo"]) . "'>" . Funcoes::ConteudoMascaraLeitura($linhaCEPTblLogradouros['LOG_TIPO_LOGRADOURO']) . " " . Funcoes::ConteudoMascaraLeitura($linhaCEPTblLogradouros['DescricaoNaoAbreviada']) . "</option>";
				}
				
				
				//Debug.
				//echo "Codigo=" . Funcoes::ConteudoMascaraLeitura($linhaCEPTblUF["Codigo"]) . "<br />";
			}
		}
	}
	
	
}
//**************************************************************************************


//Exibição de dados.
echo $strHTML;


//Debug.
//ApiLocalidade.php?id_db_cep_tblUF=RJ&tipoLocalizacao=3&tipoRetorno=3

//echo "{\"post code\": \"90210\", \"country\": \"United States\", \"country abbreviation\": \"US\"}";
//echo json_encode("{\"post code\": \"90210\", \"country\": \"United States\", \"country abbreviation\": \"US\"}");
//echo "CEPFill=" . CEP::CEPFill($cepConsulta, "pais") . "<br />";
//echo "CEPFill=" . $arrStrJson["pais"] . "<br />";
//echo "id_db_cep_tblBairros=" . $id_db_cep_tblBairros . "<br />";

//[{"paisCodigo":"","uf":"S\u00e3o Paulo","ufCodigo":"SP","cidade":"S\u00e3o Paulo","cidadeCodigo":"9668","bairro":"Carandiru","bairroCodigo":"25270","logradouro":"Rua dos Camar\u00e9s","logradouroCodigo":"619633"}]
$dbSistemaConPDO = null;
?>