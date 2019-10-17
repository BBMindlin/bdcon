<?php
//Importação dos arquivos de configuração.
require_once "../sistema/IncludeConfig.php"; //Deve vir antes do db.
require_once "../sistema/IncludeConexao.php";
require_once "../sistema/IncludeFuncoes.php";
//require_once "IncludeLayout.php";
require_once "IncludeLayoutSite.php";


//Resgate de variáveis.
$idTbForumTopicos = $_GET["idTbForumTopicos"];
$idTbCadastroLogado = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura(CookiesFuncoes::CookieValorLer_Login()), 2);

//$idTbCadastroUsuario = $_GET["idTbCadastroUsuario"];
$idTbCadastroUsuario = $idTbCadastroLogado;
if($idTbCadastroUsuario == "")
{
	$idTbCadastroUsuario = 0;
}

//Detalhes do cadastro logado.
$ocdCadastroLogado = new ObjetoCadastroDetalhes(); //Criação de objeto com os detalhes do cadastro.
if($idTbCadastroLogado <> "")
{
	//$resultadoCadastroDetalhes = DbFuncoes::TabelaGenericaFill01_FetchAll("tb_cadastro", array("id;" . $idTbCadastroLogado . ";i"));	
	
	//Definição dos valores do cadastro logado.
	$ocdCadastroLogado->CadastroDetalhesResultado($idTbCadastroLogado, 1);
}

//Paginação.
if($GLOBALS['habilitarForumPostagensSitePaginacao'] == "1"){
	$paginacaoNRegistros = $GLOBALS['configForumPostagensSitePaginacaoNRegistros'];
	$paginacaoNumero = $_GET["paginacaoNumero"];
	if($paginacaoNumero == "")
	{
		$paginacaoNumero = 1;
	}
	//$paginacaoTotalRegistros = DbFuncoes::CountRegistrosGenericos("tb_forum_postagens", "id_parent", $idParentForumPostagens); //Quantidade de registros.
	//$paginacaoTotal = ceil($paginacaoTotalRegistros / $paginacaoNRegistros);
	$paginacaoInicio = ($paginacaoNumero-1) * $paginacaoNRegistros;
}

$palavraChave = $_GET["palavraChave"];

$habilitarListagem = $_GET["habilitarListagem"];
if($habilitarListagem == "")
{
	$habilitarListagem = 1; //padrão: 1 - habilitar
}
$habilitarInclusao = $_GET["habilitarInclusao"];
if($habilitarInclusao == "")
{
	$habilitarInclusao = 1; //padrão: 1 - habilitar
}
$habilitarDetalhes = $_GET["habilitarDetalhes"];
if($habilitarDetalhes == "")
{
	$habilitarDetalhes = 0; //padrão: 0 - desabilitar
}
$habilitarBusca = $_GET["habilitarBusca"];
if($habilitarBusca == "")
{
	$habilitarBusca = 0; //padrão: 0 - desabilitar
}

$paginaRetorno = "SiteForumPostagens.php";
$paginaRetornoExclusao = "SiteForumPostagensEditar.php";
$variavelRetorno = "idTbForumPostagens";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];


//Montagem de query padrão de retorno.
$queryPadrao = "&idTbForumTopicos=" . $idTbForumTopicos . 
"&paginaRetorno=" . $paginaRetorno . 
"&masterPageSiteSelect=" . $masterPageSiteSelect . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&variavelRetorno=" . $variavelRetorno . 
"&palavraChave=" . $palavraChave;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Query de pesquisa.
//----------
$strSqlForumPostagensSelect = "";
$strSqlForumPostagensSelect .= "SELECT ";
//$strSqlForumPostagensSelect .= "* ";
$strSqlForumPostagensSelect .= "id, ";
$strSqlForumPostagensSelect .= "id_parent, ";
$strSqlForumPostagensSelect .= "id_tb_cadastro_usuario, ";
$strSqlForumPostagensSelect .= "nome, ";
$strSqlForumPostagensSelect .= "email, ";
$strSqlForumPostagensSelect .= "n_classificacao, ";
$strSqlForumPostagensSelect .= "data_postagem, ";
$strSqlForumPostagensSelect .= "postagem, ";
$strSqlForumPostagensSelect .= "nota_avaliacao, ";
$strSqlForumPostagensSelect .= "informacao_complementar1, ";
$strSqlForumPostagensSelect .= "informacao_complementar2, ";
$strSqlForumPostagensSelect .= "informacao_complementar3, ";
$strSqlForumPostagensSelect .= "informacao_complementar4, ";
$strSqlForumPostagensSelect .= "informacao_complementar5, ";
$strSqlForumPostagensSelect .= "informacao_complementar6, ";
$strSqlForumPostagensSelect .= "informacao_complementar7, ";
$strSqlForumPostagensSelect .= "informacao_complementar8, ";
$strSqlForumPostagensSelect .= "informacao_complementar9, ";
$strSqlForumPostagensSelect .= "informacao_complementar10, ";
$strSqlForumPostagensSelect .= "ativacao ";

//Paginação (subquery).
if($GLOBALS['habilitarForumPostagensSitePaginacao'] == "1"){
	$strSqlForumPostagensSelect .= ", (SELECT COUNT(id) ";
	$strSqlForumPostagensSelect .= "FROM tb_forum_postagens ";
	$strSqlForumPostagensSelect .= "WHERE id <> 0 ";
	if($idTbForumTopicos <> "")
	{
		$strSqlForumPostagensSelect .= "AND id_parent = :id_parent ";
	}
	if($palavraChave <> "")
	{
	$strSqlForumPostagensSelect .= "AND (postagem LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	/*
	*/
	$strSqlForumPostagensSelect .= "OR postagem LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlForumPostagensSelect .= ") ";
	}
	$strSqlForumPostagensSelect .= "AND ativacao = 1 ";
	$strSqlForumPostagensSelect .= ") totalRegistros ";
}

$strSqlForumPostagensSelect .= "FROM tb_forum_postagens ";
$strSqlForumPostagensSelect .= "WHERE id <> 0 ";
if($idTbForumTopicos <> "")
{
	$strSqlForumPostagensSelect .= "AND id_parent = :id_parent ";
}
if($palavraChave <> "")
{
	$strSqlForumPostagensSelect .= "AND (postagem LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	/*
	*/
	$strSqlForumPostagensSelect .= "OR postagem LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlForumPostagensSelect .= ") ";
}
$strSqlForumPostagensSelect .= "AND ativacao = 1 ";
$strSqlForumPostagensSelect .= "ORDER BY " . $GLOBALS['configClassificacaoForumPostagens'] . " ";

//Paginação.
if($GLOBALS['habilitarForumPostagensSitePaginacao'] == "1"){ 
	if($configTipoDB == 2)
	{
		$strSqlForumPostagensSelect .= "LIMIT " . $paginacaoInicio . ", " . $paginacaoNRegistros . "";
	}
}
//----------


//Parâmetros.
//----------
$statementForumPostagensSelect = $dbSistemaConPDO->prepare($strSqlForumPostagensSelect);

if ($statementForumPostagensSelect !== false)
{
	if($idTbForumTopicos <> "")
	{
		$statementForumPostagensSelect->bindParam(':id_parent', $idTbForumTopicos, PDO::PARAM_STR);
	}
	$statementForumPostagensSelect->execute();
	/*
	$statementForumPostagensSelect->execute(array(
		"id_tb_categorias" => $idParentForumPostagens
	));
	*/
}
//----------

//$resultadoForumPostagens = $dbSistemaConPDO->query($strSqlForumPostagensSelect);
$resultadoForumPostagens = $statementForumPostagensSelect->fetchAll();

//Paginação.
if($GLOBALS['habilitarForumPostagensSitePaginacao'] == "1"){
	//$paginacaoTotalRegistros = DbFuncoes::CountRegistrosGenericos("tb_cadastro", "id_tb_categorias", $idParentCadastro); //Quantidade de registros.
	//$paginacaoTotalRegistros = DbFuncoes::CountRegistrosGenericos("tb_cadastro", "id_tb_categorias", $idParentCadastro, "", "", "", "", "", ""); //Quantidade de registros.
	$paginacaoTotalRegistros = $resultadoForumPostagens[0]['totalRegistros'];
	$paginacaoTotal = ceil($paginacaoTotalRegistros / $paginacaoNRegistros);
}


//Definição de variáveis.
$tituloLinkAtual = Funcoes::ConteudoMascaraLeitura(DbFuncoes::GetCampoGenerico01($idTbForumTopicos, "tb_forum_topicos", "topico"));
$metaTitulo = $tituloLinkAtual . " - " . Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloSite'], "IncludeConfig");


//Verificação de erro - debug.
//echo "idTemporario=" . Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura(CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroTemporario")), 2) . "<br>";
//echo "tbCadastroNome=" . $ocdCadastroLogado->tbCadastroNome . "<br>";
//echo "tbCadastroRazaoSocial=" . $ocdCadastroLogado->tbCadastroRazaoSocial . "<br>";
//echo "tbCadastroNomeFantasia=" . $ocdCadastroLogado->tbCadastroNomeFantasia . "<br>";
//echo "tbCadastroNomePreferencial=" . $ocdCadastroLogado->tbCadastroNomePreferencial . "<br>";
//echo "idTbCadastroLogado=" . $idTbCadastroLogado . "<br>";
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
    <meta property="og:url" content="<?php echo $configUrl . "/" . $visualizacaoAtivaSistema . "/SiteForumPostagens.php?idTbForumTopicos=" . $idTbForumTopicos; ?>" />
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
    
    
    <?php if($habilitarListagem == 1){ ?>
        <div align="justify" class="ForumTexto01">
            <?php echo Funcoes::ConteudoMascaraLeitura(DbFuncoes::GetCampoGenerico01($idTbForumTopicos, "tb_forum_topicos", "assunto")); ?>
        </div>
    
    
        <?php
        if (empty($resultadoForumPostagens))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="AdmErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteMensagemForumPostagensVazio"); ?>
            </div>
        <?php
        }else{
        ?>
                <table width="100%" class="AdmTabelaDados01">
                  <tr class="AdmTbFundoEscuro">
                    <?php if($GLOBALS['habilitarForumPostagensNClassificacao'] == 1){ ?>
                    <td width="50" class="AdmTabelaDados01Celula" style="display: none;">
                        <div align="center" class="ForumTexto02">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNClassificacaoA"); ?>
                        </div>
                    </td>
                    <?php } ?>
                    
                    <td width="100" class="AdmTabelaDados01Celula" style="display: none;">
                        <div align="center" class="ForumTexto02">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemData"); ?>
                        </div>
                    </td>
                    
                    <td class="AdmTabelaDados01Celula">
                        <div class="ForumTexto02">
                            <?php if($GLOBALS['habilitarForumPostagensClassificacaoPersonalizada'] == 1){ ?>
                                <a href="SiteAdmClassificacaoPersonalizadaExe.php?idRegistro=<?php echo $idParentForumPostagens; ?>&strTabela=tb_forum_postagens&criterioClassificacao=processo<?php echo $queryPadrao; ?><?php echo $queryPadraoRetornoPaginacao; ?>" class="AdmLinks02">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteForumPostagem"); ?>
                                </a>
                             <?php }else{ ?>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteForumPostagem"); ?>
                            <?php } ?>
                        </div>
                    </td>
                  </tr>
                  <?php
                    $countTabelaFundo = 0;
                    
                    
                    //Loop pelos resultados.
                    foreach($resultadoForumPostagens as $linhaForumPostagens)
                    {
                  ?>
                  <tr class="<?php if($countTabelaFundo == 0){ ?>AdmTbFundoClaro<?php }else{?>AdmTbFundoAlternativo<?php } ?>">
                    <?php if($GLOBALS['habilitarForumPostagensNClassificacao'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula" style="display: none;">
                        <div align="center" class="ForumTexto01">
                            <?php echo $linhaForumPostagens['n_classificacao'];?>
                        </div>
                    </td>
                    <?php } ?>
                    
                    <td class="AdmTabelaDados01Celula" style="display: none;">
                        <div align="center" class="ForumTexto01">
                            <?php //echo $linhaForumPostagens['data_produto'];?>
                            <?php echo Funcoes::DataLeitura01($linhaForumPostagens['data_postagem'], $GLOBALS['configSiteFormatoData'], "2");?>
                        </div>
                    </td>
                    
                    <td class="AdmTabelaDados01Celula">
                        <div class="ForumTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($linhaForumPostagens['postagem']);?>
                        </div>
						<?php if($GLOBALS['habilitarForumPostagensNotaAvaliacao'] == "1"){ ?>
                        <div class="ForumTexto01">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteForumPostagemNotaAvaliacao"); ?>: 
                            </strong>
                            <?php echo $linhaForumPostagens['nota_avaliacao'];?>
                            
                            <div style="position: relative; display: block;">
                                <div style="position: relative; display: block; padding-top: 5px;">
                                    <?php
                                    $countNotaAvaliacao = 1;
                                    $countNotaAvaliacaoFinal = $linhaForumPostagens['nota_avaliacao'];
                                    ?>
                                        <?php while($countNotaAvaliacao <= $countNotaAvaliacaoFinal) { ?>
                                            <img src="img/imgAvaliacao01a.png" alt="1" />
                                        <?php 
                                            $countNotaAvaliacao++;
                                        }
                                        ?>
                                </div>
                            </div>
                        </div>
                        <?php } ?>

                        <?php if($GLOBALS['habilitarForumPostagensNome'] == 1){ ?>
                            <?php if($linhaForumPostagens['nome'] <> ""){ ?>
                                <div class="ForumTexto01">
                                    <strong>
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteForumPostagemNome"); ?>: 
                                    </strong>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($linhaForumPostagens['nome']);?>
                                </div>
                            <?php } ?>
                        <?php } ?>
                        <?php if($GLOBALS['habilitarForumPostagensNome'] == 1){ ?>
                            <?php if($linhaForumPostagens['email'] <> ""){ ?>
                                <div class="ForumTexto01">
                                    <strong>
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteForumPostagemEmail"); ?>: 
                                    </strong>
                                    <a href="<?php echo Funcoes::ConteudoMascaraLeitura($linhaForumPostagens['email']);?>" class="ForumLinks01">
                                        <?php echo Funcoes::ConteudoMascaraLeitura($linhaForumPostagens['email']);?>
                                    </a>
                                </div>
                            <?php } ?>
                        <?php } ?>
                        
                        <?php if($linhaForumPostagens['id_tb_cadastro_usuario'] <> 0){ ?>
                            <div class="ForumTexto01">
                                <strong>
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteForumPostagensCadastroUsuario"); ?>:  
                                </strong>
                                <a href="SiteCadastroDetalhes.php?idTbCadastro=<?php echo $linhaForumPostagens['id_tb_cadastro_usuario'];?>" target="_blank" class="ForumLinks01">
                                    <?php //echo Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaTarefas['id_parent'], "tb_cadastro", "nome"); ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaForumPostagens['id_tb_cadastro_usuario'], "tb_cadastro", "nome"), 
                                    DbFuncoes::GetCampoGenerico01($linhaForumPostagens['id_tb_cadastro_usuario'], "tb_cadastro", "razao_social"), 
                                    DbFuncoes::GetCampoGenerico01($linhaForumPostagens['id_tb_cadastro_usuario'], "tb_cadastro", "nome_fantasia"), 
                                    1)); ?>
                                </a>
                            </div>
                        <?php } ?>
                        
                        <div align="left" class="ForumTexto01">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteForumPostagemData"); ?>:
                            </strong>
                            <?php echo Funcoes::DataLeitura01($linhaForumPostagens['data_postagem'], $GLOBALS['configSiteFormatoData'], "2");?>
                        </div>
                        
                        <div style="/*background-color: #000000; */height: 30px;">
                        
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
        <?php if($GLOBALS['habilitarForumPostagensSitePaginacao'] == "1"){ ?>
            <?php if($paginacaoTotal > 1){ //Verifica se existe mais de uma página.?>
                <div align="center" class="ForumTexto01">
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
                    <?php if($GLOBALS['habilitarForumPostagensSitePaginacaoNumeracao'] == "1"){ ?>
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
                <div align="center" class="ForumTexto01">
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePaginacaoPaginaContador01"); ?> 
                    <?php echo $paginacaoNumero; ?> / <?php echo $paginacaoTotal; ?>
                </div>
            <?php } ?>
        <?php } ?>
        <?php //************************************************************************************** ?>
	<?php } ?>


	<?php if(Formularios::FormularioExibir01($GLOBALS['configForumPostagensAcesso'] == true)){ ?>
		<?php if($habilitarInclusao == 1){ ?>
        <div class="ForumTexto01" style="position: relative; display: block; overflow: hidden;">
            <script type="text/javascript">
                $(document).ready(function () {
                    
                    /*
                    $.validator.addMethod(
                            "alphabetsOnly",
                            function(value, element, regexp) {
                                var re = new RegExp(regexp);
                                return this.optional(element) || re.test(value);
                            },
                            "Please check your input values again!!!."
                    );
                    */
                    //Parâmetro personalizado.
                    //**************************************************************************************
                    jQuery.validator.addMethod("accept", function(value, element, param) {
                        //return value.match(new RegExp("^" + param + "$"));
                        return value.match(new RegExp(param));
                    });	
                    //**************************************************************************************
        
                        
                    //Validação de formulário (JQuery).
                    //**************************************************************************************
                    $('#formForumPostagens').validate({ //Inicialização do plug-in.
                    
                    
                        //Estilo da mensagem de erro.
                        //----------------------
                        errorClass: "AdmErro",
                        //----------------------
                        
                        
                        //Validação
                        //----------------------
                        rules: {
                            n_classificacao: {
                                required: true,
                                //regex: /-?\d+(\.\d{1,3})?/
                                number: true
                            }
                        },
                        
                        
                        //Mensagens.
                        //----------------------
                        messages: {
                            //n_classificacao: "Please specify your name"//,
                            n_classificacao: {
                              //required: "Campo obrigatório.",
                              required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>",
                              //regex: "Campo numérico."
                              //number: "Campo numérico."
                              number: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica1"); ?>"
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
            <form name="formForumPostagens" id="formForumPostagens" action="SiteAdmForumPostagensIndiceExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
                <table class="AdmTabelaCampos01">
                    <tr>
                        <td class="AdmTbFundoEscuro" colspan="4">
                            <div align="center" class="ForumTexto02">
                                <strong>
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteForumPostagensTbPostagens"); ?> 
                                </strong>
                            </div>
                        </td>
                    </tr>
        
                    <?php if($GLOBALS['habilitarForumPostagensNClassificacao'] == "1"){ ?>
                    <tr>
                        <td class="AdmTbFundoMedio TabelaColuna01">
                            <div align="left">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNClassificacao"); ?>:
                            </div>
                        </td>
                        <td class="AdmTbFundoClaro" colspan="3">
                            <div>
                                <input type="text" name="n_classificacao" id="n_classificacao" class="ForumCampoNumerico01" maxlength="10" value="0" />
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
        
                    <?php if($GLOBALS['habilitarForumPostagensNome'] == "1"){ ?>
                    <tr>
                        <td class="AdmTbFundoMedio TabelaColuna01">
                            <div align="left">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteForumPostagemNome"); ?>:
                            </div>
                        </td>
                        <td class="AdmTbFundoClaro" colspan="3">
                            <div>
                                <?php if($GLOBALS['configForumPostagensEdicaoIdentificacao'] == "1"){ ?>
                                    <input type="text" name="nome" id="nome" class="ForumCampoTexto01" maxlength="255" value="<?php echo $ocdCadastroLogado->tbCadastroNomePreferencial;?>" />
                                <?php }else{ ?>
                                    <?php echo $ocdCadastroLogado->tbCadastroNomePreferencial;?>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
        
                    <?php if($GLOBALS['habilitarForumPostagensEmail'] == "1"){ ?>
                    <tr>
                        <td class="AdmTbFundoMedio TabelaColuna01">
                            <div align="left">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteForumPostagemEmail"); ?>:
                            </div>
                        </td>
                        <td class="AdmTbFundoClaro" colspan="3">
                            <div>
                                <?php if($GLOBALS['configForumPostagensEdicaoIdentificacao'] == "1"){ ?>
                                    <input type="text" name="email" id="email" class="ForumCampoTexto01" maxlength="255" value="<?php echo $ocdCadastroLogado->tbCadastroEmailPrincipal;?>" />
                                <?php }else{ ?>
                                    <?php echo $ocdCadastroLogado->tbCadastroEmailPrincipal;?>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                    
                    <?php if($GLOBALS['habilitarForumPostagensNotaAvaliacao'] == "1"){ ?>
                    <tr>
                        <td class="AdmTbFundoMedio TabelaColuna01">
                            <div align="left">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteForumPostagemNotaAvaliacao"); ?>:
                            </div>
                        </td>
                        <td class="AdmTbFundoClaro" colspan="3">
                            <div>
								<?php
                                $countNotaAvaliacao = 1;
                                $countNotaAvaliacaoFinal = $GLOBALS['configForumPostagensNotaAvaliacao'];
                                ?>
                                <select name="nota_avaliacao" id="nota_avaliacao" class="ForumDropDownMenu01">
                                    <?php while($countNotaAvaliacao <= $countNotaAvaliacaoFinal) { ?>
                                        <option value="<?php echo $countNotaAvaliacao;?>"><?php echo $countNotaAvaliacao;?></option>
                                    <?php 
                                        $countNotaAvaliacao++;
                                    }
                                    ?>
                                </select>
                            </div>
                            
                            <div style="position: relative; display: block;">
                                <div style="position: relative; display: block; padding-top: 18px;">
                                    <img id="avaliacao1" src="img/imgAvaliacao01.png" alt="1" onclick="dropDownSelect_onClick('nota_avaliacao','1');imagemSrcAlterar('avaliacao1','img/imgAvaliacao01a.png');imagemSrcAlterar('avaliacao2','img/imgAvaliacao01.png');imagemSrcAlterar('avaliacao3','img/imgAvaliacao01.png');imagemSrcAlterar('avaliacao4','img/imgAvaliacao01.png');imagemSrcAlterar('avaliacao5','img/imgAvaliacao01.png');" style="cursor: pointer;" />
                                    <img id="avaliacao2" src="img/imgAvaliacao01.png" alt="2" onclick="dropDownSelect_onClick('nota_avaliacao','2');imagemSrcAlterar('avaliacao1','img/imgAvaliacao01a.png');imagemSrcAlterar('avaliacao2','img/imgAvaliacao01a.png');imagemSrcAlterar('avaliacao3','img/imgAvaliacao01.png');imagemSrcAlterar('avaliacao4','img/imgAvaliacao01.png');imagemSrcAlterar('avaliacao5','img/imgAvaliacao01.png');" style="cursor: pointer;" />
                                    <img id="avaliacao3" src="img/imgAvaliacao01.png" alt="3" onclick="dropDownSelect_onClick('nota_avaliacao','3');imagemSrcAlterar('avaliacao1','img/imgAvaliacao01a.png');imagemSrcAlterar('avaliacao2','img/imgAvaliacao01a.png');imagemSrcAlterar('avaliacao3','img/imgAvaliacao01a.png');imagemSrcAlterar('avaliacao4','img/imgAvaliacao01.png');imagemSrcAlterar('avaliacao5','img/imgAvaliacao01.png');" style="cursor: pointer;" />
                                    <img id="avaliacao4" src="img/imgAvaliacao01.png" alt="4" onclick="dropDownSelect_onClick('nota_avaliacao','4');imagemSrcAlterar('avaliacao1','img/imgAvaliacao01a.png');imagemSrcAlterar('avaliacao2','img/imgAvaliacao01a.png');imagemSrcAlterar('avaliacao3','img/imgAvaliacao01a.png');imagemSrcAlterar('avaliacao4','img/imgAvaliacao01a.png');imagemSrcAlterar('avaliacao5','img/imgAvaliacao01.png');" style="cursor: pointer;" />
                                    <img id="avaliacao5" src="img/imgAvaliacao01.png" alt="5" onclick="dropDownSelect_onClick('nota_avaliacao','5');imagemSrcAlterar('avaliacao1','img/imgAvaliacao01a.png');imagemSrcAlterar('avaliacao2','img/imgAvaliacao01a.png');imagemSrcAlterar('avaliacao3','img/imgAvaliacao01a.png');imagemSrcAlterar('avaliacao4','img/imgAvaliacao01a.png');imagemSrcAlterar('avaliacao5','img/imgAvaliacao01a.png');" style="cursor: pointer;" />
                                </div>
                            </div>
                        </td>
                    </tr>
					<?php } ?>
                    
                    <tr>
                        <td class="AdmTbFundoMedio TabelaColuna01">
                            <div align="left">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteForumPostagem"); ?>:
                            </div>
                        </td>
                        <td class="AdmTbFundoClaro" colspan="3">
                            <div>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="postagem" id="postagem" class="ForumCampoTextoMultilinha01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#descricao01").cleditor(
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
                                    <textarea name="postagem" id="postagem"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#descricao01").cleditor(
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
                                    <textarea name="postagem" id="postagem"></textarea>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                </table>
                <div>
                    <div align="center" style="/*float:left;*/">
                        <input type="image" name="submit" value="Submit" src="img/btoIncluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoIncluir"); ?>" />
                        
                        <input type="hidden" id="id_parent" name="id_parent" value="<?php echo $idTbForumTopicos; ?>" />
                        <input type="hidden" id="ativacao" name="ativacao" value="<?php echo $GLOBALS['configForumPostagensAtivacao']; ?>" />
                        
                        <input type="hidden" id="habilitarListagem" name="habilitarListagem" value="<?php echo $habilitarListagem; ?>" />
                        <input type="hidden" id="habilitarInclusao" name="habilitarInclusao" value="<?php echo $habilitarInclusao; ?>" />
                        <input type="hidden" id="habilitarDetalhes" name="habilitarDetalhes" value="<?php echo $habilitarDetalhes; ?>" />
                        <input type="hidden" id="habilitarBusca" name="habilitarBusca" value="<?php echo $habilitarBusca; ?>" />
                        
                        <input type="hidden" id="paginaRetorno" name="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                        <input type="hidden" id="masterPageSiteSelect" name="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
                    </div>
                    <!--div style="float:right;">
                        &nbsp;
                    </div-->
                </div>
            </form>
        </div>
        <?php } ?>
	<?php } ?>
    
    
    <div align="center">
		<a href="javascript:history.go(-1);">
			<img src="img/btoVoltar.png" border="0" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoVoltar"); ?>" />
		</a>
    </div>
<?php 
$pageSite->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php
//Limpeza de objetos.
//----------
unset($strSqlForumPostagensSelect);
unset($statementForumPostagensSelect);
unset($resultadoForumPostagens);
unset($linhaForumPostagens);

unset($ocdCadastroLogado);
//----------


//Inclusão do template do layout.
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>