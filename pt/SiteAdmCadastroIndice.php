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
$idTbCadastroLogin = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura(CookiesFuncoes::CookieValorLer_Login()), 2);

$idParentCadastro = $_GET["idParentCadastro"];
$idTipoCadastro = $_GET["idTipoCadastro"];
$idTbCadastro1 = $_GET["idTbCadastro1"];

$idTbCadastro = $_GET["idTbCadastro"];
$nome = $_GET["nome"];
$cpf_ = Funcoes::SomenteNum($_GET["cpf_"]);
$data6 = $_GET["data6"]; //"2016-11-06"; //Debug.

//$flagBusca = $_GET["flagBusca"];

//$idTbCadastro1 = $_GET["idTbCadastro1"];
//$idTbCadastro1 = $idTbCadastroLogin;
$palavraChave = $_GET["palavraChave"];

//$idTbCadastro = $_GET["idTbCadastro"];
//Scroll de arrays.
//----------
/*
if($idTbCadastro <> "")
{

}else{
	//$idTbCadastro = "0";
	$idTbCadastro = DbFuncoes::GetCampoGenerico06("tb_cadastro",
												"id",
												"id_tb_categorias",
												$idParentCadastro,
												"",
												"",
												2,
												"",
												"",
												"ativacao",
												"1",
												"id_tb_cadastro1",
												$idTbCadastroLogin);
}

$idsTbCadastroClientes = DbFuncoes::GetCampoGenerico06("tb_cadastro",
														"id",
														"id_tb_categorias",
														$idParentCadastro,
														"",
														"",
														1,
														"",
														"",
														"ativacao",
														"1",
														"id_tb_cadastro1",
														$idTbCadastroLogin);

if($idsTbCadastroClientes <> "")
{
	$idTbCadastroPrimeiro = Funcoes::ConteudoRetornoArrayScroll01($idsTbCadastroClientes, $idTbCadastro, 1, ",");
	$idTbCadastroUltimo = Funcoes::ConteudoRetornoArrayScroll01($idsTbCadastroClientes, $idTbCadastro, 2, ",");
	$idTbCadastroAnterior = Funcoes::ConteudoRetornoArrayScroll01($idsTbCadastroClientes, $idTbCadastro, 3, ",");
	$idTbCadastroProximo = Funcoes::ConteudoRetornoArrayScroll01($idsTbCadastroClientes, $idTbCadastro, 4, ",");
}

if($idTbCadastro == "")
{
	$idTbCadastro = "0";
}
*/
//----------



$idsTbCadastroComplemento = $_GET["idsTbCadastroComplemento"];
if(is_array($idsTbCadastroComplemento) == true)
{
	//$idsTbCadastroComplemento = implode(",", $_GET["idsTbCadastroComplemento"]);
	$idsTbCadastroComplemento = implode(",", $idsTbCadastroComplemento);
}
if($idsTbCadastroComplemento <> "")
{
	if($idsTbCadastro <> "")
	{
		$idsTbCadastro .= "," . DbFuncoes::GetIdsByTipoComplemento_FromArray($idsTbCadastroComplemento, 
																			"tb_cadastro_relacao_complemento", 
																			"id_tb_cadastro_complemento", 
																			"id_tb_cadastro");
	}else{
		$idsTbCadastro .= DbFuncoes::GetIdsByTipoComplemento_FromArray($idsTbCadastroComplemento, 
																		"tb_cadastro_relacao_complemento", 
																		"id_tb_cadastro_complemento", 
																		"id_tb_cadastro");
	}
	
	if($idsTbCadastro == "")
	{
		$idsTbCadastro = "0";
	}
}

//Busca detalhada - filtros.
$arrIdsCadastroFiltroGenerico = array();

$arrIdsCadastroTipo = $_GET["idsCadastroTipo"];

$arrIdsCadastroFiltroGenerico01 = $_GET["idsCadastroFiltroGenerico01"];
$arrIdsCadastroFiltroGenerico02 = $_GET["idsCadastroFiltroGenerico02"];
$arrIdsCadastroFiltroGenerico03 = $_GET["idsCadastroFiltroGenerico03"];
$arrIdsCadastroFiltroGenerico04 = $_GET["idsCadastroFiltroGenerico04"];
$arrIdsCadastroFiltroGenerico05 = $_GET["idsCadastroFiltroGenerico05"];
$arrIdsCadastroFiltroGenerico06 = $_GET["idsCadastroFiltroGenerico06"];
$arrIdsCadastroFiltroGenerico07 = $_GET["idsCadastroFiltroGenerico07"];
$arrIdsCadastroFiltroGenerico08 = $_GET["idsCadastroFiltroGenerico08"];
$arrIdsCadastroFiltroGenerico09 = $_GET["idsCadastroFiltroGenerico09"];
$arrIdsCadastroFiltroGenerico10 = $_GET["idsCadastroFiltroGenerico10"];
$arrIdsCadastroFiltroGenerico11 = $_GET["idsCadastroFiltroGenerico11"];
$arrIdsCadastroFiltroGenerico12 = $_GET["idsCadastroFiltroGenerico12"];
$arrIdsCadastroFiltroGenerico13 = $_GET["idsCadastroFiltroGenerico13"];
$arrIdsCadastroFiltroGenerico14 = $_GET["idsCadastroFiltroGenerico14"];
$arrIdsCadastroFiltroGenerico15 = $_GET["idsCadastroFiltroGenerico15"];
$arrIdsCadastroFiltroGenerico16 = $_GET["idsCadastroFiltroGenerico16"];
$arrIdsCadastroFiltroGenerico17 = $_GET["idsCadastroFiltroGenerico17"];
$arrIdsCadastroFiltroGenerico18 = $_GET["idsCadastroFiltroGenerico18"];
$arrIdsCadastroFiltroGenerico19 = $_GET["idsCadastroFiltroGenerico19"];
$arrIdsCadastroFiltroGenerico20 = $_GET["idsCadastroFiltroGenerico20"];


//Combinar arrays.
if(!empty($arrIdsCadastroTipo))
{
	//array_merge($arrIdsCadastroFiltroGenerico, $arrIdsCadastroFiltroGenerico01);
	$arrIdsCadastroFiltroGenerico = $arrIdsCadastroFiltroGenerico + $arrIdsCadastroTipo;
}

if(!empty($arrIdsCadastroFiltroGenerico01))
{
	//array_merge($arrIdsCadastroFiltroGenerico, $arrIdsCadastroFiltroGenerico01);
	$arrIdsCadastroFiltroGenerico = $arrIdsCadastroFiltroGenerico + $arrIdsCadastroFiltroGenerico01;
}
if(!empty($arrIdsCadastroFiltroGenerico02))
{
	$arrIdsCadastroFiltroGenerico = $arrIdsCadastroFiltroGenerico + $arrIdsCadastroFiltroGenerico02;
}
if(!empty($arrIdsCadastroFiltroGenerico03))
{
	$arrIdsCadastroFiltroGenerico = $arrIdsCadastroFiltroGenerico + $arrIdsCadastroFiltroGenerico03;
}
if(!empty($arrIdsCadastroFiltroGenerico04))
{
	$arrIdsCadastroFiltroGenerico = $arrIdsCadastroFiltroGenerico + $arrIdsCadastroFiltroGenerico04;
}
if(!empty($arrIdsCadastroFiltroGenerico05))
{
	$arrIdsCadastroFiltroGenerico = $arrIdsCadastroFiltroGenerico + $arrIdsCadastroFiltroGenerico05;
}
if(!empty($arrIdsCadastroFiltroGenerico06))
{
	$arrIdsCadastroFiltroGenerico = $arrIdsCadastroFiltroGenerico + $arrIdsCadastroFiltroGenerico06;
}
if(!empty($arrIdsCadastroFiltroGenerico07))
{
	$arrIdsCadastroFiltroGenerico = $arrIdsCadastroFiltroGenerico + $arrIdsCadastroFiltroGenerico07;
}
if(!empty($arrIdsCadastroFiltroGenerico08))
{
	$arrIdsCadastroFiltroGenerico = $arrIdsCadastroFiltroGenerico + $arrIdsCadastroFiltroGenerico08;
}
if(!empty($arrIdsCadastroFiltroGenerico09))
{
	$arrIdsCadastroFiltroGenerico = $arrIdsCadastroFiltroGenerico + $arrIdsCadastroFiltroGenerico09;
}
if(!empty($arrIdsCadastroFiltroGenerico10))
{
	$arrIdsCadastroFiltroGenerico = $arrIdsCadastroFiltroGenerico + $arrIdsCadastroFiltroGenerico10;
}
if(!empty($arrIdsCadastroFiltroGenerico11))
{
	$arrIdsCadastroFiltroGenerico = $arrIdsCadastroFiltroGenerico + $arrIdsCadastroFiltroGenerico11;
}
if(!empty($arrIdsCadastroFiltroGenerico12))
{
	$arrIdsCadastroFiltroGenerico = $arrIdsCadastroFiltroGenerico + $arrIdsCadastroFiltroGenerico12;
}
if(!empty($arrIdsCadastroFiltroGenerico13))
{
	$arrIdsCadastroFiltroGenerico = $arrIdsCadastroFiltroGenerico + $arrIdsCadastroFiltroGenerico13;
}
if(!empty($arrIdsCadastroFiltroGenerico14))
{
	$arrIdsCadastroFiltroGenerico = $arrIdsCadastroFiltroGenerico + $arrIdsCadastroFiltroGenerico14;
}
if(!empty($arrIdsCadastroFiltroGenerico15))
{
	$arrIdsCadastroFiltroGenerico = $arrIdsCadastroFiltroGenerico + $arrIdsCadastroFiltroGenerico15;
}
if(!empty($arrIdsCadastroFiltroGenerico16))
{
	$arrIdsCadastroFiltroGenerico = $arrIdsCadastroFiltroGenerico + $arrIdsCadastroFiltroGenerico16;
}
if(!empty($arrIdsCadastroFiltroGenerico17))
{
	$arrIdsCadastroFiltroGenerico = $arrIdsCadastroFiltroGenerico + $arrIdsCadastroFiltroGenerico17;
}
if(!empty($arrIdsCadastroFiltroGenerico18))
{
	$arrIdsCadastroFiltroGenerico = $arrIdsCadastroFiltroGenerico + $arrIdsCadastroFiltroGenerico18;
}
if(!empty($arrIdsCadastroFiltroGenerico19))
{
	$arrIdsCadastroFiltroGenerico = $arrIdsCadastroFiltroGenerico + $arrIdsCadastroFiltroGenerico19;
}
if(!empty($arrIdsCadastroFiltroGenerico20))
{
	$arrIdsCadastroFiltroGenerico = $arrIdsCadastroFiltroGenerico + $arrIdsCadastroFiltroGenerico20;
}

if(!empty($arrIdsCadastroFiltroGenerico))
{
	/**/
	if($idsTbCadastro <> "")
	{
		//Lógica or.
		/*$idsTbCadastro .= "," . DbFuncoes::GetIdsByTipoComplemento_FromArray(implode(",",$arrIdsCadastroFiltroGenerico), 
																			"tb_cadastro_relacao_complemento", 
																			"id_tb_cadastro_complemento", 
																			"id_tb_cadastro");*/
																			
		//Lógica and.
		$idsTbCadastro .= "," . DbFuncoes::GetIdsByTipoComplemento_FromArray02(implode(",",$arrIdsCadastroFiltroGenerico), 
																			"tb_cadastro_relacao_complemento", 
																			"id_tb_cadastro_complemento", 
																			"id_tb_cadastro", 
																			"2");
	}else{
		//Lógica or.
		/*$idsTbCadastro .= DbFuncoes::GetIdsByTipoComplemento_FromArray(implode(",",$arrIdsCadastroFiltroGenerico), 
																		"tb_cadastro_relacao_complemento", 
																		"id_tb_cadastro_complemento", 
																		"id_tb_cadastro");*/
																		
		//Lógica and.
		$idsTbCadastro .= DbFuncoes::GetIdsByTipoComplemento_FromArray02(implode(",",$arrIdsCadastroFiltroGenerico), 
																		"tb_cadastro_relacao_complemento", 
																		"id_tb_cadastro_complemento", 
																		"id_tb_cadastro", 
																		"2");
	}
	
	if($idsTbCadastro == "")
	{
		$idsTbCadastro = "0";
	}
}


$paginaRetorno = "SiteAdmCadastroIndice.php";
$paginaRetornoExclusao = "SiteAdmCadastroEditar.php";
$variavelRetorno = "idParentCadastro";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];

//Paginação.
if($GLOBALS['habilitarCadastroSistemaPaginacao'] == "1"){
	$paginacaoNRegistros = $GLOBALS['configCadastroSistemaPaginacaoNRegistros'];
	$paginacaoNumero = $_GET["paginacaoNumero"];
	if($paginacaoNumero == "")
	{
		$paginacaoNumero = 1;
	}
	//$paginacaoTotalRegistros = DbFuncoes::CountRegistrosGenericos("tb_cadastro", "id_tb_categorias", $idParentCadastro); //Quantidade de registros.
	//$paginacaoTotal = ceil($paginacaoTotalRegistros / $paginacaoNRegistros);
	$paginacaoInicio = ($paginacaoNumero-1) * $paginacaoNRegistros;
}

//Montagem de query padrão de retorno.
$queryPadrao = "&idParentCadastro=" . $idParentCadastro . 
"&paginaRetorno=" . $paginaRetorno . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&variavelRetorno=" . $variavelRetorno . 
"&masterPageSiteSelect=" . $masterPageSiteSelect . 
"&palavraChave=" . $palavraChave;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Definição dos campos do formulário de acordo com o tipo de cadastro.
$configCadastroFormularioCampos = Formularios::CadastroFormulariosCampos($idTipoCadastro);
$arrCadastroFormularioCampos = explode(",", $configCadastroFormularioCampos);
//$arrCadastroFormularioCampos = Formularios::CadastroFormulariosCampos($idTipoCadastro);
//print_r("$arrCadastroFormularioCampos=" . $arrCadastroFormularioCampos);
//echo "configCadastroFormularioCampos=" . $configCadastroFormularioCampos;


//Query de pesquisa.
//----------
$strSqlCadastroSelect = "";
$strSqlCadastroSelect .= "SELECT ";
$strSqlCadastroSelect .= "id, ";
$strSqlCadastroSelect .= "id_tb_categorias, ";
//$strSqlCadastroSelect .= "id_parent_cadastro, ";
$strSqlCadastroSelect .= "data_cadastro, ";
$strSqlCadastroSelect .= "pf_pj, ";
$strSqlCadastroSelect .= "nome, ";
$strSqlCadastroSelect .= "sexo, ";
$strSqlCadastroSelect .= "altura, ";
$strSqlCadastroSelect .= "peso, ";
$strSqlCadastroSelect .= "razao_social, ";
$strSqlCadastroSelect .= "nome_fantasia, ";

$strSqlCadastroSelect .= "data_nascimento, ";
$strSqlCadastroSelect .= "data1, ";
$strSqlCadastroSelect .= "data2, ";
$strSqlCadastroSelect .= "data3, ";
$strSqlCadastroSelect .= "data4, ";
$strSqlCadastroSelect .= "data5, ";
$strSqlCadastroSelect .= "data6, ";
$strSqlCadastroSelect .= "data7, ";
$strSqlCadastroSelect .= "data8, ";
$strSqlCadastroSelect .= "data9, ";
$strSqlCadastroSelect .= "data10, ";

$strSqlCadastroSelect .= "cpf_, ";
$strSqlCadastroSelect .= "rg_, ";
$strSqlCadastroSelect .= "cnpj_, ";
$strSqlCadastroSelect .= "documento, ";
$strSqlCadastroSelect .= "i_municipal, ";
$strSqlCadastroSelect .= "i_estadual, ";

$strSqlCadastroSelect .= "endereco_principal, ";
$strSqlCadastroSelect .= "endereco_numero_principal, ";
$strSqlCadastroSelect .= "endereco_complemento_principal, ";
$strSqlCadastroSelect .= "bairro_principal, ";
$strSqlCadastroSelect .= "cidade_principal, ";
$strSqlCadastroSelect .= "estado_principal, ";
$strSqlCadastroSelect .= "pais_principal, ";
$strSqlCadastroSelect .= "cep_principal, ";

$strSqlCadastroSelect .= "ponto_referencia, ";
$strSqlCadastroSelect .= "email_principal, ";
$strSqlCadastroSelect .= "tel_ddd_principal, ";
$strSqlCadastroSelect .= "tel_principal, ";
$strSqlCadastroSelect .= "cel_ddd_principal, ";
$strSqlCadastroSelect .= "cel_principal, ";
$strSqlCadastroSelect .= "fax_ddd_principal, ";
$strSqlCadastroSelect .= "fax_principal, ";
$strSqlCadastroSelect .= "site_principal, ";
$strSqlCadastroSelect .= "n_funcionarios, ";
$strSqlCadastroSelect .= "obs_interno, ";
$strSqlCadastroSelect .= "id_tb_cadastro_status, ";
//$strSqlCadastroSelect .= "id_tb_cadastro, ";
$strSqlCadastroSelect .= "id_tb_cadastro1, ";
$strSqlCadastroSelect .= "id_tb_cadastro2, ";
$strSqlCadastroSelect .= "id_tb_cadastro3, ";
$strSqlCadastroSelect .= "ativacao, ";
$strSqlCadastroSelect .= "ativacao_destaque, ";
$strSqlCadastroSelect .= "ativacao_mala_direta, ";
$strSqlCadastroSelect .= "usuario, ";
$strSqlCadastroSelect .= "senha, ";

$strSqlCadastroSelect .= "imagem, ";
$strSqlCadastroSelect .= "logo, ";
$strSqlCadastroSelect .= "banner, ";
$strSqlCadastroSelect .= "mapa, ";

$strSqlCadastroSelect .= "mapa_online, ";
$strSqlCadastroSelect .= "palavras_chave, ";
$strSqlCadastroSelect .= "apresentacao, ";
$strSqlCadastroSelect .= "servicos, ";
$strSqlCadastroSelect .= "promocoes, ";
$strSqlCadastroSelect .= "condicoes_comerciais, ";
$strSqlCadastroSelect .= "formas_pagamento, ";
$strSqlCadastroSelect .= "horario_atendimento, ";
$strSqlCadastroSelect .= "situacao_atual, ";

$strSqlCadastroSelect .= "informacao_complementar1, ";
$strSqlCadastroSelect .= "informacao_complementar2, ";
$strSqlCadastroSelect .= "informacao_complementar3, ";
$strSqlCadastroSelect .= "informacao_complementar4, ";
$strSqlCadastroSelect .= "informacao_complementar5, ";
$strSqlCadastroSelect .= "informacao_complementar6, ";
$strSqlCadastroSelect .= "informacao_complementar7, ";
$strSqlCadastroSelect .= "informacao_complementar8, ";
$strSqlCadastroSelect .= "informacao_complementar9, ";
$strSqlCadastroSelect .= "informacao_complementar10, ";
$strSqlCadastroSelect .= "informacao_complementar11, ";
$strSqlCadastroSelect .= "informacao_complementar12, ";
$strSqlCadastroSelect .= "informacao_complementar13, ";
$strSqlCadastroSelect .= "informacao_complementar14, ";
$strSqlCadastroSelect .= "informacao_complementar15, ";
$strSqlCadastroSelect .= "informacao_complementar16, ";
$strSqlCadastroSelect .= "informacao_complementar17, ";
$strSqlCadastroSelect .= "informacao_complementar18, ";
$strSqlCadastroSelect .= "informacao_complementar19, ";
$strSqlCadastroSelect .= "informacao_complementar20, ";
$strSqlCadastroSelect .= "informacao_complementar21, ";
$strSqlCadastroSelect .= "informacao_complementar22, ";
$strSqlCadastroSelect .= "informacao_complementar23, ";
$strSqlCadastroSelect .= "informacao_complementar24, ";
$strSqlCadastroSelect .= "informacao_complementar25, ";
$strSqlCadastroSelect .= "informacao_complementar26, ";
$strSqlCadastroSelect .= "informacao_complementar27, ";
$strSqlCadastroSelect .= "informacao_complementar28, ";
$strSqlCadastroSelect .= "informacao_complementar29, ";
$strSqlCadastroSelect .= "informacao_complementar30, ";
$strSqlCadastroSelect .= "informacao_complementar31, ";
$strSqlCadastroSelect .= "informacao_complementar32, ";
$strSqlCadastroSelect .= "informacao_complementar33, ";
$strSqlCadastroSelect .= "informacao_complementar34, ";
$strSqlCadastroSelect .= "informacao_complementar35, ";
$strSqlCadastroSelect .= "informacao_complementar36, ";
$strSqlCadastroSelect .= "informacao_complementar37, ";
$strSqlCadastroSelect .= "informacao_complementar38, ";
$strSqlCadastroSelect .= "informacao_complementar39, ";
$strSqlCadastroSelect .= "informacao_complementar40, ";
$strSqlCadastroSelect .= "n_visitas ";

//Paginação (subquery).
if($GLOBALS['habilitarCadastroSistemaPaginacao'] == "1"){
	//$strSqlCadastroSelect .= ",(SELECT COUNT(*) ";
	$strSqlCadastroSelect .= ", (SELECT COUNT(id) ";
	$strSqlCadastroSelect .= "FROM tb_cadastro ";
	$strSqlCadastroSelect .= "WHERE id <> 0 ";
	if($idTbCadastro <> "")
	{
		$strSqlCadastroSelect .= "AND id = :id ";
	}
	if($idsTbCadastro <> "")
	{
		$strSqlCadastroSelect .= "AND id IN (" . Funcoes::ConteudoMascaraGravacao01($idsTbCadastro) . ") ";
	}
	if($idParentCadastro <> "")
	{
		$strSqlCadastroSelect .= "AND id_tb_categorias = :id_tb_categorias ";
	}
	if($nome <> "")
	{
		$strSqlCadastroSelect .= "AND nome LIKE '%" . Funcoes::ConteudoMascaraGravacao01($nome) . "%' ";
	}
	if($cpf_ <> "")
	{
		$strSqlCadastroSelect .= "AND cpf_ = :cpf_ ";
	}
	if($idTbCadastro1 <> "")
	{
		$strSqlCadastroSelect .= "AND id_tb_cadastro1 = :id_tb_cadastro1 ";
	}
	if($data6 <> "")
	{
		//$strSqlCadastroSelect .= "AND data6 = '" . $data6 . "' ";
		$strSqlCadastroSelect .= "AND data6 = :data6 ";
	}
	if($idTbCadastro1 <> "")
	{
		$statementCadastroSelect .= "AND id_tb_cadastro1 = :id_tb_cadastro1 ";
	}
	if($palavraChave <> "")
	{
		
		///*
		$strSqlCadastroSelect .= "AND (nome LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		///*
		$strSqlCadastroSelect .= "OR razao_social LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR nome_fantasia LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR cpf_ LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR rg_ LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR cnpj_ LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR endereco_principal LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR endereco_numero_principal LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR endereco_complemento_principal LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR bairro_principal LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR cidade_principal LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR estado_principal LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR pais_principal LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR cep_principal LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR email_principal LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR tel_principal LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR cel_principal LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR fax_principal LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR site_principal LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR obs_interno LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR palavras_chave LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR apresentacao LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR servicos LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR promocoes LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR condicoes_comerciais LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR formas_pagamento LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR horario_atendimento LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR situacao_atual LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar1 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar2 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar3 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar4 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar5 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar6 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar7 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar8 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar9 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar10 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar11 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar12 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar13 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar14 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar15 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar16 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar17 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar18 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar19 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar20 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar21 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar22 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar23 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar24 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar25 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar26 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar27 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar28 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar29 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar30 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar31 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar32 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar33 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar34 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar35 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar36 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar37 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar38 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar39 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar40 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		//*/
		$strSqlCadastroSelect .= ") ";
		//*/
	}
	$strSqlCadastroSelect .= ") totalRegistros ";
}

$strSqlCadastroSelect .= "FROM tb_cadastro ";
$strSqlCadastroSelect .= "WHERE id <> 0 ";
if($idTbCadastro <> "")
{
	$strSqlCadastroSelect .= "AND id = :id ";
}
if($idsTbCadastro <> "")
{
	$strSqlCadastroSelect .= "AND id IN (" . Funcoes::ConteudoMascaraGravacao01($idsTbCadastro) . ") ";
}
if($idParentCadastro <> "")
{
	$strSqlCadastroSelect .= "AND id_tb_categorias = :id_tb_categorias ";
}
if($nome <> "")
{
	$strSqlCadastroSelect .= "AND nome LIKE '%" . Funcoes::ConteudoMascaraGravacao01($nome) . "%' ";
}
if($cpf_ <> "")
{
	$strSqlCadastroSelect .= "AND cpf_ = :cpf_ ";
}
if($idTbCadastro1 <> "")
{
	$strSqlCadastroSelect .= "AND id_tb_cadastro1 = :id_tb_cadastro1 ";
}
if($data6 <> "")
{
	//$strSqlCadastroSelect .= "AND data6 = '" . $data6 . "' ";
	$strSqlCadastroSelect .= "AND data6 = :data6 ";
}
if($idTbCadastro1 <> "")
{
	$statementCadastroSelect .= "AND id_tb_cadastro1 = :id_tb_cadastro1 ";
}
if($palavraChave <> "")
{
	
	///*
	$strSqlCadastroSelect .= "AND (nome LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	///*
	$strSqlCadastroSelect .= "OR razao_social LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroSelect .= "OR nome_fantasia LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroSelect .= "OR cpf_ LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroSelect .= "OR rg_ LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroSelect .= "OR cnpj_ LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroSelect .= "OR endereco_principal LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroSelect .= "OR endereco_numero_principal LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroSelect .= "OR endereco_complemento_principal LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroSelect .= "OR bairro_principal LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroSelect .= "OR cidade_principal LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroSelect .= "OR estado_principal LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroSelect .= "OR pais_principal LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroSelect .= "OR cep_principal LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroSelect .= "OR email_principal LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroSelect .= "OR tel_principal LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroSelect .= "OR cel_principal LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroSelect .= "OR fax_principal LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroSelect .= "OR site_principal LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroSelect .= "OR obs_interno LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroSelect .= "OR palavras_chave LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroSelect .= "OR apresentacao LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroSelect .= "OR servicos LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroSelect .= "OR promocoes LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroSelect .= "OR condicoes_comerciais LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroSelect .= "OR formas_pagamento LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroSelect .= "OR horario_atendimento LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroSelect .= "OR situacao_atual LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroSelect .= "OR informacao_complementar1 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroSelect .= "OR informacao_complementar2 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroSelect .= "OR informacao_complementar3 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroSelect .= "OR informacao_complementar4 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroSelect .= "OR informacao_complementar5 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroSelect .= "OR informacao_complementar6 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroSelect .= "OR informacao_complementar7 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroSelect .= "OR informacao_complementar8 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroSelect .= "OR informacao_complementar9 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroSelect .= "OR informacao_complementar10 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroSelect .= "OR informacao_complementar11 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroSelect .= "OR informacao_complementar12 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroSelect .= "OR informacao_complementar13 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroSelect .= "OR informacao_complementar14 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroSelect .= "OR informacao_complementar15 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroSelect .= "OR informacao_complementar16 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroSelect .= "OR informacao_complementar17 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroSelect .= "OR informacao_complementar18 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroSelect .= "OR informacao_complementar19 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroSelect .= "OR informacao_complementar20 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroSelect .= "OR informacao_complementar21 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroSelect .= "OR informacao_complementar22 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroSelect .= "OR informacao_complementar23 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroSelect .= "OR informacao_complementar24 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroSelect .= "OR informacao_complementar25 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroSelect .= "OR informacao_complementar26 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroSelect .= "OR informacao_complementar27 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroSelect .= "OR informacao_complementar28 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroSelect .= "OR informacao_complementar29 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroSelect .= "OR informacao_complementar30 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroSelect .= "OR informacao_complementar31 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroSelect .= "OR informacao_complementar32 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroSelect .= "OR informacao_complementar33 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroSelect .= "OR informacao_complementar34 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroSelect .= "OR informacao_complementar35 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroSelect .= "OR informacao_complementar36 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroSelect .= "OR informacao_complementar37 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroSelect .= "OR informacao_complementar38 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroSelect .= "OR informacao_complementar39 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroSelect .= "OR informacao_complementar40 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	//*/
	$strSqlCadastroSelect .= ") ";
	//*/
}

//$strSqlCadastroSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
//if($GLOBALS['habilitarCadastroClassificacaoPersonalizada'] == 1 and DbFuncoes::GetCampoGenerico04("classificacao", "criterio_classificacao", "id_registro", $idParentCadastro) <> "")
//{
	//$strSqlCadastroSelect .= "ORDER BY " . DbFuncoes::GetCampoGenerico04("classificacao", "criterio_classificacao", "id_registro", $idParentCadastro) . " ";
	
//}else{
	$strSqlCadastroSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
//}

//Paginação.
if($GLOBALS['habilitarCadastroSistemaPaginacao'] == "1"){ 
	if($configTipoDB == 2)
	{
		$strSqlCadastroSelect .= "LIMIT " . $paginacaoInicio . ", " . $paginacaoNRegistros . "";
	}
}
//----------


//Componentes e parâmetros.
//----------
$statementCadastroSelect = $dbSistemaConPDO->prepare($strSqlCadastroSelect);

if ($statementCadastroSelect !== false)
{
	if($idTbCadastro <> "")
	{
		$statementCadastroSelect->bindParam(':id', $idTbCadastro, PDO::PARAM_STR);
	}
	if($idParentCadastro <> "")
	{
		$statementCadastroSelect->bindParam(':id_tb_categorias', $idParentCadastro, PDO::PARAM_STR);
	}
	if($nome <> "")
	{
		//$statementCadastroSelect->bindParam(':nome', $nome, PDO::PARAM_STR);
	}
	if($cpf_ <> "")
	{
		$statementCadastroSelect->bindParam(':cpf_', $cpf_, PDO::PARAM_STR);
	}
	if($idTbCadastro1 <> "")
	{
		$statementCadastroSelect->bindParam(':id_tb_cadastro1', $idTbCadastro1, PDO::PARAM_STR);
	}
	if($data6 <> "")
	{
		$statementCadastroSelect->bindParam(':data6', $data6, PDO::PARAM_STR);
		//$statementCadastroSelect->bindParam(':data6', date("Y-m-d", strtotime($data6)), PDO::PARAM_STR);
	}
	if($idTbCadastro1 <> "")
	{
		$statementCadastroSelect->bindParam(':id_tb_cadastro1', $idTbCadastro1, PDO::PARAM_STR);
	}
	$statementCadastroSelect->execute();
	/*
	$statementCadastroSelect->execute(array(
		"id_tb_categorias" => $idParentCadastro
	));
	*/
}

//$resultadoCadastro = $dbSistemaConPDO->query($strSqlCadastroSelect);
$resultadoCadastro = $statementCadastroSelect->fetchAll();
//----------


//Paginação.
if($GLOBALS['habilitarCadastroSistemaPaginacao'] == "1"){
	//$paginacaoTotalRegistros = DbFuncoes::CountRegistrosGenericos("tb_cadastro", "id_tb_categorias", $idParentCadastro); //Quantidade de registros.
	//$paginacaoTotalRegistros = DbFuncoes::CountRegistrosGenericos("tb_cadastro", "id_tb_categorias", $idParentCadastro, "", "", "", "", "", ""); //Quantidade de registros.
	$paginacaoTotalRegistros = $resultadoCadastro[0]['totalRegistros'];
	$paginacaoTotal = ceil($paginacaoTotalRegistros / $paginacaoNRegistros);
}


?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloSite'], "IncludeConfig"); ?> - <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAdmPainelCadastroAdministrar"); ?>
<?php 
$pageSite->cphTitle = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Head.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphHead*/ ?>
    <meta name="description" content="" /><?php //Abaixo de 160 caracteres.?>
    <meta name="keywords" content="" /><?php //Abaixo de 100 caracteres.?>
    <meta name="title" content="" /><?php //Abaixo de 60 caracteres.?>
<?php 
$pageSite->cphHead = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Título atual.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphConteudoCabecalho*/ ?>
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAdmPainelCadastroAdministrar"); ?>
<?php 
$pageSite->cphTituloLinkAtual = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Conteúdo principal.?>
<?php //**************************************************************************************?>
<?php ob_start(); /*cphConteudoPrincipal*/ ?>
    <div align="center" class="AdmErro">
        <?php echo $mensagemErro;?>
    </div>
    <div align="center" class="AdmSucesso">
        <?php echo $mensagemSucesso;?>
    </div>
    
    
	<?php //Opções gerais.?>
    <?php //----------------------?>
    <?php 
	//Definição de variáveis do include.
	$includeAdmOpcoes_tipoOpcoes = "1";
	$includeAdmOpcoes_configOpcoes = "";
	?>
    
    <?php include "IncludeAdmOpcoes.php";?>
    <?php //----------------------?>
    
    
    <br />
	<?php //Opções principais.?>
    <?php //----------------------?>
    <?php 
	//Definição de variáveis do include.
	$includeAdmOpcoes_tipoOpcoes = "2";
	$includeAdmOpcoes_configOpcoes = "";
	?>
    
    <?php include "IncludeAdmOpcoes.php";?>
    <?php //----------------------?>

    
    <br />
	<?php //Opções de informações complementares.?>
    <?php //----------------------?>
    <?php 
	//Definição de variáveis do include.
	$includeAdmOpcoes_tipoOpcoes = "ic1";
	$includeAdmOpcoes_configOpcoes = "";
	?>
    
    <?php include "IncludeAdmOpcoes.php";?>
    <?php //----------------------?>
    
    
    <?php //Comandos fora do formulário.?>
    <div style="position: relative; display: none; width: 100%; text-align: center;">
        <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td>
                <a href="#" onclick="divShow('divFormCadastro');" style="text-decoration: none;">
                    <img src="img/btoFuncoesInclui.png" alt="Inclui" />
                </a>
            </td>
            <td>
                <a href="#" onclick="formularioSubmit('formCadastro', '', '', '');" style="text-decoration: none;">
                    <img src="img/btoFuncoesGravar.png" alt="Gravar" />
                </a>
            </td>
            <td>
                <a href="#" onclick="paginaRedirecionar('SiteAdmCadastroEditar.php?idTbCadastro=', 'idsRegistrosSelecionar', '<?php echo $queryPadrao;?>');" style="text-decoration: none;">
                    <img src="img/btoFuncoesAlterar.png" alt="Alterar" />
                </a>
            </td>
            <td>
                <a href="#" onclick="divHide('divFormCadastro');" style="text-decoration: none;">
                    <img src="img/btoFuncoesCancelar.png" alt="Cancelar" />
                </a>
            </td>
            <td>
                <a href="#" onclick="formularioSubmit('formCadastroAcoes', '', '', '');" style="text-decoration: none;">
                    <img src="img/btoFuncoesExcluir.png" alt="Excluir" />
                </a>
            </td>
            <td>
                <a href="#" onclick="divHide('divPopupCadastro');" style="text-decoration: none;">
                    <img src="img/btoFuncoesFechar.png" alt="Fechar" />
                </a>
            </td>
            <td>
            	<?php //Afetar janela pai.?>
                <a href="#" onclick="parent.divHide('divPopupCadastroUsuarios');" style="text-decoration: none;">
                    <img src="img/btoFuncoesFechar.png" alt="Fechar" />
                </a>
            </td>
          </tr>
        </table>
    </div>


    <?php
	if (empty($resultadoCadastro))
	{
        //echo "Nenhum registro encontrado";
    ?>
        <div align="center" class="AdmAlerta">
            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteMensagemCadastroVazio"); ?>
        </div>
    <?php
    }else{
    ?>
        <form name="formCadastroAcoes" id="formCadastroAcoes" action="SiteAdmRegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_cadastro" />
            
            <input name="idParentCadastro" id="idParentCadastro" type="hidden" value="<?php echo $idParentCadastro; ?>" />
            <input name="idTipoCadastro" type="hidden" id="idTipoCadastro" value="<?php echo $idTipoCadastro; ?>" />
            <input name="idTbCadastro1" type="hidden" id="idTbCadastro1" value="<?php echo $idTbCadastro1; ?>" />
            
            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            <input name="masterPageSiteSelect" type="hidden" id="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
            
            <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            <div style="position:relative; display: block; clear: both;">
                <div align="right" style="float: right;">
                    <input type="image" name="submit" value="Submit" src="img/btoExcluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoExcluir"); ?>" />
                </div>
            </div>
            <table width="100%" class="AdmTabelaDados01">
              <tr class="AdmTbFundoEscuro">
              	<?php if($GLOBALS['habilitarCadastroNClassificacao'] == 1){ ?>
                <td width="50" class="AdmTbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNClassificacaoA"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <td width="100" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroData"); ?>
                    </div>
                </td>
                
              	<?php if($GLOBALS['ativacaoCadastroVisualizacaoImagem'] == 1){ ?>
                <td width="1" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemImagem"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <td class="TabelaDados01Celula">
                    <div class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastro"); ?>
                    </div>
                </td>
                
              	<?php if($GLOBALS['habilitarCadastroData1'] == 1){ ?>
                <td width="100" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData1'], "IncludeConfig"); ?>
                    </div>
                </td>
              	<?php } ?>
              	<?php if($GLOBALS['habilitarCadastroData2'] == 1){ ?>
                <td width="100" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData2'], "IncludeConfig"); ?>
                    </div>
                </td>
              	<?php } ?>
              	<?php if($GLOBALS['habilitarCadastroData3'] == 1){ ?>
                <td width="100" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData3'], "IncludeConfig"); ?>
                    </div>
                </td>
              	<?php } ?>
              	<?php if($GLOBALS['habilitarCadastroData4'] == 1){ ?>
                <td width="100" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData4'], "IncludeConfig"); ?>
                    </div>
                </td>
              	<?php } ?>
              	<?php if($GLOBALS['habilitarCadastroData5'] == 1){ ?>
                <td width="100" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData5'], "IncludeConfig"); ?>
                    </div>
                </td>
              	<?php } ?>
                
              	<?php if($GLOBALS['habilitarCadastroFiltroGenerico01'] == 1){ ?>
                <td width="100" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico01Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
              	<?php } ?>
              	<?php if($GLOBALS['habilitarCadastroFiltroGenerico02'] == 1){ ?>
                <td width="100" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico02Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
              	<?php } ?>
              	<?php if($GLOBALS['habilitarCadastroFiltroGenerico03'] == 1){ ?>
                <td width="100" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico03Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
              	<?php } ?>
              	<?php if($GLOBALS['habilitarCadastroFiltroGenerico04'] == 1){ ?>
                <td width="100" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico04Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
              	<?php } ?>
              	<?php if($GLOBALS['habilitarCadastroFiltroGenerico05'] == 1){ ?>
                <td width="100" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico05Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
              	<?php } ?>
              	<?php if($GLOBALS['habilitarCadastroFiltroGenerico06'] == 1){ ?>
                <td width="100" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico06Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
              	<?php } ?>
              	<?php if($GLOBALS['habilitarCadastroFiltroGenerico07'] == 1){ ?>
                <td width="100" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico07Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
              	<?php } ?>
              	<?php if($GLOBALS['habilitarCadastroFiltroGenerico08'] == 1){ ?>
                <td width="100" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico08Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
              	<?php } ?>
              	<?php if($GLOBALS['habilitarCadastroFiltroGenerico09'] == 1){ ?>
                <td width="100" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico09Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
              	<?php } ?>
              	<?php if($GLOBALS['habilitarCadastroFiltroGenerico10'] == 1){ ?>
                <td width="100" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico10Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
              	<?php } ?>
                
              	<?php if($GLOBALS['habilitarCadastroIc1'] == 1){ ?>
                <td width="100" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc1'], "IncludeConfig"); ?>
                    </div>
                </td>
              	<?php } ?>
                
              	<?php if($GLOBALS['habilitarCadastroIc2'] == 1){ ?>
                <td width="100" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc2'], "IncludeConfig"); ?>
                    </div>
                </td>
              	<?php } ?>
                
                <td width="200" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFuncoes"); ?>
                    </div>
                </td>
                <td width="30" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao"); ?>
                    </div>
                </td>
                
                <?php if($GLOBALS['habilitarCadastroAtivacaoDestaque'] == 1){ ?>
                <td width="30" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroAtivacaoDestaque"); ?>
                    </div>
                </td>
				<?php } ?>
                
                <td width="30" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                    </div>
                </td>
                <td width="30" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemExcluir"); ?>
                    </div>
                </td>
                <td width="30" class="TabelaDados01Celula" style="display: none;">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemSelecionarA"); ?>
                    </div>
                </td>
              </tr>
              <?php
				$countTabelaFundo = 0;
				
				//Colocar verificação de habilitação.
				$arrCadastroFiltroGenerico01 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 12);
				$arrCadastroFiltroGenerico02 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 13);
				$arrCadastroFiltroGenerico03 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 14);
				$arrCadastroFiltroGenerico04 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 15);
				$arrCadastroFiltroGenerico05 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 16);
				$arrCadastroFiltroGenerico06 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 17);
				$arrCadastroFiltroGenerico07 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 18);
				$arrCadastroFiltroGenerico08 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 19);
				$arrCadastroFiltroGenerico09 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 20);
				$arrCadastroFiltroGenerico10 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 21);
			  
                //Loop pelos resultados.
                foreach($resultadoCadastro as $linhaCadastro)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="<?php if($countTabelaFundo == 0){ ?>AdmTbFundoClaro<?php }else{?>AdmTbFundoAlternativo<?php } ?>">
              	<?php if($GLOBALS['habilitarCadastroNClassificacao'] == 1){ ?>
                <td width="50" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <?php //echo $linhaCadastro['n_classificacao'];?>
                    </div>
                </td>
                <?php } ?>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <?php echo $linhaCadastro['data_cadastro'];?>
                    </div>
                </td>

              	<?php if($GLOBALS['ativacaoCadastroVisualizacaoImagem'] == 1){ ?>
                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
						<?php if(!empty($linhaCadastro['imagem'])){ ?>
							<?php //Sem pop-up. ?>
                            <?php if($GLOBALS['configImagemPopUp'] == 0){ ?>
                                <img src="../<?php echo $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos'];?>/t<?php echo $linhaCadastro['imagem'];?>" alt="<?php echo Funcoes::GetCadastroTitulo(Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome']), Funcoes::ConteudoMascaraLeitura($linhaCadastro['razao_social']), Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome_fantasia']), 1); ?>" />
                            <?php } ?>
                        
                            <?php //SlimBox 2 - JQuery. ?>
                            <?php if($GLOBALS['configImagemPopUp'] == 1){ ?>
                                <a href="../<?php echo $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos'];?>/g<?php echo $linhaCadastro['imagem'];?>" rel="lightbox" title="">
                                    <img src="../<?php echo $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos'];?>/t<?php echo $linhaCadastro['imagem'];?>" alt="<?php echo Funcoes::GetCadastroTitulo(Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome']), Funcoes::ConteudoMascaraLeitura($linhaCadastro['razao_social']), Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome_fantasia']), 1); ?>" />
                                </a>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
                <?php } ?>

                <td class="TabelaDados01Celula">
                    <div class="AdmTexto01">
                    	<div>
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome']);?>
                            <?php //echo Funcoes::GetCadastroTitulo(Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome']), Funcoes::ConteudoMascaraLeitura($linhaCadastro['razao_social']), Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome_fantasia']), 1); ?>
                        </div>
                        
                        <?php if($GLOBALS['habilitarCadastroRazaoSocial'] == 1 && !empty($linhaCadastro['razao_social'])){ ?>
                            <div>
                            	<strong>
                                	 <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroRazaoSocial"); ?>: 
                                </strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastro['razao_social']);?>
                            </div>
                        <?php } ?>

                        <?php if($GLOBALS['habilitarCadastroNomeFantasia'] == 1 && !empty($linhaCadastro['nome_fantasia'])){ ?>
                            <div>
                            	<strong>
                                	 <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroNomeFantasia"); ?>: 
                                </strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome_fantasia']);?>
                            </div>
                        <?php } ?>
                        
                        <?php if($GLOBALS['configCadastroSenha'] == 1){ ?>
							<?php if($GLOBALS['habilitarCadastroSenha'] == 1 && !empty($linhaCadastro['senha'])){ ?>
                                <div>
                                    <strong>
                                         <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroSenha"); ?>: 
                                    </strong>
                                    <?php if($GLOBALS['configCadastroMetodoSenha'] == 2){ ?>
                                        <?php if($GLOBALS['configCadastroSenha'] == 1){ ?>
                                            <?php //echo Crypto::DecryptValue(EncryptValue(Funcoes::ConteudoMascaraLeitura($linhaCadastro['senha']), 2), 2);?>
                                            <?php echo Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura($linhaCadastro['senha'], 2), 2);?>
                                        <?php } ?>
                                    <?php } ?>
                                    <?php //echo Funcoes::ConteudoMascaraLeitura($linhaCadastro['senha']);?>
                                    <?php //echo "<br>" . "teste de senha (md5): " . Crypto::EncryptValue(Funcoes::ConteudoMascaraLeitura($linhaCadastro['senha']), $configCryptTipo);?>
                                    <?php //echo "<br>" . "teste de senha (MCCript): " . Crypto::EncryptValue(Funcoes::ConteudoMascaraLeitura($linhaCadastro['senha']), 2);?>
                                    <?php //echo "<br>" . "teste de senha (MCCript - decrypt): " . Crypto::DecryptValue(EncryptValue(Funcoes::ConteudoMascaraLeitura($linhaCadastro['senha']), 2), 2);?>
                                    <?php //echo "<br>" . "teste de senha (MCCript): " . Crypto::EncryptValue(Funcoes::ConteudoMascaraGravacao01($linhaCadastro['senha']), 2);?>
                                    
                                </div>
                            <?php } ?>
                        <?php } ?>
                        
                        <?php if(!empty($linhaCadastro['tel_principal'])){ ?>
                            <div>
                            	<strong>
                                	 <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroTel"); ?>: 
                                </strong>
                                (<?php echo $linhaCadastro['tel_ddd_principal'];?>) <?php echo Funcoes::FormatarTelefoneLer($linhaCadastro['tel_principal']);?>
                            </div>
                        <?php } ?>
                        <?php if(!empty($linhaCadastro['cel_principal'])){ ?>
                            <div>
                            	<strong>
                                	 <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroCel"); ?>: 
                                </strong>
                                (<?php echo $linhaCadastro['cel_ddd_principal'];?>) <?php echo Funcoes::FormatarTelefoneLer($linhaCadastro['cel_principal']);?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="AdmTexto01">
                    	<?php if($GLOBALS['habilitarCadastroFotos'] == 1){ ?>
                            [
                            <a href="SiteAdmArquivosIndice.php?idParent=<?php echo $linhaCadastro['id'];?>&tipoArquivo=1&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::GetCadastroTitulo(Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome']), Funcoes::ConteudoMascaraLeitura($linhaCadastro['razao_social']), Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome_fantasia']), 1);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirFotos"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarCadastroVideos'] == 1){ ?>
                            [
                            <a href="SiteAdmArquivosIndice.php?idParent=<?php echo $linhaCadastro['id'];?>&tipoArquivo=2&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::GetCadastroTitulo(Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome']), Funcoes::ConteudoMascaraLeitura($linhaCadastro['razao_social']), Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome_fantasia']), 1);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirVideos"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarCadastroArquivos'] == 1){ ?>
                            [
                            <a href="SiteAdmArquivosIndice.php?idParent=<?php echo $linhaCadastro['id'];?>&tipoArquivo=3&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::GetCadastroTitulo(Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome']), Funcoes::ConteudoMascaraLeitura($linhaCadastro['razao_social']), Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome_fantasia']), 1);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirArquivos"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarCadastroZip'] == 1){ ?>
                            [
                            <a href="SiteAdmArquivosIndice.php?idParent=<?php echo $linhaCadastro['id'];?>&tipoArquivo=4&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::GetCadastroTitulo(Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome']), Funcoes::ConteudoMascaraLeitura($linhaCadastro['razao_social']), Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome_fantasia']), 1);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirZip"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarCadastroSwfs'] == 1){ ?>
                            [
                            <a href="SiteAdmArquivosIndice.php?idParent=<?php echo $linhaCadastro['id'];?>&tipoArquivo=5&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::GetCadastroTitulo(Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome']), Funcoes::ConteudoMascaraLeitura($linhaCadastro['razao_social']), Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome_fantasia']), 1);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirSWFs"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    </div>
                    
                    <div id="divCadastroDetalhes<?php echo $linhaCadastro['id'];?>" style="
                    border: solid 1px #78c3ae;
                    position: fixed;
                    left: 50%;
                    top: 50%;
                    background-color: #ffffff;
                    z-index: 99999;
            
                    height: 400px;
                    margin-top: -200px;
            
                    width: 500px;
                    margin-left: -250px; 
            
                    display: none;
                    overflow: auto;
                    ">
                        <?php //Faixa superior. ?>
                        <?php //---------------------- ?>
                        <div class="AdmTbFundoClaro" style="position: relative; display: block; height: 30px; width: 100%; clear: both;">
                            <div class="AdmTexto01 " style="position: relative; display: block; line-height: 30px; padding-left: 10px; float: left">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemDetalhes"); ?>
                                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroAdministrarTbDetalhes"); ?>
                            </div>
                            <div align="center" class="AdmTbFundoEscuro" style="position: relative; display: block; line-height: 30px; width: 30px; /*padding-right: 10px;*/ float: right">
                                <strong>
                                    <a href="#" onclick="divShowHide('divCadastroDetalhes<?php echo $linhaCadastro['id'];?>');" class="AdmLinks02">
                                        X
                                    </a>
                                </strong>
                            </div>
                        </div>
                        <?php //---------------------- ?>
                        
                        
                        <?php //Detalhes pop-up div. ?>
                        <?php //---------------------- ?>
                        <div class="AdmTexto01" style="position: relative; display: block; padding: 6px; /*overflow: scroll;*/">
                        	<?php
							//Definição das variáveis de detalhes.
							$tbCadastroId = $linhaCadastro['id'];
							$tbCadastroIdTbCategorias = $linhaCadastro['id_tb_categorias'];
							$tbCadastroDataCadastro = Funcoes::DataLeitura01($linhaCadastro['data_cadastro'], $GLOBALS['configSiteFormatoData'], "1");
							//$tbCadastroNClassificacao = $linhaCadastro['n_classificacao'];
							
							$tbCadastroPfPj = $linhaCadastro['pf_pj'];
							$tbCadastroPfPj_print = "";
							if($tbCadastroPfPj == "1"){
								$tbCadastroPfPj_print = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroPfPj1");
							}
							if($tbCadastroPfPj == "2"){
								$tbCadastroPfPj_print = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroPfPj2");
							}
					
							$tbCadastroNome = Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome']);
							
							$tbCadastroSexo = $linhaCadastro['sexo'];
							$tbCadastroSexo_print = "";
							if($tbCadastroSexo == "1"){
								$tbCadastroSexo_print = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroSexo1");
							}
							if($tbCadastroSexo == "2"){
								$tbCadastroSexo_print = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroSexo2");
							}
							
							$tbCadastroAltura = $linhaCadastro['altura'];
							$tbCadastroPeso = $linhaCadastro['peso'];
							$tbCadastroRazaoSocial = Funcoes::ConteudoMascaraLeitura($linhaCadastro['razao_social']);
							$tbCadastroNomeFantasia = Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome_fantasia']);
							
							//$tbCadastroDataNascimento = $linhaCadastro['data_nascimento'];
							//$tbCadastroDataNascimento = $linhaCadastro['data_nascimento'];
							if($linhaCadastro['data_nascimento'] == NULL)
							{
								$tbCadastroDataNascimento = "";
							}else{
								$tbCadastroDataNascimento = Funcoes::DataLeitura01($linhaCadastro['data_nascimento'], $GLOBALS['configSiteFormatoData'], "1");
							}
							
							if($linhaCadastro['data1'] == NULL)
							{
								$tbCadastroData1 = "";
							}else{
								$tbCadastroData1 = Funcoes::DataLeitura01($linhaCadastro['data1'], $GLOBALS['configSistemaFormatoData'], "1");
							}
							if($linhaCadastro['data2'] == NULL)
							{
								$tbCadastroData2 = "";
							}else{
								$tbCadastroData2 = Funcoes::DataLeitura01($linhaCadastro['data2'], $GLOBALS['configSistemaFormatoData'], "1");
							}
							if($linhaCadastro['data3'] == NULL)
							{
								$tbCadastroData3 = "";
							}else{
								$tbCadastroData3 = Funcoes::DataLeitura01($linhaCadastro['data3'], $GLOBALS['configSistemaFormatoData'], "1");
							}
							if($linhaCadastro['data4'] == NULL)
							{
								$tbCadastroData4 = "";
							}else{
								$tbCadastroData4 = Funcoes::DataLeitura01($linhaCadastro['data4'], $GLOBALS['configSistemaFormatoData'], "1");
							}
							if($linhaCadastro['data5'] == NULL)
							{
								$tbCadastroData5 = "";
							}else{
								$tbCadastroData5 = Funcoes::DataLeitura01($linhaCadastro['data5'], $GLOBALS['configSistemaFormatoData'], "1");
							}
							if($linhaCadastro['data6'] == NULL)
							{
								$tbCadastroData6 = "";
							}else{
								$tbCadastroData6 = Funcoes::DataLeitura01($linhaCadastro['data6'], $GLOBALS['configSistemaFormatoData'], "1");
							}
							if($linhaCadastro['data7'] == NULL)
							{
								$tbCadastroData7 = "";
							}else{
								$tbCadastroData7 = Funcoes::DataLeitura01($linhaCadastro['data7'], $GLOBALS['configSistemaFormatoData'], "1");
							}
							if($linhaCadastro['data8'] == NULL)
							{
								$tbCadastroData8 = "";
							}else{
								$tbCadastroData8 = Funcoes::DataLeitura01($linhaCadastro['data8'], $GLOBALS['configSistemaFormatoData'], "1");
							}
							if($linhaCadastro['data9'] == NULL)
							{
								$tbCadastroData9 = "";
							}else{
								$tbCadastroData9 = Funcoes::DataLeitura01($linhaCadastro['data9'], $GLOBALS['configSistemaFormatoData'], "1");
							}
							if($linhaCadastro['data10'] == NULL)
							{
								$tbCadastroData10 = "";
							}else{
								$tbCadastroData10 = Funcoes::DataLeitura01($linhaCadastro['data10'], $GLOBALS['configSistemaFormatoData'], "1");
							}
					
							//$tbCadastroCPF = $linhaCadastro['cpf_'];
							$tbCadastroCPF = Funcoes::FormatarCPFLer($linhaCadastro['cpf_']);
							$tbCadastroRG = $linhaCadastro['rg_'];
							//$tbCadastroCNPJ = $linhaCadastro['cnpj_'];
							$tbCadastroCNPJ = Funcoes::FormatarCNPJLer($linhaCadastro['cnpj_']);
							$tbCadastroDocumento = $linhaCadastro['documento'];
							$tbCadastroIMunicipal = $linhaCadastro['i_municipal'];
							$tbCadastroIEstadual = $linhaCadastro['i_estadual'];
							$tbCadastroEnderecoPrincipal = Funcoes::ConteudoMascaraLeitura($linhaCadastro['endereco_principal']);
							$tbCadastroEnderecoNumeroPrincipal = $linhaCadastro['endereco_numero_principal'];
							$tbCadastroEnderecoComplementoPrincipal = Funcoes::ConteudoMascaraLeitura($linhaCadastro['endereco_complemento_principal']);
							$tbCadastroBairroPrincipal = Funcoes::ConteudoMascaraLeitura($linhaCadastro['bairro_principal']);
							$tbCadastroCidadePrincipal = Funcoes::ConteudoMascaraLeitura($linhaCadastro['cidade_principal']);
							$tbCadastroEstadoPrincipal = Funcoes::ConteudoMascaraLeitura($linhaCadastro['estado_principal']);
							$tbCadastroPaisPrincipal = Funcoes::ConteudoMascaraLeitura($linhaCadastro['pais_principal']);
							//$tbCadastro = $linhaCadastro['id_config_bairro'];
							//$tbCadastro = $linhaCadastro['id_config_cidade'];
							//$tbCadastro = $linhaCadastro['id_config_estado'];
							//$tbCadastro = $linhaCadastro['id_config_regiao'];
							//$tbCadastro = $linhaCadastro['id_config_pais'];
							$tbCadastroIdDBCepTblBairros = $linhaCadastro['id_db_cep_tblBairros'];
							$tbCadastroIdDBCepTblCidades = $linhaCadastro['id_db_cep_tblCidades'];
							$tbCadastroIdDBCepTblLogradouros = $linhaCadastro['id_db_cep_tblLogradouros'];
							$tbCadastroIdDBCepTblUF = $linhaCadastro['id_db_cep_tblUF'];
							
							//$tbCadastroCepPrincipal = $linhaCadastro['cep_principal'];
							$tbCadastroCepPrincipal = Funcoes::FormatarCEPLer($linhaCadastro['cep_principal']);
							
							$tbCadastroPontoReferencia = Funcoes::ConteudoMascaraLeitura($linhaCadastro['ponto_referencia']);
							$tbCadastroEmailPrincipal = $linhaCadastro['email_principal'];
							$tbCadastroTelDDDPrincipal = $linhaCadastro['tel_ddd_principal'];
							$tbCadastroTelPrincipal = $linhaCadastro['tel_principal'];
							$tbCadastroCelDDDPrincipal = $linhaCadastro['cel_ddd_principal'];
							$tbCadastroCelPrincipal = $linhaCadastro['cel_principal'];
							$tbCadastroFaxDDDPrincipal = $linhaCadastro['fax_ddd_principal'];
							$tbCadastroFaxPrincipal = $linhaCadastro['fax_principal'];
							$tbCadastroSitePrincipal = $linhaCadastro['site_principal'];
							$tbCadastroNFuncionarios = $linhaCadastro['n_funcionarios'];
							$tbCadastroOBSInterno = Funcoes::ConteudoMascaraLeitura($linhaCadastro['obs_interno']);
							
							$tbCadastroIdTbCadastroStatus = $linhaCadastro['id_tb_cadastro_status'];
							$tbCadastroIdTbCadastroStatus_print = DbFuncoes::GetCampoGenerico01($tbCadastroIdTbCadastroStatus, "tb_cadastro_complemento", "complemento");
							$tbCadastroIdTbCadastro1 = $linhaCadastro['id_tb_cadastro1'];
							$tbCadastroIdTbCadastro2 = $linhaCadastro['id_tb_cadastro2'];
							$tbCadastroIdTbCadastro3 = $linhaCadastro['id_tb_cadastro3'];
							
							$tbCadastroAtivacao = $linhaCadastro['ativacao'];
							$tbCadastroAtivacao_print = "";
							if($tbCadastroAtivacao == "0"){
								$tbCadastroAtivacao_print = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao4");
							}
							if($tbCadastroAtivacao == "1"){
								$tbCadastroAtivacao_print = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao5");
							}
					
							$tbCadastroAtivacaoDestaque = $linhaCadastro['ativacao_destaque'];
							
							$tbCadastroAtivacaoMalaDireta = $linhaCadastro['ativacao_mala_direta'];
							$tbCadastroAtivacaoMalaDireta_print = "";
							if($tbCadastroAtivacaoMalaDireta == "0"){
								$tbCadastroAtivacaoMalaDireta_print = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao4");
							}
							if($tbCadastroAtivacaoMalaDireta == "1"){
								$tbCadastroAtivacaoMalaDireta_print = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao5");
							}
							
							$tbCadastroUsuario = $linhaCadastro['usuario'];
							
							//$tbCadastroSenha = $linhaCadastro['senha'];
							if($GLOBALS['configCadastroMetodoSenha'] == 2){
								if($GLOBALS['configCadastroSenha'] == 1){
									$tbCadastroSenha = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura($linhaCadastro['senha'], 2), 2);
								}
							}
							
							$tbCadastroImagem = $linhaCadastro['imagem'];
							$tbCadastroLogo = $linhaCadastro['logo'];
							$tbCadastroBanner = $linhaCadastro['banner'];
							$tbCadastroMapa = $linhaCadastro['mapa'];
							$tbCadastroMapaOnline = $linhaCadastro['mapa_online'];
							$tbCadastroPalavrasChave = $linhaCadastro['palavras_chave'];
							$tbCadastroApresentacao = Funcoes::ConteudoMascaraLeitura($linhaCadastro['apresentacao']);
							$tbCadastroServicos = Funcoes::ConteudoMascaraLeitura($linhaCadastro['servicos']);
							$tbCadastroPromocoes = Funcoes::ConteudoMascaraLeitura($linhaCadastro['promocoes']);
							$tbCadastroCondicoesComerciais = Funcoes::ConteudoMascaraLeitura($linhaCadastro['condicoes_comerciais']);
							$tbCadastroFormasPagamento = Funcoes::ConteudoMascaraLeitura($linhaCadastro['formas_pagamento']);
							$tbCadastroHorarioAtendimento = Funcoes::ConteudoMascaraLeitura($linhaCadastro['horario_atendimento']);
							$tbCadastroSituacaoAtual = Funcoes::ConteudoMascaraLeitura($linhaCadastro['situacao_atual']);
							$tbCadastroIC1 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar1']);
							$tbCadastroIC2 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar2']);
							$tbCadastroIC3 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar3']);
							$tbCadastroIC4 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar4']);
							$tbCadastroIC5 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar5']);
							$tbCadastroIC6 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar6']);
							$tbCadastroIC7 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar7']);
							$tbCadastroIC8 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar8']);
							$tbCadastroIC9 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar9']);
							$tbCadastroIC10 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar10']);
							$tbCadastroIC11 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar11']);
							$tbCadastroIC12 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar12']);
							$tbCadastroIC13 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar13']);
							$tbCadastroIC14 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar14']);
							$tbCadastroIC15 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar15']);
							$tbCadastroIC16 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar16']);
							$tbCadastroIC17 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar17']);
							$tbCadastroIC18 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar18']);
							$tbCadastroIC19 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar19']);
							$tbCadastroIC20 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar20']);
							$tbCadastroIC21 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar21']);
							$tbCadastroIC22 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar22']);
							$tbCadastroIC23 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar23']);
							$tbCadastroIC24 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar24']);
							$tbCadastroIC25 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar25']);
							$tbCadastroIC26 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar26']);
							$tbCadastroIC27 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar27']);
							$tbCadastroIC28 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar28']);
							$tbCadastroIC29 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar29']);
							$tbCadastroIC30 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar30']);
							$tbCadastroIC31 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar31']);
							$tbCadastroIC32 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar32']);
							$tbCadastroIC33 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar33']);
							$tbCadastroIC34 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar34']);
							$tbCadastroIC35 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar35']);
							$tbCadastroIC36 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar36']);
							$tbCadastroIC37 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar37']);
							$tbCadastroIC38 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar38']);
							$tbCadastroIC39 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar39']);
							$tbCadastroIC40 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar40']);
							$tbCadastroNVisitas = $linhaCadastro['n_visitas'];
							$tbCadastroOrigemCadastro = $linhaCadastro['origem_cadastro'];
							?>
                            
                            <table width="100%" class="AdmTabelaDados01">
                              <?php if($GLOBALS['habilitarCadastroTipo'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroTipoCadastro"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrCadastroTipoSelecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "1", "", ",", "", "1"));
                                    $arrCadastroTipo = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 1);
                                    ?>
                                    
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroTipo); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <?php if(in_array($arrCadastroTipo[$countArray][0], $arrCadastroTipoSelecao)){ ?> 
                                                - <?php echo $arrCadastroTipo[$countArray][1];?>
                                            <?php } ?>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                </td>
                              </tr>
                              <?php } ?>
                        
                              <?php if($GLOBALS['habilitarCadastroAtividades'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroAtividades"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrCadastroAtividadesSelecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "2", "", ",", "", "1"));
                                    $arrCadastroAtividades = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 2);
                                    ?>
                                    
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroAtividades); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <?php if(in_array($arrCadastroAtividades[$countArray][0], $arrCadastroAtividadesSelecao)){ ?> 
                                                - <?php echo $arrCadastroAtividades[$countArray][1];?>
                                            <?php } ?>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                </td>
                              </tr>
                              <?php } ?>
                        
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroNome"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroNome; ?>
                                </td>
                              </tr>
                        
                              <?php if($GLOBALS['habilitarCadastroSexo'] == 1 || $GLOBALS['habilitarCadastroPfPj'] == 1){ ?>
                              <tr>
                                <?php if($GLOBALS['habilitarCadastroSexo'] == 1){ ?>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroSexo"); ?>:
                                </td>
                                <td class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroSexo_print; ?>
                                </td>
                                <?php } ?>
                                <?php if($GLOBALS['habilitarCadastroPfPj'] == 1){ ?>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroPfPj"); ?>:
                                </td>
                                <td class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroPfPj_print; ?>
                                </td>
                                <?php } ?>
                              </tr>
                              <?php } ?>
                        
                              <?php if($GLOBALS['habilitarCadastroFiltroGenerico01'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico01Nome'], "IncludeConfig"); ?>: 
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php 
                                    $arrCadastroFiltroGenerico01Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "12", "", ",", "", "1"));
                                    $arrCadastroFiltroGenerico01 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 12);
                                    ?>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico01); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <?php if(in_array($arrCadastroFiltroGenerico01[$countArray][0], $arrCadastroFiltroGenerico01Selecao)){ ?> 
                                                - <?php echo $arrCadastroFiltroGenerico01[$countArray][1];?>
                                            <?php } ?>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                </td>
                              </tr>
                              <?php } ?>
                              
                              <?php if($GLOBALS['habilitarCadastroFiltroGenerico02'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico02Nome'], "IncludeConfig"); ?>: 
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php 
                                    $arrCadastroFiltroGenerico02Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "13", "", ",", "", "1"));
                                    $arrCadastroFiltroGenerico02 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 13);
                                    ?>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico02); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <?php if(in_array($arrCadastroFiltroGenerico02[$countArray][0], $arrCadastroFiltroGenerico02Selecao)){ ?> 
                                                - <?php echo $arrCadastroFiltroGenerico02[$countArray][1];?>
                                            <?php } ?>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                </td>
                              </tr>
                              <?php } ?>
                    
                              <?php if($GLOBALS['habilitarCadastroFiltroGenerico03'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico03Nome'], "IncludeConfig"); ?>: 
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php 
                                    $arrCadastroFiltroGenerico03Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "14", "", ",", "", "1"));
                                    $arrCadastroFiltroGenerico03 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 14);
                                    ?>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico03); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <?php if(in_array($arrCadastroFiltroGenerico03[$countArray][0], $arrCadastroFiltroGenerico03Selecao)){ ?> 
                                                - <?php echo $arrCadastroFiltroGenerico03[$countArray][1];?>
                                            <?php } ?>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                </td>
                              </tr>
                              <?php } ?>
                    
                              <?php if($GLOBALS['habilitarCadastroFiltroGenerico04'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico04Nome'], "IncludeConfig"); ?>: 
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php 
                                    $arrCadastroFiltroGenerico04Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "15", "", ",", "", "1"));
                                    $arrCadastroFiltroGenerico04 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 15);
                                    ?>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico04); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <?php if(in_array($arrCadastroFiltroGenerico04[$countArray][0], $arrCadastroFiltroGenerico04Selecao)){ ?> 
                                                - <?php echo $arrCadastroFiltroGenerico04[$countArray][1];?>
                                            <?php } ?>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                </td>
                              </tr>
                              <?php } ?>
                    
                              <?php if($GLOBALS['habilitarCadastroFiltroGenerico05'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico05Nome'], "IncludeConfig"); ?>: 
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php 
                                    $arrCadastroFiltroGenerico05Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "16", "", ",", "", "1"));
                                    $arrCadastroFiltroGenerico05 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 16);
                                    ?>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico05); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <?php if(in_array($arrCadastroFiltroGenerico05[$countArray][0], $arrCadastroFiltroGenerico05Selecao)){ ?> 
                                                - <?php echo $arrCadastroFiltroGenerico05[$countArray][1];?>
                                            <?php } ?>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                </td>
                              </tr>
                              <?php } ?>
                    
                              <?php if($GLOBALS['habilitarCadastroFiltroGenerico06'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico06Nome'], "IncludeConfig"); ?>: 
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php 
                                    $arrCadastroFiltroGenerico06Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "17", "", ",", "", "1"));
                                    $arrCadastroFiltroGenerico06 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 17);
                                    ?>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico06); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <?php if(in_array($arrCadastroFiltroGenerico06[$countArray][0], $arrCadastroFiltroGenerico06Selecao)){ ?> 
                                                - <?php echo $arrCadastroFiltroGenerico06[$countArray][1];?>
                                            <?php } ?>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                </td>
                              </tr>
                              <?php } ?>
                    
                              <?php if($GLOBALS['habilitarCadastroFiltroGenerico07'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico07Nome'], "IncludeConfig"); ?>: 
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php 
                                    $arrCadastroFiltroGenerico07Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "18", "", ",", "", "1"));
                                    $arrCadastroFiltroGenerico07 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 18);
                                    ?>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico07); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <?php if(in_array($arrCadastroFiltroGenerico07[$countArray][0], $arrCadastroFiltroGenerico07Selecao)){ ?> 
                                                - <?php echo $arrCadastroFiltroGenerico07[$countArray][1];?>
                                            <?php } ?>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                </td>
                              </tr>
                              <?php } ?>
                    
                              <?php if($GLOBALS['habilitarCadastroFiltroGenerico08'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico08Nome'], "IncludeConfig"); ?>: 
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php 
                                        $arrCadastroFiltroGenerico08Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "19", "", ",", "", "1"));
                                        $arrCadastroFiltroGenerico08 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 19);
                                    ?>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico08); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <?php if(in_array($arrCadastroFiltroGenerico08[$countArray][0], $arrCadastroFiltroGenerico08Selecao)){ ?> 
                                                - <?php echo $arrCadastroFiltroGenerico08[$countArray][1];?>
                                            <?php } ?>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                </td>
                              </tr>
                              <?php } ?>
                    
                              <?php if($GLOBALS['habilitarCadastroFiltroGenerico09'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico09Nome'], "IncludeConfig"); ?>: 
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php 
                                        $arrCadastroFiltroGenerico09Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "20", "", ",", "", "1"));
                                        $arrCadastroFiltroGenerico09 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 20);
                                    ?>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico09); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <?php if(in_array($arrCadastroFiltroGenerico09[$countArray][0], $arrCadastroFiltroGenerico09Selecao)){ ?> 
                                                - <?php echo $arrCadastroFiltroGenerico09[$countArray][1];?>
                                            <?php } ?>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                </td>
                              </tr>
                              <?php } ?>
                    
                              <?php if($GLOBALS['habilitarCadastroFiltroGenerico10'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico10Nome'], "IncludeConfig"); ?>: 
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php 
                                        $arrCadastroFiltroGenerico10Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "21", "", ",", "", "1"));
                                        $arrCadastroFiltroGenerico10 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 21);
                                    ?>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico10); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <?php if(in_array($arrCadastroFiltroGenerico10[$countArray][0], $arrCadastroFiltroGenerico10Selecao)){ ?> 
                                                - <?php echo $arrCadastroFiltroGenerico10[$countArray][1];?>
                                            <?php } ?>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                </td>
                              </tr>
                              <?php } ?>
                        
                              <?php if($GLOBALS['habilitarCadastroAlturaPeso'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroAltura"); ?>:
                                </td>
                                <td class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroAltura; ?>
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroAlturaMedida"); ?>
                                </td>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroPeso"); ?>:
                                </td>
                                <td class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroPeso; ?>
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroPesoMedida"); ?>
                                </td>
                              </tr>
                              <?php } ?>
                        
                              <?php if($GLOBALS['habilitarCadastroRazaoSocial'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroRazaoSocial"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroRazaoSocial; ?>
                                </td>
                              </tr>
                              <?php } ?>
                        
                              <?php if($GLOBALS['habilitarCadastroNomeFantasia'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroNomeFantasia"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroNomeFantasia; ?>
                                </td>
                              </tr>
                              <?php } ?>
                        
                              <tr>
                                <?php if($GLOBALS['habilitarCadastroDataNascimento'] == 1){ ?>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroDataNascimento"); ?>:
                                </td>
                                <td class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroDataNascimento; ?>
                                </td>
                                <?php } ?>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroDataCadastro"); ?>:
                                </td>
                                <td class="AdmTbFundoClaro"<?php if($GLOBALS['habilitarCadastroDataNascimento'] <> 1){ ?> colspan="3"<?php } ?>>
                                    <?php echo $tbCadastroDataCadastro; ?>
                                </td>
                              </tr>
                              
                              <?php if($GLOBALS['habilitarCadastroData1'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData1'], "IncludeConfig"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroData1; ?>
                                </td>
                              </tr>
                              <?php } ?>
                              
                              <?php if($GLOBALS['habilitarCadastroData2'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData2'], "IncludeConfig"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroData2; ?>
                                </td>
                              </tr>
                              <?php } ?>
                    
                              <?php if($GLOBALS['habilitarCadastroData3'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData3'], "IncludeConfig"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroData3; ?>
                                </td>
                              </tr>
                              <?php } ?>
                    
                              <?php if($GLOBALS['habilitarCadastroData4'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData4'], "IncludeConfig"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroData4; ?>
                                </td>
                              </tr>
                              <?php } ?>
                    
                              <?php if($GLOBALS['habilitarCadastroData5'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData5'], "IncludeConfig"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroData5; ?>
                                </td>
                              </tr>
                              <?php } ?>
                    
                              <?php if($GLOBALS['habilitarCadastroData6'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData6'], "IncludeConfig"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroData6; ?>
                                </td>
                              </tr>
                              <?php } ?>
                    
                              <?php if($GLOBALS['habilitarCadastroData7'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData7'], "IncludeConfig"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroData7; ?>
                                </td>
                              </tr>
                              <?php } ?>
                    
                              <?php if($GLOBALS['habilitarCadastroData8'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData8'], "IncludeConfig"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroData8; ?>
                                </td>
                              </tr>
                              <?php } ?>
                    
                              <?php if($GLOBALS['habilitarCadastroData9'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData9'], "IncludeConfig"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroData9; ?>
                                </td>
                              </tr>
                              <?php } ?>
                    
                              <?php if($GLOBALS['habilitarCadastroData10'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData10'], "IncludeConfig"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroData10; ?>
                                </td>
                              </tr>
                              <?php } ?>
                        
                              <?php if($GLOBALS['habilitarCadastroCPFRG'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroCPF"); ?>:
                                </td>
                                <td class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroCPF; ?>
                                </td>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroRG"); ?>:
                                </td>
                                <td class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroRG; ?>
                                </td>
                              </tr>
                              <?php } ?>
                        
                              <?php if($GLOBALS['habilitarCadastroCNPJ'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroCNPJ"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroCNPJ; ?>
                                </td>
                              </tr>
                              <?php } ?>
                        
                              <?php if($GLOBALS['habilitarCadastroDocumento'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroCNPJ"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroDocumento; ?>
                                </td>
                              </tr>
                              <?php } ?>
                        
                              <?php if($GLOBALS['habilitarCadastroIEstadualIMunicipal'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroInscricaoMunicipal"); ?>:
                                </td>
                                <td class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroIMunicipal; ?>
                                </td>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroInscricaoEstadual"); ?>:
                                </td>
                                <td class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroIEstadual; ?>
                                </td>
                              </tr>
                              <?php } ?>
                        
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroEnderecoPrincipal"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroEnderecoPrincipal; ?>
                                </td>
                              </tr>
                        
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroEnderecoNumeroPrincipal"); ?>:
                                </td>
                                <td class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroEnderecoNumeroPrincipal; ?>
                                </td>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroEnderecoComplementoPrincipal"); ?>:
                                </td>
                                <td class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroEnderecoComplementoPrincipal; ?>
                                </td>
                              </tr>
                        
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroBairroPrincipal"); ?>:
                                </td>
                                <td class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroBairroPrincipal; ?>
                                </td>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroCidadePrincipal"); ?>:
                                </td>
                                <td class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroCidadePrincipal; ?>
                                </td>
                              </tr>
                        
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroEstadoPrincipal"); ?>:
                                </td>
                                <td class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroEstadoPrincipal; ?>
                                </td>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroPaisPrincipal"); ?>:
                                </td>
                                <td class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroPaisPrincipal; ?>
                                </td>
                              </tr>
                        
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroCEPPrincipal"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroCepPrincipal; ?>
                                </td>
                              </tr>
                        
                              <?php if($GLOBALS['habilitarCadastroPontoReferencia'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroPontoReferencia"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroPontoReferencia; ?>
                                </td>
                              </tr>
                              <?php } ?>
                        
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroEmailPrincipal"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <a href="mailto:<?php echo $tbCadastroEmailPrincipal; ?>" class="AdmLinks01">
                                        <?php echo $tbCadastroEmailPrincipal; ?>
                                    </a>
                                </td>
                              </tr>
                        
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroTel"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php if(!empty($tbCadastroTelDDDPrincipal)){ ?>(<?php echo $tbCadastroTelDDDPrincipal; ?>)<?php } ?> 
                                    <?php echo $tbCadastroTelPrincipal; ?>
                                </td>
                              </tr>
                        
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroCel"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php if(!empty($tbCadastroCelDDDPrincipal)){ ?>(<?php echo $tbCadastroCelDDDPrincipal; ?>)<?php } ?> 
                                    <?php echo $tbCadastroCelPrincipal; ?>
                                </td>
                              </tr>
                        
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroFax"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php if(!empty($tbCadastroFaxDDDPrincipal)){ ?>(<?php echo $tbCadastroFaxDDDPrincipal; ?>)<?php } ?> 
                                    <?php echo $tbCadastroFaxPrincipal; ?>
                                </td>
                              </tr>
                        
                              <?php if($GLOBALS['habilitarCadastroSite'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroSitePrincipal"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <a href="<?php echo $tbCadastroSitePrincipal; ?>" target="_blank" class="AdmLinks01">
                                        <?php echo $tbCadastroSitePrincipal; ?>
                                    </a>
                                </td>
                              </tr>
                              <?php } ?>
                        
                              <?php if($GLOBALS['habilitarCadastroNFuncionarios'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroNFuncionarios"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroNFuncionarios; ?>
                                </td>
                              </tr>
                              <?php } ?>
                        
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroObs"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroOBSInterno; ?>
                                </td>
                              </tr>
                              
                              <?php if($GLOBALS['habilitarCadastroVinculo1'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroVinculo1Nome'], "IncludeConfig"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <a href="CadastroAdministrar.php?idTbCadastro=<?php echo $tbCadastroIdTbCadastro1; ?>" target="_blank" class="AdmLinks01"> 
                                        <?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($tbCadastroIdTbCadastro1, "tb_cadastro", "nome"), DbFuncoes::GetCampoGenerico01($tbCadastroIdTbCadastro1, "tb_cadastro", "razao_social"), DbFuncoes::GetCampoGenerico01($tbCadastroIdTbCadastro1, "tb_cadastro", "nome_fantasia"), 1)); ?>
                                    </a>
                                </td>
                              </tr>
                              <?php } ?>
                    
                              <?php if($GLOBALS['habilitarCadastroVinculo2'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroVinculo2Nome'], "IncludeConfig"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <a href="CadastroAdministrar.php?idTbCadastro=<?php echo $tbCadastroIdTbCadastro2; ?>" target="_blank" class="AdmLinks01"> 
                                        <?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($tbCadastroIdTbCadastro2, "tb_cadastro", "nome"), DbFuncoes::GetCampoGenerico01($tbCadastroIdTbCadastro2, "tb_cadastro", "razao_social"), DbFuncoes::GetCampoGenerico01($tbCadastroIdTbCadastro2, "tb_cadastro", "nome_fantasia"), 1)); ?>
                                    </a>
                                </td>
                              </tr>
                              <?php } ?>
                              <?php if($GLOBALS['habilitarCadastroVinculo3'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroVinculo3Nome'], "IncludeConfig"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <a href="CadastroAdministrar.php?idTbCadastro=<?php echo $tbCadastroIdTbCadastro3; ?>" target="_blank" class="AdmLinks01"> 
                                        <?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($tbCadastroIdTbCadastro3, "tb_cadastro", "nome"), DbFuncoes::GetCampoGenerico01($tbCadastroIdTbCadastro3, "tb_cadastro", "razao_social"), DbFuncoes::GetCampoGenerico01($tbCadastroIdTbCadastro3, "tb_cadastro", "nome_fantasia"), 1)); ?>
                                    </a>
                                </td>
                              </tr>
                              <?php } ?>
                        
                              <?php if($GLOBALS['habilitarCadastroStatus'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroStatus"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroIdTbCadastroStatus_print; ?>
                                </td>
                              </tr>
                              <?php } ?>
                        
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao3"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroAtivacao_print; ?>
                                </td>
                              </tr>
                        
                              <?php if($GLOBALS['habilitarCadastroAtivacaoMalaDireta'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroAtivacaoMalaDireta"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroAtivacaoMalaDireta_print; ?>
                                </td>
                              </tr>
                              <?php } ?>
                        
                              <?php if($GLOBALS['habilitarCadastroUsuario'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroUsuario"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroUsuario; ?>
                                </td>
                              </tr>
                              <?php } ?>
                        
                              <?php if($GLOBALS['habilitarCadastroSenha'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroSenha"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroSenha; ?>
                                </td>
                              </tr>
                              <?php } ?>
                        
                              <?php if($GLOBALS['habilitarCadastroImagem'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemImagem"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php if(!empty($tbCadastroImagem)){ //if($tbCategoriasImagem <> ""){?>
                                    <td width="1">
                                        <img src="<?php echo $GLOBALS['configDiretorioArquivos'];?>/r<?php echo $tbCadastroImagem; ?>?variavelCache=<?php echo date("s"); ?>" alt="<?php echo $tbCadastroImagem; ?>" style="margin-left: 4px;" />
                                    </td>
                                    <td>
                                        <a href="RegistrosArquivosExcluirExe.php?idRegistro=<?php echo $tbCadastroId;?>&strTabela=tb_cadastro&strCampo=imagem<?php echo $queryPadrao;?>" class="LinksExcluir01" style="margin-left: 4px;">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemImagemExcluir"); ?>
                                        </a>
                                    </td>
                                    <?php } ?>
                                </td>
                              </tr>
                              <?php } ?>
                        
                              <?php if($GLOBALS['habilitarCadastroLogo'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroLogo"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                    
                    
                                </td>
                              </tr>
                              <?php } ?>
                        
                              <?php if($GLOBALS['habilitarCadastroBanner'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroBanner"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                    
                    
                                </td>
                              </tr>
                              <?php } ?>
                        
                              <?php if($GLOBALS['habilitarCadastroMapa'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroMapaImagem"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                    
                    
                                </td>
                              </tr>
                              <?php } ?>
                        
                              <?php if($GLOBALS['habilitarCadastroMapaOnline'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroMapaImagem"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroMapaOnline; ?>
                                </td>
                              </tr>
                              <?php } ?>
                        
                              <?php if($GLOBALS['habilitarCadastroApresentacao'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroApresentacao"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroApresentacao; ?>
                                </td>
                              </tr>
                              <?php } ?>
                        
                              <?php if($GLOBALS['habilitarCadastroServicos'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroServicos"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroServicos; ?>
                                </td>
                              </tr>
                              <?php } ?>
                        
                              <?php if($GLOBALS['HabilitarCadastroPromocoes'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroPromocoes"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroPromocoes; ?>
                                </td>
                              </tr>
                              <?php } ?>
                        
                              <?php if($GLOBALS['habilitarCadastroCondicoesComerciais'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroCondicoesComerciais"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroCondicoesComerciais; ?>
                                </td>
                              </tr>
                    
                              <?php } ?>
                        
                              <?php if($GLOBALS['habilitarCadastroFormasPagamento'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroFormasPagamento"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroFormasPagamento; ?>
                                </td>
                              </tr>
                              <?php } ?>
                              
                              <?php if($GLOBALS['habilitarCadastroHorarioAtendimento'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroHorarioAtendimento"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroHorarioAtendimento; ?>
                                </td>
                              </tr>
                              <?php } ?>
                        
                              <?php if($GLOBALS['habilitarCadastroSituacaoAtual'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroSituacaoAtual"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroSituacaoAtual; ?>
                                </td>
                              </tr>
                              <?php } ?>
                        
                              <?php if($GLOBALS['habilitarCadastroIc1'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc1'], "IncludeConfig"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroIC1; ?>
                                </td>
                              </tr>
                              <?php } ?>
                        
                              <?php if($GLOBALS['habilitarCadastroIc2'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc2'], "IncludeConfig"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroIC2; ?>
                                </td>
                              </tr>
                              <?php } ?>
                              
                              <?php if($GLOBALS['habilitarCadastroIc3'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc3'], "IncludeConfig"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroIC3; ?>
                                </td>
                              </tr>
                              <?php } ?>
                              
                              <?php if($GLOBALS['habilitarCadastroIc4'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc4'], "IncludeConfig"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroIC4; ?>
                                </td>
                              </tr>
                              <?php } ?>
                              
                              <?php if($GLOBALS['habilitarCadastroIc5'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc5'], "IncludeConfig"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroIC5; ?>
                                </td>
                              </tr>
                              <?php } ?>
                              
                              <?php if($GLOBALS['habilitarCadastroIc6'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc6'], "IncludeConfig"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroIC6; ?>
                                </td>
                              </tr>
                              <?php } ?>
                              
                              <?php if($GLOBALS['habilitarCadastroIc7'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc7'], "IncludeConfig"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroIC7; ?>
                                </td>
                              </tr>
                              <?php } ?>
                              
                              <?php if($GLOBALS['habilitarCadastroIc8'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc8'], "IncludeConfig"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroIC8; ?>
                                </td>
                              </tr>
                              <?php } ?>
                              
                              <?php if($GLOBALS['habilitarCadastroIc9'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc9'], "IncludeConfig"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroIC9; ?>
                                </td>
                              </tr>
                              <?php } ?>
                              
                              <?php if($GLOBALS['habilitarCadastroIc10'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc10'], "IncludeConfig"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroIC10; ?>
                                </td>
                              </tr>
                              <?php } ?>
                              
                              <?php if($GLOBALS['habilitarCadastroIc11'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc11'], "IncludeConfig"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroIC11; ?>
                                </td>
                              </tr>
                              <?php } ?>
                        
                              <?php if($GLOBALS['habilitarCadastroIc12'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc12'], "IncludeConfig"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroIC12; ?>
                                </td>
                              </tr>
                              <?php } ?>
                              
                              <?php if($GLOBALS['habilitarCadastroIc13'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc13'], "IncludeConfig"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroIC13; ?>
                                </td>
                              </tr>
                              <?php } ?>
                              
                              <?php if($GLOBALS['habilitarCadastroIc14'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc14'], "IncludeConfig"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroIC14; ?>
                                </td>
                              </tr>
                              <?php } ?>
                              
                              <?php if($GLOBALS['habilitarCadastroIc15'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc15'], "IncludeConfig"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroIC15; ?>
                                </td>
                              </tr>
                              <?php } ?>
                              
                              <?php if($GLOBALS['habilitarCadastroIc16'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc16'], "IncludeConfig"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroIC16; ?>
                                </td>
                              </tr>
                              <?php } ?>
                              
                              <?php if($GLOBALS['habilitarCadastroIc17'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc17'], "IncludeConfig"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroIC17; ?>
                                </td>
                              </tr>
                              <?php } ?>
                              
                              <?php if($GLOBALS['habilitarCadastroIc18'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc18'], "IncludeConfig"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroIC18; ?>
                                </td>
                              </tr>
                              <?php } ?>
                              
                              <?php if($GLOBALS['habilitarCadastroIc19'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc19'], "IncludeConfig"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroIC19; ?>
                                </td>
                              </tr>
                              <?php } ?>
                              
                              <?php if($GLOBALS['habilitarCadastroIc20'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc20'], "IncludeConfig"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroIC20; ?>
                                </td>
                              </tr>
                              <?php } ?>
                              
                              <?php if($GLOBALS['habilitarCadastroIc31'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc31'], "IncludeConfig"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroIC31; ?>
                                </td>
                              </tr>
                              <?php } ?>
                        
                              <?php if($GLOBALS['habilitarCadastroIc32'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc32'], "IncludeConfig"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroIC32; ?>
                                </td>
                              </tr>
                              <?php } ?>
                              
                              <?php if($GLOBALS['habilitarCadastroIc33'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc33'], "IncludeConfig"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroIC33; ?>
                                </td>
                              </tr>
                              <?php } ?>
                              
                              <?php if($GLOBALS['habilitarCadastroIc34'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc34'], "IncludeConfig"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroIC34; ?>
                                </td>
                              </tr>
                              <?php } ?>
                              
                              <?php if($GLOBALS['habilitarCadastroIc35'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc35'], "IncludeConfig"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroIC35; ?>
                                </td>
                              </tr>
                              <?php } ?>
                              
                              <?php if($GLOBALS['habilitarCadastroIc36'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc36'], "IncludeConfig"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroIC36; ?>
                                </td>
                              </tr>
                              <?php } ?>
                              
                              <?php if($GLOBALS['habilitarCadastroIc37'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc37'], "IncludeConfig"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroIC37; ?>
                                </td>
                              </tr>
                              <?php } ?>
                              
                              <?php if($GLOBALS['habilitarCadastroIc38'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc38'], "IncludeConfig"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroIC38; ?>
                                </td>
                              </tr>
                              <?php } ?>
                              
                              <?php if($GLOBALS['habilitarCadastroIc39'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc39'], "IncludeConfig"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroIC39; ?>
                                </td>
                              </tr>
                              <?php } ?>
                              
                              <?php if($GLOBALS['habilitarCadastroIc40'] == 1){ ?>
                              <tr>
                                <td class="AdmTbFundoMedio TabelaColuna01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc40'], "IncludeConfig"); ?>:
                                </td>
                                <td colspan="3" class="AdmTbFundoClaro">
                                    <?php echo $tbCadastroIC40; ?>
                                </td>
                              </tr>
                              <?php } ?>
                              
                            </table>
                        </div>
                        <?php //---------------------- ?>
                    </div>
                </td>
                
              	<?php if($GLOBALS['habilitarCadastroData1'] == 1){ ?>
                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
						<?php echo Funcoes::DataLeitura01($linhaCadastro['data1'], $GLOBALS['configSiteFormatoData'], "1"); ?>
                    </div>
                </td>
              	<?php } ?>
              	<?php if($GLOBALS['habilitarCadastroData2'] == 1){ ?>
                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
						<?php echo Funcoes::DataLeitura01($linhaCadastro['data2'], $GLOBALS['configSiteFormatoData'], "1"); ?>
                    </div>
                </td>
              	<?php } ?>
              	<?php if($GLOBALS['habilitarCadastroData3'] == 1){ ?>
                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
						<?php echo Funcoes::DataLeitura01($linhaCadastro['data3'], $GLOBALS['configSiteFormatoData'], "1"); ?>
                    </div>
                </td>
              	<?php } ?>
              	<?php if($GLOBALS['habilitarCadastroData4'] == 1){ ?>
                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
						<?php echo Funcoes::DataLeitura01($linhaCadastro['data4'], $GLOBALS['configSiteFormatoData'], "1"); ?>
                    </div>
                </td>
              	<?php } ?>
              	<?php if($GLOBALS['habilitarCadastroData5'] == 1){ ?>
                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
						<?php echo Funcoes::DataLeitura01($linhaCadastro['data5'], $GLOBALS['configSiteFormatoData'], "1"); ?>
                    </div>
                </td>
              	<?php } ?>
                
				<?php if($GLOBALS['habilitarCadastroFiltroGenerico01'] == 1){ ?>
                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                    	<?php 
						$arrCadastroFiltroGenerico01Selecao = "";
						$arrCadastroFiltroGenerico01Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($linhaCadastro['id'], "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "12", "", ",", "", "1")); 
						?>
                        <?php if($arrCadastroFiltroGenerico01Selecao <> ""){ ?>
							<?php 
                            for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico01); $countArray++)
                            {
                            ?>
                                <div>
                                    <?php if(in_array($arrCadastroFiltroGenerico01[$countArray][0], $arrCadastroFiltroGenerico01Selecao)){ ?> 
                                        <?php echo $arrCadastroFiltroGenerico01[$countArray][1];?>
                                    <?php } ?>
                                </div>
                            <?php 
							}
							?>
                        <?php } ?>
                    </div>
                </td>
				<?php } ?>
				<?php if($GLOBALS['habilitarCadastroFiltroGenerico02'] == 1){ ?>
                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                    	<?php 
						$arrCadastroFiltroGenerico02Selecao = "";
						$arrCadastroFiltroGenerico02Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($linhaCadastro['id'], "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "13", "", ",", "", "1")); 
						?>
                        <?php if($arrCadastroFiltroGenerico02Selecao <> ""){ ?>
							<?php 
                            for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico02); $countArray++)
                            {
                            ?>
                                <div>
                                    <?php if(in_array($arrCadastroFiltroGenerico02[$countArray][0], $arrCadastroFiltroGenerico02Selecao)){ ?> 
                                        <?php echo $arrCadastroFiltroGenerico02[$countArray][1];?>
                                    <?php } ?>
                                </div>
                            <?php 
							}
							?>
                        <?php } ?>
                    </div>
                </td>
				<?php } ?>
				<?php if($GLOBALS['habilitarCadastroFiltroGenerico03'] == 1){ ?>
                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                    	<?php 
						$arrCadastroFiltroGenerico03Selecao = "";
						$arrCadastroFiltroGenerico03Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($linhaCadastro['id'], "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "14", "", ",", "", "1")); 
						?>
                        <?php if($arrCadastroFiltroGenerico03Selecao <> ""){ ?>
							<?php 
                            for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico03); $countArray++)
                            {
                            ?>
                                <div>
                                    <?php if(in_array($arrCadastroFiltroGenerico03[$countArray][0], $arrCadastroFiltroGenerico03Selecao)){ ?> 
                                        <?php echo $arrCadastroFiltroGenerico03[$countArray][1];?>
                                    <?php } ?>
                                </div>
                            <?php 
							}
							?>
                        <?php } ?>
                    </div>
                </td>
				<?php } ?>
				<?php if($GLOBALS['habilitarCadastroFiltroGenerico04'] == 1){ ?>
                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                    	<?php 
						$arrCadastroFiltroGenerico04Selecao = "";
						$arrCadastroFiltroGenerico04Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($linhaCadastro['id'], "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "15", "", ",", "", "1")); 
						?>
                        <?php if($arrCadastroFiltroGenerico04Selecao <> ""){ ?>
							<?php 
                            for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico04); $countArray++)
                            {
                            ?>
                                <div>
                                    <?php if(in_array($arrCadastroFiltroGenerico04[$countArray][0], $arrCadastroFiltroGenerico04Selecao)){ ?> 
                                        <?php echo $arrCadastroFiltroGenerico04[$countArray][1];?>
                                    <?php } ?>
                                </div>
                            <?php 
							}
							?>
                        <?php } ?>
                    </div>
                </td>
				<?php } ?>
				<?php if($GLOBALS['habilitarCadastroFiltroGenerico05'] == 1){ ?>
                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                    	<?php 
						$arrCadastroFiltroGenerico05Selecao = "";
						$arrCadastroFiltroGenerico05Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($linhaCadastro['id'], "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "16", "", ",", "", "1")); 
						?>
                        <?php if($arrCadastroFiltroGenerico05Selecao <> ""){ ?>
							<?php 
                            for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico05); $countArray++)
                            {
                            ?>
                                <div>
                                    <?php if(in_array($arrCadastroFiltroGenerico05[$countArray][0], $arrCadastroFiltroGenerico05Selecao)){ ?> 
                                        <?php echo $arrCadastroFiltroGenerico05[$countArray][1];?>
                                    <?php } ?>
                                </div>
                            <?php 
							}
							?>
                        <?php } ?>
                    </div>
                </td>
				<?php } ?>
				<?php if($GLOBALS['habilitarCadastroFiltroGenerico06'] == 1){ ?>
                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                    	<?php 
						$arrCadastroFiltroGenerico06Selecao = "";
						$arrCadastroFiltroGenerico06Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($linhaCadastro['id'], "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "17", "", ",", "", "1")); 
						?>
                        <?php if($arrCadastroFiltroGenerico06Selecao <> ""){ ?>
							<?php 
                            for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico06); $countArray++)
                            {
                            ?>
                                <div>
                                    <?php if(in_array($arrCadastroFiltroGenerico06[$countArray][0], $arrCadastroFiltroGenerico06Selecao)){ ?> 
                                        <?php echo $arrCadastroFiltroGenerico06[$countArray][1];?>
                                    <?php } ?>
                                </div>
                            <?php 
							}
							?>
                        <?php } ?>
                    </div>
                </td>
				<?php } ?>
				<?php if($GLOBALS['habilitarCadastroFiltroGenerico07'] == 1){ ?>
                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                    	<?php 
						$arrCadastroFiltroGenerico07Selecao = "";
						$arrCadastroFiltroGenerico07Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($linhaCadastro['id'], "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "18", "", ",", "", "1")); 
						?>
                        <?php if($arrCadastroFiltroGenerico07Selecao <> ""){ ?>
							<?php 
                            for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico07); $countArray++)
                            {
                            ?>
                                <div>
                                    <?php if(in_array($arrCadastroFiltroGenerico07[$countArray][0], $arrCadastroFiltroGenerico07Selecao)){ ?> 
                                        <?php echo $arrCadastroFiltroGenerico07[$countArray][1];?>
                                    <?php } ?>
                                </div>
                            <?php 
							}
							?>
                        <?php } ?>
                    </div>
                </td>
				<?php } ?>
				<?php if($GLOBALS['habilitarCadastroFiltroGenerico08'] == 1){ ?>
                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                    	<?php 
						$arrCadastroFiltroGenerico08Selecao = "";
						$arrCadastroFiltroGenerico08Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($linhaCadastro['id'], "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "19", "", ",", "", "1")); 
						?>
                        <?php if($arrCadastroFiltroGenerico08Selecao <> ""){ ?>
							<?php 
                            for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico08); $countArray++)
                            {
                            ?>
                                <div>
                                    <?php if(in_array($arrCadastroFiltroGenerico08[$countArray][0], $arrCadastroFiltroGenerico08Selecao)){ ?> 
                                        <?php echo $arrCadastroFiltroGenerico08[$countArray][1];?>
                                    <?php } ?>
                                </div>
                            <?php 
							}
							?>
                        <?php } ?>
                    </div>
                </td>
				<?php } ?>
				<?php if($GLOBALS['habilitarCadastroFiltroGenerico09'] == 1){ ?>
                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                    	<?php 
						$arrCadastroFiltroGenerico09Selecao = "";
						$arrCadastroFiltroGenerico09Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($linhaCadastro['id'], "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "20", "", ",", "", "1")); 
						?>
                        <?php if($arrCadastroFiltroGenerico09Selecao <> ""){ ?>
							<?php 
                            for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico09); $countArray++)
                            {
                            ?>
                                <div>
                                    <?php if(in_array($arrCadastroFiltroGenerico09[$countArray][0], $arrCadastroFiltroGenerico09Selecao)){ ?> 
                                        <?php echo $arrCadastroFiltroGenerico09[$countArray][1];?>
                                    <?php } ?>
                                </div>
                            <?php 
							}
							?>
                        <?php } ?>
                    </div>
                </td>
				<?php } ?>
				<?php if($GLOBALS['habilitarCadastroFiltroGenerico10'] == 1){ ?>
                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                    	<?php 
						$arrCadastroFiltroGenerico10Selecao = "";
						$arrCadastroFiltroGenerico10Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($linhaCadastro['id'], "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "21", "", ",", "", "1")); 
						?>
                        <?php if($arrCadastroFiltroGenerico10Selecao <> ""){ ?>
							<?php 
                            for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico10); $countArray++)
                            {
                            ?>
                                <div>
                                    <?php if(in_array($arrCadastroFiltroGenerico10[$countArray][0], $arrCadastroFiltroGenerico10Selecao)){ ?> 
                                        <?php echo $arrCadastroFiltroGenerico10[$countArray][1];?>
                                    <?php } ?>
                                </div>
                            <?php 
							}
							?>
                        <?php } ?>
                    </div>
                </td>
				<?php } ?>
                
              	<?php if($GLOBALS['habilitarCadastroIc1'] == 1){ ?>
                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar1']);?>
                    </div>
                </td>
              	<?php } ?>
                
              	<?php if($GLOBALS['habilitarCadastroIc2'] == 1){ ?>
                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar2']);?>
                    </div>
                </td>
              	<?php } ?>

                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                    	<a href="SiteAdmCadastroAdministrar.php?idTbCadastro=<?php echo $linhaCadastro['id'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01" style="display: block;">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroAdministrar"); ?>
                        </a>
                        
                        <a href="#" onclick="divShowHide('divCadastroDetalhes<?php echo $linhaCadastro['id'];?>');" class="AdmLinks01" style="display: none;">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroAdministrar"); ?>
                        </a>
                    </div>
                    <?php if($GLOBALS['habilitarCadastroLogo'] == 1){ ?>
                        <div align="center" class="AdmTexto01">
                            <a href="SiteAdmCadastroArquivosComplementares.php?idTbCadastro=<?php echo $linhaCadastro['id'];?>&campo=logo&paginaRetorno=SiteAdmCadastroIndice.php" class="AdmLinks01">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroLogoInserir"); ?>
                            </a>
                        </div>
                    <?php } ?>
                    <?php if($GLOBALS['habilitarCadastroMapa'] == 1){ ?>
                        <div align="center" class="AdmTexto01">
                            <a href="SiteAdmCadastroArquivosComplementares.php?idTbCadastro=<?php echo $linhaCadastro['id'];?>&campo=mapa&paginaRetorno=SiteAdmCadastroIndice.php" class="AdmLinks01">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroMapaInserir"); ?>
                            </a>
                        </div>
                    <?php } ?>
                    <?php if($GLOBALS['habilitarCadastroBanner'] == 1){ ?>
                        <div align="center" class="AdmTexto01">
                            <a href="SiteAdmCadastroArquivosComplementares.php?idTbCadastro=<?php echo $linhaCadastro['id'];?>&campo=banner&paginaRetorno=SiteAdmCadastroIndice.php" class="AdmLinks01">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroBannerInserir"); ?>
                            </a>
                        </div>
                    <?php } ?>
                    <?php if($GLOBALS['habilitarAdministrarCadastroContatos'] == 1){ ?>
                        <div align="center" class="AdmTexto01">
                            <a href="SiteAdmCadastroContatosIndice.php?idTbCadastro=<?php echo $linhaCadastro['id'];?>&paginaRetorno=SiteAdmCadastroIndice.php&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::GetCadastroTitulo(Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome']), Funcoes::ConteudoMascaraLeitura($linhaCadastro['razao_social']), Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome_fantasia']), 1);?>&detalhe02=" target="_blank" class="AdmLinks01">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAdmPainelContatosAdministrar"); ?>
                            </a>
                        </div>
                    <?php } ?>
                    <?php if($GLOBALS['habilitarAdministrarCadastroContasBancarias'] == 1){ ?>
                        <div align="center" class="AdmTexto01">
                            <a href="SiteAdmCadastroContasBancariasIndice.php?idTbCadastro=<?php echo $linhaCadastro['id'];?>&paginaRetorno=SiteAdmCadastroIndice.php&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::GetCadastroTitulo(Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome']), Funcoes::ConteudoMascaraLeitura($linhaCadastro['razao_social']), Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome_fantasia']), 1);?>&detalhe02=" target="_blank" class="AdmLinks01">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAdmPainelCadastroContasBancarias"); ?>
                            </a>
                        </div>
                    <?php } ?>
                    <?php if($GLOBALS['habilitarAdministrarCadastroTarefas'] == 1){ ?>
                        <div align="center" class="AdmTexto01">
                            <a href="SiteAdmTarefasIndice.php?idParent=<?php echo $linhaCadastro['id'];?>&paginaRetorno=SiteAdmCadastroIndice.php&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::GetCadastroTitulo(Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome']), Funcoes::ConteudoMascaraLeitura($linhaCadastro['razao_social']), Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome_fantasia']), 1);?>&detalhe02=" target="_blank" class="AdmLinks01">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAdmPainelTarefasAdministrar"); ?>
                            </a>
                        </div>
                    <?php } ?>
                </td>
                
                <td class="<?php if($linhaCadastro['ativacao'] == 1){/*echo "AdmTbFundoClaro";*/}else{echo "AdmTbFundoDesativado";}?> TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                    	<a href="SiteAdmRegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaCadastro['id'];?>&statusAtivacao=<?php echo $linhaCadastro['ativacao'];?>&strTabela=tb_cadastro&strCampo=ativacao<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="AdmLinks01">
                        	<?php if($linhaCadastro['ativacao'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao0"); ?>
                            <?php } ?>
                        	<?php if($linhaCadastro['ativacao'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao1"); ?>
                            <?php } ?>
                        </a>
						<?php //echo $linhaCategorias['ativacao'];?>
                    </div>
                </td>
                
                <?php if($GLOBALS['habilitarCadastroAtivacaoDestaque'] == 1){ ?>
                <td class="<?php if($linhaCadastro['ativacao_destaque'] == 1){/*echo "AdmTbFundoClaro";*/}else{echo "AdmTbFundoDesativado";}?> TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                    	<a href="SiteAdmRegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaCadastro['id'];?>&statusAtivacao=<?php echo $linhaCadastro['ativacao_destaque'];?>&strTabela=tb_cadastro&strCampo=ativacao_destaque<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="AdmLinks01">
                        	<?php if($linhaCadastro['ativacao_destaque'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao0"); ?>
                            <?php } ?>
                        	<?php if($linhaCadastro['ativacao_destaque'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao1"); ?>
                            <?php } ?>
                        </a>
						<?php //echo $linhaCategorias['ativacao'];?>
                    </div>
                </td>
				<?php } ?>

                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <a href="SiteAdmCadastroEditar.php?idTbCadastro=<?php echo $linhaCadastro['id'];?><?php echo $queryPadrao;?>" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaCadastro['id'];?>" class="AdmCampoCheckBox01" />
                    </div>
                </td>
                <td class="TabelaDados01Celula" style="display: none;">
                    <div align="center" class="AdmTexto01">
                        <!--input name="idsRegistrosSelecionar[]" type="checkbox" value="<?php echo $linhaCadastro['id'];?>" class="AdmCampoCheckBox01" /-->
                        <input name="idsRegistrosSelecionar" type="radio" value="<?php echo $linhaCadastro['id'];?>" class="AdmCampoRadioButton01" />
                    </div>
                </td>
              </tr>
              <?php 
				  //Linha alternativa de tabela.
				  //----------
				  //$countTabelaFundo = $countTabelaFundo + 1;
				  $countTabelaFundo++;
				
				   if($countTabelaFundo == 2)
				   {
					   $countTabelaFundo = 0;
				   }
				  //----------
			  } 
			  ?>
            </table>
        </form>
	<?php } ?>
	
	<?php //Paginação. ?>
    <?php //************************************************************************************** ?>
    <?php if($GLOBALS['habilitarCadastroSistemaPaginacao'] == "1"){ ?>
		<?php if($paginacaoTotal > 1){ //Verifica se existe mais de uma página.?>
            <div align="center" class="AdmTexto01">
                <div style="position: relative; display: inline; margin: 2px;">
                    <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=1<?php echo $queryPadrao; ?>" class="AdmLinks01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPaginacaoPrimeira"); ?>
                    </a>
                </div>
                
                <?php if($paginacaoNumero > 1){ ?>
                    <div style="position: relative; display: inline; margin: 2px;">
                        <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=<?php echo $paginacaoNumero - 1 ?><?php echo $queryPadrao; ?>" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPaginacaoAnterior"); ?>
                        </a>
                    </div>
                <?php } ?>
                
                <?php //Numeração de páginas. ?>
                <?php if($GLOBALS['habilitarCadastroSistemaPaginacaoNumeracao'] == "1"){ ?>
                    <?php for($countPaginas = 1; $countPaginas <= $paginacaoTotal; $countPaginas++){ ?>
                        <div style="position: relative; display: inline; margin: 2px;">
                            <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=<?php echo $countPaginas; ?><?php echo $queryPadrao; ?>" class="AdmLinks01">
                                <?php echo $countPaginas; ?>
                            </a>
                        </div>
                    <?php } ?>
                <?php } ?>
                
                <?php if($paginacaoNumero <> $paginacaoTotal){ ?>
                    <div style="position: relative; display: inline; margin: 2px;">
                        <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=<?php echo $paginacaoNumero + 1 ?><?php echo $queryPadrao; ?>" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPaginacaoProxima"); ?>
                        </a>
                    </div>
                <?php } ?>
                
                <div style="position: relative; display: inline; margin: 2px;">
                    <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=<?php echo $paginacaoTotal; ?><?php echo $queryPadrao; ?>" class="AdmLinks01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPaginacaoUltima"); ?>
                    </a>
                </div>
            </div>
            
            <?php //Contagem de páginas. ?>
            <div align="center" class="AdmTexto01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePaginacaoPaginaContador01"); ?> 
                <?php echo $paginacaoNumero; ?> / <?php echo $paginacaoTotal; ?>
            </div>
        <?php } ?>
	<?php } ?>
	<?php //************************************************************************************** ?>
	
    
    <?php if(!empty($idParentCadastro)){ ?>
	<script type="text/javascript">
        //Variável para conter todos os campos que funcionam com o DatePicker.
        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
		var strDatapickerNascimentoPtCampos = "";
		var strDatapickerNascimentoEnCampos = "";

        var strDatapickerAgendaPtCampos = "";
        var strDatapickerAgendaEnCampos = "";
    </script>
    <form name="formCadastro" id="formCadastro" action="SiteAdmCadastroIndiceExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <table class="AdmTabelaCampos01">
            <tr>
                <td class="AdmTbFundoEscuro" colspan="4">
                    <div align="center" class="AdmTexto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroTbCadastro"); ?>
                        </strong>
                    </div>
                </td>
            </tr>
            
            <?php if($GLOBALS['habilitarCadastroTipo'] == 1){ ?>
				<?php if(in_array("tipo", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroTipoCadastro"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left" class="AdmTexto01">
                            <?php 
                                /*
                                $ar = FiltrosGenericosFill01("tb_cadastro_complemento", 1);
                                foreach($ar as $key=>$value)
                                {
                                    echo $key." , ".$value,"<br />";
                                }
                                */
                                //echo FiltrosGenericosFill01("tb_cadastro_complemento", 1); 
                                //echo FiltrosGenericosFill01("tb_cadastro_complemento", 1); 
                                
                                //print_r(FiltrosGenericosFill01("tb_cadastro_complemento", 1));
                                
                                
                                //$arrCadastroTipo = FiltrosGenericosFill01("tb_cadastro_complemento", 1);
                                $arrCadastroTipo = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 1);
                                //print_r($arrCadastroTipo);
    
                                //for($countArray = 0; $countArray > count(FiltrosGenericosFill01("tb_cadastro_complemento", 1)); $countArray++)
                                
                                //funcionando.
                                /*
                                for($countArray = 0; $countArray < count($arrCadastroTipo); $countArray++)
                                {
                                    echo $arrCadastroTipo[$countArray][0];
                                    echo $arrCadastroTipo[$countArray][1] . "<br>";
                                }
                                */
                            ?>
                            
                            <?php 
                            for($countArray = 0; $countArray < count($arrCadastroTipo); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsCadastroTipo[]" type="checkbox" value="<?php echo $arrCadastroTipo[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrCadastroTipo[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroAtividades'] == 1){ ?>
				<?php if(in_array("atividades", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroAtividades"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left" class="AdmTexto01">
                            <?php 
                                $arrCadastroAtividades = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 2);
                            ?>
                            <select id="idsCadastroAtividades[]" name="idsCadastroAtividades[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroAtividades); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroAtividades[$countArray][0];?>"><?php echo $arrCadastroAtividades[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
            
			<?php if(in_array("nome", $arrCadastroFormularioCampos) == true || in_array("n_classificacao", $arrCadastroFormularioCampos) == true){?>
            <tr>
            	<?php if(in_array("nome", $arrCadastroFormularioCampos) == true){?>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroNome"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" <?php if($GLOBALS['habilitarCadastroNClassificacao'] <> 1){ ?> colspan="3" <?php } ?>>
                    <div align="left">
                        <input type="text" name="nome" id="nome" class="AdmCampoTexto02" maxlength="255" />
                    </div>
                </td>
                <?php } ?>
                <?php if($GLOBALS['habilitarCadastroNClassificacao'] == 1){ ?>
                	<?php if(in_array("n_classificacao", $arrCadastroFormularioCampos) == true){?>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNClassificacao"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaColuna01">
                    <div>
                        <input type="text" name="n_classificacao" id="n_classificacao" class="AdmCampoNumerico01" maxlength="10" value="0" />
                    </div>
                </td>
					<?php } ?>
                <?php } ?>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarCadastroSexo'] == 1 || $GLOBALS['habilitarCadastroPfPj'] == 1){ ?>
            <tr>
                <?php if($GLOBALS['habilitarCadastroSexo'] == 1){ ?>
					<?php if(in_array("sexo", $arrCadastroFormularioCampos) == true){?>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroSexo"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro"<?php if($GLOBALS['habilitarCadastroPfPj'] <> 1){ ?> colspan="3"<?php } ?>>
                        <div align="left" class="AdmTexto01">
                            <select name="sexo" id="sexo" class="AdmCampoDropDownMenu01">
                                <option value="1" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroSexo1"); ?></option>
                                <option value="2"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroSexo2"); ?></option>
                            </select>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>

                <?php if($GLOBALS['habilitarCadastroPfPj'] == 1){ ?>
					<?php if(in_array("pf_pj", $arrCadastroFormularioCampos) == true){?>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroPfPj"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaColuna01"<?php if($GLOBALS['habilitarCadastroSexo'] <> 1){ ?> colspan="3"<?php } ?>>
                        <div>
                            <select name="pf_pj" id="pf_pj" class="AdmCampoDropDownMenu01">
                                <option value="1" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroPfPj1"); ?></option>
                                <option value="2"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroPfPj2"); ?></option>
                            </select>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico01'] == 1){ ?>
            	<?php if(in_array("ids_cadastro_filtro_generico01", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico01Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                                $arrCadastroFiltroGenerico01 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 12);
                            ?>
                            
                            <?php if($GLOBALS['configCadastroFiltroGenerico01CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico01); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsCadastroFiltroGenerico01[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico01[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico01[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico01CaixaSelecao'] == 2){ ?>
                                <select id="idsCadastroFiltroGenerico01[]" name="idsCadastroFiltroGenerico01[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico01); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrCadastroFiltroGenerico01[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico01[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico01CaixaSelecao'] == 3){ ?>
                                <select id="idsCadastroFiltroGenerico01[]" name="idsCadastroFiltroGenerico01[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico01); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrCadastroFiltroGenerico01[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico01[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php if(empty($arrCadastroFiltroGenerico01)){ ?>
                                <a href="CadastroManutencao.php" class="AdmLinks01" style="display: none;">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
				<?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico02'] == 1){ ?>
				<?php if(in_array("ids_cadastro_filtro_generico02", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico02Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                                $arrCadastroFiltroGenerico02 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 13);
                            ?>
                            
                            <?php if($GLOBALS['configCadastroFiltroGenerico02CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico02); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsCadastroFiltroGenerico02[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico02[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico02[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico02CaixaSelecao'] == 2){ ?>
                                <select id="idsCadastroFiltroGenerico02[]" name="idsCadastroFiltroGenerico02[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico02); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrCadastroFiltroGenerico02[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico02[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico02CaixaSelecao'] == 3){ ?>
                                <select id="idsCadastroFiltroGenerico02[]" name="idsCadastroFiltroGenerico02[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico02); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrCadastroFiltroGenerico02[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico02[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php if(empty($arrCadastroFiltroGenerico02)){ ?>
                                <a href="CadastroManutencao.php" class="AdmLinks01" style="display: none;">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
				<?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico03'] == 1){ ?>
            	<?php if(in_array("ids_cadastro_filtro_generico03", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico03Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                                $arrCadastroFiltroGenerico03 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 14);
                            ?>
                            
                            <?php if($GLOBALS['configCadastroFiltroGenerico03CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico03); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsCadastroFiltroGenerico03[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico03[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico03[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico03CaixaSelecao'] == 2){ ?>
                                <select id="idsCadastroFiltroGenerico03[]" name="idsCadastroFiltroGenerico03[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico03); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrCadastroFiltroGenerico03[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico03[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico03CaixaSelecao'] == 3){ ?>
                                <select id="idsCadastroFiltroGenerico03[]" name="idsCadastroFiltroGenerico03[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico03); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrCadastroFiltroGenerico03[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico03[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php if(empty($arrCadastroFiltroGenerico03)){ ?>
                                <a href="CadastroManutencao.php" class="AdmLinks01" style="display: none;">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
				<?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico04'] == 1){ ?>
            	<?php if(in_array("ids_cadastro_filtro_generico04", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico04Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                                $arrCadastroFiltroGenerico04 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 15);
                            ?>
                            
                            <?php if($GLOBALS['configCadastroFiltroGenerico04CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico04); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsCadastroFiltroGenerico04[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico04[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico04[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico04CaixaSelecao'] == 2){ ?>
                                <select id="idsCadastroFiltroGenerico04[]" name="idsCadastroFiltroGenerico04[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico04); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrCadastroFiltroGenerico04[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico04[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico04CaixaSelecao'] == 3){ ?>
                                <select id="idsCadastroFiltroGenerico04[]" name="idsCadastroFiltroGenerico04[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico04); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrCadastroFiltroGenerico04[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico04[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php if(empty($arrCadastroFiltroGenerico04)){ ?>
                                <a href="CadastroManutencao.php" class="AdmLinks01" style="display: none;">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
				<?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico05'] == 1){ ?>
            	<?php if(in_array("ids_cadastro_filtro_generico05", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico05Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                                $arrCadastroFiltroGenerico05 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 16);
                            ?>
                            
                            <?php if($GLOBALS['configCadastroFiltroGenerico05CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico05); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsCadastroFiltroGenerico05[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico05[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico05[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico05CaixaSelecao'] == 2){ ?>
                                <select id="idsCadastroFiltroGenerico05[]" name="idsCadastroFiltroGenerico05[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico05); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrCadastroFiltroGenerico05[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico05[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico05CaixaSelecao'] == 3){ ?>
                                <select id="idsCadastroFiltroGenerico05[]" name="idsCadastroFiltroGenerico05[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico05); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrCadastroFiltroGenerico05[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico05[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php if(empty($arrCadastroFiltroGenerico05)){ ?>
                                <a href="CadastroManutencao.php" class="AdmLinks01" style="display: none;">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
				<?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico06'] == 1){ ?>
            	<?php if(in_array("ids_cadastro_filtro_generico06", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico06Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                                $arrCadastroFiltroGenerico06 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 17);
                            ?>
                            
                            <?php if($GLOBALS['configCadastroFiltroGenerico06CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico06); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsCadastroFiltroGenerico06[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico06[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico06[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico06CaixaSelecao'] == 2){ ?>
                                <select id="idsCadastroFiltroGenerico06[]" name="idsCadastroFiltroGenerico06[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico06); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrCadastroFiltroGenerico06[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico06[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico06CaixaSelecao'] == 3){ ?>
                                <select id="idsCadastroFiltroGenerico06[]" name="idsCadastroFiltroGenerico06[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico06); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrCadastroFiltroGenerico06[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico06[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php if(empty($arrCadastroFiltroGenerico06)){ ?>
                                <a href="CadastroManutencao.php" class="AdmLinks01" style="display: none;">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
				<?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico07'] == 1){ ?>
            	<?php if(in_array("ids_cadastro_filtro_generico07", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico07Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                                $arrCadastroFiltroGenerico07 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 18);
                            ?>
                            
                            <?php if($GLOBALS['configCadastroFiltroGenerico07CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico07); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsCadastroFiltroGenerico07[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico07[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico07[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico07CaixaSelecao'] == 2){ ?>
                                <select id="idsCadastroFiltroGenerico07[]" name="idsCadastroFiltroGenerico07[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico07); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrCadastroFiltroGenerico07[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico07[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico07CaixaSelecao'] == 3){ ?>
                                <select id="idsCadastroFiltroGenerico07[]" name="idsCadastroFiltroGenerico07[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico07); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrCadastroFiltroGenerico07[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico07[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php if(empty($arrCadastroFiltroGenerico07)){ ?>
                                <a href="CadastroManutencao.php" class="AdmLinks01" style="display: none;">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
				<?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico08'] == 1){ ?>
            	<?php if(in_array("ids_cadastro_filtro_generico08", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico08Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                                $arrCadastroFiltroGenerico08 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 19);
                            ?>
                            
                            <?php if($GLOBALS['configCadastroFiltroGenerico08CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico08); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsCadastroFiltroGenerico08[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico08[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico08[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico08CaixaSelecao'] == 2){ ?>
                                <select id="idsCadastroFiltroGenerico08[]" name="idsCadastroFiltroGenerico08[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico08); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrCadastroFiltroGenerico08[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico08[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico08CaixaSelecao'] == 3){ ?>
                                <select id="idsCadastroFiltroGenerico08[]" name="idsCadastroFiltroGenerico08[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico08); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrCadastroFiltroGenerico08[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico08[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php if(empty($arrCadastroFiltroGenerico08)){ ?>
                                <a href="CadastroManutencao.php" class="AdmLinks01" style="display: none;">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
				<?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico09'] == 1){ ?>
            	<?php if(in_array("ids_cadastro_filtro_generico09", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico09Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                                $arrCadastroFiltroGenerico09 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 20);
                            ?>
                            
                            <?php if($GLOBALS['configCadastroFiltroGenerico09CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico09); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsCadastroFiltroGenerico09[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico09[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico09[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico09CaixaSelecao'] == 2){ ?>
                                <select id="idsCadastroFiltroGenerico09[]" name="idsCadastroFiltroGenerico09[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico09); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrCadastroFiltroGenerico09[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico09[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico09CaixaSelecao'] == 3){ ?>
                                <select id="idsCadastroFiltroGenerico09[]" name="idsCadastroFiltroGenerico09[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico09); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrCadastroFiltroGenerico09[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico09[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php if(empty($arrCadastroFiltroGenerico09)){ ?>
                                <a href="CadastroManutencao.php" class="AdmLinks01" style="display: none;">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
				<?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico10'] == 1){ ?>
            	<?php if(in_array("ids_cadastro_filtro_generico10", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico10Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                                $arrCadastroFiltroGenerico10 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 21);
                            ?>
                            
                            <?php if($GLOBALS['configCadastroFiltroGenerico10CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico10); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsCadastroFiltroGenerico10[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico10[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico10[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico10CaixaSelecao'] == 2){ ?>
                                <select id="idsCadastroFiltroGenerico10[]" name="idsCadastroFiltroGenerico10[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico10); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrCadastroFiltroGenerico10[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico10[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico10CaixaSelecao'] == 3){ ?>
                                <select id="idsCadastroFiltroGenerico10[]" name="idsCadastroFiltroGenerico10[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico10); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrCadastroFiltroGenerico10[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico10[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php if(empty($arrCadastroFiltroGenerico10)){ ?>
                                <a href="CadastroManutencao.php" class="AdmLinks01" style="display: none;">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
				<?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroAlturaPeso'] == 1){ ?>
            <tr>
                <?php if(in_array("altura", $arrCadastroFormularioCampos) == true){?>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroAltura"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro">
                    <div align="left" class="AdmTexto01">
                        <input type="text" name="altura" id="altura" class="AdmCampoNumerico01" maxlength="10" value="0" />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroAlturaMedida"); ?>
                    </div>
                </td>
                <?php } ?>
                <?php if(in_array("peso", $arrCadastroFormularioCampos) == true){?>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroPeso"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <input type="text" name="peso" id="peso" class="AdmCampoNumerico01" maxlength="10" value="0" />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroPesoMedida"); ?>
                     </div>
                </td>
                <?php } ?>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroRazaoSocial'] == 1){ ?>
            	<?php if(in_array("razao_social", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroRazaoSocial"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left">
                            <input type="text" name="razao_social" id="razao_social" class="AdmCampoTexto02" maxlength="255" />
                            <?php //print_r($arrCadastroFormularioCampos);?>
                        </div>
                    </td>
                </tr>
				<?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroNomeFantasia'] == 1){ ?>
            	<?php if(in_array("nome_fantasia", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroNomeFantasia"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left">
                            <input type="text" name="nome_fantasia" id="nome_fantasia" class="AdmCampoTexto02" maxlength="255" />
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroDataNascimento'] == 1){ ?>
				<?php if(in_array("data_nascimento", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroDataNascimento"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left">
                            <?php //JQuery DatePicker. ?>
                            <?php //---------------------- ?>
                            <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 1){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerNascimentoPtCampos = "#data_nascimento";
                                        strDatapickerNascimentoPtCampos = strDatapickerNascimentoPtCampos + "#data_nascimento;";
                                    </script>
                                <?php } ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 2){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerNascimentoEnCampos = "#data_nascimento";
                                        strDatapickerNascimentoEnCampos = strDatapickerNascimentoEnCampos + "#data_nascimento;";
                                    </script>
                                <?php } ?>
                                <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                            
                                <input type="text" name="data_nascimento" id="data_nascimento" class="AdmCampoData01" maxlength="10" />
                                <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                            <?php } ?>
                            <?php //---------------------- ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroData1'] == 1){ ?>
				<?php if(in_array("data1", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData1'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left">
                            <?php //JQuery DatePicker. ?>
                            <?php //---------------------- ?>
                            <?php if($GLOBALS['configTipoCampoCadastroData1'] == 1){ ?>
                                <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                    <?php if($GLOBALS['configSiteFormatoData'] == 1){ ?>
                                        <script type="text/javascript">
                                            //Variável para conter todos os campos que funcionam com o DatePicker.
                                            //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                            //var strDatapickerAgendaPtCampos = "#data1";
                                            strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data1;";
                                        </script>
                                    <?php } ?>
                                    <?php if($GLOBALS['configSiteFormatoData'] == 2){ ?>
                                        <script type="text/javascript">
                                            //Variável para conter todos os campos que funcionam com o DatePicker.
                                            //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                            //var strDatapickerAgendaEnCampos = "#data1";
                                            strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data1;";
                                        </script>
                                    <?php } ?>
                                    <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                                
                                    <input type="text" name="data1" id="data1" class="AdmCampoData01" maxlength="10" />
                                    <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                                <?php } ?>
                            <?php } ?>
                            <?php //---------------------- ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroData2'] == 1){ ?>
				<?php if(in_array("data2", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData2'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left">
                            <?php //JQuery DatePicker. ?>
                            <?php //---------------------- ?>
                            <?php if($GLOBALS['configTipoCampoCadastroData2'] == 1){ ?>
                                <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                    <?php if($GLOBALS['configSiteFormatoData'] == 1){ ?>
                                        <script type="text/javascript">
                                            //Variável para conter todos os campos que funcionam com o DatePicker.
                                            //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                            //var strDatapickerAgendaPtCampos = "#data1";
                                            strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data2;";
                                        </script>
                                    <?php } ?>
                                    <?php if($GLOBALS['configSiteFormatoData'] == 2){ ?>
                                        <script type="text/javascript">
                                            //Variável para conter todos os campos que funcionam com o DatePicker.
                                            //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                            //var strDatapickerAgendaEnCampos = "#data1";
                                            strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data2;";
                                        </script>
                                    <?php } ?>
                                    <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                                
                                    <input type="text" name="data2" id="data2" class="AdmCampoData01" maxlength="10" />
                                    <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                                <?php } ?>
                            <?php } ?>
                            <?php //---------------------- ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroData3'] == 1){ ?>
				<?php if(in_array("data3", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData3'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left">
                            <?php //JQuery DatePicker. ?>
                            <?php //---------------------- ?>
                            <?php if($GLOBALS['configTipoCampoCadastroData3'] == 1){ ?>
                                <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                    <?php if($GLOBALS['configSiteFormatoData'] == 1){ ?>
                                        <script type="text/javascript">
                                            //Variável para conter todos os campos que funcionam com o DatePicker.
                                            //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                            //var strDatapickerAgendaPtCampos = "#data1";
                                            strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data3;";
                                        </script>
                                    <?php } ?>
                                    <?php if($GLOBALS['configSiteFormatoData'] == 2){ ?>
                                        <script type="text/javascript">
                                            //Variável para conter todos os campos que funcionam com o DatePicker.
                                            //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                            //var strDatapickerAgendaEnCampos = "#data1";
                                            strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data3;";
                                        </script>
                                    <?php } ?>
                                    <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                                
                                    <input type="text" name="data3" id="data3" class="AdmCampoData01" maxlength="10" />
                                    <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                                <?php } ?>
                            <?php } ?>
                            <?php //---------------------- ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroData4'] == 1){ ?>
				<?php if(in_array("data4", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData4'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left">
                            <?php //JQuery DatePicker. ?>
                            <?php //---------------------- ?>
                            <?php if($GLOBALS['configTipoCampoCadastroData4'] == 1){ ?>
                                <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                    <?php if($GLOBALS['configSiteFormatoData'] == 1){ ?>
                                        <script type="text/javascript">
                                            //Variável para conter todos os campos que funcionam com o DatePicker.
                                            //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                            //var strDatapickerAgendaPtCampos = "#data1";
                                            strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data4;";
                                        </script>
                                    <?php } ?>
                                    <?php if($GLOBALS['configSiteFormatoData'] == 2){ ?>
                                        <script type="text/javascript">
                                            //Variável para conter todos os campos que funcionam com o DatePicker.
                                            //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                            //var strDatapickerAgendaEnCampos = "#data1";
                                            strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data4;";
                                        </script>
                                    <?php } ?>
                                    <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                                
                                    <input type="text" name="data4" id="data4" class="AdmCampoData01" maxlength="10" />
                                    <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                                <?php } ?>
                            <?php } ?>
                            <?php //---------------------- ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroData5'] == 1){ ?>
				<?php if(in_array("data5", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData5'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left">
                            <?php //JQuery DatePicker. ?>
                            <?php //---------------------- ?>
                            <?php if($GLOBALS['configTipoCampoCadastroData5'] == 1){ ?>
                                <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                    <?php if($GLOBALS['configSiteFormatoData'] == 1){ ?>
                                        <script type="text/javascript">
                                            //Variável para conter todos os campos que funcionam com o DatePicker.
                                            //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                            //var strDatapickerAgendaPtCampos = "#data1";
                                            strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data5;";
                                        </script>
                                    <?php } ?>
                                    <?php if($GLOBALS['configSiteFormatoData'] == 2){ ?>
                                        <script type="text/javascript">
                                            //Variável para conter todos os campos que funcionam com o DatePicker.
                                            //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                            //var strDatapickerAgendaEnCampos = "#data1";
                                            strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data5;";
                                        </script>
                                    <?php } ?>
                                    <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                                
                                    <input type="text" name="data5" id="data5" class="AdmCampoData01" maxlength="10" />
                                    <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                                <?php } ?>
                            <?php } ?>
                            <?php //---------------------- ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroData6'] == 1){ ?>
				<?php if(in_array("data6", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData6'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left">
                            <?php //JQuery DatePicker. ?>
                            <?php //---------------------- ?>
                            <?php if($GLOBALS['configTipoCampoCadastroData6'] == 1){ ?>
                                <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                    <?php if($GLOBALS['configSiteFormatoData'] == 1){ ?>
                                        <script type="text/javascript">
                                            //Variável para conter todos os campos que funcionam com o DatePicker.
                                            //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                            //var strDatapickerAgendaPtCampos = "#data1";
                                            strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data6;";
                                        </script>
                                    <?php } ?>
                                    <?php if($GLOBALS['configSiteFormatoData'] == 2){ ?>
                                        <script type="text/javascript">
                                            //Variável para conter todos os campos que funcionam com o DatePicker.
                                            //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                            //var strDatapickerAgendaEnCampos = "#data1";
                                            strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data6;";
                                        </script>
                                    <?php } ?>
                                    <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                                
                                    <input type="text" name="data6" id="data6" class="AdmCampoData01" maxlength="10" />
                                    <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                                <?php } ?>
                            <?php } ?>
                            <?php //---------------------- ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroData7'] == 1){ ?>
				<?php if(in_array("data7", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData7'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left">
                            <?php //JQuery DatePicker. ?>
                            <?php //---------------------- ?>
                            <?php if($GLOBALS['configTipoCampoCadastroData7'] == 1){ ?>
                                <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                    <?php if($GLOBALS['configSiteFormatoData'] == 1){ ?>
                                        <script type="text/javascript">
                                            //Variável para conter todos os campos que funcionam com o DatePicker.
                                            //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                            //var strDatapickerAgendaPtCampos = "#data1";
                                            strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data7;";
                                        </script>
                                    <?php } ?>
                                    <?php if($GLOBALS['configSiteFormatoData'] == 2){ ?>
                                        <script type="text/javascript">
                                            //Variável para conter todos os campos que funcionam com o DatePicker.
                                            //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                            //var strDatapickerAgendaEnCampos = "#data1";
                                            strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data7;";
                                        </script>
                                    <?php } ?>
                                    <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                                
                                    <input type="text" name="data7" id="data7" class="AdmCampoData01" maxlength="10" />
                                    <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                                <?php } ?>
                            <?php } ?>
                            <?php //---------------------- ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroData8'] == 1){ ?>
				<?php if(in_array("data8", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData8'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left">
                            <?php //JQuery DatePicker. ?>
                            <?php //---------------------- ?>
                            <?php if($GLOBALS['configTipoCampoCadastroData8'] == 1){ ?>
                                <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                    <?php if($GLOBALS['configSiteFormatoData'] == 1){ ?>
                                        <script type="text/javascript">
                                            //Variável para conter todos os campos que funcionam com o DatePicker.
                                            //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                            //var strDatapickerAgendaPtCampos = "#data1";
                                            strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data8;";
                                        </script>
                                    <?php } ?>
                                    <?php if($GLOBALS['configSiteFormatoData'] == 2){ ?>
                                        <script type="text/javascript">
                                            //Variável para conter todos os campos que funcionam com o DatePicker.
                                            //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                            //var strDatapickerAgendaEnCampos = "#data1";
                                            strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data8;";
                                        </script>
                                    <?php } ?>
                                    <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                                
                                    <input type="text" name="data8" id="data8" class="AdmCampoData01" maxlength="10" />
                                    <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                                <?php } ?>
                            <?php } ?>
                            <?php //---------------------- ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroData9'] == 1){ ?>
				<?php if(in_array("data9", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData9'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left">
                            <?php //JQuery DatePicker. ?>
                            <?php //---------------------- ?>
                            <?php if($GLOBALS['configTipoCampoCadastroData9'] == 1){ ?>
                                <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                    <?php if($GLOBALS['configSiteFormatoData'] == 1){ ?>
                                        <script type="text/javascript">
                                            //Variável para conter todos os campos que funcionam com o DatePicker.
                                            //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                            //var strDatapickerAgendaPtCampos = "#data1";
                                            strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data9;";
                                        </script>
                                    <?php } ?>
                                    <?php if($GLOBALS['configSiteFormatoData'] == 2){ ?>
                                        <script type="text/javascript">
                                            //Variável para conter todos os campos que funcionam com o DatePicker.
                                            //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                            //var strDatapickerAgendaEnCampos = "#data1";
                                            strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data9;";
                                        </script>
                                    <?php } ?>
                                    <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                                
                                    <input type="text" name="data9" id="data9" class="AdmCampoData01" maxlength="10" />
                                    <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                                <?php } ?>
                            <?php } ?>
                            <?php //---------------------- ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroData10'] == 1){ ?>
				<?php if(in_array("data10", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData10'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left">
                            <?php //JQuery DatePicker. ?>
                            <?php //---------------------- ?>
                            <?php if($GLOBALS['configTipoCampoCadastroData10'] == 1){ ?>
                                <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                    <?php if($GLOBALS['configSiteFormatoData'] == 1){ ?>
                                        <script type="text/javascript">
                                            //Variável para conter todos os campos que funcionam com o DatePicker.
                                            //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                            //var strDatapickerAgendaPtCampos = "#data1";
                                            strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data10;";
                                        </script>
                                    <?php } ?>
                                    <?php if($GLOBALS['configSiteFormatoData'] == 2){ ?>
                                        <script type="text/javascript">
                                            //Variável para conter todos os campos que funcionam com o DatePicker.
                                            //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                            //var strDatapickerAgendaEnCampos = "#data1";
                                            strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data10;";
                                        </script>
                                    <?php } ?>
                                    <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                                
                                    <input type="text" name="data10" id="data10" class="AdmCampoData01" maxlength="10" />
                                    <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                                <?php } ?>
                            <?php } ?>
                            <?php //---------------------- ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroCPFRG'] == 1){ ?>
            <tr>
				<?php if(in_array("cpf_", $arrCadastroFormularioCampos) == true){?>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroCPF"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro">
                    <div align="left">
                        <input type="text" name="cpf_" id="cpf_" class="AdmCampoTexto02" maxlength="255"<?php if($GLOBALS['configCadastroCPFMascara'] == "1") { ?> onkeypress="javascript:mascaraGenerica('###.###.###-##', this, 'formCadastro', 'cpf_');"<?php } ?> />
                        <?php //alertas ?>
                    </div>
                </td>
                <?php } ?>
                <?php if(in_array("rg_", $arrCadastroFormularioCampos) == true){?>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroRG"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <input type="text" name="rg_" id="rg_" class="AdmCampoTexto02" maxlength="255" />
                    </div>
                </td>
                <?php } ?>
            </tr>
            
            <tr style="display: none;">
                <td class="AdmTbFundoClaro" colspan="4">
                    <div class="AdmTexto01" style="position: relative; display: block;">
                        <div align="center" style="position: relative; display: inline-block; width: 130px; height: 22px; line-height: 22px; border: 1px solid #989890;">
                            <input name="gerarNDocumento" type="radio" value="cpf" checked="checked" />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroCPF"); ?>
                            <input name="gerarNDocumento" type="radio" value="cnpj" />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroCNPJ"); ?>
                        </div>
                        
                        <div align="center" style="position: absolute; display: block; top: -5px; left: 140px;">
                            <img onclick="gerarInformacao01('informacao_gerada1','radiobutton:gerarNDocumento');" src="img/btoGerarInformacao01.png" alt="Gerar Informação" style="margin-top: 8px; cursor: pointer;" />
                        </div>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroCNPJ'] == 1){ ?>
            	<?php if(in_array("cnpj_", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroCNPJ"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left">
                            <input type="text" name="cnpj_" id="cnpj_" class="AdmCampoTexto02" maxlength="255"<?php if($GLOBALS['configCadastroCNPJMascara'] == "1") { ?> onkeypress="javascript:mascaraGenerica('##.###.###/####-##', this, 'formCadastro', 'cnpj_');"<?php } ?> />
                            <?php //alertas ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroDocumento'] == 1){ ?>
            	<?php if(in_array("documento", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroDocumento"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left">
                            <input type="text" name="documento" id="documento" class="AdmCampoTexto02" maxlength="255" />
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroIEstadualIMunicipal'] == 1){ ?>
			<tr>
				<?php if(in_array("i_municipal", $arrCadastroFormularioCampos) == true){?>
				<td class="AdmTbFundoMedio TabelaColuna01">
					<div align="left" class="AdmTexto01">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroInscricaoMunicipal"); ?>:
					</div>
				</td>
				<td class="AdmTbFundoClaro">
					<div align="left">
						<input type="text" name="i_municipal" id="i_municipal" class="AdmCampoTexto02" maxlength="255" />
					</div>
				</td>
				<?php } ?>
				<?php if(in_array("i_estadual", $arrCadastroFormularioCampos) == true){?>
				<td class="AdmTbFundoMedio TabelaColuna01">
					<div align="left" class="AdmTexto01">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroInscricaoEstadual"); ?>:
					</div>
				</td>
				<td class="AdmTbFundoClaro TabelaColuna01">
					<div align="left" class="AdmTexto01">
						<input type="text" name="i_estadual" id="i_estadual" class="AdmCampoTexto02" maxlength="255" />
					</div>
				</td>
				<?php } ?>
			</tr>
            <?php } ?>
            
            <?php //Endereço. ?>
            <?php //---------------------- ?>
			<?php if(in_array("cep_principal", $arrCadastroFormularioCampos) == true){?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroCEPPrincipal"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left">
                        <input type="text" name="cep_principal" id="cep_principal" class="AdmCampoTexto03" maxlength="255"<?php if($GLOBALS['configCadastroCEPMascara'] == "1") { ?> onkeypress="javascript:mascaraGenerica('##.###-###', this, 'formCadastro', 'cep_principal');"<?php } ?> />
                        <?php //alertas ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
			<?php if(in_array("endereco_principal", $arrCadastroFormularioCampos) == true){?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroEnderecoPrincipal"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left">
                        <input type="text" name="endereco_principal" id="endereco_principal" class="AdmCampoTexto02" maxlength="255" />
                    </div>
                </td>
            </tr>
            <?php } ?>
			<?php if(in_array("endereco_numero_principal", $arrCadastroFormularioCampos) == true || in_array("endereco_complemento_principal", $arrCadastroFormularioCampos) == true){?>
            <tr>
                <?php if(in_array("endereco_numero_principal", $arrCadastroFormularioCampos) == true){?>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroEnderecoNumeroPrincipal"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro">
                    <div align="left">
                        <input type="text" name="endereco_numero_principal" id="endereco_numero_principal" class="AdmCampoTexto03" maxlength="255" />
                    </div>
                </td>
                <?php } ?>
                <?php if(in_array("endereco_complemento_principal", $arrCadastroFormularioCampos) == true){?>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroEnderecoComplementoPrincipal"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaColuna01">
                    <div align="left">
                        <input type="text" name="endereco_complemento_principal" id="endereco_complemento_principal" class="AdmCampoTexto03" maxlength="255" />
                    </div>
                </td>
                <?php } ?>
            </tr>
            <?php } ?>
            <?php if(in_array("bairro_principal", $arrCadastroFormularioCampos) == true || in_array("cidade_principal", $arrCadastroFormularioCampos) == true){?>
            <tr>
                <?php if(in_array("bairro_principal", $arrCadastroFormularioCampos) == true){?>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroBairroPrincipal"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro">
                    <div align="left">
                        <input type="text" name="bairro_principal" id="bairro_principal" class="AdmCampoTexto02" maxlength="255" />
                    </div>
                </td>
                <?php } ?>
                <?php if(in_array("cidade_principal", $arrCadastroFormularioCampos) == true){?>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroCidadePrincipal"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaColuna01">
                    <div align="left">
                        <input type="text" name="cidade_principal" id="cidade_principal" class="AdmCampoTexto02" maxlength="255" />
                    </div>
                </td>
                <?php } ?>
            </tr>
            <?php } ?>
            <?php if(in_array("estado_principal", $arrCadastroFormularioCampos) == true || in_array("pais_principal", $arrCadastroFormularioCampos) == true){?>
            <tr>
                <?php if(in_array("estado_principal", $arrCadastroFormularioCampos) == true){?>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroEstadoPrincipal"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro">
                    <div align="left">
                        <input type="text" name="estado_principal" id="estado_principal" class="AdmCampoTexto03" maxlength="255" />
                    </div>
                </td>
                <?php } ?>
                <?php if(in_array("pais_principal", $arrCadastroFormularioCampos) == true){?>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroPaisPrincipal"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaColuna01">
                    <div align="left">
                        <input type="text" name="pais_principal" id="pais_principal" class="AdmCampoTexto02" maxlength="255" />
                    </div>
                </td>
                <?php } ?>
            </tr>
            <?php } ?>
            <?php //---------------------- ?>

            <?php if($GLOBALS['habilitarCadastroPontoReferencia'] == 1){ ?>
                <?php if(in_array("ponto_referencia", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroPontoReferencia"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left">
                            <textarea name="ponto_referencia" id="ponto_referencia" class="AdmCampoTextoMultilinha01"></textarea>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
            
			<?php if(in_array("email_principal", $arrCadastroFormularioCampos) == true){?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroEmailPrincipal"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left">
                        <input type="text" name="email_principal" id="email_principal" class="AdmCampoTexto02" maxlength="255" />
                    </div>
                </td>
            </tr>
            <?php } ?>
			<?php if(in_array("tel_principal", $arrCadastroFormularioCampos) == true){?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroTel"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        (<input type="text" name="tel_ddd_principal" id="tel_ddd_principal" class="AdmCampoDDD01" maxlength="255" />)
                        <input type="text" name="tel_principal" id="tel_principal" class="AdmCampoTexto02" maxlength="255" />
                    </div>
                </td>
            </tr>
            <?php } ?>
			<?php if(in_array("cel_principal", $arrCadastroFormularioCampos) == true){?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroCel"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        (<input type="text" name="cel_ddd_principal" id="cel_ddd_principal" class="AdmCampoDDD01" maxlength="255" />)
                        <input type="text" name="cel_principal" id="cel_principal" class="AdmCampoTexto02" maxlength="255" />
                    </div>
                </td>
            </tr>
            <?php } ?>
			<?php if(in_array("fax_principal", $arrCadastroFormularioCampos) == true){?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroFax"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        (<input type="text" name="fax_ddd_principal" id="fax_ddd_principal" class="AdmCampoDDD01" maxlength="255" />)
                        <input type="text" name="fax_principal" id="fax_principal" class="AdmCampoTexto02" maxlength="255" />
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarCadastroSite'] == 1){ ?>
				<?php if(in_array("site_principal", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroSitePrincipal"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left" class="AdmTexto01">
                            <input type="text" name="site_principal" id="site_principal" class="AdmCampoTexto02" maxlength="255" />
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroNFuncionarios'] == 1){ ?>
				<?php if(in_array("n_funcionarios", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroNFuncionarios"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left">
                            <input type="text" name="n_funcionarios" id="n_funcionarios" class="AdmCampoNumerico01" maxlength="255" />
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
            
			<?php if(in_array("obs_interno", $arrCadastroFormularioCampos) == true){?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroObs"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left">
                        <textarea name="obs_interno" id="obs_interno" class="AdmCampoTextoMultilinha01"></textarea>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarCadastroVinculo1'] == 1){ ?>
				<?php if(in_array("id_tb_cadastro1", $arrCadastroFormularioCampos) == true){?>
                    <?php if($idTbCadastro1 == ""){  ?>
                    <tr>
                        <td class="AdmTbFundoMedio TabelaColuna01">
                            <div align="left" class="AdmTexto01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroVinculo1Nome'], "IncludeConfig"); ?>:
                            </div>
                        </td>
                        <td class="AdmTbFundoClaro" colspan="3">
                            <div class="AdmTexto01">
                                <?php 
                                    $arrCadastroVinculo1 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbCadastroVinculo1'], $GLOBALS['configIdTbTipoCadastroVinculo1'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoCadastroVinculo1'], $GLOBALS['configCadastroVinculo1Metodo']);
                                ?>
                                <select name="id_tb_cadastro1" id="id_tb_cadastro1" class="AdmCampoDropDownMenu01">
                                    <option value="0" selected="selected"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroVinculo1); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrCadastroVinculo1[$countArray][0];?>"><?php echo $arrCadastroVinculo1[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
			<?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroVinculo2'] == 1){ ?>
				<?php if(in_array("id_tb_cadastro2", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroVinculo2Nome'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                                $arrCadastroVinculo2 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbCadastroVinculo2'], $GLOBALS['configIdTbTipoCadastroVinculo2'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoCadastroVinculo2'], $GLOBALS['configCadastroVinculo2Metodo']);
                            ?>
                            <select name="id_tb_cadastro2" id="id_tb_cadastro2" class="AdmCampoDropDownMenu01">
                                <option value="0" selected="selected"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroVinculo2); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroVinculo2[$countArray][0];?>"><?php echo $arrCadastroVinculo2[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroVinculo3'] == 1){ ?>
				<?php if(in_array("id_tb_cadastro3", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroVinculo3Nome'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                                $arrCadastroVinculo3 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbCadastroVinculo3'], $GLOBALS['configIdTbTipoCadastroVinculo3'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoCadastroVinculo3'], $GLOBALS['configCadastroVinculo3Metodo']);
                            ?>
                            <select name="id_tb_cadastro3" id="id_tb_cadastro3" class="AdmCampoDropDownMenu01">
                                <option value="0" selected="selected"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroVinculo3); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroVinculo3[$countArray][0];?>"><?php echo $arrCadastroVinculo3[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroStatus'] == 1){ ?>
				<?php if(in_array("id_tb_cadastro_status", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroStatus"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                                $arrCadastroStatus = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 3);
                            ?>
                            <select name="id_tb_cadastro_status" id="id_tb_cadastro_status" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroStatus); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroStatus[$countArray][0];?>"><?php echo $arrCadastroStatus[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
            
			<?php if(in_array("ativacao", $arrCadastroFormularioCampos) == true){?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao3"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <select name="ativacao" id="ativacao" class="AdmCampoDropDownMenu01">
                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao4"); ?></option>
                            <option value="1" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao5"); ?></option>
                        </select>
                    </div>
                </td>
            </tr>
            <?php } ?>
                        
            <?php if($GLOBALS['habilitarCadastroAtivacaoMalaDireta'] == 1){ ?>
				<?php if(in_array("ativacao_mala_direta", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroAtivacaoMalaDireta"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left" class="AdmTexto01">
                            <select name="ativacao_mala_direta" id="ativacao_mala_direta" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao4"); ?></option>
                                <option value="1" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao5"); ?></option>
                            </select>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroUsuario'] == 1){ ?>
				<?php if(in_array("usuario", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroUsuario"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left">
                            <input type="text" name="usuario" id="usuario" class="AdmCampoTexto02" maxlength="255" />
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroSenha'] == 1){ ?>
				<?php if(in_array("senha", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroSenha"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left">
                            <input type="password" name="senha" id="senha" class="AdmCampoTexto02" maxlength="255" />
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroImagem'] == 1){ ?>
				<?php if(in_array("imagem", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemImagem"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <input type="file" name="ArquivoUpload1" id="ArquivoUpload1" class="AdmCampoArquivoUpload01" />
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroMapaOnline'] == 1){ ?>
				<?php if(in_array("mapa_online", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroMapaOnline"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left" class="AdmTexto01">
                            <textarea name="mapa_online" id="mapa_online" class="AdmCampoTextoMultilinha01"></textarea>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroPalavrasChave'] == 1){ ?>
				<?php if(in_array("palavras_chave", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPalavrasChave01"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left" class="AdmTexto01">
                            <textarea name="palavras_chave" id="palavras_chave" class="AdmCampoTextoMultilinha01"></textarea>
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPalavrasChave02"); ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>

            <?php if($GLOBALS['habilitarCadastroApresentacao'] == 1){ ?>
				<?php if(in_array("apresentacao", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroApresentacao"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="apresentacao" id="apresentacao" class="AdmCampoTextoMultilinhaConteudo01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#apresentacao").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="apresentacao" id="apresentacao"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#apresentacao").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="apresentacao" id="apresentacao"></textarea>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
            <?php if($GLOBALS['habilitarCadastroServicos'] == 1){ ?>
				<?php if(in_array("servicos", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroServicos"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="servicos" id="servicos" class="AdmCampoTextoMultilinhaConteudo01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#servicos").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="servicos" id="servicos"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#servicos").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="servicos" id="servicos"></textarea>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
            <?php if($GLOBALS['HabilitarCadastroPromocoes'] == 1){ ?>
				<?php if(in_array("promocoes", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroPromocoes"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="promocoes" id="promocoes" class="AdmCampoTextoMultilinhaConteudo01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#promocoes").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="promocoes" id="promocoes"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#promocoes").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="promocoes" id="promocoes"></textarea>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
            <?php if($GLOBALS['habilitarCadastroCondicoesComerciais'] == 1){ ?>
				<?php if(in_array("condicoes_comerciais", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroCondicoesComerciais"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="condicoes_comerciais" id="condicoes_comerciais" class="AdmCampoTextoMultilinhaConteudo01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#condicoes_comerciais").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="condicoes_comerciais" id="condicoes_comerciais"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#condicoes_comerciais").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="condicoes_comerciais" id="condicoes_comerciais"></textarea>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
            <?php if($GLOBALS['habilitarCadastroFormasPagamento'] == 1){ ?>
				<?php if(in_array("formas_pagamento", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroFormasPagamento"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="formas_pagamento" id="formas_pagamento" class="AdmCampoTextoMultilinhaConteudo01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#formas_pagamento").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="formas_pagamento" id="formas_pagamento"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#formas_pagamento").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="formas_pagamento" id="formas_pagamento"></textarea>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroHorarioAtendimento'] == 1){ ?>
				<?php if(in_array("horario_atendimento", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroHorarioAtendimento"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="horario_atendimento" id="horario_atendimento" class="AdmCampoTextoMultilinhaConteudo01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#horario_atendimento").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="horario_atendimento" id="horario_atendimento"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#horario_atendimento").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="horario_atendimento" id="horario_atendimento"></textarea>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
            <?php if($GLOBALS['habilitarCadastroSituacaoAtual'] == 1){ ?>
				<?php if(in_array("situacao_atual", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroSituacaoAtual"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="situacao_atual" id="situacao_atual" class="AdmCampoTextoMultilinhaConteudo01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#situacao_atual").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="situacao_atual" id="situacao_atual"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#situacao_atual").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="situacao_atual" id="situacao_atual"></textarea>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroIc1'] == 1){ ?>
				<?php if(in_array("informacao_complementar1", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc1'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroBoxIc1'] == 1){ ?>
                                <input type="text" name="informacao_complementar1" id="informacao_complementar1" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroBoxIc1'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar1" id="informacao_complementar1" class="AdmCampoTextoMultilinha01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar1").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorBasicoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorBasicoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar1" id="informacao_complementar1"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar1").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorAvancadoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorAvancadoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar1" id="informacao_complementar1"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroIc2'] == 1){ ?>
				<?php if(in_array("informacao_complementar2", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc2'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroBoxIc2'] == 1){ ?>
                                <input type="text" name="informacao_complementar2" id="informacao_complementar2" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroBoxIc2'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar2" id="informacao_complementar2" class="AdmCampoTextoMultilinha01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar2").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorBasicoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorBasicoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar2" id="informacao_complementar2"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar2").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorAvancadoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorAvancadoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar2" id="informacao_complementar2"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
				<?php } ?>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarCadastroIc3'] == 1){ ?>
				<?php if(in_array("informacao_complementar3", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc3'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroBoxIc3'] == 1){ ?>
                                <input type="text" name="informacao_complementar3" id="informacao_complementar3" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroBoxIc3'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar3" id="informacao_complementar3" class="AdmCampoTextoMultilinha01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar3").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorBasicoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorBasicoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar3" id="informacao_complementar3"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar3").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorAvancadoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorAvancadoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar3" id="informacao_complementar3"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarCadastroIc4'] == 1){ ?>
				<?php if(in_array("informacao_complementar4", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc4'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroBoxIc4'] == 1){ ?>
                                <input type="text" name="informacao_complementar4" id="informacao_complementar4" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroBoxIc4'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar4" id="informacao_complementar4" class="AdmCampoTextoMultilinha01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar4").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorBasicoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorBasicoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar4" id="informacao_complementar4"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar4").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorAvancadoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorAvancadoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar4" id="informacao_complementar4"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarCadastroIc5'] == 1){ ?>
				<?php if(in_array("informacao_complementar5", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc5'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroBoxIc5'] == 1){ ?>
                                <input type="text" name="informacao_complementar5" id="informacao_complementar5" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroBoxIc5'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar5" id="informacao_complementar5" class="AdmCampoTextoMultilinha01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar5").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorBasicoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorBasicoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar5" id="informacao_complementar5"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar5").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorAvancadoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorAvancadoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar5" id="informacao_complementar5"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroIc6'] == 1){ ?>
				<?php if(in_array("informacao_complementar6", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc6'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroBoxIc6'] == 1){ ?>
                                <input type="text" name="informacao_complementar6" id="informacao_complementar6" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroBoxIc6'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar6" id="informacao_complementar6" class="AdmCampoTextoMultilinha01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar6").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorBasicoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorBasicoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar6" id="informacao_complementar6"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar6").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorAvancadoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorAvancadoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar6" id="informacao_complementar6"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroIc7'] == 1){ ?>
				<?php if(in_array("informacao_complementar7", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc7'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroBoxIc7'] == 1){ ?>
                                <input type="text" name="informacao_complementar7" id="informacao_complementar7" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroBoxIc7'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar7" id="informacao_complementar7" class="AdmCampoTextoMultilinha01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar7").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorBasicoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorBasicoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar7" id="informacao_complementar7"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar7").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorAvancadoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorAvancadoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar7" id="informacao_complementar7"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarCadastroIc8'] == 1){ ?>
				<?php if(in_array("informacao_complementar8", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc8'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroBoxIc8'] == 1){ ?>
                                <input type="text" name="informacao_complementar8" id="informacao_complementar8" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroBoxIc8'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar8" id="informacao_complementar8" class="AdmCampoTextoMultilinha01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar8").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorBasicoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorBasicoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar8" id="informacao_complementar8"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar8").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorAvancadoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorAvancadoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar8" id="informacao_complementar8"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarCadastroIc9'] == 1){ ?>
				<?php if(in_array("informacao_complementar9", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc9'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroBoxIc9'] == 1){ ?>
                                <input type="text" name="informacao_complementar9" id="informacao_complementar9" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroBoxIc9'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar9" id="informacao_complementar9" class="AdmCampoTextoMultilinha01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar9").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorBasicoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorBasicoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar9" id="informacao_complementar9"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar9").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorAvancadoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorAvancadoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar9" id="informacao_complementar9"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarCadastroIc10'] == 1){ ?>
				<?php if(in_array("informacao_complementar10", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc10'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroBoxIc10'] == 1){ ?>
                                <input type="text" name="informacao_complementar10" id="informacao_complementar10" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroBoxIc10'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar10" id="informacao_complementar10" class="AdmCampoTextoMultilinha01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar10").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorBasicoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorBasicoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar10" id="informacao_complementar10"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar10").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorAvancadoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorAvancadoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar10" id="informacao_complementar10"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroIc11'] == 1){ ?>
				<?php if(in_array("informacao_complementar11", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc11'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroBoxIc11'] == 1){ ?>
                                <input type="text" name="informacao_complementar11" id="informacao_complementar11" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroBoxIc11'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar11" id="informacao_complementar11" class="AdmCampoTextoMultilinha01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar11").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorBasicoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorBasicoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar11" id="informacao_complementar11"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar11").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorAvancadoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorAvancadoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar11" id="informacao_complementar11"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroIc12'] == 1){ ?>
				<?php if(in_array("informacao_complementar12", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc12'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroBoxIc12'] == 1){ ?>
                                <input type="text" name="informacao_complementar12" id="informacao_complementar12" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroBoxIc12'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar12" id="informacao_complementar12" class="AdmCampoTextoMultilinha01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar12").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorBasicoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorBasicoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar12" id="informacao_complementar12"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar12").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorAvancadoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorAvancadoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar12" id="informacao_complementar12"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarCadastroIc13'] == 1){ ?>
				<?php if(in_array("informacao_complementar13", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc13'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroBoxIc13'] == 1){ ?>
                                <input type="text" name="informacao_complementar13" id="informacao_complementar13" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroBoxIc13'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar13" id="informacao_complementar13" class="AdmCampoTextoMultilinha01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar13").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorBasicoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorBasicoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar13" id="informacao_complementar13"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar13").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorAvancadoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorAvancadoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar13" id="informacao_complementar13"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarCadastroIc14'] == 1){ ?>
				<?php if(in_array("informacao_complementar14", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc14'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroBoxIc14'] == 1){ ?>
                                <input type="text" name="informacao_complementar14" id="informacao_complementar14" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroBoxIc14'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar14" id="informacao_complementar14" class="AdmCampoTextoMultilinha01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar14").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorBasicoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorBasicoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar14" id="informacao_complementar14"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar14").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorAvancadoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorAvancadoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar14" id="informacao_complementar14"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarCadastroIc15'] == 1){ ?>
				<?php if(in_array("informacao_complementar15", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc15'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroBoxIc15'] == 1){ ?>
                                <input type="text" name="informacao_complementar15" id="informacao_complementar15" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroBoxIc15'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar15" id="informacao_complementar15" class="AdmCampoTextoMultilinha01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar15").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorBasicoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorBasicoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar15" id="informacao_complementar15"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar15").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorAvancadoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorAvancadoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar15" id="informacao_complementar15"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroIc16'] == 1){ ?>
				<?php if(in_array("informacao_complementar16", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc16'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroBoxIc16'] == 1){ ?>
                                <input type="text" name="informacao_complementar16" id="informacao_complementar16" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroBoxIc16'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar16" id="informacao_complementar16" class="AdmCampoTextoMultilinha01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar16").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorBasicoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorBasicoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar16" id="informacao_complementar16"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar16").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorAvancadoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorAvancadoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar16" id="informacao_complementar16"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroIc17'] == 1){ ?>
				<?php if(in_array("informacao_complementar17", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc17'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroBoxIc17'] == 1){ ?>
                                <input type="text" name="informacao_complementar17" id="informacao_complementar17" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroBoxIc17'] == 1){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar17" id="informacao_complementar17" class="AdmCampoTextoMultilinha01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar17").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorBasicoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorBasicoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar17" id="informacao_complementar17"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar17").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorAvancadoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorAvancadoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar17" id="informacao_complementar17"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarCadastroIc18'] == 1){ ?>
				<?php if(in_array("informacao_complementar18", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc18'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroBoxIc18'] == 1){ ?>
                                <input type="text" name="informacao_complementar18" id="informacao_complementar18" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroBoxIc18'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar18" id="informacao_complementar18" class="AdmCampoTextoMultilinha01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar18").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorBasicoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorBasicoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar18" id="informacao_complementar18"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar18").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorAvancadoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorAvancadoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar18" id="informacao_complementar18"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarCadastroIc19'] == 1){ ?>
				<?php if(in_array("informacao_complementar19", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc19'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroBoxIc19'] == 1){ ?>
                                <input type="text" name="informacao_complementar19" id="informacao_complementar19" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroBoxIc19'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar19" id="informacao_complementar19" class="AdmCampoTextoMultilinha01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar19").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorBasicoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorBasicoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar19" id="informacao_complementar19"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar19").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorAvancadoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorAvancadoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar19" id="informacao_complementar19"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarCadastroIc20'] == 1){ ?>
				<?php if(in_array("informacao_complementar20", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc20'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroBoxIc20'] == 1){ ?>
                                <input type="text" name="informacao_complementar20" id="informacao_complementar20" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroBoxIc20'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar20" id="informacao_complementar20" class="AdmCampoTextoMultilinha01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar20").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorBasicoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorBasicoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar20" id="informacao_complementar20"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar20").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorAvancadoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorAvancadoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar20" id="informacao_complementar20"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroIc21'] == 1){ ?>
				<?php if(in_array("informacao_complementar21", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc21'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroBoxIc21'] == 1){ ?>
                                <input type="text" name="informacao_complementar21" id="informacao_complementar21" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroBoxIc21'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar21" id="informacao_complementar21" class="AdmCampoTextoMultilinha01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar21").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorBasicoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorBasicoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar21" id="informacao_complementar21"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar21").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorAvancadoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorAvancadoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar21" id="informacao_complementar21"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroIc22'] == 1){ ?>
				<?php if(in_array("informacao_complementar22", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc22'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroBoxIc22'] == 1){ ?>
                                <input type="text" name="informacao_complementar22" id="informacao_complementar22" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroBoxIc22'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar22" id="informacao_complementar22" class="AdmCampoTextoMultilinha01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar22").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorBasicoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorBasicoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar22" id="informacao_complementar22"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar22").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorAvancadoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorAvancadoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar22" id="informacao_complementar22"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarCadastroIc23'] == 1){ ?>
				<?php if(in_array("informacao_complementar23", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc23'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroBoxIc23'] == 1){ ?>
                                <input type="text" name="informacao_complementar23" id="informacao_complementar23" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroBoxIc23'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar23" id="informacao_complementar23" class="AdmCampoTextoMultilinha01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar23").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorBasicoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorBasicoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar23" id="informacao_complementar23"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar23").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorAvancadoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorAvancadoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar23" id="informacao_complementar23"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarCadastroIc24'] == 1){ ?>
				<?php if(in_array("informacao_complementar24", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc24'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroBoxIc24'] == 1){ ?>
                                <input type="text" name="informacao_complementar24" id="informacao_complementar24" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroBoxIc24'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar24" id="informacao_complementar24" class="AdmCampoTextoMultilinha01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar24").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorBasicoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorBasicoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar24" id="informacao_complementar24"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar24").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorAvancadoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorAvancadoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar24" id="informacao_complementar24"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarCadastroIc25'] == 1){ ?>
				<?php if(in_array("informacao_complementar25", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc25'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroBoxIc25'] == 1){ ?>
                                <input type="text" name="informacao_complementar25" id="informacao_complementar25" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroBoxIc25'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar25" id="informacao_complementar25" class="AdmCampoTextoMultilinha01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar25").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorBasicoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorBasicoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar25" id="informacao_complementar25"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar25").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorAvancadoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorAvancadoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar25" id="informacao_complementar25"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroIc26'] == 1){ ?>
				<?php if(in_array("informacao_complementar26", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc26'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroBoxIc26'] == 1){ ?>
                                <input type="text" name="informacao_complementar26" id="informacao_complementar26" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroBoxIc26'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar26" id="informacao_complementar26" class="AdmCampoTextoMultilinha01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar26").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorBasicoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorBasicoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar26" id="informacao_complementar26"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar26").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorAvancadoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorAvancadoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar26" id="informacao_complementar26"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroIc27'] == 1){ ?>
				<?php if(in_array("informacao_complementar27", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc27'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroBoxIc27'] == 1){ ?>
                                <input type="text" name="informacao_complementar27" id="informacao_complementar27" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroBoxIc27'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar27" id="informacao_complementar27" class="AdmCampoTextoMultilinha01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar27").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorBasicoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorBasicoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar27" id="informacao_complementar27"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar27").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorAvancadoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorAvancadoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar27" id="informacao_complementar27"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarCadastroIc28'] == 1){ ?>
				<?php if(in_array("informacao_complementar28", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc28'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroBoxIc28'] == 1){ ?>
                                <input type="text" name="informacao_complementar28" id="informacao_complementar28" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroBoxIc28'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar28" id="informacao_complementar28" class="AdmCampoTextoMultilinha01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar28").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorBasicoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorBasicoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar28" id="informacao_complementar28"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar28").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorAvancadoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorAvancadoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar28" id="informacao_complementar28"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarCadastroIc29'] == 1){ ?>
				<?php if(in_array("informacao_complementar29", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc29'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroBoxIc29'] == 1){ ?>
                                <input type="text" name="informacao_complementar29" id="informacao_complementar29" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroBoxIc29'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar29" id="informacao_complementar29" class="AdmCampoTextoMultilinha01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar29").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorBasicoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorBasicoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar29" id="informacao_complementar29"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar29").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorAvancadoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorAvancadoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar29" id="informacao_complementar29"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarCadastroIc30'] == 1){ ?>
				<?php if(in_array("informacao_complementar30", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc30'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroBoxIc30'] == 1){ ?>
                                <input type="text" name="informacao_complementar30" id="informacao_complementar30" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroBoxIc30'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar30" id="informacao_complementar30" class="AdmCampoTextoMultilinha01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar30").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorBasicoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorBasicoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar30" id="informacao_complementar30"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar30").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorAvancadoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorAvancadoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar30" id="informacao_complementar30"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroIc31'] == 1){ ?>
				<?php if(in_array("informacao_complementar31", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc31'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroBoxIc31'] == 1){ ?>
                                <input type="text" name="informacao_complementar31" id="informacao_complementar31" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroBoxIc31'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar31" id="informacao_complementar31" class="AdmCampoTextoMultilinha01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar31").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorBasicoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorBasicoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar31" id="informacao_complementar31"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar31").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorAvancadoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorAvancadoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar31" id="informacao_complementar31"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroIc32'] == 1){ ?>
				<?php if(in_array("informacao_complementar32", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc32'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroBoxIc32'] == 1){ ?>
                                <input type="text" name="informacao_complementar32" id="informacao_complementar32" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroBoxIc32'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar32" id="informacao_complementar32" class="AdmCampoTextoMultilinha01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar32").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorBasicoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorBasicoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar32" id="informacao_complementar32"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar32").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorAvancadoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorAvancadoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar32" id="informacao_complementar32"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarCadastroIc33'] == 1){ ?>
				<?php if(in_array("informacao_complementar33", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc33'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroBoxIc33'] == 1){ ?>
                                <input type="text" name="informacao_complementar33" id="informacao_complementar33" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroBoxIc33'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar33" id="informacao_complementar33" class="AdmCampoTextoMultilinha01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar33").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorBasicoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorBasicoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar33" id="informacao_complementar33"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar33").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorAvancadoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorAvancadoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar33" id="informacao_complementar33"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarCadastroIc34'] == 1){ ?>
				<?php if(in_array("informacao_complementar34", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc34'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroBoxIc34'] == 1){ ?>
                                <input type="text" name="informacao_complementar34" id="informacao_complementar34" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroBoxIc34'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar34" id="informacao_complementar34" class="AdmCampoTextoMultilinha01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar34").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorBasicoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorBasicoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar34" id="informacao_complementar34"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar34").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorAvancadoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorAvancadoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar34" id="informacao_complementar34"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarCadastroIc35'] == 1){ ?>
				<?php if(in_array("informacao_complementar35", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
    
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc35'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroBoxIc35'] == 1){ ?>
                                <input type="text" name="informacao_complementar35" id="informacao_complementar35" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroBoxIc35'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar35" id="informacao_complementar35" class="AdmCampoTextoMultilinha01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar35").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorBasicoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorBasicoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar35" id="informacao_complementar35"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar35").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorAvancadoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorAvancadoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar35" id="informacao_complementar35"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroIc36'] == 1){ ?>
				<?php if(in_array("informacao_complementar36", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc36'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroBoxIc36'] == 1){ ?>
                                <input type="text" name="informacao_complementar36" id="informacao_complementar36" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroBoxIc36'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar36" id="informacao_complementar36" class="AdmCampoTextoMultilinha01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar36").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorBasicoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorBasicoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar36" id="informacao_complementar36"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar36").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorAvancadoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorAvancadoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar36" id="informacao_complementar36"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroIc37'] == 1){ ?>
				<?php if(in_array("informacao_complementar37", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc37'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroBoxIc37'] == 1){ ?>
                                <input type="text" name="informacao_complementar37" id="informacao_complementar37" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroBoxIc37'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar37" id="informacao_complementar37" class="AdmCampoTextoMultilinha01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar37").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorBasicoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorBasicoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar37" id="informacao_complementar37"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar37").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorAvancadoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorAvancadoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar37" id="informacao_complementar37"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarCadastroIc38'] == 1){ ?>
				<?php if(in_array("informacao_complementar38", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc38'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroBoxIc38'] == 1){ ?>
                                <input type="text" name="informacao_complementar38" id="informacao_complementar38" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroBoxIc38'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar38" id="informacao_complementar38" class="AdmCampoTextoMultilinha01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar38").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorBasicoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorBasicoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar38" id="informacao_complementar38"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar38").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorAvancadoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorAvancadoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar38" id="informacao_complementar38"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarCadastroIc39'] == 1){ ?>
				<?php if(in_array("informacao_complementar39", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc39'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroBoxIc39'] == 1){ ?>
                                <input type="text" name="informacao_complementar39" id="informacao_complementar39" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroBoxIc39'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar39" id="informacao_complementar39" class="AdmCampoTextoMultilinha01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar39").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorBasicoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorBasicoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar39" id="informacao_complementar39"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar39").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorAvancadoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorAvancadoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar39" id="informacao_complementar39"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarCadastroIc40'] == 1){ ?>
				<?php if(in_array("informacao_complementar40", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc40'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroBoxIc40'] == 1){ ?>
                                <input type="text" name="informacao_complementar40" id="informacao_complementar40" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroBoxIc40'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar40" id="informacao_complementar40" class="AdmCampoTextoMultilinha01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar40").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorBasicoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorBasicoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar40" id="informacao_complementar40"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar40").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorAvancadoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorAvancadoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar40" id="informacao_complementar40"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>

         </table>
         
        <div>
            <div style="float:left;">
                <input type="image" name="submit" value="Submit" src="img/btoIncluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoIncluir"); ?>" />
                
                <input name="id_tb_categorias" type="hidden" id="id_tb_categorias" value="<?php echo $idParentCadastro; ?>" />
                <?php if($idTbCadastro1 <> ""){ ?>
                    <input name="id_tb_cadastro1" type="hidden" id="id_tb_cadastro1" value="<?php echo $idTbCadastro1; ?>" />
                <?php } ?>

				<?php if(in_array("ativacao", $arrCadastroFormularioCampos) <> true){?>
                    <?php if($GLOBALS['habilitarCadastroConfirmacaoAtivacaoEmail'] == 1){ ?>
                        <input name="ativacao" type="hidden" id="ativacao" value="0" />
                    <?php }else{ ?>
                        <input name="ativacao" type="hidden" id="ativacao" value="1" />
                    <?php } ?>
                <?php } ?>
                <?php if($idTipoCadastro <> ""){ ?>
                    <input name="idsCadastroTipo[]" type="hidden" id="idsCadastroTipo[]" value="<?php echo $idTipoCadastro;?>" />
                <?php } ?>
                
                <input name="idTipoCadastro" type="hidden" id="idTipoCadastro" value="<?php echo $idTipoCadastro; ?>" />
                <input name="idsTbCadastroComplemento" type="hidden" id="idsTbCadastroComplemento" value="<?php echo $idsTbCadastroComplemento; ?>" />
                <input name="idTbCadastro1" type="hidden" id="idTbCadastro1" value="<?php echo $idTbCadastro1; ?>" />
                <!--input name="ativacao" type="hidden" id="ativacao" value="1" /-->
            
                <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                <input name="masterPageSiteSelect" type="hidden" id="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
            </div>
            <div style="float:right;">
                &nbsp;
            </div>
        </div>
    </form>
    <br />
    <?php } ?>
<?php 
$pageSite->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php
//Limpeza de objetos.
//----------
unset($strSqlCadastroSelect);
unset($statementCadastroSelect);
unset($resultadoCadastro);
unset($linhaCadastro);
//----------


//Inclusão do template do layout.
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>