<?php
//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeLayout.php";


//Verificação de login Master.
LoginAutenticacao::UsuarioLoginVerificacao();


//Resgate de variáveis.
$idTbCategorias = $_GET["idTbCategorias"];
//$idParentCategorias = $_GET["idParentCategorias"];
$idParentCategorias = DbFuncoes::GetCampoGenerico01($idTbCategorias, "tb_categorias", "id_parent");
$idParentCategoriasRaiz = $_GET["idParentCategoriasRaiz"];
if($idParentCategoriasRaiz == "")
{
	$idParentCategoriasRaiz = 0;
}

$idTbCadastroUsuario = $_GET["idTbCadastroUsuario"];
if($idTbCadastroUsuario == "")
{
	$idTbCadastroUsuario = 0;
}

$paginaRetorno = "CategoriasIndice.php";
$paginaRetornoExclusao = "CategoriasEditar.php";
$variavelRetorno = "idTbCategorias";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];


//Montagem de query padrão de retorno.
$queryPadrao = "&idParentCategorias=" . $idParentCategorias . "&idTbCadastroUsuario=" . $idTbCadastroUsuario . "&paginaRetorno=" . $paginaRetorno . "&paginaRetornoExclusao=" . $paginaRetornoExclusao . "&variavelRetorno=" . $variavelRetorno;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Query de pesquisa.
//----------
$strSqlCategoriasDetalhesSelect = "";
$strSqlCategoriasDetalhesSelect .= "SELECT ";
$strSqlCategoriasDetalhesSelect .= "id, ";
$strSqlCategoriasDetalhesSelect .= "id_parent, ";
$strSqlCategoriasDetalhesSelect .= "id_tb_cadastro_usuario, ";
$strSqlCategoriasDetalhesSelect .= "n_classificacao, ";
$strSqlCategoriasDetalhesSelect .= "data_categoria, ";
$strSqlCategoriasDetalhesSelect .= "categoria, ";
$strSqlCategoriasDetalhesSelect .= "descricao, ";
$strSqlCategoriasDetalhesSelect .= "informacao_complementar1, ";
$strSqlCategoriasDetalhesSelect .= "informacao_complementar2, ";
$strSqlCategoriasDetalhesSelect .= "informacao_complementar3, ";
$strSqlCategoriasDetalhesSelect .= "informacao_complementar4, ";
$strSqlCategoriasDetalhesSelect .= "informacao_complementar5, ";
$strSqlCategoriasDetalhesSelect .= "tipo_categoria, ";
$strSqlCategoriasDetalhesSelect .= "imagem, ";
$strSqlCategoriasDetalhesSelect .= "ativacao, ";
$strSqlCategoriasDetalhesSelect .= "acesso_restrito ";
$strSqlCategoriasDetalhesSelect .= "FROM tb_categorias ";
$strSqlCategoriasDetalhesSelect .= "WHERE id <> 0 ";
//$strSqlCategoriasDetalhesSelect .= "AND id_parent = ? ";
//$strSqlCategoriasDetalhesSelect .= "AND id_parent = " . $idParentCategorias . " ";
$strSqlCategoriasDetalhesSelect .= "AND id = :id ";
//$strSqlCategoriasDetalhesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCategorias'] . " ";
//----------


//Componentes e parâmetros.
//----------
$statementCategoriasDetalhesSelect = $dbSistemaConPDO->prepare($strSqlCategoriasDetalhesSelect);

if ($statementCategoriasDetalhesSelect !== false)
{
	$statementCategoriasDetalhesSelect->execute(array(
		"id" => $idTbCategorias
	));
}

//$resultadoCategorias = $dbSistemaConPDO->query($strSqlCategoriasDetalhesSelect);
$resultadoCategorias = $statementCategoriasDetalhesSelect->fetchAll();
//----------


if (empty($resultadoCategorias))
{
	//echo "Nenhum registro encontrado";
}else{
	foreach($resultadoCategorias as $linhaCategorias)
	{
		//Definição das variáveis de detalhes.
		$tbCategoriasId = $linhaCategorias['id'];
		$tbCategoriasIdParent = $linhaCategorias['id_parent'];
		$tbCategoriasNClassificacao = $linhaCategorias['n_classificacao'];
		$tbCategoriasIdTbCadastroUsuario = $linhaCategorias['id_tb_cadastro_usuario'];
		//$tbCategoriasNNivel = $linhaCategorias['n_nivel'];
		//$tbCategoriasDataCategoria = $linhaCategorias['data_categoria'];
		$tbCategoriasCategoria = Funcoes::ConteudoMascaraLeitura($linhaCategorias['categoria']);
		$tbCategoriasDescricao = Funcoes::ConteudoMascaraLeitura($linhaCategorias['descricao']);
		$tbCategoriasIC1 = Funcoes::ConteudoMascaraLeitura($linhaCategorias['informacao_complementar1']);
		$tbCategoriasIC2 = Funcoes::ConteudoMascaraLeitura($linhaCategorias['informacao_complementar2']);
		$tbCategoriasIC3 = Funcoes::ConteudoMascaraLeitura($linhaCategorias['informacao_complementar3']);
		$tbCategoriasIC4 = Funcoes::ConteudoMascaraLeitura($linhaCategorias['informacao_complementar4']);
		$tbCategoriasIC5 = Funcoes::ConteudoMascaraLeitura($linhaCategorias['informacao_complementar5']);
		$tbCategoriasTipoCategoria = $linhaCategorias['tipo_categoria'];
		$tbCategoriasImagem = $linhaCategorias['imagem'];
		$tbCategoriasAtivacao = $linhaCategorias['ativacao'];
		$tbCategoriasAcessoRestrito = $linhaCategorias['acesso_restrito'];
		
		//Verificação de erro.
		//echo "id=" . $linhaCategorias['id'] . "<br>";
		//echo "id_parent=" . $linhaCategorias['id_parent'] . "<br>";
		//echo "categoria=" . Funcoes::ConteudoMascaraLeitura($linhaCategorias['categoria']) . "<br>";
		
		//echo "id=" . $tbCategoriasId . "<br>";
		//echo "id_parent=" . $tbCategoriasIdParent . "<br>";
		//echo "categoria=" . $tbCategoriasCategoria . "<br>";
	}
}
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configNomeCliente'], "IncludeConfig"); ?>
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
    	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCategoriasTituloEditar"); ?> - <?php echo $tbCategoriasCategoria; ?> - 
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
    
	<script type="text/javascript">
		$(document).ready(function () {
		
			//Validação de formulário (JQuery).
			//**************************************************************************************
			$('#formCategorias').validate({ //Inicialização do plug-in.
			
			
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
    <form name="formCategorias" id="formCategorias" action="CategoriasEditarExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
    <table class="TabelaCampos01">
        <tr class="TbFundoEscuro">
            <td class="TabelaCampos01Celula" colspan="4">
                <div align="center" class="Texto02">
                    <strong>
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCategoriasTbCategoriasEditar"); ?>
                    </strong>
                </div>
            </td>
        </tr>
        
		<?php if($GLOBALS['habilitarCategoriasIdParentEdicao'] == 1){ ?>
        <tr>
            <td class="TbFundoMedio TabelaColuna01">
                <div align="left" class="Texto01">
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemCategoriaVinculada"); ?>:
                </div>
            </td>
            <td class="TbFundoClaro" colspan="3">
                <div>
                    <?php 
                        $arrCategoriasIdParent = DbFuncoes::CategoriasIdParentSelect("");
						
						//echo "tbCategoriasIdParent=" . $tbCategoriasIdParent . "<br/>";
                    ?>
                    <select name="id_parent" id="id_parent" class="CampoDropDownMenu01">
                    	<option value="0"<?php if($tbCategoriasIdParent == "0"){ ?> selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemRootDropDown"); ?></option>
                        <?php 
                        for($countArray = 0; $countArray < count($arrCategoriasIdParent); $countArray++)
                        {
                        ?>
                            <option value="<?php echo $arrCategoriasIdParent[$countArray][0];?>"<?php if($arrCategoriasIdParent[$countArray][0] == $tbCategoriasIdParent){ ?> selected="selected"<?php } ?>><?php echo $arrCategoriasIdParent[$countArray][1];?></option>
                        <?php 
                        }
                        ?>
                    </select>
                </div>
            </td>
        </tr>
        <?php } ?>
        
        <tr>
            <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                <div align="left" class="Texto01">
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCategoriasCategoria"); ?>:
                </div>
            </td>
            <td class="TbFundoClaro TabelaCampos01Celula"<?php if($GLOBALS['habilitarCategoriasNClassificacao'] <> "1"){ ?> colspan="3"<?php } ?>>
                <div align="left">
                    <input type="text" name="categoria" id="categoria" class="CampoTexto01" maxlength="255" value="<?php echo $tbCategoriasCategoria; ?>" />
                </div>
            </td>
            <?php if($GLOBALS['habilitarCategoriasNClassificacao'] == 1){ ?>
            <td class="TbFundoMedio TabelaColuna01">
                <div align="left" class="Texto01">
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNClassificacao"); ?>:
                </div>
            </td>
            <td class="TbFundoClaro TabelaColuna01 TabelaCampos01Celula">
                <div>
                    <input name="n_classificacao" type="text" class="CampoNumerico01" id="n_classificacao" maxlength="10" value="<?php echo $tbCategoriasNClassificacao; ?>" />
                </div>
            </td>
            <?php } ?>
        </tr>
        
        <?php if($GLOBALS['ativacaoCategoriasDescricao'] == 1){ ?>
        <tr>
            <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                <div align="left" class="Texto01">
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCategoriasDescricao"); ?>:
                </div>
            </td>
            <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                <div>
                  <textarea id="descricao" name="descricao" class="CampoTextoMultilinha01"><?php echo $tbCategoriasDescricao; ?></textarea>
                </div>
            </td>
        </tr>
        <?php } ?>
        
        <tr>
            <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                <div align="left" class="Texto01">
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCategoriasTipo"); ?>:
                </div>
            </td>
            <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                <div>
					<?php //echo "tbCategoriasTipoCategoria=" . $tbCategoriasTipoCategoria . "<br />"; ?>                
                    <select name="tipo_categoria" id="tipo_categoria" class="CampoDropDownMenu01">
                        <?php
                        for ($countTipoCategoria = 0; $countTipoCategoria < count($GLOBALS['arrTipoCategoriaConfigIndice']); ++$countTipoCategoria) 
                        { 
                        ?>
                            <option value="<?php echo $GLOBALS['arrTipoCategoriaConfigIndice'][$countTipoCategoria];?>"<?php if($tbCategoriasTipoCategoria == $GLOBALS['arrTipoCategoriaConfigIndice'][$countTipoCategoria]){?> selected="selected"<?php } ?>><?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['arrTipoCategoriaConfigNome'][$countTipoCategoria],"utf8_encode");?></option>
                        <?php 
                        }
                        ?>
                    </select>
                </div>
            </td>
        </tr>
    
        <?php if($GLOBALS['habilitarCategoriasIc1'] == 1){ ?>
        <tr>
            <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                <div align="left" class="Texto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCategoriasIc1'], "IncludeConfig"); ?>:
                </div>
            </td>
            <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                <div>
                    <?php if($GLOBALS['configCategoriasBoxIc1'] == 1){ ?>
                        <input type="text" name="informacao_complementar1" id="informacao_complementar1" class="CampoTexto01" maxlength="255" value="<?php echo $tbCategoriasIC1; ?>" />
                    <?php } ?>
                    <?php if($GLOBALS['configCategoriasBoxIc1'] == 2){ ?>
                        <?php //Sem formatação.?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                            <textarea name="informacao_complementar1" id="informacao_complementar1" class="CampoTextoMultilinha01"><?php echo $tbCategoriasIC1; ?></textarea>
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
                            <textarea name="informacao_complementar1" id="informacao_complementar1"><?php echo $tbCategoriasIC1; ?></textarea>
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
                            <textarea name="informacao_complementar1" id="informacao_complementar1"><?php echo $tbCategoriasIC1; ?></textarea>
                        <?php } ?>
                    <?php } ?>
                </div>
            </td>
        </tr>
        <?php } ?>
        
        <?php if($GLOBALS['habilitarCategoriasIc2'] == 1){ ?>
        <tr>
            <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                <div align="left" class="Texto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCategoriasIc2'], "IncludeConfig"); ?>:
                </div>
            </td>
            <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                <div>
                    <?php if($GLOBALS['configCategoriasBoxIc2'] == 1){ ?>
                        <input type="text" name="informacao_complementar2" id="informacao_complementar2" class="CampoTexto01" maxlength="255" value="<?php echo $tbCategoriasIC2; ?>" />
                    <?php } ?>
                    <?php if($GLOBALS['configCategoriasBoxIc2'] == 2){ ?>
                        <?php //Sem formatação.?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                            <textarea name="informacao_complementar2" id="informacao_complementar2" class="CampoTextoMultilinha01"><?php echo $tbCategoriasIC2; ?></textarea>
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
                            <textarea name="informacao_complementar2" id="informacao_complementar2"><?php echo $tbCategoriasIC2; ?></textarea>
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
                            <textarea name="informacao_complementar2" id="informacao_complementar2"><?php echo $tbCategoriasIC2; ?></textarea>
                        <?php } ?>
                    <?php } ?>
                </div>
            </td>
        </tr>
        <?php } ?>
    
        <?php if($GLOBALS['habilitarCategoriasIc3'] == 1){ ?>
        <tr>
            <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                <div align="left" class="Texto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCategoriasIc3'], "IncludeConfig"); ?>:
                </div>
            </td>
            <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                <div>
                    <?php if($GLOBALS['configCategoriasBoxIc3'] == 1){ ?>
                        <input type="text" name="informacao_complementar3" id="informacao_complementar3" class="CampoTexto01" maxlength="255" value="<?php echo $tbCategoriasIC3; ?>" />
                    <?php } ?>
                    <?php if($GLOBALS['configCategoriasBoxIc3'] == 2){ ?>
                        <?php //Sem formatação.?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                            <textarea name="informacao_complementar3" id="informacao_complementar3" class="CampoTextoMultilinha01"><?php echo $tbCategoriasIC3; ?></textarea>
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
                            <textarea name="informacao_complementar3" id="informacao_complementar3"><?php echo $tbCategoriasIC3; ?></textarea>
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
                            <textarea name="informacao_complementar3" id="informacao_complementar3"><?php echo $tbCategoriasIC3; ?></textarea>
                        <?php } ?>
                    <?php } ?>
                </div>
            </td>
        </tr>
        <?php } ?>
    
        <?php if($GLOBALS['habilitarCategoriasIc4'] == 1){ ?>
        <tr>
            <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                <div align="left" class="Texto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCategoriasIc4'], "IncludeConfig"); ?>:
                </div>
            </td>
            <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                <div>
                    <?php if($GLOBALS['configCategoriasBoxIc4'] == 1){ ?>
                        <input type="text" name="informacao_complementar4" id="informacao_complementar4" class="CampoTexto01" maxlength="255" value="<?php echo $tbCategoriasIC4; ?>" />
                    <?php } ?>
                    <?php if($GLOBALS['configCategoriasBoxIc4'] == 2){ ?>
                        <?php //Sem formatação.?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                            <textarea name="informacao_complementar4" id="informacao_complementar4" class="CampoTextoMultilinha01"><?php echo $tbCategoriasIC4; ?></textarea>
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
                            <textarea name="informacao_complementar4" id="informacao_complementar4"><?php echo $tbCategoriasIC4; ?></textarea>
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
                            <textarea name="informacao_complementar4" id="informacao_complementar4"><?php echo $tbCategoriasIC4; ?></textarea>
                        <?php } ?>
                    <?php } ?>
                </div>
            </td>
        </tr>
        <?php } ?>
    
        <?php if($GLOBALS['habilitarCategoriasIc5'] == 1){ ?>
        <tr>
            <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                <div align="left" class="Texto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCategoriasIc5'], "IncludeConfig"); ?>:
                </div>
            </td>
            <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                <div>
                    <?php if($GLOBALS['configCategoriasBoxIc5'] == 1){ ?>
                        <input type="text" name="informacao_complementar5" id="informacao_complementar5" class="CampoTexto01" maxlength="255" value="<?php echo $tbCategoriasIC5; ?>" />
                    <?php } ?>
                    <?php if($GLOBALS['configCategoriasBoxIc5'] == 2){ ?>
                        <?php //Sem formatação.?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                            <textarea name="informacao_complementar5" id="informacao_complementar5" class="CampoTextoMultilinha01"><?php echo $tbCategoriasIC5; ?></textarea>
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
                            <textarea name="informacao_complementar5" id="informacao_complementar5"><?php echo $tbCategoriasIC5; ?></textarea>
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
                            <textarea name="informacao_complementar5" id="informacao_complementar5"><?php echo $tbCategoriasIC5; ?></textarea>
                        <?php } ?>
                    <?php } ?>
                </div>
            </td>
        </tr>
        <?php } ?>
        <?php if($GLOBALS['ativacaoCategoriasImagem'] == 1){ ?>
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
                            
                            <?php if(!empty($tbCategoriasImagem)){ //if($tbCategoriasImagem <> ""){?>
                            <td width="1">
                                <img src="<?php echo $GLOBALS['configDiretorioArquivos'];?>/t<?php echo $tbCategoriasImagem; ?>?variavelCache=<?php echo date("s"); ?>" alt="<?php echo $tbCategoriasImagem; ?>" style="margin-left: 4px;" />
                            </td>
                            <td>
                                <a href="RegistrosArquivosExcluirExe.php?idRegistro=<?php echo $tbCategoriasId;?>&strTabela=tb_categorias&strCampo=imagem<?php echo $queryPadrao;?>" class="LinksExcluir01" style="margin-left: 4px;">
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
            
            <input name="idTbCategorias" type="hidden" id="idTbCategorias" value="<?php echo $tbCategoriasId; ?>" />
            <?php if($GLOBALS['habilitarCategoriasIdParentEdicao'] <> 1){ ?>
                <input name="id_parent" type="hidden" id="id_parent" value="<?php echo $tbCategoriasIdParent; ?>" />
            <?php } ?>
            <input name="ativacao" type="hidden" id="ativacao" value="<?php echo $tbCategoriasAtivacao; ?>" />
            <input name="acesso_restrito" type="hidden" id="acesso_restrito" value="<?php echo $tbCategoriasAcessoRestrito; ?>" />
            <input name="id_tb_cadastro_usuario" type="hidden" id="id_tb_cadastro_usuario" value="<?php echo $tbCategoriasIdTbCadastroUsuario; ?>" />
            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
        </div>
        <div style="float:right;">
        	<a href="<?php echo $paginaRetorno; ?>?idParentCategorias=<?php echo $idParentCategorias; ?>">
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
unset($strSqlCategoriasDetalhesSelect);
unset($statementCategoriasDetalhesSelect);
unset($resultadoCategorias);
unset($linhaCategorias);
//----------
?>


<?php 
//Inclusão do template do layout.
include_once $page->LayoutSistema;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>