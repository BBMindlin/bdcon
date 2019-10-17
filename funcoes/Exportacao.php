<?php
class Exportacao
{
    //Função para gravar informações num arquivo.
    //**************************************************************************************
    function GravarArquivoDados01($arquivoConteudo, $arquivoCaminho, $arquivoNome, $arquivoExtensao, $tipoGravacao)
	{
		//ref: https://www.w3schools.com/php/php_file_create.asp
		//$tipoGravacao: 1 - gravar novo | 2 - adicionar dados
		
		//Variáveis.
		$strRetorno = false;
		
		
		//Abrir arquivo.
		$foArquivo = fopen($arquivoCaminho . "/" . $arquivoNome . "." . $arquivoExtensao, "w") or die("Unable to open file!");
		//$myfile = fopen(dirname(__FILE__) . "/" . $GLOBALS['configDiretorioExportacao'] . "/" . "newfile.txt", "w") or die("Unable to open file!");
		//$txt = "Mickey Mouse\n";
		//fwrite($myfile, $txt);
		//$txt = "Minnie Mouse\n";
		//fwrite($myfile, $txt);
		
		
		//Gravar novo.
		//----------
		if($tipoGravacao == 1)
		{
			fwrite($foArquivo, $arquivoConteudo);
			$strRetorno = true;
		}
		//----------


		//Fechar arquivo.
		//fclose($arquivoCaminho . "/" . $ArquivoNome . "." . $arquivoExtensao);
		//fclose($arquivoCaminho . "/" . $ArquivoNome . "." . $arquivoExtensao);
		fclose($foArquivo);
		//fclose(dirname(__FILE__) . "/" . $GLOBALS['configDiretorioExportacao'] . "/" . $myfile);
		
		
		//Debug - verificação de erro.
		//echo "arquivoNome=" . $arquivoNome . "." . $arquivoExtensao . "<br />";
		//echo "arquivoNome=" . $arquivoCaminho . "/" . $arquivoNome . "." . $arquivoExtensao . "<br />";


		return $strRetorno;
	}
    //**************************************************************************************
}