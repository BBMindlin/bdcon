<?php
//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeLayout.php";


//Verificação de login Master.
LoginAutenticacao::UsuarioLoginVerificacao();


//Resgate de variáveis.
$idTbCadastro = $_GET["idTbCadastro"];
$idParentCategoriasRaiz = $_GET["idParentCategoriasRaiz"];
if($idParentCategoriasRaiz == "")
{
	$idParentCategoriasRaiz = 0;
}

$palavraChave = $_GET["palavraChave"];

$paginaRetorno = "CadastroContasBancariasIndice.php";
$paginaRetornoExclusao = "CadastroContasBancariasEditar.php";
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
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistema"); ?>
     - 
	<?php echo htmlentities($GLOBALS['configNomeCliente']); ?>
     - 
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroContasBancariasTitulo"); ?>
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
            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroContasBancariasTitulo"); ?>
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

    <?php
	if (empty($resultadoCadastroContasBancarias))
	{
        //echo "Nenhum registro encontrado";
    ?>
        <div align="center" class="TextoErro">
            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
        </div>
    <?php
    }else{
    ?>

        <form name="formCadastroContasBancariasAcoes" id="formCadastroContasBancariasAcoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_cadastro_contas_bancarias" />
            <input name="idTbCadastro" id="idTbCadastro" type="hidden" value="<?php echo $idTbCadastro; ?>" />

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
                <td class="TabelaDados01Celula">
                    <div class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroContasBancariasTituloConta"); ?>/<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroContasBancariasNomeTitular"); ?>
                    </div>
                </td>
                
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao"); ?>
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
                foreach($resultadoCadastroContasBancarias as $linhaCadastroContasBancarias)
                {
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                	<?php if(!empty($linhaCadastroContasBancarias['titulo_conta'])){ ?>
                        <div class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastroContasBancarias['titulo_conta']);?>
                        </div>
                    <?php } ?>
                	<?php if(!empty($linhaCadastroContasBancarias['nome_titular'])){ ?>
                        <div class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastroContasBancarias['nome_titular']);?>
                        </div>
                    <?php } ?>
                    
                    <?php if(!empty($linhaCadastroContasBancarias['cpf_cnpj'])){ ?>
                        <div class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroContasBancariasCpfCnpj"); ?>: <?php echo $linhaCadastroContasBancarias['cpf_cnpj'];?>
                        </div>
                    <?php } ?>
                    <?php if(!empty($linhaCadastroContasBancarias['n_banco'])){ ?>
                        <div class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroContasBancariasNBanco"); ?>: <?php echo $linhaCadastroContasBancarias['n_banco'];?>
                        </div>
                    <?php } ?>
                    
                    <?php if(!empty($linhaCadastroContasBancarias['n_agencia'])){ ?>
                        <div class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroContasBancariasNAgencia"); ?>: <?php echo $linhaCadastroContasBancarias['n_agencia'];?> - <?php echo $linhaCadastroContasBancarias['digito_agencia'];?>
                        </div>
                    <?php } ?>
                    <?php if(!empty($linhaCadastroContasBancarias['n_conta'])){ ?>
                        <div class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroContasBancariasNConta"); ?>: <?php echo $linhaCadastroContasBancarias['n_conta'];?> - <?php echo $linhaCadastroContasBancarias['digito_conta'];?>
                        </div>
                    <?php } ?>
                    
                    <?php if(empty($idTbCadastro)){ ?>
                    <?php //if($idParent == ""){ ?>
						<?php //if(!empty(DbFuncoes::GetCampoGenerico01($linhaTarefas['id_parent'], "tb_cadastro", "id"))){ ?>
						<?php if(DbFuncoes::GetCampoGenerico01($linhaCadastroContasBancarias['id_tb_cadastro'], "tb_cadastro", "id") <> ""){ ?>
                            <div class="Texto01">
                                <strong>
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemCadastroVinculado"); ?>: 
                                </strong>
                                <a href="CadastroAdministrar.php?idTbCadastro=<?php echo $idTbCadastro;?>&masterPageSelect=LayoutSistemaSemMenu.php" target="_blank" class="Links01">
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
                
                <td class="<?php if($linhaCadastroContasBancarias['ativacao'] == 1){/*echo "TbFundoClaro";*/}else{echo "TbFundoDesativado";}?> TabelaDados01Celula">
                    <div align="center" class="Texto01">
                    	<a href="RegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaCadastroContasBancarias['id'];?>&statusAtivacao=<?php echo $linhaCadastroContasBancarias['ativacao'];?>&strTabela=tb_cadastro_contas_bancarias&strCampo=ativacao<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="Links01">
                        	<?php if($linhaCadastroContasBancarias['ativacao'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao0"); ?>
                            <?php } ?>
                        	<?php if($linhaCadastroContasBancarias['ativacao'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao1"); ?>
                            <?php } ?>
                        </a>
						<?php //echo $linhaCategorias['ativacao'];?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="CadastroContasBancariasEditar.php?idTbCadastroContasBancarias=<?php echo $linhaCadastroContasBancarias['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaCadastroContasBancarias['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>

              <?php } ?>
            </table>
        </form>
	<?php } ?>
    

	<?php if(!empty($idTbCadastro)){ ?>
    <form name="formCadastroContasBancarias" id="formCadastroContasBancarias" action="CadastroContasBancariasIndiceExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <div>
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="4">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroContasBancariasTbContasBancarias"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroContasBancariasTituloConta"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div align="left">
                            <input type="text" name="titulo_conta" id="titulo_conta" class="CampoTexto01" maxlength="255" />
                        </div>
                    </td>
                </tr>
                
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroContasBancariasNomeTitular"); ?>
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div align="left">
                            <input type="text" name="nome_titular" id="nome_titular" class="CampoTexto01" maxlength="255" />
                        </div>
                    </td>
                </tr>
                
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroContasBancariasCpfCnpj"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div align="left">
                            <input type="text" name="cpf_cnpj" id="cpf_cnpj" class="CampoTexto01" maxlength="255" />
                        </div>
                    </td>
                </tr>
                
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroContasBancariasNBanco"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div align="left" class="Texto01">
                            <input type="text" name="n_banco" id="n_banco" class="CampoNumericoReduzido01" maxlength="255" value="0" /> (<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroContasBancariasNBancoInstrucao01"); ?>)
                        </div>
                    </td>
                </tr>
                
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroContasBancariasNAgencia"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div align="left" class="Texto01">
                            <input type="text" name="n_agencia" id="n_agencia" class="CampoTexto02" maxlength="255" /> - <input type="text" name="digito_agencia" id="digito_agencia" class="CampoNumericoReduzido01" maxlength="1" />
                        </div>
                    </td>
                </tr>
                
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroContasBancariasNConta"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div align="left" class="Texto01">
                            <input type="text" name="n_conta" id="n_conta" class="CampoTexto02" maxlength="255" /> - <input type="text" name="digito_conta" id="digito_conta" class="CampoNumericoReduzido01" maxlength="1" />
                        </div>
                    </td>
                </tr>
                
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroContasBancariasTipoConta"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div align="left" class="Texto01">
                            <select name="tipo_conta" id="tipo_conta" class="CampoDropDownMenu01">
                                <option value="1" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroContasBancariasTipoConta1"); ?></option>
                                <option value="2"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroContasBancariasTipoConta2"); ?></option>
                            </select>
                        </div>
                    </td>
                </tr>
                
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroContasBancariasOBS"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div align="left">
                            <textarea name="obs" id="obs" class="CampoTextoMultilinha01"></textarea>
                        </div>
                    </td>
                </tr>
                
            </table>
        </div>
        <div>
            <div style="float:left;">
                <input type="image" name="submit" value="Submit" src="img/btoIncluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoIncluir"); ?>" />
                
                <input name="id_tb_cadastro" type="hidden" id="id_tb_cadastro" value="<?php echo $idTbCadastro; ?>" />
                <input name="ativacao" type="hidden" id="ativacao" value="1" />
                <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                <input name="masterPageSelect" type="hidden" id="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
                
                <?php if($GLOBALS['habilitarCadastroContatosAtivacao'] <> 1){ ?>
                    <input name="ativacao" type="hidden" id="ativacao" value="1" />
                <?php } ?>
            </div>
            <div style="float:right;">
                &nbsp;
            </div>
        </div>
    </form>
    <br />
	<?php } ?>
    
<?php 
$page->cphConteudoPrincipal = ob_get_clean(); 
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
?>


<?php 
//Inclusão do template do layout.
include_once $page->LayoutSistema;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>
