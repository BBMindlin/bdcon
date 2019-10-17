<?php
//Definição de variáveis.
$IdParentCategorias = $includeAdmCategorias_idParentCategorias;
if($IdParentCategorias == "")
{
	$IdParentCategorias = "1"; //Categoria inexistente - segurança.
}

$IdParentCategoriasRaiz = $includeAdmCategorias_idParentCategoriasRaiz;

$IdTbCadastroUsuario = $includeAdmCategorias_idTbCadastroUsuario;
if($IdTbCadastroUsuario == "")
{
	//$IdTbCadastroUsuario = "0";
	$IdTbCadastroUsuario = $idTbCadastroLogado;
}

$IdsTbCategorias = $includeAdmCategorias_idsTbCategorias;
$TipoCategoria = $includeAdmCategorias_tipoCategoria;
$HabilitarCategoriasSubniveis = $includeAdmCategorias_habilitarCategoriasSubniveis;
if($HabilitarCategoriasSubniveis == "")
{
	$HabilitarCategoriasSubniveis = false;
}

$ConfigTipoDiagramacao = $includeAdmCategorias_configTipoDiagramacao; //1 - Tabela ADM (manipulação de categorias) | 2 - Tabela - Navegação
if($ConfigTipoDiagramacao == "")
{
	$ConfigTipoDiagramacao = "1";
}
$ConfigCategoriasNRegistros = $includeAdmCategorias_configCategoriasNRegistros;
$ConfigClassificacaoCategorias = $includeAdmCategorias_configClassificacaoCategorias;
if($ConfigClassificacaoCategorias == "")
{
	$ConfigClassificacaoCategorias = $GLOBALS['configClassificacaoCategorias'];
}

$PaginaRetorno = $includeAdmCategorias_paginaRetorno;
$queryPadrao = "";
//$paginacaoNumero = "";
//$paginacaoTotal = "";

//Paginação.
if($GLOBALS['habilitarCategoriasSitePaginacao'] == "1"){
	$paginacaoNRegistros = $GLOBALS['configCategoriasSitePaginacaoNRegistros'];
	$paginacaoNumero = $_GET["paginacaoNumero"];
	if($paginacaoNumero == "")
	{
		$paginacaoNumero = 1;
	}
	//$paginacaoTotalRegistros = DbFuncoes::CountRegistrosGenericos("tb_categorias", "id_parent", $idParentCategorias); //Quantidade de registros.
	//$paginacaoTotal = ceil($paginacaoTotalRegistros / $paginacaoNRegistros);
	$paginacaoInicio = ($paginacaoNumero-1) * $paginacaoNRegistros;
}

//Montagem de query padrão de retorno.
$queryPadrao = "&idParentCategorias=" . $IdParentCategorias . 
				"&paginaRetorno=" . $PaginaRetorno . 
				"&idParentCategoriasRaiz=" . $IdParentCategoriasRaiz . 
				"&tipoCategoria=" . $TipoCategoria . 
				"&idTbCadastroUsuario=" . $IdTbCadastroUsuario;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.

//Query de pesquisa.
//----------
$strSqlCategoriasSelect = "";
$strSqlCategoriasSelect .= "SELECT ";
$strSqlCategoriasSelect .= "id, ";
$strSqlCategoriasSelect .= "id_parent, ";
$strSqlCategoriasSelect .= "id_tb_cadastro_usuario, ";
$strSqlCategoriasSelect .= "n_classificacao, ";
$strSqlCategoriasSelect .= "data_categoria, ";
$strSqlCategoriasSelect .= "categoria, ";
$strSqlCategoriasSelect .= "descricao, ";
$strSqlCategoriasSelect .= "informacao_complementar1, ";
$strSqlCategoriasSelect .= "informacao_complementar2, ";
$strSqlCategoriasSelect .= "informacao_complementar3, ";
$strSqlCategoriasSelect .= "informacao_complementar4, ";
$strSqlCategoriasSelect .= "informacao_complementar5, ";
$strSqlCategoriasSelect .= "tipo_categoria, ";
$strSqlCategoriasSelect .= "imagem, ";
$strSqlCategoriasSelect .= "ativacao, ";
$strSqlCategoriasSelect .= "acesso_restrito ";

//Paginação.
if($GLOBALS['habilitarCategoriasSitePaginacao'] == "1")
{
	$strSqlCategoriasSelect .= ", (SELECT COUNT(id) ";
	$strSqlCategoriasSelect .= "FROM tb_categorias ";
	$strSqlCategoriasSelect .= "WHERE id <> 0 ";
	//if(!empty($idParentCategorias)) //0 está retornando empty (talvez - verificar)
	if($IdParentCategorias <> "")
	{
		$strSqlCategoriasSelect .= "AND id_parent = :id_parent ";
	}
	if($IdTbCadastroUsuario <> "")
	{
		$strSqlCategoriasSelect .= "AND id_tb_cadastro_usuario = :id_tb_cadastro_usuario ";
	}
	if($TipoCategoria <> "")
	{
		$strSqlCategoriasSelect .= "AND tipo_categoria = :tipo_categoria ";
	}
	if($palavraChave <> "")
	{
		$strSqlCategoriasSelect .= "AND (categoria LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCategoriasSelect .= "OR descricao LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCategoriasSelect .= "OR informacao_complementar1 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCategoriasSelect .= "OR informacao_complementar2 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCategoriasSelect .= "OR informacao_complementar3 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCategoriasSelect .= "OR informacao_complementar4 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCategoriasSelect .= "OR informacao_complementar5 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCategoriasSelect .= ") ";
	}
	$strSqlCategoriasSelect .= ") totalRegistros ";
}

$strSqlCategoriasSelect .= "FROM tb_categorias ";
$strSqlCategoriasSelect .= "WHERE id <> 0 ";
//$strSqlCategoriasSelect .= "AND id_parent = ? ";
//$strSqlCategoriasSelect .= "AND id_parent = " . $idParentCategorias . " ";
//----------


//Componentes e parâmetros.
//----------
//if(!empty($idParentCategorias)) //0 está retornando empty (talvez - verificar)
if($IdParentCategorias <> "")
{
	$strSqlCategoriasSelect .= "AND id_parent = :id_parent ";
}
if($IdTbCadastroUsuario <> "")
{
	$strSqlCategoriasSelect .= "AND id_tb_cadastro_usuario = :id_tb_cadastro_usuario ";
}
if($TipoCategoria <> "")
{
	$strSqlCategoriasSelect .= "AND tipo_categoria = :tipo_categoria ";
}
if($palavraChave <> "")
{
	$strSqlCategoriasSelect .= "AND (categoria LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCategoriasSelect .= "OR descricao LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCategoriasSelect .= "OR informacao_complementar1 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCategoriasSelect .= "OR informacao_complementar2 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCategoriasSelect .= "OR informacao_complementar3 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCategoriasSelect .= "OR informacao_complementar4 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCategoriasSelect .= "OR informacao_complementar5 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCategoriasSelect .= ") ";
}

//if($GLOBALS['habilitarCategoriasClassificacaoPersonalizada'] == 1 and DbFuncoes::GetCampoGenerico04("classificacao", "criterio_classificacao", "id_registro", $idParentCategorias) <> "")
//{
	//$strSqlCategoriasSelect .= "ORDER BY " . DbFuncoes::GetCampoGenerico04("classificacao", "criterio_classificacao", "id_registro", $idParentCategorias) . " ";
	
//}else{
	$strSqlCategoriasSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCategorias'] . " ";
//}

//Paginação.
if($GLOBALS['habilitarCategoriasSitePaginacao'] == "1"){ 
	if($configTipoDB == 2)
	{
		$strSqlCategoriasSelect .= "LIMIT " . $paginacaoInicio . ", " . $paginacaoNRegistros . "";
	}
}

//echo "strSqlCategoriasSelect=" . $strSqlCategoriasSelect . "<br />";
//----------

//echo "GLOBALS[configClassificacaoCategorias]=" . $GLOBALS['configClassificacaoCategorias'] . "<br />";

//$resultadoCategorias = mysqli_query($dbSistemaCon, $strSqlCategoriasSelect);
//$linhaCategorias = mysqli_fetch_array($resultadoCategorias);
//$linhaCategorias = mysqli_fetch_array($resultadoCategorias, MYSQLI_ASSOC);

$statementCategoriasSelect = $dbSistemaConPDO->prepare($strSqlCategoriasSelect);

if ($statementCategoriasSelect !== false)
{
	if($IdParentCategorias <> "")
	{
		$statementCategoriasSelect->bindParam(':id_parent', $IdParentCategorias, PDO::PARAM_STR);
	}
	if($IdTbCadastroUsuario <> "")
	{
		$statementCategoriasSelect->bindParam(':id_tb_cadastro_usuario', $IdTbCadastroUsuario, PDO::PARAM_STR);
	}
	if($TipoCategoria <> "")
	{
		$statementCategoriasSelect->bindParam(':tipo_categoria', $TipoCategoria, PDO::PARAM_STR);
	}
	$statementCategoriasSelect->execute();
	/*
	$statementCategoriasSelect->execute(array(
		"id_parent" => $idParentCategorias
	));
	*/
}

//$resultadoCategorias = $dbSistemaConPDO->query($strSqlCategoriasSelect);
$resultadoCategorias = $statementCategoriasSelect->fetchAll();
//----------


//Paginação.
if($GLOBALS['habilitarCategoriasSitePaginacao'] == "1")
{
	//$paginacaoTotalRegistros = DbFuncoes::CountRegistrosGenericos("tb_cadastro", "id_tb_categorias", $idParentCadastro); //Quantidade de registros.
	//$paginacaoTotalRegistros = DbFuncoes::CountRegistrosGenericos("tb_cadastro", "id_tb_categorias", $idParentCadastro, "", "", "", "", "", ""); //Quantidade de registros.
	$paginacaoTotalRegistros = $resultadoCategorias[0]['totalRegistros'];
	$paginacaoTotal = ceil($paginacaoTotalRegistros / $paginacaoNRegistros);
}


//Verificação de erro - debug.
//echo "IdTbCategoriasMenuRaiz=" . $IdTbCategoriasMenuRaiz . "<br />";
//echo "TipoCategoriasMenu=" . $TipoCategoriasMenu . "<br />";
//echo "strSqlCategoriasSelect=" . $strSqlCategoriasSelect . "<br />";
?>


<?php //Diagramação 1.?>
<?php //**************************************************************************************?>
<?php if($ConfigTipoDiagramacao == "1"){ ?>
<div align="center" style="position: relative; display: block; overflow: hidden;">
    <?php
    //if(mysqli_num_rows($resultadoCategorias) == 0){ //Verificação se está vazio.
	//if ($resultadoCategorias->fetchColumn() == 0) //Verificação se está vazio.
	if (empty($resultadoCategorias))
	{
        //echo "Nenhum registro encontrado";
    ?>
        <div align="center" class="AdmErro">
            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatus1"); ?>
        </div>
    <?php
    }else{
    ?>
        <form name="formCategoriasAcoes" id="formCategoriasAcoes" action="SiteAdmRegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input type="hidden" name="strTabela" id="strTabela" value="tb_categorias" />
            <input type="hidden" name="idParentCategorias" id="idParentCategorias" value="<?php echo $idParentCategorias; ?>" />
            <input type="hidden" name="idTbCadastroUsuario" id="idTbCadastroUsuario" value="<?php echo $idTbCadastroUsuario; ?>" />
            
            <input type="hidden" name="masterPageSiteSelect" id="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
            <input type="hidden" name="paginaRetorno" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            
            <input type="hidden" name="paginacaoNumero" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input type="hidden" name="caracterAtual" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            <div style="position:relative; display: block; clear: both;">
                <div align="right" style="float: right;">
                    <input type="image" name="submit" value="Submit" src="img/btoExcluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoExcluir"); ?>">
                </div>
            </div>
            <table width="100%" class="AdmTabelaDados01">
              <tr class="AdmTbFundoEscuro">
              	<?php if($GLOBALS['habilitarCategoriasNClassificacao'] == 1){ ?>
                <td width="50" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNClassificacaoA"); ?>
                    </div>
                </td>
                <?php } ?>
                <td class="AdmTabelaDados01Celula">
                    <div class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCategoriasCategoria"); ?>
                    </div>
                </td>
                <td width="100" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFuncoes"); ?>
                    </div>
                </td>
                <?php if($GLOBALS['habilitarCategoriasAcessoRestrito'] == 1){ ?>
                <td width="50" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAcesso"); ?>
                    </div>
                </td>
                <?php } ?>
                <td width="30" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao"); ?>
                    </div>
                </td>
                <td width="30" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                    </div>
                </td>
                <td width="30" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemExcluir"); ?>
                    </div>
                </td>
              </tr>
              <?php
				$countTabelaFundo = 0;
				
			  
                //Loop pelos resultados.
                //while($linhaCategorias = mysqli_fetch_array($resultadoCategorias))
                //foreach ($dbSistemaConPDO->query($strSqlCategoriasSelect) as $linhaCategorias)
                //while ($linhaCategorias = $statementCategoriasSelect->fetchAll())
                foreach($resultadoCategorias as $linhaCategorias)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="<?php if($countTabelaFundo == 0){ ?>AdmTbFundoClaro<?php }else{?>AdmTbFundoAlternativo<?php } ?>">
              	<?php if($GLOBALS['habilitarCategoriasNClassificacao'] == 1){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <?php echo $linhaCategorias['n_classificacao'];?>
                    </div>
                </td>
                <?php } ?>
                <td class="AdmTabelaDados01Celula">
                    <div class="AdmTexto01">
                        <?php if(Funcoes::CategoriaPaginaSelect($linhaCategorias['tipo_categoria'], 3) == "-"){?>
                            <a href="SiteAdmCategoriasIndice.php?idParentCategorias=<?php echo $linhaCategorias['id'];?>&configTipoDiagramacao=1&idTbCadastroUsuario=<?php echo $IdTbCadastroUsuario; ?>&tipoCategoria=<?php echo $TipoCategoria; ?>" class="AdmLinks01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaCategorias['categoria']);?>
                                <?php //echo Funcoes::ConteudoMascaraLeitura($linhaCategorias['id_parent']);?>
                            </a>
                        <?php }else{ ?>
                            <a href="<?php echo Funcoes::CategoriaPaginaSelect($linhaCategorias['tipo_categoria'], 11);?>?<?php echo Funcoes::CategoriaPaginaSelect($linhaCategorias['tipo_categoria'], 12);?>=<?php echo $linhaCategorias['id'];?>" class="AdmLinks01">
                                <?php //echo Funcoes::ConteudoMascaraLeitura(Funcoes::CategoriaPaginaSelect($linhaCategorias['tipo_categoria'], 5),"utf8_encode");?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaCategorias['categoria']);?>
                            </a>
                        <?php } ?>
                    </div>
                    <div class="AdmTexto01">
                        <?php //echo $linhaCategorias['descricao'];?>
                        <?php //echo nl2br($linhaCategorias['descricao']);?>
                        <?php echo Funcoes::ConteudoMascaraLeitura($linhaCategorias['descricao']);?>
                    </div>
                    
                    <?php if($GLOBALS['habilitarCategoriasIc1'] == 1){ ?>
                        <?php if($linhaCategorias['informacao_complementar1'] <> ''){ ?>
                            <div class="AdmTexto01">
                                <strong>
                                    <?php //echo htmlentities($GLOBALS['configTituloCategoriasIc1']); ?> 
                                    <?php //echo htmlentities($GLOBALS['configTituloCategoriasIc1'],ENT_QUOTES); ?> 
                                    <?php echo utf8_encode($GLOBALS['configTituloCategoriasIc1']); ?>: 
                                </strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaCategorias['informacao_complementar1']);?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    
                    <?php if($GLOBALS['habilitarCategoriasIc2'] == 1){ ?>
                        <?php if($linhaCategorias['informacao_complementar2'] <> ''){ ?>
                            <div class="AdmTexto01">
                                <strong>
                                    <?php echo utf8_encode($GLOBALS['configTituloCategoriasIc2']); ?>: 
                                </strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaCategorias['informacao_complementar2']);?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    
                    <?php if($GLOBALS['habilitarCategoriasIc3'] == 1){ ?>
                        <?php if($linhaCategorias['informacao_complementar3'] <> ''){ ?>
                            <div class="AdmTexto01">
                                <strong>
                                    <?php echo utf8_encode($GLOBALS['configTituloCategoriasIc3']); ?>: 
                                </strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaCategorias['informacao_complementar3']);?>
                            </div>
                        <?php } ?>
                    <?php } ?>
            
                    <?php if($GLOBALS['habilitarCategoriasIc4'] == 1){ ?>
                        <?php if($linhaCategorias['informacao_complementar4'] <> ''){ ?>
                            <div class="AdmTexto01">
                                <strong>
                                    <?php echo utf8_encode($GLOBALS['configTituloCategoriasIc4']); ?>: 
                                </strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaCategorias['informacao_complementar4']);?>
                            </div>
                        <?php } ?>
                    <?php } ?>
            
                    <?php if($GLOBALS['habilitarCategoriasIc5'] == 1){ ?>
                        <?php if($linhaCategorias['informacao_complementar5'] <> ''){ ?>
                            <div class="AdmTexto01">
                                <strong>
                                    <?php echo utf8_encode($GLOBALS['configTituloCategoriasIc5']); ?>: 
                                </strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaCategorias['informacao_complementar5']);?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    
                    <div class="AdmTexto01">
                    	<?php if($GLOBALS['habilitarCategoriasFotos'] == 1){ ?>
                            [
                            <a href="ArquivosIndice.php?idParent=<?php echo $linhaCategorias['id'];?>&tipoArquivo=1&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo $linhaCategorias['categoria'];?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirFotos"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarCategoriasVideos'] == 1){ ?>
                            [
                            <a href="ArquivosIndice.php?idParent=<?php echo $linhaCategorias['id'];?>&tipoArquivo=2&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo $linhaCategorias['categoria'];?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirVideos"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarCategoriasArquivos'] == 1){ ?>
                            [
                            <a href="ArquivosIndice.php?idParent=<?php echo $linhaCategorias['id'];?>&tipoArquivo=3&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo $linhaCategorias['categoria'];?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirArquivos"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarCategoriasZip'] == 1){ ?>
                            [
                            <a href="ArquivosIndice.php?idParent=<?php echo $linhaCategorias['id'];?>&tipoArquivo=4&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo $linhaCategorias['categoria'];?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirZip"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarCategoriasSwfs'] == 1){ ?>
                            [
                            <a href="ArquivosIndice.php?idParent=<?php echo $linhaCategorias['id'];?>&tipoArquivo=5&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo $linhaCategorias['categoria'];?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirSWFs"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    </div>
                </td>
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <?php if(Funcoes::CategoriaPaginaSelect($linhaCategorias['tipo_categoria'], 3) == "-"){?>
                            <?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::CategoriaPaginaSelect($linhaCategorias['tipo_categoria'], 5),"utf8_encode");?>
                        <?php }else{ ?>
                            <a href="<?php echo Funcoes::CategoriaPaginaSelect($linhaCategorias['tipo_categoria'], 11);?>?<?php echo Funcoes::CategoriaPaginaSelect($linhaCategorias['tipo_categoria'], 12);?>=<?php echo $linhaCategorias['id'];?>" class="AdmLinks01">
                                <?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::CategoriaPaginaSelect($linhaCategorias['tipo_categoria'], 5),"utf8_encode");?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
                
                <?php if($GLOBALS['habilitarCategoriasAcessoRestrito'] == 1){ ?>
                <td class="<?php if($linhaCategorias['acesso_restrito'] == 0){/*echo "AdmTbFundoClaro";*/}else{echo "AdmTbFundoDesativado";}?> AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                    	<a href="SiteAdmRegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaCategorias['id'];?>&statusAtivacao=<?php echo $linhaCategorias['acesso_restrito'];?>&strTabela=tb_categorias&strCampo=acesso_restrito<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="AdmLinks01">
                        	<?php if($linhaCategorias['acesso_restrito'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAcesso0"); ?>
                            <?php } ?>
                        	<?php if($linhaCategorias['acesso_restrito'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAcesso1"); ?>
                            <?php } ?>
                        </a>
                        <?php //echo $linhaCategorias['acesso_restrito'];?>
                    </div>
                </td>
                <?php } ?>
                
                <td class="<?php if($linhaCategorias['ativacao'] == 1){/*echo "AdmTbFundoClaro";*/}else{echo "AdmTbFundoDesativado";}?> AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                    	<?php if($linhaCategorias['id_tb_cadastro_usuario'] == $IdTbCadastroUsuario){ ?>
                            <a href="SiteAdmRegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaCategorias['id'];?>&statusAtivacao=<?php echo $linhaCategorias['ativacao'];?>&strTabela=tb_categorias&strCampo=ativacao<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="AdmLinks01">
                                <?php if($linhaCategorias['ativacao'] == 0){?>
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao0"); ?>
                                <?php } ?>
                                <?php if($linhaCategorias['ativacao'] == 1){?>
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao1"); ?>
                                <?php } ?>
                            </a>
                        <?php } ?>
						<?php //echo $linhaCategorias['ativacao'];?>
                    </div>
                </td>
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                    	<?php if($linhaCategorias['id_tb_cadastro_usuario'] == $IdTbCadastroUsuario){ ?>
                            <a href="SiteAdmCategoriasEditar.php?idTbCategorias=<?php echo $linhaCategorias['id'];?><?php echo $queryPadrao;?>" class="AdmLinks01">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                    	<?php if($linhaCategorias['id_tb_cadastro_usuario'] == $IdTbCadastroUsuario){ ?>
                            <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaCategorias['id'];?>" class="AdmCampoCheckBox01" />
                        <?php } ?>
                    </div>
                </td>
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
        </form>
    <?php } ?>
    
    
	<?php //Paginação. ?>
    <?php //************************************************************************************** ?>
    <?php if($GLOBALS['habilitarCategoriasSitePaginacao'] == "1"){ ?>
		<?php if($paginacaoTotal > 1){ //Verifica se existe mais de uma página.?>
            <div align="center" class="AdmTexto01">
                <div style="position: relative; display: inline; margin: 2px;">
                    <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=1<?php echo $queryPadrao; ?>" class="AdmLinks01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPaginacaoPrimeira"); ?>
                    </a>
                </div>
                
                <?php if($paginacaoNumero > 1){ ?>
                    <div style="position: relative; display: inline; margin: 2px;">
                        <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=<?php echo $paginacaoNumero - 1; ?><?php echo $queryPadrao; ?>" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPaginacaoAnterior"); ?>
                        </a>
                    </div>
                <?php } ?>
                

                <?php //Numeração de páginas. ?>
                <?php if($GLOBALS['habilitarCategoriasSitePaginacaoNumeracao'] == "1"){ ?>
                    <?php for($countPaginas = 1; $countPaginas <= $paginacaoTotal; $countPaginas++){ ?>
                        <div style="position: relative; display: inline; margin: 2px;">
                            <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=<?php echo $countPaginas; ?><?php echo $queryPadrao; ?>" class="AdmLinks01">
                                <?php echo $countPaginas; ?>
                            </a>
                        </div>
                    <?php } ?>
                <?php } ?>
                
                <?php if($paginacaoNumero <> $paginacaoTotal){ ?>
                    <div style="position: relative; display: inline; margin: 2px;">
                        <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=<?php echo $paginacaoNumero + 1; ?><?php echo $queryPadrao; ?>" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPaginacaoProxima"); ?>
                        </a>
                    </div>
                <?php } ?>
                
                <div style="position: relative; display: inline; margin: 2px;">
                    <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=<?php echo $paginacaoTotal; ?><?php echo $queryPadrao; ?>" class="AdmLinks01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPaginacaoUltima"); ?>
                    </a>
                </div>
            </div>
            
            <?php //Contagem de páginas. ?>
            <div align="center" class="AdmTexto01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePaginacaoPaginaContador01"); ?> 
                <?php echo $paginacaoNumero; ?> / <?php echo $paginacaoTotal; ?>
            </div>
        <?php } ?>
	<?php } ?>
	<?php //************************************************************************************** ?>
    
    
    <div style="position: relative; display: block; overflow: hidden;">
		<script type="text/javascript">
            $(document).ready(function () {
            
                //Validação de formulário (JQuery).
                //**************************************************************************************
                $('#formCategorias').validate({ //Inicialização do plug-in.
                
                
                    //Estilo da mensagem de erro.
                    //----------------------
                    errorClass: "TextoErro",
                    //----------------------
                    
                    
                    //Validação
                    //----------------------
                    rules: {
                        n_classificacao: {
                            required: true,
                            //regex: /-?\d+(\.\d{1,3})?/
                            number: true
                        }//,
                        //field2: {
                            //required: true,
                            //minlength: 5
                        //}
                    },
                    
                    
                    //Mensagens.
                    //----------------------
                    messages: {
                        //n_classificacao: "Please specify your name"//,
                        n_classificacao: {
                          //required: "Campo obrigatório.",
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>",
                          //regex: "Campo numérico."
                          //number: "Campo numérico."
                          number: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica1"); ?>"
                        }
                    },		
                    //----------------------
                    
                    
                    /*
                    errorPlacement: function(error, element) {
                        if(element.attr("name") == "n_classificacao")
                        {
                            error.insertAfter(".nomedadiv");
                        }
                        else if  (element.attr("name") == "phone" )
                            error.insertAfter(".some-other-class");
                        else
                            error.insertAfter(element);
                    }
                    */
                });
                //**************************************************************************************
    
            });	
        </script>
        <form name="formCategorias" id="formCategorias" action="SiteAdmCategoriasIndiceExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <?php //echo "habilitarCategoriasNClassificacao=" . $GLOBALS['habilitarCategoriasNClassificacao'] . "<br />"; ?>
        <table class="AdmTabelaCampos01">
            <tr class="AdmTbFundoEscuro">
                <td class="AdmTabelaCampos01Celula" colspan="4">
                    <div align="center" class="AdmTexto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCategoriasTbCategorias"); ?>
                        </strong>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCategoriasCategoria"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula"<?php if($GLOBALS['habilitarCategoriasNClassificacao'] <> "1"){ ?> colspan="3"<?php } ?>>
                    <div align="left">
                        <input type="text" name="categoria" id="categoria" class="AdmCampoTexto02" maxlength="255" />
                    </div>
                </td>
                <?php if($GLOBALS['habilitarCategoriasNClassificacao'] == 1){ ?>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNClassificacao"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaColuna01 AdmTabelaCampos01Celula">
                    <div>
                        <input type="text" name="n_classificacao" id="n_classificacao" class="AdmCampoNumerico01" maxlength="10" value="0" />
                    </div>
                </td>
                <?php } ?>
            </tr>
            
            <?php if($GLOBALS['ativacaoCategoriasDescricao'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCategoriasDescricao"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                    <div>
                      <textarea id="descricao" name="descricao" class="AdmCampoTextoMultilinha01"></textarea>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($TipoCategoria == ""){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCategoriasTipo"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                        <div>
                            <select name="tipo_categoria" id="tipo_categoria" class="AdmCampoDropDownMenu01">
                                <?php
                                for ($countTipoCategoria = 0; $countTipoCategoria < count($GLOBALS['arrTipoCategoriaConfigIndice']); ++$countTipoCategoria) 
                                { 
                                ?>
                                    <option value="<?php echo $GLOBALS['arrTipoCategoriaConfigIndice'][$countTipoCategoria];?>"><?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['arrTipoCategoriaConfigNome'][$countTipoCategoria],"utf8_encode");?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        </div>
                    </td>
                </tr>
        	<?php }else{ ?>
                <input type="hidden" name="tipo_categoria" id="tipo_categoria" value="<?php echo $TipoCategoria; ?>" />
            <?php } ?>

            <?php if($GLOBALS['habilitarCategoriasIc1'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCategoriasIc1'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCategoriasBoxIc1'] == 1){ ?>
                            <input type="text" name="informacao_complementar1" id="informacao_complementar1" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configCategoriasBoxIc1'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar1" id="informacao_complementar1" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar1").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar1" id="informacao_complementar1"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar1").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar1" id="informacao_complementar1"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCategoriasIc2'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCategoriasIc2'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCategoriasBoxIc2'] == 1){ ?>
                            <input type="text" name="informacao_complementar2" id="informacao_complementar2" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configCategoriasBoxIc2'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar2" id="informacao_complementar2" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar2").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar2" id="informacao_complementar2"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar2").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar2" id="informacao_complementar2"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarCategoriasIc3'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCategoriasIc3'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCategoriasBoxIc3'] == 1){ ?>
                            <input type="text" name="informacao_complementar3" id="informacao_complementar3" class="AdmCampoTexto02" maxlength="255">
                        <?php } ?>
                        <?php if($GLOBALS['configCategoriasBoxIc3'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar3" id="informacao_complementar3" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar3").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar3" id="informacao_complementar3"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar3").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar3" id="informacao_complementar3"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarCategoriasIc4'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCategoriasIc4'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCategoriasBoxIc4'] == 1){ ?>
                            <input type="text" name="informacao_complementar4" id="informacao_complementar4" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configCategoriasBoxIc4'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar4" id="informacao_complementar4" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar4").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar4" id="informacao_complementar4"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar4").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar4" id="informacao_complementar4"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarCategoriasIc5'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCategoriasIc5'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCategoriasBoxIc5'] == 1){ ?>
                            <input type="text" name="informacao_complementar5" id="informacao_complementar5" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configCategoriasBoxIc5'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar5" id="informacao_complementar5" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar5").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar5" id="informacao_complementar5"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar5").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar5" id="informacao_complementar5"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            <?php if($GLOBALS['ativacaoCategoriasImagem'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemImagem"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                    <div>
                        <input type="file" name="ArquivoUpload1" id="ArquivoUpload1" class="AdmCampoArquivoUpload01">
                    </div>
                </td>
            </tr>
            <?php } ?>
        </table>
        <div>
            <div style="float:left;">
                <input type="image" name="submit" value="Submit" src="img/btoIncluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoIncluir"); ?>" />
                
                <input type="hidden" id="id_parent" name="id_parent" value="<?php echo $IdParentCategorias; ?>" />
                <input type="hidden" id="ativacao" name="ativacao" value="1" />
                <input type="hidden" id="acesso_restrito" name="acesso_restrito" value="0" />
                <input type="hidden" id="id_tb_cadastro_usuario" name="id_tb_cadastro_usuario" value="<?php echo $IdTbCadastroUsuario; ?>" />
                
                <input type="hidden" id="configTipoDiagramacao" name="configTipoDiagramacao" value="<?php echo $configTipoDiagramacao; ?>" />
                <input type="hidden" id="masterPageSiteSelect" name="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
                <input type="hidden" id="paginaRetorno" name="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            </div>
            <div style="float:right;">
                &nbsp;
            </div>
        </div>
        </form>
    </div>
    
</div>
<?php } ?>
<?php //**************************************************************************************?>



<?php //Diagramação 2.?>
<?php //**************************************************************************************?>
<?php if($ConfigTipoDiagramacao == "2"){ ?>
<div align="center" style="position: relative; display: block; overflow: hidden;">
    <?php
    //if(mysqli_num_rows($resultadoCategorias) == 0){ //Verificação se está vazio.
	//if ($resultadoCategorias->fetchColumn() == 0) //Verificação se está vazio.
	if (empty($resultadoCategorias))
	{
        //echo "Nenhum registro encontrado";
    ?>
        <div align="center" class="AdmErro">
            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatus1"); ?>
        </div>
    <?php
    }else{
    ?>
            <table width="100%" class="AdmTabelaDados01">
              <tr class="AdmTbFundoEscuro">
                <td class="AdmTabelaDados01Celula">
                    <div class="AdmTexto02">
						<?php if($GLOBALS['habilitarCategoriasClassificacaoPersonalizada'] == 1){ ?>
                            <a href="SiteAdmClassificacaoPersonalizadaExe.php?idRegistro=<?php echo $idParentCategorias; ?>&strTabela=tb_categorias&criterioClassificacao=categoria<?php echo $queryPadrao; ?><?php echo $queryPadraoRetornoPaginacao; ?>" class="AdmLinks02">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCategoriasCategoria"); ?>
                            <a>
                         <?php }else{ ?>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCategoriasCategoria"); ?>
                        <?php } ?>
                    </div>
                </td>
              </tr>
              <?php
				$countTabelaFundo = 0;
			  
				//Loop pelos resultados.
				//while($linhaCategorias = mysqli_fetch_array($resultadoCategorias))
				//foreach ($dbSistemaConPDO->query($strSqlCategoriasSelect) as $linhaCategorias)
				//while ($linhaCategorias = $statementCategoriasSelect->fetchAll())
				foreach($resultadoCategorias as $linhaCategorias)
				{
					//echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="<?php if($countTabelaFundo == 0){ ?>AdmTbFundoClaro<?php }else{?>AdmTbFundoAlternativo<?php } ?>">
                <td class="AdmTabelaDados01Celula">
                    <div class="AdmTexto01">
                        <?php if(Funcoes::CategoriaPaginaSelect($linhaCategorias['tipo_categoria'], 3) == "-"){?>
                            <a href="SiteAdmCategoriasIndice.php?idParentCategorias=<?php echo $linhaCategorias['id'];?>&configTipoDiagramacao=2" class="AdmLinks01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaCategorias['categoria']);?>
                                <?php //echo Funcoes::ConteudoMascaraLeitura($linhaCategorias['id_parent']);?>
                            </a>
                        <?php }else{ ?>
                            <a href="<?php echo Funcoes::CategoriaPaginaSelect($linhaCategorias['tipo_categoria'], 11);?>?<?php echo Funcoes::CategoriaPaginaSelect($linhaCategorias['tipo_categoria'], 12);?>=<?php echo $linhaCategorias['id'];?>" class="AdmLinks01">
                                <?php //echo Funcoes::ConteudoMascaraLeitura(Funcoes::CategoriaPaginaSelect($linhaCategorias['tipo_categoria'], 5),"utf8_encode");?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaCategorias['categoria']);?>
                            </a>
                        <?php } ?>
                    </div>
                    <div class="AdmTexto01">
                        <?php //echo $linhaCategorias['descricao'];?>
                        <?php //echo nl2br($linhaCategorias['descricao']);?>
                        <?php echo Funcoes::ConteudoMascaraLeitura($linhaCategorias['descricao']);?>
                    </div>
                </td>
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
    <?php } ?>
    
    
	<?php //Paginação. ?>
    <?php //************************************************************************************** ?>
    <?php if($GLOBALS['habilitarCategoriasSitePaginacao'] == "1"){ ?>
		<?php if($paginacaoTotal > 1){ //Verifica se existe mais de uma página.?>
            <div align="center" class="AdmTexto01">
                <div style="position: relative; display: inline; margin: 2px;">
                    <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=1<?php echo $queryPadrao; ?>" class="AdmLinks01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPaginacaoPrimeira"); ?>
                    </a>
                </div>
                
                <?php if($paginacaoNumero > 1){ ?>
                    <div style="position: relative; display: inline; margin: 2px;">
                        <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=<?php echo $paginacaoNumero - 1; ?><?php echo $queryPadrao; ?>" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPaginacaoAnterior"); ?>
                        </a>
                    </div>
                <?php } ?>
                

                <?php //Numeração de páginas. ?>
                <?php if($GLOBALS['habilitarCategoriasSitePaginacaoNumeracao'] == "1"){ ?>
                    <?php for($countPaginas = 1; $countPaginas <= $paginacaoTotal; $countPaginas++){ ?>
                        <div style="position: relative; display: inline; margin: 2px;">
                            <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=<?php echo $countPaginas; ?><?php echo $queryPadrao; ?>" class="AdmLinks01">
                                <?php echo $countPaginas; ?>
                            </a>
                        </div>
                    <?php } ?>
                <?php } ?>
                
                <?php if($paginacaoNumero <> $paginacaoTotal){ ?>
                    <div style="position: relative; display: inline; margin: 2px;">
                        <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=<?php echo $paginacaoNumero + 1; ?><?php echo $queryPadrao; ?>" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPaginacaoProxima"); ?>
                        </a>
                    </div>
                <?php } ?>
                
                <div style="position: relative; display: inline; margin: 2px;">
                    <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=<?php echo $paginacaoTotal; ?><?php echo $queryPadrao; ?>" class="AdmLinks01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPaginacaoUltima"); ?>
                    </a>
                </div>
            </div>
            
            <?php //Contagem de páginas. ?>
            <div align="center" class="AdmTexto01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePaginacaoPaginaContador01"); ?> 
                <?php echo $paginacaoNumero; ?> / <?php echo $paginacaoTotal; ?>
            </div>
        <?php } ?>
	<?php } ?>
	<?php //************************************************************************************** ?>
</div>
<?php } ?>
<?php //**************************************************************************************?>


<?php
//Limpeza de objetos.
unset($strSqlCategoriasSelect);
unset($statementCategoriasSelect);
unset($resultadoCategorias);
unset($linhaCategorias);
//----------
?>