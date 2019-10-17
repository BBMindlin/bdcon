<?php
//Definição de variáveis.
$IdTbArquivos = $includeArquivos_idTbArquivos;
$TipoVisualizacao = $includeArquivos_tipoVisualizacao; //1 - arquivos download | 11 - imagens sem redimensionamento (slide show) | 12 - imagens sem redimensionamento (list scroll)
$ConfigArquivosNColunas = $includeArquivos_configArquivosNColunas;

$LimiteRegistros = $includeArquivos_limiteRegistros;
$NImagensVisivelScroll = $includeArquivos_nImagensVisivelScroll;


//Verificação de erro - debug.
//echo "TipoDiagramacao=" . $TipoDiagramacao . "<br />";
//echo "StrTabelaComplemento=" . $StrTabelaComplemento . "<br />";
//echo "TipoComplemento=" . $TipoComplemento . "<br />";


//Query de pesquisa.
//----------
$strSqlArquivosSelect = "";
$strSqlArquivosSelect .= "SELECT ";
//$strSqlArquivosSelect .= "* ";
$strSqlArquivosSelect .= "id, ";
$strSqlArquivosSelect .= "id_parent, ";
$strSqlArquivosSelect .= "data_arquivo, ";
$strSqlArquivosSelect .= "tipo_arquivo, ";
$strSqlArquivosSelect .= "n_classificacao, ";
$strSqlArquivosSelect .= "arquivo, ";
$strSqlArquivosSelect .= "arquivo_tumbnail, ";
$strSqlArquivosSelect .= "tamanho_arquivo, ";
$strSqlArquivosSelect .= "duracao_arquivo, ";
$strSqlArquivosSelect .= "dimensao_arquivo, ";
$strSqlArquivosSelect .= "titulo, ";
$strSqlArquivosSelect .= "legenda, ";
$strSqlArquivosSelect .= "descricao, ";
$strSqlArquivosSelect .= "codigo_html, ";
$strSqlArquivosSelect .= "informacao_complementar1, ";
$strSqlArquivosSelect .= "informacao_complementar2, ";
$strSqlArquivosSelect .= "informacao_complementar3, ";
$strSqlArquivosSelect .= "informacao_complementar4, ";
$strSqlArquivosSelect .= "informacao_complementar5, ";
$strSqlArquivosSelect .= "palavras_chave, ";
$strSqlArquivosSelect .= "config_arquivo, ";
$strSqlArquivosSelect .= "n_visitas ";
$strSqlArquivosSelect .= "FROM tb_arquivos ";
$strSqlArquivosSelect .= "WHERE id <> 0 ";
$strSqlArquivosSelect .= "AND id_parent = :id_parent ";
$strSqlArquivosSelect .= "AND tipo_arquivo = 3 ";
$strSqlArquivosSelect .= "ORDER BY " . $GLOBALS['configClassificacaoArquivos'] . " ";
//----------


//Parâmetros.
//----------
$statementArquivosSelect = $dbSistemaConPDO->prepare($strSqlArquivosSelect);

if ($statementArquivosSelect !== false)
{
	$statementArquivosSelect->execute(array(
		"id_parent" => $IdTbArquivos
	));
}
//----------


//$resultadoArquivos = $dbSistemaConPDO->query($strSqlArquivosSelect);
$resultadoArquivos = $statementArquivosSelect->fetchAll();
?>


<?php if(!empty($resultadoArquivos)){?>
<div class="TabelaIncludeTitulo01">
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteArquivosArquivosTitulo");?>
</div>
<?php } ?>


<?php if(!empty($resultadoArquivos)){?>
	<?php //Diagramação 1 (download).?>
    <?php //**************************************************************************************?>
    <?php if($TipoVisualizacao == "1"){ ?>
        <div align="center" class="LoginTexto">
			<?php
            //Loop pelos resultados.
            foreach($resultadoArquivos as $linhaArquivos)
            {
            ?>
            
                <div align="center" class="">
                    <?php if($linhaArquivos['arquivo'] <> ""){ ?>
                        <?php 
                        //Rotina para ajudar a verificar a extensão do arquivo.
                        $arrArquivoExtensao = explode(".", $linhaArquivos['arquivo']);
                        $arquivoExtensao = strtolower(end($arrArquivoExtensao));
                        ?>
                        
                        <?php //Download. ?>
                        <?php if($linhaArquivos['config_arquivo'] == 3){ ?>
                            <?php if(strpos($GLOBALS['configImagensFormatos'], $arquivoExtensao) !== false) {?>
                                <a href="../<?php echo $GLOBALS['configDiretorioSistema'];?>/<?php echo "ArquivosDownload.php?nomeArquivo=" . "o" . $linhaArquivos['arquivo']; //Imagens - incluir 'o' na frente do nome do arquivo.?>" target="_blank" class="ArquivosLinks">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($linhaArquivos['legenda']); ?>
                                </a>
                            <?php }else{ ?>
                                <a href="../<?php echo $GLOBALS['configDiretorioSistema'];?>/<?php echo "ArquivosDownload.php?nomeArquivo=" . $linhaArquivos['arquivo'];?>" target="_blank" class="ArquivosLinks">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($linhaArquivos['legenda']); ?>
                                </a>
                            <?php } ?>
                        <?php } ?>
                    
                        <?php //Direto para mídia. ?>
                        <?php if($linhaArquivos['config_arquivo'] == 4){ ?>
                            <a href="../<?php echo $GLOBALS['configDiretorioSistema'];?>/<?php echo $GLOBALS['configDiretorioArquivos'];?>/<?php echo $linhaArquivos['arquivo'];?>" target="_blank" class="ArquivosLinks">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaArquivos['legenda']); ?>
                            </a>
                        <?php } ?>
                    <?php } ?>
                </div>
            
                <!--div align="center" class="ArquivosLegenda">
                    (<?php echo Funcoes::ConteudoMascaraLeitura($linhaArquivos['tamanho_arquivo']);?>)
                </div-->
                <div align="center" class="ArquivosDescricao">
                    <?php echo Funcoes::ConteudoMascaraLeitura($linhaArquivos['descricao']);?>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
    <?php //**************************************************************************************?>
    
    
	<?php //Diagramação 11 - Imagens sem redimensionamento (slide show).?>
    <?php //**************************************************************************************?>
    <?php if($TipoVisualizacao == "11"){ ?>
        <div align="center" class="ArquivosLegenda" style="position: relative; display: block; overflow: hidden;">
            <div class="carousel carousel-fade slide" id="myCarousel" style="margin-top: 0px;">
                <?php //Imagens e legedas. ?>
                <div class="carousel-inner">
						<?php
						$countArray = 0;
						
                        //Loop pelos resultados.
                        foreach($resultadoArquivos as $linhaArquivos)
                        {
                        ?>


                        <?php if($countArray == 0){ ?>
                        <div class="item active">
                        <?php }else{ ?>
                        <div class="item">
                        <?php } ?>
                            <div align="center" class="bannerImage">
                                <!--a href="<%=VariaveisGlobais.configCaminhoSiteImagens & "g" & arrImagensTipoVisualizacao11(countArray).Trim()%>" rel="lightbox-<%= arrImagensTipoVisualizacao11(countArray).Trim()%>" title="<%= DbFuncoes.GetCampoGenerico03("tb_arquivos", "legenda", "arquivo", arrImagensTipoVisualizacao11(countArray).Trim(), 2)%>">
                                </a-->
                                <img src="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>o<?php echo $linhaArquivos['arquivo'];?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaArquivos['legenda']);?>" />
                            </div>
                            <div align="center" class="caption row-fluid">
                                <div class="ArquivosLegenda">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($linhaArquivos['legenda']); ?>
                                </div>
                            </div>
                        </div>
    
					<?php 
						$countArray++;
					}
					?>
                </div>
    
                <?php //Controles scroll. ?>
                <div class="control-box" style="display: none;">         
                    <a data-slide="prev" href="#myCarousel" class="carousel-control left" style="margin-left: 20px; margin-top: 20px;">
                        <img alt="" src="../imagens_globais/SetaImagemDireita.png" />
                    </a> 
                    <a data-slide="next" href="#myCarousel" class="carousel-control right" style="margin-right: 20px; margin-top: 20px;">
                        <img alt="" src="../imagens_globais/SetaImagemEsquerda.png" />
                    </a>
    
                    <!--
                    <a data-slide="prev" href="#myCarousel" class="carousel-control left">‹</a>
                    <a data-slide="next" href="#myCarousel" class="carousel-control right">›</a>
                    -->
                </div> 
            </div>
    
            <script language="JavaScript" type="text/javascript">
                // Carousel Auto-Cycle
                // Colocar o código para fazer funcionar em AJAX (cadastro, atendimento, etc)
                $(document).ready(function () {
                    $('.carousel').carousel({
                        interval: 6000
                    })
                });
            </script>
        </div>
    <?php } ?>
    <?php //**************************************************************************************?>

    
	<?php //Diagramação 12 - imagens sem redimensionamento (list scroll).?>
    <?php //**************************************************************************************?>
    <?php if($TipoVisualizacao == "12"){ ?>
        <div align="center" class="ArquivosLegenda" style="position: relative; display: block; overflow: hidden;">
			<script type="text/javascript">
                $(document).ready(function() 
                {
                    $("#lista1").als({
                        visible_items: <?php echo $NImagensVisivelScroll; ?>,
                        scrolling_items: 1,
                        orientation: "horizontal",
                        circular: "yes",
                        autoscroll: "no",
                        interval: 5000,
                        speed: 500,
                        easing: "linear",
                        direction: "right",
                        start_from: 0
                    });
                    
                });
            </script>
            <div id="lista1" class="als-container" style="width: 1140px; margin: 0px auto 80px auto; ">
                <div class="als-viewport">
                    <ul class="als-wrapper">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoArquivos as $linhaArquivos)
                        {
                        ?>
                            <li class="als-item" style="margin: 0px 0px; min-height: 90px; min-width: 270px;"><img src="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>o<?php echo $linhaArquivos['arquivo'];?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaArquivos['legenda']);?>" title="<?php echo Funcoes::ConteudoMascaraLeitura($linhaArquivos['legenda']);?>" style="position: relative; display: block; vertical-align: middle; margin-bottom: 0px;" /><?php echo Funcoes::ConteudoMascaraLeitura($linhaArquivos['legenda']);?></li>
                        <?php } ?>
                    </ul>
                </div>
                <span class="als-prev" style="top: 40px; left: 0px;"><img src="img/btoPaginasAnterior.png" alt="prev" title="previous" /></span>
                <span class="als-next" style="top: 40px; right: 0px;"><img src="img/btoPaginasProximo.png" alt="next" title="next" /></span>
            </div>
        
        </div>
    <?php } ?>
    <?php //**************************************************************************************?>
<?php } ?>


<?php
//Limpeza de objetos.
//----------
unset($strSqlArquivosSelect);
unset($statementArquivosSelect);
unset($resultadoArquivos);
unset($linhaArquivos);
//----------
?>