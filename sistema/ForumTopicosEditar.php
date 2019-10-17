<?php
//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeLayout.php";


//Verificação de login Master.
LoginAutenticacao::UsuarioLoginVerificacao();


//Resgate de variáveis.
$idTbForumTopicos = $_GET["idTbForumTopicos"];
$idParent = DbFuncoes::GetCampoGenerico01($idTbForumTopicos, "tb_forum_topicos", "id_tb_categorias");
$idParentCategoriasRaiz = $_GET["idParentCategoriasRaiz"];
if($idParentCategoriasRaiz == "")
{
	$idParentCategoriasRaiz = 0;
}

$paginaRetorno = "ForumTopicosIndice.php";
$paginaRetornoExclusao = "ForumTopicosEditar.php";
$variavelRetorno = "idTbForumTopicos";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];


//Montagem de query padrão de retorno.
$queryPadrao = "&idParent=" . $idParent . 
"&idTbCadastroUsuario=" . $idTbCadastroUsuario . 
"&paginaRetorno=" . $paginaRetorno . 
"&masterPageSelect=" . $masterPageSelect . 
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
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistema"); ?> - <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configNomeCliente'], "IncludeConfig"); ?>
<?php 
$page->cphTitle = ob_get_clean(); 
?>
<?php //**************************************************************************************?>


<?php //Head.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphHead*/ ?>
	
<?php 
$page->cphHead = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Cabeçalho.?>
<?php //**************************************************************************************?>
<?php ob_start(); /*cphConteudoCabecalho*/ ?>
    <div align="left" class="TextoTitulo01">
    	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaForumTopicosTituloEditar"); ?> - <?php echo $tbForumTopicosTopico; ?> - 
        <a href="CategoriasIndice.php?idParentCategorias=<?php echo $idParentCategoriasRaiz; ?>&idParentCategoriasRaiz=<?php echo $idParentCategoriasRaiz; ?>" class="Links04">
        	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemRoot"); ?>
        </a>
        <?php echo DbFuncoes::CategoriasCaminho($idParent, $idParentCategoriasRaiz, " - ", "Links04", "backend"); ?>
    </div>
<?php 
$page->cphConteudoCabecalho = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Conteúdo principal.?>
<?php //**************************************************************************************?>
<?php ob_start(); /*cphConteudoPrincipal*/ ?>
    <div align="center" class="TextoErro">
        <?php echo $mensagemErro;?>
    </div>
    <div align="center" class="TextoSucesso">
        <?php echo $mensagemSucesso;?>
    </div>


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
					  required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica2"); ?>",
					  //regex: "Campo numérico."
					  //number: "Campo numérico."
					  number: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica1"); ?>"
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
    
    <form name="formForumTopicosEditar" id="formForumTopicosEditar" action="ForumTopicosEditarExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <table class="TabelaCampos01">
            <tr>
                <td class="TbFundoEscuro" colspan="4">
                    <div align="center" class="Texto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaForumTopicosTbTopicosEditar"); ?>
                        </strong>
                    </div>
                </td>
            </tr>

            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaForumTopico"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro"<?php if($GLOBALS['habilitarForumTopicosNClassificacao'] <> "1"){ ?> colspan="3"<?php } ?>>
                    <div align="left">
                        <input type="text" name="topico" id="topico" class="CampoTexto01" maxlength="255" value="<?php echo $tbForumTopicosTopico;?>" />
                    </div>
                </td>
                <?php if($GLOBALS['habilitarForumTopicosNClassificacao'] == "1"){ ?>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNClassificacao"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaColuna01">
                    <div>
                        <input type="text" name="n_classificacao" id="n_classificacao" class="CampoNumerico01" maxlength="10" value="<?php echo $tbForumTopicosNClassificacao;?>" />
                    </div>
                </td>
                <?php } ?>
            </tr>

            <?php if($GLOBALS['habilitarForumTopicosAssunto'] == "1"){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaForumTopicosAssunto"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div>
                        <?php //Sem formatação.?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                            <textarea name="assunto" id="assunto" class="CampoTextoMultilinha01"><?php echo $tbForumTopicosAssunto;?></textarea>
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
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao3"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left" class="Texto01">
                        <select name="ativacao" id="ativacao" class="CampoDropDownMenu01">
                            <option value="0"<?php if($tbForumTopicosAtivacao == "0"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao4"); ?></option>
                            <option value="1"<?php if($tbForumTopicosAtivacao == "1"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao5"); ?></option>
                        </select>
                    </div>
                </td>
            </tr>

        </table>

        <div>
            <div style="float:left;">
                <input type="image" name="submit" value="Submit" src="img/btoAtualizar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoAtualizar"); ?>" />
                
                <input name="idTbForumTopicos" type="hidden" id="idTbForumTopicos" value="<?php echo $idTbForumTopicos; ?>" />
                <input name="id_tb_categorias" type="hidden" id="id_tb_categorias" value="<?php echo $tbForumTopicosIdTbCategorias; ?>" />
                <input name="acesso_restrito" type="hidden" id="acesso_restrito" value="<?php echo $tbForumTopicosAcessoRestrito; ?>" />
                
                <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                <input name="masterPageSelect" type="hidden" id="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
            </div>
            <div style="float:right;">
                <a href="<?php echo $paginaRetorno; ?>?idParent=<?php echo $idParent; ?>">
                    <img src="img/btoVoltar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoVoltar"); ?>"  />
                </a>
            </div>
        </div>
    </form>
    <br />
<?php 
$page->cphConteudoPrincipal = ob_get_clean(); 
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
include_once $page->LayoutSistema;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>