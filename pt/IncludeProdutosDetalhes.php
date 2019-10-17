<?php
//Definição de variáveis.
$IdTbProdutos = $includeProdutosDetalhes_idTbProdutos;
$ConfigTipoDiagramacao = $includeProdutosDetalhes_configTipoDiagramacao; //1 - Resumido | 2 - ADM | 3 - tabela ADM | 4 -Avaliações + Resumo


//Definição de valores.
$resultadoProdutosComplemento = DbFuncoes::TabelaGenericaFill01_FetchAll("tb_produtos_complemento", 
								NULL, 
								"complemento", 
								"");
$resultadoProdutosComplementoRelacao = DbFuncoes::FiltrosGenericosSelect02_FetchAll("tb_produtos_relacao_complemento", 
																					$IdTbProdutos, 
																					"id_tb_produtos");


//Query de pesquisa.
//----------
$strSqlProdutosDetalhesSelect = "";
$strSqlProdutosDetalhesSelect .= "SELECT ";
//$strSqlProdutosDetalhesSelect .= "* ";
$strSqlProdutosDetalhesSelect .= "id, ";
$strSqlProdutosDetalhesSelect .= "id_tb_categorias, ";
$strSqlProdutosDetalhesSelect .= "id_tb_cadastro_usuario, ";
$strSqlProdutosDetalhesSelect .= "data_produto, ";
$strSqlProdutosDetalhesSelect .= "cod_produto, ";
$strSqlProdutosDetalhesSelect .= "n_classificacao, ";
$strSqlProdutosDetalhesSelect .= "produto, ";
$strSqlProdutosDetalhesSelect .= "descricao01, ";
$strSqlProdutosDetalhesSelect .= "descricao02, ";
$strSqlProdutosDetalhesSelect .= "descricao03, ";
$strSqlProdutosDetalhesSelect .= "descricao04, ";
$strSqlProdutosDetalhesSelect .= "descricao05, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar1, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar2, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar3, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar4, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar5, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar6, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar7, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar8, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar9, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar10, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar11, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar12, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar13, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar14, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar15, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar16, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar17, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar18, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar19, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar20, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar21, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar22, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar23, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar24, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar25, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar26, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar27, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar28, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar29, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar30, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar31, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar32, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar33, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar34, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar35, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar36, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar37, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar38, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar39, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar40, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar41, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar42, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar43, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar44, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar45, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar46, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar47, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar48, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar49, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar50, ";
$strSqlProdutosDetalhesSelect .= "palavras_chave, ";
$strSqlProdutosDetalhesSelect .= "valor, ";
$strSqlProdutosDetalhesSelect .= "valor1, ";
$strSqlProdutosDetalhesSelect .= "valor2, ";
$strSqlProdutosDetalhesSelect .= "peso, ";
$strSqlProdutosDetalhesSelect .= "coeficiente, ";
$strSqlProdutosDetalhesSelect .= "estoque, ";
$strSqlProdutosDetalhesSelect .= "ativacao, ";
$strSqlProdutosDetalhesSelect .= "ativacao_promocao, ";
$strSqlProdutosDetalhesSelect .= "ativacao_home, ";
$strSqlProdutosDetalhesSelect .= "ativacao_home_categoria, ";
$strSqlProdutosDetalhesSelect .= "acesso_restrito, ";
$strSqlProdutosDetalhesSelect .= "n_questoes_aprovacao, ";
$strSqlProdutosDetalhesSelect .= "id_tb_produtos_status, ";
$strSqlProdutosDetalhesSelect .= "imagem, ";
$strSqlProdutosDetalhesSelect .= "anotacoes_internas, ";
$strSqlProdutosDetalhesSelect .= "n_visitas ";
$strSqlProdutosDetalhesSelect .= "FROM tb_produtos ";
$strSqlProdutosDetalhesSelect .= "WHERE id <> 0 ";
//$strSqlProdutosDetalhesSelect .= "AND id_tb_categorias = :id_tb_categorias ";
$strSqlProdutosDetalhesSelect .= "AND id = :id ";
//$strSqlProdutosDetalhesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";


//Parâmetros.
//----------
$statementProdutosDetalhesSelect = $dbSistemaConPDO->prepare($strSqlProdutosDetalhesSelect);

if ($statementProdutosDetalhesSelect !== false)
{
	$statementProdutosDetalhesSelect->execute(array(
		"id" => $IdTbProdutos
	));
}
//----------


//Definição das variáveis de detalhes.
//----------
//$resultadoProdutosDetalhes = $dbSistemaConPDO->query($strSqlProdutosDetalhesSelect);
$resultadoProdutosDetalhes = $statementProdutosDetalhesSelect->fetchAll();

if(empty($resultadoProdutosDetalhes))
{
	//echo "Nenhum registro encontrado";
}else{
	foreach($resultadoProdutosDetalhes as $linhaProdutosDetalhes)
	{
		//Definição das variáveis de detalhes.
		$tbProdutosId = $linhaProdutosDetalhes['id'];
		$tbProdutosIdTbCategorias = $linhaProdutosDetalhes['id_tb_categorias'];
		
		$tbProdutosIdTbCadastroUsuario = $linhaProdutosDetalhes['id_tb_cadastro_usuario'];
		
		//$tbProdutosDataProduto = Funcoes::DataLeitura01($linhaProdutosDetalhes['data_produto'], $GLOBALS['configSistemaFormatoData'], "1");
		if($linhaProdutosDetalhes['data_produto'] == NULL)
		{
			$tbProdutosDataProduto = "";
		}else{
			$tbProdutosDataProduto = Funcoes::DataLeitura01($linhaProdutosDetalhes['data_produto'], $GLOBALS['configSiteFormatoData'], "1");
		}
		$tbProdutosCodProduto = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['cod_produto']);
		$tbProdutosNClassificacao = $linhaProdutosDetalhes['n_classificacao'];

		$tbProdutosProduto = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['produto']);
		$tbProdutosDescricao01 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['descricao01']);
		$tbProdutosDescricao02 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['descricao02']);
		$tbProdutosDescricao03 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['descricao03']);
		$tbProdutosDescricao04 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['descricao04']);
		$tbProdutosDescricao05 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['descricao05']);

		$tbProdutosIC1 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar1']);
		$tbProdutosIC2 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar2']);
		$tbProdutosIC3 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar3']);
		$tbProdutosIC4 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar4']);
		$tbProdutosIC5 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar5']);
		$tbProdutosIC6 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar6']);
		$tbProdutosIC7 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar7']);
		$tbProdutosIC8 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar8']);
		$tbProdutosIC9 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar9']);
		$tbProdutosIC10 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar10']);
		$tbProdutosIC11 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar11']);
		$tbProdutosIC12 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar12']);
		$tbProdutosIC13 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar13']);
		$tbProdutosIC14 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar14']);
		$tbProdutosIC15 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar15']);
		$tbProdutosIC16 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar16']);
		$tbProdutosIC17 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar17']);
		$tbProdutosIC18 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar18']);
		$tbProdutosIC19 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar19']);
		$tbProdutosIC20 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar20']);
		$tbProdutosIC21 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar21']);
		$tbProdutosIC22 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar22']);
		$tbProdutosIC23 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar23']);
		$tbProdutosIC24 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar24']);
		$tbProdutosIC25 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar25']);
		$tbProdutosIC26 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar26']);
		$tbProdutosIC27 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar27']);
		$tbProdutosIC28 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar28']);
		$tbProdutosIC29 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar29']);
		$tbProdutosIC30 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar30']);
		$tbProdutosIC31 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar31']);
		$tbProdutosIC32 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar32']);
		$tbProdutosIC33 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar33']);
		$tbProdutosIC34 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar34']);
		$tbProdutosIC35 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar35']);
		$tbProdutosIC36 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar36']);
		$tbProdutosIC37 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar37']);
		$tbProdutosIC38 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar38']);
		$tbProdutosIC39 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar39']);
		$tbProdutosIC40 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar40']);
		$tbProdutosIC41 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar41']);
		$tbProdutosIC42 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar42']);
		$tbProdutosIC43 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar43']);
		$tbProdutosIC44 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar44']);
		$tbProdutosIC45 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar45']);
		$tbProdutosIC46 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar46']);
		$tbProdutosIC47 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar47']);
		$tbProdutosIC48 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar48']);
		$tbProdutosIC49 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar49']);
		$tbProdutosIC50 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar50']);

		$tbProdutosPalavrasChave = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['palavras_chave']);
		$tbProdutosValor = Funcoes::MascaraValorLer($linhaProdutosDetalhes['valor'], $GLOBALS['configSistemaMoeda']);
		$tbProdutosValor1 = Funcoes::MascaraValorLer($linhaProdutosDetalhes['valor1'], $GLOBALS['configSistemaMoeda']);
		$tbProdutosValor2 = Funcoes::MascaraValorLer($linhaProdutosDetalhes['valor2'], $GLOBALS['configSistemaMoeda']);
		//$tbProdutosPeso = Funcoes::MascaraValorLer($linhaProdutosDetalhes['peso'], $GLOBALS['configSistemaMoeda']);
		$tbProdutosPeso = $linhaProdutosDetalhes['peso'];
		
		//$tbProdutosCoeficiente = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['coeficiente']);
		//$tbProdutosCoeficiente = Funcoes::MascaraValorLer($linhaProdutosDetalhes['coeficiente'], $GLOBALS['configSistemaMoeda']);
		$tbProdutosCoeficiente = $linhaProdutosDetalhes['coeficiente'];
		$tbProdutosEstoque = $linhaProdutosDetalhes['estoque'];
		$tbProdutosAtivacao = $linhaProdutosDetalhes['ativacao'];
		$tbProdutosAtivacaoPromocao = $linhaProdutosDetalhes['ativacao_promocao'];
		$tbProdutosAtivacaoHome = $linhaProdutosDetalhes['ativacao_home'];
		$tbProdutosAtivacaoHomeCategoria = $linhaProdutosDetalhes['ativacao_home_categoria'];
		$tbProdutosAcessoRestrito = $linhaProdutosDetalhes['acesso_restrito'];
		
		$tbProdutosNQuestoesAprovacao = $linhaProdutosDetalhes['n_questoes_aprovacao'];
		$tbProdutosIdTbProdutosStatus = $linhaProdutosDetalhes['id_tb_produtos_status'];
		if($tbProdutosIdTbProdutosStatus <> 0)
		{
			$tbProdutosIdTbProdutosStatusPrint = DbFuncoes::GetCampoGenerico01($tbProdutosIdTbProdutosStatus, "tb_produtos_complemento", "complemento");
		}
		$tbProdutosImagem = $linhaProdutosDetalhes['imagem'];
		$tbProdutosAnotacoesInternas = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['anotacoes_internas']);
		$tbProdutosNVisitas = $linhaProdutosDetalhes['n_visitas'];
		//Verificação de erro.
		//echo "tbProdutosId=" . $tbProdutosId . "<br>";
		//echo "tbProdutosProcesso=" . $tbProdutosProcesso . "<br>";
		
	}
}
//----------
?>


<?php if(!empty($resultadoProdutosDetalhes)){?>
	<?php //Diagramação 3 (Cadastro Detalhes).?>
    <?php //**************************************************************************************?>
    <?php if($ConfigTipoDiagramacao == "3"){ ?>
    <div align="center" class="AdmTexto01" style="position: relative; display: block; overflow: hidden;">
        <table class="AdmTabelaCampos02">
            <tr>
                <td class="AdmTbFundoEscuro" colspan="4">
                    <div align="center" class="AdmTexto02">
                        <strong>
                            Identifica&ccedil;&atilde;o
                        </strong>
                    </div>
                </td>
            </tr>
            
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosData"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbProdutosDataProduto;?>
                    </div>
                </td>
            </tr>
            
			<?php //if($tbProdutosCodProduto == ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosCodigo"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbProdutosCodProduto;?>
                    </div>
                </td>
            </tr>
			<?php //} ?>
            
            <?php if($GLOBALS['habilitarProdutosCadastroUsuario'] == 1){ ?>
				<?php if($idTbCadastroUsuario == ""){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosCadastroUsuario"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
							<?php echo $tbProdutosIdTbCadastroUsuario_print;?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
            
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProduto"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula"<?php if($GLOBALS['habilitarProdutosNClassificacao'] <> "1"){ ?> colspan="3"<?php } ?>>
                    <div align="left">
                        <?php echo $tbProdutosProduto;?>
                    </div>
                </td>
				<?php if($GLOBALS['habilitarProdutosNClassificacao'] == 1){ ?>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNClassificacao"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaColuna01 TabelaCampos01Celula">
                    <div>
                        <?php echo $tbProdutosNClassificacao;?>
                    </div>
                </td>
                <?php } ?>
            </tr>
            
            <?php if($GLOBALS['habilitarProdutosTipo'] == "1"){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosTipo"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                        {
                        ?>
                            <div>
                                <?php if($linhaProdutosComplemento["tipo_complemento"] == "2"){ ?> 
                                    <?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosIc1'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc1'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC1;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosIc2'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc2'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC2;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc3'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc3'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC3;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc4'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc4'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC4;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc5'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc5'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC5;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosIc6'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc6'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC6;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosIc7'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc7'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC7;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc8'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc8'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC8;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc9'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc9'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC9;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc10'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc10'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC10;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosIc11'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc11'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC11;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosIc12'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc12'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC12;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc13'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc13'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC13;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc14'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc14'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC14;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc15'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc15'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC15;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosIc16'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc16'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC16;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosIc17'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc17'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC17;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc18'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc18'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC18;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc19'] == 1){ ?>
            <tr>

                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc19'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC19;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc20'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc20'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC20;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosIc21'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc21'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC21;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosIc22'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc22'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC22;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc23'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc23'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC23;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc24'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc24'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC24;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc25'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc25'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC25;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosIc26'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc26'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC26;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosIc27'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc27'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC27;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc28'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc28'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC28;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc29'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc29'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC29;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc30'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc30'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC30;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosIc31'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc31'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC31;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosIc32'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc32'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC32;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc33'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc33'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC33;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc34'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc34'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC34;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc35'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc35'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC35;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosIc36'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc36'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC36;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosIc37'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc37'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC37;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc38'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc38'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC38;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc39'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc39'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC39;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc40'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc40'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC40;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosIc41'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc41'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC41;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosIc42'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc42'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC42;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc43'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc43'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC43;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc44'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc44'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC44;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc45'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc45'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC45;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosIc46'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc46'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC46;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosIc47'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc47'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC47;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc48'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc48'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC48;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc49'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc49'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC49;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc50'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc50'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC50;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico01'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico01Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                        {
                        ?>
                            <div>
                                <?php if($linhaProdutosComplemento["tipo_complemento"] == "12"){ ?> 
                                    <?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico02'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico02Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                        {
                        ?>
                            <div>
                                <?php if($linhaProdutosComplemento["tipo_complemento"] == "13"){ ?> 
                                    <?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico03'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico03Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                        {
                        ?>
                            <div>
                                <?php if($linhaProdutosComplemento["tipo_complemento"] == "14"){ ?> 
                                    <?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarProdutosFiltroGenerico04'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico04Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                        {
                        ?>
                            <div>
                                <?php if($linhaProdutosComplemento["tipo_complemento"] == "15"){ ?> 
                                    <?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico05'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico05Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                        {
                        ?>
                            <div>
                                <?php if($linhaProdutosComplemento["tipo_complemento"] == "16"){ ?> 
                                    <?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico06'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico06Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                        {
                        ?>
                            <div>
                                <?php if($linhaProdutosComplemento["tipo_complemento"] == "17"){ ?> 
                                    <?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico07'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico07Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                        {
                        ?>
                            <div>
                                <?php if($linhaProdutosComplemento["tipo_complemento"] == "18"){ ?> 
                                    <?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico08'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico08Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                        {
                        ?>
                            <div>
                                <?php if($linhaProdutosComplemento["tipo_complemento"] == "19"){ ?> 
                                    <?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico09'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico09Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                        {
                        ?>
                            <div>
                                <?php if($linhaProdutosComplemento["tipo_complemento"] == "20"){ ?> 
                                    <?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico10'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico10Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                        {
                        ?>
                            <div>
                                <?php if($linhaProdutosComplemento["tipo_complemento"] == "21"){ ?> 
                                    <?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico11'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico11Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                        {
                        ?>
                            <div>
                                <?php if($linhaProdutosComplemento["tipo_complemento"] == "22"){ ?> 
                                    <?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico12'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico12Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                        {
                        ?>
                            <div>
                                <?php if($linhaProdutosComplemento["tipo_complemento"] == "23"){ ?> 
                                    <?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico13'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico13Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                        {
                        ?>
                            <div>
                                <?php if($linhaProdutosComplemento["tipo_complemento"] == "24"){ ?> 
                                    <?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarProdutosFiltroGenerico14'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico14Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                        {
                        ?>
                            <div>
                                <?php if($linhaProdutosComplemento["tipo_complemento"] == "25"){ ?> 
                                    <?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico15'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico15Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                        {
                        ?>
                            <div>
                                <?php if($linhaProdutosComplemento["tipo_complemento"] == "26"){ ?> 
                                    <?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico16'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico16Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                        {
                        ?>
                            <div>
                                <?php if($linhaProdutosComplemento["tipo_complemento"] == "27"){ ?> 
                                    <?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico17'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico17Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                        {
                        ?>
                            <div>
                                <?php if($linhaProdutosComplemento["tipo_complemento"] == "28"){ ?> 
                                    <?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico18'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico18Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                        {
                        ?>
                            <div>
                                <?php if($linhaProdutosComplemento["tipo_complemento"] == "29"){ ?> 
                                    <?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico19'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico19Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                        {
                        ?>
                            <div>
                                <?php if($linhaProdutosComplemento["tipo_complemento"] == "30"){ ?> 
                                    <?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico20'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico20Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                        {
                        ?>
                            <div>
                                <?php if($linhaProdutosComplemento["tipo_complemento"] == "31"){ ?> 
                                    <?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico21'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico21Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                        {
                        ?>
                            <div>
                                <?php if($linhaProdutosComplemento["tipo_complemento"] == "32"){ ?> 
                                    <?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico22'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico22Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                        {
                        ?>
                            <div>
                                <?php if($linhaProdutosComplemento["tipo_complemento"] == "33"){ ?> 
                                    <?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico23'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico23Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                        {
                        ?>
                            <div>
                                <?php if($linhaProdutosComplemento["tipo_complemento"] == "34"){ ?> 
                                    <?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarProdutosFiltroGenerico24'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico24Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                        {
                        ?>
                            <div>
                                <?php if($linhaProdutosComplemento["tipo_complemento"] == "35"){ ?> 
                                    <?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico25'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico25Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                        {
                        ?>
                            <div>
                                <?php if($linhaProdutosComplemento["tipo_complemento"] == "36"){ ?> 
                                    <?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico26'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico26Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                        {
                        ?>
                            <div>
                                <?php if($linhaProdutosComplemento["tipo_complemento"] == "37"){ ?> 
                                    <?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico27'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico27Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                        {
                        ?>
                            <div>
                                <?php if($linhaProdutosComplemento["tipo_complemento"] == "38"){ ?> 
                                    <?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico28'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico28Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                        {
                        ?>
                            <div>
                                <?php if($linhaProdutosComplemento["tipo_complemento"] == "39"){ ?> 
                                    <?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico29'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico29Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                        {
                        ?>
                            <div>
                                <?php if($linhaProdutosComplemento["tipo_complemento"] == "40"){ ?> 
                                    <?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico30'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico30Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                        {
                        ?>
                            <div>
                                <?php if($linhaProdutosComplemento["tipo_complemento"] == "41"){ ?> 
                                    <?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
                        
            <?php if($GLOBALS['habilitarProdutosDescricao01'] == "1"){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosDescricao01Titulo'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div>
                        <?php echo $tbProdutosDescricao01;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosDescricao02'] == "1"){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosDescricao02Titulo'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div>
                        <?php echo $tbProdutosDescricao02;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosDescricao03'] == "1"){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosDescricao03Titulo'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div>
                        <?php echo $tbProdutosDescricao03;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosDescricao04'] == "1"){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosDescricao04Titulo'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div>
                        <?php echo $tbProdutosDescricao04;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosDescricao05'] == "1"){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosDescricao05Titulo'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div>
                        <?php echo $tbProdutosDescricao05;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosPalavrasChave'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPalavrasChave01"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbProdutosPalavrasChave;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosValor'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosValor"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig");?> 
                        <?php echo $tbProdutosValor;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosValor1'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosValor1Nome'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosValor1Moeda'], "IncludeConfig"); ?> 
                        <?php echo $tbProdutosValor1;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosValor2'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosValor2Nome'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosValor1Moeda'], "IncludeConfig"); ?> 
                        <?php echo $tbProdutosValor2;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosPeso'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosPeso"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php echo $tbProdutosPeso;?>
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaPeso'], "IncludeConfig");?> 
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosStatus'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosStatus"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php //echo $tbProdutosIdTbProdutosStatus;?>
                        <?php echo $tbProdutosIdTbProdutosStatusPrint;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
			<?php if($GLOBALS['ativacaoProdutosImagens'] == 1){ ?>
            <tr style="display: none;">
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemImagem"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php //SlimBox 2 - JQuery.?>
                        <?php if($GLOBALS['configImagemPopUp'] == "1"){ ?>
                            <a href="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>g<?php echo $tbProdutosImagem;?>" rel="lightbox" title="<?php echo $tbProdutosProduto; ?>"><img src="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>t<?php echo $tbProdutosImagem;?>" alt="<?php echo $tbProdutosProduto; ?>" style="margin-left: 4px;" /></a>
                        <?php } ?>
                        
                        <?php //Pop-up div com comentários.?>
                        <?php if($GLOBALS['configImagemPopUp'] == "2"){ ?>
            
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
    <?php } ?>
    <?php //**************************************************************************************?>
<?php } ?>


<?php
//Limpeza de objetos.
//----------
unset($strSqlProdutosDetalhesSelect);
unset($statementProdutosDetalhesSelect);
unset($resultadoProdutosDetalhes);
unset($linhaProdutosDetalhes);
//----------
?>