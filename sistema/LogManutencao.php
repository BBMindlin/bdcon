<?php
//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeLayout.php";


//Verificação de login Master.
LoginAutenticacao::UsuarioLoginVerificacao();


//Resgate de variáveis.
$paginaRetorno = "LogManutencao.php";
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
	<?php echo $GLOBALS['configNomeCliente']; ?>
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
    	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaLogManutencaoTitulo"); ?>
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
        

	<?php //Log - Filtro Genérico 01.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarLogFiltroGenerico01'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 12;
		
        //Query de pesquisa.
        //----------
        $strSqlLogManutencao12Select = "";
        $strSqlLogManutencao12Select .= "SELECT ";
        $strSqlLogManutencao12Select .= "id, ";
        $strSqlLogManutencao12Select .= "tipo_complemento, ";
        $strSqlLogManutencao12Select .= "complemento, ";
        $strSqlLogManutencao12Select .= "descricao ";
        $strSqlLogManutencao12Select .= "FROM tb_log_complemento ";
        $strSqlLogManutencao12Select .= "WHERE id <> 0 ";
        $strSqlLogManutencao12Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlLogManutencao12Select .= "ORDER BY " . $GLOBALS['configClassificacaoLog'] . " ";
        $strSqlLogManutencao12Select .= "ORDER BY complemento";
        
        $statementLogManutencao12Select = $dbSistemaConPDO->prepare($strSqlLogManutencao12Select);
        
        if ($statementLogManutencao12Select !== false)
        {
            $statementLogManutencao12Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoLogManutencao12 = $dbSistemaConPDO->query($strSqlLogManutencao12Select);
        $resultadoLogManutencao12 = $statementLogManutencao12Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo htmlentities($GLOBALS['configLogFiltroGenerico01Nome']); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoLogManutencao12))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formLogManutencao12Acoes" id="formLogManutencao12Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_log_complemento" />
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
                        <?php echo htmlentities($GLOBALS['configLogFiltroGenerico01Nome']); ?>
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
                foreach($resultadoLogManutencao12 as $linhaLogManutencao12)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaLogManutencao12['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaLogManutencao12['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="LogManutencaoEditar.php?idTbLogComplemento=<?php echo $linhaLogManutencao12['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaLogManutencao12['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formLogManutencao12" id="formLogManutencao12" action="LogManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo htmlentities($GLOBALS['configLogFiltroGenerico01Nome']); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo htmlentities($GLOBALS['configLogFiltroGenerico01Nome']); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaLogManutencaoDescricao"); ?>:
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
        unset($strSqlLogManutencao12Select);
        unset($statementLogManutencao12Select);
        unset($resultadoLogManutencao12);
        unset($linhaLogManutencao12);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Log - Filtro Genérico 02.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarLogFiltroGenerico02'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 13;
		
        //Query de pesquisa.
        //----------
        $strSqlLogManutencao13Select = "";
        $strSqlLogManutencao13Select .= "SELECT ";
        $strSqlLogManutencao13Select .= "id, ";
        $strSqlLogManutencao13Select .= "tipo_complemento, ";
        $strSqlLogManutencao13Select .= "complemento, ";
        $strSqlLogManutencao13Select .= "descricao ";
        $strSqlLogManutencao13Select .= "FROM tb_log_complemento ";
        $strSqlLogManutencao13Select .= "WHERE id <> 0 ";
        $strSqlLogManutencao13Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlLogManutencao13Select .= "ORDER BY " . $GLOBALS['configClassificacaoLog'] . " ";
        $strSqlLogManutencao13Select .= "ORDER BY complemento";
        
        $statementLogManutencao13Select = $dbSistemaConPDO->prepare($strSqlLogManutencao13Select);
        
        if ($statementLogManutencao13Select !== false)
        {
            $statementLogManutencao13Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoLogManutencao13 = $dbSistemaConPDO->query($strSqlLogManutencao13Select);
        $resultadoLogManutencao13 = $statementLogManutencao13Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo htmlentities($GLOBALS['configLogFiltroGenerico02Nome']); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoLogManutencao13))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formLogManutencao13Acoes" id="formLogManutencao13Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_log_complemento" />
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
                        <?php echo htmlentities($GLOBALS['configLogFiltroGenerico02Nome']); ?>
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
                foreach($resultadoLogManutencao13 as $linhaLogManutencao13)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaLogManutencao13['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaLogManutencao13['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="LogManutencaoEditar.php?idTbLogComplemento=<?php echo $linhaLogManutencao13['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaLogManutencao13['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formLogManutencao13" id="formLogManutencao13" action="LogManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo htmlentities($GLOBALS['configLogFiltroGenerico02Nome']); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo htmlentities($GLOBALS['configLogFiltroGenerico02Nome']); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaLogManutencaoDescricao"); ?>:
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
        unset($strSqlLogManutencao13Select);
        unset($statementLogManutencao13Select);
        unset($resultadoLogManutencao13);
        unset($linhaLogManutencao13);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Log - Filtro Genérico 03.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarLogFiltroGenerico03'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 14;
		
        //Query de pesquisa.
        //----------
        $strSqlLogManutencao14Select = "";
        $strSqlLogManutencao14Select .= "SELECT ";
        $strSqlLogManutencao14Select .= "id, ";
        $strSqlLogManutencao14Select .= "tipo_complemento, ";
        $strSqlLogManutencao14Select .= "complemento, ";
        $strSqlLogManutencao14Select .= "descricao ";
        $strSqlLogManutencao14Select .= "FROM tb_log_complemento ";
        $strSqlLogManutencao14Select .= "WHERE id <> 0 ";
        $strSqlLogManutencao14Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlLogManutencao14Select .= "ORDER BY " . $GLOBALS['configClassificacaoLog'] . " ";
        $strSqlLogManutencao14Select .= "ORDER BY complemento";
        
        $statementLogManutencao14Select = $dbSistemaConPDO->prepare($strSqlLogManutencao14Select);
        
        if ($statementLogManutencao14Select !== false)
        {
            $statementLogManutencao14Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoLogManutencao14 = $dbSistemaConPDO->query($strSqlLogManutencao14Select);
        $resultadoLogManutencao14 = $statementLogManutencao14Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo htmlentities($GLOBALS['configLogFiltroGenerico03Nome']); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoLogManutencao14))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formLogManutencao14Acoes" id="formLogManutencao14Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_log_complemento" />
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
                        <?php echo htmlentities($GLOBALS['configLogFiltroGenerico03Nome']); ?>
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
                foreach($resultadoLogManutencao14 as $linhaLogManutencao14)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaLogManutencao14['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaLogManutencao14['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="LogManutencaoEditar.php?idTbLogComplemento=<?php echo $linhaLogManutencao14['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaLogManutencao14['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formLogManutencao14" id="formLogManutencao14" action="LogManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo htmlentities($GLOBALS['configLogFiltroGenerico03Nome']); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo htmlentities($GLOBALS['configLogFiltroGenerico03Nome']); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaLogManutencaoDescricao"); ?>:
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
        unset($strSqlLogManutencao14Select);
        unset($statementLogManutencao14Select);
        unset($resultadoLogManutencao14);
        unset($linhaLogManutencao14);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Log - Filtro Genérico 04.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarLogFiltroGenerico04'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 15;
		
        //Query de pesquisa.
        //----------
        $strSqlLogManutencao15Select = "";
        $strSqlLogManutencao15Select .= "SELECT ";
        $strSqlLogManutencao15Select .= "id, ";
        $strSqlLogManutencao15Select .= "tipo_complemento, ";
        $strSqlLogManutencao15Select .= "complemento, ";
        $strSqlLogManutencao15Select .= "descricao ";
        $strSqlLogManutencao15Select .= "FROM tb_log_complemento ";
        $strSqlLogManutencao15Select .= "WHERE id <> 0 ";
        $strSqlLogManutencao15Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlLogManutencao15Select .= "ORDER BY " . $GLOBALS['configClassificacaoLog'] . " ";
        $strSqlLogManutencao15Select .= "ORDER BY complemento";
        
        $statementLogManutencao15Select = $dbSistemaConPDO->prepare($strSqlLogManutencao15Select);
        
        if ($statementLogManutencao15Select !== false)
        {
            $statementLogManutencao15Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoLogManutencao15 = $dbSistemaConPDO->query($strSqlLogManutencao15Select);
        $resultadoLogManutencao15 = $statementLogManutencao15Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo htmlentities($GLOBALS['configLogFiltroGenerico04Nome']); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoLogManutencao15))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formLogManutencao15Acoes" id="formLogManutencao15Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_log_complemento" />
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
                        <?php echo htmlentities($GLOBALS['configLogFiltroGenerico04Nome']); ?>
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
                foreach($resultadoLogManutencao15 as $linhaLogManutencao15)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaLogManutencao15['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaLogManutencao15['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="LogManutencaoEditar.php?idTbLogComplemento=<?php echo $linhaLogManutencao15['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaLogManutencao15['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formLogManutencao15" id="formLogManutencao15" action="LogManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo htmlentities($GLOBALS['configLogFiltroGenerico04Nome']); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo htmlentities($GLOBALS['configLogFiltroGenerico04Nome']); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaLogManutencaoDescricao"); ?>:
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
        unset($strSqlLogManutencao15Select);
        unset($statementLogManutencao15Select);
        unset($resultadoLogManutencao15);
        unset($linhaLogManutencao15);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Log - Filtro Genérico 05.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarLogFiltroGenerico05'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 16;
		
        //Query de pesquisa.
        //----------
        $strSqlLogManutencao16Select = "";
        $strSqlLogManutencao16Select .= "SELECT ";
        $strSqlLogManutencao16Select .= "id, ";
        $strSqlLogManutencao16Select .= "tipo_complemento, ";
        $strSqlLogManutencao16Select .= "complemento, ";
        $strSqlLogManutencao16Select .= "descricao ";
        $strSqlLogManutencao16Select .= "FROM tb_log_complemento ";
        $strSqlLogManutencao16Select .= "WHERE id <> 0 ";
        $strSqlLogManutencao16Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlLogManutencao16Select .= "ORDER BY " . $GLOBALS['configClassificacaoLog'] . " ";
        $strSqlLogManutencao16Select .= "ORDER BY complemento";
        
        $statementLogManutencao16Select = $dbSistemaConPDO->prepare($strSqlLogManutencao16Select);
        
        if ($statementLogManutencao16Select !== false)
        {
            $statementLogManutencao16Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoLogManutencao16 = $dbSistemaConPDO->query($strSqlLogManutencao16Select);
        $resultadoLogManutencao16 = $statementLogManutencao16Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo htmlentities($GLOBALS['configLogFiltroGenerico05Nome']); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoLogManutencao16))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formLogManutencao16Acoes" id="formLogManutencao16Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_log_complemento" />
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
                        <?php echo htmlentities($GLOBALS['configLogFiltroGenerico05Nome']); ?>
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
                foreach($resultadoLogManutencao16 as $linhaLogManutencao16)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaLogManutencao16['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaLogManutencao16['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="LogManutencaoEditar.php?idTbLogComplemento=<?php echo $linhaLogManutencao16['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaLogManutencao16['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formLogManutencao16" id="formLogManutencao16" action="LogManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo htmlentities($GLOBALS['configLogFiltroGenerico05Nome']); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo htmlentities($GLOBALS['configLogFiltroGenerico05Nome']); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaLogManutencaoDescricao"); ?>:
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
        unset($strSqlLogManutencao16Select);
        unset($statementLogManutencao16Select);
        unset($resultadoLogManutencao16);
        unset($linhaLogManutencao16);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Log - Filtro Genérico 06.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarLogFiltroGenerico06'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 17;
		
        //Query de pesquisa.
        //----------
        $strSqlLogManutencao17Select = "";
        $strSqlLogManutencao17Select .= "SELECT ";
        $strSqlLogManutencao17Select .= "id, ";
        $strSqlLogManutencao17Select .= "tipo_complemento, ";
        $strSqlLogManutencao17Select .= "complemento, ";
        $strSqlLogManutencao17Select .= "descricao ";
        $strSqlLogManutencao17Select .= "FROM tb_log_complemento ";
        $strSqlLogManutencao17Select .= "WHERE id <> 0 ";
        $strSqlLogManutencao17Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlLogManutencao17Select .= "ORDER BY " . $GLOBALS['configClassificacaoLog'] . " ";
        $strSqlLogManutencao17Select .= "ORDER BY complemento";
        
        $statementLogManutencao17Select = $dbSistemaConPDO->prepare($strSqlLogManutencao17Select);
        
        if ($statementLogManutencao17Select !== false)
        {
            $statementLogManutencao17Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoLogManutencao17 = $dbSistemaConPDO->query($strSqlLogManutencao17Select);
        $resultadoLogManutencao17 = $statementLogManutencao17Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo htmlentities($GLOBALS['configLogFiltroGenerico06Nome']); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoLogManutencao17))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formLogManutencao17Acoes" id="formLogManutencao17Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_log_complemento" />
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
                        <?php echo htmlentities($GLOBALS['configLogFiltroGenerico06Nome']); ?>
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
                foreach($resultadoLogManutencao17 as $linhaLogManutencao17)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaLogManutencao17['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaLogManutencao17['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="LogManutencaoEditar.php?idTbLogComplemento=<?php echo $linhaLogManutencao17['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaLogManutencao17['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formLogManutencao17" id="formLogManutencao17" action="LogManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo htmlentities($GLOBALS['configLogFiltroGenerico06Nome']); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo htmlentities($GLOBALS['configLogFiltroGenerico06Nome']); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaLogManutencaoDescricao"); ?>:
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
        unset($strSqlLogManutencao17Select);
        unset($statementLogManutencao17Select);
        unset($resultadoLogManutencao17);
        unset($linhaLogManutencao17);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Log - Filtro Genérico 07.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarLogFiltroGenerico07'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 18;
		
        //Query de pesquisa.
        //----------
        $strSqlLogManutencao18Select = "";
        $strSqlLogManutencao18Select .= "SELECT ";
        $strSqlLogManutencao18Select .= "id, ";
        $strSqlLogManutencao18Select .= "tipo_complemento, ";
        $strSqlLogManutencao18Select .= "complemento, ";
        $strSqlLogManutencao18Select .= "descricao ";
        $strSqlLogManutencao18Select .= "FROM tb_log_complemento ";
        $strSqlLogManutencao18Select .= "WHERE id <> 0 ";
        $strSqlLogManutencao18Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlLogManutencao18Select .= "ORDER BY " . $GLOBALS['configClassificacaoLog'] . " ";
        $strSqlLogManutencao18Select .= "ORDER BY complemento";
        
        $statementLogManutencao18Select = $dbSistemaConPDO->prepare($strSqlLogManutencao18Select);
        
        if ($statementLogManutencao18Select !== false)
        {
            $statementLogManutencao18Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoLogManutencao18 = $dbSistemaConPDO->query($strSqlLogManutencao18Select);
        $resultadoLogManutencao18 = $statementLogManutencao18Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo htmlentities($GLOBALS['configLogFiltroGenerico07Nome']); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoLogManutencao18))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formLogManutencao18Acoes" id="formLogManutencao18Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_log_complemento" />
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
                        <?php echo htmlentities($GLOBALS['configLogFiltroGenerico07Nome']); ?>
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
                foreach($resultadoLogManutencao18 as $linhaLogManutencao18)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaLogManutencao18['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaLogManutencao18['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="LogManutencaoEditar.php?idTbLogComplemento=<?php echo $linhaLogManutencao18['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaLogManutencao18['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formLogManutencao18" id="formLogManutencao18" action="LogManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo htmlentities($GLOBALS['configLogFiltroGenerico07Nome']); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo htmlentities($GLOBALS['configLogFiltroGenerico07Nome']); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaLogManutencaoDescricao"); ?>:
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
        unset($strSqlLogManutencao18Select);
        unset($statementLogManutencao18Select);
        unset($resultadoLogManutencao18);
        unset($linhaLogManutencao18);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Log - Filtro Genérico 08.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarLogFiltroGenerico08'] == 1){ ?>
        <?php

		//Definição de variáveis.
		$tipoComplemento = 19;
		
        //Query de pesquisa.
        //----------
        $strSqlLogManutencao19Select = "";
        $strSqlLogManutencao19Select .= "SELECT ";
        $strSqlLogManutencao19Select .= "id, ";
        $strSqlLogManutencao19Select .= "tipo_complemento, ";
        $strSqlLogManutencao19Select .= "complemento, ";
        $strSqlLogManutencao19Select .= "descricao ";
        $strSqlLogManutencao19Select .= "FROM tb_log_complemento ";
        $strSqlLogManutencao19Select .= "WHERE id <> 0 ";
        $strSqlLogManutencao19Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlLogManutencao19Select .= "ORDER BY " . $GLOBALS['configClassificacaoLog'] . " ";
        $strSqlLogManutencao19Select .= "ORDER BY complemento";
        
        $statementLogManutencao19Select = $dbSistemaConPDO->prepare($strSqlLogManutencao19Select);
        
        if ($statementLogManutencao19Select !== false)
        {
            $statementLogManutencao19Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoLogManutencao19 = $dbSistemaConPDO->query($strSqlLogManutencao19Select);
        $resultadoLogManutencao19 = $statementLogManutencao19Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo htmlentities($GLOBALS['configLogFiltroGenerico08Nome']); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoLogManutencao19))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formLogManutencao19Acoes" id="formLogManutencao19Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_log_complemento" />
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
                        <?php echo htmlentities($GLOBALS['configLogFiltroGenerico08Nome']); ?>
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
                foreach($resultadoLogManutencao19 as $linhaLogManutencao19)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaLogManutencao19['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaLogManutencao19['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="LogManutencaoEditar.php?idTbLogComplemento=<?php echo $linhaLogManutencao19['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaLogManutencao19['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formLogManutencao19" id="formLogManutencao19" action="LogManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo htmlentities($GLOBALS['configLogFiltroGenerico08Nome']); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo htmlentities($GLOBALS['configLogFiltroGenerico08Nome']); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaLogManutencaoDescricao"); ?>:
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
        unset($strSqlLogManutencao19Select);
        unset($statementLogManutencao19Select);
        unset($resultadoLogManutencao19);
        unset($linhaLogManutencao19);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Log - Filtro Genérico 09.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarLogFiltroGenerico09'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 20;
		
        //Query de pesquisa.
        //----------
        $strSqlLogManutencao20Select = "";
        $strSqlLogManutencao20Select .= "SELECT ";
        $strSqlLogManutencao20Select .= "id, ";
        $strSqlLogManutencao20Select .= "tipo_complemento, ";
        $strSqlLogManutencao20Select .= "complemento, ";
        $strSqlLogManutencao20Select .= "descricao ";
        $strSqlLogManutencao20Select .= "FROM tb_log_complemento ";
        $strSqlLogManutencao20Select .= "WHERE id <> 0 ";
        $strSqlLogManutencao20Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlLogManutencao20Select .= "ORDER BY " . $GLOBALS['configClassificacaoLog'] . " ";
        $strSqlLogManutencao20Select .= "ORDER BY complemento";
        
        $statementLogManutencao20Select = $dbSistemaConPDO->prepare($strSqlLogManutencao20Select);
        
        if ($statementLogManutencao20Select !== false)
        {
            $statementLogManutencao20Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoLogManutencao20 = $dbSistemaConPDO->query($strSqlLogManutencao20Select);
        $resultadoLogManutencao20 = $statementLogManutencao20Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo htmlentities($GLOBALS['configLogFiltroGenerico09Nome']); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoLogManutencao20))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formLogManutencao20Acoes" id="formLogManutencao20Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_log_complemento" />
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
                        <?php echo htmlentities($GLOBALS['configLogFiltroGenerico09Nome']); ?>
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
                foreach($resultadoLogManutencao20 as $linhaLogManutencao20)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaLogManutencao20['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaLogManutencao20['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="LogManutencaoEditar.php?idTbLogComplemento=<?php echo $linhaLogManutencao20['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaLogManutencao20['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formLogManutencao20" id="formLogManutencao20" action="LogManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo htmlentities($GLOBALS['configLogFiltroGenerico09Nome']); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo htmlentities($GLOBALS['configLogFiltroGenerico09Nome']); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaLogManutencaoDescricao"); ?>:
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
        unset($strSqlLogManutencao20Select);
        unset($statementLogManutencao20Select);
        unset($resultadoLogManutencao20);
        unset($linhaLogManutencao20);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Log - Filtro Genérico 10.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarLogFiltroGenerico10'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 21;
		
        //Query de pesquisa.
        //----------
        $strSqlLogManutencao21Select = "";
        $strSqlLogManutencao21Select .= "SELECT ";
        $strSqlLogManutencao21Select .= "id, ";
        $strSqlLogManutencao21Select .= "tipo_complemento, ";
        $strSqlLogManutencao21Select .= "complemento, ";
        $strSqlLogManutencao21Select .= "descricao ";
        $strSqlLogManutencao21Select .= "FROM tb_log_complemento ";
        $strSqlLogManutencao21Select .= "WHERE id <> 0 ";
        $strSqlLogManutencao21Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlLogManutencao21Select .= "ORDER BY " . $GLOBALS['configClassificacaoLog'] . " ";
        $strSqlLogManutencao21Select .= "ORDER BY complemento";
        
        $statementLogManutencao21Select = $dbSistemaConPDO->prepare($strSqlLogManutencao21Select);
        
        if ($statementLogManutencao21Select !== false)
        {
            $statementLogManutencao21Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoLogManutencao21 = $dbSistemaConPDO->query($strSqlLogManutencao21Select);
        $resultadoLogManutencao21 = $statementLogManutencao21Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo htmlentities($GLOBALS['configLogFiltroGenerico10Nome']); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoLogManutencao21))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formLogManutencao21Acoes" id="formLogManutencao21Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_log_complemento" />
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
                        <?php echo htmlentities($GLOBALS['configLogFiltroGenerico10Nome']); ?>
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
                foreach($resultadoLogManutencao21 as $linhaLogManutencao21)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaLogManutencao21['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaLogManutencao21['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="LogManutencaoEditar.php?idTbLogComplemento=<?php echo $linhaLogManutencao21['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaLogManutencao21['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formLogManutencao21" id="formLogManutencao21" action="LogManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo htmlentities($GLOBALS['configLogFiltroGenerico10Nome']); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo htmlentities($GLOBALS['configLogFiltroGenerico10Nome']); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaLogManutencaoDescricao"); ?>:
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
        unset($strSqlLogManutencao21Select);
        unset($statementLogManutencao21Select);
        unset($resultadoLogManutencao21);
        unset($linhaLogManutencao21);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>
    
    
	<?php //Log - Filtro Genérico 11.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarLogFiltroGenerico11'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 22;
		
        //Query de pesquisa.
        //----------
        $strSqlLogManutencao22Select = "";
        $strSqlLogManutencao22Select .= "SELECT ";
        $strSqlLogManutencao22Select .= "id, ";
        $strSqlLogManutencao22Select .= "tipo_complemento, ";
        $strSqlLogManutencao22Select .= "complemento, ";
        $strSqlLogManutencao22Select .= "descricao ";
        $strSqlLogManutencao22Select .= "FROM tb_log_complemento ";
        $strSqlLogManutencao22Select .= "WHERE id <> 0 ";
        $strSqlLogManutencao22Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlLogManutencao22Select .= "ORDER BY " . $GLOBALS['configClassificacaoLog'] . " ";
        $strSqlLogManutencao22Select .= "ORDER BY complemento";
        
        $statementLogManutencao22Select = $dbSistemaConPDO->prepare($strSqlLogManutencao22Select);
        
        if ($statementLogManutencao22Select !== false)
        {
            $statementLogManutencao22Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoLogManutencao22 = $dbSistemaConPDO->query($strSqlLogManutencao22Select);
        $resultadoLogManutencao22 = $statementLogManutencao22Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo htmlentities($GLOBALS['configLogFiltroGenerico11Nome']); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoLogManutencao22))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formLogManutencao22Acoes" id="formLogManutencao22Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_log_complemento" />
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
                        <?php echo htmlentities($GLOBALS['configLogFiltroGenerico11Nome']); ?>
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
                foreach($resultadoLogManutencao22 as $linhaLogManutencao22)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaLogManutencao22['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaLogManutencao22['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="LogManutencaoEditar.php?idTbLogComplemento=<?php echo $linhaLogManutencao22['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaLogManutencao22['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formLogManutencao22" id="formLogManutencao22" action="LogManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo htmlentities($GLOBALS['configLogFiltroGenerico11Nome']); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo htmlentities($GLOBALS['configLogFiltroGenerico11Nome']); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaLogManutencaoDescricao"); ?>:
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
        unset($strSqlLogManutencao22Select);
        unset($statementLogManutencao22Select);
        unset($resultadoLogManutencao22);
        unset($linhaLogManutencao22);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Log - Filtro Genérico 12.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarLogFiltroGenerico12'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 23;
		
        //Query de pesquisa.
        //----------
        $strSqlLogManutencao23Select = "";
        $strSqlLogManutencao23Select .= "SELECT ";
        $strSqlLogManutencao23Select .= "id, ";
        $strSqlLogManutencao23Select .= "tipo_complemento, ";
        $strSqlLogManutencao23Select .= "complemento, ";
        $strSqlLogManutencao23Select .= "descricao ";
        $strSqlLogManutencao23Select .= "FROM tb_log_complemento ";
        $strSqlLogManutencao23Select .= "WHERE id <> 0 ";
        $strSqlLogManutencao23Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlLogManutencao23Select .= "ORDER BY " . $GLOBALS['configClassificacaoLog'] . " ";
        $strSqlLogManutencao23Select .= "ORDER BY complemento";
        
        $statementLogManutencao23Select = $dbSistemaConPDO->prepare($strSqlLogManutencao23Select);
        
        if ($statementLogManutencao23Select !== false)
        {
            $statementLogManutencao23Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoLogManutencao23 = $dbSistemaConPDO->query($strSqlLogManutencao23Select);
        $resultadoLogManutencao23 = $statementLogManutencao23Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo htmlentities($GLOBALS['configLogFiltroGenerico12Nome']); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoLogManutencao23))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formLogManutencao23Acoes" id="formLogManutencao23Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_log_complemento" />
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
                        <?php echo htmlentities($GLOBALS['configLogFiltroGenerico12Nome']); ?>
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
                foreach($resultadoLogManutencao23 as $linhaLogManutencao23)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaLogManutencao23['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaLogManutencao23['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="LogManutencaoEditar.php?idTbLogComplemento=<?php echo $linhaLogManutencao23['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaLogManutencao23['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formLogManutencao23" id="formLogManutencao23" action="LogManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo htmlentities($GLOBALS['configLogFiltroGenerico12Nome']); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo htmlentities($GLOBALS['configLogFiltroGenerico12Nome']); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaLogManutencaoDescricao"); ?>:
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
        unset($strSqlLogManutencao23Select);
        unset($statementLogManutencao23Select);
        unset($resultadoLogManutencao23);
        unset($linhaLogManutencao23);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Log - Filtro Genérico 13.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarLogFiltroGenerico13'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 24;
		
        //Query de pesquisa.
        //----------
        $strSqlLogManutencao24Select = "";
        $strSqlLogManutencao24Select .= "SELECT ";
        $strSqlLogManutencao24Select .= "id, ";
        $strSqlLogManutencao24Select .= "tipo_complemento, ";
        $strSqlLogManutencao24Select .= "complemento, ";
        $strSqlLogManutencao24Select .= "descricao ";
        $strSqlLogManutencao24Select .= "FROM tb_log_complemento ";
        $strSqlLogManutencao24Select .= "WHERE id <> 0 ";
        $strSqlLogManutencao24Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlLogManutencao24Select .= "ORDER BY " . $GLOBALS['configClassificacaoLog'] . " ";
        $strSqlLogManutencao24Select .= "ORDER BY complemento";
        
        $statementLogManutencao24Select = $dbSistemaConPDO->prepare($strSqlLogManutencao24Select);
        
        if ($statementLogManutencao24Select !== false)
        {
            $statementLogManutencao24Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoLogManutencao24 = $dbSistemaConPDO->query($strSqlLogManutencao24Select);
        $resultadoLogManutencao24 = $statementLogManutencao24Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo htmlentities($GLOBALS['configLogFiltroGenerico13Nome']); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoLogManutencao24))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formLogManutencao24Acoes" id="formLogManutencao24Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_log_complemento" />
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
                        <?php echo htmlentities($GLOBALS['configLogFiltroGenerico13Nome']); ?>
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
                foreach($resultadoLogManutencao24 as $linhaLogManutencao24)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaLogManutencao24['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaLogManutencao24['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="LogManutencaoEditar.php?idTbLogComplemento=<?php echo $linhaLogManutencao24['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaLogManutencao24['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formLogManutencao24" id="formLogManutencao24" action="LogManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo htmlentities($GLOBALS['configLogFiltroGenerico13Nome']); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo htmlentities($GLOBALS['configLogFiltroGenerico13Nome']); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaLogManutencaoDescricao"); ?>:
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
        unset($strSqlLogManutencao24Select);
        unset($statementLogManutencao24Select);
        unset($resultadoLogManutencao24);
        unset($linhaLogManutencao24);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Log - Filtro Genérico 14.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarLogFiltroGenerico14'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 25;
		
        //Query de pesquisa.
        //----------
        $strSqlLogManutencao25Select = "";
        $strSqlLogManutencao25Select .= "SELECT ";
        $strSqlLogManutencao25Select .= "id, ";
        $strSqlLogManutencao25Select .= "tipo_complemento, ";
        $strSqlLogManutencao25Select .= "complemento, ";
        $strSqlLogManutencao25Select .= "descricao ";
        $strSqlLogManutencao25Select .= "FROM tb_log_complemento ";
        $strSqlLogManutencao25Select .= "WHERE id <> 0 ";
        $strSqlLogManutencao25Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlLogManutencao25Select .= "ORDER BY " . $GLOBALS['configClassificacaoLog'] . " ";
        $strSqlLogManutencao25Select .= "ORDER BY complemento";
        
        $statementLogManutencao25Select = $dbSistemaConPDO->prepare($strSqlLogManutencao25Select);
        
        if ($statementLogManutencao25Select !== false)
        {
            $statementLogManutencao25Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoLogManutencao25 = $dbSistemaConPDO->query($strSqlLogManutencao25Select);
        $resultadoLogManutencao25 = $statementLogManutencao25Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo htmlentities($GLOBALS['configLogFiltroGenerico14Nome']); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoLogManutencao25))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formLogManutencao25Acoes" id="formLogManutencao25Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_log_complemento" />
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
                        <?php echo htmlentities($GLOBALS['configLogFiltroGenerico14Nome']); ?>
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
                foreach($resultadoLogManutencao25 as $linhaLogManutencao25)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaLogManutencao25['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaLogManutencao25['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="LogManutencaoEditar.php?idTbLogComplemento=<?php echo $linhaLogManutencao25['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaLogManutencao25['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formLogManutencao25" id="formLogManutencao25" action="LogManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo htmlentities($GLOBALS['configLogFiltroGenerico14Nome']); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo htmlentities($GLOBALS['configLogFiltroGenerico14Nome']); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaLogManutencaoDescricao"); ?>:
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
        unset($strSqlLogManutencao25Select);
        unset($statementLogManutencao25Select);
        unset($resultadoLogManutencao25);
        unset($linhaLogManutencao25);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Log - Filtro Genérico 15.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarLogFiltroGenerico15'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 26;
		
        //Query de pesquisa.
        //----------
        $strSqlLogManutencao26Select = "";
        $strSqlLogManutencao26Select .= "SELECT ";
        $strSqlLogManutencao26Select .= "id, ";
        $strSqlLogManutencao26Select .= "tipo_complemento, ";
        $strSqlLogManutencao26Select .= "complemento, ";
        $strSqlLogManutencao26Select .= "descricao ";
        $strSqlLogManutencao26Select .= "FROM tb_log_complemento ";
        $strSqlLogManutencao26Select .= "WHERE id <> 0 ";
        $strSqlLogManutencao26Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlLogManutencao26Select .= "ORDER BY " . $GLOBALS['configClassificacaoLog'] . " ";
        $strSqlLogManutencao26Select .= "ORDER BY complemento";
        
        $statementLogManutencao26Select = $dbSistemaConPDO->prepare($strSqlLogManutencao26Select);
        
        if ($statementLogManutencao26Select !== false)
        {
            $statementLogManutencao26Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoLogManutencao26 = $dbSistemaConPDO->query($strSqlLogManutencao26Select);
        $resultadoLogManutencao26 = $statementLogManutencao26Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo htmlentities($GLOBALS['configLogFiltroGenerico15Nome']); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoLogManutencao26))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formLogManutencao26Acoes" id="formLogManutencao26Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_log_complemento" />
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
                        <?php echo htmlentities($GLOBALS['configLogFiltroGenerico15Nome']); ?>
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
                foreach($resultadoLogManutencao26 as $linhaLogManutencao26)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaLogManutencao26['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaLogManutencao26['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="LogManutencaoEditar.php?idTbLogComplemento=<?php echo $linhaLogManutencao26['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaLogManutencao26['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formLogManutencao26" id="formLogManutencao26" action="LogManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo htmlentities($GLOBALS['configLogFiltroGenerico15Nome']); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo htmlentities($GLOBALS['configLogFiltroGenerico15Nome']); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaLogManutencaoDescricao"); ?>:
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
        unset($strSqlLogManutencao26Select);
        unset($statementLogManutencao26Select);
        unset($resultadoLogManutencao26);
        unset($linhaLogManutencao26);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Log - Filtro Genérico 16.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarLogFiltroGenerico16'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 27;
		
        //Query de pesquisa.
        //----------
        $strSqlLogManutencao27Select = "";
        $strSqlLogManutencao27Select .= "SELECT ";
        $strSqlLogManutencao27Select .= "id, ";
        $strSqlLogManutencao27Select .= "tipo_complemento, ";
        $strSqlLogManutencao27Select .= "complemento, ";
        $strSqlLogManutencao27Select .= "descricao ";
        $strSqlLogManutencao27Select .= "FROM tb_log_complemento ";
        $strSqlLogManutencao27Select .= "WHERE id <> 0 ";
        $strSqlLogManutencao27Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlLogManutencao27Select .= "ORDER BY " . $GLOBALS['configClassificacaoLog'] . " ";
        $strSqlLogManutencao27Select .= "ORDER BY complemento";
        
        $statementLogManutencao27Select = $dbSistemaConPDO->prepare($strSqlLogManutencao27Select);
        
        if ($statementLogManutencao27Select !== false)
        {
            $statementLogManutencao27Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoLogManutencao27 = $dbSistemaConPDO->query($strSqlLogManutencao27Select);
        $resultadoLogManutencao27 = $statementLogManutencao27Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo htmlentities($GLOBALS['configLogFiltroGenerico16Nome']); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoLogManutencao27))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formLogManutencao27Acoes" id="formLogManutencao27Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_log_complemento" />
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
                        <?php echo htmlentities($GLOBALS['configLogFiltroGenerico16Nome']); ?>
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
                foreach($resultadoLogManutencao27 as $linhaLogManutencao27)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaLogManutencao27['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaLogManutencao27['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="LogManutencaoEditar.php?idTbLogComplemento=<?php echo $linhaLogManutencao27['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaLogManutencao27['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formLogManutencao27" id="formLogManutencao27" action="LogManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo htmlentities($GLOBALS['configLogFiltroGenerico16Nome']); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo htmlentities($GLOBALS['configLogFiltroGenerico16Nome']); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaLogManutencaoDescricao"); ?>:
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
        unset($strSqlLogManutencao27Select);
        unset($statementLogManutencao27Select);
        unset($resultadoLogManutencao27);
        unset($linhaLogManutencao27);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Log - Filtro Genérico 17.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarLogFiltroGenerico17'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 28;
		
        //Query de pesquisa.
        //----------
        $strSqlLogManutencao28Select = "";
        $strSqlLogManutencao28Select .= "SELECT ";
        $strSqlLogManutencao28Select .= "id, ";
        $strSqlLogManutencao28Select .= "tipo_complemento, ";
        $strSqlLogManutencao28Select .= "complemento, ";
        $strSqlLogManutencao28Select .= "descricao ";
        $strSqlLogManutencao28Select .= "FROM tb_log_complemento ";
        $strSqlLogManutencao28Select .= "WHERE id <> 0 ";
        $strSqlLogManutencao28Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlLogManutencao28Select .= "ORDER BY " . $GLOBALS['configClassificacaoLog'] . " ";
        $strSqlLogManutencao28Select .= "ORDER BY complemento";
        
        $statementLogManutencao28Select = $dbSistemaConPDO->prepare($strSqlLogManutencao28Select);
        
        if ($statementLogManutencao28Select !== false)
        {
            $statementLogManutencao28Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoLogManutencao28 = $dbSistemaConPDO->query($strSqlLogManutencao28Select);
        $resultadoLogManutencao28 = $statementLogManutencao28Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo htmlentities($GLOBALS['configLogFiltroGenerico17Nome']); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoLogManutencao28))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formLogManutencao28Acoes" id="formLogManutencao28Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_log_complemento" />
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
                        <?php echo htmlentities($GLOBALS['configLogFiltroGenerico17Nome']); ?>
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
                foreach($resultadoLogManutencao28 as $linhaLogManutencao28)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaLogManutencao28['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaLogManutencao28['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="LogManutencaoEditar.php?idTbLogComplemento=<?php echo $linhaLogManutencao28['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaLogManutencao28['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formLogManutencao28" id="formLogManutencao28" action="LogManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo htmlentities($GLOBALS['configLogFiltroGenerico17Nome']); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo htmlentities($GLOBALS['configLogFiltroGenerico17Nome']); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaLogManutencaoDescricao"); ?>:
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
        unset($strSqlLogManutencao28Select);
        unset($statementLogManutencao28Select);
        unset($resultadoLogManutencao28);
        unset($linhaLogManutencao28);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Log - Filtro Genérico 18.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarLogFiltroGenerico18'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 29;
		
        //Query de pesquisa.
        //----------
        $strSqlLogManutencao29Select = "";
        $strSqlLogManutencao29Select .= "SELECT ";
        $strSqlLogManutencao29Select .= "id, ";
        $strSqlLogManutencao29Select .= "tipo_complemento, ";
        $strSqlLogManutencao29Select .= "complemento, ";
        $strSqlLogManutencao29Select .= "descricao ";
        $strSqlLogManutencao29Select .= "FROM tb_log_complemento ";
        $strSqlLogManutencao29Select .= "WHERE id <> 0 ";
        $strSqlLogManutencao29Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlLogManutencao29Select .= "ORDER BY " . $GLOBALS['configClassificacaoLog'] . " ";
        $strSqlLogManutencao29Select .= "ORDER BY complemento";
        
        $statementLogManutencao29Select = $dbSistemaConPDO->prepare($strSqlLogManutencao29Select);
        
        if ($statementLogManutencao29Select !== false)
        {
            $statementLogManutencao29Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoLogManutencao29 = $dbSistemaConPDO->query($strSqlLogManutencao29Select);
        $resultadoLogManutencao29 = $statementLogManutencao29Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo htmlentities($GLOBALS['configLogFiltroGenerico18Nome']); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoLogManutencao29))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formLogManutencao29Acoes" id="formLogManutencao29Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_log_complemento" />
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
                        <?php echo htmlentities($GLOBALS['configLogFiltroGenerico18Nome']); ?>
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
                foreach($resultadoLogManutencao29 as $linhaLogManutencao29)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaLogManutencao29['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaLogManutencao29['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="LogManutencaoEditar.php?idTbLogComplemento=<?php echo $linhaLogManutencao29['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaLogManutencao29['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formLogManutencao29" id="formLogManutencao29" action="LogManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo htmlentities($GLOBALS['configLogFiltroGenerico18Nome']); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo htmlentities($GLOBALS['configLogFiltroGenerico18Nome']); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaLogManutencaoDescricao"); ?>:
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
        unset($strSqlLogManutencao29Select);
        unset($statementLogManutencao29Select);
        unset($resultadoLogManutencao29);
        unset($linhaLogManutencao29);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Log - Filtro Genérico 19.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarLogFiltroGenerico19'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 30;
		
        //Query de pesquisa.
        //----------
        $strSqlLogManutencao30Select = "";
        $strSqlLogManutencao30Select .= "SELECT ";
        $strSqlLogManutencao30Select .= "id, ";
        $strSqlLogManutencao30Select .= "tipo_complemento, ";
        $strSqlLogManutencao30Select .= "complemento, ";
        $strSqlLogManutencao30Select .= "descricao ";
        $strSqlLogManutencao30Select .= "FROM tb_log_complemento ";
        $strSqlLogManutencao30Select .= "WHERE id <> 0 ";
        $strSqlLogManutencao30Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlLogManutencao30Select .= "ORDER BY " . $GLOBALS['configClassificacaoLog'] . " ";
        $strSqlLogManutencao30Select .= "ORDER BY complemento";
        
        $statementLogManutencao30Select = $dbSistemaConPDO->prepare($strSqlLogManutencao30Select);
        
        if ($statementLogManutencao30Select !== false)
        {
            $statementLogManutencao30Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoLogManutencao30 = $dbSistemaConPDO->query($strSqlLogManutencao30Select);
        $resultadoLogManutencao30 = $statementLogManutencao30Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo htmlentities($GLOBALS['configLogFiltroGenerico19Nome']); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoLogManutencao30))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formLogManutencao30Acoes" id="formLogManutencao30Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_log_complemento" />
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
                        <?php echo htmlentities($GLOBALS['configLogFiltroGenerico19Nome']); ?>
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
                foreach($resultadoLogManutencao30 as $linhaLogManutencao30)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaLogManutencao30['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaLogManutencao30['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="LogManutencaoEditar.php?idTbLogComplemento=<?php echo $linhaLogManutencao30['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaLogManutencao30['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formLogManutencao30" id="formLogManutencao30" action="LogManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo htmlentities($GLOBALS['configLogFiltroGenerico19Nome']); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo htmlentities($GLOBALS['configLogFiltroGenerico19Nome']); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaLogManutencaoDescricao"); ?>:
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
        unset($strSqlLogManutencao30Select);
        unset($statementLogManutencao30Select);
        unset($resultadoLogManutencao30);
        unset($linhaLogManutencao30);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Log - Filtro Genérico 20.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarLogFiltroGenerico20'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 31;
		
        //Query de pesquisa.
        //----------
        $strSqlLogManutencao31Select = "";
        $strSqlLogManutencao31Select .= "SELECT ";
        $strSqlLogManutencao31Select .= "id, ";
        $strSqlLogManutencao31Select .= "tipo_complemento, ";
        $strSqlLogManutencao31Select .= "complemento, ";
        $strSqlLogManutencao31Select .= "descricao ";
        $strSqlLogManutencao31Select .= "FROM tb_log_complemento ";
        $strSqlLogManutencao31Select .= "WHERE id <> 0 ";
        $strSqlLogManutencao31Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlLogManutencao31Select .= "ORDER BY " . $GLOBALS['configClassificacaoLog'] . " ";
        $strSqlLogManutencao31Select .= "ORDER BY complemento";
        
        $statementLogManutencao31Select = $dbSistemaConPDO->prepare($strSqlLogManutencao31Select);
        
        if ($statementLogManutencao31Select !== false)
        {
            $statementLogManutencao31Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoLogManutencao31 = $dbSistemaConPDO->query($strSqlLogManutencao31Select);
        $resultadoLogManutencao31 = $statementLogManutencao31Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo htmlentities($GLOBALS['configLogFiltroGenerico20Nome']); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoLogManutencao31))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formLogManutencao31Acoes" id="formLogManutencao31Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_log_complemento" />
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
                        <?php echo htmlentities($GLOBALS['configLogFiltroGenerico20Nome']); ?>
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
                foreach($resultadoLogManutencao31 as $linhaLogManutencao31)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaLogManutencao31['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaLogManutencao31['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="LogManutencaoEditar.php?idTbLogComplemento=<?php echo $linhaLogManutencao31['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaLogManutencao31['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formLogManutencao31" id="formLogManutencao31" action="LogManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo htmlentities($GLOBALS['configLogFiltroGenerico20Nome']); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo htmlentities($GLOBALS['configLogFiltroGenerico20Nome']); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaLogManutencaoDescricao"); ?>:
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
        unset($strSqlLogManutencao31Select);
        unset($statementLogManutencao31Select);
        unset($resultadoLogManutencao31);
        unset($linhaLogManutencao31);
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
//unset($strSqlLogManutencao1Select);
//unset($statementLogManutencao1Select);
//unset($resultadoLogManutencao1);
//unset($linhaLogManutencao1);
//----------
?>


<?php 
//Inclusão do template do layout.
include_once $page->LayoutSistema;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>