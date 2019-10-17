                <div style="position: absolute; display: block; top: 6px; left: 5px;">
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
                <div style="position: absolute; display: block; top: 6px; left: 160px;">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosCodigo"); ?>:
                    </div>
                    <div align="left">
                        <input type="text" name="cod_produto" id="cod_produto" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbProdutosCodProduto; ?>" style="width: 110px;" />
                    </div>
                </div>
                <div style="position: absolute; display: block; top: 6px; left: 280px;">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico02Nome'], "IncludeConfig"); ?>: 
                    </div>
                    <div class="AdmTexto01">
                        <?php
						//Seleção de ids selecionados para o registro.
						$arrProdutosFiltroGenerico02Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbProdutosId, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", "13", "", ",", "", "1"));
						?>
                    
						<?php 
						$arrProdutosFiltroGenerico02 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 13);
						//echo "arrProdutosFiltroGenerico02Selecao=" . $arrProdutosFiltroGenerico02Selecao . "<br />";
						//echo "arrProdutosFiltroGenerico02Selecao[0]=" . $arrProdutosFiltroGenerico02Selecao[0] . "<br />";
						//echo "FiltrosGenericosSelect03=" . DbFuncoes::FiltrosGenericosSelect03($tbProdutosId, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", "13", "", ",", "", "1")  . "<br />";
						//echo "tbProdutosId=" . $tbProdutosId . "<br />";
                        ?>
                        
                        <?php if($GLOBALS['configProdutosFiltroGenerico02CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico02); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsProdutosFiltroGenerico02[]" type="checkbox" value="<?php echo $arrProdutosFiltroGenerico02[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrProdutosFiltroGenerico02[$countArray][0], $arrProdutosFiltroGenerico02Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrProdutosFiltroGenerico02[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico02CaixaSelecao'] == 2){ ?>
                            <select id="idsProdutosFiltroGenerico02" name="idsProdutosFiltroGenerico02[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico02); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico02[$countArray][0];?>"<?php if(in_array($arrProdutosFiltroGenerico02[$countArray][0], $arrProdutosFiltroGenerico02Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrProdutosFiltroGenerico02[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico02CaixaSelecao'] == 3){ ?>
                            <select id="idsProdutosFiltroGenerico02" name="idsProdutosFiltroGenerico02[]" class="AdmCampoDropDownMenu01" style="width: 295px;">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico02); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico02[$countArray][0];?>"<?php if(in_array($arrProdutosFiltroGenerico02[$countArray][0], $arrProdutosFiltroGenerico02Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrProdutosFiltroGenerico02[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
						<?php 
                        $flagManutencaoLink = $configManutencaoLinkFlag;
                        if($configManutencaoLinkFlag != true)
                        {
                            if(empty($arrProdutosFiltroGenerico02))
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
                                <a href="SiteAdmProdutosManutencao.php?tipoComplemento=13&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 3){ ?>
                                <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmProdutosManutencao.php?tipoComplemento=13&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $tbProdutosId;?>&configCaixaSelecao=<?php echo $GLOBALS['configProdutosFiltroGenerico02CaixaSelecao'];?>', '', '', '');
                                            divShow('divManutencaoAjax');
                                            HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_produtos_complemento&tipoComplemento=13&tipoRetorno=3&idItem=<?php echo $tbProdutosId;?>\', \'idsProdutosFiltroGenerico02\', \'<?php echo $GLOBALS['configProdutosFiltroGenerico02CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                    <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    <img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                </a>
                            <?php } ?>                                
                        <?php } ?>                                
                    </div>
                </div>
                
                <div style="position: absolute; display: block; top: 40px; left: 5px;">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico03Nome'], "IncludeConfig"); ?>: 
                    </div>
                    <div class="AdmTexto01">
                        <?php
						//Seleção de ids selecionados para o registro.
						$arrProdutosFiltroGenerico03Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbProdutosId, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", "14", "", ",", "", "1"));
						?>

						<?php 
						$arrProdutosFiltroGenerico03 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 14);
                        ?>
                        
                        <?php if($GLOBALS['configProdutosFiltroGenerico03CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico03); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsProdutosFiltroGenerico03[]" type="checkbox" value="<?php echo $arrProdutosFiltroGenerico03[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrProdutosFiltroGenerico03[$countArray][0], $arrProdutosFiltroGenerico03Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrProdutosFiltroGenerico03[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico03CaixaSelecao'] == 2){ ?>
                            <select id="idsProdutosFiltroGenerico03" name="idsProdutosFiltroGenerico03[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico03); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico03[$countArray][0];?>"<?php if(in_array($arrProdutosFiltroGenerico03[$countArray][0], $arrProdutosFiltroGenerico03Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrProdutosFiltroGenerico03[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico03CaixaSelecao'] == 3){ ?>
                            <select id="idsProdutosFiltroGenerico03" name="idsProdutosFiltroGenerico03[]" class="AdmCampoDropDownMenu01" style="width: 246px;">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico03); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico03[$countArray][0];?>"<?php if(in_array($arrProdutosFiltroGenerico03[$countArray][0], $arrProdutosFiltroGenerico03Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrProdutosFiltroGenerico03[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
						<?php 
                        $flagManutencaoLink = $configManutencaoLinkFlag;
                        if($configManutencaoLinkFlag != true)
                        {
                            if(empty($arrProdutosFiltroGenerico03))
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
                                <a href="SiteAdmProdutosManutencao.php?tipoComplemento=14&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 3){ ?>
                                <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmProdutosManutencao.php?tipoComplemento=14&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $tbProdutosId;?>&configCaixaSelecao=<?php echo $GLOBALS['configProdutosFiltroGenerico03CaixaSelecao'];?>', '', '', '');
                                            divShow('divManutencaoAjax');
                                            HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_produtos_complemento&tipoComplemento=14&tipoRetorno=3&idItem=<?php echo $tbProdutosId;?>\', \'idsProdutosFiltroGenerico03\', \'<?php echo $GLOBALS['configProdutosFiltroGenerico03CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                    <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    <img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                </a>
                            <?php } ?>                                
                        <?php } ?>                                
                    </div>
                </div>
                <div style="position: absolute; display: block; top: 40px; left: 280px;">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProduto"); ?> - Editora Gr&aacute;fica:
                    </div>
                    <div align="left">
                        <input type="text" name="produto" id="produto" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbProdutosProduto;?>" style="width: 293px;" />
                    </div>
                </div>
                
                <div style="position: absolute; display: block; top: 74px; left: 5px;">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc12'], "IncludeConfig"); ?>:
                    </div>
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc12'] == 1){ ?>
                            <input type="text" name="informacao_complementar12" id="informacao_complementar12" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbProdutosIC12;?>" style="width: 65px;" />
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
                <div style="position: absolute; display: block; top: 74px; left: 75px;">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc2'], "IncludeConfig"); ?>:
                    </div>
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc2'] == 1){ ?>
                            <input type="text" name="informacao_complementar2" id="informacao_complementar2" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbProdutosIC2;?>" style="width: 100px;" />
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
                <div style="position: absolute; display: block; top: 74px; left: 182px;">
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
                <div style="position: absolute; display: block; top: 74px; left: 280px;">
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
                <div style="position: absolute; display: block; top: 74px; left: 400px;">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc22'], "IncludeConfig"); ?>:
                    </div>
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc22'] == 1){ ?>
                            <input type="text" name="informacao_complementar22" id="informacao_complementar22" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbProdutosIC22;?>" style="width: 75px;" />
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosBoxIc22'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar22" id="informacao_complementar22" class="AdmCampoTextoMultilinha01"><?php echo $tbProdutosIC22;?></textarea>
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
                                <textarea name="informacao_complementar22" id="informacao_complementar22"><?php echo $tbProdutosIC22;?></textarea>
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
                                <textarea name="informacao_complementar22" id="informacao_complementar22"><?php echo $tbProdutosIC22;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
                <div style="position: absolute; display: block; top: 74px; left: 480px;">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc24'], "IncludeConfig"); ?>:
                    </div>
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc24'] == 1){ ?>
                            <input type="text" name="informacao_complementar24" id="informacao_complementar24" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbProdutosIC24;?>" style="width: 93px;" />
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosBoxIc24'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar24" id="informacao_complementar24" class="AdmCampoTextoMultilinha01"><?php echo $tbProdutosIC24;?></textarea>
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
                                <textarea name="informacao_complementar24" id="informacao_complementar24"><?php echo $tbProdutosIC24;?></textarea>
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
                                <textarea name="informacao_complementar24" id="informacao_complementar24"><?php echo $tbProdutosIC24;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>

                <div style="position: absolute; display: block; top: 108px; left: 5px;">
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
                            <select id="idsProdutosFiltroGenerico09" name="idsProdutosFiltroGenerico09[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01" style="width: 122px;">
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
                <div style="position: absolute; display: block; top: 108px; left: 182px;">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc18'], "IncludeConfig"); ?>:
                    </div>
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc18'] == 1){ ?>
                            <input type="text" name="informacao_complementar18" id="informacao_complementar18" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbProdutosIC18;?>" style="width: 67px;" />
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosBoxIc18'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar18" id="informacao_complementar18" class="AdmCampoTextoMultilinha01"><?php echo $tbProdutosIC18;?></textarea>
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
                                <textarea name="informacao_complementar18" id="informacao_complementar18"><?php echo $tbProdutosIC18;?></textarea>
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
                                <textarea name="informacao_complementar18" id="informacao_complementar18"><?php echo $tbProdutosIC18;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
                <div style="position: absolute; display: block; top: 108px; left: 280px;">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico23Nome'], "IncludeConfig"); ?>: 
                    </div>
                    <div class="AdmTexto01">
                        <?php
						//Seleção de ids selecionados para o registro.
						$arrProdutosFiltroGenerico23Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbProdutosId, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", "34", "", ",", "", "1"));
						?>

						<?php 
						$arrProdutosFiltroGenerico23 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 34);
                        ?>
                        
                        <?php if($GLOBALS['configProdutosFiltroGenerico23CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico23); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsProdutosFiltroGenerico23[]" type="checkbox" value="<?php echo $arrProdutosFiltroGenerico23[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrProdutosFiltroGenerico23[$countArray][0], $arrProdutosFiltroGenerico23Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrProdutosFiltroGenerico23[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico23CaixaSelecao'] == 2){ ?>
                            <select id="idsProdutosFiltroGenerico23" name="idsProdutosFiltroGenerico23[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico23); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico23[$countArray][0];?>"<?php if(in_array($arrProdutosFiltroGenerico23[$countArray][0], $arrProdutosFiltroGenerico23Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrProdutosFiltroGenerico23[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico23CaixaSelecao'] == 3){ ?>
                            <select id="idsProdutosFiltroGenerico23" name="idsProdutosFiltroGenerico23[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico23); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico23[$countArray][0];?>"<?php if(in_array($arrProdutosFiltroGenerico23[$countArray][0], $arrProdutosFiltroGenerico23Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrProdutosFiltroGenerico23[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
						<?php 
                        $flagManutencaoLink = $configManutencaoLinkFlag;
                        if($configManutencaoLinkFlag != true)
                        {
                            if(empty($arrProdutosFiltroGenerico23))
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
                                <a href="SiteAdmProdutosManutencao.php?tipoComplemento=34&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 3){ ?>
                                <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmProdutosManutencao.php?tipoComplemento=34&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $tbProdutosId;?>&configCaixaSelecao=<?php echo $GLOBALS['configProdutosFiltroGenerico23CaixaSelecao'];?>', '', '', '');
                                            divShow('divManutencaoAjax');
                                            HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_produtos_complemento&tipoComplemento=34&tipoRetorno=3&idItem=<?php echo $tbProdutosId;?>\', \'idsProdutosFiltroGenerico23\', \'<?php echo $GLOBALS['configProdutosFiltroGenerico23CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                    <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    <img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                </a>
                            <?php } ?>                                
                        <?php } ?>                                
                    </div>
                </div>
                <div style="position: absolute; display: block; top: 108px; left: 425px;">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc21'], "IncludeConfig"); ?>:
                    </div>
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc21'] == 1){ ?>
                            <input type="text" name="informacao_complementar21" id="informacao_complementar21" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbProdutosIC21;?>" style="width: 148px;" />
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosBoxIc21'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar21" id="informacao_complementar21" class="AdmCampoTextoMultilinha01"><?php echo $tbProdutosIC21;?></textarea>
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
                                <textarea name="informacao_complementar21" id="informacao_complementar21"><?php echo $tbProdutosIC21;?></textarea>
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
                                <textarea name="informacao_complementar21" id="informacao_complementar21"><?php echo $tbProdutosIC21;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>

                <div style="position: absolute; display: block; top: 160px; left: 5px;">
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
                            <select id="idsProdutosFiltroGenerico07" name="idsProdutosFiltroGenerico07[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01" style="width: 122px;">
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
                <div style="position: absolute; display: block; top: 160px; left: 182px;">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc23'], "IncludeConfig"); ?>:
                    </div>
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc23'] == 1){ ?>
                            <input type="text" name="informacao_complementar23" id="informacao_complementar23" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbProdutosIC23;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosBoxIc23'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar23" id="informacao_complementar23" class="AdmCampoTextoMultilinha01" style="width: 387px; height: 30px;"><?php echo $tbProdutosIC23;?></textarea>
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
                                <textarea name="informacao_complementar23" id="informacao_complementar23"><?php echo $tbProdutosIC23;?></textarea>
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
                                <textarea name="informacao_complementar23" id="informacao_complementar23"><?php echo $tbProdutosIC23;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
                
                <div style="position: absolute; display: block; top: 212px; left: 5px;">
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
                            <select id="idsProdutosFiltroGenerico06" name="idsProdutosFiltroGenerico06[]" class="AdmCampoDropDownMenu01">
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
                
                <div style="position: absolute; display: block; top: 247px; left: 5px;">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosDescricao01Titulo'], "IncludeConfig"); ?>: 
                    </div>
                    <div>
                        <?php //Sem formatação.?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                            <textarea name="descricao01" id="descricao01" class="AdmCampoTextoMultilinha01" style="width: 390px; height: 80px;"><?php echo $tbProdutosDescricao01;?></textarea>
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
                <div style="position: absolute; display: none; top: 247px; left: 410px;">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPalavrasChave01"); ?>:
                    </div>
                    <div align="left" class="AdmTexto01">
                        <textarea name="palavras_chave" id="palavras_chave" class="AdmCampoTextoMultilinha01" style="width: 160px; height: 80px;"><?php echo $tbProdutosPalavrasChave;?></textarea>
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPalavrasChave02"); ?>
                    </div>
                </div>
                <div style="position: absolute; display: block; top: 247px; left: 410px;">
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
                            <select id="idsProdutosFiltroGenerico24" name="idsProdutosFiltroGenerico24[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01" style="height: 85px; width: 165px;">
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