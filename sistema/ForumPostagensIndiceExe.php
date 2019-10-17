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


//Montagem de query padrão de retorno.
$queryPadrao = "&masterPageSelect=" . $masterPageSelect;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Montagem do query.
//----------
$strSqlForumPostagensInsert = "";
$strSqlForumPostagensInsert .= "INSERT INTO tb_forum_postagens ";
$strSqlForumPostagensInsert .= "SET ";
$strSqlForumPostagensInsert .= "id = :id, ";
$strSqlForumPostagensInsert .= "id_parent = :id_parent, ";
$strSqlForumPostagensInsert .= "id_tb_cadastro_usuario = :id_tb_cadastro_usuario, ";
$strSqlForumPostagensInsert .= "nome = :nome, ";
$strSqlForumPostagensInsert .= "email = :email, ";
$strSqlForumPostagensInsert .= "n_classificacao = :n_classificacao, ";
$strSqlForumPostagensInsert .= "data_postagem = :data_postagem, ";
$strSqlForumPostagensInsert .= "postagem = :postagem, ";
$strSqlForumPostagensInsert .= "nota_avaliacao = :nota_avaliacao, ";
$strSqlForumPostagensInsert .= "informacao_complementar1 = :informacao_complementar1, ";
$strSqlForumPostagensInsert .= "informacao_complementar2 = :informacao_complementar2, ";
$strSqlForumPostagensInsert .= "informacao_complementar3 = :informacao_complementar3, ";
$strSqlForumPostagensInsert .= "informacao_complementar4 = :informacao_complementar4, ";
$strSqlForumPostagensInsert .= "informacao_complementar5 = :informacao_complementar5, ";
$strSqlForumPostagensInsert .= "informacao_complementar6 = :informacao_complementar6, ";
$strSqlForumPostagensInsert .= "informacao_complementar7 = :informacao_complementar7, ";
$strSqlForumPostagensInsert .= "informacao_complementar8 = :informacao_complementar8, ";
$strSqlForumPostagensInsert .= "informacao_complementar9 = :informacao_complementar9, ";
$strSqlForumPostagensInsert .= "informacao_complementar10 = :informacao_complementar10, ";
$strSqlForumPostagensInsert .= "ativacao = :ativacao ";
//----------


//Parametros e execução.
//----------
$statementForumPostagensInsert = $dbSistemaConPDO->prepare($strSqlForumPostagensInsert);

if ($statementForumPostagensInsert !== false)
{
	$statementForumPostagensInsert->execute(array(
		"id" => $id,
		"id_parent" => $idParent,
		"id_tb_cadastro_usuario" => $idTbCadastroUsuario,
		"nome" => $nome,
		"email" => $email,
		"n_classificacao" => $nClassificacao,
		"data_postagem" => $dataPostagem,
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
	
	$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus2");
	//Obs: Colocar um flag de verificação de gravação.
}else{
	//echo "erro";
	$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus3");
}
//----------


//Limpeza de objetos.
//----------
unset($strSqlForumPostagensInsert);
unset($statementForumPostagensInsert);
//----------


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
//$dbSistemaConMysqli->close();
$dbSistemaConPDO = null;


//Montagem do URL de retorno.
$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
"idTbForumTopicos=" . $idParent . 
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