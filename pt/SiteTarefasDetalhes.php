<?php
//Importação dos arquivos de configuração.
require_once "../sistema/IncludeConfig.php"; //Deve vir antes do db.
require_once "../sistema/IncludeConexao.php";
require_once "../sistema/IncludeFuncoes.php";
//require_once "IncludeLayout.php";
require_once "IncludeLayoutSite.php";


//Resgate de variáveis.
$idTbTarefas = $_GET["idTbTarefas"];

$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];


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
		$tbTarefasDataTarefa = Funcoes::DataLeitura01($linhaTarefasDetalhes['data_tarefa'], $GLOBALS['configSistemaFormatoData'], "1");
		$tbTarefasDataTarefaFinal = Funcoes::DataLeitura01($linhaTarefasDetalhes['data_tarefa_final'], $GLOBALS['configSistemaFormatoData'], "1");
		$tbTarefasIdTbCadastroUsuario = $linhaTarefasDetalhes['id_tb_cadastro_usuario'];
		$tbTarefasTarefa = Funcoes::ConteudoMascaraLeitura($linhaTarefasDetalhes['tarefa']);
		$tbTarefasDescricao = Funcoes::ConteudoMascaraLeitura($linhaTarefasDetalhes['descricao']);
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
	<?php echo htmlentities($GLOBALS['configTituloSite']); ?> - <?php echo $tbTarefasTarefa; ?>
<?php 
$pageSite->cphTitle = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Head.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphHead*/ ?>
    <meta name="description" content="" /><?php //Abaixo de 160 caracteres.?>
    <meta name="keywords" content="" /><?php //Abaixo de 100 caracteres.?>
    <meta name="title" content="" /><?php //Abaixo de 60 caracteres.?>
<?php 
$pageSite->cphHead = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Título atual.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphConteudoCabecalho*/ ?>
	<?php echo $tbTarefasTarefa; ?>
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
    
    <div align="center">
        <table class="AdmTabelaCampos01">
            <tr>
                <td class="AdmTbFundoEscuro" colspan="4">
                    <div align="center" class="AdmTexto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteTarefasTbTarefasDetalhes"); ?>
                        </strong>
                    </div>
                </td>
            </tr>
            
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaTarefasData"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbTarefasDataTarefa; ?>
                    </div>
                </td>
            </tr>
            
            <?php if($GLOBALS['habilitarTarefasDataFinal'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaTarefasDataFinal"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbTarefasDataTarefaFinal; ?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaTarefas"); ?>
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbTarefasTarefa; ?>
                    </div>
                </td>
            </tr>
            
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaTarefasDescricao"); ?>
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbTarefasDescricao; ?>
                    </div>
                </td>
            </tr>
            
            <?php if($GLOBALS['habilitarTarefasIc1'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloTarefasIc1']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbTarefasIC1; ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarTarefasIc2'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloTarefasIc2']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbTarefasIC2; ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarTarefasIc3'] == 1){ ?>

            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloTarefasIc3']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbTarefasIC3; ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarTarefasIc4'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloTarefasIc4']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbTarefasIC4; ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarTarefasIc5'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloTarefasIc5']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbTarefasIC5; ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarTarefasUsuario'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaTarefasCadastroUsuario"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php if(DbFuncoes::GetCampoGenerico01($tbTarefasIdParent, "tb_cadastro", "id") <> ""){ ?>
                            <a href="SiteAdmCadastroAdministrar.php?idTbCadastro=<?php echo $tbTarefasIdParent;?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
                                <?php //echo Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaTarefas['id_parent'], "tb_cadastro", "nome"); ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($tbTarefasIdParent, "tb_cadastro", "nome"), DbFuncoes::GetCampoGenerico01($tbTarefasIdParent, "tb_cadastro", "razao_social"), DbFuncoes::GetCampoGenerico01($tbTarefasIdParent, "tb_cadastro", "nome_fantasia"), 1)); ?>
                            </a>
						<?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarTarefasStatus'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaTarefasStatus"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo DbFuncoes::GetCampoGenerico01($tbTarefasIdTbTarefaStatus, "tb_cadastro_complemento", "complemento"); ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarTarefasVinculoProcessos'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaProcesso"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
						$idTbTarefasProcessos = DbFuncoes::GetCampoGenerico04("tb_itens_relacao_registros", "id_registro", "id_item", $tbTarefasId, "", "", 1);
                        ?>
                            <?php if(!empty($idTbTarefasProcessos)){ ?>
                            <a href="SiteProcessosDetalhes.php?idTbProcessos=<?php echo DbFuncoes::GetCampoGenerico01($idTbTarefasProcessos, "tb_processos", "id"); ?>" target="_blank" class="AdmLinks01">
                                <?php echo Funcoes::ConteudoMascaraLeitura(DbFuncoes::GetCampoGenerico01($idTbTarefasProcessos, "tb_processos", "processo")); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
<?php 
$pageSite->cphConteudoPrincipal = ob_get_clean(); 
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


//Inclusão do template do layout.
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>