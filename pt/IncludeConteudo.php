<?php
//Definição de variáveis.
$IdParentConteudo = $includeConteudo_idParentConteudo;
$IdTbConteudo = $includeConteudo_idTbConteudo;
$TipoConteudo = $includeConteudo_tipoConteudo; //1 - titulo | 2 - subtitulo | 3 - conteudo | 4 - tab | 5 - imagem | 6 - vídeo | 7 - htm/tabela | 8 - pdf/word/power point/excel/zip | 9 - arte de  newsletter (sem redimentcionamento) | 10 - divisão em colunas | 11 - swf

$ConfigTipoDiagramacao = $includeConteudo_configTipoDiagramacao; //1 - Conteúdo Convencional | 2 - API YouTube
$ConfigConteudoNRegistros = $includeConteudo_configConteudoNRegistros; //""(vazio) - sem limite | 3 (número) - número máximo de registros
$ConfigClassificacaoConteudo = $includeConteudo_configClassificacaoConteudo;


//Verificação de erro - debug.
//echo "IdParentConteudo=" . $IdParentConteudo . "<br />";
//echo "IdTbConteudo=" . $IdTbConteudo . "<br />"; 
//echo "TipoConteudo=" . $TipoConteudo . "<br />";
   

//Query de pesquisa.
//----------
$strSqlConteudoSelect = "";
$strSqlConteudoSelect .= "SELECT ";
$strSqlConteudoSelect .= "id, ";
$strSqlConteudoSelect .= "n_classificacao, ";
$strSqlConteudoSelect .= "id_tb_categorias, ";
$strSqlConteudoSelect .= "id_tb_cadastro, ";
$strSqlConteudoSelect .= "tipo_conteudo, ";
$strSqlConteudoSelect .= "alinhamento_texto, ";
$strSqlConteudoSelect .= "alinhamento_imagem, ";
$strSqlConteudoSelect .= "conteudo, ";
$strSqlConteudoSelect .= "conteudo_link, ";
$strSqlConteudoSelect .= "arquivo, ";
$strSqlConteudoSelect .= "config_arquivo, ";
$strSqlConteudoSelect .= "dimensao_arquivo ";
$strSqlConteudoSelect .= "FROM tb_conteudo ";
$strSqlConteudoSelect .= "WHERE id <> 0 ";
$strSqlConteudoSelect .= "AND id_tb_categorias = :id_tb_categorias ";
if($ConfigClassificacaoConteudo <> "")
{
	$strSqlConteudoSelect .= "ORDER BY " . $ConfigClassificacaoConteudo . " ";
}else{
	$strSqlConteudoSelect .= "ORDER BY " . $GLOBALS['configClassificacaoConteudo'] . " ";
}
//----------


//Inclusão de parâmetros.
//----------
$statementConteudoSelect = $dbSistemaConPDO->prepare($strSqlConteudoSelect);

if ($statementConteudoSelect !== false)
{
	$statementConteudoSelect->execute(array(
		"id_tb_categorias" => $IdParentConteudo
	));
}
//----------


//$resultadoConteudo = $dbSistemaConPDO->query($strSqlConteudoSelect);
$resultadoConteudo = $statementConteudoSelect->fetchAll();
?>

    <?php
	if (empty($resultadoConteudo))
	{
        //echo "Nenhum registro encontrado";
    ?>
        <div align="center" class="TextoErro">
            <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
        </div>
    <?php
    }else{
    ?>
		<?php //Diagramação 1 (Conteúdo Convencional).?>
        <?php //**************************************************************************************?>
        <?php if($ConfigTipoDiagramacao == "1"){ ?>
            <table width="100%">
              <?php
                foreach($resultadoConteudo as $linhaConteudo)
                {
                    //echo "id=" . $linhaConteudo['id'] . "<br />";
              ?>
              <tr>
                <td>
                    <?php //Título. ?>
                    <?php if($linhaConteudo['tipo_conteudo'] == 1){ ?>
                        <div class="ConteudoTitulo" style="text-align: <?php echo Funcoes::AlinhamentoTexto($linhaConteudo['alinhamento_texto']);?>;">
                            <h1 style="margin: 0px; padding: 0px; font-size: inherit; font-weight: inherit;">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);?>
                            </h1>
                        </div>
                    <?php } ?>
                    
                    <?php //Subtítulo. ?>
                    <?php if($linhaConteudo['tipo_conteudo'] == 2){ ?>
                        <div class="ConteudoSubtitulo" style="text-align: <?php echo Funcoes::AlinhamentoTexto($linhaConteudo['alinhamento_texto']);?>;">
                            <h2 style="margin: 0px; padding: 0px; font-size: inherit; font-weight: inherit;">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);?>
                            </h2>
                        </div>
                    <?php } ?>
                    
                    <?php //Texto corrido. ?>
                    <?php if($linhaConteudo['tipo_conteudo'] == 3){ ?>
                        <div class="ConteudoTextoCorrido" style="text-align: <?php echo Funcoes::AlinhamentoTexto($linhaConteudo['alinhamento_texto']);?>;">
                            <?php echo Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);?>
                        </div>
                    <?php } ?>
                    
                    <?php //Tab/Recuo. ?>
                    <?php if($linhaConteudo['tipo_conteudo'] == 4){ ?>
                        <div class="ConteudoTextoCorrido" style="margin-left: 30px; text-align: <?php echo Funcoes::AlinhamentoTexto($linhaConteudo['alinhamento_texto']);?>;">
                            <?php echo Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);?>
                        </div>
                    <?php } ?>
                    
                    <?php //Imagem (com e sem redimensionamento). ?>
                    <?php //**************************************************************************************?>
                    <?php if($linhaConteudo['tipo_conteudo'] == 5 || $linhaConteudo['tipo_conteudo'] == 9){ ?>
                    
                        <?php //Imagem para a esquerda. ?>
                        <?php //---------------------- ?>
                        <?php if($linhaConteudo['alinhamento_imagem'] == 3){ ?>
                            <div>
                                <div class="ConteudoImagemAlinhamentoEsquerda">
									<?php if($linhaConteudo['arquivo'] <> ""){ ?>
                                        <?php if($linhaConteudo['conteudo_link'] == ""){ ?>
                                            <?php //Sem pop-up. ?>
                                            <?php if($GLOBALS['configImagemPopUp'] == 0){ ?>
                                                <?php if($linhaConteudo['tipo_conteudo'] == 5){ ?>
                                                    <img src="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>r<?php echo $linhaConteudo['arquivo'];?>?variavelCache=<?php echo date("s"); ?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);?>" class="ImagemAlinhamentoEsquerda" />
                                                <?php } ?>
                                                <?php if($linhaConteudo['tipo_conteudo'] == 9){ ?>
                                                    <img src="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>o<?php echo $linhaConteudo['arquivo'];?>?variavelCache=<?php echo date("s"); ?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);?>" class="ImagemAlinhamentoEsquerda" />
                                                <?php } ?>
                                            <?php } ?>
                                        
                                            <?php //SlimBox 2 - JQuery. ?>
                                            <?php if($GLOBALS['configImagemPopUp'] == 1){ ?>
                                                <a href="<?php echo $GLOBALS['configDiretorioArquivos'];?>/g<?php echo $linhaConteudo['arquivo'];?>" rel="lightbox" title="">
                                                    <?php if($linhaConteudo['tipo_conteudo'] == 5){ ?>
                                                        <img src="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>r<?php echo $linhaConteudo['arquivo'];?>?variavelCache=<?php echo date("s"); ?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);?>" class="ImagemAlinhamentoEsquerda" />
                                                    <?php } ?>
                                                    <?php if($linhaConteudo['tipo_conteudo'] == 9){ ?>
                                                        <img src="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>o<?php echo $linhaConteudo['arquivo'];?>?variavelCache=<?php echo date("s"); ?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);?>" class="ImagemAlinhamentoEsquerda" />
                                                    <?php } ?>
                                                </a>
                                            <?php } ?>
                                        <?php }else{ ?>
                                            <?php //Imagem com link. ?>
                                            <a href="<?php echo $linhaConteudo['conteudo_link'];?>" target="_blank">
                                                <?php if($linhaConteudo['tipo_conteudo'] == 5){ ?>
                                                    <img src="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>r<?php echo $linhaConteudo['arquivo'];?>?variavelCache=<?php echo date("s"); ?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);?>" class="ImagemAlinhamentoEsquerda" />
                                                <?php } ?>
                                                <?php if($linhaConteudo['tipo_conteudo'] == 9){ ?>
                                                    <img src="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>o<?php echo $linhaConteudo['arquivo'];?>?variavelCache=<?php echo date("s"); ?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);?>" class="ImagemAlinhamentoEsquerda" />
                                                <?php } ?>
                                            </a>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                                <div class="ConteudoTextoCorrido" style="text-align: <?php echo Funcoes::AlinhamentoTexto($linhaConteudo['alinhamento_texto']);?>;">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);?>
                                </div>
                            </div>
                        <?php } ?>
                        <?php //---------------------- ?>
                        
                        <?php //Imagem centralizada. ?>
                        <?php //---------------------- ?>
                        <?php if($linhaConteudo['alinhamento_imagem'] == 2){ ?>
                            <?php if($linhaConteudo['arquivo'] <> ""){ ?>
                                <div align="center">
                                    <?php if($linhaConteudo['conteudo_link'] == ""){ ?>
                                        <?php //Sem pop-up. ?>
                                        <?php if($GLOBALS['configImagemPopUp'] == 0){ ?>
                                            <?php if($linhaConteudo['tipo_conteudo'] == 5){ ?>
                                                <img src="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>/<?php echo $linhaConteudo['arquivo'];?>?variavelCache=<?php echo date("s"); ?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);?>" />
                                            <?php } ?>
                                            <?php if($linhaConteudo['tipo_conteudo'] == 9){ ?>
                                                <img src="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>o<?php echo $linhaConteudo['arquivo'];?>?variavelCache=<?php echo date("s"); ?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);?>" />
                                            <?php } ?>
                                        <?php } ?>
                                    
                                        <?php //SlimBox 2 - JQuery. ?>
                                        <?php if($GLOBALS['configImagemPopUp'] == 1){ ?>
                                            <a href="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>g<?php echo $linhaConteudo['arquivo'];?>" rel="lightbox" title="">
                                                <?php if($linhaConteudo['tipo_conteudo'] == 5){ ?>
                                                    <img src="<?php echo $GLOBALS['configCaminhoSiteImagens'];?><?php echo $linhaConteudo['arquivo'];?>?variavelCache=<?php echo date("s"); ?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);?>" />
                                                <?php } ?>
                                                <?php if($linhaConteudo['tipo_conteudo'] == 9){ ?>
                                                    <img src="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>o<?php echo $linhaConteudo['arquivo'];?>?variavelCache=<?php echo date("s"); ?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);?>" />
                                                <?php } ?>
                                            </a>
                                        <?php } ?>
                                    <?php }else{ ?>
                                        <?php //Imagem com link. ?>
                                        <a href="<?php echo $linhaConteudo['conteudo_link'];?>" target="_blank">
                                            <?php if($linhaConteudo['tipo_conteudo'] == 5){ ?>
                                                <img src="<?php echo $GLOBALS['configCaminhoSiteImagens'];?><?php echo $linhaConteudo['arquivo'];?>?variavelCache=<?php echo date("s"); ?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);?>" />
                                            <?php } ?>
                                            <?php if($linhaConteudo['tipo_conteudo'] == 9){ ?>
                                                <img src="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>o<?php echo $linhaConteudo['arquivo'];?>?variavelCache=<?php echo date("s"); ?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);?>" />
                                            <?php } ?>
                                        </a>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                            <div class="ConteudoLegenda" style="text-align: <?php echo Funcoes::AlinhamentoTexto($linhaConteudo['alinhamento_texto']);?>;">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);?>
                            </div>
                        <?php } ?>
                        <?php //---------------------- ?>
                        
                        <?php //Imagem para a direita. ?>
                        <?php //---------------------- ?>
                        <?php if($linhaConteudo['alinhamento_imagem'] == 1){ ?>
                            <div>
                                <div class="ConteudoImagemAlinhamentoDireita">
									<?php if($linhaConteudo['arquivo'] <> ""){ ?>
                                        <?php if($linhaConteudo['conteudo_link'] == ""){ ?>
                                            <?php //Sem pop-up. ?>
                                            <?php if($GLOBALS['configImagemPopUp'] == 0){ ?>
                                                <?php if($linhaConteudo['tipo_conteudo'] == 5){ ?>
                                                    <img src="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>r<?php echo $linhaConteudo['arquivo'];?>?variavelCache=<?php echo date("s"); ?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);?>" class="ImagemAlinhamentoDireita" />
                                                <?php } ?>
                                                <?php if($linhaConteudo['tipo_conteudo'] == 9){ ?>
                                                    <img src="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>o<?php echo $linhaConteudo['arquivo'];?>?variavelCache=<?php echo date("s"); ?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);?>" class="ImagemAlinhamentoDireita" />
                                                <?php } ?>
                                            <?php } ?>
                                        
                                            <?php //SlimBox 2 - JQuery. ?>
                                            <?php if($GLOBALS['configImagemPopUp'] == 1){ ?>
                                                <a href="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>g<?php echo $linhaConteudo['arquivo'];?>" rel="lightbox" title="">
                                                    <?php if($linhaConteudo['tipo_conteudo'] == 5){ ?>
                                                        <img src="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>r<?php echo $linhaConteudo['arquivo'];?>?variavelCache=<?php echo date("s"); ?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);?>" class="ImagemAlinhamentoDireita" />
                                                    <?php } ?>
                                                    <?php if($linhaConteudo['tipo_conteudo'] == 9){ ?>
                                                        <img src="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>o<?php echo $linhaConteudo['arquivo'];?>?variavelCache=<?php echo date("s"); ?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);?>" class="ImagemAlinhamentoDireita" />
                                                    <?php } ?>
                                                </a>
                                            <?php } ?>
                                        <?php }else{ ?>
                                            <?php //Imagem com link. ?>
                                            <a href="<?php echo $linhaConteudo['conteudo_link'];?>" target="_blank">
                                                <?php if($linhaConteudo['tipo_conteudo'] == 5){ ?>
                                                    <img src="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>r<?php echo $linhaConteudo['arquivo'];?>?variavelCache=<?php echo date("s"); ?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);?>" class="ImagemAlinhamentoDireita" />
                                                <?php } ?>
                                                <?php if($linhaConteudo['tipo_conteudo'] == 9){ ?>
                                                    <img src="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>o<?php echo $linhaConteudo['arquivo'];?>?variavelCache=<?php echo date("s"); ?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);?>" class="ImagemAlinhamentoDireita" />
                                                <?php } ?>
                                            </a>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                                <div class="ConteudoTextoCorrido" style="text-align: <?php echo Funcoes::AlinhamentoTexto($linhaConteudo['alinhamento_texto']);?>;">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);?>
                                </div>
                            </div>
                        <?php } ?>
                        <?php //---------------------- ?>
                        
                    <?php } ?>
                    <?php //**************************************************************************************?>
                    
                    <?php //Vídeos. ?>
                    <?php //**************************************************************************************?>
                    <?php if($linhaConteudo['tipo_conteudo'] == 6){ ?>
                        <?php //Direto na página. ?>
                        <?php if($linhaConteudo['config_arquivo'] == 2){ ?>
                            <div class="ConteudoTextoCorrido" style="text-align: <?php echo Funcoes::AlinhamentoTexto($linhaConteudo['alinhamento_texto']);?>;">
                                <?php echo VideoFuncoes::VideoExibirHTML($linhaConteudo['arquivo'], "", "", ""); ?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    <?php //**************************************************************************************?>

                    <?php //HTML. ?>
                    <?php //**************************************************************************************?>
                    <?php if($linhaConteudo['tipo_conteudo'] == 7){ ?>
                        <div class="ConteudoTextoCorrido" style="text-align: <?php echo Funcoes::AlinhamentoTexto($linhaConteudo['alinhamento_texto']);?>;">
                            <?php //iframe no conteúdo. ?>
                            <?php if(strpos($linhaConteudo['conteudo'], "iframe") !== false) {?>
                                <?php //echo Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);?>
                                <?php echo str_replace("\\","",$linhaConteudo['conteudo']);?>
                            <?php } ?>
                            
                            <?php //iframe não detectado. ?>
                            
                            <?php if(strpos($linhaConteudo['conteudo'], "iframe") == false) {?>
                                <iframe width="<?php echo $GLOBALS['configTamanhoVideoW']; ?>" height="<?php echo $GLOBALS['configTamanhoVideoH']; ?>" src="//www.youtube.com/embed/<?php echo str_replace("watch?v=","",Funcoes::ConteudoRetornoArray01($linhaConteudo['conteudo'], 1)); ?>" frameborder="0" allowfullscreen></iframe>
                                <?php //echo "ConteudoRetornoArray01 = " . ConteudoRetornoArray01($linhaConteudo['conteudo'], 1) . "<br />";?>
                                <?php //echo Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    <?php //**************************************************************************************?>

                    <?php //Arquivo. ?>
                    <?php //**************************************************************************************?>
                    <?php if($linhaConteudo['tipo_conteudo'] == 8){ ?>
                        <div class="ConteudoTextoCorrido" style="text-align: <?php echo Funcoes::AlinhamentoTexto($linhaConteudo['alinhamento_texto']);?>;">
                            <?php if($linhaConteudo['arquivo'] <> ""){ ?>
                                <?php 
                                //Rotina para ajudar a verificar a extensão do arquivo.
                                $arrArquivoExtensao = explode(".", $linhaConteudo['arquivo']);
                                $arquivoExtensao = strtolower(end($arrArquivoExtensao));
                                ?>
                                
                                <?php //Download. ?>
                                <?php if($linhaConteudo['config_arquivo'] == 3){ ?>
                                    <?php if(strpos($GLOBALS['configImagensFormatos'], $arquivoExtensao) !== false) {?>
                                        <a href="../<?php echo $GLOBALS['configDiretorioSistema']; ?>/<?php echo "ArquivosDownload.php?nomeArquivo=" . "o" . $linhaConteudo['arquivo']; //Imagens - incluir 'o' na frente do nome do arquivo.?>" target="_blank" class="ConteudoLinks">
                                            <?php echo Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);?>
                                        </a>
                                    <?php }else{ ?>
                                        <a href="../<?php echo $GLOBALS['configDiretorioSistema']; ?>/<?php echo "ArquivosDownload.php?nomeArquivo=" . $linhaConteudo['arquivo'];?>" target="_blank" class="ConteudoLinks">
                                            <?php echo Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);?>
                                        </a>
                                    <?php } ?>
                                <?php } ?>
                            
                                <?php //Direto para mídia. ?>
                                <?php if($linhaConteudo['config_arquivo'] == 4){ ?>
                                    <a href="../<?php echo $GLOBALS['configDiretorioSistema']; ?>/<?php echo $GLOBALS['configDiretorioArquivos'];?>/<?php echo $linhaConteudo['arquivo'];?>" target="_blank" class="ConteudoLinks">
                                        <?php echo Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);?>
                                    </a>
                                <?php } ?>
                            <?php }else{ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    <?php //**************************************************************************************?>
                    
                    <?php //Divisão de colunas. ?>
                    <?php //**************************************************************************************?>
                    <?php if($linhaConteudo['tipo_conteudo'] == 10){ ?>
                        <?php
                        //Teste.
                        //$strConteudo = "3";
                        //for($countColunas = 1; $countColunas <= $strConteudo; $countColunas++)
                        //{
                            //echo "countColunas=" . $countColunas . "<br />";
                        //}
                        
                        $countConteudoColunas = 1;
                        //Query de pesquisa.
                        //----------
                        $strSqlConteudoColunasSelect = "";
                        $strSqlConteudoColunasSelect .= "SELECT ";
                        $strSqlConteudoColunasSelect .= "id, ";
                        $strSqlConteudoColunasSelect .= "id_tb_conteudo, ";
                        $strSqlConteudoColunasSelect .= "n_classificacao ";
                        $strSqlConteudoColunasSelect .= "FROM tb_conteudo_colunas ";
                        $strSqlConteudoColunasSelect .= "WHERE id <> 0 ";
                        $strSqlConteudoColunasSelect .= "AND id_tb_conteudo = :id_tb_conteudo ";
                        //$strSqlConteudoColunasSelect .= "ORDER BY " . $GLOBALS['configClassificacaoConteudo'] . " ";
                        
                        $statementConteudoColunasSelect = $dbSistemaConPDO->prepare($strSqlConteudoColunasSelect);
                        
                        if ($statementConteudoColunasSelect !== false)
                        {
                            $statementConteudoColunasSelect->execute(array(
                                "id_tb_conteudo" => $linhaConteudo['id']
                            ));
                        }
                        
                        //$resultadoConteudo = $dbSistemaConPDO->query($strSqlConteudoSelect);
                        $resultadoConteudoColunas = $statementConteudoColunasSelect->fetchAll();
                        ?>
                        
                        <?php if(empty($resultadoConteudoColunas)){?>		
                        
                        <?php }else{ ?>
                            <table width="100%" border="0" cellspacing="0" cellpadding="4">
                              <tr>
                                <?php 
                                foreach($resultadoConteudoColunas as $linhaConteudoColunas)
                                { 
                                ?>
                                    <td valign="top">
                                        <div align="center" class="ConteudoTextoCorrido">
                                            <a href="ConteudoIndice.php?idParentConteudo=<?php echo $linhaConteudoColunas['id']; ?>" target="_blank" class="ConteudoLinks">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoColunasEditar"); ?>: <?php echo $countConteudoColunas; ?>
                                            </a>
                                        </div>
                                    </td>
                                <?php 
                                    $countConteudoColunas++;
                                } 
                                ?>
                              </tr>
                            </table>
                            
                        <?php 
                        } 
                        
                        //Limpeza de objetos.
                        unset($strSqlConteudoColunasSelect);
                        unset($statementConteudoColunasSelect);
                        unset($resultadoConteudoColunas);
                        unset($linhaConteudoColunas);
                        //----------
                        ?>
                        
                    <?php } ?>
                    <?php //**************************************************************************************?>
                    
                    <?php //SWF. ?>
                    <?php //**************************************************************************************?>
                    <?php if($linhaConteudo['tipo_conteudo'] == 11){ ?>
                        <div align="center">
                            <?php
                            $arrDimensaoArquivo = explode(",", $linhaConteudo['dimensao_arquivo']);
                            $swfW = $arrDimensaoArquivo[0];
                            $swfH = $arrDimensaoArquivo[1];
                            ?>		
                                        
                            <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="<?php echo $swfW;?>" height="<?php echo $swfH;?>">
                                <param name="movie" value="<?php echo $GLOBALS['configCaminhoSiteImagens'];?><?php echo $linhaConteudo['arquivo'];?>?variavelCache=<?php echo date("s"); ?>">
                                <param name="quality" value="high">
                                <embed src="<?php echo $GLOBALS['configCaminhoSiteImagens'];?><?php echo $linhaConteudo['arquivo'];?>?variavelCache=<?php echo date("s"); ?>" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="<?php echo $swfW;?>" height="<?php echo $swfH;?>"></embed>
                            </object>
                        </div>
                    <?php } ?>
                    <?php //**************************************************************************************?>
                </td>
              </tr>
              <?php } ?>
            </table>
        <?php //**************************************************************************************?>
        <?php } ?>
    <?php } ?>

<?php
//Limpeza de objetos.
unset($strSqlConteudoSelect);
unset($statementConteudoSelect);
unset($resultadoConteudo);
unset($linhaConteudo);
//----------
?>