<?php
//Importação dos arquivos de configuração.
require_once "../sistema/IncludeConfig.php"; //Deve vir antes do db.
require_once "../sistema/IncludeConexao.php";
require_once "../sistema/IncludeFuncoes.php";
//require_once "IncludeLayout.php";
require_once "IncludeLayoutSite.php";


//Verificação de login de cadastro.
LoginAutenticacao::CadastroLoginVerificacao();


//Resgate de variáveis.
$idParent = $_GET["idParent"];
$tipoArquivo = $_GET["tipoArquivo"];
$detalhe01 = $_GET["detalhe01"];
$detalhe02 = $_GET["detalhe02"];

$paginaRetorno = "SiteAdmArquivosIndice.php";
//$paginaRetornoExclusao = "PaginasEditar.php";
$variavelRetorno = "idParent";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];


//Montagem de query padrão de retorno.
$queryPadrao = "&idParent=" . $idParent . 
"&paginaRetorno=" . $paginaRetorno . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&variavelRetorno=" . $variavelRetorno . 
"&masterPageSelect=" . $masterPageSelect . 
"&tipoArquivo=" . $tipoArquivo . 
"&detalhe01=" . $detalhe01 . 
"&detalhe02=" . $detalhe02;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


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
$strSqlArquivosSelect .= "AND tipo_arquivo = :tipo_arquivo ";
$strSqlArquivosSelect .= "ORDER BY " . $GLOBALS['configClassificacaoArquivos'] . " ";

$statementArquivosSelect = $dbSistemaConPDO->prepare($strSqlArquivosSelect);

if ($statementArquivosSelect !== false)
{
	$statementArquivosSelect->execute(array(
		"id_parent" => $idParent,
		"tipo_arquivo" => $tipoArquivo
	));
}

//$resultadoArquivos = $dbSistemaConPDO->query($strSqlArquivosSelect);
$resultadoArquivos = $statementArquivosSelect->fetchAll();
?>
<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo htmlentities($GLOBALS['configTituloSite']); ?> - <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteArquivos"); ?>
<?php 
$pageSite->cphTitle = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>
<?php //Head.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphHead*/ ?>
    <meta name="description" content="" /><?php //Abaixo de 160 caracteres.?>
    <meta name="keywords" content="" /><?php //Abaixo de 100 caracteres.?>
    <meta name="title" content="" /><?php //Abaixo de 60 caracteres.?>
<?php 
$pageSite->cphHead = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>
<?php //Título atual.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphConteudoCabecalho*/ ?>
	<?php if($tipoArquivo == "3") { ?>
		<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteArquivos03"); ?>
    <?php }else{ ?>
		<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteArquivos"); ?>
    <?php } ?>
<?php 
$pageSite->cphTituloLinkAtual = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Conteúdo principal.?>
<?php //**************************************************************************************?>
<?php ob_start(); /*cphConteudoPrincipal*/ ?>
    <div align="center" class="AdmErro">
        <?php echo $mensagemErro;?>
    </div>
    <div align="center" class="AdmSucesso">
        <?php echo $mensagemSucesso;?>
    </div>

    <div align="center" class="AdmTexto01" style="display: none;">
		<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteArquivosInstrucoes01"); ?>
    </div>
    
    
    <div class="AdmTexto01" style="position: absolute; display: block; top: 15px; left: 30px;">
        Arquivos
        
			<?php
            //if (empty($resultadoArquivos))
            //{
                //echo "Nenhum registro encontrado";
            ?>
                <div align="center" class="TextoErro" style="display: none;">
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatus1"); ?>
                </div>
            <?php
            //}else{
            ?>
                <form name="formArquivosAcoes" id="formArquivosAcoes" action="SiteAdmRegistrosAcoesExe.php" method="post" class="FormularioTabela01">
                    <input name="strTabela" id="strTabela" type="hidden" value="tb_arquivos" />
                    <input name="idParent" id="idParent" type="hidden" value="<?php echo $idParent; ?>" />
                    <input name="tipoArquivo" id="tipoArquivo" type="hidden" value="<?php echo $tipoArquivo; ?>" />
        
                    <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                    <input name="masterPageSiteSelect" type="hidden" id="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
                    <input name="detalhe01" type="hidden" id="detalhe01" value="<?php echo $detalhe01; ?>" />
                    <input name="detalhe02" type="hidden" id="detalhe02" value="<?php echo $detalhe02; ?>" />
                    <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
                    <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
                    <div style="position: relative; display: block; width: 200px; height: 200px; overflow: scroll; background-color: #fff;">
                    <table width="100%" class="AdmTabelaDados01" style="table-layout: auto;">
                      <tr class="AdmTbFundoEscuro" style="display: none;">
                        <?php if($GLOBALS['habilitarArquivosNClassificacao'] == 1){ ?>
                        <td width="50" class="TabelaDados01Celula">
                            <div align="center" class="AdmTexto02">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNClassificacaoA"); ?>
                            </div>
                        </td>
                        <?php } ?>
                        
                        <td class="TabelaDados01Celula">
                            <div class="AdmTexto02">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemArquivo"); ?>
                            </div>
                        </td>
                        
                        <td width="30" class="TabelaDados01Celula" style="display: none;">
                            <div align="center" class="AdmTexto02">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                            </div>
                        </td>
                        
                        <td width="20" class="TabelaDados01Celula">
                            <div align="center" class="AdmTexto02">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemExcluir"); ?>
                            </div>
                        </td>
                      </tr>
                      <?php
                        //Loop pelos resultados.
                        foreach($resultadoArquivos as $linhaArquivos)
                        {
                      ?>
                      <tr>
                        <?php if($GLOBALS['habilitarArquivosNClassificacao'] == 1){ ?>
                        <td class="TabelaDados01Celula">
                            <div align="center" class="AdmTexto01">
                                <?php echo $linhaArquivos['n_classificacao'];?>
                            </div>
                        </td>
                        <?php } ?>
                        
                        <td class="TabelaDados01Celula">
                            <?php //Imagem - tipoArquivo = 1.?>
                            <?php //**************************************************************************************?>
                            <?php if($linhaArquivos['tipo_arquivo'] == "1"){ ?>
                                <?php if(!empty($linhaArquivos['arquivo'])){ ?>
                                    <div align="center" class="AdmTexto01" style="display: none;">
                                        <?php //Sem pop-up. ?>
                                        <?php if($GLOBALS['configImagemPopUp'] == 0){ ?>
                                            <img src="../<?php echo $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos'];?>/<?php echo $linhaArquivos['arquivo'];?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaArquivos['legenda']); ?>" />
                                        <?php } ?>
                                    
                                        <?php //SlimBox 2 - JQuery. ?>
                                        <?php if($GLOBALS['configImagemPopUp'] == 1){ ?>
                                            <a href="../<?php echo $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos'];?>/g<?php echo $linhaArquivos['arquivo'];?>" rel="lightbox" title="">
                                                <img src="../<?php echo $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos'];?>/<?php echo $linhaArquivos['arquivo'];?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaArquivos['legenda']); ?>" />
                                            </a>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                                <div class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($linhaArquivos['legenda']); ?>
                                </div>
                            <?php } ?>
                            <?php //**************************************************************************************?>
                            
                            
                            <?php //Vídeo - tipoArquivo = 2.?>
                            <?php //**************************************************************************************?>
                            <?php if($linhaArquivos['tipo_arquivo'] == "2"){ ?>
                                <?php if($GLOBALS['habilitarArquivosVideosTitulos'] == 0){ ?>
                                <div class="AdmTexto01" align="center">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($linhaArquivos['titulo']); ?>
                                </div>
                                <?php } ?>
    
                                <?php //config_arquivo = 2?>
                                <div align="center">
                                    <?php echo VideoFuncoes::VideoExibirHTML($linhaArquivos['arquivo'], "", "", ""); ?>
                                </div>
    
                                <?php //Código HTML.?>
                                <?php if($GLOBALS['habilitarArquivosVideosCodigoHTML'] == 0){ ?>
                                    <?php if($linhaArquivos['codigo_html'] <> ""){ ?>
                                        <div align="center">
                                            <?php //Sem identificação. ?>
                                            <?php if(strpos($linhaArquivos['codigo_html'], "iframe") !== false) {?>
                                                <?php //echo Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);?>
                                                <?php echo str_replace("\\","",$linhaConteudo['conteudo']);?>
                                            <?php } ?>
                                            
        
                                            <?php //YouTube. ?>
                                            <?php //---------------------- ?>
                                            <?php if(strpos($linhaArquivos['codigo_html'], "iframe") == false) {?>
                                                <iframe width="<?php echo $GLOBALS['configTamanhoVideoW']; ?>" height="<?php echo $GLOBALS['configTamanhoVideoH']; ?>" src="//www.youtube.com/embed/<?php echo str_replace("watch?v=","",Funcoes::ConteudoRetornoArray01($linhaArquivos['codigo_html'], 1)); ?>" frameborder="0" allowfullscreen></iframe>
                                                <?php //echo "ConteudoRetornoArray01 = " . ConteudoRetornoArray01($linhaConteudo['conteudo'], 1) . "<br />";?>
                                                <?php //echo Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);?>
                                            <?php } ?>
                                            <?php //---------------------- ?>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
    
                                <div class="AdmTexto01" align="center">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($linhaArquivos['legenda']); ?>
                                </div>
    
                                <?php //Opções.?>
                            
                            <?php } ?>
                            <?php //**************************************************************************************?>
                            
                            
                            <?php //Arquivo - tipoArquivo = 3.?>
                            <?php //**************************************************************************************?>
                            <?php if($linhaArquivos['tipo_arquivo'] == "3"){ ?>
                                <div class="AdmTexto01">
                                    <?php if($linhaArquivos['arquivo'] <> ""){ ?>
                                        <?php 
                                        //Rotina para ajudar a verificar a extensão do arquivo.
                                        $arrArquivoExtensao = explode(".", $linhaArquivos['arquivo']);
                                        $arquivoExtensao = strtolower(end($arrArquivoExtensao));
                                        ?>
                                        
                                        <?php //Download. ?>
                                        <?php if($linhaArquivos['config_arquivo'] == 3){ ?>
                                            <?php if(strpos($GLOBALS['configImagensFormatos'], $arquivoExtensao) !== false) {?>
                                                <a href="<?php echo "SiteAdmArquivosDownload.php?nomeArquivo=" . "o" . $linhaArquivos['arquivo']; //Imagens - incluir 'o' na frente do nome do arquivo.?>" target="_blank" class="AdmLinks01">
                                                    <?php echo Funcoes::ConteudoMascaraLeitura($linhaArquivos['legenda']); ?>
                                                </a>
                                            <?php }else{ ?>
                                                <a href="<?php echo "SiteAdmArquivosDownload.php?nomeArquivo=" . $linhaArquivos['arquivo'];?>" target="_blank" class="AdmLinks01">
                                                    <?php echo Funcoes::ConteudoMascaraLeitura($linhaArquivos['legenda']); ?>
                                                </a>
                                            <?php } ?>
                                        <?php } ?>
                                    
                                        <?php //Direto para mídia. ?>
                                        <?php if($linhaArquivos['config_arquivo'] == 4){ ?>
                                            <a href="../<?php echo $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos'];?>/<?php echo $linhaArquivos['arquivo'];?>" target="_blank" class="AdmLinks01">
                                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaArquivos['legenda']); ?>
                                            </a>
                                        <?php } ?>
                                    <?php }else{ ?>
                                        <?php echo Funcoes::ConteudoMascaraLeitura($linhaArquivos['legenda']); ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                            <?php //**************************************************************************************?>
                            
                            
                            <?php //Zip - tipoArquivo = 4.?>
                            <?php //**************************************************************************************?>
                            <?php if($linhaArquivos['tipo_arquivo'] == "4"){ ?>
                            
                            <?php } ?>
                            <?php //**************************************************************************************?>
                            
                            
                            <?php //SWF - tipoArquivo = 5.?>
                            <?php //**************************************************************************************?>
                            <?php if($linhaArquivos['tipo_arquivo'] == "5"){ ?>
                                <div align="center">
                                    <?php
                                    $arrDimensaoArquivo = explode(",", $linhaArquivos['dimensao_arquivo']);
                                    $swfW = $arrDimensaoArquivo[0];
                                    $swfH = $arrDimensaoArquivo[1];
                                    ?>		
                                                
                                    <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="<?php echo $swfW;?>" height="<?php echo $swfH;?>">
                                        <param name="movie" value="../<?php echo $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos'];?>/<?php echo $linhaArquivos['arquivo'];?>?variavelCache=<?php echo date("s"); ?>">
                                        <param name="quality" value="high">
                                        <embed src="../<?php echo $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos'];?>/<?php echo $linhaArquivos['arquivo'];?>?variavelCache=<?php echo date("s"); ?>" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="<?php echo $swfW;?>" height="<?php echo $swfH;?>"></embed>
                                    </object>
                                </div>
                            <?php } ?>
                            <?php //**************************************************************************************?>
                        </td>
                        
                        <td class="TabelaDados01Celula" style="display: none;">
                            <div align="center" class="AdmTexto01">
                                <a href="SiteAdmArquivosEditar.php?idTbArquivos=<?php echo $linhaArquivos['id'];?><?php echo $queryPadrao;?>" class="AdmLinks01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                                </a>
                            </div>
                        </td>
                        <td class="TabelaDados01Celula">
                            <div align="center" class="AdmTexto01">
                            	<?php if(CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroUsuario") <> ""){ ?>
                                <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaArquivos['id'];?>" class="AdmCampoCheckBox01" />
                            	<?php } ?>
                            </div>
                        </td>
                      </tr>
                      <?php } ?>
                    </table>
                    </div>
                    
                    <div align="center" style="position: relative; display: block; margin-top: 10px;">
                    </div>
                    	<?php if(CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroUsuario") <> "" || CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroUsuario2") <> ""){ ?>
                    	<div style="float: right;">
                            <div class="AdmDivBto01" onclick="btoClick_onEvent('btoArquivosExcluir');" style="min-width: 70px; margin-right: 0px;">
                                <a class="AdmLinks01">
                                    Remover
                                </a>
                            </div>
                        
                            <input id="btoArquivosExcluir" type="image" name="submit" value="Submit" src="img/btoExcluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoExcluir"); ?>" style="display: none;" />
                        </div>
                        <?php } ?>
                </form>
            <?php //} ?>
            
            <?php if(CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroUsuario") <> ""){ ?>
            <div style="float: left;">
                <div class="AdmDivBto01" onclick="divShow('divAdicionar');" style="min-width: 70px;">
                    <a class="AdmLinks01">
                        Adicionar
                    </a>
                </div>
            
                <img onclick="divShow('divAdicionar');" src="img/btoAdicionar.png" alt="Adicionar" style="cursor: pointer; display: none;"  />
            </div>
            <?php } ?>
            
    </div>
    
    
    <div id="divAdicionar" style="position: absolute; display: none; top: 270px; left: 30px; width: 200px;">
        <form name="formArquivos" id="formArquivos" action="SiteAdmArquivosIndiceExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="AdmTabelaCampos01">
                <tr>
                    <td class="AdmTbFundoEscuro" colspan="4">
                        <div align="center" class="AdmTexto02">
                            <strong>
                                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteArquivos"); ?>
                                Adicionar Arquivos
                            </strong>
                        </div>
                    </td>
                </tr>
    
                <?php if($GLOBALS['habilitarArquivosNClassificacao'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNClassificacao"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div>
                            <input type="text" name="n_classificacao" id="n_classificacao" class="AdmCampoNumerico01" maxlength="10" value="0" />
                        </div>
                    </td>
                </tr>
                <?php } ?>
    
                <?php if($tipoArquivo == "2"){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteArquivosVisualizacao"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left" class="AdmTexto01">
                            <div>
                                <input name="config_arquivo" type="radio" value="1" class="AdmCampoCheckBox01" checked="true" /> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemVisualizacao1"); ?>
                            </div>
                            <div>
                                <input name="config_arquivo" type="radio" value="2" class="AdmCampoCheckBox01" /> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemVisualizacao2"); ?>
                            </div>
                            <div>
                                <input name="config_arquivo" type="radio" value="3" class="AdmCampoCheckBox01" /> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemVisualizacao3"); ?>
                            </div>
                            <div>
                                <input name="config_arquivo" type="radio" value="4" class="AdmCampoCheckBox01" /> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemVisualizacao4"); ?>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php } ?>
    
    
                <?php if($tipoArquivo == "3"){ ?>
                <tr style="display: none;">
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteArquivosVisualizacao"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <div>
                                <input name="config_arquivo" type="radio" value="3" class="AdmCampoCheckBox01" checked="true" /> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemVisualizacao3"); ?>
                            </div>
                            <div>
                                <input name="config_arquivo" type="radio" value="4" class="AdmCampoCheckBox01" /> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemVisualizacao4"); ?>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php } ?>
    
                <?php if($tipoArquivo == "2"){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteArquivosDuracao"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <input type="text" name="duracao_min" id="duracao_min" class="AdmCampoNumericoReduzido01" maxlength="255" />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemMinutos"); ?>
                            <input type="text" name="duracao_seg" id="duracao_seg" class="AdmCampoNumericoReduzido01" maxlength="255" />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemSegundos"); ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
    
                <?php if($tipoArquivo == "5"){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteArquivosDimensao"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <input type="text" name="dimensao_w" id="dimensao_w" class="AdmCampoNumericoReduzido01" maxlength="255" value="0" />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemLarguraPixels"); ?>
                            <input type="text" name="dimensao_h" id="dimensao_h" class="AdmCampoNumericoReduzido01" maxlength="255" value="0" />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAlturaPixels"); ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
    
                <?php if($tipoArquivo == "2"){ ?>
                    <?php if($GLOBALS['habilitarArquivosVideosTitulos'] == 1){ ?>
                    <tr>
                        <td class="AdmTbFundoMedio TabelaColuna01">
                            <div align="left" class="AdmTexto01">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteArquivosTitulo"); ?>:
                            </div>
                        </td>
                        <td class="AdmTbFundoClaro" colspan="3">
                            <div>
                                <input type="text" name="titulo" id="titulo" class="AdmCampoTexto02" maxlength="255" />
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
    
                <tr>
                    <td class="TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteArquivosLegenda"); ?>:
                        </div>
                    </td>
                    <td class="" colspan="3">
                        <div>
                            <input type="text" name="legenda" id="legenda" class="AdmCampoTexto02" maxlength="255" />
                        </div>
                    </td>
                </tr>
    
                <?php if($GLOBALS['habilitarArquivosDescricao'] == 1){ ?>
                <tr>
                    <td class="TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteArquivosDescicao"); ?>:
                        </div>
                    </td>
                    <td class="" colspan="3">
                        <div>
                            <textarea name="descricao" id="descricao" class="AdmCampoTextoMultilinha01" style="width: 120px;"></textarea>
                        </div>
                    </td>
                </tr>
                <?php } ?>
    
                <?php if($tipoArquivo == "2"){ ?>
                    <?php if($GLOBALS['habilitarArquivosVideosCodigoHTML'] == 1){ ?>
                    <tr>
                        <td class="AdmTbFundoMedio TabelaColuna01">
                            <div align="left" class="AdmTexto01">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemHTML01"); ?>:
                            </div>
                        </td>
                        <td class="AdmTbFundoClaro" colspan="3">
                            <div class="AdmTexto01">
                                <textarea name="codigo_html" id="codigo_html" class="AdmCampoTextoMultilinhaURL"></textarea>
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemHTML02"); ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
    
                <tr id="cell_imagem">
                    <td class="TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemArquivo"); ?>:
                        </div>
                    </td>
                    <td class="" colspan="3">
                        <div style="overflow: visible;">
                            <input type="file" name="ArquivoUpload1" id="ArquivoUpload1" class="AdmCampoArquivoUpload01" style="width: 120px;/**/" />
                        </div>
                    </td>
                </tr>
            </table>
            
            <div>
                <div align="center">
                    <div class="AdmDivBto01" onclick="divShow('btoArquivosUpload');" style="min-width: 70px; margin-right: 0px;">
                        <a class="AdmLinks01">
                            Upload
                        </a>
                    </div>
                    <input id="btoArquivosUpload" type="image" name="submit" value="Submit" src="img/btoUpload.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoUpload"); ?>" style="display: none;" />
                    
                    <input type="hidden" name="id_parent" id="id_parent" value="<?php echo $idParent; ?>" />
                    <input type="hidden" name="tipo_arquivo" id="tipo_arquivo" value="<?php echo $tipoArquivo; ?>" />
                    
                    <input type="hidden" name="paginaRetorno" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                    <input type="hidden" name="masterPageSiteSelect" id="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
                    <input type="hidden" name="detalhe01" id="detalhe01" value="<?php echo $detalhe01; ?>" />
                    <input type="hidden" name="detalhe02" id="detalhe02" value="<?php echo $detalhe02; ?>" />
                </div>
            </div>
        </form>
    </div>
    
    
    <div style="position: absolute; display: block; top: 20px; left: 295px; width: 665px; height: 505px; border: 1px solid #000000; overflow: scroll;">
        <?php
        if (empty($resultadoArquivos))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
                  <?php
                    //Loop pelos resultados.
                    foreach($resultadoArquivos as $linhaArquivos)
                    {
                  ?>
                        <?php //Imagem - tipoArquivo = 1.?>
                        <?php //**************************************************************************************?>
                        <?php if($linhaArquivos['tipo_arquivo'] == "1"){ ?>
                            
                            
                            <?php //Registro. ?>
                            <div class="ArquivosImagensContainer">
                                <?php if($linhaArquivos['arquivo'] <> ""){ ?>
                                    <?php 
                                    //Rotina para ajudar a verificar a extensão do arquivo.
                                    $arrArquivoExtensao = explode(".", $linhaArquivos['arquivo']);
                                    $arquivoExtensao = strtolower(end($arrArquivoExtensao));
                                    ?>

                                    <div align="center" style="position: relative; display: block; margin-top: 10px;">
										<?php //Sem pop-up. ?>
                                        <?php if($GLOBALS['configImagemPopUp'] == 0){ ?>
                                            <img src="../<?php echo $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos'];?>/<?php echo $linhaArquivos['arquivo'];?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaArquivos['legenda']); ?>" width="125" />
                                        <?php } ?>
                                    
                                        <?php //SlimBox 2 - JQuery. ?>
                                        <?php if($GLOBALS['configImagemPopUp'] == 1){ ?>
                                            <a href="../<?php echo $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos'];?>/g<?php echo $linhaArquivos['arquivo'];?>" rel="lightbox" title="">
                                                <img src="../<?php echo $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos'];?>/<?php echo $linhaArquivos['arquivo'];?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaArquivos['legenda']); ?>" width="125" />
                                            </a>
                                        <?php } ?>
                                    </div>
                                    <div align="center" class="AdmTexto01">
                                        <?php echo Funcoes::ConteudoMascaraLeitura($linhaArquivos['legenda']); ?>
                                    </div>
                                    <div align="center" class="AdmTexto01">
										<?php //Download. ?>
                                        <?php //if($linhaArquivos['config_arquivo'] == 3){ ?>
                                            <?php if(strpos($GLOBALS['configImagensFormatos'], $arquivoExtensao) !== false) {?>
                                                <a href="<?php echo "SiteAdmArquivosDownload.php?nomeArquivo=" . "o" . $linhaArquivos['arquivo']; //Imagens - incluir 'o' na frente do nome do arquivo.?>" target="_blank" class="AdmLinks01">
                                                    <?php //echo Funcoes::ConteudoMascaraLeitura($linhaArquivos['legenda']); ?>
                                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteArquivosAcoesBaixar"); ?> 
                                                    <br />
                                                    (<?php echo $linhaArquivos['arquivo'];?> - <?php echo round(filesize("../" . $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos']. "/o" . $linhaArquivos['arquivo']) / 1024, 2);?> kb)
                                                </a>
                                            <?php }else{ ?>
                                                <a href="<?php echo "SiteAdmArquivosDownload.php?nomeArquivo=" . $linhaArquivos['arquivo'];?>" target="_blank" class="AdmLinks01">
                                                    <?php //echo Funcoes::ConteudoMascaraLeitura($linhaArquivos['legenda']); ?>
                                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteArquivosAcoesBaixar"); ?>
                                                    <br />
                                                    (<?php echo $linhaArquivos['arquivo'];?> - <?php echo round(filesize("../" . $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos']. "/" . $linhaArquivos['arquivo']) / 1024, 2);?> kb)
                                                </a>
                                            <?php } ?>
                                        <?php //} ?>
                                    </div>
                                    <div align="center" class="AdmTexto01">
                                        <?php echo Funcoes::ConteudoMascaraLeitura($linhaArquivos['descricao']); ?>
                                    </div>
                                <?php }else{ ?>
                                	<div align="center" class="AdmTexto01">
										<?php echo Funcoes::ConteudoMascaraLeitura($linhaArquivos['legenda']); ?>
                                    </div>
                                    <div align="center" class="AdmTexto01">
                                        <?php echo Funcoes::ConteudoMascaraLeitura($linhaArquivos['descricao']); ?>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                        <?php //**************************************************************************************?>
                        
                        
                        <?php //Vídeo - tipoArquivo = 2.?>
                        <?php //**************************************************************************************?>
                        <?php if($linhaArquivos['tipo_arquivo'] == "2"){ ?>
                            <?php if($GLOBALS['habilitarArquivosVideosTitulos'] == 0){ ?>
                            <div class="AdmTexto01" align="center">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaArquivos['titulo']); ?>
                            </div>
                            <?php } ?>

                            <?php //config_arquivo = 2?>
                            <div align="center">
                                <?php echo VideoFuncoes::VideoExibirHTML($linhaArquivos['arquivo'], "", "", ""); ?>
                            </div>

                            <?php //Código HTML.?>
                            <?php if($GLOBALS['habilitarArquivosVideosCodigoHTML'] == 0){ ?>
                                <?php if($linhaArquivos['codigo_html'] <> ""){ ?>
                                    <div align="center">
                                        <?php //Sem identificação. ?>
                                        <?php if(strpos($linhaArquivos['codigo_html'], "iframe") !== false) {?>
                                            <?php //echo Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);?>
                                            <?php echo str_replace("\\","",$linhaConteudo['conteudo']);?>
                                        <?php } ?>
                                        
    
                                        <?php //YouTube. ?>
                                        <?php //---------------------- ?>
                                        <?php if(strpos($linhaArquivos['codigo_html'], "iframe") == false) {?>
                                            <iframe width="<?php echo $GLOBALS['configTamanhoVideoW']; ?>" height="<?php echo $GLOBALS['configTamanhoVideoH']; ?>" src="//www.youtube.com/embed/<?php echo str_replace("watch?v=","",Funcoes::ConteudoRetornoArray01($linhaArquivos['codigo_html'], 1)); ?>" frameborder="0" allowfullscreen></iframe>
                                            <?php //echo "ConteudoRetornoArray01 = " . ConteudoRetornoArray01($linhaConteudo['conteudo'], 1) . "<br />";?>
                                            <?php //echo Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);?>
                                        <?php } ?>
                                        <?php //---------------------- ?>
                                    </div>
                                <?php } ?>
                            <?php } ?>

                            <div class="AdmTexto01" align="center">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaArquivos['legenda']); ?>
                            </div>

                            <?php //Opções.?>
                        
                        <?php } ?>
                        <?php //**************************************************************************************?>
                        
                        
                        <?php //Arquivo - tipoArquivo = 3.?>
                        <?php //**************************************************************************************?>
                        <?php if($linhaArquivos['tipo_arquivo'] == "3"){ ?>
                            <div class="AdmTexto01" style="display: none;">
                                <?php if($linhaArquivos['arquivo'] <> ""){ ?>
                                    <?php 
                                    //Rotina para ajudar a verificar a extensão do arquivo.
                                    $arrArquivoExtensao = explode(".", $linhaArquivos['arquivo']);
                                    $arquivoExtensao = strtolower(end($arrArquivoExtensao));
                                    ?>
                                    
                                    <?php //Download. ?>
                                    <?php if($linhaArquivos['config_arquivo'] == 3){ ?>
                                        <?php if(strpos($GLOBALS['configImagensFormatos'], $arquivoExtensao) !== false) {?>
                                            <a href="<?php echo "SiteAdmArquivosDownload.php?nomeArquivo=" . "o" . $linhaArquivos['arquivo']; //Imagens - incluir 'o' na frente do nome do arquivo.?>" target="_blank" class="AdmLinks01">
                                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaArquivos['legenda']); ?>
                                            </a>
                                        <?php }else{ ?>
                                            <a href="<?php echo "SiteAdmArquivosDownload.php?nomeArquivo=" . $linhaArquivos['arquivo'];?>" target="_blank" class="AdmLinks01">
                                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaArquivos['legenda']); ?>
                                            </a>
                                        <?php } ?>
                                    <?php } ?>
                                
                                    <?php //Direto para mídia. ?>
                                    <?php if($linhaArquivos['config_arquivo'] == 4){ ?>
                                        <a href="../<?php echo $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos'];?>/<?php echo $linhaArquivos['arquivo'];?>" target="_blank" class="AdmLinks01">
                                            <?php echo Funcoes::ConteudoMascaraLeitura($linhaArquivos['legenda']); ?>
                                        </a>
                                    <?php } ?>
                                <?php }else{ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($linhaArquivos['legenda']); ?>
                                <?php } ?>
                            </div>
                            
                            <?php //Registro. ?>
                            <div class="ArquivosImagensContainer">
                                <?php if($linhaArquivos['arquivo'] <> ""){ ?>
                                    <?php 
                                    //Rotina para ajudar a verificar a extensão do arquivo.
                                    $arrArquivoExtensao = explode(".", $linhaArquivos['arquivo']);
                                    $arquivoExtensao = strtolower(end($arrArquivoExtensao));
                                    ?>

                                    <div align="center" style="position: relative; display: block; margin-top: 10px;">
										<?php //Download. ?>
                                        <?php if($linhaArquivos['config_arquivo'] == 3){ ?>
                                            <?php if(strpos($GLOBALS['configImagensFormatos'], $arquivoExtensao) !== false) {?>
                                                <a href="<?php echo "SiteAdmArquivosDownload.php?nomeArquivo=" . "o" . $linhaArquivos['arquivo']; //Imagens - incluir 'o' na frente do nome do arquivo.?>" target="_blank" class="AdmLinks01">
                                                    <img src="img/icone-documento.png" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaArquivos['legenda']); ?>" />
                                                </a>
                                            <?php }else{ ?>
                                                <a href="<?php echo "SiteAdmArquivosDownload.php?nomeArquivo=" . $linhaArquivos['arquivo'];?>" target="_blank" class="AdmLinks01">
                                                    <img src="img/icone-documento.png" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaArquivos['legenda']); ?>" />
                                                </a>
                                            <?php } ?>
                                        <?php } ?>
                                    
                                        <?php //Direto para mídia. ?>
                                        <?php if($linhaArquivos['config_arquivo'] == 4){ ?>
                                            <a href="../<?php echo $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos'];?>/<?php echo $linhaArquivos['arquivo'];?>" target="_blank" class="AdmLinks01">
                                                <img src="img/icone-documento.png" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaArquivos['legenda']); ?>" />
                                            </a>
                                        <?php } ?>
                                    </div>
                                    <div align="center" class="AdmTexto01">
                                        <?php echo Funcoes::ConteudoMascaraLeitura($linhaArquivos['legenda']); ?>
                                    </div>
                                    <div align="center" class="AdmTexto01">
										<?php //Download. ?>
                                        <?php if($linhaArquivos['config_arquivo'] == 3){ ?>
                                            <?php if(strpos($GLOBALS['configImagensFormatos'], $arquivoExtensao) !== false) {?>
                                                <a href="<?php echo "SiteAdmArquivosDownload.php?nomeArquivo=" . "o" . $linhaArquivos['arquivo']; //Imagens - incluir 'o' na frente do nome do arquivo.?>" target="_blank" class="AdmLinks01">
                                                    <?php //echo Funcoes::ConteudoMascaraLeitura($linhaArquivos['legenda']); ?>
                                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteArquivosAcoesBaixar"); ?> 
                                                    <br />
                                                    (<?php echo $linhaArquivos['arquivo'];?> - <?php echo round(filesize("../" . $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos']. "/o" . $linhaArquivos['arquivo']) / 1024, 2);?> kb)
                                                </a>
                                            <?php }else{ ?>
                                                <a href="<?php echo "SiteAdmArquivosDownload.php?nomeArquivo=" . $linhaArquivos['arquivo'];?>" target="_blank" class="AdmLinks01">
                                                    <?php //echo Funcoes::ConteudoMascaraLeitura($linhaArquivos['legenda']); ?>
                                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteArquivosAcoesBaixar"); ?>
                                                    <br />
                                                    (<?php echo $linhaArquivos['arquivo'];?> - <?php echo round(filesize("../" . $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos']. "/" . $linhaArquivos['arquivo']) / 1024, 2);?> kb)
                                                </a>
                                            <?php } ?>
                                        <?php } ?>
                                    
                                        <?php //Direto para mídia. ?>
                                        <?php if($linhaArquivos['config_arquivo'] == 4){ ?>
                                            <a href="../<?php echo $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos'];?>/<?php echo $linhaArquivos['arquivo'];?>" target="_blank" class="AdmLinks01">
                                                <?php //echo Funcoes::ConteudoMascaraLeitura($linhaArquivos['legenda']); ?>
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteArquivosAcoesBaixar"); ?>
                                                <br />
                                                (<?php echo $linhaArquivos['arquivo'];?> - <?php echo round(filesize("../" . $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos']. "/" . $linhaArquivos['arquivo']) / 1024, 2);?> kb)
                                            </a>
                                        <?php } ?>
                                    </div>
                                    <div align="center" class="AdmTexto01">
                                        <?php echo Funcoes::ConteudoMascaraLeitura($linhaArquivos['descricao']); ?>
                                    </div>
                                <?php }else{ ?>
                                	<div align="center" class="AdmTexto01">
										<?php echo Funcoes::ConteudoMascaraLeitura($linhaArquivos['legenda']); ?>
                                    </div>
                                    <div align="center" class="AdmTexto01">
                                        <?php echo Funcoes::ConteudoMascaraLeitura($linhaArquivos['descricao']); ?>
                                    </div>
                                <?php } ?>
                            </div>
                            
                            
                        <?php } ?>
                        <?php //**************************************************************************************?>
                        
                        
                        <?php //Zip - tipoArquivo = 4.?>
                        <?php //**************************************************************************************?>
                        <?php if($linhaArquivos['tipo_arquivo'] == "4"){ ?>
                        
                        <?php } ?>
                        <?php //**************************************************************************************?>
                        
                        
                        <?php //SWF - tipoArquivo = 5.?>
                        <?php //**************************************************************************************?>
                        <?php if($linhaArquivos['tipo_arquivo'] == "5"){ ?>
                            <div align="center">
                                <?php
                                $arrDimensaoArquivo = explode(",", $linhaArquivos['dimensao_arquivo']);
                                $swfW = $arrDimensaoArquivo[0];
                                $swfH = $arrDimensaoArquivo[1];
                                ?>		
                                            
                                <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="<?php echo $swfW;?>" height="<?php echo $swfH;?>">
                                    <param name="movie" value="../<?php echo $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos'];?>/<?php echo $linhaArquivos['arquivo'];?>?variavelCache=<?php echo date("s"); ?>">
                                    <param name="quality" value="high">
                                    <embed src="../<?php echo $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos'];?>/<?php echo $linhaArquivos['arquivo'];?>?variavelCache=<?php echo date("s"); ?>" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="<?php echo $swfW;?>" height="<?php echo $swfH;?>"></embed>
                                </object>
                            </div>
                        <?php } ?>
                        <?php //**************************************************************************************?>
                  <?php } ?>
        <?php } ?>
    </div>

<?php 
$pageSite->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>
<?php
//Limpeza de objetos.
//----------
unset($strSqlArquivosSelect);
unset($statementArquivosSelect);
unset($resultadoArquivos);
unset($linhaArquivos);
//----------


//Inclusão do template do layout.
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>