<?php
//Importação dos arquivos de configuração.
require_once "../sistema/IncludeConfig.php"; //Deve vir antes do db.
require_once "../sistema/IncludeConexao.php";
require_once "../sistema/IncludeFuncoes.php";
//require_once "IncludeLayout.php";
require_once "IncludeLayoutSite.php";


//Resgate de variáveis.
$idParentForum = $_GET["idParentForum"];
$idsTbForum = $_GET["idsTbForum"];
$idTbCadastroVendedor = $_GET["idTbCadastroVendedor"];
$idTbCadastroUsuario = $_GET["idTbCadastroUsuario"];
$idsTbCadastroUsuario = $_GET["idsTbCadastroUsuario"];

$idTbCadastroLogado = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura(CookiesFuncoes::CookieValorLer_Login()), 2);

//$idTbCadastroUsuario = $_GET["idTbCadastroUsuario"];
//$idTbCadastroUsuario = $idTbCadastroLogado;
/*
if($idTbCadastroUsuario == "")
{
	$idTbCadastroUsuario = 0;
}
*/

$palavraChave = $_GET["palavraChave"];

$paginaRetorno = "SiteForumTopicosIndice.php";
$paginaRetornoExclusao = "SiteForumTopicosEditar.php";
$variavelRetorno = "idTbCategorias";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];

//Paginação.
if($GLOBALS['habilitarForumTopicosSitePaginacao'] == "1"){
	$paginacaoNRegistros = $GLOBALS['configForumTopicosSitePaginacaoNRegistros'];
	$paginacaoNumero = $_GET["paginacaoNumero"];
	if($paginacaoNumero == "")
	{
		$paginacaoNumero = 1;
	}
	//$paginacaoTotalRegistros = DbFuncoes::CountRegistrosGenericos("tb_forum_topicos", "id_parent", $idParentForumTopicos); //Quantidade de registros.
	//$paginacaoTotal = ceil($paginacaoTotalRegistros / $paginacaoNRegistros);
	$paginacaoInicio = ($paginacaoNumero-1) * $paginacaoNRegistros;
}

//Montagem de query padrão de retorno.
$queryPadrao = "&idParentForum=" . $idParentForum . 
"&paginaRetorno=" . $paginaRetorno . 
"&masterPageSiteSelect=" . $masterPageSiteSelect . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&variavelRetorno=" . $variavelRetorno . 
"&palavraChave=" . $palavraChave;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Query de pesquisa.
//----------
$strSqlForumTopicosSelect = "";
$strSqlForumTopicosSelect .= "SELECT ";
//$strSqlForumTopicosSelect .= "* ";
$strSqlForumTopicosSelect .= "id, ";
$strSqlForumTopicosSelect .= "id_tb_categorias, ";
$strSqlForumTopicosSelect .= "id_tb_cadastro_vendedor, ";
$strSqlForumTopicosSelect .= "id_tb_cadastro_usuario, ";
$strSqlForumTopicosSelect .= "n_classificacao, ";
$strSqlForumTopicosSelect .= "data_topico, ";
$strSqlForumTopicosSelect .= "topico, ";
$strSqlForumTopicosSelect .= "assunto, ";
$strSqlForumTopicosSelect .= "ativacao, ";
$strSqlForumTopicosSelect .= "acesso_restrito ";

//Paginação (subquery).
if($GLOBALS['habilitarForumTopicosSitePaginacao'] == "1"){
	$strSqlForumTopicosSelect .= ", (SELECT COUNT(id) ";
	$strSqlForumTopicosSelect .= "FROM tb_forum_topicos ";
	$strSqlForumTopicosSelect .= "WHERE id <> 0 ";
	if($idParentForum <> "")
	{
		$strSqlForumTopicosSelect .= "AND id_tb_categorias = :id_tb_categorias ";
	}
	if($idTbCadastroUsuario <> "")
	{
		$strSqlForumTopicosSelect .= "AND id_tb_cadastro_usuario = :id_tb_cadastro_usuario ";
	}
	if($palavraChave <> "")
	{
	$strSqlForumTopicosSelect .= "AND (topico LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	/*
	*/
	$strSqlForumTopicosSelect .= "OR assunto LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlForumTopicosSelect .= ") ";
	}
	$strSqlForumTopicosSelect .= "AND ativacao = 1 ";
	$strSqlForumTopicosSelect .= ") totalRegistros ";
}

$strSqlForumTopicosSelect .= "FROM tb_forum_topicos ";
$strSqlForumTopicosSelect .= "WHERE id <> 0 ";
if($idParentForum <> "")
{
	$strSqlForumTopicosSelect .= "AND id_tb_categorias = :id_tb_categorias ";
}
if($idTbCadastroUsuario <> "")
{
	$strSqlForumTopicosSelect .= "AND id_tb_cadastro_usuario = :id_tb_cadastro_usuario ";
}
if($palavraChave <> "")
{
	$strSqlForumTopicosSelect .= "AND (topico LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	/*
	*/
	$strSqlForumTopicosSelect .= "OR assunto LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlForumTopicosSelect .= ") ";
}

$strSqlForumTopicosSelect .= "AND ativacao = 1 ";
$strSqlForumTopicosSelect .= "ORDER BY " . $GLOBALS['configClassificacaoForumTopicos'] . " ";

//Paginação.
if($GLOBALS['habilitarForumTopicosSitePaginacao'] == "1"){ 
	if($configTipoDB == 2)
	{
		$strSqlForumTopicosSelect .= "LIMIT " . $paginacaoInicio . ", " . $paginacaoNRegistros . "";
	}
}
//----------


//Parâmetros.
//----------
$statementForumTopicosSelect = $dbSistemaConPDO->prepare($strSqlForumTopicosSelect);

if ($statementForumTopicosSelect !== false)
{
	if($idParentForum <> "")
	{
		$statementForumTopicosSelect->bindParam(':id_tb_categorias', $idParentForum, PDO::PARAM_STR);
	}
	if($idTbCadastroUsuario <> "")
	{
		$statementForumTopicosSelect->bindParam(':id_tb_cadastro_usuario', $idTbCadastroUsuario, PDO::PARAM_STR);
	}
	$statementForumTopicosSelect->execute();
	/*
	$statementForumTopicosSelect->execute(array(
		"id_tb_categorias" => $idParentForumTopicos
	));
	*/
}
//----------

//$resultadoForumTopicos = $dbSistemaConPDO->query($strSqlForumTopicosSelect);
$resultadoForumTopicos = $statementForumTopicosSelect->fetchAll();

//Paginação.
if($GLOBALS['habilitarForumTopicosSitePaginacao'] == "1"){
	//$paginacaoTotalRegistros = DbFuncoes::CountRegistrosGenericos("tb_cadastro", "id_tb_categorias", $idParentCadastro); //Quantidade de registros.
	//$paginacaoTotalRegistros = DbFuncoes::CountRegistrosGenericos("tb_cadastro", "id_tb_categorias", $idParentCadastro, "", "", "", "", "", ""); //Quantidade de registros.
	$paginacaoTotalRegistros = $resultadoForumTopicos[0]['totalRegistros'];
	$paginacaoTotal = ceil($paginacaoTotalRegistros / $paginacaoNRegistros);
}


//Definição de variáveis.
if($idParentForum <> ""){
	$tituloLinkAtual = DbFuncoes::GetCampoGenerico01($idParentForum, "tb_categorias", "categoria");
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

if(!empty($resultadoForumTopicos))
{
	//Loop pelos resultados.
	foreach($resultadoForumTopicos as $linhaForumTopicos)
	{
		$metaDescricao .= Funcoes::ConteudoMascaraLeitura($linhaForumTopicos['topico']) . ", ";
		$metaPalavrasChave .= Funcoes::ConteudoMascaraLeitura($linhaForumTopicos['assunto']) . ", ";
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
    <meta property="og:url" content="<?php echo $configUrl . "/" . $visualizacaoAtivaSistema . "/SiteForumTopicos.php?idParentForum=" . $idParentForum; ?>" />
    <meta property="og:description" content="<?php echo $metaDescricao; ?>"><?php //155 caracteres - Funcoes.LimitadorCatecteres($metaDescricao, 155).?>
    <?php //if($tbProdutosImagem <> ""){ ?>
    <!--meta property="og:image" content="<?php echo $configUrl . "/" . $visualizacaoAtivaSistema . "/img/LogoMeta.png";?>"--><?php //JPG ou PNG, menos que 300k e dimensão mínima de 300x200 pixels.?>
    <?php //} ?>
    <meta property="og:image:alt" content="<?php echo $metaTitulo; ?>" />
    <meta property="og:type" content="article" /><?php //referencias de tipos: https://developers.facebook.com/docs/reference/opengraph/.?>

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


    <div align="left" class="ForumTexto01">
        <strong>
            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteForumTopicoInstrucoes01Subtitulo"); ?>
        </strong>
        <br />
        <br />

        <?php if($GLOBALS['configForumFrontendTopicosInserir'] == 1){ ?>
            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteForumTopicoInstrucoes02Subtitulo"); ?>:
            <br />
            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteForumTopicoInstrucoes02"); ?>
            <br />
            <br />
        <?php } ?>

        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteForumTopicoInstrucoes03Subtitulo"); ?>:
        <br />
        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteForumTopicoInstrucoes03"); ?>
        <br />

        <div align="center">
            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteForumTopicoInstrucoes04Duvidas"); ?>
        </div>
        <br />
    </div>
    
    
    
    <?php
	if (empty($resultadoForumTopicos))
	{
        //echo "Nenhum registro encontrado";
    ?>
        <div align="center" class="AdmErro">
            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteMensagemForumTopicosVazio"); ?>
        </div>
    <?php
    }else{
    ?>
        <table width="100%" class="AdmTabelaDados01">
          <tr class="AdmTbFundoEscuro">

            <td class="AdmTabelaDados01Celula">
                <div class="ForumTexto02">
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteForumTopico"); ?>
                </div>
            </td>
            
            <td width="100" class="AdmTabelaDados01Celula">
                <div align="center" class="ForumTexto02">
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteForumTopicoInformacoes"); ?>
                </div>
            </td>
            
            <td width="100" class="AdmTabelaDados01Celula">
                <div align="center" class="ForumTexto02">
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemDataCriacao"); ?>
                </div>
            </td>
            
          </tr>
          
          <?php
            $countTabelaFundo = 0;
            
            //Loop pelos resultados.
            foreach($resultadoForumTopicos as $linhaForumTopicos)
            {
          ?>
              <tr class="<?php if($countTabelaFundo == 0){ ?>AdmTbFundoClaro<?php }else{?>AdmTbFundoAlternativo<?php } ?>">
                <td class="AdmTabelaDados01Celula">
                    <div align="left" class="ForumTexto01">
                        <table style="width:100%;" border="0" cellspacing="0" cellpadding="1">
                            <tr>
                                <td>
                                    <div align="left">
                                        <a class="ForumLinks01" href="SiteForumPostagens.php?idTbForumTopicos=<?php echo $linhaForumTopicos['id'];?>">
                                            <?php echo Funcoes::ConteudoMascaraLeitura($linhaForumTopicos['topico']);?>
                                        </a>
                                    </div>
                                    
                                    <?php if($GLOBALS['habilitarForumTopicosAssunto'] == 1){ ?>
                                    <div class="ForumTexto01">
                                        <strong>
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteForumTopicosAssunto"); ?>: 
                                        </strong>
                                        <?php echo Funcoes::ConteudoMascaraLeitura($linhaForumTopicos['assunto']);?>
                                    </div>
                                    <?php } ?>
                                    
                                    <?php if($linhaForumTopicos['id_tb_cadastro_usuario'] <> 0){ ?>
                                    <div class="ForumTexto01">
                                        <br />
                                        <strong>
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPublicadoPor"); ?>:  
                                        </strong>
                                        <?php //echo Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaTarefas['id_parent'], "tb_cadastro", "nome"); ?>
                                        <?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaForumTopicos['id_tb_cadastro_usuario'], "tb_cadastro", "nome"), 
                                        DbFuncoes::GetCampoGenerico01($linhaForumTopicos['id_tb_cadastro_usuario'], "tb_cadastro", "razao_social"), 
                                        DbFuncoes::GetCampoGenerico01($linhaForumTopicos['id_tb_cadastro_usuario'], "tb_cadastro", "nome_fantasia"), 
                                        1)); ?>
                                        <br />
                                        <strong>
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroEmailPrincipal"); ?>:  
                                        </strong>
                                        <?php echo Funcoes::ConteudoMascaraLeitura(DbFuncoes::GetCampoGenerico01($linhaForumTopicos['id_tb_cadastro_usuario'], "tb_cadastro", "email_principal")); ?>
                                    </div>
									<?php } ?>
                                    
                                    
                                    <?php //Interatividade. ?>
                                    <?php //************************************************************************************** ?>
                                    
                                    <?php //************************************************************************************** ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
                
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="ForumTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteForumTopicoDataUltimaPostagem"); ?>:  
                        <?php echo Funcoes::DataLeitura01(DbFuncoes::GetCampoGenerico04("tb_forum_postagens",
																						"data_postagem",
																						"id_parent",
																						$linhaForumTopicos['id'],
																						"data_postagem desc",
																						"1",
																						2), $GLOBALS['configSiteFormatoData'], "2"); ?>
                                                                                           
                        <br />
                        <br />
                    </div>
                    <div align="center" class="ForumTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteForumTopicoNPostagens"); ?>:
                        <?php echo DbFuncoes::CountRegistrosGenericos("tb_forum_postagens", "id_parent", $linhaForumTopicos['id']); ?>
                        <br />
                    </div>
                </td>
                
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <?php //echo $linhaForumTopicos['data_produto'];?>
                        <?php echo Funcoes::DataLeitura01($linhaForumTopicos['data_topico'], $GLOBALS['configSiteFormatoData'], "2");?>
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
	<?php } ?>
    
	<?php //Paginação. ?>
    <?php //************************************************************************************** ?>
    <?php if($GLOBALS['habilitarForumTopicosSitePaginacao'] == "1"){ ?>
		<?php if($paginacaoTotal > 1){ //Verifica se existe mais de uma página.?>
            <div align="center" class="AdmTexto01">
                <div style="position: relative; display: inline; margin: 2px;">
                    <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=1<?php echo $queryPadrao; ?>" class="AdmLinks01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPaginacaoPrimeira"); ?>
                    </a>
                </div>
                
                <?php if($paginacaoNumero > 1){ ?>
                    <div style="position: relative; display: inline; margin: 2px;">
                        <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=<?php echo $paginacaoNumero - 1 ?><?php echo $queryPadrao; ?>" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPaginacaoAnterior"); ?>
                        </a>
                    </div>
                <?php } ?>
                
                <?php //Numeração de páginas. ?>
                <?php if($GLOBALS['habilitarForumTopicosSitePaginacaoNumeracao'] == "1"){ ?>
                    <?php for($countPaginas = 1; $countPaginas <= $paginacaoTotal; $countPaginas++){ ?>
                        <div style="position: relative; display: inline; margin: 2px;">
                            <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=<?php echo $countPaginas; ?><?php echo $queryPadrao; ?>" class="AdmLinks01">
                                <?php echo $countPaginas; ?>
                            </a>
                        </div>
                    <?php } ?>
                <?php } ?>
                
                <?php if($paginacaoNumero <> $paginacaoTotal){ ?>
                    <div style="position: relative; display: inline; margin: 2px;">
                        <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=<?php echo $paginacaoNumero + 1 ?><?php echo $queryPadrao; ?>" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPaginacaoProxima"); ?>
                        </a>
                    </div>
                <?php } ?>
                
                <div style="position: relative; display: inline; margin: 2px;">
                    <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=<?php echo $paginacaoTotal; ?><?php echo $queryPadrao; ?>" class="AdmLinks01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPaginacaoUltima"); ?>
                    </a>
                </div>
            </div>
            
            <?php //Contagem de páginas. ?>
            <div align="center" class="AdmTexto01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePaginacaoPaginaContador01"); ?> 
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
unset($strSqlForumTopicosSelect);
unset($statementForumTopicosSelect);
unset($resultadoForumTopicos);
unset($linhaForumTopicos);
//----------


//Inclusão do template do layout.
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>