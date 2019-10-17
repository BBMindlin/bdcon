<?php
class ContadorUniversal
{
	//Contador universal.
	//**************************************************************************************
	function ContadorUniversalUpdate($idTbContador)
	{
		//Definição de variáveis.
		$strRetorno = "";
		$nContador = 0;
		
		
		//Query de pesquisa.
		//----------	
		$strContadorSelect = "";
		$strContadorSelect .= "SELECT contador FROM contador ";
		$strContadorSelect .= "WHERE id <> 0 ";
		$strContadorSelect .= "AND id = ? ";
		
		$statementContadorSelect = $GLOBALS['dbSistemaConMysqli']->prepare($strContadorSelect);
		
		if ($statementContadorSelect !== FALSE)
		{
			$statementContadorSelect->bind_param('i', 
			$idTbContador);
			$statementContadorSelect->execute();
			$statementContadorSelect->bind_result($rsContador);
			
			while($statementContadorSelect->fetch())
			{
				$nContador = $rsContador + 1;
				$strRetorno = $nContador;
			}
			$statementContadorSelect->close();
		}
		else
		{
			//$strRetorno = "Erro ao atualizar registro. (" . $GLOBALS['dbSistemaConMysqli']->errno . "-" . $GLOBALS['dbSistemaConMysqli']->error . ")";
			echo "Erro ao atualizar registro. (" . $GLOBALS['dbSistemaConMysqli']->errno . "-" . $GLOBALS['dbSistemaConMysqli']->error . ")";
			exit();
		}
		
		//$strContadorSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCategorias'] . " ";
		//echo "strContadorSelect=" . $strContadorSelect . "<br />";
		
		
		//Limpeza de objetos.
		unset($strContadorSelect);
		unset($statementContadorSelect);
		//----------
		
		
		//Query de atualização.
		//----------
		$strContadorUpdate = "";
		$strContadorUpdate .= "UPDATE contador SET ";
		$strContadorUpdate .= "contador = ? ";
		$strContadorUpdate .= "WHERE id = ? ";
		
		$statementContadorUpdate = $GLOBALS['dbSistemaConMysqli']->prepare($strContadorUpdate);
		
		if ($statementContadorUpdate !== FALSE)
		{
			$statementContadorUpdate->bind_param('ii', 
			$nContador, 
			$idTbContador);
			
			$statementContadorUpdate->execute();
			$statementContadorUpdate->close();
			
			//$strRetorno = true;
		}else{
			//echo "erro";
			//$strRetorno = "Erro ao atualizar registro. (" . $GLOBALS['dbSistemaConMysqli']->errno . "-" . $GLOBALS['dbSistemaConMysqli']->error . ")";
			echo "Erro ao atualizar registro. (" . $GLOBALS['dbSistemaConMysqli']->errno . "-" . $GLOBALS['dbSistemaConMysqli']->error . ")";
			exit();
		}
		
		//Limpeza de objetos.
		unset($strDbRegistroGenericoUpdate);
		unset($statementContadorUpdate);
		//----------
		
		
		//Fechamento da conexão.
		//$GLOBALS['dbSistemaConMysqli']->close();
		
		
		//$strRetorno = "5" . $idTbContador;
		return $strRetorno;
	}
	//**************************************************************************************
}
