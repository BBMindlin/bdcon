<?php
//Recurso para permitir o redirecionamento (evitar duplicidade de header).
ob_start();


//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
//require_once "IncludeUsuarioVerificacao.php";
require_once "IncludeLayout.php";


//Resgate de variáveis.
//$id = ContadorUniversal::ContadorUniversalUpdate(1);
$id = $_POST["idTbForumTopicos"];
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

//if($dataTopico == "")
//{
	//$data_publicacao = NULL;	
	//$dataTopico = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");;	
//}

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


//Update de registro no BD.
//----------
$strSqlForumTopicosUpdate = "";
$strSqlForumTopicosUpdate .= "UPDATE tb_forum_topicos ";
$strSqlForumTopicosUpdate .= "SET ";
//$strSqlForumTopicosUpdate .= "id = :id, ";
$strSqlForumTopicosUpdate .= "id_tb_categorias = :id_tb_categorias, ";
$strSqlForumTopicosUpdate .= "id_tb_cadastro_vendedor = :id_tb_cadastro_vendedor, ";
$strSqlForumTopicosUpdate .= "id_tb_cadastro_usuario = :id_tb_cadastro_usuario, ";
$strSqlForumTopicosUpdate .= "n_classificacao = :n_classificacao, ";
//$strSqlForumTopicosUpdate .= "data_topico = :data_topico, ";
$strSqlForumTopicosUpdate .= "topico = :topico, ";
$strSqlForumTopicosUpdate .= "assunto = :assunto, ";
$strSqlForumTopicosUpdate .= "ativacao = :ativacao, ";
$strSqlForumTopicosUpdate .= "acesso_restrito = :acesso_restrito ";
$strSqlForumTopicosUpdate .= "WHERE id = :id ";
//echo "strSqlCategoriasUpdate = " . $strSqlForumTopicosUpdate . "<br />";
//----------


//Parametros e execução.
//----------
$statementForumTopicosUpdate = $dbSistemaConPDO->prepare($strSqlForumTopicosUpdate);

/*
"data_topico" => $dataTopico,
*/
if ($statementForumTopicosUpdate !== false)
{
	$statementForumTopicosUpdate->execute(array(
		"id" => $id,
		"id_tb_categorias" => $idTbCategorias,
		"id_tb_cadastro_vendedor" => $idTbCadastroVendedor,
		"id_tb_cadastro_usuario" => $idTbCadastroUsuario,
		"n_classificacao" => $nClassificacao,
		"topico" => $topico,
		"assunto" => $assunto,
		"ativacao" => $ativacao,
		"acesso_restrito" => $acessoRestrito
	));
	
	$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus7");
}else{
	//echo "erro";
	$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus8");
}
//----------


//Limpeza de objetos.
//----------
unset($strSqlForumTopicosUpdate);
unset($statementForumTopicosUpdate);
//----------


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
//$dbSistemaConMysqli->close();
$dbSistemaConPDO = null;


//Montagem do URL de retorno.
$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
"idParent=" . $idTbCategorias .
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