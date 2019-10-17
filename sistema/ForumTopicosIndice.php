<?php
//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeLayout.php";


//Verificação de login Master.
LoginAutenticacao::UsuarioLoginVerificacao();


//Resgate de variáveis.
$idTbCategorias = $_GET["idParent"];
$idParentCategoriasRaiz = $_GET["idParentCategoriasRaiz"];
if($idParentCategoriasRaiz == "")
{
	$idParentCategoriasRaiz = 0;
}
$idTbCadastroVendedor = $_GET["idTbCadastroVendedor"];
if($idTbCadastroVendedor == "")
{
	$idTbCadastroVendedor = 0;
}
$idTbCadastroUsuario = $_GET["idTbCadastroUsuario"];
if($idTbCadastroUsuario == "")
{
	$idTbCadastroUsuario = 0;
}

$palavraChave = $_GET["palavraChave"];

$paginaRetorno = "ForumTopicosIndice.php";
$paginaRetornoExclusao = "ForumTopicosEditar.php";
$variavelRetorno = "idTbCategorias";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];

//Paginação.
if($GLOBALS['habilitarForumTopicosSistemaPaginacao'] == "1"){
	$paginacaoNRegistros = $GLOBALS['configForumTopicosSistemaPaginacaoNRegistros'];
	$paginacaoNumero = $_GET["paginacaoNumero"];
	if($paginacaoNumero == "")
	{
		$paginacaoNumero = 1;
	}
	//$paginacaoTotalRegistros = DbFuncoes::CountRegistrosGenericos("tb_forum_topicos", "id_parent", $idParentForumTopicos); //Quantidade de registros.
	//$paginacaoTotal = ceil($paginacaoTotalRegistros / $paginacaoNRegistros);
	$paginacaoInicio = ($paginacaoNumero-1) * $paginacaoNRegistros;
}

//Montagem de query padrão de retorno.
$queryPadrao = "&idParent=" . $idTbCategorias . 
"&paginaRetorno=" . $paginaRetorno . 
"&masterPageSelect=" . $masterPageSelect . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&variavelRetorno=" . $variavelRetorno . 
"&palavraChave=" . $palavraChave;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Query de pesquisa.
//----------
$strSqlForumTopicosSelect = "";
$strSqlForumTopicosSelect .= "SELECT ";
//$strSqlForumTopicosSelect .= "* ";
$strSqlForumTopicosSelect .= "id, ";
$strSqlForumTopicosSelect .= "id_tb_categorias, ";
$strSqlForumTopicosSelect .= "id_tb_cadastro_vendedor, ";
$strSqlForumTopicosSelect .= "id_tb_cadastro_usuario, ";
$strSqlForumTopicosSelect .= "n_classificacao, ";
$strSqlForumTopicosSelect .= "data_topico, ";
$strSqlForumTopicosSelect .= "topico, ";
$strSqlForumTopicosSelect .= "assunto, ";
$strSqlForumTopicosSelect .= "ativacao, ";
$strSqlForumTopicosSelect .= "acesso_restrito ";

//Paginação (subquery).
if($GLOBALS['habilitarForumTopicosSistemaPaginacao'] == "1"){
	$strSqlForumTopicosSelect .= ", (SELECT COUNT(id) ";
	$strSqlForumTopicosSelect .= "FROM tb_forum_topicos ";
	$strSqlForumTopicosSelect .= "WHERE id <> 0 ";
	if($idTbCategorias <> "")
	{
		$strSqlForumTopicosSelect .= "AND id_tb_categorias = :id_tb_categorias ";
	}
	if($palavraChave <> "")
	{
	$strSqlForumTopicosSelect .= "AND (topico LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	/*
	*/
	$strSqlForumTopicosSelect .= "OR assunto LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlForumTopicosSelect .= ") ";
	}
	$strSqlForumTopicosSelect .= ") totalRegistros ";
}

$strSqlForumTopicosSelect .= "FROM tb_forum_topicos ";
$strSqlForumTopicosSelect .= "WHERE id <> 0 ";
if($idTbCategorias <> "")
{
	$strSqlForumTopicosSelect .= "AND id_tb_categorias = :id_tb_categorias ";
}
if($palavraChave <> "")
{
	$strSqlForumTopicosSelect .= "AND (topico LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	/*
	*/
	$strSqlForumTopicosSelect .= "OR assunto LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlForumTopicosSelect .= ") ";
}

$strSqlForumTopicosSelect .= "ORDER BY " . $GLOBALS['configClassificacaoForumTopicos'] . " ";

//Paginação.
if($GLOBALS['habilitarForumTopicosSistemaPaginacao'] == "1"){ 
	if($configTipoDB == 2)
	{
		$strSqlForumTopicosSelect .= "LIMIT " . $paginacaoInicio . ", " . $paginacaoNRegistros . "";
	}
}
//----------


//Parâmetros.
//----------
$statementForumTopicosSelect = $dbSistemaConPDO->prepare($strSqlForumTopicosSelect);

if ($statementForumTopicosSelect !== false)
{
	if($idTbCategorias <> "")
	{
		$statementForumTopicosSelect->bindParam(':id_tb_categorias', $idTbCategorias, PDO::PARAM_STR);
	}
	$statementForumTopicosSelect->execute();
	/*
	$statementForumTopicosSelect->execute(array(
		"id_tb_categorias" => $idParentForumTopicos
	));
	*/
}
//----------

//$resultadoForumTopicos = $dbSistemaConPDO->query($strSqlForumTopicosSelect);
$resultadoForumTopicos = $statementForumTopicosSelect->fetchAll();

//Paginação.
if($GLOBALS['habilitarForumTopicosSistemaPaginacao'] == "1"){
	//$paginacaoTotalRegistros = DbFuncoes::CountRegistrosGenericos("tb_cadastro", "id_tb_categorias", $idParentCadastro); //Quantidade de registros.
	//$paginacaoTotalRegistros = DbFuncoes::CountRegistrosGenericos("tb_cadastro", "id_tb_categorias", $idParentCadastro, "", "", "", "", "", ""); //Quantidade de registros.
	$paginacaoTotalRegistros = $resultadoForumTopicos[0]['totalRegistros'];
	$paginacaoTotal = ceil($paginacaoTotalRegistros / $paginacaoNRegistros);
}


//Verificação de erro - debug.
//echo "paginacaoTotalRegistros=" . $paginacaoTotalRegistros . "<br />";
//echo "habilitarBannersSistemaPaginacao=" . $habilitarBannersSistemaPaginacao . "<br />";
//echo "strSqlBannersSelect=" . $strSqlBannersSelect . "<br />";
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistema"); ?> - <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configNomeCliente'], "IncludeConfig"); ?>
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
    <div align="left" class="TextoTitulo01">
    	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaForumTopicosTitulo"); ?> - 
        <a href="CategoriasIndice.php?idParentCategorias=<?php echo $idParentCategoriasRaiz; ?>&idParentCategoriasRaiz=<?php echo $idParentCategoriasRaiz; ?>" class="Links04">
        	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemRoot"); ?>
        </a>
        <?php echo DbFuncoes::CategoriasCaminho($idTbCategorias, $idParentCategoriasRaiz, " - ", "Links04", "backend"); ?>
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
    
    
    <?php
	if (empty($resultadoForumTopicos))
	{
        //echo "Nenhum registro encontrado";
    ?>
        <div align="center" class="TextoErro">
            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
        </div>
    <?php
    }else{
    ?>

        <form name="formForumTopicosAcoes" id="formForumTopicosAcoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_forum_topicos" />
            <input name="idParent" id="idParent" type="hidden" value="<?php echo $idTbCategorias; ?>" />

            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            <input name="masterPageSelect" type="hidden" id="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
            <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            <div style="position:relative; display: block; clear: both;">
            	<?php if($GLOBALS['habilitarForumTopicosClassificacaoPersonalizada'] == 1){ ?>
                    <div align="left" style="float: left;">
                        <a href="ClassificacaoPersonalizadaExe.php?idRegistro=<?php echo $idParentForumTopicos; ?>&strTabela=tb_forum_topicos&strExcluir=1<?php echo $queryPadrao; ?><?php echo $queryPadraoRetornoPaginacao; ?>" class="Links03">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemClassificacaoPadrao"); ?>
                        </a>
                    </div>
                <?php } ?>
                <div align="right" style="float: right;">
                    <input type="image" name="submit" value="Submit" src="img/btoExcluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoExcluir"); ?>">
                </div>
            </div>
            <table width="100%" class="TabelaDados01">
              <tr class="TbFundoEscuro">
              	<?php if($GLOBALS['habilitarForumTopicosNClassificacao'] == 1){ ?>
                <td width="50" class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
						<?php if($GLOBALS['habilitarForumTopicosClassificacaoPersonalizada'] == 1){ ?>
                            <a href="ClassificacaoPersonalizadaExe.php?idRegistro=<?php echo $idParentForumTopicos; ?>&strTabela=tb_forum_topicos&criterioClassificacao=n_classificacao<?php echo $queryPadrao; ?><?php echo $queryPadraoRetornoPaginacao; ?>" class="Links02">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNClassificacaoA"); ?>
                            <a>
                         <?php }else{ ?>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNClassificacaoA"); ?>
                        <?php } ?>
                    </div>
                </td>
                <?php } ?>
                
                <td width="100" class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemData"); ?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div class="Texto02">
						<?php if($GLOBALS['habilitarForumTopicosClassificacaoPersonalizada'] == 1){ ?>
                            <a href="ClassificacaoPersonalizadaExe.php?idRegistro=<?php echo $idParentForumTopicos; ?>&strTabela=tb_forum_topicos&criterioClassificacao=processo<?php echo $queryPadrao; ?><?php echo $queryPadraoRetornoPaginacao; ?>" class="Links02">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaForumTopico"); ?>
                            <a>
                         <?php }else{ ?>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaForumTopico"); ?>
                        <?php } ?>
                    </div>
                </td>
                
                <td width="100" class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFuncoes"); ?>
                    </div>
                </td>
                
                <td width="30" class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao"); ?>
						<?php if($GLOBALS['habilitarForumTopicosClassificacaoPersonalizada'] == 1){ ?>
                            <a href="ClassificacaoPersonalizadaExe.php?idRegistro=<?php echo $idParentForumTopicos; ?>&strTabela=tb_forum_topicos&criterioClassificacao=ativacao<?php echo $queryPadrao; ?><?php echo $queryPadraoRetornoPaginacao; ?>" class="Links02">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao"); ?>
                            <a>
                         <?php }else{ ?>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao"); ?>
                        <?php } ?>
                    </div>
                </td>
                
                <?php if($GLOBALS['configForumTopicosAcesso'] == 1){ ?>
                <td width="50" class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAcesso"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <td width="30" class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                    </div>
                </td>
                
                <td width="30" class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemExcluir"); ?>
                    </div>
                </td>
              </tr>
              <?php
                //Loop pelos resultados.
                foreach($resultadoForumTopicos as $linhaForumTopicos)
                {
              ?>
              <tr class="TbFundoClaro">
              	<?php if($GLOBALS['habilitarForumTopicosNClassificacao'] == 1){ ?>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaForumTopicos['n_classificacao'];?>
                    </div>
                </td>
                <?php } ?>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php //echo $linhaForumTopicos['data_produto'];?>
                        <?php echo Funcoes::DataLeitura01($linhaForumTopicos['data_topico'], $GLOBALS['configSistemaFormatoData'], "2");?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaForumTopicos['topico']);?>
                    </div>
                    <?php if($GLOBALS['habilitarForumTopicosAssunto'] == 1){ ?>
                    <div class="Texto01">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaForumTopicosAssunto"); ?>: 
                        </strong>
                        <?php echo Funcoes::ConteudoMascaraLeitura($linhaForumTopicos['assunto']);?>
                    </div>
                    <?php } ?>
                    <div class="Texto01">
                    	<?php if($GLOBALS['habilitarForumTopicosFotos'] == 1){ ?>
                            [
                            <a href="ArquivosIndice.php?idParent=<?php echo $linhaForumTopicos['id'];?>&tipoArquivo=1&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaForumTopicos['topico']);?>&detalhe02=" target="_blank" class="Links01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserirFotos"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarForumTopicosVideos'] == 1){ ?>
                            [
                            <a href="ArquivosIndice.php?idParent=<?php echo $linhaForumTopicos['id'];?>&tipoArquivo=2&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaForumTopicos['topico']);?>&detalhe02=" target="_blank" class="Links01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserirVideos"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarForumTopicosArquivos'] == 1){ ?>
                            [
                            <a href="ArquivosIndice.php?idParent=<?php echo $linhaForumTopicos['id'];?>&tipoArquivo=3&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaForumTopicos['topico']);?>&detalhe02=" target="_blank" class="Links01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserirArquivos"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarForumTopicosZip'] == 1){ ?>
                            [
                            <a href="ArquivosIndice.php?idParent=<?php echo $linhaForumTopicos['id'];?>&tipoArquivo=4&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaForumTopicos['topico']);?>&detalhe02=" target="_blank" class="Links01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserirZip"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarForumTopicosSwfs'] == 1){ ?>
                            [
                            <a href="ArquivosIndice.php?idParent=<?php echo $linhaForumTopicos['id'];?>&tipoArquivo=5&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaForumTopicos['topico']);?>&detalhe02=" target="_blank" class="Links01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserirSWFs"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarForumTopicosConteudo'] == 1){ ?>
                            [
                            <a href="ConteudoIndice.php?idParentConteudo=<?php echo $linhaForumTopicos['id'];?>&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaForumTopicos['topico']);?>&detalhe02=" target="_blank" class="Links01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserirConteudo"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    </div>
                    
                    <div class="Texto01">
                        <?php if($linhaForumTopicos['id_tb_cadastro_usuario'] <> 0){ ?>
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaForumTopicosCadastroUsuario"); ?>:  
                            </strong>
                            <a href="CadastroAdministrar.php?idTbCadastro=<?php echo $linhaForumTopicos['id_tb_cadastro_usuario'];?>&masterPageSelect=LayoutSistemaSemMenu.php" target="_blank" class="Links01">
                                <?php //echo Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaTarefas['id_parent'], "tb_cadastro", "nome"); ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaForumTopicos['id_tb_cadastro_usuario'], "tb_cadastro", "nome"), 
                                DbFuncoes::GetCampoGenerico01($linhaForumTopicos['id_tb_cadastro_usuario'], "tb_cadastro", "razao_social"), 
                                DbFuncoes::GetCampoGenerico01($linhaForumTopicos['id_tb_cadastro_usuario'], "tb_cadastro", "nome_fantasia"), 
                                1)); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                    	<a href="../<?php echo $GLOBALS['visualizacaoAtivaSistema'];?>/SiteForumTopicosDetalhes.php?idTbForumTopicos=<?php echo $linhaForumTopicos['id'];?>" target="_blank" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemVisualizacao"); ?>
                        </a>
                    </div>
                    <div align="center" class="Texto01">
                    	<a href="ForumPostagensIndice.php?idTbForumTopicos=<?php echo $linhaForumTopicos['id'];?>" target="_blank" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaForumTopicosPostagegensAdministrar"); ?>
                        </a>
                    </div>
                </td>
                
                <td class="<?php if($linhaForumTopicos['ativacao'] == 1){/*echo "TbFundoClaro";*/}else{echo "TbFundoDesativado";}?> TabelaDados01Celula">
                    <div align="center" class="Texto01">
                    	<a href="RegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaForumTopicos['id'];?>&statusAtivacao=<?php echo $linhaForumTopicos['ativacao'];?>&strTabela=tb_forum_topicos&strCampo=ativacao<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="Links01">
                        	<?php if($linhaForumTopicos['ativacao'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao0"); ?>
                            <?php } ?>
                        	<?php if($linhaForumTopicos['ativacao'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao1"); ?>
                            <?php } ?>
                        </a>
						<?php //echo $linhaForumTopicos['ativacao'];?>
                    </div>
                </td>
                
                <?php if($GLOBALS['configForumTopicosAcesso'] == 1){ ?>
                <td class="<?php if($linhaForumTopicos['acesso_restrito'] == 0){/*echo "TbFundoClaro";*/}else{echo "TbFundoDesativado";}?> TabelaDados01Celula">
                    <div align="center" class="Texto01">
                    	<a href="RegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaForumTopicos['id'];?>&statusAtivacao=<?php echo $linhaForumTopicos['acesso_restrito'];?>&strTabela=tb_forum_topicos&strCampo=acesso_restrito<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="Links01">
                        	<?php if($linhaForumTopicos['acesso_restrito'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAcesso0"); ?>
                            <?php } ?>

                        	<?php if($linhaForumTopicos['acesso_restrito'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAcesso1"); ?>
                            <?php } ?>
                        </a>
                        <?php //echo $linhaForumTopicos['acesso_restrito'];?>
                    </div>
                </td>
                <?php } ?>

                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="ForumTopicosEditar.php?idTbForumTopicos=<?php echo $linhaForumTopicos['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaForumTopicos['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
	<?php } ?>
    
	<?php //Paginação. ?>
    <?php //************************************************************************************** ?>
    <?php if($GLOBALS['habilitarForumTopicosSistemaPaginacao'] == "1"){ ?>
		<?php if($paginacaoTotal > 1){ //Verifica se existe mais de uma página.?>
            <div align="center" class="Texto01">
                <div style="position: relative; display: inline; margin: 2px;">
                    <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=1<?php echo $queryPadrao; ?>" class="Links03">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemPaginacaoPrimeira"); ?>
                    </a>
                </div>
                
                <?php if($paginacaoNumero > 1){ ?>
                    <div style="position: relative; display: inline; margin: 2px;">
                        <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=<?php echo $paginacaoNumero - 1 ?><?php echo $queryPadrao; ?>" class="Links03">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemPaginacaoAnterior"); ?>
                        </a>
                    </div>
                <?php } ?>
                
                <?php //Numeração de páginas. ?>
                <?php if($GLOBALS['habilitarForumTopicosSitePaginacaoNumeracao'] == "1"){ ?>
                    <?php for($countPaginas = 1; $countPaginas <= $paginacaoTotal; $countPaginas++){ ?>
                        <div style="position: relative; display: inline; margin: 2px;">
                            <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=<?php echo $countPaginas; ?><?php echo $queryPadrao; ?>" class="Links03">
                                <?php echo $countPaginas; ?>
                            </a>
                        </div>
                    <?php } ?>
                <?php } ?>
                
                <?php if($paginacaoNumero <> $paginacaoTotal){ ?>
                    <div style="position: relative; display: inline; margin: 2px;">
                        <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=<?php echo $paginacaoNumero + 1 ?><?php echo $queryPadrao; ?>" class="Links03">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemPaginacaoProxima"); ?>
                        </a>
                    </div>
                <?php } ?>
                
                <div style="position: relative; display: inline; margin: 2px;">
                    <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=<?php echo $paginacaoTotal; ?><?php echo $queryPadrao; ?>" class="Links03">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemPaginacaoUltima"); ?>
                    </a>
                </div>
            </div>
            
            <?php //Contagem de páginas. ?>
            <div align="center" class="Texto01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPaginacaoPaginaContador01"); ?> 
                <?php echo $paginacaoNumero; ?> / <?php echo $paginacaoTotal; ?>
            </div>
        <?php } ?>
	<?php } ?>
	<?php //************************************************************************************** ?>
    
    
    <?php if(!empty($idTbCategorias)){ ?>
	<script type="text/javascript">
		$(document).ready(function () {
			
			/*
			$.validator.addMethod(
					"alphabetsOnly",
					function(value, element, regexp) {
						var re = new RegExp(regexp);
						return this.optional(element) || re.test(value);
					},
					"Please check your input values again!!!."
			);
			*/
			//Parâmetro personalizado.
			//**************************************************************************************
			jQuery.validator.addMethod("accept", function(value, element, param) {
				//return value.match(new RegExp("^" + param + "$"));
				return value.match(new RegExp(param));
			});	
			//**************************************************************************************

				
			//Validação de formulário (JQuery).
			//**************************************************************************************
			$('#formForumTopicos').validate({ //Inicialização do plug-in.
			
			
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
					}
				},
				
				
				//Mensagens.
				//----------------------
				messages: {
					//n_classificacao: "Please specify your name"//,
					n_classificacao: {
					  //required: "Campo obrigatório.",
					  required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica2"); ?>",
					  //regex: "Campo numérico."
					  //number: "Campo numérico."
					  number: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica1"); ?>"
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
    
    <form name="formForumTopicos" id="formForumTopicos" action="ForumTopicosIndiceExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <table class="TabelaCampos01">
            <tr>
                <td class="TbFundoEscuro" colspan="4">
                    <div align="center" class="Texto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaForumTopicosTbTopicos"); ?>
                        </strong>
                    </div>
                </td>
            </tr>

            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaForumTopico"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro"<?php if($GLOBALS['habilitarForumTopicosNClassificacao'] <> "1"){ ?> colspan="3"<?php } ?>>
                    <div align="left">
                        <input type="text" name="topico" id="topico" class="CampoTexto01" maxlength="255" />
                    </div>
                </td>
                <?php if($GLOBALS['habilitarForumTopicosNClassificacao'] == "1"){ ?>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNClassificacao"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaColuna01">
                    <div>
                        <input type="text" name="n_classificacao" id="n_classificacao" class="CampoNumerico01" maxlength="10" value="0" />
                    </div>
                </td>
                <?php } ?>
            </tr>

            <?php if($GLOBALS['habilitarForumTopicosAssunto'] == "1"){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaForumTopicosAssunto"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div>
                        <?php //Sem formatação.?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                            <textarea name="assunto" id="assunto" class="CampoTextoMultilinha01"></textarea>
                        <?php } ?>
                        
                        <?php //Formatação básica (CLEditor).?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                            
                            <script type="text/javascript">
                                //Caixa básica.
                                $(document).ready(function () {
                                    $("#descricao01").cleditor(
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
                            <textarea name="assunto" id="assunto"></textarea>
                        <?php } ?>
                        
                        <?php //Formatação avançada (CLEditor).?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                            <script type="text/javascript">
                                $(document).ready(function () {
                                    $("#descricao01").cleditor(
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
                            <textarea name="assunto" id="assunto"></textarea>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao3"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left" class="Texto01">
                        <select name="ativacao" id="ativacao" class="CampoDropDownMenu01">
                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao4"); ?></option>
                            <option value="1" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao5"); ?></option>
                        </select>
                    </div>
                </td>
            </tr>

        </table>

        <div>
            <div style="float:left;">
                <input type="image" name="submit" value="Submit" src="img/btoIncluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoIncluir"); ?>" />
                
                <input name="id_tb_categorias" type="hidden" id="id_tb_categorias" value="<?php echo $idTbCategorias; ?>" />
                <input name="acesso_restrito" type="hidden" id="acesso_restrito" value="0" />
                
                <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                <input name="masterPageSelect" type="hidden" id="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
            </div>
            <div style="float:right;">
                &nbsp;
            </div>
        </div>
    </form>
    <br />
	<?php } ?>
<?php 
$page->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php
//Limpeza de objetos.
//----------
unset($strSqlForumTopicosSelect);
unset($statementForumTopicosSelect);
unset($resultadoForumTopicos);
unset($linhaForumTopicos);
//----------


//Inclusão do template do layout.
include_once $page->LayoutSistema;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>