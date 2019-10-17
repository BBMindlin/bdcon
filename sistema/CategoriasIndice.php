<?php
//$page->title    = "Hello, world";
//$page->LayoutSistema = "LayoutSistemaComMenu.php";


//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
//require_once "IncludeUsuarioVerificacao.php";
require_once "IncludeLayout.php";


//Verificação de login Master.
LoginAutenticacao::UsuarioLoginVerificacao();


//Verificação de login Master.
$idParentCategorias = $_GET["idParentCategorias"];
$idParentCategoriasRaiz = $_GET["idParentCategoriasRaiz"];
if($idParentCategoriasRaiz == "")
{
	$idParentCategoriasRaiz = 0;
}

$idTbCadastroUsuario = $_GET["idTbCadastroUsuario"];
if($idTbCadastroUsuario == "")
{
	$idTbCadastroUsuario = 0;
}

$palavraChave = $_GET["palavraChave"];

$paginaRetorno = "CategoriasIndice.php";
$variavelRetorno = "idParentCategorias";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];

//Paginação.
if($GLOBALS['habilitarCategoriasSistemaPaginacao'] == "1"){
	$paginacaoNRegistros = $GLOBALS['configCategoriasSistemaPaginacaoNRegistros'];
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
$queryPadrao = "&idParentCategorias=" . $idParentCategorias . 
"&idTbCadastroUsuario=" . $idTbCadastroUsuario . 
"&paginaRetorno=" . $paginaRetorno . 
"&variavelRetorno=" . $variavelRetorno . 
"&palavraChave=" . $palavraChave;
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
if($GLOBALS['habilitarCategoriasSistemaPaginacao'] == "1"){
	$strSqlCategoriasSelect .= ", (SELECT COUNT(id) ";
	$strSqlCategoriasSelect .= "FROM tb_categorias ";
	$strSqlCategoriasSelect .= "WHERE id <> 0 ";
	//if(!empty($idParentCategorias)) //0 está retornando empty (talvez - verificar)
	if($idParentCategorias <> "")
	{
		$strSqlCategoriasSelect .= "AND id_parent = :id_parent ";
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

//if(!empty($idParentCategorias)) //0 está retornando empty (talvez - verificar)
if($idParentCategorias <> "")
{
	$strSqlCategoriasSelect .= "AND id_parent = :id_parent ";
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

if($GLOBALS['habilitarCategoriasClassificacaoPersonalizada'] == 1 and DbFuncoes::GetCampoGenerico04("classificacao", "criterio_classificacao", "id_registro", $idParentCategorias) <> "")
{
	$strSqlCategoriasSelect .= "ORDER BY " . DbFuncoes::GetCampoGenerico04("classificacao", "criterio_classificacao", "id_registro", $idParentCategorias) . " ";
	
}else{
	$strSqlCategoriasSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCategorias'] . " ";
}

//Paginação.
if($GLOBALS['habilitarCategoriasSistemaPaginacao'] == "1"){ 
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


//Componentes e parâmetros.
//----------
$statementCategoriasSelect = $dbSistemaConPDO->prepare($strSqlCategoriasSelect);

if ($statementCategoriasSelect !== false)
{
	if($idParentCategorias <> "")
	{
		$statementCategoriasSelect->bindParam(':id_parent', $idParentCategorias, PDO::PARAM_STR);
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
if($GLOBALS['habilitarCategoriasSistemaPaginacao'] == "1"){
	//$paginacaoTotalRegistros = DbFuncoes::CountRegistrosGenericos("tb_cadastro", "id_tb_categorias", $idParentCadastro); //Quantidade de registros.
	//$paginacaoTotalRegistros = DbFuncoes::CountRegistrosGenericos("tb_cadastro", "id_tb_categorias", $idParentCadastro, "", "", "", "", "", ""); //Quantidade de registros.
	$paginacaoTotalRegistros = $resultadoCategorias[0]['totalRegistros'];
	$paginacaoTotal = ceil($paginacaoTotalRegistros / $paginacaoNRegistros);
}

/*
if(!isset($linhaCategorias['id'])){
	echo "Nenhum registro encontrado";
}else{
	echo "id=" . $linhaCategorias['id'] . "<br />";
}
*/

//Verificação de erro - debug.
//echo "strSqlCategoriasSelect=" . $strSqlCategoriasSelect . "<br />";
//echo "idParentCategorias=" . $idParentCategorias . "<br />";
//echo "ContadorUniversalUpdate(idContador)=" . ContadorUniversalUpdate(3) . "<br/>";
//echo "ContadorUniversalUpdate(idContador)=" . ContadorUniversalUpdate(1) . "<br/>";
//echo "ContadorUniversal::ContadorUniversalUpdate(1)=" . ContadorUniversal::ContadorUniversalUpdate(1) . "<br/>";
//echo "arrImagemPadrao(globals)=" . $GLOBALS['arrImagemPadrao'][0] . "<br>";
//echo "arrImagemPadrao[0]=" . $arrImagemPadrao[0] . "<br>";
//$arrImagemPadraoParametros = explode(";", $arrImagemPadrao[0]);
//echo "arrImagemPadraoParametros[0]=" . $arrImagemPadraoParametros[0] . "<br>";
//echo "arrImagemPadraoParametros[1]=" . $arrImagemPadraoParametros[1] . "<br>";
//echo "arrImagemPadraoParametros[2]=" . $arrImagemPadraoParametros[2] . "<br>";

//echo "DbFuncoes::GetCampoGenerico01=" . DbFuncoes::GetCampoGenerico01("3758", "tb_categorias", "imagem") . "<br>";

//echo "DbFuncoes::CountRegistrosGenericos=" . DbFuncoes::CountRegistrosGenericos("tb_categorias", "id_parent", "1200") . "<br>";
//echo "DbFuncoes::GetCampoGenerico04=" . DbFuncoes::GetCampoGenerico04("classificacao", "criterio_classificacao", "id_registro", $idParentCategorias, "", "", 1) . "<br>";
//echo "DbFuncoes::GetCampoGenerico04=" . DbFuncoes::GetCampoGenerico04("classificacao", "criterio_classificacao", "id_registro", $idParentCategorias) . "<br>";


//echo "RegistroGenericoVerificar=" . RegistroGenericoVerificar("1200") . "<br>";
//echo "RegistroGenericoVerificar=" . RegistroGenericoVerificar("35") . "<br>";
//echo "RegistroGenericoVerificar=" . RegistroGenericoVerificar("3782") . "<br>";
//echo "RegistroGenericoVerificar=" . RegistroGenericoVerificar("50") . "<br>";

/*if(DbFuncoes::RegistroGenericoVerificar("tb_categorias", "id", "3782") == true)
{
	echo "RegistroGenericoVerificar = true";
}else{
	echo "RegistroGenericoVerificar = false";
}
*/


//Interação do array.
//----------
/*
$countArrImagem = 0;
foreach ($arrImagemPadrao as $valorArrImagemPadrao)
{
    //echo "\$a[$i] => $v.\n";
    echo $arrImagemPadrao[$countArrImagem] . "=" . $valorArrImagemPadrao . "<br>";
    $countArrImagem++;
}
*/

/*
for ($countArrImagem = 0; $countArrImagem < count($arrImagemPadrao); ++$countArrImagem) 
{
    echo $arrImagemPadrao[$countArrImagem] . "<br>";
	$arrImagemPadraoParametros = explode(";", $arrImagemPadrao[$countArrImagem]);
	echo "prefixo=" . $arrImagemPadraoParametros[0] . "<br>";
	echo "width=" . $arrImagemPadraoParametros[1] . "<br>";
	echo "height=" . $arrImagemPadraoParametros[2] . "<br>";
}

echo "NOVO LOOP" . "<br><br><br>";

$arrImagemTamanhos = $GLOBALS['arrImagemPadrao'];
for ($countArrImagem = 0; $countArrImagem < count($arrImagemTamanhos); ++$countArrImagem) 
{
    echo $arrImagemTamanhos[$countArrImagem] . "<br>";
	$arrImagemParametros = explode(";", $arrImagemTamanhos[$countArrImagem]);
	echo "prefixo=" . $arrImagemParametros[0] . "<br>";
	echo "width=" . $arrImagemParametros[1] . "<br>";
	echo "height=" . $arrImagemParametros[2] . "<br>";
}

//----------
*/

//echo "DOCUMENT_ROOT=" . $_SERVER['DOCUMENT_ROOT'] . "<br>";
//echo "getcwd()=" . getcwd() . "<br>";
//echo "caminho completo=" . $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos'] . "<br>";

//$verificar = ".pdf";
//echo "configImagensFormatos=" . $GLOBALS['configImagensFormatos'];

//if (strpos($GLOBALS['configImagensFormatos'], $verificar) !== false) {
//    echo 'está dentro da string';
//}else{
//	
//}


//echo "GLOBALS['arrTipoCategoriaConfig'][0]=" . $GLOBALS['arrTipoCategoriaConfig'][1] . "<br>";

//echo "GLOBALS['arrTipoCategoriaConfigNome'][0] = " . $GLOBALS['arrTipoCategoriaConfigNome'][0] . "<br>";


//echo "::XMLIdiomas = " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemCategoriaVinculada") . "<br>";

?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configNomeCliente'], "IncludeConfig"); ?>
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
    	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaMenuHome"); ?> - 
        <a href="CategoriasIndice.php?idParentCategorias=<?php echo $idParentCategoriasRaiz; ?>&idParentCategoriasRaiz=<?php echo $idParentCategoriasRaiz; ?>" class="Links04">
        	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemRoot"); ?>
        </a>
        <?php echo DbFuncoes::CategoriasCaminho($idParentCategorias, $idParentCategoriasRaiz, " - ", "Links04", "backend"); ?>
    </div>
<?php 
$page->cphConteudoCabecalho = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Conteúdo principal.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphConteudoPrincipal*/ ?>
    <div align="center" class="TextoErro">
        <?php echo $mensagemErro;?>
    </div>
    <div align="center" class="TextoSucesso">
        <?php echo $mensagemSucesso;?>
    </div>
    
    <?php
    //if(mysqli_num_rows($resultadoCategorias) == 0){ //Verificação se está vazio.
	//if ($resultadoCategorias->fetchColumn() == 0) //Verificação se está vazio.
	if (empty($resultadoCategorias))
	{
        //echo "Nenhum registro encontrado";
    ?>
        <div align="center" class="TextoErro">
            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
        </div>
    <?php
    }else{
    ?>
        <form name="formCategoriasAcoes" id="formCategoriasAcoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_categorias" />
            <input name="idParentCategorias" id="idParentCategorias" type="hidden" value="<?php echo $idParentCategorias; ?>" />
            <input name="idTbCadastroUsuario" type="hidden" id="idTbCadastroUsuario" value="<?php echo $idTbCadastroUsuario; ?>" />
            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            
            <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            <div style="position:relative; display: block; clear: both;">
            	<?php if($GLOBALS['habilitarCategoriasClassificacaoPersonalizada'] == 1){ ?>
                    <div align="left" style="float: left;">
                        <a href="ClassificacaoPersonalizadaExe.php?idRegistro=<?php echo $idParentCategorias; ?>&strTabela=tb_categorias&strExcluir=1<?php echo $queryPadrao; ?><?php echo $queryPadraoRetornoPaginacao; ?>" class="Links03">
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
              	<?php if($GLOBALS['habilitarCategoriasNClassificacao'] == 1){ ?>
                <td width="50" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
						<?php if($GLOBALS['habilitarCategoriasClassificacaoPersonalizada'] == 1){ ?>
                            <a href="ClassificacaoPersonalizadaExe.php?strExcluir=1&idRegistro=<?php echo $idParentCategorias; ?>&strTabela=tb_categorias<?php echo $queryPadrao; ?><?php echo $queryPadraoRetornoPaginacao; ?>" class="Links02">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNClassificacaoA"); ?>
                            <a>
                         <?php }else{ ?>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNClassificacaoA"); ?>
                        <?php } ?>
                    </div>
                </td>
                <?php } ?>
                <td class="TabelaDados01Celula">
                    <div class="Texto02">
						<?php if($GLOBALS['habilitarCategoriasClassificacaoPersonalizada'] == 1){ ?>
                            <a href="ClassificacaoPersonalizadaExe.php?idRegistro=<?php echo $idParentCategorias; ?>&strTabela=tb_categorias&criterioClassificacao=categoria<?php echo $queryPadrao; ?><?php echo $queryPadraoRetornoPaginacao; ?>" class="Links02">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCategoriasCategoria"); ?>
                            <a>
                         <?php }else{ ?>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCategoriasCategoria"); ?>
                        <?php } ?>
                    </div>
                </td>
                <td width="100" class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFuncoes"); ?>
                    </div>
                </td>
                <?php if($GLOBALS['habilitarCategoriasAcessoRestrito'] == 1){ ?>
                <td width="50" class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAcesso"); ?>
                    </div>
                </td>
                <?php } ?>
                <td width="30" class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao"); ?>
						<?php if($GLOBALS['habilitarCategoriasClassificacaoPersonalizada'] == 1){ ?>
                            <a href="ClassificacaoPersonalizadaExe.php?idRegistro=<?php echo $idParentCategorias; ?>&strTabela=tb_categorias&criterioClassificacao=ativacao<?php echo $queryPadrao; ?><?php echo $queryPadraoRetornoPaginacao; ?>" class="Links02">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao"); ?>
                            <a>
                         <?php }else{ ?>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao"); ?>
                        <?php } ?>
                        
                    </div>
                </td>
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
                //while($linhaCategorias = mysqli_fetch_array($resultadoCategorias))
                //foreach ($dbSistemaConPDO->query($strSqlCategoriasSelect) as $linhaCategorias)
                //while ($linhaCategorias = $statementCategoriasSelect->fetchAll())
                foreach($resultadoCategorias as $linhaCategorias)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
              	<?php if($GLOBALS['habilitarCategoriasNClassificacao'] == 1){ ?>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaCategorias['n_classificacao'];?>
                    </div>
                </td>
                <?php } ?>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
                        <a href="CategoriasIndice.php?idParentCategorias=<?php echo $linhaCategorias['id'];?>" class="Links01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($linhaCategorias['categoria']);?>
                            <?php //echo Funcoes::ConteudoMascaraLeitura($linhaCategorias['id_parent']);?>
                        </a>
                    </div>
                    <div class="Texto01">
                        <?php //echo $linhaCategorias['descricao'];?>
                        <?php //echo nl2br($linhaCategorias['descricao']);?>
                        <?php echo Funcoes::ConteudoMascaraLeitura($linhaCategorias['descricao']);?>
                    </div>
                    
                    <?php if($GLOBALS['habilitarCategoriasIc1'] == 1){ ?>
                        <?php if($linhaCategorias['informacao_complementar1'] <> ''){ ?>
                            <div class="Texto01">
                                <strong>
                                    <?php //echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCategoriasIc1']); ?> 
                                    <?php //echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCategoriasIc1'],ENT_QUOTES); ?> 
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCategoriasIc1'], "IncludeConfig"); ?>: 
                                </strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaCategorias['informacao_complementar1']);?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    
                    <?php if($GLOBALS['habilitarCategoriasIc2'] == 1){ ?>
                        <?php if($linhaCategorias['informacao_complementar2'] <> ''){ ?>
                            <div class="Texto01">
                                <strong>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCategoriasIc2'], "IncludeConfig"); ?>: 
                                </strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaCategorias['informacao_complementar2']);?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    
                    <?php if($GLOBALS['habilitarCategoriasIc3'] == 1){ ?>
                        <?php if($linhaCategorias['informacao_complementar3'] <> ''){ ?>
                            <div class="Texto01">
                                <strong>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCategoriasIc3'], "IncludeConfig"); ?>: 
                                </strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaCategorias['informacao_complementar3']);?>
                            </div>
                        <?php } ?>
                    <?php } ?>
            
                    <?php if($GLOBALS['habilitarCategoriasIc4'] == 1){ ?>
                        <?php if($linhaCategorias['informacao_complementar4'] <> ''){ ?>
                            <div class="Texto01">
                                <strong>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCategoriasIc4'], "IncludeConfig"); ?>: 
                                </strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaCategorias['informacao_complementar4']);?>
                            </div>
                        <?php } ?>
                    <?php } ?>
            
                    <?php if($GLOBALS['habilitarCategoriasIc5'] == 1){ ?>
                        <?php if($linhaCategorias['informacao_complementar5'] <> ''){ ?>
                            <div class="Texto01">
                                <strong>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCategoriasIc5'], "IncludeConfig"); ?>: 
                                </strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaCategorias['informacao_complementar5']);?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    
                    <img src="arquivos/t<?php echo $linhaCategorias['imagem'];?>" style="display: none;" />
                    <?php //echo $linhaCategorias['data_categoria']; ?>
                    
                    <div class="Texto01">
                    	<?php if($GLOBALS['habilitarCategoriasFotos'] == 1){ ?>
                            [
                            <a href="ArquivosIndice.php?idParent=<?php echo $linhaCategorias['id'];?>&tipoArquivo=1&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo $linhaCategorias['categoria'];?>&detalhe02=" target="_blank" class="Links01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserirFotos"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarCategoriasVideos'] == 1){ ?>
                            [
                            <a href="ArquivosIndice.php?idParent=<?php echo $linhaCategorias['id'];?>&tipoArquivo=2&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo $linhaCategorias['categoria'];?>&detalhe02=" target="_blank" class="Links01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserirVideos"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarCategoriasArquivos'] == 1){ ?>
                            [
                            <a href="ArquivosIndice.php?idParent=<?php echo $linhaCategorias['id'];?>&tipoArquivo=3&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo $linhaCategorias['categoria'];?>&detalhe02=" target="_blank" class="Links01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserirArquivos"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarCategoriasZip'] == 1){ ?>
                            [
                            <a href="ArquivosIndice.php?idParent=<?php echo $linhaCategorias['id'];?>&tipoArquivo=4&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo $linhaCategorias['categoria'];?>&detalhe02=" target="_blank" class="Links01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserirZip"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarCategoriasSwfs'] == 1){ ?>
                            [
                            <a href="ArquivosIndice.php?idParent=<?php echo $linhaCategorias['id'];?>&tipoArquivo=5&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo $linhaCategorias['categoria'];?>&detalhe02=" target="_blank" class="Links01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserirSWFs"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php if(Funcoes::CategoriaPaginaSelect($linhaCategorias['tipo_categoria'], 3) == "-"){?>
                            <?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::CategoriaPaginaSelect($linhaCategorias['tipo_categoria'], 5),"utf8_encode");?>
                        <?php }else{ ?>
                            <a href="<?php echo Funcoes::CategoriaPaginaSelect($linhaCategorias['tipo_categoria'], 3);?>&<?php echo Funcoes::CategoriaPaginaSelect($linhaCategorias['tipo_categoria'], 4);?>=<?php echo $linhaCategorias['id'];?>" class="Links01">
                                <?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::CategoriaPaginaSelect($linhaCategorias['tipo_categoria'], 5),"utf8_encode");?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
                
                <?php if($GLOBALS['habilitarCategoriasAcessoRestrito'] == 1){ ?>
                <td class="<?php if($linhaCategorias['acesso_restrito'] == 0){/*echo "TbFundoClaro";*/}else{echo "TbFundoDesativado";}?> TabelaDados01Celula">
                    <div align="center" class="Texto01">
                    	<a href="RegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaCategorias['id'];?>&statusAtivacao=<?php echo $linhaCategorias['acesso_restrito'];?>&strTabela=tb_categorias&strCampo=acesso_restrito<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="Links01">
                        	<?php if($linhaCategorias['acesso_restrito'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAcesso0"); ?>
                            <?php } ?>
                        	<?php if($linhaCategorias['acesso_restrito'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAcesso1"); ?>
                            <?php } ?>
                        </a>
                        <?php //echo $linhaCategorias['acesso_restrito'];?>
                    </div>
                </td>
                <?php } ?>
                
                <td class="<?php if($linhaCategorias['ativacao'] == 1){/*echo "TbFundoClaro";*/}else{echo "TbFundoDesativado";}?> TabelaDados01Celula">
                    <div align="center" class="Texto01">
                    	<a href="RegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaCategorias['id'];?>&statusAtivacao=<?php echo $linhaCategorias['ativacao'];?>&strTabela=tb_categorias&strCampo=ativacao<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="Links01">
                        	<?php if($linhaCategorias['ativacao'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao0"); ?>
                            <?php } ?>
                        	<?php if($linhaCategorias['ativacao'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao1"); ?>
                            <?php } ?>
                        </a>
						<?php //echo $linhaCategorias['ativacao'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="CategoriasEditar.php?idTbCategorias=<?php echo $linhaCategorias['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaCategorias['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
    <?php } ?>
    
    
	<?php //Paginação. ?>
    <?php //************************************************************************************** ?>
    <?php if($GLOBALS['habilitarCategoriasSistemaPaginacao'] == "1"){ ?>
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
                <?php if($GLOBALS['habilitarCategoriasSistemaPaginacaoNumeracao'] == "1"){ ?>
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
    <form name="formCategorias" id="formCategorias" action="CategoriasIndiceExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
    <?php //echo "habilitarCategoriasNClassificacao=" . $GLOBALS['habilitarCategoriasNClassificacao'] . "<br />"; ?>
    <table class="TabelaCampos01">
        <tr class="TbFundoEscuro">
            <td class="TabelaCampos01Celula" colspan="4">
                <div align="center" class="Texto02">
                    <strong>
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCategoriasTbCategorias"); ?>
                    </strong>
                </div>
            </td>
        </tr>
        <tr>
            <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                <div align="left" class="Texto01">
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCategoriasCategoria"); ?>:
                </div>
            </td>
            <td class="TbFundoClaro TabelaCampos01Celula"<?php if($GLOBALS['habilitarCategoriasNClassificacao'] <> "1"){ ?> colspan="3"<?php } ?>>
                <div align="left">
                    <input type="text" name="categoria" id="categoria" class="CampoTexto01" maxlength="255" />
                </div>
            </td>
            <?php if($GLOBALS['habilitarCategoriasNClassificacao'] == 1){ ?>
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
        
        <?php if($GLOBALS['ativacaoCategoriasDescricao'] == 1){ ?>
        <tr>
            <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                <div align="left" class="Texto01">
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCategoriasDescricao"); ?>:
                </div>
            </td>
            <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                <div>
                  <textarea id="descricao" name="descricao" class="CampoTextoMultilinha01"></textarea>
                </div>
            </td>
        </tr>
        <?php } ?>
        
        <tr>
            <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                <div align="left" class="Texto01">
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCategoriasTipo"); ?>:
                </div>
            </td>
            <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                <div>
                    <select name="tipo_categoria" id="tipo_categoria" class="CampoDropDownMenu01">
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
    
        <?php if($GLOBALS['habilitarCategoriasIc1'] == 1){ ?>
        <tr>
            <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                <div align="left" class="Texto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCategoriasIc1'], "IncludeConfig"); ?>:
                </div>
            </td>
            <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                <div>
                    <?php if($GLOBALS['configCategoriasBoxIc1'] == 1){ ?>
                        <input type="text" name="informacao_complementar1" id="informacao_complementar1" class="CampoTexto01" maxlength="255" />
                    <?php } ?>
                    <?php if($GLOBALS['configCategoriasBoxIc1'] == 2){ ?>
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
        
        <?php if($GLOBALS['habilitarCategoriasIc2'] == 1){ ?>
        <tr>
            <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                <div align="left" class="Texto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCategoriasIc2'], "IncludeConfig"); ?>:
                </div>
            </td>
            <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                <div>
                    <?php if($GLOBALS['configCategoriasBoxIc2'] == 1){ ?>
                        <input type="text" name="informacao_complementar2" id="informacao_complementar2" class="CampoTexto01" maxlength="255" />
                    <?php } ?>
                    <?php if($GLOBALS['configCategoriasBoxIc2'] == 2){ ?>
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
    
        <?php if($GLOBALS['habilitarCategoriasIc3'] == 1){ ?>
        <tr>
            <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                <div align="left" class="Texto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCategoriasIc3'], "IncludeConfig"); ?>:
                </div>
            </td>
            <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                <div>
                    <?php if($GLOBALS['configCategoriasBoxIc3'] == 1){ ?>
                        <input type="text" name="informacao_complementar3" id="informacao_complementar3" class="CampoTexto01" maxlength="255">
                    <?php } ?>
                    <?php if($GLOBALS['configCategoriasBoxIc3'] == 2){ ?>
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
    
        <?php if($GLOBALS['habilitarCategoriasIc4'] == 1){ ?>
        <tr>
            <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                <div align="left" class="Texto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCategoriasIc4'], "IncludeConfig"); ?>:
                </div>
            </td>
            <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                <div>
                    <?php if($GLOBALS['configCategoriasBoxIc4'] == 1){ ?>
                        <input type="text" name="informacao_complementar4" id="informacao_complementar4" class="CampoTexto01" maxlength="255" />
                    <?php } ?>
                    <?php if($GLOBALS['configCategoriasBoxIc4'] == 2){ ?>
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
    
        <?php if($GLOBALS['habilitarCategoriasIc5'] == 1){ ?>
        <tr>
            <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                <div align="left" class="Texto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCategoriasIc5'], "IncludeConfig"); ?>:
                </div>
            </td>
            <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                <div>
                    <?php if($GLOBALS['configCategoriasBoxIc5'] == 1){ ?>
                        <input type="text" name="informacao_complementar5" id="informacao_complementar5" class="CampoTexto01" maxlength="255" />
                    <?php } ?>
                    <?php if($GLOBALS['configCategoriasBoxIc5'] == 2){ ?>
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
        <?php if($GLOBALS['ativacaoCategoriasImagem'] == 1){ ?>
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
            
            <input name="id_parent" type="hidden" id="id_parent" value="<?php echo $idParentCategorias; ?>" />
            <input name="ativacao" type="hidden" id="ativacao" value="1" />
            <input name="acesso_restrito" type="hidden" id="acesso_restrito" value="0" />
            <input name="id_tb_cadastro_usuario" type="hidden" id="id_tb_cadastro_usuario" value="<?php echo $idTbCadastroUsuario; ?>" />
            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
        </div>
        <div style="float:right;">
            &nbsp;
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
unset($strSqlCategoriasSelect);
unset($statementCategoriasSelect);
unset($resultadoCategorias);
unset($linhaCategorias);
//----------


//Inclusão do template do layout.
include_once $page->LayoutSistema;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>