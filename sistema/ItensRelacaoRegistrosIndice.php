<?php
//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeLayout.php";


//Verificação de login Master.
LoginAutenticacao::UsuarioLoginVerificacao();


//Resgate de variáveis.
$idItem = $_GET["idItem"];
$tipoCategoria = $_GET["tipoCategoria"];

$strTabela = "";
if($tipoCategoria == "2")
{
	$strTabela = "tb_produtos";
}
if($tipoCategoria == "9")
{
	$strTabela = "tb_categorias";
}
if($tipoCategoria == "13")
{
	$strTabela = "tb_cadastro";
}
if($tipoCategoria == "26")
{
	$strTabela = "tb_paginas";
}

$idParentCategoriasRaiz = $_GET["idParentCategoriasRaiz"];
//if($idParentCategoriasRaiz == "")
//{
	//$idParentCategoriasRaiz = 0;
//}

$palavraChave = $_GET["palavraChave"];

$paginaRetorno = "ItensRelacaoRegistrosIndice.php";
//$paginaRetornoExclusao = "AulasEditar.php";
$variavelRetorno = "idItem";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];


//Montagem de query padrão de retorno.
//"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
$queryPadrao = "&idParentAulas=" . $idParentAulas . 
"&paginaRetorno=" . $paginaRetorno . 
"&masterPageSelect=" . $masterPageSelect . 
"&variavelRetorno=" . $variavelRetorno . 
"&palavraChave=" . $palavraChave;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Verificação de erro - debug.
//echo "idParentCategoriasRaiz=" . $idParentCategoriasRaiz . "<br />";
//echo "habilitarAulasSistemaPaginacao=" . $habilitarAulasSistemaPaginacao . "<br />";
//echo "strSqlAulasSelect=" . $strSqlAulasSelect . "<br />";
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistema"); ?> - <?php echo htmlentities($GLOBALS['configNomeCliente']); ?>
<?php 
$page->cphTitle = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Head.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphHead*/ ?>
	
<?php 
$page->cphHead = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Cabeçalho.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphConteudoCabecalho*/ ?>
    <div align="left" class="TextoTitulo01">
    	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItensVinculoTitulo"); ?>
    </div>
<?php 
$page->cphConteudoCabecalho = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Conteúdo principal.?>
<?php //**************************************************************************************?>
<?php ob_start(); /*cphConteudoPrincipal*/ ?>
    <div align="center" class="TextoErro">
        <?php echo $mensagemErro;?>
    </div>
    <div align="center" class="TextoSucesso">
        <?php echo $mensagemSucesso;?>
    </div>
    
    
    <?php 
	//Query de pesquisa.
	//----------
	$strSqlCategoriasSelect = "";
	$strSqlCategoriasSelect .= "SELECT ";
	$strSqlCategoriasSelect .= "id, ";
	$strSqlCategoriasSelect .= "id_parent, ";
	$strSqlCategoriasSelect .= "id_tb_cadastro_usuario, ";
	$strSqlCategoriasSelect .= "n_classificacao, ";
	$strSqlCategoriasSelect .= "data_categoria, ";
	$strSqlCategoriasSelect .= "categoria, ";
	$strSqlCategoriasSelect .= "descricao, ";
	$strSqlCategoriasSelect .= "informacao_complementar1, ";
	$strSqlCategoriasSelect .= "informacao_complementar2, ";
	$strSqlCategoriasSelect .= "informacao_complementar3, ";
	$strSqlCategoriasSelect .= "informacao_complementar4, ";
	$strSqlCategoriasSelect .= "informacao_complementar5, ";
	$strSqlCategoriasSelect .= "tipo_categoria, ";
	$strSqlCategoriasSelect .= "imagem, ";
	$strSqlCategoriasSelect .= "ativacao, ";
	$strSqlCategoriasSelect .= "acesso_restrito ";	
	$strSqlCategoriasSelect .= "FROM tb_categorias ";
	$strSqlCategoriasSelect .= "WHERE id <> 0 ";
	
	if($idParentCategoriasRaiz <> "")
	{
		$strSqlCategoriasSelect .= "AND id_parent = :id_parent ";
	}
	if($idParentCategorias <> "")
	{
		$strSqlCategoriasSelect .= "AND id_parent = :id_parent ";
	}
	if($tipoCategoria <> "")
	{
		$strSqlCategoriasSelect .= "AND tipo_categoria = :tipo_categoria ";
	}
	
	$strSqlCategoriasSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCategorias'] . " ";
	//echo "strSqlCategoriasSelect=" . $strSqlCategoriasSelect . "<br />";
	//----------


	//Criação de componentes.
	//----------
	$statementCategoriasSelect = $dbSistemaConPDO->prepare($strSqlCategoriasSelect);
	
	if ($statementCategoriasSelect !== false)
	{
		if($idParentCategoriasRaiz <> "")
		{
			$statementCategoriasSelect->bindParam(':id_parent', $idParentCategoriasRaiz, PDO::PARAM_STR);
		}
		if($idParentCategorias <> "")
		{
			$statementCategoriasSelect->bindParam(':id_parent', $idParentCategorias, PDO::PARAM_STR);
		}
		if($tipoCategoria <> "")
		{
			$statementCategoriasSelect->bindParam(':tipo_categoria', $tipoCategoria, PDO::PARAM_STR);
		}
		$statementCategoriasSelect->execute();
		
		/*
		$statementCategoriasSelect->execute(array(
			"id_parent" => $idParentCategorias
		));
		*/
	}


	//$resultadoCategorias = $dbSistemaConPDO->query($strSqlCategoriasSelect);
	$resultadoCategorias = $statementCategoriasSelect->fetchAll();
	//----------
	?>
    
    
    <?php
    //if(mysqli_num_rows($resultadoCategorias) == 0){ //Verificação se está vazio.
	//if ($resultadoCategorias->fetchColumn() == 0) //Verificação se está vazio.
	if (empty($resultadoCategorias))
	{
        //echo "Nenhum registro encontrado";
    ?>
        <div align="center" class="TextoErro">
            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
        </div>
    <?php
    }else{
    ?>
        <div style="position: relative; display: block; overflow: hidden;">
            <form name="formItensRelacaoRegistrosIndice" id="formItensRelacaoRegistrosIndice" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
                <input type="hidden" id="idItem" name="idItem" value="<?php echo $idItem; ?>" />
                <input type="hidden" id="idParentCategoriasRaiz" name="idParentCategoriasRaiz" value="<?php echo $idParentCategoriasRaiz; ?>" />
                <input type="hidden" id="tipoCategoria" name="tipoCategoria" value="<?php echo $tipoCategoria; ?>" />
                <input type="hidden" id="strTabela" name="strTabela" value="<?php echo $strTabela; ?>" />
    
                <input type="hidden" id="paginaRetorno" name="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                <input type="hidden" id="variavelRetorno" name="variavelRetorno" value="<?php echo $variavelRetorno; ?>" />
                <input type="hidden" id="idRegistroRetorno" name="idRegistroRetorno" value="<?php echo $idItem; ?>" />
                
                <input type="hidden" id="masterPageSelect" name="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
                <input type="hidden" id="paginacaoNumero" name="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
                <input type="hidden" id="caracterAtual" name="caracterAtual" value="<?php echo $caracterAtual; ?>" />
                
                <table width="100%" class="TabelaDados01">
                  <tr class="TbFundoEscuro">
                  
                    <?php if($GLOBALS['habilitarCategoriasNClassificacao'] == 1){ ?>
                    <td width="50" class="TbFundoEscuro TabelaDados01Celula">
                        <div align="center" class="Texto02">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNClassificacaoA"); ?>
                        </div>
                    </td>
                    <?php } ?>
                    
                    <td class="TabelaDados01Celula">
                        <div class="Texto02">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCategoriasCategoria"); ?>
                        </div>
                    </td>
                    <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                        <div align="center" class="Texto02">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemSelecionarA"); ?>
                        </div>
                    </td>
                  </tr>
                  <?php
                    //Loop pelos resultados.
                    //while($linhaCategorias = mysqli_fetch_array($resultadoCategorias))
                    //foreach ($dbSistemaConPDO->query($strSqlCategoriasSelect) as $linhaCategorias)
                    //while ($linhaCategorias = $statementCategoriasSelect->fetchAll())
                    foreach($resultadoCategorias as $linhaCategorias)
                    {
                        //echo "id=" . $linhaCategorias['id'] . "<br />";
                  ?>
                  <tr class="TbFundoMedio">
                  
                    <?php if($GLOBALS['habilitarCategoriasNClassificacao'] == 1){ ?>
                    <td class="TabelaDados01Celula">
                        <div align="center" class="Texto01">
                            <?php echo $linhaCategorias['n_classificacao'];?>
                        </div>
                    </td>
                    <?php } ?>
                    
                    <td colspan="2" class="TabelaDados01Celula">
                        <div class="Texto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaCategorias['categoria']);?>
                        </div>
                    </td>
                    <!--td class="TabelaDados01Celula"-->
                        <!--div align="center" class="Texto01"-->
                            <!--input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaCategorias['id'];?>" class="CampoCheckBox01" /-->
                        <!--/div-->
                    <!--/td-->
                  </tr>
					<?php //Produtos.?>
                    <?php //**************************************************************************************?>
                    <?php if($tipoCategoria == "2"){ ?>
                      <tr class="TbFundoMedio">
                        <td colspan="2" class="TabelaDados01Celula">
                            <?php
                            $idParentProdutos = $linhaCategorias['id'];
                            
                            
                            //Query de pesquisa.
                            //----------
                            $strSqlProdutosSelect = "";
                            $strSqlProdutosSelect .= "SELECT ";
                            //$strSqlProdutosSelect .= "* ";
                            $strSqlProdutosSelect .= "id, ";
                            $strSqlProdutosSelect .= "id_tb_categorias, ";
                            $strSqlProdutosSelect .= "id_tb_cadastro_usuario, ";
                            $strSqlProdutosSelect .= "data_produto, ";
                            $strSqlProdutosSelect .= "cod_produto, ";
                            $strSqlProdutosSelect .= "n_classificacao, ";
                            $strSqlProdutosSelect .= "produto, ";
                            $strSqlProdutosSelect .= "descricao01, ";
                            $strSqlProdutosSelect .= "descricao02, ";
                            $strSqlProdutosSelect .= "descricao03, ";
                            $strSqlProdutosSelect .= "descricao04, ";
                            $strSqlProdutosSelect .= "descricao05, ";
                            $strSqlProdutosSelect .= "informacao_complementar1, ";
                            $strSqlProdutosSelect .= "informacao_complementar2, ";
                            $strSqlProdutosSelect .= "informacao_complementar3, ";
                            $strSqlProdutosSelect .= "informacao_complementar4, ";
                            $strSqlProdutosSelect .= "informacao_complementar5, ";
                            $strSqlProdutosSelect .= "informacao_complementar6, ";
                            $strSqlProdutosSelect .= "informacao_complementar7, ";
                            $strSqlProdutosSelect .= "informacao_complementar8, ";
                            $strSqlProdutosSelect .= "informacao_complementar9, ";
                            $strSqlProdutosSelect .= "informacao_complementar10, ";
                            $strSqlProdutosSelect .= "informacao_complementar11, ";
                            $strSqlProdutosSelect .= "informacao_complementar12, ";
                            $strSqlProdutosSelect .= "informacao_complementar13, ";
                            $strSqlProdutosSelect .= "informacao_complementar14, ";
                            $strSqlProdutosSelect .= "informacao_complementar15, ";
                            $strSqlProdutosSelect .= "palavras_chave, ";
                            $strSqlProdutosSelect .= "valor, ";
                            $strSqlProdutosSelect .= "valor1, ";
                            $strSqlProdutosSelect .= "valor2, ";
                            $strSqlProdutosSelect .= "peso, ";
                            $strSqlProdutosSelect .= "coeficiente, ";
                            $strSqlProdutosSelect .= "estoque, ";
                            $strSqlProdutosSelect .= "ativacao, ";
                            $strSqlProdutosSelect .= "ativacao_promocao, ";
                            $strSqlProdutosSelect .= "ativacao_home, ";
                            $strSqlProdutosSelect .= "ativacao_home_categoria, ";
                            $strSqlProdutosSelect .= "acesso_restrito, ";
                            $strSqlProdutosSelect .= "n_questoes_aprovacao, ";
                            $strSqlProdutosSelect .= "id_tb_produtos_status, ";
                            $strSqlProdutosSelect .= "imagem, ";
                            $strSqlProdutosSelect .= "anotacoes_internas, ";
                            $strSqlProdutosSelect .= "n_visitas ";
                            $strSqlProdutosSelect .= "FROM tb_produtos ";
                            $strSqlProdutosSelect .= "WHERE id <> 0 ";
                            if($idParentProdutos <> "")
                            {
                                $strSqlProdutosSelect .= "AND id_tb_categorias = :id_tb_categorias ";
                            }
                            $strSqlProdutosSelect .= "ORDER BY " . $GLOBALS['configClassificacaoProdutos'] . " ";
                            //----------
                            
                            
                            //Parâmetros.
                            //----------
                            $statementProdutosSelect = $dbSistemaConPDO->prepare($strSqlProdutosSelect);
                            
                            if ($statementProdutosSelect !== false)
                            {
                                if($idParentProdutos <> "")
                                {
                                    $statementProdutosSelect->bindParam(':id_tb_categorias', $idParentProdutos, PDO::PARAM_STR);
                                }
                                $statementProdutosSelect->execute();
                                /*
                                $statementProdutosSelect->execute(array(
                                    "id_tb_categorias" => $idParentProdutos
                                ));
                                */
                            }
                            //----------
                            
                            //$resultadoProdutos = $dbSistemaConPDO->query($strSqlProdutosSelect);
                            $resultadoProdutos = $statementProdutosSelect->fetchAll();
                            ?>
                            
                            
                            <?php
                            if (empty($resultadoProdutos))
                            {
                                //echo "Nenhum registro encontrado";
                            ?>
                                <div align="center" class="TextoErro">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
                                </div>
                            <?php
                            }else{
                            ?>
                        
                                <table width="100%" class="TabelaDados01">
                                  <tr class="TbFundoEscuro">
                                    <?php if($GLOBALS['habilitarProdutosNClassificacao'] == 1){ ?>
                                    <td width="50" class="TabelaDados01Celula" style="display: none;">
                                        <div align="center" class="Texto02">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNClassificacaoA"); ?>
                                        </div>
                                    </td>
                                    <?php } ?>
                                    
                                    <?php if($GLOBALS['ativacaoProdutosVisualizacaoImagem'] == 1){ ?>
                                    <td width="1" class="TabelaDados01Celula" style="display: none;">
                                        <div align="center" class="Texto02">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemImagem"); ?>
                                        </div>
                                    </td>
                                    <?php } ?>
                                    
                                    <?php if($GLOBALS['ativacaoProdutosVisualizacaoData'] == 1){ ?>
                                    <td width="100" class="TabelaDados01Celula" style="display: none;">
                                        <div align="center" class="Texto02">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaProdutosData"); ?>
                                        </div>
                                    </td>
                                    <?php } ?>
                                    
                                    <td class="TabelaDados01Celula">
                                        <div class="Texto02">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaProduto"); ?>
                                        </div>
                                    </td>
                                    
                                    
                                    <?php if($GLOBALS['habilitarItensRelacaoRegistrosValor'] == 1){ ?>
                                    <td width="230" class="TabelaDados01Celula">
                                        <div align="center" class="Texto02">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItensRelacaoRegistroValor"); ?>
                                        </div>
                                    </td>
                                    <?php } ?>

                                    <td width="100" class="TabelaDados01Celula" style="display: none;">
                                        <div align="center" class="Texto02">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFuncoes"); ?>
                                        </div>
                                    </td>
                                    
                                    <td width="30" class="TabelaDados01Celula">
                                        <div align="center" class="Texto02">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao"); ?>
                                        </div>
                                    </td>
                                    
                                    <?php if($GLOBALS['habilitarProdutosAtivacaoPromocoes'] == 1){ ?>
                                    <td width="30" class="TabelaDados01Celula" style="display: none;">
                                        <div align="center" class="Texto02">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaProdutosAtivacaoPromocoes"); ?>
                                        </div>
                                    </td>
                                    <?php } ?>
                                    
                                    <?php if($GLOBALS['habilitarProdutosAtivacaoHome'] == 1){ ?>
                                    <td width="30" class="TabelaDados01Celula" style="display: none;">
                                        <div align="center" class="Texto02">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaProdutosAtivacaoHome"); ?>
                                        </div>
                                    </td>
                                    <?php } ?>
                                    
                                    <?php if($GLOBALS['habilitarProdutosAtivacaoCategoria'] == 1){ ?>
                                    <td width="30" class="TabelaDados01Celula" style="display: none;">
                                        <div align="center" class="Texto02">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaProdutosAtivacaoHomeCategoria"); ?>
                                        </div>
                                    </td>
                                    <?php } ?>
                                    
                                    <?php if($GLOBALS['habilitarProdutosAtivacaoAcesso'] == 1){ ?>
                                    <td width="50" class="TabelaDados01Celula" style="display: none;">
                                        <div align="center" class="Texto02">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAcesso"); ?>
                                        </div>
                                    </td>
                                    <?php } ?>
                                    
                                    <td width="30" class="TabelaDados01Celula" style="display: none;">
                                        <div align="center" class="Texto02">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                                        </div>
                                    </td>
                                    
                                    <td width="30" class="TabelaDados01Celula" style="display: none;">
                                        <div align="center" class="Texto02">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemExcluir"); ?>
                                        </div>
                                    </td>
                                    
                                    <td width="30" class="TabelaDados01Celula">
                                        <div align="center" class="Texto02">
                                        	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemSelecionarA"); ?>
                                        </div>
                                    </td>
                                  </tr>
                                  <?php
									//Seleção.
									$itensRelacaoRegistrosSelect2 = DbFuncoes::GetCampoGenerico06("tb_itens_relacao_registros", 
																									"id_registro", 
																									"id_item", 
																									$idItem, 
																									"", 
																									"", 
																									1, 
																									"", 
																									"", 
																									"tipo_categoria", 
																									"2", 
																									"", 
																									"");
									
									$arrItensRelacaoRegistrosSelect2 = explode(",", $itensRelacaoRegistrosSelect2);
								  
								  
                                    //Loop pelos resultados.
                                    foreach($resultadoProdutos as $linhaProdutos)
                                    {
										$tbItensRelacaoRegistrosValor = Funcoes::MascaraValorLer("0", $GLOBALS['configSistemaMoeda']);
										$flagRegistroSelect = false;
										
										if(in_array($linhaProdutos['id'], $arrItensRelacaoRegistrosSelect2, true) == true)
										{
											if($GLOBALS['habilitarItensRelacaoRegistrosValor'] == 1)
											{
												$tbItensRelacaoRegistrosValor = Funcoes::MascaraValorLer(DbFuncoes::GetCampoGenerico06("tb_itens_relacao_registros", 
																																		"valor", 
																																		"id_item", 
																																		$idItem, 
																																		"", 
																																		"", 
																																		1, 
																																		"", 
																																		"", 
																																		"tipo_categoria", 
																																		"2", 
																																		"id_registro", 
																																		$linhaProdutos['id']));
											}
											$flagRegistroSelect = true;
										}
                                  ?>
                                  <tr class="TbFundoClaro">
                                    <?php if($GLOBALS['habilitarProdutosNClassificacao'] == 1){ ?>
                                    <td class="TabelaDados01Celula" style="display: none;">
                                        <div align="center" class="Texto01">
                                            <?php echo $linhaProdutos['n_classificacao'];?>
                                        </div>
                                    </td>
                                    <?php } ?>
                                    
                                    <?php if($GLOBALS['ativacaoProdutosVisualizacaoImagem'] == 1){ ?>
                                    <td class="TabelaDados01Celula" style="display: none;">
                                        <div align="center" class="Texto01">
                                            <?php if(!empty($linhaProdutos['imagem'])){ ?>
                                                <?php //Sem pop-up. ?>
                                                <?php if($GLOBALS['configImagemPopUp'] == 0){ ?>
                                                    <img src="<?php echo $GLOBALS['configDiretorioArquivos'];?>/t<?php echo $linhaProdutos['imagem'];?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutos['produto']); ?>" />
                                                <?php } ?>
                                            
                                                <?php //SlimBox 2 - JQuery. ?>
                                                <?php if($GLOBALS['configImagemPopUp'] == 1){ ?>
                                                    <a href="<?php echo $GLOBALS['configDiretorioArquivos'];?>/g<?php echo $linhaProdutos['imagem'];?>" rel="lightbox" title="">
                                                        <img src="<?php echo $GLOBALS['configDiretorioArquivos'];?>/t<?php echo $linhaProdutos['imagem'];?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutos['produto']); ?>" />
                                                    </a>
                                                <?php } ?>
                                            <?php } ?>
                                        </div>
                                    </td>
                                    <?php } ?>
                                    
                                    <?php if($GLOBALS['ativacaoProdutosVisualizacaoData'] == 1){ ?>
                                    <td class="TabelaDados01Celula" style="display: none;">
                                        <div align="center" class="Texto01">
                                            <?php //echo $linhaProdutos['data_produto'];?>
                                            <?php echo Funcoes::DataLeitura01($linhaProdutos['data_produto'], $GLOBALS['configSistemaFormatoData'], "1");?>
                                        </div>
                                    </td>
                                    <?php } ?>
                                    
                                    <td class="TabelaDados01Celula">
                                        <div class="Texto01">
                                            <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutos['produto']);?>
                                        </div>
                                        <div class="Texto01">
                                            <?php if($GLOBALS['habilitarProdutosValor'] == 1){ ?>
                                                <strong>
                                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaProdutosValor"); ?>: 
                                                </strong>
                                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>
                                                <?php echo Funcoes::MascaraValorLer($linhaProdutos['valor'], $GLOBALS['configSistemaMoeda']);?>
                                            <?php } ?>
                                            
                                            <?php if($GLOBALS['habilitarProdutosValor1'] == 1){ ?>
                                                <strong>
                                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosValor1Nome'], "IncludeConfig"); ?>: 
                                                </strong>
                                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosValor1Moeda'], "IncludeConfig"); ?>
                                                <?php echo Funcoes::MascaraValorLer($linhaProdutos['valor1'], $GLOBALS['configSistemaMoeda']);?>
                                            <?php } ?>
                                            
                                            <?php if($GLOBALS['habilitarProdutosValor2'] == 1){ ?>
                                                <strong>
                                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosValor2Nome'], "IncludeConfig"); ?>: 
                                                </strong>
                                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosValor2Moeda'], "IncludeConfig"); ?>
                                                <?php echo Funcoes::MascaraValorLer($linhaProdutos['valor2'], $GLOBALS['configSistemaMoeda']);?>
                                            <?php } ?>
                                            
                                            <?php if($GLOBALS['habilitarProdutosPeso'] == 1){ ?>
                                                <strong>
                                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaProdutosPeso"); ?>: 
                                                </strong>
                                                <?php echo $linhaProdutos['peso'];?>
                                                <?php echo " " . Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaPeso'], "IncludeConfig"); ?>
                                            <?php } ?>
                                        </div>
                                        <div class="Texto01" style="display: none;">
                                            <?php if($GLOBALS['habilitarProdutosFotos'] == 1){ ?>
                                                [
                                                <a href="ArquivosIndice.php?idParent=<?php echo $linhaProdutos['id'];?>&tipoArquivo=1&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutos['produto']);?>&detalhe02=" target="_blank" class="Links01">
                                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserirFotos"); ?>
                                                </a>
                                                ] 
                                            <?php } ?>
                                            <?php if($GLOBALS['habilitarProdutosVideos'] == 1){ ?>
                                                [
                                                <a href="ArquivosIndice.php?idParent=<?php echo $linhaProdutos['id'];?>&tipoArquivo=2&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutos['produto']);?>&detalhe02=" target="_blank" class="Links01">
                                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserirVideos"); ?>
                                                </a>
                                                ] 
                                            <?php } ?>
                                            <?php if($GLOBALS['habilitarProdutosArquivos'] == 1){ ?>
                                                [
                                                <a href="ArquivosIndice.php?idParent=<?php echo $linhaProdutos['id'];?>&tipoArquivo=3&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutos['produto']);?>&detalhe02=" target="_blank" class="Links01">
                                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserirArquivos"); ?>
                                                </a>
                                                ] 
                                            <?php } ?>
                                            <?php if($GLOBALS['habilitarProdutosZip'] == 1){ ?>
                                                [
                                                <a href="ArquivosIndice.php?idParent=<?php echo $linhaProdutos['id'];?>&tipoArquivo=4&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutos['produto']);?>&detalhe02=" target="_blank" class="Links01">
                                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserirZip"); ?>
                                                </a>
                                                ] 
                                            <?php } ?>
                                            <?php if($GLOBALS['habilitarProdutosSwfs'] == 1){ ?>
                                                [
                                                <a href="ArquivosIndice.php?idParent=<?php echo $linhaProdutos['id'];?>&tipoArquivo=5&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutos['produto']);?>&detalhe02=" target="_blank" class="Links01">
                                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserirSWFs"); ?>
                                                </a>
                                                ] 
                                            <?php } ?>
                                            <?php if($GLOBALS['habilitarProdutosConteudo'] == 1){ ?>
                                                [
                                                <a href="ConteudoIndice.php?idParentConteudo=<?php echo $linhaProdutos['id'];?>&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutos['produto']);?>&detalhe02=" target="_blank" class="Links01">
                                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserirConteudo"); ?>
                                                </a>
                                                ] 
                                            <?php } ?>
                                            
                                            <?php if($GLOBALS['habilitarProdutosHistorico'] == 1){ ?>
                                                [
                                                <a href="HistoricoIndice.php?idParent=<?php echo $linhaProdutos['id'];?>&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutos['produto']);?>&detalhe02=" target="_blank" class="Links01">
                                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserirHistorico"); ?>
                                                </a>
                                                ] 
                                            <?php } ?>
                                            <?php if($GLOBALS['habilitarProdutosModulos'] == 1){ ?>
                                                [
                                                <a href="ModulosIndice.php?idParentModulos=<?php echo $linhaProdutos['id'];?>&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutos['produto']);?>&detalhe02=" target="_blank" class="Links01">
                                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserirModulos"); ?>
                                                </a>
                                                ] 
                                            <?php } ?>
                                            <?php if($GLOBALS['habilitarProdutosAulas'] == 1){ ?>
                                                [
                                                <a href="AulasIndice.php?idParentAulas=<?php echo $linhaProdutos['id'];?>&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutos['produto']);?>&detalhe02=" target="_blank" class="Links01">
                                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserirAulas"); ?>
                                                </a>
                                                ] 
                                            <?php } ?>
                                        </div>
                                        
                                        <?php if($GLOBALS['habilitarProdutosCadastroUsuario'] == 1){ ?>
                                            <div class="Texto01" style="display: none;">
                                                <?php if($linhaProdutos['id_tb_cadastro_usuario'] <> 0){ ?>
                                                    <strong>
                                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaProdutosCadastroUsuario"); ?>:  
                                                    </strong>
                                                    <a href="CadastroAdministrar.php?idTbCadastro=<?php echo $linhaProdutos['id_tb_cadastro_usuario'];?>&masterPageSelect=LayoutSistemaSemMenu.php" target="_blank" class="Links01">
                                                        <?php //echo Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaTarefas['id_parent'], "tb_cadastro", "nome"); ?>
                                                        <?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaProdutos['id_tb_cadastro_usuario'], "tb_cadastro", "nome"), 
                                                        DbFuncoes::GetCampoGenerico01($linhaProdutos['id_tb_cadastro_usuario'], "tb_cadastro", "razao_social"), 
                                                        DbFuncoes::GetCampoGenerico01($linhaProdutos['id_tb_cadastro_usuario'], "tb_cadastro", "nome_fantasia"), 
                                                        1)); ?>
                                                    </a>
                                                <?php } ?>
                                            </div>
                                        <?php } ?>
                                    </td>
                                    
                                    <?php if($GLOBALS['habilitarItensRelacaoRegistrosValor'] == 1){ ?>
                                    <td class="TabelaDados01Celula">
                                        <div align="center" class="Texto01">
											<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>
                                            <input type="text" name="valor_<?php echo $linhaProdutos['id'];?>" id="valor_<?php echo $linhaProdutos['id'];?>" class="CampoNumerico02" maxlength="255" value="<?php echo $tbItensRelacaoRegistrosValor; ?>" />
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemValorDescicao01"); ?>
                                        </div>
                                    </td>
                                    <?php } ?>
                                    
                                    <td class="TabelaDados01Celula" style="display: none;">
                                        <div align="center" class="Texto01">
                                            <a href="../<?php echo $GLOBALS['visualizacaoAtivaSistema'];?>/SiteProdutosDetalhes.php?idTbProdutos=<?php echo $linhaProdutos['id'];?>" target="_blank" class="Links01">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemVisualizacao"); ?>
                                            </a>
                                        </div>
                                    </td>
                                    
                                    <td class="<?php if($linhaProdutos['ativacao'] == 1){/*echo "TbFundoClaro";*/}else{echo "TbFundoDesativado";}?> TabelaDados01Celula">
                                        <div align="center" class="Texto01">
                                            <a href="RegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaProdutos['id'];?>&statusAtivacao=<?php echo $linhaProdutos['ativacao'];?>&strTabela=tb_produtos&strCampo=ativacao<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="Links01">
                                            </a>
                                                <?php if($linhaProdutos['ativacao'] == 0){?>
                                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao0"); ?>
                                                <?php } ?>
                                                <?php if($linhaProdutos['ativacao'] == 1){?>
                                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao1"); ?>
                                                <?php } ?>
                                            <?php //echo $linhaProdutos['ativacao'];?>
                                        </div>
                                    </td>
                                    
                                    <?php if($GLOBALS['habilitarProdutosAtivacaoPromocoes'] == 1){ ?>
                                    <td class="<?php if($linhaProdutos['ativacao_promocao'] == 1){/*echo "TbFundoClaro";*/}else{echo "TbFundoDesativado";}?> TabelaDados01Celula" style="display: none;">
                                        <div align="center" class="Texto01">
                                            <a href="RegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaProdutos['id'];?>&statusAtivacao=<?php echo $linhaProdutos['ativacao_promocao'];?>&strTabela=tb_produtos&strCampo=ativacao_promocao<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="Links01">
                                                <?php if($linhaProdutos['ativacao_promocao'] == 0){?>
                                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao0"); ?>
                                                <?php } ?>
                                                <?php if($linhaProdutos['ativacao_promocao'] == 1){?>
                                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao1"); ?>
                                                <?php } ?>
                                            </a>
                                            <?php //echo $linhaProdutos['ativacao'];?>
                                        </div>
                                    </td>
                                    <?php } ?>
                                    
                                    <?php if($GLOBALS['habilitarProdutosAtivacaoHome'] == 1){ ?>
                                    <td class="<?php if($linhaProdutos['ativacao_home'] == 1){/*echo "TbFundoClaro";*/}else{echo "TbFundoDesativado";}?> TabelaDados01Celula" style="display: none;">
                                        <div align="center" class="Texto01">
                                            <a href="RegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaProdutos['id'];?>&statusAtivacao=<?php echo $linhaProdutos['ativacao_home'];?>&strTabela=tb_produtos&strCampo=ativacao_home<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="Links01">
                                                <?php if($linhaProdutos['ativacao_home'] == 0){?>
                                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao0"); ?>
                                                <?php } ?>
                                                <?php if($linhaProdutos['ativacao_home'] == 1){?>
                                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao1"); ?>
                                                <?php } ?>
                                            </a>
                                            <?php //echo $linhaProdutos['ativacao'];?>
                                        </div>
                                    </td>
                                    <?php } ?>
                                    
                                    <?php if($GLOBALS['habilitarProdutosAtivacaoCategoria'] == 1){ ?>
                                    <td class="<?php if($linhaProdutos['ativacao_home_categoria'] == 1){/*echo "TbFundoClaro";*/}else{echo "TbFundoDesativado";}?> TabelaDados01Celula" style="display: none;">
                                        <div align="center" class="Texto01">
                                            <a href="RegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaProdutos['id'];?>&statusAtivacao=<?php echo $linhaProdutos['ativacao_home_categoria'];?>&strTabela=tb_produtos&strCampo=ativacao_home_categoria<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="Links01">
                                                <?php if($linhaProdutos['ativacao_home_categoria'] == 0){?>
                                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao0"); ?>
                                                <?php } ?>
                                                <?php if($linhaProdutos['ativacao_home_categoria'] == 1){?>
                                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao1"); ?>
                                                <?php } ?>
                                            </a>
                                            <?php //echo $linhaProdutos['ativacao'];?>
                                        </div>
                                    </td>
                                    <?php } ?>
                                    
                                    <?php if($GLOBALS['habilitarProdutosAtivacaoAcesso'] == 1){ ?>
                                    <td class="<?php if($linhaProdutos['acesso_restrito'] == 0){/*echo "TbFundoClaro";*/}else{echo "TbFundoDesativado";}?> TabelaDados01Celula" style="display: none;">
                                        <div align="center" class="Texto01">
                                            <a href="RegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaProdutos['id'];?>&statusAtivacao=<?php echo $linhaProdutos['acesso_restrito'];?>&strTabela=tb_produtos&strCampo=acesso_restrito<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="Links01">
                                                <?php if($linhaProdutos['acesso_restrito'] == 0){?>
                                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAcesso0"); ?>
                                                <?php } ?>
                    
                                                <?php if($linhaProdutos['acesso_restrito'] == 1){?>
                                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAcesso1"); ?>
                                                <?php } ?>
                                            </a>
                                            <?php //echo $linhaProdutos['acesso_restrito'];?>
                                        </div>
                                    </td>
                                    <?php } ?>
                    
                                    <td class="TabelaDados01Celula" style="display: none;">
                                        <div align="center" class="Texto01">
                                            <a href="ProdutosEditar.php?idTbProdutos=<?php echo $linhaProdutos['id'];?><?php echo $queryPadrao;?>" class="Links01">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                                            </a>
                                        </div>
                                    </td>
                                    <td class="TabelaDados01Celula" style="display: none;">
                                        <div align="center" class="Texto01">
                                            <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaProdutos['id'];?>" class="CampoCheckBox01" />
                                        </div>
                                    </td>
                                    <td class="TabelaDados01Celula">
                                        <div align="center" class="Texto01">
                                            <input name="idsRegistrosSelecionar[]" type="checkbox" value="<?php echo $linhaProdutos['id'];?>" class="CampoCheckBox01"<?php if(in_array($linhaProdutos['id'], $arrItensRelacaoRegistrosSelect2, true) == true){?> checked="checked"<?php } ?> />
                                        </div>
                                    </td>
                                  </tr>
                                  <?php } ?>
                                </table>
                            <?php } ?>
                            
                            
                            <?php
                            //Limpeza de objetos.
                            //----------
                            unset($strSqlProdutosSelect);
                            unset($statementProdutosSelect);
                            unset($resultadoProdutos);
                            unset($linhaProdutos);
                            //----------
                            ?>
                        </td>
                      </tr>
					<?php } ?>
                    <?php //**************************************************************************************?>
                    
                    
					<?php //Categorias (segmentos).?>
                    <?php //**************************************************************************************?>
                    <?php if($tipoCategoria == "9"){ ?>
                    	<?php
						$idParentCategoriasNivel1 = $linhaCategorias['id'];
						
						
						//Query de pesquisa.
						//----------
						$strSqlCategoriasNivel1Select = "";
						$strSqlCategoriasNivel1Select .= "SELECT ";
						$strSqlCategoriasNivel1Select .= "id, ";
						$strSqlCategoriasNivel1Select .= "id_parent, ";
						$strSqlCategoriasNivel1Select .= "id_tb_cadastro_usuario, ";
						$strSqlCategoriasNivel1Select .= "n_classificacao, ";
						$strSqlCategoriasNivel1Select .= "data_categoria, ";
						$strSqlCategoriasNivel1Select .= "categoria, ";
						$strSqlCategoriasNivel1Select .= "descricao, ";
						$strSqlCategoriasNivel1Select .= "informacao_complementar1, ";
						$strSqlCategoriasNivel1Select .= "informacao_complementar2, ";
						$strSqlCategoriasNivel1Select .= "informacao_complementar3, ";
						$strSqlCategoriasNivel1Select .= "informacao_complementar4, ";
						$strSqlCategoriasNivel1Select .= "informacao_complementar5, ";
						$strSqlCategoriasNivel1Select .= "tipo_categoria, ";
						$strSqlCategoriasNivel1Select .= "imagem, ";
						$strSqlCategoriasNivel1Select .= "ativacao, ";
						$strSqlCategoriasNivel1Select .= "acesso_restrito ";
						$strSqlCategoriasNivel1Select .= "FROM tb_categorias ";
						$strSqlCategoriasNivel1Select .= "WHERE id <> 0 ";
						//$strSqlCategoriasNivel1Select .= "AND id_parent = ? ";
						//$strSqlCategoriasNivel1Select .= "AND id_parent = " . $idParentCategorias . " ";
						$strSqlCategoriasNivel1Select .= "AND id_parent = :id_parent ";
						$strSqlCategoriasNivel1Select .= "ORDER BY " . $GLOBALS['configClassificacaoCategorias'] . " ";
						//echo "strSqlCategoriasNivel1Select=" . $strSqlCategoriasNivel1Select . "<br />";
						//----------
						
						//echo "GLOBALS[configClassificacaoCategorias]=" . $GLOBALS['configClassificacaoCategorias'] . "<br />";
						
						//$resultadoCategorias = mysqli_query($dbSistemaCon, $strSqlCategoriasNivel1Select);
						//$linhaCategorias = mysqli_fetch_array($resultadoCategorias);
						//$linhaCategorias = mysqli_fetch_array($resultadoCategorias, MYSQLI_ASSOC);
						
						$statementCategoriasNivel1Select = $dbSistemaConPDO->prepare($strSqlCategoriasNivel1Select);
						
						if ($statementCategoriasNivel1Select !== false)
						{
							//if($idParentCategorias <> "")
							//{
								$statementCategoriasNivel1Select->bindParam(':id_parent', $idParentCategoriasNivel1, PDO::PARAM_STR);
							//}
							$statementCategoriasNivel1Select->execute();
							/*
							$statementCategoriasNivel1Select->execute(array(
								"id_parent" => $idParentCategorias
							));
							*/
						}
						
						//$resultadoCategorias = $dbSistemaConPDO->query($strSqlCategoriasNivel1Select);
						$resultadoCategoriasNivel1 = $statementCategoriasNivel1Select->fetchAll();
						//----------
						?>
                        

						<?php
                        if(empty($resultadoCategoriasNivel1))
                        {
                            //echo "Nenhum registro encontrado";
                        }else{
                        ?>
							<?php
							//Seleção.
							$itensRelacaoRegistrosSelect9 = DbFuncoes::GetCampoGenerico06("tb_itens_relacao_registros", 
																							"id_registro", 
																							"id_item", 
																							$idItem, 
																							"", 
																							"", 
																							1, 
																							"", 
																							"", 
																							"tipo_categoria", 
																							"9", 
																							"", 
																							"");
							
							$arrItensRelacaoRegistrosSelect9 = explode(",", $itensRelacaoRegistrosSelect9);
							
							
                            //Loop pelos resultados.
                            foreach($resultadoCategoriasNivel1 as $linhaCategoriasNivel1)
                            {
                                //echo "id=" . $linhaCategorias['id'] . "<br />";
                            ?>
                              <tr class="TbFundoClaro">
                                <?php if($GLOBALS['habilitarCategoriasNClassificacao'] == 1){ ?>
                                <td class="TabelaDados01Celula">
                                    <div align="center" class="Texto01">
                                        <?php //echo $linhaCategorias['n_classificacao'];?>
                                    </div>
                                </td>
                                <?php } ?>
                                
                                <td class="TabelaDados01Celula">
                                    <div class="Texto01" style="padding-left: 20px;">
                                        <?php echo Funcoes::ConteudoMascaraLeitura($linhaCategoriasNivel1['categoria']);?>
                                    </div>
                                    <?php //echo "itensRelacaoRegistrosSelect13=" . $itensRelacaoRegistrosSelect13 . "<br />"; ?>
                                </td>
                                <td class="TabelaDados01Celula">
                                    <div align="center" class="Texto01">
                                        <input name="idsRegistrosSelecionar[]" type="checkbox" value="<?php echo $linhaCategoriasNivel1['id'];?>" class="CampoCheckBox01"<?php if(in_array($linhaCategoriasNivel1['id'], $arrItensRelacaoRegistrosSelect9, true) == true){?> checked="checked"<?php } ?> />
                                    </div>
                                </td>
                              </tr>
							<?php } ?>
                        <?php } ?>


                        <?php
						//Limpeza de objetos.
						unset($strSqlCategoriasNivel1Select);
						unset($statementCategoriasNivel1Select);
						unset($resultadoCategoriasNivel1);
						unset($linhaCategoriasNivel1);
						//----------
						?>
					<?php } ?>
                    <?php //**************************************************************************************?>


					<?php //Cadastro.?>
                    <?php //**************************************************************************************?>
                    <?php if($tipoCategoria == "13"){ ?>
						<?php
                        //Definição de variáveis.
                        $idParentCadastro = $linhaCategorias['id'];
                    
                        
                        //Query de pesquisa.
                        //----------
                        $strSqlCadastroSelect = "";
                        $strSqlCadastroSelect .= "SELECT ";
                        //$strSqlCadastroSelect .= "SELECT SQL_CALC_FOUND_ROWS ";
                        $strSqlCadastroSelect .= "id, ";
                        $strSqlCadastroSelect .= "id_tb_categorias, ";
                        //$strSqlCadastroSelect .= "id_parent_cadastro, ";
                        $strSqlCadastroSelect .= "data_cadastro, ";
                        $strSqlCadastroSelect .= "pf_pj, ";
                        $strSqlCadastroSelect .= "nome, ";
                        $strSqlCadastroSelect .= "sexo, ";
                        $strSqlCadastroSelect .= "altura, ";
                        $strSqlCadastroSelect .= "peso, ";
                        $strSqlCadastroSelect .= "razao_social, ";
                        $strSqlCadastroSelect .= "nome_fantasia, ";
                        $strSqlCadastroSelect .= "data_nascimento, ";
                        $strSqlCadastroSelect .= "cpf_, ";
                        $strSqlCadastroSelect .= "rg_, ";
                        $strSqlCadastroSelect .= "cnpj_, ";
                        $strSqlCadastroSelect .= "documento, ";
                        $strSqlCadastroSelect .= "i_municipal, ";
                        $strSqlCadastroSelect .= "i_estadual, ";
                        
                        $strSqlCadastroSelect .= "endereco_principal, ";
                        $strSqlCadastroSelect .= "endereco_numero_principal, ";
                        $strSqlCadastroSelect .= "endereco_complemento_principal, ";
                        $strSqlCadastroSelect .= "bairro_principal, ";
                        $strSqlCadastroSelect .= "cidade_principal, ";
                        $strSqlCadastroSelect .= "estado_principal, ";
                        $strSqlCadastroSelect .= "pais_principal, ";
                        $strSqlCadastroSelect .= "cep_principal, ";
                        
                        $strSqlCadastroSelect .= "ponto_referencia, ";
                        $strSqlCadastroSelect .= "email_principal, ";
                        $strSqlCadastroSelect .= "tel_ddd_principal, ";
                        $strSqlCadastroSelect .= "tel_principal, ";
                        $strSqlCadastroSelect .= "cel_ddd_principal, ";
                        $strSqlCadastroSelect .= "cel_principal, ";
                        $strSqlCadastroSelect .= "fax_ddd_principal, ";
                        $strSqlCadastroSelect .= "fax_principal, ";
                        $strSqlCadastroSelect .= "site_principal, ";
                        $strSqlCadastroSelect .= "n_funcionarios, ";
                        $strSqlCadastroSelect .= "obs_interno, ";
                        $strSqlCadastroSelect .= "id_tb_cadastro_status, ";
                        //$strSqlCadastroSelect .= "id_tb_cadastro, ";
                        $strSqlCadastroSelect .= "id_tb_cadastro1, ";
                        $strSqlCadastroSelect .= "id_tb_cadastro2, ";
                        $strSqlCadastroSelect .= "id_tb_cadastro3, ";
                        $strSqlCadastroSelect .= "ativacao, ";
                        $strSqlCadastroSelect .= "ativacao_destaque, ";
                        $strSqlCadastroSelect .= "ativacao_mala_direta, ";
                        $strSqlCadastroSelect .= "usuario, ";
                        $strSqlCadastroSelect .= "senha, ";
                        
                        $strSqlCadastroSelect .= "imagem, ";
                        $strSqlCadastroSelect .= "logo, ";
                        $strSqlCadastroSelect .= "banner, ";
                        $strSqlCadastroSelect .= "mapa, ";
                        
                        $strSqlCadastroSelect .= "mapa_online, ";
                        $strSqlCadastroSelect .= "palavras_chave, ";
                        $strSqlCadastroSelect .= "apresentacao, ";
                        $strSqlCadastroSelect .= "servicos, ";
                        $strSqlCadastroSelect .= "promocoes, ";
                        $strSqlCadastroSelect .= "condicoes_comerciais, ";
                        $strSqlCadastroSelect .= "formas_pagamento, ";
                        $strSqlCadastroSelect .= "horario_atendimento, ";
                        $strSqlCadastroSelect .= "situacao_atual, ";
                        
                        $strSqlCadastroSelect .= "informacao_complementar1, ";
                        $strSqlCadastroSelect .= "informacao_complementar2, ";
                        $strSqlCadastroSelect .= "informacao_complementar3, ";
                        $strSqlCadastroSelect .= "informacao_complementar4, ";
                        $strSqlCadastroSelect .= "informacao_complementar5, ";
                        $strSqlCadastroSelect .= "informacao_complementar6, ";
                        $strSqlCadastroSelect .= "informacao_complementar7, ";
                        $strSqlCadastroSelect .= "informacao_complementar8, ";
                        $strSqlCadastroSelect .= "informacao_complementar9, ";
                        $strSqlCadastroSelect .= "informacao_complementar10, ";
                        $strSqlCadastroSelect .= "informacao_complementar11, ";
                        $strSqlCadastroSelect .= "informacao_complementar12, ";
                        $strSqlCadastroSelect .= "informacao_complementar13, ";
                        $strSqlCadastroSelect .= "informacao_complementar14, ";
                        $strSqlCadastroSelect .= "informacao_complementar15, ";
                        $strSqlCadastroSelect .= "informacao_complementar16, ";
                        $strSqlCadastroSelect .= "informacao_complementar17, ";
                        $strSqlCadastroSelect .= "informacao_complementar18, ";
                        $strSqlCadastroSelect .= "informacao_complementar19, ";
                        $strSqlCadastroSelect .= "informacao_complementar20, ";
                        $strSqlCadastroSelect .= "informacao_complementar21, ";
                        $strSqlCadastroSelect .= "informacao_complementar22, ";
                        $strSqlCadastroSelect .= "informacao_complementar23, ";
                        $strSqlCadastroSelect .= "informacao_complementar24, ";
                        $strSqlCadastroSelect .= "informacao_complementar25, ";
                        $strSqlCadastroSelect .= "informacao_complementar26, ";
                        $strSqlCadastroSelect .= "informacao_complementar27, ";
                        $strSqlCadastroSelect .= "informacao_complementar28, ";
                        $strSqlCadastroSelect .= "informacao_complementar29, ";
                        $strSqlCadastroSelect .= "informacao_complementar30, ";
                        $strSqlCadastroSelect .= "informacao_complementar31, ";
                        $strSqlCadastroSelect .= "informacao_complementar32, ";
                        $strSqlCadastroSelect .= "informacao_complementar33, ";
                        $strSqlCadastroSelect .= "informacao_complementar34, ";
                        $strSqlCadastroSelect .= "informacao_complementar35, ";
                        $strSqlCadastroSelect .= "informacao_complementar36, ";
                        $strSqlCadastroSelect .= "informacao_complementar37, ";
                        $strSqlCadastroSelect .= "informacao_complementar38, ";
                        $strSqlCadastroSelect .= "informacao_complementar39, ";
                        $strSqlCadastroSelect .= "informacao_complementar40, ";
                        $strSqlCadastroSelect .= "n_visitas ";
                        $strSqlCadastroSelect .= "FROM tb_cadastro ";
                        $strSqlCadastroSelect .= "WHERE id <> 0 ";
                        if($idParentCadastro <> "")
                        {
                            $strSqlCadastroSelect .= "AND id_tb_categorias = :id_tb_categorias ";
                        }
                        $strSqlCadastroSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
                        //----------
                        
                        
                        //Criação de componentes.
                        //----------
                        $statementCadastroSelect = $dbSistemaConPDO->prepare($strSqlCadastroSelect);
                        
                        if ($statementCadastroSelect !== false)
                        {
                            if($idParentCadastro <> "")
                            {
                                $statementCadastroSelect->bindParam(':id_tb_categorias', $idParentCadastro, PDO::PARAM_STR);
                            }
                            $statementCadastroSelect->execute();
                            /*
                            //"idsTdCadastro" => $idsTdCadastro
                            $statementCadastroSelect->execute(array(
                                "id_tb_categorias" => $idParentCadastro
                            ));
                            */
                        }
                        
                        $resultadoCadastro = $statementCadastroSelect->fetchAll();
                        //----------
                        ?>
                        
						<?php
                        if(empty($resultadoCadastro))
                        {
                            //echo "Nenhum registro encontrado";
                        }else{
                        ?>
							<?php
							//Seleção.
							$itensRelacaoRegistrosSelect13 = DbFuncoes::GetCampoGenerico06("tb_itens_relacao_registros", 
																							"id_registro", 
																							"id_item", 
																							$idItem, 
																							"", 
																							"", 
																							1, 
																							"", 
																							"", 
																							"tipo_categoria", 
																							"13", 
																							"", 
																							"");
							
							$arrItensRelacaoRegistrosSelect13 = explode(",", $itensRelacaoRegistrosSelect13);
							
							
                            //Loop pelos resultados.
                            foreach($resultadoCadastro as $linhaCadastro)
                            {
                                //echo "id=" . $linhaCategorias['id'] . "<br />";
                            ?>
                              <tr class="TbFundoClaro">
                                <?php if($GLOBALS['habilitarCategoriasNClassificacao'] == 1){ ?>
                                <td class="TabelaDados01Celula">
                                    <div align="center" class="Texto01">
                                        <?php //echo $linhaCategorias['n_classificacao'];?>
                                    </div>
                                </td>
                                <?php } ?>
                                
                                <td class="TabelaDados01Celula">
                                    <div class="Texto01" style="padding-left: 20px;">
                                        <?php //echo Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome']);?>
                                        <?php echo Funcoes::GetCadastroTitulo(Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome']), 
                                                                            Funcoes::ConteudoMascaraLeitura($linhaCadastro['razao_social']), 
                                                                            Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome_fantasia']), 
                                                                            1); 
                                        ?>
                                    </div>
                                    <?php //echo "itensRelacaoRegistrosSelect13=" . $itensRelacaoRegistrosSelect13 . "<br />"; ?>
                                </td>
                                <td class="TabelaDados01Celula">
                                    <div align="center" class="Texto01">
                                        <input name="idsRegistrosSelecionar[]" type="checkbox" value="<?php echo $linhaCadastro['id'];?>" class="CampoCheckBox01"<?php if(in_array($linhaCadastro['id'], $arrItensRelacaoRegistrosSelect13, true) == true){?> checked="checked"<?php } ?> />
                                    </div>
                                </td>
                              </tr>
							<?php } ?>
                        <?php } ?>
                        
                        
                        <?php
                        //Limpeza de objetos.
                        //----------
                        unset($strSqlCadastroSelect);
                        unset($statementCadastroSelect);
                        unset($resultadoCadastro);
                        unset($linhaCadastro);
                        //----------
                        ?>
					<?php } ?>
                    <?php //**************************************************************************************?>
                    
                    
					<?php //Páginas.?>
                    <?php //**************************************************************************************?>
                    <?php if($tipoCategoria == "26"){ ?>
						<?php
                        //Definição de variáveis.
                        $idParentCadastro = $linhaCategorias['id'];
                        
                        
                        //Query de pesquisa.
                        //----------
                        $strSqlPaginasSelect = "";
                        $strSqlPaginasSelect .= "SELECT ";
                        //$strSqlPaginasSelect .= "* ";
                        $strSqlPaginasSelect .= "id, ";
                        $strSqlPaginasSelect .= "id_parent, ";
                        $strSqlPaginasSelect .= "id_tb_cadastro1, ";
                        $strSqlPaginasSelect .= "id_tb_cadastro2, ";
                        $strSqlPaginasSelect .= "id_tb_cadastro3, ";
                        $strSqlPaginasSelect .= "n_classificacao, ";
                        $strSqlPaginasSelect .= "data_criacao, ";
                        $strSqlPaginasSelect .= "titulo, ";
                        $strSqlPaginasSelect .= "descricao, ";
                        $strSqlPaginasSelect .= "palavras_chave, ";
                        $strSqlPaginasSelect .= "url1, ";
                        $strSqlPaginasSelect .= "url2, ";
                        $strSqlPaginasSelect .= "url3, ";
                        $strSqlPaginasSelect .= "url4, ";
                        $strSqlPaginasSelect .= "url5, ";
                        $strSqlPaginasSelect .= "imagem, ";
                        $strSqlPaginasSelect .= "arquivo1, ";
                        $strSqlPaginasSelect .= "arquivo2, ";
                        $strSqlPaginasSelect .= "arquivo3, ";
                        $strSqlPaginasSelect .= "arquivo4, ";
                        $strSqlPaginasSelect .= "arquivo5, ";
                        
                        $strSqlPaginasSelect .= "informacao_complementar1, ";
                        $strSqlPaginasSelect .= "informacao_complementar2, ";
                        $strSqlPaginasSelect .= "informacao_complementar3, ";
                        $strSqlPaginasSelect .= "informacao_complementar4, ";
                        $strSqlPaginasSelect .= "informacao_complementar5, ";
                        $strSqlPaginasSelect .= "informacao_complementar6, ";
                        $strSqlPaginasSelect .= "informacao_complementar7, ";
                        $strSqlPaginasSelect .= "informacao_complementar8, ";
                        $strSqlPaginasSelect .= "informacao_complementar9, ";
                        $strSqlPaginasSelect .= "informacao_complementar10, ";
                        $strSqlPaginasSelect .= "informacao_complementar11, ";
                        $strSqlPaginasSelect .= "informacao_complementar12, ";
                        $strSqlPaginasSelect .= "informacao_complementar13, ";
                        $strSqlPaginasSelect .= "informacao_complementar14, ";
                        $strSqlPaginasSelect .= "informacao_complementar15, ";
                        
                        $strSqlPaginasSelect .= "ativacao, ";
                        $strSqlPaginasSelect .= "ativacao1, ";
                        $strSqlPaginasSelect .= "ativacao2, ";
                        $strSqlPaginasSelect .= "ativacao3, ";
                        $strSqlPaginasSelect .= "ativacao4, ";
                        
                        $strSqlPaginasSelect .= "n_visitas, ";
                        $strSqlPaginasSelect .= "acesso_restrito ";
                        
                        $strSqlPaginasSelect .= "FROM tb_paginas ";
                        $strSqlPaginasSelect .= "WHERE id <> 0 ";
                        
                        if($idParentPaginas <> "")
                        {
                            $strSqlPaginasSelect .= "AND id_parent = :id_parent ";
                        }
                        
                        $strSqlPaginasSelect .= "ORDER BY " . $GLOBALS['configClassificacaoPaginas'] . " ";
                        //----------
                        
                        
                        $statementPaginasSelect = $dbSistemaConPDO->prepare($strSqlPaginasSelect);
                        
                        if ($statementPaginasSelect !== false)
                        {
                            if($idParentPaginas <> "")
                            {
                                $statementPaginasSelect->bindParam(':id_parent', $idParentPaginas, PDO::PARAM_STR);
                            }
                            $statementPaginasSelect->execute();
                        
                            /*
                            $statementPaginasSelect->execute(array(
                                "id_parent" => $idParentPaginas
                            ));
                            */
                        }
                        
                        //$resultadoPaginas = $dbSistemaConPDO->query($strSqlPaginasSelect);
                        $resultadoPaginas = $statementPaginasSelect->fetchAll();
                        ?>
                        
						<?php
                        if(empty($resultadoPaginas))
                        {
                            //echo "Nenhum registro encontrado";
                        }else{
                        ?>
							<?php
							//Seleção.
							$itensRelacaoRegistrosSelect26 = DbFuncoes::GetCampoGenerico06("tb_itens_relacao_registros", 
							"id_registro", 
							"id_item", 
							$idItem, 
							"", 
							"", 
							1, 
							"", 
							"", 
							"tipo_categoria", 
							"26", 
							"", 
							"");
							
							$arrItensRelacaoRegistrosSelect26 = explode(",", $itensRelacaoRegistrosSelect26);
							
							
                            //Loop pelos resultados.
                            foreach($resultadoPaginas as $linhaPaginas)
                            {
                                //echo "id=" . $linhaCategorias['id'] . "<br />";
                            ?>
                              <tr class="TbFundoClaro">
                                <?php if($GLOBALS['habilitarCategoriasNClassificacao'] == 1){ ?>
                                <td class="TabelaDados01Celula">
                                    <div align="center" class="Texto01">
                                        <?php //echo $linhaCategorias['n_classificacao'];?>
                                    </div>
                                </td>
                                <?php } ?>
                                
                                <td class="TabelaDados01Celula">
                                    <div class="Texto01" style="padding-left: 20px;">
                                        <?php echo Funcoes::ConteudoMascaraLeitura($linhaPaginas['titulo']);?>
                                    </div>
                                    <?php //echo "itensRelacaoRegistrosSelect13=" . $itensRelacaoRegistrosSelect13 . "<br />"; ?>
                                </td>
                                <td class="TabelaDados01Celula">
                                    <div align="center" class="Texto01">
                                        <input name="idsRegistrosSelecionar[]" type="checkbox" value="<?php echo $linhaPaginas['id'];?>" class="CampoCheckBox01"<?php if(in_array($linhaPaginas['id'], $arrItensRelacaoRegistrosSelect26, true) == true){?> checked="checked"<?php } ?> />
                                    </div>
                                </td>
                              </tr>
							<?php } ?>
                        <?php } ?>
                        
                        <?php
                        //Limpeza de objetos.
                        //----------
                        unset($strSqlPaginasSelect);
                        unset($statementPaginasSelect);
                        unset($resultadoPaginas);
                        unset($linhaPaginas);
                        //----------
                        ?>
					<?php } ?>
                    <?php //**************************************************************************************?>
                    
                    
                  <?php } ?>
                  
                </table>
                
                <div>
                    <div style="float:left;">
                        <input type="image" name="btoSelecionar" value="Submit" src="img/btoSalvar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoSalvar"); ?>" />
                    </div>
                    <div style="float:right;">
                        &nbsp;
                    </div>
                </div>
            </form>
        </div>
    <?php } ?>


	<?php
	//Limpeza de objetos.
	//----------
	unset($strSqlCategoriasSelect);
	unset($statementCategoriasSelect);
	unset($resultadoCategorias);
	unset($linhaCategorias);
	//----------
	?>
<?php 
$page->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php 
//Inclusão do template do layout.
include_once $page->LayoutSistema;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>