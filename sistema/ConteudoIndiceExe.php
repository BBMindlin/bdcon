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

$nClassificacao = $_POST["n_classificacao"];
if($nClassificacao == "")
{
	$nClassificacao = 0;
}

$idTbCategorias = $_POST["id_tb_categorias"];

$idTbCadastro = $_POST["idTbCadastro"];
if($idTbCadastro == "")
{
	$idTbCadastro = 0;
}

$tipoConteudo = $_POST["tipo_conteudo"];
$alinhamentoTexto = $_POST["alinhamento_texto"];
$alinhamentoImagem = $_POST["alinhamento_imagem"];
if($alinhamentoImagem == "")
{
	$alinhamentoImagem = 0;
}

$strConteudo = "";
$conteudo = Funcoes::ConteudoMascaraGravacao01($_POST["conteudo"]);
$conteudoImagem = Funcoes::ConteudoMascaraGravacao01($_POST["conteudo_imagem"]);
if($strConteudo == "")
{
	$strConteudo = $conteudo;
}
if($strConteudo == "")
{
	$strConteudo = $conteudoImagem;
}

$conteudoLink = Funcoes::ConteudoMascaraGravacao01($_POST["conteudo_link"]);

$configArquivo = $_POST["config_arquivo"];
if($configArquivo == "")
{
	$configArquivo = 0;
}

$dimensaoArquivo = $_POST["dimensao_w"] . "," . $_POST["dimensao_h"];

$paginaRetorno = $_POST["paginaRetorno"];
$mensagemErro = "";
$mensagemSucesso = "";


//Verificação de erro - debug.
/*
echo "id=" . $id . "<br />";
echo "nClassificacao=" . $nClassificacao . "<br />";
echo "idTbCategorias=" . $idTbCategorias . "<br />";
echo "tipoConteudo=" . $tipoConteudo . "<br />";
echo "alinhamentoTexto=" . $alinhamentoTexto . "<br />";
echo "alinhamentoImagem=" . $alinhamentoImagem . "<br />";
echo "conteudo=" . $conteudo . "<br />";
echo "conteudoLink=" . $conteudoLink . "<br />";
echo "configArquivo=" . $configArquivo . "<br />";
echo "dimensaoArquivo=" . $dimensaoArquivo . "<br />";
exit();
*/


//Inclusão de registro no BD.
//----------
$strSqlConteudoInsert = "";
$strSqlConteudoInsert .= "INSERT INTO tb_conteudo ";
$strSqlConteudoInsert .= "SET ";
$strSqlConteudoInsert .= "id = :id, ";
$strSqlConteudoInsert .= "n_classificacao = :n_classificacao, ";
$strSqlConteudoInsert .= "id_tb_categorias = :id_tb_categorias, ";
$strSqlConteudoInsert .= "id_tb_cadastro = :id_tb_cadastro, ";
$strSqlConteudoInsert .= "tipo_conteudo = :tipo_conteudo, ";
$strSqlConteudoInsert .= "alinhamento_texto = :alinhamento_texto, ";
$strSqlConteudoInsert .= "alinhamento_imagem = :alinhamento_imagem, ";
$strSqlConteudoInsert .= "conteudo = :conteudo, ";
$strSqlConteudoInsert .= "conteudo_link = :conteudo_link, ";
//$strSqlConteudoInsert .= "arquivo = :arquivo, ";
$strSqlConteudoInsert .= "config_arquivo = :config_arquivo, ";
$strSqlConteudoInsert .= "dimensao_arquivo = :dimensao_arquivo ";

$statementConteudoInsert = $dbSistemaConPDO->prepare($strSqlConteudoInsert);

if ($statementConteudoInsert !== false)
{
	$statementConteudoInsert->execute(array(
		"id" => $id,
		"n_classificacao" => $nClassificacao,
		"id_tb_categorias" => $idTbCategorias,
		"id_tb_cadastro" => $idTbCadastro,
		"tipo_conteudo" => $tipoConteudo,
		"alinhamento_texto" => $alinhamentoTexto,
		"alinhamento_imagem" => $alinhamentoImagem,
		"conteudo" => $strConteudo,
		"conteudo_link" => $conteudoLink,
		"config_arquivo" => $configArquivo,
		"dimensao_arquivo" => $dimensaoArquivo
	));
	//"conteudo" => $conteudo,
	
	$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus2");
}else{
	//echo "erro";
	$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus3");
}


//Limpeza de objetos.
unset($strSqlConteudoInsert);
unset($statementConteudoInsert);
//----------


//Divisão de colunas.
//*********************************************************************************************************************
if($tipoConteudo == "10")
{
	$idTbConteudo = $id;
	for($countColunas = 1; $countColunas <= $strConteudo; $countColunas++)
	{
		$idTbConteudoColunas = ContadorUniversal::ContadorUniversalUpdate(1);
		
		//Inclusão de registro no BD.
		//----------
		$strSqlConteudoColunasInsert = "";
		$strSqlConteudoColunasInsert .= "INSERT INTO tb_conteudo_colunas ";
		$strSqlConteudoColunasInsert .= "SET ";
		$strSqlConteudoColunasInsert .= "id = :id, ";
		$strSqlConteudoColunasInsert .= "id_tb_conteudo = :id_tb_conteudo, ";
		$strSqlConteudoColunasInsert .= "n_classificacao = :n_classificacao ";
		
		$statementConteudoColunasInsert = $dbSistemaConPDO->prepare($strSqlConteudoColunasInsert);
		
		if ($statementConteudoColunasInsert !== false)
		{
			$statementConteudoColunasInsert->execute(array(
				"id" => $idTbConteudoColunas,
				"id_tb_conteudo" => $idTbConteudo,
				"n_classificacao" => $nClassificacao
			));
			//"conteudo" => $conteudo,
			
			$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus2");
		}else{
			//echo "erro";
			$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus3");
		}
		
		//Limpeza de objetos.
		unset($strSqlConteudoColunasInsert);
		unset($statementConteudoColunasInsert);
		//----------
	}
}
//*********************************************************************************************************************
	
	
//Upload de arquivos.
//----------
if(!empty($_FILES["ArquivoUpload1"]["name"])) //Verifica se arquivos foram postados.
{

	//Definição do tamanho das imagens.
	$arrImagemTamanhos = $GLOBALS['arrImagemConteudo'];
	if($GLOBALS['ativacaoImagensPadrao'] == 1)
	{
		$arrImagemTamanhos = $GLOBALS['arrImagemPadrao'];
	}
	
	//Definição do diretório de upload.
	$arquivosDiretorioUpload = $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos'];
	
	//Definição do nome do arquivo.
	//$allowedExts = array("gif", "jpeg", "jpg", "png");
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
		if($tipoConteudo <> 8 && $tipoConteudo <> 6 && $tipoConteudo <> 11){
			$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus19");
		}
		//$mensagemSucesso = "";
	}
}


//Update do registro com o nome do arquivo.
$resultadoUpdate = DbUpdate::DbRegistroGenericoUpdate01($arquivoNome, $id, "tb_conteudo", "arquivo");
if ($resultadoUpdate == true) 
{

}else{
	$mensagemErro .= $resultadoUpdate;
	//$mensagemSucesso = "";
}
//----------



//Fechamento da conexão.
$dbSistemaConPDO = null;


//Montagem do URL de retorno.
$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
"idParentConteudo=" . $idTbCategorias .
"&masterPageSelect=" . $masterPageSelect .
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