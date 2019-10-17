<?php
//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeLayout.php";


//Verificação de login Master.
LoginAutenticacao::UsuarioLoginVerificacao();


//Resgate de variáveis.
$idTbProdutosComplemento = $_GET["idTbProdutosComplemento"];

$paginaRetorno = "ProdutosManutencao.php";
//$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];


//Montagem de query padrão de retorno.
$queryPadrao = "&paginaRetorno=" . $paginaRetorno;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Definição de variáveis.
//$tipoComplemento = 1;

//Query de pesquisa.
//----------
$strSqlProdutosManutencaoDetalhesSelect = "";
$strSqlProdutosManutencaoDetalhesSelect .= "SELECT ";
$strSqlProdutosManutencaoDetalhesSelect .= "id, ";
$strSqlProdutosManutencaoDetalhesSelect .= "tipo_complemento, ";
$strSqlProdutosManutencaoDetalhesSelect .= "complemento, ";
$strSqlProdutosManutencaoDetalhesSelect .= "descricao ";
$strSqlProdutosManutencaoDetalhesSelect .= "FROM tb_produtos_complemento ";
$strSqlProdutosManutencaoDetalhesSelect .= "WHERE id <> 0 ";
//$strSqlProdutosManutencaoDetalhesSelect .= "AND tipo_complemento = :tipo_complemento ";
$strSqlProdutosManutencaoDetalhesSelect .= "AND id = :id ";
//$strSqlProdutosManutencaoDetalhesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoProdutos'] . " ";
//$strSqlProdutosManutencaoDetalhesSelect .= "ORDER BY complemento";

$statementProdutosManutencaoDetalhesSelect = $dbSistemaConPDO->prepare($strSqlProdutosManutencaoDetalhesSelect);

if ($statementProdutosManutencaoDetalhesSelect !== false)
{
	//"tipo_complemento" => $tipoComplemento
	$statementProdutosManutencaoDetalhesSelect->execute(array(
		"id" => $idTbProdutosComplemento
	));
}

//$resultadoProdutosManutencao1 = $dbSistemaConPDO->query($strSqlProdutosManutencao1Select);
$resultadoProdutosManutencaoDetalhes = $statementProdutosManutencaoDetalhesSelect->fetchAll();


if (empty($resultadoProdutosManutencaoDetalhes))
{
	//echo "Nenhum registro encontrado";
}else{
	foreach($resultadoProdutosManutencaoDetalhes as $linhaProdutosManutencao)
	{
		//Definição das variáveis de detalhes.
		$tbProdutosComplementoId = $linhaProdutosManutencao['id'];
		$tbProdutosComplementoTipoComplemento = $linhaProdutosManutencao['tipo_complemento'];
		$tbProdutosComplementoComplemento = Funcoes::ConteudoMascaraLeitura($linhaProdutosManutencao['complemento']);
		$tbProdutosComplementoDescricao = Funcoes::ConteudoMascaraLeitura($linhaProdutosManutencao['descricao']);
		
		//Verificação de erro.
		//echo "id=" . $linhaCategorias['id'] . "<br>";
		//echo "id_parent=" . $linhaCategorias['id_parent'] . "<br>";
		//echo "categoria=" . Funcoes::ConteudoMascaraLeitura($linhaCategorias['categoria']) . "<br>";
		
		//echo "id=" . $tbCategoriasId . "<br>";
		//echo "id_parent=" . $tbCategoriasIdParent . "<br>";
		//echo "categoria=" . $tbCategoriasCategoria . "<br>";
	}
}

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
    	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaProdutosManutencaoTituloEditar"); ?>
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
    
    <form name="formProdutosManutencao" id="formProdutosManutencao" action="ProdutosManutencaoEditarExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <table class="TabelaCampos01">
            <tr>
                <td class="TbFundoEscuro" colspan="2">
                    <div align="center" class="Texto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaProdutosManutencaoTbEditar"); ?>
                        </strong>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaProdutosManutencaoComplemento"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro">
                    <div align="left">
                        <input type="text" name="complemento" id="complemento" class="CampoTexto01" maxlength="255" value="<?php echo $tbProdutosComplementoComplemento;?>" />
                    </div>
                </td>
            </tr>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaProdutosManutencaoDescricao"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro">
                    <div>
                        <textarea name="descricao" id="descricao" class="CampoTextoMultilinha01"><?php echo $tbProdutosComplementoDescricao;?></textarea>
                    </div>
                </td>
            </tr>
        </table>
        <div>
            <div style="float:left;">
                <input type="image" name="submit" value="Submit" src="img/btoAtualizar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoAtualizar"); ?>" />
                
                <input name="idTbProdutosComplemento" type="hidden" id="idTbProdutosComplemento" value="<?php echo $idTbProdutosComplemento; ?>" />
                <input name="tipo_complemento" type="hidden" id="tipo_complemento" value="<?php echo $tbProdutosComplementoTipoComplemento; ?>" />
                <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            </div>
            <div style="float:right;">
                <a href="<?php echo $paginaRetorno; ?>">
                    <img src="img/btoVoltar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoVoltar"); ?>"  />
                </a>
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
unset($strSqlProdutosManutencaoDetalhesSelect);
unset($statementProdutosManutencaoDetalhesSelect);
unset($resultadoProdutosManutencaoDetalhes);
unset($linhaProdutosManutencaoDetalhes);
//----------
		

//Inclusão do template do layout.
include_once $page->LayoutSistema;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>