<?php
//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeLayout.php";


//Verificação de login Master.
LoginAutenticacao::UsuarioLoginVerificacao();


//Resgate de variáveis.
$idParentTblBairros = $_GET["idParentTblBairros"];

$paginaRetorno = "DBCEPLogradourosIndice.php";
$paginaRetornoExclusao = "DBCEPLogradourosEditar.php";
$variavelRetorno = "";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];


//Montagem de query padrão de retorno.
$queryPadrao = "&idParentTblBairros=" . $idParentTblBairros . 
"&paginaRetorno=" . $paginaRetorno . 
"&masterPageSelect=" . $masterPageSelect . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&variavelRetorno=" . $variavelRetorno . 
"&palavraChave=" . $palavraChave;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Query de pesquisa.
//----------
$strSqlDBCEPLogradourosBrasilSelect = "";
$strSqlDBCEPLogradourosBrasilSelect .= "SELECT ";
//$strSqlDBCEPLogradourosBrasilSelect .= "* ";
$strSqlDBCEPLogradourosBrasilSelect .= "Codigo, ";
$strSqlDBCEPLogradourosBrasilSelect .= "UF, ";
$strSqlDBCEPLogradourosBrasilSelect .= "CodigoCidade, ";
$strSqlDBCEPLogradourosBrasilSelect .= "DescricaoNaoAbreviada, ";
$strSqlDBCEPLogradourosBrasilSelect .= "Descricao, ";
$strSqlDBCEPLogradourosBrasilSelect .= "CodigoBairro, ";
$strSqlDBCEPLogradourosBrasilSelect .= "CEP, ";
$strSqlDBCEPLogradourosBrasilSelect .= "BAI_NU_SEQUENCIAL_FIM, ";
$strSqlDBCEPLogradourosBrasilSelect .= "LOG_COMPLEMENTO, ";
$strSqlDBCEPLogradourosBrasilSelect .= "LOG_TIPO_LOGRADOURO, ";
$strSqlDBCEPLogradourosBrasilSelect .= "LOG_STATUS_TIPO_LOG, ";
$strSqlDBCEPLogradourosBrasilSelect .= "DescricaoSemAcento ";
$strSqlDBCEPLogradourosBrasilSelect .= "FROM tblLogradouros ";
if($idParentTblBairros <> "")
{
	$strSqlDBCEPLogradourosBrasilSelect .= "WHERE CodigoBairro = :CodigoBairro ";
}
$strSqlDBCEPLogradourosBrasilSelect .= "ORDER BY " . $GLOBALS['configClassificacaoDBCEPLogradourosBrasil'] . " ";
//$strSqlDBCEPLogradourosBrasilSelect .= "LIMIT 0, 10 "; //debug
//----------


//Parâmetros.
//----------
//$statementDBCEPLogradourosBrasilSelect = $dbSistemaConPDO->prepare($strSqlDBCEPLogradourosBrasilSelect);
$statementDBCEPLogradourosBrasilSelect = $dbCEPConPDO->prepare($strSqlDBCEPLogradourosBrasilSelect);

if ($statementDBCEPLogradourosBrasilSelect !== false)
{
	/*
	$statementDBCEPLogradourosBrasilSelect->execute(array(
		"id_tb_categorias" => $idParentDBCEPLogradourosBrasil
	));
	*/
	if($idParentTblBairros <> "")
	{
		$statementDBCEPLogradourosBrasilSelect->bindParam(':CodigoBairro', $idParentTblBairros, PDO::PARAM_STR);
	}
	$statementDBCEPLogradourosBrasilSelect->execute();
}
//----------

//$resultadoDBCEPLogradourosBrasil = $dbSistemaConPDO->query($strSqlDBCEPLogradourosBrasilSelect);
$resultadoDBCEPLogradourosBrasil = $statementDBCEPLogradourosBrasilSelect->fetchAll();

//Verificação de erro - debug.
//echo "paginacaoTotalRegistros=" . $paginacaoTotalRegistros . "<br />";
//echo "habilitarDBCEPLogradourosBrasilSistemaPaginacao=" . $habilitarDBCEPLogradourosBrasilSistemaPaginacao . "<br />";
//echo "strSqlDBCEPLogradourosBrasilSelect=" . $strSqlDBCEPLogradourosBrasilSelect . "<br />";
//echo "idParentTblCidades=" . $idParentTblCidades . "<br />";
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistema"); ?> - <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configNomeCliente'], "IncludeConfig"); ?>
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
<?php ob_start(); /* cphConteudoCabecalho*/ ?>
    <div align="left" class="TextoTitulo01">
    	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaDBCEPTitulo"); ?> - <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaLocalizacaoLogradourosTitulo"); ?>
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
	if (empty($resultadoDBCEPLogradourosBrasil))
	{
        //echo "Nenhum registro encontrado";
    ?>
        <div align="center" class="TextoErro">
            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
        </div>
    <?php
    }else{
    ?>
        <form name="formDBCEPLogradourosBrasilAcoes" id="formDBCEPLogradourosBrasilAcoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input type="hidden" id="strTabela" name="strTabela" value="tblLogradouros" />
            <input type="hidden" id="idParentTblBairros" name="idParentTblBairros" value="<?php echo $idParentTblBairros; ?>" />

            <input type="hidden" id="paginaRetorno" name="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            <input type="hidden" id="masterPageSelect" name="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
            <input type="hidden" id="paginacaoNumero" name="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input type="hidden" id="caracterAtual" name="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            <div style="position:relative; display: none; clear: both;">
                <div align="right" style="float: right;">
                    <input type="image" name="submit" value="Submit" src="img/btoExcluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoExcluir"); ?>">
                </div>
            </div>
            <table width="100%" class="TabelaDados01">
              <tr class="TbFundoEscuro">
                <td width="30" class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemId"); ?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaLocalizacaoLogradourosTitulo"); ?>
                    </div>
                </td>
                
                <td width="50" class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaLocalizacaoEstadoSigla"); ?>
                    </div>
                </td>
                
                <td width="100" class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaLocalizacaoCodigoPostal"); ?>
                    </div>
                </td>
                
                <td width="100" class="TabelaDados01Celula" style="display: none;">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFuncoes"); ?>
                    </div>
                </td>
                
                <td width="30" class="TabelaDados01Celula" style="display: none;">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                    </div>
                </td>
                
                <td width="30" class="TabelaDados01Celula" style="display: none;">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemExcluir"); ?>
                    </div>
                </td>
              </tr>
              <?php
                //Loop pelos resultados.
                foreach($resultadoDBCEPLogradourosBrasil as $linhaDBCEPLogradourosBrasil)
                {
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaDBCEPLogradourosBrasil['Codigo'];?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaDBCEPLogradourosBrasil['LOG_TIPO_LOGRADOURO']);?>
						 <?php echo Funcoes::ConteudoMascaraLeitura($linhaDBCEPLogradourosBrasil['DescricaoNaoAbreviada']);?>
						 (<?php echo Funcoes::ConteudoMascaraLeitura($linhaDBCEPLogradourosBrasil['Descricao']);?>)
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaDBCEPLogradourosBrasil['UF'];?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo Funcoes::FormatarCEPLer($linhaDBCEPLogradourosBrasil['CEP']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula" style="display: none;">
                    <div align="center" class="Texto01">

                    </div>
                </td>
                
                <td class="TabelaDados01Celula" style="display: none;">
                    <div align="center" class="Texto01">
                        <a href="DBCEPLogradourosEditar.php?idTblLogradouros=<?php echo $linhaDBCEPLogradourosBrasil['Codigo'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula" style="display: none;">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaDBCEPLogradourosBrasil['Codigo'];?>" class="CampoCheckBox01" />
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
unset($strSqlDBCEPLogradourosBrasilSelect);
unset($statementDBCEPLogradourosBrasilSelect);
unset($resultadoDBCEPLogradourosBrasil);
unset($linhaDBCEPLogradourosBrasil);
//----------


//Inclusão do template do layout.
include_once $page->LayoutSistema;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>