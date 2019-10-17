<?php
//Definição de variáveis.
$IdParentProcessos = $includeProcessos_idParentProcessos;
$IdsTbProcessos = $includeProcessos_idsTbProcessos;

$IdTbCadastro1 = $includeProcessos_idTbCadastro1;
$IdsTbCadastro1 = $includeProcessos_idsTbCadastro1;

$ConfigTipoDiagramacao = $includeProcessos_configTipoDiagramacao; //1 - tabela
$ConfigProcessosNRegistros = $includeProcessos_configProcessosNRegistros;
$ConfigClassificacaoProcessos = $includeProcessos_configClassificacaoProcessos;
if($ConfigClassificacaoProcessos == ""){
	$ConfigClassificacaoProcessos = $GLOBALS['configClassificacaoProcessos'];
}


//Query de pesquisa.
//----------
$strSqlProcessosSelect = "";
$strSqlProcessosSelect .= "SELECT ";
//$strSqlProcessosSelect .= "* ";
$strSqlProcessosSelect .= "id, ";
$strSqlProcessosSelect .= "id_parent, ";
$strSqlProcessosSelect .= "id_tb_cadastro1, ";
$strSqlProcessosSelect .= "id_tb_cadastro2, ";
$strSqlProcessosSelect .= "id_tb_cadastro3, ";
$strSqlProcessosSelect .= "n_classificacao, ";
$strSqlProcessosSelect .= "data_criacao, ";
$strSqlProcessosSelect .= "data_abertura, ";
$strSqlProcessosSelect .= "data_distribuicao, ";
$strSqlProcessosSelect .= "data_admissao, ";
$strSqlProcessosSelect .= "data_demissao, ";
$strSqlProcessosSelect .= "data1, ";
$strSqlProcessosSelect .= "data2, ";
$strSqlProcessosSelect .= "data3, ";
$strSqlProcessosSelect .= "data4, ";
$strSqlProcessosSelect .= "data5, ";
$strSqlProcessosSelect .= "data6, ";
$strSqlProcessosSelect .= "data7, ";
$strSqlProcessosSelect .= "data8, ";
$strSqlProcessosSelect .= "data9, ";
$strSqlProcessosSelect .= "data10, ";
$strSqlProcessosSelect .= "processo, ";
$strSqlProcessosSelect .= "descricao, ";
$strSqlProcessosSelect .= "id_tb_processos_status, ";
$strSqlProcessosSelect .= "palavras_chave, ";
$strSqlProcessosSelect .= "valor, ";
$strSqlProcessosSelect .= "valor1, ";
$strSqlProcessosSelect .= "valor2, ";
$strSqlProcessosSelect .= "valor3, ";
$strSqlProcessosSelect .= "valor4, ";
$strSqlProcessosSelect .= "valor5, ";
$strSqlProcessosSelect .= "url1, ";
$strSqlProcessosSelect .= "url2, ";
$strSqlProcessosSelect .= "url3, ";
$strSqlProcessosSelect .= "url4, ";
$strSqlProcessosSelect .= "url5, ";
$strSqlProcessosSelect .= "informacao_complementar1, ";
$strSqlProcessosSelect .= "informacao_complementar2, ";
$strSqlProcessosSelect .= "informacao_complementar3, ";
$strSqlProcessosSelect .= "informacao_complementar4, ";
$strSqlProcessosSelect .= "informacao_complementar5, ";
$strSqlProcessosSelect .= "informacao_complementar6, ";
$strSqlProcessosSelect .= "informacao_complementar7, ";
$strSqlProcessosSelect .= "informacao_complementar8, ";
$strSqlProcessosSelect .= "informacao_complementar9, ";
$strSqlProcessosSelect .= "informacao_complementar10, ";
$strSqlProcessosSelect .= "informacao_complementar11, ";
$strSqlProcessosSelect .= "informacao_complementar12, ";
$strSqlProcessosSelect .= "informacao_complementar13, ";
$strSqlProcessosSelect .= "informacao_complementar14, ";
$strSqlProcessosSelect .= "informacao_complementar15, ";
$strSqlProcessosSelect .= "informacao_complementar16, ";
$strSqlProcessosSelect .= "informacao_complementar17, ";
$strSqlProcessosSelect .= "informacao_complementar18, ";
$strSqlProcessosSelect .= "informacao_complementar19, ";
$strSqlProcessosSelect .= "informacao_complementar20, ";
$strSqlProcessosSelect .= "informacao_complementar21, ";
$strSqlProcessosSelect .= "informacao_complementar22, ";
$strSqlProcessosSelect .= "informacao_complementar23, ";
$strSqlProcessosSelect .= "informacao_complementar24, ";
$strSqlProcessosSelect .= "informacao_complementar25, ";
$strSqlProcessosSelect .= "informacao_complementar26, ";
$strSqlProcessosSelect .= "informacao_complementar27, ";
$strSqlProcessosSelect .= "informacao_complementar28, ";
$strSqlProcessosSelect .= "informacao_complementar29, ";
$strSqlProcessosSelect .= "informacao_complementar30, ";
$strSqlProcessosSelect .= "informacao_complementar31, ";
$strSqlProcessosSelect .= "informacao_complementar32, ";
$strSqlProcessosSelect .= "informacao_complementar33, ";
$strSqlProcessosSelect .= "informacao_complementar34, ";
$strSqlProcessosSelect .= "informacao_complementar35, ";
$strSqlProcessosSelect .= "informacao_complementar36, ";
$strSqlProcessosSelect .= "informacao_complementar37, ";
$strSqlProcessosSelect .= "informacao_complementar38, ";
$strSqlProcessosSelect .= "informacao_complementar39, ";
$strSqlProcessosSelect .= "informacao_complementar40, ";
$strSqlProcessosSelect .= "informacao_complementar41, ";
$strSqlProcessosSelect .= "informacao_complementar42, ";
$strSqlProcessosSelect .= "informacao_complementar43, ";
$strSqlProcessosSelect .= "informacao_complementar44, ";
$strSqlProcessosSelect .= "informacao_complementar45, ";
$strSqlProcessosSelect .= "informacao_complementar46, ";
$strSqlProcessosSelect .= "informacao_complementar47, ";
$strSqlProcessosSelect .= "informacao_complementar48, ";
$strSqlProcessosSelect .= "informacao_complementar49, ";
$strSqlProcessosSelect .= "informacao_complementar50, ";
$strSqlProcessosSelect .= "informacao_complementar51, ";
$strSqlProcessosSelect .= "informacao_complementar52, ";
$strSqlProcessosSelect .= "informacao_complementar53, ";
$strSqlProcessosSelect .= "informacao_complementar54, ";
$strSqlProcessosSelect .= "informacao_complementar55, ";
$strSqlProcessosSelect .= "informacao_complementar56, ";
$strSqlProcessosSelect .= "informacao_complementar57, ";
$strSqlProcessosSelect .= "informacao_complementar58, ";
$strSqlProcessosSelect .= "informacao_complementar59, ";
$strSqlProcessosSelect .= "informacao_complementar60, ";
$strSqlProcessosSelect .= "ativacao, ";
$strSqlProcessosSelect .= "ativacao1, ";
$strSqlProcessosSelect .= "ativacao2, ";
$strSqlProcessosSelect .= "ativacao3, ";
$strSqlProcessosSelect .= "ativacao4, ";
$strSqlProcessosSelect .= "n_visitas, ";
$strSqlProcessosSelect .= "acesso_restrito ";
$strSqlProcessosSelect .= "FROM tb_processos ";
$strSqlProcessosSelect .= "WHERE id <> 0 ";
if($IdParentProcessos <> "")
{
	$strSqlProcessosSelect .= "AND id_parent = :id_parent ";
}
//$strSqlProcessosSelect .= "ORDER BY " . $GLOBALS['configClassificacaoProcessos'] . " ";
$strSqlProcessosSelect .= "ORDER BY " . $ConfigClassificacaoProcessos . " ";
//echo "strSqlProcessosSelect=" . $strSqlProcessosSelect . "<br/>";

$statementProcessosSelect = $dbSistemaConPDO->prepare($strSqlProcessosSelect);

if ($statementProcessosSelect !== false)
{
	if($IdParentProcessos <> "")
	{
		$statementProcessosSelect->bindParam(':id_parent', $IdParentProcessos, PDO::PARAM_STR);
	}
	$statementProcessosSelect->execute();

	/*
	$statementProcessosSelect->execute(array(
		"id_parent" => $IdParentProcessos
	));
	*/
}

//$resultadoProcessos = $dbSistemaConPDO->query($strSqlProcessosSelect);
$resultadoProcessos = $statementProcessosSelect->fetchAll();
?>
<?php if(!empty($resultadoProcessos)){?>
<div class="TabelaIncludeTitulo01">
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProcesso");?>
</div>
<?php } ?>


<?php if(!empty($resultadoProcessos)){?>
	<?php //Diagramação 1 (tabela).?>
    <?php //**************************************************************************************?>
    <?php if($ConfigTipoDiagramacao == "1"){ ?>
    	<div style="position: relative; display: block;">
        
            <table width="100%" class="AdmTabelaDados01">
              <tr class="AdmTbFundoEscuro">
              	<?php if($GLOBALS['habilitarProcessosNClassificacao'] == 1){ ?>
                <td width="50" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNClassificacaoA"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <td width="100" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProcessosDatas"); ?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProcesso"); ?>
                    </div>
                </td>
                
                <td width="100" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFuncoes"); ?>
                    </div>
                </td>
                
                <?php if($GLOBALS['habilitarProcessosAcessoRestrito'] == 1){ ?>
                <!--td width="50" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAcesso"); ?>
                    </div>
                </td-->
                <?php } ?>
                
                <!--td width="30" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao"); ?>
                    </div>
                </td-->
                
                <!--td width="30" class="AdmTbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                    </div>
                </td-->
                
                <!--td width="30" class="AdmTbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemExcluir"); ?>
                    </div>
                </td-->
              </tr>
              <?php
				$countTabelaFundo = 0;

                //Loop pelos resultados.
                foreach($resultadoProcessos as $linhaProcessos)
                {
              ?>
              <tr class="<?php if($countTabelaFundo == 0){ ?>AdmTbFundoClaro<?php }else{?>AdmTbFundoAlternativo<?php } ?>">
              	<?php if($GLOBALS['habilitarProcessosNClassificacao'] == 1){ ?>
                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <?php echo $linhaProcessos['n_classificacao'];?>
                    </div>
                </td>
                <?php } ?>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <?php echo $linhaProcessos['data_criacao'];?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div class="AdmTexto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaProcessos['processo']);?>
                    </div>
                    <div class="AdmTexto01">
                    	<?php if($GLOBALS['habilitarProcessosFotos'] == 1){ ?>
                            [
                            <a href="SiteAdmArquivosIndice.php?idParent=<?php echo $linhaProcessos['id'];?>&tipoArquivo=1&masterPageSiteSelect=LayoutSitePrincipal.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaProcessos['processo']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirFotos"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarProcessosVideos'] == 1){ ?>
                            [
                            <a href="SiteAdmArquivosIndice.php?idParent=<?php echo $linhaProcessos['id'];?>&tipoArquivo=2&masterPageSiteSelect=LayoutSitePrincipal.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaProcessos['processo']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirVideos"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarProcessosArquivos'] == 1){ ?>
                            [
                            <a href="SiteAdmArquivosIndice.php?idParent=<?php echo $linhaProcessos['id'];?>&tipoArquivo=3&masterPageSiteSelect=LayoutSitePrincipal.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaProcessos['processo']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirArquivos"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarProcessosZip'] == 1){ ?>
                            [
                            <a href="SiteAdmArquivosIndice.php?idParent=<?php echo $linhaProcessos['id'];?>&tipoArquivo=4&masterPageSiteSelect=LayoutSitePrincipal.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaProcessos['processo']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirZip"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarProcessosSwfs'] == 1){ ?>
                            [
                            <a href="SiteAdmArquivosIndice.php?idParent=<?php echo $linhaProcessos['id'];?>&tipoArquivo=5&masterPageSiteSelect=LayoutSitePrincipal.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaProcessos['processo']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirSWFs"); ?>
                            </a>
                            ] 
                        <?php } ?>
                        
                    	<?php if($GLOBALS['habilitarProcessosProcessos'] == 1){ ?>
                            [
                            <a href="SiteAdmProcessosIndice.php?idParentProcessos=<?php echo $linhaProcessos['id'];?>&masterPageSiteSelect=LayoutSitePrincipal.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaProcessos['processo']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirProcessos"); ?>
                            </a>
                            ] 
                        <?php } ?>
                        <?php if($GLOBALS['habilitarTarefasVinculoProcessos'] == 1){ ?>
                            [
                            <a href="SiteAdmTarefasIndice.php?idParent=<?php //echo $linhaCadastro['id'];?>&idTbProcessos=<?php echo $linhaProcessos['id'];?>&paginaRetorno=SiteAdmCadastroIndice.php&masterPageSiteSelect=LayoutSitePrincipal.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaProcessos['processo']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAdmPainelTarefasAdministrar"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                    	<a href="../<?php echo $GLOBALS['visualizacaoAtivaSistema'];?>/SiteProcessosDetalhes.php?idTbProcessos=<?php echo $linhaProcessos['id'];?>" target="_blank" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemVisualizacao"); ?>
                        </a>
                    </div>
                </td>
                
                <?php if($GLOBALS['habilitarProcessosAcessoRestrito'] == 1){ ?>
                <!--td class="<?php if($linhaProcessos['acesso_restrito'] == 0){/*echo "AdmTbFundoClaro";*/}else{echo "AdmTbFundoDesativado";}?> TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                    	<a href="SiteAdmRegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaProcessos['id'];?>&statusAtivacao=<?php echo $linhaProcessos['acesso_restrito'];?>&strTabela=tb_processos&strCampo=acesso_restrito<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="AdmLinks01">
                        	<?php if($linhaProcessos['acesso_restrito'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAcesso0"); ?>
                            <?php } ?>

                        	<?php if($linhaProcessos['acesso_restrito'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAcesso1"); ?>
                            <?php } ?>
                        </a>
                        <?php //echo $linhaProcessos['acesso_restrito'];?>
                    </div>
                </td-->
                <?php } ?>
                
                <!--td class="<?php if($linhaProcessos['ativacao'] == 1){/*echo "AdmTbFundoClaro";*/}else{echo "AdmTbFundoDesativado";}?> TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                    	<a href="SiteAdmRegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaProcessos['id'];?>&statusAtivacao=<?php echo $linhaProcessos['ativacao'];?>&strTabela=tb_processos&strCampo=ativacao<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="AdmLinks01">
                        	<?php if($linhaProcessos['ativacao'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao0"); ?>
                            <?php } ?>
                        	<?php if($linhaProcessos['ativacao'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao1"); ?>
                            <?php } ?>
                        </a>
						<?php //echo $linhaProcessos['ativacao'];?>
                    </div>
                </td-->
                <!--td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <a href="SiteAdmProcessosEditar.php?idTbProcessos=<?php echo $linhaProcessos['id'];?><?php echo $queryPadrao;?>" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                        </a>
                    </div>
                </td-->
                <!--td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaProcessos['id'];?>" class="AdmCampoCheckBox01" />
                    </div>
                </td-->
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
        </div>
    <?php } ?>
    <?php //**************************************************************************************?>
<?php } ?>


<?php
//Limpeza de objetos.
//----------
unset($strSqlProcessosSelect);
unset($statementProcessosSelect);
unset($resultadoProcessos);
unset($linhaProcessos);
//----------
?>