<?php
class Arquivo
{
	//Função para upload de arquivo.
	//**************************************************************************************
	function ArquivoUpload($idRegistro, $postedFile , $diretorioUpload, $arquivoNomeFinal)
	{
		$strReturn = false;
		
		if ($postedFile["error"] > 0)
		{
			$strReturn = "Erro no upload do arquivo.";
		}else{
			//$arquivoDiretorio = $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos'];
			//$arrArquivoExtensao = explode(".", $postedFile["name"]);
			//$arquivoExtensao = strtolower(end($arrArquivoExtensao));
			//$arquivoNome = $idRegistro . "." . $arquivoExtensao;
		
			//move_uploaded_file($postedFile["tmp_name"], $arquivoDiretorio . "/" . "o" . $idRegistro . "." . $arquivoExtensao);
			//move_uploaded_file($postedFile["tmp_name"], $diretorioUpload . "/" . "o" . $arquivoNome);
			//if (move_uploaded_file($postedFile["tmp_name"], $diretorioUpload . "/" . "o" . $arquivoNome)){
			if (move_uploaded_file($postedFile["tmp_name"], $diretorioUpload . "/" . $arquivoNomeFinal)){
				$strReturn = true;
			}else{
				//$strReturn = false;
				$strReturn = "Erro na gravação do arquivo.";
			}
		}
		
		return $strReturn;
	}
	//**************************************************************************************
	
	
	//Exclusão de arquivos do servidor.
	//**************************************************************************************
	function ExcluirArquivos($strNomeArquivo, $arrImagemTamanhos)
	{
		$strRetorno = false;
		
		for ($arrCountImagemTamanhos = 0; $arrCountImagemTamanhos < count($arrImagemTamanhos); ++$arrCountImagemTamanhos) 
		{
			$arrImagemParametros[$arrCountImagemTamanhos] = explode(";", $arrImagemTamanhos[$arrCountImagemTamanhos]);
			$imagemPrefixo[$arrCountImagemTamanhos] = $arrImagemParametros[$arrCountImagemTamanhos][0];
			
			if($imagemPrefixo[$arrCountImagemTamanhos] == "NULL")
			{
				//Exclusão da imagem sem prefixo.
				//echo DbFuncoes::GetCampoGenerico01(3758, "tb_categorias", "imagem") . "<br />";
				if (file_exists($GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos'] . "/" . $strNomeArquivo)) //Verificação se o arquivo existe.
				{
					unlink($GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos'] . "/" . $strNomeArquivo);
					$strRetorno = true;
				}
				
			}else{
				//Exclusão das imagens com prefixo.
				//echo $imagemPrefixo[$arrCountImagemTamanhos] . DbFuncoes::GetCampoGenerico01(3758, "tb_categorias", "imagem") . "<br />";
				if (file_exists($GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos'] . "/" . $imagemPrefixo[$arrCountImagemTamanhos] . $strNomeArquivo)) //Verificação se o arquivo existe.
				{
					unlink($GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos'] . "/" . $imagemPrefixo[$arrCountImagemTamanhos] . $strNomeArquivo);
					$strRetorno = true;
				}
			}
			
			//Exclusão da imagem original.
			if (file_exists($GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos'] . "/" . "o" . $strNomeArquivo)) //Verificação se o arquivo existe.
			{
				unlink($GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos'] . "/" . "o" . $strNomeArquivo);
				$strRetorno = true;
			}
		}

		//Funcionando.
		/*
		if (file_exists($GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos'] . "/" . "g3758.jpg")) //Verificação se o arquivo existe.
		{
			unlink($GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos'] . "/" . "g3758.jpg");
			$strRetorno = true;
		}
		*/
		
		return $strRetorno;
	}
	//**************************************************************************************
	
	
	//Exclusão de arquivos do servidor.
	//**************************************************************************************
	function ExcluirArquivos02($strNomeArquivo, $nomeDiretorio, $arrImagemTamanhos)
	{
		//Variáveis.
		$strRetorno = false;
		
		
		//Exclusão do arquivo.
		if (file_exists($nomeDiretorio . "/" . $strNomeArquivo)) //Verificação se o arquivo existe.
		{
			unlink($nomeDiretorio . "/" . $strNomeArquivo);
			$strRetorno = true;
		}

		
		return $strRetorno;
	}
	//**************************************************************************************

	
	//Função para descompactar arquivo.
	//**************************************************************************************
	function ArquivoDescompactar01($_arquivoDescompactar, $_diretorioDescompactar)
	{
		//Variáveis.
		$strRetorno = false;
		
		//$file = 'file.zip';
		$arquivoDescompactar = $_arquivoDescompactar;
		
		//$path = pathinfo(realpath($file), PATHINFO_DIRNAME);
		$diretorioDescompactar = $_diretorioDescompactar;
		
		
		//Componente.
		$zaArquivo = new ZipArchive;
		
		$resultadoArquivoAbertura = $zaArquivo->open($arquivoDescompactar);
		
		if ($resultadoArquivoAbertura === TRUE) {
		  //Descompactação.
		  $zaArquivo->extractTo($diretorioDescompactar);
		  $zaArquivo->close();
		  
		  $strRetorno = true;
		  //echo "WOOT! $file extracted to $path";
		} else {
		  //echo "Doh! I couldn't open $file";
		}
		
		
		return $strRetorno;
	}
	//**************************************************************************************
	
	
	//Função para ler arquivo num determinado diretório e retornar como array.
	//**************************************************************************************
	function ArquivosDiretorioScan_Array01($_diretorioScan)
	{
		//Variáveis.
		$strRetorno = array();
		$diretorioScan = $_diretorioScan;
		
		$strRetorno = array_diff(scandir($diretorioScan), array('..', '.')); //retirar marcação de arquivo . e ..
		
		
		return $strRetorno;
	}
	//**************************************************************************************
	
	
	//Função para ler conteúdo de arquivos.
	//**************************************************************************************
	function ArquivosConteudoLer01($arquivoCaminhoCompleto, $tipoComponente = 1, $tipoRetorno = 0)
	{
		//$tipoComponente: 1 - fopen()
		//$tipoRetorno: 0 - sem nenhuma formatação - conteúdo completo | 1 - quebra de linha html (<br/>)
		
		//Variáveis.
		//----------
		$strRetorno = "";
		
		$arquivoLer = "";
		//----------
		
		
		//fopen()
		//----------
		if($tipoComponente == 1)
		{
			$arquivoLer = fopen($arquivoCaminhoCompleto, "r") or die("Erro ao ler arquivo!"); //ref: https://www.w3schools.com/php/php_file_open.asp
			//sem nenhuma formatação
			if($tipoRetorno == 0)
			{
				$strRetorno = fread($arquivoLer, filesize($arquivoCaminhoCompleto));
			}
			fclose($arquivoLer);
		}
		//----------


		return $strRetorno;
	}
	//**************************************************************************************
}