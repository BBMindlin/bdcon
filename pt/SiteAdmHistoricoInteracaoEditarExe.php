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
//$id = ContadorUniversal::ContadorUniversalUpdate(1);
$id = $_POST["idTbHistoricoInteracao"];
$idParent = $_POST["id_parent"];

$idTbCadastroUsuario = $_POST["id_tb_cadastro_usuario"];
if($idTbCadastroUsuario == "")
{
	$idTbCadastroUsuario = 0;
}

//$dataHistoricoInteracao = Funcoes::DataGravacaoSql($_POST["data_historico"], $GLOBALS['configSistemaFormatoData']) . " " . date("H") . ":" . date("i") . ":" . date("s");
if($configCadastroHistoricoDataEdicao == 1)
{
	$dataInteracao = Funcoes::DataGravacaoSql($_POST["data_interacao"], $GLOBALS['configSistemaFormatoData']) . " " . date("H") . ":" . date("i") . ":" . date("s");
}
if($configCadastroHistoricoDataEdicao == 0)
{
	//$dataHistoricoInteracao = Funcoes::DataGravacaoSql(DbFuncoes::GetCampoGenerico01($id, "tb_historico", "data_historico"), $GLOBALS['configSistemaFormatoData']);
	$dataInteracao = DbFuncoes::GetCampoGenerico01($id, "tb_historico_interacao", "data_interacao");
}

$assunto = Funcoes::ConteudoMascaraGravacao01($_POST["assunto"]);
$interacao = Funcoes::ConteudoMascaraGravacao01($_POST["interacao"]);

$paginaRetorno = $_POST["paginaRetorno"];
$mensagemErro = "";
$mensagemSucesso = "";

//Montagem de query padrão de retorno.
$queryPadrao = "&masterPageSelect=" . $masterPageSelect;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Update de registro no BD.
//----------
$strSqlHistoricoInteracaoUpdate = "";
$strSqlHistoricoInteracaoUpdate .= "UPDATE tb_historico_interacao ";
$strSqlHistoricoInteracaoUpdate .= "SET ";
//$strSqlHistoricoInteracaoUpdate .= "id = :id, ";
$strSqlHistoricoInteracaoUpdate .= "id_parent = :id_parent, ";
$strSqlHistoricoInteracaoUpdate .= "id_tb_cadastro_usuario = :id_tb_cadastro_usuario, ";
//if($configCadastroHistoricoInteracaoDataEdicao == 1) //não funcionou
//{
$strSqlHistoricoInteracaoUpdate .= "data_interacao = :data_interacao, ";
//}
$strSqlHistoricoInteracaoUpdate .= "assunto = :assunto, ";
$strSqlHistoricoInteracaoUpdate .= "interacao = :interacao ";
$strSqlHistoricoInteracaoUpdate .= "WHERE id = :id ";
//echo "strSqlCategoriasUpdate = " . $strSqlHistoricoInteracaoUpdate . "<br />";
//----------


$statementHistoricoInteracaoUpdate = $dbSistemaConPDO->prepare($strSqlHistoricoInteracaoUpdate);


/*
"data_criacao" => $dataCriacao,
*/
if ($statementHistoricoInteracaoUpdate !== false)
{
	$statementHistoricoInteracaoUpdate->execute(array(
		"id" => $id,
		"id_parent" => $idParent,
		"id_tb_cadastro_usuario" => $idTbCadastroUsuario,
		"data_interacao" => $dataInteracao,
		"assunto" => $assunto,
		"interacao" => $interacao
	));
	
	$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus7");
}else{
	//echo "erro";
	$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus8");
}


//Limpeza de objetos.
unset($strSqlHistoricoInteracaoUpdate);
unset($statementHistoricoInteracaoUpdate);
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