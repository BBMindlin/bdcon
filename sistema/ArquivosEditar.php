<?php
//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeLayout.php";


//Verificação de login Master.
LoginAutenticacao::UsuarioLoginVerificacao();


//Verificação de login Master.
$idTbArquivos = $_GET["idTbArquivos"];
$idParent = DbFuncoes::GetCampoGenerico01($idTbArquivos, "tb_arquivos", "id_parent");
$tipoArquivo = $_GET["tipoArquivo"];
$detalhe01 = $_GET["detalhe01"];
$detalhe02 = $_GET["detalhe02"];

$paginaRetorno = "ArquivosIndice.php";
$paginaRetornoExclusao = "ArquivosEditar.php";
$variavelRetorno = "idTbArquivos";
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
$strSqlArquivosDetalhesSelect = "";
$strSqlArquivosDetalhesSelect .= "SELECT ";
//$strSqlArquivosDetalhesSelect .= "* ";
$strSqlArquivosDetalhesSelect .= "id, ";
$strSqlArquivosDetalhesSelect .= "id_parent, ";
$strSqlArquivosDetalhesSelect .= "data_arquivo, ";
$strSqlArquivosDetalhesSelect .= "tipo_arquivo, ";
$strSqlArquivosDetalhesSelect .= "n_classificacao, ";
$strSqlArquivosDetalhesSelect .= "arquivo, ";
$strSqlArquivosDetalhesSelect .= "arquivo_tumbnail, ";
$strSqlArquivosDetalhesSelect .= "tamanho_arquivo, ";
$strSqlArquivosDetalhesSelect .= "duracao_arquivo, ";
$strSqlArquivosDetalhesSelect .= "dimensao_arquivo, ";
$strSqlArquivosDetalhesSelect .= "titulo, ";
$strSqlArquivosDetalhesSelect .= "legenda, ";
$strSqlArquivosDetalhesSelect .= "descricao, ";
$strSqlArquivosDetalhesSelect .= "codigo_html, ";
$strSqlArquivosDetalhesSelect .= "informacao_complementar1, ";
$strSqlArquivosDetalhesSelect .= "informacao_complementar2, ";
$strSqlArquivosDetalhesSelect .= "informacao_complementar3, ";
$strSqlArquivosDetalhesSelect .= "informacao_complementar4, ";
$strSqlArquivosDetalhesSelect .= "informacao_complementar5, ";
$strSqlArquivosDetalhesSelect .= "palavras_chave, ";
$strSqlArquivosDetalhesSelect .= "config_arquivo, ";
$strSqlArquivosDetalhesSelect .= "n_visitas ";
$strSqlArquivosDetalhesSelect .= "FROM tb_arquivos ";
$strSqlArquivosDetalhesSelect .= "WHERE id <> 0 ";
//$strSqlArquivosDetalhesSelect .= "AND id_tb_categorias = :id_tb_categorias ";
$strSqlArquivosDetalhesSelect .= "AND id = :id ";
//$strSqlArquivosDetalhesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";


$statementArquivosDetalhesSelect = $dbSistemaConPDO->prepare($strSqlArquivosDetalhesSelect);

if ($statementArquivosDetalhesSelect !== false)
{
	$statementArquivosDetalhesSelect->execute(array(
		"id" => $idTbArquivos
	));
}

//$resultadoArquivosDetalhes = $dbSistemaConPDO->query($strSqlArquivosDetalhesSelect);
$resultadoArquivosDetalhes = $statementArquivosDetalhesSelect->fetchAll();

if (empty($resultadoArquivosDetalhes))
{
	//echo "Nenhum registro encontrado";
}else{
	foreach($resultadoArquivosDetalhes as $linhaArquivosDetalhes)
	{
		//Definição das variáveis de detalhes.
		$tbArquivosId = $linhaArquivosDetalhes['id'];
		$tbArquivosIdParent = $linhaArquivosDetalhes['id_parent'];
		$tbArquivosDataArquivo = Funcoes::DataLeitura01($linhaArquivosDetalhes['data_arquivo'], $GLOBALS['configSistemaFormatoData'], "1");
		$tbArquivosTipoArquivo = $linhaArquivosDetalhes['tipo_arquivo'];
		$tbArquivosNClassificacao = $linhaArquivosDetalhes['n_classificacao'];
		$tbArquivosArquivo = $linhaArquivosDetalhes['arquivo'];
		$tbArquivosArquivoTumbnail = $linhaArquivosDetalhes['arquivo_tumbnail'];
		$tbArquivosTamanhoArquivo = $linhaArquivosDetalhes['tamanho_arquivo'];
		$tbArquivosDuracaoArquivo = $linhaArquivosDetalhes['duracao_arquivo'];
		$tbArquivosDimensaoArquivo = $linhaArquivosDetalhes['dimensao_arquivo'];
		$tbArquivosTitulo = $linhaArquivosDetalhes['titulo'];
		$tbArquivosLegenda = $linhaArquivosDetalhes['legenda'];
		$tbArquivosDescricao = $linhaArquivosDetalhes['descricao'];
		$tbArquivosCodigoHTML = $linhaArquivosDetalhes['codigo_html'];
		$tbArquivosIC1 = Funcoes::ConteudoMascaraLeitura($linhaArquivosDetalhes['informacao_complementar1']);
		$tbArquivosIC2 = Funcoes::ConteudoMascaraLeitura($linhaArquivosDetalhes['informacao_complementar2']);
		$tbArquivosIC3 = Funcoes::ConteudoMascaraLeitura($linhaArquivosDetalhes['informacao_complementar3']);
		$tbArquivosIC4 = Funcoes::ConteudoMascaraLeitura($linhaArquivosDetalhes['informacao_complementar4']);
		$tbArquivosIC5 = Funcoes::ConteudoMascaraLeitura($linhaArquivosDetalhes['informacao_complementar5']);
		$tbArquivosPalavrasChave = $linhaArquivosDetalhes['palavras_chave'];
		$tbArquivosConfigArquivo = $linhaArquivosDetalhes['config_arquivo'];
		$tbArquivosNVisitas = $linhaArquivosDetalhes['n_visitas'];
		
		//Verificação de erro.
		//echo "tbArquivosId=" . $tbArquivosId . "<br>";
		//echo "tbArquivosIdParent=" . $tbArquivosIdParent . "<br>";
		//echo "tbArquivosLegenda=" . $tbArquivosLegenda . "<br>";
	}
}
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistema"); ?> - <?php echo $GLOBALS['configNomeCliente']; ?>
<?php 
$page->cphTitle = ob_get_clean(); 
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
        	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaArquivosEditar"); ?> - <?php echo $detalhe01; ?>
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
    <div align="center" class="TextoErro">
        <?php echo $mensagemErro;?>
    </div>
    <div align="center" class="TextoSucesso">
        <?php echo $mensagemSucesso;?>
    </div>
    
    <form name="formArquivosEditar" id="formArquivosEditar" action="ArquivosEditarExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <table class="TabelaCampos01">
            <tr>
                <td class="TbFundoEscuro" colspan="4">
                    <div align="center" class="Texto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaArquivosEditar"); ?>
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
                        <input type="text" name="n_classificacao" id="n_classificacao" class="CampoNumerico01" maxlength="10" value="<?php echo $tbArquivosNClassificacao; ?>" />
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
                            <input name="config_arquivo" type="radio" value="1" class="CampoCheckBox01" <?php if($tbArquivosConfigArquivo == "1"){?>checked="true" <?php }?>/> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemVisualizacao1"); ?>
                        </div>
                        <div>
                            <input name="config_arquivo" type="radio" value="2" class="CampoCheckBox01" <?php if($tbArquivosConfigArquivo == "2"){?>checked="true" <?php }?>/> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemVisualizacao2"); ?>
                        </div>
                        <div>
                            <input name="config_arquivo" type="radio" value="3" class="CampoCheckBox01" <?php if($tbArquivosConfigArquivo == "3"){?>checked="true" <?php }?>/> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemVisualizacao3"); ?>
                        </div>
                        <div>
                            <input name="config_arquivo" type="radio" value="4" class="CampoCheckBox01" <?php if($tbArquivosConfigArquivo == "4"){?>checked="true" <?php }?>/> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemVisualizacao4"); ?>
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
                            <input name="config_arquivo" type="radio" value="3" class="CampoCheckBox01" <?php if($tbArquivosConfigArquivo == "3"){?>checked="true" <?php }?>/> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemVisualizacao3"); ?>
                        </div>
                        <div>
                            <input name="config_arquivo" type="radio" value="4" class="CampoCheckBox01" <?php if($tbArquivosConfigArquivo == "4"){?>checked="true" <?php }?>/> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemVisualizacao4"); ?>
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
                        <?php
                        if(!empty($tbArquivosDuracaoArquivo))
                        {
                            $arrDuracaoArquivo = explode(":", $tbArquivosDuracaoArquivo);
                            $duracaoMin = $arrDuracaoArquivo[0];
                            $duracaoSeg = $arrDimensaoArquivo[1];
                        }
                        ?>
                        <input type="text" name="duracao_min" id="duracao_min" class="CampoNumericoReduzido01" maxlength="255" value="<?php echo $duracaoMin; ?>" />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemMinutos"); ?>
                        <input type="text" name="duracao_seg" id="duracao_seg" class="CampoNumericoReduzido01" maxlength="255" value="<?php echo $duracaoMin; ?>" />
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
                        <?php
                        if(!empty($tbArquivosDimensaoArquivo))
                        {
                            $arrDuracaoArquivo = explode(":", $tbArquivosDimensaoArquivo);
                            $dimensaoW = $arrDimensaoArquivo[0];
                            $dimensaoH = $arrDimensaoArquivo[1];
                        }
                        ?>
                        <input type="text" name="dimensao_w" id="dimensao_w" class="CampoNumericoReduzido01" maxlength="255" value="<?php echo $dimensaoW; ?>" />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemLarguraPixels"); ?>
                        <input type="text" name="dimensao_h" id="dimensao_h" class="CampoNumericoReduzido01" maxlength="255" value="<?php echo $dimensaoH; ?>" />
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
                            <input type="text" name="titulo" id="titulo" class="CampoTextoArquivos" maxlength="255" value="<?php echo $tbArquivosTitulo; ?>" />
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
                        <input type="text" name="legenda" id="legenda" class="CampoTextoArquivos" maxlength="255" value="<?php echo $tbArquivosLegenda; ?>" />
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
                        <textarea name="descricao" id="descricao" class="CampoTextoMultilinhaArquivos"><?php echo $tbArquivosDescricao; ?></textarea>
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
                            <textarea name="codigo_html" id="codigo_html" class="CampoTextoMultilinhaArquivos"><?php echo $tbArquivosCodigoHTML; ?></textarea>
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
                <input type="image" name="submit" value="Submit" src="img/btoAtualizar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoAtualizar"); ?>" />
                
                <input name="idTbArquivos" type="hidden" id="idTbArquivos" value="<?php echo $tbArquivosId; ?>" />
                <input name="id_parent" type="hidden" id="id_parent" value="<?php echo $tbArquivosIdParent; ?>" />
                <input name="tipo_arquivo" type="hidden" id="tipo_arquivo" value="<?php echo $tbArquivosTipoArquivo; ?>" />
                <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                <input name="masterPageSelect" type="hidden" id="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
                <input name="detalhe01" type="hidden" id="detalhe01" value="<?php echo $detalhe01; ?>" />
                <input name="detalhe02" type="hidden" id="detalhe02" value="<?php echo $detalhe02; ?>" />
            </div>
            <div style="float:right;">
                <a href="<?php echo $paginaRetorno; ?>?idParent=<?php echo $idParent; ?><?php echo $queryPadrao; ?>">
                    <img src="img/btoVoltar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoVoltar"); ?>"  />
                </a>
            </div>
        </div>
    </form>
<?php 
$page->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php
//Limpeza de objetos.
//----------
unset($strSqlArquivosDetalhesSelect);
unset($statementArquivosDetalhesSelect);
unset($resultadoArquivosDetalhes);
unset($linhaArquivosDetalhes);
//----------
?>


<?php 
//Inclusão do template do layout.
include_once $page->LayoutSistema;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>