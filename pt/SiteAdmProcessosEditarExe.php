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
$id = $_POST["idTbProcessos"];
$idParent = $_POST["id_parent"];

$arrIdsProcessosFiltroGenerico01 = $_POST["idsProcessosFiltroGenerico01"];
$arrIdsProcessosFiltroGenerico02 = $_POST["idsProcessosFiltroGenerico02"];
$arrIdsProcessosFiltroGenerico03 = $_POST["idsProcessosFiltroGenerico03"];
$arrIdsProcessosFiltroGenerico04 = $_POST["idsProcessosFiltroGenerico04"];
$arrIdsProcessosFiltroGenerico05 = $_POST["idsProcessosFiltroGenerico05"];
$arrIdsProcessosFiltroGenerico06 = $_POST["idsProcessosFiltroGenerico06"];
$arrIdsProcessosFiltroGenerico07 = $_POST["idsProcessosFiltroGenerico07"];
$arrIdsProcessosFiltroGenerico08 = $_POST["idsProcessosFiltroGenerico08"];
$arrIdsProcessosFiltroGenerico09 = $_POST["idsProcessosFiltroGenerico09"];
$arrIdsProcessosFiltroGenerico10 = $_POST["idsProcessosFiltroGenerico10"];
$arrIdsProcessosFiltroGenerico11 = $_POST["idsProcessosFiltroGenerico11"];
$arrIdsProcessosFiltroGenerico12 = $_POST["idsProcessosFiltroGenerico12"];
$arrIdsProcessosFiltroGenerico13 = $_POST["idsProcessosFiltroGenerico13"];
$arrIdsProcessosFiltroGenerico14 = $_POST["idsProcessosFiltroGenerico14"];
$arrIdsProcessosFiltroGenerico15 = $_POST["idsProcessosFiltroGenerico15"];
$arrIdsProcessosFiltroGenerico16 = $_POST["idsProcessosFiltroGenerico16"];
$arrIdsProcessosFiltroGenerico17 = $_POST["idsProcessosFiltroGenerico17"];
$arrIdsProcessosFiltroGenerico18 = $_POST["idsProcessosFiltroGenerico18"];
$arrIdsProcessosFiltroGenerico19 = $_POST["idsProcessosFiltroGenerico19"];
$arrIdsProcessosFiltroGenerico20 = $_POST["idsProcessosFiltroGenerico20"];

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

$nClassificacao = $_POST["n_classificacao"];
if($nClassificacao == "")
{
	$nClassificacao = 0;
}

$dataCriacao = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");

$dataAbertura = Funcoes::DataGravacaoSql($_POST["data_abertura"], $GLOBALS['configSistemaFormatoData']);
if($dataAbertura == "")
{
	$dataAbertura = NULL;	
}
$dataDistribuicao = Funcoes::DataGravacaoSql($_POST["data_distribuicao"], $GLOBALS['configSistemaFormatoData']);
if($dataDistribuicao == "")
{
	$dataDistribuicao = NULL;	
}
$dataAdmissao = Funcoes::DataGravacaoSql($_POST["data_admissao"], $GLOBALS['configSistemaFormatoData']);
if($dataAdmissao == "")
{
	$dataAdmissao = NULL;	
}
$dataDemissao = Funcoes::DataGravacaoSql($_POST["data_demissao"], $GLOBALS['configSistemaFormatoData']);
if($dataDemissao == "")
{
	$dataDemissao = NULL;	
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

$processo = Funcoes::ConteudoMascaraGravacao01($_POST["processo"]);
$descricao = Funcoes::ConteudoMascaraGravacao01($_POST["descricao"]);

$idTbProcessosStatus = $_POST["id_tb_processos_status"];
if($idTbProcessosStatus == "")
{
	$idTbProcessosStatus = 0;
}

$palavrasChave = $_POST["palavras_chave"];

$valor = Funcoes::FormatarValorGravar($_POST["valor"]);
if($valor == "")
{
	$valor = 0;	
}

$valor1 = 0;
$valor2 = 0;
$valor3 = 0;
$valor4 = 0;
$valor5 = 0;

$URL1 = Funcoes::ConteudoMascaraGravacao01($_POST["url1"]);
$URL2 = Funcoes::ConteudoMascaraGravacao01($_POST["url2"]);
$URL3 = Funcoes::ConteudoMascaraGravacao01($_POST["url3"]);
$URL4 = Funcoes::ConteudoMascaraGravacao01($_POST["url4"]);
$URL5 = Funcoes::ConteudoMascaraGravacao01($_POST["url5"]);

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
$informacaoComplementar41 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar41"]);
$informacaoComplementar42 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar42"]);
$informacaoComplementar43 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar43"]);
$informacaoComplementar44 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar44"]);
$informacaoComplementar45 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar45"]);
$informacaoComplementar46 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar46"]);
$informacaoComplementar47 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar47"]);
$informacaoComplementar48 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar48"]);
$informacaoComplementar49 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar49"]);
$informacaoComplementar50 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar50"]);
$informacaoComplementar51 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar51"]);
$informacaoComplementar52 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar52"]);
$informacaoComplementar53 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar53"]);
$informacaoComplementar54 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar54"]);
$informacaoComplementar55 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar55"]);
$informacaoComplementar56 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar56"]);
$informacaoComplementar57 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar57"]);
$informacaoComplementar58 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar58"]);
$informacaoComplementar59 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar59"]);
$informacaoComplementar60 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar60"]);

$ativacao = $_POST["ativacao"];
$ativacao1 = $_POST["ativacao1"];
if($ativacao1 == "")
{
	$ativacao1 = 0;
}
$ativacao2 = $_POST["ativacao2"];
if($ativacao2 == "")
{
	$ativacao2 = 0;
}
$ativacao3 = $_POST["ativacao3"];
if($ativacao3 == "")
{
	$ativacao3 = 0;
}
$ativacao4 = $_POST["ativacao4"];
if($ativacao4 == "")
{
	$ativacao4 = 0;
}

$nVisitas = 0;

$acessoRestrito = $_POST["acesso_restrito"];
if($acessoRestrito == "")
{
	$acessoRestrito = 0;
}

$paginaRetorno = $_POST["paginaRetorno"];
$mensagemErro = "";
$mensagemSucesso = "";

//Montagem de query padrão de retorno.
$queryPadrao = "&masterPageSelect=" . $masterPageSelect;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Update de registro no BD.
//----------
$strSqlProcessosUpdate = "";
$strSqlProcessosUpdate .= "UPDATE tb_processos ";
$strSqlProcessosUpdate .= "SET ";
//$strSqlProcessosUpdate .= "id = :id, ";
//$strSqlProcessosUpdate .= "id_parent = :id_parent, ";

$strSqlProcessosUpdate .= "id_tb_cadastro1 = :id_tb_cadastro1, ";
$strSqlProcessosUpdate .= "id_tb_cadastro2 = :id_tb_cadastro2, ";
$strSqlProcessosUpdate .= "id_tb_cadastro3 = :id_tb_cadastro3, ";

$strSqlProcessosUpdate .= "n_classificacao = :n_classificacao, ";

//$strSqlProcessosUpdate .= "data_criacao = :data_criacao, ";
$strSqlProcessosUpdate .= "data_abertura = :data_abertura, ";
$strSqlProcessosUpdate .= "data_distribuicao = :data_distribuicao, ";
$strSqlProcessosUpdate .= "data_admissao = :data_admissao, ";
$strSqlProcessosUpdate .= "data_demissao = :data_demissao, ";

$strSqlProcessosUpdate .= "data1 = :data1, ";
$strSqlProcessosUpdate .= "data2 = :data2, ";
$strSqlProcessosUpdate .= "data3 = :data3, ";
$strSqlProcessosUpdate .= "data4 = :data4, ";
$strSqlProcessosUpdate .= "data5 = :data5, ";
$strSqlProcessosUpdate .= "data6 = :data6, ";
$strSqlProcessosUpdate .= "data7 = :data7, ";
$strSqlProcessosUpdate .= "data8 = :data8, ";
$strSqlProcessosUpdate .= "data9 = :data9, ";
$strSqlProcessosUpdate .= "data10 = :data10, ";

$strSqlProcessosUpdate .= "processo = :processo, ";
$strSqlProcessosUpdate .= "descricao = :descricao, ";
$strSqlProcessosUpdate .= "id_tb_processos_status = :id_tb_processos_status, ";
$strSqlProcessosUpdate .= "palavras_chave = :palavras_chave, ";

$strSqlProcessosUpdate .= "valor = :valor, ";
$strSqlProcessosUpdate .= "valor1 = :valor1, ";
$strSqlProcessosUpdate .= "valor2 = :valor2, ";
$strSqlProcessosUpdate .= "valor3 = :valor3, ";
$strSqlProcessosUpdate .= "valor4 = :valor4, ";
$strSqlProcessosUpdate .= "valor5 = :valor5, ";

$strSqlProcessosUpdate .= "url1 = :url1, ";
$strSqlProcessosUpdate .= "url2 = :url2, ";
$strSqlProcessosUpdate .= "url3 = :url3, ";
$strSqlProcessosUpdate .= "url4 = :url4, ";
$strSqlProcessosUpdate .= "url5 = :url5, ";

$strSqlProcessosUpdate .= "informacao_complementar1 = :informacao_complementar1, ";
$strSqlProcessosUpdate .= "informacao_complementar2 = :informacao_complementar2, ";
$strSqlProcessosUpdate .= "informacao_complementar3 = :informacao_complementar3, ";
$strSqlProcessosUpdate .= "informacao_complementar4 = :informacao_complementar4, ";
$strSqlProcessosUpdate .= "informacao_complementar5 = :informacao_complementar5, ";
$strSqlProcessosUpdate .= "informacao_complementar6 = :informacao_complementar6, ";
$strSqlProcessosUpdate .= "informacao_complementar7 = :informacao_complementar7, ";
$strSqlProcessosUpdate .= "informacao_complementar8 = :informacao_complementar8, ";
$strSqlProcessosUpdate .= "informacao_complementar9 = :informacao_complementar9, ";
$strSqlProcessosUpdate .= "informacao_complementar10 = :informacao_complementar10, ";
$strSqlProcessosUpdate .= "informacao_complementar11 = :informacao_complementar11, ";
$strSqlProcessosUpdate .= "informacao_complementar12 = :informacao_complementar12, ";
$strSqlProcessosUpdate .= "informacao_complementar13 = :informacao_complementar13, ";
$strSqlProcessosUpdate .= "informacao_complementar14 = :informacao_complementar14, ";
$strSqlProcessosUpdate .= "informacao_complementar15 = :informacao_complementar15, ";
$strSqlProcessosUpdate .= "informacao_complementar16 = :informacao_complementar16, ";
$strSqlProcessosUpdate .= "informacao_complementar17 = :informacao_complementar17, ";
$strSqlProcessosUpdate .= "informacao_complementar18 = :informacao_complementar18, ";
$strSqlProcessosUpdate .= "informacao_complementar19 = :informacao_complementar19, ";
$strSqlProcessosUpdate .= "informacao_complementar20 = :informacao_complementar20, ";
$strSqlProcessosUpdate .= "informacao_complementar21 = :informacao_complementar21, ";
$strSqlProcessosUpdate .= "informacao_complementar22 = :informacao_complementar22, ";
$strSqlProcessosUpdate .= "informacao_complementar23 = :informacao_complementar23, ";
$strSqlProcessosUpdate .= "informacao_complementar24 = :informacao_complementar24, ";
$strSqlProcessosUpdate .= "informacao_complementar25 = :informacao_complementar25, ";
$strSqlProcessosUpdate .= "informacao_complementar26 = :informacao_complementar26, ";
$strSqlProcessosUpdate .= "informacao_complementar27 = :informacao_complementar27, ";
$strSqlProcessosUpdate .= "informacao_complementar28 = :informacao_complementar28, ";
$strSqlProcessosUpdate .= "informacao_complementar29 = :informacao_complementar29, ";
$strSqlProcessosUpdate .= "informacao_complementar30 = :informacao_complementar30, ";
$strSqlProcessosUpdate .= "informacao_complementar31 = :informacao_complementar31, ";
$strSqlProcessosUpdate .= "informacao_complementar32 = :informacao_complementar32, ";
$strSqlProcessosUpdate .= "informacao_complementar33 = :informacao_complementar33, ";
$strSqlProcessosUpdate .= "informacao_complementar34 = :informacao_complementar34, ";
$strSqlProcessosUpdate .= "informacao_complementar35 = :informacao_complementar35, ";
$strSqlProcessosUpdate .= "informacao_complementar36 = :informacao_complementar36, ";
$strSqlProcessosUpdate .= "informacao_complementar37 = :informacao_complementar37, ";
$strSqlProcessosUpdate .= "informacao_complementar38 = :informacao_complementar38, ";
$strSqlProcessosUpdate .= "informacao_complementar39 = :informacao_complementar39, ";
$strSqlProcessosUpdate .= "informacao_complementar40 = :informacao_complementar40, ";
$strSqlProcessosUpdate .= "informacao_complementar41 = :informacao_complementar41, ";
$strSqlProcessosUpdate .= "informacao_complementar42 = :informacao_complementar42, ";
$strSqlProcessosUpdate .= "informacao_complementar43 = :informacao_complementar43, ";
$strSqlProcessosUpdate .= "informacao_complementar44 = :informacao_complementar44, ";
$strSqlProcessosUpdate .= "informacao_complementar45 = :informacao_complementar45, ";
$strSqlProcessosUpdate .= "informacao_complementar46 = :informacao_complementar46, ";
$strSqlProcessosUpdate .= "informacao_complementar47 = :informacao_complementar47, ";
$strSqlProcessosUpdate .= "informacao_complementar48 = :informacao_complementar48, ";
$strSqlProcessosUpdate .= "informacao_complementar49 = :informacao_complementar49, ";
$strSqlProcessosUpdate .= "informacao_complementar50 = :informacao_complementar50, ";
$strSqlProcessosUpdate .= "informacao_complementar51 = :informacao_complementar51, ";
$strSqlProcessosUpdate .= "informacao_complementar52 = :informacao_complementar52, ";
$strSqlProcessosUpdate .= "informacao_complementar53 = :informacao_complementar53, ";
$strSqlProcessosUpdate .= "informacao_complementar54 = :informacao_complementar54, ";
$strSqlProcessosUpdate .= "informacao_complementar55 = :informacao_complementar55, ";
$strSqlProcessosUpdate .= "informacao_complementar56 = :informacao_complementar56, ";
$strSqlProcessosUpdate .= "informacao_complementar57 = :informacao_complementar57, ";
$strSqlProcessosUpdate .= "informacao_complementar58 = :informacao_complementar58, ";
$strSqlProcessosUpdate .= "informacao_complementar59 = :informacao_complementar59, ";
$strSqlProcessosUpdate .= "informacao_complementar60 = :informacao_complementar60, ";

$strSqlProcessosUpdate .= "ativacao = :ativacao, ";
$strSqlProcessosUpdate .= "ativacao1 = :ativacao1, ";
$strSqlProcessosUpdate .= "ativacao2 = :ativacao2, ";
$strSqlProcessosUpdate .= "ativacao3 = :ativacao3, ";
$strSqlProcessosUpdate .= "ativacao4 = :ativacao4, ";

$strSqlProcessosUpdate .= "n_visitas = :n_visitas, ";
$strSqlProcessosUpdate .= "acesso_restrito = :acesso_restrito ";

$strSqlProcessosUpdate .= "WHERE id = :id ";
//echo "strSqlCategoriasUpdate = " . $strSqlProcessosUpdate . "<br />";
//----------


$statementProcessosUpdate = $dbSistemaConPDO->prepare($strSqlProcessosUpdate);


/*
"id_parent" => $idParent,
"data_criacao" => $dataCriacao,
*/
if ($statementProcessosUpdate !== false)
{
	$statementProcessosUpdate->execute(array(
		"id" => $id,
		"id_tb_cadastro1" => $idTbCadastro1,
		"id_tb_cadastro2" => $idTbCadastro2,
		"id_tb_cadastro3" => $idTbCadastro3,
		"n_classificacao" => $nClassificacao,
		"data_abertura" => $dataAbertura,
		"data_distribuicao" => $dataDistribuicao,
		"data_admissao" => $dataAdmissao,
		"data_demissao" => $dataDemissao,
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
		"processo" => $processo,
		"descricao" => $descricao,
		"id_tb_processos_status" => $idTbProcessosStatus,
		"palavras_chave" => $palavrasChave,
		"valor" => $valor,
		"valor1" => $valor1,
		"valor2" => $valor2,
		"valor3" => $valor3,
		"valor4" => $valor4,
		"valor5" => $valor5,
		"url1" => $URL1,
		"url2" => $URL2,
		"url3" => $URL3,
		"url4" => $URL4,
		"url5" => $URL5,
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
		"informacao_complementar41" => $informacaoComplementar41,
		"informacao_complementar42" => $informacaoComplementar42,
		"informacao_complementar43" => $informacaoComplementar43,
		"informacao_complementar44" => $informacaoComplementar44,
		"informacao_complementar45" => $informacaoComplementar45,
		"informacao_complementar46" => $informacaoComplementar46,
		"informacao_complementar47" => $informacaoComplementar47,
		"informacao_complementar48" => $informacaoComplementar48,
		"informacao_complementar49" => $informacaoComplementar49,
		"informacao_complementar50" => $informacaoComplementar50,
		"informacao_complementar51" => $informacaoComplementar51,
		"informacao_complementar52" => $informacaoComplementar52,
		"informacao_complementar53" => $informacaoComplementar53,
		"informacao_complementar54" => $informacaoComplementar54,
		"informacao_complementar55" => $informacaoComplementar55,
		"informacao_complementar56" => $informacaoComplementar56,
		"informacao_complementar57" => $informacaoComplementar57,
		"informacao_complementar58" => $informacaoComplementar58,
		"informacao_complementar59" => $informacaoComplementar59,
		"informacao_complementar60" => $informacaoComplementar60,
		"ativacao" => $ativacao,
		"ativacao1" => $ativacao1,
		"ativacao2" => $ativacao2,
		"ativacao3" => $ativacao3,
		"ativacao4" => $ativacao4,
		"n_visitas" => $nVisitas,
		"acesso_restrito" => $acessoRestrito
	));
	
	$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus7");
}else{
	//echo "erro";
	$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus8");
}


unset($strSqlProcessosUpdate);
unset($statementProcessosUpdate);
//----------


//Gravação de complementos.
//----------

//Filtro genérico 01.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_processos_relacao_complemento", 
									"id_tb_processos",
									"tipo_complemento", 
									"12");
if(!empty($arrIdsProcessosFiltroGenerico01))
{
	for($countArray = 0; $countArray < count($arrIdsProcessosFiltroGenerico01); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsProcessosFiltroGenerico01[$countArray], "12", "tb_processos_relacao_complemento", "id_tb_processos", "id_tb_processos_complemento");
	}
}


//Filtro genérico 02.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_processos_relacao_complemento", 
									"id_tb_processos",
									"tipo_complemento", 
									"13");
if(!empty($arrIdsProcessosFiltroGenerico02))
{
	for($countArray = 0; $countArray < count($arrIdsProcessosFiltroGenerico02); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsProcessosFiltroGenerico02[$countArray], "13", "tb_processos_relacao_complemento", "id_tb_processos", "id_tb_processos_complemento");
	}
}


//Filtro genérico 03.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_processos_relacao_complemento", 
									"id_tb_processos",
									"tipo_complemento", 
									"14");
if(!empty($arrIdsProcessosFiltroGenerico03))
{
	for($countArray = 0; $countArray < count($arrIdsProcessosFiltroGenerico03); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsProcessosFiltroGenerico03[$countArray], "14", "tb_processos_relacao_complemento", "id_tb_processos", "id_tb_processos_complemento");
	}
}


//Filtro genérico 04.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_processos_relacao_complemento", 
									"id_tb_processos",
									"tipo_complemento", 
									"15");
if(!empty($arrIdsProcessosFiltroGenerico04))
{
	for($countArray = 0; $countArray < count($arrIdsProcessosFiltroGenerico04); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsProcessosFiltroGenerico04[$countArray], "15", "tb_processos_relacao_complemento", "id_tb_processos", "id_tb_processos_complemento");
	}
}


//Filtro genérico 05.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_processos_relacao_complemento", 
									"id_tb_processos",
									"tipo_complemento", 
									"16");
if(!empty($arrIdsProcessosFiltroGenerico05))
{
	for($countArray = 0; $countArray < count($arrIdsProcessosFiltroGenerico05); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsProcessosFiltroGenerico05[$countArray], "16", "tb_processos_relacao_complemento", "id_tb_processos", "id_tb_processos_complemento");
	}
}


//Filtro genérico 06.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_processos_relacao_complemento", 
									"id_tb_processos",
									"tipo_complemento", 
									"17");
if(!empty($arrIdsProcessosFiltroGenerico06))
{
	for($countArray = 0; $countArray < count($arrIdsProcessosFiltroGenerico06); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsProcessosFiltroGenerico06[$countArray], "17", "tb_processos_relacao_complemento", "id_tb_processos", "id_tb_processos_complemento");
	}
}


//Filtro genérico 07.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_processos_relacao_complemento", 
									"id_tb_processos",
									"tipo_complemento", 
									"18");
if(!empty($arrIdsProcessosFiltroGenerico07))
{
	for($countArray = 0; $countArray < count($arrIdsProcessosFiltroGenerico07); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsProcessosFiltroGenerico07[$countArray], "18", "tb_processos_relacao_complemento", "id_tb_processos", "id_tb_processos_complemento");
	}
}


//Filtro genérico 08.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_processos_relacao_complemento", 
									"id_tb_processos",
									"tipo_complemento", 
									"19");
if(!empty($arrIdsProcessosFiltroGenerico08))
{
	for($countArray = 0; $countArray < count($arrIdsProcessosFiltroGenerico08); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsProcessosFiltroGenerico08[$countArray], "19", "tb_processos_relacao_complemento", "id_tb_processos", "id_tb_processos_complemento");
	}
}


//Filtro genérico 09.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_processos_relacao_complemento", 
									"id_tb_processos",
									"tipo_complemento", 
									"20");
if(!empty($arrIdsProcessosFiltroGenerico09))
{
	for($countArray = 0; $countArray < count($arrIdsProcessosFiltroGenerico09); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsProcessosFiltroGenerico09[$countArray], "20", "tb_processos_relacao_complemento", "id_tb_processos", "id_tb_processos_complemento");
	}
}


//Filtro genérico 10.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_processos_relacao_complemento", 
									"id_tb_processos",
									"tipo_complemento", 
									"21");
if(!empty($arrIdsProcessosFiltroGenerico10))
{
	for($countArray = 0; $countArray < count($arrIdsProcessosFiltroGenerico10); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsProcessosFiltroGenerico10[$countArray], "21", "tb_processos_relacao_complemento", "id_tb_processos", "id_tb_processos_complemento");
	}
}


//Filtro genérico 11.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_processos_relacao_complemento", 
									"id_tb_processos",
									"tipo_complemento", 
									"22");
if(!empty($arrIdsProcessosFiltroGenerico11))
{
	for($countArray = 0; $countArray < count($arrIdsProcessosFiltroGenerico11); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsProcessosFiltroGenerico11[$countArray], "22", "tb_processos_relacao_complemento", "id_tb_processos", "id_tb_processos_complemento");
	}
}


//Filtro genérico 12.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_processos_relacao_complemento", 
									"id_tb_processos",
									"tipo_complemento", 
									"23");
if(!empty($arrIdsProcessosFiltroGenerico12))
{
	for($countArray = 0; $countArray < count($arrIdsProcessosFiltroGenerico12); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsProcessosFiltroGenerico12[$countArray], "23", "tb_processos_relacao_complemento", "id_tb_processos", "id_tb_processos_complemento");
	}
}


//Filtro genérico 13.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_processos_relacao_complemento", 
									"id_tb_processos",
									"tipo_complemento", 
									"24");
if(!empty($arrIdsProcessosFiltroGenerico13))
{
	for($countArray = 0; $countArray < count($arrIdsProcessosFiltroGenerico13); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsProcessosFiltroGenerico13[$countArray], "24", "tb_processos_relacao_complemento", "id_tb_processos", "id_tb_processos_complemento");
	}
}


//Filtro genérico 14.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_processos_relacao_complemento", 
									"id_tb_processos",
									"tipo_complemento", 
									"25");
if(!empty($arrIdsProcessosFiltroGenerico14))
{
	for($countArray = 0; $countArray < count($arrIdsProcessosFiltroGenerico14); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsProcessosFiltroGenerico14[$countArray], "25", "tb_processos_relacao_complemento", "id_tb_processos", "id_tb_processos_complemento");
	}
}


//Filtro genérico 15.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_processos_relacao_complemento", 
									"id_tb_processos",
									"tipo_complemento", 
									"26");
if(!empty($arrIdsProcessosFiltroGenerico15))
{
	for($countArray = 0; $countArray < count($arrIdsProcessosFiltroGenerico15); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsProcessosFiltroGenerico15[$countArray], "26", "tb_processos_relacao_complemento", "id_tb_processos", "id_tb_processos_complemento");
	}
}


//Filtro genérico 16.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_processos_relacao_complemento", 
									"id_tb_processos",
									"tipo_complemento", 
									"27");
if(!empty($arrIdsProcessosFiltroGenerico16))
{
	for($countArray = 0; $countArray < count($arrIdsProcessosFiltroGenerico16); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsProcessosFiltroGenerico16[$countArray], "27", "tb_processos_relacao_complemento", "id_tb_processos", "id_tb_processos_complemento");
	}
}


//Filtro genérico 17.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_processos_relacao_complemento", 
									"id_tb_processos",
									"tipo_complemento", 
									"28");
if(!empty($arrIdsProcessosFiltroGenerico17))
{
	for($countArray = 0; $countArray < count($arrIdsProcessosFiltroGenerico17); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsProcessosFiltroGenerico17[$countArray], "28", "tb_processos_relacao_complemento", "id_tb_processos", "id_tb_processos_complemento");
	}
}


//Filtro genérico 18.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_processos_relacao_complemento", 
									"id_tb_processos",
									"tipo_complemento", 
									"29");
if(!empty($arrIdsProcessosFiltroGenerico18))
{
	for($countArray = 0; $countArray < count($arrIdsProcessosFiltroGenerico18); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsProcessosFiltroGenerico18[$countArray], "29", "tb_processos_relacao_complemento", "id_tb_processos", "id_tb_processos_complemento");
	}
}


//Filtro genérico 19.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_processos_relacao_complemento", 
									"id_tb_processos",
									"tipo_complemento", 
									"30");
if(!empty($arrIdsProcessosFiltroGenerico19))
{
	for($countArray = 0; $countArray < count($arrIdsProcessosFiltroGenerico19); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsProcessosFiltroGenerico19[$countArray], "30", "tb_processos_relacao_complemento", "id_tb_processos", "id_tb_processos_complemento");
	}
}


//Filtro genérico 20.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_processos_relacao_complemento", 
									"id_tb_processos",
									"tipo_complemento", 
									"31");
if(!empty($arrIdsProcessosFiltroGenerico10))
{
	for($countArray = 0; $countArray < count($arrIdsProcessosFiltroGenerico10); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsProcessosFiltroGenerico10[$countArray], "31", "tb_processos_relacao_complemento", "id_tb_processos", "id_tb_processos_complemento");
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
"idParentProcessos=" . $idParent .
$queryPadrao . 
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