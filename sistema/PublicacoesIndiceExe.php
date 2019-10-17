<?php
//Recurso para permitir o redirecionamento (evitar duplicidade de header).
ob_start();


//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeLayout.php";


//Resgate de variáveis.
$id = ContadorUniversal::ContadorUniversalUpdate(1);
$tipoPublicacao = $_POST["tipo_publicacao"];
$idTbCategorias = $_POST["id_tb_categorias"];

$idTbCadastroUsuario = $_POST["id_tb_cadastro_usuario"];
if($idTbCadastroUsuario == "")
{
	$idTbCadastroUsuario = 0;
}

//$dataPublicacao = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");
$dataPublicacao = Funcoes::DataGravacaoSql($_POST["data_publicacao"], $GLOBALS['configSistemaFormatoData']);
if($dataPublicacao == "")
{
	//$data_publicacao = NULL;	
	$dataPublicacao = date("Y") . "-" . date("m") . "-" . date("d");	
}

$dataFinalPublicacao = Funcoes::DataGravacaoSql($_POST["data_final_publicacao"], $GLOBALS['configSistemaFormatoData']);
if($dataFinalPublicacao == "")
{
	$dataFinalPublicacao = NULL;	
}


$nClassificacao = $_POST["n_classificacao"];
if($nClassificacao == "")
{
	$nClassificacao = 0;
}

$titulo = Funcoes::ConteudoMascaraGravacao01($_POST["titulo"]);
$conteudoSimples = Funcoes::ConteudoMascaraGravacao01($_POST["conteudo_simples"]);

$informacaoComplementar1 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar1"]);
$informacaoComplementar2 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar2"]);
$informacaoComplementar3 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar3"]);
$informacaoComplementar4 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar4"]);
$informacaoComplementar5 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar5"]);

$fonte = Funcoes::ConteudoMascaraGravacao01($_POST["fonte"]);
$linkFonte = Funcoes::ConteudoMascaraGravacao01($_POST["link_fonte"]);
$editoria = Funcoes::ConteudoMascaraGravacao01($_POST["editoria"]);
$palavrasChave = Funcoes::ConteudoMascaraGravacao01($_POST["palavras_chave"]);

$ativacao = $_POST["ativacao"];
$ativacaoHome = $_POST["ativacao_home"];
$ativacaoHomeCategoria = $_POST["ativacao_home_categoria"];

$acessoRestrito = $_POST["acesso_restrito"];
if($acessoRestrito == "")
{
	$acessoRestrito = 0;
}


$paginaRetorno = $_POST["paginaRetorno"];
$mensagemErro = "";
$mensagemSucesso = "";


//Montagem de query padrão de retorno.
$queryPadrao = "&masterPageSelect=" . $masterPageSelect;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Montagem do query.
//----------
$strSqlPublicacoesInsert = "";
$strSqlPublicacoesInsert .= "INSERT INTO tb_publicacoes ";
$strSqlPublicacoesInsert .= "SET ";
$strSqlPublicacoesInsert .= "id = :id, ";
$strSqlPublicacoesInsert .= "tipo_publicacao = :tipo_publicacao, ";
$strSqlPublicacoesInsert .= "id_tb_categorias = :id_tb_categorias, ";
$strSqlPublicacoesInsert .= "id_tb_cadastro_usuario = :id_tb_cadastro_usuario, ";
$strSqlPublicacoesInsert .= "data_publicacao = :data_publicacao, ";
$strSqlPublicacoesInsert .= "data_final_publicacao = :data_final_publicacao, ";
$strSqlPublicacoesInsert .= "n_classificacao = :n_classificacao, ";

$strSqlPublicacoesInsert .= "titulo = :titulo, ";
$strSqlPublicacoesInsert .= "conteudo_simples = :conteudo_simples, ";
$strSqlPublicacoesInsert .= "informacao_complementar1 = :informacao_complementar1, ";
$strSqlPublicacoesInsert .= "informacao_complementar2 = :informacao_complementar2, ";
$strSqlPublicacoesInsert .= "informacao_complementar3 = :informacao_complementar3, ";
$strSqlPublicacoesInsert .= "informacao_complementar4 = :informacao_complementar4, ";
$strSqlPublicacoesInsert .= "informacao_complementar5 = :informacao_complementar5, ";

$strSqlPublicacoesInsert .= "fonte = :fonte, ";
$strSqlPublicacoesInsert .= "link_fonte = :link_fonte, ";
$strSqlPublicacoesInsert .= "editoria = :editoria, ";
$strSqlPublicacoesInsert .= "palavras_chave = :palavras_chave, ";
$strSqlPublicacoesInsert .= "ativacao = :ativacao, ";
$strSqlPublicacoesInsert .= "ativacao_home = :ativacao_home, ";
$strSqlPublicacoesInsert .= "ativacao_home_categoria = :ativacao_home_categoria, ";
$strSqlPublicacoesInsert .= "acesso_restrito = :acesso_restrito ";
//----------


//Parametros e execução.
//----------
$statementPublicacoesInsert = $dbSistemaConPDO->prepare($strSqlPublicacoesInsert);

if ($statementPublicacoesInsert !== false)
{
	$statementPublicacoesInsert->execute(array(
		"id" => $id,
		"tipo_publicacao" => $tipoPublicacao,
		"id_tb_categorias" => $idTbCategorias,
		"id_tb_cadastro_usuario" => $idTbCadastroUsuario,
		"data_publicacao" => $dataPublicacao,
		"data_final_publicacao" => $dataFinalPublicacao,
		"n_classificacao" => $nClassificacao,
		"titulo" => $titulo,
		"conteudo_simples" => $conteudoSimples,
		"informacao_complementar1" => $informacaoComplementar1,
		"informacao_complementar2" => $informacaoComplementar2,
		"informacao_complementar3" => $informacaoComplementar3,
		"informacao_complementar4" => $informacaoComplementar4,
		"informacao_complementar5" => $informacaoComplementar5,
		"fonte" => $fonte,
		"link_fonte" => $linkFonte,
		"editoria" => $editoria,
		"palavras_chave" => $palavrasChave,
		"ativacao" => $ativacao,
		"ativacao_home" => $ativacaoHome,
		"ativacao_home_categoria" => $ativacaoHomeCategoria,
		"acesso_restrito" => $acesso_restrito
	));
	
	$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus2");
	//Obs: Colocar um flag de verificação de gravação.
}else{
	//echo "erro";
	$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus3");
}
//----------


//Upload de arquivos.
//----------
if(!empty($_FILES["ArquivoUpload1"]["name"])) //Verifica se arquivos foram postados.
{

	//Definição do tamanho das imagens.
	$arrImagemTamanhos = $GLOBALS['arrImagemPublicacoes'];
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
$resultadoUpdate = DbUpdate::DbRegistroGenericoUpdate01($arquivoNome, $id, "tb_publicacoes", "imagem");
if ($resultadoUpdate == true) 
{

}else{
	$mensagemErro .= $resultadoUpdate;
	//$mensagemSucesso = "";
}
//----------


//Limpeza de objetos.
//----------
unset($strSqlPublicacoesInsert);
unset($statementPublicacoesInsert);
//----------


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
//$dbSistemaConMysqli->close();
$dbSistemaConPDO = null;


//Montagem do URL de retorno.
$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
"idParentPublicacoes=" . $idTbCategorias . 
"&tipoPublicacao=" . $tipoPublicacao . 
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