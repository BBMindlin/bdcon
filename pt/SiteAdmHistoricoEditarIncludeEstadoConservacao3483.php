                    	<div style="position: absolute; display: block; top: 9px; left: 5px;">
                            <div align="left" class="AdmTexto01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoVinculo1Nome'], "IncludeConfig"); ?>:
                            </div>
                            <div class="AdmTexto01">
                                <?php 
                                    $arrHistoricoVinculo1 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbHistoricoVinculo1'], $GLOBALS['configIdTbTipoHistoricoVinculo1'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoHistoricoVinculo1'], $GLOBALS['configHistoricoVinculo1Metodo']);
                                ?>
                                <select name="id_tb_cadastro1" id="id_tb_cadastro1" class="AdmCampoDropDownMenu01" style="width: 180px;">
                                    <option value="0"<?php if($tbHistoricoIdTbCadastro1 == 0){ ?>selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNenhumDropDown"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoVinculo1); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoVinculo1[$countArray][0];?>"<?php if($arrHistoricoVinculo1[$countArray][0] == $tbHistoricoIdTbCadastro1){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoVinculo1[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        
                        <div style="position: absolute; display: block; top: 46px; left: 5px;">
                            <div align="left" class="AdmTexto01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico62Nome'], "IncludeConfig"); ?>: 
                            </div>
                            <div class="AdmTexto01">
                                <?php
                                //Seleção de ids selecionados para o registro.
                                $arrHistoricoFiltroGenerico62Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "73", "", ",", "", "1"));
                                ?>
                            
                                <?php 
                                $arrHistoricoFiltroGenerico62 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 73);
                                //echo "arrHistoricoFiltroGenerico62Selecao=" . $arrHistoricoFiltroGenerico62Selecao . "<br />";
                                //echo "arrHistoricoFiltroGenerico62Selecao[0]=" . $arrHistoricoFiltroGenerico62Selecao[0] . "<br />";
                                //echo "FiltrosGenericosSelect03=" . DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "13", "", ",", "", "1")  . "<br />";
                                //echo "tbHistoricoId=" . $tbHistoricoId . "<br />";
                                ?>
                                
                                <?php if($GLOBALS['configHistoricoFiltroGenerico62CaixaSelecao'] == 1){ ?>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico62); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input name="idsHistoricoFiltroGenerico62[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico62[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico62[$countArray][0], $arrHistoricoFiltroGenerico62Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico62[$countArray][1];?>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                <?php } ?>
                                <?php if($GLOBALS['configHistoricoFiltroGenerico62CaixaSelecao'] == 2){ ?>
                                    <select id="idsHistoricoFiltroGenerico62" name="idsHistoricoFiltroGenerico62[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico62); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrHistoricoFiltroGenerico62[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico62[$countArray][0], $arrHistoricoFiltroGenerico62Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico62[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select> 
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                <?php } ?>
                                <?php if($GLOBALS['configHistoricoFiltroGenerico62CaixaSelecao'] == 3){ ?>
                                    <select id="idsHistoricoFiltroGenerico62" name="idsHistoricoFiltroGenerico62[]" class="AdmCampoDropDownMenu01" style="width: 130px;">
                                        <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico62); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrHistoricoFiltroGenerico62[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico62[$countArray][0], $arrHistoricoFiltroGenerico62Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico62[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select>
                                <?php } ?>
                                
                                <?php 
                                $flagManutencaoLink = $configManutencaoLinkFlag;
                                if($configManutencaoLinkFlag != true)
                                {
                                    if(empty($arrHistoricoFiltroGenerico62))
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
                                        <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=73&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                        </a>
                                    <?php } ?>
                                    <?php if($configManutencaoLink == 3){ ?>
                                        <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=73&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $idTbHistorico;?>&configCaixaSelecao=<?php echo $GLOBALS['configHistoricoFiltroGenerico62CaixaSelecao'];?>', '', '', '');
                                                    divShow('divManutencaoAjax');
                                                    HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=73&tipoRetorno=3&idItem=<?php echo $idTbHistorico;?>\', \'idsHistoricoFiltroGenerico62\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico62CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                 <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                        
                        <div style="position: absolute; display: block; top: 82px; left: 5px;">
                            <div align="left" class="AdmTexto01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico63Nome'], "IncludeConfig"); ?>: 
                            </div>
                            <div class="AdmTexto01">
                                <?php
                                //Seleção de ids selecionados para o registro.
                                $arrHistoricoFiltroGenerico63Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "74", "", ",", "", "1"));
                                ?>
        
                                <?php 
                                $arrHistoricoFiltroGenerico63 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 74);
                                ?>
                                
                                <?php if($GLOBALS['configHistoricoFiltroGenerico63CaixaSelecao'] == 1){ ?>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico63); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input name="idsHistoricoFiltroGenerico63[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico63[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico63[$countArray][0], $arrHistoricoFiltroGenerico63Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico63[$countArray][1];?>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                <?php } ?>
                                <?php if($GLOBALS['configHistoricoFiltroGenerico63CaixaSelecao'] == 2){ ?>
                                    <select id="idsHistoricoFiltroGenerico63" name="idsHistoricoFiltroGenerico63[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01" style="height: 80px; width: 130px;">
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico63); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrHistoricoFiltroGenerico63[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico63[$countArray][0], $arrHistoricoFiltroGenerico63Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico63[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select> 
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                <?php } ?>
                                <?php if($GLOBALS['configHistoricoFiltroGenerico63CaixaSelecao'] == 3){ ?>
                                    <select id="idsHistoricoFiltroGenerico63" name="idsHistoricoFiltroGenerico63[]" class="AdmCampoDropDownMenu01">
                                        <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico63); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrHistoricoFiltroGenerico63[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico63[$countArray][0], $arrHistoricoFiltroGenerico63Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico63[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select>
                                <?php } ?>
                                
                                <?php 
                                $flagManutencaoLink = $configManutencaoLinkFlag;
                                if($configManutencaoLinkFlag != true)
                                {
                                    if(empty($arrHistoricoFiltroGenerico63))
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
                                        <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=74&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                        </a>
                                    <?php } ?>
                                    <?php if($configManutencaoLink == 3){ ?>
                                        <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=74&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $idTbHistorico;?>&configCaixaSelecao=<?php echo $GLOBALS['configHistoricoFiltroGenerico63CaixaSelecao'];?>', '', '', '');
                                                    divShow('divManutencaoAjax');
                                                    HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=74&tipoRetorno=3&idItem=<?php echo $idTbHistorico;?>\', \'idsHistoricoFiltroGenerico63\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico63CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                 <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                        
                        <div style="position: absolute; display: block; top: 182px; left: 5px;">
                            <div align="left" class="AdmTexto01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc51'], "IncludeConfig"); ?>:
                            </div>
                            <div>
                                <?php if($GLOBALS['configHistoricoBoxIc51'] == 1){ ?>
                                    <input type="text" name="informacao_complementar51" id="informacao_complementar51" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC51;?>" />
                                <?php } ?>
                                <?php if($GLOBALS['configHistoricoBoxIc51'] == 2){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar51" id="informacao_complementar51" class="AdmCampoTextoMultilinha01" style="width: 470px; height: 250px;"><?php echo $tbHistoricoIC51;?></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação básica (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                        
                                        <script type="text/javascript">
                                            //Caixa básica.
                                            $(document).ready(function () {
                                                $("#informacao_complementar51").cleditor(
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
                                        <textarea name="informacao_complementar51" id="informacao_complementar51"><?php echo $tbHistoricoIC51;?></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação avançada (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $("#informacao_complementar51").cleditor(
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
                                        <textarea name="informacao_complementar51" id="informacao_complementar51"><?php echo $tbHistoricoIC51;?></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                            </div>
                        
                        <!--Encadernação.-->
                    	<div class="DivCantoArredondado02" style="position: absolute; display: block; top: 24px; left: 490px; width: 470px; height: 430px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div class="DivAbaInfo02">
                                Montagem / embalagem em que o material chegou
                            </div>
                            
                            <div style="position: absolute; display: block; top: 4px; left: 14px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico50Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico50Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "61", "", ",", "", "1"));
                                    ?>
                                
                                    <?php 
                                    $arrHistoricoFiltroGenerico50 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 61);
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico50CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico50); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico50[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico50[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico50[$countArray][0], $arrHistoricoFiltroGenerico50Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico50[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico50CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico50" name="idsHistoricoFiltroGenerico50[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01" style="height: 50px; width: 130px;">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico50); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico50[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico50[$countArray][0], $arrHistoricoFiltroGenerico50Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico50[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico50CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico50" name="idsHistoricoFiltroGenerico50[]" class="AdmCampoDropDownMenu01">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
    
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico50); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico50[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico50[$countArray][0], $arrHistoricoFiltroGenerico50Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico50[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico50))
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
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=61masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=61&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $idTbHistorico;?>&configCaixaSelecao=<?php echo $GLOBALS['configHistoricoFiltroGenerico50CaixaSelecao'];?>', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=61&tipoRetorno=3&idItem=<?php echo $idTbHistorico;?>\', \'idsHistoricoFiltroGenerico50\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico50CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                            <div style="position: absolute; display: block; top: 4px; left: 250px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico51Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico51Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "62", "", ",", "", "1"));
                                    ?>
                                
                                    <?php 
                                    $arrHistoricoFiltroGenerico51 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 62);
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico51CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico51); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico51[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico51[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico51[$countArray][0], $arrHistoricoFiltroGenerico51Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico51[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico51CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico51" name="idsHistoricoFiltroGenerico51[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01" style="height: 50px; width: 130px;">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico51); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico51[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico51[$countArray][0], $arrHistoricoFiltroGenerico51Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico51[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico51CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico51" name="idsHistoricoFiltroGenerico51[]" class="AdmCampoDropDownMenu01">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico51); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico51[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico51[$countArray][0], $arrHistoricoFiltroGenerico51Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico51[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico51))
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
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=62&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=62&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $idTbHistorico;?>&configCaixaSelecao=<?php echo $GLOBALS['configHistoricoFiltroGenerico51CaixaSelecao'];?>', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=62&tipoRetorno=3&idItem=<?php echo $idTbHistorico;?>\', \'idsHistoricoFiltroGenerico51\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico51CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                            
                            <!--No caso de moldura.-->
                            <div class="DivCantoArredondado02" style="position: absolute; display: block; top: 90px; left: 10px; width: 450px; height: 70px; border: 1px solid #c31907;">
                                <!--sub títulos.-->
                                <div class="DivAbaInfo02" style="">
                                    No caso de moldura
                                </div>
                                
                                <div style="position: absolute; display: block; top: 4px; left: 5px;">
                                    <div align="left" class="AdmTexto01">
                                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico58Nome'], "IncludeConfig"); ?>: 
                                    </div>
                                    <div class="AdmTexto01">
                                        <?php
                                        //Seleção de ids selecionados para o registro.
                                        $arrHistoricoFiltroGenerico58Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "69", "", ",", "", "1"));
                                        ?>
                
                                        <?php 
                                        $arrHistoricoFiltroGenerico58 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 69);
                                        ?>
                                        
                                        <?php if($GLOBALS['configHistoricoFiltroGenerico58CaixaSelecao'] == 1){ ?>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico58); $countArray++)
                                            {
                                            ?>
                                                <div>
                                                    <input name="idsHistoricoFiltroGenerico58[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico58[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico58[$countArray][0], $arrHistoricoFiltroGenerico58Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico58[$countArray][1];?>
                                                </div>
                                            <?php 
                                            }
                                            ?>
                                        <?php } ?>
                                        <?php if($GLOBALS['configHistoricoFiltroGenerico58CaixaSelecao'] == 2){ ?>
                                            <select id="idsHistoricoFiltroGenerico58" name="idsHistoricoFiltroGenerico58[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01" style="height: 50px; width: 130px;">
                                                <?php 
                                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico58); $countArray++)
                                                {
                                                ?>
                                                    <option value="<?php echo $arrHistoricoFiltroGenerico58[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico58[$countArray][0], $arrHistoricoFiltroGenerico58Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico58[$countArray][1];?></option>
                                                <?php 
                                                }
                                                ?>
                                            </select> 
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                        <?php } ?>
                                        <?php if($GLOBALS['configHistoricoFiltroGenerico58CaixaSelecao'] == 3){ ?>
                                            <select id="idsHistoricoFiltroGenerico58" name="idsHistoricoFiltroGenerico58[]" class="AdmCampoDropDownMenu01">
                                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                                <?php 
                                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico58); $countArray++)
                                                {
                                                ?>
                                                    <option value="<?php echo $arrHistoricoFiltroGenerico58[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico58[$countArray][0], $arrHistoricoFiltroGenerico58Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico58[$countArray][1];?></option>
                                                <?php 
                                                }
                                                ?>
                                            </select>
                                        <?php } ?>
                                        
                                        <?php 
                                        $flagManutencaoLink = $configManutencaoLinkFlag;
                                        if($configManutencaoLinkFlag != true)
                                        {
                                            if(empty($arrHistoricoFiltroGenerico58))
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
                                                <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=69&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                                </a>
                                            <?php } ?>
                                            <?php if($configManutencaoLink == 3){ ?>
                                                <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=69&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $idTbHistorico;?>&configCaixaSelecao=<?php echo $GLOBALS['configHistoricoFiltroGenerico58CaixaSelecao'];?>', '', '', '');
                                                            divShow('divManutencaoAjax');
                                                            HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=69&tipoRetorno=3&idItem=<?php echo $idTbHistorico;?>\', \'idsHistoricoFiltroGenerico58\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico58CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                    <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                                <div style="position: absolute; display: block; top: 4px; left: 240px;">
                                    <div align="left" class="AdmTexto01">
                                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico59Nome'], "IncludeConfig"); ?>: 
                                    </div>
                                    <div class="AdmTexto01">
                                        <?php
                                        //Seleção de ids selecionados para o registro.
                                        $arrHistoricoFiltroGenerico59Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "70", "", ",", "", "1"));
                                        ?>
                
                                        <?php 
                                        $arrHistoricoFiltroGenerico59 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 70);
                                        ?>
                                        
                                        <?php if($GLOBALS['configHistoricoFiltroGenerico59CaixaSelecao'] == 1){ ?>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico59); $countArray++)
                                            {
                                            ?>
                                                <div>
                                                    <input name="idsHistoricoFiltroGenerico59[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico59[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico59[$countArray][0], $arrHistoricoFiltroGenerico59Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico59[$countArray][1];?>
                                                </div>
                                            <?php 
                                            }
                                            ?>
                                        <?php } ?>
                                        <?php if($GLOBALS['configHistoricoFiltroGenerico59CaixaSelecao'] == 2){ ?>
                                            <select id="idsHistoricoFiltroGenerico59" name="idsHistoricoFiltroGenerico59[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01" style="height: 50px; width: 130px;">
                                                <?php 
                                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico59); $countArray++)
                                                {
                                                ?>
                                                    <option value="<?php echo $arrHistoricoFiltroGenerico59[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico59[$countArray][0], $arrHistoricoFiltroGenerico59Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico59[$countArray][1];?></option>
                                                <?php 
                                                }
                                                ?>
                                            </select> 
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                        <?php } ?>
                                        <?php if($GLOBALS['configHistoricoFiltroGenerico59CaixaSelecao'] == 3){ ?>
                                            <select id="idsHistoricoFiltroGenerico59" name="idsHistoricoFiltroGenerico59[]" class="AdmCampoDropDownMenu01">
                                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                                <?php 
                                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico59); $countArray++)
                                                {
                                                ?>
                                                    <option value="<?php echo $arrHistoricoFiltroGenerico59[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico59[$countArray][0], $arrHistoricoFiltroGenerico59Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico59[$countArray][1];?></option>
                                                <?php 
                                                }
                                                ?>
                                            </select>
                                        <?php } ?>
                                        
                                        <?php 
                                        $flagManutencaoLink = $configManutencaoLinkFlag;
                                        if($configManutencaoLinkFlag != true)
                                        {
                                            if(empty($arrHistoricoFiltroGenerico59))
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
                                                <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=70&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                                </a>
                                            <?php } ?>
                                            <?php if($configManutencaoLink == 3){ ?>
                                                <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=70&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $idTbHistorico;?>&configCaixaSelecao=<?php echo $GLOBALS['configHistoricoFiltroGenerico59CaixaSelecao'];?>', '', '', '');
                                                            divShow('divManutencaoAjax');
                                                            HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=70&tipoRetorno=3&idItem=<?php echo $idTbHistorico;?>\', \'idsHistoricoFiltroGenerico59\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico59CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                    <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                            </div>
                            
                            <div style="position: absolute; display: block; top: 170px; left: 15px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico61Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico61Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "72", "", ",", "", "1"));
                                    ?>
                                
                                    <?php 
                                    $arrHistoricoFiltroGenerico61 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 72);
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico61CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico61); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico61[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico61[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico61[$countArray][0], $arrHistoricoFiltroGenerico61Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico61[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico61CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico61" name="idsHistoricoFiltroGenerico61[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01" style="height: 50px; width: 130px;">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico61); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico61[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico61[$countArray][0], $arrHistoricoFiltroGenerico61Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico61[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico61CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico61" name="idsHistoricoFiltroGenerico61[]" class="AdmCampoDropDownMenu01">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico61); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico61[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico61[$countArray][0], $arrHistoricoFiltroGenerico61Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico61[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico61))
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
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=72&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=72&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $idTbHistorico;?>&configCaixaSelecao=<?php echo $GLOBALS['configHistoricoFiltroGenerico61CaixaSelecao'];?>', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=72&tipoRetorno=3&idItem=<?php echo $idTbHistorico;?>\', \'idsHistoricoFiltroGenerico61\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico61CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                            <div style="position: absolute; display: block; top: 170px; left: 251px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc49'], "IncludeConfig"); ?>:
                                </div>
                                <div>
                                    <?php if($GLOBALS['configHistoricoBoxIc49'] == 1){ ?>
                                        <input type="text" name="informacao_complementar49" id="informacao_complementar49" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC49;?>" />
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoBoxIc49'] == 2){ ?>
                                        <?php //Sem formatação.?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                            <textarea name="informacao_complementar49" id="informacao_complementar49" class="AdmCampoTextoMultilinha01"><?php echo $tbHistoricoIC49;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação básica (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                            
                                            <script type="text/javascript">
                                                //Caixa básica.
                                                $(document).ready(function () {
                                                    $("#informacao_complementar49").cleditor(
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
                                            <textarea name="informacao_complementar49" id="informacao_complementar49"><?php echo $tbHistoricoIC49;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação avançada (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                            <script type="text/javascript">
                                                $(document).ready(function () {
                                                    $("#informacao_complementar49").cleditor(
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
                                            <textarea name="informacao_complementar49" id="informacao_complementar49"><?php echo $tbHistoricoIC49;?></textarea>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                            
                            <div style="position: absolute; display: block; top: 240px; left: 15px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc56'], "IncludeConfig"); ?>:
                                </div>
                                <div>
                                    <?php if($GLOBALS['configHistoricoBoxIc56'] == 1){ ?>
                                        <input type="text" name="informacao_complementar56" id="informacao_complementar56" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC56;?>" />
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoBoxIc56'] == 2){ ?>
                                        <?php //Sem formatação.?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                            <textarea name="informacao_complementar56" id="informacao_complementar56" class="AdmCampoTextoMultilinha01" style="width: 440px; height: 165px;"><?php echo $tbHistoricoIC56;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação básica (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                            
                                            <script type="text/javascript">
                                                //Caixa básica.
                                                $(document).ready(function () {
                                                    $("#informacao_complementar56").cleditor(
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
                                            <textarea name="informacao_complementar56" id="informacao_complementar56"><?php echo $tbHistoricoIC56;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação avançada (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                            <script type="text/javascript">
                                                $(document).ready(function () {
                                                    $("#informacao_complementar56").cleditor(
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
                                            <textarea name="informacao_complementar56" id="informacao_complementar56"><?php echo $tbHistoricoIC56;?></textarea>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
