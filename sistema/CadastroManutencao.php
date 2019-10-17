<?php
//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeLayout.php";


//Verificação de login Master.
LoginAutenticacao::UsuarioLoginVerificacao();


//Resgate de variáveis.
$paginaRetorno = "CadastroManutencao.php";
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
    	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroManutencaoTitulo"); ?>
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
    
	<?php //Tipo Cadastro.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarCadastroTipo'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 1;
		
        //Query de pesquisa.
        //----------
        $strSqlCadastroManutencao1Select = "";
        $strSqlCadastroManutencao1Select .= "SELECT ";
        $strSqlCadastroManutencao1Select .= "id, ";
        $strSqlCadastroManutencao1Select .= "tipo_complemento, ";
        $strSqlCadastroManutencao1Select .= "complemento, ";
        $strSqlCadastroManutencao1Select .= "descricao ";
        $strSqlCadastroManutencao1Select .= "FROM tb_cadastro_complemento ";
        $strSqlCadastroManutencao1Select .= "WHERE id <> 0 ";
        $strSqlCadastroManutencao1Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlCadastroManutencao1Select .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
        $strSqlCadastroManutencao1Select .= "ORDER BY complemento";
        
        $statementCadastroManutencao1Select = $dbSistemaConPDO->prepare($strSqlCadastroManutencao1Select);
        
        if ($statementCadastroManutencao1Select !== false)
        {
            $statementCadastroManutencao1Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoCadastroManutencao1 = $dbSistemaConPDO->query($strSqlCadastroManutencao1Select);
        $resultadoCadastroManutencao1 = $statementCadastroManutencao1Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroTipo"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoCadastroManutencao1))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formCadastroManutencao1Acoes" id="formCadastroManutencao1Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_cadastro_complemento" />
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
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroTipo"); ?>
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
                foreach($resultadoCadastroManutencao1 as $linhaCadastroManutencao1)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaCadastroManutencao1['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastroManutencao1['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="CadastroManutencaoEditar.php?idTbCadastroComplemento=<?php echo $linhaCadastroManutencao1['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaCadastroManutencao1['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formCadastroManutencao1" id="formCadastroManutencao1" action="CadastroManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroManutencaoTbTipo"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroTipo"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroManutencaoDescricao"); ?>:
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
        unset($strSqlCadastroManutencao1Select);
        unset($statementCadastroManutencao1Select);
        unset($resultadoCadastroManutencao1);
        unset($linhaCadastroManutencao1);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>
    
    
	<?php //Atividades.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarCadastroAtividades'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 2;
		
        //Query de pesquisa.
        //----------
        $strSqlCadastroManutencao2Select = "";
        $strSqlCadastroManutencao2Select .= "SELECT ";
        $strSqlCadastroManutencao2Select .= "id, ";
        $strSqlCadastroManutencao2Select .= "tipo_complemento, ";
        $strSqlCadastroManutencao2Select .= "complemento, ";
        $strSqlCadastroManutencao2Select .= "descricao ";
        $strSqlCadastroManutencao2Select .= "FROM tb_cadastro_complemento ";
        $strSqlCadastroManutencao2Select .= "WHERE id <> 0 ";
        $strSqlCadastroManutencao2Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlCadastroManutencao2Select .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
        $strSqlCadastroManutencao2Select .= "ORDER BY complemento";
        
        $statementCadastroManutencao2Select = $dbSistemaConPDO->prepare($strSqlCadastroManutencao2Select);
        
        if ($statementCadastroManutencao2Select !== false)
        {
            $statementCadastroManutencao2Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoCadastroManutencao2 = $dbSistemaConPDO->query($strSqlCadastroManutencao2Select);
        $resultadoCadastroManutencao2 = $statementCadastroManutencao2Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroAtividades"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoCadastroManutencao2))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formCadastroManutencao2Acoes" id="formCadastroManutencao2Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_cadastro_complemento" />
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
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroAtividades"); ?>
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
                foreach($resultadoCadastroManutencao2 as $linhaCadastroManutencao2)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaCadastroManutencao2['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastroManutencao2['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="CadastroManutencaoEditar.php?idTbCadastroComplemento=<?php echo $linhaCadastroManutencao2['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaCadastroManutencao2['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formCadastroManutencao2" id="formCadastroManutencao2" action="CadastroManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroManutencaoTbAtividades"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroAtividades"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroManutencaoDescricao"); ?>:
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
        unset($strSqlCadastroManutencao2Select);
        unset($statementCadastroManutencao2Select);
        unset($resultadoCadastroManutencao2);
        unset($linhaCadastroManutencao2);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>
    
    
	<?php //Status.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarCadastroStatus'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 3;
		
        //Query de pesquisa.
        //----------
        $strSqlCadastroManutencao3Select = "";
        $strSqlCadastroManutencao3Select .= "SELECT ";
        $strSqlCadastroManutencao3Select .= "id, ";
        $strSqlCadastroManutencao3Select .= "tipo_complemento, ";
        $strSqlCadastroManutencao3Select .= "complemento, ";
        $strSqlCadastroManutencao3Select .= "descricao ";
        $strSqlCadastroManutencao3Select .= "FROM tb_cadastro_complemento ";
        $strSqlCadastroManutencao3Select .= "WHERE id <> 0 ";
        $strSqlCadastroManutencao3Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlCadastroManutencao3Select .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
        $strSqlCadastroManutencao3Select .= "ORDER BY complemento";
        
        $statementCadastroManutencao3Select = $dbSistemaConPDO->prepare($strSqlCadastroManutencao3Select);
        
        if ($statementCadastroManutencao3Select !== false)
        {
            $statementCadastroManutencao3Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoCadastroManutencao3 = $dbSistemaConPDO->query($strSqlCadastroManutencao3Select);
        $resultadoCadastroManutencao3 = $statementCadastroManutencao3Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroStatus"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoCadastroManutencao3))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formCadastroManutencao3Acoes" id="formCadastroManutencao3Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_cadastro_complemento" />
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
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroStatus"); ?>
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
                foreach($resultadoCadastroManutencao3 as $linhaCadastroManutencao3)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaCadastroManutencao3['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastroManutencao3['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="CadastroManutencaoEditar.php?idTbCadastroComplemento=<?php echo $linhaCadastroManutencao3['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaCadastroManutencao3['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formCadastroManutencao3" id="formCadastroManutencao3" action="CadastroManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroManutencaoTbStatus"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroStatus"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroManutencaoDescricao"); ?>:
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
        unset($strSqlCadastroManutencao3Select);
        unset($statementCadastroManutencao3Select);
        unset($resultadoCadastroManutencao3);
        unset($linhaCadastroManutencao3);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>
    
    
	<?php //Histórico - Status.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarCadastroHistoricoStatus'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 4;
		
        //Query de pesquisa.
        //----------
        $strSqlCadastroManutencao4Select = "";
        $strSqlCadastroManutencao4Select .= "SELECT ";
        $strSqlCadastroManutencao4Select .= "id, ";
        $strSqlCadastroManutencao4Select .= "tipo_complemento, ";
        $strSqlCadastroManutencao4Select .= "complemento, ";
        $strSqlCadastroManutencao4Select .= "descricao ";
        $strSqlCadastroManutencao4Select .= "FROM tb_cadastro_complemento ";
        $strSqlCadastroManutencao4Select .= "WHERE id <> 0 ";
        $strSqlCadastroManutencao4Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlCadastroManutencao4Select .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
        $strSqlCadastroManutencao4Select .= "ORDER BY complemento";
        
        $statementCadastroManutencao4Select = $dbSistemaConPDO->prepare($strSqlCadastroManutencao4Select);
        
        if ($statementCadastroManutencao4Select !== false)
        {
            $statementCadastroManutencao4Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoCadastroManutencao4 = $dbSistemaConPDO->query($strSqlCadastroManutencao4Select);
        $resultadoCadastroManutencao4 = $statementCadastroManutencao4Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoStatus"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoCadastroManutencao4))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formCadastroManutencao4Acoes" id="formCadastroManutencao4Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_cadastro_complemento" />
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
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoStatus"); ?>
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
                foreach($resultadoCadastroManutencao4 as $linhaCadastroManutencao4)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaCadastroManutencao4['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastroManutencao4['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="CadastroManutencaoEditar.php?idTbCadastroComplemento=<?php echo $linhaCadastroManutencao4['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaCadastroManutencao4['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formCadastroManutencao4" id="formCadastroManutencao4" action="CadastroManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoTbStatus"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoStatus"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroManutencaoDescricao"); ?>:
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
        unset($strSqlCadastroManutencao4Select);
        unset($statementCadastroManutencao4Select);
        unset($resultadoCadastroManutencao4);
        unset($linhaCadastroManutencao4);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>
    
	<?php //Tarefas - Status.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarTarefasStatus'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 9;
		
        //Query de pesquisa.
        //----------
        $strSqlCadastroManutencao9Select = "";
        $strSqlCadastroManutencao9Select .= "SELECT ";
        $strSqlCadastroManutencao9Select .= "id, ";
        $strSqlCadastroManutencao9Select .= "tipo_complemento, ";
        $strSqlCadastroManutencao9Select .= "complemento, ";
        $strSqlCadastroManutencao9Select .= "descricao ";
        $strSqlCadastroManutencao9Select .= "FROM tb_cadastro_complemento ";
        $strSqlCadastroManutencao9Select .= "WHERE id <> 0 ";
        $strSqlCadastroManutencao9Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlCadastroManutencao9Select .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
        $strSqlCadastroManutencao9Select .= "ORDER BY complemento";
        
        $statementCadastroManutencao9Select = $dbSistemaConPDO->prepare($strSqlCadastroManutencao9Select);
        
        if ($statementCadastroManutencao9Select !== false)
        {
            $statementCadastroManutencao9Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoCadastroManutencao9 = $dbSistemaConPDO->query($strSqlCadastroManutencao9Select);
        $resultadoCadastroManutencao9 = $statementCadastroManutencao9Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaTarefasStatus"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoCadastroManutencao9))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formCadastroManutencao9Acoes" id="formCadastroManutencao9Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_cadastro_complemento" />
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
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaTarefasStatus"); ?>
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
                foreach($resultadoCadastroManutencao9 as $linhaCadastroManutencao9)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaCadastroManutencao9['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastroManutencao9['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="CadastroManutencaoEditar.php?idTbCadastroComplemento=<?php echo $linhaCadastroManutencao9['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaCadastroManutencao9['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formCadastroManutencao9" id="formCadastroManutencao9" action="CadastroManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaTarefasManutencaoTbStatus"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaTarefasStatus"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroManutencaoDescricao"); ?>:
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
        unset($strSqlCadastroManutencao9Select);
        unset($statementCadastroManutencao9Select);
        unset($resultadoCadastroManutencao9);
        unset($linhaCadastroManutencao9);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>
    
    
	<?php //Pedidos - Status.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarAdministrarPedidosStatus'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 11;
		
        //Query de pesquisa.
        //----------
        $strSqlCadastroManutencao11Select = "";
        $strSqlCadastroManutencao11Select .= "SELECT ";
        $strSqlCadastroManutencao11Select .= "id, ";
        $strSqlCadastroManutencao11Select .= "tipo_complemento, ";
        $strSqlCadastroManutencao11Select .= "complemento, ";
        $strSqlCadastroManutencao11Select .= "descricao ";
        $strSqlCadastroManutencao11Select .= "FROM tb_cadastro_complemento ";
        $strSqlCadastroManutencao11Select .= "WHERE id <> 0 ";
        $strSqlCadastroManutencao11Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlCadastroManutencao11Select .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
        $strSqlCadastroManutencao11Select .= "ORDER BY complemento";
        
        $statementCadastroManutencao11Select = $dbSistemaConPDO->prepare($strSqlCadastroManutencao11Select);
        
        if ($statementCadastroManutencao11Select !== false)
        {
            $statementCadastroManutencao11Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoCadastroManutencao11 = $dbSistemaConPDO->query($strSqlCadastroManutencao11Select);
        $resultadoCadastroManutencao11 = $statementCadastroManutencao11Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPedidosStatus"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoCadastroManutencao11))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formCadastroManutencao11Acoes" id="formCadastroManutencao11Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_cadastro_complemento" />
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
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPedidosStatus"); ?>
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
                foreach($resultadoCadastroManutencao11 as $linhaCadastroManutencao11)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaCadastroManutencao11['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastroManutencao11['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="CadastroManutencaoEditar.php?idTbCadastroComplemento=<?php echo $linhaCadastroManutencao11['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaCadastroManutencao11['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formCadastroManutencao11" id="formCadastroManutencao11" action="CadastroManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPedidosManutencaoTbStatus"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPedidosStatus"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroManutencaoDescricao"); ?>:
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
        unset($strSqlCadastroManutencao11Select);
        unset($statementCadastroManutencao11Select);
        unset($resultadoCadastroManutencao11);
        unset($linhaCadastroManutencao11);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Cadastro - Filtro Genérico 01.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarCadastroFiltroGenerico01'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 12;
		
        //Query de pesquisa.
        //----------
        $strSqlCadastroManutencao12Select = "";
        $strSqlCadastroManutencao12Select .= "SELECT ";
        $strSqlCadastroManutencao12Select .= "id, ";
        $strSqlCadastroManutencao12Select .= "tipo_complemento, ";
        $strSqlCadastroManutencao12Select .= "complemento, ";
        $strSqlCadastroManutencao12Select .= "descricao ";
        $strSqlCadastroManutencao12Select .= "FROM tb_cadastro_complemento ";
        $strSqlCadastroManutencao12Select .= "WHERE id <> 0 ";
        $strSqlCadastroManutencao12Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlCadastroManutencao12Select .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
        $strSqlCadastroManutencao12Select .= "ORDER BY complemento";
        
        $statementCadastroManutencao12Select = $dbSistemaConPDO->prepare($strSqlCadastroManutencao12Select);
        
        if ($statementCadastroManutencao12Select !== false)
        {
            $statementCadastroManutencao12Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoCadastroManutencao12 = $dbSistemaConPDO->query($strSqlCadastroManutencao12Select);
        $resultadoCadastroManutencao12 = $statementCadastroManutencao12Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico01Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoCadastroManutencao12))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formCadastroManutencao12Acoes" id="formCadastroManutencao12Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_cadastro_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico01Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoCadastroManutencao12 as $linhaCadastroManutencao12)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaCadastroManutencao12['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastroManutencao12['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="CadastroManutencaoEditar.php?idTbCadastroComplemento=<?php echo $linhaCadastroManutencao12['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaCadastroManutencao12['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formCadastroManutencao12" id="formCadastroManutencao12" action="CadastroManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico01Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico01Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroManutencaoDescricao"); ?>:
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
        unset($strSqlCadastroManutencao12Select);
        unset($statementCadastroManutencao12Select);
        unset($resultadoCadastroManutencao12);
        unset($linhaCadastroManutencao12);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Cadastro - Filtro Genérico 02.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarCadastroFiltroGenerico02'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 13;
		
        //Query de pesquisa.
        //----------
        $strSqlCadastroManutencao13Select = "";
        $strSqlCadastroManutencao13Select .= "SELECT ";
        $strSqlCadastroManutencao13Select .= "id, ";
        $strSqlCadastroManutencao13Select .= "tipo_complemento, ";
        $strSqlCadastroManutencao13Select .= "complemento, ";
        $strSqlCadastroManutencao13Select .= "descricao ";
        $strSqlCadastroManutencao13Select .= "FROM tb_cadastro_complemento ";
        $strSqlCadastroManutencao13Select .= "WHERE id <> 0 ";
        $strSqlCadastroManutencao13Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlCadastroManutencao13Select .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
        $strSqlCadastroManutencao13Select .= "ORDER BY complemento";
        
        $statementCadastroManutencao13Select = $dbSistemaConPDO->prepare($strSqlCadastroManutencao13Select);
        
        if ($statementCadastroManutencao13Select !== false)
        {
            $statementCadastroManutencao13Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoCadastroManutencao13 = $dbSistemaConPDO->query($strSqlCadastroManutencao13Select);
        $resultadoCadastroManutencao13 = $statementCadastroManutencao13Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico02Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoCadastroManutencao13))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formCadastroManutencao13Acoes" id="formCadastroManutencao13Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_cadastro_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico02Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoCadastroManutencao13 as $linhaCadastroManutencao13)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaCadastroManutencao13['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastroManutencao13['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="CadastroManutencaoEditar.php?idTbCadastroComplemento=<?php echo $linhaCadastroManutencao13['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaCadastroManutencao13['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formCadastroManutencao13" id="formCadastroManutencao13" action="CadastroManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico02Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico02Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroManutencaoDescricao"); ?>:
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
        unset($strSqlCadastroManutencao13Select);
        unset($statementCadastroManutencao13Select);
        unset($resultadoCadastroManutencao13);
        unset($linhaCadastroManutencao13);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Cadastro - Filtro Genérico 03.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarCadastroFiltroGenerico03'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 14;
		
        //Query de pesquisa.
        //----------
        $strSqlCadastroManutencao14Select = "";
        $strSqlCadastroManutencao14Select .= "SELECT ";
        $strSqlCadastroManutencao14Select .= "id, ";
        $strSqlCadastroManutencao14Select .= "tipo_complemento, ";
        $strSqlCadastroManutencao14Select .= "complemento, ";
        $strSqlCadastroManutencao14Select .= "descricao ";
        $strSqlCadastroManutencao14Select .= "FROM tb_cadastro_complemento ";
        $strSqlCadastroManutencao14Select .= "WHERE id <> 0 ";
        $strSqlCadastroManutencao14Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlCadastroManutencao14Select .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
        $strSqlCadastroManutencao14Select .= "ORDER BY complemento";
        
        $statementCadastroManutencao14Select = $dbSistemaConPDO->prepare($strSqlCadastroManutencao14Select);
        
        if ($statementCadastroManutencao14Select !== false)
        {
            $statementCadastroManutencao14Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoCadastroManutencao14 = $dbSistemaConPDO->query($strSqlCadastroManutencao14Select);
        $resultadoCadastroManutencao14 = $statementCadastroManutencao14Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico03Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoCadastroManutencao14))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formCadastroManutencao14Acoes" id="formCadastroManutencao14Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_cadastro_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico03Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoCadastroManutencao14 as $linhaCadastroManutencao14)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaCadastroManutencao14['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastroManutencao14['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="CadastroManutencaoEditar.php?idTbCadastroComplemento=<?php echo $linhaCadastroManutencao14['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaCadastroManutencao14['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formCadastroManutencao14" id="formCadastroManutencao14" action="CadastroManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico03Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico03Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroManutencaoDescricao"); ?>:
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
        unset($strSqlCadastroManutencao14Select);
        unset($statementCadastroManutencao14Select);
        unset($resultadoCadastroManutencao14);
        unset($linhaCadastroManutencao14);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Cadastro - Filtro Genérico 04.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarCadastroFiltroGenerico04'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 15;
		
        //Query de pesquisa.
        //----------
        $strSqlCadastroManutencao15Select = "";
        $strSqlCadastroManutencao15Select .= "SELECT ";
        $strSqlCadastroManutencao15Select .= "id, ";
        $strSqlCadastroManutencao15Select .= "tipo_complemento, ";
        $strSqlCadastroManutencao15Select .= "complemento, ";
        $strSqlCadastroManutencao15Select .= "descricao ";
        $strSqlCadastroManutencao15Select .= "FROM tb_cadastro_complemento ";
        $strSqlCadastroManutencao15Select .= "WHERE id <> 0 ";
        $strSqlCadastroManutencao15Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlCadastroManutencao15Select .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
        $strSqlCadastroManutencao15Select .= "ORDER BY complemento";
        
        $statementCadastroManutencao15Select = $dbSistemaConPDO->prepare($strSqlCadastroManutencao15Select);
        
        if ($statementCadastroManutencao15Select !== false)
        {
            $statementCadastroManutencao15Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoCadastroManutencao15 = $dbSistemaConPDO->query($strSqlCadastroManutencao15Select);
        $resultadoCadastroManutencao15 = $statementCadastroManutencao15Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico04Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoCadastroManutencao15))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formCadastroManutencao15Acoes" id="formCadastroManutencao15Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_cadastro_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico04Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoCadastroManutencao15 as $linhaCadastroManutencao15)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaCadastroManutencao15['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastroManutencao15['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="CadastroManutencaoEditar.php?idTbCadastroComplemento=<?php echo $linhaCadastroManutencao15['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaCadastroManutencao15['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formCadastroManutencao15" id="formCadastroManutencao15" action="CadastroManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico04Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico04Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroManutencaoDescricao"); ?>:
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
        unset($strSqlCadastroManutencao15Select);
        unset($statementCadastroManutencao15Select);
        unset($resultadoCadastroManutencao15);
        unset($linhaCadastroManutencao15);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Cadastro - Filtro Genérico 05.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarCadastroFiltroGenerico05'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 16;
		
        //Query de pesquisa.
        //----------
        $strSqlCadastroManutencao16Select = "";
        $strSqlCadastroManutencao16Select .= "SELECT ";
        $strSqlCadastroManutencao16Select .= "id, ";
        $strSqlCadastroManutencao16Select .= "tipo_complemento, ";
        $strSqlCadastroManutencao16Select .= "complemento, ";
        $strSqlCadastroManutencao16Select .= "descricao ";
        $strSqlCadastroManutencao16Select .= "FROM tb_cadastro_complemento ";
        $strSqlCadastroManutencao16Select .= "WHERE id <> 0 ";
        $strSqlCadastroManutencao16Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlCadastroManutencao16Select .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
        $strSqlCadastroManutencao16Select .= "ORDER BY complemento";
        
        $statementCadastroManutencao16Select = $dbSistemaConPDO->prepare($strSqlCadastroManutencao16Select);
        
        if ($statementCadastroManutencao16Select !== false)
        {
            $statementCadastroManutencao16Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoCadastroManutencao16 = $dbSistemaConPDO->query($strSqlCadastroManutencao16Select);
        $resultadoCadastroManutencao16 = $statementCadastroManutencao16Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico05Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoCadastroManutencao16))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formCadastroManutencao16Acoes" id="formCadastroManutencao16Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_cadastro_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico05Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoCadastroManutencao16 as $linhaCadastroManutencao16)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaCadastroManutencao16['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastroManutencao16['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="CadastroManutencaoEditar.php?idTbCadastroComplemento=<?php echo $linhaCadastroManutencao16['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaCadastroManutencao16['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formCadastroManutencao16" id="formCadastroManutencao16" action="CadastroManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico05Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico05Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroManutencaoDescricao"); ?>:
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
        unset($strSqlCadastroManutencao16Select);
        unset($statementCadastroManutencao16Select);
        unset($resultadoCadastroManutencao16);
        unset($linhaCadastroManutencao16);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Cadastro - Filtro Genérico 06.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarCadastroFiltroGenerico06'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 17;
		
        //Query de pesquisa.
        //----------
        $strSqlCadastroManutencao17Select = "";
        $strSqlCadastroManutencao17Select .= "SELECT ";
        $strSqlCadastroManutencao17Select .= "id, ";
        $strSqlCadastroManutencao17Select .= "tipo_complemento, ";
        $strSqlCadastroManutencao17Select .= "complemento, ";
        $strSqlCadastroManutencao17Select .= "descricao ";
        $strSqlCadastroManutencao17Select .= "FROM tb_cadastro_complemento ";
        $strSqlCadastroManutencao17Select .= "WHERE id <> 0 ";
        $strSqlCadastroManutencao17Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlCadastroManutencao17Select .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
        $strSqlCadastroManutencao17Select .= "ORDER BY complemento";
        
        $statementCadastroManutencao17Select = $dbSistemaConPDO->prepare($strSqlCadastroManutencao17Select);
        
        if ($statementCadastroManutencao17Select !== false)
        {
            $statementCadastroManutencao17Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoCadastroManutencao17 = $dbSistemaConPDO->query($strSqlCadastroManutencao17Select);
        $resultadoCadastroManutencao17 = $statementCadastroManutencao17Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico06Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoCadastroManutencao17))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formCadastroManutencao17Acoes" id="formCadastroManutencao17Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_cadastro_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico06Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoCadastroManutencao17 as $linhaCadastroManutencao17)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaCadastroManutencao17['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastroManutencao17['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="CadastroManutencaoEditar.php?idTbCadastroComplemento=<?php echo $linhaCadastroManutencao17['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaCadastroManutencao17['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formCadastroManutencao17" id="formCadastroManutencao17" action="CadastroManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico06Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico06Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroManutencaoDescricao"); ?>:
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
        unset($strSqlCadastroManutencao17Select);
        unset($statementCadastroManutencao17Select);
        unset($resultadoCadastroManutencao17);
        unset($linhaCadastroManutencao17);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Cadastro - Filtro Genérico 07.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarCadastroFiltroGenerico07'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 18;
		
        //Query de pesquisa.
        //----------
        $strSqlCadastroManutencao18Select = "";
        $strSqlCadastroManutencao18Select .= "SELECT ";
        $strSqlCadastroManutencao18Select .= "id, ";
        $strSqlCadastroManutencao18Select .= "tipo_complemento, ";
        $strSqlCadastroManutencao18Select .= "complemento, ";
        $strSqlCadastroManutencao18Select .= "descricao ";
        $strSqlCadastroManutencao18Select .= "FROM tb_cadastro_complemento ";
        $strSqlCadastroManutencao18Select .= "WHERE id <> 0 ";
        $strSqlCadastroManutencao18Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlCadastroManutencao18Select .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
        $strSqlCadastroManutencao18Select .= "ORDER BY complemento";
        
        $statementCadastroManutencao18Select = $dbSistemaConPDO->prepare($strSqlCadastroManutencao18Select);
        
        if ($statementCadastroManutencao18Select !== false)
        {
            $statementCadastroManutencao18Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoCadastroManutencao18 = $dbSistemaConPDO->query($strSqlCadastroManutencao18Select);
        $resultadoCadastroManutencao18 = $statementCadastroManutencao18Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico07Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoCadastroManutencao18))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formCadastroManutencao18Acoes" id="formCadastroManutencao18Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_cadastro_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico07Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoCadastroManutencao18 as $linhaCadastroManutencao18)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaCadastroManutencao18['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastroManutencao18['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="CadastroManutencaoEditar.php?idTbCadastroComplemento=<?php echo $linhaCadastroManutencao18['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaCadastroManutencao18['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formCadastroManutencao18" id="formCadastroManutencao18" action="CadastroManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico07Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico07Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroManutencaoDescricao"); ?>:
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
        unset($strSqlCadastroManutencao18Select);
        unset($statementCadastroManutencao18Select);
        unset($resultadoCadastroManutencao18);
        unset($linhaCadastroManutencao18);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Cadastro - Filtro Genérico 08.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarCadastroFiltroGenerico08'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 19;
		
        //Query de pesquisa.
        //----------
        $strSqlCadastroManutencao19Select = "";
        $strSqlCadastroManutencao19Select .= "SELECT ";
        $strSqlCadastroManutencao19Select .= "id, ";
        $strSqlCadastroManutencao19Select .= "tipo_complemento, ";
        $strSqlCadastroManutencao19Select .= "complemento, ";
        $strSqlCadastroManutencao19Select .= "descricao ";
        $strSqlCadastroManutencao19Select .= "FROM tb_cadastro_complemento ";
        $strSqlCadastroManutencao19Select .= "WHERE id <> 0 ";
        $strSqlCadastroManutencao19Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlCadastroManutencao19Select .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
        $strSqlCadastroManutencao19Select .= "ORDER BY complemento";
        
        $statementCadastroManutencao19Select = $dbSistemaConPDO->prepare($strSqlCadastroManutencao19Select);
        
        if ($statementCadastroManutencao19Select !== false)
        {
            $statementCadastroManutencao19Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoCadastroManutencao19 = $dbSistemaConPDO->query($strSqlCadastroManutencao19Select);
        $resultadoCadastroManutencao19 = $statementCadastroManutencao19Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico08Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoCadastroManutencao19))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formCadastroManutencao19Acoes" id="formCadastroManutencao19Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_cadastro_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico08Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoCadastroManutencao19 as $linhaCadastroManutencao19)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaCadastroManutencao19['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastroManutencao19['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="CadastroManutencaoEditar.php?idTbCadastroComplemento=<?php echo $linhaCadastroManutencao19['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaCadastroManutencao19['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formCadastroManutencao19" id="formCadastroManutencao19" action="CadastroManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico08Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico08Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroManutencaoDescricao"); ?>:
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
        unset($strSqlCadastroManutencao19Select);
        unset($statementCadastroManutencao19Select);
        unset($resultadoCadastroManutencao19);
        unset($linhaCadastroManutencao19);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Cadastro - Filtro Genérico 09.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarCadastroFiltroGenerico09'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 20;
		
        //Query de pesquisa.
        //----------
        $strSqlCadastroManutencao20Select = "";
        $strSqlCadastroManutencao20Select .= "SELECT ";
        $strSqlCadastroManutencao20Select .= "id, ";
        $strSqlCadastroManutencao20Select .= "tipo_complemento, ";
        $strSqlCadastroManutencao20Select .= "complemento, ";
        $strSqlCadastroManutencao20Select .= "descricao ";
        $strSqlCadastroManutencao20Select .= "FROM tb_cadastro_complemento ";
        $strSqlCadastroManutencao20Select .= "WHERE id <> 0 ";
        $strSqlCadastroManutencao20Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlCadastroManutencao20Select .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
        $strSqlCadastroManutencao20Select .= "ORDER BY complemento";
        
        $statementCadastroManutencao20Select = $dbSistemaConPDO->prepare($strSqlCadastroManutencao20Select);
        
        if ($statementCadastroManutencao20Select !== false)
        {
            $statementCadastroManutencao20Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoCadastroManutencao20 = $dbSistemaConPDO->query($strSqlCadastroManutencao20Select);
        $resultadoCadastroManutencao20 = $statementCadastroManutencao20Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico09Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoCadastroManutencao20))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formCadastroManutencao20Acoes" id="formCadastroManutencao20Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_cadastro_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico09Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoCadastroManutencao20 as $linhaCadastroManutencao20)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaCadastroManutencao20['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastroManutencao20['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="CadastroManutencaoEditar.php?idTbCadastroComplemento=<?php echo $linhaCadastroManutencao20['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaCadastroManutencao20['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formCadastroManutencao20" id="formCadastroManutencao20" action="CadastroManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico09Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico09Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroManutencaoDescricao"); ?>:
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
        unset($strSqlCadastroManutencao20Select);
        unset($statementCadastroManutencao20Select);
        unset($resultadoCadastroManutencao20);
        unset($linhaCadastroManutencao20);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Cadastro - Filtro Genérico 10.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarCadastroFiltroGenerico10'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 21;
		
        //Query de pesquisa.
        //----------
        $strSqlCadastroManutencao21Select = "";
        $strSqlCadastroManutencao21Select .= "SELECT ";
        $strSqlCadastroManutencao21Select .= "id, ";
        $strSqlCadastroManutencao21Select .= "tipo_complemento, ";
        $strSqlCadastroManutencao21Select .= "complemento, ";
        $strSqlCadastroManutencao21Select .= "descricao ";
        $strSqlCadastroManutencao21Select .= "FROM tb_cadastro_complemento ";
        $strSqlCadastroManutencao21Select .= "WHERE id <> 0 ";
        $strSqlCadastroManutencao21Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlCadastroManutencao21Select .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
        $strSqlCadastroManutencao21Select .= "ORDER BY complemento";
        
        $statementCadastroManutencao21Select = $dbSistemaConPDO->prepare($strSqlCadastroManutencao21Select);
        
        if ($statementCadastroManutencao21Select !== false)
        {
            $statementCadastroManutencao21Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoCadastroManutencao21 = $dbSistemaConPDO->query($strSqlCadastroManutencao21Select);
        $resultadoCadastroManutencao21 = $statementCadastroManutencao21Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico10Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoCadastroManutencao21))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formCadastroManutencao21Acoes" id="formCadastroManutencao21Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_cadastro_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico10Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoCadastroManutencao21 as $linhaCadastroManutencao21)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaCadastroManutencao21['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastroManutencao21['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="CadastroManutencaoEditar.php?idTbCadastroComplemento=<?php echo $linhaCadastroManutencao21['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaCadastroManutencao21['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formCadastroManutencao21" id="formCadastroManutencao21" action="CadastroManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico10Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico10Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroManutencaoDescricao"); ?>:
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
        unset($strSqlCadastroManutencao21Select);
        unset($statementCadastroManutencao21Select);
        unset($resultadoCadastroManutencao21);
        unset($linhaCadastroManutencao21);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>
    
    
	<?php //Cadastro - Filtro Genérico 11.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarCadastroFiltroGenerico11'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 60;
		
        //Query de pesquisa.
        //----------
        $strSqlCadastroManutencao60Select = "";
        $strSqlCadastroManutencao60Select .= "SELECT ";
        $strSqlCadastroManutencao60Select .= "id, ";
        $strSqlCadastroManutencao60Select .= "tipo_complemento, ";
        $strSqlCadastroManutencao60Select .= "complemento, ";
        $strSqlCadastroManutencao60Select .= "descricao ";
        $strSqlCadastroManutencao60Select .= "FROM tb_cadastro_complemento ";
        $strSqlCadastroManutencao60Select .= "WHERE id <> 0 ";
        $strSqlCadastroManutencao60Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlCadastroManutencao60Select .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
        $strSqlCadastroManutencao60Select .= "ORDER BY complemento";
        
        $statementCadastroManutencao60Select = $dbSistemaConPDO->prepare($strSqlCadastroManutencao60Select);
        
        if ($statementCadastroManutencao60Select !== false)
        {
            $statementCadastroManutencao60Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoCadastroManutencao60 = $dbSistemaConPDO->query($strSqlCadastroManutencao60Select);
        $resultadoCadastroManutencao60 = $statementCadastroManutencao60Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico11Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoCadastroManutencao60))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formCadastroManutencao60Acoes" id="formCadastroManutencao60Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_cadastro_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico11Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoCadastroManutencao60 as $linhaCadastroManutencao60)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaCadastroManutencao60['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastroManutencao60['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="CadastroManutencaoEditar.php?idTbCadastroComplemento=<?php echo $linhaCadastroManutencao60['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaCadastroManutencao60['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formCadastroManutencao60" id="formCadastroManutencao60" action="CadastroManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico11Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico11Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroManutencaoDescricao"); ?>:
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
        unset($strSqlCadastroManutencao60Select);
        unset($statementCadastroManutencao60Select);
        unset($resultadoCadastroManutencao60);
        unset($linhaCadastroManutencao60);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Cadastro - Filtro Genérico 12.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarCadastroFiltroGenerico12'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 61;
		
        //Query de pesquisa.
        //----------
        $strSqlCadastroManutencao61Select = "";
        $strSqlCadastroManutencao61Select .= "SELECT ";
        $strSqlCadastroManutencao61Select .= "id, ";
        $strSqlCadastroManutencao61Select .= "tipo_complemento, ";
        $strSqlCadastroManutencao61Select .= "complemento, ";
        $strSqlCadastroManutencao61Select .= "descricao ";
        $strSqlCadastroManutencao61Select .= "FROM tb_cadastro_complemento ";
        $strSqlCadastroManutencao61Select .= "WHERE id <> 0 ";
        $strSqlCadastroManutencao61Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlCadastroManutencao61Select .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
        $strSqlCadastroManutencao61Select .= "ORDER BY complemento";
        
        $statementCadastroManutencao61Select = $dbSistemaConPDO->prepare($strSqlCadastroManutencao61Select);
        
        if ($statementCadastroManutencao61Select !== false)
        {
            $statementCadastroManutencao61Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoCadastroManutencao61 = $dbSistemaConPDO->query($strSqlCadastroManutencao61Select);
        $resultadoCadastroManutencao61 = $statementCadastroManutencao61Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico12Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoCadastroManutencao61))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formCadastroManutencao61Acoes" id="formCadastroManutencao61Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_cadastro_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico12Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoCadastroManutencao61 as $linhaCadastroManutencao61)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaCadastroManutencao61['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastroManutencao61['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="CadastroManutencaoEditar.php?idTbCadastroComplemento=<?php echo $linhaCadastroManutencao61['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaCadastroManutencao61['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formCadastroManutencao61" id="formCadastroManutencao61" action="CadastroManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico12Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico12Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroManutencaoDescricao"); ?>:
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
        unset($strSqlCadastroManutencao61Select);
        unset($statementCadastroManutencao61Select);
        unset($resultadoCadastroManutencao61);
        unset($linhaCadastroManutencao61);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Cadastro - Filtro Genérico 13.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarCadastroFiltroGenerico13'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 62;
		
        //Query de pesquisa.
        //----------
        $strSqlCadastroManutencao62Select = "";
        $strSqlCadastroManutencao62Select .= "SELECT ";
        $strSqlCadastroManutencao62Select .= "id, ";
        $strSqlCadastroManutencao62Select .= "tipo_complemento, ";
        $strSqlCadastroManutencao62Select .= "complemento, ";
        $strSqlCadastroManutencao62Select .= "descricao ";
        $strSqlCadastroManutencao62Select .= "FROM tb_cadastro_complemento ";
        $strSqlCadastroManutencao62Select .= "WHERE id <> 0 ";
        $strSqlCadastroManutencao62Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlCadastroManutencao62Select .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
        $strSqlCadastroManutencao62Select .= "ORDER BY complemento";
        
        $statementCadastroManutencao62Select = $dbSistemaConPDO->prepare($strSqlCadastroManutencao62Select);
        
        if ($statementCadastroManutencao62Select !== false)
        {
            $statementCadastroManutencao62Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoCadastroManutencao62 = $dbSistemaConPDO->query($strSqlCadastroManutencao62Select);
        $resultadoCadastroManutencao62 = $statementCadastroManutencao62Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico13Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoCadastroManutencao62))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formCadastroManutencao62Acoes" id="formCadastroManutencao62Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_cadastro_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico13Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoCadastroManutencao62 as $linhaCadastroManutencao62)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaCadastroManutencao62['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastroManutencao62['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="CadastroManutencaoEditar.php?idTbCadastroComplemento=<?php echo $linhaCadastroManutencao62['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaCadastroManutencao62['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formCadastroManutencao62" id="formCadastroManutencao62" action="CadastroManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico13Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico13Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroManutencaoDescricao"); ?>:
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
        unset($strSqlCadastroManutencao62Select);
        unset($statementCadastroManutencao62Select);
        unset($resultadoCadastroManutencao62);
        unset($linhaCadastroManutencao62);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Cadastro - Filtro Genérico 14.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarCadastroFiltroGenerico14'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 63;
		
        //Query de pesquisa.
        //----------
        $strSqlCadastroManutencao63Select = "";
        $strSqlCadastroManutencao63Select .= "SELECT ";
        $strSqlCadastroManutencao63Select .= "id, ";
        $strSqlCadastroManutencao63Select .= "tipo_complemento, ";
        $strSqlCadastroManutencao63Select .= "complemento, ";
        $strSqlCadastroManutencao63Select .= "descricao ";
        $strSqlCadastroManutencao63Select .= "FROM tb_cadastro_complemento ";
        $strSqlCadastroManutencao63Select .= "WHERE id <> 0 ";
        $strSqlCadastroManutencao63Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlCadastroManutencao63Select .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
        $strSqlCadastroManutencao63Select .= "ORDER BY complemento";
        
        $statementCadastroManutencao63Select = $dbSistemaConPDO->prepare($strSqlCadastroManutencao63Select);
        
        if ($statementCadastroManutencao63Select !== false)
        {
            $statementCadastroManutencao63Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoCadastroManutencao63 = $dbSistemaConPDO->query($strSqlCadastroManutencao63Select);
        $resultadoCadastroManutencao63 = $statementCadastroManutencao63Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico14Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoCadastroManutencao63))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formCadastroManutencao63Acoes" id="formCadastroManutencao63Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_cadastro_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico14Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoCadastroManutencao63 as $linhaCadastroManutencao63)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaCadastroManutencao63['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastroManutencao63['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="CadastroManutencaoEditar.php?idTbCadastroComplemento=<?php echo $linhaCadastroManutencao63['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaCadastroManutencao63['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formCadastroManutencao63" id="formCadastroManutencao63" action="CadastroManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico14Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico14Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroManutencaoDescricao"); ?>:
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
        unset($strSqlCadastroManutencao63Select);
        unset($statementCadastroManutencao63Select);
        unset($resultadoCadastroManutencao63);
        unset($linhaCadastroManutencao63);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Cadastro - Filtro Genérico 15.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarCadastroFiltroGenerico15'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 64;
		
        //Query de pesquisa.
        //----------
        $strSqlCadastroManutencao64Select = "";
        $strSqlCadastroManutencao64Select .= "SELECT ";
        $strSqlCadastroManutencao64Select .= "id, ";
        $strSqlCadastroManutencao64Select .= "tipo_complemento, ";
        $strSqlCadastroManutencao64Select .= "complemento, ";
        $strSqlCadastroManutencao64Select .= "descricao ";
        $strSqlCadastroManutencao64Select .= "FROM tb_cadastro_complemento ";
        $strSqlCadastroManutencao64Select .= "WHERE id <> 0 ";
        $strSqlCadastroManutencao64Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlCadastroManutencao64Select .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
        $strSqlCadastroManutencao64Select .= "ORDER BY complemento";
        
        $statementCadastroManutencao64Select = $dbSistemaConPDO->prepare($strSqlCadastroManutencao64Select);
        
        if ($statementCadastroManutencao64Select !== false)
        {
            $statementCadastroManutencao64Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoCadastroManutencao64 = $dbSistemaConPDO->query($strSqlCadastroManutencao64Select);
        $resultadoCadastroManutencao64 = $statementCadastroManutencao64Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico15Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoCadastroManutencao64))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formCadastroManutencao64Acoes" id="formCadastroManutencao64Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_cadastro_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico15Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoCadastroManutencao64 as $linhaCadastroManutencao64)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaCadastroManutencao64['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastroManutencao64['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="CadastroManutencaoEditar.php?idTbCadastroComplemento=<?php echo $linhaCadastroManutencao64['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaCadastroManutencao64['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formCadastroManutencao64" id="formCadastroManutencao64" action="CadastroManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico15Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico15Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroManutencaoDescricao"); ?>:
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
        unset($strSqlCadastroManutencao64Select);
        unset($statementCadastroManutencao64Select);
        unset($resultadoCadastroManutencao64);
        unset($linhaCadastroManutencao64);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Cadastro - Filtro Genérico 16.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarCadastroFiltroGenerico16'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 65;
		
        //Query de pesquisa.
        //----------
        $strSqlCadastroManutencao65Select = "";
        $strSqlCadastroManutencao65Select .= "SELECT ";
        $strSqlCadastroManutencao65Select .= "id, ";
        $strSqlCadastroManutencao65Select .= "tipo_complemento, ";
        $strSqlCadastroManutencao65Select .= "complemento, ";
        $strSqlCadastroManutencao65Select .= "descricao ";
        $strSqlCadastroManutencao65Select .= "FROM tb_cadastro_complemento ";
        $strSqlCadastroManutencao65Select .= "WHERE id <> 0 ";
        $strSqlCadastroManutencao65Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlCadastroManutencao65Select .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
        $strSqlCadastroManutencao65Select .= "ORDER BY complemento";
        
        $statementCadastroManutencao65Select = $dbSistemaConPDO->prepare($strSqlCadastroManutencao65Select);
        
        if ($statementCadastroManutencao65Select !== false)
        {
            $statementCadastroManutencao65Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoCadastroManutencao65 = $dbSistemaConPDO->query($strSqlCadastroManutencao65Select);
        $resultadoCadastroManutencao65 = $statementCadastroManutencao65Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico16Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoCadastroManutencao65))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formCadastroManutencao65Acoes" id="formCadastroManutencao65Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_cadastro_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico16Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoCadastroManutencao65 as $linhaCadastroManutencao65)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaCadastroManutencao65['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastroManutencao65['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="CadastroManutencaoEditar.php?idTbCadastroComplemento=<?php echo $linhaCadastroManutencao65['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaCadastroManutencao65['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formCadastroManutencao65" id="formCadastroManutencao65" action="CadastroManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico16Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico16Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroManutencaoDescricao"); ?>:
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
        unset($strSqlCadastroManutencao65Select);
        unset($statementCadastroManutencao65Select);
        unset($resultadoCadastroManutencao65);
        unset($linhaCadastroManutencao65);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Cadastro - Filtro Genérico 17.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarCadastroFiltroGenerico17'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 66;
		
        //Query de pesquisa.
        //----------
        $strSqlCadastroManutencao66Select = "";
        $strSqlCadastroManutencao66Select .= "SELECT ";
        $strSqlCadastroManutencao66Select .= "id, ";
        $strSqlCadastroManutencao66Select .= "tipo_complemento, ";
        $strSqlCadastroManutencao66Select .= "complemento, ";
        $strSqlCadastroManutencao66Select .= "descricao ";
        $strSqlCadastroManutencao66Select .= "FROM tb_cadastro_complemento ";
        $strSqlCadastroManutencao66Select .= "WHERE id <> 0 ";
        $strSqlCadastroManutencao66Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlCadastroManutencao66Select .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
        $strSqlCadastroManutencao66Select .= "ORDER BY complemento";
        
        $statementCadastroManutencao66Select = $dbSistemaConPDO->prepare($strSqlCadastroManutencao66Select);
        
        if ($statementCadastroManutencao66Select !== false)
        {
            $statementCadastroManutencao66Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoCadastroManutencao66 = $dbSistemaConPDO->query($strSqlCadastroManutencao66Select);
        $resultadoCadastroManutencao66 = $statementCadastroManutencao66Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico17Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoCadastroManutencao66))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formCadastroManutencao66Acoes" id="formCadastroManutencao66Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_cadastro_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico17Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoCadastroManutencao66 as $linhaCadastroManutencao66)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaCadastroManutencao66['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastroManutencao66['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="CadastroManutencaoEditar.php?idTbCadastroComplemento=<?php echo $linhaCadastroManutencao66['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaCadastroManutencao66['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formCadastroManutencao66" id="formCadastroManutencao66" action="CadastroManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico17Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico17Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroManutencaoDescricao"); ?>:
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
        unset($strSqlCadastroManutencao66Select);
        unset($statementCadastroManutencao66Select);
        unset($resultadoCadastroManutencao66);
        unset($linhaCadastroManutencao66);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Cadastro - Filtro Genérico 18.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarCadastroFiltroGenerico18'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 67;
		
        //Query de pesquisa.
        //----------
        $strSqlCadastroManutencao67Select = "";
        $strSqlCadastroManutencao67Select .= "SELECT ";
        $strSqlCadastroManutencao67Select .= "id, ";
        $strSqlCadastroManutencao67Select .= "tipo_complemento, ";
        $strSqlCadastroManutencao67Select .= "complemento, ";
        $strSqlCadastroManutencao67Select .= "descricao ";
        $strSqlCadastroManutencao67Select .= "FROM tb_cadastro_complemento ";
        $strSqlCadastroManutencao67Select .= "WHERE id <> 0 ";
        $strSqlCadastroManutencao67Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlCadastroManutencao67Select .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
        $strSqlCadastroManutencao67Select .= "ORDER BY complemento";
        
        $statementCadastroManutencao67Select = $dbSistemaConPDO->prepare($strSqlCadastroManutencao67Select);
        
        if ($statementCadastroManutencao67Select !== false)
        {
            $statementCadastroManutencao67Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoCadastroManutencao67 = $dbSistemaConPDO->query($strSqlCadastroManutencao67Select);
        $resultadoCadastroManutencao67 = $statementCadastroManutencao67Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico18Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoCadastroManutencao67))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formCadastroManutencao67Acoes" id="formCadastroManutencao67Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_cadastro_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico18Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoCadastroManutencao67 as $linhaCadastroManutencao67)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaCadastroManutencao67['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastroManutencao67['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="CadastroManutencaoEditar.php?idTbCadastroComplemento=<?php echo $linhaCadastroManutencao67['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaCadastroManutencao67['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formCadastroManutencao67" id="formCadastroManutencao67" action="CadastroManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico18Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico18Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroManutencaoDescricao"); ?>:
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
        unset($strSqlCadastroManutencao67Select);
        unset($statementCadastroManutencao67Select);
        unset($resultadoCadastroManutencao67);
        unset($linhaCadastroManutencao67);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Cadastro - Filtro Genérico 19.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarCadastroFiltroGenerico19'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 68;
		
        //Query de pesquisa.
        //----------
        $strSqlCadastroManutencao68Select = "";
        $strSqlCadastroManutencao68Select .= "SELECT ";
        $strSqlCadastroManutencao68Select .= "id, ";
        $strSqlCadastroManutencao68Select .= "tipo_complemento, ";
        $strSqlCadastroManutencao68Select .= "complemento, ";
        $strSqlCadastroManutencao68Select .= "descricao ";
        $strSqlCadastroManutencao68Select .= "FROM tb_cadastro_complemento ";
        $strSqlCadastroManutencao68Select .= "WHERE id <> 0 ";
        $strSqlCadastroManutencao68Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlCadastroManutencao68Select .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
        $strSqlCadastroManutencao68Select .= "ORDER BY complemento";
        
        $statementCadastroManutencao68Select = $dbSistemaConPDO->prepare($strSqlCadastroManutencao68Select);
        
        if ($statementCadastroManutencao68Select !== false)
        {
            $statementCadastroManutencao68Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoCadastroManutencao68 = $dbSistemaConPDO->query($strSqlCadastroManutencao68Select);
        $resultadoCadastroManutencao68 = $statementCadastroManutencao68Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico19Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoCadastroManutencao68))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formCadastroManutencao68Acoes" id="formCadastroManutencao68Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_cadastro_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico19Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoCadastroManutencao68 as $linhaCadastroManutencao68)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaCadastroManutencao68['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastroManutencao68['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="CadastroManutencaoEditar.php?idTbCadastroComplemento=<?php echo $linhaCadastroManutencao68['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaCadastroManutencao68['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formCadastroManutencao68" id="formCadastroManutencao68" action="CadastroManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico19Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico19Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroManutencaoDescricao"); ?>:
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
        unset($strSqlCadastroManutencao68Select);
        unset($statementCadastroManutencao68Select);
        unset($resultadoCadastroManutencao68);
        unset($linhaCadastroManutencao68);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Cadastro - Filtro Genérico 20.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarCadastroFiltroGenerico20'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 69;
		
        //Query de pesquisa.
        //----------
        $strSqlCadastroManutencao69Select = "";
        $strSqlCadastroManutencao69Select .= "SELECT ";
        $strSqlCadastroManutencao69Select .= "id, ";
        $strSqlCadastroManutencao69Select .= "tipo_complemento, ";
        $strSqlCadastroManutencao69Select .= "complemento, ";
        $strSqlCadastroManutencao69Select .= "descricao ";
        $strSqlCadastroManutencao69Select .= "FROM tb_cadastro_complemento ";
        $strSqlCadastroManutencao69Select .= "WHERE id <> 0 ";
        $strSqlCadastroManutencao69Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlCadastroManutencao69Select .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
        $strSqlCadastroManutencao69Select .= "ORDER BY complemento";
        
        $statementCadastroManutencao69Select = $dbSistemaConPDO->prepare($strSqlCadastroManutencao69Select);
        
        if ($statementCadastroManutencao69Select !== false)
        {
            $statementCadastroManutencao69Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoCadastroManutencao69 = $dbSistemaConPDO->query($strSqlCadastroManutencao69Select);
        $resultadoCadastroManutencao69 = $statementCadastroManutencao69Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico20Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoCadastroManutencao69))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formCadastroManutencao69Acoes" id="formCadastroManutencao69Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_cadastro_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico20Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoCadastroManutencao69 as $linhaCadastroManutencao69)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaCadastroManutencao69['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastroManutencao69['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="CadastroManutencaoEditar.php?idTbCadastroComplemento=<?php echo $linhaCadastroManutencao69['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaCadastroManutencao69['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formCadastroManutencao69" id="formCadastroManutencao69" action="CadastroManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico20Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico20Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroManutencaoDescricao"); ?>:
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
        unset($strSqlCadastroManutencao69Select);
        unset($statementCadastroManutencao69Select);
        unset($resultadoCadastroManutencao69);
        unset($linhaCadastroManutencao69);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>
    
    
	<?php //Cadastro - Filtro Genérico 21.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarCadastroFiltroGenerico21'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 70;
		
        //Query de pesquisa.
        //----------
        $strSqlCadastroManutencao70Select = "";
        $strSqlCadastroManutencao70Select .= "SELECT ";
        $strSqlCadastroManutencao70Select .= "id, ";
        $strSqlCadastroManutencao70Select .= "tipo_complemento, ";
        $strSqlCadastroManutencao70Select .= "complemento, ";
        $strSqlCadastroManutencao70Select .= "descricao ";
        $strSqlCadastroManutencao70Select .= "FROM tb_cadastro_complemento ";
        $strSqlCadastroManutencao70Select .= "WHERE id <> 0 ";
        $strSqlCadastroManutencao70Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlCadastroManutencao70Select .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
        $strSqlCadastroManutencao70Select .= "ORDER BY complemento";
        
        $statementCadastroManutencao70Select = $dbSistemaConPDO->prepare($strSqlCadastroManutencao70Select);
        
        if ($statementCadastroManutencao70Select !== false)
        {
            $statementCadastroManutencao70Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoCadastroManutencao70 = $dbSistemaConPDO->query($strSqlCadastroManutencao70Select);
        $resultadoCadastroManutencao70 = $statementCadastroManutencao70Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico21Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoCadastroManutencao70))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formCadastroManutencao70Acoes" id="formCadastroManutencao70Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_cadastro_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico21Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoCadastroManutencao70 as $linhaCadastroManutencao70)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaCadastroManutencao70['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastroManutencao70['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="CadastroManutencaoEditar.php?idTbCadastroComplemento=<?php echo $linhaCadastroManutencao70['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaCadastroManutencao70['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formCadastroManutencao70" id="formCadastroManutencao70" action="CadastroManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico21Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico21Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroManutencaoDescricao"); ?>:
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
        unset($strSqlCadastroManutencao70Select);
        unset($statementCadastroManutencao70Select);
        unset($resultadoCadastroManutencao70);
        unset($linhaCadastroManutencao70);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Cadastro - Filtro Genérico 22.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarCadastroFiltroGenerico22'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 71;
		
        //Query de pesquisa.
        //----------
        $strSqlCadastroManutencao71Select = "";
        $strSqlCadastroManutencao71Select .= "SELECT ";
        $strSqlCadastroManutencao71Select .= "id, ";
        $strSqlCadastroManutencao71Select .= "tipo_complemento, ";
        $strSqlCadastroManutencao71Select .= "complemento, ";
        $strSqlCadastroManutencao71Select .= "descricao ";
        $strSqlCadastroManutencao71Select .= "FROM tb_cadastro_complemento ";
        $strSqlCadastroManutencao71Select .= "WHERE id <> 0 ";
        $strSqlCadastroManutencao71Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlCadastroManutencao71Select .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
        $strSqlCadastroManutencao71Select .= "ORDER BY complemento";
        
        $statementCadastroManutencao71Select = $dbSistemaConPDO->prepare($strSqlCadastroManutencao71Select);
        
        if ($statementCadastroManutencao71Select !== false)
        {
            $statementCadastroManutencao71Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoCadastroManutencao71 = $dbSistemaConPDO->query($strSqlCadastroManutencao71Select);
        $resultadoCadastroManutencao71 = $statementCadastroManutencao71Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico22Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoCadastroManutencao71))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formCadastroManutencao71Acoes" id="formCadastroManutencao71Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_cadastro_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico22Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoCadastroManutencao71 as $linhaCadastroManutencao71)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaCadastroManutencao71['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastroManutencao71['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="CadastroManutencaoEditar.php?idTbCadastroComplemento=<?php echo $linhaCadastroManutencao71['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaCadastroManutencao71['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formCadastroManutencao71" id="formCadastroManutencao71" action="CadastroManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico22Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico22Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroManutencaoDescricao"); ?>:
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
        unset($strSqlCadastroManutencao71Select);
        unset($statementCadastroManutencao71Select);
        unset($resultadoCadastroManutencao71);
        unset($linhaCadastroManutencao71);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Cadastro - Filtro Genérico 23.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarCadastroFiltroGenerico23'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 72;
		
        //Query de pesquisa.
        //----------
        $strSqlCadastroManutencao72Select = "";
        $strSqlCadastroManutencao72Select .= "SELECT ";
        $strSqlCadastroManutencao72Select .= "id, ";
        $strSqlCadastroManutencao72Select .= "tipo_complemento, ";
        $strSqlCadastroManutencao72Select .= "complemento, ";
        $strSqlCadastroManutencao72Select .= "descricao ";
        $strSqlCadastroManutencao72Select .= "FROM tb_cadastro_complemento ";
        $strSqlCadastroManutencao72Select .= "WHERE id <> 0 ";
        $strSqlCadastroManutencao72Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlCadastroManutencao72Select .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
        $strSqlCadastroManutencao72Select .= "ORDER BY complemento";
        
        $statementCadastroManutencao72Select = $dbSistemaConPDO->prepare($strSqlCadastroManutencao72Select);
        
        if ($statementCadastroManutencao72Select !== false)
        {
            $statementCadastroManutencao72Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoCadastroManutencao72 = $dbSistemaConPDO->query($strSqlCadastroManutencao72Select);
        $resultadoCadastroManutencao72 = $statementCadastroManutencao72Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico23Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoCadastroManutencao72))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formCadastroManutencao72Acoes" id="formCadastroManutencao72Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_cadastro_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico23Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoCadastroManutencao72 as $linhaCadastroManutencao72)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaCadastroManutencao72['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastroManutencao72['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="CadastroManutencaoEditar.php?idTbCadastroComplemento=<?php echo $linhaCadastroManutencao72['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaCadastroManutencao72['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formCadastroManutencao72" id="formCadastroManutencao72" action="CadastroManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico23Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico23Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroManutencaoDescricao"); ?>:
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
        unset($strSqlCadastroManutencao72Select);
        unset($statementCadastroManutencao72Select);
        unset($resultadoCadastroManutencao72);
        unset($linhaCadastroManutencao72);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Cadastro - Filtro Genérico 24.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarCadastroFiltroGenerico24'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 73;
		
        //Query de pesquisa.
        //----------
        $strSqlCadastroManutencao73Select = "";
        $strSqlCadastroManutencao73Select .= "SELECT ";
        $strSqlCadastroManutencao73Select .= "id, ";
        $strSqlCadastroManutencao73Select .= "tipo_complemento, ";
        $strSqlCadastroManutencao73Select .= "complemento, ";
        $strSqlCadastroManutencao73Select .= "descricao ";
        $strSqlCadastroManutencao73Select .= "FROM tb_cadastro_complemento ";
        $strSqlCadastroManutencao73Select .= "WHERE id <> 0 ";
        $strSqlCadastroManutencao73Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlCadastroManutencao73Select .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
        $strSqlCadastroManutencao73Select .= "ORDER BY complemento";
        
        $statementCadastroManutencao73Select = $dbSistemaConPDO->prepare($strSqlCadastroManutencao73Select);
        
        if ($statementCadastroManutencao73Select !== false)
        {
            $statementCadastroManutencao73Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoCadastroManutencao73 = $dbSistemaConPDO->query($strSqlCadastroManutencao73Select);
        $resultadoCadastroManutencao73 = $statementCadastroManutencao73Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico24Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoCadastroManutencao73))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formCadastroManutencao73Acoes" id="formCadastroManutencao73Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_cadastro_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico24Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoCadastroManutencao73 as $linhaCadastroManutencao73)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaCadastroManutencao73['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastroManutencao73['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="CadastroManutencaoEditar.php?idTbCadastroComplemento=<?php echo $linhaCadastroManutencao73['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaCadastroManutencao73['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formCadastroManutencao73" id="formCadastroManutencao73" action="CadastroManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico24Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico24Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroManutencaoDescricao"); ?>:
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
        unset($strSqlCadastroManutencao73Select);
        unset($statementCadastroManutencao73Select);
        unset($resultadoCadastroManutencao73);
        unset($linhaCadastroManutencao73);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Cadastro - Filtro Genérico 25.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarCadastroFiltroGenerico25'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 74;
		
        //Query de pesquisa.
        //----------
        $strSqlCadastroManutencao74Select = "";
        $strSqlCadastroManutencao74Select .= "SELECT ";
        $strSqlCadastroManutencao74Select .= "id, ";
        $strSqlCadastroManutencao74Select .= "tipo_complemento, ";
        $strSqlCadastroManutencao74Select .= "complemento, ";
        $strSqlCadastroManutencao74Select .= "descricao ";
        $strSqlCadastroManutencao74Select .= "FROM tb_cadastro_complemento ";
        $strSqlCadastroManutencao74Select .= "WHERE id <> 0 ";
        $strSqlCadastroManutencao74Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlCadastroManutencao74Select .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
        $strSqlCadastroManutencao74Select .= "ORDER BY complemento";
        
        $statementCadastroManutencao74Select = $dbSistemaConPDO->prepare($strSqlCadastroManutencao74Select);
        
        if ($statementCadastroManutencao74Select !== false)
        {
            $statementCadastroManutencao74Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoCadastroManutencao74 = $dbSistemaConPDO->query($strSqlCadastroManutencao74Select);
        $resultadoCadastroManutencao74 = $statementCadastroManutencao74Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico25Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoCadastroManutencao74))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formCadastroManutencao74Acoes" id="formCadastroManutencao74Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_cadastro_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico25Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoCadastroManutencao74 as $linhaCadastroManutencao74)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaCadastroManutencao74['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastroManutencao74['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="CadastroManutencaoEditar.php?idTbCadastroComplemento=<?php echo $linhaCadastroManutencao74['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaCadastroManutencao74['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formCadastroManutencao74" id="formCadastroManutencao74" action="CadastroManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico25Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico25Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroManutencaoDescricao"); ?>:
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
        unset($strSqlCadastroManutencao74Select);
        unset($statementCadastroManutencao74Select);
        unset($resultadoCadastroManutencao74);
        unset($linhaCadastroManutencao74);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Cadastro - Filtro Genérico 26.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarCadastroFiltroGenerico26'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 75;
		
        //Query de pesquisa.
        //----------
        $strSqlCadastroManutencao75Select = "";
        $strSqlCadastroManutencao75Select .= "SELECT ";
        $strSqlCadastroManutencao75Select .= "id, ";
        $strSqlCadastroManutencao75Select .= "tipo_complemento, ";
        $strSqlCadastroManutencao75Select .= "complemento, ";
        $strSqlCadastroManutencao75Select .= "descricao ";
        $strSqlCadastroManutencao75Select .= "FROM tb_cadastro_complemento ";
        $strSqlCadastroManutencao75Select .= "WHERE id <> 0 ";
        $strSqlCadastroManutencao75Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlCadastroManutencao75Select .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
        $strSqlCadastroManutencao75Select .= "ORDER BY complemento";
        
        $statementCadastroManutencao75Select = $dbSistemaConPDO->prepare($strSqlCadastroManutencao75Select);
        
        if ($statementCadastroManutencao75Select !== false)
        {
            $statementCadastroManutencao75Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoCadastroManutencao75 = $dbSistemaConPDO->query($strSqlCadastroManutencao75Select);
        $resultadoCadastroManutencao75 = $statementCadastroManutencao75Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico26Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoCadastroManutencao75))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formCadastroManutencao75Acoes" id="formCadastroManutencao75Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_cadastro_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico26Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoCadastroManutencao75 as $linhaCadastroManutencao75)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaCadastroManutencao75['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastroManutencao75['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="CadastroManutencaoEditar.php?idTbCadastroComplemento=<?php echo $linhaCadastroManutencao75['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaCadastroManutencao75['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formCadastroManutencao75" id="formCadastroManutencao75" action="CadastroManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico26Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico26Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroManutencaoDescricao"); ?>:
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
        unset($strSqlCadastroManutencao75Select);
        unset($statementCadastroManutencao75Select);
        unset($resultadoCadastroManutencao75);
        unset($linhaCadastroManutencao75);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Cadastro - Filtro Genérico 27.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarCadastroFiltroGenerico27'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 76;
		
        //Query de pesquisa.
        //----------
        $strSqlCadastroManutencao76Select = "";
        $strSqlCadastroManutencao76Select .= "SELECT ";
        $strSqlCadastroManutencao76Select .= "id, ";
        $strSqlCadastroManutencao76Select .= "tipo_complemento, ";
        $strSqlCadastroManutencao76Select .= "complemento, ";
        $strSqlCadastroManutencao76Select .= "descricao ";
        $strSqlCadastroManutencao76Select .= "FROM tb_cadastro_complemento ";
        $strSqlCadastroManutencao76Select .= "WHERE id <> 0 ";
        $strSqlCadastroManutencao76Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlCadastroManutencao76Select .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
        $strSqlCadastroManutencao76Select .= "ORDER BY complemento";
        
        $statementCadastroManutencao76Select = $dbSistemaConPDO->prepare($strSqlCadastroManutencao76Select);
        
        if ($statementCadastroManutencao76Select !== false)
        {
            $statementCadastroManutencao76Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoCadastroManutencao76 = $dbSistemaConPDO->query($strSqlCadastroManutencao76Select);
        $resultadoCadastroManutencao76 = $statementCadastroManutencao76Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico27Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoCadastroManutencao76))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formCadastroManutencao76Acoes" id="formCadastroManutencao76Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_cadastro_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico27Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoCadastroManutencao76 as $linhaCadastroManutencao76)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaCadastroManutencao76['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastroManutencao76['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="CadastroManutencaoEditar.php?idTbCadastroComplemento=<?php echo $linhaCadastroManutencao76['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaCadastroManutencao76['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formCadastroManutencao76" id="formCadastroManutencao76" action="CadastroManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico27Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico27Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroManutencaoDescricao"); ?>:
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
        unset($strSqlCadastroManutencao76Select);
        unset($statementCadastroManutencao76Select);
        unset($resultadoCadastroManutencao76);
        unset($linhaCadastroManutencao76);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Cadastro - Filtro Genérico 28.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarCadastroFiltroGenerico28'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 77;
		
        //Query de pesquisa.
        //----------
        $strSqlCadastroManutencao77Select = "";
        $strSqlCadastroManutencao77Select .= "SELECT ";
        $strSqlCadastroManutencao77Select .= "id, ";
        $strSqlCadastroManutencao77Select .= "tipo_complemento, ";
        $strSqlCadastroManutencao77Select .= "complemento, ";
        $strSqlCadastroManutencao77Select .= "descricao ";
        $strSqlCadastroManutencao77Select .= "FROM tb_cadastro_complemento ";
        $strSqlCadastroManutencao77Select .= "WHERE id <> 0 ";
        $strSqlCadastroManutencao77Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlCadastroManutencao77Select .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
        $strSqlCadastroManutencao77Select .= "ORDER BY complemento";
        
        $statementCadastroManutencao77Select = $dbSistemaConPDO->prepare($strSqlCadastroManutencao77Select);
        
        if ($statementCadastroManutencao77Select !== false)
        {
            $statementCadastroManutencao77Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoCadastroManutencao77 = $dbSistemaConPDO->query($strSqlCadastroManutencao77Select);
        $resultadoCadastroManutencao77 = $statementCadastroManutencao77Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico28Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoCadastroManutencao77))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formCadastroManutencao77Acoes" id="formCadastroManutencao77Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_cadastro_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico28Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoCadastroManutencao77 as $linhaCadastroManutencao77)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaCadastroManutencao77['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastroManutencao77['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="CadastroManutencaoEditar.php?idTbCadastroComplemento=<?php echo $linhaCadastroManutencao77['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaCadastroManutencao77['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formCadastroManutencao77" id="formCadastroManutencao77" action="CadastroManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico28Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico28Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroManutencaoDescricao"); ?>:
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
        unset($strSqlCadastroManutencao77Select);
        unset($statementCadastroManutencao77Select);
        unset($resultadoCadastroManutencao77);
        unset($linhaCadastroManutencao77);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Cadastro - Filtro Genérico 29.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarCadastroFiltroGenerico29'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 78;
		
        //Query de pesquisa.
        //----------
        $strSqlCadastroManutencao78Select = "";
        $strSqlCadastroManutencao78Select .= "SELECT ";
        $strSqlCadastroManutencao78Select .= "id, ";
        $strSqlCadastroManutencao78Select .= "tipo_complemento, ";
        $strSqlCadastroManutencao78Select .= "complemento, ";
        $strSqlCadastroManutencao78Select .= "descricao ";
        $strSqlCadastroManutencao78Select .= "FROM tb_cadastro_complemento ";
        $strSqlCadastroManutencao78Select .= "WHERE id <> 0 ";
        $strSqlCadastroManutencao78Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlCadastroManutencao78Select .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
        $strSqlCadastroManutencao78Select .= "ORDER BY complemento";
        
        $statementCadastroManutencao78Select = $dbSistemaConPDO->prepare($strSqlCadastroManutencao78Select);
        
        if ($statementCadastroManutencao78Select !== false)
        {
            $statementCadastroManutencao78Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoCadastroManutencao78 = $dbSistemaConPDO->query($strSqlCadastroManutencao78Select);
        $resultadoCadastroManutencao78 = $statementCadastroManutencao78Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico29Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoCadastroManutencao78))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formCadastroManutencao78Acoes" id="formCadastroManutencao78Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_cadastro_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico29Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoCadastroManutencao78 as $linhaCadastroManutencao78)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaCadastroManutencao78['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastroManutencao78['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="CadastroManutencaoEditar.php?idTbCadastroComplemento=<?php echo $linhaCadastroManutencao78['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaCadastroManutencao78['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formCadastroManutencao78" id="formCadastroManutencao78" action="CadastroManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico29Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico29Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroManutencaoDescricao"); ?>:
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
        unset($strSqlCadastroManutencao78Select);
        unset($statementCadastroManutencao78Select);
        unset($resultadoCadastroManutencao78);
        unset($linhaCadastroManutencao78);
        //----------
        ?>
	<?php } ?>
    <?php //----------?>


	<?php //Cadastro - Filtro Genérico 30.?>
    <?php //----------?>
    <?php if($GLOBALS['habilitarCadastroFiltroGenerico30'] == 1){ ?>
        <?php
		//Definição de variáveis.
		$tipoComplemento = 79;
		
        //Query de pesquisa.
        //----------
        $strSqlCadastroManutencao79Select = "";
        $strSqlCadastroManutencao79Select .= "SELECT ";
        $strSqlCadastroManutencao79Select .= "id, ";
        $strSqlCadastroManutencao79Select .= "tipo_complemento, ";
        $strSqlCadastroManutencao79Select .= "complemento, ";
        $strSqlCadastroManutencao79Select .= "descricao ";
        $strSqlCadastroManutencao79Select .= "FROM tb_cadastro_complemento ";
        $strSqlCadastroManutencao79Select .= "WHERE id <> 0 ";
        $strSqlCadastroManutencao79Select .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlCadastroManutencao79Select .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
        $strSqlCadastroManutencao79Select .= "ORDER BY complemento";
        
        $statementCadastroManutencao79Select = $dbSistemaConPDO->prepare($strSqlCadastroManutencao79Select);
        
        if ($statementCadastroManutencao79Select !== false)
        {
            $statementCadastroManutencao79Select->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoCadastroManutencao79 = $dbSistemaConPDO->query($strSqlCadastroManutencao79Select);
        $resultadoCadastroManutencao79 = $statementCadastroManutencao79Select->fetchAll();
        ?>
        
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="TbFundoTituloGridView01">
            <tr>
                <td>
                    <div align="center" class="Texto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico30Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
            </tr>
        </table>
		<?php
        if (empty($resultadoCadastroManutencao79))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formCadastroManutencao79Acoes" id="formCadastroManutencao79Acoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_cadastro_complemento" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico30Nome'], "IncludeConfig"); ?>
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
                foreach($resultadoCadastroManutencao79 as $linhaCadastroManutencao79)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaCadastroManutencao79['id'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastroManutencao79['complemento']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="CadastroManutencaoEditar.php?idTbCadastroComplemento=<?php echo $linhaCadastroManutencao79['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaCadastroManutencao79['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formCadastroManutencao79" id="formCadastroManutencao79" action="CadastroManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserir"); ?> <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico30Nome'], "IncludeConfig"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico30Nome'], "IncludeConfig"); ?>:
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroManutencaoDescricao"); ?>:
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
        unset($strSqlCadastroManutencao79Select);
        unset($statementCadastroManutencao79Select);
        unset($resultadoCadastroManutencao79);
        unset($linhaCadastroManutencao79);
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
//unset($strSqlCadastroManutencao1Select);
//unset($statementCadastroManutencao1Select);
//unset($resultadoCadastroManutencao1);
//unset($linhaCadastroManutencao1);
//----------
?>


<?php 
//Inclusão do template do layout.
include_once $page->LayoutSistema;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>