<?php
//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeLayout.php";


//Verificação de login Master.
LoginAutenticacao::UsuarioLoginVerificacao();


//Resgate de variáveis.
$idTbFormularios = $_GET["idTbFormularios"];
$idParentFormularios = DbFuncoes::GetCampoGenerico01($idTbFormularios, "tb_formularios", "id_tb_categorias");

$paginaRetorno = "FormulariosIndice.php";
$paginaRetornoExclusao = "FormulariosEditar.php";
$variavelRetorno = "idTbFormularios";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];


//Montagem de query padrão de retorno.
$queryPadrao = "&idParentFormularios=" . $idParentFormularios . 
"&paginaRetorno=" . $paginaRetorno . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&variavelRetorno=" . $variavelRetorno;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Query de pesquisa.
//----------
$strSqlFormulariosDetalhesSelect = "";
$strSqlFormulariosDetalhesSelect .= "SELECT ";
//$strSqlFormulariosDetalhesSelect .= "* ";
$strSqlFormulariosDetalhesSelect .= "id, ";
$strSqlFormulariosDetalhesSelect .= "id_tb_categorias, ";
$strSqlFormulariosDetalhesSelect .= "nome_formulario, ";
$strSqlFormulariosDetalhesSelect .= "assunto_formulario, ";
$strSqlFormulariosDetalhesSelect .= "nome_email_destinatario, ";
$strSqlFormulariosDetalhesSelect .= "email_destinatario, ";
$strSqlFormulariosDetalhesSelect .= "email_copia, ";
$strSqlFormulariosDetalhesSelect .= "config_mensagem_sucesso ";
$strSqlFormulariosDetalhesSelect .= "FROM tb_formularios ";
$strSqlFormulariosDetalhesSelect .= "WHERE id <> 0 ";
//$strSqlFormulariosDetalhesSelect .= "AND id_tb_categorias = :id_tb_categorias ";
$strSqlFormulariosDetalhesSelect .= "AND id = :id ";
//$strSqlFormulariosDetalhesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";


$statementFormulariosDetalhesSelect = $dbSistemaConPDO->prepare($strSqlFormulariosDetalhesSelect);

if ($statementFormulariosDetalhesSelect !== false)
{
	$statementFormulariosDetalhesSelect->execute(array(
		"id" => $idTbFormularios
	));
}

//$resultadoFormulariosDetalhes = $dbSistemaConPDO->query($strSqlFormulariosDetalhesSelect);
$resultadoFormulariosDetalhes = $statementFormulariosDetalhesSelect->fetchAll();

if (empty($resultadoFormulariosDetalhes))
{
	//echo "Nenhum registro encontrado";
}else{
	foreach($resultadoFormulariosDetalhes as $linhaFormulariosDetalhes)
	{
		//Definição das variáveis de detalhes.
		$tbFormulariosId = $linhaFormulariosDetalhes['id'];
		$tbFormulariosIdTbCategorias = $linhaFormulariosDetalhes['id_tb_categorias'];
		$tbFormulariosNomeFormulario = Funcoes::ConteudoMascaraLeitura($linhaFormulariosDetalhes['nome_formulario']);
		$tbFormulariosAssuntoFormulario = Funcoes::ConteudoMascaraLeitura($linhaFormulariosDetalhes['assunto_formulario']);
		$tbFormulariosNomeEmailDestinatario = Funcoes::ConteudoMascaraLeitura($linhaFormulariosDetalhes['nome_email_destinatario']);
		$tbFormulariosEmailDestinatario = Funcoes::ConteudoMascaraLeitura($linhaFormulariosDetalhes['email_destinatario']);
		$tbFormulariosEmailCopia = Funcoes::ConteudoMascaraLeitura($linhaFormulariosDetalhes['email_copia']);
		$tbFormulariosConfigMensagemSucesso = Funcoes::ConteudoMascaraLeitura($linhaFormulariosDetalhes['config_mensagem_sucesso']);
		
		
		//Verificação de erro.
		//echo "tbFormulariosId=" . $tbFormulariosId . "<br>";
		//echo "tbFormulariosTitulo=" . $tbFormulariosTitulo . "<br>";
		//echo "tbFormulariosAtivacao=" . $tbFormulariosAtivacao . "<br>";
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
    	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFormulariosTituloEditar"); ?> - <?php echo "titulo"; ?> - 
        <a href="CategoriasIndice.php?idParentCategorias=<?php echo $idParentCategoriasRaiz; ?>&idParentCategoriasRaiz=<?php echo $idParentCategoriasRaiz; ?>" class="Links04">
        	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemRoot"); ?>
        </a>
        <?php echo DbFuncoes::CategoriasCaminho($idParentFormularios, $idParentCategoriasRaiz, " - ", "Links04", "backend"); ?>
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
    
    <form name="formFormulariosEditar" id="formFormulariosEditar" action="FormulariosEditarExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <table class="TabelaCampos01">
            <tr>
                <td class="TbFundoEscuro" colspan="4">
                    <div align="center" class="Texto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFormulariosTbFormulariosEditar"); ?>
                        </strong>
                    </div>
                </td>
            </tr>
            
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFormulariosNome"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left">
                        <input type="text" name="nome_formulario" id="nome_formulario" class="CampoTexto01" value="<?php echo $tbFormulariosNomeFormulario; ?>" />
                    </div>
                </td>
            </tr>

            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFormulariosAssunto"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left">
                        <input type="text" name="assunto_formulario" id="assunto_formulario" class="CampoTexto01" maxlength="255" value="<?php echo $tbFormulariosAssuntoFormulario; ?>" />
                    </div>
                </td>
            </tr>
            
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFormulariosNomeEmailDestinatario"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left">
                        <input type="text" name="nome_email_destinatario" id="nome_email_destinatario" class="CampoTexto01" maxlength="255" value="<?php echo $tbFormulariosNomeEmailDestinatario; ?>" />
                    </div>
                </td>
            </tr>
            
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFormulariosEmailDestinatario"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left">
                        <input type="text" name="email_destinatario" id="email_destinatario" class="CampoTexto01" maxlength="255" value="<?php echo $tbFormulariosEmailDestinatario; ?>" />
                    </div>
                </td>
            </tr>

            <?php if($GLOBALS['habilitarFormulariosCopia'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFormulariosEmailCopia"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left">
                        <input type="text" name="email_copia" id="email_copia" class="CampoTexto01" maxlength="255" value="<?php echo $tbFormulariosEmailCopia; ?>" />
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarFormulariosConfigMensageSucesso'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFormulariosConfigMensagemSucesso"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div>
                        <?php //Sem formatação.?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                            <textarea name="config_mensagem_sucesso" id="config_mensagem_sucesso" class="CampoTextoMultilinha01"><?php echo $tbFormulariosConfigMensagemSucesso; ?></textarea>
                        <?php } ?>
                        
                        <?php //Formatação básica (CLEditor).?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                            
                            <script type="text/javascript">
                                //Caixa básica.
                                $(document).ready(function () {
                                    $("#config_mensagem_sucesso").cleditor(
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
                            <textarea name="config_mensagem_sucesso" id="config_mensagem_sucesso"><?php echo $tbFormulariosConfigMensagemSucesso; ?></textarea>
                        <?php } ?>
                        
                        <?php //Formatação avançada (CLEditor).?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                            <script type="text/javascript">
                                $(document).ready(function () {
                                    $("#config_mensagem_sucesso").cleditor(
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
                            <textarea name="config_mensagem_sucesso" id="config_mensagem_sucesso"><?php echo $tbFormulariosConfigMensagemSucesso; ?></textarea>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        </table>
        <div>
            <div style="float:left;">
                <input type="image" name="submit" value="Submit" src="img/btoAtualizar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoAtualizar"); ?>" />
                
                <input name="idTbFormularios" type="hidden" id="idTbFormularios" value="<?php echo $tbFormulariosId; ?>" />
                <input name="id_tb_categorias" type="hidden" id="id_tb_categorias" value="<?php echo $tbFormulariosIdTbCategorias; ?>" />
                <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                <input name="masterPageSelect" type="hidden" id="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
            </div>
            <div style="float:right;">
                <a href="<?php echo $paginaRetorno; ?>?idParentFormularios=<?php echo $idParentFormularios; ?>">
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
unset($strSqlFormulariosDetalhesSelect);
unset($statementFormulariosDetalhesSelect);
unset($resultadoFormulariosDetalhes);
unset($linhaFormulariosDetalhes);
//----------
?>


<?php 
//Inclusão do template do layout.
include_once $page->LayoutSistema;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>