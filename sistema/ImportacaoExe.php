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
LoginAutenticacao::UsuarioLoginVerificacao();


//Variáveis.
$id = ContadorUniversal::ContadorUniversalUpdate(5);

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


//Upload de arquivos.
//----------
if(!empty($_FILES["ArquivoUpload1"]["name"])) //Verifica se arquivos foram postados.
{
	//Definição do diretório de upload.
	$arquivosDiretorioUpload = $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioMaterialEnviado'];
	
	//Definição do nome do arquivo.
	$arrArquivoExtensao = explode(".", $_FILES["ArquivoUpload1"]["name"]);
	$arquivoExtensao = strtolower(end($arrArquivoExtensao));
	$arquivoNome = $id . "." . $arquivoExtensao;
	
	
	//Gravação do arquivo original no servidor.
	$resultadoUpload = Arquivo::ArquivoUpload($id, 
											$_FILES["ArquivoUpload1"], 
											$arquivosDiretorioUpload,
											"" . $arquivoNome);

	if($resultadoUpload == true){
		
		//Descompactação do arquivo.
		if(Arquivo::ArquivoDescompactar01($arquivosDiretorioUpload . "/" . $arquivoNome, $arquivosDiretorioUpload) == true)
		{
			//Exclusão de arquivo compactado.
			if(Arquivo::ExcluirArquivos02($arquivoNome, $arquivosDiretorioUpload, "") == true)
			{
				//Pesquisar arquivos descompactados.
				$arrArquivosDiretorio = Arquivo::ArquivosDiretorioScan_Array01($GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioMaterialEnviado']);
			
				//Loop pelos arquivos encontrados.
				foreach($arrArquivosDiretorio as &$vArquivoPDF) 
				{
					$arquivoPDF = $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioMaterialEnviado'] . "/" . $vArquivoPDF;
					$arrArquivoPDFExtensao = explode(".", $vArquivoPDF);
					$arquivoPDFExtensao = strtolower(end($arrArquivoPDFExtensao));
					
					
					if($arquivoPDFExtensao == "pdf")//Verificação de o arquivo é PDF.
					{
						//Extraçao de texto do arquivo PDF.
						$pdfConteudo = PDFFuncoes::PDFConteudoLer01($arquivoPDF, 2);
						//echo "PDFConteudoLer01=" . PDFFuncoes::PDFConteudoLer01($arquivoPDF, 2) . "<br />";
						
						//Variáveis.
						$buscaNumeroProcesso = "";
						$buscaVara = "";
						$buscaPartes = "";
						$buscaNome = "";
						$buscaCPF = "";
						
						
						//Definição de variáveis.
						$buscaNumeroProcesso = Funcoes::DadosPesquisa($pdfConteudo, "Número do Processo:", "Orgão Julgador:", 1);
						$buscaVara = Funcoes::DadosPesquisa($pdfConteudo, "Orgão Julgador:", "Segredo de justiça:", 1);
						$buscaPartes = Funcoes::DadosPesquisa($pdfConteudo, "Partes:", "Documentos do Processo", 1);
						$arrBuscaPartes = explode("-", $buscaPartes);
						$buscaNome = trim($arrBuscaPartes[0]);
						$buscaCPF = substr(trim($arrBuscaPartes[1]), 0, 11) . "-" . substr(trim($arrBuscaPartes[2]), 0, 2);
						

						//Inclusão de cadastro.
						$idCadastroNovo = ContadorUniversal::ContadorUniversalUpdate(1);
						if(DbInsert::InsertCadastro($idCadastroNovo,
						"",
						"",
						"1",
						$buscaNome,
						"",
						"",
						"",
						"",
						"",
						"",
						"",
						"",
						"",
						"",
						"",
						"",
						"",
						"",
						"",
						"",
						$buscaCPF,
						"",
						"",
						"",
						"",
						"",
						"",
						"",
						"",
						"",
						"",
						"",
						"",
						"0",
						"0",
						"0",
						$tbCadastroIdDBCepTblUF,
						"",
						"",
						"",
						"",
						"",
						"",
						"",
						"",
						"",
						"",
						"0",
						"",
						"0",
						"0",
						"0",
						"0",
						"1",
						"0",
						"0",
						"",
						"",
						"",
						"",
						"",
						"",
						"",
						"",
						"",
						"",
						"",
						"",
						"",
						"",
						"",
						$buscaNumeroProcesso,
						"",
						"",
						"",
						"",
						"",
						"",
						"",
						"",
						"",
						"",
						"",
						"",
						"",
						"",
						"",
						"",
						"",
						"",
						"",
						"",
						"",
						"",
						"",
						"",
						"",
						"",
						"",
						"",
						"",
						"",
						"",
						"",
						"",
						"",
						"",
						"",
						"",
						"",
						"",
						"0",
						"4") == true)
						{
							//Gravação de tipo.
							$arrIdsCadastroTipo = array("3479");
							//echo "cheio";
							for($countArray = 0; $countArray < count($arrIdsCadastroTipo); $countArray++)
							{
								//echo "arrIdsCadastroTipo=" . $arrIdsCadastroTipo[$countArray] . "<br>";
								//echo "id=" . $id . "<br>";
								//echo "FiltrosGenericosGravar01=" . DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsCadastroTipo[$countArray], "1", "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento") . "<br>";
								DbFuncoes::FiltrosGenericosGravar01($idCadastroNovo, $arrIdsCadastroTipo[$countArray], "1", "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento");
							}
							
							//Exclusão do arquivo pdf.
							if(Arquivo::ExcluirArquivos02($vArquivoPDF, $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioMaterialEnviado'], "") == true)
							{
								
							}
						}
						
						//Verificação de erro - debug.
						//echo "buscaNumeroProcesso=" . $buscaNumeroProcesso . "<br/>";
						//echo "buscaVara=" . $buscaVara . "<br/>";
						//echo "buscaPartes=" . $buscaPartes . "<br/>";
						//echo "buscaNome=" . $buscaNome . "<br/>";
						//echo "buscaCPF=" . $buscaCPF . "<br/>";
					}
				}
				unset($vArquivoPDF); 
			}
		}
		
		
		$mensagemSucesso .= XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus17");
	}else{
		$mensagemErro .= $resultadoUpload;
		//$mensagemSucesso = "";
	}
}
//----------


//Verificação de erro - debug.
//echo "arquivosDiretorioUpload=" . $arquivosDiretorioUpload . "<br />";
//$dbSistemaConPDO = null;
//exit();
//die();


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