<?php
//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeLayout.php";


//Verificação de login Master.
LoginAutenticacao::UsuarioLoginVerificacao();


//Resgate de variáveis.
$paginaRetorno = "HistoricoManutencao.php";
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
    	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoTitulo"); ?>
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
    
    
	<?php //Historico - Filtro Genérico 01.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico01'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 12;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao12Select = "";
        $strSqlHistoricoManutencao12Select .= "SELECT ";
        $strSqlHistoricoManutencao12Select .= "id, ";
        $strSqlHistoricoManutencao12Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao12Select .= "complemento, ";
        $strSqlHistoricoManutencao12Select .= "descricao ";
        $strSqlHistoricoManutencao12Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao12Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao12Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao12Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao12Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao12Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao12Select);
        
        if ($statementHistoricoManutencao12Select !== false)
        {
            $statementHistoricoManutencao12Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao12 = $dbSistemaConPDO->query($strSqlHistoricoManutencao12Select);
        $resultadoHistoricoManutencao12 = $statementHistoricoManutencao12Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico01Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao12))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao12Acoes" id="formHistoricoManutencao12Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico01Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao12 as $linhaHistoricoManutencao12)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao12['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao12['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao12['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao12['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao12" id="formHistoricoManutencao12" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico01Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico01Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao12Select);
        unset($statementHistoricoManutencao12Select);
        unset($resultadoHistoricoManutencao12);
        unset($linhaHistoricoManutencao12);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 02.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico02'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 13;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao13Select = "";
        $strSqlHistoricoManutencao13Select .= "SELECT ";
        $strSqlHistoricoManutencao13Select .= "id, ";
        $strSqlHistoricoManutencao13Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao13Select .= "complemento, ";
        $strSqlHistoricoManutencao13Select .= "descricao ";
        $strSqlHistoricoManutencao13Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao13Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao13Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao13Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao13Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao13Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao13Select);
        
        if ($statementHistoricoManutencao13Select !== false)
        {
            $statementHistoricoManutencao13Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao13 = $dbSistemaConPDO->query($strSqlHistoricoManutencao13Select);
        $resultadoHistoricoManutencao13 = $statementHistoricoManutencao13Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico02Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao13))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao13Acoes" id="formHistoricoManutencao13Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico02Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao13 as $linhaHistoricoManutencao13)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao13['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao13['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao13['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao13['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao13" id="formHistoricoManutencao13" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico02Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico02Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao13Select);
        unset($statementHistoricoManutencao13Select);
        unset($resultadoHistoricoManutencao13);
        unset($linhaHistoricoManutencao13);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 03.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico03'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 14;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao14Select = "";
        $strSqlHistoricoManutencao14Select .= "SELECT ";
        $strSqlHistoricoManutencao14Select .= "id, ";
        $strSqlHistoricoManutencao14Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao14Select .= "complemento, ";
        $strSqlHistoricoManutencao14Select .= "descricao ";
        $strSqlHistoricoManutencao14Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao14Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao14Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao14Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao14Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao14Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao14Select);
        
        if ($statementHistoricoManutencao14Select !== false)
        {
            $statementHistoricoManutencao14Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao14 = $dbSistemaConPDO->query($strSqlHistoricoManutencao14Select);
        $resultadoHistoricoManutencao14 = $statementHistoricoManutencao14Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico03Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao14))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao14Acoes" id="formHistoricoManutencao14Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico03Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao14 as $linhaHistoricoManutencao14)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao14['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao14['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao14['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao14['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao14" id="formHistoricoManutencao14" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico03Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico03Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao14Select);
        unset($statementHistoricoManutencao14Select);
        unset($resultadoHistoricoManutencao14);
        unset($linhaHistoricoManutencao14);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 04.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico04'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 15;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao15Select = "";
        $strSqlHistoricoManutencao15Select .= "SELECT ";
        $strSqlHistoricoManutencao15Select .= "id, ";
        $strSqlHistoricoManutencao15Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao15Select .= "complemento, ";
        $strSqlHistoricoManutencao15Select .= "descricao ";
        $strSqlHistoricoManutencao15Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao15Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao15Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao15Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao15Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao15Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao15Select);
        
        if ($statementHistoricoManutencao15Select !== false)
        {
            $statementHistoricoManutencao15Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao15 = $dbSistemaConPDO->query($strSqlHistoricoManutencao15Select);
        $resultadoHistoricoManutencao15 = $statementHistoricoManutencao15Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico04Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao15))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao15Acoes" id="formHistoricoManutencao15Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico04Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao15 as $linhaHistoricoManutencao15)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao15['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao15['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao15['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao15['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao15" id="formHistoricoManutencao15" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico04Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico04Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao15Select);
        unset($statementHistoricoManutencao15Select);
        unset($resultadoHistoricoManutencao15);
        unset($linhaHistoricoManutencao15);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 05.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico05'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 16;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao16Select = "";
        $strSqlHistoricoManutencao16Select .= "SELECT ";
        $strSqlHistoricoManutencao16Select .= "id, ";
        $strSqlHistoricoManutencao16Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao16Select .= "complemento, ";
        $strSqlHistoricoManutencao16Select .= "descricao ";
        $strSqlHistoricoManutencao16Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao16Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao16Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao16Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao16Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao16Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao16Select);
        
        if ($statementHistoricoManutencao16Select !== false)
        {
            $statementHistoricoManutencao16Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao16 = $dbSistemaConPDO->query($strSqlHistoricoManutencao16Select);
        $resultadoHistoricoManutencao16 = $statementHistoricoManutencao16Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico05Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao16))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao16Acoes" id="formHistoricoManutencao16Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico05Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao16 as $linhaHistoricoManutencao16)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao16['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao16['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao16['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao16['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao16" id="formHistoricoManutencao16" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico05Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico05Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao16Select);
        unset($statementHistoricoManutencao16Select);
        unset($resultadoHistoricoManutencao16);
        unset($linhaHistoricoManutencao16);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 06.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico06'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 17;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao17Select = "";
        $strSqlHistoricoManutencao17Select .= "SELECT ";
        $strSqlHistoricoManutencao17Select .= "id, ";
        $strSqlHistoricoManutencao17Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao17Select .= "complemento, ";
        $strSqlHistoricoManutencao17Select .= "descricao ";
        $strSqlHistoricoManutencao17Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao17Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao17Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao17Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao17Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao17Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao17Select);
        
        if ($statementHistoricoManutencao17Select !== false)
        {
            $statementHistoricoManutencao17Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao17 = $dbSistemaConPDO->query($strSqlHistoricoManutencao17Select);
        $resultadoHistoricoManutencao17 = $statementHistoricoManutencao17Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico06Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao17))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao17Acoes" id="formHistoricoManutencao17Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico06Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao17 as $linhaHistoricoManutencao17)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao17['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao17['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao17['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao17['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao17" id="formHistoricoManutencao17" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico06Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico06Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao17Select);
        unset($statementHistoricoManutencao17Select);
        unset($resultadoHistoricoManutencao17);
        unset($linhaHistoricoManutencao17);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 07.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico07'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 18;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao18Select = "";
        $strSqlHistoricoManutencao18Select .= "SELECT ";
        $strSqlHistoricoManutencao18Select .= "id, ";
        $strSqlHistoricoManutencao18Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao18Select .= "complemento, ";
        $strSqlHistoricoManutencao18Select .= "descricao ";
        $strSqlHistoricoManutencao18Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao18Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao18Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao18Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao18Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao18Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao18Select);
        
        if ($statementHistoricoManutencao18Select !== false)
        {
            $statementHistoricoManutencao18Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao18 = $dbSistemaConPDO->query($strSqlHistoricoManutencao18Select);
        $resultadoHistoricoManutencao18 = $statementHistoricoManutencao18Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico07Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao18))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao18Acoes" id="formHistoricoManutencao18Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico07Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao18 as $linhaHistoricoManutencao18)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao18['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao18['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao18['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao18['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao18" id="formHistoricoManutencao18" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico07Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico07Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao18Select);
        unset($statementHistoricoManutencao18Select);
        unset($resultadoHistoricoManutencao18);
        unset($linhaHistoricoManutencao18);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 08.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico08'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 19;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao19Select = "";
        $strSqlHistoricoManutencao19Select .= "SELECT ";
        $strSqlHistoricoManutencao19Select .= "id, ";
        $strSqlHistoricoManutencao19Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao19Select .= "complemento, ";
        $strSqlHistoricoManutencao19Select .= "descricao ";
        $strSqlHistoricoManutencao19Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao19Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao19Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao19Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao19Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao19Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao19Select);
        
        if ($statementHistoricoManutencao19Select !== false)
        {
            $statementHistoricoManutencao19Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao19 = $dbSistemaConPDO->query($strSqlHistoricoManutencao19Select);
        $resultadoHistoricoManutencao19 = $statementHistoricoManutencao19Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico08Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao19))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao19Acoes" id="formHistoricoManutencao19Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico08Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao19 as $linhaHistoricoManutencao19)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao19['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao19['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao19['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao19['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao19" id="formHistoricoManutencao19" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico08Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico08Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao19Select);
        unset($statementHistoricoManutencao19Select);
        unset($resultadoHistoricoManutencao19);
        unset($linhaHistoricoManutencao19);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 09.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico09'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 20;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao20Select = "";
        $strSqlHistoricoManutencao20Select .= "SELECT ";
        $strSqlHistoricoManutencao20Select .= "id, ";
        $strSqlHistoricoManutencao20Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao20Select .= "complemento, ";
        $strSqlHistoricoManutencao20Select .= "descricao ";
        $strSqlHistoricoManutencao20Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao20Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao20Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao20Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao20Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao20Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao20Select);
        
        if ($statementHistoricoManutencao20Select !== false)
        {
            $statementHistoricoManutencao20Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao20 = $dbSistemaConPDO->query($strSqlHistoricoManutencao20Select);
        $resultadoHistoricoManutencao20 = $statementHistoricoManutencao20Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico09Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao20))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao20Acoes" id="formHistoricoManutencao20Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico09Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao20 as $linhaHistoricoManutencao20)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao20['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao20['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao20['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao20['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao20" id="formHistoricoManutencao20" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico09Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico09Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao20Select);
        unset($statementHistoricoManutencao20Select);
        unset($resultadoHistoricoManutencao20);
        unset($linhaHistoricoManutencao20);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 10.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico10'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 21;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao21Select = "";
        $strSqlHistoricoManutencao21Select .= "SELECT ";
        $strSqlHistoricoManutencao21Select .= "id, ";
        $strSqlHistoricoManutencao21Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao21Select .= "complemento, ";
        $strSqlHistoricoManutencao21Select .= "descricao ";
        $strSqlHistoricoManutencao21Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao21Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao21Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao21Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao21Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao21Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao21Select);
        
        if ($statementHistoricoManutencao21Select !== false)
        {
            $statementHistoricoManutencao21Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao21 = $dbSistemaConPDO->query($strSqlHistoricoManutencao21Select);
        $resultadoHistoricoManutencao21 = $statementHistoricoManutencao21Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico10Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao21))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao21Acoes" id="formHistoricoManutencao21Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico10Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao21 as $linhaHistoricoManutencao21)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao21['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao21['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao21['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao21['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao21" id="formHistoricoManutencao21" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico10Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico10Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao21Select);
        unset($statementHistoricoManutencao21Select);
        unset($resultadoHistoricoManutencao21);
        unset($linhaHistoricoManutencao21);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>
    
    
	<?php //Historico - Filtro Genérico 11.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico11'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 22;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao22Select = "";
        $strSqlHistoricoManutencao22Select .= "SELECT ";
        $strSqlHistoricoManutencao22Select .= "id, ";
        $strSqlHistoricoManutencao22Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao22Select .= "complemento, ";
        $strSqlHistoricoManutencao22Select .= "descricao ";
        $strSqlHistoricoManutencao22Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao22Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao22Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao22Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao22Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao22Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao22Select);
        
        if ($statementHistoricoManutencao22Select !== false)
        {
            $statementHistoricoManutencao22Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao22 = $dbSistemaConPDO->query($strSqlHistoricoManutencao22Select);
        $resultadoHistoricoManutencao22 = $statementHistoricoManutencao22Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico11Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao22))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao22Acoes" id="formHistoricoManutencao22Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico11Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao22 as $linhaHistoricoManutencao22)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao22['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao22['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao22['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao22['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao22" id="formHistoricoManutencao22" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico11Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico11Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao22Select);
        unset($statementHistoricoManutencao22Select);
        unset($resultadoHistoricoManutencao22);
        unset($linhaHistoricoManutencao22);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 12.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico12'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 23;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao23Select = "";
        $strSqlHistoricoManutencao23Select .= "SELECT ";
        $strSqlHistoricoManutencao23Select .= "id, ";
        $strSqlHistoricoManutencao23Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao23Select .= "complemento, ";
        $strSqlHistoricoManutencao23Select .= "descricao ";
        $strSqlHistoricoManutencao23Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao23Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao23Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao23Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao23Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao23Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao23Select);
        
        if ($statementHistoricoManutencao23Select !== false)
        {
            $statementHistoricoManutencao23Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao23 = $dbSistemaConPDO->query($strSqlHistoricoManutencao23Select);
        $resultadoHistoricoManutencao23 = $statementHistoricoManutencao23Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico12Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao23))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao23Acoes" id="formHistoricoManutencao23Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico12Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao23 as $linhaHistoricoManutencao23)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao23['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao23['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao23['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao23['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao23" id="formHistoricoManutencao23" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico12Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico12Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao23Select);
        unset($statementHistoricoManutencao23Select);
        unset($resultadoHistoricoManutencao23);
        unset($linhaHistoricoManutencao23);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 13.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico13'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 24;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao24Select = "";
        $strSqlHistoricoManutencao24Select .= "SELECT ";
        $strSqlHistoricoManutencao24Select .= "id, ";
        $strSqlHistoricoManutencao24Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao24Select .= "complemento, ";
        $strSqlHistoricoManutencao24Select .= "descricao ";
        $strSqlHistoricoManutencao24Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao24Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao24Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao24Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao24Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao24Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao24Select);
        
        if ($statementHistoricoManutencao24Select !== false)
        {
            $statementHistoricoManutencao24Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao24 = $dbSistemaConPDO->query($strSqlHistoricoManutencao24Select);
        $resultadoHistoricoManutencao24 = $statementHistoricoManutencao24Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico13Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao24))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao24Acoes" id="formHistoricoManutencao24Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico13Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao24 as $linhaHistoricoManutencao24)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao24['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao24['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao24['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao24['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao24" id="formHistoricoManutencao24" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico13Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico13Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao24Select);
        unset($statementHistoricoManutencao24Select);
        unset($resultadoHistoricoManutencao24);
        unset($linhaHistoricoManutencao24);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 14.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico14'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 25;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao25Select = "";
        $strSqlHistoricoManutencao25Select .= "SELECT ";
        $strSqlHistoricoManutencao25Select .= "id, ";
        $strSqlHistoricoManutencao25Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao25Select .= "complemento, ";
        $strSqlHistoricoManutencao25Select .= "descricao ";
        $strSqlHistoricoManutencao25Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao25Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao25Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao25Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao25Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao25Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao25Select);
        
        if ($statementHistoricoManutencao25Select !== false)
        {
            $statementHistoricoManutencao25Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao25 = $dbSistemaConPDO->query($strSqlHistoricoManutencao25Select);
        $resultadoHistoricoManutencao25 = $statementHistoricoManutencao25Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico14Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao25))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao25Acoes" id="formHistoricoManutencao25Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico14Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao25 as $linhaHistoricoManutencao25)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao25['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao25['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao25['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao25['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao25" id="formHistoricoManutencao25" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico14Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico14Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao25Select);
        unset($statementHistoricoManutencao25Select);
        unset($resultadoHistoricoManutencao25);
        unset($linhaHistoricoManutencao25);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 15.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico15'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 26;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao26Select = "";
        $strSqlHistoricoManutencao26Select .= "SELECT ";
        $strSqlHistoricoManutencao26Select .= "id, ";
        $strSqlHistoricoManutencao26Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao26Select .= "complemento, ";
        $strSqlHistoricoManutencao26Select .= "descricao ";
        $strSqlHistoricoManutencao26Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao26Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao26Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao26Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao26Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao26Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao26Select);
        
        if ($statementHistoricoManutencao26Select !== false)
        {
            $statementHistoricoManutencao26Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao26 = $dbSistemaConPDO->query($strSqlHistoricoManutencao26Select);
        $resultadoHistoricoManutencao26 = $statementHistoricoManutencao26Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico15Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao26))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao26Acoes" id="formHistoricoManutencao26Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico15Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao26 as $linhaHistoricoManutencao26)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao26['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao26['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao26['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao26['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao26" id="formHistoricoManutencao26" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico15Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico15Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao26Select);
        unset($statementHistoricoManutencao26Select);
        unset($resultadoHistoricoManutencao26);
        unset($linhaHistoricoManutencao26);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 16.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico16'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 27;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao27Select = "";
        $strSqlHistoricoManutencao27Select .= "SELECT ";
        $strSqlHistoricoManutencao27Select .= "id, ";
        $strSqlHistoricoManutencao27Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao27Select .= "complemento, ";
        $strSqlHistoricoManutencao27Select .= "descricao ";
        $strSqlHistoricoManutencao27Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao27Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao27Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao27Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao27Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao27Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao27Select);
        
        if ($statementHistoricoManutencao27Select !== false)
        {
            $statementHistoricoManutencao27Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao27 = $dbSistemaConPDO->query($strSqlHistoricoManutencao27Select);
        $resultadoHistoricoManutencao27 = $statementHistoricoManutencao27Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico16Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao27))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao27Acoes" id="formHistoricoManutencao27Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico16Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao27 as $linhaHistoricoManutencao27)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao27['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao27['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">

                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao27['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao27['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao27" id="formHistoricoManutencao27" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico16Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico16Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao27Select);
        unset($statementHistoricoManutencao27Select);
        unset($resultadoHistoricoManutencao27);
        unset($linhaHistoricoManutencao27);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 17.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico17'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 28;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao28Select = "";
        $strSqlHistoricoManutencao28Select .= "SELECT ";
        $strSqlHistoricoManutencao28Select .= "id, ";
        $strSqlHistoricoManutencao28Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao28Select .= "complemento, ";
        $strSqlHistoricoManutencao28Select .= "descricao ";
        $strSqlHistoricoManutencao28Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao28Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao28Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao28Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao28Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao28Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao28Select);
        
        if ($statementHistoricoManutencao28Select !== false)
        {
            $statementHistoricoManutencao28Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao28 = $dbSistemaConPDO->query($strSqlHistoricoManutencao28Select);
        $resultadoHistoricoManutencao28 = $statementHistoricoManutencao28Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico17Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao28))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao28Acoes" id="formHistoricoManutencao28Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico17Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao28 as $linhaHistoricoManutencao28)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao28['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao28['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao28['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao28['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao28" id="formHistoricoManutencao28" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico17Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico17Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao28Select);
        unset($statementHistoricoManutencao28Select);
        unset($resultadoHistoricoManutencao28);
        unset($linhaHistoricoManutencao28);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 18.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico18'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 29;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao29Select = "";
        $strSqlHistoricoManutencao29Select .= "SELECT ";
        $strSqlHistoricoManutencao29Select .= "id, ";
        $strSqlHistoricoManutencao29Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao29Select .= "complemento, ";
        $strSqlHistoricoManutencao29Select .= "descricao ";
        $strSqlHistoricoManutencao29Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao29Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao29Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao29Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao29Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao29Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao29Select);
        
        if ($statementHistoricoManutencao29Select !== false)
        {
            $statementHistoricoManutencao29Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao29 = $dbSistemaConPDO->query($strSqlHistoricoManutencao29Select);
        $resultadoHistoricoManutencao29 = $statementHistoricoManutencao29Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico18Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao29))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao29Acoes" id="formHistoricoManutencao29Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico18Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao29 as $linhaHistoricoManutencao29)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao29['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao29['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao29['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao29['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao29" id="formHistoricoManutencao29" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico18Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico18Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao29Select);
        unset($statementHistoricoManutencao29Select);
        unset($resultadoHistoricoManutencao29);
        unset($linhaHistoricoManutencao29);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 19.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico19'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 30;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao20Select = "";
        $strSqlHistoricoManutencao20Select .= "SELECT ";
        $strSqlHistoricoManutencao20Select .= "id, ";
        $strSqlHistoricoManutencao20Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao20Select .= "complemento, ";
        $strSqlHistoricoManutencao20Select .= "descricao ";
        $strSqlHistoricoManutencao20Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao20Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao20Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao20Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao20Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao20Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao20Select);
        
        if ($statementHistoricoManutencao20Select !== false)
        {
            $statementHistoricoManutencao20Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao20 = $dbSistemaConPDO->query($strSqlHistoricoManutencao20Select);
        $resultadoHistoricoManutencao20 = $statementHistoricoManutencao20Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico19Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao20))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao20Acoes" id="formHistoricoManutencao20Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico19Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao20 as $linhaHistoricoManutencao20)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao20['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao20['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao20['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao20['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao20" id="formHistoricoManutencao20" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico19Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico19Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao20Select);
        unset($statementHistoricoManutencao20Select);
        unset($resultadoHistoricoManutencao20);
        unset($linhaHistoricoManutencao20);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 20.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico20'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 31;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao31Select = "";
        $strSqlHistoricoManutencao31Select .= "SELECT ";
        $strSqlHistoricoManutencao31Select .= "id, ";
        $strSqlHistoricoManutencao31Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao31Select .= "complemento, ";
        $strSqlHistoricoManutencao31Select .= "descricao ";
        $strSqlHistoricoManutencao31Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao31Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao31Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao31Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao31Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao31Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao31Select);
        
        if ($statementHistoricoManutencao31Select !== false)
        {
            $statementHistoricoManutencao31Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao31 = $dbSistemaConPDO->query($strSqlHistoricoManutencao31Select);
        $resultadoHistoricoManutencao31 = $statementHistoricoManutencao31Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico20Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao31))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao31Acoes" id="formHistoricoManutencao31Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico20Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao31 as $linhaHistoricoManutencao31)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao31['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao31['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao31['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao31['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao31" id="formHistoricoManutencao31" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico20Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico20Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao31Select);
        unset($statementHistoricoManutencao31Select);
        unset($resultadoHistoricoManutencao31);
        unset($linhaHistoricoManutencao31);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>
    
    
	<?php //Historico - Filtro Genérico 21.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico21'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 32;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao32Select = "";
        $strSqlHistoricoManutencao32Select .= "SELECT ";
        $strSqlHistoricoManutencao32Select .= "id, ";
        $strSqlHistoricoManutencao32Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao32Select .= "complemento, ";
        $strSqlHistoricoManutencao32Select .= "descricao ";
        $strSqlHistoricoManutencao32Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao32Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao32Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao32Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao32Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao32Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao32Select);
        
        if ($statementHistoricoManutencao32Select !== false)
        {
            $statementHistoricoManutencao32Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao32 = $dbSistemaConPDO->query($strSqlHistoricoManutencao32Select);
        $resultadoHistoricoManutencao32 = $statementHistoricoManutencao32Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico21Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao32))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao32Acoes" id="formHistoricoManutencao32Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico21Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao32 as $linhaHistoricoManutencao32)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao32['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao32['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao32['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao32['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao32" id="formHistoricoManutencao32" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico21Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico21Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao32Select);
        unset($statementHistoricoManutencao32Select);
        unset($resultadoHistoricoManutencao32);
        unset($linhaHistoricoManutencao32);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 22.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico22'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 33;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao33Select = "";
        $strSqlHistoricoManutencao33Select .= "SELECT ";
        $strSqlHistoricoManutencao33Select .= "id, ";
        $strSqlHistoricoManutencao33Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao33Select .= "complemento, ";
        $strSqlHistoricoManutencao33Select .= "descricao ";
        $strSqlHistoricoManutencao33Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao33Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao33Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao33Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao33Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao33Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao33Select);
        
        if ($statementHistoricoManutencao33Select !== false)
        {
            $statementHistoricoManutencao33Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao33 = $dbSistemaConPDO->query($strSqlHistoricoManutencao33Select);
        $resultadoHistoricoManutencao33 = $statementHistoricoManutencao33Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico22Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao33))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao33Acoes" id="formHistoricoManutencao33Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico22Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao33 as $linhaHistoricoManutencao33)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao33['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao33['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao33['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao33['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao33" id="formHistoricoManutencao33" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico22Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico22Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao33Select);
        unset($statementHistoricoManutencao33Select);
        unset($resultadoHistoricoManutencao33);
        unset($linhaHistoricoManutencao33);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 23.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico23'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 34;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao34Select = "";
        $strSqlHistoricoManutencao34Select .= "SELECT ";
        $strSqlHistoricoManutencao34Select .= "id, ";
        $strSqlHistoricoManutencao34Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao34Select .= "complemento, ";
        $strSqlHistoricoManutencao34Select .= "descricao ";
        $strSqlHistoricoManutencao34Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao34Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao34Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao34Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao34Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao34Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao34Select);
        
        if ($statementHistoricoManutencao34Select !== false)
        {
            $statementHistoricoManutencao34Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao34 = $dbSistemaConPDO->query($strSqlHistoricoManutencao34Select);
        $resultadoHistoricoManutencao34 = $statementHistoricoManutencao34Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico23Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao34))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao34Acoes" id="formHistoricoManutencao34Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico23Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao34 as $linhaHistoricoManutencao34)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao34['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao34['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao34['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao34['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao34" id="formHistoricoManutencao34" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico23Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico23Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao34Select);
        unset($statementHistoricoManutencao34Select);
        unset($resultadoHistoricoManutencao34);
        unset($linhaHistoricoManutencao34);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 24.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico24'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 35;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao35Select = "";
        $strSqlHistoricoManutencao35Select .= "SELECT ";
        $strSqlHistoricoManutencao35Select .= "id, ";
        $strSqlHistoricoManutencao35Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao35Select .= "complemento, ";
        $strSqlHistoricoManutencao35Select .= "descricao ";
        $strSqlHistoricoManutencao35Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao35Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao35Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao35Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao35Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao35Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao35Select);
        
        if ($statementHistoricoManutencao35Select !== false)
        {
            $statementHistoricoManutencao35Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao35 = $dbSistemaConPDO->query($strSqlHistoricoManutencao35Select);
        $resultadoHistoricoManutencao35 = $statementHistoricoManutencao35Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico24Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao35))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao35Acoes" id="formHistoricoManutencao35Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico24Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao35 as $linhaHistoricoManutencao35)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao35['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao35['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao35['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao35['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao35" id="formHistoricoManutencao35" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico24Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico24Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao35Select);
        unset($statementHistoricoManutencao35Select);
        unset($resultadoHistoricoManutencao35);
        unset($linhaHistoricoManutencao35);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 25.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico25'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 36;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao36Select = "";
        $strSqlHistoricoManutencao36Select .= "SELECT ";
        $strSqlHistoricoManutencao36Select .= "id, ";
        $strSqlHistoricoManutencao36Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao36Select .= "complemento, ";
        $strSqlHistoricoManutencao36Select .= "descricao ";
        $strSqlHistoricoManutencao36Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao36Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao36Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao36Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao36Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao36Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao36Select);
        
        if ($statementHistoricoManutencao36Select !== false)
        {
            $statementHistoricoManutencao36Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao36 = $dbSistemaConPDO->query($strSqlHistoricoManutencao36Select);
        $resultadoHistoricoManutencao36 = $statementHistoricoManutencao36Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico25Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao36))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao36Acoes" id="formHistoricoManutencao36Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico25Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao36 as $linhaHistoricoManutencao36)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao36['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao36['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao36['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao36['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao36" id="formHistoricoManutencao36" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico25Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico25Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao36Select);
        unset($statementHistoricoManutencao36Select);
        unset($resultadoHistoricoManutencao36);
        unset($linhaHistoricoManutencao36);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 26.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico26'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 37;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao37Select = "";
        $strSqlHistoricoManutencao37Select .= "SELECT ";
        $strSqlHistoricoManutencao37Select .= "id, ";
        $strSqlHistoricoManutencao37Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao37Select .= "complemento, ";
        $strSqlHistoricoManutencao37Select .= "descricao ";
        $strSqlHistoricoManutencao37Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao37Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao37Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao37Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao37Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao37Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao37Select);
        
        if ($statementHistoricoManutencao37Select !== false)
        {
            $statementHistoricoManutencao37Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao37 = $dbSistemaConPDO->query($strSqlHistoricoManutencao37Select);
        $resultadoHistoricoManutencao37 = $statementHistoricoManutencao37Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico26Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao37))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao37Acoes" id="formHistoricoManutencao37Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico26Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao37 as $linhaHistoricoManutencao37)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao37['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao37['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao37['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao37['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao37" id="formHistoricoManutencao37" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico26Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico26Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao37Select);
        unset($statementHistoricoManutencao37Select);
        unset($resultadoHistoricoManutencao37);
        unset($linhaHistoricoManutencao37);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 27.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico27'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 38;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao38Select = "";
        $strSqlHistoricoManutencao38Select .= "SELECT ";
        $strSqlHistoricoManutencao38Select .= "id, ";
        $strSqlHistoricoManutencao38Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao38Select .= "complemento, ";
        $strSqlHistoricoManutencao38Select .= "descricao ";
        $strSqlHistoricoManutencao38Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao38Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao38Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao38Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao38Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao38Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao38Select);
        
        if ($statementHistoricoManutencao38Select !== false)
        {
            $statementHistoricoManutencao38Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao38 = $dbSistemaConPDO->query($strSqlHistoricoManutencao38Select);
        $resultadoHistoricoManutencao38 = $statementHistoricoManutencao38Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico27Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao38))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao38Acoes" id="formHistoricoManutencao38Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico27Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao38 as $linhaHistoricoManutencao38)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao38['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao38['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao38['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao38['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao38" id="formHistoricoManutencao38" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico27Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico27Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao38Select);
        unset($statementHistoricoManutencao38Select);
        unset($resultadoHistoricoManutencao38);
        unset($linhaHistoricoManutencao38);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 28.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico28'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 39;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao39Select = "";
        $strSqlHistoricoManutencao39Select .= "SELECT ";
        $strSqlHistoricoManutencao39Select .= "id, ";
        $strSqlHistoricoManutencao39Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao39Select .= "complemento, ";
        $strSqlHistoricoManutencao39Select .= "descricao ";
        $strSqlHistoricoManutencao39Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao39Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao39Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao39Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao39Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao39Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao39Select);
        
        if ($statementHistoricoManutencao39Select !== false)
        {
            $statementHistoricoManutencao39Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao39 = $dbSistemaConPDO->query($strSqlHistoricoManutencao39Select);
        $resultadoHistoricoManutencao39 = $statementHistoricoManutencao39Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico28Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao39))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao39Acoes" id="formHistoricoManutencao39Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico28Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao39 as $linhaHistoricoManutencao39)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao39['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao39['complemento']);?>
                    </div>
                </td>
                

                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao39['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao39['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao39" id="formHistoricoManutencao39" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico28Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico28Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao39Select);
        unset($statementHistoricoManutencao39Select);
        unset($resultadoHistoricoManutencao39);
        unset($linhaHistoricoManutencao39);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 29.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico29'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 40;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao30Select = "";
        $strSqlHistoricoManutencao30Select .= "SELECT ";
        $strSqlHistoricoManutencao30Select .= "id, ";
        $strSqlHistoricoManutencao30Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao30Select .= "complemento, ";
        $strSqlHistoricoManutencao30Select .= "descricao ";
        $strSqlHistoricoManutencao30Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao30Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao30Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao30Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao30Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao30Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao30Select);
        
        if ($statementHistoricoManutencao30Select !== false)
        {
            $statementHistoricoManutencao30Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao30 = $dbSistemaConPDO->query($strSqlHistoricoManutencao30Select);
        $resultadoHistoricoManutencao30 = $statementHistoricoManutencao30Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico29Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao30))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao30Acoes" id="formHistoricoManutencao30Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico29Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao30 as $linhaHistoricoManutencao30)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao30['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao30['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao30['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao30['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao30" id="formHistoricoManutencao30" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico29Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico29Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao30Select);
        unset($statementHistoricoManutencao30Select);
        unset($resultadoHistoricoManutencao30);
        unset($linhaHistoricoManutencao30);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 30.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico30'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 41;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao41Select = "";
        $strSqlHistoricoManutencao41Select .= "SELECT ";
        $strSqlHistoricoManutencao41Select .= "id, ";
        $strSqlHistoricoManutencao41Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao41Select .= "complemento, ";
        $strSqlHistoricoManutencao41Select .= "descricao ";
        $strSqlHistoricoManutencao41Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao41Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao41Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao41Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao41Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao41Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao41Select);
        
        if ($statementHistoricoManutencao41Select !== false)
        {
            $statementHistoricoManutencao41Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao41 = $dbSistemaConPDO->query($strSqlHistoricoManutencao41Select);
        $resultadoHistoricoManutencao41 = $statementHistoricoManutencao41Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico30Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao41))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao41Acoes" id="formHistoricoManutencao41Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico20Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao41 as $linhaHistoricoManutencao41)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao41['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao41['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao41['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao41['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao41" id="formHistoricoManutencao41" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico30Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico30Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao41Select);
        unset($statementHistoricoManutencao41Select);
        unset($resultadoHistoricoManutencao41);
        unset($linhaHistoricoManutencao41);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>
    
    
	<?php //Historico - Filtro Genérico 31.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico31'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 42;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao42Select = "";
        $strSqlHistoricoManutencao42Select .= "SELECT ";
        $strSqlHistoricoManutencao42Select .= "id, ";
        $strSqlHistoricoManutencao42Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao42Select .= "complemento, ";
        $strSqlHistoricoManutencao42Select .= "descricao ";
        $strSqlHistoricoManutencao42Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao42Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao42Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao42Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao42Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao42Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao42Select);
        
        if ($statementHistoricoManutencao42Select !== false)
        {
            $statementHistoricoManutencao42Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao42 = $dbSistemaConPDO->query($strSqlHistoricoManutencao42Select);
        $resultadoHistoricoManutencao42 = $statementHistoricoManutencao42Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico31Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao42))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao42Acoes" id="formHistoricoManutencao42Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico31Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao42 as $linhaHistoricoManutencao42)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao42['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao42['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao42['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao42['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao42" id="formHistoricoManutencao42" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico31Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico31Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao42Select);
        unset($statementHistoricoManutencao42Select);
        unset($resultadoHistoricoManutencao42);
        unset($linhaHistoricoManutencao42);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 32.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico32'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 43;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao43Select = "";
        $strSqlHistoricoManutencao43Select .= "SELECT ";
        $strSqlHistoricoManutencao43Select .= "id, ";
        $strSqlHistoricoManutencao43Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao43Select .= "complemento, ";
        $strSqlHistoricoManutencao43Select .= "descricao ";
        $strSqlHistoricoManutencao43Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao43Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao43Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao43Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao43Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao43Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao43Select);
        
        if ($statementHistoricoManutencao43Select !== false)
        {
            $statementHistoricoManutencao43Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao43 = $dbSistemaConPDO->query($strSqlHistoricoManutencao43Select);
        $resultadoHistoricoManutencao43 = $statementHistoricoManutencao43Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico32Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao43))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao43Acoes" id="formHistoricoManutencao43Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico32Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao43 as $linhaHistoricoManutencao43)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao43['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao43['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao43['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao43['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao43" id="formHistoricoManutencao43" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico32Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico32Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao43Select);
        unset($statementHistoricoManutencao43Select);
        unset($resultadoHistoricoManutencao43);
        unset($linhaHistoricoManutencao43);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 33.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico33'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 44;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao44Select = "";
        $strSqlHistoricoManutencao44Select .= "SELECT ";
        $strSqlHistoricoManutencao44Select .= "id, ";
        $strSqlHistoricoManutencao44Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao44Select .= "complemento, ";
        $strSqlHistoricoManutencao44Select .= "descricao ";
        $strSqlHistoricoManutencao44Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao44Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao44Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao44Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao44Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao44Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao44Select);
        
        if ($statementHistoricoManutencao44Select !== false)
        {
            $statementHistoricoManutencao44Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao44 = $dbSistemaConPDO->query($strSqlHistoricoManutencao44Select);
        $resultadoHistoricoManutencao44 = $statementHistoricoManutencao44Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico33Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao44))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao44Acoes" id="formHistoricoManutencao44Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico33Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao44 as $linhaHistoricoManutencao44)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao44['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao44['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao44['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao44['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao44" id="formHistoricoManutencao44" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico33Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico33Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao44Select);
        unset($statementHistoricoManutencao44Select);
        unset($resultadoHistoricoManutencao44);
        unset($linhaHistoricoManutencao44);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 34.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico34'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 45;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao45Select = "";
        $strSqlHistoricoManutencao45Select .= "SELECT ";
        $strSqlHistoricoManutencao45Select .= "id, ";
        $strSqlHistoricoManutencao45Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao45Select .= "complemento, ";
        $strSqlHistoricoManutencao45Select .= "descricao ";
        $strSqlHistoricoManutencao45Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao45Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao45Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao45Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao45Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao45Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao45Select);
        
        if ($statementHistoricoManutencao45Select !== false)
        {
            $statementHistoricoManutencao45Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao45 = $dbSistemaConPDO->query($strSqlHistoricoManutencao45Select);
        $resultadoHistoricoManutencao45 = $statementHistoricoManutencao45Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico34Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao45))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao45Acoes" id="formHistoricoManutencao45Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico34Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao45 as $linhaHistoricoManutencao45)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao45['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao45['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao45['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao45['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao45" id="formHistoricoManutencao45" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico34Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico34Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao45Select);
        unset($statementHistoricoManutencao45Select);
        unset($resultadoHistoricoManutencao45);
        unset($linhaHistoricoManutencao45);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 35.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico35'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 46;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao46Select = "";
        $strSqlHistoricoManutencao46Select .= "SELECT ";
        $strSqlHistoricoManutencao46Select .= "id, ";
        $strSqlHistoricoManutencao46Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao46Select .= "complemento, ";
        $strSqlHistoricoManutencao46Select .= "descricao ";
        $strSqlHistoricoManutencao46Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao46Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao46Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao46Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao46Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao46Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao46Select);
        
        if ($statementHistoricoManutencao46Select !== false)
        {
            $statementHistoricoManutencao46Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao46 = $dbSistemaConPDO->query($strSqlHistoricoManutencao46Select);
        $resultadoHistoricoManutencao46 = $statementHistoricoManutencao46Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico35Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao46))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao46Acoes" id="formHistoricoManutencao46Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico35Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao46 as $linhaHistoricoManutencao46)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao46['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao46['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao46['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao46['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao46" id="formHistoricoManutencao46" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico35Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico35Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao46Select);
        unset($statementHistoricoManutencao46Select);
        unset($resultadoHistoricoManutencao46);
        unset($linhaHistoricoManutencao46);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 36.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico36'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 47;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao47Select = "";
        $strSqlHistoricoManutencao47Select .= "SELECT ";
        $strSqlHistoricoManutencao47Select .= "id, ";
        $strSqlHistoricoManutencao47Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao47Select .= "complemento, ";
        $strSqlHistoricoManutencao47Select .= "descricao ";
        $strSqlHistoricoManutencao47Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao47Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao47Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao47Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao47Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao47Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao47Select);
        
        if ($statementHistoricoManutencao47Select !== false)
        {
            $statementHistoricoManutencao47Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao47 = $dbSistemaConPDO->query($strSqlHistoricoManutencao47Select);
        $resultadoHistoricoManutencao47 = $statementHistoricoManutencao47Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico36Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao47))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao47Acoes" id="formHistoricoManutencao47Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico36Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao47 as $linhaHistoricoManutencao47)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao47['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao47['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao47['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao47['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao47" id="formHistoricoManutencao47" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico36Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico36Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao47Select);
        unset($statementHistoricoManutencao47Select);
        unset($resultadoHistoricoManutencao47);
        unset($linhaHistoricoManutencao47);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 37.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico37'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 48;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao48Select = "";
        $strSqlHistoricoManutencao48Select .= "SELECT ";
        $strSqlHistoricoManutencao48Select .= "id, ";
        $strSqlHistoricoManutencao48Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao48Select .= "complemento, ";
        $strSqlHistoricoManutencao48Select .= "descricao ";
        $strSqlHistoricoManutencao48Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao48Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao48Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao48Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao48Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao48Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao48Select);
        
        if ($statementHistoricoManutencao48Select !== false)
        {
            $statementHistoricoManutencao48Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao48 = $dbSistemaConPDO->query($strSqlHistoricoManutencao48Select);
        $resultadoHistoricoManutencao48 = $statementHistoricoManutencao48Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico37Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao48))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao48Acoes" id="formHistoricoManutencao48Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico37Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao48 as $linhaHistoricoManutencao48)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao48['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao48['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao48['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao48['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao48" id="formHistoricoManutencao48" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico37Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico37Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao48Select);
        unset($statementHistoricoManutencao48Select);
        unset($resultadoHistoricoManutencao48);
        unset($linhaHistoricoManutencao48);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 38.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico38'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 49;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao49Select = "";
        $strSqlHistoricoManutencao49Select .= "SELECT ";
        $strSqlHistoricoManutencao49Select .= "id, ";
        $strSqlHistoricoManutencao49Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao49Select .= "complemento, ";
        $strSqlHistoricoManutencao49Select .= "descricao ";
        $strSqlHistoricoManutencao49Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao49Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao49Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao49Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao49Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao49Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao49Select);
        
        if ($statementHistoricoManutencao49Select !== false)
        {
            $statementHistoricoManutencao49Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao49 = $dbSistemaConPDO->query($strSqlHistoricoManutencao49Select);
        $resultadoHistoricoManutencao49 = $statementHistoricoManutencao49Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico38Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao49))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao49Acoes" id="formHistoricoManutencao49Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico38Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao49 as $linhaHistoricoManutencao49)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao49['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao49['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao49['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao49['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao49" id="formHistoricoManutencao49" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico38Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico38Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao49Select);
        unset($statementHistoricoManutencao49Select);
        unset($resultadoHistoricoManutencao49);
        unset($linhaHistoricoManutencao49);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 39.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico39'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 50;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao50Select = "";
        $strSqlHistoricoManutencao50Select .= "SELECT ";
        $strSqlHistoricoManutencao50Select .= "id, ";
        $strSqlHistoricoManutencao50Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao50Select .= "complemento, ";
        $strSqlHistoricoManutencao50Select .= "descricao ";
        $strSqlHistoricoManutencao50Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao50Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao50Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao50Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao50Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao50Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao50Select);
        
        if ($statementHistoricoManutencao50Select !== false)
        {
            $statementHistoricoManutencao50Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao50 = $dbSistemaConPDO->query($strSqlHistoricoManutencao50Select);
        $resultadoHistoricoManutencao50 = $statementHistoricoManutencao50Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico39Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao50))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao50Acoes" id="formHistoricoManutencao50Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico39Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao50 as $linhaHistoricoManutencao50)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao50['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao50['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao50['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao50['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao50" id="formHistoricoManutencao50" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico39Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico39Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao50Select);
        unset($statementHistoricoManutencao50Select);
        unset($resultadoHistoricoManutencao50);
        unset($linhaHistoricoManutencao50);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 40.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico40'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 51;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao51Select = "";
        $strSqlHistoricoManutencao51Select .= "SELECT ";
        $strSqlHistoricoManutencao51Select .= "id, ";
        $strSqlHistoricoManutencao51Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao51Select .= "complemento, ";
        $strSqlHistoricoManutencao51Select .= "descricao ";
        $strSqlHistoricoManutencao51Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao51Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao51Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao51Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao51Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao51Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao51Select);
        
        if ($statementHistoricoManutencao51Select !== false)
        {
            $statementHistoricoManutencao51Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao51 = $dbSistemaConPDO->query($strSqlHistoricoManutencao51Select);
        $resultadoHistoricoManutencao51 = $statementHistoricoManutencao51Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico40Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao51))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao51Acoes" id="formHistoricoManutencao51Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico40Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao51 as $linhaHistoricoManutencao51)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao51['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao51['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao51['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao51['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao51" id="formHistoricoManutencao51" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico40Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico40Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao51Select);
        unset($statementHistoricoManutencao51Select);
        unset($resultadoHistoricoManutencao51);
        unset($linhaHistoricoManutencao51);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>
    
    
	<?php //Historico - Filtro Genérico 41.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico41'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 52;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao52Select = "";
        $strSqlHistoricoManutencao52Select .= "SELECT ";
        $strSqlHistoricoManutencao52Select .= "id, ";
        $strSqlHistoricoManutencao52Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao52Select .= "complemento, ";
        $strSqlHistoricoManutencao52Select .= "descricao ";
        $strSqlHistoricoManutencao52Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao52Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao52Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao52Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao52Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao52Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao52Select);
        
        if ($statementHistoricoManutencao52Select !== false)
        {
            $statementHistoricoManutencao52Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao52 = $dbSistemaConPDO->query($strSqlHistoricoManutencao52Select);
        $resultadoHistoricoManutencao52 = $statementHistoricoManutencao52Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico41Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao52))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao52Acoes" id="formHistoricoManutencao52Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico41Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao52 as $linhaHistoricoManutencao52)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao52['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao52['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao52['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao52['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao52" id="formHistoricoManutencao52" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico41Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico41Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao52Select);
        unset($statementHistoricoManutencao52Select);
        unset($resultadoHistoricoManutencao52);
        unset($linhaHistoricoManutencao52);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 42.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico42'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 53;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao53Select = "";
        $strSqlHistoricoManutencao53Select .= "SELECT ";
        $strSqlHistoricoManutencao53Select .= "id, ";
        $strSqlHistoricoManutencao53Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao53Select .= "complemento, ";
        $strSqlHistoricoManutencao53Select .= "descricao ";
        $strSqlHistoricoManutencao53Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao53Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao53Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao53Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao53Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao53Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao53Select);
        
        if ($statementHistoricoManutencao53Select !== false)
        {
            $statementHistoricoManutencao53Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao53 = $dbSistemaConPDO->query($strSqlHistoricoManutencao53Select);
        $resultadoHistoricoManutencao53 = $statementHistoricoManutencao53Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico42Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao53))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao53Acoes" id="formHistoricoManutencao53Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico42Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao53 as $linhaHistoricoManutencao53)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao53['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao53['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao53['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao53['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao53" id="formHistoricoManutencao53" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico42Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico42Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao53Select);
        unset($statementHistoricoManutencao53Select);
        unset($resultadoHistoricoManutencao53);
        unset($linhaHistoricoManutencao53);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 43.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico43'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 54;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao54Select = "";
        $strSqlHistoricoManutencao54Select .= "SELECT ";
        $strSqlHistoricoManutencao54Select .= "id, ";
        $strSqlHistoricoManutencao54Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao54Select .= "complemento, ";
        $strSqlHistoricoManutencao54Select .= "descricao ";
        $strSqlHistoricoManutencao54Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao54Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao54Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao54Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao54Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao54Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao54Select);
        
        if ($statementHistoricoManutencao54Select !== false)
        {
            $statementHistoricoManutencao54Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao54 = $dbSistemaConPDO->query($strSqlHistoricoManutencao54Select);
        $resultadoHistoricoManutencao54 = $statementHistoricoManutencao54Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico43Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao54))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao54Acoes" id="formHistoricoManutencao54Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico43Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao54 as $linhaHistoricoManutencao54)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao54['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao54['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao54['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao54['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao54" id="formHistoricoManutencao54" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico43Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico43Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao54Select);
        unset($statementHistoricoManutencao54Select);
        unset($resultadoHistoricoManutencao54);
        unset($linhaHistoricoManutencao54);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 44.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico44'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 55;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao55Select = "";
        $strSqlHistoricoManutencao55Select .= "SELECT ";
        $strSqlHistoricoManutencao55Select .= "id, ";
        $strSqlHistoricoManutencao55Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao55Select .= "complemento, ";
        $strSqlHistoricoManutencao55Select .= "descricao ";
        $strSqlHistoricoManutencao55Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao55Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao55Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao55Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao55Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao55Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao55Select);
        
        if ($statementHistoricoManutencao55Select !== false)
        {
            $statementHistoricoManutencao55Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao55 = $dbSistemaConPDO->query($strSqlHistoricoManutencao55Select);
        $resultadoHistoricoManutencao55 = $statementHistoricoManutencao55Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico44Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao55))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao55Acoes" id="formHistoricoManutencao55Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico44Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao55 as $linhaHistoricoManutencao55)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao55['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao55['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao55['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao55['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao55" id="formHistoricoManutencao55" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico44Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico44Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao55Select);
        unset($statementHistoricoManutencao55Select);
        unset($resultadoHistoricoManutencao55);
        unset($linhaHistoricoManutencao55);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 45.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico45'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 56;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao56Select = "";
        $strSqlHistoricoManutencao56Select .= "SELECT ";
        $strSqlHistoricoManutencao56Select .= "id, ";
        $strSqlHistoricoManutencao56Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao56Select .= "complemento, ";
        $strSqlHistoricoManutencao56Select .= "descricao ";
        $strSqlHistoricoManutencao56Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao56Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao56Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao56Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao56Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao56Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao56Select);
        
        if ($statementHistoricoManutencao56Select !== false)
        {
            $statementHistoricoManutencao56Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao56 = $dbSistemaConPDO->query($strSqlHistoricoManutencao56Select);
        $resultadoHistoricoManutencao56 = $statementHistoricoManutencao56Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico45Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao56))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao56Acoes" id="formHistoricoManutencao56Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico45Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao56 as $linhaHistoricoManutencao56)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao56['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao56['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao56['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao56['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao56" id="formHistoricoManutencao56" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico45Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico45Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao56Select);
        unset($statementHistoricoManutencao56Select);
        unset($resultadoHistoricoManutencao56);
        unset($linhaHistoricoManutencao56);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 46.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico46'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 57;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao57Select = "";
        $strSqlHistoricoManutencao57Select .= "SELECT ";
        $strSqlHistoricoManutencao57Select .= "id, ";
        $strSqlHistoricoManutencao57Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao57Select .= "complemento, ";
        $strSqlHistoricoManutencao57Select .= "descricao ";
        $strSqlHistoricoManutencao57Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao57Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao57Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao57Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao57Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao57Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao57Select);
        
        if ($statementHistoricoManutencao57Select !== false)
        {
            $statementHistoricoManutencao57Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao57 = $dbSistemaConPDO->query($strSqlHistoricoManutencao57Select);
        $resultadoHistoricoManutencao57 = $statementHistoricoManutencao57Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico46Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao57))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao57Acoes" id="formHistoricoManutencao57Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico46Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao57 as $linhaHistoricoManutencao57)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao57['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao57['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao57['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao57['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao57" id="formHistoricoManutencao57" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico46Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico46Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao57Select);
        unset($statementHistoricoManutencao57Select);
        unset($resultadoHistoricoManutencao57);
        unset($linhaHistoricoManutencao57);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 47.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico47'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 58;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao58Select = "";
        $strSqlHistoricoManutencao58Select .= "SELECT ";
        $strSqlHistoricoManutencao58Select .= "id, ";
        $strSqlHistoricoManutencao58Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao58Select .= "complemento, ";
        $strSqlHistoricoManutencao58Select .= "descricao ";
        $strSqlHistoricoManutencao58Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao58Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao58Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao58Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao58Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao58Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao58Select);
        
        if ($statementHistoricoManutencao58Select !== false)
        {
            $statementHistoricoManutencao58Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao58 = $dbSistemaConPDO->query($strSqlHistoricoManutencao58Select);
        $resultadoHistoricoManutencao58 = $statementHistoricoManutencao58Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico47Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao58))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao58Acoes" id="formHistoricoManutencao58Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico47Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao58 as $linhaHistoricoManutencao58)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao58['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao58['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao58['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao58['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao58" id="formHistoricoManutencao58" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico47Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico47Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao58Select);
        unset($statementHistoricoManutencao58Select);
        unset($resultadoHistoricoManutencao58);
        unset($linhaHistoricoManutencao58);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 48.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico48'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 59;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao59Select = "";
        $strSqlHistoricoManutencao59Select .= "SELECT ";
        $strSqlHistoricoManutencao59Select .= "id, ";
        $strSqlHistoricoManutencao59Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao59Select .= "complemento, ";
        $strSqlHistoricoManutencao59Select .= "descricao ";
        $strSqlHistoricoManutencao59Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao59Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao59Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao59Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao59Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao59Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao59Select);
        
        if ($statementHistoricoManutencao59Select !== false)
        {
            $statementHistoricoManutencao59Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao59 = $dbSistemaConPDO->query($strSqlHistoricoManutencao59Select);
        $resultadoHistoricoManutencao59 = $statementHistoricoManutencao59Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico48Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao59))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao59Acoes" id="formHistoricoManutencao59Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico48Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao59 as $linhaHistoricoManutencao59)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao59['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao59['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao59['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao59['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao59" id="formHistoricoManutencao59" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico48Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico48Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao59Select);
        unset($statementHistoricoManutencao59Select);
        unset($resultadoHistoricoManutencao59);
        unset($linhaHistoricoManutencao59);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 49.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico49'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 60;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao60Select = "";
        $strSqlHistoricoManutencao60Select .= "SELECT ";
        $strSqlHistoricoManutencao60Select .= "id, ";
        $strSqlHistoricoManutencao60Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao60Select .= "complemento, ";
        $strSqlHistoricoManutencao60Select .= "descricao ";
        $strSqlHistoricoManutencao60Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao60Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao60Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao60Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao60Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao60Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao60Select);
        
        if ($statementHistoricoManutencao60Select !== false)
        {
            $statementHistoricoManutencao60Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao60 = $dbSistemaConPDO->query($strSqlHistoricoManutencao60Select);
        $resultadoHistoricoManutencao60 = $statementHistoricoManutencao60Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico49Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao60))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao60Acoes" id="formHistoricoManutencao60Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico49Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao60 as $linhaHistoricoManutencao60)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao60['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao60['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao60['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao60['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao60" id="formHistoricoManutencao60" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico49Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico49Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao60Select);
        unset($statementHistoricoManutencao60Select);
        unset($resultadoHistoricoManutencao60);
        unset($linhaHistoricoManutencao60);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 50.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico50'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 61;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao61Select = "";
        $strSqlHistoricoManutencao61Select .= "SELECT ";
        $strSqlHistoricoManutencao61Select .= "id, ";
        $strSqlHistoricoManutencao61Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao61Select .= "complemento, ";
        $strSqlHistoricoManutencao61Select .= "descricao ";
        $strSqlHistoricoManutencao61Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao61Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao61Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao61Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao61Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao61Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao61Select);
        
        if ($statementHistoricoManutencao61Select !== false)
        {
            $statementHistoricoManutencao61Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao61 = $dbSistemaConPDO->query($strSqlHistoricoManutencao61Select);
        $resultadoHistoricoManutencao61 = $statementHistoricoManutencao61Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico50Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao61))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao61Acoes" id="formHistoricoManutencao61Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico50Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao61 as $linhaHistoricoManutencao61)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao61['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao61['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao61['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao61['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao61" id="formHistoricoManutencao61" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico50Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico50Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao61Select);
        unset($statementHistoricoManutencao61Select);
        unset($resultadoHistoricoManutencao61);
        unset($linhaHistoricoManutencao61);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>
    
    
	<?php //Historico - Filtro Genérico 51.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico51'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 62;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao62Select = "";
        $strSqlHistoricoManutencao62Select .= "SELECT ";
        $strSqlHistoricoManutencao62Select .= "id, ";
        $strSqlHistoricoManutencao62Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao62Select .= "complemento, ";
        $strSqlHistoricoManutencao62Select .= "descricao ";
        $strSqlHistoricoManutencao62Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao62Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao62Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao62Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao62Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao62Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao62Select);
        
        if ($statementHistoricoManutencao62Select !== false)
        {
            $statementHistoricoManutencao62Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao62 = $dbSistemaConPDO->query($strSqlHistoricoManutencao62Select);
        $resultadoHistoricoManutencao62 = $statementHistoricoManutencao62Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico51Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao62))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao62Acoes" id="formHistoricoManutencao62Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico51Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao62 as $linhaHistoricoManutencao62)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao62['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao62['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao62['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao62['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao62" id="formHistoricoManutencao62" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico51Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico51Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao62Select);
        unset($statementHistoricoManutencao62Select);
        unset($resultadoHistoricoManutencao62);
        unset($linhaHistoricoManutencao62);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 52.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico52'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 63;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao63Select = "";
        $strSqlHistoricoManutencao63Select .= "SELECT ";
        $strSqlHistoricoManutencao63Select .= "id, ";
        $strSqlHistoricoManutencao63Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao63Select .= "complemento, ";
        $strSqlHistoricoManutencao63Select .= "descricao ";
        $strSqlHistoricoManutencao63Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao63Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao63Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao63Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao63Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao63Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao63Select);
        
        if ($statementHistoricoManutencao63Select !== false)
        {
            $statementHistoricoManutencao63Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao63 = $dbSistemaConPDO->query($strSqlHistoricoManutencao63Select);
        $resultadoHistoricoManutencao63 = $statementHistoricoManutencao63Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico52Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao63))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao63Acoes" id="formHistoricoManutencao63Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico52Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao63 as $linhaHistoricoManutencao63)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao63['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao63['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao63['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao63['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao63" id="formHistoricoManutencao63" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico52Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico52Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao63Select);
        unset($statementHistoricoManutencao63Select);
        unset($resultadoHistoricoManutencao63);
        unset($linhaHistoricoManutencao63);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 53.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico53'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 64;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao64Select = "";
        $strSqlHistoricoManutencao64Select .= "SELECT ";
        $strSqlHistoricoManutencao64Select .= "id, ";
        $strSqlHistoricoManutencao64Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao64Select .= "complemento, ";
        $strSqlHistoricoManutencao64Select .= "descricao ";
        $strSqlHistoricoManutencao64Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao64Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao64Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao64Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao64Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao64Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao64Select);
        
        if ($statementHistoricoManutencao64Select !== false)
        {
            $statementHistoricoManutencao64Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao64 = $dbSistemaConPDO->query($strSqlHistoricoManutencao64Select);
        $resultadoHistoricoManutencao64 = $statementHistoricoManutencao64Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico53Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao64))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao64Acoes" id="formHistoricoManutencao64Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico53Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao64 as $linhaHistoricoManutencao64)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao64['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao64['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao64['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao64['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao64" id="formHistoricoManutencao64" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico53Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico53Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao64Select);
        unset($statementHistoricoManutencao64Select);
        unset($resultadoHistoricoManutencao64);
        unset($linhaHistoricoManutencao64);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 54.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico54'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 65;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao65Select = "";
        $strSqlHistoricoManutencao65Select .= "SELECT ";
        $strSqlHistoricoManutencao65Select .= "id, ";
        $strSqlHistoricoManutencao65Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao65Select .= "complemento, ";
        $strSqlHistoricoManutencao65Select .= "descricao ";
        $strSqlHistoricoManutencao65Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao65Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao65Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao65Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao65Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao65Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao65Select);
        
        if ($statementHistoricoManutencao65Select !== false)
        {
            $statementHistoricoManutencao65Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao65 = $dbSistemaConPDO->query($strSqlHistoricoManutencao65Select);
        $resultadoHistoricoManutencao65 = $statementHistoricoManutencao65Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico54Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao65))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao65Acoes" id="formHistoricoManutencao65Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico54Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao65 as $linhaHistoricoManutencao65)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao65['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao65['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao65['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao65['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao65" id="formHistoricoManutencao65" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico54Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico54Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao65Select);
        unset($statementHistoricoManutencao65Select);
        unset($resultadoHistoricoManutencao65);
        unset($linhaHistoricoManutencao65);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 55.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico55'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 66;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao66Select = "";
        $strSqlHistoricoManutencao66Select .= "SELECT ";
        $strSqlHistoricoManutencao66Select .= "id, ";
        $strSqlHistoricoManutencao66Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao66Select .= "complemento, ";
        $strSqlHistoricoManutencao66Select .= "descricao ";
        $strSqlHistoricoManutencao66Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao66Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao66Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao66Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao66Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao66Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao66Select);
        
        if ($statementHistoricoManutencao66Select !== false)
        {
            $statementHistoricoManutencao66Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao66 = $dbSistemaConPDO->query($strSqlHistoricoManutencao66Select);
        $resultadoHistoricoManutencao66 = $statementHistoricoManutencao66Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico55Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao66))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao66Acoes" id="formHistoricoManutencao66Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico55Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao66 as $linhaHistoricoManutencao66)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao66['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao66['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao66['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao66['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao66" id="formHistoricoManutencao66" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico55Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico55Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao66Select);
        unset($statementHistoricoManutencao66Select);
        unset($resultadoHistoricoManutencao66);
        unset($linhaHistoricoManutencao66);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 56.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico56'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 67;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao67Select = "";
        $strSqlHistoricoManutencao67Select .= "SELECT ";
        $strSqlHistoricoManutencao67Select .= "id, ";
        $strSqlHistoricoManutencao67Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao67Select .= "complemento, ";
        $strSqlHistoricoManutencao67Select .= "descricao ";
        $strSqlHistoricoManutencao67Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao67Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao67Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao67Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao67Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao67Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao67Select);
        
        if ($statementHistoricoManutencao67Select !== false)
        {
            $statementHistoricoManutencao67Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao67 = $dbSistemaConPDO->query($strSqlHistoricoManutencao67Select);
        $resultadoHistoricoManutencao67 = $statementHistoricoManutencao67Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico56Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao67))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao67Acoes" id="formHistoricoManutencao67Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico56Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao67 as $linhaHistoricoManutencao67)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao67['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao67['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao67['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao67['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao67" id="formHistoricoManutencao67" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico56Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico56Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao67Select);
        unset($statementHistoricoManutencao67Select);
        unset($resultadoHistoricoManutencao67);
        unset($linhaHistoricoManutencao67);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 57.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico57'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 68;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao68Select = "";
        $strSqlHistoricoManutencao68Select .= "SELECT ";
        $strSqlHistoricoManutencao68Select .= "id, ";
        $strSqlHistoricoManutencao68Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao68Select .= "complemento, ";
        $strSqlHistoricoManutencao68Select .= "descricao ";
        $strSqlHistoricoManutencao68Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao68Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao68Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao68Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao68Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao68Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao68Select);
        
        if ($statementHistoricoManutencao68Select !== false)
        {
            $statementHistoricoManutencao68Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao68 = $dbSistemaConPDO->query($strSqlHistoricoManutencao68Select);
        $resultadoHistoricoManutencao68 = $statementHistoricoManutencao68Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico57Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao68))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao68Acoes" id="formHistoricoManutencao68Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico57Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao68 as $linhaHistoricoManutencao68)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao68['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao68['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao68['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao68['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao68" id="formHistoricoManutencao68" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico57Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico57Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao68Select);
        unset($statementHistoricoManutencao68Select);
        unset($resultadoHistoricoManutencao68);
        unset($linhaHistoricoManutencao68);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 58.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico58'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 69;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao69Select = "";
        $strSqlHistoricoManutencao69Select .= "SELECT ";
        $strSqlHistoricoManutencao69Select .= "id, ";
        $strSqlHistoricoManutencao69Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao69Select .= "complemento, ";
        $strSqlHistoricoManutencao69Select .= "descricao ";
        $strSqlHistoricoManutencao69Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao69Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao69Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao69Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao69Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao69Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao69Select);
        
        if ($statementHistoricoManutencao69Select !== false)
        {
            $statementHistoricoManutencao69Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao69 = $dbSistemaConPDO->query($strSqlHistoricoManutencao69Select);
        $resultadoHistoricoManutencao69 = $statementHistoricoManutencao69Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico58Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao69))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao69Acoes" id="formHistoricoManutencao69Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico58Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao69 as $linhaHistoricoManutencao69)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao69['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao69['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao69['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao69['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao69" id="formHistoricoManutencao69" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico58Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico58Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao69Select);
        unset($statementHistoricoManutencao69Select);
        unset($resultadoHistoricoManutencao69);
        unset($linhaHistoricoManutencao69);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 59.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico59'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 70;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao70Select = "";
        $strSqlHistoricoManutencao70Select .= "SELECT ";
        $strSqlHistoricoManutencao70Select .= "id, ";
        $strSqlHistoricoManutencao70Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao70Select .= "complemento, ";
        $strSqlHistoricoManutencao70Select .= "descricao ";
        $strSqlHistoricoManutencao70Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao70Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao70Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao70Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao70Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao70Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao70Select);
        
        if ($statementHistoricoManutencao70Select !== false)
        {
            $statementHistoricoManutencao70Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao70 = $dbSistemaConPDO->query($strSqlHistoricoManutencao70Select);
        $resultadoHistoricoManutencao70 = $statementHistoricoManutencao70Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico59Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao70))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao70Acoes" id="formHistoricoManutencao70Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico59Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao70 as $linhaHistoricoManutencao70)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao70['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao70['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao70['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao70['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao70" id="formHistoricoManutencao70" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico59Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico59Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao70Select);
        unset($statementHistoricoManutencao70Select);
        unset($resultadoHistoricoManutencao70);
        unset($linhaHistoricoManutencao70);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 60.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico60'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 71;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao71Select = "";
        $strSqlHistoricoManutencao71Select .= "SELECT ";
        $strSqlHistoricoManutencao71Select .= "id, ";
        $strSqlHistoricoManutencao71Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao71Select .= "complemento, ";
        $strSqlHistoricoManutencao71Select .= "descricao ";
        $strSqlHistoricoManutencao71Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao71Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao71Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao71Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao71Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao71Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao71Select);
        
        if ($statementHistoricoManutencao71Select !== false)
        {
            $statementHistoricoManutencao71Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao71 = $dbSistemaConPDO->query($strSqlHistoricoManutencao71Select);
        $resultadoHistoricoManutencao71 = $statementHistoricoManutencao71Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico60Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao71))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao71Acoes" id="formHistoricoManutencao71Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico60Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao71 as $linhaHistoricoManutencao71)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao71['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao71['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao71['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao71['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao71" id="formHistoricoManutencao71" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico60Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico60Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao71Select);
        unset($statementHistoricoManutencao71Select);
        unset($resultadoHistoricoManutencao71);
        unset($linhaHistoricoManutencao71);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>
    
    
    
	<?php //Historico - Filtro Genérico 61.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico61'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 72;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao72Select = "";
        $strSqlHistoricoManutencao72Select .= "SELECT ";
        $strSqlHistoricoManutencao72Select .= "id, ";
        $strSqlHistoricoManutencao72Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao72Select .= "complemento, ";
        $strSqlHistoricoManutencao72Select .= "descricao ";
        $strSqlHistoricoManutencao72Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao72Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao72Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao72Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao72Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao72Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao72Select);
        
        if ($statementHistoricoManutencao72Select !== false)
        {
            $statementHistoricoManutencao72Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao72 = $dbSistemaConPDO->query($strSqlHistoricoManutencao72Select);
        $resultadoHistoricoManutencao72 = $statementHistoricoManutencao72Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico61Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao72))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao72Acoes" id="formHistoricoManutencao72Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico61Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao72 as $linhaHistoricoManutencao72)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao72['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao72['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao72['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao72['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao72" id="formHistoricoManutencao72" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico61Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico61Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao72Select);
        unset($statementHistoricoManutencao72Select);
        unset($resultadoHistoricoManutencao72);
        unset($linhaHistoricoManutencao72);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 62.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico62'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 73;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao73Select = "";
        $strSqlHistoricoManutencao73Select .= "SELECT ";
        $strSqlHistoricoManutencao73Select .= "id, ";
        $strSqlHistoricoManutencao73Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao73Select .= "complemento, ";
        $strSqlHistoricoManutencao73Select .= "descricao ";
        $strSqlHistoricoManutencao73Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao73Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao73Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao73Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao73Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao73Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao73Select);
        
        if ($statementHistoricoManutencao73Select !== false)
        {
            $statementHistoricoManutencao73Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao73 = $dbSistemaConPDO->query($strSqlHistoricoManutencao73Select);
        $resultadoHistoricoManutencao73 = $statementHistoricoManutencao73Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico62Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao73))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao73Acoes" id="formHistoricoManutencao73Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico62Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao73 as $linhaHistoricoManutencao73)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao73['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao73['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao73['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao73['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao73" id="formHistoricoManutencao73" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico62Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico62Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao73Select);
        unset($statementHistoricoManutencao73Select);
        unset($resultadoHistoricoManutencao73);
        unset($linhaHistoricoManutencao73);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 63.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico63'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 74;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao74Select = "";
        $strSqlHistoricoManutencao74Select .= "SELECT ";
        $strSqlHistoricoManutencao74Select .= "id, ";
        $strSqlHistoricoManutencao74Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao74Select .= "complemento, ";
        $strSqlHistoricoManutencao74Select .= "descricao ";
        $strSqlHistoricoManutencao74Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao74Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao74Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao74Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao74Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao74Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao74Select);
        
        if ($statementHistoricoManutencao74Select !== false)
        {
            $statementHistoricoManutencao74Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao74 = $dbSistemaConPDO->query($strSqlHistoricoManutencao74Select);
        $resultadoHistoricoManutencao74 = $statementHistoricoManutencao74Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico63Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao74))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao74Acoes" id="formHistoricoManutencao74Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico63Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao74 as $linhaHistoricoManutencao74)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao74['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao74['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao74['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao74['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao74" id="formHistoricoManutencao74" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico63Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico63Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao74Select);
        unset($statementHistoricoManutencao74Select);
        unset($resultadoHistoricoManutencao74);
        unset($linhaHistoricoManutencao74);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 64.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico64'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 75;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao75Select = "";
        $strSqlHistoricoManutencao75Select .= "SELECT ";
        $strSqlHistoricoManutencao75Select .= "id, ";
        $strSqlHistoricoManutencao75Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao75Select .= "complemento, ";
        $strSqlHistoricoManutencao75Select .= "descricao ";
        $strSqlHistoricoManutencao75Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao75Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao75Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao75Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao75Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao75Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao75Select);
        
        if ($statementHistoricoManutencao75Select !== false)
        {
            $statementHistoricoManutencao75Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao75 = $dbSistemaConPDO->query($strSqlHistoricoManutencao75Select);
        $resultadoHistoricoManutencao75 = $statementHistoricoManutencao75Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico64Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao75))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao75Acoes" id="formHistoricoManutencao75Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico64Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao75 as $linhaHistoricoManutencao75)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao75['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao75['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao75['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao75['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao75" id="formHistoricoManutencao75" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico64Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico64Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao75Select);
        unset($statementHistoricoManutencao75Select);
        unset($resultadoHistoricoManutencao75);
        unset($linhaHistoricoManutencao75);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 65.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico65'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 76;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao76Select = "";
        $strSqlHistoricoManutencao76Select .= "SELECT ";
        $strSqlHistoricoManutencao76Select .= "id, ";
        $strSqlHistoricoManutencao76Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao76Select .= "complemento, ";
        $strSqlHistoricoManutencao76Select .= "descricao ";
        $strSqlHistoricoManutencao76Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao76Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao76Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao76Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao76Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao76Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao76Select);
        
        if ($statementHistoricoManutencao76Select !== false)
        {
            $statementHistoricoManutencao76Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao76 = $dbSistemaConPDO->query($strSqlHistoricoManutencao76Select);
        $resultadoHistoricoManutencao76 = $statementHistoricoManutencao76Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico65Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao76))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao76Acoes" id="formHistoricoManutencao76Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico65Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao76 as $linhaHistoricoManutencao76)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao76['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao76['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao76['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao76['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao76" id="formHistoricoManutencao76" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico65Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico65Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao76Select);
        unset($statementHistoricoManutencao76Select);
        unset($resultadoHistoricoManutencao76);
        unset($linhaHistoricoManutencao76);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 66.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico66'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 77;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao77Select = "";
        $strSqlHistoricoManutencao77Select .= "SELECT ";
        $strSqlHistoricoManutencao77Select .= "id, ";
        $strSqlHistoricoManutencao77Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao77Select .= "complemento, ";
        $strSqlHistoricoManutencao77Select .= "descricao ";
        $strSqlHistoricoManutencao77Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao77Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao77Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao77Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao77Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao77Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao77Select);
        
        if ($statementHistoricoManutencao77Select !== false)
        {
            $statementHistoricoManutencao77Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao77 = $dbSistemaConPDO->query($strSqlHistoricoManutencao77Select);
        $resultadoHistoricoManutencao77 = $statementHistoricoManutencao77Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico66Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao77))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao77Acoes" id="formHistoricoManutencao77Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico66Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao77 as $linhaHistoricoManutencao77)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao77['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao77['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao77['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao77['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao77" id="formHistoricoManutencao77" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico66Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico66Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao77Select);
        unset($statementHistoricoManutencao77Select);
        unset($resultadoHistoricoManutencao77);
        unset($linhaHistoricoManutencao77);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 67.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico67'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 78;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao78Select = "";
        $strSqlHistoricoManutencao78Select .= "SELECT ";
        $strSqlHistoricoManutencao78Select .= "id, ";
        $strSqlHistoricoManutencao78Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao78Select .= "complemento, ";
        $strSqlHistoricoManutencao78Select .= "descricao ";
        $strSqlHistoricoManutencao78Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao78Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao78Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao78Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao78Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao78Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao78Select);
        
        if ($statementHistoricoManutencao78Select !== false)
        {
            $statementHistoricoManutencao78Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao78 = $dbSistemaConPDO->query($strSqlHistoricoManutencao78Select);
        $resultadoHistoricoManutencao78 = $statementHistoricoManutencao78Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico67Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao78))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao78Acoes" id="formHistoricoManutencao78Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico67Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao78 as $linhaHistoricoManutencao78)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao78['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao78['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao78['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao78['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao78" id="formHistoricoManutencao78" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico67Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico67Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao78Select);
        unset($statementHistoricoManutencao78Select);
        unset($resultadoHistoricoManutencao78);
        unset($linhaHistoricoManutencao78);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 68.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico68'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 79;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao79Select = "";
        $strSqlHistoricoManutencao79Select .= "SELECT ";
        $strSqlHistoricoManutencao79Select .= "id, ";
        $strSqlHistoricoManutencao79Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao79Select .= "complemento, ";
        $strSqlHistoricoManutencao79Select .= "descricao ";
        $strSqlHistoricoManutencao79Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao79Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao79Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao79Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao79Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao79Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao79Select);
        
        if ($statementHistoricoManutencao79Select !== false)
        {
            $statementHistoricoManutencao79Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao79 = $dbSistemaConPDO->query($strSqlHistoricoManutencao79Select);
        $resultadoHistoricoManutencao79 = $statementHistoricoManutencao79Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico68Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao79))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao79Acoes" id="formHistoricoManutencao79Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico68Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao79 as $linhaHistoricoManutencao79)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao79['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao79['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao79['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao79['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao79" id="formHistoricoManutencao79" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico68Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico68Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao79Select);
        unset($statementHistoricoManutencao79Select);
        unset($resultadoHistoricoManutencao79);
        unset($linhaHistoricoManutencao79);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 69.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico69'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 80;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao80Select = "";
        $strSqlHistoricoManutencao80Select .= "SELECT ";
        $strSqlHistoricoManutencao80Select .= "id, ";
        $strSqlHistoricoManutencao80Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao80Select .= "complemento, ";
        $strSqlHistoricoManutencao80Select .= "descricao ";
        $strSqlHistoricoManutencao80Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao80Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao80Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao80Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao80Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao80Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao80Select);
        
        if ($statementHistoricoManutencao80Select !== false)
        {
            $statementHistoricoManutencao80Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao80 = $dbSistemaConPDO->query($strSqlHistoricoManutencao80Select);
        $resultadoHistoricoManutencao80 = $statementHistoricoManutencao80Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico69Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao80))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao80Acoes" id="formHistoricoManutencao80Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico69Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao80 as $linhaHistoricoManutencao80)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao80['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao80['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao80['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao80['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao80" id="formHistoricoManutencao80" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico69Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico69Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao80Select);
        unset($statementHistoricoManutencao80Select);
        unset($resultadoHistoricoManutencao80);
        unset($linhaHistoricoManutencao80);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 70.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico70'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 81;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao81Select = "";
        $strSqlHistoricoManutencao81Select .= "SELECT ";
        $strSqlHistoricoManutencao81Select .= "id, ";
        $strSqlHistoricoManutencao81Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao81Select .= "complemento, ";
        $strSqlHistoricoManutencao81Select .= "descricao ";
        $strSqlHistoricoManutencao81Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao81Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao81Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao81Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao81Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao81Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao81Select);
        
        if ($statementHistoricoManutencao81Select !== false)
        {
            $statementHistoricoManutencao81Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao81 = $dbSistemaConPDO->query($strSqlHistoricoManutencao81Select);
        $resultadoHistoricoManutencao81 = $statementHistoricoManutencao81Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico70Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao81))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao81Acoes" id="formHistoricoManutencao81Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico70Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao81 as $linhaHistoricoManutencao81)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao81['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao81['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao81['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao81['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao81" id="formHistoricoManutencao81" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico70Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico70Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao81Select);
        unset($statementHistoricoManutencao81Select);
        unset($resultadoHistoricoManutencao81);
        unset($linhaHistoricoManutencao81);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>
    
    
	<?php //Historico - Filtro Genérico 71.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico71'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 82;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao82Select = "";
        $strSqlHistoricoManutencao82Select .= "SELECT ";
        $strSqlHistoricoManutencao82Select .= "id, ";
        $strSqlHistoricoManutencao82Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao82Select .= "complemento, ";
        $strSqlHistoricoManutencao82Select .= "descricao ";
        $strSqlHistoricoManutencao82Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao82Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao82Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao82Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao82Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao82Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao82Select);
        
        if ($statementHistoricoManutencao82Select !== false)
        {
            $statementHistoricoManutencao82Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao82 = $dbSistemaConPDO->query($strSqlHistoricoManutencao82Select);
        $resultadoHistoricoManutencao82 = $statementHistoricoManutencao82Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico71Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao82))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao82Acoes" id="formHistoricoManutencao82Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico71Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao82 as $linhaHistoricoManutencao82)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao82['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao82['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao82['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao82['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao82" id="formHistoricoManutencao82" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico71Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico71Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao82Select);
        unset($statementHistoricoManutencao82Select);
        unset($resultadoHistoricoManutencao82);
        unset($linhaHistoricoManutencao82);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 72.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico72'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 83;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao83Select = "";
        $strSqlHistoricoManutencao83Select .= "SELECT ";
        $strSqlHistoricoManutencao83Select .= "id, ";
        $strSqlHistoricoManutencao83Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao83Select .= "complemento, ";
        $strSqlHistoricoManutencao83Select .= "descricao ";
        $strSqlHistoricoManutencao83Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao83Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao83Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao83Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao83Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao83Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao83Select);
        
        if ($statementHistoricoManutencao83Select !== false)
        {
            $statementHistoricoManutencao83Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao83 = $dbSistemaConPDO->query($strSqlHistoricoManutencao83Select);
        $resultadoHistoricoManutencao83 = $statementHistoricoManutencao83Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico72Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao83))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao83Acoes" id="formHistoricoManutencao83Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico72Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao83 as $linhaHistoricoManutencao83)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao83['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao83['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao83['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao83['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao83" id="formHistoricoManutencao83" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico72Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico72Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao83Select);
        unset($statementHistoricoManutencao83Select);
        unset($resultadoHistoricoManutencao83);
        unset($linhaHistoricoManutencao83);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 73.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico73'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 84;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao84Select = "";
        $strSqlHistoricoManutencao84Select .= "SELECT ";
        $strSqlHistoricoManutencao84Select .= "id, ";
        $strSqlHistoricoManutencao84Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao84Select .= "complemento, ";
        $strSqlHistoricoManutencao84Select .= "descricao ";
        $strSqlHistoricoManutencao84Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao84Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao84Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao84Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao84Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao84Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao84Select);
        
        if ($statementHistoricoManutencao84Select !== false)
        {
            $statementHistoricoManutencao84Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao84 = $dbSistemaConPDO->query($strSqlHistoricoManutencao84Select);
        $resultadoHistoricoManutencao84 = $statementHistoricoManutencao84Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico73Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao84))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao84Acoes" id="formHistoricoManutencao84Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico73Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao84 as $linhaHistoricoManutencao84)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao84['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao84['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao84['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao84['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao84" id="formHistoricoManutencao84" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico73Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico73Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao84Select);
        unset($statementHistoricoManutencao84Select);
        unset($resultadoHistoricoManutencao84);
        unset($linhaHistoricoManutencao84);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 74.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico74'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 85;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao85Select = "";
        $strSqlHistoricoManutencao85Select .= "SELECT ";
        $strSqlHistoricoManutencao85Select .= "id, ";
        $strSqlHistoricoManutencao85Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao85Select .= "complemento, ";
        $strSqlHistoricoManutencao85Select .= "descricao ";
        $strSqlHistoricoManutencao85Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao85Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao85Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao85Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao85Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao85Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao85Select);
        
        if ($statementHistoricoManutencao85Select !== false)
        {
            $statementHistoricoManutencao85Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao85 = $dbSistemaConPDO->query($strSqlHistoricoManutencao85Select);
        $resultadoHistoricoManutencao85 = $statementHistoricoManutencao85Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico74Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao85))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao85Acoes" id="formHistoricoManutencao85Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico74Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao85 as $linhaHistoricoManutencao85)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao85['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao85['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao85['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao85['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao85" id="formHistoricoManutencao85" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico74Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico74Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao85Select);
        unset($statementHistoricoManutencao85Select);
        unset($resultadoHistoricoManutencao85);
        unset($linhaHistoricoManutencao85);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 75.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico75'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 86;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao86Select = "";
        $strSqlHistoricoManutencao86Select .= "SELECT ";
        $strSqlHistoricoManutencao86Select .= "id, ";
        $strSqlHistoricoManutencao86Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao86Select .= "complemento, ";
        $strSqlHistoricoManutencao86Select .= "descricao ";
        $strSqlHistoricoManutencao86Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao86Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao86Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao86Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao86Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao86Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao86Select);
        
        if ($statementHistoricoManutencao86Select !== false)
        {
            $statementHistoricoManutencao86Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao86 = $dbSistemaConPDO->query($strSqlHistoricoManutencao86Select);
        $resultadoHistoricoManutencao86 = $statementHistoricoManutencao86Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico75Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao86))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao86Acoes" id="formHistoricoManutencao86Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico75Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao86 as $linhaHistoricoManutencao86)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao86['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao86['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao86['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao86['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao86" id="formHistoricoManutencao86" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico75Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico75Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao86Select);
        unset($statementHistoricoManutencao86Select);
        unset($resultadoHistoricoManutencao86);
        unset($linhaHistoricoManutencao86);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 76.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico76'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 87;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao87Select = "";
        $strSqlHistoricoManutencao87Select .= "SELECT ";
        $strSqlHistoricoManutencao87Select .= "id, ";
        $strSqlHistoricoManutencao87Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao87Select .= "complemento, ";
        $strSqlHistoricoManutencao87Select .= "descricao ";
        $strSqlHistoricoManutencao87Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao87Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao87Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao87Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao87Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao87Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao87Select);
        
        if ($statementHistoricoManutencao87Select !== false)
        {
            $statementHistoricoManutencao87Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao87 = $dbSistemaConPDO->query($strSqlHistoricoManutencao87Select);
        $resultadoHistoricoManutencao87 = $statementHistoricoManutencao87Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico76Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao87))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao87Acoes" id="formHistoricoManutencao87Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico76Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao87 as $linhaHistoricoManutencao87)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao87['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao87['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao87['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao87['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao87" id="formHistoricoManutencao87" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico76Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico76Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao87Select);
        unset($statementHistoricoManutencao87Select);
        unset($resultadoHistoricoManutencao87);
        unset($linhaHistoricoManutencao87);
        //----------

        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 77.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico77'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 88;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao88Select = "";
        $strSqlHistoricoManutencao88Select .= "SELECT ";
        $strSqlHistoricoManutencao88Select .= "id, ";
        $strSqlHistoricoManutencao88Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao88Select .= "complemento, ";
        $strSqlHistoricoManutencao88Select .= "descricao ";
        $strSqlHistoricoManutencao88Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao88Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao88Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao88Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao88Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao88Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao88Select);
        
        if ($statementHistoricoManutencao88Select !== false)
        {
            $statementHistoricoManutencao88Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao88 = $dbSistemaConPDO->query($strSqlHistoricoManutencao88Select);
        $resultadoHistoricoManutencao88 = $statementHistoricoManutencao88Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico77Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao88))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao88Acoes" id="formHistoricoManutencao88Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico77Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao88 as $linhaHistoricoManutencao88)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao88['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao88['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao88['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao88['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao88" id="formHistoricoManutencao88" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico77Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico77Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao88Select);
        unset($statementHistoricoManutencao88Select);
        unset($resultadoHistoricoManutencao88);
        unset($linhaHistoricoManutencao88);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 78.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico78'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 89;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao89Select = "";
        $strSqlHistoricoManutencao89Select .= "SELECT ";
        $strSqlHistoricoManutencao89Select .= "id, ";
        $strSqlHistoricoManutencao89Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao89Select .= "complemento, ";
        $strSqlHistoricoManutencao89Select .= "descricao ";
        $strSqlHistoricoManutencao89Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao89Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao89Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao89Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao89Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao89Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao89Select);
        
        if ($statementHistoricoManutencao89Select !== false)
        {
            $statementHistoricoManutencao89Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao89 = $dbSistemaConPDO->query($strSqlHistoricoManutencao89Select);
        $resultadoHistoricoManutencao89 = $statementHistoricoManutencao89Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico78Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao89))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao89Acoes" id="formHistoricoManutencao89Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico78Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao89 as $linhaHistoricoManutencao89)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao89['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao89['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao89['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao89['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao89" id="formHistoricoManutencao89" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico78Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico78Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao89Select);
        unset($statementHistoricoManutencao89Select);
        unset($resultadoHistoricoManutencao89);
        unset($linhaHistoricoManutencao89);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 79.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico79'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 90;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao90Select = "";
        $strSqlHistoricoManutencao90Select .= "SELECT ";
        $strSqlHistoricoManutencao90Select .= "id, ";
        $strSqlHistoricoManutencao90Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao90Select .= "complemento, ";
        $strSqlHistoricoManutencao90Select .= "descricao ";
        $strSqlHistoricoManutencao90Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao90Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao90Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao90Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao90Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao90Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao90Select);
        
        if ($statementHistoricoManutencao90Select !== false)
        {
            $statementHistoricoManutencao90Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao90 = $dbSistemaConPDO->query($strSqlHistoricoManutencao90Select);
        $resultadoHistoricoManutencao90 = $statementHistoricoManutencao90Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico79Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao90))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao90Acoes" id="formHistoricoManutencao90Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico79Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao90 as $linhaHistoricoManutencao90)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao90['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao90['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao90['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao90['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao90" id="formHistoricoManutencao90" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico79Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico79Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao90Select);
        unset($statementHistoricoManutencao90Select);
        unset($resultadoHistoricoManutencao90);
        unset($linhaHistoricoManutencao90);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Historico - Filtro Genérico 80.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarHistoricoFiltroGenerico80'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 91;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencao91Select = "";
        $strSqlHistoricoManutencao91Select .= "SELECT ";
        $strSqlHistoricoManutencao91Select .= "id, ";
        $strSqlHistoricoManutencao91Select .= "tipo_complemento, ";
        $strSqlHistoricoManutencao91Select .= "complemento, ";
        $strSqlHistoricoManutencao91Select .= "descricao ";
        $strSqlHistoricoManutencao91Select .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencao91Select .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencao91Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencao91Select .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencao91Select .= "ORDER BY complemento";
        
        $statementHistoricoManutencao91Select = $dbSistemaConPDO->prepare($strSqlHistoricoManutencao91Select);
        
        if ($statementHistoricoManutencao91Select !== false)
        {
            $statementHistoricoManutencao91Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao91 = $dbSistemaConPDO->query($strSqlHistoricoManutencao91Select);
        $resultadoHistoricoManutencao91 = $statementHistoricoManutencao91Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico80Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoHistoricoManutencao91))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencao91Acoes" id="formHistoricoManutencao91Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico80Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoHistoricoManutencao91 as $linhaHistoricoManutencao91)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoManutencao91['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao91['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao91['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao91['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao91" id="formHistoricoManutencao91" action="HistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico80Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico80Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
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
        unset($strSqlHistoricoManutencao91Select);
        unset($statementHistoricoManutencao91Select);
        unset($resultadoHistoricoManutencao91);
        unset($linhaHistoricoManutencao91);
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
//unset($strSqlHistoricoManutencao1Select);
//unset($statementHistoricoManutencao1Select);
//unset($resultadoHistoricoManutencao1);
//unset($linhaHistoricoManutencao1);
//----------
?>


<?php 
//Inclusão do template do layout.
include_once $page->LayoutSistema;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>