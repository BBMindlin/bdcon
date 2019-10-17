<?php
//Definição de variáveis.
$IdTbFormularios = $includeFormularios_idTbFormularios;
$ConfigTipoDiagramacao = $includeFormularios_configTipoDiagramacao; //1 - nome do campo ao lado dos campos | 2 - nome do campo acima dos campos | 3 - nome do campo dentro dos campos

$flagFormulariosEmailsVerificar = false; //true - Existem e-mails de departamentos. | false - Não existem e-mails de departamentos.


//Verificação de erro - debug.
//echo "IdTbFormularios=" . $IdTbFormularios . "<br />";
//echo "ConfigTipoDiagramacao=" . $ConfigTipoDiagramacao . "<br />"; 
//echo "flagFormulariosEmailsVerificar=" . $flagFormulariosEmailsVerificar . "<br />";


//Query de pesquisa.
//----------
$strSqlFormulariosDetalhesSelect = "";
$strSqlFormulariosDetalhesSelect .= "SELECT ";
//$strSqlFormulariosDetalhesSelect .= "* ";
$strSqlFormulariosDetalhesSelect .= "id, ";
$strSqlFormulariosDetalhesSelect .= "id_tb_categorias, ";
$strSqlFormulariosDetalhesSelect .= "nome_formulario, ";
$strSqlFormulariosDetalhesSelect .= "assunto_formulario, ";
$strSqlFormulariosDetalhesSelect .= "nome_email_destinatario, ";
$strSqlFormulariosDetalhesSelect .= "email_destinatario, ";
$strSqlFormulariosDetalhesSelect .= "email_copia, ";
$strSqlFormulariosDetalhesSelect .= "config_mensagem_sucesso ";
$strSqlFormulariosDetalhesSelect .= "FROM tb_formularios ";
$strSqlFormulariosDetalhesSelect .= "WHERE id <> 0 ";
//$strSqlFormulariosDetalhesSelect .= "AND id_tb_categorias = :id_tb_categorias ";
$strSqlFormulariosDetalhesSelect .= "AND id = :id ";
//$strSqlFormulariosDetalhesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";


$statementFormulariosDetalhesSelect = $dbSistemaConPDO->prepare($strSqlFormulariosDetalhesSelect);

if ($statementFormulariosDetalhesSelect !== false)
{
	$statementFormulariosDetalhesSelect->execute(array(
		"id" => $IdTbFormularios
	));
}

//$resultadoFormulariosDetalhes = $dbSistemaConPDO->query($strSqlFormulariosDetalhesSelect);
$resultadoFormulariosDetalhes = $statementFormulariosDetalhesSelect->fetchAll();

if (empty($resultadoFormulariosDetalhes))
{
	//echo "Nenhum registro encontrado";
}else{
	foreach($resultadoFormulariosDetalhes as $linhaFormulariosDetalhes)
	{
		//Definição das variáveis de detalhes.
		$tbFormulariosId = $linhaFormulariosDetalhes['id'];
		$tbFormulariosIdTbCategorias = $linhaFormulariosDetalhes['id_tb_categorias'];
		$tbFormulariosNomeFormulario = Funcoes::ConteudoMascaraLeitura($linhaFormulariosDetalhes['nome_formulario']);
		$tbFormulariosAssuntoFormulario = Funcoes::ConteudoMascaraLeitura($linhaFormulariosDetalhes['assunto_formulario']);
		$tbFormulariosNomeEmailDestinatario = Funcoes::ConteudoMascaraLeitura($linhaFormulariosDetalhes['nome_email_destinatario']);
		$tbFormulariosEmailDestinatario = Funcoes::ConteudoMascaraLeitura($linhaFormulariosDetalhes['email_destinatario']);
		$tbFormulariosEmailCopia = Funcoes::ConteudoMascaraLeitura($linhaFormulariosDetalhes['email_copia']);
		$tbFormulariosConfigMensagemSucesso = Funcoes::ConteudoMascaraLeitura($linhaFormulariosDetalhes['config_mensagem_sucesso']);
		
		
		//Verificação de erro.
		//echo "tbFormulariosId=" . $tbFormulariosId . "<br>";
		//echo "tbFormulariosTitulo=" . $tbFormulariosTitulo . "<br>";
		//echo "tbFormulariosAtivacao=" . $tbFormulariosAtivacao . "<br>";
	}
}
?>
<?php if(!empty($resultadoFormulariosDetalhes)){ ?>
    <?php
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
			"id_tb_formularios" => $tbFormulariosId
		));
	}
	
	//$resultadoFormulariosCampos = $dbSistemaConPDO->query($strSqlFormulariosCamposSelect);
	$resultadoFormulariosCampos = $statementFormulariosCamposSelect->fetchAll();
	?>
    <?php if(!empty($resultadoFormulariosCampos)){ ?>
        <form name="form<?php echo $tbFormulariosId;?>" id="form<?php echo $tbFormulariosId;?>" action="SiteFormulariosExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <?php if($ConfigTipoDiagramacao == "1"){ ?>
                <div align="center">
                    <table border="0" cellspacing="1" cellpadding="4">
						<?php
						//Loop pelos resultados.
						foreach($resultadoFormulariosCampos as $linhaFormulariosCampos)
						{
                        ?>
                          <tr>
                            <td>
                                <div class="FormulariosTextoCampoNome">
									<?php if($linhaFormulariosCampos['tipo_campo'] <> 7 && $linhaFormulariosCampos['tipo_campo'] <> 8){ ?>
                                        <?php echo $linhaFormulariosCampos['nome_campo'];?>
                                    <?php } ?>
                                </div>
                            </td>
                            <td>
                            	<div align="left" class="FormulariosTexto">
									<?php //Campo de texto. ?>
                                    <?php if($linhaFormulariosCampos['tipo_campo'] == 1){ ?>
                                        <input type="text" id="<?php echo $linhaFormulariosCampos['nome_campo_formatado'];?>" name="<?php echo $linhaFormulariosCampos['nome_campo_formatado'];?>" size="<?php echo $linhaFormulariosCampos['tamanho_campo'];?>" class="FormulariosCampoTexto01" />
                                    <?php } ?>
            
                                    <?php //Área de texto. ?>
                                    <?php if($linhaFormulariosCampos['tipo_campo'] == 2){ ?>
                                        <textarea id="<?php echo $linhaFormulariosCampos['nome_campo_formatado'];?>" name="<?php echo $linhaFormulariosCampos['nome_campo_formatado'];?>" cols="<?php echo $linhaFormulariosCampos['tamanho_campo'];?>" rows="<?php echo $linhaFormulariosCampos['altura_campo'];?>" class="FormulariosCampoTextoMultilinha"></textarea>
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

                                        <?php
                                        }else{
                                        ?>
                                              <?php
                                                //Loop pelos resultados.
                                                foreach($resultadoFormulariosCamposOpcoes as $linhaFormulariosCamposOpcoes)
                                                {
                                              ?>
                                              	<div style="position: relative; display: block;">
                                                    <input type="checkbox" id="campo<?php echo $linhaFormulariosCampos['id'];?>" name="campo<?php echo $linhaFormulariosCampos['id'];?>" value="<?php echo Funcoes::ConteudoMascaraLeitura($linhaFormulariosCamposOpcoes['nome_opcao']);?>">
                                                    <?php echo Funcoes::ConteudoMascaraLeitura($linhaFormulariosCamposOpcoes['nome_opcao']);?>
                                              	</div>
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

                                        <?php
                                        }else{
                                        ?>
                                              <?php
                                                //Loop pelos resultados.
                                                foreach($resultadoFormulariosCamposOpcoes as $linhaFormulariosCamposOpcoes)
                                                {
                                              ?>
                                              	<div style="position: relative; display: block;">
                                                    <input type="radio" id="campo<?php echo $linhaFormulariosCampos['id'];?>" name="campo<?php echo $linhaFormulariosCampos['id'];?>" value="<?php echo Funcoes::ConteudoMascaraLeitura($linhaFormulariosCamposOpcoes['nome_opcao']);?>">
                                                    <?php echo Funcoes::ConteudoMascaraLeitura($linhaFormulariosCamposOpcoes['nome_opcao']);?>
                                                </div>
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
                                        <div class="FormulariosTextoInstrucao">
                                            <?php echo $linhaFormulariosCampos['nome_campo'];?>
                                        </div>
                                    <?php } ?>
                                    
                                    <?php //Subtítulo explicativo. ?>
                                    <?php if($linhaFormulariosCampos['tipo_campo'] == 8){ ?>
                                        <div class="FormulariosTextoSubtitulo">
                                            <?php echo $linhaFormulariosCampos['nome_campo'];?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </td>
                          </tr>
                        <?php } ?>
                    </table>
                </div>
            <?php } ?>
            
            <div align="center">
                <input type="image" name="submit" value="Submit" src="img/btoEnviar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sistemaBotaoAtualizar"); ?>" />
            	<input type="hidden" id="idTbFormularios" name="idTbFormularios" value="<?php echo $tbFormulariosId; ?>" />
            </div>
        </form>
    <?php } ?>
    <?php
	//Limpeza de objetos.
	//----------
	unset($strSqlFormulariosCamposSelect);
	unset($statementFormulariosCamposSelect);
	unset($resultadoFormulariosCampos);
	unset($linhaFormulariosCampos);
	//----------
	?>
<?php } ?>
<?php
//Limpeza de objetos.
//----------
unset($strSqlFormulariosDetalhesSelect);
unset($statementFormulariosDetalhesSelect);
unset($resultadoFormulariosDetalhes);
unset($linhaFormulariosDetalhes);
//----------
?>