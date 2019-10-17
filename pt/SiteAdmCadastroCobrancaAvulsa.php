<?php
//Importação dos arquivos de configuração.
require_once "../sistema/IncludeConfig.php"; //Deve vir antes do db.
require_once "../sistema/IncludeConexao.php";
require_once "../sistema/IncludeFuncoes.php";
//require_once "IncludeLayout.php";
require_once "IncludeLayoutSite.php";


//Verificação de login de cadastro.
LoginAutenticacao::CadastroLoginVerificacao();


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

$paginaRetorno = "SiteAdmCadastroCobrancaAvulsa.php";
$paginaRetornoExclusao = "SiteAdmCadastroCobrancaAvulsa.php";
$variavelRetorno = "idTbCadastro";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];


//Montagem de query padrão de retorno.
$queryPadrao = "&idTbCadastro=" . $idTbCadastro . 
"&idCePedidos=" . $idCePedidos . 
"&paginaRetorno=" . $paginaRetorno . 
"&masterPageSiteSelect=" . $masterPageSiteSelect . 
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
	<?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($idTbCadastro, "tb_cadastro", "nome"), 
																		DbFuncoes::GetCampoGenerico01($idTbCadastro, "tb_cadastro", "razao_social"), 
																		DbFuncoes::GetCampoGenerico01($idTbCadastro, "tb_cadastro", "nome_fantasia"), 1)); ?>
     - 
    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosTituloEditar"); ?> 
     - 
	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configNomeCliente'], "IncludeConfig"); ?>
<?php 
$pageSite->cphTitle = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Head.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphHead*/ ?>
    <meta name="description" content="" /><?php //Abaixo de 160 caracteres.?>
    <meta name="keywords" content="" /><?php //Abaixo de 100 caracteres.?>
    <meta name="title" content="" /><?php //Abaixo de 60 caracteres.?>
<?php 
$pageSite->cphHead = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Título atual.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphConteudoCabecalho*/ ?>
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosTituloEditar"); ?>
<?php 
$pageSite->cphTituloLinkAtual = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Conteúdo principal.?>
<?php //**************************************************************************************?>
<?php ob_start(); /*cphConteudoPrincipal*/ ?>
    <div align="center" class="AdmErro">
        <?php echo $mensagemErro;?>
    </div>
    <div align="center" class="AdmSucesso">
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
        <div align="center" class="AdmErro">
            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatus1"); ?>
        </div>
    <?php
    }else{
    ?>

        <form name="formPedidosItensAcoes" id="formPedidosItensAcoes" action="SiteAdmRegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="ce_itens" />
            <input name="idTbCadastro" id="idTbCadastro" type="hidden" value="<?php echo $idTbCadastro; ?>" />
            <input name="idCePedidos" id="idCePedidos" type="hidden" value="<?php echo $idCePedidos; ?>" />

            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            <input name="masterPageSiteSelect" type="hidden" id="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
            <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            <div style="position:relative; display: block; clear: both;">
                <div align="right" style="float: right;">
                    <input type="image" name="submit" value="Submit" src="img/btoExcluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoExcluir"); ?>">
                </div>
            </div>
            <table width="100%" class="TabelaDados01">
              <tr class="AdmTbFundoEscuro">
                <?php if($GLOBALS['ativacaoProdutosImagens'] == 1){ ?>
                <td width="1" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemImagem"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <td width="100" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosItensCodigo"); ?>
                    </div>
                </td>
                
                <td class="AdmTabelaDados01Celula">
                    <div class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosItensDescricao"); ?>
                    </div>
                </td>
                
                <td width="40" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                    	<strong>
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosItensQuantidade"); ?>
                        </strong>
                    </div>
                </td>
                
                <td width="100" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                    	<strong>
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosItensValorUnitario"); ?>
                        </strong>
                    </div>
                </td>
                
                <td width="100" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                    	<strong>
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosItensValorTotal"); ?>
                        </strong>
                    </div>
                </td>
                
                <td width="30" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao"); ?>
                    </div>
                </td>
                
                <td width="30" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                    </div>
                </td>
                
                <td width="30" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemExcluir"); ?>
                    </div>
                </td>
              </tr>
              <?php
                //Loop pelos resultados.
                foreach($resultadoPedidosItens as $linhaPedidosItens)
                {
              ?>
              <tr class="AdmTbFundoClaro">
              	<?php if($GLOBALS['ativacaoProdutosImagens'] == 1){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
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
                                    <img src="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>t<?php echo $ceItensImagem;?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaPedidosItens['descricao']); ?>" />
                                <?php } ?>
                            
                                <?php //SlimBox 2 - JQuery. ?>
                                <?php if($GLOBALS['configImagemPopUp'] == 1){ ?>
                                    <a href="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>g<?php echo $ceItensImagem;?>" rel="lightbox" title="<?php echo Funcoes::ConteudoMascaraLeitura($linhaPedidosItens['descricao']); ?>">
                                        <img src="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>t<?php echo $ceItensImagem;?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaPedidosItens['descricao']); ?>" />
                                    </a>
                                <?php } ?>
                            <?php } ?>
                    	<?php //---------- ?>
                    </div>
                </td>
                <?php } ?>

                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <?php echo $linhaPedidosItens['cod_item'];?>
                    </div>
                </td>
                
                <td class="AdmTabelaDados01Celula">
                    <div class="AdmTexto01">
                    	<?php echo Funcoes::ConteudoMascaraLeitura($linhaPedidosItens['descricao']);?>
                    </div>
                </td>
                
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <?php echo $linhaPedidosItens['quantidade'];?>
                    </div>
                </td>
                
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>
                        <?php echo Funcoes::MascaraValorLer($linhaPedidosItens['valor_unitario'], $GLOBALS['configSistemaMoeda']);?>
                    </div>
                </td>
                
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
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
                
                <td class="<?php if($linhaPedidosItens['ativacao'] == 1){/*echo "AdmTbFundoClaro";*/}else{echo "AdmTbFundoDesativado";}?> AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                    	<a href="RegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaPedidosItens['id'];?>&statusAtivacao=<?php echo $linhaPedidosItens['ativacao'];?>&strTabela=ce_itens&strCampo=ativacao<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="AdmLinks01">
                        	<?php if($linhaPedidosItens['ativacao'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao0"); ?>
                            <?php } ?>
                        	<?php if($linhaPedidosItens['ativacao'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao1"); ?>
                            <?php } ?>
                        </a>
						<?php //echo $linhaPaginas['ativacao'];?>
                    </div>
                </td>
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <a href="PedidosItensEditar.php?idCeItens=<?php echo $linhaPedidosItens['id'];?><?php echo $queryPadrao;?>" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaPedidosItens['id'];?>" class="AdmCampoCheckBox01" />
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
    <div class="AdmTexto01" align="right">
        <div>
            <strong>
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosItensValorSubtotal"); ?>: 
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
        <div class="AdmTexto01" style="position: relative; display: block; margin-top: 10px;">
            <form name="formPedidosItens" id="formPedidosItens" action="SiteAdmPedidosItensExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
                <table class="AdmTabelaCampos01">
                    <tr>
                        <td class="AdmTbFundoEscuro" colspan="4">
                            <div align="center" class="AdmTexto02">
                                <strong>
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosItensProdutosIncluir"); ?>
                                </strong>
                            </div>
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="AdmTbFundoMedio TabelaColuna01">
                            <div align="left" class="AdmTexto01">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProduto"); ?>:
                            </div>
                        </td>
                        <td class="AdmTbFundoClaro AdmTabelaCampos01Celula">
                            <div align="left">
                                <select name="id_item" id="id_item" class="AdmCampoDropDownMenu01">
                                    <!--option value="0" selected="selected"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option-->
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
        
                        <td class="AdmTbFundoMedio TabelaColuna01">
                            <div align="left" class="AdmTexto01">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosItensQuantidade"); ?>:
                            </div>
                        </td>
                        <td class="AdmTbFundoClaro TabelaColuna01 AdmTabelaCampos01Celula">
                            <div>
                                <input type="text" name="quantidade" id="quantidade" class="AdmCampoNumerico01" maxlength="10" value="1" />
                            </div>
                        </td>
                    </tr>
                    
                    <?php if($GLOBALS['habilitarProdutosValor'] == 0){ ?>
                    <tr>
                        <td class="AdmTbFundoMedio TabelaColuna01">
                            <div align="left" class="AdmTexto01">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosItensValorUnitario"); ?>:
                            </div>
                        </td>
                        <td class="AdmTbFundoClaro" colspan="3">
                            <div class="AdmTexto01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>
                                <input type="text" name="valor_unitario" id="valor_unitario" class="AdmCampoNumerico02" maxlength="255" value="<?php echo Funcoes::MascaraValorLer("0", $GLOBALS['configSistemaMoeda']); ?>" />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemValorDescicao01"); ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                    
                    <tr>
                        <td class="AdmTbFundoMedio TabelaColuna01">
                            <div align="left" class="AdmTexto01">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosItensOBS"); ?>:
                            </div>
                        </td>
                        <td class="AdmTbFundoClaro" colspan="3">
                            <div align="left" class="AdmTexto01">
                                <textarea name="obs" id="obs" class="AdmCampoTextoMultilinha01"></textarea>
                            </div>
                        </td>
                    </tr>
        
                </table>
                 
                <div>
                    <div style="float:left;">
                        <input type="image" name="submit" value="Submit" src="img/btoIncluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoIncluir"); ?>" />
                        
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
                        <input name="masterPageSiteSelect" type="hidden" id="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
                        
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
    <div class="AdmTexto01" style="position: relative; display: block; margin-top: 10px;">
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
				errorClass: "AdmErro",
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
					  required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>",
					  //regex: "Campo numérico."
					  //number: "Campo numérico."
					  number: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica1"); ?>"
					},
					valor_unitario: {
					  //required: "Campo obrigatório.",
					  required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>",
					  //pattern: "echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica3");"
					  accept: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica3"); ?>"
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
    
    <form name="formPedidosItens" id="formPedidosItens" action="SiteAdmPedidosItensExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <table class="AdmTabelaCampos01">
            <tr>
                <td class="AdmTbFundoEscuro" colspan="4">
                    <div align="center" class="AdmTexto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosItensAvulsoIncluir"); ?>
                        </strong>
                    </div>
                </td>
            </tr>
            
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosItensDescricao"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula">
                    <div align="left">
                        <input type="text" name="descricao" id="descricao" class="AdmCampoAdmTexto01" maxlength="255" />
                    </div>
                </td>

                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosItensQuantidade"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaColuna01 AdmTabelaCampos01Celula">
                    <div>
                        <input type="text" name="quantidade" id="quantidade" class="AdmCampoNumerico01" maxlength="10" value="1" />
                    </div>
                </td>
            </tr>
            
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosItensCodigo"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    	<input type="text" name="cod_item" id="cod_item" class="AdmCampoAdmTexto01" maxlength="255" />
                    </div>
                </td>
            </tr>
            
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosItensValorUnitario"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                    	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>
                        <input type="text" name="valor_unitario" id="valor_unitario" class="AdmCampoNumerico02" maxlength="255" value="<?php echo Funcoes::MascaraValorLer("0", $GLOBALS['configSistemaMoeda']); ?>" />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemValorDescicao01"); ?>
                    </div>
                </td>
            </tr>
            
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosItensOBS"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <textarea name="obs" id="obs" class="AdmCampoTextoMultilinha01"></textarea>
                    </div>
                </td>
            </tr>

        </table>
         
        <div>
            <div style="float:left;">
                <input type="image" name="submit" value="Submit" src="img/btoIncluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoIncluir"); ?>" />
                
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
                <input name="masterPageSiteSelect" type="hidden" id="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
                
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
    <div class="AdmTexto01" style="position: relative; display: block; margin-top: 10px;">
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
					$tbPedidosDataPedido = Funcoes::DataLeitura01($linhaPedidosDetalhes['data_pedido'], $GLOBALS['configSiteFormatoData'], "1");
				}
				
				//$tbPedidosDataPagamento = $linhaPedidosDetalhes['data_pagamento'];
				if($linhaPedidosDetalhes['data_pagamento'] == NULL)
				{
					$tbPedidosDataPagamento = "";
				}else{
					$tbPedidosDataPagamento = Funcoes::DataLeitura01($linhaPedidosDetalhes['data_pagamento'], $GLOBALS['configSiteFormatoData'], "1");
				}

				//$tbPedidosDataEntrega = $linhaPedidosDetalhes['data_entrega'];
				if($linhaPedidosDetalhes['data_entrega'] == NULL)
				{
					$tbPedidosDataEntrega = "";
				}else{
					$tbPedidosDataEntrega = Funcoes::DataLeitura01($linhaPedidosDetalhes['data_entrega'], $GLOBALS['configSiteFormatoData'], "1");
				}


				//$tbPedidosDataValidade = $linhaPedidosDetalhes['data_validade'];
				if($linhaPedidosDetalhes['data_validade'] == NULL)
				{
					$tbPedidosDataValidade = "";
				}else{
					$tbPedidosDataValidade = Funcoes::DataLeitura01($linhaPedidosDetalhes['data_validade'], $GLOBALS['configSiteFormatoData'], "1");
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
        
        
        <form name="formPedidosEditar" id="formPedidosEditar" action="SiteAdmPedidosEditarExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
			<?php if($GLOBALS['configSiteFormatoData'] == 1){ ?>
            <script type="text/javascript">
                //Variável para conter todos os campos que funcionam com o DatePicker.
                //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                var strDatapickerGenericoPtCampos = "#data_pedido;#data_pagamento;#data_entrega;#data_validade";
            </script>
            <?php } ?>
            <?php if($GLOBALS['configSiteFormatoData'] == 2){ ?>
            <script type="text/javascript">
                //Variável para conter todos os campos que funcionam com o DatePicker.
                //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                var strDatapickerGenericoEnCampos = "#data_pedido;#data_pagamento;#data_entrega;#data_validade";
            </script>
            <?php } ?>
            <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
            <table class="AdmTabelaCampos01">
                <tr>
                    <td class="AdmTbFundoEscuro" colspan="4">
                        <div align="center" class="AdmTexto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosTbPedidosEditar"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosNumero"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left" class="AdmTexto01">
                            <?php echo $tbPedidosId; ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosData"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left" class="AdmTexto01">
                        	<?php if($GLOBALS['habilitarEdicaoPedidosData'] == 1){ ?>
								<?php //JQuery DatePicker. ?>
                                <?php //---------------------- ?>
                                <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                    <input type="text" name="data_pedido" id="data_pedido" class="AdmCampoData01" maxlength="10" value="<?php echo $tbPedidosDataPedido;?>" />
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
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosTipoPagamento"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left">
                            <input type="text" name="tipo_pagamento" id="tipo_pagamento" class="AdmCampoAdmTexto01" maxlength="255" value="<?php echo $tbPedidosTipoPagamento; ?>" />
                        </div>
                    </td>
                </tr>
                <?php if($GLOBALS['habilitarAdministrarPedidosDataPagamento'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosDataPagamento"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left" class="AdmTexto01">
                            <input type="text" name="data_pagamento" id="data_pagamento" class="AdmCampoData01" maxlength="10" value="<?php echo $tbPedidosDataPagamento;?>" />
                        </div>
                    </td>
                </tr>
                <?php } ?>
                <?php if($GLOBALS['habilitarAdministrarPedidosDataEntrega'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosDataEntrega"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left" class="AdmTexto01">
                            <input type="text" name="data_entrega" id="data_entrega" class="AdmCampoData01" maxlength="10" value="<?php echo $tbPedidosDataEntrega;?>" />
                        </div>
                    </td>
                </tr>
                <?php } ?>
                <?php if($GLOBALS['habilitarAdministrarPedidosDataValidade'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosDataValidade"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left" class="AdmTexto01">
                            <input type="text" name="data_validade" id="data_validade" class="AdmCampoData01" maxlength="10" value="<?php echo $tbPedidosDataValidade;?>" />
                        </div>
                    </td>
                </tr>
                <?php } ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosValorPedido"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left" class="AdmTexto01">
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
                            <input type="text" name="valor_pedido" id="valor_pedido" class="AdmCampoNumerico02" maxlength="255" value="<?php echo Funcoes::MascaraValorLer($tbPedidosValorPedido, $GLOBALS['configSistemaMoeda']); ?>" />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemValorDescicao01"); ?>

                            <?php //echo htmlentities($GLOBALS['configSistemaMoeda']); ?> <?php //echo $tbPedidosValorPedido; ?>
                        </div>
                    </td>
                </tr>
    
                <?php if($GLOBALS['habilitarAdministrarPedidosFrete'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosValorFrete"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>
                            <input type="text" name="valor_frete" id="valor_frete" class="AdmCampoNumerico02" maxlength="255" value="<?php echo Funcoes::MascaraValorLer($tbPedidosValorFrete, $GLOBALS['configSistemaMoeda']); ?>" />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemValorDescicao01"); ?>

                            <?php //echo htmlentities($GLOBALS['configSistemaMoeda']); ?> <?php //echo $tbPedidosValorFrete; ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
    
                <?php if($GLOBALS['habilitarAdministrarPedidosTipoEntrega'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosTipoEntrega"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left">
                            <input type="text" name="tipo_entrega" id="tipo_entrega" class="AdmCampoAdmTexto01" maxlength="255" value="<?php echo $tbPedidosTipoEntrega; ?>" />
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarPedidosValorDesconto'] == 1){ ?>
                <?php
				$tbPedidosValorTotal = $tbPedidosValorTotal - $tbPedidosValorDesconto;
				?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosValorDesconto"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>
                            <input type="text" name="valor_desconto" id="valor_desconto" class="AdmCampoNumerico02" maxlength="255" value="<?php echo Funcoes::MascaraValorLer($tbPedidosValorDesconto, $GLOBALS['configSistemaMoeda']); ?>" />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemValorDescicao01"); ?>

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
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosValorAcrescimo"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>
                            <input type="text" name="valor_acrescimo" id="valor_acrescimo" class="AdmCampoNumerico02" maxlength="255" value="<?php echo Funcoes::MascaraValorLer($tbPedidosValorAcrescimo, $GLOBALS['configSistemaMoeda']); ?>" />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemValorDescicao01"); ?>

                            <?php //echo htmlentities($GLOBALS['configSistemaMoeda']); ?> <?php //echo $tbPedidosValorFrete; ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
    
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosValorTotal"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left" class="AdmTexto01">
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
                            <input type="text" name="valor_total" id="valor_total" class="AdmCampoNumerico02" maxlength="255" value="<?php echo Funcoes::MascaraValorLer($tbPedidosValorTotal, $GLOBALS['configSistemaMoeda']); ?>" />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemValorDescicao01"); ?>
                            
                            <?php //echo htmlentities($GLOBALS['configSistemaMoeda']); ?> <?php //echo $tbPedidosValorTotal; ?>
                        </div>
                    </td>
                </tr>
    
                <?php if($GLOBALS['habilitarAdministrarPedidosPeso'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosPesoTotal"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left" class="AdmTexto01">
                            <input type="text" name="peso_total" id="peso_total" class="AdmCampoNumerico02" maxlength="255" value="<?php echo $tbPedidosPesoTotal; ?>" />
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaPeso'], "IncludeConfig"); ?>

                            <?php //echo $tbPedidosPesoTotal; ?> <?php //echo htmlentities($GLOBALS['configSistemaPeso']); ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
    
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosObs"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left">
                            <textarea name="obs" id="obs" class="AdmCampoTextoMultilinha01"><?php echo $tbPedidosOBS;?></textarea>
                        </div>
                    </td>
                </tr>
    
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao3"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left" class="AdmTexto01">
                            <select name="ativacao" id="ativacao" class="AdmCampoDropDownMenu01">
                                <option value="0"<?php if($tbPedidosAtivacao == "0"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao4"); ?></option>
                                <option value="1"<?php if($tbPedidosAtivacao == "1"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao5"); ?></option>
                            </select>
                        </div>
                    </td>
                </tr>
                
				<?php if($GLOBALS['habilitarPedidosVinculo1'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosVinculo1Nome'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                                $arrPedidosVinculo1 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbPedidosVinculo1'], $GLOBALS['configIdTbTipoPedidosVinculo1'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoPedidosVinculo1'], $GLOBALS['configPedidosVinculo1Metodo']);
                            ?>
                            <select name="id_tb_cadastro1" id="id_tb_cadastro1" class="AdmCampoDropDownMenu01">
                                <option value="0"<?php if($tbPedidosIdTbCadastro1 == 0){ ?>selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option>
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
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosVinculo2Nome'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                                $arrPedidosVinculo2 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbPedidosVinculo2'], $GLOBALS['configIdTbTipoPedidosVinculo2'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoPedidosVinculo2'], $GLOBALS['configPedidosVinculo2Metodo']);
                            ?>
                            <select name="id_tb_cadastro2" id="id_tb_cadastro2" class="AdmCampoDropDownMenu01">
                                <option value="0"<?php if($tbPedidosIdTbCadastro2 == 0){ ?>selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option>
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
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosVinculo3Nome'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                                $arrPedidosVinculo3 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbPedidosVinculo3'], $GLOBALS['configIdTbTipoPedidosVinculo3'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoPedidosVinculo3'], $GLOBALS['configPedidosVinculo3Metodo']);
                            ?>
                            <select name="id_tb_cadastro3" id="id_tb_cadastro3" class="AdmCampoDropDownMenu01">
                                <option value="0"<?php if($tbPedidosIdTbCadastro3 == 0){ ?>selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option>
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
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosVinculo4Nome'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                                $arrPedidosVinculo4 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbPedidosVinculo4'], $GLOBALS['configIdTbTipoPedidosVinculo4'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoPedidosVinculo4'], $GLOBALS['configPedidosVinculo4Metodo']);
                            ?>
                            <select name="id_tb_cadastro4" id="id_tb_cadastro4" class="AdmCampoDropDownMenu01">
                                <option value="0"<?php if($tbPedidosIdTbCadastro4 == 0){ ?>selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option>
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
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosVinculo5Nome'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                                $arrPedidosVinculo5 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbPedidosVinculo5'], $GLOBALS['configIdTbTipoPedidosVinculo5'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoPedidosVinculo5'], $GLOBALS['configPedidosVinculo5Metodo']);
                            ?>
                            <select name="id_tb_cadastro5" id="id_tb_cadastro5" class="AdmCampoDropDownMenu01">
                                <option value="0"<?php if($tbPedidosIdTbCadastro5 == 0){ ?>selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option>
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
                    <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosTituloIc1'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configPedidosBoxIc1'] == 1){ ?>
                                <input type="text" name="informacao_complementar1" id="informacao_complementar1" class="AdmCampoAdmTexto01" maxlength="255" value="<?php echo $tbPedidosIC1;?>" />
                            <?php } ?>
                            <?php if($GLOBALS['configPedidosBoxIc1'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar1" id="informacao_complementar1" class="AdmCampoTextoMultilinha01"><?php echo $tbPedidosIC1;?></textarea>
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
                    <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosTituloIc2'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configPedidosBoxIc2'] == 1){ ?>
                                <input type="text" name="informacao_complementar2" id="informacao_complementar2" class="AdmCampoAdmTexto01" maxlength="255" value="<?php echo $tbPedidosIC2;?>" />
                            <?php } ?>
                            <?php if($GLOBALS['configPedidosBoxIc2'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar2" id="informacao_complementar2" class="AdmCampoTextoMultilinha01"><?php echo $tbPedidosIC2;?></textarea>
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
                    <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosTituloIc3'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configPedidosBoxIc3'] == 1){ ?>
                                <input type="text" name="informacao_complementar3" id="informacao_complementar3" class="AdmCampoAdmTexto01" maxlength="255" value="<?php echo $tbPedidosIC3;?>" />
                            <?php } ?>
                            <?php if($GLOBALS['configPedidosBoxIc3'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar3" id="informacao_complementar3" class="AdmCampoTextoMultilinha01"><?php echo $tbPedidosIC3;?></textarea>
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
                    <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosTituloIc4'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configPedidosBoxIc4'] == 1){ ?>
                                <input type="text" name="informacao_complementar4" id="informacao_complementar4" class="AdmCampoAdmTexto01" maxlength="255" value="<?php echo $tbPedidosIC4;?>" />
                            <?php } ?>
                            <?php if($GLOBALS['configPedidosBoxIc4'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar4" id="informacao_complementar4" class="AdmCampoTextoMultilinha01"><?php echo $tbPedidosIC4;?></textarea>
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
                    <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosTituloIc5'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configPedidosBoxIc5'] == 1){ ?>
                                <input type="text" name="informacao_complementar5" id="informacao_complementar5" class="AdmCampoAdmTexto01" maxlength="255" value="<?php echo $tbPedidosIC5;?>" />
                            <?php } ?>
                            <?php if($GLOBALS['configPedidosBoxIc5'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar5" id="informacao_complementar5" class="AdmCampoTextoMultilinha01"><?php echo $tbPedidosIC5;?></textarea>
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
                    <!--input type="image" name="submit" value="Submit" src="img/btoAtualizar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoAtualizar"); ?>" /-->
                    <input type="image" name="submit" value="Submit" src="img/btoFinalizar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoFinalizar"); ?>" />
                    
                    <input name="idCePedidos" type="hidden" id="idCePedidos" value="<?php echo $tbPedidosId; ?>" />
                    <input name="idTbCadastro" type="hidden" id="idTbCadastro" value="<?php echo $idTbCadastro; ?>" />
                    <input name="flagFinalizar" type="hidden" id="flagFinalizar" value="1" />
                    
                    <input name="id_tb_cadastro_cliente" type="hidden" id="id_tb_cadastro_cliente" value="<?php echo $tbPedidosIdTbCadastroCliente; ?>" />

                    <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                    <input name="masterPageSiteSelect" type="hidden" id="masterPageSiteSelect" value="<?php echo $masterPageSelect; ?>" />
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
$pageSite->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php
//Limpeza de objetos.
//----------
unset($strSqlCadastroDetalhesSelect);
unset($statementCadastroDetalhesSelect);
unset($resultadoCadastroDetalhes);
unset($linhaCadastroDetalhes);
//----------


//Inclusão do template do layout.
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>