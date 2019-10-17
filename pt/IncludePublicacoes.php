<?php
//Definição de variáveis.
$IdParentPublicacoes = $includePublicacoes_idParentPublicacoes; //""(vazio) - seleciona todos registros de publicação | 3489 (id_tb_categorias) - somente daquela categoria
$IdTbCadastroUsuario = $includePublicacoes_idTbCadastroUsuario;
$TipoPublicacao = $includePublicacoes_tipoPublicacao;

$ConfigTipoDiagramacao = $includePublicacoes_configTipoDiagramacao; //1 - imagem, título e resumo de texto | 2 - tabela completa | 3 - somente títulos | 11 - galeria de imagens
$ConfigPublicacoesNRegistros = $includePublicacoes_configPublicacoesNRegistros; //""(vazio) - sem limite | 3 (número) - número máximo de registros
$ConfigClassificacaoPublicacoes = $includePublicacoes_configClassificacaoPublicacoes;
if($ConfigClassificacaoPublicacoes == ""){
	$ConfigClassificacaoPublicacoes = $GLOBALS['configClassificacaoPublicacoes'];
}

$AtivacaoHome = $includePublicacoes_ativacaoHome;
$AtivacaoHomeCategoria = $includePublicacoes_ativacaoHomeCategoria;

$paginacaoNumero = "";
$paginacaoTotal = 0;


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
$strSqlPublicacoesSelect .= "FROM tb_publicacoes ";
$strSqlPublicacoesSelect .= "WHERE id <> 0 ";
if($IdParentPublicacoes <> "")
{
	$strSqlPublicacoesSelect .= "AND id_tb_categorias = :id_tb_categorias ";
}
if($TipoPublicacao <> "")
{
	$strSqlPublicacoesSelect .= "AND tipo_publicacao = :tipo_publicacao ";
}
if($AtivacaoHome <> "")
{
	$strSqlPublicacoesSelect .= "AND ativacao_home = :ativacao_home ";
}
if($AtivacaoHomeCategoria <> "")
{
	$strSqlPublicacoesSelect .= "AND ativacao_home_categoria = :ativacao_home_categoria ";
}
$strSqlPublicacoesSelect .= "AND ativacao = 1 ";
//$strSqlPublicacoesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoPublicacoes'] . " ";
$strSqlPublicacoesSelect .= "ORDER BY " . $ConfigClassificacaoPublicacoes . " ";
if($ConfigPublicacoesNRegistros <> ""){ 
	$strSqlPublicacoesSelect .= "LIMIT " . Funcoes::ConteudoMascaraGravacao01($ConfigPublicacoesNRegistros) . " ";
}
//----------


//Criação dos componentes.
//----------
$statementPublicacoesSelect = $dbSistemaConPDO->prepare($strSqlPublicacoesSelect);

if ($statementPublicacoesSelect !== false)
{
	if($IdParentPublicacoes <> "")
	{
		$statementPublicacoesSelect->bindParam(':id_tb_categorias', $IdParentPublicacoes, PDO::PARAM_STR);
	}
	if($TipoPublicacao <> "")
	{
		$statementPublicacoesSelect->bindParam(':tipo_publicacao', $TipoPublicacao, PDO::PARAM_STR);
	}
	if($AtivacaoHome <> "")
	{
		$statementPublicacoesSelect->bindParam(':ativacao_home', $AtivacaoHome, PDO::PARAM_STR);
	}
	if($AtivacaoHomeCategoria <> "")
	{
		$statementPublicacoesSelect->bindParam(':ativacao_home_categoria', $AtivacaoHomeCategoria, PDO::PARAM_STR);
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
//----------
?>


<?php if(!empty($resultadoPublicacoes)){?>

	<?php //Diagramação 2 (resumo).?>
    <?php //**************************************************************************************?>
    <?php if($ConfigTipoDiagramacao == "1"){ ?>
    	<div style="position: relative; display: block;">
			<?php
			//Loop pelos resultados.
			foreach($resultadoPublicacoes as $linhaPublicacoes)
			{
			?>
				<?php //Registro.?>
				<?php //----------?>
				<div style="position: relative; display: block; height: 110px; border-bottom: 1px dashed #bcbdbd; padding-bottom: 20px; margin-bottom: 20px; clear: both;">
					<div style="position: absolute; display: block; width: 130px;">
						<?php //Imagem. ?>
						<?php if($linhaPublicacoes['imagem'] <> ""){ ?>
						<div class="PublicacoesImagemIndice">
							<a href="SitePublicacoesDetalhes.php?idTbPublicacoes=<?php echo $linhaPublicacoes['id'];?>">
								<img src="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>t<?php echo $linhaPublicacoes['imagem'];?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaPublicacoes['titulo']); ?>" />
							</a>
						</div>
						<?php } ?>
					</div>
					
					<div style="position: absolute; display: block; margin-left: 130px;">
						<div>
							<a href="SitePublicacoesDetalhes.php?idTbPublicacoes=<?php echo $linhaPublicacoes['id'];?>" class="PublicacoesTituloLink">
								<?php echo Funcoes::ConteudoMascaraLeitura($linhaPublicacoes['titulo']);?>
							</a>
						</div>
						
						<?php if(DbFuncoes::ConteudoTexto($linhaPublicacoes['id']) <> ""){?>
							<div class="PublicacoesTextoCorrido" style="padding-top: 8px;">
								<?php echo Funcoes::LimitadorCatecteres(Funcoes::RemoverHTML01(DbFuncoes::ConteudoTexto($linhaPublicacoes['id'])), $GLOBALS['configPublicacoesConteudoLimiteCaracteres']); ?>
								<?php if(Funcoes::ConteudoVerificarTamanho01(Funcoes::RemoverHTML01(DbFuncoes::ConteudoTexto($linhaPublicacoes['id'])), $GLOBALS['configPublicacoesConteudoLimiteCaracteres']) == true){ ?>
									...
								<?php } ?>
								<a href="SitePublicacoesDetalhes.php?idTbPublicacoes=<?php echo $linhaPublicacoes['id'];?>" class="PublicacoesTituloLink">
									[Ver +]
								</a>
							</div>
						<?php } ?>
					</div>
				</div>
				<?php //----------?>
			<?php } ?>
        </div>
    <?php } ?>
    <?php //**************************************************************************************?>


	<?php //Diagramação 2 (tabela).?>
    <?php //**************************************************************************************?>
    <?php if($ConfigTipoDiagramacao == "2"){ ?>
    	<div style="position: relative; display: block;">
			<?php
			//Loop pelos resultados.
			foreach($resultadoPublicacoes as $linhaPublicacoes)
			{
			?>
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
			<?php } ?>
        </div>
    <?php } ?>
    <?php //**************************************************************************************?>
<?php } ?>


<?php
//Limpeza de objetos.
//----------
unset($strSqlPublicacoesSelect);
unset($statementPublicacoesSelect);
unset($resultadoPublicacoes);
unset($linhaPublicacoes);
//----------
?>
