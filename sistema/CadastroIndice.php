<?php
//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeLayout.php";


//Verificação de login Master.
LoginAutenticacao::UsuarioLoginVerificacao();


//Resgate de variáveis.
$idParentCadastro = $_GET["idParentCadastro"];
$idParentCategoriasRaiz = $_GET["idParentCategoriasRaiz"];
if($idParentCategoriasRaiz == "")
{
	$idParentCategoriasRaiz = 0;
}

/*$idTbCadastro = $_GET["idTbCadastro"];
if($idTbCadastro == "")
{
	$idTbCadastro = 0;
}*/
$idsTdCadastro = $_GET["idsTdCadastro"];

/*
$arrIdsTbCadastroComplemento = $_GET["idsTbCadastroComplemento"];
$idsTbCadastroComplemento = "";
foreach ($arrIdsTbCadastroComplemento as $idTbCadastroComplemento)
{
	$idsTbCadastroComplemento .= "," . $idTbCadastroComplemento
}
*/
$idsTbCadastroComplemento = $_GET["idsTbCadastroComplemento"];
if(is_array($idsTbCadastroComplemento) == true)
{
	//$idsTbCadastroComplemento = implode(",", $_GET["idsTbCadastroComplemento"]);
	$idsTbCadastroComplemento = implode(",", $idsTbCadastroComplemento);
}
if($idsTbCadastroComplemento <> "")
{
	if($idsTdCadastro <> "")
	{
		$idsTdCadastro .= "," . DbFuncoes::GetIdsByTipoComplemento_FromArray($idsTbCadastroComplemento, 
																			"tb_cadastro_relacao_complemento", 
																			"id_tb_cadastro_complemento", 
																			"id_tb_cadastro");
		/*
		$idsTdCadastro .= "," . DbFuncoes::GetCampoGenerico06("tb_cadastro_relacao_complemento", 
																"id_tb_cadastro", 
																"id_tb_cadastro_complemento", 
																$idsTbCadastroComplemento, 
																"", 
																"", 
																1, 
																"", 
																"", 
																"tipo_complemento", 
																"14", 
																"", 
																"");
		*/
		
	}else{
		$idsTdCadastro .= DbFuncoes::GetIdsByTipoComplemento_FromArray($idsTbCadastroComplemento, 
																		"tb_cadastro_relacao_complemento", 
																		"id_tb_cadastro_complemento", 
																		"id_tb_cadastro");
	}
	
	if($idsTdCadastro == "")
	{
		$idsTdCadastro = "0";
	}
}

$palavraChave = $_GET["palavraChave"];

$paginaRetorno = "CadastroIndice.php";
$paginaRetornoExclusao = "CadastroEditar.php";
$variavelRetorno = "idParentCadastro";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];

//if($palavraChave <> "")
//{
	//$habilitarCadastroSistemaPaginacao = 0;
//}


//Paginação.
if($GLOBALS['habilitarCadastroSistemaPaginacao'] == "1"){
	$paginacaoNRegistros = $GLOBALS['configCadastroSistemaPaginacaoNRegistros'];
	$paginacaoNumero = $_GET["paginacaoNumero"];
	if($paginacaoNumero == "")
	{
		$paginacaoNumero = 1;
	}
	$paginacaoInicio = ($paginacaoNumero-1) * $paginacaoNRegistros;
}

//Montagem de query padrão de retorno.
$queryPadrao = "&idParentCadastro=" . $idParentCadastro . 
"&paginaRetorno=" . $paginaRetorno . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&variavelRetorno=" . $variavelRetorno . 
"&idsTbCadastroComplemento=" . $idsTbCadastroComplemento . 
"&palavraChave=" . $palavraChave;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Query de pesquisa.
//----------
$strSqlCadastroSelect = "";
$strSqlCadastroSelect .= "SELECT ";
//$strSqlCadastroSelect .= "SELECT SQL_CALC_FOUND_ROWS ";
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
$strSqlCadastroSelect .= "ativacao1, ";
$strSqlCadastroSelect .= "ativacao2, ";
$strSqlCadastroSelect .= "ativacao3, ";
$strSqlCadastroSelect .= "ativacao4, ";
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
	if($idParentCadastro <> "")
	{
		$strSqlCadastroSelect .= "AND id_tb_categorias = :id_tb_categorias ";
	}
	if($idsTdCadastro <> "")
	{
		//$strSqlCadastroSelect .= "AND id IN (:idsTdCadastro) ";
		$strSqlCadastroSelect .= "AND id IN ( " . Funcoes::ConteudoMascaraGravacao01($idsTdCadastro) . ") ";
		//$strSqlCadastroSelect .= "AND id IN :idsTdCadastro ";
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
if($idParentCadastro <> "")
{
	$strSqlCadastroSelect .= "AND id_tb_categorias = :id_tb_categorias ";
}
if($idsTdCadastro <> "")
{
	//$strSqlCadastroSelect .= "AND id IN (:idsTdCadastro) ";
	$strSqlCadastroSelect .= "AND id IN ( " . Funcoes::ConteudoMascaraGravacao01($idsTdCadastro) . ") ";
	//$strSqlCadastroSelect .= "AND id IN :idsTdCadastro ";
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
if($GLOBALS['habilitarCadastroClassificacaoPersonalizada'] == 1 and DbFuncoes::GetCampoGenerico04("classificacao", "criterio_classificacao", "id_registro", $idParentCadastro) <> "")
{
	$strSqlCadastroSelect .= "ORDER BY " . DbFuncoes::GetCampoGenerico04("classificacao", "criterio_classificacao", "id_registro", $idParentCadastro) . " ";
	
}else{
	$strSqlCadastroSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
}

//Paginação.
if($GLOBALS['habilitarCadastroSistemaPaginacao'] == "1"){ 
	if($configTipoDB == 2)
	{
		$strSqlCadastroSelect .= "LIMIT " . $paginacaoInicio . ", " . $paginacaoNRegistros . "";
	}
}
//echo "strSqlCadastroSelect=" . $strSqlCadastroSelect . "<br />";
//----------


//Parâmetros e componentes.
//----------
$statementCadastroSelect = $dbSistemaConPDO->prepare($strSqlCadastroSelect);

if ($statementCadastroSelect !== false)
{
	/*
	$statementCadastroSelect->bindParam(':id_tb_categorias', $idParentCadastro, PDO::PARAM_STR);
	//$statementCadastroSelect->bindParam(':idsTdCadastro', $idsTdCadastro, PDO::PARAM_STR);
	//$statementCadastroSelect->bindParam(':idsTdCadastro', array($idsTdCadastro), PDO::PARAM_STR);
	//$statementCadastroSelect->bindParam(':palavraChave', "%".$palavraChave."%", PDO::PARAM_STR);
	$statementCadastroSelect->execute();
	*/
	//"idsTdCadastro" => $idsTdCadastro
	if($idParentCadastro <> "")
	{
		$statementCadastroSelect->bindParam(':id_tb_categorias', $idParentCadastro, PDO::PARAM_STR);
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


//Verificação de erro - debug.
//echo "palavraChave=" . $palavraChave . "<br />";
//echo "strSqlCadastroSelect=" . $strSqlCadastroSelect . "<br />";
//echo "paginacaoTotalRegistros=" . $paginacaoTotalRegistros . "<br />";
//$row = $statementCadastroSelect->fetch(PDO::FETCH_NUM);
//echo "row=" . $row[0] . "<br />";
//echo "count(resultadoCadastro)=" . count($resultadoCadastro) . "<br />";
//echo "total_count=" . $resultadoCadastro[0]['totalRegistros'] . "<br />";
//echo "idsTbCadastroComplemento=" . $idsTbCadastroComplemento . "<br />";
/*
echo "GetCampoGenerico06=" . DbFuncoes::GetCampoGenerico06("tb_cadastro_relacao_complemento", 
	"id_tb_cadastro", 
	"id_tb_cadastro_complemento", 
	"3964", 
	"", 
	"", 
	1, 
	"", 
	"", 
	"tipo_complemento", 
	"14", 
	"", 
	"") . "<br />";
*/
//echo "idsTdCadastro=" . $idsTdCadastro . "<br />";

//echo "GetIdsByTipoComplemento_FromArray=" . GetIdsByTipoComplemento_FromArray("3655,23652", "tb", "nc", "") . "<br />";
//echo "GetIdsByTipoComplemento_FromArray=" . GetIdsByTipoComplemento_FromArray("3964,4190,3955", "tb_cadastro_relacao_complemento", "id_tb_cadastro_complemento", "id_tb_cadastro") . "<br />";
//echo "GetIdsByTipoComplemento_FromArray=" . GetIdsByTipoComplemento_FromArray("3955", "tb_cadastro_relacao_complemento", "id_tb_cadastro_complemento", "id_tb_cadastro") . "<br />";
//echo "GetIdsByTipoComplemento_FromArray=" . GetIdsByTipoComplemento_FromArray("", "tb_cadastro_relacao_complemento", "id_tb_cadastro_complemento", "id_tb_cadastro") . "<br />";
//echo "GetIdsByTipoComplemento_FromArray=" . DbFuncoes::GetIdsByTipoComplemento_FromArray("3964,4190,3955", "tb_cadastro_relacao_complemento", "id_tb_cadastro_complemento", "id_tb_cadastro") . "<br />";
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistema"); ?> - <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configNomeCliente'], "IncludeConfig"); ?>
<?php 
$page->cphTitle = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Head.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphHead*/ ?>
	
<?php 
$page->cphHead = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Cabeçalho.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphConteudoCabecalho*/ ?>
    <div align="left" class="TextoTitulo01">
    	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroTitulo"); ?> - 
        <a href="CategoriasIndice.php?idParentCategorias=<?php echo $idParentCategoriasRaiz; ?>&idParentCategoriasRaiz=<?php echo $idParentCategoriasRaiz; ?>" class="Links04">
        	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemRoot"); ?>
        </a>
        <?php echo DbFuncoes::CategoriasCaminho($idParentCadastro, $idParentCategoriasRaiz, " - ", "Links04", "backend"); ?>
    </div>
<?php 
$page->cphConteudoCabecalho = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Conteúdo principal.?>
<?php //**************************************************************************************?>
<?php ob_start(); /*cphConteudoPrincipal*/ ?>
    <div align="center" class="TextoErro">
        <?php echo $mensagemErro;?>
    </div>
    <div align="center" class="TextoSucesso">
        <?php echo $mensagemSucesso;?>
    </div>
	
    <?php
	if (empty($resultadoCadastro))
	{
        //echo "Nenhum registro encontrado";
    ?>
        <div align="center" class="TextoErro">
            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
        </div>
    <?php
    }else{
    ?>
        <form name="formCadastroAcoes" id="formCadastroAcoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_cadastro" />
            <input name="idParentCadastro" id="idParentCadastro" type="hidden" value="<?php echo $idParentCadastro; ?>" />
            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            
            <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            <div style="position:relative; display: block; clear: both;">
            	<?php if($GLOBALS['habilitarCadastroClassificacaoPersonalizada'] == 1){ ?>
                    <div align="left" style="float: left;">
                        <a href="ClassificacaoPersonalizadaExe.php?idRegistro=<?php echo $idParentCadastro; ?>&strTabela=tb_cadastro&strExcluir=1<?php echo $queryPadrao; ?><?php echo $queryPadraoRetornoPaginacao; ?>" class="Links03">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemClassificacaoPadrao"); ?>
                        </a>
                    </div>
                <?php } ?>
                <div align="right" style="float: right;">
                    <input type="image" name="submit" value="Submit" src="img/btoExcluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoExcluir"); ?>">
                </div>
            </div>
            <table width="100%" class="TabelaDados01">
              <tr class="TbFundoEscuro">
              	<?php if($GLOBALS['habilitarCadastroNClassificacao'] == 1){ ?>
                <td width="50" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
						<?php if($GLOBALS['habilitarCadastroClassificacaoPersonalizada'] == 1){ ?>
                            <a href="ClassificacaoPersonalizadaExe.php?idRegistro=<?php echo $idParentCadastro; ?>&strTabela=tb_cadastro&criterioClassificacao=n_classificacao<?php echo $queryPadrao; ?><?php echo $queryPadraoRetornoPaginacao; ?>" class="Links02">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNClassificacaoA"); ?>
                            <a>
                         <?php }else{ ?>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNClassificacaoA"); ?>
                        <?php } ?>
                    </div>
                </td>
                <?php } ?>
                
                <td width="100" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
						<?php if($GLOBALS['habilitarCadastroClassificacaoPersonalizada'] == 1){ ?>
                            <a href="ClassificacaoPersonalizadaExe.php?strExcluir=1&idRegistro=<?php echo $idParentCadastro; ?>&strTabela=tb_cadastro&criterioClassificacao=data_cadastro desc<?php echo $queryPadrao; ?><?php echo $queryPadraoRetornoPaginacao; ?>" class="Links02">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroData"); ?>
                            <a>
                         <?php }else{ ?>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroData"); ?>
                        <?php } ?>
                    </div>
                </td>
                
              	<?php if($GLOBALS['ativacaoCadastroVisualizacaoImagem'] == 1){ ?>
                <td width="1" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemImagem"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <td class="TabelaDados01Celula">
                    <div class="Texto02">
						<?php if($GLOBALS['habilitarCadastroClassificacaoPersonalizada'] == 1){ ?>
                            <a href="ClassificacaoPersonalizadaExe.php?idRegistro=<?php echo $idParentCadastro; ?>&strTabela=tb_cadastro&criterioClassificacao=nome<?php echo $queryPadrao; ?><?php echo $queryPadraoRetornoPaginacao; ?>" class="Links02">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastro"); ?>
                            <a>
                         <?php }else{ ?>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastro"); ?>
                        <?php } ?>
                    </div>
                </td>
                <td width="100" class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFuncoes"); ?>
                    </div>
                </td>
                <td width="30" class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao"); ?>
						<?php if($GLOBALS['habilitarCadastroClassificacaoPersonalizada'] == 1){ ?>
                            <a href="ClassificacaoPersonalizadaExe.php?idRegistro=<?php echo $idParentCadastro; ?>&strTabela=tb_cadastro&criterioClassificacao=ativacao<?php echo $queryPadrao; ?><?php echo $queryPadraoRetornoPaginacao; ?>" class="Links02">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao"); ?>
                            <a>
                         <?php }else{ ?>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao"); ?>
                        <?php } ?>
                    </div>
                </td>
                
                <?php if($GLOBALS['habilitarCadastroAtivacao1'] == 1){ ?>
                <td width="30" class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao"); ?>
						<?php if($GLOBALS['habilitarCadastroClassificacaoPersonalizada'] == 1){ ?>
                            <a href="ClassificacaoPersonalizadaExe.php?idRegistro=<?php echo $idParentCadastro; ?>&strTabela=tb_cadastro&criterioClassificacao=ativacao1<?php echo $queryPadrao; ?><?php echo $queryPadraoRetornoPaginacao; ?>" class="Links02">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroAtivacao1'], "IncludeConfig"); ?>
                            <a>
                         <?php }else{ ?>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroAtivacao1'], "IncludeConfig"); ?>
                        <?php } ?>
                    </div>
                </td>
				<?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroAtivacao2'] == 1){ ?>
                <td width="30" class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao"); ?>
						<?php if($GLOBALS['habilitarCadastroClassificacaoPersonalizada'] == 1){ ?>
                            <a href="ClassificacaoPersonalizadaExe.php?idRegistro=<?php echo $idParentCadastro; ?>&strTabela=tb_cadastro&criterioClassificacao=ativacao2<?php echo $queryPadrao; ?><?php echo $queryPadraoRetornoPaginacao; ?>" class="Links02">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroAtivacao2'], "IncludeConfig"); ?>
                            <a>
                         <?php }else{ ?>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroAtivacao2'], "IncludeConfig"); ?>
                        <?php } ?>
                    </div>
                </td>
				<?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroAtivacao3'] == 1){ ?>
                <td width="30" class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao"); ?>
						<?php if($GLOBALS['habilitarCadastroClassificacaoPersonalizada'] == 1){ ?>
                            <a href="ClassificacaoPersonalizadaExe.php?idRegistro=<?php echo $idParentCadastro; ?>&strTabela=tb_cadastro&criterioClassificacao=ativacao3<?php echo $queryPadrao; ?><?php echo $queryPadraoRetornoPaginacao; ?>" class="Links02">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroAtivacao3'], "IncludeConfig"); ?>
                            <a>
                         <?php }else{ ?>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroAtivacao3'], "IncludeConfig"); ?>
                        <?php } ?>
                    </div>
                </td>
				<?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroAtivacao4'] == 1){ ?>
                <td width="30" class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao"); ?>
						<?php if($GLOBALS['habilitarCadastroClassificacaoPersonalizada'] == 1){ ?>
                            <a href="ClassificacaoPersonalizadaExe.php?idRegistro=<?php echo $idParentCadastro; ?>&strTabela=tb_cadastro&criterioClassificacao=ativacao4<?php echo $queryPadrao; ?><?php echo $queryPadraoRetornoPaginacao; ?>" class="Links02">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroAtivacao4'], "IncludeConfig"); ?>
                            <a>
                         <?php }else{ ?>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroAtivacao4'], "IncludeConfig"); ?>
                        <?php } ?>
                    </div>
                </td>
				<?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroAtivacaoDestaque'] == 1){ ?>
                <td width="30" class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao"); ?>
						<?php if($GLOBALS['habilitarCadastroClassificacaoPersonalizada'] == 1){ ?>
                            <a href="ClassificacaoPersonalizadaExe.php?idRegistro=<?php echo $idParentCadastro; ?>&strTabela=tb_cadastro&criterioClassificacao=ativacao_destaque<?php echo $queryPadrao; ?><?php echo $queryPadraoRetornoPaginacao; ?>" class="Links02">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroAtivacaoDestaque"); ?>
                            <a>
                         <?php }else{ ?>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroAtivacaoDestaque"); ?>
                        <?php } ?>
                    </div>
                </td>
				<?php } ?>
                
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemExcluir"); ?>
                    </div>
                </td>
              </tr>
              <?php
                //Loop pelos resultados.
                foreach($resultadoCadastro as $linhaCadastro)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
              	<?php if($GLOBALS['habilitarCadastroNClassificacao'] == 1){ ?>
                <td width="50" class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php //echo $linhaCadastro['n_classificacao'];?>
                    </div>
                </td>
                <?php } ?>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaCadastro['data_cadastro'];?>
                    </div>
                </td>

              	<?php if($GLOBALS['ativacaoCadastroVisualizacaoImagem'] == 1){ ?>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
						<?php if(!empty($linhaCadastro['imagem'])){ ?>
							<?php //Sem pop-up. ?>
                            <?php if($GLOBALS['configImagemPopUp'] == 0){ ?>
                                <img src="<?php echo $GLOBALS['configDiretorioArquivos'];?>/t<?php echo $linhaCadastro['imagem'];?>" alt="<?php echo Funcoes::GetCadastroTitulo(Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome']), Funcoes::ConteudoMascaraLeitura($linhaCadastro['razao_social']), Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome_fantasia']), 1); ?>" />
                            <?php } ?>
                        
                            <?php //SlimBox 2 - JQuery. ?>
                            <?php if($GLOBALS['configImagemPopUp'] == 1){ ?>
                                <a href="<?php echo $GLOBALS['configDiretorioArquivos'];?>/g<?php echo $linhaCadastro['imagem'];?>" rel="lightbox" title="">
                                    <img src="<?php echo $GLOBALS['configDiretorioArquivos'];?>/t<?php echo $linhaCadastro['imagem'];?>" alt="<?php echo Funcoes::GetCadastroTitulo(Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome']), Funcoes::ConteudoMascaraLeitura($linhaCadastro['razao_social']), Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome_fantasia']), 1); ?>" />
                                </a>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
                <?php } ?>

                <td class="TabelaDados01Celula">
                    <div class="Texto01">
                    	<div>
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome']);?>
                            <?php //echo Funcoes::GetCadastroTitulo(Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome']), Funcoes::ConteudoMascaraLeitura($linhaCadastro['razao_social']), Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome_fantasia']), 1); ?>
                        </div>
                        
                        <?php if($GLOBALS['habilitarCadastroRazaoSocial'] == 1 && !empty($linhaCadastro['razao_social'])){ ?>
                            <div>
                            	<strong>
                                	 <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroRazaoSocial"); ?>: 
                                </strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastro['razao_social']);?>
                            </div>
                        <?php } ?>

                        <?php if($GLOBALS['habilitarCadastroNomeFantasia'] == 1 && !empty($linhaCadastro['nome_fantasia'])){ ?>
                            <div>
                            	<strong>
                                	 <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroNomeFantasia"); ?>: 
                                </strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome_fantasia']);?>
                            </div>
                        <?php } ?>
                        
                        <?php if(!empty($linhaCadastro['email_principal'])){ ?>
                            <div>
                            	<strong>
                                	 <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroEmailPrincipal"); ?>: 
                                </strong>
                                <a href="mailto:<?php echo Funcoes::FormatarTelefoneLer($linhaCadastro['email_principal']);?>" class="Links01">
                                	<?php echo Funcoes::FormatarTelefoneLer($linhaCadastro['email_principal']);?>
                                </a>
                            </div>
                        <?php } ?>
                        
                        <?php if($GLOBALS['configCadastroSenha'] == 1){ ?>
							<?php if($GLOBALS['habilitarCadastroSenha'] == 1 && !empty($linhaCadastro['senha'])){ ?>
                                <div>
                                    <strong>
                                         <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroSenha"); ?>: 
                                    </strong>
                                    <?php if($GLOBALS['configCadastroMetodoSenha'] == 2){ ?>
                                        <?php if($GLOBALS['configCadastroSenha'] == 1){ ?>
                                            <?php //echo Crypto::DecryptValue(EncryptValue(Funcoes::ConteudoMascaraLeitura($linhaCadastro['senha']), 2), 2);?>
                                            <?php echo Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura($linhaCadastro['senha'], 2), 2);?>
                                            <?php //echo Crypto::DecryptValue(Funcoes::ConteudoMascaraGravacao01($linhaCadastro['senha']), 2);?>
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
                                	 <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroTel"); ?>: 
                                </strong>
                                (<?php echo $linhaCadastro['tel_ddd_principal'];?>) <?php echo Funcoes::FormatarTelefoneLer($linhaCadastro['tel_principal']);?>
                            </div>
                        <?php } ?>
                        <?php if(!empty($linhaCadastro['cel_principal'])){ ?>
                            <div>
                            	<strong>
                                	 <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroCel"); ?>: 
                                </strong>
                                (<?php echo $linhaCadastro['cel_ddd_principal'];?>) <?php echo Funcoes::FormatarTelefoneLer($linhaCadastro['cel_principal']);?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="Texto01">
                    	<?php if($GLOBALS['habilitarCadastroFotos'] == 1){ ?>
                            [
                            <a href="ArquivosIndice.php?idParent=<?php echo $linhaCadastro['id'];?>&tipoArquivo=1&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo Funcoes::GetCadastroTitulo(Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome']), Funcoes::ConteudoMascaraLeitura($linhaCadastro['razao_social']), Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome_fantasia']), 1);?>&detalhe02=" target="_blank" class="Links01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserirFotos"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarCadastroVideos'] == 1){ ?>
                            [
                            <a href="ArquivosIndice.php?idParent=<?php echo $linhaCadastro['id'];?>&tipoArquivo=2&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo Funcoes::GetCadastroTitulo(Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome']), Funcoes::ConteudoMascaraLeitura($linhaCadastro['razao_social']), Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome_fantasia']), 1);?>&detalhe02=" target="_blank" class="Links01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserirVideos"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarCadastroArquivos'] == 1){ ?>
                            [
                            <a href="ArquivosIndice.php?idParent=<?php echo $linhaCadastro['id'];?>&tipoArquivo=3&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo Funcoes::GetCadastroTitulo(Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome']), Funcoes::ConteudoMascaraLeitura($linhaCadastro['razao_social']), Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome_fantasia']), 1);?>&detalhe02=" target="_blank" class="Links01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserirArquivos"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarCadastroZip'] == 1){ ?>
                            [
                            <a href="ArquivosIndice.php?idParent=<?php echo $linhaCadastro['id'];?>&tipoArquivo=4&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo Funcoes::GetCadastroTitulo(Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome']), Funcoes::ConteudoMascaraLeitura($linhaCadastro['razao_social']), Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome_fantasia']), 1);?>&detalhe02=" target="_blank" class="Links01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserirZip"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarCadastroSwfs'] == 1){ ?>
                            [
                            <a href="ArquivosIndice.php?idParent=<?php echo $linhaCadastro['id'];?>&tipoArquivo=5&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo Funcoes::GetCadastroTitulo(Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome']), Funcoes::ConteudoMascaraLeitura($linhaCadastro['razao_social']), Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome_fantasia']), 1);?>&detalhe02=" target="_blank" class="Links01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserirSWFs"); ?>
                            </a>
                            ] 
                        <?php } ?>
                        
                    	<?php if($GLOBALS['habilitarCadastroProcessos'] == 1){ ?>
                            [
                            <a href="ProcessosIndice.php?idParentProcessos=<?php echo $linhaCadastro['id'];?>&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome']);?>&detalhe02=" target="_blank" class="Links01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserirProcessos"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                    	<a href="CadastroAdministrar.php?idTbCadastro=<?php echo $linhaCadastro['id'];?>&masterPageSelect=LayoutSistemaSemMenu.php" target="_blank" class="Links01">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroAdministrar"); ?>
                        </a>
                    </div>
                    <?php if($GLOBALS['habilitarCadastroLogo'] == 1){ ?>
                        <div align="center" class="Texto01">
                            <a href="CadastroArquivosComplementares.php?idTbCadastro=<?php echo $linhaCadastro['id'];?>&campo=logo&paginaRetorno=CadastroIndice.php" class="Links01">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroLogoInserir"); ?>
                            </a>
                        </div>
                    <?php } ?>
                    <?php if($GLOBALS['habilitarCadastroMapa'] == 1){ ?>
                        <div align="center" class="Texto01">
                            <a href="CadastroArquivosComplementares.php?idTbCadastro=<?php echo $linhaCadastro['id'];?>&campo=mapa&paginaRetorno=CadastroIndice.php" class="Links01">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroMapaInserir"); ?>
                            </a>
                        </div>
                    <?php } ?>
                    <?php if($GLOBALS['habilitarCadastroBanner'] == 1){ ?>
                        <div align="center" class="Texto01">
                            <a href="CadastroArquivosComplementares.php?idTbCadastro=<?php echo $linhaCadastro['id'];?>&campo=banner&paginaRetorno=CadastroIndice.php" class="Links01">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroBannerInserir"); ?>
                            </a>
                        </div>
                    <?php } ?>
                    
					<?php if($GLOBALS['habilitarCadastroProdutosVinculosMultiplos'] == 1){ ?>
                    <div align="center" class="Texto01">
                        <a href="ItensRelacaoRegistrosIndice.php?idItem=<?php echo $linhaCadastro['id'];?>&tipoCategoria=2&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastro['none']);?>&detalhe02=" target="_blank" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemVincularProdutos"); ?>
                        </a>
                    </div>
                    <?php } ?>
					<?php if($GLOBALS['habilitarCadastroCategoriasVinculosMultiplos'] == 1){ ?>
                    <div align="center" class="Texto01">
                        <a href="ItensRelacaoRegistrosIndice.php?idItem=<?php echo $linhaCadastro['id'];?>&tipoCategoria=9&idParentCategoriasRaiz=<?php echo $GLOBALS['configCadastroIdCategoriaMultiplaRaiz'];?>&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastro['none']);?>&detalhe02=" target="_blank" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemVincularCategorias"); ?>
                        </a>
                    </div>
                    <?php } ?>
                </td>
                
                <td class="<?php if($linhaCadastro['ativacao'] == 1){/*echo "TbFundoClaro";*/}else{echo "TbFundoDesativado";}?> TabelaDados01Celula">
                    <div align="center" class="Texto01">
                    	<a href="RegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaCadastro['id'];?>&statusAtivacao=<?php echo $linhaCadastro['ativacao'];?>&strTabela=tb_cadastro&strCampo=ativacao<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="Links01">
                        	<?php if($linhaCadastro['ativacao'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao0"); ?>
                            <?php } ?>
                        	<?php if($linhaCadastro['ativacao'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao1"); ?>
                            <?php } ?>
                        </a>
						<?php //echo $linhaCategorias['ativacao'];?>
                    </div>
                </td>
                
				<?php if($GLOBALS['habilitarCadastroAtivacao1'] == 1){ ?>
                <td class="<?php if($linhaCadastro['ativacao1'] == 1){/*echo "TbFundoClaro";*/}else{echo "TbFundoDesativado";}?> TabelaDados01Celula">
                    <div align="center" class="Texto01">
                    	<a href="RegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaCadastro['id'];?>&statusAtivacao=<?php echo $linhaCadastro['ativacao1'];?>&strTabela=tb_cadastro&strCampo=ativacao1<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="Links01">
                        	<?php if($linhaCadastro['ativacao1'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao0"); ?>
                            <?php } ?>
                        	<?php if($linhaCadastro['ativacao1'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao1"); ?>
                            <?php } ?>
                        </a>
						<?php //echo $linhaCategorias['ativacao'];?>
                    </div>
                </td>
				<?php } ?>
                
				<?php if($GLOBALS['habilitarCadastroAtivacao2'] == 1){ ?>
                <td class="<?php if($linhaCadastro['ativacao2'] == 1){/*echo "TbFundoClaro";*/}else{echo "TbFundoDesativado";}?> TabelaDados01Celula">
                    <div align="center" class="Texto01">
                    	<a href="RegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaCadastro['id'];?>&statusAtivacao=<?php echo $linhaCadastro['ativacao2'];?>&strTabela=tb_cadastro&strCampo=ativacao2<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="Links01">
                        	<?php if($linhaCadastro['ativacao2'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao0"); ?>
                            <?php } ?>
                        	<?php if($linhaCadastro['ativacao2'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao1"); ?>
                            <?php } ?>
                        </a>
						<?php //echo $linhaCategorias['ativacao'];?>
                    </div>
                </td>
				<?php } ?>
                
				<?php if($GLOBALS['habilitarCadastroAtivacao3'] == 1){ ?>
                <td class="<?php if($linhaCadastro['ativacao3'] == 1){/*echo "TbFundoClaro";*/}else{echo "TbFundoDesativado";}?> TabelaDados01Celula">
                    <div align="center" class="Texto01">
                    	<a href="RegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaCadastro['id'];?>&statusAtivacao=<?php echo $linhaCadastro['ativacao3'];?>&strTabela=tb_cadastro&strCampo=ativacao3<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="Links01">
                        	<?php if($linhaCadastro['ativacao3'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao0"); ?>
                            <?php } ?>
                        	<?php if($linhaCadastro['ativacao3'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao1"); ?>
                            <?php } ?>
                        </a>
						<?php //echo $linhaCategorias['ativacao'];?>
                    </div>
                </td>
				<?php } ?>
                
				<?php if($GLOBALS['habilitarCadastroAtivacao4'] == 1){ ?>
                <td class="<?php if($linhaCadastro['ativacao4'] == 1){/*echo "TbFundoClaro";*/}else{echo "TbFundoDesativado";}?> TabelaDados01Celula">
                    <div align="center" class="Texto01">
                    	<a href="RegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaCadastro['id'];?>&statusAtivacao=<?php echo $linhaCadastro['ativacao4'];?>&strTabela=tb_cadastro&strCampo=ativacao4<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="Links01">
                        	<?php if($linhaCadastro['ativacao4'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao0"); ?>
                            <?php } ?>
                        	<?php if($linhaCadastro['ativacao4'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao1"); ?>
                            <?php } ?>
                        </a>
						<?php //echo $linhaCategorias['ativacao'];?>
                    </div>
                </td>
				<?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroAtivacaoDestaque'] == 1){ ?>
                <td class="<?php if($linhaCadastro['ativacao_destaque'] == 1){/*echo "TbFundoClaro";*/}else{echo "TbFundoDesativado";}?> TabelaDados01Celula">
                    <div align="center" class="Texto01">
                    	<a href="RegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaCadastro['id'];?>&statusAtivacao=<?php echo $linhaCadastro['ativacao_destaque'];?>&strTabela=tb_cadastro&strCampo=ativacao_destaque<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="Links01">
                        	<?php if($linhaCadastro['ativacao_destaque'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao0"); ?>
                            <?php } ?>
                        	<?php if($linhaCadastro['ativacao_destaque'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao1"); ?>
                            <?php } ?>
                        </a>
						<?php //echo $linhaCategorias['ativacao'];?>
                    </div>
                </td>
				<?php } ?>

                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="CadastroEditar.php?idTbCadastro=<?php echo $linhaCadastro['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaCadastro['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
            <?php } ?>
            </table>
        </form>
	<?php } ?>
	
	<?php //Paginação. ?>
    <?php //************************************************************************************** ?>
    <?php if($GLOBALS['habilitarCadastroSistemaPaginacao'] == "1"){ ?>
    	<?php 
			//echo "paginacaoTotal=" . $paginacaoTotal . "<br />"
		?>
		<?php if($paginacaoTotal > 1){ //Verifica se existe mais de uma página.?>
            <div align="center" class="Texto01">
                <div style="position: relative; display: inline; margin: 2px;">
                    <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=1<?php echo $queryPadrao; ?>" class="Links03">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemPaginacaoPrimeira"); ?>
                    </a>
                </div>
                
                <?php if($paginacaoNumero > 1){ ?>
                    <div style="position: relative; display: inline; margin: 2px;">
                        <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=<?php echo $paginacaoNumero - 1 ?><?php echo $queryPadrao; ?>" class="Links03">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemPaginacaoAnterior"); ?>
                        </a>
                    </div>
                <?php } ?>
                
                <?php //Numeração de páginas. ?>
                <?php if($GLOBALS['habilitarCadastroSistemaPaginacaoNumeracao'] == "1"){ ?>
                    <?php for($countPaginas = 1; $countPaginas <= $paginacaoTotal; $countPaginas++){ ?>
                        <div style="position: relative; display: inline; margin: 2px;">
                            <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=<?php echo $countPaginas; ?><?php echo $queryPadrao; ?>" class="Links03">
                                <?php echo $countPaginas; ?>
                            </a>
                        </div>
                    <?php } ?>
                <?php } ?>
                
                <?php if($paginacaoNumero <> $paginacaoTotal){ ?>
                    <div style="position: relative; display: inline; margin: 2px;">
                        <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=<?php echo $paginacaoNumero + 1 ?><?php echo $queryPadrao; ?>" class="Links03">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemPaginacaoProxima"); ?>
                        </a>
                    </div>
                <?php } ?>
                
                <div style="position: relative; display: inline; margin: 2px;">
                    <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=<?php echo $paginacaoTotal; ?><?php echo $queryPadrao; ?>" class="Links03">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemPaginacaoUltima"); ?>
                    </a>
                </div>
            </div>
            
            <?php //Contagem de páginas. ?>
            <div align="center" class="Texto01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPaginacaoPaginaContador01"); ?> 
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

    <form name="formCadastro" id="formCadastro" action="CadastroIndiceExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <table class="TabelaCampos01">
            <tr>
                <td class="TbFundoEscuro" colspan="4">
                    <div align="center" class="Texto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroTbCadastro"); ?>
                        </strong>
                    </div>
                </td>
            </tr>
            
            <?php if($GLOBALS['habilitarCadastroTipo'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroTipoCadastro"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left" class="Texto01">
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
                                <input name="idsCadastroTipo[]" type="checkbox" value="<?php echo $arrCadastroTipo[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrCadastroTipo[$countArray][1];?>
                            </div>
                        <?php 
						}
						?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroAtividades'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroAtividades"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left" class="Texto01">
                    	<?php 
							$arrCadastroAtividades = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 2);
						?>
                        <select id="idsCadastroAtividades[]" name="idsCadastroAtividades[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
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
    
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroNome"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro"<?php if($GLOBALS['habilitarCadastroNClassificacao'] <> 1){ ?> colspan="3"<?php } ?>>
                    <div align="left">
                        <input type="text" name="nome" id="nome" class="CampoTexto01" maxlength="255" />
                    </div>
                </td>
                <?php if($GLOBALS['habilitarCadastroNClassificacao'] == 1){ ?>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNClassificacao"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaColuna01"<?php if($GLOBALS['habilitarCadastroSexo'] <> 1){ ?> colspan="3"<?php } ?>>
                    <div>
                        <input type="text" name="n_classificacao" id="n_classificacao" class="CampoNumerico01" maxlength="10" value="0" />
                    </div>
                </td>
                <?php } ?>
            </tr>

            <?php if($GLOBALS['habilitarCadastroSexo'] == 1 || $GLOBALS['habilitarCadastroPfPj'] == 1){ ?>
            <tr>
                <?php if($GLOBALS['habilitarCadastroSexo'] == 1){ ?>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroSexo"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" <?php if($GLOBALS['habilitarCadastroPfPj'] <> 1){ ?> colspan="3" <?php } ?>>
                    <div align="left" class="Texto01">
                        <select name="sexo" id="sexo" class="CampoDropDownMenu01">
                            <option value="1" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroSexo1"); ?></option>
                            <option value="2"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroSexo2"); ?></option>
                        </select>
                    </div>
                </td>
                <?php } ?>

                <?php if($GLOBALS['habilitarCadastroPfPj'] == 1){ ?>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroPfPj"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaColuna01">
                    <div>
                        <select name="pf_pj" id="pf_pj" class="CampoDropDownMenu01">
                            <option value="1" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroPfPj1"); ?></option>
                            <option value="2"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroPfPj2"); ?></option>
                        </select>
                    </div>
                </td>
                <?php } ?>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico01'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico01Nome'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
						<?php 
                            $arrCadastroFiltroGenerico01 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 12);
                        ?>
                        
                        <?php if($GLOBALS['configCadastroFiltroGenerico01CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico01); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsCadastroFiltroGenerico01[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico01[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico01[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico01CaixaSelecao'] == 2){ ?>
                            <select id="idsCadastroFiltroGenerico01[]" name="idsCadastroFiltroGenerico01[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico01CaixaSelecao'] == 3){ ?>
                            <select id="idsCadastroFiltroGenerico01[]" name="idsCadastroFiltroGenerico01[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
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
                        	<a href="CadastroManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico02'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico02Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
						<?php 
                            $arrCadastroFiltroGenerico02 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 13);
                        ?>
                        
                        <?php if($GLOBALS['configCadastroFiltroGenerico02CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico02); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsCadastroFiltroGenerico02[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico02[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico02[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico02CaixaSelecao'] == 2){ ?>
                            <select id="idsCadastroFiltroGenerico02[]" name="idsCadastroFiltroGenerico02[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico02CaixaSelecao'] == 3){ ?>
                            <select id="idsCadastroFiltroGenerico02[]" name="idsCadastroFiltroGenerico02[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
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
                        	<a href="CadastroManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico03'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico03Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
						<?php 
                            $arrCadastroFiltroGenerico03 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 14);
                        ?>
                        
                        <?php if($GLOBALS['configCadastroFiltroGenerico03CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico03); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsCadastroFiltroGenerico03[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico03[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico03[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico03CaixaSelecao'] == 2){ ?>
                            <select id="idsCadastroFiltroGenerico03[]" name="idsCadastroFiltroGenerico03[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico03CaixaSelecao'] == 3){ ?>
                            <select id="idsCadastroFiltroGenerico03[]" name="idsCadastroFiltroGenerico03[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
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
                        	<a href="CadastroManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico04'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico04Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
						<?php 
                            $arrCadastroFiltroGenerico04 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 15);
                        ?>
                        
                        <?php if($GLOBALS['configCadastroFiltroGenerico04CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico04); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsCadastroFiltroGenerico04[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico04[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico04[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico04CaixaSelecao'] == 2){ ?>
                            <select id="idsCadastroFiltroGenerico04[]" name="idsCadastroFiltroGenerico04[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico04CaixaSelecao'] == 3){ ?>
                            <select id="idsCadastroFiltroGenerico04[]" name="idsCadastroFiltroGenerico04[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
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
                        	<a href="CadastroManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico05'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico05Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
						<?php 
                            $arrCadastroFiltroGenerico05 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 16);
                        ?>
                        
                        <?php if($GLOBALS['configCadastroFiltroGenerico05CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico05); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsCadastroFiltroGenerico05[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico05[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico05[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico05CaixaSelecao'] == 2){ ?>
                            <select id="idsCadastroFiltroGenerico05[]" name="idsCadastroFiltroGenerico05[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico05CaixaSelecao'] == 3){ ?>
                            <select id="idsCadastroFiltroGenerico05[]" name="idsCadastroFiltroGenerico05[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
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
                        	<a href="CadastroManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico06'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico06Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
						<?php 
                            $arrCadastroFiltroGenerico06 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 17);
                        ?>
                        
                        <?php if($GLOBALS['configCadastroFiltroGenerico06CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico06); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsCadastroFiltroGenerico06[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico06[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico06[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico06CaixaSelecao'] == 2){ ?>
                            <select id="idsCadastroFiltroGenerico06[]" name="idsCadastroFiltroGenerico06[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico06CaixaSelecao'] == 3){ ?>
                            <select id="idsCadastroFiltroGenerico06[]" name="idsCadastroFiltroGenerico06[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
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
                        	<a href="CadastroManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico07'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico07Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
						<?php 
                            $arrCadastroFiltroGenerico07 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 18);
                        ?>
                        
                        <?php if($GLOBALS['configCadastroFiltroGenerico07CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico07); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsCadastroFiltroGenerico07[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico07[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico07[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico07CaixaSelecao'] == 2){ ?>
                            <select id="idsCadastroFiltroGenerico07[]" name="idsCadastroFiltroGenerico07[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico07CaixaSelecao'] == 3){ ?>
                            <select id="idsCadastroFiltroGenerico07[]" name="idsCadastroFiltroGenerico07[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
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
                        	<a href="CadastroManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico08'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico08Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
						<?php 
                            $arrCadastroFiltroGenerico08 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 19);
                        ?>
                        
                        <?php if($GLOBALS['configCadastroFiltroGenerico08CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico08); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsCadastroFiltroGenerico08[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico08[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico08[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico08CaixaSelecao'] == 2){ ?>
                            <select id="idsCadastroFiltroGenerico08[]" name="idsCadastroFiltroGenerico08[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico08CaixaSelecao'] == 3){ ?>
                            <select id="idsCadastroFiltroGenerico08[]" name="idsCadastroFiltroGenerico08[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
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
                        	<a href="CadastroManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico09'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico09Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
						<?php 
                            $arrCadastroFiltroGenerico09 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 20);
                        ?>
                        
                        <?php if($GLOBALS['configCadastroFiltroGenerico09CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico09); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsCadastroFiltroGenerico09[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico09[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico09[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico09CaixaSelecao'] == 2){ ?>
                            <select id="idsCadastroFiltroGenerico09[]" name="idsCadastroFiltroGenerico09[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico09CaixaSelecao'] == 3){ ?>
                            <select id="idsCadastroFiltroGenerico09[]" name="idsCadastroFiltroGenerico09[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
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
                        	<a href="CadastroManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico10'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico10Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
						<?php 
                            $arrCadastroFiltroGenerico10 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 21);
                        ?>
                        
                        <?php if($GLOBALS['configCadastroFiltroGenerico10CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico10); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsCadastroFiltroGenerico10[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico10[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico10[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico10CaixaSelecao'] == 2){ ?>
                            <select id="idsCadastroFiltroGenerico10[]" name="idsCadastroFiltroGenerico10[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico10CaixaSelecao'] == 3){ ?>
                            <select id="idsCadastroFiltroGenerico10[]" name="idsCadastroFiltroGenerico10[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
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
                        	<a href="CadastroManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico11'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico11Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
						<?php 
                            $arrCadastroFiltroGenerico11 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 60);
                        ?>
                        
                        <?php if($GLOBALS['configCadastroFiltroGenerico11CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico11); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsCadastroFiltroGenerico11[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico11[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico11[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico11CaixaSelecao'] == 2){ ?>
                            <select id="idsCadastroFiltroGenerico11[]" name="idsCadastroFiltroGenerico11[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico11); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico11[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico11[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico11CaixaSelecao'] == 3){ ?>
                            <select id="idsCadastroFiltroGenerico11[]" name="idsCadastroFiltroGenerico11[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico11); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico11[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico11[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrCadastroFiltroGenerico11)){ ?>
                        	<a href="CadastroManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico12'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico12Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
						<?php 
                            $arrCadastroFiltroGenerico12 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 61);
                        ?>
                        
                        <?php if($GLOBALS['configCadastroFiltroGenerico12CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico12); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsCadastroFiltroGenerico12[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico12[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico12[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico12CaixaSelecao'] == 2){ ?>
                            <select id="idsCadastroFiltroGenerico12[]" name="idsCadastroFiltroGenerico12[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico12); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico12[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico12[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico12CaixaSelecao'] == 3){ ?>
                            <select id="idsCadastroFiltroGenerico12[]" name="idsCadastroFiltroGenerico12[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico12); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico12[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico12[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrCadastroFiltroGenerico12)){ ?>
                        	<a href="CadastroManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico13'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico13Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
						<?php 
                            $arrCadastroFiltroGenerico13 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 62);
                        ?>
                        
                        <?php if($GLOBALS['configCadastroFiltroGenerico13CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico13); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsCadastroFiltroGenerico13[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico13[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico13[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico13CaixaSelecao'] == 2){ ?>
                            <select id="idsCadastroFiltroGenerico13[]" name="idsCadastroFiltroGenerico13[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico13); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico13[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico13[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico13CaixaSelecao'] == 3){ ?>
                            <select id="idsCadastroFiltroGenerico13[]" name="idsCadastroFiltroGenerico13[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico13); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico13[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico13[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrCadastroFiltroGenerico13)){ ?>
                        	<a href="CadastroManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico14'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico14Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>

                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
						<?php 
                            $arrCadastroFiltroGenerico14 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 63);
                        ?>
                        
                        <?php if($GLOBALS['configCadastroFiltroGenerico14CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico14); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsCadastroFiltroGenerico14[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico14[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico14[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico14CaixaSelecao'] == 2){ ?>
                            <select id="idsCadastroFiltroGenerico14[]" name="idsCadastroFiltroGenerico14[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico14); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico14[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico14[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico14CaixaSelecao'] == 3){ ?>
                            <select id="idsCadastroFiltroGenerico14[]" name="idsCadastroFiltroGenerico14[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico14); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico14[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico14[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrCadastroFiltroGenerico14)){ ?>
                        	<a href="CadastroManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico15'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico15Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
						<?php 
                            $arrCadastroFiltroGenerico15 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 64);
                        ?>
                        
                        <?php if($GLOBALS['configCadastroFiltroGenerico15CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico15); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsCadastroFiltroGenerico15[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico15[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico15[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico15CaixaSelecao'] == 2){ ?>
                            <select id="idsCadastroFiltroGenerico15[]" name="idsCadastroFiltroGenerico15[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico15); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico15[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico15[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico15CaixaSelecao'] == 3){ ?>
                            <select id="idsCadastroFiltroGenerico15[]" name="idsCadastroFiltroGenerico15[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico15); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico15[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico15[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrCadastroFiltroGenerico15)){ ?>
                        	<a href="CadastroManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico16'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico16Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
						<?php 
                            $arrCadastroFiltroGenerico16 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 65);
                        ?>

                        
                        <?php if($GLOBALS['configCadastroFiltroGenerico16CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico16); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsCadastroFiltroGenerico16[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico16[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico16[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico16CaixaSelecao'] == 2){ ?>
                            <select id="idsCadastroFiltroGenerico16[]" name="idsCadastroFiltroGenerico16[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico16); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico16[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico16[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico16CaixaSelecao'] == 3){ ?>
                            <select id="idsCadastroFiltroGenerico16[]" name="idsCadastroFiltroGenerico16[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico16); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico16[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico16[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrCadastroFiltroGenerico16)){ ?>
                        	<a href="CadastroManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico17'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico17Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
						<?php 
                            $arrCadastroFiltroGenerico17 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 66);
                        ?>
                        
                        <?php if($GLOBALS['configCadastroFiltroGenerico17CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico17); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsCadastroFiltroGenerico17[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico17[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico17[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico17CaixaSelecao'] == 2){ ?>
                            <select id="idsCadastroFiltroGenerico17[]" name="idsCadastroFiltroGenerico17[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico17); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico17[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico17[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico17CaixaSelecao'] == 3){ ?>
                            <select id="idsCadastroFiltroGenerico17[]" name="idsCadastroFiltroGenerico17[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico17); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico17[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico17[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrCadastroFiltroGenerico17)){ ?>
                        	<a href="CadastroManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico18'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico18Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
						<?php 
                            $arrCadastroFiltroGenerico18 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 67);
                        ?>
                        
                        <?php if($GLOBALS['configCadastroFiltroGenerico18CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico18); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsCadastroFiltroGenerico18[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico18[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico18[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico18CaixaSelecao'] == 2){ ?>
                            <select id="idsCadastroFiltroGenerico18[]" name="idsCadastroFiltroGenerico18[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico18); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico18[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico18[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico18CaixaSelecao'] == 3){ ?>
                            <select id="idsCadastroFiltroGenerico18[]" name="idsCadastroFiltroGenerico18[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico18); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico18[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico18[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrCadastroFiltroGenerico18)){ ?>
                        	<a href="CadastroManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico19'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico19Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
						<?php 
                            $arrCadastroFiltroGenerico19 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 68);
                        ?>
                        
                        <?php if($GLOBALS['configCadastroFiltroGenerico19CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico19); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsCadastroFiltroGenerico19[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico19[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico19[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico19CaixaSelecao'] == 2){ ?>
                            <select id="idsCadastroFiltroGenerico19[]" name="idsCadastroFiltroGenerico19[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico19); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico19[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico19[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico19CaixaSelecao'] == 3){ ?>
                            <select id="idsCadastroFiltroGenerico19[]" name="idsCadastroFiltroGenerico19[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico19); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico19[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico19[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrCadastroFiltroGenerico19)){ ?>
                        	<a href="CadastroManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico20'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico20Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
						<?php 
                            $arrCadastroFiltroGenerico20 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 69);
                        ?>
                        
                        <?php if($GLOBALS['configCadastroFiltroGenerico20CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico20); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsCadastroFiltroGenerico20[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico20[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico20[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico20CaixaSelecao'] == 2){ ?>
                            <select id="idsCadastroFiltroGenerico20[]" name="idsCadastroFiltroGenerico20[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico20); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico20[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico20[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico20CaixaSelecao'] == 3){ ?>
                            <select id="idsCadastroFiltroGenerico20[]" name="idsCadastroFiltroGenerico20[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico20); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico20[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico20[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrCadastroFiltroGenerico20)){ ?>
                        	<a href="CadastroManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico21'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico21Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
						<?php 
                            $arrCadastroFiltroGenerico21 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 70);
                        ?>
                        
                        <?php if($GLOBALS['configCadastroFiltroGenerico21CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico21); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsCadastroFiltroGenerico21[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico21[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico21[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico21CaixaSelecao'] == 2){ ?>
                            <select id="idsCadastroFiltroGenerico21[]" name="idsCadastroFiltroGenerico21[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico21); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico21[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico21[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico21CaixaSelecao'] == 3){ ?>
                            <select id="idsCadastroFiltroGenerico21[]" name="idsCadastroFiltroGenerico21[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico21); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico21[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico21[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrCadastroFiltroGenerico21)){ ?>
                        	<a href="CadastroManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico22'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico22Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
						<?php 
                            $arrCadastroFiltroGenerico22 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 71);
                        ?>
                        
                        <?php if($GLOBALS['configCadastroFiltroGenerico22CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico22); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsCadastroFiltroGenerico22[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico22[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico22[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico22CaixaSelecao'] == 2){ ?>
                            <select id="idsCadastroFiltroGenerico22[]" name="idsCadastroFiltroGenerico22[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico22); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico22[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico22[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico22CaixaSelecao'] == 3){ ?>
                            <select id="idsCadastroFiltroGenerico22[]" name="idsCadastroFiltroGenerico22[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico22); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico22[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico22[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrCadastroFiltroGenerico22)){ ?>
                        	<a href="CadastroManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico23'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico23Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
						<?php 
                            $arrCadastroFiltroGenerico23 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 72);
                        ?>
                        
                        <?php if($GLOBALS['configCadastroFiltroGenerico23CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico23); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsCadastroFiltroGenerico23[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico23[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico23[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico23CaixaSelecao'] == 2){ ?>
                            <select id="idsCadastroFiltroGenerico23[]" name="idsCadastroFiltroGenerico23[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico23); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico23[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico23[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico23CaixaSelecao'] == 3){ ?>
                            <select id="idsCadastroFiltroGenerico23[]" name="idsCadastroFiltroGenerico23[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico23); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico23[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico23[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrCadastroFiltroGenerico23)){ ?>
                        	<a href="CadastroManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico24'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico24Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>


                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
						<?php 
                            $arrCadastroFiltroGenerico24 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 73);
                        ?>
                        
                        <?php if($GLOBALS['configCadastroFiltroGenerico24CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico24); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsCadastroFiltroGenerico24[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico24[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico24[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico24CaixaSelecao'] == 2){ ?>
                            <select id="idsCadastroFiltroGenerico24[]" name="idsCadastroFiltroGenerico24[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico24); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico24[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico24[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico24CaixaSelecao'] == 3){ ?>
                            <select id="idsCadastroFiltroGenerico24[]" name="idsCadastroFiltroGenerico24[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico24); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico24[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico24[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrCadastroFiltroGenerico24)){ ?>
                        	<a href="CadastroManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico25'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico25Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
						<?php 
                            $arrCadastroFiltroGenerico25 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 74);
                        ?>
                        
                        <?php if($GLOBALS['configCadastroFiltroGenerico25CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico25); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsCadastroFiltroGenerico25[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico25[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico25[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico25CaixaSelecao'] == 2){ ?>
                            <select id="idsCadastroFiltroGenerico25[]" name="idsCadastroFiltroGenerico25[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico25); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico25[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico25[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico25CaixaSelecao'] == 3){ ?>
                            <select id="idsCadastroFiltroGenerico25[]" name="idsCadastroFiltroGenerico25[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico25); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico25[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico25[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrCadastroFiltroGenerico25)){ ?>
                        	<a href="CadastroManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico26'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico26Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
						<?php 
                            $arrCadastroFiltroGenerico26 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 75);
                        ?>

                        
                        <?php if($GLOBALS['configCadastroFiltroGenerico26CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico26); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsCadastroFiltroGenerico26[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico26[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico26[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico26CaixaSelecao'] == 2){ ?>
                            <select id="idsCadastroFiltroGenerico26[]" name="idsCadastroFiltroGenerico26[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico26); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico26[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico26[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico26CaixaSelecao'] == 3){ ?>
                            <select id="idsCadastroFiltroGenerico26[]" name="idsCadastroFiltroGenerico26[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico26); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico26[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico26[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrCadastroFiltroGenerico26)){ ?>
                        	<a href="CadastroManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico27'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico27Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
						<?php 
                            $arrCadastroFiltroGenerico27 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 76);
                        ?>
                        
                        <?php if($GLOBALS['configCadastroFiltroGenerico27CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico27); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsCadastroFiltroGenerico27[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico27[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico27[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico27CaixaSelecao'] == 2){ ?>
                            <select id="idsCadastroFiltroGenerico27[]" name="idsCadastroFiltroGenerico27[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico27); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico27[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico27[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico27CaixaSelecao'] == 3){ ?>
                            <select id="idsCadastroFiltroGenerico27[]" name="idsCadastroFiltroGenerico27[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico27); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico27[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico27[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrCadastroFiltroGenerico27)){ ?>
                        	<a href="CadastroManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico28'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico28Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
						<?php 
                            $arrCadastroFiltroGenerico28 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 77);
                        ?>
                        
                        <?php if($GLOBALS['configCadastroFiltroGenerico28CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico28); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsCadastroFiltroGenerico28[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico28[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico28[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico28CaixaSelecao'] == 2){ ?>
                            <select id="idsCadastroFiltroGenerico28[]" name="idsCadastroFiltroGenerico28[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico28); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico28[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico28[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico28CaixaSelecao'] == 3){ ?>
                            <select id="idsCadastroFiltroGenerico28[]" name="idsCadastroFiltroGenerico28[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico28); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico28[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico28[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrCadastroFiltroGenerico28)){ ?>
                        	<a href="CadastroManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico29'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico29Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
						<?php 
                            $arrCadastroFiltroGenerico29 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 78);
                        ?>
                        
                        <?php if($GLOBALS['configCadastroFiltroGenerico29CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico29); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsCadastroFiltroGenerico29[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico29[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico29[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico29CaixaSelecao'] == 2){ ?>
                            <select id="idsCadastroFiltroGenerico29[]" name="idsCadastroFiltroGenerico29[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico29); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico29[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico29[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico29CaixaSelecao'] == 3){ ?>
                            <select id="idsCadastroFiltroGenerico29[]" name="idsCadastroFiltroGenerico29[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico29); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico29[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico29[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrCadastroFiltroGenerico29)){ ?>
                        	<a href="CadastroManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico30'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico30Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
						<?php 
                            $arrCadastroFiltroGenerico30 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 79);
                        ?>
                        
                        <?php if($GLOBALS['configCadastroFiltroGenerico30CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico30); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsCadastroFiltroGenerico30[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico30[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico30[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico30CaixaSelecao'] == 2){ ?>
                            <select id="idsCadastroFiltroGenerico30[]" name="idsCadastroFiltroGenerico30[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico30); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico30[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico30[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico30CaixaSelecao'] == 3){ ?>
                            <select id="idsCadastroFiltroGenerico30[]" name="idsCadastroFiltroGenerico30[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico30); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico30[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico30[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrCadastroFiltroGenerico30)){ ?>
                        	<a href="CadastroManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroAlturaPeso'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroAltura"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro">
                    <div align="left" class="Texto01">
                        <input type="text" name="altura" id="altura" class="CampoNumerico01" maxlength="10" value="0" />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroAlturaMedida"); ?>
                    </div>
                </td>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroPeso"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaColuna01">
                    <div align="left" class="Texto01">
                        <input type="text" name="peso" id="peso" class="CampoNumerico01" maxlength="10" value="0" />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroPesoMedida"); ?>
                     </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroRazaoSocial'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroRazaoSocial"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left">
                        <input type="text" name="razao_social" id="razao_social" class="CampoTexto01" maxlength="255" />
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroNomeFantasia'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroNomeFantasia"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left">
                        <input type="text" name="nome_fantasia" id="nome_fantasia" class="CampoTexto01" maxlength="255" />
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroDataNascimento'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroDataNascimento"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
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
                        
                            <input type="text" name="data_nascimento" id="data_nascimento" class="CampoData01" maxlength="10" />
                            <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                        <?php } ?>
                    	<?php //---------------------- ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroData1'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData1'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left">
						<?php //JQuery DatePicker. ?>
						<?php //---------------------- ?>
                    	<?php if($GLOBALS['configTipoCampoCadastroData1'] == 1){ ?>
                            <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 1){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaPtCampos = "#data1";
                                        strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data1;";
                                    </script>
                                <?php } ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 2){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaEnCampos = "#data1";
                                        strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data1;";
                                    </script>
                                <?php } ?>
                                <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                            
                                <input type="text" name="data1" id="data1" class="CampoData01" maxlength="10" />
                                <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                            <?php } ?>
                        <?php } ?>
						<?php //---------------------- ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroData2'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData2'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left">
						<?php //JQuery DatePicker. ?>
						<?php //---------------------- ?>
                    	<?php if($GLOBALS['configTipoCampoCadastroData2'] == 1){ ?>
                            <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 1){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaPtCampos = "#data1";
                                        strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data2;";
                                    </script>
                                <?php } ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 2){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaEnCampos = "#data1";
                                        strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data2;";
                                    </script>
                                <?php } ?>
                                <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                            
                                <input type="text" name="data2" id="data2" class="CampoData01" maxlength="10" />
                                <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                            <?php } ?>
                        <?php } ?>
						<?php //---------------------- ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroData3'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData3'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left">
						<?php //JQuery DatePicker. ?>
						<?php //---------------------- ?>
                    	<?php if($GLOBALS['configTipoCampoCadastroData3'] == 1){ ?>
                            <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 1){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaPtCampos = "#data1";
                                        strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data3;";
                                    </script>
                                <?php } ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 2){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaEnCampos = "#data1";
                                        strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data3;";
                                    </script>
                                <?php } ?>
                                <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                            
                                <input type="text" name="data3" id="data3" class="CampoData01" maxlength="10" />
                                <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                            <?php } ?>
                        <?php } ?>
						<?php //---------------------- ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroData4'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData4'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left">
						<?php //JQuery DatePicker. ?>
						<?php //---------------------- ?>
                    	<?php if($GLOBALS['configTipoCampoCadastroData4'] == 1){ ?>
                            <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 1){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaPtCampos = "#data1";
                                        strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data4;";
                                    </script>
                                <?php } ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 2){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaEnCampos = "#data1";
                                        strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data4;";
                                    </script>
                                <?php } ?>
                                <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                            
                                <input type="text" name="data4" id="data4" class="CampoData01" maxlength="10" />
                                <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                            <?php } ?>
                        <?php } ?>
						<?php //---------------------- ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroData5'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData5'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left">
						<?php //JQuery DatePicker. ?>
						<?php //---------------------- ?>
                    	<?php if($GLOBALS['configTipoCampoCadastroData5'] == 1){ ?>
                            <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 1){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaPtCampos = "#data1";
                                        strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data5;";
                                    </script>
                                <?php } ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 2){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaEnCampos = "#data1";
                                        strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data5;";
                                    </script>
                                <?php } ?>
                                <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                            
                                <input type="text" name="data5" id="data5" class="CampoData01" maxlength="10" />
                                <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                            <?php } ?>
                        <?php } ?>
						<?php //---------------------- ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroData6'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData6'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left">
						<?php //JQuery DatePicker. ?>
						<?php //---------------------- ?>
                    	<?php if($GLOBALS['configTipoCampoCadastroData6'] == 1){ ?>
                            <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 1){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaPtCampos = "#data1";
                                        strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data6;";
                                    </script>
                                <?php } ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 2){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaEnCampos = "#data1";
                                        strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data6;";
                                    </script>
                                <?php } ?>
                                <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                            
                                <input type="text" name="data6" id="data6" class="CampoData01" maxlength="10" />
                                <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                            <?php } ?>
                        <?php } ?>
						<?php //---------------------- ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroData7'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData7'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left">
						<?php //JQuery DatePicker. ?>
						<?php //---------------------- ?>
                    	<?php if($GLOBALS['configTipoCampoCadastroData7'] == 1){ ?>
                            <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 1){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaPtCampos = "#data1";
                                        strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data7;";
                                    </script>
                                <?php } ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 2){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaEnCampos = "#data1";
                                        strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data7;";
                                    </script>
                                <?php } ?>
                                <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                            
                                <input type="text" name="data7" id="data7" class="CampoData01" maxlength="10" />
                                <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                            <?php } ?>
                        <?php } ?>
						<?php //---------------------- ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroData8'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData8'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left">
						<?php //JQuery DatePicker. ?>
						<?php //---------------------- ?>
                    	<?php if($GLOBALS['configTipoCampoCadastroData8'] == 1){ ?>
                            <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 1){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaPtCampos = "#data1";
                                        strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data8;";
                                    </script>
                                <?php } ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 2){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaEnCampos = "#data1";
                                        strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data8;";
                                    </script>
                                <?php } ?>
                                <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                            
                                <input type="text" name="data8" id="data8" class="CampoData01" maxlength="10" />
                                <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                            <?php } ?>
                        <?php } ?>
						<?php //---------------------- ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroData9'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData9'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left">
						<?php //JQuery DatePicker. ?>
						<?php //---------------------- ?>
                    	<?php if($GLOBALS['configTipoCampoCadastroData9'] == 1){ ?>
                            <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 1){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaPtCampos = "#data1";
                                        strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data9;";
                                    </script>
                                <?php } ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 2){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaEnCampos = "#data1";
                                        strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data9;";
                                    </script>
                                <?php } ?>
                                <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                            
                                <input type="text" name="data9" id="data9" class="CampoData01" maxlength="10" />
                                <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                            <?php } ?>
                        <?php } ?>
						<?php //---------------------- ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroData10'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData10'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left">
						<?php //JQuery DatePicker. ?>
						<?php //---------------------- ?>
                    	<?php if($GLOBALS['configTipoCampoCadastroData10'] == 1){ ?>
                            <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 1){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaPtCampos = "#data1";
                                        strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data10;";
                                    </script>
                                <?php } ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 2){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaEnCampos = "#data1";
                                        strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data10;";
                                    </script>
                                <?php } ?>
                                <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                            
                                <input type="text" name="data10" id="data10" class="CampoData01" maxlength="10" />
                                <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                            <?php } ?>
                        <?php } ?>
						<?php //---------------------- ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroCPFRG'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroCPF"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro">
                    <div align="left">
                        <?php //alertas ?>
                        <?php //echo "somenteNum=" . Funcoes::SomenteNum("111.524.025-52") . "<br />";  ?>
                        <?php //echo "somenteNum=" . Funcoes::FormatarCPFLer("11152402552") . "<br />";  ?>

                        <input type="text" name="cpf_" id="cpf_" class="CampoTexto01" maxlength="255"<?php if($GLOBALS['configCadastroCPFMascara'] == "1") { ?> onkeypress="javascript:mascaraGenerica('###.###.###-##', this, 'formCadastro', 'cpf_');"<?php } ?>/>
                        <span id="lblCPFValidacaoAlerta" class="TextoAlerta" style="display: none;">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroCPFInvalido"); ?>
                        </span>
                        <span id="lblCPFExistenteAlerta" class="TextoAlerta" style="display: none;">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroCPFExistente"); ?>
                        </span>


                        <?php //JQuery - Ajax - CPF Duplicado.?>
                        <?php //----------------------?>
                        <?php if($GLOBALS['configCadastroCPFVerificacaoDuplicado'] == 1){ ?>
							<script type="text/javascript">
                                $("#cpf_").keyup(function() {
                                    //Variáveis.
                                    var cpfCampo = $(this);
                                    var cpfConsulta = cpfCampo.val().replace(/\D/g,'');
                                    var cpfExistenteRetorno = "";
                                    
                                    var divProgressBar = "updtProgressGenerico";
                                    var btnSubmit = "btnCadastroIncluir";
                                    var lblAlerta = "lblCPFExistenteAlerta";
                                    
                                    
                                    //Condição para executar somente depois de todos os caractéres do CPF preenchidos.
                                    if(cpfConsulta.length == 11)
                                    {
                                        //Acionamento da poleta.
                                        divShow(divProgressBar);
                                        
                                        
                                        //Ajax - comando.
                                        //http://tinton.com.br.solidcp.temp-address.com/api/ApiCEP.php
                                        //contentType: 'application/json',
                                        //http://api.zippopotam.us/us/90210
                                        //html jsonp json
                                        //success: function(result, success) 
                                        //error: function(result, success) 
                                        //cache: false,
                                        //async: true,
                                        //data: "cepConsulta=" + "02068030",
                                        /**/
                                        $.ajax({
                                            url: "<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiCadastro.php",
                                            dataType: "html",
                                            type: "GET",
                                            data: "cpfConsulta=" + cpfConsulta,
                                            success: function(retornoDadosURL, success) 
                                            {
                                                //Ocultação da poleta.
                                                divHide(divProgressBar);
                                                
                                                //Definição de valores.
                                                cpfExistenteRetorno = retornoDadosURL; //0 - não exitente | 1 - existente
                                                //alert("cpfExistenteRetorno=" + cpfExistenteRetorno);
                                                
                                                //Preenchimento de dados.
                                                if(cpfExistenteRetorno == "0")
                                                {
                                                    //Mostrar aviso.
                                                    divHide(lblAlerta);
                                                    
                                                    //Habilitar botão.
                                                    document.getElementById(btnSubmit).disabled = false;
                                                }
                                                if(cpfExistenteRetorno == "1")
                                                {
                                                    //Mostrar aviso.
                                                    divShow(lblAlerta);
                                                    
                                                    //Desabilitar botão.
                                                    document.getElementById(btnSubmit).disabled = true; 
                                                }
                                            },
                                            error: function(retornoDadosURL, success) 
                                            {
                                                //$(".zip-error").show(); // Ruh row
                                                //elementoMensagem01('testeAlvo01', "erro");
                                                divShow(lblAlerta);
                                            }	
                                        });	
                                            
                                                                    
                                        //Degug.
                                        //elementoMensagem01('testeAlvo01', cepNumero);
                                    }
                                    
                                    
                                    //Condição para reabilitar se as informações estiverem sido excluídas.
                                    if(cpfConsulta.length == 0)
                                    {
                                        //Mostrar aviso.
                                        divHide(lblAlerta);
                                        
                                        //Habilitar botão.
                                        document.getElementById(btnSubmit).disabled = false;
                                    }
                                });						
                            </script>
                        <?php } ?>
                        <?php //----------------------?>
                    </div>
                </td>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroRG"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaColuna01">
                    <div align="left" class="Texto01">
                        <input type="text" name="rg_" id="rg_" class="CampoTexto01" maxlength="255" />
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroCNPJ'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroCNPJ"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left">
                        <?php //alertas ?>
                        <?php //echo "FormatarCNPJLer=" . Funcoes::FormatarCNPJLer("11152402552111") . "<br />";  ?>
                        
                        <input type="text" name="cnpj_" id="cnpj_" class="CampoTexto01" maxlength="255"<?php if($GLOBALS['configCadastroCNPJMascara'] == "1") { ?> onkeypress="javascript:mascaraGenerica('##.###.###/####-##', this, 'formCadastro', 'cnpj_');"<?php } ?> />
                        <span id="lblCNPJValidacaoAlerta" class="TextoAlerta" style="display: none;">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroCNPJInvalido"); ?>
                        </span>
                        <span id="lblCNPJExistenteAlerta" class="TextoAlerta" style="display: none;">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroCNPJExistente"); ?>
                        </span>
                        
                        
                        <?php //JQuery - Ajax - CPF Duplicado.?>
                        <?php //----------------------?>
                        <?php if($GLOBALS['configCadastroCNPJVerificacaoDuplicado'] == 1){ ?>
							<script type="text/javascript">
                                $("#cnpj_").keyup(function() {
                                    var cnpjCampo = $(this);
                                    var cnpjConsulta = cnpjCampo.val().replace(/\D/g,'');
                                    var cnpjExistenteRetorno = "";
                                    
                                    var divProgressBar = "updtProgressGenerico";
                                    var btnSubmit = "btnCadastroIncluir";
                                    var lblAlerta = "lblCNPJExistenteAlerta";
                                    
                                    
                                    //Condição para executar somente depois de todos os caractéres do CPF preenchidos.
                                    if(cnpjConsulta.length == 14)
                                    {
                                        //Acionamento da poleta.
                                        divShow(divProgressBar);
                                        
                                        
                                        //Ajax - comando.
                                        //http://tinton.com.br.solidcp.temp-address.com/api/ApiCEP.php
                                        //contentType: 'application/json',
                                        //http://api.zippopotam.us/us/90210
                                        //html jsonp json
                                        //success: function(result, success) 
                                        //error: function(result, success) 
                                        //cache: false,
                                        //async: true,
                                        //data: "cepConsulta=" + "02068030",
                                        /**/
                                        $.ajax({
                                            url: "<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiCadastro.php",
                                            dataType: "html",
                                            type: "GET",
                                            data: "cnpjConsulta=" + cnpjConsulta,
                                            success: function(retornoDadosURL, success) 
                                            {
                                                //Ocultação da poleta.
                                                divHide(divProgressBar);
                                                
                                                //Definição de valores.
                                                cnpjExistenteRetorno = retornoDadosURL; //0 - não exitente | 1 - existente
                                                //alert("cpfExistenteRetorno=" + cpfExistenteRetorno);
                                                
                                                //Preenchimento de dados.
                                                if(cnpjExistenteRetorno == "0")
                                                {
                                                    //Mostrar aviso.
                                                    divHide(lblAlerta);
                                                    
                                                    //Habilitar botão.
                                                    document.getElementById(btnSubmit).disabled = false;
                                                }
                                                if(cnpjExistenteRetorno == "1")
                                                {
                                                    //Mostrar aviso.
                                                    divShow(lblAlerta);
                                                    
                                                    //Desabilitar botão.
                                                    document.getElementById(btnSubmit).disabled = true; 
                                                }
                                            },
                                            error: function(retornoDadosURL, success) 
                                            {
                                                //$(".zip-error").show(); // Ruh row
                                                //elementoMensagem01('testeAlvo01', "erro");
                                                divShow(lblAlerta);
                                            }	
                                        });	
                                            
                                                                    
                                        //Degug.
                                        //elementoMensagem01('testeAlvo01', cepNumero);
                                    }
                                    
                                    
                                    //Condição para reabilitar se as informações estiverem sido excluídas.
                                    if(cnpjConsulta.length == 0)
                                    {
                                        //Mostrar aviso.
                                        divHide(lblAlerta);
                                        
                                        //Habilitar botão.
                                        document.getElementById(btnSubmit).disabled = false;
                                    }
                                });						
                            </script>
                        <?php } ?>
                        <?php //----------------------?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroDocumento'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroDocumento"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left">
                        <input type="text" name="documento" id="documento" class="CampoTexto01" maxlength="255" />
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroIEstadualIMunicipal'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroInscricaoMunicipal"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro">
                    <div align="left">
                        <input type="text" name="i_municipal" id="i_municipal" class="CampoTexto01" maxlength="255" />
                    </div>
                </td>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroInscricaoEstadual"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaColuna01">
                    <div align="left" class="Texto01">
                        <input type="text" name="i_estadual" id="i_estadual" class="CampoTexto01" maxlength="255" />
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php //Endereço. ?>
            <?php //---------------------- ?>
            <?php if($GLOBALS['configCadastroIncluirLocalizacao'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroCEPPrincipal"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left">
                        <input type="text" name="cep_principal" id="cep_principal" class="CampoTexto02" maxlength="255"<?php if($GLOBALS['configCadastroCEPMascara'] == "1") { ?> onkeypress="javascript:mascaraGenerica('##.###-###', this, 'formCadastro', 'cep_principal');"<?php } ?> />
                        <span id="lblCEPAlerta" class="TextoAlerta" style="display: none;">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCEPNaoEncontrado"); ?>
                        </span>
						
						<?php //alertas ?>
                        <?php //echo "FormatarCEPLer=" . Funcoes::FormatarCEPLer("22631455") . "<br />";  ?>
                        
                        
                        <?php //JQuery - Ajax - CEP.?>
                        <?php //----------------------?>
                        <?php if($GLOBALS['configCadastroCEPPreenchimento'] == 1){ ?>
                        <script type="text/javascript">
							$("#cep_principal").keyup(function() {
								var cepCampo = $(this);
								var cepNumero = cepCampo.val().replace(/\D/g,'');
								//alert( "Handler for .keyup() called." );
								
								
								//Condição para executar somente depois de todos os caractéres do CEP preenchidos.
								if(cepNumero.length == 8)
								{
									//Acionamento da poleta.
									divShow('updtProgressGenerico');
									
									
									//Consulta.
									/*
									var xhrAPI = new XMLHttpRequest();
									xhrAPI.open("GET", "http://tinton.com.br.solidcp.temp-address.com/api/ApiCEP.php", true);
									xhrAPI.onreadystatechange = function() {
										if(xhrAPI.readyState == 4) {
											//alert(client.responseText);
											$("#testeAlvo01").val(xhrAPI.responseText);//teste
										};
									};
									xhrAPI.send();
									*/
									
									
									//Debug.
									/*
									var client = new XMLHttpRequest();
									client.open("GET", "http://api.zippopotam.us/us/90210", true);
									client.onreadystatechange = function() {
										if(client.readyState == 4) {
											//alert(client.responseText);
											$("#testeAlvo01").val(client.responseText);//teste
										};
									};
									client.send();
									*/
									
											
									//Ajax - comando.
									//http://tinton.com.br.solidcp.temp-address.com/api/ApiCEP.php
									//contentType: 'application/json',
									//http://api.zippopotam.us/us/90210
									//html jsonp json
									//success: function(result, success) 
									//error: function(result, success) 
									//cache: false,
									//async: true,
									//data: "cepConsulta=" + "02068030",
									/**/
									$.ajax({
										/*funcionando.
										xhr: function () {
											var xhr = new window.XMLHttpRequest();
											xhr.upload.addEventListener("progress", function (evt) {
												if (evt.lengthComputable) {
													var percentComplete = evt.loaded / evt.total;
													console.log(percentComplete);
													$('.progress').css({
														width: percentComplete * 100 + '%'
													});
													if (percentComplete === 1) {
														$('.progress').addClass('hide');
													}
												}
											}, false);
											xhr.addEventListener("progress", function (evt) {
												if (evt.lengthComputable) {
													var percentComplete = evt.loaded / evt.total;
													console.log(percentComplete);
													$('.progress').css({
														width: percentComplete * 100 + '%'
													});
												}
											}, false);
											return xhr;
										},
										*/
										url: "<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiCEP.php",
										dataType: "html",
										type: "GET",
										data: "cepConsulta=" + cepNumero + "&tipoPesquisa=<?php echo $GLOBALS['configCadastroCEPPreenchimento'];?>",
										success: function(retornoDadosURL, success) 
										{
											//Ocultação da poleta.
											divHide('updtProgressGenerico');
											
											//Conversão de dados em json.
											var jsonRetornoDadosURL = jQuery.parseJSON(retornoDadosURL);
											
											//Variáveis.
											var retornoLogradouro = jsonRetornoDadosURL.logradouro;
											var retornoLogradouroCodigo = jsonRetornoDadosURL.logradouroCodigo;
											var retornoBairro = jsonRetornoDadosURL.bairro;
											var retornoBairroCodigo = jsonRetornoDadosURL.bairroCodigo;
											var retornoCidade = jsonRetornoDadosURL.cidade;
											var retornoCidadeCodigo = jsonRetornoDadosURL.cidadeCodigo;
											var retornoEstado = jsonRetornoDadosURL.uf;
											var retornoEstadoCodigo = jsonRetornoDadosURL.ufCodigo;
											var retornoPais = jsonRetornoDadosURL.pais;
											var retornoPaisCodigo = jsonRetornoDadosURL.paisCodigo;
											
											
											//Preenchimento de dados.
											if(retornoLogradouro)
											{
												divHide('lblCEPAlerta');
												$("#endereco_principal").val(retornoLogradouro);
												$("#bairro_principal").val(retornoBairro);
												$("#cidade_principal").val(retornoCidade);
												//$("#testeAlvo04").val(retornoEstado);
												$("#estado_principal").val(retornoEstadoCodigo);
												$("#pais_principal").val(retornoPais);
												
												$("#id_db_cep_tblBairros").val(retornoBairroCodigo);
												$("#id_db_cep_tblCidades").val(retornoCidadeCodigo);
												$("#id_db_cep_tblLogradouros").val(retornoLogradouroCodigo);
												$("#id_db_cep_tblUF").val(retornoEstadoCodigo);
												
											}else{
												divShow('lblCEPAlerta');
												
												$("#endereco_principal").val("");
												$("#bairro_principal").val("");
												$("#cidade_principal").val("");
												//$("#testeAlvo04").val(retornoEstado);
												$("#estado_principal").val("");
												$("#pais_principal").val("");
												
												$("#id_db_cep_tblBairros").val("0");
												$("#id_db_cep_tblCidades").val("0");
												$("#id_db_cep_tblLogradouros").val("0");
												$("#id_db_cep_tblUF").val("");
											}
											
											
											//$("#testeAlvo01").val(result.logradouro);
											//$("#testeAlvo01").val(retornoDadosURL);
											
											//elementoMensagem01('testeAlvo01', "teste");
											
											/*
											$(".fancy-form div > div").slideDown(); // Show the fields 
											$("#city").val(result.city); // Fill the data 
											$("#state").val(result.state);
											$(".zip-error").hide(); // In case they failed once before 
											$("#address-line-1").focus(); // Put cursor where they need it 
											*/
										},
										error: function(retornoDadosURL, success) 
										{
											//$(".zip-error").show(); // Ruh row
											//elementoMensagem01('testeAlvo01', "erro");
											divShow('lblCEPAlerta');
										}	
									});	
										
																
									//Degug.
									//elementoMensagem01('testeAlvo01', cepNumero);
								}
							});						
						
                        </script>
                        <?php } ?>
                        <?php //----------------------?>
                    </div>
                </td>
            </tr>
            
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroEnderecoPrincipal"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left">
                        <input type="text" name="endereco_principal" id="endereco_principal" class="CampoTexto01" maxlength="255" />
                    </div>
                </td>
            </tr>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroEnderecoNumeroPrincipal"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro">
                    <div align="left">
                        <input type="text" name="endereco_numero_principal" id="endereco_numero_principal" class="CampoTexto02" maxlength="255" />
                    </div>
                </td>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroEnderecoComplementoPrincipal"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaColuna01">
                    <div align="left">
                        <input type="text" name="endereco_complemento_principal" id="endereco_complemento_principal" class="CampoTexto02" maxlength="255" />
                    </div>
                </td>
            </tr>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroBairroPrincipal"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro">
                    <div align="left">
                        <input type="text" name="bairro_principal" id="bairro_principal" class="CampoTexto01" maxlength="255" />
                    </div>
                </td>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroCidadePrincipal"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaColuna01">
                    <div align="left">
                        <input type="text" name="cidade_principal" id="cidade_principal" class="CampoTexto01" maxlength="255" />
                    </div>
                </td>
            </tr>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroEstadoPrincipal"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro">
                    <div align="left">
                        <input type="text" name="estado_principal" id="estado_principal" class="CampoTexto02" maxlength="255" />
                    </div>
                </td>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroPaisPrincipal"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaColuna01">
                    <div align="left">
                        <input type="text" name="pais_principal" id="pais_principal" class="CampoTexto01" maxlength="255" />
                    </div>
                </td>
            </tr>
            <?php } ?>
            <?php //---------------------- ?>


            <?php if($GLOBALS['habilitarCadastroPontoReferencia'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroPontoReferencia"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left">
                        <textarea name="ponto_referencia" id="ponto_referencia" class="CampoTextoMultilinha01"></textarea>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroEmailPrincipal"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left">
                        <input type="text" name="email_principal" id="email_principal" class="CampoTexto01" maxlength="255" />
                        <span id="lblEmailPrincipalDuplicadoAlerta" class="TextoAlerta" style="display: none;">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroEmailPrincipalVerificacaoDuplicadoAlerta1"); ?>
                        </span>


                        <?php //JQuery - Ajax - e-mail Principal Duplicado.?>
                        <?php //----------------------?>
                        <?php if($GLOBALS['configCadastroEmailVerificacaoDuplicado'] == 1){ ?>
							<script type="text/javascript">
                                $("#email_principal").focusout(function() {
                                    //Variáveis.
									var emailPrincipalCampo = $(this)
                                    var emailPrincipalConsulta = emailPrincipalCampo.val();
                                    var emailPrincipalRetorno = "";
                                    
                                    var divProgressBar = "updtProgressGenerico";
                                    var btnSubmit = "btnCadastroIncluir";
                                    var lblAlerta = "lblEmailPrincipalDuplicadoAlerta";
									
									
									//Debug.
									//alert("Função acionada!" + emailPrincipalConsulta);
                                    
                                    
                                    //Condição para executar somente depois de todos os caractéres do CPF preenchidos.
                                    if(emailPrincipalConsulta.length > 1)
                                    {
                                        //Acionamento da poleta.
                                        divShow(divProgressBar);
                                        
                                        
                                        //Ajax - comando.
                                        //http://tinton.com.br.solidcp.temp-address.com/api/ApiCEP.php
                                        //contentType: 'application/json',
                                        //http://api.zippopotam.us/us/90210
                                        //html jsonp json
                                        //success: function(result, success) 
                                        //error: function(result, success) 
                                        //cache: false,
                                        //async: true,
                                        //data: "cepConsulta=" + "02068030",
                                        /**/
                                        $.ajax({
                                            url: "<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiCadastro.php",
                                            dataType: "html",
                                            type: "GET",
                                            data: "emailPrincipalConsulta=" + emailPrincipalConsulta,
                                            success: function(retornoDadosURL, success) 
                                            {
                                                //Ocultação da poleta.
                                                divHide(divProgressBar);
                                                
                                                //Definição de valores.
                                                emailPrincipalRetorno = retornoDadosURL; //0 - não exitente | 1 - existente
                                                //alert("cpfExistenteRetorno=" + cpfExistenteRetorno);
                                                
                                                //Preenchimento de dados.
                                                if(emailPrincipalRetorno == "0")
                                                {
                                                    //Mostrar aviso.
                                                    divHide(lblAlerta);
                                                    
                                                    //Habilitar botão.
                                                    document.getElementById(btnSubmit).disabled = false;
                                                }
                                                if(emailPrincipalRetorno == "1")
                                                {
                                                    //Mostrar aviso.
                                                    divShow(lblAlerta);
                                                    
                                                    //Desabilitar botão.
                                                    document.getElementById(btnSubmit).disabled = true; 
                                                }
                                            },
                                            error: function(retornoDadosURL, success) 
                                            {
                                                //$(".zip-error").show(); // Ruh row
                                                //elementoMensagem01('testeAlvo01', "erro");
                                                divShow(lblAlerta);
                                            }	
                                        });	
                                            
                                                                    
                                        //Degug.
                                        //elementoMensagem01('testeAlvo01', cepNumero);
                                    }
                                    
                                    
                                    //Condição para reabilitar se as informações estiverem sido excluídas.
                                    if(emailPrincipalConsulta.length == 0)
                                    {
                                        //Mostrar aviso.
                                        divHide(lblAlerta);
                                        
                                        //Habilitar botão.
                                        document.getElementById(btnSubmit).disabled = false;
                                    }
                                });						
                            </script>
                        <?php } ?>
                        <?php //----------------------?>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroTel"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left" class="Texto01">
                        (<input type="text" name="tel_ddd_principal" id="tel_ddd_principal" class="CampoDDD01" maxlength="255" />)
                        <input type="text" name="tel_principal" id="tel_principal" class="CampoTexto01" maxlength="255" />
                    </div>
                </td>
            </tr>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroCel"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left" class="Texto01">
                        (<input type="text" name="cel_ddd_principal" id="cel_ddd_principal" class="CampoDDD01" maxlength="255" />)
                        <input type="text" name="cel_principal" id="cel_principal" class="CampoTexto01" maxlength="255" />
                    </div>
                </td>
            </tr>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroFax"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left" class="Texto01">
                        (<input type="text" name="fax_ddd_principal" id="fax_ddd_principal" class="CampoDDD01" maxlength="255" />)
                        <input type="text" name="fax_principal" id="fax_principal" class="CampoTexto01" maxlength="255" />
                    </div>
                </td>
            </tr>
            
            <?php if($GLOBALS['habilitarCadastroSite'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroSitePrincipal"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left" class="Texto01">
                        <input type="text" name="site_principal" id="site_principal" class="CampoTexto01" maxlength="255" />
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroNFuncionarios'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroNFuncionarios"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left">
                        <input type="text" name="n_funcionarios" id="n_funcionarios" class="CampoNumerico01" maxlength="255" />
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroObs"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left">
                        <textarea name="obs_interno" id="obs_interno" class="CampoTextoMultilinha01"></textarea>
                    </div>
                </td>
            </tr>
            
            <?php if($GLOBALS['habilitarCadastroVinculo1'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroVinculo1Nome'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
						<?php 
                            $arrCadastroVinculo1 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbCadastroVinculo1'], $GLOBALS['configIdTbTipoCadastroVinculo1'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoCadastroVinculo1'], $GLOBALS['configCadastroVinculo1Metodo']);
                        ?>
                        <select name="id_tb_cadastro1" id="id_tb_cadastro1" class="CampoDropDownMenu01">
                            <option value="0" selected="selected"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNenhumDropDown"); ?></option>
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
            
            <?php if($GLOBALS['habilitarCadastroVinculo2'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroVinculo2Nome'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
						<?php 
                            $arrCadastroVinculo2 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbCadastroVinculo2'], $GLOBALS['configIdTbTipoCadastroVinculo2'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoCadastroVinculo2'], $GLOBALS['configCadastroVinculo2Metodo']);
                        ?>
                        <select name="id_tb_cadastro2" id="id_tb_cadastro2" class="CampoDropDownMenu01">
                            <option value="0" selected="selected"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNenhumDropDown"); ?></option>
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
            
            <?php if($GLOBALS['habilitarCadastroVinculo3'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroVinculo3Nome'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
						<?php 
                            $arrCadastroVinculo3 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbCadastroVinculo3'], $GLOBALS['configIdTbTipoCadastroVinculo3'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoCadastroVinculo3'], $GLOBALS['configCadastroVinculo3Metodo']);
                        ?>
                        <select name="id_tb_cadastro3" id="id_tb_cadastro3" class="CampoDropDownMenu01">
                            <option value="0" selected="selected"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNenhumDropDown"); ?></option>
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
            
            <?php if($GLOBALS['habilitarCadastroStatus'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroStatus"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
						<?php 
                            $arrCadastroStatus = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 3);
                        ?>
                        <select name="id_tb_cadastro_status" id="id_tb_cadastro_status" class="CampoDropDownMenu01">
                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
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
            
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao3"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left" class="Texto01">
                        <select name="ativacao" id="ativacao" class="CampoDropDownMenu01">
                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao4"); ?></option>
                            <option value="1" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao5"); ?></option>
                        </select>
                    </div>
                </td>
            </tr>
            
            <?php if($GLOBALS['habilitarCadastroAtivacaoMalaDireta'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroAtivacaoMalaDireta"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left" class="Texto01">
                        <select name="ativacao_mala_direta" id="ativacao_mala_direta" class="CampoDropDownMenu01">
                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao4"); ?></option>
                            <option value="1" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao5"); ?></option>
                        </select>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroUsuario'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroUsuario"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left">
                        <input type="text" name="usuario" id="usuario" class="CampoTexto01" maxlength="255" />
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroSenha'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroSenha"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left">
                        <input type="password" name="senha" id="senha" class="CampoTexto01" maxlength="255" />
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroImagem'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemImagem"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <input type="file" name="ArquivoUpload" id="ArquivoUpload" class="CampoArquivoUpload01" />
                    </div>
                </td>
            </tr>
            <?php } ?>
            
			<?php if($GLOBALS['habilitarCadastroArquivo1'] == 1){ ?>
			<tr>
				<td class="TbFundoMedio TabelaColuna01">
					<div align="left" class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroTituloArquivo1'], "IncludeConfig"); ?>:
					</div>
				</td>
				<td class="TbFundoClaro" colspan="3">
					<div>
						<input type="file" name="ArquivoUpload1" id="ArquivoUpload1" class="CampoArquivoUpload01" />
					</div>
				</td>
			</tr>
            <?php } ?>
            
			<?php if($GLOBALS['habilitarCadastroArquivo2'] == 1){ ?>
			<tr>
				<td class="TbFundoMedio TabelaColuna01">
					<div align="left" class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroTituloArquivo2'], "IncludeConfig"); ?>:
					</div>
				</td>
				<td class="TbFundoClaro" colspan="3">
					<div>
						<input type="file" name="ArquivoUpload2" id="ArquivoUpload2" class="CampoArquivoUpload01" />
					</div>
				</td>
			</tr>
            <?php } ?>
            
			<?php if($GLOBALS['habilitarCadastroArquivo3'] == 1){ ?>
			<tr>
				<td class="TbFundoMedio TabelaColuna01">
					<div align="left" class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroTituloArquivo3'], "IncludeConfig"); ?>:
					</div>
				</td>
				<td class="TbFundoClaro" colspan="3">
					<div>
						<input type="file" name="ArquivoUpload3" id="ArquivoUpload3" class="CampoArquivoUpload01" />
					</div>
				</td>
			</tr>
            <?php } ?>
            
			<?php if($GLOBALS['habilitarCadastroArquivo4'] == 1){ ?>
			<tr>
				<td class="TbFundoMedio TabelaColuna01">
					<div align="left" class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroTituloArquivo4'], "IncludeConfig"); ?>:
					</div>
				</td>
				<td class="TbFundoClaro" colspan="3">
					<div>
						<input type="file" name="ArquivoUpload4" id="ArquivoUpload4" class="CampoArquivoUpload01" />
					</div>
				</td>
			</tr>
            <?php } ?>
            
			<?php if($GLOBALS['habilitarCadastroArquivo5'] == 1){ ?>
			<tr>
				<td class="TbFundoMedio TabelaColuna01">
					<div align="left" class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroTituloArquivo5'], "IncludeConfig"); ?>:
					</div>
				</td>
				<td class="TbFundoClaro" colspan="3">
					<div>
						<input type="file" name="ArquivoUpload5" id="ArquivoUpload5" class="CampoArquivoUpload01" />
					</div>
				</td>
			</tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroMapaOnline'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroMapaOnline"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left" class="Texto01">
                        <textarea name="mapa_online" id="mapa_online" class="CampoTextoMultilinha01"></textarea>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroPalavrasChave'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemPalavrasChave01"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left" class="Texto01">
                        <textarea name="palavras_chave" id="palavras_chave" class="CampoTextoMultilinha01"></textarea>
                        <br />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemPalavrasChave02"); ?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarCadastroApresentacao'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroApresentacao"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div>
                        <?php //Sem formatação.?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                            <textarea name="apresentacao" id="apresentacao" class="CampoTextoMultilinhaConteudo"></textarea>
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
            <?php if($GLOBALS['habilitarCadastroServicos'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroServicos"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div>
                        <?php //Sem formatação.?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                            <textarea name="servicos" id="servicos" class="CampoTextoMultilinhaConteudo"></textarea>
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
            <?php if($GLOBALS['HabilitarCadastroPromocoes'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroPromocoes"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div>
                        <?php //Sem formatação.?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                            <textarea name="promocoes" id="promocoes" class="CampoTextoMultilinhaConteudo"></textarea>
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
            <?php if($GLOBALS['habilitarCadastroCondicoesComerciais'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroCondicoesComerciais"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div>
                        <?php //Sem formatação.?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                            <textarea name="condicoes_comerciais" id="condicoes_comerciais" class="CampoTextoMultilinhaConteudo"></textarea>
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
            <?php if($GLOBALS['habilitarCadastroFormasPagamento'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroFormasPagamento"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div>
                        <?php //Sem formatação.?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                            <textarea name="formas_pagamento" id="formas_pagamento" class="CampoTextoMultilinhaConteudo"></textarea>
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
            
            <?php if($GLOBALS['habilitarCadastroHorarioAtendimento'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroHorarioAtendimento"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div>
                        <?php //Sem formatação.?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                            <textarea name="horario_atendimento" id="horario_atendimento" class="CampoTextoMultilinhaConteudo"></textarea>
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
            <?php if($GLOBALS['habilitarCadastroSituacaoAtual'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroSituacaoAtual"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div>
                        <?php //Sem formatação.?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                            <textarea name="situacao_atual" id="situacao_atual" class="CampoTextoMultilinhaConteudo"></textarea>
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
            
            <?php if($GLOBALS['habilitarCadastroIc1'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc1'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc1'] == 1){ ?>
                            <input type="text" name="informacao_complementar1" id="informacao_complementar1" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc1'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar1" id="informacao_complementar1" class="CampoTextoMultilinha01"></textarea>
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
            
            <?php if($GLOBALS['habilitarCadastroIc2'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc2'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc2'] == 1){ ?>
                            <input type="text" name="informacao_complementar2" id="informacao_complementar2" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc2'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar2" id="informacao_complementar2" class="CampoTextoMultilinha01"></textarea>
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
        
            <?php if($GLOBALS['habilitarCadastroIc3'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc3'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc3'] == 1){ ?>
                            <input type="text" name="informacao_complementar3" id="informacao_complementar3" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc3'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar3" id="informacao_complementar3" class="CampoTextoMultilinha01"></textarea>
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
        
            <?php if($GLOBALS['habilitarCadastroIc4'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc4'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc4'] == 1){ ?>
                            <input type="text" name="informacao_complementar4" id="informacao_complementar4" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc4'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar4" id="informacao_complementar4" class="CampoTextoMultilinha01"></textarea>
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
        
            <?php if($GLOBALS['habilitarCadastroIc5'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc5'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc5'] == 1){ ?>
                            <input type="text" name="informacao_complementar5" id="informacao_complementar5" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc5'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar5" id="informacao_complementar5" class="CampoTextoMultilinha01"></textarea>
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
            
            <?php if($GLOBALS['habilitarCadastroIc6'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc6'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc6'] == 1){ ?>
                            <input type="text" name="informacao_complementar6" id="informacao_complementar6" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc6'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar6" id="informacao_complementar6" class="CampoTextoMultilinha01"></textarea>
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
            
            <?php if($GLOBALS['habilitarCadastroIc7'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc7'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc7'] == 1){ ?>
                            <input type="text" name="informacao_complementar7" id="informacao_complementar7" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc7'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar7" id="informacao_complementar7" class="CampoTextoMultilinha01"></textarea>
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
        
            <?php if($GLOBALS['habilitarCadastroIc8'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc8'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc8'] == 1){ ?>
                            <input type="text" name="informacao_complementar8" id="informacao_complementar8" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc8'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar8" id="informacao_complementar8" class="CampoTextoMultilinha01"></textarea>
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
        
            <?php if($GLOBALS['habilitarCadastroIc9'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc9'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc9'] == 1){ ?>
                            <input type="text" name="informacao_complementar9" id="informacao_complementar9" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc9'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar9" id="informacao_complementar9" class="CampoTextoMultilinha01"></textarea>
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
        
            <?php if($GLOBALS['habilitarCadastroIc10'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc10'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc10'] == 1){ ?>
                            <input type="text" name="informacao_complementar10" id="informacao_complementar10" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc10'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar10" id="informacao_complementar10" class="CampoTextoMultilinha01"></textarea>
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
            
            <?php if($GLOBALS['habilitarCadastroIc11'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc11'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc11'] == 1){ ?>
                            <input type="text" name="informacao_complementar11" id="informacao_complementar11" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc11'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar11" id="informacao_complementar11" class="CampoTextoMultilinha01"></textarea>
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
            
            <?php if($GLOBALS['habilitarCadastroIc12'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc12'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc12'] == 1){ ?>
                            <input type="text" name="informacao_complementar12" id="informacao_complementar12" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc12'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar12" id="informacao_complementar12" class="CampoTextoMultilinha01"></textarea>
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
        
            <?php if($GLOBALS['habilitarCadastroIc13'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc13'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc13'] == 1){ ?>
                            <input type="text" name="informacao_complementar13" id="informacao_complementar13" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc13'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar13" id="informacao_complementar13" class="CampoTextoMultilinha01"></textarea>
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
        
            <?php if($GLOBALS['habilitarCadastroIc14'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc14'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc14'] == 1){ ?>
                            <input type="text" name="informacao_complementar14" id="informacao_complementar14" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc14'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar14" id="informacao_complementar14" class="CampoTextoMultilinha01"></textarea>
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
        
            <?php if($GLOBALS['habilitarCadastroIc15'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc15'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc15'] == 1){ ?>
                            <input type="text" name="informacao_complementar15" id="informacao_complementar15" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc15'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar15" id="informacao_complementar15" class="CampoTextoMultilinha01"></textarea>
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
            
            <?php if($GLOBALS['habilitarCadastroIc16'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc16'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc16'] == 1){ ?>
                            <input type="text" name="informacao_complementar16" id="informacao_complementar16" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc16'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar16" id="informacao_complementar16" class="CampoTextoMultilinha01"></textarea>
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
            
            <?php if($GLOBALS['habilitarCadastroIc17'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc17'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc17'] == 1){ ?>
                            <input type="text" name="informacao_complementar17" id="informacao_complementar17" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc12'] == 7){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar17" id="informacao_complementar17" class="CampoTextoMultilinha01"></textarea>
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
        
            <?php if($GLOBALS['habilitarCadastroIc18'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc18'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc18'] == 1){ ?>
                            <input type="text" name="informacao_complementar18" id="informacao_complementar18" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc18'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar18" id="informacao_complementar18" class="CampoTextoMultilinha01"></textarea>
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
        
            <?php if($GLOBALS['habilitarCadastroIc19'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc19'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc19'] == 1){ ?>
                            <input type="text" name="informacao_complementar19" id="informacao_complementar19" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc19'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar19" id="informacao_complementar19" class="CampoTextoMultilinha01"></textarea>
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
        
            <?php if($GLOBALS['habilitarCadastroIc20'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc20'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc20'] == 1){ ?>
                            <input type="text" name="informacao_complementar20" id="informacao_complementar20" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc20'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar20" id="informacao_complementar20" class="CampoTextoMultilinha01"></textarea>
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
            
            <?php if($GLOBALS['habilitarCadastroIc21'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc21'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc21'] == 1){ ?>
                            <input type="text" name="informacao_complementar21" id="informacao_complementar21" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc21'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar21" id="informacao_complementar21" class="CampoTextoMultilinha01"></textarea>
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
            
            <?php if($GLOBALS['habilitarCadastroIc22'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc22'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc22'] == 1){ ?>
                            <input type="text" name="informacao_complementar22" id="informacao_complementar22" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc22'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar22" id="informacao_complementar22" class="CampoTextoMultilinha01"></textarea>
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
        
            <?php if($GLOBALS['habilitarCadastroIc23'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc23'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc23'] == 1){ ?>
                            <input type="text" name="informacao_complementar23" id="informacao_complementar23" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc23'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar23" id="informacao_complementar23" class="CampoTextoMultilinha01"></textarea>
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
        
            <?php if($GLOBALS['habilitarCadastroIc24'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc24'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc24'] == 1){ ?>
                            <input type="text" name="informacao_complementar24" id="informacao_complementar24" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc24'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar24" id="informacao_complementar24" class="CampoTextoMultilinha01"></textarea>
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
        
            <?php if($GLOBALS['habilitarCadastroIc25'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc25'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc25'] == 1){ ?>
                            <input type="text" name="informacao_complementar25" id="informacao_complementar25" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc25'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar25" id="informacao_complementar25" class="CampoTextoMultilinha01"></textarea>
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
            
            <?php if($GLOBALS['habilitarCadastroIc26'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc26'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc26'] == 1){ ?>
                            <input type="text" name="informacao_complementar26" id="informacao_complementar26" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc26'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar26" id="informacao_complementar26" class="CampoTextoMultilinha01"></textarea>
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
            
            <?php if($GLOBALS['habilitarCadastroIc27'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc27'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc27'] == 1){ ?>
                            <input type="text" name="informacao_complementar27" id="informacao_complementar27" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc22'] == 7){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar27" id="informacao_complementar27" class="CampoTextoMultilinha01"></textarea>
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
        
            <?php if($GLOBALS['habilitarCadastroIc28'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc28'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc28'] == 1){ ?>
                            <input type="text" name="informacao_complementar28" id="informacao_complementar28" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc28'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar28" id="informacao_complementar28" class="CampoTextoMultilinha01"></textarea>
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
        
            <?php if($GLOBALS['habilitarCadastroIc29'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc29'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc29'] == 1){ ?>
                            <input type="text" name="informacao_complementar29" id="informacao_complementar29" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc29'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar29" id="informacao_complementar29" class="CampoTextoMultilinha01"></textarea>
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
        
            <?php if($GLOBALS['habilitarCadastroIc30'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc30'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc30'] == 1){ ?>
                            <input type="text" name="informacao_complementar30" id="informacao_complementar30" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc30'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar30" id="informacao_complementar30" class="CampoTextoMultilinha01"></textarea>
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
            
            <?php if($GLOBALS['habilitarCadastroIc31'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc31'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc31'] == 1){ ?>
                            <input type="text" name="informacao_complementar31" id="informacao_complementar31" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc31'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar31" id="informacao_complementar31" class="CampoTextoMultilinha01"></textarea>
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
            
            <?php if($GLOBALS['habilitarCadastroIc32'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc32'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc32'] == 1){ ?>
                            <input type="text" name="informacao_complementar32" id="informacao_complementar32" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc32'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar32" id="informacao_complementar32" class="CampoTextoMultilinha01"></textarea>
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
        
            <?php if($GLOBALS['habilitarCadastroIc33'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc33'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc33'] == 1){ ?>
                            <input type="text" name="informacao_complementar33" id="informacao_complementar33" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc33'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar33" id="informacao_complementar33" class="CampoTextoMultilinha01"></textarea>
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
        
            <?php if($GLOBALS['habilitarCadastroIc34'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc34'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc34'] == 1){ ?>
                            <input type="text" name="informacao_complementar34" id="informacao_complementar34" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc34'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar34" id="informacao_complementar34" class="CampoTextoMultilinha01"></textarea>
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
        
            <?php if($GLOBALS['habilitarCadastroIc35'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc35'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc35'] == 1){ ?>
                            <input type="text" name="informacao_complementar35" id="informacao_complementar35" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc35'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar35" id="informacao_complementar35" class="CampoTextoMultilinha01"></textarea>
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
            
            <?php if($GLOBALS['habilitarCadastroIc36'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc36'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc36'] == 1){ ?>
                            <input type="text" name="informacao_complementar36" id="informacao_complementar36" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc36'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar36" id="informacao_complementar36" class="CampoTextoMultilinha01"></textarea>
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
            
            <?php if($GLOBALS['habilitarCadastroIc37'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc37'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc37'] == 1){ ?>
                            <input type="text" name="informacao_complementar37" id="informacao_complementar37" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc32'] == 7){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar37" id="informacao_complementar37" class="CampoTextoMultilinha01"></textarea>
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
        
            <?php if($GLOBALS['habilitarCadastroIc38'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc38'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc38'] == 1){ ?>
                            <input type="text" name="informacao_complementar38" id="informacao_complementar38" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc38'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar38" id="informacao_complementar38" class="CampoTextoMultilinha01"></textarea>
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
        
            <?php if($GLOBALS['habilitarCadastroIc39'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc39'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc39'] == 1){ ?>
                            <input type="text" name="informacao_complementar39" id="informacao_complementar39" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc39'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar39" id="informacao_complementar39" class="CampoTextoMultilinha01"></textarea>
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
        
            <?php if($GLOBALS['habilitarCadastroIc40'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc40'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc40'] == 1){ ?>
                            <input type="text" name="informacao_complementar40" id="informacao_complementar40" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc40'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar40" id="informacao_complementar40" class="CampoTextoMultilinha01"></textarea>
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

         </table>
         
        <div>
            <div style="float:left;">
                <input type="image" id="btnCadastroIncluir" name="submit" value="Submit" src="img/btoIncluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoIncluir"); ?>" />
                
                <input type="hidden" id="id_tb_categorias" name="id_tb_categorias" value="<?php echo $idParentCadastro; ?>" />
                
                <input type="hidden" id="id_db_cep_tblBairros" name="id_db_cep_tblBairros" value="0" />
                <input type="hidden" id="id_db_cep_tblCidades" name="id_db_cep_tblCidades" value="0" />
                <input type="hidden" id="id_db_cep_tblLogradouros" name="id_db_cep_tblLogradouros" value="0" />
                <input type="hidden" id="id_db_cep_tblUF" name="id_db_cep_tblUF" value="0" />

                <!--input name="ativacao" type="hidden" id="ativacao" value="1" /-->
                <input type="hidden" id="paginaRetorno" name="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            </div>
            <div style="float:right;">
                &nbsp;
            </div>
        </div>
    </form>
    <br />
    <?php } ?>
    
    <div id="updtProgressGenerico" style="display: none;">
        <div class="ProgressBarGenerico01Container">
            <div class="ProgressBarGenerico01">
                <img src="img/ProgressBar01.gif" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaImagemProgressBarra"); ?>" />
            </div>
        </div>
    </div>
<?php 
$page->cphConteudoPrincipal = ob_get_clean(); 
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
include_once $page->LayoutSistema;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>