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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico25Nome'], "IncludeConfig"); ?>: 
                    </div>
                    <div class="AdmTexto01">
                        <?php
						//Seleção de ids selecionados para o registro.
						$arrProdutosFiltroGenerico25Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbProdutosId, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", "36", "", ",", "", "1"));
						?>
                    
						<?php 
						$arrProdutosFiltroGenerico25 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 36);
                        ?>
                        
                        <?php if($GLOBALS['configProdutosFiltroGenerico25CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico25); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsProdutosFiltroGenerico25[]" type="checkbox" value="<?php echo $arrProdutosFiltroGenerico25[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrProdutosFiltroGenerico25[$countArray][0], $arrProdutosFiltroGenerico25Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrProdutosFiltroGenerico25[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico25CaixaSelecao'] == 2){ ?>
                            <select id="idsProdutosFiltroGenerico25" name="idsProdutosFiltroGenerico25[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico25); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico25[$countArray][0];?>"<?php if(in_array($arrProdutosFiltroGenerico25[$countArray][0], $arrProdutosFiltroGenerico25Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrProdutosFiltroGenerico25[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico25CaixaSelecao'] == 3){ ?>
                            <select id="idsProdutosFiltroGenerico25" name="idsProdutosFiltroGenerico25[]" class="AdmCampoDropDownMenu01" style="width: 120px;">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico25); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico25[$countArray][0];?>"<?php if(in_array($arrProdutosFiltroGenerico25[$countArray][0], $arrProdutosFiltroGenerico25Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrProdutosFiltroGenerico25[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
						<?php 
                        $flagManutencaoLink = $configManutencaoLinkFlag;
                        if($configManutencaoLinkFlag != true)
                        {
                            if(empty($arrProdutosFiltroGenerico25))
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
                                <a href="SiteAdmProdutosManutencao.php?tipoComplemento=36&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 3){ ?>
                                <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmProdutosManutencao.php?tipoComplemento=36&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $tbProdutosId;?>&configCaixaSelecao=<?php echo $GLOBALS['configProdutosFiltroGenerico25CaixaSelecao'];?>', '', '', '');
                                            divShow('divManutencaoAjax');
                                            HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_produtos_complemento&tipoComplemento=36&tipoRetorno=3&idItem=<?php echo $tbProdutosId;?>\', \'idsProdutosFiltroGenerico25\', \'<?php echo $GLOBALS['configProdutosFiltroGenerico25CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                    <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    <img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                </a>
                            <?php } ?>                                
                        <?php } ?>                                
                    </div>
                </div>
                
                
                <div style="position: absolute; display: block; top: 40px; left: 5px;">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico20Nome'], "IncludeConfig"); ?>: 
                    </div>
                    <div class="AdmTexto01">
                        <?php
						//Seleção de ids selecionados para o registro.
						$arrProdutosFiltroGenerico20Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbProdutosId, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", "31", "", ",", "", "1"));
						?>
                    
						<?php 
						$arrProdutosFiltroGenerico20 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 31);
                        ?>
                        
                        <?php if($GLOBALS['configProdutosFiltroGenerico20CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico20); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsProdutosFiltroGenerico20[]" type="checkbox" value="<?php echo $arrProdutosFiltroGenerico20[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrProdutosFiltroGenerico20[$countArray][0], $arrProdutosFiltroGenerico20Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrProdutosFiltroGenerico20[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico10CaixaSelecao'] == 2){ ?>
                            <select id="idsProdutosFiltroGenerico20" name="idsProdutosFiltroGenerico20[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico20); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico20[$countArray][0];?>"<?php if(in_array($arrProdutosFiltroGenerico20[$countArray][0], $arrProdutosFiltroGenerico20Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrProdutosFiltroGenerico20[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico10CaixaSelecao'] == 3){ ?>
                            <select id="idsProdutosFiltroGenerico20" name="idsProdutosFiltroGenerico20[]" class="AdmCampoDropDownMenu01" style="width: 245px;">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico20); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico20[$countArray][0];?>"<?php if(in_array($arrProdutosFiltroGenerico20[$countArray][0], $arrProdutosFiltroGenerico20Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrProdutosFiltroGenerico20[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
						<?php 
                        $flagManutencaoLink = $configManutencaoLinkFlag;
                        if($configManutencaoLinkFlag != true)
                        {
                            if(empty($arrProdutosFiltroGenerico20))
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
                                <a href="SiteAdmProdutosManutencao.php?tipoComplemento=31&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 3){ ?>
                                <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmProdutosManutencao.php?tipoComplemento=31&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $tbProdutosId;?>&configCaixaSelecao=<?php echo $GLOBALS['configProdutosFiltroGenerico20CaixaSelecao'];?>', '', '', '');
                                            divShow('divManutencaoAjax');
                                            HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_produtos_complemento&tipoComplemento=31&tipoRetorno=3&idItem=<?php echo $tbProdutosId;?>\', \'idsProdutosFiltroGenerico20\', \'<?php echo $GLOBALS['configProdutosFiltroGenerico20CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                    <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    <img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                </a>
                            <?php } ?>                                
                        <?php } ?>                                
                    </div>
                </div>
                <div style="position: absolute; display: block; top: 40px; left: 280px;">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProduto"); ?>:
                    </div>
                    <div align="left">
                        <input type="text" name="produto" id="produto" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbProdutosProduto;?>" style="width: 300px;" />
                    </div>
                </div>
                
                <div style="position: absolute; display: block; top: 74px; left: 5px;">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc14'], "IncludeConfig"); ?>:
                    </div>
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc14'] == 1){ ?>
                            <input type="text" name="informacao_complementar14" id="informacao_complementar14" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbProdutosIC14;?>" style="width: 60px;" />
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosBoxIc14'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar14" id="informacao_complementar14" class="AdmCampoTextoMultilinha01"><?php echo $tbProdutosIC14;?></textarea>
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
                                <textarea name="informacao_complementar14" id="informacao_complementar14"><?php echo $tbProdutosIC14;?></textarea>
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
                                <textarea name="informacao_complementar14" id="informacao_complementar14"><?php echo $tbProdutosIC14;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
                <div style="position: absolute; display: block; top: 74px; left: 132px;">
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
                <div style="position: absolute; display: block; top: 74px; left: 280px;">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc24'], "IncludeConfig"); ?>:
                    </div>
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc24'] == 1){ ?>
                            <input type="text" name="informacao_complementar24" id="informacao_complementar24" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbProdutosIC24;?>" />
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
                <div style="position: absolute; display: block; top: 74px; left: 430px;">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc21'], "IncludeConfig"); ?>:
                    </div>
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc21'] == 1){ ?>
                            <input type="text" name="informacao_complementar21" id="informacao_complementar21" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbProdutosIC21;?>" style="width: 150px;" />
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

                <div style="position: absolute; display: block; top: 108px; left: 5px;">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico22Nome'], "IncludeConfig"); ?>: 
                    </div>
                    <div class="AdmTexto01">
                        <?php
						//Seleção de ids selecionados para o registro.
						$arrProdutosFiltroGenerico22Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbProdutosId, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", "33", "", ",", "", "1"));
						?>
                    
						<?php 
						$arrProdutosFiltroGenerico22 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 33);
						//echo "arrProdutosFiltroGenerico22Selecao=" . $arrProdutosFiltroGenerico22Selecao . "<br />";
						//echo "arrProdutosFiltroGenerico22Selecao[0]=" . $arrProdutosFiltroGenerico22Selecao[0] . "<br />";
						//echo "FiltrosGenericosSelect03=" . DbFuncoes::FiltrosGenericosSelect03($tbProdutosId, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", "13", "", ",", "", "1")  . "<br />";
						//echo "tbProdutosId=" . $tbProdutosId . "<br />";
                        ?>
                        
                        <?php if($GLOBALS['configProdutosFiltroGenerico22CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico22); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsProdutosFiltroGenerico22[]" type="checkbox" value="<?php echo $arrProdutosFiltroGenerico22[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrProdutosFiltroGenerico22[$countArray][0], $arrProdutosFiltroGenerico22Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrProdutosFiltroGenerico22[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico22CaixaSelecao'] == 2){ ?>
                            <select id="idsProdutosFiltroGenerico22" name="idsProdutosFiltroGenerico22[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01" style="width: 122px;">
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico22); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico22[$countArray][0];?>"<?php if(in_array($arrProdutosFiltroGenerico22[$countArray][0], $arrProdutosFiltroGenerico22Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrProdutosFiltroGenerico22[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico22CaixaSelecao'] == 3){ ?>
                            <select id="idsProdutosFiltroGenerico22" name="idsProdutosFiltroGenerico22[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico22); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico22[$countArray][0];?>"<?php if(in_array($arrProdutosFiltroGenerico22[$countArray][0], $arrProdutosFiltroGenerico22Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrProdutosFiltroGenerico22[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
						<?php 
                        $flagManutencaoLink = $configManutencaoLinkFlag;
                        if($configManutencaoLinkFlag != true)
                        {
                            if(empty($arrProdutosFiltroGenerico22))
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
                                <a href="SiteAdmProdutosManutencao.php?tipoComplemento=33&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 3){ ?>
                                <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmProdutosManutencao.php?tipoComplemento=33&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $tbProdutosId;?>&configCaixaSelecao=<?php echo $GLOBALS['configProdutosFiltroGenerico22CaixaSelecao'];?>', '', '', '');
                                            divShow('divManutencaoAjax');
                                            HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_produtos_complemento&tipoComplemento=33&tipoRetorno=3&idItem=<?php echo $tbProdutosId;?>\', \'idsProdutosFiltroGenerico22\', \'<?php echo $GLOBALS['configProdutosFiltroGenerico22CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                    <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    <img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                </a>
                            <?php } ?>                                
                        <?php } ?>                                
                    </div>
                </div>
                <div style="position: absolute; display: block; top: 108px; left: 160px;">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc18'], "IncludeConfig"); ?>:
                    </div>
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc18'] == 1){ ?>
                            <input type="text" name="informacao_complementar18" id="informacao_complementar18" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbProdutosIC18;?>" style="width: 85px;" />
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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico21Nome'], "IncludeConfig"); ?>: 
                    </div>
                    <div class="AdmTexto01">
                        <?php
						//Seleção de ids selecionados para o registro.
						$arrProdutosFiltroGenerico21Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbProdutosId, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", "32", "", ",", "", "1"));
						?>
                    
						<?php 
						$arrProdutosFiltroGenerico21 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 32);
                        ?>
                        
                        <?php if($GLOBALS['configProdutosFiltroGenerico21CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico21); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsProdutosFiltroGenerico21[]" type="checkbox" value="<?php echo $arrProdutosFiltroGenerico21[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrProdutosFiltroGenerico21[$countArray][0], $arrProdutosFiltroGenerico21Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrProdutosFiltroGenerico21[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico21CaixaSelecao'] == 2){ ?>
                            <select id="idsProdutosFiltroGenerico21" name="idsProdutosFiltroGenerico21[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico21); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico21[$countArray][0];?>"<?php if(in_array($arrProdutosFiltroGenerico21[$countArray][0], $arrProdutosFiltroGenerico21Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrProdutosFiltroGenerico21[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico21CaixaSelecao'] == 3){ ?>
                            <select id="idsProdutosFiltroGenerico21" name="idsProdutosFiltroGenerico21[]" class="AdmCampoDropDownMenu01" style="width: 120px;">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico21); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico21[$countArray][0];?>"<?php if(in_array($arrProdutosFiltroGenerico21[$countArray][0], $arrProdutosFiltroGenerico21Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrProdutosFiltroGenerico21[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
						<?php 
                        $flagManutencaoLink = $configManutencaoLinkFlag;
                        if($configManutencaoLinkFlag != true)
                        {
                            if(empty($arrProdutosFiltroGenerico21))
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
                                <a href="SiteAdmProdutosManutencao.php?tipoComplemento=32&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 3){ ?>
                                <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmProdutosManutencao.php?tipoComplemento=32&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $tbProdutosId;?>&configCaixaSelecao=<?php echo $GLOBALS['configProdutosFiltroGenerico21CaixaSelecao'];?>', '', '', '');
                                            divShow('divManutencaoAjax');
                                            HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_produtos_complemento&tipoComplemento=32&tipoRetorno=3&idItem=<?php echo $tbProdutosId;?>\', \'idsProdutosFiltroGenerico21\', \'<?php echo $GLOBALS['configProdutosFiltroGenerico21CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                    <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    <img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                </a>
                            <?php } ?>                                
                        <?php } ?>                                
                    </div>
                </div>
                <div style="position: absolute; display: block; top: 108px; left: 430px;">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc16'], "IncludeConfig"); ?>:
                    </div>
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc16'] == 1){ ?>
                            <input type="text" name="informacao_complementar16" id="informacao_complementar16" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbProdutosIC16;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosBoxIc16'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar16" id="informacao_complementar16" class="AdmCampoTextoMultilinha01" style="width: 147px;"><?php echo $tbProdutosIC16;?></textarea>
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
                                <textarea name="informacao_complementar16" id="informacao_complementar16"><?php echo $tbProdutosIC16;?></textarea>
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
                                <textarea name="informacao_complementar16" id="informacao_complementar16"><?php echo $tbProdutosIC16;?></textarea>
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
                <div style="position: absolute; display: block; top: 213px; left: 5px;">
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
                
                <div style="position: absolute; display: block; top: 250px; left: 5px;">
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
                <div style="position: absolute; display: none; top: 250px; left: 410px;">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPalavrasChave01"); ?>:
                    </div>
                    <div align="left" class="AdmTexto01">
                        <textarea name="palavras_chave" id="palavras_chave" class="AdmCampoTextoMultilinha01" style="width: 160px; height: 80px;"><?php echo $tbProdutosPalavrasChave;?></textarea>
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPalavrasChave02"); ?>
                    </div>
                </div>
                <div style="position: absolute; display: block; top: 250px; left: 430px;">
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
                            <select id="idsProdutosFiltroGenerico24" name="idsProdutosFiltroGenerico24[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01" style="height: 85px; width: 150px;">
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