<?php
//Recurso para permitir o redirecionamento (evitar duplicidade de header).
ob_start();


//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
//require_once "IncludeUsuarioVerificacao.php";
require_once "IncludeLayout.php";


//$id = ContadorUniversal::ContadorUniversalUpdate(1);
//$idTbCategorias = $_POST["idTbCategorias"];
$id = $_POST["idTbCategorias"];
//$idTbCategorias = $_POST["id_tb_categorias"];
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
//$dataCategoria = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");

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


//Verificação de erro - debug
//echo "idRegistro=" . $idRegistro . "<br />";
//echo "strTabela=" . $strTabela . "<br />";
//echo "strCampo=" . $strCampo . "<br />";
//echo "arrImagemTamanhos=" . $arrImagemTamanhos . "<br />";
//exit();


//Update de registro no BD.
//----------
$strSqlCategoriasUpdate = "";
$strSqlCategoriasUpdate .= "UPDATE tb_categorias ";
$strSqlCategoriasUpdate .= "SET ";
//$strSqlCategoriasUpdate .= "id = :id, ";
$strSqlCategoriasUpdate .= "id_parent = :id_parent, ";
$strSqlCategoriasUpdate .= "id_tb_cadastro_usuario = :id_tb_cadastro_usuario, ";
$strSqlCategoriasUpdate .= "n_classificacao = :n_classificacao, ";
//$strSqlCategoriasUpdate .= "data_categoria = :data_categoria, ";
$strSqlCategoriasUpdate .= "categoria = :categoria, ";
$strSqlCategoriasUpdate .= "descricao = :descricao, ";
$strSqlCategoriasUpdate .= "informacao_complementar1 = :informacao_complementar1, ";
$strSqlCategoriasUpdate .= "informacao_complementar2 = :informacao_complementar2, ";
$strSqlCategoriasUpdate .= "informacao_complementar3 = :informacao_complementar3, ";
$strSqlCategoriasUpdate .= "informacao_complementar4 = :informacao_complementar4, ";
$strSqlCategoriasUpdate .= "informacao_complementar5 = :informacao_complementar5, ";
$strSqlCategoriasUpdate .= "tipo_categoria = :tipo_categoria, ";
$strSqlCategoriasUpdate .= "ativacao = :ativacao, ";
$strSqlCategoriasUpdate .= "acesso_restrito = :acesso_restrito ";
$strSqlCategoriasUpdate .= "WHERE id = :id ";

$statementCategoriasUpdate = $dbSistemaConPDO->prepare($strSqlCategoriasUpdate);

if ($statementCategoriasUpdate !== false)
{
	$statementCategoriasUpdate->execute(array(
		"id" => $id,
		"id_parent" => $idParent,
		"id_tb_cadastro_usuario" => $idTbCadastroUsuario,
		"n_classificacao" => $nClassificacao,
		//"data_categoria" => $dataCategoria,
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
	
	$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus7");
}else{
	//echo "erro";
	$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus8");
}

//Limpeza de objetos.
unset($strSqlCategoriasUpdate);
unset($statementCategoriasUpdate);
//----------


if(!empty($_FILES["ArquivoUpload1"]["name"])) //Verifica se arquivos foram postados.
{

	//Definição do tamanho das imagens.
	//$arrImagemTamanhos = $GLOBALS['arrImagemPadrao'];
	$arrImagemTamanhos = $GLOBALS['arrImagemCategoria'];
	if($GLOBALS['ativacaoImagensPadrao'] == 1)
	{
		$arrImagemTamanhos = $GLOBALS['arrImagemPadrao'];
	}
	
	//Exclusão dos arquivo antigos.
	Arquivo::ExcluirArquivos(DbFuncoes::GetCampoGenerico01($id, "tb_categorias", "imagem"), $arrImagemTamanhos); //Exclusão de arquivos.
	
	//Definição do diretório de upload.
	$arquivosDiretorioUpload = $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos'];
	
	//Definição do nome do arquivo.
	//$allowedExts = array("gif", "jpeg", "jpg", "png");
	$arrArquivoExtensao = explode(".", $_FILES["ArquivoUpload1"]["name"]);
	$arquivoExtensao = strtolower(end($arrArquivoExtensao));
	$arquivoNome = $id . "." . $arquivoExtensao;
	
	
	//Upload de arquivos.
	//Arquivo::ArquivoUpload($id, $_FILES["ArquivoUpload1"], "");
	//Arquivo::ArquivoUpload($id, $_FILES["ArquivoUpload1"], $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos']);
	$resultadoUpload = Arquivo::ArquivoUpload($id, 
											$_FILES["ArquivoUpload1"], 
											$arquivosDiretorioUpload,
											"o" . $arquivoNome);
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
	
	
	//Update do registro com o nome do arquivo.
	$resultadoUpdate = DbUpdate::DbRegistroGenericoUpdate01($arquivoNome, $id, "tb_categorias", "imagem");
	if ($resultadoUpdate == true) 
	{
	
	}else{
		$mensagemErro .= $resultadoUpdate;
		//$mensagemSucesso = "";
	}
}


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
