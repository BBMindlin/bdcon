<?php
//Recurso para permitir o redirecionamento (evitar duplicidade de header).
ob_start();


//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeUsuarioVerificacao.php";


//Verificação de login Master.
$idRegistro = $_GET["idRegistro"];
$strExcluir = $_GET["strExcluir"];
//$idParentCategorias = $_GET["idParentCategorias"];
$idParentCategorias = $idRegistro;
$criterioClassificacao = $_GET["criterioClassificacao"];

$strTabela = $_GET["strTabela"];

$dataInicial = $_GET["dataInicial"];
$dataFinal = $_GET["dataFinal"];
$dataInicialConvert = strtotime(Funcoes::DataGravacaoSql($dataInicial, $GLOBALS['configSistemaFormatoData']));
$dataFinalConvert = strtotime(Funcoes::DataGravacaoSql($dataFinal, $GLOBALS['configSistemaFormatoData']));

if($dataInicial == "")
{
	$diaDataInicial = $_GET["diaDataInicial"];
	$mesDataInicial = $_GET["mesDataInicial"];
	$anoDataInicial = $_GET["anoDataInicial"];
}else{
	$diaDataInicial = date('d', $dataInicialConvert);
	$mesDataInicial = date('m', $dataInicialConvert);
	$anoDataInicial = date('Y', $dataInicialConvert);
}

if($dataFinal == "")
{
	$diaDataFinal = $_GET["diaDataFinal"];
	$mesDataFinal = $_GET["mesDataFinal"];
	$anoDataFinal = $_GET["anoDataFinal"];
}else{
	$diaDataFinal = date('d', $dataFinalConvert);
	$mesDataFinal = date('m', $dataFinalConvert);
	$anoDataFinal = date('Y', $dataFinalConvert);
}

$idTbCadastro = $_GET["idTbCadastro"];
$idTbCadastroUsuario = $_GET["idTbCadastroUsuario"];

$variavelRetorno = $_GET["variavelRetorno"];
$paginaRetorno = $_GET["paginaRetorno"];
$mensagemErro = "";
$mensagemSucesso = "";

$paginacaoNumero = $_GET["paginacaoNumero"];


//Verificação de erro - debug.
echo "dataInicial=" . $dataInicial . "<br>";
echo "dataFinal=" . $dataFinal . "<br>";
echo "dataInicialConvert=" . $dataInicialConvert . "<br>";
echo "dataInicialConvert (d)=" . date('d', $dataInicialConvert) . "<br>";

echo "diaDataInicial=" . $diaDataInicial . "<br>";
echo "mesDataInicial=" . $mesDataInicial . "<br>";
echo "anoDataInicial=" . $anoDataInicial . "<br>";

echo "diaDataFinal=" . $diaDataFinal . "<br>";
echo "mesDataFinal=" . $mesDataFinal . "<br>";
echo "anoDataFinal=" . $anoDataFinal . "<br>";
//exit();


if($strExcluir == "1")
{
		//Exclusão de registro no BD.
		//----------
		$StrExcluirRegistrosGenerico = "";
		$StrExcluirRegistrosGenerico .= "DELETE FROM classificacao ";
		//$StrExcluirRegistrosGenerico .= "id <> 0 "
		$StrExcluirRegistrosGenerico .= "WHERE tabela = :strTabela ";
		$StrExcluirRegistrosGenerico .= "AND id_registro = :id_registro";
		
		$statementExcluirRegistrosGenerico = $GLOBALS['dbSistemaConPDO']->prepare($StrExcluirRegistrosGenerico);
		
		if($statementExcluirRegistrosGenerico !== false)
		{
			$statementExcluirRegistrosGenerico->execute(array(
				"strTabela" => $strTabela,
				"id_registro" => $idRegistro
			));
			$strRetorno = true;
			$mensagemSucesso = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus20");
		}else{
			//echo "erro";
			$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus15");
		}
		//----------
		
		//Verificação e erro.
		//echo "StrExcluirRegistrosGenerico=" . $StrExcluirRegistrosGenerico . "<br />";

		//Limpeza de objetos.
		unset($StrExcluirRegistrosGenerico);
		unset($statementExcluirRegistrosGenerico);
		//----------
}else{

	//Query de pesquisa.
	//----------
	$strSqlClassificacaoPersonalizadaSelect = "";
	$strSqlClassificacaoPersonalizadaSelect .= "SELECT ";
	$strSqlClassificacaoPersonalizadaSelect .= "id_registro, ";
	$strSqlClassificacaoPersonalizadaSelect .= "criterio_classificacao, ";
	$strSqlClassificacaoPersonalizadaSelect .= "tabela, ";
	$strSqlClassificacaoPersonalizadaSelect .= "dia_data_inicial, ";
	$strSqlClassificacaoPersonalizadaSelect .= "mes_data_inicial, ";
	$strSqlClassificacaoPersonalizadaSelect .= "ano_data_inicial, ";
	$strSqlClassificacaoPersonalizadaSelect .= "dia_data_final, ";
	$strSqlClassificacaoPersonalizadaSelect .= "mes_data_final, ";
	$strSqlClassificacaoPersonalizadaSelect .= "ano_data_final ";
	$strSqlClassificacaoPersonalizadaSelect .= "FROM classificacao ";
	
	$strSqlClassificacaoPersonalizadaSelect .= "WHERE id_registro = :id_registro ";
	if($strTabela <> "")
	{
		$strSqlClassificacaoPersonalizadaSelect .= "AND tabela = :tabela ";
	}
	//$strSqlClassificacaoPersonalizadaSelect .= "AND id_parent = ? ";
	//$strSqlClassificacaoPersonalizadaSelect .= "AND id_parent = " . $idParentCategorias . " ";
	//$strSqlClassificacaoPersonalizadaSelect .= "AND id_parent = :id_parent ";
	//$strSqlClassificacaoPersonalizadaSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCategorias'] . " ";
	
	$statementClassificacaoPersonalizadaSelect = $dbSistemaConPDO->prepare($strSqlClassificacaoPersonalizadaSelect);
	
		$statementClassificacaoPersonalizadaSelect->bindParam(':id_registro', $idRegistro, PDO::PARAM_STR);
		if($strTabela <> "")
		{
			$statementClassificacaoPersonalizadaSelect->bindParam(':tabela', $strTabela, PDO::PARAM_STR);
		}
		$statementClassificacaoPersonalizadaSelect->execute();

		/*
		$statementClassificacaoPersonalizadaSelect->execute(array(
			"id_registro" => $idRegistro
		));
		*/
	$resultadoClassificacaoPersonalizada = $statementClassificacaoPersonalizadaSelect->fetchAll();
	
	
	
	
	
	if (empty($resultadoClassificacaoPersonalizada)) //Verificação se já tem registro deste critério.
	{
		//Não existe registros.
		//echo "Não existe registros." . "<br />";
		
		//Inclusão de registro no BD.
		//----------
		$strSqlClassificacaoPersonalizadaInsert = "";
		$strSqlClassificacaoPersonalizadaInsert .= "INSERT INTO classificacao ";
		$strSqlClassificacaoPersonalizadaInsert .= "SET ";
		$strSqlClassificacaoPersonalizadaInsert .= "id_registro = :id_registro, ";
		$strSqlClassificacaoPersonalizadaInsert .= "criterio_classificacao = :criterio_classificacao, ";
		$strSqlClassificacaoPersonalizadaInsert .= "tabela = :tabela, ";
		$strSqlClassificacaoPersonalizadaInsert .= "dia_data_inicial = :dia_data_inicial, ";
		$strSqlClassificacaoPersonalizadaInsert .= "mes_data_inicial = :mes_data_inicial, ";
		$strSqlClassificacaoPersonalizadaInsert .= "ano_data_inicial = :ano_data_inicial, ";
		$strSqlClassificacaoPersonalizadaInsert .= "dia_data_final = :dia_data_final, ";
		$strSqlClassificacaoPersonalizadaInsert .= "mes_data_final = :mes_data_final, ";
		$strSqlClassificacaoPersonalizadaInsert .= "ano_data_final = :ano_data_final ";
		
		$statementClassificacaoPersonalizadaInsert = $dbSistemaConPDO->prepare($strSqlClassificacaoPersonalizadaInsert);
		
		if ($statementClassificacaoPersonalizadaInsert !== false)
		{
			$statementClassificacaoPersonalizadaInsert->execute(array(
				"id_registro" => $idRegistro,
				"criterio_classificacao" => $criterioClassificacao,
				"tabela" => $strTabela,
				"dia_data_inicial" => $diaDataInicial,
				"mes_data_inicial" => $mesDataInicial,
				"ano_data_inicial" => $anoDataInicial,
				"dia_data_final" => $diaDataFinal,
				"mes_data_final" => $mesDataFinal,
				"ano_data_final" => $anoDataFinal
			));
			
			$mensagemSucesso = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus20");
		}else{
			//echo "erro";
			$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus3");
		}
		
		//Limpeza de objetos.
		unset($strSqlClassificacaoPersonalizadaInsert);
		unset($statementClassificacaoPersonalizadaInsert);
		//unset($linhaCategorias);
		//----------
		
	}else{
		//Executar update.
		//Registro existente.
		//echo "Registro existente." . "<br />";
		
		//Update de registro no BD.
		//----------
		$strSqlClassificacaoPersonalizadaUpdate= "";
		$strSqlClassificacaoPersonalizadaUpdate.= "UPDATE classificacao ";
		$strSqlClassificacaoPersonalizadaUpdate.= "SET ";
		$strSqlClassificacaoPersonalizadaUpdate.= "id_registro = :id_registro, ";
		$strSqlClassificacaoPersonalizadaUpdate.= "criterio_classificacao = :criterio_classificacao, ";
		$strSqlClassificacaoPersonalizadaUpdate.= "tabela = :tabela, ";
		$strSqlClassificacaoPersonalizadaUpdate.= "dia_data_inicial = :dia_data_inicial, ";
		$strSqlClassificacaoPersonalizadaUpdate.= "mes_data_inicial = :mes_data_inicial, ";
		$strSqlClassificacaoPersonalizadaUpdate.= "ano_data_inicial = :ano_data_inicial, ";
		$strSqlClassificacaoPersonalizadaUpdate.= "dia_data_final = :dia_data_final, ";
		$strSqlClassificacaoPersonalizadaUpdate.= "mes_data_final = :mes_data_final, ";
		$strSqlClassificacaoPersonalizadaUpdate.= "ano_data_final = :ano_data_final ";
		
		$strSqlClassificacaoPersonalizadaUpdate.= "WHERE id_registro = :id_registro ";
		$strSqlClassificacaoPersonalizadaUpdate.= "AND tabela = :tabela ";
		
		$statementClassificacaoPersonalizadaUpdate= $dbSistemaConPDO->prepare($strSqlClassificacaoPersonalizadaUpdate);
		
		if ($statementClassificacaoPersonalizadaUpdate!== false)
		{
			$statementClassificacaoPersonalizadaUpdate->execute(array(
				"id_registro" => $idRegistro,
				"criterio_classificacao" => $criterioClassificacao,
				"tabela" => $strTabela,
				"dia_data_inicial" => $diaDataInicial,
				"mes_data_inicial" => $mesDataInicial,
				"ano_data_inicial" => $anoDataInicial,
				"dia_data_final" => $diaDataFinal,
				"mes_data_final" => $mesDataFinal,
				"ano_data_final" => $anoDataFinal
			));
			
			$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus7");
		}else{
			//echo "erro";
			$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus8");
		}
		
		//Limpeza de objetos.
		unset($strSqlClassificacaoPersonalizadaUpdate);
		unset($statementClassificacaoPersonalizadaUpdate);
		//unset($linhaCategorias);
		//----------

		
		/*
		if(DbUpdate::DbRegistroGenericoUpdate02($criterioClassificacao, $idRegistro, "classificacao", "criterio_classificacao", "id_registro") == true)
		{
			$mensagemSucesso = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus20");
		}else{
			$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus8");
		}
		*/
	}
	
	
	//Verificação de erro.
	//echo "strSqlClassificacaoPersonalizadaSelect=" . $strSqlClassificacaoPersonalizadaSelect . "<br>";
	//echo "strSqlClassificacaoPersonalizadaInsert=" . $strSqlClassificacaoPersonalizadaInsert . "<br>";
	//echo "idRegistro=" . $idRegistro . "<br>";
	//echo "idParentCategorias=" . $idParentCategorias . "<br>";
	//echo "criterioClassificacao=" . $criterioClassificacao . "<br>";
	//echo "strTabela=" . $strTabela . "<br>";
	//echo "paginaRetorno=" . $paginaRetorno . "<br>";
	//echo "mensagemSucesso=" . $mensagemSucesso . "<br>";
	//echo "mensagemErro=" . $mensagemErro . "<br>";
	//echo "statementClassificacaoPersonalizadaSelect=" . $statementClassificacaoPersonalizadaSelect . "<br>";
	//echo "resultadoClassificacaoPersonalizada=" . $resultadoClassificacaoPersonalizada . "<br>";
	
	
	//Limpeza de objetos.
	unset($strSqlClassificacaoPersonalizadaSelect);
	unset($statementClassificacaoPersonalizadaSelect);
	unset($resultadoClassificacaoPersonalizada);
	//unset($linhaCategorias);
	//----------
}


//Fechamento da conexão.
$dbSistemaConPDO = null;


//Montagem do URL de retorno.
//"idParentCategorias=" . $idParentCategorias .

$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
$variavelRetorno . "=" . $idRegistro .
"&idTbCadastroUsuario=" . $idTbCadastroUsuario .
"&paginacaoNumero=" . $paginacaoNumero .
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
