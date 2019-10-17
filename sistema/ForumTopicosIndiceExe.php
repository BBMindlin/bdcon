<?php
//Recurso para permitir o redirecionamento (evitar duplicidade de header).
ob_start();


//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeLayout.php";


//Resgate de variáveis.
$id = ContadorUniversal::ContadorUniversalUpdate(1);
$idTbCategorias = $_POST["id_tb_categorias"];

$idTbCadastroVendedor = $_POST["id_tb_cadastro_vendedor"];
if($idTbCadastroVendedor == "")
{
	$idTbCadastroVendedor = 0;
}
$idTbCadastroUsuario = $_POST["id_tb_cadastro_usuario"];
if($idTbCadastroUsuario == "")
{
	$idTbCadastroUsuario = 0;
}

$nClassificacao = $_POST["n_classificacao"];
if($nClassificacao == "")
{
	$nClassificacao = 0;
}

//$dataPublicacao = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");
//$dataTopico = Funcoes::DataGravacaoSql($_POST["data_topico"], $GLOBALS['configSistemaFormatoData']);
if($dataTopico == "")
{
	//$data_publicacao = NULL;	
	$dataTopico = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");	
}

$topico = Funcoes::ConteudoMascaraGravacao01($_POST["topico"]);
$assunto = Funcoes::ConteudoMascaraGravacao01($_POST["assunto"]);
$ativacao = $_POST["ativacao"];
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


//Montagem do query.
//----------
$strSqlForumTopicosInsert = "";
$strSqlForumTopicosInsert .= "INSERT INTO tb_forum_topicos ";
$strSqlForumTopicosInsert .= "SET ";
$strSqlForumTopicosInsert .= "id = :id, ";
$strSqlForumTopicosInsert .= "id_tb_categorias = :id_tb_categorias, ";
$strSqlForumTopicosInsert .= "id_tb_cadastro_vendedor = :id_tb_cadastro_vendedor, ";
$strSqlForumTopicosInsert .= "id_tb_cadastro_usuario = :id_tb_cadastro_usuario, ";
$strSqlForumTopicosInsert .= "n_classificacao = :n_classificacao, ";
$strSqlForumTopicosInsert .= "data_topico = :data_topico, ";
$strSqlForumTopicosInsert .= "topico = :topico, ";
$strSqlForumTopicosInsert .= "assunto = :assunto, ";
$strSqlForumTopicosInsert .= "ativacao = :ativacao, ";
$strSqlForumTopicosInsert .= "acesso_restrito = :acesso_restrito ";
//----------


//Parametros e execução.
//----------
$statementForumTopicosInsert = $dbSistemaConPDO->prepare($strSqlForumTopicosInsert);

if ($statementForumTopicosInsert !== false)
{
	$statementForumTopicosInsert->execute(array(
		"id" => $id,
		"id_tb_categorias" => $idTbCategorias,
		"id_tb_cadastro_vendedor" => $idTbCadastroVendedor,
		"id_tb_cadastro_usuario" => $idTbCadastroUsuario,
		"n_classificacao" => $nClassificacao,
		"data_topico" => $dataTopico,
		"topico" => $topico,
		"assunto" => $assunto,
		"ativacao" => $ativacao,
		"acesso_restrito" => $acessoRestrito
	));
	
	$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus2");
	//Obs: Colocar um flag de verificação de gravação.
}else{
	//echo "erro";
	$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus3");
}
//----------


//Limpeza de objetos.
//----------
unset($strSqlForumTopicosInsert);
unset($statementForumTopicosInsert);
//----------


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
//$dbSistemaConMysqli->close();
$dbSistemaConPDO = null;


//Montagem do URL de retorno.
$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
"idParent=" . $idTbCategorias . 
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