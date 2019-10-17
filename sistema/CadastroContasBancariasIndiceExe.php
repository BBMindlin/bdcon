<?php
//Recurso para permitir o redirecionamento (evitar duplicidade de header).
ob_start();


//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeUsuarioVerificacao.php";
require_once "IncludeLayout.php";


//Resgate de variáveis.
$id = ContadorUniversal::ContadorUniversalUpdate(1);
$idTbCadastro = $_POST["id_tb_cadastro"];

$tituloConta = Funcoes::ConteudoMascaraGravacao01($_POST["titulo_conta"]);
$nomeTitular = Funcoes::ConteudoMascaraGravacao01($_POST["nome_titular"]);
$cpfCnpj = $_POST["cpf_cnpj"];
$nBanco = $_POST["n_banco"];
$nAgencia = $_POST["n_agencia"];
$digitoAgencia = $_POST["digito_agencia"];
$nConta = $_POST["n_conta"];
$digitoConta = $_POST["digito_conta"];
$tipoConta = $_POST["tipo_conta"];
$ativacao = $_POST["ativacao"];
$obs = Funcoes::ConteudoMascaraGravacao01($_POST["obs"]);

$paginaRetorno = $_POST["paginaRetorno"];
$mensagemErro = "";
$mensagemSucesso = "";

//Montagem de query padrão de retorno.
$queryPadrao = "&masterPageSelect=" . $masterPageSelect;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Inclusão de registro no BD.
//----------
$strSqlCadastroContasBancariasInsert = "";
$strSqlCadastroContasBancariasInsert .= "INSERT INTO tb_cadastro_contas_bancarias ";
$strSqlCadastroContasBancariasInsert .= "SET ";
$strSqlCadastroContasBancariasInsert .= "id = :id, ";
$strSqlCadastroContasBancariasInsert .= "id_tb_cadastro = :id_tb_cadastro, ";
$strSqlCadastroContasBancariasInsert .= "titulo_conta = :titulo_conta, ";
$strSqlCadastroContasBancariasInsert .= "nome_titular = :nome_titular, ";
$strSqlCadastroContasBancariasInsert .= "cpf_cnpj = :cpf_cnpj, ";
$strSqlCadastroContasBancariasInsert .= "n_banco = :n_banco, ";
$strSqlCadastroContasBancariasInsert .= "n_agencia = :n_agencia, ";
$strSqlCadastroContasBancariasInsert .= "digito_agencia = :digito_agencia, ";
$strSqlCadastroContasBancariasInsert .= "n_conta = :n_conta, ";
$strSqlCadastroContasBancariasInsert .= "digito_conta = :digito_conta, ";
$strSqlCadastroContasBancariasInsert .= "tipo_conta = :tipo_conta, ";
$strSqlCadastroContasBancariasInsert .= "ativacao = :ativacao, ";
$strSqlCadastroContasBancariasInsert .= "obs = :obs ";


$statementCadastroContasBancariasInsert = $dbSistemaConPDO->prepare($strSqlCadastroContasBancariasInsert);

if ($statementCadastroContasBancariasInsert !== false)
{
	$statementCadastroContasBancariasInsert->execute(array(
		"id" => $id,
		"id_tb_cadastro" => $idTbCadastro,
		"titulo_conta" => $tituloConta,
		"nome_titular" => $nomeTitular,
		"cpf_cnpj" => $cpfCnpj,
		"n_banco" => $nBanco,
		"n_agencia" => $nAgencia,
		"digito_agencia" => $digitoAgencia,
		"n_conta" => $nConta,
		"digito_conta" => $digitoConta,
		"tipo_conta" => $tipoConta,
		"ativacao" => $ativacao,
		"obs" => $obs
	));
	
	$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus2");
	//Obs: Colocar um flag de verificação de gravação.
}else{
	//echo "erro";
	$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus3");
}


//Limpeza de objetos.
unset($strSqlCadastroContasBancariasInsert);
unset($statementCadastroContasBancariasInsert);
//----------


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
//$dbSistemaConMysqli->close();
$dbSistemaConPDO = null;


//Montagem do URL de retorno.
$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
"idTbCadastro=" . $idTbCadastro .
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