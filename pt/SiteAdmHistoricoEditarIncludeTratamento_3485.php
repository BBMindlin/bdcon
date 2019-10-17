                        <div style="position: absolute; display: block; top: 4px; left: 5px;">
                            <div align="left" class="AdmTexto01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoVinculo2Nome'], "IncludeConfig"); ?>:
                            </div>
                            <div class="AdmTexto01">
                                <?php 
                                    $arrHistoricoVinculo2 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbHistoricoVinculo2'], $GLOBALS['configIdTbTipoHistoricoVinculo2'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoHistoricoVinculo2'], $GLOBALS['configHistoricoVinculo2Metodo']);
                                ?>
                                <select name="id_tb_cadastro2" id="id_tb_cadastro2" class="AdmCampoDropDownMenu01" style="width: 180px;">
                                    <option value="0"<?php if($tbHistoricoIdTbCadastro2 == 0){ ?>selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNenhumDropDown"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoVinculo2); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoVinculo2[$countArray][0];?>"<?php if($arrHistoricoVinculo2[$countArray][0] == $tbHistoricoIdTbCadastro2){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoVinculo2[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div style="position: absolute; display: block; top: 4px; left: 205px;">
                            <div align="left" class="AdmTexto01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico03Nome'], "IncludeConfig"); ?>: 
                            </div>
                            <div class="AdmTexto01">
                                <?php
                                //Seleção de ids selecionados para o registro.
                                $arrHistoricoFiltroGenerico03Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "14", "", ",", "", "1"));
                                ?>
        
                                <?php 
                                $arrHistoricoFiltroGenerico03 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 14);
                                ?>
                                
                                <?php if($GLOBALS['configHistoricoFiltroGenerico03CaixaSelecao'] == 1){ ?>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico03); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input name="idsHistoricoFiltroGenerico03[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico03[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico03[$countArray][0], $arrHistoricoFiltroGenerico03Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico03[$countArray][1];?>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                <?php } ?>
                                <?php if($GLOBALS['configHistoricoFiltroGenerico03CaixaSelecao'] == 2){ ?>
                                    <select id="idsHistoricoFiltroGenerico03" name="idsHistoricoFiltroGenerico03[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico03); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrHistoricoFiltroGenerico03[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico03[$countArray][0], $arrHistoricoFiltroGenerico03Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico03[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select> 
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                <?php } ?>
                                <?php if($GLOBALS['configHistoricoFiltroGenerico03CaixaSelecao'] == 3){ ?>
                                    <select id="idsHistoricoFiltroGenerico03" name="idsHistoricoFiltroGenerico03[]" class="AdmCampoDropDownMenu01" style="width: 130px;">
                                        <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico03); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrHistoricoFiltroGenerico03[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico03[$countArray][0], $arrHistoricoFiltroGenerico03Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico03[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select>
                                <?php } ?>
                                
                                <?php 
                                $flagManutencaoLink = $configManutencaoLinkFlag;
                                if($configManutencaoLinkFlag != true)
                                {
                                    if(empty($arrHistoricoFiltroGenerico03))
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
                                        <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=14&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                        </a>
                                    <?php } ?>
                                    <?php if($configManutencaoLink == 3){ ?>
                                        <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=14&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $idTbHistorico;?>&configCaixaSelecao=<?php echo $GLOBALS['configHistoricoFiltroGenerico03CaixaSelecao'];?>', '', '', '');
                                                    divShow('divManutencaoAjax');
                                                    HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=14&tipoRetorno=3&idItem=<?php echo $idTbHistorico;?>\', \'idsHistoricoFiltroGenerico03\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico03CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                            <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            <img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                        </a>
                                    <?php } ?>                                
                                <?php } ?>
                            </div>
                        </div>
                        
                        <div style="position: absolute; display: block; top: 37px; left: 5px;">
                            <div align="left" class="AdmTexto01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc3'], "IncludeConfig"); ?>:
                            </div>
                            <div>
                                <?php if($GLOBALS['configHistoricoBoxIc3'] == 1){ ?>
                                    <input type="text" name="informacao_complementar3" id="informacao_complementar3" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC3;?>" />
                                <?php } ?>
                                <?php if($GLOBALS['configHistoricoBoxIc3'] == 2){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar3" id="informacao_complementar3" class="AdmCampoTextoMultilinha01" style="width: 461px; height: 30px;"><?php echo $tbHistoricoIC3;?></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação básica (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                        
                                        <script type="text/javascript">
                                            //Caixa básica.
                                            $(document).ready(function () {
                                                $("#informacao_complementar3").cleditor(
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
                                        <textarea name="informacao_complementar3" id="informacao_complementar3"><?php echo $tbHistoricoIC3;?></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação avançada (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $("#informacao_complementar3").cleditor(
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
                                        <textarea name="informacao_complementar3" id="informacao_complementar3"><?php echo $tbHistoricoIC3;?></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                        
                        <div style="position: absolute; display: block; top: 88px; left: 5px;">
                            <div align="left" class="AdmTexto01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico04Nome'], "IncludeConfig"); ?>: 
                            </div>
                            <div class="AdmTexto01">
                                <?php
                                //Seleção de ids selecionados para o registro.
                                $arrHistoricoFiltroGenerico04Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "15", "", ",", "", "1"));
                                ?>
                            
                                <?php 
                                $arrHistoricoFiltroGenerico04 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 15);
                                ?>
                                
                                <?php if($GLOBALS['configHistoricoFiltroGenerico04CaixaSelecao'] == 1){ ?>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico04); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input name="idsHistoricoFiltroGenerico04[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico04[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico04[$countArray][0], $arrHistoricoFiltroGenerico04Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico04[$countArray][1];?>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                <?php } ?>
                                <?php if($GLOBALS['configHistoricoFiltroGenerico04CaixaSelecao'] == 2){ ?>
                                    <select id="idsHistoricoFiltroGenerico04" name="idsHistoricoFiltroGenerico04[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01" style="width: 130px;">
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico04); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrHistoricoFiltroGenerico04[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico04[$countArray][0], $arrHistoricoFiltroGenerico04Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico04[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select> 
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                <?php } ?>
                                <?php if($GLOBALS['configHistoricoFiltroGenerico04CaixaSelecao'] == 3){ ?>
                                    <select id="idsHistoricoFiltroGenerico04" name="idsHistoricoFiltroGenerico04[]" class="AdmCampoDropDownMenu01">
                                        <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico04); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrHistoricoFiltroGenerico04[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico04[$countArray][0], $arrHistoricoFiltroGenerico04Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico04[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select>
                                <?php } ?>
                                
                                <?php 
                                $flagManutencaoLink = $configManutencaoLinkFlag;
                                if($configManutencaoLinkFlag != true)
                                {
                                    if(empty($arrHistoricoFiltroGenerico04))
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
                                        <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=15&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                        </a>
                                    <?php } ?>
                                    <?php if($configManutencaoLink == 3){ ?>
                                        <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=15&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $idTbHistorico;?>&configCaixaSelecao=<?php echo $GLOBALS['configHistoricoFiltroGenerico04CaixaSelecao'];?>', '', '', '');
                                                    divShow('divManutencaoAjax');
                                                    HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=15&tipoRetorno=3&idItem=<?php echo $idTbHistorico;?>\', \'idsHistoricoFiltroGenerico04\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico04CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                 <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img id="imgManutencao04" src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                        <div style="position: absolute; display: block; top: 88px; left: 205px;">
                            <div align="left" class="AdmTexto01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc4'], "IncludeConfig"); ?>:
                            </div>
                            <div>
                                <?php if($GLOBALS['configHistoricoBoxIc4'] == 1){ ?>
                                    <input type="text" name="informacao_complementar4" id="informacao_complementar4" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC4;?>" />
                                <?php } ?>
                                <?php if($GLOBALS['configHistoricoBoxIc4'] == 2){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar4" id="informacao_complementar4" class="AdmCampoTextoMultilinha01" style="width: 260px; height: 30px;"><?php echo $tbHistoricoIC4;?></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação básica (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                        
                                        <script type="text/javascript">
                                            //Caixa básica.
                                            $(document).ready(function () {
                                                $("#informacao_complementar4").cleditor(
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
                                        <textarea name="informacao_complementar4" id="informacao_complementar4"><?php echo $tbHistoricoIC4;?></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação avançada (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $("#informacao_complementar4").cleditor(
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
                                        <textarea name="informacao_complementar4" id="informacao_complementar4"><?php echo $tbHistoricoIC4;?></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                        
                        <!--Limpeza com solvente.-->
                    	<div class="DivCantoArredondado02" style="position: absolute; display: block; top: 152px; left: 5px; width: 470px; height: 72px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div class="DivAbaInfo02" style="">
                                Limpeza com solvente
                            </div>
                            
                            <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc59'], "IncludeConfig"); ?>:
                                </div>
                                <div>
                                    <?php if($GLOBALS['configHistoricoBoxIc59'] == 1){ ?>
                                        <input type="text" name="informacao_complementar59" id="informacao_complementar59" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC59;?>" />
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoBoxIc59'] == 2){ ?>
                                        <?php //Sem formatação.?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                            <textarea name="informacao_complementar59" id="informacao_complementar59" class="AdmCampoTextoMultilinha01" style="width: 169px; height: 50px;"><?php echo $tbHistoricoIC59;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação básica (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                            
                                            <script type="text/javascript">
                                                //Caixa básica.
                                                $(document).ready(function () {
                                                    $("#informacao_complementar59").cleditor(
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
                                            <textarea name="informacao_complementar59" id="informacao_complementar59"><?php echo $tbHistoricoIC59;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação avançada (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                            <script type="text/javascript">
                                                $(document).ready(function () {
                                                    $("#informacao_complementar59").cleditor(
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
                                            <textarea name="informacao_complementar59" id="informacao_complementar59"><?php echo $tbHistoricoIC59;?></textarea>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                            <div style="position: absolute; display: block; top: 0px; left: 200px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc60'], "IncludeConfig"); ?>:
                                </div>
                                <div>
                                    <?php if($GLOBALS['configHistoricoBoxIc60'] == 1){ ?>
                                        <input type="text" name="informacao_complementar60" id="informacao_complementar60" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC60;?>" />
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoBoxIc50'] == 2){ ?>
                                        <?php //Sem formatação.?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                            <textarea name="informacao_complementar60" id="informacao_complementar60" class="AdmCampoTextoMultilinha01" style="width: 259px; height: 50px;"><?php echo $tbHistoricoIC60;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação básica (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                            
                                            <script type="text/javascript">
                                                //Caixa básica.
                                                $(document).ready(function () {
                                                    $("#informacao_complementar60").cleditor(
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
                                            <textarea name="informacao_complementar60" id="informacao_complementar60"><?php echo $tbHistoricoIC60;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação avançada (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                            <script type="text/javascript">
                                                $(document).ready(function () {
                                                    $("#informacao_complementar60").cleditor(
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
                                            <textarea name="informacao_complementar60" id="informacao_complementar60"><?php echo $tbHistoricoIC60;?></textarea>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        
                        <div style="position: absolute; display: block; top: 230px; left: 5px;">
                            <div align="left" class="AdmTexto01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc5'], "IncludeConfig"); ?>:
                            </div>
                            <div>
                                <?php if($GLOBALS['configHistoricoBoxIc5'] == 1){ ?>
                                    <input type="text" name="informacao_complementar5" id="informacao_complementar5" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC5;?>" />
                                <?php } ?>
                                <?php if($GLOBALS['configHistoricoBoxIc5'] == 2){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar5" id="informacao_complementar5" class="AdmCampoTextoMultilinha01" style="width: 461px; height: 30px;"><?php echo $tbHistoricoIC5;?></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação básica (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                        
                                        <script type="text/javascript">
                                            //Caixa básica.
                                            $(document).ready(function () {
                                                $("#informacao_complementar5").cleditor(
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
                                        <textarea name="informacao_complementar5" id="informacao_complementar5"><?php echo $tbHistoricoIC5;?></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação avançada (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $("#informacao_complementar5").cleditor(
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
                                        <textarea name="informacao_complementar5" id="informacao_complementar5"><?php echo $tbHistoricoIC5;?></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                        
                        <div style="position: absolute; display: block; top: 281px; left: 5px;">
                            <div align="left" class="AdmTexto01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc53'], "IncludeConfig"); ?>:
                            </div>
                            <div>
                                <?php if($GLOBALS['configHistoricoBoxIc53'] == 1){ ?>
                                    <input type="text" name="informacao_complementar53" id="informacao_complementar53" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC53;?>" />
                                <?php } ?>
                                <?php if($GLOBALS['configHistoricoBoxIc53'] == 2){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar53" id="informacao_complementar53" class="AdmCampoTextoMultilinha01" style="width: 461px; height: 30px;"><?php echo $tbHistoricoIC53;?></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação básica (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                        
                                        <script type="text/javascript">
                                            //Caixa básica.
                                            $(document).ready(function () {
                                                $("#informacao_complementar53").cleditor(
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
                                        <textarea name="informacao_complementar53" id="informacao_complementar53"><?php echo $tbHistoricoIC53;?></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação avançada (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $("#informacao_complementar53").cleditor(
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
                                        <textarea name="informacao_complementar53" id="informacao_complementar53"><?php echo $tbHistoricoIC53;?></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                        
                        <!--Consolidação do Suporte.-->
                    	<div class="DivCantoArredondado02" style="position: absolute; display: block; top: 346px; left: 5px; width: 470px; height: 83px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div class="DivAbaInfo02" style="">
                                Consolidação do Suporte
                            </div>
                            
                            <div style="position: absolute; display: block; top: 3px; left: 5px;">
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
                            <div style="position: absolute; display: block; top: 3px; left: 259px;">
                                <div align="left" class="AdmTexto01" style="position: absolute; top: 0px; left: -50px;">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc17'], "IncludeConfig"); ?>:
                                </div>
                                <div style="display: inline-block;">
                                    <?php if($GLOBALS['configHistoricoBoxIc17'] == 1){ ?>
                                        <input type="text" name="informacao_complementar17" id="informacao_complementar17" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC17;?>" />
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoBoxIc17'] == 2){ ?>
                                        <?php //Sem formatação.?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                            <textarea name="informacao_complementar17" id="informacao_complementar17" class="AdmCampoTextoMultilinha01" style="width: 200px; height: 69px;"><?php echo $tbHistoricoIC17;?></textarea>
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
                            
                            <div style="position: absolute; display: block; top: 43px; left: 5px;">
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
                        
                        <div style="position: absolute; display: block; top: 433px; left: 5px;">
                            <div align="left" class="AdmTexto01">
                                <?php //echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc6'], "IncludeConfig"); ?>
                                Consolida&ccedil;&atilde;o da Imagem / Emuls&atilde;o Fotogr&aacute;fica - Descri&ccedil;&atilde;o:
                            </div>
                            <div>
                                <?php if($GLOBALS['configHistoricoBoxIc6'] == 1){ ?>
                                    <input type="text" name="informacao_complementar6" id="informacao_complementar6" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC6;?>" />
                                <?php } ?>
                                <?php if($GLOBALS['configHistoricoBoxIc6'] == 2){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar6" id="informacao_complementar6" class="AdmCampoTextoMultilinha01" style="width: 460px; height: 52px;"><?php echo $tbHistoricoIC6;?></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação básica (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                        
                                        <script type="text/javascript">
                                            //Caixa básica.
                                            $(document).ready(function () {
                                                $("#informacao_complementar6").cleditor(
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
                                        <textarea name="informacao_complementar6" id="informacao_complementar6"><?php echo $tbHistoricoIC6;?></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação avançada (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $("#informacao_complementar6").cleditor(
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
                                        <textarea name="informacao_complementar6" id="informacao_complementar6"><?php echo $tbHistoricoIC6;?></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                        
                        
                        <!--Reintegração das partes faltantes do suporte.-->
                    	<div class="DivCantoArredondado02" style="position: absolute; display: block; top: 20px; left: 479px; width: 470px; height: 84px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div class="DivAbaInfo02" style="">
                                Reintegração das partes faltantes do suporte
                            </div>
                            
                            <div style="position: absolute; display: block; top: 3px; left: 11px;">
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
                            <div style="position: absolute; display: block; top: 3px; left: 260px;">
                                <div align="left" class="AdmTexto01" style="position: absolute; top: 0px; left: -50px;">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc18'], "IncludeConfig"); ?>:
                                </div>
                                <div style="display: inline-block;">
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
                            
                            <div style="position: absolute; display: block; top: 43px; left: 5px;">
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
                                        <select id="idsHistoricoFiltroGenerico19" name="idsHistoricoFiltroGenerico19[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01"  style="width: 130px;">
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
                        
                        <!--Reintegração Cromática.-->
                    	<div class="DivCantoArredondado02" style="position: absolute; display: block; top: 125px; left: 480px; width: 470px; height: 85px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div class="DivAbaInfo02" style="">
                                Reintegração Cromática
                            </div>
                            
                            <div style="position: absolute; display: block; top: 4px; left: 9px;">
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
                            <div style="position: absolute; display: block; top: 4px; left: 259px;">
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
                    	<div class="DivCantoArredondado02" style="position: absolute; display: block; top: 231px; left: 480px; width: 470px; height: 84px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div class="DivAbaInfo02" style="">
                                Aplanamento
                            </div>
                            
                            <div style="position: absolute; display: block; top: 3px; left: 24px;">
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
                            <div style="position: absolute; display: block; top: 3px; left: 260px;">
                                <div align="left" class="AdmTexto01" style="position: absolute; top: 0px; left: -50px;">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc20'], "IncludeConfig"); ?>:
                                </div>
                                <div style="display: inline-block;">
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
                        
                        <div style="position: absolute; display: block; top: 324px; left: 480px;">
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
                                        <textarea name="informacao_complementar21" id="informacao_complementar21" class="AdmCampoTextoMultilinha01" style="width: 462px; height: 161px;"><?php echo $tbHistoricoIC21;?></textarea>
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
