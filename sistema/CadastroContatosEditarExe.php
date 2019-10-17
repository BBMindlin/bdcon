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
//$id = ContadorUniversal::ContadorUniversalUpdate(1);
$id = $_POST["idTbCadastroContatos"];
$idTbCadastro = $_POST["id_tb_cadastro"];

$filial = Funcoes::ConteudoMascaraGravacao01($_POST["filial"]);
$nome = Funcoes::ConteudoMascaraGravacao01($_POST["nome"]);
$departamento = Funcoes::ConteudoMascaraGravacao01($_POST["departamento"]);

$telDDD = $_POST["tel_ddd"];
$tel = $_POST["tel"];
$celDDD = $_POST["cel_ddd"];
$cel = $_POST["cel"];
$email = $_POST["email"];

$obs = Funcoes::ConteudoMascaraGravacao01($_POST["obs"]);
$ativacao = $_POST["ativacao"];

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
$informacaoComplementar11 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar11"]);
$informacaoComplementar12 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar12"]);
$informacaoComplementar13 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar13"]);
$informacaoComplementar14 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar14"]);
$informacaoComplementar15 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar15"]);


$paginaRetorno = $_POST["paginaRetorno"];
$mensagemErro = "";
$mensagemSucesso = "";

//Montagem de query padrão de retorno.
$queryPadrao = "&masterPageSelect=" . $masterPageSelect;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Update de registro no BD.
//----------
$strSqlCadastroContatosUpdate = "";
$strSqlCadastroContatosUpdate .= "UPDATE tb_cadastro_contatos ";
$strSqlCadastroContatosUpdate .= "SET ";
//$strSqlCadastroContatosUpdate .= "id = :id, ";
//$strSqlCadastroContatosUpdate .= "id_tb_cadastro = :id_tb_cadastro, ";
$strSqlCadastroContatosUpdate .= "filial = :filial, ";
$strSqlCadastroContatosUpdate .= "nome = :nome, ";
$strSqlCadastroContatosUpdate .= "departamento = :departamento, ";
$strSqlCadastroContatosUpdate .= "tel_ddd = :tel_ddd, ";
$strSqlCadastroContatosUpdate .= "tel = :tel, ";
$strSqlCadastroContatosUpdate .= "cel_ddd = :cel_ddd, ";
$strSqlCadastroContatosUpdate .= "cel = :cel, ";
$strSqlCadastroContatosUpdate .= "email = :email, ";
//$strSqlCadastroContatosUpdate .= "contato_senha = :contato_senha, ";
$strSqlCadastroContatosUpdate .= "obs = :obs, ";
$strSqlCadastroContatosUpdate .= "ativacao = :ativacao, ";
$strSqlCadastroContatosUpdate .= "informacao_complementar1 = :informacao_complementar1, ";
$strSqlCadastroContatosUpdate .= "informacao_complementar2 = :informacao_complementar2, ";
$strSqlCadastroContatosUpdate .= "informacao_complementar3 = :informacao_complementar3, ";
$strSqlCadastroContatosUpdate .= "informacao_complementar4 = :informacao_complementar4, ";
$strSqlCadastroContatosUpdate .= "informacao_complementar5 = :informacao_complementar5, ";
$strSqlCadastroContatosUpdate .= "informacao_complementar6 = :informacao_complementar6, ";
$strSqlCadastroContatosUpdate .= "informacao_complementar7 = :informacao_complementar7, ";
$strSqlCadastroContatosUpdate .= "informacao_complementar8 = :informacao_complementar8, ";
$strSqlCadastroContatosUpdate .= "informacao_complementar9 = :informacao_complementar9, ";
$strSqlCadastroContatosUpdate .= "informacao_complementar10 = :informacao_complementar10, ";
$strSqlCadastroContatosUpdate .= "informacao_complementar11 = :informacao_complementar11, ";
$strSqlCadastroContatosUpdate .= "informacao_complementar12 = :informacao_complementar12, ";
$strSqlCadastroContatosUpdate .= "informacao_complementar13 = :informacao_complementar13, ";
$strSqlCadastroContatosUpdate .= "informacao_complementar14 = :informacao_complementar14, ";
$strSqlCadastroContatosUpdate .= "informacao_complementar15 = :informacao_complementar15 ";
$strSqlCadastroContatosUpdate .= "WHERE id = :id ";
//echo "strSqlCategoriasUpdate = " . $strSqlCadastroContatosUpdate . "<br />";
//----------


//Parâmetros.
//----------
$statementCadastroContatosUpdate = $dbSistemaConPDO->prepare($strSqlCadastroContatosUpdate);

/*
"id_tb_cadastro" => $idTbCadastro,
*/
if ($statementCadastroContatosUpdate !== false)
{
	$statementCadastroContatosUpdate->execute(array(
		"id" => $id,
		"filial" => $filial,
		"nome" => $nome,
		"departamento" => $departamento,
		"tel_ddd" => $telDDD,
		"tel" => $tel,
		"cel_ddd" => $celDDD,
		"cel" => $cel,
		"email" => $email,
		"obs" => $obs,
		"ativacao" => $ativacao,
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
		"informacao_complementar11" => $informacaoComplementar11,
		"informacao_complementar12" => $informacaoComplementar12,
		"informacao_complementar13" => $informacaoComplementar13,
		"informacao_complementar14" => $informacaoComplementar14,
		"informacao_complementar15" => $informacaoComplementar15
	));
	
	$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus7");
}else{
	//echo "erro";
	$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus8");
}
//----------


//Limpeza de objetos.
//----------
unset($strSqlCadastroContatosUpdate);
unset($statementCadastroContatosUpdate);
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