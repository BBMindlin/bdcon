<?php
//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeLayout.php";


//Verificação de login Master.
LoginAutenticacao::UsuarioLoginVerificacao();


//Resgate de variáveis.
$idTbTarefas = $_GET["idTbTarefas"];
$idParent = DbFuncoes::GetCampoGenerico01($idTbTarefas, "tb_tarefas", "id_parent");

$paginaRetorno = "TarefasIndice.php";
$paginaRetornoExclusao = "TarefasEditar.php";
$variavelRetorno = "idTbTarefas";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];


//Montagem de query padrão de retorno.
$queryPadrao = "&idTbCadastroUsuario=" . $idTbCadastroUsuario . 
"&paginaRetorno=" . $paginaRetorno . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&masterPageSelect=" . $masterPageSelect . 
"&variavelRetorno=" . $variavelRetorno;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Query de pesquisa.
//----------
$strSqlTarefasDetalhesSelect = "";
$strSqlTarefasDetalhesSelect .= "SELECT ";
//$strSqlTarefasDetalhesSelect .= "* ";
$strSqlTarefasDetalhesSelect .= "id, ";
$strSqlTarefasDetalhesSelect .= "id_parent, ";
$strSqlTarefasDetalhesSelect .= "data_registro_tarefa, ";
$strSqlTarefasDetalhesSelect .= "data_tarefa, ";
$strSqlTarefasDetalhesSelect .= "data_tarefa_final, ";
$strSqlTarefasDetalhesSelect .= "id_tb_cadastro_usuario, ";
$strSqlTarefasDetalhesSelect .= "tarefa, ";
$strSqlTarefasDetalhesSelect .= "descricao, ";
$strSqlTarefasDetalhesSelect .= "id_tb_cadastro1, ";
$strSqlTarefasDetalhesSelect .= "id_tb_cadastro2, ";
$strSqlTarefasDetalhesSelect .= "id_tb_cadastro3, ";
$strSqlTarefasDetalhesSelect .= "informacao_complementar1, ";
$strSqlTarefasDetalhesSelect .= "informacao_complementar2, ";
$strSqlTarefasDetalhesSelect .= "informacao_complementar3, ";
$strSqlTarefasDetalhesSelect .= "informacao_complementar4, ";
$strSqlTarefasDetalhesSelect .= "informacao_complementar5, ";
$strSqlTarefasDetalhesSelect .= "id_tb_tarefa_status, ";
$strSqlTarefasDetalhesSelect .= "ativacao ";
$strSqlTarefasDetalhesSelect .= "FROM tb_tarefas ";
$strSqlTarefasDetalhesSelect .= "WHERE id <> 0 ";
//$strSqlTarefasDetalhesSelect .= "AND id_tb_categorias = :id_tb_categorias ";
$strSqlTarefasDetalhesSelect .= "AND id = :id ";
//$strSqlTarefasDetalhesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";


$statementTarefasDetalhesSelect = $dbSistemaConPDO->prepare($strSqlTarefasDetalhesSelect);

if ($statementTarefasDetalhesSelect !== false)
{
	$statementTarefasDetalhesSelect->execute(array(
		"id" => $idTbTarefas
	));
}

//$resultadoTarefasDetalhes = $dbSistemaConPDO->query($strSqlTarefasDetalhesSelect);
$resultadoTarefasDetalhes = $statementTarefasDetalhesSelect->fetchAll();

if (empty($resultadoTarefasDetalhes))
{
	//echo "Nenhum registro encontrado";
}else{
	foreach($resultadoTarefasDetalhes as $linhaTarefasDetalhes)
	{
		//Definição das variáveis de detalhes.
		$tbTarefasId = $linhaTarefasDetalhes['id'];
		$tbTarefasIdParent = $linhaTarefasDetalhes['id_parent'];
		$tbTarefasDataRegistroTarefa = Funcoes::DataLeitura01($linhaTarefasDetalhes['data_registro_tarefa'], $GLOBALS['configSistemaFormatoData'], "1");
		
		$tbTarefasDataTarefa = $linhaTarefasDetalhes['data_tarefa'];
		$tbTarefasDataTarefa_print = Funcoes::DataLeitura01($tbTarefasDataTarefa, $GLOBALS['configSistemaFormatoData'], "1");
		$tbTarefasDataTarefaHora = date("H",strtotime($tbTarefasDataTarefa));
		$tbTarefasDataTarefaMinuto = date("i",strtotime($tbTarefasDataTarefa));
		
		$tbTarefasDataTarefaFinal = Funcoes::DataLeitura01($linhaTarefasDetalhes['data_tarefa_final'], $GLOBALS['configSistemaFormatoData'], "1");
		$tbTarefasIdTbCadastroUsuario = $linhaTarefasDetalhes['id_tb_cadastro_usuario'];
		$tbTarefasTarefa = Funcoes::ConteudoMascaraLeitura($linhaTarefasDetalhes['tarefa']);
		$tbTarefasDescricao = Funcoes::ConteudoMascaraLeitura($linhaTarefasDetalhes['descricao']);
		
		$tbTarefasIdTbCadastro1 = $linhaTarefasDetalhes['id_tb_cadastro1'];
		$tbTarefasIdTbCadastro2 = $linhaTarefasDetalhes['id_tb_cadastro2'];
		$tbTarefasIdTbCadastro3 = $linhaTarefasDetalhes['id_tb_cadastro3'];

		$tbTarefasIC1 = Funcoes::ConteudoMascaraLeitura($linhaTarefasDetalhes['informacao_complementar1']);
		$tbTarefasIC2 = Funcoes::ConteudoMascaraLeitura($linhaTarefasDetalhes['informacao_complementar2']);
		$tbTarefasIC3 = Funcoes::ConteudoMascaraLeitura($linhaTarefasDetalhes['informacao_complementar3']);
		$tbTarefasIC4 = Funcoes::ConteudoMascaraLeitura($linhaTarefasDetalhes['informacao_complementar4']);
		$tbTarefasIC5 = Funcoes::ConteudoMascaraLeitura($linhaTarefasDetalhes['informacao_complementar5']);
		$tbTarefasIdTbTarefaStatus = $linhaTarefasDetalhes['id_tb_tarefa_status'];
		$tbTarefasAtivacao = Funcoes::ConteudoMascaraLeitura($linhaTarefasDetalhes['ativacao']);
		
		$tbTarefasIdTbTarefasProcessos = DbFuncoes::GetCampoGenerico04("tb_itens_relacao_registros", "id_registro", "id_item", $tbTarefasId, "", "", 1);
		//Verificação de erro.
		//echo "tbTarefasId=" . $tbTarefasId . "<br>";
		//echo "tbTarefasAssunto=" . $tbTarefasAssunto . "<br>";
		//echo "tbPaginasAtivacao=" . $tbPaginasAtivacao . "<br>";
	}
}
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistema"); ?>
     - 
	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configNomeCliente'], "IncludeConfig"); ?>
     - 
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaTarefasEditarTitulo"); ?>
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
            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaTarefasEditarTitulo"); ?>
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
    
    <form name="formTarefasEditar" id="formTarefasEditar" action="TarefasEditarExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <div>
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="4">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaTarefasTbTarefasEditar"); ?>
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
                                var strDatapickerAgendaPtCampos = "";
                                var strDatapickerAgendaEnCampos = "";
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
                            
                                <input type="text" name="data_tarefa" id="data_tarefa" class="CampoData01" maxlength="10" value="<?php echo $tbTarefasDataTarefa_print; ?>" />
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
                                        <option value="<?php echo $arrHoraFill[$countArray];?>"
										<?php if($tbTarefasDataTarefaHora == $arrHoraFill[$countArray]){ ?> selected="selected"<?php } ?>
                                        ><?php echo $arrHoraFill[$countArray];?></option>
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
                                        <option value="<?php echo $arrMinutoFill[$countArray];?>"
                                        <?php if($tbTarefasDataTarefaMinuto == $arrMinutoFill[$countArray]){ ?> selected="selected"<?php } ?>
                                        ><?php echo $arrMinutoFill[$countArray];?></option>
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
                            
                                <input type="text" name="data_tarefa_final" id="data_tarefa_final" class="CampoData01" maxlength="10" value="<?php echo $tbTarefasDataTarefaFinal; ?>" />
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
                            <input type="text" name="tarefa" id="tarefa" class="CampoTexto01" value="<?php echo $tbTarefasTarefa; ?>" />
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
                                <textarea name="descricao" id="descricao" class="CampoTextoMultilinha01"><?php echo $tbTarefasDescricao; ?></textarea>
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
                                <textarea name="descricao" id="descricao"><?php echo $tbTarefasDescricao; ?></textarea>
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
                                <textarea name="descricao" id="descricao"><?php echo $tbTarefasDescricao; ?></textarea>
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
                                <option value="0"<?php if($tbTarefasIdTbCadastro1 == 0){ ?>selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNenhumDropDown"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrTarefasVinculo1); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrTarefasVinculo1[$countArray][0];?>"<?php if($arrTarefasVinculo1[$countArray][0] == $tbTarefasIdTbCadastro1){ ?> selected="selected"<?php } ?>><?php echo $arrTarefasVinculo1[$countArray][1];?></option>
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
                                <option value="0"<?php if($tbTarefasIdTbCadastro2 == 0){ ?>selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNenhumDropDown"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrTarefasVinculo2); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrTarefasVinculo2[$countArray][0];?>"<?php if($arrTarefasVinculo2[$countArray][0] == $tbTarefasIdTbCadastro2){ ?> selected="selected"<?php } ?>><?php echo $arrTarefasVinculo2[$countArray][1];?></option>
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
                                <option value="0"<?php if($tbTarefasIdTbCadastro3 == 0){ ?>selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNenhumDropDown"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrTarefasVinculo3); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrTarefasVinculo3[$countArray][0];?>"<?php if($arrTarefasVinculo3[$countArray][0] == $tbTarefasIdTbCadastro3){ ?> selected="selected"<?php } ?>><?php echo $arrTarefasVinculo3[$countArray][1];?></option>
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
                                <input type="text" name="informacao_complementar1" id="informacao_complementar1" class="CampoTexto01" maxlength="255" value="<?php echo $tbTarefasIC1; ?>" />
                            <?php } ?>
                            <?php if($GLOBALS['configTarefasBoxIc1'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar1" id="informacao_complementar1" class="CampoTextoMultilinha01"><?php echo $tbTarefasIC1; ?></textarea>
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
                                    <textarea name="informacao_complementar1" id="informacao_complementar1"><?php echo $tbTarefasIC1; ?></textarea>
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
                                    <textarea name="informacao_complementar1" id="informacao_complementar1"><?php echo $tbTarefasIC1; ?></textarea>
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
                                <input type="text" name="informacao_complementar2" id="informacao_complementar2" class="CampoTexto01" maxlength="255" value="<?php echo $tbTarefasIC2; ?>" />
                            <?php } ?>
                            <?php if($GLOBALS['configTarefasBoxIc2'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar2" id="informacao_complementar2" class="CampoTextoMultilinha01"><?php echo $tbTarefasIC2; ?></textarea>
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
                                    <textarea name="informacao_complementar2" id="informacao_complementar2"><?php echo $tbTarefasIC2; ?></textarea>
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
                                    <textarea name="informacao_complementar2" id="informacao_complementar2"><?php echo $tbTarefasIC2; ?></textarea>
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
                                <input type="text" name="informacao_complementar3" id="informacao_complementar3" class="CampoTexto01" maxlength="255" value="<?php echo $tbTarefasIC3; ?>" />
                            <?php } ?>
                            <?php if($GLOBALS['configTarefasBoxIc3'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar3" id="informacao_complementar3" class="CampoTextoMultilinha01"><?php echo $tbTarefasIC3; ?></textarea>
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
                                    <textarea name="informacao_complementar3" id="informacao_complementar3"><?php echo $tbTarefasIC3; ?></textarea>
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
                                    <textarea name="informacao_complementar3" id="informacao_complementar3"><?php echo $tbTarefasIC3; ?></textarea>
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
                                <input type="text" name="informacao_complementar4" id="informacao_complementar4" class="CampoTexto01" maxlength="255" value="<?php echo $tbTarefasIC4; ?>" />
                            <?php } ?>
                            <?php if($GLOBALS['configTarefasBoxIc4'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar4" id="informacao_complementar4" class="CampoTextoMultilinha01"><?php echo $tbTarefasIC4; ?></textarea>
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
                                    <textarea name="informacao_complementar4" id="informacao_complementar4"><?php echo $tbTarefasIC4; ?></textarea>
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
                                    <textarea name="informacao_complementar4" id="informacao_complementar4"><?php echo $tbTarefasIC4; ?></textarea>
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
                                <input type="text" name="informacao_complementar5" id="informacao_complementar5" class="CampoTexto01" maxlength="255" value="<?php echo $tbTarefasIC5; ?>" />
                            <?php } ?>
                            <?php if($GLOBALS['configTarefasBoxIc5'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar5" id="informacao_complementar5" class="CampoTextoMultilinha01"><?php echo $tbTarefasIC5; ?></textarea>
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
                                    <textarea name="informacao_complementar5" id="informacao_complementar5"><?php echo $tbTarefasIC5; ?></textarea>
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
                                    <textarea name="informacao_complementar5" id="informacao_complementar5"><?php echo $tbTarefasIC5; ?></textarea>
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
                                <option value="0"<?php if($tbTarefasIdTbCadastroUsuario == 0){ ?>selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNenhumDropDown"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrTarefasCadastroUsuario); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrTarefasCadastroUsuario[$countArray][0];?>"<?php if($arrTarefasCadastroUsuario[$countArray][0] == $tbTarefasIdTbCadastroUsuario){ ?> selected="selected"<?php } ?>><?php echo $arrTarefasCadastroUsuario[$countArray][1];?></option>
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
                                <option value="0"<?php if($tbTarefasIdTbTarefaStatus == 0){ ?>selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrTarefasStatus); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrTarefasStatus[$countArray][0];?>"<?php if($arrTarefasStatus[$countArray][0] == $tbTarefasIdTbTarefaStatus){ ?> selected="selected"<?php } ?>><?php echo $arrTarefasStatus[$countArray][1];?></option>
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
                                    <option value="<?php echo $arrTarefasProcessos[$countArray][0];?>"<?php if($arrTarefasProcessos[$countArray][0] == $tbTarefasIdTbTarefasProcessos){ ?> selected="selected"<?php } ?>><?php echo $arrTarefasProcessos[$countArray][1];?></option>
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
                <input type="image" name="submit" value="Submit" src="img/btoAtualizar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoAtualizar"); ?>" />
                
                <input name="idTbTarefas" type="hidden" id="idTbTarefas" value="<?php echo $idTbTarefas; ?>" />
                <input name="id_parent" type="hidden" id="id_parent" value="<?php echo $tbTarefasIdParent; ?>" />
                <input name="ativacao" type="hidden" id="ativacao" value="<?php echo $tbTarefasAtivacao; ?>" />
                <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                <input name="masterPageSelect" type="hidden" id="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
            </div>
            <div style="float:right;">
                <a href="<?php echo $paginaRetorno; ?>?idParent=<?php echo $idParent; ?><?php echo $queryPadrao; ?>">
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
unset($strSqlTarefasDetalhesSelect);
unset($statementTarefasDetalhesSelect);
unset($resultadoTarefasDetalhes);
unset($linhaTarefasDetalhes);
//----------
?>


<?php 
//Inclusão do template do layout.
include_once $page->LayoutSistema;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>