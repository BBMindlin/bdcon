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


//Resgate de variáveis
$id = ContadorUniversal::ContadorUniversalUpdate(1);
$idParent = $_POST["id_parent"];
$idTbCadastroUsuarioSelect = $_POST["idTbCadastroUsuarioSelect"];
$idTbHistoricoStatusSelect = $_POST["idTbHistoricoStatusSelect"];

$idTbCadastroUsuario = $_POST["id_tb_cadastro_usuario"];
if($idTbCadastroUsuario == "")
{
	$idTbCadastroUsuario = 0;
}

$dataAtual = "";
if($configSistemaFormatoData == 1)
{
	$dataAtual = date("d") . "/" . date("m") . "/" . date("Y");
	
}
if($configSistemaFormatoData == 2)
{
	$dataAtual = date("m") . "/" . date("d") . "/" . date("Y");
}
if($GLOBALS['configCadastroHistoricoAdmDataEdicao'] == 0){
	$dataHistorico = Funcoes::DataGravacaoSql($dataAtual, $GLOBALS['configSistemaFormatoData']) . " " . date("H") . ":" . date("i") . ":" . date("s");
}
if($GLOBALS['configCadastroHistoricoAdmDataEdicao'] == 1){
	$dataHistorico = Funcoes::DataGravacaoSql($_POST["data_historico"], $GLOBALS['configSistemaFormatoData']) . " " . date("H") . ":" . date("i") . ":" . date("s");
}

$assunto = Funcoes::ConteudoMascaraGravacao01($_POST["assunto"]);
$historico = Funcoes::ConteudoMascaraGravacao01($_POST["historico"]);

$arrIdsHistoricoFiltroGenerico01 = $_POST["idsHistoricoFiltroGenerico01"];
$arrIdsHistoricoFiltroGenerico02 = $_POST["idsHistoricoFiltroGenerico02"];
$arrIdsHistoricoFiltroGenerico03 = $_POST["idsHistoricoFiltroGenerico03"];
$arrIdsHistoricoFiltroGenerico04 = $_POST["idsHistoricoFiltroGenerico04"];
$arrIdsHistoricoFiltroGenerico05 = $_POST["idsHistoricoFiltroGenerico05"];
$arrIdsHistoricoFiltroGenerico06 = $_POST["idsHistoricoFiltroGenerico06"];
$arrIdsHistoricoFiltroGenerico07 = $_POST["idsHistoricoFiltroGenerico07"];
$arrIdsHistoricoFiltroGenerico08 = $_POST["idsHistoricoFiltroGenerico08"];
$arrIdsHistoricoFiltroGenerico09 = $_POST["idsHistoricoFiltroGenerico09"];
$arrIdsHistoricoFiltroGenerico10 = $_POST["idsHistoricoFiltroGenerico10"];
$arrIdsHistoricoFiltroGenerico11 = $_POST["idsHistoricoFiltroGenerico11"];
$arrIdsHistoricoFiltroGenerico12 = $_POST["idsHistoricoFiltroGenerico12"];
$arrIdsHistoricoFiltroGenerico13 = $_POST["idsHistoricoFiltroGenerico13"];
$arrIdsHistoricoFiltroGenerico14 = $_POST["idsHistoricoFiltroGenerico14"];
$arrIdsHistoricoFiltroGenerico15 = $_POST["idsHistoricoFiltroGenerico15"];
$arrIdsHistoricoFiltroGenerico16 = $_POST["idsHistoricoFiltroGenerico16"];
$arrIdsHistoricoFiltroGenerico17 = $_POST["idsHistoricoFiltroGenerico17"];
$arrIdsHistoricoFiltroGenerico18 = $_POST["idsHistoricoFiltroGenerico18"];
$arrIdsHistoricoFiltroGenerico19 = $_POST["idsHistoricoFiltroGenerico19"];
$arrIdsHistoricoFiltroGenerico20 = $_POST["idsHistoricoFiltroGenerico20"];
$arrIdsHistoricoFiltroGenerico21 = $_POST["idsHistoricoFiltroGenerico21"];
$arrIdsHistoricoFiltroGenerico22 = $_POST["idsHistoricoFiltroGenerico22"];
$arrIdsHistoricoFiltroGenerico23 = $_POST["idsHistoricoFiltroGenerico23"];
$arrIdsHistoricoFiltroGenerico24 = $_POST["idsHistoricoFiltroGenerico24"];
$arrIdsHistoricoFiltroGenerico25 = $_POST["idsHistoricoFiltroGenerico25"];
$arrIdsHistoricoFiltroGenerico26 = $_POST["idsHistoricoFiltroGenerico26"];
$arrIdsHistoricoFiltroGenerico27 = $_POST["idsHistoricoFiltroGenerico27"];
$arrIdsHistoricoFiltroGenerico28 = $_POST["idsHistoricoFiltroGenerico28"];
$arrIdsHistoricoFiltroGenerico29 = $_POST["idsHistoricoFiltroGenerico29"];
$arrIdsHistoricoFiltroGenerico30 = $_POST["idsHistoricoFiltroGenerico30"];
$arrIdsHistoricoFiltroGenerico31 = $_POST["idsHistoricoFiltroGenerico31"];
$arrIdsHistoricoFiltroGenerico32 = $_POST["idsHistoricoFiltroGenerico32"];
$arrIdsHistoricoFiltroGenerico33 = $_POST["idsHistoricoFiltroGenerico33"];
$arrIdsHistoricoFiltroGenerico34 = $_POST["idsHistoricoFiltroGenerico34"];
$arrIdsHistoricoFiltroGenerico35 = $_POST["idsHistoricoFiltroGenerico35"];
$arrIdsHistoricoFiltroGenerico36 = $_POST["idsHistoricoFiltroGenerico36"];
$arrIdsHistoricoFiltroGenerico37 = $_POST["idsHistoricoFiltroGenerico37"];
$arrIdsHistoricoFiltroGenerico38 = $_POST["idsHistoricoFiltroGenerico38"];
$arrIdsHistoricoFiltroGenerico39 = $_POST["idsHistoricoFiltroGenerico39"];
$arrIdsHistoricoFiltroGenerico40 = $_POST["idsHistoricoFiltroGenerico40"];
$arrIdsHistoricoFiltroGenerico41 = $_POST["idsHistoricoFiltroGenerico41"];
$arrIdsHistoricoFiltroGenerico42 = $_POST["idsHistoricoFiltroGenerico42"];
$arrIdsHistoricoFiltroGenerico43 = $_POST["idsHistoricoFiltroGenerico43"];
$arrIdsHistoricoFiltroGenerico44 = $_POST["idsHistoricoFiltroGenerico44"];
$arrIdsHistoricoFiltroGenerico45 = $_POST["idsHistoricoFiltroGenerico45"];
$arrIdsHistoricoFiltroGenerico46 = $_POST["idsHistoricoFiltroGenerico46"];
$arrIdsHistoricoFiltroGenerico47 = $_POST["idsHistoricoFiltroGenerico47"];
$arrIdsHistoricoFiltroGenerico48 = $_POST["idsHistoricoFiltroGenerico48"];
$arrIdsHistoricoFiltroGenerico49 = $_POST["idsHistoricoFiltroGenerico49"];
$arrIdsHistoricoFiltroGenerico50 = $_POST["idsHistoricoFiltroGenerico50"];
$arrIdsHistoricoFiltroGenerico51 = $_POST["idsHistoricoFiltroGenerico51"];
$arrIdsHistoricoFiltroGenerico52 = $_POST["idsHistoricoFiltroGenerico52"];
$arrIdsHistoricoFiltroGenerico53 = $_POST["idsHistoricoFiltroGenerico53"];
$arrIdsHistoricoFiltroGenerico54 = $_POST["idsHistoricoFiltroGenerico54"];
$arrIdsHistoricoFiltroGenerico55 = $_POST["idsHistoricoFiltroGenerico55"];
$arrIdsHistoricoFiltroGenerico56 = $_POST["idsHistoricoFiltroGenerico56"];
$arrIdsHistoricoFiltroGenerico57 = $_POST["idsHistoricoFiltroGenerico57"];
$arrIdsHistoricoFiltroGenerico58 = $_POST["idsHistoricoFiltroGenerico58"];
$arrIdsHistoricoFiltroGenerico59 = $_POST["idsHistoricoFiltroGenerico59"];
$arrIdsHistoricoFiltroGenerico60 = $_POST["idsHistoricoFiltroGenerico60"];
$arrIdsHistoricoFiltroGenerico61 = $_POST["idsHistoricoFiltroGenerico61"];
$arrIdsHistoricoFiltroGenerico62 = $_POST["idsHistoricoFiltroGenerico62"];
$arrIdsHistoricoFiltroGenerico63 = $_POST["idsHistoricoFiltroGenerico63"];
$arrIdsHistoricoFiltroGenerico64 = $_POST["idsHistoricoFiltroGenerico64"];
$arrIdsHistoricoFiltroGenerico65 = $_POST["idsHistoricoFiltroGenerico65"];
$arrIdsHistoricoFiltroGenerico66 = $_POST["idsHistoricoFiltroGenerico66"];
$arrIdsHistoricoFiltroGenerico67 = $_POST["idsHistoricoFiltroGenerico67"];
$arrIdsHistoricoFiltroGenerico68 = $_POST["idsHistoricoFiltroGenerico68"];
$arrIdsHistoricoFiltroGenerico69 = $_POST["idsHistoricoFiltroGenerico69"];
$arrIdsHistoricoFiltroGenerico70 = $_POST["idsHistoricoFiltroGenerico70"];
$arrIdsHistoricoFiltroGenerico71 = $_POST["idsHistoricoFiltroGenerico71"];
$arrIdsHistoricoFiltroGenerico72 = $_POST["idsHistoricoFiltroGenerico72"];
$arrIdsHistoricoFiltroGenerico73 = $_POST["idsHistoricoFiltroGenerico73"];
$arrIdsHistoricoFiltroGenerico74 = $_POST["idsHistoricoFiltroGenerico74"];
$arrIdsHistoricoFiltroGenerico75 = $_POST["idsHistoricoFiltroGenerico75"];
$arrIdsHistoricoFiltroGenerico76 = $_POST["idsHistoricoFiltroGenerico76"];
$arrIdsHistoricoFiltroGenerico77 = $_POST["idsHistoricoFiltroGenerico77"];
$arrIdsHistoricoFiltroGenerico78 = $_POST["idsHistoricoFiltroGenerico78"];
$arrIdsHistoricoFiltroGenerico79 = $_POST["idsHistoricoFiltroGenerico79"];
$arrIdsHistoricoFiltroGenerico80 = $_POST["idsHistoricoFiltroGenerico80"];

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

$idTbHistoricoStatus = $_POST["id_tb_historico_status"];
if($idTbHistoricoStatus == "")
{
	$idTbHistoricoStatus = 0;
}


$paginaRetorno = $_POST["paginaRetorno"];
$variavelRetorno = $_POST["variavelRetorno"];
$variavelRetornoValor = $_POST["variavelRetornoValor"];
$masterPageSiteSelect = $_POST["masterPageSiteSelect"];
$mensagemErro = "";
$mensagemSucesso = "";

//Montagem de query padrão de retorno.
$queryPadrao = "&masterPageSiteSelect=" . $masterPageSiteSelect . 
"&idTbCadastroUsuarioSelect=" . $idTbCadastroUsuarioSelect . 
"&idTbHistoricoStatusSelect=" . $idTbHistoricoStatusSelect . 
"&" . $variavelRetorno . "=" . $variavelRetornoValor;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Inclusão de registro no BD.
//----------
$strSqlHistoricoInsert = "";
$strSqlHistoricoInsert .= "INSERT INTO tb_historico ";
$strSqlHistoricoInsert .= "SET ";
$strSqlHistoricoInsert .= "id = :id, ";
$strSqlHistoricoInsert .= "id_parent = :id_parent, ";
$strSqlHistoricoInsert .= "id_tb_cadastro_usuario = :id_tb_cadastro_usuario, ";
$strSqlHistoricoInsert .= "data_historico = :data_historico, ";
$strSqlHistoricoInsert .= "assunto = :assunto, ";
$strSqlHistoricoInsert .= "historico = :historico, ";
$strSqlHistoricoInsert .= "id_tb_cadastro1 = :id_tb_cadastro1, ";
$strSqlHistoricoInsert .= "id_tb_cadastro2 = :id_tb_cadastro2, ";
$strSqlHistoricoInsert .= "id_tb_cadastro3 = :id_tb_cadastro3, ";
$strSqlHistoricoInsert .= "informacao_complementar1 = :informacao_complementar1, ";
$strSqlHistoricoInsert .= "informacao_complementar2 = :informacao_complementar2, ";
$strSqlHistoricoInsert .= "informacao_complementar3 = :informacao_complementar3, ";
$strSqlHistoricoInsert .= "informacao_complementar4 = :informacao_complementar4, ";
$strSqlHistoricoInsert .= "informacao_complementar5 = :informacao_complementar5, ";
$strSqlHistoricoInsert .= "informacao_complementar6 = :informacao_complementar6, ";
$strSqlHistoricoInsert .= "informacao_complementar7 = :informacao_complementar7, ";
$strSqlHistoricoInsert .= "informacao_complementar8 = :informacao_complementar8, ";
$strSqlHistoricoInsert .= "informacao_complementar9 = :informacao_complementar9, ";
$strSqlHistoricoInsert .= "informacao_complementar10 = :informacao_complementar10, ";
$strSqlHistoricoInsert .= "informacao_complementar11 = :informacao_complementar11, ";
$strSqlHistoricoInsert .= "informacao_complementar12 = :informacao_complementar12, ";
$strSqlHistoricoInsert .= "informacao_complementar13 = :informacao_complementar13, ";
$strSqlHistoricoInsert .= "informacao_complementar14 = :informacao_complementar14, ";
$strSqlHistoricoInsert .= "informacao_complementar15 = :informacao_complementar15, ";
$strSqlHistoricoInsert .= "informacao_complementar16 = :informacao_complementar16, ";
$strSqlHistoricoInsert .= "informacao_complementar17 = :informacao_complementar17, ";
$strSqlHistoricoInsert .= "informacao_complementar18 = :informacao_complementar18, ";
$strSqlHistoricoInsert .= "informacao_complementar19 = :informacao_complementar19, ";
$strSqlHistoricoInsert .= "informacao_complementar20 = :informacao_complementar20, ";
$strSqlHistoricoInsert .= "informacao_complementar21 = :informacao_complementar21, ";
$strSqlHistoricoInsert .= "informacao_complementar22 = :informacao_complementar22, ";
$strSqlHistoricoInsert .= "informacao_complementar23 = :informacao_complementar23, ";
$strSqlHistoricoInsert .= "informacao_complementar24 = :informacao_complementar24, ";
$strSqlHistoricoInsert .= "informacao_complementar25 = :informacao_complementar25, ";
$strSqlHistoricoInsert .= "informacao_complementar26 = :informacao_complementar26, ";
$strSqlHistoricoInsert .= "informacao_complementar27 = :informacao_complementar27, ";
$strSqlHistoricoInsert .= "informacao_complementar28 = :informacao_complementar28, ";
$strSqlHistoricoInsert .= "informacao_complementar29 = :informacao_complementar29, ";
$strSqlHistoricoInsert .= "informacao_complementar30 = :informacao_complementar30, ";
$strSqlHistoricoInsert .= "informacao_complementar31 = :informacao_complementar31, ";
$strSqlHistoricoInsert .= "informacao_complementar32 = :informacao_complementar32, ";
$strSqlHistoricoInsert .= "informacao_complementar33 = :informacao_complementar33, ";
$strSqlHistoricoInsert .= "informacao_complementar34 = :informacao_complementar34, ";
$strSqlHistoricoInsert .= "informacao_complementar35 = :informacao_complementar35, ";
$strSqlHistoricoInsert .= "informacao_complementar36 = :informacao_complementar36, ";
$strSqlHistoricoInsert .= "informacao_complementar37 = :informacao_complementar37, ";
$strSqlHistoricoInsert .= "informacao_complementar38 = :informacao_complementar38, ";
$strSqlHistoricoInsert .= "informacao_complementar39 = :informacao_complementar39, ";
$strSqlHistoricoInsert .= "informacao_complementar40 = :informacao_complementar40, ";
$strSqlHistoricoInsert .= "informacao_complementar41 = :informacao_complementar41, ";
$strSqlHistoricoInsert .= "informacao_complementar42 = :informacao_complementar42, ";
$strSqlHistoricoInsert .= "informacao_complementar43 = :informacao_complementar43, ";
$strSqlHistoricoInsert .= "informacao_complementar44 = :informacao_complementar44, ";
$strSqlHistoricoInsert .= "informacao_complementar45 = :informacao_complementar45, ";
$strSqlHistoricoInsert .= "informacao_complementar46 = :informacao_complementar46, ";
$strSqlHistoricoInsert .= "informacao_complementar47 = :informacao_complementar47, ";
$strSqlHistoricoInsert .= "informacao_complementar48 = :informacao_complementar48, ";
$strSqlHistoricoInsert .= "informacao_complementar49 = :informacao_complementar49, ";
$strSqlHistoricoInsert .= "informacao_complementar50 = :informacao_complementar50, ";
$strSqlHistoricoInsert .= "informacao_complementar51 = :informacao_complementar51, ";
$strSqlHistoricoInsert .= "informacao_complementar52 = :informacao_complementar52, ";
$strSqlHistoricoInsert .= "informacao_complementar53 = :informacao_complementar53, ";
$strSqlHistoricoInsert .= "informacao_complementar54 = :informacao_complementar54, ";
$strSqlHistoricoInsert .= "informacao_complementar55 = :informacao_complementar55, ";
$strSqlHistoricoInsert .= "informacao_complementar56 = :informacao_complementar56, ";
$strSqlHistoricoInsert .= "informacao_complementar57 = :informacao_complementar57, ";
$strSqlHistoricoInsert .= "informacao_complementar58 = :informacao_complementar58, ";
$strSqlHistoricoInsert .= "informacao_complementar59 = :informacao_complementar59, ";
$strSqlHistoricoInsert .= "informacao_complementar60 = :informacao_complementar60, ";
$strSqlHistoricoInsert .= "ativacao = 1, ";
$strSqlHistoricoInsert .= "id_tb_historico_status = :id_tb_historico_status ";
//----------


//Parâmetros.
//----------
$statementHistoricoInsert = $dbSistemaConPDO->prepare($strSqlHistoricoInsert);

if ($statementHistoricoInsert !== false)
{
	$statementHistoricoInsert->execute(array(
		"id" => $id,
		"id_parent" => $idParent,
		"id_tb_cadastro_usuario" => $idTbCadastroUsuario,
		"data_historico" => $dataHistorico,
		"assunto" => $assunto,
		"historico" => $historico,
		"id_tb_cadastro1" => $idTbCadastro1,
		"id_tb_cadastro2" => $idTbCadastro2,
		"id_tb_cadastro3" => $idTbCadastro3,
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
		"id_tb_historico_status" => $idTbHistoricoStatus
	));
	
	$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus2");
	//Obs: Colocar um flag de verificação de gravação.
}else{
	//echo "erro";
	$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus3");
}
//----------


//Gravação de complementos.
//----------
//Filtro genérico 01.
if(!empty($arrIdsHistoricoFiltroGenerico01))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico01); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico01[$countArray], "12", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 02.
if(!empty($arrIdsHistoricoFiltroGenerico02))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico02); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico02[$countArray], "13", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 03.
if(!empty($arrIdsHistoricoFiltroGenerico03))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico03); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico03[$countArray], "14", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 04.
if(!empty($arrIdsHistoricoFiltroGenerico04))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico04); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico04[$countArray], "15", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 05.
if(!empty($arrIdsHistoricoFiltroGenerico05))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico05); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico05[$countArray], "16", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 06.
if(!empty($arrIdsHistoricoFiltroGenerico06))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico06); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico06[$countArray], "17", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 07.
if(!empty($arrIdsHistoricoFiltroGenerico07))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico07); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico07[$countArray], "18", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 08.
if(!empty($arrIdsHistoricoFiltroGenerico08))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico08); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico08[$countArray], "19", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 09.
if(!empty($arrIdsHistoricoFiltroGenerico09))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico09); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico09[$countArray], "20", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 10.
if(!empty($arrIdsHistoricoFiltroGenerico10))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico10); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico10[$countArray], "21", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 11.
if(!empty($arrIdsHistoricoFiltroGenerico11))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico11); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico11[$countArray], "22", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 12.
if(!empty($arrIdsHistoricoFiltroGenerico12))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico12); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico12[$countArray], "23", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 13.
if(!empty($arrIdsHistoricoFiltroGenerico13))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico13); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico13[$countArray], "24", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 14.
if(!empty($arrIdsHistoricoFiltroGenerico14))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico14); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico14[$countArray], "25", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 15.
if(!empty($arrIdsHistoricoFiltroGenerico15))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico15); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico15[$countArray], "26", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 16.
if(!empty($arrIdsHistoricoFiltroGenerico16))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico16); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico16[$countArray], "27", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 17.
if(!empty($arrIdsHistoricoFiltroGenerico17))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico17); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico17[$countArray], "28", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 18.
if(!empty($arrIdsHistoricoFiltroGenerico18))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico18); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico18[$countArray], "29", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 19.
if(!empty($arrIdsHistoricoFiltroGenerico19))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico19); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico19[$countArray], "30", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 20.
if(!empty($arrIdsHistoricoFiltroGenerico20))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico20); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico20[$countArray], "31", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 21.
if(!empty($arrIdsHistoricoFiltroGenerico21))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico21); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico21[$countArray], "32", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 22.
if(!empty($arrIdsHistoricoFiltroGenerico22))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico22); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico22[$countArray], "33", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 23.
if(!empty($arrIdsHistoricoFiltroGenerico23))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico23); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico23[$countArray], "34", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 24.
if(!empty($arrIdsHistoricoFiltroGenerico24))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico24); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico24[$countArray], "35", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 25.
if(!empty($arrIdsHistoricoFiltroGenerico25))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico25); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico25[$countArray], "36", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 26.
if(!empty($arrIdsHistoricoFiltroGenerico26))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico26); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico26[$countArray], "37", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 27.
if(!empty($arrIdsHistoricoFiltroGenerico27))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico27); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico27[$countArray], "38", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 28.
if(!empty($arrIdsHistoricoFiltroGenerico28))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico28); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico28[$countArray], "39", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 29.
if(!empty($arrIdsHistoricoFiltroGenerico29))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico29); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico29[$countArray], "40", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 30.
if(!empty($arrIdsHistoricoFiltroGenerico30))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico30); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico30[$countArray], "41", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 31.
if(!empty($arrIdsHistoricoFiltroGenerico31))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico31); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico31[$countArray], "42", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 32.
if(!empty($arrIdsHistoricoFiltroGenerico32))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico32); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico32[$countArray], "43", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 33.
if(!empty($arrIdsHistoricoFiltroGenerico33))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico33); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico33[$countArray], "44", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 34.
if(!empty($arrIdsHistoricoFiltroGenerico34))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico34); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico34[$countArray], "45", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 35.
if(!empty($arrIdsHistoricoFiltroGenerico35))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico35); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico35[$countArray], "46", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 36.
if(!empty($arrIdsHistoricoFiltroGenerico36))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico36); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico36[$countArray], "47", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 37.
if(!empty($arrIdsHistoricoFiltroGenerico37))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico37); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico37[$countArray], "48", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 38.
if(!empty($arrIdsHistoricoFiltroGenerico38))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico38); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico38[$countArray], "49", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 39.
if(!empty($arrIdsHistoricoFiltroGenerico39))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico39); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico39[$countArray], "50", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 40.
if(!empty($arrIdsHistoricoFiltroGenerico40))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico40); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico40[$countArray], "51", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 41.
if(!empty($arrIdsHistoricoFiltroGenerico41))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico41); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico41[$countArray], "52", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 42.
if(!empty($arrIdsHistoricoFiltroGenerico42))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico42); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico42[$countArray], "53", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 43.
if(!empty($arrIdsHistoricoFiltroGenerico43))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico43); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico43[$countArray], "54", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 44.
if(!empty($arrIdsHistoricoFiltroGenerico44))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico44); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico44[$countArray], "55", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 45.
if(!empty($arrIdsHistoricoFiltroGenerico45))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico45); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico45[$countArray], "56", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 46.
if(!empty($arrIdsHistoricoFiltroGenerico46))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico46); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico46[$countArray], "57", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 47.
if(!empty($arrIdsHistoricoFiltroGenerico47))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico47); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico47[$countArray], "58", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 48.
if(!empty($arrIdsHistoricoFiltroGenerico48))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico48); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico48[$countArray], "59", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 49.
if(!empty($arrIdsHistoricoFiltroGenerico49))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico49); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico49[$countArray], "60", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 50.
if(!empty($arrIdsHistoricoFiltroGenerico50))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico50); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico50[$countArray], "61", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 51.
if(!empty($arrIdsHistoricoFiltroGenerico51))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico51); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico51[$countArray], "62", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 52.
if(!empty($arrIdsHistoricoFiltroGenerico52))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico52); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico52[$countArray], "63", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 53.
if(!empty($arrIdsHistoricoFiltroGenerico53))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico53); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico53[$countArray], "64", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 54.
if(!empty($arrIdsHistoricoFiltroGenerico54))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico54); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico54[$countArray], "65", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 55.
if(!empty($arrIdsHistoricoFiltroGenerico55))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico55); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico55[$countArray], "66", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 56.
if(!empty($arrIdsHistoricoFiltroGenerico56))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico56); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico56[$countArray], "67", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 57.
if(!empty($arrIdsHistoricoFiltroGenerico57))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico57); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico57[$countArray], "68", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 58.
if(!empty($arrIdsHistoricoFiltroGenerico58))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico58); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico58[$countArray], "69", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 59.
if(!empty($arrIdsHistoricoFiltroGenerico59))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico59); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico59[$countArray], "70", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 60.
if(!empty($arrIdsHistoricoFiltroGenerico60))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico60); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico60[$countArray], "71", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 61.
if(!empty($arrIdsHistoricoFiltroGenerico61))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico61); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico61[$countArray], "72", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 62.
if(!empty($arrIdsHistoricoFiltroGenerico62))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico62); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico62[$countArray], "73", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 63.
if(!empty($arrIdsHistoricoFiltroGenerico63))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico63); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico63[$countArray], "74", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 64.
if(!empty($arrIdsHistoricoFiltroGenerico64))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico64); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico64[$countArray], "75", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 65.
if(!empty($arrIdsHistoricoFiltroGenerico65))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico65); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico65[$countArray], "76", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 66.
if(!empty($arrIdsHistoricoFiltroGenerico66))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico66); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico66[$countArray], "77", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 67.
if(!empty($arrIdsHistoricoFiltroGenerico67))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico67); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico67[$countArray], "78", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 68.
if(!empty($arrIdsHistoricoFiltroGenerico68))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico68); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico68[$countArray], "79", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 69.
if(!empty($arrIdsHistoricoFiltroGenerico69))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico69); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico69[$countArray], "80", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 70.
if(!empty($arrIdsHistoricoFiltroGenerico70))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico70); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico70[$countArray], "81", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 71.
if(!empty($arrIdsHistoricoFiltroGenerico71))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico71); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico71[$countArray], "82", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 72.
if(!empty($arrIdsHistoricoFiltroGenerico72))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico72); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico72[$countArray], "83", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 73.
if(!empty($arrIdsHistoricoFiltroGenerico73))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico73); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico73[$countArray], "84", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 74.
if(!empty($arrIdsHistoricoFiltroGenerico74))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico74); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico74[$countArray], "85", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 75.
if(!empty($arrIdsHistoricoFiltroGenerico75))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico75); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico75[$countArray], "86", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 76.
if(!empty($arrIdsHistoricoFiltroGenerico76))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico76); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico76[$countArray], "87", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 77.
if(!empty($arrIdsHistoricoFiltroGenerico77))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico77); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico77[$countArray], "88", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 78.
if(!empty($arrIdsHistoricoFiltroGenerico78))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico78); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico78[$countArray], "89", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 79.
if(!empty($arrIdsHistoricoFiltroGenerico79))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico79); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico79[$countArray], "90", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}


//Filtro genérico 80.
if(!empty($arrIdsHistoricoFiltroGenerico80))
{
	for($countArray = 0; $countArray < count($arrIdsHistoricoFiltroGenerico80); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsHistoricoFiltroGenerico80[$countArray], "91", "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento");
	}
}
//----------


//Envio de mensagem.
//**************************************************************************************
if($habilitarCadastroHistoricoEnvioAutomatico == 1)
{
	//Infomações do cadastro.
	//----------
	$idTbCadastroDestinatario = $idParent;
	$emailDestinatario = DbFuncoes::GetCampoGenerico01($idParent, "tb_cadastro", "email_principal");
	$nomeDestinatario = Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($idParent, "tb_cadastro", "nome"), 
			DbFuncoes::GetCampoGenerico01($idParent, "tb_cadastro", "razao_social"), 
			DbFuncoes::GetCampoGenerico01($idParent, "tb_cadastro", "nome_fantasia"), 
			1);
	//----------
	
	//Informações da mensagem.
	//----------
	$assuntoEmail = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoEnvioAssuntoEmail") . Funcoes::ConteudoMascaraLeitura(DbFuncoes::GetCampoGenerico01($id, "tb_historico", "assunto"));
	
	$emailCorpoMensagemTexto = Email::HistoricoConteudo($id, false);
	$emailCorpoMensagemHTML = Email::HistoricoConteudo($id, true);
	//----------

	
	//Envio de e-mail.
	//----------
	$resultadoEnvioEmail = Email::EnviarEmail($GLOBALS['configEmailRemetente'], 
					utf8_encode($GLOBALS['configEmailRemetenteNome']), 
					$emailDestinatario, 
					$nomeDestinatario, 
					"", 
					"", 
					"", 
					"", 
					$assuntoEmail, 
					$emailCorpoMensagemTexto, 
					$emailCorpoMensagemHTML, 
					0, 
					$GLOBALS['configFormatoEmail']);
					
	//$resultadoEnvioEmail = true; //teste			
					
	if($resultadoEnvioEmail == true)
	{
		
		//$mensagemSucesso = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus18");
		
		//Gravação de log.
		if(DbFuncoes::ItensEnviadosGravar(0, 
		$idTbCadastroDestinatario, 
		$id, 
		1, 
		0, 
		"tb_historico", 
		htmlentities($GLOBALS['configEmailRemetenteNome']), 
		$GLOBALS['configEmailRemetente'], 
		$nomeDestinatario, 
		$emailDestinatario, 
		$assuntoEmail, 
		$emailCorpoMensagemTexto, 
		"", 
		"") == true){
			
		}else{
			//Erro na gravação do log.
			//$mensagemErro = "Erro na gravação do log.";
		}	
		
	}else{
		//erro.
		$mensagemErro = "(" . $resultadoEnvioEmail . ")";
	}
	//----------
	
	
	//Cópia da mensagem - sistema.
	//----------
	if($habilitarCadastroHistoricoEnvioAutomaticoCopia == 1)
	{
		$idTbCadastroDestinatario = 0; //0 - Sistema.
		$emailDestinatario = $GLOBALS['configEmailDestinatario'];
		$nomeDestinatario = $GLOBALS['configEmailDestinatarioNome'];
				
		//Envio de e-mail.
		$resultadoEnvioEmail = Email::EnviarEmail($GLOBALS['configEmailRemetente'], 
						utf8_encode($GLOBALS['configEmailRemetenteNome']), 
						$emailDestinatario, 
						$nomeDestinatario, 
						"", 
						"", 
						"", 
						"", 
						$assuntoEmail, 
						$emailCorpoMensagemTexto, 
						$emailCorpoMensagemHTML, 
						0, 
						$GLOBALS['configFormatoEmail']);
					
						
		if($resultadoEnvioEmail == true)
		{
			
			//$mensagemSucesso = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus18");
			
		}else{
			//erro.
			$mensagemErro = "(" . $resultadoEnvioEmail . ")";
		}
	}
	//----------
	
	
	//Cópia da mensagem - cadastro (vínculo) - id_tb_cadastro1.
	//----------
	$tbCadastroIdTbCadastro1 = DbFuncoes::GetCampoGenerico01($idParent, "tb_cadastro", "id_tb_cadastro1");
	if($tbCadastroIdTbCadastro1 <> 0)
	{
		//Infomações do cadastro.
		$idTbCadastroDestinatario = $tbCadastroIdTbCadastro1;
		$emailDestinatario = DbFuncoes::GetCampoGenerico01($tbCadastroIdTbCadastro1, "tb_cadastro", "email_principal");
		$nomeDestinatario = Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($tbCadastroIdTbCadastro1, "tb_cadastro", "nome"), 
				DbFuncoes::GetCampoGenerico01($tbCadastroIdTbCadastro1, "tb_cadastro", "razao_social"), 
				DbFuncoes::GetCampoGenerico01($tbCadastroIdTbCadastro1, "tb_cadastro", "nome_fantasia"), 
				1);
				
		//Envio de e-mail.
		$resultadoEnvioEmail = Email::EnviarEmail($GLOBALS['configEmailRemetente'], 
						utf8_encode($GLOBALS['configEmailRemetenteNome']), 
						$emailDestinatario, 
						$nomeDestinatario, 
						"", 
						"", 
						"", 
						"", 
						$assuntoEmail, 
						$emailCorpoMensagemTexto, 
						$emailCorpoMensagemHTML, 
						0, 
						$GLOBALS['configFormatoEmail']);
					
						
		if($resultadoEnvioEmail == true)
		{
			
			//$mensagemSucesso = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus18");
			
		}else{
			//erro.
			$mensagemErro = "(" . $resultadoEnvioEmail . ")";
		}
	}
	//----------
	
	
	//Cópia da mensagem - histórico - usuário.
	//----------
	$tbHistoricoIdTbCadastroUsuario = DbFuncoes::GetCampoGenerico01($id, "tb_historico", "id_tb_cadastro_usuario");
	if($tbHistoricoIdTbCadastroUsuario <> 0)
	{
		//Infomações do cadastro.
		$idTbCadastroDestinatario = $tbHistoricoIdTbCadastroUsuario;
		$emailDestinatario = DbFuncoes::GetCampoGenerico01($tbHistoricoIdTbCadastroUsuario, "tb_cadastro", "email_principal");
		$nomeDestinatario = Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($tbHistoricoIdTbCadastroUsuario, "tb_cadastro", "nome"), 
				DbFuncoes::GetCampoGenerico01($tbHistoricoIdTbCadastroUsuario, "tb_cadastro", "razao_social"), 
				DbFuncoes::GetCampoGenerico01($tbHistoricoIdTbCadastroUsuario, "tb_cadastro", "nome_fantasia"), 
				1);
				
		//Envio de e-mail.
		$resultadoEnvioEmail = Email::EnviarEmail($GLOBALS['configEmailRemetente'], 
						utf8_encode($GLOBALS['configEmailRemetenteNome']), 
						$emailDestinatario, 
						$nomeDestinatario, 
						"", 
						"", 
						"", 
						"", 
						$assuntoEmail, 
						$emailCorpoMensagemTexto, 
						$emailCorpoMensagemHTML, 
						0, 
						$GLOBALS['configFormatoEmail']);
					
						
		if($resultadoEnvioEmail == true)
		{
			
			//$mensagemSucesso = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus18");
			
		}else{
			//erro.
			$mensagemErro = "(" . $resultadoEnvioEmail . ")";
		}
	}
	//----------
}
//**************************************************************************************


//Limpeza de objetos.
//----------
unset($strSqlHistoricoInsert);
unset($statementHistoricoInsert);
//----------


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
//$dbSistemaConMysqli->close();
$dbSistemaConPDO = null;


//Montagem do URL de retorno.
//$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
$URLRetorno = $configUrl . "/" . $visualizacaoAtivaSistema . "/" . $paginaRetorno . "?" .
"idParent=" . $idParent .
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