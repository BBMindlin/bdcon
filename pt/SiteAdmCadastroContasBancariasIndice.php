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
$idTbCadastro = $_GET["idTbCadastro"];
$idParentCategoriasRaiz = $_GET["idParentCategoriasRaiz"];
if($idParentCategoriasRaiz == "")
{
	$idParentCategoriasRaiz = 0;
}

$palavraChave = $_GET["palavraChave"];

$tituloLinkAtual = "";
$metaTitulo = "";
$metaDescricao = "";
$metaPalavrasChave = "";

$paginaRetorno = "SiteAdmCadastroContasBancariasIndice.php";
$paginaRetornoExclusao = "SiteAdmCadastroContasBancariasEditar.php";
$variavelRetorno = "idTbCadastro";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];

//Montagem de query padrão de retorno.
$queryPadrao = "&idTbCadastro=" . $idTbCadastro . 
"&paginaRetorno=" . $paginaRetorno . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&masterPageSelect=" . $masterPageSelect . 
"&variavelRetorno=" . $variavelRetorno . 
"&palavraChave=" . $palavraChave;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Query de pesquisa.
//----------
$strSqlCadastroContasBancariasSelect = "";
$strSqlCadastroContasBancariasSelect .= "SELECT ";
//$strSqlCadastroContasBancariasSelect .= "* ";
$strSqlCadastroContasBancariasSelect .= "id, ";
$strSqlCadastroContasBancariasSelect .= "id_tb_cadastro, ";
$strSqlCadastroContasBancariasSelect .= "titulo_conta, ";
$strSqlCadastroContasBancariasSelect .= "nome_titular, ";
$strSqlCadastroContasBancariasSelect .= "cpf_cnpj, ";
$strSqlCadastroContasBancariasSelect .= "n_banco, ";
$strSqlCadastroContasBancariasSelect .= "n_agencia, ";
$strSqlCadastroContasBancariasSelect .= "digito_agencia, ";
$strSqlCadastroContasBancariasSelect .= "n_conta, ";
$strSqlCadastroContasBancariasSelect .= "digito_conta, ";
$strSqlCadastroContasBancariasSelect .= "tipo_conta, ";
$strSqlCadastroContasBancariasSelect .= "ativacao, ";
$strSqlCadastroContasBancariasSelect .= "obs ";
$strSqlCadastroContasBancariasSelect .= "FROM tb_cadastro_contas_bancarias ";
$strSqlCadastroContasBancariasSelect .= "WHERE id <> 0 ";
if($idTbCadastro <> "")
{
	$strSqlCadastroContasBancariasSelect .= "AND id_tb_cadastro = :id_tb_cadastro ";
}
if($palavraChave <> "")
{
	$strSqlCadastroContasBancariasSelect .= "AND (titulo_conta LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroContasBancariasSelect .= ") ";
}
$strSqlCadastroContasBancariasSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastroContasBancarias'] . " ";


$statementCadastroContasBancariasSelect = $dbSistemaConPDO->prepare($strSqlCadastroContasBancariasSelect);

if ($statementCadastroContasBancariasSelect !== false)
{
	$statementCadastroContasBancariasSelect->execute(array(
		"id_tb_cadastro" => $idTbCadastro
	));
}

//$resultadoCadastroContasBancarias = $dbSistemaConPDO->query($strSqlCadastroContasBancariasSelect);
$resultadoCadastroContasBancarias = $statementCadastroContasBancariasSelect->fetchAll();


//Definição de variáveis.
if($idTbCadastro <> ""){
	$tituloLinkAtual = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAdmPainelCadastroContasBancarias");
}
if($palavraChave <> ""){
	$tituloLinkAtual = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaResultados");
}
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
    
    
    <?php
	if (empty($resultadoCadastroContasBancarias))
	{
        //echo "Nenhum registro encontrado";
    ?>
        <div align="center" class="AdmAlerta">
            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "siteMensagemCadastroContasBancariasVazio"); ?>
        </div>
    <?php
    }else{
    ?>

        <form name="formCadastroContasBancariasAcoes" id="formCadastroContasBancariasAcoes" action="SiteAdmRegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_cadastro_contas_bancarias" />
            <input name="idTbCadastro" id="idTbCadastro" type="hidden" value="<?php echo $idTbCadastro; ?>" />

            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            <input name="masterPageSelect" type="hidden" id="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
            <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            <div style="position:relative; display: block; clear: both;">
                <div align="right" style="float: right;">
                    <input type="image" name="submit" value="Submit" src="img/btoExcluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoExcluir"); ?>">
                </div>
            </div>
            <table width="100%" class="AdmTabelaDados01">
              <tr class="AdmTbFundoEscuro">
                <td>
                    <div class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroContasBancariasTituloConta"); ?>/<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroContasBancariasNomeTitular"); ?>
                    </div>
                </td>
                
                <td width="30" class="AdmTbFundoEscuro">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao"); ?>
                    </div>
                </td>
                
                <td width="30" class="AdmTbFundoEscuro">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                    </div>
                </td>
                
                <td width="30" class="AdmTbFundoEscuro">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemExcluir"); ?>
                    </div>
                </td>
              </tr>
              <?php
				$countTabelaFundo = 0;

                //Loop pelos resultados.
                foreach($resultadoCadastroContasBancarias as $linhaCadastroContasBancarias)
                {
              ?>
              <tr class="<?php if($countTabelaFundo == 0){ ?>AdmTbFundoClaro<?php }else{?>AdmTbFundoAlternativo<?php } ?>">
                <td>
                	<?php if(!empty($linhaCadastroContasBancarias['titulo_conta'])){ ?>
                        <div class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastroContasBancarias['titulo_conta']);?>
                        </div>
                    <?php } ?>
                	<?php if(!empty($linhaCadastroContasBancarias['nome_titular'])){ ?>
                        <div class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastroContasBancarias['nome_titular']);?>
                        </div>
                    <?php } ?>
                    
                    <?php if(!empty($linhaCadastroContasBancarias['cpf_cnpj'])){ ?>
                        <div class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroContasBancariasCpfCnpj"); ?>: <?php echo $linhaCadastroContasBancarias['cpf_cnpj'];?>
                        </div>
                    <?php } ?>
                    <?php if(!empty($linhaCadastroContasBancarias['n_banco'])){ ?>
                        <div class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroContasBancariasNBanco"); ?>: <?php echo $linhaCadastroContasBancarias['n_banco'];?>
                        </div>
                    <?php } ?>
                    
                    <?php if(!empty($linhaCadastroContasBancarias['n_agencia'])){ ?>
                        <div class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroContasBancariasNAgencia"); ?>: <?php echo $linhaCadastroContasBancarias['n_agencia'];?> - <?php echo $linhaCadastroContasBancarias['digito_agencia'];?>
                        </div>
                    <?php } ?>
                    <?php if(!empty($linhaCadastroContasBancarias['n_conta'])){ ?>
                        <div class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroContasBancariasNConta"); ?>: <?php echo $linhaCadastroContasBancarias['n_conta'];?> - <?php echo $linhaCadastroContasBancarias['digito_conta'];?>
                        </div>
                    <?php } ?>
                    
                    <?php if(empty($idTbCadastro)){ ?>
                    <?php //if($idParent == ""){ ?>
						<?php //if(!empty(DbFuncoes::GetCampoGenerico01($linhaTarefas['id_parent'], "tb_cadastro", "id"))){ ?>
						<?php if(DbFuncoes::GetCampoGenerico01($linhaCadastroContasBancarias['id_tb_cadastro'], "tb_cadastro", "id") <> ""){ ?>
                            <div class="AdmTexto01">
                                <strong>
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemCadastroVinculado"); ?>: 
                                </strong>
                                <a href="SiteAdmCadastroAdministrar.php?idTbCadastro=<?php echo $idTbCadastro;?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
                                    <?php //echo Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaTarefas['id_parent'], "tb_cadastro", "nome"); ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaCadastroContasBancarias['id_tb_cadastro'], "tb_cadastro", "nome"), 
									DbFuncoes::GetCampoGenerico01($linhaCadastroContasBancarias['id_tb_cadastro'], "tb_cadastro", "razao_social"), 
									DbFuncoes::GetCampoGenerico01($linhaCadastroContasBancarias['id_tb_cadastro'], "tb_cadastro", "nome_fantasia"), 
									1)); ?>
                                </a>
                            </div>
						<?php } ?>
                     <?php } ?>
                </td>
                
                <td class="<?php if($linhaCadastroContasBancarias['ativacao'] == 1){/*echo "AdmTbFundoClaro";*/}else{echo "TbFundoDesativado";}?>">
                    <div align="center" class="AdmTexto01">
                    	<a href="SiteAdmRegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaCadastroContasBancarias['id'];?>&statusAtivacao=<?php echo $linhaCadastroContasBancarias['ativacao'];?>&strTabela=tb_cadastro_contas_bancarias&strCampo=ativacao<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="AdmLinks01">
                        	<?php if($linhaCadastroContasBancarias['ativacao'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao0"); ?>
                            <?php } ?>
                        	<?php if($linhaCadastroContasBancarias['ativacao'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao1"); ?>
                            <?php } ?>
                        </a>
						<?php //echo $linhaCategorias['ativacao'];?>
                    </div>
                </td>
                
                <td>
                    <div align="center" class="AdmTexto01">
                        <a href="SiteAdmCadastroContasBancariasEditar.php?idTbCadastroContasBancarias=<?php echo $linhaCadastroContasBancarias['id'];?><?php echo $queryPadrao;?>" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                        </a>
                    </div>
                </td>
                
                <td>
                    <div align="center" class="AdmTexto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaCadastroContasBancarias['id'];?>" class="AdmCampoCheckBox01" />
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
        </form>
	<?php } ?>
    

	<?php if(!empty($idTbCadastro)){ ?>
    <form name="formCadastroContasBancarias" id="formCadastroContasBancarias" action="SiteAdmCadastroContasBancariasIndiceExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <div>
            <table class="AdmTabelaCampos01">
                <tr>
                    <td class="AdmTbFundoEscuro" colspan="4">
                        <div align="center" class="AdmTexto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroContasBancariasTbContasBancarias"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroContasBancariasTituloConta"); ?>
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left">
                            <input type="text" name="titulo_conta" id="titulo_conta" class="AdmCampoTexto02" maxlength="255" />
                        </div>
                    </td>
                </tr>
                
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroContasBancariasNomeTitular"); ?>
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left">
                            <input type="text" name="nome_titular" id="nome_titular" class="AdmCampoTexto02" maxlength="255" />
                        </div>
                    </td>
                </tr>
                
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroContasBancariasCpfCnpj"); ?>
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left">
                            <input type="text" name="cpf_cnpj" id="cpf_cnpj" class="AdmCampoTexto02" maxlength="255" />
                        </div>
                    </td>
                </tr>
                
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroContasBancariasNBanco"); ?>
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left" class="AdmTexto01">
                            <input type="text" name="n_banco" id="n_banco" class="AdmCampoNumericoReduzido01" maxlength="255" value="0" /> (<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroContasBancariasNBancoInstrucao01"); ?>)
                        </div>
                    </td>
                </tr>
                
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroContasBancariasNAgencia"); ?>
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left" class="AdmTexto01">
                            <input type="text" name="n_agencia" id="n_agencia" class="CampoTexto02" maxlength="255" /> - <input type="text" name="digito_agencia" id="digito_agencia" class="AdmCampoNumericoReduzido01" maxlength="1" />
                        </div>
                    </td>
                </tr>
                
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroContasBancariasNConta"); ?>
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left" class="AdmTexto01">
                            <input type="text" name="n_conta" id="n_conta" class="CampoTexto02" maxlength="255" /> - <input type="text" name="digito_conta" id="digito_conta" class="AdmCampoNumericoReduzido01" maxlength="1" />
                        </div>
                    </td>
                </tr>
                
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroContasBancariasTipoConta"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left" class="AdmTexto01">
                            <select name="tipo_conta" id="tipo_conta" class="AdmCampoDropDownMenu01">
                                <option value="1" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroContasBancariasTipoConta1"); ?></option>
                                <option value="2"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroContasBancariasTipoConta2"); ?></option>
                            </select>
                        </div>
                    </td>
                </tr>
                
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroContasBancariasOBS"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left">
                            <textarea name="obs" id="obs" class="AdmCampoTextoMultilinha01"></textarea>
                        </div>
                    </td>
                </tr>
                
            </table>
        </div>
        <div>
            <div style="float:left;">
                <input type="image" name="submit" value="Submit" src="img/btoIncluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoIncluir"); ?>" />
                
                <input name="id_tb_cadastro" type="hidden" id="id_tb_cadastro" value="<?php echo $idTbCadastro; ?>" />
                <input name="ativacao" type="hidden" id="ativacao" value="1" />
                <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                <input name="masterPageSelect" type="hidden" id="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
                
                <?php if($GLOBALS['habilitarCadastroContatosAtivacao'] <> 1){ ?>
                    <input name="ativacao" type="hidden" id="ativacao" value="1" />
                <?php } ?>
            </div>
            <div style="float:right;">
            	<?php if($idTbCadastro <> ""){ ?>
                	<?php if(DbFuncoes::GetCampoGenerico01($idTbCadastro, "tb_cadastro", "id") <> ""){ ?>
                        <a href="SiteAdmCadastroAdministrar.php?idTbCadastro=<?php echo $idTbCadastro; ?>" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteContatosLinkVoltarCadastro"); ?>
                        </a>
                    <?php } ?>
                <?php } ?>
                &nbsp;
            </div>
        </div>
    </form>
    <br />
	<?php } ?>
    
<?php 
$pageSite->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php
//Limpeza de objetos.
//----------
unset($strSqlCadastroContasBancariasSelect);
unset($statementCadastroContasBancariasSelect);
unset($resultadoCadastroContasBancarias);
unset($linhaCadastroContasBancarias);
//----------


//Inclusão do template do layout.
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>