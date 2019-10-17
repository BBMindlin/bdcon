<?php
//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeLayout.php";


//Verificação de login Master.
LoginAutenticacao::UsuarioLoginVerificacao();


//Resgate de variáveis.
$paginaRetorno = "DBCEPEstadosIndice.php";
$paginaRetornoExclusao = "DBCEPEstadosEditar.php";
$variavelRetorno = "";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];


//Montagem de query padrão de retorno.
$queryPadrao = "&paginaRetorno=" . $paginaRetorno . 
"&masterPageSelect=" . $masterPageSelect . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&variavelRetorno=" . $variavelRetorno . 
"&palavraChave=" . $palavraChave;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Query de pesquisa.
//----------
$strSqlDBCEPEstadosBrasilSelect = "";
$strSqlDBCEPEstadosBrasilSelect .= "SELECT ";
//$strSqlDBCEPEstadosBrasilSelect .= "* ";
$strSqlDBCEPEstadosBrasilSelect .= "Codigo, ";
$strSqlDBCEPEstadosBrasilSelect .= "Descricao ";
$strSqlDBCEPEstadosBrasilSelect .= "FROM tblUF ";
$strSqlDBCEPEstadosBrasilSelect .= "ORDER BY " . $GLOBALS['configClassificacaoDBCEPEstadosBrasil'] . " ";
//----------


//Parâmetros.
//----------
//$statementDBCEPEstadosBrasilSelect = $dbSistemaConPDO->prepare($strSqlDBCEPEstadosBrasilSelect);
$statementDBCEPEstadosBrasilSelect = $dbCEPConPDO->prepare($strSqlDBCEPEstadosBrasilSelect);

if ($statementDBCEPEstadosBrasilSelect !== false)
{
	/*
	$statementDBCEPEstadosBrasilSelect->execute(array(
		"id_tb_categorias" => $idParentDBCEPEstadosBrasil
	));
	
	if($idParentDBCEPEstadosBrasil <> "")
	{
		$statementDBCEPEstadosBrasilSelect->bindParam(':id_tb_categorias', $idParentDBCEPEstadosBrasil, PDO::PARAM_STR);
	}
	*/
	$statementDBCEPEstadosBrasilSelect->execute();
}
//----------

//$resultadoDBCEPEstadosBrasil = $dbSistemaConPDO->query($strSqlDBCEPEstadosBrasilSelect);
$resultadoDBCEPEstadosBrasil = $statementDBCEPEstadosBrasilSelect->fetchAll();

//Verificação de erro - debug.
//echo "paginacaoTotalRegistros=" . $paginacaoTotalRegistros . "<br />";
//echo "habilitarDBCEPEstadosBrasilSistemaPaginacao=" . $habilitarDBCEPEstadosBrasilSistemaPaginacao . "<br />";
//echo "strSqlDBCEPEstadosBrasilSelect=" . $strSqlDBCEPEstadosBrasilSelect . "<br />";
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
    	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaDBCEPTitulo"); ?>
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
	if (empty($resultadoDBCEPEstadosBrasil))
	{
        //echo "Nenhum registro encontrado";
    ?>
        <div align="center" class="TextoErro">
            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
        </div>
    <?php
    }else{
    ?>

        <form name="formDBCEPEstadosBrasilAcoes" id="formDBCEPEstadosBrasilAcoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input type="hidden" id="strTabela" name="strTabela" value="tblUF" />
            <input type="hidden" id="idParentDBCEPEstadosBrasil" name="idParentDBCEPEstadosBrasil" value="<?php echo $idParentDBCEPEstadosBrasil; ?>" />

            <input type="hidden" id="paginaRetorno" name="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            <input type="hidden" id="masterPageSelect" name="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
            <input type="hidden" id="paginacaoNumero" name="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input type="hidden" id="caracterAtual" name="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            <div style="position:relative; display: block; clear: both;">
                <div align="right" style="float: right;">
                    <input type="image" name="submit" value="Submit" src="img/btoExcluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoExcluir"); ?>">
                </div>
            </div>
            <table width="100%" class="TabelaDados01">
              <tr class="TbFundoEscuro">
                <td width="50" class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaLocalizacaoEstadoSigla"); ?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaLocalizacaoEstadosTitulo"); ?>
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
                foreach($resultadoDBCEPEstadosBrasil as $linhaDBCEPEstadosBrasil)
                {
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaDBCEPEstadosBrasil['Codigo'];?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
                        <a href="DBCEPCidadesIndice.php?idParentTblUF=<?php echo $linhaDBCEPEstadosBrasil['Codigo'];?><?php echo $queryPadrao;?>" class="Links01">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaDBCEPEstadosBrasil['Descricao']);?>
                        </a>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula" style="display: none;">
                    <div align="center" class="Texto01">

                    </div>
                </td>
                
                <td class="TabelaDados01Celula" style="display: none;">
                    <div align="center" class="Texto01">
                        <a href="DBCEPEstadosBrasilEditar.php?idTblUF=<?php echo $linhaDBCEPEstadosBrasil['Codigo'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula" style="display: none;">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaDBCEPEstadosBrasil['Codigo'];?>" class="CampoCheckBox01" />
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
unset($strSqlDBCEPEstadosBrasilSelect);
unset($statementDBCEPEstadosBrasilSelect);
unset($resultadoDBCEPEstadosBrasil);
unset($linhaDBCEPEstadosBrasil);
//----------


//Inclusão do template do layout.
include_once $page->LayoutSistema;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>