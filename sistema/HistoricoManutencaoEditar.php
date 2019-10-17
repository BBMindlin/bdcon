<?php
//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeLayout.php";


//Verificação de login Master.
LoginAutenticacao::UsuarioLoginVerificacao();


//Resgate de variáveis.
$idTbHistoricoComplemento = $_GET["idTbHistoricoComplemento"];

$paginaRetorno = "HistoricoManutencao.php";
//$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];


//Montagem de query padrão de retorno.
$queryPadrao = "&paginaRetorno=" . $paginaRetorno;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Definição de variáveis.
//$tipoComplemento = 1;

//Query de pesquisa.
//----------
$strSqlHistoricoManutencaoDetalhesSelect = "";
$strSqlHistoricoManutencaoDetalhesSelect .= "SELECT ";
$strSqlHistoricoManutencaoDetalhesSelect .= "id, ";
$strSqlHistoricoManutencaoDetalhesSelect .= "tipo_complemento, ";
$strSqlHistoricoManutencaoDetalhesSelect .= "complemento, ";
$strSqlHistoricoManutencaoDetalhesSelect .= "descricao ";
$strSqlHistoricoManutencaoDetalhesSelect .= "FROM tb_historico_complemento ";
$strSqlHistoricoManutencaoDetalhesSelect .= "WHERE id <> 0 ";
//$strSqlHistoricoManutencaoDetalhesSelect .= "AND tipo_complemento = :tipo_complemento ";
$strSqlHistoricoManutencaoDetalhesSelect .= "AND id = :id ";
//$strSqlHistoricoManutencaoDetalhesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
//$strSqlHistoricoManutencaoDetalhesSelect .= "ORDER BY complemento";

$statementHistoricoManutencaoDetalhesSelect = $dbSistemaConPDO->prepare($strSqlHistoricoManutencaoDetalhesSelect);

if ($statementHistoricoManutencaoDetalhesSelect !== false)
{
	//"tipo_complemento" => $tipoComplemento
	$statementHistoricoManutencaoDetalhesSelect->execute(array(
		"id" => $idTbHistoricoComplemento
	));
}

//$resultadoHistoricoManutencao1 = $dbSistemaConPDO->query($strSqlHistoricoManutencao1Select);
$resultadoHistoricoManutencaoDetalhes = $statementHistoricoManutencaoDetalhesSelect->fetchAll();


if (empty($resultadoHistoricoManutencaoDetalhes))
{
	//echo "Nenhum registro encontrado";
}else{
	foreach($resultadoHistoricoManutencaoDetalhes as $linhaHistoricoManutencao)
	{
		//Definição das variáveis de detalhes.
		$tbHistoricoComplementoId = $linhaHistoricoManutencao['id'];
		$tbHistoricoComplementoTipoComplemento = $linhaHistoricoManutencao['tipo_complemento'];
		$tbHistoricoComplementoComplemento = Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao['complemento']);
		$tbHistoricoComplementoDescricao = Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao['descricao']);
		
		//Verificação de erro.
		//echo "id=" . $linhaCategorias['id'] . "<br>";
		//echo "id_parent=" . $linhaCategorias['id_parent'] . "<br>";
		//echo "categoria=" . Funcoes::ConteudoMascaraLeitura($linhaCategorias['categoria']) . "<br>";
		
		//echo "id=" . $tbCategoriasId . "<br>";
		//echo "id_parent=" . $tbCategoriasIdParent . "<br>";
		//echo "categoria=" . $tbCategoriasCategoria . "<br>";
	}
}

?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configNomeCliente'], "IncludeConfig"); ?>
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
    	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoTituloEditar"); ?>
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
    
    <form name="formHistoricoManutencao" id="formHistoricoManutencao" action="HistoricoManutencaoEditarExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <table class="TabelaCampos01">
            <tr>
                <td class="TbFundoEscuro" colspan="2">
                    <div align="center" class="Texto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoTbEditar"); ?>
                        </strong>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoComplemento"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro">
                    <div align="left">
                        <input type="text" name="complemento" id="complemento" class="CampoTexto01" maxlength="255" value="<?php echo $tbHistoricoComplementoComplemento;?>" />
                    </div>
                </td>
            </tr>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoManutencaoDescricao"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro">
                    <div>
                        <textarea name="descricao" id="descricao" class="CampoTextoMultilinha01"><?php echo $tbHistoricoComplementoDescricao;?></textarea>
                    </div>
                </td>
            </tr>
        </table>
        <div>
            <div style="float:left;">
                <input type="image" name="submit" value="Submit" src="img/btoAtualizar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoAtualizar"); ?>" />
                
                <input name="idTbHistoricoComplemento" type="hidden" id="idTbHistoricoComplemento" value="<?php echo $idTbHistoricoComplemento; ?>" />
                <input name="tipo_complemento" type="hidden" id="tipo_complemento" value="<?php echo $tbHistoricoComplementoTipoComplemento; ?>" />
                <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            </div>
            <div style="float:right;">
                <a href="<?php echo $paginaRetorno; ?>">
                    <img src="img/btoVoltar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoVoltar"); ?>"  />
                </a>
            </div>
        </div>
    </form>
    <br />

<?php 
$page->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php
//Limpeza de objetos.
//----------
unset($strSqlHistoricoManutencaoDetalhesSelect);
unset($statementHistoricoManutencaoDetalhesSelect);
unset($resultadoHistoricoManutencaoDetalhes);
unset($linhaHistoricoManutencaoDetalhes);
//----------
		

//Inclusão do template do layout.
include_once $page->LayoutSistema;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>