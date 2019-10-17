<?php
//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeLayout.php";


//Verificação de login Master.
LoginAutenticacao::UsuarioLoginVerificacao();


//Resgate de variáveis.
$idParentTblUF = $_GET["idParentTblUF"];

$paginaRetorno = "DBCEPCidadesIndice.php";
$paginaRetornoExclusao = "DBCEPCidadesEditar.php";
$variavelRetorno = "";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];


//Montagem de query padrão de retorno.
$queryPadrao = "&idTblUF=" . $idTblUF . 
"&paginaRetorno=" . $paginaRetorno . 
"&masterPageSelect=" . $masterPageSelect . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&variavelRetorno=" . $variavelRetorno . 
"&palavraChave=" . $palavraChave;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Query de pesquisa.
//----------
$strSqlDBCEPCidadesBrasilSelect = "";
$strSqlDBCEPCidadesBrasilSelect .= "SELECT ";
//$strSqlDBCEPCidadesBrasilSelect .= "* ";
$strSqlDBCEPCidadesBrasilSelect .= "Codigo, ";
$strSqlDBCEPCidadesBrasilSelect .= "Descricao, ";
$strSqlDBCEPCidadesBrasilSelect .= "Descricao_B, ";
$strSqlDBCEPCidadesBrasilSelect .= "CEP, ";
$strSqlDBCEPCidadesBrasilSelect .= "UF, ";
$strSqlDBCEPCidadesBrasilSelect .= "SITUACAO, ";
$strSqlDBCEPCidadesBrasilSelect .= "TIPO_LOCALIDADE, ";
$strSqlDBCEPCidadesBrasilSelect .= "LOC_NU_SEQUENCIAL_SUB ";
$strSqlDBCEPCidadesBrasilSelect .= "FROM tblCidades ";
if($idParentTblUF <> "")
{
	$strSqlDBCEPCidadesBrasilSelect .= "WHERE UF = :UF ";
}
$strSqlDBCEPCidadesBrasilSelect .= "ORDER BY " . $GLOBALS['configClassificacaoDBCEPCidadesBrasil'] . " ";
//----------


//Parâmetros.
//----------
//$statementDBCEPCidadesBrasilSelect = $dbSistemaConPDO->prepare($strSqlDBCEPCidadesBrasilSelect);
$statementDBCEPCidadesBrasilSelect = $dbCEPConPDO->prepare($strSqlDBCEPCidadesBrasilSelect);

if ($statementDBCEPCidadesBrasilSelect !== false)
{
	/*
	$statementDBCEPCidadesBrasilSelect->execute(array(
		"id_tb_categorias" => $idParentDBCEPCidadesBrasil
	));
	*/
	if($idParentTblUF <> "")
	{
		$statementDBCEPCidadesBrasilSelect->bindParam(':UF', $idParentTblUF, PDO::PARAM_STR);
	}
	$statementDBCEPCidadesBrasilSelect->execute();
}
//----------

//$resultadoDBCEPCidadesBrasil = $dbSistemaConPDO->query($strSqlDBCEPCidadesBrasilSelect);
$resultadoDBCEPCidadesBrasil = $statementDBCEPCidadesBrasilSelect->fetchAll();

//Verificação de erro - debug.
//echo "paginacaoTotalRegistros=" . $paginacaoTotalRegistros . "<br />";
//echo "habilitarDBCEPCidadesBrasilSistemaPaginacao=" . $habilitarDBCEPCidadesBrasilSistemaPaginacao . "<br />";
//echo "strSqlDBCEPCidadesBrasilSelect=" . $strSqlDBCEPCidadesBrasilSelect . "<br />";
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
    	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaDBCEPTitulo"); ?> - <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaLocalizacaoCidadesTitulo"); ?>
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
	if (empty($resultadoDBCEPCidadesBrasil))
	{
        //echo "Nenhum registro encontrado";
    ?>
        <div align="center" class="TextoErro">
            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
        </div>
    <?php
    }else{
    ?>
        <form name="formDBCEPCidadesBrasilAcoes" id="formDBCEPCidadesBrasilAcoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input type="hidden" id="strTabela" name="strTabela" value="tblCidades" />
            <input type="hidden" id="idParentDBCEPCidadesBrasil" name="idParentDBCEPCidadesBrasil" value="<?php echo $idParentDBCEPCidadesBrasil; ?>" />

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
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaLocalizacaoCidadesTitulo"); ?>
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
                foreach($resultadoDBCEPCidadesBrasil as $linhaDBCEPCidadesBrasil)
                {
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaDBCEPCidadesBrasil['Codigo'];?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
                        <a href="DBCEPBairrosIndice.php?idParentTblCidades=<?php echo $linhaDBCEPCidadesBrasil['Codigo'];?><?php echo $queryPadrao;?>" class="Links01">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaDBCEPCidadesBrasil['Descricao']);?>
                        </a>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaDBCEPCidadesBrasil['UF'];?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo Funcoes::FormatarCEPLer($linhaDBCEPCidadesBrasil['CEP']);?>
                    </div>
                </td>

                <td class="TabelaDados01Celula" style="display: none;">
                    <div align="center" class="Texto01">

                    </div>
                </td>
                
                <td class="TabelaDados01Celula" style="display: none;">
                    <div align="center" class="Texto01">
                        <a href="DBCEPCidadesBrasilEditar.php?idTblCidades=<?php echo $linhaDBCEPCidadesBrasil['Codigo'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula" style="display: none;">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaDBCEPCidadesBrasil['Codigo'];?>" class="CampoCheckBox01" />
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
unset($strSqlDBCEPCidadesBrasilSelect);
unset($statementDBCEPCidadesBrasilSelect);
unset($resultadoDBCEPCidadesBrasil);
unset($linhaDBCEPCidadesBrasil);
//----------


//Inclusão do template do layout.
include_once $page->LayoutSistema;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>