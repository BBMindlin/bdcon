<?php
//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeLayout.php";


//Verificação de login Master.
LoginAutenticacao::UsuarioLoginVerificacao();


//Resgate de variáveis.
$idTbFormularios = $_GET["idTbFormularios"];
$idParentCategoriasRaiz = $_GET["idParentCategoriasRaiz"];
if($idParentCategoriasRaiz == "")
{
	$idParentCategoriasRaiz = 0;
}

$paginaRetorno = "FormulariosCamposIndice.php";
$paginaRetornoExclusao = "FormulariosCamposEditar.php";
$variavelRetorno = "idTbFormularios";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];

//Montagem de query padrão de retorno.
$queryPadrao = "&idTbFormularios=" . $idTbFormularios . 
"&paginaRetorno=" . $paginaRetorno . 
"&masterPageSelect=" . $masterPageSelect . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&variavelRetorno=" . $variavelRetorno;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Query de pesquisa.
//----------
$strSqlFormulariosCamposSelect = "";
$strSqlFormulariosCamposSelect .= "SELECT ";
//$strSqlFormulariosCamposSelect .= "* ";
$strSqlFormulariosCamposSelect .= "id, ";
$strSqlFormulariosCamposSelect .= "id_tb_formularios, ";
$strSqlFormulariosCamposSelect .= "n_classificacao, ";
$strSqlFormulariosCamposSelect .= "nome_campo, ";
$strSqlFormulariosCamposSelect .= "nome_campo_formatado, ";
$strSqlFormulariosCamposSelect .= "tipo_campo, ";
$strSqlFormulariosCamposSelect .= "tamanho_campo, ";
$strSqlFormulariosCamposSelect .= "altura_campo, ";
$strSqlFormulariosCamposSelect .= "ativacao, ";
$strSqlFormulariosCamposSelect .= "obrigatorio ";
$strSqlFormulariosCamposSelect .= "FROM tb_formularios_campos ";
$strSqlFormulariosCamposSelect .= "WHERE id <> 0 ";
$strSqlFormulariosCamposSelect .= "AND id_tb_formularios = :id_tb_formularios ";
$strSqlFormulariosCamposSelect .= "ORDER BY " . $GLOBALS['configClassificacaoFormulariosCampos'] . " ";

$statementFormulariosCamposSelect = $dbSistemaConPDO->prepare($strSqlFormulariosCamposSelect);

if ($statementFormulariosCamposSelect !== false)
{
	$statementFormulariosCamposSelect->execute(array(
		"id_tb_formularios" => $idTbFormularios
	));
}

//$resultadoFormulariosCampos = $dbSistemaConPDO->query($strSqlFormulariosCamposSelect);
$resultadoFormulariosCampos = $statementFormulariosCamposSelect->fetchAll();
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistema"); ?> - <?php echo htmlentities($GLOBALS['configNomeCliente']); ?>
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
    	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFormulariosCamposTitulo"); ?>
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
	if (empty($resultadoFormulariosCampos))
	{
        //echo "Nenhum registro encontrado";
    ?>
        <div align="center" class="TextoErro">
            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
        </div>
    <?php
    }else{
    ?>

        <form name="formFormulariosCamposAcoes" id="formFormulariosCamposAcoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_formularios_campos" />
            <input name="idTbFormularios" id="idTbFormularios" type="hidden" value="<?php echo $idTbFormularios; ?>" />

            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            <input name="masterPageSelect" type="hidden" id="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
            <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            <div style="position:relative; display: block; clear: both;">
                <div align="right" style="float: right;">
                    <input type="image" name="submit" value="Submit" src="img/btoExcluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoExcluir"); ?>">
                </div>
            </div>
            <table width="100%" class="TabelaDados01">
              <tr class="TbFundoEscuro">
              	<?php if($GLOBALS['habilitarFormulariosCamposNClassificacao'] == 1){ ?>
                <td width="50" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNClassificacaoA"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <td width="200" class="TabelaDados01Celula">
                    <div class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFormulariosCamposNome"); ?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFormulariosCamposTipo"); ?>
                    </div>
                </td>
                
                <td width="100" class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFuncoes"); ?>
                    </div>
                </td>
                
                <?php if($GLOBALS['habilitarFormulariosCamposObrigatorio'] == 1){ ?>
                <td width="30" class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFormulariosCamposObrigatorio"); ?>
                    </div>
                </td>
                <?php } ?>

                <td width="30" class="TabelaDados01Celula">
                    <div align="center" align="center" class="Texto02">
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
                foreach($resultadoFormulariosCampos as $linhaFormulariosCampos)
                {
              ?>
              <tr class="TbFundoClaro">
              	<?php if($GLOBALS['habilitarFormulariosCamposNClassificacao'] == 1){ ?>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaFormulariosCampos['n_classificacao'];?>
                    </div>
                </td>
                <?php } ?>
                
                <td class="TabelaDados01Celula">
                    <div align="left" class="Texto01">
						<?php if($linhaFormulariosCampos['tipo_campo'] <> 7 && $linhaFormulariosCampos['tipo_campo'] <> 8){ ?>
                            <?php echo $linhaFormulariosCampos['nome_campo'];?>
                        <?php } ?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
                    	<?php //Campo de texto. ?>
						<?php if($linhaFormulariosCampos['tipo_campo'] == 1){ ?>
                        	<input type="text" id="<?php echo $linhaFormulariosCampos['nome_campo_formatado'];?>" name="<?php echo $linhaFormulariosCampos['nome_campo_formatado'];?>" size="<?php echo $linhaFormulariosCampos['tamanho_campo'];?>" class="CampoTextoFormularios01" />
                        <?php } ?>

                    	<?php //Área de texto. ?>
						<?php if($linhaFormulariosCampos['tipo_campo'] == 2){ ?>
                        	<textarea id="<?php echo $linhaFormulariosCampos['nome_campo_formatado'];?>" name="<?php echo $linhaFormulariosCampos['nome_campo_formatado'];?>" cols="<?php echo $linhaFormulariosCampos['tamanho_campo'];?>" rows="<?php echo $linhaFormulariosCampos['altura_campo'];?>" class="CampoTextoMultilinhaFormularios"></textarea>
                        <?php } ?>
                        
                    	<?php //Check box. ?>
						<?php if($linhaFormulariosCampos['tipo_campo'] == 3){ ?>
                        	<?php
							//Query de pesquisa.
							//----------
							$strSqlFormulariosCamposOpcoesSelect = "";
							$strSqlFormulariosCamposOpcoesSelect .= "SELECT ";
							//$strSqlFormulariosCamposOpcoesSelect .= "* ";
							$strSqlFormulariosCamposOpcoesSelect .= "id, ";
							$strSqlFormulariosCamposOpcoesSelect .= "id_tb_formularios_campos, ";
							$strSqlFormulariosCamposOpcoesSelect .= "n_classificacao, ";
							$strSqlFormulariosCamposOpcoesSelect .= "nome_opcao, ";
							$strSqlFormulariosCamposOpcoesSelect .= "nome_opcao_formatado, ";
							$strSqlFormulariosCamposOpcoesSelect .= "arquivo ";
							$strSqlFormulariosCamposOpcoesSelect .= "FROM tb_formularios_campos_opcoes ";
							$strSqlFormulariosCamposOpcoesSelect .= "WHERE id <> 0 ";
							$strSqlFormulariosCamposOpcoesSelect .= "AND id_tb_formularios_campos = :id_tb_formularios_campos ";
							$strSqlFormulariosCamposOpcoesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoFormulariosOpcoes'] . " ";
							
							$statementFormulariosCamposOpcoesSelect = $dbSistemaConPDO->prepare($strSqlFormulariosCamposOpcoesSelect);
							
							if ($statementFormulariosCamposOpcoesSelect !== false)
							{
								$statementFormulariosCamposOpcoesSelect->execute(array(
									"id_tb_formularios_campos" => $linhaFormulariosCampos['id']
								));
							}
							
							//$resultadoFormulariosCamposOpcoes = $dbSistemaConPDO->query($strSqlFormulariosCamposOpcoesSelect);
							$resultadoFormulariosCamposOpcoes = $statementFormulariosCamposOpcoesSelect->fetchAll();
							?>
                            
							<?php
                            if (empty($resultadoFormulariosCamposOpcoes))
                            {
                                //echo "Nenhum registro encontrado";
                            ?>
                                <div>
                                	<input type="checkbox" id="campo<?php echo $linhaFormulariosCampos['id'];?>" name="campo<?php echo $linhaFormulariosCampos['id'];?>" value="">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFormulariosCamposOpcoesVazioAletaEditar"); ?>
                                </div>
                            <?php
                            }else{
                            ?>
								  <?php
                                    //Loop pelos resultados.
                                    foreach($resultadoFormulariosCamposOpcoes as $linhaFormulariosCamposOpcoes)
                                    {
                                  ?>
                                      <input type="checkbox" id="campo<?php echo $linhaFormulariosCampos['id'];?>" name="campo<?php echo $linhaFormulariosCampos['id'];?>" value="<?php echo Funcoes::ConteudoMascaraLeitura($linhaFormulariosCamposOpcoes['nome_opcao']);?>">
                                      <?php echo Funcoes::ConteudoMascaraLeitura($linhaFormulariosCamposOpcoes['nome_opcao']);?>
								  <?php } ?>
                            <?php } ?>
                            
                        	<?php
							//Limpeza de objetos.
							//----------
							unset($strSqlFormulariosCamposOpcoesSelect);
							unset($statementFormulariosCamposOpcoesSelect);
							unset($resultadoFormulariosCamposOpcoes);
							unset($linhaFormulariosCamposOpcoes);
							//----------
							?>
                        <?php } ?>
                        
                    	<?php //Radio button. ?>
						<?php if($linhaFormulariosCampos['tipo_campo'] == 4){ ?>
                        	<?php
							//Query de pesquisa.
							//----------
							$strSqlFormulariosCamposOpcoesSelect = "";
							$strSqlFormulariosCamposOpcoesSelect .= "SELECT ";
							//$strSqlFormulariosCamposOpcoesSelect .= "* ";
							$strSqlFormulariosCamposOpcoesSelect .= "id, ";
							$strSqlFormulariosCamposOpcoesSelect .= "id_tb_formularios_campos, ";
							$strSqlFormulariosCamposOpcoesSelect .= "n_classificacao, ";
							$strSqlFormulariosCamposOpcoesSelect .= "nome_opcao, ";
							$strSqlFormulariosCamposOpcoesSelect .= "nome_opcao_formatado, ";
							$strSqlFormulariosCamposOpcoesSelect .= "arquivo ";
							$strSqlFormulariosCamposOpcoesSelect .= "FROM tb_formularios_campos_opcoes ";
							$strSqlFormulariosCamposOpcoesSelect .= "WHERE id <> 0 ";
							$strSqlFormulariosCamposOpcoesSelect .= "AND id_tb_formularios_campos = :id_tb_formularios_campos ";
							$strSqlFormulariosCamposOpcoesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoFormulariosOpcoes'] . " ";
							
							$statementFormulariosCamposOpcoesSelect = $dbSistemaConPDO->prepare($strSqlFormulariosCamposOpcoesSelect);
							
							if ($statementFormulariosCamposOpcoesSelect !== false)
							{
								$statementFormulariosCamposOpcoesSelect->execute(array(
									"id_tb_formularios_campos" => $linhaFormulariosCampos['id']
								));
							}
							
							//$resultadoFormulariosCamposOpcoes = $dbSistemaConPDO->query($strSqlFormulariosCamposOpcoesSelect);
							$resultadoFormulariosCamposOpcoes = $statementFormulariosCamposOpcoesSelect->fetchAll();
							?>
                            
							<?php
                            if (empty($resultadoFormulariosCamposOpcoes))
                            {
                                //echo "Nenhum registro encontrado";
                            ?>
                                <div>
                                	<input type="checkbox" id="campo<?php echo $linhaFormulariosCampos['id'];?>" name="campo<?php echo $linhaFormulariosCampos['id'];?>" value="">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFormulariosCamposOpcoesVazioAletaEditar"); ?>
                                </div>
                            <?php
                            }else{
                            ?>
								  <?php
                                    //Loop pelos resultados.
                                    foreach($resultadoFormulariosCamposOpcoes as $linhaFormulariosCamposOpcoes)
                                    {
                                  ?>
                                    <input type="radio" id="campo<?php echo $linhaFormulariosCampos['id'];?>" name="campo<?php echo $linhaFormulariosCampos['id'];?>" value="<?php echo Funcoes::ConteudoMascaraLeitura($linhaFormulariosCamposOpcoes['nome_opcao']);?>">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($linhaFormulariosCamposOpcoes['nome_opcao']);?>
                                  <?php } ?>
                            
                            <?php } ?>
                            
                        	<?php
							//Limpeza de objetos.
							//----------
							unset($strSqlFormulariosCamposOpcoesSelect);
							unset($statementFormulariosCamposOpcoesSelect);
							unset($resultadoFormulariosCamposOpcoes);
							unset($linhaFormulariosCamposOpcoes);
							//----------
							?>
                        <?php } ?>
                        
                    	<?php //DropDownMenu. ?>
						<?php if($linhaFormulariosCampos['tipo_campo'] == 5){ ?>
                        
                        	<?php
							//Query de pesquisa.
							//----------
							$strSqlFormulariosCamposOpcoesSelect = "";
							$strSqlFormulariosCamposOpcoesSelect .= "SELECT ";
							//$strSqlFormulariosCamposOpcoesSelect .= "* ";
							$strSqlFormulariosCamposOpcoesSelect .= "id, ";
							$strSqlFormulariosCamposOpcoesSelect .= "id_tb_formularios_campos, ";
							$strSqlFormulariosCamposOpcoesSelect .= "n_classificacao, ";
							$strSqlFormulariosCamposOpcoesSelect .= "nome_opcao, ";
							$strSqlFormulariosCamposOpcoesSelect .= "nome_opcao_formatado, ";
							$strSqlFormulariosCamposOpcoesSelect .= "arquivo ";
							$strSqlFormulariosCamposOpcoesSelect .= "FROM tb_formularios_campos_opcoes ";
							$strSqlFormulariosCamposOpcoesSelect .= "WHERE id <> 0 ";
							$strSqlFormulariosCamposOpcoesSelect .= "AND id_tb_formularios_campos = :id_tb_formularios_campos ";
							$strSqlFormulariosCamposOpcoesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoFormulariosOpcoes'] . " ";
							
							$statementFormulariosCamposOpcoesSelect = $dbSistemaConPDO->prepare($strSqlFormulariosCamposOpcoesSelect);
							
							if ($statementFormulariosCamposOpcoesSelect !== false)
							{
								$statementFormulariosCamposOpcoesSelect->execute(array(
									"id_tb_formularios_campos" => $linhaFormulariosCampos['id']
								));
							}
							
							//$resultadoFormulariosCamposOpcoes = $dbSistemaConPDO->query($strSqlFormulariosCamposOpcoesSelect);
							$resultadoFormulariosCamposOpcoes = $statementFormulariosCamposOpcoesSelect->fetchAll();
							?>
                            
							<?php
                            if (empty($resultadoFormulariosCamposOpcoes))
                            {
                                //echo "Nenhum registro encontrado";
                            ?>
                                <div>
                                    <select id="<?php echo $linhaFormulariosCampos['nome_campo_formatado'];?>" name="<?php echo $linhaFormulariosCampos['nome_campo_formatado'];?>" class="CampoDropDownMenu01">
                                        <option value=""></option>
                                    </select>
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFormulariosCamposOpcoesVazioAletaEditar"); ?>
                                </div>
                            <?php
                            }else{
                            ?>
                                <select id="<?php echo $linhaFormulariosCampos['nome_campo_formatado'];?>" name="<?php echo $linhaFormulariosCampos['nome_campo_formatado'];?>" class="CampoDropDownMenu01">
								  <?php
                                    //Loop pelos resultados.
                                    foreach($resultadoFormulariosCamposOpcoes as $linhaFormulariosCamposOpcoes)
                                    {
                                  ?>
                                      <option value="<?php echo Funcoes::ConteudoMascaraLeitura($linhaFormulariosCamposOpcoes['nome_opcao']);?>"><?php echo Funcoes::ConteudoMascaraLeitura($linhaFormulariosCamposOpcoes['nome_opcao']);?></option>
                                  <?php } ?>
                                </select>
                                
                            <?php } ?>
                            
                        	<?php
							//Limpeza de objetos.
							//----------
							unset($strSqlFormulariosCamposOpcoesSelect);
							unset($statementFormulariosCamposOpcoesSelect);
							unset($resultadoFormulariosCamposOpcoes);
							unset($linhaFormulariosCamposOpcoes);
							//----------
							?>
                        
                        <?php } ?>
                        
                    	<?php //Texto explicativo. ?>
						<?php if($linhaFormulariosCampos['tipo_campo'] == 7){ ?>
                        	<div class="ConteudoTexto">
								<?php echo $linhaFormulariosCampos['nome_campo'];?>
                            </div>
                        <?php } ?>
                        
                    	<?php //Subtítulo explicativo. ?>
						<?php if($linhaFormulariosCampos['tipo_campo'] == 8){ ?>
                        	<div class="ConteudoSubtitulo">
								<?php echo $linhaFormulariosCampos['nome_campo'];?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                    	<?php if($linhaFormulariosCampos['tipo_campo'] == 3 || $linhaFormulariosCampos['tipo_campo'] == 4 || $linhaFormulariosCampos['tipo_campo'] == 5){ ?>
                            <a href="FormulariosCamposOpcoesIndice.php?idTbFormulariosCampos=<?php echo $linhaFormulariosCampos['id'];?><?php echo $queryPadrao; ?>" target="_blank" class="Links01">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFormulariosCamposInserirOpcoes"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
                
                <?php if($GLOBALS['habilitarFormulariosCamposObrigatorio'] == 1){ ?>
                <td class="<?php if($linhaFormulariosCampos['obrigatorio'] == 0){/*echo "TbFundoClaro";*/}else{echo "TbFundoDesativado";}?> TabelaDados01Celula">
                    <div align="center" class="Texto01">
                    	<a href="RegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaFormulariosCampos['id'];?>&statusAtivacao=<?php echo $linhaFormulariosCampos['obrigatorio'];?>&strTabela=tb_formularios_campos&strCampo=obrigatorio<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="Links01">
                        	<?php if($linhaFormulariosCampos['obrigatorio'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFormulariosCamposObrigatorio0"); ?>
                            <?php } ?>
                        	<?php if($linhaFormulariosCampos['obrigatorio'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFormulariosCamposObrigatorio1"); ?>
                            <?php } ?>
                        </a>
						<?php //echo $linhaFormulariosCampos['ativacao'];?>
                    </div>
                </td>
                <?php } ?>
                
                <td class="<?php if($linhaFormulariosCampos['ativacao'] == 1){/*echo "TbFundoClaro";*/}else{echo "TbFundoDesativado";}?> TabelaDados01Celula">
                    <div align="center" class="Texto01">
                    	<a href="RegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaFormulariosCampos['id'];?>&statusAtivacao=<?php echo $linhaFormulariosCampos['ativacao'];?>&strTabela=tb_formularios_campos&strCampo=ativacao<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="Links01">
                        	<?php if($linhaFormulariosCampos['ativacao'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao0"); ?>
                            <?php } ?>
                        	<?php if($linhaFormulariosCampos['ativacao'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao1"); ?>
                            <?php } ?>
                        </a>
						<?php //echo $linhaFormulariosCampos['ativacao'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="FormulariosCamposEditar.php?idTbFormulariosCampos=<?php echo $linhaFormulariosCampos['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaFormulariosCampos['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
	<?php } ?>
    
	<script type="text/javascript">
		$(document).ready(function () {
		
			//Validação de formulário (JQuery).
			//**************************************************************************************
			$('#formFormulariosCampos').validate({ //Inicialização do plug-in.
			
			
				//Estilo da mensagem de erro.
				//----------------------
				errorClass: "TextoErro",
				//----------------------
				
				
				//Validação
				//----------------------
				rules: {
					n_classificacao: {
						required: true,
						//regex: /-?\d+(\.\d{1,3})?/
						number: true
					}//,
					//field2: {
						//required: true,
						//minlength: 5
					//}
				},
				
				
				//Mensagens.
				//----------------------
				messages: {
					//n_classificacao: "Please specify your name"//,
					n_classificacao: {
					  //required: "Campo obrigatório.",
					  required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica2"); ?>",
					  //regex: "Campo numérico."
					  //number: "Campo numérico."
					  number: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica1"); ?>"
					}
				},		
				//----------------------
				
				
				/*
				errorPlacement: function(error, element) {
					if(element.attr("name") == "n_classificacao")
					{
						error.insertAfter(".nomedadiv");
					}
					else if  (element.attr("name") == "phone" )
						error.insertAfter(".some-other-class");
					else
						error.insertAfter(element);
				}
				*/
			});
			//**************************************************************************************

		});	
	</script>
    <form name="formFormulariosCampos" id="formFormulariosCampos" action="FormulariosCamposIndiceExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <table class="TabelaCampos01">
            <tr>
                <td class="TbFundoEscuro" colspan="4">
                    <div align="center" class="Texto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFormulariosCamposTbCampos"); ?>
                        </strong>
                    </div>
                </td>
            </tr>
            
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFormulariosCamposNome"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula"<?php if($GLOBALS['habilitarFormulariosCamposNClassificacao'] <> "1"){ ?> colspan="3"<?php } ?>>
                    <div align="left">
                        <input type="text" name="nome_campo" id="nome_campo" class="CampoTexto01" maxlength="255" />
                    </div>
                </td>
				<?php if($GLOBALS['habilitarFormulariosCamposNClassificacao'] == 1){ ?>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNClassificacao"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaColuna01 TabelaCampos01Celula">
                    <div>
                        <input type="text" name="n_classificacao" id="n_classificacao" class="CampoNumerico01" maxlength="10" value="0" />
                    </div>
                </td>
                <?php } ?>
            </tr>
            
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFormulariosCamposTipo"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left">
                        <table width="100%" border="0" cellpadding="0" cellspacing="1">
                            <tr>
                                <td width="50" class="TbFundoMedio">
                                    <div align="center" class="Texto01">
                                        <strong>
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFormulariosCamposSelecao"); ?>
                                        </strong>
                                    </div>
                                </td>
                                <td class="TbFundoMedio">
                                    <div align="left" class="Texto01">
                                        <strong>
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFormulariosCamposExemplo"); ?>
                                        </strong>
                                    </div>
                                </td>
                                <td class="TbFundoMedio">
                                    <div align="left" class="Texto01">
                                        <strong>
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFormulariosCamposDescricao"); ?>
                                        </strong>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div align="center">
                                        <input type="radio" name="tipo_campo" value="1" checked="checked" />
                                    </div>
                                </td>
                                <td width="200">
                                    <input name="exemplo" type="text" class="CampoTexto01" size="40" />
                                </td>
                                <td>
                                    <div align="left" class="Texto01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFormulariosCamposDescricaoCaixaTexto"); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div align="center">
                                        <input type="radio" name="tipo_campo" value="2" />
                                    </div>
                                </td>
                                <td>
                                    <textarea name="exemplo" cols="30" rows="3" class="CampoTextoMultilinhaConteudo"></textarea>
                                </td>
                                <td>
                                    <div align="left" class="Texto01">
                                    	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFormulariosCamposDescricaoAreaTexto"); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div align="center">
                                        <input type="radio" name="tipo_campo" value="3" />
                                    </div>
                                </td>
                                <td>
                                    <input name="exemplo" type="checkbox"value="exemplo" />
                                </td>
                                <td>
                                    <div align="left" class="Texto01">
                                    	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFormulariosCamposDescricaoCheckBox"); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div align="center">
                                        <input type="radio" name="tipo_campo" value="4" />
                                    </div>
                                </td>
                                <td>
                                    <input type="radio" name="exemplo" value="exemplo" />
                                </td>
                                <td>
                                    <div align="left" class="Texto01">
                                    	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFormulariosCamposDescricaoRadio"); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div align="center">
                                        <input type="radio" name="tipo_campo" value="5" />
                                    </div>
                                </td>
                                <td>
                                    <select name="exemplo" class="CampoDropDownMenu01" id="exemplo">
                                        <option selected="selected"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFormulariosCamposDescricaoDropDown01"); ?></option>
                                        <option><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFormulariosCamposDescricaoDropDown02"); ?></option>
                                        <option><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFormulariosCamposDescricaoDropDown03"); ?></option>
                                    </select>
                                </td>
                                <td>
                                    <div align="left" class="Texto01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFormulariosCamposDescricaoDropDown"); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div align="center">
                                        <input type="radio" name="tipo_campo" value="7" />
                                    </div>
                                </td>
                                <td>
                                    <div align="left" class="ConteudoTexto">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFormulariosCamposDescricaoTexto"); ?>
                                    </div>
                                </td>
                                <td>
                                    <div align="left" class="Texto01">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div align="center">
                                        <input type="radio" name="tipo_campo" value="8" />
                                    </div>
                                </td>
                                <td>
                                    <div align="left" class="ConteudoSubtitulo">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFormulariosCamposDescricaoSubtitulo"); ?>
                                    </div>
                                </td>
                                <td>
                                    <div align="left" class="Texto01">
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
            
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFormulariosCamposTamanho"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left">
                        <input type="text" name="tamanho_campo" id="tamanho_campo" class="CampoNumerico01" maxlength="255" value="60" />
                    </div>
                </td>
            </tr>
            
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFormulariosCamposAltura"); ?>
                        <br />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFormulariosCamposAlturaObs"); ?>
                        :
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left">
                        <input type="text" name="altura_campo" id="altura_campo" class="CampoNumerico01" maxlength="255" value="5" />
                    </div>
                </td>
            </tr>
            
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao3"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left" class="Texto01">
                        <select name="ativacao" id="ativacao" class="CampoDropDownMenu01">
                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao4"); ?></option>
                            <option value="1" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao5"); ?></option>
                        </select>
                    </div>
                </td>
            </tr>
            
			<?php if($GLOBALS['habilitarFormulariosCamposObrigatorio'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFormulariosCamposObrigatorio"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left" class="Texto01">
                        <select name="obrigatorio" id="obrigatorio" class="CampoDropDownMenu01">
                            <option value="0" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFormulariosCamposObrigatorio0"); ?></option>
                            <option value="1"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFormulariosCamposObrigatorio1"); ?></option>
                        </select>
                    </div>
                </td>
            </tr>
			<?php } ?>
        </table>
         
        <div>
            <div style="float:left;">
                <input type="image" name="submit" value="Submit" src="img/btoIncluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoIncluir"); ?>" />
                
                <input name="id_tb_formularios" type="hidden" id="id_tb_formularios" value="<?php echo $idTbFormularios; ?>" />
                <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                <input name="masterPageSelect" type="hidden" id="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
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
unset($strSqlFormulariosCamposSelect);
unset($statementFormulariosCamposSelect);
unset($resultadoFormulariosCampos);
unset($linhaFormulariosCampos);
//----------
?>


<?php 
//Inclusão do template do layout.
include_once $page->LayoutSistema;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>