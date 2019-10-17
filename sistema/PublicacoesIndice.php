<?php
//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeLayout.php";


//Verificação de login Master.
LoginAutenticacao::UsuarioLoginVerificacao();


//Resgate de variáveis.
$idParentPublicacoes = $_GET["idParentPublicacoes"];
$tipoPublicacao = $_GET["tipoPublicacao"];

$idParentCategoriasRaiz = $_GET["idParentCategoriasRaiz"];
if($idParentCategoriasRaiz == "")
{
	$idParentCategoriasRaiz = 0;
}

//$dataPublicacaoOnLoad = date("Y") . "-" . date("m") . "-" . date("d");
$dataPublicacaoOnLoad = Funcoes::DataLeitura01(date("Y") . "-" . date("m") . "-" . date("d"), $GLOBALS['configSistemaFormatoData'], "1");

$palavraChave = $_GET["palavraChave"];

$paginaRetorno = "PublicacoesIndice.php";
$paginaRetornoExclusao = "PublicacoesEditar.php";
$variavelRetorno = "idParentPublicacoes";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];

//Paginação.
if($GLOBALS['habilitarPublicacoesSistemaPaginacao'] == "1"){
	$paginacaoNRegistros = $GLOBALS['configPublicacoesSistemaPaginacaoNRegistros'];
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
"&variavelRetorno=" . $variavelRetorno . 
"&palavraChave=" . $palavraChave;
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
	if($palavraChave <> "")
	{
		$strSqlPublicacoesSelect .= "AND (titulo LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		/*
		*/
		$strSqlPublicacoesSelect .= "OR conteudo_simples LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlPublicacoesSelect .= "OR informacao_complementar1 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlPublicacoesSelect .= "OR informacao_complementar2 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlPublicacoesSelect .= "OR informacao_complementar3 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlPublicacoesSelect .= "OR informacao_complementar4 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlPublicacoesSelect .= "OR informacao_complementar5 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlPublicacoesSelect .= "OR fonte LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlPublicacoesSelect .= "OR link_fonte LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlPublicacoesSelect .= "OR editoria LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlPublicacoesSelect .= "OR palavras_chave LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlPublicacoesSelect .= ") ";
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
if($palavraChave <> "")
{
	$strSqlPublicacoesSelect .= "AND (titulo LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	/*
	*/
	$strSqlPublicacoesSelect .= "OR conteudo_simples LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlPublicacoesSelect .= "OR informacao_complementar1 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlPublicacoesSelect .= "OR informacao_complementar2 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlPublicacoesSelect .= "OR informacao_complementar3 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlPublicacoesSelect .= "OR informacao_complementar4 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlPublicacoesSelect .= "OR informacao_complementar5 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlPublicacoesSelect .= "OR fonte LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlPublicacoesSelect .= "OR link_fonte LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlPublicacoesSelect .= "OR editoria LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlPublicacoesSelect .= "OR palavras_chave LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlPublicacoesSelect .= ") ";
}

//$strSqlPublicacoesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoPublicacoes'] . " ";
if($GLOBALS['habilitarPublicacoesClassificacaoPersonalizada'] == 1 and DbFuncoes::GetCampoGenerico04("classificacao", "criterio_classificacao", "id_registro", $idParentPublicacoes) <> "")
{
	$strSqlPublicacoesSelect .= "ORDER BY " . DbFuncoes::GetCampoGenerico04("classificacao", "criterio_classificacao", "id_registro", $idParentPublicacoes) . " ";
	
}else{
	$strSqlPublicacoesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoPublicacoes'] . " ";
}

//Paginação.
if($GLOBALS['habilitarPublicacoesSistemaPaginacao'] == "1"){ 
	if($configTipoDB == 2)
	{
		$strSqlPublicacoesSelect .= "LIMIT " . $paginacaoInicio . ", " . $paginacaoNRegistros . "";
	}
}
//----------


//Parâmetros.
//----------
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
//----------


//$resultadoPublicacoes = $dbSistemaConPDO->query($strSqlPublicacoesSelect);
$resultadoPublicacoes = $statementPublicacoesSelect->fetchAll();

//Paginação.
if($GLOBALS['habilitarPublicacoesSistemaPaginacao'] == "1"){
	$paginacaoTotalRegistros = $resultadoPublicacoes[0]['totalRegistros'];
	$paginacaoTotal = ceil($paginacaoTotalRegistros / $paginacaoNRegistros);
}


//Verificação de erro - debug.
//echo "strSqlPublicacoesSelect=" . $strSqlPublicacoesSelect . "<br />";
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
    	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPublicacoesTitulo"); ?> - 
        <a href="CategoriasIndice.php?idParentCategorias=<?php echo $idParentCategoriasRaiz; ?>&idParentCategoriasRaiz=<?php echo $idParentCategoriasRaiz; ?>" class="Links04">
        	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemRoot"); ?>
        </a>
        <?php echo DbFuncoes::CategoriasCaminho($idParentPublicacoes, $idParentCategoriasRaiz, " - ", "Links04", "backend"); ?>
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
	if (empty($resultadoPublicacoes))
	{
        //echo "Nenhum registro encontrado";
    ?>
        <div align="center" class="TextoErro">
            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
        </div>
    <?php
    }else{
    ?>

        <form name="formPublicacoesAcoes" id="formPublicacoesAcoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_publicacoes" />
            <input name="tipoPublicacao" id="tipoPublicacao" type="hidden" value="<?php echo $tipoPublicacao; ?>" />
            <input name="idParentPublicacoes" id="idParentPublicacoes" type="hidden" value="<?php echo $idParentPublicacoes; ?>" />

            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            <input name="masterPageSelect" type="hidden" id="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
            <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            <div style="position:relative; display: block; clear: both;">
            	<?php if($GLOBALS['habilitarPublicacoesClassificacaoPersonalizada'] == 1){ ?>
                    <div align="left" style="float: left;">
                        <a href="ClassificacaoPersonalizadaExe.php?idRegistro=<?php echo $idParentPublicacoes; ?>&strTabela=tb_publicacoes&strExcluir=1<?php echo $queryPadrao; ?><?php echo $queryPadraoRetornoPaginacao; ?>" class="Links03">
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
              	<?php if($GLOBALS['habilitarPublicacoesNClassificacao'] == 1){ ?>
                <td width="50" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
						<?php if($GLOBALS['habilitarPublicacoesClassificacaoPersonalizada'] == 1){ ?>
                            <a href="ClassificacaoPersonalizadaExe.php?idRegistro=<?php echo $idParentPublicacoes; ?>&strTabela=tb_publicacoes&criterioClassificacao=n_classificacao<?php echo $queryPadrao; ?><?php echo $queryPadraoRetornoPaginacao; ?>" class="Links02">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNClassificacaoA"); ?>
                            <a>
                         <?php }else{ ?>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNClassificacaoA"); ?>
                        <?php } ?>
                    </div>
                </td>
                <?php } ?>
                
                <td width="100" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
						<?php if($GLOBALS['habilitarPublicacoesClassificacaoPersonalizada'] == 1){ ?>
                            <a href="ClassificacaoPersonalizadaExe.php?idRegistro=<?php echo $idParentPublicacoes; ?>&strTabela=tb_publicacoes&criterioClassificacao=data_publicacao desc, id desc<?php echo $queryPadrao; ?><?php echo $queryPadraoRetornoPaginacao; ?>" class="Links02">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemData"); ?>
                            <a>
                         <?php }else{ ?>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemData"); ?>
                        <?php } ?>
                    </div>
                </td>
                
              	<?php if($GLOBALS['habilitarPublicacoesVisualizacaoImagens'] == 1){ ?>
                <td width="1" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemImagem"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <td class="TabelaDados01Celula">
                    <div class="Texto02">
						<?php if($GLOBALS['habilitarPublicacoesClassificacaoPersonalizada'] == 1){ ?>
                            <a href="ClassificacaoPersonalizadaExe.php?idRegistro=<?php echo $idParentPublicacoes; ?>&strTabela=tb_publicacoes&criterioClassificacao=titulo<?php echo $queryPadrao; ?><?php echo $queryPadraoRetornoPaginacao; ?>" class="Links02">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPublicacoes"); ?>
                            <a>
                         <?php }else{ ?>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPublicacoes"); ?>
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
						<?php if($GLOBALS['habilitarPublicacoesClassificacaoPersonalizada'] == 1){ ?>
                            <a href="ClassificacaoPersonalizadaExe.php?idRegistro=<?php echo $idParentPublicacoes; ?>&strTabela=tb_publicacoes&criterioClassificacao=ativacao<?php echo $queryPadrao; ?><?php echo $queryPadraoRetornoPaginacao; ?>" class="Links02">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao"); ?>
                            <a>
                         <?php }else{ ?>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao"); ?>
                        <?php } ?>
                    </div>
                </td>
                
                <?php if($GLOBALS['habilitarPublicacoesAtivacaoHome'] == 1){ ?>
                <td width="30" class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao"); ?>
						<?php if($GLOBALS['habilitarPublicacoesClassificacaoPersonalizada'] == 1){ ?>
                            <a href="ClassificacaoPersonalizadaExe.php?idRegistro=<?php echo $idParentPublicacoes; ?>&strTabela=tb_publicacoes&criterioClassificacao=ativacao_home<?php echo $queryPadrao; ?><?php echo $queryPadraoRetornoPaginacao; ?>" class="Links02">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPublicacoesAtivacaoHome"); ?>
                            <a>
                         <?php }else{ ?>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPublicacoesAtivacaoHome"); ?>
                        <?php } ?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarPublicacoesAtivacaoHomeCategoria'] == 1){ ?>
                <td width="30" class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao"); ?>
						<?php if($GLOBALS['habilitarPublicacoesClassificacaoPersonalizada'] == 1){ ?>
                            <a href="ClassificacaoPersonalizadaExe.php?idRegistro=<?php echo $idParentPublicacoes; ?>&strTabela=tb_publicacoes&criterioClassificacao=ativacao_home_categoria<?php echo $queryPadrao; ?><?php echo $queryPadraoRetornoPaginacao; ?>" class="Links02">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPublicacoesAtivacaoHomeCategoria"); ?>
                            <a>
                         <?php }else{ ?>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPublicacoesAtivacaoHomeCategoria"); ?>
                        <?php } ?>
                    </div>
                </td>
                <?php } ?>

                <?php if($GLOBALS['habilitarPublicacoesAcessoRestrito'] == 1){ ?>
                <td width="50" class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAcesso"); ?>
                    </div>
                </td>
                <?php } ?>
                                
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
                foreach($resultadoPublicacoes as $linhaPublicacoes)
                {
              ?>
              <tr class="TbFundoClaro">
              	<?php if($GLOBALS['habilitarPublicacoesNClassificacao'] == 1){ ?>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaPublicacoes['n_classificacao'];?>
                    </div>
                </td>
                <?php } ?>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaPublicacoes['data_publicacao'];?>
                        <?php //Funcoes::DataLeitura01($linhaPublicacoes['data_publicacao'], $GLOBALS['configSistemaFormatoData'], "1");?>
                    </div>
                </td>
                
              	<?php if($GLOBALS['habilitarPublicacoesVisualizacaoImagens'] == 1){ ?>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
						<?php if(!empty($linhaPublicacoes['imagem'])){ ?>
							<?php //Sem pop-up. ?>
                            <?php if($GLOBALS['configImagemPopUp'] == 0){ ?>
                                <img src="<?php echo $GLOBALS['configDiretorioArquivos'];?>/t<?php echo $linhaPublicacoes['imagem'];?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaPublicacoes['titulo']); ?>" />
                            <?php } ?>
                        
                            <?php //SlimBox 2 - JQuery. ?>
                            <?php if($GLOBALS['configImagemPopUp'] == 1){ ?>
                                <a href="<?php echo $GLOBALS['configDiretorioArquivos'];?>/g<?php echo $linhaPublicacoes['imagem'];?>" rel="lightbox" title="">
                                    <img src="<?php echo $GLOBALS['configDiretorioArquivos'];?>/t<?php echo $linhaPublicacoes['imagem'];?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaPublicacoes['titulo']); ?>" />
                                </a>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
                <?php } ?>
                
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaPublicacoes['titulo']);?>
                    </div>
                    
                    <?php if($GLOBALS['habilitarPublicacoesConteudoSimples'] == 1){ ?>
                    	<?php if(!empty($linhaPublicacoes['conteudo_simples'])){ ?>
                            <div class="Texto01">
                                <strong>
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPublicacoesConteudoSimples"); ?>:
                                </strong>
                                <br />
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaPublicacoes['conteudo_simples']);?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    
                    <?php if($GLOBALS['habilitarPublicacoesIc1'] == 1){ ?>
                    	<?php if(!empty($linhaPublicacoes['informacao_complementar1'])){ ?>
                            <div class="Texto01">
                                <strong>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPublicacoesTituloIc1'], "IncludeConfig"); ?>:
                                </strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaPublicacoes['informacao_complementar1']);?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    <?php if($GLOBALS['habilitarPublicacoesIc2'] == 1){ ?>
                    	<?php if(!empty($linhaPublicacoes['informacao_complementar2'])){ ?>
                            <div class="Texto01">
                                <strong>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPublicacoesTituloIc2'], "IncludeConfig"); ?>:
                                </strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaPublicacoes['informacao_complementar2']);?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    <?php if($GLOBALS['habilitarPublicacoesIc3'] == 1){ ?>
                    	<?php if(!empty($linhaPublicacoes['informacao_complementar3'])){ ?>
                            <div class="Texto01">
                                <strong>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPublicacoesTituloIc3'], "IncludeConfig"); ?>:
                                </strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaPublicacoes['informacao_complementar3']);?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    <?php if($GLOBALS['habilitarPublicacoesIc4'] == 1){ ?>
                    	<?php if(!empty($linhaPublicacoes['informacao_complementar4'])){ ?>
                            <div class="Texto01">
                                <strong>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPublicacoesTituloIc4'], "IncludeConfig"); ?>:
                                </strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaPublicacoes['informacao_complementar4']);?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    <?php if($GLOBALS['habilitarPublicacoesIc5'] == 1){ ?>
                    	<?php if(!empty($linhaPublicacoes['informacao_complementar5'])){ ?>
                            <div class="Texto01">
                                <strong>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPublicacoesTituloIc5'], "IncludeConfig"); ?>:
                                </strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaPublicacoes['informacao_complementar5']);?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    
                    <div class="Texto01">
                    	<?php if($GLOBALS['habilitarPublicacoesConteudo'] == 1){ ?>
                            [
                            <a href="ConteudoIndice.php?idParentConteudo=<?php echo $linhaPublicacoes['id'];?>&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaPublicacoes['titulo']);?>&detalhe02=" target="_blank" class="Links01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserirConteudo"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarPublicacoesFotos'] == 1){ ?>
                            [
                            <a href="ArquivosIndice.php?idParent=<?php echo $linhaPublicacoes['id'];?>&tipoArquivo=1&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaPublicacoes['titulo']);?>&detalhe02=" target="_blank" class="Links01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserirFotos"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarPublicacoesVideos'] == 1){ ?>
                            [
                            <a href="ArquivosIndice.php?idParent=<?php echo $linhaPublicacoes['id'];?>&tipoArquivo=2&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaPublicacoes['titulo']);?>&detalhe02=" target="_blank" class="Links01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserirVideos"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarPublicacoesArquivos'] == 1){ ?>
                            [
                            <a href="ArquivosIndice.php?idParent=<?php echo $linhaPublicacoes['id'];?>&tipoArquivo=3&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaPublicacoes['titulo']);?>&detalhe02=" target="_blank" class="Links01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserirArquivos"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarPublicacoesZip'] == 1){ ?>
                            [
                            <a href="ArquivosIndice.php?idParent=<?php echo $linhaPublicacoes['id'];?>&tipoArquivo=4&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaPublicacoes['titulo']);?>&detalhe02=" target="_blank" class="Links01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserirZip"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarPublicacoesSwfs'] == 1){ ?>
                            [
                            <a href="ArquivosIndice.php?idParent=<?php echo $linhaPublicacoes['id'];?>&tipoArquivo=5&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaPublicacoes['titulo']);?>&detalhe02=" target="_blank" class="Links01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserirSWFs"); ?>
                            </a>
                            ] 
                        <?php } ?>
                        
                    	<?php if($GLOBALS['habilitarPublicacoesProcessos'] == 1){ ?>
                            [
                            <a href="ProcessosIndice.php?idParentProcessos=<?php echo $linhaPublicacoes['id'];?>&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaPublicacoes['titulo']);?>&detalhe02=" target="_blank" class="Links01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserirProcessos"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                    	<a href="../<?php echo $GLOBALS['visualizacaoAtivaSistema'];?>/SitePublicacoesDetalhes.php?idTbPublicacoes=<?php echo $linhaPublicacoes['id'];?>" target="_blank" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemVisualizacao"); ?>
                        </a>
                    </div>
                </td>
                
                <td class="<?php if($linhaPublicacoes['ativacao'] == 1){/*echo "TbFundoClaro";*/}else{echo "TbFundoDesativado";}?> TabelaDados01Celula">
                    <div align="center" class="Texto01">
                    	<a href="RegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaPublicacoes['id'];?>&statusAtivacao=<?php echo $linhaPublicacoes['ativacao'];?>&strTabela=tb_publicacoes&strCampo=ativacao<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="Links01">
                        	<?php if($linhaPublicacoes['ativacao'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao0"); ?>
                            <?php } ?>
                        	<?php if($linhaPublicacoes['ativacao'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao1"); ?>
                            <?php } ?>
                        </a>
						<?php //echo $linhaPublicacoes['ativacao'];?>
                    </div>
                </td>
                
                <?php if($GLOBALS['habilitarPublicacoesAtivacaoHome'] == 1){ ?>
                <td class="<?php if($linhaPublicacoes['ativacao_home'] == 1){/*echo "TbFundoClaro";*/}else{echo "TbFundoDesativado";}?> TabelaDados01Celula">
                    <div align="center" class="Texto01">
                    	<a href="RegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaPublicacoes['id'];?>&statusAtivacao=<?php echo $linhaPublicacoes['ativacao_home'];?>&strTabela=tb_publicacoes&strCampo=ativacao_home<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="Links01">
                        	<?php if($linhaPublicacoes['ativacao_home'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao0"); ?>
                            <?php } ?>
                        	<?php if($linhaPublicacoes['ativacao_home'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao1"); ?>
                            <?php } ?>
                        </a>
						<?php //echo $linhaPublicacoes['ativacao'];?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarPublicacoesAtivacaoHomeCategoria'] == 1){ ?>
                <td class="<?php if($linhaPublicacoes['ativacao_home_categoria'] == 1){/*echo "TbFundoClaro";*/}else{echo "TbFundoDesativado";}?> TabelaDados01Celula">
                    <div align="center" class="Texto01">
                    	<a href="RegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaPublicacoes['id'];?>&statusAtivacao=<?php echo $linhaPublicacoes['ativacao_home_categoria'];?>&strTabela=tb_publicacoes&strCampo=ativacao_home_categoria<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="Links01">
                        	<?php if($linhaPublicacoes['ativacao_home_categoria'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao0"); ?>
                            <?php } ?>
                        	<?php if($linhaPublicacoes['ativacao_home_categoria'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao1"); ?>
                            <?php } ?>
                        </a>
						<?php //echo $linhaPublicacoes['ativacao'];?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarPublicacoesAcessoRestrito'] == 1){ ?>
                <td class="<?php if($linhaPublicacoes['acesso_restrito'] == 0){/*echo "TbFundoClaro";*/}else{echo "TbFundoDesativado";}?> TabelaDados01Celula">
                    <div align="center" class="Texto01">
                    	<a href="RegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaPublicacoes['id'];?>&statusAtivacao=<?php echo $linhaPublicacoes['acesso_restrito'];?>&strTabela=tb_publicacoes&strCampo=acesso_restrito<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="Links01">
                        	<?php if($linhaPublicacoes['acesso_restrito'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAcesso0"); ?>
                            <?php } ?>
                        	<?php if($linhaPublicacoes['acesso_restrito'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAcesso1"); ?>
                            <?php } ?>
                        </a>
                        <?php //echo $linhaPublicacoes['acesso_restrito'];?>
                    </div>
                </td>
                <?php } ?>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="PublicacoesEditar.php?idTbPublicacoes=<?php echo $linhaPublicacoes['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaPublicacoes['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
	<?php } ?>
    
	<?php //Paginação. ?>
    <?php //************************************************************************************** ?>
    <?php if($GLOBALS['habilitarPublicacoesSistemaPaginacao'] == "1"){ ?>
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
                <?php if($GLOBALS['habilitarPublicacoesSistemaPaginacaoNumeracao'] == "1"){ ?>
                    <?php for($countPublicacoes = 1; $countPublicacoes <= $paginacaoTotal; $countPublicacoes++){ ?>
                        <div style="position: relative; display: inline; margin: 2px;">
                            <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=<?php echo $countPublicacoes; ?><?php echo $queryPadrao; ?>" class="Links03">
                                <?php echo $countPublicacoes; ?>
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


    <form name="formPublicacoes" id="formPublicacoes" action="PublicacoesIndiceExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <table class="TabelaCampos01">
            <tr>
                <td class="TbFundoEscuro" colspan="4">
                    <div align="center" class="Texto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPublicacoesTbPublicacoes"); ?>
                        </strong>
                    </div>
                </td>
            </tr>
            
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPublicacoesData"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left">
						<script type="text/javascript">
                            //Variável para conter todos os campos que funcionam com o DatePicker.
                            //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                            var strDatapickerAgendaPtCampos = "";
							var strDatapickerAgendaEnCampos = "";
                        </script>
                    	<?php //JQuery DatePicker. ?>
                    	<?php //---------------------- ?>
						<?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                        	<?php if($GLOBALS['configSistemaFormatoData'] == 1){ ?>
								<script type="text/javascript">
                                    //Variável para conter todos os campos que funcionam com o DatePicker.
                                    //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                    //var strDatapickerAgendaPtCampos = "#data_abertura";
                                    strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data_publicacao;";
                                </script>
                            <?php } ?>
                            <?php if($GLOBALS['configSistemaFormatoData'] == 2){ ?>
								<script type="text/javascript">
                                    //Variável para conter todos os campos que funcionam com o DatePicker.
                                    //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                    //var strDatapickerAgendaEnCampos = "#data_abertura";
                                    strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data_publicacao;";
                                </script>
                            <?php } ?>
                            <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                        
                            <input type="text" name="data_publicacao" id="data_publicacao" class="CampoData01" maxlength="10" value="<?php echo $dataPublicacaoOnLoad; ?>" />
                            <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                        <?php } ?>
                    	<?php //---------------------- ?>
                    </div>
                </td>
            </tr>
            
            <?php if($GLOBALS['ativacaoPublicacoesDataFinal'] == 2){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPublicacoesDataFinal"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left">
						<script type="text/javascript">
                            //Variável para conter todos os campos que funcionam com o DatePicker.
                            //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                            //var strDatapickerAgendaPtCampos = "";
                        </script>
                    	<?php //JQuery DatePicker. ?>
                    	<?php //---------------------- ?>
						<?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                        	<?php if($GLOBALS['configSistemaFormatoData'] == 1){ ?>
								<script type="text/javascript">
                                    //Variável para conter todos os campos que funcionam com o DatePicker.
                                    //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                    //var strDatapickerAgendaPtCampos = "#data_abertura";
                                    strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data_final_publicacao;";
                                </script>
                            <?php } ?>
                            <?php if($GLOBALS['configSistemaFormatoData'] == 2){ ?>
								<script type="text/javascript">
                                    //Variável para conter todos os campos que funcionam com o DatePicker.
                                    //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                    //var strDatapickerAgendaEnCampos = "#data_abertura";
                                    strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data_final_publicacao;";
                                </script>
                            <?php } ?>
                            <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                        
                            <input type="text" name="data_final_publicacao" id="data_final_publicacao" class="CampoData01" maxlength="10" />
                            <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                        <?php } ?>
                    	<?php //---------------------- ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPublicacoes"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula"<?php if($GLOBALS['habilitarPublicacoesNClassificacao'] <> "1"){ ?> colspan="3"<?php } ?>>
                    <div align="left">
                        <input type="text" name="titulo" id="titulo" class="CampoTexto01" maxlength="255" />
                    </div>
                </td>
				<?php if($GLOBALS['habilitarPublicacoesNClassificacao'] == 1){ ?>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNClassificacao"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaColuna01 TabelaCampos01Celula">
                    <div>
                        <input type="text" name="n_classificacao" id="n_classificacao" class="CampoNumerico01" maxlength="10" value="0" />
                    </div>
                </td>
                <?php } ?>
            </tr>
            
            <?php if($GLOBALS['habilitarPublicacoesConteudoSimples'] == 2){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPublicacoesConteudoSimples"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div>
                        <?php //Sem formatação.?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                            <textarea name="conteudo_simples" id="conteudo_simples" class="CampoTextoMultilinha01"></textarea>
                        <?php } ?>
                        
                        <?php //Formatação básica (CLEditor).?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                            
                            <script type="text/javascript">
                                //Caixa básica.
                                $(document).ready(function () {
                                    $("#conteudo_simples").cleditor(
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
                            <textarea name="conteudo_simples" id="conteudo_simples"></textarea>
                        <?php } ?>
                        
                        <?php //Formatação avançada (CLEditor).?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                            <script type="text/javascript">
                                $(document).ready(function () {
                                    $("#conteudo_simples").cleditor(
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
                            <textarea name="conteudo_simples" id="conteudo_simples"></textarea>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarPublicacoesIc1'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPublicacoesTituloIc1'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configPublicacoesBoxIc1'] == 1){ ?>
                            <input type="text" name="informacao_complementar1" id="informacao_complementar1" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configPublicacoesBoxIc1'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar1" id="informacao_complementar1" class="CampoTextoMultilinha01"></textarea>
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
            
            <?php if($GLOBALS['habilitarPublicacoesIc2'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPublicacoesTituloIc2'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configPublicacoesBoxIc2'] == 1){ ?>
                            <input type="text" name="informacao_complementar2" id="informacao_complementar2" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configPublicacoesBoxIc2'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar2" id="informacao_complementar2" class="CampoTextoMultilinha01"></textarea>
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
        
            <?php if($GLOBALS['habilitarPublicacoesIc3'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPublicacoesTituloIc3'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configPublicacoesBoxIc3'] == 1){ ?>
                            <input type="text" name="informacao_complementar3" id="informacao_complementar3" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configPublicacoesBoxIc3'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar3" id="informacao_complementar3" class="CampoTextoMultilinha01"></textarea>
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
        
            <?php if($GLOBALS['habilitarPublicacoesIc4'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPublicacoesTituloIc4'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configPublicacoesBoxIc4'] == 1){ ?>
                            <input type="text" name="informacao_complementar4" id="informacao_complementar4" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configPublicacoesBoxIc4'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar4" id="informacao_complementar4" class="CampoTextoMultilinha01"></textarea>
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
        
            <?php if($GLOBALS['habilitarPublicacoesIc5'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPublicacoesTituloIc5'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configPublicacoesBoxIc5'] == 1){ ?>
                            <input type="text" name="informacao_complementar5" id="informacao_complementar5" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configPublicacoesBoxIc5'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar5" id="informacao_complementar5" class="CampoTextoMultilinha01"></textarea>
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
            
            <?php if($GLOBALS['ativacaoPublicacoesFonte'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPublicacoesFonte"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left" class="Texto01">
                    	<input type="text" name="fonte" id="fonte" class="CampoTexto01" maxlength="255" />
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['ativacaoPublicacoesFonteLink'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPublicacoesFonteLink"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left" class="Texto01">
                    	<input type="text" name="link_fonte" id="link_fonte" class="CampoTexto01" maxlength="255" />
                        <br />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemURL02"); ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['ativacaoPublicacoesEditoria'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPublicacoesEditoria"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left" class="Texto01">
                    	<input type="text" name="editoria" id="editoria" class="CampoTexto01" maxlength="255" />
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarPublicacoesPalavrasChave'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemPalavrasChave01"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left" class="Texto01">
                        <textarea name="palavras_chave" id="palavras_chave" class="CampoTextoMultilinha01"></textarea>
                        <br />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemPalavrasChave02"); ?>
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
                        
			<?php if($GLOBALS['ativacaoPublicacoesImagens'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemImagem"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <input type="file" name="ArquivoUpload1" id="ArquivoUpload1" class="CampoArquivoUpload01">
                    </div>
                </td>
            </tr>
            <?php } ?>
        </table>
         
        <div>
            <div style="float:left;">
                <input type="image" name="submit" value="Submit" src="img/btoIncluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoIncluir"); ?>" />
                
                <input name="id_tb_categorias" type="hidden" id="id_tb_categorias" value="<?php echo $idParentPublicacoes; ?>" />
                <input name="tipo_publicacao" type="hidden" id="tipo_publicacao" value="<?php echo $tipoPublicacao; ?>" />
                <input name="ativacao_home" type="hidden" id="ativacao_home" value="0" />
                <input name="ativacao_home_categoria" type="hidden" id="ativacao_home_categoria" value="0" />
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
<?php 
$page->cphConteudoPrincipal = ob_get_clean(); 
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
?>


<?php 
//Inclusão do template do layout.
include_once $page->LayoutSistema;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>