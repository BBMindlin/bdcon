<?php
//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeLayout.php";


//Verificação de login Master.
LoginAutenticacao::UsuarioLoginVerificacao();


//Resgate de variáveis.
$idTbFormulariosCampos = $_GET["idTbFormulariosCampos"];
$idTbFormularios = DbFuncoes::GetCampoGenerico01($idTbFormulariosCampos, "tb_formularios_campos", "id_tb_formularios");

$paginaRetorno = "FormulariosCamposIndice.php";
$paginaRetornoExclusao = "FormulariosCamposEditar.php";
$variavelRetorno = "idTbFormulariosCampos";
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
$strSqlFormulariosCamposDetalhesSelect = "";
$strSqlFormulariosCamposDetalhesSelect .= "SELECT ";
//$strSqlFormulariosCamposDetalhesSelect .= "* ";
$strSqlFormulariosCamposDetalhesSelect .= "id, ";
$strSqlFormulariosCamposDetalhesSelect .= "id_tb_formularios, ";
$strSqlFormulariosCamposDetalhesSelect .= "n_classificacao, ";
$strSqlFormulariosCamposDetalhesSelect .= "nome_campo, ";
$strSqlFormulariosCamposDetalhesSelect .= "nome_campo_formatado, ";
$strSqlFormulariosCamposDetalhesSelect .= "tipo_campo, ";
$strSqlFormulariosCamposDetalhesSelect .= "tamanho_campo, ";
$strSqlFormulariosCamposDetalhesSelect .= "altura_campo, ";
$strSqlFormulariosCamposDetalhesSelect .= "ativacao, ";
$strSqlFormulariosCamposDetalhesSelect .= "obrigatorio ";
$strSqlFormulariosCamposDetalhesSelect .= "FROM tb_formularios_campos ";
$strSqlFormulariosCamposDetalhesSelect .= "WHERE id <> 0 ";
//$strSqlFormulariosCamposDetalhesSelect .= "AND id_tb_categorias = :id_tb_categorias ";
$strSqlFormulariosCamposDetalhesSelect .= "AND id = :id ";
//$strSqlFormulariosCamposDetalhesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";


$statementFormulariosCamposDetalhesSelect = $dbSistemaConPDO->prepare($strSqlFormulariosCamposDetalhesSelect);

if ($statementFormulariosCamposDetalhesSelect !== false)
{
	$statementFormulariosCamposDetalhesSelect->execute(array(
		"id" => $idTbFormulariosCampos
	));
}

//$resultadoFormulariosCamposDetalhes = $dbSistemaConPDO->query($strSqlFormulariosCamposDetalhesSelect);
$resultadoFormulariosCamposDetalhes = $statementFormulariosCamposDetalhesSelect->fetchAll();

if (empty($resultadoFormulariosCamposDetalhes))
{
	//echo "Nenhum registro encontrado";
}else{
	foreach($resultadoFormulariosCamposDetalhes as $linhaFormulariosCamposDetalhes)
	{
		//Definição das variáveis de detalhes.
		$tbFormulariosCamposId = $linhaFormulariosCamposDetalhes['id'];
		$tbFormulariosCamposIdTbFormularios = $linhaFormulariosCamposDetalhes['id_tb_formularios'];
		$tbFormulariosCamposNClassificacao = $linhaFormulariosCamposDetalhes['n_classificacao'];
		$tbFormulariosCamposNomeCampo = Funcoes::ConteudoMascaraLeitura($linhaFormulariosCamposDetalhes['nome_campo']);
		$tbFormulariosCamposNomeCampoFormatado = $linhaFormulariosCamposDetalhes['nome_campo_formatado'];
		$tbFormulariosCamposTipoCampo = $linhaFormulariosCamposDetalhes['tipo_campo'];
		$tbFormulariosCamposTamanhoCampo = $linhaFormulariosCamposDetalhes['tamanho_campo'];
		$tbFormulariosCamposAlturaCampo = $linhaFormulariosCamposDetalhes['altura_campo'];
		$tbFormulariosCamposAtivacao = $linhaFormulariosCamposDetalhes['ativacao'];
		$tbFormulariosCamposObrigatorio = $linhaFormulariosCamposDetalhes['obrigatorio'];
		
		
		//Verificação de erro.
		//echo "tbFormulariosCamposId=" . $tbFormulariosCamposId . "<br>";
		//echo "tbFormulariosCamposTitulo=" . $tbFormulariosCamposTitulo . "<br>";
		//echo "tbFormulariosCamposAtivacao=" . $tbFormulariosCamposAtivacao . "<br>";
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
    	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFormulariosCamposTituloEditar"); ?>
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
			$('#formFormulariosCamposEditar').validate({ //Inicialização do plug-in.
			
			
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
    <form name="formFormulariosCamposEditar" id="formFormulariosCamposEditar" action="FormulariosCamposEditarExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <table class="TabelaCampos01">
            <tr>
                <td class="TbFundoEscuro" colspan="4">
                    <div align="center" class="Texto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFormulariosCamposTbCamposEditar"); ?>
                        </strong>
                    </div>
                </td>
            </tr>
            
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFormulariosCamposNome"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula"<?php if($GLOBALS['habilitarFormulariosCamposNClassificacao'] <> "1"){ ?> colspan="3"<?php } ?>>
                    <div align="left">
                        <input type="text" name="nome_campo" id="nome_campo" class="CampoTexto01" maxlength="255" value="<?php echo $tbFormulariosCamposNomeCampo; ?>" />
                    </div>
                </td>
				<?php if($GLOBALS['habilitarFormulariosCamposNClassificacao'] == 1){ ?>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNClassificacao"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaColuna01 TabelaCampos01Celula">
                    <div>
                        <input type="text" name="n_classificacao" id="n_classificacao" class="CampoNumerico01" maxlength="10" value="<?php echo $tbFormulariosCamposNClassificacao; ?>" />
                    </div>
                </td>
                <?php } ?>
            </tr>
            
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFormulariosCamposTipo"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left">
                        <table width="100%" border="0" cellpadding="0" cellspacing="1">
                            <tr>
                                <td width="50" class="TbFundoMedio">
                                    <div align="center" class="Texto01">
                                        <strong>
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFormulariosCamposSelecao"); ?>
                                        </strong>
                                    </div>
                                </td>
                                <td class="TbFundoMedio">
                                    <div align="left" class="Texto01">
                                        <strong>
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFormulariosCamposExemplo"); ?>
                                        </strong>
                                    </div>
                                </td>
                                <td class="TbFundoMedio">
                                    <div align="left" class="Texto01">
                                        <strong>
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFormulariosCamposDescricao"); ?>
                                        </strong>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div align="center">
                                        <input type="radio" name="tipo_campo" value="1"<?php if($tbFormulariosCamposTipoCampo == 1){ ?> checked="checked"<?php } ?> />
                                    </div>
                                </td>
                                <td width="200">
                                    <input name="exemplo" type="text" class="CampoTexto01" size="40" />
                                </td>
                                <td>
                                    <div align="left" class="Texto01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFormulariosCamposDescricaoCaixaTexto"); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div align="center">
                                        <input type="radio" name="tipo_campo" value="2"<?php if($tbFormulariosCamposTipoCampo == 2){ ?> checked="checked"<?php } ?> />
                                    </div>
                                </td>
                                <td>
                                    <textarea name="exemplo" cols="30" rows="3" class="CampoTextoMultilinhaConteudo"></textarea>
                                </td>
                                <td>
                                    <div align="left" class="Texto01">
                                    	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFormulariosCamposDescricaoAreaTexto"); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div align="center">
                                        <input type="radio" name="tipo_campo" value="3"<?php if($tbFormulariosCamposTipoCampo == 3){ ?> checked="checked"<?php } ?> />
                                    </div>
                                </td>
                                <td>
                                    <input name="exemplo" type="checkbox"value="exemplo" />
                                </td>
                                <td>
                                    <div align="left" class="Texto01">
                                    	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFormulariosCamposDescricaoCheckBox"); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div align="center">
                                        <input type="radio" name="tipo_campo" value="4"<?php if($tbFormulariosCamposTipoCampo == 4){ ?> checked="checked"<?php } ?> />
                                    </div>
                                </td>
                                <td>
                                    <input type="radio" name="exemplo" value="exemplo" />
                                </td>
                                <td>
                                    <div align="left" class="Texto01">
                                    	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFormulariosCamposDescricaoRadio"); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div align="center">
                                        <input type="radio" name="tipo_campo" value="5"<?php if($tbFormulariosCamposTipoCampo == 5){ ?> checked="checked"<?php } ?> />
                                    </div>
                                </td>
                                <td>
                                    <select name="exemplo" class="CampoDropDownMenu01" id="exemplo">
                                        <option selected="selected"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFormulariosCamposDescricaoDropDown01"); ?></option>
                                        <option><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFormulariosCamposDescricaoDropDown02"); ?></option>
                                        <option><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFormulariosCamposDescricaoDropDown03"); ?></option>
                                    </select>
                                </td>
                                <td>
                                    <div align="left" class="Texto01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFormulariosCamposDescricaoDropDown"); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div align="center">
                                        <input type="radio" name="tipo_campo" value="7"<?php if($tbFormulariosCamposTipoCampo == 7){ ?> checked="checked"<?php } ?> />
                                    </div>
                                </td>
                                <td>
                                    <div align="left" class="ConteudoTexto">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFormulariosCamposDescricaoTexto"); ?>
                                    </div>
                                </td>
                                <td>
                                    <div align="left" class="Texto01">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div align="center">
                                        <input type="radio" name="tipo_campo" value="8"<?php if($tbFormulariosCamposTipoCampo == 8){ ?> checked="checked"<?php } ?> />
                                    </div>
                                </td>
                                <td>
                                    <div align="left" class="ConteudoSubtitulo">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFormulariosCamposDescricaoSubtitulo"); ?>
                                    </div>
                                </td>
                                <td>
                                    <div align="left" class="Texto01">
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
            
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFormulariosCamposTamanho"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left">
                        <input type="text" name="tamanho_campo" id="tamanho_campo" class="CampoNumerico01" maxlength="255" value="<?php echo $tbFormulariosCamposTamanhoCampo; ?>" />
                    </div>
                </td>
            </tr>
            
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFormulariosCamposAltura"); ?>
                        <br />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFormulariosCamposAlturaObs"); ?>
                        :
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left">
                        <input type="text" name="altura_campo" id="altura_campo" class="CampoNumerico01" maxlength="255" value="<?php echo $tbFormulariosCamposAlturaCampo; ?>" />
                    </div>
                </td>
            </tr>
            
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao3"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left" class="Texto01">
                        <select name="ativacao" id="ativacao" class="CampoDropDownMenu01">
                            <option value="0"<?php if($tbFormulariosCamposAtivacao == "0"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao4"); ?></option>
                            <option value="1"<?php if($tbFormulariosCamposAtivacao == "1"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao5"); ?></option>
                        </select>
                    </div>
                </td>
            </tr>
            
			<?php if($GLOBALS['habilitarFormulariosCamposObrigatorio'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFormulariosCamposObrigatorio"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left" class="Texto01">
                        <select name="obrigatorio" id="obrigatorio" class="CampoDropDownMenu01">
                            <option value="0"<?php if($tbFormulariosCamposObrigatorio == "0"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFormulariosCamposObrigatorio0"); ?></option>
                            <option value="1"<?php if($tbFormulariosCamposObrigatorio == "1"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFormulariosCamposObrigatorio1"); ?></option>
                        </select>
                    </div>
                </td>
            </tr>
			<?php } ?>
        </table>
        <div>
            <div style="float:left;">
                <input type="image" name="submit" value="Submit" src="img/btoAtualizar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoAtualizar"); ?>" />
                
                <input name="idTbFormulariosCampos" type="hidden" id="idTbFormulariosCampos" value="<?php echo $tbFormulariosCamposId; ?>" />
                <input name="id_tb_formularios" type="hidden" id="id_tb_formularios" value="<?php echo $tbFormulariosCamposIdTbFormularios; ?>" />
                <input name="nome_campo_formatado" type="hidden" id="nome_campo_formatado" value="<?php echo $tbFormulariosCamposNomeCampoFormatado; ?>" />
                <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                <input name="masterPageSelect" type="hidden" id="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
            </div>
            <div style="float:right;">
                <a href="<?php echo $paginaRetorno; ?>?idTbFormularios=<?php echo $tbFormulariosCamposIdTbFormularios; ?><?php echo $queryPadrao;?>">
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
unset($strSqlFormulariosCamposDetalhesSelect);
unset($statementFormulariosCamposDetalhesSelect);
unset($resultadoFormulariosCamposDetalhes);
unset($linhaFormulariosCamposDetalhes);
//----------
?>


<?php 
//Inclusão do template do layout.
include_once $page->LayoutSistema;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>