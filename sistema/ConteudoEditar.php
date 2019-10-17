<?php
//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeLayout.php";


//Verificação de login Master.
LoginAutenticacao::UsuarioLoginVerificacao();


//Resgate de variáveis.
$idTbConteudo = $_GET["idTbConteudo"];
$idParentCategorias = DbFuncoes::GetCampoGenerico01($idTbConteudo, "tb_conteudo", "id_tb_categorias");
$idParentCategoriasRaiz = $_GET["idParentCategoriasRaiz"];
if($idParentCategoriasRaiz == "")
{
	$idParentCategoriasRaiz = 0;
}

$paginaRetorno = "ConteudoIndice.php";
$paginaRetornoExclusao = "ConteudoEditar.php";
$variavelRetorno = "idTbConteudo";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];


//Montagem de query padrão de retorno.
$queryPadrao = "&idParentCategorias=" . $idParentCategorias . "&paginaRetorno=" . $paginaRetorno . "&masterPageSelect=" . $masterPageSelect . "&paginaRetornoExclusao=" . $paginaRetornoExclusao . "&variavelRetorno=" . $variavelRetorno;
//$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
//$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Query de pesquisa.
//----------
$strSqlConteudoDetalhesSelect = "";
$strSqlConteudoDetalhesSelect .= "SELECT ";
$strSqlConteudoDetalhesSelect .= "id, ";
$strSqlConteudoDetalhesSelect .= "n_classificacao, ";
$strSqlConteudoDetalhesSelect .= "id_tb_categorias, ";
$strSqlConteudoDetalhesSelect .= "id_tb_cadastro, ";
$strSqlConteudoDetalhesSelect .= "tipo_conteudo, ";
$strSqlConteudoDetalhesSelect .= "alinhamento_texto, ";
$strSqlConteudoDetalhesSelect .= "alinhamento_imagem, ";
$strSqlConteudoDetalhesSelect .= "conteudo, ";
$strSqlConteudoDetalhesSelect .= "conteudo_link, ";
$strSqlConteudoDetalhesSelect .= "arquivo, ";
$strSqlConteudoDetalhesSelect .= "config_arquivo, ";
$strSqlConteudoDetalhesSelect .= "dimensao_arquivo ";
$strSqlConteudoDetalhesSelect .= "FROM tb_conteudo ";
$strSqlConteudoDetalhesSelect .= "WHERE id <> 0 ";
//$strSqlConteudoDetalhesSelect .= "AND id_tb_categorias = :id_tb_categorias ";
$strSqlConteudoDetalhesSelect .= "AND id = :id ";
//$strSqlConteudoDetalhesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoConteudo'] . " ";

$statementConteudoDetalhesSelect = $dbSistemaConPDO->prepare($strSqlConteudoDetalhesSelect);

if ($statementConteudoDetalhesSelect !== false)
{
	$statementConteudoDetalhesSelect->execute(array(
		"id" => $idTbConteudo
	));
}

$resultadoConteudoDetalhes = $statementConteudoDetalhesSelect->fetchAll();

if (empty($resultadoConteudoDetalhes))
{
	//echo "Nenhum registro encontrado";
}else{
	foreach($resultadoConteudoDetalhes as $linhaConteudoDetalhes)
	{
		//Definição das variáveis de detalhes.
		$tbConteudoId = $linhaConteudoDetalhes['id'];
		$tbConteudoNClassificacao = $linhaConteudoDetalhes['n_classificacao'];
		$tbConteudoIdTbCategorias = $linhaConteudoDetalhes['id_tb_categorias'];
		$tbConteudoIdTbCadastro = $linhaConteudoDetalhes['id_tb_cadastro'];
		
		$tbConteudoTipoConteudo = $linhaConteudoDetalhes['tipo_conteudo'];
		$tbConteudoAlinhamentoTexto = $linhaConteudoDetalhes['alinhamento_texto'];
		$tbConteudoAlinhamentoImagem = $linhaConteudoDetalhes['alinhamento_imagem'];

		$tbConteudoConteudo = Funcoes::ConteudoMascaraLeitura($linhaConteudoDetalhes['conteudo']);
		
		$tbConteudoConteudoLink = $linhaConteudoDetalhes['conteudo_link'];
		$tbConteudoArquivo = $linhaConteudoDetalhes['arquivo'];
		$tbConteudoConfigArquivo = $linhaConteudoDetalhes['config_arquivo'];
		$tbConteudoDimensaoArquivo = $linhaConteudoDetalhes['dimensao_arquivo'];
		
		//Verificação de erro.
		//echo "id=" . $linhaConteudoDetalhes['id'] . "<br>";
		//echo "id_parent=" . $linhaConteudoDetalhes['id_parent'] . "<br>";
		//echo "categoria=" . Funcoes::ConteudoMascaraLeitura($linhaConteudoDetalhes['categoria']) . "<br>";
	}
}

//Verificação de erro.
//echo "id=" . $tbConteudoId . "<br>";
//echo "n_classificacao=" . $tbConteudoNClassificacao . "<br>";
//echo "id_tb_categorias=" . $tbConteudoIdTbCategorias . "<br>";
//echo "idTbConteudo=" . $idTbConteudo . "<br>";
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo $GLOBALS['configNomeCliente']; ?>
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
<?php ob_start(); /* cphConteudoCabecalho*/ ?>
    <div align="left" class="TextoTitulo01">
    	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoTituloEditar"); ?> -  
        <a href="CategoriasIndice.php?idParentCategorias=<?php echo $idParentCategoriasRaiz; ?>&idParentCategoriasRaiz=<?php echo $idParentCategoriasRaiz; ?>" class="Links04">
        	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemRoot"); ?>
        </a>
        <?php echo DbFuncoes::CategoriasCaminho($idParentCategorias, $idParentCategoriasRaiz, " - ", "Links04", "backend"); ?>
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
	
	<?php //Conteúdo texto. ?>
	<?php //**************************************************************************************?>
	<?php if($tbConteudoTipoConteudo == "1" || $tbConteudoTipoConteudo == "2" || $tbConteudoTipoConteudo == "3" || $tbConteudoTipoConteudo == "4" || $tbConteudoTipoConteudo == "7"){?>
		<script type="text/javascript">
			$(document).ready(function () {
			
				//Validação de formulário (JQuery).
				//**************************************************************************************
				$('#formConteudo').validate({ //Inicialização do plug-in.
				
				
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
						}//,
						//field2: {
							//required: true,
							//minlength: 5
						//}
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
		<form name="formConteudo" id="formConteudo" action="ConteudoEditarExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
		<?php //echo "habilitarCategoriasNClassificacao=" . $GLOBALS['habilitarCategoriasNClassificacao'] . "<br />"; ?>
			<table class="TabelaCampos01">
				<tr class="TbFundoEscuro">
					<td class="TabelaCampos01Celula" colspan="4">
						<div align="center" class="Texto02">
							<strong>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoTbConteudoEditar"); ?>
							</strong>
						</div>
					</td>
				</tr>
				<tr>
					<td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
						<div align="left" class="Texto01">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoFormatacao"); ?>:
						</div>
					</td>
					<td class="TbFundoClaro TabelaCampos01Celula">
						<div align="left" class="Texto01">
							<div style="display: inline;">
								<input name="tipo_conteudo" type="radio" value="1" class="CampoCheckBox01" <?php if($tbConteudoTipoConteudo == "1"){?>checked="true" <?php }?>/> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoFormatacao1"); ?>
							</div>
							<div style="display: inline;">
								<input name="tipo_conteudo" type="radio" value="2" class="CampoCheckBox01" <?php if($tbConteudoTipoConteudo == "2"){?>checked="true" <?php }?>/> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoFormatacao2"); ?>
							</div>
							<div style="display: inline;">
								<input name="tipo_conteudo" type="radio" value="3" class="CampoCheckBox01" <?php if($tbConteudoTipoConteudo == "3"){?>checked="true" <?php }?>/> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoFormatacao3"); ?>
							</div>
							<div style="display: inline;">
								<input name="tipo_conteudo" type="radio" value="4" class="CampoCheckBox01" <?php if($tbConteudoTipoConteudo == "4"){?>checked="true" <?php }?>/> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoFormatacao4"); ?>
							</div>
							<div style="display: inline;">
								<input name="tipo_conteudo" type="radio" value="7" class="CampoCheckBox01" <?php if($tbConteudoTipoConteudo == "7"){?>checked="true" <?php }?>/> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoFormatacao7"); ?>
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
						<div align="left" class="Texto01">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoAlinhamento"); ?>:
						</div>
					</td>
					<td class="TbFundoClaro TabelaCampos01Celula">
						<div align="left" class="Texto01">
							<div style="display: inline;">
								<input name="alinhamento_texto" type="radio" value="3" class="CampoCheckBox01" <?php if($tbConteudoAlinhamentoTexto == "3"){?>checked="true" <?php }?>/> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoAlinhamento3"); ?>
							</div>
							<div style="display: inline;">
								<input name="alinhamento_texto" type="radio" value="2" class="CampoCheckBox01" <?php if($tbConteudoAlinhamentoTexto == "2"){?>checked="true" <?php }?>/> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoAlinhamento2"); ?>
							</div>
							<div style="display: inline;">
								<input name="alinhamento_texto" type="radio" value="1" class="CampoCheckBox01" <?php if($tbConteudoAlinhamentoTexto == "1"){?>checked="true" <?php }?>/> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoAlinhamento1"); ?>
							</div>
							<div style="display: inline;">
								<input name="alinhamento_texto" type="radio" value="4" class="CampoCheckBox01" <?php if($tbConteudoAlinhamentoTexto == "4"){?>checked="true" <?php }?>/> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoAlinhamento4"); ?>
							</div>
						</div>
					</td>
				</tr>
				<?php if($GLOBALS['habilitarConteudoNClassificacao'] == 1){ ?>
				<tr>
					<td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
						<div align="left" class="Texto01">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNClassificacao"); ?>:
						</div>
					</td>
					<td class="TbFundoClaro TabelaCampos01Celula">
						<div>
							<input type="text" name="n_classificacao" id="n_classificacao" class="CampoNumerico01" maxlength="10" value="<?php echo $tbConteudoNClassificacao; ?>" />
						</div>
					</td>
				</tr>
				<?php } ?>
				<tr>
					<td class="TbFundoMedio TabelaColuna01">
						<div align="left" class="Texto01">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoConteudo"); ?>:
						</div>
					</td>
					<td class="TbFundoClaro">
						<div>
							<?php //Sem formatação.?>
							<?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
								<textarea name="conteudo" id="conteudo" class="CampoTextoMultilinhaConteudo"><?php echo $tbConteudoConteudo; ?></textarea>
							<?php } ?>
							
							<?php //Formatação básica (CLEditor).?>
							<?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
								
								<script type="text/javascript">
									//Caixa básica.
									$(document).ready(function () {
										$("#conteudo").cleditor(
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
								<textarea name="conteudo" id="conteudo"><?php echo $tbConteudoConteudo; ?></textarea>
							<?php } ?>
							
							<?php //Formatação avançada (CLEditor).?>
							<?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
								<script type="text/javascript">
									$(document).ready(function () {
										$("#conteudo").cleditor(
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
								<textarea name="conteudo" id="conteudo"><?php echo $tbConteudoConteudo; ?></textarea>
							<?php } ?>
						</div>
					</td>
				</tr>
			</table>
			<div>
				<div style="float:left;">
					<input type="image" name="submit" value="Submit" src="img/btoAtualizar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoAtualizar"); ?>" />
					
					<input name="idTbConteudo" type="hidden" id="idTbConteudo" value="<?php echo $tbConteudoId; ?>" />
					<input name="config_arquivo" type="hidden" id="config_arquivo" value="<?php echo $tbConteudoConfigArquivo; ?>" />
					<input name="id_tb_categorias" type="hidden" id="id_tb_categorias" value="<?php echo $tbConteudoIdTbCategorias; ?>" />
					<input name="id_tb_cadastro" type="hidden" id="id_tb_cadastro" value="<?php echo $tbConteudoIdTbCadastro; ?>" />
					<input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                    <input name="masterPageSelect" type="hidden" id="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
				</div>
				<div style="float:right;">
					<a href="<?php echo $paginaRetorno; ?>?idParentConteudo=<?php echo $idParentCategorias; ?>">
						<img src="img/btoVoltar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoVoltar"); ?>"  />
					</a>
				</div>
			</div>
		</form>
	<?php } ?>
	<?php //**************************************************************************************?>


	<?php //Conteúdo imagem. ?>
	<?php //**************************************************************************************?>
	<?php if($tbConteudoTipoConteudo == "5" || $tbConteudoTipoConteudo == "9"){?>
		<script type="text/javascript">
			$(document).ready(function () {
			
				//Validação de formulário (JQuery).
				//**************************************************************************************
				$('#formConteudoImagem').validate({ //Inicialização do plug-in.
				
				
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
						}//,
					},
					
					
					//Mensagens.
					//----------------------
					messages: {
						//n_classificacao: "Please specify your name"//,
						n_classificacao: {
						  required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica2"); ?>",
						  number: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica1"); ?>"
						}
					},		
					//----------------------
					
				});
				//**************************************************************************************
	
			});	
		</script>
		<form name="formConteudoImagem" id="formConteudoImagem" action="ConteudoEditarExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
			<table class="TabelaCampos01">
				<tr>
					<td class="TbFundoEscuro" colspan="2">
						<div align="center" class="Texto02">
							<strong>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoTbImagemEditar"); ?>
							</strong>
						</div>
					</td>
				</tr>
				<tr>
					<td class="TbFundoMedio TabelaColuna01">
						<div align="left" class="Texto01">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoAlinhamentoImagem"); ?>:
						</div>
					</td>
					<td class="TbFundoClaro">
						<div align="left" class="Texto01">
							<div style="display: inline;">
								<input name="alinhamento_imagem" type="radio" value="3" class="CampoCheckBox01" <?php if($tbConteudoAlinhamentoImagem == "3"){?>checked="true" <?php }?>/> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoAlinhamentoImagem3"); ?>
							</div>
							<div style="display: inline;">
								<input name="alinhamento_imagem" type="radio" value="2" class="CampoCheckBox01" <?php if($tbConteudoAlinhamentoImagem == "2"){?>checked="true" <?php }?>/> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoAlinhamentoImagem2"); ?>
							</div>
							<div style="display: inline;">
								<input name="alinhamento_imagem" type="radio" value="1" class="CampoCheckBox01" <?php if($tbConteudoAlinhamentoImagem == "1"){?>checked="true" <?php }?>/> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoAlinhamentoImagem1"); ?>
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td class="TbFundoMedio TabelaColuna01">
						<div align="left" class="Texto01">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoAlinhamento"); ?>:
						</div>
					</td>
					<td class="TbFundoClaro">
						<div align="left" class="Texto01">
							<div style="display: inline;">
								<input name="alinhamento_texto" type="radio" value="3" class="CampoCheckBox01" <?php if($tbConteudoAlinhamentoTexto == "3"){?>checked="true" <?php }?>/> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoAlinhamento3"); ?>
							</div>
							<div style="display: inline;">
								<input name="alinhamento_texto" type="radio" value="2" class="CampoCheckBox01" <?php if($tbConteudoAlinhamentoTexto == "2"){?>checked="true" <?php }?>/> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoAlinhamento2"); ?>
							</div>
							<div style="display: inline;">
								<input name="alinhamento_texto" type="radio" value="1" class="CampoCheckBox01" <?php if($tbConteudoAlinhamentoTexto == "1"){?>checked="true" <?php }?>/> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoAlinhamento1"); ?>
							</div>
							<div style="display: inline;">
								<input name="alinhamento_texto" type="radio" value="4" class="CampoCheckBox01" <?php if($tbConteudoAlinhamentoTexto == "4"){?>checked="true" <?php }?>/> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoAlinhamento4"); ?>
							</div>
						</div>
					</td>
				</tr>
	
				<?php if($GLOBALS['habilitarConteudoNClassificacao'] == 1){ ?>
				<tr>
					<td class="TbFundoMedio TabelaColuna01">
						<div align="left" class="Texto01">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNClassificacao"); ?>:
						</div>
					</td>
					<td class="TbFundoClaro">
						<div>
							<input type="text" name="n_classificacao" id="n_classificacao" class="CampoNumerico01" maxlength="10" value="<?php echo $tbConteudoNClassificacao; ?>" />
						</div>
					</td>
				</tr>
				<?php } ?>
				
				<?php if($GLOBALS['habilitarConteudoImagemSemRedimensionamento'] == 1){ ?>
				<tr>
					<td class="TbFundoMedio TabelaColuna01">
						<div align="left" class="Texto01">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoDimensaoImagem"); ?>:
						</div>
					</td>
					<td class="TbFundoClaro">
						<div align="left" class="Texto01">
							<div style="display: inline;">
								<input name="tipo_conteudo" type="radio" value="9" class="CampoCheckBox01" <?php if($tbConteudoTipoConteudo == "9"){?>checked="true" <?php }?>/> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoDimensaoImagemSim"); ?>
							</div>
							<div style="display: inline;">
								<input name="tipo_conteudo" type="radio" value="5" class="CampoCheckBox01" <?php if($tbConteudoTipoConteudo == "5"){?>checked="true" <?php }?>/> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoDimensaoImagemNao"); ?>
							</div>
						</div>
					</td>
				</tr>
				<?php } ?>
	
				<tr>
					<td class="TbFundoMedio TabelaColuna01">
						<div align="left" class="Texto01">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoLegenda"); ?>:
						</div>
					</td>
					<td class="TbFundoClaro">
						<div>
							<?php //Sem formatação.?>
							<?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
								<textarea name="conteudo" id="conteudo" class="CampoTextoMultilinhaConteudo"><?php echo $tbConteudoConteudo; ?></textarea>
							<?php } ?>
							
							<?php //Formatação básica (CLEditor).?>
							<?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
								
								<script type="text/javascript">
									//Caixa básica.
									$(document).ready(function () {
										$("#conteudo_imagem").cleditor(
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
								<textarea name="conteudo_imagem" id="conteudo_imagem"><?php echo $tbConteudoConteudo; ?></textarea>
							<?php } ?>
							
							<?php //Formatação avançada (CLEditor).?>
							<?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
								<script type="text/javascript">
									$(document).ready(function () {
										$("#conteudo_imagem").cleditor(
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
								<textarea name="conteudo_imagem" id="conteudo_imagem"><?php echo $tbConteudoConteudo; ?></textarea>
							<?php } ?>
						</div>
					</td>
				</tr>
	
				<tr>
					<td class="TbFundoMedio TabelaColuna01">
						<div align="left" class="Texto01">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemURL01"); ?>:
						</div>
					</td>
					<td class="TbFundoClaro">
						<div align="left" class="Texto01">
							<textarea name="conteudo_link" id="conteudo_link" class="CampoTextoMultilinhaURL"><?php echo $tbConteudoConteudoLink; ?></textarea>
							<br />
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemURL02"); ?>
						</div>
					</td>
				</tr>
	
				<tr ID="cell_imagem">
					<td class="TbFundoMedio TabelaColuna01">
						<div align="left" class="Texto01">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemImagem"); ?>:
						</div>
					</td>
					<td class="TbFundoClaro">
                <div>
                    <table cellpadding="0" cellspacing="0" style="width: 100%;">
                        <tr>
                            <td width="1">
                                <input type="file" name="ArquivoUpload1" id="ArquivoUpload1" class="CampoArquivoUpload01" />
                            </td>
                            
                            <?php if(!empty($tbConteudoArquivo)){ //if($tbCategoriasImagem <> ""){?>
                            <td width="1">
                                <img src="<?php echo $GLOBALS['configDiretorioArquivos'];?>/t<?php echo $tbConteudoArquivo; ?>?variavelCache=<?php echo date("s"); ?>" alt="<?php echo $tbConteudoArquivo; ?>" style="margin-left: 4px;" />
                            </td>
                            <td>
                                <a href="RegistrosArquivosExcluirExe.php?idRegistro=<?php echo $tbConteudoId;?>&strTabela=tb_conteudo&strCampo=arquivo<?php echo $queryPadrao;?>" class="LinksExcluir01" style="margin-left: 4px;">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemImagemExcluir"); ?>
                                </a>
                            </td>
                            <?php } ?>
                            
                        </tr>
                    </table>
                </div>
					</td>
				</tr>
			</table>
			<div>
				<div style="float:left;">
					<input type="image" name="submit" value="Submit" src="img/btoAtualizar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoAtualizar"); ?>" />
					
					<input name="idTbConteudo" type="hidden" id="idTbConteudo" value="<?php echo $tbConteudoId; ?>" />
					<?php if($GLOBALS['habilitarConteudoImagemSemRedimensionamento'] == 0){ ?>
						<input name="tipo_conteudo" type="hidden" id="tipo_conteudo" value="<?php echo $tbConteudoTipoConteudo; ?>" />
					<?php } ?>
					<input name="config_arquivo" type="hidden" id="config_arquivo" value="<?php echo $tbConteudoConfigArquivo; ?>" />
					<input name="id_tb_categorias" type="hidden" id="id_tb_categorias" value="<?php echo $tbConteudoIdTbCategorias; ?>" />
					<input name="id_tb_cadastro" type="hidden" id="id_tb_cadastro" value="<?php echo $tbConteudoIdTbCadastro; ?>" />
					<input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                    <input name="masterPageSelect" type="hidden" id="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
				</div>
				<div style="float:right;">
					<a href="<?php echo $paginaRetorno; ?>?idParentConteudo=<?php echo $idParentCategorias; ?>">
						<img src="img/btoVoltar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoVoltar"); ?>"  />
					</a>
				</div>
			</div>
		</form>
	<?php } ?>
	<?php //**************************************************************************************?>


	<?php //Conteúdo vídeo. ?>
	<?php //**************************************************************************************?>
	<?php if($tbConteudoTipoConteudo == "6"){?>
        <script type="text/javascript">
            $(document).ready(function () {
            
                //Validação de formulário (JQuery).
                //**************************************************************************************
                $('#formConteudoVideos').validate({ //Inicialização do plug-in.
                
                
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
                        }//,
                    },
                    
                    
                    //Mensagens.
                    //----------------------
                    messages: {
                        //n_classificacao: "Please specify your name"//,
                        n_classificacao: {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica2"); ?>",
                          number: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica1"); ?>"
                        }
                    },		
                    //----------------------
                    
                });
                //**************************************************************************************
    
            });	
        </script>
        <form name="formConteudoVideos" id="formConteudoVideos" action="ConteudoEditarExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoTbVideoEditar"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoAlinhamento"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div align="left" class="Texto01">
							<div style="display: inline;">
								<input name="alinhamento_texto" type="radio" value="3" class="CampoCheckBox01" <?php if($tbConteudoAlinhamentoTexto == "3"){?>checked="true" <?php }?>/> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoAlinhamento3"); ?>
							</div>
							<div style="display: inline;">
								<input name="alinhamento_texto" type="radio" value="2" class="CampoCheckBox01" <?php if($tbConteudoAlinhamentoTexto == "2"){?>checked="true" <?php }?>/> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoAlinhamento2"); ?>
							</div>
							<div style="display: inline;">
								<input name="alinhamento_texto" type="radio" value="1" class="CampoCheckBox01" <?php if($tbConteudoAlinhamentoTexto == "1"){?>checked="true" <?php }?>/> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoAlinhamento1"); ?>
							</div>
                        </div>
                    </td>
                </tr>
				
				<?php if($GLOBALS['habilitarConteudoNClassificacao'] == 1){ ?>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNClassificacao"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div>
							<input type="text" name="n_classificacao" id="n_classificacao" class="CampoNumerico01" maxlength="10" value="<?php echo $tbConteudoNClassificacao; ?>" />
                        </div>
                    </td>
                </tr>
                <?php } ?>
				
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoVideo"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div>
                            <input type="file" name="ArquivoUpload1" id="ArquivoUpload1" class="CampoArquivoUpload01" />
                        </div>
                    </td>
                </tr>

            </table>
            <div>
                <div style="float:left;">
                    <input type="image" name="submit" value="Submit" src="img/btoAtualizar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoAtualizar"); ?>" />
					<input name="idTbConteudo" type="hidden" id="idTbConteudo" value="<?php echo $tbConteudoId; ?>" />

                    <input name="tipo_conteudo" type="hidden" id="tipo_conteudo" value="<?php echo $tbConteudoTipoConteudo ?>" />
                    <input name="config_arquivo" type="hidden" id="config_arquivo" value="<?php echo $tbConteudoConfigArquivo ?>" />

                    <input name="id_tb_categorias" type="hidden" id="id_tb_categorias" value="<?php echo $tbConteudoIdTbCategorias; ?>" />
                    <input name="id_tb_cadastro" type="hidden" id="id_tb_cadastro" value="<?php echo $tbConteudoIdTbCadastro; ?>" />
                    <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                    <input name="masterPageSelect" type="hidden" id="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
                </div>
                <div style="float:right;">
                    &nbsp;
                </div>
            </div>
        </form>
	<?php } ?>
	<?php //**************************************************************************************?>
	
	
	<?php //Conteúdo arquivos. ?>
	<?php //**************************************************************************************?>
	<?php if($tbConteudoTipoConteudo == "8"){?>
        <script type="text/javascript">
            $(document).ready(function () {
            
                //Validação de formulário (JQuery).
                //**************************************************************************************
                $('#formConteudoArquivos').validate({ //Inicialização do plug-in.
                
                
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
                        }//,
                    },
                    
                    
                    //Mensagens.
                    //----------------------
                    messages: {
                        //n_classificacao: "Please specify your name"//,
                        n_classificacao: {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica2"); ?>",
                          number: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica1"); ?>"
                        }
                    },		
                    //----------------------
                    
                });
                //**************************************************************************************
    
            });	
        </script>
        <form name="formConteudoArquivos" id="formConteudoArquivos" action="ConteudoEditarExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoTbArquivosEditar"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemVisualizacao"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div align="left" class="Texto01">
                            <div style="display: inline;">
                                <input name="config_arquivo" type="radio" value="3" class="CampoCheckBox01" <?php if($tbConteudoConfigArquivo == "3"){?>checked="true" <?php }?>/> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemVisualizacao3"); ?>
                            </div>
                            <div style="display: inline;">
                                <input name="config_arquivo" type="radio" value="4" class="CampoCheckBox01" <?php if($tbConteudoConfigArquivo == "4"){?>checked="true" <?php }?>/> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemVisualizacao4"); ?>
                            </div>
                        </div>                    
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoAlinhamento"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div align="left" class="Texto01">
							<div style="display: inline;">
								<input name="alinhamento_texto" type="radio" value="3" class="CampoCheckBox01" <?php if($tbConteudoAlinhamentoTexto == "3"){?>checked="true" <?php }?>/> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoAlinhamento3"); ?>
							</div>
							<div style="display: inline;">
								<input name="alinhamento_texto" type="radio" value="2" class="CampoCheckBox01" <?php if($tbConteudoAlinhamentoTexto == "2"){?>checked="true" <?php }?>/> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoAlinhamento2"); ?>
							</div>
							<div style="display: inline;">
								<input name="alinhamento_texto" type="radio" value="1" class="CampoCheckBox01" <?php if($tbConteudoAlinhamentoTexto == "1"){?>checked="true" <?php }?>/> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoAlinhamento1"); ?>
							</div>
							<div style="display: inline;">
								<input name="alinhamento_texto" type="radio" value="4" class="CampoCheckBox01" <?php if($tbConteudoAlinhamentoTexto == "4"){?>checked="true" <?php }?>/> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoAlinhamento4"); ?>
							</div>
                        </div>
                    </td>
                </tr>

				<?php if($GLOBALS['habilitarConteudoNClassificacao'] == 1){ ?>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNClassificacao"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div>
							<input type="text" name="n_classificacao" id="n_classificacao" class="CampoNumerico01" maxlength="10" value="<?php echo $tbConteudoNClassificacao; ?>" />
                        </div>
                    </td>
                </tr>
                <?php } ?>

                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemTextoLink"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div align="left">
                        	<textarea name="conteudo" id="conteudo" class="CampoTextoMultilinhaURL"><?php echo $tbConteudoConteudo; ?></textarea>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemArquivo"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div>
                            <input type="file" name="ArquivoUpload1" id="ArquivoUpload1" class="CampoArquivoUpload01">
                        </div>
                    </td>
                </tr>
            </table>
            <div>
                <div style="float:left;">
                    <input type="image" name="submit" value="Submit" src="img/btoAtualizar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoAtualizar"); ?>" />
					<input name="idTbConteudo" type="hidden" id="idTbConteudo" value="<?php echo $tbConteudoId; ?>" />

                    <input name="tipo_conteudo" type="hidden" id="tipo_conteudo" value="<?php echo $tbConteudoTipoConteudo; ?>" />

					<input name="id_tb_categorias" type="hidden" id="id_tb_categorias" value="<?php echo $tbConteudoIdTbCategorias; ?>" />
					<input name="id_tb_cadastro" type="hidden" id="id_tb_cadastro" value="<?php echo $tbConteudoIdTbCadastro; ?>" />
					<input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                    <input name="masterPageSelect" type="hidden" id="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
                </div>
                <div style="float:right;">
                    &nbsp;
                </div>
            </div>
        </form>
	<?php } ?>
	<?php //**************************************************************************************?>


	<?php //Conteúdo colunas. ?>
	<?php //**************************************************************************************
	//Obs: Modificar esta lógica no futuro para entrar no modo de exclusão e inclusão de colunas individualmente.
	?>
	<?php if($tbConteudoTipoConteudo == "10"){?>
        <script type="text/javascript">
            $(document).ready(function () {
            
                //Validação de formulário (JQuery).
                //**************************************************************************************
                $('#formConteudoColunas').validate({ //Inicialização do plug-in.
                
                
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
                        },
                        conteudo: {
                            required: true,
                            number: true
                        }
                    },
                    
                    
                    //Mensagens.
                    //----------------------
                    messages: {
                        //n_classificacao: "Please specify your name"//,
                        n_classificacao: {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica2"); ?>",
                          number: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica1"); ?>"
                        },
                        conteudo: {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica2"); ?>",
                          number: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica1"); ?>"
                        }
                    },		
                    //----------------------
                    
                });
                //**************************************************************************************
    
            });	
        </script>
        <form name="formConteudoColunas" id="formConteudoColunas" action="ConteudoEditarExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoTbColunasEditar"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoNColunas"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div>
                            <input type="text" name="conteudo" id="conteudo" class="CampoNumerico01" maxlength="3" value="<?php echo $tbConteudoConteudo; ?>" />
                        </div>
                    </td>
                </tr>
                
				<?php if($GLOBALS['habilitarConteudoNClassificacao'] == 1){ ?>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNClassificacao"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div>
							<input type="text" name="n_classificacao" id="n_classificacao" class="CampoNumerico01" maxlength="10" value="<?php echo $tbConteudoNClassificacao; ?>" />
                        </div>
                    </td>
                </tr>
                <?php } ?>
            </table>
            <div>
                <div style="float:left;">
                    <input type="image" name="submit" value="Submit" src="img/btoAtualizar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoAtualizar"); ?>" />
					<input name="idTbConteudo" type="hidden" id="idTbConteudo" value="<?php echo $tbConteudoId; ?>" />

                    <input name="tipo_conteudo" type="hidden" id="tipo_conteudo" value="<?php echo $tbConteudoTipoConteudo; ?>" />
					<input name="config_arquivo" type="hidden" id="config_arquivo" value="<?php echo $tbConteudoConfigArquivo; ?>" />
                    <input name="alinhamento_texto" type="hidden" id="alinhamento_texto" value="<?php echo $tbConteudoAlinhamentoTexto; ?>" />
                    
					<input name="id_tb_categorias" type="hidden" id="id_tb_categorias" value="<?php echo $tbConteudoIdTbCategorias; ?>" />
					<input name="id_tb_cadastro" type="hidden" id="id_tb_cadastro" value="<?php echo $tbConteudoIdTbCadastro; ?>" />
					<input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                    <input name="masterPageSelect" type="hidden" id="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
                </div>
                <div style="float:right;">
                    &nbsp;
                </div>
            </div>
        </form>
	<?php } ?>
	<?php //**************************************************************************************?>
	
	
	<?php //Conteúdo SWF. ?>
	<?php //**************************************************************************************?>
	<?php if($tbConteudoTipoConteudo == "11"){?>
		<script type="text/javascript">
            $(document).ready(function () {
            
                //Validação de formulário (JQuery).
                //**************************************************************************************
                $('#formConteudoSWF').validate({ //Inicialização do plug-in.
                
                
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
                        },
                        dimensao_w: {
                            required: true,
                            number: true
                        },
                        dimensao_h: {
                            required: true,
                            number: true
                        }
                    },
                    
                    
                    //Mensagens.
                    //----------------------
                    messages: {
                        //n_classificacao: "Please specify your name"//,
                        n_classificacao: {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica2"); ?>",
                          number: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica1"); ?>"
                        },
                        dimensao_w: {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica2"); ?>",
                          number: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica1"); ?>"
                        },
                        dimensao_h: {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica2"); ?>",
                          number: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica1"); ?>"
                        }
                    },		
                    //----------------------
                    
                });
                //**************************************************************************************
    
            });	
        </script>
        <form name="formConteudoSWF" id="formConteudoSWF" action="ConteudoEditarExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoTbSWFEditar"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                
				<?php if($GLOBALS['habilitarConteudoNClassificacao'] == 1){ ?>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNClassificacao"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div>
							<input type="text" name="n_classificacao" id="n_classificacao" class="CampoNumerico01" maxlength="10" value="<?php echo $tbConteudoNClassificacao; ?>" />
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemDimensoes"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div class="Texto01">
							<?php
							$arrDimensaoArquivo = explode(",", $tbConteudoDimensaoArquivo);
							$swfW = $arrDimensaoArquivo[0];
							$swfH = $arrDimensaoArquivo[1];
							?>		
							<input name="dimensao_w" type="text" id="dimensao_w" class="CampoNumerico01" size="5" maxlength="5" value="<?php echo $swfW; ?>"> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemLarguraPixels"); ?>
							<input name="dimensao_h" type="text"  id="dimensao_w" class="CampoNumerico01"size="5" maxlength="5" value="<?php echo $swfH; ?>"> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAlturaPixels"); ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoSWF"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div>
                            <input type="file" name="ArquivoUpload1" id="ArquivoUpload1" class="CampoArquivoUpload01" />
                        </div>
                    </td>
                </tr>
            </table>
            <div>
                <div style="float:left;">
                    <input type="image" name="submit" value="Submit" src="img/btoAtualizar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoAtualizar"); ?>" />
					<input name="idTbConteudo" type="hidden" id="idTbConteudo" value="<?php echo $tbConteudoId; ?>" />

                    <input name="tipo_conteudo" type="hidden" id="tipo_conteudo" value="<?php echo $tbConteudoTipoConteudo; ?>" />
                    <input name="alinhamento_texto" type="hidden" id="alinhamento_texto" value="<?php echo $tbConteudoAlinhamentoTexto; ?>" />
                    <input name="config_arquivo" type="hidden" id="config_arquivo" value="<?php echo $tbConteudoConfigArquivo; ?>" />

					<input name="id_tb_categorias" type="hidden" id="id_tb_categorias" value="<?php echo $tbConteudoIdTbCategorias; ?>" />
					<input name="id_tb_cadastro" type="hidden" id="id_tb_cadastro" value="<?php echo $tbConteudoIdTbCadastro; ?>" />
					<input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                    <input name="masterPageSelect" type="hidden" id="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
                </div>
                <div style="float:right;">
                    &nbsp;
                </div>
            </div>
        </form>
	<?php } ?>
	<?php //**************************************************************************************?>
<?php 
$page->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php
//Limpeza de objetos.
unset($strSqlConteudoDetalhesSelect);
unset($statementConteudoDetalhesSelect);
unset($resultadoConteudoDetalhes);
unset($linhaConteudoDetalhes);
//----------
?>


<?php 
//Inclusão do template do layout.
include_once $page->LayoutSistema;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>
