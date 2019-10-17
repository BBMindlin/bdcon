<?php
//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeLayout.php";


//Verificação de login Master.
LoginAutenticacao::UsuarioLoginVerificacao();


//Resgate de variáveis.
$paginaRetorno = "ProdutosManutencao.php";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];


//Montagem de query padrão de retorno.
$queryPadrao = "&paginaRetorno=" . $paginaRetorno;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configNomeCliente'], "IncludeConfig"); ?>
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
    	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaProdutosManutencaoTitulo"); ?>
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
    
	<?php //Status.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarProdutosStatus'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 1;
		
        //Query de pesquisa.
        //----------
        $strSqlProdutosManutencao1Select = "";
        $strSqlProdutosManutencao1Select .= "SELECT ";
        $strSqlProdutosManutencao1Select .= "id, ";
        $strSqlProdutosManutencao1Select .= "tipo_complemento, ";
        $strSqlProdutosManutencao1Select .= "complemento, ";
        $strSqlProdutosManutencao1Select .= "descricao ";
        $strSqlProdutosManutencao1Select .= "FROM tb_produtos_complemento ";
        $strSqlProdutosManutencao1Select .= "WHERE id <> 0 ";
        $strSqlProdutosManutencao1Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlProdutosManutencao1Select .= "ORDER BY " . $GLOBALS['configClassificacaoProdutos'] . " ";
        $strSqlProdutosManutencao1Select .= "ORDER BY complemento";
        
        $statementProdutosManutencao1Select = $dbSistemaConPDO->prepare($strSqlProdutosManutencao1Select);
        
        if ($statementProdutosManutencao1Select !== false)
        {
            $statementProdutosManutencao1Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoProdutosManutencao1 = $dbSistemaConPDO->query($strSqlProdutosManutencao1Select);
        $resultadoProdutosManutencao1 = $statementProdutosManutencao1Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaProdutosStatus"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoProdutosManutencao1))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formProdutosManutencao1Acoes" id="formProdutosManutencao1Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_produtos_complemento" />
            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            
            <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            <div style="position:relative; display: block; clear: both;">
                <div align="right" style="float: right;">
                    <input type="image" name="submit" value="Submit" src="img/btoExcluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoExcluir"); ?>">
                </div>
            </div>
        
            <table width="100%" class="TabelaDados01">
              <tr class="TbFundoEscuro">
                <td width="50" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemId"); ?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaProdutosStatus"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemExcluir"); ?>
                    </div>
                </td>
              </tr>
              <?php
                //Loop pelos resultados.
                foreach($resultadoProdutosManutencao1 as $linhaProdutosManutencao1)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaProdutosManutencao1['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosManutencao1['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="ProdutosManutencaoEditar.php?idTbProdutosComplemento=<?php echo $linhaProdutosManutencao1['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaProdutosManutencao1['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formProdutosManutencao1" id="formProdutosManutencao1" action="ProdutosManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaProdutosManutencaoTbStatus"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaProdutosStatus"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div align="left">
                            <input type="text" name="complemento" id="complemento" class="CampoTexto01" maxlength="255" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaProdutosManutencaoDescricao"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div>
                            <textarea name="descricao" id="descricao" class="CampoTextoMultilinha01"></textarea>
                        </div>
                    </td>
                </tr>
            </table>
            <div>
                <div style="float:left;">
                    <input type="image" name="submit" value="Submit" src="img/btoIncluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoIncluir"); ?>" />
                    <input name="tipo_complemento" type="hidden" id="tipo_complemento" value="<?php echo $tipoComplemento; ?>" />
                    
                    <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                </div>
                <div style="float:right;">
                    &nbsp;
                </div>
            </div>
        </form>
        <br />
        <br />
        <br />
        
        <?php 
        //Limpeza de objetos.
        //----------
        unset($strSqlProdutosManutencao1Select);
        unset($statementProdutosManutencao1Select);
        unset($resultadoProdutosManutencao1);
        unset($linhaProdutosManutencao1);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>
    
    
	<?php //Tipo.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarProdutosTipo'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 2;
		
        //Query de pesquisa.
        //----------
        $strSqlProdutosManutencao2Select = "";
        $strSqlProdutosManutencao2Select .= "SELECT ";
        $strSqlProdutosManutencao2Select .= "id, ";
        $strSqlProdutosManutencao2Select .= "tipo_complemento, ";
        $strSqlProdutosManutencao2Select .= "complemento, ";
        $strSqlProdutosManutencao2Select .= "descricao ";
        $strSqlProdutosManutencao2Select .= "FROM tb_produtos_complemento ";
        $strSqlProdutosManutencao2Select .= "WHERE id <> 0 ";
        $strSqlProdutosManutencao2Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlProdutosManutencao2Select .= "ORDER BY " . $GLOBALS['configClassificacaoProdutos'] . " ";
        $strSqlProdutosManutencao2Select .= "ORDER BY complemento";
        
        $statementProdutosManutencao2Select = $dbSistemaConPDO->prepare($strSqlProdutosManutencao2Select);
        
        if ($statementProdutosManutencao2Select !== false)
        {
            $statementProdutosManutencao2Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoProdutosManutencao2 = $dbSistemaConPDO->query($strSqlProdutosManutencao2Select);
        $resultadoProdutosManutencao2 = $statementProdutosManutencao2Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaProdutosTipo"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoProdutosManutencao2))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formProdutosManutencao2Acoes" id="formProdutosManutencao2Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_produtos_complemento" />
            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            
            <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            <div style="position:relative; display: block; clear: both;">
                <div align="right" style="float: right;">
                    <input type="image" name="submit" value="Submit" src="img/btoExcluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoExcluir"); ?>">
                </div>
            </div>
        
            <table width="100%" class="TabelaDados01">
              <tr class="TbFundoEscuro">
                <td width="50" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemId"); ?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaProdutosTipo"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemExcluir"); ?>
                    </div>
                </td>
              </tr>
              <?php
                //Loop pelos resultados.
                foreach($resultadoProdutosManutencao2 as $linhaProdutosManutencao2)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaProdutosManutencao2['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosManutencao2['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="ProdutosManutencaoEditar.php?idTbProdutosComplemento=<?php echo $linhaProdutosManutencao2['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaProdutosManutencao2['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formProdutosManutencao2" id="formProdutosManutencao2" action="ProdutosManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaProdutosManutencaoTbTipo"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaProdutosTipo"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div align="left">
                            <input type="text" name="complemento" id="complemento" class="CampoTexto01" maxlength="255" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaProdutosManutencaoDescricao"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div>
                            <textarea name="descricao" id="descricao" class="CampoTextoMultilinha01"></textarea>
                        </div>
                    </td>
                </tr>
            </table>
            <div>
                <div style="float:left;">
                    <input type="image" name="submit" value="Submit" src="img/btoIncluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoIncluir"); ?>" />
                    <input name="tipo_complemento" type="hidden" id="tipo_complemento" value="<?php echo $tipoComplemento; ?>" />
                    
                    <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                </div>
                <div style="float:right;">
                    &nbsp;
                </div>
            </div>
        </form>
        <br />
        <br />
        <br />
        
        <?php 
        //Limpeza de objetos.
        //----------
        unset($strSqlProdutosManutencao2Select);
        unset($statementProdutosManutencao2Select);
        unset($resultadoProdutosManutencao2);
        unset($linhaProdutosManutencao2);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>
    

	<?php //Produtos - Filtro Genérico 01.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarProdutosFiltroGenerico01'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 12;
		
        //Query de pesquisa.
        //----------
        $strSqlProdutosManutencao12Select = "";
        $strSqlProdutosManutencao12Select .= "SELECT ";
        $strSqlProdutosManutencao12Select .= "id, ";
        $strSqlProdutosManutencao12Select .= "tipo_complemento, ";
        $strSqlProdutosManutencao12Select .= "complemento, ";
        $strSqlProdutosManutencao12Select .= "descricao ";
        $strSqlProdutosManutencao12Select .= "FROM tb_produtos_complemento ";
        $strSqlProdutosManutencao12Select .= "WHERE id <> 0 ";
        $strSqlProdutosManutencao12Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlProdutosManutencao12Select .= "ORDER BY " . $GLOBALS['configClassificacaoProdutos'] . " ";
        $strSqlProdutosManutencao12Select .= "ORDER BY complemento";
        
        $statementProdutosManutencao12Select = $dbSistemaConPDO->prepare($strSqlProdutosManutencao12Select);
        
        if ($statementProdutosManutencao12Select !== false)
        {
            $statementProdutosManutencao12Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoProdutosManutencao12 = $dbSistemaConPDO->query($strSqlProdutosManutencao12Select);
        $resultadoProdutosManutencao12 = $statementProdutosManutencao12Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico01Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoProdutosManutencao12))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formProdutosManutencao12Acoes" id="formProdutosManutencao12Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_produtos_complemento" />
            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            
            <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            <div style="position:relative; display: block; clear: both;">
                <div align="right" style="float: right;">
                    <input type="image" name="submit" value="Submit" src="img/btoExcluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoExcluir"); ?>">
                </div>
            </div>
        
            <table width="100%" class="TabelaDados01">
              <tr class="TbFundoEscuro">
                <td width="50" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemId"); ?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico01Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemExcluir"); ?>
                    </div>
                </td>
              </tr>
              <?php
                //Loop pelos resultados.
                foreach($resultadoProdutosManutencao12 as $linhaProdutosManutencao12)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaProdutosManutencao12['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosManutencao12['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="ProdutosManutencaoEditar.php?idTbProdutosComplemento=<?php echo $linhaProdutosManutencao12['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaProdutosManutencao12['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formProdutosManutencao12" id="formProdutosManutencao12" action="ProdutosManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico01Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico01Nome'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div align="left">
                            <input type="text" name="complemento" id="complemento" class="CampoTexto01" maxlength="255" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaProdutosManutencaoDescricao"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div>
                            <textarea name="descricao" id="descricao" class="CampoTextoMultilinha01"></textarea>
                        </div>
                    </td>
                </tr>
            </table>
            <div>
                <div style="float:left;">
                    <input type="image" name="submit" value="Submit" src="img/btoIncluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoIncluir"); ?>" />
                    <input name="tipo_complemento" type="hidden" id="tipo_complemento" value="<?php echo $tipoComplemento; ?>" />
                    
                    <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                </div>
                <div style="float:right;">
                    &nbsp;
                </div>
            </div>
        </form>
        <br />
        <br />
        <br />
        
        <?php 
        //Limpeza de objetos.
        //----------
        unset($strSqlProdutosManutencao12Select);
        unset($statementProdutosManutencao12Select);
        unset($resultadoProdutosManutencao12);
        unset($linhaProdutosManutencao12);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Produtos - Filtro Genérico 02.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarProdutosFiltroGenerico02'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 13;
		
        //Query de pesquisa.
        //----------
        $strSqlProdutosManutencao13Select = "";
        $strSqlProdutosManutencao13Select .= "SELECT ";
        $strSqlProdutosManutencao13Select .= "id, ";
        $strSqlProdutosManutencao13Select .= "tipo_complemento, ";
        $strSqlProdutosManutencao13Select .= "complemento, ";
        $strSqlProdutosManutencao13Select .= "descricao ";
        $strSqlProdutosManutencao13Select .= "FROM tb_produtos_complemento ";
        $strSqlProdutosManutencao13Select .= "WHERE id <> 0 ";
        $strSqlProdutosManutencao13Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlProdutosManutencao13Select .= "ORDER BY " . $GLOBALS['configClassificacaoProdutos'] . " ";
        $strSqlProdutosManutencao13Select .= "ORDER BY complemento";
        
        $statementProdutosManutencao13Select = $dbSistemaConPDO->prepare($strSqlProdutosManutencao13Select);
        
        if ($statementProdutosManutencao13Select !== false)
        {
            $statementProdutosManutencao13Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoProdutosManutencao13 = $dbSistemaConPDO->query($strSqlProdutosManutencao13Select);
        $resultadoProdutosManutencao13 = $statementProdutosManutencao13Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico02Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoProdutosManutencao13))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formProdutosManutencao13Acoes" id="formProdutosManutencao13Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_produtos_complemento" />
            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            
            <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            <div style="position:relative; display: block; clear: both;">
                <div align="right" style="float: right;">
                    <input type="image" name="submit" value="Submit" src="img/btoExcluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoExcluir"); ?>">
                </div>
            </div>
        
            <table width="100%" class="TabelaDados01">
              <tr class="TbFundoEscuro">
                <td width="50" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemId"); ?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico02Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemExcluir"); ?>
                    </div>
                </td>
              </tr>
              <?php
                //Loop pelos resultados.
                foreach($resultadoProdutosManutencao13 as $linhaProdutosManutencao13)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaProdutosManutencao13['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosManutencao13['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="ProdutosManutencaoEditar.php?idTbProdutosComplemento=<?php echo $linhaProdutosManutencao13['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaProdutosManutencao13['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formProdutosManutencao13" id="formProdutosManutencao13" action="ProdutosManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico02Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico02Nome'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div align="left">
                            <input type="text" name="complemento" id="complemento" class="CampoTexto01" maxlength="255" />
                        </div>
                    </td>

                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaProdutosManutencaoDescricao"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div>
                            <textarea name="descricao" id="descricao" class="CampoTextoMultilinha01"></textarea>
                        </div>
                    </td>
                </tr>
            </table>
            <div>
                <div style="float:left;">
                    <input type="image" name="submit" value="Submit" src="img/btoIncluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoIncluir"); ?>" />
                    <input name="tipo_complemento" type="hidden" id="tipo_complemento" value="<?php echo $tipoComplemento; ?>" />
                    
                    <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                </div>
                <div style="float:right;">
                    &nbsp;
                </div>
            </div>
        </form>
        <br />
        <br />
        <br />
        
        <?php 
        //Limpeza de objetos.
        //----------
        unset($strSqlProdutosManutencao13Select);
        unset($statementProdutosManutencao13Select);
        unset($resultadoProdutosManutencao13);
        unset($linhaProdutosManutencao13);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Produtos - Filtro Genérico 03.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarProdutosFiltroGenerico03'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 14;
		
        //Query de pesquisa.
        //----------
        $strSqlProdutosManutencao14Select = "";
        $strSqlProdutosManutencao14Select .= "SELECT ";
        $strSqlProdutosManutencao14Select .= "id, ";
        $strSqlProdutosManutencao14Select .= "tipo_complemento, ";
        $strSqlProdutosManutencao14Select .= "complemento, ";
        $strSqlProdutosManutencao14Select .= "descricao ";
        $strSqlProdutosManutencao14Select .= "FROM tb_produtos_complemento ";
        $strSqlProdutosManutencao14Select .= "WHERE id <> 0 ";
        $strSqlProdutosManutencao14Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlProdutosManutencao14Select .= "ORDER BY " . $GLOBALS['configClassificacaoProdutos'] . " ";
        $strSqlProdutosManutencao14Select .= "ORDER BY complemento";
        
        $statementProdutosManutencao14Select = $dbSistemaConPDO->prepare($strSqlProdutosManutencao14Select);
        
        if ($statementProdutosManutencao14Select !== false)
        {
            $statementProdutosManutencao14Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoProdutosManutencao14 = $dbSistemaConPDO->query($strSqlProdutosManutencao14Select);
        $resultadoProdutosManutencao14 = $statementProdutosManutencao14Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico03Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoProdutosManutencao14))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formProdutosManutencao14Acoes" id="formProdutosManutencao14Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_produtos_complemento" />
            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            
            <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            <div style="position:relative; display: block; clear: both;">
                <div align="right" style="float: right;">
                    <input type="image" name="submit" value="Submit" src="img/btoExcluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoExcluir"); ?>">
                </div>
            </div>
        
            <table width="100%" class="TabelaDados01">
              <tr class="TbFundoEscuro">
                <td width="50" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemId"); ?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico03Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemExcluir"); ?>
                    </div>
                </td>
              </tr>
              <?php
                //Loop pelos resultados.
                foreach($resultadoProdutosManutencao14 as $linhaProdutosManutencao14)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaProdutosManutencao14['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosManutencao14['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="ProdutosManutencaoEditar.php?idTbProdutosComplemento=<?php echo $linhaProdutosManutencao14['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaProdutosManutencao14['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formProdutosManutencao14" id="formProdutosManutencao14" action="ProdutosManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico03Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico03Nome'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div align="left">
                            <input type="text" name="complemento" id="complemento" class="CampoTexto01" maxlength="255" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaProdutosManutencaoDescricao"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div>
                            <textarea name="descricao" id="descricao" class="CampoTextoMultilinha01"></textarea>
                        </div>
                    </td>
                </tr>
            </table>
            <div>
                <div style="float:left;">
                    <input type="image" name="submit" value="Submit" src="img/btoIncluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoIncluir"); ?>" />
                    <input name="tipo_complemento" type="hidden" id="tipo_complemento" value="<?php echo $tipoComplemento; ?>" />
                    
                    <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                </div>
                <div style="float:right;">
                    &nbsp;
                </div>
            </div>
        </form>
        <br />
        <br />
        <br />
        
        <?php 
        //Limpeza de objetos.
        //----------
        unset($strSqlProdutosManutencao14Select);
        unset($statementProdutosManutencao14Select);
        unset($resultadoProdutosManutencao14);
        unset($linhaProdutosManutencao14);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Produtos - Filtro Genérico 04.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarProdutosFiltroGenerico04'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 15;
		
        //Query de pesquisa.
        //----------
        $strSqlProdutosManutencao15Select = "";
        $strSqlProdutosManutencao15Select .= "SELECT ";
        $strSqlProdutosManutencao15Select .= "id, ";
        $strSqlProdutosManutencao15Select .= "tipo_complemento, ";
        $strSqlProdutosManutencao15Select .= "complemento, ";
        $strSqlProdutosManutencao15Select .= "descricao ";
        $strSqlProdutosManutencao15Select .= "FROM tb_produtos_complemento ";
        $strSqlProdutosManutencao15Select .= "WHERE id <> 0 ";
        $strSqlProdutosManutencao15Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlProdutosManutencao15Select .= "ORDER BY " . $GLOBALS['configClassificacaoProdutos'] . " ";
        $strSqlProdutosManutencao15Select .= "ORDER BY complemento";
        
        $statementProdutosManutencao15Select = $dbSistemaConPDO->prepare($strSqlProdutosManutencao15Select);
        
        if ($statementProdutosManutencao15Select !== false)
        {
            $statementProdutosManutencao15Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoProdutosManutencao15 = $dbSistemaConPDO->query($strSqlProdutosManutencao15Select);
        $resultadoProdutosManutencao15 = $statementProdutosManutencao15Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico04Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoProdutosManutencao15))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formProdutosManutencao15Acoes" id="formProdutosManutencao15Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_produtos_complemento" />
            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            
            <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            <div style="position:relative; display: block; clear: both;">
                <div align="right" style="float: right;">
                    <input type="image" name="submit" value="Submit" src="img/btoExcluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoExcluir"); ?>">
                </div>
            </div>
        
            <table width="100%" class="TabelaDados01">
              <tr class="TbFundoEscuro">
                <td width="50" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemId"); ?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico04Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemExcluir"); ?>
                    </div>
                </td>
              </tr>
              <?php
                //Loop pelos resultados.
                foreach($resultadoProdutosManutencao15 as $linhaProdutosManutencao15)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaProdutosManutencao15['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosManutencao15['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="ProdutosManutencaoEditar.php?idTbProdutosComplemento=<?php echo $linhaProdutosManutencao15['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaProdutosManutencao15['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formProdutosManutencao15" id="formProdutosManutencao15" action="ProdutosManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico04Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico04Nome'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div align="left">
                            <input type="text" name="complemento" id="complemento" class="CampoTexto01" maxlength="255" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaProdutosManutencaoDescricao"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div>
                            <textarea name="descricao" id="descricao" class="CampoTextoMultilinha01"></textarea>
                        </div>
                    </td>
                </tr>
            </table>
            <div>
                <div style="float:left;">
                    <input type="image" name="submit" value="Submit" src="img/btoIncluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoIncluir"); ?>" />
                    <input name="tipo_complemento" type="hidden" id="tipo_complemento" value="<?php echo $tipoComplemento; ?>" />
                    
                    <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                </div>
                <div style="float:right;">
                    &nbsp;
                </div>
            </div>
        </form>
        <br />
        <br />
        <br />
        
        <?php 
        //Limpeza de objetos.
        //----------
        unset($strSqlProdutosManutencao15Select);
        unset($statementProdutosManutencao15Select);
        unset($resultadoProdutosManutencao15);
        unset($linhaProdutosManutencao15);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Produtos - Filtro Genérico 05.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarProdutosFiltroGenerico05'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 16;
		
        //Query de pesquisa.
        //----------
        $strSqlProdutosManutencao16Select = "";
        $strSqlProdutosManutencao16Select .= "SELECT ";
        $strSqlProdutosManutencao16Select .= "id, ";
        $strSqlProdutosManutencao16Select .= "tipo_complemento, ";
        $strSqlProdutosManutencao16Select .= "complemento, ";
        $strSqlProdutosManutencao16Select .= "descricao ";
        $strSqlProdutosManutencao16Select .= "FROM tb_produtos_complemento ";
        $strSqlProdutosManutencao16Select .= "WHERE id <> 0 ";
        $strSqlProdutosManutencao16Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlProdutosManutencao16Select .= "ORDER BY " . $GLOBALS['configClassificacaoProdutos'] . " ";
        $strSqlProdutosManutencao16Select .= "ORDER BY complemento";
        
        $statementProdutosManutencao16Select = $dbSistemaConPDO->prepare($strSqlProdutosManutencao16Select);
        
        if ($statementProdutosManutencao16Select !== false)
        {
            $statementProdutosManutencao16Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoProdutosManutencao16 = $dbSistemaConPDO->query($strSqlProdutosManutencao16Select);
        $resultadoProdutosManutencao16 = $statementProdutosManutencao16Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico05Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoProdutosManutencao16))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formProdutosManutencao16Acoes" id="formProdutosManutencao16Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_produtos_complemento" />
            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            
            <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            <div style="position:relative; display: block; clear: both;">
                <div align="right" style="float: right;">
                    <input type="image" name="submit" value="Submit" src="img/btoExcluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoExcluir"); ?>">
                </div>
            </div>
        
            <table width="100%" class="TabelaDados01">
              <tr class="TbFundoEscuro">
                <td width="50" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemId"); ?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico05Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemExcluir"); ?>
                    </div>
                </td>
              </tr>
              <?php
                //Loop pelos resultados.
                foreach($resultadoProdutosManutencao16 as $linhaProdutosManutencao16)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaProdutosManutencao16['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosManutencao16['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="ProdutosManutencaoEditar.php?idTbProdutosComplemento=<?php echo $linhaProdutosManutencao16['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaProdutosManutencao16['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formProdutosManutencao16" id="formProdutosManutencao16" action="ProdutosManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico05Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico05Nome'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div align="left">
                            <input type="text" name="complemento" id="complemento" class="CampoTexto01" maxlength="255" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaProdutosManutencaoDescricao"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div>
                            <textarea name="descricao" id="descricao" class="CampoTextoMultilinha01"></textarea>
                        </div>
                    </td>
                </tr>
            </table>
            <div>
                <div style="float:left;">
                    <input type="image" name="submit" value="Submit" src="img/btoIncluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoIncluir"); ?>" />
                    <input name="tipo_complemento" type="hidden" id="tipo_complemento" value="<?php echo $tipoComplemento; ?>" />
                    
                    <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                </div>
                <div style="float:right;">
                    &nbsp;
                </div>
            </div>
        </form>
        <br />
        <br />
        <br />
        
        <?php 
        //Limpeza de objetos.
        //----------
        unset($strSqlProdutosManutencao16Select);
        unset($statementProdutosManutencao16Select);
        unset($resultadoProdutosManutencao16);
        unset($linhaProdutosManutencao16);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Produtos - Filtro Genérico 06.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarProdutosFiltroGenerico06'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 17;
		
        //Query de pesquisa.
        //----------
        $strSqlProdutosManutencao17Select = "";
        $strSqlProdutosManutencao17Select .= "SELECT ";
        $strSqlProdutosManutencao17Select .= "id, ";
        $strSqlProdutosManutencao17Select .= "tipo_complemento, ";
        $strSqlProdutosManutencao17Select .= "complemento, ";
        $strSqlProdutosManutencao17Select .= "descricao ";
        $strSqlProdutosManutencao17Select .= "FROM tb_produtos_complemento ";
        $strSqlProdutosManutencao17Select .= "WHERE id <> 0 ";
        $strSqlProdutosManutencao17Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlProdutosManutencao17Select .= "ORDER BY " . $GLOBALS['configClassificacaoProdutos'] . " ";
        $strSqlProdutosManutencao17Select .= "ORDER BY complemento";
        
        $statementProdutosManutencao17Select = $dbSistemaConPDO->prepare($strSqlProdutosManutencao17Select);
        
        if ($statementProdutosManutencao17Select !== false)
        {
            $statementProdutosManutencao17Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoProdutosManutencao17 = $dbSistemaConPDO->query($strSqlProdutosManutencao17Select);
        $resultadoProdutosManutencao17 = $statementProdutosManutencao17Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico06Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoProdutosManutencao17))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formProdutosManutencao17Acoes" id="formProdutosManutencao17Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_produtos_complemento" />
            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            
            <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            <div style="position:relative; display: block; clear: both;">
                <div align="right" style="float: right;">
                    <input type="image" name="submit" value="Submit" src="img/btoExcluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoExcluir"); ?>">
                </div>
            </div>
        
            <table width="100%" class="TabelaDados01">
              <tr class="TbFundoEscuro">
                <td width="50" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemId"); ?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico06Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemExcluir"); ?>
                    </div>
                </td>
              </tr>
              <?php
                //Loop pelos resultados.
                foreach($resultadoProdutosManutencao17 as $linhaProdutosManutencao17)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaProdutosManutencao17['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosManutencao17['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="ProdutosManutencaoEditar.php?idTbProdutosComplemento=<?php echo $linhaProdutosManutencao17['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaProdutosManutencao17['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formProdutosManutencao17" id="formProdutosManutencao17" action="ProdutosManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico06Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico06Nome'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div align="left">
                            <input type="text" name="complemento" id="complemento" class="CampoTexto01" maxlength="255" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaProdutosManutencaoDescricao"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div>
                            <textarea name="descricao" id="descricao" class="CampoTextoMultilinha01"></textarea>
                        </div>
                    </td>
                </tr>
            </table>
            <div>
                <div style="float:left;">
                    <input type="image" name="submit" value="Submit" src="img/btoIncluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoIncluir"); ?>" />
                    <input name="tipo_complemento" type="hidden" id="tipo_complemento" value="<?php echo $tipoComplemento; ?>" />
                    
                    <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                </div>
                <div style="float:right;">
                    &nbsp;
                </div>
            </div>
        </form>
        <br />
        <br />
        <br />
        
        <?php 
        //Limpeza de objetos.
        //----------
        unset($strSqlProdutosManutencao17Select);
        unset($statementProdutosManutencao17Select);
        unset($resultadoProdutosManutencao17);
        unset($linhaProdutosManutencao17);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Produtos - Filtro Genérico 07.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarProdutosFiltroGenerico07'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 18;
		
        //Query de pesquisa.
        //----------
        $strSqlProdutosManutencao18Select = "";
        $strSqlProdutosManutencao18Select .= "SELECT ";
        $strSqlProdutosManutencao18Select .= "id, ";
        $strSqlProdutosManutencao18Select .= "tipo_complemento, ";
        $strSqlProdutosManutencao18Select .= "complemento, ";
        $strSqlProdutosManutencao18Select .= "descricao ";
        $strSqlProdutosManutencao18Select .= "FROM tb_produtos_complemento ";
        $strSqlProdutosManutencao18Select .= "WHERE id <> 0 ";
        $strSqlProdutosManutencao18Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlProdutosManutencao18Select .= "ORDER BY " . $GLOBALS['configClassificacaoProdutos'] . " ";
        $strSqlProdutosManutencao18Select .= "ORDER BY complemento";
        
        $statementProdutosManutencao18Select = $dbSistemaConPDO->prepare($strSqlProdutosManutencao18Select);
        
        if ($statementProdutosManutencao18Select !== false)
        {
            $statementProdutosManutencao18Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoProdutosManutencao18 = $dbSistemaConPDO->query($strSqlProdutosManutencao18Select);
        $resultadoProdutosManutencao18 = $statementProdutosManutencao18Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico07Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoProdutosManutencao18))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formProdutosManutencao18Acoes" id="formProdutosManutencao18Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_produtos_complemento" />
            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            
            <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            <div style="position:relative; display: block; clear: both;">
                <div align="right" style="float: right;">
                    <input type="image" name="submit" value="Submit" src="img/btoExcluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoExcluir"); ?>">
                </div>
            </div>
        
            <table width="100%" class="TabelaDados01">
              <tr class="TbFundoEscuro">
                <td width="50" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemId"); ?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico07Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemExcluir"); ?>
                    </div>
                </td>
              </tr>
              <?php
                //Loop pelos resultados.
                foreach($resultadoProdutosManutencao18 as $linhaProdutosManutencao18)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaProdutosManutencao18['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosManutencao18['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="ProdutosManutencaoEditar.php?idTbProdutosComplemento=<?php echo $linhaProdutosManutencao18['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaProdutosManutencao18['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formProdutosManutencao18" id="formProdutosManutencao18" action="ProdutosManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico07Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico07Nome'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div align="left">
                            <input type="text" name="complemento" id="complemento" class="CampoTexto01" maxlength="255" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaProdutosManutencaoDescricao"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div>
                            <textarea name="descricao" id="descricao" class="CampoTextoMultilinha01"></textarea>
                        </div>
                    </td>
                </tr>
            </table>
            <div>
                <div style="float:left;">
                    <input type="image" name="submit" value="Submit" src="img/btoIncluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoIncluir"); ?>" />
                    <input name="tipo_complemento" type="hidden" id="tipo_complemento" value="<?php echo $tipoComplemento; ?>" />
                    
                    <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                </div>
                <div style="float:right;">
                    &nbsp;
                </div>
            </div>
        </form>
        <br />
        <br />
        <br />
        
        <?php 
        //Limpeza de objetos.
        //----------
        unset($strSqlProdutosManutencao18Select);
        unset($statementProdutosManutencao18Select);
        unset($resultadoProdutosManutencao18);
        unset($linhaProdutosManutencao18);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Produtos - Filtro Genérico 08.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarProdutosFiltroGenerico08'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 19;
		
        //Query de pesquisa.
        //----------
        $strSqlProdutosManutencao19Select = "";
        $strSqlProdutosManutencao19Select .= "SELECT ";
        $strSqlProdutosManutencao19Select .= "id, ";
        $strSqlProdutosManutencao19Select .= "tipo_complemento, ";
        $strSqlProdutosManutencao19Select .= "complemento, ";
        $strSqlProdutosManutencao19Select .= "descricao ";
        $strSqlProdutosManutencao19Select .= "FROM tb_produtos_complemento ";
        $strSqlProdutosManutencao19Select .= "WHERE id <> 0 ";
        $strSqlProdutosManutencao19Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlProdutosManutencao19Select .= "ORDER BY " . $GLOBALS['configClassificacaoProdutos'] . " ";
        $strSqlProdutosManutencao19Select .= "ORDER BY complemento";
        
        $statementProdutosManutencao19Select = $dbSistemaConPDO->prepare($strSqlProdutosManutencao19Select);
        
        if ($statementProdutosManutencao19Select !== false)
        {
            $statementProdutosManutencao19Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoProdutosManutencao19 = $dbSistemaConPDO->query($strSqlProdutosManutencao19Select);
        $resultadoProdutosManutencao19 = $statementProdutosManutencao19Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico08Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoProdutosManutencao19))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formProdutosManutencao19Acoes" id="formProdutosManutencao19Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_produtos_complemento" />
            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            
            <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            <div style="position:relative; display: block; clear: both;">
                <div align="right" style="float: right;">
                    <input type="image" name="submit" value="Submit" src="img/btoExcluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoExcluir"); ?>">
                </div>
            </div>
        
            <table width="100%" class="TabelaDados01">
              <tr class="TbFundoEscuro">
                <td width="50" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemId"); ?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico08Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemExcluir"); ?>
                    </div>
                </td>
              </tr>
              <?php
                //Loop pelos resultados.
                foreach($resultadoProdutosManutencao19 as $linhaProdutosManutencao19)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaProdutosManutencao19['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosManutencao19['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="ProdutosManutencaoEditar.php?idTbProdutosComplemento=<?php echo $linhaProdutosManutencao19['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaProdutosManutencao19['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formProdutosManutencao19" id="formProdutosManutencao19" action="ProdutosManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico08Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico08Nome'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div align="left">
                            <input type="text" name="complemento" id="complemento" class="CampoTexto01" maxlength="255" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaProdutosManutencaoDescricao"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div>
                            <textarea name="descricao" id="descricao" class="CampoTextoMultilinha01"></textarea>
                        </div>
                    </td>
                </tr>
            </table>
            <div>
                <div style="float:left;">
                    <input type="image" name="submit" value="Submit" src="img/btoIncluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoIncluir"); ?>" />
                    <input name="tipo_complemento" type="hidden" id="tipo_complemento" value="<?php echo $tipoComplemento; ?>" />
                    
                    <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                </div>
                <div style="float:right;">
                    &nbsp;
                </div>
            </div>
        </form>
        <br />
        <br />
        <br />
        
        <?php 
        //Limpeza de objetos.
        //----------
        unset($strSqlProdutosManutencao19Select);
        unset($statementProdutosManutencao19Select);
        unset($resultadoProdutosManutencao19);
        unset($linhaProdutosManutencao19);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Produtos - Filtro Genérico 09.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarProdutosFiltroGenerico09'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 20;
		
        //Query de pesquisa.
        //----------
        $strSqlProdutosManutencao20Select = "";
        $strSqlProdutosManutencao20Select .= "SELECT ";
        $strSqlProdutosManutencao20Select .= "id, ";
        $strSqlProdutosManutencao20Select .= "tipo_complemento, ";
        $strSqlProdutosManutencao20Select .= "complemento, ";
        $strSqlProdutosManutencao20Select .= "descricao ";
        $strSqlProdutosManutencao20Select .= "FROM tb_produtos_complemento ";
        $strSqlProdutosManutencao20Select .= "WHERE id <> 0 ";
        $strSqlProdutosManutencao20Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlProdutosManutencao20Select .= "ORDER BY " . $GLOBALS['configClassificacaoProdutos'] . " ";
        $strSqlProdutosManutencao20Select .= "ORDER BY complemento";
        
        $statementProdutosManutencao20Select = $dbSistemaConPDO->prepare($strSqlProdutosManutencao20Select);
        
        if ($statementProdutosManutencao20Select !== false)
        {
            $statementProdutosManutencao20Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoProdutosManutencao20 = $dbSistemaConPDO->query($strSqlProdutosManutencao20Select);
        $resultadoProdutosManutencao20 = $statementProdutosManutencao20Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico09Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoProdutosManutencao20))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formProdutosManutencao20Acoes" id="formProdutosManutencao20Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_produtos_complemento" />
            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            
            <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            <div style="position:relative; display: block; clear: both;">
                <div align="right" style="float: right;">
                    <input type="image" name="submit" value="Submit" src="img/btoExcluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoExcluir"); ?>">
                </div>
            </div>
        
            <table width="100%" class="TabelaDados01">
              <tr class="TbFundoEscuro">
                <td width="50" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemId"); ?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico09Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemExcluir"); ?>
                    </div>
                </td>
              </tr>
              <?php
                //Loop pelos resultados.
                foreach($resultadoProdutosManutencao20 as $linhaProdutosManutencao20)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaProdutosManutencao20['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosManutencao20['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="ProdutosManutencaoEditar.php?idTbProdutosComplemento=<?php echo $linhaProdutosManutencao20['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaProdutosManutencao20['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formProdutosManutencao20" id="formProdutosManutencao20" action="ProdutosManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico09Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico09Nome'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div align="left">
                            <input type="text" name="complemento" id="complemento" class="CampoTexto01" maxlength="255" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaProdutosManutencaoDescricao"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div>
                            <textarea name="descricao" id="descricao" class="CampoTextoMultilinha01"></textarea>
                        </div>
                    </td>
                </tr>
            </table>
            <div>
                <div style="float:left;">
                    <input type="image" name="submit" value="Submit" src="img/btoIncluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoIncluir"); ?>" />
                    <input name="tipo_complemento" type="hidden" id="tipo_complemento" value="<?php echo $tipoComplemento; ?>" />
                    
                    <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                </div>
                <div style="float:right;">
                    &nbsp;
                </div>
            </div>
        </form>
        <br />
        <br />
        <br />
        
        <?php 
        //Limpeza de objetos.
        //----------
        unset($strSqlProdutosManutencao20Select);
        unset($statementProdutosManutencao20Select);
        unset($resultadoProdutosManutencao20);
        unset($linhaProdutosManutencao20);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Produtos - Filtro Genérico 10.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarProdutosFiltroGenerico10'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 21;
		
        //Query de pesquisa.
        //----------
        $strSqlProdutosManutencao21Select = "";
        $strSqlProdutosManutencao21Select .= "SELECT ";
        $strSqlProdutosManutencao21Select .= "id, ";
        $strSqlProdutosManutencao21Select .= "tipo_complemento, ";
        $strSqlProdutosManutencao21Select .= "complemento, ";
        $strSqlProdutosManutencao21Select .= "descricao ";
        $strSqlProdutosManutencao21Select .= "FROM tb_produtos_complemento ";
        $strSqlProdutosManutencao21Select .= "WHERE id <> 0 ";
        $strSqlProdutosManutencao21Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlProdutosManutencao21Select .= "ORDER BY " . $GLOBALS['configClassificacaoProdutos'] . " ";
        $strSqlProdutosManutencao21Select .= "ORDER BY complemento";
        
        $statementProdutosManutencao21Select = $dbSistemaConPDO->prepare($strSqlProdutosManutencao21Select);
        
        if ($statementProdutosManutencao21Select !== false)
        {
            $statementProdutosManutencao21Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoProdutosManutencao21 = $dbSistemaConPDO->query($strSqlProdutosManutencao21Select);
        $resultadoProdutosManutencao21 = $statementProdutosManutencao21Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico10Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoProdutosManutencao21))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formProdutosManutencao21Acoes" id="formProdutosManutencao21Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_produtos_complemento" />
            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            
            <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            <div style="position:relative; display: block; clear: both;">
                <div align="right" style="float: right;">
                    <input type="image" name="submit" value="Submit" src="img/btoExcluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoExcluir"); ?>">
                </div>
            </div>
        
            <table width="100%" class="TabelaDados01">
              <tr class="TbFundoEscuro">
                <td width="50" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemId"); ?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico10Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemExcluir"); ?>
                    </div>
                </td>
              </tr>
              <?php
                //Loop pelos resultados.
                foreach($resultadoProdutosManutencao21 as $linhaProdutosManutencao21)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaProdutosManutencao21['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosManutencao21['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="ProdutosManutencaoEditar.php?idTbProdutosComplemento=<?php echo $linhaProdutosManutencao21['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaProdutosManutencao21['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formProdutosManutencao21" id="formProdutosManutencao21" action="ProdutosManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico10Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico10Nome'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div align="left">
                            <input type="text" name="complemento" id="complemento" class="CampoTexto01" maxlength="255" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaProdutosManutencaoDescricao"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div>
                            <textarea name="descricao" id="descricao" class="CampoTextoMultilinha01"></textarea>
                        </div>
                    </td>
                </tr>
            </table>
            <div>
                <div style="float:left;">
                    <input type="image" name="submit" value="Submit" src="img/btoIncluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoIncluir"); ?>" />
                    <input name="tipo_complemento" type="hidden" id="tipo_complemento" value="<?php echo $tipoComplemento; ?>" />
                    
                    <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                </div>
                <div style="float:right;">
                    &nbsp;
                </div>
            </div>
        </form>
        <br />
        <br />
        <br />
        
        <?php 
        //Limpeza de objetos.
        //----------
        unset($strSqlProdutosManutencao21Select);
        unset($statementProdutosManutencao21Select);
        unset($resultadoProdutosManutencao21);
        unset($linhaProdutosManutencao21);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>
    
    
	<?php //Produtos - Filtro Genérico 11.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarProdutosFiltroGenerico11'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 22;
		
        //Query de pesquisa.
        //----------
        $strSqlProdutosManutencao22Select = "";
        $strSqlProdutosManutencao22Select .= "SELECT ";
        $strSqlProdutosManutencao22Select .= "id, ";
        $strSqlProdutosManutencao22Select .= "tipo_complemento, ";
        $strSqlProdutosManutencao22Select .= "complemento, ";
        $strSqlProdutosManutencao22Select .= "descricao ";
        $strSqlProdutosManutencao22Select .= "FROM tb_produtos_complemento ";
        $strSqlProdutosManutencao22Select .= "WHERE id <> 0 ";
        $strSqlProdutosManutencao22Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlProdutosManutencao22Select .= "ORDER BY " . $GLOBALS['configClassificacaoProdutos'] . " ";
        $strSqlProdutosManutencao22Select .= "ORDER BY complemento";
        
        $statementProdutosManutencao22Select = $dbSistemaConPDO->prepare($strSqlProdutosManutencao22Select);
        
        if ($statementProdutosManutencao22Select !== false)
        {
            $statementProdutosManutencao22Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoProdutosManutencao22 = $dbSistemaConPDO->query($strSqlProdutosManutencao22Select);
        $resultadoProdutosManutencao22 = $statementProdutosManutencao22Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico11Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoProdutosManutencao22))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formProdutosManutencao22Acoes" id="formProdutosManutencao22Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_produtos_complemento" />
            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            
            <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            <div style="position:relative; display: block; clear: both;">
                <div align="right" style="float: right;">
                    <input type="image" name="submit" value="Submit" src="img/btoExcluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoExcluir"); ?>">
                </div>
            </div>
        
            <table width="100%" class="TabelaDados01">
              <tr class="TbFundoEscuro">
                <td width="50" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemId"); ?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico11Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemExcluir"); ?>
                    </div>
                </td>
              </tr>
              <?php
                //Loop pelos resultados.
                foreach($resultadoProdutosManutencao22 as $linhaProdutosManutencao22)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaProdutosManutencao22['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosManutencao22['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="ProdutosManutencaoEditar.php?idTbProdutosComplemento=<?php echo $linhaProdutosManutencao22['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaProdutosManutencao22['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formProdutosManutencao22" id="formProdutosManutencao22" action="ProdutosManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico11Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico11Nome'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div align="left">
                            <input type="text" name="complemento" id="complemento" class="CampoTexto01" maxlength="255" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaProdutosManutencaoDescricao"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div>
                            <textarea name="descricao" id="descricao" class="CampoTextoMultilinha01"></textarea>
                        </div>
                    </td>
                </tr>
            </table>
            <div>
                <div style="float:left;">
                    <input type="image" name="submit" value="Submit" src="img/btoIncluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoIncluir"); ?>" />
                    <input name="tipo_complemento" type="hidden" id="tipo_complemento" value="<?php echo $tipoComplemento; ?>" />
                    
                    <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                </div>
                <div style="float:right;">
                    &nbsp;
                </div>
            </div>
        </form>
        <br />
        <br />
        <br />
        
        <?php 
        //Limpeza de objetos.
        //----------
        unset($strSqlProdutosManutencao22Select);
        unset($statementProdutosManutencao22Select);
        unset($resultadoProdutosManutencao22);
        unset($linhaProdutosManutencao22);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Produtos - Filtro Genérico 12.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarProdutosFiltroGenerico12'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 23;
		
        //Query de pesquisa.
        //----------
        $strSqlProdutosManutencao23Select = "";
        $strSqlProdutosManutencao23Select .= "SELECT ";
        $strSqlProdutosManutencao23Select .= "id, ";
        $strSqlProdutosManutencao23Select .= "tipo_complemento, ";
        $strSqlProdutosManutencao23Select .= "complemento, ";
        $strSqlProdutosManutencao23Select .= "descricao ";
        $strSqlProdutosManutencao23Select .= "FROM tb_produtos_complemento ";
        $strSqlProdutosManutencao23Select .= "WHERE id <> 0 ";
        $strSqlProdutosManutencao23Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlProdutosManutencao23Select .= "ORDER BY " . $GLOBALS['configClassificacaoProdutos'] . " ";
        $strSqlProdutosManutencao23Select .= "ORDER BY complemento";
        
        $statementProdutosManutencao23Select = $dbSistemaConPDO->prepare($strSqlProdutosManutencao23Select);
        
        if ($statementProdutosManutencao23Select !== false)
        {
            $statementProdutosManutencao23Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoProdutosManutencao23 = $dbSistemaConPDO->query($strSqlProdutosManutencao23Select);
        $resultadoProdutosManutencao23 = $statementProdutosManutencao23Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico12Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoProdutosManutencao23))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formProdutosManutencao23Acoes" id="formProdutosManutencao23Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_produtos_complemento" />
            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            
            <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            <div style="position:relative; display: block; clear: both;">
                <div align="right" style="float: right;">
                    <input type="image" name="submit" value="Submit" src="img/btoExcluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoExcluir"); ?>">
                </div>
            </div>
        
            <table width="100%" class="TabelaDados01">
              <tr class="TbFundoEscuro">
                <td width="50" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemId"); ?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico12Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemExcluir"); ?>
                    </div>
                </td>
              </tr>
              <?php
                //Loop pelos resultados.
                foreach($resultadoProdutosManutencao23 as $linhaProdutosManutencao23)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaProdutosManutencao23['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosManutencao23['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="ProdutosManutencaoEditar.php?idTbProdutosComplemento=<?php echo $linhaProdutosManutencao23['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaProdutosManutencao23['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formProdutosManutencao23" id="formProdutosManutencao23" action="ProdutosManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico12Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico12Nome'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div align="left">
                            <input type="text" name="complemento" id="complemento" class="CampoTexto01" maxlength="255" />
                        </div>
                    </td>

                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaProdutosManutencaoDescricao"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div>
                            <textarea name="descricao" id="descricao" class="CampoTextoMultilinha01"></textarea>
                        </div>
                    </td>
                </tr>
            </table>
            <div>
                <div style="float:left;">
                    <input type="image" name="submit" value="Submit" src="img/btoIncluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoIncluir"); ?>" />
                    <input name="tipo_complemento" type="hidden" id="tipo_complemento" value="<?php echo $tipoComplemento; ?>" />
                    
                    <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                </div>
                <div style="float:right;">
                    &nbsp;
                </div>
            </div>
        </form>
        <br />
        <br />
        <br />
        
        <?php 
        //Limpeza de objetos.
        //----------
        unset($strSqlProdutosManutencao23Select);
        unset($statementProdutosManutencao23Select);
        unset($resultadoProdutosManutencao23);
        unset($linhaProdutosManutencao23);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Produtos - Filtro Genérico 13.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarProdutosFiltroGenerico13'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 24;
		
        //Query de pesquisa.
        //----------
        $strSqlProdutosManutencao24Select = "";
        $strSqlProdutosManutencao24Select .= "SELECT ";
        $strSqlProdutosManutencao24Select .= "id, ";
        $strSqlProdutosManutencao24Select .= "tipo_complemento, ";
        $strSqlProdutosManutencao24Select .= "complemento, ";
        $strSqlProdutosManutencao24Select .= "descricao ";
        $strSqlProdutosManutencao24Select .= "FROM tb_produtos_complemento ";
        $strSqlProdutosManutencao24Select .= "WHERE id <> 0 ";
        $strSqlProdutosManutencao24Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlProdutosManutencao24Select .= "ORDER BY " . $GLOBALS['configClassificacaoProdutos'] . " ";
        $strSqlProdutosManutencao24Select .= "ORDER BY complemento";
        
        $statementProdutosManutencao24Select = $dbSistemaConPDO->prepare($strSqlProdutosManutencao24Select);
        
        if ($statementProdutosManutencao24Select !== false)
        {
            $statementProdutosManutencao24Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoProdutosManutencao24 = $dbSistemaConPDO->query($strSqlProdutosManutencao24Select);
        $resultadoProdutosManutencao24 = $statementProdutosManutencao24Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico13Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoProdutosManutencao24))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formProdutosManutencao24Acoes" id="formProdutosManutencao24Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_produtos_complemento" />
            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            
            <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            <div style="position:relative; display: block; clear: both;">
                <div align="right" style="float: right;">
                    <input type="image" name="submit" value="Submit" src="img/btoExcluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoExcluir"); ?>">
                </div>
            </div>
        
            <table width="100%" class="TabelaDados01">
              <tr class="TbFundoEscuro">
                <td width="50" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemId"); ?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico13Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemExcluir"); ?>
                    </div>
                </td>
              </tr>
              <?php
                //Loop pelos resultados.
                foreach($resultadoProdutosManutencao24 as $linhaProdutosManutencao24)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaProdutosManutencao24['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosManutencao24['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="ProdutosManutencaoEditar.php?idTbProdutosComplemento=<?php echo $linhaProdutosManutencao24['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaProdutosManutencao24['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formProdutosManutencao24" id="formProdutosManutencao24" action="ProdutosManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico13Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico13Nome'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div align="left">
                            <input type="text" name="complemento" id="complemento" class="CampoTexto01" maxlength="255" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaProdutosManutencaoDescricao"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div>
                            <textarea name="descricao" id="descricao" class="CampoTextoMultilinha01"></textarea>
                        </div>
                    </td>
                </tr>
            </table>
            <div>
                <div style="float:left;">
                    <input type="image" name="submit" value="Submit" src="img/btoIncluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoIncluir"); ?>" />
                    <input name="tipo_complemento" type="hidden" id="tipo_complemento" value="<?php echo $tipoComplemento; ?>" />
                    
                    <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                </div>
                <div style="float:right;">
                    &nbsp;
                </div>
            </div>
        </form>
        <br />
        <br />
        <br />
        
        <?php 
        //Limpeza de objetos.
        //----------
        unset($strSqlProdutosManutencao24Select);
        unset($statementProdutosManutencao24Select);
        unset($resultadoProdutosManutencao24);
        unset($linhaProdutosManutencao24);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Produtos - Filtro Genérico 14.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarProdutosFiltroGenerico14'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 25;
		
        //Query de pesquisa.
        //----------
        $strSqlProdutosManutencao25Select = "";
        $strSqlProdutosManutencao25Select .= "SELECT ";
        $strSqlProdutosManutencao25Select .= "id, ";
        $strSqlProdutosManutencao25Select .= "tipo_complemento, ";
        $strSqlProdutosManutencao25Select .= "complemento, ";
        $strSqlProdutosManutencao25Select .= "descricao ";
        $strSqlProdutosManutencao25Select .= "FROM tb_produtos_complemento ";
        $strSqlProdutosManutencao25Select .= "WHERE id <> 0 ";
        $strSqlProdutosManutencao25Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlProdutosManutencao25Select .= "ORDER BY " . $GLOBALS['configClassificacaoProdutos'] . " ";
        $strSqlProdutosManutencao25Select .= "ORDER BY complemento";
        
        $statementProdutosManutencao25Select = $dbSistemaConPDO->prepare($strSqlProdutosManutencao25Select);
        
        if ($statementProdutosManutencao25Select !== false)
        {
            $statementProdutosManutencao25Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoProdutosManutencao25 = $dbSistemaConPDO->query($strSqlProdutosManutencao25Select);
        $resultadoProdutosManutencao25 = $statementProdutosManutencao25Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico14Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoProdutosManutencao25))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formProdutosManutencao25Acoes" id="formProdutosManutencao25Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_produtos_complemento" />
            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            
            <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            <div style="position:relative; display: block; clear: both;">
                <div align="right" style="float: right;">
                    <input type="image" name="submit" value="Submit" src="img/btoExcluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoExcluir"); ?>">
                </div>
            </div>
        
            <table width="100%" class="TabelaDados01">
              <tr class="TbFundoEscuro">
                <td width="50" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemId"); ?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico14Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemExcluir"); ?>
                    </div>
                </td>
              </tr>
              <?php
                //Loop pelos resultados.
                foreach($resultadoProdutosManutencao25 as $linhaProdutosManutencao25)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaProdutosManutencao25['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosManutencao25['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="ProdutosManutencaoEditar.php?idTbProdutosComplemento=<?php echo $linhaProdutosManutencao25['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaProdutosManutencao25['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formProdutosManutencao25" id="formProdutosManutencao25" action="ProdutosManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico14Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico14Nome'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div align="left">
                            <input type="text" name="complemento" id="complemento" class="CampoTexto01" maxlength="255" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaProdutosManutencaoDescricao"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div>
                            <textarea name="descricao" id="descricao" class="CampoTextoMultilinha01"></textarea>
                        </div>
                    </td>
                </tr>
            </table>
            <div>
                <div style="float:left;">
                    <input type="image" name="submit" value="Submit" src="img/btoIncluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoIncluir"); ?>" />
                    <input name="tipo_complemento" type="hidden" id="tipo_complemento" value="<?php echo $tipoComplemento; ?>" />
                    
                    <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                </div>
                <div style="float:right;">
                    &nbsp;
                </div>
            </div>
        </form>
        <br />
        <br />
        <br />
        
        <?php 
        //Limpeza de objetos.
        //----------
        unset($strSqlProdutosManutencao25Select);
        unset($statementProdutosManutencao25Select);
        unset($resultadoProdutosManutencao25);
        unset($linhaProdutosManutencao25);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Produtos - Filtro Genérico 15.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarProdutosFiltroGenerico15'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 26;
		
        //Query de pesquisa.
        //----------
        $strSqlProdutosManutencao26Select = "";
        $strSqlProdutosManutencao26Select .= "SELECT ";
        $strSqlProdutosManutencao26Select .= "id, ";
        $strSqlProdutosManutencao26Select .= "tipo_complemento, ";
        $strSqlProdutosManutencao26Select .= "complemento, ";
        $strSqlProdutosManutencao26Select .= "descricao ";
        $strSqlProdutosManutencao26Select .= "FROM tb_produtos_complemento ";
        $strSqlProdutosManutencao26Select .= "WHERE id <> 0 ";
        $strSqlProdutosManutencao26Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlProdutosManutencao26Select .= "ORDER BY " . $GLOBALS['configClassificacaoProdutos'] . " ";
        $strSqlProdutosManutencao26Select .= "ORDER BY complemento";
        
        $statementProdutosManutencao26Select = $dbSistemaConPDO->prepare($strSqlProdutosManutencao26Select);
        
        if ($statementProdutosManutencao26Select !== false)
        {
            $statementProdutosManutencao26Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoProdutosManutencao26 = $dbSistemaConPDO->query($strSqlProdutosManutencao26Select);
        $resultadoProdutosManutencao26 = $statementProdutosManutencao26Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico15Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoProdutosManutencao26))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formProdutosManutencao26Acoes" id="formProdutosManutencao26Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_produtos_complemento" />
            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            
            <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            <div style="position:relative; display: block; clear: both;">
                <div align="right" style="float: right;">
                    <input type="image" name="submit" value="Submit" src="img/btoExcluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoExcluir"); ?>">
                </div>
            </div>
        
            <table width="100%" class="TabelaDados01">
              <tr class="TbFundoEscuro">
                <td width="50" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemId"); ?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico15Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemExcluir"); ?>
                    </div>
                </td>
              </tr>
              <?php
                //Loop pelos resultados.
                foreach($resultadoProdutosManutencao26 as $linhaProdutosManutencao26)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaProdutosManutencao26['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosManutencao26['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="ProdutosManutencaoEditar.php?idTbProdutosComplemento=<?php echo $linhaProdutosManutencao26['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaProdutosManutencao26['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formProdutosManutencao26" id="formProdutosManutencao26" action="ProdutosManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico15Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico15Nome'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div align="left">
                            <input type="text" name="complemento" id="complemento" class="CampoTexto01" maxlength="255" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaProdutosManutencaoDescricao"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div>
                            <textarea name="descricao" id="descricao" class="CampoTextoMultilinha01"></textarea>
                        </div>
                    </td>
                </tr>
            </table>
            <div>
                <div style="float:left;">
                    <input type="image" name="submit" value="Submit" src="img/btoIncluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoIncluir"); ?>" />
                    <input name="tipo_complemento" type="hidden" id="tipo_complemento" value="<?php echo $tipoComplemento; ?>" />
                    
                    <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                </div>
                <div style="float:right;">
                    &nbsp;
                </div>
            </div>
        </form>
        <br />
        <br />
        <br />
        
        <?php 
        //Limpeza de objetos.
        //----------
        unset($strSqlProdutosManutencao26Select);
        unset($statementProdutosManutencao26Select);
        unset($resultadoProdutosManutencao26);
        unset($linhaProdutosManutencao26);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Produtos - Filtro Genérico 16.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarProdutosFiltroGenerico16'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 27;
		
        //Query de pesquisa.
        //----------
        $strSqlProdutosManutencao27Select = "";
        $strSqlProdutosManutencao27Select .= "SELECT ";
        $strSqlProdutosManutencao27Select .= "id, ";
        $strSqlProdutosManutencao27Select .= "tipo_complemento, ";
        $strSqlProdutosManutencao27Select .= "complemento, ";
        $strSqlProdutosManutencao27Select .= "descricao ";
        $strSqlProdutosManutencao27Select .= "FROM tb_produtos_complemento ";
        $strSqlProdutosManutencao27Select .= "WHERE id <> 0 ";
        $strSqlProdutosManutencao27Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlProdutosManutencao27Select .= "ORDER BY " . $GLOBALS['configClassificacaoProdutos'] . " ";
        $strSqlProdutosManutencao27Select .= "ORDER BY complemento";
        
        $statementProdutosManutencao27Select = $dbSistemaConPDO->prepare($strSqlProdutosManutencao27Select);
        
        if ($statementProdutosManutencao27Select !== false)
        {
            $statementProdutosManutencao27Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoProdutosManutencao27 = $dbSistemaConPDO->query($strSqlProdutosManutencao27Select);
        $resultadoProdutosManutencao27 = $statementProdutosManutencao27Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico16Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoProdutosManutencao27))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formProdutosManutencao27Acoes" id="formProdutosManutencao27Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_produtos_complemento" />
            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            
            <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            <div style="position:relative; display: block; clear: both;">
                <div align="right" style="float: right;">
                    <input type="image" name="submit" value="Submit" src="img/btoExcluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoExcluir"); ?>">
                </div>
            </div>
        
            <table width="100%" class="TabelaDados01">
              <tr class="TbFundoEscuro">
                <td width="50" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemId"); ?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico16Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemExcluir"); ?>
                    </div>
                </td>
              </tr>
              <?php
                //Loop pelos resultados.
                foreach($resultadoProdutosManutencao27 as $linhaProdutosManutencao27)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaProdutosManutencao27['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosManutencao27['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="ProdutosManutencaoEditar.php?idTbProdutosComplemento=<?php echo $linhaProdutosManutencao27['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaProdutosManutencao27['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formProdutosManutencao27" id="formProdutosManutencao27" action="ProdutosManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico16Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico16Nome'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div align="left">
                            <input type="text" name="complemento" id="complemento" class="CampoTexto01" maxlength="255" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaProdutosManutencaoDescricao"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div>
                            <textarea name="descricao" id="descricao" class="CampoTextoMultilinha01"></textarea>
                        </div>
                    </td>
                </tr>
            </table>
            <div>
                <div style="float:left;">
                    <input type="image" name="submit" value="Submit" src="img/btoIncluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoIncluir"); ?>" />
                    <input name="tipo_complemento" type="hidden" id="tipo_complemento" value="<?php echo $tipoComplemento; ?>" />
                    
                    <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                </div>
                <div style="float:right;">
                    &nbsp;
                </div>
            </div>
        </form>
        <br />
        <br />
        <br />
        
        <?php 
        //Limpeza de objetos.
        //----------
        unset($strSqlProdutosManutencao27Select);
        unset($statementProdutosManutencao27Select);
        unset($resultadoProdutosManutencao27);
        unset($linhaProdutosManutencao27);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Produtos - Filtro Genérico 17.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarProdutosFiltroGenerico17'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 28;
		
        //Query de pesquisa.
        //----------
        $strSqlProdutosManutencao28Select = "";
        $strSqlProdutosManutencao28Select .= "SELECT ";
        $strSqlProdutosManutencao28Select .= "id, ";
        $strSqlProdutosManutencao28Select .= "tipo_complemento, ";
        $strSqlProdutosManutencao28Select .= "complemento, ";
        $strSqlProdutosManutencao28Select .= "descricao ";
        $strSqlProdutosManutencao28Select .= "FROM tb_produtos_complemento ";
        $strSqlProdutosManutencao28Select .= "WHERE id <> 0 ";
        $strSqlProdutosManutencao28Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlProdutosManutencao28Select .= "ORDER BY " . $GLOBALS['configClassificacaoProdutos'] . " ";
        $strSqlProdutosManutencao28Select .= "ORDER BY complemento";
        
        $statementProdutosManutencao28Select = $dbSistemaConPDO->prepare($strSqlProdutosManutencao28Select);
        
        if ($statementProdutosManutencao28Select !== false)
        {
            $statementProdutosManutencao28Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoProdutosManutencao28 = $dbSistemaConPDO->query($strSqlProdutosManutencao28Select);
        $resultadoProdutosManutencao28 = $statementProdutosManutencao28Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico17Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoProdutosManutencao28))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formProdutosManutencao28Acoes" id="formProdutosManutencao28Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_produtos_complemento" />
            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            
            <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            <div style="position:relative; display: block; clear: both;">
                <div align="right" style="float: right;">
                    <input type="image" name="submit" value="Submit" src="img/btoExcluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoExcluir"); ?>">
                </div>
            </div>
        
            <table width="100%" class="TabelaDados01">
              <tr class="TbFundoEscuro">
                <td width="50" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemId"); ?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico17Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemExcluir"); ?>
                    </div>
                </td>
              </tr>
              <?php
                //Loop pelos resultados.
                foreach($resultadoProdutosManutencao28 as $linhaProdutosManutencao28)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaProdutosManutencao28['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosManutencao28['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="ProdutosManutencaoEditar.php?idTbProdutosComplemento=<?php echo $linhaProdutosManutencao28['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaProdutosManutencao28['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formProdutosManutencao28" id="formProdutosManutencao28" action="ProdutosManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico17Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico17Nome'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div align="left">
                            <input type="text" name="complemento" id="complemento" class="CampoTexto01" maxlength="255" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaProdutosManutencaoDescricao"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div>
                            <textarea name="descricao" id="descricao" class="CampoTextoMultilinha01"></textarea>
                        </div>
                    </td>
                </tr>
            </table>

            <div>
                <div style="float:left;">
                    <input type="image" name="submit" value="Submit" src="img/btoIncluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoIncluir"); ?>" />
                    <input name="tipo_complemento" type="hidden" id="tipo_complemento" value="<?php echo $tipoComplemento; ?>" />
                    
                    <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                </div>
                <div style="float:right;">
                    &nbsp;
                </div>
            </div>
        </form>
        <br />
        <br />
        <br />
        
        <?php 
        //Limpeza de objetos.
        //----------
        unset($strSqlProdutosManutencao28Select);
        unset($statementProdutosManutencao28Select);
        unset($resultadoProdutosManutencao28);
        unset($linhaProdutosManutencao28);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Produtos - Filtro Genérico 18.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarProdutosFiltroGenerico18'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 29;
		
        //Query de pesquisa.
        //----------
        $strSqlProdutosManutencao29Select = "";
        $strSqlProdutosManutencao29Select .= "SELECT ";
        $strSqlProdutosManutencao29Select .= "id, ";
        $strSqlProdutosManutencao29Select .= "tipo_complemento, ";
        $strSqlProdutosManutencao29Select .= "complemento, ";
        $strSqlProdutosManutencao29Select .= "descricao ";
        $strSqlProdutosManutencao29Select .= "FROM tb_produtos_complemento ";
        $strSqlProdutosManutencao29Select .= "WHERE id <> 0 ";
        $strSqlProdutosManutencao29Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlProdutosManutencao29Select .= "ORDER BY " . $GLOBALS['configClassificacaoProdutos'] . " ";
        $strSqlProdutosManutencao29Select .= "ORDER BY complemento";
        
        $statementProdutosManutencao29Select = $dbSistemaConPDO->prepare($strSqlProdutosManutencao29Select);
        
        if ($statementProdutosManutencao29Select !== false)
        {
            $statementProdutosManutencao29Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoProdutosManutencao29 = $dbSistemaConPDO->query($strSqlProdutosManutencao29Select);
        $resultadoProdutosManutencao29 = $statementProdutosManutencao29Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico18Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoProdutosManutencao29))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formProdutosManutencao29Acoes" id="formProdutosManutencao29Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_produtos_complemento" />
            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            
            <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            <div style="position:relative; display: block; clear: both;">
                <div align="right" style="float: right;">
                    <input type="image" name="submit" value="Submit" src="img/btoExcluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoExcluir"); ?>">
                </div>
            </div>
        
            <table width="100%" class="TabelaDados01">
              <tr class="TbFundoEscuro">
                <td width="50" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemId"); ?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico18Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemExcluir"); ?>
                    </div>
                </td>
              </tr>
              <?php
                //Loop pelos resultados.
                foreach($resultadoProdutosManutencao29 as $linhaProdutosManutencao29)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaProdutosManutencao29['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosManutencao29['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="ProdutosManutencaoEditar.php?idTbProdutosComplemento=<?php echo $linhaProdutosManutencao29['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaProdutosManutencao29['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formProdutosManutencao29" id="formProdutosManutencao29" action="ProdutosManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico18Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico18Nome'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div align="left">
                            <input type="text" name="complemento" id="complemento" class="CampoTexto01" maxlength="255" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaProdutosManutencaoDescricao"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div>
                            <textarea name="descricao" id="descricao" class="CampoTextoMultilinha01"></textarea>
                        </div>
                    </td>
                </tr>
            </table>
            <div>
                <div style="float:left;">
                    <input type="image" name="submit" value="Submit" src="img/btoIncluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoIncluir"); ?>" />
                    <input name="tipo_complemento" type="hidden" id="tipo_complemento" value="<?php echo $tipoComplemento; ?>" />
                    
                    <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                </div>
                <div style="float:right;">
                    &nbsp;
                </div>
            </div>
        </form>
        <br />
        <br />
        <br />
        
        <?php 
        //Limpeza de objetos.
        //----------
        unset($strSqlProdutosManutencao29Select);
        unset($statementProdutosManutencao29Select);
        unset($resultadoProdutosManutencao29);
        unset($linhaProdutosManutencao29);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Produtos - Filtro Genérico 19.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarProdutosFiltroGenerico19'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 30;
		
        //Query de pesquisa.
        //----------
        $strSqlProdutosManutencao20Select = "";
        $strSqlProdutosManutencao20Select .= "SELECT ";
        $strSqlProdutosManutencao20Select .= "id, ";
        $strSqlProdutosManutencao20Select .= "tipo_complemento, ";
        $strSqlProdutosManutencao20Select .= "complemento, ";
        $strSqlProdutosManutencao20Select .= "descricao ";
        $strSqlProdutosManutencao20Select .= "FROM tb_produtos_complemento ";
        $strSqlProdutosManutencao20Select .= "WHERE id <> 0 ";
        $strSqlProdutosManutencao20Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlProdutosManutencao20Select .= "ORDER BY " . $GLOBALS['configClassificacaoProdutos'] . " ";
        $strSqlProdutosManutencao20Select .= "ORDER BY complemento";
        
        $statementProdutosManutencao20Select = $dbSistemaConPDO->prepare($strSqlProdutosManutencao20Select);
        
        if ($statementProdutosManutencao20Select !== false)
        {
            $statementProdutosManutencao20Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoProdutosManutencao20 = $dbSistemaConPDO->query($strSqlProdutosManutencao20Select);
        $resultadoProdutosManutencao20 = $statementProdutosManutencao20Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico19Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoProdutosManutencao20))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formProdutosManutencao20Acoes" id="formProdutosManutencao20Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_produtos_complemento" />
            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            
            <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            <div style="position:relative; display: block; clear: both;">
                <div align="right" style="float: right;">
                    <input type="image" name="submit" value="Submit" src="img/btoExcluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoExcluir"); ?>">
                </div>
            </div>
        
            <table width="100%" class="TabelaDados01">
              <tr class="TbFundoEscuro">
                <td width="50" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemId"); ?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico19Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemExcluir"); ?>
                    </div>
                </td>
              </tr>
              <?php
                //Loop pelos resultados.
                foreach($resultadoProdutosManutencao20 as $linhaProdutosManutencao20)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaProdutosManutencao20['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosManutencao20['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="ProdutosManutencaoEditar.php?idTbProdutosComplemento=<?php echo $linhaProdutosManutencao20['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaProdutosManutencao20['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formProdutosManutencao20" id="formProdutosManutencao20" action="ProdutosManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico19Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico19Nome'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div align="left">
                            <input type="text" name="complemento" id="complemento" class="CampoTexto01" maxlength="255" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaProdutosManutencaoDescricao"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div>
                            <textarea name="descricao" id="descricao" class="CampoTextoMultilinha01"></textarea>
                        </div>
                    </td>
                </tr>
            </table>
            <div>
                <div style="float:left;">
                    <input type="image" name="submit" value="Submit" src="img/btoIncluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoIncluir"); ?>" />
                    <input name="tipo_complemento" type="hidden" id="tipo_complemento" value="<?php echo $tipoComplemento; ?>" />
                    
                    <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                </div>
                <div style="float:right;">
                    &nbsp;
                </div>
            </div>
        </form>
        <br />
        <br />
        <br />
        
        <?php 
        //Limpeza de objetos.
        //----------
        unset($strSqlProdutosManutencao20Select);
        unset($statementProdutosManutencao20Select);
        unset($resultadoProdutosManutencao20);
        unset($linhaProdutosManutencao20);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Produtos - Filtro Genérico 20.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarProdutosFiltroGenerico20'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 31;
		
        //Query de pesquisa.
        //----------
        $strSqlProdutosManutencao31Select = "";
        $strSqlProdutosManutencao31Select .= "SELECT ";
        $strSqlProdutosManutencao31Select .= "id, ";
        $strSqlProdutosManutencao31Select .= "tipo_complemento, ";
        $strSqlProdutosManutencao31Select .= "complemento, ";
        $strSqlProdutosManutencao31Select .= "descricao ";
        $strSqlProdutosManutencao31Select .= "FROM tb_produtos_complemento ";
        $strSqlProdutosManutencao31Select .= "WHERE id <> 0 ";
        $strSqlProdutosManutencao31Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlProdutosManutencao31Select .= "ORDER BY " . $GLOBALS['configClassificacaoProdutos'] . " ";
        $strSqlProdutosManutencao31Select .= "ORDER BY complemento";
        
        $statementProdutosManutencao31Select = $dbSistemaConPDO->prepare($strSqlProdutosManutencao31Select);
        
        if ($statementProdutosManutencao31Select !== false)
        {
            $statementProdutosManutencao31Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoProdutosManutencao31 = $dbSistemaConPDO->query($strSqlProdutosManutencao31Select);
        $resultadoProdutosManutencao31 = $statementProdutosManutencao31Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico20Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoProdutosManutencao31))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formProdutosManutencao31Acoes" id="formProdutosManutencao31Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_produtos_complemento" />
            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            
            <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            <div style="position:relative; display: block; clear: both;">
                <div align="right" style="float: right;">
                    <input type="image" name="submit" value="Submit" src="img/btoExcluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoExcluir"); ?>">
                </div>
            </div>
        
            <table width="100%" class="TabelaDados01">
              <tr class="TbFundoEscuro">
                <td width="50" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemId"); ?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico20Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemExcluir"); ?>
                    </div>
                </td>
              </tr>
              <?php
                //Loop pelos resultados.
                foreach($resultadoProdutosManutencao31 as $linhaProdutosManutencao31)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaProdutosManutencao31['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosManutencao31['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="ProdutosManutencaoEditar.php?idTbProdutosComplemento=<?php echo $linhaProdutosManutencao31['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaProdutosManutencao31['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formProdutosManutencao31" id="formProdutosManutencao31" action="ProdutosManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico20Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico20Nome'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div align="left">
                            <input type="text" name="complemento" id="complemento" class="CampoTexto01" maxlength="255" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaProdutosManutencaoDescricao"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div>
                            <textarea name="descricao" id="descricao" class="CampoTextoMultilinha01"></textarea>
                        </div>
                    </td>
                </tr>
            </table>
            <div>
                <div style="float:left;">
                    <input type="image" name="submit" value="Submit" src="img/btoIncluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoIncluir"); ?>" />
                    <input name="tipo_complemento" type="hidden" id="tipo_complemento" value="<?php echo $tipoComplemento; ?>" />
                    
                    <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                </div>
                <div style="float:right;">
                    &nbsp;
                </div>
            </div>
        </form>
        <br />
        <br />
        <br />
        
        <?php 
        //Limpeza de objetos.
        //----------
        unset($strSqlProdutosManutencao31Select);
        unset($statementProdutosManutencao31Select);
        unset($resultadoProdutosManutencao31);
        unset($linhaProdutosManutencao31);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>
    
    
	<?php //Produtos - Filtro Genérico 21.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarProdutosFiltroGenerico21'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 32;
		
        //Query de pesquisa.
        //----------
        $strSqlProdutosManutencao32Select = "";
        $strSqlProdutosManutencao32Select .= "SELECT ";
        $strSqlProdutosManutencao32Select .= "id, ";
        $strSqlProdutosManutencao32Select .= "tipo_complemento, ";
        $strSqlProdutosManutencao32Select .= "complemento, ";
        $strSqlProdutosManutencao32Select .= "descricao ";
        $strSqlProdutosManutencao32Select .= "FROM tb_produtos_complemento ";
        $strSqlProdutosManutencao32Select .= "WHERE id <> 0 ";
        $strSqlProdutosManutencao32Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlProdutosManutencao32Select .= "ORDER BY " . $GLOBALS['configClassificacaoProdutos'] . " ";
        $strSqlProdutosManutencao32Select .= "ORDER BY complemento";
        
        $statementProdutosManutencao32Select = $dbSistemaConPDO->prepare($strSqlProdutosManutencao32Select);
        
        if ($statementProdutosManutencao32Select !== false)
        {
            $statementProdutosManutencao32Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoProdutosManutencao32 = $dbSistemaConPDO->query($strSqlProdutosManutencao32Select);
        $resultadoProdutosManutencao32 = $statementProdutosManutencao32Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico21Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoProdutosManutencao32))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formProdutosManutencao32Acoes" id="formProdutosManutencao32Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_produtos_complemento" />
            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            
            <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            <div style="position:relative; display: block; clear: both;">
                <div align="right" style="float: right;">
                    <input type="image" name="submit" value="Submit" src="img/btoExcluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoExcluir"); ?>">
                </div>
            </div>
        
            <table width="100%" class="TabelaDados01">
              <tr class="TbFundoEscuro">
                <td width="50" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemId"); ?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico21Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemExcluir"); ?>
                    </div>
                </td>
              </tr>
              <?php
                //Loop pelos resultados.
                foreach($resultadoProdutosManutencao32 as $linhaProdutosManutencao32)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaProdutosManutencao32['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosManutencao32['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="ProdutosManutencaoEditar.php?idTbProdutosComplemento=<?php echo $linhaProdutosManutencao32['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaProdutosManutencao32['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formProdutosManutencao32" id="formProdutosManutencao32" action="ProdutosManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico21Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico21Nome'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div align="left">
                            <input type="text" name="complemento" id="complemento" class="CampoTexto01" maxlength="255" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaProdutosManutencaoDescricao"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div>
                            <textarea name="descricao" id="descricao" class="CampoTextoMultilinha01"></textarea>
                        </div>
                    </td>
                </tr>
            </table>
            <div>
                <div style="float:left;">
                    <input type="image" name="submit" value="Submit" src="img/btoIncluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoIncluir"); ?>" />
                    <input name="tipo_complemento" type="hidden" id="tipo_complemento" value="<?php echo $tipoComplemento; ?>" />
                    
                    <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                </div>
                <div style="float:right;">
                    &nbsp;
                </div>
            </div>
        </form>
        <br />
        <br />
        <br />
        
        <?php 
        //Limpeza de objetos.
        //----------
        unset($strSqlProdutosManutencao32Select);
        unset($statementProdutosManutencao32Select);
        unset($resultadoProdutosManutencao32);
        unset($linhaProdutosManutencao32);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Produtos - Filtro Genérico 22.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarProdutosFiltroGenerico22'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 33;
		
        //Query de pesquisa.
        //----------
        $strSqlProdutosManutencao33Select = "";
        $strSqlProdutosManutencao33Select .= "SELECT ";
        $strSqlProdutosManutencao33Select .= "id, ";
        $strSqlProdutosManutencao33Select .= "tipo_complemento, ";
        $strSqlProdutosManutencao33Select .= "complemento, ";
        $strSqlProdutosManutencao33Select .= "descricao ";
        $strSqlProdutosManutencao33Select .= "FROM tb_produtos_complemento ";
        $strSqlProdutosManutencao33Select .= "WHERE id <> 0 ";
        $strSqlProdutosManutencao33Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlProdutosManutencao33Select .= "ORDER BY " . $GLOBALS['configClassificacaoProdutos'] . " ";
        $strSqlProdutosManutencao33Select .= "ORDER BY complemento";
        
        $statementProdutosManutencao33Select = $dbSistemaConPDO->prepare($strSqlProdutosManutencao33Select);
        
        if ($statementProdutosManutencao33Select !== false)
        {
            $statementProdutosManutencao33Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoProdutosManutencao33 = $dbSistemaConPDO->query($strSqlProdutosManutencao33Select);
        $resultadoProdutosManutencao33 = $statementProdutosManutencao33Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico22Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoProdutosManutencao33))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formProdutosManutencao33Acoes" id="formProdutosManutencao33Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_produtos_complemento" />
            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            
            <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            <div style="position:relative; display: block; clear: both;">
                <div align="right" style="float: right;">
                    <input type="image" name="submit" value="Submit" src="img/btoExcluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoExcluir"); ?>">
                </div>
            </div>
        
            <table width="100%" class="TabelaDados01">
              <tr class="TbFundoEscuro">
                <td width="50" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemId"); ?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico22Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemExcluir"); ?>
                    </div>
                </td>
              </tr>
              <?php
                //Loop pelos resultados.
                foreach($resultadoProdutosManutencao33 as $linhaProdutosManutencao33)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaProdutosManutencao33['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosManutencao33['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="ProdutosManutencaoEditar.php?idTbProdutosComplemento=<?php echo $linhaProdutosManutencao33['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaProdutosManutencao33['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formProdutosManutencao33" id="formProdutosManutencao33" action="ProdutosManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico22Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico22Nome'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div align="left">
                            <input type="text" name="complemento" id="complemento" class="CampoTexto01" maxlength="255" />
                        </div>
                    </td>

                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaProdutosManutencaoDescricao"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div>
                            <textarea name="descricao" id="descricao" class="CampoTextoMultilinha01"></textarea>
                        </div>
                    </td>
                </tr>
            </table>
            <div>
                <div style="float:left;">
                    <input type="image" name="submit" value="Submit" src="img/btoIncluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoIncluir"); ?>" />
                    <input name="tipo_complemento" type="hidden" id="tipo_complemento" value="<?php echo $tipoComplemento; ?>" />
                    
                    <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                </div>
                <div style="float:right;">
                    &nbsp;
                </div>
            </div>
        </form>
        <br />
        <br />
        <br />
        
        <?php 
        //Limpeza de objetos.
        //----------
        unset($strSqlProdutosManutencao33Select);
        unset($statementProdutosManutencao33Select);
        unset($resultadoProdutosManutencao33);
        unset($linhaProdutosManutencao33);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Produtos - Filtro Genérico 23.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarProdutosFiltroGenerico23'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 34;
		
        //Query de pesquisa.
        //----------
        $strSqlProdutosManutencao34Select = "";
        $strSqlProdutosManutencao34Select .= "SELECT ";
        $strSqlProdutosManutencao34Select .= "id, ";
        $strSqlProdutosManutencao34Select .= "tipo_complemento, ";
        $strSqlProdutosManutencao34Select .= "complemento, ";
        $strSqlProdutosManutencao34Select .= "descricao ";
        $strSqlProdutosManutencao34Select .= "FROM tb_produtos_complemento ";
        $strSqlProdutosManutencao34Select .= "WHERE id <> 0 ";
        $strSqlProdutosManutencao34Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlProdutosManutencao34Select .= "ORDER BY " . $GLOBALS['configClassificacaoProdutos'] . " ";
        $strSqlProdutosManutencao34Select .= "ORDER BY complemento";
        
        $statementProdutosManutencao34Select = $dbSistemaConPDO->prepare($strSqlProdutosManutencao34Select);
        
        if ($statementProdutosManutencao34Select !== false)
        {
            $statementProdutosManutencao34Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoProdutosManutencao34 = $dbSistemaConPDO->query($strSqlProdutosManutencao34Select);
        $resultadoProdutosManutencao34 = $statementProdutosManutencao34Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico23Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoProdutosManutencao34))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formProdutosManutencao34Acoes" id="formProdutosManutencao34Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_produtos_complemento" />
            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            
            <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            <div style="position:relative; display: block; clear: both;">
                <div align="right" style="float: right;">
                    <input type="image" name="submit" value="Submit" src="img/btoExcluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoExcluir"); ?>">
                </div>
            </div>
        
            <table width="100%" class="TabelaDados01">
              <tr class="TbFundoEscuro">
                <td width="50" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemId"); ?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico23Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemExcluir"); ?>
                    </div>
                </td>
              </tr>
              <?php
                //Loop pelos resultados.
                foreach($resultadoProdutosManutencao34 as $linhaProdutosManutencao34)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaProdutosManutencao34['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosManutencao34['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="ProdutosManutencaoEditar.php?idTbProdutosComplemento=<?php echo $linhaProdutosManutencao34['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaProdutosManutencao34['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formProdutosManutencao34" id="formProdutosManutencao34" action="ProdutosManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico23Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico23Nome'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div align="left">
                            <input type="text" name="complemento" id="complemento" class="CampoTexto01" maxlength="255" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaProdutosManutencaoDescricao"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div>
                            <textarea name="descricao" id="descricao" class="CampoTextoMultilinha01"></textarea>
                        </div>
                    </td>
                </tr>
            </table>
            <div>
                <div style="float:left;">
                    <input type="image" name="submit" value="Submit" src="img/btoIncluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoIncluir"); ?>" />
                    <input name="tipo_complemento" type="hidden" id="tipo_complemento" value="<?php echo $tipoComplemento; ?>" />
                    
                    <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                </div>
                <div style="float:right;">
                    &nbsp;
                </div>
            </div>
        </form>
        <br />
        <br />
        <br />
        
        <?php 
        //Limpeza de objetos.
        //----------
        unset($strSqlProdutosManutencao34Select);
        unset($statementProdutosManutencao34Select);
        unset($resultadoProdutosManutencao34);
        unset($linhaProdutosManutencao34);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Produtos - Filtro Genérico 24.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarProdutosFiltroGenerico24'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 35;
		
        //Query de pesquisa.
        //----------
        $strSqlProdutosManutencao35Select = "";
        $strSqlProdutosManutencao35Select .= "SELECT ";
        $strSqlProdutosManutencao35Select .= "id, ";
        $strSqlProdutosManutencao35Select .= "tipo_complemento, ";
        $strSqlProdutosManutencao35Select .= "complemento, ";
        $strSqlProdutosManutencao35Select .= "descricao ";
        $strSqlProdutosManutencao35Select .= "FROM tb_produtos_complemento ";
        $strSqlProdutosManutencao35Select .= "WHERE id <> 0 ";
        $strSqlProdutosManutencao35Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlProdutosManutencao35Select .= "ORDER BY " . $GLOBALS['configClassificacaoProdutos'] . " ";
        $strSqlProdutosManutencao35Select .= "ORDER BY complemento";
        
        $statementProdutosManutencao35Select = $dbSistemaConPDO->prepare($strSqlProdutosManutencao35Select);
        
        if ($statementProdutosManutencao35Select !== false)
        {
            $statementProdutosManutencao35Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoProdutosManutencao35 = $dbSistemaConPDO->query($strSqlProdutosManutencao35Select);
        $resultadoProdutosManutencao35 = $statementProdutosManutencao35Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico24Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoProdutosManutencao35))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formProdutosManutencao35Acoes" id="formProdutosManutencao35Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_produtos_complemento" />
            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            
            <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            <div style="position:relative; display: block; clear: both;">
                <div align="right" style="float: right;">
                    <input type="image" name="submit" value="Submit" src="img/btoExcluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoExcluir"); ?>">
                </div>
            </div>
        
            <table width="100%" class="TabelaDados01">
              <tr class="TbFundoEscuro">
                <td width="50" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemId"); ?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico24Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemExcluir"); ?>
                    </div>
                </td>
              </tr>
              <?php
                //Loop pelos resultados.
                foreach($resultadoProdutosManutencao35 as $linhaProdutosManutencao35)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaProdutosManutencao35['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosManutencao35['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="ProdutosManutencaoEditar.php?idTbProdutosComplemento=<?php echo $linhaProdutosManutencao35['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaProdutosManutencao35['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formProdutosManutencao35" id="formProdutosManutencao35" action="ProdutosManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico24Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico24Nome'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div align="left">
                            <input type="text" name="complemento" id="complemento" class="CampoTexto01" maxlength="255" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaProdutosManutencaoDescricao"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div>
                            <textarea name="descricao" id="descricao" class="CampoTextoMultilinha01"></textarea>
                        </div>
                    </td>
                </tr>
            </table>
            <div>
                <div style="float:left;">
                    <input type="image" name="submit" value="Submit" src="img/btoIncluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoIncluir"); ?>" />
                    <input name="tipo_complemento" type="hidden" id="tipo_complemento" value="<?php echo $tipoComplemento; ?>" />
                    
                    <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                </div>
                <div style="float:right;">
                    &nbsp;
                </div>
            </div>
        </form>
        <br />
        <br />
        <br />
        
        <?php 
        //Limpeza de objetos.
        //----------
        unset($strSqlProdutosManutencao35Select);
        unset($statementProdutosManutencao35Select);
        unset($resultadoProdutosManutencao35);
        unset($linhaProdutosManutencao35);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Produtos - Filtro Genérico 25.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarProdutosFiltroGenerico25'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 36;
		
        //Query de pesquisa.
        //----------
        $strSqlProdutosManutencao36Select = "";
        $strSqlProdutosManutencao36Select .= "SELECT ";
        $strSqlProdutosManutencao36Select .= "id, ";
        $strSqlProdutosManutencao36Select .= "tipo_complemento, ";
        $strSqlProdutosManutencao36Select .= "complemento, ";
        $strSqlProdutosManutencao36Select .= "descricao ";
        $strSqlProdutosManutencao36Select .= "FROM tb_produtos_complemento ";
        $strSqlProdutosManutencao36Select .= "WHERE id <> 0 ";
        $strSqlProdutosManutencao36Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlProdutosManutencao36Select .= "ORDER BY " . $GLOBALS['configClassificacaoProdutos'] . " ";
        $strSqlProdutosManutencao36Select .= "ORDER BY complemento";
        
        $statementProdutosManutencao36Select = $dbSistemaConPDO->prepare($strSqlProdutosManutencao36Select);
        
        if ($statementProdutosManutencao36Select !== false)
        {
            $statementProdutosManutencao36Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoProdutosManutencao36 = $dbSistemaConPDO->query($strSqlProdutosManutencao36Select);
        $resultadoProdutosManutencao36 = $statementProdutosManutencao36Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico25Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoProdutosManutencao36))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formProdutosManutencao36Acoes" id="formProdutosManutencao36Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_produtos_complemento" />
            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            
            <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            <div style="position:relative; display: block; clear: both;">
                <div align="right" style="float: right;">
                    <input type="image" name="submit" value="Submit" src="img/btoExcluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoExcluir"); ?>">
                </div>
            </div>
        
            <table width="100%" class="TabelaDados01">
              <tr class="TbFundoEscuro">
                <td width="50" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemId"); ?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico25Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemExcluir"); ?>
                    </div>
                </td>
              </tr>
              <?php
                //Loop pelos resultados.
                foreach($resultadoProdutosManutencao36 as $linhaProdutosManutencao36)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaProdutosManutencao36['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosManutencao36['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="ProdutosManutencaoEditar.php?idTbProdutosComplemento=<?php echo $linhaProdutosManutencao36['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaProdutosManutencao36['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formProdutosManutencao36" id="formProdutosManutencao36" action="ProdutosManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico25Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico25Nome'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div align="left">
                            <input type="text" name="complemento" id="complemento" class="CampoTexto01" maxlength="255" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaProdutosManutencaoDescricao"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div>
                            <textarea name="descricao" id="descricao" class="CampoTextoMultilinha01"></textarea>
                        </div>
                    </td>
                </tr>
            </table>
            <div>
                <div style="float:left;">
                    <input type="image" name="submit" value="Submit" src="img/btoIncluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoIncluir"); ?>" />
                    <input name="tipo_complemento" type="hidden" id="tipo_complemento" value="<?php echo $tipoComplemento; ?>" />
                    
                    <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                </div>
                <div style="float:right;">
                    &nbsp;
                </div>
            </div>
        </form>
        <br />
        <br />
        <br />
        
        <?php 
        //Limpeza de objetos.
        //----------
        unset($strSqlProdutosManutencao36Select);
        unset($statementProdutosManutencao36Select);
        unset($resultadoProdutosManutencao36);
        unset($linhaProdutosManutencao36);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Produtos - Filtro Genérico 26.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarProdutosFiltroGenerico26'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 37;
		
        //Query de pesquisa.
        //----------
        $strSqlProdutosManutencao37Select = "";
        $strSqlProdutosManutencao37Select .= "SELECT ";
        $strSqlProdutosManutencao37Select .= "id, ";
        $strSqlProdutosManutencao37Select .= "tipo_complemento, ";
        $strSqlProdutosManutencao37Select .= "complemento, ";
        $strSqlProdutosManutencao37Select .= "descricao ";
        $strSqlProdutosManutencao37Select .= "FROM tb_produtos_complemento ";
        $strSqlProdutosManutencao37Select .= "WHERE id <> 0 ";
        $strSqlProdutosManutencao37Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlProdutosManutencao37Select .= "ORDER BY " . $GLOBALS['configClassificacaoProdutos'] . " ";
        $strSqlProdutosManutencao37Select .= "ORDER BY complemento";
        
        $statementProdutosManutencao37Select = $dbSistemaConPDO->prepare($strSqlProdutosManutencao37Select);
        
        if ($statementProdutosManutencao37Select !== false)
        {
            $statementProdutosManutencao37Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoProdutosManutencao37 = $dbSistemaConPDO->query($strSqlProdutosManutencao37Select);
        $resultadoProdutosManutencao37 = $statementProdutosManutencao37Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico26Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoProdutosManutencao37))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formProdutosManutencao37Acoes" id="formProdutosManutencao37Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_produtos_complemento" />
            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            
            <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            <div style="position:relative; display: block; clear: both;">
                <div align="right" style="float: right;">
                    <input type="image" name="submit" value="Submit" src="img/btoExcluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoExcluir"); ?>">
                </div>
            </div>
        
            <table width="100%" class="TabelaDados01">
              <tr class="TbFundoEscuro">
                <td width="50" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemId"); ?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico26Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemExcluir"); ?>
                    </div>
                </td>
              </tr>
              <?php
                //Loop pelos resultados.
                foreach($resultadoProdutosManutencao37 as $linhaProdutosManutencao37)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaProdutosManutencao37['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosManutencao37['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="ProdutosManutencaoEditar.php?idTbProdutosComplemento=<?php echo $linhaProdutosManutencao37['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaProdutosManutencao37['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formProdutosManutencao37" id="formProdutosManutencao37" action="ProdutosManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico26Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico26Nome'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div align="left">
                            <input type="text" name="complemento" id="complemento" class="CampoTexto01" maxlength="255" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaProdutosManutencaoDescricao"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div>
                            <textarea name="descricao" id="descricao" class="CampoTextoMultilinha01"></textarea>
                        </div>
                    </td>
                </tr>
            </table>
            <div>
                <div style="float:left;">
                    <input type="image" name="submit" value="Submit" src="img/btoIncluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoIncluir"); ?>" />
                    <input name="tipo_complemento" type="hidden" id="tipo_complemento" value="<?php echo $tipoComplemento; ?>" />
                    
                    <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                </div>
                <div style="float:right;">
                    &nbsp;
                </div>
            </div>
        </form>
        <br />
        <br />
        <br />
        
        <?php 
        //Limpeza de objetos.
        //----------
        unset($strSqlProdutosManutencao37Select);
        unset($statementProdutosManutencao37Select);
        unset($resultadoProdutosManutencao37);
        unset($linhaProdutosManutencao37);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Produtos - Filtro Genérico 27.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarProdutosFiltroGenerico27'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 38;
		
        //Query de pesquisa.
        //----------
        $strSqlProdutosManutencao38Select = "";
        $strSqlProdutosManutencao38Select .= "SELECT ";
        $strSqlProdutosManutencao38Select .= "id, ";
        $strSqlProdutosManutencao38Select .= "tipo_complemento, ";
        $strSqlProdutosManutencao38Select .= "complemento, ";
        $strSqlProdutosManutencao38Select .= "descricao ";
        $strSqlProdutosManutencao38Select .= "FROM tb_produtos_complemento ";
        $strSqlProdutosManutencao38Select .= "WHERE id <> 0 ";
        $strSqlProdutosManutencao38Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlProdutosManutencao38Select .= "ORDER BY " . $GLOBALS['configClassificacaoProdutos'] . " ";
        $strSqlProdutosManutencao38Select .= "ORDER BY complemento";
        
        $statementProdutosManutencao38Select = $dbSistemaConPDO->prepare($strSqlProdutosManutencao38Select);
        
        if ($statementProdutosManutencao38Select !== false)
        {
            $statementProdutosManutencao38Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoProdutosManutencao38 = $dbSistemaConPDO->query($strSqlProdutosManutencao38Select);
        $resultadoProdutosManutencao38 = $statementProdutosManutencao38Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico27Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoProdutosManutencao38))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formProdutosManutencao38Acoes" id="formProdutosManutencao38Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_produtos_complemento" />
            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            
            <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            <div style="position:relative; display: block; clear: both;">
                <div align="right" style="float: right;">
                    <input type="image" name="submit" value="Submit" src="img/btoExcluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoExcluir"); ?>">
                </div>
            </div>
        
            <table width="100%" class="TabelaDados01">
              <tr class="TbFundoEscuro">
                <td width="50" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemId"); ?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico27Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemExcluir"); ?>
                    </div>
                </td>
              </tr>
              <?php
                //Loop pelos resultados.
                foreach($resultadoProdutosManutencao38 as $linhaProdutosManutencao38)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaProdutosManutencao38['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosManutencao38['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="ProdutosManutencaoEditar.php?idTbProdutosComplemento=<?php echo $linhaProdutosManutencao38['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaProdutosManutencao38['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formProdutosManutencao38" id="formProdutosManutencao38" action="ProdutosManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico27Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico27Nome'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div align="left">
                            <input type="text" name="complemento" id="complemento" class="CampoTexto01" maxlength="255" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaProdutosManutencaoDescricao"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div>
                            <textarea name="descricao" id="descricao" class="CampoTextoMultilinha01"></textarea>
                        </div>
                    </td>
                </tr>
            </table>


            <div>
                <div style="float:left;">
                    <input type="image" name="submit" value="Submit" src="img/btoIncluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoIncluir"); ?>" />
                    <input name="tipo_complemento" type="hidden" id="tipo_complemento" value="<?php echo $tipoComplemento; ?>" />
                    
                    <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                </div>
                <div style="float:right;">
                    &nbsp;
                </div>
            </div>
        </form>
        <br />
        <br />
        <br />
        
        <?php 
        //Limpeza de objetos.
        //----------
        unset($strSqlProdutosManutencao38Select);
        unset($statementProdutosManutencao38Select);
        unset($resultadoProdutosManutencao38);
        unset($linhaProdutosManutencao38);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Produtos - Filtro Genérico 28.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarProdutosFiltroGenerico28'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 39;
		
        //Query de pesquisa.
        //----------
        $strSqlProdutosManutencao39Select = "";
        $strSqlProdutosManutencao39Select .= "SELECT ";
        $strSqlProdutosManutencao39Select .= "id, ";
        $strSqlProdutosManutencao39Select .= "tipo_complemento, ";
        $strSqlProdutosManutencao39Select .= "complemento, ";
        $strSqlProdutosManutencao39Select .= "descricao ";
        $strSqlProdutosManutencao39Select .= "FROM tb_produtos_complemento ";
        $strSqlProdutosManutencao39Select .= "WHERE id <> 0 ";
        $strSqlProdutosManutencao39Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlProdutosManutencao39Select .= "ORDER BY " . $GLOBALS['configClassificacaoProdutos'] . " ";
        $strSqlProdutosManutencao39Select .= "ORDER BY complemento";
        
        $statementProdutosManutencao39Select = $dbSistemaConPDO->prepare($strSqlProdutosManutencao39Select);
        
        if ($statementProdutosManutencao39Select !== false)
        {
            $statementProdutosManutencao39Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoProdutosManutencao39 = $dbSistemaConPDO->query($strSqlProdutosManutencao39Select);
        $resultadoProdutosManutencao39 = $statementProdutosManutencao39Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico28Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoProdutosManutencao39))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formProdutosManutencao39Acoes" id="formProdutosManutencao39Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_produtos_complemento" />
            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            
            <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            <div style="position:relative; display: block; clear: both;">
                <div align="right" style="float: right;">
                    <input type="image" name="submit" value="Submit" src="img/btoExcluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoExcluir"); ?>">
                </div>
            </div>
        
            <table width="100%" class="TabelaDados01">
              <tr class="TbFundoEscuro">
                <td width="50" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemId"); ?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico28Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemExcluir"); ?>
                    </div>
                </td>
              </tr>
              <?php
                //Loop pelos resultados.
                foreach($resultadoProdutosManutencao39 as $linhaProdutosManutencao39)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaProdutosManutencao39['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosManutencao39['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="ProdutosManutencaoEditar.php?idTbProdutosComplemento=<?php echo $linhaProdutosManutencao39['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaProdutosManutencao39['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formProdutosManutencao39" id="formProdutosManutencao39" action="ProdutosManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico28Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico28Nome'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div align="left">
                            <input type="text" name="complemento" id="complemento" class="CampoTexto01" maxlength="255" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaProdutosManutencaoDescricao"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div>
                            <textarea name="descricao" id="descricao" class="CampoTextoMultilinha01"></textarea>
                        </div>
                    </td>
                </tr>
            </table>
            <div>
                <div style="float:left;">
                    <input type="image" name="submit" value="Submit" src="img/btoIncluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoIncluir"); ?>" />
                    <input name="tipo_complemento" type="hidden" id="tipo_complemento" value="<?php echo $tipoComplemento; ?>" />
                    
                    <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                </div>
                <div style="float:right;">
                    &nbsp;
                </div>
            </div>
        </form>
        <br />
        <br />
        <br />
        
        <?php 
        //Limpeza de objetos.
        //----------
        unset($strSqlProdutosManutencao39Select);
        unset($statementProdutosManutencao39Select);
        unset($resultadoProdutosManutencao39);
        unset($linhaProdutosManutencao39);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Produtos - Filtro Genérico 29.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarProdutosFiltroGenerico29'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 40;
		
        //Query de pesquisa.
        //----------
        $strSqlProdutosManutencao30Select = "";
        $strSqlProdutosManutencao30Select .= "SELECT ";
        $strSqlProdutosManutencao30Select .= "id, ";
        $strSqlProdutosManutencao30Select .= "tipo_complemento, ";
        $strSqlProdutosManutencao30Select .= "complemento, ";
        $strSqlProdutosManutencao30Select .= "descricao ";
        $strSqlProdutosManutencao30Select .= "FROM tb_produtos_complemento ";
        $strSqlProdutosManutencao30Select .= "WHERE id <> 0 ";
        $strSqlProdutosManutencao30Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlProdutosManutencao30Select .= "ORDER BY " . $GLOBALS['configClassificacaoProdutos'] . " ";
        $strSqlProdutosManutencao30Select .= "ORDER BY complemento";
        
        $statementProdutosManutencao30Select = $dbSistemaConPDO->prepare($strSqlProdutosManutencao30Select);
        
        if ($statementProdutosManutencao30Select !== false)
        {
            $statementProdutosManutencao30Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoProdutosManutencao30 = $dbSistemaConPDO->query($strSqlProdutosManutencao30Select);
        $resultadoProdutosManutencao30 = $statementProdutosManutencao30Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico29Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoProdutosManutencao30))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formProdutosManutencao30Acoes" id="formProdutosManutencao30Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_produtos_complemento" />
            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            
            <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            <div style="position:relative; display: block; clear: both;">
                <div align="right" style="float: right;">
                    <input type="image" name="submit" value="Submit" src="img/btoExcluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoExcluir"); ?>">
                </div>
            </div>
        
            <table width="100%" class="TabelaDados01">
              <tr class="TbFundoEscuro">
                <td width="50" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemId"); ?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico29Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemExcluir"); ?>
                    </div>
                </td>
              </tr>
              <?php
                //Loop pelos resultados.
                foreach($resultadoProdutosManutencao30 as $linhaProdutosManutencao30)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaProdutosManutencao30['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosManutencao30['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="ProdutosManutencaoEditar.php?idTbProdutosComplemento=<?php echo $linhaProdutosManutencao30['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaProdutosManutencao30['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formProdutosManutencao30" id="formProdutosManutencao30" action="ProdutosManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico29Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico29Nome'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div align="left">
                            <input type="text" name="complemento" id="complemento" class="CampoTexto01" maxlength="255" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaProdutosManutencaoDescricao"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div>
                            <textarea name="descricao" id="descricao" class="CampoTextoMultilinha01"></textarea>
                        </div>
                    </td>
                </tr>
            </table>
            <div>
                <div style="float:left;">
                    <input type="image" name="submit" value="Submit" src="img/btoIncluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoIncluir"); ?>" />
                    <input name="tipo_complemento" type="hidden" id="tipo_complemento" value="<?php echo $tipoComplemento; ?>" />
                    
                    <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                </div>
                <div style="float:right;">
                    &nbsp;
                </div>
            </div>
        </form>
        <br />
        <br />
        <br />
        
        <?php 
        //Limpeza de objetos.
        //----------
        unset($strSqlProdutosManutencao30Select);
        unset($statementProdutosManutencao30Select);
        unset($resultadoProdutosManutencao30);
        unset($linhaProdutosManutencao30);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Produtos - Filtro Genérico 30.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarProdutosFiltroGenerico30'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 41;
		
        //Query de pesquisa.
        //----------
        $strSqlProdutosManutencao41Select = "";
        $strSqlProdutosManutencao41Select .= "SELECT ";
        $strSqlProdutosManutencao41Select .= "id, ";
        $strSqlProdutosManutencao41Select .= "tipo_complemento, ";
        $strSqlProdutosManutencao41Select .= "complemento, ";
        $strSqlProdutosManutencao41Select .= "descricao ";
        $strSqlProdutosManutencao41Select .= "FROM tb_produtos_complemento ";
        $strSqlProdutosManutencao41Select .= "WHERE id <> 0 ";
        $strSqlProdutosManutencao41Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlProdutosManutencao41Select .= "ORDER BY " . $GLOBALS['configClassificacaoProdutos'] . " ";
        $strSqlProdutosManutencao41Select .= "ORDER BY complemento";
        
        $statementProdutosManutencao41Select = $dbSistemaConPDO->prepare($strSqlProdutosManutencao41Select);
        
        if ($statementProdutosManutencao41Select !== false)
        {
            $statementProdutosManutencao41Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoProdutosManutencao41 = $dbSistemaConPDO->query($strSqlProdutosManutencao41Select);
        $resultadoProdutosManutencao41 = $statementProdutosManutencao41Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico30Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoProdutosManutencao41))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formProdutosManutencao41Acoes" id="formProdutosManutencao41Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_produtos_complemento" />
            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            
            <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            <div style="position:relative; display: block; clear: both;">
                <div align="right" style="float: right;">
                    <input type="image" name="submit" value="Submit" src="img/btoExcluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoExcluir"); ?>">
                </div>
            </div>
        
            <table width="100%" class="TabelaDados01">
              <tr class="TbFundoEscuro">
                <td width="50" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemId"); ?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico20Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemExcluir"); ?>
                    </div>
                </td>
              </tr>
              <?php
                //Loop pelos resultados.
                foreach($resultadoProdutosManutencao41 as $linhaProdutosManutencao41)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaProdutosManutencao41['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosManutencao41['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="ProdutosManutencaoEditar.php?idTbProdutosComplemento=<?php echo $linhaProdutosManutencao41['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaProdutosManutencao41['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formProdutosManutencao41" id="formProdutosManutencao41" action="ProdutosManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico30Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico30Nome'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div align="left">
                            <input type="text" name="complemento" id="complemento" class="CampoTexto01" maxlength="255" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaProdutosManutencaoDescricao"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div>
                            <textarea name="descricao" id="descricao" class="CampoTextoMultilinha01"></textarea>
                        </div>
                    </td>
                </tr>
            </table>
            <div>
                <div style="float:left;">
                    <input type="image" name="submit" value="Submit" src="img/btoIncluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoIncluir"); ?>" />
                    <input name="tipo_complemento" type="hidden" id="tipo_complemento" value="<?php echo $tipoComplemento; ?>" />
                    
                    <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                </div>
                <div style="float:right;">
                    &nbsp;
                </div>
            </div>
        </form>
        <br />
        <br />
        <br />
        
        <?php 
        //Limpeza de objetos.
        //----------
        unset($strSqlProdutosManutencao41Select);
        unset($statementProdutosManutencao41Select);
        unset($resultadoProdutosManutencao41);
        unset($linhaProdutosManutencao41);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>
       
<?php 
$page->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php
//Limpeza de objetos.
//unset($strSqlProdutosManutencao1Select);
//unset($statementProdutosManutencao1Select);
//unset($resultadoProdutosManutencao1);
//unset($linhaProdutosManutencao1);
//----------
?>


<?php 
//Inclusão do template do layout.
include_once $page->LayoutSistema;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>