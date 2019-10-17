<?php
//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeLayout.php";


//Verificação de login Master.
LoginAutenticacao::UsuarioLoginVerificacao();
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistema"); ?> - <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configNomeCliente'], "IncludeConfig"); ?>
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
    	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBuscaTitulo"); ?>
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
    
    
    <?php //Busca categorias.?>
    <?php //**************************************************************************************?>
	<?php if($GLOBALS['habilitarBuscaCategorias'] == 1){ ?>
    <form name="formBuscaCategorias" id="formBuscaCategorias" action="CategoriasIndice.php" method="get" class="FormularioTabela01">
        <div>
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBuscaTbCategorias"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBuscaPalavraChave"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div align="left">
                        	<input type="text" name="palavraChave" id="palavraChave" class="CampoTexto01" maxlength="255" />
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div align="center">
            <input type="image" name="submit" value="Submit" src="img/btoBuscar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoBusca"); ?>" />
            
            <!--input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" /-->
            <input name="masterPageSelect" type="hidden" id="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
        </div>
    </form>
    <br />
    <?php } ?>
    <?php //**************************************************************************************?>


    <?php //Busca cadastro.?>
    <?php //**************************************************************************************?>
	<?php if($GLOBALS['habilitarBuscaCadastro'] == 1){ ?>
    <form name="formBuscaCadastro" id="formBuscaCadastro" action="CadastroIndice.php" method="get" class="FormularioTabela01">
        <div>
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBuscaTbCadastro"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBuscaPalavraChave"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div align="left">
                        	<input type="text" name="palavraChave" id="palavraChave" class="CampoTexto01" maxlength="255" />
                        </div>
                    </td>
                </tr>
                
                <?php if($GLOBALS['habilitarBuscaCadastroFiltros'] == 1){ ?>
					<?php if($GLOBALS['habilitarCadastroTipo'] == 1){ ?>
                        <tr>
                            <td class="TbFundoMedio TabelaColuna01">
                                <div align="left" class="Texto01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroTipoCadastro"); ?>:
                                </div>
                            </td>
                            <td class="TbFundoClaro">
								<?php 
								$arrCadastroTipo = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 1);
                                ?>
                                
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroTipo); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input type="checkbox" id="idsTbCadastroComplemento[]" name="idsTbCadastroComplemento[]" value="<?php echo $arrCadastroTipo[$countArray][0];?>" class="CampoCheckBox01" /> 
										<a href="CadastroIndice.php?idsTbCadastroComplemento=<?php echo $arrCadastroTipo[$countArray][0];?>" class="Links01">
											<?php echo $arrCadastroTipo[$countArray][1];?>
                                        </a>
                                    </div>
                                <?php 
                                }
                                ?>
                            </td>
                        </tr>
                    <?php } ?>
                    
					<?php if($GLOBALS['habilitarCadastroAtividades'] == 1){ ?>
                        <tr>
                            <td class="TbFundoMedio TabelaColuna01">
                                <div align="left" class="Texto01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroAtividades"); ?>:
                                </div>
                            </td>
                            <td class="TbFundoClaro">
                                <div align="left" class="Texto01">
                                    <?php 
									$arrCadastroAtividades = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 2);
                                    ?>
									<?php 
                                    for($countArray = 0; $countArray < count($arrCadastroAtividades); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input type="checkbox" id="idsTbCadastroComplemento[]" name="idsTbCadastroComplemento[]"  value="<?php echo $arrCadastroAtividades[$countArray][0];?>" class="CampoCheckBox01" /> 
                                            <a href="CadastroIndice.php?idsTbCadastroComplemento=<?php echo $arrCadastroAtividades[$countArray][0];?>" class="Links01">
                                                <?php echo $arrCadastroAtividades[$countArray][1];?>
                                            </a>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    
					<?php if($GLOBALS['habilitarCadastroFiltroGenerico01'] == 1){ ?>
                        <tr>
                            <td class="TbFundoMedio TabelaColuna01">
                                <div align="left" class="Texto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico01Nome'], "IncludeConfig"); ?>: 
                                </div>
                            </td>
                            <td class="TbFundoClaro">
                                <div align="left" class="Texto01">
                                    <?php 
									$arrCadastroFiltroGenerico01 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 12);
                                    ?>
									<?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico01); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input type="checkbox" id="idsTbCadastroComplemento[]" name="idsTbCadastroComplemento[]"  value="<?php echo $arrCadastroFiltroGenerico01[$countArray][0];?>" class="CampoCheckBox01" /> 
                                            <a href="CadastroIndice.php?idsTbCadastroComplemento=<?php echo $arrCadastroFiltroGenerico01[$countArray][0];?>" class="Links01">
                                                <?php echo $arrCadastroFiltroGenerico01[$countArray][1];?>
                                            </a>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    
					<?php if($GLOBALS['habilitarCadastroFiltroGenerico02'] == 1){ ?>
                        <tr>
                            <td class="TbFundoMedio TabelaColuna01">
                                <div align="left" class="Texto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico02Nome'], "IncludeConfig"); ?>: 
                                </div>
                            </td>
                            <td class="TbFundoClaro">
                                <div align="left" class="Texto01">
                                    <?php 
									$arrCadastroFiltroGenerico02 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 13);
                                    ?>
									<?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico02); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input type="checkbox" id="idsTbCadastroComplemento[]" name="idsTbCadastroComplemento[]"  value="<?php echo $arrCadastroFiltroGenerico02[$countArray][0];?>" class="CampoCheckBox01" /> 
                                            <a href="CadastroIndice.php?idsTbCadastroComplemento=<?php echo $arrCadastroFiltroGenerico02[$countArray][0];?>" class="Links01">
                                                <?php echo $arrCadastroFiltroGenerico02[$countArray][1];?>
                                            </a>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    
					<?php if($GLOBALS['habilitarCadastroFiltroGenerico03'] == 1){ ?>
                        <tr>
                            <td class="TbFundoMedio TabelaColuna01">
                                <div align="left" class="Texto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico03Nome'], "IncludeConfig"); ?>: 
                                </div>
                            </td>
                            <td class="TbFundoClaro">
                                <div align="left" class="Texto01">
                                    <?php 
									$arrCadastroFiltroGenerico03 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 14);
                                    ?>
									<?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico03); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input type="checkbox" id="idsTbCadastroComplemento[]" name="idsTbCadastroComplemento[]"  value="<?php echo $arrCadastroFiltroGenerico03[$countArray][0];?>" class="CampoCheckBox01" /> 
                                            <a href="CadastroIndice.php?idsTbCadastroComplemento=<?php echo $arrCadastroFiltroGenerico03[$countArray][0];?>" class="Links01">
                                                <?php echo $arrCadastroFiltroGenerico03[$countArray][1];?>
                                            </a>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    
					<?php if($GLOBALS['habilitarCadastroFiltroGenerico04'] == 1){ ?>
                        <tr>
                            <td class="TbFundoMedio TabelaColuna01">
                                <div align="left" class="Texto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico04Nome'], "IncludeConfig"); ?>: 
                                </div>
                            </td>
                            <td class="TbFundoClaro">
                                <div align="left" class="Texto01">
                                    <?php 
									$arrCadastroFiltroGenerico04 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 15);
                                    ?>
									<?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico04); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input type="checkbox" id="idsTbCadastroComplemento[]" name="idsTbCadastroComplemento[]"  value="<?php echo $arrCadastroFiltroGenerico04[$countArray][0];?>" class="CampoCheckBox01" /> 
                                            <a href="CadastroIndice.php?idsTbCadastroComplemento=<?php echo $arrCadastroFiltroGenerico04[$countArray][0];?>" class="Links01">
                                                <?php echo $arrCadastroFiltroGenerico04[$countArray][1];?>
                                            </a>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    
					<?php if($GLOBALS['habilitarCadastroFiltroGenerico05'] == 1){ ?>
                        <tr>
                            <td class="TbFundoMedio TabelaColuna01">
                                <div align="left" class="Texto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico05Nome'], "IncludeConfig"); ?>: 
                                </div>
                            </td>
                            <td class="TbFundoClaro">
                                <div align="left" class="Texto01">
                                    <?php 
									$arrCadastroFiltroGenerico05 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 16);
                                    ?>
									<?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico05); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input type="checkbox" id="idsTbCadastroComplemento[]" name="idsTbCadastroComplemento[]"  value="<?php echo $arrCadastroFiltroGenerico05[$countArray][0];?>" class="CampoCheckBox01" /> 
                                            <a href="CadastroIndice.php?idsTbCadastroComplemento=<?php echo $arrCadastroFiltroGenerico05[$countArray][0];?>" class="Links01">
                                                <?php echo $arrCadastroFiltroGenerico05[$countArray][1];?>
                                            </a>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    
					<?php if($GLOBALS['habilitarCadastroFiltroGenerico06'] == 1){ ?>
                        <tr>
                            <td class="TbFundoMedio TabelaColuna01">
                                <div align="left" class="Texto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico06Nome'], "IncludeConfig"); ?>: 
                                </div>
                            </td>
                            <td class="TbFundoClaro">
                                <div align="left" class="Texto01">
                                    <?php 
									$arrCadastroFiltroGenerico06 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 17);
                                    ?>
									<?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico06); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input type="checkbox" id="idsTbCadastroComplemento[]" name="idsTbCadastroComplemento[]"  value="<?php echo $arrCadastroFiltroGenerico06[$countArray][0];?>" class="CampoCheckBox01" /> 
                                            <a href="CadastroIndice.php?idsTbCadastroComplemento=<?php echo $arrCadastroFiltroGenerico06[$countArray][0];?>" class="Links01">
                                                <?php echo $arrCadastroFiltroGenerico06[$countArray][1];?>
                                            </a>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    
					<?php if($GLOBALS['habilitarCadastroFiltroGenerico07'] == 1){ ?>
                        <tr>
                            <td class="TbFundoMedio TabelaColuna01">
                                <div align="left" class="Texto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico07Nome'], "IncludeConfig"); ?>: 
                                </div>
                            </td>
                            <td class="TbFundoClaro">
                                <div align="left" class="Texto01">
                                    <?php 
									$arrCadastroFiltroGenerico07 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 18);
                                    ?>
									<?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico07); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input type="checkbox" id="idsTbCadastroComplemento[]" name="idsTbCadastroComplemento[]"  value="<?php echo $arrCadastroFiltroGenerico07[$countArray][0];?>" class="CampoCheckBox01" /> 
                                            <a href="CadastroIndice.php?idsTbCadastroComplemento=<?php echo $arrCadastroFiltroGenerico07[$countArray][0];?>" class="Links01">
                                                <?php echo $arrCadastroFiltroGenerico07[$countArray][1];?>
                                            </a>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    
					<?php if($GLOBALS['habilitarCadastroFiltroGenerico08'] == 1){ ?>
                        <tr>
                            <td class="TbFundoMedio TabelaColuna01">
                                <div align="left" class="Texto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico08Nome'], "IncludeConfig"); ?>: 
                                </div>
                            </td>
                            <td class="TbFundoClaro">
                                <div align="left" class="Texto01">
                                    <?php 
									$arrCadastroFiltroGenerico08 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 19);
                                    ?>
									<?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico08); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input type="checkbox" id="idsTbCadastroComplemento[]" name="idsTbCadastroComplemento[]"  value="<?php echo $arrCadastroFiltroGenerico08[$countArray][0];?>" class="CampoCheckBox01" /> 
                                            <a href="CadastroIndice.php?idsTbCadastroComplemento=<?php echo $arrCadastroFiltroGenerico08[$countArray][0];?>" class="Links01">
                                                <?php echo $arrCadastroFiltroGenerico08[$countArray][1];?>
                                            </a>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    
					<?php if($GLOBALS['habilitarCadastroFiltroGenerico09'] == 1){ ?>
                        <tr>
                            <td class="TbFundoMedio TabelaColuna01">
                                <div align="left" class="Texto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico09Nome'], "IncludeConfig"); ?>: 
                                </div>
                            </td>
                            <td class="TbFundoClaro">
                                <div align="left" class="Texto01">
                                    <?php 
                                        $arrCadastroFiltroGenerico09 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 20);
                                    ?>
									<?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico09); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input type="checkbox" id="idsTbCadastroComplemento[]" name="idsTbCadastroComplemento[]"  value="<?php echo $arrCadastroFiltroGenerico09[$countArray][0];?>" class="CampoCheckBox01" /> 
                                            <a href="CadastroIndice.php?idsTbCadastroComplemento=<?php echo $arrCadastroFiltroGenerico09[$countArray][0];?>" class="Links01">
                                                <?php echo $arrCadastroFiltroGenerico09[$countArray][1];?>
                                            </a>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    
					<?php if($GLOBALS['habilitarCadastroFiltroGenerico10'] == 1){ ?>
                        <tr>
                            <td class="TbFundoMedio TabelaColuna01">
                                <div align="left" class="Texto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico10Nome'], "IncludeConfig"); ?>: 
                                </div>
                            </td>
                            <td class="TbFundoClaro">
                                <div align="left" class="Texto01">
                                    <?php 
									$arrCadastroFiltroGenerico10 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 21);
                                    ?>
									<?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico10); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input type="checkbox" id="idsTbCadastroComplemento[]" name="idsTbCadastroComplemento[]"  value="<?php echo $arrCadastroFiltroGenerico10[$countArray][0];?>" class="CampoCheckBox01" /> 
                                            <a href="CadastroIndice.php?idsTbCadastroComplemento=<?php echo $arrCadastroFiltroGenerico10[$countArray][0];?>" class="Links01">
                                                <?php echo $arrCadastroFiltroGenerico10[$countArray][1];?>
                                            </a>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    
					<?php if($GLOBALS['habilitarCadastroFiltroGenerico11'] == 1){ ?>
                        <tr>
                            <td class="TbFundoMedio TabelaColuna01">
                                <div align="left" class="Texto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico11Nome'], "IncludeConfig"); ?>: 
                                </div>
                            </td>
                            <td class="TbFundoClaro">
                                <div align="left" class="Texto01">
                                    <?php 
									$arrCadastroFiltroGenerico11 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 60);
                                    ?>
									<?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico11); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input type="checkbox" id="idsTbCadastroComplemento[]" name="idsTbCadastroComplemento[]"  value="<?php echo $arrCadastroFiltroGenerico11[$countArray][0];?>" class="CampoCheckBox01" /> 
                                            <a href="CadastroIndice.php?idsTbCadastroComplemento=<?php echo $arrCadastroFiltroGenerico11[$countArray][0];?>" class="Links01">
                                                <?php echo $arrCadastroFiltroGenerico11[$countArray][1];?>
                                            </a>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    
					<?php if($GLOBALS['habilitarCadastroFiltroGenerico12'] == 1){ ?>
                        <tr>
                            <td class="TbFundoMedio TabelaColuna01">
                                <div align="left" class="Texto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico12Nome'], "IncludeConfig"); ?>: 
                                </div>
                            </td>
                            <td class="TbFundoClaro">
                                <div align="left" class="Texto01">
                                    <?php 
									$arrCadastroFiltroGenerico12 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 61);
                                    ?>
									<?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico12); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input type="checkbox" id="idsTbCadastroComplemento[]" name="idsTbCadastroComplemento[]"  value="<?php echo $arrCadastroFiltroGenerico12[$countArray][0];?>" class="CampoCheckBox01" /> 
                                            <a href="CadastroIndice.php?idsTbCadastroComplemento=<?php echo $arrCadastroFiltroGenerico12[$countArray][0];?>" class="Links01">
                                                <?php echo $arrCadastroFiltroGenerico12[$countArray][1];?>
                                            </a>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    
					<?php if($GLOBALS['habilitarCadastroFiltroGenerico13'] == 1){ ?>
                        <tr>
                            <td class="TbFundoMedio TabelaColuna01">
                                <div align="left" class="Texto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico13Nome'], "IncludeConfig"); ?>: 
                                </div>
                            </td>
                            <td class="TbFundoClaro">
                                <div align="left" class="Texto01">
                                    <?php 
									$arrCadastroFiltroGenerico13 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 62);
                                    ?>
									<?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico13); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input type="checkbox" id="idsTbCadastroComplemento[]" name="idsTbCadastroComplemento[]"  value="<?php echo $arrCadastroFiltroGenerico13[$countArray][0];?>" class="CampoCheckBox01" /> 
                                            <a href="CadastroIndice.php?idsTbCadastroComplemento=<?php echo $arrCadastroFiltroGenerico13[$countArray][0];?>" class="Links01">
                                                <?php echo $arrCadastroFiltroGenerico13[$countArray][1];?>
                                            </a>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    
					<?php if($GLOBALS['habilitarCadastroFiltroGenerico14'] == 1){ ?>
                        <tr>
                            <td class="TbFundoMedio TabelaColuna01">
                                <div align="left" class="Texto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico14Nome'], "IncludeConfig"); ?>: 
                                </div>
                            </td>
                            <td class="TbFundoClaro">
                                <div align="left" class="Texto01">
                                    <?php 
									$arrCadastroFiltroGenerico14 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 63);
                                    ?>
									<?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico14); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input type="checkbox" id="idsTbCadastroComplemento[]" name="idsTbCadastroComplemento[]"  value="<?php echo $arrCadastroFiltroGenerico14[$countArray][0];?>" class="CampoCheckBox01" /> 
                                            <a href="CadastroIndice.php?idsTbCadastroComplemento=<?php echo $arrCadastroFiltroGenerico14[$countArray][0];?>" class="Links01">
                                                <?php echo $arrCadastroFiltroGenerico14[$countArray][1];?>
                                            </a>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    
					<?php if($GLOBALS['habilitarCadastroFiltroGenerico15'] == 1){ ?>
                        <tr>
                            <td class="TbFundoMedio TabelaColuna01">
                                <div align="left" class="Texto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico15Nome'], "IncludeConfig"); ?>: 
                                </div>
                            </td>
                            <td class="TbFundoClaro">
                                <div align="left" class="Texto01">
                                    <?php 
									$arrCadastroFiltroGenerico15 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 64);
                                    ?>
									<?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico15); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input type="checkbox" id="idsTbCadastroComplemento[]" name="idsTbCadastroComplemento[]"  value="<?php echo $arrCadastroFiltroGenerico15[$countArray][0];?>" class="CampoCheckBox01" /> 
                                            <a href="CadastroIndice.php?idsTbCadastroComplemento=<?php echo $arrCadastroFiltroGenerico15[$countArray][0];?>" class="Links01">
                                                <?php echo $arrCadastroFiltroGenerico15[$countArray][1];?>
                                            </a>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    
					<?php if($GLOBALS['habilitarCadastroFiltroGenerico16'] == 1){ ?>
                        <tr>
                            <td class="TbFundoMedio TabelaColuna01">
                                <div align="left" class="Texto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico16Nome'], "IncludeConfig"); ?>: 
                                </div>
                            </td>
                            <td class="TbFundoClaro">
                                <div align="left" class="Texto01">
                                    <?php 
									$arrCadastroFiltroGenerico16 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 65);
                                    ?>
									<?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico16); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input type="checkbox" id="idsTbCadastroComplemento[]" name="idsTbCadastroComplemento[]"  value="<?php echo $arrCadastroFiltroGenerico16[$countArray][0];?>" class="CampoCheckBox01" /> 
                                            <a href="CadastroIndice.php?idsTbCadastroComplemento=<?php echo $arrCadastroFiltroGenerico16[$countArray][0];?>" class="Links01">
                                                <?php echo $arrCadastroFiltroGenerico16[$countArray][1];?>
                                            </a>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    
					<?php if($GLOBALS['habilitarCadastroFiltroGenerico17'] == 1){ ?>
                        <tr>
                            <td class="TbFundoMedio TabelaColuna01">
                                <div align="left" class="Texto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico17Nome'], "IncludeConfig"); ?>: 
                                </div>
                            </td>
                            <td class="TbFundoClaro">
                                <div align="left" class="Texto01">
                                    <?php 
									$arrCadastroFiltroGenerico17 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 66);
                                    ?>
									<?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico17); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input type="checkbox" id="idsTbCadastroComplemento[]" name="idsTbCadastroComplemento[]"  value="<?php echo $arrCadastroFiltroGenerico17[$countArray][0];?>" class="CampoCheckBox01" /> 
                                            <a href="CadastroIndice.php?idsTbCadastroComplemento=<?php echo $arrCadastroFiltroGenerico17[$countArray][0];?>" class="Links01">
                                                <?php echo $arrCadastroFiltroGenerico17[$countArray][1];?>
                                            </a>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    
					<?php if($GLOBALS['habilitarCadastroFiltroGenerico18'] == 1){ ?>
                        <tr>
                            <td class="TbFundoMedio TabelaColuna01">
                                <div align="left" class="Texto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico18Nome'], "IncludeConfig"); ?>: 
                                </div>
                            </td>
                            <td class="TbFundoClaro">
                                <div align="left" class="Texto01">
                                    <?php 
									$arrCadastroFiltroGenerico18 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 67);
                                    ?>
									<?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico18); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input type="checkbox" id="idsTbCadastroComplemento[]" name="idsTbCadastroComplemento[]"  value="<?php echo $arrCadastroFiltroGenerico18[$countArray][0];?>" class="CampoCheckBox01" /> 
                                            <a href="CadastroIndice.php?idsTbCadastroComplemento=<?php echo $arrCadastroFiltroGenerico18[$countArray][0];?>" class="Links01">
                                                <?php echo $arrCadastroFiltroGenerico18[$countArray][1];?>
                                            </a>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    
					<?php if($GLOBALS['habilitarCadastroFiltroGenerico19'] == 1){ ?>
                        <tr>
                            <td class="TbFundoMedio TabelaColuna01">
                                <div align="left" class="Texto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico19Nome'], "IncludeConfig"); ?>: 
                                </div>
                            </td>
                            <td class="TbFundoClaro">
                                <div align="left" class="Texto01">
                                    <?php 
                                        $arrCadastroFiltroGenerico19 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 68);
                                    ?>
									<?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico19); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input type="checkbox" id="idsTbCadastroComplemento[]" name="idsTbCadastroComplemento[]"  value="<?php echo $arrCadastroFiltroGenerico19[$countArray][0];?>" class="CampoCheckBox01" /> 
                                            <a href="CadastroIndice.php?idsTbCadastroComplemento=<?php echo $arrCadastroFiltroGenerico19[$countArray][0];?>" class="Links01">
                                                <?php echo $arrCadastroFiltroGenerico19[$countArray][1];?>
                                            </a>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    
					<?php if($GLOBALS['habilitarCadastroFiltroGenerico20'] == 1){ ?>
                        <tr>
                            <td class="TbFundoMedio TabelaColuna01">
                                <div align="left" class="Texto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico20Nome'], "IncludeConfig"); ?>: 
                                </div>
                            </td>
                            <td class="TbFundoClaro">
                                <div align="left" class="Texto01">
                                    <?php 
									$arrCadastroFiltroGenerico20 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 69);
                                    ?>
									<?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico20); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input type="checkbox" id="idsTbCadastroComplemento[]" name="idsTbCadastroComplemento[]"  value="<?php echo $arrCadastroFiltroGenerico20[$countArray][0];?>" class="CampoCheckBox01" /> 
                                            <a href="CadastroIndice.php?idsTbCadastroComplemento=<?php echo $arrCadastroFiltroGenerico20[$countArray][0];?>" class="Links01">
                                                <?php echo $arrCadastroFiltroGenerico20[$countArray][1];?>
                                            </a>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    
					<?php if($GLOBALS['habilitarCadastroFiltroGenerico21'] == 1){ ?>
                        <tr>
                            <td class="TbFundoMedio TabelaColuna01">
                                <div align="left" class="Texto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico21Nome'], "IncludeConfig"); ?>: 
                                </div>
                            </td>
                            <td class="TbFundoClaro">
                                <div align="left" class="Texto01">
                                    <?php 
									$arrCadastroFiltroGenerico21 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 70);
                                    ?>
									<?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico21); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input type="checkbox" id="idsTbCadastroComplemento[]" name="idsTbCadastroComplemento[]"  value="<?php echo $arrCadastroFiltroGenerico21[$countArray][0];?>" class="CampoCheckBox01" /> 
                                            <a href="CadastroIndice.php?idsTbCadastroComplemento=<?php echo $arrCadastroFiltroGenerico21[$countArray][0];?>" class="Links01">
                                                <?php echo $arrCadastroFiltroGenerico21[$countArray][1];?>
                                            </a>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    
					<?php if($GLOBALS['habilitarCadastroFiltroGenerico22'] == 1){ ?>
                        <tr>
                            <td class="TbFundoMedio TabelaColuna01">
                                <div align="left" class="Texto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico22Nome'], "IncludeConfig"); ?>: 
                                </div>
                            </td>
                            <td class="TbFundoClaro">
                                <div align="left" class="Texto01">
                                    <?php 
									$arrCadastroFiltroGenerico22 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 71);
                                    ?>
									<?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico22); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input type="checkbox" id="idsTbCadastroComplemento[]" name="idsTbCadastroComplemento[]"  value="<?php echo $arrCadastroFiltroGenerico22[$countArray][0];?>" class="CampoCheckBox01" /> 
                                            <a href="CadastroIndice.php?idsTbCadastroComplemento=<?php echo $arrCadastroFiltroGenerico22[$countArray][0];?>" class="Links01">
                                                <?php echo $arrCadastroFiltroGenerico22[$countArray][1];?>
                                            </a>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    
					<?php if($GLOBALS['habilitarCadastroFiltroGenerico23'] == 1){ ?>
                        <tr>
                            <td class="TbFundoMedio TabelaColuna01">
                                <div align="left" class="Texto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico23Nome'], "IncludeConfig"); ?>: 
                                </div>
                            </td>
                            <td class="TbFundoClaro">
                                <div align="left" class="Texto01">
                                    <?php 
									$arrCadastroFiltroGenerico23 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 72);
                                    ?>
									<?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico23); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input type="checkbox" id="idsTbCadastroComplemento[]" name="idsTbCadastroComplemento[]"  value="<?php echo $arrCadastroFiltroGenerico23[$countArray][0];?>" class="CampoCheckBox01" /> 
                                            <a href="CadastroIndice.php?idsTbCadastroComplemento=<?php echo $arrCadastroFiltroGenerico23[$countArray][0];?>" class="Links01">
                                                <?php echo $arrCadastroFiltroGenerico23[$countArray][1];?>
                                            </a>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    
					<?php if($GLOBALS['habilitarCadastroFiltroGenerico24'] == 1){ ?>
                        <tr>
                            <td class="TbFundoMedio TabelaColuna01">
                                <div align="left" class="Texto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico24Nome'], "IncludeConfig"); ?>: 
                                </div>
                            </td>
                            <td class="TbFundoClaro">
                                <div align="left" class="Texto01">
                                    <?php 
									$arrCadastroFiltroGenerico24 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 73);
                                    ?>
									<?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico24); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input type="checkbox" id="idsTbCadastroComplemento[]" name="idsTbCadastroComplemento[]"  value="<?php echo $arrCadastroFiltroGenerico24[$countArray][0];?>" class="CampoCheckBox01" /> 
                                            <a href="CadastroIndice.php?idsTbCadastroComplemento=<?php echo $arrCadastroFiltroGenerico24[$countArray][0];?>" class="Links01">
                                                <?php echo $arrCadastroFiltroGenerico24[$countArray][1];?>
                                            </a>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    
					<?php if($GLOBALS['habilitarCadastroFiltroGenerico25'] == 1){ ?>
                        <tr>
                            <td class="TbFundoMedio TabelaColuna01">
                                <div align="left" class="Texto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico25Nome'], "IncludeConfig"); ?>: 
                                </div>
                            </td>
                            <td class="TbFundoClaro">
                                <div align="left" class="Texto01">
                                    <?php 
									$arrCadastroFiltroGenerico25 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 74);
                                    ?>
									<?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico25); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input type="checkbox" id="idsTbCadastroComplemento[]" name="idsTbCadastroComplemento[]"  value="<?php echo $arrCadastroFiltroGenerico25[$countArray][0];?>" class="CampoCheckBox01" /> 
                                            <a href="CadastroIndice.php?idsTbCadastroComplemento=<?php echo $arrCadastroFiltroGenerico25[$countArray][0];?>" class="Links01">
                                                <?php echo $arrCadastroFiltroGenerico25[$countArray][1];?>
                                            </a>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    
					<?php if($GLOBALS['habilitarCadastroFiltroGenerico26'] == 1){ ?>
                        <tr>
                            <td class="TbFundoMedio TabelaColuna01">
                                <div align="left" class="Texto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico26Nome'], "IncludeConfig"); ?>: 
                                </div>
                            </td>
                            <td class="TbFundoClaro">
                                <div align="left" class="Texto01">
                                    <?php 
									$arrCadastroFiltroGenerico26 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 75);
                                    ?>
									<?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico26); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input type="checkbox" id="idsTbCadastroComplemento[]" name="idsTbCadastroComplemento[]"  value="<?php echo $arrCadastroFiltroGenerico26[$countArray][0];?>" class="CampoCheckBox01" /> 
                                            <a href="CadastroIndice.php?idsTbCadastroComplemento=<?php echo $arrCadastroFiltroGenerico26[$countArray][0];?>" class="Links01">
                                                <?php echo $arrCadastroFiltroGenerico26[$countArray][1];?>
                                            </a>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    
					<?php if($GLOBALS['habilitarCadastroFiltroGenerico27'] == 1){ ?>
                        <tr>
                            <td class="TbFundoMedio TabelaColuna01">
                                <div align="left" class="Texto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico27Nome'], "IncludeConfig"); ?>: 
                                </div>
                            </td>
                            <td class="TbFundoClaro">
                                <div align="left" class="Texto01">
                                    <?php 
									$arrCadastroFiltroGenerico27 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 76);
                                    ?>
									<?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico27); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input type="checkbox" id="idsTbCadastroComplemento[]" name="idsTbCadastroComplemento[]"  value="<?php echo $arrCadastroFiltroGenerico27[$countArray][0];?>" class="CampoCheckBox01" /> 
                                            <a href="CadastroIndice.php?idsTbCadastroComplemento=<?php echo $arrCadastroFiltroGenerico27[$countArray][0];?>" class="Links01">
                                                <?php echo $arrCadastroFiltroGenerico27[$countArray][1];?>
                                            </a>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    
					<?php if($GLOBALS['habilitarCadastroFiltroGenerico28'] == 1){ ?>
                        <tr>
                            <td class="TbFundoMedio TabelaColuna01">
                                <div align="left" class="Texto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico28Nome'], "IncludeConfig"); ?>: 
                                </div>
                            </td>
                            <td class="TbFundoClaro">
                                <div align="left" class="Texto01">
                                    <?php 
									$arrCadastroFiltroGenerico28 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 77);
                                    ?>
									<?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico28); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input type="checkbox" id="idsTbCadastroComplemento[]" name="idsTbCadastroComplemento[]"  value="<?php echo $arrCadastroFiltroGenerico28[$countArray][0];?>" class="CampoCheckBox01" /> 
                                            <a href="CadastroIndice.php?idsTbCadastroComplemento=<?php echo $arrCadastroFiltroGenerico28[$countArray][0];?>" class="Links01">
                                                <?php echo $arrCadastroFiltroGenerico28[$countArray][1];?>
                                            </a>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    
					<?php if($GLOBALS['habilitarCadastroFiltroGenerico29'] == 1){ ?>
                        <tr>
                            <td class="TbFundoMedio TabelaColuna01">
                                <div align="left" class="Texto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico29Nome'], "IncludeConfig"); ?>: 
                                </div>
                            </td>
                            <td class="TbFundoClaro">
                                <div align="left" class="Texto01">
                                    <?php 
                                        $arrCadastroFiltroGenerico29 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 78);
                                    ?>
									<?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico29); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input type="checkbox" id="idsTbCadastroComplemento[]" name="idsTbCadastroComplemento[]"  value="<?php echo $arrCadastroFiltroGenerico29[$countArray][0];?>" class="CampoCheckBox01" /> 
                                            <a href="CadastroIndice.php?idsTbCadastroComplemento=<?php echo $arrCadastroFiltroGenerico29[$countArray][0];?>" class="Links01">
                                                <?php echo $arrCadastroFiltroGenerico29[$countArray][1];?>
                                            </a>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    
					<?php if($GLOBALS['habilitarCadastroFiltroGenerico30'] == 1){ ?>
                        <tr>
                            <td class="TbFundoMedio TabelaColuna01">
                                <div align="left" class="Texto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico30Nome'], "IncludeConfig"); ?>: 
                                </div>
                            </td>
                            <td class="TbFundoClaro">
                                <div align="left" class="Texto01">
                                    <?php 
									$arrCadastroFiltroGenerico30 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 79);
                                    ?>
									<?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico30); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input type="checkbox" id="idsTbCadastroComplemento[]" name="idsTbCadastroComplemento[]"  value="<?php echo $arrCadastroFiltroGenerico30[$countArray][0];?>" class="CampoCheckBox01" /> 
                                            <a href="CadastroIndice.php?idsTbCadastroComplemento=<?php echo $arrCadastroFiltroGenerico30[$countArray][0];?>" class="Links01">
                                                <?php echo $arrCadastroFiltroGenerico30[$countArray][1];?>
                                            </a>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
				<?php } ?>
                
            </table>
        </div>
        <div align="center">
            <input type="image" name="submit" value="Submit" src="img/btoBuscar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoBusca"); ?>" />
            
            <!--input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" /-->
            <input name="masterPageSelect" type="hidden" id="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
        </div>
    </form>
    <br />
    <?php } ?>
    <?php //**************************************************************************************?>
    
    
    <?php //Busca cadastro contatos.?>
    <?php //**************************************************************************************?>
	<?php if($GLOBALS['habilitarBuscaCadastroContatos'] == 1){ ?>
    <form name="formBuscaCadastroContatos" id="formBuscaCadastroContatos" action="CadastroContatosIndice.php" method="get" class="FormularioTabela01">
        <div>
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBuscaTbCadastroContatos"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBuscaPalavraChave"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div align="left">
                        	<input type="text" name="palavraChave" id="palavraChave" class="CampoTexto01" maxlength="255" />
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div align="center">
            <input type="image" name="submit" value="Submit" src="img/btoBuscar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoBusca"); ?>" />
            
            <!--input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" /-->
            <input name="masterPageSelect" type="hidden" id="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
        </div>
    </form>
    <br />
    <?php } ?>
    <?php //**************************************************************************************?>
    
    
    <?php //Busca cadastro contas bancárias.?>
    <?php //**************************************************************************************?>
	<?php if($GLOBALS['habilitarBuscaCadastroContasBancarias'] == 1){ ?>
    <form name="formBuscaCadastroContasBancarias" id="formBuscaCadastroContasBancarias" action="CadastroContasBancariasIndice.php" method="get" class="FormularioTabela01">
        <div>
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBuscaTbCadastroContasBancarias"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBuscaPalavraChave"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div align="left">
                        	<input type="text" name="palavraChave" id="palavraChave" class="CampoTexto01" maxlength="255" />
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div align="center">
            <input type="image" name="submit" value="Submit" src="img/btoBuscar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoBusca"); ?>" />
            
            <!--input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" /-->
            <input name="masterPageSelect" type="hidden" id="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
        </div>
    </form>
    <br />
    <?php } ?>
    <?php //**************************************************************************************?>
    
    
    <?php //Busca publicações.?>
    <?php //**************************************************************************************?>
	<?php if($GLOBALS['habilitarBuscaPublicacoes'] == 1){ ?>
    <form name="formBuscaPublicacoes" id="formBuscaPublicacoes" action="PublicacoesIndice.php" method="get" class="FormularioTabela01">
        <div>
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBuscaTbPublicacoes"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBuscaPalavraChave"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div align="left">
                        	<input type="text" name="palavraChave" id="palavraChave" class="CampoTexto01" maxlength="255" />
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div align="center">
            <input type="image" name="submit" value="Submit" src="img/btoBuscar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoBusca"); ?>" />
            
            <!--input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" /-->
            <input name="masterPageSelect" type="hidden" id="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
        </div>
    </form>
    <br />
    <?php } ?>
    <?php //**************************************************************************************?>
    
    
    <?php //Busca páginas.?>
    <?php //**************************************************************************************?>
	<?php if($GLOBALS['habilitarBuscaPaginas'] == 1){ ?>
    <form name="formBuscaPaginas" id="formBuscaPaginas" action="PaginasIndice.php" method="get" class="FormularioTabela01">
        <div>
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBuscaTbPaginas"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBuscaPalavraChave"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div align="left">
                        	<input type="text" name="palavraChave" id="palavraChave" class="CampoTexto01" maxlength="255" />
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div align="center">
            <input type="image" name="submit" value="Submit" src="img/btoBuscar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoBusca"); ?>" />
            
            <!--input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" /-->
            <input name="masterPageSelect" type="hidden" id="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
        </div>
    </form>
    <br />
    <?php } ?>
    <?php //**************************************************************************************?>
    
    
    <?php //Busca tarefas.?>
    <?php //**************************************************************************************?>
	<?php if($GLOBALS['habilitarBuscaTarefas'] == 1){ ?>
    <form name="formBuscaTarefas" id="formBuscaTarefas" action="TarefasIndice.php" method="get" class="FormularioTabela01">
        <div>
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="4">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBuscaTbTarefas"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <?php if($GLOBALS['habilitarBuscaTarefasFiltros'] == 1){ ?>
                    <tr>
                        <td class="TbFundoMedio TabelaColuna01">
                            <div align="left" class="Texto01">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBuscaData"); ?>:
                            </div>
                        </td>
                        <td class="TbFundoClaro">
                            <div align="left">
                                <script type="text/javascript">
                                    //Variável para conter todos os campos que funcionam com o DatePicker.
                                    //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                    var strDatapickerAgendaPtCampos = "";
                                    var strDatapickerAgendaEnCampos = "";
                                </script>
                                <?php //JQuery DatePicker. ?>
                                <?php //---------------------- ?>
                                <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                    <?php if($GLOBALS['configSistemaFormatoData'] == 1){ ?>
                                        <script type="text/javascript">
                                            //Variável para conter todos os campos que funcionam com o DatePicker.
                                            //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                            //var strDatapickerAgendaPtCampos = "#data_tarefa";
                                            strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data_tarefa_pesquisa;";
                                        </script>
                                    <?php } ?>
                                    <?php if($GLOBALS['configSistemaFormatoData'] == 2){ ?>
                                        <script type="text/javascript">
                                            //Variável para conter todos os campos que funcionam com o DatePicker.
                                            //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                            //var strDatapickerAgendaEnCampos = "#data_tarefa";
                                            strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data_tarefa_pesquisa;";
                                        </script>
                                    <?php } ?>
                                    <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                                    
                                    <input type="text" name="data_tarefa_pesquisa" id="data_tarefa_pesquisa" class="CampoData01" maxlength="10" value="<?php echo $dataTarefaPesquisa; ?>" />
                                    <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                                <?php } ?>
                                <?php //---------------------- ?>
                            </div>
                        </td>
                        
                        <td class="TbFundoMedio TabelaColuna01">
                            <div align="left" class="Texto01">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBuscaDataFinal"); ?>:
                            </div>
                        </td>
                        <td class="TbFundoClaro">
                            <div align="left">
                                <script type="text/javascript">
                                    //Variável para conter todos os campos que funcionam com o DatePicker.
                                    //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                    //var strDatapickerAgendaPtCampos = "";
                                    //var strDatapickerAgendaEnCampos = "";
                                </script>
                                <?php //JQuery DatePicker. ?>
                                <?php //---------------------- ?>
                                <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                    <?php if($GLOBALS['configSistemaFormatoData'] == 1){ ?>
                                        <script type="text/javascript">
                                            //Variável para conter todos os campos que funcionam com o DatePicker.
                                            //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                            //var strDatapickerAgendaPtCampos = "#data_tarefa";
                                            strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data_final_tarefa_pesquisa;";
                                        </script>
                                    <?php } ?>
                                    <?php if($GLOBALS['configSistemaFormatoData'] == 2){ ?>
                                        <script type="text/javascript">
                                            //Variável para conter todos os campos que funcionam com o DatePicker.
                                            //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                            //var strDatapickerAgendaEnCampos = "#data_tarefa";
                                            strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data_final_tarefa_pesquisa;";
                                        </script>
                                    <?php } ?>
                                    <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                                    
                                    <input type="text" name="data_final_tarefa_pesquisa" id="data_final_tarefa_pesquisa" class="CampoData01" maxlength="10" value="<?php echo $dataFinalTarefaPesquisa; ?>" />
                                    <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                                <?php } ?>
                                <?php //---------------------- ?>
                            </div>
                        </td>
                    </tr>

                	<?php if($GLOBALS['habilitarTarefasStatus'] == 1){ ?>
                        <tr>
                            <td class="TbFundoMedio TabelaColuna01">
                                <div align="left" class="Texto01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaTarefasStatus"); ?>:
                                </div>
                            </td>
                            <td class="TbFundoClaro">
								<?php 
                                    $arrTarefasStatus = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 9);
                                ?>
                            	<div align="left" style="display:none;">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrTarefasStatus); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input type="checkbox" id="idsTbTarefasStatus[]" name="idsTbTarefasStatus[]" value="<?php echo $arrTarefasStatus[$countArray][0];?>" class="CampoCheckBox01" /> 
                                            <a href="TarefasIndice.php?idsTbTarefasStatus=<?php echo $arrTarefasStatus[$countArray][0];?>" class="Links01">
                                                <?php echo $arrTarefasStatus[$countArray][1];?>
                                            </a>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                </div>
                                
                                <select name="idTbTarefaStatus" id="idTbTarefaStatus" class="CampoDropDownMenu01">
                                    <option value="" selected="selected"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrTarefasStatus); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrTarefasStatus[$countArray][0];?>"><?php echo $arrTarefasStatus[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
					<?php } ?>
                <?php } ?>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBuscaPalavraChave"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div align="left">
                        	<input type="text" name="palavraChave" id="palavraChave" class="CampoTexto01" maxlength="255" />
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div align="center">
            <input type="image" name="submit" value="Submit" src="img/btoBuscar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoBusca"); ?>" />
            
            <!--input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" /-->
            <input name="masterPageSelect" type="hidden" id="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
        </div>
    </form>
    <br />
    <?php } ?>
    <?php //**************************************************************************************?>
    
    
    <?php //Busca cadastro.?>
    <?php //**************************************************************************************?>
	<?php if($GLOBALS['habilitarBuscaVeiculos'] == 1){ ?>
    <form name="formBuscaVeiculos" id="formBuscaVeiculos" action="VeiculosIndice.php" method="get" class="FormularioTabela01">
        <div>
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBuscaTbVeiculos"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBuscaPalavraChave"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div align="left">
                        	<input type="text" name="palavraChave" id="palavraChave" class="CampoTexto01" maxlength="255" />
                        </div>
                    </td>
                </tr>
                
                <?php if($GLOBALS['habilitarBuscaVeiculosFiltros'] == 1){ ?>
					<?php if($GLOBALS['habilitarVeiculosTipo'] == 1){ ?>
                        <tr>
                            <td class="TbFundoMedio TabelaColuna01">
                                <div align="left" class="Texto01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaVeiculosTipo"); ?>:
                                </div>
                            </td>
                            <td class="TbFundoClaro">
								<?php 
								$arrVeiculosTipo = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 2);
                                ?>
                                
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosTipo); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input type="checkbox" id="idsTbVeiculosComplemento[]" name="idsTbVeiculosComplemento[]" value="<?php echo $arrVeiculosTipo[$countArray][0];?>" class="CampoCheckBox01" /> 
										<a href="VeiculosIndice.php?idsTbVeiculosComplemento=<?php echo $arrVeiculosTipo[$countArray][0];?>" class="Links01">
											<?php echo $arrVeiculosTipo[$countArray][1];?>
                                        </a>
                                    </div>
                                <?php 
                                }
                                ?>
                            </td>
                        </tr>
                    <?php } ?>
                    
					<?php if($GLOBALS['habilitarVeiculosFiltroGenerico01'] == 1){ ?>
                        <tr>
                            <td class="TbFundoMedio TabelaColuna01">
                                <div align="left" class="Texto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico01Nome'], "IncludeConfig"); ?>: 
                                </div>
                            </td>
                            <td class="TbFundoClaro">
                                <div align="left" class="Texto01">
                                    <?php 
									$arrVeiculosFiltroGenerico01 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 12);
                                    ?>
									<?php 
                                    for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico01); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input type="checkbox" id="idsTbVeiculosComplemento[]" name="idsTbVeiculosComplemento[]"  value="<?php echo $arrVeiculosFiltroGenerico01[$countArray][0];?>" class="CampoCheckBox01" /> 
                                            <a href="VeiculosIndice.php?idsTbVeiculosComplemento=<?php echo $arrVeiculosFiltroGenerico01[$countArray][0];?>" class="Links01">
                                                <?php echo $arrVeiculosFiltroGenerico01[$countArray][1];?>
                                            </a>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    
					<?php if($GLOBALS['habilitarVeiculosFiltroGenerico02'] == 1){ ?>
                        <tr>
                            <td class="TbFundoMedio TabelaColuna01">
                                <div align="left" class="Texto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico02Nome'], "IncludeConfig"); ?>: 
                                </div>
                            </td>
                            <td class="TbFundoClaro">
                                <div align="left" class="Texto01">
                                    <?php 
									$arrVeiculosFiltroGenerico02 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 13);
                                    ?>
									<?php 
                                    for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico02); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input type="checkbox" id="idsTbVeiculosComplemento[]" name="idsTbVeiculosComplemento[]"  value="<?php echo $arrVeiculosFiltroGenerico02[$countArray][0];?>" class="CampoCheckBox01" /> 
                                            <a href="VeiculosIndice.php?idsTbVeiculosComplemento=<?php echo $arrVeiculosFiltroGenerico02[$countArray][0];?>" class="Links01">
                                                <?php echo $arrVeiculosFiltroGenerico02[$countArray][1];?>
                                            </a>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    
					<?php if($GLOBALS['habilitarVeiculosFiltroGenerico03'] == 1){ ?>
                        <tr>
                            <td class="TbFundoMedio TabelaColuna01">
                                <div align="left" class="Texto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico03Nome'], "IncludeConfig"); ?>: 
                                </div>
                            </td>
                            <td class="TbFundoClaro">
                                <div align="left" class="Texto01">
                                    <?php 
									$arrVeiculosFiltroGenerico03 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 14);
                                    ?>
									<?php 
                                    for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico03); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input type="checkbox" id="idsTbVeiculosComplemento[]" name="idsTbVeiculosComplemento[]"  value="<?php echo $arrVeiculosFiltroGenerico03[$countArray][0];?>" class="CampoCheckBox01" /> 
                                            <a href="VeiculosIndice.php?idsTbVeiculosComplemento=<?php echo $arrVeiculosFiltroGenerico03[$countArray][0];?>" class="Links01">
                                                <?php echo $arrVeiculosFiltroGenerico03[$countArray][1];?>
                                            </a>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    
					<?php if($GLOBALS['habilitarVeiculosFiltroGenerico04'] == 1){ ?>
                        <tr>
                            <td class="TbFundoMedio TabelaColuna01">
                                <div align="left" class="Texto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico04Nome'], "IncludeConfig"); ?>: 
                                </div>
                            </td>
                            <td class="TbFundoClaro">
                                <div align="left" class="Texto01">
                                    <?php 
									$arrVeiculosFiltroGenerico04 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 15);
                                    ?>
									<?php 
                                    for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico04); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input type="checkbox" id="idsTbVeiculosComplemento[]" name="idsTbVeiculosComplemento[]"  value="<?php echo $arrVeiculosFiltroGenerico04[$countArray][0];?>" class="CampoCheckBox01" /> 
                                            <a href="VeiculosIndice.php?idsTbVeiculosComplemento=<?php echo $arrVeiculosFiltroGenerico04[$countArray][0];?>" class="Links01">
                                                <?php echo $arrVeiculosFiltroGenerico04[$countArray][1];?>
                                            </a>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    
					<?php if($GLOBALS['habilitarVeiculosFiltroGenerico05'] == 1){ ?>
                        <tr>
                            <td class="TbFundoMedio TabelaColuna01">
                                <div align="left" class="Texto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico05Nome'], "IncludeConfig"); ?>: 
                                </div>
                            </td>
                            <td class="TbFundoClaro">
                                <div align="left" class="Texto01">
                                    <?php 
									$arrVeiculosFiltroGenerico05 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 16);
                                    ?>
									<?php 
                                    for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico05); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input type="checkbox" id="idsTbVeiculosComplemento[]" name="idsTbVeiculosComplemento[]"  value="<?php echo $arrVeiculosFiltroGenerico05[$countArray][0];?>" class="CampoCheckBox01" /> 
                                            <a href="VeiculosIndice.php?idsTbVeiculosComplemento=<?php echo $arrVeiculosFiltroGenerico05[$countArray][0];?>" class="Links01">
                                                <?php echo $arrVeiculosFiltroGenerico05[$countArray][1];?>
                                            </a>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    
					<?php if($GLOBALS['habilitarVeiculosFiltroGenerico06'] == 1){ ?>
                        <tr>
                            <td class="TbFundoMedio TabelaColuna01">
                                <div align="left" class="Texto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico06Nome'], "IncludeConfig"); ?>: 
                                </div>
                            </td>
                            <td class="TbFundoClaro">
                                <div align="left" class="Texto01">
                                    <?php 
									$arrVeiculosFiltroGenerico06 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 17);
                                    ?>
									<?php 
                                    for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico06); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input type="checkbox" id="idsTbVeiculosComplemento[]" name="idsTbVeiculosComplemento[]"  value="<?php echo $arrVeiculosFiltroGenerico06[$countArray][0];?>" class="CampoCheckBox01" /> 
                                            <a href="VeiculosIndice.php?idsTbVeiculosComplemento=<?php echo $arrVeiculosFiltroGenerico06[$countArray][0];?>" class="Links01">
                                                <?php echo $arrVeiculosFiltroGenerico06[$countArray][1];?>
                                            </a>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    
					<?php if($GLOBALS['habilitarVeiculosFiltroGenerico07'] == 1){ ?>
                        <tr>
                            <td class="TbFundoMedio TabelaColuna01">
                                <div align="left" class="Texto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico07Nome'], "IncludeConfig"); ?>: 
                                </div>
                            </td>
                            <td class="TbFundoClaro">
                                <div align="left" class="Texto01">
                                    <?php 
									$arrVeiculosFiltroGenerico07 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 18);
                                    ?>
									<?php 
                                    for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico07); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input type="checkbox" id="idsTbVeiculosComplemento[]" name="idsTbVeiculosComplemento[]"  value="<?php echo $arrVeiculosFiltroGenerico07[$countArray][0];?>" class="CampoCheckBox01" /> 
                                            <a href="VeiculosIndice.php?idsTbVeiculosComplemento=<?php echo $arrVeiculosFiltroGenerico07[$countArray][0];?>" class="Links01">
                                                <?php echo $arrVeiculosFiltroGenerico07[$countArray][1];?>
                                            </a>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    
					<?php if($GLOBALS['habilitarVeiculosFiltroGenerico08'] == 1){ ?>
                        <tr>
                            <td class="TbFundoMedio TabelaColuna01">
                                <div align="left" class="Texto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico08Nome'], "IncludeConfig"); ?>: 
                                </div>
                            </td>
                            <td class="TbFundoClaro">
                                <div align="left" class="Texto01">
                                    <?php 
									$arrVeiculosFiltroGenerico08 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 19);
                                    ?>
									<?php 
                                    for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico08); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input type="checkbox" id="idsTbVeiculosComplemento[]" name="idsTbVeiculosComplemento[]"  value="<?php echo $arrVeiculosFiltroGenerico08[$countArray][0];?>" class="CampoCheckBox01" /> 
                                            <a href="VeiculosIndice.php?idsTbVeiculosComplemento=<?php echo $arrVeiculosFiltroGenerico08[$countArray][0];?>" class="Links01">
                                                <?php echo $arrVeiculosFiltroGenerico08[$countArray][1];?>
                                            </a>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    
					<?php if($GLOBALS['habilitarVeiculosFiltroGenerico09'] == 1){ ?>
                        <tr>
                            <td class="TbFundoMedio TabelaColuna01">
                                <div align="left" class="Texto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico09Nome'], "IncludeConfig"); ?>: 
                                </div>
                            </td>
                            <td class="TbFundoClaro">
                                <div align="left" class="Texto01">
                                    <?php 
									$arrVeiculosFiltroGenerico09 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 20);
                                    ?>
									<?php 
                                    for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico09); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input type="checkbox" id="idsTbVeiculosComplemento[]" name="idsTbVeiculosComplemento[]"  value="<?php echo $arrVeiculosFiltroGenerico09[$countArray][0];?>" class="CampoCheckBox01" /> 
                                            <a href="VeiculosIndice.php?idsTbVeiculosComplemento=<?php echo $arrVeiculosFiltroGenerico09[$countArray][0];?>" class="Links01">
                                                <?php echo $arrVeiculosFiltroGenerico09[$countArray][1];?>
                                            </a>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    
					<?php if($GLOBALS['habilitarVeiculosFiltroGenerico10'] == 1){ ?>
                        <tr>
                            <td class="TbFundoMedio TabelaColuna01">
                                <div align="left" class="Texto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico10Nome'], "IncludeConfig"); ?>: 
                                </div>
                            </td>
                            <td class="TbFundoClaro">
                                <div align="left" class="Texto01">
                                    <?php 
									$arrVeiculosFiltroGenerico10 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 21);
                                    ?>
									<?php 
                                    for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico10); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input type="checkbox" id="idsTbVeiculosComplemento[]" name="idsTbVeiculosComplemento[]"  value="<?php echo $arrVeiculosFiltroGenerico10[$countArray][0];?>" class="CampoCheckBox01" /> 
                                            <a href="VeiculosIndice.php?idsTbVeiculosComplemento=<?php echo $arrVeiculosFiltroGenerico10[$countArray][0];?>" class="Links01">
                                                <?php echo $arrVeiculosFiltroGenerico10[$countArray][1];?>
                                            </a>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    
					<?php if($GLOBALS['habilitarVeiculosFiltroGenerico11'] == 1){ ?>
                        <tr>
                            <td class="TbFundoMedio TabelaColuna01">
                                <div align="left" class="Texto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico11Nome'], "IncludeConfig"); ?>: 
                                </div>
                            </td>
                            <td class="TbFundoClaro">
                                <div align="left" class="Texto01">
                                    <?php 
									$arrVeiculosFiltroGenerico11 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 22);
                                    ?>
									<?php 
                                    for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico11); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input type="checkbox" id="idsTbVeiculosComplemento[]" name="idsTbVeiculosComplemento[]"  value="<?php echo $arrVeiculosFiltroGenerico11[$countArray][0];?>" class="CampoCheckBox01" /> 
                                            <a href="VeiculosIndice.php?idsTbVeiculosComplemento=<?php echo $arrVeiculosFiltroGenerico11[$countArray][0];?>" class="Links01">
                                                <?php echo $arrVeiculosFiltroGenerico11[$countArray][1];?>
                                            </a>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    
					<?php if($GLOBALS['habilitarVeiculosFiltroGenerico12'] == 1){ ?>
                        <tr>
                            <td class="TbFundoMedio TabelaColuna01">
                                <div align="left" class="Texto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico12Nome'], "IncludeConfig"); ?>: 
                                </div>
                            </td>
                            <td class="TbFundoClaro">
                                <div align="left" class="Texto01">
                                    <?php 
									$arrVeiculosFiltroGenerico12 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 23);
                                    ?>
									<?php 
                                    for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico12); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input type="checkbox" id="idsTbVeiculosComplemento[]" name="idsTbVeiculosComplemento[]"  value="<?php echo $arrVeiculosFiltroGenerico12[$countArray][0];?>" class="CampoCheckBox01" /> 
                                            <a href="VeiculosIndice.php?idsTbVeiculosComplemento=<?php echo $arrVeiculosFiltroGenerico12[$countArray][0];?>" class="Links01">
                                                <?php echo $arrVeiculosFiltroGenerico12[$countArray][1];?>
                                            </a>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    
					<?php if($GLOBALS['habilitarVeiculosFiltroGenerico13'] == 1){ ?>
                        <tr>
                            <td class="TbFundoMedio TabelaColuna01">
                                <div align="left" class="Texto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico13Nome'], "IncludeConfig"); ?>: 
                                </div>
                            </td>
                            <td class="TbFundoClaro">
                                <div align="left" class="Texto01">
                                    <?php 
									$arrVeiculosFiltroGenerico13 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 24);
                                    ?>
									<?php 
                                    for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico13); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input type="checkbox" id="idsTbVeiculosComplemento[]" name="idsTbVeiculosComplemento[]"  value="<?php echo $arrVeiculosFiltroGenerico13[$countArray][0];?>" class="CampoCheckBox01" /> 
                                            <a href="VeiculosIndice.php?idsTbVeiculosComplemento=<?php echo $arrVeiculosFiltroGenerico13[$countArray][0];?>" class="Links01">
                                                <?php echo $arrVeiculosFiltroGenerico13[$countArray][1];?>
                                            </a>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    
					<?php if($GLOBALS['habilitarVeiculosFiltroGenerico14'] == 1){ ?>
                        <tr>
                            <td class="TbFundoMedio TabelaColuna01">
                                <div align="left" class="Texto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico14Nome'], "IncludeConfig"); ?>: 
                                </div>
                            </td>
                            <td class="TbFundoClaro">
                                <div align="left" class="Texto01">
                                    <?php 
									$arrVeiculosFiltroGenerico14 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 25);
                                    ?>
									<?php 
                                    for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico14); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input type="checkbox" id="idsTbVeiculosComplemento[]" name="idsTbVeiculosComplemento[]"  value="<?php echo $arrVeiculosFiltroGenerico14[$countArray][0];?>" class="CampoCheckBox01" /> 
                                            <a href="VeiculosIndice.php?idsTbVeiculosComplemento=<?php echo $arrVeiculosFiltroGenerico14[$countArray][0];?>" class="Links01">
                                                <?php echo $arrVeiculosFiltroGenerico14[$countArray][1];?>
                                            </a>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    
					<?php if($GLOBALS['habilitarVeiculosFiltroGenerico15'] == 1){ ?>
                        <tr>
                            <td class="TbFundoMedio TabelaColuna01">
                                <div align="left" class="Texto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico15Nome'], "IncludeConfig"); ?>: 
                                </div>
                            </td>
                            <td class="TbFundoClaro">
                                <div align="left" class="Texto01">
                                    <?php 
									$arrVeiculosFiltroGenerico15 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 26);
                                    ?>
									<?php 
                                    for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico15); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input type="checkbox" id="idsTbVeiculosComplemento[]" name="idsTbVeiculosComplemento[]"  value="<?php echo $arrVeiculosFiltroGenerico15[$countArray][0];?>" class="CampoCheckBox01" /> 
                                            <a href="VeiculosIndice.php?idsTbVeiculosComplemento=<?php echo $arrVeiculosFiltroGenerico15[$countArray][0];?>" class="Links01">
                                                <?php echo $arrVeiculosFiltroGenerico15[$countArray][1];?>
                                            </a>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    
					<?php if($GLOBALS['habilitarVeiculosFiltroGenerico16'] == 1){ ?>
                        <tr>
                            <td class="TbFundoMedio TabelaColuna01">
                                <div align="left" class="Texto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico16Nome'], "IncludeConfig"); ?>: 
                                </div>
                            </td>
                            <td class="TbFundoClaro">
                                <div align="left" class="Texto01">
                                    <?php 
									$arrVeiculosFiltroGenerico16 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 27);
                                    ?>
									<?php 
                                    for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico16); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input type="checkbox" id="idsTbVeiculosComplemento[]" name="idsTbVeiculosComplemento[]"  value="<?php echo $arrVeiculosFiltroGenerico16[$countArray][0];?>" class="CampoCheckBox01" /> 
                                            <a href="VeiculosIndice.php?idsTbVeiculosComplemento=<?php echo $arrVeiculosFiltroGenerico16[$countArray][0];?>" class="Links01">
                                                <?php echo $arrVeiculosFiltroGenerico16[$countArray][1];?>
                                            </a>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    
					<?php if($GLOBALS['habilitarVeiculosFiltroGenerico17'] == 1){ ?>
                        <tr>
                            <td class="TbFundoMedio TabelaColuna01">
                                <div align="left" class="Texto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico17Nome'], "IncludeConfig"); ?>: 
                                </div>
                            </td>
                            <td class="TbFundoClaro">
                                <div align="left" class="Texto01">
                                    <?php 
									$arrVeiculosFiltroGenerico17 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 28);
                                    ?>
									<?php 
                                    for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico17); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input type="checkbox" id="idsTbVeiculosComplemento[]" name="idsTbVeiculosComplemento[]"  value="<?php echo $arrVeiculosFiltroGenerico17[$countArray][0];?>" class="CampoCheckBox01" /> 
                                            <a href="VeiculosIndice.php?idsTbVeiculosComplemento=<?php echo $arrVeiculosFiltroGenerico17[$countArray][0];?>" class="Links01">
                                                <?php echo $arrVeiculosFiltroGenerico17[$countArray][1];?>
                                            </a>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    
					<?php if($GLOBALS['habilitarVeiculosFiltroGenerico18'] == 1){ ?>
                        <tr>
                            <td class="TbFundoMedio TabelaColuna01">
                                <div align="left" class="Texto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico18Nome'], "IncludeConfig"); ?>: 
                                </div>
                            </td>
                            <td class="TbFundoClaro">
                                <div align="left" class="Texto01">
                                    <?php 
									$arrVeiculosFiltroGenerico18 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 29);
                                    ?>
									<?php 
                                    for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico18); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input type="checkbox" id="idsTbVeiculosComplemento[]" name="idsTbVeiculosComplemento[]"  value="<?php echo $arrVeiculosFiltroGenerico18[$countArray][0];?>" class="CampoCheckBox01" /> 
                                            <a href="VeiculosIndice.php?idsTbVeiculosComplemento=<?php echo $arrVeiculosFiltroGenerico18[$countArray][0];?>" class="Links01">
                                                <?php echo $arrVeiculosFiltroGenerico18[$countArray][1];?>
                                            </a>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    
					<?php if($GLOBALS['habilitarVeiculosFiltroGenerico19'] == 1){ ?>
                        <tr>
                            <td class="TbFundoMedio TabelaColuna01">
                                <div align="left" class="Texto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico19Nome'], "IncludeConfig"); ?>: 
                                </div>
                            </td>
                            <td class="TbFundoClaro">
                                <div align="left" class="Texto01">
                                    <?php 
									$arrVeiculosFiltroGenerico19 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 30);
                                    ?>
									<?php 
                                    for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico19); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input type="checkbox" id="idsTbVeiculosComplemento[]" name="idsTbVeiculosComplemento[]"  value="<?php echo $arrVeiculosFiltroGenerico19[$countArray][0];?>" class="CampoCheckBox01" /> 
                                            <a href="VeiculosIndice.php?idsTbVeiculosComplemento=<?php echo $arrVeiculosFiltroGenerico19[$countArray][0];?>" class="Links01">
                                                <?php echo $arrVeiculosFiltroGenerico19[$countArray][1];?>
                                            </a>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    
					<?php if($GLOBALS['habilitarVeiculosFiltroGenerico20'] == 1){ ?>
                        <tr>
                            <td class="TbFundoMedio TabelaColuna01">
                                <div align="left" class="Texto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico20Nome'], "IncludeConfig"); ?>: 
                                </div>
                            </td>
                            <td class="TbFundoClaro">
                                <div align="left" class="Texto01">
                                    <?php 
									$arrVeiculosFiltroGenerico20 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 31);
                                    ?>
									<?php 
                                    for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico20); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input type="checkbox" id="idsTbVeiculosComplemento[]" name="idsTbVeiculosComplemento[]"  value="<?php echo $arrVeiculosFiltroGenerico20[$countArray][0];?>" class="CampoCheckBox01" /> 
                                            <a href="VeiculosIndice.php?idsTbVeiculosComplemento=<?php echo $arrVeiculosFiltroGenerico20[$countArray][0];?>" class="Links01">
                                                <?php echo $arrVeiculosFiltroGenerico20[$countArray][1];?>
                                            </a>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    
                    
				<?php } ?>
                
                
            </table>
        </div>
        <div align="center">
            <input type="image" name="submit" value="Submit" src="img/btoBuscar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoBusca"); ?>" />
            
            <!--input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" /-->
            <input name="masterPageSelect" type="hidden" id="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
        </div>
    </form>
    <br />
    <?php } ?>
    <?php //**************************************************************************************?>
    
    
    <?php //Busca processos.?>
    <?php //**************************************************************************************?>
	<?php if($GLOBALS['habilitarBuscaProcessos'] == 1){ ?>
    <form name="formBuscaProcessos" id="formBuscaProcessos" action="ProcessosIndice.php" method="get" class="FormularioTabela01">
        <div>
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBuscaTbProcessos"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBuscaPalavraChave"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div align="left">
                        	<input type="text" name="palavraChave" id="palavraChave" class="CampoTexto01" maxlength="255" />
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div align="center">
            <input type="image" name="submit" value="Submit" src="img/btoBuscar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoBusca"); ?>" />
            
            <!--input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" /-->
            <input name="masterPageSelect" type="hidden" id="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
        </div>
    </form>
    <br />
    <?php } ?>
    <?php //**************************************************************************************?>

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