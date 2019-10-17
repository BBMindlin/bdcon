<?php
//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeLayout.php";


//Verificação de login Master.
LoginAutenticacao::UsuarioLoginVerificacao();


//Resgate de variáveis.
$idTbFormulariosCamposOpcoes = $_GET["idTbFormulariosCamposOpcoes"];
$idTbFormulariosCampos = DbFuncoes::GetCampoGenerico01($idTbFormulariosCamposOpcoes, "tb_formularios_campos_opcoes", "id_tb_formularios_campos");

$paginaRetorno = "FormulariosCamposOpcoesIndice.php";
$paginaRetornoExclusao = "FormulariosCamposOpcoesEditar.php";
$variavelRetorno = "idTbFormulariosCamposOpcoes";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];


//Montagem de query padrão de retorno.
$queryPadrao = "&paginaRetorno=" . $paginaRetorno . 
"&masterPageSelect=" . $masterPageSelect . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&variavelRetorno=" . $variavelRetorno;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Query de pesquisa.
//----------
$strSqlFormulariosCamposOpcoesDetalhesSelect = "";
$strSqlFormulariosCamposOpcoesDetalhesSelect .= "SELECT ";
//$strSqlFormulariosCamposOpcoesDetalhesSelect .= "* ";
$strSqlFormulariosCamposOpcoesDetalhesSelect .= "id, ";
$strSqlFormulariosCamposOpcoesDetalhesSelect .= "id_tb_formularios_campos, ";
$strSqlFormulariosCamposOpcoesDetalhesSelect .= "n_classificacao, ";
$strSqlFormulariosCamposOpcoesDetalhesSelect .= "nome_opcao, ";
$strSqlFormulariosCamposOpcoesDetalhesSelect .= "nome_opcao_formatado, ";
$strSqlFormulariosCamposOpcoesDetalhesSelect .= "arquivo ";
$strSqlFormulariosCamposOpcoesDetalhesSelect .= "FROM tb_formularios_campos_opcoes ";
$strSqlFormulariosCamposOpcoesDetalhesSelect .= "WHERE id <> 0 ";
//$strSqlFormulariosCamposOpcoesDetalhesSelect .= "AND id_tb_categorias = :id_tb_categorias ";
$strSqlFormulariosCamposOpcoesDetalhesSelect .= "AND id = :id ";
//$strSqlFormulariosCamposOpcoesDetalhesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";


$statementFormulariosCamposOpcoesDetalhesSelect = $dbSistemaConPDO->prepare($strSqlFormulariosCamposOpcoesDetalhesSelect);

if ($statementFormulariosCamposOpcoesDetalhesSelect !== false)
{
	$statementFormulariosCamposOpcoesDetalhesSelect->execute(array(
		"id" => $idTbFormulariosCamposOpcoes
	));
}

//$resultadoFormulariosCamposOpcoesDetalhes = $dbSistemaConPDO->query($strSqlFormulariosCamposOpcoesDetalhesSelect);
$resultadoFormulariosCamposOpcoesDetalhes = $statementFormulariosCamposOpcoesDetalhesSelect->fetchAll();

if (empty($resultadoFormulariosCamposOpcoesDetalhes))
{
	//echo "Nenhum registro encontrado";
}else{
	foreach($resultadoFormulariosCamposOpcoesDetalhes as $linhaFormulariosCamposOpcoesDetalhes)
	{
		//Definição das variáveis de detalhes.
		$tbFormulariosCamposOpcoesId = $linhaFormulariosCamposOpcoesDetalhes['id'];
		$tbFormulariosCamposOpcoesIdTbFormulariosCampos = $linhaFormulariosCamposOpcoesDetalhes['id_tb_formularios_campos'];
		$tbFormulariosCamposOpcoesNClassificacao = $linhaFormulariosCamposOpcoesDetalhes['n_classificacao'];
		$tbFormulariosCamposOpcoesNomeOpcao = Funcoes::ConteudoMascaraLeitura($linhaFormulariosCamposOpcoesDetalhes['nome_opcao']);
		$tbFormulariosCamposOpcoesNomeOpcaoFormatado = $linhaFormulariosCamposOpcoesDetalhes['nome_opcao_formatado'];
		$tbFormulariosCamposOpcoesArquivo = $linhaFormulariosCamposOpcoesDetalhes['arquivo'];
		
		
		//Verificação de erro.
		//echo "tbFormulariosCamposOpcoesId=" . $tbFormulariosCamposOpcoesId . "<br>";
		//echo "tbFormulariosCamposOpcoesTitulo=" . $tbFormulariosCamposOpcoesTitulo . "<br>";
		//echo "tbFormulariosCamposOpcoesAtivacao=" . $tbFormulariosCamposOpcoesAtivacao . "<br>";
	}
}
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistema"); ?> - <?php echo htmlentities($GLOBALS['configNomeCliente']); ?>
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
    	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFormulariosCamposOpcoesTituloEditar"); ?>
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
		
			//Validação de formulário (JQuery).
			//**************************************************************************************
			$('#formFormulariosCamposOpcoesEditar').validate({ //Inicialização do plug-in.
			
			
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
    <form name="formFormulariosCamposOpcoesEditar" id="formFormulariosCamposOpcoesEditar" action="FormulariosCamposOpcoesEditarExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <table class="TabelaCampos01">
            <tr>
                <td class="TbFundoEscuro" colspan="4">
                    <div align="center" class="Texto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaEnquetesOpcoesTbEnquetesEditar"); ?>
                        </strong>
                    </div>
                </td>
            </tr>
            
        <table class="TabelaCampos01">
            <tr>
                <td class="TbFundoEscuro" colspan="4">
                    <div align="center" class="Texto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFormulariosCamposOpcoesTbCampos"); ?>
                        </strong>
                    </div>
                </td>
            </tr>
            
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFormulariosCamposOpcoesNomeOpcao"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula"<?php if($GLOBALS['habilitarFormulariosCamposOpcoesNClassificacao'] <> "1"){ ?> colspan="3"<?php } ?>>
                    <div align="left">
                        <input type="text" name="nome_opcao" id="nome_opcao" class="CampoTexto01" maxlength="255" value="<?php echo $tbFormulariosCamposOpcoesNomeOpcao; ?>" />
                    </div>
                </td>
				<?php if($GLOBALS['habilitarFormulariosCamposOpcoesNClassificacao'] == 1){ ?>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNClassificacao"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaColuna01 TabelaCampos01Celula">
                    <div>
                        <input type="text" name="n_classificacao" id="n_classificacao" class="CampoNumerico01" maxlength="10" value="<?php echo $tbFormulariosCamposOpcoesNClassificacao; ?>" />
                    </div>
                </td>
                <?php } ?>
            </tr>
            
			<?php if($GLOBALS['habilitarFormulariosCamposOpcoesImagem'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemImagem"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                <div>
                    <table cellpadding="0" cellspacing="0" style="width: 100%;">
                        <tr>
                            <td width="1">
                                <input type="file" name="ArquivoUpload1" id="ArquivoUpload1" class="CampoArquivoUpload01" />
                            </td>
                            
                            <?php if(!empty($tbFormulariosCamposOpcoesArquivo)){ //if($tbCategoriasImagem <> ""){?>
                            <td width="1">
                                <img src="<?php echo $GLOBALS['configDiretorioArquivos'];?>/t<?php echo $tbFormulariosCamposOpcoesArquivo; ?>?variavelCache=<?php echo date("s"); ?>" alt="<?php echo $tbFormulariosCamposOpcoesArquivo; ?>" style="margin-left: 4px;" />
                            </td>
                            <td>
                                <a href="RegistrosArquivosExcluirExe.php?idRegistro=<?php echo $tbFormulariosCamposOpcoesId;?>&strTabela=tb_formularios_campos_opcoes&strCampo=arquivo<?php echo $queryPadrao;?>" class="LinksExcluir01" style="margin-left: 4px;">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemImagemExcluir"); ?>
                                </a>
                            </td>
                            <?php } ?>
                            
                        </tr>
                    </table>
                </div>
                </td>
            </tr>
            <?php } ?>
        </table>
        <div>
            <div style="float:left;">
                <input type="image" name="submit" value="Submit" src="img/btoAtualizar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoAtualizar"); ?>" />
                
                <input name="idTbFormulariosCamposOpcoes" type="hidden" id="idTbFormulariosCamposOpcoes" value="<?php echo $tbFormulariosCamposOpcoesId; ?>" />
                <input name="id_tb_formularios_campos" type="hidden" id="id_tb_formularios_campos" value="<?php echo $tbFormulariosCamposOpcoesIdTbFormulariosCampos; ?>" />
                <input name="nome_opcao_formatado" type="hidden" id="nome_opcao_formatado" value="<?php echo $tbFormulariosCamposOpcoesNomeOpcaoFormatado; ?>" />
                <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                <input name="masterPageSelect" type="hidden" id="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
            </div>
            <div style="float:right;">
                <a href="<?php echo $paginaRetorno; ?>?idTbFormulariosCampos=<?php echo $tbFormulariosCamposOpcoesIdTbFormulariosCampos; ?><?php echo $queryPadrao;?>">
                    <img src="img/btoVoltar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoVoltar"); ?>"  />
                </a>
            </div>
        </div>
    </form>
<?php 
$page->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>



<?php
//Limpeza de objetos.
//----------
unset($strSqlFormulariosCamposOpcoesDetalhesSelect);
unset($statementFormulariosCamposOpcoesDetalhesSelect);
unset($resultadoFormulariosCamposOpcoesDetalhes);
unset($linhaFormulariosCamposOpcoesDetalhes);
//----------
?>


<?php 
//Inclusão do template do layout.
include_once $page->LayoutSistema;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>