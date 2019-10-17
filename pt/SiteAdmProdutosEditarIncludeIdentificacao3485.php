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
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico01Nome'], "IncludeConfig"); ?>: 
                    </div>
                    <div class="AdmTexto01">
                        <?php
						//Seleção de ids selecionados para o registro.
						//echo "FiltrosGenericosSelect03=" . FiltrosGenericosSelect03($tbProdutosId, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", "12", "", ",", "", "1") . "<br />";
						//echo "FiltrosGenericosSelect03=" . DbFuncoes::FiltrosGenericosSelect03($tbProdutosId, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", "12", "", ",", "", "1") . "<br />";
						//FiltrosGenericosSelect03($idRegistro, $srtTabela, $strCampo, $strCampoComplemento, $strTipoComplemento, $strMarcador, $strSeparador, $tabelaComplemento, $tipoRetorno)
						//FiltrosGenericosSelect03($idRegistro, $strTabela, $strCampo, $strCampoComplemento, $strTipoComplemento, $strMarcador, $strSeparador, $tabelaComplemento, $tipoRetorno)
						
						$arrProdutosFiltroGenerico01Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbProdutosId, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", "12", "", ",", "", "1"));
						//echo "arrProdutosFiltroGenerico01Selecao=" . $arrProdutosFiltroGenerico01Selecao[0] . "<br />";
						//echo "in_array=" . in_array("03", $arrProdutosFiltroGenerico01Selecao) . "<br />";
					
						//echo "arrProdutosFiltroGenerico01Selecao=" . $arrProdutosFiltroGenerico01Selecao . "<br />";
						//echo "arrProdutosFiltroGenerico01Selecao[0]=" . $arrProdutosFiltroGenerico01Selecao[0] . "<br />";
						?>
                    
						<?php 
						$arrProdutosFiltroGenerico01 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 12);
                        ?>
                        
                        <?php if($GLOBALS['configProdutosFiltroGenerico01CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico01); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsProdutosFiltroGenerico01[]" type="checkbox" value="<?php echo $arrProdutosFiltroGenerico01[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrProdutosFiltroGenerico01[$countArray][0], $arrProdutosFiltroGenerico01Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrProdutosFiltroGenerico01[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico01CaixaSelecao'] == 2){ ?>
                            <select id="idsProdutosFiltroGenerico01" name="idsProdutosFiltroGenerico01[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico01); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico01[$countArray][0];?>"<?php if(in_array($arrProdutosFiltroGenerico01[$countArray][0], $arrProdutosFiltroGenerico01Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrProdutosFiltroGenerico01[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico01CaixaSelecao'] == 3){ ?>
                            <select id="idsProdutosFiltroGenerico01" name="idsProdutosFiltroGenerico01[]" class="AdmCampoDropDownMenu01" style="width: 300px;">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico01); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico01[$countArray][0];?>"<?php if(in_array($arrProdutosFiltroGenerico01[$countArray][0], $arrProdutosFiltroGenerico01Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrProdutosFiltroGenerico01[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
						<?php 
                        $flagManutencaoLink = $configManutencaoLinkFlag;
                        if($configManutencaoLinkFlag != true)
                        {
                            if(empty($arrProdutosFiltroGenerico01))
                            { 
                                $flagManutencaoLink = true;
                            }else{
                                $flagManutencaoLink = false;
                            }
                        }
						
						//Debug.
						//echo "configManutencaoLinkFlag=" . $configManutencaoLinkFlag . "<br/>";
						//echo "flagManutencaoLink=" . $flagManutencaoLink . "<br/>";
                        ?>
                        <?php if($flagManutencaoLink == true){ ?>
                            <?php if($configManutencaoLink == 1){ ?>
                                <a href="SiteAdmProdutosManutencao.php" class="AdmLinks01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 2){ ?>
                                <a href="SiteAdmProdutosManutencao.php?tipoComplemento=12&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 3){ ?>
                                <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmProdutosManutencao.php?tipoComplemento=12&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $tbProdutosId;?>&configCaixaSelecao=<?php echo $GLOBALS['configProdutosFiltroGenerico01CaixaSelecao'];?>', '', '', '');
                                            divShow('divManutencaoAjax');
                                            HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_produtos_complemento&tipoComplemento=12&tipoRetorno=3&idItem=<?php echo $tbProdutosId;?>\', \'idsProdutosFiltroGenerico01\', \'<?php echo $GLOBALS['configProdutosFiltroGenerico01CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                    <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    <img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                </a>
                            <?php } ?>                                
                        <?php } ?>                                
                    </div>
                </div>
                
                <div style="position: absolute; display: block; top: 35px; left: 5px;">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProduto"); ?>:
                    </div>
                    <div align="left">
                        <input type="text" name="produto" id="produto" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbProdutosProduto;?>" style="width: 265px;" />
                    </div>
                </div>
                <div style="position: absolute; display: block; top: 35px; left: 280px;">
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
                <div style="position: absolute; display: block; top: 35px; left: 370px;">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc13'], "IncludeConfig"); ?>:
                    </div>
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc13'] == 1){ ?>
                            <input type="text" name="informacao_complementar13" id="informacao_complementar13" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbProdutosIC13;?>" style="width: 65px;" />
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosBoxIc13'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar13" id="informacao_complementar13" class="AdmCampoTextoMultilinha01"><?php echo $tbProdutosIC13;?></textarea>
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
                                <textarea name="informacao_complementar13" id="informacao_complementar13"><?php echo $tbProdutosIC13;?></textarea>
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
                                <textarea name="informacao_complementar13" id="informacao_complementar13"><?php echo $tbProdutosIC13;?></textarea>

                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
                <div style="position: absolute; display: block; top: 35px; left: 455px;">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico14Nome'], "IncludeConfig"); ?>: 
                    </div>
                    <div class="AdmTexto01">
                        <?php
						//Seleção de ids selecionados para o registro.
						$arrProdutosFiltroGenerico14Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbProdutosId, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", "25", "", ",", "", "1"));
						?>
                    
						<?php 
						$arrProdutosFiltroGenerico14 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 25);
                        ?>
                        
                        <?php if($GLOBALS['configProdutosFiltroGenerico14CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico14); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsProdutosFiltroGenerico14[]" type="checkbox" value="<?php echo $arrProdutosFiltroGenerico14[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrProdutosFiltroGenerico14[$countArray][0], $arrProdutosFiltroGenerico14Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrProdutosFiltroGenerico14[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico14CaixaSelecao'] == 2){ ?>
                            <select id="idsProdutosFiltroGenerico14" name="idsProdutosFiltroGenerico14[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico14); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico14[$countArray][0];?>"<?php if(in_array($arrProdutosFiltroGenerico14[$countArray][0], $arrProdutosFiltroGenerico14Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrProdutosFiltroGenerico14[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico14CaixaSelecao'] == 3){ ?>
                            <select id="idsProdutosFiltroGenerico14" name="idsProdutosFiltroGenerico14[]" class="AdmCampoDropDownMenu01" style="width: 124px;">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico14); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico14[$countArray][0];?>"<?php if(in_array($arrProdutosFiltroGenerico14[$countArray][0], $arrProdutosFiltroGenerico14Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrProdutosFiltroGenerico14[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
						<?php 
                        $flagManutencaoLink = $configManutencaoLinkFlag;
                        if($configManutencaoLinkFlag != true)
                        {
                            if(empty($arrProdutosFiltroGenerico14))
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
                                <a href="SiteAdmProdutosManutencao.php?tipoComplemento=25&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 3){ ?>
                                <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmProdutosManutencao.php?tipoComplemento=25&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $tbProdutosId;?>&configCaixaSelecao=<?php echo $GLOBALS['configProdutosFiltroGenerico24CaixaSelecao'];?>', '', '', '');
                                            divShow('divManutencaoAjax');
                                            HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_produtos_complemento&tipoComplemento=25&tipoRetorno=3&idItem=<?php echo $tbProdutosId;?>\', \'idsProdutosFiltroGenerico24\', \'<?php echo $GLOBALS['configProdutosFiltroGenerico24CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                    <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    <img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                </a>
                            <?php } ?>                                
                        <?php } ?>                                
                    </div>
                </div>
                
                <div style="position: absolute; display: block; top: 68px; left: 5px;">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosDescricao02Titulo'], "IncludeConfig"); ?>: 
                    </div>
                    <div>
                        <?php //Sem formatação.?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                            <textarea name="descricao02" id="descricao02" class="AdmCampoTextoMultilinha01" style="width: 568px; height: 25px;"><?php echo $tbProdutosDescricao02;?></textarea>
                        <?php } ?>
                        
                        <?php //Formatação básica (CLEditor).?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                            
                            <script type="text/javascript">
                                //Caixa básica.
                                $(document).ready(function () {
                                    $("#descricao02").cleditor(
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
                            <textarea name="descricao02" id="descricao02"><?php echo $tbProdutosDescricao02;?></textarea>
                        <?php } ?>
                        
                        <?php //Formatação avançada (CLEditor).?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                            <script type="text/javascript">
                                $(document).ready(function () {
                                    $("#descricao02").cleditor(
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
                            <textarea name="descricao02" id="descricao02"><?php echo $tbProdutosDescricao02;?></textarea>
                        <?php } ?>
                    </div>
                </div>
                
                <div style="position: absolute; display: block; top: 112px; left: 5px;">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosDescricao03Titulo'], "IncludeConfig"); ?>: 
                    </div>
                    <div>
                        <?php //Sem formatação.?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                            <textarea name="descricao03" id="descricao03" class="AdmCampoTextoMultilinha01" style="width: 568px; height: 25px;"><?php echo $tbProdutosDescricao03;?></textarea>
                        <?php } ?>
                        
                        <?php //Formatação básica (CLEditor).?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                            
                            <script type="text/javascript">
                                //Caixa básica.
                                $(document).ready(function () {
                                    $("#descricao03").cleditor(
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
                            <textarea name="descricao03" id="descricao03"><?php echo $tbProdutosDescricao03;?></textarea>
                        <?php } ?>
                        
                        <?php //Formatação avançada (CLEditor).?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                            <script type="text/javascript">
                                $(document).ready(function () {
                                    $("#descricao03").cleditor(
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
                            <textarea name="descricao03" id="descricao03"><?php echo $tbProdutosDescricao03;?></textarea>
                        <?php } ?>
                    </div>
                </div>
                
                <div style="position: absolute; display: block; top: 156px; left: 5px;">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico15Nome'], "IncludeConfig"); ?>: 
                    </div>
                    <div class="AdmTexto01">
                        <?php
						//Seleção de ids selecionados para o registro.
						$arrProdutosFiltroGenerico15Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbProdutosId, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", "26", "", ",", "", "1"));
						?>
                    
						<?php 
						$arrProdutosFiltroGenerico15 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 26);
                        ?>
                        
                        <?php if($GLOBALS['configProdutosFiltroGenerico15CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico15); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsProdutosFiltroGenerico15[]" type="checkbox" value="<?php echo $arrProdutosFiltroGenerico15[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrProdutosFiltroGenerico15[$countArray][0], $arrProdutosFiltroGenerico15Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrProdutosFiltroGenerico15[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico15CaixaSelecao'] == 2){ ?>
                            <select id="idsProdutosFiltroGenerico15" name="idsProdutosFiltroGenerico15[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico15); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico15[$countArray][0];?>"<?php if(in_array($arrProdutosFiltroGenerico15[$countArray][0], $arrProdutosFiltroGenerico15Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrProdutosFiltroGenerico15[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico15CaixaSelecao'] == 3){ ?>
                            <select id="idsProdutosFiltroGenerico15" name="idsProdutosFiltroGenerico15[]" class="AdmCampoDropDownMenu01" style="width: 120px;">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico15); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico15[$countArray][0];?>"<?php if(in_array($arrProdutosFiltroGenerico15[$countArray][0], $arrProdutosFiltroGenerico15Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrProdutosFiltroGenerico15[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
						<?php 
                        $flagManutencaoLink = $configManutencaoLinkFlag;
                        if($configManutencaoLinkFlag != true)
                        {
                            if(empty($arrProdutosFiltroGenerico15))
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
                                <a href="SiteAdmProdutosManutencao.php?tipoComplemento=26&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 3){ ?>
                                <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmProdutosManutencao.php?tipoComplemento=26&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $tbProdutosId;?>&configCaixaSelecao=<?php echo $GLOBALS['configProdutosFiltroGenerico15CaixaSelecao'];?>', '', '', '');
                                            divShow('divManutencaoAjax');
                                            HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_produtos_complemento&tipoComplemento=26&tipoRetorno=3&idItem=<?php echo $tbProdutosId;?>\', \'idsProdutosFiltroGenerico15\', \'<?php echo $GLOBALS['configProdutosFiltroGenerico15CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                    <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    <img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                </a>
                            <?php } ?>                                
                        <?php } ?>                                
                    </div>
                </div>
                <div style="position: absolute; display: block; top: 156px; left: 180px;">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc15'], "IncludeConfig"); ?>:
                    </div>
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc15'] == 1){ ?>
                            <input type="text" name="informacao_complementar15" id="informacao_complementar15" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbProdutosIC15;?>" style="width: 260px;" />
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosBoxIc15'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar15" id="informacao_complementar15" class="AdmCampoTextoMultilinha01"><?php echo $tbProdutosIC15;?></textarea>
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
                                <textarea name="informacao_complementar15" id="informacao_complementar15"><?php echo $tbProdutosIC15;?></textarea>
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
                                <textarea name="informacao_complementar15" id="informacao_complementar15"><?php echo $tbProdutosIC15;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
                <div style="position: absolute; display: block; top: 156px; left: 455px;">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico16Nome'], "IncludeConfig"); ?>: 
                    </div>
                    <div class="AdmTexto01">
                        <?php
						//Seleção de ids selecionados para o registro.
						$arrProdutosFiltroGenerico16Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbProdutosId, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", "27", "", ",", "", "1"));
						?>

						<?php 
						$arrProdutosFiltroGenerico16 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 27);
                        ?>
                        
                        <?php if($GLOBALS['configProdutosFiltroGenerico16CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico16); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsProdutosFiltroGenerico16[]" type="checkbox" value="<?php echo $arrProdutosFiltroGenerico16[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrProdutosFiltroGenerico16[$countArray][0], $arrProdutosFiltroGenerico16Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrProdutosFiltroGenerico16[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico16CaixaSelecao'] == 2){ ?>
                            <select id="idsProdutosFiltroGenerico16" name="idsProdutosFiltroGenerico16[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico16); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico16[$countArray][0];?>"<?php if(in_array($arrProdutosFiltroGenerico16[$countArray][0], $arrProdutosFiltroGenerico16Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrProdutosFiltroGenerico16[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico16CaixaSelecao'] == 3){ ?>
                            <select id="idsProdutosFiltroGenerico16" name="idsProdutosFiltroGenerico16[]" class="AdmCampoDropDownMenu01" style="width: 124px;">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico16); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico16[$countArray][0];?>"<?php if(in_array($arrProdutosFiltroGenerico16[$countArray][0], $arrProdutosFiltroGenerico16Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrProdutosFiltroGenerico16[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
						<?php 
                        $flagManutencaoLink = $configManutencaoLinkFlag;
                        if($configManutencaoLinkFlag != true)
                        {
                            if(empty($arrProdutosFiltroGenerico16))
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
                                <a href="SiteAdmProdutosManutencao.php?tipoComplemento=27&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 3){ ?>
                                <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmProdutosManutencao.php?tipoComplemento=27&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $tbProdutosId;?>&configCaixaSelecao=<?php echo $GLOBALS['configProdutosFiltroGenerico16CaixaSelecao'];?>', '', '', '');
                                            divShow('divManutencaoAjax');
                                            HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_produtos_complemento&tipoComplemento=27&tipoRetorno=3&idItem=<?php echo $tbProdutosId;?>\', \'idsProdutosFiltroGenerico16\', \'<?php echo $GLOBALS['configProdutosFiltroGenerico16CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                    <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    <img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                </a>
                            <?php } ?>                                
                        <?php } ?>                                
                    </div>
                </div>
                
                <div style="position: absolute; display: block; top: 187px; left: 5px;">
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
                                <textarea name="informacao_complementar16" id="informacao_complementar16" class="AdmCampoTextoMultilinha01" style="width: 165px; height: 30px;"><?php echo $tbProdutosIC16;?></textarea>
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
                <div style="position: absolute; display: block; top: 187px; left: 180px;">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico17Nome'], "IncludeConfig"); ?>: 
                    </div>
                    <div class="AdmTexto01">
                        <?php
						//Seleção de ids selecionados para o registro.
						$arrProdutosFiltroGenerico17Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbProdutosId, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", "28", "", ",", "", "1"));
						?>
                    
						<?php 
						$arrProdutosFiltroGenerico17 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 28);
                        ?>
                        
                        <?php if($GLOBALS['configProdutosFiltroGenerico17CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico17); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsProdutosFiltroGenerico17[]" type="checkbox" value="<?php echo $arrProdutosFiltroGenerico17[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrProdutosFiltroGenerico17[$countArray][0], $arrProdutosFiltroGenerico17Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrProdutosFiltroGenerico17[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico17CaixaSelecao'] == 2){ ?>
                            <select id="idsProdutosFiltroGenerico17" name="idsProdutosFiltroGenerico17[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico17); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico17[$countArray][0];?>"<?php if(in_array($arrProdutosFiltroGenerico17[$countArray][0], $arrProdutosFiltroGenerico17Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrProdutosFiltroGenerico17[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico17CaixaSelecao'] == 3){ ?>
                            <select id="idsProdutosFiltroGenerico17" name="idsProdutosFiltroGenerico17[]" class="AdmCampoDropDownMenu01" style="width: 165px;">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico17); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico17[$countArray][0];?>"<?php if(in_array($arrProdutosFiltroGenerico17[$countArray][0], $arrProdutosFiltroGenerico17Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrProdutosFiltroGenerico17[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
						<?php 
                        $flagManutencaoLink = $configManutencaoLinkFlag;
                        if($configManutencaoLinkFlag != true)
                        {
                            if(empty($arrProdutosFiltroGenerico17))
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
                                <a href="SiteAdmProdutosManutencao.php?tipoComplemento=28&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 3){ ?>
                                <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmProdutosManutencao.php?tipoComplemento=28&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $tbProdutosId;?>&configCaixaSelecao=<?php echo $GLOBALS['configProdutosFiltroGenerico17CaixaSelecao'];?>', '', '', '');
                                            divShow('divManutencaoAjax');
                                            HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_produtos_complemento&tipoComplemento=28&tipoRetorno=3&idItem=<?php echo $tbProdutosId;?>\', \'idsProdutosFiltroGenerico17\', \'<?php echo $GLOBALS['configProdutosFiltroGenerico17CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                    <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    <img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                </a>
                            <?php } ?>                                
                        <?php } ?>                                
                    </div>
                </div>
                <div style="position: absolute; display: block; top: 187px; left: 370px;">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc17'], "IncludeConfig"); ?>:
                    </div>
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc17'] == 1){ ?>
                            <input type="text" name="informacao_complementar17" id="informacao_complementar17" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbProdutosIC17;?>" style="width: 207px;"  />
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosBoxIc12'] == 7){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar17" id="informacao_complementar17" class="AdmCampoTextoMultilinha01"><?php echo $tbProdutosIC17;?></textarea>
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
                                <textarea name="informacao_complementar17" id="informacao_complementar17"><?php echo $tbProdutosIC17;?></textarea>
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
                                <textarea name="informacao_complementar17" id="informacao_complementar17"><?php echo $tbProdutosIC17;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
                
                <div style="position: absolute; display: block; top: 236px; left: 5px;">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico18Nome'], "IncludeConfig"); ?>: 
                    </div>
                    <div class="AdmTexto01">
                        <?php
						//Seleção de ids selecionados para o registro.
						$arrProdutosFiltroGenerico18Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbProdutosId, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", "29", "", ",", "", "1"));
						?>

						<?php 
						$arrProdutosFiltroGenerico18 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 29);
                        ?>
                        
                        <?php if($GLOBALS['configProdutosFiltroGenerico18CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico18); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsProdutosFiltroGenerico18[]" type="checkbox" value="<?php echo $arrProdutosFiltroGenerico18[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrProdutosFiltroGenerico18[$countArray][0], $arrProdutosFiltroGenerico18Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrProdutosFiltroGenerico18[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico18CaixaSelecao'] == 2){ ?>
                            <select id="idsProdutosFiltroGenerico18" name="idsProdutosFiltroGenerico18[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico18); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico18[$countArray][0];?>"<?php if(in_array($arrProdutosFiltroGenerico18[$countArray][0], $arrProdutosFiltroGenerico18Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrProdutosFiltroGenerico18[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico18CaixaSelecao'] == 3){ ?>
                            <select id="idsProdutosFiltroGenerico18" name="idsProdutosFiltroGenerico18[]" class="AdmCampoDropDownMenu01" style="width: 120px;">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico18); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico18[$countArray][0];?>"<?php if(in_array($arrProdutosFiltroGenerico18[$countArray][0], $arrProdutosFiltroGenerico18Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrProdutosFiltroGenerico18[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
						<?php 
                        $flagManutencaoLink = $configManutencaoLinkFlag;
                        if($configManutencaoLinkFlag != true)
                        {
                            if(empty($arrProdutosFiltroGenerico18))
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
                                <a href="SiteAdmProdutosManutencao.php?tipoComplemento=29&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 3){ ?>
                                <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmProdutosManutencao.php?tipoComplemento=29&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $tbProdutosId;?>&configCaixaSelecao=<?php echo $GLOBALS['configProdutosFiltroGenerico18CaixaSelecao'];?>', '', '', '');
                                            divShow('divManutencaoAjax');
                                            HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_produtos_complemento&tipoComplemento=29&tipoRetorno=3&idItem=<?php echo $tbProdutosId;?>\', \'idsProdutosFiltroGenerico18\', \'<?php echo $GLOBALS['configProdutosFiltroGenerico18CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                    <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    <img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                </a>
                            <?php } ?>                                
                        <?php } ?>                                
                    </div>
                </div>
                <div style="position: absolute; display: block; top: 236px; left: 180px;">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc18'], "IncludeConfig"); ?>:
                    </div>
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc18'] == 1){ ?>
                            <input type="text" name="informacao_complementar18" id="informacao_complementar18" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbProdutosIC18;?>" style="width: 65px;" />
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
                <div style="position: absolute; display: block; top: 225px; left: 280px;">
                    <div align="left" class="AdmTexto01" style="width: 150px;">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico19Nome'], "IncludeConfig"); ?>: 
                    </div>
                    <div class="AdmTexto01">
                        <?php
						//Seleção de ids selecionados para o registro.
						$arrProdutosFiltroGenerico19Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbProdutosId, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", "30", "", ",", "", "1"));
						?>

						<?php 
						$arrProdutosFiltroGenerico19 = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 30);
                        ?>
                        
                        <?php if($GLOBALS['configProdutosFiltroGenerico19CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico19); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsProdutosFiltroGenerico19[]" type="checkbox" value="<?php echo $arrProdutosFiltroGenerico19[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrProdutosFiltroGenerico19[$countArray][0], $arrProdutosFiltroGenerico19Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrProdutosFiltroGenerico19[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico19CaixaSelecao'] == 2){ ?>
                            <select id="idsProdutosFiltroGenerico19" name="idsProdutosFiltroGenerico19[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico19); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico19[$countArray][0];?>"<?php if(in_array($arrProdutosFiltroGenerico19[$countArray][0], $arrProdutosFiltroGenerico19Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrProdutosFiltroGenerico19[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosFiltroGenerico19CaixaSelecao'] == 3){ ?>
                            <select id="idsProdutosFiltroGenerico19" name="idsProdutosFiltroGenerico19[]" class="AdmCampoDropDownMenu01" style="width: 125px;">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrProdutosFiltroGenerico19); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrProdutosFiltroGenerico19[$countArray][0];?>"<?php if(in_array($arrProdutosFiltroGenerico19[$countArray][0], $arrProdutosFiltroGenerico19Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrProdutosFiltroGenerico19[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
						<?php 
                        $flagManutencaoLink = $configManutencaoLinkFlag;
                        if($configManutencaoLinkFlag != true)
                        {
                            if(empty($arrProdutosFiltroGenerico19))
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
                                <a href="SiteAdmProdutosManutencao.php?tipoComplemento=30&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                </a>
                            <?php } ?>
                            <?php if($configManutencaoLink == 3){ ?>
                                <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmProdutosManutencao.php?tipoComplemento=30&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $tbProdutosId;?>&configCaixaSelecao=<?php echo $GLOBALS['configProdutosFiltroGenerico19CaixaSelecao'];?>', '', '', '');
                                            divShow('divManutencaoAjax');
                                            HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_produtos_complemento&tipoComplemento=30&tipoRetorno=3&idItem=<?php echo $tbProdutosId;?>\', \'idsProdutosFiltroGenerico19\', \'<?php echo $GLOBALS['configProdutosFiltroGenerico19CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                    <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    <img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                </a>
                            <?php } ?>                                
                        <?php } ?>                                
                    </div>
                </div>
                <div style="position: absolute; display: block; top: 236px; left: 455px;">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc19'], "IncludeConfig"); ?>:
                    </div>
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc19'] == 1){ ?>
                            <input type="text" name="informacao_complementar19" id="informacao_complementar19" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbProdutosIC19;?>" style="width: 122px;" />
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosBoxIc19'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar19" id="informacao_complementar19" class="AdmCampoTextoMultilinha01"><?php echo $tbProdutosIC19;?></textarea>
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
                                <textarea name="informacao_complementar19" id="informacao_complementar19"><?php echo $tbProdutosIC19;?></textarea>
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
                                <textarea name="informacao_complementar19" id="informacao_complementar19"><?php echo $tbProdutosIC19;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
                
                <div style="position: absolute; display: block; top: 267px; left: 5px;">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc20'], "IncludeConfig"); ?>:
                    </div>
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc20'] == 1){ ?>
                            <input type="text" name="informacao_complementar20" id="informacao_complementar20" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbProdutosIC20;?>" style="width: 282px;" />
                        <?php } ?>
                        <?php if($GLOBALS['configProdutosBoxIc20'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar20" id="informacao_complementar20" class="AdmCampoTextoMultilinha01"><?php echo $tbProdutosIC20;?></textarea>
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
                                <textarea name="informacao_complementar20" id="informacao_complementar20"><?php echo $tbProdutosIC20;?></textarea>
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
                                <textarea name="informacao_complementar20" id="informacao_complementar20"><?php echo $tbProdutosIC20;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
                <div style="position: absolute; display: block; top: 267px; left: 335px;">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc21'], "IncludeConfig"); ?>:
                    </div>
                    <div>
                        <?php if($GLOBALS['configProdutosBoxIc21'] == 1){ ?>
                            <input type="text" name="informacao_complementar21" id="informacao_complementar21" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbProdutosIC21;?>" style="width: 242px;" />
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
                
                <div style="position: absolute; display: block; top: 298px; left: 5px;">
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
                <div style="position: absolute; display: block; top: 298px; left: 180px;">
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
                
                <div style="position: absolute; display: block; top: 330px; left: 5px;">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosDescricao01Titulo'], "IncludeConfig"); ?>: 
                    </div>
                    <div>
                        <?php //Sem formatação.?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                            <textarea name="descricao01" id="descricao01" class="AdmCampoTextoMultilinha01" style="width: 390px; height: 50px;"><?php echo $tbProdutosDescricao01;?></textarea>
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
                <div style="position: absolute; display: none; top: 330px; left: 410px;">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPalavrasChave01"); ?>:
                    </div>
                    <div align="left" class="AdmTexto01">
                        <textarea name="palavras_chave" id="palavras_chave" class="AdmCampoTextoMultilinha01" style="width: 160px; height: 50px;"><?php echo $tbProdutosPalavrasChave;?></textarea>
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPalavrasChave02"); ?>
                    </div>
                </div>
                <div style="position: absolute; display: block; top: 330px; left: 410px;">
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
                            <select id="idsProdutosFiltroGenerico24" name="idsProdutosFiltroGenerico24[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01" style="width: 168px; height: 55px;">
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