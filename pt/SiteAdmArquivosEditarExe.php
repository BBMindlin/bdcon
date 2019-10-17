<?php
//Recurso para permitir o redirecionamento (evitar duplicidade de header).
ob_start();


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
$id = $_POST["idTbArquivos"];
$idParent = $_POST["id_parent"];
//$dataArquivo = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");
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
//$nVisitas = 0;

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
"&masterPageSiteSelect=" . $masterPageSiteSelect . 
"&detalhe01=" . $detalhe01 . 
"&detalhe01=" . $detalhe01;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Update de registro no BD.
//----------
$strSqlArquivosUpdate = "";
$strSqlArquivosUpdate .= "UPDATE tb_arquivos ";
$strSqlArquivosUpdate .= "SET ";
//$strSqlArquivosUpdate .= "id = :id, ";
$strSqlArquivosUpdate .= "id_parent = :id_parent, ";
//$strSqlArquivosUpdate .= "data_arquivo = :data_arquivo, ";
$strSqlArquivosUpdate .= "tipo_arquivo = :tipo_arquivo, ";
$strSqlArquivosUpdate .= "n_classificacao = :n_classificacao, ";
//$strSqlArquivosUpdate .= "arquivo = :arquivo, ";
//$strSqlArquivosUpdate .= "arquivo_tumbnail = :arquivo_tumbnail, ";
$strSqlArquivosUpdate .= "tamanho_arquivo = :tamanho_arquivo, ";
$strSqlArquivosUpdate .= "duracao_arquivo = :duracao_arquivo, ";
$strSqlArquivosUpdate .= "dimensao_arquivo = :dimensao_arquivo, ";
$strSqlArquivosUpdate .= "titulo = :titulo, ";
$strSqlArquivosUpdate .= "legenda = :legenda, ";
$strSqlArquivosUpdate .= "descricao = :descricao, ";
$strSqlArquivosUpdate .= "codigo_html = :codigo_html, ";
$strSqlArquivosUpdate .= "informacao_complementar1 = :informacao_complementar1, ";
$strSqlArquivosUpdate .= "informacao_complementar2 = :informacao_complementar2, ";
$strSqlArquivosUpdate .= "informacao_complementar3 = :informacao_complementar3, ";
$strSqlArquivosUpdate .= "informacao_complementar4 = :informacao_complementar4, ";
$strSqlArquivosUpdate .= "informacao_complementar5 = :informacao_complementar5, ";
$strSqlArquivosUpdate .= "palavras_chave = :palavras_chave, ";
//$strSqlArquivosUpdate .= "config_arquivo = :config_arquivo, ";
$strSqlArquivosUpdate .= "config_arquivo = :config_arquivo ";
//$strSqlArquivosUpdate .= "n_visitas = :n_visitas ";

$strSqlArquivosUpdate .= "WHERE id = :id ";
//echo "strSqlCategoriasUpdate = " . $strSqlArquivosUpdate . "<br />";
//----------


$statementArquivosUpdate = $dbSistemaConPDO->prepare($strSqlArquivosUpdate);


/*
"data_arquivo" => $dataArquivo,
"n_visitas" => $nVisitas
*/
if ($statementArquivosUpdate !== false)
{
	$statementArquivosUpdate->execute(array(
		"id" => $id,
		"id_parent" => $idParent,
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
		"config_arquivo" => $configArquivo
	));
	
	$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus7");
}else{
	//echo "erro";
	$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus8");
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
	
	
	//Update do registro com o nome do arquivo.
	$resultadoUpdate = DbUpdate::DbRegistroGenericoUpdate01($arquivoNome, $id, "tb_arquivos", "arquivo");
	if ($resultadoUpdate == true) 
	{
	
	}else{
		$mensagemErro .= $resultadoUpdate;
		//$mensagemSucesso = "";
	}
}


//----------


//Limpeza de objetos.
unset($strSqlArquivosUpdate);
unset($statementArquivosUpdate);
//----------


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
//$dbSistemaConMysqli->close();
$dbSistemaConPDO = null;


//Montagem do URL de retorno.
//$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
$URLRetorno = $configUrl . "/" . $visualizacaoAtivaSistema . "/" . $paginaRetorno . "?" .
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