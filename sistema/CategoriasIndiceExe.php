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
//$idParent = 1200;
$idParent = $_POST["id_parent"];

$idTbCadastroUsuario = $_POST["idTbCadastroUsuario"];
if($idTbCadastroUsuario == "")
{
	$idTbCadastroUsuario = 0;
}

$nClassificacao = $_POST["n_classificacao"];
if($nClassificacao == "")
{
	$nClassificacao = 0;
}

//$diaDataCategoria = date("d");
//$mesDataCategoria = date("m");
//$anoDataCategoria = date("Y");
//$dataCategoria = $anoDataCategoria . "-" . $mesDataCategoria . "-" . $diaDataCategoria . " " date("H") . ":" . date("i") . ":" . date("s");
$dataCategoria = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");

$categoria = Funcoes::ConteudoMascaraGravacao01($_POST["categoria"]);
$descricao = Funcoes::ConteudoMascaraGravacao01($_POST["descricao"]);

$informacaoComplementar1 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar1"]);
$informacaoComplementar2 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar2"]);
$informacaoComplementar3 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar3"]);
$informacaoComplementar4 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar4"]);
$informacaoComplementar5 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar5"]);

$tipoCategoria = $_POST["tipo_categoria"];
$ativacao = $_POST["ativacao"];
$acessoRestrito = $_POST["acesso_restrito"];

$paginaRetorno = $_POST["paginaRetorno"];
$mensagemErro = "";
$mensagemSucesso = "";


//Inclusão de registro no BD.
//----------
$strSqlCategoriasInsert = "";
$strSqlCategoriasInsert .= "INSERT INTO tb_categorias ";
$strSqlCategoriasInsert .= "SET ";
$strSqlCategoriasInsert .= "id = :id, ";
$strSqlCategoriasInsert .= "id_parent = :id_parent, ";
$strSqlCategoriasInsert .= "id_tb_cadastro_usuario = :id_tb_cadastro_usuario, ";
$strSqlCategoriasInsert .= "n_classificacao = :n_classificacao, ";
$strSqlCategoriasInsert .= "data_categoria = :data_categoria, ";
$strSqlCategoriasInsert .= "categoria = :categoria, ";
$strSqlCategoriasInsert .= "descricao = :descricao, ";
$strSqlCategoriasInsert .= "informacao_complementar1 = :informacao_complementar1, ";
$strSqlCategoriasInsert .= "informacao_complementar2 = :informacao_complementar2, ";
$strSqlCategoriasInsert .= "informacao_complementar3 = :informacao_complementar3, ";
$strSqlCategoriasInsert .= "informacao_complementar4 = :informacao_complementar4, ";
$strSqlCategoriasInsert .= "informacao_complementar5 = :informacao_complementar5, ";
$strSqlCategoriasInsert .= "tipo_categoria = :tipo_categoria, ";
$strSqlCategoriasInsert .= "ativacao = :ativacao, ";
$strSqlCategoriasInsert .= "acesso_restrito = :acesso_restrito ";

/*
$stmt = mysqli_prepare($dbSistemaCon, strSqlCategoriasInsert);
mysqli_stmt_bind_param($stmt, 'iiissii', $id, $idParent, $nClassificacao, $categoria, $descricao, $ativacao, $acessoRestrito);

mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
*/

///*
//$stmt = $mysqli->stmt_init();

//$stmt = $mysqli->prepare("INSERT INTO tb_categorias VALUES (?, ?, ?, ?, ?, ?, ?)");
//$statementCategoriasInsert = $dbSistemaConMysqli->prepare($strSqlCategoriasInsert);
$statementCategoriasInsert = $dbSistemaConPDO->prepare($strSqlCategoriasInsert);

if ($statementCategoriasInsert !== false)
{
	$statementCategoriasInsert->execute(array(
		"id" => $id,
		"id_parent" => $idParent,
		"id_tb_cadastro_usuario" => $idTbCadastroUsuario,
		"n_classificacao" => $nClassificacao,
		"data_categoria" => $dataCategoria,
		"categoria" => $categoria,
		"descricao" => $descricao,
		"informacao_complementar1" => $informacaoComplementar1,
		"informacao_complementar2" => $informacaoComplementar2,
		"informacao_complementar3" => $informacaoComplementar3,
		"informacao_complementar4" => $informacaoComplementar4,
		"informacao_complementar5" => $informacaoComplementar5,
		"tipo_categoria" => $tipoCategoria,
		"ativacao" => $ativacao,
		"acesso_restrito" => $acessoRestrito
	));
	
	$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus2");
}else{
	//echo "erro";
	$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus3");
}

//$stmt = $mysqli->prepare("INSERT INTO tb_categorias SET id=?,id_parent=?,n_classificacao=?,categoria=?,descricao=?,ativacao=?,acesso_restrito=?");
//$mensagemErro = $strSqlCategoriasInsert;
/*
if ($statementCategoriasInsert !== false)
{
	$statementCategoriasInsert->bind_param('ddddssssssssiii', 
	$id, 
	$idParent, 
	$idTbCadastroUsuario, 
	$nClassificacao, 
	$dataCategoria, 
	$categoria, 
	$descricao, 
	$informacaoComplementar1, 
	$informacaoComplementar2, 
	$informacaoComplementar3, 
	$informacaoComplementar4, 
	$informacaoComplementar5, 
	$tipoCategoria, 
	$ativacao, 
	$acessoRestrito);
	
	$statementCategoriasInsert->execute();
	$statementCategoriasInsert->close();
	
	$mensagemSucesso = "Registro incluído com sucesso.";
}else{
	echo "erro";
}
*/

//*/


//mysqli_query($dbSistemaCon,$strSqlCategoriasInsert);

//Limpeza de objetos.
unset($strSqlCategoriasInsert);
unset($statementCategoriasInsert);
//----------


//Upload de arquivos.
//----------
//if(!empty($_FILES)) //Verifica se arquivos foram postados.
//if(empty($_FILES) == false) //Verifica se arquivos foram postados.
if(!empty($_FILES["ArquivoUpload1"]["name"])) //Verifica se arquivos foram postados.
{

	//Definição do tamanho das imagens.
	//$arrImagemTamanhos = $GLOBALS['arrImagemPadrao'];
	$arrImagemTamanhos = $GLOBALS['arrImagemCategoria'];
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
	//Arquivo::ArquivoUpload($id, $_FILES["ArquivoUpload1"], "");
	//Arquivo::ArquivoUpload($id, $_FILES["ArquivoUpload1"], $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos']);
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
	//Arquivo::ArquivoUpload($id, $_FILES["ArquivoUpload1"]["name"], $_FILES["ArquivoUpload1"]["tmp_name"], "");
	
	
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
$resultadoUpdate = DbUpdate::DbRegistroGenericoUpdate01($arquivoNome, $id, "tb_categorias", "imagem");
if ($resultadoUpdate == true) 
{

}else{
	$mensagemErro .= $resultadoUpdate;
	//$mensagemSucesso = "";
}
//----------


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
//$dbSistemaConMysqli->close();
$dbSistemaConPDO = null;


//Montagem do URL de retorno.
$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
"idParentCategorias=" . $idParent .
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
