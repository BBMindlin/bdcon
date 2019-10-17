<?php
//Importação dos arquivos de configuração.
require_once "../sistema/IncludeConfig.php"; //Deve vir antes do db.
require_once "../sistema/IncludeConexao.php";
require_once "../sistema/IncludeFuncoes.php";
//require_once "IncludeLayout.php";
require_once "IncludeLayoutSite.php";


//Resgate de variáveis.
$idTbProdutos = $_GET["idTbProdutos"];
$idParentProdutos = DbFuncoes::GetCampoGenerico01($idTbProdutos, "tb_produtos", "id_tb_categorias");

$idTbCadastroUsuarioLogado = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura(CookiesFuncoes::CookieValorLer()), 2);

$resultadoProdutosComplemento = DbFuncoes::TabelaGenericaFill01_FetchAll("tb_produtos_complemento", 
								NULL, 
								"complemento", 
								"");
$resultadoProdutosComplementoRelacao = DbFuncoes::FiltrosGenericosSelect02_FetchAll("tb_produtos_relacao_complemento", 
																					$idTbProdutos, 
																					"id_tb_produtos");

$tituloLinkAtual = "";
$tituloCategoriaAtual = DbFuncoes::GetCampoGenerico01($idParentProdutos, "tb_categorias", "categoria");
$metaTitulo = "";
$metaDescricao = "";
$metaPalavrasChave = "";

$paginaRetorno = "SiteProdutosDetalhes.php";
//$paginaRetornoExclusao = "SiteProdutosDetalhes.php";
$variavelRetorno = "idTbProdutos";
$idRetorno = $idTbProdutos;
//$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];
$mensagemAlerta = $_GET["mensagemAlerta"];


//Montagem de query padrão de retorno.
//"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
$queryPadrao = "&idParentProdutos=" . $idParentProdutos . 
"&idTbCadastroUsuario=" . $idTbCadastroUsuario . 
"&paginaRetorno=" . $paginaRetorno . 
"&masterPageSiteSelect=" . $masterPageSiteSelect . 
"&variavelRetorno=" . $variavelRetorno;
"&idRetorno=" . $idRetorno;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Query de pesquisa.
//----------
$strSqlProdutosDetalhesSelect = "";
$strSqlProdutosDetalhesSelect .= "SELECT ";
//$strSqlProdutosDetalhesSelect .= "* ";
$strSqlProdutosDetalhesSelect .= "id, ";
$strSqlProdutosDetalhesSelect .= "id_tb_categorias, ";
$strSqlProdutosDetalhesSelect .= "id_tb_cadastro_usuario, ";
$strSqlProdutosDetalhesSelect .= "data_produto, ";
$strSqlProdutosDetalhesSelect .= "cod_produto, ";
$strSqlProdutosDetalhesSelect .= "n_classificacao, ";
$strSqlProdutosDetalhesSelect .= "produto, ";
$strSqlProdutosDetalhesSelect .= "descricao01, ";
$strSqlProdutosDetalhesSelect .= "descricao02, ";
$strSqlProdutosDetalhesSelect .= "descricao03, ";
$strSqlProdutosDetalhesSelect .= "descricao04, ";
$strSqlProdutosDetalhesSelect .= "descricao05, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar1, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar2, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar3, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar4, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar5, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar6, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar7, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar8, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar9, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar10, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar11, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar12, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar13, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar14, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar15, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar16, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar17, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar18, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar19, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar20, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar21, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar22, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar23, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar24, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar25, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar26, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar27, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar28, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar29, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar30, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar31, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar32, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar33, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar34, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar35, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar36, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar37, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar38, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar39, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar40, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar41, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar42, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar43, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar44, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar45, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar46, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar47, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar48, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar49, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar50, ";
$strSqlProdutosDetalhesSelect .= "palavras_chave, ";
$strSqlProdutosDetalhesSelect .= "valor, ";
$strSqlProdutosDetalhesSelect .= "valor1, ";
$strSqlProdutosDetalhesSelect .= "valor2, ";
$strSqlProdutosDetalhesSelect .= "peso, ";
$strSqlProdutosDetalhesSelect .= "coeficiente, ";
$strSqlProdutosDetalhesSelect .= "estoque, ";
$strSqlProdutosDetalhesSelect .= "ativacao, ";
$strSqlProdutosDetalhesSelect .= "ativacao_promocao, ";
$strSqlProdutosDetalhesSelect .= "ativacao_home, ";
$strSqlProdutosDetalhesSelect .= "ativacao_home_categoria, ";
$strSqlProdutosDetalhesSelect .= "acesso_restrito, ";
$strSqlProdutosDetalhesSelect .= "n_questoes_aprovacao, ";
$strSqlProdutosDetalhesSelect .= "id_tb_produtos_status, ";
$strSqlProdutosDetalhesSelect .= "imagem, ";
$strSqlProdutosDetalhesSelect .= "anotacoes_internas, ";
$strSqlProdutosDetalhesSelect .= "n_visitas ";
$strSqlProdutosDetalhesSelect .= "FROM tb_produtos ";
$strSqlProdutosDetalhesSelect .= "WHERE id <> 0 ";
//$strSqlProdutosDetalhesSelect .= "AND id_tb_categorias = :id_tb_categorias ";
$strSqlProdutosDetalhesSelect .= "AND id = :id ";
//$strSqlProdutosDetalhesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";


//Parâmetros.
//----------
$statementProdutosDetalhesSelect = $dbSistemaConPDO->prepare($strSqlProdutosDetalhesSelect);

if ($statementProdutosDetalhesSelect !== false)
{
	$statementProdutosDetalhesSelect->execute(array(
		"id" => $idTbProdutos
	));
}
//----------


//Definição das variáveis de detalhes.
//----------
//$resultadoProdutosDetalhes = $dbSistemaConPDO->query($strSqlProdutosDetalhesSelect);
$resultadoProdutosDetalhes = $statementProdutosDetalhesSelect->fetchAll();

if(empty($resultadoProdutosDetalhes))
{
	//echo "Nenhum registro encontrado";
}else{
	foreach($resultadoProdutosDetalhes as $linhaProdutosDetalhes)
	{
		//Definição das variáveis de detalhes.
		$tbProdutosId = $linhaProdutosDetalhes['id'];
		$tbProdutosIdTbCategorias = $linhaProdutosDetalhes['id_tb_categorias'];
		$tbProdutosIdTbCadastroUsuario = $linhaProdutosDetalhes['id_tb_cadastro_usuario'];
		//$tbProdutosDataProduto = Funcoes::DataLeitura01($linhaProdutosDetalhes['data_produto'], $GLOBALS['configSistemaFormatoData'], "1");
		if($linhaProdutosDetalhes['data_produto'] == NULL)
		{
			$tbProdutosDataProduto = "";
		}else{
			$tbProdutosDataProduto = Funcoes::DataLeitura01($linhaProdutosDetalhes['data_produto'], $GLOBALS['configSiteFormatoData'], "1");
		}
		$tbProdutosCodProduto = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['cod_produto']);
		$tbProdutosNClassificacao = $linhaProdutosDetalhes['n_classificacao'];

		$tbProdutosProduto = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['produto']);
		$tbProdutosDescricao01 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['descricao01']);
		$tbProdutosDescricao02 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['descricao02']);
		$tbProdutosDescricao03 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['descricao03']);
		$tbProdutosDescricao04 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['descricao04']);
		$tbProdutosDescricao05 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['descricao05']);

		$tbProdutosIC1 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar1']);
		$tbProdutosIC2 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar2']);
		$tbProdutosIC3 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar3']);
		$tbProdutosIC4 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar4']);
		$tbProdutosIC5 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar5']);
		$tbProdutosIC6 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar6']);
		$tbProdutosIC7 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar7']);
		$tbProdutosIC8 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar8']);
		$tbProdutosIC9 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar9']);
		$tbProdutosIC10 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar10']);
		$tbProdutosIC11 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar11']);
		$tbProdutosIC12 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar12']);
		$tbProdutosIC13 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar13']);
		$tbProdutosIC14 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar14']);
		$tbProdutosIC15 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar15']);
		$tbProdutosIC16 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar16']);
		$tbProdutosIC17 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar17']);
		$tbProdutosIC18 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar18']);
		$tbProdutosIC19 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar19']);
		$tbProdutosIC20 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar20']);
		$tbProdutosIC21 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar21']);
		$tbProdutosIC22 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar22']);
		$tbProdutosIC23 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar23']);
		$tbProdutosIC24 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar24']);
		$tbProdutosIC25 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar25']);
		$tbProdutosIC26 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar26']);
		$tbProdutosIC27 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar27']);
		$tbProdutosIC28 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar28']);
		$tbProdutosIC29 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar29']);
		$tbProdutosIC30 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar30']);
		$tbProdutosIC31 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar31']);
		$tbProdutosIC32 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar32']);
		$tbProdutosIC33 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar33']);
		$tbProdutosIC34 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar34']);
		$tbProdutosIC35 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar35']);
		$tbProdutosIC36 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar36']);
		$tbProdutosIC37 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar37']);
		$tbProdutosIC38 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar38']);
		$tbProdutosIC39 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar39']);
		$tbProdutosIC40 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar40']);
		$tbProdutosIC41 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar41']);
		$tbProdutosIC42 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar42']);
		$tbProdutosIC43 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar43']);
		$tbProdutosIC44 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar44']);
		$tbProdutosIC45 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar45']);
		$tbProdutosIC46 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar46']);
		$tbProdutosIC47 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar47']);
		$tbProdutosIC48 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar48']);
		$tbProdutosIC49 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar49']);
		$tbProdutosIC50 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar50']);

		$tbProdutosPalavrasChave = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['palavras_chave']);
		$tbProdutosValor = Funcoes::MascaraValorLer($linhaProdutosDetalhes['valor'], $GLOBALS['configSistemaMoeda']);
		$tbProdutosValor1 = Funcoes::MascaraValorLer($linhaProdutosDetalhes['valor1'], $GLOBALS['configSistemaMoeda']);
		$tbProdutosValor2 = Funcoes::MascaraValorLer($linhaProdutosDetalhes['valor2'], $GLOBALS['configSistemaMoeda']);
		//$tbProdutosPeso = Funcoes::MascaraValorLer($linhaProdutosDetalhes['peso'], $GLOBALS['configSistemaMoeda']);
		$tbProdutosPeso = $linhaProdutosDetalhes['peso'];
		
		//$tbProdutosCoeficiente = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['coeficiente']);
		//$tbProdutosCoeficiente = Funcoes::MascaraValorLer($linhaProdutosDetalhes['coeficiente'], $GLOBALS['configSistemaMoeda']);
		$tbProdutosCoeficiente = $linhaProdutosDetalhes['coeficiente'];
		$tbProdutosEstoque = $linhaProdutosDetalhes['estoque'];
		$tbProdutosAtivacao = $linhaProdutosDetalhes['ativacao'];
		$tbProdutosAtivacaoPromocao = $linhaProdutosDetalhes['ativacao_promocao'];
		$tbProdutosAtivacaoHome = $linhaProdutosDetalhes['ativacao_home'];
		$tbProdutosAtivacaoHomeCategoria = $linhaProdutosDetalhes['ativacao_home_categoria'];
		$tbProdutosAcessoRestrito = $linhaProdutosDetalhes['acesso_restrito'];
		
		$tbProdutosNQuestoesAprovacao = $linhaProdutosDetalhes['n_questoes_aprovacao'];
		$tbProdutosIdTbProdutosStatus = $linhaProdutosDetalhes['id_tb_produtos_status'];
		if($tbProdutosIdTbProdutosStatus <> 0)
		{
			$tbProdutosIdTbProdutosStatusPrint = DbFuncoes::GetCampoGenerico01($tbProdutosIdTbProdutosStatus, "tb_produtos_complemento", "complemento");
		}
		$tbProdutosImagem = $linhaProdutosDetalhes['imagem'];
		$tbProdutosAnotacoesInternas = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['anotacoes_internas']);
		$tbProdutosNVisitas = $linhaProdutosDetalhes['n_visitas'];
		//Verificação de erro.
		//echo "tbProdutosId=" . $tbProdutosId . "<br>";
		//echo "tbProdutosProcesso=" . $tbProdutosProcesso . "<br>";
		
	}
}
//----------


//Definição de variáveis.
$tituloLinkAtual = Funcoes::RemoverHTML01($tbProdutosProduto);


//Montagem das meta tags.
//----------
$metaTitulo = $tituloLinkAtual . " - " . Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloSite'], "IncludeConfig");
$metaTitulo = Funcoes::LimitadorCatecteres(Funcoes::RemoverHTML01($metaTitulo), 60);

$metaDescricao = Funcoes::RemoverHTML01($tbProdutosDescricao01);
$metaPalavrasChave = Funcoes::RemoverHTML01($tbProdutosPalavrasChave);
//----------


//Verificação de erro - debug.
//echo "idTemporario=" . Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura(CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroTemporario")), 2) . "<br>";
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo $metaTitulo; ?>
<?php 
$pageSite->cphTitle = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Head.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphHead*/ ?>
    <meta name="title" content="<?php echo $metaTitulo; ?>" /><?php //Abaixo de 60 caracteres.?>
    <meta name="description" content="<?php echo $metaDescricao; ?>" /><?php //Abaixo de 160 caracteres.?>
    <meta name="keywords" content="<?php echo $metaPalavrasChave; ?>" /><?php //Abaixo de 100 caracteres.?>
    
    <meta property="og:title" content="<?php echo Funcoes::LimitadorCatecteres($metaTitulo, 35); ?>" /> <?php //35 caracteres.?>
    <meta property="og:url" content="<?php echo $configUrl . "/" . $visualizacaoAtivaSistema . "/SiteProdutosDetalhes.php?idTbProdutos=" . $idTbProdutos; ?>" />
    <meta property="og:description" content="<?php echo $metaDescricao; ?>"><?php //155 caracteres - Funcoes.LimitadorCatecteres($metaDescricao, 155).?>
    <?php if($tbProdutosImagem <> ""){ ?>
    <meta property="og:image" content="<?php echo $configUrl . "/" . $configDiretorioSistema . "/" . $configDiretorioArquivosVisualizacao . "/r" . $tbProdutosImagem; ?>"><?php //JPG ou PNG, menos que 300k e dimensão mínima de 300x200 pixels.?>
    <?php } ?>
    <meta property="og:image:alt" content="<?php echo $metaTitulo; ?>" />
    <meta property="og:type" content="product.item" /><?php //referencias de tipos: https://developers.facebook.com/docs/reference/opengraph/.?>

    <meta property="og:locale" content="pt_BR" />
    <!--meta property="og:locale:alternate" content="fr_FR" /--><?php //Idiomas adicionais.?>
    <!--meta property="og:locale:alternate" content="es_ES" /-->

    <!--
    Twitter: https://developer.twitter.com/en/docs/tweets/optimize-with-cards/guides/getting-started
    Áudio/Vídeo: http://ogp.me/
    Favicon: https://stackoverflow.com/questions/2268204/favicon-dimensions/43154399#43154399
    -->
<?php 
$pageSite->cphHead = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Título atual.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphConteudoCabecalho*/ ?>
	<?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteTarefasTitulo"); ?>
	<?php echo $tituloLinkAtual; ?>
<?php 
$pageSite->cphTituloLinkAtual = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Conteúdo principal.?>
<?php //**************************************************************************************?>
<?php ob_start(); /*cphConteudoPrincipal*/ ?>
    <div id="lblMensagemErro" align="center" class="AdmErro">
        <?php echo $mensagemErro;?>
    </div>
    <div id="lblMensagemSucesso" align="center" class="AdmSucesso">
        <?php echo $mensagemSucesso;?>
    </div>
    <div id="lblMensagemAlerta" align="center" class="AdmAlerta">
        <?php echo $mensagemAlerta;?>
    </div>
    
    
	<?php //Diagramação 1.?>
    <?php //**************************************************************************************?>
    <div align="center" style="position: relative; display: block;">
    	
		<?php //Imagem Principal.?>
        <?php if($tbProdutosImagem <> ""){ ?>
            <div align="center">
                <?php //SlimBox 2 - JQuery.?>
                <?php if($GLOBALS['configImagemPopUp'] == "1"){ ?>
                    <div class="ProdutosImagemDetalhes"><a href="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>g<?php echo $tbProdutosImagem;?>" rel="lightbox" title="<?php echo $tbProdutosProduto; ?>"><img src="<?php echo $GLOBALS['configCaminhoSiteImagens'];?><?php echo $tbProdutosImagem;?>" alt="<?php echo $tbProdutosProduto; ?>" /></a></div>
                <?php } ?>
                
                <?php //Pop-up div com comentários.?>
                <?php if($GLOBALS['configImagemPopUp'] == "2"){ ?>

                <?php } ?>
            </div>
        <?php } ?>
        
        <table border="0" cellspacing="4" cellpadding="0">
            <tr valign="top">
                <td>
                    <div class="ProdutosDetalhesConteudo">
                        <strong>
                             <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosData");?>: 
                        </strong>
                    </div>
                </td>
                <td>
                    <div align="left" class="ProdutosDetalhesConteudo">
                    	<?php echo $tbProdutosDataProduto;?>
                    </div>
                </td>
            </tr>
    
            <tr valign="top">
                <td>
                    <div class="ProdutosDetalhesConteudo">
                        <strong>
                             <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosCodigo");?>: 
                        </strong>
                    </div>
                </td>
                <td>
                    <div align="left" class="ProdutosDetalhesConteudo">
                    	<?php echo $tbProdutosCodProduto;?>
                    </div>
                </td>
            </tr>
    
            <?php if($GLOBALS['habilitarProdutosTipo'] == "1"){ ?>
                <tr valign="top">
                    <td>
                        <div class="ProdutosDetalhesConteudo">
                            <strong>
							    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosTipo");?>: 
                            </strong>
                        </div>
                    </td>
                    <td>
                        <div align="left" class="ProdutosDetalhesConteudo">

                        </div>
                    </td>
                </tr>
            <?php } ?>
    
            <tr valign="top">
                <td>
                    <div class="ProdutosDetalhesConteudo">
                        <strong>
                             <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProduto");?>: 
                        </strong>
                    </div>
                </td>
                <td>
                    <div align="left" class="ProdutosDetalhesConteudo"><?php //class="ProdutosDetalhesTitulo" ?>
                        <h2 style="padding: 0px; margin: 0px; font-size: inherit;">
							<?php echo $tbProdutosProduto;?>
                        </h2>
                    </div>
                </td>
            </tr>
    
            <?php if($GLOBALS['habilitarProdutosValor'] == "1"){ ?>
                <tr valign="top">
                    <td>
                        <div class="ProdutosDetalhesConteudo">
                            <strong>
								 <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosValor");?>: 
                            </strong>
                        </div>
                    </td>
                    <td>
                        <div align="left" class="ProdutosDetalhesConteudo">
                        	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig");?> 
                            <?php echo $tbProdutosValor;?>
                        </div>
                    </td>
                </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosValor1'] == "1"){ ?>
                <tr valign="top">
                    <td>
                        <div class="ProdutosDetalhesConteudo">
                            <strong>
								 <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosValor1Nome'], "IncludeConfig");?>: 
                            </strong>
                        </div>
                    </td>
                    <td>
                        <div align="left" class="ProdutosDetalhesConteudo">
                        	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosValor1Moeda'], "IncludeConfig"); ?> 
                            <?php echo $tbProdutosValor1;?>
                        </div>
                    </td>
                </tr>
            <?php } ?>
    
            <?php if($GLOBALS['habilitarProdutosPeso'] == "1"){ ?>
                <tr valign="top">
                    <td>
                        <div class="ProdutosDetalhesConteudo">
                            <strong>
								 <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosPeso");?>: 
                            </strong>
                        </div>
                    </td>
                    <td>
                        <div align="left" class="ProdutosDetalhesConteudo">
                            <?php echo $tbProdutosPeso;?>
                        	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaPeso'], "IncludeConfig");?> 
                        </div>
                    </td>
                </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarProdutosStatus'] == "1"){ ?>
                <tr valign="top">
                    <td>
                        <div class="ProdutosDetalhesConteudo">
                            <strong>
								 <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosStatus");?>: 
                            </strong>
                        </div>
                    </td>
                    <td>
                        <div align="left" class="ProdutosDetalhesConteudo">
                            <?php //echo $tbProdutosIdTbProdutosStatus;?>
                            <?php echo $tbProdutosIdTbProdutosStatusPrint;?>
                        </div>
                    </td>
                </tr>
            <?php } ?>
    
            <?php if($GLOBALS['habilitarProdutosDescricao01'] == "1"){ ?>
				<?php if($tbProdutosDescricao01 <> ""){ ?>
                    <tr valign="top">
                        <td>
                            <div class="ProdutosDetalhesConteudo">
                                <strong>
                                     <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosDescricao01Titulo'], "IncludeConfig"); ?>: 
                                </strong>
                            </div>
                        </td>
                        <td>
                            <div align="left" class="ProdutosDetalhesConteudo">
                                <?php echo $tbProdutosDescricao01;?>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            <?php } ?>
        </table>
    </div>
    <?php //**************************************************************************************?>
    
    
	<?php //Filtros Genéricos. ?>
    <?php //************************************************************************************** ?>
    <?php if($GLOBALS['habilitarProdutosFiltroGenerico01'] == 1){ ?>
		<?php //if($xxx <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico01Nome'], "IncludeConfig"); ?>: 
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
					<?php
                    //Loop pelos resultados.
                    foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                    {
                    ?>
                        <div>
                            <?php if($linhaProdutosComplemento["tipo_complemento"] == "12"){ ?> 
								<?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                    - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php //} ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosFiltroGenerico02'] == 1){ ?>
		<?php //if($xxx <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico02Nome'], "IncludeConfig"); ?>: 
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
					<?php
                    //Loop pelos resultados.
                    foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                    {
                    ?>
                        <div>
                            <?php if($linhaProdutosComplemento["tipo_complemento"] == "13"){ ?> 
								<?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                    - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php //} ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosFiltroGenerico03'] == 1){ ?>
		<?php //if($xxx <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico03Nome'], "IncludeConfig"); ?>: 
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
					<?php
                    //Loop pelos resultados.
                    foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                    {
                    ?>
                        <div>
                            <?php if($linhaProdutosComplemento["tipo_complemento"] == "14"){ ?> 
								<?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                    - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php //} ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosFiltroGenerico04'] == 1){ ?>
		<?php //if($xxx <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico04Nome'], "IncludeConfig"); ?>: 
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
					<?php
                    //Loop pelos resultados.
                    foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                    {
                    ?>
                        <div>
                            <?php if($linhaProdutosComplemento["tipo_complemento"] == "15"){ ?> 
								<?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                    - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php //} ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosFiltroGenerico05'] == 1){ ?>
		<?php //if($xxx <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico05Nome'], "IncludeConfig"); ?>: 
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
					<?php
                    //Loop pelos resultados.
                    foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                    {
                    ?>
                        <div>
                            <?php if($linhaProdutosComplemento["tipo_complemento"] == "16"){ ?> 
								<?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                    - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php //} ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosFiltroGenerico06'] == 1){ ?>
		<?php //if($xxx <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico06Nome'], "IncludeConfig"); ?>: 
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
					<?php
                    //Loop pelos resultados.
                    foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                    {
                    ?>
                        <div>
                            <?php if($linhaProdutosComplemento["tipo_complemento"] == "17"){ ?> 
								<?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                    - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php //} ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosFiltroGenerico07'] == 1){ ?>
		<?php //if($xxx <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico07Nome'], "IncludeConfig"); ?>: 
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
					<?php
                    //Loop pelos resultados.
                    foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                    {
                    ?>
                        <div>
                            <?php if($linhaProdutosComplemento["tipo_complemento"] == "18"){ ?> 
								<?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                    - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php //} ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosFiltroGenerico08'] == 1){ ?>
		<?php //if($xxx <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico08Nome'], "IncludeConfig"); ?>: 
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
					<?php
                    //Loop pelos resultados.
                    foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                    {
                    ?>
                        <div>
                            <?php if($linhaProdutosComplemento["tipo_complemento"] == "19"){ ?> 
								<?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                    - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php //} ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosFiltroGenerico09'] == 1){ ?>
		<?php //if($xxx <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico09Nome'], "IncludeConfig"); ?>: 
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
					<?php
                    //Loop pelos resultados.
                    foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                    {
                    ?>
                        <div>
                            <?php if($linhaProdutosComplemento["tipo_complemento"] == "20"){ ?> 
								<?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                    - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php //} ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosFiltroGenerico10'] == 1){ ?>
		<?php //if($xxx <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico10Nome'], "IncludeConfig"); ?>: 
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
					<?php
                    //Loop pelos resultados.
                    foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                    {
                    ?>
                        <div>
                            <?php if($linhaProdutosComplemento["tipo_complemento"] == "21"){ ?> 
								<?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                    - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php //} ?>
    <?php } ?>
    
    <?php if($GLOBALS['habilitarProdutosFiltroGenerico11'] == 1){ ?>
		<?php //if($xxx <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico11Nome'], "IncludeConfig"); ?>: 
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
					<?php
                    //Loop pelos resultados.
                    foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                    {
                    ?>
                        <div>
                            <?php if($linhaProdutosComplemento["tipo_complemento"] == "22"){ ?> 
								<?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                    - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php //} ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosFiltroGenerico12'] == 1){ ?>
		<?php //if($xxx <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico12Nome'], "IncludeConfig"); ?>: 
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
					<?php
                    //Loop pelos resultados.
                    foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                    {
                    ?>
                        <div>
                            <?php if($linhaProdutosComplemento["tipo_complemento"] == "23"){ ?> 
								<?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                    - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php //} ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosFiltroGenerico13'] == 1){ ?>
		<?php //if($xxx <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico13Nome'], "IncludeConfig"); ?>: 
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
					<?php
                    //Loop pelos resultados.
                    foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                    {
                    ?>
                        <div>
                            <?php if($linhaProdutosComplemento["tipo_complemento"] == "24"){ ?> 
								<?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                    - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php //} ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosFiltroGenerico14'] == 1){ ?>
		<?php //if($xxx <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico14Nome'], "IncludeConfig"); ?>: 
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
					<?php
                    //Loop pelos resultados.
                    foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                    {
                    ?>
                        <div>
                            <?php if($linhaProdutosComplemento["tipo_complemento"] == "25"){ ?> 
								<?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                    - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php //} ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosFiltroGenerico15'] == 1){ ?>
		<?php //if($xxx <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico15Nome'], "IncludeConfig"); ?>: 
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
					<?php
                    //Loop pelos resultados.
                    foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                    {
                    ?>
                        <div>
                            <?php if($linhaProdutosComplemento["tipo_complemento"] == "26"){ ?> 
								<?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                    - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php //} ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosFiltroGenerico16'] == 1){ ?>
		<?php //if($xxx <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico16Nome'], "IncludeConfig"); ?>: 
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
					<?php
                    //Loop pelos resultados.
                    foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                    {
                    ?>
                        <div>
                            <?php if($linhaProdutosComplemento["tipo_complemento"] == "27"){ ?> 
								<?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                    - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php //} ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosFiltroGenerico17'] == 1){ ?>
		<?php //if($xxx <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico17Nome'], "IncludeConfig"); ?>: 
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
					<?php
                    //Loop pelos resultados.
                    foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                    {
                    ?>
                        <div>
                            <?php if($linhaProdutosComplemento["tipo_complemento"] == "28"){ ?> 
								<?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                    - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php //} ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosFiltroGenerico18'] == 1){ ?>
		<?php //if($xxx <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico18Nome'], "IncludeConfig"); ?>: 
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
					<?php
                    //Loop pelos resultados.
                    foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                    {
                    ?>
                        <div>
                            <?php if($linhaProdutosComplemento["tipo_complemento"] == "29"){ ?> 
								<?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                    - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php //} ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosFiltroGenerico19'] == 1){ ?>
		<?php //if($xxx <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico19Nome'], "IncludeConfig"); ?>: 
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
					<?php
                    //Loop pelos resultados.
                    foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                    {
                    ?>
                        <div>
                            <?php if($linhaProdutosComplemento["tipo_complemento"] == "30"){ ?> 
								<?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                    - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php //} ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosFiltroGenerico20'] == 1){ ?>
		<?php //if($xxx <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico20Nome'], "IncludeConfig"); ?>: 
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
					<?php
                    //Loop pelos resultados.
                    foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                    {
                    ?>
                        <div>
                            <?php if($linhaProdutosComplemento["tipo_complemento"] == "31"){ ?> 
								<?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                    - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php //} ?>
    <?php } ?>
    
    <?php if($GLOBALS['habilitarProdutosFiltroGenerico21'] == 1){ ?>
		<?php //if($xxx <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico21Nome'], "IncludeConfig"); ?>: 
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
					<?php
                    //Loop pelos resultados.
                    foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                    {
                    ?>
                        <div>
                            <?php if($linhaProdutosComplemento["tipo_complemento"] == "32"){ ?> 
								<?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                    - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php //} ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosFiltroGenerico22'] == 1){ ?>
		<?php //if($xxx <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico22Nome'], "IncludeConfig"); ?>: 
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
					<?php
                    //Loop pelos resultados.
                    foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                    {
                    ?>
                        <div>
                            <?php if($linhaProdutosComplemento["tipo_complemento"] == "33"){ ?> 
								<?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                    - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php //} ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosFiltroGenerico23'] == 1){ ?>
		<?php //if($xxx <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico23Nome'], "IncludeConfig"); ?>: 
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
					<?php
                    //Loop pelos resultados.
                    foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                    {
                    ?>
                        <div>
                            <?php if($linhaProdutosComplemento["tipo_complemento"] == "34"){ ?> 
								<?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                    - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php //} ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosFiltroGenerico24'] == 1){ ?>
		<?php //if($xxx <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico24Nome'], "IncludeConfig"); ?>: 
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
					<?php
                    //Loop pelos resultados.
                    foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                    {
                    ?>
                        <div>
                            <?php if($linhaProdutosComplemento["tipo_complemento"] == "35"){ ?> 
								<?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                    - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php //} ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosFiltroGenerico25'] == 1){ ?>
		<?php //if($xxx <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico25Nome'], "IncludeConfig"); ?>: 
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
					<?php
                    //Loop pelos resultados.
                    foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                    {
                    ?>
                        <div>
                            <?php if($linhaProdutosComplemento["tipo_complemento"] == "36"){ ?> 
								<?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                    - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php //} ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosFiltroGenerico26'] == 1){ ?>
		<?php //if($xxx <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico26Nome'], "IncludeConfig"); ?>: 
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
					<?php
                    //Loop pelos resultados.
                    foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                    {
                    ?>
                        <div>
                            <?php if($linhaProdutosComplemento["tipo_complemento"] == "37"){ ?> 
								<?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                    - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php //} ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosFiltroGenerico27'] == 1){ ?>
		<?php //if($xxx <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico27Nome'], "IncludeConfig"); ?>: 
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
					<?php
                    //Loop pelos resultados.
                    foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                    {
                    ?>
                        <div>
                            <?php if($linhaProdutosComplemento["tipo_complemento"] == "38"){ ?> 
								<?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                    - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php //} ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosFiltroGenerico28'] == 1){ ?>
		<?php //if($xxx <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico28Nome'], "IncludeConfig"); ?>: 
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
					<?php
                    //Loop pelos resultados.
                    foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                    {
                    ?>
                        <div>
                            <?php if($linhaProdutosComplemento["tipo_complemento"] == "39"){ ?> 
								<?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                    - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php //} ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosFiltroGenerico29'] == 1){ ?>
		<?php //if($xxx <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico29Nome'], "IncludeConfig"); ?>: 
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
					<?php
                    //Loop pelos resultados.
                    foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                    {
                    ?>
                        <div>
                            <?php if($linhaProdutosComplemento["tipo_complemento"] == "40"){ ?> 
								<?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                    - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php //} ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosFiltroGenerico30'] == 1){ ?>
		<?php //if($xxx <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico30Nome'], "IncludeConfig"); ?>: 
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
					<?php
                    //Loop pelos resultados.
                    foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                    {
                    ?>
                        <div>
                            <?php if($linhaProdutosComplemento["tipo_complemento"] == "41"){ ?> 
								<?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                    - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php //} ?>
    <?php } ?>
    <?php //************************************************************************************** ?>


	<?php //Descrições. ?>
    <?php //************************************************************************************** ?>
    <?php if($GLOBALS['habilitarProdutosDescricao01'] == "1"){ ?>
        <?php if($tbProdutosDescricao01 <> ""){ ?>
            <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosDescricao01Titulo'], "IncludeConfig"); ?>: 
            </div>
            <div align="justify" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
                <?php echo $tbProdutosDescricao01;?>
            </div>
            <div class="ProdutosDetalhesConteudoSeparador">
            </div>
        <?php } ?>
    <?php } ?>
    
    <?php if($GLOBALS['habilitarProdutosDescricao02'] == "1"){ ?>
        <?php if($tbProdutosDescricao02 <> ""){ ?>
            <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosDescricao02Titulo'], "IncludeConfig"); ?>: 
            </div>
            <div align="justify" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
                <?php echo $tbProdutosDescricao02;?>
            </div>
            <div class="ProdutosDetalhesConteudoSeparador">
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosDescricao03'] == "1"){ ?>
        <?php if($tbProdutosDescricao03 <> ""){ ?>
            <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosDescricao03Titulo'], "IncludeConfig"); ?>: 
            </div>
            <div align="justify" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
                <?php echo $tbProdutosDescricao03;?>
            </div>
            <div class="ProdutosDetalhesConteudoSeparador">
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosDescricao04'] == "1"){ ?>
        <?php if($tbProdutosDescricao04 <> ""){ ?>
            <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosDescricao04Titulo'], "IncludeConfig"); ?>: 
            </div>
            <div align="justify" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
                <?php echo $tbProdutosDescricao04;?>
            </div>
            <div class="ProdutosDetalhesConteudoSeparador">
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosDescricao05'] == "1"){ ?>
        <?php if($tbProdutosDescricao05 <> ""){ ?>
            <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosDescricao05Titulo'], "IncludeConfig"); ?>: 
            </div>
            <div align="justify" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
                <?php echo $tbProdutosDescricao05;?>
            </div>
            <div class="ProdutosDetalhesConteudoSeparador">
            </div>
        <?php } ?>
    <?php } ?>
    <?php //************************************************************************************** ?>

    
	<?php //Informações complementares. ?>
    <?php //************************************************************************************** ?>
    <?php if($GLOBALS['habilitarProdutosIc1'] == 1){ ?>
		<?php if($tbProdutosIC1 <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc1'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
                    <?php echo $tbProdutosIC1;?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosIc2'] == 1){ ?>
		<?php if($tbProdutosIC2 <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc2'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
                    <?php echo $tbProdutosIC2;?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosIc3'] == 1){ ?>
		<?php if($tbProdutosIC3 <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc3'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
                    <?php echo $tbProdutosIC3;?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosIc4'] == 1){ ?>
		<?php if($tbProdutosIC4 <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc4'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
                    <?php echo $tbProdutosIC4;?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosIc5'] == 1){ ?>
		<?php if($tbProdutosIC5 <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc5'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
                    <?php echo $tbProdutosIC5;?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosIc6'] == 1){ ?>
		<?php if($tbProdutosIC6 <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc6'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
                    <?php echo $tbProdutosIC6;?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosIc7'] == 1){ ?>
		<?php if($tbProdutosIC7 <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc7'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
                    <?php echo $tbProdutosIC7;?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosIc8'] == 1){ ?>
		<?php if($tbProdutosIC8 <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc8'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
                    <?php echo $tbProdutosIC8;?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosIc9'] == 1){ ?>
		<?php if($tbProdutosIC9 <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc9'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
                    <?php echo $tbProdutosIC9;?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosIc10'] == 1){ ?>
		<?php if($tbProdutosIC10 <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc10'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
                    <?php echo $tbProdutosIC10;?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>
    
    <?php if($GLOBALS['habilitarProdutosIc11'] == 1){ ?>
		<?php if($tbProdutosIC11 <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc11'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
                    <?php echo $tbProdutosIC11;?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosIc12'] == 1){ ?>
		<?php if($tbProdutosIC12 <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc12'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
                    <?php echo $tbProdutosIC12;?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosIc13'] == 1){ ?>
		<?php if($tbProdutosIC13 <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc13'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
                    <?php echo $tbProdutosIC13;?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosIc14'] == 1){ ?>
		<?php if($tbProdutosIC14 <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc14'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
                    <?php echo $tbProdutosIC14;?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosIc15'] == 1){ ?>
		<?php if($tbProdutosIC15 <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc15'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
                    <?php echo $tbProdutosIC15;?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosIc16'] == 1){ ?>
		<?php if($tbProdutosIC16 <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc16'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
                    <?php echo $tbProdutosIC16;?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosIc17'] == 1){ ?>
		<?php if($tbProdutosIC17 <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc17'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
                    <?php echo $tbProdutosIC17;?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosIc18'] == 1){ ?>
		<?php if($tbProdutosIC18 <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc18'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
                    <?php echo $tbProdutosIC18;?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosIc19'] == 1){ ?>
		<?php if($tbProdutosIC19 <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc19'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
                    <?php echo $tbProdutosIC19;?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosIc20'] == 1){ ?>
		<?php if($tbProdutosIC20 <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc20'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
                    <?php echo $tbProdutosIC20;?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>
    
    <?php if($GLOBALS['habilitarProdutosIc21'] == 1){ ?>
		<?php if($tbProdutosIC21 <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc21'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
                    <?php echo $tbProdutosIC21;?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosIc22'] == 1){ ?>
		<?php if($tbProdutosIC22 <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc22'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
                    <?php echo $tbProdutosIC22;?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosIc23'] == 1){ ?>
		<?php if($tbProdutosIC23 <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc23'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
                    <?php echo $tbProdutosIC23;?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosIc24'] == 1){ ?>
		<?php if($tbProdutosIC24 <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc24'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
                    <?php echo $tbProdutosIC24;?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosIc25'] == 1){ ?>
		<?php if($tbProdutosIC25 <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc25'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
                    <?php echo $tbProdutosIC25;?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosIc26'] == 1){ ?>
		<?php if($tbProdutosIC26 <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc26'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
                    <?php echo $tbProdutosIC26;?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosIc27'] == 1){ ?>
		<?php if($tbProdutosIC27 <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc27'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
                    <?php echo $tbProdutosIC27;?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosIc28'] == 1){ ?>
		<?php if($tbProdutosIC28 <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc28'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
                    <?php echo $tbProdutosIC28;?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosIc29'] == 1){ ?>
		<?php if($tbProdutosIC29 <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc29'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
                    <?php echo $tbProdutosIC29;?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosIc30'] == 1){ ?>
		<?php if($tbProdutosIC30 <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc30'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
                    <?php echo $tbProdutosIC30;?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>
    
    <?php if($GLOBALS['habilitarProdutosIc31'] == 1){ ?>
		<?php if($tbProdutosIC31 <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc31'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
                    <?php echo $tbProdutosIC31;?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosIc32'] == 1){ ?>
		<?php if($tbProdutosIC32 <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc32'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
                    <?php echo $tbProdutosIC32;?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosIc33'] == 1){ ?>
		<?php if($tbProdutosIC33 <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc33'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
                    <?php echo $tbProdutosIC33;?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosIc34'] == 1){ ?>
		<?php if($tbProdutosIC34 <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc34'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
                    <?php echo $tbProdutosIC34;?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosIc35'] == 1){ ?>
		<?php if($tbProdutosIC35 <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc35'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
                    <?php echo $tbProdutosIC35;?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosIc36'] == 1){ ?>
		<?php if($tbProdutosIC36 <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc36'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
                    <?php echo $tbProdutosIC36;?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosIc37'] == 1){ ?>
		<?php if($tbProdutosIC37 <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc37'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
                    <?php echo $tbProdutosIC37;?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosIc38'] == 1){ ?>
		<?php if($tbProdutosIC38 <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc38'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
                    <?php echo $tbProdutosIC38;?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosIc39'] == 1){ ?>
		<?php if($tbProdutosIC39 <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc39'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
                    <?php echo $tbProdutosIC39;?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosIc40'] == 1){ ?>
		<?php if($tbProdutosIC40 <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc40'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
                    <?php echo $tbProdutosIC40;?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>
    
    <?php if($GLOBALS['habilitarProdutosIc41'] == 1){ ?>
		<?php if($tbProdutosIC41 <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc41'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
                    <?php echo $tbProdutosIC41;?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosIc42'] == 1){ ?>
		<?php if($tbProdutosIC42 <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc42'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
                    <?php echo $tbProdutosIC42;?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosIc43'] == 1){ ?>
		<?php if($tbProdutosIC43 <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc43'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
                    <?php echo $tbProdutosIC43;?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosIc44'] == 1){ ?>
		<?php if($tbProdutosIC44 <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc44'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
                    <?php echo $tbProdutosIC44;?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosIc45'] == 1){ ?>
		<?php if($tbProdutosIC45 <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc45'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
                    <?php echo $tbProdutosIC45;?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosIc46'] == 1){ ?>
		<?php if($tbProdutosIC46 <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc46'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
                    <?php echo $tbProdutosIC46;?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosIc47'] == 1){ ?>
		<?php if($tbProdutosIC47 <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc47'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
                    <?php echo $tbProdutosIC47;?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosIc48'] == 1){ ?>
		<?php if($tbProdutosIC48 <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc48'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
                    <?php echo $tbProdutosIC48;?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosIc49'] == 1){ ?>
		<?php if($tbProdutosIC49 <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc49'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
                    <?php echo $tbProdutosIC49;?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarProdutosIc50'] == 1){ ?>
		<?php if($tbProdutosIC50 <> ""){ ?>
            <div class="ProdutosDetalhesConteudoDivFileira01">
                <div class="ProdutosDetalhesSubtitulo ProdutosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc50'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="ProdutosDetalhesConteudo ProdutosDetalhesConteudoDiv">
                    <?php echo $tbProdutosIC50;?>
                </div>
                <div class="ProdutosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>
    <?php //************************************************************************************** ?>
    
    
	<?php //Diagramação 3 - tabela adm.?>
    <?php //**************************************************************************************?>
    <div align="center" class="AdmTexto01" style="position: relative; display: block; overflow: hidden;">
        <table class="AdmTabelaCampos01">
            <tr>
                <td class="AdmTbFundoEscuro" colspan="4">
                    <div align="center" class="AdmTexto02">
                        <strong>
                            Detalhes
                        </strong>
                    </div>
                </td>
            </tr>
            
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosData"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbProdutosDataProduto;?>
                    </div>
                </td>
            </tr>
            
			<?php //if($tbProdutosCodProduto == ""){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosCodigo"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbProdutosCodProduto;?>
                    </div>
                </td>
            </tr>
			<?php //} ?>
            
            <?php if($GLOBALS['habilitarProdutosCadastroUsuario'] == 1){ ?>
				<?php if($idTbCadastroUsuario == ""){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosCadastroUsuario"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
							<?php echo $tbProdutosIdTbCadastroUsuario_print;?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
            
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProduto"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula"<?php if($GLOBALS['habilitarProdutosNClassificacao'] <> "1"){ ?> colspan="3"<?php } ?>>
                    <div align="left">
                        <?php echo $tbProdutosProduto;?>
                    </div>
                </td>
				<?php if($GLOBALS['habilitarProdutosNClassificacao'] == 1){ ?>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNClassificacao"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaColuna01 TabelaCampos01Celula">
                    <div>
                        <?php echo $tbProdutosNClassificacao;?>
                    </div>
                </td>
                <?php } ?>
            </tr>
            
            <?php if($GLOBALS['habilitarProdutosTipo'] == "1"){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosTipo"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                        {
                        ?>
                            <div>
                                <?php if($linhaProdutosComplemento["tipo_complemento"] == "2"){ ?> 
                                    <?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico01'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico01Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                        {
                        ?>
                            <div>
                                <?php if($linhaProdutosComplemento["tipo_complemento"] == "12"){ ?> 
                                    <?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico02'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico02Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                        {
                        ?>
                            <div>
                                <?php if($linhaProdutosComplemento["tipo_complemento"] == "13"){ ?> 
                                    <?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico03'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico03Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                        {
                        ?>
                            <div>
                                <?php if($linhaProdutosComplemento["tipo_complemento"] == "14"){ ?> 
                                    <?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarProdutosFiltroGenerico04'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico04Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                        {
                        ?>
                            <div>
                                <?php if($linhaProdutosComplemento["tipo_complemento"] == "15"){ ?> 
                                    <?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico05'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico05Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                        {
                        ?>
                            <div>
                                <?php if($linhaProdutosComplemento["tipo_complemento"] == "16"){ ?> 
                                    <?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico06'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico06Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                        {
                        ?>
                            <div>
                                <?php if($linhaProdutosComplemento["tipo_complemento"] == "17"){ ?> 
                                    <?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico07'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico07Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                        {
                        ?>
                            <div>
                                <?php if($linhaProdutosComplemento["tipo_complemento"] == "18"){ ?> 
                                    <?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico08'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico08Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                        {
                        ?>
                            <div>
                                <?php if($linhaProdutosComplemento["tipo_complemento"] == "19"){ ?> 
                                    <?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico09'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico09Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                        {
                        ?>
                            <div>
                                <?php if($linhaProdutosComplemento["tipo_complemento"] == "20"){ ?> 
                                    <?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico10'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico10Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                        {
                        ?>
                            <div>
                                <?php if($linhaProdutosComplemento["tipo_complemento"] == "21"){ ?> 
                                    <?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico11'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico11Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                        {
                        ?>
                            <div>
                                <?php if($linhaProdutosComplemento["tipo_complemento"] == "22"){ ?> 
                                    <?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico12'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico12Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                        {
                        ?>
                            <div>
                                <?php if($linhaProdutosComplemento["tipo_complemento"] == "23"){ ?> 
                                    <?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico13'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico13Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                        {
                        ?>
                            <div>
                                <?php if($linhaProdutosComplemento["tipo_complemento"] == "24"){ ?> 
                                    <?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarProdutosFiltroGenerico14'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico14Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                        {
                        ?>
                            <div>
                                <?php if($linhaProdutosComplemento["tipo_complemento"] == "25"){ ?> 
                                    <?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico15'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico15Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                        {
                        ?>
                            <div>
                                <?php if($linhaProdutosComplemento["tipo_complemento"] == "26"){ ?> 
                                    <?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico16'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico16Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                        {
                        ?>
                            <div>
                                <?php if($linhaProdutosComplemento["tipo_complemento"] == "27"){ ?> 
                                    <?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico17'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico17Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                        {
                        ?>
                            <div>
                                <?php if($linhaProdutosComplemento["tipo_complemento"] == "28"){ ?> 
                                    <?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico18'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico18Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                        {
                        ?>
                            <div>
                                <?php if($linhaProdutosComplemento["tipo_complemento"] == "29"){ ?> 
                                    <?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico19'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico19Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                        {
                        ?>
                            <div>
                                <?php if($linhaProdutosComplemento["tipo_complemento"] == "30"){ ?> 
                                    <?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico20'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico20Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                        {
                        ?>
                            <div>
                                <?php if($linhaProdutosComplemento["tipo_complemento"] == "31"){ ?> 
                                    <?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico21'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico21Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                        {
                        ?>
                            <div>
                                <?php if($linhaProdutosComplemento["tipo_complemento"] == "32"){ ?> 
                                    <?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico22'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico22Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                        {
                        ?>
                            <div>
                                <?php if($linhaProdutosComplemento["tipo_complemento"] == "33"){ ?> 
                                    <?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico23'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico23Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                        {
                        ?>
                            <div>
                                <?php if($linhaProdutosComplemento["tipo_complemento"] == "34"){ ?> 
                                    <?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarProdutosFiltroGenerico24'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico24Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                        {
                        ?>
                            <div>
                                <?php if($linhaProdutosComplemento["tipo_complemento"] == "35"){ ?> 
                                    <?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico25'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico25Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                        {
                        ?>
                            <div>
                                <?php if($linhaProdutosComplemento["tipo_complemento"] == "36"){ ?> 
                                    <?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico26'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico26Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                        {
                        ?>
                            <div>
                                <?php if($linhaProdutosComplemento["tipo_complemento"] == "37"){ ?> 
                                    <?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico27'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico27Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                        {
                        ?>
                            <div>
                                <?php if($linhaProdutosComplemento["tipo_complemento"] == "38"){ ?> 
                                    <?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico28'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico28Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                        {
                        ?>
                            <div>
                                <?php if($linhaProdutosComplemento["tipo_complemento"] == "39"){ ?> 
                                    <?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico29'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico29Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                        {
                        ?>
                            <div>
                                <?php if($linhaProdutosComplemento["tipo_complemento"] == "40"){ ?> 
                                    <?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosFiltroGenerico30'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico30Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                        {
                        ?>
                            <div>
                                <?php if($linhaProdutosComplemento["tipo_complemento"] == "41"){ ?> 
                                    <?php if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
                        
            <?php if($GLOBALS['habilitarProdutosDescricao01'] == "1"){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosDescricao01Titulo'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div>
                        <?php echo $tbProdutosDescricao01;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosDescricao02'] == "1"){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosDescricao02Titulo'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div>
                        <?php echo $tbProdutosDescricao02;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosDescricao03'] == "1"){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosDescricao03Titulo'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div>
                        <?php echo $tbProdutosDescricao03;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosDescricao04'] == "1"){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosDescricao04Titulo'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div>
                        <?php echo $tbProdutosDescricao04;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosDescricao05'] == "1"){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosDescricao05Titulo'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div>
                        <?php echo $tbProdutosDescricao05;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosPalavrasChave'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPalavrasChave01"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbProdutosPalavrasChave;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosIc1'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc1'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC1;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosIc2'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc2'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC2;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc3'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc3'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC3;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc4'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc4'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC4;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc5'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc5'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC5;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosIc6'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc6'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC6;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosIc7'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc7'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC7;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc8'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc8'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC8;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc9'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc9'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC9;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc10'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc10'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC10;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosIc11'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc11'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC11;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosIc12'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc12'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC12;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc13'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc13'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC13;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc14'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc14'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC14;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc15'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc15'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC15;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosIc16'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc16'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC16;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosIc17'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc17'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC17;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc18'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc18'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC18;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc19'] == 1){ ?>
            <tr>

                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc19'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC19;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc20'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc20'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC20;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosIc21'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc21'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC21;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosIc22'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc22'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC22;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc23'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc23'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC23;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc24'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc24'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC24;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc25'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc25'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC25;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosIc26'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc26'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC26;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosIc27'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc27'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC27;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc28'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc28'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC28;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc29'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc29'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC29;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc30'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc30'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC30;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosIc31'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc31'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC31;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosIc32'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc32'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC32;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc33'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc33'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC33;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc34'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc34'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC34;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc35'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc35'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC35;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosIc36'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc36'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC36;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosIc37'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc37'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC37;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc38'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc38'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC38;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc39'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc39'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC39;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc40'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc40'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC40;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosIc41'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc41'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC41;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosIc42'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc42'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC42;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc43'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc43'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC43;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc44'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc44'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC44;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc45'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc45'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC45;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosIc46'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc46'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC46;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosIc47'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc47'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC47;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc48'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc48'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC48;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc49'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc49'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC49;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProdutosIc50'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc50'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php echo $tbProdutosIC50;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosValor'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosValor"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig");?> 
                        <?php echo $tbProdutosValor;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosValor1'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosValor1Nome'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosValor1Moeda'], "IncludeConfig"); ?> 
                        <?php echo $tbProdutosValor1;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosValor2'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosValor2Nome'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosValor1Moeda'], "IncludeConfig"); ?> 
                        <?php echo $tbProdutosValor2;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosPeso'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosPeso"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php echo $tbProdutosPeso;?>
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaPeso'], "IncludeConfig");?> 
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProdutosStatus'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosStatus"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php //echo $tbProdutosIdTbProdutosStatus;?>
                        <?php echo $tbProdutosIdTbProdutosStatusPrint;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
			<?php if($GLOBALS['ativacaoProdutosImagens'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemImagem"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php //SlimBox 2 - JQuery.?>
                        <?php if($GLOBALS['configImagemPopUp'] == "1"){ ?>
                            <a href="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>g<?php echo $tbProdutosImagem;?>" rel="lightbox" title="<?php echo $tbProdutosProduto; ?>"><img src="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>t<?php echo $tbProdutosImagem;?>" alt="<?php echo $tbProdutosProduto; ?>" style="margin-left: 4px;" /></a>
                        <?php } ?>
                        
                        <?php //Pop-up div com comentários.?>
                        <?php if($GLOBALS['configImagemPopUp'] == "2"){ ?>
            
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
    <?php //************************************************************************************** ?>
    
    
    <?php //Carrinho - Manipulação.?>
    <?php //**************************************************************************************?>
    <div align="center" class="ProdutosDetalhesConteudo" style="position: relative; display: block; clear: both; overflow: hidden;">
		<?php //Carrinho - Quantidade.?>
		<?php 
		$qtdCarrinho = DbFuncoes::GetCampoGenerico06("ce_itens_temporario",
                                                        "quantidade",
                                                        "id_item",
                                                        $tbProdutosId,
                                                        "",
                                                        "",
                                                        2,
                                                        "",
                                                        "",
                                                        "",
                                                        "",
                                                        "id_tb_cadastro_cliente",
                                                        $idTbCadastroUsuarioLogado);
		?>
        <?php if($qtdCarrinho <> ""){ ?>
        <div class="ProdutosDetalhesValor">
            <div align="left">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosQuantidade"); ?>:
                <?php echo $qtdCarrinho; ?>
            </div>
        </div>
        <?php } ?>
    
        <form name="formProdutosSelecao1" id="formProdutosSelecao1" action="SiteCarrinhoSelecaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        
            <div align="left" style="position: relative; display: block; clear: both; overflow: hidden;">
            	<?php if($qtdCarrinho <> ""){ ?>
                <div style="float: left;">
                	<?php //Ajax.?>
                    <a id="btoProdutosCancelar" onclick="divShow('updtProgressProdutosDetalhes');" style="cursor: pointer;">
                        <img src="img/btoProdutosDetalhesCancelar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoCancelar"); ?>" />
                    </a>
                    
                    <input type="image" name="submitProdutosCancelar" value="Submit" src="img/btoProdutosDetalhesCancelar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoCancelar"); ?>" />
                </div>
                <?php } ?>
                
                <div style="float: right;">
                	<?php //Ajax.?>
                    <a id="btoProdutosComprar" onclick="divShow('updtProgressProdutosDetalhes');" style="cursor: pointer;">
                        <img src="img/btoProdutosDetalhesComprar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoComprar"); ?>" />
                    </a>
                    
                    <input type="image" name="submitProdutosComprar" value="Submit" src="img/btoProdutosDetalhesComprar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoComprar"); ?>" />
                </div>
            </div>
            
			<?php //Seleção de quantidades.?>
            <div align="left" style="position: relative; display: block; clear: both; overflow: hidden;">
				<?php if($GLOBALS['configProdutosSelecaoQuantidade'] == 0){ ?>
                    <input name="strQuantidade" type="hidden" id="strQuantidade" value="1" />
                <?php } ?>
            </div>
            
            
            <input name="idItem" type="hidden" id="idItem" value="<?php echo $tbProdutosId;?>" />
            <input name="strTabela" type="hidden" id="strTabela" value="tb_produtos" />
            
            <input name="variavelRetorno" type="hidden" id="variavelRetorno" value="<?php echo $variavelRetorno;?>" />
            <input name="idRetorno" type="hidden" id="idRetorno" value="<?php echo $idRetorno;?>" />
            <input name="masterPageSiteSelect" type="hidden" id="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            
            <input name="palavraChave" type="hidden" id="palavraChave" value="<?php echo $palavraChave; ?>" />
        </form>
        
		<?php //JQuery - Ajax - Carrinho.?>
        <?php //----------------------?>
        <script type="text/javascript">
            //$('#btoProdutosComprar').on('click', function(){
            $(document).on('click', '#btoProdutosComprar, #btoProdutosCancelar', function(){
                
                //Função para mostrar mensagem em div.
                /*Funcionando.
                function divMensagem01(idDiv, strMensagem)
                {
                    var divTarget = $('#' + idDiv);
                    
                    divTarget.text(strMensagem);
                    
                }
                */                    

                //Criação de algumas variáveis.
                var strOperacaoAjax = "";
                var strQuantidade = $('#strQuantidade').val();
                var idItem = $('#idItem').val();
                var strTabela = $('#strTabela').val();
                var variavelRetorno = $('#variavelRetorno').val();
                var idRetorno = $('#idRetorno').val();
                var masterPageSiteSelect = $('#masterPageSiteSelect').val();
                var paginaRetorno = $('#paginaRetorno').val();
                var palavraChave = $('#palavraChave').val();
                
                var idBtoClicked = this.id;
                var submitProdutosComprar = null;
                var submitProdutosCancelar = null;
                var strSubmit = "";
                /*
                var strOperacao = "";
                */
                if(idBtoClicked == "btoProdutosComprar")
                {
                    //strOperacao = "submitProdutosComprar";
                    //submitProdutosComprar = 'true';
                    //strSubmit = "submitProdutosComprar";
                    strOperacaoAjax = "1";
                }
                if(idBtoClicked == "btoProdutosCancelar")
                {
                    //strOperacao = "submitProdutosCancelar";
                    //submitProdutosCancelar = 'true';
                    //strSubmit = "submitProdutosCancelar";
                    strOperacaoAjax = "0";
                }
                
                
                dataObj = {
                    //if(idBtoClicked == "btoProdutosComprar")
                    //{
                        //submitProdutosComprar: 'true',//funcionando
                        //(idBtoClicked == "btoProdutosComprar" ? submitProdutosComprar: submitProdutosComprar),
                        //submitProdutosComprar: submitProdutosComprar, //funcionando
                        //strSubmit: 'true',
                    //}
                    //if(idBtoClicked == "btoProdutosCancelar")
                    //{
                        //submitProdutosCancelar: 'true',
                        //submitProdutosCancelar: submitProdutosCancelar,
                    //}
                    strOperacaoAjax: strOperacaoAjax,
                    strQuantidade: strQuantidade,
                    strQuantidade: strQuantidade,
                    idItem: idItem,
                    strTabela: strTabela,
                    variavelRetorno: variavelRetorno,
                    idRetorno: idRetorno,
                    masterPageSiteSelect: masterPageSiteSelect,
                    paginaRetorno: paginaRetorno,
                    palavraChave: palavraChave
                };
                
                
                //Debug - verificação de erro.
                //console.log('Click registrado.'); //Debug.
                //console.log(this.id);
                //console.log('strSubmit=' + strSubmit);
                //console.log('idBtoClicked=' + idBtoClicked);
                //console.log('dataObj=' + dataObj);


                //Ajax - comando.
                $.ajax({
                    url: 'SiteCarrinhoSelecaoExe.php',
                    type: 'post',
                    /*
                    data: {
                        //if(idBtoClicked == "btoProdutosComprar")
                        //if(idBtoClicked == "btoProdutosComprar")
                        //{
                            //submitProdutosComprar: 'true',//funcionando
                            submitProdutosComprar: submitProdutosComprar,
                        //}
                        //if(idBtoClicked == "btoProdutosCancelar")
                        //{
                            //submitProdutosCancelar: 'true',
                            //submitProdutosCancelar: submitProdutosCancelar,
                        //}
                        strQuantidade: strQuantidade,
                        idItem: idItem,
                        strTabela: strTabela,
                        variavelRetorno: variavelRetorno,
                        idRetorno: idRetorno,
                        masterPageSiteSelect: masterPageSiteSelect,
                        paginaRetorno: paginaRetorno,
                        palavraChave: palavraChave
                    },
                    */
                    data: dataObj,
                    //dataType: 'json',
                    //dataType: "script",
                    dataType : 'html',
                    async: true,
                    //context: document.body,
                    success: function(strRetornoAjax){
                        //console.log(data); //Debug - mostra a impressão no console.
                        //divMensagem01('lblMensagemAlerta', 'Comando realizado com sucesso.'); //funcionando
                        //$("#updtPnlProdutosDetalhes").html(data);              
                        //$("#updtPnlProdutosDetalhes").html(data);  
                        //$("#bodyMasterPageSite").html(data);
                        
                        
                        //if(<?php //echo $GLOBALS['configProdutosPaginaRetornoCompra'];?> == "1")
                        //{
                            //window.location.href = "SiteCarrinho.php"; //não funcionou
                        //}
                        
                        //Substituir página inteira sem recarregar.
                        $("#updtPnlMasterPageSite").html(strRetornoAjax); //funcionando
                        
                        //divMensagem01('lblMensagemAlerta', 'Comando realizado com sucesso.');
                        //divMensagem01('lblMensagemAlerta', "'" + this.id + "'"); //'undefined'
                        //divMensagem01('lblMensagemAlerta', "'" + $(this).attr('id') + "'"); //'undefined'
                        //divMensagem01('lblMensagemAlerta', this.id);
                        //console.log(this.id);
                        
                    },
                    error: function(){
                        //console.log('Error ajax.');
                        divMensagem01('lblMensagemErro', '<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus9");?>');
                    }
                    
                });
            });
        </script>
        <?php //----------------------?>
    </div>
    <?php //**************************************************************************************?>

    
	<?php //Imagens complementares.?>
    <?php //----------------------?>
    <?php 
	//Definição de variáveis do include.
	$includeArquivosImagens_idTbArquivos = $tbProdutosId;
	$includeArquivosImagens_tipoVisualizacao = "1";
	
	$includeArquivosImagens_limiteRegistros = "";
	$includeArquivosImagens_nImagensVisivelScroll = "3";
	$includeArquivosImagens_configImagemZoom = "1";
	?>
    
    <?php include "IncludeArquivosImagens.php";?>
    <?php //----------------------?>
    
    
	<?php //Arquivos complementares.?>
    <?php //----------------------?>
    <?php 
	//Definição de variáveis do include.
	$includeArquivos_idTbArquivos = $tbProdutosId;
	$includeArquivos_tipoVisualizacao = "1";
	$includeArquivos_configArquivosNColunas = "1";
	
	$includeArquivos_limiteRegistros = "";
	$includeArquivos_nImagensVisivelScroll = "1";
	?>
    
    <?php include "IncludeArquivos.php";?>
    <?php //----------------------?>
    
    
	<?php //Conteúdo.?>
    <?php //----------------------?>
    <?php 
	//Definição de variáveis do include.
	$includeConteudo_idParentConteudo = $tbProdutosId;
	$includeConteudo_idTbConteudo = "";
	$includeConteudo_tipoConteudo = "";
	
	$includeConteudo_configTipoDiagramacao = "1";
	$includeConteudo_configConteudoNRegistros = "";
	$includeConteudo_configClassificacaoConteudo = $GLOBALS['configClassificacaoConteudo'];
	?>
    
    <?php include "IncludeConteudo.php";?>
    <?php //----------------------?>

    
	<?php //Cadastro - Detalhes.?>
    <?php //----------------------?>
    <?php if($tbProdutosIdTbCadastroUsuario <> 0){?>
        <?php 
        //Definição de variáveis do include.
        //$includePaginas_idParentPaginas = $tbCadastroId;
        $includeCadastroDetalhes_idTbCadastro = $tbProdutosIdTbCadastroUsuario;
        $includeCadastro_configTipoDiagramacao = "1";
        ?>
        
        <?php include "IncludeCadastroDetalhes.php";?>
    <?php } ?>
    <?php //----------------------?>
	
	
    <div align="center">
		<a href="javascript:history.go(-1);">
			<img src="img/btoVoltar.png" border="0" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoVoltar"); ?>" />
		</a>
    </div>
    
    
    <?php //Progress bar.?>
    <div id="updtProgressProdutosDetalhes" class="ProgressBarGenerico01Container" style="display: none;">
        <div class="ProgressBarGenerico01">
            <img src="img/ProgressBar01.gif" border="0" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteImagemProgressBarra"); ?>" />
        </div>
    </div>
<?php 
$pageSite->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php
//Limpeza de objetos.
//----------
unset($strSqlProdutosDetalhesSelect);
unset($statementProdutosDetalhesSelect);
unset($resultadoProdutosDetalhes);
unset($linhaProdutosDetalhes);
//----------


//Inclusão do template do layout.
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>