<?php
class CEP
{
	
	//Função para pesquisar o CEP.
	//**************************************************************************************
	function CEPFill($strCEP, $strTipoDados, $tipoPesquisa = 1)
	{
		//strTipoDados: pais | paisCodigo | uf | ufCodigo | cidade | cidadeCodigo | bairro | bairroCodigo | logradouroCodigo
		
		//Definição de variáveis.
		//----------
		$strRetorno = "";
		$CEPPesquisa = Funcoes::SomenteNum($strCEP);
		
		$retornoLogradouro = "";
		$retornoLogradouroCodigo = "0";
		$retornoBairro = "";
		$retornoBairroCodigo = "0";
		$retornoCidade = "";
		$retornoCidadeCodig = "0";
		$retornoEstado = "";
		$retornoEstadoCodigo = "";
		$retornoPais = "";
		$retornoPaisCodigo = "";
		
		$strSqlDBCEPLogradourosBrasilSelect = "";
		//----------


		//Query de pesquisa.
		//----------
		$strSqlDBCEPLogradourosBrasilSelect .= "SELECT ";
		//$strSqlDBCEPLogradourosBrasilSelect .= "* ";
		$strSqlDBCEPLogradourosBrasilSelect .= "Codigo, ";
		$strSqlDBCEPLogradourosBrasilSelect .= "UF, ";
		$strSqlDBCEPLogradourosBrasilSelect .= "CodigoCidade, ";
		$strSqlDBCEPLogradourosBrasilSelect .= "DescricaoNaoAbreviada, ";
		$strSqlDBCEPLogradourosBrasilSelect .= "Descricao, ";
		$strSqlDBCEPLogradourosBrasilSelect .= "CodigoBairro, ";
		$strSqlDBCEPLogradourosBrasilSelect .= "CEP, ";
		$strSqlDBCEPLogradourosBrasilSelect .= "BAI_NU_SEQUENCIAL_FIM, ";
		$strSqlDBCEPLogradourosBrasilSelect .= "LOG_COMPLEMENTO, ";
		$strSqlDBCEPLogradourosBrasilSelect .= "LOG_TIPO_LOGRADOURO, ";
		$strSqlDBCEPLogradourosBrasilSelect .= "LOG_STATUS_TIPO_LOG, ";
		$strSqlDBCEPLogradourosBrasilSelect .= "DescricaoSemAcento ";
		$strSqlDBCEPLogradourosBrasilSelect .= "FROM tblLogradouros ";
		/*
		if($idParentTblBairros <> "")
		{
			$strSqlDBCEPLogradourosBrasilSelect .= "WHERE CodigoBairro = :CodigoBairro ";
		}
		*/
		if($CEPPesquisa <> "")
		{
			$strSqlDBCEPLogradourosBrasilSelect .= "WHERE CEP = :CEP ";
		}
		//$strSqlDBCEPLogradourosBrasilSelect .= "ORDER BY " . $GLOBALS['configClassificacaoDBCEPLogradourosBrasil'] . " ";
		//$strSqlDBCEPLogradourosBrasilSelect .= "LIMIT 0, 10 "; //debug
		//----------
		
		
		//Parâmetros.
		//----------
		//$statementDBCEPLogradourosBrasilSelect = $dbSistemaConPDO->prepare($strSqlDBCEPLogradourosBrasilSelect);
		//$statementDBCEPLogradourosBrasilSelect = $dbCEPConPDO->prepare($strSqlDBCEPLogradourosBrasilSelect);
		$statementDBCEPLogradourosBrasilSelect = $GLOBALS['dbCEPConPDO']->prepare($strSqlDBCEPLogradourosBrasilSelect);

		if ($statementDBCEPLogradourosBrasilSelect !== false)
		{
			/*
			$statementDBCEPLogradourosBrasilSelect->execute(array(
				"id_tb_categorias" => $idParentDBCEPLogradourosBrasil
			));
			*/
			/*
			if($idParentTblBairros <> "")
			{
				$statementDBCEPLogradourosBrasilSelect->bindParam(':CodigoBairro', $idParentTblBairros, PDO::PARAM_STR);
			}
			*/
			if($CEPPesquisa <> "")
			{
				$statementDBCEPLogradourosBrasilSelect->bindParam(':CEP', $CEPPesquisa, PDO::PARAM_STR);
			}
			$statementDBCEPLogradourosBrasilSelect->execute();
		}
		//----------
		
		
		//Resultado.
		//----------
		//$resultadoDBCEPLogradourosBrasil = $dbSistemaConPDO->query($strSqlDBCEPLogradourosBrasilSelect);
		$resultadoDBCEPLogradourosBrasil = $statementDBCEPLogradourosBrasilSelect->fetchAll();

		if (empty($resultadoDBCEPLogradourosBrasil))
		{
			//Nenhum resultado encontrado.
		}else{
			foreach($resultadoDBCEPLogradourosBrasil as $linhaDBCEPLogradourosBrasil)
			{
				/*
				$retornoLogradouro = Funcoes::ConteudoMascaraLeitura($linhaDBCEPLogradourosBrasil['LOG_TIPO_LOGRADOURO']) . " " . Funcoes::ConteudoMascaraLeitura($linhaDBCEPLogradourosBrasil['DescricaoNaoAbreviada']);
				$retornoLogradouroCodigo = $linhaDBCEPLogradourosBrasil['Codigo'];
				$retornoBairro = Funcoes::ConteudoMascaraLeitura(CEP::Db_CEPFillComplemento("tblBairros", "Codigo", "Descricao", $linhaDBCEPLogradourosBrasil['CodigoBairro']));
				$retornoBairroCodigo = $linhaDBCEPLogradourosBrasil['CodigoBairro'];
				$retornoCidade = Funcoes::ConteudoMascaraLeitura(CEP::Db_CEPFillComplemento("tblCidades", "Codigo", "Descricao", $linhaDBCEPLogradourosBrasil['CodigoCidade']));
				$retornoCidadeCodigo = $linhaDBCEPLogradourosBrasil['CodigoCidade'];
				$retornoEstado = Funcoes::ConteudoMascaraLeitura(CEP::Db_CEPFillComplemento("tblUF", "Codigo", "Descricao", $linhaDBCEPLogradourosBrasil['UF']));
				$retornoEstadoCodigo = $linhaDBCEPLogradourosBrasil['UF'];
				$retornoPais = "";
				$retornoPaisCodigo = "";
				*/
				
				if($strTipoDados == "pais")
				{
					$strRetorno = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCEPBrasil");
				}
				if($strTipoDados == "paisCodigo")
				{
					$strRetorno = "";
				}
				if($strTipoDados == "uf")
				{
					$strRetorno = Funcoes::ConteudoMascaraLeitura(CEP::Db_CEPFillComplemento("tblUF", "Codigo", "Descricao", $linhaDBCEPLogradourosBrasil['UF']));
				}
				if($strTipoDados == "ufCodigo")
				{
					$strRetorno = $linhaDBCEPLogradourosBrasil['UF'];
				}
				if($strTipoDados == "cidade")
				{
					$strRetorno = Funcoes::ConteudoMascaraLeitura(CEP::Db_CEPFillComplemento("tblCidades", "Codigo", "Descricao", $linhaDBCEPLogradourosBrasil['CodigoCidade']));
				}
				if($strTipoDados == "cidadeCodigo")
				{
					$strRetorno = $linhaDBCEPLogradourosBrasil['CodigoCidade'];
				}
				if($strTipoDados == "bairro")
				{
					$strRetorno = Funcoes::ConteudoMascaraLeitura(CEP::Db_CEPFillComplemento("tblBairros", "Codigo", "Descricao", $linhaDBCEPLogradourosBrasil['CodigoBairro']));
				}
				if($strTipoDados == "bairroCodigo")
				{
					$strRetorno = $linhaDBCEPLogradourosBrasil['CodigoBairro'];
				}
				if($strTipoDados == "logradouro")
				{
					$strRetorno = Funcoes::ConteudoMascaraLeitura($linhaDBCEPLogradourosBrasil['LOG_TIPO_LOGRADOURO']) . " " . Funcoes::ConteudoMascaraLeitura($linhaDBCEPLogradourosBrasil['DescricaoNaoAbreviada']);
				}
				if($strTipoDados == "logradouroCodigo")
				{
					$strRetorno = $linhaDBCEPLogradourosBrasil['Codigo'];
				}
			}
		}
		//----------
		
		
		//Definição de qual informação retornará.
		//----------
		/*
		if($strTipoDados == "pais")
		{
			$strRetorno = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCEPBrasil");
		}
		if($strTipoDados == "uf")
		{
			$strRetorno = $retornoEstado;
		}
		if($strTipoDados == "ufCodigo")
		{
			$strRetorno = $retornoEstadoCodigo;
		}
		if($strTipoDados == "cidade")
		{
			$strRetorno = $retornoCidade;
		}
		if($strTipoDados == "cidadeCodigo")
		{
			$strRetorno = $retornoCidadeCodigo;
		}
		if($strTipoDados == "bairro")
		{
			$strRetorno = $retornoBairro;
		}
		if($strTipoDados == "bairroCodigo")
		{
			$strRetorno = $retornoBairroCodigo;
		}
		if($strTipoDados == "logradouro")
		{
			$strRetorno = $retornoLogradouro;
		}
		if($strTipoDados == "logradouroCodigo")
		{
			$strRetorno = $retornoLogradouroCodigo;
		}
		*/
		//----------


		//Limpeza de objetos.
		//----------
		unset($strSqlDBCEPLogradourosBrasilSelect);
		unset($statementDBCEPLogradourosBrasilSelect);
		unset($resultadoDBCEPLogradourosBrasil);
		unset($linhaDBCEPLogradourosBrasil);
		//----------
		
		return $strRetorno;
	}
	//**************************************************************************************

	
	//Função para restagar informações adicionais do CEP.
	//**************************************************************************************
	function Db_CEPFillComplemento($strTabela, $strCampo, $nomeCampoRetorno, $strValor)
	{
		//Definição de variáveis.
		//----------
		$strRetorno = "";
		
		$strSqlCEPFillComplementoSelect = "";
		//----------
		
		
		//Query de pesquisa.
		//----------
		//$strSqlCEPFillComplementoSelect .= "SELECT * FROM " . $strTabela . " ";
		$strSqlCEPFillComplementoSelect .= "SELECT * FROM " . Funcoes::ConteudoMascaraGravacao01($strTabela) . " ";
		//$strSqlCEPFillComplementoSelect .= "SELECT * FROM :strTabela "; //Não funciona.
		$strSqlCEPFillComplementoSelect .= "WHERE " . Funcoes::ConteudoMascaraGravacao01($strCampo) . " = :strValor ";
		//$strSqlCEPFillComplementoSelect .= "AND id = :id ";
		//echo "strSqlCEPFillComplementoSelect=" . $strSqlCEPFillComplementoSelect . "<br />";
		//----------
		
		
		//Parâmetros.	
		//----------
		//$statementCEPFillComplementoSelect = $GLOBALS['dbSistemaConPDO']->prepare($strSqlCEPFillComplementoSelect);
		$statementCEPFillComplementoSelect = $GLOBALS['dbCEPConPDO']->prepare($strSqlCEPFillComplementoSelect);
		/*
		$statementCEPFillComplementoSelect->execute(array(
			"id" => $idRegistro
		));
		*/
		
		//if($strValor <> "")
		//{
			$statementCEPFillComplementoSelect->bindParam(':strValor', $strValor, PDO::PARAM_STR);
		//}
		$statementCEPFillComplementoSelect->execute();
		//----------
			
			
		//Resultado.	
		//----------
		$resultadoCEPFillComplemento = $statementCEPFillComplementoSelect->fetchAll();
		
		if (empty($resultadoCEPFillComplemento))
		{
			//Nenhum resultado encontrado.
		}else{
			foreach($resultadoCEPFillComplemento as $linhaCEPFillComplemento)
			{
				if($linhaCEPFillComplemento[$nomeCampoRetorno] === null)
				{
					$strRetorno = "";
				}else{
					$strRetorno = $linhaCEPFillComplemento[$nomeCampoRetorno];
				}
			}
		}
		//----------


		//Limpeza de objetos.
		//----------
		unset($strSqlCEPFillComplementoSelect);
		unset($statementCEPFillComplementoSelect);
		unset($resultadoCEPFillComplemento);
		unset($linhaCEPFillComplemento);
		//----------
		

		return $strRetorno;
	}
	//**************************************************************************************
		
		
	//Função para restagar informações adicionais do CEP.
	//**************************************************************************************
	function Db_CEPFill_FetchAll($strTabela, $strCampo, $strValor)
	{
		//Definição de variáveis.
		//----------
		$strRetorno = "";
		
		$strSqlCEPFillSelect = "";
		//----------
		
		
		//Query de pesquisa.
		//----------
		//$strSqlCEPFillSelect .= "SELECT * FROM " . $strTabela . " ";
		$strSqlCEPFillSelect .= "SELECT * FROM " . Funcoes::ConteudoMascaraGravacao01($strTabela) . " ";
		//$strSqlCEPFillSelect .= "SELECT * FROM :strTabela "; //Não funciona.
		if($strValor <> "")
		{
			$strSqlCEPFillSelect .= "WHERE " . Funcoes::ConteudoMascaraGravacao01($strCampo) . " = :strValor ";
		}
		//$strSqlCEPFillSelect .= "AND id = :id ";
		//echo "strSqlCEPFillSelect=" . $strSqlCEPFillSelect . "<br />";
		//----------
		
		
		//Parâmetros.	
		//----------
		//$statementCEPFillSelect = $GLOBALS['dbSistemaConPDO']->prepare($strSqlCEPFillSelect);
		$statementCEPFillSelect = $GLOBALS['dbCEPConPDO']->prepare($strSqlCEPFillSelect);
		/*
		$statementCEPFillSelect->execute(array(
			"id" => $idRegistro
		));
		*/
		
		if($strValor <> "")
		{
			$statementCEPFillSelect->bindParam(':strValor', $strValor, PDO::PARAM_STR);
		}
		$statementCEPFillSelect->execute();
		//----------
			
			
		//Resultado.	
		//----------
		$resultadoCEPFill = $statementCEPFillSelect->fetchAll();
		
		$strRetorno = $resultadoCEPFill;
		//----------


		//Limpeza de objetos.
		//----------
		unset($strSqlCEPFillSelect);
		unset($statementCEPFillSelect);
		//unset($resultadoCEPFill);
		//unset($linhaCEPFill);
		//----------
		

		return $strRetorno;
	}
	//**************************************************************************************
}