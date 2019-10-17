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
$idTbForumTopicos = $_GET["idTbForumTopicos"];
$idParentCategoriasRaiz = $_GET["idParentCategoriasRaiz"];
if($idParentCategoriasRaiz == "")
{
	$idParentCategoriasRaiz = 0;
}
$idTbCadastroLogado = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura(CookiesFuncoes::CookieValorLer_Login()), 2);

$idTbCadastroUsuario = $_GET["idTbCadastroUsuario"];
if($idTbCadastroUsuario == "")
{
	$idTbCadastroUsuario = 0;
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

//&habilitarListagem=1&habilitarInclusao=1&habilitarDetalhes=0&habilitarBusca=0
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
$habilitarBusca = $_GET["habilitarBusca"]; //Botão Incluir teste acionado.
if($habilitarBusca == "")
{
	$habilitarBusca = 0; //padrão: 0 - desabilitar
}

$tituloLinkAtual = "";
$metaTitulo = "";
$metaDescricao = "";
$metaPalavrasChave = "";

$paginaRetorno = "SiteAdmForumPostagensIndice.php";
$paginaRetornoExclusao = "SiteAdmForumPostagensEditar.php";
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
"&habilitarListagem=" . $habilitarListagem . 
"&habilitarInclusao=" . $habilitarInclusao . 
"&habilitarDetalhes=" . $habilitarDetalhes . 
"&habilitarBusca=" . $habilitarBusca . 
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
$tituloLinkAtual = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAdmPainelForumPostagensAdministrar");
$metaTitulo = $tituloLinkAtual . " - " . Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloSite'], "IncludeConfig");


//Verificação de erro - debug.
//echo "habilitarListagem=" . $habilitarListagem . "<br />";
//echo "habilitarInclusao=" . $habilitarInclusao . "<br />";
//echo "habilitarDetalhes=" . $habilitarDetalhes . "<br />";
//echo "habilitarBusca=" . $habilitarBusca . "<br />";
//echo "idTbForumTopicos=" . $idTbForumTopicos . "<br />";
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
    
    <?php if($habilitarListagem == 1){ ?>
    <?php
	//if (empty($resultadoForumPostagens))
	//{
        //echo "Nenhum registro encontrado";
    ?>
        <div align="center" class="AdmErro" style="display: none;">
            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteMensagemForumPostagensVazio"); ?>
        </div>
    <?php
    //}else{
    ?>

        <form name="formForumPostagensAcoes" id="formForumPostagensAcoes" action="SiteAdmRegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input type="hidden" id="strTabela" name="strTabela" value="tb_forum_postagens" />
            <input type="hidden" id="idTbForumTopicos" name="idTbForumTopicos" value="<?php echo $idTbForumTopicos; ?>" />

            <input type="hidden" id="habilitarListagem" name="habilitarListagem" value="<?php echo $habilitarListagem; ?>" />
            <input type="hidden" id="habilitarInclusao" name="habilitarInclusao" value="<?php echo $habilitarInclusao; ?>" />
            <input type="hidden" id="habilitarDetalhes" name="habilitarDetalhes" value="<?php echo $habilitarDetalhes; ?>" />
            <input type="hidden" id="habilitarBusca" name="habilitarBusca" value="<?php echo $habilitarBusca; ?>" />

            <input type="hidden" id="paginaRetorno" name="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            <input type="hidden" id="masterPageSiteSelect" name="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
            <input type="hidden" id="paginacaoNumero" name="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input type="hidden" id="caracterAtual" name="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            
            <div style="position: relative; display: block; width: 99%; /*height: 300px;border: 1px solid #000000;  */background-color: #ffffff; /*overflow: auto;*/">
            <table width="100%" class="AdmTabelaDados01">
              <tr class="">
              	<?php if($habilitarBusca == 1){ ?>
                <td width="20" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmErro">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemExcluir"); ?>
                    </div>
                </td>
                <td width="20" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                    </div>
                </td>
              	<?php } ?>
                
              	<?php if($GLOBALS['habilitarForumPostagensNClassificacao'] == 1){ ?>
                <td width="50" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php if($GLOBALS['habilitarForumPostagensClassificacaoPersonalizada'] == 1){ ?>
                            <a href="SiteAdmClassificacaoPersonalizadaExe.php?idRegistro=<?php echo $idParentForumPostagens; ?>&strTabela=tb_forum_postagens&criterioClassificacao=n_classificacao<?php echo $queryPadrao; ?><?php echo $queryPadraoRetornoPaginacao; ?>" class="AdmLinks02">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNClassificacaoA"); ?>
                            </a>
                         <?php }else{ ?>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNClassificacaoA"); ?>
                        <?php } ?>
                    </div>
                </td>
                <?php } ?>
                
                <td width="100" class="AdmTabelaDados01Celula" style="display: none;">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemData"); ?>
                    </div>
                </td>
                
                <td class="AdmTabelaDados01Celula">
                    <div class="AdmTexto02" style="font-size: 9px !important;">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloForumPostagensIc1'], "IncludeConfig");; ?>
                    </div>
                </td>
                <td class="AdmTabelaDados01Celula">
                    <div class="AdmTexto02" style="font-size: 9px !important;">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloForumPostagensIc2'], "IncludeConfig");; ?>
                    </div>
                </td>
                
                <td class="AdmTabelaDados01Celula">
                    <div class="AdmTexto02" style="font-size: 9px !important;">
						<?php if($GLOBALS['habilitarForumPostagensClassificacaoPersonalizada'] == 1){ ?>
                            <a href="SiteAdmClassificacaoPersonalizadaExe.php?idRegistro=<?php echo $idParentForumPostagens; ?>&strTabela=tb_forum_postagens&criterioClassificacao=processo<?php echo $queryPadrao; ?><?php echo $queryPadraoRetornoPaginacao; ?>" class="AdmLinks02">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteForumPostagem"); ?>
                            </a>
                         <?php }else{ ?>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteForumPostagem"); ?>
                        <?php } ?>
                    </div>
                </td>
                
                <td width="100" class="AdmTabelaDados01Celula" style="display: none;">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFuncoes"); ?>
                    </div>
                </td>
                
                <td width="30" class="AdmTabelaDados01Celula" style="display: none;">
                    <div align="center" class="AdmTexto02">
                        <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao"); ?>
						<?php if($GLOBALS['habilitarForumPostagensClassificacaoPersonalizada'] == 1){ ?>
                            <a href="SiteAdmClassificacaoPersonalizadaExe.php?idRegistro=<?php echo $idParentForumPostagens; ?>&strTabela=tb_forum_postagens&criterioClassificacao=ativacao<?php echo $queryPadrao; ?><?php echo $queryPadraoRetornoPaginacao; ?>" class="AdmLinks02">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao"); ?>
                            </a>
                         <?php }else{ ?>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao"); ?>
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
              <tr>
              	<?php if($habilitarBusca == 1){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                    	<?php //if($idTbCadastroLogado == $linhaForumPostagens['id_tb_cadastro_usuario']){ ?>
                        <?php if(CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroUsuario") <> ""){ ?>
                            <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaForumPostagens['id'];?>" class="CampoCheckBox01" />
                        <?php } ?>
                        <?php //} ?>
                    </div>
                </td>
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                    	<?php if(CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroUsuario") <> ""){ ?>
                        <a onclick="" style="cursor: pointer;">
                        	<img onclick="parent.iframeLoad('iframeManutencaoAjax', 'SiteAdmForumPostagensEditar.php?idTbForumPostagens=<?php echo $linhaForumPostagens['id'];?>&masterPageSiteSelect=LayoutSiteIFrame.php&habilitarListagem=1&habilitarInclusao=1&habilitarDetalhes=0&habilitarBusca=0', '', '', '');
                                          parent.divShow('divManutencaoAjax');
                                          parent.HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');iframeRecarregar(\'iframeAdmForumPostagens\', \'\');');" src="img/btoEditar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>" />
                        </a>
                        <?php } ?>
                        
                    	<?php //if($idTbCadastroLogado == $linhaForumPostagens['id_tb_cadastro_usuario']){ ?>
                            <a href="SiteAdmForumPostagensEditar.php?idTbForumPostagens=<?php echo $linhaForumPostagens['id'];?><?php echo $queryPadrao;?>" class="AdmLinks01" style="display: none;">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                            </a>
                        <?php //} ?>
                    </div>
                </td>
				<?php } ?>
                
              	<?php if($GLOBALS['habilitarForumPostagensNClassificacao'] == 1){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <?php echo $linhaForumPostagens['n_classificacao'];?>
                    </div>
                </td>
                <?php } ?>
                
                <td class="AdmTabelaDados01Celula" style="display: none;">
                    <div align="center" class="AdmTexto01">
                        <?php //echo $linhaForumPostagens['data_produto'];?>
                        <?php echo Funcoes::DataLeitura01($linhaForumPostagens['data_postagem'], $GLOBALS['configSiteFormatoData'], "2");?>
                    </div>
                </td>
                
                <td class="AdmTabelaDados01Celula">
                    <div class="AdmTexto01">
                    	<?php echo Funcoes::ConteudoMascaraLeitura($linhaForumPostagens['informacao_complementar1']);?>
                    </div>
                </td>
                <td class="AdmTabelaDados01Celula">
                    <div class="AdmTexto01">
                    	<?php echo Funcoes::ConteudoMascaraLeitura($linhaForumPostagens['informacao_complementar2']);?>
                    </div>
                </td>

                <td class="AdmTabelaDados01Celula">
                    <div class="AdmTexto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaForumPostagens['postagem']);?>
                    </div>
                </td>
                
                <td class="AdmTabelaDados01Celula" style="display: none;">
                    <div align="center" class="AdmTexto01">
                    	<a href="../<?php echo $GLOBALS['visualizacaoAtivaSistema'];?>/SiteForumPostagensDetalhes.php?idTbForumPostagens=<?php echo $linhaForumPostagens['id'];?>" target="_blank" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemVisualizacao"); ?>
                        </a>
                    </div>
                </td>
                
                <td class="<?php if($linhaForumPostagens['ativacao'] == 1){/*echo "AdmTbFundoClaro";*/}else{echo "AdmTbFundoDesativado";}?> AdmTabelaDados01Celula" style="display: none;">
                    <div align="center" class="AdmTexto01">
                    	<a href="SiteAdmRegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaForumPostagens['id'];?>&statusAtivacao=<?php echo $linhaForumPostagens['ativacao'];?>&strTabela=tb_forum_postagens&strCampo=ativacao<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="AdmLinks01">
                        	<?php if($linhaForumPostagens['ativacao'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao0"); ?>
                            <?php } ?>
                        	<?php if($linhaForumPostagens['ativacao'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao1"); ?>
                            <?php } ?>
                        </a>
						<?php //echo $linhaForumPostagens['ativacao'];?>
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
            
            <?php if($habilitarBusca == 1){ ?>
            <div style="position:relative; display: none; overflow: hidden; clear: both;">
            	<?php if($GLOBALS['habilitarForumPostagensClassificacaoPersonalizada'] == 1){ ?>
                    <div align="left" style="float: left;">
                        <a href="SiteAdmClassificacaoPersonalizadaExe.php?idRegistro=<?php echo $idParentForumPostagens; ?>&strTabela=tb_forum_postagens&strExcluir=1<?php echo $queryPadrao; ?><?php echo $queryPadraoRetornoPaginacao; ?>" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemClassificacaoPadrao"); ?>
                        </a>
                    </div>
                <?php } ?>
                
                <div align="right" style="float: right;">
                    <input type="image" name="submit" value="Submit" src="img/btoExcluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoExcluir"); ?>">
                </div>
                
                <?php if($habilitarInclusao == 0){ ?>
                <div align="left" style="float: left; display: none;">
                    <div class="AdmDivBto01" onclick="parent.iframeLoad('iframeManutencaoAjax', 'SiteAdmForumPostagensIndice.php?idTbForumTopicos=<?php echo $idTbForumTopicos; ?>&masterPageSiteSelect=LayoutSiteIFrame.php&habilitarListagem=1&habilitarInclusao=1&habilitarDetalhes=0&habilitarBusca=0', '', '', '');
                                                      parent.divShow('divManutencaoAjax');
                                                      parent.HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');iframeRecarregar(\'iframeAdmForumPostagens\', \'\');');">
                        <a class="AdmLinks01">
                            Incluir Teste
                        </a>
                    </div>
                    
                    <img onclick="parent.iframeLoad('iframeManutencaoAjax', 'SiteAdmForumPostagensIndice.php?idTbForumTopicos=<?php echo $idTbForumTopicos; ?>&masterPageSiteSelect=LayoutSiteIFrame.php&habilitarListagem=1&habilitarInclusao=1&habilitarDetalhes=0&habilitarBusca=0', '', '', '');
                                  parent.divShow('divManutencaoAjax');
                                  parent.HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');iframeRecarregar(\'iframeAdmForumPostagens\', \'\');');" src="img/btoIncluirTeste.png" alt="Incluir Teste" style="cursor: pointer; display: none;" />
                </div>
                
                <div style="text-align: center; display: none;">
                    <div class="AdmDivBto01" onclick="parent.iframeLoad('iframeManutencaoAjax', 'SiteAdmForumPostagensIndice.php?idTbForumTopicos=<?php echo $idTbForumTopicos; ?>&masterPageSiteSelect=LayoutSiteIFrame.php&habilitarListagem=1&habilitarInclusao=0&habilitarDetalhes=0&habilitarBusca=0', '', '', '');
                                                      parent.divShow('divManutencaoAjax');
                                                      parent.HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');iframeRecarregar(\'iframeAdmForumPostagens\', \'\');');" style="margin-right: 0px;">
                        <a class="AdmLinks01">
                            Visualizar Mapa
                        </a>
                    </div>

                    <img onclick="parent.iframeLoad('iframeManutencaoAjax', 'SiteAdmForumPostagensIndice.php?idTbForumTopicos=<?php echo $idTbForumTopicos; ?>&masterPageSiteSelect=LayoutSiteIFrame.php&habilitarListagem=1&habilitarInclusao=0&habilitarDetalhes=0&habilitarBusca=0', '', '', '');
                                  parent.divShow('divManutencaoAjax');
                                  parent.HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');iframeRecarregar(\'iframeAdmForumPostagens\', \'\');');" src="img/btoVisualizacaoMapa.png" alt="Visualizar Mapa" style="cursor: pointer; display: none;" />
                </div>
                <?php } ?>
            </div>
            <?php } ?>
        </form>
	<?php } ?>
    
	<?php //Paginação. ?>
    <?php //************************************************************************************** ?>
    <?php if($GLOBALS['habilitarForumPostagensSitePaginacao'] == "1"){ ?>
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
            <div align="center" class="AdmTexto01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePaginacaoPaginaContador01"); ?> 
                <?php echo $paginacaoNumero; ?> / <?php echo $paginacaoTotal; ?>
            </div>
        <?php } ?>
	<?php //} ?>
	<?php //************************************************************************************** ?>
    <?php } ?>

    <?php if($habilitarInclusao == 1){ ?>
    <?php if(!empty($idTbForumTopicos)){ ?>
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
    <div style="position: relative; display: block; overflow: hidden;">
        <table class="AdmTabelaCampos01">
            <tr>
                <td class="AdmTbFundoEscuro" colspan="4">
                    <div align="center" class="AdmTexto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteForumPostagensTbPostagens"); ?> 
                        </strong>
                    </div>
                </td>
            </tr>

            <?php if($GLOBALS['habilitarForumPostagensNClassificacao'] == "1"){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNClassificacao"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div>
                        <input type="text" name="n_classificacao" id="n_classificacao" class="AdmCampoNumerico01" maxlength="10" value="0" />
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarForumPostagensNome'] == "1"){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteForumPostagemNome"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div>
                        <input type="text" name="nome" id="nome" class="AdmCampoTexto02" maxlength="255" />
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarForumPostagensEmail'] == "1"){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteForumPostagemEmail"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div>
                        <input type="text" name="email" id="email" class="AdmCampoTexto02" maxlength="255" />
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarForumPostagensIc1'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloForumPostagensIc1'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configForumPostagensBoxIc1'] == 1){ ?>
                            <input type="text" name="informacao_complementar1" id="informacao_complementar1" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configForumPostagensBoxIc1'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar1" id="informacao_complementar1" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar1").cleditor(
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
                                <textarea name="informacao_complementar1" id="informacao_complementar1"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar1").cleditor(
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
                                <textarea name="informacao_complementar1" id="informacao_complementar1"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarForumPostagensIc2'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloForumPostagensIc2'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configForumPostagensBoxIc2'] == 1){ ?>
                            <input type="text" name="informacao_complementar2" id="informacao_complementar2" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configForumPostagensBoxIc2'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar2" id="informacao_complementar2" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar2").cleditor(
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
                                <textarea name="informacao_complementar2" id="informacao_complementar2"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar2").cleditor(
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
                                <textarea name="informacao_complementar2" id="informacao_complementar2"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarForumPostagensIc3'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloForumPostagensIc3'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configForumPostagensBoxIc3'] == 1){ ?>
                            <input type="text" name="informacao_complementar3" id="informacao_complementar3" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configForumPostagensBoxIc3'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar3" id="informacao_complementar3" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar3").cleditor(
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
                                <textarea name="informacao_complementar3" id="informacao_complementar3"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar3").cleditor(
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
                                <textarea name="informacao_complementar3" id="informacao_complementar3"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarForumPostagensIc4'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloForumPostagensIc4'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configForumPostagensBoxIc4'] == 1){ ?>
                            <input type="text" name="informacao_complementar4" id="informacao_complementar4" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configForumPostagensBoxIc4'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar4" id="informacao_complementar4" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar4").cleditor(
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
                                <textarea name="informacao_complementar4" id="informacao_complementar4"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar4").cleditor(
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
                                <textarea name="informacao_complementar4" id="informacao_complementar4"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarForumPostagensIc5'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloForumPostagensIc5'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configForumPostagensBoxIc5'] == 1){ ?>
                            <input type="text" name="informacao_complementar5" id="informacao_complementar5" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configForumPostagensBoxIc5'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar5" id="informacao_complementar5" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar5").cleditor(
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
                                <textarea name="informacao_complementar5" id="informacao_complementar5"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar5").cleditor(
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
                                <textarea name="informacao_complementar5" id="informacao_complementar5"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarForumPostagensIc6'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloForumPostagensIc6'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configForumPostagensBoxIc6'] == 1){ ?>

                            <input type="text" name="informacao_complementar6" id="informacao_complementar6" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configForumPostagensBoxIc6'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar6" id="informacao_complementar6" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar6").cleditor(
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
                                <textarea name="informacao_complementar6" id="informacao_complementar6"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar6").cleditor(
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
                                <textarea name="informacao_complementar6" id="informacao_complementar6"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarForumPostagensIc7'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloForumPostagensIc7'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configForumPostagensBoxIc7'] == 1){ ?>
                            <input type="text" name="informacao_complementar7" id="informacao_complementar7" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configForumPostagensBoxIc7'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar7" id="informacao_complementar7" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar7").cleditor(
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
                                <textarea name="informacao_complementar7" id="informacao_complementar7"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar7").cleditor(
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
                                <textarea name="informacao_complementar7" id="informacao_complementar7"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarForumPostagensIc8'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloForumPostagensIc8'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configForumPostagensBoxIc8'] == 1){ ?>
                            <input type="text" name="informacao_complementar8" id="informacao_complementar8" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configForumPostagensBoxIc8'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar8" id="informacao_complementar8" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar8").cleditor(
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
                                <textarea name="informacao_complementar8" id="informacao_complementar8"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar8").cleditor(
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
                                <textarea name="informacao_complementar8" id="informacao_complementar8"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarForumPostagensIc9'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloForumPostagensIc9'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configForumPostagensBoxIc9'] == 1){ ?>
                            <input type="text" name="informacao_complementar9" id="informacao_complementar9" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configForumPostagensBoxIc9'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar9" id="informacao_complementar9" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar9").cleditor(
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
                                <textarea name="informacao_complementar9" id="informacao_complementar9"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar9").cleditor(
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
                                <textarea name="informacao_complementar9" id="informacao_complementar9"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarForumPostagensIc10'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloForumPostagensIc10'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configForumPostagensBoxIc10'] == 1){ ?>
                            <input type="text" name="informacao_complementar10" id="informacao_complementar10" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configForumPostagensBoxIc10'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar10" id="informacao_complementar10" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar10").cleditor(
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
                                <textarea name="informacao_complementar10" id="informacao_complementar10"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar10").cleditor(
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
                                <textarea name="informacao_complementar10" id="informacao_complementar10"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteForumPostagem"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div>
                        <?php //Sem formatação.?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                        
                            <!--textarea name="postagem" id="postagem" class="AdmCampoTextoMultilinha01" style="width: 280px;"></textarea-->
                            
                            <input type="text" name="postagem" id="postagem" class="AdmCampoTexto02" maxlength="255" />
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

            <tr style="display: none;">
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao3"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <select name="ativacao" id="ativacao" class="AdmCampoDropDownMenu01">
                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao4"); ?></option>
                            <option value="1" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao5"); ?></option>
                        </select>
                    </div>
                </td>
            </tr>

        </table>
        <div>
            <div style="float:left;">
                <div class="AdmDivBto01"  onclick="btoClick_onEvent('btoForumPostagensIncluir');" style="margin-right: 0px;">
                    <a class="AdmLinks01">
                        Incluir
                    </a>
                </div>
                <input id="btoForumPostagensIncluir" type="image" name="submit" value="Submit" src="img/btoIncluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoIncluir"); ?>" style="display: none;" />
                
                <input type="hidden" id="id_parent" name="id_parent" value="<?php echo $idTbForumTopicos; ?>" />
                
                <input type="hidden" id="habilitarListagem" name="habilitarListagem" value="<?php echo $habilitarListagem; ?>" />
                <input type="hidden" id="habilitarInclusao" name="habilitarInclusao" value="<?php echo $habilitarInclusao; ?>" />
                <input type="hidden" id="habilitarDetalhes" name="habilitarDetalhes" value="<?php echo $habilitarDetalhes; ?>" />
                <input type="hidden" id="habilitarBusca" name="habilitarBusca" value="<?php echo $habilitarBusca; ?>" />
                
                <input type="hidden" id="paginaRetorno" name="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                <input type="hidden" id="masterPageSiteSelect" name="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
            </div>
            
            <div style="float:right;">
                <div class="AdmDivBto01"  onclick="parent.btoClick_onEvent('linkManutencaoAjaxFechar');" style="margin-right: 0px;">
                    <a class="AdmLinks01">
                        Anexar / Fechar
                    </a>
                </div>
                
            	<img onclick="parent.btoClick_onEvent('linkManutencaoAjaxFechar');" src="img/btoAnexar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoSalvar"); ?>" style="cursor: pointer; display: none;" />
            </div>
        </div>
        
        <br />
    </div>
    </form>
	<?php } ?>
    <?php } ?>
    
    <?php if($habilitarInclusao == 0 && $habilitarBusca == 0){?>
    <div align="center">
        <div class="AdmDivBto01"  onclick="parent.btoClick_onEvent('linkManutencaoAjaxFechar');" style="margin-right: 0px;">
            <a class="AdmLinks01">
                Anexar / Fechar
            </a>
        </div>
    </div>
    <?php } ?>
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
//----------


//Inclusão do template do layout.
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>