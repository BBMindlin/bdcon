<?php
class DbFuncoes
{
	//Montagem dos links do caminho da categoria.
	//**************************************************************************************
	function CategoriasCaminho($_idParentCategorias, $_idParentCategoriasRaiz, $_linkSeparador, $strCssClass, $strInterface, $strComplementoQueryString = "")
	{
		//Criação de variáveis.
		//$strInterface: frontend | backend
		$strRetorno = "";
		//$arrIdCategorias[];
		//$arrTituloCategorias[];
		$countArrays = 0;
		$countRegistros = 0;
		$idParentCategoriasAnterior = $_idParentCategorias;
		
		if(DbFuncoes::RegistroGenericoVerificar("tb_categorias", "id", $_idParentCategorias) == true)
		{
			while(!$idParentCategoriasAnterior == $_idParentCategoriasRaiz)
			{
				//$arrIdCategorias[$countArrays]
				//$arrTituloCategorias[$countArrays]
				
				//Query de pesquisa.
				//----------
				$strSqlCategoriasCaminho = "";
				$strSqlCategoriasCaminho .= "SELECT ";
				$strSqlCategoriasCaminho .= "id, ";
				$strSqlCategoriasCaminho .= "id_parent, ";
				$strSqlCategoriasCaminho .= "categoria ";
				$strSqlCategoriasCaminho .= "FROM tb_categorias ";
				$strSqlCategoriasCaminho .= "WHERE id <> 0 ";
				//$strSqlCategoriasCaminho .= "AND id_parent = " . $idParentCategorias . " ";
				$strSqlCategoriasCaminho .= "AND id = :idParentCategoriasAnterior ";
				//----------
				
				$statementCategoriasCaminho = $GLOBALS['dbSistemaConPDO']->prepare($strSqlCategoriasCaminho);
				
				if ($statementCategoriasCaminho !== false)
				{
					$statementCategoriasCaminho->execute(array(
						"idParentCategoriasAnterior" => $idParentCategoriasAnterior
					));
				}
			
				//$resultadoCategorias = $dbSistemaConPDO->query($strSqlCategoriasSelect);
				$resultadoCategoriasCaminho = $statementCategoriasCaminho->fetchAll();
				
				//Inclusão das informações nos arrays.
				if(!empty($resultadoCategoriasCaminho))
				{
					foreach($resultadoCategoriasCaminho as $linhaCategoriasCaminho)
					{
						$arrIdCategorias[$countArrays] = $linhaCategoriasCaminho['id'];
						$arrTituloCategorias[$countArrays] = $linhaCategoriasCaminho['categoria'];
						$idParentCategoriasAnterior = $linhaCategoriasCaminho['id_parent'];
						$countArrays = $countArrays + 1;
					}
					
				}
				
				//Limpeza de objetos.
				unset($strSqlCategoriasCaminho);
				unset($statementCategoriasCaminho);
				unset($resultadoCategoriasCaminho);
				//----------
			}
			
			//Loop para montagem dos caminhos.
			//----------
			$countArrays = $countArrays - 1;
			//$linksSeparador = " - ";
			$linksSeparador = $_linkSeparador;
			while($countArrays >= 0)
			{
				if($strInterface == "backend")
				{
					$strRetorno .= $linksSeparador;
					//$strRetorno .= "<a href='CategoriasIndice.php?idParentCategorias=".$arrIdCategorias[$countArrays]."&idParentCategoriasRaiz=".$_idParentCategoriasRaiz."".$strComplementoQueryString."' class='Links04'>";
					$strRetorno .= "<a href='CategoriasIndice.php?idParentCategorias=".$arrIdCategorias[$countArrays]."&idParentCategoriasRaiz=".$_idParentCategoriasRaiz."".$strComplementoQueryString."' class='".$strCssClass."'>";
					
					$strRetorno .= $arrTituloCategorias[$countArrays];
					$strRetorno .= "</a>";
					
					$countArrays = $countArrays - 1;
				}
				if($strInterface == "backend")
				{
					//Fazer montagem com função para determinar página.
				}
			}
			//----------
			
		}
		
		return $strRetorno;
	}
	//**************************************************************************************
	
	
	//Preenchimento dos vínculos principais do registro.
	//**************************************************************************************
	//function CategoriasIdParentSelect($idParentCategoriasSelecao, $strTipoCategoria)
	function CategoriasIdParentSelect($strTipoCategoria)
	{
		//Definição de variáveis.
		$strRetorno = array();
		
		$coutArrayDimensao1 = 0;
		
		//Query de pesquisa.
		//----------
		$strSqlCategoriasIdParent = "";
		$strSqlCategoriasIdParent .= "SELECT ";
		$strSqlCategoriasIdParent .= "id, ";
		$strSqlCategoriasIdParent .= "categoria ";
		//$strSqlCategoriasIdParent .= "FROM " . $strTabela . " ";
		$strSqlCategoriasIdParent .= "FROM tb_categorias ";
		$strSqlCategoriasIdParent .= "WHERE id <> 0 ";
		if($strTipoCategoria <> ""){
			$strSqlCategoriasIdParent .= "AND tipo_categoria = :tipo_categoria ";
		}
		$strSqlCategoriasIdParent .= "ORDER BY " . $GLOBALS['configClassificacaoCategorias'] . " ";
		
		$statementCategoriasIdParent =  $GLOBALS['dbSistemaConPDO']->prepare($strSqlCategoriasIdParent);
		//----------


		if ($statementCategoriasIdParent !== false)
		{
			$statementCategoriasIdParent->execute(array(
				"tipo_categoria" => $strTipoCategoria
			));
		}
		
		//$resultadoCategoriasIdParent = $dbSistemaConPDO->query($strSqlCategoriasIdParent);
		$resultadoCategoriasIdParent = $statementCategoriasIdParent->fetchAll();
		
		
		if (empty($resultadoCategoriasIdParent))
		{
			//Nenhum registro encontrado.
		}else{
			//Loop pelos resultados.
			//$strRetorno(
			//$strRetorno[
				foreach($resultadoCategoriasIdParent as $linhaCategoriasIdParent)
				{
					//$strRetorno .= Funcoes::ConteudoMascaraLeitura($linhaCategoriasIdParent['complemento']);
					//"id" => $linhaCategoriasIdParent['id'],
					//"complemento" => Funcoes::ConteudoMascaraLeitura($linhaCategoriasIdParent['complemento']),
					
					$strRetorno[$coutArrayDimensao1][0] = $linhaCategoriasIdParent['id'];
					$strRetorno[$coutArrayDimensao1][1] = Funcoes::ConteudoMascaraLeitura($linhaCategoriasIdParent['categoria']);
					
					$coutArrayDimensao1 = $coutArrayDimensao1 + 1;
				}
			//];
			//);
		}
		
		//Limpeza de objetos.
		//----------
		unset($strSqlCategoriasIdParent);
		unset($statementCategoriasIdParent);
		unset($resultadoCategoriasIdParent);
		unset($linhaCategoriasIdParent);
		//----------

		//return $strRetorno[][];
		return $strRetorno;
	}
	//**************************************************************************************
	
	
	//Rotina genérica para preenchimento do vínculo baseado em relação de tabelas do registro.
	//**************************************************************************************
	function VinculoGenericoSelect02($idParent, $idTipoComplemento, $strTabela, $nomeCampoParent, $nomeCampoReferencia, $classificacao, $metodoPesquisa)
	{
		//metodoPesquisa: 1 - id de categoria | 2 - tipo de complemento
		
		//Definição de variáveis.
		//----------
		$strRetorno = array();
		$idsRelacaoComplemento = "";
		
		$coutArrayDimensao1 = 0;
		//----------

		
		//Por tipo.
		if($strTabela == "tb_cadastro")
		{
			if($metodoPesquisa == 2)
			{
				//função para buscar ids dos cadastros por tipo
				/*
				$idsRelacaoComplemento = DbFuncoes::GetIdsByTipoComplemento($idTipoComplemento,
																		  "tb_cadastro_relacao_complemento",
																		  "id_tb_cadastro_complemento",
																		  "id_tb_cadastro");
				*/														  
				$idsRelacaoComplemento = DbFuncoes::GetCampoGenerico06("tb_cadastro_relacao_complemento", 
																	"id_tb_cadastro", 
																	"id_tb_cadastro_complemento", 
																	$idTipoComplemento);
				  
				if($idsRelacaoComplemento == "")
				{
					$idsRelacaoComplemento = "0";
				}
			}
		}
		
		
		//Query de pesquisa.
		//----------
		$strSqlCategoriasIdParent = "";
		$strSqlCategoriasIdParent .= "SELECT ";
		$strSqlCategoriasIdParent .= "id, ";
		if($strTabela == "tb_cadastro")
		{	
			$strSqlCategoriasIdParent .= "nome, ";
			$strSqlCategoriasIdParent .= "razao_social, ";
			$strSqlCategoriasIdParent .= "nome_fantasia ";
		}else{
			$strSqlCategoriasIdParent .= "" . Funcoes::ConteudoMascaraGravacao01($nomeCampoReferencia) . " ";
		}
		//$strSqlCategoriasIdParent .= "* ";
		//$strSqlCategoriasIdParent .= "FROM " . $strTabela . " ";
		$strSqlCategoriasIdParent .= "FROM " . Funcoes::ConteudoMascaraGravacao01($strTabela) . " ";
		$strSqlCategoriasIdParent .= "WHERE id <> 0 ";
		
		//$strSqlCategoriasIdParent .= "AND " . Funcoes::ConteudoMascaraGravacao01($nomeCampoParent) . " = :idParent ";
		
		//Por categoria.
		if($metodoPesquisa == 1)
		{
			if($idParent == "0")
			{
				//Seleciona todos.	
			}else{
				$strSqlCategoriasIdParent .= "AND " . Funcoes::ConteudoMascaraGravacao01($nomeCampoParent) . " = :idParent ";
			}
		}
		
		//Por tipo.
		if($metodoPesquisa == 2)
		{
			$strSqlCategoriasIdParent .= "AND id IN (" . Funcoes::ConteudoMascaraGravacao01($idsRelacaoComplemento) . ") ";
		}
		
		$strSqlCategoriasIdParent .= "ORDER BY " . Funcoes::ConteudoMascaraGravacao01($classificacao) . " ";
		//echo "strSqlCategoriasIdParent=" . $strSqlCategoriasIdParent . "<br />";
		//echo "nomeCampoReferencia=" . $nomeCampoReferencia . "<br />";
		
		$statementCategoriasIdParent =  $GLOBALS['dbSistemaConPDO']->prepare($strSqlCategoriasIdParent);
		//----------
	
	
		//Parâmentros.
		//----------
		if ($statementCategoriasIdParent !== false)
		{
			if($metodoPesquisa == 1)
			{
				if($idParent <> "")
				{
					$statementCategoriasIdParent->bindParam(':idParent', $idParent, PDO::PARAM_STR);
				}
			}
			$statementCategoriasIdParent->execute();
			/*
			$statementCategoriasIdParent->execute(array(
				"idParent" => $idParent
			));
			*/
		}
		
		
		//$resultadoCategoriasIdParent = $dbSistemaConPDO->query($strSqlCategoriasIdParent);
		$resultadoCategoriasIdParent = $statementCategoriasIdParent->fetchAll();
		//----------
		
		
		if (empty($resultadoCategoriasIdParent))
		{
			//Nenhum registro encontrado.
		}else{
			//Loop pelos resultados.
			//$strRetorno(
			//$strRetorno[
				foreach($resultadoCategoriasIdParent as $linhaCategoriasIdParent)
				{
					//$strRetorno .= Funcoes::ConteudoMascaraLeitura($linhaCategoriasIdParent['complemento']);
					//"id" => $linhaCategoriasIdParent['id'],
					//"complemento" => Funcoes::ConteudoMascaraLeitura($linhaCategoriasIdParent['complemento']),
					$strRetorno[$coutArrayDimensao1][0] = $linhaCategoriasIdParent['id'];
					
					if($strTabela == "tb_cadastro")
					{
						if($nomeCampoReferencia == "")
						{
							//$strRetorno[$coutArrayDimensao1][0] = $linhaCategoriasIdParent['id'];
							//$strRetorno[$coutArrayDimensao1][1] = Funcoes::ConteudoMascaraLeitura($linhaCategoriasIdParent['nome']);
							$strRetorno[$coutArrayDimensao1][1] = Funcoes::GetCadastroTitulo(Funcoes::ConteudoMascaraLeitura($linhaCategoriasIdParent['nome']), 
																							Funcoes::ConteudoMascaraLeitura($linhaCategoriasIdParent['razao_social']), 
																							Funcoes::ConteudoMascaraLeitura($linhaCategoriasIdParent['nome_fantasia']), 
																							1);
							//echo "linhaCategoriasIdParent['nome']=" . Funcoes::ConteudoMascaraLeitura($linhaCategoriasIdParent['nome']) . "<br />";
							//echo "linhaCategoriasIdParent['razao_social']=" . Funcoes::ConteudoMascaraLeitura($linhaCategoriasIdParent['razao_social']) . "<br />";
							//echo "GetCadastroTitulo=" . Funcoes::GetCadastroTitulo(Funcoes::ConteudoMascaraLeitura($linhaCategoriasIdParent['nome']), 
																							//Funcoes::ConteudoMascaraLeitura($linhaCategoriasIdParent['razao_social']), 
																							//Funcoes::ConteudoMascaraLeitura($linhaCategoriasIdParent['nome_fantasia']), 
																							//1) . "<br />";
						}else{
							//$strRetorno[$coutArrayDimensao1][0] = $linhaCategoriasIdParent['id'];
							$strRetorno[$coutArrayDimensao1][1] = Funcoes::ConteudoMascaraLeitura($linhaCategoriasIdParent[$nomeCampoReferencia]);
						}
					}else{
						//$strRetorno[$coutArrayDimensao1][0] = $linhaCategoriasIdParent['id'];
						$strRetorno[$coutArrayDimensao1][1] = Funcoes::ConteudoMascaraLeitura($linhaCategoriasIdParent[$nomeCampoReferencia]);
					}
					
					$coutArrayDimensao1 = $coutArrayDimensao1 + 1;
				}
			//];
			//);
		}
		
		
		//Limpeza de objetos.
		//----------
		unset($strSqlCategoriasIdParent);
		unset($statementCategoriasIdParent);
		unset($resultadoCategoriasIdParent);
		unset($linhaCategoriasIdParent);
		//----------
	
	
		//return $strRetorno[][];
		return $strRetorno;
	}
	//**************************************************************************************
	
	
	//Função para retornar ids dos registros vinculados a um id de complementos usando uma sequencia de ids.
	//**************************************************************************************
	function GetIdsByTipoComplemento_FromArray($idsTipoComplemento, 
	$nomeTabelaRelacaoComplemento, 
	$nomeCampoComplemento, 
	$nomeCampoReferencia)
	{
		$strRetorno = "";
		
		if($idsTipoComplemento <> "")
		{
			$arrIdsTipoComplemento = explode(",", $idsTipoComplemento);
			
			for ($CountArrays = 0; $CountArrays < count($arrIdsTipoComplemento); ++$CountArrays) 
			{
				//echo "arrIdsTipoComplemento=" . $arrIdsTipoComplemento[$CountArrays] . "<br />";
				
				if($strRetorno <> "")
				{
					$strRetorno .= "," . DbFuncoes::GetCampoGenerico06($nomeTabelaRelacaoComplemento, 
																		$nomeCampoReferencia, 
																		$nomeCampoComplemento, 
																		$arrIdsTipoComplemento[$CountArrays], 
																		"", 
																		"", 
																		1, 
																		"", 
																		"", 
																		"", 
																		"", 
																		"", 
																		"");
				}else{
					$strRetorno .= DbFuncoes::GetCampoGenerico06($nomeTabelaRelacaoComplemento, 
																$nomeCampoReferencia, 
																$nomeCampoComplemento, 
																$arrIdsTipoComplemento[$CountArrays], 
																"", 
																"", 
																1, 
																"", 
																"", 
																"", 
																"", 
																"", 
																"");
				}
				
				//Verificação da retirada da última vírgula.
				$strRetorno = Funcoes::IdsFormatar01($strRetorno);
	
			}
		}
		
		return $strRetorno;
	}
	//**************************************************************************************
	
	
	//Função para retornar ids dos registros vinculados a um id de complementos usando uma sequencia de ids.
	//**************************************************************************************
	function GetIdsByTipoComplemento_FromArray02($idsTipoComplemento, 
	$nomeTabelaRelacaoComplemento, 
	$nomeCampoComplemento, 
	$nomeCampoReferencia, 
	$strTipoRetorno = "1")
	{
		//strTipoRetorno: 1 - lógica Or | 2 - lógica And
		//Variáveis.
		//-------------
		$arrIdsTipoComplemento = array();
		$idsTbCadastro = "";
		$arrIdsTbCadastro = array();
		$strRetorno = "";
		//-------------
		
		
		//Lógica or.
		//-------------
		if($strTipoRetorno <> "1")
		{
			if($idsTipoComplemento <> "")
			{
				$arrIdsTipoComplemento = explode(",", $idsTipoComplemento);
				
				for ($CountArrays = 0; $CountArrays < count($arrIdsTipoComplemento); ++$CountArrays) 
				{
					//echo "arrIdsTipoComplemento=" . $arrIdsTipoComplemento[$CountArrays] . "<br />";
					
					if($strRetorno <> "")
					{
						$strRetorno .= "," . DbFuncoes::GetCampoGenerico06($nomeTabelaRelacaoComplemento, 
																			$nomeCampoReferencia, 
																			$nomeCampoComplemento, 
																			$arrIdsTipoComplemento[$CountArrays], 
																			"", 
																			"", 
																			1, 
																			"", 
																			"", 
																			"", 
																			"", 
																			"", 
																			"");
					}else{
						$strRetorno .= DbFuncoes::GetCampoGenerico06($nomeTabelaRelacaoComplemento, 
																	$nomeCampoReferencia, 
																	$nomeCampoComplemento, 
																	$arrIdsTipoComplemento[$CountArrays], 
																	"", 
																	"", 
																	1, 
																	"", 
																	"", 
																	"", 
																	"", 
																	"", 
																	"");
					}
					
					//Verificação da retirada da última vírgula.
					$strRetorno = Funcoes::IdsFormatar01($strRetorno);
		
				}
			}
		}
		//-------------
		
		
		//Lógica and.
		//-------------
		if($strTipoRetorno <> "2")
		{
			if($idsTipoComplemento <> "")
			{
				
				$arrIdsTipoComplemento = explode(",", $idsTipoComplemento);
				
				
				$idsTbCadastro = DbFuncoes::GetCampoGenerico07("tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro", "");
				
				if($idsTbCadastro <> "")
				{
					$idsTbCadastro = Funcoes::IdsFormatar01($idsTbCadastro);
					$arrIdsTbCadastro = explode(",", $idsTbCadastro);
					
					
					//Pesquisa e retorno em objeto.
					$resultadoCadastroComplementoRelacao = DbFuncoes::FiltrosGenericosSelect02_FetchAll("tb_cadastro_relacao_complemento");
					
					for($countIdsTbCadastro = 0; $countIdsTbCadastro < count($arrIdsTbCadastro); $countIdsTbCadastro++)
					{
						$flagAdicionar = true;
						
						for($countComplemento = 0; $countComplemento < count($arrIdsTipoComplemento); $countComplemento++)
						{
							if(empty($resultadoCadastroComplementoRelacao))
							{
							
							}else{
								//Loop pelos resultados.
								foreach($resultadoCadastroComplementoRelacao as $linhaCadastroComplementoRelacao)
								{
									if($linhaCadastroManutencao2['id_tb_cadastro_complemento'] == $arrIdsTipoComplemento[$countComplemento] && $linhaCadastroManutencao2['id_tb_cadastro'] == $arrIdsTbCadastro[$countIdsTbCadastro])
									{
										
									}else{
										$flagAdicionar = false;
									}
								}
							}
							//Limpeza.
							unset($resultadoCadastroComplementoRelacao);
							unset($linhaCadastroComplementoRelacao);
						}
					}
					
					if($flagAdicionar == true)
					{
						$strRetorno = $strRetorno . $arrIdsTbCadastro[$countIdsTbCadastro] . ",";
					}
					
				}
			}
			
			/*
			if($strRetorno <> "")
			{
				$strRetorno = 	Funcoes::IdsFormatar01($strRetorno);
			}
			*/
		}
		//-------------
		return $strRetorno;
	}
	//**************************************************************************************
	
	
    //Função para verificar se um tipo de inforamção será existe ou não.
	//**************************************************************************************
	function RegistroGenericoVerificar($strTabela, $strCampoReferencia, $idReferencia)
	{
		$strReturn = false;
		
		//Query de pesquisa.
		//----------
		$strSqlRegistroGenericoVerificar = "";
		$strSqlRegistroGenericoVerificar .= "SELECT ";
		$strSqlRegistroGenericoVerificar .= "id ";
		//$strSqlRegistroGenericoVerificar .= "acesso_restrito ";
		$strSqlRegistroGenericoVerificar .= "FROM " . Funcoes::ConteudoMascaraGravacao01($strTabela) . " ";
		$strSqlRegistroGenericoVerificar .= "WHERE id <> 0 ";
		//$strSqlRegistroGenericoVerificar .= "AND id_parent = ? ";
		//$strSqlRegistroGenericoVerificar .= "AND id_parent = " . $idParentCategorias . " ";
		$strSqlRegistroGenericoVerificar .= "AND " . Funcoes::ConteudoMascaraGravacao01($strCampoReferencia) . " = :id ";
		//----------
		
		$statementRegistroGenericoVerificar = $GLOBALS['dbSistemaConPDO']->prepare($strSqlRegistroGenericoVerificar);
		
		if ($statementRegistroGenericoVerificar !== false)
		{
			$statementRegistroGenericoVerificar->execute(array(
				"id" => $idReferencia
			));
		}
	
		//$resultadoCategorias = $dbSistemaConPDO->query($strSqlCategoriasSelect);
		$resultadoRegistroGenericoVerificar = $statementRegistroGenericoVerificar->fetchAll();
		
		if (empty($resultadoRegistroGenericoVerificar))
		{
			$strReturn = false;
		}else{
			$strReturn = true;
		}
		
		//Limpeza de objetos.
		unset($strSqlRegistroGenericoVerificar);
		unset($statementRegistroGenericoVerificar);
		unset($resultadoRegistroGenericoVerificar);
		//----------
		
		return $strReturn;
	}
	//**************************************************************************************

	
	//Função para retornar um campo genérico.
	//**************************************************************************************
	function GetCampoGenerico01($idRegistro, $strTabela, $nomeCampo)
	{
		$strRetorno = "";
		
		//Query de pesquisa.
		//----------
		$strSqlCampoGenericoSelect = "";
		//$strSqlCampoGenericoSelect .= "SELECT * FROM " . $strTabela . " ";
		$strSqlCampoGenericoSelect .= "SELECT * FROM " . Funcoes::ConteudoMascaraGravacao01($strTabela) . " ";
		//$strSqlCampoGenericoSelect .= "SELECT * FROM :strTabela "; //Não funciona.
		$strSqlCampoGenericoSelect .= "WHERE id <> 0 ";
		$strSqlCampoGenericoSelect .= "AND id = :id ";
		//----------
		
		$statementCampoGenericoSelect = $GLOBALS['dbSistemaConPDO']->prepare($strSqlCampoGenericoSelect);
		
			$statementCampoGenericoSelect->execute(array(
				"id" => $idRegistro
			));
			
		$resultadoCampoGenerico = $statementCampoGenericoSelect->fetchAll();
		
		if (empty($resultadoCampoGenerico))
		{
			//Nenhum resultado encontrado.
		}else{
			foreach($resultadoCampoGenerico as $linhaCampoGenerico)
			{
				if($linhaCampoGenerico[$nomeCampo] === null)
				{
					$strRetorno = "";
				}else{
					$strRetorno = $linhaCampoGenerico[$nomeCampo];
				}
			}
		}
		
		//Limpeza de objetos.
		unset($strSqlCampoGenericoSelect);
		unset($statementCampoGenericoSelect);
		unset($resultadoCampoGenerico);
		unset($linhaCampoGenerico);
		//----------
		
		return $strRetorno;
	}
	//**************************************************************************************
	
	
	//Função para retornar um campo genérico (talvez substitua o GetCampoGenerico01 e o GetCampoGenerico03).
	//**************************************************************************************
	function GetCampoGenerico04($strTabela, $nomeCampoRetorno, $nomeCampoReferencia, $strValorReferencia, $strClassificacao = "", $strNRegistros = "", $tipoRetorno = 1)
	{
		//tipoRetorno: 1 - valores separados por vírgula e espaço (, ) | 2 - primeiro valor da pesquisa
		$strRetorno = "";
		
		//Query de pesquisa.
		//----------
		$strSqlCampoGenericoSelect = "";
		//$strSqlCampoGenericoSelect .= "SELECT * FROM " . $strTabela . " ";
		$strSqlCampoGenericoSelect .= "SELECT * FROM " . Funcoes::ConteudoMascaraGravacao01($strTabela) . " ";
		//$strSqlCampoGenericoSelect .= "SELECT * FROM classificacao ";
		//$strSqlCampoGenericoSelect .= "SELECT * FROM :strTabela "; //Não funciona.
		//$strSqlCampoGenericoSelect .= "WHERE id <> 0 ";
		//$strSqlCampoGenericoSelect .= "AND id = :id ";
		$strSqlCampoGenericoSelect .= "WHERE " . Funcoes::ConteudoMascaraGravacao01($nomeCampoReferencia) . " = :strValor ";
		//$strSqlCampoGenericoSelect .= "WHERE id_registro = :strValor ";
		//$strSqlCampoGenericoSelect .= "WHERE id_registro = 1200 ";
		//$strRetorno .= "strSqlCampoGenericoSelect=" . $strSqlCampoGenericoSelect;
		//----------
		
		$statementCampoGenericoSelect = $GLOBALS['dbSistemaConPDO']->prepare($strSqlCampoGenericoSelect);
		
			$statementCampoGenericoSelect->execute(array(
				"strValor" => $strValorReferencia
			));
			
		$resultadoCampoGenerico = $statementCampoGenericoSelect->fetchAll();
		
		if (empty($resultadoCampoGenerico))
		{
			//Nenhum resultado encontrado.
		}else{
			foreach($resultadoCampoGenerico as $linhaCampoGenerico)
			{
				if($linhaCampoGenerico[$nomeCampoRetorno] === null)
				//if($linhaCampoGenerico["criterio_classificacao"] === null)
				{
					$strRetorno = "";
				}else{
					if($tipoRetorno == 1)
					{
						$strRetorno .= $linhaCampoGenerico[$nomeCampoRetorno] . ",";
					}
					if($tipoRetorno == 2)
					{
						$strRetorno = $linhaCampoGenerico[$nomeCampoRetorno];
						//$strRetorno .= $linhaCampoGenerico["criterio_classificacao"];
					}
				}
			}
		}
		
		//Tratamento da variável para retirar a última vírgula.
		if($tipoRetorno == 1)
		{
			if($strRetorno <> "")
			{
				$strRetorno = substr($strRetorno, -strlen($strRetorno), strlen($strRetorno)-1);
			}
		}
		
		//Limpeza de objetos.
		unset($strSqlCampoGenericoSelect);
		unset($statementCampoGenericoSelect);
		unset($resultadoCampoGenerico);
		unset($linhaCampoGenerico);
		//----------
		
		return $strRetorno;
	}
	//**************************************************************************************
	

	//Função para retornar um campo genérico (talvez substitua o GetCampoGenerico01 e o GetCampoGenerico03).
	//**************************************************************************************
	function GetCampoGenerico06($strTabela, 
	$nomeCampoRetorno, 
	$nomeCampoReferencia, 
	$strValorReferencia, 
	$strClassificacao = "", 
	$strNRegistros = "", 
	$tipoRetorno = 1,
	$strCampoUsuarioReferencia = "", 
	$strCampoUsuarioValor = "", 
	$strCampoComplementar1Referencia = "", 
	$strCampoComplementar1Valor = "", 
	$strCampoComplementar2Referencia = "", 
	$strCampoComplementar2Valor = "")
	{
		//tipoRetorno: 1 - valores separados por vírgula e espaço (, ) | 2 - primeiro valor da pesquisa
		$strRetorno = "";
		
		//Query de pesquisa.
		//----------
		$strSqlCampoGenericoSelect = "";
		//$strSqlCampoGenericoSelect .= "SELECT * FROM " . $strTabela . " ";
		$strSqlCampoGenericoSelect .= "SELECT * FROM " . Funcoes::ConteudoMascaraGravacao01($strTabela) . " ";
		//$strSqlCampoGenericoSelect .= "SELECT * FROM classificacao ";
		//$strSqlCampoGenericoSelect .= "SELECT * FROM :strTabela "; //Não funciona.
		//$strSqlCampoGenericoSelect .= "WHERE id <> 0 ";
		//$strSqlCampoGenericoSelect .= "AND id = :id ";
		$strSqlCampoGenericoSelect .= "WHERE " . Funcoes::ConteudoMascaraGravacao01($nomeCampoReferencia) . " = :strValor ";
		
		if($strCampoUsuarioReferencia <> "")
		{
			$strSqlCampoGenericoSelect .= "AND " . Funcoes::ConteudoMascaraGravacao01($strCampoUsuarioReferencia) . " = :strCampoUsuarioValor ";
		}
		
		if($strCampoComplementar1Referencia <> "")
		{
			$strSqlCampoGenericoSelect .= "AND " . Funcoes::ConteudoMascaraGravacao01($strCampoComplementar1Referencia) . " = :strCampoComplementar1Valor ";
		}
		
		if($strCampoComplementar2Referencia <> "")
		{
			$strSqlCampoGenericoSelect .= "AND " . Funcoes::ConteudoMascaraGravacao01($strCampoComplementar2Referencia) . " = :strCampoComplementar2Valor ";
		}

		//$strSqlCampoGenericoSelect .= "WHERE id_registro = :strValor ";
		//$strSqlCampoGenericoSelect .= "WHERE id_registro = 1200 ";
		//echo "strSqlCampoGenericoSelect=" . $strSqlCampoGenericoSelect . "<br />";
		//echo "strValorReferencia=" . $strValorReferencia . "<br />";
		//echo "strCampoComplementar1Valor=" . $strCampoComplementar1Valor . "<br />";
		//$strRetorno .= "strSqlCampoGenericoSelect=" . $strSqlCampoGenericoSelect;
		//----------
		
		
		//Inclusão de parâmetros.
		//----------
		$statementCampoGenericoSelect = $GLOBALS['dbSistemaConPDO']->prepare($strSqlCampoGenericoSelect);
		
		if ($statementCampoGenericoSelect !== false)
		{
			$statementCampoGenericoSelect->bindParam(':strValor', $strValorReferencia, PDO::PARAM_STR);
			
			if($strCampoUsuarioReferencia <> "")
			{
				$statementCampoGenericoSelect->bindParam(':strCampoUsuarioValor', $strCampoUsuarioValor, PDO::PARAM_STR);
			}
			
			if($strCampoComplementar1Referencia <> "")
			{
				$statementCampoGenericoSelect->bindParam(':strCampoComplementar1Valor', $strCampoComplementar1Valor, PDO::PARAM_STR);
			}
			
			if($strCampoComplementar2Referencia <> "")
			{
				$statementCampoGenericoSelect->bindParam(':strCampoComplementar2Valor', $strCampoComplementar2Valor, PDO::PARAM_STR);
			}

			//$statementTarefasSelect->bindParam(':palavraChave', $palavraChave, PDO::PARAM_STR);
			//$statementTarefasSelect->bindParam(':palavraChave', "%".$palavraChave."%", PDO::PARAM_STR);
			$statementCampoGenericoSelect->execute();

			/*
			$statementCampoGenericoSelect->execute(array(
				"strValor" => $strValorReferencia
			));
			*/
		}
		//----------


		//Resultado.
		//----------
		$resultadoCampoGenerico = $statementCampoGenericoSelect->fetchAll();
		
		if (empty($resultadoCampoGenerico))
		{
			//Nenhum resultado encontrado.
		}else{
			foreach($resultadoCampoGenerico as $linhaCampoGenerico)
			{
				if($linhaCampoGenerico[$nomeCampoRetorno] === null)
				//if($linhaCampoGenerico["criterio_classificacao"] === null)
				{
					$strRetorno = "";
				}else{
					if($tipoRetorno == 1)
					{
						$strRetorno .= $linhaCampoGenerico[$nomeCampoRetorno] . ",";
					}
					if($tipoRetorno == 2)
					{
						$strRetorno = $linhaCampoGenerico[$nomeCampoRetorno];
						//$strRetorno .= $linhaCampoGenerico["criterio_classificacao"];
					}
				}
			}
		}
		//----------


		//Tratamento da variável para retirar a última vírgula.
		//----------
		if($tipoRetorno == 1)
		{
			if($strRetorno <> "")
			{
				$strRetorno = substr($strRetorno, -strlen($strRetorno), strlen($strRetorno)-1);
			}
		}
		//----------


		//Limpeza de objetos.
		//----------
		unset($strSqlCampoGenericoSelect);
		unset($statementCampoGenericoSelect);
		unset($resultadoCampoGenerico);
		unset($linhaCampoGenerico);
		//----------
		
		return $strRetorno;
	}
	//**************************************************************************************
	
	
	//Função para retornar um campo genérico (talvez substitua o GetCampoGenerico01 e o GetCampoGenerico03).
	//**************************************************************************************
	function GetCampoGenerico07($strTabela, 
	$nomeCampoRetorno, 
	$nomeCampoReferencia, 
	$strValorReferencia, 
	$strClassificacao = "", 
	$strNRegistros = "", 
	$tipoRetorno = 1,
	$strCampoUsuarioReferencia = "", 
	$strCampoUsuarioValor = "", 
	$strCampoComplementar1Referencia = "", 
	$strCampoComplementar1Valor = "", 
	$strCampoComplementar2Referencia = "", 
	$strCampoComplementar2Valor = "",
	$strCampoIdsReferencia = "", 
	$strCampoIdsValor = "")
	{
		//tipoRetorno: 1 - valores separados por vírgula e espaço (, ) | 2 - primeiro valor da pesquisa
		$strRetorno = "";
		
		//Query de pesquisa.
		//----------
		$strSqlCampoGenericoSelect = "";
		//$strSqlCampoGenericoSelect .= "SELECT * FROM " . $strTabela . " ";
		$strSqlCampoGenericoSelect .= "SELECT * FROM " . Funcoes::ConteudoMascaraGravacao01($strTabela) . " ";
		//$strSqlCampoGenericoSelect .= "SELECT * FROM classificacao ";
		//$strSqlCampoGenericoSelect .= "SELECT * FROM :strTabela "; //Não funciona.
		//$strSqlCampoGenericoSelect .= "WHERE id <> 0 ";
		//$strSqlCampoGenericoSelect .= "AND id = :id ";
		$strSqlCampoGenericoSelect .= "WHERE " . Funcoes::ConteudoMascaraGravacao01($nomeCampoReferencia) . " = :strValor ";
		
		if($strCampoUsuarioReferencia <> "")
		{
			$strSqlCampoGenericoSelect .= "AND " . Funcoes::ConteudoMascaraGravacao01($strCampoUsuarioValor) . " = :strCampoUsuarioValor ";
		}
		
		if($strCampoComplementar1Referencia <> "")
		{
			$strSqlCampoGenericoSelect .= "AND " . Funcoes::ConteudoMascaraGravacao01($strCampoComplementar1Referencia) . " = :strCampoComplementar1Valor ";
		}
		
		if($strCampoComplementar2Referencia <> "")
		{
			$strSqlCampoGenericoSelect .= "AND " . Funcoes::ConteudoMascaraGravacao01($strCampoComplementar2Referencia) . " = :strCampoComplementar2Valor ";
		}
		
		if($strCampoIdsReferencia <> "" && $strCampoIdsValor <> "")
		{
			$strSqlCampoGenericoSelect .= "AND " . Funcoes::ConteudoMascaraGravacao01($strCampoIdsReferencia) . " IN(". Funcoes::ConteudoMascaraGravacao01($strCampoIdsValor) .") ";
		}
		

		//$strSqlCampoGenericoSelect .= "WHERE id_registro = :strValor ";
		//$strSqlCampoGenericoSelect .= "WHERE id_registro = 1200 ";
		//echo "strSqlCampoGenericoSelect=" . $strSqlCampoGenericoSelect . "<br />";
		//echo "strValorReferencia=" . $strValorReferencia . "<br />";
		//echo "strCampoComplementar1Valor=" . $strCampoComplementar1Valor . "<br />";
		//$strRetorno .= "strSqlCampoGenericoSelect=" . $strSqlCampoGenericoSelect;
		//----------
		
		
		//Inclusão de parâmetros.
		//----------
		$statementCampoGenericoSelect = $GLOBALS['dbSistemaConPDO']->prepare($strSqlCampoGenericoSelect);
		
		if ($statementCampoGenericoSelect !== false)
		{
			$statementCampoGenericoSelect->bindParam(':strValor', $strValorReferencia, PDO::PARAM_STR);
			
			if($strCampoUsuarioReferencia <> "")
			{
				$statementCampoGenericoSelect->bindParam(':strCampoUsuarioValor', $strCampoUsuarioValor, PDO::PARAM_STR);
			}
			
			if($strCampoComplementar1Referencia <> "")
			{
				$statementCampoGenericoSelect->bindParam(':strCampoComplementar1Valor', $strCampoComplementar1Valor, PDO::PARAM_STR);
			}
			
			if($strCampoComplementar2Referencia <> "")
			{
				$statementCampoGenericoSelect->bindParam(':strCampoComplementar2Valor', $strCampoComplementar2Valor, PDO::PARAM_STR);
			}

			//$statementTarefasSelect->bindParam(':palavraChave', $palavraChave, PDO::PARAM_STR);
			//$statementTarefasSelect->bindParam(':palavraChave', "%".$palavraChave."%", PDO::PARAM_STR);
			$statementCampoGenericoSelect->execute();

			/*
			$statementCampoGenericoSelect->execute(array(
				"strValor" => $strValorReferencia
			));
			*/
		}
		//----------


		//Resultado.
		//----------
		$resultadoCampoGenerico = $statementCampoGenericoSelect->fetchAll();
		
		if (empty($resultadoCampoGenerico))
		{
			//Nenhum resultado encontrado.
		}else{
			foreach($resultadoCampoGenerico as $linhaCampoGenerico)
			{
				if($linhaCampoGenerico[$nomeCampoRetorno] === null)
				//if($linhaCampoGenerico["criterio_classificacao"] === null)
				{
					$strRetorno = "";
				}else{
					if($tipoRetorno == 1)
					{
						$strRetorno .= $linhaCampoGenerico[$nomeCampoRetorno] . ",";
					}
					if($tipoRetorno == 2)
					{
						$strRetorno = $linhaCampoGenerico[$nomeCampoRetorno];
						//$strRetorno .= $linhaCampoGenerico["criterio_classificacao"];
					}
				}
			}
		}
		//----------


		//Tratamento da variável para retirar a última vírgula.
		//----------
		if($tipoRetorno == 1)
		{
			if($strRetorno <> "")
			{
				$strRetorno = substr($strRetorno, -strlen($strRetorno), strlen($strRetorno)-1);
			}
		}
		//----------


		//Limpeza de objetos.
		//----------
		unset($strSqlCampoGenericoSelect);
		unset($statementCampoGenericoSelect);
		unset($resultadoCampoGenerico);
		unset($linhaCampoGenerico);
		//----------
		
		return $strRetorno;
	}
	//**************************************************************************************
	
	
	//Função para retornar um campo genérico com critérios genéricos de seleção.
	//**************************************************************************************
	function GetCampoGenerico10($strTabela, 
	$nomeCampoRetorno, 
	$arrParametrosPesquisa, 
	$strClassificacao = "", 
	$strNRegistros = "", 
	$tipoRetorno = 1)
	{
        //arrParametrosPesquisa: array("nomeCampoPesquisa1;valorCampoPesquisa1;tipoCampoPesquisa1", "nomeCampoPesquisa2;valorCampoPesquisa2;tipoCampoPesquisa2", "nomeCampoPesquisa3;valorCampoPesquisa3;tipoCampoPesquisa3")
			//ex: New String() {"id_tb_cadastro_cliente;31358;s", "tipo_movimento;0;s", "data_movimento;2018-01-22,2018-01-24;dif"}
			//tipoCampoPesquisa: s (string) | !s (string) - diferente | i (integer) | !i (integer) - diferente | d (data) | dif (data inicial e data final) | ids (id IN)
			//dif (data inicial e data final) (data): dataInicial,dataFinal
			//Obs: Os parâmetros sem parametrização devem ficar no final do array. Caso contrário, dá erro.
			//Obs: Os parâmetros de data devem ficar ao final do array. Caso contrário, dá erro.
		//tipoRetorno: 1 - valores separados por vírgula e espaço (, ) | 2 - primeiro valor da pesquisa
		
		
		//Variáveis.
        //----------
		$strRetorno = "";
        //----------


		//Query de pesquisa.
		//----------
		$strSqlCampoGenericoSelect = "";
		//$strSqlCampoGenericoSelect .= "SELECT * FROM " . $strTabela . " ";
		$strSqlCampoGenericoSelect .= "SELECT * FROM " . Funcoes::ConteudoMascaraGravacao01($strTabela) . " ";
		//$strSqlCampoGenericoSelect .= "SELECT * FROM classificacao ";
		//$strSqlCampoGenericoSelect .= "SELECT * FROM :strTabela "; //Não funciona.
		//$strSqlCampoGenericoSelect .= "WHERE id <> 0 ";
		//$strSqlCampoGenericoSelect .= "AND id = :id ";
		//$strSqlCampoGenericoSelect .= "WHERE " . Funcoes::ConteudoMascaraGravacao01($nomeCampoReferencia) . " = :strValor ";
		//$strSqlCampoGenericoSelect .= "WHERE " . Funcoes::ConteudoMascaraGravacao01($nomeCampoRetorno) . " <> '' "; //Mudar futuramente.
		$strSqlCampoGenericoSelect .= "WHERE id <> 0 "; //Mudar futuramente.
		
		
		//Loop.
		for($countArray = 0; $countArray < count($arrParametrosPesquisa); $countArray++)
		{
            $arrParametrosPesquisaInfo = explode(";", $arrParametrosPesquisa[$countArray]);
			
            $parametrosPesquisaNomeCampo = $arrParametrosPesquisaInfo[0];
            $parametrosPesquisaValorCampo = $arrParametrosPesquisaInfo[1];
            $parametrosPesquisaTipoCampo = $arrParametrosPesquisaInfo[2];
			
			
            //String.
			if($parametrosPesquisaTipoCampo == "s")
			{
                $strSqlCampoGenericoSelect .= "AND " . Funcoes::ConteudoMascaraGravacao01($parametrosPesquisaNomeCampo) . " = ? ";
			}
			if($parametrosPesquisaTipoCampo == "!s")
			{
                $strSqlCampoGenericoSelect .= "AND " . Funcoes::ConteudoMascaraGravacao01($parametrosPesquisaNomeCampo) . " <> ? ";
			}
			
            //Integer.
			if($parametrosPesquisaTipoCampo == "i")
			{
                //$strSqlTabelaGenericaSelect .= "AND " . Funcoes::ConteudoMascaraGravacao01($parametrosPesquisaNomeCampo) . " = :" . Funcoes::ConteudoMascaraGravacao01($parametrosPesquisaNomeCampo) . " ";//não funcionou
                $strSqlCampoGenericoSelect .= "AND " . Funcoes::ConteudoMascaraGravacao01($parametrosPesquisaNomeCampo) . " = ? ";
                //$strSqlTabelaGenericaSelect .= "AND @campo_" & Funcoes.ConteudoMascaraGravacao01(parametrosPesquisaNomeCampo) & " = @" & Funcoes.ConteudoMascaraGravacao01(parametrosPesquisaNomeCampo) & " ";
			}
			if($parametrosPesquisaTipoCampo == "!i")
			{
                //$strSqlTabelaGenericaSelect .= "AND " . Funcoes::ConteudoMascaraGravacao01($parametrosPesquisaNomeCampo) . " = :" . Funcoes::ConteudoMascaraGravacao01($parametrosPesquisaNomeCampo) . " ";//não funcionou
                $strSqlCampoGenericoSelect .= "AND " . Funcoes::ConteudoMascaraGravacao01($parametrosPesquisaNomeCampo) . " <> ? ";
                //$strSqlTabelaGenericaSelect .= "AND @campo_" & Funcoes.ConteudoMascaraGravacao01(parametrosPesquisaNomeCampo) & " = @" & Funcoes.ConteudoMascaraGravacao01(parametrosPesquisaNomeCampo) & " ";
			}
			
			//ids.
			if($parametrosPesquisaTipoCampo == "ids")
			{
				if($parametrosPesquisaValorCampo == "")
				{
					$parametrosPesquisaValorCampo = "0";
				}
                $strSqlCampoGenericoSelect .= "AND " . Funcoes::ConteudoMascaraGravacao01($parametrosPesquisaNomeCampo) . " IN (" . $parametrosPesquisaValorCampo . ") ";
			}
			
			//Date.
			if($parametrosPesquisaTipoCampo == "d")
			{
                $strSqlCampoGenericoSelect .= "AND DATE(" . Funcoes::ConteudoMascaraGravacao01($parametrosPesquisaNomeCampo) . ") = ? ";
			}

			//Data Inicial, Final.
			if($parametrosPesquisaTipoCampo == "dif")
			{
				/*
				$arrParametrosPesquisaInfoDatas = explode(",", $parametrosPesquisaValorCampo);
				$parametrosPesquisaDataInicial = $arrParametrosPesquisaInfoDatas[0];
				$parametrosPesquisaDataFinal = $arrParametrosPesquisaInfoDatas[1];
				*/
                
				$strSqlCampoGenericoSelect .= "AND " . Funcoes::ConteudoMascaraGravacao01($parametrosPesquisaNomeCampo) . " BETWEEN ? AND ? "; //funcionando
				//$strSqlCampoGenericoSelect .= "AND " . Funcoes::ConteudoMascaraGravacao01($parametrosPesquisaNomeCampo) . " BETWEEN DATE(?) AND DATE(?) "; //funcionando
				//$strSqlCampoGenericoSelect .= "AND " . Funcoes::ConteudoMascaraGravacao01($parametrosPesquisaNomeCampo) . " BETWEEN '?' AND '?' ";
				//$strSqlCampoGenericoSelect .= "AND " . Funcoes::ConteudoMascaraGravacao01($parametrosPesquisaNomeCampo) . " BETWEEN '2017-06-19' AND '2018-06-19' "; //debug
				//$strSqlCampoGenericoSelect .= "AND " . Funcoes::ConteudoMascaraGravacao01($parametrosPesquisaNomeCampo) . " BETWEEN '" . $parametrosPesquisaDataInicial . "' AND '" . $parametrosPesquisaDataFinal . "' "; //funcionando
			}


			//Verificação de erro - debug.
			//echo "parametrosPesquisaNomeCampo=" . $parametrosPesquisaNomeCampo . "<br>";
			//echo "parametrosPesquisaValorCampo=" . $parametrosPesquisaValorCampo . "<br>";
			//echo "parametrosPesquisaTipoCampo=" . $parametrosPesquisaTipoCampo . "<br>";
		} 
		
		if($strClassificacao <> "")
		{
			$strSqlCampoGenericoSelect .= "ORDER BY " . Funcoes::ConteudoMascaraGravacao01($strClassificacao);
		}
		//$strSqlCampoGenericoSelect .= "WHERE id_registro = 1200 ";
		//echo "strSqlCampoGenericoSelect=" . $strSqlCampoGenericoSelect . "<br />";
		//echo "strValorReferencia=" . $strValorReferencia . "<br />";
		//echo "strCampoComplementar1Valor=" . $strCampoComplementar1Valor . "<br />";
		//$strRetorno .= "strSqlCampoGenericoSelect=" . $strSqlCampoGenericoSelect;
		//----------
		
		
		//Inclusão de parâmetros.
		//----------
		//$statementCampoGenericoSelect = $GLOBALS['dbSistemaConPDO']->prepare($strSqlCampoGenericoSelect);
		//$statementCampoGenericoSelect = $GLOBALS['dbInternoConPDO']->prepare($strSqlCampoGenericoSelect);
		$statementCampoGenericoSelect = $GLOBALS['dbSistemaConPDO']->prepare($strSqlCampoGenericoSelect);

		if ($statementCampoGenericoSelect !== false)
		{
			//Loop.
			$countLoop = count($arrParametrosPesquisa);
			//for($countArray = 0; $countArray < count($arrParametrosPesquisa); $countArray++)
			for($countArray = 0; $countArray < $countLoop; $countArray++)
			{
				$arrParametrosPesquisaInfo = explode(";", $arrParametrosPesquisa[$countArray]);
				
				$parametrosPesquisaNomeCampo = $arrParametrosPesquisaInfo[0];
				$parametrosPesquisaValorCampo = $arrParametrosPesquisaInfo[1];
				$parametrosPesquisaTipoCampo = $arrParametrosPesquisaInfo[2];
				
				//String.
				if($parametrosPesquisaTipoCampo == "s")
				{
					//$statementTabelaGenericaSelect->bindParam(":" . $parametrosPesquisaNomeCampo, $parametrosPesquisaValorCampo, PDO::PARAM_STR);
					$statementCampoGenericoSelect->bindValue(($countArray + 1), $parametrosPesquisaValorCampo, PDO::PARAM_STR);
				}
				if($parametrosPesquisaTipoCampo == "!s")
				{
					//$statementTabelaGenericaSelect->bindParam(":" . $parametrosPesquisaNomeCampo, $parametrosPesquisaValorCampo, PDO::PARAM_STR);
					$statementCampoGenericoSelect->bindValue(($countArray + 1), $parametrosPesquisaValorCampo, PDO::PARAM_STR);
				}
				
				//Integer.
				if($parametrosPesquisaTipoCampo == "i")
				{
					//$statementTabelaGenericaSelect->bindParam(":" . $parametrosPesquisaNomeCampo, $parametrosPesquisaValorCampo, PDO::PARAM_INT); //Não funcionou.
					//$statementTabelaGenericaSelect->bindParam(':' . $parametrosPesquisaNomeCampo, $parametrosPesquisaValorCampo, PDO::PARAM_INT); //Não funcionou.
					$statementCampoGenericoSelect->bindValue(($countArray + 1), $parametrosPesquisaValorCampo, PDO::PARAM_INT);
				}
				if($parametrosPesquisaTipoCampo == "!i")
				{
					//$statementTabelaGenericaSelect->bindParam(":" . $parametrosPesquisaNomeCampo, $parametrosPesquisaValorCampo, PDO::PARAM_INT); //Não funcionou.
					//$statementTabelaGenericaSelect->bindParam(':' . $parametrosPesquisaNomeCampo, $parametrosPesquisaValorCampo, PDO::PARAM_INT); //Não funcionou.
					$statementCampoGenericoSelect->bindValue(($countArray + 1), $parametrosPesquisaValorCampo, PDO::PARAM_INT);
				}

				//Date.
				if($parametrosPesquisaTipoCampo == "d")
				{
					//$statementTabelaGenericaSelect->bindParam(":" . $parametrosPesquisaNomeCampo, $parametrosPesquisaValorCampo, PDO::PARAM_STR);
					$statementCampoGenericoSelect->bindValue(($countArray + 1), $parametrosPesquisaValorCampo, PDO::PARAM_STR);
				}

				//Data Inicial, Final.
				if($parametrosPesquisaTipoCampo == "dif")
				{
					$countLoop = $countLoop + 1;
					/**/
					$arrParametrosPesquisaInfoDatas = explode(",", $parametrosPesquisaValorCampo);
					$parametrosPesquisaDataInicial = $arrParametrosPesquisaInfoDatas[0];
					$parametrosPesquisaDataFinal = $arrParametrosPesquisaInfoDatas[1];
					
					$statementCampoGenericoSelect->bindValue(($countArray + 1), $parametrosPesquisaDataInicial, PDO::PARAM_STR); //obs: talvez unix, tenha que passar como PDO::PARAM_INT
					$countArray = $countArray + 1;
					$statementCampoGenericoSelect->bindValue(($countArray + 1), $parametrosPesquisaDataFinal, PDO::PARAM_STR); //obs: talvez unix, tenha que passar como PDO::PARAM_INT
				}


				//Verificação de erro - debug.
				//echo "parametrosPesquisaNomeCampo=" . $parametrosPesquisaNomeCampo . "<br>";
				//echo "parametrosPesquisaValorCampo=" . $parametrosPesquisaValorCampo . "<br>";
				//echo "parametrosPesquisaTipoCampo=" . $parametrosPesquisaTipoCampo . "<br>";
			} 
			

			//$statementTarefasSelect->bindParam(':palavraChave', $palavraChave, PDO::PARAM_STR);
			//$statementTarefasSelect->bindParam(':palavraChave', "%".$palavraChave."%", PDO::PARAM_STR);
			$statementCampoGenericoSelect->execute();

			/*
			$statementCampoGenericoSelect->execute(array(
				"strValor" => $strValorReferencia
			));
			*/
		}
		//----------


		//Resultado.
		//----------
		$resultadoCampoGenerico = $statementCampoGenericoSelect->fetchAll();
		
		if (empty($resultadoCampoGenerico))
		{
			//Nenhum resultado encontrado.
		}else{
			foreach($resultadoCampoGenerico as $linhaCampoGenerico)
			{
				if($linhaCampoGenerico[$nomeCampoRetorno] === null)
				//if($linhaCampoGenerico["criterio_classificacao"] === null)
				{
					$strRetorno = "";
				}else{
					if($tipoRetorno == 1)
					{
						$strRetorno .= $linhaCampoGenerico[$nomeCampoRetorno] . ",";
					}
					if($tipoRetorno == 2)
					{
						$strRetorno = $linhaCampoGenerico[$nomeCampoRetorno];
						//$strRetorno .= $linhaCampoGenerico["criterio_classificacao"];
					}
				}
			}
		}
		//----------


		//Tratamento da variável para retirar a última vírgula.
		//----------
		if($tipoRetorno == 1)
		{
			if($strRetorno <> "")
			{
				$strRetorno = substr($strRetorno, -strlen($strRetorno), strlen($strRetorno)-1);
			}
		}
		//----------


		//Limpeza de objetos.
		//----------
		unset($strSqlCampoGenericoSelect);
		unset($statementCampoGenericoSelect);
		unset($resultadoCampoGenerico);
		unset($linhaCampoGenerico);
		//----------
		
		return $strRetorno;
	}
	//**************************************************************************************
	
	
	//Função para retornar um campo genérico com critérios genéricos de seleção.
	//**************************************************************************************
	function GetCampoGenerico11($strTabela, 
	$nomeCampoRetorno, 
	$arrParametrosPesquisa, 
	$strClassificacao = "", 
	$strNRegistros = "", 
	$tipoRetorno = 1,
	$arrParametrosEspeciais = array())
	{
        //arrParametrosPesquisa: array("nomeCampoPesquisa1;valorCampoPesquisa1;tipoCampoPesquisa1", "nomeCampoPesquisa2;valorCampoPesquisa2;tipoCampoPesquisa2", "nomeCampoPesquisa3;valorCampoPesquisa3;tipoCampoPesquisa3")
			//ex: New String() {"id_tb_cadastro_cliente;31358;s", "tipo_movimento;0;s", "data_movimento;2018-01-22,2018-01-24;dif"}
			//tipoCampoPesquisa: s (string) | !s (string) - diferente | i (integer) | !i (integer) - diferente | d (data) | dif (data inicial e data final) | ids (id IN) | like (like)
			//dif (data inicial e data final) (data): dataInicial,dataFinal
		//tipoRetorno: 1 - valores separados por vírgula e espaço (, ) | 2 - primeiro valor da pesquisa | 3 - array de ids (navegação independente)
		//$arrParametrosEspeciais: array("idRegistroAtual" => "123")
		
		
		//Variáveis.
        //----------
		$strRetorno = "";
		
		$idRegistroAtualRetorno = "";
		$idRegistroProximoRetorno = "";
		$idRegistroAnteriorRetorno = "";
		$idRegistroPrimeiroRetorno = "";
		$idRegistroUltimoRetorno = "";
		
		$idsRegistrosCount = 0;
		$idRegistroAtualPosicao = 0;
		
		$flagIdRegistroProximoRetornoArmazenar = 0;
		$flagIdRegistroAnteriorRetornoArmazenar = 0;
        //----------


		//Query de pesquisa.
		//----------
		$strSqlCampoGenericoSelect = "";
		//$strSqlCampoGenericoSelect .= "SELECT * FROM " . $strTabela . " ";
		//$strSqlCampoGenericoSelect .= "SELECT * FROM " . Funcoes::ConteudoMascaraGravacao01($strTabela) . " ";
		$strSqlCampoGenericoSelect .= "SELECT " . Funcoes::ConteudoMascaraGravacao01($nomeCampoRetorno) . " FROM " . Funcoes::ConteudoMascaraGravacao01($strTabela) . " ";
		//$strSqlCampoGenericoSelect .= "SELECT * FROM classificacao ";
		//$strSqlCampoGenericoSelect .= "SELECT * FROM :strTabela "; //Não funciona.
		//$strSqlCampoGenericoSelect .= "WHERE id <> 0 ";
		//$strSqlCampoGenericoSelect .= "AND id = :id ";
		//$strSqlCampoGenericoSelect .= "WHERE " . Funcoes::ConteudoMascaraGravacao01($nomeCampoReferencia) . " = :strValor ";
		//$strSqlCampoGenericoSelect .= "WHERE " . Funcoes::ConteudoMascaraGravacao01($nomeCampoRetorno) . " <> '' "; //Mudar futuramente.
		$strSqlCampoGenericoSelect .= "WHERE id <> 0 "; //Mudar futuramente.
		
		
		//Loop.
		for($countArray = 0; $countArray < count($arrParametrosPesquisa); ++$countArray)
		{
            $arrParametrosPesquisaInfo = explode(";", $arrParametrosPesquisa[$countArray]);
			
            $parametrosPesquisaNomeCampo = $arrParametrosPesquisaInfo[0];
            $parametrosPesquisaValorCampo = $arrParametrosPesquisaInfo[1];
            $parametrosPesquisaTipoCampo = $arrParametrosPesquisaInfo[2];
			
			
            //String.
			if($parametrosPesquisaTipoCampo == "s")
			{
                $strSqlCampoGenericoSelect .= "AND " . Funcoes::ConteudoMascaraGravacao01($parametrosPesquisaNomeCampo) . " = ? ";
			}
			if($parametrosPesquisaTipoCampo == "!s")
			{
                $strSqlCampoGenericoSelect .= "AND " . Funcoes::ConteudoMascaraGravacao01($parametrosPesquisaNomeCampo) . " <> ? ";
			}
            //Integer.
			if($parametrosPesquisaTipoCampo == "i")
			{
                //$strSqlTabelaGenericaSelect .= "AND " . Funcoes::ConteudoMascaraGravacao01($parametrosPesquisaNomeCampo) . " = :" . Funcoes::ConteudoMascaraGravacao01($parametrosPesquisaNomeCampo) . " ";//não funcionou
                $strSqlCampoGenericoSelect .= "AND " . Funcoes::ConteudoMascaraGravacao01($parametrosPesquisaNomeCampo) . " = ? ";
                //$strSqlTabelaGenericaSelect .= "AND @campo_" & Funcoes.ConteudoMascaraGravacao01(parametrosPesquisaNomeCampo) & " = @" & Funcoes.ConteudoMascaraGravacao01(parametrosPesquisaNomeCampo) & " ";
			}
			if($parametrosPesquisaTipoCampo == "!i")
			{
                //$strSqlTabelaGenericaSelect .= "AND " . Funcoes::ConteudoMascaraGravacao01($parametrosPesquisaNomeCampo) . " = :" . Funcoes::ConteudoMascaraGravacao01($parametrosPesquisaNomeCampo) . " ";//não funcionou
                $strSqlCampoGenericoSelect .= "AND " . Funcoes::ConteudoMascaraGravacao01($parametrosPesquisaNomeCampo) . " <> ? ";
                //$strSqlTabelaGenericaSelect .= "AND @campo_" & Funcoes.ConteudoMascaraGravacao01(parametrosPesquisaNomeCampo) & " = @" & Funcoes.ConteudoMascaraGravacao01(parametrosPesquisaNomeCampo) & " ";
			}

			//ids.
			if($parametrosPesquisaTipoCampo == "ids")
			{
				if($parametrosPesquisaValorCampo == "")
				{
					$parametrosPesquisaValorCampo = "0";
				}
                $strSqlCampoGenericoSelect .= "AND " . Funcoes::ConteudoMascaraGravacao01($parametrosPesquisaNomeCampo) . " IN (" . $parametrosPesquisaValorCampo . ") ";
			}
			
			//Date.
			if($parametrosPesquisaTipoCampo == "d")
			{
                $strSqlCampoGenericoSelect .= "AND DATE(" . Funcoes::ConteudoMascaraGravacao01($parametrosPesquisaNomeCampo) . ") = ? ";
			}

			//Data Inicial, Final.
			if($parametrosPesquisaTipoCampo == "dif")
			{
				/*
				$arrParametrosPesquisaInfoDatas = explode(",", $parametrosPesquisaValorCampo);
				$parametrosPesquisaDataInicial = $arrParametrosPesquisaInfoDatas[0];
				$parametrosPesquisaDataFinal = $arrParametrosPesquisaInfoDatas[1];
				*/
                
				$strSqlCampoGenericoSelect .= "AND " . Funcoes::ConteudoMascaraGravacao01($parametrosPesquisaNomeCampo) . " BETWEEN ? AND ? "; //funcionando
				//$strSqlCampoGenericoSelect .= "AND " . Funcoes::ConteudoMascaraGravacao01($parametrosPesquisaNomeCampo) . " BETWEEN DATE(?) AND DATE(?) "; //funcionando
				//$strSqlCampoGenericoSelect .= "AND " . Funcoes::ConteudoMascaraGravacao01($parametrosPesquisaNomeCampo) . " BETWEEN '?' AND '?' ";
				//$strSqlCampoGenericoSelect .= "AND " . Funcoes::ConteudoMascaraGravacao01($parametrosPesquisaNomeCampo) . " BETWEEN '2017-06-19' AND '2018-06-19' "; //debug
				//$strSqlCampoGenericoSelect .= "AND " . Funcoes::ConteudoMascaraGravacao01($parametrosPesquisaNomeCampo) . " BETWEEN '" . $parametrosPesquisaDataInicial . "' AND '" . $parametrosPesquisaDataFinal . "' "; //funcionando
			}
			
			//Like.
			if($parametrosPesquisaTipoCampo == "like")
			{
                //$strSqlCampoGenericoSelect .= "AND " . Funcoes::ConteudoMascaraGravacao01($parametrosPesquisaNomeCampo) . " LIKE '%?%' ";
                $strSqlCampoGenericoSelect .= "AND " . Funcoes::ConteudoMascaraGravacao01($parametrosPesquisaNomeCampo) . " LIKE CONCAT ('%', ?, '%') ";
			}
			

			//Verificação de erro - debug.
			//echo "parametrosPesquisaNomeCampo=" . $parametrosPesquisaNomeCampo . "<br>";
			//echo "parametrosPesquisaValorCampo=" . $parametrosPesquisaValorCampo . "<br>";
			//echo "parametrosPesquisaTipoCampo=" . $parametrosPesquisaTipoCampo . "<br>";
		} 
		
		if($strClassificacao <> "")
		{
			$strSqlCampoGenericoSelect .= "ORDER BY " . Funcoes::ConteudoMascaraGravacao01($strClassificacao);
		}
		//$strSqlCampoGenericoSelect .= "WHERE id_registro = 1200 ";
		//echo "strSqlCampoGenericoSelect=" . $strSqlCampoGenericoSelect . "<br />";
		//echo "strValorReferencia=" . $strValorReferencia . "<br />";
		//echo "strCampoComplementar1Valor=" . $strCampoComplementar1Valor . "<br />";
		//$strRetorno .= "strSqlCampoGenericoSelect=" . $strSqlCampoGenericoSelect;
		//----------
		
		
		//Inclusão de parâmetros.
		//----------
		//$statementCampoGenericoSelect = $GLOBALS['dbSistemaConPDO']->prepare($strSqlCampoGenericoSelect);
		//$statementCampoGenericoSelect = $GLOBALS['dbInternoConPDO']->prepare($strSqlCampoGenericoSelect);
		$statementCampoGenericoSelect = $GLOBALS['dbSistemaConPDO']->prepare($strSqlCampoGenericoSelect);

		if ($statementCampoGenericoSelect !== false)
		{
			//Loop.
			for($countArray = 0; $countArray < count($arrParametrosPesquisa); ++$countArray)
			{
				$arrParametrosPesquisaInfo = explode(";", $arrParametrosPesquisa[$countArray]);
				
				$parametrosPesquisaNomeCampo = $arrParametrosPesquisaInfo[0];
				$parametrosPesquisaValorCampo = $arrParametrosPesquisaInfo[1];
				$parametrosPesquisaTipoCampo = $arrParametrosPesquisaInfo[2];
				
				//String.
				if($parametrosPesquisaTipoCampo == "s")
				{
					//$statementTabelaGenericaSelect->bindParam(":" . $parametrosPesquisaNomeCampo, $parametrosPesquisaValorCampo, PDO::PARAM_STR);
					$statementCampoGenericoSelect->bindValue(($countArray + 1), $parametrosPesquisaValorCampo, PDO::PARAM_STR);
				}
				if($parametrosPesquisaTipoCampo == "!s")
				{
					//$statementTabelaGenericaSelect->bindParam(":" . $parametrosPesquisaNomeCampo, $parametrosPesquisaValorCampo, PDO::PARAM_STR);
					$statementCampoGenericoSelect->bindValue(($countArray + 1), $parametrosPesquisaValorCampo, PDO::PARAM_STR);
				}
				
				//Integer.
				if($parametrosPesquisaTipoCampo == "i")
				{
					//$statementTabelaGenericaSelect->bindParam(":" . $parametrosPesquisaNomeCampo, $parametrosPesquisaValorCampo, PDO::PARAM_INT); //Não funcionou.
					//$statementTabelaGenericaSelect->bindParam(':' . $parametrosPesquisaNomeCampo, $parametrosPesquisaValorCampo, PDO::PARAM_INT); //Não funcionou.
					$statementCampoGenericoSelect->bindValue(($countArray + 1), $parametrosPesquisaValorCampo, PDO::PARAM_INT);
				}
				if($parametrosPesquisaTipoCampo == "!i")
				{
					//$statementTabelaGenericaSelect->bindParam(":" . $parametrosPesquisaNomeCampo, $parametrosPesquisaValorCampo, PDO::PARAM_INT); //Não funcionou.
					//$statementTabelaGenericaSelect->bindParam(':' . $parametrosPesquisaNomeCampo, $parametrosPesquisaValorCampo, PDO::PARAM_INT); //Não funcionou.
					$statementCampoGenericoSelect->bindValue(($countArray + 1), $parametrosPesquisaValorCampo, PDO::PARAM_INT);
				}

				//Date.
				if($parametrosPesquisaTipoCampo == "d")
				{
					//$statementTabelaGenericaSelect->bindParam(":" . $parametrosPesquisaNomeCampo, $parametrosPesquisaValorCampo, PDO::PARAM_STR);
					$statementCampoGenericoSelect->bindValue(($countArray + 1), $parametrosPesquisaValorCampo, PDO::PARAM_STR);
				}

				//Data Inicial, Final.
				if($parametrosPesquisaTipoCampo == "dif")
				{
					$countLoop = $countLoop + 1;
					/**/
					$arrParametrosPesquisaInfoDatas = explode(",", $parametrosPesquisaValorCampo);
					$parametrosPesquisaDataInicial = $arrParametrosPesquisaInfoDatas[0];
					$parametrosPesquisaDataFinal = $arrParametrosPesquisaInfoDatas[1];
					
					$statementCampoGenericoSelect->bindValue(($countArray + 1), $parametrosPesquisaDataInicial, PDO::PARAM_STR); //obs: talvez unix, tenha que passar como PDO::PARAM_INT
					$countArray = $countArray + 1;
					$statementCampoGenericoSelect->bindValue(($countArray + 1), $parametrosPesquisaDataFinal, PDO::PARAM_STR); //obs: talvez unix, tenha que passar como PDO::PARAM_INT
				}
				
				
				//Like.
				if($parametrosPesquisaTipoCampo == "like")
				{
					$statementCampoGenericoSelect->bindValue(($countArray + 1), $parametrosPesquisaValorCampo, PDO::PARAM_STR);
				}
				
				//Verificação de erro - debug.
				//echo "parametrosPesquisaNomeCampo=" . $parametrosPesquisaNomeCampo . "<br>";
				//echo "parametrosPesquisaValorCampo=" . $parametrosPesquisaValorCampo . "<br>";
				//echo "parametrosPesquisaTipoCampo=" . $parametrosPesquisaTipoCampo . "<br>";
			} 
			

			//$statementTarefasSelect->bindParam(':palavraChave', $palavraChave, PDO::PARAM_STR);
			//$statementTarefasSelect->bindParam(':palavraChave', "%".$palavraChave."%", PDO::PARAM_STR);
			$statementCampoGenericoSelect->execute();

			/*
			$statementCampoGenericoSelect->execute(array(
				"strValor" => $strValorReferencia
			));
			*/
		}
		//----------


		//Resultado.
		//----------
		$resultadoCampoGenerico = $statementCampoGenericoSelect->fetchAll();
		
		if (empty($resultadoCampoGenerico))
		{
			//Nenhum resultado encontrado.
		}else{
			foreach($resultadoCampoGenerico as $linhaCampoGenerico)
			{
				if($linhaCampoGenerico[$nomeCampoRetorno] === null)
				//if($linhaCampoGenerico["criterio_classificacao"] === null)
				{
					$strRetorno = "";
				}else{
					//valores separados por vírgula e espaço (, )
					if($tipoRetorno == 1)
					{
						$strRetorno .= $linhaCampoGenerico[$nomeCampoRetorno] . ",";
					}
					//primeiro valor da pesquisa
					if($tipoRetorno == 2)
					{
						$strRetorno = $linhaCampoGenerico[$nomeCampoRetorno];
						//$strRetorno .= $linhaCampoGenerico["criterio_classificacao"];
					}
					if($tipoRetorno == 3)
					{
						//$strRetorno = $linhaCampoGenerico[$nomeCampoRetorno];
						//$strRetorno .= $linhaCampoGenerico["criterio_classificacao"];
						$idRegistroAtualRetorno = $arrParametrosEspeciais["idRegistroAtual"];
						
						//$idRegistroProximoRetorno = "";
						if($flagIdRegistroProximoRetornoArmazenar == 1)
						{
							$idRegistroProximoRetorno = $linhaCampoGenerico[$nomeCampoRetorno];
							$flagIdRegistroProximoRetornoArmazenar++;
						}
						if($linhaCampoGenerico[$nomeCampoRetorno] == $idRegistroAtualRetorno)
						{
							$flagIdRegistroProximoRetornoArmazenar++;
						}	
						
						//$idRegistroAnteriorRetorno = "";
						if($linhaCampoGenerico[$nomeCampoRetorno] == $idRegistroAtualRetorno)
						{
							$flagIdRegistroAnteriorRetornoArmazenar++;
						}
						if($flagIdRegistroAnteriorRetornoArmazenar == 0)
						{
							$idRegistroAnteriorRetorno = $linhaCampoGenerico[$nomeCampoRetorno];
						}
						
						
						//$idRegistroPrimeiroRetorno = "";
						if($idRegistroPrimeiroRetorno == "")
						{
							$idRegistroPrimeiroRetorno = $linhaCampoGenerico[$nomeCampoRetorno];
						}
						
						
						//$idRegistroUltimoRetorno = "";
						$idRegistroUltimoRetorno = $linhaCampoGenerico[$nomeCampoRetorno];
						
						
						//Contador.
						$idsRegistrosCount++;
						
						//Posição do registro atual.
						if($linhaCampoGenerico[$nomeCampoRetorno] == $idRegistroAtualRetorno)
						{
							$idRegistroAtualPosicao = $idsRegistrosCount;
						}
					}
				}
			}
		}
		//----------
		
		
		//array de ids (navegação independente)
		if($tipoRetorno == 3)
		{
			if($idRegistroProximoRetorno == "")
			{
				$idRegistroProximoRetorno = $idRegistroAtualRetorno;
			}
			if($idRegistroAnteriorRetorno == "")
			{
				$idRegistroAnteriorRetorno = $idRegistroAtualRetorno;
			}
			
			$strRetorno = array(
							"idRegistroAtualRetorno" => $idRegistroAtualRetorno,
							"idRegistroProximoRetorno" => $idRegistroProximoRetorno,
							"idRegistroAnteriorRetorno" => $idRegistroAnteriorRetorno,
							"idRegistroPrimeiroRetorno" => $idRegistroPrimeiroRetorno,
							"idRegistroUltimoRetorno" => $idRegistroUltimoRetorno,
							"idsRegistrosCount" => $idsRegistrosCount,
							"idRegistroAtualPosicao" => $idRegistroAtualPosicao,
						);
		}


		//Tratamento da variável para retirar a última vírgula.
		//----------
		if($tipoRetorno == 1)
		{
			if($strRetorno <> "")
			{
				$strRetorno = substr($strRetorno, -strlen($strRetorno), strlen($strRetorno)-1);
			}
		}
		//----------


		//Limpeza de objetos.
		//----------
		unset($strSqlCampoGenericoSelect);
		unset($statementCampoGenericoSelect);
		unset($resultadoCampoGenerico);
		unset($linhaCampoGenerico);
		//----------
		
		return $strRetorno;
	}
	//**************************************************************************************
	
	
	//Função para buscar termos em tabelas.
	//**************************************************************************************
	function BuscaGenerica01($strTabela, 
	$nomeCampoRetorno, 
	$strPalavraChave, 
	$arrCamposBusca, 
	$nomeCampoReferencia = "", 
	$strValorReferencia = "", 
	$strClassificacao = "", 
	$strNRegistros = "", 
	$tipoRetorno = 1,
	$strCampoComplementar1Referencia = "", 
	$strCampoComplementar1Valor = "", 
	$strCampoComplementar2Referencia = "", 
	$strCampoComplementar2Valor = "",
	$strCampoIdsReferencia = "", 
	$strCampoIdsValor = "")
	{
		//tipoRetorno: 1 - valores separados por vírgula e espaço (, ) | 2 - primeiro valor da pesquisa
		//Variáveis.
		//----------
		$strRetorno = "";
		//----------
	
	
		//Query de pesquisa.
		//----------
		$strSqlCampoGenericoSelect = "";
		//$strSqlCampoGenericoSelect .= "SELECT * FROM " . $strTabela . " ";
		$strSqlCampoGenericoSelect .= "SELECT " . Funcoes::ConteudoMascaraGravacao01($nomeCampoRetorno) . " FROM " . Funcoes::ConteudoMascaraGravacao01($strTabela) . " ";
		//$strSqlCampoGenericoSelect .= "SELECT * FROM classificacao ";
		//$strSqlCampoGenericoSelect .= "SELECT * FROM :strTabela "; //Não funciona.
		$strSqlCampoGenericoSelect .= "WHERE id <> 0 ";
		//$strSqlCampoGenericoSelect .= "AND id = :id ";
		//$strSqlCampoGenericoSelect .= "WHERE " . Funcoes::ConteudoMascaraGravacao01($nomeCampoReferencia) . " = :strValor ";
		
		if($strCampoComplementar1Referencia <> "")
		{
			$strSqlCampoGenericoSelect .= "AND " . Funcoes::ConteudoMascaraGravacao01($strCampoComplementar1Referencia) . " = :strCampoComplementar1Valor ";
		}
		
		if($strCampoComplementar2Referencia <> "")
		{
			$strSqlCampoGenericoSelect .= "AND " . Funcoes::ConteudoMascaraGravacao01($strCampoComplementar2Referencia) . " = :strCampoComplementar2Valor ";
		}
		
		if($strCampoIdsReferencia <> "" && $strCampoIdsValor <> "")
		{
			$strSqlCampoGenericoSelect .= "AND " . Funcoes::ConteudoMascaraGravacao01($strCampoIdsReferencia) . " IN(". Funcoes::ConteudoMascaraGravacao01($strCampoIdsValor) .") ";
		}
		
		//if($strTabela == "tb_cadastro")
		//{
			$strSqlCampoGenericoSelect .= "AND (id LIKE '%" . Funcoes::ConteudoMascaraGravacao01($strPalavraChave) . "%' ";
			
			//$strSqlCampoGenericoSelect .= "OR nome LIKE '%" . Funcoes::ConteudoMascaraGravacao01($strPalavraChave) . "%' ";
			//$strSqlCampoGenericoSelect .= "OR razao_social LIKE '%" . Funcoes::ConteudoMascaraGravacao01($strPalavraChave) . "%' ";
			//$strSqlCampoGenericoSelect .= "OR nome_fantasia LIKE '%" . Funcoes::ConteudoMascaraGravacao01($strPalavraChave) . "%' ";
			
			foreach ($arrCamposBusca as $arrCamposBuscaValue)
			{
				$strSqlCampoGenericoSelect .= "OR " . Funcoes::ConteudoMascaraGravacao01($arrCamposBuscaValue) . " LIKE '%" . Funcoes::ConteudoMascaraGravacao01($strPalavraChave) . "%' ";
			}		
			
			$strSqlCampoGenericoSelect .= "OR id LIKE '%" . Funcoes::ConteudoMascaraGravacao01($strPalavraChave) . "%' ";
			$strSqlCampoGenericoSelect .= ") ";
		//}
		
	
		//echo "strSqlCampoGenericoSelect=" . $strSqlCampoGenericoSelect . "<br />";
		//$strRetorno .= "strSqlCampoGenericoSelect=" . $strSqlCampoGenericoSelect;
		//----------
		
		
		//Inclusão de parâmetros.
		//----------
		$statementCampoGenericoSelect = $GLOBALS['dbSistemaConPDO']->prepare($strSqlCampoGenericoSelect);
		
		if ($statementCampoGenericoSelect !== false)
		{
			$statementCampoGenericoSelect->bindParam(':strValor', $strValorReferencia, PDO::PARAM_STR);
			
			if($strCampoComplementar1Referencia <> "")
			{
				$statementCampoGenericoSelect->bindParam(':strCampoComplementar1Valor', $strCampoComplementar1Valor, PDO::PARAM_STR);
			}
			
			if($strCampoComplementar2Referencia <> "")
			{
				$statementCampoGenericoSelect->bindParam(':strCampoComplementar2Valor', $strCampoComplementar2Valor, PDO::PARAM_STR);
			}
	
			//$statementTarefasSelect->bindParam(':palavraChave', $palavraChave, PDO::PARAM_STR);
			//$statementTarefasSelect->bindParam(':palavraChave', "%".$palavraChave."%", PDO::PARAM_STR);
			$statementCampoGenericoSelect->execute();
	
			/*
			$statementCampoGenericoSelect->execute(array(
				"strValor" => $strValorReferencia
			));
			*/
		}
		//----------
	
	
		//Resultado.
		//----------
		$resultadoCampoGenerico = $statementCampoGenericoSelect->fetchAll();
		
		if (empty($resultadoCampoGenerico))
		{
			//Nenhum resultado encontrado.
		}else{
			foreach($resultadoCampoGenerico as $linhaCampoGenerico)
			{
				if($linhaCampoGenerico[$nomeCampoRetorno] === null)
				//if($linhaCampoGenerico["criterio_classificacao"] === null)
				{
					$strRetorno = "";
				}else{
					if($tipoRetorno == 1)
					{
						$strRetorno .= $linhaCampoGenerico[$nomeCampoRetorno] . ",";
					}
					if($tipoRetorno == 2)
					{
						$strRetorno = $linhaCampoGenerico[$nomeCampoRetorno];
						//$strRetorno .= $linhaCampoGenerico["criterio_classificacao"];
					}
				}
			}
		}
		//----------
	
	
		//Tratamento da variável para retirar a última vírgula.
		//----------
		if($tipoRetorno == 1)
		{
			if($strRetorno <> "")
			{
				$strRetorno = substr($strRetorno, -strlen($strRetorno), strlen($strRetorno)-1);
			}
		}
		//----------
	
	
		//Limpeza de objetos.
		//----------
		unset($strSqlCampoGenericoSelect);
		unset($statementCampoGenericoSelect);
		unset($resultadoCampoGenerico);
		unset($linhaCampoGenerico);
		//----------
	
	
		return $strRetorno;
	}
	//**************************************************************************************

	
	//Função genérica para contar registros.
	//**************************************************************************************
	//Obs: revisar o sistema que está usando esta função, pois foi modificada para a de baixo e algumas funções pararam de funcionar, como paginação.
	function CountRegistrosGenericos_backup01($strTabela, 
	$nomeCampoReferencia, 
	$idReferencia)
	{
		$strRetorno = "";
		$countRegistros = 0;
		
		//Query de pesquisa.
		//----------
		$strSqlCountRegistrosGenericos = "";
		//$strSqlCountRegistrosGenericos .= "SELECT * FROM " . Funcoes::ConteudoMascaraGravacao01($strTabela) . " ";
		$strSqlCountRegistrosGenericos .= "SELECT count(*) FROM " . Funcoes::ConteudoMascaraGravacao01($strTabela) . " ";
		$strSqlCountRegistrosGenericos .= "WHERE id <> 0 ";
		$strSqlCountRegistrosGenericos .= "AND " . Funcoes::ConteudoMascaraGravacao01($nomeCampoReferencia) . " = :idReferencia ";
		//----------
		
		$statementCountRegistrosGenericos = $GLOBALS['dbSistemaConPDO']->prepare($strSqlCountRegistrosGenericos);
		
			$statementCountRegistrosGenericos->execute(array(
				"idReferencia" => $idReferencia
			));
			
		$countRegistros = $statementCountRegistrosGenericos ->fetch(PDO::FETCH_NUM);
			
		$strRetorno = $countRegistros[0];

		
		return $strRetorno;
	}
	//**************************************************************************************
	
	
	//Função genérica para contar registros.
	//**************************************************************************************
	function CountRegistrosGenericos($strTabela, 
	$nomeCampoReferencia, 
	$idReferencia, 
	$strCampoCriterio01Referencia = "", 
	$strCampoCriterio01Valor = "", 
	$strCampoCriterio02Referencia = "", 
	$strCampoCriterio02Valor = "", 
	$strCampoCriterio03Referencia = "", 
	$strCampoCriterio03Valor = "")
	{
		$strRetorno = "";
		$countRegistros = 0;
		
		//Query de pesquisa.
		//----------
		$strSqlCountRegistrosGenericos = "";
		//$strSqlCountRegistrosGenericos .= "SELECT * FROM " . Funcoes::ConteudoMascaraGravacao01($strTabela) . " ";
		$strSqlCountRegistrosGenericos .= "SELECT count(*) FROM " . Funcoes::ConteudoMascaraGravacao01($strTabela) . " ";
		$strSqlCountRegistrosGenericos .= "WHERE id <> 0 ";
		$strSqlCountRegistrosGenericos .= "AND " . Funcoes::ConteudoMascaraGravacao01($nomeCampoReferencia) . " = :idReferencia ";
		if($strCampoCriterio01Referencia <> "")
		{
			$strSqlCountRegistrosGenericos .= "AND " . Funcoes::ConteudoMascaraGravacao01($strCampoCriterio01Referencia) . " = :strCampoCriterio01Valor ";
		}else{
			$strSqlCountRegistrosGenericos .= "AND id <> :strCampoCriterio01Valor ";
		}
		if($strCampoCriterio02Referencia <> "")
		{
			$strSqlCountRegistrosGenericos .= "AND " . Funcoes::ConteudoMascaraGravacao01($strCampoCriterio02Referencia) . " = :strCampoCriterio02Valor ";
		}else{
			$strSqlCountRegistrosGenericos .= "AND id <> :strCampoCriterio02Valor ";
		}
		if($strCampoCriterio03Referencia <> "")
		{
			$strSqlCountRegistrosGenericos .= "AND " . Funcoes::ConteudoMascaraGravacao01($strCampoCriterio03Referencia) . " = :strCampoCriterio03Valor ";
		}else{
			$strSqlCountRegistrosGenericos .= "AND id <> :strCampoCriterio03Valor ";
		}
		//echo "strSqlCountRegistrosGenericos=" . $strSqlCountRegistrosGenericos . "<br />";
		//----------
		
		
		//Parâmetros.
		//----------
		//Obs: Modificar para aceitar valores vazios.
		$statementCountRegistrosGenericos = $GLOBALS['dbSistemaConPDO']->prepare($strSqlCountRegistrosGenericos);
		
			$statementCountRegistrosGenericos->execute(array(
				"idReferencia" => $idReferencia,
				"strCampoCriterio01Valor" => $strCampoCriterio01Valor,
				"strCampoCriterio02Valor" => $strCampoCriterio02Valor,
				"strCampoCriterio03Valor" => $strCampoCriterio03Valor
			));
		//----------


		$countRegistros = $statementCountRegistrosGenericos ->fetch(PDO::FETCH_NUM);
			
		$strRetorno = $countRegistros[0];

		
		return $strRetorno;
	}
	//**************************************************************************************
	
	
	//'Rotina para preenchimento de dados de tabela genérica utilizando array.
	//**************************************************************************************
	function CampoGenericoFill01($strTabela,
	$strClassificacao = "", 
	$strNRegistros = "", 
	$strCampoComplementar1Referencia = "", 
	$strCampoComplementar1Valor = "", 
	$strCampoComplementar2Referencia = "", 
	$strCampoComplementar2Valor = "",
	$strCampoComplementar3Referencia = "", 
	$strCampoComplementar3Valor = "",
	$nomeCampoRetorno1 = "", 
	$nomeCampoRetorno2 = "", 
	$nomeCampoRetorno3 = "")
	{
		//Definição de variáveis.
		$strRetorno = array();
		
		$coutArrayDimensao1 = 0;
		
		//Query de pesquisa.
		//----------
		$strSqlCampoGenericoFill = "";
		$strSqlCampoGenericoFill .= "SELECT ";
		//$strSqlCampoGenericoFill .= "id, id_parent "; //teste
		if($nomeCampoRetorno1 <> "")
		{
			$strSqlCampoGenericoFill .= "" . Funcoes::ConteudoMascaraGravacao01($nomeCampoRetorno1) . ", ";
		}
		
		if($nomeCampoRetorno2 <> "")
		{
			$strSqlCampoGenericoFill .= "" . Funcoes::ConteudoMascaraGravacao01($nomeCampoRetorno2) . ", ";
		}
		
		$strSqlCampoGenericoFill .= "id ";
		
		//$strSqlCampoGenericoFill .= "FROM " . $strTabela . " ";
		$strSqlCampoGenericoFill .= "FROM " . Funcoes::ConteudoMascaraGravacao01($strTabela) . " ";
		$strSqlCampoGenericoFill .= "WHERE id <> 0 ";
		
		if($strCampoComplementar1Referencia <> "")
		{
			$strSqlCampoGenericoFill .= "AND " . Funcoes::ConteudoMascaraGravacao01($strCampoComplementar1Referencia) . " = :strCampoComplementar1Valor ";
		}
		
		if($strCampoComplementar2Referencia <> "")
		{
			$strSqlCampoGenericoFill .= "AND " . Funcoes::ConteudoMascaraGravacao01($strCampoComplementar2Referencia) . " = :strCampoComplementar2Valor ";
		}
		
		if($strClassificacao <> "")
		{
			//$strSqlCampoGenericoFill .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
			$strSqlCampoGenericoFill .= "ORDER BY " . Funcoes::ConteudoMascaraGravacao01($strClassificacao) . " ";
		}
		//echo "strSqlCampoGenericoFill=" . $strSqlCampoGenericoFill . "<br />";
		//echo "strCampoComplementar1Valor=" . $strCampoComplementar1Valor . "<br />";
		//----------

		
		//Inclusão de parâmetros.
		//----------
		$statementCampoGenericoFill = $GLOBALS['dbSistemaConPDO']->prepare($strSqlCampoGenericoFill);
		
		if ($statementCampoGenericoFill !== false)
		{
			//echo "statementCampoGenericoFill=" . "true" . "<br />";
			//$statementCampoGenericoFill->bindParam(':idRegistro', $idRegistro, PDO::PARAM_STR);
			
			if($strCampoComplementar1Referencia <> "")
			{
				$statementCampoGenericoFill->bindParam(':strCampoComplementar1Valor', $strCampoComplementar1Valor, PDO::PARAM_STR);
			}
			
			if($strCampoComplementar2Referencia <> "")
			{
				$statementCampoGenericoFill->bindParam(':strCampoComplementar2Valor', $strCampoComplementar2Valor, PDO::PARAM_STR);
			}
			
			$statementCampoGenericoFill->execute();

		}else{
			//echo "statementCampoGenericoFill=" . "false" . "<br />";
		}
		//----------
		
		
		//$resultadoCampoGenericoFill = $dbSistemaConPDO->query($strSqlCampoGenericoFill);
		$resultadoCampoGenericoFill = $statementCampoGenericoFill->fetchAll();
		
		
		if (empty($resultadoCampoGenericoFill))
		{
			//Nenhum registro encontrado.
			//echo "resultadoCampoGenericoFill=" . "nenhum resultado" . "<br />";
		}else{
			//echo "resultadoCampoGenericoFill=" . $resultadoCampoGenericoFill . "<br />";
			//Loop pelos resultados.
			//$strRetorno(
			//$strRetorno[
				foreach($resultadoCampoGenericoFill as $linhaCampoGenericoFill)
				{
					//$strRetorno .= Funcoes::ConteudoMascaraLeitura($linhaCampoGenericoFill['complemento']);
					//"id" => $linhaCampoGenericoFill['id'],
					//"complemento" => Funcoes::ConteudoMascaraLeitura($linhaCampoGenericoFill['complemento']),
					$strRetorno[$coutArrayDimensao1][0] = $linhaCampoGenericoFill['id'];
					
					if($nomeCampoRetorno1 <> "")
					{
						$strRetorno[$coutArrayDimensao1][1] = Funcoes::ConteudoMascaraLeitura($linhaCampoGenericoFill[$nomeCampoRetorno1]);
					}
					if($nomeCampoRetorno2 <> "")
					{
						$strRetorno[$coutArrayDimensao1][2] = Funcoes::ConteudoMascaraLeitura($linhaCampoGenericoFill[$nomeCampoRetorno2]);
					}
					
					$coutArrayDimensao1 = $coutArrayDimensao1 + 1;
				}
			//];
			//);
		}
		
		//Limpeza de objetos.
		//----------
		unset($strSqlCampoGenericoFill);
		unset($statementCampoGenericoFill);
		unset($resultadoCampoGenericoFill);
		unset($linhaCampoGenericoFill);
		//----------

		//return $strRetorno[][];
		return $strRetorno;
	}
	//**************************************************************************************

	
	//'Rotina para tabelas complementares os filtros genéricos.
	//**************************************************************************************
	function FiltrosGenericosFill01($strTabela, $strTipoComplemento)
	{
		//Definição de variáveis.
		//$tipoComplemento = 1;
		//$strRetorno = "teste";
		$strRetorno = array();
		//$strRetorno[];
		//$strRetorno[][];
		//$strRetorno();
		
		$coutArrayDimensao1 = 0;
		
		//Query de pesquisa.
		//----------
		$strSqlCadastroTabelaComplementar = "";
		$strSqlCadastroTabelaComplementar .= "SELECT ";
		$strSqlCadastroTabelaComplementar .= "id, ";
		$strSqlCadastroTabelaComplementar .= "tipo_complemento, ";
		$strSqlCadastroTabelaComplementar .= "complemento, ";
		$strSqlCadastroTabelaComplementar .= "descricao ";
		//$strSqlCadastroTabelaComplementar .= "FROM " . $strTabela . " ";
		$strSqlCadastroTabelaComplementar .= "FROM " . Funcoes::ConteudoMascaraGravacao01($strTabela) . " ";
		$strSqlCadastroTabelaComplementar .= "WHERE id <> 0 ";
		$strSqlCadastroTabelaComplementar .= "AND tipo_complemento = :tipo_complemento ";
		//$strSqlCadastroTabelaComplementar .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
		$strSqlCadastroTabelaComplementar .= "ORDER BY complemento";
		
		$statementCadastroTabelaComplementar =  $GLOBALS['dbSistemaConPDO']->prepare($strSqlCadastroTabelaComplementar);
		//----------


		if ($statementCadastroTabelaComplementar !== false)
		{
			$statementCadastroTabelaComplementar->execute(array(
				"tipo_complemento" => $strTipoComplemento
			));
		}
		
		//$resultadoTabelaComplementar = $dbSistemaConPDO->query($strSqlCadastroTabelaComplementar);
		$resultadoTabelaComplementar = $statementCadastroTabelaComplementar->fetchAll();
		
		
		if (empty($resultadoTabelaComplementar))
		{
			//Nenhum registro encontrado.
		}else{
			//Loop pelos resultados.
			//$strRetorno(
			//$strRetorno[
				foreach($resultadoTabelaComplementar as $linhaTabelaComplementar)
				{
					//$strRetorno .= Funcoes::ConteudoMascaraLeitura($linhaTabelaComplementar['complemento']);
					//"id" => $linhaTabelaComplementar['id'],
					//"complemento" => Funcoes::ConteudoMascaraLeitura($linhaTabelaComplementar['complemento']),
					
					$strRetorno[$coutArrayDimensao1][0] = $linhaTabelaComplementar['id'];
					$strRetorno[$coutArrayDimensao1][1] = Funcoes::ConteudoMascaraLeitura($linhaTabelaComplementar['complemento']);
					
					$coutArrayDimensao1 = $coutArrayDimensao1 + 1;
				}
			//];
			//);
		}
		
		//Limpeza de objetos.
		//----------
		unset($strSqlCadastroTabelaComplementar);
		unset($statementCadastroTabelaComplementar);
		unset($resultadoTabelaComplementar);
		unset($linhaTabelaComplementar);
		//----------

		//return $strRetorno[][];
		return $strRetorno;
	}
	//**************************************************************************************
	
	
	//Rotina para selecionar os itens gravados (FetchAll - Filtros Genéricos).
	//**************************************************************************************
	function FiltrosGenericosSelect02_FetchAll($strTabela, 
												$idRegistro = "", 
												$strCampoReferencia = "", 
												$strCampoComplemento = "", 
												$strTipoComplemento = "")
	{
		$strReturn = "";
		
        //Query de pesquisa.
        //----------
        $strSqlFiltrosGenericosComplementoSelect = "";
        //$strSqlFiltrosGenericosComplementoSelect .= "SELECT ";
        $strSqlFiltrosGenericosComplementoSelect .= "SELECT * ";
        //$strSqlFiltrosGenericosComplementoSelect .= "id, ";
        //$strSqlFiltrosGenericosComplementoSelect .= "tipo_complemento, ";
        //$strSqlFiltrosGenericosComplementoSelect .= "complemento, ";
        //$strSqlFiltrosGenericosComplementoSelect .= "descricao ";
        $strSqlFiltrosGenericosComplementoSelect .= "FROM " . Funcoes::ConteudoMascaraGravacao01($strTabela) . " ";
        //$strSqlFiltrosGenericosComplementoSelect .= "WHERE id <> 0 ";
		if($strCampoReferencia <> "")
		{
			$strSqlFiltrosGenericosComplementoSelect .= "WHERE " . Funcoes::ConteudoMascaraGravacao01($strCampoReferencia) . " = :idRegistro ";
		}
        //$strSqlFiltrosGenericosComplementoSelect .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlFiltrosGenericosComplementoSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
        //$strSqlFiltrosGenericosComplementoSelect .= "ORDER BY complemento";
        
		
        //$statementFiltrosGenericosComplementoSelect = $dbSistemaConPDO->prepare($strSqlFiltrosGenericosComplementoSelect);
		$statementFiltrosGenericosComplementoSelect = $GLOBALS['dbSistemaConPDO']->prepare($strSqlFiltrosGenericosComplementoSelect);

        if ($statementFiltrosGenericosComplementoSelect !== false)
        {
			if($strCampoReferencia <> "")
			{
				$statementFiltrosGenericosComplementoSelect->bindParam(':idRegistro', $idRegistro, PDO::PARAM_STR);
			}
			$statementFiltrosGenericosComplementoSelect->execute();

			/*
            $statementFiltrosGenericosComplementoSelect->execute(array(
                "idRegistro" => $tipoComplemento
            ));
			*/
        }
        
        //$resultadoFiltrosGenericosComplemento = $statementFiltrosGenericosComplementoSelect->fetchAll();
        $strRetorno = $statementFiltrosGenericosComplementoSelect->fetchAll();
		
		
        //Limpeza de objetos.
        //----------
        unset($strSqlFiltrosGenericosComplementoSelect);
        unset($statementFiltrosGenericosComplementoSelect);
        //unset($resultadoFiltrosGenericosComplemento);
        //unset($linhaFiltrosGenericosComplemento);
        //----------
		
		return $strRetorno;
	}
	//**************************************************************************************

	
	//Rotina para selecionar os itens gravados (Filtros Genéricos).
	//**************************************************************************************
	function FiltrosGenericosSelect03($idRegistro, $strTabela, $strCampo, $strCampoComplemento, $strTipoComplemento, $strMarcador, $strSeparador, $tabelaComplemento, $tipoRetorno)
	{
		//$tipoRetorno: 1 - valores separados por vírgula.
		$strRetorno = "";
		
		
		//Query de pesquisa.
		//----------
		$strSqlTabelaComplementarSelect = "";
		$strSqlTabelaComplementarSelect .= "SELECT ";
		$strSqlTabelaComplementarSelect .= "* ";
		//$strSqlTabelaComplementarSelect .= "id_tb_cadastro, ";
		//$strSqlTabelaComplementarSelect .= "id_tb_cadastro_complemento, ";
		//$strSqlTabelaComplementarSelect .= "tipo_complemento ";
		//$strSqlTabelaComplementarSelect .= "FROM " . $strTabela . " ";
		$strSqlTabelaComplementarSelect .= "FROM " . Funcoes::ConteudoMascaraGravacao01($strTabela) . " ";
		//$strSqlTabelaComplementarSelect .= "WHERE id <> 0 ";
		//$strSqlTabelaComplementarSelect .= "WHERE :strCampo = :idRegistro ";
		$strSqlTabelaComplementarSelect .= "WHERE " . Funcoes::ConteudoMascaraGravacao01($strCampo) . " = :idRegistro ";
		//$strSqlTabelaComplementarSelect .= "WHERE " . Funcoes::ConteudoMascaraGravacao01($strCampo) . " = 3968 ";
		$strSqlTabelaComplementarSelect .= "AND tipo_complemento = :tipo_complemento ";
		//$strSqlTabelaComplementarSelect .= "AND tipo_complemento = 12 ";
		//$strSqlTabelaComplementarSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
		//$strSqlTabelaComplementarSelect .= "ORDER BY complemento";
		//echo "strSqlTabelaComplementarSelect=" . $strSqlTabelaComplementarSelect . "<br />";
		//----------
		
		
		//Adicionar parâmetros.
		//----------
		$statementTabelaComplementarSelect =  $GLOBALS['dbSistemaConPDO']->prepare($strSqlTabelaComplementarSelect);
		//echo "statementCadastroTabelaComplementar=" . ($statementTabelaComplementarSelect !== false) . "<br />";
	
		if ($statementTabelaComplementarSelect !== false)
		{
			$statementTabelaComplementarSelect->execute(array(
				"idRegistro" => $idRegistro,
				"tipo_complemento" => $strTipoComplemento
			));
		}else{
			//echo "erro no statement"  . "<br />";
		}
		//----------
	
	
		//Preenchimento dos dados.
		//----------
		//$resultadoTabelaComplementarSelect = $dbSistemaConPDO->query($strSqlTabelaComplementarSelect);
		$resultadoTabelaComplementarSelect = $statementTabelaComplementarSelect->fetchAll();
		
		//Debug.
		//echo "statementCadastroTabelaComplementar=" . $statementTabelaComplementarSelect . "<br />";
		//echo "resultadoTabelaComplementar=" . $resultadoTabelaComplementarSelect . "<br />";
		//echo "empty(resultadoTabelaComplementar)=" . empty($resultadoTabelaComplementarSelect) . "<br />";
		//echo "idRegistro=" . $idRegistro . "<br />";
		//echo "strTipoComplemento=" . $strTipoComplemento . "<br />";
		//echo "tipoRetorno=" . $tipoRetorno . "<br />";
		
		if (empty($resultadoTabelaComplementarSelect))
		{
			//Nenhum registro encontrado.
			//echo "resultadoTabelaComplementar vazio"  . "<br />";
		}else{
				foreach($resultadoTabelaComplementarSelect as $linhaTabelaComplementarSelect)
				{
					
					//$tipoRetorno = 1
					if($tipoRetorno == "1")
					{
						$strRetorno = $strRetorno . $strMarcador . $linhaTabelaComplementarSelect[$strCampoComplemento] . $strSeparador;
					}
					//echo "linhaTabelaComplementar = " . $linhaTabelaComplementarSelect[$strCampoComplemento] . "<br />";
					
				}
		}
		//----------
	
	
		//Limpeza de objetos.
		//----------
		unset($strSqlTabelaComplementarSelect);
		unset($statementTabelaComplementarSelect);
		unset($resultadoTabelaComplementarSelect);
		unset($linhaTabelaComplementarSelect);
		//----------
			
			
		//Eliminar o último separador.
		//if($strRetorno <> "")
		if(!empty($strRetorno))
		{
			$strRetorno = substr($strRetorno, 0, (strlen($strRetorno) - strlen($strSeparador)));
		}
	
	return $strRetorno;
	}
	//**************************************************************************************
	
	
    //Rotina para gravar o tipo de complemento.
    //**************************************************************************************
	function FiltrosGenericosGravar01($idRegistro, 
	$idComplemento, 
	$strTipoComplemento, 
	$strTabela, 
	$strNomeCampoIdRegistro, 
	$strNomeCampoIdComplemento)
	{
		$strRetorno = false;
		
		//Verificação de erro.
		/*
		echo "idRegistro=" . $idRegistro . "<br>";
		echo "idComplemento=" . $idComplemento . "<br>";
		echo "strTipoComplemento=" . $strTipoComplemento . "<br>";
		echo "strTabela=" . $strTabela . "<br>";
		echo "strNomeCampoIdRegistro=" . $strNomeCampoIdRegistro . "<br>";
		echo "strNomeCampoIdComplemento=" . $strNomeCampoIdComplemento . "<br>";
		*/
		
		//Inclusão de registro no BD.
		//----------
		$strSqlComplementoInsert = "";
		$strSqlComplementoInsert .= "INSERT INTO " . Funcoes::ConteudoMascaraGravacao01($strTabela) . " ";
		$strSqlComplementoInsert .= "SET ";
		$strSqlComplementoInsert .= "" . Funcoes::ConteudoMascaraGravacao01($strNomeCampoIdRegistro) . " = :idRegistro, ";
		$strSqlComplementoInsert .= "" . Funcoes::ConteudoMascaraGravacao01($strNomeCampoIdComplemento) . " = :idComplemento, ";
		$strSqlComplementoInsert .= "tipo_complemento = :tipo_complemento ";
		//echo "strSqlCategoriasInsert=" . $strSqlComplementoInsert . "<br>";

		
		$statementComplementoInsert = $GLOBALS['dbSistemaConPDO']->prepare($strSqlComplementoInsert);
		
		if ($statementComplementoInsert !== false)
		{
			$statementComplementoInsert->execute(array(
				"idRegistro" => $idRegistro,
				"idComplemento" => $idComplemento,
				"tipo_complemento" => $strTipoComplemento
			));
			
			//$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus2");
			$strRetorno = true;
		}else{
			//echo "erro";
			//$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus3");
		}
		
		//Limpeza de objetos.
		unset($strSqlComplementoInsert);
		unset($statementComplementoInsert);
		//----------
		
		return $strRetorno;
	}
    //**************************************************************************************
	
	
	//Função para preencher tabela genérica (FetchAll).
	//**************************************************************************************
	function TabelaGenericaFill01_FetchAll($strTabela, 
	$arrParametrosPesquisa, 
	$strClassificacao = "", 
	$strNRegistros = "")
	{
        //arrParametrosPesquisa: array("nomeCampoPesquisa1;valorCampoPesquisa1;tipoCampoPesquisa1", "nomeCampoPesquisa2;valorCampoPesquisa2;tipoCampoPesquisa2", "nomeCampoPesquisa3;valorCampoPesquisa3;tipoCampoPesquisa3")
        //ex: New String() {"id_tb_cadastro_cliente;31358;s", "tipo_movimento;0;s", "data_movimento;2018-01-22,2018-01-24;dif"}
        //tipoCampoPesquisa: s (string) | i (integer) | d (data) | dif (data inicial e data final) | ids (id IN)
        //dif (data inicial e data final) (data): dataInicial,dataFinal
        
		
		//Variáveis.
        //----------
		$strReturn = "";
		$strOperador = "";
        //----------


        //Query de pesquisa.
        //----------
        $strSqlTabelaGenericaSelect = "";
        $strSqlTabelaGenericaSelect .= "SELECT ";
        $strSqlTabelaGenericaSelect .= "* FROM " . Funcoes::ConteudoMascaraGravacao01($strTabela) . " ";
        //$strSqlTabelaGenericaSelect .= "WHERE id <> 0 ";
		
		//Loop.
		for($countArray = 0; $countArray < count($arrParametrosPesquisa); ++$countArray)
		{
            $arrParametrosPesquisaInfo = explode(";", $arrParametrosPesquisa[$countArray]);
			
            $parametrosPesquisaNomeCampo = $arrParametrosPesquisaInfo[0];
            $parametrosPesquisaValorCampo = $arrParametrosPesquisaInfo[1];
            $parametrosPesquisaTipoCampo = $arrParametrosPesquisaInfo[2];
			
			
			//Definição de operador.
			if($countArray == 0)
			{
				$strOperador = "WHERE";
			}else{
				$strOperador = "AND";
			}
			
			
            //String.
			if($parametrosPesquisaTipoCampo == "s")
			{
                //$strSqlTabelaGenericaSelect .= "AND " . Funcoes::ConteudoMascaraGravacao01($parametrosPesquisaNomeCampo) . " = ? ";//funcionando
                $strSqlTabelaGenericaSelect .= $strOperador . " " . Funcoes::ConteudoMascaraGravacao01($parametrosPesquisaNomeCampo) . " = ? ";
			}
			
            //Integer.
			if($parametrosPesquisaTipoCampo == "i")
			{
                //$strSqlTabelaGenericaSelect .= "AND " . Funcoes::ConteudoMascaraGravacao01($parametrosPesquisaNomeCampo) . " = :" . Funcoes::ConteudoMascaraGravacao01($parametrosPesquisaNomeCampo) . " ";//não funcionou
                //$strSqlTabelaGenericaSelect .= "AND " . Funcoes::ConteudoMascaraGravacao01($parametrosPesquisaNomeCampo) . " = ? ";//funcionando
                $strSqlTabelaGenericaSelect .= $strOperador . " " . Funcoes::ConteudoMascaraGravacao01($parametrosPesquisaNomeCampo) . " = ? ";
                //$strSqlTabelaGenericaSelect .= "AND @campo_" & Funcoes.ConteudoMascaraGravacao01(parametrosPesquisaNomeCampo) & " = @" & Funcoes.ConteudoMascaraGravacao01(parametrosPesquisaNomeCampo) & " ";
			}
			
			//ids.
			if($parametrosPesquisaTipoCampo == "ids")
			{
				if($parametrosPesquisaValorCampo == "")
				{
					$parametrosPesquisaValorCampo = "0";
				}
                //$strSqlTabelaGenericaSelect .= "AND " . Funcoes::ConteudoMascaraGravacao01($parametrosPesquisaNomeCampo) . " IN (" . $parametrosPesquisaValorCampo . ") ";//funcionando
                $strSqlTabelaGenericaSelect .= $strOperador . " " . Funcoes::ConteudoMascaraGravacao01($parametrosPesquisaNomeCampo) . " IN (" . $parametrosPesquisaValorCampo . ") ";
			}
			
			
			//Verificação de erro - debug.
			//echo "parametrosPesquisaNomeCampo=" . $parametrosPesquisaNomeCampo . "<br>";
			//echo "parametrosPesquisaValorCampo=" . $parametrosPesquisaValorCampo . "<br>";
			//echo "parametrosPesquisaTipoCampo=" . $parametrosPesquisaTipoCampo . "<br>";
		} 
		
		
        //$strSqlTabelaGenericaSelect .= "AND tipo_complemento = :tipo_complemento ";
		
        //$strSqlTabelaGenericaSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
        //$strSqlTabelaGenericaSelect .= "ORDER BY complemento";
		if($strClassificacao <> "")
		{
			$strSqlTabelaGenericaSelect .= "ORDER BY " . $strClassificacao;
		}
		//echo "strSqlTabelaGenericaSelect=" . $strSqlTabelaGenericaSelect . "<br>";
		//var_dump($arrParametrosPesquisa);
        //----------
		
		
		//Parâmetros.
        //----------
        //$statementTabelaGenericaSelect = $dbSistemaConPDO->prepare($strSqlTabelaGenericaSelect);
		$statementTabelaGenericaSelect = $GLOBALS['dbSistemaConPDO']->prepare($strSqlTabelaGenericaSelect);

        if ($statementTabelaGenericaSelect !== false)
        {
			//Loop.
			for($countArray = 0; $countArray < count($arrParametrosPesquisa); ++$countArray)
			{
				$arrParametrosPesquisaInfo = explode(";", $arrParametrosPesquisa[$countArray]);
				
				$parametrosPesquisaNomeCampo = $arrParametrosPesquisaInfo[0];
				$parametrosPesquisaValorCampo = $arrParametrosPesquisaInfo[1];
				$parametrosPesquisaTipoCampo = $arrParametrosPesquisaInfo[2];
				
				//String.
				if($parametrosPesquisaTipoCampo == "s")
				{
					//$statementTabelaGenericaSelect->bindParam(":" . $parametrosPesquisaNomeCampo, $parametrosPesquisaValorCampo, PDO::PARAM_STR);
					$statementTabelaGenericaSelect->bindValue(($countArray + 1), $parametrosPesquisaValorCampo, PDO::PARAM_STR);
				}
				//Integer.
				if($parametrosPesquisaTipoCampo == "i")
				{
					//$statementTabelaGenericaSelect->bindParam(":" . $parametrosPesquisaNomeCampo, $parametrosPesquisaValorCampo, PDO::PARAM_INT); //Não funcionou.
					//$statementTabelaGenericaSelect->bindParam(':' . $parametrosPesquisaNomeCampo, $parametrosPesquisaValorCampo, PDO::PARAM_INT); //Não funcionou.
					$statementTabelaGenericaSelect->bindValue(($countArray + 1), $parametrosPesquisaValorCampo, PDO::PARAM_INT);
				}
				
				
				//Verificação de erro - debug.
				//echo "parametrosPesquisaNomeCampo=" . $parametrosPesquisaNomeCampo . "<br>";
				//echo "parametrosPesquisaValorCampo=" . $parametrosPesquisaValorCampo . "<br>";
				//echo "parametrosPesquisaTipoCampo=" . $parametrosPesquisaTipoCampo . "<br>";
			} 
			
			//var_dump($statementTabelaGenericaSelect);
			$statementTabelaGenericaSelect->execute();

			/*
            $statementTabelaGenericaSelect->execute(array(
                "idRegistro" => $tipoComplemento
            ));
			*/
			
			
			//Verificação de erro - debug.
			//$statementTabelaGenericaSelect->debugDumpParams();
        }
        //----------


        //$resultadoTabelaGenerica = $statementTabelaGenericaSelect->fetchAll();
        $strRetorno = $statementTabelaGenericaSelect->fetchAll();
		
		
        //Limpeza de objetos.
        //----------
        unset($strSqlTabelaGenericaSelect);
        unset($statementTabelaGenericaSelect);
        //unset($resultadoTabelaGenerica);
        //unset($linhaTabelaGenerica);
        //----------
		
		return $strRetorno;
	}
	//**************************************************************************************
	
	
	//#Vínculos.
	
	//Função de inclusão de vínculos entre item e registro.
	//**************************************************************************************
	function ItensRelacaoRegistroInsert($idItem, $idRegistro, $tipoCategoria, $strTabela, $_tbItensRelacaoRegistrosValor = "")
	{
		//Variáveis.
		//----------
		$strRetorno = false;
		$idTbItensRelacaoRegistro = ContadorUniversal::ContadorUniversalUpdate(1);
		
		$tbItensRelacaoRegistrosValor = "";
		if($_tbItensRelacaoRegistrosValor <> "")
		{
			$tbItensRelacaoRegistrosValor = Funcoes::MascaraValorGravar($_tbItensRelacaoRegistrosValor);
		}
		$tbItensRelacaoRegistrosOBS = "";
		//----------
		
		
		//Verificação de erro.
		/*
		echo "idRegistro=" . $idRegistro . "<br>";
		echo "idItensRelacaoRegistro=" . $idItensRelacaoRegistro . "<br>";
		echo "strTipoItensRelacaoRegistro=" . $strTipoItensRelacaoRegistro . "<br>";
		echo "strTabela=" . $strTabela . "<br>";
		echo "strNomeCampoIdRegistro=" . $strNomeCampoIdRegistro . "<br>";
		echo "strNomeCampoIdItensRelacaoRegistro=" . $strNomeCampoIdItensRelacaoRegistro . "<br>";
		*/
		
		
		//Inclusão de registro no BD.
		//----------
		$strSqlItensRelacaoRegistroInsert = "";
		$strSqlItensRelacaoRegistroInsert .= "INSERT INTO tb_itens_relacao_registros ";
		$strSqlItensRelacaoRegistroInsert .= "SET ";
		$strSqlItensRelacaoRegistroInsert .= "id = :id, ";
		$strSqlItensRelacaoRegistroInsert .= "id_item = :id_item, ";
		$strSqlItensRelacaoRegistroInsert .= "id_registro = :id_registro, ";
		$strSqlItensRelacaoRegistroInsert .= "tipo_categoria = :tipo_categoria, ";
		$strSqlItensRelacaoRegistroInsert .= "tabela = :tabela, ";
		if($tbItensRelacaoRegistrosValor <> "")
		{
			$strSqlItensRelacaoRegistroInsert .= "valor = :valor, ";
		}
		$strSqlItensRelacaoRegistroInsert .= "obs = :obs ";
		//echo "strSqlCategoriasInsert=" . $strSqlItensRelacaoRegistroInsert . "<br>";
		//----------


		//Parâmetros.
		//----------
		$statementItensRelacaoRegistroInsert = $GLOBALS['dbSistemaConPDO']->prepare($strSqlItensRelacaoRegistroInsert);
		
		if ($statementItensRelacaoRegistroInsert !== false)
		{
			
			$statementItensRelacaoRegistroInsert->bindParam(':id', $idTbItensRelacaoRegistro, PDO::PARAM_INT);
			$statementItensRelacaoRegistroInsert->bindParam(':id_item', $idItem, PDO::PARAM_INT);
			$statementItensRelacaoRegistroInsert->bindParam(':id_registro', $idRegistro, PDO::PARAM_INT);
			$statementItensRelacaoRegistroInsert->bindParam(':tipo_categoria', $tipoCategoria, PDO::PARAM_INT);
			if($tbItensRelacaoRegistrosValor <> "")
			{
				$statementItensRelacaoRegistroInsert->bindParam(':valor', $tbItensRelacaoRegistrosValor, PDO::PARAM_INT);
			}
			$statementItensRelacaoRegistroInsert->bindParam(':tabela', $strTabela, PDO::PARAM_STR);
			$statementItensRelacaoRegistroInsert->bindParam(':obs', $tbItensRelacaoRegistrosOBS, PDO::PARAM_STR);
			$statementItensRelacaoRegistroInsert->execute();
			
			/*
			$statementItensRelacaoRegistroInsert->execute(array(
				"id" => $idTbItensRelacaoRegistro,
				"id_item" => $idItem,
				"id_registro" => $idRegistro,
				"tipo_categoria" => $tipoCategoria,
				"tabela" => $strTabela
			));
			*/
			//$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus2");
			$strRetorno = true;
		}else{
			//echo "erro";
			//$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus3");
		}
		//----------

		
		//Limpeza de objetos.
		//----------
		unset($strSqlItensRelacaoRegistroInsert);
		unset($statementItensRelacaoRegistroInsert);
		//----------
		
		
		return $strRetorno;
	}
	//**************************************************************************************
	
	
	//Função para resgatar texto da tabela conteúdo.
	//**************************************************************************************
	function ConteudoTexto($_idParentConteudo)
	{
		//Definição de algumas variáveis.
		//----------
		$strRetorno = "";
		//----------

		
		//Query de pesquisa.
		//----------
		$strSqlConteudoSelect = "";
		$strSqlConteudoSelect .= "SELECT ";
		$strSqlConteudoSelect .= "id, ";
		$strSqlConteudoSelect .= "n_classificacao, ";
		$strSqlConteudoSelect .= "id_tb_categorias, ";
		$strSqlConteudoSelect .= "id_tb_cadastro, ";
		$strSqlConteudoSelect .= "tipo_conteudo, ";
		$strSqlConteudoSelect .= "alinhamento_texto, ";
		$strSqlConteudoSelect .= "alinhamento_imagem, ";
		$strSqlConteudoSelect .= "conteudo, ";
		$strSqlConteudoSelect .= "conteudo_link, ";
		$strSqlConteudoSelect .= "arquivo, ";
		$strSqlConteudoSelect .= "config_arquivo, ";
		$strSqlConteudoSelect .= "dimensao_arquivo ";
		$strSqlConteudoSelect .= "FROM tb_conteudo ";
		$strSqlConteudoSelect .= "WHERE id <> 0 ";
		$strSqlConteudoSelect .= "AND id_tb_categorias = :id_tb_categorias ";
		$strSqlConteudoSelect .= "AND (tipo_conteudo = 1 ";//titulo
		$strSqlConteudoSelect .= "OR tipo_conteudo = 2 ";//subtítulo
		$strSqlConteudoSelect .= "OR tipo_conteudo = 3 ";//conteúdo
		$strSqlConteudoSelect .= "OR tipo_conteudo = 4 ";//tab
		$strSqlConteudoSelect .= "OR tipo_conteudo = 5) ";//imagem
		//if($ConfigClassificacaoConteudo <> "")
		//{
			//$strSqlConteudoSelect .= "ORDER BY " . $ConfigClassificacaoConteudo . " ";
		//}else{
			$strSqlConteudoSelect .= "ORDER BY " . $GLOBALS['configClassificacaoConteudo'] . " ";
		//}
		//----------
		
		
		//Inclusão de parâmetros.
		//----------
		$statementConteudoSelect = $GLOBALS['dbSistemaConPDO']->prepare($strSqlConteudoSelect);
		
		if ($statementConteudoSelect !== false)
		{
			$statementConteudoSelect->execute(array(
				"id_tb_categorias" => $_idParentConteudo
			));
		}
		//----------
		
		
		//$resultadoConteudo = $dbSistemaConPDO->query($strSqlConteudoSelect);
		$resultadoConteudo = $statementConteudoSelect->fetchAll();
	
		if (empty($resultadoConteudo))
		{
			//echo "Nenhum registro encontrado";
	
		}else{
	
			foreach($resultadoConteudo as $linhaConteudo)
			{
				//echo "id=" . $linhaConteudo['id'] . "<br />";
				$strRetorno .= Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);
			}
		}

		//Limpeza de objetos.
		unset($strSqlConteudoSelect);
		unset($statementConteudoSelect);
		unset($resultadoConteudo);
		unset($linhaConteudo);
		//----------
		
		return $strRetorno;
	}
	//**************************************************************************************
	
	
	//Log.
	
	//Função para gravar log de ítens enviados ou interatividade de ítens.
	//**************************************************************************************
	function ItensEnviadosGravar($_idTbCadastroRemetente, 
	$_idTbCadastroDestinatario, 
	$_idItem, 
	$_tipoInteratividade, 
	$_tipoCategoria = "", 
	$_strTabela = "", 
	$_nomeRemetente = "", 
	$_emailRemetente = "", 
	$_nomeDestinatario = "", 
	$_emailDestinatario = "", 
	$_strAssunto = "", 
	$_strMensagem = "", 
	$_strAssinatura = "", 
	$_strObs = "")
	{
			$strRetorno = false;
			$idTbItensEnviados = ContadorUniversal::ContadorUniversalUpdate(1);
			$dataEnvio = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");
			$countEnvio = 1;
		
			//Inclusão de registro no BD.
			//----------
			$strSqlItensEnviadosInsert = "";
			$strSqlItensEnviadosInsert .= "INSERT INTO tb_itens_enviados ";
			$strSqlItensEnviadosInsert .= "SET ";
			//$strSqlItensEnviadosInsert .= "id = :id ";
			$strSqlItensEnviadosInsert .= "id = :id, ";
			$strSqlItensEnviadosInsert .= "data_envio = :data_envio, ";
			$strSqlItensEnviadosInsert .= "id_tb_cadastro_remetente = :id_tb_cadastro_remetente, ";
			$strSqlItensEnviadosInsert .= "id_tb_cadastro_destinatario = :id_tb_cadastro_destinatario, ";
			$strSqlItensEnviadosInsert .= "id_item = :id_item, ";
			$strSqlItensEnviadosInsert .= "tipo_categoria = :tipo_categoria, ";
			$strSqlItensEnviadosInsert .= "tipo_interatividade = :tipo_interatividade, ";
			$strSqlItensEnviadosInsert .= "tabela = :tabela, ";
			$strSqlItensEnviadosInsert .= "nome_remetente = :nome_remetente, ";
			$strSqlItensEnviadosInsert .= "email_remetente = :email_remetente, ";
			$strSqlItensEnviadosInsert .= "nome_destinatario = :nome_destinatario, ";
			$strSqlItensEnviadosInsert .= "email_destinatario = :email_destinatario, ";
			$strSqlItensEnviadosInsert .= "assunto = :assunto, ";
			$strSqlItensEnviadosInsert .= "mensagem = :mensagem, ";
			$strSqlItensEnviadosInsert .= "assinatura = :assinatura, ";
			$strSqlItensEnviadosInsert .= "obs = :obs, ";
			$strSqlItensEnviadosInsert .= "count_envio = :count_envio ";
			//echo "strSqlCategoriasInsert=" . $strSqlItensEnviadosInsert . "<br>";
	
			
			$statementItensEnviadosInsert = $GLOBALS['dbSistemaConPDO']->prepare($strSqlItensEnviadosInsert);
			
			if ($statementItensEnviadosInsert !== false)
			{
				$statementItensEnviadosInsert->execute(array(
					"id" => $idTbItensEnviados,
					"data_envio" => $dataEnvio,
					"id_tb_cadastro_remetente" => $_idTbCadastroRemetente,
					"id_tb_cadastro_destinatario" => $_idTbCadastroDestinatario,
					"id_item" => $_idItem,
					"tipo_categoria" => $_tipoCategoria,
					"tipo_interatividade" => $_tipoInteratividade,
					"tabela" => $_strTabela,
					"nome_remetente" => Funcoes::ConteudoMascaraGravacao01($_nomeRemetente),
					"email_remetente" => $_emailRemetente,
					"nome_destinatario" => Funcoes::ConteudoMascaraGravacao01($_nomeDestinatario),
					"email_destinatario" => $_emailDestinatario,
					"assunto" => Funcoes::ConteudoMascaraGravacao01($_strAssunto),
					"mensagem" => Funcoes::ConteudoMascaraGravacao01($_strMensagem),
					"assinatura" => Funcoes::ConteudoMascaraGravacao01($_strAssinatura),
					"obs" => Funcoes::ConteudoMascaraGravacao01($_strObs),
					"count_envio" => $countEnvio
				));
				
				//$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus2");
				$strRetorno = true;
				//echo "gravou" . "<br>";
			}else{
				//echo "erro";
				//$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus3");
				//echo "não gravou" . "<br>";
			}
			
			//Verificação de erro.
			/*echo "idTbItensEnviados=" . $idTbItensEnviados . "<br>";
			echo "dataEnvio=" . $dataEnvio . "<br>";
			echo "_idTbCadastroRemetente=" . $_idTbCadastroRemetente . "<br>";
			echo "_idTbCadastroDestinatario=" . $_idTbCadastroDestinatario . "<br>";
			echo "_idItem=" . $_idItem . "<br>";
			echo "_tipoCategoria=" . $_tipoCategoria . "<br>";
			echo "_tipoInteratividade=" . $_tipoInteratividade . "<br>";
			echo "_strTabela=" . $_strTabela . "<br>";
			echo "_nomeRemetente=" . $_nomeRemetente . "<br>";
			echo "_emailRemetente=" . $_emailRemetente . "<br>";
			echo "_nomeDestinatario=" . $_nomeDestinatario . "<br>";
			echo "_emailDestinatario=" . $_emailDestinatario . "<br>";
			echo "_strAssunto=" . $_strAssunto . "<br>";
			echo "_strMensagem=" . $_strMensagem . "<br>";
			echo "_strAssinatura=" . $_strAssinatura . "<br>";
			echo "_strObs=" . $_strObs . "<br>";
			echo "countEnvio=" . $countEnvio . "<br>";*/
			
			
			//Limpeza de objetos.
			unset($strSqlItensEnviadosInsert);
			unset($statementItensEnviadosInsert);
			//----------
			
			return $strRetorno;
	}
	//**************************************************************************************


	//Função para verificar o log de respostas das enquetes.
	//**************************************************************************************
	function EnquetesLogVerificar($_idTbCadastro = "", 
	$strCampoRetorno = "count_resposta", 
	$_idTbEnquetes = "", 
	$_idTbEnquetesOpcoes = "", 
	$tipoRetorno = 1)
	{
		//tipoRetorno: 1 - retorna o campo de retorno | 2 - retorna a quantidade de votos da opção
		//Variáveis.
		//----------
		$strRetorno = "";
		$countRespostasTotal = 0;
		$strSqlEnquetesLogVerificarSelect = "";
		//----------


		//Query de pesquisa.
		//----------
		$strSqlEnquetesLogVerificarSelect .= "SELECT * FROM tb_enquetes_log ";
		//$strSqlEnquetesLogVerificarSelect .= "SELECT * FROM classificacao ";
		//$strSqlEnquetesLogVerificarSelect .= "SELECT * FROM :strTabela "; //Não funciona.
		//$strSqlEnquetesLogVerificarSelect .= "WHERE id <> 0 ";
		//$strSqlEnquetesLogVerificarSelect .= "AND id = :id ";
		$strSqlEnquetesLogVerificarSelect .= "WHERE id <> 0 ";
		
		if($_idTbCadastro <> "")
		{
			$strSqlEnquetesLogVerificarSelect .= "AND id_tb_cadastro = :id_tb_cadastro ";
		}
		
		if($_idTbEnquetes <> "")
		{
			$strSqlEnquetesLogVerificarSelect .= "AND id_tb_enquetes = :id_tb_enquetes ";
		}
		
		if($_idTbEnquetesOpcoes <> "")
		{
			$strSqlEnquetesLogVerificarSelect .= "AND id_tb_opcoes = :id_tb_opcoes ";
		}

		//echo "strSqlEnquetesLogVerificarSelect=" . $strSqlEnquetesLogVerificarSelect . "<br />";
		//echo "strValorReferencia=" . $strValorReferencia . "<br />";
		//echo "strCampoComplementar1Valor=" . $strCampoComplementar1Valor . "<br />";
		//$strRetorno .= "strSqlEnquetesLogVerificarSelect=" . $strSqlEnquetesLogVerificarSelect;
		//----------
		
		
		//Inclusão de parâmetros.
		//----------
		$statementEnquetesLogVerificarSelect = $GLOBALS['dbSistemaConPDO']->prepare($strSqlEnquetesLogVerificarSelect);
		
		if ($statementEnquetesLogVerificarSelect !== false)
		{
			
			if($_idTbCadastro <> "")
			{
				$statementEnquetesLogVerificarSelect->bindParam(':id_tb_cadastro', $_idTbCadastro, PDO::PARAM_STR);
			}
			
			if($_idTbEnquetes <> "")
			{
				$statementEnquetesLogVerificarSelect->bindParam(':id_tb_enquetes', $_idTbEnquetes, PDO::PARAM_STR);
			}
			
			if($_idTbEnquetesOpcoes <> "")
			{
				$statementEnquetesLogVerificarSelect->bindParam(':id_tb_opcoes', $_idTbEnquetesOpcoes, PDO::PARAM_STR);
			}

			//$statementTarefasSelect->bindParam(':palavraChave', $palavraChave, PDO::PARAM_STR);
			//$statementTarefasSelect->bindParam(':palavraChave', "%".$palavraChave."%", PDO::PARAM_STR);
			$statementEnquetesLogVerificarSelect->execute();

			/*
			$statementEnquetesLogVerificarSelect->execute(array(
				"strValor" => $strValorReferencia
			));
			*/
		}
		//----------


		//Resultado.
		//----------
		$resultadoEnquetesLogVerificar = $statementEnquetesLogVerificarSelect->fetchAll();
		
		if (empty($resultadoEnquetesLogVerificar))
		{
			//Nenhum resultado encontrado.
		}else{
			foreach($resultadoEnquetesLogVerificar as $linhaEnquetesLogVerificar)
			{
				
				if($tipoRetorno == 1)
				{
					$strRetorno .= $linhaEnquetesLogVerificar[$strCampoRetorno] . ",";
				}
				
				if($tipoRetorno == 2)
				{
					$countRespostasTotal = $countRespostasTotal + $linhaEnquetesLogVerificar["count_resposta"];
					$strRetorno = $countRespostasTotal;
				}

			}
		}
		//----------


		//Tratamento da variável para retirar a última vírgula.
		//----------
		/*
		if($tipoRetorno == 1)
		{
			if($strRetorno <> "")
			{
				$strRetorno = substr($strRetorno, -strlen($strRetorno), strlen($strRetorno)-1);
			}
		}
		*/
		//----------


		//Limpeza de objetos.
		//----------
		unset($strSqlEnquetesLogVerificarSelect);
		unset($statementEnquetesLogVerificarSelect);
		unset($resultadoEnquetesLogVerificar);
		unset($linhaEnquetesLogVerificar);
		//----------

		
		return $strRetorno;
	}
	//**************************************************************************************
}