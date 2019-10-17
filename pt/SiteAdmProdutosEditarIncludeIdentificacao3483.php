                <div style="position: absolute; display: block; top: 4px; left: 5px;">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc1'], "IncludeConfig"); ?>:
                    </div>
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc1'] == 1){ ?>
                            <input type="text" name="informacao_complementar1" id="informacao_complementar1" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbProdutosIC1;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosBoxIc1'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar1" id="informacao_complementar1" class="AdmCampoTextoMultilinha01"><?php echo $tbProdutosIC1;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar1").cleditor(
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
                                <textarea name="informacao_complementar1" id="informacao_complementar1"><?php echo $tbProdutosIC1;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar1").cleditor(
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
                                <textarea name="informacao_complementar1" id="informacao_complementar1"><?php echo $tbProdutosIC1;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
                <div style="position: absolute; display: block; top: 4px; left: 180px;">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosCodigo"); ?>:
                    </div>
                    <div align="left">
                        <input type="text" name="cod_produto" id="cod_produto" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbProdutosCodProduto; ?>" style="width: 90px;" />
                    </div>
                </div>
                <div style="position: absolute; display: block; top: 4px; left: 280px;">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico10Nome'], "IncludeConfig"); ?>: 
                    </div>
                    <div class="AdmTexto01">
                        <?php
						//Seleção de ids selecionados para o registro.
						$arrProdutosFiltroGenerico10Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbProdutosId, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", "21", "", ",", "", "1"));
						?>
                    
						<?php 
						$arrProdutosFiltroGenerico10 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 21);
                        ?>
                        
                        <?php if($GLOBALS['configProdutosFiltroGenerico10CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico10); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsProdutosFiltroGenerico10[]" type="checkbox" value="<?php echo $arrProdutosFiltroGenerico10[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrProdutosFiltroGenerico10[$countArray][0], $arrProdutosFiltroGenerico10Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrProdutosFiltroGenerico10[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico10CaixaSelecao'] == 2){ ?>
                            <select id="idsProdutosFiltroGenerico10" name="idsProdutosFiltroGenerico10[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico10); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico10[$countArray][0];?>"<?php if(in_array($arrProdutosFiltroGenerico10[$countArray][0], $arrProdutosFiltroGenerico10Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrProdutosFiltroGenerico10[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico10CaixaSelecao'] == 3){ ?>
                            <select id="idsProdutosFiltroGenerico10" name="idsProdutosFiltroGenerico10[]" class="AdmCampoDropDownMenu01" style="width: 237px;">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico10); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico10[$countArray][0];?>"<?php if(in_array($arrProdutosFiltroGenerico10[$countArray][0], $arrProdutosFiltroGenerico10Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrProdutosFiltroGenerico10[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
						<?php 
                        $flagManutencaoLink = $configManutencaoLinkFlag;
                        if($configManutencaoLinkFlag != true)
                        {
                            if(empty($arrProdutosFiltroGenerico10))
                            { 
                                $flagManutencaoLink = true;
                            }else{
                                $flagManutencaoLink = false;
                            }
                        }
                        ?>
                        <?php if($flagManutencaoLink == true){ ?>
                            <?php if($configManutencaoLink == 1){ ?>
                                <a href="SiteAdmProdutosManutencao.php" class="AdmLinks01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 2){ ?>
                                <a href="SiteAdmProdutosManutencao.php?tipoComplemento=21&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 3){ ?>
                                <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmProdutosManutencao.php?tipoComplemento=21&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $tbProdutosId;?>&configCaixaSelecao=<?php echo $GLOBALS['configProdutosFiltroGenerico10CaixaSelecao'];?>', '', '', '');
                                            divShow('divManutencaoAjax');
                                            HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_produtos_complemento&tipoComplemento=21&tipoRetorno=3&idItem=<?php echo $tbProdutosId;?>\', \'idsProdutosFiltroGenerico10\', \'<?php echo $GLOBALS['configProdutosFiltroGenerico10CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                    <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    <img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                </a>
                            <?php } ?>                                
                        <?php } ?>                                
                    </div>
                </div>
                
                <div style="position: absolute; display: block; top: 40px; left: 5px;">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico11Nome'], "IncludeConfig"); ?>: 
                    </div>
                    <div class="AdmTexto01">
                        <?php
						//Seleção de ids selecionados para o registro.
						$arrProdutosFiltroGenerico11Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbProdutosId, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", "22", "", ",", "", "1"));
						?>
                    
						<?php 
						$arrProdutosFiltroGenerico11 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 22);
                        ?>
                        
                        <?php if($GLOBALS['configProdutosFiltroGenerico11CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico11); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsProdutosFiltroGenerico11[]" type="checkbox" value="<?php echo $arrProdutosFiltroGenerico11[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrProdutosFiltroGenerico11[$countArray][0], $arrProdutosFiltroGenerico11Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrProdutosFiltroGenerico11[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico11CaixaSelecao'] == 2){ ?>
                            <select id="idsProdutosFiltroGenerico11" name="idsProdutosFiltroGenerico11[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico11); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico11[$countArray][0];?>"<?php if(in_array($arrProdutosFiltroGenerico11[$countArray][0], $arrProdutosFiltroGenerico11Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrProdutosFiltroGenerico11[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico11CaixaSelecao'] == 3){ ?>
                            <select id="idsProdutosFiltroGenerico11" name="idsProdutosFiltroGenerico11[]" class="AdmCampoDropDownMenu01" style="width: 130px;">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico11); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico11[$countArray][0];?>"<?php if(in_array($arrProdutosFiltroGenerico11[$countArray][0], $arrProdutosFiltroGenerico11Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrProdutosFiltroGenerico11[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
						<?php 
                        $flagManutencaoLink = $configManutencaoLinkFlag;
                        if($configManutencaoLinkFlag != true)
                        {
                            if(empty($arrProdutosFiltroGenerico11))
                            { 
                                $flagManutencaoLink = true;
                            }else{
                                $flagManutencaoLink = false;
                            }
                        }
                        ?>
                        <?php if($flagManutencaoLink == true){ ?>
                            <?php if($configManutencaoLink == 1){ ?>
                                <a href="SiteAdmProdutosManutencao.php" class="AdmLinks01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 2){ ?>
                                <a href="SiteAdmProdutosManutencao.php?tipoComplemento=22&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 3){ ?>
                                <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmProdutosManutencao.php?tipoComplemento=22&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $tbProdutosId;?>&configCaixaSelecao=<?php echo $GLOBALS['configProdutosFiltroGenerico22CaixaSelecao'];?>', '', '', '');
                                            divShow('divManutencaoAjax');
                                            HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_produtos_complemento&tipoComplemento=22&tipoRetorno=3&idItem=<?php echo $tbProdutosId;?>\', \'idsProdutosFiltroGenerico11\', \'<?php echo $GLOBALS['configProdutosFiltroGenerico11CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                    <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    <img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                </a>
                            <?php } ?>                                
                        <?php } ?>                                
                    </div>
                </div>
                <div style="position: absolute; display: block; top: 40px; left: 180px;">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProduto"); ?>:
                    </div>
                    <div align="left">
                        <input type="text" name="produto" id="produto" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbProdutosProduto;?>" style="width: 335px;" />
                    </div>
                </div>
                
                <div style="position: absolute; display: block; top: 76px; left: 5px;">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico04Nome'], "IncludeConfig"); ?>: 
                    </div>
                    <div class="AdmTexto01">
                        <?php
						//Seleção de ids selecionados para o registro.
						$arrProdutosFiltroGenerico04Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbProdutosId, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", "15", "", ",", "", "1"));
						?>
                    
						<?php 
						$arrProdutosFiltroGenerico04 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 15);
                        ?>
                        
                        <?php if($GLOBALS['configProdutosFiltroGenerico04CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico04); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsProdutosFiltroGenerico04[]" type="checkbox" value="<?php echo $arrProdutosFiltroGenerico04[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrProdutosFiltroGenerico04[$countArray][0], $arrProdutosFiltroGenerico04Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrProdutosFiltroGenerico04[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico04CaixaSelecao'] == 2){ ?>
                            <select id="idsProdutosFiltroGenerico04" name="idsProdutosFiltroGenerico04[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico04); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico04[$countArray][0];?>"<?php if(in_array($arrProdutosFiltroGenerico04[$countArray][0], $arrProdutosFiltroGenerico04Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrProdutosFiltroGenerico04[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico04CaixaSelecao'] == 3){ ?>
                            <select id="idsProdutosFiltroGenerico04" name="idsProdutosFiltroGenerico04[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico04); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico04[$countArray][0];?>"<?php if(in_array($arrProdutosFiltroGenerico04[$countArray][0], $arrProdutosFiltroGenerico04Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrProdutosFiltroGenerico04[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
						<?php 
                        $flagManutencaoLink = $configManutencaoLinkFlag;
                        if($configManutencaoLinkFlag != true)
                        {
                            if(empty($arrProdutosFiltroGenerico04))
                            { 
                                $flagManutencaoLink = true;
                            }else{
                                $flagManutencaoLink = false;
                            }
                        }
                        ?>
                        <?php if($flagManutencaoLink == true){ ?>
                            <?php if($configManutencaoLink == 1){ ?>
                                <a href="SiteAdmProdutosManutencao.php" class="AdmLinks01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 2){ ?>
                                <a href="SiteAdmProdutosManutencao.php?tipoComplemento=15&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 3){ ?>
                                <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmProdutosManutencao.php?tipoComplemento=15&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $tbProdutosId;?>&configCaixaSelecao=<?php echo $GLOBALS['configProdutosFiltroGenerico04CaixaSelecao'];?>', '', '', '');
                                            divShow('divManutencaoAjax');
                                            HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_produtos_complemento&tipoComplemento=15&tipoRetorno=3&idItem=<?php echo $tbProdutosId;?>\', \'idsProdutosFiltroGenerico04\', \'<?php echo $GLOBALS['configProdutosFiltroGenerico04CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                    <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    <img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                </a>
                            <?php } ?>                                
                        <?php } ?>                                
                    </div>
                </div>
                <div style="position: absolute; display: block; top: 76px; left: 180px;">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc12'], "IncludeConfig"); ?>:
                    </div>
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc12'] == 1){ ?>
                            <input type="text" name="informacao_complementar12" id="informacao_complementar12" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbProdutosIC12;?>" style="width: 90px;" />
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosBoxIc12'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar12" id="informacao_complementar12" class="AdmCampoTextoMultilinha01"><?php echo $tbProdutosIC12;?></textarea>
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
                                <textarea name="informacao_complementar12" id="informacao_complementar12"><?php echo $tbProdutosIC12;?></textarea>
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
                                <textarea name="informacao_complementar12" id="informacao_complementar12"><?php echo $tbProdutosIC12;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
                <div style="position: absolute; display: block; top: 76px; left: 280px;">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc2'], "IncludeConfig"); ?>:
                    </div>
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc2'] == 1){ ?>
                            <input type="text" name="informacao_complementar2" id="informacao_complementar2" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbProdutosIC2;?>" style="width: 110px;" />
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosBoxIc2'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar2" id="informacao_complementar2" class="AdmCampoTextoMultilinha01"><?php echo $tbProdutosIC2;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar2").cleditor(
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
                                <textarea name="informacao_complementar2" id="informacao_complementar2"><?php echo $tbProdutosIC2;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar2").cleditor(
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
                                <textarea name="informacao_complementar2" id="informacao_complementar2"><?php echo $tbProdutosIC2;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
                <div style="position: absolute; display: block; top: 76px; left: 400px;">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc11'], "IncludeConfig"); ?>:
                    </div>
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc11'] == 1){ ?>
                            <input type="text" name="informacao_complementar11" id="informacao_complementar11" class="AdmCampoTexto02" maxlength="255"  value="<?php echo $tbProdutosIC11;?>" style="width: 115px;" />
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosBoxIc11'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar11" id="informacao_complementar11" class="AdmCampoTextoMultilinha01"><?php echo $tbProdutosIC11;?></textarea>
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
                                <textarea name="informacao_complementar11" id="informacao_complementar11"><?php echo $tbProdutosIC11;?></textarea>
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
                                <textarea name="informacao_complementar11" id="informacao_complementar11"><?php echo $tbProdutosIC11;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
                
                <div style="position: absolute; display: block; top: 113px; left: 5px;">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico09Nome'], "IncludeConfig"); ?>: 
                    </div>
                    <div class="AdmTexto01">
                        <?php
						//Seleção de ids selecionados para o registro.
						$arrProdutosFiltroGenerico09Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbProdutosId, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", "20", "", ",", "", "1"));
						?>

						<?php 
						$arrProdutosFiltroGenerico09 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 20);
                        ?>
                        
                        <?php if($GLOBALS['configProdutosFiltroGenerico09CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico09); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsProdutosFiltroGenerico09[]" type="checkbox" value="<?php echo $arrProdutosFiltroGenerico09[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrProdutosFiltroGenerico09[$countArray][0], $arrProdutosFiltroGenerico09Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrProdutosFiltroGenerico09[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico09CaixaSelecao'] == 2){ ?>
                            <select id="idsProdutosFiltroGenerico09" name="idsProdutosFiltroGenerico09[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01" style="width: 120px;">
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico09); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico09[$countArray][0];?>"<?php if(in_array($arrProdutosFiltroGenerico09[$countArray][0], $arrProdutosFiltroGenerico09Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrProdutosFiltroGenerico09[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico09CaixaSelecao'] == 3){ ?>
                            <select id="idsProdutosFiltroGenerico09" name="idsProdutosFiltroGenerico09[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico09); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico09[$countArray][0];?>"<?php if(in_array($arrProdutosFiltroGenerico09[$countArray][0], $arrProdutosFiltroGenerico09Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrProdutosFiltroGenerico09[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
						<?php 
                        $flagManutencaoLink = $configManutencaoLinkFlag;
                        if($configManutencaoLinkFlag != true)
                        {
                            if(empty($arrProdutosFiltroGenerico09))
                            { 
                                $flagManutencaoLink = true;
                            }else{
                                $flagManutencaoLink = false;
                            }
                        }
                        ?>
                        <?php if($flagManutencaoLink == true){ ?>
                            <?php if($configManutencaoLink == 1){ ?>
                                <a href="SiteAdmProdutosManutencao.php" class="AdmLinks01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 2){ ?>
                                <a href="SiteAdmProdutosManutencao.php?tipoComplemento=20&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 3){ ?>
                                <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmProdutosManutencao.php?tipoComplemento=20&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $tbProdutosId;?>&configCaixaSelecao=<?php echo $GLOBALS['configProdutosFiltroGenerico09CaixaSelecao'];?>', '', '', '');
                                            divShow('divManutencaoAjax');
                                            HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_produtos_complemento&tipoComplemento=20&tipoRetorno=3&idItem=<?php echo $tbProdutosId;?>\', \'idsProdutosFiltroGenerico09\', \'<?php echo $GLOBALS['configProdutosFiltroGenerico09CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                    <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    <img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                </a>
                            <?php } ?>                                
                        <?php } ?>                                
                    </div>
                </div>
                <div style="position: absolute; display: block; top: 113px; left: 180px;">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico12Nome'], "IncludeConfig"); ?>: 
                    </div>
                    <div class="AdmTexto01">
                        <?php
						//Seleção de ids selecionados para o registro.
						$arrProdutosFiltroGenerico12Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbProdutosId, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", "23", "", ",", "", "1"));
						?>
                    
						<?php 
						$arrProdutosFiltroGenerico12 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 23);
                        ?>
                        
                        <?php if($GLOBALS['configProdutosFiltroGenerico12CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico12); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsProdutosFiltroGenerico12[]" type="checkbox" value="<?php echo $arrProdutosFiltroGenerico12[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrProdutosFiltroGenerico12[$countArray][0], $arrProdutosFiltroGenerico12Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrProdutosFiltroGenerico12[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico12CaixaSelecao'] == 2){ ?>
                            <select id="idsProdutosFiltroGenerico12" name="idsProdutosFiltroGenerico12[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico12); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico12[$countArray][0];?>"<?php if(in_array($arrProdutosFiltroGenerico12[$countArray][0], $arrProdutosFiltroGenerico12Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrProdutosFiltroGenerico12[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico12CaixaSelecao'] == 3){ ?>
                            <select id="idsProdutosFiltroGenerico12" name="idsProdutosFiltroGenerico12[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico12); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico12[$countArray][0];?>"<?php if(in_array($arrProdutosFiltroGenerico12[$countArray][0], $arrProdutosFiltroGenerico12Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrProdutosFiltroGenerico12[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
						<?php 
                        $flagManutencaoLink = $configManutencaoLinkFlag;
                        if($configManutencaoLinkFlag != true)
                        {
                            if(empty($arrProdutosFiltroGenerico12))
                            { 
                                $flagManutencaoLink = true;
                            }else{
                                $flagManutencaoLink = false;
                            }
                        }
                        ?>
                        <?php if($flagManutencaoLink == true){ ?>
                            <?php if($configManutencaoLink == 1){ ?>
                                <a href="SiteAdmProdutosManutencao.php" class="AdmLinks01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 2){ ?>
                                <a href="SiteAdmProdutosManutencao.php?tipoComplemento=23&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 3){ ?>
                                <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmProdutosManutencao.php?tipoComplemento=23&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $tbProdutosId;?>&configCaixaSelecao=<?php echo $GLOBALS['configProdutosFiltroGenerico12CaixaSelecao'];?>', '', '', '');
                                            divShow('divManutencaoAjax');
                                            HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_produtos_complemento&tipoComplemento=23&tipoRetorno=3&idItem=<?php echo $tbProdutosId;?>\', \'idsProdutosFiltroGenerico12\', \'<?php echo $GLOBALS['configProdutosFiltroGenerico12CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                    <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    <img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                </a>
                            <?php } ?>                                
                        <?php } ?>                                
                    </div>
                </div>
                <div style="position: absolute; display: block; top: 113px; left: 400px;">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico07Nome'], "IncludeConfig"); ?>: 
                    </div>
                    <div class="AdmTexto01">
                        <?php
						//Seleção de ids selecionados para o registro.
						$arrProdutosFiltroGenerico07Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbProdutosId, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", "18", "", ",", "", "1"));
						?>
                    
						<?php 
						$arrProdutosFiltroGenerico07 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 18);
                        ?>
                        
                        <?php if($GLOBALS['configProdutosFiltroGenerico07CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico07); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsProdutosFiltroGenerico07[]" type="checkbox" value="<?php echo $arrProdutosFiltroGenerico07[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrProdutosFiltroGenerico07[$countArray][0], $arrProdutosFiltroGenerico07Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrProdutosFiltroGenerico07[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico07CaixaSelecao'] == 2){ ?>
                            <select id="idsProdutosFiltroGenerico07" name="idsProdutosFiltroGenerico07[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01" style="width: 120px;">
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico07); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico07[$countArray][0];?>"<?php if(in_array($arrProdutosFiltroGenerico07[$countArray][0], $arrProdutosFiltroGenerico07Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrProdutosFiltroGenerico07[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico07CaixaSelecao'] == 3){ ?>
                            <select id="idsProdutosFiltroGenerico07" name="idsProdutosFiltroGenerico07[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico07); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico07[$countArray][0];?>"<?php if(in_array($arrProdutosFiltroGenerico07[$countArray][0], $arrProdutosFiltroGenerico07Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrProdutosFiltroGenerico07[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
						<?php 
                        $flagManutencaoLink = $configManutencaoLinkFlag;
                        if($configManutencaoLinkFlag != true)
                        {
                            if(empty($arrProdutosFiltroGenerico07))
                            { 
                                $flagManutencaoLink = true;
                            }else{
                                $flagManutencaoLink = false;
                            }
                        }
                        ?>
                        <?php if($flagManutencaoLink == true){ ?>
                            <?php if($configManutencaoLink == 1){ ?>
                                <a href="SiteAdmProdutosManutencao.php" class="AdmLinks01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 2){ ?>
                                <a href="SiteAdmProdutosManutencao.php?tipoComplemento=18&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 3){ ?>
                                <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmProdutosManutencao.php?tipoComplemento=18&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $tbProdutosId;?>&configCaixaSelecao=<?php echo $GLOBALS['configProdutosFiltroGenerico07CaixaSelecao'];?>', '', '', '');
                                            divShow('divManutencaoAjax');
                                            HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_produtos_complemento&tipoComplemento=18&tipoRetorno=3&idItem=<?php echo $tbProdutosId;?>\', \'idsProdutosFiltroGenerico07\', \'<?php echo $GLOBALS['configProdutosFiltroGenerico07CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                    <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    <img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                </a>
                            <?php } ?>                                
                        <?php } ?>                                
                    </div>
                </div>
                
                <div style="position: absolute; display: block; top: 167px; left: 5px;">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico06Nome'], "IncludeConfig"); ?>: 
                    </div>
                    <div class="AdmTexto01">
                        <?php
						//Seleção de ids selecionados para o registro.
						$arrProdutosFiltroGenerico06Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbProdutosId, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", "17", "", ",", "", "1"));
						?>

						<?php 
						$arrProdutosFiltroGenerico06 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 17);
                        ?>
                        
                        <?php if($GLOBALS['configProdutosFiltroGenerico06CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico06); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsProdutosFiltroGenerico06[]" type="checkbox" value="<?php echo $arrProdutosFiltroGenerico06[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrProdutosFiltroGenerico06[$countArray][0], $arrProdutosFiltroGenerico06Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrProdutosFiltroGenerico06[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico06CaixaSelecao'] == 2){ ?>
                            <select id="idsProdutosFiltroGenerico06" name="idsProdutosFiltroGenerico06[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico06); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico06[$countArray][0];?>"<?php if(in_array($arrProdutosFiltroGenerico06[$countArray][0], $arrProdutosFiltroGenerico06Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrProdutosFiltroGenerico06[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico06CaixaSelecao'] == 3){ ?>
                            <select id="idsProdutosFiltroGenerico06" name="idsProdutosFiltroGenerico06[]" class="AdmCampoDropDownMenu01" style="/*width: 130px;*/">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico06); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico06[$countArray][0];?>"<?php if(in_array($arrProdutosFiltroGenerico06[$countArray][0], $arrProdutosFiltroGenerico06Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrProdutosFiltroGenerico06[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
						<?php 
                        $flagManutencaoLink = $configManutencaoLinkFlag;
                        if($configManutencaoLinkFlag != true)
                        {
                            if(empty($arrProdutosFiltroGenerico06))
                            { 
                                $flagManutencaoLink = true;
                            }else{
                                $flagManutencaoLink = false;
                            }
                        }
                        ?>
                        <?php if($flagManutencaoLink == true){ ?>
                            <?php if($configManutencaoLink == 1){ ?>
                                <a href="SiteAdmProdutosManutencao.php" class="AdmLinks01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 2){ ?>
                                <a href="SiteAdmProdutosManutencao.php?tipoComplemento=17&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 3){ ?>
                                <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmProdutosManutencao.php?tipoComplemento=17&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $tbProdutosId;?>&configCaixaSelecao=<?php echo $GLOBALS['configProdutosFiltroGenerico06CaixaSelecao'];?>', '', '', '');
                                            divShow('divManutencaoAjax');
                                            HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_produtos_complemento&tipoComplemento=17&tipoRetorno=3&idItem=<?php echo $tbProdutosId;?>\', \'idsProdutosFiltroGenerico06\', \'<?php echo $GLOBALS['configProdutosFiltroGenerico06CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                    <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    <img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                </a>
                            <?php } ?>                                
                        <?php } ?>                                
                    </div>
                </div>
                
                <div style="position: absolute; display: block; top: 205px; left: 5px;">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosDescricao01Titulo'], "IncludeConfig"); ?>: 
                    </div>
                    <div>
                        <?php //Sem formatação.?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                            <textarea name="descricao01" id="descricao01" class="AdmCampoTextoMultilinha01" style="width: 380px; height: 80px;"><?php echo $tbProdutosDescricao01;?></textarea>
                        <?php } ?>
                        
                        <?php //Formatação básica (CLEditor).?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                            
                            <script type="text/javascript">
                                //Caixa básica.
                                $(document).ready(function () {
                                    $("#descricao01").cleditor(
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
                            <textarea name="descricao01" id="descricao01"><?php echo $tbProdutosDescricao01;?></textarea>
                        <?php } ?>
                        
                        <?php //Formatação avançada (CLEditor).?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                            <script type="text/javascript">
                                $(document).ready(function () {
                                    $("#descricao01").cleditor(
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
                            <textarea name="descricao01" id="descricao01"><?php echo $tbProdutosDescricao01;?></textarea>
                        <?php } ?>
                    </div>
                </div>
                <div style="position: absolute; display: none; top: 205px; left: 410px;">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPalavrasChave01"); ?>:
                    </div>
                    <div align="left" class="AdmTexto01">
                        <textarea name="palavras_chave" id="palavras_chave" class="AdmCampoTextoMultilinha01" style="width: 160px; height: 80px;"><?php echo $tbProdutosPalavrasChave;?></textarea>
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPalavrasChave02"); ?>
                    </div>
                </div>
                <div style="position: absolute; display: block; top: 205px; left: 400px;">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico24Nome'], "IncludeConfig"); ?>:
                    </div>
                    <div align="left" class="AdmTexto01">
						<?php
                        //Seleção de ids selecionados para o registro.
                        $arrProdutosFiltroGenerico24Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbProdutosId, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", "35", "", ",", "", "1"));
                        ?>
                    
                        <?php 
                        $arrProdutosFiltroGenerico24 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 35);
                        ?>
                        
                        <?php if($GLOBALS['configProdutosFiltroGenerico24CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico24); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsProdutosFiltroGenerico24[]" type="checkbox" value="<?php echo $arrProdutosFiltroGenerico24[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrProdutosFiltroGenerico24[$countArray][0], $arrProdutosFiltroGenerico24Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrProdutosFiltroGenerico24[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico24CaixaSelecao'] == 2){ ?>
                            <select id="idsProdutosFiltroGenerico24" name="idsProdutosFiltroGenerico24[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01" style="width: 120px; height: 85px;">
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico24); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico24[$countArray][0];?>"<?php if(in_array($arrProdutosFiltroGenerico24[$countArray][0], $arrProdutosFiltroGenerico24Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrProdutosFiltroGenerico24[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico24CaixaSelecao'] == 3){ ?>
                            <select id="idsProdutosFiltroGenerico24" name="idsProdutosFiltroGenerico24[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico24); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico24[$countArray][0];?>"<?php if(in_array($arrProdutosFiltroGenerico24[$countArray][0], $arrProdutosFiltroGenerico24Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrProdutosFiltroGenerico24[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php 
                        $flagManutencaoLink = $configManutencaoLinkFlag;
                        if($configManutencaoLinkFlag != true)
                        {
                            if(empty($arrProdutosFiltroGenerico24))
                            { 
                                $flagManutencaoLink = true;
                            }else{
                                $flagManutencaoLink = false;
                            }
                        }
                        ?>
                        <?php if($flagManutencaoLink == true){ ?>
                            <?php if($configManutencaoLink == 1){ ?>
                                <a href="SiteAdmProdutosManutencao.php" class="AdmLinks01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 2){ ?>
                                <a href="SiteAdmProdutosManutencao.php?tipoComplemento=35&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 3){ ?>
                                <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmProdutosManutencao.php?tipoComplemento=35&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $tbProdutosId;?>&configCaixaSelecao=<?php echo $GLOBALS['configProdutosFiltroGenerico24CaixaSelecao'];?>', '', '', '');
                                            divShow('divManutencaoAjax');
                                            HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_produtos_complemento&tipoComplemento=35&tipoRetorno=3&idItem=<?php echo $tbProdutosId;?>\', \'idsProdutosFiltroGenerico24\', \'<?php echo $GLOBALS['configProdutosFiltroGenerico24CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                    <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    <img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                </a>
                            <?php } ?>                                
                        <?php } ?>                                
                    </div>
                </div>            