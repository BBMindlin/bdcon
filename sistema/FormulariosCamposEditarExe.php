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
$id = $_POST["idTbFormulariosCampos"];
$idTbFormularios = $_POST["id_tb_formularios"];

$nClassificacao = $_POST["n_classificacao"];
if($nClassificacao == "")
{
	$nClassificacao = 0;
}

$nomeCampo = Funcoes::ConteudoMascaraGravacao01($_POST["nome_campo"]);
$nomeCampoFormatado = "campo" . $id;
//$tipoCampo = 1;
$tipoCampo = $_POST["tipo_campo"];
$tamanhoCampo = $_POST["tamanho_campo"];
$alturaCampo = $_POST["altura_campo"];
$ativacao = $_POST["ativacao"];

$obrigatorio = $_POST["obrigatorio"];
if($obrigatorio == "")
{
	$obrigatorio = 0;
}

$paginaRetorno = $_POST["paginaRetorno"];
$mensagemErro = "";
$mensagemSucesso = "";

//Montagem de query padrão de retorno.
$queryPadrao = "&masterPageSelect=" . $masterPageSelect;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Update de registro no BD.
//----------
$strSqlFormulariosCamposUpdate = "";
$strSqlFormulariosCamposUpdate .= "UPDATE tb_formularios_campos ";
$strSqlFormulariosCamposUpdate .= "SET ";
//$strSqlFormulariosCamposUpdate .= "id = :id, ";
$strSqlFormulariosCamposUpdate .= "id_tb_formularios = :id_tb_formularios, ";
$strSqlFormulariosCamposUpdate .= "n_classificacao = :n_classificacao, ";
$strSqlFormulariosCamposUpdate .= "nome_campo = :nome_campo, ";
$strSqlFormulariosCamposUpdate .= "nome_campo_formatado = :nome_campo_formatado, ";
$strSqlFormulariosCamposUpdate .= "tipo_campo = :tipo_campo, ";
$strSqlFormulariosCamposUpdate .= "tamanho_campo = :tamanho_campo, ";
$strSqlFormulariosCamposUpdate .= "altura_campo = :altura_campo, ";
$strSqlFormulariosCamposUpdate .= "ativacao = :ativacao, ";
$strSqlFormulariosCamposUpdate .= "obrigatorio = :obrigatorio ";
$strSqlFormulariosCamposUpdate .= "WHERE id = :id ";
//echo "strSqlCategoriasUpdate = " . $strSqlFormulariosCamposUpdate . "<br />";
//----------


$statementFormulariosCamposUpdate = $dbSistemaConPDO->prepare($strSqlFormulariosCamposUpdate);


/*
"data_criacao" => $dataCriacao,
*/
if ($statementFormulariosCamposUpdate !== false)
{
	$statementFormulariosCamposUpdate->execute(array(
		"id" => $id,
		"id_tb_formularios" => $idTbFormularios,
		"n_classificacao" => $nClassificacao,
		"nome_campo" => $nomeCampo,
		"nome_campo_formatado" => $nomeCampoFormatado,
		"tipo_campo" => $tipoCampo,
		"tamanho_campo" => $tamanhoCampo,
		"altura_campo" => $alturaCampo,
		"ativacao" => $ativacao,
		"obrigatorio" => $obrigatorio
	));
	
	$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus7");
}else{
	//echo "erro";
	$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus8");
}


//Limpeza de objetos.
unset($strSqlFormulariosCamposUpdate);
unset($statementFormulariosCamposUpdate);
//----------


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
//$dbSistemaConMysqli->close();
$dbSistemaConPDO = null;


//Montagem do URL de retorno.
$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
"idTbFormularios=" . $idTbFormularios .
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