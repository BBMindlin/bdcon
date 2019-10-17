                        <div style="position: absolute; display: block; top: 9px; left: 5px;">
                            <div align="left" class="AdmTexto01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoVinculo3Nome'], "IncludeConfig"); ?>:
                            </div>
                            <div class="AdmTexto01">
								<?php 
                                    $arrHistoricoVinculo3 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbHistoricoVinculo3'], $GLOBALS['configIdTbTipoHistoricoVinculo3'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoHistoricoVinculo3'], $GLOBALS['configHistoricoVinculo3Metodo']);
                                ?>
                                <select name="id_tb_cadastro3" id="id_tb_cadastro3" class="AdmCampoDropDownMenu01" style="width: 180px;">
                                    <option value="0"<?php if($tbHistoricoIdTbCadastro3 == 0){ ?>selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNenhumDropDown"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoVinculo3); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoVinculo3[$countArray][0];?>"<?php if($arrHistoricoVinculo3[$countArray][0] == $tbHistoricoIdTbCadastro3){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoVinculo3[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        
                        <div style="position: absolute; display: block; top: 45px; left: 5px;">
                            <div align="left" class="AdmTexto01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico60Nome'], "IncludeConfig"); ?>: 
                            </div>
                            <div class="AdmTexto01">
                                <?php
                                //Seleção de ids selecionados para o registro.
                                $arrHistoricoFiltroGenerico60Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "71", "", ",", "", "1"));
                                ?>
                            
                                <?php 
                                $arrHistoricoFiltroGenerico60 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 71);
                                ?>
                                
                                <?php if($GLOBALS['configHistoricoFiltroGenerico60CaixaSelecao'] == 1){ ?>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico60); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input name="idsHistoricoFiltroGenerico60[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico60[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico60[$countArray][0], $arrHistoricoFiltroGenerico60Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico60[$countArray][1];?>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                <?php } ?>
                                <?php if($GLOBALS['configHistoricoFiltroGenerico60CaixaSelecao'] == 2){ ?>
                                    <select id="idsHistoricoFiltroGenerico60" name="idsHistoricoFiltroGenerico60[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01" style="width: 130px;">
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico60); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrHistoricoFiltroGenerico60[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico60[$countArray][0], $arrHistoricoFiltroGenerico60Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico60[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select> 
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                <?php } ?>
                                <?php if($GLOBALS['configHistoricoFiltroGenerico60CaixaSelecao'] == 3){ ?>
                                    <select id="idsHistoricoFiltroGenerico60" name="idsHistoricoFiltroGenerico60[]" class="AdmCampoDropDownMenu01">
                                        <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico60); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrHistoricoFiltroGenerico60[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico60[$countArray][0], $arrHistoricoFiltroGenerico60Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico60[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select>
                                <?php } ?>
                                
                                <?php 
                                $flagManutencaoLink = $configManutencaoLinkFlag;
                                if($configManutencaoLinkFlag != true)
                                {
                                    if(empty($arrHistoricoFiltroGenerico60))
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
                                        <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=71&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                        </a>
                                    <?php } ?>
                                    <?php if($configManutencaoLink == 3){ ?>
                                        <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=71&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $idTbHistorico;?>&configCaixaSelecao=<?php echo $GLOBALS['configHistoricoFiltroGenerico60CaixaSelecao'];?>', '', '', '');
                                                    divShow('divManutencaoAjax');
                                                    HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=71&tipoRetorno=3&idItem=<?php echo $idTbHistorico;?>\', \'idsHistoricoFiltroGenerico60\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico60CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                 <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                        <div style="position: absolute; display: block; top: 97px; left: 5px;">
                            <div align="left" class="AdmTexto01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico64Nome'], "IncludeConfig"); ?>: 
                            </div>
                            <div class="AdmTexto01">
                                <?php
                                //Seleção de ids selecionados para o registro.
                                $arrHistoricoFiltroGenerico64Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "75", "", ",", "", "1"));
                                ?>
                            
                                <?php 
                                $arrHistoricoFiltroGenerico64 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 75);
                                ?>
                                
                                <?php if($GLOBALS['configHistoricoFiltroGenerico64CaixaSelecao'] == 1){ ?>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico64); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input name="idsHistoricoFiltroGenerico64[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico64[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico64[$countArray][0], $arrHistoricoFiltroGenerico64Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico64[$countArray][1];?>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                <?php } ?>
                                <?php if($GLOBALS['configHistoricoFiltroGenerico64CaixaSelecao'] == 2){ ?>
                                    <select id="idsHistoricoFiltroGenerico64" name="idsHistoricoFiltroGenerico64[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01" style="width: 130px;">
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico64); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrHistoricoFiltroGenerico64[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico64[$countArray][0], $arrHistoricoFiltroGenerico64Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico64[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select> 
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                <?php } ?>
                                <?php if($GLOBALS['configHistoricoFiltroGenerico64CaixaSelecao'] == 3){ ?>
                                    <select id="idsHistoricoFiltroGenerico64" name="idsHistoricoFiltroGenerico64[]" class="AdmCampoDropDownMenu01">
                                        <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico64); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrHistoricoFiltroGenerico64[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico64[$countArray][0], $arrHistoricoFiltroGenerico64Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico64[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select>
                                <?php } ?>
                                
                                <?php 
                                $flagManutencaoLink = $configManutencaoLinkFlag;
                                if($configManutencaoLinkFlag != true)
                                {
                                    if(empty($arrHistoricoFiltroGenerico64))
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
                                        <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=75&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                        </a>
                                    <?php } ?>
                                    <?php if($configManutencaoLink == 3){ ?>
                                        <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=75&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $idTbHistorico;?>&configCaixaSelecao=<?php echo $GLOBALS['configHistoricoFiltroGenerico64CaixaSelecao'];?>', '', '', '');
                                                    divShow('divManutencaoAjax');
                                                    HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=75&tipoRetorno=3&idItem=<?php echo $idTbHistorico;?>\', \'idsHistoricoFiltroGenerico64\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico64CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                 <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                        
                        <div style="position: absolute; display: block; top: 150px; left: 5px;">
                            <div align="left" class="AdmTexto01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc55'], "IncludeConfig"); ?>:
                            </div>
                            <div>
                                <?php if($GLOBALS['configHistoricoBoxIc55'] == 1){ ?>
                                    <input type="text" name="informacao_complementar55" id="informacao_complementar55" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC55;?>" />
                                <?php } ?>
                                <?php if($GLOBALS['configHistoricoBoxIc55'] == 2){ ?>
                                    <?php //Sem formatação.?>

                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar55" id="informacao_complementar55" class="AdmCampoTextoMultilinha01"><?php echo $tbHistoricoIC55;?></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação básica (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                        
                                        <script type="text/javascript">
                                            //Caixa básica.
                                            $(document).ready(function () {
                                                $("#informacao_complementar55").cleditor(
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
                                        <textarea name="informacao_complementar55" id="informacao_complementar55"><?php echo $tbHistoricoIC55;?></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação avançada (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $("#informacao_complementar55").cleditor(
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
                                        <textarea name="informacao_complementar55" id="informacao_complementar55"><?php echo $tbHistoricoIC55;?></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                        
                        <div style="position: absolute; display: block; top: 187px; left: 5px;">
                            <div align="left" class="AdmTexto01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc54'], "IncludeConfig"); ?>:
                            </div>
                            <div>
                                <?php if($GLOBALS['configHistoricoBoxIc54'] == 1){ ?>
                                    <input type="text" name="informacao_complementar54" id="informacao_complementar54" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC54;?>" />
                                <?php } ?>
                                <?php if($GLOBALS['configHistoricoBoxIc54'] == 2){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar54" id="informacao_complementar54" class="AdmCampoTextoMultilinha01" style="height: 270px;"><?php echo $tbHistoricoIC54;?></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação básica (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                        
                                        <script type="text/javascript">
                                            //Caixa básica.
                                            $(document).ready(function () {
                                                $("#informacao_complementar54").cleditor(
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
                                        <textarea name="informacao_complementar54" id="informacao_complementar54"><?php echo $tbHistoricoIC54;?></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação avançada (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $("#informacao_complementar54").cleditor(
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
                                        <textarea name="informacao_complementar54" id="informacao_complementar54"><?php echo $tbHistoricoIC54;?></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
