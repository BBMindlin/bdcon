<?php
//Importação dos arquivos de configuração.
require_once "../sistema/IncludeConfig.php"; //Deve vir antes do db.
require_once "../sistema/IncludeConexao.php";
require_once "../sistema/IncludeFuncoes.php";
//require_once "IncludeLayout.php";
require_once "IncludeLayoutSite.php";


//Verificação de login de cadastro.
//LoginAutenticacao::CadastroLoginVerificacao();


//Resgate de variáveis.
$idTbCadastroUsuarioLogado = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura(CookiesFuncoes::CookieValorLer_Login()), 2);

$idParentProdutos = $_GET["idParentProdutos"];
$idTbProdutos = $_GET["idTbProdutos"];

//$idTbCadastroUsuario = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura(CookiesFuncoes::CookieValorLer_Login()), 2);
$idTbCadastroUsuario = "";
/*
$idsTbProdutos = "";
$idsTbProdutos = DbFuncoes::GetCampoGenerico06("tb_itens_relacao_registros", 
											"id_item", 
											"id_registro", 
											$idTbCadastroUsuarioLogado, 
											"", 
											"", 
											1, 
											"", 
											"", 
											"tipo_categoria", 
											"13", 
											"", 
											"");
if($idsTbProdutos == "")
{
	$idsTbProdutos = "0";	
}
*/

$codProduto = $_GET["cod_produto"];
$produto = $_GET["produto"];
$informacaoComplementar1 = $_GET["informacao_complementar1"];

$palavraChave = $_GET["palavraChave"];

$tituloLinkAtual = "";
$metaTitulo = "";
$metaDescricao = "";
$metaPalavrasChave = "";

$paginaRetorno = "SiteProdutosIndice.php";
$variavelRetorno = "idParentProdutos";
$idRetorno = $idParentProdutos;
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];
$mensagemAlerta = $_GET["mensagemAlerta"];


//Paginação.
if($GLOBALS['habilitarProdutosPaginacaoSimples'] == "1"){
	$paginacaoNRegistros = $GLOBALS['configProdutosPaginacaoNRegistros'];
	$paginacaoNumero = $_GET["paginacaoNumero"];
	if($paginacaoNumero == "")
	{
		$paginacaoNumero = 1;
	}
	//$paginacaoTotalRegistros = DbFuncoes::CountRegistrosGenericos("tb_produtos", "id_parent", $idParentProdutos); //Quantidade de registros.
	//$paginacaoTotal = ceil($paginacaoTotalRegistros / $paginacaoNRegistros);
	$paginacaoInicio = ($paginacaoNumero-1) * $paginacaoNRegistros;
}


//Montagem de query padrão de retorno.
//"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
$queryPadrao = "&idParentProdutos=" . $idParentProdutos . 
"&paginaRetorno=" . $paginaRetorno . 
"&masterPageSiteSelect=" . $masterPageSiteSelect . 
"&variavelRetorno=" . $variavelRetorno . 
"&palavraChave=" . $palavraChave;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Query de pesquisa.
//----------
$strSqlProdutosSelect = "";
$strSqlProdutosSelect .= "SELECT ";
//$strSqlProdutosSelect .= "* ";
$strSqlProdutosSelect .= "id, ";
$strSqlProdutosSelect .= "id_tb_categorias, ";
$strSqlProdutosSelect .= "id_tb_cadastro_usuario, ";
$strSqlProdutosSelect .= "data_produto, ";
$strSqlProdutosSelect .= "cod_produto, ";
$strSqlProdutosSelect .= "n_classificacao, ";
$strSqlProdutosSelect .= "produto, ";
$strSqlProdutosSelect .= "descricao01, ";
$strSqlProdutosSelect .= "descricao02, ";
$strSqlProdutosSelect .= "descricao03, ";
$strSqlProdutosSelect .= "descricao04, ";
$strSqlProdutosSelect .= "descricao05, ";
$strSqlProdutosSelect .= "informacao_complementar1, ";
$strSqlProdutosSelect .= "informacao_complementar2, ";
$strSqlProdutosSelect .= "informacao_complementar3, ";
$strSqlProdutosSelect .= "informacao_complementar4, ";
$strSqlProdutosSelect .= "informacao_complementar5, ";
$strSqlProdutosSelect .= "informacao_complementar6, ";
$strSqlProdutosSelect .= "informacao_complementar7, ";
$strSqlProdutosSelect .= "informacao_complementar8, ";
$strSqlProdutosSelect .= "informacao_complementar9, ";
$strSqlProdutosSelect .= "informacao_complementar10, ";
$strSqlProdutosSelect .= "informacao_complementar11, ";
$strSqlProdutosSelect .= "informacao_complementar12, ";
$strSqlProdutosSelect .= "informacao_complementar13, ";
$strSqlProdutosSelect .= "informacao_complementar14, ";
$strSqlProdutosSelect .= "informacao_complementar15, ";
$strSqlProdutosSelect .= "palavras_chave, ";
$strSqlProdutosSelect .= "valor, ";
$strSqlProdutosSelect .= "valor1, ";
$strSqlProdutosSelect .= "valor2, ";
$strSqlProdutosSelect .= "peso, ";
$strSqlProdutosSelect .= "coeficiente, ";
$strSqlProdutosSelect .= "estoque, ";
$strSqlProdutosSelect .= "ativacao, ";
$strSqlProdutosSelect .= "ativacao_promocao, ";
$strSqlProdutosSelect .= "ativacao_home, ";
$strSqlProdutosSelect .= "ativacao_home_categoria, ";
$strSqlProdutosSelect .= "acesso_restrito, ";
$strSqlProdutosSelect .= "n_questoes_aprovacao, ";
$strSqlProdutosSelect .= "id_tb_produtos_status, ";
$strSqlProdutosSelect .= "imagem, ";
$strSqlProdutosSelect .= "anotacoes_internas, ";
$strSqlProdutosSelect .= "n_visitas ";

//Paginação (subquery).
if($GLOBALS['habilitarProdutosPaginacaoSimples'] == "1"){
	$strSqlProdutosSelect .= ", (SELECT COUNT(id) ";
	$strSqlProdutosSelect .= "FROM tb_produtos ";
	$strSqlProdutosSelect .= "WHERE id <> 0 ";
	if($idsTbProdutos <> "")
	{
		$strSqlProdutosSelect .= "AND id IN (" . Funcoes::ConteudoMascaraGravacao01($idsTbProdutos) . ") ";
	}
	if($idParentProdutos <> "")
	{
		$strSqlProdutosSelect .= "AND id_tb_categorias = :id_tb_categorias ";
	}
	if($idTbCadastroUsuario <> "")
	{
		$strSqlProdutosSelect .= "AND id_tb_cadastro_usuario = :id_tb_cadastro_usuario ";
	}
	if($idTbProdutos <> "")
	{
		$strSqlProdutosSelect .= "AND id = :id ";
	}
	if($codProduto <> "")
	{
		$strSqlProdutosSelect .= "AND cod_produto = :cod_produto ";
	}
	if($produto <> "")
	{
		$strSqlProdutosSelect .= "AND produto LIKE '%" . Funcoes::ConteudoMascaraGravacao01($produto) . "%' ";
	}
	if($informacaoComplementar1 <> "")
	{
		$strSqlProdutosSelect .= "AND informacao_complementar1 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($informacaoComplementar1) . "%' ";
	}
	if($palavraChave <> "")
	{
		$strSqlProdutosSelect .= "AND (produto LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		/*
		*/
		$strSqlProdutosSelect .= "OR descricao01 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlProdutosSelect .= "OR descricao02 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlProdutosSelect .= "OR descricao03 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlProdutosSelect .= "OR descricao04 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlProdutosSelect .= "OR descricao05 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlProdutosSelect .= "OR palavras_chave LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlProdutosSelect .= "OR informacao_complementar1 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlProdutosSelect .= "OR informacao_complementar2 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlProdutosSelect .= "OR informacao_complementar3 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlProdutosSelect .= "OR informacao_complementar4 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlProdutosSelect .= "OR informacao_complementar5 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlProdutosSelect .= "OR informacao_complementar6 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlProdutosSelect .= "OR informacao_complementar7 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlProdutosSelect .= "OR informacao_complementar8 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlProdutosSelect .= "OR informacao_complementar9 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlProdutosSelect .= "OR informacao_complementar10 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlProdutosSelect .= "OR informacao_complementar11 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlProdutosSelect .= "OR informacao_complementar12 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlProdutosSelect .= "OR informacao_complementar13 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlProdutosSelect .= "OR informacao_complementar14 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlProdutosSelect .= "OR informacao_complementar15 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlProdutosSelect .= ") ";
	}
	$strSqlProdutosSelect .= "AND ativacao = 1 ";
	$strSqlProdutosSelect .= ") totalRegistros ";
}

$strSqlProdutosSelect .= "FROM tb_produtos ";
$strSqlProdutosSelect .= "WHERE id <> 0 ";
if($idsTbProdutos <> "")
{
	$strSqlProdutosSelect .= "AND id IN (" . Funcoes::ConteudoMascaraGravacao01($idsTbProdutos) . ") ";
}
if($idParentProdutos <> "")
{
	$strSqlProdutosSelect .= "AND id_tb_categorias = :id_tb_categorias ";
}
if($idTbCadastroUsuario <> "")
{
	$strSqlProdutosSelect .= "AND id_tb_cadastro_usuario = :id_tb_cadastro_usuario ";
}
if($idTbProdutos <> "")
{
	$strSqlProdutosSelect .= "AND id = :id ";
}
if($codProduto <> "")
{
	$strSqlProdutosSelect .= "AND cod_produto = :cod_produto ";
}
if($produto <> "")
{
	$strSqlProdutosSelect .= "AND produto LIKE '%" . Funcoes::ConteudoMascaraGravacao01($produto) . "%' ";
}
if($informacaoComplementar1 <> "")
{
	$strSqlProdutosSelect .= "AND informacao_complementar1 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($informacaoComplementar1) . "%' ";
}
if($palavraChave <> "")
{
	$strSqlProdutosSelect .= "AND (produto LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	/*
	*/
	$strSqlProdutosSelect .= "OR descricao01 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlProdutosSelect .= "OR descricao02 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlProdutosSelect .= "OR descricao03 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlProdutosSelect .= "OR descricao04 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlProdutosSelect .= "OR descricao05 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlProdutosSelect .= "OR palavras_chave LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlProdutosSelect .= "OR informacao_complementar1 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlProdutosSelect .= "OR informacao_complementar2 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlProdutosSelect .= "OR informacao_complementar3 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlProdutosSelect .= "OR informacao_complementar4 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlProdutosSelect .= "OR informacao_complementar5 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlProdutosSelect .= "OR informacao_complementar6 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlProdutosSelect .= "OR informacao_complementar7 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlProdutosSelect .= "OR informacao_complementar8 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlProdutosSelect .= "OR informacao_complementar9 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlProdutosSelect .= "OR informacao_complementar10 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlProdutosSelect .= "OR informacao_complementar11 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlProdutosSelect .= "OR informacao_complementar12 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlProdutosSelect .= "OR informacao_complementar13 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlProdutosSelect .= "OR informacao_complementar14 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlProdutosSelect .= "OR informacao_complementar15 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlProdutosSelect .= ") ";
}

$strSqlProdutosSelect .= "AND ativacao = 1 ";
$strSqlProdutosSelect .= "ORDER BY " . $GLOBALS['configClassificacaoProdutos'] . " ";

//Paginação.
if($GLOBALS['habilitarProdutosPaginacaoSimples'] == "1"){ 
	if($configTipoDB == 2)
	{
		$strSqlProdutosSelect .= "LIMIT " . $paginacaoInicio . ", " . $paginacaoNRegistros . "";
	}
}
//----------


//Parâmetros.
//----------
$statementProdutosSelect = $dbSistemaConPDO->prepare($strSqlProdutosSelect);

if ($statementProdutosSelect !== false)
{
	if($idParentProdutos <> "")
	{
		$statementProdutosSelect->bindParam(':id_tb_categorias', $idParentProdutos, PDO::PARAM_STR);
	}
	if($idTbCadastroUsuario <> "")
	{
		$statementProdutosSelect->bindParam(':id_tb_cadastro_usuario', $idTbCadastroUsuario, PDO::PARAM_STR);
	}
	if($idTbProdutos <> "")
	{
		$statementProdutosSelect->bindParam(':id', $idTbProdutos, PDO::PARAM_STR);
	}
	if($codProduto <> "")
	{
		$statementProdutosSelect->bindParam(':cod_produto', $codProduto, PDO::PARAM_STR);
	}
	if($produto <> "")
	{
		//$statementProdutosSelect->bindParam(':produto', $produto, PDO::PARAM_STR);
	}
	if($informacaoComplementar1 <> "")
	{
		//$statementProdutosSelect->bindParam(':informacao_complementar1', $informacaoComplementar1, PDO::PARAM_STR);
	}
	$statementProdutosSelect->execute();
	/*
	$statementProdutosSelect->execute(array(
		"id_tb_categorias" => $idParentProdutos
	));
	*/
}
//----------

//$resultadoProdutos = $dbSistemaConPDO->query($strSqlProdutosSelect);
$resultadoProdutos = $statementProdutosSelect->fetchAll();

//Paginação.
if($GLOBALS['habilitarProdutosPaginacaoSimples'] == "1"){
	//$paginacaoTotalRegistros = DbFuncoes::CountRegistrosGenericos("tb_cadastro", "id_tb_categorias", $idParentCadastro); //Quantidade de registros.
	//$paginacaoTotalRegistros = DbFuncoes::CountRegistrosGenericos("tb_cadastro", "id_tb_categorias", $idParentCadastro, "", "", "", "", "", ""); //Quantidade de registros.
	$paginacaoTotalRegistros = $resultadoProdutos[0]['totalRegistros'];
	$paginacaoTotal = ceil($paginacaoTotalRegistros / $paginacaoNRegistros);
}


//Definição de variáveis.
if($idParentProdutos <> ""){
	$tituloLinkAtual = DbFuncoes::GetCampoGenerico01($idParentProdutos, "tb_categorias", "categoria");
}
if($palavraChave <> ""){
	$tituloLinkAtual = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaResultados");
}
if($tituloLinkAtual == ""){
	$tituloLinkAtual = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaResultados");
}


//Montagem das meta tags.
//----------
$metaTitulo = $tituloLinkAtual . " - " . htmlentities($GLOBALS['configTituloSite']);
$metaPalavrasChave .= $tituloLinkAtual . ", ";

if(!empty($resultadoProdutos))
{
	//Loop pelos resultados.
	foreach($resultadoProdutos as $linhaProdutos)
	{
		$metaDescricao .= Funcoes::ConteudoMascaraLeitura($linhaProdutos['produto']) . ", ";
		$metaPalavrasChave .= Funcoes::ConteudoMascaraLeitura($linhaProdutos['produto']) . ", ";
		//echo "loop=" . $linhaProdutos['produto'] . "<br />";
	}
}

//Retirada da vírgula do final.
if($metaDescricao <> "")
{
	$metaDescricao = substr($metaDescricao, 0, strlen($metaDescricao) - 2);
}
if($metaPalavrasChave <> "")
{
	$metaPalavrasChave = substr($metaPalavrasChave, 0, strlen($metaPalavrasChave) - 2);
}

//Retirada de código HTML.
$metaDescricao = Funcoes::RemoverHTML01($metaDescricao);
$metaPalavrasChave = Funcoes::RemoverHTML01($metaPalavrasChave);
//$metaPalavrasChave = strip_tags($metaPalavrasChave);

//Limitação de caractéres.
$metaTitulo = Funcoes::LimitadorCatecteres($metaTitulo, 60);
$metaDescricao = Funcoes::LimitadorCatecteres($metaDescricao, 160);
$metaPalavrasChave = Funcoes::LimitadorCatecteres($metaPalavrasChave, 100);
//----------


//Verificação de erro - debug.
//echo "metaTitulo=" . $metaTitulo . "<br />";
//echo "metaPalavrasChave=" . $metaPalavrasChave . "<br />";
//echo "strSqlProdutosSelect=" . $strSqlProdutosSelect . "<br />";
//echo "codProduto=" . $codProduto . "<br />";
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo $metaTitulo; //Verificar acentuação. ?>
	<?php //echo Funcoes::ConteudoMascaraLeitura($metaTitulo); //Verificar acentuação. ?>
<?php 
$pageSite->cphTitle = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Head.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphHead*/ ?>
    <meta name="description" content="<?php echo $metaDescricao; ?>" /><?php //Abaixo de 160 caracteres.?>
    <meta name="keywords" content="<?php echo $metaPalavrasChave; ?>" /><?php //Abaixo de 100 caracteres.?>
    <meta name="title" content="<?php echo $metaTitulo; ?>" /><?php //Abaixo de 60 caracteres.?>
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
    <div align="center" class="AdmErro">
        <?php echo $mensagemErro;?>
    </div>
    <div align="center" class="AdmSucesso">
        <?php echo $mensagemSucesso;?>
    </div>
    <div align="center" class="AdmAlerta">
        <?php echo $mensagemAlerta;?>
    </div>
    
    
    <?php
	if (empty($resultadoProdutos))
	{
        //echo "Nenhum registro encontrado";
    ?>
        <div align="center" class="AdmAlerta">
            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteMensagemProdutosVazio"); ?>
        </div>
    <?php
    }else{
    ?>
		<?php //Diagramação 1.?>
        <?php //**************************************************************************************?>
        <div align="center" style="position: relative; display: block; overflow: hidden;">
            <?php
            //Loop pelos resultados.
            foreach($resultadoProdutos as $linhaProdutos)
            {
            ?>
                <div class="ProdutosIndiceContainer">
                    <?php //Título.?>
                    <h2 style="/*position: absolute;*/ display:inline; margin: 0px; padding: 0px; font-size: inherit; float: left;">
                        <div class="ProdutosIndiceTituloFundo">
                            <a href="SiteProdutosDetalhes.php?idTbProdutos=<?php echo $linhaProdutos['id']; ?>" class="ProdutosIndiceTitulo">
                                <?php if($GLOBALS['configProdutosTituloLimiteCaracteres'] == 0){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutos['produto']);?>
                                <?php }else{ ?>
                                    <?php //echo Funcoes::ConteudoMascaraLeitura($linhaProdutos['produto']);?>
                                    <?php echo Funcoes::LimitadorCatecteres(Funcoes::RemoverHTML01(Funcoes::ConteudoMascaraLeitura($linhaProdutos['produto'])), $GLOBALS['configProdutosTituloLimiteCaracteres']);?>
                                    <?php if(strlen(Funcoes::LimitadorCatecteres(Funcoes::RemoverHTML01(Funcoes::ConteudoMascaraLeitura($linhaProdutos['produto'])), $GLOBALS['configProdutosTituloLimiteCaracteres'])) > $GLOBALS['configProdutosTituloLimiteCaracteres']){ ?>
                                        ...
									<?php } ?>
                                <?php } ?>
                                
                                
                                <?php
                                    //Obs: acertar lógina da função GetCampoGenerico06.
                                    //"&idsTbProdutosComplemento=" & DbFuncoes.GetCampoGenerico06("tb_produtos_relacao_complemento", "id_tb_produtos_complemento", "id_tb_produtos", Eval("id"), tipoRetorno:=2, strCampoComplementar1Referencia:="tipo_complemento", strCampoComplementar1Valor:="2") 
                                    //"&idParentProdutos=" & Eval("id_tb_categorias")
                                ?>
                            </a>
                        </div>
                    </h2>
        
                    <?php //Imagem.?>
                    <?php if(!empty($linhaProdutos['imagem'])){ ?>
                        <div class="ProdutosImagemIndice">
                            <?php //Sem pop-up. ?>
                            <?php //if($GLOBALS['configImagemPopUp'] == 0){ ?>
                                <a href="SiteProdutosDetalhes.php?idTbProdutos=<?php echo $linhaProdutos['id']; ?>">
                                    <img src="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>r<?php echo $linhaProdutos['imagem'];?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutos['produto']); ?>" />
                                </a>
                            <?php //} ?>
                        </div>
                    <?php } ?>
                    
                    <?php if($GLOBALS['configProdutosImagemPlaceholder'] == 1){ ?>
                        <?php if(empty($linhaProdutos['imagem'])){ ?>
                            <div class="ProdutosImagemIndice">
                            	<?php //OBS: fazer função para resgatar a dimensão (w e h).?>
                                <table bgcolor="#ccc" width="<?php echo $GLOBALS['$arrImagemProdutos'][2][1];?>" height="<?php echo $GLOBALS['$arrImagemProdutos'][2][2];?>" border="0" cellspacing="0">
                                  <tr align="center" valign="middle">
                                    <td>
                                        <a href="SiteProdutosDetalhes.php?idTbProdutos=<?php echo $linhaProdutos['id']; ?>"><img src="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>icone_imgem01.png" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutos['produto']); ?>" /></a>
                                        <br />
                                        <br />
                                        <div class="AdmTexto01">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteMensagemImagemPlaceholder");?>
                                        </div>
                                    </td>
                                  </tr>
                                </table>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    
                    <?php if($GLOBALS['habilitarProdutosDescricao01'] == 1){ ?>
                        <div class="ProdutosIndiceConteudo">
                            <?php if($GLOBALS['configProdutosDescricao01LimiteCaracteres'] == 0){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutos['descricao01']);?>
                            <?php }else{ ?>
								<?php echo Funcoes::LimitadorCatecteres(Funcoes::RemoverHTML01(Funcoes::ConteudoMascaraLeitura($linhaProdutos['descricao01'])), $GLOBALS['configProdutosDescricao01LimiteCaracteres']);?>
                                <?php if(strlen(Funcoes::RemoverHTML01(Funcoes::ConteudoMascaraLeitura($linhaProdutos['descricao01']))) > $GLOBALS['configProdutosDescricao01LimiteCaracteres']){ ?>
                                    ...
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    
                    <?php if($GLOBALS['habilitarProdutosValor'] == 1){ ?>
                        <div class="ProdutosIndiceValor">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosValor");?>: 
                            </strong>
                        
                            <?php if($linhaProdutos['valor'] > 0){ ?>
                                <?php echo $GLOBALS['configSistemaMoeda'] . " ";?>
                                <?php echo Funcoes::mascaraValorLer($linhaProdutos['valor']);?>
                            <?php }else{ ?>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosValor0");?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    
                    <?php //Detalhes.?>
                    <div style="position: relative; display: block;">
                        <a href="SiteProdutosDetalhes.php?idTbProdutos=<?php echo $linhaProdutos['id']; ?>">
                            <img src="img/btoDetalhesProdutos.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemDetalhes");?>" />
                        </a>
                    </div>
                    
                    <?php //Informações complementares.?>
                    <div class="ProdutosIndiceConteudo">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosData");?>: 
                        <?php echo Funcoes::DataLeitura01($linhaProdutos['data_produto'], $GLOBALS['configSiteFormatoData'], "1");?>
                        
                        <?php if($GLOBALS['habilitarProdutosIc1'] == 1){ ?>
                            <?php if($linhaProdutos['informacao_complementar1'] <> ""){ ?>
                                <strong>
                                    <?php echo htmlentities($GLOBALS['configProdutosTituloIc1']);?>: 
                                </strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutos['informacao_complementar1']);?>
                                <br />
                            <?php } ?>
                        <?php } ?>
                    </div>
        
                    <?php //Tabelas.?>
                    <?php if($GLOBALS['habilitarProdutosTipo'] == 1){ ?>
                        <div align="left" class="ProdutosIndiceConteudo">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosTipo");?>: 
                            </strong>
                        </div>
                    <?php } ?>
                    
                    <?php if($GLOBALS['habilitarProdutosStatus'] == 1){ ?>
                        <div align="left" class="ProdutosIndiceConteudo">
                            <?php if($linhaProdutos['id_tb_produtos_status'] <> 0){ ?>
                                <strong>
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosStatus");?>: 
                                </strong>
                                <?php echo DbFuncoes::GetCampoGenerico01($linhaProdutos['id_tb_produtos_status'], "tb_produtos_complemento", "complemento");?>
                                <br />
                            <?php } ?>
                        </div>
                    <?php } ?>
                    
                    
					<?php //Carrinho - Manipulação.?>
                    <?php //**************************************************************************************?>
                    <form name="formProdutosSelecao<?php echo $linhaProdutos['id']; ?>" id="formProdutosSelecao<?php echo $linhaProdutos['id']; ?>" action="SiteCarrinhoSelecaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
                    
                        <div align="left" style="position: relative; display: block; clear: both; overflow: hidden;">
                            <div style="float: right;">
                                <?php //Ajax.?>
                                <a id="btoProdutosComprar" onclick="divShow('updtProgressProdutosDetalhes');" style="cursor: pointer; display: none;">
                                    <img src="img/btoProdutosDetalhesComprar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoComprar"); ?>" />
                                </a>
                                
                                <input type="image" name="submitProdutosComprar" value="Submit" src="img/btoProdutosDetalhesComprar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoComprar"); ?>" style="display: none;" />
                                
                                <a class="ProdutosLinks01" onclick="document.getElementById('formProdutosSelecao<?php echo $linhaProdutos['id']; ?>').submit();" style="cursor: pointer; display: block;">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoComprar"); ?>
                                </a>
                                <input name="submitProdutosComprar_x" type="hidden" id="submitProdutosComprar_x" value="1" /><?php //Necessário quando utilizando link.?>
                                
                            </div>
                        </div>
                        
                        <?php //Seleção de quantidades.?>
                        <div align="left" style="position: relative; display: block; clear: both; overflow: hidden;">
                            <?php if($GLOBALS['configProdutosSelecaoQuantidade'] == 0){ ?>
                                <input name="strQuantidade" type="hidden" id="strQuantidade" value="1" />
                            <?php } ?>
                        </div>
                        
                        
                        <input name="idItem" type="hidden" id="idItem" value="<?php echo $linhaProdutos['id']; ?>" />
                        <input name="strTabela" type="hidden" id="strTabela" value="tb_produtos" />
                        
                        <input name="variavelRetorno" type="hidden" id="variavelRetorno" value="<?php echo $variavelRetorno;?>" />
                        <input name="idRetorno" type="hidden" id="idRetorno" value="<?php echo $idRetorno;?>" />
                        <input name="masterPageSiteSelect" type="hidden" id="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
                        <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                        
                        <input name="palavraChave" type="hidden" id="palavraChave" value="<?php echo $palavraChave; ?>" />
                    </form>
                    <?php //**************************************************************************************?>
                    
                    <div class="ProdutosSeparador1">
        
                    </div>
                </div>
            <?php } ?>
        </div>
		<?php //**************************************************************************************?>
        
        
		<?php //Diagramação 2 - tabela.?>
        <?php //**************************************************************************************?>
        <div align="center" style="position: relative; display: none; overflow: hidden;">
            <table width="100%" class="AdmTabelaDados01">
              <tr class="AdmTbFundoEscuro">
              	<?php if($GLOBALS['habilitarProdutosNClassificacao'] == 1){ ?>
                <td width="50" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php if($GLOBALS['habilitarProdutosClassificacaoPersonalizada'] == 1){ ?>
                            <a href="SiteAdmClassificacaoPersonalizadaExe.php?idRegistro=<?php echo $idParentProdutos; ?>&strTabela=tb_produtos&criterioClassificacao=n_classificacao<?php echo $queryPadrao; ?><?php echo $queryPadraoRetornoPaginacao; ?>" class="AdmLinks02">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNClassificacaoA"); ?>
                            </a>
                         <?php }else{ ?>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNClassificacaoA"); ?>
                        <?php } ?>
                    </div>
                </td>
                <?php } ?>
                
              	<?php if($GLOBALS['ativacaoProdutosVisualizacaoImagem'] == 1){ ?>
                <td width="1" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemImagem"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['ativacaoProdutosVisualizacaoData'] == 1){ ?>
                <td width="100" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosData"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <td class="AdmTabelaDados01Celula">
                    <div class="AdmTexto02">
						<?php if($GLOBALS['habilitarProdutosClassificacaoPersonalizada'] == 1){ ?>
                            <a href="SiteAdmClassificacaoPersonalizadaExe.php?idRegistro=<?php echo $idParentProdutos; ?>&strTabela=tb_produtos&criterioClassificacao=processo<?php echo $queryPadrao; ?><?php echo $queryPadraoRetornoPaginacao; ?>" class="AdmLinks02">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProduto"); ?>
                            </a>
                         <?php }else{ ?>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProduto"); ?>
                        <?php } ?>
                    </div>
                </td>
                
                <?php if($GLOBALS['habilitarProdutosValor'] == 1){ ?>
                <td width="100" class="AdmTabelaDados01Celula">
                    <div align="right" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosValor"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <td width="100" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFuncoes"); ?>
                    </div>
                </td>
                
                <td width="30" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao"); ?>
						<?php if($GLOBALS['habilitarProdutosClassificacaoPersonalizada'] == 1){ ?>
                            <a href="SiteAdmClassificacaoPersonalizadaExe.php?idRegistro=<?php echo $idParentProdutos; ?>&strTabela=tb_produtos&criterioClassificacao=ativacao<?php echo $queryPadrao; ?><?php echo $queryPadraoRetornoPaginacao; ?>" class="AdmLinks02">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao"); ?>
                            </a>
                         <?php }else{ ?>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao"); ?>
                        <?php } ?>
                    </div>
                </td>
                
                <?php if($GLOBALS['habilitarProdutosAtivacaoPromocoes'] == 1){ ?>
                <td width="30" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao"); ?>
						<?php if($GLOBALS['habilitarProdutosClassificacaoPersonalizada'] == 1){ ?>
                            <a href="SiteAdmClassificacaoPersonalizadaExe.php?idRegistro=<?php echo $idParentProdutos; ?>&strTabela=tb_produtos&criterioClassificacao=ativacao_promocao<?php echo $queryPadrao; ?><?php echo $queryPadraoRetornoPaginacao; ?>" class="AdmLinks02">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosAtivacaoPromocoes"); ?>
                            </a>
                         <?php }else{ ?>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosAtivacaoPromocoes"); ?>
                        <?php } ?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarProdutosAtivacaoHome'] == 1){ ?>
                <td width="30" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao"); ?>
						<?php if($GLOBALS['habilitarProdutosClassificacaoPersonalizada'] == 1){ ?>
                            <a href="SiteAdmClassificacaoPersonalizadaExe.php?idRegistro=<?php echo $idParentProdutos; ?>&strTabela=tb_produtos&criterioClassificacao=ativacao_home<?php echo $queryPadrao; ?><?php echo $queryPadraoRetornoPaginacao; ?>" class="AdmLinks02">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosAtivacaoHome"); ?>
                            </a>
                         <?php }else{ ?>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosAtivacaoHome"); ?>
                        <?php } ?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarProdutosAtivacaoCategoria'] == 1){ ?>
                <td width="30" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao"); ?>
						<?php if($GLOBALS['habilitarProdutosClassificacaoPersonalizada'] == 1){ ?>
                            <a href="SiteAdmClassificacaoPersonalizadaExe.php?idRegistro=<?php echo $idParentProdutos; ?>&strTabela=tb_produtos&criterioClassificacao=ativacao_home_categoria<?php echo $queryPadrao; ?><?php echo $queryPadraoRetornoPaginacao; ?>" class="AdmLinks02">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosAtivacaoHomeCategoria"); ?>
                            <a>
                         <?php }else{ ?>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosAtivacaoHomeCategoria"); ?>
                        <?php } ?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarProdutosAtivacaoAcesso'] == 1){ ?>
                <td width="50" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAcesso"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <td width="30" class="AdmTabelaDados01Celula" style="display: none;">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                    </div>
                </td>
                
                <td width="30" class="AdmTabelaDados01Celula" style="display: none;">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemExcluir"); ?>
                    </div>
                </td>
                
                <td width="30" class="TabelaDados01Celula" style="display: none;">
                    <div align="center" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemSelecionarA"); ?>
                    </div>
                </td>
              </tr>
              <?php
			  	$countTabelaFundo = 0;
			  
                //Loop pelos resultados.
                foreach($resultadoProdutos as $linhaProdutos)
                {
              ?>
              <tr class="<?php if($countTabelaFundo == 0){ ?>AdmTbFundoClaro<?php }else{?>AdmTbFundoAlternativo<?php } ?>">
              	<?php if($GLOBALS['habilitarProdutosNClassificacao'] == 1){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <?php echo $linhaProdutos['n_classificacao'];?>
                    </div>
                </td>
                <?php } ?>
                
              	<?php if($GLOBALS['ativacaoProdutosVisualizacaoImagem'] == 1){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
						<?php if(!empty($linhaProdutos['imagem'])){ ?>
							<?php //Sem pop-up. ?>
                            <?php if($GLOBALS['configImagemPopUp'] == 0){ ?>
                                <img src="<?php echo $GLOBALS['configDiretorioArquivos'];?>/t<?php echo $linhaProdutos['imagem'];?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutos['produto']); ?>" />
                            <?php } ?>
                        
                            <?php //SlimBox 2 - JQuery. ?>
                            <?php if($GLOBALS['configImagemPopUp'] == 1){ ?>
                                <a href="<?php echo $GLOBALS['configDiretorioArquivos'];?>/g<?php echo $linhaProdutos['imagem'];?>" rel="lightbox" title="">
                                    <img src="<?php echo $GLOBALS['configDiretorioArquivos'];?>/t<?php echo $linhaProdutos['imagem'];?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutos['produto']); ?>" />
                                </a>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['ativacaoProdutosVisualizacaoData'] == 1){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <?php //echo $linhaProdutos['data_produto'];?>
                        <?php echo Funcoes::DataLeitura01($linhaProdutos['data_produto'], $GLOBALS['configSistemaFormatoData'], "1");?>
                    </div>
                </td>
                <?php } ?>
                
                <td class="AdmTabelaDados01Celula">
                    <div class="AdmTexto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutos['produto']);?>
                    </div>
                    <div class="AdmTexto01">
                    	<?php if($GLOBALS['habilitarProdutosValor'] == 1){ ?>
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosValor"); ?>: 
                            </strong>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>
                            <?php echo Funcoes::MascaraValorLer($linhaProdutos['valor'], $GLOBALS['configSistemaMoeda']);?>
                        <?php } ?>
                        
                    	<?php if($GLOBALS['habilitarProdutosValor1'] == 1){ ?>
                            <strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosValor1Nome'], "IncludeConfig"); ?>: 
                            </strong>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosValor1Moeda'], "IncludeConfig"); ?>
                            <?php echo Funcoes::MascaraValorLer($linhaProdutos['valor1'], $GLOBALS['configSistemaMoeda']);?>
                        <?php } ?>
                        
                    	<?php if($GLOBALS['habilitarProdutosValor2'] == 1){ ?>
                            <strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosValor2Nome'], "IncludeConfig"); ?>: 
                            </strong>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosValor2Moeda'], "IncludeConfig"); ?>
                            <?php echo Funcoes::MascaraValorLer($linhaProdutos['valor2'], $GLOBALS['configSistemaMoeda']);?>
                        <?php } ?>
                        
                    	<?php if($GLOBALS['habilitarProdutosPeso'] == 1){ ?>
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosPeso"); ?>: 
                            </strong>
                            <?php echo $linhaProdutos['peso'];?>
                            <?php echo " " . Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaPeso'], "IncludeConfig"); ?>
                        <?php } ?>
                    </div>
                    
					<?php if($GLOBALS['habilitarProdutosCadastroUsuario'] == 1){ ?>
                        <div class="AdmTexto01">
							<?php if($linhaProdutos['id_tb_cadastro_usuario'] <> 0){ ?>
                                <strong>
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosCadastroUsuario"); ?>:  
                                </strong>
                                <a href="SiteAdmCadastroAdministrar.php?idTbCadastro=<?php echo $linhaProdutos['id_tb_cadastro_usuario'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
                                    <?php //echo Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaTarefas['id_parent'], "tb_cadastro", "nome"); ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaProdutos['id_tb_cadastro_usuario'], "tb_cadastro", "nome"), 
									DbFuncoes::GetCampoGenerico01($linhaProdutos['id_tb_cadastro_usuario'], "tb_cadastro", "razao_social"), 
									DbFuncoes::GetCampoGenerico01($linhaProdutos['id_tb_cadastro_usuario'], "tb_cadastro", "nome_fantasia"), 
									1)); ?>
                                </a>
                            <?php } ?>
                        </div>
					<?php } ?>
                </td>
                
                <?php if($GLOBALS['habilitarProdutosValor'] == 1){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div align="right" class="AdmTexto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosValor1Moeda'], "IncludeConfig"); ?>
                        <?php echo Funcoes::MascaraValorLer($linhaProdutos['valor'], $GLOBALS['configSistemaMoeda']);?>
                    </div>
                </td>
                <?php } ?>
                
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                    	<a href="../<?php echo $GLOBALS['visualizacaoAtivaSistema'];?>/SiteProdutosDetalhes.php?idTbProdutos=<?php echo $linhaProdutos['id'];?>" target="_blank" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemVisualizacao"); ?>
                        </a>
                    </div>
                </td>
                
                <td class="<?php if($linhaProdutos['ativacao'] == 1){/*echo "AdmTbFundoClaro";*/}else{echo "TbFundoDesativado";}?> AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                    	<a href="SiteAdmRegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaProdutos['id'];?>&statusAtivacao=<?php echo $linhaProdutos['ativacao'];?>&strTabela=tb_produtos&strCampo=ativacao<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="AdmLinks01">
                        	<?php if($linhaProdutos['ativacao'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao0"); ?>
                            <?php } ?>
                        	<?php if($linhaProdutos['ativacao'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao1"); ?>
                            <?php } ?>
                        </a>
						<?php //echo $linhaProdutos['ativacao'];?>
                    </div>
                </td>
                
                <?php if($GLOBALS['habilitarProdutosAtivacaoPromocoes'] == 1){ ?>
                <td class="<?php if($linhaProdutos['ativacao_promocao'] == 1){/*echo "AdmTbFundoClaro";*/}else{echo "TbFundoDesativado";}?> AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                    	<a href="SiteAdmRegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaProdutos['id'];?>&statusAtivacao=<?php echo $linhaProdutos['ativacao_promocao'];?>&strTabela=tb_produtos&strCampo=ativacao_promocao<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="AdmLinks01">
                        	<?php if($linhaProdutos['ativacao_promocao'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao0"); ?>
                            <?php } ?>
                        	<?php if($linhaProdutos['ativacao_promocao'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao1"); ?>
                            <?php } ?>
                        </a>
						<?php //echo $linhaProdutos['ativacao'];?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarProdutosAtivacaoHome'] == 1){ ?>
                <td class="<?php if($linhaProdutos['ativacao_home'] == 1){/*echo "AdmTbFundoClaro";*/}else{echo "TbFundoDesativado";}?> AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                    	<a href="SiteAdmRegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaProdutos['id'];?>&statusAtivacao=<?php echo $linhaProdutos['ativacao_home'];?>&strTabela=tb_produtos&strCampo=ativacao_home<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="AdmLinks01">
                        	<?php if($linhaProdutos['ativacao_home'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao0"); ?>
                            <?php } ?>
                        	<?php if($linhaProdutos['ativacao_home'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao1"); ?>
                            <?php } ?>
                        </a>
						<?php //echo $linhaProdutos['ativacao'];?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarProdutosAtivacaoCategoria'] == 1){ ?>
                <td class="<?php if($linhaProdutos['ativacao_home_categoria'] == 1){/*echo "AdmTbFundoClaro";*/}else{echo "TbFundoDesativado";}?> AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                    	<a href="SiteAdmRegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaProdutos['id'];?>&statusAtivacao=<?php echo $linhaProdutos['ativacao_home_categoria'];?>&strTabela=tb_produtos&strCampo=ativacao_home_categoria<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="AdmLinks01">
                        	<?php if($linhaProdutos['ativacao_home_categoria'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao0"); ?>
                            <?php } ?>
                        	<?php if($linhaProdutos['ativacao_home_categoria'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao1"); ?>
                            <?php } ?>
                        </a>
						<?php //echo $linhaProdutos['ativacao'];?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarProdutosAtivacaoAcesso'] == 1){ ?>
                <td class="<?php if($linhaProdutos['acesso_restrito'] == 0){/*echo "AdmTbFundoClaro";*/}else{echo "TbFundoDesativado";}?> AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                    	<a href="SiteAdmRegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaProdutos['id'];?>&statusAtivacao=<?php echo $linhaProdutos['acesso_restrito'];?>&strTabela=tb_produtos&strCampo=acesso_restrito<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="AdmLinks01">
                        	<?php if($linhaProdutos['acesso_restrito'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAcesso0"); ?>
                            <?php } ?>

                        	<?php if($linhaProdutos['acesso_restrito'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAcesso1"); ?>
                            <?php } ?>
                        </a>
                        <?php //echo $linhaProdutos['acesso_restrito'];?>
                    </div>
                </td>
                <?php } ?>

                <td class="AdmTabelaDados01Celula" style="display: none;">
                    <div align="center" class="AdmTexto01">
                        <a href="ProdutosEditar.php?idTbProdutos=<?php echo $linhaProdutos['id'];?><?php echo $queryPadrao;?>" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="AdmTabelaDados01Celula" style="display: none;">
                    <div align="center" class="AdmTexto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaProdutos['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
                <td class="TabelaDados01Celula" style="display: none;">
                    <div align="center" class="AdmTexto01">
                        <!--input name="idsRegistrosSelecionar[]" type="checkbox" value="<?php echo $linhaProdutos['id'];?>" class="AdmCampoCheckBox01" /-->
                        <input name="idsRegistrosSelecionar" type="radio" value="<?php echo $linhaProdutos['id'];?>" class="AdmCampoRadioButton01" />
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
        </div>
		<?php //**************************************************************************************?>
	
	<?php } ?>
    
	<?php //Paginação. ?>
    <?php //************************************************************************************** ?>
    <?php if($GLOBALS['habilitarProdutosPaginacaoSimples'] == "1"){ ?>
		<?php if($paginacaoTotal > 1){ //Verifica se existe mais de uma página.?>
            <div align="center" class="Texto01">
                <div style="position: relative; display: inline; margin: 2px;">
                    <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=1<?php echo $queryPadrao; ?>" class="Links03">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPaginacaoPrimeira"); ?>
                    </a>
                </div>
                
                <?php if($paginacaoNumero > 1){ ?>
                    <div style="position: relative; display: inline; margin: 2px;">
                        <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=<?php echo $paginacaoNumero - 1 ?><?php echo $queryPadrao; ?>" class="Links03">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPaginacaoAnterior"); ?>
                        </a>
                    </div>
                <?php } ?>
                
                <?php //Numeração de páginas. ?>
                <?php if($GLOBALS['habilitarProdutosPaginacaoQtdPaginas'] == "1"){ ?>
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPaginacaoProxima"); ?>
                        </a>
                    </div>
                <?php } ?>
                
                <div style="position: relative; display: inline; margin: 2px;">
                    <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=<?php echo $paginacaoTotal; ?><?php echo $queryPadrao; ?>" class="Links03">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPaginacaoUltima"); ?>
                    </a>
                </div>
            </div>
            
            <?php //Contagem de páginas. ?>
            <div align="center" class="Texto01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPaginacaoPaginaContador01"); ?> 
                <?php echo $paginacaoNumero; ?> / <?php echo $paginacaoTotal; ?>
            </div>
        <?php } ?>
	<?php } ?>
	<?php //************************************************************************************** ?>
    
<?php 
$pageSite->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php
//Limpeza de objetos.
//----------
unset($strSqlProdutosSelect);
unset($statementProdutosSelect);
unset($resultadoProdutos);
unset($linhaProdutos);
//----------


//Inclusão do template do layout.
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>