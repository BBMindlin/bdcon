<?php
//Definição de variáveis.
$IdParent = $includeAdmHistorico_idParent;
$IdTbCadastroUsuario = $includeAdmHistorico_idTbCadastroUsuario;
$IdTbHistoricoStatusSelect = $includeAdmHistorico_idTbHistoricoStatusSelect;
$DataHistoricoEdicao = $includeAdmHistorico_dataHistoricoEdicao; //0-desativado | 1-ativado

$TipoDiagramacao = $includeAdmHistorico_tipoDiagramacao; //1 - convencional
$LimiteRegistros = $includeAdmHistorico_limiteRegistros;


//Verificação de erro - debug.
//echo "TipoLogin=" . $TipoLogin . "<br />";
//echo "OrigemLogin=" . $OrigemLogin . "<br />"; 
//echo "paginaRetornoLogin=" . $paginaRetornoLogin . "<br />";
//echo "idRetornoLogin=" . $idRetornoLogin . "<br />";
?>


<?php
//Query de pesquisa.
//----------
$strSqlHistoricoSelect = "";
$strSqlHistoricoSelect .= "SELECT ";
//$strSqlHistoricoSelect .= "* ";
$strSqlHistoricoSelect .= "id, ";
$strSqlHistoricoSelect .= "id_parent, ";
$strSqlHistoricoSelect .= "id_tb_cadastro_usuario, ";
$strSqlHistoricoSelect .= "data_historico, ";
$strSqlHistoricoSelect .= "assunto, ";
$strSqlHistoricoSelect .= "historico, ";
$strSqlHistoricoSelect .= "informacao_complementar1, ";
$strSqlHistoricoSelect .= "informacao_complementar2, ";
$strSqlHistoricoSelect .= "informacao_complementar3, ";
$strSqlHistoricoSelect .= "informacao_complementar4, ";
$strSqlHistoricoSelect .= "informacao_complementar5, ";
$strSqlHistoricoSelect .= "informacao_complementar6, ";
$strSqlHistoricoSelect .= "informacao_complementar7, ";
$strSqlHistoricoSelect .= "informacao_complementar8, ";
$strSqlHistoricoSelect .= "informacao_complementar9, ";
$strSqlHistoricoSelect .= "informacao_complementar10, ";
$strSqlHistoricoSelect .= "id_tb_historico_status ";
$strSqlHistoricoSelect .= "FROM tb_historico ";
$strSqlHistoricoSelect .= "WHERE id <> 0 ";
$strSqlHistoricoSelect .= "AND id_parent = :id_parent ";
$strSqlHistoricoSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastroHistorico'] . " ";
//echo "strSqlHistoricoSelect=" . $strSqlHistoricoSelect . "<br />";
//----------

//Criação de componentes e parâmetros.
//----------
$statementHistoricoSelect = $dbSistemaConPDO->prepare($strSqlHistoricoSelect);

if ($statementHistoricoSelect !== false)
{
	if($IdParent <> "")
	{
		$statementHistoricoSelect->bindParam(':id_parent', $IdParent, PDO::PARAM_STR);
	}
	$statementHistoricoSelect->execute();
	/*
	$statementHistoricoSelect->execute(array(
		"id_parent" => $IdParent
	));
	*/
}

//$resultadoHistorico = $dbSistemaConPDO->query($strSqlHistoricoSelect);
$resultadoHistorico = $statementHistoricoSelect->fetchAll();
//----------


//Verificação de erro.
//echo "cacheControl=" . "3" . "<br>";
//echo "IdParent=" . $IdParent . "<br>";
?>


<?php //Diagramação 1.?>
<?php //**************************************************************************************?>
<?php if($TipoDiagramacao == "1"){ ?>
<div align="left" style="position: relative; display: block; overflow: hidden;">
    <?php
	if (empty($resultadoHistorico))
	{
        //echo "Nenhum registro encontrado";
    ?>
        <div align="center" class="AdmErro">
            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteMensagemHistoricoVazio"); ?>
        </div>
    <?php
    }else{
    ?>
        <table width="100%" class="TabelaDados01">
          <tr class="AdmTbFundoEscuro">
            <?php if($GLOBALS['habilitarCadastroHistoricoVisualizarProtocolo'] == 1){ ?>
            <td width="50" class="AdmTbFundoEscuro">
                <div align="center" class="AdmTexto02">
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoProtocolo"); ?>
                </div>
            </td>
            <?php } ?>
            
            <td width="50">
                <div align="center" class="AdmTexto02">
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoData"); ?>
                </div>
            </td>
            
            <td>
                <div class="AdmTexto02">
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistorico"); ?>
                </div>
            </td>
            
            <td width="100" style="display: none;">
                <div align="center" class="AdmTexto02">
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFuncoes"); ?>
                </div>
            </td>
            
            <?php if($GLOBALS['habilitarCadastroHistoricoStatus'] == 1){ ?>
            <td width="100">
                <div align="center" class="AdmTexto02">
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoStatus"); ?>
                </div>
            </td>
            <?php } ?>
          </tr>
          <?php
            $arrHistoricoStatus = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 4);
          
            //Loop pelos resultados.
            foreach($resultadoHistorico as $linhaHistorico)
            {
          ?>
          <tr class="<?php if($linhaHistorico['id_tb_cadastro_usuario'] <> 0){?>AdmTbFundoAtivado<?php }else{ ?>AdmTbFundoClaro<?php } ?>">
            <?php if($GLOBALS['habilitarCadastroHistoricoVisualizarProtocolo'] == 1){ ?>
            <td class="TabelaDados01Celula">
                <div align="center" class="AdmTexto01">
                    <?php echo $linhaHistorico['id'];?>
                </div>
            </td>
            <?php } ?>
            
            <td class="TabelaDados01Celula">
                <div align="center" class="AdmTexto01">
                    <?php //echo $linhaHistorico['data_historico'];?>
                    <?php echo Funcoes::DataLeitura01($linhaHistorico['data_historico'], $GLOBALS['configSiteFormatoData'], "2"); ?>
                </div>
            </td>
            
            <td class="TabelaDados01Celula">
                <div class="AdmTexto01">
                    <strong>
                        <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['assunto']);?>
                    </strong>
                </div>
                <div class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['historico']);?>
                </div>
                
                <?php if($GLOBALS['habilitarCadastroHistoricoUsuario'] == 1){ ?>
                    <?php if($linhaHistorico['id_tb_cadastro_usuario'] <> 0){ ?>
                    <div class="AdmTexto01">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoCadastroUsuario"); ?>: 
                        </strong>
                        <a href="SiteAdmCadastroAdministrar.php?idTbCadastro=<?php echo $linhaHistorico['id_parent'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
                            <?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaHistorico['id_tb_cadastro_usuario'], "tb_cadastro", "nome"), 
                            DbFuncoes::GetCampoGenerico01($linhaHistorico['id_tb_cadastro_usuario'], "tb_cadastro", "razao_social"), 
                            DbFuncoes::GetCampoGenerico01($linhaHistorico['id_tb_cadastro_usuario'], "tb_cadastro", "nome_fantasia"), 
                            1)); ?>
                        </a>
                    </div>
                    <?php } ?>
                <?php } ?>
                
                <?php //if(empty($idParent)){ ?>
                <?php if($idParent == ""){ ?>
                    <?php //if(!empty(DbFuncoes::GetCampoGenerico01($linhaTarefas['id_parent'], "tb_cadastro", "id"))){ ?>
                    <?php if(DbFuncoes::GetCampoGenerico01($linhaHistorico['id_parent'], "tb_cadastro", "id") <> ""){ ?>
                        <div class="AdmTexto01">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoCadastroVinculado"); ?>: 
                            </strong>
                            <a href="SiteAdmCadastroAdministrar.php?idTbCadastro=<?php echo $linhaHistorico['id_parent']; /*$idParent;*/?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
                                <?php //echo Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaTarefas['id_parent'], "tb_cadastro", "nome"); ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaHistorico['id_parent'], "tb_cadastro", "nome"), 
                                DbFuncoes::GetCampoGenerico01($linhaHistorico['id_parent'], "tb_cadastro", "razao_social"), 
                                DbFuncoes::GetCampoGenerico01($linhaHistorico['id_parent'], "tb_cadastro", "nome_fantasia"), 
                                1)); ?>
                            </a>
                        </div>
                    <?php } ?>
                 <?php } ?>
            </td>
            
            <td class="TabelaDados01Celula" style="display: none;">
                <div align="center" class="AdmTexto01">
                    <a href="SiteAdmHistoricoEditar.php?idTbHistorico=<?php echo $linhaHistorico['id'];?>" target="_blank" class="AdmLinks01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemDetalhes"); ?>
                    </a>
                </div>
                <?php if($GLOBALS['habilitarCadastroHistoricoInteracao'] == 1){ ?>
                    <div align="center" class="AdmTexto01">
                        <a href="SiteAdmHistoricoInteracaoIndice.php?idParent=<?php echo $linhaHistorico['id'];?>" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoInteracao"); ?>
                        </a>
                    </div>
                <?php } ?>
            </td>
            
            <?php if($GLOBALS['habilitarCadastroHistoricoStatus'] == 1){ ?>
            <td class="TabelaDados01Celula">
                <div align="center" class="AdmTexto01">
                    <?php 
                    for($countArray = 0; $countArray < count($arrHistoricoStatus); $countArray++)
                    {
                    ?>
                        <?php if($arrHistoricoStatus[$countArray][0] == $linhaHistorico['id_tb_historico_status']){ ?>
                            <?php echo $arrHistoricoStatus[$countArray][1];?>
                        <?php } ?>
                    <?php 
                    }
                    ?>
                </div>
            </td>
            <?php } ?>
            
          </tr>
          <?php } ?>
        </table>
	<?php } ?>
</div>
<?php } ?>
<?php //**************************************************************************************?>


<?php
//Limpeza de objetos.
//----------
unset($strSqlHistoricoSelect);
unset($statementHistoricoSelect);
unset($resultadoHistorico);
unset($linhaHistorico);
//----------
?>
