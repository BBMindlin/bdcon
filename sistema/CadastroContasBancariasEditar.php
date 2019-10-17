<?php
//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeLayout.php";


//Verificação de login Master.
LoginAutenticacao::UsuarioLoginVerificacao();


//Resgate de variáveis.
$idTbCadastroContasBancarias = $_GET["idTbCadastroContasBancarias"];
$idTbCadastro = DbFuncoes::GetCampoGenerico01($idTbCadastroContasBancarias, "tb_cadastro_contas_bancarias", "id_tb_cadastro");

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
"&variavelRetorno=" . $variavelRetorno;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.

//Query de pesquisa.
//----------
$strSqlCadastroContasBancariasDetalhesSelect = "";
$strSqlCadastroContasBancariasDetalhesSelect .= "SELECT ";
//$strSqlCadastroContasBancariasDetalhesSelect .= "* ";
$strSqlCadastroContasBancariasDetalhesSelect .= "id, ";
$strSqlCadastroContasBancariasDetalhesSelect .= "id_tb_cadastro, ";
$strSqlCadastroContasBancariasDetalhesSelect .= "titulo_conta, ";
$strSqlCadastroContasBancariasDetalhesSelect .= "nome_titular, ";
$strSqlCadastroContasBancariasDetalhesSelect .= "cpf_cnpj, ";
$strSqlCadastroContasBancariasDetalhesSelect .= "n_banco, ";
$strSqlCadastroContasBancariasDetalhesSelect .= "n_agencia, ";
$strSqlCadastroContasBancariasDetalhesSelect .= "digito_agencia, ";
$strSqlCadastroContasBancariasDetalhesSelect .= "n_conta, ";
$strSqlCadastroContasBancariasDetalhesSelect .= "digito_conta, ";
$strSqlCadastroContasBancariasDetalhesSelect .= "tipo_conta, ";
$strSqlCadastroContasBancariasDetalhesSelect .= "ativacao, ";
$strSqlCadastroContasBancariasDetalhesSelect .= "obs ";
$strSqlCadastroContasBancariasDetalhesSelect .= "FROM tb_cadastro_contas_bancarias ";
$strSqlCadastroContasBancariasDetalhesSelect .= "WHERE id <> 0 ";
//$strSqlCadastroContasBancariasDetalhesSelect .= "AND id_tb_categorias = :id_tb_categorias ";
$strSqlCadastroContasBancariasDetalhesSelect .= "AND id = :id ";
//$strSqlCadastroContasBancariasDetalhesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastroContatos'] . " ";


$statementCadastroContasBancariasDetalhesSelect = $dbSistemaConPDO->prepare($strSqlCadastroContasBancariasDetalhesSelect);

if ($statementCadastroContasBancariasDetalhesSelect !== false)
{
	$statementCadastroContasBancariasDetalhesSelect->execute(array(
		"id" => $idTbCadastroContasBancarias
	));
}

//$resultadoCadastroContasBancariasDetalhes = $dbSistemaConPDO->query($strSqlCadastroContasBancariasDetalhesSelect);
$resultadoCadastroContasBancariasDetalhes = $statementCadastroContasBancariasDetalhesSelect->fetchAll();

if (empty($resultadoCadastroContasBancariasDetalhes))
{
	//echo "Nenhum registro encontrado";
}else{
	foreach($resultadoCadastroContasBancariasDetalhes as $linhaCadastroContasBancariasDetalhes)
	{
		//Definição das variáveis de detalhes.
		$tbCadastroContasBancariasId = $linhaCadastroContasBancariasDetalhes['id'];
		$tbCadastroContasBancariasIdTbCadastro = $linhaCadastroContasBancariasDetalhes['id_tb_cadastro'];
		$tbCadastroContasBancariasTituloConta = Funcoes::ConteudoMascaraLeitura($linhaCadastroContasBancariasDetalhes['titulo_conta']);
		$tbCadastroContasBancariasNomeTitular = Funcoes::ConteudoMascaraLeitura($linhaCadastroContasBancariasDetalhes['nome_titular']);
		$tbCadastroContasBancariasCpfCnpj = $linhaCadastroContasBancariasDetalhes['cpf_cnpj'];
		$tbCadastroContasBancariasNBanco = $linhaCadastroContasBancariasDetalhes['n_banco'];
		$tbCadastroContasBancariasNAgencia = $linhaCadastroContasBancariasDetalhes['n_agencia'];
		$tbCadastroContasBancariasDigitoAgencia = $linhaCadastroContasBancariasDetalhes['digito_agencia'];
		$tbCadastroContasBancariasNConta = $linhaCadastroContasBancariasDetalhes['n_conta'];
		$tbCadastroContasBancariasDigitoConta = $linhaCadastroContasBancariasDetalhes['digito_conta'];
		$tbCadastroContasBancariasTipoConta = $linhaCadastroContasBancariasDetalhes['tipo_conta'];
		$tbCadastroContasBancariasAtivacao = $linhaCadastroContasBancariasDetalhes['ativacao'];
		$tbCadastroContasBancariasOBS = Funcoes::ConteudoMascaraLeitura($linhaCadastroContasBancariasDetalhes['obs']);
		
		//Verificação de erro.
		//echo "tbCadastroContasBancariasId=" . $tbCadastroContasBancariasId . "<br>";
		//echo "tbCadastroContasBancariasIdTbCadastro=" . $tbCadastroContasBancariasIdTbCadastro . "<br>";
	}
}
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistema"); ?>
     - 
	<?php echo htmlentities($GLOBALS['configNomeCliente']); ?>
     - 
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroContasBancariasEditarTitulo"); ?>
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
            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroContasBancariasEditarTitulo"); ?>
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
    
    
    <form name="formCadastroContasBancariasEditar" id="formCadastroContasBancariasEditar" action="CadastroContasBancariasEditarExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <div>
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="4">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroContasBancariasTbContasBancariasEditar"); ?>
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
                            <input type="text" name="titulo_conta" id="titulo_conta" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroContasBancariasTituloConta; ?>" />
                        </div>
                    </td>
                </tr>
                
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroContasBancariasNomeTitular"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div align="left">
                            <input type="text" name="nome_titular" id="nome_titular" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroContasBancariasNomeTitular; ?>" />
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
                            <input type="text" name="cpf_cnpj" id="cpf_cnpj" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroContasBancariasCpfCnpj; ?>" />
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
                            <input type="text" name="n_banco" id="n_banco" class="CampoNumericoReduzido01" maxlength="255" value="0" value="<?php echo $tbCadastroContasBancariasNBanco; ?>" /> (<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroContasBancariasNBancoInstrucao01"); ?>)
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
                            <input type="text" name="n_agencia" id="n_agencia" class="CampoTexto02" maxlength="255" value="<?php echo $tbCadastroContasBancariasNAgencia; ?>" /> - <input type="text" name="digito_agencia" id="digito_agencia" class="CampoNumericoReduzido01" maxlength="1" value="<?php echo $tbCadastroContasBancariasDigitoAgencia; ?>" />
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
                            <input type="text" name="n_conta" id="n_conta" class="CampoTexto02" maxlength="255" value="<?php echo $tbCadastroContasBancariasNConta; ?>" /> - <input type="text" name="digito_conta" id="digito_conta" class="CampoNumericoReduzido01" maxlength="1" value="<?php echo $tbCadastroContasBancariasDigitoConta; ?>" />
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
                                <option value="1"<?php if($tbCadastroContasBancariasTipoConta == "1"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroContasBancariasTipoConta1"); ?></option>
                                <option value="2"<?php if($tbCadastroContasBancariasTipoConta == "2"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroContasBancariasTipoConta2"); ?></option>
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
                            <textarea name="obs" id="obs" class="CampoTextoMultilinha01"><?php echo $tbCadastroContasBancariasOBS; ?></textarea>
                        </div>
                    </td>
                </tr>
                
            </table>
        </div>
        <div>
            <div style="float:left;">
                <input type="image" name="submit" value="Submit" src="img/btoAtualizar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoAtualizar"); ?>" />
                
                <input name="idTbCadastroContasBancarias" type="hidden" id="idTbHistorico" value="<?php echo $idTbCadastroContasBancarias; ?>" />
                <input name="id_tb_cadastro" type="hidden" id="id_tb_cadastro" value="<?php echo $tbCadastroContasBancariasIdTbCadastro; ?>" />
                <input name="ativacao" type="hidden" id="ativacao" value="<?php echo $tbCadastroContasBancariasAtivacao; ?>" />
                <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                <input name="masterPageSelect" type="hidden" id="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
            </div>
            <div style="float:right;">
                <a href="<?php echo $paginaRetorno; ?>?<?php echo $queryPadrao; ?>">
                <!--idTbCadastro=<?php //echo $idTbCadastro; ?>-->
                    <img src="img/btoVoltar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoVoltar"); ?>"  />
                </a>
            </div>
        </div>
<?php 
$page->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>



<?php
//Limpeza de objetos.
//----------
unset($strSqlCadastroContasBancariasDetalhesSelect);
unset($statementCadastroContasBancariasDetalhesSelect);
unset($resultadoCadastroContasBancariasDetalhes);
unset($linhaCadastroContasBancariasDetalhes);
//----------
?>


<?php 
//Inclusão do template do layout.
include_once $page->LayoutSistema;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>