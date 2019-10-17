<?php
//Recurso para permitir o redirecionamento (evitar duplicidade de header).
ob_start();


//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeUsuarioVerificacao.php";
require_once "IncludeLayout.php";

//Verificação de login Master.
$id = ContadorUniversal::ContadorUniversalUpdate(1);
$idParent = $_POST["id_parent"];
$dataArquivo = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");
$tipoArquivo = Funcoes::ConteudoMascaraGravacao01($_POST["tipo_arquivo"]);

$nClassificacao = $_POST["n_classificacao"];
if($nClassificacao == "")
{
	$nClassificacao = 0;
}

$tamanhoArquivo = "";
$duracaoArquivo = $_POST["duracao_min"] . ":" . $_POST["duracao_seg"];
$dimensaoArquivo = $_POST["dimensao_w"] . "," . $_POST["dimensao_h"];

$titulo = Funcoes::ConteudoMascaraGravacao01($_POST["titulo"]);
$legenda = Funcoes::ConteudoMascaraGravacao01($_POST["legenda"]);
$descricao = Funcoes::ConteudoMascaraGravacao01($_POST["descricao"]);
$codigoHTML = Funcoes::ConteudoMascaraGravacao01($_POST["codigo_html"]);

$informacaoComplementar1 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar1"]);
$informacaoComplementar2 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar2"]);
$informacaoComplementar3 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar3"]);
$informacaoComplementar4 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar4"]);
$informacaoComplementar5 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar5"]);

$palavrasChave = $_POST["palavras_chave"];
$configArquivo = $_POST["config_arquivo"];
$nVisitas = 0;

$paginaRetorno = $_POST["paginaRetorno"];
$detalhe01 = $_POST["detalhe01"];
$detalhe02 = $_POST["detalhe02"];
$mensagemErro = "";
$mensagemSucesso = "";


//Montagem de query padrão de retorno.
$queryPadrao = "&tipoArquivo=" . $tipoArquivo . 
"&paginaRetorno=" . $paginaRetorno . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&variavelRetorno=" . $variavelRetorno . 
"&masterPageSelect=" . $masterPageSelect . 
"&detalhe01=" . $detalhe01 . 
"&detalhe01=" . $detalhe01;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Inclusão de registro no BD.
//----------
$strSqlArquivosInsert = "";
$strSqlArquivosInsert .= "INSERT INTO tb_arquivos ";
$strSqlArquivosInsert .= "SET ";
$strSqlArquivosInsert .= "id = :id, ";
$strSqlArquivosInsert .= "id_parent = :id_parent, ";
$strSqlArquivosInsert .= "data_arquivo = :data_arquivo, ";
$strSqlArquivosInsert .= "tipo_arquivo = :tipo_arquivo, ";
$strSqlArquivosInsert .= "n_classificacao = :n_classificacao, ";
//$strSqlArquivosInsert .= "arquivo = :arquivo, ";
//$strSqlArquivosInsert .= "arquivo_tumbnail = :arquivo_tumbnail, ";
$strSqlArquivosInsert .= "tamanho_arquivo = :tamanho_arquivo, ";
$strSqlArquivosInsert .= "duracao_arquivo = :duracao_arquivo, ";
$strSqlArquivosInsert .= "dimensao_arquivo = :dimensao_arquivo, ";
$strSqlArquivosInsert .= "titulo = :titulo, ";
$strSqlArquivosInsert .= "legenda = :legenda, ";
$strSqlArquivosInsert .= "descricao = :descricao, ";
$strSqlArquivosInsert .= "codigo_html = :codigo_html, ";
$strSqlArquivosInsert .= "informacao_complementar1 = :informacao_complementar1, ";
$strSqlArquivosInsert .= "informacao_complementar2 = :informacao_complementar2, ";
$strSqlArquivosInsert .= "informacao_complementar3 = :informacao_complementar3, ";
$strSqlArquivosInsert .= "informacao_complementar4 = :informacao_complementar4, ";
$strSqlArquivosInsert .= "informacao_complementar5 = :informacao_complementar5, ";
$strSqlArquivosInsert .= "palavras_chave = :palavras_chave, ";
$strSqlArquivosInsert .= "config_arquivo = :config_arquivo, ";
$strSqlArquivosInsert .= "n_visitas = :n_visitas ";

$statementArquivosInsert = $dbSistemaConPDO->prepare($strSqlArquivosInsert);

/*
"arquivo_tumbnail" => $arquivo_tumbnail,
*/
if ($statementArquivosInsert !== false)
{
	$statementArquivosInsert->execute(array(
		"id" => $id,
		"id_parent" => $idParent,
		"data_arquivo" => $dataArquivo,
		"tipo_arquivo" => $tipoArquivo,
		"n_classificacao" => $nClassificacao,
		"tamanho_arquivo" => $tamanhoArquivo,
		"duracao_arquivo" => $duracaoArquivo,
		"dimensao_arquivo" => $dimensaoArquivo,
		"titulo" => $titulo,
		"legenda" => $legenda,
		"descricao" => $descricao,
		"codigo_html" => $codigoHTML,
		"informacao_complementar1" => $informacaoComplementar1,
		"informacao_complementar2" => $informacaoComplementar2,
		"informacao_complementar3" => $informacaoComplementar3,
		"informacao_complementar4" => $informacaoComplementar4,
		"informacao_complementar5" => $informacaoComplementar5,
		"palavras_chave" => $palavrasChave,
		"config_arquivo" => $configArquivo,
		"n_visitas" => $nVisitas
	));
	
	$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus2");
	//Obs: Colocar um flag de verificação de gravação.
}else{
	//echo "erro";
	$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus3");
}


//Upload de arquivos.
//----------
if(!empty($_FILES["ArquivoUpload1"]["name"])) //Verifica se arquivos foram postados.
{

	//Definição do tamanho das imagens.
	$arrImagemTamanhos = $GLOBALS['arrImagemArquivos'];
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
}


//Update do registro com o nome do arquivo.
$resultadoUpdate = DbUpdate::DbRegistroGenericoUpdate01($arquivoNome, $id, "tb_arquivos", "arquivo");
if ($resultadoUpdate == true) 
{

}else{
	$mensagemErro .= $resultadoUpdate;
	//$mensagemSucesso = "";
}
//----------


//Limpeza de objetos.
unset($strSqlArquivosInsert);
unset($statementArquivosInsert);
//----------


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
//$dbSistemaConMysqli->close();
$dbSistemaConPDO = null;


//Montagem do URL de retorno.
$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
"idParent=" . $idParent .
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