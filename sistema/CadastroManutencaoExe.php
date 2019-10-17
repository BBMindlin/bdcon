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
$id = ContadorUniversal::ContadorUniversalUpdate(1);
$tipoComplemento = $_POST["tipo_complemento"];
//$complemento = $_POST["complemento"];
$complemento = Funcoes::ConteudoMascaraGravacao01($_POST["complemento"]);
//$descricao = $_POST["descricao"];
$descricao = Funcoes::ConteudoMascaraGravacao01($_POST["descricao"]);

$paginaRetorno = $_POST["paginaRetorno"];
$mensagemErro = "";
$mensagemSucesso = "";


//Query de inclusão.
//----------
$strSqlCadastroManutencaoInsert = "";
$strSqlCadastroManutencaoInsert .= "INSERT INTO tb_cadastro_complemento ";
$strSqlCadastroManutencaoInsert .= "SET ";
$strSqlCadastroManutencaoInsert .= "id = :id, ";
$strSqlCadastroManutencaoInsert .= "tipo_complemento = :tipo_complemento, ";
$strSqlCadastroManutencaoInsert .= "complemento = :complemento, ";
$strSqlCadastroManutencaoInsert .= "descricao = :descricao ";
//----------


//Parâmetros.
//----------
$statementCadastroManutencaoInsert = $dbSistemaConPDO->prepare($strSqlCadastroManutencaoInsert);

if ($statementCadastroManutencaoInsert !== false)
{
	$statementCadastroManutencaoInsert->execute(array(
		"id" => $id,
		"tipo_complemento" => $tipoComplemento,
		"complemento" => $complemento,
		"descricao" => $descricao
	));
	
	$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus2");
}else{
	//echo "erro";
	$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus3");
}
//----------


//Limpeza de objetos.
//----------
unset($strSqlCadastroManutencaoInsert);
unset($statementCadastroManutencaoInsert);
//----------


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
//$dbSistemaConMysqli->close();
$dbSistemaConPDO = null;


//Montagem do URL de retorno.
$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
"idParentCadastro=" . $idTbCategorias .
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