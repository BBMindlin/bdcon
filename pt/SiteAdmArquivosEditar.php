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
$idTbArquivos = $_GET["idTbArquivos"];
$idParent = DbFuncoes::GetCampoGenerico01($idTbArquivos, "tb_arquivos", "id_parent");
$tipoArquivo = $_GET["tipoArquivo"];
$detalhe01 = $_GET["detalhe01"];
$detalhe02 = $_GET["detalhe02"];

$paginaRetorno = "SiteAdmArquivosIndice.php";
$paginaRetornoExclusao = "SiteAdmArquivosEditar.php";
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
	<?php echo htmlentities($GLOBALS['configTituloSite']); ?> - <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteArquivosEditar"); ?>
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
		<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteArquivos03Editar"); ?>
    <?php }else{ ?>
		<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteArquivosEditar"); ?>
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
    
    
	<?php //Opções gerais.?>
    <?php //----------------------?>
    <?php 
	//Definição de variáveis do include.
	$includeAdmOpcoes_tipoOpcoes = "1";
	$includeAdmOpcoes_configOpcoes = "";
	?>
    
    <?php include "IncludeAdmOpcoes.php";?>
    <?php //----------------------?>
    
    
    <br />
	<?php //Opções principais.?>
    <?php //----------------------?>
    <?php 
	//Definição de variáveis do include.
	$includeAdmOpcoes_tipoOpcoes = "2";
	$includeAdmOpcoes_configOpcoes = "";
	?>
    
    <?php include "IncludeAdmOpcoes.php";?>
    <?php //----------------------?>

    
    <br />
	<?php //Opções de informações complementares.?>
    <?php //----------------------?>
    <?php 
	//Definição de variáveis do include.
	$includeAdmOpcoes_tipoOpcoes = "ic1";
	$includeAdmOpcoes_configOpcoes = "";
	?>
    
    <?php include "IncludeAdmOpcoes.php";?>
    <?php //----------------------?>


    <form name="formArquivosEditar" id="formArquivosEditar" action="SiteAdmArquivosEditarExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <table class="AdmTabelaCampos01">
            <tr>
                <td class="AdmTbFundoEscuro" colspan="4">
                    <div align="center" class="AdmTexto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteArquivosEditar"); ?>
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
                        <input type="text" name="n_classificacao" id="n_classificacao" class="AdmCampoNumerico01" maxlength="10" value="<?php echo $tbArquivosNClassificacao; ?>" />
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
                            <input name="config_arquivo" type="radio" value="1" class="AdmCampoCheckBox01" <?php if($tbArquivosConfigArquivo == "1"){?>checked="true" <?php }?>/> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemVisualizacao1"); ?>
                        </div>
                        <div>
                            <input name="config_arquivo" type="radio" value="2" class="AdmCampoCheckBox01" <?php if($tbArquivosConfigArquivo == "2"){?>checked="true" <?php }?>/> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemVisualizacao2"); ?>
                        </div>
                        <div>
                            <input name="config_arquivo" type="radio" value="3" class="AdmCampoCheckBox01" <?php if($tbArquivosConfigArquivo == "3"){?>checked="true" <?php }?>/> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemVisualizacao3"); ?>
                        </div>
                        <div>
                            <input name="config_arquivo" type="radio" value="4" class="AdmCampoCheckBox01" <?php if($tbArquivosConfigArquivo == "4"){?>checked="true" <?php }?>/> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemVisualizacao4"); ?>
                        </div>
                    </div>
                </td>
            </tr>
            <?php } ?>


            <?php if($tipoArquivo == "3"){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteArquivosVisualizacao"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <div>
                            <input name="config_arquivo" type="radio" value="3" class="AdmCampoCheckBox01" <?php if($tbArquivosConfigArquivo == "3"){?>checked="true" <?php }?>/> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemVisualizacao3"); ?>
                        </div>
                        <div>
                            <input name="config_arquivo" type="radio" value="4" class="AdmCampoCheckBox01" <?php if($tbArquivosConfigArquivo == "4"){?>checked="true" <?php }?>/> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemVisualizacao4"); ?>
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
                        <?php
                        if(!empty($tbArquivosDuracaoArquivo))
                        {
                            $arrDuracaoArquivo = explode(":", $tbArquivosDuracaoArquivo);
                            $duracaoMin = $arrDuracaoArquivo[0];
                            $duracaoSeg = $arrDimensaoArquivo[1];
                        }
                        ?>
                        <input type="text" name="duracao_min" id="duracao_min" class="AdmCampoNumericoReduzido01" maxlength="255" value="<?php echo $duracaoMin; ?>" />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemMinutos"); ?>
                        <input type="text" name="duracao_seg" id="duracao_seg" class="AdmCampoNumericoReduzido01" maxlength="255" value="<?php echo $duracaoMin; ?>" />
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
                        <?php
                        if(!empty($tbArquivosDimensaoArquivo))
                        {
                            $arrDuracaoArquivo = explode(":", $tbArquivosDimensaoArquivo);
                            $dimensaoW = $arrDimensaoArquivo[0];
                            $dimensaoH = $arrDimensaoArquivo[1];
                        }
                        ?>
                        <input type="text" name="dimensao_w" id="dimensao_w" class="AdmCampoNumericoReduzido01" maxlength="255" value="<?php echo $dimensaoW; ?>" />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemLarguraPixels"); ?>
                        <input type="text" name="dimensao_h" id="dimensao_h" class="AdmCampoNumericoReduzido01" maxlength="255" value="<?php echo $dimensaoH; ?>" />
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
                            <input type="text" name="titulo" id="titulo" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbArquivosTitulo; ?>" />
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>

            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteArquivosLegenda"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div>
                        <input type="text" name="legenda" id="legenda" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbArquivosLegenda; ?>" />
                    </div>
                </td>
            </tr>

            <?php if($GLOBALS['HabilitarArquivosDescricao'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteArquivosDescicao"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div>
                        <textarea name="descricao" id="descricao" class="AdmCampoTextoMultilinha01"><?php echo $tbArquivosDescricao; ?></textarea>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($tipoArquivo == "2"){ ?>
                <?php if($GLOBALS['HabilitarArquivosVideosCodigoHTML'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemHTML01"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <textarea name="codigo_html" id="codigo_html" class="AdmCampoTextoMultilinhaURL"><?php echo $tbArquivosCodigoHTML; ?></textarea>
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemHTML02"); ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>

            <tr id="cell_imagem">
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemArquivo"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div>
                        <input type="file" name="ArquivoUpload1" id="ArquivoUpload1" class="AdmCampoArquivoUpload01" />
                    </div>
                </td>
            </tr>
        </table>
        <div>
            <div style="float:left;">
                <input type="image" name="submit" value="Submit" src="img/btoAtualizar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoAtualizar"); ?>" />
                
                <input name="idTbArquivos" type="hidden" id="idTbArquivos" value="<?php echo $tbArquivosId; ?>" />
                <input name="id_parent" type="hidden" id="id_parent" value="<?php echo $tbArquivosIdParent; ?>" />
                <input name="tipo_arquivo" type="hidden" id="tipo_arquivo" value="<?php echo $tbArquivosTipoArquivo; ?>" />
                <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                <input name="masterPageSiteSelect" type="hidden" id="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
                <input name="detalhe01" type="hidden" id="detalhe01" value="<?php echo $detalhe01; ?>" />
                <input name="detalhe02" type="hidden" id="detalhe02" value="<?php echo $detalhe02; ?>" />
            </div>
            <div style="float:right;">
                <a href="<?php echo $paginaRetorno; ?>?idParent=<?php echo $idParent; ?><?php echo $queryPadrao; ?>">
                    <img src="img/btoVoltar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoVoltar"); ?>"  />
                </a>
            </div>
        </div>
    </form>
<?php 
$pageSite->cphConteudoPrincipal = ob_get_clean(); 
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


//Inclusão do template do layout.
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>