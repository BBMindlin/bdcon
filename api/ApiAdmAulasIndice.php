<?php
//Importação dos arquivos de configuração.
require_once "../sistema/IncludeConfig.php"; //Deve vir antes do db.
require_once "../sistema/IncludeConexao.php";
require_once "../sistema/IncludeFuncoes.php";
//require_once "IncludeLayout.php";
//require_once "IncludeLayoutSite.php";

/*
class AdmAulasIndice{
	public $	
}
*/

//URL - exemplo.
//api/ApiAdmAulasIndice.php?apiFormato=json&idTbCadastro=4172&apiKey=1Ph7PBFpcZkOQSn%2B6%2FDIAuyFAF%2FHuz5bk2v%2FjKbQamI8MrgfJng2mPHMkd%2BGNAA7oG6DjWcm7OaHgUgZqh9BqBTypaM4fB1YPJSKCTkQPi61Mv1Rb7UTSLVo4uhAkqv9%7Ckhxr3fgGWUiwWwABG0dVRgptObVk1TrYf0FlX55C8Es%3D


//Resgate de variáveis.
$apiFormato = $_GET["apiFormato"]; //json | xml

$idTbCadastro = $_GET["idTbCadastro"];
$apiKey = $_GET["apiKey"];


//Turmas relacionadas ao cadastro.
$idsTbTurmasRelacaoCadastro = DbFuncoes::GetCampoGenerico06("tb_itens_relacao_registros", 
															"id_item", 
															"id_registro", 
															$idTbCadastro, 
															"", 
															"", 
															1, 
															"", 
															"", 
															"tipo_categoria", 
															"13", 
															"", 
															"");
//Módulos vinculados às turmas.
$idsTbModulosVinculoIdsTbTurmas = DbFuncoes::GetCampoGenerico07("tb_modulos", 
															"id", 
															"ativacao", 
															"1", 
															"", 
															"", 
															1, 
															"", 
															"", 
															"", 
															"", 
															"", 
															"",
															"id_parent",
															$idsTbTurmasRelacaoCadastro);

//Aulas vinculadas aos módulos.															
$idsTbAulasVinculoIdsModulos = DbFuncoes::GetCampoGenerico07("tb_aulas", 
															"id", 
															"ativacao", 
															"1", 
															"", 
															"", 
															1, 
															"", 
															"", 
															"", 
															"", 
															"", 
															"",
															"id_parent",
															$idsTbModulosVinculoIdsTbTurmas);


//Verificação de autenticação.
if(LoginAutenticacao::AutenticacaoAPI($idTbCadastro, $apiKey, 1) == true)
{

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
		
		
		echo json_encode(JsonFuncoes::JSonConverterDados01("tb_aulas", 
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
															null));
															
	}


}else{
	//key erro - retorno vazio.	
}
//----------


//Verificação de erro - debug.
//echo "apiFormato=" . $apiFormato . "<br/>";
//echo "idTbCadastro=" . $idTbCadastro . "<br/>";
//echo "apiKey=" . $apiKey . "<br/>";
//echo "GetCampoGenerico01=" . DbFuncoes::GetCampoGenerico01("4172", "tb_cadastro", "senha") . "<br/>";
//echo "false=" . false . "<br/>";
//echo "AutenticacaoAPI=" . LoginAutenticacao::AutenticacaoAPI("4172", "1Ph7PBFpcZkOQSn+6/DIAuyFAF/Huz5bk2v/jKbQamI8MrgfJng2mPHMkd+GNAA7oG6DjWcm7OaHgUgZqh9BqBTypaM4fB1YPJSKCTkQPi61Mv1Rb7UTSLVo4uhAkqv9|khxr3fgGWUiwWwABG0dVRgptObVk1TrYf0FlX55C8Es=", 1) . "<br/>";
//echo "AutenticacaoAPI=" . LoginAutenticacao::AutenticacaoAPI("4172", "1Ph7PBFpcZkOQSn+6/DIAuyFAF/Huz5bk2v/jKbQamI8MrgfJng2mPHMkd+GNAA7oG6DjWcm7OaHgUgZqh9BqBTypaM4fB1YPJSKCTkQPi61Mv1Rb7UTSLVo4uhAkqv9|khxr3fgGWUiwWwABG0dVRgptObVk1TrYf0FlX55C8Es=", 1) . "<br/>";
//echo "urlencode=" . urlencode("1Ph7PBFpcZkOQSn+6/DIAuyFAF/Huz5bk2v/jKbQamI8MrgfJng2mPHMkd+GNAA7oG6DjWcm7OaHgUgZqh9BqBTypaM4fB1YPJSKCTkQPi61Mv1Rb7UTSLVo4uhAkqv9|khxr3fgGWUiwWwABG0dVRgptObVk1TrYf0FlX55C8Es=") . "<br/>";
//4172
//1Ph7PBFpcZkOQSn+6/DIAuyFAF/Huz5bk2v/jKbQamI8MrgfJng2mPHMkd+GNAA7oG6DjWcm7OaHgUgZqh9BqBTypaM4fB1YPJSKCTkQPi61Mv1Rb7UTSLVo4uhAkqv9|khxr3fgGWUiwWwABG0dVRgptObVk1TrYf0FlX55C8Es=
//echo "idsTbTurmasRelacaoCadastro=" . $idsTbTurmasRelacaoCadastro . "<br/>";
//echo "idsTbModulosVinculoIdsTbTurmas=" . $idsTbModulosVinculoIdsTbTurmas . "<br/>";
//echo "idsTbAulasVinculoIdsModulos=" . $idsTbAulasVinculoIdsModulos . "<br/>";


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>