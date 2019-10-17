<?php
//Importação dos arquivos de configuração.
require_once "../sistema/IncludeConfig.php"; //Deve vir antes do db.
require_once "../sistema/IncludeConexao.php";
require_once "../sistema/IncludeFuncoes.php";
//require_once "IncludeLayout.php";
require_once "IncludeLayoutSite.php";


//Criação de id temporária.
//CookiesFuncoes::IdTbCadastroTemporario_CookieCriar();
//CookiesFuncoes::CookieExcluir($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroTemporario");


//Regate de variáveis.
$visitanteConfigCoordLocalInicial = $_GET["visitanteConfigCoordLocalInicial"];

$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];


//Gravação de cookie com as coordenadas.
if($visitanteConfigCoordLocalInicial <> "")
{
	//OBS: Valores das coordenadas devem ser gravados no cookie com vírgula (,) e não ponto e vírgula (;). Dá problema na interpretação do cookie posteriormente.
	CookiesFuncoes::CookieCriar($GLOBALS['configNomeCookie'] . "_" . "visitanteConfigCoordLocalInicial", $visitanteConfigCoordLocalInicial);
}else{
	CookiesFuncoes::CookieExcluir($GLOBALS['configNomeCookie'] . "_" . "visitanteConfigCoordLocalInicial");
}


//Verificação de erro - debug.
//echo "cookie=" . $_COOKIE[$GLOBALS['configNomeCookie'] . "_" . $GLOBALS['configSessionNomeUsuarioMaster']] . "<br>";
//echo "cookie(decrypt)=" . $tbUsuariosSenha = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura($_COOKIE[$GLOBALS['configNomeCookie'] . "_" . $GLOBALS['configSessionNomeUsuarioMaster']], 2), 2) . "<br>";
//echo "idTbCadastroTemporario=" . Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura(CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroTemporario")), 2) . "<br>";
//echo "mb_detect_encoding=" . mb_detect_encoding($jsonRetorno) . "<br/>"; //detecta código de caractér

//echo "visitanteConfigCoordLocalInicial=" . $visitanteConfigCoordLocalInicial . "<br/>";
//echo "cookie - visitanteConfigCoordLocalInicial=" . CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "visitanteConfigCoordLocalInicial") . "<br/>";

/*
echo "GetDados_API02 - googleMatrix - arrayDistanciasDuracaoMultiplos=";
var_dump(JsonFuncoes::GetDados_API02("", 
									"googleMatrix", 
									"arrayDistanciasDuracaoMultiplos", 
									array('distanciaOrigem'=>'-23.4960943,-46.6078504',
										  'distanciaDestino'=>'-23.539976,-46.697317|-23.546480,-46.690799')
									  ));
echo "<br/>";
*/

/*
echo "GetDados_API02 - googleMatrix - arrayDistanciasDuracao=";
var_dump(JsonFuncoes::GetDados_API02("", 
									"googleMatrix", 
									"arrayDistanciasDuracao", 
									array('distanciaOrigem'=>'-23.4960943,-46.6078504',
										  'distanciaDestino'=>'-23.539976,-46.697317|-23.546480,-46.690799')
									  ));
echo "<br/>";
*/
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php //echo htmlentities($GLOBALS['configTituloSite']); ?>
	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloSite'], "IncludeConfig"); ?>
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
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHomeTitulo"); ?>
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
    
    
    <?php //Data.?>
    <div style="display: none;">
    	<?php echo htmlentities(Funcoes::DataTraducao(date("l"), "s", "pt-br"));?>, <?php echo date("j");?> de <?php echo htmlentities(Funcoes::DataTraducao(date("F"), "m", "pt-br"));?> de <?php echo date("Y");?>
    </div>
    
    
	<?php //Busca.?>
    <?php //----------------------?>
    <?php 
	//Definição de variáveis do include.
	$includeBusca_tipoBusca = "produtos1"; //cadastro1 (busca por palavra-chave) | cadastroAdm1 (busca por palavra-chave) | imoveis1 (busca por palavra-chave) | imoveis2 (busca com dropdown) | categoriasDropdown1 (busca com dropdown) | produtos1 (busca por palavra-chave) | cadastro1 (busca por palavra-chave) | cadastro2 (busca detalhada | produtos1 (busca por palavra-chave) | publicacoes1 (busca por palavra-chave) | enquetes1 (busca por palavra-chave) | forum1 (busca por palavra-chave) | videos1 (busca por palavra-chave) | contatosAdm1 (busca por palavra-chave) | tarefas1 (busca por palavra-chave) | cadastroContasBancariasAdm1 (busca por palavra-chave) | paginas1 (busca por palavra-chave) |  paginasAdm1 (busca por palavra-chave)  |  processosAdm1 (busca por palavra-chave)
	$includeBusca_origemBusca = "";
	$includeBusca_idTbCategoriaEscolha = "";
	?>
    
    <?php include "IncludeBusca.php";?>
    <?php //----------------------?>
    
    
	<?php //Categorias - Menu.?>
    <?php //----------------------?>
    <?php 
	//Definição de variáveis do include.
	$includeCategoriasMenu_idTbCategoriasMenuRaiz = "3485";
	$includeCategoriasMenu_tipoCategoria = "";
	$includeCategoriasMenu_idTbCadastroUsuario = "";
	
	$includeCategoriasMenu_tipoCategoriasMenu = "21";
	?>
    
    <?php include "IncludeCategoriasMenu.php";?>
    <?php //----------------------?>

    
	<?php //Filtros - Menu.?>
    <?php //----------------------?>
    <?php 
	//Definição de variáveis do include.
	$includeFiltrosMenu_tipoDiagramacao = "1";
	$includeFiltrosMenu_strTabelaComplemento = "tb_cadastro_complemento";
	$includeFiltrosMenu_tipoComplemento = "1";
	?>
    
    <?php include "IncludeFiltrosMenu.php";?>
    <?php //----------------------?>
	
	
	<?php //Conteúdo.?>
	<?php //----------------------?>
	<?php 
	//Definição de variáveis do include.
	$includeConteudo_idParentConteudo = "3479";
	$includeConteudo_idTbConteudo = "";
	$includeConteudo_tipoConteudo = "";
	
	$includeConteudo_configTipoDiagramacao = "1";
	$includeConteudo_configConteudoNRegistros = "";
	$includeConteudo_configClassificacaoConteudo = $GLOBALS['configClassificacaoConteudo'];
	?>
	
	<?php include "IncludeConteudo.php";?>
	<?php //----------------------?>
    
    
	<?php //Produtos.?>
    <?php //----------------------?>
    <?php 
	//Definição de variáveis do include.
	$includeProdutos_idParentProdutos = "";
	$includeProdutos_idTbCadastroUsuario = "";
	
	$includeProdutos_configTipoDiagramacao = "1";
	$includeProdutos_configProdutosNRegistros = "";
	$includeProdutos_configClassificacaoProdutos = "";
	
	$includeProdutos_ativacaoPromocao = "";
	$includeProdutos_ativacaoHome = "1";
	$includeProdutos_ativacaoHomeCategoria = "";
	?>
    
    <?php include "IncludeProdutos.php";?>
    <?php //----------------------?>
    
	
	<?php //Publicações.?>
    <?php //----------------------?>
    <?php 
	//Definição de variáveis do include.
	$includePublicacoes_idParentPublicacoes = "3483";
	$includePublicacoes_idTbCadastroUsuario = "";
	$includePublicacoes_tipoPublicacao = "";
	
	$includePublicacoes_configTipoDiagramacao = "1";
	$includePublicacoes_configPublicacoesNRegistros = "";
	$includePublicacoes_configClassificacaoPublicacoes = "";
	
	$includePublicacoes_ativacaoHome = "1";
	$includePublicacoes_ativacaoHomeCategoria = "";
	?>
    
    <?php include "IncludePublicacoes.php";?>
    <?php //----------------------?>
    
    
	<?php //Cadastro.?>
    <?php //----------------------?>
	<?php
    $idsTbItensSelecionado = DbFuncoes::GetCampoGenerico06("tb_itens_selecao", 
                                                        "id_tb_item", 
                                                        "id_tb_cadastro", 
                                                        Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura(CookiesFuncoes::CookieValorLer("")), 2), 
                                                        "", 
                                                        "", 
                                                        1,
                                                        "", 
                                                        "", 
                                                        "tipo_categoria", 
                                                        "13", 
                                                        "", 
                                                        "");
														
	//Evitar seleção de todos os cadastros.
	if($idsTbItensSelecionado == "")
	{
		$idsTbItensSelecionado = "0";	
	}
														
    //Verificação de erro - debug.
    //echo "idsTbItensSelecionado=" . $idsTbItensSelecionado . "<br/>";
    ?>
    
    <?php //Limpar seleção.?>
    <div align="center" style="position: relative; display: block; margin-top: 20px;">
        <form name="formCadastroSelecao" id="formCadastroSelecao" action="SiteAdmItensSelecaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <input type="image" name="submitItensLimpar" value="Submit" src="img/btoSelecaoLimpar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoExcluir"); ?>" />
            
            <a class="CadastroIndiceLinks01" onclick="document.getElementById('formCadastroSelecao<?php echo $linhaCadastro['id']; ?>').submit();" style="cursor: pointer; display: none;">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoExcluir"); ?>
            </a>
            <input name="submitItensLimpar_x" type="hidden" id="submitItensLimpar_x" value="1" /><?php //Necessário quando utilizando link.?>


            <input name="idItem" type="hidden" id="idItem" value="" />
            <input name="tipoCategoria" type="hidden" id="tipoCategoria" value="13" />
            <input name="ativacao" type="hidden" id="ativacao" value="1" />
            
            <input name="variavelRetorno" type="hidden" id="variavelRetorno" value="<?php echo $variavelRetorno;?>" />
            <input name="idRetorno" type="hidden" id="idRetorno" value="<?php echo $idRetorno;?>" />
            <input name="masterPageSiteSelect" type="hidden" id="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            
            <input name="palavraChave" type="hidden" id="palavraChave" value="<?php echo $palavraChave; ?>" />
        </form>
    </div>
    
    <?php //if($idsTbItensSelecionado <> ""){?>
        <?php 
        //Definição de variáveis do include.
        $includeCadastro_idTbCadastro = "";
        $includeCadastro_idsTbCadastro = "";
        $includeCadastro_idTbCadastroUsuario = "";
        
        $includeCadastro_configTipoDiagramacao = "1";
        $includeCadastro_configCadastroNRegistros = "";
        $includeCadastro_configClassificacaoCadastro = $GLOBALS['configClassificacaoCadastro'];
        
        $includeCadastro_habilitarCadastroMensagemEnvio = "";
        $includeCadastro_habilitarCadastroSelecaoItensEnvio = "";
        
		$includeCadastro_ativacao1 = "";
		$includeCadastro_ativacao2 = "";
		$includeCadastro_ativacao3 = "";
		$includeCadastro_ativacao4 = "";
        $includeCadastro_ativacaoDestaque = "";
        $includeCadastro_dataNascimento = "";
        ?>
        
        <?php include "IncludeCadastro.php";?>
    <?php //} ?>
    <?php //----------------------?>
    
    
	<?php //Histórico.?>
    <?php //----------------------?>
    <?php 
	//Definição de variáveis do include.
	$includeAdmHistorico_idParent = $tbProcessosId;
	$includeAdmHistorico_idTbCadastroUsuario = "";
	$includeAdmHistorico_idTbHistoricoStatusSelect = "";
	
	$includeAdmHistorico_tipoDiagramacao = "1";
	$includeAdmHistorico_limiteRegistros = "";
	?>
    <?php include "IncludeHistorico.php";?>
    <?php //----------------------?>
    
    
	<?php //Histórico - ADM.?>
    <?php //----------------------?>
    <?php 
    //Definição de variáveis do include.
    $includeAdmHistorico_idParent = $idTbAulas; //$idTbAulas
    $includeAdmHistorico_idTbCadastroUsuario = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura(CookiesFuncoes::CookieValorLer_Login()), 2); //Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura(CookiesFuncoes::CookieValorLer_Login()), 2)
    $includeAdmHistorico_idTbHistoricoStatusSelect = "4532";
    $includeAdmHistorico_dataHistoricoEdicao = "0"; //0-desativado | 1-ativado
    
    $includeAdmHistorico_tipoDiagramacao = "1"; //1 - convencional
    $includeAdmHistorico_limiteRegistros = "";
    
    $includeAdmHistorico_paginaRetornoHistorico = "SiteAdmAulasAdministrar.php"; //SiteAdmAulasAdministrar.php
    $includeAdmHistorico_variavelRetornoHistorico = "idTbAulas"; //idTbAulas
    $includeAdmHistorico_variavelRetornoValorHistorico = $idTbAulas;
    $includeAdmHistorico_masterPageSiteSelect = "LayoutSitePrincipal.php";
    ?>
    
    <?php include "IncludeAdmHistoricoIndice.php";?>
    <?php //----------------------?>
    
    
	<?php //Páginas.?>
    <?php //----------------------?>
    <?php 
	//Definição de variáveis do include.
	//$includePaginas_idParentPaginas = $tbCadastroId;
	$includePaginas_idParentPaginas = "";
	$includePaginas_idsTbPaginas = "";
	
	//$includePaginas_idTbCadastro1 = "";
	$includePaginas_idTbCadastro1 = $tbCadastroId;
	$includePaginas_idsTbCadastro1 = "";
	
	$includePaginas_idTbCadastro2 = "";
	$includePaginas_idsTbCadastro2 = "";
	
	$includePaginas_configTipoDiagramacao = "2";
	$includePaginas_configPaginasNRegistros = "";
	$includePaginas_configClassificacaoPaginas = "";
	?>
    
    <?php include "IncludePaginas.php";?>
    <?php //----------------------?>

    
	<?php //Charts.?>
    <?php //----------------------?>
    <?php 
    //Definição de variáveis do include.
    $includeCharts_chartID = "grafico01";
    $includeCharts_chartTipo = "1"; //1 - Canvas JS
    $includeCharts_chartEstilo = "column"; //Canvas JS (line, column, bar, area, spline, splineArea, stepLine, scatter, bubble, stackedColumn, stackedBar, stackedArea, stackedColumn100, stackedBar100, stackedArea100, pie, doughnut)
    $includeCharts_chartW = "380px"; //pixels (120px) ou % (100%)
    $includeCharts_chartH = "320px"; //pixels (120px) ou % (100%)
    
    $includeCharts_chartBarraW = "20"; //15
    $includeCharts_chartCorBarraPadrao = ""; //#cccccc
    $includeCharts_chartCorTextos = "#000000"; //#cccccc
    $includeCharts_chartCorGrafico = "#000000"; //#cccccc
    $includeCharts_chartLinhaGraficoXEspessura = "0"; //0 - invisível
    $includeCharts_chartLinhaGraficoYEspessura = "1"; //0 - invisível
	$includeCharts_chartEixoXMaximo = ""; // vazio - automático
	$includeCharts_chartEixoYMaximo = ""; // vazio - automático
	$includeCharts_chartEixoYIntervalo = "1"; //

    $includeCharts_chartTitulo = "";
    $includeCharts_chartTituloX = "";
    $includeCharts_chartTituloY = "";
    
    //$includeCharts_chartDados = "";
    $includeCharts_chartDados = "
    {label: 'apple', y: 50, color: '#ccc'},
    {label: 'orange', y: 15},
    {label: 'banana', y: 25},
    {label: 'mango', y: 30},
    {label: 'grape', y: 28}
    ";
    /*
    ex:
    {label: 'apple', y: 50, color: '#ccc'},
    {label: 'orange', y: 15},
    {label: 'banana', y: 25},
    {label: 'mango', y: 30},
    {label: 'grape', y: 28}
    
    $includeCharts_chartDados = "
    {label: 'apple', y: 50, color: '#ccc'},
    {label: 'orange', y: 15},
    {label: 'banana', y: 25},
    {label: 'mango', y: 30},
    {label: 'grape', y: 28}
    ";
    */
    $includeCharts_chartDadosMultiplos = "";
    ?>
    
    <?php include "IncludeCharts.php";?>
    
	<?php //iframe (para múltiplos gráficos na mesma página).?>
	<?php //Obs: talvez colocar essa opção como opção de diagação dentro do IncludeCharts.?>
    <?php
    $iFrameGraficoURL = "SiteCharts.php?masterPageSiteSelect=LayoutSiteIFrame.php";
    $iFrameGraficoURL .= "&includeCharts_chartID=" . $includeCharts_chartID;
    $iFrameGraficoURL .= "&includeCharts_chartTipo=" . $includeCharts_chartTipo;
    $iFrameGraficoURL .= "&includeCharts_chartEstilo=" . $includeCharts_chartEstilo;
    $iFrameGraficoURL .= "&includeCharts_chartW=" . $includeCharts_chartW;
    $iFrameGraficoURL .= "&includeCharts_chartH=" . $includeCharts_chartH;
    $iFrameGraficoURL .= "&includeCharts_chartBarraW=" . $includeCharts_chartBarraW;
    $iFrameGraficoURL .= "&includeCharts_chartCorBarraPadrao=" . urlencode($includeCharts_chartCorBarraPadrao);
    $iFrameGraficoURL .= "&includeCharts_chartCorTextos=" . urlencode($includeCharts_chartCorTextos);
    $iFrameGraficoURL .= "&includeCharts_chartCorGrafico=" . urlencode($includeCharts_chartCorGrafico);
    $iFrameGraficoURL .= "&includeCharts_chartLinhaGraficoXEspessura=" . $includeCharts_chartLinhaGraficoXEspessura;
    $iFrameGraficoURL .= "&includeCharts_chartLinhaGraficoYEspessura=" . $includeCharts_chartLinhaGraficoYEspessura;
    $iFrameGraficoURL .= "&includeCharts_chartEixoXMaximo=" . $includeCharts_chartEixoXMaximo;
    $iFrameGraficoURL .= "&includeCharts_chartEixoYMaximo=" . $includeCharts_chartEixoYMaximo;
	$iFrameGraficoURL .= "&includeCharts_chartEixoYIntervalo=" . $includeCharts_chartEixoYIntervalo;
    $iFrameGraficoURL .= "&includeCharts_chartTitulo=" . urlencode($includeCharts_chartTitulo);
    $iFrameGraficoURL .= "&includeCharts_chartTituloX" . urlencode($includeCharts_chartTituloX);
    $iFrameGraficoURL .= "&includeCharts_chartTituloY=" . urlencode($includeCharts_chartTituloY);
    $iFrameGraficoURL .= "&includeCharts_chartDados=" . urlencode($includeCharts_chartDados);
    $iFrameGraficoURL .= "&includeCharts_chartDadosMultiplos=" . urlencode($includeCharts_chartDadosMultiplos);
    ?>
    <!--iframe src="<?php echo $iFrameGraficoURL; ?>" scrolling="no" name="iframeChart1" frameborder="0" align="left" width="<?php echo $includeCharts_chartW; ?>" height="<?php echo $includeCharts_chartH; ?>">
    </iframe--> <?php //Funcionando.?>
    <?php //----------------------?>
<?php 
$pageSite->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php
//Inclusão do template do layout.
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>