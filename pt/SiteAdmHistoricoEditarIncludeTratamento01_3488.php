                        <div style="position: absolute; display: block; top: 4px; left: 5px;">
                            <div align="left" class="AdmTexto01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoVinculo2Nome'], "IncludeConfig"); ?>:
                            </div>
                            <div class="AdmTexto01">
                                <?php 
                                    $arrHistoricoVinculo2 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbHistoricoVinculo2'], $GLOBALS['configIdTbTipoHistoricoVinculo2'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoHistoricoVinculo2'], $GLOBALS['configHistoricoVinculo2Metodo']);
                                ?>
                                <select name="id_tb_cadastro2" id="id_tb_cadastro2" class="AdmCampoDropDownMenu01" style="width: 180px;">
                                    <option value="0"<?php if($tbHistoricoIdTbCadastro2 == 0){ ?>selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNenhumDropDown"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoVinculo2); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoVinculo2[$countArray][0];?>"<?php if($arrHistoricoVinculo2[$countArray][0] == $tbHistoricoIdTbCadastro2){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoVinculo2[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        
                        <div style="position: absolute; display: block; top: 4px; left: 205px;">
                            <div align="left" class="AdmTexto01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico03Nome'], "IncludeConfig"); ?>: 
                            </div>
                            <div class="AdmTexto01">
                                <?php
                                //Seleção de ids selecionados para o registro.
                                $arrHistoricoFiltroGenerico03Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "14", "", ",", "", "1"));
                                ?>
        
                                <?php 
                                $arrHistoricoFiltroGenerico03 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 14);
                                ?>
                                
                                <?php if($GLOBALS['configHistoricoFiltroGenerico03CaixaSelecao'] == 1){ ?>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico03); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input name="idsHistoricoFiltroGenerico03[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico03[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico03[$countArray][0], $arrHistoricoFiltroGenerico03Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico03[$countArray][1];?>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                <?php } ?>
                                <?php if($GLOBALS['configHistoricoFiltroGenerico03CaixaSelecao'] == 2){ ?>
                                    <select id="idsHistoricoFiltroGenerico03" name="idsHistoricoFiltroGenerico03[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico03); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrHistoricoFiltroGenerico03[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico03[$countArray][0], $arrHistoricoFiltroGenerico03Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico03[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select> 
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                <?php } ?>
                                <?php if($GLOBALS['configHistoricoFiltroGenerico03CaixaSelecao'] == 3){ ?>
                                    <select id="idsHistoricoFiltroGenerico03" name="idsHistoricoFiltroGenerico03[]" class="AdmCampoDropDownMenu01">
                                        <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico03); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrHistoricoFiltroGenerico03[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico03[$countArray][0], $arrHistoricoFiltroGenerico03Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico03[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select>
                                <?php } ?>
                                
                                <?php 
                                $flagManutencaoLink = $configManutencaoLinkFlag;
                                if($configManutencaoLinkFlag != true)
                                {
                                    if(empty($arrHistoricoFiltroGenerico03))
                                    { 
                                        $flagManutencaoLink = true;
                                    }else{
                                        $flagManutencaoLink = false;
                                    }
                                }
                                ?>
                                <?php if($flagManutencaoLink == true){ ?>
                                    <?php if($configManutencaoLink == 1){ ?>
                                        <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                        </a>
                                    <?php } ?>
                                    <?php if($configManutencaoLink == 2){ ?>
                                        <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=14&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                        </a>
                                    <?php } ?>
                                    <?php if($configManutencaoLink == 3){ ?>
                                        <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=14&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $idTbHistorico;?>&configCaixaSelecao=<?php echo $GLOBALS['configHistoricoFiltroGenerico03CaixaSelecao'];?>', '', '', '');
                                                    divShow('divManutencaoAjax');
                                                    HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=14&tipoRetorno=3&idItem=<?php echo $idTbHistorico;?>\', \'idsHistoricoFiltroGenerico03\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico03CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                            <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            <img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                        </a>
                                    <?php } ?>                                
                                <?php } ?>
                            </div>
                        </div>
                        
                        <div style="position: absolute; display: block; top: 40px; left: 5px;">
                            <div align="left" class="AdmTexto01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc3'], "IncludeConfig"); ?>:
                            </div>
                            <div>
                                <?php if($GLOBALS['configHistoricoBoxIc3'] == 1){ ?>
                                    <input type="text" name="informacao_complementar3" id="informacao_complementar3" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC3;?>" />
                                <?php } ?>
                                <?php if($GLOBALS['configHistoricoBoxIc3'] == 2){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar3" id="informacao_complementar3" class="AdmCampoTextoMultilinha01" style="width: 465px; height: 30px;"><?php echo $tbHistoricoIC3;?></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação básica (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                        
                                        <script type="text/javascript">
                                            //Caixa básica.
                                            $(document).ready(function () {
                                                $("#informacao_complementar3").cleditor(
                                                    {
                                                        //Controles disponíveis na barra de ferramentas.
                                                        controls:
                                                        CLEditorBasicoControles
                                                        , 
                                                
                                                        //Fontes disponíveis.
                                                        fonts:        
                                                        CLEditorBasicoFontes
                                                    }
                                                );
                                            });
                                        </script>
                                        <textarea name="informacao_complementar3" id="informacao_complementar3"><?php echo $tbHistoricoIC3;?></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação avançada (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $("#informacao_complementar3").cleditor(
                                                    {
                                                        //Controles disponíveis na barra de ferramentas.
                                                        controls:
                                                        CLEditorAvancadoControles
                                                        , 
                                                
                                                        //Fontes disponíveis.
                                                        fonts:        
                                                        CLEditorAvancadoFontes
                                                    }
                                                );
                                            });
                                        </script>
                                        <textarea name="informacao_complementar3" id="informacao_complementar3"><?php echo $tbHistoricoIC3;?></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                        
                        <div style="position: absolute; display: block; top: 93px; left: 5px;">
                            <div align="left" class="AdmTexto01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico04Nome'], "IncludeConfig"); ?>: 
                            </div>
                            <div class="AdmTexto01">
                                <?php
                                //Seleção de ids selecionados para o registro.
                                $arrHistoricoFiltroGenerico04Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "15", "", ",", "", "1"));
                                ?>
                            
                                <?php 
                                $arrHistoricoFiltroGenerico04 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 15);
                                ?>
                                
                                <?php if($GLOBALS['configHistoricoFiltroGenerico04CaixaSelecao'] == 1){ ?>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico04); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input name="idsHistoricoFiltroGenerico04[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico04[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico04[$countArray][0], $arrHistoricoFiltroGenerico04Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico04[$countArray][1];?>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                <?php } ?>
                                <?php if($GLOBALS['configHistoricoFiltroGenerico04CaixaSelecao'] == 2){ ?>
                                    <select id="idsHistoricoFiltroGenerico04" name="idsHistoricoFiltroGenerico04[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01" style="width: 130px;">
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico04); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrHistoricoFiltroGenerico04[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico04[$countArray][0], $arrHistoricoFiltroGenerico04Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico04[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select> 
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                <?php } ?>
                                <?php if($GLOBALS['configHistoricoFiltroGenerico04CaixaSelecao'] == 3){ ?>
                                    <select id="idsHistoricoFiltroGenerico04" name="idsHistoricoFiltroGenerico04[]" class="AdmCampoDropDownMenu01">
                                        <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico04); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrHistoricoFiltroGenerico04[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico04[$countArray][0], $arrHistoricoFiltroGenerico04Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico04[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select>
                                <?php } ?>
                                
                                <?php 
                                $flagManutencaoLink = $configManutencaoLinkFlag;
                                if($configManutencaoLinkFlag != true)
                                {
                                    if(empty($arrHistoricoFiltroGenerico04))
                                    { 
                                        $flagManutencaoLink = true;
                                    }else{
                                        $flagManutencaoLink = false;
                                    }
                                }
                                ?>
                                <?php if($flagManutencaoLink == true){ ?>
                                    <?php if($configManutencaoLink == 1){ ?>
                                        <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                        </a>
                                    <?php } ?>
                                    <?php if($configManutencaoLink == 2){ ?>
                                        <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=15&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                        </a>
                                    <?php } ?>
                                    <?php if($configManutencaoLink == 3){ ?>
                                        <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=15&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $idTbHistorico;?>&configCaixaSelecao=<?php echo $GLOBALS['configHistoricoFiltroGenerico04CaixaSelecao'];?>', '', '', '');
                                                    divShow('divManutencaoAjax');
                                                    HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=15&tipoRetorno=3&idItem=<?php echo $idTbHistorico;?>\', \'idsHistoricoFiltroGenerico04\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico04CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                 <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img id="imgManutencao04" src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                        <div style="position: absolute; display: block; top: 93px; left: 205px;">
                            <div align="left" class="AdmTexto01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc4'], "IncludeConfig"); ?>:
                            </div>
                            <div>
                                <?php if($GLOBALS['configHistoricoBoxIc4'] == 1){ ?>
                                    <input type="text" name="informacao_complementar4" id="informacao_complementar4" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC4;?>" />
                                <?php } ?>
                                <?php if($GLOBALS['configHistoricoBoxIc4'] == 2){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar4" id="informacao_complementar4" class="AdmCampoTextoMultilinha01" style="width: 265px; height: 30px;"><?php echo $tbHistoricoIC4;?></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação básica (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                        
                                        <script type="text/javascript">
                                            //Caixa básica.
                                            $(document).ready(function () {
                                                $("#informacao_complementar4").cleditor(
                                                    {
                                                        //Controles disponíveis na barra de ferramentas.
                                                        controls:
                                                        CLEditorBasicoControles
                                                        , 
                                                
                                                        //Fontes disponíveis.
                                                        fonts:        
                                                        CLEditorBasicoFontes
                                                    }
                                                );
                                            });
                                        </script>
                                        <textarea name="informacao_complementar4" id="informacao_complementar4"><?php echo $tbHistoricoIC4;?></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação avançada (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $("#informacao_complementar4").cleditor(
                                                    {
                                                        //Controles disponíveis na barra de ferramentas.
                                                        controls:
                                                        CLEditorAvancadoControles
                                                        , 
                                                
                                                        //Fontes disponíveis.
                                                        fonts:        
                                                        CLEditorAvancadoFontes
                                                    }
                                                );
                                            });
                                        </script>
                                        <textarea name="informacao_complementar4" id="informacao_complementar4"><?php echo $tbHistoricoIC4;?></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                        
                        <div style="position: absolute; display: block; top: 146px; left: 5px;">
                            <div align="left" class="AdmTexto01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc5'], "IncludeConfig"); ?>:
                            </div>
                            <div>
                                <?php if($GLOBALS['configHistoricoBoxIc5'] == 1){ ?>
                                    <input type="text" name="informacao_complementar5" id="informacao_complementar5" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC5;?>" />
                                <?php } ?>
                                <?php if($GLOBALS['configHistoricoBoxIc5'] == 2){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar5" id="informacao_complementar5" class="AdmCampoTextoMultilinha01" style="width: 465px; height: 30px;"><?php echo $tbHistoricoIC5;?></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação básica (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                        
                                        <script type="text/javascript">
                                            //Caixa básica.
                                            $(document).ready(function () {
                                                $("#informacao_complementar5").cleditor(
                                                    {
                                                        //Controles disponíveis na barra de ferramentas.
                                                        controls:
                                                        CLEditorBasicoControles
                                                        , 
                                                
                                                        //Fontes disponíveis.
                                                        fonts:        
                                                        CLEditorBasicoFontes
                                                    }
                                                );
                                            });
                                        </script>
                                        <textarea name="informacao_complementar5" id="informacao_complementar5"><?php echo $tbHistoricoIC5;?></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação avançada (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $("#informacao_complementar5").cleditor(
                                                    {
                                                        //Controles disponíveis na barra de ferramentas.
                                                        controls:
                                                        CLEditorAvancadoControles
                                                        , 
                                                
                                                        //Fontes disponíveis.
                                                        fonts:        
                                                        CLEditorAvancadoFontes
                                                    }
                                                );
                                            });
                                        </script>
                                        <textarea name="informacao_complementar5" id="informacao_complementar5"><?php echo $tbHistoricoIC5;?></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                        
                        <div style="position: absolute; display: block; top: 201px; left: 5px;">
                            Teste de solubilidade
                            <div style="position: absolute; display: block; top: 10px; left: 0px; width: 280px; height: 85px; border: 1px solid #000;">
                                <div style="position: relative; display: block; overflow: hidden;">
                                    <iframe class="AdmTabelaIFrame01" src="SiteAdmForumPostagensIndice.php?idTbForumTopicos=<?php echo $idTbHistorico; ?>&masterPageSiteSelect=LayoutSiteIFrame.php&habilitarListagem=1&habilitarInclusao=0&habilitarDetalhes=0&habilitarBusca=1" scrolling="auto" id="iframeAdmForumPostagens" name="iframeAdmForumPostagens" frameborder="0" align="left" width="100%" height="60">
                                    </iframe>
                                </div>
                                <div style="position: relative; display: block; overflow: hidden; clear: both; margin-top: -10px;">
                                    <div align="right" style="float: right;">
                                        <div class="AdmDivBto01" onclick="iframeAdmForumPostagens.formularioSubmit('formForumPostagensAcoes', '', '', '');" style="margin-right: 0px; min-width: 55px;">
                                            <a class="AdmLinks01" style="font-size: 11px;">
                                                Remover
                                            </a>
                                        </div>
                                    
                                        <img onclick="iframeAdmForumPostagens.formularioSubmit('formForumPostagensAcoes', '', '', '');" src="img/btoExcluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoExcluir"); ?>" style="cursor: pointer; display: none;" />
                                    </div>
                                    
                                    <div align="left" style="float: left;">
                                        <div class="AdmDivBto01" onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmForumPostagensIndice.php?idTbForumTopicos=<?php echo $idTbHistorico; ?>&masterPageSiteSelect=LayoutSiteIFrame.php&habilitarListagem=1&habilitarInclusao=1&habilitarDetalhes=0&habilitarBusca=0', '', '', '');
                                                                          divShow('divManutencaoAjax');
                                                                          HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');iframeRecarregar(\'iframeAdmForumPostagens\', \'\');');" style="margin-right: 0px; min-width: 55px;">
                                            <a class="AdmLinks01" style="font-size: 11px;">
                                                Incluir Teste
                                            </a>
                                        </div>
                                        <img onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmForumPostagensIndice.php?idTbForumTopicos=<?php echo $idTbHistorico; ?>&masterPageSiteSelect=LayoutSiteIFrame.php&habilitarListagem=1&habilitarInclusao=1&habilitarDetalhes=0&habilitarBusca=0', '', '', '');
                                                      divShow('divManutencaoAjax');
                                                      HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');iframeRecarregar(\'iframeAdmForumPostagens\', \'\');');" src="img/btoIncluirTeste.png" alt="Incluir Teste" style="cursor: pointer; display: none;" />
                                    </div>
                                    
                                    <div style="text-align: center;">
                                        <div class="AdmDivBto01" onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmForumPostagensIndice.php?idTbForumTopicos=<?php echo $idTbHistorico; ?>&masterPageSiteSelect=LayoutSiteIFrame.php&habilitarListagem=1&habilitarInclusao=0&habilitarDetalhes=0&habilitarBusca=0', '', '', '');
                                                                          divShow('divManutencaoAjax');
                                                                          HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');iframeRecarregar(\'iframeAdmForumPostagens\', \'\');');" style="margin-right: 0px; min-width: 65px;">
                                            <a class="AdmLinks01" style="font-size: 11px;">
                                                Visualizar Mapa
                                            </a>
                                        </div>

                                        <img onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmForumPostagensIndice.php?idTbForumTopicos=<?php echo $idTbHistorico; ?>&masterPageSiteSelect=LayoutSiteIFrame.php&habilitarListagem=1&habilitarInclusao=0&habilitarDetalhes=0&habilitarBusca=0', '', '', '');
                                                      divShow('divManutencaoAjax');
                                                      HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');iframeRecarregar(\'iframeAdmForumPostagens\', \'\');');" src="img/btoVisualizacaoMapa.png" alt="Visualizar Mapa" style="cursor: pointer; display: none;" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="position: absolute; display: block; top: 200px; left: 290px;">
                            <div align="left" class="AdmTexto01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc6'], "IncludeConfig"); ?>:
                            </div>
                            <div>
                                <?php if($GLOBALS['configHistoricoBoxIc6'] == 1){ ?>
                                    <input type="text" name="informacao_complementar6" id="informacao_complementar6" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC6;?>" />
                                <?php } ?>
                                <?php if($GLOBALS['configHistoricoBoxIc6'] == 2){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar6" id="informacao_complementar6" class="AdmCampoTextoMultilinha01" style="width: 180px; height: 80px;"><?php echo $tbHistoricoIC6;?></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação básica (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                        
                                        <script type="text/javascript">
                                            //Caixa básica.
                                            $(document).ready(function () {
                                                $("#informacao_complementar6").cleditor(
                                                    {
                                                        //Controles disponíveis na barra de ferramentas.
                                                        controls:
                                                        CLEditorBasicoControles
                                                        , 
                                                
                                                        //Fontes disponíveis.
                                                        fonts:        
                                                        CLEditorBasicoFontes
                                                    }
                                                );
                                            });
                                        </script>
                                        <textarea name="informacao_complementar6" id="informacao_complementar6"><?php echo $tbHistoricoIC6;?></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação avançada (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $("#informacao_complementar6").cleditor(
                                                    {
                                                        //Controles disponíveis na barra de ferramentas.
                                                        controls:
                                                        CLEditorAvancadoControles
                                                        , 
                                                
                                                        //Fontes disponíveis.
                                                        fonts:        
                                                        CLEditorAvancadoFontes
                                                    }
                                                );
                                            });
                                        </script>
                                        <textarea name="informacao_complementar6" id="informacao_complementar6"><?php echo $tbHistoricoIC6;?></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                        
                        <!--Fixação.-->
                    	<div class="DivCantoArredondado02" style="position: absolute; display: block; top: 320px; left: 5px; width: 470px; height: 85px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div class="DivAbaInfo02" style="">
                                Fixação
                            </div>
                            
                            <div style="position: absolute; display: block; top: 2px; left: 5px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc7'], "IncludeConfig"); ?>:
                                </div>
                                <div>
                                    <?php if($GLOBALS['configHistoricoBoxIc7'] == 1){ ?>
                                        <input type="text" name="informacao_complementar7" id="informacao_complementar7" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC7;?>" style="width: 195px;" />
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoBoxIc7'] == 2){ ?>
                                        <?php //Sem formatação.?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                            <textarea name="informacao_complementar7" id="informacao_complementar7" class="AdmCampoTextoMultilinha01"><?php echo $tbHistoricoIC7;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação básica (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                            
                                            <script type="text/javascript">
                                                //Caixa básica.
                                                $(document).ready(function () {
                                                    $("#informacao_complementar7").cleditor(
                                                        {
                                                            //Controles disponíveis na barra de ferramentas.
                                                            controls:
                                                            CLEditorBasicoControles
                                                            , 
                                                    
                                                            //Fontes disponíveis.
                                                            fonts:        
                                                            CLEditorBasicoFontes
                                                        }
                                                    );
                                                });
                                            </script>
                                            <textarea name="informacao_complementar7" id="informacao_complementar7"><?php echo $tbHistoricoIC7;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação avançada (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                            <script type="text/javascript">
                                                $(document).ready(function () {
                                                    $("#informacao_complementar7").cleditor(
                                                        {
                                                            //Controles disponíveis na barra de ferramentas.
                                                            controls:
                                                            CLEditorAvancadoControles
                                                            , 
                                                    
                                                            //Fontes disponíveis.
                                                            fonts:        
                                                            CLEditorAvancadoFontes
                                                        }
                                                    );
                                                });
                                            </script>
                                            <textarea name="informacao_complementar7" id="informacao_complementar7"><?php echo $tbHistoricoIC7;?></textarea>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                            <div style="position: absolute; display: block; top: 2px; left: 205px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc8'], "IncludeConfig"); ?>:
                                </div>
                                <div>
                                    <?php if($GLOBALS['configHistoricoBoxIc8'] == 1){ ?>
                                        <input type="text" name="informacao_complementar8" id="informacao_complementar8" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC8;?>" style="width: 259px;" />
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoBoxIc8'] == 2){ ?>
                                        <?php //Sem formatação.?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                            <textarea name="informacao_complementar8" id="informacao_complementar8" class="AdmCampoTextoMultilinha01"><?php echo $tbHistoricoIC8;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação básica (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                            
                                            <script type="text/javascript">
                                                //Caixa básica.
                                                $(document).ready(function () {
                                                    $("#informacao_complementar8").cleditor(
                                                        {
                                                            //Controles disponíveis na barra de ferramentas.
                                                            controls:
                                                            CLEditorBasicoControles
                                                            , 
                                                    
                                                            //Fontes disponíveis.
                                                            fonts:        
                                                            CLEditorBasicoFontes
                                                        }
                                                    );
                                                });
                                            </script>
                                            <textarea name="informacao_complementar8" id="informacao_complementar8"><?php echo $tbHistoricoIC8;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação avançada (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                            <script type="text/javascript">
                                                $(document).ready(function () {
                                                    $("#informacao_complementar8").cleditor(
                                                        {
                                                            //Controles disponíveis na barra de ferramentas.
                                                            controls:
                                                            CLEditorAvancadoControles
                                                            , 
                                                    
                                                            //Fontes disponíveis.
                                                            fonts:        
                                                            CLEditorAvancadoFontes
                                                        }
                                                    );
                                                });
                                            </script>
                                            <textarea name="informacao_complementar8" id="informacao_complementar8"><?php echo $tbHistoricoIC8;?></textarea>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                            
                            <div style="position: absolute; display: block; top: 34px; left: 5px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico05Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico05Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "16", "", ",", "", "1"));
                                    ?>
                                
                                    <?php 
                                    $arrHistoricoFiltroGenerico05 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 16);
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico05CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico05); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico05[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico05[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico05[$countArray][0], $arrHistoricoFiltroGenerico05Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico05[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico05CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico05" name="idsHistoricoFiltroGenerico05[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico05); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico05[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico05[$countArray][0], $arrHistoricoFiltroGenerico05Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico05[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico05CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico05" name="idsHistoricoFiltroGenerico05[]" class="AdmCampoDropDownMenu01" style="width: 90px;">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico05); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico05[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico05[$countArray][0], $arrHistoricoFiltroGenerico05Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico05[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico05))
                                        { 
                                            $flagManutencaoLink = true;
                                        }else{
                                            $flagManutencaoLink = false;
                                        }
                                    }
                                    ?>
                                    <?php if($flagManutencaoLink == true){ ?>
                                        <?php if($configManutencaoLink == 1){ ?>
                                            <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 2){ ?>
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=16&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=16&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $idTbHistorico;?>&configCaixaSelecao=<?php echo $GLOBALS['configHistoricoFiltroGenerico05CaixaSelecao'];?>', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=16&tipoRetorno=3&idItem=<?php echo $idTbHistorico;?>\', \'idsHistoricoFiltroGenerico05\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico05CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                            <div style="position: absolute; display: block; top: 34px; left: 205px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc9'], "IncludeConfig"); ?>:
                                </div>
                                <div>
                                    <?php if($GLOBALS['configHistoricoBoxIc9'] == 1){ ?>
                                        <input type="text" name="informacao_complementar9" id="informacao_complementar9" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC9;?>" />
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoBoxIc9'] == 2){ ?>
                                        <?php //Sem formatação.?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                            <textarea name="informacao_complementar9" id="informacao_complementar9" class="AdmCampoTextoMultilinha01" style="width: 255px; height: 30px;"><?php echo $tbHistoricoIC9;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação básica (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                            
                                            <script type="text/javascript">
                                                //Caixa básica.
                                                $(document).ready(function () {
                                                    $("#informacao_complementar9").cleditor(
                                                        {
                                                            //Controles disponíveis na barra de ferramentas.
                                                            controls:
                                                            CLEditorBasicoControles
                                                            , 
                                                    
                                                            //Fontes disponíveis.
                                                            fonts:        
                                                            CLEditorBasicoFontes
                                                        }
                                                    );
                                                });
                                            </script>
                                            <textarea name="informacao_complementar9" id="informacao_complementar9"><?php echo $tbHistoricoIC9;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação avançada (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                            <script type="text/javascript">
                                                $(document).ready(function () {
                                                    $("#informacao_complementar9").cleditor(
                                                        {
                                                            //Controles disponíveis na barra de ferramentas.
                                                            controls:
                                                            CLEditorAvancadoControles
                                                            , 
                                                    
                                                            //Fontes disponíveis.
                                                            fonts:        
                                                            CLEditorAvancadoFontes
                                                        }
                                                    );
                                                });
                                            </script>
                                            <textarea name="informacao_complementar9" id="informacao_complementar9"><?php echo $tbHistoricoIC9;?></textarea>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        
                        <div style="position: absolute; display: block; top: 415px; left: 5px;">
                            <div align="left" class="AdmTexto01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc10'], "IncludeConfig"); ?>:
                            </div>
                            <div>
                                <?php if($GLOBALS['configHistoricoBoxIc10'] == 1){ ?>
                                    <input type="text" name="informacao_complementar10" id="informacao_complementar10" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC10;?>" style="width: 140px;" />
                                <?php } ?>
                                <?php if($GLOBALS['configHistoricoBoxIc10'] == 2){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar10" id="informacao_complementar10" class="AdmCampoTextoMultilinha01"><?php echo $tbHistoricoIC10;?></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação básica (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                        
                                        <script type="text/javascript">
                                            //Caixa básica.
                                            $(document).ready(function () {
                                                $("#informacao_complementar10").cleditor(
                                                    {
                                                        //Controles disponíveis na barra de ferramentas.
                                                        controls:
                                                        CLEditorBasicoControles
                                                        , 
                                                
                                                        //Fontes disponíveis.
                                                        fonts:        
                                                        CLEditorBasicoFontes
                                                    }
                                                );
                                            });
                                        </script>
                                        <textarea name="informacao_complementar10" id="informacao_complementar10"><?php echo $tbHistoricoIC10;?></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação avançada (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $("#informacao_complementar10").cleditor(
                                                    {
                                                        //Controles disponíveis na barra de ferramentas.
                                                        controls:
                                                        CLEditorAvancadoControles
                                                        , 
                                                
        
                                                        //Fontes disponíveis.
                                                        fonts:        
                                                        CLEditorAvancadoFontes
                                                    }
                                                );
                                            });
                                        </script>
                                        <textarea name="informacao_complementar10" id="informacao_complementar10"><?php echo $tbHistoricoIC10;?></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                        <div style="position: absolute; display: block; top: 415px; left: 210px;">
                            <div align="left" class="AdmTexto01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc11'], "IncludeConfig"); ?>:
                            </div>
                            <div>
                                <?php if($GLOBALS['configHistoricoBoxIc11'] == 1){ ?>
                                    <input type="text" name="informacao_complementar11" id="informacao_complementar11" class="AdmCampoTexto02" maxlength="255"  value="<?php echo $tbHistoricoIC11;?>" style="width: 140px;" />
                                <?php } ?>
                                <?php if($GLOBALS['configHistoricoBoxIc11'] == 2){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar11" id="informacao_complementar11" class="AdmCampoTextoMultilinha01"><?php echo $tbHistoricoIC11;?></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação básica (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                        
                                        <script type="text/javascript">
                                            //Caixa básica.
                                            $(document).ready(function () {
                                                $("#informacao_complementar11").cleditor(
                                                    {
                                                        //Controles disponíveis na barra de ferramentas.
                                                        controls:
                                                        CLEditorBasicoControles
                                                        , 
                                                
                                                        //Fontes disponíveis.
                                                        fonts:        
                                                        CLEditorBasicoFontes
                                                    }
                                                );
                                            });
                                        </script>
                                        <textarea name="informacao_complementar11" id="informacao_complementar11"><?php echo $tbHistoricoIC11;?></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação avançada (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $("#informacao_complementar11").cleditor(
                                                    {
                                                        //Controles disponíveis na barra de ferramentas.
                                                        controls:
                                                        CLEditorAvancadoControles
                                                        , 
                                                
                                                        //Fontes disponíveis.
                                                        fonts:        
                                                        CLEditorAvancadoFontes
                                                    }
                                                );
                                            });
                                        </script>
                                        <textarea name="informacao_complementar11" id="informacao_complementar11"><?php echo $tbHistoricoIC11;?></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                        
                        <div style="position: absolute; display: block; top: 450px; left: 5px;">
                            <div align="left" class="AdmTexto01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc12'], "IncludeConfig"); ?>:
                            </div>
                            <div>
                                <?php if($GLOBALS['configHistoricoBoxIc12'] == 1){ ?>
                                    <input type="text" name="informacao_complementar12" id="informacao_complementar12" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC12;?>" style="width: 140px;" />
                                <?php } ?>
                                <?php if($GLOBALS['configHistoricoBoxIc12'] == 2){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar12" id="informacao_complementar12" class="AdmCampoTextoMultilinha01"><?php echo $tbHistoricoIC12;?></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação básica (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                        
                                        <script type="text/javascript">
                                            //Caixa básica.
                                            $(document).ready(function () {
                                                $("#informacao_complementar12").cleditor(
                                                    {
                                                        //Controles disponíveis na barra de ferramentas.
                                                        controls:
                                                        CLEditorBasicoControles
                                                        , 
                                                
                                                        //Fontes disponíveis.
                                                        fonts:        
                                                        CLEditorBasicoFontes
                                                    }
                                                );
                                            });
                                        </script>
                                        <textarea name="informacao_complementar12" id="informacao_complementar12"><?php echo $tbHistoricoIC12;?></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação avançada (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $("#informacao_complementar12").cleditor(
                                                    {
                                                        //Controles disponíveis na barra de ferramentas.
                                                        controls:
                                                        CLEditorAvancadoControles
                                                        , 
                                                
                                                        //Fontes disponíveis.
                                                        fonts:        
                                                        CLEditorAvancadoFontes
                                                    }
                                                );
                                            });
                                        </script>
                                        <textarea name="informacao_complementar12" id="informacao_complementar12"><?php echo $tbHistoricoIC12;?></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                        <div style="position: absolute; display: block; top: 450px; left: 210px;">
                            <div align="left" class="AdmTexto01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc13'], "IncludeConfig"); ?>:
                            </div>
                            <div>
                                <?php if($GLOBALS['configHistoricoBoxIc13'] == 1){ ?>
                                    <input type="text" name="informacao_complementar13" id="informacao_complementar13" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC13;?>" style="width: 140px;" />
                                <?php } ?>
                                <?php if($GLOBALS['configHistoricoBoxIc13'] == 2){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar13" id="informacao_complementar13" class="AdmCampoTextoMultilinha01"><?php echo $tbHistoricoIC13;?></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação básica (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                        
                                        <script type="text/javascript">
                                            //Caixa básica.
                                            $(document).ready(function () {
                                                $("#informacao_complementar13").cleditor(
                                                    {
                                                        //Controles disponíveis na barra de ferramentas.
                                                        controls:
                                                        CLEditorBasicoControles
                                                        , 
                                                
                                                        //Fontes disponíveis.
                                                        fonts:        
                                                        CLEditorBasicoFontes
                                                    }
                                                );
                                            });
                                        </script>
                                        <textarea name="informacao_complementar13" id="informacao_complementar13"><?php echo $tbHistoricoIC13;?></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação avançada (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $("#informacao_complementar13").cleditor(
                                                    {
                                                        //Controles disponíveis na barra de ferramentas.
                                                        controls:
                                                        CLEditorAvancadoControles
                                                        , 
                                                
                                                        //Fontes disponíveis.
                                                        fonts:        
                                                        CLEditorAvancadoFontes
                                                    }
                                                );
                                            });
                                        </script>
                                        <textarea name="informacao_complementar13" id="informacao_complementar13"><?php echo $tbHistoricoIC13;?></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                        
                        
                        <!--Tratamento Aquoso.-->
                    	<div class="DivCantoArredondado02" style="position: absolute; display: block; top: 20px; left: 480px; width: 470px; height: 85px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div class="DivAbaInfo02" style="">
                                Tratamento aquoso
                            </div>
                            
                            <div style="position: absolute; display: block; top: 4px; left: 17px;">
                                <div align="left" class="AdmTexto01" style="display: inline-block; vertical-align: top;">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico06Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01" style="display: inline-block;">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico06Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "17", "", ",", "", "1"));
                                    ?>
            
                                    <?php 
                                    $arrHistoricoFiltroGenerico06 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 17);
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico06CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico06); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico06[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico06[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico06[$countArray][0], $arrHistoricoFiltroGenerico06Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico06[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico06CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico06" name="idsHistoricoFiltroGenerico06[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01" style="width: 130px;">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico06); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico06[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico06[$countArray][0], $arrHistoricoFiltroGenerico06Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico06[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico06CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico06" name="idsHistoricoFiltroGenerico06[]" class="AdmCampoDropDownMenu01">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico06); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico06[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico06[$countArray][0], $arrHistoricoFiltroGenerico06Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico06[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico06))
                                        { 
                                            $flagManutencaoLink = true;
                                        }else{
                                            $flagManutencaoLink = false;
                                        }
                                    }
                                    ?>
                                    <?php if($flagManutencaoLink == true){ ?>
                                        <?php if($configManutencaoLink == 1){ ?>
                                            <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 2){ ?>
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=17&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=17&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $idTbHistorico;?>&configCaixaSelecao=<?php echo $GLOBALS['configHistoricoFiltroGenerico06CaixaSelecao'];?>', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=17&tipoRetorno=3&idItem=<?php echo $idTbHistorico;?>\', \'idsHistoricoFiltroGenerico06\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico06CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                            <div style="position: absolute; display: block; top: 4px; left: 260px;">
                                <div align="left" class="AdmTexto01" style="position: absolute; top: 0px; left: -50px;">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc23'], "IncludeConfig"); ?>:
                                </div>
                                <div>
                                    <?php if($GLOBALS['configHistoricoBoxIc23'] == 1){ ?>
                                        <input type="text" name="informacao_complementar23" id="informacao_complementar23" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC23;?>" />
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoBoxIc23'] == 2){ ?>
                                        <?php //Sem formatação.?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                            <textarea name="informacao_complementar23" id="informacao_complementar23" class="AdmCampoTextoMultilinha01" style="width: 200px; height: 70px;"><?php echo $tbHistoricoIC23;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação básica (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                            
                                            <script type="text/javascript">
                                                //Caixa básica.
                                                $(document).ready(function () {
                                                    $("#informacao_complementar23").cleditor(
                                                        {
                                                            //Controles disponíveis na barra de ferramentas.
                                                            controls:
                                                            CLEditorBasicoControles
                                                            , 
                                                    
                                                            //Fontes disponíveis.
                                                            fonts:        
                                                            CLEditorBasicoFontes
                                                        }
                                                    );
                                                });
                                            </script>
                                            <textarea name="informacao_complementar23" id="informacao_complementar23"><?php echo $tbHistoricoIC23;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação avançada (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                            <script type="text/javascript">
                                                $(document).ready(function () {
                                                    $("#informacao_complementar23").cleditor(
                                                        {
                                                            //Controles disponíveis na barra de ferramentas.
                                                            controls:
                                                            CLEditorAvancadoControles
                                                            , 
                                                    
                                                            //Fontes disponíveis.
                                                            fonts:        
                                                            CLEditorAvancadoFontes
                                                        }
                                                    );
                                                });
                                            </script>
                                            <textarea name="informacao_complementar23" id="informacao_complementar23"><?php echo $tbHistoricoIC23;?></textarea>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                            
                            <div style="position: absolute; display: block; top: 45px; left: 5px;">
                                <div align="left" class="AdmTexto01" style="display: inline-block; vertical-align: top;">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico07Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01" style="display: inline-block;">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico07Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "18", "", ",", "", "1"));
                                    //var_dump($arrHistoricoFiltroGenerico07Selecao); 
									?>
                                
                                    <?php 
                                    $arrHistoricoFiltroGenerico07 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 18);
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico07CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico07); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico07[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico07[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico07[$countArray][0], $arrHistoricoFiltroGenerico07Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico07[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico07CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico07" name="idsHistoricoFiltroGenerico07[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01" style="width: 130px;">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico07); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico07[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico07[$countArray][0], $arrHistoricoFiltroGenerico07Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico07[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico07CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico07" name="idsHistoricoFiltroGenerico07[]" class="AdmCampoDropDownMenu01">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico07); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico07[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico07[$countArray][0], $arrHistoricoFiltroGenerico07Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico07[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico07))
                                        { 
                                            $flagManutencaoLink = true;
                                        }else{
                                            $flagManutencaoLink = false;
                                        }
                                    }
                                    ?>
                                    <?php if($flagManutencaoLink == true){ ?>
                                        <?php if($configManutencaoLink == 1){ ?>
                                            <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 2){ ?>
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=18&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=18&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $idTbHistorico;?>&configCaixaSelecao=<?php echo $GLOBALS['configHistoricoFiltroGenerico07CaixaSelecao'];?>', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=18&tipoRetorno=3&idItem=<?php echo $idTbHistorico;?>\', \'idsHistoricoFiltroGenerico07\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico07CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                        </div>
                        
                        <!--Desacidificação.-->
                    	<div class="DivCantoArredondado02" style="position: absolute; display: block; top: 125px; left: 480px; width: 470px; height: 118px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div class="DivAbaInfo02" style="">
                                Desacidificação
                            </div>
                            
                            <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                <div align="left" class="AdmTexto01" style="display: none;">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico08Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico08Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "19", "", ",", "", "1"));
                                    ?>
            
                                    <?php 
                                    $arrHistoricoFiltroGenerico08 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 19);
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico08CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico08); $countArray++)
                                        {
                                        ?>
                                            <div style="margin-bottom: -4px;">
                                                <input name="idsHistoricoFiltroGenerico08[]" type="radio" value="<?php echo $arrHistoricoFiltroGenerico08[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico08[$countArray][0], $arrHistoricoFiltroGenerico08Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico08[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico08CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico08" name="idsHistoricoFiltroGenerico08[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico08); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico08[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico08[$countArray][0], $arrHistoricoFiltroGenerico08Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico08[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico08CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico08" name="idsHistoricoFiltroGenerico08[]" class="AdmCampoDropDownMenu01">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico08); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico08[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico08[$countArray][0], $arrHistoricoFiltroGenerico08Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico08[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <span style="display: none">
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico08))
                                        { 
                                            $flagManutencaoLink = true;
                                        }else{
                                            $flagManutencaoLink = false;
                                        }
                                    }
                                    ?>
                                    <?php if($flagManutencaoLink == true){ ?>
                                        <?php if($configManutencaoLink == 1){ ?>
                                            <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 2){ ?>
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=19&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=19&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $idTbHistorico;?>&configCaixaSelecao=<?php echo $GLOBALS['configHistoricoFiltroGenerico08CaixaSelecao'];?>', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=19&tipoRetorno=3&idItem=<?php echo $idTbHistorico;?>\', \'idsHistoricoFiltroGenerico08\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico08CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?> 
                                    </span>
                                </div>
                            </div>
                            <div style="position: absolute; display: block; top: 6px; left: 100px;">
                                <div align="left" class="AdmTexto01" style="position: absolute; top: 0px; left: -26px;">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico09Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico09Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "20", "", ",", "", "1"));
                                    ?>
            
                                    <?php 
                                    $arrHistoricoFiltroGenerico09 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 20);
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico09CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico09); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico09[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico09[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico09[$countArray][0], $arrHistoricoFiltroGenerico09Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico09[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico09CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico09" name="idsHistoricoFiltroGenerico09[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico09); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico09[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico09[$countArray][0], $arrHistoricoFiltroGenerico09Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico09[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico09CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico09" name="idsHistoricoFiltroGenerico09[]" class="AdmCampoDropDownMenu01">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico09); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico09[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico09[$countArray][0], $arrHistoricoFiltroGenerico09Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico09[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico09))
                                        { 
                                            $flagManutencaoLink = true;
                                        }else{
                                            $flagManutencaoLink = false;
                                        }
                                    }
                                    ?>
                                    <?php if($flagManutencaoLink == true){ ?>
                                        <?php if($configManutencaoLink == 1){ ?>
                                            <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 2){ ?>
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=20&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=20&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $idTbHistorico;?>&configCaixaSelecao=<?php echo $GLOBALS['configHistoricoFiltroGenerico09CaixaSelecao'];?>', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=20&tipoRetorno=3&idItem=<?php echo $idTbHistorico;?>\', \'idsHistoricoFiltroGenerico09\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico09CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                            <div style="position: absolute; display: block; top: 4px; left: 260px;">
                                <div align="left" class="AdmTexto01" style="position: absolute; top: 0px; left: -50px;">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc14'], "IncludeConfig"); ?>:
                                </div>
                                <div>
                                    <?php if($GLOBALS['configHistoricoBoxIc14'] == 1){ ?>
                                        <input type="text" name="informacao_complementar14" id="informacao_complementar14" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC14;?>" />
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoBoxIc14'] == 2){ ?>
                                        <?php //Sem formatação.?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                            <textarea name="informacao_complementar14" id="informacao_complementar14" class="AdmCampoTextoMultilinha01" style="width: 200px; height: 104px;"><?php echo $tbHistoricoIC14;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação básica (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                            
                                            <script type="text/javascript">
                                                //Caixa básica.
                                                $(document).ready(function () {
                                                    $("#informacao_complementar14").cleditor(
                                                        {
                                                            //Controles disponíveis na barra de ferramentas.
                                                            controls:
                                                            CLEditorBasicoControles
                                                            , 
                                                    
                                                            //Fontes disponíveis.
                                                            fonts:        
                                                            CLEditorBasicoFontes
                                                        }
                                                    );
                                                });
                                            </script>
                                            <textarea name="informacao_complementar14" id="informacao_complementar14"><?php echo $tbHistoricoIC14;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação avançada (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                            <script type="text/javascript">
                                                $(document).ready(function () {
                                                    $("#informacao_complementar14").cleditor(
                                                        {
                                                            //Controles disponíveis na barra de ferramentas.
                                                            controls:
                                                            CLEditorAvancadoControles
                                                            , 
                                                    
                                                            //Fontes disponíveis.
                                                            fonts:        
                                                            CLEditorAvancadoFontes
                                                        }
                                                    );
                                                });
                                            </script>
                                            <textarea name="informacao_complementar14" id="informacao_complementar14"><?php echo $tbHistoricoIC14;?></textarea>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                            
                            <div style="position: absolute; display: block; top: 38px; left: 5px;">
                                <div align="left" class="AdmTexto01" style="display: inline-block; vertical-align: top;">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico10Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01" style="display: inline-block;">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico10Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "21", "", ",", "", "1"));
                                    ?>
                                
                                    <?php 
                                    $arrHistoricoFiltroGenerico10 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 21);
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico10CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico10); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico10[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico10[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico10[$countArray][0], $arrHistoricoFiltroGenerico10Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico10[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico10CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico10" name="idsHistoricoFiltroGenerico10[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01" style="width: 130px;">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico10); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico10[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico10[$countArray][0], $arrHistoricoFiltroGenerico10Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico10[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico10CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico10" name="idsHistoricoFiltroGenerico10[]" class="AdmCampoDropDownMenu01">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico10); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico10[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico10[$countArray][0], $arrHistoricoFiltroGenerico10Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico10[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico10))
                                        { 
                                            $flagManutencaoLink = true;
                                        }else{
                                            $flagManutencaoLink = false;
                                        }
                                    }
                                    ?>
                                    <?php if($flagManutencaoLink == true){ ?>
                                        <?php if($configManutencaoLink == 1){ ?>
                                            <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 2){ ?>
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=21&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=21&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $idTbHistorico;?>&configCaixaSelecao=<?php echo $GLOBALS['configHistoricoFiltroGenerico10CaixaSelecao'];?>', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=21&tipoRetorno=3&idItem=<?php echo $idTbHistorico;?>\', \'idsHistoricoFiltroGenerico10\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico10CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                            
                            <div style="position: absolute; display: block; top: 78px; left: 5px;">
                                <div align="left" class="AdmTexto01" style="display: inline-block; vertical-align: top;">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico11Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01" style="display: inline-block;">
                                    <?php

                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico11Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "22", "", ",", "", "1"));
                                    ?>
                                
                                    <?php 
                                    $arrHistoricoFiltroGenerico11 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 22);
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico11CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico11); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico11[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico11[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico11[$countArray][0], $arrHistoricoFiltroGenerico11Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico11[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico11CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico11" name="idsHistoricoFiltroGenerico11[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01" style="width: 130px;">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico11); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico11[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico11[$countArray][0], $arrHistoricoFiltroGenerico11Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico11[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico11CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico11" name="idsHistoricoFiltroGenerico11[]" class="AdmCampoDropDownMenu01">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico11); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico11[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico11[$countArray][0], $arrHistoricoFiltroGenerico11Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico11[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico11))
                                        { 
                                            $flagManutencaoLink = true;
                                        }else{
                                            $flagManutencaoLink = false;
                                        }
                                    }
                                    ?>
                                    <?php if($flagManutencaoLink == true){ ?>
                                        <?php if($configManutencaoLink == 1){ ?>
                                            <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 2){ ?>
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=22&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=22&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $idTbHistorico;?>&configCaixaSelecao=<?php echo $GLOBALS['configHistoricoFiltroGenerico11CaixaSelecao'];?>', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=22&tipoRetorno=3&idItem=<?php echo $idTbHistorico;?>\', \'idsHistoricoFiltroGenerico11\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico11CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                        </div>
                        
                        <!--Clareamento.-->
                    	<div class="DivCantoArredondado02" style="position: absolute; display: block; top: 263px; left: 480px; width: 470px; height: 150px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div class="DivAbaInfo02" style="">
                                Clareamento
                            </div>
                            
                            <div style="position: absolute; display: block; top: 5px; left: 23px;">
                                <div align="left" class="AdmTexto01" style="display: inline-block; vertical-align: top;">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico12Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01" style="display: inline-block;">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico12Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "23", "", ",", "", "1"));
                                    ?>
                                
                                    <?php 
                                    $arrHistoricoFiltroGenerico12 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 23);
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico12CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico12); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico12[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico12[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico12[$countArray][0], $arrHistoricoFiltroGenerico12Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico12[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico12CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico12" name="idsHistoricoFiltroGenerico12[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01" style="width: 130px;">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico12); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico12[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico12[$countArray][0], $arrHistoricoFiltroGenerico12Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico12[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico12CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico12" name="idsHistoricoFiltroGenerico12[]" class="AdmCampoDropDownMenu01">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico12); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico12[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico12[$countArray][0], $arrHistoricoFiltroGenerico12Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico12[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico12))
                                        { 
                                            $flagManutencaoLink = true;
                                        }else{
                                            $flagManutencaoLink = false;
                                        }
                                    }
                                    ?>
                                    <?php if($flagManutencaoLink == true){ ?>
                                        <?php if($configManutencaoLink == 1){ ?>
                                            <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 2){ ?>
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=23&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=23&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $idTbHistorico;?>&configCaixaSelecao=<?php echo $GLOBALS['configHistoricoFiltroGenerico12CaixaSelecao'];?>', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=23&tipoRetorno=3&idItem=<?php echo $idTbHistorico;?>\', \'idsHistoricoFiltroGenerico12\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico12CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                            <div style="position: absolute; display: block; top: 5px; left: 230px;">
                                <div align="left" class="AdmTexto01" style="display: inline-block; vertical-align: top;">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico13Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01" style="display: inline-block;">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico13Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "24", "", ",", "", "1"));
                                    ?>
            
                                    <?php 
                                    $arrHistoricoFiltroGenerico13 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 24);
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico13CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico13); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico13[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico13[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico13[$countArray][0], $arrHistoricoFiltroGenerico13Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico13[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico13CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico13" name="idsHistoricoFiltroGenerico13[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01" style="width: 130px;">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico13); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico13[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico13[$countArray][0], $arrHistoricoFiltroGenerico13Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico13[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico13CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico13" name="idsHistoricoFiltroGenerico13[]" class="AdmCampoDropDownMenu01">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico13); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico13[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico13[$countArray][0], $arrHistoricoFiltroGenerico13Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico13[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico13))
                                        { 
                                            $flagManutencaoLink = true;
                                        }else{
                                            $flagManutencaoLink = false;
                                        }
                                    }
                                    ?>
                                    <?php if($flagManutencaoLink == true){ ?>
                                        <?php if($configManutencaoLink == 1){ ?>
                                            <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 2){ ?>
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=24&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=24&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $idTbHistorico;?>&configCaixaSelecao=<?php echo $GLOBALS['configHistoricoFiltroGenerico13CaixaSelecao'];?>', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=24&tipoRetorno=3&idItem=<?php echo $idTbHistorico;?>\', \'idsHistoricoFiltroGenerico13\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico13CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                            
                            <div style="position: absolute; display: block; top: 45px; left: 5px;">
                                <div align="left" class="AdmTexto01" style="display: inline-block; vertical-align: top;">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico14Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01" style="display: inline-block;">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico14Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "25", "", ",", "", "1"));
                                    ?>
                                
                                    <?php 
                                    $arrHistoricoFiltroGenerico14 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 25);
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico14CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico14); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico14[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico14[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico14[$countArray][0], $arrHistoricoFiltroGenerico14Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico14[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico14CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico14" name="idsHistoricoFiltroGenerico14[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01" style="width: 130px;">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico14); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico14[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico14[$countArray][0], $arrHistoricoFiltroGenerico14Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico14[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico14CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico14" name="idsHistoricoFiltroGenerico14[]" class="AdmCampoDropDownMenu01">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico14); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico14[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico14[$countArray][0], $arrHistoricoFiltroGenerico14Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico14[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico14))
                                        { 
                                            $flagManutencaoLink = true;
                                        }else{
                                            $flagManutencaoLink = false;
                                        }
                                    }
                                    ?>
                                    <?php if($flagManutencaoLink == true){ ?>
                                        <?php if($configManutencaoLink == 1){ ?>
                                            <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 2){ ?>
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=25&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=25&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $idTbHistorico;?>&configCaixaSelecao=<?php echo $GLOBALS['configHistoricoFiltroGenerico14CaixaSelecao'];?>', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=25&tipoRetorno=3&idItem=<?php echo $idTbHistorico;?>\', \'idsHistoricoFiltroGenerico14\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico14CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                            <div style="position: absolute; display: block; top: 45px; left: 230px;">
                                <div align="left" class="AdmTexto01" style="display: inline-block; vertical-align: top;">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico15Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01" style="display: inline-block;">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico15Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "26", "", ",", "", "1"));
                                    ?>
                                
                                    <?php 
                                    $arrHistoricoFiltroGenerico15 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 26);
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico15CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico15); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico15[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico15[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico15[$countArray][0], $arrHistoricoFiltroGenerico15Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico15[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico15CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico15" name="idsHistoricoFiltroGenerico15[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01" style="width: 130px;">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico15); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico15[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico15[$countArray][0], $arrHistoricoFiltroGenerico15Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico15[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico15CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico15" name="idsHistoricoFiltroGenerico15[]" class="AdmCampoDropDownMenu01">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico15); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico15[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico15[$countArray][0], $arrHistoricoFiltroGenerico15Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico15[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico15))
                                        { 
                                            $flagManutencaoLink = true;
                                        }else{
                                            $flagManutencaoLink = false;
                                        }
                                    }
                                    ?>
                                    <?php if($flagManutencaoLink == true){ ?>
                                        <?php if($configManutencaoLink == 1){ ?>
                                            <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 2){ ?>
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=26&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=26&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $idTbHistorico;?>&configCaixaSelecao=<?php echo $GLOBALS['configHistoricoFiltroGenerico15CaixaSelecao'];?>', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=26&tipoRetorno=3&idItem=<?php echo $idTbHistorico;?>\', \'idsHistoricoFiltroGenerico15\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico15CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                            
                            <div style="position: absolute; display: block; top: 83px; left: 5px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc15'], "IncludeConfig"); ?>:
                                </div>
                                <div>
                                    <?php if($GLOBALS['configHistoricoBoxIc15'] == 1){ ?>
                                        <input type="text" name="informacao_complementar15" id="informacao_complementar15" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC15;?>" />
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoBoxIc15'] == 2){ ?>
                                        <?php //Sem formatação.?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                            <textarea name="informacao_complementar15" id="informacao_complementar15" class="AdmCampoTextoMultilinha01" style="width: 456px; height: 45px;"><?php echo $tbHistoricoIC15;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação básica (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                            
                                            <script type="text/javascript">
                                                //Caixa básica.
                                                $(document).ready(function () {
                                                    $("#informacao_complementar15").cleditor(
                                                        {
                                                            //Controles disponíveis na barra de ferramentas.
                                                            controls:
                                                            CLEditorBasicoControles
                                                            , 
                                                    
                                                            //Fontes disponíveis.
                                                            fonts:        
                                                            CLEditorBasicoFontes
                                                        }
                                                    );
                                                });
                                            </script>
                                            <textarea name="informacao_complementar15" id="informacao_complementar15"><?php echo $tbHistoricoIC15;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação avançada (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                            <script type="text/javascript">
                                                $(document).ready(function () {
                                                    $("#informacao_complementar15").cleditor(
                                                        {
                                                            //Controles disponíveis na barra de ferramentas.
                                                            controls:
                                                            CLEditorAvancadoControles
                                                            , 
                                                    
                                                            //Fontes disponíveis.
                                                            fonts:        
                                                            CLEditorAvancadoFontes
                                                        }
                                                    );
                                                });
                                            </script>
                                            <textarea name="informacao_complementar15" id="informacao_complementar15"><?php echo $tbHistoricoIC15;?></textarea>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        
                        <div style="position: absolute; display: block; top: 420px; left: 486px;">
                            <div align="left" class="AdmTexto01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc16'], "IncludeConfig"); ?>:
                            </div>
                            <div>
                                <?php if($GLOBALS['configHistoricoBoxIc16'] == 1){ ?>
                                    <input type="text" name="informacao_complementar16" id="informacao_complementar16" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC16;?>" />
                                <?php } ?>
                                <?php if($GLOBALS['configHistoricoBoxIc16'] == 2){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar16" id="informacao_complementar16" class="AdmCampoTextoMultilinha01" style="width: 456px;"><?php echo $tbHistoricoIC16;?></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação básica (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                        
                                        <script type="text/javascript">
                                            //Caixa básica.
                                            $(document).ready(function () {
                                                $("#informacao_complementar16").cleditor(
                                                    {
                                                        //Controles disponíveis na barra de ferramentas.
                                                        controls:
                                                        CLEditorBasicoControles
                                                        , 
                                                
                                                        //Fontes disponíveis.
                                                        fonts:        
                                                        CLEditorBasicoFontes
                                                    }
                                                );
                                            });
                                        </script>
                                        <textarea name="informacao_complementar16" id="informacao_complementar16"><?php echo $tbHistoricoIC16;?></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação avançada (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $("#informacao_complementar16").cleditor(
                                                    {
                                                        //Controles disponíveis na barra de ferramentas.
                                                        controls:
                                                        CLEditorAvancadoControles
                                                        , 
                                                
                                                        //Fontes disponíveis.
                                                        fonts:        
                                                        CLEditorAvancadoFontes
                                                    }
                                                );
                                            });
                                        </script>
                                        <textarea name="informacao_complementar16" id="informacao_complementar16"><?php echo $tbHistoricoIC16;?></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
