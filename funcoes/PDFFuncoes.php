<?php
class PDFFuncoes
{
	//Função para ler conteúdo de arquivos PDF.
	//**************************************************************************************
	function PDFConteudoLer01($arquivoPDF, $tipoComponente, $paginaPDF = NULL)
	{
		//$tipoComponente: 1 - PDF2Text | 2 - PDFParser
		
		//Variáveis.
		$strReturn = "";
		
		
		//PDF2Text.
		//----------
		if($tipoComponente == 1)
		{
			$pdf2tObjeto = new PDF2Text();
			//$a->setFilename('filename.pdf'); 
			$pdf2tObjeto->setFilename($arquivoPDF); 
			$pdf2tObjeto->decodePDF();
			//echo $a->output();
			$strReturn = $pdf2tObjeto->output();
			unset($pdf2tObjeto); 
		}
		//----------
		
		
		//PDFParser.
		//----------
		if($tipoComponente == 2)
		{
			//$fullfile = $arquivoPDF;
			$PDFConteudo = "";
			//$out = "";
			$pPDF = new \Smalot\PdfParser\Parser();
			$PDFDocumento = $pPDF->parseFile($arquivoPDF);
			$paginasPDF = $PDFDocumento->getPages();
			$paginaPDF = $paginasPDF[0];
			//$PDFConteudo = $paginaPDF->getText(); //funcionando - implementar função de seleção de página.
			$PDFConteudo = $PDFDocumento->getText(); //funcionando.
			//$out = $PDFConteudo;
			//echo '<pre>' . $out . '</pre>';
			
			$strReturn = $PDFConteudo;
			
			unset($pPDF); 
		}
		//----------
		
		return $strReturn;
	}
	//**************************************************************************************
}
?>