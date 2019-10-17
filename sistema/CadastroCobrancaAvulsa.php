<?php
//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeLayout.php";


//Verificação de login Master.
LoginAutenticacao::UsuarioLoginVerificacao();


//Resgate de variáveis.
$idTbCadastro = $_GET["idTbCadastro"];
//$idParentCadastro = DbFuncoes::GetCampoGenerico01($idTbCadastro, "tb_cadastro", "id_tb_categorias");

$idCePedidos = $_GET["idCePedidos"];
if($idCePedidos == "")
{
	$idCePedidos = ContadorUniversal::ContadorUniversalUpdate(1);
	
	//Criação de registro de pedido.
	if(Pedidos::PedidosInsert($idCePedidos, 
							$idTbCadastro, 
							"0", 
							"0", 
							NULL, 
							"0", 
							"0", 
							"0", 
							"", 
							"0", 
							"0", 
							"0", 
							"0", 
							"", 
							"0") == true)
	{
		
	}
}

//$itensValorTotal = "0";
$itensValorTotal = 0;

$paginaRetorno = "CadastroCobrancaAvulsa.php";
$paginaRetornoExclusao = "CadastroCobrancaAvulsa.php";
$variavelRetorno = "idTbCadastro";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];


//Montagem de query padrão de retorno.
$queryPadrao = "&idTbCadastro=" . $idTbCadastro . 
"&idCePedidos=" . $idCePedidos . 
"&paginaRetorno=" . $paginaRetorno . 
"&masterPageSelect=" . $masterPageSelect . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&variavelRetorno=" . $variavelRetorno;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Verificação de erro - debug.
//echo "paginacaoTotalRegistros=" . $paginacaoTotalRegistros . "<br />";
//echo "idParentPedidos=" . $idParentPedidos . "<br />";
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php //echo Funcoes::GetCadastroTitulo($tbCadastroNome, $tbCadastroRazaoSocial, $tbCadastroNomeFantasia, 1); ?>
	<?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($idTbCadastro, "tb_cadastro", "nome"), DbFuncoes::GetCampoGenerico01($idTbCadastro, "tb_cadastro", "razao_social"), DbFuncoes::GetCampoGenerico01($idTbCadastro, "tb_cadastro", "nome_fantasia"), 1)); ?>
     - 
    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPedidosTituloEditar"); ?> 
     - 
    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistema"); ?> 
     - 
	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configNomeCliente'], "IncludeConfig"); ?>
<?php 
$page->cphTitle = ob_get_clean(); 
?>
<?php //**************************************************************************************?>


<?php //Cabeçalho.?>
<?php //**************************************************************************************?>
<?php ob_start(); /*cphConteudoCabecalho*/ ?>
    <div>
        <div align="left" class="TextoTitulo01">
            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPedidosTituloEditar"); ?>
        </div>
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
	//Query de pesquisa.
	//----------
	$strSqlPedidosItensSelect = "";
	$strSqlPedidosItensSelect .= "SELECT ";
	//$strSqlPedidosItensSelect .= "* ";
	$strSqlPedidosItensSelect .= "id, ";
	$strSqlPedidosItensSelect .= "id_ce_pedidos, ";
	$strSqlPedidosItensSelect .= "id_tb_cadastro_cliente, ";
	$strSqlPedidosItensSelect .= "id_tb_cadastro_usuario, ";
	$strSqlPedidosItensSelect .= "id_item, ";
	$strSqlPedidosItensSelect .= "cod_item, ";
	$strSqlPedidosItensSelect .= "descricao, ";
	$strSqlPedidosItensSelect .= "tabela, ";
	$strSqlPedidosItensSelect .= "quantidade, ";
	$strSqlPedidosItensSelect .= "valor_unitario, ";
	$strSqlPedidosItensSelect .= "id_tb_itens_valores, ";
	$strSqlPedidosItensSelect .= "id_tb_itens_valores_titulo, ";
	$strSqlPedidosItensSelect .= "id_tb_itens_data, ";
	$strSqlPedidosItensSelect .= "valor_total, ";
	$strSqlPedidosItensSelect .= "ids_opcionais, ";
	$strSqlPedidosItensSelect .= "ids_opcionais_descricao, ";
	$strSqlPedidosItensSelect .= "obs, ";
	
	$strSqlPedidosItensSelect .= "informacao_complementar1, ";
	$strSqlPedidosItensSelect .= "informacao_complementar2, ";
	$strSqlPedidosItensSelect .= "informacao_complementar3, ";
	$strSqlPedidosItensSelect .= "informacao_complementar4, ";
	$strSqlPedidosItensSelect .= "informacao_complementar5, ";
	
	$strSqlPedidosItensSelect .= "ativacao, ";
	$strSqlPedidosItensSelect .= "data_pedido, ";
	$strSqlPedidosItensSelect .= "data_pagamento, ";
	$strSqlPedidosItensSelect .= "data_entrega, ";
	$strSqlPedidosItensSelect .= "data_validade, ";
	$strSqlPedidosItensSelect .= "id_tb_produtos_complemento_status ";
	
	$strSqlPedidosItensSelect .= "FROM ce_itens ";
	$strSqlPedidosItensSelect .= "WHERE id <> 0 ";
	if($idCePedidos <> "")
	{
		$strSqlPedidosItensSelect .= "AND id_ce_pedidos = :id_ce_pedidos ";
	}
	
	//$strSqlPedidosItensSelect .= "ORDER BY " . $GLOBALS['configClassificacaoPedidosItens'] . " ";
	//if($GLOBALS['habilitarPedidosItensClassificacaoPersonalizada'] == 1 and DbFuncoes::GetCampoGenerico04("classificacao", "criterio_classificacao", "id_registro", $idParentPedidosItens) <> "")
	//{
		//$strSqlPedidosItensSelect .= "ORDER BY " . DbFuncoes::GetCampoGenerico04("classificacao", "criterio_classificacao", "id_registro", $idParentPedidosItens) . " ";
		
	//}else{
		$strSqlPedidosItensSelect .= "ORDER BY " . $GLOBALS['configClassificacaoItens'] . " ";
	//}
	
	
	$statementPedidosItensSelect = $dbSistemaConPDO->prepare($strSqlPedidosItensSelect);
	
	if ($statementPedidosItensSelect !== false)
	{
		if($idCePedidos <> "")
		{
			$statementPedidosItensSelect->bindParam(':id_ce_pedidos', $idCePedidos, PDO::PARAM_STR);
		}
		$statementPedidosItensSelect->execute();
		
		/*
		$statementPedidosItensSelect->execute(array(
			"id_parent" => $idParentPedidosItens
		));
		*/
	}
	
	//$resultadoPedidosItens = $dbSistemaConPDO->query($strSqlPedidosItensSelect);
	$resultadoPedidosItens = $statementPedidosItensSelect->fetchAll();
    ?>
    <?php
	if (empty($resultadoPedidosItens))
	{
        //echo "Nenhum registro encontrado";
    ?>
        <div align="center" class="TextoErro">
            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
        </div>
    <?php
    }else{
    ?>

        <form name="formPedidosItensAcoes" id="formPedidosItensAcoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="ce_itens" />
            <input name="idTbCadastro" id="idTbCadastro" type="hidden" value="<?php echo $idTbCadastro; ?>" />
            <input name="idCePedidos" id="idCePedidos" type="hidden" value="<?php echo $idCePedidos; ?>" />

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
                <?php if($GLOBALS['ativacaoProdutosImagens'] == 1){ ?>
                <td width="1" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemImagem"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <td width="100" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPedidosItensCodigo"); ?>
                    </div>
                </td>
                
                <td class="TbFundoEscuro TabelaDados01Celula">
                    <div class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPedidosItensDescricao"); ?>
                    </div>
                </td>
                
                <td width="40" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                    	<strong>
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPedidosItensQuantidade"); ?>
                        </strong>
                    </div>
                </td>
                
                <td width="100" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                    	<strong>
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPedidosItensValorUnitario"); ?>
                        </strong>
                    </div>
                </td>
                
                <td width="100" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                    	<strong>
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPedidosItensValorTotal"); ?>
                        </strong>
                    </div>
                </td>
                
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
                foreach($resultadoPedidosItens as $linhaPedidosItens)
                {
              ?>
              <tr class="TbFundoClaro">
              	<?php if($GLOBALS['ativacaoProdutosImagens'] == 1){ ?>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                    	<?php //Imagem - Produtos. ?>
                    	<?php //---------- ?>
							<?php
							$ceItensImagem = "";
							$ceItensImagem = DbFuncoes::GetCampoGenerico01($linhaPedidosItens['id_item'], "tb_produtos", "imagem");
                            ?>
                            <?php //if(!empty($ceItensImagem)){ ?>
                            <?php if($ceItensImagem <> ""){ ?>
                                <?php //Sem pop-up. ?>
                                <?php if($GLOBALS['configImagemPopUp'] == 0){ ?>
                                    <img src="<?php echo $GLOBALS['configDiretorioArquivos'];?>/t<?php echo $ceItensImagem;?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaPedidosItens['descricao']); ?>" />
                                <?php } ?>
                            
                                <?php //SlimBox 2 - JQuery. ?>
                                <?php if($GLOBALS['configImagemPopUp'] == 1){ ?>
                                    <a href="<?php echo $GLOBALS['configDiretorioArquivos'];?>/g<?php echo $ceItensImagem;?>" rel="lightbox" title="<?php echo Funcoes::ConteudoMascaraLeitura($linhaPedidosItens['descricao']); ?>">
                                        <img src="<?php echo $GLOBALS['configDiretorioArquivos'];?>/t<?php echo $ceItensImagem;?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaPedidosItens['descricao']); ?>" />
                                    </a>
                                <?php } ?>
                            <?php } ?>
                    	<?php //---------- ?>
                    </div>
                </td>
                <?php } ?>

                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaPedidosItens['cod_item'];?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
                    	<?php echo Funcoes::ConteudoMascaraLeitura($linhaPedidosItens['descricao']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaPedidosItens['quantidade'];?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>
                        <?php echo Funcoes::MascaraValorLer($linhaPedidosItens['valor_unitario'], $GLOBALS['configSistemaMoeda']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>
                        <?php echo Funcoes::MascaraValorLer($linhaPedidosItens['valor_total'], $GLOBALS['configSistemaMoeda']);?>
						
						<?php 
                        //Contabilizado.
                        //----------------------
						$itensValorTotal = $itensValorTotal + $linhaPedidosItens['valor_total'];
                        //----------------------
						?>
                    </div>
                </td>
                
                <td class="<?php if($linhaPedidosItens['ativacao'] == 1){/*echo "TbFundoClaro";*/}else{echo "TbFundoDesativado";}?> TabelaDados01Celula">
                    <div align="center" class="Texto01">
                    	<a href="RegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaPedidosItens['id'];?>&statusAtivacao=<?php echo $linhaPedidosItens['ativacao'];?>&strTabela=ce_itens&strCampo=ativacao<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="Links01">
                        	<?php if($linhaPedidosItens['ativacao'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao0"); ?>
                            <?php } ?>
                        	<?php if($linhaPedidosItens['ativacao'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao1"); ?>
                            <?php } ?>
                        </a>
						<?php //echo $linhaPaginas['ativacao'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="PedidosItensEditar.php?idCeItens=<?php echo $linhaPedidosItens['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaPedidosItens['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
	<?php } ?>
    <?php
	//Limpeza de objetos.
	//----------
	unset($strSqlPedidosItensSelect);
	unset($statementPedidosItensSelect);
	unset($resultadoPedidosItens);
	unset($linhaPedidosItens);
	//----------
	?>
    
    
	<?php //Subtotal. ?>
	<?php //---------- ?>
    <div class="Texto01" align="right">
        <div>
            <strong>
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPedidosItensValorSubtotal"); ?>: 
            </strong>
            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>
            <?php echo Funcoes::MascaraValorLer($itensValorTotal, $GLOBALS['configSistemaMoeda']);?>
            <?php //echo $valorSaldo; ?>
        </div>
    </div>
	<?php //---------- ?>
    
    
	<?php //Produtos - inclusão - dropdown. ?>
	<?php //**************************************************************************************?>
	<?php 
    $arrProdutosSelect = DbFuncoes::VinculoGenericoSelect02("0", "0", "tb_produtos", "id_tb_categorias", "produto", $GLOBALS['configClassificacaoPedidosCobrancaAvulsaProdutos'], "1");
    
	//Verificação de erro - debug.
	//echo "arrProdutosSelect[1]=" . $arrProdutosSelect[0][0] . "<br />";
    ?>
    <?php if(!empty($arrProdutosSelect)){ ?>
        <div class="Texto01" style="position: relative; display: block; margin-top: 10px;">
            <form name="formPedidosItens" id="formPedidosItens" action="PedidosItensExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
                <table class="TabelaCampos01">
                    <tr>
                        <td class="TbFundoEscuro" colspan="4">
                            <div align="center" class="Texto02">
                                <strong>
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPedidosItensProdutosIncluir"); ?>
                                </strong>
                            </div>
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="TbFundoMedio TabelaColuna01">
                            <div align="left" class="Texto01">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaProduto"); ?>:
                            </div>
                        </td>
                        <td class="TbFundoClaro TabelaCampos01Celula">
                            <div align="left">
                                <select name="id_item" id="id_item" class="CampoDropDownMenu01">
                                    <!--option value="0" selected="selected"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNenhumDropDown"); ?></option-->
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrProdutosSelect); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrProdutosSelect[$countArray][0];?>"><?php echo $arrProdutosSelect[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            </div>
                        </td>
        
                        <td class="TbFundoMedio TabelaColuna01">
                            <div align="left" class="Texto01">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPedidosItensQuantidade"); ?>:
                            </div>
                        </td>
                        <td class="TbFundoClaro TabelaColuna01 TabelaCampos01Celula">
                            <div>
                                <input type="text" name="quantidade" id="quantidade" class="CampoNumerico01" maxlength="10" value="1" />
                            </div>
                        </td>
                    </tr>
                    
                    <?php if($GLOBALS['habilitarProdutosValor'] == 0){ ?>
                    <tr>
                        <td class="TbFundoMedio TabelaColuna01">
                            <div align="left" class="Texto01">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPedidosItensValorUnitario"); ?>:
                            </div>
                        </td>
                        <td class="TbFundoClaro" colspan="3">
                            <div class="Texto01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>
                                <input type="text" name="valor_unitario" id="valor_unitario" class="CampoNumerico02" maxlength="255" value="<?php echo Funcoes::MascaraValorLer("0", $GLOBALS['configSistemaMoeda']); ?>" />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemValorDescicao01"); ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                    
                    <tr>
                        <td class="TbFundoMedio TabelaColuna01">
                            <div align="left" class="Texto01">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPedidosItensOBS"); ?>:
                            </div>
                        </td>
                        <td class="TbFundoClaro" colspan="3">
                            <div align="left" class="Texto01">
                                <textarea name="obs" id="obs" class="CampoTextoMultilinha01"></textarea>
                            </div>
                        </td>
                    </tr>
        
                </table>
                 
                <div>
                    <div style="float:left;">
                        <input type="image" name="submit" value="Submit" src="img/btoIncluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoIncluir"); ?>" />
                        
                        <input name="id_ce_pedidos" type="hidden" id="id_ce_pedidos" value="<?php echo $idCePedidos; ?>" />
                        <input name="id_tb_cadastro_cliente" type="hidden" id="id_tb_cadastro_cliente" value="<?php echo $idTbCadastro; ?>" />
                        <input name="id_tb_cadastro_usuario" type="hidden" id="id_tb_cadastro_usuario" value="0" />
                        <!--input name="id_item" type="hidden" id="id_item" value="0" /-->
                        <input name="tabela" type="hidden" id="tabela" value="tb_produtos" />
                        <input name="informacao_complementar1" type="hidden" id="informacao_complementar1" value="" />
                        <input name="informacao_complementar2" type="hidden" id="informacao_complementar2" value="" />
                        <input name="informacao_complementar3" type="hidden" id="informacao_complementar3" value="" />
                        <input name="informacao_complementar4" type="hidden" id="informacao_complementar4" value="" />
                        <input name="informacao_complementar5" type="hidden" id="informacao_complementar5" value="" />
                        <input name="ativacao" type="hidden" id="ativacao" value="0" />
                        
                        
                        <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                        <input name="masterPageSelect" type="hidden" id="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
                        
                    </div>
                    <div style="float:right;">
                        &nbsp;
                    </div>
                </div>
            </form>
            <br />
        </div>
	<?php } ?>
	<?php //**************************************************************************************?>
    
    
	<?php //Inclusão de item avulso. ?>
	<?php //**************************************************************************************?>
	<?php if($GLOBALS['habilitarPedidosInclusaoItemAvulso'] == "1"){ ?>
    <div class="Texto01" style="position: relative; display: block; margin-top: 10px;">
	<script type="text/javascript">
		$(document).ready(function () {
			
			/*
			$.validator.addMethod(
					"alphabetsOnly",
					function(value, element, regexp) {
						var re = new RegExp(regexp);
						return this.optional(element) || re.test(value);
					},
					"Please check your input values again!!!."
			);
			*/
			//Parâmetro personalizado.
			//**************************************************************************************
			jQuery.validator.addMethod("accept", function(value, element, param) {
				//return value.match(new RegExp("^" + param + "$"));
				return value.match(new RegExp(param));
			});	
			//**************************************************************************************

				
			//Validação de formulário (JQuery).
			//**************************************************************************************
			$('#formPedidosItens').validate({ //Inicialização do plug-in.
			
			
				//Estilo da mensagem de erro.
				//----------------------
				errorClass: "TextoErro",
				//----------------------
				
				
				//Validação
				//----------------------
				rules: {
					quantidade: {
						required: true,
						//regex: /-?\d+(\.\d{1,3})?/
						number: true
					},
					valor_unitario: {
						required: true,
						//regex: /-?\d+(\.\d{1,3})?/
						//regex: /-?[0-9]+(?:\.?[0-9]*)?,?[0-9]+(?:\.?[0-9]*)?/
						//pattern: /-?[0-9]+(?:\.?[0-9]*)?,?[0-9]+(?:\.?[0-9]*)?/
						//pattern: /^(\d+|\d+,\d{1,2})$/
						//pattern: /[0-9]+([\.|,][0-9]+)?/
						accept: "-?[0-9]+(?:\.?[0-9]*)?,?[0-9]+(?:\.?[0-9]*)?"
						//number: true
					},
				},
				
				
				//Mensagens.
				//----------------------
				messages: {
					//n_classificacao: "Please specify your name"//,
					quantidade: {
					  //required: "Campo obrigatório.",
					  required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica2"); ?>",
					  //regex: "Campo numérico."
					  //number: "Campo numérico."
					  number: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica1"); ?>"
					},
					valor_unitario: {
					  //required: "Campo obrigatório.",
					  required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica2"); ?>",
					  //pattern: "echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica3");"
					  accept: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica3"); ?>"
					  //number: "Campo numérico."
					},
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
    
    <form name="formPedidosItens" id="formPedidosItens" action="PedidosItensExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <table class="TabelaCampos01">
            <tr>
                <td class="TbFundoEscuro" colspan="4">
                    <div align="center" class="Texto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPedidosItensAvulsoIncluir"); ?>
                        </strong>
                    </div>
                </td>
            </tr>
            
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPedidosItensDescricao"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula">
                    <div align="left">
                        <input type="text" name="descricao" id="descricao" class="CampoTexto01" maxlength="255" />
                    </div>
                </td>

                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPedidosItensQuantidade"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaColuna01 TabelaCampos01Celula">
                    <div>
                        <input type="text" name="quantidade" id="quantidade" class="CampoNumerico01" maxlength="10" value="1" />
                    </div>
                </td>
            </tr>
            
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPedidosItensCodigo"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left" class="Texto01">
                    	<input type="text" name="cod_item" id="cod_item" class="CampoTexto01" maxlength="255" />
                    </div>
                </td>
            </tr>
            
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPedidosItensValorUnitario"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
                    	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>
                        <input type="text" name="valor_unitario" id="valor_unitario" class="CampoNumerico02" maxlength="255" value="<?php echo Funcoes::MascaraValorLer("0", $GLOBALS['configSistemaMoeda']); ?>" />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemValorDescicao01"); ?>
                    </div>
                </td>
            </tr>
            
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPedidosItensOBS"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left" class="Texto01">
                        <textarea name="obs" id="obs" class="CampoTextoMultilinha01"></textarea>
                    </div>
                </td>
            </tr>

        </table>
         
        <div>
            <div style="float:left;">
                <input type="image" name="submit" value="Submit" src="img/btoIncluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoIncluir"); ?>" />
                
                <input name="id_ce_pedidos" type="hidden" id="id_ce_pedidos" value="<?php echo $idCePedidos; ?>" />
                <input name="id_tb_cadastro_cliente" type="hidden" id="id_tb_cadastro_cliente" value="<?php echo $idTbCadastro; ?>" />
                <input name="id_tb_cadastro_usuario" type="hidden" id="id_tb_cadastro_usuario" value="0" />
                <input name="id_item" type="hidden" id="id_item" value="0" />
                <input name="tabela" type="hidden" id="tabela" value="" />
                <input name="informacao_complementar1" type="hidden" id="informacao_complementar1" value="" />
                <input name="informacao_complementar2" type="hidden" id="informacao_complementar2" value="" />
                <input name="informacao_complementar3" type="hidden" id="informacao_complementar3" value="" />
                <input name="informacao_complementar4" type="hidden" id="informacao_complementar4" value="" />
                <input name="informacao_complementar5" type="hidden" id="informacao_complementar5" value="" />
                <input name="ativacao" type="hidden" id="ativacao" value="0" />
                
                
                <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                <input name="masterPageSelect" type="hidden" id="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
                
            </div>
            <div style="float:right;">
                &nbsp;
            </div>
        </div>
    </form>
    <br />

    </div>
    <?php } ?>
	<?php //**************************************************************************************?>
    

	<?php //Pedido - edição. ?>
	<?php //**************************************************************************************?>
    <div class="Texto01" style="position: relative; display: block; margin-top: 10px;">
    	<?php
		//Query de pesquisa.
		//----------
		$strSqlPedidosDetalhesSelect = "";
		$strSqlPedidosDetalhesSelect .= "SELECT ";
		//$strSqlPedidosDetalhesSelect .= "* ";
		$strSqlPedidosDetalhesSelect .= "id, ";
		$strSqlPedidosDetalhesSelect .= "id_tb_cadastro_cliente, ";
		$strSqlPedidosDetalhesSelect .= "id_tb_cadastro_enderecos, ";
		$strSqlPedidosDetalhesSelect .= "id_tb_cadastro_cartoes, ";
		$strSqlPedidosDetalhesSelect .= "id_tb_cadastro_usuario, ";
		$strSqlPedidosDetalhesSelect .= "tipo_pagamento, ";
		$strSqlPedidosDetalhesSelect .= "data_pedido, ";
		$strSqlPedidosDetalhesSelect .= "data_pagamento, ";
		$strSqlPedidosDetalhesSelect .= "data_entrega, ";
		$strSqlPedidosDetalhesSelect .= "data_validade, ";
		$strSqlPedidosDetalhesSelect .= "valor_pedido, ";
		$strSqlPedidosDetalhesSelect .= "valor_frete, ";
		$strSqlPedidosDetalhesSelect .= "periodo_contratacao, ";
		$strSqlPedidosDetalhesSelect .= "tipo_entrega, ";
		$strSqlPedidosDetalhesSelect .= "valor_desconto, ";
		$strSqlPedidosDetalhesSelect .= "valor_acrescimo, ";
		$strSqlPedidosDetalhesSelect .= "valor_total, ";
		$strSqlPedidosDetalhesSelect .= "peso_total, ";
		$strSqlPedidosDetalhesSelect .= "endereco_entrega, ";
		$strSqlPedidosDetalhesSelect .= "endereco_numero_entrega, ";
		$strSqlPedidosDetalhesSelect .= "endereco_complemento_entrega, ";
		$strSqlPedidosDetalhesSelect .= "bairro_entrega, ";
		$strSqlPedidosDetalhesSelect .= "cidade_entrega, ";
		$strSqlPedidosDetalhesSelect .= "cidade_entrega, ";
		$strSqlPedidosDetalhesSelect .= "pais_entrega, ";
		$strSqlPedidosDetalhesSelect .= "cep_entrega, ";
		$strSqlPedidosDetalhesSelect .= "id_tb_cadastro2, ";
		$strSqlPedidosDetalhesSelect .= "id_tb_cadastro3, ";
		$strSqlPedidosDetalhesSelect .= "id_tb_cadastro4, ";
		$strSqlPedidosDetalhesSelect .= "id_tb_cadastro5, ";
		$strSqlPedidosDetalhesSelect .= "obs, ";
		$strSqlPedidosDetalhesSelect .= "ativacao, ";
		$strSqlPedidosDetalhesSelect .= "informacao_complementar1, ";
		$strSqlPedidosDetalhesSelect .= "informacao_complementar2, ";
		$strSqlPedidosDetalhesSelect .= "informacao_complementar3, ";
		$strSqlPedidosDetalhesSelect .= "informacao_complementar4, ";
		$strSqlPedidosDetalhesSelect .= "informacao_complementar5, ";
		$strSqlPedidosDetalhesSelect .= "id_ce_complemento_status, ";
		$strSqlPedidosDetalhesSelect .= "transacao_externa_status, ";
		$strSqlPedidosDetalhesSelect .= "transacao_externa_autenticacao, ";
		$strSqlPedidosDetalhesSelect .= "transacao_externa_log, ";
		$strSqlPedidosDetalhesSelect .= "transacao_externa_data_pagamento_liberado ";
		$strSqlPedidosDetalhesSelect .= "FROM ce_pedidos ";
		$strSqlPedidosDetalhesSelect .= "WHERE id <> 0 ";
		//$strSqlPedidosDetalhesSelect .= "AND id_tb_categorias = :id_tb_categorias ";
		$strSqlPedidosDetalhesSelect .= "AND id = :id ";
		//$strSqlPedidosDetalhesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
		//echo "strSqlPedidosDetalhesSelect=" . $strSqlPedidosDetalhesSelect . "<br>";
		//----------


		//Parâmetros.
		//----------
		$statementPedidosDetalhesSelect = $dbSistemaConPDO->prepare($strSqlPedidosDetalhesSelect);
		
		if ($statementPedidosDetalhesSelect !== false)
		{
			$statementPedidosDetalhesSelect->execute(array(
				"id" => $idCePedidos
			));
		}
		//----------


		//$resultadoPedidosDetalhes = $dbSistemaConPDO->query($strSqlPedidosDetalhesSelect);
		$resultadoPedidosDetalhes = $statementPedidosDetalhesSelect->fetchAll();
		
		if (empty($resultadoPedidosDetalhes))
		{
			//echo "Nenhum registro encontrado";
		}else{
			foreach($resultadoPedidosDetalhes as $linhaPedidosDetalhes)
			{
				//Definição das variáveis de detalhes.
				$tbPedidosId = $linhaPedidosDetalhes['id'];
				$tbPedidosIdTbCadastroCliente = $linhaPedidosDetalhes['id_tb_cadastro_cliente'];
				$tbPedidosIdTbCadastroEnderecos = $linhaPedidosDetalhes['id_tb_cadastro_enderecos'];
				$tbPedidosIdTbCadastroCartoes = $linhaPedidosDetalhes['id_tb_cadastro_cartoes'];
				$tbPedidosIdTbCadastroUsuario = $linhaPedidosDetalhes['id_tb_cadastro_usuario'];
				$tbPedidosTipoPagamento = Funcoes::ConteudoMascaraLeitura($linhaPedidosDetalhes['tipo_pagamento']);
				
				//$tbPedidosDataPedido = $linhaPedidosDetalhes['data_pedido'];
				if($linhaPedidosDetalhes['data_pedido'] == NULL)
				{
					$tbPedidosDataPedido = "";
				}else{
					$tbPedidosDataPedido = Funcoes::DataLeitura01($linhaPedidosDetalhes['data_pedido'], $GLOBALS['configSistemaFormatoData'], "1");
				}
				
				//$tbPedidosDataPagamento = $linhaPedidosDetalhes['data_pagamento'];
				if($linhaPedidosDetalhes['data_pagamento'] == NULL)
				{
					$tbPedidosDataPagamento = "";
				}else{
					$tbPedidosDataPagamento = Funcoes::DataLeitura01($linhaPedidosDetalhes['data_pagamento'], $GLOBALS['configSistemaFormatoData'], "1");
				}

				//$tbPedidosDataEntrega = $linhaPedidosDetalhes['data_entrega'];
				if($linhaPedidosDetalhes['data_entrega'] == NULL)
				{
					$tbPedidosDataEntrega = "";
				}else{
					$tbPedidosDataEntrega = Funcoes::DataLeitura01($linhaPedidosDetalhes['data_entrega'], $GLOBALS['configSistemaFormatoData'], "1");
				}

				//$tbPedidosDataValidade = $linhaPedidosDetalhes['data_validade'];
				if($linhaPedidosDetalhes['data_validade'] == NULL)
				{
					$tbPedidosDataValidade = "";
				}else{
					$tbPedidosDataValidade = Funcoes::DataLeitura01($linhaPedidosDetalhes['data_validade'], $GLOBALS['configSistemaFormatoData'], "1");
				}

				//$tbPedidosValorPedido = Funcoes::MascaraValorLer($linhaPedidosDetalhes['valor_pedido'], $GLOBALS['configSistemaMoeda']);
				$tbPedidosValorPedido = $linhaPedidosDetalhes['valor_pedido'];

				//$tbPedidosValorFrete = Funcoes::MascaraValorLer($linhaPedidosDetalhes['valor_frete'], $GLOBALS['configSistemaMoeda']);
				$tbPedidosValorFrete = $linhaPedidosDetalhes['valor_frete'];

				$tbPedidosPeriodoContratacao = $linhaPedidosDetalhes['periodo_contratacao'];
				$tbPedidosTipoEntrega = Funcoes::ConteudoMascaraLeitura($linhaPedidosDetalhes['tipo_entrega']);
				
				$tbPedidosValorDesconto = $linhaPedidosDetalhes['valor_desconto'];
				$tbPedidosValorAcrescimo = $linhaPedidosDetalhes['valor_acrescimo'];

				//$tbPedidosValorTotal = Funcoes::MascaraValorLer($linhaPedidosDetalhes['valor_total'], $GLOBALS['configSistemaMoeda']);
				$tbPedidosValorTotal = $linhaPedidosDetalhes['valor_total'];

				$tbPedidosPesoTotal = $linhaPedidosDetalhes['peso_total'];
				$tbPedidosEnderecoEntrega = Funcoes::ConteudoMascaraLeitura($linhaPedidosDetalhes['endereco_entrega']);
				$tbPedidosEnderecoNumeroEntrega = Funcoes::ConteudoMascaraLeitura($linhaPedidosDetalhes['endereco_numero_entrega']);
				$tbPedidosEnderecoComplementoEntrega = Funcoes::ConteudoMascaraLeitura($linhaPedidosDetalhes['endereco_complemento_entrega']);
				$tbPedidosBairroEntrega = Funcoes::ConteudoMascaraLeitura($linhaPedidosDetalhes['bairro_entrega']);
				$tbPedidosCidadeEntrega = Funcoes::ConteudoMascaraLeitura($linhaPedidosDetalhes['cidade_entrega']);
				$tbPedidosEstadoEntrega = Funcoes::ConteudoMascaraLeitura($linhaPedidosDetalhes['estado_entrega']);
				$tbPedidosPaisEntrega = Funcoes::ConteudoMascaraLeitura($linhaPedidosDetalhes['pais_entrega']);
				$tbPedidosCepEntrega = Funcoes::FormatarCEPLer($linhaPedidosDetalhes['cep_entrega']);
				$tbPedidosIdTbCadastro1 = $linhaPedidosDetalhes['id_tb_cadastro1'];
				$tbPedidosIdTbCadastro2 = $linhaPedidosDetalhes['id_tb_cadastro2'];
				$tbPedidosIdTbCadastro3 = $linhaPedidosDetalhes['id_tb_cadastro3'];
				$tbPedidosIdTbCadastro4 = $linhaPedidosDetalhes['id_tb_cadastro4'];
				$tbPedidosIdTbCadastro5 = $linhaPedidosDetalhes['id_tb_cadastro5'];
				$tbPedidosOBS = Funcoes::ConteudoMascaraLeitura($linhaPedidosDetalhes['obs']);
				$tbPedidosAtivacao = $linhaPedidosDetalhes['ativacao'];
				$tbPedidosIC1 = Funcoes::ConteudoMascaraLeitura($linhaPedidosDetalhes['informacao_complementar1']);
				$tbPedidosIC2 = Funcoes::ConteudoMascaraLeitura($linhaPedidosDetalhes['informacao_complementar2']);
				$tbPedidosIC3 = Funcoes::ConteudoMascaraLeitura($linhaPedidosDetalhes['informacao_complementar3']);
				$tbPedidosIC4 = Funcoes::ConteudoMascaraLeitura($linhaPedidosDetalhes['informacao_complementar4']);
				$tbPedidosIC5 = Funcoes::ConteudoMascaraLeitura($linhaPedidosDetalhes['informacao_complementar5']);
				$tbPedidosIdCeComplementoStatus = $linhaPedidosDetalhes['id_ce_complemento_status'];
				$tbPedidosTransacaoExternaStatus = $linhaPedidosDetalhes['transacao_externa_status'];
				$tbPedidosTransacaoExternaAutenticacao = $linhaPedidosDetalhes['transacao_externa_autenticacao'];
				$tbPedidosTransacaoExternaLog = $linhaPedidosDetalhes['transacao_externa_log'];
				$tbPedidosTransacaoExternaDataPagamentoLiberado = $linhaPedidosDetalhes['transacao_externa_data_pagamento_liberado'];
				
				
				//Verificação de erro.
				//echo "tbPedidosId=" . $tbPedidosId . "<br>";
				//echo "tbPedidosValorPedido=" . $tbPedidosValorPedido . "<br>";
				//echo "tbPedidosAtivacao=" . $tbPedidosAtivacao . "<br>";
			}
		}
		?>
        
        
        <form name="formPedidosEditar" id="formPedidosEditar" action="PedidosEditarExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
			<?php if($GLOBALS['configSistemaFormatoData'] == 1){ ?>
            <script type="text/javascript">
                //Variável para conter todos os campos que funcionam com o DatePicker.
                //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                var strDatapickerGenericoPtCampos = "#data_pedido;#data_pagamento;#data_entrega;#data_validade";
            </script>
            <?php } ?>
            <?php if($GLOBALS['configSistemaFormatoData'] == 2){ ?>
            <script type="text/javascript">
                //Variável para conter todos os campos que funcionam com o DatePicker.
                //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                var strDatapickerGenericoEnCampos = "#data_pedido;#data_pagamento;#data_entrega;#data_validade";
            </script>
            <?php } ?>
            <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="4">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPedidosTbPedidosEditar"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPedidosNumero"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div align="left" class="Texto01">
                            <?php echo $tbPedidosId; ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPedidosData"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div align="left" class="Texto01">
                        	<?php if($GLOBALS['habilitarEdicaoPedidosData'] == 1){ ?>
								<?php //JQuery DatePicker. ?>
                                <?php //---------------------- ?>
                                <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                    <input type="text" name="data_pedido" id="data_pedido" class="CampoData01" maxlength="10" value="<?php echo $tbPedidosDataPedido;?>" />
                                    <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                                <?php } ?>
                                <?php //---------------------- ?>
                        	<?php }else{ ?>
                            	<?php echo $tbPedidosDataPedido; ?>
                        	<?php } ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPedidosTipoPagamento"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div align="left">
                            <input type="text" name="tipo_pagamento" id="tipo_pagamento" class="CampoTexto01" maxlength="255" value="<?php echo $tbPedidosTipoPagamento; ?>" />
                        </div>
                    </td>
                </tr>
                <?php if($GLOBALS['habilitarAdministrarPedidosDataPagamento'] == 1){ ?>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPedidosDataPagamento"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div align="left" class="Texto01">
                            <input type="text" name="data_pagamento" id="data_pagamento" class="CampoData01" maxlength="10" value="<?php echo $tbPedidosDataPagamento;?>" />
                        </div>
                    </td>
                </tr>
                <?php } ?>
                <?php if($GLOBALS['habilitarAdministrarPedidosDataEntrega'] == 1){ ?>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPedidosDataEntrega"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div align="left" class="Texto01">
                            <input type="text" name="data_entrega" id="data_entrega" class="CampoData01" maxlength="10" value="<?php echo $tbPedidosDataEntrega;?>" />
                        </div>
                    </td>
                </tr>
                <?php } ?>
                <?php if($GLOBALS['habilitarAdministrarPedidosDataValidade'] == 1){ ?>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPedidosDataValidade"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div align="left" class="Texto01">
                            <input type="text" name="data_validade" id="data_validade" class="CampoData01" maxlength="10" value="<?php echo $tbPedidosDataValidade;?>" />
                        </div>
                    </td>
                </tr>
                <?php } ?>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPedidosValorPedido"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div align="left" class="Texto01">
                            <?php 
							if($linhaPedidosDetalhes['valor_pedido'] == 0)
							{
								$tbPedidosValorPedido = $itensValorTotal;
							}
							
							//Verificação de erro.
							//echo "tbPedidosValorPedido=" . $tbPedidosValorPedido . "<br>";
							//echo "itensValorTotal=" . $itensValorTotal . "<br>";
							//echo "Funcoes::MascaraValorLer(itensValorTotal)=" . Funcoes::MascaraValorLer($itensValorTotal, $GLOBALS['configSistemaMoeda']) . "<br>";
							?>

							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>
                            <input type="text" name="valor_pedido" id="valor_pedido" class="CampoNumerico02" maxlength="255" value="<?php echo Funcoes::MascaraValorLer($tbPedidosValorPedido, $GLOBALS['configSistemaMoeda']); ?>" />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemValorDescicao01"); ?>

                            <?php //echo htmlentities($GLOBALS['configSistemaMoeda']); ?> <?php //echo $tbPedidosValorPedido; ?>
                        </div>
                    </td>
                </tr>
    
                <?php if($GLOBALS['habilitarAdministrarPedidosFrete'] == 1){ ?>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPedidosValorFrete"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div align="left" class="Texto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>
                            <input type="text" name="valor_frete" id="valor_frete" class="CampoNumerico02" maxlength="255" value="<?php echo Funcoes::MascaraValorLer($tbPedidosValorFrete, $GLOBALS['configSistemaMoeda']); ?>" />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemValorDescicao01"); ?>

                            <?php //echo htmlentities($GLOBALS['configSistemaMoeda']); ?> <?php //echo $tbPedidosValorFrete; ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
    
                <?php if($GLOBALS['habilitarAdministrarPedidosTipoEntrega'] == 1){ ?>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPedidosTipoEntrega"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div align="left">
                            <input type="text" name="tipo_entrega" id="tipo_entrega" class="CampoTexto01" maxlength="255" value="<?php echo $tbPedidosTipoEntrega; ?>" />
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarPedidosValorDesconto'] == 1){ ?>
                <?php
				$tbPedidosValorTotal = $tbPedidosValorTotal - $tbPedidosValorDesconto;
				?>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPedidosValorDesconto"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div align="left" class="Texto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>
                            <input type="text" name="valor_desconto" id="valor_desconto" class="CampoNumerico02" maxlength="255" value="<?php echo Funcoes::MascaraValorLer($tbPedidosValorDesconto, $GLOBALS['configSistemaMoeda']); ?>" />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemValorDescicao01"); ?>

                            <?php //echo htmlentities($GLOBALS['configSistemaMoeda']); ?> <?php //echo $tbPedidosValorFrete; ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarPedidosValorAcrescimo'] == 1){ ?>
                <?php
				$tbPedidosValorTotal = $tbPedidosValorTotal + $tbPedidosValorAcrescimo;
				?>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPedidosValorAcrescimo"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div align="left" class="Texto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>
                            <input type="text" name="valor_acrescimo" id="valor_acrescimo" class="CampoNumerico02" maxlength="255" value="<?php echo Funcoes::MascaraValorLer($tbPedidosValorAcrescimo, $GLOBALS['configSistemaMoeda']); ?>" />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemValorDescicao01"); ?>

                            <?php //echo htmlentities($GLOBALS['configSistemaMoeda']); ?> <?php //echo $tbPedidosValorFrete; ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
    
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPedidosValorTotal"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div align="left" class="Texto01">
                            <?php 
							//if($linhaPedidosDetalhes['valor_total'] == 0)
							//{
								$tbPedidosValorTotal = $tbPedidosValorFrete + $tbPedidosValorPedido;
							//}
							
							//Verificação de erro.
							//echo "tbPedidosValorTotal=" . $tbPedidosValorTotal . "<br>";
							//echo "tbPedidosValorFrete=" . $tbPedidosValorFrete . "<br>";
							//echo "tbPedidosValorPedido=" . $tbPedidosValorPedido . "<br>";
							//echo "Funcoes::MascaraValorLer(itensValorTotal)=" . Funcoes::MascaraValorLer($itensValorTotal, $GLOBALS['configSistemaMoeda']) . "<br>";
							?>
							
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>
                            <input type="text" name="valor_total" id="valor_total" class="CampoNumerico02" maxlength="255" value="<?php echo Funcoes::MascaraValorLer($tbPedidosValorTotal, $GLOBALS['configSistemaMoeda']); ?>" />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemValorDescicao01"); ?>
                            
                            <?php //echo htmlentities($GLOBALS['configSistemaMoeda']); ?> <?php //echo $tbPedidosValorTotal; ?>
                        </div>
                    </td>
                </tr>
    
                <?php if($GLOBALS['habilitarAdministrarPedidosPeso'] == 1){ ?>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPedidosPesoTotal"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div align="left" class="Texto01">
                            <input type="text" name="peso_total" id="peso_total" class="CampoNumerico02" maxlength="255" value="<?php echo $tbPedidosPesoTotal; ?>" />
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaPeso'], "IncludeConfig"); ?>

                            <?php //echo $tbPedidosPesoTotal; ?> <?php //echo htmlentities($GLOBALS['configSistemaPeso']); ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
    
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPedidosObs"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div align="left">
                            <textarea name="obs" id="obs" class="CampoTextoMultilinha01"><?php echo $tbPedidosOBS;?></textarea>
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
                                <option value="0"<?php if($tbPedidosAtivacao == "0"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao4"); ?></option>
                                <option value="1"<?php if($tbPedidosAtivacao == "1"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao5"); ?></option>
                            </select>
                        </div>
                    </td>
                </tr>
                
				<?php if($GLOBALS['habilitarPedidosVinculo1'] == 1){ ?>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosVinculo1Nome'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div class="Texto01">
                            <?php 
                                $arrPedidosVinculo1 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbPedidosVinculo1'], $GLOBALS['configIdTbTipoPedidosVinculo1'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoPedidosVinculo1'], $GLOBALS['configPedidosVinculo1Metodo']);
                            ?>
                            <select name="id_tb_cadastro1" id="id_tb_cadastro1" class="CampoDropDownMenu01">
                                <option value="0"<?php if($tbPedidosIdTbCadastro1 == 0){ ?>selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNenhumDropDown"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrPedidosVinculo1); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrPedidosVinculo1[$countArray][0];?>"<?php if($arrPedidosVinculo1[$countArray][0] == $tbPedidosIdTbCadastro1){ ?> selected="selected"<?php } ?>><?php echo $arrPedidosVinculo1[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarPedidosVinculo2'] == 1){ ?>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosVinculo2Nome'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div class="Texto01">
                            <?php 
                                $arrPedidosVinculo2 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbPedidosVinculo2'], $GLOBALS['configIdTbTipoPedidosVinculo2'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoPedidosVinculo2'], $GLOBALS['configPedidosVinculo2Metodo']);
                            ?>
                            <select name="id_tb_cadastro2" id="id_tb_cadastro2" class="CampoDropDownMenu01">
                                <option value="0"<?php if($tbPedidosIdTbCadastro2 == 0){ ?>selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNenhumDropDown"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrPedidosVinculo2); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrPedidosVinculo2[$countArray][0];?>"<?php if($arrPedidosVinculo2[$countArray][0] == $tbPedidosIdTbCadastro2){ ?> selected="selected"<?php } ?>><?php echo $arrPedidosVinculo2[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarPedidosVinculo3'] == 1){ ?>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosVinculo3Nome'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div class="Texto01">
                            <?php 
                                $arrPedidosVinculo3 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbPedidosVinculo3'], $GLOBALS['configIdTbTipoPedidosVinculo3'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoPedidosVinculo3'], $GLOBALS['configPedidosVinculo3Metodo']);
                            ?>
                            <select name="id_tb_cadastro3" id="id_tb_cadastro3" class="CampoDropDownMenu01">
                                <option value="0"<?php if($tbPedidosIdTbCadastro3 == 0){ ?>selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNenhumDropDown"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrPedidosVinculo3); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrPedidosVinculo3[$countArray][0];?>"<?php if($arrPedidosVinculo3[$countArray][0] == $tbPedidosIdTbCadastro3){ ?> selected="selected"<?php } ?>><?php echo $arrPedidosVinculo3[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarPedidosVinculo4'] == 1){ ?>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosVinculo4Nome'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div class="Texto01">
                            <?php 
                                $arrPedidosVinculo4 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbPedidosVinculo4'], $GLOBALS['configIdTbTipoPedidosVinculo4'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoPedidosVinculo4'], $GLOBALS['configPedidosVinculo4Metodo']);
                            ?>
                            <select name="id_tb_cadastro4" id="id_tb_cadastro4" class="CampoDropDownMenu01">
                                <option value="0"<?php if($tbPedidosIdTbCadastro4 == 0){ ?>selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNenhumDropDown"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrPedidosVinculo4); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrPedidosVinculo4[$countArray][0];?>"<?php if($arrPedidosVinculo4[$countArray][0] == $tbPedidosIdTbCadastro4){ ?> selected="selected"<?php } ?>><?php echo $arrPedidosVinculo4[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarPedidosVinculo5'] == 1){ ?>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosVinculo5Nome'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div class="Texto01">
                            <?php 
                                $arrPedidosVinculo5 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbPedidosVinculo5'], $GLOBALS['configIdTbTipoPedidosVinculo5'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoPedidosVinculo5'], $GLOBALS['configPedidosVinculo5Metodo']);
                            ?>
                            <select name="id_tb_cadastro5" id="id_tb_cadastro5" class="CampoDropDownMenu01">
                                <option value="0"<?php if($tbPedidosIdTbCadastro5 == 0){ ?>selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNenhumDropDown"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrPedidosVinculo5); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrPedidosVinculo5[$countArray][0];?>"<?php if($arrPedidosVinculo5[$countArray][0] == $tbPedidosIdTbCadastro5){ ?> selected="selected"<?php } ?>><?php echo $arrPedidosVinculo5[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        </div>
                    </td>
                </tr>
                <?php } ?>
    
                <?php if($GLOBALS['habilitarPedidosIc1'] == 1){ ?>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosTituloIc1'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configPedidosBoxIc1'] == 1){ ?>
                                <input type="text" name="informacao_complementar1" id="informacao_complementar1" class="CampoTexto01" maxlength="255" value="<?php echo $tbPedidosIC1;?>" />
                            <?php } ?>
                            <?php if($GLOBALS['configPedidosBoxIc1'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar1" id="informacao_complementar1" class="CampoTextoMultilinha01"><?php echo $tbPedidosIC1;?></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar1").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorBasicoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorBasicoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar1" id="informacao_complementar1"><?php echo $tbPedidosIC1;?></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar1").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorAvancadoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorAvancadoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar1" id="informacao_complementar1"><?php echo $tbPedidosIC1;?></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarPedidosIc2'] == 1){ ?>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosTituloIc2'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configPedidosBoxIc2'] == 1){ ?>
                                <input type="text" name="informacao_complementar2" id="informacao_complementar2" class="CampoTexto01" maxlength="255" value="<?php echo $tbPedidosIC2;?>" />
                            <?php } ?>
                            <?php if($GLOBALS['configPedidosBoxIc2'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar2" id="informacao_complementar2" class="CampoTextoMultilinha01"><?php echo $tbPedidosIC2;?></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar2").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorBasicoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorBasicoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar2" id="informacao_complementar2"><?php echo $tbPedidosIC2;?></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar2").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorAvancadoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorAvancadoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar2" id="informacao_complementar2"><?php echo $tbPedidosIC2;?></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarPedidosIc3'] == 1){ ?>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosTituloIc3'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configPedidosBoxIc3'] == 1){ ?>
                                <input type="text" name="informacao_complementar3" id="informacao_complementar3" class="CampoTexto01" maxlength="255" value="<?php echo $tbPedidosIC3;?>" />
                            <?php } ?>
                            <?php if($GLOBALS['configPedidosBoxIc3'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar3" id="informacao_complementar3" class="CampoTextoMultilinha01"><?php echo $tbPedidosIC3;?></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar3").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorBasicoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorBasicoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar3" id="informacao_complementar3"><?php echo $tbPedidosIC3;?></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar3").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorAvancadoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorAvancadoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar3" id="informacao_complementar3"><?php echo $tbPedidosIC3;?></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            
    
                <?php if($GLOBALS['habilitarPedidosIc4'] == 1){ ?>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosTituloIc4'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configPedidosBoxIc4'] == 1){ ?>
                                <input type="text" name="informacao_complementar4" id="informacao_complementar4" class="CampoTexto01" maxlength="255" value="<?php echo $tbPedidosIC4;?>" />
                            <?php } ?>
                            <?php if($GLOBALS['configPedidosBoxIc4'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar4" id="informacao_complementar4" class="CampoTextoMultilinha01"><?php echo $tbPedidosIC4;?></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar4").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorBasicoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorBasicoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar4" id="informacao_complementar4"><?php echo $tbPedidosIC4;?></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar4").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorAvancadoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorAvancadoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar4" id="informacao_complementar4"><?php echo $tbPedidosIC4;?></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarPedidosIc5'] == 1){ ?>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosTituloIc5'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configPedidosBoxIc5'] == 1){ ?>
                                <input type="text" name="informacao_complementar5" id="informacao_complementar5" class="CampoTexto01" maxlength="255" value="<?php echo $tbPedidosIC5;?>" />
                            <?php } ?>
                            <?php if($GLOBALS['configPedidosBoxIc5'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar5" id="informacao_complementar5" class="CampoTextoMultilinha01"><?php echo $tbPedidosIC5;?></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar5").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorBasicoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorBasicoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar5" id="informacao_complementar5"><?php echo $tbPedidosIC5;?></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar5").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorAvancadoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorAvancadoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar5" id="informacao_complementar5"><?php echo $tbPedidosIC5;?></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                    
            </table>
            <div>
                <div style="float:left;">
                    <!--input type="image" name="submit" value="Submit" src="img/btoAtualizar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoAtualizar"); ?>" /-->
                    <input type="image" name="submit" value="Submit" src="img/btoFinalizar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoFinalizar"); ?>" />
                    
                    <input name="idCePedidos" type="hidden" id="idCePedidos" value="<?php echo $tbPedidosId; ?>" />
                    <input name="idTbCadastro" type="hidden" id="idTbCadastro" value="<?php echo $idTbCadastro; ?>" />
                    <input name="flagFinalizar" type="hidden" id="flagFinalizar" value="1" />
                    
                    <input name="id_tb_cadastro_cliente" type="hidden" id="id_tb_cadastro_cliente" value="<?php echo $tbPedidosIdTbCadastroCliente; ?>" />

                    <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                    <input name="masterPageSelect" type="hidden" id="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
                </div>
                <div style="float:right;">
                    &nbsp;
                </div>
            </div>
        </form>
        
            
		<?php
        //Limpeza de objetos.
        //----------
        unset($strSqlPedidosDetalhesSelect);
        unset($statementPedidosDetalhesSelect);
        unset($resultadoPedidosDetalhes);
        unset($linhaPedidosDetalhes);
        //----------
		?>
    </div>
	<?php //**************************************************************************************?>
<?php 
$page->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php 
//Inclusão do template do layout.
include_once $page->LayoutSistema;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>