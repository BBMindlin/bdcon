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
$idTbCadastroContasBancarias = $_GET["idTbCadastroContasBancarias"];
$idTbCadastro = DbFuncoes::GetCampoGenerico01($idTbCadastroContasBancarias, "tb_cadastro_contas_bancarias", "id_tb_cadastro");

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


//Definição de variáveis.
$tituloLinkAtual = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "siteCadastroContasBancariasEditarTitulo");
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


    <form name="formCadastroContasBancariasEditar" id="formCadastroContasBancariasEditar" action="SiteAdmCadastroContasBancariasEditarExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <div>
            <table class="AdmTabelaCampos01">
                <tr>
                    <td class="AdmTbFundoEscuro" colspan="4">
                        <div align="center" class="AdmTexto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroContasBancariasTbContasBancariasEditar"); ?>
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
                    <td class="TbFundoClaro" colspan="3">
                        <div align="left">
                            <input type="text" name="titulo_conta" id="titulo_conta" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroContasBancariasTituloConta; ?>" />
                        </div>
                    </td>
                </tr>
                
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroContasBancariasNomeTitular"); ?>
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div align="left">
                            <input type="text" name="nome_titular" id="nome_titular" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroContasBancariasNomeTitular; ?>" />
                        </div>
                    </td>
                </tr>
                
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroContasBancariasCpfCnpj"); ?>
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div align="left">
                            <input type="text" name="cpf_cnpj" id="cpf_cnpj" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroContasBancariasCpfCnpj; ?>" />
                        </div>
                    </td>
                </tr>
                
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroContasBancariasNBanco"); ?>
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div align="left" class="AdmTexto01">
                            <input type="text" name="n_banco" id="n_banco" class="AdmCampoNumericoReduzido01" maxlength="255" value="0" value="<?php echo $tbCadastroContasBancariasNBanco; ?>" /> (<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroContasBancariasNBancoInstrucao01"); ?>)
                        </div>
                    </td>
                </tr>
                
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroContasBancariasNAgencia"); ?>
                        </div>

                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div align="left" class="AdmTexto01">
                            <input type="text" name="n_agencia" id="n_agencia" class="AdmCampoTexto03" maxlength="255" value="<?php echo $tbCadastroContasBancariasNAgencia; ?>" /> - <input type="text" name="digito_agencia" id="digito_agencia" class="AdmCampoNumericoReduzido01" maxlength="1" value="<?php echo $tbCadastroContasBancariasDigitoAgencia; ?>" />
                        </div>
                    </td>
                </tr>
                
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroContasBancariasNConta"); ?>
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div align="left" class="AdmTexto01">
                            <input type="text" name="n_conta" id="n_conta" class="AdmCampoTexto03" maxlength="255" value="<?php echo $tbCadastroContasBancariasNConta; ?>" /> - <input type="text" name="digito_conta" id="digito_conta" class="AdmCampoNumericoReduzido01" maxlength="1" value="<?php echo $tbCadastroContasBancariasDigitoConta; ?>" />
                        </div>
                    </td>
                </tr>
                
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroContasBancariasTipoConta"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div align="left" class="AdmTexto01">
                            <select name="tipo_conta" id="tipo_conta" class="AdmCampoDropDownMenu01">
                                <option value="1"<?php if($tbCadastroContasBancariasTipoConta == "1"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroContasBancariasTipoConta1"); ?></option>
                                <option value="2"<?php if($tbCadastroContasBancariasTipoConta == "2"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroContasBancariasTipoConta2"); ?></option>
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
                    <td class="TbFundoClaro" colspan="3">
                        <div align="left">
                            <textarea name="obs" id="obs" class="AdmCampoTextoMultilinha01"><?php echo $tbCadastroContasBancariasOBS; ?></textarea>
                        </div>
                    </td>
                </tr>
                
            </table>
        </div>
        <div>
            <div style="float:left;">
                <input type="image" name="submit" value="Submit" src="img/btoAtualizar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoAtualizar"); ?>" />
                
                <input name="idTbCadastroContasBancarias" type="hidden" id="idTbHistorico" value="<?php echo $idTbCadastroContasBancarias; ?>" />
                <input name="id_tb_cadastro" type="hidden" id="id_tb_cadastro" value="<?php echo $tbCadastroContasBancariasIdTbCadastro; ?>" />
                <input name="ativacao" type="hidden" id="ativacao" value="<?php echo $tbCadastroContasBancariasAtivacao; ?>" />
                <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                <input name="masterPageSelect" type="hidden" id="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
            </div>
            <div style="float:right;">
                <a href="<?php echo $paginaRetorno; ?>?<?php echo $queryPadrao; ?>">
                <!--idTbCadastro=<?php //echo $idTbCadastro; ?>-->
                    <img src="img/btoVoltar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoVoltar"); ?>"  />
                </a>
            </div>
        </div>
        
<?php 
$pageSite->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php
//Limpeza de objetos.
//----------
unset($strSqlCadastroContatosSelect);
unset($statementCadastroContatosSelect);
unset($resultadoCadastroContatos);
unset($linhaCadastroContatos);
//----------


//Inclusão do template do layout.
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>