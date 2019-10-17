<?php
//Importação dos arquivos de configuração.
require_once "../sistema/IncludeConfig.php"; //Deve vir antes do db.
require_once "../sistema/IncludeConexao.php";
require_once "../sistema/IncludeFuncoes.php";


//Resgate de variáveis.
$apiFormato = $_GET["apiFormato"]; //json | xml | html
$apiKey = $_GET["apiKey"];

//$cepConsulta = Funcoes::SomenteNum($_GET["cepConsulta"]);
//$strJason = "";
$strHTML = "";

$strTabela = $_GET["strTabela"];
$tipoComplemento = $_GET["tipoComplemento"];
$idItem = $_GET["idItem"];

$tipoRetorno = $_GET["tipoRetorno"]; //3 - options (dropdown)
if($tipoRetorno == "")
{
	$tipoRetorno = 3;
}


//Seleção de ids selecionados para o registro.
if($strTabela == "tb_produtos_complemento")
{
	$arrItemFiltroGenericoSelecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($idItem, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", $tipoComplemento, "", ",", "", "1"));
}
if($strTabela == "tb_historico_complemento")
{
	$arrItemFiltroGenericoSelecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($idItem, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", $tipoComplemento, "", ",", "", "1"));
}


//option
//**************************************************************************************
if($tipoRetorno == 2 || $tipoRetorno == 3)
{
	$resultadoManutencao = DbFuncoes::TabelaGenericaFill01_FetchAll($strTabela, 
																	array("tipo_complemento;" . $tipoComplemento . ";i"), 
																	"complemento", 
																	"");
	
	
	//Loop pelos resultados.
	/**/
	if (empty($resultadoManutencao))
	{
		//Nenhum resultado encontrado.
	}else{
		foreach($resultadoManutencao as $linhaManutencao)
		{
			$strHTML .= "<option value='" . $linhaManutencao["id"] . "'"; 
			if(in_array($linhaManutencao["id"], $arrItemFiltroGenericoSelecao))
			{ 
				//if($tipoRetorno == 2)
				//{
					$strHTML .= " selected='selected'"; 
				//}
			}
			$strHTML .= ">" . Funcoes::ConteudoMascaraLeitura($linhaManutencao['complemento']) . "</option>";
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
//echo "strTabela=" . $strTabela . "<br />";
//echo "idItem=" . $idItem . "<br />";
//echo "arrItemFiltroGenericoSelecao=";
//echo print_r($arrItemFiltroGenericoSelecao) . "<br />";
//echo "<br />";

//[{"paisCodigo":"","uf":"S\u00e3o Paulo","ufCodigo":"SP","cidade":"S\u00e3o Paulo","cidadeCodigo":"9668","bairro":"Carandiru","bairroCodigo":"25270","logradouro":"Rua dos Camar\u00e9s","logradouroCodigo":"619633"}]
$dbSistemaConPDO = null;
?>