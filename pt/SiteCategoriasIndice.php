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
$idParentCategorias = $_GET["idParentCategorias"];

$palavraChave = $_GET["palavraChave"];

$tituloLinkAtual = "";
$metaTitulo = "";
$metaDescricao = "";
$metaPalavrasChave = "";

$paginaRetorno = "SiteCategoriasIndice.php";
$variavelRetorno = "idParentCategorias";
$idRetorno = $idParentCategorias;
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];
$mensagemAlerta = $_GET["mensagemAlerta"];


//Montagem de query padrão de retorno.
//"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
$queryPadrao = "&idParentCategorias=" . $idParentCategorias . 
"&paginaRetorno=" . $paginaRetorno . 
"&masterPageSiteSelect=" . $masterPageSiteSelect . 
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
$strSqlCategoriasSelect .= "FROM tb_categorias ";
$strSqlCategoriasSelect .= "WHERE id <> 0 ";
$strSqlCategoriasSelect .= "AND ativacao = 1 ";
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

//if($GLOBALS['habilitarCategoriasClassificacaoPersonalizada'] == 1 and DbFuncoes::GetCampoGenerico04("classificacao", "criterio_classificacao", "id_registro", $idParentCategorias) <> "")
//{
	//$strSqlCategoriasSelect .= "ORDER BY " . DbFuncoes::GetCampoGenerico04("classificacao", "criterio_classificacao", "id_registro", $idParentCategorias) . " ";
	
//}else{
	$strSqlCategoriasSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCategorias'] . " ";
//}
//echo "strSqlCategoriasSelect=" . $strSqlCategoriasSelect . "<br />";
//----------

//echo "GLOBALS[configClassificacaoCategorias]=" . $GLOBALS['configClassificacaoCategorias'] . "<br />";

//$resultadoCategorias = mysqli_query($dbSistemaCon, $strSqlCategoriasSelect);
//$linhaCategorias = mysqli_fetch_array($resultadoCategorias);
//$linhaCategorias = mysqli_fetch_array($resultadoCategorias, MYSQLI_ASSOC);

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


//Definição de variáveis.
if($idParentCategorias <> ""){
	$tituloLinkAtual = DbFuncoes::GetCampoGenerico01($idParentCategorias, "tb_categorias", "categoria");
}
if($palavraChave <> ""){
	$tituloLinkAtual = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaResultados");
}
if($tituloLinkAtual == ""){
	$tituloLinkAtual = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaResultados");
}


//Montagem das meta tags.
//----------
$metaTitulo = $tituloLinkAtual . " - " . Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloSite'], "IncludeConfig");
$metaPalavrasChave .= $tituloLinkAtual . ", ";

if(!empty($resultadoCategorias))
{
	//Loop pelos resultados.
	foreach($resultadoCategorias as $linhaCategorias)
	{
		$metaDescricao .= Funcoes::ConteudoMascaraLeitura($linhaCategorias['categoria']) . ", ";
		$metaPalavrasChave .= Funcoes::ConteudoMascaraLeitura($linhaCategorias['categoria']) . ", ";
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
    //if(mysqli_num_rows($resultadoCategorias) == 0){ //Verificação se está vazio.
	//if ($resultadoCategorias->fetchColumn() == 0) //Verificação se está vazio.
	if (empty($resultadoCategorias))
	{
        //echo "Nenhum registro encontrado";
    ?>
        <div align="center" class="AdmAlerta">
            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteMensagemCategoriasVazio"); ?>
        </div>
    <?php
    }else{
    ?>
		<?php //Diagramação 1.?>
        <?php //**************************************************************************************?>
        <div align="center" style="position: relative; display: block; overflow: hidden;">
			<?php
            //Loop pelos resultados.
            foreach($resultadoCategorias as $linhaCategorias)
            {
                //echo "id=" . $linhaCategorias['id'] . "<br />";
            ?>
                <div class="CategoriasIndiceContainer">
                
					<?php //Título.?>
                    <div class="CategoriasIndiceTituloFundo">
                        <a href="<?php echo Funcoes::CategoriaPaginaSelect($linhaCategorias['tipo_categoria'], "1");?>?<?php echo Funcoes::CategoriaPaginaSelect($linhaCategorias['tipo_categoria'], "2");?>=<?php echo $linhaCategorias['id'];?>" class="CategoriasIndiceTitulo">
                            <?php echo Funcoes::ConteudoMascaraLeitura($linhaCategorias['categoria']);?> 
                        </a>
                    </div>
                    
					<?php //Imagem.?>
                    <div style="position: relative; display: block; height: 110px; /*background-color: #999;*/ background-image: url(<?php echo $GLOBALS['configCaminhoSiteImagens'];?>t<?php echo $linhaCategorias['imagem'];?>); background-repeat: no-repeat; background-position: center;">
                    
                    </div>

                    <div align="left" class="CategoriasIndiceTexto" style="position: relative; display: block; padding-top: 10px;">
                        <?php if(200 == 0){ ?>
                            <?php echo Funcoes::ConteudoMascaraLeitura($linhaCategorias['informacao_complementar1']);?>
                        <?php }else{ ?>
                            <?php echo Funcoes::LimitadorCatecteres(Funcoes::RemoverHTML01(Funcoes::ConteudoMascaraLeitura($linhaCategorias['informacao_complementar1'])), 200);?>
                            <?php if(strlen(Funcoes::RemoverHTML01(Funcoes::ConteudoMascaraLeitura($linhaCategorias['informacao_complementar1']))) > 200){ ?>
                                ...
                            <?php } ?>
                        <?php } ?>
                        
                        <?php //echo Funcoes::ConteudoMascaraLeitura($linhaCategorias['informacao_complementar1']);?>
                    </div>
                </div>
            <?php } ?>
        </div>
		<?php //**************************************************************************************?>
    <?php } ?>
<?php 
$pageSite->cphConteudoPrincipal = ob_get_clean(); 
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
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>