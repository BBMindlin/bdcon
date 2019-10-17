                        <div style="position: absolute; display: block; top: 10px; left: 5px;">
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
                        
                        <!--Acondicionamento.-->
                        <div class="DivCantoArredondado02" style="position: absolute; display: block; top: 58px; left: 5px; width: 470px; height: 460px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div class="DivAbaInfo02" style="">
                                Acondicionamento
                            </div>
                            
                            <div style="position: absolute; display: block; top: 3px; left: 5px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico69Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico69Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "80", "", ",", "", "1"));
                                    ?>
                                
                                    <?php 
                                    $arrHistoricoFiltroGenerico69 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 80);
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico69CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico69); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico69[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico69[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico69[$countArray][0], $arrHistoricoFiltroGenerico69Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico69[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico60CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico69" name="idsHistoricoFiltroGenerico69[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01" style="width: 130px;">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico69); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico69[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico69[$countArray][0], $arrHistoricoFiltroGenerico69Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico69[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico60CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico69" name="idsHistoricoFiltroGenerico69[]" class="AdmCampoDropDownMenu01">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico69); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico69[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico69[$countArray][0], $arrHistoricoFiltroGenerico69Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico69[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico69))
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
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=80&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=80&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $idTbHistorico;?>&configCaixaSelecao=<?php echo $GLOBALS['configHistoricoFiltroGenerico69CaixaSelecao'];?>', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=80&tipoRetorno=3&idItem=<?php echo $idTbHistorico;?>\', \'idsHistoricoFiltroGenerico69\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico69CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                            
                            <div style="position: absolute; display: block; top: 54px; left: 5px;">
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
                            
                            <div style="position: absolute; display: block; top: 106px; left: 5px;">
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
                            
                            <div style="position: absolute; display: block; top: 142px; left: 5px;">
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
                                            <textarea name="informacao_complementar54" id="informacao_complementar54" class="AdmCampoTextoMultilinha01" style="width: 450px; height: 290px;"><?php echo $tbHistoricoIC54;?></textarea>
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
                        </div>
                        
                        
                        
                        
                        <!--Montagem.-->
                        <div class="DivCantoArredondado02" style="position: absolute; display: block; top: 58px; left: 490px; width: 470px; height: 460px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div class="DivAbaInfo02" style="">
                                Montagem
                            </div>
                            
                            <div style="position: absolute; display: block; top: 3px; left: 15px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico65Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico65Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "76", "", ",", "", "1"));
                                    ?>
                                
                                    <?php 
                                    $arrHistoricoFiltroGenerico65 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 76);
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico65CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico65); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico65[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico65[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico65[$countArray][0], $arrHistoricoFiltroGenerico65Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico65[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico65CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico65" name="idsHistoricoFiltroGenerico65[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico65); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico65[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico65[$countArray][0], $arrHistoricoFiltroGenerico65Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico65[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico65CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico65" name="idsHistoricoFiltroGenerico65[]" class="AdmCampoDropDownMenu01" style="width: 80px;">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico65); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico65[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico65[$countArray][0], $arrHistoricoFiltroGenerico65Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico65[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico65))
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
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=76&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=76&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $idTbHistorico;?>&configCaixaSelecao=<?php echo $GLOBALS['configHistoricoFiltroGenerico65CaixaSelecao'];?>', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=76&tipoRetorno=3&idItem=<?php echo $idTbHistorico;?>\', \'idsHistoricoFiltroGenerico65\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico65CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                            
                            <div style="position: absolute; display: block; top: 38px; left: 15px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico71Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico71Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "82", "", ",", "", "1"));
                                    ?>
                                
                                    <?php 
                                    $arrHistoricoFiltroGenerico71 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 82);
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico71CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico71); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico71[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico71[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico71[$countArray][0], $arrHistoricoFiltroGenerico71Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico71[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico71CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico71" name="idsHistoricoFiltroGenerico71[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01" style="width: 180px;">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico71); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico71[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico71[$countArray][0], $arrHistoricoFiltroGenerico71Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico71[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico71CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico71" name="idsHistoricoFiltroGenerico71[]" class="AdmCampoDropDownMenu01">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico71); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico71[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico71[$countArray][0], $arrHistoricoFiltroGenerico71Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico71[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico71))
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
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=82&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=82&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $idTbHistorico;?>&configCaixaSelecao=<?php echo $GLOBALS['configHistoricoFiltroGenerico71CaixaSelecao'];?>', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=82&tipoRetorno=3&idItem=<?php echo $idTbHistorico;?>\', \'idsHistoricoFiltroGenerico71\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico71CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                            <div style="position: absolute; display: block; top: 38px; left: 230px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico66Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico66Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "77", "", ",", "", "1"));
                                    ?>
            
                                    <?php 
                                    $arrHistoricoFiltroGenerico66 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 77);
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico66CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico66); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico66[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico66[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico66[$countArray][0], $arrHistoricoFiltroGenerico66Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico66[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico66CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico66" name="idsHistoricoFiltroGenerico66[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01" style="width: 180px;">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico66); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico66[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico66[$countArray][0], $arrHistoricoFiltroGenerico66Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico66[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico66CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico66" name="idsHistoricoFiltroGenerico66[]" class="AdmCampoDropDownMenu01">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico66); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico66[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico66[$countArray][0], $arrHistoricoFiltroGenerico66Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico66[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico66))
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
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=77&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=77&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $idTbHistorico;?>&configCaixaSelecao=<?php echo $GLOBALS['configHistoricoFiltroGenerico66CaixaSelecao'];?>', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=77&tipoRetorno=3&idItem=<?php echo $idTbHistorico;?>\', \'idsHistoricoFiltroGenerico66\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico66CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                            
                            <div style="position: absolute; display: block; top: 90px; left: 15px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico67Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico67Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "78", "", ",", "", "1"));
                                    ?>
                                
                                    <?php 
                                    $arrHistoricoFiltroGenerico67 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 78);
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico67CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico67); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico67[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico67[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico67[$countArray][0], $arrHistoricoFiltroGenerico67Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico67[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico67CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico67" name="idsHistoricoFiltroGenerico67[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01" style="width: 180px;">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico67); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico67[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico67[$countArray][0], $arrHistoricoFiltroGenerico67Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico67[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico67CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico67" name="idsHistoricoFiltroGenerico67[]" class="AdmCampoDropDownMenu01">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico67); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico67[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico67[$countArray][0], $arrHistoricoFiltroGenerico67Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico67[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico67))
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
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=78&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=78&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $idTbHistorico;?>&configCaixaSelecao=<?php echo $GLOBALS['configHistoricoFiltroGenerico67CaixaSelecao'];?>', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=78&tipoRetorno=3&idItem=<?php echo $idTbHistorico;?>\', \'idsHistoricoFiltroGenerico67\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico67CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                            <div style="position: absolute; display: block; top: 90px; left: 230px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico68Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico68Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "79", "", ",", "", "1"));
                                    ?>
            
                                    <?php 
                                    $arrHistoricoFiltroGenerico68 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 79);
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico68CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico68); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico68[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico68[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico68[$countArray][0], $arrHistoricoFiltroGenerico68Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico68[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico68CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico68" name="idsHistoricoFiltroGenerico68[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01" style="width: 180px;">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico68); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico68[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico68[$countArray][0], $arrHistoricoFiltroGenerico68Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico68[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico68CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico68" name="idsHistoricoFiltroGenerico68[]" class="AdmCampoDropDownMenu01">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico68); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico68[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico68[$countArray][0], $arrHistoricoFiltroGenerico68Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico68[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico68))
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
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=79&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=79&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $idTbHistorico;?>&configCaixaSelecao=<?php echo $GLOBALS['configHistoricoFiltroGenerico68CaixaSelecao'];?>', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=79&tipoRetorno=3&idItem=<?php echo $idTbHistorico;?>\', \'idsHistoricoFiltroGenerico68\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico68CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                            
                            <!--Passe-partout.-->
                            <div class="DivCantoArredondado02" style="position: absolute; display: block; top: 158px; left: 10px; width: 450px; height: 57px; border: 1px solid #808080;">
                                <!--sub títulos.-->
                                <div class="DivAbaInfo03" style="">
                                    Passe-partout
                                </div>
                                
                                <div style="position: absolute; display: block; top: 3px; left: 5px;">
                                    <div align="left" class="AdmTexto01">
                                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico70Nome'], "IncludeConfig"); ?>: 
                                    </div>
                                    <div class="AdmTexto01">
                                        <?php
                                        //Seleção de ids selecionados para o registro.
                                        $arrHistoricoFiltroGenerico70Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "81", "", ",", "", "1"));
                                        ?>
                                    
                                        <?php 
                                        $arrHistoricoFiltroGenerico70 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 81);
                                        ?>
                                        
                                        <?php if($GLOBALS['configHistoricoFiltroGenerico70CaixaSelecao'] == 1){ ?>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico70); $countArray++)
                                            {
                                            ?>
                                                <div>
                                                    <input name="idsHistoricoFiltroGenerico70[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico70[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico70[$countArray][0], $arrHistoricoFiltroGenerico70Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico70[$countArray][1];?>
                                                </div>
                                            <?php 
                                            }
                                            ?>
                                        <?php } ?>
                                        <?php if($GLOBALS['configHistoricoFiltroGenerico70CaixaSelecao'] == 2){ ?>
                                            <select id="idsHistoricoFiltroGenerico70" name="idsHistoricoFiltroGenerico70[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01" style="width: 180px;">
                                                <?php 
                                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico70); $countArray++)
                                                {
                                                ?>
                                                    <option value="<?php echo $arrHistoricoFiltroGenerico70[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico70[$countArray][0], $arrHistoricoFiltroGenerico70Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico70[$countArray][1];?></option>
                                                <?php 
                                                }
                                                ?>
                                            </select> 
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                        <?php } ?>
                                        <?php if($GLOBALS['configHistoricoFiltroGenerico70CaixaSelecao'] == 3){ ?>
                                            <select id="idsHistoricoFiltroGenerico70" name="idsHistoricoFiltroGenerico70[]" class="AdmCampoDropDownMenu01">
                                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                                <?php 
                                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico70); $countArray++)
                                                {
                                                ?>
                                                    <option value="<?php echo $arrHistoricoFiltroGenerico70[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico70[$countArray][0], $arrHistoricoFiltroGenerico70Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico70[$countArray][1];?></option>
                                                <?php 
                                                }
                                                ?>
                                            </select>
                                        <?php } ?>
                                        
                                        <?php 
                                        $flagManutencaoLink = $configManutencaoLinkFlag;
                                        if($configManutencaoLinkFlag != true)
                                        {
                                            if(empty($arrHistoricoFiltroGenerico70))
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
                                                <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=81&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                                </a>
                                            <?php } ?>
                                            <?php if($configManutencaoLink == 3){ ?>
                                                <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=81&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $idTbHistorico;?>&configCaixaSelecao=<?php echo $GLOBALS['configHistoricoFiltroGenerico70CaixaSelecao'];?>', '', '', '');
                                                            divShow('divManutencaoAjax');
                                                            HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=81&tipoRetorno=3&idItem=<?php echo $idTbHistorico;?>\', \'idsHistoricoFiltroGenerico70\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico70CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                    <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                                <div style="position: absolute; display: block; top: 3px; left: 220px;">
                                    <div align="left" class="AdmTexto01">
                                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc57'], "IncludeConfig"); ?>:
                                    </div>
                                    <div>
                                        <?php if($GLOBALS['configHistoricoBoxIc57'] == 1){ ?>
                                            <input type="text" name="informacao_complementar57" id="informacao_complementar57" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC57;?>" />
                                        <?php } ?>
                                        <?php if($GLOBALS['configHistoricoBoxIc57'] == 2){ ?>
                                            <?php //Sem formatação.?>
                                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                                <textarea name="informacao_complementar57" id="informacao_complementar57" class="AdmCampoTextoMultilinha01"><?php echo $tbHistoricoIC57;?></textarea>
                                            <?php } ?>
                                            
                                            <?php //Formatação básica (CLEditor).?>
                                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                                
                                                <script type="text/javascript">
                                                    //Caixa básica.
                                                    $(document).ready(function () {
                                                        $("#informacao_complementar57").cleditor(
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
                                                <textarea name="informacao_complementar57" id="informacao_complementar57"><?php echo $tbHistoricoIC57;?></textarea>
                                            <?php } ?>
                                            
                                            <?php //Formatação avançada (CLEditor).?>
                                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                                <script type="text/javascript">
                                                    $(document).ready(function () {
                                                        $("#informacao_complementar57").cleditor(
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
                                                <textarea name="informacao_complementar57" id="informacao_complementar57"><?php echo $tbHistoricoIC57;?></textarea>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            
                            <div style="position: absolute; display: block; top: 225px; left: 15px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc58'], "IncludeConfig"); ?>:
                                </div>
                                <div>
                                    <?php if($GLOBALS['configHistoricoBoxIc58'] == 1){ ?>
                                        <input type="text" name="informacao_complementar58" id="informacao_complementar58" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC58;?>" />
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoBoxIc58'] == 2){ ?>
                                        <?php //Sem formatação.?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                            <textarea name="informacao_complementar58" id="informacao_complementar58" class="AdmCampoTextoMultilinha01" style="width: 440px; height: 207px;"><?php echo $tbHistoricoIC58;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação básica (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                            
                                            <script type="text/javascript">
                                                //Caixa básica.
                                                $(document).ready(function () {
                                                    $("#informacao_complementar58").cleditor(
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
                                            <textarea name="informacao_complementar58" id="informacao_complementar58"><?php echo $tbHistoricoIC58;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação avançada (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                            <script type="text/javascript">
                                                $(document).ready(function () {
                                                    $("#informacao_complementar58").cleditor(
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
                                            <textarea name="informacao_complementar58" id="informacao_complementar58"><?php echo $tbHistoricoIC58;?></textarea>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
