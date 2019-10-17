<?php
//Importação dos arquivos de configuração.
require_once "../sistema/IncludeConfig.php"; //Deve vir antes do db.
require_once "../sistema/IncludeConexao.php";
require_once "../sistema/IncludeFuncoes.php";
//require_once "IncludeLayout.php";
require_once "IncludeLayoutSite.php";


//Verificação de login de cadastro.
LoginAutenticacao::CadastroLoginVerificacao();


//Resgate de variáveis.
$idTbProdutosComplemento = $_GET["idTbProdutosComplemento"];

$idItem = $_GET["idItem"];
$configCaixaSelecao = $_GET["configCaixaSelecao"];

$paginaRetorno = "SiteAdmProdutosManutencao.php";
//$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];


//Montagem de query padrão de retorno.
$queryPadrao = "&paginaRetorno=" . $paginaRetorno . 
"&masterPageSiteSelect=" . $masterPageSiteSelect;
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
	<?php echo htmlentities($GLOBALS['configTituloSite']); ?> - <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosManutencaoTituloEditar"); ?>
<?php 
$pageSite->cphTitle = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Head.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphHead*/ ?>
    <meta name="description" content="" /><?php //Abaixo de 160 caracteres.?>
    <meta name="keywords" content="" /><?php //Abaixo de 100 caracteres.?>
    <meta name="title" content="" /><?php //Abaixo de 60 caracteres.?>
<?php 
$pageSite->cphHead = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Título atual.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphConteudoCabecalho*/ ?>
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosManutencaoTituloEditar"); ?>
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

	<?php if($masterPageSiteSelect <> "LayoutSiteIFrame.php"){ ?>
		<?php //Opções gerais.?>
        <?php //----------------------?>
        <?php 
        //Definição de variáveis do include.
        $includeAdmOpcoes_tipoOpcoes = "1";
        $includeAdmOpcoes_configOpcoes = "";
        ?>
        
        <?php include "IncludeAdmOpcoes.php";?>
        <?php //----------------------?>
        
        
        <br />
        <?php //Opções principais.?>
        <?php //----------------------?>
        <?php 
        //Definição de variáveis do include.
        $includeAdmOpcoes_tipoOpcoes = "2";
        $includeAdmOpcoes_configOpcoes = "";
        ?>
        
        <?php include "IncludeAdmOpcoes.php";?>
        <?php //----------------------?>
    
        
        <br />
        <?php //Opções de informações complementares.?>
        <?php //----------------------?>
        <?php 
        //Definição de variáveis do include.
        $includeAdmOpcoes_tipoOpcoes = "ic1";
        $includeAdmOpcoes_configOpcoes = "";
        ?>
        
        <?php include "IncludeAdmOpcoes.php";?>
        <?php //----------------------?>
	<?php } ?>

    <form name="formProdutosManutencao" id="formProdutosManutencao" action="SiteAdmProdutosManutencaoEditarExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <table class="AdmTabelaCampos01">
            <tr>
                <td class="AdmTbFundoEscuro" colspan="2">
                    <div align="center" class="AdmTexto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosManutencaoTbEditar"); ?>
                        </strong>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosManutencaoComplemento"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro">
                    <div align="left">
                        <input type="text" name="complemento" id="complemento" class="AdmCampoTexto01" maxlength="255" value="<?php echo $tbProdutosComplementoComplemento;?>" />
                    </div>
                </td>
            </tr>
            <tr style="display: none;">
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosManutencaoDescricao"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro">
                    <div>
                        <textarea name="descricao" id="descricao" class="AdmCampoTextoMultilinha01"><?php echo $tbProdutosComplementoDescricao;?></textarea>
                    </div>
                </td>
            </tr>
        </table>
        <div>
            <div style="float:left;">
                <div class="AdmDivBto01" onclick="btoClick_onEvent('btoProdutosManutencaoUpdate');">
                    <a class="AdmLinks01">
                        Salvar
                    </a>
                </div>
                <input id="btoProdutosManutencaoUpdate" type="image" name="submit" value="Submit" src="img/btoAtualizar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoAtualizar"); ?>" style="display: none;" />
                
                <input name="idTbProdutosComplemento" type="hidden" id="idTbProdutosComplemento" value="<?php echo $idTbProdutosComplemento; ?>" />
                <input name="tipo_complemento" type="hidden" id="tipo_complemento" value="<?php echo $tbProdutosComplementoTipoComplemento; ?>" />
                
                <input type="hidden" id="idItem" name="idItem" value="<?php echo $idItem; ?>" />
                <input type="hidden" id="configCaixaSelecao" name="configCaixaSelecao" value="<?php echo $configCaixaSelecao; ?>" />
                
                <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                <input name="masterPageSiteSelect" type="hidden" id="masterPageSelect" value="<?php echo $masterPageSiteSelect; ?>" />
            </div>
            <div style="float:right;">
                <div class="AdmDivBto01" onclick="javascript:history.go(-1);">
                    <a class="AdmLinks01">
                        Voltar
                    </a>
                </div>
            
                <a href="<?php echo $paginaRetorno; ?>?tipoComplemento=<?php echo $tbProdutosComplementoTipoComplemento;?><?php echo $queryPadrao;?>" style="display: none;">
                    <img src="img/btoVoltar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoVoltar"); ?>"  />
                </a>
            </div>
        </div>
    </form>
<?php 
$pageSite->cphConteudoPrincipal = ob_get_clean(); 
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
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>