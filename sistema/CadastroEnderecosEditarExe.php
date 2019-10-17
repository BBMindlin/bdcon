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
//$id = ContadorUniversal::ContadorUniversalUpdate(1);
$id = $_POST["idTbCadastroEnderecos"];
$idTbCadastro = $_POST["id_tb_cadastro"];

$tipoEndereco = $_POST["tipo_endereco"];

$dataEndereco = Funcoes::DataGravacaoSql($_POST["data_endereco"], $GLOBALS['configSistemaFormatoData']);
if($dataEndereco == "")
{
	//$data_publicacao = NULL;	
	//$dataPublicacao = date("Y") . "-" . date("m") . "-" . date("d");
	$dataEndereco = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");
	 
}

$horario = Funcoes::ConteudoMascaraGravacao01($_POST["horario"]);
$enderecoTitulo = Funcoes::ConteudoMascaraGravacao01($_POST["endereco_titulo"]);
$enderecoDescricao = Funcoes::ConteudoMascaraGravacao01($_POST["endereco_descricao"]);
$enderecoSite = Funcoes::ConteudoMascaraGravacao01($_POST["endereco_site"]);
$enderecoEmail = Funcoes::ConteudoMascaraGravacao01($_POST["endereco_email"]);

$idDBCepTblBairros = $_POST["id_db_cep_tblBairros"];
$idDBCepTblCidades = $_POST["id_db_cep_tblCidades"];
$idDBCepTblLogradouros = $_POST["id_db_cep_tblLogradouros"];
$idDBCepTblUF = $_POST["id_db_cep_tblUF"];

$cep = Funcoes::SomenteNum($_POST["cep"]);
$endereco = Funcoes::ConteudoMascaraGravacao01($_POST["endereco"]);
$enderecoNumero = Funcoes::ConteudoMascaraGravacao01($_POST["endereco_numero"]);
$enderecoComplemento = Funcoes::ConteudoMascaraGravacao01($_POST["endereco_complemento"]);
$bairro = Funcoes::ConteudoMascaraGravacao01($_POST["bairro"]);
$cidade = Funcoes::ConteudoMascaraGravacao01($_POST["cidade"]);
$estado = Funcoes::ConteudoMascaraGravacao01($_POST["estado"]);
$pais = Funcoes::ConteudoMascaraGravacao01($_POST["pais"]);

$pontoReferencia = Funcoes::ConteudoMascaraGravacao01($_POST["ponto_referencia"]);
$mapaOnline = Funcoes::ConteudoMascaraGravacao01($_POST["mapa_online"]);

$ativacao = $_POST["ativacao"];
$obs = Funcoes::ConteudoMascaraGravacao01($_POST["obs"]);

$paginaRetorno = $_POST["paginaRetorno"];
$mensagemErro = "";
$mensagemSucesso = "";

//Montagem de query padrão de retorno.
$queryPadrao = "&masterPageSelect=" . $masterPageSelect;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Update de registro no BD.
//----------
$strSqlCadastroEnderecosUpdate = "";
$strSqlCadastroEnderecosUpdate .= "UPDATE tb_cadastro_enderecos ";
$strSqlCadastroEnderecosUpdate .= "SET ";
//$strSqlCadastroEnderecosUpdate .= "id = :id, ";
$strSqlCadastroEnderecosUpdate .= "id_tb_cadastro = :id_tb_cadastro, ";
$strSqlCadastroEnderecosUpdate .= "tipo_endereco = :tipo_endereco, ";
$strSqlCadastroEnderecosUpdate .= "data_endereco = :data_endereco, ";
$strSqlCadastroEnderecosUpdate .= "horario = :horario, ";
$strSqlCadastroEnderecosUpdate .= "endereco_titulo = :endereco_titulo, ";
$strSqlCadastroEnderecosUpdate .= "endereco_descricao = :endereco_descricao, ";
$strSqlCadastroEnderecosUpdate .= "endereco_site = :endereco_site, ";
$strSqlCadastroEnderecosUpdate .= "endereco_email = :endereco_email, ";
$strSqlCadastroEnderecosUpdate .= "id_db_cep_tblBairros = :id_db_cep_tblBairros, ";
$strSqlCadastroEnderecosUpdate .= "id_db_cep_tblCidades = :id_db_cep_tblCidades, ";
$strSqlCadastroEnderecosUpdate .= "id_db_cep_tblLogradouros = :id_db_cep_tblLogradouros, ";
$strSqlCadastroEnderecosUpdate .= "id_db_cep_tblUF = :id_db_cep_tblUF, ";
$strSqlCadastroEnderecosUpdate .= "cep = :cep, ";
$strSqlCadastroEnderecosUpdate .= "endereco = :endereco, ";
$strSqlCadastroEnderecosUpdate .= "endereco_numero = :endereco_numero, ";
$strSqlCadastroEnderecosUpdate .= "endereco_complemento = :endereco_complemento, ";
$strSqlCadastroEnderecosUpdate .= "bairro = :bairro, ";
$strSqlCadastroEnderecosUpdate .= "cidade = :cidade, ";
$strSqlCadastroEnderecosUpdate .= "estado = :estado, ";
$strSqlCadastroEnderecosUpdate .= "pais = :pais, ";
$strSqlCadastroEnderecosUpdate .= "ponto_referencia = :ponto_referencia, ";
$strSqlCadastroEnderecosUpdate .= "mapa_online = :mapa_online, ";
$strSqlCadastroEnderecosUpdate .= "ativacao = :ativacao, ";
//$strSqlCadastroEnderecosUpdate .= "imagem = :imagem, ";
$strSqlCadastroEnderecosUpdate .= "obs = :obs ";
$strSqlCadastroEnderecosUpdate .= "WHERE id = :id ";
//echo "strSqlCategoriasUpdate = " . $strSqlCadastroEnderecosUpdate . "<br />";
//----------


//Parâmetros.
//----------
$statementCadastroEnderecosUpdate = $dbSistemaConPDO->prepare($strSqlCadastroEnderecosUpdate);

/*
"id_tb_cadastro" => $idTbCadastro,
*/
if ($statementCadastroEnderecosUpdate !== false)
{
	$statementCadastroEnderecosUpdate->execute(array(
		"id" => $id,
		"id_tb_cadastro" => $idTbCadastro,
		"tipo_endereco" => $tipoEndereco,
		"data_endereco" => $dataEndereco,
		"horario" => $horario,
		"endereco_titulo" => $enderecoTitulo,
		"endereco_descricao" => $enderecoDescricao,
		"endereco_site" => $enderecoSite,
		"endereco_email" => $enderecoEmail,
		"id_db_cep_tblBairros" => $idDBCepTblBairros,
		"id_db_cep_tblCidades" => $idDBCepTblCidades,
		"id_db_cep_tblLogradouros" => $idDBCepTblLogradouros,
		"id_db_cep_tblUF" => $idDBCepTblUF,
		"cep" => $cep,
		"endereco" => $endereco,
		"endereco_numero" => $enderecoNumero,
		"endereco_complemento" => $enderecoComplemento,
		"bairro" => $bairro,
		"cidade" => $cidade,
		"estado" => $estado,
		"pais" => $pais,
		"ponto_referencia" => $pontoReferencia,
		"mapa_online" => $mapaOnline,
		"ativacao" => $ativacao,
		"obs" => $obs
	));
	
	$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus7");
}else{
	//echo "erro";
	$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus8");
}
//----------


//Limpeza de objetos.
//----------
unset($strSqlCadastroEnderecosUpdate);
unset($statementCadastroEnderecosUpdate);
//----------


//Upload de arquivos.
//----------
if(!empty($_FILES["ArquivoUpload1"]["name"])) //Verifica se arquivos foram postados.
{

	//Definição do tamanho das imagens.
	$arrImagemTamanhos = $GLOBALS['arrImagemCadastroEnderecos'];
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
	$resultadoUpdate = DbUpdate::DbRegistroGenericoUpdate01($arquivoNome, $id, "tb_cadastro_enderecos", "imagem");
	if ($resultadoUpdate == true) 
	{
	
	}else{
		$mensagemErro .= $resultadoUpdate;
		//$mensagemSucesso = "";
	}
}
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