<?php
//Definição de variáveis.
$IdTbArquivos = $includeArquivosImagens_idTbArquivos;
$TipoVisualizacao = $includeArquivosImagens_tipoVisualizacao; //1 - Thumbnails com ampliação | 2 - Bootstrap Carroussel (slide/scroll de um em um) | 3 - Imagem Tamanho Normal | 4 Carroussel Scroll Vertical Simples com Ampliação.
	
$LimiteRegistros = $includeArquivosImagens_limiteRegistros;
$NImagensVisivelScroll = $includeArquivosImagens_nImagensVisivelScroll;
$ConfigImagemZoom = $includeArquivosImagens_configImagemZoom; //0 - desabilitado | 1 - JQuery ElevateZoom | 2 - JQuery PanZoom

$paginacaoNumero = "";
$paginacaoTotal = 0;

$imagensTipoVisualizacao2 = "";
//$arrIImagensTipoVisualizacao2();
$countImagensTotal = "";


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
$strSqlArquivosSelect .= "AND tipo_arquivo = 1 ";
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
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteArquivosImagensTitulo");?>
</div>
<?php } ?>


<?php if(!empty($resultadoArquivos)){?>
	<?php //Diagramação 1.?>
    <?php //**************************************************************************************?>
    <?php if($TipoVisualizacao == "1"){ ?>
        <div align="center" class="LoginTexto">
			<?php
            //Loop pelos resultados.
            foreach($resultadoArquivos as $linhaArquivos)
            {
            ?>
                <div class="ArquivosImagensContainer">
					<?php //SlimBox 2 - JQuery.?>
                    <?php if($GLOBALS['configImagemPopUp'] == "1"){ ?>
                        <div align="center" class="ArquivosImagens"><a href="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>g<?php echo $linhaArquivos['arquivo'];?>" rel="lightbox-<?php echo $linhaArquivos['id_parent'];?>" title="<?php echo Funcoes::ConteudoMascaraLeitura($linhaArquivos['legenda']);?>"><img src="<?php echo $GLOBALS['configCaminhoSiteImagens'];?><?php echo $linhaArquivos['arquivo'];?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaArquivos['legenda']);?>" /></a></div>
                    <?php } ?>

                    <div align="center" class="ArquivosLegenda">
                        <?php echo Funcoes::ConteudoMascaraLeitura($linhaArquivos['legenda']);?>
                    </div>
                </div>
            <?php } ?>
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