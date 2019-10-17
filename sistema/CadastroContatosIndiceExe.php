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


//Inclusão de registro no BD.
//----------
$strSqlCadastroContatosInsert = "";
$strSqlCadastroContatosInsert .= "INSERT INTO tb_cadastro_contatos ";
$strSqlCadastroContatosInsert .= "SET ";
$strSqlCadastroContatosInsert .= "id = :id, ";
$strSqlCadastroContatosInsert .= "id_tb_cadastro = :id_tb_cadastro, ";
$strSqlCadastroContatosInsert .= "filial = :filial, ";
$strSqlCadastroContatosInsert .= "nome = :nome, ";
$strSqlCadastroContatosInsert .= "departamento = :departamento, ";
$strSqlCadastroContatosInsert .= "tel_ddd = :tel_ddd, ";
$strSqlCadastroContatosInsert .= "tel = :tel, ";
$strSqlCadastroContatosInsert .= "cel_ddd = :cel_ddd, ";
$strSqlCadastroContatosInsert .= "cel = :cel, ";
$strSqlCadastroContatosInsert .= "email = :email, ";
//$strSqlCadastroContatosInsert .= "contato_senha = :contato_senha, ";
$strSqlCadastroContatosInsert .= "obs = :obs, ";
$strSqlCadastroContatosInsert .= "ativacao = :ativacao, ";
$strSqlCadastroContatosInsert .= "informacao_complementar1 = :informacao_complementar1, ";
$strSqlCadastroContatosInsert .= "informacao_complementar2 = :informacao_complementar2, ";
$strSqlCadastroContatosInsert .= "informacao_complementar3 = :informacao_complementar3, ";
$strSqlCadastroContatosInsert .= "informacao_complementar4 = :informacao_complementar4, ";
$strSqlCadastroContatosInsert .= "informacao_complementar5 = :informacao_complementar5, ";
$strSqlCadastroContatosInsert .= "informacao_complementar6 = :informacao_complementar6, ";
$strSqlCadastroContatosInsert .= "informacao_complementar7 = :informacao_complementar7, ";
$strSqlCadastroContatosInsert .= "informacao_complementar8 = :informacao_complementar8, ";
$strSqlCadastroContatosInsert .= "informacao_complementar9 = :informacao_complementar9, ";
$strSqlCadastroContatosInsert .= "informacao_complementar10 = :informacao_complementar10, ";
$strSqlCadastroContatosInsert .= "informacao_complementar11 = :informacao_complementar11, ";
$strSqlCadastroContatosInsert .= "informacao_complementar12 = :informacao_complementar12, ";
$strSqlCadastroContatosInsert .= "informacao_complementar13 = :informacao_complementar13, ";
$strSqlCadastroContatosInsert .= "informacao_complementar14 = :informacao_complementar14, ";
$strSqlCadastroContatosInsert .= "informacao_complementar15 = :informacao_complementar15 ";
//----------


//Parâmetros.
//----------
$statementCadastroContatosInsert = $dbSistemaConPDO->prepare($strSqlCadastroContatosInsert);

if ($statementCadastroContatosInsert !== false)
{
	$statementCadastroContatosInsert->execute(array(
		"id" => $id,
		"id_tb_cadastro" => $idTbCadastro,
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
	
	$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus2");
	//Obs: Colocar um flag de verificação de gravação.
}else{
	//echo "erro";
	$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus3");
}
//----------


//Limpeza de objetos.
//----------
unset($strSqlCadastroContatosInsert);
unset($statementCadastroContatosInsert);
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