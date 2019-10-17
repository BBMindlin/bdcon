<?php
//Importação dos arquivos de configuração.
require_once "../sistema/IncludeConfig.php"; //Deve vir antes do db.
require_once "../sistema/IncludeConexao.php";
require_once "../sistema/IncludeFuncoes.php";
//require_once "IncludeLayout.php";
require_once "IncludeLayoutSite.php";


//Resgate de variáveis.
$idParentTarefas = $_GET["idParentTarefas"];

$idTbCadastro1 = $_GET["idTbCadastro1"];
$idTbTarefaStatus = $_GET["idTbTarefaStatus"];

$palavraChave = $_GET["palavraChave"];
$dataTarefaPesquisa = $_GET["data_tarefa_pesquisa"];
$dataFinalTarefaPesquisa = $_GET["data_final_tarefa_pesquisa"];

$tituloLinkAtual = "";
$metaTitulo = "";
$metaDescricao = "";
$metaPalavrasChave = "";

$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];


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
//if(!empty($idParentTarefas))
if($idParentTarefas <> "")
{
	$strSqlTarefasSelect .= "AND id_parent = :id_parent ";
}
if($idTbCadastro1 <> "")
{
	$strSqlTarefasSelect .= "AND id_tb_cadastro1 = :id_tb_cadastro1 ";
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


$statementTarefasSelect = $dbSistemaConPDO->prepare($strSqlTarefasSelect);

if ($statementTarefasSelect !== false)
{
	if($idParentTarefas <> "")
	{
		$statementTarefasSelect->bindParam(':id_parent', $idParentTarefas, PDO::PARAM_STR);
	}
	if($idTbCadastro1 <> "")
	{
		$statementTarefasSelect->bindParam(':id_tb_cadastro1', $idTbCadastro1, PDO::PARAM_STR);
	}
	if($idTbTarefaStatus <> "")
	{
		$statementTarefasSelect->bindParam(':id_tb_tarefa_status', $idTbTarefaStatus, PDO::PARAM_STR);
	}
	$statementTarefasSelect->execute();

	/*	
	$statementTarefasSelect->execute(array(
		"id_parent" => $idParentTarefas
	));
	*/
}

//$resultadoTarefas = $dbSistemaConPDO->query($strSqlTarefasSelect);
$resultadoTarefas = $statementTarefasSelect->fetchAll();


//Definição de variáveis.
if($idParentCadastro <> ""){
	$tituloLinkAtual = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteTarefasTitulo");
}
if($palavraChave <> ""){
	$tituloLinkAtual = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaResultados");
}
$metaTitulo = $tituloLinkAtual . " - " . Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloSite'], "IncludeConfig");


//Verificação de erro - debug.
//echo "cookie=" . $_COOKIE[$GLOBALS['configNomeCookie'] . "_" . $GLOBALS['configSessionNomeUsuarioMaster']] . "<br>";
//echo "cookie(decrypt)=" . $tbUsuariosSenha = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura($_COOKIE[$GLOBALS['configNomeCookie'] . "_" . $GLOBALS['configSessionNomeUsuarioMaster']], 2), 2) . "<br>";
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloSite'], "IncludeConfig"); ?> - <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteTarefasTitulo"); ?>
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
	<?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteTarefasTitulo"); ?>
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
    
	<?php //Cadastro - Detalhes.?>
    <?php //----------------------?>
    <?php 
	//Definição de variáveis do include.
	//$includePaginas_idParentPaginas = $tbCadastroId;
	$includeCadastroDetalhes_idTbCadastro = $idParentTarefas;
	$includeCadastro_configTipoDiagramacao = "1";
	?>
    
    <?php include "IncludeCadastroDetalhes.php";?>
    <?php //----------------------?>
    
    <?php
	if (empty($resultadoTarefas))
	{
        //echo "Nenhum registro encontrado";
    ?>
        <div align="center" class="AdmAlerta">
            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteMensagemTareafsVazio"); ?>
        </div>
    <?php
    }else{
    ?>

            <table width="100%" class="AdmTabelaDados01">
              <tr class="AdmTbFundoEscuro">
                <td width="50">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteTarefasData"); ?>
                    </div>
                </td>
                
                <td>
                    <div class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteTarefas"); ?>
                    </div>
                </td>
                
                <?php if($GLOBALS['habilitarTarefasVinculoProcessos'] == 1){ ?>
                <td width="200">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProcesso"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarTarefasStatus'] == 1){ ?>
                <td width="100">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteTarefasStatus"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <td width="100">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFuncoes"); ?>
                    </div>
                </td>
                
              </tr>
              <?php
				$countTabelaFundo = 0;
				
                //Loop pelos resultados.
                foreach($resultadoTarefas as $linhaTarefas)
                {
              ?>
              <tr class="<?php if($countTabelaFundo == 0){ ?>AdmTbFundoClaro<?php }else{?>AdmTbFundoAlternativo<?php } ?>">
                <td>
                    <div align="center" class="AdmTexto01">
                        <?php //echo $linhaTarefas['data_historico'];?>
                        <?php echo Funcoes::DataLeitura01($linhaTarefas['data_tarefa'], $GLOBALS['configSistemaFormatoData'], "2"); ?>
                    </div>
                </td>
                
                <td>
                    <div class="AdmTexto01">
                    	<strong>
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaTarefas['tarefa']);?>
                        </strong>
                    </div>
                    <div class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($linhaTarefas['descricao']);?>
                    </div>
                    
                    <?php if(empty($idParentTarefas)){ ?>
                    <?php //if($idParent == ""){ ?>
						<?php //if(!empty(DbFuncoes::GetCampoGenerico01($linhaTarefas['id_parent'], "tb_cadastro", "id"))){ ?>
						<?php if(DbFuncoes::GetCampoGenerico01($linhaTarefas['id_parent'], "tb_cadastro", "id") <> ""){ ?>
                            <div class="AdmTexto01">
                                <strong>
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaTarefasCadastroVinculado"); ?>: 
                                </strong>
                                <a href="SiteAdmCadastroAdministrar.php?idTbCadastro=<?php echo $linhaTarefas['id_parent'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
                                    <?php //echo Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaTarefas['id_parent'], "tb_cadastro", "nome"); ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaTarefas['id_parent'], "tb_cadastro", "nome"), 
									DbFuncoes::GetCampoGenerico01($linhaTarefas['id_parent'], "tb_cadastro", "razao_social"), 
									DbFuncoes::GetCampoGenerico01($linhaTarefas['id_parent'], "tb_cadastro", "nome_fantasia"), 
									1)); ?>
                                </a>
                            </div>
						<?php } ?>
                     <?php } ?>
                     
					<?php if($GLOBALS['habilitarTarefasUsuario'] == 1){ ?>
                        <?php if($idTbCadastroUsuario == ""){ ?>
                        <div class="AdmTexto01">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteTarefasCadastroUsuario"); ?>: 
                            </strong>
                            <a href="SiteAdmCadastroAdministrar.php?idTbCadastro=<?php echo $linhaTarefas['id_tb_cadastro_usuario'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
                                <?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaTarefas['id_tb_cadastro1'], "tb_cadastro", "nome"), 
                                DbFuncoes::GetCampoGenerico01($linhaTarefas['id_tb_cadastro_usuario'], "tb_cadastro", "razao_social"), 
                                DbFuncoes::GetCampoGenerico01($linhaTarefas['id_tb_cadastro_usuario'], "tb_cadastro", "nome_fantasia"), 
                                1)); ?>
                            </a>
                        </div>
                        <?php } ?>
                    <?php } ?>
                     
					<?php if($GLOBALS['habilitarTarefasVinculo1'] == 1){ ?>
                        <?php if($idTbCadastro1 == ""){ ?>
                        <div class="AdmTexto01">
                            <strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTarefasVinculo1Nome'], "IncludeConfig"); ?>: 
                            </strong>
                            <a href="SiteAdmCadastroAdministrar.php?idTbCadastro=<?php echo $linhaTarefas['id_tb_cadastro1'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
                                <?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaTarefas['id_tb_cadastro1'], "tb_cadastro", "nome"), 
                                DbFuncoes::GetCampoGenerico01($linhaTarefas['id_tb_cadastro1'], "tb_cadastro", "razao_social"), 
                                DbFuncoes::GetCampoGenerico01($linhaTarefas['id_tb_cadastro1'], "tb_cadastro", "nome_fantasia"), 
                                1)); ?>
                            </a>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    <?php if($GLOBALS['habilitarTarefasVinculo2'] == 1){ ?>
                        <?php //if($linhaTarefas['id_tb_cadastro2'] <> 0){ ?>
                        <div class="AdmTexto01">
                            <strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTarefasVinculo2Nome'], "IncludeConfig"); ?>: 
                            </strong>
                            <a href="SiteAdmCadastroAdministrar.php?idTbCadastro=<?php echo $linhaTarefas['id_tb_cadastro2'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
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
                        <div class="AdmTexto01">
                            <strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTarefasVinculo3Nome'], "IncludeConfig"); ?>: 
                            </strong>
                            <a href="SiteAdmCadastroAdministrar.php?idTbCadastro=<?php echo $linhaTarefas['id_tb_cadastro3'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
                                <?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaTarefas['id_tb_cadastro3'], "tb_cadastro", "nome"), 
                                DbFuncoes::GetCampoGenerico01($linhaTarefas['id_tb_cadastro3'], "tb_cadastro", "razao_social"), 
                                DbFuncoes::GetCampoGenerico01($linhaTarefas['id_tb_cadastro3'], "tb_cadastro", "nome_fantasia"), 
                                1)); ?>
                            </a>
                        </div>
                        <?php //} ?>
                    <?php } ?>  
                </td>
                
                <?php if($GLOBALS['habilitarTarefasVinculoProcessos'] == 1){ ?>
                <td>
                    <div align="center" class="AdmTexto01">
						<?php
						$idTbTarefasProcessos = DbFuncoes::GetCampoGenerico04("tb_itens_relacao_registros", "id_registro", "id_item", $linhaTarefas['id'], "", "", 1);
                        ?>
                            <?php if(!empty($idTbTarefasProcessos)){ ?>
                            <a href="SiteProcessosDetalhes.php?idTbProcessos=<?php echo DbFuncoes::GetCampoGenerico01($idTbTarefasProcessos, "tb_processos", "id"); ?>" target="_blank" class="AdmLinks01">
                                <?php echo Funcoes::ConteudoMascaraLeitura(DbFuncoes::GetCampoGenerico01($idTbTarefasProcessos, "tb_processos", "processo")); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarTarefasStatus'] == 1){ ?>
                <td>
                    <div align="center" class="AdmTexto01">
						<?php echo DbFuncoes::GetCampoGenerico01($linhaTarefas['id_tb_tarefa_status'], "tb_cadastro_complemento", "complemento"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <td>
                    <div align="center" class="AdmTexto01">
                    	<a href="SiteTarefasDetalhes.php?idTbTarefas=<?php echo $linhaTarefas['id'];?>" target="_blank" class="AdmLinks01">
                        	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemDetalhes"); ?>
                        </a>
                    </div>
                </td>
                
              </tr>
              <?php 
				  //Linha alternativa de tabela.
				  //----------
				  //$countTabelaFundo = $countTabelaFundo + 1;
				  $countTabelaFundo++;
				
				   if($countTabelaFundo == 2)
				   {
					   $countTabelaFundo = 0;
				   }
				  //----------
			  } 
			  ?>
            </table>
	<?php } ?>
<?php 
$pageSite->cphConteudoPrincipal = ob_get_clean(); 
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


//Inclusão do template do layout.
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>