<?php
class Carrinho
{
	
	//Definição das operações.
	//**************************************************************************************
	function CarrinhoTemporario($idTbCadastroCliente, 
	$idTbCadastroUsuario, 
	$idItem, 
	$strTabela, 
	$strQuantidade, 
	$strObs, 
	$strOperacao, 
	$idTbItensValores = "", 
	$idTbItensValoresTitulo = "", 
	$idsOpcionais = "", 
	$idsOpcionaisDescricao = "")
	{
		
        //strOperacao: 1 - adicionar | -1 - subtrair | 0 - cancelar
        //strRetorno: 1 - item adicionado | 2 - item atualizado | 3 - item cancelado
		
		//Criação de algumas variáveis.
		//----------
		$strRetorno = "";
		//----------
		
		
		//Inclusão de registro no BD.
		//----------
		$strSqlCeItensTemporarioDetalhesSelect = "";
		//$strSqlCeItensTemporarioDetalhesSelect .= "SELECT * FROM ce_itens_temporario ";
        $strSqlCeItensTemporarioDetalhesSelect .= "SELECT ";
        //$strSqlCeItensTemporarioDetalhesSelect .= "* ";
        $strSqlCeItensTemporarioDetalhesSelect .= "id, ";
        $strSqlCeItensTemporarioDetalhesSelect .= "id_tb_cadastro_cliente, ";
        $strSqlCeItensTemporarioDetalhesSelect .= "id_tb_cadastro_usuario, ";
        $strSqlCeItensTemporarioDetalhesSelect .= "id_item, ";
        $strSqlCeItensTemporarioDetalhesSelect .= "data_selecao, ";
        $strSqlCeItensTemporarioDetalhesSelect .= "tabela, ";
        $strSqlCeItensTemporarioDetalhesSelect .= "quantidade, ";
        $strSqlCeItensTemporarioDetalhesSelect .= "valor_unitario, ";
        $strSqlCeItensTemporarioDetalhesSelect .= "id_tb_itens_valores, ";
        $strSqlCeItensTemporarioDetalhesSelect .= "id_tb_itens_valores_titulo, ";
        $strSqlCeItensTemporarioDetalhesSelect .= "id_tb_itens_data, ";
        $strSqlCeItensTemporarioDetalhesSelect .= "ids_opcionais, ";
        $strSqlCeItensTemporarioDetalhesSelect .= "ids_opcionais_descricao, ";
        $strSqlCeItensTemporarioDetalhesSelect .= "obs, ";
        
        $strSqlCeItensTemporarioDetalhesSelect .= "informacao_complementar1, ";
        $strSqlCeItensTemporarioDetalhesSelect .= "informacao_complementar2, ";
        $strSqlCeItensTemporarioDetalhesSelect .= "informacao_complementar3, ";
        $strSqlCeItensTemporarioDetalhesSelect .= "informacao_complementar4, ";
        $strSqlCeItensTemporarioDetalhesSelect .= "informacao_complementar5, ";

        $strSqlCeItensTemporarioDetalhesSelect .= "ativacao ";
        
        $strSqlCeItensTemporarioDetalhesSelect .= "FROM ce_itens_temporario ";
		$strSqlCeItensTemporarioDetalhesSelect .= "WHERE id <> 0 ";
		$strSqlCeItensTemporarioDetalhesSelect .= "AND id_item = :id_item ";
		$strSqlCeItensTemporarioDetalhesSelect .= "AND id_tb_cadastro_cliente = :id_tb_cadastro_cliente ";
		//$strSqlCeItensTemporarioDetalhesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoProdutos'];
		//echo "strSqlCategoriasInsert=" . $strSqlCeItensTemporarioDetalhesSelect . "<br>";
		//----------
		

		//Parâmetros.
		//----------
		$statementCeItensTemporarioDetalhesSelect = $GLOBALS['dbSistemaConPDO']->prepare($strSqlCeItensTemporarioDetalhesSelect);
		if($statementCeItensTemporarioDetalhesSelect !== false)
		{
			//if($idItem <> "")
			//{
				$statementCeItensTemporarioDetalhesSelect->bindParam(':id_item', $idItem, PDO::PARAM_STR);
			//}
			$statementCeItensTemporarioDetalhesSelect->bindParam(':id_tb_cadastro_cliente', $idTbCadastroCliente, PDO::PARAM_STR);
			$statementCeItensTemporarioDetalhesSelect->execute();
			/*
			$statementCeItensTemporarioDetalhesSelect->execute(array(
				"id" => $idTbItensRelacaoRegistro,
				"id_item" => $idItem,
			));
			*/
		}
			
		$resultadoCeItensTemporarioDetalhesSelect = $statementCeItensTemporarioDetalhesSelect->fetchAll();
		//----------
		
		
		//Método sem variação.
		//-------------
		if($GLOBALS['configCarrinhoManipulacaoItens'] == 1)
		{
			if($strOperacao == "1")
			{
				
				
				if(!empty($resultadoCeItensTemporarioDetalhesSelect))
				{
					
					foreach($resultadoCeItensTemporarioDetalhesSelect as $linhaCeItensTemporarioDetalhesSelect)
					{
						//Verificação de erro - debug.
						//echo "CarrinhoTemporario - id=" . $linhaCeItensTemporarioDetalhesSelect["id"] . "<br>";
						
						//Atualizar registro existente de seleção.
						if(Carrinho::CarrinhoTemporarioUpdate($linhaCeItensTemporarioDetalhesSelect["id"],
															$strQuantidade,
															$strObs) == true)
															{
																$strRetorno = "2";
															}
					}
					
				}else{
					//Vazio.
					
					//Criar novo registro.
					if(Carrinho::CarrinhoTemporarioInsert($idTbCadastroCliente,
														$idTbCadastroUsuario,
														$idItem,
														$strTabela,
														$strQuantidade,
														$strObs) == true)
														{
															$strRetorno = "1";
														}
				}
								
				//Verificação de erro - debug.
				//echo "strOperacao=" . $strOperacao . "<br>";
			}
		}
		//-------------


		//Cancelar.
		if($strOperacao == "0")
		{
			foreach($resultadoCeItensTemporarioDetalhesSelect as $linhaCeItensTemporarioDetalhesSelect)
			{
				DbExcluir::ExcluirRegistrosGenerico01($linhaCeItensTemporarioDetalhesSelect["id"], "ce_itens_temporario", "id");
			}
			
		}


		//Limpeza de objetos.
		//----------
		unset($resultadoCeItensTemporarioDetalhesSelect);
		unset($linhaCeItensTemporarioDetalhesSelect);
		unset($strSqlCeItensTemporarioDetalhesSelect);
		unset($statementCeItensTemporarioDetalhesSelect);
		//----------

		return $strRetorno;
	}
	//**************************************************************************************
	
	
	//Função para atualizar registro.
	//**************************************************************************************
	function CarrinhoTemporarioUpdate($idCeItensTemporario, 
	$srtQuantidade, 
	$strObs)
	{
		//Criação de algumas variáveis.
		//----------
		$strRetorno = false;
		/*
		$quantidadeAnterior = DbFuncoes::GetCampoGenerico06("ce_itens_temporario",
															"quantidade",
															"id",
															$idCeItensTemporario,
															"",
															"",
															2,
															"",
															"",
															"",
															"",
															"",
															"");
		*/
		$quantidadeAnterior = DbFuncoes::GetCampoGenerico01($idCeItensTemporario, "ce_itens_temporario", "quantidade");
		$quantidadeGravacao = 0;
		$ativacao = 1;
		//----------
		
		
		//Definição de quantidade.
		if($srtQuantidade == "1" || $srtQuantidade = "-1")
		{
			$quantidadeGravacao = $srtQuantidade + $quantidadeAnterior;
		}else{
			$quantidadeGravacao = $srtQuantidade;
		}
		
		
		//Verificação de erro.
		//echo "srtQuantidade=" . $srtQuantidade . "<br>";
		//echo "quantidadeAnterior=" . $quantidadeAnterior . "<br>";
		//echo "quantidadeGravacao=" . $quantidadeGravacao . "<br>";
		//echo "idCeItensTemporario=" . $idCeItensTemporario . "<br>";

		
		//Update de registro no BD.
		//----------
		$strSqlCeItensTemporarioUpdate = "";
		$strSqlCeItensTemporarioUpdate .= "UPDATE ce_itens_temporario ";
		$strSqlCeItensTemporarioUpdate .= "SET ";
		//$strSqlCeItensTemporarioUpdate .= "id = :id, ";
		//$strSqlCeItensTemporarioUpdate .= "id_item = :id_item, ";
		//$strSqlCeItensTemporarioUpdate .= "cod_item = :cod_item, ";
		//$strSqlCeItensTemporarioUpdate .= "descricao = :descricao, ";
		//$strSqlCeItensTemporarioUpdate .= "tabela = :tabela, ";
		$strSqlCeItensTemporarioUpdate .= "quantidade = :quantidade, ";
		//$strSqlCeItensTemporarioUpdate .= "valor_unitario = :valor_unitario, ";
		//$strSqlCeItensTemporarioUpdate .= "valor_total = :valor_total, ";
		//$strSqlCeItensTemporarioUpdate .= "obs = :obs, ";
		//$strSqlCeItensTemporarioUpdate .= "informacao_complementar1 = :informacao_complementar1, ";
		//$strSqlCeItensTemporarioUpdate .= "informacao_complementar2 = :informacao_complementar2, ";
		//$strSqlCeItensTemporarioUpdate .= "informacao_complementar3 = :informacao_complementar3, ";
		//$strSqlCeItensTemporarioUpdate .= "informacao_complementar4 = :informacao_complementar4, ";
		//$strSqlCeItensTemporarioUpdate .= "informacao_complementar5 = :informacao_complementar5, ";
		$strSqlCeItensTemporarioUpdate .= "ativacao = :ativacao ";
		$strSqlCeItensTemporarioUpdate .= "WHERE id = :id ";
		//echo "strSqlCategoriasUpdate = " . $strSqlCeItensTemporarioUpdate . "<br />";
		//----------
		
		
		//Componentes e parâmetros.
		//----------
		$statementCeItensTemporarioUpdate = $GLOBALS['dbSistemaConPDO']->prepare($strSqlCeItensTemporarioUpdate);
		
		
		/*
				"id_item" => $idItem,
				"cod_item" => $codItem,
				"descricao" => $descricao,
				"tabela" => $tabela,
				"obs" => $obs,
				"informacao_complementar1" => $informacaoComplementar1,
				"informacao_complementar2" => $informacaoComplementar2,
				"informacao_complementar3" => $informacaoComplementar3,
				"informacao_complementar4" => $informacaoComplementar4,
				"informacao_complementar5" => $informacaoComplementar5,

				"ativacao" => $ativacao
		*/
		if ($statementCeItensTemporarioUpdate !== false)
		{
			
			$statementCeItensTemporarioUpdate->bindParam(':id', $idCeItensTemporario, PDO::PARAM_STR);
			$statementCeItensTemporarioUpdate->bindParam(':quantidade', $quantidadeGravacao, PDO::PARAM_STR);
			//$statementCeItensTemporarioUpdate->bindParam(':ativacao', "1", PDO::PARAM_STR);
			$statementCeItensTemporarioUpdate->bindParam(':ativacao', $ativacao, PDO::PARAM_STR);
			$statementCeItensTemporarioUpdate->execute();
			
			/*
			$statementCeItensTemporarioUpdate->execute(array(
				"id" => $idCeItensTemporario,
				"quantidade" => $quantidade,
				"ativacao" => "1"
			));
			*/
			
			$strRetorno = true;
			$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus7");
		}else{
			//echo "erro";
			$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus8");
		}
		//----------
		
		
		//Limpeza de objetos.
		unset($strSqlCeItensTemporarioUpdate);
		unset($statementCeItensTemporarioUpdate);
		//----------


		return $strRetorno;
	}
	//**************************************************************************************
	

	//Função para retornar o nome amigável de entrega.
	//**************************************************************************************
	function CarrinhoTemporarioInsert($idTbCadastroCliente, 
	$idTbCadastroUsuario, 
	$idItem, 
	$srtTabela, 
	$srtQuantidade, 
	$strObs, 
	$idTbItensValores = "", 
	$idTbItensValoresTitulo = "", 
	$idsOpcionais = "", 
	$idsOpcionaisDescricao = "")
	{
		//Criação de algumas variáveis.
		//----------
		$strRetorno = false;
		$idContadorUniversal = ContadorUniversal::ContadorUniversalUpdate(1);
		$dataSelecao = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");
		$ativacao = 1;
		
		$informacaoComplementar1 = "";
		$informacaoComplementar2 = "";
		$informacaoComplementar3 = "";
		$informacaoComplementar4 = "";
		$informacaoComplementar5 = "";
		//----------
		
		
		//Inclusão de registro no BD.
		//----------
		$strSqlItensTemporarioInsert = "";
		$strSqlItensTemporarioInsert .= "INSERT INTO ce_itens_temporario ";
		$strSqlItensTemporarioInsert .= "SET ";
		$strSqlItensTemporarioInsert .= "id = :id, ";
		$strSqlItensTemporarioInsert .= "id_tb_cadastro_cliente = :id_tb_cadastro_cliente, ";
		$strSqlItensTemporarioInsert .= "id_tb_cadastro_usuario = :id_tb_cadastro_usuario, ";
		$strSqlItensTemporarioInsert .= "id_item = :id_item, ";
		$strSqlItensTemporarioInsert .= "data_selecao = :data_selecao, ";
		$strSqlItensTemporarioInsert .= "tabela = :tabela, ";
		$strSqlItensTemporarioInsert .= "quantidade = :quantidade, ";
		
		if($GLOBALS['habilitarItensValoresProdutos'] == 1)
		{
			$strSqlItensTemporarioInsert .= "id_tb_itens_valores = :id_tb_itens_valores, ";
			$strSqlItensTemporarioInsert .= "id_tb_itens_valores_titulo = :id_tb_itens_valores_titulo, ";
			$strSqlItensTemporarioInsert .= "id_tb_itens_data = :id_tb_itens_data, ";
		}
		
		if($GLOBALS['habilitarProdutosOpcoes'] == 1)
		{
			$strSqlItensTemporarioInsert .= "ids_opcionais = :ids_opcionais, ";
			$strSqlItensTemporarioInsert .= "ids_opcionais_descricao = :ids_opcionais_descricao, ";
		}
		
		$strSqlItensTemporarioInsert .= "obs = :obs, ";
		$strSqlItensTemporarioInsert .= "informacao_complementar1 = :informacao_complementar1, ";
		$strSqlItensTemporarioInsert .= "informacao_complementar2 = :informacao_complementar2, ";
		$strSqlItensTemporarioInsert .= "informacao_complementar3 = :informacao_complementar3, ";
		$strSqlItensTemporarioInsert .= "informacao_complementar4 = :informacao_complementar4, ";
		$strSqlItensTemporarioInsert .= "informacao_complementar5 = :informacao_complementar5, ";
		$strSqlItensTemporarioInsert .= "ativacao = :ativacao ";
		//$strSqlItensTemporarioInsert .= "ativacao = 1 ";
		//echo "strSqlItensTemporarioInsert=" . $strSqlItensTemporarioInsert . "<br>";
		//----------

		
		//Parâmetros.
		//----------
		$statementItensTemporarioInsert = $GLOBALS['dbSistemaConPDO']->prepare($strSqlItensTemporarioInsert);
		
		if ($statementItensTemporarioInsert !== false)
		{
			$statementItensTemporarioInsert->bindParam(':id', $idContadorUniversal, PDO::PARAM_STR);
			$statementItensTemporarioInsert->bindParam(':id_tb_cadastro_cliente', $idTbCadastroCliente, PDO::PARAM_STR);
			$statementItensTemporarioInsert->bindParam(':id_tb_cadastro_usuario', $idTbCadastroUsuario, PDO::PARAM_STR);
			$statementItensTemporarioInsert->bindParam(':id_item', $idItem, PDO::PARAM_STR);
			$statementItensTemporarioInsert->bindParam(':data_selecao', $dataSelecao, PDO::PARAM_STR);
			$statementItensTemporarioInsert->bindParam(':tabela', $srtTabela, PDO::PARAM_STR);
			$statementItensTemporarioInsert->bindParam(':quantidade', $srtQuantidade, PDO::PARAM_STR);
			
			if($GLOBALS['habilitarItensValoresProdutos'] == 1)
			{
				$statementItensTemporarioInsert->bindParam(':id_tb_itens_valores', $idTbItensValores, PDO::PARAM_STR);
				$statementItensTemporarioInsert->bindParam(':id_tb_itens_valores_titulo', $idTbItensValoresTitulo, PDO::PARAM_STR);
				$statementItensTemporarioInsert->bindParam(':id_tb_itens_data', $dataSelecao, PDO::PARAM_STR);
			}
			
			if($GLOBALS['habilitarProdutosOpcoes'] == 1)
			{
				$statementItensTemporarioInsert->bindParam(':ids_opcionais', $idsOpcionais, PDO::PARAM_STR);
				$statementItensTemporarioInsert->bindParam(':ids_opcionais_descricao', $idsOpcionaisDescricao, PDO::PARAM_STR);
			}
			
			$statementItensTemporarioInsert->bindParam(':obs', $strObs, PDO::PARAM_STR);
			$statementItensTemporarioInsert->bindParam(':informacao_complementar1', $informacaoComplementar1, PDO::PARAM_STR);
			$statementItensTemporarioInsert->bindParam(':informacao_complementar2', $informacaoComplementar2, PDO::PARAM_STR);
			$statementItensTemporarioInsert->bindParam(':informacao_complementar3', $informacaoComplementar3, PDO::PARAM_STR);
			$statementItensTemporarioInsert->bindParam(':informacao_complementar4', $informacaoComplementar4, PDO::PARAM_STR);
			$statementItensTemporarioInsert->bindParam(':informacao_complementar5', $informacaoComplementar5, PDO::PARAM_STR);
			$statementItensTemporarioInsert->bindParam(':ativacao', $ativacao, PDO::PARAM_STR); //Só funcionou com variável.
			$statementItensTemporarioInsert->execute();

			
			//$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus2");
			$strRetorno = true;
			//echo "gravou" . "<br>";
		}else{
			//echo "erro";
			//$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus3");
			//echo "não gravou" . "<br>";
		}
		
		//Verificação de erro.
		/*echo "id=" . $id . "<br>";
		echo "idCePedidos=" . $idCePedidos . "<br>";
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
		//----------
		unset($strSqlItensTemporarioInsert);
		unset($statementItensTemporarioInsert);
		//----------
		

		return $strRetorno;
	}
	//**************************************************************************************	
	
	
	//Rotina para duplicar itens na tabela temporária, após fazer login.
	//**************************************************************************************
	function CarrinhoTemporarioDuplicar($idTbCadastroTemporario, $idTbCadastroLogin)
	{
		
		//Criação de algumas variáveis.
		//----------
		$strRetorno = false;
		//----------

		
		//Inclusão de registro no BD.
		//----------
		$strSqlCeItensTemporarioDetalhesSelect = "";
		//$strSqlCeItensTemporarioDetalhesSelect .= "SELECT * FROM ce_itens_temporario ";
        $strSqlCeItensTemporarioDetalhesSelect .= "SELECT ";
        //$strSqlCeItensTemporarioDetalhesSelect .= "* ";
        $strSqlCeItensTemporarioDetalhesSelect .= "id, ";
        $strSqlCeItensTemporarioDetalhesSelect .= "id_tb_cadastro_cliente, ";
        $strSqlCeItensTemporarioDetalhesSelect .= "id_tb_cadastro_usuario, ";
        $strSqlCeItensTemporarioDetalhesSelect .= "id_item, ";
        $strSqlCeItensTemporarioDetalhesSelect .= "data_selecao, ";
        $strSqlCeItensTemporarioDetalhesSelect .= "tabela, ";
        $strSqlCeItensTemporarioDetalhesSelect .= "quantidade, ";
        $strSqlCeItensTemporarioDetalhesSelect .= "valor_unitario, ";
        $strSqlCeItensTemporarioDetalhesSelect .= "id_tb_itens_valores, ";
        $strSqlCeItensTemporarioDetalhesSelect .= "id_tb_itens_valores_titulo, ";
        $strSqlCeItensTemporarioDetalhesSelect .= "id_tb_itens_data, ";
        $strSqlCeItensTemporarioDetalhesSelect .= "ids_opcionais, ";
        $strSqlCeItensTemporarioDetalhesSelect .= "ids_opcionais_descricao, ";
        $strSqlCeItensTemporarioDetalhesSelect .= "obs, ";
        
        $strSqlCeItensTemporarioDetalhesSelect .= "informacao_complementar1, ";
        $strSqlCeItensTemporarioDetalhesSelect .= "informacao_complementar2, ";
        $strSqlCeItensTemporarioDetalhesSelect .= "informacao_complementar3, ";
        $strSqlCeItensTemporarioDetalhesSelect .= "informacao_complementar4, ";
        $strSqlCeItensTemporarioDetalhesSelect .= "informacao_complementar5, ";

        $strSqlCeItensTemporarioDetalhesSelect .= "ativacao ";
        
        $strSqlCeItensTemporarioDetalhesSelect .= "FROM ce_itens_temporario ";
		$strSqlCeItensTemporarioDetalhesSelect .= "WHERE id <> 0 ";
		//$strSqlCeItensTemporarioDetalhesSelect .= "AND id_item = :id_item ";
		$strSqlCeItensTemporarioDetalhesSelect .= "AND id_tb_cadastro_cliente = :id_tb_cadastro_cliente ";
		//$strSqlCeItensTemporarioDetalhesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoProdutos'];
		//echo "strSqlCategoriasInsert=" . $strSqlCeItensTemporarioDetalhesSelect . "<br>";
		//----------
		

		//Parâmetros.
		//----------
		$statementCeItensTemporarioDetalhesSelect = $GLOBALS['dbSistemaConPDO']->prepare($strSqlCeItensTemporarioDetalhesSelect);
		if($statementCeItensTemporarioDetalhesSelect !== false)
		{
			//if($idItem <> "")
			//{
				//$statementCeItensTemporarioDetalhesSelect->bindParam(':id_item', $idItem, PDO::PARAM_STR);
			//}
			$statementCeItensTemporarioDetalhesSelect->bindParam(':id_tb_cadastro_cliente', $idTbCadastroTemporario, PDO::PARAM_STR);
			$statementCeItensTemporarioDetalhesSelect->execute();
			/*
			$statementCeItensTemporarioDetalhesSelect->execute(array(
				"id" => $idTbItensRelacaoRegistro,
				"id_item" => $idItem,
			));
			*/
		}
			
		$resultadoCeItensTemporarioDetalhesSelect = $statementCeItensTemporarioDetalhesSelect->fetchAll();
		//----------
		
		
		//Loop pelos resultados.
		//-------------
		foreach($resultadoCeItensTemporarioDetalhesSelect as $linhaCeItensTemporarioDetalhesSelect)
		{
			if(Carrinho::CarrinhoTemporarioInsert($idTbCadastroLogin,
												$linhaCeItensTemporarioDetalhesSelect["id_tb_cadastro_usuario"],
												$linhaCeItensTemporarioDetalhesSelect["id_item"],
												$linhaCeItensTemporarioDetalhesSelect["tabela"],
												$linhaCeItensTemporarioDetalhesSelect["quantidade"],
												$linhaCeItensTemporarioDetalhesSelect["obs"]) == true)
												{
													$strRetorno = true;
												}
		}
		//-------------
		

		//Limpeza de objetos.
		//----------
		unset($resultadoCeItensTemporarioDetalhesSelect);
		unset($linhaCeItensTemporarioDetalhesSelect);
		unset($strSqlCeItensTemporarioDetalhesSelect);
		unset($statementCeItensTemporarioDetalhesSelect);
		//----------
		
		
		return $strRetorno;
	}
	//**************************************************************************************	
	
	
	//Função para retornar o nome amigável de entrega.
	//**************************************************************************************
	function CarrinhoItensTotal($idTbCadastroCliente, 
	$idCePedidos, 
	$tabelaPesquisa, 
	$idItem, 
	$nomeTabelaReferencia, 
	$nomeCampoReferencia, 
	$nomeCamporReferenciaValor, 
	$strAtivacao)
	{
		//Criação de algumas variáveis.
		//----------
		$strRetorno = 0;
		//----------
		
		
        //Query de pesquisa.
        //----------
        $strSqlCeItensTotalSelect = "";
        $strSqlCeItensTotalSelect .= "SELECT ";
        //$strSqlCeItensTotalSelect .= "* ";
        $strSqlCeItensTotalSelect .= "id, ";
        $strSqlCeItensTotalSelect .= "id_tb_cadastro_cliente, ";
        $strSqlCeItensTotalSelect .= "id_tb_cadastro_usuario, ";
        $strSqlCeItensTotalSelect .= "id_item, ";
        $strSqlCeItensTotalSelect .= "data_selecao, ";
        $strSqlCeItensTotalSelect .= "tabela, ";
        $strSqlCeItensTotalSelect .= "quantidade, ";
        $strSqlCeItensTotalSelect .= "valor_unitario, ";
        $strSqlCeItensTotalSelect .= "id_tb_itens_valores, ";
        $strSqlCeItensTotalSelect .= "id_tb_itens_valores_titulo, ";
        $strSqlCeItensTotalSelect .= "id_tb_itens_data, ";
        $strSqlCeItensTotalSelect .= "ids_opcionais, ";
        $strSqlCeItensTotalSelect .= "ids_opcionais_descricao, ";
        $strSqlCeItensTotalSelect .= "obs, ";
        
        $strSqlCeItensTotalSelect .= "informacao_complementar1, ";
        $strSqlCeItensTotalSelect .= "informacao_complementar2, ";
        $strSqlCeItensTotalSelect .= "informacao_complementar3, ";
        $strSqlCeItensTotalSelect .= "informacao_complementar4, ";
        $strSqlCeItensTotalSelect .= "informacao_complementar5, ";

        $strSqlCeItensTotalSelect .= "ativacao ";
        
        //$strSqlCeItensTotalSelect .= "FROM ce_itens_temporario ";
        $strSqlCeItensTotalSelect .= "FROM " . Funcoes::ConteudoMascaraGravacao01($tabelaPesquisa) . " ";
        $strSqlCeItensTotalSelect .= "WHERE id <> 0 ";
        //if($idCePedidos <> "")
        //{
            $strSqlCeItensTotalSelect .= "AND id_tb_cadastro_cliente = :id_tb_cadastro_cliente ";
        //}
        if($strAtivacao <> "")
        {
			$strSqlCeItensTotalSelect .= "AND ativacao = :ativacao ";
        }
		$strSqlCeItensTotalSelect .= "ORDER BY " . $GLOBALS['configClassificacaoProdutosCarrinhoDb'] . " ";
		//echo "strSqlCeItensTotalSelect=" . $strSqlCeItensTotalSelect  . "<br/>";
        //----------


		//Componentes e parâmetros.
        //----------
        $statementPedidosItensTotalSelect = $GLOBALS['dbSistemaConPDO']->prepare($strSqlCeItensTotalSelect);
        
        if ($statementPedidosItensTotalSelect !== false)
        {
            //if($idCePedidos <> "")
            //{
                $statementPedidosItensTotalSelect->bindParam(':id_tb_cadastro_cliente', $idTbCadastroCliente, PDO::PARAM_STR);
            //}
			if($strAtivacao <> "")
			{
				$statementPedidosItensTotalSelect->bindParam(':ativacao', $strAtivacao, PDO::PARAM_STR);
			}
            $statementPedidosItensTotalSelect->execute();
            
            /*
            $statementPedidosItensTotalSelect->execute(array(
                "id_parent" => $idParentPedidosItens
            ));
            */
        }
        
        
        //$resultadoPedidosItensTotal = $dbSistemaConPDO->query($strSqlCeItensTotalSelect);
        $resultadoPedidosItensTotal = $statementPedidosItensTotalSelect->fetchAll();
        //----------
		

		//Loop pelos resultados.
        //----------
		foreach($resultadoPedidosItensTotal as $linhaPedidosItensTotal)
		{


                //Criação de variáveis.
                $strIdItemReferencia = "";

                //Definição de valores.
                $strIdItemReferencia = "id_item";

                /*
				If WebConfigurationManager.AppSettings("HabilitarItensValoresProdutos") = "1" Then
                    strIdItemReferencia = "id_tb_itens_valores"
                End If
				*/
				
				/**/
                $strRetorno = $strRetorno + ($linhaPedidosItensTotal["quantidade"] * DbFuncoes::GetCampoGenerico06($nomeTabelaReferencia, 
																													$nomeCamporReferenciaValor, 
																													$nomeCampoReferencia, 
																													$linhaPedidosItensTotal[$strIdItemReferencia], 
																													"", 
																													"", 
																													2, 
																													"", 
																													"", 
																													"", 
																													"", 
																													"", 
																													""));
				
										  
			//Verificação de erro - debug.
			//echo "strSqlCeItensTotalSelect=" . $strSqlCeItensTotalSelect  . "<br/>";
        }
        //----------


        //Limpeza de objetos.
        //----------
        unset($strSqlCeItensTotalSelect);
        unset($statementPedidosItensTotalSelect);
        unset($resultadoPedidosItensTotal);
        unset($linhaPedidosItensTotal);
        //----------
		
		
		return $strRetorno;
	}
	//**************************************************************************************		

	
	//Cálculo de frete.
	//**************************************************************************************
	function CarrinhoCalculoFreteCorreios01($strCEPOrigem, 
	$strCEPDestino, 
	$strPesoTotal, 
	$strValorPedido, 
	$strFormato, 
	$strAltura, 
	$strLargura, 
	$strComprimento, 
	$strDiametro, 
	$strTipoEntrega, 
	$strTipoRetorno)
	{
		//strTipoRetorno: 1 - Valor do Frete | 2 - Prazo de Entrega | 3 - Mensagem Erro
		//strFormato: 1 - Caixa


		//Variáveis.
		//----------
		$strRetorno = "";
        $strRetornoValor = "";
        $strRetornoPrazoEntrega = "";
        $mensagemErro = "";

        $nCdEmpresa = $GLOBALS['configCarrinhoFreteCorreios_nCdEmpresa'];
        $sDsSenha = $GLOBALS['configCarrinhoFreteCorreiosMetodo_sDsSenha'];
        $sCdMaoPropria = "N";
        $sCdAvisoRecebimento = "N";

        //Medidas mínimas.
		if($strAltura == "0" || $strAltura == "")
		{
			$strAltura = "2";
		}
		if($strLargura == "0" || $strLargura == "")
		{
			$strLargura = "11";
		}
		if($strComprimento == "0" || $strComprimento == "")
		{
			$strComprimento = "16";
		}
		if($strDiametro == "")
		{
			$strDiametro = "16";
		}
		if($strFormato == "")
		{
			$strFormato = "1"; //1 – Formato caixa/pacote | 2 – Formato rolo/prisma | 3 - Envelope
		}
		
		$apiURL = "";
		$consultaCorreios = "";
		//----------
		
		
		$apiURL = $GLOBALS['configUrl'] . "/" . $GLOBALS['configDiretorioAPI'] . "/ApiCarrinhoFrete.php?cepOrigem=" . $strCEPOrigem . 
																										"&cepDestino=" . $strCEPDestino . 
																										"&nVlPeso=" . $strPesoTotal . 
																										"&nCdFormato=" . $strFormato . 
																										"&nVlComprimento=" . $strComprimento . 
																										"&nVlAltura=" . $strAltura . 
																										"&nVlLargura=" . $strLargura . 
																										"&nVlDiametro=" . $strDiametro . 
																										"&nVlValorDeclarado=" . $strValorPedido . 
																										"&nCdEmpresa=" . $nCdEmpresa . 
																										"&sDsSenha=" . $sDsSenha . 
																										"&sCdMaoPropria=" . $sCdMaoPropria;
		
		
		
		
		
		$consultaCorreios = JsonFuncoes::GetDados_API02($apiURL, 
														"sistema", 
														"jsonStringCompleto", 
														NULL);
		if($consultaCorreios <> "")
		{
			$jsonConsultaCorreios = json_decode($consultaCorreios);
			
			//PAC.
			if($strTipoEntrega == "41106" || $strTipoEntrega == "41211" || $strTipoEntrega == "41068")
			{
				$strRetornoValor = $jsonConsultaCorreios->fretePACValor;
				$strRetornoPrazoEntrega = $jsonConsultaCorreios->fretePACPrazoEntrega;
			}
			
			//SEDEX.
			if($strTipoEntrega == "40010" || $strTipoEntrega == "40096" || $strTipoEntrega == "40436" || $strTipoEntrega == "40444" || $strTipoEntrega == "40568" || $strTipoEntrega == "40606")
			{
				$strRetornoValor = $jsonConsultaCorreios->freteSEDEXValor;
				$strRetornoPrazoEntrega = $jsonConsultaCorreios->freteSEDEXPrazoEntrega;
			}
			
			//eSEDEX.
			if($strTipoEntrega == "81019" || $strTipoEntrega == "81868" || $strTipoEntrega == "81833" || $strTipoEntrega == "81850")
			{
				$strRetornoValor = $jsonConsultaCorreios->freteESEDEXValor;
				$strRetornoPrazoEntrega = $jsonConsultaCorreios->freteESEDEXPrazoEntrega;
			}
			
			//SEDEX a Cobrar.
			if($strTipoEntrega == "40126" || $strTipoEntrega == "40045")
			{
				$strRetornoValor = $jsonConsultaCorreios->freteSEDEXACobrarValor;
				$strRetornoPrazoEntrega = $jsonConsultaCorreios->freteSEDEXACobrarPrazoEntrega;
			}
			
			//SEDEX 10.
			if($strTipoEntrega == "40215")
			{
				$strRetornoValor = $jsonConsultaCorreios->freteSEDEX10Valor;
				$strRetornoPrazoEntrega = $jsonConsultaCorreios->freteSEDEX10PrazoEntrega;
			}

			//SEDEX Hoje.
			if($strTipoEntrega == "40290")
			{
				$strRetornoValor = $jsonConsultaCorreios->freteSEDEXHojeValor;
				$strRetornoPrazoEntrega = $jsonConsultaCorreios->freteSEDEXHojePrazoEntrega;
			}


			//Debug.
			//$strRetorno = $jsonConsultaCorreios->fretePACValor;
			//$strRetorno = $consultaCorreios;
		}
		
		
		if($strTipoRetorno == 1)
		{
			$strRetorno = $strRetornoValor;
		}
		if($strTipoRetorno == 2)
		{
			$strRetorno = $strRetornoPrazoEntrega;
		}
		if($strTipoRetorno == 3)
		{
			$strRetorno = $mensagemErro;
		}
		
		
		
		//Debug.
		//echo "apiURL=" . $apiURL . "</br>";
		
		
		return $strRetorno;
	}
	//**************************************************************************************
	
	
	//Função para retornar o tipo de frete.
	//**************************************************************************************
	function GetCodigoEntrega($strCodigo, $strTipoEntrega)
	{
        //PagSeguro.
        //----------------------
		if($strTipoEntrega == 2)
		{
			//Não especificado.
			$strRetorno = "3";
		
			//PAC
			if($strCodigo == "41106")
			{
				$strRetorno =  "1";
			}
			if($strCodigo == "41068")
			{
				$strRetorno =  "1";
			}
			if($strCodigo == "04510")
			{
				$strRetorno =  "1";
			}
			if($strCodigo == "41211")
			{
				$strRetorno =  "1";
			}
			
			//SEDEX
			if($strCodigo == "04014")
			{
				$strRetorno =  "2";
			}
			if($strCodigo == "40606")
			{
				$strRetorno =  "2";
			}
			if($strCodigo == "40010")
			{
				$strRetorno =  "2";
			}
			if($strCodigo == "40096")
			{
				$strRetorno =  "2";
			}
			if($strCodigo == "40436")
			{
				$strRetorno =  "2";
			}
			if($strCodigo == "40444")
			{
				$strRetorno =  "2";
			}
			if($strCodigo == "40568")
			{
				$strRetorno =  "2";
			}
		}
        //----------------------
	}
	//**************************************************************************************		

	
	//Função para retornar o nome amigável de entrega.
	//**************************************************************************************
	function GetNomeEntrega($strCodigo, $strTipoEntrega)
	{
		//Criação de algumas variáveis.
		//----------
		//strTipoEntrega:1 - Correios (site) | 2 - Correios (sistema) - implementar
		$strRetorno = $strCodigo;
		//----------
		
		
		//Correios.
		//----------
		if($strTipoEntrega == 1)
		{
			//PAC
			if($strCodigo == "41106")
			{
				$strRetorno =  XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoFreteOpcaoPAC");
			}
			if($strCodigo == "41068")
			{
				$strRetorno =  XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoFreteOpcaoPAC");
			}
			if($strCodigo == "04510")
			{
				$strRetorno =  XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoFreteOpcaoPAC");
			}
			if($strCodigo == "41211")
			{
				$strRetorno =  XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoFreteOpcaoPAC");
			}
			
			//SEDEX
			if($strCodigo == "04014")
			{
				$strRetorno =  XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoFreteOpcaoSEDEX");
			}
			if($strCodigo == "40606")
			{
				$strRetorno =  XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoFreteOpcaoSEDEX");
			}
			if($strCodigo == "40010")
			{
				$strRetorno =  XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoFreteOpcaoSEDEX");
			}
			if($strCodigo == "40096")
			{
				$strRetorno =  XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoFreteOpcaoSEDEX");
			}
			if($strCodigo == "40436")
			{
				$strRetorno =  XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoFreteOpcaoSEDEX");
			}
			if($strCodigo == "40444")
			{
				$strRetorno =  XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoFreteOpcaoSEDEX");
			}
			if($strCodigo == "40568")
			{
				$strRetorno =  XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoFreteOpcaoSEDEX");
			}
			
			//SEDEX 10
			if($strCodigo == "40215")
			{
				$strRetorno =  XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoFreteOpcaoSEDEX10");
			}
			
			//SEDEX Hoje
			if($strCodigo == "40290")
			{
				$strRetorno =  XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoFreteOpcaoSEDEXHoje");
			}

			//SEDEX a Cobrar
			if($strCodigo == "40045")
			{
				$strRetorno =  XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoFreteOpcaoSEDEXACobrar");
			}
			if($strCodigo == "40126")
			{
				$strRetorno =  XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoFreteOpcaoSEDEXACobrar");
			}

			//e-SEDEX
			if($strCodigo == "81019")
			{
				$strRetorno =  XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoFreteOpcaoESEDEX");
			}
			if($strCodigo == "81868")
			{
				$strRetorno =  XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoFreteOpcaoESEDEX");
			}
			if($strCodigo == "81833")
			{
				$strRetorno =  XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoFreteOpcaoESEDEX");
			}
			if($strCodigo == "81850")
			{
				$strRetorno =  XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoFreteOpcaoESEDEX");
			}
		}
		//----------

		
		return $strRetorno;
	}
	//**************************************************************************************
}