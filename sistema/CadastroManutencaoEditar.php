<?php
//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeLayout.php";


//Verificação de login Master.
LoginAutenticacao::UsuarioLoginVerificacao();


//Resgate de variáveis.
$idTbCadastroComplemento = $_GET["idTbCadastroComplemento"];

$paginaRetorno = "CadastroManutencao.php";
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
$strSqlCadastroManutencaoDetalhesSelect = "";
$strSqlCadastroManutencaoDetalhesSelect .= "SELECT ";
$strSqlCadastroManutencaoDetalhesSelect .= "id, ";
$strSqlCadastroManutencaoDetalhesSelect .= "tipo_complemento, ";
$strSqlCadastroManutencaoDetalhesSelect .= "complemento, ";
$strSqlCadastroManutencaoDetalhesSelect .= "descricao ";
$strSqlCadastroManutencaoDetalhesSelect .= "FROM tb_cadastro_complemento ";
$strSqlCadastroManutencaoDetalhesSelect .= "WHERE id <> 0 ";
//$strSqlCadastroManutencaoDetalhesSelect .= "AND tipo_complemento = :tipo_complemento ";
$strSqlCadastroManutencaoDetalhesSelect .= "AND id = :id ";
//$strSqlCadastroManutencaoDetalhesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
//$strSqlCadastroManutencaoDetalhesSelect .= "ORDER BY complemento";

$statementCadastroManutencaoDetalhesSelect = $dbSistemaConPDO->prepare($strSqlCadastroManutencaoDetalhesSelect);

if ($statementCadastroManutencaoDetalhesSelect !== false)
{
	//"tipo_complemento" => $tipoComplemento
	$statementCadastroManutencaoDetalhesSelect->execute(array(
		"id" => $idTbCadastroComplemento
	));
}

//$resultadoCadastroManutencao1 = $dbSistemaConPDO->query($strSqlCadastroManutencao1Select);
$resultadoCadastroManutencaoDetalhes = $statementCadastroManutencaoDetalhesSelect->fetchAll();


if (empty($resultadoCadastroManutencaoDetalhes))
{
	//echo "Nenhum registro encontrado";
}else{
	foreach($resultadoCadastroManutencaoDetalhes as $linhaCadastroManutencao)
	{
		//Definição das variáveis de detalhes.
		$tbCadastroComplementoId = $linhaCadastroManutencao['id'];
		$tbCadastroComplementoTipoComplemento = $linhaCadastroManutencao['tipo_complemento'];
		$tbCadastroComplementoComplemento = Funcoes::ConteudoMascaraLeitura($linhaCadastroManutencao['complemento']);
		$tbCadastroComplementoDescricao = Funcoes::ConteudoMascaraLeitura($linhaCadastroManutencao['descricao']);
		
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
    	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroManutencaoTituloEditar"); ?>
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
    
    <form name="formCadastroManutencao" id="formCadastroManutencao" action="CadastroManutencaoEditarExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <table class="TabelaCampos01">
            <tr>
                <td class="TbFundoEscuro" colspan="2">
                    <div align="center" class="Texto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroManutencaoTbEditar"); ?>
                        </strong>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroManutencaoComplemento"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro">
                    <div align="left">
                        <input type="text" name="complemento" id="complemento" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroComplementoComplemento;?>" />
                    </div>
                </td>
            </tr>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroManutencaoDescricao"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro">
                    <div>
                        <textarea name="descricao" id="descricao" class="CampoTextoMultilinha01"><?php echo $tbCadastroComplementoDescricao;?></textarea>
                    </div>
                </td>
            </tr>
        </table>
        <div>
            <div style="float:left;">
                <input type="image" name="submit" value="Submit" src="img/btoAtualizar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoAtualizar"); ?>" />
                
                <input name="idTbCadastroComplemento" type="hidden" id="idTbCadastroComplemento" value="<?php echo $idTbCadastroComplemento; ?>" />
                <input name="tipo_complemento" type="hidden" id="tipo_complemento" value="<?php echo $tbCadastroComplementoTipoComplemento; ?>" />
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
unset($strSqlCadastroManutencaoDetalhesSelect);
unset($statementCadastroManutencaoDetalhesSelect);
unset($resultadoCadastroManutencaoDetalhes);
unset($linhaCadastroManutencaoDetalhes);
//----------
		
		?>


<?php 
//Inclusão do template do layout.
include_once $page->LayoutSistema;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>