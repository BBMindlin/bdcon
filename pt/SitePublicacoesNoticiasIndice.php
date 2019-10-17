<?php
//Importação dos arquivos de configuração.
require_once "../sistema/IncludeConfig.php"; //Deve vir antes do db.
require_once "../sistema/IncludeConexao.php";
require_once "../sistema/IncludeFuncoes.php";
//require_once "IncludeLayout.php";
require_once "IncludeLayoutSite.php";

	
//Resgate de variáveis.
$idParentPublicacoes = $_GET["idParentPublicacoes"];
$tipoPublicacao = $_GET["tipoPublicacao"];

$tituloLinkAtual = "";
$tituloCategoriaAtual = DbFuncoes::GetCampoGenerico01($idParentPublicacoes, "tb_categorias", "categoria");

$paginaRetorno = "SitePublicacoesNoticiasIndice.php";
$paginaRetornoExclusao = "SitePublicacoesNoticiasIndice.php";
$variavelRetorno = "idParentPublicacoes";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];

//Paginação.
if($GLOBALS['habilitarPublicacoesPaginacaoSimples'] == "1"){
	$paginacaoNRegistros = $GLOBALS['configPublicacoesPaginacaoNRegistros'];
	$paginacaoNumero = $_GET["paginacaoNumero"];
	if($paginacaoNumero == "")
	{
		$paginacaoNumero = 1;
	}
	//$paginacaoTotalRegistros = DbFuncoes::CountRegistrosGenericos("tb_publicacoes", "id_tb_categorias", $idParentPublicacoes); //Quantidade de registros.
	//$paginacaoTotal = ceil($paginacaoTotalRegistros / $paginacaoNRegistros);
	$paginacaoInicio = ($paginacaoNumero-1) * $paginacaoNRegistros;
}


$queryPadrao = "&idParentPublicacoes=" . $idParentPublicacoes . 
"&tipoPublicacao=" . $tipoPublicacao . 
"&paginaRetorno=" . $paginaRetorno . 
"&masterPageSelect=" . $masterPageSelect . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&variavelRetorno=" . $variavelRetorno;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Query de pesquisa.
//----------
$strSqlPublicacoesSelect = "";
$strSqlPublicacoesSelect .= "SELECT ";
//$strSqlPublicacoesSelect .= "* ";
$strSqlPublicacoesSelect .= "id, ";
$strSqlPublicacoesSelect .= "tipo_publicacao, ";
$strSqlPublicacoesSelect .= "id_tb_categorias, ";
$strSqlPublicacoesSelect .= "id_tb_cadastro_usuario, ";
$strSqlPublicacoesSelect .= "data_publicacao, ";
$strSqlPublicacoesSelect .= "data_final_publicacao, ";
$strSqlPublicacoesSelect .= "n_classificacao, ";
$strSqlPublicacoesSelect .= "titulo, ";
$strSqlPublicacoesSelect .= "conteudo_simples, ";
$strSqlPublicacoesSelect .= "informacao_complementar1, ";
$strSqlPublicacoesSelect .= "informacao_complementar2, ";
$strSqlPublicacoesSelect .= "informacao_complementar3, ";
$strSqlPublicacoesSelect .= "informacao_complementar4, ";
$strSqlPublicacoesSelect .= "informacao_complementar5, ";
$strSqlPublicacoesSelect .= "fonte, ";
$strSqlPublicacoesSelect .= "link_fonte, ";
$strSqlPublicacoesSelect .= "editoria, ";
$strSqlPublicacoesSelect .= "palavras_chave, ";
$strSqlPublicacoesSelect .= "ativacao, ";
$strSqlPublicacoesSelect .= "ativacao_home, ";
$strSqlPublicacoesSelect .= "ativacao_home_categoria, ";
$strSqlPublicacoesSelect .= "acesso_restrito, ";
$strSqlPublicacoesSelect .= "imagem ";

//Paginação (subquery).
if($GLOBALS['habilitarPublicacoesSistemaPaginacao'] == "1"){
	$strSqlPublicacoesSelect .= ", (SELECT COUNT(id) ";
	$strSqlPublicacoesSelect .= "FROM tb_publicacoes ";
	$strSqlPublicacoesSelect .= "WHERE id <> 0 ";
	
	if($idParentPublicacoes <> "")
	{
		$strSqlPublicacoesSelect .= "AND id_tb_categorias = :id_tb_categorias ";
	}
	if($tipoPublicacao <> "")
	{
		$strSqlPublicacoesSelect .= "AND tipo_publicacao = :tipo_publicacao ";
	}

	$strSqlPublicacoesSelect .= ") totalRegistros ";
}

$strSqlPublicacoesSelect .= "FROM tb_publicacoes ";
$strSqlPublicacoesSelect .= "WHERE id <> 0 ";
if($idParentPublicacoes <> "")
{
	$strSqlPublicacoesSelect .= "AND id_tb_categorias = :id_tb_categorias ";
}
if($tipoPublicacao <> "")
{
	$strSqlPublicacoesSelect .= "AND tipo_publicacao = :tipo_publicacao ";
}
$strSqlPublicacoesSelect .= "AND ativacao = 1 ";
$strSqlPublicacoesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoPublicacoes'] . " ";

//Paginação.
if($GLOBALS['habilitarPublicacoesPaginacaoSimples'] == "1"){ 
	if($configTipoDB == 2)
	{
		$strSqlPublicacoesSelect .= "LIMIT " . $paginacaoInicio . ", " . $paginacaoNRegistros . "";
	}
}

$statementPublicacoesSelect = $dbSistemaConPDO->prepare($strSqlPublicacoesSelect);

if ($statementPublicacoesSelect !== false)
{
	if($idParentPublicacoes <> "")
	{
		$statementPublicacoesSelect->bindParam(':id_tb_categorias', $idParentPublicacoes, PDO::PARAM_STR);
	}
	if($tipoPublicacao <> "")
	{
		$statementPublicacoesSelect->bindParam(':tipo_publicacao', $tipoPublicacao, PDO::PARAM_STR);
	}
	$statementPublicacoesSelect->execute();
	
	/*
	$statementPublicacoesSelect->execute(array(
		"id_tb_categorias" => $idParentPublicacoes,
		"tipo_publicacao" => $tipoPublicacao
	));
	*/
}

//$resultadoPublicacoes = $dbSistemaConPDO->query($strSqlPublicacoesSelect);
$resultadoPublicacoes = $statementPublicacoesSelect->fetchAll();

//Paginação.
if($GLOBALS['habilitarPublicacoesPaginacaoSimples'] == "1"){
	$paginacaoTotalRegistros = $resultadoPublicacoes[0]['totalRegistros'];
	$paginacaoTotal = ceil($paginacaoTotalRegistros / $paginacaoNRegistros);
}


//Definição de variáveis.
$tituloLinkAtual = Funcoes::RemoverHTML01($tituloCategoriaAtual);


//Montagem das meta tags.
//----------
$metaTitulo = $tituloLinkAtual . " - " . htmlentities($GLOBALS['configTituloSite']);
$metaTitulo = Funcoes::LimitadorCatecteres(Funcoes::RemoverHTML01($metaTitulo), 60);

$metaDescricao = "";
$metaPalavrasChave = Funcoes::LimitadorCatecteres(htmlentities($GLOBALS['configTituloSite']) . ", " . $tituloCategoriaAtual , 100);
//----------


//Verificação de erro - debug.
//echo "cookie=" . $_COOKIE[$GLOBALS['configNomeCookie'] . "_" . $GLOBALS['configSessionNomeUsuarioMaster']] . "<br>";
//echo "cookie(decrypt)=" . $tbUsuariosSenha = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura($_COOKIE[$GLOBALS['configNomeCookie'] . "_" . $GLOBALS['configSessionNomeUsuarioMaster']], 2), 2) . "<br>";
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo $tituloLinkAtual; ?>
<?php 
$pageSite->cphTitle = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Head.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphHead*/ ?>
    <meta name="description" content="<?php echo $metaDescricao; ?>" /><?php //Abaixo de 160 caracteres.?>
    <meta name="keywords" content="<?php echo $metaPalavrasChave; ?>" /><?php //Abaixo de 100 caracteres.?>
    <meta name="title" content="<?php echo $metaTitulo; ?>" /><?php //Abaixo de 60 caracteres.?>
<?php 
$pageSite->cphHead = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Título atual.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphConteudoCabecalho*/ ?>
	<?php echo $tituloLinkAtual; ?>
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


    <?php
	if (empty($resultadoPublicacoes))
	{
        //echo "Nenhum registro encontrado";
    ?>
        <div align="center" class="AdmErro">
            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteMensagemPublicacoesVazio"); ?>
        </div>
    <?php
    }else{
    ?>
		<div style="position: relative; display: block; clear: both;">
			<?php
			//Loop pelos resultados.
			foreach($resultadoPublicacoes as $linhaPublicacoes)
			{
			?>
				<?php //Diagramação 1. ?>
				<?php //************************************************************************************** ?>
				<div style="position: relative; display: block; clear: both;">
					<?php //Título. ?>
					<div align="left" style="margin: 0px 0px 5px 0px;">
						<a href="SitePublicacoesDetalhes.php?idTbPublicacoes=<?php echo $linhaPublicacoes['id'];?>" class="PublicacoesTituloLink">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaPublicacoes['titulo']);?>
						</a>
					</div>
					
					<?php //Imagem. ?>
					<?php if($linhaPublicacoes['imagem'] <> ""){ ?>
					<div class="PublicacoesImagemIndice">
						<a href="SitePublicacoesDetalhes.php?idTbPublicacoes=<?php echo $linhaPublicacoes['id'];?>">
							<img src="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>r<?php echo $linhaPublicacoes['imagem'];?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaPublicacoes['titulo']); ?>" />
						</a>
					</div>
						
					<?php }else{ ?>
						<?php //Placeholder. ?>
						<?php if($GLOBALS['configPublicacoesImagemPlaceholder'] == "1"){ ?>
						<?php } ?>
					<?php } ?>
					
					
					<div align="justify" class="PublicacoesTextoCorrido">
						<?php echo Funcoes::LimitadorCatecteres(Funcoes::RemoverHTML01(DbFuncoes::ConteudoTexto($linhaPublicacoes['id'])), $GLOBALS['configPublicacoesConteudoLimiteCaracteres']); ?>
						<?php if(Funcoes::ConteudoVerificarTamanho01(Funcoes::RemoverHTML01(DbFuncoes::ConteudoTexto($linhaPublicacoes['id'])), $GLOBALS['configPublicacoesConteudoLimiteCaracteres']) == true){ ?>
							...
						<?php } ?>
						<a href="SitePublicacoesDetalhes.php?idTbPublicacoes=<?php echo $linhaPublicacoes['id'];?>" class="PublicacoesTituloLink">
							[Ver +]
						</a>
					</div>
					
					<div class="PublicacoesData">
						<?php echo Funcoes::DataLeitura01($linhaPublicacoes['data_publicacao'], $GLOBALS['configSistemaFormatoData'], "1"); ?>
					</div>
					
					<?php //Fonte. ?>
					<?php if($GLOBALS['ativacaoPublicacoesFonte'] == "1"){ ?>
						<?php if($linhaProdutos['fonte'] <> ""){ ?>
						<div class="PublicacoesFonte">
							<?php if($GLOBALS['ativacaoPublicacoesFonteLink'] == "0"){ ?>
								<?php echo Funcoes::ConteudoMascaraLeitura($linhaPublicacoes['fonte']);?>
							<?php } ?>
							
							<?php if($GLOBALS['ativacaoPublicacoesFonteLink'] == "1"){ ?>
								<a href="<?php echo Funcoes::ConteudoMascaraLeitura($linhaPublicacoes['link_fonte']);?>" class="PublicacoesFonteLink">
									<?php echo Funcoes::ConteudoMascaraLeitura($linhaPublicacoes['fonte']);?>
								</a>
							<?php } ?>
						</div>
						<?php } ?>
					<?php } ?>
					
					<?php //Editoria. ?>
					<?php if($GLOBALS['ativacaoPublicacoesEditoria'] == "1"){ ?>
						<?php if($linhaProdutos['editoria'] <> ""){ ?>
						<div class="PublicacoesEditoria">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaPublicacoes['editoria']);?>
						</div>
						<?php } ?>
					<?php } ?>
					
					<div align="right">
						<a href="SitePublicacoesDetalhes.php?idTbPublicacoes=<?php echo $linhaPublicacoes['id'];?>">
							<img src="img/btoDetalhesPublicacoes.png" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaPublicacoes['titulo']); ?>" />
						</a>
					</div>

					<div class="PublicaceosSeparador1">
				
					</div>
				</div>
				<?php //************************************************************************************** ?>
			<?php } ?>
		</div>
	<?php } ?>
    
	<?php //Paginação. ?>
    <?php //************************************************************************************** ?>
    <?php if($GLOBALS['habilitarPublicacoesPaginacaoSimples'] == "1"){ ?>
		<?php if($paginacaoTotal > 1){ //Verifica se existe mais de uma página.?>
            <div align="center" class="PublicacoesTextoCorrido">
                <div style="position: relative; display: inline; margin: 2px;">
                    <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=1<?php echo $queryPadrao; ?>" class="PublicacoesPaginacaoLink">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPaginacaoPrimeira"); ?>
                    </a>
                </div>
                
                <?php if($paginacaoNumero > 1){ ?>
                    <div style="position: relative; display: inline; margin: 2px;">
                        <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=<?php echo $paginacaoNumero - 1 ?><?php echo $queryPadrao; ?>" class="PublicacoesPaginacaoLink">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPaginacaoAnterior"); ?>
                        </a>
                    </div>
                <?php } ?>
                
                <?php //Numeração de páginas. ?>
                <?php if($GLOBALS['habilitarPublicacoesSistemaPaginacaoNumeracao'] == "1"){ ?>
                    <?php for($countPublicacoes = 1; $countPublicacoes <= $paginacaoTotal; $countPublicacoes++){ ?>
                        <div style="position: relative; display: inline; margin: 2px;">
                            <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=<?php echo $countPublicacoes; ?><?php echo $queryPadrao; ?>" class="PublicacoesPaginacaoLink">
                                <?php echo $countPublicacoes; ?>
                            </a>
                        </div>
                    <?php } ?>
                <?php } ?>
                
                <?php if($paginacaoNumero <> $paginacaoTotal){ ?>
                    <div style="position: relative; display: inline; margin: 2px;">
                        <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=<?php echo $paginacaoNumero + 1 ?><?php echo $queryPadrao; ?>" class="PublicacoesPaginacaoLink">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPaginacaoProxima"); ?>
                        </a>
                    </div>
                <?php } ?>
                
                <div style="position: relative; display: inline; margin: 2px;">
                    <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=<?php echo $paginacaoTotal; ?><?php echo $queryPadrao; ?>" class="PublicacoesPaginacaoLink">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPaginacaoUltima"); ?>
                    </a>
                </div>
            </div>
            
            <?php //Contagem de páginas. ?>
            <div align="center" class="PublicacoesTextoCorrido">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePaginacaoPaginaContador01"); ?> 
                <?php echo $paginacaoNumero; ?> / <?php echo $paginacaoTotal; ?>
            </div>
        <?php } ?>
	<?php } ?>
	<?php //************************************************************************************** ?>

<?php 
$pageSite->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php
//Limpeza de objetos.
//----------
unset($strSqlPublicacoesSelect);
unset($statementPublicacoesSelect);
unset($resultadoPublicacoes);
unset($linhaPublicacoes);
//----------


//Inclusão do template do layout.
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>