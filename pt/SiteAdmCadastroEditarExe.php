<?php
//Recurso para permitir o redirecionamento (evitar duplicidade de header).
ob_start();


//Importação dos arquivos de configuração.
require_once "../sistema/IncludeConfig.php"; //Deve vir antes do db.
require_once "../sistema/IncludeConexao.php";
require_once "../sistema/IncludeFuncoes.php";
//require_once "IncludeLayout.php";
require_once "IncludeLayoutSite.php";


//Verificação de login de cadastro.
LoginAutenticacao::CadastroLoginVerificacao();


//Resgate de variáveis.
//$id = ContadorUniversal::ContadorUniversalUpdate(1);
$id = $_POST["idTbCadastro"];
$idTbCategorias = $_POST["id_tb_categorias"];


//Definição dos campos do formulário de acordo com o tipo de cadastro.
//$idTipoCadastro = $_GET["idTipoCadastro"];
$idTipoCadastro = DbFuncoes::FiltrosGenericosSelect03($id, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "1", "", ",", "", "1");

$configCadastroFormularioCampos = Formularios::CadastroFormulariosCampos($idTipoCadastro);
$arrCadastroFormularioCampos = explode(",", $configCadastroFormularioCampos);


/*$idTbCadastroUsuario = $_POST["idTbCadastroUsuario"];
if($idTbCadastroUsuario == "")
{
	$idTbCadastroUsuario = 0;
}*/

$arrIdsCadastroTipo = $_POST["idsCadastroTipo"];
$arrIdsCadastroAtividades = $_POST["idsCadastroAtividades"];
$arrIdsCadastroFiltroGenerico01 = $_POST["idsCadastroFiltroGenerico01"];
$arrIdsCadastroFiltroGenerico02 = $_POST["idsCadastroFiltroGenerico02"];
$arrIdsCadastroFiltroGenerico03 = $_POST["idsCadastroFiltroGenerico03"];
$arrIdsCadastroFiltroGenerico04 = $_POST["idsCadastroFiltroGenerico04"];
$arrIdsCadastroFiltroGenerico05 = $_POST["idsCadastroFiltroGenerico05"];
$arrIdsCadastroFiltroGenerico06 = $_POST["idsCadastroFiltroGenerico06"];
$arrIdsCadastroFiltroGenerico07 = $_POST["idsCadastroFiltroGenerico07"];
$arrIdsCadastroFiltroGenerico08 = $_POST["idsCadastroFiltroGenerico08"];
$arrIdsCadastroFiltroGenerico09 = $_POST["idsCadastroFiltroGenerico09"];
$arrIdsCadastroFiltroGenerico10 = $_POST["idsCadastroFiltroGenerico10"];
//print_r($arrIdsCadastroTipo);

//$dataCadastro = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");

$nome = Funcoes::ConteudoMascaraGravacao01($_POST["nome"]);

$nClassificacao = $_POST["n_classificacao"];
if($nClassificacao == "")
{
	$nClassificacao = 0;
}

$sexo = $_POST["sexo"];
$pfPj = $_POST["pf_pj"];
$altura = $_POST["altura"];
$peso = $_POST["peso"];
$razaoSocial = Funcoes::ConteudoMascaraGravacao01($_POST["razao_social"]);
$nomeFantasia = Funcoes::ConteudoMascaraGravacao01($_POST["nome_fantasia"]);

$dataNascimento = Funcoes::DataGravacaoSql($_POST["data_nascimento"], $GLOBALS['configSistemaFormatoData']);
if($dataNascimento == "")
{
	$dataNascimento = NULL;	
}

$data1 = Funcoes::DataGravacaoSql($_POST["data1"], $GLOBALS['configSistemaFormatoData']);
if($data1 == "")
{
	$data1 = NULL;	
}
$data2 = Funcoes::DataGravacaoSql($_POST["data2"], $GLOBALS['configSistemaFormatoData']);
if($data2 == "")
{
	$data2 = NULL;	
}
$data3 = Funcoes::DataGravacaoSql($_POST["data3"], $GLOBALS['configSistemaFormatoData']);
if($data3 == "")
{
	$data3 = NULL;	
}
$data4 = Funcoes::DataGravacaoSql($_POST["data4"], $GLOBALS['configSistemaFormatoData']);
if($data4 == "")
{
	$data4 = NULL;	
}
$data5 = Funcoes::DataGravacaoSql($_POST["data5"], $GLOBALS['configSistemaFormatoData']);
if($data5 == "")
{
	$data5 = NULL;	
}
$data6 = Funcoes::DataGravacaoSql($_POST["data6"], $GLOBALS['configSistemaFormatoData']);
if($data6 == "")
{
	$data6 = NULL;	
}
$data7 = Funcoes::DataGravacaoSql($_POST["data7"], $GLOBALS['configSistemaFormatoData']);
if($data7 == "")
{
	$data7 = NULL;	
}
$data8 = Funcoes::DataGravacaoSql($_POST["data8"], $GLOBALS['configSistemaFormatoData']);
if($data8 == "")
{
	$data8 = NULL;	
}
$data9 = Funcoes::DataGravacaoSql($_POST["data9"], $GLOBALS['configSistemaFormatoData']);
if($data9 == "")
{
	$data9 = NULL;	
}
$data10 = Funcoes::DataGravacaoSql($_POST["data10"], $GLOBALS['configSistemaFormatoData']);
if($data10 == "")
{
	$data10 = NULL;	
}

//$cpf_ = $_POST["cpf_"];
$cpf_ = Funcoes::SomenteNum($_POST["cpf_"]);
$rg_ = $_POST["rg_"];
//$cnpj_ = $_POST["cnpj_"];
$cnpj_ = Funcoes::SomenteNum($_POST["cnpj_"]);
$documento = $_POST["documento"];
$iMunicipal = $_POST["i_municipal"];
$iEstadual = $_POST["i_estadual"];

$enderecoPrincipal = $_POST["endereco_principal"];
$enderecoNumeroPrincipal = $_POST["endereco_numero_principal"];
$enderecoComplementoPrincipal = $_POST["endereco_complemento_principal"];
$bairroPrincipal = $_POST["bairro_principal"];
$cidadePrincipal = $_POST["cidade_principal"];
$estadoPrincipal = $_POST["estado_principal"];
$paisPrincipal = $_POST["pais_principal"];

//outras configurações de endereço (db)

//$cepPrincipal = $_POST["cep_principal"];
$cepPrincipal = Funcoes::SomenteNum($_POST["cep_principal"]);

$pontoReferencia = $_POST["ponto_referencia"];
$emailPrincipal = $_POST["email_principal"];
$telDDDPrincipal = $_POST["tel_ddd_principal"];
//$telPrincipal = $_POST["tel_principal"];
$telPrincipal = Funcoes::FormatarTelefoneGravar($_POST["tel_principal"]);
$celDDDPrincipal = $_POST["cel_ddd_principal"];
//$celPrincipal = $_POST["cel_principal"];
$celPrincipal = Funcoes::FormatarTelefoneGravar($_POST["cel_principal"]);
$faxDDDPrincipal = $_POST["fax_ddd_principal"];
$faxPrincipal = $_POST["fax_principal"];
$sitePrincipal = $_POST["site_principal"];
$nFuncionarios = $_POST["n_funcionarios"];
$obsInterno = Funcoes::ConteudoMascaraGravacao01($_POST["obs_interno"]);

$idTbCadastro1 = $_POST["id_tb_cadastro1"];
if($idTbCadastro1 == "")
{
	$idTbCadastro1 = 0;
}
$idTbCadastro2 = $_POST["id_tb_cadastro2"];
if($idTbCadastro2 == "")
{
	$idTbCadastro2 = 0;
}
$idTbCadastro3 = $_POST["id_tb_cadastro3"];
if($idTbCadastro3 == "")
{
	$idTbCadastro3 = 0;
}

$idTbCadastroStatus = $_POST["id_tb_cadastro_status"];
if($idTbCadastroStatus == "")
{
	$idTbCadastroStatus = 0;
}
//$idTbCadastroStatus = 0;


$ativacao = $_POST["ativacao"];
$ativacaoDestaque = $_POST["ativacao_destaque"];
if($ativacaoDestaque == "")
{
	$ativacaoDestaque = 0;
}
$ativacaoMalaDireta = $_POST["ativacao_mala_direta"];
if($ativacaoMalaDireta == "")
{
	$ativacaoMalaDireta = 0;
}

$usuario = $_POST["usuario"];
//$senha = $_POST["senha"];
if($GLOBALS['configCadastroMetodoSenha'] == 0)
{
	//$senha = Crypto::EncryptValue(Funcoes::ConteudoMascaraLeitura($_POST["senha"]), 0);
	$senha = Crypto::EncryptValue(Funcoes::ConteudoMascaraGravacao01($_POST["senha"]), 0);
}

if($GLOBALS['configCadastroMetodoSenha'] == 2)
{
	//$senha = Crypto::EncryptValue(Funcoes::ConteudoMascaraLeitura($_POST["senha"]), 2);
	$senha = Crypto::EncryptValue(Funcoes::ConteudoMascaraGravacao01($_POST["senha"]), 2);
	//$senha = Crypto::EncryptValue($_POST["senha"], 2);
}

$mapaOnline = $_POST["mapa_online"];
$palavrasChave = $_POST["palavras_chave"];
$apresentacao = $_POST["apresentacao"];
$servicos = $_POST["servicos"];
$promocoes = $_POST["promocoes"];
$condicoesComerciais = $_POST["condicoes_comerciais"];
$formasPagamento = $_POST["formas_pagamento"];
$horarioAtendimento = $_POST["horario_atendimento"];
$situacaoAtual = $_POST["situacao_atual"];

$informacaoComplementar1 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar1"]);
$informacaoComplementar2 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar2"]);
$informacaoComplementar3 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar3"]);
$informacaoComplementar4 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar4"]);
$informacaoComplementar5 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar5"]);
$informacaoComplementar6 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar6"]);
$informacaoComplementar7 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar7"]);
$informacaoComplementar8 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar8"]);
$informacaoComplementar9 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar9"]);
$informacaoComplementar10 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar10"]);
$informacaoComplementar11 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar11"]);
$informacaoComplementar12 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar12"]);
$informacaoComplementar13 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar13"]);
$informacaoComplementar14 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar14"]);
$informacaoComplementar15 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar15"]);
$informacaoComplementar16 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar16"]);
$informacaoComplementar17 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar17"]);
$informacaoComplementar18 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar18"]);
$informacaoComplementar19 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar19"]);
$informacaoComplementar20 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar20"]);
$informacaoComplementar21 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar21"]);
$informacaoComplementar22 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar22"]);
$informacaoComplementar23 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar23"]);
$informacaoComplementar24 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar24"]);
$informacaoComplementar25 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar25"]);
$informacaoComplementar26 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar26"]);
$informacaoComplementar27 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar27"]);
$informacaoComplementar28 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar28"]);
$informacaoComplementar29 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar29"]);
$informacaoComplementar30 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar30"]);
$informacaoComplementar31 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar31"]);
$informacaoComplementar32 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar32"]);
$informacaoComplementar33 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar33"]);
$informacaoComplementar34 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar34"]);
$informacaoComplementar35 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar35"]);
$informacaoComplementar36 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar36"]);
$informacaoComplementar37 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar37"]);
$informacaoComplementar38 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar38"]);
$informacaoComplementar39 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar39"]);
$informacaoComplementar40 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar40"]);
$nVisitas = Funcoes::ConteudoMascaraGravacao01($_POST["n_visitas"]);

$paginaRetorno = $_POST["paginaRetorno"];
$mensagemErro = "";
$mensagemSucesso = "";


//Verificação de erro - debug
//echo "idRegistro=" . $idRegistro . "<br />";
//echo "strTabela=" . $strTabela . "<br />";
//echo "strCampo=" . $strCampo . "<br />";
//echo "arrImagemTamanhos=" . $arrImagemTamanhos . "<br />";
//exit();


//Update de registro no BD.
//----------
$strSqlCadastroUpdate = "";
$strSqlCadastroUpdate .= "UPDATE tb_cadastro ";
$strSqlCadastroUpdate .= "SET ";
//$strSqlCadastroUpdate .= "id = :id, ";
//$strSqlCadastroUpdate .= "id_tb_categorias = :id_tb_categorias, ";
//$strSqlCadastroUpdate .= "data_cadastro = :data_cadastro, ";

if(in_array("pf_pj", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "pf_pj = :pf_pj, ";
}
if(in_array("nome", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "nome = :nome, ";
}
if(in_array("sexo", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "sexo = :sexo, ";
}
if(in_array("altura", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "altura = :altura, ";
}
if(in_array("peso", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "peso = :peso, ";
}
if(in_array("razao_social", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "razao_social = :razao_social, ";
}
if(in_array("nome_fantasia", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "nome_fantasia = :nome_fantasia, ";
}
if(in_array("data_nascimento", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "data_nascimento = :data_nascimento, ";
}
if(in_array("data1", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "data1 = :data1, ";
}
if(in_array("data2", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "data2 = :data2, ";
}
if(in_array("data3", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "data3 = :data3, ";
}
if(in_array("data4", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "data4 = :data4, ";
}
if(in_array("data5", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "data5 = :data5, ";
}
if(in_array("data6", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "data6 = :data6, ";
}
if(in_array("data7", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "data7 = :data7, ";
}
if(in_array("data8", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "data8 = :data8, ";
}
if(in_array("data9", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "data9 = :data9, ";
}
if(in_array("data10", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "data10 = :data10, ";
}
if(in_array("cpf_", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "cpf_ = :cpf_, ";
}
if(in_array("rg_", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "rg_ = :rg_, ";
}
if(in_array("cnpj_", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "cnpj_ = :cnpj_, ";
}
if(in_array("documento", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "documento = :documento, ";
}
if(in_array("i_municipal", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "i_municipal = :i_municipal, ";
}
if(in_array("i_estadual", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "i_estadual = :i_estadual, ";
}
if(in_array("endereco_principal", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "endereco_principal = :endereco_principal, ";
}
if(in_array("endereco_numero_principal", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "endereco_numero_principal = :endereco_numero_principal, ";
}
if(in_array("endereco_complemento_principal", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "endereco_complemento_principal = :endereco_complemento_principal, ";
}
if(in_array("bairro_principal", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "bairro_principal = :bairro_principal, ";
}
if(in_array("cidade_principal", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "cidade_principal = :cidade_principal, ";
}
if(in_array("estado_principal", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "estado_principal = :estado_principal, ";
}
if(in_array("pais_principal", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "pais_principal = :pais_principal, ";
}
if(in_array("id_config_bairro", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "id_config_bairro = :id_config_bairro, ";
}
if(in_array("id_config_cidade", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "id_config_cidade = :id_config_cidade, ";
}
if(in_array("id_config_estado", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "id_config_estado = :id_config_estado, ";
}
if(in_array("id_config_regiao", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "id_config_regiao = :id_config_regiao, ";
}
if(in_array("id_config_pais", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "id_config_pais = :id_config_pais, ";
}
if(in_array("id_db_cep_tblBairros", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "id_db_cep_tblBairros = :id_db_cep_tblBairros, ";
}
if(in_array("id_db_cep_tblCidades", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "id_db_cep_tblCidades = :id_db_cep_tblCidades, ";
}
if(in_array("id_db_cep_tblLogradouros", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "id_db_cep_tblLogradouros = :id_db_cep_tblLogradouros, ";
}
if(in_array("id_db_cep_tblUF", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "id_db_cep_tblUF = :id_db_cep_tblUF, ";
}
if(in_array("cep_principal", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "cep_principal = :cep_principal, ";
}
if(in_array("ponto_referencia", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "ponto_referencia = :ponto_referencia, ";
}
if(in_array("email_principal", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "email_principal = :email_principal, ";
}
/*
if(in_array("tel_ddd_principal", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "tel_ddd_principal = :tel_ddd_principal, ";
}
*/
if(in_array("tel_principal", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "tel_ddd_principal = :tel_ddd_principal, ";
	$strSqlCadastroUpdate .= "tel_principal = :tel_principal, ";
}
/*
if(in_array("cel_ddd_principal", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "cel_ddd_principal = :cel_ddd_principal, ";
}
*/
if(in_array("cel_principal", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "cel_ddd_principal = :cel_ddd_principal, ";
	$strSqlCadastroUpdate .= "cel_principal = :cel_principal, ";
}
/*
if(in_array("fax_ddd_principal", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "fax_ddd_principal = :fax_ddd_principal, ";
}
*/
if(in_array("fax_principal", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "fax_ddd_principal = :fax_ddd_principal, ";
	$strSqlCadastroUpdate .= "fax_principal = :fax_principal, ";
}
if(in_array("site_principal", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "site_principal = :site_principal, ";
}
if(in_array("n_funcionarios", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "n_funcionarios = :n_funcionarios, ";
}
if(in_array("obs_interno", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "obs_interno = :obs_interno, ";
}
if(in_array("id_tb_cadastro1", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "id_tb_cadastro1 = :id_tb_cadastro1, ";
}
if(in_array("id_tb_cadastro2", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "id_tb_cadastro2 = :id_tb_cadastro2, ";
}
if(in_array("id_tb_cadastro3", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "id_tb_cadastro3 = :id_tb_cadastro3, ";
}
if(in_array("id_tb_cadastro_status", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "id_tb_cadastro_status = :id_tb_cadastro_status, ";
}
if(in_array("ativacao", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "ativacao = :ativacao, ";
}
if(in_array("ativacao_destaque", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "ativacao_destaque = :ativacao_destaque, ";
}
if(in_array("ativacao_mala_direta", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "ativacao_mala_direta = :ativacao_mala_direta, ";
}
if(in_array("usuario", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "usuario = :usuario, ";
}
if(in_array("senha", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "senha = :senha, ";
}
if(in_array("mapa_online", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "mapa_online = :mapa_online, ";
}
if(in_array("palavras_chave", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "palavras_chave = :palavras_chave, ";
}
if(in_array("apresentacao", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "apresentacao = :apresentacao, ";
}
if(in_array("servicos", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "servicos = :servicos, ";
}
if(in_array("promocoes", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "promocoes = :promocoes, ";
}
if(in_array("condicoes_comerciais", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "condicoes_comerciais = :condicoes_comerciais, ";
}
if(in_array("formas_pagamento", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "formas_pagamento = :formas_pagamento, ";
}
if(in_array("horario_atendimento", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "horario_atendimento = :horario_atendimento, ";
}
if(in_array("situacao_atual", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "situacao_atual = :situacao_atual, ";
}
if(in_array("informacao_complementar1", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "informacao_complementar1 = :informacao_complementar1, ";
}
if(in_array("informacao_complementar2", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "informacao_complementar2 = :informacao_complementar2, ";
}
if(in_array("informacao_complementar3", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "informacao_complementar3 = :informacao_complementar3, ";
}
if(in_array("informacao_complementar4", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "informacao_complementar4 = :informacao_complementar4, ";
}
if(in_array("informacao_complementar5", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "informacao_complementar5 = :informacao_complementar5, ";
}
if(in_array("informacao_complementar6", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "informacao_complementar6 = :informacao_complementar6, ";
}
if(in_array("informacao_complementar7", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "informacao_complementar7 = :informacao_complementar7, ";
}
if(in_array("informacao_complementar8", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "informacao_complementar8 = :informacao_complementar8, ";
}
if(in_array("informacao_complementar9", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "informacao_complementar9 = :informacao_complementar9, ";
}
if(in_array("informacao_complementar10", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "informacao_complementar10 = :informacao_complementar10, ";
}
if(in_array("informacao_complementar11", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "informacao_complementar11 = :informacao_complementar11, ";
}
if(in_array("informacao_complementar12", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "informacao_complementar12 = :informacao_complementar12, ";
}
if(in_array("informacao_complementar13", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "informacao_complementar13 = :informacao_complementar13, ";
}
if(in_array("informacao_complementar14", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "informacao_complementar14 = :informacao_complementar14, ";
}
if(in_array("informacao_complementar15", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "informacao_complementar15 = :informacao_complementar15, ";
}
if(in_array("informacao_complementar16", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "informacao_complementar16 = :informacao_complementar16, ";
}
if(in_array("informacao_complementar17", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "informacao_complementar17 = :informacao_complementar17, ";
}
if(in_array("informacao_complementar18", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "informacao_complementar18 = :informacao_complementar18, ";
}
if(in_array("informacao_complementar19", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "informacao_complementar19 = :informacao_complementar19, ";
}
if(in_array("informacao_complementar20", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "informacao_complementar20 = :informacao_complementar20, ";
}
if(in_array("informacao_complementar21", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "informacao_complementar21 = :informacao_complementar21, ";
}
if(in_array("informacao_complementar22", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "informacao_complementar22 = :informacao_complementar22, ";
}
if(in_array("informacao_complementar23", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "informacao_complementar23 = :informacao_complementar23, ";
}
if(in_array("informacao_complementar24", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "informacao_complementar24 = :informacao_complementar24, ";
}
if(in_array("informacao_complementar25", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "informacao_complementar25 = :informacao_complementar25, ";
}
if(in_array("informacao_complementar26", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "informacao_complementar26 = :informacao_complementar26, ";
}
if(in_array("informacao_complementar27", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "informacao_complementar27 = :informacao_complementar27, ";
}
if(in_array("informacao_complementar28", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "informacao_complementar28 = :informacao_complementar28, ";
}
if(in_array("informacao_complementar29", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "informacao_complementar29 = :informacao_complementar29, ";
}
if(in_array("informacao_complementar30", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "informacao_complementar30 = :informacao_complementar30, ";
}
if(in_array("informacao_complementar31", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "informacao_complementar31 = :informacao_complementar31, ";
}
if(in_array("informacao_complementar32", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "informacao_complementar32 = :informacao_complementar32, ";
}
if(in_array("informacao_complementar33", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "informacao_complementar33 = :informacao_complementar33, ";
}
if(in_array("informacao_complementar34", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "informacao_complementar34 = :informacao_complementar34, ";
}
if(in_array("informacao_complementar35", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "informacao_complementar35 = :informacao_complementar35, ";
}
if(in_array("informacao_complementar36", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "informacao_complementar36 = :informacao_complementar36, ";
}
if(in_array("informacao_complementar37", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "informacao_complementar37 = :informacao_complementar37, ";
}
if(in_array("informacao_complementar38", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "informacao_complementar38 = :informacao_complementar38, ";
}
if(in_array("informacao_complementar39", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "informacao_complementar39 = :informacao_complementar39, ";
}
if(in_array("informacao_complementar40", $arrCadastroFormularioCampos) == true)
{
	$strSqlCadastroUpdate .= "informacao_complementar40 = :informacao_complementar40, ";
}
	
/*
//$strSqlCadastroUpdate .= "pf_pj = :pf_pj, ";
//if($nome <> "") //funcionando.
//{
	//$strSqlCadastroUpdate .= "nome = :nome, ";
//}

$strSqlCadastroUpdate .= "nome = :nome, ";

$strSqlCadastroUpdate .= "sexo = :sexo, ";
$strSqlCadastroUpdate .= "altura = :altura, ";
$strSqlCadastroUpdate .= "peso = :peso, ";
$strSqlCadastroUpdate .= "razao_social = :razao_social, ";
$strSqlCadastroUpdate .= "nome_fantasia = :nome_fantasia, ";

$strSqlCadastroUpdate .= "data_nascimento = :data_nascimento, ";
$strSqlCadastroUpdate .= "data1 = :data1, ";
$strSqlCadastroUpdate .= "data2 = :data2, ";
$strSqlCadastroUpdate .= "data3 = :data3, ";
$strSqlCadastroUpdate .= "data4 = :data4, ";
$strSqlCadastroUpdate .= "data5 = :data5, ";
$strSqlCadastroUpdate .= "data6 = :data6, ";
$strSqlCadastroUpdate .= "data7 = :data7, ";
$strSqlCadastroUpdate .= "data8 = :data8, ";
$strSqlCadastroUpdate .= "data9 = :data9, ";
$strSqlCadastroUpdate .= "data10 = :data10, ";

$strSqlCadastroUpdate .= "cpf_ = :cpf_, ";
$strSqlCadastroUpdate .= "rg_ = :rg_, ";
$strSqlCadastroUpdate .= "cnpj_ = :cnpj_, ";
$strSqlCadastroUpdate .= "documento = :documento, ";
$strSqlCadastroUpdate .= "i_municipal = :i_municipal, ";
$strSqlCadastroUpdate .= "i_estadual = :i_estadual, ";

$strSqlCadastroUpdate .= "endereco_principal = :endereco_principal, ";
$strSqlCadastroUpdate .= "endereco_numero_principal = :endereco_numero_principal, ";
$strSqlCadastroUpdate .= "endereco_complemento_principal = :endereco_complemento_principal, ";
$strSqlCadastroUpdate .= "bairro_principal = :bairro_principal, ";
$strSqlCadastroUpdate .= "cidade_principal = :cidade_principal, ";
$strSqlCadastroUpdate .= "estado_principal = :estado_principal, ";
$strSqlCadastroUpdate .= "pais_principal = :pais_principal, ";

$strSqlCadastroUpdate .= "id_config_bairro = :id_config_bairro, ";
$strSqlCadastroUpdate .= "id_config_cidade = :id_config_cidade, ";
$strSqlCadastroUpdate .= "id_config_estado = :id_config_estado, ";
$strSqlCadastroUpdate .= "id_config_regiao = :id_config_regiao, ";
$strSqlCadastroUpdate .= "id_config_pais = :id_config_pais, ";

$strSqlCadastroUpdate .= "id_db_cep_tblBairros = :id_db_cep_tblBairros, ";
$strSqlCadastroUpdate .= "id_db_cep_tblCidades = :id_db_cep_tblCidades, ";
$strSqlCadastroUpdate .= "id_db_cep_tblLogradouros = :id_db_cep_tblLogradouros, ";
$strSqlCadastroUpdate .= "id_db_cep_tblUF = :id_db_cep_tblUF, ";

$strSqlCadastroUpdate .= "cep_principal = :cep_principal, ";

$strSqlCadastroUpdate .= "ponto_referencia = :ponto_referencia, ";
$strSqlCadastroUpdate .= "email_principal = :email_principal, ";
$strSqlCadastroUpdate .= "tel_ddd_principal = :tel_ddd_principal, ";
$strSqlCadastroUpdate .= "tel_principal = :tel_principal, ";
$strSqlCadastroUpdate .= "cel_ddd_principal = :cel_ddd_principal, ";
$strSqlCadastroUpdate .= "cel_principal = :cel_principal, ";
$strSqlCadastroUpdate .= "fax_ddd_principal = :fax_ddd_principal, ";
$strSqlCadastroUpdate .= "fax_principal = :fax_principal, ";
$strSqlCadastroUpdate .= "site_principal = :site_principal, ";
$strSqlCadastroUpdate .= "n_funcionarios = :n_funcionarios, ";
$strSqlCadastroUpdate .= "obs_interno = :obs_interno, ";

$strSqlCadastroUpdate .= "id_tb_cadastro1 = :id_tb_cadastro1, ";
$strSqlCadastroUpdate .= "id_tb_cadastro2 = :id_tb_cadastro2, ";
$strSqlCadastroUpdate .= "id_tb_cadastro3 = :id_tb_cadastro3, ";
$strSqlCadastroUpdate .= "id_tb_cadastro_status = :id_tb_cadastro_status, ";

//$strSqlCadastroUpdate .= "id_tb_cadastro1 = :id_tb_cadastro1, ";

$strSqlCadastroUpdate .= "ativacao = :ativacao, ";
$strSqlCadastroUpdate .= "ativacao_destaque = :ativacao_destaque, ";
$strSqlCadastroUpdate .= "ativacao_mala_direta = :ativacao_mala_direta, ";
$strSqlCadastroUpdate .= "usuario = :usuario, ";

$strSqlCadastroUpdate .= "senha = :senha, ";
//$strSqlCadastroUpdate .= "senha = PASSWORD(:senha), ";

//$strSqlCadastroUpdate .= "imagem = :imagem, ";
//$strSqlCadastroUpdate .= "logo = :logo, ";
//$strSqlCadastroUpdate .= "banner = :banner, ";
//$strSqlCadastroUpdate .= "mapa = :mapa, ";
$strSqlCadastroUpdate .= "mapa_online = :mapa_online, ";
$strSqlCadastroUpdate .= "palavras_chave = :palavras_chave, ";
$strSqlCadastroUpdate .= "apresentacao = :apresentacao, ";
$strSqlCadastroUpdate .= "servicos = :servicos, ";
$strSqlCadastroUpdate .= "promocoes = :promocoes, ";
$strSqlCadastroUpdate .= "condicoes_comerciais = :condicoes_comerciais, ";
$strSqlCadastroUpdate .= "formas_pagamento = :formas_pagamento, ";
$strSqlCadastroUpdate .= "horario_atendimento = :horario_atendimento, ";
$strSqlCadastroUpdate .= "situacao_atual = :situacao_atual, ";

$strSqlCadastroUpdate .= "informacao_complementar1 = :informacao_complementar1, ";
$strSqlCadastroUpdate .= "informacao_complementar2 = :informacao_complementar2, ";
$strSqlCadastroUpdate .= "informacao_complementar3 = :informacao_complementar3, ";
$strSqlCadastroUpdate .= "informacao_complementar4 = :informacao_complementar4, ";
$strSqlCadastroUpdate .= "informacao_complementar5 = :informacao_complementar5, ";
$strSqlCadastroUpdate .= "informacao_complementar6 = :informacao_complementar6, ";
$strSqlCadastroUpdate .= "informacao_complementar7 = :informacao_complementar7, ";
$strSqlCadastroUpdate .= "informacao_complementar8 = :informacao_complementar8, ";
$strSqlCadastroUpdate .= "informacao_complementar9 = :informacao_complementar9, ";
$strSqlCadastroUpdate .= "informacao_complementar10 = :informacao_complementar10, ";
$strSqlCadastroUpdate .= "informacao_complementar11 = :informacao_complementar11, ";
$strSqlCadastroUpdate .= "informacao_complementar12 = :informacao_complementar12, ";
$strSqlCadastroUpdate .= "informacao_complementar13 = :informacao_complementar13, ";
$strSqlCadastroUpdate .= "informacao_complementar14 = :informacao_complementar14, ";
$strSqlCadastroUpdate .= "informacao_complementar15 = :informacao_complementar15, ";
$strSqlCadastroUpdate .= "informacao_complementar16 = :informacao_complementar16, ";
$strSqlCadastroUpdate .= "informacao_complementar17 = :informacao_complementar17, ";
$strSqlCadastroUpdate .= "informacao_complementar18 = :informacao_complementar18, ";
$strSqlCadastroUpdate .= "informacao_complementar19 = :informacao_complementar19, ";
$strSqlCadastroUpdate .= "informacao_complementar20 = :informacao_complementar20, ";
$strSqlCadastroUpdate .= "informacao_complementar21 = :informacao_complementar21, ";
$strSqlCadastroUpdate .= "informacao_complementar22 = :informacao_complementar22, ";
$strSqlCadastroUpdate .= "informacao_complementar23 = :informacao_complementar23, ";
$strSqlCadastroUpdate .= "informacao_complementar24 = :informacao_complementar24, ";
$strSqlCadastroUpdate .= "informacao_complementar25 = :informacao_complementar25, ";
$strSqlCadastroUpdate .= "informacao_complementar26 = :informacao_complementar26, ";
$strSqlCadastroUpdate .= "informacao_complementar27 = :informacao_complementar27, ";
$strSqlCadastroUpdate .= "informacao_complementar28 = :informacao_complementar28, ";
$strSqlCadastroUpdate .= "informacao_complementar29 = :informacao_complementar29, ";
$strSqlCadastroUpdate .= "informacao_complementar30 = :informacao_complementar30, ";
$strSqlCadastroUpdate .= "informacao_complementar31 = :informacao_complementar31, ";
$strSqlCadastroUpdate .= "informacao_complementar32 = :informacao_complementar32, ";
$strSqlCadastroUpdate .= "informacao_complementar33 = :informacao_complementar33, ";
$strSqlCadastroUpdate .= "informacao_complementar34 = :informacao_complementar34, ";
$strSqlCadastroUpdate .= "informacao_complementar35 = :informacao_complementar35, ";
$strSqlCadastroUpdate .= "informacao_complementar36 = :informacao_complementar36, ";
$strSqlCadastroUpdate .= "informacao_complementar37 = :informacao_complementar37, ";
$strSqlCadastroUpdate .= "informacao_complementar38 = :informacao_complementar38, ";
$strSqlCadastroUpdate .= "informacao_complementar39 = :informacao_complementar39, ";
$strSqlCadastroUpdate .= "informacao_complementar40 = :informacao_complementar40, ";
*/

$strSqlCadastroUpdate .= "n_visitas = :n_visitas ";

$strSqlCadastroUpdate .= "WHERE id = :id ";
//echo "strSqlCategoriasUpdate = " . $strSqlCadastroUpdate . "<br />";
//----------

//Criação de componentes e parâmetros.
//----------
$statementCadastroUpdate = $dbSistemaConPDO->prepare($strSqlCadastroUpdate);


/*
"data_cadastro" => $dataCadastro,
"n_visitas" => 0
*/
if ($statementCadastroUpdate !== false)
{
	$statementCadastroUpdate->bindParam(':id', $id, PDO::PARAM_STR);
	
	if(in_array("pf_pj", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':pf_pj', $pfPj, PDO::PARAM_STR);
	}
	if(in_array("nome", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':nome', $nome, PDO::PARAM_STR);
	}
	if(in_array("sexo", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':sexo', $sexo, PDO::PARAM_STR);
	}
	if(in_array("altura", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':altura', $altura, PDO::PARAM_STR);
	}
	if(in_array("peso", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':peso', $peso, PDO::PARAM_STR);
	}
	if(in_array("razao_social", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':razao_social', $razaoSocial, PDO::PARAM_STR);
	}
	if(in_array("nome_fantasia", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':nome_fantasia', $nomeFantasia, PDO::PARAM_STR);
	}
	if(in_array("data_nascimento", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':data_nascimento', $dataNascimento, PDO::PARAM_STR);
	}
	if(in_array("data1", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':data1', $data1, PDO::PARAM_STR);
	}
	if(in_array("data2", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':data2', $data2, PDO::PARAM_STR);
	}
	if(in_array("data3", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':data3', $data3, PDO::PARAM_STR);
	}
	if(in_array("data4", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':data4', $data4, PDO::PARAM_STR);
	}
	if(in_array("data5", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':data5', $data5, PDO::PARAM_STR);
	}
	if(in_array("data6", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':data6', $data6, PDO::PARAM_STR);
	}
	if(in_array("data7", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':data7', $data7, PDO::PARAM_STR);
	}
	if(in_array("data8", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':data8', $data8, PDO::PARAM_STR);
	}
	if(in_array("data9", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':data9', $data9, PDO::PARAM_STR);
	}
	if(in_array("data10", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':data10', $data10, PDO::PARAM_STR);
	}
	if(in_array("cpf_", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':cpf_', $cpf_, PDO::PARAM_STR);
	}
	if(in_array("rg_", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':rg_', $rg_, PDO::PARAM_STR);
	}
	if(in_array("cnpj_", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':cnpj_', $cnpj_, PDO::PARAM_STR);
	}
	if(in_array("documento", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':documento', $documento, PDO::PARAM_STR);
	}
	if(in_array("i_municipal", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':i_municipal', $iMunicipal, PDO::PARAM_STR);
	}
	if(in_array("i_estadual", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':i_estadual', $iEstadual, PDO::PARAM_STR);
	}
	if(in_array("endereco_principal", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':endereco_principal', $enderecoPrincipal, PDO::PARAM_STR);
	}
	if(in_array("endereco_numero_principal", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':endereco_numero_principal', $enderecoNumeroPrincipal, PDO::PARAM_STR);
	}
	if(in_array("endereco_complemento_principal", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':endereco_complemento_principal', $enderecoComplementoPrincipal, PDO::PARAM_STR);
	}
	if(in_array("bairro_principal", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':bairro_principal', $bairroPrincipal, PDO::PARAM_STR);
	}
	if(in_array("cidade_principal", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':cidade_principal', $cidadePrincipal, PDO::PARAM_STR);
	}
	if(in_array("estado_principal", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':estado_principal', $estadoPrincipal, PDO::PARAM_STR);
	}
	if(in_array("pais_principal", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':pais_principal', $paisPrincipal, PDO::PARAM_STR);
	}
	if(in_array("id_config_bairro", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':id_config_bairro', 0, PDO::PARAM_STR);
	}
	if(in_array("id_config_cidade", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':id_config_cidade', 0, PDO::PARAM_STR);
	}
	if(in_array("id_config_estado", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':id_config_estado', 0, PDO::PARAM_STR);
	}
	if(in_array("id_config_regiao", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':id_config_regiao', 0, PDO::PARAM_STR);
	}
	if(in_array("id_config_pais", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':id_config_pais', '', PDO::PARAM_STR);
	}
	if(in_array("cep_principal", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':cep_principal', $cepPrincipal, PDO::PARAM_STR);
	}
	if(in_array("id_db_cep_tblBairros", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':id_db_cep_tblBairros', 0, PDO::PARAM_STR);
	}
	if(in_array("id_db_cep_tblCidades", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':id_db_cep_tblCidades', 0, PDO::PARAM_STR);
	}
	if(in_array("id_db_cep_tblLogradouros", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':id_db_cep_tblLogradouros', 0, PDO::PARAM_STR);
	}
	if(in_array("id_db_cep_tblUF", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':id_db_cep_tblUF', '', PDO::PARAM_STR);
	}
	if(in_array("ponto_referencia", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':ponto_referencia', $pontoReferencia, PDO::PARAM_STR);
	}
	if(in_array("email_principal", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':email_principal', $emailPrincipal, PDO::PARAM_STR);
	}
	/*
	if(in_array("tel_ddd_principal", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':tel_ddd_principal', $telDDDPrincipal, PDO::PARAM_STR);
	}
	*/
	if(in_array("tel_principal", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':tel_ddd_principal', $telDDDPrincipal, PDO::PARAM_STR);
		$statementCadastroUpdate->bindParam(':tel_principal', $telPrincipal, PDO::PARAM_STR);
	}
	/*
	if(in_array("cel_ddd_principal", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':cel_ddd_principal', $celDDDPrincipal, PDO::PARAM_STR);
	}
	*/
	if(in_array("cel_principal", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':cel_ddd_principal', $celDDDPrincipal, PDO::PARAM_STR);
		$statementCadastroUpdate->bindParam(':cel_principal', $celPrincipal, PDO::PARAM_STR);
	}
	/*
	if(in_array("fax_ddd_principal", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':fax_ddd_principal', $faxDDDPrincipal, PDO::PARAM_STR);
	}
	*/
	if(in_array("fax_principal", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':fax_ddd_principal', $faxDDDPrincipal, PDO::PARAM_STR);
		$statementCadastroUpdate->bindParam(':fax_principal', $faxPrincipal, PDO::PARAM_STR);
	}
	if(in_array("site_principal", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':site_principal', $sitePrincipal, PDO::PARAM_STR);
	}
	if(in_array("n_funcionarios", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':n_funcionarios', $nFuncionarios, PDO::PARAM_STR);
	}
	if(in_array("obs_interno", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':obs_interno', $obsInterno, PDO::PARAM_STR);
	}
	if(in_array("id_tb_cadastro1", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':id_tb_cadastro1', $idTbCadastro1, PDO::PARAM_STR);
	}
	if(in_array("id_tb_cadastro2", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':id_tb_cadastro2', $idTbCadastro2, PDO::PARAM_STR);
	}
	if(in_array("id_tb_cadastro3", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':id_tb_cadastro3', $idTbCadastro3, PDO::PARAM_STR);
	}
	if(in_array("id_tb_cadastro_status", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':id_tb_cadastro_status', $idTbCadastroStatus, PDO::PARAM_STR);
	}
	if(in_array("ativacao", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':ativacao', $ativacao, PDO::PARAM_STR);
	}
	if(in_array("ativacao_destaque", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':ativacao_destaque', $ativacaoDestaque, PDO::PARAM_STR);
	}
	if(in_array("ativacao_mala_direta", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':ativacao_mala_direta', $ativacaoMalaDireta, PDO::PARAM_STR);
	}
	if(in_array("usuario", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':usuario', $usuario, PDO::PARAM_STR);
	}
	if(in_array("senha", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':senha', $senha, PDO::PARAM_STR);
	}
	if(in_array("mapa_online", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':mapa_online', $mapaOnline, PDO::PARAM_STR);
	}
	if(in_array("palavras_chave", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':palavras_chave', $palavrasChave, PDO::PARAM_STR);
	}
	if(in_array("apresentacao", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':apresentacao', $apresentacao, PDO::PARAM_STR);
	}
	if(in_array("servicos", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':servicos', $servicos, PDO::PARAM_STR);
	}
	if(in_array("promocoes", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':promocoes', $promocoes, PDO::PARAM_STR);
	}
	if(in_array("condicoes_comerciais", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':condicoes_comerciais', $condicoesComerciais, PDO::PARAM_STR);
	}
	if(in_array("formas_pagamento", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':formas_pagamento', $formasPagamento, PDO::PARAM_STR);
	}
	if(in_array("horario_atendimento", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':horario_atendimento', $horarioAtendimento, PDO::PARAM_STR);
	}
	if(in_array("situacao_atual", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':situacao_atual', $situacaoAtual, PDO::PARAM_STR);
	}
	if(in_array("informacao_complementar1", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':informacao_complementar1', $informacaoComplementar1, PDO::PARAM_STR);
	}
	if(in_array("informacao_complementar2", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':informacao_complementar2', $informacaoComplementar2, PDO::PARAM_STR);
	}
	if(in_array("informacao_complementar3", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':informacao_complementar3', $informacaoComplementar3, PDO::PARAM_STR);
	}
	if(in_array("informacao_complementar4", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':informacao_complementar4', $informacaoComplementar4, PDO::PARAM_STR);
	}
	if(in_array("informacao_complementar5", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':informacao_complementar5', $informacaoComplementar5, PDO::PARAM_STR);
	}
	if(in_array("informacao_complementar6", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':informacao_complementar6', $informacaoComplementar6, PDO::PARAM_STR);
	}
	if(in_array("informacao_complementar7", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':informacao_complementar7', $informacaoComplementar7, PDO::PARAM_STR);
	}
	if(in_array("informacao_complementar8", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':informacao_complementar8', $informacaoComplementar8, PDO::PARAM_STR);
	}
	if(in_array("informacao_complementar9", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':informacao_complementar9', $informacaoComplementar9, PDO::PARAM_STR);
	}
	if(in_array("informacao_complementar10", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':informacao_complementar10', $informacaoComplementar10, PDO::PARAM_STR);
	}
	if(in_array("informacao_complementar11", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':informacao_complementar11', $informacaoComplementar11, PDO::PARAM_STR);
	}
	if(in_array("informacao_complementar12", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':informacao_complementar12', $informacaoComplementar12, PDO::PARAM_STR);
	}
	if(in_array("informacao_complementar13", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':informacao_complementar13', $informacaoComplementar13, PDO::PARAM_STR);
	}
	if(in_array("informacao_complementar14", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':informacao_complementar14', $informacaoComplementar14, PDO::PARAM_STR);
	}
	if(in_array("informacao_complementar15", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':informacao_complementar15', $informacaoComplementar15, PDO::PARAM_STR);
	}
	if(in_array("informacao_complementar16", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':informacao_complementar16', $informacaoComplementar16, PDO::PARAM_STR);
	}
	if(in_array("informacao_complementar17", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':informacao_complementar17', $informacaoComplementar17, PDO::PARAM_STR);
	}
	if(in_array("informacao_complementar18", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':informacao_complementar18', $informacaoComplementar18, PDO::PARAM_STR);
	}
	if(in_array("informacao_complementar19", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':informacao_complementar19', $informacaoComplementar19, PDO::PARAM_STR);
	}
	if(in_array("informacao_complementar20", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':informacao_complementar20', $informacaoComplementar20, PDO::PARAM_STR);
	}
	if(in_array("informacao_complementar21", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':informacao_complementar21', $informacaoComplementar21, PDO::PARAM_STR);
	}
	if(in_array("informacao_complementar22", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':informacao_complementar22', $informacaoComplementar22, PDO::PARAM_STR);
	}
	if(in_array("informacao_complementar23", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':informacao_complementar23', $informacaoComplementar23, PDO::PARAM_STR);
	}
	if(in_array("informacao_complementar24", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':informacao_complementar24', $informacaoComplementar24, PDO::PARAM_STR);
	}
	if(in_array("informacao_complementar25", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':informacao_complementar25', $informacaoComplementar25, PDO::PARAM_STR);
	}
	if(in_array("informacao_complementar26", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':informacao_complementar26', $informacaoComplementar26, PDO::PARAM_STR);
	}
	if(in_array("informacao_complementar27", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':informacao_complementar27', $informacaoComplementar27, PDO::PARAM_STR);
	}
	if(in_array("informacao_complementar28", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':informacao_complementar28', $informacaoComplementar28, PDO::PARAM_STR);
	}
	if(in_array("informacao_complementar29", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':informacao_complementar29', $informacaoComplementar29, PDO::PARAM_STR);
	}
	if(in_array("informacao_complementar30", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':informacao_complementar30', $informacaoComplementar30, PDO::PARAM_STR);
	}
	if(in_array("informacao_complementar31", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':informacao_complementar31', $informacaoComplementar31, PDO::PARAM_STR);
	}
	if(in_array("informacao_complementar32", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':informacao_complementar32', $informacaoComplementar32, PDO::PARAM_STR);
	}
	if(in_array("informacao_complementar33", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':informacao_complementar33', $informacaoComplementar33, PDO::PARAM_STR);
	}
	if(in_array("informacao_complementar34", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':informacao_complementar34', $informacaoComplementar34, PDO::PARAM_STR);
	}
	if(in_array("informacao_complementar35", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':informacao_complementar35', $informacaoComplementar35, PDO::PARAM_STR);
	}
	if(in_array("informacao_complementar36", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':informacao_complementar36', $informacaoComplementar36, PDO::PARAM_STR);
	}
	if(in_array("informacao_complementar37", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':informacao_complementar37', $informacaoComplementar37, PDO::PARAM_STR);
	}
	if(in_array("informacao_complementar38", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':informacao_complementar38', $informacaoComplementar38, PDO::PARAM_STR);
	}
	if(in_array("informacao_complementar39", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':informacao_complementar39', $informacaoComplementar39, PDO::PARAM_STR);
	}
	if(in_array("informacao_complementar40", $arrCadastroFormularioCampos) == true)
	{
		$statementCadastroUpdate->bindParam(':informacao_complementar40', $informacaoComplementar40, PDO::PARAM_STR);
	}

	$statementCadastroUpdate->bindParam(':n_visitas', $nVisitas, PDO::PARAM_STR);
	$statementCadastroUpdate->execute();
	/*
	$statementCadastroUpdate->execute(array(
		"id" => $id,
		"id_tb_categorias" => $idTbCategorias,
		"pf_pj" => $pfPj,		
		"nome" => $nome,
		"sexo" => $sexo,
		"altura" => $altura,
		"peso" => $peso,
		"razao_social" => $razaoSocial,
		"nome_fantasia" => $nomeFantasia,
		"data_nascimento" => $dataNascimento,
		"data1" => $data1,
		"data2" => $data2,
		"data3" => $data3,
		"data4" => $data4,
		"data5" => $data5,
		"data6" => $data6,
		"data7" => $data7,
		"data8" => $data8,
		"data9" => $data9,
		"data10" => $data10,
		"cpf_" => $cpf_,
		"rg_" => $rg_,
		"cnpj_" => $cnpj_,
		"documento" => $documento,
		"i_municipal" => $iMunicipal,
		"i_estadual" => $iEstadual,
		"endereco_principal" => $enderecoPrincipal,
		"endereco_numero_principal" => $enderecoNumeroPrincipal,
		"endereco_complemento_principal" => $enderecoComplementoPrincipal,
		"bairro_principal" => $bairroPrincipal,
		"cidade_principal" => $cidadePrincipal,
		"estado_principal" => $estadoPrincipal,
		"pais_principal" => $paisPrincipal,
		"id_config_bairro" => 0,
		"id_config_cidade" => 0,
		"id_config_estado" => 0,
		"id_config_regiao" => 0,
		"id_config_pais" => 0,
		"id_db_cep_tblBairros" => 0,
		"id_db_cep_tblCidades" => 0,
		"id_db_cep_tblLogradouros" => 0,
		"id_db_cep_tblUF" => '',
		"cep_principal" => $cepPrincipal,	
		"ponto_referencia" => $pontoReferencia,
		"email_principal" => $emailPrincipal,
		"tel_ddd_principal" => $telDDDPrincipal,
		"tel_principal" => $telPrincipal,
		"cel_ddd_principal" => $celDDDPrincipal,
		"cel_principal" => $celPrincipal,
		"fax_ddd_principal" => $faxDDDPrincipal,
		"fax_principal" => $faxPrincipal,
		"site_principal" => $sitePrincipal,
		"n_funcionarios" => $nFuncionarios,
		"obs_interno" => $obsInterno,
		"id_tb_cadastro1" => $idTbCadastro1,
		"id_tb_cadastro2" => $idTbCadastro2,
		"id_tb_cadastro3" => $idTbCadastro3,
		"id_tb_cadastro_status" => $idTbCadastroStatus,
		"ativacao" => $ativacao,
		"ativacao_destaque" => $ativacaoDestaque,
		"ativacao_mala_direta" => $ativacaoMalaDireta,
		"usuario" => $usuario,
		"senha" => $senha,
		"mapa_online" => $mapaOnline,
		"palavras_chave" => $palavrasChave,
		"apresentacao" => $apresentacao,
		"servicos" => $servicos,
		"promocoes" => $promocoes,
		"condicoes_comerciais" => $condicoesComerciais,
		"formas_pagamento" => $formasPagamento,
		"horario_atendimento" => $horarioAtendimento,
		"situacao_atual" => $situacaoAtual,		
		"informacao_complementar1" => $informacaoComplementar1,
		"informacao_complementar2" => $informacaoComplementar2,
		"informacao_complementar3" => $informacaoComplementar3,
		"informacao_complementar4" => $informacaoComplementar4,
		"informacao_complementar5" => $informacaoComplementar5,
		"informacao_complementar6" => $informacaoComplementar6,
		"informacao_complementar7" => $informacaoComplementar7,
		"informacao_complementar8" => $informacaoComplementar8,
		"informacao_complementar9" => $informacaoComplementar9,
		"informacao_complementar10" => $informacaoComplementar10,
		"informacao_complementar11" => $informacaoComplementar11,
		"informacao_complementar12" => $informacaoComplementar12,
		"informacao_complementar13" => $informacaoComplementar13,
		"informacao_complementar14" => $informacaoComplementar14,
		"informacao_complementar15" => $informacaoComplementar15,
		"informacao_complementar16" => $informacaoComplementar16,
		"informacao_complementar17" => $informacaoComplementar17,
		"informacao_complementar18" => $informacaoComplementar18,
		"informacao_complementar19" => $informacaoComplementar19,
		"informacao_complementar20" => $informacaoComplementar20,
		"informacao_complementar21" => $informacaoComplementar21,
		"informacao_complementar22" => $informacaoComplementar22,
		"informacao_complementar23" => $informacaoComplementar23,
		"informacao_complementar24" => $informacaoComplementar24,
		"informacao_complementar25" => $informacaoComplementar25,
		"informacao_complementar26" => $informacaoComplementar26,
		"informacao_complementar27" => $informacaoComplementar27,
		"informacao_complementar28" => $informacaoComplementar28,
		"informacao_complementar29" => $informacaoComplementar29,
		"informacao_complementar30" => $informacaoComplementar30,
		"informacao_complementar31" => $informacaoComplementar31,
		"informacao_complementar32" => $informacaoComplementar32,
		"informacao_complementar33" => $informacaoComplementar33,
		"informacao_complementar34" => $informacaoComplementar34,
		"informacao_complementar35" => $informacaoComplementar35,
		"informacao_complementar36" => $informacaoComplementar36,
		"informacao_complementar37" => $informacaoComplementar37,
		"informacao_complementar38" => $informacaoComplementar38,
		"informacao_complementar39" => $informacaoComplementar39,
		"informacao_complementar40" => $informacaoComplementar40,
		"n_visitas" => $nVisitas
	));
	*/
	$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus7");
}else{
	//echo "erro";
	$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus8");
}
//----------


//Limpeza de objetos.
//----------
unset($strSqlCadastroUpdate);
unset($statementCadastroUpdate);
//----------


//Gravação de complementos.
//----------
//Obs: Colocar um flag de verificação de gravação.

//Tipo.
if(in_array("tipo", $arrCadastroFormularioCampos) == true)
{
	//Limpeza dos registros anteriores.
	DbExcluir::ExcluirRegistrosGenerico02($id, 
										"tb_cadastro_relacao_complemento", 
										"id_tb_cadastro",
										"tipo_complemento", 
										"1");
	if(!empty($arrIdsCadastroTipo))
	{
		//echo "cheio";
		for($countArray = 0; $countArray < count($arrIdsCadastroTipo); $countArray++)
		{
			//echo "arrIdsCadastroTipo=" . $arrIdsCadastroTipo[$countArray] . "<br>";
			//echo "id=" . $id . "<br>";
			//echo "FiltrosGenericosGravar01=" . DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsCadastroTipo[$countArray], "1", "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento") . "<br>";
			DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsCadastroTipo[$countArray], "1", "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento");
		}
	}
}

//Atividades.
if(in_array("atividades", $arrCadastroFormularioCampos) == true)
{
	//Limpeza dos registros anteriores.
	DbExcluir::ExcluirRegistrosGenerico02($id, 
										"tb_cadastro_relacao_complemento", 
										"id_tb_cadastro",
										"tipo_complemento", 
										"2");
	//$arrIdsCadastroAtividades = $_POST["idsCadastroAtividades"];
	if(!empty($arrIdsCadastroAtividades))
	{
		for($countArray = 0; $countArray < count($arrIdsCadastroAtividades); $countArray++)
		{
			DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsCadastroAtividades[$countArray], "2", "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento");
		}
	}
}


//Filtro genérico 01.
if(in_array("ids_cadastro_filtro_generico01", $arrCadastroFormularioCampos) == true)
{
	//Limpeza dos registros anteriores.
	DbExcluir::ExcluirRegistrosGenerico02($id, 
										"tb_cadastro_relacao_complemento", 
										"id_tb_cadastro",
										"tipo_complemento", 
										"12");
	if(!empty($arrIdsCadastroFiltroGenerico01))
	{
		for($countArray = 0; $countArray < count($arrIdsCadastroFiltroGenerico01); $countArray++)
		{
			DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsCadastroFiltroGenerico01[$countArray], "12", "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento");
		}
	}
}


//Filtro genérico 02.
if(in_array("ids_cadastro_filtro_generico02", $arrCadastroFormularioCampos) == true)
{
	//Limpeza dos registros anteriores.
	DbExcluir::ExcluirRegistrosGenerico02($id, 
										"tb_cadastro_relacao_complemento", 
										"id_tb_cadastro",
										"tipo_complemento", 
										"13");
	if(!empty($arrIdsCadastroFiltroGenerico02))
	{
		for($countArray = 0; $countArray < count($arrIdsCadastroFiltroGenerico02); $countArray++)
		{
			DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsCadastroFiltroGenerico02[$countArray], "13", "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento");
		}
	}
}


//Filtro genérico 03.
if(in_array("ids_cadastro_filtro_generico03", $arrCadastroFormularioCampos) == true)
{
	//Limpeza dos registros anteriores.
	DbExcluir::ExcluirRegistrosGenerico02($id, 
										"tb_cadastro_relacao_complemento", 
										"id_tb_cadastro",
										"tipo_complemento", 
										"14");
	if(!empty($arrIdsCadastroFiltroGenerico03))
	{
		for($countArray = 0; $countArray < count($arrIdsCadastroFiltroGenerico03); $countArray++)
		{
			DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsCadastroFiltroGenerico03[$countArray], "14", "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento");
		}
	}
}


//Filtro genérico 04.
if(in_array("ids_cadastro_filtro_generico04", $arrCadastroFormularioCampos) == true)
{
	//Limpeza dos registros anteriores.
	DbExcluir::ExcluirRegistrosGenerico02($id, 
										"tb_cadastro_relacao_complemento", 
										"id_tb_cadastro",
										"tipo_complemento", 
										"15");
	if(!empty($arrIdsCadastroFiltroGenerico04))
	{
		for($countArray = 0; $countArray < count($arrIdsCadastroFiltroGenerico04); $countArray++)
		{
			DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsCadastroFiltroGenerico04[$countArray], "15", "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento");
		}
	}
}


//Filtro genérico 05.
if(in_array("ids_cadastro_filtro_generico05", $arrCadastroFormularioCampos) == true)
{
	//Limpeza dos registros anteriores.
	DbExcluir::ExcluirRegistrosGenerico02($id, 
										"tb_cadastro_relacao_complemento", 
										"id_tb_cadastro",
										"tipo_complemento", 
										"16");
	if(!empty($arrIdsCadastroFiltroGenerico05))
	{
		for($countArray = 0; $countArray < count($arrIdsCadastroFiltroGenerico05); $countArray++)
		{
			DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsCadastroFiltroGenerico05[$countArray], "16", "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento");
		}
	}
}


//Filtro genérico 06.
if(in_array("ids_cadastro_filtro_generico06", $arrCadastroFormularioCampos) == true)
{
	//Limpeza dos registros anteriores.
	DbExcluir::ExcluirRegistrosGenerico02($id, 
										"tb_cadastro_relacao_complemento", 
										"id_tb_cadastro",
										"tipo_complemento", 
										"17");
	if(!empty($arrIdsCadastroFiltroGenerico06))
	{
		for($countArray = 0; $countArray < count($arrIdsCadastroFiltroGenerico06); $countArray++)
		{
			DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsCadastroFiltroGenerico06[$countArray], "17", "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento");
		}
	}
}


//Filtro genérico 07.
if(in_array("ids_cadastro_filtro_generico07", $arrCadastroFormularioCampos) == true)
{
	//Limpeza dos registros anteriores.
	DbExcluir::ExcluirRegistrosGenerico02($id, 
										"tb_cadastro_relacao_complemento", 
										"id_tb_cadastro",
										"tipo_complemento", 
										"18");
	if(!empty($arrIdsCadastroFiltroGenerico07))
	{
		for($countArray = 0; $countArray < count($arrIdsCadastroFiltroGenerico07); $countArray++)
		{
			DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsCadastroFiltroGenerico07[$countArray], "18", "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento");
		}
	}
}


//Filtro genérico 08.
if(in_array("ids_cadastro_filtro_generico07", $arrCadastroFormularioCampos) == true)
{
	//Limpeza dos registros anteriores.
	DbExcluir::ExcluirRegistrosGenerico02($id, 
										"tb_cadastro_relacao_complemento", 
										"id_tb_cadastro",
										"tipo_complemento", 
										"19");
	if(!empty($arrIdsCadastroFiltroGenerico08))
	{
		for($countArray = 0; $countArray < count($arrIdsCadastroFiltroGenerico08); $countArray++)
		{
			DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsCadastroFiltroGenerico08[$countArray], "19", "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento");
		}
	}
}


//Filtro genérico 09.
if(in_array("ids_cadastro_filtro_generico09", $arrCadastroFormularioCampos) == true)
{
	//Limpeza dos registros anteriores.
	DbExcluir::ExcluirRegistrosGenerico02($id, 
										"tb_cadastro_relacao_complemento", 
										"id_tb_cadastro",
										"tipo_complemento", 
										"20");
	if(!empty($arrIdsCadastroFiltroGenerico09))
	{
		for($countArray = 0; $countArray < count($arrIdsCadastroFiltroGenerico09); $countArray++)
		{
			DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsCadastroFiltroGenerico09[$countArray], "20", "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento");
		}
	}
}


//Filtro genérico 10.
if(in_array("ids_cadastro_filtro_generico10", $arrCadastroFormularioCampos) == true)
{
	//Limpeza dos registros anteriores.
	DbExcluir::ExcluirRegistrosGenerico02($id, 
										"tb_cadastro_relacao_complemento", 
										"id_tb_cadastro",
										"tipo_complemento", 
										"21");
	if(!empty($arrIdsCadastroFiltroGenerico10))
	{
		for($countArray = 0; $countArray < count($arrIdsCadastroFiltroGenerico10); $countArray++)
		{
			DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsCadastroFiltroGenerico10[$countArray], "21", "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento");
		}
	}
}
//----------


//Upload de arquivos.
//----------
if(in_array("imagem", $arrCadastroFormularioCampos) == true)
{
	if(!empty($_FILES["ArquivoUpload1"]["name"])) //Verifica se arquivos foram postados.
	{
	
		//Definição do tamanho das imagens.
		$arrImagemTamanhos = $GLOBALS['arrImagemCadastro'];
		if($GLOBALS['ativacaoImagensPadrao'] == 1)
		{
			$arrImagemTamanhos = $GLOBALS['arrImagemPadrao'];
		}
		
		//Definição do diretório de upload.
		$arquivosDiretorioUpload = $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos'];
		
		//Definição do nome do arquivo.
		$arrArquivoExtensao = explode(".", $_FILES["ArquivoUpload1"]["name"]);
		$arquivoExtensao = strtolower(end($arrArquivoExtensao));
		$arquivoNome = $id . "." . $arquivoExtensao;
		
		
		//Gravação do arquivo original no servidor.
		if(strpos($GLOBALS['configImagensFormatos'], $arquivoExtensao) !== false) {
			$resultadoUpload = Arquivo::ArquivoUpload($id, 
													$_FILES["ArquivoUpload1"], 
													$arquivosDiretorioUpload,
													"o" . $arquivoNome);
		}else{
			$resultadoUpload = Arquivo::ArquivoUpload($id, 
													$_FILES["ArquivoUpload1"], 
													$arquivosDiretorioUpload,
													"" . $arquivoNome);
		}
	
		if($resultadoUpload == true){
		
		}else{
			$mensagemErro .= $resultadoUpload;
			//$mensagemSucesso = "";
		}
		
		
		//Verificação de formato do arquivo.
		if(strpos($GLOBALS['configImagensFormatos'], $arquivoExtensao) !== false) {
			//Redimensionamento de arquivos.
			Imagem::ImagemRedimensionar01($arrImagemTamanhos, 
										$arquivosDiretorioUpload, 
										$arquivoNome);
		}else{
			$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus19");
			//$mensagemSucesso = "";
		}
		
		
		//Update do registro com o nome do arquivo.
		$resultadoUpdate = DbUpdate::DbRegistroGenericoUpdate01($arquivoNome, $id, "tb_cadastro", "imagem");
		if ($resultadoUpdate == true) 
		{
		
		}else{
			$mensagemErro .= $resultadoUpdate;
			//$mensagemSucesso = "";
		}
	}
}
//----------


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
//$dbSistemaConMysqli->close();
$dbSistemaConPDO = null;


//Montagem do URL de retorno.
//$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
$URLRetorno = $configUrl . "/" . $visualizacaoAtivaSistema . "/" . $paginaRetorno . "?" .
"idParentCadastro=" . $idTbCategorias .
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