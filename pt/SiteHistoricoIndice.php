<?php
//Importação dos arquivos de configuração.
require_once "../sistema/IncludeConfig.php"; //Deve vir antes do db.
require_once "../sistema/IncludeConexao.php";
require_once "../sistema/IncludeFuncoes.php";
//require_once "IncludeLayout.php";
require_once "IncludeLayoutSite.php";


//Resgate de variáveis
$idParentHistorico = $_POST["idParentHistorico"];
$idsParentHistorico = $_POST["idsParentHistorico"];
$idsTbHistorico = $_POST["idsTbHistorico"];

$idTbHistoricoStatus = $_POST["idTbHistoricoStatus"];
$idTbCadastroUsuarioSelect = $_POST["idTbCadastroUsuarioSelect"];
$idTbHistoricoStatusSelect = $_POST["idTbHistoricoStatusSelect"];

$informacaoComplementar3 = $_POST["informacao_complementar3"];
$informacaoComplementar7 = $_POST["informacao_complementar7"];
$informacaoComplementar35 = $_POST["informacao_complementar35"];
$informacaoComplementar55 = $_POST["informacao_complementar55"];
$informacaoComplementar57 = $_POST["informacao_complementar57"];

$palavraChave = $_POST["palavraChave"];

$dataAtual = "";
if($configSistemaFormatoData == 1)
{
	$dataAtual = date("d") . "/" . date("m") . "/" . date("Y");
	
}
if($configSistemaFormatoData == 2)
{
	$dataAtual = date("m") . "/" . date("d") . "/" . date("Y");
}

$dataInicial = $_POST["dataInicial"];
$dataFinal = $_POST["dataFinal"];
$dataInicialConvert = strtotime(Funcoes::DataGravacaoSql($dataInicial, $GLOBALS['configSiteFormatoData']));
$dataFinalConvert = strtotime(Funcoes::DataGravacaoSql($dataFinal, $GLOBALS['configSiteFormatoData']));

//Definição de valores de variáveis.
if($dataInicial <> "" && $dataFinal <> "")
{
	//$diaDataInicial = $_POST["diaDataInicial"];
	//$mesDataInicial = $_POST["mesDataInicial"];
	//$anoDataInicial = $_POST["anoDataInicial"];
//}else{
	$diaDataInicial = date('d', $dataInicialConvert);
	$mesDataInicial = date('m', $dataInicialConvert);
	$anoDataInicial = date('Y', $dataInicialConvert);
	
	$diaDataFinal = date('d', $dataFinalConvert);
	$mesDataFinal = date('m', $dataFinalConvert);
	$anoDataFinal = date('Y', $dataFinalConvert);
}

//Busca detalhada - filtros.
$arrIdsHistoricoFiltroGenerico = array();

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

//Combinar arrays.
if(!empty($arrIdsHistoricoFiltroGenerico01) && $arrIdsHistoricoFiltroGenerico01[0] <> "")
{
	//array_merge($arrIdsHistoricoFiltroGenerico, $arrIdsHistoricoFiltroGenerico01);
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico01;
}
if(!empty($arrIdsHistoricoFiltroGenerico02) && $arrIdsHistoricoFiltroGenerico02[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico02;
}
if(!empty($arrIdsHistoricoFiltroGenerico03) && $arrIdsHistoricoFiltroGenerico03[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico03;
}
if(!empty($arrIdsHistoricoFiltroGenerico04) && $arrIdsHistoricoFiltroGenerico04[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico04;
}
if(!empty($arrIdsHistoricoFiltroGenerico05) && $arrIdsHistoricoFiltroGenerico05[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico05;
}
if(!empty($arrIdsHistoricoFiltroGenerico06) && $arrIdsHistoricoFiltroGenerico06[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico06;
}
if(!empty($arrIdsHistoricoFiltroGenerico07) && $arrIdsHistoricoFiltroGenerico07[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico07;
}
if(!empty($arrIdsHistoricoFiltroGenerico08) && $arrIdsHistoricoFiltroGenerico08[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico08;
}
if(!empty($arrIdsHistoricoFiltroGenerico09) && $arrIdsHistoricoFiltroGenerico09[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico09;
}
if(!empty($arrIdsHistoricoFiltroGenerico10) && $arrIdsHistoricoFiltroGenerico10[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico10;
}
if(!empty($arrIdsHistoricoFiltroGenerico11) && $arrIdsHistoricoFiltroGenerico11[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico11;
}
if(!empty($arrIdsHistoricoFiltroGenerico12) && $arrIdsHistoricoFiltroGenerico12[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico12;
}
if(!empty($arrIdsHistoricoFiltroGenerico13) && $arrIdsHistoricoFiltroGenerico13[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico13;
}
if(!empty($arrIdsHistoricoFiltroGenerico14) && $arrIdsHistoricoFiltroGenerico14[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico14;
}
if(!empty($arrIdsHistoricoFiltroGenerico15) && $arrIdsHistoricoFiltroGenerico15[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico15;
}
if(!empty($arrIdsHistoricoFiltroGenerico16) && $arrIdsHistoricoFiltroGenerico16[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico16;
}
if(!empty($arrIdsHistoricoFiltroGenerico17) && $arrIdsHistoricoFiltroGenerico17[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico17;
}
if(!empty($arrIdsHistoricoFiltroGenerico18) && $arrIdsHistoricoFiltroGenerico18[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico18;
}
if(!empty($arrIdsHistoricoFiltroGenerico19) && $arrIdsHistoricoFiltroGenerico19[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico19;
}
if(!empty($arrIdsHistoricoFiltroGenerico20) && $arrIdsHistoricoFiltroGenerico20[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico20;
}
if(!empty($arrIdsHistoricoFiltroGenerico21) && $arrIdsHistoricoFiltroGenerico21[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico21;
}
if(!empty($arrIdsHistoricoFiltroGenerico22) && $arrIdsHistoricoFiltroGenerico22[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico22;
}
if(!empty($arrIdsHistoricoFiltroGenerico23) && $arrIdsHistoricoFiltroGenerico23[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico23;
}
if(!empty($arrIdsHistoricoFiltroGenerico24) && $arrIdsHistoricoFiltroGenerico24[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico24;
}
if(!empty($arrIdsHistoricoFiltroGenerico25) && $arrIdsHistoricoFiltroGenerico25[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico25;
}
if(!empty($arrIdsHistoricoFiltroGenerico26) && $arrIdsHistoricoFiltroGenerico26[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico26;
}
if(!empty($arrIdsHistoricoFiltroGenerico27) && $arrIdsHistoricoFiltroGenerico27[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico27;
}
if(!empty($arrIdsHistoricoFiltroGenerico28) && $arrIdsHistoricoFiltroGenerico28[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico28;
}
if(!empty($arrIdsHistoricoFiltroGenerico29) && $arrIdsHistoricoFiltroGenerico29[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico29;
}
if(!empty($arrIdsHistoricoFiltroGenerico30) && $arrIdsHistoricoFiltroGenerico30[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico30;
}
if(!empty($arrIdsHistoricoFiltroGenerico31) && $arrIdsHistoricoFiltroGenerico31[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico31;
}
if(!empty($arrIdsHistoricoFiltroGenerico32) && $arrIdsHistoricoFiltroGenerico32[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico32;
}
if(!empty($arrIdsHistoricoFiltroGenerico33) && $arrIdsHistoricoFiltroGenerico33[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico33;
}
if(!empty($arrIdsHistoricoFiltroGenerico34) && $arrIdsHistoricoFiltroGenerico34[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico34;
}
if(!empty($arrIdsHistoricoFiltroGenerico35) && $arrIdsHistoricoFiltroGenerico35[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico35;
}
if(!empty($arrIdsHistoricoFiltroGenerico36) && $arrIdsHistoricoFiltroGenerico36[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico36;
}
if(!empty($arrIdsHistoricoFiltroGenerico37) && $arrIdsHistoricoFiltroGenerico37[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico37;
}
if(!empty($arrIdsHistoricoFiltroGenerico38) && $arrIdsHistoricoFiltroGenerico38[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico38;
}
if(!empty($arrIdsHistoricoFiltroGenerico39) && $arrIdsHistoricoFiltroGenerico39[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico39;
}
if(!empty($arrIdsHistoricoFiltroGenerico40) && $arrIdsHistoricoFiltroGenerico40[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico40;
}
if(!empty($arrIdsHistoricoFiltroGenerico41) && $arrIdsHistoricoFiltroGenerico41[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico41;
}
if(!empty($arrIdsHistoricoFiltroGenerico42) && $arrIdsHistoricoFiltroGenerico42[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico42;
}
if(!empty($arrIdsHistoricoFiltroGenerico43) && $arrIdsHistoricoFiltroGenerico43[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico43;
}
if(!empty($arrIdsHistoricoFiltroGenerico44) && $arrIdsHistoricoFiltroGenerico44[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico44;
}
if(!empty($arrIdsHistoricoFiltroGenerico45) && $arrIdsHistoricoFiltroGenerico45[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico45;
}
if(!empty($arrIdsHistoricoFiltroGenerico46) && $arrIdsHistoricoFiltroGenerico46[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico46;
}
if(!empty($arrIdsHistoricoFiltroGenerico47) && $arrIdsHistoricoFiltroGenerico47[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico47;
}
if(!empty($arrIdsHistoricoFiltroGenerico48) && $arrIdsHistoricoFiltroGenerico48[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico48;
}
if(!empty($arrIdsHistoricoFiltroGenerico49) && $arrIdsHistoricoFiltroGenerico49[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico49;
}
if(!empty($arrIdsHistoricoFiltroGenerico50) && $arrIdsHistoricoFiltroGenerico50[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico50;
}
if(!empty($arrIdsHistoricoFiltroGenerico51) && $arrIdsHistoricoFiltroGenerico51[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico51;
}
if(!empty($arrIdsHistoricoFiltroGenerico52) && $arrIdsHistoricoFiltroGenerico52[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico52;
}
if(!empty($arrIdsHistoricoFiltroGenerico53) && $arrIdsHistoricoFiltroGenerico53[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico53;
}
if(!empty($arrIdsHistoricoFiltroGenerico54) && $arrIdsHistoricoFiltroGenerico54[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico54;
}
if(!empty($arrIdsHistoricoFiltroGenerico55) && $arrIdsHistoricoFiltroGenerico55[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico55;
}
if(!empty($arrIdsHistoricoFiltroGenerico56) && $arrIdsHistoricoFiltroGenerico56[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico56;
}
if(!empty($arrIdsHistoricoFiltroGenerico57) && $arrIdsHistoricoFiltroGenerico57[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico57;
}
if(!empty($arrIdsHistoricoFiltroGenerico58) && $arrIdsHistoricoFiltroGenerico58[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico58;
}
if(!empty($arrIdsHistoricoFiltroGenerico59) && $arrIdsHistoricoFiltroGenerico59[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico59;
}
if(!empty($arrIdsHistoricoFiltroGenerico60) && $arrIdsHistoricoFiltroGenerico60[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico60;
}
if(!empty($arrIdsHistoricoFiltroGenerico61) && $arrIdsHistoricoFiltroGenerico61[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico61;
}
if(!empty($arrIdsHistoricoFiltroGenerico62) && $arrIdsHistoricoFiltroGenerico62[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico62;
}
if(!empty($arrIdsHistoricoFiltroGenerico63) && $arrIdsHistoricoFiltroGenerico63[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico63;
}
if(!empty($arrIdsHistoricoFiltroGenerico64) && $arrIdsHistoricoFiltroGenerico64[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico64;
}
if(!empty($arrIdsHistoricoFiltroGenerico65) && $arrIdsHistoricoFiltroGenerico65[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico65;
}
if(!empty($arrIdsHistoricoFiltroGenerico66) && $arrIdsHistoricoFiltroGenerico66[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico66;
}
if(!empty($arrIdsHistoricoFiltroGenerico67) && $arrIdsHistoricoFiltroGenerico67[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico67;
}
if(!empty($arrIdsHistoricoFiltroGenerico68) && $arrIdsHistoricoFiltroGenerico68[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico68;
}
if(!empty($arrIdsHistoricoFiltroGenerico69) && $arrIdsHistoricoFiltroGenerico69[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico69;
}
if(!empty($arrIdsHistoricoFiltroGenerico70) && $arrIdsHistoricoFiltroGenerico70[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico70;
}
if(!empty($arrIdsHistoricoFiltroGenerico71) && $arrIdsHistoricoFiltroGenerico71[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico71;
}
if(!empty($arrIdsHistoricoFiltroGenerico72) && $arrIdsHistoricoFiltroGenerico72[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico72;
}
if(!empty($arrIdsHistoricoFiltroGenerico73) && $arrIdsHistoricoFiltroGenerico73[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico73;
}
if(!empty($arrIdsHistoricoFiltroGenerico74) && $arrIdsHistoricoFiltroGenerico74[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico74;
}
if(!empty($arrIdsHistoricoFiltroGenerico75) && $arrIdsHistoricoFiltroGenerico75[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico75;
}
if(!empty($arrIdsHistoricoFiltroGenerico76) && $arrIdsHistoricoFiltroGenerico76[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico76;
}
if(!empty($arrIdsHistoricoFiltroGenerico77) && $arrIdsHistoricoFiltroGenerico77[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico77;
}
if(!empty($arrIdsHistoricoFiltroGenerico78) && $arrIdsHistoricoFiltroGenerico78[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico78;
}
if(!empty($arrIdsHistoricoFiltroGenerico79) && $arrIdsHistoricoFiltroGenerico79[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico79;
}
if(!empty($arrIdsHistoricoFiltroGenerico80) && $arrIdsHistoricoFiltroGenerico80[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico80;
}

if(!empty($arrIdsHistoricoFiltroGenerico))
{
	/**/
	if($idsTbHistorico <> "")
	{
		//Lógica or.
		/*$idsTbVeiculos .= "," . DbFuncoes::GetIdsByTipoComplemento_FromArray(implode(",",$arrIdsVeiculosFiltroGenerico), 
																			"tb_cadastro_relacao_complemento", 
																			"id_tb_cadastro_complemento", 
																			"id_tb_cadastro");*/
																			
		//Lógica and.
		$idsTbHistorico .= "," . DbFuncoes::GetIdsByTipoComplemento_FromArray02(implode(",",$arrIdsHistoricoFiltroGenerico), 
																			"tb_historico_relacao_complemento", 
																			"id_tb_historico_complemento", 
																			"id_tb_historico", 
																			"2");
	}else{
		//Lógica or.
		/*$idsTbVeiculos .= DbFuncoes::GetIdsByTipoComplemento_FromArray(implode(",",$arrIdsVeiculosFiltroGenerico), 
																		"tb_cadastro_relacao_complemento", 
																		"id_tb_cadastro_complemento", 
																		"id_tb_cadastro");*/
																		
		//Lógica and.
		$idsTbHistorico .= DbFuncoes::GetIdsByTipoComplemento_FromArray02(implode(",",$arrIdsHistoricoFiltroGenerico), 
																		"tb_historico_relacao_complemento", 
																		"id_tb_historico_complemento", 
																		"id_tb_historico", 
																		"2");
	}
	
	if($idsTbHistorico == "")
	{
		$idsTbHistorico = "0";
	}
}


//Obras.
//----------
//$idsTbProdutos = $_POST["idsTbProdutos"];
$idsTbProdutos = "";

$produto = $_POST["produto"];
$informacaoComplementar1 = $_POST["informacao_complementar1"]; //Obs: Atenção para não dar conflito me futura alteração que leve em conta informacao_complementar1 no nível do histório.
$informacaoComplementar12 = $_POST["informacao_complementar12"]; 

//Busca detalhada - filtros.
$arrIdsProdutosFiltroGenerico = array();

$idsProdutosTipo = $_POST["idsProdutosTipo"];

$arrIdsProdutosFiltroGenerico01 = $_POST["idsProdutosFiltroGenerico01"];
$arrIdsProdutosFiltroGenerico02 = $_POST["idsProdutosFiltroGenerico02"];
$arrIdsProdutosFiltroGenerico03 = $_POST["idsProdutosFiltroGenerico03"];
$arrIdsProdutosFiltroGenerico04 = $_POST["idsProdutosFiltroGenerico04"];
$arrIdsProdutosFiltroGenerico05 = $_POST["idsProdutosFiltroGenerico05"];
$arrIdsProdutosFiltroGenerico06 = $_POST["idsProdutosFiltroGenerico06"];
$arrIdsProdutosFiltroGenerico07 = $_POST["idsProdutosFiltroGenerico07"];
$arrIdsProdutosFiltroGenerico08 = $_POST["idsProdutosFiltroGenerico08"];
$arrIdsProdutosFiltroGenerico09 = $_POST["idsProdutosFiltroGenerico09"];
$arrIdsProdutosFiltroGenerico10 = $_POST["idsProdutosFiltroGenerico10"];
$arrIdsProdutosFiltroGenerico11 = $_POST["idsProdutosFiltroGenerico11"];
$arrIdsProdutosFiltroGenerico12 = $_POST["idsProdutosFiltroGenerico12"];
$arrIdsProdutosFiltroGenerico13 = $_POST["idsProdutosFiltroGenerico13"];
$arrIdsProdutosFiltroGenerico14 = $_POST["idsProdutosFiltroGenerico14"];
$arrIdsProdutosFiltroGenerico15 = $_POST["idsProdutosFiltroGenerico15"];
$arrIdsProdutosFiltroGenerico16 = $_POST["idsProdutosFiltroGenerico16"];
$arrIdsProdutosFiltroGenerico17 = $_POST["idsProdutosFiltroGenerico17"];
$arrIdsProdutosFiltroGenerico18 = $_POST["idsProdutosFiltroGenerico18"];
$arrIdsProdutosFiltroGenerico19 = $_POST["idsProdutosFiltroGenerico19"];
$arrIdsProdutosFiltroGenerico20 = $_POST["idsProdutosFiltroGenerico20"];
$arrIdsProdutosFiltroGenerico21 = $_POST["idsProdutosFiltroGenerico21"];
$arrIdsProdutosFiltroGenerico22 = $_POST["idsProdutosFiltroGenerico22"];
$arrIdsProdutosFiltroGenerico23 = $_POST["idsProdutosFiltroGenerico23"];
$arrIdsProdutosFiltroGenerico24 = $_POST["idsProdutosFiltroGenerico24"];
$arrIdsProdutosFiltroGenerico25 = $_POST["idsProdutosFiltroGenerico25"];
$arrIdsProdutosFiltroGenerico26 = $_POST["idsProdutosFiltroGenerico26"];
$arrIdsProdutosFiltroGenerico27 = $_POST["idsProdutosFiltroGenerico27"];
$arrIdsProdutosFiltroGenerico28 = $_POST["idsProdutosFiltroGenerico28"];
$arrIdsProdutosFiltroGenerico29 = $_POST["idsProdutosFiltroGenerico29"];
$arrIdsProdutosFiltroGenerico30 = $_POST["idsProdutosFiltroGenerico30"];

//Combinar arrays.
if(!empty($arrIdsProdutosFiltroGenerico01) && $idsProdutosTipo[0] <> "")
{
	//array_merge($arrIdsProdutosFiltroGenerico, $arrIdsProdutosFiltroGenerico01);
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $idsProdutosTipo;
}

if(!empty($arrIdsProdutosFiltroGenerico01) && $arrIdsProdutosFiltroGenerico01[0] <> "")
{
	//array_merge($arrIdsProdutosFiltroGenerico, $arrIdsProdutosFiltroGenerico01);
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico01;
}
if(!empty($arrIdsProdutosFiltroGenerico02) && $arrIdsProdutosFiltroGenerico02[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico02;
}
if(!empty($arrIdsProdutosFiltroGenerico03) && $arrIdsProdutosFiltroGenerico03[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico03;
}
if(!empty($arrIdsProdutosFiltroGenerico04) && $arrIdsProdutosFiltroGenerico04[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico04;
}
if(!empty($arrIdsProdutosFiltroGenerico05) && $arrIdsProdutosFiltroGenerico05[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico05;
}
if(!empty($arrIdsProdutosFiltroGenerico06) && $arrIdsProdutosFiltroGenerico06[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico06;
}
if(!empty($arrIdsProdutosFiltroGenerico07) && $arrIdsProdutosFiltroGenerico07[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico07;
}
if(!empty($arrIdsProdutosFiltroGenerico08) && $arrIdsProdutosFiltroGenerico08[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico08;
}
if(!empty($arrIdsProdutosFiltroGenerico09) && $arrIdsProdutosFiltroGenerico09[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico09;
}
if(!empty($arrIdsProdutosFiltroGenerico10) && $arrIdsProdutosFiltroGenerico10[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico10;
}
if(!empty($arrIdsProdutosFiltroGenerico11) && $arrIdsProdutosFiltroGenerico11[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico11;
}
if(!empty($arrIdsProdutosFiltroGenerico12) && $arrIdsProdutosFiltroGenerico12[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico12;
}
if(!empty($arrIdsProdutosFiltroGenerico13) && $arrIdsProdutosFiltroGenerico13[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico13;
}
if(!empty($arrIdsProdutosFiltroGenerico14) && $arrIdsProdutosFiltroGenerico14[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico14;
}
if(!empty($arrIdsProdutosFiltroGenerico15) && $arrIdsProdutosFiltroGenerico15[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico15;
}
if(!empty($arrIdsProdutosFiltroGenerico16) && $arrIdsProdutosFiltroGenerico16[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico16;
}
if(!empty($arrIdsProdutosFiltroGenerico17) && $arrIdsProdutosFiltroGenerico17[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico17;
}
if(!empty($arrIdsProdutosFiltroGenerico18) && $arrIdsProdutosFiltroGenerico18[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico18;
}
if(!empty($arrIdsProdutosFiltroGenerico19) && $arrIdsProdutosFiltroGenerico19[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico19;
}
if(!empty($arrIdsProdutosFiltroGenerico20) && $arrIdsProdutosFiltroGenerico20[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico20;
}
if(!empty($arrIdsProdutosFiltroGenerico21) && $arrIdsProdutosFiltroGenerico21[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico21;
}
if(!empty($arrIdsProdutosFiltroGenerico22) && $arrIdsProdutosFiltroGenerico22[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico22;
}
if(!empty($arrIdsProdutosFiltroGenerico23) && $arrIdsProdutosFiltroGenerico23[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico23;
}
if(!empty($arrIdsProdutosFiltroGenerico24) && $arrIdsProdutosFiltroGenerico24[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico24;
}
if(!empty($arrIdsProdutosFiltroGenerico25) && $arrIdsProdutosFiltroGenerico25[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico25;
}
if(!empty($arrIdsProdutosFiltroGenerico26) && $arrIdsProdutosFiltroGenerico26[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico26;
}
if(!empty($arrIdsProdutosFiltroGenerico27) && $arrIdsProdutosFiltroGenerico27[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico27;
}
if(!empty($arrIdsProdutosFiltroGenerico28) && $arrIdsProdutosFiltroGenerico28[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico28;
}
if(!empty($arrIdsProdutosFiltroGenerico29) && $arrIdsProdutosFiltroGenerico29[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico29;
}
if(!empty($arrIdsProdutosFiltroGenerico30) && $arrIdsProdutosFiltroGenerico30[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico30;
}

if(!empty($arrIdsProdutosFiltroGenerico))
{
	/**/
	if($idsTbProdutos <> "")
	{
		//Lógica or.
		/*$idsTbVeiculos .= "," . DbFuncoes::GetIdsByTipoComplemento_FromArray(implode(",",$arrIdsVeiculosFiltroGenerico), 
																			"tb_cadastro_relacao_complemento", 
																			"id_tb_cadastro_complemento", 
																			"id_tb_cadastro");*/
																			
		//Lógica and.
		$idsTbProdutos .= "," . DbFuncoes::GetIdsByTipoComplemento_FromArray02(implode(",",$arrIdsProdutosFiltroGenerico), 
																			"tb_produtos_relacao_complemento", 
																			"id_tb_produtos_complemento", 
																			"id_tb_produtos", 
																			"2");
	}else{
		//Lógica or.
		/*$idsTbVeiculos .= DbFuncoes::GetIdsByTipoComplemento_FromArray(implode(",",$arrIdsVeiculosFiltroGenerico), 
																		"tb_cadastro_relacao_complemento", 
																		"id_tb_cadastro_complemento", 
																		"id_tb_cadastro");*/
																		
		//Lógica and.
		$idsTbProdutos .= DbFuncoes::GetIdsByTipoComplemento_FromArray02(implode(",",$arrIdsProdutosFiltroGenerico), 
																		"tb_produtos_relacao_complemento", 
																		"id_tb_produtos_complemento", 
																		"id_tb_produtos", 
																		"2");
	}
	
	if($idsTbProdutos == "")
	{
		$idsTbProdutos = "0";
	}
}


//Pesquisa com campos.
$arrPesquisaProdutos = array();
array_push($arrPesquisaProdutos, "id;0;!i");

if($produto <> "")
{
	array_push($arrPesquisaProdutos, "produto;" . $produto . ";like");
}
if($informacaoComplementar1 <> "")
{
	array_push($arrPesquisaProdutos, "informacao_complementar1;" . $informacaoComplementar1 . ";like");
}
if($informacaoComplementar12 <> "")
{
	array_push($arrPesquisaProdutos, "informacao_complementar12;" . $informacaoComplementar12 . ";like");
}
if($idsTbProdutos <> "")
{
	array_push($arrPesquisaProdutos, "id;" . $idsTbProdutos . ";ids");
}

$idsTbProdutosPesquisaCampos = DbFuncoes::GetCampoGenerico11("tb_produtos", 
															"id", 
															$arrPesquisaProdutos, 
															"", 
															"", 
															1,
															array());
//Transferência de variável.
if($idsTbProdutosPesquisaCampos <> "")
{
	$idsParentHistorico = $idsTbProdutosPesquisaCampos;
}else{
	$idsParentHistorico = $idsTbProdutos;
}


//Debug.
//echo "produto=" . $produto . "<br>";
//echo "informacaoComplementar1=" . $informacaoComplementar1 . "<br>";

//echo "idsTbProdutos=" . $idsTbProdutos . "<br>";
//echo "idsTbProdutosPesquisaCampos=" . $idsTbProdutosPesquisaCampos . "<br>";

//echo "arrIdsProdutosFiltroGenerico=<pre>";
//echo var_dump($arrIdsProdutosFiltroGenerico);
//echo "</pre><br>";

//echo "arrPesquisaProdutos=<pre>";
//echo var_dump($arrPesquisaProdutos);
//echo "</pre><br>";
//----------


//Configuração do relatório.
$relatoriosTipoVisualizacao = $_POST["relatoriosTipoVisualizacao"];
$relatoriosLegendas = $_POST["relatoriosLegendas"];
$relatoriosFontes = $_POST["relatoriosFontes"];
$resultadoTotalRegistros = DbFuncoes::TabelaGenericaFill01_FetchAll("tb_historico", 
																	array("id;0;!i"), 
																	"", 
																	"");

//Definição de exibição de colunas (diagramação tabela).
$arrExibirColunas = $_POST["relatoriosExibirColunas"];
if(empty($arrExibirColunas) == true)
{
	$arrExibirColunas = array("data_historico", "historico", "funcoes"); //padrão
}
array_push($arrExibirColunas, "data_historico", "data1", "tipo_produto", "data_produto", "id_tb_cadastro1", "id_tb_cadastro2", "id_tb_cadastro3"); //Adicionar parâmetros.
//array_push($arrExibirColunas, "data_historico", "data1", "historico_filtro_generico01", "historico_filtro_generico30", "historico_filtro_generico31", "historico_filtro_generico32", "historico_filtro_generico33", "historico_filtro_generico34", "historico_filtro_generico35", "historico_filtro_generico36", "historico_filtro_generico37", "historico_filtro_generico38", "historico_filtro_generico39", "historico_filtro_generico40"); //Debug.
//array_push($arrExibirColunas, "produto", "tipo_produto", "data_produto", "produtos_informacao_complementar1", "produtos_filtro_generico01", "produtos_filtro_generico02", "produtos_filtro_generico03", "produtos_filtro_generico04", "produtos_filtro_generico05", "produtos_filtro_generico08", "data_historico", "data1", "historico_filtro_generico01", "historico_filtro_generico30", "historico_filtro_generico31", "historico_filtro_generico32", "historico_filtro_generico33", "historico_filtro_generico34", "historico_filtro_generico35", "informacao_complementar1", "informacao_complementar2", "informacao_complementar3", "informacao_complementar4", "informacao_complementar5", "informacao_complementar6", "informacao_complementar7", "informacao_complementar8", "informacao_complementar9", "informacao_complementar10"); //Debug.


$paginaRetorno = "SiteHistoricoIndice.php";
$paginaRetornoExclusao = "SiteHistoricoIndice.php";
$variavelRetorno = "idParent";
$criterioClassificacao = "";
$mensagemErro = $_POST["mensagemErro"];
$mensagemSucesso = $_POST["mensagemSucesso"];

//Montagem de query padrão de retorno.
$queryPadrao = "&idParent=" . $idParent . 
"&paginaRetorno=" . $paginaRetorno . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&idTbHistoricoStatusSelect=" . $idTbHistoricoStatusSelect . 
"&masterPageSiteSelect=" . $masterPageSiteSelect . 
"&variavelRetorno=" . $variavelRetorno;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Query de pesquisa.
//----------
$strSqlHistoricoSelect = "";
$strSqlHistoricoSelect .= "SELECT ";
//$strSqlHistoricoSelect .= "* ";
$strSqlHistoricoSelect .= "id, ";
$strSqlHistoricoSelect .= "id_parent, ";
$strSqlHistoricoSelect .= "id_tb_cadastro_usuario, ";
$strSqlHistoricoSelect .= "data_historico, ";

if($GLOBALS['habilitarHistoricoData1'] == 1){
	$strSqlHistoricoSelect .= "data1, ";
}
if($GLOBALS['habilitarHistoricoData2'] == 1){
	$strSqlHistoricoSelect .= "data2, ";
}
if($GLOBALS['habilitarHistoricoData3'] == 1){
	$strSqlHistoricoSelect .= "data3, ";
}
if($GLOBALS['habilitarHistoricoData4'] == 1){
	$strSqlHistoricoSelect .= "data4, ";
}
if($GLOBALS['habilitarHistoricoData5'] == 1){
	$strSqlHistoricoSelect .= "data5, ";
}

$strSqlHistoricoSelect .= "assunto, ";
$strSqlHistoricoSelect .= "historico, ";

$strSqlHistoricoSelect .= "id_tb_cadastro1, ";
$strSqlHistoricoSelect .= "id_tb_cadastro2, ";
$strSqlHistoricoSelect .= "id_tb_cadastro3, ";

/*
$strSqlHistoricoSelect .= "informacao_complementar1, ";
$strSqlHistoricoSelect .= "informacao_complementar2, ";
$strSqlHistoricoSelect .= "informacao_complementar3, ";
$strSqlHistoricoSelect .= "informacao_complementar4, ";
$strSqlHistoricoSelect .= "informacao_complementar5, ";
$strSqlHistoricoSelect .= "informacao_complementar6, ";
$strSqlHistoricoSelect .= "informacao_complementar7, ";
$strSqlHistoricoSelect .= "informacao_complementar8, ";
$strSqlHistoricoSelect .= "informacao_complementar9, ";
$strSqlHistoricoSelect .= "informacao_complementar10, ";
*/
if($GLOBALS['habilitarHistoricoIc1'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar1, ";
}
if($GLOBALS['habilitarHistoricoIc2'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar2, ";
}
if($GLOBALS['habilitarHistoricoIc3'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar3, ";
}
if($GLOBALS['habilitarHistoricoIc4'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar4, ";
}
if($GLOBALS['habilitarHistoricoIc5'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar5, ";
}
if($GLOBALS['habilitarHistoricoIc6'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar6, ";
}
if($GLOBALS['habilitarHistoricoIc7'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar7, ";
}
if($GLOBALS['habilitarHistoricoIc8'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar8, ";
}
if($GLOBALS['habilitarHistoricoIc9'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar9, ";
}
if($GLOBALS['habilitarHistoricoIc10'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar10, ";
}
if($GLOBALS['habilitarHistoricoIc11'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar11, ";
}
if($GLOBALS['habilitarHistoricoIc12'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar12, ";
}
if($GLOBALS['habilitarHistoricoIc13'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar13, ";
}
if($GLOBALS['habilitarHistoricoIc14'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar14, ";
}
if($GLOBALS['habilitarHistoricoIc15'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar15, ";
}
if($GLOBALS['habilitarHistoricoIc16'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar16, ";
}
if($GLOBALS['habilitarHistoricoIc17'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar17, ";
}
if($GLOBALS['habilitarHistoricoIc18'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar18, ";
}
if($GLOBALS['habilitarHistoricoIc19'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar19, ";
}
if($GLOBALS['habilitarHistoricoIc20'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar20, ";
}
if($GLOBALS['habilitarHistoricoIc21'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar21, ";
}
if($GLOBALS['habilitarHistoricoIc22'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar22, ";
}
if($GLOBALS['habilitarHistoricoIc23'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar23, ";
}
if($GLOBALS['habilitarHistoricoIc24'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar24, ";
}
if($GLOBALS['habilitarHistoricoIc25'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar25, ";
}
if($GLOBALS['habilitarHistoricoIc26'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar26, ";
}
if($GLOBALS['habilitarHistoricoIc27'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar27, ";
}
if($GLOBALS['habilitarHistoricoIc28'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar28, ";
}
if($GLOBALS['habilitarHistoricoIc29'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar29, ";
}
if($GLOBALS['habilitarHistoricoIc30'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar30, ";
}
if($GLOBALS['habilitarHistoricoIc31'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar31, ";
}
if($GLOBALS['habilitarHistoricoIc32'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar32, ";
}
if($GLOBALS['habilitarHistoricoIc33'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar33, ";
}
if($GLOBALS['habilitarHistoricoIc34'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar34, ";
}
if($GLOBALS['habilitarHistoricoIc35'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar35, ";
}
if($GLOBALS['habilitarHistoricoIc36'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar36, ";
}
if($GLOBALS['habilitarHistoricoIc37'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar37, ";
}
if($GLOBALS['habilitarHistoricoIc38'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar38, ";
}
if($GLOBALS['habilitarHistoricoIc39'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar39, ";
}
if($GLOBALS['habilitarHistoricoIc40'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar40, ";
}
if($GLOBALS['habilitarHistoricoIc41'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar41, ";
}
if($GLOBALS['habilitarHistoricoIc42'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar42, ";
}
if($GLOBALS['habilitarHistoricoIc43'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar43, ";
}
if($GLOBALS['habilitarHistoricoIc44'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar44, ";
}
if($GLOBALS['habilitarHistoricoIc45'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar45, ";
}
if($GLOBALS['habilitarHistoricoIc46'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar46, ";
}
if($GLOBALS['habilitarHistoricoIc47'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar47, ";
}
if($GLOBALS['habilitarHistoricoIc48'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar48, ";
}
if($GLOBALS['habilitarHistoricoIc49'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar49, ";
}
if($GLOBALS['habilitarHistoricoIc50'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar50, ";
}
if($GLOBALS['habilitarHistoricoIc51'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar51, ";
}
if($GLOBALS['habilitarHistoricoIc52'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar52, ";
}
if($GLOBALS['habilitarHistoricoIc53'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar53, ";
}
if($GLOBALS['habilitarHistoricoIc54'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar54, ";
}
if($GLOBALS['habilitarHistoricoIc55'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar55, ";
}
if($GLOBALS['habilitarHistoricoIc56'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar56, ";
}
if($GLOBALS['habilitarHistoricoIc57'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar57, ";
}
if($GLOBALS['habilitarHistoricoIc58'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar58, ";
}
if($GLOBALS['habilitarHistoricoIc59'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar59, ";
}
if($GLOBALS['habilitarHistoricoIc60'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar60, ";
}

$strSqlHistoricoSelect .= "id_tb_historico_status ";
$strSqlHistoricoSelect .= "FROM tb_historico ";
$strSqlHistoricoSelect .= "WHERE id <> 0 ";
if($idParentHistorico <> "")
{
	$strSqlHistoricoSelect .= "AND id_parent = :id_parent ";
}
if($idsTbHistorico <> "")
{
	$strSqlHistoricoSelect .= "AND id IN (" . Funcoes::ConteudoMascaraGravacao01($idsTbHistorico) . ") ";
}
if($idsParentHistorico <> "")
{
	$strSqlHistoricoSelect .= "AND id_parent IN (" . Funcoes::ConteudoMascaraGravacao01($idsParentHistorico) . ") ";
}

if($idTbHistoricoStatus <> "")
{
	$strSqlHistoricoSelect .= "AND id_tb_historico_status = :id_tb_historico_status ";
}
if($dataInicial <> "" && $dataFinal <> "")
{
	$strSqlHistoricoSelect .= "AND data_historico BETWEEN '" . $anoDataInicial . "-" . $mesDataInicial . "-" . $diaDataInicial . "' AND '" . $anoDataFinal . "-" . $mesDataFinal . "-" . $diaDataFinal . "' ";
	//$strSqlHistoricoSelect .= "AND data_historico BETWEEN DATE(:dataInicial) AND DATE(:dataFinal) ";
	//$strSqlHistoricoSelect .= "AND data_historico BETWEEN :dataInicial AND :dataFinal ";
}

if($informacaoComplementar3 <> "")
{
	$strSqlHistoricoSelect .= "AND informacao_complementar3 = :informacao_complementar3 ";
}
if($informacaoComplementar7 <> "")
{
	$strSqlHistoricoSelect .= "AND informacao_complementar7 = :informacao_complementar7 ";
}
if($informacaoComplementar35 <> "")
{
	$strSqlHistoricoSelect .= "AND informacao_complementar35 = :informacao_complementar35 ";
}
if($informacaoComplementar55 <> "")
{
	$strSqlHistoricoSelect .= "AND informacao_complementar55 = :informacao_complementar55 ";
}
if($informacaoComplementar57 <> "")
{
	$strSqlHistoricoSelect .= "AND informacao_complementar57 = :informacao_complementar57 ";
}

if($palavraChave <> "")
{
	/*
	*/
	$strSqlHistoricoSelect .= "AND (assunto LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlHistoricoSelect .= "OR historico LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlHistoricoSelect .= "OR palavras_chave LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";

	if($GLOBALS['habilitarHistoricoIc1'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar1 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc2'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar2 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc3'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar3 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc4'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar4 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc5'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar5 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc6'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar6 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc7'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar7 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc8'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar8 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc9'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar9 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc10'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar10 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc11'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar11 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc12'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar12 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc13'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar13 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc14'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar14 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc15'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar15 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc16'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar16 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc17'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar17 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc18'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar18 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc19'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar19 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc20'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar20 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc21'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar21 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc22'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar22 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc23'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar23 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc24'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar24 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc25'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar25 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc26'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar26 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc27'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar27 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc28'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar28 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc29'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar29 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc30'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar30 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc31'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar31 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc32'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar32 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc33'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar33 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc34'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar34 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc35'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar35 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc36'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar36 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc37'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar37 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc38'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar38 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc39'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar39 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc40'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar40 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc41'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar41 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc42'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar42 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc43'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar43 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc44'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar44 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc45'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar45 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc46'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar46 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc47'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar47 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc48'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar48 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc49'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar49 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc50'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar50 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc51'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar51 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc52'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar52 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc53'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar53 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc54'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar54 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc55'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar55 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc56'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar56 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc57'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar57 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc58'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar58 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc59'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar59 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc60'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar60 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	
	$strSqlHistoricoSelect .= ") ";
}

$strSqlHistoricoSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastroHistorico'] . " ";
//echo "strSqlHistoricoSelect=" . $strSqlHistoricoSelect . "<br />";
//----------

//Criação de componentes e parâmetros.
//----------
$statementHistoricoSelect = $dbSistemaConPDO->prepare($strSqlHistoricoSelect);

if ($statementHistoricoSelect !== false)
{
	/*
	$statementHistoricoSelect->execute(array(
		"id_parent" => $idParent
	));
	*/
	if($idParentHistorico <> "")
	{
		$statementHistoricoSelect->bindParam(':id_parent', $idParentHistorico, PDO::PARAM_STR);
	}
	if($idTbHistoricoStatus <> "")
	{
		$statementHistoricoSelect->bindParam(':id_tb_historico_status', $idTbHistoricoStatus, PDO::PARAM_STR);
	}
	if($dataInicial <> "" && $dataFinal <> "")
	{
		//Não funcionou.
		//$statementHistoricoSelect->bindParam(':dataInicial', $anoDataInicial . "-" . $mesDataInicial . "-" . $diaDataInicial, PDO::PARAM_STR);
		//$statementHistoricoSelect->bindParam(':dataFinal', $anoDataInicial . "-" . $mesDataInicial . "-" . $diaDataInicial, PDO::PARAM_STR);
	}
	
	if($informacaoComplementar3 <> "")
	{
		$strSqlHistoricoSelect->bindParam(':informacao_complementar3', $informacaoComplementar3, PDO::PARAM_STR);
	}
	if($informacaoComplementar7 <> "")
	{
		$strSqlHistoricoSelect->bindParam(':informacao_complementar7', $informacaoComplementar7, PDO::PARAM_STR);
	}
	if($informacaoComplementar35 <> "")
	{
		$strSqlHistoricoSelect->bindParam(':informacao_complementar35', $informacaoComplementar35, PDO::PARAM_STR);
	}
	if($informacaoComplementar55 <> "")
	{
		$strSqlHistoricoSelect->bindParam(':informacao_complementar55', $informacaoComplementar55, PDO::PARAM_STR);
	}
	if($informacaoComplementar57 <> "")
	{
		$strSqlHistoricoSelect->bindParam(':informacao_complementar57', $informacaoComplementar57, PDO::PARAM_STR);
	}
	
	$statementHistoricoSelect->execute();
}

//$resultadoHistorico = $dbSistemaConPDO->query($strSqlHistoricoSelect);
$resultadoHistorico = $statementHistoricoSelect->fetchAll();
//----------


//Definição de variáveis.
//Filtros genéricos.
if($GLOBALS['habilitarProdutosTipo'] == "1")
{
	$arrProdutosTipo = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 2);
}
	
if($GLOBALS['habilitarProdutosFiltroGenerico01'] == 1)
{
	$arrProdutosFiltroGenerico01 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 12);
}
if($GLOBALS['habilitarProdutosFiltroGenerico02'] == 1)
{
	$arrProdutosFiltroGenerico02 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 13);
}
if($GLOBALS['habilitarProdutosFiltroGenerico03'] == 1)
{
	$arrProdutosFiltroGenerico03 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 14);
}
if($GLOBALS['habilitarProdutosFiltroGenerico04'] == 1)
{
	$arrProdutosFiltroGenerico04 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 15);
}
if($GLOBALS['habilitarProdutosFiltroGenerico05'] == 1)
{
	$arrProdutosFiltroGenerico05 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 16);
}
if($GLOBALS['habilitarProdutosFiltroGenerico06'] == 1)
{
	$arrProdutosFiltroGenerico06 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 17);
}
if($GLOBALS['habilitarProdutosFiltroGenerico07'] == 1)
{
	$arrProdutosFiltroGenerico07 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 18);
}
if($GLOBALS['habilitarProdutosFiltroGenerico08'] == 1)
{
	$arrProdutosFiltroGenerico08 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 19);
}
if($GLOBALS['habilitarProdutosFiltroGenerico09'] == 1)
{
	$arrProdutosFiltroGenerico09 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 20);
}
if($GLOBALS['habilitarProdutosFiltroGenerico10'] == 1)
{
	$arrProdutosFiltroGenerico10 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 21);
}
if($GLOBALS['habilitarProdutosFiltroGenerico11'] == 1)
{
	$arrProdutosFiltroGenerico11 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 22);
}
if($GLOBALS['habilitarProdutosFiltroGenerico12'] == 1)
{
	$arrProdutosFiltroGenerico12 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 23);
}
if($GLOBALS['habilitarProdutosFiltroGenerico13'] == 1)
{
	$arrProdutosFiltroGenerico13 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 24);
}
if($GLOBALS['habilitarProdutosFiltroGenerico14'] == 1)
{
	$arrProdutosFiltroGenerico14 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 25);
}
if($GLOBALS['habilitarProdutosFiltroGenerico15'] == 1)
{
	$arrProdutosFiltroGenerico15 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 26);
}
if($GLOBALS['habilitarProdutosFiltroGenerico16'] == 1)
{
	$arrProdutosFiltroGenerico16 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 27);
}
if($GLOBALS['habilitarProdutosFiltroGenerico17'] == 1)
{
	$arrProdutosFiltroGenerico17 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 28);
}
if($GLOBALS['habilitarProdutosFiltroGenerico18'] == 1)
{
	$arrProdutosFiltroGenerico18 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 29);
}
if($GLOBALS['habilitarProdutosFiltroGenerico19'] == 1)
{
	$arrProdutosFiltroGenerico19 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 30);
}
if($GLOBALS['habilitarProdutosFiltroGenerico20'] == 1)
{
	$arrProdutosFiltroGenerico20 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 31);
}
if($GLOBALS['habilitarProdutosFiltroGenerico21'] == 1)
{
	$arrProdutosFiltroGenerico21 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 32);
}
if($GLOBALS['habilitarProdutosFiltroGenerico22'] == 1)
{
	$arrProdutosFiltroGenerico22 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 33);
}
if($GLOBALS['habilitarProdutosFiltroGenerico23'] == 1)
{
	$arrProdutosFiltroGenerico23 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 34);
}
if($GLOBALS['habilitarProdutosFiltroGenerico24'] == 1)
{
	$arrProdutosFiltroGenerico24 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 35);
}
if($GLOBALS['habilitarProdutosFiltroGenerico25'] == 1)
{
	$arrProdutosFiltroGenerico25 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 36);
}
if($GLOBALS['habilitarProdutosFiltroGenerico26'] == 1)
{
	$arrProdutosFiltroGenerico26 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 37);
}
if($GLOBALS['habilitarProdutosFiltroGenerico27'] == 1)
{
	$arrProdutosFiltroGenerico27 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 38);
}
if($GLOBALS['habilitarProdutosFiltroGenerico28'] == 1)
{
	$arrProdutosFiltroGenerico28 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 39);
}
if($GLOBALS['habilitarProdutosFiltroGenerico29'] == 1)
{
	$arrProdutosFiltroGenerico28 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 40);
}
if($GLOBALS['habilitarProdutosFiltroGenerico30'] == 1)
{
	$arrProdutosFiltroGenerico28 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 41);
}



if($GLOBALS['habilitarHistoricoFiltroGenerico01'] == 1)
{
	$arrHistoricoFiltroGenerico01 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 12);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico02'] == 1)
{
	$arrHistoricoFiltroGenerico02 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 13);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico03'] == 1)
{
	$arrHistoricoFiltroGenerico03 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 14);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico04'] == 1)
{
	$arrHistoricoFiltroGenerico04 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 15);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico05'] == 1)
{
	$arrHistoricoFiltroGenerico05 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 16);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico06'] == 1)
{
	$arrHistoricoFiltroGenerico06 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 17);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico07'] == 1)
{
	$arrHistoricoFiltroGenerico07 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 18);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico08'] == 1)
{
	$arrHistoricoFiltroGenerico08 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 19);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico09'] == 1)
{
	$arrHistoricoFiltroGenerico09 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 20);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico10'] == 1)
{
	$arrHistoricoFiltroGenerico10 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 21);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico11'] == 1)
{
	$arrHistoricoFiltroGenerico11 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 22);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico12'] == 1)
{
	$arrHistoricoFiltroGenerico12 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 23);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico13'] == 1)
{
	$arrHistoricoFiltroGenerico13 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 24);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico14'] == 1)
{
	$arrHistoricoFiltroGenerico14 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 25);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico15'] == 1)
{
	$arrHistoricoFiltroGenerico15 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 26);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico16'] == 1)
{
	$arrHistoricoFiltroGenerico16 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 27);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico17'] == 1)
{
	$arrHistoricoFiltroGenerico17 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 28);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico18'] == 1)
{
	$arrHistoricoFiltroGenerico18 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 29);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico19'] == 1)
{
	$arrHistoricoFiltroGenerico19 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 30);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico20'] == 1)
{
	$arrHistoricoFiltroGenerico20 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 31);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico21'] == 1)
{
	$arrHistoricoFiltroGenerico21 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 32);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico22'] == 1)
{
	$arrHistoricoFiltroGenerico22 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 33);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico23'] == 1)
{
	$arrHistoricoFiltroGenerico23 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 34);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico24'] == 1)
{
	$arrHistoricoFiltroGenerico24 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 35);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico25'] == 1)
{
	$arrHistoricoFiltroGenerico25 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 36);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico26'] == 1)
{
	$arrHistoricoFiltroGenerico26 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 37);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico27'] == 1)
{
	$arrHistoricoFiltroGenerico27 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 38);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico28'] == 1)
{
	$arrHistoricoFiltroGenerico28 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 39);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico29'] == 1)
{
	$arrHistoricoFiltroGenerico29 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 40);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico30'] == 1)
{
	$arrHistoricoFiltroGenerico30 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 41);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico31'] == 1)
{
	$arrHistoricoFiltroGenerico31 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 42);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico32'] == 1)
{
	$arrHistoricoFiltroGenerico32 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 43);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico33'] == 1)
{
	$arrHistoricoFiltroGenerico33 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 44);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico34'] == 1)
{
	$arrHistoricoFiltroGenerico34 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 45);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico35'] == 1)
{
	$arrHistoricoFiltroGenerico35 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 46);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico36'] == 1)
{
	$arrHistoricoFiltroGenerico36 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 47);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico37'] == 1)
{
	$arrHistoricoFiltroGenerico37 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 48);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico38'] == 1)
{
	$arrHistoricoFiltroGenerico38 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 49);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico39'] == 1)
{
	$arrHistoricoFiltroGenerico39 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 50);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico40'] == 1)
{
	$arrHistoricoFiltroGenerico40 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 51);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico41'] == 1)
{
	$arrHistoricoFiltroGenerico41 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 52);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico42'] == 1)
{
	$arrHistoricoFiltroGenerico42 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 53);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico43'] == 1)
{
	$arrHistoricoFiltroGenerico43 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 54);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico44'] == 1)
{
	$arrHistoricoFiltroGenerico44 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 55);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico45'] == 1)
{
	$arrHistoricoFiltroGenerico45 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 56);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico46'] == 1)
{
	$arrHistoricoFiltroGenerico46 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 57);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico47'] == 1)
{
	$arrHistoricoFiltroGenerico47 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 58);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico48'] == 1)
{
	$arrHistoricoFiltroGenerico48 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 59);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico49'] == 1)
{
	$arrHistoricoFiltroGenerico49 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 60);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico50'] == 1)
{
	$arrHistoricoFiltroGenerico50 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 61);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico51'] == 1)
{
	$arrHistoricoFiltroGenerico51 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 62);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico52'] == 1)
{
	$arrHistoricoFiltroGenerico52 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 63);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico53'] == 1)
{
	$arrHistoricoFiltroGenerico53 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 64);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico54'] == 1)
{
	$arrHistoricoFiltroGenerico54 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 65);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico55'] == 1)
{
	$arrHistoricoFiltroGenerico55 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 66);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico56'] == 1)
{
	$arrHistoricoFiltroGenerico56 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 67);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico57'] == 1)
{
	$arrHistoricoFiltroGenerico57 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 68);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico58'] == 1)
{
	$arrHistoricoFiltroGenerico58 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 69);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico59'] == 1)
{
	$arrHistoricoFiltroGenerico59 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 70);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico60'] == 1)
{
	$arrHistoricoFiltroGenerico60 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 71);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico61'] == 1)
{
	$arrHistoricoFiltroGenerico61 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 72);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico62'] == 1)
{
	$arrHistoricoFiltroGenerico62 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 73);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico63'] == 1)
{
	$arrHistoricoFiltroGenerico63 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 74);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico64'] == 1)
{
	$arrHistoricoFiltroGenerico64 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 75);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico65'] == 1)
{
	$arrHistoricoFiltroGenerico65 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 76);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico66'] == 1)
{
	$arrHistoricoFiltroGenerico66 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 77);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico67'] == 1)
{
	$arrHistoricoFiltroGenerico67 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 78);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico68'] == 1)
{
	$arrHistoricoFiltroGenerico68 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 79);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico69'] == 1)
{
	$arrHistoricoFiltroGenerico69 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 80);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico70'] == 1)
{
	$arrHistoricoFiltroGenerico70 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 81);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico71'] == 1)
{
	$arrHistoricoFiltroGenerico71 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 82);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico72'] == 1)
{
	$arrHistoricoFiltroGenerico72 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 83);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico73'] == 1)
{
	$arrHistoricoFiltroGenerico73 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 84);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico74'] == 1)
{
	$arrHistoricoFiltroGenerico74 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 85);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico75'] == 1)
{
	$arrHistoricoFiltroGenerico75 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 86);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico76'] == 1)
{
	$arrHistoricoFiltroGenerico76 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 87);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico77'] == 1)
{
	$arrHistoricoFiltroGenerico77 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 88);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico78'] == 1)
{
	$arrHistoricoFiltroGenerico78 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 89);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico79'] == 1)
{
	$arrHistoricoFiltroGenerico79 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 90);
}
if($GLOBALS['habilitarHistoricoFiltroGenerico80'] == 1)
{
	$arrHistoricoFiltroGenerico80 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 91);
}


//Definição de variáveis.
if($idParentHistorico <> "")
{
	//$tituloLinkAtual = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoTitulo");
	$tituloLinkAtual = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteRelatoriosTitulo");
}
if($palavraChave <> "")
{
	$tituloLinkAtual = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaResultados");
}
if($tituloLinkAtual == "")
{
	//$tituloLinkAtual = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoTitulo");
	$tituloLinkAtual = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteRelatoriosTitulo");
}
$metaTitulo = $tituloLinkAtual . " - " . Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloSite'], "IncludeConfig");


//Quantidades.
$qtdResultadoHistorico = count($resultadoHistorico);
$qtdResultadoTotalRegistros = count($resultadoTotalRegistros);																	

//Debug.


//Verificação de erro - debug.
/*
echo "arrExibirColunas=<pre>";
echo var_dump($arrExibirColunas);
echo "</pre><br>";
*/
//echo "relatoriosTipoVisualizacao=" . $relatoriosTipoVisualizacao . "<br>";
//echo "relatoriosLegendas=" . $relatoriosLegendas . "<br>";
//echo "relatoriosFontes=" . $relatoriosFontes . "<br>";
//echo "qtdResultadoHistorico=" . $qtdResultadoHistorico . "<br>";
//echo "qtdResultadoTotalRegistros=" . $qtdResultadoTotalRegistros . "<br>";
?>
<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloSite'], "IncludeConfig"); ?> - <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoTitulo"); ?>
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
	<?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoTitulo"); ?>
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
    
	<?php //Parâmetros pesquisados;?>
    <div align="center" class="AdmTexto01" style="position: relative; display: block; clear: both;/* overflow: hidden;*/">
    	<img src="img/logo02.png" alt="Logo" />
        <div>
        	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configClienteRazaoSocial'], "IncludeConfig"); ?>
        </div>
    </div>
    
    <div class="AdmTexto01" style="position: relative; display: block; clear: both; /* overflow: hidden;*/ margin-bottom: 50px;">
        <table class="AdmTabelaCampos02">
            <tr>
                <td class="AdmTbFundoEscuro" colspan="4">
                    <div align="center" class="AdmTexto02">
                        <strong>
                            Par&acirc;metros do Relat&oacute;rio
                        </strong>
                    </div>
                </td>
            </tr>
            
            
		<?php //Critérios obras ?>
        
        
        <?php if(!empty($idsProdutosTipo) && $idsProdutosTipo[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosTipo"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrProdutosTipo); $countArray++){ ?>
                        <?php if(in_array($arrProdutosTipo[$countArray][0], $idsProdutosTipo)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrProdutosTipo[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        
		<?php if($codProduto <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosCodigo"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <div>
                        - <?php echo $codProduto; ?>
                    </div>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        
		<?php if($produto <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProduto"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <div>
                        - <?php echo $produto; ?>
                    </div>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        
        <?php if($valorMinimo <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaValorMinimo"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <div>
                        - <?php echo $GLOBALS['configSistemaMoeda'] . " " . Funcoes::mascaraValorLer($valorMinimo); ?>
                    </div>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        
        <?php if($valorMaximo <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaValorMaximo"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <div>
                        - <?php echo $GLOBALS['configSistemaMoeda'] . " " . Funcoes::mascaraValorLer($valorMaximo); ?>
                    </div>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        
        <?php if(!empty($arrIdsProdutosFiltroGenerico01) && $arrIdsProdutosFiltroGenerico01[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico01Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico01); $countArray++){ ?>
                        <?php if(in_array($arrProdutosFiltroGenerico01[$countArray][0], $arrIdsProdutosFiltroGenerico01)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrProdutosFiltroGenerico01[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
                
        <?php if(!empty($arrIdsProdutosFiltroGenerico02) && $arrIdsProdutosFiltroGenerico02[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico02Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico02); $countArray++){ ?>
                        <?php if(in_array($arrProdutosFiltroGenerico02[$countArray][0], $arrIdsProdutosFiltroGenerico02)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrProdutosFiltroGenerico02[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsProdutosFiltroGenerico03) && $arrIdsProdutosFiltroGenerico03[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico03Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico03); $countArray++){ ?>
                        <?php if(in_array($arrProdutosFiltroGenerico03[$countArray][0], $arrIdsProdutosFiltroGenerico03)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrProdutosFiltroGenerico03[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsProdutosFiltroGenerico04) && $arrIdsProdutosFiltroGenerico04[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico04Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico04); $countArray++){ ?>
                        <?php if(in_array($arrProdutosFiltroGenerico04[$countArray][0], $arrIdsProdutosFiltroGenerico04)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrProdutosFiltroGenerico04[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsProdutosFiltroGenerico05) && $arrIdsProdutosFiltroGenerico05[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico05Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico05); $countArray++){ ?>
                        <?php if(in_array($arrProdutosFiltroGenerico05[$countArray][0], $arrIdsProdutosFiltroGenerico05)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrProdutosFiltroGenerico05[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsProdutosFiltroGenerico06) && $arrIdsProdutosFiltroGenerico06[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico06Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico06); $countArray++){ ?>
                        <?php if(in_array($arrProdutosFiltroGenerico06[$countArray][0], $arrIdsProdutosFiltroGenerico06)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrProdutosFiltroGenerico06[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsProdutosFiltroGenerico07) && $arrIdsProdutosFiltroGenerico07[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico07Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico07); $countArray++){ ?>
                        <?php if(in_array($arrProdutosFiltroGenerico07[$countArray][0], $arrIdsProdutosFiltroGenerico07)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrProdutosFiltroGenerico07[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsProdutosFiltroGenerico08) && $arrIdsProdutosFiltroGenerico08[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico08Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico08); $countArray++){ ?>
                        <?php if(in_array($arrProdutosFiltroGenerico08[$countArray][0], $arrIdsProdutosFiltroGenerico08)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrProdutosFiltroGenerico08[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsProdutosFiltroGenerico09) && $arrIdsProdutosFiltroGenerico09[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico09Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico09); $countArray++){ ?>
                        <?php if(in_array($arrProdutosFiltroGenerico09[$countArray][0], $arrIdsProdutosFiltroGenerico09)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrProdutosFiltroGenerico09[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsProdutosFiltroGenerico10) && $arrIdsProdutosFiltroGenerico10[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico10Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico10); $countArray++){ ?>
                        <?php if(in_array($arrProdutosFiltroGenerico10[$countArray][0], $arrIdsProdutosFiltroGenerico10)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrProdutosFiltroGenerico10[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsProdutosFiltroGenerico11) && $arrIdsProdutosFiltroGenerico11[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico11Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico11); $countArray++){ ?>
                        <?php if(in_array($arrProdutosFiltroGenerico11[$countArray][0], $arrIdsProdutosFiltroGenerico11)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrProdutosFiltroGenerico11[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsProdutosFiltroGenerico12) && $arrIdsProdutosFiltroGenerico12[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico12Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico12); $countArray++){ ?>
                        <?php if(in_array($arrProdutosFiltroGenerico12[$countArray][0], $arrIdsProdutosFiltroGenerico12)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrProdutosFiltroGenerico12[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsProdutosFiltroGenerico13) && $arrIdsProdutosFiltroGenerico13[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico13Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico13); $countArray++){ ?>
                        <?php if(in_array($arrProdutosFiltroGenerico13[$countArray][0], $arrIdsProdutosFiltroGenerico13)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrProdutosFiltroGenerico13[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsProdutosFiltroGenerico14) && $arrIdsProdutosFiltroGenerico14[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico14Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico14); $countArray++){ ?>
                        <?php if(in_array($arrProdutosFiltroGenerico14[$countArray][0], $arrIdsProdutosFiltroGenerico14)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrProdutosFiltroGenerico14[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsProdutosFiltroGenerico15) && $arrIdsProdutosFiltroGenerico15[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico15Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico15); $countArray++){ ?>
                        <?php if(in_array($arrProdutosFiltroGenerico15[$countArray][0], $arrIdsProdutosFiltroGenerico15)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrProdutosFiltroGenerico15[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsProdutosFiltroGenerico16) && $arrIdsProdutosFiltroGenerico16[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico16Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico16); $countArray++){ ?>
                        <?php if(in_array($arrProdutosFiltroGenerico16[$countArray][0], $arrIdsProdutosFiltroGenerico16)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrProdutosFiltroGenerico16[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsProdutosFiltroGenerico17) && $arrIdsProdutosFiltroGenerico17[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico17Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico17); $countArray++){ ?>
                        <?php if(in_array($arrProdutosFiltroGenerico17[$countArray][0], $arrIdsProdutosFiltroGenerico17)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrProdutosFiltroGenerico17[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsProdutosFiltroGenerico18) && $arrIdsProdutosFiltroGenerico18[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico18Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico18); $countArray++){ ?>
                        <?php if(in_array($arrProdutosFiltroGenerico18[$countArray][0], $arrIdsProdutosFiltroGenerico18)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrProdutosFiltroGenerico18[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsProdutosFiltroGenerico19) && $arrIdsProdutosFiltroGenerico19[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico19Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico19); $countArray++){ ?>
                        <?php if(in_array($arrProdutosFiltroGenerico19[$countArray][0], $arrIdsProdutosFiltroGenerico19)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrProdutosFiltroGenerico19[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsProdutosFiltroGenerico20) && $arrIdsProdutosFiltroGenerico20[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico20Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico20); $countArray++){ ?>
                        <?php if(in_array($arrProdutosFiltroGenerico20[$countArray][0], $arrIdsProdutosFiltroGenerico20)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrProdutosFiltroGenerico20[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsProdutosFiltroGenerico21) && $arrIdsProdutosFiltroGenerico21[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico21Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico21); $countArray++){ ?>
                        <?php if(in_array($arrProdutosFiltroGenerico21[$countArray][0], $arrIdsProdutosFiltroGenerico21)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrProdutosFiltroGenerico21[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsProdutosFiltroGenerico22) && $arrIdsProdutosFiltroGenerico22[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico22Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico22); $countArray++){ ?>
                        <?php if(in_array($arrProdutosFiltroGenerico22[$countArray][0], $arrIdsProdutosFiltroGenerico22)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrProdutosFiltroGenerico22[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsProdutosFiltroGenerico23) && $arrIdsProdutosFiltroGenerico23[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico23Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico23); $countArray++){ ?>
                        <?php if(in_array($arrProdutosFiltroGenerico23[$countArray][0], $arrIdsProdutosFiltroGenerico23)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrProdutosFiltroGenerico23[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsProdutosFiltroGenerico24) && $arrIdsProdutosFiltroGenerico24[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico24Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico24); $countArray++){ ?>
                        <?php if(in_array($arrProdutosFiltroGenerico24[$countArray][0], $arrIdsProdutosFiltroGenerico24)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrProdutosFiltroGenerico24[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsProdutosFiltroGenerico25) && $arrIdsProdutosFiltroGenerico25[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico25Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico25); $countArray++){ ?>
                        <?php if(in_array($arrProdutosFiltroGenerico25[$countArray][0], $arrIdsProdutosFiltroGenerico25)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrProdutosFiltroGenerico25[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsProdutosFiltroGenerico26) && $arrIdsProdutosFiltroGenerico26[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico26Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico26); $countArray++){ ?>
                        <?php if(in_array($arrProdutosFiltroGenerico26[$countArray][0], $arrIdsProdutosFiltroGenerico26)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrProdutosFiltroGenerico26[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsProdutosFiltroGenerico27) && $arrIdsProdutosFiltroGenerico27[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico27Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico27); $countArray++){ ?>
                        <?php if(in_array($arrProdutosFiltroGenerico27[$countArray][0], $arrIdsProdutosFiltroGenerico27)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrProdutosFiltroGenerico27[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsProdutosFiltroGenerico28) && $arrIdsProdutosFiltroGenerico28[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico28Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico28); $countArray++){ ?>
                        <?php if(in_array($arrProdutosFiltroGenerico28[$countArray][0], $arrIdsProdutosFiltroGenerico28)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrProdutosFiltroGenerico28[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsProdutosFiltroGenerico29) && $arrIdsProdutosFiltroGenerico29[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico29Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico29); $countArray++){ ?>
                        <?php if(in_array($arrProdutosFiltroGenerico29[$countArray][0], $arrIdsProdutosFiltroGenerico29)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrProdutosFiltroGenerico29[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
                
        <?php if(!empty($arrIdsProdutosFiltroGenerico30) && $arrIdsProdutosFiltroGenerico30[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico30Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico30); $countArray++){ ?>
                        <?php if(in_array($arrProdutosFiltroGenerico30[$countArray][0], $arrIdsProdutosFiltroGenerico30)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrProdutosFiltroGenerico30[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>

		<?php if($informacaoComplementar1 <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc1'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <div>
                        - <?php echo $informacaoComplementar1; ?>
                    </div>
                    </div>
                </td>
            </tr>
        <?php } ?>
            
            
		<?php //Critérios histórico ?>
		<?php if($dataInicial <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoData"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <div>
                        - <?php echo $dataInicial; ?>
                    </div>
                    <?php if($dataFinal <> ""){ ?>
                    <div>
                        - <?php echo $dataFinal; ?>
                    </div>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
    
    
		<?php if($informacaoComplementar3 <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc3'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        - <?php echo $informacaoComplementar3; ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
		<?php if($informacaoComplementar7 <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc7'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        - <?php echo $informacaoComplementar7; ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
		<?php if($informacaoComplementar35 <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc35'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        - <?php echo $informacaoComplementar35; ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
		<?php if($informacaoComplementar55 <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc55'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        - <?php echo $informacaoComplementar55; ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
		<?php if($informacaoComplementar57 <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc57'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        - <?php echo $informacaoComplementar57; ?>
                    </div>
                </td>
            </tr>
        <?php } ?>

        <?php if(!empty($arrIdsHistoricoFiltroGenerico01) && $arrIdsHistoricoFiltroGenerico01[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico01Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico01); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico01[$countArray][0], $arrIdsHistoricoFiltroGenerico01)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico01[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
                
        <?php if(!empty($arrIdsHistoricoFiltroGenerico02) && $arrIdsHistoricoFiltroGenerico02[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico02Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico02); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico02[$countArray][0], $arrIdsHistoricoFiltroGenerico02)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico02[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsHistoricoFiltroGenerico03) && $arrIdsHistoricoFiltroGenerico03[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico03Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico03); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico03[$countArray][0], $arrIdsHistoricoFiltroGenerico03)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico03[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsHistoricoFiltroGenerico04) && $arrIdsHistoricoFiltroGenerico04[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico04Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico04); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico04[$countArray][0], $arrIdsHistoricoFiltroGenerico04)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico04[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsHistoricoFiltroGenerico05) && $arrIdsHistoricoFiltroGenerico05[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico05Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico05); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico05[$countArray][0], $arrIdsHistoricoFiltroGenerico05)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico05[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsHistoricoFiltroGenerico06) && $arrIdsHistoricoFiltroGenerico06[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico06Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico06); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico06[$countArray][0], $arrIdsHistoricoFiltroGenerico06)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico06[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsHistoricoFiltroGenerico07) && $arrIdsHistoricoFiltroGenerico07[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico07Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico07); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico07[$countArray][0], $arrIdsHistoricoFiltroGenerico07)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico07[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsHistoricoFiltroGenerico08) && $arrIdsHistoricoFiltroGenerico08[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico08Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico08); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico08[$countArray][0], $arrIdsHistoricoFiltroGenerico08)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico08[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsHistoricoFiltroGenerico09) && $arrIdsHistoricoFiltroGenerico09[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico09Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico09); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico09[$countArray][0], $arrIdsHistoricoFiltroGenerico09)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico09[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsHistoricoFiltroGenerico10) && $arrIdsHistoricoFiltroGenerico10[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico10Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico10); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico10[$countArray][0], $arrIdsHistoricoFiltroGenerico10)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico10[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsHistoricoFiltroGenerico11) && $arrIdsHistoricoFiltroGenerico11[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico11Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico11); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico11[$countArray][0], $arrIdsHistoricoFiltroGenerico11)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico11[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsHistoricoFiltroGenerico12) && $arrIdsHistoricoFiltroGenerico12[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico12Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico12); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico12[$countArray][0], $arrIdsHistoricoFiltroGenerico12)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico12[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsHistoricoFiltroGenerico13) && $arrIdsHistoricoFiltroGenerico13[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico13Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico13); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico13[$countArray][0], $arrIdsHistoricoFiltroGenerico13)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico13[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsHistoricoFiltroGenerico14) && $arrIdsHistoricoFiltroGenerico14[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico14Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico14); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico14[$countArray][0], $arrIdsHistoricoFiltroGenerico14)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico14[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsHistoricoFiltroGenerico15) && $arrIdsHistoricoFiltroGenerico15[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico15Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico15); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico15[$countArray][0], $arrIdsHistoricoFiltroGenerico15)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico15[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsHistoricoFiltroGenerico16) && $arrIdsHistoricoFiltroGenerico16[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico16Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico16); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico16[$countArray][0], $arrIdsHistoricoFiltroGenerico16)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico16[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsHistoricoFiltroGenerico17) && $arrIdsHistoricoFiltroGenerico17[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico17Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico17); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico17[$countArray][0], $arrIdsHistoricoFiltroGenerico17)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico17[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsHistoricoFiltroGenerico18) && $arrIdsHistoricoFiltroGenerico18[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico18Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico18); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico18[$countArray][0], $arrIdsHistoricoFiltroGenerico18)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico18[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsHistoricoFiltroGenerico19) && $arrIdsHistoricoFiltroGenerico19[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico19Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico19); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico19[$countArray][0], $arrIdsHistoricoFiltroGenerico19)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico19[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsHistoricoFiltroGenerico20) && $arrIdsHistoricoFiltroGenerico20[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico20Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico20); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico20[$countArray][0], $arrIdsHistoricoFiltroGenerico20)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico20[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsHistoricoFiltroGenerico21) && $arrIdsHistoricoFiltroGenerico21[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico21Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico21); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico21[$countArray][0], $arrIdsHistoricoFiltroGenerico21)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico21[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsHistoricoFiltroGenerico22) && $arrIdsHistoricoFiltroGenerico22[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico22Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico22); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico22[$countArray][0], $arrIdsHistoricoFiltroGenerico22)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico22[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsHistoricoFiltroGenerico23) && $arrIdsHistoricoFiltroGenerico23[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico23Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico23); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico23[$countArray][0], $arrIdsHistoricoFiltroGenerico23)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico23[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsHistoricoFiltroGenerico24) && $arrIdsHistoricoFiltroGenerico24[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico24Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico24); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico24[$countArray][0], $arrIdsHistoricoFiltroGenerico24)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico24[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsHistoricoFiltroGenerico25) && $arrIdsHistoricoFiltroGenerico25[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico25Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico25); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico25[$countArray][0], $arrIdsHistoricoFiltroGenerico25)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico25[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsHistoricoFiltroGenerico26) && $arrIdsHistoricoFiltroGenerico26[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico26Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico26); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico26[$countArray][0], $arrIdsHistoricoFiltroGenerico26)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico26[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsHistoricoFiltroGenerico27) && $arrIdsHistoricoFiltroGenerico27[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico27Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico27); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico27[$countArray][0], $arrIdsHistoricoFiltroGenerico27)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico27[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsHistoricoFiltroGenerico28) && $arrIdsHistoricoFiltroGenerico28[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico28Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico28); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico28[$countArray][0], $arrIdsHistoricoFiltroGenerico28)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico28[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsHistoricoFiltroGenerico29) && $arrIdsHistoricoFiltroGenerico29[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico29Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico29); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico29[$countArray][0], $arrIdsHistoricoFiltroGenerico29)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico29[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
                
        <?php if(!empty($arrIdsHistoricoFiltroGenerico30) && $arrIdsHistoricoFiltroGenerico30[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico30Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico30); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico30[$countArray][0], $arrIdsHistoricoFiltroGenerico30)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico30[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        

        <?php if(!empty($arrIdsHistoricoFiltroGenerico31) && $arrIdsHistoricoFiltroGenerico31[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico31Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico31); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico31[$countArray][0], $arrIdsHistoricoFiltroGenerico31)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico31[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsHistoricoFiltroGenerico32) && $arrIdsHistoricoFiltroGenerico32[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico32Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico32); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico32[$countArray][0], $arrIdsHistoricoFiltroGenerico32)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico32[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsHistoricoFiltroGenerico33) && $arrIdsHistoricoFiltroGenerico33[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico33Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico33); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico33[$countArray][0], $arrIdsHistoricoFiltroGenerico33)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico33[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsHistoricoFiltroGenerico34) && $arrIdsHistoricoFiltroGenerico34[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico34Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico34); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico34[$countArray][0], $arrIdsHistoricoFiltroGenerico34)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico34[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsHistoricoFiltroGenerico35) && $arrIdsHistoricoFiltroGenerico35[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico35Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico35); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico35[$countArray][0], $arrIdsHistoricoFiltroGenerico35)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico35[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsHistoricoFiltroGenerico36) && $arrIdsHistoricoFiltroGenerico36[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico36Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico36); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico36[$countArray][0], $arrIdsHistoricoFiltroGenerico36)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico36[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsHistoricoFiltroGenerico37) && $arrIdsHistoricoFiltroGenerico37[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico37Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico37); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico37[$countArray][0], $arrIdsHistoricoFiltroGenerico37)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico37[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsHistoricoFiltroGenerico38) && $arrIdsHistoricoFiltroGenerico38[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico38Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico38); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico38[$countArray][0], $arrIdsHistoricoFiltroGenerico38)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico38[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsHistoricoFiltroGenerico39) && $arrIdsHistoricoFiltroGenerico39[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico39Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico39); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico39[$countArray][0], $arrIdsHistoricoFiltroGenerico39)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico39[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
                
        <?php if(!empty($arrIdsHistoricoFiltroGenerico40) && $arrIdsHistoricoFiltroGenerico40[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico40Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico40); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico40[$countArray][0], $arrIdsHistoricoFiltroGenerico40)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico40[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?> 
        

        <?php if(!empty($arrIdsHistoricoFiltroGenerico41) && $arrIdsHistoricoFiltroGenerico41[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico41Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico41); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico41[$countArray][0], $arrIdsHistoricoFiltroGenerico41)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico41[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsHistoricoFiltroGenerico42) && $arrIdsHistoricoFiltroGenerico42[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico42Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico42); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico42[$countArray][0], $arrIdsHistoricoFiltroGenerico42)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico42[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsHistoricoFiltroGenerico43) && $arrIdsHistoricoFiltroGenerico43[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico43Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico43); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico43[$countArray][0], $arrIdsHistoricoFiltroGenerico43)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico43[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsHistoricoFiltroGenerico44) && $arrIdsHistoricoFiltroGenerico44[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico44Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico44); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico44[$countArray][0], $arrIdsHistoricoFiltroGenerico44)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico44[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsHistoricoFiltroGenerico45) && $arrIdsHistoricoFiltroGenerico45[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico45Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico45); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico45[$countArray][0], $arrIdsHistoricoFiltroGenerico45)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico45[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsHistoricoFiltroGenerico46) && $arrIdsHistoricoFiltroGenerico46[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico46Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico46); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico46[$countArray][0], $arrIdsHistoricoFiltroGenerico46)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico46[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsHistoricoFiltroGenerico47) && $arrIdsHistoricoFiltroGenerico47[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico47Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico47); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico47[$countArray][0], $arrIdsHistoricoFiltroGenerico47)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico47[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsHistoricoFiltroGenerico48) && $arrIdsHistoricoFiltroGenerico48[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico48Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico48); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico48[$countArray][0], $arrIdsHistoricoFiltroGenerico48)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico48[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsHistoricoFiltroGenerico49) && $arrIdsHistoricoFiltroGenerico49[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico49Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico49); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico49[$countArray][0], $arrIdsHistoricoFiltroGenerico49)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico49[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
                
        <?php if(!empty($arrIdsHistoricoFiltroGenerico50) && $arrIdsHistoricoFiltroGenerico50[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico50Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico50); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico50[$countArray][0], $arrIdsHistoricoFiltroGenerico50)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico50[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?> 
        

        <?php if(!empty($arrIdsHistoricoFiltroGenerico51) && $arrIdsHistoricoFiltroGenerico51[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico51Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico51); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico51[$countArray][0], $arrIdsHistoricoFiltroGenerico51)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico51[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsHistoricoFiltroGenerico52) && $arrIdsHistoricoFiltroGenerico52[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico52Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico52); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico52[$countArray][0], $arrIdsHistoricoFiltroGenerico52)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico52[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsHistoricoFiltroGenerico53) && $arrIdsHistoricoFiltroGenerico53[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico53Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico53); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico53[$countArray][0], $arrIdsHistoricoFiltroGenerico53)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico53[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsHistoricoFiltroGenerico54) && $arrIdsHistoricoFiltroGenerico54[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico54Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico54); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico54[$countArray][0], $arrIdsHistoricoFiltroGenerico54)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico54[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsHistoricoFiltroGenerico55) && $arrIdsHistoricoFiltroGenerico55[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico55Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico55); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico55[$countArray][0], $arrIdsHistoricoFiltroGenerico55)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico55[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsHistoricoFiltroGenerico56) && $arrIdsHistoricoFiltroGenerico56[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico56Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico56); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico56[$countArray][0], $arrIdsHistoricoFiltroGenerico56)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico56[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsHistoricoFiltroGenerico57) && $arrIdsHistoricoFiltroGenerico57[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico57Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico57); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico57[$countArray][0], $arrIdsHistoricoFiltroGenerico57)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico57[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsHistoricoFiltroGenerico58) && $arrIdsHistoricoFiltroGenerico58[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico58Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico58); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico58[$countArray][0], $arrIdsHistoricoFiltroGenerico58)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico58[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsHistoricoFiltroGenerico59) && $arrIdsHistoricoFiltroGenerico59[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico59Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico59); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico59[$countArray][0], $arrIdsHistoricoFiltroGenerico59)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico59[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
                
        <?php if(!empty($arrIdsHistoricoFiltroGenerico60) && $arrIdsHistoricoFiltroGenerico60[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico60Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico60); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico60[$countArray][0], $arrIdsHistoricoFiltroGenerico60)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico60[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        

        <?php if(!empty($arrIdsHistoricoFiltroGenerico61) && $arrIdsHistoricoFiltroGenerico61[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico61Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico61); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico61[$countArray][0], $arrIdsHistoricoFiltroGenerico61)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico61[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsHistoricoFiltroGenerico62) && $arrIdsHistoricoFiltroGenerico62[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico62Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico62); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico62[$countArray][0], $arrIdsHistoricoFiltroGenerico62)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico62[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsHistoricoFiltroGenerico63) && $arrIdsHistoricoFiltroGenerico63[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico63Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico63); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico63[$countArray][0], $arrIdsHistoricoFiltroGenerico63)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico63[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsHistoricoFiltroGenerico64) && $arrIdsHistoricoFiltroGenerico64[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico64Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico64); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico64[$countArray][0], $arrIdsHistoricoFiltroGenerico64)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico64[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsHistoricoFiltroGenerico65) && $arrIdsHistoricoFiltroGenerico65[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico65Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico65); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico65[$countArray][0], $arrIdsHistoricoFiltroGenerico65)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico65[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsHistoricoFiltroGenerico66) && $arrIdsHistoricoFiltroGenerico66[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico66Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico66); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico66[$countArray][0], $arrIdsHistoricoFiltroGenerico66)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico66[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsHistoricoFiltroGenerico67) && $arrIdsHistoricoFiltroGenerico67[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico67Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico67); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico67[$countArray][0], $arrIdsHistoricoFiltroGenerico67)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico67[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsHistoricoFiltroGenerico68) && $arrIdsHistoricoFiltroGenerico68[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico68Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico68); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico68[$countArray][0], $arrIdsHistoricoFiltroGenerico68)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico68[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsHistoricoFiltroGenerico69) && $arrIdsHistoricoFiltroGenerico69[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico69Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico69); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico69[$countArray][0], $arrIdsHistoricoFiltroGenerico69)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico69[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
                
        <?php if(!empty($arrIdsHistoricoFiltroGenerico70) && $arrIdsHistoricoFiltroGenerico70[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico70Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico70); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico70[$countArray][0], $arrIdsHistoricoFiltroGenerico70)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico70[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?> 
        

        <?php if(!empty($arrIdsHistoricoFiltroGenerico71) && $arrIdsHistoricoFiltroGenerico71[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico71Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico71); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico71[$countArray][0], $arrIdsHistoricoFiltroGenerico71)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico71[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsHistoricoFiltroGenerico72) && $arrIdsHistoricoFiltroGenerico72[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico72Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico72); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico72[$countArray][0], $arrIdsHistoricoFiltroGenerico72)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico72[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsHistoricoFiltroGenerico73) && $arrIdsHistoricoFiltroGenerico73[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico73Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico73); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico73[$countArray][0], $arrIdsHistoricoFiltroGenerico73)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico73[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsHistoricoFiltroGenerico74) && $arrIdsHistoricoFiltroGenerico74[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico74Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico74); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico74[$countArray][0], $arrIdsHistoricoFiltroGenerico74)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico74[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsHistoricoFiltroGenerico75) && $arrIdsHistoricoFiltroGenerico75[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico75Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico75); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico75[$countArray][0], $arrIdsHistoricoFiltroGenerico75)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico75[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsHistoricoFiltroGenerico76) && $arrIdsHistoricoFiltroGenerico76[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico76Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico76); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico76[$countArray][0], $arrIdsHistoricoFiltroGenerico76)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico76[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        </div>
        <?php } ?>
        
        <?php if(!empty($arrIdsHistoricoFiltroGenerico77) && $arrIdsHistoricoFiltroGenerico77[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico77Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico77); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico77[$countArray][0], $arrIdsHistoricoFiltroGenerico77)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico77[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsHistoricoFiltroGenerico78) && $arrIdsHistoricoFiltroGenerico78[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico78Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico78); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico78[$countArray][0], $arrIdsHistoricoFiltroGenerico78)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico78[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
        <?php if(!empty($arrIdsHistoricoFiltroGenerico79) && $arrIdsHistoricoFiltroGenerico79[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico79Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico79); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico79[$countArray][0], $arrIdsHistoricoFiltroGenerico79)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico79[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
                
        <?php if(!empty($arrIdsHistoricoFiltroGenerico80) && $arrIdsHistoricoFiltroGenerico80[0] <> ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico80Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    <?php for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico80); $countArray++){ ?>
                        <?php if(in_array($arrHistoricoFiltroGenerico80[$countArray][0], $arrIdsHistoricoFiltroGenerico80)){ ?>
                        <div>
                            - <?php echo Funcoes::ConteudoMascaraLeitura($arrHistoricoFiltroGenerico80[$countArray][1]);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>

            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">

                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">

                    </div>
                </td>
            </tr>
        </table>
    </div>
        
    <?php if($relatoriosTipoVisualizacao == 2){ ?>


		<?php
        if (empty($resultadoHistorico))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="AdmErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteMensagemHistoricoVazio"); ?>
            </div>
        <?php
        }else{
        ?>
			  <?php
                $countRegistros = 0;
                
                
                $countTabelaFundo = 0;
                $arrHistoricoStatus = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 4);

                //Carregamento dos registros da tabela auxiliar.
                //Obs: Talvez modificar para variáveis individualizadas de acordo com liberação e exibição de colunas.
                $resultadoHistoricoComplemento = DbFuncoes::TabelaGenericaFill01_FetchAll("tb_historico_complemento", 
                                                                                        NULL, 
                                                                                        "complemento", 
                                                                                        "");
                /*																		
                $resultadoProdutosComplemento = DbFuncoes::TabelaGenericaFill01_FetchAll("tb_produtos_complemento", 
                                                                                        NULL, 
                                                                                        "complemento", 
                                                                                        "");
                */
              
                //Loop pelos resultados.
                foreach($resultadoHistorico as $linhaHistorico)
                {
                    $countRegistros++;
                    
                    //Complementos vinculados.
                    $resultadoHistoricoComplementoRelacao = ""; //Limpar variável.
                    $resultadoHistoricoComplementoRelacao = DbFuncoes::FiltrosGenericosSelect02_FetchAll("tb_historico_relacao_complemento", 
                                                                                                        $linhaHistorico['id'], 
                                                                                                        "id_tb_historico");
                                                                                                        
                    //Objeto - Produtos.
                    //----------
                    //Detalhes do produto vinculado.
                    $opdProdutoVinculado = "";
                    $opdProdutoVinculado = new ObjetoProdutosDetalhes(); //Criação de objeto com os detalhes do cadastro.
                    
                    //Definição dos valores do cadastro logado.
                    $opdProdutoVinculado->ProdutosDetalhesResultado($linhaHistorico['id_parent'], 1); //Detalhes da tabela principal.
                    $opdProdutoVinculado->ProdutosDetalhesComplemento($linhaHistorico['id_parent'], 1); //Detalhes (ids) da tabela complementar.
                    $opdProdutoVinculado->ProdutosDetalhesComplemento_print($linhaHistorico['id_parent'], 1);//Detalhes (ids/complamento) da tabela complementar.
                    
                    //Definição de valores.
                    //$tbProdutosId = $opdProdutoVinculado->tbProdutosId;
                    //$tbProdutosCodProduto = $opdProdutoVinculado->tbProdutosCodProduto;
                    //$tbProdutosProduto = $opdProdutoVinculado->tbProdutosProduto;
                    //----------
              ?>
              	<div class="AdmTexto01" style="position: relative; display: block; clear: both;/* overflow: hidden;*/ margin-bottom: 50px;">
					<?php //Produtos - detalhes.?>
                    <?php //----------------------?>
                    <?php 
                    //Definição de variáveis do include.
                    $includeProdutosDetalhes_idTbProdutos = $linhaHistorico['id_parent'];
                    $includeProdutosDetalhes_configTipoDiagramacao = "3";
                    ?>
                    
                    <?php include "IncludeProdutosDetalhes.php";?>
                    <?php //----------------------?>
    
    
                    <?php //Histórico - detalhes.?>
                    <?php //----------------------?>
                    <?php 
                    //Definição de variáveis do include.
                    $includeHistoricoDetalhes_idTbHistorico = $linhaHistorico['id'];
                    $includeHistoricoDetalhes_configTipoDiagramacao = "3";
                    ?>
                    
                    <?php include "IncludeHistoricoDetalhes.php";?>
                    <?php //----------------------?>
        		</div>
    
			<?php } ?>
		<?php } ?>
    <?php } ?>
    
    
    <?php if($relatoriosTipoVisualizacao == 1){ ?>
		<?php
        if (empty($resultadoHistorico))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="AdmErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteMensagemHistoricoVazio"); ?>
            </div>
        <?php
        }else{
        ?>
            <?php //Diagramação 01 - Tabela.?>
            <?php //**************************************************************************************?>
            <div class="AdmTexto01" style="position: relative; display: block; clear: both;/* overflow: hidden;*/">
                <table width="100%" class="AdmTabelaDados01" style="/*table-layout: auto;*/">
                  <tr class="AdmTbFundoEscuro AdmTexto02" style="font-size: <?php echo $relatoriosFontes;?> !important;">
                    <?php if(in_array("id", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarCadastroHistoricoVisualizarProtocolo'] == 1){ ?>
                        <td width="50" class="AdmTabelaDados01Celula">
                            <div align="center">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoProtocolo"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    
                    <?php if(in_array("data_historico", $arrExibirColunas) == true){ ?>
                    <td width="100" class="AdmTabelaDados01Celula">
                        <div align="center">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoData"); ?>
                        </div>
                    </td>
                    <?php } ?>
    
                    <?php if(in_array("data1", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoData1'] == 1){ ?>
                        <td width="100" class="AdmTabelaDados01Celula">
                            <div align="center">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoData1'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    
                    <?php if(in_array("produto", $arrExibirColunas) == true){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProduto"); ?>
                            </div>
                        </td>
                    <?php } ?>
                    <?php if(in_array("tipo_produto", $arrExibirColunas) == true){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosTipo"); ?>
                            </div>
                        </td>
                    <?php } ?>
                    <?php if(in_array("data_produto", $arrExibirColunas) == true){ ?>
                        <td width="100" class="AdmTabelaDados01Celula">
                            <div align="center">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosData"); ?> (Obra)
                            </div>
                        </td>
                    <?php } ?>
                    <?php if(in_array("produtos_informacao_complementar1", $arrExibirColunas) == true){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc1'], "IncludeConfig"); ?>
                            </div>
                        </td>
                    <?php } ?>
                    <?php if(in_array("produtos_filtro_generico01", $arrExibirColunas) == true){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico01Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                    <?php } ?>
                    <?php if(in_array("produtos_filtro_generico02", $arrExibirColunas) == true){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico02Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                    <?php } ?>
                    <?php if(in_array("produtos_filtro_generico03", $arrExibirColunas) == true){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico03Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                    <?php } ?>
                    <?php if(in_array("produtos_filtro_generico04", $arrExibirColunas) == true){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico04Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                    <?php } ?>
                    <?php if(in_array("produtos_filtro_generico05", $arrExibirColunas) == true){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico05Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                    <?php } ?>
                    <?php if(in_array("produtos_filtro_generico06", $arrExibirColunas) == true){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico06Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                    <?php } ?>
                    <?php if(in_array("produtos_filtro_generico07", $arrExibirColunas) == true){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico07Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                    <?php } ?>
                    <?php if(in_array("produtos_filtro_generico08", $arrExibirColunas) == true){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico08Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                    <?php } ?>
                    <?php if(in_array("produtos_filtro_generico09", $arrExibirColunas) == true){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico09Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                    <?php } ?>
                    <?php if(in_array("produtos_filtro_generico10", $arrExibirColunas) == true){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico10Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                    <?php } ?>
    
                    <?php if(in_array("historico", $arrExibirColunas) == true){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistorico"); ?>
                        </div>
                    </td>
                    <?php } ?>
                    
                    <?php if(in_array("id_tb_cadastro1", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoVinculo1'] == 1){ ?>
                        <td width="200" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoVinculo1Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("id_tb_cadastro2", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoVinculo2'] == 1){ ?>
                        <td width="200" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoVinculo2Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("id_tb_cadastro3", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoVinculo3'] == 1){ ?>
                        <td width="200" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoVinculo3Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    
                    <?php if(in_array("historico_filtro_generico01", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico01'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico01Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico02", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico02'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico02Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico03", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico03'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico03Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico04", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico04'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico04Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico05", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico05'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico05Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico06", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico06'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico06Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico07", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico07'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico07Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico08", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico08'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico08Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico09", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico09'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico09Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico10", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico10'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico10Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
    
                    <?php if(in_array("historico_filtro_generico11", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico11'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico11Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico12", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico12'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico12Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico13", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico13'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico13Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico14", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico14'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico14Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico15", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico15'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico15Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico16", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico16'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico16Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico17", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico17'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico17Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico18", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico18'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico18Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico19", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico19'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico19Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico20", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico20'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico20Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    
                    <?php if(in_array("historico_filtro_generico21", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico21'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico21Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico22", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico22'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico22Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico23", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico23'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico23Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico24", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico24'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico24Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico25", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico25'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico25Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico26", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico26'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico26Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico27", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico27'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico27Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico28", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico28'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico28Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico29", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico29'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico29Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico30", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico30'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico30Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    
                    <?php if(in_array("historico_filtro_generico31", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico31'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico31Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico32", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico32'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico32Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico33", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico33'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico33Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico34", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico34'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico34Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico35", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico35'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico35Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico36", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico36'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico36Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico37", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico37'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico37Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico38", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico38'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico38Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico39", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico39'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico39Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico40", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico40'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico40Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    
                    <?php if(in_array("historico_filtro_generico41", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico41'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico41Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico42", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico42'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico42Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico43", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico43'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico43Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico44", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico44'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico44Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico45", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico45'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico45Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico46", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico46'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico46Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico47", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico47'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico47Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico48", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico48'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico48Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico49", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico49'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico49Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico50", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico50'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico50Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    
                    <?php if(in_array("historico_filtro_generico51", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico51'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico51Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico52", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico52'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico52Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico53", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico53'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico53Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico54", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico54'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico54Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico55", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico55'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico55Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico56", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico56'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico56Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico57", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico57'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico57Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico58", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico58'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico58Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico59", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico59'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico59Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico60", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico60'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico60Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    
                    <?php if(in_array("historico_filtro_generico61", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico61'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico61Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico62", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico62'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico62Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico63", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico63'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico63Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico64", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico64'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico64Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico65", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico65'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico65Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico66", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico66'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico66Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico67", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico67'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico67Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico68", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico68'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico68Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico69", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico69'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico69Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico70", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico70'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico70Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    
                    <?php if(in_array("historico_filtro_generico71", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico71'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico71Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico72", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico72'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico72Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico73", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico73'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico73Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico74", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico74'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico74Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico75", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico75'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico75Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico76", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico76'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico76Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico77", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico77'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico77Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico78", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico78'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico78Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico79", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico79'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico79Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico80", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico80'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico80Nome'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar1", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc1'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc1'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar2", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc2'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc2'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar3", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc3'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc3'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar4", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc4'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc4'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar5", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc5'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc5'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar6", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc6'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc6'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar7", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc7'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc7'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar8", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc8'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc8'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar9", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc9'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc9'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar10", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc10'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc10'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar11", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc11'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc11'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar12", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc12'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc12'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar13", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc13'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc13'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar14", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc14'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc14'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar15", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc15'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc15'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar16", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc16'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc16'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar17", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc17'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc17'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar18", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc18'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc18'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar19", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc19'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc19'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar20", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc20'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc20'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar21", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc21'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc21'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar22", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc22'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc22'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar23", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc23'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc23'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar24", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc24'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc24'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar25", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc25'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc25'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar26", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc26'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc26'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar27", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc27'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc27'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar28", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc28'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc28'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar29", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc29'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc29'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar30", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc30'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc30'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar31", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc31'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc31'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar32", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc32'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc32'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar33", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc33'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc33'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar34", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc34'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc34'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar35", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc35'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc35'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar36", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc36'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc36'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar37", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc37'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc37'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar38", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc38'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc38'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar39", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc39'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc39'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar40", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc40'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc40'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar41", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc41'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc41'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar42", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc42'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc42'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar43", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc43'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc43'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar44", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc44'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc44'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar45", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc45'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc45'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar46", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc46'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc46'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar47", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc47'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc47'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar48", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc48'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc48'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar49", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc49'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc49'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar50", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc50'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc50'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar51", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc51'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc51'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar52", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc52'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc52'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar53", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc53'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc53'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar54", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc54'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc54'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar55", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc55'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc55'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar56", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc56'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc56'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar57", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc57'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc57'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar58", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc58'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc58'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar59", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc59'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc59'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar60", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc60'] == 1){ ?>
                        <td width="150" class="AdmTabelaDados01Celula">
                            <div>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc60'], "IncludeConfig"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    
                    <?php if(in_array("funcoes", $arrExibirColunas) == true){ ?>
                    <td width="100" class="AdmTabelaDados01Celula" style="display: none;">
                        <div align="center">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFuncoes"); ?>
                        </div>
                    </td>
                    <?php } ?>
                    
                    <?php if(in_array("id_tb_historico_status", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarCadastroHistoricoStatus'] == 1){ ?>
                        <td width="100">
                            <div align="center">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoStatus"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    
                    <?php if(in_array("forum_postagens", $arrExibirColunas) == true){ ?>
                    <td width="300">
                        <div align="center">
                            Teste de Solubilidade
                        </div>
                    </td>
                    <?php } ?>
                    
                    <?php if(in_array("editar", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoAdmEdicao'] == 1){ ?>
                        <td width="30" class="AdmTabelaDados01Celula" style="display: none;">
                            <div align="center">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    
                    <?php if(in_array("excluir", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoAdmExclusao'] == 1){ ?>
                        <td width="30" class="AdmTabelaDados01Celula" style="display: none;">
                            <div align="center">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemExcluir"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    
                    <?php if(in_array("selecionar", $arrExibirColunas) == true){ ?>
                    <td width="30" class="AdmTabelaDados01Celula" style="display: none;">
                        <div align="center">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemSelecionarA"); ?>
                        </div>
                    </td>
                    <?php } ?>
                  </tr>
                  <?php
                    $countRegistros = 0;
                    
                    
                    $countTabelaFundo = 0;
                    $arrHistoricoStatus = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 4);
    
                    //Carregamento dos registros da tabela auxiliar.
                    //Obs: Talvez modificar para variáveis individualizadas de acordo com liberação e exibição de colunas.
                    $resultadoHistoricoComplemento = DbFuncoes::TabelaGenericaFill01_FetchAll("tb_historico_complemento", 
                                                                                            NULL, 
                                                                                            "complemento", 
                                                                                            "");
                    /*																		
                    $resultadoProdutosComplemento = DbFuncoes::TabelaGenericaFill01_FetchAll("tb_produtos_complemento", 
                                                                                            NULL, 
                                                                                            "complemento", 
                                                                                            "");
                    */
                  
                    //Loop pelos resultados.
                    foreach($resultadoHistorico as $linhaHistorico)
                    {
                        $countRegistros++;
                        
                        //Complementos vinculados.
                        $resultadoHistoricoComplementoRelacao = ""; //Limpar variável.
                        $resultadoHistoricoComplementoRelacao = DbFuncoes::FiltrosGenericosSelect02_FetchAll("tb_historico_relacao_complemento", 
                                                                                                            $linhaHistorico['id'], 
                                                                                                            "id_tb_historico");
                                                                                                            
                        //Objeto - Produtos.
                        //----------
                        //Detalhes do produto vinculado.
                        $opdProdutoVinculado = "";
                        $opdProdutoVinculado = new ObjetoProdutosDetalhes(); //Criação de objeto com os detalhes do cadastro.
                        
                        //Definição dos valores do cadastro logado.
                        $opdProdutoVinculado->ProdutosDetalhesResultado($linhaHistorico['id_parent'], 1); //Detalhes da tabela principal.
                        $opdProdutoVinculado->ProdutosDetalhesComplemento($linhaHistorico['id_parent'], 1); //Detalhes (ids) da tabela complementar.
                        $opdProdutoVinculado->ProdutosDetalhesComplemento_print($linhaHistorico['id_parent'], 1);//Detalhes (ids/complamento) da tabela complementar.
                        
                        //Definição de valores.
                        //$tbProdutosId = $opdProdutoVinculado->tbProdutosId;
                        //$tbProdutosCodProduto = $opdProdutoVinculado->tbProdutosCodProduto;
                        //$tbProdutosProduto = $opdProdutoVinculado->tbProdutosProduto;
                        //----------
                  ?>
                  <tr class="<?php if($countTabelaFundo == 0){ ?>AdmTbFundoClaro<?php }else{?>AdmTbFundoAlternativo<?php } ?> AdmTexto01" style="font-size: <?php echo $relatoriosFontes;?> !important;">
                    <?php if(in_array("id", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarCadastroHistoricoVisualizarProtocolo'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="center">
                                <?php echo $linhaHistorico['id'];?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    
                    <?php if(in_array("data_historico", $arrExibirColunas) == true){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="center">
                            <?php //echo $linhaHistorico['data_historico'];?>
                            <?php echo Funcoes::DataLeitura01($linhaHistorico['data_historico'], $GLOBALS['configSiteFormatoData'], "1"); ?>
                            <?php //echo Funcoes::DataLeitura01($linhaHistorico['data_historico'], $GLOBALS['configSiteFormatoData'], "2"); ?>
                        </div>
                    </td>
                    <?php } ?>
                    
                    <?php if(in_array("data1", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoData1'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="center">
                                <?php //echo $linhaHistorico['data_historico'];?>
                                <?php echo Funcoes::DataLeitura01($linhaHistorico['data1'], $GLOBALS['configSiteFormatoData'], "1"); ?>
                                <?php //echo Funcoes::DataLeitura01($linhaHistorico['data1'], $GLOBALS['configSiteFormatoData'], "2"); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
    
                    <?php if(in_array("produto", $arrExibirColunas) == true){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo $opdProdutoVinculado->tbProdutosProduto;?>
                            <?php 
                            //Debug.
                            /*
                            echo "opdProdutoVinculado=<pre>";
                            var_dump($opdProdutoVinculado);
                            echo "</pre><br/>";
                            */
                            ?>
                        </div>
                    </td>
                    <?php } ?>
                    <?php if(in_array("tipo_produto", $arrExibirColunas) == true){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div>
                            <?php //echo $opdProdutoVinculado->arrProdutosTipoSelecao;?>
                            <?php
                            //Loop pelos resultados.
                            //foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                            //{
                            ?>
                                <!--div align="left">
                                    <?php //if($linhaProdutosComplemento["tipo_complemento"] == "2"){ ?> 
                                        <?php //if(in_array($linhaProdutosComplemento["id"], $opdProdutoVinculado->arrProdutosTipoSelecao)){ ?> 
                                            - <?php //echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                        <?php //} ?>
                                    <?php //} ?>
                                </div-->
                            <?php //} ?>
                            
                            <?php 
                            //Loop pelos resultados.
                            for($countArray = 0; $countArray < count($opdProdutoVinculado->arrProdutosTipoSelecao_print); $countArray++)
                            { 
                            ?>
                                <div align="left">
                                    - <?php echo $opdProdutoVinculado->arrProdutosTipoSelecao_print[$countArray]["complemento"];?>
                                </div>
                            <?php } ?>
                            
                            <?php 
                            //Debug.
                            /*
                            echo "arrProdutosTipoSelecao=<pre>";
                            var_dump($opdProdutoVinculado->arrProdutosTipoSelecao);
                            echo "</pre><br/>";
                            */
                            
                            //echo "arrProdutosTipoSelecao_print=<pre>";
                            //var_dump($opdProdutoVinculado->arrProdutosTipoSelecao_print);
                            //echo "</pre><br/>";
                            ?>
                        </div>
                    </td>
                    <?php } ?>
                    <?php if(in_array("data_produto", $arrExibirColunas) == true){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="center">
                            <?php echo $opdProdutoVinculado->tbProdutosDataProduto;?>
                        </div>
                    </td>
                    <?php } ?>
                    <?php if(in_array("produtos_informacao_complementar1", $arrExibirColunas) == true){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo $opdProdutoVinculado->tbProdutosIC1;?>
                        </div>
                    </td>
                    <?php } ?>
                    <?php if(in_array("produtos_filtro_generico01", $arrExibirColunas) == true){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div>
                            <?php 
                            //Loop pelos resultados.
                            for($countArray = 0; $countArray < count($opdProdutoVinculado->arrProdutosFiltroGenerico01Selecao_print); $countArray++)
                            { 
                            ?>
                                <div align="left">
                                    - <?php echo $opdProdutoVinculado->arrProdutosFiltroGenerico01Selecao_print[$countArray]["complemento"];?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                    <?php if(in_array("produtos_filtro_generico02", $arrExibirColunas) == true){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div>
                            <?php 
                            //Loop pelos resultados.
                            for($countArray = 0; $countArray < count($opdProdutoVinculado->arrProdutosFiltroGenerico02Selecao_print); $countArray++)
                            { 
                            ?>
                                <div align="left">
                                    - <?php echo $opdProdutoVinculado->arrProdutosFiltroGenerico02Selecao_print[$countArray]["complemento"];?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                    <?php if(in_array("produtos_filtro_generico03", $arrExibirColunas) == true){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div>
                            <?php 
                            //Loop pelos resultados.
                            for($countArray = 0; $countArray < count($opdProdutoVinculado->arrProdutosFiltroGenerico03Selecao_print); $countArray++)
                            { 
                            ?>
                                <div align="left">
                                    - <?php echo $opdProdutoVinculado->arrProdutosFiltroGenerico03Selecao_print[$countArray]["complemento"];?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                    <?php if(in_array("produtos_filtro_generico04", $arrExibirColunas) == true){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div>
                            <?php 
                            //Loop pelos resultados.
                            for($countArray = 0; $countArray < count($opdProdutoVinculado->arrProdutosFiltroGenerico04Selecao_print); $countArray++)
                            { 
                            ?>
                                <div align="left">
                                    - <?php echo $opdProdutoVinculado->arrProdutosFiltroGenerico04Selecao_print[$countArray]["complemento"];?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                    <?php if(in_array("produtos_filtro_generico05", $arrExibirColunas) == true){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div>
                            <?php 
                            //Loop pelos resultados.
                            for($countArray = 0; $countArray < count($opdProdutoVinculado->arrProdutosFiltroGenerico05Selecao_print); $countArray++)
                            { 
                            ?>
                                <div align="left">
                                    - <?php echo $opdProdutoVinculado->arrProdutosFiltroGenerico05Selecao_print[$countArray]["complemento"];?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                    <?php if(in_array("produtos_filtro_generico06", $arrExibirColunas) == true){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div>
                            <?php 
                            //Loop pelos resultados.
                            for($countArray = 0; $countArray < count($opdProdutoVinculado->arrProdutosFiltroGenerico06Selecao_print); $countArray++)
                            { 
                            ?>
                                <div align="left">
                                    - <?php echo $opdProdutoVinculado->arrProdutosFiltroGenerico06Selecao_print[$countArray]["complemento"];?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                    <?php if(in_array("produtos_filtro_generico07", $arrExibirColunas) == true){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div>
                            <?php 
                            //Loop pelos resultados.
                            for($countArray = 0; $countArray < count($opdProdutoVinculado->arrProdutosFiltroGenerico07Selecao_print); $countArray++)
                            { 
                            ?>
                                <div align="left">
                                    - <?php echo $opdProdutoVinculado->arrProdutosFiltroGenerico07Selecao_print[$countArray]["complemento"];?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                    <?php if(in_array("produtos_filtro_generico08", $arrExibirColunas) == true){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div>
                            <?php
                            //Loop pelos resultados.
                            //foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                            //{
                            ?>
                                <!--div align="left">
                                    <?php //if($linhaProdutosComplemento["tipo_complemento"] == "19"){ ?> 
                                        <?php //if(in_array($linhaProdutosComplemento["id"], $opdProdutoVinculado->arrProdutosFiltroGenerico08Selecao)){ ?> 
                                            - <?php //echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                        <?php //} ?>
                                    <?php //} ?>
                                </div-->
                            <?php //} ?>
                        
                            <?php 
                            //Loop pelos resultados.
                            for($countArray = 0; $countArray < count($opdProdutoVinculado->arrProdutosFiltroGenerico08Selecao_print); $countArray++)
                            { 
                            ?>
                                <div align="left">
                                    - <?php echo $opdProdutoVinculado->arrProdutosFiltroGenerico08Selecao_print[$countArray]["complemento"];?>
                                </div>
                            <?php } ?>
                            
                            <?php 
                            //Debug.
                            //echo "arrProdutosFiltroGenerico08Selecao_print=<pre>";
                            //var_dump($opdProdutoVinculado->arrProdutosFiltroGenerico08Selecao_print);
                            //echo "</pre><br/>";
                            ?>
                        </div>
                    </td>
                    <?php } ?>
                    <?php if(in_array("produtos_filtro_generico09", $arrExibirColunas) == true){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div>
                            <?php 
                            //Loop pelos resultados.
                            for($countArray = 0; $countArray < count($opdProdutoVinculado->arrProdutosFiltroGenerico09Selecao_print); $countArray++)
                            { 
                            ?>
                                <div align="left">
                                    - <?php echo $opdProdutoVinculado->arrProdutosFiltroGenerico09Selecao_print[$countArray]["complemento"];?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                    <?php if(in_array("produtos_filtro_generico10", $arrExibirColunas) == true){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div>
                            <?php 
                            //Loop pelos resultados.
                            for($countArray = 0; $countArray < count($opdProdutoVinculado->arrProdutosFiltroGenerico10Selecao_print); $countArray++)
                            { 
                            ?>
                                <div align="left">
                                    - <?php echo $opdProdutoVinculado->arrProdutosFiltroGenerico10Selecao_print[$countArray]["complemento"];?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                    
                    <?php if(in_array("historico", $arrExibirColunas) == true){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div >
                            <strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['assunto']);?>
                            </strong>
                        </div>
                        <div >
                            <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['historico']);?>
                        </div>
                    </td>
                    <?php } ?>
                    
                    <?php if(in_array("id_tb_cadastro1", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoVinculo1'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div >
                                <a href="CadastroAdministrar.php?idTbCadastro=<?php echo $linhaHistorico['id_tb_cadastro1'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
                                </a>
                                    <?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaHistorico['id_tb_cadastro1'], "tb_cadastro", "nome"), 
                                    DbFuncoes::GetCampoGenerico01($linhaHistorico['id_tb_cadastro1'], "tb_cadastro", "razao_social"), 
                                    DbFuncoes::GetCampoGenerico01($linhaHistorico['id_tb_cadastro1'], "tb_cadastro", "nome_fantasia"), 
                                    1)); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    
                    <?php if(in_array("id_tb_cadastro2", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoVinculo2'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div>
                                <a href="CadastroAdministrar.php?idTbCadastro=<?php echo $linhaHistorico['id_tb_cadastro2'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
                                </a>
                                    <?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaHistorico['id_tb_cadastro2'], "tb_cadastro", "nome"), 
                                    DbFuncoes::GetCampoGenerico01($linhaHistorico['id_tb_cadastro2'], "tb_cadastro", "razao_social"), 
                                    DbFuncoes::GetCampoGenerico01($linhaHistorico['id_tb_cadastro2'], "tb_cadastro", "nome_fantasia"), 
                                    1)); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("id_tb_cadastro3", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoVinculo3'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div >
                                <a href="CadastroAdministrar.php?idTbCadastro=<?php echo $linhaHistorico['id_tb_cadastro3'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
                                </a>
                                    <?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaHistorico['id_tb_cadastro3'], "tb_cadastro", "nome"), 
                                    DbFuncoes::GetCampoGenerico01($linhaHistorico['id_tb_cadastro3'], "tb_cadastro", "razao_social"), 
                                    DbFuncoes::GetCampoGenerico01($linhaHistorico['id_tb_cadastro3'], "tb_cadastro", "nome_fantasia"), 
                                    1)); ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    
                    <?php if(in_array("historico_filtro_generico01", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico01'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "12"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico02", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico02'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "13"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico03", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico03'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "14"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico04", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico04'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "15"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico05", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico05'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "16"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico06", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico06'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "17"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico07", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico07'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "18"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico08", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico08'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "19"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico09", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico09'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "20"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico10", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico10'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "21"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    
                    <?php if(in_array("historico_filtro_generico11", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico11'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "22"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico12", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico12'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "23"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico13", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico13'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "24"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico14", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico14'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "25"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico15", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico15'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "26"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico16", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico16'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "27"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico17", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico17'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "28"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico18", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico18'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "29"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico19", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico19'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "30"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico20", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico20'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "31"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    
                    <?php if(in_array("historico_filtro_generico21", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico21'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "32"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico22", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico22'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "33"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico23", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico23'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "34"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico24", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico24'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "35"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico25", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico25'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "36"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico26", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico26'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "37"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico27", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico27'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "38"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico28", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico28'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "39"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico29", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico29'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "40"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico30", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico30'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "41"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    
                    <?php if(in_array("historico_filtro_generico31", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico31'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "42"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico32", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico32'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "43"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico33", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico33'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "44"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico34", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico34'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "45"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico35", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico35'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "46"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico36", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico36'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "47"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico37", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico37'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "48"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico38", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico38'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "49"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico39", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico39'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "50"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico40", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico40'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "51"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    
                    <?php if(in_array("historico_filtro_generico41", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico41'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "52"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico42", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico42'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "53"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico43", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico43'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "54"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico44", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico44'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "55"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico45", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico45'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "56"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico46", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico46'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "57"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico47", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico47'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "58"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico48", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico48'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "59"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico49", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico49'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "60"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico50", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico50'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "61"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    
                    <?php if(in_array("historico_filtro_generico51", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico51'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "62"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico52", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico52'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "63"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico53", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico53'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "64"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico54", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico54'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "65"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico55", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico55'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "66"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico56", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico56'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "67"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico57", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico57'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "68"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico58", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico58'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "69"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico59", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico59'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "70"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico60", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico60'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "71"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    
                    <?php if(in_array("historico_filtro_generico61", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico61'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "72"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico62", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico62'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "73"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico63", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico63'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "74"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico64", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico64'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "75"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico65", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico65'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "76"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico66", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico66'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "77"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico67", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico67'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "78"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico68", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico68'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "79"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico69", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico69'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "80"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico70", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico70'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "81"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    
                    <?php if(in_array("historico_filtro_generico71", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico71'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "82"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico72", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico72'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "83"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico73", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico73'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "84"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico74", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico74'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "85"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico75", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico75'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "86"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico76", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico76'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "87"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico77", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico77'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "88"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico78", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico78'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "89"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico79", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico79'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "90"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("historico_filtro_generico80", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoFiltroGenerico80'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                                {
                                ?>
                                    <div align="left">
                                        <?php if($linhaHistoricoComplemento["tipo_complemento"] == "91"){ ?> 
                                            <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                                - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar1", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc1'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar1']);?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar2", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc2'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar2']);?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar3", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc3'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar3']);?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar4", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc4'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar4']);?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar5", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc5'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar5']);?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar6", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc6'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar6']);?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar7", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc7'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar7']);?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar8", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc8'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar8']);?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar9", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc9'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar9']);?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar10", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc10'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar10']);?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar11", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc11'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar11']);?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar12", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc12'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar12']);?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar13", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc13'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar13']);?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar14", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc14'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar14']);?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar15", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc15'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar15']);?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar16", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc16'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar16']);?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar17", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc17'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar17']);?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar18", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc18'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar18']);?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar19", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc19'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar19']);?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar20", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc20'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar20']);?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar21", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc21'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar21']);?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar22", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc22'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar22']);?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar23", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc23'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar23']);?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar24", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc24'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar24']);?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar25", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc25'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar25']);?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar26", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc26'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar26']);?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar27", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc27'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar27']);?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar28", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc28'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar28']);?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar29", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc29'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar29']);?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar30", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc30'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar30']);?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar31", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc31'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar31']);?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar32", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc32'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar32']);?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar33", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc33'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar33']);?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar34", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc34'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar34']);?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar35", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc35'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar35']);?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar36", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc36'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar36']);?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar37", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc37'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar37']);?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar38", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc38'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar38']);?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar39", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc39'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar39']);?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar40", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc40'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar40']);?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar41", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc41'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar41']);?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar42", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc42'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar42']);?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar43", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc43'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar43']);?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar44", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc44'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar44']);?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar45", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc45'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar45']);?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar46", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc46'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar46']);?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar47", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc47'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar47']);?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar48", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc48'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar48']);?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar49", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc49'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar49']);?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar50", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc50'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar50']);?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar51", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc51'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar51']);?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar52", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc52'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar52']);?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar53", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc53'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar53']);?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar54", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc54'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar54']);?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar55", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc55'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar55']);?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar56", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc56'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar56']);?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar57", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc57'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar57']);?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar58", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc58'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar58']);?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar59", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc59'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar59']);?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("informacao_complementar60", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoIc60'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="left">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar60']);?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                                    
                    <?php if(in_array("funcoes", $arrExibirColunas) == true){ ?>
                    <td class="AdmTabelaDados01Celula" style="display: none;">
                        <div align="center">
                            <a href="SiteAdmHistoricoEditar.php?idTbHistorico=<?php echo $linhaHistorico['id'];?>" target="_blank" class="AdmLinks01">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemDetalhes"); ?>
                            </a>
                        </div>
                        <?php if($GLOBALS['habilitarCadastroHistoricoInteracao'] == 1){ ?>
                            <div align="center">
                                <a href="SiteAdmHistoricoInteracaoIndice.php?idParent=<?php echo $linhaHistorico['id'];?>" class="AdmLinks01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoInteracao"); ?>
                                </a>
                            </div>
                        <?php } ?>
                    </td>
                    <?php } ?>
    
                    <?php if(in_array("id_tb_historico_status", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarCadastroHistoricoStatus'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="center">
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoStatus); $countArray++)
                                {
                                ?>
                                    <?php if($arrHistoricoStatus[$countArray][0] == $linhaHistorico['id_tb_historico_status']){ ?>
                                        <?php echo $arrHistoricoStatus[$countArray][1];?>
                                    <?php } ?>
                                <?php 
                                }
                                ?>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    
                    <?php if(in_array("forum_postagens", $arrExibirColunas) == true){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div>
                            <?php
                            $idTbForumTopicos = "";
                            $idTbForumTopicos = $linhaHistorico['id'];
                            
                            $resultadoForumPostagens = DbFuncoes::TabelaGenericaFill01_FetchAll("tb_forum_postagens", 
                                                                                                array("id_parent; " .$idTbForumTopicos. ";i"), 
                                                                                                $GLOBALS['configClassificacaoForumPostagens'], 
                                                                                                "");
                            
                            ?>
                            
                                <?php
                                if(empty($resultadoForumPostagens))
                                {
                                    //echo "Nenhum registro encontrado";
                                ?>
                                    <div align="center" class="AdmErro" style="display: none;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteMensagemForumPostagensVazio"); ?>
                                    </div>
                                <?php
                                }else{
                                ?>
                            
                                        <table width="100%" class="AdmTabelaDados01">
                                          <tr class="">
                                            
                                            <?php if($GLOBALS['habilitarForumPostagensNClassificacao'] == 1){ ?>
                                            <td width="50" class="AdmTabelaDados01Celula">
                                                <div align="center" class="AdmTexto02">
                                                    <?php if($GLOBALS['habilitarForumPostagensClassificacaoPersonalizada'] == 1){ ?>
                                                        <a href="SiteAdmClassificacaoPersonalizadaExe.php?idRegistro=<?php echo $idParentForumPostagens; ?>&strTabela=tb_forum_postagens&criterioClassificacao=n_classificacao<?php echo $queryPadrao; ?><?php echo $queryPadraoRetornoPaginacao; ?>" class="AdmLinks02">
                                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNClassificacaoA"); ?>
                                                        </a>
                                                     <?php }else{ ?>
                                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNClassificacaoA"); ?>
                                                    <?php } ?>
                                                </div>
                                            </td>
                                            <?php } ?>
                                            
                                            <td width="100" class="AdmTabelaDados01Celula" style="display: none;">
                                                <div align="center" class="AdmTexto02">
                                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemData"); ?>
                                                </div>
                                            </td>
                                            
                                            <td class="AdmTabelaDados01Celula">
                                                <div class="AdmTexto02" style="font-size: 9px !important;">
                                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloForumPostagensIc1'], "IncludeConfig");; ?>
                                                </div>
                                            </td>
                                            <td class="AdmTabelaDados01Celula">
                                                <div class="AdmTexto02" style="font-size: 9px !important;">
                                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloForumPostagensIc2'], "IncludeConfig");; ?>
                                                </div>
                                            </td>
                                            
                                            <td class="AdmTabelaDados01Celula">
                                                <div class="AdmTexto02" style="font-size: 9px !important;">
                                                    <?php if($GLOBALS['habilitarForumPostagensClassificacaoPersonalizada'] == 1){ ?>
                                                        <a href="SiteAdmClassificacaoPersonalizadaExe.php?idRegistro=<?php echo $idParentForumPostagens; ?>&strTabela=tb_forum_postagens&criterioClassificacao=processo<?php echo $queryPadrao; ?><?php echo $queryPadraoRetornoPaginacao; ?>" class="AdmLinks02">
                                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteForumPostagem"); ?>
                                                        </a>
                                                     <?php }else{ ?>
                                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteForumPostagem"); ?>
                                                    <?php } ?>
                                                </div>
                                            </td>
                                            
                                            <td width="100" class="AdmTabelaDados01Celula" style="display: none;">
                                                <div align="center" class="AdmTexto02">
                                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFuncoes"); ?>
                                                </div>
                                            </td>
                                            
                                            <td width="30" class="AdmTabelaDados01Celula" style="display: none;">
                                                <div align="center" class="AdmTexto02">
                                                    <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao"); ?>
                                                    <?php if($GLOBALS['habilitarForumPostagensClassificacaoPersonalizada'] == 1){ ?>
                                                        <a href="SiteAdmClassificacaoPersonalizadaExe.php?idRegistro=<?php echo $idParentForumPostagens; ?>&strTabela=tb_forum_postagens&criterioClassificacao=ativacao<?php echo $queryPadrao; ?><?php echo $queryPadraoRetornoPaginacao; ?>" class="AdmLinks02">
                                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao"); ?>
                                                        </a>
                                                     <?php }else{ ?>
                                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao"); ?>
                                                    <?php } ?>
                                                </div>
                                            </td>
                                            
                                          </tr>
                                          <?php
                                            $countTabelaFundo = 0;
                                            
                                            
                                            //Loop pelos resultados.
                                            foreach($resultadoForumPostagens as $linhaForumPostagens)
                                            {
                                          ?>
                                          <tr>
                                            
                                            <?php if($GLOBALS['habilitarForumPostagensNClassificacao'] == 1){ ?>
                                            <td class="AdmTabelaDados01Celula">
                                                <div align="center" class="AdmTexto01">
                                                    <?php echo $linhaForumPostagens['n_classificacao'];?>
                                                </div>
                                            </td>
                                            <?php } ?>
                                            
                                            <td class="AdmTabelaDados01Celula" style="display: none;">
                                                <div align="center" class="AdmTexto01">
                                                    <?php //echo $linhaForumPostagens['data_produto'];?>
                                                    <?php echo Funcoes::DataLeitura01($linhaForumPostagens['data_postagem'], $GLOBALS['configSiteFormatoData'], "2");?>
                                                </div>
                                            </td>
                                            
                                            <td class="AdmTabelaDados01Celula">
                                                <div class="AdmTexto01">
                                                    <?php echo Funcoes::ConteudoMascaraLeitura($linhaForumPostagens['informacao_complementar1']);?>
                                                </div>
                                            </td>
                                            <td class="AdmTabelaDados01Celula">
                                                <div class="AdmTexto01">
                                                    <?php echo Funcoes::ConteudoMascaraLeitura($linhaForumPostagens['informacao_complementar2']);?>
                                                </div>
                                            </td>
                            
                                            <td class="AdmTabelaDados01Celula">
                                                <div class="AdmTexto01">
                                                    <?php echo Funcoes::ConteudoMascaraLeitura($linhaForumPostagens['postagem']);?>
                                                </div>
                                            </td>
                                            
                                            <td class="AdmTabelaDados01Celula" style="display: none;">
                                                <div align="center" class="AdmTexto01">
                                                    <a href="../<?php echo $GLOBALS['visualizacaoAtivaSistema'];?>/SiteForumPostagensDetalhes.php?idTbForumPostagens=<?php echo $linhaForumPostagens['id'];?>" target="_blank" class="AdmLinks01">
                                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemVisualizacao"); ?>
                                                    </a>
                                                </div>
                                            </td>
                                            
                                            <td class="<?php if($linhaForumPostagens['ativacao'] == 1){/*echo "AdmTbFundoClaro";*/}else{echo "AdmTbFundoDesativado";}?> AdmTabelaDados01Celula" style="display: none;">
                                                <div align="center" class="AdmTexto01">
                                                    <a href="SiteAdmRegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaForumPostagens['id'];?>&statusAtivacao=<?php echo $linhaForumPostagens['ativacao'];?>&strTabela=tb_forum_postagens&strCampo=ativacao<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="AdmLinks01">
                                                        <?php if($linhaForumPostagens['ativacao'] == 0){?>
                                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao0"); ?>
                                                        <?php } ?>
                                                        <?php if($linhaForumPostagens['ativacao'] == 1){?>
                                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao1"); ?>
                                                        <?php } ?>
                                                    </a>
                                                    <?php //echo $linhaForumPostagens['ativacao'];?>
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
                                <?php } ?>
    
                            <?php
                            //Limpeza de objetos.
                            //----------
                            unset($resultadoForumPostagens);
                            unset($linhaForumPostagens);
                            //----------
                            ?>						
                            </div>
                        </td>
                    <?php } ?>
                    
                    <?php if(in_array("editar", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoAdmEdicao'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula" style="display: none;">
                            <div align="center">
                                <a href="SiteAdmHistoricoEditar.php?idTbHistorico=<?php echo $linhaHistorico['id'];?><?php echo $queryPadrao;?>" class="AdmLinks01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                                </a>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    
                    <?php if(in_array("excluir", $arrExibirColunas) == true){ ?>
                        <?php if($GLOBALS['habilitarHistoricoAdmExclusao'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula" style="display: none;">
                            <div align="center">
                                <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistorico['id'];?>" class="CampoCheckBox01" />
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array("selecionar", $arrExibirColunas) == true){ ?>
                    <td class="AdmTabelaDados01Celula" style="display: none;">
                        <div align="center">
                            <!--input name="idsRegistrosSelecionar[]" type="checkbox" value="<?php echo $linhaHistorico['id'];?>" class="AdmCampoCheckBox01" /-->
                            <input name="idsRegistrosSelecionar" type="radio" value="<?php echo $linhaHistorico['id'];?>" class="AdmCampoRadioButton01" />
                        </div>
                    </td>
                    <?php } ?>
                  </tr>
                  <?php 
                        //Limpeza de objetos.
                        //----------
                        unset($opdProdutoVinculado);
    
    
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
            </div>
            
            <div class="AdmTexto01" style="position: relative; display: none;">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteRelatoriosTotal"); ?>: <?php echo $countRegistros;?>
            </div>
        <?php } ?>
	<?php } ?>
    
    
    <?php if($relatoriosTipoVisualizacao == 3){ ?>
        <div align="center" style="position: relative; display: block; clear: both;">
            <?php //Charts.?>
            <?php //----------------------?>
            <?php 
            if($relatoriosTipoVisualizacao == 2)
            {
                $chartEstilo = "line";
            }
            if($relatoriosTipoVisualizacao == 3)
            {
                $chartEstilo = "pie";
            }
            if($relatoriosTipoVisualizacao == 4)
            {
                $chartEstilo = "bar";
            }
            
            
            //Definição de variáveis do include.
            $includeCharts_chartID = "2";
            $includeCharts_chartTipo = "1"; //1 - Canvas JS
            $includeCharts_chartEstilo = $chartEstilo; //Canvas JS (line, column, bar, area, spline, splineArea, stepLine, scatter, bubble, stackedColumn, stackedBar, stackedArea, stackedColumn100, stackedBar100, stackedArea100, pie, doughnut)
            $includeCharts_chartW = "800"; //pixels (120px) ou % (100%)
            $includeCharts_chartH = "600"; //pixels (120px) ou % (100%)
            
            $includeCharts_chartBarraW = "50"; //15
            $includeCharts_chartCorBarraPadrao = "#cccccc"; //#cccccc
            $includeCharts_chartCorTextos = "#000000"; //#cccccc
            $includeCharts_chartCorGrafico = "#efe4b0"; //#cccccc
            $includeCharts_chartLinhaGraficoXEspessura = "0"; //0 - invisível
            $includeCharts_chartLinhaGraficoYEspessura = "0"; //0 - invisível
            $includeCharts_chartEixoXMaximo = ""; //
            $includeCharts_chartEixoYMaximo = ""; //
            $includeCharts_chartEixoYIntervalo = ""; //
        
            $includeCharts_chartTitulo = "Gráfico dos Resultados";
            $includeCharts_chartTituloX = "";
            $includeCharts_chartTituloY = "";
            
            //$includeCharts_chartDados = "";
            //$includeCharts_chartDados = $_GET["includeCharts_chartDados"];
            /*
            ex:
            {label: 'apple', y: 50, color: '#ccc'},
            {label: 'orange', y: 15},
            {label: 'banana', y: 25},
            {label: 'mango', y: 30},
            {label: 'grape', y: 28}
            */
            $includeCharts_chartDados = "
            {label: 'Total de Registros', y: " . $qtdResultadoTotalRegistros . ", color: '#efe4b0'},
            {label: 'Resultados Encontrados', y: " . $qtdResultadoHistorico . ", color: '#00a2e8'}
            ";
            
            //$includeCharts_chartDadosMultiplos = $_GET["includeCharts_chartDadosMultiplos"];
            //$includeCharts_chartDadosMultiplos = Funcoes::GetQueryString("includeCharts_chartDadosMultiplos"); //alternativa para servidores com limitação de tamanho de querystring (suhosin.get.max_value_length);
            
            //Verificação de erro - debug.
            //echo "includeCharts_chartID=" . $includeCharts_chartID . "<br/>";
            //echo "includeCharts_chartTipo=" . $includeCharts_chartTipo . "<br/>";
            //echo "includeCharts_chartEstilo=" . $includeCharts_chartEstilo . "<br/>";
            //echo "includeCharts_chartW=" . $includeCharts_chartW . "<br/>";
            //echo "includeCharts_chartH=" . $includeCharts_chartH . "<br/>";
            //echo "includeCharts_chartBarraW=" . $includeCharts_chartBarraW . "<br/>";
            //echo "includeCharts_chartCorBarraPadrao=" . $includeCharts_chartCorBarraPadrao . "<br/>";
            //echo "includeCharts_chartCorTextos=" . $includeCharts_chartCorTextos . "<br/>";
            //echo "includeCharts_chartCorGrafico=" . $includeCharts_chartCorGrafico . "<br/>";
            //echo "includeCharts_chartLinhaGraficoXEspessura=" . $includeCharts_chartLinhaGraficoXEspessura . "<br/>";
            //echo "includeCharts_chartLinhaGraficoYEspessura=" . $includeCharts_chartLinhaGraficoYEspessura . "<br/>";
            //echo "includeCharts_chartDados=" . $includeCharts_chartDados . "<br/>";
            ?>
            
            <?php include "IncludeCharts.php";?>
            <?php //----------------------?>
        </div>
    <?php } ?>
<?php 
$pageSite->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>
<?php
//Limpeza de objetos.
//----------
unset($strSqlHistoricoSelect);
unset($statementHistoricoSelect);
unset($resultadoHistorico);
unset($linhaHistorico);
//----------


//Inclusão do template do layout.
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>