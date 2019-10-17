<?php
class DbInsert
{
    //Função de inclusão de produtos.
    //**************************************************************************************
    function InsertProdutos($_tbProdutosId, 
	$_tbProdutosIdTbCategorias, 
	$_tbProdutosIdTbCadastroUsuario, 
	$_tbProdutosDataProduto, 
	$_tbProdutosCodProduto, 
	$_tbProdutosNClassificacao, 
	$_tbProdutosProduto, 
	$_tbProdutosDescricao01, 
	$_tbProdutosDescricao02, 
	$_tbProdutosDescricao03, 
	$_tbProdutosDescricao04, 
	$_tbProdutosDescricao05, 
	$_tbProdutosIC1, 
	$_tbProdutosIC2, 
	$_tbProdutosIC3, 
	$_tbProdutosIC4, 
	$_tbProdutosIC5, 
	$_tbProdutosIC6, 
	$_tbProdutosIC7, 
	$_tbProdutosIC8, 
	$_tbProdutosIC9, 
	$_tbProdutosIC10, 
	$_tbProdutosIC11, 
	$_tbProdutosIC12, 
	$_tbProdutosIC13, 
	$_tbProdutosIC14, 
	$_tbProdutosIC15, 
	$_tbProdutosPalavrasChave, 
	$_tbProdutosValor, 
	$_tbProdutosValor1, 
	$_tbProdutosValor2, 
	$_tbProdutosPeso, 
	$_tbProdutosCoeficiente, 
	$_tbProdutosEstoque, 
	$_tbProdutosAtivacao, 
	$_tbProdutosAtivacaoPromocao, 
	$_tbProdutosAtivacaoHome, 
	$_tbProdutosAtivacaoHomeCategoria, 
	$_tbProdutosAcessoRestrito, 
	$_tbProdutosNQuestoesAprovacao, 
	$_tbProdutosIdTbProdutosStatus, 
	$_tbProdutosImagem, 
	$_tbProdutosAnotacoesInternas, 
	$_tbProdutosNVisitas)
	{
		//Variáveis.
		//----------
		$strRetorno = false;
		
		$tbProdutosId = $_tbProdutosId;
		if($tbProdutosId == "")
		{
			$tbProdutosId = ContadorUniversal::ContadorUniversalUpdate(1);
		}

		$tbProdutosIdTbCategorias = $_tbProdutosIdTbCategorias;
		
		$tbProdutosIdTbCadastroUsuario = $_tbProdutosIdTbCadastroUsuario;
		if($tbProdutosIdTbCadastroUsuario == "")
		{
			$tbProdutosIdTbCadastroUsuario = 0;
		}

		//$tbProdutosDataProduto = Funcoes::DataLeitura01($linhaProdutosDetalhes['data_produto'], $GLOBALS['configSistemaFormatoData'], "1");
		//$tbProdutosDataProduto = Funcoes::DataGravacaoSql($tbProdutosDataProduto, $GLOBALS['configSistemaFormatoData']);
		$tbProdutosDataProduto = $_tbProdutosDataProduto;
		if($tbProdutosDataProduto == "")
		{
			//$data_publicacao = NULL;	
			$tbProdutosDataProduto = date("Y") . "-" . date("m") . "-" . date("d");	
		}
		
		$tbProdutosCodProduto = Funcoes::ConteudoMascaraGravacao01($_tbProdutosCodProduto);
		
		$tbProdutosNClassificacao = $_tbProdutosNClassificacao;
		if($tbProdutosNClassificacao == "")
		{
			$tbProdutosNClassificacao = 0;
		}

		$tbProdutosProduto = Funcoes::ConteudoMascaraGravacao01($_tbProdutosProduto);
		$tbProdutosDescricao01 = Funcoes::ConteudoMascaraGravacao01($_tbProdutosDescricao01);
		$tbProdutosDescricao02 = Funcoes::ConteudoMascaraGravacao01($_tbProdutosDescricao02);
		$tbProdutosDescricao03 = Funcoes::ConteudoMascaraGravacao01($_tbProdutosDescricao03);
		$tbProdutosDescricao04 = Funcoes::ConteudoMascaraGravacao01($_tbProdutosDescricao04);
		$tbProdutosDescricao05 = Funcoes::ConteudoMascaraGravacao01($_tbProdutosDescricao05);

		$tbProdutosIC1 = Funcoes::ConteudoMascaraGravacao01($_tbProdutosIC1);
		$tbProdutosIC2 = Funcoes::ConteudoMascaraGravacao01($_tbProdutosIC2);
		$tbProdutosIC3 = Funcoes::ConteudoMascaraGravacao01($_tbProdutosIC3);
		$tbProdutosIC4 = Funcoes::ConteudoMascaraGravacao01($_tbProdutosIC4);
		$tbProdutosIC5 = Funcoes::ConteudoMascaraGravacao01($_tbProdutosIC5);
		$tbProdutosIC6 = Funcoes::ConteudoMascaraGravacao01($_tbProdutosIC6);
		$tbProdutosIC7 = Funcoes::ConteudoMascaraGravacao01($_tbProdutosIC7);
		$tbProdutosIC8 = Funcoes::ConteudoMascaraGravacao01($_tbProdutosIC8);
		$tbProdutosIC9 = Funcoes::ConteudoMascaraGravacao01($_tbProdutosIC9);
		$tbProdutosIC10 = Funcoes::ConteudoMascaraGravacao01($_tbProdutosIC10);
		$tbProdutosIC11 = Funcoes::ConteudoMascaraGravacao01($_tbProdutosIC11);
		$tbProdutosIC12 = Funcoes::ConteudoMascaraGravacao01($_tbProdutosIC12);
		$tbProdutosIC13 = Funcoes::ConteudoMascaraGravacao01($_tbProdutosIC13);
		$tbProdutosIC14 = Funcoes::ConteudoMascaraGravacao01($_tbProdutosIC14);
		$tbProdutosIC15 = Funcoes::ConteudoMascaraGravacao01($_tbProdutosIC15);

		$tbProdutosPalavrasChave = Funcoes::ConteudoMascaraGravacao01($_tbProdutosPalavrasChave);
		$tbProdutosValor = Funcoes::MascaraValorGravar($_tbProdutosValor);
		if($tbProdutosValor == "")
		{
			$tbProdutosValor = 0;
		}
		$tbProdutosValor1 = Funcoes::MascaraValorGravar($_tbProdutosValor1);
		if($tbProdutosValor1 == "")
		{
			$tbProdutosValor1 = 0;
		}
		$tbProdutosValor2 = Funcoes::MascaraValorGravar($_tbProdutosValor2);
		if($tbProdutosValor2 == "")
		{
			$tbProdutosValor2 = 0;
		}
		//$tbProdutosPeso = Funcoes::MascaraValorLer($linhaProdutosDetalhes['peso'], $GLOBALS['configSistemaMoeda']);
		$tbProdutosPeso = $_tbProdutosPeso;
		if($tbProdutosPeso == "")
		{
			$tbProdutosPeso = 0;
		}

		//$tbProdutosCoeficiente = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['coeficiente']);
		//$tbProdutosCoeficiente = Funcoes::MascaraValorLer($linhaProdutosDetalhes['coeficiente'], $GLOBALS['configSistemaMoeda']);
		$tbProdutosCoeficiente = $_tbProdutosCoeficiente;
		$tbProdutosEstoque = $_tbProdutosEstoque;
		$tbProdutosAtivacao = $_tbProdutosAtivacao;
		$tbProdutosAtivacaoPromocao = $_tbProdutosAtivacaoPromocao;
		$tbProdutosAtivacaoHome = $_tbProdutosAtivacaoHome;
		$tbProdutosAtivacaoHomeCategoria = $_tbProdutosAtivacaoHomeCategoria;
		
		$tbProdutosAcessoRestrito = $_tbProdutosAcessoRestrito;
		if($tbProdutosAcessoRestrito == "")
		{
			$tbProdutosAcessoRestrito = 0;
		}

		$tbProdutosNQuestoesAprovacao = $_tbProdutosNQuestoesAprovacao;
		$tbProdutosIdTbProdutosStatus = $_tbProdutosIdTbProdutosStatus;
		$tbProdutosImagem = $_tbProdutosImagem;
		$tbProdutosAnotacoesInternas = Funcoes::ConteudoMascaraGravacao01($_tbProdutosAnotacoesInternas);
		$tbProdutosNVisitas = $_tbProdutosNVisitas;

		$strSqlProdutosInsert = "";
		//----------
		
		
		//Montagem do query.
		//----------
		$strSqlProdutosInsert .= "INSERT INTO tb_produtos ";
		$strSqlProdutosInsert .= "SET ";
		$strSqlProdutosInsert .= "id = :id, ";
		$strSqlProdutosInsert .= "id_tb_categorias = :id_tb_categorias, ";
		$strSqlProdutosInsert .= "id_tb_cadastro_usuario = :id_tb_cadastro_usuario, ";
		$strSqlProdutosInsert .= "data_produto = :data_produto, ";
		$strSqlProdutosInsert .= "cod_produto = :cod_produto, ";
		$strSqlProdutosInsert .= "n_classificacao = :n_classificacao, ";
		$strSqlProdutosInsert .= "produto = :produto, ";
		
		$strSqlProdutosInsert .= "descricao01 = :descricao01, ";
		$strSqlProdutosInsert .= "descricao02 = :descricao02, ";
		$strSqlProdutosInsert .= "descricao03 = :descricao03, ";
		$strSqlProdutosInsert .= "descricao04 = :descricao04, ";
		$strSqlProdutosInsert .= "descricao05 = :descricao05, ";
		
		$strSqlProdutosInsert .= "informacao_complementar1 = :informacao_complementar1, ";
		$strSqlProdutosInsert .= "informacao_complementar2 = :informacao_complementar2, ";
		$strSqlProdutosInsert .= "informacao_complementar3 = :informacao_complementar3, ";
		$strSqlProdutosInsert .= "informacao_complementar4 = :informacao_complementar4, ";
		$strSqlProdutosInsert .= "informacao_complementar5 = :informacao_complementar5, ";
		$strSqlProdutosInsert .= "informacao_complementar6 = :informacao_complementar6, ";
		$strSqlProdutosInsert .= "informacao_complementar7 = :informacao_complementar7, ";
		$strSqlProdutosInsert .= "informacao_complementar8 = :informacao_complementar8, ";
		$strSqlProdutosInsert .= "informacao_complementar9 = :informacao_complementar9, ";
		$strSqlProdutosInsert .= "informacao_complementar10 = :informacao_complementar10, ";
		$strSqlProdutosInsert .= "informacao_complementar11 = :informacao_complementar11, ";
		$strSqlProdutosInsert .= "informacao_complementar12 = :informacao_complementar12, ";
		$strSqlProdutosInsert .= "informacao_complementar13 = :informacao_complementar13, ";
		$strSqlProdutosInsert .= "informacao_complementar14 = :informacao_complementar14, ";
		$strSqlProdutosInsert .= "informacao_complementar15 = :informacao_complementar15, ";
		
		$strSqlProdutosInsert .= "palavras_chave = :palavras_chave, ";
		$strSqlProdutosInsert .= "valor = :valor, ";
		$strSqlProdutosInsert .= "valor1 = :valor1, ";
		$strSqlProdutosInsert .= "valor2 = :valor2, ";
		$strSqlProdutosInsert .= "peso = :peso, ";
		$strSqlProdutosInsert .= "coeficiente = :coeficiente, ";
		$strSqlProdutosInsert .= "estoque = :estoque, ";
		$strSqlProdutosInsert .= "ativacao = :ativacao, ";
		$strSqlProdutosInsert .= "ativacao_promocao = :ativacao_promocao, ";
		$strSqlProdutosInsert .= "ativacao_home = :ativacao_home, ";
		$strSqlProdutosInsert .= "ativacao_home_categoria = :ativacao_home_categoria, ";
		$strSqlProdutosInsert .= "acesso_restrito = :acesso_restrito, ";
		$strSqlProdutosInsert .= "n_questoes_aprovacao = :n_questoes_aprovacao, ";
		$strSqlProdutosInsert .= "id_tb_produtos_status = :id_tb_produtos_status, ";
		$strSqlProdutosInsert .= "imagem = :imagem, ";
		$strSqlProdutosInsert .= "anotacoes_internas = :anotacoes_internas, ";
		$strSqlProdutosInsert .= "n_visitas = :n_visitas ";
		//----------
		
		
		//Parametros e execução.
		//----------
		//$statementProdutosInsert = $dbSistemaConPDO->prepare($strSqlProdutosInsert);
		$statementProdutosInsert = $GLOBALS['dbSistemaConPDO']->prepare($strSqlProdutosInsert);
		
		if ($statementProdutosInsert !== false)
		{
			$statementProdutosInsert->execute(array(
				"id" => $tbProdutosId,
				"id_tb_categorias" => $tbProdutosIdTbCategorias,
				"id_tb_cadastro_usuario" => $tbProdutosIdTbCadastroUsuario,
				"data_produto" => $tbProdutosDataProduto,
				"cod_produto" => $tbProdutosCodProduto,
				"n_classificacao" => $tbProdutosNClassificacao,
				"produto" => $tbProdutosProduto,
				"descricao01" => $tbProdutosDescricao01,
				"descricao02" => $tbProdutosDescricao02,
				"descricao03" => $tbProdutosDescricao03,
				"descricao04" => $tbProdutosDescricao04,
				"descricao05" => $tbProdutosDescricao05,
				"informacao_complementar1" => $tbProdutosIC1,
				"informacao_complementar2" => $tbProdutosIC2,
				"informacao_complementar3" => $tbProdutosIC3,
				"informacao_complementar4" => $tbProdutosIC4,
				"informacao_complementar5" => $tbProdutosIC5,
				"informacao_complementar6" => $tbProdutosIC6,
				"informacao_complementar7" => $tbProdutosIC7,
				"informacao_complementar8" => $tbProdutosIC8,
				"informacao_complementar9" => $tbProdutosIC9,
				"informacao_complementar10" => $tbProdutosIC10,
				"informacao_complementar11" => $tbProdutosIC11,
				"informacao_complementar12" => $tbProdutosIC12,
				"informacao_complementar13" => $tbProdutosIC13,
				"informacao_complementar14" => $tbProdutosIC14,
				"informacao_complementar15" => $tbProdutosIC15,
				"palavras_chave" => $tbProdutosPalavrasChave,
				"valor" => $tbProdutosValor,
				"valor1" => $tbProdutosValor1,
				"valor2" => $tbProdutosValor2,
				"peso" => $tbProdutosPeso,
				"coeficiente" => $tbProdutosCoeficiente,
				"estoque" => $tbProdutosEstoque,
				"ativacao" => $tbProdutosAtivacao,
				"ativacao_promocao" => $tbProdutosAtivacaoPromocao,
				"ativacao_home" => $tbProdutosAtivacaoHome,
				"ativacao_home_categoria" => $tbProdutosAtivacaoHomeCategoria,
				"acesso_restrito" => $tbProdutosAcessoRestrito,
				"n_questoes_aprovacao" => $tbProdutosNQuestoesAprovacao,
				"id_tb_produtos_status" => $tbProdutosIdTbProdutosStatus,
				"imagem" => $tbProdutosImagem,
				"anotacoes_internas" => $tbProdutosAnotacoesInternas,
				"n_visitas" => $tbProdutosNVisitas
			));
			
			//$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus2");
			$strRetorno = true;
		}else{
			//echo "erro";
			//$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus3");
		}
		//----------
		

		//Limpeza de objetos.
		//----------
		unset($strSqlProdutosInsert);
		unset($statementProdutosInsert);
		//----------


		return $strRetorno;
	}
    //**************************************************************************************

	
    //Função de inclusão de publicação.
    //**************************************************************************************
    function InsertPublicacoes($_tbPublicacoesId, 
	$_tbPublicacoesTipoPublicacao, 
	$_tbPublicacoesIdTbCategorias, 
	$_tbPublicacoesIdTbCadastroUsuario, 
	$_tbPublicacoesDataPublicacao, 
	$_tbPublicacoesDataFinalPublicacao, 
	$_tbPublicacoesNClassificacao, 
	$_tbPublicacoesTitulo, 
	$_tbPublicacoesConteudoSimples, 
	$_tbPublicacoesIC1, 
	$_tbPublicacoesIC2, 
	$_tbPublicacoesIC3, 
	$_tbPublicacoesIC4, 
	$_tbPublicacoesIC5, 
	$_tbPublicacoesFonte, 
	$_tbPublicacoesLinkFonte, 
	$_tbPublicacoesEditoria, 
	$_tbPublicacoesPalavrasChave, 
	$_tbPublicacoesAtivacao, 
	$_tbPublicacoesAtivacaoHome, 
	$_tbPublicacoesAtivacaoHomeCategoria, 
	$_tbPublicacoesAcessoRestrito, 
	$_tbPublicacoesImagem)
	{
		//Variáveis.
		//----------
		$strRetorno = false;
		
        $tbPublicacoesId = $_tbPublicacoesId;
		if($tbPublicacoesId == "")
		{
			$tbPublicacoesId = ContadorUniversal::ContadorUniversalUpdate(1);
		}

        $tbPublicacoesTipoPublicacao = $_tbPublicacoesTipoPublicacao;
        $tbPublicacoesIdTbCategorias = $_tbPublicacoesIdTbCategorias;
		
        $tbPublicacoesIdTbCadastroUsuario = $_tbPublicacoesIdTbCadastroUsuario;
		if($tbPublicacoesIdTbCadastroUsuario == "")
		{
			$tbPublicacoesIdTbCadastroUsuario = 0;
		}

        $tbPublicacoesDataPublicacao = $_tbPublicacoesDataPublicacao;
		if($tbPublicacoesDataPublicacao == "")
		{
			//$data_publicacao = NULL;	
			$tbPublicacoesDataPublicacao = date("Y") . "-" . date("m") . "-" . date("d");	
		}
		
        $tbPublicacoesDataFinalPublicacao = $_tbPublicacoesDataFinalPublicacao;
		if($tbPublicacoesDataFinalPublicacao == "")
		{
			$tbPublicacoesDataFinalPublicacao = NULL;	
		}
		
        $tbPublicacoesNClassificacao = $_tbPublicacoesNClassificacao;
		if($tbPublicacoesNClassificacao == "")
		{
			$tbPublicacoesNClassificacao = 0;
		}

        $tbPublicacoesTitulo = Funcoes::ConteudoMascaraGravacao01($_tbPublicacoesTitulo);
        $tbPublicacoesConteudoSimples = Funcoes::ConteudoMascaraGravacao01($_tbPublicacoesConteudoSimples);

        $tbPublicacoesIC1 = Funcoes::ConteudoMascaraGravacao01($_tbPublicacoesIC1);
        $tbPublicacoesIC2 = Funcoes::ConteudoMascaraGravacao01($_tbPublicacoesIC2);
        $tbPublicacoesIC3 = Funcoes::ConteudoMascaraGravacao01($_tbPublicacoesIC3);
        $tbPublicacoesIC4 = Funcoes::ConteudoMascaraGravacao01($_tbPublicacoesIC4);
        $tbPublicacoesIC5 = Funcoes::ConteudoMascaraGravacao01($_tbPublicacoesIC5);

        $tbPublicacoesFonte = Funcoes::ConteudoMascaraGravacao01($_tbPublicacoesFonte);
        $tbPublicacoesLinkFonte = Funcoes::ConteudoMascaraGravacao01($_tbPublicacoesLinkFonte);
        $tbPublicacoesEditoria = Funcoes::ConteudoMascaraGravacao01($_tbPublicacoesEditoria);
        $tbPublicacoesPalavrasChave = Funcoes::ConteudoMascaraGravacao01($_tbPublicacoesPalavrasChave);

        $tbPublicacoesAtivacao = $_tbPublicacoesAtivacao;
        $tbPublicacoesAtivacaoHome = $_tbPublicacoesAtivacaoHome;
        $tbPublicacoesAtivacaoHomeCategoria = $_tbPublicacoesAtivacaoHomeCategoria;
		
        $tbPublicacoesAcessoRestrito = $_tbPublicacoesAcessoRestrito;
		if($tbPublicacoesAcessoRestrito == "")
		{
			$tbPublicacoesAcessoRestrito = 0;
		}

        $tbPublicacoesImagem = $_tbPublicacoesImagem;

        $strSqlPublicacoesInsert = "";
		//----------
		
		
		//Montagem do query.
		//----------
		$strSqlPublicacoesInsert = "";
		$strSqlPublicacoesInsert .= "INSERT INTO tb_publicacoes ";
		$strSqlPublicacoesInsert .= "SET ";
		$strSqlPublicacoesInsert .= "id = :id, ";
		$strSqlPublicacoesInsert .= "tipo_publicacao = :tipo_publicacao, ";
		$strSqlPublicacoesInsert .= "id_tb_categorias = :id_tb_categorias, ";
		$strSqlPublicacoesInsert .= "id_tb_cadastro_usuario = :id_tb_cadastro_usuario, ";
		$strSqlPublicacoesInsert .= "data_publicacao = :data_publicacao, ";
		$strSqlPublicacoesInsert .= "data_final_publicacao = :data_final_publicacao, ";
		$strSqlPublicacoesInsert .= "n_classificacao = :n_classificacao, ";
		
		$strSqlPublicacoesInsert .= "titulo = :titulo, ";
		$strSqlPublicacoesInsert .= "conteudo_simples = :conteudo_simples, ";
		$strSqlPublicacoesInsert .= "informacao_complementar1 = :informacao_complementar1, ";
		$strSqlPublicacoesInsert .= "informacao_complementar2 = :informacao_complementar2, ";
		$strSqlPublicacoesInsert .= "informacao_complementar3 = :informacao_complementar3, ";
		$strSqlPublicacoesInsert .= "informacao_complementar4 = :informacao_complementar4, ";
		$strSqlPublicacoesInsert .= "informacao_complementar5 = :informacao_complementar5, ";
		
		$strSqlPublicacoesInsert .= "fonte = :fonte, ";
		$strSqlPublicacoesInsert .= "link_fonte = :link_fonte, ";
		$strSqlPublicacoesInsert .= "editoria = :editoria, ";
		$strSqlPublicacoesInsert .= "palavras_chave = :palavras_chave, ";
		$strSqlPublicacoesInsert .= "ativacao = :ativacao, ";
		$strSqlPublicacoesInsert .= "ativacao_home = :ativacao_home, ";
		$strSqlPublicacoesInsert .= "ativacao_home_categoria = :ativacao_home_categoria, ";
		$strSqlPublicacoesInsert .= "acesso_restrito = :acesso_restrito ";
		//----------
		
		
		//Parametros e execução.
		//----------
		//$statementPublicacoesInsert = $dbSistemaConPDO->prepare($strSqlPublicacoesInsert);
		$statementPublicacoesInsert = $GLOBALS['dbSistemaConPDO']->prepare($strSqlPublicacoesInsert);

		if ($statementPublicacoesInsert !== false)
		{
			$statementPublicacoesInsert->execute(array(
				"id" => $tbPublicacoesId,
				"tipo_publicacao" => $tbPublicacoesTipoPublicacao,
				"id_tb_categorias" => $tbPublicacoesIdTbCategorias,
				"id_tb_cadastro_usuario" => $tbPublicacoesIdTbCadastroUsuario,
				"data_publicacao" => $tbPublicacoesDataPublicacao,
				"data_final_publicacao" => $tbPublicacoesDataFinalPublicacao,
				"n_classificacao" => $tbPublicacoesNClassificacao,
				"titulo" => $tbPublicacoesTitulo,
				"conteudo_simples" => $tbPublicacoesConteudoSimples,
				"informacao_complementar1" => $tbPublicacoesIC1,
				"informacao_complementar2" => $tbPublicacoesIC2,
				"informacao_complementar3" => $tbPublicacoesIC3,
				"informacao_complementar4" => $tbPublicacoesIC4,
				"informacao_complementar5" => $tbPublicacoesIC5,
				"fonte" => $tbPublicacoesFonte,
				"link_fonte" => $tbPublicacoesLinkFonte,
				"editoria" => $tbPublicacoesEditoria,
				"palavras_chave" => $tbPublicacoesPalavrasChave,
				"ativacao" => $tbPublicacoesAtivacao,
				"ativacao_home" => $tbPublicacoesAtivacaoHome,
				"ativacao_home_categoria" => $tbPublicacoesAtivacaoHomeCategoria,
				"acesso_restrito" => $tbPublicacoesAcessoRestrito
			));
			
			//$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus2");
			$strRetorno = true;
		}else{
			//echo "erro";
			//$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus3");
		}
		//----------


		//Limpeza de objetos.
		//----------
		unset($strSqlPublicacoesInsert);
		unset($statementPublicacoesInsert);
		//----------


		return $strRetorno;
	}
    //**************************************************************************************


    //Função de inclusão de cadastro.
    //**************************************************************************************
    function InsertCadastro($_tbCadastroId,
	$_tbCadastroIdTbCategorias,
	$_tbCadastroIdParentCadastro,
	$_tbCadastroDataCadastro,
	$_tbCadastroPfPj,
	$_tbCadastroNome,
	$_tbCadastroSexo,
	$_tbCadastroAltura,
	$_tbCadastroPeso,
	$_tbCadastroRazaoSocial,
	$_tbCadastroNomeFantasia,
	$_tbCadastroDataNascimento,
	$_tbCadastroData1,
	$_tbCadastroData2,
	$_tbCadastroData3,
	$_tbCadastroData4,
	$_tbCadastroData5,
	$_tbCadastroData6,
	$_tbCadastroData7,
	$_tbCadastroData8,
	$_tbCadastroData9,
	$_tbCadastroData10,
	$_tbCadastroCPF,
	$_tbCadastroRG,
	$_tbCadastroCNPJ,
	$_tbCadastroDocumento,
	$_tbCadastroIMunicipal,
	$_tbCadastroIEstadual,
	$_tbCadastroEnderecoPrincipal,
	$_tbCadastroEnderecoNumeroPrincipal,
	$_tbCadastroEnderecoComplementoPrincipal,
	$_tbCadastroBairroPrincipal,
	$_tbCadastroCidadePrincipal,
	$_tbCadastroEstadoPrincipal,
	$_tbCadastroPaisPrincipal,
	$_tbCadastroIdDBCepTblBairros,
	$_tbCadastroIdDBCepTblCidades,
	$_tbCadastroIdDBCepTblLogradouros,
	$_tbCadastroIdDBCepTblUF,
	$_tbCadastroCepPrincipal,
	$_tbCadastroPontoReferencia,
	$_tbCadastroEmailPrincipal,
	$_tbCadastroTelDDDPrincipal,
	$_tbCadastroTelPrincipal,
	$_tbCadastroCelDDDPrincipal,
	$_tbCadastroCelPrincipal,
	$_tbCadastroFaxDDDPrincipal,
	$_tbCadastroFaxPrincipal,
	$_tbCadastroSitePrincipal,
	$_tbCadastroNFuncionarios,
	$_tbCadastroOBSInterno,
	$_tbCadastroIdTbCadastroStatus,
	$_tbCadastroIdTbCadastro1,
	$_tbCadastroIdTbCadastro2,
	$_tbCadastroIdTbCadastro3,
	$_tbCadastroAtivacao,
	$_tbCadastroAtivacaoDestaque,
	$_tbCadastroAtivacaoMalaDireta,
	$_tbCadastroUsuario,
	$_tbCadastroSenha,
	$_tbCadastroImagem,
	$_tbCadastroLogo,
	$_tbCadastroBanner,
	$_tbCadastroMapa,
	$_tbCadastroMapaOnline,
	$_tbCadastroPalavrasChave,
	$_tbCadastroApresentacao,
	$_tbCadastroServicos,
	$_tbCadastroPromocoes,
	$_tbCadastroCondicoesComerciais,
	$_tbCadastroFormasPagamento,
	$_tbCadastroHorarioAtendimento,
	$_tbCadastroSituacaoAtual,
	$_tbCadastroIC1,
	$_tbCadastroIC2,
	$_tbCadastroIC3,
	$_tbCadastroIC4,
	$_tbCadastroIC5,
	$_tbCadastroIC6,
	$_tbCadastroIC7,
	$_tbCadastroIC8,
	$_tbCadastroIC9,
	$_tbCadastroIC10,
	$_tbCadastroIC11,
	$_tbCadastroIC12,
	$_tbCadastroIC13,
	$_tbCadastroIC14,
	$_tbCadastroIC15,
	$_tbCadastroIC16,
	$_tbCadastroIC17,
	$_tbCadastroIC18,
	$_tbCadastroIC19,
	$_tbCadastroIC20,
	$_tbCadastroIC21,
	$_tbCadastroIC22,
	$_tbCadastroIC23,
	$_tbCadastroIC24,
	$_tbCadastroIC25,
	$_tbCadastroIC26,
	$_tbCadastroIC27,
	$_tbCadastroIC28,
	$_tbCadastroIC29,
	$_tbCadastroIC30,
	$_tbCadastroIC31,
	$_tbCadastroIC32,
	$_tbCadastroIC33,
	$_tbCadastroIC34,
	$_tbCadastroIC35,
	$_tbCadastroIC36,
	$_tbCadastroIC37,
	$_tbCadastroIC38,
	$_tbCadastroIC39,
	$_tbCadastroIC40,
	$_tbCadastroNVisitas,
	$_tbCadastroOrigemCadastro)
	{
		//Variáveis.
		//----------
		$strRetorno = false;
		
        $tbCadastroId = $_tbCadastroId;
		if($tbCadastroId == "")
		{
			$tbCadastroId = ContadorUniversal::ContadorUniversalUpdate(1);
		}
		
        $tbCadastroIdTbCategorias = $_tbCadastroIdTbCategorias;
        //$tbCadastroIdParentCadastro = $_tbCadastroIdParentCadastro;
        $tbCadastroDataCadastro = $_tbCadastroDataCadastro;
		if($tbCadastroDataCadastro == "")
		{
			$tbCadastroDataCadastro = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");
		}

        $tbCadastroPfPj = $_tbCadastroPfPj;

        $tbCadastroNome = Funcoes::ConteudoMascaraGravacao01($_tbCadastroNome);
		
        $tbCadastroSexo = $_tbCadastroSexo;
		if($tbCadastroSexo == "")
		{
			$tbCadastroSexo = 0;
		}

        $tbCadastroAltura = $_tbCadastroAltura;
		if($tbCadastroAltura == "")
		{
			$tbCadastroAltura = 0;
		}

        $tbCadastroPeso = $_tbCadastroPeso;
		if($tbCadastroPeso == "")
		{
			$tbCadastroPeso = 0;
		}

        $tbCadastroRazaoSocial = Funcoes::ConteudoMascaraGravacao01($_tbCadastroRazaoSocial);
        $tbCadastroNomeFantasia = Funcoes::ConteudoMascaraGravacao01($_tbCadastroNomeFantasia);

        $tbCadastroDataNascimento = Funcoes::DataGravacaoSql($_tbCadastroDataNascimento, $GLOBALS['configSistemaFormatoData']);
		if($tbCadastroDataNascimento == "")
		{
			$tbCadastroDataNascimento = NULL;	
		}
		
		$tbCadastroData1 = Funcoes::DataGravacaoSql($_tbCadastroData1, $GLOBALS['configSistemaFormatoData']);
		if($tbCadastroData1 == "")
		{
			$tbCadastroData1 = NULL;	
		}
		$tbCadastroData2 = Funcoes::DataGravacaoSql($_tbCadastroData2, $GLOBALS['configSistemaFormatoData']);
		if($tbCadastroData2 == "")
		{
			$tbCadastroData2 = NULL;	
		}
		$tbCadastroData3 = Funcoes::DataGravacaoSql($_tbCadastroData3, $GLOBALS['configSistemaFormatoData']);
		if($tbCadastroData3 == "")
		{
			$tbCadastroData3 = NULL;	
		}
		$tbCadastroData4 = Funcoes::DataGravacaoSql($_tbCadastroData4, $GLOBALS['configSistemaFormatoData']);
		if($tbCadastroData4 == "")
		{
			$tbCadastroData4 = NULL;	
		}
		$tbCadastroData5 = Funcoes::DataGravacaoSql($_tbCadastroData5, $GLOBALS['configSistemaFormatoData']);
		if($tbCadastroData5 == "")
		{
			$tbCadastroData5 = NULL;	
		}
		$tbCadastroData6 = Funcoes::DataGravacaoSql($_tbCadastroData6, $GLOBALS['configSistemaFormatoData']);
		if($tbCadastroData6 == "")
		{
			$tbCadastroData6 = NULL;	
		}
		$tbCadastroData7 = Funcoes::DataGravacaoSql($_tbCadastroData7, $GLOBALS['configSistemaFormatoData']);
		if($tbCadastroData7 == "")
		{
			$tbCadastroData7 = NULL;	
		}
		$tbCadastroData8 = Funcoes::DataGravacaoSql($_tbCadastroData8, $GLOBALS['configSistemaFormatoData']);
		if($tbCadastroData8 == "")
		{
			$tbCadastroData8 = NULL;	
		}
		$data9 = Funcoes::DataGravacaoSql($_tbCadastroData9, $GLOBALS['configSistemaFormatoData']);
		if($data9 == "")
		{
			$data9 = NULL;	
		}
		$tbCadastroData10 = Funcoes::DataGravacaoSql($_tbCadastroData10, $GLOBALS['configSistemaFormatoData']);
		if($tbCadastroData10 == "")
		{
			$tbCadastroData10 = NULL;	
		}

        $tbCadastroCPF = Funcoes::SomenteNum($_tbCadastroCPF);
        $tbCadastroRG = $_tbCadastroRG;
        $tbCadastroCNPJ = Funcoes::SomenteNum($_tbCadastroCNPJ);
        $tbCadastroDocumento = $_tbCadastroDocumento;
        $tbCadastroIMunicipal = $_tbCadastroIMunicipal;
        $tbCadastroIEstadual = $_tbCadastroIEstadual;
        $tbCadastroEnderecoPrincipal = $_tbCadastroEnderecoPrincipal;
        $tbCadastroEnderecoNumeroPrincipal = $_tbCadastroEnderecoNumeroPrincipal;
        $tbCadastroEnderecoComplementoPrincipal = $_tbCadastroEnderecoComplementoPrincipal;
        $tbCadastroBairroPrincipal = $_tbCadastroBairroPrincipal;
        $tbCadastroCidadePrincipal = $_tbCadastroCidadePrincipal;
        $tbCadastroEstadoPrincipal = $_tbCadastroEstadoPrincipal;
        $tbCadastroPaisPrincipal = $_tbCadastroPaisPrincipal;

        $tbCadastroIdDBCepTblBairros = $_tbCadastroIdDBCepTblBairros;
        $tbCadastroIdDBCepTblCidades = $_tbCadastroIdDBCepTblCidades;
        $tbCadastroIdDBCepTblLogradouros = $_tbCadastroIdDBCepTblLogradouros;
        $tbCadastroIdDBCepTblUF = $_tbCadastroIdDBCepTblUF;
        $tbCadastroCepPrincipal = Funcoes::SomenteNum($_tbCadastroCepPrincipal);

        $tbCadastroPontoReferencia = $_tbCadastroPontoReferencia;
        $tbCadastroEmailPrincipal = $_tbCadastroEmailPrincipal;
        $tbCadastroTelDDDPrincipal = $_tbCadastroTelDDDPrincipal;
        $tbCadastroTelPrincipal = Funcoes::FormatarTelefoneGravar($_tbCadastroTelPrincipal);
        $tbCadastroCelDDDPrincipal = $_tbCadastroCelDDDPrincipal;
        $tbCadastroCelPrincipal = Funcoes::FormatarTelefoneGravar($_tbCadastroCelPrincipal);
        $tbCadastroFaxDDDPrincipal = $_tbCadastroFaxDDDPrincipal;
        $tbCadastroFaxPrincipal = $_tbCadastroFaxPrincipal;
        $tbCadastroSitePrincipal = $_tbCadastroSitePrincipal;
        $tbCadastroNFuncionarios = $_tbCadastroNFuncionarios;
		if($tbCadastroNFuncionarios == "")
		{
			$tbCadastroNFuncionarios = 0;
		}

        $tbCadastroOBSInterno = Funcoes::ConteudoMascaraGravacao01($_tbCadastroOBSInterno);

        $tbCadastroIdTbCadastroStatus = $_tbCadastroIdTbCadastroStatus;
		if($tbCadastroIdTbCadastroStatus == "")
		{
			$tbCadastroIdTbCadastroStatus = 0;
		}

        $tbCadastroIdTbCadastro1 = $_tbCadastroIdTbCadastro1;
		if($tbCadastroIdTbCadastro1 == "")
		{
			$tbCadastroIdTbCadastro1 = 0;
		}
		
        $tbCadastroIdTbCadastro2 = $_tbCadastroIdTbCadastro2;
		if($tbCadastroIdTbCadastro2 == "")
		{
			$tbCadastroIdTbCadastro2 = 0;
		}

        $tbCadastroIdTbCadastro3 = $_tbCadastroIdTbCadastro3;
		if($tbCadastroIdTbCadastro3 == "")
		{
			$tbCadastroIdTbCadastro3 = 0;
		}

        $tbCadastroAtivacao = $_tbCadastroAtivacao;
		if($tbCadastroAtivacao == "")
		{
			$tbCadastroAtivacao = 0;
		}

        $tbCadastroAtivacaoDestaque = $_tbCadastroAtivacaoDestaque;
		if($tbCadastroAtivacaoDestaque == "")
		{
			$tbCadastroAtivacaoDestaque = 0;
		}

        $tbCadastroAtivacaoMalaDireta = $_tbCadastroAtivacaoMalaDireta;
		if($tbCadastroAtivacaoMalaDireta == "")
		{
			$tbCadastroAtivacaoMalaDireta = 0;
		}

        $tbCadastroUsuario = $_tbCadastroUsuario;
		
        //$tbCadastroSenha = $_tbCadastroSenha;
		if($GLOBALS['configCadastroMetodoSenha'] == 0)
		{
			//$senha = Crypto::EncryptValue(Funcoes::ConteudoMascaraLeitura($_POST["senha"]), 0);
			$tbCadastroSenha = Crypto::EncryptValue(Funcoes::ConteudoMascaraGravacao01($_tbCadastroSenha), 0);
		}
		
		if($GLOBALS['configCadastroMetodoSenha'] == 2)
		{
			//$senha = Crypto::EncryptValue(Funcoes::ConteudoMascaraLeitura($_POST["senha"]), 2);
			$tbCadastroSenha = Crypto::EncryptValue(Funcoes::ConteudoMascaraGravacao01($_tbCadastroSenha), 2);
			//$senha = Crypto::EncryptValue($_POST["senha"], 2);
		}

        $tbCadastroImagem = $_tbCadastroImagem;

        $tbCadastroLogo = $_tbCadastroLogo;
        $tbCadastroBanner = $_tbCadastroBanner;
        $tbCadastroMapa = $_tbCadastroMapa;
        $tbCadastroMapaOnline = $_tbCadastroMapaOnline;
        $tbCadastroPalavrasChave = Funcoes::ConteudoMascaraGravacao01($_tbCadastroPalavrasChave);
        $tbCadastroApresentacao = Funcoes::ConteudoMascaraGravacao01($_tbCadastroApresentacao);
        $tbCadastroServicos = Funcoes::ConteudoMascaraGravacao01($_tbCadastroServicos);
        $tbCadastroPromocoes = Funcoes::ConteudoMascaraGravacao01($_tbCadastroPromocoes);
        $tbCadastroCondicoesComerciais = Funcoes::ConteudoMascaraGravacao01($_tbCadastroCondicoesComerciais);
        $tbCadastroFormasPagamento = Funcoes::ConteudoMascaraGravacao01($_tbCadastroFormasPagamento);
        $tbCadastroHorarioAtendimento = Funcoes::ConteudoMascaraGravacao01($_tbCadastroHorarioAtendimento);
        $tbCadastroSituacaoAtual = Funcoes::ConteudoMascaraGravacao01($_tbCadastroSituacaoAtual);
        $tbCadastroIC1 = Funcoes::ConteudoMascaraGravacao01($_tbCadastroIC1);
        $tbCadastroIC2 = Funcoes::ConteudoMascaraGravacao01($_tbCadastroIC2);
        $tbCadastroIC3 = Funcoes::ConteudoMascaraGravacao01($_tbCadastroIC3);
        $tbCadastroIC4 = Funcoes::ConteudoMascaraGravacao01($_tbCadastroIC4);
        $tbCadastroIC5 = Funcoes::ConteudoMascaraGravacao01($_tbCadastroIC5);
        $tbCadastroIC6 = Funcoes::ConteudoMascaraGravacao01($_tbCadastroIC6);
        $tbCadastroIC7 = Funcoes::ConteudoMascaraGravacao01($_tbCadastroIC7);
        $tbCadastroIC8 = Funcoes::ConteudoMascaraGravacao01($_tbCadastroIC8);
        $tbCadastroIC9 = Funcoes::ConteudoMascaraGravacao01($_tbCadastroIC9);
        $tbCadastroIC10 = Funcoes::ConteudoMascaraGravacao01($_tbCadastroIC10);
        $tbCadastroIC11 = Funcoes::ConteudoMascaraGravacao01($_tbCadastroIC11);
        $tbCadastroIC12 = Funcoes::ConteudoMascaraGravacao01($_tbCadastroIC12);
        $tbCadastroIC13 = Funcoes::ConteudoMascaraGravacao01($_tbCadastroIC13);
        $tbCadastroIC14 = Funcoes::ConteudoMascaraGravacao01($_tbCadastroIC14);
        $tbCadastroIC15 = Funcoes::ConteudoMascaraGravacao01($_tbCadastroIC15);
        $tbCadastroIC16 = Funcoes::ConteudoMascaraGravacao01($_tbCadastroIC16);
        $tbCadastroIC17 = Funcoes::ConteudoMascaraGravacao01($_tbCadastroIC17);
        $tbCadastroIC18 = Funcoes::ConteudoMascaraGravacao01($_tbCadastroIC18);
        $tbCadastroIC19 = Funcoes::ConteudoMascaraGravacao01($_tbCadastroIC19);
        $tbCadastroIC20 = Funcoes::ConteudoMascaraGravacao01($_tbCadastroIC20);
        $tbCadastroIC21 = Funcoes::ConteudoMascaraGravacao01($_tbCadastroIC21);
        $tbCadastroIC22 = Funcoes::ConteudoMascaraGravacao01($_tbCadastroIC22);
        $tbCadastroIC23 = Funcoes::ConteudoMascaraGravacao01($_tbCadastroIC23);
        $tbCadastroIC24 = Funcoes::ConteudoMascaraGravacao01($_tbCadastroIC24);
        $tbCadastroIC25 = Funcoes::ConteudoMascaraGravacao01($_tbCadastroIC25);
        $tbCadastroIC26 = Funcoes::ConteudoMascaraGravacao01($_tbCadastroIC26);
        $tbCadastroIC27 = Funcoes::ConteudoMascaraGravacao01($_tbCadastroIC27);
        $tbCadastroIC28 = Funcoes::ConteudoMascaraGravacao01($_tbCadastroIC28);
        $tbCadastroIC29 = Funcoes::ConteudoMascaraGravacao01($_tbCadastroIC29);
        $tbCadastroIC30 = Funcoes::ConteudoMascaraGravacao01($_tbCadastroIC30);
        $tbCadastroIC31 = Funcoes::ConteudoMascaraGravacao01($_tbCadastroIC31);
        $tbCadastroIC32 = Funcoes::ConteudoMascaraGravacao01($_tbCadastroIC32);
        $tbCadastroIC33 = Funcoes::ConteudoMascaraGravacao01($_tbCadastroIC33);
        $tbCadastroIC34 = Funcoes::ConteudoMascaraGravacao01($_tbCadastroIC34);
        $tbCadastroIC35 = Funcoes::ConteudoMascaraGravacao01($_tbCadastroIC35);
        $tbCadastroIC36 = Funcoes::ConteudoMascaraGravacao01($_tbCadastroIC36);
        $tbCadastroIC37 = Funcoes::ConteudoMascaraGravacao01($_tbCadastroIC37);
        $tbCadastroIC38  = Funcoes::ConteudoMascaraGravacao01($_tbCadastroIC38);
        $tbCadastroIC39  = Funcoes::ConteudoMascaraGravacao01($_tbCadastroIC39);
        $tbCadastroIC40  = Funcoes::ConteudoMascaraGravacao01($_tbCadastroIC40);

        $tbCadastroNVisitas  = $_tbCadastroNVisitas;
        $tbCadastroOrigemCadastro  = $_tbCadastroOrigemCadastro;

        $strSqlCadastroInsert = "";
		//----------


		//Montagem do query.
		//----------
		//$strSqlCadastroInsert = "";
		$strSqlCadastroInsert .= "INSERT INTO tb_cadastro ";
		$strSqlCadastroInsert .= "SET ";
		$strSqlCadastroInsert .= "id = :id, ";
		$strSqlCadastroInsert .= "id_tb_categorias = :id_tb_categorias, ";
		$strSqlCadastroInsert .= "data_cadastro = :data_cadastro, ";
		$strSqlCadastroInsert .= "pf_pj = :pf_pj, ";
		$strSqlCadastroInsert .= "nome = :nome, ";
		$strSqlCadastroInsert .= "sexo = :sexo, ";
		$strSqlCadastroInsert .= "altura = :altura, ";
		$strSqlCadastroInsert .= "peso = :peso, ";
		$strSqlCadastroInsert .= "razao_social = :razao_social, ";
		$strSqlCadastroInsert .= "nome_fantasia = :nome_fantasia, ";
		
		//if($dataNascimento <> "")
		//{
			$strSqlCadastroInsert .= "data_nascimento = :data_nascimento, ";
		//}
		
		$strSqlCadastroInsert .= "data1 = :data1, ";
		$strSqlCadastroInsert .= "data2 = :data2, ";
		$strSqlCadastroInsert .= "data3 = :data3, ";
		$strSqlCadastroInsert .= "data4 = :data4, ";
		$strSqlCadastroInsert .= "data5 = :data5, ";
		$strSqlCadastroInsert .= "data6 = :data6, ";
		$strSqlCadastroInsert .= "data7 = :data7, ";
		$strSqlCadastroInsert .= "data8 = :data8, ";
		$strSqlCadastroInsert .= "data9 = :data9, ";
		$strSqlCadastroInsert .= "data10 = :data10, ";
		
		$strSqlCadastroInsert .= "cpf_ = :cpf_, ";
		$strSqlCadastroInsert .= "rg_ = :rg_, ";
		$strSqlCadastroInsert .= "cnpj_ = :cnpj_, ";
		$strSqlCadastroInsert .= "documento = :documento, ";
		$strSqlCadastroInsert .= "i_municipal = :i_municipal, ";
		$strSqlCadastroInsert .= "i_estadual = :i_estadual, ";
		
		$strSqlCadastroInsert .= "endereco_principal = :endereco_principal, ";
		$strSqlCadastroInsert .= "endereco_numero_principal = :endereco_numero_principal, ";
		$strSqlCadastroInsert .= "endereco_complemento_principal = :endereco_complemento_principal, ";
		$strSqlCadastroInsert .= "bairro_principal = :bairro_principal, ";
		$strSqlCadastroInsert .= "cidade_principal = :cidade_principal, ";
		$strSqlCadastroInsert .= "estado_principal = :estado_principal, ";
		$strSqlCadastroInsert .= "pais_principal = :pais_principal, ";
		
		$strSqlCadastroInsert .= "id_config_bairro = :id_config_bairro, ";
		$strSqlCadastroInsert .= "id_config_cidade = :id_config_cidade, ";
		$strSqlCadastroInsert .= "id_config_estado = :id_config_estado, ";
		$strSqlCadastroInsert .= "id_config_regiao = :id_config_regiao, ";
		$strSqlCadastroInsert .= "id_config_pais = :id_config_pais, ";
		
		$strSqlCadastroInsert .= "id_db_cep_tblBairros = :id_db_cep_tblBairros, ";
		$strSqlCadastroInsert .= "id_db_cep_tblCidades = :id_db_cep_tblCidades, ";
		$strSqlCadastroInsert .= "id_db_cep_tblLogradouros = :id_db_cep_tblLogradouros, ";
		$strSqlCadastroInsert .= "id_db_cep_tblUF = :id_db_cep_tblUF, ";
		
		$strSqlCadastroInsert .= "cep_principal = :cep_principal, ";
		
		$strSqlCadastroInsert .= "ponto_referencia = :ponto_referencia, ";
		$strSqlCadastroInsert .= "email_principal = :email_principal, ";
		$strSqlCadastroInsert .= "tel_ddd_principal = :tel_ddd_principal, ";
		$strSqlCadastroInsert .= "tel_principal = :tel_principal, ";
		$strSqlCadastroInsert .= "cel_ddd_principal = :cel_ddd_principal, ";
		$strSqlCadastroInsert .= "cel_principal = :cel_principal, ";
		$strSqlCadastroInsert .= "fax_ddd_principal = :fax_ddd_principal, ";
		$strSqlCadastroInsert .= "fax_principal = :fax_principal, ";
		$strSqlCadastroInsert .= "site_principal = :site_principal, ";
		$strSqlCadastroInsert .= "n_funcionarios = :n_funcionarios, ";
		$strSqlCadastroInsert .= "obs_interno = :obs_interno, ";
		
		$strSqlCadastroInsert .= "id_tb_cadastro1 = :id_tb_cadastro1, ";
		$strSqlCadastroInsert .= "id_tb_cadastro2 = :id_tb_cadastro2, ";
		$strSqlCadastroInsert .= "id_tb_cadastro3 = :id_tb_cadastro3, ";
		$strSqlCadastroInsert .= "id_tb_cadastro_status = :id_tb_cadastro_status, ";
		
		//$strSqlCadastroInsert .= "id_tb_cadastro1 = :id_tb_cadastro1, ";
		
		$strSqlCadastroInsert .= "ativacao = :ativacao, ";
		$strSqlCadastroInsert .= "ativacao1 = :ativacao1, ";
		$strSqlCadastroInsert .= "ativacao2 = :ativacao2, ";
		$strSqlCadastroInsert .= "ativacao3 = :ativacao3, ";
		$strSqlCadastroInsert .= "ativacao4 = :ativacao4, ";
		$strSqlCadastroInsert .= "ativacao_destaque = :ativacao_destaque, ";
		$strSqlCadastroInsert .= "ativacao_mala_direta = :ativacao_mala_direta, ";
		$strSqlCadastroInsert .= "usuario = :usuario, ";
		
		$strSqlCadastroInsert .= "senha = :senha, ";
		//$strSqlCadastroInsert .= "senha = PASSWORD(:senha), ";
		
		//$strSqlCadastroInsert .= "imagem = :imagem, ";
		//$strSqlCadastroInsert .= "logo = :logo, ";
		//$strSqlCadastroInsert .= "banner = :banner, ";
		//$strSqlCadastroInsert .= "mapa = :mapa, ";
		$strSqlCadastroInsert .= "mapa_online = :mapa_online, ";
		$strSqlCadastroInsert .= "palavras_chave = :palavras_chave, ";
		$strSqlCadastroInsert .= "apresentacao = :apresentacao, ";
		$strSqlCadastroInsert .= "servicos = :servicos, ";
		$strSqlCadastroInsert .= "promocoes = :promocoes, ";
		$strSqlCadastroInsert .= "condicoes_comerciais = :condicoes_comerciais, ";
		$strSqlCadastroInsert .= "formas_pagamento = :formas_pagamento, ";
		$strSqlCadastroInsert .= "horario_atendimento = :horario_atendimento, ";
		$strSqlCadastroInsert .= "situacao_atual = :situacao_atual, ";
		
		$strSqlCadastroInsert .= "informacao_complementar1 = :informacao_complementar1, ";
		$strSqlCadastroInsert .= "informacao_complementar2 = :informacao_complementar2, ";
		$strSqlCadastroInsert .= "informacao_complementar3 = :informacao_complementar3, ";
		$strSqlCadastroInsert .= "informacao_complementar4 = :informacao_complementar4, ";
		$strSqlCadastroInsert .= "informacao_complementar5 = :informacao_complementar5, ";
		$strSqlCadastroInsert .= "informacao_complementar6 = :informacao_complementar6, ";
		$strSqlCadastroInsert .= "informacao_complementar7 = :informacao_complementar7, ";
		$strSqlCadastroInsert .= "informacao_complementar8 = :informacao_complementar8, ";
		$strSqlCadastroInsert .= "informacao_complementar9 = :informacao_complementar9, ";
		$strSqlCadastroInsert .= "informacao_complementar10 = :informacao_complementar10, ";
		$strSqlCadastroInsert .= "informacao_complementar11 = :informacao_complementar11, ";
		$strSqlCadastroInsert .= "informacao_complementar12 = :informacao_complementar12, ";
		$strSqlCadastroInsert .= "informacao_complementar13 = :informacao_complementar13, ";
		$strSqlCadastroInsert .= "informacao_complementar14 = :informacao_complementar14, ";
		$strSqlCadastroInsert .= "informacao_complementar15 = :informacao_complementar15, ";
		$strSqlCadastroInsert .= "informacao_complementar16 = :informacao_complementar16, ";
		$strSqlCadastroInsert .= "informacao_complementar17 = :informacao_complementar17, ";
		$strSqlCadastroInsert .= "informacao_complementar18 = :informacao_complementar18, ";
		$strSqlCadastroInsert .= "informacao_complementar19 = :informacao_complementar19, ";
		$strSqlCadastroInsert .= "informacao_complementar20 = :informacao_complementar20, ";
		$strSqlCadastroInsert .= "informacao_complementar21 = :informacao_complementar21, ";
		$strSqlCadastroInsert .= "informacao_complementar22 = :informacao_complementar22, ";
		$strSqlCadastroInsert .= "informacao_complementar23 = :informacao_complementar23, ";
		$strSqlCadastroInsert .= "informacao_complementar24 = :informacao_complementar24, ";
		$strSqlCadastroInsert .= "informacao_complementar25 = :informacao_complementar25, ";
		$strSqlCadastroInsert .= "informacao_complementar26 = :informacao_complementar26, ";
		$strSqlCadastroInsert .= "informacao_complementar27 = :informacao_complementar27, ";
		$strSqlCadastroInsert .= "informacao_complementar28 = :informacao_complementar28, ";
		$strSqlCadastroInsert .= "informacao_complementar29 = :informacao_complementar29, ";
		$strSqlCadastroInsert .= "informacao_complementar30 = :informacao_complementar30, ";
		$strSqlCadastroInsert .= "informacao_complementar31 = :informacao_complementar31, ";
		$strSqlCadastroInsert .= "informacao_complementar32 = :informacao_complementar32, ";
		$strSqlCadastroInsert .= "informacao_complementar33 = :informacao_complementar33, ";
		$strSqlCadastroInsert .= "informacao_complementar34 = :informacao_complementar34, ";
		$strSqlCadastroInsert .= "informacao_complementar35 = :informacao_complementar35, ";
		$strSqlCadastroInsert .= "informacao_complementar36 = :informacao_complementar36, ";
		$strSqlCadastroInsert .= "informacao_complementar37 = :informacao_complementar37, ";
		$strSqlCadastroInsert .= "informacao_complementar38 = :informacao_complementar38, ";
		$strSqlCadastroInsert .= "informacao_complementar39 = :informacao_complementar39, ";
		$strSqlCadastroInsert .= "informacao_complementar40 = :informacao_complementar40, ";

		$strSqlCadastroInsert .= "n_visitas = :n_visitas, ";
		$strSqlCadastroInsert .= "origem_cadastro = :origem_cadastro ";
		//----------

		
		//Componentes.
		//----------
		$statementCadastroInsert = $GLOBALS['dbSistemaConPDO']->prepare($strSqlCadastroInsert);
		
		if ($statementCadastroInsert !== false)
		{
			$statementCadastroInsert->execute(array(
				"id" => $tbCadastroId,
				"id_tb_categorias" => $tbCadastroIdTbCategorias,
				"data_cadastro" => $tbCadastroDataCadastro,
				"pf_pj" => $tbCadastroPfPj,		
				"nome" => $tbCadastroNome,
				"sexo" => $tbCadastroSexo,
				"altura" => $tbCadastroAltura,
				"peso" => $tbCadastroPeso,
				"razao_social" => $tbCadastroRazaoSocial,
				"nome_fantasia" => $tbCadastroNomeFantasia,
				"data_nascimento" => $tbCadastroDataNascimento,
				"data1" => $tbCadastroData1,
				"data2" => $tbCadastroData2,
				"data3" => $tbCadastroData3,
				"data4" => $tbCadastroData4,
				"data5" => $tbCadastroData5,
				"data6" => $tbCadastroData6,
				"data7" => $tbCadastroData7,
				"data8" => $tbCadastroData8,
				"data9" => $tbCadastroData9,
				"data10" => $tbCadastroData10,
				"cpf_" => $tbCadastroCPF,
				"rg_" => $tbCadastroRG,
				"cnpj_" => $tbCadastroCNPJ,
				"documento" => $tbCadastroDocumento,
				"i_municipal" => $tbCadastroIMunicipal,
				"i_estadual" => $tbCadastroIEstadual,
				"endereco_principal" => $tbCadastroEnderecoPrincipal,
				"endereco_numero_principal" => $tbCadastroEnderecoNumeroPrincipal,
				"endereco_complemento_principal" => $tbCadastroEnderecoComplementoPrincipal,
				"bairro_principal" => $tbCadastroBairroPrincipal,
				"cidade_principal" => $tbCadastroCidadePrincipal,
				"estado_principal" => $tbCadastroEstadoPrincipal,
				"pais_principal" => $tbCadastroPaisPrincipal,
				"id_config_bairro" => 0,
				"id_config_cidade" => 0,
				"id_config_estado" => 0,
				"id_config_regiao" => 0,
				"id_config_pais" => 0,
				"id_db_cep_tblBairros" => 0,
				"id_db_cep_tblCidades" => 0,
				"id_db_cep_tblLogradouros" => 0,
				"id_db_cep_tblUF" => '',
				"cep_principal" => $tbCadastroCepPrincipal,
				"ponto_referencia" => $tbCadastroPontoReferencia,
				"email_principal" => $tbCadastroEmailPrincipal,
				"tel_ddd_principal" => $tbCadastroTelDDDPrincipal,
				"tel_principal" => $tbCadastroTelPrincipal,
				"cel_ddd_principal" => $tbCadastroCelDDDPrincipal,
				"cel_principal" => $tbCadastroCelPrincipal,
				"fax_ddd_principal" => $tbCadastroFaxDDDPrincipal,
				"fax_principal" => $tbCadastroFaxPrincipal,
				"site_principal" => $tbCadastroSitePrincipal,
				"n_funcionarios" => $tbCadastroNFuncionarios,
				"obs_interno" => $tbCadastroOBSInterno,
				"id_tb_cadastro1" => $tbCadastroIdTbCadastro1,
				"id_tb_cadastro2" => $tbCadastroIdTbCadastro2,
				"id_tb_cadastro3" => $tbCadastroIdTbCadastro3,
				"id_tb_cadastro_status" => $tbCadastroIdTbCadastroStatus,
				"ativacao" => $tbCadastroAtivacao,
				"ativacao1" => 0,
				"ativacao2" => 0,
				"ativacao3" => 0,
				"ativacao4" => 0,
				"ativacao_destaque" => $tbCadastroAtivacaoDestaque,
				"ativacao_mala_direta" => $tbCadastroAtivacaoMalaDireta,
				"usuario" => $tbCadastroUsuario,
				"senha" => $tbCadastroSenha,
				"mapa_online" => $tbCadastroMapaOnline,
				"palavras_chave" => $tbCadastroPalavrasChave,
				"apresentacao" => $tbCadastroApresentacao,
				"servicos" => $tbCadastroServicos,
				"promocoes" => $tbCadastroPromocoes,
				"condicoes_comerciais" => $tbCadastroCondicoesComerciais,
				"formas_pagamento" => $tbCadastroFormasPagamento,
				"horario_atendimento" => $tbCadastroHorarioAtendimento,
				"situacao_atual" => $tbCadastroSituacaoAtual,		
				"informacao_complementar1" => $tbCadastroIC1,
				"informacao_complementar2" => $tbCadastroIC2,
				"informacao_complementar3" => $tbCadastroIC3,
				"informacao_complementar4" => $tbCadastroIC4,
				"informacao_complementar5" => $tbCadastroIC5,
				"informacao_complementar6" => $tbCadastroIC6,
				"informacao_complementar7" => $tbCadastroIC7,
				"informacao_complementar8" => $tbCadastroIC8,
				"informacao_complementar9" => $tbCadastroIC9,
				"informacao_complementar10" => $tbCadastroIC10,
				"informacao_complementar11" => $tbCadastroIC11,
				"informacao_complementar12" => $tbCadastroIC12,
				"informacao_complementar13" => $tbCadastroIC13,
				"informacao_complementar14" => $tbCadastroIC14,
				"informacao_complementar15" => $tbCadastroIC15,
				"informacao_complementar16" => $tbCadastroIC16,
				"informacao_complementar17" => $tbCadastroIC17,
				"informacao_complementar18" => $tbCadastroIC18,
				"informacao_complementar19" => $tbCadastroIC19,
				"informacao_complementar20" => $tbCadastroIC20,
				"informacao_complementar21" => $tbCadastroIC21,
				"informacao_complementar22" => $tbCadastroIC22,
				"informacao_complementar23" => $tbCadastroIC23,
				"informacao_complementar24" => $tbCadastroIC24,
				"informacao_complementar25" => $tbCadastroIC25,
				"informacao_complementar26" => $tbCadastroIC26,
				"informacao_complementar27" => $tbCadastroIC27,
				"informacao_complementar28" => $tbCadastroIC28,
				"informacao_complementar29" => $tbCadastroIC29,
				"informacao_complementar30" => $tbCadastroIC30,
				"informacao_complementar31" => $tbCadastroIC31,
				"informacao_complementar32" => $tbCadastroIC32,
				"informacao_complementar33" => $tbCadastroIC33,
				"informacao_complementar34" => $tbCadastroIC34,
				"informacao_complementar35" => $tbCadastroIC35,
				"informacao_complementar36" => $tbCadastroIC36,
				"informacao_complementar37" => $tbCadastroIC37,
				"informacao_complementar38" => $tbCadastroIC38,
				"informacao_complementar39" => $tbCadastroIC39,
				"informacao_complementar40" => $tbCadastroIC40,
				"n_visitas" => $tbCadastroNVisitas,
				"origem_cadastro" => $tbCadastroOrigemCadastro
			));
			
			//$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus2");
			$strRetorno = true;
		}else{
			//echo "erro";
			//$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus3");
		}
		//----------
		
		//Limpeza de objetos.
		//----------
		unset($strSqlCadastroInsert);
		unset($statementCadastroInsert);
		//----------


		return $strRetorno;
	}
	//**************************************************************************************
	
	
    //Função de endereço complementar.
    //**************************************************************************************
    function CadastroEnderecosInsert($_cadastroEnderecosId, 
	$_cadastroEnderecosIdTbCadastro, 
	$_cadastroEnderecosTipoEndereco, 
	$_cadastroEnderecosDataEndereco, 
	$_cadastroEnderecosHorario, 
	$_cadastroEnderecosEnderecoTitulo, 
	$_cadastroEnderecosEnderecoDescricao, 
	$_cadastroEnderecosEnderecoSite, 
	$_cadastroEnderecosEnderecoEmail, 
	$_cadastroEnderecosCEP, 
	$_cadastroEnderecosEndereco, 
	$_cadastroEnderecosEnderecoNumero, 
	$_cadastroEnderecosEnderecoComplemento, 
	$_cadastroEnderecosBairro, 
	$_cadastroEnderecosCidade, 
	$_cadastroEnderecosEstado, 
	$_cadastroEnderecosPais, 
	$_cadastroEnderecosPontoReferencia, 
	$_cadastroEnderecosMapaOnline, 
	$_cadastroEnderecosAtivacao, 
	$_cadastroEnderecosOBS)
	{
		//Variáveis.
		//----------
		$strRetorno = false;
		
		$cadastroEnderecosId = $_cadastroEnderecosId;
		if($cadastroEnderecosId == "")
		{
			$cadastroEnderecosId = ContadorUniversal::ContadorUniversalUpdate(1);
		}
		$cadastroEnderecosIdTbCadastro = $_cadastroEnderecosIdTbCadastro;
		if($cadastroEnderecosIdTbCadastro == "")
		{
			$cadastroEnderecosIdTbCadastro = 0;
		}
		$cadastroEnderecosTipoEndereco = $_cadastroEnderecosTipoEndereco;
		if($cadastroEnderecosTipoEndereco == "")
		{
			$cadastroEnderecosTipoEndereco = 0;
		}
		
		$cadastroEnderecosDataEndereco = Funcoes::DataGravacaoSql($_cadastroEnderecosDataEndereco, $GLOBALS['configSistemaFormatoData']);
		if($cadastroEnderecosDataEndereco == "")
		{
			//$cadastroEnderecosDataEndereco = NULL;	
			$cadastroEnderecosDataEndereco = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");
		}
		
		$cadastroEnderecosHorario = $_cadastroEnderecosHorario;
		$cadastroEnderecosEnderecoTitulo = Funcoes::ConteudoMascaraLeitura($_cadastroEnderecosEnderecoTitulo);
		$cadastroEnderecosEnderecoDescricao = Funcoes::ConteudoMascaraLeitura($_cadastroEnderecosEnderecoDescricao);
		$cadastroEnderecosEnderecoSite = $_cadastroEnderecosEnderecoSite;
		$cadastroEnderecosEnderecoEmail = $_cadastroEnderecosEnderecoEmail;
		$cadastroEnderecosCEP = Funcoes::SomenteNum($_cadastroEnderecosCEP);
		$cadastroEnderecosEndereco = Funcoes::ConteudoMascaraLeitura($_cadastroEnderecosEndereco);
		$cadastroEnderecosEnderecoNumero = Funcoes::ConteudoMascaraLeitura($_cadastroEnderecosEnderecoNumero);
		$cadastroEnderecosEnderecoComplemento = Funcoes::ConteudoMascaraLeitura($_cadastroEnderecosEnderecoComplemento);
		$cadastroEnderecosBairro = Funcoes::ConteudoMascaraLeitura($_cadastroEnderecosBairro);
		$cadastroEnderecosCidade = Funcoes::ConteudoMascaraLeitura($_cadastroEnderecosCidade);
		$cadastroEnderecosEstado = Funcoes::ConteudoMascaraLeitura($_cadastroEnderecosEstado);
		$cadastroEnderecosPais = Funcoes::ConteudoMascaraLeitura($_cadastroEnderecosPais);
		$cadastroEnderecosPontoReferencia = Funcoes::ConteudoMascaraLeitura($_cadastroEnderecosPontoReferencia);
		$cadastroEnderecosMapaOnline = $_cadastroEnderecosMapaOnline;
		$cadastroEnderecosAtivacao = $_cadastroEnderecosAtivacao;
		$cadastroEnderecosOBS = Funcoes::ConteudoMascaraLeitura($_cadastroEnderecosOBS);
		
		
		//Debug.
		/*
		echo "cadastroEnderecosId=" . $cadastroEnderecosId . "<br />";
		echo "cadastroEnderecosIdTbCadastro=" . $cadastroEnderecosIdTbCadastro . "<br />";
		echo "cadastroEnderecosTipoEndereco=" . $cadastroEnderecosTipoEndereco . "<br />";
		echo "cadastroEnderecosDataEndereco=" . $cadastroEnderecosDataEndereco . "<br />";
		echo "cadastroEnderecosHorario=" . $cadastroEnderecosHorario . "<br />";
		echo "cadastroEnderecosEnderecoTitulo=" . $cadastroEnderecosEnderecoTitulo . "<br />";
		echo "cadastroEnderecosEnderecoDescricao=" . $cadastroEnderecosEnderecoDescricao . "<br />";
		echo "cadastroEnderecosEnderecoSite=" . $cadastroEnderecosEnderecoSite . "<br />";
		echo "cadastroEnderecosEnderecoEmail=" . $cadastroEnderecosEnderecoEmail . "<br />";
		echo "cadastroEnderecosCEP=" . $cadastroEnderecosCEP . "<br />";
		echo "cadastroEnderecosEndereco=" . $cadastroEnderecosEndereco . "<br />";
		echo "cadastroEnderecosEnderecoNumero=" . $cadastroEnderecosEnderecoNumero . "<br />";
		echo "cadastroEnderecosEnderecoComplemento=" . $cadastroEnderecosEnderecoComplemento . "<br />";
		echo "cadastroEnderecosBairro=" . $cadastroEnderecosBairro . "<br />";
		echo "cadastroEnderecosCidade=" . $cadastroEnderecosCidade . "<br />";
		echo "cadastroEnderecosEstado=" . $cadastroEnderecosEstado . "<br />";
		echo "cadastroEnderecosPais=" . $cadastroEnderecosPais . "<br />";
		echo "cadastroEnderecosPontoReferencia=" . $cadastroEnderecosPontoReferencia . "<br />";
		echo "cadastroEnderecosMapaOnline=" . $cadastroEnderecosMapaOnline . "<br />";
		echo "cadastroEnderecosAtivacao=" . $cadastroEnderecosAtivacao . "<br />";
		echo "cadastroEnderecosOBS=" . $cadastroEnderecosOBS . "<br />";
		*/
		//----------
		
		
		//Inclusão de registro no BD.
		//----------
		$strSqlCadastroEnderecosInsert = "";
		$strSqlCadastroEnderecosInsert .= "INSERT INTO tb_cadastro_enderecos ";
		$strSqlCadastroEnderecosInsert .= "SET ";
		$strSqlCadastroEnderecosInsert .= "id = :id, ";
		
		$strSqlCadastroEnderecosInsert .= "id_tb_cadastro = :id_tb_cadastro, ";
		$strSqlCadastroEnderecosInsert .= "tipo_endereco = :tipo_endereco, ";
		$strSqlCadastroEnderecosInsert .= "data_endereco = :data_endereco, ";
		$strSqlCadastroEnderecosInsert .= "horario = :horario, ";
		$strSqlCadastroEnderecosInsert .= "endereco_titulo = :endereco_titulo, ";
		$strSqlCadastroEnderecosInsert .= "endereco_descricao = :endereco_descricao, ";
		$strSqlCadastroEnderecosInsert .= "endereco_site = :endereco_site, ";
		$strSqlCadastroEnderecosInsert .= "endereco_email = :endereco_email, ";
		
		$strSqlCadastroEnderecosInsert .= "cep = :cep, ";
		$strSqlCadastroEnderecosInsert .= "endereco = :endereco, ";
		$strSqlCadastroEnderecosInsert .= "endereco_numero = :endereco_numero, ";
		$strSqlCadastroEnderecosInsert .= "endereco_complemento = :endereco_complemento, ";
		$strSqlCadastroEnderecosInsert .= "bairro = :bairro, ";
		$strSqlCadastroEnderecosInsert .= "cidade = :cidade, ";
		$strSqlCadastroEnderecosInsert .= "estado = :estado, ";
		$strSqlCadastroEnderecosInsert .= "pais = :pais, ";
		$strSqlCadastroEnderecosInsert .= "ponto_referencia = :ponto_referencia, ";
		$strSqlCadastroEnderecosInsert .= "mapa_online = :mapa_online, ";
		$strSqlCadastroEnderecosInsert .= "ativacao = :ativacao, ";
		$strSqlCadastroEnderecosInsert .= "obs = :obs ";
		//echo "strSqlCadastroEnderecosInsert=" . $strSqlCadastroEnderecosInsert . "<br />";
		//----------
		
		
		//Criação de componentes e parâmetros.
		//----------
		//$statementHistoricoInsert = $dbSistemaConPDO->prepare($strSqlHistoricoInsert);
		$statementCadastroEnderecosInsert = $GLOBALS['dbSistemaConPDO']->prepare($strSqlCadastroEnderecosInsert);

		if ($statementCadastroEnderecosInsert !== false)
		{
			$statementCadastroEnderecosInsert->execute(array(
				"id" => $cadastroEnderecosId, 
				"id_tb_cadastro" => $cadastroEnderecosIdTbCadastro, 
				"tipo_endereco" => $cadastroEnderecosTipoEndereco, 
				"data_endereco" => $cadastroEnderecosDataEndereco, 
				"horario" => $cadastroEnderecosHorario, 
				"endereco_titulo" => $cadastroEnderecosEnderecoTitulo, 
				"endereco_descricao" => $cadastroEnderecosEnderecoDescricao, 
				"endereco_site" => $cadastroEnderecosEnderecoSite, 
				"endereco_email" => $cadastroEnderecosEnderecoEmail, 
				"cep" => $cadastroEnderecosCEP, 
				"endereco" => $cadastroEnderecosEndereco, 
				"endereco_numero" => $cadastroEnderecosEnderecoNumero, 
				"endereco_complemento" => $cadastroEnderecosEnderecoComplemento, 
				"bairro" => $cadastroEnderecosBairro, 
				"cidade" => $cadastroEnderecosCidade, 
				"estado" => $cadastroEnderecosEstado, 
				"pais" => $cadastroEnderecosPais, 
				"ponto_referencia" => $cadastroEnderecosPontoReferencia, 
				"mapa_online" => $cadastroEnderecosMapaOnline, 
				"ativacao" => $cadastroEnderecosAtivacao, 
				"obs" => $cadastroEnderecosOBS
			));
			
			//$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus2");
			//Obs: Colocar um flag de verificação de gravação.
			$strRetorno = true;
		}else{
			//echo "erro";
			//$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus3");
		}
		//----------
		
		
		//Limpeza de objetos.
		//----------
		unset($strSqlCadastroEnderecosInsert);
		unset($statementCadastroEnderecosInsert);
		//----------


		return $strRetorno;
	}
	//**************************************************************************************


    //Função de inclusão de publicação.
    //**************************************************************************************
    function InsertHistorico($_tbHistoricoId, 
	$_tbHistoricoIdParent, 
	$_tbHistoricoIdTbCadastroUsuario, 
	$_tbHistoricoDataHistorico, 
	$_tbHistoricoAssunto, 
	$_tbHistoricoHistorico, 
	$_tbHistoricoIC1, 
	$_tbHistoricoIC2, 
	$_tbHistoricoIC3, 
	$_tbHistoricoIC4, 
	$_tbHistoricoIC5, 
	$_tbHistoricoIC6, 
	$_tbHistoricoIC7, 
	$_tbHistoricoIC8, 
	$_tbHistoricoIC9, 
	$_tbHistoricoIC10, 
	$_tbHistoricoIdTbHistoricoStatus)
	{
		//Variáveis.
		//----------
		$strRetorno = false;
		
		$tbHistoricoId = $_tbHistoricoId;
		if($tbHistoricoId == "")
		{
			$tbHistoricoId = ContadorUniversal::ContadorUniversalUpdate(1);
		}
		$tbHistoricoIdParent = $_tbHistoricoIdParent;
		$tbHistoricoIdTbCadastroUsuario = $_tbHistoricoIdTbCadastroUsuario;
		if($tbHistoricoIdTbCadastroUsuario == "")
		{
			$tbHistoricoIdTbCadastroUsuario = 0;
		}
		//$tbHistoricoDataHistorico = $dataHistorico = Funcoes::DataGravacaoSql($_tbHistoricoDataHistorico, $GLOBALS['configSistemaFormatoData']) . " " . date("H") . ":" . date("i") . ":" . date("s");
		$tbHistoricoDataHistorico = Funcoes::DataGravacaoSql($tbHistoricoDataHistorico, $GLOBALS['configSistemaFormatoData']) . " " . date("H") . ":" . date("i") . ":" . date("s");
		//$dataHistorico = Funcoes::DataGravacaoSql($_POST["data_historico"], $GLOBALS['configSistemaFormatoData']) . " " . date("H") . ":" . date("i") . ":" . date("s");
		if($tbHistoricoDataHistorico == "" && $tbHistoricoDataHistorico != NULL)
		{
			//$data_publicacao = NULL;	
			$tbHistoricoDataHistorico = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");	
		}
		$tbHistoricoAssunto = Funcoes::ConteudoMascaraLeitura($_tbHistoricoAssunto);
		$tbHistoricoHistorico = Funcoes::ConteudoMascaraLeitura($_tbHistoricoHistorico);
		$tbHistoricoIC1 = Funcoes::ConteudoMascaraLeitura($_tbHistoricoIC1);
		$tbHistoricoIC2 = Funcoes::ConteudoMascaraLeitura($_tbHistoricoIC2);
		$tbHistoricoIC3 = Funcoes::ConteudoMascaraLeitura($_tbHistoricoIC3);
		$tbHistoricoIC4 = Funcoes::ConteudoMascaraLeitura($_tbHistoricoIC4);
		$tbHistoricoIC5 = Funcoes::ConteudoMascaraLeitura($_tbHistoricoIC5);
		$tbHistoricoIC6 = Funcoes::ConteudoMascaraLeitura($_tbHistoricoIC6);
		$tbHistoricoIC7 = Funcoes::ConteudoMascaraLeitura($_tbHistoricoIC7);
		$tbHistoricoIC8 = Funcoes::ConteudoMascaraLeitura($_tbHistoricoIC8);
		$tbHistoricoIC9 = Funcoes::ConteudoMascaraLeitura($_tbHistoricoIC9);
		$tbHistoricoIC10 = Funcoes::ConteudoMascaraLeitura($_tbHistoricoIC10);
		$tbHistoricoIdTbHistoricoStatus = $_tbHistoricoIdTbHistoricoStatus;
		if($tbHistoricoIdTbHistoricoStatus == "")
		{
			$tbHistoricoIdTbHistoricoStatus = 0;
		}
		//----------


		//Inclusão de registro no BD.
		//----------
		$strSqlHistoricoInsert = "";
		$strSqlHistoricoInsert .= "INSERT INTO tb_historico ";
		$strSqlHistoricoInsert .= "SET ";
		$strSqlHistoricoInsert .= "id = :id, ";
		$strSqlHistoricoInsert .= "id_parent = :id_parent, ";
		$strSqlHistoricoInsert .= "id_tb_cadastro_usuario = :id_tb_cadastro_usuario, ";
		$strSqlHistoricoInsert .= "data_historico = :data_historico, ";
		$strSqlHistoricoInsert .= "assunto = :assunto, ";
		$strSqlHistoricoInsert .= "historico = :historico, ";
		$strSqlHistoricoInsert .= "informacao_complementar1 = :informacao_complementar1, ";
		$strSqlHistoricoInsert .= "informacao_complementar2 = :informacao_complementar2, ";
		$strSqlHistoricoInsert .= "informacao_complementar3 = :informacao_complementar3, ";
		$strSqlHistoricoInsert .= "informacao_complementar4 = :informacao_complementar4, ";
		$strSqlHistoricoInsert .= "informacao_complementar5 = :informacao_complementar5, ";
		$strSqlHistoricoInsert .= "informacao_complementar6 = :informacao_complementar6, ";
		$strSqlHistoricoInsert .= "informacao_complementar7 = :informacao_complementar7, ";
		$strSqlHistoricoInsert .= "informacao_complementar8 = :informacao_complementar8, ";
		$strSqlHistoricoInsert .= "informacao_complementar9 = :informacao_complementar9, ";
		$strSqlHistoricoInsert .= "informacao_complementar10 = :informacao_complementar10, ";
		$strSqlHistoricoInsert .= "id_tb_historico_status = :id_tb_historico_status ";
		//----------
		
		
		//Criação de componentes e parâmetros.
		//----------
		//$statementHistoricoInsert = $dbSistemaConPDO->prepare($strSqlHistoricoInsert);
		$statementHistoricoInsert = $GLOBALS['dbSistemaConPDO']->prepare($strSqlHistoricoInsert);

		if ($statementHistoricoInsert !== false)
		{
			$statementHistoricoInsert->execute(array(
				"id" => $tbHistoricoId,
				"id_parent" => $tbHistoricoIdParent,
				"id_tb_cadastro_usuario" => $tbHistoricoIdTbCadastroUsuario,
				"data_historico" => $tbHistoricoDataHistorico,
				"assunto" => $tbHistoricoAssunto,
				"historico" => $tbHistoricoHistorico,
				"informacao_complementar1" => $tbHistoricoIC1,
				"informacao_complementar2" => $tbHistoricoIC2,
				"informacao_complementar3" => $tbHistoricoIC3,
				"informacao_complementar4" => $tbHistoricoIC4,
				"informacao_complementar5" => $tbHistoricoIC5,
				"informacao_complementar6" => $tbHistoricoIC6,
				"informacao_complementar7" => $tbHistoricoIC7,
				"informacao_complementar8" => $tbHistoricoIC8,
				"informacao_complementar9" => $tbHistoricoIC9,
				"informacao_complementar10" => $tbHistoricoIC10,
				"id_tb_historico_status" => $idTbHistoricoStatus
			));
			
			//$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus2");
			//Obs: Colocar um flag de verificação de gravação.
			$strRetorno = true;
		}else{
			//echo "erro";
			//$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus3");
		}
		//----------
		
		
		//Limpeza de objetos.
		//----------
		unset($strSqlHistoricoInsert);
		unset($statementHistoricoInsert);
		//----------

	
		return $strRetorno;
	}
	//**************************************************************************************

	
	//Função para gravar log de itens.
	//**************************************************************************************
	function LogInsert($_idRegistro, 
	$_idTbCadastro, 
	$_strTabela, 
	$_logTipo, 
	$_logAcao, 
	$_strDescricao, 
	$_informacaoComplementar1, 
	$_informacaoComplementar2, 
	$_informacaoComplementar3, 
	$_informacaoComplementar4, 
	$_informacaoComplementar5)
	{
		$strRetorno = false;
		$idContadorUniversal = ContadorUniversal::ContadorUniversalUpdate(1);
		$logData = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");
		$logIp = "";
		$countEnvio = 1;
	
		//Inclusão de registro no BD.
		//----------
		$strSqlLogInsert = "";
		$strSqlLogInsert .= "INSERT INTO tb_log ";
		$strSqlLogInsert .= "SET ";
		$strSqlLogInsert .= "id = :id, ";
		$strSqlLogInsert .= "id_registro = :id_registro, ";
		$strSqlLogInsert .= "id_tb_cadastro = :id_tb_cadastro, ";
		$strSqlLogInsert .= "tabela = :tabela, ";
		$strSqlLogInsert .= "log_data = :log_data, ";
		$strSqlLogInsert .= "log_tipo = :log_tipo, ";
		$strSqlLogInsert .= "log_ip = :log_ip, ";
		$strSqlLogInsert .= "log_acao = :log_acao, ";
		$strSqlLogInsert .= "descricao = :descricao, ";
		$strSqlLogInsert .= "informacao_complementar1 = :informacao_complementar1, ";
		$strSqlLogInsert .= "informacao_complementar2 = :informacao_complementar2, ";
		$strSqlLogInsert .= "informacao_complementar3 = :informacao_complementar3, ";
		$strSqlLogInsert .= "informacao_complementar4 = :informacao_complementar4, ";
		$strSqlLogInsert .= "informacao_complementar5 = :informacao_complementar5 ";
		//echo "strSqlLogInsert=" . $strSqlLogInsert . "<br>";
		//----------


		//Criação de componentes.
		//----------
		$statementLogInsert = $GLOBALS['dbSistemaConPDO']->prepare($strSqlLogInsert);
		
		if ($statementLogInsert !== false)
		{
			$statementLogInsert->execute(array(
				"id" => $idContadorUniversal,
				"id_registro" => $_idRegistro,
				"id_tb_cadastro" => $_idTbCadastro,
				"tabela" => $_strTabela,
				"log_data" => $logData,
				"log_tipo" => $_logTipo,
				"log_ip" => $logIp,
				"log_acao" => $_logAcao,
				"descricao" => $_strDescricao,
				"informacao_complementar1" => $_informacaoComplementar1,
				"informacao_complementar2" => $_informacaoComplementar2,
				"informacao_complementar3" => $_informacaoComplementar3,
				"informacao_complementar4" => $_informacaoComplementar4,
				"informacao_complementar5" => $_informacaoComplementar5
			));
			
			//$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus2");
			$strRetorno = true;
			//echo "gravou" . "<br>";
		}else{
			//echo "erro";
			//$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus3");
			//echo "não gravou" . "<br>";
		}
		//----------


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
		unset($strSqlLogInsert);
		unset($statementLogInsert);
		//----------
		
		return $strRetorno;
	}
	//**************************************************************************************
	
	
	//Função para registro de log da enquete.
	//**************************************************************************************
	function EnquetesLogRegistrar($_idTbCadastro, 
	$_idTbEnquetes, 
	$_idTbEnquetesOpcoes)
	{
		//Variáveis.
		//-------------
		$strRetorno = false;
		$idContadorUniversal = ContadorUniversal::ContadorUniversalUpdate(1);
		$dataResposta = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");
		$idTbCategorias = "0";
		$respostaCorreta = "0";
		$countResposta = "1";
		$strSqlEnquetesLogInsert = "";
		//-------------
		
		
		//Inclusão de registro no BD.
		//----------
		$strSqlEnquetesLogInsert = "";
		$strSqlEnquetesLogInsert .= "INSERT INTO tb_enquetes_log ";
		$strSqlEnquetesLogInsert .= "SET ";
		$strSqlEnquetesLogInsert .= "id = :id, ";
		$strSqlEnquetesLogInsert .= "data_resposta = :data_resposta, ";
		$strSqlEnquetesLogInsert .= "id_tb_categorias = :id_tb_categorias, ";
		$strSqlEnquetesLogInsert .= "id_tb_cadastro = :id_tb_cadastro, ";
		$strSqlEnquetesLogInsert .= "id_tb_enquetes = :id_tb_enquetes, ";
		$strSqlEnquetesLogInsert .= "id_tb_opcoes = :id_tb_opcoes, ";
		$strSqlEnquetesLogInsert .= "resposta_correta = :resposta_correta, ";
		$strSqlEnquetesLogInsert .= "count_resposta = :count_resposta ";
		//echo "strSqlEnquetesLogInsert=" . $strSqlEnquetesLogInsert . "<br>";
		//----------


		//Criação de componentes.
		//----------
		$statementEnquetesLogInsert = $GLOBALS['dbSistemaConPDO']->prepare($strSqlEnquetesLogInsert);
		
		if ($statementEnquetesLogInsert !== false)
		{
			$statementEnquetesLogInsert->execute(array(
				"id" => $idContadorUniversal,
				"data_resposta" => $dataResposta,
				"id_tb_categorias" => $idTbCategorias,
				"id_tb_cadastro" => $_idTbCadastro,
				"id_tb_enquetes" => $_idTbEnquetes,
				"id_tb_opcoes" => $_idTbEnquetesOpcoes,
				"resposta_correta" => $respostaCorreta,
				"count_resposta" => $countResposta
			));
			
			//$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus2");
			$strRetorno = true;
			//echo "gravou" . "<br>";
		}else{
			//echo "erro";
			//$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus3");
			//echo "não gravou" . "<br>";
		}
		//----------
		
		
		//Limpeza de objetos.
		unset($strSqlEnquetesLogInsert);
		unset($statementEnquetesLogInsert);
		//----------
		
		return $strRetorno;
	}
	//**************************************************************************************
	
	
	//Função para gravar itens selecionados.
	//**************************************************************************************
	function ItensSelecionarInsert($_idItem, 
	$_nClassificacao, 
	$_idTbCadastro, 
	$_tipoCategoria, 
	$_descricao, 
	$_valorSelecao, 
	$_ativacao, 
	$_strObs)
	{
		$strRetorno = false;
		$idContadorUniversal = ContadorUniversal::ContadorUniversalUpdate(1);
		$dataSelecao = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");
	
		//Inclusão de registro no BD.
		//----------
		$strSqlItensSelecionarInsert = "";
		$strSqlItensSelecionarInsert .= "INSERT INTO tb_itens_selecao ";
		$strSqlItensSelecionarInsert .= "SET ";
		$strSqlItensSelecionarInsert .= "id = :id, ";
		$strSqlItensSelecionarInsert .= "n_classificacao = :n_classificacao, ";
		$strSqlItensSelecionarInsert .= "data_selecao = :data_selecao, ";
		$strSqlItensSelecionarInsert .= "id_tb_cadastro = :id_tb_cadastro, ";
		$strSqlItensSelecionarInsert .= "id_tb_item = :id_tb_item, ";
		$strSqlItensSelecionarInsert .= "tipo_categoria = :tipo_categoria, ";
		$strSqlItensSelecionarInsert .= "descricao = :descricao, ";
		$strSqlItensSelecionarInsert .= "valor_selecao = :valor_selecao, ";
		$strSqlItensSelecionarInsert .= "ativacao = :ativacao, ";
		$strSqlItensSelecionarInsert .= "obs = :obs ";
		//echo "strSqlItensSelecionarInsert=" . $strSqlItensSelecionarInsert . "<br>";
		//----------


		//Criação de componentes.
		//----------
		$statementItensSelecionarInsert = $GLOBALS['dbSistemaConPDO']->prepare($strSqlItensSelecionarInsert);
		
		if ($statementItensSelecionarInsert !== false)
		{
			$statementItensSelecionarInsert->execute(array(
				"id" => $idContadorUniversal,
				"n_classificacao" => $_nClassificacao,
				"data_selecao" => $dataSelecao,
				"id_tb_cadastro" => $_idTbCadastro,
				"id_tb_item" => $_idItem,
				"tipo_categoria" => $_tipoCategoria,
				"descricao" => $_descricao,
				"valor_selecao" => $_valorSelecao,
				"ativacao" => $_ativacao,
				"obs" => $_strObs
			));
			
			//$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus2");
			$strRetorno = true;
			//echo "gravou" . "<br>";
		}else{
			//echo "erro";
			//$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus3");
			//echo "não gravou" . "<br>";
		}
		//----------


		//Verificação de erro.
		/*
		echo "idTbItensEnviados=" . $idTbItensEnviados . "<br>";
		echo "dataEnvio=" . $dataEnvio . "<br>";
		echo "_idTbCadastroRemetente=" . $_idTbCadastroRemetente . "<br>";
		echo "_idTbCadastroDestinatario=" . $_idTbCadastroDestinatario . "<br>";
		echo "_idItem=" . $_idItem . "<br>";
		*/
		
		
		//Limpeza de objetos.
		unset($strSqlItensSelecionarInsert);
		unset($statementItensSelecionarInsert);
		//----------
		
		return $strRetorno;
	}
	//**************************************************************************************


	//Função para gravar registro de fluxo.
	//**************************************************************************************
	function FluxoInsert($_idRegistro, 
	$_idTbCategorias, 
	$_debitoCredito, 
	$_tabela, 
	$_idTbCadastro, 
	$_idTbCadastroUsuario, 
	$_lancamento, 
	$_idTbFluxoTipo, 
	$_idTbFluxoStatus, 
	$_valor, 
	$_nDocumento, 
	$_autenticacao, 
	$_informacaoComplementar1, 
	$_informacaoComplementar2, 
	$_informacaoComplementar3, 
	$_informacaoComplementar4, 
	$_informacaoComplementar5, 
	$_informacaoComplementar6, 
	$_informacaoComplementar7, 
	$_informacaoComplementar8, 
	$_informacaoComplementar9, 
	$_informacaoComplementar10, 
	$_obs, 
	$_ativacao, 
	$_ativacaoContabilizacao)
	{
		
		//Resgate de variáveis
		$strRetorno = false;
		$idContadorUniversal = ContadorUniversal::ContadorUniversalUpdate(1);
		$idTbCategorias = $_idTbCategorias;
		
		//$dataPublicacao = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");
		//$dataLancamento = Funcoes::DataGravacaoSql($_POST["data_lancamento"], $GLOBALS['configSistemaFormatoData']);
		//if($dataLancamento == "")
		//{
			//$data_publicacao = NULL;	
			$dataLancamento = date("Y") . "-" . date("m") . "-" . date("d");
		//}
		
		//$dataContabilizacao = Funcoes::DataGravacaoSql($_POST["data_contabilizacao"], $GLOBALS['configSistemaFormatoData']);
		//if($dataContabilizacao == "")
		//{
			//$dataContabilizacao = NULL;	
			$dataContabilizacao = date("Y") . "-" . date("m") . "-" . date("d");
		//}
		
		
		$debitoCredito = $_debitoCredito;
		$idItem = $_idRegistro;
		if($idItem == "")
		{
			$idItem = 0;
		}
		
		$tabela = $_tabela;
		
		$idTbCadastro = $_idTbCadastro;
		if($idTbCadastro == "")
		{
			$idTbCadastro = 0;
		}
		
		$idTbCadastroUsuario = $_idTbCadastroUsuario;
		if($idTbCadastroUsuario == "")
		{
			$idTbCadastroUsuario = 0;
		}
		
		
		$lancamento = Funcoes::ConteudoMascaraGravacao01($_lancamento);
		$idTbFluxoTipo = $_idTbFluxoTipo;
		$idTbFluxoStatus = $_idTbFluxoStatus;
		//$valor = $_POST["valor"];
		$valor = Funcoes::MascaraValorGravar($_valor);
		$nDocumento = Funcoes::ConteudoMascaraGravacao01($_nDocumento);
		$autenticacao = Funcoes::ConteudoMascaraGravacao01($_autenticacao);
		
		$informacaoComplementar1 = Funcoes::ConteudoMascaraGravacao01($_informacaoComplementar1);
		$informacaoComplementar2 = Funcoes::ConteudoMascaraGravacao01($_informacaoComplementar2);
		$informacaoComplementar3 = Funcoes::ConteudoMascaraGravacao01($_informacaoComplementar3);
		$informacaoComplementar4 = Funcoes::ConteudoMascaraGravacao01($_informacaoComplementar4);
		$informacaoComplementar5 = Funcoes::ConteudoMascaraGravacao01($_informacaoComplementar5);
		$informacaoComplementar6 = Funcoes::ConteudoMascaraGravacao01($_informacaoComplementar6);
		$informacaoComplementar7 = Funcoes::ConteudoMascaraGravacao01($_informacaoComplementar7);
		$informacaoComplementar8 = Funcoes::ConteudoMascaraGravacao01($_informacaoComplementar8);
		$informacaoComplementar9 = Funcoes::ConteudoMascaraGravacao01($_informacaoComplementar9);
		$informacaoComplementar10 = Funcoes::ConteudoMascaraGravacao01($_informacaoComplementar10);
		
		$obs = Funcoes::ConteudoMascaraGravacao01($_obs);
		
		$ativacao = $_ativacao;
		$ativacaoContabilizacao = $_ativacaoContabilizacao;
		
		
		//Montagem do query.
		//----------
		$strSqlFluxoInsert = "";
		$strSqlFluxoInsert .= "INSERT INTO tb_fluxo ";
		$strSqlFluxoInsert .= "SET ";
		$strSqlFluxoInsert .= "id = :id, ";
		$strSqlFluxoInsert .= "id_tb_categorias = :id_tb_categorias, ";
		$strSqlFluxoInsert .= "data_lancamento = :data_lancamento, ";
		$strSqlFluxoInsert .= "data_contabilizacao = :data_contabilizacao, ";
		$strSqlFluxoInsert .= "debito_credito = :debito_credito, ";
		$strSqlFluxoInsert .= "id_item = :id_item, ";
		$strSqlFluxoInsert .= "tabela = :tabela, ";
		$strSqlFluxoInsert .= "id_tb_cadastro = :id_tb_cadastro, ";
		$strSqlFluxoInsert .= "id_tb_cadastro_usuario = :id_tb_cadastro_usuario, ";
		$strSqlFluxoInsert .= "id_tb_cadastro1 = :id_tb_cadastro1, ";
		$strSqlFluxoInsert .= "id_tb_cadastro2 = :id_tb_cadastro2, ";
		$strSqlFluxoInsert .= "id_tb_cadastro3 = :id_tb_cadastro3, ";
		
		$strSqlFluxoInsert .= "lancamento = :lancamento, ";
		$strSqlFluxoInsert .= "id_tb_fluxo_tipo = :id_tb_fluxo_tipo, ";
		$strSqlFluxoInsert .= "id_tb_fluxo_status = :id_tb_fluxo_status, ";
		
		$strSqlFluxoInsert .= "valor = :valor, ";
		$strSqlFluxoInsert .= "valor1 = :valor1, ";
		$strSqlFluxoInsert .= "valor2 = :valor2, ";
		$strSqlFluxoInsert .= "valor3 = :valor3, ";
		$strSqlFluxoInsert .= "valor4 = :valor4, ";
		$strSqlFluxoInsert .= "valor5 = :valor5, ";
		
		$strSqlFluxoInsert .= "n_documento = :n_documento, ";
		$strSqlFluxoInsert .= "autenticacao = :autenticacao, ";
		
		$strSqlFluxoInsert .= "informacao_complementar1 = :informacao_complementar1, ";
		$strSqlFluxoInsert .= "informacao_complementar2 = :informacao_complementar2, ";
		$strSqlFluxoInsert .= "informacao_complementar3 = :informacao_complementar3, ";
		$strSqlFluxoInsert .= "informacao_complementar4 = :informacao_complementar4, ";
		$strSqlFluxoInsert .= "informacao_complementar5 = :informacao_complementar5, ";
		$strSqlFluxoInsert .= "informacao_complementar6 = :informacao_complementar6, ";
		$strSqlFluxoInsert .= "informacao_complementar7 = :informacao_complementar7, ";
		$strSqlFluxoInsert .= "informacao_complementar8 = :informacao_complementar8, ";
		$strSqlFluxoInsert .= "informacao_complementar9 = :informacao_complementar9, ";
		$strSqlFluxoInsert .= "informacao_complementar10 = :informacao_complementar10, ";
		
		$strSqlFluxoInsert .= "obs = :obs, ";
		$strSqlFluxoInsert .= "ativacao = :ativacao, ";
		$strSqlFluxoInsert .= "ativacao_contabilizacao = :ativacao_contabilizacao ";
		//----------
		
		
		//Parametros e execução.
		//----------
		$statementFluxoInsert = $GLOBALS['dbSistemaConPDO']->prepare($strSqlFluxoInsert);
		
		if ($statementFluxoInsert !== false)
		{
			$statementFluxoInsert->execute(array(
				"id" => $idContadorUniversal,
				"id_tb_categorias" => $idTbCategorias,
				"data_contabilizacao" => $dataContabilizacao,
				"data_lancamento" => $dataLancamento,
				"debito_credito" => $debitoCredito,
				"id_item" => $idItem,
				"tabela" => $tabela,
				"id_tb_cadastro" => $idTbCadastro,
				"id_tb_cadastro_usuario" => $idTbCadastroUsuario,
				"id_tb_cadastro1" => 0,
				"id_tb_cadastro2" => 0,
				"id_tb_cadastro3" => 0,
				"lancamento" => $lancamento,
				"id_tb_fluxo_tipo" => $idTbFluxoTipo,
				"id_tb_fluxo_status" => $idTbFluxoStatus,
				"valor" => $valor,
				"valor1" => 0,
				"valor2" => 0,
				"valor3" => 0,
				"valor4" => 0,
				"valor5" => 0,
				"n_documento" => $nDocumento,
				"autenticacao" => $autenticacao,
				"informacao_complementar1" => $informacaoComplementar1,
				"informacao_complementar2" => $informacaoComplementar2,
				"informacao_complementar3" => $informacaoComplementar3,
				"informacao_complementar4" => $informacaoComplementar4,
				"informacao_complementar5" => $informacaoComplementar5,
				"informacao_complementar6" => $informacaoComplementar6,
				"informacao_complementar7" => $informacaoComplementar7,
				"informacao_complementar8" => $informacaoComplementar8,
				"informacao_complementar9" => $informacaoComplementar9,
				"informacao_complementar10" => $informacaoComplementar10,
				"obs" => $obs,
				"ativacao" => $ativacao,
				"ativacao_contabilizacao" => $ativacaoContabilizacao
			));
			
			//$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus2");
			$strRetorno = true;
		}else{
			//echo "erro";
			//$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus3");
		}
		//----------
		
		
		//Verificação de erro - debug.
		/*
		echo "id=" . $id . "<br />";
		echo "id_tb_categorias=" . $idTbCategorias . "<br />";
		echo "data_lancamento=" . $dataLancamento . "<br />";
		echo "dataContabilizacao=" . $dataContabilizacao . "<br />";
		print "dataContabilizacao=" . $dataContabilizacao . "<br />";
		print_r("dataContabilizacao=" . $dataContabilizacao . "<br />");
		echo "debitoCredito=" . $debitoCredito . "<br />";
		echo "id_item=" . $idItem . "<br />";
		echo "ativacao_contabilizacao=" . $ativacaoContabilizacao . "<br />";
		*/
		
		
		//Limpeza de objetos.
		//----------
		unset($strSqlFluxoInsert);
		unset($statementFluxoInsert);
		//----------
		
		
		return $strRetorno;
	}
	//**************************************************************************************
	
	
	//Função para inclusão de itens.
	//**************************************************************************************
	function PedidosInsert($_tbPedidosIdCePedidos, 
	$_tbPedidosIdTbCadastroCliente, 
	$_tbPedidosIdTbCadastroEnderecos, 
	$_tbPedidosIdTbCadastroCartoes, 
	$_tbPedidosIdTbCadastroUsuario, 
	$_tbPedidosTipoPagamento, 
	$_tbPedidosDataPedido, 
	$_tbPedidosDataPagamento, 
	$_tbPedidosDataEntrega, 
	$_tbPedidosDataValidade, 
	$_tbPedidosValorPedido, 
	$_tbPedidosValorFrete, 
	$_tbPedidosPeriodoContratacao, 
	$_tbPedidosTipoEntrega, 
	$_tbPedidosValorDesconto, 
	$_tbPedidosValorAcrescimo, 
	$_tbPedidosValorTotal, 
	$_tbPedidosPesoTotal, 
	$_tbPedidosIdTbCadastro1, 
	$_tbPedidosIdTbCadastro2, 
	$_tbPedidosIdTbCadastro3, 
	$_tbPedidosIdTbCadastro4, 
	$_tbPedidosIdTbCadastro5, 
	$_tbPedidosOBS, 
	$_tbPedidosAtivacao, 
	$_tbPedidosIC1, 
	$_tbPedidosIC2, 
	$_tbPedidosIC3, 
	$_tbPedidosIC4, 
	$_tbPedidosIC5, 
	$_tbPedidosIdCeComplementoStatus)
	{
		//Criação de algumas variáveis.
		//----------
		$strRetorno = false;
		
		
		$tbPedidosIdCePedidos = $_tbPedidosIdCePedidos;
		if($tbPedidosIdCePedidos == "")
		{
			$tbPedidosIdCePedidos = ContadorUniversal::ContadorUniversalUpdate(1);
		}

		$tbPedidosIdTbCadastroCliente = $_tbPedidosIdTbCadastroCliente;
		$tbPedidosIdTbCadastroEnderecos = $_tbPedidosIdTbCadastroEnderecos;
		if($tbPedidosIdTbCadastroEnderecos == "")
		{
			$tbPedidosIdTbCadastroEnderecos = 0;
		}
		
		$tbPedidosIdTbCadastroCartoes = $_tbPedidosIdTbCadastroCartoes;
		if($tbPedidosIdTbCadastroCartoes == "")
		{
			$tbPedidosIdTbCadastroCartoes = 0;
		}
		
		$tbPedidosIdTbCadastroUsuario = $_tbPedidosIdTbCadastroUsuario;
		if($tbPedidosIdTbCadastroUsuario == "")
		{
			$tbPedidosIdTbCadastroUsuario = 0;
		}
		
		$tbPedidosTipoPagamento = Funcoes::ConteudoMascaraGravacao01($_tbPedidosTipoPagamento);
		
		//$dataPedido = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");
		if($GLOBALS['habilitarEdicaoPedidosData'] == 1)
		{
			if($_tbPedidosDataPedido == "")
			{
				//$dataPedido = DbFuncoes::GetCampoGenerico01($id, "ce_pedidos", "data_pedido");
				$tbPedidosDataPedido = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");
			}else{
				$tbPedidosDataPedido = Funcoes::DataGravacaoSql($_tbPedidosDataPedido, $GLOBALS['configSistemaFormatoData']) . " " . date("H") . ":" . date("i") . ":" . date("s");
			}
		}else{
			$tbPedidosDataPedido = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");
		}	
		
		$tbPedidosDataPagamento = Funcoes::DataGravacaoSql($_tbPedidosDataPagamento, $GLOBALS['configSistemaFormatoData']);
		if($tbPedidosDataPagamento == "")
		{
			$tbPedidosDataPagamento = NULL;	
		}
		
		$tbPedidosDataEntrega = Funcoes::DataGravacaoSql($_tbPedidosDataEntrega, $GLOBALS['configSistemaFormatoData']);
		if($tbPedidosDataEntrega == "")
		{
			$tbPedidosDataEntrega = NULL;	
		}
		
		$tbPedidosDataValidade = Funcoes::DataGravacaoSql($_tbPedidosDataValidade, $GLOBALS['configSistemaFormatoData']);
		if($tbPedidosDataValidade == "")
		{
			$tbPedidosDataValidade = NULL;	
		}
		
		$tbPedidosValorPedido = Funcoes::MascaraValorGravar($_tbPedidosValorPedido);
		if($tbPedidosValorPedido == "")
		{
			$tbPedidosValorPedido = 0;
		}
		
		$tbPedidosValorFrete = Funcoes::MascaraValorGravar($_tbPedidosValorFrete);
		if($tbPedidosValorFrete == "")
		{
			$tbPedidosValorFrete = 0;
		}
		
		$tbPedidosPeriodoContratacao = $_tbPedidosPeriodoContratacao;
		$tbPedidosTipoEntrega = Funcoes::ConteudoMascaraGravacao01($_tbPedidosTipoEntrega);
		
		$tbPedidosValorDesconto = Funcoes::MascaraValorGravar($_tbPedidosValorDesconto);
		if($tbPedidosValorDesconto == "")
		{
			$tbPedidosValorDesconto = 0;
		}
		
		$tbPedidosValorAcrescimo = Funcoes::MascaraValorGravar($_tbPedidosValorAcrescimo);
		if($tbPedidosValorAcrescimo == "")
		{
			$tbPedidosValorAcrescimo = 0;
		}
		
		$tbPedidosValorTotal = Funcoes::MascaraValorGravar($_tbPedidosValorTotal);
		if($tbPedidosValorTotal == "")
		{
			$tbPedidosValorTotal = 0;
		}
		
		$tbPedidosPesoTotal = Funcoes::MascaraValorGravar($_tbPedidosPesoTotal);
		if($tbPedidosPesoTotal == "")
		{
			$tbPedidosPesoTotal = 0;
		}
		
		/*
		$enderecoEntrega = Funcoes::ConteudoMascaraGravacao01($_POST["endereco_entrega"]);
		$enderecoNumeroEntrega = Funcoes::ConteudoMascaraGravacao01($_POST["endereco_numero_entrega"]);
		$enderecoComplementoEntrega = Funcoes::ConteudoMascaraGravacao01($_POST["endereco_complemento_entrega"]);
		$bairroEntrega = Funcoes::ConteudoMascaraGravacao01($_POST["bairro_entrega"]);
		$cidadeEntrega = Funcoes::ConteudoMascaraGravacao01($_POST["cidade_entrega"]);
		$cidadeEntrega = Funcoes::ConteudoMascaraGravacao01($_POST["cidade_entrega"]);
		$paisEntrega = Funcoes::ConteudoMascaraGravacao01($_POST["pais_entrega"]);
		$cepEntrega = Funcoes::SomenteNum($_POST["cep_entrega"]);
		*/
		
		$tbPedidosIdTbCadastro1 = $_tbPedidosIdTbCadastro1;
		if($tbPedidosIdTbCadastro1 == "")
		{
			$tbPedidosIdTbCadastro1 = 0;
		}
		$tbPedidosIdTbCadastro2 = $_tbPedidosIdTbCadastro2;
		if($tbPedidosIdTbCadastro2 == "")
		{
			$tbPedidosIdTbCadastro2 = 0;
		}
		$tbPedidosIdTbCadastro3 = $_tbPedidosIdTbCadastro3;
		if($tbPedidosIdTbCadastro3 == "")
		{
			$tbPedidosIdTbCadastro3 = 0;
		}
		$tbPedidosIdTbCadastro4 = $_tbPedidosIdTbCadastro4;
		if($tbPedidosIdTbCadastro4 == "")
		{
			$tbPedidosIdTbCadastro4 = 0;
		}
		$tbPedidosIdTbCadastro5 = $_tbPedidosIdTbCadastro5;
		if($tbPedidosIdTbCadastro5 == "")
		{
			$tbPedidosIdTbCadastro5 = 0;
		}
		
		$tbPedidosOBS = Funcoes::ConteudoMascaraGravacao01($_tbPedidosOBS);
		$tbPedidosAtivacao = $_tbPedidosAtivacao;
		
		$tbPedidosIC1 = Funcoes::ConteudoMascaraGravacao01($_tbPedidosIC1);
		$tbPedidosIC2 = Funcoes::ConteudoMascaraGravacao01($_tbPedidosIC2);
		$tbPedidosIC3 = Funcoes::ConteudoMascaraGravacao01($_tbPedidosIC3);
		$tbPedidosIC4 = Funcoes::ConteudoMascaraGravacao01($_tbPedidosIC4);
		$tbPedidosIC5 = Funcoes::ConteudoMascaraGravacao01($_tbPedidosIC5);
		
		$tbPedidosIdCeComplementoStatus = $_tbPedidosIdCeComplementoStatus;
		if($tbPedidosIdCeComplementoStatus == "")
		{
			$tbPedidosIdCeComplementoStatus = 0;
		}
		
		/*
		$tbPedidosTransacaoExternaStatus = $_tbPedidosTransacaoExternaStatus;
		$tbPedidosTransacaoExternaAutenticacao = $_tbPedidosTransacaoExternaAutenticacao;
		$tbPedidosTransacaoExternaLog = $_tbPedidosTransacaoExternaLog;
		
		//$transacaoExternaDataPagamentoLiberado = $_POST["transacao_externa_data_pagamento_liberado"];
		$tbPedidosTransacaoExternaDataPagamentoLiberado = Funcoes::DataGravacaoSql($_tbPedidosTransacaoExternaDataPagamentoLiberado, $GLOBALS['configSistemaFormatoData']);
		if($tbPedidosTransacaoExternaDataPagamentoLiberado == "")
		{
			$tbPedidosTransacaoExternaDataPagamentoLiberado = NULL;	
		}
		*/
		//----------


		//Inclusão de registro no BD.
		//----------
		$strSqlPedidosInsert = "";
		$strSqlPedidosInsert .= "INSERT INTO ce_pedidos ";
		$strSqlPedidosInsert .= "SET ";
		$strSqlPedidosInsert .= "id = :id, ";
		$strSqlPedidosInsert .= "id_tb_cadastro_cliente = :id_tb_cadastro_cliente, ";
		$strSqlPedidosInsert .= "id_tb_cadastro_enderecos = :id_tb_cadastro_enderecos, ";
		$strSqlPedidosInsert .= "id_tb_cadastro_cartoes = :id_tb_cadastro_cartoes, ";
		$strSqlPedidosInsert .= "id_tb_cadastro_usuario = :id_tb_cadastro_usuario, ";
		$strSqlPedidosInsert .= "tipo_pagamento = :tipo_pagamento, ";
		$strSqlPedidosInsert .= "data_pedido = :data_pedido, ";
		$strSqlPedidosInsert .= "data_pagamento = :data_pagamento, ";
		$strSqlPedidosInsert .= "data_entrega = :data_entrega, ";
		$strSqlPedidosInsert .= "data_validade = :data_validade, ";
		$strSqlPedidosInsert .= "valor_pedido = :valor_pedido, ";
		$strSqlPedidosInsert .= "valor_frete = :valor_frete, ";
		$strSqlPedidosInsert .= "periodo_contratacao = :periodo_contratacao, ";
		$strSqlPedidosInsert .= "tipo_entrega = :tipo_entrega, ";
		$strSqlPedidosInsert .= "valor_desconto = :valor_desconto, ";
		$strSqlPedidosInsert .= "valor_acrescimo = :valor_acrescimo, ";
		$strSqlPedidosInsert .= "valor_total = :valor_total, ";
		$strSqlPedidosInsert .= "peso_total = :peso_total, ";
		/*
		$strSqlPedidosInsert .= "endereco_entrega = :endereco_entrega, ";
		$strSqlPedidosInsert .= "endereco_numero_entrega = :endereco_numero_entrega, ";
		$strSqlPedidosInsert .= "endereco_complemento_entrega = :endereco_complemento_entrega, ";
		$strSqlPedidosInsert .= "bairro_entrega = :bairro_entrega, ";
		$strSqlPedidosInsert .= "cidade_entrega = :cidade_entrega, ";
		$strSqlPedidosInsert .= "estado_entrega = :estado_entrega, ";
		$strSqlPedidosInsert .= "pais_entrega = :pais_entrega, ";
		$strSqlPedidosInsert .= "cep_entrega = :cep_entrega, ";
		*/
		$strSqlPedidosInsert .= "id_tb_cadastro1 = :id_tb_cadastro1, ";
		$strSqlPedidosInsert .= "id_tb_cadastro2 = :id_tb_cadastro2, ";
		$strSqlPedidosInsert .= "id_tb_cadastro3 = :id_tb_cadastro3, ";
		$strSqlPedidosInsert .= "id_tb_cadastro4 = :id_tb_cadastro4, ";
		$strSqlPedidosInsert .= "id_tb_cadastro5 = :id_tb_cadastro5, ";
		$strSqlPedidosInsert .= "obs = :obs, ";
		$strSqlPedidosInsert .= "ativacao = :ativacao, ";
		$strSqlPedidosInsert .= "informacao_complementar1 = :informacao_complementar1, ";
		$strSqlPedidosInsert .= "informacao_complementar2 = :informacao_complementar2, ";
		$strSqlPedidosInsert .= "informacao_complementar3 = :informacao_complementar3, ";
		$strSqlPedidosInsert .= "informacao_complementar4 = :informacao_complementar4, ";
		$strSqlPedidosInsert .= "informacao_complementar5 = :informacao_complementar5, ";
		$strSqlPedidosInsert .= "id_ce_complemento_status = :id_ce_complemento_status ";
		//echo "strSqlPedidosInsert=" . $strSqlPedidosInsert . "<br>";
		//----------


		//Parâmetros.
		//----------
		$statementPedidosInsert = $GLOBALS['dbSistemaConPDO']->prepare($strSqlPedidosInsert);
		
		if ($statementPedidosInsert !== false)
		{
			/*
				"id_tb_cadastro_enderecos" => $xxx,
				"id_tb_cadastro_cartoes" => $xxx,
				
				"data_pagamento" => $xxx,
				"data_entrega" => $xxx,
				
				"endereco_entrega" => $enderecoEntrega,
				"endereco_numero_entrega" => $enderecoNumeroEntrega,
				"endereco_complemento_entrega" => $enderecoComplementoEntrega,
				"bairro_entrega" => $bairroEntrega,
				"cidade_entrega" => $cidadeEntrega,
				"estado_entrega" => $cidadeEntrega,
				"pais_entrega" => $paisEntrega,
				"cep_entrega" => $cepEntrega,
				
				"transacao_externa_status" => $xxx,
				"transacao_externa_autenticacao" => $xxx,
				"transacao_externa_log" => $xxx,
				"transacao_externa_data_pagamento_liberado" => $xxx

			*/
			$statementPedidosInsert->execute(array(
				"id" => $tbPedidosIdCePedidos,
				"id_tb_cadastro_cliente" => $tbPedidosIdTbCadastroCliente,
				"id_tb_cadastro_enderecos" => $_tbPedidosIdTbCadastroEnderecos,
				"id_tb_cadastro_cartoes" => $tbPedidosIdTbCadastroCartoes,
				"id_tb_cadastro_usuario" => $tbPedidosIdTbCadastroUsuario,
				"tipo_pagamento" => $tbPedidosTipoPagamento,
				"data_pedido" => $tbPedidosDataPedido,
				"data_pagamento" => $tbPedidosDataPagamento,
				"data_entrega" => $tbPedidosDataEntrega,
				"data_validade" => $tbPedidosDataValidade,
				"valor_pedido" => $tbPedidosValorPedido,
				"valor_frete" => $tbPedidosValorFrete,
				"periodo_contratacao" => $tbPedidosPeriodoContratacao,
				"tipo_entrega" => $tbPedidosTipoEntrega,
				"valor_desconto" => $tbPedidosValorDesconto,
				"valor_acrescimo" => $tbPedidosValorAcrescimo,
				"valor_total" => $tbPedidosValorTotal,
				"peso_total" => $tbPedidosPesoTotal,
				"id_tb_cadastro1" => $tbPedidosIdTbCadastro1,
				"id_tb_cadastro2" => $tbPedidosIdTbCadastro2,
				"id_tb_cadastro3" => $tbPedidosIdTbCadastro3,
				"id_tb_cadastro4" => $tbPedidosIdTbCadastro4,
				"id_tb_cadastro5" => $tbPedidosIdTbCadastro5,
				"obs" => $tbPedidosOBS,
				"ativacao" => $tbPedidosAtivacao,
				"informacao_complementar1" => $tbPedidosIC1,
				"informacao_complementar2" => $tbPedidosIC2,
				"informacao_complementar3" => $tbPedidosIC3,
				"informacao_complementar4" => $tbPedidosIC4,
				"informacao_complementar5" => $tbPedidosIC5,
				"id_ce_complemento_status" => $tbPedidosIdCeComplementoStatus
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
	function PedidosItensInsert($_tbPedidosItensId, 
	$_tbPedidosItensIdCePedidos, 
	$_tbPedidosItensIdTbCadastroCliente, 
	$_tbPedidosItensIdTbCadastroUsuario, 
	$_tbPedidosItensIdItem, 
	$_tbPedidosItensCodItem, 
	$_tbPedidosItensDescricao, 
	$_tbPedidosItensTabela, 
	$_tbPedidosItensQuantidade, 
	$_tbPedidosItensValorUnitario, 
	$_tbPedidosItensIdTbItensValores, 
	$_tbPedidosItensIdTbItensValoresTitulo, 
	$_tbPedidosItensIdTbItensData, 
	$_tbPedidosItensIdsOpcionais, 
	$_tbPedidosItensIdsOpcionaisDescricao, 
	$_tbPedidosItensOBS, 
	$_tbPedidosItensIC1, 
	$_tbPedidosItensIC2, 
	$_tbPedidosItensIC3, 
	$_tbPedidosItensIC4, 
	$_tbPedidosItensIC5, 
	$_tbPedidosItensAtivacao, 
	$_tbPedidosItensDataPedido, 
	$_tbPedidosItensDataPagamento, 
	$_tbPedidosItensDataEntrega, 
	$_tbPedidosItensDataValidade, 
	$_tbPedidosItensIdTbProdutosComplementoStatus)
	{
		//Criação de algumas variáveis.
		//----------
		$strRetorno = false;
		//$id = ContadorUniversal::ContadorUniversalUpdate(1);
		
		$tbPedidosItensId = $_tbPedidosItensId;
		if($tbPedidosItensId == "")
		{
			$tbPedidosItensId = ContadorUniversal::ContadorUniversalUpdate(1);
		}
		$tbPedidosItensIdCePedidos = $_tbPedidosItensIdCePedidos;
		
		$tbPedidosItensIdTbCadastroCliente = $_tbPedidosItensIdTbCadastroCliente;
		if($tbPedidosItensIdTbCadastroCliente == "")
		{
			$tbPedidosItensIdTbCadastroCliente = 0;
		}
		$tbPedidosItensIdTbCadastroUsuario = $_tbPedidosItensIdTbCadastroUsuario;
		if($tbPedidosItensIdTbCadastroUsuario == "")
		{
			$tbPedidosItensIdTbCadastroUsuario = 0;
		}
		
		$tbPedidosItensIdItem = $_tbPedidosItensIdItem;
		$tbPedidosItensCodItem = $_tbPedidosItensCodItem;
		$tbPedidosItensDescricao = Funcoes::ConteudoMascaraGravacao01($_tbPedidosItensDescricao);
		$tbPedidosItensTabela = $_tbPedidosItensTabela;
		
		$tbPedidosItensQuantidade = $_tbPedidosItensQuantidade;
		if($tbPedidosItensQuantidade == "")
		{
			$tbPedidosItensQuantidade = 1;
		}
		
		$tbPedidosItensValorUnitario = $_tbPedidosItensValorUnitario;
		if($tbPedidosItensValorUnitario == "")
		{
			$tbPedidosItensValorUnitario = 0;
		}

		$tbPedidosItensIdTbItensValores = $_tbPedidosItensIdTbItensValores;
		if($tbPedidosItensIdTbItensValores == "")
		{
			$tbPedidosItensIdTbItensValores = 0;
		}
		$tbPedidosItensIdTbItensValoresTitulo = Funcoes::ConteudoMascaraGravacao01($_tbPedidosItensIdTbItensValoresTitulo);
		$tbPedidosItensIdTbItensData = $_tbPedidosItensIdTbItensData;
		if($tbPedidosItensIdTbItensData == "")
		{
			$tbPedidosItensIdTbItensData = NULL;	
		}

		//$tbPedidosItensValorTotal = $_tbPedidosItensValorTotal;
		$tbPedidosItensValorTotal = $tbPedidosItensQuantidade * $tbPedidosItensValorUnitario;
		
		$tbPedidosItensIdsOpcionais = $_tbPedidosItensIdsOpcionais;
		$tbPedidosItensIdsOpcionaisDescricao = Funcoes::ConteudoMascaraGravacao01($_tbPedidosItensIdsOpcionaisDescricao);
		
		$tbPedidosItensOBS = Funcoes::ConteudoMascaraGravacao01($_tbPedidosItensOBS);
		$tbPedidosItensIC1 = Funcoes::ConteudoMascaraGravacao01($_tbPedidosItensIC1);
		$tbPedidosItensIC2 = Funcoes::ConteudoMascaraGravacao01($_tbPedidosItensIC2);
		$tbPedidosItensIC3 = Funcoes::ConteudoMascaraGravacao01($_tbPedidosItensIC3);
		$tbPedidosItensIC4 = Funcoes::ConteudoMascaraGravacao01($_tbPedidosItensIC4);
		$tbPedidosItensIC5 = Funcoes::ConteudoMascaraGravacao01($_tbPedidosItensIC5);

		$tbPedidosItensAtivacao = $_tbPedidosItensAtivacao;
		
		//$dataPedido = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");
		$tbPedidosItensDataPedido = $_tbPedidosItensDataPedido;
		if($tbPedidosItensDataPedido == "")
		{
			$tbPedidosItensDataPedido = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");
		}else{
			$tbPedidosItensDataPedido = Funcoes::DataGravacaoSql($_tbPedidosItensDataPedido, $GLOBALS['configSistemaFormatoData']) . " " . date("H") . ":" . date("i") . ":" . date("s");
		}
		
		$tbPedidosItensDataPagamento = $_tbPedidosItensDataPagamento;
		if($tbPedidosItensDataPagamento == "")
		{
			$tbPedidosItensDataPagamento = NULL;	
		}

		$tbPedidosItensDataEntrega = $_tbPedidosItensDataEntrega;
		if($tbPedidosItensDataEntrega == "")
		{
			$tbPedidosItensDataEntrega = NULL;	
		}

		$tbPedidosItensDataValidade = $_tbPedidosItensDataValidade;
		if($tbPedidosItensDataValidade == "")
		{
			$tbPedidosItensDataValidade = NULL;	
		}

		$_tbPedidosItensIdTbProdutosComplementoStatus = $_tbPedidosItensIdTbProdutosComplementoStatus;
		if($_tbPedidosItensIdTbProdutosComplementoStatus == "")
		{
			$_tbPedidosItensIdTbProdutosComplementoStatus = 0;
		}
		//----------


		//Inclusão de registro no BD.
		//----------
		$strSqlPedidosItensInsert = "";
		$strSqlPedidosItensInsert .= "INSERT INTO ce_itens ";
		$strSqlPedidosItensInsert .= "SET ";
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
		$strSqlPedidosItensInsert .= "id_tb_itens_valores = :id_tb_itens_valores, ";
		$strSqlPedidosItensInsert .= "id_tb_itens_valores_titulo = :id_tb_itens_valores_titulo, ";
		$strSqlPedidosItensInsert .= "id_tb_itens_data = :id_tb_itens_data, ";
		$strSqlPedidosItensInsert .= "valor_total = :valor_total, ";
		$strSqlPedidosItensInsert .= "ids_opcionais = :ids_opcionais, ";
		$strSqlPedidosItensInsert .= "ids_opcionais_descricao = :ids_opcionais_descricao, ";
		$strSqlPedidosItensInsert .= "obs = :obs, ";
		$strSqlPedidosItensInsert .= "informacao_complementar1 = :informacao_complementar1, ";
		$strSqlPedidosItensInsert .= "informacao_complementar2 = :informacao_complementar2, ";
		$strSqlPedidosItensInsert .= "informacao_complementar3 = :informacao_complementar3, ";
		$strSqlPedidosItensInsert .= "informacao_complementar4 = :informacao_complementar4, ";
		$strSqlPedidosItensInsert .= "informacao_complementar5 = :informacao_complementar5, ";
		$strSqlPedidosItensInsert .= "ativacao = :ativacao, ";
		$strSqlPedidosItensInsert .= "data_pedido = :data_pedido, ";
		$strSqlPedidosItensInsert .= "data_pagamento = :data_pagamento, ";
		$strSqlPedidosItensInsert .= "data_entrega = :data_entrega, ";
		$strSqlPedidosItensInsert .= "data_validade = :data_validade, ";
		$strSqlPedidosItensInsert .= "id_tb_produtos_complemento_status = :id_tb_produtos_complemento_status";
		//echo "strSqlPedidosItensInsert=" . $strSqlPedidosItensInsert . "<br>";
		//----------


		//Parâmetros.
		//----------
		$statementPedidosItensInsert = $GLOBALS['dbSistemaConPDO']->prepare($strSqlPedidosItensInsert);
		
		if ($statementPedidosItensInsert !== false)
		{
			$statementPedidosItensInsert->execute(array(
				"id" => $tbPedidosItensId,
				"id_ce_pedidos" => $tbPedidosItensIdCePedidos,
				"id_tb_cadastro_cliente" => $tbPedidosItensIdTbCadastroCliente,
				"id_tb_cadastro_usuario" => $tbPedidosItensIdTbCadastroUsuario,
				"id_item" => $tbPedidosItensIdItem,
				"cod_item" => $tbPedidosItensCodItem,
				"descricao" => $tbPedidosItensDescricao,
				"tabela" => $tbPedidosItensTabela,
				"quantidade" => $tbPedidosItensQuantidade,
				"valor_unitario" => $tbPedidosItensValorUnitario,
				"id_tb_itens_valores" => $tbPedidosItensIdTbItensValores,
				"id_tb_itens_valores_titulo" => $tbPedidosItensIdTbItensValoresTitulo,
				"id_tb_itens_data" => $tbPedidosItensIdTbItensData,
				"valor_total" => $tbPedidosItensValorTotal,
				"ids_opcionais" => $tbPedidosItensIdsOpcionais,
				"ids_opcionais_descricao" => $tbPedidosItensIdsOpcionaisDescricao,
				"obs" => $tbPedidosItensOBS,
				"informacao_complementar1" => $tbPedidosItensIC1,
				"informacao_complementar2" => $tbPedidosItensIC2,
				"informacao_complementar3" => $tbPedidosItensIC3,
				"informacao_complementar4" => $tbPedidosItensIC4,
				"informacao_complementar5" => $tbPedidosItensIC5,
				"ativacao" => $tbPedidosItensAtivacao,
				"data_pedido" => $tbPedidosItensDataPedido,
				"data_pagamento" => $tbPedidosItensDataPagamento,
				"data_entrega" => $tbPedidosItensDataEntrega,
				"data_validade" => $tbPedidosItensDataValidade,
				"id_tb_produtos_complemento_status" => $_tbPedidosItensIdTbProdutosComplementoStatus
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
	function PedidosParcelasInsert($_tbPedidosParcelasId, 
	$_tbPedidosParcelasIdCePedidos, 
	$_tbPedidosParcelasNParcela, 
	$_tbPedidosParcelasDataVencimento, 
	$_tbPedidosParcelasDataPagamento, 
	$_tbPedidosParcelasValor, 
	$_tbPedidosParcelasValorDesconto, 
	$_tbPedidosParcelasValorAcrescimo, 
	$_tbPedidosParcelasValorTotal, 
	$_tbPedidosParcelasAtivacao, 
	$_tbPedidosParcelasIC1, 
	$_tbPedidosParcelasIC2, 
	$_tbPedidosParcelasIC3, 
	$_tbPedidosParcelasIC4, 
	$_tbPedidosParcelasIC5, 
	$_tbPedidosParcelasIdCeComplementoTipo, 
	$_tbPedidosParcelasIdCeComplementoStatus)
	{
		//Criação de algumas variáveis.
		//----------
		$strRetorno = false;
		
		$tbPedidosParcelasId = $_tbPedidosParcelasId;
		if($tbPedidosParcelasId == "")
		{
			$tbPedidosParcelasId = ContadorUniversal::ContadorUniversalUpdate(1);
		}
		$tbPedidosParcelasIdCePedidos = $_tbPedidosParcelasIdCePedidos;
		
		$tbPedidosParcelasNParcela = $_tbPedidosParcelasNParcela;
		if($tbPedidosParcelasNParcela == "")
		{
			$tbPedidosParcelasNParcela = 0;
		}
		
		$tbPedidosParcelasDataVencimento = Funcoes::DataGravacaoSql($_tbPedidosParcelasDataVencimento, $GLOBALS['configSistemaFormatoData']);
		if($tbPedidosParcelasDataVencimento == "")
		{
			//$data_publicacao = NULL;	
			$tbPedidosParcelasDataVencimento = date("Y") . "-" . date("m") . "-" . date("d");	
		}
		
		$tbPedidosParcelasDataPagamento = Funcoes::DataGravacaoSql($_tbPedidosParcelasDataPagamento, $GLOBALS['configSistemaFormatoData']);
		if($tbPedidosParcelasDataPagamento == "")
		{
			$tbPedidosParcelasDataPagamento = NULL;	
		}

		$tbPedidosParcelasValor = Funcoes::MascaraValorGravar($_tbPedidosParcelasValor);
		if($tbPedidosParcelasValor == "")
		{
			$tbPedidosParcelasValor = 0;
		}

		$tbPedidosParcelasValorDesconto = Funcoes::MascaraValorGravar($_tbPedidosParcelasValorDesconto);
		if($tbPedidosParcelasValorDesconto == "")
		{
			$tbPedidosParcelasValorDesconto = 0;
		}

		$tbPedidosParcelasValorAcrescimo = Funcoes::MascaraValorGravar($_tbPedidosParcelasValorAcrescimo);
		if($tbPedidosParcelasValorAcrescimo == "")
		{
			$tbPedidosParcelasValorAcrescimo = 0;
		}
		
		$tbPedidosParcelasValorTotal = Funcoes::MascaraValorGravar($_tbPedidosParcelasValorTotal);
		if($tbPedidosParcelasValorTotal == "")
		{
			$tbPedidosParcelasValorTotal = 0;
		}
		
		$tbPedidosParcelasAtivacao = $_tbPedidosParcelasAtivacao;

		$tbPedidosParcelasIC1 = Funcoes::ConteudoMascaraGravacao01($_tbPedidosParcelasIC1);
		$tbPedidosParcelasIC2 = Funcoes::ConteudoMascaraGravacao01($_tbPedidosParcelasIC2);
		$tbPedidosParcelasIC3 = Funcoes::ConteudoMascaraGravacao01($_tbPedidosParcelasIC3);
		$tbPedidosParcelasIC4 = Funcoes::ConteudoMascaraGravacao01($_tbPedidosParcelasIC4);
		$tbPedidosParcelasIC5 = Funcoes::ConteudoMascaraGravacao01($_tbPedidosParcelasIC5);
		
		$tbPedidosParcelasIdCeComplementoTipo = $_tbPedidosParcelasIdCeComplementoTipo;
		$tbPedidosParcelasIdCeComplementoStatus = $_tbPedidosParcelasIdCeComplementoStatus;
		//----------


		//Montagem do query.
		//----------
		$strSqlPedidosParcelasInsert = "";
		$strSqlPedidosParcelasInsert .= "INSERT INTO ce_pedidos_parcelas ";
		$strSqlPedidosParcelasInsert .= "SET ";
		$strSqlPedidosParcelasInsert .= "id = :id, ";
		$strSqlPedidosParcelasInsert .= "id_ce_pedidos = :id_ce_pedidos, ";
		$strSqlPedidosParcelasInsert .= "n_parcela = :n_parcela, ";
		$strSqlPedidosParcelasInsert .= "data_vencimento = :data_vencimento, ";
		$strSqlPedidosParcelasInsert .= "data_pagamento = :data_pagamento, ";
		
		$strSqlPedidosParcelasInsert .= "valor = :valor, ";
		$strSqlPedidosParcelasInsert .= "valor_desconto = :valor_desconto, ";
		$strSqlPedidosParcelasInsert .= "valor_acrescimo = :valor_acrescimo, ";
		$strSqlPedidosParcelasInsert .= "valor_total = :valor_total, ";
		
		$strSqlPedidosParcelasInsert .= "ativacao = :ativacao, ";
		
		$strSqlPedidosParcelasInsert .= "informacao_complementar1 = :informacao_complementar1, ";
		$strSqlPedidosParcelasInsert .= "informacao_complementar2 = :informacao_complementar2, ";
		$strSqlPedidosParcelasInsert .= "informacao_complementar3 = :informacao_complementar3, ";
		$strSqlPedidosParcelasInsert .= "informacao_complementar4 = :informacao_complementar4, ";
		$strSqlPedidosParcelasInsert .= "informacao_complementar5 = :informacao_complementar5, ";
		$strSqlPedidosParcelasInsert .= "id_ce_complemento_tipo = :id_ce_complemento_tipo, ";
		$strSqlPedidosParcelasInsert .= "id_ce_complemento_status = :id_ce_complemento_status ";
		//----------
		
		
		//Parametros e execução.
		//----------
		//$statementPedidosParcelasInsert = $dbSistemaConPDO->prepare($strSqlPedidosParcelasInsert);
		$statementPedidosParcelasInsert = $GLOBALS['dbSistemaConPDO']->prepare($strSqlPedidosParcelasInsert);
		
		if ($statementPedidosParcelasInsert !== false)
		{
			$statementPedidosParcelasInsert->execute(array(
				"id" => $tbPedidosParcelasId,
				"id_ce_pedidos" => $tbPedidosParcelasIdCePedidos,
				"n_parcela" => $tbPedidosParcelasNParcela,
				"data_vencimento" => $tbPedidosParcelasDataVencimento,
				"data_pagamento" => $tbPedidosParcelasDataPagamento,
				"valor" => $tbPedidosParcelasValor,
				"valor_desconto" => $tbPedidosParcelasValorDesconto,
				"valor_acrescimo" => $tbPedidosParcelasValorAcrescimo,
				"valor_total" => $tbPedidosParcelasValorTotal,
				"ativacao" => $tbPedidosParcelasAtivacao,
				"informacao_complementar1" => $tbPedidosParcelasIC1,
				"informacao_complementar2" => $tbPedidosParcelasIC2,
				"informacao_complementar3" => $tbPedidosParcelasIC3,
				"informacao_complementar4" => $tbPedidosParcelasIC4,
				"informacao_complementar5" => $tbPedidosParcelasIC5,
				"id_ce_complemento_tipo" => $tbPedidosParcelasIdCeComplementoTipo,
				"id_ce_complemento_status" => $tbPedidosParcelasIdCeComplementoStatus
			));
			
			//$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus2");
			//Obs: Colocar um flag de verificação de gravação.
			$strRetorno = true;
		}else{
			//echo "erro";
			//$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus3");
		}
		//----------
		
		
		//Limpeza de objetos.
		//----------
		unset($strSqlPedidosParcelasInsert);
		unset($statementPedidosParcelasInsert);
		//----------

	
		return $strRetorno;
	}
	//**************************************************************************************
	
	
	//Função de inclusão de registro de orçamento.
	//**************************************************************************************
	function OrcamentosInsert($_tbOrcamentosId, 
	$_tbOrcamentosIdTbCadastroCliente, 
	$_tbOrcamentosIdTbCadastroEnderecos, 
	$_tbOrcamentosIdTbCadastroVendedor, 
	$_tbOrcamentosIdTbCadastroUsuario, 
	$_tbOrcamentosDataOrcamento, 
	$_tbOrcamentosDataEntrega, 
	$_tbOrcamentosValorOrcamento, 
	$_tbOrcamentosValorFrete, 
	$_tbOrcamentosPeriodoContratacao, 
	$_tbOrcamentosTipoEntrega, 
	$_tbOrcamentosValorTotal, 
	$_tbOrcamentosPesoTotal, 
	$_tbOrcamentosIdTbCadastro1, 
	$_tbOrcamentosIdTbCadastro2, 
	$_tbOrcamentosIdTbCadastro3, 
	$_tbOrcamentosOBS, 
	$_tbOrcamentosAtivacao, 
	$_tbOrcamentosAtivacao1, 
	$_tbOrcamentosAtivacao2, 
	$_tbOrcamentosAtivacao3, 
	$_tbOrcamentosAtivacao4, 
	$_tbOrcamentosIC1, 
	$_tbOrcamentosIC2, 
	$_tbOrcamentosIC3, 
	$_tbOrcamentosIC4, 
	$_tbOrcamentosIC5, 
	$_tbOrcamentosIdCeComplementoStatus)
	{
		//Criação de algumas variáveis.
		//----------
		$strRetorno = false;
		
		if($_tbOrcamentosId == "")
		{
			$tbOrcamentosId = ContadorUniversal::ContadorUniversalUpdate(1);
		}else{
			$tbOrcamentosId = $_tbOrcamentosId;
		}
		
		$tbOrcamentosIdTbCadastroCliente = $_tbOrcamentosIdTbCadastroCliente;
		$tbOrcamentosIdTbCadastroEnderecos = $_tbOrcamentosIdTbCadastroEnderecos;
		$tbOrcamentosIdTbCadastroVendedor = $_tbOrcamentosIdTbCadastroVendedor;
		$tbOrcamentosIdTbCadastroUsuario = $_tbOrcamentosIdTbCadastroUsuario;
		
		//$tbOrcamentosDataPedido = $linhaOrcamentosDetalhes['data_pedido'];
		if($_tbOrcamentosDataOrcamento == "")
		{
			$tbOrcamentosDataOrcamento = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");;
		}else{
			//$tbOrcamentosDataOrcamento = $_tbOrcamentosDataOrcamento;
			$tbOrcamentosDataOrcamento = Funcoes::DataGravacaoSql($_tbOrcamentosDataOrcamento, $GLOBALS['configSistemaFormatoData']);
		}
		
		$tbOrcamentosDataEntrega = $_tbOrcamentosDataEntrega;
		if($_tbOrcamentosDataEntrega == "")
		{
			$tbOrcamentosDataEntrega = NULL;
		}else{
			$tbOrcamentosDataEntrega = Funcoes::DataGravacaoSql($_tbOrcamentosDataEntrega, $GLOBALS['configSistemaFormatoData']);
		}
		
		$tbOrcamentosValorOrcamento = Funcoes::MascaraValorGravar($_tbOrcamentosValorOrcamento);
		$tbOrcamentosValorFrete = Funcoes::MascaraValorGravar($_tbOrcamentosValorFrete);

		$tbOrcamentosPeriodoContratacao = $_tbOrcamentosPeriodoContratacao;
		$tbOrcamentosTipoEntrega = Funcoes::ConteudoMascaraLeitura($_tbOrcamentosTipoEntrega);

		//$tbOrcamentosValorTotal = Funcoes::MascaraValorLer($linhaOrcamentosDetalhes['valor_total'], $GLOBALS['configSistemaMoeda']);
		$tbOrcamentosValorTotal = Funcoes::MascaraValorGravar($_tbOrcamentosValorTotal);

		$tbOrcamentosPesoTotal = Funcoes::MascaraValorGravar($_tbOrcamentosPesoTotal);
		if($tbOrcamentosPesoTotal == "")
		{
			$tbOrcamentosPesoTotal = 0;
		}
		
		$tbOrcamentosIdTbCadastro1 = $_tbOrcamentosIdTbCadastro1;
		$tbOrcamentosIdTbCadastro2 = $_tbOrcamentosIdTbCadastro2;
		$tbOrcamentosIdTbCadastro3 = $_tbOrcamentosIdTbCadastro3;
		$tbOrcamentosOBS = Funcoes::ConteudoMascaraLeitura($_tbOrcamentosOBS);
		$tbOrcamentosAtivacao = $_tbOrcamentosAtivacao;
		$tbOrcamentosAtivacao1 = $_tbOrcamentosAtivacao1;
		$tbOrcamentosAtivacao2 = $_tbOrcamentosAtivacao2;
		$tbOrcamentosAtivacao3 = $_tbOrcamentosAtivacao3;
		$tbOrcamentosAtivacao4 = $_tbOrcamentosAtivacao4;
		$tbOrcamentosIC1 = Funcoes::ConteudoMascaraLeitura($_tbOrcamentosIC1);
		$tbOrcamentosIC2 = Funcoes::ConteudoMascaraLeitura($_tbOrcamentosIC2);
		$tbOrcamentosIC3 = Funcoes::ConteudoMascaraLeitura($_tbOrcamentosIC3);
		$tbOrcamentosIC4 = Funcoes::ConteudoMascaraLeitura($_tbOrcamentosIC4);
		$tbOrcamentosIC5 = Funcoes::ConteudoMascaraLeitura($_tbOrcamentosIC5);
		$tbOrcamentosIdCeComplementoStatus = $_tbOrcamentosIdCeComplementoStatus;
		//----------
		
	
		//Verificação de erro.
		/*
		echo "idRegistro=" . $idRegistro . "<br>";
		echo "idOrcamentos=" . $idOrcamentos . "<br>";
		echo "strTipoOrcamentos=" . $strTipoOrcamentos . "<br>";
		echo "strTabela=" . $strTabela . "<br>";
		echo "strNomeCampoIdRegistro=" . $strNomeCampoIdRegistro . "<br>";
		echo "strNomeCampoIdOrcamentos=" . $strNomeCampoIdOrcamentos . "<br>";
		*/


		//Montagem do query.
		//----------
		$strSqlOrcamentosInsert = "";
		$strSqlOrcamentosInsert .= "INSERT INTO ce_orcamentos ";
		$strSqlOrcamentosInsert .= "SET ";
		$strSqlOrcamentosInsert .= "id = :id, ";
		$strSqlOrcamentosInsert .= "id_tb_cadastro_cliente = :id_tb_cadastro_cliente, ";
		$strSqlOrcamentosInsert .= "id_tb_cadastro_enderecos = :id_tb_cadastro_enderecos, ";
		$strSqlOrcamentosInsert .= "id_tb_cadastro_vendedor = :id_tb_cadastro_vendedor, ";
		$strSqlOrcamentosInsert .= "id_tb_cadastro_usuario = :id_tb_cadastro_usuario, ";
		$strSqlOrcamentosInsert .= "data_orcamento = :data_orcamento, ";
		$strSqlOrcamentosInsert .= "data_entrega = :data_entrega, ";
		$strSqlOrcamentosInsert .= "valor_orcamento = :valor_orcamento, ";
		$strSqlOrcamentosInsert .= "valor_frete = :valor_frete, ";
		$strSqlOrcamentosInsert .= "periodo_contratacao = :periodo_contratacao, ";
		$strSqlOrcamentosInsert .= "tipo_entrega = :tipo_entrega, ";
		$strSqlOrcamentosInsert .= "valor_total = :valor_total, ";
		$strSqlOrcamentosInsert .= "peso_total = :peso_total, ";
		$strSqlOrcamentosInsert .= "id_tb_cadastro1 = :id_tb_cadastro1, ";
		$strSqlOrcamentosInsert .= "id_tb_cadastro2 = :id_tb_cadastro2, ";
		$strSqlOrcamentosInsert .= "id_tb_cadastro3 = :id_tb_cadastro3, ";
		$strSqlOrcamentosInsert .= "obs = :obs, ";
		$strSqlOrcamentosInsert .= "ativacao = :ativacao, ";
		$strSqlOrcamentosInsert .= "ativacao1 = :ativacao1, ";
		$strSqlOrcamentosInsert .= "ativacao2 = :ativacao2, ";
		$strSqlOrcamentosInsert .= "ativacao3 = :ativacao3, ";
		$strSqlOrcamentosInsert .= "ativacao4 = :ativacao4, ";
		$strSqlOrcamentosInsert .= "informacao_complementar1 = :informacao_complementar1, ";
		$strSqlOrcamentosInsert .= "informacao_complementar2 = :informacao_complementar2, ";
		$strSqlOrcamentosInsert .= "informacao_complementar3 = :informacao_complementar3, ";
		$strSqlOrcamentosInsert .= "informacao_complementar4 = :informacao_complementar4, ";
		$strSqlOrcamentosInsert .= "informacao_complementar5 = :informacao_complementar5, ";
		$strSqlOrcamentosInsert .= "id_ce_complemento_status = :id_ce_complemento_status ";
		//echo "strSqlCategoriasInsert=" . $strSqlOrcamentosInsert . "<br>";
		//----------


		//Componentes e parâmetros.
		//----------
		$statementOrcamentosInsert = $GLOBALS['dbSistemaConPDO']->prepare($strSqlOrcamentosInsert);
		
		if ($statementOrcamentosInsert !== false)
		{
			/*
			$statementOrcamentosInsert->execute(array(
				"id" => $idTbOrcamentos,
				"id_item" => $idItem,
				"id_registro" => $idRegistro,
				"tipo_categoria" => $tipoCategoria,
				"tabela" => $strTabela
			));
			*/			

			$statementOrcamentosInsert->bindParam(':id', $tbOrcamentosId, PDO::PARAM_STR);
			$statementOrcamentosInsert->bindParam(':id_tb_cadastro_cliente', $tbOrcamentosIdTbCadastroCliente, PDO::PARAM_STR);
			$statementOrcamentosInsert->bindParam(':id_tb_cadastro_enderecos', $tbOrcamentosIdTbCadastroEnderecos, PDO::PARAM_STR);
			$statementOrcamentosInsert->bindParam(':id_tb_cadastro_vendedor', $tbOrcamentosIdTbCadastroVendedor, PDO::PARAM_STR);
			$statementOrcamentosInsert->bindParam(':id_tb_cadastro_usuario', $tbOrcamentosIdTbCadastroUsuario, PDO::PARAM_STR);
			$statementOrcamentosInsert->bindParam(':data_orcamento', $tbOrcamentosDataOrcamento, PDO::PARAM_STR);
			$statementOrcamentosInsert->bindParam(':data_entrega', $tbOrcamentosDataEntrega, PDO::PARAM_STR);
			$statementOrcamentosInsert->bindParam(':valor_orcamento', $tbOrcamentosValorOrcamento, PDO::PARAM_STR);
			$statementOrcamentosInsert->bindParam(':valor_frete', $tbOrcamentosValorFrete, PDO::PARAM_STR);
			$statementOrcamentosInsert->bindParam(':periodo_contratacao', $tbOrcamentosPeriodoContratacao, PDO::PARAM_STR);
			$statementOrcamentosInsert->bindParam(':tipo_entrega', $tbOrcamentosTipoEntrega, PDO::PARAM_STR);
			$statementOrcamentosInsert->bindParam(':valor_total', $tbOrcamentosValorTotal, PDO::PARAM_STR);
			$statementOrcamentosInsert->bindParam(':peso_total', $tbOrcamentosPesoTotal, PDO::PARAM_STR);
			$statementOrcamentosInsert->bindParam(':id_tb_cadastro1', $tbOrcamentosIdTbCadastro1, PDO::PARAM_STR);
			$statementOrcamentosInsert->bindParam(':id_tb_cadastro2', $tbOrcamentosIdTbCadastro2, PDO::PARAM_STR);
			$statementOrcamentosInsert->bindParam(':id_tb_cadastro3', $tbOrcamentosIdTbCadastro3, PDO::PARAM_STR);
			$statementOrcamentosInsert->bindParam(':obs', $tbOrcamentosOBS, PDO::PARAM_STR);
			$statementOrcamentosInsert->bindParam(':ativacao', $tbOrcamentosAtivacao, PDO::PARAM_STR);
			$statementOrcamentosInsert->bindParam(':ativacao1', $tbOrcamentosAtivacao1, PDO::PARAM_STR);
			$statementOrcamentosInsert->bindParam(':ativacao2', $tbOrcamentosAtivacao2, PDO::PARAM_STR);
			$statementOrcamentosInsert->bindParam(':ativacao3', $tbOrcamentosAtivacao3, PDO::PARAM_STR);
			$statementOrcamentosInsert->bindParam(':ativacao4', $tbOrcamentosAtivacao4, PDO::PARAM_STR);
			$statementOrcamentosInsert->bindParam(':informacao_complementar1', $tbOrcamentosIC1, PDO::PARAM_STR);
			$statementOrcamentosInsert->bindParam(':informacao_complementar2', $tbOrcamentosIC2, PDO::PARAM_STR);
			$statementOrcamentosInsert->bindParam(':informacao_complementar3', $tbOrcamentosIC3, PDO::PARAM_STR);
			$statementOrcamentosInsert->bindParam(':informacao_complementar4', $tbOrcamentosIC4, PDO::PARAM_STR);
			$statementOrcamentosInsert->bindParam(':informacao_complementar5', $tbOrcamentosIC5, PDO::PARAM_STR);
			$statementOrcamentosInsert->bindParam(':id_ce_complemento_status', $tbOrcamentosIdCeComplementoStatus, PDO::PARAM_STR);
            $statementOrcamentosInsert->execute();
			
			//$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus2");
			$strRetorno = true;
		}else{
			//echo "erro";
			//$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus3");
		}
		//----------


		//Limpeza de objetos.
		unset($strSqlOrcamentosInsert);
		unset($statementOrcamentosInsert);
		//----------
		
		return $strRetorno;
	}
	//**************************************************************************************
	
	
	//Função de inclusão de vínculos entre item e registro.
	//**************************************************************************************
	function OrcamentosRelacaoRegistroInsert($_tbOrcamentosRelacaoRegistrosId, 
	$_tbOrcamentosRelacaoRegistrosDataAtualizacao, 
	$_tbOrcamentosRelacaoRegistrosIdCeOrcamentos, 
	$_tbOrcamentosRelacaoRegistrosIdRegistro, 
	$_tbOrcamentosRelacaoRegistrosTipoCategoria, 
	$_tbOrcamentosRelacaoRegistrosTipoRelacao, 
	$_tbOrcamentosRelacaoRegistrosTabela, 
	$_tbOrcamentosRelacaoRegistrosQuantidade, 
	$_tbOrcamentosRelacaoRegistrosValor, 
	$_tbOrcamentosRelacaoRegistrosValor1, 
	$_tbOrcamentosRelacaoRegistrosValor2, 
	$_tbOrcamentosRelacaoRegistrosAtivacao, 
	$_tbOrcamentosRelacaoRegistrosAtivacao1, 
	$_tbOrcamentosRelacaoRegistrosAtivacao2, 
	$_tbOrcamentosRelacaoRegistrosAtivacao3, 
	$_tbOrcamentosRelacaoRegistrosAtivacao4, 
	$_tbOrcamentosRelacaoRegistrosIC1, 
	$_tbOrcamentosRelacaoRegistrosIC2, 
	$_tbOrcamentosRelacaoRegistrosIC3, 
	$_tbOrcamentosRelacaoRegistrosIC4, 
	$_tbOrcamentosRelacaoRegistrosIC5, 
	$_tbOrcamentosRelacaoRegistrosOBS)
	{
		//Variáveis.
		$strRetorno = false;
		//$idContadorUniversal = ContadorUniversal::ContadorUniversalUpdate(1);
		if($_tbOrcamentosRelacaoRegistrosId == "")
		{
			$tbOrcamentosRelacaoRegistrosId = ContadorUniversal::ContadorUniversalUpdate(1);
		}else{
			$tbOrcamentosRelacaoRegistrosId = $_tbOrcamentosRelacaoRegistrosId;
		}
		//$id = $_id;
		
		//$dataAtualizacao = $_dataAtualizacao;
		//$dataAtualizacao = date("Y") . "-" . date("m") . "-" . date("d");
		if($_tbOrcamentosRelacaoRegistrosDataAtualizacao == "")
		{
			$tbOrcamentosRelacaoRegistrosDataAtualizacao = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");;
		}else{
			//$tbOrcamentosDataOrcamento = $_tbOrcamentosRelacaoRegistrosDataAtualizacao;
			$tbOrcamentosRelacaoRegistrosDataAtualizacao = Funcoes::DataGravacaoSql($_tbOrcamentosRelacaoRegistrosDataAtualizacao, $GLOBALS['configSistemaFormatoData']);
		}
		
		$tbOrcamentosRelacaoRegistrosIdCeOrcamentos = $_tbOrcamentosRelacaoRegistrosIdCeOrcamentos;
		//$tbOrcamentosRelacaoRegistrosIdCeOrcamentosItens = $_tbOrcamentosRelacaoRegistrosIdCeOrcamentosItens;
		$tbOrcamentosRelacaoRegistrosIdRegistro = $_tbOrcamentosRelacaoRegistrosIdRegistro;
		$tbOrcamentosRelacaoRegistrosTipoCategoria = $_tbOrcamentosRelacaoRegistrosTipoCategoria;
		$tbOrcamentosRelacaoRegistrosTipoRelacao = $_tbOrcamentosRelacaoRegistrosTipoRelacao;
		$tbOrcamentosRelacaoRegistrosTabela = $_tbOrcamentosRelacaoRegistrosTabela;
		$tbOrcamentosRelacaoRegistrosQuantidade = $_tbOrcamentosRelacaoRegistrosQuantidade;
		$tbOrcamentosRelacaoRegistrosValor = Funcoes::MascaraValorGravar($_tbOrcamentosRelacaoRegistrosValor);
		$tbOrcamentosRelacaoRegistrosValor1 = Funcoes::MascaraValorGravar($_tbOrcamentosRelacaoRegistrosValor1);
		$tbOrcamentosRelacaoRegistrosValor2 = Funcoes::MascaraValorGravar($_tbOrcamentosRelacaoRegistrosValor2);
		$tbOrcamentosRelacaoRegistrosAtivacao = $_tbOrcamentosRelacaoRegistrosAtivacao;
		$tbOrcamentosRelacaoRegistrosAtivacao1 = $_tbOrcamentosRelacaoRegistrosAtivacao1;
		$tbOrcamentosRelacaoRegistrosAtivacao2 = $_tbOrcamentosRelacaoRegistrosAtivacao2;
		$tbOrcamentosRelacaoRegistrosAtivacao3 = $_tbOrcamentosRelacaoRegistrosAtivacao3;
		$tbOrcamentosRelacaoRegistrosAtivacao4 = $_tbOrcamentosRelacaoRegistrosAtivacao4;
		$tbOrcamentosRelacaoRegistrosIC1 = Funcoes::ConteudoMascaraGravacao01($_tbOrcamentosRelacaoRegistrosIC1);
		$tbOrcamentosRelacaoRegistrosIC2 = Funcoes::ConteudoMascaraGravacao01($_tbOrcamentosRelacaoRegistrosIC2);
		$tbOrcamentosRelacaoRegistrosIC3 = Funcoes::ConteudoMascaraGravacao01($_tbOrcamentosRelacaoRegistrosIC3);
		$tbOrcamentosRelacaoRegistrosIC4 = Funcoes::ConteudoMascaraGravacao01($_tbOrcamentosRelacaoRegistrosIC4);
		$tbOrcamentosRelacaoRegistrosIC5 = Funcoes::ConteudoMascaraGravacao01($_tbOrcamentosRelacaoRegistrosIC5);
		$tbOrcamentosRelacaoRegistrosOBS = Funcoes::ConteudoMascaraGravacao01($_tbOrcamentosRelacaoRegistrosOBS);	
		
	
		//Verificação de erro.
		/*
		echo "idRegistro=" . $idRegistro . "<br>";
		echo "idOrcamentosRelacaoRegistro=" . $idOrcamentosRelacaoRegistro . "<br>";
		echo "strTipoOrcamentosRelacaoRegistro=" . $strTipoOrcamentosRelacaoRegistro . "<br>";
		echo "strTabela=" . $strTabela . "<br>";
		echo "strNomeCampoIdRegistro=" . $strNomeCampoIdRegistro . "<br>";
		echo "strNomeCampoIdOrcamentosRelacaoRegistro=" . $strNomeCampoIdOrcamentosRelacaoRegistro . "<br>";
		*/
		
		//Inclusão de registro no BD.
		//----------
		$strSqlOrcamentosRelacaoRegistroInsert = "";
		$strSqlOrcamentosRelacaoRegistroInsert .= "INSERT INTO ce_orcamentos_relacao_registros ";
		$strSqlOrcamentosRelacaoRegistroInsert .= "SET ";
		$strSqlOrcamentosRelacaoRegistroInsert .= "id = :id, ";
		$strSqlOrcamentosRelacaoRegistroInsert .= "data_atualizacao = :data_atualizacao, ";
		$strSqlOrcamentosRelacaoRegistroInsert .= "id_ce_orcamentos = :id_ce_orcamentos, ";
		//$strSqlOrcamentosRelacaoRegistroInsert .= "id_ce_orcamentos_itens = :id_ce_orcamentos_itens, ";
		$strSqlOrcamentosRelacaoRegistroInsert .= "id_registro = :id_registro, ";
		//$strSqlOrcamentosRelacaoRegistroInsert .= "tipo_registro = :tipo_registro, ";
		$strSqlOrcamentosRelacaoRegistroInsert .= "tipo_categoria = :tipo_categoria, ";
		$strSqlOrcamentosRelacaoRegistroInsert .= "tipo_relacao = :tipo_relacao, ";
		$strSqlOrcamentosRelacaoRegistroInsert .= "tabela = :tabela, ";
		$strSqlOrcamentosRelacaoRegistroInsert .= "quantidade = :quantidade, ";
		$strSqlOrcamentosRelacaoRegistroInsert .= "valor = :valor, ";
		$strSqlOrcamentosRelacaoRegistroInsert .= "valor1 = :valor1, ";
		$strSqlOrcamentosRelacaoRegistroInsert .= "valor2 = :valor2, ";
		$strSqlOrcamentosRelacaoRegistroInsert .= "ativacao = :ativacao, ";
		$strSqlOrcamentosRelacaoRegistroInsert .= "ativacao1 = :ativacao1, ";
		$strSqlOrcamentosRelacaoRegistroInsert .= "ativacao2 = :ativacao2, ";
		$strSqlOrcamentosRelacaoRegistroInsert .= "ativacao3 = :ativacao3, ";
		$strSqlOrcamentosRelacaoRegistroInsert .= "ativacao4 = :ativacao4, ";
		$strSqlOrcamentosRelacaoRegistroInsert .= "informacao_complementar1 = :informacao_complementar1, ";
		$strSqlOrcamentosRelacaoRegistroInsert .= "informacao_complementar2 = :informacao_complementar2, ";
		$strSqlOrcamentosRelacaoRegistroInsert .= "informacao_complementar3 = :informacao_complementar3, ";
		$strSqlOrcamentosRelacaoRegistroInsert .= "informacao_complementar4 = :informacao_complementar4, ";
		$strSqlOrcamentosRelacaoRegistroInsert .= "informacao_complementar5 = :informacao_complementar5, ";
		$strSqlOrcamentosRelacaoRegistroInsert .= "obs = :obs ";
		//echo "strSqlCategoriasInsert=" . $strSqlOrcamentosRelacaoRegistroInsert . "<br>";
	
		
		$statementOrcamentosRelacaoRegistroInsert = $GLOBALS['dbSistemaConPDO']->prepare($strSqlOrcamentosRelacaoRegistroInsert);
		
		if ($statementOrcamentosRelacaoRegistroInsert !== false)
		{
			/*
			$statementOrcamentosRelacaoRegistroInsert->execute(array(
				"id" => $idTbOrcamentosRelacaoRegistro,
				"id_item" => $idItem,
				"id_registro" => $idRegistro,
				"tipo_categoria" => $tipoCategoria,
				"tabela" => $strTabela
			));
			*/			

			$statementOrcamentosRelacaoRegistroInsert->bindParam(':id', $tbOrcamentosRelacaoRegistrosId, PDO::PARAM_STR);
			$statementOrcamentosRelacaoRegistroInsert->bindParam(':data_atualizacao', $tbOrcamentosRelacaoRegistrosDataAtualizacao, PDO::PARAM_STR);
			$statementOrcamentosRelacaoRegistroInsert->bindParam(':id_ce_orcamentos', $tbOrcamentosRelacaoRegistrosIdCeOrcamentos, PDO::PARAM_STR);
			//$statementOrcamentosRelacaoRegistroInsert->bindParam(':id_ce_orcamentos_itens', $tbOrcamentosRelacaoRegistrosIdCeOrcamentosItens, PDO::PARAM_STR);
			$statementOrcamentosRelacaoRegistroInsert->bindParam(':id_registro', $tbOrcamentosRelacaoRegistrosIdRegistro, PDO::PARAM_STR);
			$statementOrcamentosRelacaoRegistroInsert->bindParam(':tipo_categoria', $tbOrcamentosRelacaoRegistrosTipoCategoria, PDO::PARAM_STR);
			$statementOrcamentosRelacaoRegistroInsert->bindParam(':tipo_relacao', $tbOrcamentosRelacaoRegistrosTipoRelacao, PDO::PARAM_STR);
			$statementOrcamentosRelacaoRegistroInsert->bindParam(':tabela', $tbOrcamentosRelacaoRegistrosTabela, PDO::PARAM_STR);
			$statementOrcamentosRelacaoRegistroInsert->bindParam(':quantidade', $tbOrcamentosRelacaoRegistrosQuantidade, PDO::PARAM_STR);
			$statementOrcamentosRelacaoRegistroInsert->bindParam(':valor', $tbOrcamentosRelacaoRegistrosValor, PDO::PARAM_STR);
			$statementOrcamentosRelacaoRegistroInsert->bindParam(':valor1', $tbOrcamentosRelacaoRegistrosValor1, PDO::PARAM_STR);
			$statementOrcamentosRelacaoRegistroInsert->bindParam(':valor2', $tbOrcamentosRelacaoRegistrosValor2, PDO::PARAM_STR);
			$statementOrcamentosRelacaoRegistroInsert->bindParam(':ativacao', $tbOrcamentosRelacaoRegistrosAtivacao, PDO::PARAM_STR);
			$statementOrcamentosRelacaoRegistroInsert->bindParam(':ativacao1', $tbOrcamentosRelacaoRegistrosAtivacao1, PDO::PARAM_STR);
			$statementOrcamentosRelacaoRegistroInsert->bindParam(':ativacao2', $tbOrcamentosRelacaoRegistrosAtivacao2, PDO::PARAM_STR);
			$statementOrcamentosRelacaoRegistroInsert->bindParam(':ativacao3', $tbOrcamentosRelacaoRegistrosAtivacao3, PDO::PARAM_STR);
			$statementOrcamentosRelacaoRegistroInsert->bindParam(':ativacao4', $tbOrcamentosRelacaoRegistrosAtivacao4, PDO::PARAM_STR);
			$statementOrcamentosRelacaoRegistroInsert->bindParam(':informacao_complementar1', $tbOrcamentosRelacaoRegistrosIC1, PDO::PARAM_STR);
			$statementOrcamentosRelacaoRegistroInsert->bindParam(':informacao_complementar2', $tbOrcamentosRelacaoRegistrosIC2, PDO::PARAM_STR);
			$statementOrcamentosRelacaoRegistroInsert->bindParam(':informacao_complementar3', $tbOrcamentosRelacaoRegistrosIC3, PDO::PARAM_STR);
			$statementOrcamentosRelacaoRegistroInsert->bindParam(':informacao_complementar4', $tbOrcamentosRelacaoRegistrosIC4, PDO::PARAM_STR);
			$statementOrcamentosRelacaoRegistroInsert->bindParam(':informacao_complementar5', $tbOrcamentosRelacaoRegistrosOBS, PDO::PARAM_STR);
			$statementOrcamentosRelacaoRegistroInsert->bindParam(':obs', $obs, PDO::PARAM_STR);
            $statementOrcamentosRelacaoRegistroInsert->execute();
			
			
			//$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus2");
			$strRetorno = true;
		}else{
			//echo "erro";
			//$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus3");
		}
		
		//Limpeza de objetos.
		unset($strSqlOrcamentosRelacaoRegistroInsert);
		unset($statementOrcamentosRelacaoRegistroInsert);
		//----------
		
		return $strRetorno;
	}
	//**************************************************************************************

	
	//Função de inclusão de vínculos entre item e registro.
	//**************************************************************************************
	function OrcamentosItensRelacaoRegistroInsert($_tbOrcamentosItensRelacaoRegistrosId, 
	$_tbOrcamentosItensRelacaoRegistrosDataAtualizacao, 
	$_tbOrcamentosItensRelacaoRegistrosIdCeOrcamentos, 
	$_tbOrcamentosItensRelacaoRegistrosIdCeOrcamentosItens, 
	$_tbOrcamentosItensRelacaoRegistrosIdRegistro, 
	$_tbOrcamentosItensRelacaoRegistrosTipoCategoria, 
	$_tbOrcamentosItensRelacaoRegistrosTipoRelacao, 
	$_tbOrcamentosItensRelacaoRegistrosTabela, 
	$_tbOrcamentosItensRelacaoRegistrosQuantidade, 
	$_tbOrcamentosItensRelacaoRegistrosValor, 
	$_tbOrcamentosItensRelacaoRegistrosValor1, 
	$_tbOrcamentosItensRelacaoRegistrosValor2, 
	$_tbOrcamentosItensRelacaoRegistrosAtivacao, 
	$_tbOrcamentosItensRelacaoRegistrosAtivacao1, 
	$_tbOrcamentosItensRelacaoRegistrosAtivacao2, 
	$_tbOrcamentosItensRelacaoRegistrosAtivacao3, 
	$_tbOrcamentosItensRelacaoRegistrosAtivacao4, 
	$_tbOrcamentosItensRelacaoRegistrosIC1, 
	$_tbOrcamentosItensRelacaoRegistrosIC2, 
	$_tbOrcamentosItensRelacaoRegistrosIC3, 
	$_tbOrcamentosItensRelacaoRegistrosIC4, 
	$_tbOrcamentosItensRelacaoRegistrosIC5, 
	$_tbOrcamentosItensRelacaoRegistrosOBS)
	{
		//Variáveis.
		$strRetorno = false;
		//$idContadorUniversal = ContadorUniversal::ContadorUniversalUpdate(1);
		if($_tbOrcamentosItensRelacaoRegistrosId == "")
		{
			$tbOrcamentosItensRelacaoRegistrosId = ContadorUniversal::ContadorUniversalUpdate(1);
		}else{
			$tbOrcamentosItensRelacaoRegistrosId = $_tbOrcamentosItensRelacaoRegistrosId;
		}
		//$id = $_id;
		
		//$dataAtualizacao = $_dataAtualizacao;
		//$dataAtualizacao = date("Y") . "-" . date("m") . "-" . date("d");
		if($_tbOrcamentosItensRelacaoRegistrosDataAtualizacao == "")
		{
			$tbOrcamentosItensRelacaoRegistrosDataAtualizacao = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");
		}else{
			//$tbOrcamentosDataOrcamento = $_tbOrcamentosItensRelacaoRegistrosDataAtualizacao;
			$tbOrcamentosItensRelacaoRegistrosDataAtualizacao = Funcoes::DataGravacaoSql($_tbOrcamentosItensRelacaoRegistrosDataAtualizacao, $GLOBALS['configSistemaFormatoData']);
		}
		
		$tbOrcamentosItensRelacaoRegistrosIdCeOrcamentos = $_tbOrcamentosItensRelacaoRegistrosIdCeOrcamentos;
		$tbOrcamentosItensRelacaoRegistrosIdCeOrcamentosItens = $_tbOrcamentosItensRelacaoRegistrosIdCeOrcamentosItens;
		$tbOrcamentosItensRelacaoRegistrosIdRegistro = $_tbOrcamentosItensRelacaoRegistrosIdRegistro;
		$tbOrcamentosItensRelacaoRegistrosTipoCategoria = $_tbOrcamentosItensRelacaoRegistrosTipoCategoria;
		$tbOrcamentosItensRelacaoRegistrosTipoRelacao = $_tbOrcamentosItensRelacaoRegistrosTipoRelacao;
		$tbOrcamentosItensRelacaoRegistrosTabela = $_tbOrcamentosItensRelacaoRegistrosTabela;
		$tbOrcamentosItensRelacaoRegistrosQuantidade = $_tbOrcamentosItensRelacaoRegistrosQuantidade;
		$tbOrcamentosItensRelacaoRegistrosValor = Funcoes::MascaraValorGravar($_tbOrcamentosItensRelacaoRegistrosValor);
		$tbOrcamentosItensRelacaoRegistrosValor1 = Funcoes::MascaraValorGravar($_tbOrcamentosItensRelacaoRegistrosValor1);
		$tbOrcamentosItensRelacaoRegistrosValor2 = Funcoes::MascaraValorGravar($_tbOrcamentosItensRelacaoRegistrosValor2);
		$tbOrcamentosItensRelacaoRegistrosAtivacao = $_tbOrcamentosItensRelacaoRegistrosAtivacao;
		$tbOrcamentosItensRelacaoRegistrosAtivacao1 = $_tbOrcamentosItensRelacaoRegistrosAtivacao1;
		$tbOrcamentosItensRelacaoRegistrosAtivacao2 = $_tbOrcamentosItensRelacaoRegistrosAtivacao2;
		$tbOrcamentosItensRelacaoRegistrosAtivacao3 = $_tbOrcamentosItensRelacaoRegistrosAtivacao3;
		$tbOrcamentosItensRelacaoRegistrosAtivacao4 = $_tbOrcamentosItensRelacaoRegistrosAtivacao4;
		$tbOrcamentosItensRelacaoRegistrosIC1 = Funcoes::ConteudoMascaraGravacao01($_tbOrcamentosItensRelacaoRegistrosIC1);
		$tbOrcamentosItensRelacaoRegistrosIC2 = Funcoes::ConteudoMascaraGravacao01($_tbOrcamentosItensRelacaoRegistrosIC2);
		$tbOrcamentosItensRelacaoRegistrosIC3 = Funcoes::ConteudoMascaraGravacao01($_tbOrcamentosItensRelacaoRegistrosIC3);
		$tbOrcamentosItensRelacaoRegistrosIC4 = Funcoes::ConteudoMascaraGravacao01($_tbOrcamentosItensRelacaoRegistrosIC4);
		$tbOrcamentosItensRelacaoRegistrosIC5 = Funcoes::ConteudoMascaraGravacao01($_tbOrcamentosItensRelacaoRegistrosIC5);
		$tbOrcamentosItensRelacaoRegistrosOBS = Funcoes::ConteudoMascaraGravacao01($_tbOrcamentosItensRelacaoRegistrosOBS);	
		
	
		//Verificação de erro.
		/*
		echo "idRegistro=" . $idRegistro . "<br>";
		echo "idOrcamentosItensRelacaoRegistro=" . $idOrcamentosItensRelacaoRegistro . "<br>";
		echo "strTipoOrcamentosItensRelacaoRegistro=" . $strTipoOrcamentosItensRelacaoRegistro . "<br>";
		echo "strTabela=" . $strTabela . "<br>";
		echo "strNomeCampoIdRegistro=" . $strNomeCampoIdRegistro . "<br>";
		echo "strNomeCampoIdOrcamentosItensRelacaoRegistro=" . $strNomeCampoIdOrcamentosItensRelacaoRegistro . "<br>";
		*/
		
		//Inclusão de registro no BD.
		//----------
		$strSqlOrcamentosItensRelacaoRegistroInsert = "";
		$strSqlOrcamentosItensRelacaoRegistroInsert .= "INSERT INTO ce_orcamentos_itens_relacao_registros ";
		$strSqlOrcamentosItensRelacaoRegistroInsert .= "SET ";
		$strSqlOrcamentosItensRelacaoRegistroInsert .= "id = :id, ";
		$strSqlOrcamentosItensRelacaoRegistroInsert .= "data_atualizacao = :data_atualizacao, ";
		$strSqlOrcamentosItensRelacaoRegistroInsert .= "id_ce_orcamentos = :id_ce_orcamentos, ";
		$strSqlOrcamentosItensRelacaoRegistroInsert .= "id_ce_orcamentos_itens = :id_ce_orcamentos_itens, ";
		$strSqlOrcamentosItensRelacaoRegistroInsert .= "id_registro = :id_registro, ";
		//$strSqlOrcamentosItensRelacaoRegistroInsert .= "tipo_registro = :tipo_registro, ";
		$strSqlOrcamentosItensRelacaoRegistroInsert .= "tipo_categoria = :tipo_categoria, ";
		$strSqlOrcamentosItensRelacaoRegistroInsert .= "tipo_relacao = :tipo_relacao, ";
		$strSqlOrcamentosItensRelacaoRegistroInsert .= "tabela = :tabela, ";
		$strSqlOrcamentosItensRelacaoRegistroInsert .= "quantidade = :quantidade, ";
		$strSqlOrcamentosItensRelacaoRegistroInsert .= "valor = :valor, ";
		$strSqlOrcamentosItensRelacaoRegistroInsert .= "valor1 = :valor1, ";
		$strSqlOrcamentosItensRelacaoRegistroInsert .= "valor2 = :valor2, ";
		$strSqlOrcamentosItensRelacaoRegistroInsert .= "ativacao = :ativacao, ";
		$strSqlOrcamentosItensRelacaoRegistroInsert .= "ativacao1 = :ativacao1, ";
		$strSqlOrcamentosItensRelacaoRegistroInsert .= "ativacao2 = :ativacao2, ";
		$strSqlOrcamentosItensRelacaoRegistroInsert .= "ativacao3 = :ativacao3, ";
		$strSqlOrcamentosItensRelacaoRegistroInsert .= "ativacao4 = :ativacao4, ";
		$strSqlOrcamentosItensRelacaoRegistroInsert .= "informacao_complementar1 = :informacao_complementar1, ";
		$strSqlOrcamentosItensRelacaoRegistroInsert .= "informacao_complementar2 = :informacao_complementar2, ";
		$strSqlOrcamentosItensRelacaoRegistroInsert .= "informacao_complementar3 = :informacao_complementar3, ";
		$strSqlOrcamentosItensRelacaoRegistroInsert .= "informacao_complementar4 = :informacao_complementar4, ";
		$strSqlOrcamentosItensRelacaoRegistroInsert .= "informacao_complementar5 = :informacao_complementar5, ";
		$strSqlOrcamentosItensRelacaoRegistroInsert .= "obs = :obs ";
		//echo "strSqlCategoriasInsert=" . $strSqlOrcamentosItensRelacaoRegistroInsert . "<br>";
	
		
		$statementOrcamentosItensRelacaoRegistroInsert = $GLOBALS['dbSistemaConPDO']->prepare($strSqlOrcamentosItensRelacaoRegistroInsert);
		
		if ($statementOrcamentosItensRelacaoRegistroInsert !== false)
		{
			/*
			$statementOrcamentosItensRelacaoRegistroInsert->execute(array(
				"id" => $idTbOrcamentosItensRelacaoRegistro,
				"id_item" => $idItem,
				"id_registro" => $idRegistro,
				"tipo_categoria" => $tipoCategoria,
				"tabela" => $strTabela
			));
			*/			

			$statementOrcamentosItensRelacaoRegistroInsert->bindParam(':id', $tbOrcamentosItensRelacaoRegistrosId, PDO::PARAM_STR);
			$statementOrcamentosItensRelacaoRegistroInsert->bindParam(':data_atualizacao', $tbOrcamentosItensRelacaoRegistrosDataAtualizacao, PDO::PARAM_STR);
			$statementOrcamentosItensRelacaoRegistroInsert->bindParam(':id_ce_orcamentos', $tbOrcamentosItensRelacaoRegistrosIdCeOrcamentos, PDO::PARAM_STR);
			$statementOrcamentosItensRelacaoRegistroInsert->bindParam(':id_ce_orcamentos_itens', $tbOrcamentosItensRelacaoRegistrosIdCeOrcamentosItens, PDO::PARAM_STR);
			$statementOrcamentosItensRelacaoRegistroInsert->bindParam(':id_registro', $tbOrcamentosItensRelacaoRegistrosIdRegistro, PDO::PARAM_STR);
			$statementOrcamentosItensRelacaoRegistroInsert->bindParam(':tipo_categoria', $tbOrcamentosItensRelacaoRegistrosTipoCategoria, PDO::PARAM_STR);
			$statementOrcamentosItensRelacaoRegistroInsert->bindParam(':tipo_relacao', $tbOrcamentosItensRelacaoRegistrosTipoRelacao, PDO::PARAM_STR);
			$statementOrcamentosItensRelacaoRegistroInsert->bindParam(':tabela', $tbOrcamentosItensRelacaoRegistrosTabela, PDO::PARAM_STR);
			$statementOrcamentosItensRelacaoRegistroInsert->bindParam(':quantidade', $tbOrcamentosItensRelacaoRegistrosQuantidade, PDO::PARAM_STR);
			$statementOrcamentosItensRelacaoRegistroInsert->bindParam(':valor', $tbOrcamentosItensRelacaoRegistrosValor, PDO::PARAM_STR);
			$statementOrcamentosItensRelacaoRegistroInsert->bindParam(':valor1', $tbOrcamentosItensRelacaoRegistrosValor1, PDO::PARAM_STR);
			$statementOrcamentosItensRelacaoRegistroInsert->bindParam(':valor2', $tbOrcamentosItensRelacaoRegistrosValor2, PDO::PARAM_STR);
			$statementOrcamentosItensRelacaoRegistroInsert->bindParam(':ativacao', $tbOrcamentosItensRelacaoRegistrosAtivacao, PDO::PARAM_STR);
			$statementOrcamentosItensRelacaoRegistroInsert->bindParam(':ativacao1', $tbOrcamentosItensRelacaoRegistrosAtivacao1, PDO::PARAM_STR);
			$statementOrcamentosItensRelacaoRegistroInsert->bindParam(':ativacao2', $tbOrcamentosItensRelacaoRegistrosAtivacao2, PDO::PARAM_STR);
			$statementOrcamentosItensRelacaoRegistroInsert->bindParam(':ativacao3', $tbOrcamentosItensRelacaoRegistrosAtivacao3, PDO::PARAM_STR);
			$statementOrcamentosItensRelacaoRegistroInsert->bindParam(':ativacao4', $tbOrcamentosItensRelacaoRegistrosAtivacao4, PDO::PARAM_STR);
			$statementOrcamentosItensRelacaoRegistroInsert->bindParam(':informacao_complementar1', $tbOrcamentosItensRelacaoRegistrosIC1, PDO::PARAM_STR);
			$statementOrcamentosItensRelacaoRegistroInsert->bindParam(':informacao_complementar2', $tbOrcamentosItensRelacaoRegistrosIC2, PDO::PARAM_STR);
			$statementOrcamentosItensRelacaoRegistroInsert->bindParam(':informacao_complementar3', $tbOrcamentosItensRelacaoRegistrosIC3, PDO::PARAM_STR);
			$statementOrcamentosItensRelacaoRegistroInsert->bindParam(':informacao_complementar4', $tbOrcamentosItensRelacaoRegistrosIC4, PDO::PARAM_STR);
			$statementOrcamentosItensRelacaoRegistroInsert->bindParam(':informacao_complementar5', $tbOrcamentosItensRelacaoRegistrosOBS, PDO::PARAM_STR);
			$statementOrcamentosItensRelacaoRegistroInsert->bindParam(':obs', $obs, PDO::PARAM_STR);
            $statementOrcamentosItensRelacaoRegistroInsert->execute();
			
			
			//$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus2");
			$strRetorno = true;
		}else{
			//echo "erro";
			//$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus3");
		}
		
		//Limpeza de objetos.
		unset($strSqlOrcamentosItensRelacaoRegistroInsert);
		unset($statementOrcamentosItensRelacaoRegistroInsert);
		//----------
		
		return $strRetorno;
	}
	//**************************************************************************************
	
	
	//Função para gravar grupos de e-mails avulso.
	//**************************************************************************************
	function InsertNewsletterEmailsAvulsoGrupos($_tbNewsletterEmailsAvulsoGruposId, 
	$_tbNewsletterEmailsAvulsoGruposIdTbNewsletter, 
	$_tbNewsletterEmailsAvulsoGruposDataGrupo, 
	$_tbNewsletterEmailsAvulsoGruposGrupoEmails, 
	$_tbNewsletterEmailsAvulsoGruposAtivacao)
	{
        //Variáveis.
        //----------
		$strRetorno = false;

		$tbNewsletterEmailsAvulsoGruposId = $_tbNewsletterEmailsAvulsoGruposId;
		if($_tbNewsletterEmailsAvulsoGruposId == "")
		{
			$tbNewsletterEmailsAvulsoGruposId = ContadorUniversal::ContadorUniversalUpdate(1);
		}
		
		$tbNewsletterEmailsAvulsoGruposIdTbNewsletter = $_tbNewsletterEmailsAvulsoGruposIdTbNewsletter;

		//$tbNewsletterEmailsAvulsoGruposDataGrupo = $_tbNewsletterEmailsAvulsoGruposDataGrupo;
		if($_tbNewsletterEmailsAvulsoGruposDataGrupo == "")
		{
			$tbNewsletterEmailsAvulsoGruposDataGrupo = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");
		}else{
			//$tbOrcamentosDataOrcamento = $_tbOrcamentosItensRelacaoRegistrosDataAtualizacao;
			$tbNewsletterEmailsAvulsoGruposDataGrupo = Funcoes::DataGravacaoSql($_tbNewsletterEmailsAvulsoGruposDataGrupo, $GLOBALS['configSistemaFormatoData']);
		}
		
		$tbNewsletterEmailsAvulsoGruposGrupoEmails = Funcoes::ConteudoMascaraGravacao01($_tbNewsletterEmailsAvulsoGruposGrupoEmails);
		$tbNewsletterEmailsAvulsoGruposAtivacao = $_tbNewsletterEmailsAvulsoGruposAtivacao;
		
		$strSqlNewslettersEmailsAvulsoInsert = "";
		
		
		//Debug.
		//echo "tbNewsletterEmailsAvulsoGruposId=" . $tbNewsletterEmailsAvulsoGruposId . "<br />"; 
		//echo "tbNewsletterEmailsAvulsoGruposIdTbNewsletter=" . $tbNewsletterEmailsAvulsoGruposIdTbNewsletter . "<br />"; 
		//echo "tbNewsletterEmailsAvulsoGruposDataGrupo=" . $tbNewsletterEmailsAvulsoGruposDataGrupo . "<br />"; 
		//echo "tbNewsletterEmailsAvulsoGruposGrupoEmails=" . $tbNewsletterEmailsAvulsoGruposGrupoEmails . "<br />"; 
		//echo "tbNewsletterEmailsAvulsoGruposAtivacao=" . $tbNewsletterEmailsAvulsoGruposAtivacao . "<br />"; 
	    //----------
		
		
		//Inclusão de registro no BD.
		//----------
		$strSqlNewsletterEmailsAvulsoGruposInsert = "";
		$strSqlNewsletterEmailsAvulsoGruposInsert .= "INSERT INTO tb_newsletter_emails_avulso_grupos ";
		$strSqlNewsletterEmailsAvulsoGruposInsert .= "SET ";
		$strSqlNewsletterEmailsAvulsoGruposInsert .= "id = :id, ";
		$strSqlNewsletterEmailsAvulsoGruposInsert .= "id_tb_newsletter = :id_tb_newsletter, ";
		$strSqlNewsletterEmailsAvulsoGruposInsert .= "data_grupo = :data_grupo, ";
		$strSqlNewsletterEmailsAvulsoGruposInsert .= "grupo_emails = :grupo_emails, ";
		$strSqlNewsletterEmailsAvulsoGruposInsert .= "ativacao = :ativacao ";
		//----------
		
		
		//Parâmetros.
		//----------
		//$statementNewsletterEmailsAvulsoGruposInsert = $dbSistemaConPDO->prepare($strSqlNewsletterEmailsAvulsoGruposInsert);
		$statementNewsletterEmailsAvulsoGruposInsert = $GLOBALS['dbSistemaConPDO']->prepare($strSqlNewsletterEmailsAvulsoGruposInsert);

		if ($statementNewsletterEmailsAvulsoGruposInsert !== false)
		{
			/*
			$statementNewsletterEmailsAvulsoGruposInsert->execute(array(
				"id" => $id,
				"id_tb_newsletter" => $idTbNewsletter,
				"data_grupo" => $dataGrupo,
				"grupo_emails" => $grupoEmails,
				"ativacao" => $ativacao
			));
			*/
			$statementNewsletterEmailsAvulsoGruposInsert->bindParam(':id', $tbNewsletterEmailsAvulsoGruposId, PDO::PARAM_STR);
			$statementNewsletterEmailsAvulsoGruposInsert->bindParam(':id_tb_newsletter', $tbNewsletterEmailsAvulsoGruposIdTbNewsletter, PDO::PARAM_STR);
			$statementNewsletterEmailsAvulsoGruposInsert->bindParam(':data_grupo', $tbNewsletterEmailsAvulsoGruposDataGrupo, PDO::PARAM_STR);
			$statementNewsletterEmailsAvulsoGruposInsert->bindParam(':grupo_emails', $tbNewsletterEmailsAvulsoGruposGrupoEmails, PDO::PARAM_STR);
			$statementNewsletterEmailsAvulsoGruposInsert->bindParam(':ativacao', $tbNewsletterEmailsAvulsoGruposAtivacao, PDO::PARAM_STR);
            $statementNewsletterEmailsAvulsoGruposInsert->execute();
			
			//$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus2");
			$strRetorno = true;
		}else{
			//echo "erro";
			//$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus3");
		}
		//----------
		
		
		//Limpeza de objetos.
		//----------
		unset($strSqlNewsletterEmailsAvulsoGruposInsert);
		unset($statementNewsletterEmailsAvulsoGruposInsert);
		//----------


		return $strRetorno;
	}
	//**************************************************************************************

	
	//Função para gravar e-mails avulso.
	//**************************************************************************************
	function InsertNewsletterEmailsAvulso($_tbNewsletterEmailsAvulsoId, 
	$_tbNewsletterEmailsAvulsoIdTbNewsletterEmailsAvulsoGrupos, 
	$_tbNewsletterEmailsAvulsoEmail, 
	$_tbNewsletterEmailsAvulsoAtivacaoMalaDireta)
	{
		
        //Variáveis.
        //----------
		$strRetorno = false;

		$tbNewsletterEmailsAvulsoId = $_tbNewsletterEmailsAvulsoId;
		if($tbNewsletterEmailsAvulsoId == "")
		{
			$tbNewsletterEmailsAvulsoId = ContadorUniversal::ContadorUniversalUpdate(1);
		}
		$tbNewsletterEmailsAvulsoIdTbNewsletterEmailsAvulsoGrupos = $_tbNewsletterEmailsAvulsoIdTbNewsletterEmailsAvulsoGrupos;
		$tbNewsletterEmailsAvulsoEmail = trim(Funcoes::ConteudoMascaraGravacao01($_tbNewsletterEmailsAvulsoEmail));
		$tbNewsletterEmailsAvulsoAtivacaoMalaDireta = $_tbNewsletterEmailsAvulsoAtivacaoMalaDireta;
		
		$strSqlNewslettersEmailsAvulsoInsert = "";
	    //----------
		
		
		//Inclusão de registro no BD.
		//----------
		$strSqlNewslettersEmailsAvulsoInsert .= "INSERT INTO tb_newsletter_emails_avulso ";
		$strSqlNewslettersEmailsAvulsoInsert .= "SET ";
		$strSqlNewslettersEmailsAvulsoInsert .= "id = :id, ";
		$strSqlNewslettersEmailsAvulsoInsert .= "id_tb_newsletter_emails_avulso_grupos = :id_tb_newsletter_emails_avulso_grupos, ";
		$strSqlNewslettersEmailsAvulsoInsert .= "email = :email, ";
		$strSqlNewslettersEmailsAvulsoInsert .= "ativacao_mala_direta = :ativacao_mala_direta ";
		//----------
		
		
		//Parâmetros.
		//----------
		//$statementNewslettersEmailsAvulsoInsert = $dbSistemaConPDO->prepare($strSqlNewslettersEmailsAvulsoInsert);
		$statementNewslettersEmailsAvulsoInsert = $GLOBALS['dbSistemaConPDO']->prepare($strSqlNewslettersEmailsAvulsoInsert);

		if ($statementNewslettersEmailsAvulsoInsert !== false)
		{
			$statementNewslettersEmailsAvulsoInsert->execute(array(
				"id" => $tbNewsletterEmailsAvulsoId,
				"id_tb_newsletter_emails_avulso_grupos" => $tbNewsletterEmailsAvulsoIdTbNewsletterEmailsAvulsoGrupos,
				"email" => $tbNewsletterEmailsAvulsoEmail,
				"ativacao_mala_direta" => $tbNewsletterEmailsAvulsoAtivacaoMalaDireta
			));
			
			//$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus2");
			$strRetorno = true;
		}else{
			//echo "erro";
			//$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus3");
		}
		//----------
		
		
		//Limpeza de objetos.
		//----------
		unset($strSqlNewslettersEmailsAvulsoInsert);
		unset($statementNewslettersEmailsAvulsoInsert);
		//----------
		
		
		return $strRetorno;
	}
	//**************************************************************************************
	
	
    //Função de inclusão de processos.
    //**************************************************************************************
    function InsertProcessos($_tbProcessosId, 
	$_tbProcessosIdParent, 
	$_tbProcessosIdTbCadastro1, 
	$_tbProcessosIdTbCadastro2, 
	$_tbProcessosIdTbCadastro3, 	
	$_tbProcessosNClassificacao, 
	$_tbProcessosDataCriacao, 
	$_tbProcessosDataAbertura, 
	$_tbProcessosDataDistribuicao, 
	$_tbProcessosDataAdmissao, 
	$_tbProcessosDataDemissao, 
	$_tbProcessosData1, 
	$_tbProcessosData2, 
	$_tbProcessosData3, 
	$_tbProcessosData4, 
	$_tbProcessosData5, 
	$_tbProcessosData6, 
	$_tbProcessosData7, 
	$_tbProcessosData8, 
	$_tbProcessosData9, 
	$_tbProcessosData10, 
	$_tbProcessosProcesso, 
	$_tbProcessosDescricao, 
	$_tbProcessosIdTbProcessosStatus, 
	$_tbProcessosPalavrasChave, 
	$_tbProcessosValor, 
	$_tbProcessosValor1, 
	$_tbProcessosValor2, 
	$_tbProcessosValor3, 
	$_tbProcessosValor4, 
	$_tbProcessosValor5, 
	$_tbProcessosURL1, 
	$_tbProcessosURL2, 
	$_tbProcessosURL3, 
	$_tbProcessosURL4, 
	$_tbProcessosURL5, 
	$_tbProcessosIC1, 
	$_tbProcessosIC2, 
	$_tbProcessosIC3, 
	$_tbProcessosIC4, 
	$_tbProcessosIC5, 
	$_tbProcessosIC6, 
	$_tbProcessosIC7, 
	$_tbProcessosIC8, 
	$_tbProcessosIC9, 
	$_tbProcessosIC10, 
	$_tbProcessosIC11, 
	$_tbProcessosIC12, 
	$_tbProcessosIC13, 
	$_tbProcessosIC14, 
	$_tbProcessosIC15, 
	$_tbProcessosIC16, 
	$_tbProcessosIC17, 
	$_tbProcessosIC18, 
	$_tbProcessosIC19, 
	$_tbProcessosIC20, 
	$_tbProcessosIC21, 
	$_tbProcessosIC22, 
	$_tbProcessosIC23, 
	$_tbProcessosIC24, 
	$_tbProcessosIC25, 
	$_tbProcessosIC26, 
	$_tbProcessosIC27, 
	$_tbProcessosIC28, 
	$_tbProcessosIC29, 
	$_tbProcessosIC30, 
	$_tbProcessosIC31, 
	$_tbProcessosIC32, 
	$_tbProcessosIC33, 
	$_tbProcessosIC34, 
	$_tbProcessosIC35, 
	$_tbProcessosIC36, 
	$_tbProcessosIC37, 
	$_tbProcessosIC38, 
	$_tbProcessosIC39, 
	$_tbProcessosIC40, 
	$_tbProcessosIC41, 
	$_tbProcessosIC42, 
	$_tbProcessosIC43, 
	$_tbProcessosIC44, 
	$_tbProcessosIC45, 
	$_tbProcessosIC46, 
	$_tbProcessosIC47, 
	$_tbProcessosIC48, 
	$_tbProcessosIC49, 
	$_tbProcessosIC50, 
	$_tbProcessosIC51, 
	$_tbProcessosIC52, 
	$_tbProcessosIC53, 
	$_tbProcessosIC54, 
	$_tbProcessosIC55, 
	$_tbProcessosIC56, 
	$_tbProcessosIC57, 
	$_tbProcessosIC58, 
	$_tbProcessosIC59, 
	$_tbProcessosIC60, 
	$_tbProcessosAtivacao, 
	$_tbProcessosAtivacao1, 
	$_tbProcessosAtivacao2, 
	$_tbProcessosAtivacao3, 
	$_tbProcessosAtivacao4, 	
	$_tbProcessosNVisitas, 
	$_tbProcessosAcessoRestrito)
	{
		//Variáveis.
		//----------
		$strRetorno = false;
		
		$tbProcessosId = $_tbProcessosId;
		if($tbProcessosId == "")
		{
			$tbProcessosId = ContadorUniversal::ContadorUniversalUpdate(1);
		}
		$tbProcessosIdParent = $_tbProcessosIdParent;
		
		$tbProcessosIdTbCadastro1 = $_tbProcessosIdTbCadastro1;
		if($tbProcessosIdTbCadastro1 == "")
		{
			$tbProcessosIdTbCadastro1 = 0;
		}
		$tbProcessosIdTbCadastro2 = $_tbProcessosIdTbCadastro2;
		if($tbProcessosIdTbCadastro2 == "")
		{
			$tbProcessosIdTbCadastro2 = 0;
		}
		$tbProcessosIdTbCadastro3 = $_tbProcessosIdTbCadastro3;
		if($tbProcessosIdTbCadastro3 == "")
		{
			$tbProcessosIdTbCadastro3 = 0;
		}
		
		$tbProcessosNClassificacao = $_tbProcessosNClassificacao;
		if($tbProcessosNClassificacao == "")
		{
			$tbProcessosNClassificacao = 0;
		}
		
		//$tbProcessosDataCriacao = $_tbProcessosDataCriacao;
		$tbProcessosDataCriacao = Funcoes::DataGravacaoSql($_tbProcessosDataCriacao, $GLOBALS['configSistemaFormatoData']);
		if($tbProcessosDataCriacao == "")
		{
			//$data_publicacao = NULL;	
			$tbProcessosDataCriacao = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");
		}

		$tbProcessosDataAbertura = Funcoes::DataGravacaoSql($_tbProcessosDataAbertura, $GLOBALS['configSistemaFormatoData']);
		if($tbProcessosDataAbertura == "")
		{
			$tbProcessosDataAbertura = NULL;	
		}
		$tbProcessosDataDistribuicao = Funcoes::DataGravacaoSql($_tbProcessosDataDistribuicao, $GLOBALS['configSistemaFormatoData']);
		if($tbProcessosDataDistribuicao == "")
		{
			$tbProcessosDataDistribuicao = NULL;	
		}
		$tbProcessosDataAdmissao = Funcoes::DataGravacaoSql($_tbProcessosDataAdmissao, $GLOBALS['configSistemaFormatoData']);
		if($tbProcessosDataAdmissao == "")
		{
			$tbProcessosDataAdmissao = NULL;	
		}
		$tbProcessosDataDemissao = Funcoes::DataGravacaoSql($_tbProcessosDataDemissao, $GLOBALS['configSistemaFormatoData']);
		if($tbProcessosDataDemissao == "")
		{
			$tbProcessosDataDemissao = NULL;	
		}
		
		$tbProcessosData1 = Funcoes::DataGravacaoSql($_tbProcessosData1, $GLOBALS['configSistemaFormatoData']);
		if($tbProcessosData1 == "")
		{
			$tbProcessosData1 = NULL;	
		}
		$tbProcessosData2 = Funcoes::DataGravacaoSql($_tbProcessosData2, $GLOBALS['configSistemaFormatoData']);
		if($tbProcessosData2 == "")
		{
			$tbProcessosData2 = NULL;	
		}
		$tbProcessosData3 = Funcoes::DataGravacaoSql($_tbProcessosData3, $GLOBALS['configSistemaFormatoData']);
		if($tbProcessosData3 == "")
		{
			$tbProcessosData3 = NULL;	
		}
		$tbProcessosData4 = Funcoes::DataGravacaoSql($_tbProcessosData4, $GLOBALS['configSistemaFormatoData']);
		if($tbProcessosData4 == "")
		{
			$tbProcessosData4 = NULL;	
		}
		$tbProcessosData5 = Funcoes::DataGravacaoSql($_tbProcessosData5, $GLOBALS['configSistemaFormatoData']);
		if($tbProcessosData5 == "")
		{
			$tbProcessosData5 = NULL;	
		}
		$tbProcessosData6 = Funcoes::DataGravacaoSql($_tbProcessosData6, $GLOBALS['configSistemaFormatoData']);
		if($tbProcessosData6 == "")
		{
			$tbProcessosData6 = NULL;	
		}
		$tbProcessosData7 = Funcoes::DataGravacaoSql($_tbProcessosData7, $GLOBALS['configSistemaFormatoData']);
		if($tbProcessosData7 == "")
		{
			$tbProcessosData7 = NULL;	
		}
		$tbProcessosData8 = Funcoes::DataGravacaoSql($_tbProcessosData8, $GLOBALS['configSistemaFormatoData']);
		if($tbProcessosData8 == "")
		{
			$tbProcessosData8 = NULL;	
		}
		$tbProcessosData9 = Funcoes::DataGravacaoSql($_tbProcessosData9, $GLOBALS['configSistemaFormatoData']);
		if($tbProcessosData9 == "")
		{
			$tbProcessosData9 = NULL;	
		}
		$tbProcessosData10 = Funcoes::DataGravacaoSql($_tbProcessosData10, $GLOBALS['configSistemaFormatoData']);
		if($tbProcessosData10 == "")
		{
			$tbProcessosData10 = NULL;	
		}
		
		$tbProcessosProcesso = Funcoes::ConteudoMascaraGravacao01($_tbProcessosProcesso);
		$tbProcessosDescricao = Funcoes::ConteudoMascaraGravacao01($_tbProcessosDescricao);
		
		$tbProcessosIdTbProcessosStatus = $_tbProcessosIdTbProcessosStatus;
		if($tbProcessosIdTbProcessosStatus == "")
		{
			$tbProcessosIdTbProcessosStatus = 0;
		}
		
		$tbProcessosPalavrasChave = $_tbProcessosPalavrasChave;
		
		$tbProcessosValor = Funcoes::FormatarValorGravar($_tbProcessosValor);
		if($tbProcessosValor == "")
		{
			$tbProcessosValor = 0;	
		}
		
		$tbProcessosValor1 = 0;
		$tbProcessosValor2 = 0;
		$tbProcessosValor3 = 0;
		$tbProcessosValor4 = 0;
		$tbProcessosValor5 = 0;
		
		$tbProcessosURL1 = Funcoes::ConteudoMascaraGravacao01($tbProcessosURL1);
		$tbProcessosURL2 = Funcoes::ConteudoMascaraGravacao01($tbProcessosURL2);
		$tbProcessosURL3 = Funcoes::ConteudoMascaraGravacao01($tbProcessosURL3);
		$tbProcessosURL4 = Funcoes::ConteudoMascaraGravacao01($tbProcessosURL4);
		$tbProcessosURL5 = Funcoes::ConteudoMascaraGravacao01($tbProcessosURL5);
		
		$tbProcessosIC1 = Funcoes::ConteudoMascaraGravacao01($_tbProcessosIC1);
		$tbProcessosIC2 = Funcoes::ConteudoMascaraGravacao01($_tbProcessosIC2);
		$tbProcessosIC3 = Funcoes::ConteudoMascaraGravacao01($_tbProcessosIC3);
		$tbProcessosIC4 = Funcoes::ConteudoMascaraGravacao01($_tbProcessosIC4);
		$tbProcessosIC5 = Funcoes::ConteudoMascaraGravacao01($_tbProcessosIC5);
		$tbProcessosIC6 = Funcoes::ConteudoMascaraGravacao01($_tbProcessosIC6);
		$tbProcessosIC7 = Funcoes::ConteudoMascaraGravacao01($_tbProcessosIC7);
		$tbProcessosIC8 = Funcoes::ConteudoMascaraGravacao01($_tbProcessosIC8);
		$tbProcessosIC9 = Funcoes::ConteudoMascaraGravacao01($_tbProcessosIC9);
		$tbProcessosIC10 = Funcoes::ConteudoMascaraGravacao01($_tbProcessosIC10);
		$tbProcessosIC11 = Funcoes::ConteudoMascaraGravacao01($_tbProcessosIC11);
		$tbProcessosIC12 = Funcoes::ConteudoMascaraGravacao01($_tbProcessosIC12);
		$tbProcessosIC13 = Funcoes::ConteudoMascaraGravacao01($_tbProcessosIC13);
		$tbProcessosIC14 = Funcoes::ConteudoMascaraGravacao01($_tbProcessosIC14);
		$tbProcessosIC15 = Funcoes::ConteudoMascaraGravacao01($_tbProcessosIC15);
		$tbProcessosIC16 = Funcoes::ConteudoMascaraGravacao01($_tbProcessosIC16);
		$tbProcessosIC17 = Funcoes::ConteudoMascaraGravacao01($_tbProcessosIC17);
		$tbProcessosIC18 = Funcoes::ConteudoMascaraGravacao01($_tbProcessosIC18);
		$tbProcessosIC19 = Funcoes::ConteudoMascaraGravacao01($_tbProcessosIC19);
		$tbProcessosIC20 = Funcoes::ConteudoMascaraGravacao01($_tbProcessosIC20);
		$tbProcessosIC21 = Funcoes::ConteudoMascaraGravacao01($_tbProcessosIC21);
		$tbProcessosIC22 = Funcoes::ConteudoMascaraGravacao01($_tbProcessosIC22);
		$tbProcessosIC23 = Funcoes::ConteudoMascaraGravacao01($_tbProcessosIC23);
		$tbProcessosIC24 = Funcoes::ConteudoMascaraGravacao01($_tbProcessosIC24);
		$tbProcessosIC25 = Funcoes::ConteudoMascaraGravacao01($_tbProcessosIC25);
		$tbProcessosIC26 = Funcoes::ConteudoMascaraGravacao01($_tbProcessosIC26);
		$tbProcessosIC27 = Funcoes::ConteudoMascaraGravacao01($_tbProcessosIC27);
		$tbProcessosIC28 = Funcoes::ConteudoMascaraGravacao01($_tbProcessosIC28);
		$tbProcessosIC29 = Funcoes::ConteudoMascaraGravacao01($_tbProcessosIC29);
		$tbProcessosIC30 = Funcoes::ConteudoMascaraGravacao01($_tbProcessosIC30);
		$tbProcessosIC31 = Funcoes::ConteudoMascaraGravacao01($_tbProcessosIC31);
		$tbProcessosIC32 = Funcoes::ConteudoMascaraGravacao01($_tbProcessosIC32);
		$tbProcessosIC33 = Funcoes::ConteudoMascaraGravacao01($_tbProcessosIC33);
		$tbProcessosIC34 = Funcoes::ConteudoMascaraGravacao01($_tbProcessosIC34);
		$tbProcessosIC35 = Funcoes::ConteudoMascaraGravacao01($_tbProcessosIC35);
		$tbProcessosIC36 = Funcoes::ConteudoMascaraGravacao01($_tbProcessosIC36);
		$tbProcessosIC37 = Funcoes::ConteudoMascaraGravacao01($_tbProcessosIC37);
		$tbProcessosIC38 = Funcoes::ConteudoMascaraGravacao01($_tbProcessosIC38);
		$tbProcessosIC39 = Funcoes::ConteudoMascaraGravacao01($_tbProcessosIC39);
		$tbProcessosIC40 = Funcoes::ConteudoMascaraGravacao01($_tbProcessosIC40);
		$tbProcessosIC41 = Funcoes::ConteudoMascaraGravacao01($_tbProcessosIC41);
		$tbProcessosIC42 = Funcoes::ConteudoMascaraGravacao01($_tbProcessosIC42);
		$tbProcessosIC43 = Funcoes::ConteudoMascaraGravacao01($_tbProcessosIC43);
		$tbProcessosIC44 = Funcoes::ConteudoMascaraGravacao01($_tbProcessosIC44);
		$tbProcessosIC45 = Funcoes::ConteudoMascaraGravacao01($_tbProcessosIC45);
		$tbProcessosIC46 = Funcoes::ConteudoMascaraGravacao01($_tbProcessosIC46);
		$tbProcessosIC47 = Funcoes::ConteudoMascaraGravacao01($_tbProcessosIC47);
		$tbProcessosIC48 = Funcoes::ConteudoMascaraGravacao01($_tbProcessosIC48);
		$tbProcessosIC49 = Funcoes::ConteudoMascaraGravacao01($_tbProcessosIC49);
		$tbProcessosIC50 = Funcoes::ConteudoMascaraGravacao01($_tbProcessosIC50);
		$tbProcessosIC51 = Funcoes::ConteudoMascaraGravacao01($_tbProcessosIC51);
		$tbProcessosIC52 = Funcoes::ConteudoMascaraGravacao01($_tbProcessosIC52);
		$tbProcessosIC53 = Funcoes::ConteudoMascaraGravacao01($_tbProcessosIC53);
		$tbProcessosIC54 = Funcoes::ConteudoMascaraGravacao01($_tbProcessosIC54);
		$tbProcessosIC55 = Funcoes::ConteudoMascaraGravacao01($_tbProcessosIC55);
		$tbProcessosIC56 = Funcoes::ConteudoMascaraGravacao01($_tbProcessosIC56);
		$tbProcessosIC57 = Funcoes::ConteudoMascaraGravacao01($_tbProcessosIC57);
		$tbProcessosIC58 = Funcoes::ConteudoMascaraGravacao01($_tbProcessosIC58);
		$tbProcessosIC59 = Funcoes::ConteudoMascaraGravacao01($_tbProcessosIC59);
		$tbProcessosIC60 = Funcoes::ConteudoMascaraGravacao01($_tbProcessosIC60);
		
		$tbProcessosAtivacao = $_tbProcessosAtivacao;
		$tbProcessosAtivacao1 = $_tbProcessosAtivacao1;
		if($tbProcessosAtivacao1 == "")
		{
			$tbProcessosAtivacao1 = 0;
		}
		$tbProcessosAtivacao2 = $_tbProcessosAtivacao2;
		if($tbProcessosAtivacao2 == "")
		{
			$tbProcessosAtivacao2 = 0;
		}
		$tbProcessosAtivacao3 = $_tbProcessosAtivacao3;
		if($tbProcessosAtivacao3 == "")
		{
			$tbProcessosAtivacao3 = 0;
		}
		$tbProcessosAtivacao4 = $_tbProcessosAtivacao4;
		if($tbProcessosAtivacao4 == "")
		{
			$tbProcessosAtivacao4 = 0;
		}
		
		$tbProcessosNVisitas = 0;
		
		$tbProcessosAcessoRestrito = $_tbProcessosAcessoRestrito;
		if($tbProcessosAcessoRestrito == "")
		{
			$tbProcessosAcessoRestrito = 0;
		}
		//----------

		
		//Inclusão de registro no BD.
		//----------
		$strSqlProcessosInsert = "";
		$strSqlProcessosInsert .= "INSERT INTO tb_processos ";
		$strSqlProcessosInsert .= "SET ";
		$strSqlProcessosInsert .= "id = :id, ";
		$strSqlProcessosInsert .= "id_parent = :id_parent, ";
		
		$strSqlProcessosInsert .= "id_tb_cadastro1 = :id_tb_cadastro1, ";
		$strSqlProcessosInsert .= "id_tb_cadastro2 = :id_tb_cadastro2, ";
		$strSqlProcessosInsert .= "id_tb_cadastro3 = :id_tb_cadastro3, ";
		
		$strSqlProcessosInsert .= "n_classificacao = :n_classificacao, ";
		
		$strSqlProcessosInsert .= "data_criacao = :data_criacao, ";
		$strSqlProcessosInsert .= "data_abertura = :data_abertura, ";
		$strSqlProcessosInsert .= "data_distribuicao = :data_distribuicao, ";
		$strSqlProcessosInsert .= "data_admissao = :data_admissao, ";
		$strSqlProcessosInsert .= "data_demissao = :data_demissao, ";
		
		$strSqlProcessosInsert .= "data1 = :data1, ";
		$strSqlProcessosInsert .= "data2 = :data2, ";
		$strSqlProcessosInsert .= "data3 = :data3, ";
		$strSqlProcessosInsert .= "data4 = :data4, ";
		$strSqlProcessosInsert .= "data5 = :data5, ";
		$strSqlProcessosInsert .= "data6 = :data6, ";
		$strSqlProcessosInsert .= "data7 = :data7, ";
		$strSqlProcessosInsert .= "data8 = :data8, ";
		$strSqlProcessosInsert .= "data9 = :data9, ";
		$strSqlProcessosInsert .= "data10 = :data10, ";
		
		$strSqlProcessosInsert .= "processo = :processo, ";
		$strSqlProcessosInsert .= "descricao = :descricao, ";
		$strSqlProcessosInsert .= "id_tb_processos_status = :id_tb_processos_status, ";
		$strSqlProcessosInsert .= "palavras_chave = :palavras_chave, ";
		
		$strSqlProcessosInsert .= "valor = :valor, ";
		$strSqlProcessosInsert .= "valor1 = :valor1, ";
		$strSqlProcessosInsert .= "valor2 = :valor2, ";
		$strSqlProcessosInsert .= "valor3 = :valor3, ";
		$strSqlProcessosInsert .= "valor4 = :valor4, ";
		$strSqlProcessosInsert .= "valor5 = :valor5, ";
		
		$strSqlProcessosInsert .= "url1 = :url1, ";
		$strSqlProcessosInsert .= "url2 = :url2, ";
		$strSqlProcessosInsert .= "url3 = :url3, ";
		$strSqlProcessosInsert .= "url4 = :url4, ";
		$strSqlProcessosInsert .= "url5 = :url5, ";
		
		$strSqlProcessosInsert .= "informacao_complementar1 = :informacao_complementar1, ";
		$strSqlProcessosInsert .= "informacao_complementar2 = :informacao_complementar2, ";
		$strSqlProcessosInsert .= "informacao_complementar3 = :informacao_complementar3, ";
		$strSqlProcessosInsert .= "informacao_complementar4 = :informacao_complementar4, ";
		$strSqlProcessosInsert .= "informacao_complementar5 = :informacao_complementar5, ";
		$strSqlProcessosInsert .= "informacao_complementar6 = :informacao_complementar6, ";
		$strSqlProcessosInsert .= "informacao_complementar7 = :informacao_complementar7, ";
		$strSqlProcessosInsert .= "informacao_complementar8 = :informacao_complementar8, ";
		$strSqlProcessosInsert .= "informacao_complementar9 = :informacao_complementar9, ";
		$strSqlProcessosInsert .= "informacao_complementar10 = :informacao_complementar10, ";
		$strSqlProcessosInsert .= "informacao_complementar11 = :informacao_complementar11, ";
		$strSqlProcessosInsert .= "informacao_complementar12 = :informacao_complementar12, ";
		$strSqlProcessosInsert .= "informacao_complementar13 = :informacao_complementar13, ";
		$strSqlProcessosInsert .= "informacao_complementar14 = :informacao_complementar14, ";
		$strSqlProcessosInsert .= "informacao_complementar15 = :informacao_complementar15, ";
		$strSqlProcessosInsert .= "informacao_complementar16 = :informacao_complementar16, ";
		$strSqlProcessosInsert .= "informacao_complementar17 = :informacao_complementar17, ";
		$strSqlProcessosInsert .= "informacao_complementar18 = :informacao_complementar18, ";
		$strSqlProcessosInsert .= "informacao_complementar19 = :informacao_complementar19, ";
		$strSqlProcessosInsert .= "informacao_complementar20 = :informacao_complementar20, ";
		$strSqlProcessosInsert .= "informacao_complementar21 = :informacao_complementar21, ";
		$strSqlProcessosInsert .= "informacao_complementar22 = :informacao_complementar22, ";
		$strSqlProcessosInsert .= "informacao_complementar23 = :informacao_complementar23, ";
		$strSqlProcessosInsert .= "informacao_complementar24 = :informacao_complementar24, ";
		$strSqlProcessosInsert .= "informacao_complementar25 = :informacao_complementar25, ";
		$strSqlProcessosInsert .= "informacao_complementar26 = :informacao_complementar26, ";
		$strSqlProcessosInsert .= "informacao_complementar27 = :informacao_complementar27, ";
		$strSqlProcessosInsert .= "informacao_complementar28 = :informacao_complementar28, ";
		$strSqlProcessosInsert .= "informacao_complementar29 = :informacao_complementar29, ";
		$strSqlProcessosInsert .= "informacao_complementar30 = :informacao_complementar30, ";
		$strSqlProcessosInsert .= "informacao_complementar31 = :informacao_complementar31, ";
		$strSqlProcessosInsert .= "informacao_complementar32 = :informacao_complementar32, ";
		$strSqlProcessosInsert .= "informacao_complementar33 = :informacao_complementar33, ";
		$strSqlProcessosInsert .= "informacao_complementar34 = :informacao_complementar34, ";
		$strSqlProcessosInsert .= "informacao_complementar35 = :informacao_complementar35, ";
		$strSqlProcessosInsert .= "informacao_complementar36 = :informacao_complementar36, ";
		$strSqlProcessosInsert .= "informacao_complementar37 = :informacao_complementar37, ";
		$strSqlProcessosInsert .= "informacao_complementar38 = :informacao_complementar38, ";
		$strSqlProcessosInsert .= "informacao_complementar39 = :informacao_complementar39, ";
		$strSqlProcessosInsert .= "informacao_complementar40 = :informacao_complementar40, ";
		$strSqlProcessosInsert .= "informacao_complementar41 = :informacao_complementar41, ";
		$strSqlProcessosInsert .= "informacao_complementar42 = :informacao_complementar42, ";
		$strSqlProcessosInsert .= "informacao_complementar43 = :informacao_complementar43, ";
		$strSqlProcessosInsert .= "informacao_complementar44 = :informacao_complementar44, ";
		$strSqlProcessosInsert .= "informacao_complementar45 = :informacao_complementar45, ";
		$strSqlProcessosInsert .= "informacao_complementar46 = :informacao_complementar46, ";
		$strSqlProcessosInsert .= "informacao_complementar47 = :informacao_complementar47, ";
		$strSqlProcessosInsert .= "informacao_complementar48 = :informacao_complementar48, ";
		$strSqlProcessosInsert .= "informacao_complementar49 = :informacao_complementar49, ";
		$strSqlProcessosInsert .= "informacao_complementar50 = :informacao_complementar50, ";
		$strSqlProcessosInsert .= "informacao_complementar51 = :informacao_complementar51, ";
		$strSqlProcessosInsert .= "informacao_complementar52 = :informacao_complementar52, ";
		$strSqlProcessosInsert .= "informacao_complementar53 = :informacao_complementar53, ";
		$strSqlProcessosInsert .= "informacao_complementar54 = :informacao_complementar54, ";
		$strSqlProcessosInsert .= "informacao_complementar55 = :informacao_complementar55, ";
		$strSqlProcessosInsert .= "informacao_complementar56 = :informacao_complementar56, ";
		$strSqlProcessosInsert .= "informacao_complementar57 = :informacao_complementar57, ";
		$strSqlProcessosInsert .= "informacao_complementar58 = :informacao_complementar58, ";
		$strSqlProcessosInsert .= "informacao_complementar59 = :informacao_complementar59, ";
		$strSqlProcessosInsert .= "informacao_complementar60 = :informacao_complementar60, ";
		
		$strSqlProcessosInsert .= "ativacao = :ativacao, ";
		$strSqlProcessosInsert .= "ativacao1 = :ativacao1, ";
		$strSqlProcessosInsert .= "ativacao2 = :ativacao2, ";
		$strSqlProcessosInsert .= "ativacao3 = :ativacao3, ";
		$strSqlProcessosInsert .= "ativacao4 = :ativacao4, ";
		
		$strSqlProcessosInsert .= "n_visitas = :n_visitas, ";
		$strSqlProcessosInsert .= "acesso_restrito = :acesso_restrito ";
		//----------
		
		
		//Parâmetros.
		//----------
		//$statementProcessosInsert = $dbSistemaConPDO->prepare($strSqlProcessosInsert);
		$statementProcessosInsert = $GLOBALS['dbSistemaConPDO']->prepare($strSqlProcessosInsert);
		
		if ($statementProcessosInsert !== false)
		{
			$statementProcessosInsert->execute(array(
				"id" => $tbProcessosId,
				"id_parent" => $tbProcessosIdParent,
				"id_tb_cadastro1" => $tbProcessosIdTbCadastro1,
				"id_tb_cadastro2" => $tbProcessosIdTbCadastro2,
				"id_tb_cadastro3" => $tbProcessosIdTbCadastro3,
				"n_classificacao" => $tbProcessosNClassificacao,
				"data_criacao" => $tbProcessosDataCriacao,
				"data_abertura" => $tbProcessosDataAbertura,
				"data_distribuicao" => $tbProcessosDataDistribuicao,
				"data_admissao" => $tbProcessosDataAdmissao,
				"data_demissao" => $tbProcessosDataDemissao,
				"data1" => $tbProcessosData1,
				"data2" => $tbProcessosData2,
				"data3" => $tbProcessosData3,
				"data4" => $tbProcessosData4,
				"data5" => $tbProcessosData5,
				"data6" => $tbProcessosData6,
				"data7" => $tbProcessosData7,
				"data8" => $tbProcessosData8,
				"data9" => $tbProcessosData9,
				"data10" => $tbProcessosData10,
				"processo" => $tbProcessosProcesso,
				"descricao" => $tbProcessosDescricao,
				"id_tb_processos_status" => $tbProcessosIdTbProcessosStatus,
				"palavras_chave" => $tbProcessosPalavrasChave,
				"valor" => $tbProcessosValor,
				"valor1" => $tbProcessosValor1,
				"valor2" => $tbProcessosValor2,
				"valor3" => $tbProcessosValor3,
				"valor4" => $tbProcessosValor4,
				"valor5" => $tbProcessosValor5,
				"url1" => $tbProcessosURL1,
				"url2" => $tbProcessosURL2,
				"url3" => $tbProcessosURL3,
				"url4" => $tbProcessosURL4,
				"url5" => $tbProcessosURL5,
				"informacao_complementar1" => $tbProcessosIC1,
				"informacao_complementar2" => $tbProcessosIC2,
				"informacao_complementar3" => $tbProcessosIC3,
				"informacao_complementar4" => $tbProcessosIC4,
				"informacao_complementar5" => $tbProcessosIC5,
				"informacao_complementar6" => $tbProcessosIC6,
				"informacao_complementar7" => $tbProcessosIC7,
				"informacao_complementar8" => $tbProcessosIC8,
				"informacao_complementar9" => $tbProcessosIC9,
				"informacao_complementar10" => $tbProcessosIC10,
				"informacao_complementar11" => $tbProcessosIC11,
				"informacao_complementar12" => $tbProcessosIC12,
				"informacao_complementar13" => $tbProcessosIC13,
				"informacao_complementar14" => $tbProcessosIC14,
				"informacao_complementar15" => $tbProcessosIC15,
				"informacao_complementar16" => $tbProcessosIC16,
				"informacao_complementar17" => $tbProcessosIC17,
				"informacao_complementar18" => $tbProcessosIC18,
				"informacao_complementar19" => $tbProcessosIC19,
				"informacao_complementar20" => $tbProcessosIC20,
				"informacao_complementar21" => $tbProcessosIC21,
				"informacao_complementar22" => $tbProcessosIC22,
				"informacao_complementar23" => $tbProcessosIC23,
				"informacao_complementar24" => $tbProcessosIC24,
				"informacao_complementar25" => $tbProcessosIC25,
				"informacao_complementar26" => $tbProcessosIC26,
				"informacao_complementar27" => $tbProcessosIC27,
				"informacao_complementar28" => $tbProcessosIC28,
				"informacao_complementar29" => $tbProcessosIC29,
				"informacao_complementar30" => $tbProcessosIC30,
				"informacao_complementar31" => $tbProcessosIC31,
				"informacao_complementar32" => $tbProcessosIC32,
				"informacao_complementar33" => $tbProcessosIC33,
				"informacao_complementar34" => $tbProcessosIC34,
				"informacao_complementar35" => $tbProcessosIC35,
				"informacao_complementar36" => $tbProcessosIC36,
				"informacao_complementar37" => $tbProcessosIC37,
				"informacao_complementar38" => $tbProcessosIC38,
				"informacao_complementar39" => $tbProcessosIC39,
				"informacao_complementar40" => $tbProcessosIC40,
				"informacao_complementar41" => $tbProcessosIC41,
				"informacao_complementar42" => $tbProcessosIC42,
				"informacao_complementar43" => $tbProcessosIC43,
				"informacao_complementar44" => $tbProcessosIC44,
				"informacao_complementar45" => $tbProcessosIC45,
				"informacao_complementar46" => $tbProcessosIC46,
				"informacao_complementar47" => $tbProcessosIC47,
				"informacao_complementar48" => $tbProcessosIC48,
				"informacao_complementar49" => $tbProcessosIC49,
				"informacao_complementar50" => $tbProcessosIC50,
				"informacao_complementar51" => $tbProcessosIC51,
				"informacao_complementar52" => $tbProcessosIC52,
				"informacao_complementar53" => $tbProcessosIC53,
				"informacao_complementar54" => $tbProcessosIC54,
				"informacao_complementar55" => $tbProcessosIC55,
				"informacao_complementar56" => $tbProcessosIC56,
				"informacao_complementar57" => $tbProcessosIC57,
				"informacao_complementar58" => $tbProcessosIC58,
				"informacao_complementar59" => $tbProcessosIC59,
				"informacao_complementar60" => $tbProcessosIC60,
				"ativacao" => $tbProcessosAtivacao,
				"ativacao1" => $tbProcessosAtivacao1,
				"ativacao2" => $tbProcessosAtivacao2,
				"ativacao3" => $tbProcessosAtivacao3,
				"ativacao4" => $tbProcessosAtivacao4,
				"n_visitas" => $tbProcessosNVisitas,
				"acesso_restrito" => $tbProcessosAcessoRestrito
			));
			
			//$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus2");
			//Obs: Colocar um flag de verificação de gravação.
			$strRetorno = true;
		}else{
			//echo "erro";
			//$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus3");
		}
		//----------
		
		
		//Limpeza de objetos.
		//----------
		unset($strSqlProcessosInsert);
		unset($statementProcessosInsert);
		//----------


		return $strRetorno;
	}
    //**************************************************************************************
}