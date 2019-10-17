<?php
//Importação dos arquivos de configuração.
require_once "../sistema/IncludeConfig.php"; //Deve vir antes do db.
require_once "../sistema/IncludeConexao.php";
require_once "../sistema/IncludeFuncoes.php";
//require_once "IncludeLayout.php";
require_once "IncludeLayoutSite.php";


//Verificação de login de processos.
LoginAutenticacao::CadastroLoginVerificacao();


//Resgate de variáveis.
$idTbProcessosComplemento = $_GET["idTbProcessosComplemento"];

$paginaRetorno = "SiteAdmProcessosManutencao.php";
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
$strSqlProcessosManutencaoDetalhesSelect = "";
$strSqlProcessosManutencaoDetalhesSelect .= "SELECT ";
$strSqlProcessosManutencaoDetalhesSelect .= "id, ";
$strSqlProcessosManutencaoDetalhesSelect .= "tipo_complemento, ";
$strSqlProcessosManutencaoDetalhesSelect .= "complemento, ";
$strSqlProcessosManutencaoDetalhesSelect .= "descricao ";
$strSqlProcessosManutencaoDetalhesSelect .= "FROM tb_processos_complemento ";
$strSqlProcessosManutencaoDetalhesSelect .= "WHERE id <> 0 ";
//$strSqlProcessosManutencaoDetalhesSelect .= "AND tipo_complemento = :tipo_complemento ";
$strSqlProcessosManutencaoDetalhesSelect .= "AND id = :id ";
//$strSqlProcessosManutencaoDetalhesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoProcessos'] . " ";
//$strSqlProcessosManutencaoDetalhesSelect .= "ORDER BY complemento";

$statementProcessosManutencaoDetalhesSelect = $dbSistemaConPDO->prepare($strSqlProcessosManutencaoDetalhesSelect);

if ($statementProcessosManutencaoDetalhesSelect !== false)
{
	//"tipo_complemento" => $tipoComplemento
	$statementProcessosManutencaoDetalhesSelect->execute(array(
		"id" => $idTbProcessosComplemento
	));
}

//$resultadoProcessosManutencao1 = $dbSistemaConPDO->query($strSqlProcessosManutencao1Select);
$resultadoProcessosManutencaoDetalhes = $statementProcessosManutencaoDetalhesSelect->fetchAll();


if (empty($resultadoProcessosManutencaoDetalhes))
{
	//echo "Nenhum registro encontrado";
}else{
	foreach($resultadoProcessosManutencaoDetalhes as $linhaProcessosManutencao)
	{
		//Definição das variáveis de detalhes.
		$tbProcessosComplementoId = $linhaProcessosManutencao['id'];
		$tbProcessosComplementoTipoComplemento = $linhaProcessosManutencao['tipo_complemento'];
		$tbProcessosComplementoComplemento = Funcoes::ConteudoMascaraLeitura($linhaProcessosManutencao['complemento']);
		$tbProcessosComplementoDescricao = Funcoes::ConteudoMascaraLeitura($linhaProcessosManutencao['descricao']);
		
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
	<?php echo htmlentities($GLOBALS['configTituloSite']); ?> - <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProcessosManutencaoTituloEditar"); ?>
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
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProcessosManutencaoTituloEditar"); ?>
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


    <form name="formProcessosManutencao" id="formProcessosManutencao" action="SiteAdmProcessosManutencaoEditarExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <table class="AdmTabelaCampos01">
            <tr>
                <td class="AdmTbFundoEscuro" colspan="2">
                    <div align="center" class="AdmTexto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProcessosManutencaoTbEditar"); ?>
                        </strong>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProcessosManutencaoComplemento"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro">
                    <div align="left">
                        <input type="text" name="complemento" id="complemento" class="AdmCampoTexto01" maxlength="255" value="<?php echo $tbProcessosComplementoComplemento;?>" />
                    </div>
                </td>
            </tr>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProcessosManutencaoDescricao"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro">
                    <div>
                        <textarea name="descricao" id="descricao" class="AdmCampoTextoMultilinha01"><?php echo $tbProcessosComplementoDescricao;?></textarea>
                    </div>
                </td>
            </tr>
        </table>
        <div>
            <div style="float:left;">
                <input type="image" name="submit" value="Submit" src="img/btoAtualizar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoAtualizar"); ?>" />
                
                <input name="idTbProcessosComplemento" type="hidden" id="idTbProcessosComplemento" value="<?php echo $idTbProcessosComplemento; ?>" />
                <input name="tipo_complemento" type="hidden" id="tipo_complemento" value="<?php echo $tbProcessosComplementoTipoComplemento; ?>" />
                
                <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                <input name="masterPageSelect" type="hidden" id="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
            </div>
            <div style="float:right;">
                <a href="<?php echo $paginaRetorno; ?>?tipoComplemento=<?php echo $tbProcessosComplementoTipoComplemento;?>">
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
unset($strSqlProcessosManutencaoDetalhesSelect);
unset($statementProcessosManutencaoDetalhesSelect);
unset($resultadoProcessosManutencaoDetalhes);
unset($linhaProcessosManutencaoDetalhes);
//----------


//Inclusão do template do layout.
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>