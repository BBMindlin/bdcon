<?php
class XMLFuncoes
{
	//Função para retornar o atributo correspondente do rótulo descritivo.
	//**************************************************************************************
	function XMLIdiomas($objSimpleXML, $nomeRotulo)
	{
		$strRetorno = "";
		
		//$xmlIdioma = simplexml_load_file('IdiomaSistema.xml');
		//echo "xmlIdioma->data[0]['name'] = " . $xmlIdioma->data[0]['name'] . "<br>";
		//echo "xmlIdioma->data[1]->value = " . $xmlIdioma->data[1]->value . "<br>";
		//echo "xmlIdioma->xpath = " . $xmlIdioma->xpath('//root/data[@name="sistemaItemRoot"]') . "<br>";
		//$arrDados = $xmlIdioma->xpath('//data[@name="sistemaItemRoot"]');

		$arrDados = $objSimpleXML->xpath('//data[@name="'.$nomeRotulo.'"]');
		$strRetorno = $arrDados[0]->value;
		
		return (string)$strRetorno;
	
	}
	//**************************************************************************************
}