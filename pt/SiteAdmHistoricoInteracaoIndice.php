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
$idParent = $_GET["idParent"];
$tbHistoricoIdParent = DbFuncoes::GetCampoGenerico01($idParent, "tb_historico", "id_parent");
/*
$idParentCategoriasRaiz = $_GET["idParentCategoriasRaiz"];
if($idParentCategoriasRaiz == "")
{
	$idParentCategoriasRaiz = 0;
}
*/

$dataAtual = "";
if($configSistemaFormatoData == 1)
{
	$dataAtual = date("d") . "/" . date("m") . "/" . date("Y");
	
}
if($configSistemaFormatoData == 2)
{
	$dataAtual = date("m") . "/" . date("d") . "/" . date("Y");
}

$paginaRetorno = "SiteAdmHistoricoInteracaoIndice.php";
$paginaRetornoExclusao = "SiteAdmHistoricoInteracaoEditar.php";
$variavelRetorno = "idParent";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];

//Montagem de query padrão de retorno.
$queryPadrao = "&idParent=" . $idParent . 
"&paginaRetorno=" . $paginaRetorno . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&masterPageSiteSelect=" . $masterPageSiteSelect . 
"&variavelRetorno=" . $variavelRetorno;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Query de pesquisa.
//----------
$strSqlHistoricoInteracaoSelect = "";
$strSqlHistoricoInteracaoSelect .= "SELECT ";
//$strSqlHistoricoInteracaoSelect .= "* ";
$strSqlHistoricoInteracaoSelect .= "id, ";
$strSqlHistoricoInteracaoSelect .= "id_parent, ";
$strSqlHistoricoInteracaoSelect .= "id_tb_cadastro_usuario, ";
$strSqlHistoricoInteracaoSelect .= "data_interacao, ";
$strSqlHistoricoInteracaoSelect .= "assunto, ";
$strSqlHistoricoInteracaoSelect .= "interacao ";
$strSqlHistoricoInteracaoSelect .= "FROM tb_historico_interacao ";
$strSqlHistoricoInteracaoSelect .= "WHERE id <> 0 ";
$strSqlHistoricoInteracaoSelect .= "AND id_parent = :id_parent ";
$strSqlHistoricoInteracaoSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastroHistoricoInteracao'] . " ";


$statementHistoricoInteracaoSelect = $dbSistemaConPDO->prepare($strSqlHistoricoInteracaoSelect);

if ($statementHistoricoInteracaoSelect !== false)
{
	$statementHistoricoInteracaoSelect->execute(array(
		"id_parent" => $idParent
	));
}

//$resultadoHistoricoInteracao = $dbSistemaConPDO->query($strSqlHistoricoInteracaoSelect);
$resultadoHistoricoInteracao = $statementHistoricoInteracaoSelect->fetchAll();


//Definição de variáveis.
if($idParent <> ""){
	$tituloLinkAtual = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoInteracaoTitulo");
}
if($palavraChave <> ""){
	$tituloLinkAtual = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaResultados");
}
$metaTitulo = $tituloLinkAtual . " - " . htmlentities($GLOBALS['configTituloSite']);


//Verificação de erro - debug.
//echo "dataTarefaPesquisa=" . $dataTarefaPesquisa . "<br />";
//echo "palavraChave=" . $palavraChave . "<br />";
//echo "idParent=" . $idParent . "<br />";
//echo "strSqlTarefasSelect=" . $strSqlTarefasSelect . "<br />";
//echo "statementTarefasSelect(debugDumpParams)=" . $statementTarefasSelect->debugDumpParams() . "<br />";
//echo "statementTarefasSelect(debugDumpParams)=" . print_r($statementTarefasSelect->debugDumpParams()) . "<br />";
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
    
    
    
	<?php //Cadastro - Detalhes.?>
    <?php //----------------------?>
    <?php 
	//Definição de variáveis do include.
	//$includePaginas_idParentPaginas = $tbCadastroId;
	$includeCadastroDetalhes_idTbCadastro = $idParent;
	$includeCadastro_configTipoDiagramacao = "1";
	?>
    
    <?php include "IncludeCadastroDetalhes.php";?>
    <?php //----------------------?>


	<div class="AdmTexto01" style="position: relative; display: block;">
    	<?php if($GLOBALS['habilitarCadastroHistoricoVisualizarProtocolo'] == 1){ ?>
            <div>
                <strong>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoProtocolo"); ?>:
                </strong>
                <?php echo $idParent; ?>
            </div>
    	<?php } ?>

    	<div>
            <strong>
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoData"); ?>:
            </strong>
            <?php echo Funcoes::DataLeitura01(DbFuncoes::GetCampoGenerico01($idParent, "tb_historico", "siteHistoricoData"), $GLOBALS['configSiteFormatoData'], "2"); ?>
        </div>
    
    	<div>
            <strong>
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoAssunto"); ?>:
            </strong>
            <?php echo Funcoes::ConteudoMascaraLeitura(DbFuncoes::GetCampoGenerico01($idParent, "tb_historico", "assunto")); ?>
        </div>
        
    	<div>
            <strong>
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistorico"); ?>:
            </strong>
            <?php echo Funcoes::ConteudoMascaraLeitura(DbFuncoes::GetCampoGenerico01($idParent, "tb_historico", "historico")); ?>
        </div>
    </div>
    
    <form name="formHistoricoInteracao" id="formHistoricoInteracao" action="SiteAdmHistoricoInteracaoIndiceExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <div>
            <table class="AdmTabelaCampos01">
                <tr>
                    <td class="AdmTbFundoEscuro" colspan="4">
                        <div align="center" class="AdmTexto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoInteracaoTbHistoricoInteracao"); ?>
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
                        	<?php //Data fixa. ?>
                            <?php if($GLOBALS['configCadastroHistoricoAdmDataEdicao'] == 0){ ?>
                            	<?php echo $dataAtual; ?>
                            <?php } ?>
                        
                        	<?php //Edição de data. ?>
                        	<?php if($GLOBALS['configCadastroHistoricoAdmDataEdicao'] == 1){ ?>
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
                                
                                    <input type="text" name="data_interacao" id="data_interacao" class="AdmCampoData01" maxlength="10" value="<?php echo $dataAtual; ?>" />
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
                            <input type="text" name="assunto" id="assunto" class="AdmCampoTexto02" />
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
                                <textarea name="interacao" id="interacao" class="AdmCampoTextoMultilinha01"></textarea>
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
                                <textarea name="interacao" id="interacao"></textarea>
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
                                <textarea name="interacao" id="interacao"></textarea>
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
                                $arrHistoricoCadastroUsuario = DbFuncoes::VinculoGenericoSelect02("0", "", "tb_cadastro", "id_tb_categorias", "", "nome", 1);
                            ?>
                            <select name="id_tb_cadastro_usuario" id="id_tb_cadastro_usuario" class="CampoDropDownMenu01">
                                <option value="0" selected="selected"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoCadastroUsuario); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrHistoricoCadastroUsuario[$countArray][0];?>"><?php echo $arrHistoricoCadastroUsuario[$countArray][1];?></option>
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
                <input type="image" name="submit" value="Submit" src="img/btoIncluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoIncluir"); ?>" />
                
                <input name="id_parent" type="hidden" id="id_parent" value="<?php echo $idParent; ?>" />
                <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                <input name="masterPageSiteSelect" type="hidden" id="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
            </div>
            <div style="float:right;">
				<?php //Botão Voltar - Histórico.?>
                <?php //----------------------?>
            	<?php if($tbHistoricoIdParent <> ""){ ?>
                    <a href="SiteAdmHistoricoIndice.php?idParent=<?php echo $tbHistoricoIdParent; ?>">
                        <img src="img/btoVoltar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoVoltar"); ?>"  />
                    </a>
                <?php } ?>
                <?php //----------------------?>
            </div>
        </div>
    </form>
    <br />
    <br />
    
    <?php
	if (empty($resultadoHistoricoInteracao))
	{
        //echo "Nenhum registro encontrado";
    ?>
        <div align="center" class="AdmErro">
            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatus1"); ?>
        </div>
    <?php
    }else{
    ?>

        <form name="formHistoricoInteracaoAcoes" id="formHistoricoInteracaoAcoes" action="SiteAdmRegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_interacao" />
            <input name="idParent" id="idParent" type="hidden" value="<?php echo $idParent; ?>" />

            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            <input name="masterPageSiteSelect" type="hidden" id="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
            <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            <div style="position:relative; display: block; clear: both;">
            	<?php if($GLOBALS['habilitarHistoricoAdmExclusao'] == 1){ ?>
                    <div align="right" style="float: right;">
                        <input type="image" name="submit" value="Submit" src="img/btoExcluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoExcluir"); ?>">
                    </div>
                <?php } ?>
            </div>
            <table width="100%" class="TabelaDados01">
              <tr class="AdmTbFundoEscuro">
              	<?php if($GLOBALS['habilitarCadastroHistoricoVisualizarProtocolo'] == 1){ ?>
                <td width="50" class="AdmTbFundoEscuro">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoProtocolo"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <td width="50" class="AdmTbFundoEscuro">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemData"); ?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoInteracaoInteracao"); ?>
                    </div>
                </td>
                
                <?php if($GLOBALS['habilitarHistoricoAdmEdicao'] == 1){ ?>
                <td width="30" class="AdmTbFundoEscuro">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoAdmExclusao'] == 1){ ?>
                <td width="30" class="AdmTbFundoEscuro">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemExcluir"); ?>
                    </div>
                </td>
                <?php } ?>
              </tr>
              <?php
                //Loop pelos resultados.
                foreach($resultadoHistoricoInteracao as $linhaHistoricoInteracao)
                {
              ?>
              <tr class="<?php if($linhaHistoricoInteracao['id_tb_cadastro_usuario'] <> 0){?>AdmTbFundoAtivado<?php }else{ ?>AdmTbFundoClaro<?php } ?>">
              	<?php if($GLOBALS['habilitarCadastroHistoricoVisualizarProtocolo'] == 1){ ?>
                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <?php echo $linhaHistoricoInteracao['id'];?>
                    </div>
                </td>
                <?php } ?>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <?php //echo $linhaHistoricoInteracao['data_interacao'];?>
                        <?php echo Funcoes::DataLeitura01($linhaHistoricoInteracao['data_interacao'], $GLOBALS['configSiteFormatoData'], "2"); ?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                	<?php if($GLOBALS['habilitarCadastroHistoricoInteracaoAssunto'] == 1){ ?>
                    <div class="AdmTexto01">
                    	<strong>
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoInteracao['assunto']);?>
                        </strong>
                    </div>
                    <?php } ?>
                    <div class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoInteracao['interacao']);?>
                    </div>
                    
                    <?php if($GLOBALS['habilitarCadastroHistoricoUsuario'] == 1){ ?>
						<?php if($linhaHistoricoInteracao['id_tb_cadastro_usuario'] <> 0){ ?>
                        <div class="AdmTexto01">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoCadastroUsuario"); ?>: 
                            </strong>
                            <a href="CadastroAdministrar.php?idTbCadastro=<?php echo $linhaHistoricoInteracao['id_parent'];?>&masterPageSelect=LayoutSistemaSemMenu.php" target="_blank" class="AdmLinks01">
								<?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaHistoricoInteracao['id_tb_cadastro_usuario'], "tb_cadastro", "nome"), 
                                DbFuncoes::GetCampoGenerico01($linhaHistoricoInteracao['id_tb_cadastro_usuario'], "tb_cadastro", "razao_social"), 
                                DbFuncoes::GetCampoGenerico01($linhaHistoricoInteracao['id_tb_cadastro_usuario'], "tb_cadastro", "nome_fantasia"), 
                                1)); ?>
                            </a>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    
                    <?php //if(empty($idParent)){ ?>
                    <?php if($idParent == ""){ ?>
						<?php //if(!empty(DbFuncoes::GetCampoGenerico01($linhaTarefas['id_parent'], "tb_cadastro", "id"))){ ?>
						<?php if(DbFuncoes::GetCampoGenerico01(DbFuncoes::GetCampoGenerico01($linhaHistoricoInteracao['id_parent'], "tb_historico", "id_parent"), "tb_cadastro", "id") <> ""){ ?>
                            <div class="AdmTexto01">
                                <strong>
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteTarefasCadastroVinculado"); ?>: 
                                </strong>
                                <a href="CadastroAdministrar.php?idTbCadastro=<?php echo DbFuncoes::GetCampoGenerico01($linhaHistoricoInteracao['id_parent'], "tb_historico", "id_parent");?>&masterPageSelect=LayoutSistemaSemMenu.php" target="_blank" class="AdmLinks01">
                                    <?php //echo Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaTarefas['id_parent'], "tb_cadastro", "nome"); ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01(DbFuncoes::GetCampoGenerico01($linhaHistoricoInteracao['id_parent'], "tb_historico", "id_parent"), "tb_cadastro", "nome"), 
									DbFuncoes::GetCampoGenerico01(DbFuncoes::GetCampoGenerico01($linhaHistoricoInteracao['id_parent'], "tb_historico", "id_parent"), "tb_cadastro", "razao_social"), 
									DbFuncoes::GetCampoGenerico01(DbFuncoes::GetCampoGenerico01($linhaHistoricoInteracao['id_parent'], "tb_historico", "id_parent"), "tb_cadastro", "nome_fantasia"), 
									1)); ?>
                                </a>
                            </div>
						<?php } ?>
                     <?php } ?>
                </td>
                
                <?php if($GLOBALS['habilitarHistoricoAdmEdicao'] == 1){ ?>
                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <a href="SiteAdmHistoricoInteracaoEditar.php?idTbHistoricoInteracao=<?php echo $linhaHistoricoInteracao['id'];?><?php echo $queryPadrao;?>" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoAdmExclusao'] == 1){ ?>
                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoInteracao['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
                <?php } ?>
              </tr>
              <?php } ?>
            </table>
        </form>
	<?php } ?>
<?php 
$pageSite->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php
//Limpeza de objetos.
//----------
unset($strSqlHistoricoInteracaoSelect);
unset($statementHistoricoInteracaoSelect);
unset($resultadoHistoricoInteracao);
unset($linhaHistoricoInteracao);
//----------


//Inclusão do template do layout.
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>