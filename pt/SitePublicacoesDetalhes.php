<?php
//Importação dos arquivos de configuração.
require_once "../sistema/IncludeConfig.php"; //Deve vir antes do db.
require_once "../sistema/IncludeConexao.php";
require_once "../sistema/IncludeFuncoes.php";
//require_once "IncludeLayout.php";
require_once "IncludeLayoutSite.php";


//Resgate de variáveis
$idTbPublicacoes = $_GET["idTbPublicacoes"];
$idParentPublicacoes = DbFuncoes::GetCampoGenerico01($idTbPublicacoes, "tb_publicacoes", "id_tb_categorias");

$tituloLinkAtual = "";
$tituloCategoriaAtual = DbFuncoes::GetCampoGenerico01($idParentPublicacoes, "tb_categorias", "categoria");

$paginaRetorno = "SitePublicacoesNoticiasIndice.php";
$paginaRetornoExclusao = "SitePublicacoesDetalhes.php";
$variavelRetorno = "idTbPublicacoes";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];


//Montagem de query padrão de retorno.
$queryPadrao = "&idParentPublicacoes=" . $idParentPublicacoes . 
"&idTbCadastroUsuario=" . $idTbCadastroUsuario . 
"&paginaRetorno=" . $paginaRetorno . 
"&masterPageSelect=" . $masterPageSelect . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&variavelRetorno=" . $variavelRetorno;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Query de pesquisa.
//----------
$strSqlPublicacoesDetalhesSelect = "";
$strSqlPublicacoesDetalhesSelect .= "SELECT ";
//$strSqlPublicacoesDetalhesSelect .= "* ";
$strSqlPublicacoesDetalhesSelect .= "id, ";
$strSqlPublicacoesDetalhesSelect .= "tipo_publicacao, ";
$strSqlPublicacoesDetalhesSelect .= "id_tb_categorias, ";
$strSqlPublicacoesDetalhesSelect .= "id_tb_cadastro_usuario, ";
$strSqlPublicacoesDetalhesSelect .= "data_publicacao, ";
$strSqlPublicacoesDetalhesSelect .= "data_final_publicacao, ";
$strSqlPublicacoesDetalhesSelect .= "n_classificacao, ";
$strSqlPublicacoesDetalhesSelect .= "titulo, ";
$strSqlPublicacoesDetalhesSelect .= "conteudo_simples, ";
$strSqlPublicacoesDetalhesSelect .= "informacao_complementar1, ";
$strSqlPublicacoesDetalhesSelect .= "informacao_complementar2, ";
$strSqlPublicacoesDetalhesSelect .= "informacao_complementar3, ";
$strSqlPublicacoesDetalhesSelect .= "informacao_complementar4, ";
$strSqlPublicacoesDetalhesSelect .= "informacao_complementar5, ";
$strSqlPublicacoesDetalhesSelect .= "fonte, ";
$strSqlPublicacoesDetalhesSelect .= "link_fonte, ";
$strSqlPublicacoesDetalhesSelect .= "editoria, ";
$strSqlPublicacoesDetalhesSelect .= "palavras_chave, ";
$strSqlPublicacoesDetalhesSelect .= "ativacao, ";
$strSqlPublicacoesDetalhesSelect .= "ativacao_home, ";
$strSqlPublicacoesDetalhesSelect .= "ativacao_home_categoria, ";
$strSqlPublicacoesDetalhesSelect .= "acesso_restrito, ";
$strSqlPublicacoesDetalhesSelect .= "imagem ";
$strSqlPublicacoesDetalhesSelect .= "FROM tb_publicacoes ";
$strSqlPublicacoesDetalhesSelect .= "WHERE id <> 0 ";
//$strSqlPublicacoesDetalhesSelect .= "AND id_tb_categorias = :id_tb_categorias ";
$strSqlPublicacoesDetalhesSelect .= "AND id = :id ";
//$strSqlPublicacoesDetalhesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";


$statementPublicacoesDetalhesSelect = $dbSistemaConPDO->prepare($strSqlPublicacoesDetalhesSelect);

if ($statementPublicacoesDetalhesSelect !== false)
{
	$statementPublicacoesDetalhesSelect->execute(array(
		"id" => $idTbPublicacoes
	));
}

//$resultadoPublicacoesDetalhes = $dbSistemaConPDO->query($strSqlPublicacoesDetalhesSelect);
$resultadoPublicacoesDetalhes = $statementPublicacoesDetalhesSelect->fetchAll();

if (empty($resultadoPublicacoesDetalhes))
{
	//echo "Nenhum registro encontrado";
}else{
	foreach($resultadoPublicacoesDetalhes as $linhaPublicacoesDetalhes)
	{
		//Definição das variáveis de detalhes.
		$tbPublicacoesId = $linhaPublicacoesDetalhes['id'];
		$tbPublicacoesTipoPublicacao = $linhaPublicacoesDetalhes['tipo_publicacao'];
		$tbPublicacoesIdTbCategorias = $linhaPublicacoesDetalhes['id_tb_categorias'];
		$tbPublicacoesIdTbCadastroUsuario = $linhaPublicacoesDetalhes['id_tb_cadastro_usuario'];
		$tbPublicacoesDataPublicacao = Funcoes::DataLeitura01($linhaPublicacoesDetalhes['data_publicacao'], $GLOBALS['configSistemaFormatoData'], "1");
		$tbPublicacoesDataFinalPublicacao = Funcoes::DataLeitura01($linhaPublicacoesDetalhes['data_final_publicacao'], $GLOBALS['configSistemaFormatoData'], "1");
		$tbPublicacoesNClassificacao = $linhaPublicacoesDetalhes['n_classificacao'];

		$tbPublicacoesTitulo = Funcoes::ConteudoMascaraLeitura($linhaPublicacoesDetalhes['titulo']);
		$tbPublicacoesConteudoSimples = Funcoes::ConteudoMascaraLeitura($linhaPublicacoesDetalhes['conteudo_simples']);

		$tbPublicacoesIC1 = Funcoes::ConteudoMascaraLeitura($linhaPublicacoesDetalhes['informacao_complementar1']);
		$tbPublicacoesIC2 = Funcoes::ConteudoMascaraLeitura($linhaPublicacoesDetalhes['informacao_complementar2']);
		$tbPublicacoesIC3 = Funcoes::ConteudoMascaraLeitura($linhaPublicacoesDetalhes['informacao_complementar3']);
		$tbPublicacoesIC4 = Funcoes::ConteudoMascaraLeitura($linhaPublicacoesDetalhes['informacao_complementar4']);
		$tbPublicacoesIC5 = Funcoes::ConteudoMascaraLeitura($linhaPublicacoesDetalhes['informacao_complementar5']);
		
		$tbPublicacoesFonte = Funcoes::ConteudoMascaraLeitura($linhaPublicacoesDetalhes['fonte']);
		$tbPublicacoesLinkFonte = Funcoes::ConteudoMascaraLeitura($linhaPublicacoesDetalhes['link_fonte']);
		$tbPublicacoesEditoria = Funcoes::ConteudoMascaraLeitura($linhaPublicacoesDetalhes['editoria']);
		$tbPublicacoesPalavrasChave = Funcoes::ConteudoMascaraLeitura($linhaPublicacoesDetalhes['palavras_chave']);
		
		$tbPublicacoesAtivacao = $linhaPublicacoesDetalhes['ativacao'];
		$tbPublicacoesAtivacaoHome = $linhaPublicacoesDetalhes['ativacao_home'];
		$tbPublicacoesAtivacaoHomeCategoria = $linhaPublicacoesDetalhes['ativacao_home_categoria'];
		$tbPublicacoesAcessoRestrito = $linhaPublicacoesDetalhes['acesso_restrito'];
		
		$tbPublicacoesImagem = $linhaPublicacoesDetalhes['imagem'];
		//Verificação de erro.
		//echo "tbPublicacoesId=" . $tbPublicacoesId . "<br>";
		//echo "tbPublicacoesProcesso=" . $tbPublicacoesProcesso . "<br>";
		
	}
}


//Definição de variáveis.
$tituloLinkAtual = Funcoes::RemoverHTML01($tbPublicacoesTitulo);


//Montagem das meta tags.
//----------
$metaTitulo = $tituloLinkAtual . " - " . htmlentities($GLOBALS['configTituloSite']);
$metaTitulo = Funcoes::LimitadorCatecteres(Funcoes::RemoverHTML01($metaTitulo), 60);

$metaDescricao = Funcoes::LimitadorCatecteres(Funcoes::RemoverHTML01(DbFuncoes::ConteudoTexto($tbPublicacoesId)), 160);
$metaPalavrasChave = Funcoes::RemoverHTML01($tbPublicacoesPalavrasChave);
//----------
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo $metaTitulo; ?>
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
	<?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteTarefasTitulo"); ?>
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
    <div align="center" class="AdmAlerta">
        <?php echo $mensagemAlerta;?>
    </div>


	<?php //Diagramação 1.?>
    <?php //**************************************************************************************?>
    <div align="center" style="position: relative; display: block;">
		<?php if($tbPublicacoesDataPublicacao <> ""){ ?>
			<div class="PublicacoesDetalhesData">
				<?php echo $tbPublicacoesDataPublicacao; ?>
			</div>
		<?php } ?>
	
		<?php if($GLOBALS['tbPublicacoesDataPublicacao'] == "1"){ ?>
			<?php if($tbPublicacoesDataFinalPublicacao <> ""){ ?>
				<div class="PublicacoesDetalhesData">
					<?php echo $tbPublicacoesDataFinalPublicacao; ?>
				</div>
			<?php } ?>
		<?php } ?>

		<?php if($GLOBALS['ativacaoPublicacoesFonte'] == "1"){ ?>
			<?php if($tbPublicacoesFonte <> ""){ ?>
				<div class="PublicacoesDetalhesFonte">
					<?php if($GLOBALS['ativacaoPublicacoesFonteLink'] == "0"){ ?>
						<?php echo $tbPublicacoesFonte;?>
					<?php } ?>
					
					<?php if($GLOBALS['ativacaoPublicacoesFonteLink'] == "1"){ ?>
						<a href="<?php echo $tbPublicacoesLinkFonte;?>" class="PublicacoesFonteLink">
							<?php echo $tbPublicacoesFonte;?>
						</a>
					<?php } ?>
				</div>
			<?php } ?>
		<?php } ?>

		<?php if($GLOBALS['ativacaoPublicacoesEditoria'] == "1"){ ?>
			<?php if($tbPublicacoesEditoria <> ""){ ?>
				<div class="PublicacoesDetalhesEditoria">
					<?php echo $tbPublicacoesEditoria; ?>
				</div>
			<?php } ?>
		<?php } ?>

		<?php //Imagem principal. ?>
		<?php if($GLOBALS['ativacaoPublicacoesImagens'] == "1"){ ?>
			<?php if($tbPublicacoesImagem <> ""){ ?>
				<div align="center">
					<?php //SlimBox 2 - JQuery.?>
					<?php if($GLOBALS['configImagemPopUp'] == "1"){ ?>
						<div class="PublicacoesImagemDetalhes"><a href="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>g<?php echo $tbPublicacoesImagem;?>" rel="lightbox" title="<?php echo $tituloLinkAtual; ?>"><img src="<?php echo $GLOBALS['configCaminhoSiteImagens'];?><?php echo $tbPublicacoesImagem;?>" alt="<?php echo $tituloLinkAtual; ?>" /></a></div>
					<?php } ?>
				</div>
			<?php } ?>
		<?php } ?>
		
		<table border="0" cellspacing="4" cellpadding="0">
			<?php if($GLOBALS['habilitarPublicacoesIc1'] == "1"){ ?>
				<?php if($tbPublicacoesIC1 <> ""){ ?>
					  <tr valign="top">
						<td>
							<div class="PublicacoesDetalhesTextoCorrido">
								<strong>
									<?php echo htmlentities($GLOBALS['configPublicacoesTituloIc1']);?>:
								</strong>
							</div>
						</td>
						<td>
							<div align="justify" class="PublicacoesDetalhesTextoCorrido">
								<?php echo $tbPublicacoesIC1; ?>
							</div>
						</td>
					  </tr>
				<?php } ?>
			<?php } ?>
			
			<?php if($GLOBALS['habilitarPublicacoesIc2'] == "1"){ ?>
				<?php if($tbPublicacoesIC2 <> ""){ ?>
					  <tr valign="top">
						<td>
							<div class="PublicacoesDetalhesTextoCorrido">
								<strong>
									<?php echo htmlentities($GLOBALS['configPublicacoesTituloIc2']);?>:
								</strong>
							</div>
						</td>
						<td>
							<div align="justify" class="PublicacoesDetalhesTextoCorrido">
								<?php echo $tbPublicacoesIC2; ?>
							</div>
						</td>
					  </tr>
				<?php } ?>
			<?php } ?>
	
			<?php if($GLOBALS['habilitarPublicacoesIc3'] == "1"){ ?>
				<?php if($tbPublicacoesIC3 <> ""){ ?>
					  <tr valign="top">
						<td>
							<div class="PublicacoesDetalhesTextoCorrido">
								<strong>
									<?php echo htmlentities($GLOBALS['configPublicacoesTituloIc3']);?>:
								</strong>
							</div>
						</td>
						<td>
							<div align="justify" class="PublicacoesDetalhesTextoCorrido">
								<?php echo $tbPublicacoesIC3; ?>
							</div>
						</td>
					  </tr>
				<?php } ?>
			<?php } ?>
	
			<?php if($GLOBALS['habilitarPublicacoesIc4'] == "1"){ ?>
				<?php if($tbPublicacoesIC4 <> ""){ ?>
					  <tr valign="top">
						<td>
							<div class="PublicacoesDetalhesTextoCorrido">
								<strong>
									<?php echo htmlentities($GLOBALS['configPublicacoesTituloIc4']);?>:
								</strong>
							</div>
						</td>
						<td>
							<div align="justify" class="PublicacoesDetalhesTextoCorrido">
								<?php echo $tbPublicacoesIC4; ?>
							</div>
						</td>
					  </tr>
				<?php } ?>
			<?php } ?>
	
			<?php if($GLOBALS['habilitarPublicacoesIc5'] == "1"){ ?>
				<?php if($tbPublicacoesIC5 <> ""){ ?>
					  <tr valign="top">
						<td>
							<div class="PublicacoesDetalhesTextoCorrido">
								<strong>
									<?php echo htmlentities($GLOBALS['configPublicacoesTituloIc5']);?>:
								</strong>
							</div>
						</td>
						<td>
							<div align="justify" class="PublicacoesDetalhesTextoCorrido">
								<?php echo $tbPublicacoesIC5; ?>
							</div>
						</td>
					  </tr>
				<?php } ?>
			<?php } ?>
		</table>
    </div>
    <?php //**************************************************************************************?>
	
	
	<?php //Conteúdo.?>
    <?php //----------------------?>
    <?php 
	//Definição de variáveis do include.
	$includeConteudo_idParentConteudo = $tbPublicacoesId;
	$includeConteudo_idTbConteudo = "";
	$includeConteudo_tipoConteudo = "";
	
	$includeConteudo_configTipoDiagramacao = "1";
	$includeConteudo_configConteudoNRegistros = "";
	$includeConteudo_configClassificacaoConteudo = $GLOBALS['configClassificacaoConteudo'];
	?>
    
    <?php include "IncludeConteudo.php";?>
    <?php //----------------------?>


	<?php //Imagens complementares.?>
    <?php //----------------------?>
    <?php 
	//Definição de variáveis do include.
	$includeArquivosImagens_idTbArquivos = $tbPublicacoesId;
	$includeArquivosImagens_tipoVisualizacao = "1";
	
	$includeArquivosImagens_limiteRegistros = "";
	$includeArquivosImagens_nImagensVisivelScroll = "3";
	$includeArquivosImagens_configImagemZoom = "1";
	?>
    
    <?php include "IncludeArquivosImagens.php";?>
    <?php //----------------------?>
    
    
	<?php //Arquivos complementares.?>
    <?php //----------------------?>
    <?php 
	//Definição de variáveis do include.
	$includeArquivos_idTbArquivos = $tbPublicacoesId;
	$includeArquivos_tipoVisualizacao = "1";
	$includeArquivos_configArquivosNColunas = "1";
	
	$includeArquivos_limiteRegistros = "";
	$includeArquivos_nImagensVisivelScroll = "1";
	?>
    
    <?php include "IncludeArquivos.php";?>
    <?php //----------------------?>
	
	
    <div align="center">
		<a href="javascript:history.go(-1);">
			<img src="img/btoVoltar.png" border="0" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoVoltar"); ?>" />
		</a>
    </div>
<?php 
$pageSite->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php
//Limpeza de objetos.
//----------
unset($strSqlPublicacoesDetalhesSelect);
unset($statementPublicacoesDetalhesSelect);
unset($resultadoPublicacoesDetalhes);
unset($linhaPublicacoesDetalhes);
//----------


//Inclusão do template do layout.
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>