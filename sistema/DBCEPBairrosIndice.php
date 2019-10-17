<?php
//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeLayout.php";


//Verificação de login Master.
LoginAutenticacao::UsuarioLoginVerificacao();


//Resgate de variáveis.
$idParentTblCidades = $_GET["idParentTblCidades"];

$paginaRetorno = "DBCEPBairrosIndice.php";
$paginaRetornoExclusao = "DBCEPBairrosEditar.php";
$variavelRetorno = "";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];


//Montagem de query padrão de retorno.
$queryPadrao = "&idParentTblCidades=" . $idParentTblCidades . 
"&paginaRetorno=" . $paginaRetorno . 
"&masterPageSelect=" . $masterPageSelect . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&variavelRetorno=" . $variavelRetorno . 
"&palavraChave=" . $palavraChave;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Query de pesquisa.
//----------
$strSqlDBCEPBairrosBrasilSelect = "";
$strSqlDBCEPBairrosBrasilSelect .= "SELECT ";
//$strSqlDBCEPBairrosBrasilSelect .= "* ";
$strSqlDBCEPBairrosBrasilSelect .= "Codigo, ";
$strSqlDBCEPBairrosBrasilSelect .= "Descricao, ";
$strSqlDBCEPBairrosBrasilSelect .= "BairroAbreviado, ";
$strSqlDBCEPBairrosBrasilSelect .= "UF, ";
$strSqlDBCEPBairrosBrasilSelect .= "CodigoCidade ";
$strSqlDBCEPBairrosBrasilSelect .= "FROM tblBairros ";
if($idParentTblCidades <> "")
{
	$strSqlDBCEPBairrosBrasilSelect .= "WHERE CodigoCidade = :CodigoCidade ";
}
$strSqlDBCEPBairrosBrasilSelect .= "ORDER BY " . $GLOBALS['configClassificacaoDBCEPBairrosBrasil'] . " ";
//$strSqlDBCEPBairrosBrasilSelect .= "LIMIT 0, 10 "; //debug
//----------


//Parâmetros.
//----------
//$statementDBCEPBairrosBrasilSelect = $dbSistemaConPDO->prepare($strSqlDBCEPBairrosBrasilSelect);
$statementDBCEPBairrosBrasilSelect = $dbCEPConPDO->prepare($strSqlDBCEPBairrosBrasilSelect);

if ($statementDBCEPBairrosBrasilSelect !== false)
{
	/*
	$statementDBCEPBairrosBrasilSelect->execute(array(
		"id_tb_categorias" => $idParentDBCEPBairrosBrasil
	));
	*/
	if($idParentTblCidades <> "")
	{
		$statementDBCEPBairrosBrasilSelect->bindParam(':CodigoCidade', $idParentTblCidades, PDO::PARAM_STR);
	}
	$statementDBCEPBairrosBrasilSelect->execute();
}
//----------

//$resultadoDBCEPBairrosBrasil = $dbSistemaConPDO->query($strSqlDBCEPBairrosBrasilSelect);
$resultadoDBCEPBairrosBrasil = $statementDBCEPBairrosBrasilSelect->fetchAll();

//Verificação de erro - debug.
//echo "paginacaoTotalRegistros=" . $paginacaoTotalRegistros . "<br />";
//echo "habilitarDBCEPBairrosBrasilSistemaPaginacao=" . $habilitarDBCEPBairrosBrasilSistemaPaginacao . "<br />";
//echo "strSqlDBCEPBairrosBrasilSelect=" . $strSqlDBCEPBairrosBrasilSelect . "<br />";
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
    	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaDBCEPTitulo"); ?> - <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaLocalizacaoBairrosTitulo"); ?>
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
	if (empty($resultadoDBCEPBairrosBrasil))
	{
        //echo "Nenhum registro encontrado";
    ?>
        <div align="center" class="TextoErro">
            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
        </div>
    <?php
    }else{
    ?>
        <form name="formDBCEPBairrosBrasilAcoes" id="formDBCEPBairrosBrasilAcoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input type="hidden" id="strTabela" name="strTabela" value="tblBairros" />
            <input type="hidden" id="idParentTblCidades" name="idParentTblCidades" value="<?php echo $idParentTblCidades; ?>" />

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
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaLocalizacaoBairrosTitulo"); ?>
                    </div>
                </td>
                
                <td width="50" class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaLocalizacaoEstadoSigla"); ?>
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
                foreach($resultadoDBCEPBairrosBrasil as $linhaDBCEPBairrosBrasil)
                {
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaDBCEPBairrosBrasil['Codigo'];?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
                        <a href="DBCEPLogradourosIndice.php?idParentTblBairros=<?php echo $linhaDBCEPBairrosBrasil['Codigo'];?><?php echo $queryPadrao;?>" class="Links01">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaDBCEPBairrosBrasil['Descricao']);?>
                        </a>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaDBCEPBairrosBrasil['UF'];?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula" style="display: none;">
                    <div align="center" class="Texto01">

                    </div>
                </td>
                
                <td class="TabelaDados01Celula" style="display: none;">
                    <div align="center" class="Texto01">
                        <a href="DBCEPBairrosEditar.php?idTblBairros=<?php echo $linhaDBCEPBairrosBrasil['Codigo'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula" style="display: none;">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaDBCEPBairrosBrasil['Codigo'];?>" class="CampoCheckBox01" />
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
unset($strSqlDBCEPBairrosBrasilSelect);
unset($statementDBCEPBairrosBrasilSelect);
unset($resultadoDBCEPBairrosBrasil);
unset($linhaDBCEPBairrosBrasil);
//----------


//Inclusão do template do layout.
include_once $page->LayoutSistema;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>