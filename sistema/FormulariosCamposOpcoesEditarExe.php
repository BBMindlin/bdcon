<?php
//Recurso para permitir o redirecionamento (evitar duplicidade de header).
ob_start();


//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeLayout.php";


//Verificação de login Master.
//$id = ContadorUniversal::ContadorUniversalUpdate(1);
$id = $_POST["idTbFormulariosCamposOpcoes"];
$idTbFormulariosCampos = $_POST["id_tb_formularios_campos"];

$nClassificacao = $_POST["n_classificacao"];
if($nClassificacao == "")
{
	$nClassificacao = 0;
}

$nomeOpcao = Funcoes::ConteudoMascaraGravacao01($_POST["nome_opcao"]);
$nomeOpcaoFormatado = "campo" . $id;

$paginaRetorno = $_POST["paginaRetorno"];
$mensagemErro = "";
$mensagemSucesso = "";

//Montagem de query padrão de retorno.
$queryPadrao = "&masterPageSelect=" . $masterPageSelect;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Update de registro no BD.
//----------
$strSqlFormulariosCamposOpcoesUpdate = "";
$strSqlFormulariosCamposOpcoesUpdate .= "UPDATE tb_formularios_campos_opcoes ";
$strSqlFormulariosCamposOpcoesUpdate .= "SET ";
//$strSqlFormulariosCamposOpcoesUpdate .= "id = :id, ";
//$strSqlFormulariosCamposOpcoesUpdate .= "id = :id, ";
$strSqlFormulariosCamposOpcoesUpdate .= "id_tb_formularios_campos = :id_tb_formularios_campos, ";
$strSqlFormulariosCamposOpcoesUpdate .= "n_classificacao = :n_classificacao, ";
$strSqlFormulariosCamposOpcoesUpdate .= "nome_opcao = :nome_opcao, ";
$strSqlFormulariosCamposOpcoesUpdate .= "nome_opcao_formatado = :nome_opcao_formatado ";
$strSqlFormulariosCamposOpcoesUpdate .= "WHERE id = :id ";
//echo "strSqlCategoriasUpdate = " . $strSqlFormulariosCamposOpcoesUpdate . "<br />";
//----------


//Parâmetros.
//----------
$statementFormulariosCamposOpcoesUpdate = $dbSistemaConPDO->prepare($strSqlFormulariosCamposOpcoesUpdate);

/*
"data_criacao" => $dataCriacao,
*/
if ($statementFormulariosCamposOpcoesUpdate !== false)
{
	$statementFormulariosCamposOpcoesUpdate->execute(array(
		"id" => $id,
		"id_tb_formularios_campos" => $idTbFormulariosCampos,
		"n_classificacao" => $nClassificacao,
		"nome_opcao" => $nomeOpcao,
		"nome_opcao_formatado" => $nomeOpcaoFormatado
	));
	
	$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus7");
}else{
	//echo "erro";
	$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus8");
}
//----------


//Upload de arquivos.
//----------
if(!empty($_FILES["ArquivoUpload1"]["name"])) //Verifica se arquivos foram postados.
{

	//Definição do tamanho das imagens.
	$arrImagemTamanhos = $GLOBALS['arrImagemFormulariosCamposOpcoes'];
	if($GLOBALS['ativacaoImagensPadrao'] == 1)
	{
		$arrImagemTamanhos = $GLOBALS['arrImagemPadrao'];
	}
	
	//Definição do diretório de upload.
	$arquivosDiretorioUpload = $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos'];
	
	//Definição do nome do arquivo.
	$arrArquivoExtensao = explode(".", $_FILES["ArquivoUpload1"]["name"]);
	$arquivoExtensao = strtolower(end($arrArquivoExtensao));
	$arquivoNome = $id . "." . $arquivoExtensao;
	
	
	//Gravação do arquivo original no servidor.
	if(strpos($GLOBALS['configImagensFormatos'], $arquivoExtensao) !== false) {
		$resultadoUpload = Arquivo::ArquivoUpload($id, 
												$_FILES["ArquivoUpload1"], 
												$arquivosDiretorioUpload,
												"o" . $arquivoNome);
	}else{
		$resultadoUpload = Arquivo::ArquivoUpload($id, 
												$_FILES["ArquivoUpload1"], 
												$arquivosDiretorioUpload,
												"" . $arquivoNome);
	}

	if($resultadoUpload == true){
	
	}else{
		$mensagemErro .= $resultadoUpload;
		//$mensagemSucesso = "";
	}
	
	
	//Verificação de formato do arquivo.
	if(strpos($GLOBALS['configImagensFormatos'], $arquivoExtensao) !== false) {
		//Redimensionamento de arquivos.
		Imagem::ImagemRedimensionar01($arrImagemTamanhos, 
									$arquivosDiretorioUpload, 
									$arquivoNome);
	}else{
		$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus19");
		//$mensagemSucesso = "";
	}
	
	
	//Update do registro com o nome do arquivo.
	$resultadoUpdate = DbUpdate::DbRegistroGenericoUpdate01($arquivoNome, $id, "tb_formularios_campos_opcoes", "arquivo");
	if ($resultadoUpdate == true) 
	{
	
	}else{
		$mensagemErro .= $resultadoUpdate;
		//$mensagemSucesso = "";
	}
}
//----------


//Limpeza de objetos.
unset($strSqlFormulariosCamposOpcoesUpdate);
unset($statementFormulariosCamposOpcoesUpdate);
//----------


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
//$dbSistemaConMysqli->close();
$dbSistemaConPDO = null;


//Montagem do URL de retorno.
$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
"idTbFormulariosCampos=" . $idTbFormulariosCampos .
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