<?php
//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeLayout.php";


//Verificação de login Master.
LoginAutenticacao::UsuarioLoginVerificacao();


//Resgate de variáveis.
$idTbLogComplemento = $_GET["idTbLogComplemento"];

$paginaRetorno = "LogManutencao.php";
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
$strSqlLogManutencaoDetalhesSelect = "";
$strSqlLogManutencaoDetalhesSelect .= "SELECT ";
$strSqlLogManutencaoDetalhesSelect .= "id, ";
$strSqlLogManutencaoDetalhesSelect .= "tipo_complemento, ";
$strSqlLogManutencaoDetalhesSelect .= "complemento, ";
$strSqlLogManutencaoDetalhesSelect .= "descricao ";
$strSqlLogManutencaoDetalhesSelect .= "FROM tb_log_complemento ";
$strSqlLogManutencaoDetalhesSelect .= "WHERE id <> 0 ";
//$strSqlLogManutencaoDetalhesSelect .= "AND tipo_complemento = :tipo_complemento ";
$strSqlLogManutencaoDetalhesSelect .= "AND id = :id ";
//$strSqlLogManutencaoDetalhesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoLog'] . " ";
//$strSqlLogManutencaoDetalhesSelect .= "ORDER BY complemento";

$statementLogManutencaoDetalhesSelect = $dbSistemaConPDO->prepare($strSqlLogManutencaoDetalhesSelect);

if ($statementLogManutencaoDetalhesSelect !== false)
{
	//"tipo_complemento" => $tipoComplemento
	$statementLogManutencaoDetalhesSelect->execute(array(
		"id" => $idTbLogComplemento
	));
}

//$resultadoLogManutencao1 = $dbSistemaConPDO->query($strSqlLogManutencao1Select);
$resultadoLogManutencaoDetalhes = $statementLogManutencaoDetalhesSelect->fetchAll();


if (empty($resultadoLogManutencaoDetalhes))
{
	//echo "Nenhum registro encontrado";
}else{
	foreach($resultadoLogManutencaoDetalhes as $linhaLogManutencao)
	{
		//Definição das variáveis de detalhes.
		$tbLogComplementoId = $linhaLogManutencao['id'];
		$tbLogComplementoTipoComplemento = $linhaLogManutencao['tipo_complemento'];
		$tbLogComplementoComplemento = Funcoes::ConteudoMascaraLeitura($linhaLogManutencao['complemento']);
		$tbLogComplementoDescricao = Funcoes::ConteudoMascaraLeitura($linhaLogManutencao['descricao']);
		
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
	<?php echo $GLOBALS['configNomeCliente']; ?>
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
    	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaLogManutencaoTituloEditar"); ?>
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
    
    <form name="formLogManutencao" id="formLogManutencao" action="LogManutencaoEditarExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <table class="TabelaCampos01">
            <tr>
                <td class="TbFundoEscuro" colspan="2">
                    <div align="center" class="Texto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaLogManutencaoTbEditar"); ?>
                        </strong>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaLogManutencaoComplemento"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro">
                    <div align="left">
                        <input type="text" name="complemento" id="complemento" class="CampoTexto01" maxlength="255" value="<?php echo $tbLogComplementoComplemento;?>" />
                    </div>
                </td>
            </tr>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaLogManutencaoDescricao"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro">
                    <div>
                        <textarea name="descricao" id="descricao" class="CampoTextoMultilinha01"><?php echo $tbLogComplementoDescricao;?></textarea>
                    </div>
                </td>
            </tr>
        </table>
        <div>
            <div style="float:left;">
                <input type="image" name="submit" value="Submit" src="img/btoAtualizar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoAtualizar"); ?>" />
                
                <input name="idTbLogComplemento" type="hidden" id="idTbLogComplemento" value="<?php echo $idTbLogComplemento; ?>" />
                <input name="tipo_complemento" type="hidden" id="tipo_complemento" value="<?php echo $tbLogComplementoTipoComplemento; ?>" />
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
unset($strSqlLogManutencaoDetalhesSelect);
unset($statementLogManutencaoDetalhesSelect);
unset($resultadoLogManutencaoDetalhes);
unset($linhaLogManutencaoDetalhes);
//----------
		
		?>


<?php 
//Inclusão do template do layout.
include_once $page->LayoutSistema;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>