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
$idParentForum = DbFuncoes::GetCampoGenerico01($idTbForumTopicos, "tb_forum_topicos", "id_tb_categorias");
$idParentCategoriasRaiz = $_GET["idParentCategoriasRaiz"];
if($idParentCategoriasRaiz == "")
{
	$idParentCategoriasRaiz = 0;
}

$paginaRetorno = "SiteAdmForumTopicosIndice.php";
$paginaRetornoExclusao = "SiteAdmForumTopicosEditar.php";
$variavelRetorno = "idTbForumTopicos";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];


//Montagem de query padrão de retorno.
$queryPadrao = "&idParentForum=" . $idParentForum . 
"&idTbCadastroUsuario=" . $idTbCadastroUsuario . 
"&paginaRetorno=" . $paginaRetorno . 
"&masterPageSiteSelect=" . $masterPageSiteSelect . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&variavelRetorno=" . $variavelRetorno;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Query de pesquisa.
//----------
$strSqlForumTopicosDetalhesSelect = "";
$strSqlForumTopicosDetalhesSelect .= "SELECT ";
//$strSqlForumTopicosDetalhesSelect .= "* ";
$strSqlForumTopicosDetalhesSelect .= "id, ";
$strSqlForumTopicosDetalhesSelect .= "id_tb_categorias, ";
$strSqlForumTopicosDetalhesSelect .= "id_tb_cadastro_vendedor, ";
$strSqlForumTopicosDetalhesSelect .= "id_tb_cadastro_usuario, ";
$strSqlForumTopicosDetalhesSelect .= "n_classificacao, ";
$strSqlForumTopicosDetalhesSelect .= "data_topico, ";
$strSqlForumTopicosDetalhesSelect .= "topico, ";
$strSqlForumTopicosDetalhesSelect .= "assunto, ";
$strSqlForumTopicosDetalhesSelect .= "ativacao, ";
$strSqlForumTopicosDetalhesSelect .= "acesso_restrito ";
$strSqlForumTopicosDetalhesSelect .= "FROM tb_forum_topicos ";
$strSqlForumTopicosDetalhesSelect .= "WHERE id <> 0 ";
//$strSqlForumTopicosDetalhesSelect .= "AND id_tb_categorias = :id_tb_categorias ";
$strSqlForumTopicosDetalhesSelect .= "AND id = :id ";
//$strSqlForumTopicosDetalhesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
//----------


//Parâmetros.
//----------
$statementForumTopicosDetalhesSelect = $dbSistemaConPDO->prepare($strSqlForumTopicosDetalhesSelect);

if ($statementForumTopicosDetalhesSelect !== false)
{
	$statementForumTopicosDetalhesSelect->execute(array(
		"id" => $idTbForumTopicos
	));
}
//----------


//Definição das variáveis de detalhes.
//----------
//$resultadoForumTopicosDetalhes = $dbSistemaConPDO->query($strSqlForumTopicosDetalhesSelect);
$resultadoForumTopicosDetalhes = $statementForumTopicosDetalhesSelect->fetchAll();

if (empty($resultadoForumTopicosDetalhes))
{
	//echo "Nenhum registro encontrado";
}else{
	foreach($resultadoForumTopicosDetalhes as $linhaForumTopicosDetalhes)
	{
		//Definição das variáveis de detalhes.
		$tbForumTopicosId = $linhaForumTopicosDetalhes['id'];
		$tbForumTopicosIdTbCategorias = $linhaForumTopicosDetalhes['id_tb_categorias'];
		$tbForumTopicosIdTbCadastroVendedor = $linhaForumTopicosDetalhes['id_tb_cadastro_vendedor'];
		$tbForumTopicosIdTbCadastroUsuario = $linhaForumTopicosDetalhes['id_tb_cadastro_usuario'];
		$tbForumTopicosNClassificacao = $linhaForumTopicosDetalhes['n_classificacao'];
		
		//$tbForumTopicosDataProduto = Funcoes::DataLeitura01($linhaForumTopicosDetalhes['data_produto'], $GLOBALS['configSistemaFormatoData'], "1");
		//if($linhaForumTopicosDetalhes['data_topico'] == NULL)
		//{
			//$tbForumTopicosDataProduto = "";
		//}else{
			$tbForumTopicosDataTopico = Funcoes::DataLeitura01($linhaForumTopicosDetalhes['data_topico'], $GLOBALS['configSistemaFormatoData'], "1");
		//}

		$tbForumTopicosTopico = Funcoes::ConteudoMascaraLeitura($linhaForumTopicosDetalhes['topico']);
		$tbForumTopicosAssunto = Funcoes::ConteudoMascaraLeitura($linhaForumTopicosDetalhes['assunto']);

		$tbForumTopicosAtivacao = $linhaForumTopicosDetalhes['ativacao'];
		$tbForumTopicosAcessoRestrito = $linhaForumTopicosDetalhes['acesso_restrito'];


		//Verificação de erro.
		//echo "tbForumTopicosId=" . $tbForumTopicosId . "<br>";
		//echo "tbForumTopicosProcesso=" . $tbForumTopicosProcesso . "<br>";
	}
}
//----------


//Definição de variáveis.
$tituloLinkAtual = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteForumPostagensTituloEditar");
$metaTitulo = $tituloLinkAtual . " - " . Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloSite'], "IncludeConfig");


//Verificação de erro - debug.
//echo "dataTarefaPesquisa=" . $dataTarefaPesquisa . "<br />";
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
			$('#formForumTopicosEditar').validate({ //Inicialização do plug-in.
			
			
				//Estilo da mensagem de erro.
				//----------------------
				errorClass: "TextoErro",
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
    
    <form name="formForumTopicosEditar" id="formForumTopicosEditar" action="SiteAdmForumTopicosEditarExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <table class="AdmTabelaCampos01">
            <tr>
                <td class="AdmTbFundoEscuro" colspan="4">
                    <div align="center" class="AdmTexto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteForumTopicosTbTopicosEditar"); ?>
                        </strong>
                    </div>
                </td>
            </tr>

            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteForumTopico"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro"<?php if($GLOBALS['habilitarForumTopicosNClassificacao'] <> "1"){ ?> colspan="3"<?php } ?>>
                    <div align="left">
                        <input type="text" name="topico" id="topico" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbForumTopicosTopico;?>" />
                    </div>
                </td>
                <?php if($GLOBALS['habilitarForumTopicosNClassificacao'] == "1"){ ?>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNClassificacao"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaColuna01">
                    <div>
                        <input type="text" name="n_classificacao" id="n_classificacao" class="AdmCampoNumerico01" maxlength="10" value="<?php echo $tbForumTopicosNClassificacao;?>" />
                    </div>
                </td>
                <?php } ?>
            </tr>

            <?php if($GLOBALS['habilitarForumTopicosAssunto'] == "1"){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteForumTopicosAssunto"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div>
                        <?php //Sem formatação.?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                            <textarea name="assunto" id="assunto" class="AdmCampoTextoMultilinha01"><?php echo $tbForumTopicosAssunto;?></textarea>
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
                            <textarea name="assunto" id="assunto"><?php echo $tbForumTopicosAssunto;?></textarea>
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
                            <textarea name="assunto" id="assunto"><?php echo $tbForumTopicosAssunto;?></textarea>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao3"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <select name="ativacao" id="ativacao" class="AdmCampoDropDownMenu01">
                            <option value="0"<?php if($tbForumTopicosAtivacao == "0"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao4"); ?></option>
                            <option value="1"<?php if($tbForumTopicosAtivacao == "1"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao5"); ?></option>
                        </select>
                    </div>
                </td>
            </tr>

        </table>

        <div>
            <div style="float:left;">
                <input type="image" name="submit" value="Submit" src="img/btoAtualizar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoAtualizar"); ?>" />
                
                <input name="idTbForumTopicos" type="hidden" id="idTbForumTopicos" value="<?php echo $idTbForumTopicos; ?>" />
                <input name="id_tb_categorias" type="hidden" id="id_tb_categorias" value="<?php echo $tbForumTopicosIdTbCategorias; ?>" />
                <input name="acesso_restrito" type="hidden" id="acesso_restrito" value="<?php echo $tbForumTopicosAcessoRestrito; ?>" />
                
                <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                <input name="masterPageSiteSelect" type="hidden" id="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
            </div>
            <div style="float:right;">
                <a href="<?php echo $paginaRetorno; ?>?idParentForum=<?php echo $idParentForum; ?>">
                    <img src="img/btoVoltar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoVoltar"); ?>"  />
                </a>
            </div>
        </div>
    </form>
    <br />
<?php 
$pageSite->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php
//Limpeza de objetos.
//----------
unset($strSqlForumTopicosDetalhesSelect);
unset($statementForumTopicosDetalhesSelect);
unset($resultadoForumTopicosDetalhes);
unset($linhaForumTopicosDetalhes);
//----------


//Inclusão do template do layout.
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>