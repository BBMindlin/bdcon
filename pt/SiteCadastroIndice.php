<?php
//Importação dos arquivos de configuração.
require_once "../sistema/IncludeConfig.php"; //Deve vir antes do db.
require_once "../sistema/IncludeConexao.php";
require_once "../sistema/IncludeFuncoes.php";
//require_once "IncludeLayout.php";
require_once "IncludeLayoutSite.php";


//Resgate de variáveis.
$idTbCadastroLogin = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura(CookiesFuncoes::CookieValorLer("")), 2);
$visitanteConfigCoordLocalInicial = CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "visitanteConfigCoordLocalInicial");

$idParentCadastro = $_GET["idParentCadastro"];
$idsTbCadastro = $_GET["idsTbCadastro"];

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

$idTbCadastro = $_GET["idTbCadastro"];
$nome = $_GET["nome"];
$cpf_ = Funcoes::SomenteNum($_GET["cpf_"]);
$data6 = $_GET["data6"]; //"2016-11-06"; //Debug.
$palavraChave = $_GET["palavraChave"];

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

$tituloLinkAtual = "";
$metaTitulo = "";
$metaDescricao = "";
$metaPalavrasChave = "";

$paginaRetorno = "SiteCadastroIndice.php";
//$paginaRetornoExclusao = "SiteAdmCadastroEditar.php";
$variavelRetorno = "idParentCadastro";
$idRetorno = $idParentCadastro;
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];


//Paginação.
if($GLOBALS['habilitarCadastroSitePaginacaoSimples'] == "1"){
	$paginacaoNRegistros = $GLOBALS['configCadastroSitePaginacaoNRegistros'];
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
"&nome=" . $nome . 
"&cpf_=" . $cpf_ . 
"&idsTbCadastro=" . $idsTbCadastro . 
"&idTipoCadastro=" . $idTipoCadastro . 
"&idsTbCadastroComplemento=" . $idsTbCadastroComplemento . 
"&idsCadastroTipo=" . $arrIdsCadastroTipo . 
"&idsCadastroFiltroGenerico01=" . $arrIdsCadastroFiltroGenerico01 . 
"&idsCadastroFiltroGenerico02=" . $arrIdsCadastroFiltroGenerico02 . 
"&idsCadastroFiltroGenerico03=" . $arrIdsCadastroFiltroGenerico03 . 
"&idsCadastroFiltroGenerico04=" . $arrIdsCadastroFiltroGenerico04 . 
"&idsCadastroFiltroGenerico05=" . $arrIdsCadastroFiltroGenerico05 . 
"&idsCadastroFiltroGenerico06=" . $arrIdsCadastroFiltroGenerico06 . 
"&idsCadastroFiltroGenerico07=" . $arrIdsCadastroFiltroGenerico07 . 
"&idsCadastroFiltroGenerico08=" . $arrIdsCadastroFiltroGenerico08 . 
"&idsCadastroFiltroGenerico09=" . $arrIdsCadastroFiltroGenerico09 . 
"&idsCadastroFiltroGenerico10=" . $arrIdsCadastroFiltroGenerico10 . 
"&idsCadastroFiltroGenerico11=" . $arrIdsCadastroFiltroGenerico11 . 
"&idsCadastroFiltroGenerico12=" . $arrIdsCadastroFiltroGenerico12 . 
"&idsCadastroFiltroGenerico13=" . $arrIdsCadastroFiltroGenerico13 . 
"&idsCadastroFiltroGenerico14=" . $arrIdsCadastroFiltroGenerico14 . 
"&idsCadastroFiltroGenerico15=" . $arrIdsCadastroFiltroGenerico15 . 
"&idsCadastroFiltroGenerico16=" . $arrIdsCadastroFiltroGenerico16 . 
"&idsCadastroFiltroGenerico17=" . $arrIdsCadastroFiltroGenerico17 . 
"&idsCadastroFiltroGenerico18=" . $arrIdsCadastroFiltroGenerico18 . 
"&idsCadastroFiltroGenerico19=" . $arrIdsCadastroFiltroGenerico19 . 
"&idsCadastroFiltroGenerico20=" . $arrIdsCadastroFiltroGenerico20 . 
"&palavraChave=" . $palavraChave;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


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
if($GLOBALS['habilitarCadastroSitePaginacaoSimples'] == "1"){
	//$strSqlCadastroSelect .= ",(SELECT COUNT(*) ";
	$strSqlCadastroSelect .= ", (SELECT COUNT(id) ";
	$strSqlCadastroSelect .= "FROM tb_cadastro ";
	$strSqlCadastroSelect .= "WHERE id <> 0 ";
	$strSqlCadastroSelect .= "AND ativacao = 1 ";
	//$strSqlCadastroSelect .= "AND ativacao_destaque = 1 ";
	if($idParentCadastro <> "")
	{
		$strSqlCadastroSelect .= "AND id_tb_categorias = :id_tb_categorias ";
	}
	if($idTbCadastro <> "")
	{
		$strSqlCadastroSelect .= "AND id = :id ";
	}
	if($idsTbCadastro <> "")
	{
		$strSqlCadastroSelect .= "AND id IN (" . Funcoes::ConteudoMascaraGravacao01($idsTbCadastro) . ") ";
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
$strSqlCadastroSelect .= "AND ativacao = 1 ";
//$strSqlCadastroSelect .= "AND ativacao_destaque = 1 ";
if($idParentCadastro <> "")
{
	$strSqlCadastroSelect .= "AND id_tb_categorias = :id_tb_categorias ";
}
if($idTbCadastro <> "")
{
	$strSqlCadastroSelect .= "AND id = :id ";
}
if($idsTbCadastro <> "")
{
	$strSqlCadastroSelect .= "AND id IN (" . Funcoes::ConteudoMascaraGravacao01($idsTbCadastro) . ") ";
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
if($GLOBALS['habilitarCadastroSitePaginacaoSimples'] == "1"){ 
	if($configTipoDB == 2)
	{
		$strSqlCadastroSelect .= "LIMIT " . $paginacaoInicio . ", " . $paginacaoNRegistros . "";
	}
}
//echo "strSqlCadastroSelect=" . $strSqlCadastroSelect . "<br/>";
//----------


//Componentes.
//----------
$statementCadastroSelect = $dbSistemaConPDO->prepare($strSqlCadastroSelect);

if ($statementCadastroSelect !== false)
{
	if($idParentCadastro <> "")
	{
		$statementCadastroSelect->bindParam(':id_tb_categorias', $idParentCadastro, PDO::PARAM_STR);
	}
	if($idTbCadastro <> "")
	{
		$statementCadastroSelect->bindParam(':id', $idTbCadastro, PDO::PARAM_STR);
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
	$statementCadastroSelect->execute();
	/*
	$statementCadastroSelect->execute(array(
		"id_tb_categorias" => $idParentCadastro
	));
	*/
}

//$resultadoCadastro = $dbSistemaConPDO->query($strSqlCadastroSelect);
$resultadoCadastro = $statementCadastroSelect->fetchAll();
$resultadoCadastroCount = $statementCadastroSelect->rowCount();
//----------


//Paginação.
if($GLOBALS['habilitarCadastroSitePaginacaoSimples'] == "1"){
	//$paginacaoTotalRegistros = DbFuncoes::CountRegistrosGenericos("tb_cadastro", "id_tb_categorias", $idParentCadastro); //Quantidade de registros.
	//$paginacaoTotalRegistros = DbFuncoes::CountRegistrosGenericos("tb_cadastro", "id_tb_categorias", $idParentCadastro, "", "", "", "", "", ""); //Quantidade de registros.
	$paginacaoTotalRegistros = $resultadoCadastro[0]['totalRegistros'];
	$paginacaoTotal = ceil($paginacaoTotalRegistros / $paginacaoNRegistros);
}


//Definição de variáveis.
if($idParentCadastro <> ""){
	$tituloLinkAtual = DbFuncoes::GetCampoGenerico01($idParentCadastro, "tb_categorias", "categoria");
}
if($palavraChave <> ""){
	$tituloLinkAtual = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaResultados");
}
if($tituloLinkAtual == ""){
	$tituloLinkAtual = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaResultados");
}
$metaTitulo = $tituloLinkAtual . " - " . Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloSite'], "IncludeConfig");


//Verificação de erro - debug.
//print_r("arrIdsCadastroFiltroGenerico01=" . $arrIdsCadastroFiltroGenerico01 . "<br/>");
//print_r($arrIdsCadastroFiltroGenerico01);
//echo "implode=" . implode(",",$arrIdsCadastroFiltroGenerico01) . "<br/>";
//print_r($arrIdsCadastroFiltroGenerico);
//echo "idsTbCadastro=" . $idsTbCadastro . "<br/>";
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo $metaTitulo; ?>
<?php 
$pageSite->cphTitle = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Head.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphHead*/ ?>
    <meta name="description" content="<?php echo $metaDescricao; ?>" /><?php //Abaixo de 160 caracteres.?>
    <meta name="keywords" content="<?php echo $metaPalavrasChave; ?>" /><?php //Abaixo de 100 caracteres.?>
    <meta name="title" content="<?php echo $metaTitulo; ?>" /><?php //Abaixo de 60 caracteres.?>
<?php 
$pageSite->cphHead = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Título atual.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphConteudoCabecalho*/ ?>
	<?php echo $tituloLinkAtual; ?>
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

	<?php //Cadastro - Diagramação em tabela. ?>
    <?php //************************************************************************************** ?>
	<div style="position: relative; display: block; overflow: hidden;">
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
            <table width="100%" class="AdmTabelaDados01">
              <tr class="AdmTbFundoEscuro">
                <td width="100" class="AdmTbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroData"); ?>
                    </div>
                </td>
                
                <?php if($GLOBALS['ativacaoCadastroVisualizacaoImagem'] == 1){ ?>
                <td width="1" class="AdmTbFundoEscuro TabelaDados01Celula">
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
                <td width="100" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFuncoes"); ?>
                    </div>
                </td>
                
              </tr>
              <?php
                $countTabelaFundo = 0;
				
				$arrCadastroFiltroGenerico20 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 69);

              
                //Loop pelos resultados.
                foreach($resultadoCadastro as $linhaCadastro)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="<?php if($countTabelaFundo == 0){ ?>AdmTbFundoClaro<?php }else{?>AdmTbFundoAlternativo<?php } ?>">
                
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
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <a href="SiteAdmCadastroAdministrar.php?idTbCadastro=<?php echo $linhaCadastro['id'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroAdministrar"); ?>
                        </a>
                    </div>
                    <?php if($GLOBALS['habilitarCadastroLogo'] == 1){ ?>
                        <div align="center" class="AdmTexto01">
                            <a href="SiteAdmCadastroArquivosComplementares.php?idTbCadastro=<?php echo $linhaCadastro['id'];?>&campo=logo&paginaRetorno=CadastroIndice.php" class="AdmLinks01">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroLogoInserir"); ?>
                            </a>
                        </div>
                    <?php } ?>
                    <?php if($GLOBALS['habilitarCadastroMapa'] == 1){ ?>
                        <div align="center" class="AdmTexto01">
                            <a href="SiteAdmCadastroArquivosComplementares.php?idTbCadastro=<?php echo $linhaCadastro['id'];?>&campo=mapa&paginaRetorno=CadastroIndice.php" class="AdmLinks01">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroMapaInserir"); ?>
                            </a>
                        </div>
                    <?php } ?>
                    <?php if($GLOBALS['habilitarCadastroBanner'] == 1){ ?>
                        <div align="center" class="AdmTexto01">
                            <a href="SiteAdmCadastroArquivosComplementares.php?idTbCadastro=<?php echo $linhaCadastro['id'];?>&campo=banner&paginaRetorno=CadastroIndice.php" class="AdmLinks01">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroBannerInserir"); ?>
                            </a>
                        </div>
                    <?php } ?>
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
        <?php } ?>
    </div>
    <?php //************************************************************************************** ?>
    
    
	<?php //Cadastro - Diagramação em camadas. ?>
    <?php //************************************************************************************** ?>
	<div style="position: relative; display: none; overflow: hidden;">
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
			<?php
            $countTabelaFundo = 0;
			
			$arrCadastroFiltroGenerico20 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 69);

            
            //Loop pelos resultados.
            foreach($resultadoCadastro as $linhaCadastro)
            {
            //echo "id=" . $linhaCategorias['id'] . "<br />";
            ?>
                <div align="left" class="CadastroIndiceContainer">
                    <?php //Imagem. ?>
                    <?php if($GLOBALS['ativacaoCadastroVisualizacaoImagem'] == 1){ ?>
                        <?php if(!empty($linhaCadastro['imagem'])){ ?>
                        	<?php //Div e imagem de fundo. ?>
                        	<div onclick="location.href='SiteCadastroDetalhes.php?idTbCadastro=<?php echo $linhaCadastro['id'];?>';" style="position: relative; display: block; height: 52px; width: 52px; margin-left: 4px; margin-right: 10px; float: left; background-image: url(../<?php echo $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos'];?>/t<?php echo $linhaCadastro['imagem'];?>); background-repeat: no-repeat; background-position: center center; overflow: hidden; cursor: pointer;">
                            	
                        	</div>
                            
                            
                        	<?php //Div com imagem dentro. ?>
                            <div style="position: relative; display: none; height: 52px; width: 52px; margin-left: 4px; margin-right: 10px; float: left; overflow: hidden;">
                                <?php //Sem pop-up. ?>
                                <?php if($GLOBALS['configImagemPopUp'] == 0){ ?>
                                    <img src="../<?php echo $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos'];?>/t<?php echo $linhaCadastro['imagem'];?>" alt="<?php echo Funcoes::GetCadastroTitulo(Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome']), Funcoes::ConteudoMascaraLeitura($linhaCadastro['razao_social']), Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome_fantasia']), 1); ?>" />
                                <?php } ?>
                            
                                <?php //SlimBox 2 - JQuery. ?>
                                <?php if($GLOBALS['configImagemPopUp'] == 1){ ?>
                                    <a href="../<?php echo $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos'];?>/g<?php echo $linhaCadastro['imagem'];?>" rel="lightbox" title="<?php echo Funcoes::GetCadastroTitulo(Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome']), Funcoes::ConteudoMascaraLeitura($linhaCadastro['razao_social']), Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome_fantasia']), 1); ?>">
                                        <img src="../<?php echo $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos'];?>/t<?php echo $linhaCadastro['imagem'];?>" alt="<?php echo Funcoes::GetCadastroTitulo(Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome']), Funcoes::ConteudoMascaraLeitura($linhaCadastro['razao_social']), Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome_fantasia']), 1); ?>" />
                                    </a>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    
                    
                    <?php //Informações. ?>
                    <div class="CadastroIndiceConteudo" align="left" style="position: relative; display: block; width: 100%; margin-left: 70px;">
                    	<a href="SiteCadastroDetalhes.php?idTbCadastro=<?php echo $linhaCadastro['id'];?>" class="CadastroIndiceTitulo">
                        	<?php echo Funcoes::GetCadastroTitulo(Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome']), 
							Funcoes::ConteudoMascaraLeitura($linhaCadastro['razao_social']), 
							Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome_fantasia']), 1); ?>
                        </a>
                        <div>
                        	<?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar1']);?>
                        </div>
                    </div>
                    
                    
                    <?php //Filtros. ?>
                    <div class="CadastroIndiceConteudo" align="left" style="position: relative; display: block;">
                        <div>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico20Nome'], "IncludeConfig"); ?>:
                        </div>
						<?php 
                        $arrCadastroFiltroGenerico20Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($linhaCadastro['id'], "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "69", "", ",", "", "1"));
                        
                        ?>
                        <?php 
                        for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico20); $countArray++)
                        {
                        ?>
                            <div>
                                <?php if(in_array($arrCadastroFiltroGenerico20[$countArray][0], $arrCadastroFiltroGenerico20Selecao)){ ?> 
                                    - <?php echo $arrCadastroFiltroGenerico20[$countArray][1];?>
                                <?php } ?>
                            </div>
                        <?php 
                        }
                        ?>
                    </div>  
                    
                    
                    <?php //Endereço. ?>
                    <?php if($linhaCadastro['endereco_principal'] <> ""){ ?>
                    <div align="left" class="CadastroIndiceConteudo">
                        <strong>
                             <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroEnderecoPrincipal"); ?>:
                        </strong>
                        <?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastro['endereco_principal']);?> <?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastro['endereco_numero_principal']);?>
                        <?php if($linhaCadastro['endereco_complemento_principal'] <> ""){ ?>
                        	, <?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastro['endereco_complemento_principal']);?>
                        <?php } ?>
                    </div>
                    <?php } ?>
                    
                    <?php if($linhaCadastro['bairro_principal'] <> ""){ ?>
                    <div align="left" class="CadastroIndiceConteudo">
                        <strong>
                             <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroBairroPrincipal"); ?>:
                        </strong>
                        <?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastro['bairro_principal']);?>
                    </div>
                    <?php } ?>
                    
                    <?php if($linhaCadastro['cidade_principal'] <> ""){ ?>
                    <div align="left" class="CadastroIndiceConteudo">
                        <strong>
                             <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroBairroPrincipal"); ?>:
                        </strong>
                        <?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastro['cidade_principal']);?>
                    </div>
                    <?php } ?>
                    
                    <?php if($linhaCadastro['estado_principal'] <> ""){ ?>
                    <div align="left" class="CadastroIndiceConteudo">
                        <strong>
                             <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroEstadoPrincipal"); ?>:
                        </strong>
                        <?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastro['estado_principal']);?>
                    </div>
                    <?php } ?>
                    
                    <?php if($linhaCadastro['pais_principal'] <> ""){ ?>
                    <div align="left" class="CadastroIndiceConteudo">
                        <strong>
                             <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroPaisPrincipal"); ?>:
                        </strong>
                        <?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastro['pais_principal']);?>
                    </div>
                    <?php } ?>
                    
                    <?php //API - Distância / Duração.?>
                    <?php if($linhaCadastro['endereco_principal'] <> ""){ ?>
						<?php
                        /*
                        $linhaCadastro['mapa_online']
                        */
                        $arrCadastroDistanciaDuracao = "";
                        $arrCadastroDistanciaDuracao = JsonFuncoes::GetDados_API02("", 
                                                                                    "googleMatrix", 
                                                                                    "arrayDistanciasDuracao", 
                                                                                    array('distanciaOrigem'=>$visitanteConfigCoordLocalInicial,
                                                                                          'distanciaDestino'=>Funcoes::ConteudoMascaraLeitura($linhaCadastro['endereco_principal']) . " " . 
                                                                                                              Funcoes::ConteudoMascaraLeitura($linhaCadastro['endereco_numero_principal']) . "-" . 
                                                                                                              Funcoes::ConteudoMascaraLeitura($linhaCadastro['bairro_principal']) . "-" . 
                                                                                                              Funcoes::ConteudoMascaraLeitura($linhaCadastro['cidade_principal']) . "-" . 
                                                                                                              Funcoes::ConteudoMascaraLeitura($linhaCadastro['estado_principal']) . "-" . 
                                                                                                              Funcoes::ConteudoMascaraLeitura($linhaCadastro['pais_principal']))
                                                                                      );
    
                        ?>
                        <div align="left" class="CadastroIndiceConteudo">
                            <strong>
                                 <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemDistancia"); ?>:
                            </strong>
                            <?php echo $arrCadastroDistanciaDuracao["distancia"];?>
                        </div>
                        <div align="left" class="CadastroIndiceConteudo">
                            <strong>
                                 <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemDuracao"); ?>:
                            </strong>
                            <?php echo $arrCadastroDistanciaDuracao["duracao"];?>
                        </div>
                        
                        <?php
                        /*
                        $linhaCadastro['mapa_online']
                        */
                        $arrCadastroDistanciaDuracaoWalking = "";
                        $arrCadastroDistanciaDuracaoWalking = JsonFuncoes::GetDados_API02("", 
                                                                                    "googleMatrix", 
                                                                                    "arrayDistanciasDuracao", 
                                                                                    array('distanciaOrigem'=>$visitanteConfigCoordLocalInicial,
                                                                                          'distanciaDestino'=>Funcoes::ConteudoMascaraLeitura($linhaCadastro['endereco_principal']) . " " . 
                                                                                                              Funcoes::ConteudoMascaraLeitura($linhaCadastro['endereco_numero_principal']) . "-" . 
                                                                                                              Funcoes::ConteudoMascaraLeitura($linhaCadastro['bairro_principal']) . "-" . 
                                                                                                              Funcoes::ConteudoMascaraLeitura($linhaCadastro['cidade_principal']) . "-" . 
                                                                                                              Funcoes::ConteudoMascaraLeitura($linhaCadastro['estado_principal']) . "-" . 
                                                                                                              Funcoes::ConteudoMascaraLeitura($linhaCadastro['pais_principal']),
                                                                                          'distanciaModalidade'=>'walking')
                                                                                      );
    
                        ?>
                        
                        <div align="left" class="CadastroIndiceConteudo">
                            <strong>
                                 <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemDistancia"); ?> / <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemDuracao"); ?> (Andando):
                            </strong>
                            <?php echo $arrCadastroDistanciaDuracaoWalking["distancia"];?> / <?php echo $arrCadastroDistanciaDuracaoWalking["duracao"];?>
                        </div>
                    <?php } ?>
                    
                    
                    <?php //Botão detalhes. ?>
                    <a href="SiteCadastroDetalhes.php?idTbCadastro=<?php echo $linhaCadastro['id'];?>" style="position: relative; display: block;">
                        <img src="img/btoDetalhesCadastro.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoDetalhes"); ?>" />
                    </a>
                    
                    
					<?php //Itens - Selecao.?>
                    <?php //**************************************************************************************?>
                    <form name="formCadastroSelecao<?php echo $linhaCadastro['id']; ?>" id="formCadastroSelecao<?php echo $linhaCadastro['id']; ?>" action="SiteAdmItensSelecaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
                        <?php
                        $itemSelecionado = DbFuncoes::GetCampoGenerico06("tb_itens_selecao", 
                                                                        "id", 
                                                                        "id_tb_item", 
                                                                        $linhaCadastro['id'], 
                                                                        "", 
                                                                        "", 
                                                                        1,
                                                                        "", 
                                                                        "", 
                                                                        "id_tb_cadastro", 
                                                                        $idTbCadastroLogin, 
                                                                        "tipo_categoria", 
                                                                        "13");
                        
                        //Verificação de erro - debug.
                        //echo "itemSelecionado=" . $itemSelecionado . "<br/>";
                        ?>
                        <div align="left" style="position: relative; display: block; clear: both; overflow: hidden;">
                            <?php //Seleção ?>
                            <?php if($itemSelecionado == ""){ ?>
                                <input type="image" name="submitItensSelecionar" value="Submit" src="img/btoSelecionar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoItensSelecionar"); ?>" style="display: block;" />
                                
                                <a class="CadastroIndiceLinks01" onclick="document.getElementById('formCadastroSelecao<?php echo $linhaCadastro['id']; ?>').submit();" style="cursor: pointer; display: block;">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoItensSelecionar"); ?>
                                </a>
                                <input name="submitItensSelecionar_x" type="hidden" id="submitItensSelecionar_x" value="1" /><?php //Necessário quando utilizando link.?>
                            <?php } ?>
                            
                            
                            <?php //Cancelar seleção ?>
                            <?php if($itemSelecionado <> ""){ ?>
                                <input type="image" name="submitItensCancelar" value="Submit" src="img/btoItensCancelar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoSelecionar"); ?>" style="display: block;" />
                                
                                <a class="CadastroIndiceLinks01" onclick="document.getElementById('formCadastroSelecao<?php echo $linhaCadastro['id']; ?>').submit();" style="cursor: pointer; display: block;">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoExcluir"); ?>
                                </a>
                                <input name="submitItensCancelar_x" type="hidden" id="submitItensCancelar_x" value="1" /><?php //Necessário quando utilizando link.?>
                            <?php } ?>
                        </div>
                    
                        <input name="idItem" type="hidden" id="idItem" value="<?php echo $linhaCadastro['id']; ?>" />
                        <!--input name="strTabela" type="hidden" id="strTabela" value="tb_cadastro" /-->
                        <input name="tipoCategoria" type="hidden" id="tipoCategoria" value="13" />
                        <input name="ativacao" type="hidden" id="ativacao" value="1" />
                        
                        <input name="variavelRetorno" type="hidden" id="variavelRetorno" value="<?php echo $variavelRetorno;?>" />
                        <input name="idRetorno" type="hidden" id="idRetorno" value="<?php echo $idRetorno;?>" />
                        <input name="masterPageSiteSelect" type="hidden" id="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
                        <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                        
                        <input name="palavraChave" type="hidden" id="palavraChave" value="<?php echo $palavraChave; ?>" />
                    </form>
                    <?php //**************************************************************************************?>
                </div>
            <?php } ?>
        <?php } ?>
    </div>
    <?php //************************************************************************************** ?>


	<?php //Paginação. ?>
    <?php //************************************************************************************** ?>
    <?php if($GLOBALS['habilitarCadastroSitePaginacaoSimples'] == "1"){ ?>
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
                <?php if($GLOBALS['habilitarCadastroSitePaginacaoQtdPaginas'] == "1"){ ?>
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