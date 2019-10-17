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
$idTbHistoricoComplemento = $_GET["idTbHistoricoComplemento"];

$idItem = $_GET["idItem"];
$configCaixaSelecao = $_GET["configCaixaSelecao"];

$paginaRetorno = "SiteAdmHistoricoManutencao.php";
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
$strSqlHistoricoManutencaoDetalhesSelect = "";
$strSqlHistoricoManutencaoDetalhesSelect .= "SELECT ";
$strSqlHistoricoManutencaoDetalhesSelect .= "id, ";
$strSqlHistoricoManutencaoDetalhesSelect .= "tipo_complemento, ";
$strSqlHistoricoManutencaoDetalhesSelect .= "complemento, ";
$strSqlHistoricoManutencaoDetalhesSelect .= "descricao ";
$strSqlHistoricoManutencaoDetalhesSelect .= "FROM tb_historico_complemento ";
$strSqlHistoricoManutencaoDetalhesSelect .= "WHERE id <> 0 ";
//$strSqlHistoricoManutencaoDetalhesSelect .= "AND tipo_complemento = :tipo_complemento ";
$strSqlHistoricoManutencaoDetalhesSelect .= "AND id = :id ";
//$strSqlHistoricoManutencaoDetalhesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
//$strSqlHistoricoManutencaoDetalhesSelect .= "ORDER BY complemento";

$statementHistoricoManutencaoDetalhesSelect = $dbSistemaConPDO->prepare($strSqlHistoricoManutencaoDetalhesSelect);

if ($statementHistoricoManutencaoDetalhesSelect !== false)
{
	//"tipo_complemento" => $tipoComplemento
	$statementHistoricoManutencaoDetalhesSelect->execute(array(
		"id" => $idTbHistoricoComplemento
	));
}

//$resultadoHistoricoManutencao1 = $dbSistemaConPDO->query($strSqlHistoricoManutencao1Select);
$resultadoHistoricoManutencaoDetalhes = $statementHistoricoManutencaoDetalhesSelect->fetchAll();


if (empty($resultadoHistoricoManutencaoDetalhes))
{
	//echo "Nenhum registro encontrado";
}else{
	foreach($resultadoHistoricoManutencaoDetalhes as $linhaHistoricoManutencao)
	{
		//Definição das variáveis de detalhes.
		$tbHistoricoComplementoId = $linhaHistoricoManutencao['id'];
		$tbHistoricoComplementoTipoComplemento = $linhaHistoricoManutencao['tipo_complemento'];
		$tbHistoricoComplementoComplemento = Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao['complemento']);
		$tbHistoricoComplementoDescricao = Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao['descricao']);
		
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
	<?php echo htmlentities($GLOBALS['configTituloSite']); ?> - <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoManutencaoTituloEditar"); ?>
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
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoManutencaoTituloEditar"); ?>
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


    <form name="formHistoricoManutencao" id="formHistoricoManutencao" action="SiteAdmHistoricoManutencaoEditarExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <table class="AdmTabelaCampos01">
            <tr>
                <td class="AdmTbFundoEscuro" colspan="2">
                    <div align="center" class="AdmTexto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoManutencaoTbEditar"); ?>
                        </strong>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoManutencaoComplemento"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro">
                    <div align="left">
                        <input type="text" name="complemento" id="complemento" class="AdmCampoTexto01" maxlength="255" value="<?php echo $tbHistoricoComplementoComplemento;?>" />
                    </div>
                </td>
            </tr>
            <tr style="display: none;">
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoManutencaoDescricao"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro">
                    <div>
                        <textarea name="descricao" id="descricao" class="AdmCampoTextoMultilinha01"><?php echo $tbHistoricoComplementoDescricao;?></textarea>
                    </div>
                </td>
            </tr>
        </table>
        <div>
            <div style="float:left;">
                <div class="AdmDivBto01" onclick="btoClick_onEvent('btoHistoricoManutencaoUpdate');">
                    <a class="AdmLinks01">
                        Salvar
                    </a>
                </div>
                <input id="btoHistoricoManutencaoUpdate" type="image" name="submit" value="Submit" src="img/btoAtualizar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoAtualizar"); ?>" style="display: none;" />
                
                <input name="idTbHistoricoComplemento" type="hidden" id="idTbHistoricoComplemento" value="<?php echo $idTbHistoricoComplemento; ?>" />
                <input name="tipo_complemento" type="hidden" id="tipo_complemento" value="<?php echo $tbHistoricoComplementoTipoComplemento; ?>" />
                
                <input type="hidden" id="idItem" name="idItem" value="<?php echo $idItem; ?>" />
                <input type="hidden" id="configCaixaSelecao" name="configCaixaSelecao" value="<?php echo $configCaixaSelecao; ?>" />
                
                <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                <input name="masterPageSiteSelect" type="hidden" id="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
            </div>
            <div style="float:right;">
                <div class="AdmDivBto01" onclick="javascript:history.go(-1);">
                    <a class="AdmLinks01">
                        Voltar
                    </a>
                </div>
            
                <a href="<?php echo $paginaRetorno; ?>?tipoComplemento=<?php echo $tbHistoricoComplementoTipoComplemento;?><?php echo $queryPadrao;?>" style="display: none;">
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
unset($strSqlHistoricoManutencaoDetalhesSelect);
unset($statementHistoricoManutencaoDetalhesSelect);
unset($resultadoHistoricoManutencaoDetalhes);
unset($linhaHistoricoManutencaoDetalhes);
//----------


//Inclusão do template do layout.
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>