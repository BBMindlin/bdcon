<?php

//class Funcoes
//{
	
	//Funчуo para gravar valores monetсrios formatados.
	//**************************************************************************************
	//public function MascaraValorGravar($strValor)
	function MascaraValorGravar($strValor)
	{
		//private $returnValor = $strValor;
		$returnValor = $strValor;
		
		$returnValor = str_replace(".", "", $returnValor);
		$returnValor = str_replace(",", "", $returnValor);
		
		return $returnValor;
	}
	//**************************************************************************************
//}

?>