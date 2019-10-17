<?php
class DbUpdate
{
	//Função para atualizar um registro genérico.
	//**************************************************************************************
	function DbRegistroGenericoUpdate01($strValorRegistro, $idRegistro, $strTabela, $strCampo)
	{
		//Definição de variáveis.
		$strRetorno = "";
		
		//Query de update.
		//----------	
		$strDbRegistroGenericoUpdate = "";
		$strDbRegistroGenericoUpdate .= "UPDATE " . Funcoes::ConteudoMascaraGravacao01($strTabela) . " ";
		$strDbRegistroGenericoUpdate .= "SET ";
		$strDbRegistroGenericoUpdate .= "" . Funcoes::ConteudoMascaraGravacao01($strCampo) . " = :strValorRegistro ";
		$strDbRegistroGenericoUpdate .= "WHERE id = :id ";
		
		//$statementRegistroGenericoUpdate = $mysqli->prepare($strDbRegistroGenericoUpdate);
		//$statementRegistroGenericoUpdate = $GLOBALS['dbSistemaConMysqli']->prepare($strDbRegistroGenericoUpdate);
		$statementRegistroGenericoUpdate = $GLOBALS['dbSistemaConPDO']->prepare($strDbRegistroGenericoUpdate);
		//----------	

		//$stmt = $mysqli->prepare("INSERT INTO tb_categorias SET id=?,id_parent=?,n_classificacao=?,categoria=?,descricao=?,ativacao=?,acesso_restrito=?");
		//$mensagemErro = $strSqlCategoriasInsert;
		if ($statementRegistroGenericoUpdate !== FALSE)
		{
			
			$statementRegistroGenericoUpdate->execute(array(
				"id" => $idRegistro,
				"strValorRegistro" => $strValorRegistro
			));
			
			$strRetorno = true;
		}else{
			//echo "erro";
			//$strRetorno = "Erro ao atualizar registro. (" . $GLOBALS['dbSistemaConMysqli']->errno . "-" . $GLOBALS['dbSistemaConMysqli']->error . ")";
			$strRetorno = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus8");
		}
		
		//Limpeza de objetos.
		unset($strDbRegistroGenericoUpdate);
		unset($statementRegistroGenericoUpdate);
		//----------
		
		return $strRetorno;
	}
	//**************************************************************************************
	
	
	//Função para atualizar um registro genérico (talvez substitua o DbRegistroGenericoUpdate01).
	//**************************************************************************************
	function DbRegistroGenericoUpdate02($strValorRegistro, $idRegistro, $strTabela, $strCampo, $strCampoReferencia)
	{
		//Definição de variáveis.
		$strRetorno = "";
		
		//Query de update.
		//----------	
		$strDbRegistroGenericoUpdate = "";
		$strDbRegistroGenericoUpdate .= "UPDATE " . Funcoes::ConteudoMascaraGravacao01($strTabela) . " ";
		$strDbRegistroGenericoUpdate .= "SET ";
		$strDbRegistroGenericoUpdate .= "" . Funcoes::ConteudoMascaraGravacao01($strCampo) . " = :strValorRegistro ";
		$strDbRegistroGenericoUpdate .= "WHERE " . Funcoes::ConteudoMascaraGravacao01($strCampoReferencia) . " = :idRegistro ";
		
		//$statementRegistroGenericoUpdate = $mysqli->prepare($strDbRegistroGenericoUpdate);
		//$statementRegistroGenericoUpdate = $GLOBALS['dbSistemaConMysqli']->prepare($strDbRegistroGenericoUpdate);
		$statementRegistroGenericoUpdate = $GLOBALS['dbSistemaConPDO']->prepare($strDbRegistroGenericoUpdate);
		//----------	

		//$stmt = $mysqli->prepare("INSERT INTO tb_categorias SET id=?,id_parent=?,n_classificacao=?,categoria=?,descricao=?,ativacao=?,acesso_restrito=?");
		//$mensagemErro = $strSqlCategoriasInsert;
		if ($statementRegistroGenericoUpdate !== FALSE)
		{
			$statementRegistroGenericoUpdate->execute(array(
				"idRegistro" => $idRegistro,
				"strValorRegistro" => $strValorRegistro
			));
			
			$strRetorno = true;
		}else{
			//echo "erro";
			//$strRetorno = "Erro ao atualizar registro. (" . $GLOBALS['dbSistemaConMysqli']->errno . "-" . $GLOBALS['dbSistemaConMysqli']->error . ")";
			$strRetorno = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus8");
		}
		
		//Limpeza de objetos.
		unset($strDbRegistroGenericoUpdate);
		unset($statementRegistroGenericoUpdate);
		//----------
		
		return $strRetorno;
	}
	//**************************************************************************************
}