<?php
//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
//require_once "IncludeUsuarioVerificacao.php";
require_once "IncludeLayout.php";


//Verificação de login Master.
LoginAutenticacao::UsuarioMasterLoginVerificacao();


//Resgate de variáveis.
$idTbUsuarios = $_GET["idTbUsuarios"];

$paginaRetorno = "UsuariosIndice.php";
$paginaRetornoExclusao = "UsuariosEditar.php";
//$variavelRetorno = "idTbUsuarios";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];


//Montagem de query padrão de retorno.
//"&idTbCadastroUsuario=" . $idTbCadastroUsuario . 
//"&variavelRetorno=" . $variavelRetorno
$queryPadrao = "&paginaRetorno=" . $paginaRetorno . "&paginaRetornoExclusao=" . $paginaRetornoExclusao;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Query de pesquisa.
//----------
$strSqlUsuariosDetalhesSelect = "";
$strSqlUsuariosDetalhesSelect .= "SELECT ";
$strSqlUsuariosDetalhesSelect .= "id, ";
$strSqlUsuariosDetalhesSelect .= "nome, ";
$strSqlUsuariosDetalhesSelect .= "usuario, ";
$strSqlUsuariosDetalhesSelect .= "senha, ";
$strSqlUsuariosDetalhesSelect .= "email, ";
$strSqlUsuariosDetalhesSelect .= "obs, ";
$strSqlUsuariosDetalhesSelect .= "usuario_data, ";
$strSqlUsuariosDetalhesSelect .= "usuario_tipo, ";
$strSqlUsuariosDetalhesSelect .= "ativacao ";
$strSqlUsuariosDetalhesSelect .= "FROM tb_usuarios ";
$strSqlUsuariosDetalhesSelect .= "WHERE id <> 0 ";
//$strSqlUsuariosDetalhesSelect .= "AND id_tb_categorias = :id_tb_categorias ";
$strSqlUsuariosDetalhesSelect .= "AND id = :id ";
//$strSqlUsuariosDetalhesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";


$statementUsuariosDetalhesSelect = $dbSistemaConPDO->prepare($strSqlUsuariosDetalhesSelect);

if ($statementUsuariosDetalhesSelect !== false)
{
	$statementUsuariosDetalhesSelect->execute(array(
		"id" => $idTbUsuarios
	));
}

//$resultadoUsuariosDetalhes = $dbSistemaConPDO->query($strSqlUsuariosDetalhesSelect);
$resultadoUsuariosDetalhes = $statementUsuariosDetalhesSelect->fetchAll();


if (empty($resultadoUsuariosDetalhes))
{
	//echo "Nenhum registro encontrado";
}else{
	foreach($resultadoUsuariosDetalhes as $linhaUsuariosDetalhes)
	{
		//Definição das variáveis de detalhes.
		$tbUsuariosId = $linhaUsuariosDetalhes['id'];
		$tbUsuariosNome = Funcoes::ConteudoMascaraLeitura($linhaUsuariosDetalhes['nome']);
		$tbUsuariosUsuario = Funcoes::ConteudoMascaraLeitura($linhaUsuariosDetalhes['usuario']);
		
		//$tbUsuariosSenha = Funcoes::ConteudoMascaraLeitura($linhaUsuariosDetalhes['usuario']);
		if($GLOBALS['configCadastroMetodoSenha'] == 1){
			$tbUsuariosSenha = "";
        }
		
		if($GLOBALS['configCadastroMetodoSenha'] == 2){
        	if($GLOBALS['configCadastroSenha'] == 1){
            	$tbUsuariosSenha = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura($linhaUsuariosDetalhes['senha'], 2), 2);
            }
        }
		
		$tbUsuariosEmail = $linhaUsuariosDetalhes['email'];
		$tbUsuariosOBS = Funcoes::ConteudoMascaraLeitura($linhaUsuariosDetalhes['obs']);
		$tbUsuariosUsuarioData = $linhaUsuariosDetalhes['usuario_data'];
		$tbUsuariosUsuarioTipo = $linhaUsuariosDetalhes['usuario_tipo'];
		$tbUsuariosAtivacao = $linhaUsuariosDetalhes['ativacao'];
		//Verificação de erro.
		//echo "tbCadastroId=" . $tbUsuariosId . "<br>";
		//echo "tbCadastroNome=" . $tbUsuariosNome . "<br>";
	}
}
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistema"); ?> - <?php echo htmlentities($GLOBALS['configNomeCliente']); ?> - <?php echo htmlentities($GLOBALS['sistemaUsuarios']); ?>
<?php 
$page->cphTitle = ob_get_clean(); 
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
    	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaUsuariosEditar"); ?>
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
    
    <form name="formUsuariosEditar" id="formUsuariosEditar" action="UsuariosEditarExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <table class="TabelaCampos01">
            <tr>
                <td class="TbFundoEscuro" colspan="4">
                    <div align="center" class="Texto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaUsuariosEditar"); ?>
                        </strong>
                    </div>
                </td>
            </tr>
            
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaUsuariosNome"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro">
                    <div align="left">
                        <input type="text" name="nome" id="nome" class="CampoTexto01" maxlength="255" value="<?php echo $tbUsuariosNome; ?>" />
                    </div>
                </td>
            </tr>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaUsuariosUsuario"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro">
                    <div align="left">
                        <input type="text" name="usuario" id="usuario" class="CampoTexto01" maxlength="255" value="<?php echo $tbUsuariosUsuario; ?>" />
                    </div>
                </td>
            </tr>

            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaUsuariosSenha"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro">
                    <div align="left">
                        <input type="password" name="senha" id="senha" class="CampoTexto01" maxlength="255" value="<?php echo $tbUsuariosSenha; ?>" />
                    </div>
                </td>
            </tr>
            
         </table>
         
        <div>
            <div style="float:left;">
                <input type="image" name="submit" value="Submit" src="img/btoAtualizar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoAtualizar"); ?>" />
                
                <input name="idTbUsuarios" type="hidden" id="idTbUsuarios" value="<?php echo $tbUsuariosId; ?>" />
                <input name="usuario_tipo" type="hidden" id="usuario_tipo" value="<?php echo $tbUsuariosUsuarioTipo; ?>" />
                <input name="ativacao" type="hidden" id="ativacao" value="<?php echo $tbUsuariosAtivacao; ?>" />
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
unset($strSqlUsuariosDetalhesSelect);
unset($statementUsuariosDetalhesSelect);
unset($resultadoUsuariosDetalhes);
unset($linhaUsuariosDetalhes);
//----------
?>


<?php 
//Inclusão do template do layout.
include_once $page->LayoutSistema;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>