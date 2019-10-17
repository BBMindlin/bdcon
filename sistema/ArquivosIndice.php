<?php
//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeLayout.php";


//Verificação de login Master.
LoginAutenticacao::UsuarioLoginVerificacao();


//Verificação de login Master.
$idParent = $_GET["idParent"];
$tipoArquivo = $_GET["tipoArquivo"];
$detalhe01 = $_GET["detalhe01"];
$detalhe02 = $_GET["detalhe02"];

$paginaRetorno = "ArquivosIndice.php";
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
//----------


//Parâmetros.
//----------
$statementArquivosSelect = $dbSistemaConPDO->prepare($strSqlArquivosSelect);

if ($statementArquivosSelect !== false)
{
	$statementArquivosSelect->execute(array(
		"id_parent" => $idParent,
		"tipo_arquivo" => $tipoArquivo
	));
}
//----------


//$resultadoArquivos = $dbSistemaConPDO->query($strSqlArquivosSelect);
$resultadoArquivos = $statementArquivosSelect->fetchAll();
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistema"); ?> - <?php echo $GLOBALS['configNomeCliente']; ?>
<?php 
$page->cphTitle = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Head.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphHead*/ ?>
	
<?php 
$page->cphHead = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Cabeçalho.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphConteudoCabecalho*/ ?>
    <div>
        <div align="left" class="TextoTitulo01">
        	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaArquivos"); ?> - <?php echo $detalhe01; ?>
        </div>
    </div>
<?php 
$page->cphConteudoCabecalho = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>



<?php //Conteúdo principal.?>
<?php //**************************************************************************************?>
<?php ob_start(); /*cphConteudoPrincipal*/ ?>

    <div class="PosIframeArquivosForm"> 
        <form name="formArquivos" id="formArquivos" action="ArquivosIndiceExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="4">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaArquivos"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
    
                <?php if($GLOBALS['habilitarArquivosNClassificacao'] == 1){ ?>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNClassificacao"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div>
                            <input type="text" name="n_classificacao" id="n_classificacao" class="CampoNumerico01" maxlength="10" value="0" />
                        </div>
                    </td>
                </tr>
                <?php } ?>
    
                <?php if($tipoArquivo == "2"){ ?>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaArquivosVisualizacao"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div align="left" class="Texto01">
                            <div>
                                <input name="config_arquivo" type="radio" value="1" class="CampoCheckBox01" checked="true" /> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemVisualizacao1"); ?>
                            </div>
                            <div>
                                <input name="config_arquivo" type="radio" value="2" class="CampoCheckBox01" /> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemVisualizacao2"); ?>
                            </div>
                            <div>
                                <input name="config_arquivo" type="radio" value="3" class="CampoCheckBox01" /> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemVisualizacao3"); ?>
                            </div>
                            <div>
                                <input name="config_arquivo" type="radio" value="4" class="CampoCheckBox01" /> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemVisualizacao4"); ?>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php } ?>
    
    
                <?php if($tipoArquivo == "3"){ ?>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaArquivosVisualizacao"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div class="Texto01">
                            <div>
                                <input name="config_arquivo" type="radio" value="3" class="CampoCheckBox01" checked="true" /> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemVisualizacao3"); ?>
                            </div>
                            <div>
                                <input name="config_arquivo" type="radio" value="4" class="CampoCheckBox01" /> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemVisualizacao4"); ?>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php } ?>
    
                <?php if($tipoArquivo == "2"){ ?>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaArquivosDuracao"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div class="Texto01">
                            <input type="text" name="duracao_min" id="duracao_min" class="CampoNumericoReduzido01" maxlength="255" />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemMinutos"); ?>
                            <input type="text" name="duracao_seg" id="duracao_seg" class="CampoNumericoReduzido01" maxlength="255" />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemSegundos"); ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
    
                <?php if($tipoArquivo == "5"){ ?>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaArquivosDimensao"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div class="Texto01">
                            <input type="text" name="dimensao_w" id="dimensao_w" class="CampoNumericoReduzido01" maxlength="255" value="0" />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemLarguraPixels"); ?>
                            <input type="text" name="dimensao_h" id="dimensao_h" class="CampoNumericoReduzido01" maxlength="255" value="0" />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAlturaPixels"); ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
    
                <?php if($tipoArquivo == "2"){ ?>
                    <?php if($GLOBALS['habilitarArquivosVideosTitulos'] == 1){ ?>
                    <tr>
                        <td class="TbFundoMedio TabelaColuna01">
                            <div align="left" class="Texto01">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaArquivosTitulo"); ?>:
                            </div>
                        </td>
                        <td class="TbFundoClaro" colspan="3">
                            <div>
                                <input type="text" name="titulo" id="titulo" class="CampoTextoArquivos" maxlength="255" />
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
    
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaArquivosLegenda"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div>
                            <input type="text" name="legenda" id="legenda" class="CampoTextoArquivos" maxlength="255" />
                        </div>
                    </td>
                </tr>
    
                <?php if($GLOBALS['habilitarArquivosDescricao'] == 1){ ?>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaArquivosDescicao"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div>
                            <textarea name="descricao" id="descricao" class="CampoTextoMultilinhaArquivos"></textarea>
                        </div>
                    </td>
                </tr>
                <?php } ?>
    
                <?php if($tipoArquivo == "2"){ ?>
                    <?php if($GLOBALS['habilitarArquivosVideosCodigoHTML'] == 1){ ?>
                    <tr>
                        <td class="TbFundoMedio TabelaColuna01">
                            <div align="left" class="Texto01">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemHTML01"); ?>:
                            </div>
                        </td>
                        <td class="TbFundoClaro" colspan="3">
                            <div class="Texto01">
                                <textarea name="codigo_html" id="codigo_html" class="CampoTextoMultilinhaArquivos"></textarea>
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemHTML02"); ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
    
                <tr id="cell_imagem">
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemArquivo"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div>
                            <input type="file" name="ArquivoUpload1" id="ArquivoUpload1" class="CampoArquivoUploadArquivos" />
                        </div>
                    </td>
                </tr>
            </table>
            
            <div>
                <div style="float:left;">
                    <input type="image" name="submit" value="Submit" src="img/btoUpload.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoUpload"); ?>" />
                    
                    <input name="id_parent" type="hidden" id="id_parent" value="<?php echo $idParent; ?>" />
                    <input name="tipo_arquivo" type="hidden" id="tipo_arquivo" value="<?php echo $tipoArquivo; ?>" />
                    <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                    <input name="masterPageSelect" type="hidden" id="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
                    <input name="detalhe01" type="hidden" id="detalhe01" value="<?php echo $detalhe01; ?>" />
                    <input name="detalhe02" type="hidden" id="detalhe02" value="<?php echo $detalhe02; ?>" />
                </div>
                <div style="float:right;">
                    &nbsp;
                </div>
            </div>
        </form>
    </div>
    
    <div class="PosIframeArquivosDivisaoVertical"> 
    
    </div>

    <div class="PosIframeArquivosIndice"> 
        <div align="center" class="TextoErro">
            <?php echo $mensagemErro;?>
        </div>
        <div align="center" class="TextoSucesso">
            <?php echo $mensagemSucesso;?>
        </div>

		<?php
        if (empty($resultadoArquivos))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
    
            <form name="formArquivosAcoes" id="formArquivosAcoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
                <input name="strTabela" id="strTabela" type="hidden" value="tb_arquivos" />
                <input name="idParent" id="idParent" type="hidden" value="<?php echo $idParent; ?>" />
                <input name="tipoArquivo" id="tipoArquivo" type="hidden" value="<?php echo $tipoArquivo; ?>" />
    
                <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                <input name="masterPageSelect" type="hidden" id="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
                <input name="detalhe01" type="hidden" id="detalhe01" value="<?php echo $detalhe01; ?>" />
                <input name="detalhe02" type="hidden" id="detalhe02" value="<?php echo $detalhe02; ?>" />
                <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
                <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
                <div style="position:relative; display: block; clear: both;">
                    <div align="right" style="float: right;">
                        <input type="image" name="submit" value="Submit" src="img/btoExcluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoExcluir"); ?>">
                    </div>
                </div>
                <table width="100%" class="TabelaDados01">
                  <tr class="TbFundoEscuro">
                    <?php if($GLOBALS['habilitarArquivosNClassificacao'] == 1){ ?>
                    <td width="50" class="TbFundoEscuro TabelaDados01Celula">
                        <div align="center" class="Texto02">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNClassificacaoA"); ?>
                        </div>
                    </td>
                    <?php } ?>
                    
                    <td class="TabelaDados01Celula">
                        <div class="Texto02">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemArquivo"); ?>
                        </div>
                    </td>
                    
                    <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                        <div align="center" class="Texto02">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </div>
                    </td>
                    
                    <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                        <div align="center" class="Texto02">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemExcluir"); ?>
                        </div>
                    </td>
                  </tr>
                  <?php
                    //Loop pelos resultados.
                    foreach($resultadoArquivos as $linhaArquivos)
                    {
                  ?>
                  <tr class="TbFundoClaro">
                    <?php if($GLOBALS['habilitarArquivosNClassificacao'] == 1){ ?>
                    <td class="TabelaDados01Celula">
                        <div align="center" class="Texto01">
                            <?php echo $linhaArquivos['n_classificacao'];?>
                        </div>
                    </td>
                    <?php } ?>
                    
                    <td class="TabelaDados01Celula">
						<?php //Imagem - tipoArquivo = 1.?>
                        <?php //**************************************************************************************?>
                        <?php if($linhaArquivos['tipo_arquivo'] == "1"){ ?>
                            <?php if(!empty($linhaArquivos['arquivo'])){ ?>
                                <div align="center" class="Texto01">
                                    <?php //Sem pop-up. ?>
                                    <?php if($GLOBALS['configImagemPopUp'] == 0){ ?>
                                        <img src="<?php echo $GLOBALS['configDiretorioArquivos'];?>/<?php echo $linhaArquivos['arquivo'];?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaArquivos['legenda']); ?>" />
                                    <?php } ?>
                                
                                    <?php //SlimBox 2 - JQuery. ?>
                                    <?php if($GLOBALS['configImagemPopUp'] == 1){ ?>
                                        <a href="<?php echo $GLOBALS['configDiretorioArquivos'];?>/g<?php echo $linhaArquivos['arquivo'];?>" rel="lightbox" title="">
                                            <img src="<?php echo $GLOBALS['configDiretorioArquivos'];?>/<?php echo $linhaArquivos['arquivo'];?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaArquivos['legenda']); ?>" />
                                        </a>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                            <div align="center" class="Texto01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaArquivos['legenda']); ?>
                            </div>
                        <?php } ?>
                        <?php //**************************************************************************************?>
                        
                        
						<?php //Vídeo - tipoArquivo = 2.?>
                        <?php //**************************************************************************************?>
                        <?php if($linhaArquivos['tipo_arquivo'] == "2"){ ?>
                            <?php if($GLOBALS['habilitarArquivosVideosTitulos'] == 0){ ?>
                            <div class="Texto01" align="center">
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

                            <div class="Texto01" align="center">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaArquivos['legenda']); ?>
                            </div>

                            <?php //Opções.?>
                        
                        <?php } ?>
                        <?php //**************************************************************************************?>
                        
                        
						<?php //Arquivo - tipoArquivo = 3.?>
                        <?php //**************************************************************************************?>
                        <?php if($linhaArquivos['tipo_arquivo'] == "3"){ ?>
                            <div align="center" class="Texto01">
                                <?php if($linhaArquivos['arquivo'] <> ""){ ?>
                                    <?php 
                                    //Rotina para ajudar a verificar a extensão do arquivo.
                                    $arrArquivoExtensao = explode(".", $linhaArquivos['arquivo']);
                                    $arquivoExtensao = strtolower(end($arrArquivoExtensao));
                                    ?>
                                    
                                    <?php //Download. ?>
                                    <?php if($linhaArquivos['config_arquivo'] == 3){ ?>
                                        <?php if(strpos($GLOBALS['configImagensFormatos'], $arquivoExtensao) !== false) {?>
                                            <a href="<?php echo "ArquivosDownload.php?nomeArquivo=" . "o" . $linhaArquivos['arquivo']; //Imagens - incluir 'o' na frente do nome do arquivo.?>" target="_blank" class="ConteudoLinks">
                                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaArquivos['legenda']); ?>
                                            </a>
                                        <?php }else{ ?>
                                            <a href="<?php echo "ArquivosDownload.php?nomeArquivo=" . $linhaArquivos['arquivo'];?>" target="_blank" class="ConteudoLinks">
                                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaArquivos['legenda']); ?>
                                            </a>
                                        <?php } ?>
                                    <?php } ?>
                                
                                    <?php //Direto para mídia. ?>
                                    <?php if($linhaArquivos['config_arquivo'] == 4){ ?>
                                        <a href="<?php echo $GLOBALS['configDiretorioArquivos'];?>/<?php echo $linhaArquivos['arquivo'];?>" target="_blank" class="ConteudoLinks">
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
                                    <param name="movie" value="<?php echo $GLOBALS['configDiretorioArquivos'];?>/<?php echo $linhaArquivos['arquivo'];?>?variavelCache=<?php echo date("s"); ?>">
                                    <param name="quality" value="high">
                                    <embed src="<?php echo $GLOBALS['configDiretorioArquivos'];?>/<?php echo $linhaArquivos['arquivo'];?>?variavelCache=<?php echo date("s"); ?>" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="<?php echo $swfW;?>" height="<?php echo $swfH;?>"></embed>
                                </object>
                            </div>
                        <?php } ?>
                        <?php //**************************************************************************************?>
                    </td>
                    
                    <td class="TabelaDados01Celula">
                        <div align="center" class="Texto01">
                            <a href="ArquivosEditar.php?idTbArquivos=<?php echo $linhaArquivos['id'];?><?php echo $queryPadrao;?>" class="Links01">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                            </a>
                        </div>
                    </td>
                    <td class="TabelaDados01Celula">
                        <div align="center" class="Texto01">
                            <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaArquivos['id'];?>" class="CampoCheckBox01" />
                        </div>
                    </td>
                  </tr>
                  <?php } ?>
                </table>
            </form>
        <?php } ?>
    </div>
    
    
<?php 
$page->cphConteudoPrincipal = ob_get_clean(); 
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
?>


<?php 
//Inclusão do template do layout.
include_once $page->LayoutSistema;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>