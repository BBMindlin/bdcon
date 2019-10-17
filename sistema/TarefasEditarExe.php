<?php
//Recurso para permitir o redirecionamento (evitar duplicidade de header).
ob_start();


//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeLayout.php";


//Resgate de variáveis.
//$id = ContadorUniversal::ContadorUniversalUpdate(1);
$id = $_POST["idTbTarefas"];
$idParent = $_POST["id_parent"];

//$dataRegistroTarefa = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");
//$dataTarefa = Funcoes::DataGravacaoSql($_POST["data_tarefa"], $GLOBALS['configSistemaFormatoData']) . " " . date("H") . ":" . date("i") . ":" . date("s");
$dataTarefa = Funcoes::DataGravacaoSql($_POST["data_tarefa"], $GLOBALS['configSistemaFormatoData']); //. " " . date("H") . ":" . date("i") . ":" . date("s");
if($GLOBALS['habilitarTarefasDataHorario'] == 1)
{
	$dataTarefa = $dataTarefa . " " . $_POST["data_tarefa_hora"] . ":" . $_POST["data_tarefa_minuto"] . ":" . "0";
}

$dataTarefaFinal = Funcoes::DataGravacaoSql($_POST["data_tarefa_final"], $GLOBALS['configSistemaFormatoData']); //. " " . date("H") . ":" . date("i") . ":" . date("s")
if($dataTarefaFinal == "")
{
	$dataTarefaFinal = NULL;	
}

$idTbCadastroUsuario = $_POST["id_tb_cadastro_usuario"];
if($idTbCadastroUsuario == "")
{
	$idTbCadastroUsuario = 0;
}

$tarefa = Funcoes::ConteudoMascaraGravacao01($_POST["tarefa"]);
$descricao = Funcoes::ConteudoMascaraGravacao01($_POST["descricao"]);

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

$idTbTarefaStatus = $_POST["id_tb_tarefa_status"];
if($idTbTarefaStatus == "")
{
	$idTbTarefaStatus = 0;
}
$idTbTarefaProcessos = $_POST["id_tb_processos"];

$ativacao = Funcoes::ConteudoMascaraGravacao01($_POST["ativacao"]);

$paginaRetorno = $_POST["paginaRetorno"];
$mensagemErro = "";
$mensagemSucesso = "";

//Montagem de query padrão de retorno.
$queryPadrao = "&masterPageSelect=" . $masterPageSelect;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Update de registro no BD.
//----------
$strSqlTarefasUpdate = "";
$strSqlTarefasUpdate .= "UPDATE tb_tarefas ";
$strSqlTarefasUpdate .= "SET ";
//$strSqlTarefasUpdate .= "id = :id, ";
$strSqlTarefasUpdate .= "id_parent = :id_parent, ";
//$strSqlTarefasUpdate .= "data_registro_tarefa = :data_registro_tarefa, ";
$strSqlTarefasUpdate .= "data_tarefa = :data_tarefa, ";
$strSqlTarefasUpdate .= "data_tarefa_final = :data_tarefa_final, ";
$strSqlTarefasUpdate .= "id_tb_cadastro_usuario = :id_tb_cadastro_usuario, ";
$strSqlTarefasUpdate .= "tarefa = :tarefa, ";
$strSqlTarefasUpdate .= "descricao = :descricao, ";
$strSqlTarefasUpdate .= "id_tb_cadastro1 = :id_tb_cadastro1, ";
$strSqlTarefasUpdate .= "id_tb_cadastro2 = :id_tb_cadastro2, ";
$strSqlTarefasUpdate .= "id_tb_cadastro3 = :id_tb_cadastro3, ";
$strSqlTarefasUpdate .= "informacao_complementar1 = :informacao_complementar1, ";
$strSqlTarefasUpdate .= "informacao_complementar2 = :informacao_complementar2, ";
$strSqlTarefasUpdate .= "informacao_complementar3 = :informacao_complementar3, ";
$strSqlTarefasUpdate .= "informacao_complementar4 = :informacao_complementar4, ";
$strSqlTarefasUpdate .= "informacao_complementar5 = :informacao_complementar5, ";
$strSqlTarefasUpdate .= "id_tb_tarefa_status = :id_tb_tarefa_status, ";
$strSqlTarefasUpdate .= "ativacao = :ativacao ";
$strSqlTarefasUpdate .= "WHERE id = :id ";
//echo "strSqlCategoriasUpdate = " . $strSqlTarefasUpdate . "<br />";
//----------


//Parâmetros.
//----------
$statementTarefasUpdate = $dbSistemaConPDO->prepare($strSqlTarefasUpdate);


/*
"data_registro_tarefa" => $dataRegistroTarefa,
*/
if ($statementTarefasUpdate !== false)
{
	$statementTarefasUpdate->execute(array(
		"id" => $id,
		"id_parent" => $idParent,
		"data_tarefa" => $dataTarefa,
		"data_tarefa_final" => $dataTarefaFinal,
		"id_tb_cadastro_usuario" => $idTbCadastroUsuario,
		"tarefa" => $tarefa,
		"descricao" => $descricao,
		"id_tb_cadastro1" => $idTbCadastro1,
		"id_tb_cadastro2" => $idTbCadastro2,
		"id_tb_cadastro3" => $idTbCadastro3,
		"informacao_complementar1" => $informacaoComplementar1,
		"informacao_complementar2" => $informacaoComplementar2,
		"informacao_complementar3" => $informacaoComplementar3,
		"informacao_complementar4" => $informacaoComplementar4,
		"informacao_complementar5" => $informacaoComplementar5,
		"id_tb_tarefa_status" => $idTbTarefaStatus,
		"ativacao" => $ativacao
	));
	
	$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus7");
}else{
	//echo "erro";
	$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus8");
}
//----------


//Limpeza de objetos.
//----------
unset($strSqlTarefasUpdate);
unset($statementTarefasUpdate);
//----------


//Gravação de vínculos.
//**************************************************************************************
//Processos.
//----------
if($GLOBALS['habilitarTarefasVinculoProcessos'] == 1)
{
	if(!empty($idTbTarefaProcessos) && $idTbTarefaProcessos <> 0){
		if(DbFuncoes::ItensRelacaoRegistroInsert($id, $idTbTarefaProcessos, "29", "tb_processos") == true)
		{
			//Gravou.
		}else{
			//Não gravou.
		}
	}
}
//----------
//**************************************************************************************


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
//$dbSistemaConMysqli->close();
$dbSistemaConPDO = null;


//Montagem do URL de retorno.
$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
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