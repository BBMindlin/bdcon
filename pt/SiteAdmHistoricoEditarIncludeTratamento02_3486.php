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
                    	<div class="DivCantoArredondado02"  style="position: absolute; display: block; top: 126px; left: 5px; width: 470px; height: 86px; border: 1px solid #c31907;">
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
                        
                        <div style="position: absolute; display: block; top: 430px; left: 5px;">
                            <div align="left" class="AdmTexto01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc21'], "IncludeConfig"); ?>:
                            </div>
                            <div>
                                <?php if($GLOBALS['configHistoricoBoxIc21'] == 1){ ?>
                                    <input type="text" name="informacao_complementar21" id="informacao_complementar21" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC21;?>" />
                                <?php } ?>
                                <?php if($GLOBALS['configHistoricoBoxIc21'] == 2){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar21" id="informacao_complementar21" class="AdmCampoTextoMultilinha01" style="width: 936px;"><?php echo $tbHistoricoIC21;?></textarea>
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
                        
                        <!--Consolidação do suporte.-->
                    	<div class="DivCantoArredondado02" style="position: absolute; display: block; top: 19px; left: 480px; width: 470px; height: 407px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div class="DivAbaInfo02" style="">
                               Tratamento da Encadernação
                            </div>
                            
                            
                            <div style="position: absolute; display: block; top: 3px; left: 11px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico22Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico22Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "33", "", ",", "", "1"));
                                    ?>
                                
                                    <?php 
                                    $arrHistoricoFiltroGenerico22 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 33);
                                    //echo "arrHistoricoFiltroGenerico22Selecao=" . $arrHistoricoFiltroGenerico22Selecao . "<br />";
                                    //echo "arrHistoricoFiltroGenerico22Selecao[0]=" . $arrHistoricoFiltroGenerico22Selecao[0] . "<br />";
                                    //echo "FiltrosGenericosSelect03=" . DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "13", "", ",", "", "1")  . "<br />";
                                    //echo "tbHistoricoId=" . $tbHistoricoId . "<br />";
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico22CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico22); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico22[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico22[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico22[$countArray][0], $arrHistoricoFiltroGenerico22Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico22[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico22CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico22" name="idsHistoricoFiltroGenerico22[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01" style="width: 130px;">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico22); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico22[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico22[$countArray][0], $arrHistoricoFiltroGenerico22Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico22[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico22CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico22" name="idsHistoricoFiltroGenerico22[]" class="AdmCampoDropDownMenu01">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico22); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico22[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico22[$countArray][0], $arrHistoricoFiltroGenerico22Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico22[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico22))
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
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=33&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=33&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $idTbHistorico;?>&configCaixaSelecao=<?php echo $GLOBALS['configHistoricoFiltroGenerico22CaixaSelecao'];?>', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=33&tipoRetorno=3&idItem=<?php echo $idTbHistorico;?>\', \'idsHistoricoFiltroGenerico22\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico22CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                     <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                                    <img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                                </a>
                                            <?php } ?>                                
                                        <?php } ?>                                
                                    </div>
                                </div>
                            <div style="position: absolute; display: block; top: 3px; left: 180px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc22'], "IncludeConfig"); ?>:
                                </div>
                                <div>
                                    <?php if($GLOBALS['configHistoricoBoxIc22'] == 1){ ?>
                                        <input type="text" name="informacao_complementar22" id="informacao_complementar22" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC22;?>" />
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoBoxIc22'] == 2){ ?>
                                        <?php //Sem formatação.?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                            <textarea name="informacao_complementar22" id="informacao_complementar22" class="AdmCampoTextoMultilinha01" style="width: 280px; height: 30px;"><?php echo $tbHistoricoIC22;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação básica (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                            
                                            <script type="text/javascript">
                                                //Caixa básica.
                                                $(document).ready(function () {
                                                    $("#informacao_complementar22").cleditor(
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
                                            <textarea name="informacao_complementar22" id="informacao_complementar22"><?php echo $tbHistoricoIC22;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação avançada (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                            <script type="text/javascript">
                                                $(document).ready(function () {
                                                    $("#informacao_complementar22").cleditor(
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
                                            <textarea name="informacao_complementar22" id="informacao_complementar22"><?php echo $tbHistoricoIC22;?></textarea>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                            
                            <div style="position: absolute; display: block; top: 53px; left: 11px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico23Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico23Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "34", "", ",", "", "1"));
                                    ?>
            
                                    <?php 
                                    $arrHistoricoFiltroGenerico23 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 34);
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico23CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico23); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico23[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico23[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico23[$countArray][0], $arrHistoricoFiltroGenerico23Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico23[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico23CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico23" name="idsHistoricoFiltroGenerico23[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01" style="width: 130px;">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico23); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico23[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico23[$countArray][0], $arrHistoricoFiltroGenerico23Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico23[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico23CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico23" name="idsHistoricoFiltroGenerico23[]" class="AdmCampoDropDownMenu01">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico23); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico23[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico23[$countArray][0], $arrHistoricoFiltroGenerico23Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico23[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico23))
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
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=34&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=34&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $idTbHistorico;?>&configCaixaSelecao=<?php echo $GLOBALS['configHistoricoFiltroGenerico23CaixaSelecao'];?>', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=34&tipoRetorno=3&idItem=<?php echo $idTbHistorico;?>\', \'idsHistoricoFiltroGenerico23\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico23CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                     <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                                    <img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                                </a>
                                            <?php } ?>                                
                                        <?php } ?>                                
                                    </div>
                                </div>
                            <div style="position: absolute; display: block; top: 53px; left: 180px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc24'], "IncludeConfig"); ?>:
                                </div>
                                <div>
                                    <?php if($GLOBALS['configHistoricoBoxIc24'] == 1){ ?>
                                        <input type="text" name="informacao_complementar24" id="informacao_complementar24" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC24;?>" />
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoBoxIc24'] == 2){ ?>
                                        <?php //Sem formatação.?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                            <textarea name="informacao_complementar24" id="informacao_complementar24" class="AdmCampoTextoMultilinha01" style="width: 280px; height: 30px;"><?php echo $tbHistoricoIC24;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação básica (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                            
                                            <script type="text/javascript">
                                                //Caixa básica.
                                                $(document).ready(function () {
                                                    $("#informacao_complementar24").cleditor(
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
                                            <textarea name="informacao_complementar24" id="informacao_complementar24"><?php echo $tbHistoricoIC24;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação avançada (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                            <script type="text/javascript">
                                                $(document).ready(function () {
                                                    $("#informacao_complementar24").cleditor(
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
                                            <textarea name="informacao_complementar24" id="informacao_complementar24"><?php echo $tbHistoricoIC24;?></textarea>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                            
                            <div style="position: absolute; display: block; top: 103px; left: 11px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico24Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico24Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "35", "", ",", "", "1"));
                                    ?>
                                
                                    <?php 
                                    $arrHistoricoFiltroGenerico24 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 35);
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico24CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico24); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico24[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico24[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico24[$countArray][0], $arrHistoricoFiltroGenerico24Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico24[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico24CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico24" name="idsHistoricoFiltroGenerico24[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico24); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico24[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico24[$countArray][0], $arrHistoricoFiltroGenerico24Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico24[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico24CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico24" name="idsHistoricoFiltroGenerico24[]" class="AdmCampoDropDownMenu01" style="width: 130px;">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico24); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico24[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico24[$countArray][0], $arrHistoricoFiltroGenerico24Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico24[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico24))
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
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=35&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=35&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $idTbHistorico;?>&configCaixaSelecao=<?php echo $GLOBALS['configHistoricoFiltroGenerico24CaixaSelecao'];?>', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=35&tipoRetorno=3&idItem=<?php echo $idTbHistorico;?>\', \'idsHistoricoFiltroGenerico24\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico24CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                     <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                                    <img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                                </a>
                                            <?php } ?>                                
                                        <?php } ?>                                
                                    </div>
                                </div>
                            <div style="position: absolute; display: block; top: 103px; left: 180px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc25'], "IncludeConfig"); ?>:
                                </div>
                                <div>
                                    <?php if($GLOBALS['configHistoricoBoxIc25'] == 1){ ?>
                                        <input type="text" name="informacao_complementar25" id="informacao_complementar25" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC25;?>" />
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoBoxIc25'] == 2){ ?>
                                        <?php //Sem formatação.?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                            <textarea name="informacao_complementar25" id="informacao_complementar25" class="AdmCampoTextoMultilinha01" style="width: 280px; height: 30px;"><?php echo $tbHistoricoIC25;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação básica (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                            
                                            <script type="text/javascript">
                                                //Caixa básica.
                                                $(document).ready(function () {
                                                    $("#informacao_complementar25").cleditor(
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
                                            <textarea name="informacao_complementar25" id="informacao_complementar25"><?php echo $tbHistoricoIC25;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação avançada (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                            <script type="text/javascript">
                                                $(document).ready(function () {
                                                    $("#informacao_complementar25").cleditor(
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
                                            <textarea name="informacao_complementar25" id="informacao_complementar25"><?php echo $tbHistoricoIC25;?></textarea>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                            
                            <div style="position: absolute; display: block; top: 153px; left: 11px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico25Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico25Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "36", "", ",", "", "1"));
                                    ?>
                                
                                    <?php 
                                    $arrHistoricoFiltroGenerico25 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 36);
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico25CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico25); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico25[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico25[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico25[$countArray][0], $arrHistoricoFiltroGenerico25Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico25[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico25CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico25" name="idsHistoricoFiltroGenerico25[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico25); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico25[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico25[$countArray][0], $arrHistoricoFiltroGenerico25Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico25[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico25CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico25" name="idsHistoricoFiltroGenerico25[]" class="AdmCampoDropDownMenu01" style="width: 130px;">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico25); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico25[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico25[$countArray][0], $arrHistoricoFiltroGenerico25Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico25[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico25))
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
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=36&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=36&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $idTbHistorico;?>&configCaixaSelecao=<?php echo $GLOBALS['configHistoricoFiltroGenerico25CaixaSelecao'];?>', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=36&tipoRetorno=3&idItem=<?php echo $idTbHistorico;?>\', \'idsHistoricoFiltroGenerico25\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico25CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                     <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                                    <img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                                </a>
                                            <?php } ?>                                
                                        <?php } ?>                                
                                    </div>
                                </div>
                            <div style="position: absolute; display: block; top: 153px; left: 180px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc26'], "IncludeConfig"); ?>:
                                </div>
                                <div>
                                    <?php if($GLOBALS['configHistoricoBoxIc26'] == 1){ ?>
                                        <input type="text" name="informacao_complementar26" id="informacao_complementar26" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC26;?>" />
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoBoxIc26'] == 2){ ?>
                                        <?php //Sem formatação.?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                            <textarea name="informacao_complementar26" id="informacao_complementar26" class="AdmCampoTextoMultilinha01" style="width: 280px; height: 30px;"><?php echo $tbHistoricoIC26;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação básica (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                            
                                            <script type="text/javascript">
                                                //Caixa básica.
                                                $(document).ready(function () {
                                                    $("#informacao_complementar26").cleditor(
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
                                            <textarea name="informacao_complementar26" id="informacao_complementar26"><?php echo $tbHistoricoIC26;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação avançada (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                            <script type="text/javascript">
                                                $(document).ready(function () {
                                                    $("#informacao_complementar26").cleditor(
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
                                            <textarea name="informacao_complementar26" id="informacao_complementar26"><?php echo $tbHistoricoIC26;?></textarea>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                            
                            <div style="position: absolute; display: block; top: 204px; left: 11px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico26Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico26Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "37", "", ",", "", "1"));
                                    ?>
            
                                    <?php 
                                    $arrHistoricoFiltroGenerico26 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 37);
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico26CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico26); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico26[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico26[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico26[$countArray][0], $arrHistoricoFiltroGenerico26Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico26[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico26CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico26" name="idsHistoricoFiltroGenerico26[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico26); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico26[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico26[$countArray][0], $arrHistoricoFiltroGenerico26Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico26[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico26CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico26" name="idsHistoricoFiltroGenerico26[]" class="AdmCampoDropDownMenu01" style="width: 130px;">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico26); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico26[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico26[$countArray][0], $arrHistoricoFiltroGenerico26Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico26[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico26))
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
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=37&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=37&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $idTbHistorico;?>&configCaixaSelecao=<?php echo $GLOBALS['configHistoricoFiltroGenerico26CaixaSelecao'];?>', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=37&tipoRetorno=3&idItem=<?php echo $idTbHistorico;?>\', \'idsHistoricoFiltroGenerico26\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico26CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                     <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                                    <img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                                </a>
                                            <?php } ?>                                
                                        <?php } ?>                                
                                    </div>
                                </div>
                            <div style="position: absolute; display: block; top: 204px; left: 180px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc27'], "IncludeConfig"); ?>:
                                </div>
                                <div>
                                    <?php if($GLOBALS['configHistoricoBoxIc27'] == 1){ ?>
                                        <input type="text" name="informacao_complementar27" id="informacao_complementar27" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC27;?>" />
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoBoxIc27'] == 2){ ?>
                                        <?php //Sem formatação.?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                            <textarea name="informacao_complementar27" id="informacao_complementar27" class="AdmCampoTextoMultilinha01" style="width: 280px; height: 30px;"><?php echo $tbHistoricoIC27;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação básica (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                            
                                            <script type="text/javascript">
                                                //Caixa básica.
                                                $(document).ready(function () {
                                                    $("#informacao_complementar27").cleditor(
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
                                            <textarea name="informacao_complementar27" id="informacao_complementar27"><?php echo $tbHistoricoIC27;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação avançada (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                            <script type="text/javascript">
                                                $(document).ready(function () {
                                                    $("#informacao_complementar27").cleditor(
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
                                            <textarea name="informacao_complementar27" id="informacao_complementar27"><?php echo $tbHistoricoIC27;?></textarea>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
    
                            <div style="position: absolute; display: block; top: 254px; left: 11px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico27Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico27Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "38", "", ",", "", "1"));
                                    ?>
                                
                                    <?php 
                                    $arrHistoricoFiltroGenerico27 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 38);
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico27CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico27); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico27[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico27[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico27[$countArray][0], $arrHistoricoFiltroGenerico27Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico27[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico27CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico27" name="idsHistoricoFiltroGenerico27[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01" style="width: 130px;">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico27); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico27[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico27[$countArray][0], $arrHistoricoFiltroGenerico27Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico27[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico27CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico27" name="idsHistoricoFiltroGenerico27[]" class="AdmCampoDropDownMenu01">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico27); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico27[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico27[$countArray][0], $arrHistoricoFiltroGenerico27Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico27[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico27))
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
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=38&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=38&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $idTbHistorico;?>&configCaixaSelecao=<?php echo $GLOBALS['configHistoricoFiltroGenerico27CaixaSelecao'];?>', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=38&tipoRetorno=3&idItem=<?php echo $idTbHistorico;?>\', \'idsHistoricoFiltroGenerico27\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico27CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                     <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                                    <img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                                </a>
                                            <?php } ?>                                
                                        <?php } ?>                                
                                    </div>
                                </div>
                            <div style="position: absolute; display: block; top: 254px; left: 180px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc28'], "IncludeConfig"); ?>:
                                </div>
                                <div>
                                    <?php if($GLOBALS['configHistoricoBoxIc28'] == 1){ ?>
                                        <input type="text" name="informacao_complementar28" id="informacao_complementar28" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC28;?>" />
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoBoxIc28'] == 2){ ?>
                                        <?php //Sem formatação.?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                            <textarea name="informacao_complementar28" id="informacao_complementar28" class="AdmCampoTextoMultilinha01" style="width: 280px; height: 30px;"><?php echo $tbHistoricoIC28;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação básica (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                            
                                            <script type="text/javascript">
                                                //Caixa básica.
                                                $(document).ready(function () {
                                                    $("#informacao_complementar28").cleditor(
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
                                            <textarea name="informacao_complementar28" id="informacao_complementar28"><?php echo $tbHistoricoIC28;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação avançada (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                            <script type="text/javascript">
                                                $(document).ready(function () {
                                                    $("#informacao_complementar28").cleditor(
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
                                            <textarea name="informacao_complementar28" id="informacao_complementar28"><?php echo $tbHistoricoIC28;?></textarea>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                            
                            <div style="position: absolute; display: block; top: 304px; left: 11px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico28Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico28Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "39", "", ",", "", "1"));
                                    ?>
            
                                    <?php 
                                    $arrHistoricoFiltroGenerico28 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 39);
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico28CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico28); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico28[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico28[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico28[$countArray][0], $arrHistoricoFiltroGenerico28Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico28[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico28CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico28" name="idsHistoricoFiltroGenerico28[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico28); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico28[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico28[$countArray][0], $arrHistoricoFiltroGenerico28Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico28[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico28CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico28" name="idsHistoricoFiltroGenerico28[]" class="AdmCampoDropDownMenu01" style="width: 130px;">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico28); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico28[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico28[$countArray][0], $arrHistoricoFiltroGenerico28Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico28[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico28))
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
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=39&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=39&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $idTbHistorico;?>&configCaixaSelecao=<?php echo $GLOBALS['configHistoricoFiltroGenerico28CaixaSelecao'];?>', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=39&tipoRetorno=3&idItem=<?php echo $idTbHistorico;?>\', \'idsHistoricoFiltroGenerico28\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico28CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                     <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                                    <img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                                </a>
                                            <?php } ?>                                
                                        <?php } ?>                                
                                    </div>
                                </div>
                            <div style="position: absolute; display: block; top: 304px; left: 180px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc29'], "IncludeConfig"); ?>:
                                </div>
                                <div>
                                    <?php if($GLOBALS['configHistoricoBoxIc29'] == 1){ ?>
                                        <input type="text" name="informacao_complementar29" id="informacao_complementar29" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC29;?>" />
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoBoxIc29'] == 2){ ?>
                                        <?php //Sem formatação.?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                            <textarea name="informacao_complementar29" id="informacao_complementar29" class="AdmCampoTextoMultilinha01" style="width: 280px; height: 30px;"><?php echo $tbHistoricoIC29;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação básica (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                            
                                            <script type="text/javascript">
                                                //Caixa básica.
                                                $(document).ready(function () {
                                                    $("#informacao_complementar29").cleditor(
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
                                            <textarea name="informacao_complementar29" id="informacao_complementar29"><?php echo $tbHistoricoIC29;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação avançada (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                            <script type="text/javascript">
                                                $(document).ready(function () {
                                                    $("#informacao_complementar29").cleditor(
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
                                            <textarea name="informacao_complementar29" id="informacao_complementar29"><?php echo $tbHistoricoIC29;?></textarea>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
    
                            <div style="position: absolute; display: block; top: 353px; left: 11px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico29Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico29Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "40", "", ",", "", "1"));
                                    ?>
            
                                    <?php 
                                    $arrHistoricoFiltroGenerico29 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 40);
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico29CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico29); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico29[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico29[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico29[$countArray][0], $arrHistoricoFiltroGenerico29Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico29[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico29CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico29" name="idsHistoricoFiltroGenerico29[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico29); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico29[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico29[$countArray][0], $arrHistoricoFiltroGenerico29Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico29[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico29CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico29" name="idsHistoricoFiltroGenerico29[]" class="AdmCampoDropDownMenu01" style="width: 130px;">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico29); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico29[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico29[$countArray][0], $arrHistoricoFiltroGenerico29Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico29[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico29))
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
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=40&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=40&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $idTbHistorico;?>&configCaixaSelecao=<?php echo $GLOBALS['configHistoricoFiltroGenerico29CaixaSelecao'];?>', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=40&tipoRetorno=3&idItem=<?php echo $idTbHistorico;?>\', \'idsHistoricoFiltroGenerico29\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico29CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                     <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                                    <img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                                </a>
                                            <?php } ?>                                
                                        <?php } ?>                                
                                    </div>
                                </div>
                            <div style="position: absolute; display: block; top: 353px; left: 180px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc30'], "IncludeConfig"); ?>:
                                </div>
                                <div>
                                    <?php if($GLOBALS['configHistoricoBoxIc30'] == 1){ ?>
                                        <input type="text" name="informacao_complementar30" id="informacao_complementar30" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC30;?>" />
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoBoxIc30'] == 2){ ?>
                                        <?php //Sem formatação.?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                            <textarea name="informacao_complementar30" id="informacao_complementar30" class="AdmCampoTextoMultilinha01" style="width: 280px; height: 30px;"><?php echo $tbHistoricoIC30;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação básica (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                            
                                            <script type="text/javascript">
                                                //Caixa básica.
                                                $(document).ready(function () {
                                                    $("#informacao_complementar30").cleditor(
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
                                            <textarea name="informacao_complementar30" id="informacao_complementar30"><?php echo $tbHistoricoIC30;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação avançada (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                            <script type="text/javascript">
                                                $(document).ready(function () {
                                                    $("#informacao_complementar30").cleditor(
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
                                            <textarea name="informacao_complementar30" id="informacao_complementar30"><?php echo $tbHistoricoIC30;?></textarea>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        
