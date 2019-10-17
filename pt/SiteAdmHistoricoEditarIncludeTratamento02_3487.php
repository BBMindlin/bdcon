                        <!--Consolidação do suporte.-->
                    	<div class="DivCantoArredondado02" style="position: absolute; display: block; top: 19px; left: 5px; width: 470px; height: 86px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div class="DivAbaInfo02" style="">
                                Consolidação do suporte
                            </div>
                            
                            <div style="position: absolute; display: block; top: 4px; left: 11px;">
                                <div align="left" class="AdmTexto01" style="display: inline-block; vertical-align: top;">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico16Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01" style="display: inline-block;">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico16Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "27", "", ",", "", "1"));
                                    ?>
            
                                    <?php 
                                    $arrHistoricoFiltroGenerico16 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 27);
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico16CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico16); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico16[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico16[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico16[$countArray][0], $arrHistoricoFiltroGenerico16Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico16[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico16CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico16" name="idsHistoricoFiltroGenerico16[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01" style="width: 130px;">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico16); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico16[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico16[$countArray][0], $arrHistoricoFiltroGenerico16Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico16[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico16CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico16" name="idsHistoricoFiltroGenerico16[]" class="AdmCampoDropDownMenu01">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico16); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico16[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico16[$countArray][0], $arrHistoricoFiltroGenerico16Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico16[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico16))
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
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=27&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=27&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $idTbHistorico;?>&configCaixaSelecao=<?php echo $GLOBALS['configHistoricoFiltroGenerico16CaixaSelecao'];?>', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=27&tipoRetorno=3&idItem=<?php echo $idTbHistorico;?>\', \'idsHistoricoFiltroGenerico16\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico16CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                            <div style="position: absolute; display: block; top: 4px; left: 260px;">
                                <div align="left" class="AdmTexto01" style="position: absolute; top: 0px; left: -50px;">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc17'], "IncludeConfig"); ?>:
                                </div>
                                <div>
                                    <?php if($GLOBALS['configHistoricoBoxIc17'] == 1){ ?>
                                        <input type="text" name="informacao_complementar17" id="informacao_complementar17" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC17;?>" />
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoBoxIc17'] == 2){ ?>
                                        <?php //Sem formatação.?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                            <textarea name="informacao_complementar17" id="informacao_complementar17" class="AdmCampoTextoMultilinha01" style="width: 200px; height: 70px;"><?php echo $tbHistoricoIC17;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação básica (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                            
                                            <script type="text/javascript">
                                                //Caixa básica.
                                                $(document).ready(function () {
                                                    $("#informacao_complementar17").cleditor(
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
                                            <textarea name="informacao_complementar17" id="informacao_complementar17"><?php echo $tbHistoricoIC17;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação avançada (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                            <script type="text/javascript">
                                                $(document).ready(function () {
                                                    $("#informacao_complementar17").cleditor(
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
                                            <textarea name="informacao_complementar17" id="informacao_complementar17"><?php echo $tbHistoricoIC17;?></textarea>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                            
                            <div style="position: absolute; display: block; top: 45px; left: 11px;">
                                <div align="left" class="AdmTexto01" style="display: inline-block; vertical-align: top;">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico17Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01" style="display: inline-block;">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico17Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "28", "", ",", "", "1"));
                                    ?>
                                
                                    <?php 
                                    $arrHistoricoFiltroGenerico17 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 28);
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico17CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico17); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico17[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico17[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico17[$countArray][0], $arrHistoricoFiltroGenerico17Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico17[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico17CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico17" name="idsHistoricoFiltroGenerico17[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01" style="width: 130px;">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico17); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico17[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico17[$countArray][0], $arrHistoricoFiltroGenerico17Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico17[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico17CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico17" name="idsHistoricoFiltroGenerico17[]" class="AdmCampoDropDownMenu01">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico17); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico17[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico17[$countArray][0], $arrHistoricoFiltroGenerico17Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico17[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico17))
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
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=28&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=28&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $idTbHistorico;?>&configCaixaSelecao=<?php echo $GLOBALS['configHistoricoFiltroGenerico17CaixaSelecao'];?>', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=28&tipoRetorno=3&idItem=<?php echo $idTbHistorico;?>\', \'idsHistoricoFiltroGenerico17\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico17CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                        </div>
                        
                        <!--Reitegração do suporte.-->
                    	<div class="DivCantoArredondado02" style="position: absolute; display: block; top: 126px; left: 5px; width: 470px; height: 86px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div class="DivAbaInfo02" style="">
                                Reitegração do suporte
                            </div>
                            
                            <div style="position: absolute; display: block; top: 4px; left: 11px;">
                                <div align="left" class="AdmTexto01" style="display: inline-block; vertical-align: top;">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico18Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01" style="display: inline-block;">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico18Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "29", "", ",", "", "1"));
                                    ?>
            
                                    <?php 
                                    $arrHistoricoFiltroGenerico18 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 29);
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico18CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico18); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico18[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico18[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico18[$countArray][0], $arrHistoricoFiltroGenerico18Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico18[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico18CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico18" name="idsHistoricoFiltroGenerico18[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01" style="width: 130px;">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico18); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico18[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico18[$countArray][0], $arrHistoricoFiltroGenerico18Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico18[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico18CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico18" name="idsHistoricoFiltroGenerico18[]" class="AdmCampoDropDownMenu01">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico18); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico18[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico18[$countArray][0], $arrHistoricoFiltroGenerico18Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico18[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico18))
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
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=29&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=29&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $idTbHistorico;?>&configCaixaSelecao=<?php echo $GLOBALS['configHistoricoFiltroGenerico18CaixaSelecao'];?>', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=29&tipoRetorno=3&idItem=<?php echo $idTbHistorico;?>\', \'idsHistoricoFiltroGenerico18\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico18CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                            <div style="position: absolute; display: block; top: 4px; left: 260px;">
                                <div align="left" class="AdmTexto01" style="position: absolute; top: 0px; left: -50px;">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc18'], "IncludeConfig"); ?>:
                                </div>
                                <div>
                                    <?php if($GLOBALS['configHistoricoBoxIc18'] == 1){ ?>
                                        <input type="text" name="informacao_complementar18" id="informacao_complementar18" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC18;?>" />
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoBoxIc18'] == 2){ ?>
                                        <?php //Sem formatação.?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                            <textarea name="informacao_complementar18" id="informacao_complementar18" class="AdmCampoTextoMultilinha01" style="width: 200px; height: 70px;"><?php echo $tbHistoricoIC18;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação básica (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                            
                                            <script type="text/javascript">
                                                //Caixa básica.
                                                $(document).ready(function () {
                                                    $("#informacao_complementar18").cleditor(
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
                                            <textarea name="informacao_complementar18" id="informacao_complementar18"><?php echo $tbHistoricoIC18;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação avançada (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                            <script type="text/javascript">
                                                $(document).ready(function () {
                                                    $("#informacao_complementar18").cleditor(
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
                                            <textarea name="informacao_complementar18" id="informacao_complementar18"><?php echo $tbHistoricoIC18;?></textarea>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                            
                            <div style="position: absolute; display: block; top: 45px; left: 5px;">
                                <div align="left" class="AdmTexto01" style="display: inline-block; vertical-align: top;">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico19Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01" style="display: inline-block;">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico19Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "30", "", ",", "", "1"));
                                    ?>
            
                                    <?php 
                                    $arrHistoricoFiltroGenerico19 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 30);
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico19CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico19); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico19[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico19[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico19[$countArray][0], $arrHistoricoFiltroGenerico19Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico19[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico19CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico19" name="idsHistoricoFiltroGenerico19[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01" style="width: 130px;">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico19); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico19[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico19[$countArray][0], $arrHistoricoFiltroGenerico19Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico19[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico19CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico19" name="idsHistoricoFiltroGenerico19[]" class="AdmCampoDropDownMenu01">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico19); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico19[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico19[$countArray][0], $arrHistoricoFiltroGenerico19Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico19[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico19))
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
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=30&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=30&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $idTbHistorico;?>&configCaixaSelecao=<?php echo $GLOBALS['configHistoricoFiltroGenerico19CaixaSelecao'];?>', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=30&tipoRetorno=3&idItem=<?php echo $idTbHistorico;?>\', \'idsHistoricoFiltroGenerico19\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico19CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                        </div>
                        
                        <!--Reitegração cromática.-->
                    	<div class="DivCantoArredondado02" style="position: absolute; display: block; top: 233px; left: 5px; width: 470px; height: 86px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div class="DivAbaInfo02" style="">
                                Reitegração cromática
                            </div>
                            
                            <div style="position: absolute; display: block; top: 4px; left: 12px;">
                                <div align="left" class="AdmTexto01" style="display: inline-block; vertical-align: top;">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico20Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01" style="display: inline-block;">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico20Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "31", "", ",", "", "1"));
                                    ?>
                                
                                    <?php 
                                    $arrHistoricoFiltroGenerico20 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 31);
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico20CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico20); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico20[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico20[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico20[$countArray][0], $arrHistoricoFiltroGenerico20Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico20[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico10CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico20" name="idsHistoricoFiltroGenerico20[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01" style="width: 130px;">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico20); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico20[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico20[$countArray][0], $arrHistoricoFiltroGenerico20Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico20[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
        
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico10CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico20" name="idsHistoricoFiltroGenerico20[]" class="AdmCampoDropDownMenu01">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico20); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico20[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico20[$countArray][0], $arrHistoricoFiltroGenerico20Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico20[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico20))
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
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=31&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=31&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $idTbHistorico;?>&configCaixaSelecao=<?php echo $GLOBALS['configHistoricoFiltroGenerico20CaixaSelecao'];?>', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=31&tipoRetorno=3&idItem=<?php echo $idTbHistorico;?>\', \'idsHistoricoFiltroGenerico20\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico20CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                            <div style="position: absolute; display: block; top: 4px; left: 260px;">
                                <div align="left" class="AdmTexto01" style="position: absolute; top: 0px; left: -50px;">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc19'], "IncludeConfig"); ?>:
                                </div>
                                <div>
                                    <?php if($GLOBALS['configHistoricoBoxIc19'] == 1){ ?>
                                        <input type="text" name="informacao_complementar19" id="informacao_complementar19" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC19;?>" />
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoBoxIc19'] == 2){ ?>
                                        <?php //Sem formatação.?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                            <textarea name="informacao_complementar19" id="informacao_complementar19" class="AdmCampoTextoMultilinha01" style="width: 200px; height: 70px;"><?php echo $tbHistoricoIC19;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação básica (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                            
                                            <script type="text/javascript">
                                                //Caixa básica.
                                                $(document).ready(function () {
                                                    $("#informacao_complementar19").cleditor(
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
                                            <textarea name="informacao_complementar19" id="informacao_complementar19"><?php echo $tbHistoricoIC19;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação avançada (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                            <script type="text/javascript">
                                                $(document).ready(function () {
                                                    $("#informacao_complementar19").cleditor(
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
                                            <textarea name="informacao_complementar19" id="informacao_complementar19"><?php echo $tbHistoricoIC19;?></textarea>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        
                        <!--Aplanamento.-->
                    	<div class="DivCantoArredondado02" style="position: absolute; display: block; top: 340px; left: 5px; width: 470px; height: 86px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div class="DivAbaInfo02" style="">
                                Aplanamento
                            </div>
                            
                            <div style="position: absolute; display: block; top: 4px; left: 27px;">
                                <div align="left" class="AdmTexto01" style="display: inline-block; vertical-align: top;">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico21Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01" style="display: inline-block;">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico21Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "32", "", ",", "", "1"));
                                    ?>
                                
                                    <?php 
                                    $arrHistoricoFiltroGenerico21 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 32);
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico21CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico21); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico21[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico21[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico21[$countArray][0], $arrHistoricoFiltroGenerico21Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico21[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico21CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico21" name="idsHistoricoFiltroGenerico21[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01" style="width: 130px;">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico21); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico21[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico21[$countArray][0], $arrHistoricoFiltroGenerico21Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico21[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico21CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico21" name="idsHistoricoFiltroGenerico21[]" class="AdmCampoDropDownMenu01">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico21); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico21[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico21[$countArray][0], $arrHistoricoFiltroGenerico21Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico21[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico21))
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
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=32&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=32&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $idTbHistorico;?>&configCaixaSelecao=<?php echo $GLOBALS['configHistoricoFiltroGenerico21CaixaSelecao'];?>', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=32&tipoRetorno=3&idItem=<?php echo $idTbHistorico;?>\', \'idsHistoricoFiltroGenerico21\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico21CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                            <div style="position: absolute; display: block; top: 4px; left: 260px;">
                                <div align="left" class="AdmTexto01" style="position: absolute; top: 0px; left: -50px;">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc20'], "IncludeConfig"); ?>:
                                </div>
                                <div>
                                    <?php if($GLOBALS['configHistoricoBoxIc20'] == 1){ ?>
                                        <input type="text" name="informacao_complementar20" id="informacao_complementar20" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC20;?>" />
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoBoxIc20'] == 2){ ?>
                                        <?php //Sem formatação.?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                            <textarea name="informacao_complementar20" id="informacao_complementar20" class="AdmCampoTextoMultilinha01" style="width: 200px; height: 70px;"><?php echo $tbHistoricoIC20;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação básica (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                            
                                            <script type="text/javascript">
                                                //Caixa básica.
                                                $(document).ready(function () {
                                                    $("#informacao_complementar20").cleditor(
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
                                            <textarea name="informacao_complementar20" id="informacao_complementar20"><?php echo $tbHistoricoIC20;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação avançada (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                            <script type="text/javascript">
                                                $(document).ready(function () {
                                                    $("#informacao_complementar20").cleditor(
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
                                            <textarea name="informacao_complementar20" id="informacao_complementar20"><?php echo $tbHistoricoIC20;?></textarea>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div style="position: absolute; display: block; top: 4px; left: 480px;">
                            <div align="left" class="AdmTexto01" style="margin-bottom: 4px;">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc21'], "IncludeConfig"); ?>:
                            </div>
                            <div>
                                <?php if($GLOBALS['configHistoricoBoxIc21'] == 1){ ?>
                                    <input type="text" name="informacao_complementar21" id="informacao_complementar21" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC21;?>" />
                                <?php } ?>
                                <?php if($GLOBALS['configHistoricoBoxIc21'] == 2){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar21" id="informacao_complementar21" class="AdmCampoTextoMultilinha01" style="width: 465px; height: 404px;"><?php echo $tbHistoricoIC21;?></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação básica (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                        
                                        <script type="text/javascript">
                                            //Caixa básica.
                                            $(document).ready(function () {
                                                $("#informacao_complementar21").cleditor(
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
                                        <textarea name="informacao_complementar21" id="informacao_complementar21"><?php echo $tbHistoricoIC21;?></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação avançada (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $("#informacao_complementar21").cleditor(
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
                                        <textarea name="informacao_complementar21" id="informacao_complementar21"><?php echo $tbHistoricoIC21;?></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>

                        
