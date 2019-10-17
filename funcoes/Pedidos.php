<?php
class Pedidos
{
	//Função para inclusão de itens.
	//**************************************************************************************
	function PedidosGravar($_idTbCadastroCliente, 
	 $idTbCadastroUsuario, 
	 $_idCePedidos, 
	 $strAtivacao, 
	 $idTbCadastroEnderecos, 
	 $dataValidade, 
	 $_valorPedido, 
	 $_valorFrete, 
	 $periodoContratacao, 
	 $_codSedex, 
	 $pesoTotal, 
	 $_idTbCadastro1, 
	 $_idTbCadastro2, 
	 $_idTbCadastro3, 
	 $strObs, 
	 $idCeComplementoStatus)
	 {
		//Criação de algumas variáveis.
		//----------
		$strRetorno = "";
		$statusGravacao = false;
		
		//$dataPedido = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");
		//----------
		
		
		//Montagem do query.
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
		$strSqlCeItensTemporarioDetalhesSelect .= "AND ativacao = :ativacao ";
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
			$statementCeItensTemporarioDetalhesSelect->bindParam(':id_tb_cadastro_cliente', $_idTbCadastroCliente, PDO::PARAM_STR);
			$statementCeItensTemporarioDetalhesSelect->bindParam(':ativacao', $strAtivacao, PDO::PARAM_STR);
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
		if(!empty($resultadoCeItensTemporarioDetalhesSelect))
		{
			
			foreach($resultadoCeItensTemporarioDetalhesSelect as $linhaCeItensTemporarioDetalhesSelect)
			{
				//Produtos.
				//-------------
				if($linhaCeItensTemporarioDetalhesSelect["tabela"] == "tb_produtos")
				{
					
                    //Criação de variáveis.
                    $tbProdutosValor = 0;


                    //Definição de valor unitário.
                    $tbProdutosValor = DbFuncoes::GetCampoGenerico01($linhaCeItensTemporarioDetalhesSelect["id_item"], "tb_produtos", "valor");

                    //Inclusão de item.
					if(Pedidos::PedidosItensInsert($_idTbCadastroCliente, 
					$_idCePedidos, 
					$idTbCadastroUsuario, 
					$linhaCeItensTemporarioDetalhesSelect["id_item"], 
					DbFuncoes::GetCampoGenerico01($linhaCeItensTemporarioDetalhesSelect["id_item"], "tb_produtos", "cod_produto"), 
					DbFuncoes::GetCampoGenerico01($linhaCeItensTemporarioDetalhesSelect["id_item"], "tb_produtos", "produto"), 
					"tb_produtos", 
					$linhaCeItensTemporarioDetalhesSelect["quantidade"], 
					$tbProdutosValor, 
					0, 
					$linhaCeItensTemporarioDetalhesSelect["obs"], 
					$linhaCeItensTemporarioDetalhesSelect["id_tb_itens_valores"], 
					$linhaCeItensTemporarioDetalhesSelect["id_tb_itens_valores_titulo"], 
					$linhaCeItensTemporarioDetalhesSelect["ids_opcionais"], 
					$linhaCeItensTemporarioDetalhesSelect["ids_opcionais_descricao"]) == true)
					{
						//Defininição de status.
						$statusGravacao = true;
					}
					
					
					//Verificação de erro - debug.
					//echo "linhaCeItensTemporarioDetalhesSelect - id=" . $linhaCeItensTemporarioDetalhesSelect["id"] . "<br>";
				}
				//-------------
				
				
				//Afiliações.
				//-------------
				if($linhaCeItensTemporarioDetalhesSelect["tabela"] == "tb_afiliacoes")
				{
                    //Criação de variáveis.
                    $tbAfiliacoesValor = 0;


                    //Definição de valor unitário.
                    $tbAfiliacoesValor = DbFuncoes::GetCampoGenerico01($linhaCeItensTemporarioDetalhesSelect["id_item"], "tb_afiliacoes", "valor");


                    //Inclusão de item.
					if(Pedidos::PedidosItensInsert($_idTbCadastroCliente, 
					$_idCePedidos, 
					$idTbCadastroUsuario, 
					$linhaCeItensTemporarioDetalhesSelect["id_item"], 
					DbFuncoes::GetCampoGenerico01($linhaCeItensTemporarioDetalhesSelect["id_item"], "tb_afiliacoes", "id"), 
					DbFuncoes::GetCampoGenerico01($linhaCeItensTemporarioDetalhesSelect["id_item"], "tb_afiliacoes", "afiliacao"), 
					"tb_afiliacoes", 
					$linhaCeItensTemporarioDetalhesSelect["quantidade"], 
					$tbAfiliacoesValor, 
					0, 
					$linhaCeItensTemporarioDetalhesSelect["obs"], 
					"0", 
					"", 
					"", 
					"") == true)
					{
						//Defininição de status.
						$statusGravacao = true;
					}
					
				}
				//-------------

				
				//Verificação de erro - debug.
				//echo "CarrinhoTemporario - id=" . $linhaCeItensTemporarioDetalhesSelect["id"] . "<br>";
			}
			
		}else{
			//Vazio.
			
		}
		
		
		//Verificação de erro - debug.
		//echo "strOperacao=" . $strOperacao . "<br>";
		//-------------


		//Limpeza de objetos.
		//----------
		unset($resultadoCeItensTemporarioDetalhesSelect);
		unset($linhaCeItensTemporarioDetalhesSelect);
		unset($strSqlCeItensTemporarioDetalhesSelect);
		unset($statementCeItensTemporarioDetalhesSelect);
		//----------
		
		
		//Gravação do pedido.
		if($statusGravacao == true)
		{
			$strRetornoPedidosInsert = "";
			
			$strRetornoPedidosInsert = Pedidos::PedidosInsert($_idCePedidos, 
															$_idTbCadastroCliente, 
															$idTbCadastroEnderecos, 
															$idTbCadastroUsuario, 
															$dataValidade, 
															$_valorPedido, 
															$_valorFrete, 
															"0", 
															$_codSedex, 
															$pesoTotal, 
															$_idTbCadastro1, 
															$_idTbCadastro1, 
															$_idTbCadastro1, 
															$strObs, 
															$idCeComplementoStatus);
															
			if($strRetornoPedidosInsert == true)
			{
				$strRetorno = true;
			}
															
			//Verificação de erro (debug).
			//$strRetorno = "PedidosGravar=sucesso" . "strRetornoPedidosInsert=" . $strRetornoPedidosInsert;
		}
		
		
		return $strRetorno;
	 }
	//**************************************************************************************

	
	//Função para inclusão de itens.
	//**************************************************************************************
	function PedidosItensInsert($idTbCadastroCliente, 
	$idCePedidos, 
	$idTbCadastroUsuario, 
	$idItem, 
	$codItem, 
	$strDescricao, 
	$strTabela, 
	$strQuantidade, 
	$strValorUnitario, 
	$strAtivacao, 
	$strObs, 
	$idTbItensValores = "", 
	$idTbItensValoresTitulo = "", 
	$idsOpcionais = "", 
	$strComplementoQueryString = "")
	{
		//Criação de algumas variáveis.
		//----------
		$strRetorno = false;
		$id = ContadorUniversal::ContadorUniversalUpdate(1);
		$dataPedido = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");
		//----------


		//Inclusão de registro no BD.
		//----------
		$strSqlPedidosItensInsert = "";
		$strSqlPedidosItensInsert .= "INSERT INTO ce_itens ";
		$strSqlPedidosItensInsert .= "SET ";
		//$strSqlPedidosItensInsert .= "id = :id ";
		$strSqlPedidosItensInsert .= "id = :id, ";
		$strSqlPedidosItensInsert .= "id_ce_pedidos = :id_ce_pedidos, ";
		$strSqlPedidosItensInsert .= "id_tb_cadastro_cliente = :id_tb_cadastro_cliente, ";
		$strSqlPedidosItensInsert .= "id_tb_cadastro_usuario = :id_tb_cadastro_usuario, ";
		$strSqlPedidosItensInsert .= "id_item = :id_item, ";
		$strSqlPedidosItensInsert .= "cod_item = :cod_item, ";
		$strSqlPedidosItensInsert .= "descricao = :descricao, ";
		$strSqlPedidosItensInsert .= "tabela = :tabela, ";
		$strSqlPedidosItensInsert .= "quantidade = :quantidade, ";
		$strSqlPedidosItensInsert .= "valor_unitario = :valor_unitario, ";
		//$strSqlPedidosItensInsert .= "id_tb_itens_valores = :id_tb_itens_valores, ";
		//$strSqlPedidosItensInsert .= "id_tb_itens_valores_titulo = :id_tb_itens_valores_titulo, ";
		//$strSqlPedidosItensInsert .= "id_tb_itens_data = :id_tb_itens_data, ";
		$strSqlPedidosItensInsert .= "valor_total = :valor_total, ";
		//$strSqlPedidosItensInsert .= "ids_opcionais = :ids_opcionais, ";
		//$strSqlPedidosItensInsert .= "ids_opcionais_descricao = :ids_opcionais_descricao, ";
		$strSqlPedidosItensInsert .= "obs = :obs, ";
		$strSqlPedidosItensInsert .= "informacao_complementar1 = :informacao_complementar1, ";
		$strSqlPedidosItensInsert .= "informacao_complementar2 = :informacao_complementar2, ";
		$strSqlPedidosItensInsert .= "informacao_complementar3 = :informacao_complementar3, ";
		$strSqlPedidosItensInsert .= "informacao_complementar4 = :informacao_complementar4, ";
		$strSqlPedidosItensInsert .= "informacao_complementar5 = :informacao_complementar5, ";
		$strSqlPedidosItensInsert .= "ativacao = :ativacao, ";
		$strSqlPedidosItensInsert .= "data_pedido = :data_pedido ";

		//$strSqlPedidosItensInsert .= "data_pagamento = :data_pagamento, ";
		//$strSqlPedidosItensInsert .= "data_entrega = :data_entrega, ";
		//$strSqlPedidosItensInsert .= "data_validade = :data_validade, ";
		//$strSqlPedidosItensInsert .= "id_tb_produtos_complemento_status = :id_tb_produtos_complemento_status ";
		//echo "strSqlPedidosItensInsert=" . $strSqlPedidosItensInsert . "<br>";
		//----------

		
		$statementPedidosItensInsert = $GLOBALS['dbSistemaConPDO']->prepare($strSqlPedidosItensInsert);
		
		//Parâmetros.
		//----------
		if ($statementPedidosItensInsert !== false)
		{
			/*
			"id_tb_itens_valores" => $xxx,
			"id_tb_itens_valores_titulo" => $xxx,
			"id_tb_itens_data" => $xxx,
			"ids_opcionais" => $xxx,
			"ids_opcionais_descricao" => $xxx,
			"data_pagamento" => $xxx,
			"data_entrega" => $xxx,
			"data_validade" => $xxx
			"id_tb_produtos_complemento_status" => $xxx
			*/
			$statementPedidosItensInsert->execute(array(
				"id" => $id,
				"id_ce_pedidos" => $idCePedidos,
				"id_tb_cadastro_cliente" => $idTbCadastroCliente,
				"id_tb_cadastro_usuario" => $idTbCadastroUsuario,
				"id_item" => $idItem,
				"cod_item" => $codItem,
				"descricao" => $strDescricao,
				"tabela" => $strTabela,
				"quantidade" => $strQuantidade,
				"valor_unitario" => $strValorUnitario,
				"valor_total" => ($strQuantidade * $strValorUnitario),
				"obs" => $strObs,
				"informacao_complementar1" => "",
				"informacao_complementar2" => "",
				"informacao_complementar3" => "",
				"informacao_complementar4" => "",
				"informacao_complementar5" => "",
				"ativacao" => $strAtivacao,
				"data_pedido" => $dataPedido
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
		unset($strSqlPedidosItensInsert);
		unset($statementPedidosItensInsert);
		//----------
		
		
		return $strRetorno;
	}
	//**************************************************************************************


	//Função para inclusão de itens.
	//**************************************************************************************
	function PedidosInsert($idCePedidos, 
	$idTbCadastroCliente, 
	$idTbCadastroEnderecos, 
	$idTbCadastroUsuario, 
	$dataValidade, 
	$valorPedido, 
	$valorFrete, 
	$periodoContratacao, 
	$tipoEntrega, 
	$pesoTotal, 
	$idTbCadastro1, 
	$idTbCadastro2, 
	$idTbCadastro3, 
	$strObs, 
	$idCeComplementoStatus)
	{
		//Criação de algumas variáveis.
		//----------
		$strRetorno = false;
		//$id = ContadorUniversal::ContadorUniversalUpdate(1);
		$dataPedido = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");
		if($valorFrete == "")
		{
			$valorFrete = 0;
		}
		//----------


		//Inclusão de registro no BD.
		//----------
		$strSqlPedidosInsert = "";
		$strSqlPedidosInsert .= "INSERT INTO ce_pedidos ";
		$strSqlPedidosInsert .= "SET ";
		$strSqlPedidosInsert .= "id = :id, ";
		$strSqlPedidosInsert .= "id_tb_cadastro_cliente = :id_tb_cadastro_cliente, ";
		$strSqlPedidosInsert .= "id_tb_cadastro_enderecos = :id_tb_cadastro_enderecos, ";
		//$strSqlPedidosInsert .= "id_tb_cadastro_cartoes = :id_tb_cadastro_cartoes, ";
		$strSqlPedidosInsert .= "id_tb_cadastro_usuario = :id_tb_cadastro_usuario, ";
		$strSqlPedidosInsert .= "tipo_pagamento = :tipo_pagamento, ";
		$strSqlPedidosInsert .= "data_pedido = :data_pedido, ";
		//$strSqlPedidosInsert .= "data_pagamento = :data_pagamento, ";
		//$strSqlPedidosInsert .= "data_entrega = :data_entrega, ";
		$strSqlPedidosInsert .= "data_validade = :data_validade, ";
		$strSqlPedidosInsert .= "valor_pedido = :valor_pedido, ";
		$strSqlPedidosInsert .= "valor_frete = :valor_frete, ";
		$strSqlPedidosInsert .= "periodo_contratacao = :periodo_contratacao, ";
		$strSqlPedidosInsert .= "tipo_entrega = :tipo_entrega, ";
		$strSqlPedidosInsert .= "valor_total = :valor_total, ";
		$strSqlPedidosInsert .= "peso_total = :peso_total, ";
		$strSqlPedidosInsert .= "endereco_entrega = :endereco_entrega, ";
		$strSqlPedidosInsert .= "endereco_numero_entrega = :endereco_numero_entrega, ";
		$strSqlPedidosInsert .= "endereco_complemento_entrega = :endereco_complemento_entrega, ";
		$strSqlPedidosInsert .= "bairro_entrega = :bairro_entrega, ";
		$strSqlPedidosInsert .= "cidade_entrega = :cidade_entrega, ";
		$strSqlPedidosInsert .= "estado_entrega = :estado_entrega, ";
		$strSqlPedidosInsert .= "pais_entrega = :pais_entrega, ";
		$strSqlPedidosInsert .= "cep_entrega = :cep_entrega, ";
		$strSqlPedidosInsert .= "id_tb_cadastro1 = :id_tb_cadastro1, ";
		$strSqlPedidosInsert .= "id_tb_cadastro2 = :id_tb_cadastro2, ";
		$strSqlPedidosInsert .= "id_tb_cadastro3 = :id_tb_cadastro3, ";
		$strSqlPedidosInsert .= "obs = :obs, ";
		$strSqlPedidosInsert .= "ativacao = :ativacao, ";
		$strSqlPedidosInsert .= "informacao_complementar1 = :informacao_complementar1, ";
		$strSqlPedidosInsert .= "informacao_complementar2 = :informacao_complementar2, ";
		$strSqlPedidosInsert .= "informacao_complementar3 = :informacao_complementar3, ";
		$strSqlPedidosInsert .= "informacao_complementar4 = :informacao_complementar4, ";
		$strSqlPedidosInsert .= "informacao_complementar5 = :informacao_complementar5, ";
		$strSqlPedidosInsert .= "id_ce_complemento_status = :id_ce_complemento_status ";
		//$strSqlPedidosInsert .= "transacao_externa_status = :transacao_externa_status, ";
		//$strSqlPedidosInsert .= "transacao_externa_autenticacao = :transacao_externa_autenticacao, ";
		//$strSqlPedidosInsert .= "transacao_externa_log = :transacao_externa_log, ";
		//$strSqlPedidosInsert .= "transacao_externa_data_pagamento_liberado = :transacao_externa_data_pagamento_liberado ";
		//echo "strSqlPedidosInsert=" . $strSqlPedidosInsert . "<br>";
		//----------

		
		$statementPedidosInsert = $GLOBALS['dbSistemaConPDO']->prepare($strSqlPedidosInsert);
		
		//Parâmetros.
		//----------
		if ($statementPedidosInsert !== false)
		{
			/*
				"id_tb_cadastro_cartoes" => $xxx,
				
				"data_pagamento" => $xxx,
				"data_entrega" => $xxx,
				
				"transacao_externa_status" => $xxx,
				"transacao_externa_autenticacao" => $xxx,
				"transacao_externa_log" => $xxx,
				"transacao_externa_data_pagamento_liberado" => $xxx

			*/
			$statementPedidosInsert->execute(array(
				"id" => $idCePedidos,
				"id_tb_cadastro_cliente" => $idTbCadastroCliente,
				"id_tb_cadastro_enderecos" => $idTbCadastroEnderecos,
				"id_tb_cadastro_usuario" => $idTbCadastroUsuario,
				"tipo_pagamento" => "",
				"data_pedido" => $dataPedido,
				"data_validade" => $dataValidade,
				"valor_pedido" => $valorPedido,
				"valor_frete" => $valorFrete,
				"periodo_contratacao" => $periodoContratacao,
				"tipo_entrega" => $tipoEntrega,
				"valor_total" => ($valorPedido + $valorFrete),
				"peso_total" => $pesoTotal,
				"endereco_entrega" => "",
				"endereco_numero_entrega" => "",
				"endereco_complemento_entrega" => "",
				"bairro_entrega" => "",
				"cidade_entrega" => "",
				"estado_entrega" => "",
				"pais_entrega" => "",
				"cep_entrega" => "",
				"id_tb_cadastro1" => $idTbCadastro1,
				"id_tb_cadastro2" => $idTbCadastro2,
				"id_tb_cadastro3" => $idTbCadastro3,
				"obs" => $strObs,
				"ativacao" => "0",
				"informacao_complementar1" => "",
				"informacao_complementar2" => "",
				"informacao_complementar3" => "",
				"informacao_complementar4" => "",
				"informacao_complementar5" => "",
				"id_ce_complemento_status" => $idCeComplementoStatus
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
		unset($strSqlPedidosInsert);
		unset($statementPedidosInsert);
		//----------
		
		
		return $strRetorno;
	}
	//**************************************************************************************


	//Função para inclusão de itens.
	//**************************************************************************************
	function ItensTotal($idTbCadastroCliente, 
	$idCePedidos, 
	$tipoRetorno = 1, 
	$strAtivacao = "")
	{
		//tipoRetorno: 1 - valor | 2 - peso | 12 - valor1 (tb_produtos)
		
		
        //Criação de variáveis.
        //----------------------
        $strRetorno = 0;
        $strSqlCeItensTotalSelect = "";
        //----------------------
		
		
		//Query de pesquisa.
		//----------
		$strSqlCeItensTotalSelect = "";
		$strSqlCeItensTotalSelect .= "SELECT ";
		//$strSqlCeItensTotalSelect .= "* ";
		$strSqlCeItensTotalSelect .= "id, ";
		$strSqlCeItensTotalSelect .= "id_ce_pedidos, ";
		$strSqlCeItensTotalSelect .= "id_tb_cadastro_cliente, ";
		$strSqlCeItensTotalSelect .= "id_tb_cadastro_usuario, ";
		$strSqlCeItensTotalSelect .= "id_item, ";
		$strSqlCeItensTotalSelect .= "cod_item, ";
		$strSqlCeItensTotalSelect .= "descricao, ";
		$strSqlCeItensTotalSelect .= "tabela, ";
		$strSqlCeItensTotalSelect .= "quantidade, ";
		$strSqlCeItensTotalSelect .= "valor_unitario, ";
		$strSqlCeItensTotalSelect .= "id_tb_itens_valores, ";
		$strSqlCeItensTotalSelect .= "id_tb_itens_valores_titulo, ";
		$strSqlCeItensTotalSelect .= "id_tb_itens_data, ";
		$strSqlCeItensTotalSelect .= "valor_total, ";
		$strSqlCeItensTotalSelect .= "ids_opcionais, ";
		$strSqlCeItensTotalSelect .= "ids_opcionais_descricao, ";
		$strSqlCeItensTotalSelect .= "obs, ";
		
		$strSqlCeItensTotalSelect .= "informacao_complementar1, ";
		$strSqlCeItensTotalSelect .= "informacao_complementar2, ";
		$strSqlCeItensTotalSelect .= "informacao_complementar3, ";
		$strSqlCeItensTotalSelect .= "informacao_complementar4, ";
		$strSqlCeItensTotalSelect .= "informacao_complementar5, ";
		
		$strSqlCeItensTotalSelect .= "ativacao, ";
		$strSqlCeItensTotalSelect .= "data_pedido, ";
		$strSqlCeItensTotalSelect .= "data_pagamento, ";
		$strSqlCeItensTotalSelect .= "data_entrega, ";
		$strSqlCeItensTotalSelect .= "data_validade, ";
		$strSqlCeItensTotalSelect .= "id_tb_produtos_complemento_status ";
		
		$strSqlCeItensTotalSelect .= "FROM ce_itens ";
		$strSqlCeItensTotalSelect .= "WHERE id <> 0 ";
		if($idTbCadastroCliente <> "")
		{
			$strSqlCeItensTotalSelect .= "AND id_tb_cadastro_cliente = :id_tb_cadastro_cliente ";
		}
		if($idCePedidos <> "")
		{
			$strSqlCeItensTotalSelect .= "AND id_ce_pedidos = :id_ce_pedidos ";
		}
		if($strAtivacao <> "")
		{
			$strSqlCeItensTotalSelect .= "AND ativacao = :ativacao ";
		}
		
		//$strSqlCeItensTotalSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCeItensTotal'] . " ";
		//if($GLOBALS['habilitarCeItensTotalClassificacaoPersonalizada'] == 1 and DbFuncoes::GetCampoGenerico04("classificacao", "criterio_classificacao", "id_registro", $idParentCeItensTotal) <> "")
		//{
			//$strSqlCeItensTotalSelect .= "ORDER BY " . DbFuncoes::GetCampoGenerico04("classificacao", "criterio_classificacao", "id_registro", $idParentCeItensTotal) . " ";
			
		//}else{
			$strSqlCeItensTotalSelect .= "ORDER BY " . $GLOBALS['configClassificacaoItens'] . " ";
		//}
		//----------
		
		
		//Parâmetros.
		//----------
		//$statementCeItensTotalSelect = $dbSistemaConPDO->prepare($strSqlCeItensTotalSelect);
		$statementCeItensTotalSelect = $GLOBALS['dbSistemaConPDO']->prepare($strSqlCeItensTotalSelect);
		
		if ($statementCeItensTotalSelect !== false)
		{
			if($idTbCadastroCliente <> "")
			{
				//$statementCeItensTotalSelect->bindParam(':id_ce_pedidos', $idCePedidos, PDO::PARAM_STR);
				$statementCeItensTotalSelect->bindParam(':id_tb_cadastro_cliente', $idTbCadastroCliente, PDO::PARAM_STR);
			}
			if($idCePedidos <> "")
			{
				//$statementCeItensTotalSelect->bindParam(':id_ce_pedidos', $idCePedidos, PDO::PARAM_STR);
				$statementCeItensTotalSelect->bindParam(':id_ce_pedidos', $idCePedidos, PDO::PARAM_STR);
			}
			if($strAtivacao <> "")
			{
				//$statementCeItensTotalSelect->bindParam(':id_ce_pedidos', $idCePedidos, PDO::PARAM_STR);
				$statementCeItensTotalSelect->bindParam(':ativacao', $strAtivacao, PDO::PARAM_STR);
			}
			$statementCeItensTotalSelect->execute();
			
			/*
			$statementCeItensTotalSelect->execute(array(
				"id_parent" => $idParentCeItensTotal
			));
			*/
		}
		//----------


		//$resultadoCeItensTotal = $dbSistemaConPDO->query($strSqlCeItensTotalSelect);
		$resultadoCeItensTotal = $statementCeItensTotalSelect->fetchAll();

		if (empty($resultadoCeItensTotal))
		{
			//echo "Nenhum registro encontrado";
		}else{
			//Loop pelos resultados.
			foreach($resultadoCeItensTotal as $linhaCeItensTotal)
			{
				//valor
				if($tipoRetorno == 1)
				{
					$strRetorno = $strRetorno + $linhaCeItensTotal["valor_total"];
				}
			}
		}


		//Limpeza de objetos.
		//----------
		unset($strSqlCeItensTotalSelect);
		unset($statementCeItensTotalSelect);
		unset($resultadoCeItensTotal);
		unset($linhaCeItensTotal);
		//----------	
		
		
		return $strRetorno;	
	}
	//**************************************************************************************
}