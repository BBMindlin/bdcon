                    <div style="position: relative; display: block;">
                    
                        <div style="position: absolute; display: block; top: 4px; left: 18px;">
                            <div align="left" class="AdmTexto01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoVinculo4Nome'], "IncludeConfig"); ?>:
                            </div>
                            <div class="AdmTexto01">
								<?php 
                                $arrHistoricoVinculo4 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbHistoricoVinculo4'], $GLOBALS['configIdTbTipoHistoricoVinculo4'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoHistoricoVinculo4'], $GLOBALS['configHistoricoVinculo4Metodo']);
                                ?>
                                <select name="id_tb_cadastro4" id="id_tb_cadastro4" class="AdmCampoDropDownMenu01" style="width: 180px;">
                                    <option value="0"<?php if($tbHistoricoIdTbCadastro4 == 0){ ?>selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNenhumDropDown"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoVinculo4); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoVinculo4[$countArray][0];?>"<?php if($arrHistoricoVinculo4[$countArray][0] == $tbHistoricoIdTbCadastro4){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoVinculo4[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        
                        <!--Encadernação.-->
                    	<div class="DivCantoArredondado02" style="position: absolute; display: block; top: 55px; left: 5px; width: 540px; height: 460px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div class="DivAbaInfo02" style="">
                                Encardena&ccedil;&atilde;o
                            </div>
                            
                            <div style="position: absolute; display: block; top: 3px; left: 12px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico30Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico30Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "41", "", ",", "", "1"));
                                    ?>
                                
                                    <?php 
                                    $arrHistoricoFiltroGenerico30 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 41);
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico30CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico30); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico30[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico30[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico30[$countArray][0], $arrHistoricoFiltroGenerico30Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico30[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico30CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico30" name="idsHistoricoFiltroGenerico30[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico30); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico30[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico30[$countArray][0], $arrHistoricoFiltroGenerico30Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico30[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <br />
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico30CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico30" name="idsHistoricoFiltroGenerico30[]" class="AdmCampoDropDownMenu01" style="width: 130px;">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico30); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico30[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico30[$countArray][0], $arrHistoricoFiltroGenerico30Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico30[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
									<?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico30))
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
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=41&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=41&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $idTbHistorico;?>&configCaixaSelecao=<?php echo $GLOBALS['configHistoricoFiltroGenerico30CaixaSelecao'];?>&configCaixaSelecao=<?php echo $GLOBALS['configHistoricoFiltroGenerico30CaixaSelecao'];?>', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=41&tipoRetorno=3&idItem=<?php echo $idTbHistorico;?>\', \'idsHistoricoFiltroGenerico30\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico30CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                            
                            <div style="position: absolute; display: block; top: 3px; left: 182px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico31Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico31Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "42", "", ",", "", "1"));
                                    ?>
                                
                                    <?php 
                                    $arrHistoricoFiltroGenerico31 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 42);
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico31CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico31); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico31[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico31[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico31[$countArray][0], $arrHistoricoFiltroGenerico31Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico31[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico31CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico31" name="idsHistoricoFiltroGenerico31[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01" style="width: 130px;">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico31); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico31[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico31[$countArray][0], $arrHistoricoFiltroGenerico31Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico31[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico31CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico31" name="idsHistoricoFiltroGenerico31[]" class="AdmCampoDropDownMenu01">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico31); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico31[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico31[$countArray][0], $arrHistoricoFiltroGenerico31Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico31[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico31))
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
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=42&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=42&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $idTbHistorico;?>&configCaixaSelecao=<?php echo $GLOBALS['configHistoricoFiltroGenerico31CaixaSelecao'];?>', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=42&tipoRetorno=3&idItem=<?php echo $idTbHistorico;?>\', \'idsHistoricoFiltroGenerico31\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico31CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                            
                            <!--Encadernação.-->
                            <div class="DivCantoArredondado02" style="position: absolute; display: block; top: 64px; left: 7px; width: 523px; height: 55px; border: 1px solid #808080;">
                                <!--sub títulos.-->
                                <div class="DivAbaInfo03" style="">
                                    Revestimento
                                </div>
                                
                                <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                    <div align="left" class="AdmTexto01">
                                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico32Nome'], "IncludeConfig"); ?>: 
                                    </div>
                                    <div class="AdmTexto01">
                                        <?php
                                        //Seleção de ids selecionados para o registro.
                                        $arrHistoricoFiltroGenerico32Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "43", "", ",", "", "1"));
                                        ?>
                                    
                                        <?php 
                                        $arrHistoricoFiltroGenerico32 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 43);
                                        //echo "arrHistoricoFiltroGenerico32Selecao=" . $arrHistoricoFiltroGenerico32Selecao . "<br />";
                                        //echo "arrHistoricoFiltroGenerico32Selecao[0]=" . $arrHistoricoFiltroGenerico32Selecao[0] . "<br />";
                                        //echo "FiltrosGenericosSelect03=" . DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "13", "", ",", "", "1")  . "<br />";
                                        //echo "tbHistoricoId=" . $tbHistoricoId . "<br />";
                                        ?>
                                        
                                        <?php if($GLOBALS['configHistoricoFiltroGenerico32CaixaSelecao'] == 1){ ?>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico32); $countArray++)
                                            {
                                            ?>
                                                <div>
                                                    <input name="idsHistoricoFiltroGenerico32[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico32[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico32[$countArray][0], $arrHistoricoFiltroGenerico32Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico32[$countArray][1];?>
                                                </div>
                                            <?php 
                                            }
                                            ?>
                                        <?php } ?>
                                        <?php if($GLOBALS['configHistoricoFiltroGenerico32CaixaSelecao'] == 2){ ?>
                                            <select id="idsHistoricoFiltroGenerico32" name="idsHistoricoFiltroGenerico32[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01" style="width: 130px;">
                                                <?php 
                                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico32); $countArray++)
                                                {
                                                ?>
                                                    <option value="<?php echo $arrHistoricoFiltroGenerico32[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico32[$countArray][0], $arrHistoricoFiltroGenerico32Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico32[$countArray][1];?></option>
                                                <?php 
                                                }
                                                ?>
                                            </select> 
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                        <?php } ?>
                                        <?php if($GLOBALS['configHistoricoFiltroGenerico32CaixaSelecao'] == 3){ ?>
                                            <select id="idsHistoricoFiltroGenerico32" name="idsHistoricoFiltroGenerico32[]" class="AdmCampoDropDownMenu01">
                                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                                <?php 
                                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico32); $countArray++)
                                                {
                                                ?>
                                                    <option value="<?php echo $arrHistoricoFiltroGenerico32[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico32[$countArray][0], $arrHistoricoFiltroGenerico32Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico32[$countArray][1];?></option>
                                                <?php 
                                                }
                                                ?>
                                            </select>

                                        <?php } ?>
                                        
                                        <?php 
                                        $flagManutencaoLink = $configManutencaoLinkFlag;
                                        if($configManutencaoLinkFlag != true)
                                        {
                                            if(empty($arrHistoricoFiltroGenerico32))
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
                                                <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=43&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                                </a>
                                            <?php } ?>
                                            <?php if($configManutencaoLink == 3){ ?>
                                                <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=43&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $idTbHistorico;?>&configCaixaSelecao=<?php echo $GLOBALS['configHistoricoFiltroGenerico32CaixaSelecao'];?>', '', '', '');
                                                            divShow('divManutencaoAjax');
                                                            HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=43&tipoRetorno=3&idItem=<?php echo $idTbHistorico;?>\', \'idsHistoricoFiltroGenerico32\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico32CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                    <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                                
                                <div style="position: absolute; display: block; top: 0px; left: 174px;">
                                    <div align="left" class="AdmTexto01">
                                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc31'], "IncludeConfig"); ?>:
                                    </div>
                                    <div>
                                        <?php if($GLOBALS['configHistoricoBoxIc31'] == 1){ ?>
                                            <input type="text" name="informacao_complementar31" id="informacao_complementar31" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC31;?>" style="width: 90px;" />
                                        <?php } ?>
                                        <?php if($GLOBALS['configHistoricoBoxIc31'] == 2){ ?>
                                            <?php //Sem formatação.?>
                                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                                <textarea name="informacao_complementar31" id="informacao_complementar31" class="AdmCampoTextoMultilinha01"><?php echo $tbHistoricoIC31;?></textarea>
                                            <?php } ?>
                                            
                                            <?php //Formatação básica (CLEditor).?>
                                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                                
                                                <script type="text/javascript">
                                                    //Caixa básica.
                                                    $(document).ready(function () {
                                                        $("#informacao_complementar31").cleditor(
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
                                                <textarea name="informacao_complementar31" id="informacao_complementar31"><?php echo $tbHistoricoIC31;?></textarea>
                                            <?php } ?>
                                            
                                            <?php //Formatação avançada (CLEditor).?>
                                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                                <script type="text/javascript">
                                                    $(document).ready(function () {
                                                        $("#informacao_complementar31").cleditor(
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
                                                <textarea name="informacao_complementar31" id="informacao_complementar31"><?php echo $tbHistoricoIC31;?></textarea>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                                
                                <div style="position: absolute; display: block; top: 0px; left: 269px;">
                                    <div align="left" class="AdmTexto01">
                                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc32'], "IncludeConfig"); ?>:
                                    </div>
                                    <div>
                                        <?php if($GLOBALS['configHistoricoBoxIc32'] == 1){ ?>
                                            <input type="text" name="informacao_complementar32" id="informacao_complementar32" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC32;?>" />
                                        <?php } ?>
                                        <?php if($GLOBALS['configHistoricoBoxIc32'] == 2){ ?>
                                            <?php //Sem formatação.?>
                                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                                <textarea name="informacao_complementar32" id="informacao_complementar32" class="AdmCampoTextoMultilinha01"><?php echo $tbHistoricoIC32;?></textarea>
                                            <?php } ?>
                                            
                                            <?php //Formatação básica (CLEditor).?>
                                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                                
                                                <script type="text/javascript">
                                                    //Caixa básica.
                                                    $(document).ready(function () {
                                                        $("#informacao_complementar32").cleditor(
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
                                                <textarea name="informacao_complementar32" id="informacao_complementar32"><?php echo $tbHistoricoIC32;?></textarea>
                                            <?php } ?>
                                            
                                            <?php //Formatação avançada (CLEditor).?>
                                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                                <script type="text/javascript">
                                                    $(document).ready(function () {
                                                        $("#informacao_complementar32").cleditor(
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
                                                <textarea name="informacao_complementar32" id="informacao_complementar32"><?php echo $tbHistoricoIC32;?></textarea>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                                
                                <div style="position: absolute; display: block; top: 0px; left: 394px;">
                                    <div align="left" class="AdmTexto01">
                                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc33'], "IncludeConfig"); ?>:
                                    </div>
                                    <div>
                                        <?php if($GLOBALS['configHistoricoBoxIc33'] == 1){ ?>
                                            <input type="text" name="informacao_complementar33" id="informacao_complementar33" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC33;?>" />
                                        <?php } ?>
                                        <?php if($GLOBALS['configHistoricoBoxIc33'] == 2){ ?>
                                            <?php //Sem formatação.?>
                                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                                <textarea name="informacao_complementar33" id="informacao_complementar33" class="AdmCampoTextoMultilinha01"><?php echo $tbHistoricoIC33;?></textarea>
                                            <?php } ?>
                                            
                                            <?php //Formatação básica (CLEditor).?>
                                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                                
                                                <script type="text/javascript">
                                                    //Caixa básica.
                                                    $(document).ready(function () {
                                                        $("#informacao_complementar33").cleditor(
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
                                                <textarea name="informacao_complementar33" id="informacao_complementar33"><?php echo $tbHistoricoIC33;?></textarea>
                                            <?php } ?>
                                            
                                            <?php //Formatação avançada (CLEditor).?>
                                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                                <script type="text/javascript">
                                                    $(document).ready(function () {
                                                        $("#informacao_complementar33").cleditor(
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
                                                <textarea name="informacao_complementar33" id="informacao_complementar33"><?php echo $tbHistoricoIC33;?></textarea>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            
                            <!--Lombada.-->
                            <div class="DivCantoArredondado02" style="position: absolute; display: block; top: 139px; left: 7px; width: 523px; height: 105px; border: 1px solid #808080;">
                                <!--sub títulos.-->
                                <div class="DivAbaInfo03" style="">
                                    Lombada
                                </div>
                                
                                <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                    <div align="left" class="AdmTexto01">
                                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico33Nome'], "IncludeConfig"); ?>: 
                                    </div>
                                    <div class="AdmTexto01">
                                        <?php
                                        //Seleção de ids selecionados para o registro.
                                        $arrHistoricoFiltroGenerico33Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "44", "", ",", "", "1"));
                                        ?>
                
                                        <?php 
                                        $arrHistoricoFiltroGenerico33 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 44);
                                        ?>
                                        
                                        <?php if($GLOBALS['configHistoricoFiltroGenerico33CaixaSelecao'] == 1){ ?>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico33); $countArray++)
                                            {
                                            ?>
                                                <div>
                                                    <input name="idsHistoricoFiltroGenerico33[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico33[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico33[$countArray][0], $arrHistoricoFiltroGenerico33Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico33[$countArray][1];?>
                                                </div>
                                            <?php 
                                            }
                                            ?>
                                        <?php } ?>
                                        <?php if($GLOBALS['configHistoricoFiltroGenerico33CaixaSelecao'] == 2){ ?>
                                            <select id="idsHistoricoFiltroGenerico33" name="idsHistoricoFiltroGenerico33[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01" style="width: 130px;">
                                                <?php 
                                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico33); $countArray++)
                                                {
                                                ?>
                                                    <option value="<?php echo $arrHistoricoFiltroGenerico33[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico33[$countArray][0], $arrHistoricoFiltroGenerico33Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico33[$countArray][1];?></option>
                                                <?php 
                                                }
                                                ?>
                                            </select> 
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                        <?php } ?>
                                        <?php if($GLOBALS['configHistoricoFiltroGenerico33CaixaSelecao'] == 3){ ?>
                                            <select id="idsHistoricoFiltroGenerico33" name="idsHistoricoFiltroGenerico33[]" class="AdmCampoDropDownMenu01">
                                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                                <?php 
                                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico33); $countArray++)
                                                {
                                                ?>
                                                    <option value="<?php echo $arrHistoricoFiltroGenerico33[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico33[$countArray][0], $arrHistoricoFiltroGenerico33Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico33[$countArray][1];?></option>
                                                <?php 
                                                }
                                                ?>
                                            </select>
                                        <?php } ?>
                                        
                                        <?php 
                                        $flagManutencaoLink = $configManutencaoLinkFlag;
                                        if($configManutencaoLinkFlag != true)
                                        {
                                            if(empty($arrHistoricoFiltroGenerico33))
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
                                                <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=44&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                                </a>
                                            <?php } ?>
                                            <?php if($configManutencaoLink == 3){ ?>
                                                <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=44&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $idTbHistorico;?>&configCaixaSelecao=<?php echo $GLOBALS['configHistoricoFiltroGenerico33CaixaSelecao'];?>', '', '', '');
                                                            divShow('divManutencaoAjax');
                                                            HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=44&tipoRetorno=3&idItem=<?php echo $idTbHistorico;?>\', \'idsHistoricoFiltroGenerico33\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico33CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                    <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                                
                                <div style="position: absolute; display: block; top: 0px; left: 174px;">
                                    <div align="left" class="AdmTexto01">
                                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc34'], "IncludeConfig"); ?>:
                                    </div>
                                    <div>
                                        <?php if($GLOBALS['configHistoricoBoxIc34'] == 1){ ?>
                                            <input type="text" name="informacao_complementar34" id="informacao_complementar34" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC34;?>" style="width: 90px;" />
                                        <?php } ?>
                                        <?php if($GLOBALS['configHistoricoBoxIc34'] == 2){ ?>
                                            <?php //Sem formatação.?>
                                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                                <textarea name="informacao_complementar34" id="informacao_complementar34" class="AdmCampoTextoMultilinha01"><?php echo $tbHistoricoIC34;?></textarea>
                                            <?php } ?>
                                            
                                            <?php //Formatação básica (CLEditor).?>
                                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                                
                                                <script type="text/javascript">
                                                    //Caixa básica.
                                                    $(document).ready(function () {
                                                        $("#informacao_complementar34").cleditor(
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
                                                <textarea name="informacao_complementar34" id="informacao_complementar34"><?php echo $tbHistoricoIC34;?></textarea>
                                            <?php } ?>
                                            
                                            <?php //Formatação avançada (CLEditor).?>
                                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                                <script type="text/javascript">
                                                    $(document).ready(function () {
                                                        $("#informacao_complementar34").cleditor(
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
                                                <textarea name="informacao_complementar34" id="informacao_complementar34"><?php echo $tbHistoricoIC34;?></textarea>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                                
                                <div style="position: absolute; display: block; top: 0px; left: 343px;">
                                    <div align="left" class="AdmTexto01">
                                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico34Nome'], "IncludeConfig"); ?>: 
                                    </div>
                                    <div class="AdmTexto01">
                                        <?php
                                        //Seleção de ids selecionados para o registro.
                                        $arrHistoricoFiltroGenerico34Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "45", "", ",", "", "1"));
                                        ?>
                                    
                                        <?php 
                                        $arrHistoricoFiltroGenerico34 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 45);
                                        ?>
                                        
                                        <?php if($GLOBALS['configHistoricoFiltroGenerico34CaixaSelecao'] == 1){ ?>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico34); $countArray++)
                                            {
                                            ?>
                                                <div>
                                                    <input name="idsHistoricoFiltroGenerico34[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico34[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico34[$countArray][0], $arrHistoricoFiltroGenerico34Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico34[$countArray][1];?>
                                                </div>
                                            <?php 
                                            }
                                            ?>
                                        <?php } ?>
                                        <?php if($GLOBALS['configHistoricoFiltroGenerico34CaixaSelecao'] == 2){ ?>
                                            <select id="idsHistoricoFiltroGenerico34" name="idsHistoricoFiltroGenerico34[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01" style="width: 130px;">
                                                <?php 
                                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico34); $countArray++)
                                                {
                                                ?>
                                                    <option value="<?php echo $arrHistoricoFiltroGenerico34[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico34[$countArray][0], $arrHistoricoFiltroGenerico34Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico34[$countArray][1];?></option>
                                                <?php 
                                                }
                                                ?>
                                            </select> 
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                        <?php } ?>
                                        <?php if($GLOBALS['configHistoricoFiltroGenerico34CaixaSelecao'] == 3){ ?>
                                            <select id="idsHistoricoFiltroGenerico34" name="idsHistoricoFiltroGenerico34[]" class="AdmCampoDropDownMenu01">
                                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                                <?php 
                                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico34); $countArray++)
                                                {
                                                ?>
                                                    <option value="<?php echo $arrHistoricoFiltroGenerico34[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico34[$countArray][0], $arrHistoricoFiltroGenerico34Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico34[$countArray][1];?></option>
                                                <?php 
                                                }
                                                ?>
                                            </select>
                                        <?php } ?>
                                        
                                        <?php 
                                        $flagManutencaoLink = $configManutencaoLinkFlag;
                                        if($configManutencaoLinkFlag != true)
                                        {
                                            if(empty($arrHistoricoFiltroGenerico34))
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
                                                <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=45&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                                </a>
                                            <?php } ?>
                                            <?php if($configManutencaoLink == 3){ ?>
                                                <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=45&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $idTbHistorico;?>&configCaixaSelecao=<?php echo $GLOBALS['configHistoricoFiltroGenerico34CaixaSelecao'];?>', '', '', '');
                                                            divShow('divManutencaoAjax');
                                                            HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=45&tipoRetorno=3&idItem=<?php echo $idTbHistorico;?>\', \'idsHistoricoFiltroGenerico34\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico34CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                    <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                                
                                
                                <div style="position: absolute; display: block; top: 50px; left: 5px;">
                                    <div align="left" class="AdmTexto01">
                                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico35Nome'], "IncludeConfig"); ?>: 
                                    </div>
                                    <div class="AdmTexto01">
                                        <?php
                                        //Seleção de ids selecionados para o registro.
                                        $arrHistoricoFiltroGenerico35Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "46", "", ",", "", "1"));
                                        ?>
                                    
                                        <?php 
                                        $arrHistoricoFiltroGenerico35 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 46);
                                        ?>
                                        
                                        <?php if($GLOBALS['configHistoricoFiltroGenerico35CaixaSelecao'] == 1){ ?>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico35); $countArray++)
                                            {
                                            ?>
                                                <div>
                                                    <input name="idsHistoricoFiltroGenerico35[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico35[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico35[$countArray][0], $arrHistoricoFiltroGenerico35Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico35[$countArray][1];?>
                                                </div>
                                            <?php 
                                            }
                                            ?>
                                        <?php } ?>
                                        <?php if($GLOBALS['configHistoricoFiltroGenerico35CaixaSelecao'] == 2){ ?>
                                            <select id="idsHistoricoFiltroGenerico35" name="idsHistoricoFiltroGenerico35[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01" style="width: 130px;">
                                                <?php 
                                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico35); $countArray++)
                                                {
                                                ?>
                                                    <option value="<?php echo $arrHistoricoFiltroGenerico35[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico35[$countArray][0], $arrHistoricoFiltroGenerico35Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico35[$countArray][1];?></option>
                                                <?php 
                                                }
                                                ?>
                                            </select> 
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                        <?php } ?>
                                        <?php if($GLOBALS['configHistoricoFiltroGenerico35CaixaSelecao'] == 3){ ?>
                                            <select id="idsHistoricoFiltroGenerico35" name="idsHistoricoFiltroGenerico35[]" class="AdmCampoDropDownMenu01">
                                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                                <?php 
                                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico35); $countArray++)
                                                {
                                                ?>
                                                    <option value="<?php echo $arrHistoricoFiltroGenerico35[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico35[$countArray][0], $arrHistoricoFiltroGenerico35Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico35[$countArray][1];?></option>
                                                <?php 
                                                }
                                                ?>
                                            </select>
                                        <?php } ?>
                                        
                                        <?php 
                                        $flagManutencaoLink = $configManutencaoLinkFlag;
                                        if($configManutencaoLinkFlag != true)
                                        {
                                            if(empty($arrHistoricoFiltroGenerico35))
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
                                                <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=46&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                                </a>
                                            <?php } ?>
                                            <?php if($configManutencaoLink == 3){ ?>
                                                <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=46&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $idTbHistorico;?>&configCaixaSelecao=<?php echo $GLOBALS['configHistoricoFiltroGenerico35CaixaSelecao'];?>', '', '', '');
                                                            divShow('divManutencaoAjax');
                                                            HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=46&tipoRetorno=3&idItem=<?php echo $idTbHistorico;?>\', \'idsHistoricoFiltroGenerico35\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico35CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                    <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                                    <img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                                </a>
                                            <?php } ?>                                
                                        <?php } ?>                                
                                    </div>
                                </div>
                                
                                <div style="position: absolute; display: block; top: 50px; left: 174px;">
                                    <div align="left" class="AdmTexto01">
                                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico36Nome'], "IncludeConfig"); ?>: 
                                    </div>
                                    <div class="AdmTexto01">
                                        <?php
                                        //Seleção de ids selecionados para o registro.
                                        $arrHistoricoFiltroGenerico36Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "47", "", ",", "", "1"));
                                        ?>
                
                                        <?php 
                                        $arrHistoricoFiltroGenerico36 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 47);
                                        ?>
                                        
                                        <?php if($GLOBALS['configHistoricoFiltroGenerico36CaixaSelecao'] == 1){ ?>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico36); $countArray++)
                                            {
                                            ?>
                                                <div>
                                                    <input name="idsHistoricoFiltroGenerico36[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico36[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico36[$countArray][0], $arrHistoricoFiltroGenerico36Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico36[$countArray][1];?>
                                                </div>
                                            <?php 
                                            }
                                            ?>
                                        <?php } ?>
                                        <?php if($GLOBALS['configHistoricoFiltroGenerico36CaixaSelecao'] == 2){ ?>
                                            <select id="idsHistoricoFiltroGenerico36" name="idsHistoricoFiltroGenerico36[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01" style="width: 130px;">
                                                <?php 
                                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico36); $countArray++)
                                                {
                                                ?>
                                                    <option value="<?php echo $arrHistoricoFiltroGenerico36[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico36[$countArray][0], $arrHistoricoFiltroGenerico36Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico36[$countArray][1];?></option>
                                                <?php 
                                                }
                                                ?>
                                            </select> 
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                        <?php } ?>
                                        <?php if($GLOBALS['configHistoricoFiltroGenerico36CaixaSelecao'] == 3){ ?>
                                            <select id="idsHistoricoFiltroGenerico36" name="idsHistoricoFiltroGenerico36[]" class="AdmCampoDropDownMenu01">
                                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                                <?php 
                                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico36); $countArray++)
                                                {
                                                ?>
                                                    <option value="<?php echo $arrHistoricoFiltroGenerico36[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico36[$countArray][0], $arrHistoricoFiltroGenerico36Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico36[$countArray][1];?></option>
                                                <?php 
                                                }
                                                ?>
                                            </select>
                                        <?php } ?>
                                        
                                        <?php 
                                        $flagManutencaoLink = $configManutencaoLinkFlag;
                                        if($configManutencaoLinkFlag != true)
                                        {
                                            if(empty($arrHistoricoFiltroGenerico36))
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
                                                <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=47&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                                </a>
                                            <?php } ?>
                                            <?php if($configManutencaoLink == 3){ ?>
                                                <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=47&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $idTbHistorico;?>&configCaixaSelecao=<?php echo $GLOBALS['configHistoricoFiltroGenerico36CaixaSelecao'];?>', '', '', '');
                                                            divShow('divManutencaoAjax');
                                                            HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=47&tipoRetorno=3&idItem=<?php echo $idTbHistorico;?>\', \'idsHistoricoFiltroGenerico36\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico36CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                    <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                                
                                <div style="position: absolute; display: block; top: 50px; left: 343px;">
                                    <div align="left" class="AdmTexto01">
                                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico37Nome'], "IncludeConfig"); ?>: 
                                    </div>
                                    <div class="AdmTexto01">
                                        <?php
                                        //Seleção de ids selecionados para o registro.
                                        $arrHistoricoFiltroGenerico37Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "48", "", ",", "", "1"));
                                        ?>
                                    
                                        <?php 
                                        $arrHistoricoFiltroGenerico37 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 48);
                                        ?>
                                        
                                        <?php if($GLOBALS['configHistoricoFiltroGenerico37CaixaSelecao'] == 1){ ?>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico37); $countArray++)
                                            {
                                            ?>
                                                <div>
                                                    <input name="idsHistoricoFiltroGenerico37[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico37[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico37[$countArray][0], $arrHistoricoFiltroGenerico37Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico37[$countArray][1];?>
                                                </div>
                                            <?php 
                                            }
                                            ?>
                                        <?php } ?>
                                        <?php if($GLOBALS['configHistoricoFiltroGenerico37CaixaSelecao'] == 2){ ?>
                                            <select id="idsHistoricoFiltroGenerico37" name="idsHistoricoFiltroGenerico37[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01" style="width: 130px;">
                                                <?php 
                                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico37); $countArray++)
                                                {
                                                ?>
                                                    <option value="<?php echo $arrHistoricoFiltroGenerico37[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico37[$countArray][0], $arrHistoricoFiltroGenerico37Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico37[$countArray][1];?></option>
                                                <?php 
                                                }
                                                ?>
                                            </select> 
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                        <?php } ?>
                                        <?php if($GLOBALS['configHistoricoFiltroGenerico37CaixaSelecao'] == 3){ ?>
                                            <select id="idsHistoricoFiltroGenerico37" name="idsHistoricoFiltroGenerico37[]" class="AdmCampoDropDownMenu01">
                                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                                <?php 
                                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico37); $countArray++)
                                                {
                                                ?>
                                                    <option value="<?php echo $arrHistoricoFiltroGenerico37[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico37[$countArray][0], $arrHistoricoFiltroGenerico37Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico37[$countArray][1];?></option>
                                                <?php 
                                                }
                                                ?>
                                            </select>
                                        <?php } ?>
                                        
                                        <?php 
                                        $flagManutencaoLink = $configManutencaoLinkFlag;
                                        if($configManutencaoLinkFlag != true)
                                        {
                                            if(empty($arrHistoricoFiltroGenerico37))
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
                                                <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=48&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                                </a>
                                            <?php } ?>
                                            <?php if($configManutencaoLink == 3){ ?>
                                                <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=48&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $idTbHistorico;?>&configCaixaSelecao=<?php echo $GLOBALS['configHistoricoFiltroGenerico37CaixaSelecao'];?>', '', '', '');
                                                            divShow('divManutencaoAjax');
                                                            HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=48&tipoRetorno=3&idItem=<?php echo $idTbHistorico;?>\', \'idsHistoricoFiltroGenerico37\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico37CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                    <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                            </div>
                            
                            
                            <div style="position: absolute; display: block; top: 250px; left: 13px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico38Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico38Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "49", "", ",", "", "1"));
                                    ?>
            
                                    <?php 
                                    $arrHistoricoFiltroGenerico38 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 49);
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico38CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico38); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico38[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico38[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico38[$countArray][0], $arrHistoricoFiltroGenerico38Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico38[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico38CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico38" name="idsHistoricoFiltroGenerico38[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico38); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico38[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico38[$countArray][0], $arrHistoricoFiltroGenerico38Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico38[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico38CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico38" name="idsHistoricoFiltroGenerico38[]" class="AdmCampoDropDownMenu01" style="width: 130px;">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico38); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico38[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico38[$countArray][0], $arrHistoricoFiltroGenerico38Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico38[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico38))
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
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=49&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=49&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $idTbHistorico;?>&configCaixaSelecao=<?php echo $GLOBALS['configHistoricoFiltroGenerico38CaixaSelecao'];?>', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=49&tipoRetorno=3&idItem=<?php echo $idTbHistorico;?>\', \'idsHistoricoFiltroGenerico38\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico38CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                            
                            <div style="position: absolute; display: block; top: 250px; left: 180px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico39Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico39Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "50", "", ",", "", "1"));
                                    ?>
            
                                    <?php 
                                    $arrHistoricoFiltroGenerico39 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 50);
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico39CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico39); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico39[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico39[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico39[$countArray][0], $arrHistoricoFiltroGenerico39Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico39[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico39CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico39" name="idsHistoricoFiltroGenerico39[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico39); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico39[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico39[$countArray][0], $arrHistoricoFiltroGenerico39Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico39[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico39CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico39" name="idsHistoricoFiltroGenerico39[]" class="AdmCampoDropDownMenu01" style="width: 130px;">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico39); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico39[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico39[$countArray][0], $arrHistoricoFiltroGenerico39Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico39[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico39))
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
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=50&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=50&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $idTbHistorico;?>&configCaixaSelecao=<?php echo $GLOBALS['configHistoricoFiltroGenerico39CaixaSelecao'];?>', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=50&tipoRetorno=3&idItem=<?php echo $idTbHistorico;?>\', \'idsHistoricoFiltroGenerico39\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico39CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                            
                            <div style="position: absolute; display: block; top: 250px; left: 350px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico40Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico40Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "51", "", ",", "", "1"));
                                    ?>
                                
                                    <?php 
                                    $arrHistoricoFiltroGenerico40 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 51);
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico40CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico40); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico40[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico40[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico40[$countArray][0], $arrHistoricoFiltroGenerico40Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico40[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico40CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico40" name="idsHistoricoFiltroGenerico40[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico40); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico40[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico40[$countArray][0], $arrHistoricoFiltroGenerico40Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico40[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico40CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico40" name="idsHistoricoFiltroGenerico40[]" class="AdmCampoDropDownMenu01" style="width: 130px;">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico40); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico40[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico40[$countArray][0], $arrHistoricoFiltroGenerico40Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico40[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico40))
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
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=51&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=51&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $idTbHistorico;?>&configCaixaSelecao=<?php echo $GLOBALS['configHistoricoFiltroGenerico40CaixaSelecao'];?>', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=51&tipoRetorno=3&idItem=<?php echo $idTbHistorico;?>\', \'idsHistoricoFiltroGenerico40\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico40CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                            
                            
                            <!--Fechos.-->
                            <div class="DivCantoArredondado02" style="position: absolute; display: block; top: 298px; left: 7px; width: 523px; height: 40px; border: 1px solid #808080;">
                                <!--sub títulos.-->
                                <div class="DivAbaInfo03" style="">
                                    Fechos
                                </div>
                                
                                <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                    <div align="left" class="AdmTexto01">
                                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc35'], "IncludeConfig"); ?>:
                                    </div>
                                    <div>
                                        <?php if($GLOBALS['configHistoricoBoxIc35'] == 1){ ?>
                                            <input type="text" name="informacao_complementar35" id="informacao_complementar35" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC35;?>" style="width: 130px;" />
                                        <?php } ?>
                                        <?php if($GLOBALS['configHistoricoBoxIc35'] == 2){ ?>
                                            <?php //Sem formatação.?>
                                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                                <textarea name="informacao_complementar35" id="informacao_complementar35" class="AdmCampoTextoMultilinha01"><?php echo $tbHistoricoIC35;?></textarea>
                                            <?php } ?>
                                            
                                            <?php //Formatação básica (CLEditor).?>
                                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                                
                                                <script type="text/javascript">
                                                    //Caixa básica.
                                                    $(document).ready(function () {
                                                        $("#informacao_complementar35").cleditor(
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
                                                <textarea name="informacao_complementar35" id="informacao_complementar35"><?php echo $tbHistoricoIC35;?></textarea>
                                            <?php } ?>
                                            
                                            <?php //Formatação avançada (CLEditor).?>
                                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                                <script type="text/javascript">
                                                    $(document).ready(function () {
                                                        $("#informacao_complementar35").cleditor(
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
                                                <textarea name="informacao_complementar35" id="informacao_complementar35"><?php echo $tbHistoricoIC35;?></textarea>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                                
                                <div style="position: absolute; display: block; top: 0px; left: 145px;">
                                    <div align="left" class="AdmTexto01">
                                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc36'], "IncludeConfig"); ?>:
                                    </div>
                                    <div>
                                        <?php if($GLOBALS['configHistoricoBoxIc36'] == 1){ ?>
                                            <input type="text" name="informacao_complementar36" id="informacao_complementar36" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC36;?>" style="width: 130px;" />
                                        <?php } ?>
                                        <?php if($GLOBALS['configHistoricoBoxIc36'] == 2){ ?>
                                            <?php //Sem formatação.?>
                                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                                <textarea name="informacao_complementar36" id="informacao_complementar36" class="AdmCampoTextoMultilinha01"><?php echo $tbHistoricoIC36;?></textarea>
                                            <?php } ?>
                                            
                                            <?php //Formatação básica (CLEditor).?>
                                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                                
                                                <script type="text/javascript">
                                                    //Caixa básica.
                                                    $(document).ready(function () {
                                                        $("#informacao_complementar36").cleditor(
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
                                                <textarea name="informacao_complementar36" id="informacao_complementar36"><?php echo $tbHistoricoIC36;?></textarea>
                                            <?php } ?>
                                            
                                            <?php //Formatação avançada (CLEditor).?>
                                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                                <script type="text/javascript">
                                                    $(document).ready(function () {
                                                        $("#informacao_complementar36").cleditor(
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
                                                <textarea name="informacao_complementar36" id="informacao_complementar36"><?php echo $tbHistoricoIC36;?></textarea>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                                
                                <div style="position: absolute; display: block; top: 0px; left: 285px;">
                                    <div align="left" class="AdmTexto01">
                                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc37'], "IncludeConfig"); ?>:
                                    </div>
                                    <div>
                                        <?php if($GLOBALS['configHistoricoBoxIc37'] == 1){ ?>
                                            <input type="text" name="informacao_complementar37" id="informacao_complementar37" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC37;?>" style="width: 130px;" />
                                        <?php } ?>
                                        <?php if($GLOBALS['configHistoricoBoxIc37'] == 2){ ?>
                                            <?php //Sem formatação.?>
                                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                                <textarea name="informacao_complementar37" id="informacao_complementar37" class="AdmCampoTextoMultilinha01"><?php echo $tbHistoricoIC37;?></textarea>
                                            <?php } ?>
                                            
                                            <?php //Formatação básica (CLEditor).?>
                                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                                
                                                <script type="text/javascript">
                                                    //Caixa básica.
                                                    $(document).ready(function () {
                                                        $("#informacao_complementar37").cleditor(
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
                                                <textarea name="informacao_complementar37" id="informacao_complementar37"><?php echo $tbHistoricoIC37;?></textarea>
                                            <?php } ?>
                                            
                                            <?php //Formatação avançada (CLEditor).?>
                                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                                <script type="text/javascript">
                                                    $(document).ready(function () {
                                                        $("#informacao_complementar37").cleditor(
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
                                                <textarea name="informacao_complementar37" id="informacao_complementar37"><?php echo $tbHistoricoIC37;?></textarea>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                                
                                <div style="position: absolute; display: block; top: 0px; left: 424px;">
                                    <div align="left" class="AdmTexto01">
                                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc38'], "IncludeConfig"); ?>:
                                    </div>
                                    <div>
                                        <?php if($GLOBALS['configHistoricoBoxIc38'] == 1){ ?>
                                            <input type="text" name="informacao_complementar38" id="informacao_complementar38" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC38;?>" style="width: 90px;" />
                                        <?php } ?>
                                        <?php if($GLOBALS['configHistoricoBoxIc38'] == 2){ ?>
                                            <?php //Sem formatação.?>
                                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                                <textarea name="informacao_complementar38" id="informacao_complementar38" class="AdmCampoTextoMultilinha01"><?php echo $tbHistoricoIC38;?></textarea>
                                            <?php } ?>
                                            
                                            <?php //Formatação básica (CLEditor).?>
                                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                                
                                                <script type="text/javascript">
                                                    //Caixa básica.
                                                    $(document).ready(function () {
                                                        $("#informacao_complementar38").cleditor(
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
                                                <textarea name="informacao_complementar38" id="informacao_complementar38"><?php echo $tbHistoricoIC38;?></textarea>
                                            <?php } ?>
                                            
                                            <?php //Formatação avançada (CLEditor).?>
                                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                                <script type="text/javascript">
                                                    $(document).ready(function () {
                                                        $("#informacao_complementar38").cleditor(
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
                                                <textarea name="informacao_complementar38" id="informacao_complementar38"><?php echo $tbHistoricoIC38;?></textarea>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>


                            <div style="position: absolute; display: block; top: 345px; left: 12px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc39'], "IncludeConfig"); ?>:
                                </div>
                                <div>
                                    <?php if($GLOBALS['configHistoricoBoxIc39'] == 1){ ?>
                                        <input type="text" name="informacao_complementar39" id="informacao_complementar39" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC39;?>" />
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoBoxIc39'] == 2){ ?>
                                        <?php //Sem formatação.?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                            <textarea name="informacao_complementar39" id="informacao_complementar39" class="AdmCampoTextoMultilinha01" style="width: 505px; height: 90px;"><?php echo $tbHistoricoIC39;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação básica (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                            
                                            <script type="text/javascript">
                                                //Caixa básica.
                                                $(document).ready(function () {
                                                    $("#informacao_complementar39").cleditor(
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
                                            <textarea name="informacao_complementar39" id="informacao_complementar39"><?php echo $tbHistoricoIC39;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação avançada (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                            <script type="text/javascript">
                                                $(document).ready(function () {
                                                    $("#informacao_complementar39").cleditor(
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
                                            <textarea name="informacao_complementar39" id="informacao_complementar39"><?php echo $tbHistoricoIC39;?></textarea>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>

                        </div>
                        
                        
                        <!--Miolo.-->
                    	<div class="DivCantoArredondado02" style="position: absolute; display: block; top: 55px; left: 560px; width: 400px; height: 460px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div class="DivAbaInfo02" style="">
                                Miolo
                            </div>
                            
                            <div style="position: absolute; display: block; top: 3px; left: 5px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico28Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01">
									<?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico41Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "52", "", ",", "", "1"));
                                    ?>
                                
                                    <?php 
                                    $arrHistoricoFiltroGenerico41 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 52);
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico41CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico41); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico41[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico41[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico41[$countArray][0], $arrHistoricoFiltroGenerico41Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico41[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico41CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico41" name="idsHistoricoFiltroGenerico41[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico41); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico41[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico41[$countArray][0], $arrHistoricoFiltroGenerico41Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico41[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico41CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico41" name="idsHistoricoFiltroGenerico41[]" class="AdmCampoDropDownMenu01" style="width: 130px;">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico41); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico41[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico41[$countArray][0], $arrHistoricoFiltroGenerico41Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico41[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico41))
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
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=52&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=52&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $idTbHistorico;?>&configCaixaSelecao=<?php echo $GLOBALS['configHistoricoFiltroGenerico41CaixaSelecao'];?>', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=52&tipoRetorno=3&idItem=<?php echo $idTbHistorico;?>\', \'idsHistoricoFiltroGenerico41\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico41CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                            
                            <div style="position: absolute; display: block; top: 3px; left: 174px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc40'], "IncludeConfig"); ?>:
                                </div>
                                <div>
                                    <?php if($GLOBALS['configHistoricoBoxIc40'] == 1){ ?>
                                        <input type="text" name="informacao_complementar40" id="informacao_complementar40" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC40;?>" />
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoBoxIc40'] == 2){ ?>
                                        <?php //Sem formatação.?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                            <textarea name="informacao_complementar40" id="informacao_complementar40" class="AdmCampoTextoMultilinha01"><?php echo $tbHistoricoIC40;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação básica (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                            
                                            <script type="text/javascript">
                                                //Caixa básica.
                                                $(document).ready(function () {
                                                    $("#informacao_complementar40").cleditor(
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
                                            <textarea name="informacao_complementar40" id="informacao_complementar40"><?php echo $tbHistoricoIC40;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação avançada (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                            <script type="text/javascript">
                                                $(document).ready(function () {
                                                    $("#informacao_complementar40").cleditor(
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
                                            <textarea name="informacao_complementar40" id="informacao_complementar40"><?php echo $tbHistoricoIC40;?></textarea>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                            <div style="position: absolute; display: block; top: 35px; left: 174px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc41'], "IncludeConfig"); ?>:
                                </div>
                                <div>
                                    <?php if($GLOBALS['configHistoricoBoxIc41'] == 1){ ?>
                                        <input type="text" name="informacao_complementar41" id="informacao_complementar41" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC41;?>" />
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoBoxIc41'] == 2){ ?>
                                        <?php //Sem formatação.?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                            <textarea name="informacao_complementar41" id="informacao_complementar41" class="AdmCampoTextoMultilinha01"><?php echo $tbHistoricoIC41;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação básica (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                            
                                            <script type="text/javascript">
                                                //Caixa básica.
                                                $(document).ready(function () {
                                                    $("#informacao_complementar41").cleditor(
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
                                            <textarea name="informacao_complementar41" id="informacao_complementar41"><?php echo $tbHistoricoIC41;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação avançada (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                            <script type="text/javascript">
                                                $(document).ready(function () {
                                                    $("#informacao_complementar41").cleditor(
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
                                            <textarea name="informacao_complementar41" id="informacao_complementar41"><?php echo $tbHistoricoIC41;?></textarea>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                            <div style="position: absolute; display: block; top: 67px; left: 174px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc42'], "IncludeConfig"); ?>:
                                </div>
                                <div>
                                    <?php if($GLOBALS['configHistoricoBoxIc42'] == 1){ ?>
                                        <input type="text" name="informacao_complementar42" id="informacao_complementar42" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC42;?>" />
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoBoxIc42'] == 2){ ?>
                                        <?php //Sem formatação.?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                            <textarea name="informacao_complementar42" id="informacao_complementar42" class="AdmCampoTextoMultilinha01"><?php echo $tbHistoricoIC42;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação básica (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                            
                                            <script type="text/javascript">
                                                //Caixa básica.
                                                $(document).ready(function () {
                                                    $("#informacao_complementar42").cleditor(
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
                                            <textarea name="informacao_complementar42" id="informacao_complementar42"><?php echo $tbHistoricoIC42;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação avançada (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                            <script type="text/javascript">
                                                $(document).ready(function () {
                                                    $("#informacao_complementar42").cleditor(
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
                                            <textarea name="informacao_complementar42" id="informacao_complementar42"><?php echo $tbHistoricoIC42;?></textarea>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                            
                            <div style="position: absolute; display: block; top: 100px; left: 5px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico42Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico42Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "53", "", ",", "", "1"));
                                    ?>
                                
                                    <?php 
                                    $arrHistoricoFiltroGenerico42 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 53);
                                    //echo "arrHistoricoFiltroGenerico42Selecao=" . $arrHistoricoFiltroGenerico42Selecao . "<br />";
                                    //echo "arrHistoricoFiltroGenerico42Selecao[0]=" . $arrHistoricoFiltroGenerico42Selecao[0] . "<br />";
                                    //echo "FiltrosGenericosSelect03=" . DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "13", "", ",", "", "1")  . "<br />";
                                    //echo "tbHistoricoId=" . $tbHistoricoId . "<br />";
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico42CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico42); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico42[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico42[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico42[$countArray][0], $arrHistoricoFiltroGenerico42Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico42[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico42CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico42" name="idsHistoricoFiltroGenerico42[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico42); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico42[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico42[$countArray][0], $arrHistoricoFiltroGenerico42Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico42[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico42CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico42" name="idsHistoricoFiltroGenerico42[]" class="AdmCampoDropDownMenu01" style="width: 130px;">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico42); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico42[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico42[$countArray][0], $arrHistoricoFiltroGenerico42Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico42[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico42))
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
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=53&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=53&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $idTbHistorico;?>&configCaixaSelecao=<?php echo $GLOBALS['configHistoricoFiltroGenerico42CaixaSelecao'];?>', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=53&tipoRetorno=3&idItem=<?php echo $idTbHistorico;?>\', \'idsHistoricoFiltroGenerico42\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico42CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                            <div style="position: absolute; display: block; top: 133px; left: 5px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico43Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico43Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "54", "", ",", "", "1"));
                                    ?>
            
                                    <?php 
                                    $arrHistoricoFiltroGenerico43 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 54);
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico43CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico43); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico43[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico43[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico43[$countArray][0], $arrHistoricoFiltroGenerico43Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico43[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico43CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico43" name="idsHistoricoFiltroGenerico43[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico43); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico43[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico43[$countArray][0], $arrHistoricoFiltroGenerico43Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico43[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico43CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico43" name="idsHistoricoFiltroGenerico43[]" class="AdmCampoDropDownMenu01" style="width: 130px;">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico43); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico43[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico43[$countArray][0], $arrHistoricoFiltroGenerico43Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico43[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico43))
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
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=54&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=54&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $idTbHistorico;?>&configCaixaSelecao=<?php echo $GLOBALS['configHistoricoFiltroGenerico43CaixaSelecao'];?>', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=54&tipoRetorno=3&idItem=<?php echo $idTbHistorico;?>\', \'idsHistoricoFiltroGenerico43\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico43CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                            
                            <div style="position: absolute; display: block; top: 167px; left: 5px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc43'], "IncludeConfig"); ?>:
                                </div>
                                <div>
                                    <?php if($GLOBALS['configHistoricoBoxIc43'] == 1){ ?>
                                        <input type="text" name="informacao_complementar43" id="informacao_complementar43" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC43;?>" />
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoBoxIc43'] == 2){ ?>
                                        <?php //Sem formatação.?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                            <textarea name="informacao_complementar43" id="informacao_complementar43" class="AdmCampoTextoMultilinha01" style="width: 385px; height: 268px;"><?php echo $tbHistoricoIC43;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação básica (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                            
                                            <script type="text/javascript">
                                                //Caixa básica.
                                                $(document).ready(function () {
                                                    $("#informacao_complementar43").cleditor(
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
                                            <textarea name="informacao_complementar43" id="informacao_complementar43"><?php echo $tbHistoricoIC43;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação avançada (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                            <script type="text/javascript">
                                                $(document).ready(function () {
                                                    $("#informacao_complementar43").cleditor(
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
                                            <textarea name="informacao_complementar43" id="informacao_complementar43"><?php echo $tbHistoricoIC43;?></textarea>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <!--Miolo.-->
                    </div>
