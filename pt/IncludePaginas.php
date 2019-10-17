<?php
//Definição de variáveis.
$IdParentPaginas = $includePaginas_idParentPaginas; //""(vazio) - seleciona todos registros de produtos | 3489 (id_tb_categorias) - somente daquela categoria
$IdsTbPaginas = $includePaginas_idsTbPaginas;

$IdTbCadastro1 = $includePaginas_idTbCadastro1;
$IdsTbCadastro1 = $includePaginas_idsTbCadastro1;

$IdTbCadastro2 = $includePaginas_idTbCadastro2;
$IdsTbCadastro2 = $includePaginas_idsTbCadastro2;

$ConfigTipoDiagramacao = $includePaginas_configTipoDiagramacao; //1 - imagem, título e resumo de texto | 2 - tabela | 3 - somente títulos
$ConfigPaginasNRegistros = $includePaginas_configPaginasNRegistros;
$ConfigClassificacaoPaginas = $includePaginas_configClassificacaoPaginas;
if($ConfigClassificacaoPaginas == ""){
	$ConfigClassificacaoPaginas = $GLOBALS['configClassificacaoPaginas'];
}


//Query de pesquisa.
//----------
$strSqlPaginasSelect = "";
$strSqlPaginasSelect .= "SELECT ";
//$strSqlPaginasSelect .= "* ";
$strSqlPaginasSelect .= "id, ";
$strSqlPaginasSelect .= "id_parent, ";
$strSqlPaginasSelect .= "id_tb_cadastro1, ";
$strSqlPaginasSelect .= "id_tb_cadastro2, ";
$strSqlPaginasSelect .= "id_tb_cadastro3, ";
$strSqlPaginasSelect .= "n_classificacao, ";
$strSqlPaginasSelect .= "data_criacao, ";
$strSqlPaginasSelect .= "titulo, ";
$strSqlPaginasSelect .= "descricao, ";
$strSqlPaginasSelect .= "palavras_chave, ";
$strSqlPaginasSelect .= "url1, ";
$strSqlPaginasSelect .= "url2, ";
$strSqlPaginasSelect .= "url3, ";
$strSqlPaginasSelect .= "url4, ";
$strSqlPaginasSelect .= "url5, ";
$strSqlPaginasSelect .= "imagem, ";
$strSqlPaginasSelect .= "arquivo1, ";
$strSqlPaginasSelect .= "arquivo2, ";
$strSqlPaginasSelect .= "arquivo3, ";
$strSqlPaginasSelect .= "arquivo4, ";
$strSqlPaginasSelect .= "arquivo5, ";

$strSqlPaginasSelect .= "informacao_complementar1, ";
$strSqlPaginasSelect .= "informacao_complementar2, ";
$strSqlPaginasSelect .= "informacao_complementar3, ";
$strSqlPaginasSelect .= "informacao_complementar4, ";
$strSqlPaginasSelect .= "informacao_complementar5, ";
$strSqlPaginasSelect .= "informacao_complementar6, ";
$strSqlPaginasSelect .= "informacao_complementar7, ";
$strSqlPaginasSelect .= "informacao_complementar8, ";
$strSqlPaginasSelect .= "informacao_complementar9, ";
$strSqlPaginasSelect .= "informacao_complementar10, ";
$strSqlPaginasSelect .= "informacao_complementar11, ";
$strSqlPaginasSelect .= "informacao_complementar12, ";
$strSqlPaginasSelect .= "informacao_complementar13, ";
$strSqlPaginasSelect .= "informacao_complementar14, ";
$strSqlPaginasSelect .= "informacao_complementar15, ";

$strSqlPaginasSelect .= "ativacao, ";
$strSqlPaginasSelect .= "ativacao1, ";
$strSqlPaginasSelect .= "ativacao2, ";
$strSqlPaginasSelect .= "ativacao3, ";
$strSqlPaginasSelect .= "ativacao4, ";

$strSqlPaginasSelect .= "n_visitas, ";
$strSqlPaginasSelect .= "acesso_restrito ";

$strSqlPaginasSelect .= "FROM tb_paginas ";
$strSqlPaginasSelect .= "WHERE id <> 0 ";
if($IdParentPaginas <> "")
{
	$strSqlPaginasSelect .= "AND id_parent = :id_parent ";
}
if($IdTbCadastro1 <> "")
{
	$strSqlPaginasSelect .= "AND id_tb_cadastro1 = :id_tb_cadastro1 ";
}
if($IdTbCadastro2 <> "")
{
	$strSqlPaginasSelect .= "AND id_tb_cadastro2 = :id_tb_cadastro2 ";
}
//$strSqlPaginasSelect .= "ORDER BY " . $GLOBALS['configClassificacaoPaginas'] . " ";
$strSqlPaginasSelect .= "ORDER BY " . $ConfigClassificacaoPaginas . " ";


$statementPaginasSelect = $dbSistemaConPDO->prepare($strSqlPaginasSelect);

if ($statementPaginasSelect !== false)
{
	
	if($IdParentPaginas <> "")
	{
		$statementPaginasSelect->bindParam(':id_parent', $IdParentPaginas, PDO::PARAM_STR);
	}
	if($IdTbCadastro1 <> "")
	{
		$statementPaginasSelect->bindParam(':id_tb_cadastro1', $IdTbCadastro1, PDO::PARAM_STR);
	}
	if($IdTbCadastro2 <> "")
	{
		$statementPaginasSelect->bindParam(':id_tb_cadastro2', $IdTbCadastro2, PDO::PARAM_STR);
	}
	$statementPaginasSelect->execute();

	/*
	$statementPaginasSelect->execute(array(
		"id_parent" => $IdParentPaginas,
		"id_tb_cadastro1" => $IdTbCadastro1
	));
	*/
}

//$resultadoPaginas = $dbSistemaConPDO->query($strSqlPaginasSelect);
$resultadoPaginas = $statementPaginasSelect->fetchAll();
?>


<?php if(!empty($resultadoPaginas)){?>
	<?php //Diagramação 1 (div).?>
    <?php //**************************************************************************************?>
    <?php if($ConfigTipoDiagramacao == "1"){ ?>
    	<div style="position: relative; display: block;">
              <?php
                //Loop pelos resultados.
                foreach($resultadoPaginas as $linhaPaginas)
                {
              ?>
              
                <div class="PaginasIndiceContainer">
                    <a href="SitePaginasDetalhes.php?idTbPaginas=<?php echo $linhaPaginas['id']; ?>" class="PaginasIndiceTitulo">
                        <?php echo Funcoes::ConteudoMascaraLeitura($linhaPaginas['titulo']);?>
                    </a>
                    
                    <div align="left">
                        <?php if(!empty($linhaPaginas['imagem'])){ ?>
                                <?php //Sem pop-up. ?>
                                <?php //if($GLOBALS['configImagemPopUp'] == 0){ ?>
                                    <a href="SitePaginasDetalhes.php?idTbPaginas=<?php echo $linhaPaginas['id']; ?>">
                                        <img src="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>r<?php echo $linhaPaginas['imagem'];?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaPaginas['titulo']); ?>" />
                                    </a>
                                <?php //} ?>
                        <?php } ?>
                    </div>
                    
                    <div class="PaginasIndiceConteudo">
                        <?php //if($GLOBALS['ConfigProdutosDescricao01LimiteCaracteres'] == 0){ ?>
                            <?php //echo Funcoes::ConteudoMascaraLeitura($linhaPaginas['descricao']);?>
                        <?php //}else{ ?>
                            <?php echo Funcoes::LimitadorCatecteres(Funcoes::RemoverHTML01(Funcoes::ConteudoMascaraLeitura($linhaPaginas['descricao'])), 90);?>
                            <?php if(strlen(Funcoes::RemoverHTML01(Funcoes::ConteudoMascaraLeitura($linhaPaginas['descricao']))) > 90){ ?>
                                ...
                            <?php } ?>
                        <?php //} ?>
                    </div>
                </div>
              
              <?php 
			  } 
			  ?>
        </div>
    <?php } ?>
    <?php //**************************************************************************************?>


	<?php //Diagramação 2 (tabela).?>
    <?php //**************************************************************************************?>
    <?php if($ConfigTipoDiagramacao == "2"){ ?>
        
    	<div style="position: relative; display: block;">
			<?php if(!empty($resultadoPaginas)){?>
            <div class="TabelaIncludeTitulo01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePaginasTitulo");?>
                <?php if($IdTbCadastro1 <> ""){?>
                	 (<?php echo htmlentities($GLOBALS['configPaginasVinculo1Nome']); ?>)
                <?php } ?>
                
                <?php if($IdTbCadastro2 <> ""){?>
                	 (<?php echo htmlentities($GLOBALS['configPaginasVinculo2Nome']); ?>)
                <?php } ?>
            </div>
            <?php } ?>
        
            <table width="100%" class="AdmTabelaDados01">
              <tr class="AdmTbFundoEscuro">
              	<?php if($GLOBALS['habilitarPaginasNClassificacao'] == 1){ ?>
                <td width="50" class="AdmTbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNClassificacaoA"); ?>
                    </div>
                </td>
                <?php } ?>
                
              	<?php if($GLOBALS['habilitarPaginasImagem'] == 1){ ?>
                <td width="1" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemImagem"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <td class="TabelaDados01Celula">
                    <div class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePagina"); ?>
                    </div>
                </td>
                
                <!--td width="300" class="TabelaDados01Celula">
                    <div class="AdmTexto02">
                        <?php echo htmlentities($GLOBALS['configPaginasVinculo1Nome']); ?>
                    </div>
                </td-->

                <td width="100" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFuncoes"); ?>
                    </div>
                </td>
                
                <?php if($GLOBALS['habilitarPaginasAcessoRestrito'] == 1){ ?>
                <!--td width="50" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAcesso"); ?>
                    </div>
                </td-->
                <?php } ?>
                
                <!--td width="30" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao"); ?>
                    </div>
                </td-->
                
                <!--td width="30" class="AdmTbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                    </div>
                </td-->
                
                <!--td width="30" class="AdmTbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemExcluir"); ?>
                    </div>
                </td-->
              </tr>
              <?php
				$countTabelaFundo = 0;
				
				//Seleção de cadastros.
				//if($GLOBALS['habilitarPaginasVinculo1'] == 1){
					//$arrPaginasVinculo1 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbPaginasVinculo1'], $GLOBALS['configIdTbTipoPaginasVinculo1'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoPaginasVinculo1'], $GLOBALS['configPaginasVinculo1Metodo']);
				//}
				//if($GLOBALS['habilitarPaginasVinculo2'] == 1){
					//$arrPaginasVinculo2 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbPaginasVinculo2'], $GLOBALS['configIdTbTipoPaginasVinculo2'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoPaginasVinculo2'], $GLOBALS['configPaginasVinculo2Metodo']);
				//}
				//if($GLOBALS['habilitarPaginasVinculo3'] == 1){
					//$arrPaginasVinculo3 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbPaginasVinculo3'], $GLOBALS['configIdTbTipoPaginasVinculo3'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoPaginasVinculo3'], $GLOBALS['configPaginasVinculo3Metodo']);
				//}

                //Loop pelos resultados.
                foreach($resultadoPaginas as $linhaPaginas)
                {
              ?>
              <tr class="<?php if($countTabelaFundo == 0){ ?>AdmTbFundoClaro<?php }else{?>AdmTbFundoAlternativo<?php } ?>">
              	<?php if($GLOBALS['habilitarPaginasNClassificacao'] == 1){ ?>
                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <?php echo $linhaPaginas['n_classificacao'];?>
                    </div>
                </td>
                <?php } ?>
                
              	<?php if($GLOBALS['habilitarPaginasImagem'] == 1){ ?>
                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
						<?php if(!empty($linhaPaginas['imagem'])){ ?>
							<?php //Sem pop-up. ?>
                            <?php if($GLOBALS['configImagemPopUp'] == 0){ ?>
                                <img src="../<?php echo $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos'];?>/t<?php echo $linhaPaginas['imagem'];?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaPaginas['titulo']); ?>" />
                            <?php } ?>
                        
                            <?php //SlimBox 2 - JQuery. ?>
                            <?php if($GLOBALS['configImagemPopUp'] == 1){ ?>
                                <a href="../<?php echo $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos'];?>/g<?php echo $linhaPaginas['imagem'];?>" rel="lightbox" title="">
                                    <img src="../<?php echo $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos'];?>/t<?php echo $linhaPaginas['imagem'];?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaPaginas['titulo']); ?>" />
                                </a>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
                <?php } ?>
                
                <td class="TabelaDados01Celula">
                    <div class="AdmTexto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaPaginas['titulo']);?>
                    </div>
                    <div class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($linhaPaginas['descricao']);?>
                    </div>
                    <div class="AdmTexto01">
                    	<?php if($GLOBALS['habilitarPaginasFotos'] == 1){ ?>
                            [
                            <a href="SiteAdmArquivosIndice.php?idParent=<?php echo $linhaPaginas['id'];?>&tipoArquivo=1&masterPageSiteSelect=LayoutSitePrincipal.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaPaginas['titulo']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirFotos"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarPaginasVideos'] == 1){ ?>
                            [
                            <a href="SiteAdmArquivosIndice.php?idParent=<?php echo $linhaPaginas['id'];?>&tipoArquivo=2&masterPageSiteSelect=LayoutSitePrincipal.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaPaginas['titulo']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirVideos"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarPaginasArquivos'] == 1){ ?>
                            [
                            <a href="SiteAdmArquivosIndice.php?idParent=<?php echo $linhaPaginas['id'];?>&tipoArquivo=3&masterPageSiteSelect=LayoutSitePrincipal.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaPaginas['titulo']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirArquivos"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarPaginasZip'] == 1){ ?>
                            [
                            <a href="SiteAdmArquivosIndice.php?idParent=<?php echo $linhaPaginas['id'];?>&tipoArquivo=4&masterPageSiteSelect=LayoutSitePrincipal.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaPaginas['titulo']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirZip"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarPaginasSwfs'] == 1){ ?>
                            [
                            <a href="SiteAdmArquivosIndice.php?idParent=<?php echo $linhaPaginas['id'];?>&tipoArquivo=5&masterPageSiteSelect=LayoutSitePrincipal.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaPaginas['titulo']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirSWFs"); ?>
                            </a>
                            ] 
                        <?php } ?>
                        
                    	<?php if($GLOBALS['habilitarPaginasProcessos'] == 1){ ?>
                            [
                            <a href="SiteAdmProcessosIndice.php?idParentProcessos=<?php echo $linhaPaginas['id'];?>&masterPageSiteSelect=LayoutSitePrincipal.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaPaginas['titulo']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirProcessos"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    </div>
                    <?php if($GLOBALS['habilitarPaginasVinculo1'] == 1){ ?>
						<?php if($linhaPaginas['id_tb_cadastro1'] <> 0){ ?>
                        <div class="AdmTexto01">
                            <strong>
                                <?php echo htmlentities($GLOBALS['configPaginasVinculo1Nome']); ?>: 
                            </strong>
                            <a href="SiteAdmCadastroAdministrar.php?idTbCadastro=<?php echo $linhaPaginas['id_tb_cadastro1'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
								<?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaPaginas['id_tb_cadastro1'], "tb_cadastro", "nome"), 
                                DbFuncoes::GetCampoGenerico01($linhaPaginas['id_tb_cadastro1'], "tb_cadastro", "razao_social"), 
                                DbFuncoes::GetCampoGenerico01($linhaPaginas['id_tb_cadastro1'], "tb_cadastro", "nome_fantasia"), 
                                1)); ?>
                            </a>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    <?php if($GLOBALS['habilitarPaginasVinculo2'] == 1){ ?>
						<?php if($linhaPaginas['id_tb_cadastro2'] <> 0){ ?>
                        <div class="AdmTexto01">
                            <strong>
                                <?php echo htmlentities($GLOBALS['configPaginasVinculo2Nome']); ?>: 
                            </strong>
                            <a href="SiteAdmCadastroAdministrar.php?idTbCadastro=<?php echo $linhaPaginas['id_tb_cadastro2'];?>&masterPageSiteSelect=LayoutSitePrincipal.php" target="_blank" class="AdmLinks01">
								<?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaPaginas['id_tb_cadastro2'], "tb_cadastro", "nome"), 
                                DbFuncoes::GetCampoGenerico01($linhaPaginas['id_tb_cadastro2'], "tb_cadastro", "razao_social"), 
                                DbFuncoes::GetCampoGenerico01($linhaPaginas['id_tb_cadastro2'], "tb_cadastro", "nome_fantasia"), 
                                1)); ?>
                            </a>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    <?php if($GLOBALS['habilitarPaginasVinculo3'] == 1){ ?>
						<?php if($linhaPaginas['id_tb_cadastro3'] <> 0){ ?>
                        <div class="AdmTexto01">
                            <strong>
                                <?php echo htmlentities($GLOBALS['configPaginasVinculo3Nome']); ?>: 
                            </strong>
                            <a href="SiteAdmCadastroAdministrar.php?idTbCadastro=<?php echo $linhaPaginas['id_tb_cadastro3'];?>&masterPageSiteSelect=LayoutSitePrincipal.php" target="_blank" class="AdmLinks01">
								<?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaPaginas['id_tb_cadastro3'], "tb_cadastro", "nome"), 
                                DbFuncoes::GetCampoGenerico01($linhaPaginas['id_tb_cadastro3'], "tb_cadastro", "razao_social"), 
                                DbFuncoes::GetCampoGenerico01($linhaPaginas['id_tb_cadastro3'], "tb_cadastro", "nome_fantasia"), 
                                1)); ?>
                            </a>
                        </div>
                        <?php } ?>
                    <?php } ?>
                </td>
                
                <!--td class="TabelaDados01Celula">
                    <?php if($GLOBALS['habilitarPaginasVinculo1'] == 1){ ?>
						<?php if($linhaPaginas['id_tb_cadastro1'] <> 0){ ?>
                        <div class="AdmTexto01">
                            <a href="SiteAdmCadastroAdministrar.php?idTbCadastro=<?php echo $linhaPaginas['id_tb_cadastro1'];?>&masterPageSiteSelect=LayoutSitePrincipal.php" class="AdmLinks01">
								<?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaPaginas['id_tb_cadastro1'], "tb_cadastro", "nome"), 
                                DbFuncoes::GetCampoGenerico01($linhaPaginas['id_tb_cadastro1'], "tb_cadastro", "razao_social"), 
                                DbFuncoes::GetCampoGenerico01($linhaPaginas['id_tb_cadastro1'], "tb_cadastro", "nome_fantasia"), 
                                1)); ?>
                            </a>
                        </div>
                        <?php } ?>
                    <?php } ?>
                </td-->
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                    	<a href="../<?php echo $GLOBALS['visualizacaoAtivaSistema'];?>/SitePaginasDetalhes.php?idTbPaginas=<?php echo $linhaPaginas['id'];?>" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemVisualizacao"); ?>
                        </a>
                    </div>
                </td>
                
                <?php if($GLOBALS['habilitarPaginasAcessoRestrito'] == 1){ ?>
                <!--td class="<?php if($linhaPaginas['acesso_restrito'] == 0){/*echo "AdmTbFundoClaro";*/}else{echo "AdmTbFundoDesativado";}?> TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                    	<a href="SiteAdmRegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaPaginas['id'];?>&statusAtivacao=<?php echo $linhaPaginas['acesso_restrito'];?>&strTabela=tb_paginas&strCampo=acesso_restrito<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="AdmLinks01">
                        	<?php if($linhaPaginas['acesso_restrito'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAcesso0"); ?>
                            <?php } ?>
                        	<?php if($linhaPaginas['acesso_restrito'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAcesso1"); ?>
                            <?php } ?>
                        </a>
                        <?php //echo $linhaPaginas['acesso_restrito'];?>
                    </div>
                </td-->
                <?php } ?>
                
                <!--td class="<?php if($linhaPaginas['ativacao'] == 1){/*echo "AdmTbFundoClaro";*/}else{echo "AdmTbFundoDesativado";}?> TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                    	<a href="SiteAdmRegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaPaginas['id'];?>&statusAtivacao=<?php echo $linhaPaginas['ativacao'];?>&strTabela=tb_paginas&strCampo=ativacao<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="AdmLinks01">
                        	<?php if($linhaPaginas['ativacao'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao0"); ?>
                            <?php } ?>
                        	<?php if($linhaPaginas['ativacao'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao1"); ?>
                            <?php } ?>
                        </a>
						<?php //echo $linhaPaginas['ativacao'];?>
                    </div>
                </td-->
                <!--td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <a href="SiteAdmPaginasEditar.php?idTbPaginas=<?php echo $linhaPaginas['id'];?><?php echo $queryPadrao;?>" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                        </a>
                    </div>
                </td-->
                <!--td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaPaginas['id'];?>" class="AdmCampoCheckBox01" />
                    </div>
                </td-->
              </tr>
              <?php 
				  //Linha alternativa de tabela.
				  //----------
				  //$countTabelaFundo = $countTabelaFundo + 1;
				  $countTabelaFundo++;
				
				   if($countTabelaFundo == 2)
				   {
					   $countTabelaFundo = 0;
				   }
				  //----------
			  } 
			  ?>
            </table>
        </div>
    <?php } ?>
    <?php //**************************************************************************************?>
<?php } ?>


<?php
//Limpeza de objetos.
//----------
unset($strSqlPaginasSelect);
unset($statementPaginasSelect);
unset($resultadoPaginas);
unset($linhaPaginas);
//----------
?>

