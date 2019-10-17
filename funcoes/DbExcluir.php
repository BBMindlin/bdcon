<?php
class DbExcluir
{
    //Função para exclusão genérica de registros.
	//**************************************************************************************
	function ExcluirRegistrosGenerico01($idRegistro, $strTabela, $strNomeCampo)
	{
		$strRetorno = false;
		
		//Exclusão de registro no BD.
		//----------
		$strExcluirRegistrosGenerico = "";
		$strExcluirRegistrosGenerico .= "DELETE FROM " . Funcoes::ConteudoMascaraGravacao01($strTabela) . " ";
		$strExcluirRegistrosGenerico .= "WHERE " . Funcoes::ConteudoMascaraGravacao01($strNomeCampo) . " = :idRegistro";
		
		$statementExcluirRegistrosGenerico = $GLOBALS['dbSistemaConPDO']->prepare($strExcluirRegistrosGenerico);
		
		if ($statementExcluirRegistrosGenerico !== false)
		{
			$statementExcluirRegistrosGenerico->execute(array(
				"idRegistro" => $idRegistro
			));
			$strRetorno = true;
		}else{
			//echo "erro";
			echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus15");
		}
		//----------

		//Limpeza de objetos.
		//----------
		unset($strExcluirRegistrosGenerico);
		unset($statementExcluirRegistrosGenerico);
		//----------

		//$GLOBALS['dbSistemaConPDO'] = null;
		
		return $strRetorno;
	}
	//**************************************************************************************
	
	
    //Função para exclusão genérica de registros.
	//**************************************************************************************
	function ExcluirRegistrosGenerico02($idRegistro, 
	$strTabela, 
	$strNomeCampo,
	$strCampoComplementar1Referencia = "", 
	$strCampoComplementar1Valor = "", 
	$strCampoComplementar2Referencia = "", 
	$strCampoComplementar2Valor = "",
	$strCampoComplementar3Referencia = "", 
	$strCampoComplementar3Valor = "",
	$strCampoComplementar4Referencia = "", 
	$strCampoComplementar4Valor = "")
	{
		//Variáveis.
		$strRetorno = false;
		
		
		//Montagem do query.
		//----------
		$strExcluirRegistrosGenerico = "";
		$strExcluirRegistrosGenerico .= "DELETE FROM " . Funcoes::ConteudoMascaraGravacao01($strTabela) . " ";
		$strExcluirRegistrosGenerico .= "WHERE " . Funcoes::ConteudoMascaraGravacao01($strNomeCampo) . " = :idRegistro ";
		
		if($strCampoComplementar1Referencia <> "")
		{
			$strExcluirRegistrosGenerico .= "AND " . Funcoes::ConteudoMascaraGravacao01($strCampoComplementar1Referencia) . " = :strCampoComplementar1Valor ";
		}
		
		if($strCampoComplementar2Referencia <> "")
		{
			$strExcluirRegistrosGenerico .= "AND " . Funcoes::ConteudoMascaraGravacao01($strCampoComplementar2Referencia) . " = :strCampoComplementar2Valor ";
		}
		
		if($strCampoComplementar3Referencia <> "")
		{
			$strExcluirRegistrosGenerico .= "AND " . Funcoes::ConteudoMascaraGravacao01($strCampoComplementar3Referencia) . " = :strCampoComplementar3Valor ";
		}
		
		if($strCampoComplementar4Referencia <> "")
		{
			$strExcluirRegistrosGenerico .= "AND " . Funcoes::ConteudoMascaraGravacao01($strCampoComplementar4Referencia) . " = :strCampoComplementar4Valor ";
		}
		//----------


		//Inclusão de parâmetros.
		//----------
		$statementExcluirRegistrosGenerico = $GLOBALS['dbSistemaConPDO']->prepare($strExcluirRegistrosGenerico);
		
		if ($statementExcluirRegistrosGenerico !== false)
		{
			
			$statementExcluirRegistrosGenerico->bindParam(':idRegistro', $idRegistro, PDO::PARAM_STR);
			
			if($strCampoComplementar1Referencia <> "")
			{
				$statementExcluirRegistrosGenerico->bindParam(':strCampoComplementar1Valor', $strCampoComplementar1Valor, PDO::PARAM_STR);
			}
			
			if($strCampoComplementar2Referencia <> "")
			{
				$statementExcluirRegistrosGenerico->bindParam(':strCampoComplementar2Valor', $strCampoComplementar2Valor, PDO::PARAM_STR);
			}
			
			if($strCampoComplementar3Referencia <> "")
			{
				$statementExcluirRegistrosGenerico->bindParam(':strCampoComplementar3Valor', $strCampoComplementar3Valor, PDO::PARAM_STR);
			}
			
			if($strCampoComplementar4Referencia <> "")
			{
				$statementExcluirRegistrosGenerico->bindParam(':strCampoComplementar4Valor', $strCampoComplementar4Valor, PDO::PARAM_STR);
			}

			$statementExcluirRegistrosGenerico->execute();

			/*
			$statementExcluirRegistrosGenerico->execute(array(
				"idRegistro" => $idRegistro
			));
			*/
			
			$strRetorno = true;
		}else{
			//echo "erro";
			echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus15");
		}
		//----------

		//Limpeza de objetos.
		//----------
		unset($strExcluirRegistrosGenerico);
		unset($statementExcluirRegistrosGenerico);
		//----------

		//$GLOBALS['dbSistemaConPDO'] = null;
		
		return $strRetorno;
	}
	//**************************************************************************************
}