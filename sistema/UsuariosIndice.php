<?php
//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeUsuarioVerificacao.php";
//require_once "IncludeUsuarioMasterVerificacao.php";
require_once "IncludeLayout.php";


//Verificação de login Master.
LoginAutenticacao::UsuarioMasterLoginVerificacao();


//Resgate de variáveis.
$paginaRetorno = "UsuariosIndice.php";
$paginaRetornoExclusao = "UsuariosEditar.php";
//$variavelRetorno = "idParentUsuarios";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];


//Montagem de query padrão de retorno.
//$queryPadrao = "&paginaRetorno=" . $paginaRetorno . "&paginaRetornoExclusao=" . $paginaRetornoExclusao . "&variavelRetorno=" . $variavelRetorno;
$queryPadrao = "&paginaRetorno=" . $paginaRetorno . "&paginaRetornoExclusao=" . $paginaRetornoExclusao;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Query de pesquisa.
//----------
$strSqlUsuariosSelect = "";
$strSqlUsuariosSelect .= "SELECT ";
//$strSqlUsuariosSelect .= "* ";
$strSqlUsuariosSelect .= "id, ";
$strSqlUsuariosSelect .= "nome, ";
$strSqlUsuariosSelect .= "usuario, ";
$strSqlUsuariosSelect .= "senha, ";
$strSqlUsuariosSelect .= "email, ";
$strSqlUsuariosSelect .= "obs, ";
$strSqlUsuariosSelect .= "usuario_data, ";
$strSqlUsuariosSelect .= "usuario_tipo, ";
$strSqlUsuariosSelect .= "ativacao ";
$strSqlUsuariosSelect .= "FROM tb_usuarios ";
$strSqlUsuariosSelect .= "WHERE id <> 0 ";
$strSqlUsuariosSelect .= "AND id <> 1 "; //Usuário padrão do sistema (ASP.NET).
$strSqlUsuariosSelect .= "AND id <> 2 "; //Usuário padrão PHP (MCrypt PHP library).
$strSqlUsuariosSelect .= "AND id <> 3 "; //Usuário padrão (md5).
$strSqlUsuariosSelect .= "AND id <> 4 "; //Usuário padrão (Defuse php-encryption).
$strSqlUsuariosSelect .= "ORDER BY " . $GLOBALS['configClassificacaoUsuariosSistema'] . " ";

$statementUsuariosSelect = $dbSistemaConPDO->prepare($strSqlUsuariosSelect);

/*
"id" => $id
*/
if ($statementUsuariosSelect !== false)
{
	$statementUsuariosSelect->execute(array(
		
	));
}

//$resultadoUsuarios = $dbSistemaConPDO->query($strSqlUsuariosSelect);
$resultadoUsuarios = $statementUsuariosSelect->fetchAll();


//Verificação de erro - debug.
//echo "cookie=" . $_COOKIE[$GLOBALS['configNomeCookie'] . "_" . $GLOBALS['configSessionNomeUsuarioMaster']] . "<br>";
//echo "cookie(decrypt)=" . $tbUsuariosSenha = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura($_COOKIE[$GLOBALS['configNomeCookie'] . "_" . $GLOBALS['configSessionNomeUsuarioMaster']], 2), 2) . "<br>";
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistema"); ?> - <?php echo htmlentities($GLOBALS['configNomeCliente']); ?> - <?php echo htmlentities($GLOBALS['sistemaUsuarios']); ?>
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
    	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaUsuariosGerenciamento"); ?>
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
	if (empty($resultadoUsuarios))
	{
        //echo "Nenhum registro encontrado";
    ?>
        <div align="center" class="TextoErro">
            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
        </div>
    <?php
    }else{
    ?>
        <form name="formUsuariosAcoes" id="formUsuariosAcoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_usuarios" />
            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            
            <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            <div style="position:relative; display: block; clear: both;">
                <div align="right" style="float: right;">
                    <input type="image" name="submit" value="Submit" src="img/btoExcluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoExcluir"); ?>">
                </div>
            </div>
            <table width="100%" class="TabelaDados01">
              <tr class="TbFundoEscuro">
                
                <td class="TabelaDados01Celula">
                    <div class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaUsuariosNome"); ?>
                    </div>
                </td>
                <td width="200" class="TabelaDados01Celula">
                    <div class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaUsuariosUsuario"); ?>
                    </div>
                </td>
                <td width="200" class="TabelaDados01Celula">
                    <div class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaUsuariosSenha"); ?>
                    </div>
                </td>
                
              	<?php if($GLOBALS['ativacaoUsuariosSistemaTipo'] == 1){ ?>
                <td width="100" class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaUsuariosUsuarioTipo"); ?>
                    </div>
                </td>
                <?php } ?>

                <td width="30" class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao"); ?>
                    </div>
                </td>
                
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemExcluir"); ?>
                    </div>
                </td>
              </tr>
              <?php
                //Loop pelos resultados.
                foreach($resultadoUsuarios as $linhaUsuarios)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
                

                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaUsuarios['nome']);?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo $linhaUsuarios['usuario'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php if($GLOBALS['configUsuariosMetodoSenha'] == 1){ ?>
                            *****
                        <?php } ?>
                    
						<?php if($GLOBALS['configUsuariosMetodoSenha'] == 2){ ?>
                            <?php if($GLOBALS['configUsuariosSenha'] == 1){ ?>
                                <?php //echo Crypto::DecryptValue(EncryptValue(Funcoes::ConteudoMascaraLeitura($linhaUsuarios['senha']), 2), 2);?>
                                <?php echo Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura($linhaUsuarios['senha'], 2), 2);?>
                            <?php } ?>
                        <?php } ?>
						<?php 
							//echo "senha=" . $linhaUsuarios['senha'] . "<br/>";
							//md5
							//echo "md5=" . Crypto::EncryptValue(Funcoes::ConteudoMascaraGravacao01($linhaUsuarios['senha']), 1) . "<br/>";
						?>
                    </div>
                </td>
                
              	<?php if($GLOBALS['ativacaoUsuariosSistemaTipo'] == 1){ ?>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
						<?php echo $linhaUsuarios['usuario_tipo'];?>
                    </div>
                </td>
                <?php } ?>
                
                <td class="<?php if($linhaUsuarios['ativacao'] == 1){/*echo "TbFundoClaro";*/}else{echo "TbFundoDesativado";}?> TabelaDados01Celula">
                    <div align="center" class="Texto01">
                    	<a href="RegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaUsuarios['id'];?>&statusAtivacao=<?php echo $linhaUsuarios['ativacao'];?>&strTabela=tb_usuarios&strCampo=ativacao<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="Links01">
                        	<?php if($linhaUsuarios['ativacao'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao0"); ?>
                            <?php } ?>
                        	<?php if($linhaUsuarios['ativacao'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao1"); ?>
                            <?php } ?>
                        </a>
						<?php //echo $linhaCategorias['ativacao'];?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="UsuariosEditar.php?idTbUsuarios=<?php echo $linhaUsuarios['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaUsuarios['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
            <?php } ?>
            </table>
        </form>
	<?php } ?>
    
    
    <form name="formUsuarios" id="formUsuarios" action="UsuariosIndiceExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <table class="TabelaCampos01">
            <tr>
                <td class="TbFundoEscuro" colspan="4">
                    <div align="center" class="Texto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaUsuariosTbUsuarios"); ?>
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
                        <input type="text" name="nome" id="nome" class="CampoTexto01" maxlength="255" />
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
                        <input type="text" name="usuario" id="usuario" class="CampoTexto01" maxlength="255" />
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
                        <input type="password" name="senha" id="senha" class="CampoTexto01" maxlength="255" />
                    </div>
                </td>
            </tr>
            
         </table>
         
        <div>
            <div style="float:left;">
                <input type="image" name="submit" value="Submit" src="img/btoIncluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoIncluir"); ?>" />
                <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            </div>
            <div style="float:right;">
                &nbsp;
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
unset($strSqlUsuariosSelect);
unset($statementUsuariosSelect);
unset($resultadoUsuarios);
unset($linhaUsuarios);
//----------
?>


<?php 
//Inclusão do template do layout.
include_once $page->LayoutSistema;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>