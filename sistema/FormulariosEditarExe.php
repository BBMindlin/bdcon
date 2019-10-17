<?php
//Recurso para permitir o redirecionamento (evitar duplicidade de header).
ob_start();


//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeLayout.php";


//Resgate de variáveis.
//$id = ContadorUniversal::ContadorUniversalUpdate(1);
$id = $_POST["idTbFormularios"];
$idTbCategorias = $_POST["id_tb_categorias"];

$nomeFormulario = Funcoes::ConteudoMascaraGravacao01($_POST["nome_formulario"]);
$assuntoFormulario = Funcoes::ConteudoMascaraGravacao01($_POST["assunto_formulario"]);
$nomeEmailDestinatario = Funcoes::ConteudoMascaraGravacao01($_POST["nome_email_destinatario"]);
$emailDestinatario = $_POST["email_destinatario"];
$emailCopia = $_POST["email_copia"];
$configMensagemSucesso = Funcoes::ConteudoMascaraGravacao01($_POST["config_mensagem_sucesso"]);

$paginaRetorno = $_POST["paginaRetorno"];
$mensagemErro = "";
$mensagemSucesso = "";


//Update de registro no BD.
//----------
$strSqlFormulariosUpdate = "";
$strSqlFormulariosUpdate .= "UPDATE tb_formularios ";
$strSqlFormulariosUpdate .= "SET ";
//$strSqlFormulariosUpdate .= "id = :id, ";
$strSqlFormulariosUpdate .= "id_tb_categorias = :id_tb_categorias, ";
$strSqlFormulariosUpdate .= "nome_formulario = :nome_formulario, ";
$strSqlFormulariosUpdate .= "assunto_formulario = :assunto_formulario, ";
$strSqlFormulariosUpdate .= "nome_email_destinatario = :nome_email_destinatario, ";
$strSqlFormulariosUpdate .= "email_destinatario = :email_destinatario, ";
$strSqlFormulariosUpdate .= "email_copia = :email_copia, ";
$strSqlFormulariosUpdate .= "config_mensagem_sucesso = :config_mensagem_sucesso ";

$strSqlFormulariosUpdate .= "WHERE id = :id ";
//echo "strSqlCategoriasUpdate = " . $strSqlFormulariosUpdate . "<br />";
//----------


$statementFormulariosUpdate = $dbSistemaConPDO->prepare($strSqlFormulariosUpdate);


/*
"data_criacao" => $dataCriacao,
*/
if ($statementFormulariosUpdate !== false)
{
	$statementFormulariosUpdate->execute(array(
		"id" => $id,
		"id_tb_categorias" => $idTbCategorias,
		"nome_formulario" => $nomeFormulario,
		"assunto_formulario" => $assuntoFormulario,
		"nome_email_destinatario" => $nomeEmailDestinatario,
		"email_destinatario" => $emailDestinatario,
		"email_copia" => $emailCopia,
		"config_mensagem_sucesso" => $configMensagemSucesso
	));
	
	$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus7");
}else{
	//echo "erro";
	$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus8");
}


//Limpeza de objetos.
unset($strSqlFormulariosUpdate);
unset($statementFormulariosUpdate);
//----------


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
//$dbSistemaConMysqli->close();
$dbSistemaConPDO = null;


//Montagem do URL de retorno.
$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
"idParentFormularios=" . $idTbCategorias .
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