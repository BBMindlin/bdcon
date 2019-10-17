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
//if($idParent == "")
//{
	//$idParent = NULL;
//}
$idTbTarefaStatus = $_GET["idTbTarefaStatus"];

$idParentCategoriasRaiz = $_GET["idParentCategoriasRaiz"];
if($idParentCategoriasRaiz == "")
{
	$idParentCategoriasRaiz = 0;
}

$dataAtual = "";
if($GLOBALS['configSistemaFormatoData'] == 1)
{
	$dataAtual = date("d") . "/" . date("m") . "/" . date("Y");
	
}
if($GLOBALS['configSistemaFormatoData'] == 2)
{
	$dataAtual = date("m") . "/" . date("d") . "/" . date("Y");
}

//$palavraChave = "%".$_GET["palavraChave"]."%";
$palavraChave = $_GET["palavraChave"];
$dataTarefaPesquisa = $_GET["data_tarefa_pesquisa"];
//if($dataTarefaPesquisa <> "")
//{
	//$dataTarefaPesquisa = Funcoes::DataGravacaoSql($dataTarefaPesquisa, $GLOBALS['configSistemaFormatoData']);
	//$dataTarefaPesquisaInicial = $dataTarefaPesquisa . " 00:00:00";
	//$dataTarefaPesquisaFinal = $dataTarefaPesquisa . " 23:59:59";
//}else{
	//$dataTarefaPesquisa = NULL;
//}
$dataFinalTarefaPesquisa = $_GET["data_final_tarefa_pesquisa"];

$paginaRetorno = "TarefasIndice.php";
$paginaRetornoExclusao = "TarefasEditar.php";
$variavelRetorno = "idParent";
$variavelRetornoValor = $idParent;
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];

//Montagem de query padrão de retorno.
$queryPadrao = "&idParent=" . $idParent . 
"&paginaRetorno=" . $paginaRetorno . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&masterPageSelect=" . $masterPageSelect . 
"&variavelRetorno=" . $variavelRetorno . 
"&variavelRetornoValor=" . $variavelRetornoValor .
"&idTbTarefaStatus=" . $idTbTarefaStatus . 
"&palavraChave=" . $palavraChave . 
"&dataTarefaPesquisa=" . $dataTarefaPesquisa;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Query de pesquisa.
//----------
$strSqlTarefasSelect = "";
$strSqlTarefasSelect .= "SELECT ";
//$strSqlTarefasSelect .= "* ";
$strSqlTarefasSelect .= "id, ";
$strSqlTarefasSelect .= "id_parent, ";
$strSqlTarefasSelect .= "data_registro_tarefa, ";
$strSqlTarefasSelect .= "data_tarefa, ";
$strSqlTarefasSelect .= "data_tarefa_final, ";
$strSqlTarefasSelect .= "id_tb_cadastro_usuario, ";
$strSqlTarefasSelect .= "tarefa, ";
$strSqlTarefasSelect .= "descricao, ";
$strSqlTarefasSelect .= "id_tb_cadastro1, ";
$strSqlTarefasSelect .= "id_tb_cadastro2, ";
$strSqlTarefasSelect .= "id_tb_cadastro3, ";
$strSqlTarefasSelect .= "informacao_complementar1, ";
$strSqlTarefasSelect .= "informacao_complementar2, ";
$strSqlTarefasSelect .= "informacao_complementar3, ";
$strSqlTarefasSelect .= "informacao_complementar4, ";
$strSqlTarefasSelect .= "informacao_complementar5, ";
$strSqlTarefasSelect .= "id_tb_tarefa_status, ";
$strSqlTarefasSelect .= "ativacao ";
$strSqlTarefasSelect .= "FROM tb_tarefas ";
$strSqlTarefasSelect .= "WHERE id <> 0 ";
if($idParent <> "")
{
	$strSqlTarefasSelect .= "AND id_parent = :id_parent ";
}
if($idTbTarefaStatus <> "")
{
	$strSqlTarefasSelect .= "AND id_tb_tarefa_status = :id_tb_tarefa_status ";
}
if($palavraChave <> "")
{
	/*
	$strSqlTarefasSelect .= "AND (tarefa LIKE '%' || :palavraChave || '%' ";
	$strSqlTarefasSelect .= "OR descricao LIKE '%' || :palavraChave || '%' ";
	$strSqlTarefasSelect .= "OR informacao_complementar1 LIKE '%' || :palavraChave || '%' ";
	$strSqlTarefasSelect .= "OR informacao_complementar2 LIKE '%' || :palavraChave || '%' ";
	$strSqlTarefasSelect .= "OR informacao_complementar3 LIKE '%' || :palavraChave || '%' ";
	$strSqlTarefasSelect .= "OR informacao_complementar4 LIKE '%' || :palavraChave || '%' ";
	$strSqlTarefasSelect .= "OR informacao_complementar5 LIKE ''% :palavraChave '%' ";
	$strSqlTarefasSelect .= ") ";
	*/
	
	///*
	$strSqlTarefasSelect .= "AND (tarefa LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTarefasSelect .= "OR descricao LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTarefasSelect .= "OR informacao_complementar1 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTarefasSelect .= "OR informacao_complementar2 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTarefasSelect .= "OR informacao_complementar3 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTarefasSelect .= "OR informacao_complementar4 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTarefasSelect .= "OR informacao_complementar5 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTarefasSelect .= ") ";
	//*/
	
	//$strSqlTarefasSelect .= "AND tarefa LIKE '%' || :palavraChave || '%' ";
	//$strSqlTarefasSelect .= "AND tarefa LIKE '% :palavraChave %' ";
	//$strSqlTarefasSelect .= "AND tarefa LIKE :palavraChave ";
	//$strSqlTarefasSelect .= "AND tarefa LIKE CONCAT('%', :palavraChave, '%') ";
	//$strSqlTarefasSelect .= "AND tarefa LIKE '%' || :palavraChave || '%' ";
	//$strSqlTarefasSelect .= "AND tarefa LIKE '%teste%' ";
	
	//$strSqlTarefasSelect .= "AND tarefa LIKE '%\' || :palavraChave || \'%' ";
	//$strSqlTarefasSelect .= "AND tarefa LIKE '%\ || :palavraChave || \%' ";
	//$strSqlTarefasSelect .= "AND tarefa LIKE CONCAT('%\', :palavraChave, '\%') ";
	
	//$strSqlTarefasSelect .= "AND tarefa LIKE CONCAT('%',:palavraChave,'%') ";
}
if($dataTarefaPesquisa <> "")
{
	//$strSqlTarefasSelect .= "AND data_tarefa = :data_tarefa ";
	//$strSqlTarefasSelect .= "AND DATE(data_tarefa) = :data_tarefa ";
	//$strSqlTarefasSelect .= "AND data_tarefa LIKE :data_tarefa ";
	//$strSqlTarefasSelect .= "AND data_tarefa = '" . $dataTarefaPesquisa . "' ";
	//$strSqlTarefasSelect .= "AND data_tarefa BETWEEN '" . $dataTarefaPesquisa . " 00:00:00' AND '" . $dataTarefaPesquisa . " 23:59:59' ";
	
	//$strSqlTarefasSelect .= "AND data_tarefa BETWEEN '" . Funcoes::ConteudoMascaraGravacao01(Funcoes::DataGravacaoSql($dataTarefaPesquisa, $GLOBALS['configSistemaFormatoData'])) . " 00:00:00' AND '" . Funcoes::ConteudoMascaraGravacao01(Funcoes::DataGravacaoSql($dataTarefaPesquisa, $GLOBALS['configSistemaFormatoData'])) . " 23:59:59' ";
	if($dataFinalTarefaPesquisa <> "")
	{
		$strSqlTarefasSelect .= "AND data_tarefa BETWEEN '" . Funcoes::ConteudoMascaraGravacao01(Funcoes::DataGravacaoSql($dataTarefaPesquisa, $GLOBALS['configSistemaFormatoData'])) . " 00:00:00' AND '" . Funcoes::ConteudoMascaraGravacao01(Funcoes::DataGravacaoSql($dataFinalTarefaPesquisa, $GLOBALS['configSistemaFormatoData'])) . " 23:59:59' ";
	}else{
		$strSqlTarefasSelect .= "AND data_tarefa BETWEEN '" . Funcoes::ConteudoMascaraGravacao01(Funcoes::DataGravacaoSql($dataTarefaPesquisa, $GLOBALS['configSistemaFormatoData'])) . " 00:00:00' AND '" . Funcoes::ConteudoMascaraGravacao01(Funcoes::DataGravacaoSql($dataTarefaPesquisa, $GLOBALS['configSistemaFormatoData'])) . " 23:59:59' ";
	}
	
	//$strSqlTarefasSelect .= "AND data_tarefa BETWEEN ':data_tarefa 00:00:00' AND ':data_tarefa 23:59:59' ";
	//$strSqlTarefasSelect .= "AND data_tarefa BETWEEN :data_tarefa 00:00:00 AND :data_tarefa 23:59:59 ";
	//$strSqlTarefasSelect .= "AND data_tarefa BETWEEN :data_tarefa_pesquisa_inicial AND :data_tarefa_pesquisa_final ";
	//$strSqlTarefasSelect .= "AND data_tarefa BETWEEN ':data_tarefa_pesquisa_inicial' AND ':data_tarefa_pesquisa_final' ";
	//$strSqlTarefasSelect .= "AND DATE_FORMAT(data_tarefa, '%Y-%m-%d') = DATE_FORMAT(:data_tarefa, '%Y-%m-%d') ";
	//$strSqlTarefasSelect .= "AND DATE_FORMAT(data_tarefa, '%Y-%m-%d') = DATE_FORMAT(':data_tarefa', '%Y-%m-%d') ";
	//$strSqlTarefasSelect .= "AND DATE_FORMAT(data_tarefa, '%d') = DATE_FORMAT(:data_tarefa, '%d') ";
	//$strSqlTarefasSelect .= "AND DATE(data_tarefa) = DATE(:data_tarefa) ";
	//$strSqlTarefasSelect .= "AND DATE_FORMAT(data_tarefa, '%Y-%m-%d') = :data_tarefa ";
}
$strSqlTarefasSelect .= "ORDER BY " . $GLOBALS['configClassificacaoTarefas'] . " ";
//echo "strSqlTarefasSelect=" . $strSqlTarefasSelect . "<br />";

//$dbSistemaConPDO->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); //teste para palavra-chave
$statementTarefasSelect = $dbSistemaConPDO->prepare($strSqlTarefasSelect);

//"data_tarefa" => $dataTarefaPesquisa
//"data_tarefa_pesquisa_inicial" => $dataTarefaPesquisaInicial,
//"data_tarefa_pesquisa_final" => $dataTarefaPesquisaFinal,
//"palavraChave" => '%'.$palavraChave.'%'
if ($statementTarefasSelect !== false)
{
	if($idParent <> "")
	{
		$statementTarefasSelect->bindParam(':id_parent', $idParent, PDO::PARAM_STR);
	}
	if($idTbTarefaStatus <> "")
	{
		$statementTarefasSelect->bindParam(':id_tb_tarefa_status', $idTbTarefaStatus, PDO::PARAM_STR);
	}
	$statementTarefasSelect->execute();
	
	/*
	$statementTarefasSelect->bindParam(':id_parent', $idParent, PDO::PARAM_STR);
	$statementTarefasSelect->bindParam(':palavraChave', $palavraChave, PDO::PARAM_STR);
	//$statementTarefasSelect->bindParam(':palavraChave', "%".$palavraChave."%", PDO::PARAM_STR);
	$statementTarefasSelect->execute();
	*/
	/*
	$statementTarefasSelect->execute(array(
		"id_parent" => $idParent
	));
	*/
}

//$resultadoTarefas = $dbSistemaConPDO->query($strSqlTarefasSelect);
$resultadoTarefas = $statementTarefasSelect->fetchAll();


//Verificação de erro - debug.
//echo "dataTarefaPesquisa=" . $dataTarefaPesquisa . "<br />";
//echo "palavraChave=" . $palavraChave . "<br />";
//echo "strSqlTarefasSelect=" . $strSqlTarefasSelect . "<br />";
//echo "statementTarefasSelect(debugDumpParams)=" . $statementTarefasSelect->debugDumpParams() . "<br />";
//echo "statementTarefasSelect(debugDumpParams)=" . print_r($statementTarefasSelect->debugDumpParams()) . "<br />";
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistema"); ?>
     - 
	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configNomeCliente'], "IncludeConfig"); ?>
     - 
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaTarefasTitulo"); ?>
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
            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaTarefasTitulo"); ?>
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
    
	<script type="text/javascript">
        //Variável para conter todos os campos que funcionam com o DatePicker.
        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
        var strDatapickerAgendaPtCampos = "";
        var strDatapickerAgendaEnCampos = "";
        //Obs: modifiquei o posicionamento da definição de variávei para fora da condição de exibição do formulário.
    </script>
    <?php if(!empty($idParent)){ ?>
    <form name="formTarefas" id="formTarefas" action="TarefasIndiceExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <div>
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="4">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaTarefasTbTarefas"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaTarefasData"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div align="left">
							<script type="text/javascript">
                                //Variável para conter todos os campos que funcionam com o DatePicker.
                                //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                //var strDatapickerAgendaPtCampos = "";
                                //var strDatapickerAgendaEnCampos = "";
								//Obs: modifiquei o posicionamento da definição de variávei para fora da condição de exibição do formulário.
                            </script>
                            <?php //JQuery DatePicker. ?>
                            <?php //---------------------- ?>
                            <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 1){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaPtCampos = "#data_tarefa";
										strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data_tarefa;";
                                    </script>
                                <?php } ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 2){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaEnCampos = "#data_tarefa";
										strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data_tarefa;";
                                    </script>
                                <?php } ?>
                                <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                            
                                <input type="text" name="data_tarefa" id="data_tarefa" class="CampoData01" maxlength="10" value="<?php echo $dataAtual; ?>" />
                                <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                            <?php } ?>
                            <?php //---------------------- ?>
                            
                            <?php //Horário. ?>
                            <?php if($GLOBALS['habilitarTarefasDataHorario'] == 1){ ?>
								<?php 
                                    $arrHoraFill = Funcoes::HorarioFill01("h", 1);
                                ?>
                                <select name="data_tarefa_hora" id="data_tarefa_hora" class="CampoDropDownMenu01">
                                    <!--option value="" selected="selected"></option-->
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHoraFill); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHoraFill[$countArray];?>"><?php echo $arrHoraFill[$countArray];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                                :
								<?php 
                                    $arrMinutoFill = Funcoes::HorarioFill01("m", 1);
                                ?>
                                <select name="data_tarefa_minuto" id="data_tarefa_minuto" class="CampoDropDownMenu01">
                                    <!--option value="" selected="selected"></option-->
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrMinutoFill); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrMinutoFill[$countArray];?>"><?php echo $arrMinutoFill[$countArray];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                
				<?php if($GLOBALS['habilitarTarefasDataFinal'] == 1){ ?>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaTarefasDataFinal"); ?>:
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
                                        //var strDatapickerAgendaPtCampos = "#data_tarefa";
										strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data_tarefa_final;";
                                    </script>
                                <?php } ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 2){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaEnCampos = "#data_tarefa";
										strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data_tarefa_final;";
                                    </script>
                                <?php } ?>
                                <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                            
                                <input type="text" name="data_tarefa_final" id="data_tarefa_final" class="CampoData01" maxlength="10" value="<?php echo $dataAtual; ?>" />
                                <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                            <?php } ?>
                            <?php //---------------------- ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
    
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaTarefas"); ?>
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div align="left">
                            <input type="text" name="tarefa" id="tarefa" class="CampoTexto01" />
                        </div>
                    </td>
                </tr>
                
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaTarefasDescricao"); ?>
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="descricao" id="descricao" class="CampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#descricao").cleditor(
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
                                <textarea name="descricao" id="descricao"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#descricao").cleditor(
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
                                <textarea name="descricao" id="descricao"></textarea>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                
				<?php if($GLOBALS['habilitarTarefasVinculo1'] == 1){ ?>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTarefasVinculo1Nome'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div class="Texto01">
                            <?php 
                                $arrTarefasVinculo1 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbTarefasVinculo1'], $GLOBALS['configIdTbTipoTarefasVinculo1'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoTarefasVinculo1'], $GLOBALS['configTarefasVinculo1Metodo']);
                            ?>
                            <select name="id_tb_cadastro1" id="id_tb_cadastro1" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNenhumDropDown"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrTarefasVinculo1); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrTarefasVinculo1[$countArray][0];?>"><?php echo $arrTarefasVinculo1[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarTarefasVinculo2'] == 1){ ?>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTarefasVinculo2Nome'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div class="Texto01">
                            <?php 
                                $arrTarefasVinculo2 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbTarefasVinculo2'], $GLOBALS['configIdTbTipoTarefasVinculo2'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoTarefasVinculo2'], $GLOBALS['configTarefasVinculo2Metodo']);
                            ?>
                            <select name="id_tb_cadastro2" id="id_tb_cadastro2" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNenhumDropDown"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrTarefasVinculo2); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrTarefasVinculo2[$countArray][0];?>"><?php echo $arrTarefasVinculo2[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarTarefasVinculo3'] == 1){ ?>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTarefasVinculo3Nome'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div class="Texto01">
                            <?php 
                                $arrTarefasVinculo3 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbTarefasVinculo3'], $GLOBALS['configIdTbTipoTarefasVinculo3'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoTarefasVinculo3'], $GLOBALS['configTarefasVinculo3Metodo']);
                            ?>
                            <select name="id_tb_cadastro3" id="id_tb_cadastro3" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNenhumDropDown"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrTarefasVinculo3); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrTarefasVinculo3[$countArray][0];?>"><?php echo $arrTarefasVinculo3[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
				<?php if($GLOBALS['habilitarTarefasIc1'] == 1){ ?>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloTarefasIc1'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configTarefasBoxIc1'] == 1){ ?>
                                <input type="text" name="informacao_complementar1" id="informacao_complementar1" class="CampoTexto01" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configTarefasBoxIc1'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar1" id="informacao_complementar1" class="CampoTextoMultilinha01"></textarea>
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
                                    <textarea name="informacao_complementar1" id="informacao_complementar1"></textarea>
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
                                    <textarea name="informacao_complementar1" id="informacao_complementar1"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarTarefasIc2'] == 1){ ?>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloTarefasIc2'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configTarefasBoxIc2'] == 1){ ?>
                                <input type="text" name="informacao_complementar2" id="informacao_complementar2" class="CampoTexto01" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configTarefasBoxIc2'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar2" id="informacao_complementar2" class="CampoTextoMultilinha01"></textarea>
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
                                    <textarea name="informacao_complementar2" id="informacao_complementar2"></textarea>
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
                                    <textarea name="informacao_complementar2" id="informacao_complementar2"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarTarefasIc3'] == 1){ ?>

                <tr>
                    <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloTarefasIc3'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configTarefasBoxIc3'] == 1){ ?>
                                <input type="text" name="informacao_complementar3" id="informacao_complementar3" class="CampoTexto01" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configTarefasBoxIc3'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar3" id="informacao_complementar3" class="CampoTextoMultilinha01"></textarea>
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
                                    <textarea name="informacao_complementar3" id="informacao_complementar3"></textarea>
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
                                    <textarea name="informacao_complementar3" id="informacao_complementar3"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarTarefasIc4'] == 1){ ?>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloTarefasIc4'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configTarefasBoxIc4'] == 1){ ?>
                                <input type="text" name="informacao_complementar4" id="informacao_complementar4" class="CampoTexto01" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configTarefasBoxIc4'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar4" id="informacao_complementar4" class="CampoTextoMultilinha01"></textarea>
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
                                    <textarea name="informacao_complementar4" id="informacao_complementar4"></textarea>
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
                                    <textarea name="informacao_complementar4" id="informacao_complementar4"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarTarefasIc5'] == 1){ ?>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloTarefasIc5'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configTarefasBoxIc5'] == 1){ ?>
                                <input type="text" name="informacao_complementar5" id="informacao_complementar5" class="CampoTexto01" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configTarefasBoxIc5'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar5" id="informacao_complementar5" class="CampoTextoMultilinha01"></textarea>
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
                                    <textarea name="informacao_complementar5" id="informacao_complementar5"></textarea>
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
                                    <textarea name="informacao_complementar5" id="informacao_complementar5"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
				<?php if($GLOBALS['habilitarTarefasUsuario'] == 1){ ?>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaTarefasCadastroUsuario"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div class="Texto01">
                            <?php 
                                $arrTarefasCadastroUsuario = DbFuncoes::VinculoGenericoSelect02("0", "", "tb_cadastro", "id_tb_categorias", "", "nome", 1);
                            ?>
                            <select name="id_tb_cadastro_usuario" id="id_tb_cadastro_usuario" class="CampoDropDownMenu01">
                                <option value="0" selected="selected"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNenhumDropDown"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrTarefasCadastroUsuario); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrTarefasCadastroUsuario[$countArray][0];?>"><?php echo $arrTarefasCadastroUsuario[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
				<?php if($GLOBALS['habilitarTarefasStatus'] == 1){ ?>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaTarefasStatus"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div class="Texto01">
                            <?php 
                                $arrTarefasStatus = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 9);
                            ?>
                            <select name="id_tb_tarefa_status" id="id_tb_tarefa_status" class="CampoDropDownMenu01">
                                <option value="0" selected="selected"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrTarefasStatus); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrTarefasStatus[$countArray][0];?>"><?php echo $arrTarefasStatus[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
				<?php if($GLOBALS['habilitarTarefasVinculoProcessos'] == 1){ ?>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaProcesso"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div class="Texto01">
                            <?php 
                                $arrTarefasProcessos = DbFuncoes::VinculoGenericoSelect02("0", "", "tb_processos", "id_parent", "processo", "processo", 1);
                            ?>
                            <select name="id_tb_processos" id="id_tb_processos" class="CampoDropDownMenu01">
                                <option value="0" selected="selected"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNenhumDropDown"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrTarefasProcessos); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrTarefasProcessos[$countArray][0];?>"><?php echo $arrTarefasProcessos[$countArray][1];?></option>
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
                <input name="ativacao" type="hidden" id="ativacao" value="1" />
                <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                <input name="masterPageSelect" type="hidden" id="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
            </div>
            <div style="float:right;">
                &nbsp;
            </div>
        </div>
    </form>
    <br />
    <?php } ?>
    
    
	<?php //Filtro/busca.?>
    <?php //**************************************************************************************?>
    <?php if($GLOBALS['habilitarBuscaTarefas'] == 1){ ?>
    <form name="formTarefasBusca" id="formTarefasBusca" action="TarefasIndice.php" method="get" class="FormularioTabela01">
        <div>
            <table class="TabelaCampos01">
            	<?php if($GLOBALS['habilitarBuscaTarefasFiltros'] == 1){ ?>
                <tr>
                    <td class="TbFundoEscuro" colspan="4">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBuscaTbPeriodo"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBuscaData"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div align="left">
                            <script type="text/javascript">
                                //Variável para conter todos os campos que funcionam com o DatePicker.
                                //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                //var strDatapickerAgendaPtCampos = "";
                                //var strDatapickerAgendaEnCampos = "";
                            </script>
                            <?php //JQuery DatePicker. ?>
                            <?php //---------------------- ?>
                            <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 1){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaPtCampos = "#data_tarefa";
                                        strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data_tarefa_pesquisa;";
                                    </script>
                                <?php } ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 2){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaEnCampos = "#data_tarefa";
                                        strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data_tarefa_pesquisa;";
                                    </script>
                                <?php } ?>
                                <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                            	
                                <input type="text" name="data_tarefa_pesquisa" id="data_tarefa_pesquisa" class="CampoData01" maxlength="10" value="<?php echo $dataTarefaPesquisa; ?>" />
                                <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                            <?php } ?>
                            <?php //---------------------- ?>
                        </div>
                    </td>
                    
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBuscaDataFinal"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div align="left">
                            <script type="text/javascript">
                                //Variável para conter todos os campos que funcionam com o DatePicker.
                                //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                //var strDatapickerAgendaPtCampos = "";
                                //var strDatapickerAgendaEnCampos = "";
                            </script>
                            <?php //JQuery DatePicker. ?>
                            <?php //---------------------- ?>
                            <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 1){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaPtCampos = "#data_tarefa";
                                        strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data_final_tarefa_pesquisa;";
                                    </script>
                                <?php } ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 2){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaEnCampos = "#data_tarefa";
                                        strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data_final_tarefa_pesquisa;";
                                    </script>
                                <?php } ?>
                                <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                            	
                                <input type="text" name="data_final_tarefa_pesquisa" id="data_final_tarefa_pesquisa" class="CampoData01" maxlength="10" value="<?php echo $dataFinalTarefaPesquisa; ?>" />
                                <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                            <?php } ?>
                            <?php //---------------------- ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
        <div align="center">
            <input type="image" name="submit" value="Submit" src="img/btoBuscar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoBusca"); ?>" />
            
            <input name="id_parent" type="hidden" id="id_parent" value="<?php echo $idParent; ?>" />
            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            <input name="masterPageSelect" type="hidden" id="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
        </div>
    </form>
    <?php } ?>
    <?php //**************************************************************************************?>


    <?php
	if (empty($resultadoTarefas))
	{
        //echo "Nenhum registro encontrado";
    ?>
        <div align="center" class="TextoErro">
            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
        </div>
    <?php
    }else{
    ?>
        <form name="formTarefasAcoes" id="formTarefasAcoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_tarefas" />
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
                <td width="50" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaTarefasData"); ?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaTarefas"); ?>
                    </div>
                </td>
                
                <td width="100" class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFuncoes"); ?>
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
                foreach($resultadoTarefas as $linhaTarefas)
                {
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php //echo $linhaTarefas['data_historico'];?>
                        <?php if($GLOBALS['habilitarTarefasDataHorario'] == 1){ ?>
							<?php echo Funcoes::DataLeitura01($linhaTarefas['data_tarefa'], $GLOBALS['configSistemaFormatoData'], "2"); ?>
                        <?php }else{ ?>
							<?php echo Funcoes::DataLeitura01($linhaTarefas['data_tarefa'], $GLOBALS['configSistemaFormatoData'], "1"); ?>
                        <?php } ?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
                    	<strong>
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaTarefas['tarefa']);?>
                        </strong>
                    </div>
                    <div class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($linhaTarefas['descricao']);?>
                    </div>
                    
                    <?php if($GLOBALS['habilitarTarefasVinculoProcessos'] == 1){ ?>
						<?php
						$idTbTarefasProcessos = DbFuncoes::GetCampoGenerico04("tb_itens_relacao_registros", "id_registro", "id_item", $linhaTarefas['id'], "", "", 1);
						?>
						<?php if(!empty($idTbTarefasProcessos)){ ?>
                        <div class="Texto01">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaProcesso"); ?>: 
                            </strong>
                            <a href="ProcessosEditar.php?idTbProcessos=<?php echo DbFuncoes::GetCampoGenerico01($idTbTarefasProcessos, "tb_processos", "id"); ?>" target="_blank" class="Links01">
                                <?php echo Funcoes::ConteudoMascaraLeitura(DbFuncoes::GetCampoGenerico01($idTbTarefasProcessos, "tb_processos", "processo")); ?>
                            </a>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    <?php //if(empty($idParent)){ ?>
                    <?php if($idParent == ""){ ?>
						<?php //if(!empty(DbFuncoes::GetCampoGenerico01($linhaTarefas['id_parent'], "tb_cadastro", "id"))){ ?>
						<?php if(DbFuncoes::GetCampoGenerico01($linhaTarefas['id_parent'], "tb_cadastro", "id") <> ""){ ?>
                            <div class="Texto01">
                                <strong>
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaTarefasCadastroVinculado"); ?>: 
                                </strong>
                                <a href="CadastroAdministrar.php?idTbCadastro=<?php echo $linhaTarefas['id_parent']; /*$idParent;*/?>&masterPageSelect=LayoutSistemaSemMenu.php" target="_blank" class="Links01">
                                    <?php //echo Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaTarefas['id_parent'], "tb_cadastro", "nome"); ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaTarefas['id_parent'], "tb_cadastro", "nome"), 
									DbFuncoes::GetCampoGenerico01($linhaTarefas['id_parent'], "tb_cadastro", "razao_social"), 
									DbFuncoes::GetCampoGenerico01($linhaTarefas['id_parent'], "tb_cadastro", "nome_fantasia"), 
									1)); ?>
                                </a>
                            </div>
						<?php } ?>
                     <?php } ?>
                     
					<?php if($GLOBALS['habilitarTarefasVinculo1'] == 1){ ?>
                        <?php //if($linhaTarefas['id_tb_cadastro1'] <> 0){ ?>
                        <div class="Texto01">
                            <strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTarefasVinculo1Nome'], "IncludeConfig"); ?>: 
                            </strong>
                            <a href="CadastroAdministrar.php?idTbCadastro=<?php echo $linhaTarefas['id_tb_cadastro1'];?>&masterPageSelect=LayoutSistemaSemMenu.php" target="_blank" class="Links01">
                                <?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaTarefas['id_tb_cadastro1'], "tb_cadastro", "nome"), 
                                DbFuncoes::GetCampoGenerico01($linhaTarefas['id_tb_cadastro1'], "tb_cadastro", "razao_social"), 
                                DbFuncoes::GetCampoGenerico01($linhaTarefas['id_tb_cadastro1'], "tb_cadastro", "nome_fantasia"), 
                                1)); ?>
                            </a>
                        </div>
                        <?php //} ?>
                    <?php } ?>
                    <?php if($GLOBALS['habilitarTarefasVinculo2'] == 1){ ?>
                        <?php //if($linhaTarefas['id_tb_cadastro2'] <> 0){ ?>
                        <div class="Texto01">
                            <strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTarefasVinculo2Nome'], "IncludeConfig"); ?>: 
                            </strong>
                            <a href="CadastroAdministrar.php?idTbCadastro=<?php echo $linhaTarefas['id_tb_cadastro2'];?>&masterPageSelect=LayoutSistemaSemMenu.php" target="_blank" class="Links01">
                                <?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaTarefas['id_tb_cadastro2'], "tb_cadastro", "nome"), 
                                DbFuncoes::GetCampoGenerico01($linhaTarefas['id_tb_cadastro2'], "tb_cadastro", "razao_social"), 
                                DbFuncoes::GetCampoGenerico01($linhaTarefas['id_tb_cadastro2'], "tb_cadastro", "nome_fantasia"), 
                                1)); ?>
                            </a>
                        </div>
                        <?php //} ?>
                    <?php } ?>
                    <?php if($GLOBALS['habilitarTarefasVinculo3'] == 1){ ?>
                        <?php //if($linhaTarefas['id_tb_cadastro3'] <> 0){ ?>
                        <div class="Texto01">
                            <strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTarefasVinculo3Nome'], "IncludeConfig"); ?>: 
                            </strong>
                            <a href="CadastroAdministrar.php?idTbCadastro=<?php echo $linhaTarefas['id_tb_cadastro3'];?>&masterPageSelect=LayoutSistemaSemMenu.php" target="_blank" class="Links01">
                                <?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaTarefas['id_tb_cadastro3'], "tb_cadastro", "nome"), 
                                DbFuncoes::GetCampoGenerico01($linhaTarefas['id_tb_cadastro3'], "tb_cadastro", "razao_social"), 
                                DbFuncoes::GetCampoGenerico01($linhaTarefas['id_tb_cadastro3'], "tb_cadastro", "nome_fantasia"), 
                                1)); ?>
                            </a>
                        </div>
                        <?php //} ?>
                    <?php } ?>  
                </td>
                
                <td class="TabelaDados01Celula">
                	<div align="center" class="Texto01">
                        <a href="../<?php echo $GLOBALS['visualizacaoAtivaSistema'];?>/SiteTarefasDetalhes.aspx?idTbProcessos=<?php echo $linhaTarefas['id'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemVisualizacao"); ?>
                        </a>
                    </div>
                    <div align="center" class="Texto01">
                    	<?php if($GLOBALS['habilitarTarefasLembreteEnvio'] == 1){ ?>
                            <a href="RegistrosEnvioExe.php?idRegistro=<?php echo $linhaTarefas['id'];?>&strTabela=tb_tarefas&tipoCategoria=71&idTbCadastroDestinatario=<?php echo $linhaTarefas['id_parent'];?><?php echo $queryPadrao;?>" class="Links01">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaTarefasLembreteEnvio"); ?>
                            </a>
                            <div>
                                (<?php 
                                echo DbFuncoes::CountRegistrosGenericos("tb_itens_enviados", 
                                "id_item", 
                                $linhaTarefas['id'], 
                                "tipo_interatividade", 
                                1, 
                                "id_tb_cadastro_remetente", 
                                0, 
                                "id_tb_cadastro_destinatario", 
                                $linhaTarefas['id_parent']);
                                ?>)
                            </div>
                        <?php } ?>
                    </div>
                    
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="TarefasEditar.php?idTbTarefas=<?php echo $linhaTarefas['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaTarefas['id'];?>" class="CampoCheckBox01" />
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
unset($strSqlTarefasSelect);
unset($statementTarefasSelect);
unset($resultadoTarefas);
unset($linhaTarefas);
//----------
?>


<?php 
//Inclusão do template do layout.
include_once $page->LayoutSistema;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>