<?php
class Imagem
{
	//Redimensionamento de imagens.
	//**************************************************************************************
	function ImagemRedimensionar01($arrImagemTamanhos, $arquivoDiretorio, $arquivoNome)
	{
		$strReturn = false;

		for ($arrCountImagemTamanhos = 0; $arrCountImagemTamanhos < count($arrImagemTamanhos); ++$arrCountImagemTamanhos) 
		{
			//echo $arrImagemTamanhos[$arrImagemTamanhos] . "<br>";
			
			$arrImagemParametros[$arrCountImagemTamanhos] = explode(";", $arrImagemTamanhos[$arrCountImagemTamanhos]);
			$imagemPrefixo[$arrCountImagemTamanhos] = $arrImagemParametros[$arrCountImagemTamanhos][0];
			if($imagemPrefixo[$arrCountImagemTamanhos] == "NULL")
			{
				$imagemPrefixo[$arrCountImagemTamanhos] = "";
			}
			$imagemW[$arrCountImagemTamanhos] = $arrImagemParametros[$arrCountImagemTamanhos][1];
			$imagemH[$arrCountImagemTamanhos] = $arrImagemParametros[$arrCountImagemTamanhos][2];
			
			
			//echo "prefixo=" . $arrImagemParametros[0] . "<br>";
			//echo "width=" . $arrImagemParametros[1] . "<br>";
			//echo "height=" . $arrImagemParametros[2] . "<br>";
			
			$magicianObj[$arrCountImagemTamanhos] = new imageLib($arquivoDiretorio . "/" . "o" . $arquivoNome);
			$magicianObj[$arrCountImagemTamanhos] -> resizeImage($imagemW[$arrCountImagemTamanhos], $imagemH[$arrCountImagemTamanhos], 'auto');
			$magicianObj[$arrCountImagemTamanhos] -> saveImage($arquivoDiretorio . "/" . $imagemPrefixo[$arrCountImagemTamanhos] . $arquivoNome);
			
			unset($magicianObj[$arrCountImagemTamanhos]);
			unset($arrImagemParametros[$arrCountImagemTamanhos]);
			unset($imagemPrefixo[$arrCountImagemTamanhos]);
			unset($imagemW[$arrCountImagemTamanhos]);
			unset($imagemH[$arrCountImagemTamanhos]);
			
			$strReturn = true;
		}
		
		return $strReturn;
	}
	//**************************************************************************************
}