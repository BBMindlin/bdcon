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
$id = $_POST["idTbForumPostagens"];
$idParent = $_POST["id_parent"];

$idTbCadastroUsuario = $_POST["id_tb_cadastro_usuario"];
if($idTbCadastroUsuario == "")
{
	$idTbCadastroUsuario = 0;
}

$nome = Funcoes::ConteudoMascaraGravacao01($_POST["nome"]);
$email = Funcoes::ConteudoMascaraGravacao01($_POST["email"]);

$nClassificacao = $_POST["n_classificacao"];
if($nClassificacao == "")
{
	$nClassificacao = 0;
}

//$dataPublicacao = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");
//$dataTopico = Funcoes::DataGravacaoSql($_POST["data_topico"], $GLOBALS['configSistemaFormatoData']);
if($dataPostagem == "")
{
	//$data_publicacao = NULL;	
	$dataPostagem = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");	
}

$postagem = Funcoes::ConteudoMascaraGravacao01($_POST["postagem"]);

$notaAvaliacao = $_POST["nota_avaliacao"];
if($notaAvaliacao == "")
{
	$notaAvaliacao = 0;
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

$ativacao = $_POST["ativacao"];

$paginaRetorno = $_POST["paginaRetorno"];
$mensagemErro = "";
$mensagemSucesso = "";


//Update de registro no BD.
//----------
$strSqlForumPostagensUpdate = "";
$strSqlForumPostagensUpdate .= "UPDATE tb_forum_postagens ";
$strSqlForumPostagensUpdate .= "SET ";
//$strSqlForumPostagensUpdate .= "id = :id, ";
$strSqlForumPostagensUpdate .= "id_parent = :id_parent, ";
$strSqlForumPostagensUpdate .= "id_tb_cadastro_usuario = :id_tb_cadastro_usuario, ";
$strSqlForumPostagensUpdate .= "nome = :nome, ";
$strSqlForumPostagensUpdate .= "email = :email, ";
$strSqlForumPostagensUpdate .= "n_classificacao = :n_classificacao, ";
//$strSqlForumPostagensUpdate .= "data_postagem = :data_postagem, ";
$strSqlForumPostagensUpdate .= "postagem = :postagem, ";
$strSqlForumPostagensUpdate .= "nota_avaliacao = :nota_avaliacao, ";
$strSqlForumPostagensUpdate .= "informacao_complementar1 = :informacao_complementar1, ";
$strSqlForumPostagensUpdate .= "informacao_complementar2 = :informacao_complementar2, ";
$strSqlForumPostagensUpdate .= "informacao_complementar3 = :informacao_complementar3, ";
$strSqlForumPostagensUpdate .= "informacao_complementar4 = :informacao_complementar4, ";
$strSqlForumPostagensUpdate .= "informacao_complementar5 = :informacao_complementar5, ";
$strSqlForumPostagensUpdate .= "informacao_complementar6 = :informacao_complementar6, ";
$strSqlForumPostagensUpdate .= "informacao_complementar7 = :informacao_complementar7, ";
$strSqlForumPostagensUpdate .= "informacao_complementar8 = :informacao_complementar8, ";
$strSqlForumPostagensUpdate .= "informacao_complementar9 = :informacao_complementar9, ";
$strSqlForumPostagensUpdate .= "informacao_complementar10 = :informacao_complementar10, ";
$strSqlForumPostagensUpdate .= "ativacao = :ativacao ";
$strSqlForumPostagensUpdate .= "WHERE id = :id ";
//echo "strSqlCategoriasUpdate = " . $strSqlForumPostagensUpdate . "<br />";
//----------


//Parametros e execução.
//----------
$statementForumPostagensUpdate = $dbSistemaConPDO->prepare($strSqlForumPostagensUpdate);

/*
"data_postagem" => $dataPostagem,
*/
if ($statementForumPostagensUpdate !== false)
{
	$statementForumPostagensUpdate->execute(array(
		"id" => $id,
		"id_parent" => $idParent,
		"id_tb_cadastro_usuario" => $idTbCadastroUsuario,
		"nome" => $nome,
		"email" => $email,
		"n_classificacao" => $nClassificacao,
		"postagem" => $postagem,
		"nota_avaliacao" => $notaAvaliacao,
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
unset($strSqlForumPostagensUpdate);
unset($statementForumPostagensUpdate);
//----------


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
//$dbSistemaConMysqli->close();
$dbSistemaConPDO = null;


//Montagem do URL de retorno.
$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
"idTbForumTopicos=" . $idParent .
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