<?php
//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeLayout.php";


//Verificação de login Master.
LoginAutenticacao::UsuarioLoginVerificacao();


//Resgate de variáveis.
$idParent = $_GET["idParent"];
$idParentCategoriasRaiz = $_GET["idParentCategoriasRaiz"];
if($idParentCategoriasRaiz == "")
{
	$idParentCategoriasRaiz = 0;
}

$dataAtual = "";
if($configSistemaFormatoData == 1)
{
	$dataAtual = date("d") . "/" . date("m") . "/" . date("Y");
	
}
if($configSistemaFormatoData == 2)
{
	$dataAtual = date("m") . "/" . date("d") . "/" . date("Y");
}

$paginaRetorno = "HistoricoInteracaoIndice.php";
$paginaRetornoExclusao = "HistoricoInteracaoEditar.php";
$variavelRetorno = "idParent";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];

//Montagem de query padrão de retorno.
$queryPadrao = "&idParent=" . $idParent . 
"&paginaRetorno=" . $paginaRetorno . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&masterPageSelect=" . $masterPageSelect . 
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


//Verificação de erro - debug.

?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistema"); ?>
     - 
	<?php echo htmlentities($GLOBALS['configNomeCliente']); ?>
     - 
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoInteracaoTitulo"); ?>
<?php 
$page->cphTitle = ob_get_clean(); 
//ob_end_flush();
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
    <div>
        <div align="left" class="TextoTitulo01">
            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoInteracaoTitulo"); ?>
        </div>
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
    
    <div align="left" class="Texto01">
        <?php //Cadastro. ?>
        <?php //---------- ?>
    	<?php if($idParent <> ""){ ?>
        	<?php if(DbFuncoes::GetCampoGenerico01(DbFuncoes::GetCampoGenerico01($idParent, "tb_historico", "id_parent"), "tb_cadastro", "id") <> ""){ ?>
                <div>
                	<strong>
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaTarefasCadastroVinculado"); ?>: 
                    </strong>
                    <?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01(DbFuncoes::GetCampoGenerico01($idParent, "tb_historico", "id_parent"), "tb_cadastro", "nome"), 
																						DbFuncoes::GetCampoGenerico01(DbFuncoes::GetCampoGenerico01($idParent, "tb_historico", "id_parent"), "tb_cadastro", "razao_social"), 
																						DbFuncoes::GetCampoGenerico01(DbFuncoes::GetCampoGenerico01($idParent, "tb_historico", "id_parent"), "tb_cadastro", "nome_fantasia"), 
																						1)); ?>
                </div>
            <?php } ?>
        <?php } ?>
        <?php //---------- ?>

        
        <?php //Histórico. ?>
        <?php //---------- ?>
        <?php if($idParent <> ""){ ?>
			<?php if(DbFuncoes::GetCampoGenerico01($idParent, "tb_historico", "id") <> ""){ ?>
                <div>
                    <strong>
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoAssunto"); ?>: 
                    </strong>
                    <?php echo Funcoes::ConteudoMascaraLeitura(DbFuncoes::GetCampoGenerico01($idParent, "tb_historico", "assunto")); ?>
                </div>
                <div>
                    <strong>
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistorico"); ?>: 
                    </strong>
                    <?php echo Funcoes::ConteudoMascaraLeitura(DbFuncoes::GetCampoGenerico01($idParent, "tb_historico", "historico")); ?>
                </div>
            <?php } ?>
        <?php } ?>
        <?php //---------- ?>
    </div>
    <form name="formHistoricoInteracao" id="formHistoricoInteracao" action="HistoricoInteracaoIndiceExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <div>
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="4">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoInteracaoTbHistoricoInteracao"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemData"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div align="left">
                            <?php //JQuery DatePicker. ?>
                            <?php //---------------------- ?>
                            <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 1){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        var strDatapickerAgendaPtCampos = "#data_interacao";
                                    </script>
                                <?php } ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 2){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        var strDatapickerAgendaEnCampos = "#data_interacao";
                                    </script>
                                <?php } ?>
                                <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                            
                                <input type="text" name="data_interacao" id="data_interacao" class="CampoData01" maxlength="10" value="<?php echo $dataAtual; ?>" />
                                <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                            <?php } ?>
                            <?php //---------------------- ?>
                        </div>
                    </td>
                </tr>
                
                <?php if($GLOBALS['habilitarCadastroHistoricoInteracaoAssunto'] == 1){ ?>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoInteracaoAssunto"); ?>
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div align="left">
                            <input type="text" name="assunto" id="assunto" class="CampoTexto01" />
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoInteracaoInteracao"); ?>
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="interacao" id="interacao" class="CampoTextoMultilinha01"></textarea>
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
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoCadastroUsuario"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div class="Texto01">
                            <?php 
                                $arrHistoricoCadastroUsuario = DbFuncoes::VinculoGenericoSelect02("0", "", "tb_cadastro", "id_tb_categorias", "", "nome", 1);
                            ?>
                            <select name="id_tb_cadastro_usuario" id="id_tb_cadastro_usuario" class="CampoDropDownMenu01">
                                <option value="0" selected="selected"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNenhumDropDown"); ?></option>
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
                <input type="image" name="submit" value="Submit" src="img/btoIncluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoIncluir"); ?>" />
                
                <input name="id_parent" type="hidden" id="id_parent" value="<?php echo $idParent; ?>" />
                <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                <input name="masterPageSelect" type="hidden" id="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
            </div>
            <div style="float:right;">
                &nbsp;
            </div>
        </div>
    </form>
    <br />
    
    <?php
	if (empty($resultadoHistoricoInteracao))
	{
        //echo "Nenhum registro encontrado";
    ?>
        <div align="center" class="TextoErro">
            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
        </div>
    <?php
    }else{
    ?>

        <form name="formHistoricoInteracaoAcoes" id="formHistoricoInteracaoAcoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_interacao" />
            <input name="idParent" id="idParent" type="hidden" value="<?php echo $idParent; ?>" />

            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            <input name="masterPageSelect" type="hidden" id="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
            <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            <div style="position:relative; display: block; clear: both;">
                <div align="right" style="float: right;">
                    <input type="image" name="submit" value="Submit" src="img/btoExcluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoExcluir"); ?>">
                </div>
            </div>
            <table width="100%" class="TabelaDados01">
              <tr class="TbFundoEscuro">
              	<?php if($GLOBALS['habilitarCadastroHistoricoVisualizarProtocolo'] == 1){ ?>
                <td width="50" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoProtocolo"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <td width="50" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemData"); ?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoInteracaoInteracao"); ?>
                    </div>
                </td>
                
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                    </div>
                </td>
                
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemExcluir"); ?>
                    </div>
                </td>
              </tr>
              <?php
                //Loop pelos resultados.
                foreach($resultadoHistoricoInteracao as $linhaHistoricoInteracao)
                {
              ?>
              <tr class="TbFundoClaro">
              	<?php if($GLOBALS['habilitarCadastroHistoricoVisualizarProtocolo'] == 1){ ?>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaHistoricoInteracao['id'];?>
                    </div>
                </td>
                <?php } ?>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php //echo $linhaHistoricoInteracao['data_interacao'];?>
                        <?php echo Funcoes::DataLeitura01($linhaHistoricoInteracao['data_interacao'], $GLOBALS['configSistemaFormatoData'], "2"); ?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                	<?php if($GLOBALS['habilitarCadastroHistoricoInteracaoAssunto'] == 1){ ?>
                    <div class="Texto01">
                    	<strong>
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoInteracao['assunto']);?>
                        </strong>
                    </div>
                    <?php } ?>
                    <div class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoInteracao['interacao']);?>
                    </div>
                    
                    <?php if($GLOBALS['habilitarCadastroHistoricoUsuario'] == 1){ ?>
						<?php if($linhaHistoricoInteracao['id_tb_cadastro_usuario'] <> 0){ ?>
                        <div class="Texto01">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoCadastroUsuario"); ?>: 
                            </strong>
                            <a href="CadastroAdministrar.php?idTbCadastro=<?php echo $linhaHistoricoInteracao['id_parent'];?>&masterPageSelect=LayoutSistemaSemMenu.php" target="_blank" class="Links01">
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
                            <div class="Texto01">
                                <strong>
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaTarefasCadastroVinculado"); ?>: 
                                </strong>
                                <a href="CadastroAdministrar.php?idTbCadastro=<?php echo DbFuncoes::GetCampoGenerico01($linhaHistoricoInteracao['id_parent'], "tb_historico", "id_parent");?>&masterPageSelect=LayoutSistemaSemMenu.php" target="_blank" class="Links01">
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
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="HistoricoInteracaoEditar.php?idTbHistoricoInteracao=<?php echo $linhaHistoricoInteracao['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoInteracao['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
	<?php } ?>
<?php 
$page->cphConteudoPrincipal = ob_get_clean(); 
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
?>


<?php 
//Inclusão do template do layout.
include_once $page->LayoutSistema;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>