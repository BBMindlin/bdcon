<?php
class Orcamentos
{
	//Função para  retornar valor total do orçamento.
	//**************************************************************************************
	function OrcamentoTotal($_idCeOrcamentos, $tipoRetorno)
	{
		//$tipoRetorno: 1 - valor total itens (referência produtos) | 2 - valor total orçamento - junto com frete (referência produtos) | 3 - valor total itens (valor gravado na tabela) | 4 - valor total orçamento - junto com frete (valor gravado na tabela) | 11 - total de itens
		
		//Criação de algumas variáveis.
		//----------
		$strRetorno = "";
		$orcamentosItensRelacaoRegistrosValorTotal = 0;
		$orcamentosItensRelacaoRegistrosQtdTotal = 0;
		
		$orcamentosRelacaoRegistrosValorTotal = 0;
		$orcamentosRelacaoRegistrosQtdTotal = 0;
		
		//$id = ContadorUniversal::ContadorUniversalUpdate(1);
		//$dataPedido = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");
		//----------
		
		
		//Itens selecionados.
		$idsTbOrcamentosItensSelecao1 = DbFuncoes::GetCampoGenerico06("ce_orcamentos_itens_relacao_registros", 
																	"id_ce_orcamentos_itens", 
																	"id_ce_orcamentos", 
																	$_idCeOrcamentos, 
																	"", 
																	"", 
																	1, 
																	"", 
																	"", 
																	"", 
																	"", 
																	"tipo_relacao", 
																	"1");
		if($idsTbOrcamentosItensSelecao1 == "")
		{
			$idsTbOrcamentosItensSelecao1 = "0";
		}
		
		
		//Verificação de erro - debug.
		//echo "idsTbOrcamentosItensSelecao1=" . $idsTbOrcamentosItensSelecao1 . "<br />";


		//Relacionamento com itens.
        //Query de pesquisa.
        //----------
        $strSqlOrcamentosItensSelect = "";
        $strSqlOrcamentosItensSelect .= "SELECT ";
        //$strSqlOrcamentosItensSelect .= "* ";
        $strSqlOrcamentosItensSelect .= "id, ";
        $strSqlOrcamentosItensSelect .= "id_ce_orcamentos, ";
        $strSqlOrcamentosItensSelect .= "n_classificacao, ";
        $strSqlOrcamentosItensSelect .= "item_titulo, ";
        $strSqlOrcamentosItensSelect .= "item_descricao, ";
        $strSqlOrcamentosItensSelect .= "data1, ";
        $strSqlOrcamentosItensSelect .= "data2, ";
        $strSqlOrcamentosItensSelect .= "data3, ";
        $strSqlOrcamentosItensSelect .= "data4, ";
        $strSqlOrcamentosItensSelect .= "data5, ";
        $strSqlOrcamentosItensSelect .= "url1, ";
        $strSqlOrcamentosItensSelect .= "url2, ";
        $strSqlOrcamentosItensSelect .= "url3, ";
        $strSqlOrcamentosItensSelect .= "id_tb_cadastro1, ";
        $strSqlOrcamentosItensSelect .= "id_tb_cadastro2, ";
        $strSqlOrcamentosItensSelect .= "id_tb_cadastro3, ";
        $strSqlOrcamentosItensSelect .= "valor, ";
        $strSqlOrcamentosItensSelect .= "valor1, ";
        $strSqlOrcamentosItensSelect .= "valor2, ";
        $strSqlOrcamentosItensSelect .= "ativacao, ";
        $strSqlOrcamentosItensSelect .= "ativacao1, ";
        $strSqlOrcamentosItensSelect .= "ativacao2, ";
        $strSqlOrcamentosItensSelect .= "ativacao3, ";
        $strSqlOrcamentosItensSelect .= "ativacao4, ";
        $strSqlOrcamentosItensSelect .= "arquivo1, ";
        $strSqlOrcamentosItensSelect .= "arquivo2, ";
        $strSqlOrcamentosItensSelect .= "arquivo3, ";
        $strSqlOrcamentosItensSelect .= "arquivo4, ";
        $strSqlOrcamentosItensSelect .= "arquivo5, ";
        $strSqlOrcamentosItensSelect .= "arquivo6, ";
        $strSqlOrcamentosItensSelect .= "arquivo7, ";
        $strSqlOrcamentosItensSelect .= "arquivo8, ";
        $strSqlOrcamentosItensSelect .= "arquivo9, ";
        $strSqlOrcamentosItensSelect .= "arquivo10, ";
        $strSqlOrcamentosItensSelect .= "informacao_complementar1, ";
        $strSqlOrcamentosItensSelect .= "informacao_complementar2, ";
        $strSqlOrcamentosItensSelect .= "informacao_complementar3, ";
        $strSqlOrcamentosItensSelect .= "informacao_complementar4, ";
        $strSqlOrcamentosItensSelect .= "informacao_complementar5, ";
        $strSqlOrcamentosItensSelect .= "informacao_complementar6, ";
        $strSqlOrcamentosItensSelect .= "informacao_complementar7, ";
        $strSqlOrcamentosItensSelect .= "informacao_complementar8, ";
        $strSqlOrcamentosItensSelect .= "informacao_complementar9, ";
        $strSqlOrcamentosItensSelect .= "informacao_complementar10 ";
        $strSqlOrcamentosItensSelect .= "FROM ce_orcamentos_itens ";
        $strSqlOrcamentosItensSelect .= "WHERE id <> 0 ";
        $strSqlOrcamentosItensSelect .= "AND id_ce_orcamentos = :id_ce_orcamentos ";
		
        $strSqlOrcamentosItensSelect .= "AND id IN (" . Funcoes::ConteudoMascaraGravacao01($idsTbOrcamentosItensSelecao1) . ") ";

        $strSqlOrcamentosItensSelect .= "ORDER BY " . $GLOBALS['configClassificacaoOrcamentosItens'] . " ";
        //----------


		//Componentes.
        //----------
        $statementOrcamentosItensSelect = $GLOBALS['dbSistemaConPDO']->prepare($strSqlOrcamentosItensSelect);
        
        if ($statementOrcamentosItensSelect !== false)
        {
            /*
            $statementOrcamentosItensSelect->execute(array(
                "id_ce_orcamentos" => $idCeOrcamentos
            ));
            */
			/*
			if($idCeOrcamentos <> "")
			{
				$statementOrcamentosItensSelect->bindParam(':id_ce_orcamentos', $idCeOrcamentos, PDO::PARAM_STR);
			}
			*/
            if($GLOBALS['configOrcamentosItens'] == 1)
			{
				$idCeOrcamentosPadrao = "0";
				$statementOrcamentosItensSelect->bindParam(':id_ce_orcamentos', $idCeOrcamentosPadrao, PDO::PARAM_STR);
            }
            $statementOrcamentosItensSelect->execute();
            
        }
        
        //$resultadoOrcamentosItens = $dbSistemaConPDO->query($strSqlOrcamentosItensSelect);
        $resultadoOrcamentosItens = $statementOrcamentosItensSelect->fetchAll();
        //----------

		
        if (empty($resultadoOrcamentosItens))
        {
            //echo "Nenhum registro encontrado";

        }else{
			//Loop pelos resultados.
			foreach($resultadoOrcamentosItens as $linhaOrcamentosItens)
			{
				//Query de pesquisa.
				//----------
				$strSqlOrcamentosItensRelacaoRegistrosSelect = "";
				$strSqlOrcamentosItensRelacaoRegistrosSelect .= "SELECT ";
				//$strSqlOrcamentosItensRelacaoRegistrosSelect .= "* ";
				$strSqlOrcamentosItensRelacaoRegistrosSelect .= "id, ";
				$strSqlOrcamentosItensRelacaoRegistrosSelect .= "data_atualizacao, ";
				$strSqlOrcamentosItensRelacaoRegistrosSelect .= "id_ce_orcamentos, ";
				$strSqlOrcamentosItensRelacaoRegistrosSelect .= "id_ce_orcamentos_itens, ";
				$strSqlOrcamentosItensRelacaoRegistrosSelect .= "id_registro, ";
				$strSqlOrcamentosItensRelacaoRegistrosSelect .= "tipo_registro, ";
				$strSqlOrcamentosItensRelacaoRegistrosSelect .= "tipo_categoria, ";
				$strSqlOrcamentosItensRelacaoRegistrosSelect .= "tipo_relacao, ";
				$strSqlOrcamentosItensRelacaoRegistrosSelect .= "tabela, ";
				$strSqlOrcamentosItensRelacaoRegistrosSelect .= "quantidade, ";
				$strSqlOrcamentosItensRelacaoRegistrosSelect .= "valor, ";
				$strSqlOrcamentosItensRelacaoRegistrosSelect .= "valor1, ";
				$strSqlOrcamentosItensRelacaoRegistrosSelect .= "valor2, ";
				$strSqlOrcamentosItensRelacaoRegistrosSelect .= "ativacao, ";
				$strSqlOrcamentosItensRelacaoRegistrosSelect .= "ativacao1, ";
				$strSqlOrcamentosItensRelacaoRegistrosSelect .= "ativacao2, ";
				$strSqlOrcamentosItensRelacaoRegistrosSelect .= "ativacao3, ";
				$strSqlOrcamentosItensRelacaoRegistrosSelect .= "ativacao4, ";
				$strSqlOrcamentosItensRelacaoRegistrosSelect .= "informacao_complementar1, ";
				$strSqlOrcamentosItensRelacaoRegistrosSelect .= "informacao_complementar2, ";
				$strSqlOrcamentosItensRelacaoRegistrosSelect .= "informacao_complementar3, ";
				$strSqlOrcamentosItensRelacaoRegistrosSelect .= "informacao_complementar4, ";
				$strSqlOrcamentosItensRelacaoRegistrosSelect .= "informacao_complementar5, ";
				$strSqlOrcamentosItensRelacaoRegistrosSelect .= "obs ";
				$strSqlOrcamentosItensRelacaoRegistrosSelect .= "FROM ce_orcamentos_itens_relacao_registros ";
				$strSqlOrcamentosItensRelacaoRegistrosSelect .= "WHERE id <> 0 ";
				$strSqlOrcamentosItensRelacaoRegistrosSelect .= "AND id_ce_orcamentos_itens = :id_ce_orcamentos_itens ";
				$strSqlOrcamentosItensRelacaoRegistrosSelect .= "AND id_ce_orcamentos = :id_ce_orcamentos ";
				//$strSqlOrcamentosItensRelacaoRegistrosSelect .= "ORDER BY " . $GLOBALS['configClassificacaoOrcamentosItens'] . " ";
				$strSqlOrcamentosItensRelacaoRegistrosSelect .= "ORDER BY id ";
				//----------


				//Componentes.
				//----------
				$statementOrcamentosItensRelacaoRegistrosSelect = $GLOBALS['dbSistemaConPDO']->prepare($strSqlOrcamentosItensRelacaoRegistrosSelect);
				
				if ($statementOrcamentosItensRelacaoRegistrosSelect !== false)
				{
					/*
					$statementOrcamentosItensSelect->execute(array(
						"id_ce_orcamentos" => $idCeOrcamentos
					));
					*/
					/*
					if($idCeOrcamentos <> "")
					{
						$statementOrcamentosItensSelect->bindParam(':id_ce_orcamentos', $idCeOrcamentos, PDO::PARAM_STR);
					}
					*/
					//if($GLOBALS['configOrcamentosItens'] == 1)
					//{
						$statementOrcamentosItensRelacaoRegistrosSelect->bindParam(':id_ce_orcamentos_itens', $linhaOrcamentosItens['id'], PDO::PARAM_STR);
					//}
					
					$statementOrcamentosItensRelacaoRegistrosSelect->bindParam(':id_ce_orcamentos', $_idCeOrcamentos, PDO::PARAM_STR);
					$statementOrcamentosItensRelacaoRegistrosSelect->execute();
					
				}
				
				//$resultadoOrcamentosItens = $dbSistemaConPDO->query($strSqlOrcamentosItensRelacaoRegistrosSelect);
				$resultadoOrcamentosItensRelacaoRegistros = $statementOrcamentosItensRelacaoRegistrosSelect->fetchAll();
				//----------


				if(empty($resultadoOrcamentosItensRelacaoRegistros))
				{
					//echo "Nenhum registro encontrado";
				}else{
					//Loop pelos resultados.
					foreach($resultadoOrcamentosItensRelacaoRegistros as $linhaOrcamentosItensRelacaoRegistros)
					{
						$tbProdutosValor = 0;
						$tbProdutosValor = DbFuncoes::GetCampoGenerico01($linhaOrcamentosItensRelacaoRegistros["id_registro"], "tb_produtos", "valor");
						
						//Valor total.
						if($GLOBALS['habilitarOrcamentosItensProdutosVinculosQuantidade'] == 1)
						{
							$orcamentosItensRelacaoRegistrosValorTotal = $orcamentosItensRelacaoRegistrosValorTotal + ($linhaOrcamentosItensRelacaoRegistros["quantidade"] * $tbProdutosValor);
						}else{
							$orcamentosItensRelacaoRegistrosValorTotal = $orcamentosItensRelacaoRegistrosValorTotal + $tbProdutosValor;
						}
						
						//Quantidade de itens.
						$orcamentosItensRelacaoRegistrosQtdTotal = $orcamentosItensRelacaoRegistrosQtdTotal + $linhaOrcamentosItensRelacaoRegistros["quantidade"];
					}
				}
				
				
				//Limpeza de objetos.
				//----------
				unset($strSqlOrcamentosItensRelacaoRegistrosSelect);
				unset($statementOrcamentosItensRelacaoRegistrosSelect);
				unset($resultadoOrcamentosItensRelacaoRegistros);
				unset($linhaOrcamentosItensRelacaoRegistros);
				//----------
			}
		}
		
		
        //Limpeza de objetos.
        //----------
        unset($strSqlOrcamentosItensSelect);
        unset($statementOrcamentosItensSelect);
        unset($resultadoOrcamentosItens);
        unset($linhaOrcamentosItens);
        //----------
		
		
		//Relacionamento com orçamento ou fichas.
		//Query de pesquisa.
		//----------
		$strSqlOrcamentosRelacaoRegistrosSelect = "";
		$strSqlOrcamentosRelacaoRegistrosSelect .= "SELECT ";
		//$strSqlOrcamentosRelacaoRegistrosSelect .= "* ";
		$strSqlOrcamentosRelacaoRegistrosSelect .= "id, ";
		$strSqlOrcamentosRelacaoRegistrosSelect .= "data_atualizacao, ";
		$strSqlOrcamentosRelacaoRegistrosSelect .= "id_ce_orcamentos, ";
		//$strSqlOrcamentosRelacaoRegistrosSelect .= "id_ce_orcamentos_itens, ";
		$strSqlOrcamentosRelacaoRegistrosSelect .= "id_registro, ";
		$strSqlOrcamentosRelacaoRegistrosSelect .= "tipo_registro, ";
		$strSqlOrcamentosRelacaoRegistrosSelect .= "tipo_categoria, ";
		$strSqlOrcamentosRelacaoRegistrosSelect .= "tipo_relacao, ";
		$strSqlOrcamentosRelacaoRegistrosSelect .= "tabela, ";
		$strSqlOrcamentosRelacaoRegistrosSelect .= "quantidade, ";
		$strSqlOrcamentosRelacaoRegistrosSelect .= "valor, ";
		$strSqlOrcamentosRelacaoRegistrosSelect .= "valor1, ";
		$strSqlOrcamentosRelacaoRegistrosSelect .= "valor2, ";
		$strSqlOrcamentosRelacaoRegistrosSelect .= "ativacao, ";
		$strSqlOrcamentosRelacaoRegistrosSelect .= "ativacao1, ";
		$strSqlOrcamentosRelacaoRegistrosSelect .= "ativacao2, ";
		$strSqlOrcamentosRelacaoRegistrosSelect .= "ativacao3, ";
		$strSqlOrcamentosRelacaoRegistrosSelect .= "ativacao4, ";
		$strSqlOrcamentosRelacaoRegistrosSelect .= "informacao_complementar1, ";
		$strSqlOrcamentosRelacaoRegistrosSelect .= "informacao_complementar2, ";
		$strSqlOrcamentosRelacaoRegistrosSelect .= "informacao_complementar3, ";
		$strSqlOrcamentosRelacaoRegistrosSelect .= "informacao_complementar4, ";
		$strSqlOrcamentosRelacaoRegistrosSelect .= "informacao_complementar5, ";
		$strSqlOrcamentosRelacaoRegistrosSelect .= "obs ";
		$strSqlOrcamentosRelacaoRegistrosSelect .= "FROM ce_orcamentos_relacao_registros ";
		$strSqlOrcamentosRelacaoRegistrosSelect .= "WHERE id <> 0 ";
		//$strSqlOrcamentosRelacaoRegistrosSelect .= "AND id_ce_orcamentos_itens = :id_ce_orcamentos_itens ";
		$strSqlOrcamentosRelacaoRegistrosSelect .= "AND id_ce_orcamentos = :id_ce_orcamentos ";
		$strSqlOrcamentosRelacaoRegistrosSelect .= "AND tipo_relacao = 1 ";
		//$strSqlOrcamentosRelacaoRegistrosSelect .= "ORDER BY " . $GLOBALS['configClassificacaoOrcamentosItens'] . " ";
		$strSqlOrcamentosRelacaoRegistrosSelect .= "ORDER BY id ";
		
		//$statementOrcamentosRelacaoRegistrosSelect = $dbSistemaConPDO->prepare($strSqlOrcamentosRelacaoRegistrosSelect);
		$statementOrcamentosRelacaoRegistrosSelect = $GLOBALS['dbSistemaConPDO']->prepare($strSqlOrcamentosRelacaoRegistrosSelect);

		if ($statementOrcamentosRelacaoRegistrosSelect !== false)
		{
			/*
			$statementOrcamentosItensSelect->execute(array(
				"id_ce_orcamentos" => $idCeOrcamentos
			));
			*/
			/*
			if($idCeOrcamentos <> "")
			{
				$statementOrcamentosItensSelect->bindParam(':id_ce_orcamentos', $idCeOrcamentos, PDO::PARAM_STR);
			}
			*/
			//if($GLOBALS['configOrcamentosItens'] == 1)
			//{
				//$statementOrcamentosRelacaoRegistrosSelect->bindParam(':id_ce_orcamentos_itens', $linhaOrcamentosItens['id'], PDO::PARAM_STR);
				//$statementOrcamentosRelacaoRegistrosSelect->bindParam(':id_ce_orcamentos_itens', $idCeOrcamentosItens, PDO::PARAM_STR);
			//}
			
			$statementOrcamentosRelacaoRegistrosSelect->bindParam(':id_ce_orcamentos', $_idCeOrcamentos, PDO::PARAM_STR);
			//$statementOrcamentosRelacaoRegistrosSelect->bindParam(':tipo_relacao', '1', PDO::PARAM_STR);
			$statementOrcamentosRelacaoRegistrosSelect->execute();
			
		}
		
		//$resultadoOrcamentosItens = $dbSistemaConPDO->query($strSqlOrcamentosRelacaoRegistrosSelect);
		$resultadoOrcamentosRelacaoRegistros = $statementOrcamentosRelacaoRegistrosSelect->fetchAll();

		if(empty($resultadoOrcamentosRelacaoRegistros))
		{
			//echo "Nenhum registro encontrado";
		}else{
			foreach($resultadoOrcamentosRelacaoRegistros as $linhaOrcamentosRelacaoRegistros)
			{
				$tbProdutosValor = 0;
				$tbProdutosValor = DbFuncoes::GetCampoGenerico01($linhaOrcamentosRelacaoRegistros["id_registro"], "tb_produtos", "valor");
				
				//Valor total.
				if($GLOBALS['habilitarOrcamentosProdutosVinculosQuantidade'] == 1)
				{
					$orcamentosRelacaoRegistrosValorTotal = $orcamentosRelacaoRegistrosValorTotal + ($linhaOrcamentosRelacaoRegistros["quantidade"] * $tbProdutosValor);
				}else{
					$orcamentosRelacaoRegistrosValorTotal = $orcamentosRelacaoRegistrosValorTotal + $tbProdutosValor;
				}
				
				//Quantidade de itens.
				$orcamentosRelacaoRegistrosQtdTotal = $orcamentosRelacaoRegistrosQtdTotal + $linhaOrcamentosRelacaoRegistros["quantidade"];
				
			}
		}
		
        //Limpeza de objetos.
        //----------
		unset($strSqlOrcamentosRelacaoRegistrosSelect);
		unset($statementOrcamentosRelacaoRegistrosSelect);
		unset($resultadoOrcamentosRelacaoRegistros);
		unset($linhaOrcamentosRelacaoRegistros);
        //----------

		
		//valor total itens (referência produtos)		
		if($tipoRetorno == 1)
		{
			$strRetorno = $orcamentosItensRelacaoRegistrosValorTotal + $orcamentosRelacaoRegistrosValorTotal;
		}	
		//valor total orçamento - junto com frete (referência produtos)
		if($tipoRetorno == 2)
		{
			$strRetorno = $orcamentosItensRelacaoRegistrosValorTotal + $orcamentosItensRelacaoRegistrosValorTotal + DbFuncoes::GetCampoGenerico01($_idCeOrcamentos, "ce_orcamentos", "valor_frete");
		}		
		
		return $strRetorno;
	}
	//**************************************************************************************
	
}