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
$id = $_POST["idTbCadastroContasBancarias"];
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


//Update de registro no BD.
//----------
$strSqlCadastroContasBancariasUpdate = "";
$strSqlCadastroContasBancariasUpdate .= "UPDATE tb_cadastro_contas_bancarias ";
$strSqlCadastroContasBancariasUpdate .= "SET ";
//$strSqlCadastroContasBancariasUpdate.= "id = :id, ";
//$strSqlCadastroContasBancariasUpdate.= "id_tb_cadastro = :id_tb_cadastro, ";
$strSqlCadastroContasBancariasUpdate.= "titulo_conta = :titulo_conta, ";
$strSqlCadastroContasBancariasUpdate.= "nome_titular = :nome_titular, ";
$strSqlCadastroContasBancariasUpdate.= "cpf_cnpj = :cpf_cnpj, ";
$strSqlCadastroContasBancariasUpdate.= "n_banco = :n_banco, ";
$strSqlCadastroContasBancariasUpdate.= "n_agencia = :n_agencia, ";
$strSqlCadastroContasBancariasUpdate.= "digito_agencia = :digito_agencia, ";
$strSqlCadastroContasBancariasUpdate.= "n_conta = :n_conta, ";
$strSqlCadastroContasBancariasUpdate.= "digito_conta = :digito_conta, ";
$strSqlCadastroContasBancariasUpdate.= "tipo_conta = :tipo_conta, ";
$strSqlCadastroContasBancariasUpdate.= "ativacao = :ativacao, ";
$strSqlCadastroContasBancariasUpdate.= "obs = :obs ";
$strSqlCadastroContasBancariasUpdate .= "WHERE id = :id ";
//echo "strSqlCategoriasUpdate = " . $strSqlCadastroContasBancariasUpdate . "<br />";
//----------


$statementCadastroContasBancariasUpdate = $dbSistemaConPDO->prepare($strSqlCadastroContasBancariasUpdate);


/*
"id_tb_cadastro" => $idTbCadastro,
*/
if ($statementCadastroContasBancariasUpdate !== false)
{
	$statementCadastroContasBancariasUpdate->execute(array(
		"id" => $id,
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
	
	$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus7");
}else{
	//echo "erro";
	$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus8");
}


//Limpeza de objetos.
unset($strSqlCadastroContasBancariasUpdate);
unset($statementCadastroContasBancariasUpdate);
//----------


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
//$dbSistemaConMysqli->close();
$dbSistemaConPDO = null;


//Montagem do URL de retorno.
//$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
$URLRetorno = $configUrl . "/" . $visualizacaoAtivaSistema . "/" . $paginaRetorno . "?" .
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