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
$idTbHistoricoInteracao = $_GET["idTbHistoricoInteracao"];
$idParent = DbFuncoes::GetCampoGenerico01($idTbHistoricoInteracao, "tb_historico_interacao", "id_parent");

$paginaRetorno = "SiteAdmHistoricoInteracaoIndice.php";
$paginaRetornoExclusao = "SiteAdmHistoricoInteracaoEditar.php";
$variavelRetorno = "idParent";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];


//Montagem de query padrão de retorno.
$queryPadrao = "&idTbCadastroUsuario=" . $idTbCadastroUsuario . 
"&paginaRetorno=" . $paginaRetorno . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&masterPageSiteSelect=" . $masterPageSiteSelect . 
"&variavelRetorno=" . $variavelRetorno;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Query de pesquisa.
//----------
$strSqlHistoricoInteracaoDetalhesSelect = "";
$strSqlHistoricoInteracaoDetalhesSelect .= "SELECT ";
//$strSqlHistoricoInteracaoDetalhesSelect .= "* ";
$strSqlHistoricoInteracaoDetalhesSelect .= "id, ";
$strSqlHistoricoInteracaoDetalhesSelect .= "id_parent, ";
$strSqlHistoricoInteracaoDetalhesSelect .= "id_tb_cadastro_usuario, ";
$strSqlHistoricoInteracaoDetalhesSelect .= "data_interacao, ";
$strSqlHistoricoInteracaoDetalhesSelect .= "assunto, ";
$strSqlHistoricoInteracaoDetalhesSelect .= "interacao ";
$strSqlHistoricoInteracaoDetalhesSelect .= "FROM tb_historico_interacao ";
$strSqlHistoricoInteracaoDetalhesSelect .= "WHERE id <> 0 ";
//$strSqlHistoricoInteracaoDetalhesSelect .= "AND id_tb_categorias = :id_tb_categorias ";
$strSqlHistoricoInteracaoDetalhesSelect .= "AND id = :id ";
//$strSqlHistoricoInteracaoDetalhesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";


$statementHistoricoInteracaoDetalhesSelect = $dbSistemaConPDO->prepare($strSqlHistoricoInteracaoDetalhesSelect);

if ($statementHistoricoInteracaoDetalhesSelect !== false)
{
	$statementHistoricoInteracaoDetalhesSelect->execute(array(
		"id" => $idTbHistoricoInteracao
	));
}

//$resultadoHistoricoInteracaoDetalhes = $dbSistemaConPDO->query($strSqlHistoricoInteracaoDetalhesSelect);
$resultadoHistoricoInteracaoDetalhes = $statementHistoricoInteracaoDetalhesSelect->fetchAll();

if (empty($resultadoHistoricoInteracaoDetalhes))
{
	//echo "Nenhum registro encontrado";
}else{
	foreach($resultadoHistoricoInteracaoDetalhes as $linhaHistoricoInteracaoDetalhes)
	{
		//Definição das variáveis de detalhes.
		$tbHistoricoInteracaoId = $linhaHistoricoInteracaoDetalhes['id'];
		$tbHistoricoInteracaoIdParent = $linhaHistoricoInteracaoDetalhes['id_parent'];
		$tbHistoricoInteracaoIdTbCadastroUsuario = $linhaHistoricoInteracaoDetalhes['id_tb_cadastro_usuario'];
		$tbHistoricoInteracaoDataInteracao = Funcoes::DataLeitura01($linhaHistoricoInteracaoDetalhes['data_interacao'], $GLOBALS['configSistemaFormatoData'], "1");
		$tbHistoricoInteracaoAssunto = Funcoes::ConteudoMascaraLeitura($linhaHistoricoInteracaoDetalhes['assunto']);
		$tbHistoricoInteracaoInteracao = Funcoes::ConteudoMascaraLeitura($linhaHistoricoInteracaoDetalhes['interacao']);
		
		//Verificação de erro.
		//echo "tbHistoricoInteracaoId=" . $tbHistoricoInteracaoId . "<br>";
		//echo "tbHistoricoInteracaoAssunto=" . $tbHistoricoInteracaoAssunto . "<br>";
		//echo "tbPaginasAtivacao=" . $tbPaginasAtivacao . "<br>";
	}
}


//Definição de variáveis.
$tituloLinkAtual = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoInteracaoEditarTitulo");
$metaTitulo = $tituloLinkAtual . " - " . htmlentities($GLOBALS['configTituloSite']);
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


    <form name="formHistoricoInteracaoEditar" id="formHistoricoInteracaoEditar" action="SiteAdmHistoricoInteracaoEditarExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <div>
            <table class="AdmTabelaCampos01">
                <tr>
                    <td class="AdmTbFundoEscuro" colspan="4">
                        <div align="center" class="AdmTexto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoInteracaoTbHistoricoInteracaoEditar"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemData"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left" class="AdmTexto01">
                        	<?php if($configCadastroHistoricoDataEdicao == 0) { ?>
                        		<?php echo $tbHistoricoInteracaoDataInteracao; ?>
                            <?php } ?>
                            
							<?php if($configCadastroHistoricoDataEdicao == 1) { ?>
                                <?php //JQuery DatePicker. ?>
                                <?php //---------------------- ?>
                                <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                    <?php if($GLOBALS['configSiteFormatoData'] == 1){ ?>
                                        <script type="text/javascript">
                                            //Variável para conter todos os campos que funcionam com o DatePicker.
                                            //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                            var strDatapickerAgendaPtCampos = "#data_interacao";
                                        </script>
                                    <?php } ?>
                                    <?php if($GLOBALS['configSiteFormatoData'] == 2){ ?>
                                        <script type="text/javascript">
                                            //Variável para conter todos os campos que funcionam com o DatePicker.
                                            //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                            var strDatapickerAgendaEnCampos = "#data_interacao";
                                        </script>
                                    <?php } ?>
                                    <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                                
                                    <input type="text" name="data_interacao" id="data_interacao" class="AdmCampoData01" maxlength="10" value="<?php echo $tbHistoricoInteracaoDataInteracao; ?>" />
                                    <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                                <?php } ?>
                                <?php //---------------------- ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
    
                <?php if($GLOBALS['habilitarCadastroHistoricoInteracaoAssunto'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoInteracaoAssunto"); ?>
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left">
                            <input type="text" name="assunto" id="assunto" class="AdmCampoTexto02" value="<?php echo $tbHistoricoInteracaoAssunto; ?>" />
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoInteracaoInteracao"); ?>
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="interacao" id="interacao" class="AdmCampoTextoMultilinha01"><?php echo $tbHistoricoInteracaoInteracao; ?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">

                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#interacao").cleditor(
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
                                <textarea name="interacao" id="interacao"><?php echo $tbHistoricoInteracaoInteracao; ?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#interacao").cleditor(
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
                                <textarea name="interacao" id="interacao"><?php echo $tbHistoricoInteracaoInteracao; ?></textarea>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                
				<?php if($GLOBALS['habilitarCadastroHistoricoUsuario'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoCadastroUsuario"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                                $arrHistoricoInteracaoCadastroUsuario = DbFuncoes::VinculoGenericoSelect02("0", "", "tb_cadastro", "id_tb_categorias", "", "nome", 1);
                            ?>
                            <select name="id_tb_cadastro_usuario" id="id_tb_cadastro_usuario" class="AdmCampoDropDownMenu01">
                                <option value="0" selected="selected"<?php if($tbHistoricoInteracaoIdTbCadastroUsuario == 0){ ?>selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoInteracaoCadastroUsuario); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrHistoricoInteracaoCadastroUsuario[$countArray][0];?>"<?php if($arrHistoricoInteracaoCadastroUsuario[$countArray][0] == $tbHistoricoInteracaoIdTbCadastroUsuario){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoInteracaoCadastroUsuario[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
            </table>
        </div>
        <div>
            <div style="float:left;">
                <input type="image" name="submit" value="Submit" src="img/btoAtualizar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoAtualizar"); ?>" />
                
                <input name="idTbHistoricoInteracao" type="hidden" id="idTbHistoricoInteracao" value="<?php echo $idTbHistoricoInteracao; ?>" />
                <input name="id_parent" type="hidden" id="id_parent" value="<?php echo $tbHistoricoInteracaoIdParent; ?>" />
                <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                <input name="masterPageSiteSelect" type="hidden" id="masterPageSiteSelect" value="<?php echo $masterPageSelect; ?>" />
            </div>
            <div style="float:right;">
                <a href="<?php echo $paginaRetorno; ?>?idParent=<?php echo $idParent; ?><?php echo $queryPadrao; ?>">
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
unset($strSqlHistoricoInteracaoDetalhesSelect);
unset($statementHistoricoInteracaoDetalhesSelect);
unset($resultadoHistoricoInteracaoDetalhes);
unset($linhaHistoricoInteracaoDetalhes);
//----------


//Inclusão do template do layout.
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>