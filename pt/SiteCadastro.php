<?php
//Importação dos arquivos de configuração.
require_once "../sistema/IncludeConfig.php"; //Deve vir antes do db.
require_once "../sistema/IncludeConexao.php";
require_once "../sistema/IncludeFuncoes.php";
//require_once "IncludeLayout.php";
require_once "IncludeLayoutSite.php";


//Resgate de variáveis.
$idTbCadastro = "3489";
if($_GET["idTbCadastro"] <> "")
{
	$idTbCadastro = $_GET["idTbCadastro"];
}

$nomeTabelaReferenciaPedidos = $_GET["nomeTabelaReferenciaPedidos"];
if($nomeTabelaReferenciaPedidos == "")
{
	$nomeTabelaReferenciaPedidos = "tb_produtos";
}

$idTipoCadastro = $_GET["idTipoCadastro"];
$idAtividadesCadastro = $_GET["idAtividadesCadastro"];

$idTbCadastroTemporario = Crypto::DecryptValue(urldecode($_GET["idTbCadastroTemporario"]));
if($idTbCadastroTemporario == "")
{
	$idTbCadastroTemporario = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura(CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroTemporario")), 2);
}else{
	//$idTbCadastroTemporarioCookieValor = Crypto::EncryptValue($idTbCadastroTemporario, 2);
	//Criação do mesmo cookie temporário no novo endereço (SSL).
	//CookiesFuncoes::CookieCriar($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroTemporario", Crypto::EncryptValue($idTbCadastroTemporario));
	CookiesFuncoes::CookieCriar($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroTemporario", Crypto::EncryptValue($idTbCadastroTemporario, 2), "");
}
//$idTbCadastroTemporario = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura($_GET["idTbCadastroTemporario"]), 2);

//Tipo Cadastro.
$configCadastroFormularioCampos = "";
$configCadastroFormularioCampos = Formularios::CadastroFormulariosCampos($idTipoCadastro); 

//Atividades.
if($idAtividadesCadastro <> "")
{
	if($GLOBALS['configCadastroFormularioCamposAtividades'] <> "")
	{
		$configCadastroFormularioCampos = Formularios::CadastroFormulariosCampos($idAtividadesCadastro); 
	}
}

//Configuração de campos.
$arrCadastroFormularioCampos = explode(",", $configCadastroFormularioCampos);
$configCadastroCamposObrigatorios = $GLOBALS['configCadastroCamposObrigatorios'];
$arrConfigCadastroCamposObrigatorios = explode(",", $configCadastroCamposObrigatorios);

$tituloLinkAtual = "";
$metaTitulo = "";
$metaDescricao = "";
$metaPalavrasChave = "";

$codSedex = $_GET["codSedex"];
$CEPEntrega = Funcoes::SomenteNum($_GET["CEPEntrega"]);
//$enderecoCobranca = "0"; 
$enderecoCobranca = $_GET["enderecoCobranca"]; //0 - Endereço de entrega não é o mesmo do de cobrança/cadastro | 1 - Endereço de entrega é o mesmo do endereço de cobrança/cadastro.
if($enderecoCobranca == "")
{
	$enderecoCobranca = "0";
}

//Endereço de entrega.
$idTbCadastroEnderecos = $_GET["idTbCadastroEnderecos"];
//$idCePedidos = $_GET["idCePedidos"];
$enderecoEntrega = $_GET["endereco_entrega"];
$enderecoNumeroEntrega = $_GET["endereco_numero_entrega"];
$enderecoComplementoEntrega = $_GET["endereco_complemento_entrega"];
$enderecoBairroEntrega = $_GET["endereco_bairro_entrega"];
$enderecoCidadeEntrega = $_GET["endereco_cidade_entrega"];
$enderecoEstadoEntrega = $_GET["endereco_estado_entrega"];
$enderecoPaisEntrega = $_GET["endereco_pais_entrega"];

//Endereço de cobrança.
$enderecoPrincipal = "";
$enderecoNumeroPrincipal = "";
$enderecoComplementoPrincipal = "";
$bairroPrincipal = "";
$cidadePrincipal = "";
$estadoPrincipal = "";
$paisPrincipal = "";
$cepPrincipal = "";

if($enderecoCobranca == "1")
{
	if($CEPEntrega <> "" && strlen($CEPEntrega) == 8)
	{
		$enderecoPrincipal = Funcoes::ConteudoMascaraLeitura(CEP::CEPFill($CEPEntrega, "logradouro"));
		
		$enderecoNumeroPrincipal = $enderecoNumeroEntrega;
		$enderecoComplementoPrincipal = $enderecoComplementoEntrega;
	
		$bairroPrincipal = Funcoes::ConteudoMascaraLeitura(CEP::CEPFill($CEPEntrega, "bairro"));
		$cidadePrincipal = Funcoes::ConteudoMascaraLeitura(CEP::CEPFill($CEPEntrega, "cidade"));
		$estadoPrincipal = Funcoes::ConteudoMascaraLeitura(CEP::CEPFill($CEPEntrega, "ufCodigo"));
		$paisPrincipal = Funcoes::ConteudoMascaraLeitura(CEP::CEPFill($CEPEntrega, "pais"));
	
		if($GLOBALS['configCadastroCEPMascara'] == 1)
		{
			$cepPrincipal = Funcoes::FormatarCEPLer($CEPEntrega);
		}else{
			$cepPrincipal = $CEPEntrega;
		}
	}
}

$pesoTotalCarrinho = $_GET["pesoTotalCarrinho"];
$valorFrete = $_GET["valorFrete"];
if($valorFrete == "")
{
	$valorFrete = 0;	
}
$valorPedido = $_GET["valorPedido"];
if($valorPedido == "")
{
	$valorPedido = 0;	
}
$valorTotal = $valorPedido + $valorFrete;

//Afiliações.
$idItem = $_GET["idItem"];
$quantidadeAfiliacao = $_GET["quantidadeAfiliacao"];
	
$paginaRetorno = "SiteCadastro.php";
//$paginaRetornoExclusao = "SiteProdutosDetalhes.php";
//$variavelRetorno = "idTbProdutos";
//$idRetorno = $idTbProdutos;
//$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];
$mensagemAlerta = $_GET["mensagemAlerta"];

//Montagem de query padrão de retorno.
//"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
$queryPadrao = "&paginaRetorno=" . $paginaRetorno . 
"&masterPageSiteSelect=" . $masterPageSiteSelect . 
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Definição de variáveis.

//Montagem das meta tags.
//----------
$tituloLinkAtual = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastro");
$metaTitulo = Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloSite'], "IncludeConfig") . " - " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastro");
//----------


//Verificação de erro - debug.
//echo "metaTitulo=" . $metaTitulo . "<br />";
//echo "idTbCadastroTemporario=" . $idTbCadastroTemporario . "<br />";
//echo "idTbCadastroTemporario - Cookie(Crypto::DecryptValue)=" . Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura(CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroTemporario")), 2) . "<br />";
//echo "idTipoCadastro=" . $idTipoCadastro . "<br />";
//echo "configCadastroFormularioCampos=" . $configCadastroFormularioCampos . "<br />";
//print_r($arrCadastroFormularioCampos);
//echo "idTbCadastroTemporario=" . $idTbCadastroTemporario . "<br />";
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo $metaTitulo; ?>
<?php 
$pageSite->cphTitle = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Head.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphHead*/ ?>
    <meta name="description" content="<?php echo $metaDescricao; ?>" /><?php //Abaixo de 160 caracteres.?>
    <meta name="keywords" content="<?php echo $metaPalavrasChave; ?>" /><?php //Abaixo de 100 caracteres.?>
    <meta name="title" content="<?php echo $metaTitulo; ?>" /><?php //Abaixo de 60 caracteres.?>
<?php 
$pageSite->cphHead = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Título atual.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphConteudoCabecalho*/ ?>
	<?php echo $tituloLinkAtual; ?>
<?php 
$pageSite->cphTituloLinkAtual = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Conteúdo principal.?>
<?php //**************************************************************************************?>
<?php ob_start(); /*cphConteudoPrincipal*/ ?>
    <div id="lblMensagemErro" align="center" class="AdmErro">
        <?php echo $mensagemErro;?>
    </div>
    <div id="lblMensagemSucesso" align="center" class="AdmSucesso">
        <?php echo $mensagemSucesso;?>
    </div>
    <div id="lblMensagemAlerta" align="center" class="AdmAlerta">
        <?php echo $mensagemAlerta;?>
    </div>
    
    
	<?php //Diagramação 1.?>
    <?php //**************************************************************************************?>
    <div align="center" style="position: relative; display: block;">
		<script type="text/javascript">
            $(document).ready(function () {
                //Parâmetro personalizado.
                //**************************************************************************************
				jQuery.validator.addMethod("notEqual", function(value, element, param)
				{
					return this.optional(element) || value != param;
				}, "Escolha um valor.");
				

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
				
				
				/*
				//Causando conflito com input file. Pesquisa solução alternativa.
                jQuery.validator.addMethod("accept", function(value, element, param) {
                    //return value.match(new RegExp("^" + param + "$"));
                    return value.match(new RegExp(param));
                });	
				*/
                //**************************************************************************************
    
                    
                //Validação de formulário (JQuery).
                //**************************************************************************************
                $('#formCadastro').validate({ //Inicialização do plug-in.
                    //Estilo da mensagem de erro.
                    //----------------------
                    errorClass: "AdmErro",
                    //----------------------
					
					
					//Posicionamento da mensagem de erro.
					//----------------------
					//errorElement: 'div',
					errorPlacement: function(error, element)
					{
						//Padrão.
						error.insertAfter(element);
						
						<?php if($GLOBALS['configCadastroFiltroGenerico01CaixaSelecao'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico01", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							if(element.attr("name") == "idsCadastroFiltroGenerico01[]")
							{
								error.insertBefore('#divIdsCadastroFiltroGenerico01');
							}
							<?php } ?>
						<?php } ?>
						
						<?php if($GLOBALS['configCadastroFiltroGenerico02CaixaSelecao'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico02", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							if(element.attr("name") == "idsCadastroFiltroGenerico02[]")
							{
								error.insertBefore('#divIdsCadastroFiltroGenerico02');
							}
							<?php } ?>
						<?php } ?>
						
						<?php if($GLOBALS['configCadastroFiltroGenerico03CaixaSelecao'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico03", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							if(element.attr("name") == "idsCadastroFiltroGenerico03[]")
							{
								error.insertBefore('#divIdsCadastroFiltroGenerico03');
							}
							<?php } ?>
						<?php } ?>
						
						<?php if($GLOBALS['configCadastroFiltroGenerico04CaixaSelecao'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico04", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							if(element.attr("name") == "idsCadastroFiltroGenerico04[]")
							{
								error.insertBefore('#divIdsCadastroFiltroGenerico04');
							}
							<?php } ?>
						<?php } ?>
						
						<?php if($GLOBALS['configCadastroFiltroGenerico05CaixaSelecao'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico05", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							if(element.attr("name") == "idsCadastroFiltroGenerico05[]")
							{
								error.insertBefore('#divIdsCadastroFiltroGenerico05');
							}
							<?php } ?>
						<?php } ?>
						
						<?php if($GLOBALS['configCadastroFiltroGenerico06CaixaSelecao'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico06", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							if(element.attr("name") == "idsCadastroFiltroGenerico06[]")
							{
								error.insertBefore('#divIdsCadastroFiltroGenerico06');
							}
							<?php } ?>
						<?php } ?>
						
						<?php if($GLOBALS['configCadastroFiltroGenerico07CaixaSelecao'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico07", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							if(element.attr("name") == "idsCadastroFiltroGenerico07[]")
							{
								error.insertBefore('#divIdsCadastroFiltroGenerico07');
							}
							<?php } ?>
						<?php } ?>
						
						<?php if($GLOBALS['configCadastroFiltroGenerico08CaixaSelecao'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico08", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							if(element.attr("name") == "idsCadastroFiltroGenerico08[]")
							{
								error.insertBefore('#divIdsCadastroFiltroGenerico08');
							}
							<?php } ?>
						<?php } ?>
						
						<?php if($GLOBALS['configCadastroFiltroGenerico09CaixaSelecao'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico09", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							if(element.attr("name") == "idsCadastroFiltroGenerico09[]")
							{
								error.insertBefore('#divIdsCadastroFiltroGenerico09');
							}
							<?php } ?>
						<?php } ?>
						
						<?php if($GLOBALS['configCadastroFiltroGenerico10CaixaSelecao'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico10", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							if(element.attr("name") == "idsCadastroFiltroGenerico10[]")
							{
								error.insertBefore('#divIdsCadastroFiltroGenerico10');
							}
							<?php } ?>
						<?php } ?>
						
						<?php if($GLOBALS['configCadastroFiltroGenerico11CaixaSelecao'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico11", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							if(element.attr("name") == "idsCadastroFiltroGenerico11[]")
							{
								error.insertBefore('#divIdsCadastroFiltroGenerico11');
							}
							<?php } ?>
						<?php } ?>
						
						<?php if($GLOBALS['configCadastroFiltroGenerico12CaixaSelecao'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico12", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							if(element.attr("name") == "idsCadastroFiltroGenerico12[]")
							{
								error.insertBefore('#divIdsCadastroFiltroGenerico12');
							}
							<?php } ?>
						<?php } ?>
						
						<?php if($GLOBALS['configCadastroFiltroGenerico13CaixaSelecao'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico13", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							if(element.attr("name") == "idsCadastroFiltroGenerico13[]")
							{
								error.insertBefore('#divIdsCadastroFiltroGenerico13');
							}
							<?php } ?>
						<?php } ?>
						
						<?php if($GLOBALS['configCadastroFiltroGenerico14CaixaSelecao'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico14", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							if(element.attr("name") == "idsCadastroFiltroGenerico14[]")
							{
								error.insertBefore('#divIdsCadastroFiltroGenerico14');
							}
							<?php } ?>
						<?php } ?>
						
						<?php if($GLOBALS['configCadastroFiltroGenerico15CaixaSelecao'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico15", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							if(element.attr("name") == "idsCadastroFiltroGenerico15[]")
							{
								error.insertBefore('#divIdsCadastroFiltroGenerico15');
							}
							<?php } ?>
						<?php } ?>
						
						<?php if($GLOBALS['configCadastroFiltroGenerico16CaixaSelecao'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico16", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							if(element.attr("name") == "idsCadastroFiltroGenerico16[]")
							{
								error.insertBefore('#divIdsCadastroFiltroGenerico16');
							}
							<?php } ?>
						<?php } ?>
						
						<?php if($GLOBALS['configCadastroFiltroGenerico17CaixaSelecao'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico17", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							if(element.attr("name") == "idsCadastroFiltroGenerico17[]")
							{
								error.insertBefore('#divIdsCadastroFiltroGenerico17');
							}
							<?php } ?>
						<?php } ?>
						
						<?php if($GLOBALS['configCadastroFiltroGenerico18CaixaSelecao'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico18", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							if(element.attr("name") == "idsCadastroFiltroGenerico18[]")
							{
								error.insertBefore('#divIdsCadastroFiltroGenerico18');
							}
							<?php } ?>
						<?php } ?>
						
						<?php if($GLOBALS['configCadastroFiltroGenerico19CaixaSelecao'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico19", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							if(element.attr("name") == "idsCadastroFiltroGenerico19[]")
							{
								error.insertBefore('#divIdsCadastroFiltroGenerico19');
							}
							<?php } ?>
						<?php } ?>
						
						<?php if($GLOBALS['configCadastroFiltroGenerico20CaixaSelecao'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico20", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							if(element.attr("name") == "idsCadastroFiltroGenerico20[]")
							{
								error.insertBefore('#divIdsCadastroFiltroGenerico20');
							}
							<?php } ?>
						<?php } ?>
						
						<?php if($GLOBALS['configCadastroFiltroGenerico21CaixaSelecao'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico21", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							if(element.attr("name") == "idsCadastroFiltroGenerico21[]")
							{
								error.insertBefore('#divIdsCadastroFiltroGenerico21');
							}
							<?php } ?>
						<?php } ?>
						
						<?php if($GLOBALS['configCadastroFiltroGenerico22CaixaSelecao'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico22", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							if(element.attr("name") == "idsCadastroFiltroGenerico22[]")
							{
								error.insertBefore('#divIdsCadastroFiltroGenerico22');
							}
							<?php } ?>
						<?php } ?>
						
						<?php if($GLOBALS['configCadastroFiltroGenerico23CaixaSelecao'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico23", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							if(element.attr("name") == "idsCadastroFiltroGenerico23[]")
							{
								error.insertBefore('#divIdsCadastroFiltroGenerico23');
							}
							<?php } ?>
						<?php } ?>
						
						<?php if($GLOBALS['configCadastroFiltroGenerico24CaixaSelecao'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico24", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							if(element.attr("name") == "idsCadastroFiltroGenerico24[]")
							{
								error.insertBefore('#divIdsCadastroFiltroGenerico24');
							}
							<?php } ?>
						<?php } ?>
						
						<?php if($GLOBALS['configCadastroFiltroGenerico25CaixaSelecao'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico25", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							if(element.attr("name") == "idsCadastroFiltroGenerico25[]")
							{
								error.insertBefore('#divIdsCadastroFiltroGenerico25');
							}
							<?php } ?>
						<?php } ?>
						
						<?php if($GLOBALS['configCadastroFiltroGenerico26CaixaSelecao'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico26", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							if(element.attr("name") == "idsCadastroFiltroGenerico26[]")
							{
								error.insertBefore('#divIdsCadastroFiltroGenerico26');
							}
							<?php } ?>
						<?php } ?>
						
						<?php if($GLOBALS['configCadastroFiltroGenerico27CaixaSelecao'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico27", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							if(element.attr("name") == "idsCadastroFiltroGenerico27[]")
							{
								error.insertBefore('#divIdsCadastroFiltroGenerico27');
							}
							<?php } ?>
						<?php } ?>
						
						<?php if($GLOBALS['configCadastroFiltroGenerico28CaixaSelecao'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico28", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							if(element.attr("name") == "idsCadastroFiltroGenerico28[]")
							{
								error.insertBefore('#divIdsCadastroFiltroGenerico28');
							}
							<?php } ?>
						<?php } ?>
						
						<?php if($GLOBALS['configCadastroFiltroGenerico29CaixaSelecao'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico29", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							if(element.attr("name") == "idsCadastroFiltroGenerico29[]")
							{
								error.insertBefore('#divIdsCadastroFiltroGenerico29');
							}
							<?php } ?>
						<?php } ?>
						
						<?php if($GLOBALS['configCadastroFiltroGenerico30CaixaSelecao'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico30", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							if(element.attr("name") == "idsCadastroFiltroGenerico30[]")
							{
								error.insertBefore('#divIdsCadastroFiltroGenerico30');
							}
							<?php } ?>
						<?php } ?>
						
						<?php if($GLOBALS['habilitarCadastroVerificarTermo'] == 1){ ?>
							<?php if(in_array("termo", $arrCadastroFormularioCampos) == true){ ?>
							if(element.attr("name") == "termo_compromisso")
							{
								error.insertBefore('#divTermoCompromisso');
							}
							<?php } ?>
						<?php } ?>
						
						
						//else
						//{
							//error.insertAfter(element);    
						//}
				
					},
                    //----------------------
					
					
                    //Validação
                    //----------------------
                    rules: {
						/*
                        n_classificacao: {
                            required: true,
                            //regex: /-?\d+(\.\d{1,3})?/
                            number: true
                        },
						*/
						
						//Filtros genérico.
						<?php if($GLOBALS['habilitarCadastroFiltroGenerico01'] == 1){ ?>
						<?php if(in_array("ids_cadastro_filtro_generico01", $arrConfigCadastroCamposObrigatorios) == true){ ?>
						'idsCadastroFiltroGenerico01[]': 
						{
							<?php if($GLOBALS['configCadastroFiltroGenerico01CaixaSelecao'] == 3){ ?>
								notEqual: "0",
								required: false
							<?php }else{ ?>
								required: true
							<?php } ?>
						},
						<?php } ?>
						<?php } ?>

						<?php if($GLOBALS['habilitarCadastroFiltroGenerico02'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico02", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							'idsCadastroFiltroGenerico02[]': 
							{
								<?php if($GLOBALS['configCadastroFiltroGenerico02CaixaSelecao'] == 3){ ?>
									notEqual: "0",
									required: false
								<?php }else{ ?>
									required: true
								<?php } ?>
							},
							<?php } ?>
						<?php } ?>

						<?php if($GLOBALS['habilitarCadastroFiltroGenerico03'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico03", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							'idsCadastroFiltroGenerico03[]': 
							{
								<?php if($GLOBALS['configCadastroFiltroGenerico03CaixaSelecao'] == 3){ ?>
									notEqual: "0",
									required: false
								<?php }else{ ?>
									required: true
								<?php } ?>
							},
							<?php } ?>
						<?php } ?>

						<?php if($GLOBALS['habilitarCadastroFiltroGenerico04'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico04", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							'idsCadastroFiltroGenerico04[]': 
							{
								<?php if($GLOBALS['configCadastroFiltroGenerico04CaixaSelecao'] == 3){ ?>
									notEqual: "0",
									required: false
								<?php }else{ ?>
									required: true
								<?php } ?>
							},
							<?php } ?>
						<?php } ?>

						<?php if($GLOBALS['habilitarCadastroFiltroGenerico05'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico05", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							'idsCadastroFiltroGenerico05[]': 
							{
								<?php if($GLOBALS['configCadastroFiltroGenerico05CaixaSelecao'] == 3){ ?>
									notEqual: "0",
									required: false
								<?php }else{ ?>
									required: true
								<?php } ?>
							},
							<?php } ?>
						<?php } ?>

						<?php if($GLOBALS['habilitarCadastroFiltroGenerico06'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico06", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							'idsCadastroFiltroGenerico06[]': 
							{
								<?php if($GLOBALS['configCadastroFiltroGenerico06CaixaSelecao'] == 3){ ?>
									notEqual: "0",
									required: false
								<?php }else{ ?>
									required: true
								<?php } ?>
							},
							<?php } ?>
						<?php } ?>

						<?php if($GLOBALS['habilitarCadastroFiltroGenerico07'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico07", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							'idsCadastroFiltroGenerico07[]': 
							{
								<?php if($GLOBALS['configCadastroFiltroGenerico07CaixaSelecao'] == 3){ ?>
									notEqual: "0",
									required: false
								<?php }else{ ?>
									required: true
								<?php } ?>
							},
							<?php } ?>
						<?php } ?>

						<?php if($GLOBALS['habilitarCadastroFiltroGenerico08'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico08", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							'idsCadastroFiltroGenerico08[]': 
							{
								<?php if($GLOBALS['configCadastroFiltroGenerico08CaixaSelecao'] == 3){ ?>
									notEqual: "0",
									required: false
								<?php }else{ ?>
									required: true
								<?php } ?>
							},
							<?php } ?>
						<?php } ?>

						<?php if($GLOBALS['habilitarCadastroFiltroGenerico09'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico09", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							'idsCadastroFiltroGenerico09[]': 
							{
								<?php if($GLOBALS['configCadastroFiltroGenerico09CaixaSelecao'] == 3){ ?>
									notEqual: "0",
									required: false
								<?php }else{ ?>
									required: true
								<?php } ?>
							},
							<?php } ?>
						<?php } ?>

						<?php if($GLOBALS['habilitarCadastroFiltroGenerico10'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico10", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							'idsCadastroFiltroGenerico10[]': 
							{
								<?php if($GLOBALS['configCadastroFiltroGenerico10CaixaSelecao'] == 3){ ?>
									notEqual: "0",
									required: false
								<?php }else{ ?>
									required: true
								<?php } ?>
							},
							<?php } ?>
						<?php } ?>

						<?php if($GLOBALS['habilitarCadastroFiltroGenerico11'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico11", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							'idsCadastroFiltroGenerico11[]': 
							{
								<?php if($GLOBALS['configCadastroFiltroGenerico11CaixaSelecao'] == 3){ ?>
									notEqual: "0",
									required: false
								<?php }else{ ?>
									required: true
								<?php } ?>
							},
							<?php } ?>
						<?php } ?>

						<?php if($GLOBALS['habilitarCadastroFiltroGenerico12'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico12", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							'idsCadastroFiltroGenerico12[]': 
							{
								<?php if($GLOBALS['configCadastroFiltroGenerico12CaixaSelecao'] == 3){ ?>
									notEqual: "0",
									required: false
								<?php }else{ ?>
									required: true
								<?php } ?>
							},
							<?php } ?>
						<?php } ?>

						<?php if($GLOBALS['habilitarCadastroFiltroGenerico13'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico13", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							'idsCadastroFiltroGenerico13[]': 
							{
								<?php if($GLOBALS['configCadastroFiltroGenerico13CaixaSelecao'] == 3){ ?>
									notEqual: "0",
									required: false
								<?php }else{ ?>
									required: true
								<?php } ?>
							},
							<?php } ?>
						<?php } ?>

						<?php if($GLOBALS['habilitarCadastroFiltroGenerico14'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico14", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							'idsCadastroFiltroGenerico14[]': 
							{
								<?php if($GLOBALS['configCadastroFiltroGenerico14CaixaSelecao'] == 3){ ?>
									notEqual: "0",
									required: false
								<?php }else{ ?>
									required: true
								<?php } ?>
							},
							<?php } ?>
						<?php } ?>

						<?php if($GLOBALS['habilitarCadastroFiltroGenerico15'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico15", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							'idsCadastroFiltroGenerico15[]': 
							{
								<?php if($GLOBALS['configCadastroFiltroGenerico15CaixaSelecao'] == 3){ ?>
									notEqual: "0",
									required: false
								<?php }else{ ?>
									required: true
								<?php } ?>
							},
							<?php } ?>
						<?php } ?>

						<?php if($GLOBALS['habilitarCadastroFiltroGenerico16'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico16", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							'idsCadastroFiltroGenerico16[]': 
							{
								<?php if($GLOBALS['configCadastroFiltroGenerico16CaixaSelecao'] == 3){ ?>
									notEqual: "0",
									required: false
								<?php }else{ ?>
									required: true
								<?php } ?>
							},
							<?php } ?>
						<?php } ?>

						<?php if($GLOBALS['habilitarCadastroFiltroGenerico17'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico17", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							'idsCadastroFiltroGenerico17[]': 
							{
								<?php if($GLOBALS['configCadastroFiltroGenerico17CaixaSelecao'] == 3){ ?>
									notEqual: "0",
									required: false
								<?php }else{ ?>
									required: true
								<?php } ?>
							},
							<?php } ?>
						<?php } ?>

						<?php if($GLOBALS['habilitarCadastroFiltroGenerico18'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico18", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							'idsCadastroFiltroGenerico18[]': 
							{
								<?php if($GLOBALS['configCadastroFiltroGenerico18CaixaSelecao'] == 3){ ?>
									notEqual: "0",
									required: false
								<?php }else{ ?>
									required: true
								<?php } ?>
							},
							<?php } ?>
						<?php } ?>

						<?php if($GLOBALS['habilitarCadastroFiltroGenerico19'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico19", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							'idsCadastroFiltroGenerico19[]': 
							{
								<?php if($GLOBALS['configCadastroFiltroGenerico19CaixaSelecao'] == 3){ ?>
									notEqual: "0",
									required: false
								<?php }else{ ?>
									required: true
								<?php } ?>
							},
							<?php } ?>
						<?php } ?>

						<?php if($GLOBALS['habilitarCadastroFiltroGenerico20'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico20", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							'idsCadastroFiltroGenerico20[]': 
							{
								<?php if($GLOBALS['configCadastroFiltroGenerico20CaixaSelecao'] == 3){ ?>
									notEqual: "0",
									required: false
								<?php }else{ ?>
									required: true
								<?php } ?>
							},
							<?php } ?>
						<?php } ?>
						
						<?php if($GLOBALS['habilitarCadastroFiltroGenerico21'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico21", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							'idsCadastroFiltroGenerico21[]': 
							{
								<?php if($GLOBALS['configCadastroFiltroGenerico21CaixaSelecao'] == 3){ ?>
									notEqual: "0",
									required: false
								<?php }else{ ?>
									required: true
								<?php } ?>
							},
							<?php } ?>
						<?php } ?>

						<?php if($GLOBALS['habilitarCadastroFiltroGenerico22'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico22", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							'idsCadastroFiltroGenerico22[]': 
							{
								<?php if($GLOBALS['configCadastroFiltroGenerico22CaixaSelecao'] == 3){ ?>
									notEqual: "0",
									required: false
								<?php }else{ ?>
									required: true
								<?php } ?>
							},
							<?php } ?>
						<?php } ?>

						<?php if($GLOBALS['habilitarCadastroFiltroGenerico23'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico23", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							'idsCadastroFiltroGenerico23[]': 
							{
								<?php if($GLOBALS['configCadastroFiltroGenerico23CaixaSelecao'] == 3){ ?>
									notEqual: "0",
									required: false
								<?php }else{ ?>
									required: true
								<?php } ?>
							},
							<?php } ?>
						<?php } ?>

						<?php if($GLOBALS['habilitarCadastroFiltroGenerico24'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico24", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							'idsCadastroFiltroGenerico24[]': 
							{
								<?php if($GLOBALS['configCadastroFiltroGenerico24CaixaSelecao'] == 3){ ?>
									notEqual: "0",
									required: false
								<?php }else{ ?>
									required: true
								<?php } ?>
							},
							<?php } ?>
						<?php } ?>

						<?php if($GLOBALS['habilitarCadastroFiltroGenerico25'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico25", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							'idsCadastroFiltroGenerico25[]': 
							{
								<?php if($GLOBALS['configCadastroFiltroGenerico25CaixaSelecao'] == 3){ ?>
									notEqual: "0",
									required: false
								<?php }else{ ?>
									required: true
								<?php } ?>
							},
							<?php } ?>
						<?php } ?>

						<?php if($GLOBALS['habilitarCadastroFiltroGenerico26'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico26", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							'idsCadastroFiltroGenerico26[]': 
							{
								<?php if($GLOBALS['configCadastroFiltroGenerico26CaixaSelecao'] == 3){ ?>
									notEqual: "0",
									required: false
								<?php }else{ ?>
									required: true
								<?php } ?>
							},
							<?php } ?>
						<?php } ?>

						<?php if($GLOBALS['habilitarCadastroFiltroGenerico27'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico27", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							'idsCadastroFiltroGenerico27[]': 
							{
								<?php if($GLOBALS['configCadastroFiltroGenerico27CaixaSelecao'] == 3){ ?>
									notEqual: "0",
									required: false
								<?php }else{ ?>
									required: true
								<?php } ?>
							},
							<?php } ?>
						<?php } ?>

						<?php if($GLOBALS['habilitarCadastroFiltroGenerico28'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico28", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							'idsCadastroFiltroGenerico28[]': 
							{
								<?php if($GLOBALS['configCadastroFiltroGenerico28CaixaSelecao'] == 3){ ?>
									notEqual: "0",
									required: false
								<?php }else{ ?>
									required: true
								<?php } ?>
							},
							<?php } ?>
						<?php } ?>

						<?php if($GLOBALS['habilitarCadastroFiltroGenerico29'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico29", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							'idsCadastroFiltroGenerico29[]': 
							{
								<?php if($GLOBALS['configCadastroFiltroGenerico29CaixaSelecao'] == 3){ ?>
									notEqual: "0",
									required: false
								<?php }else{ ?>
									required: true
								<?php } ?>
							},
							<?php } ?>
						<?php } ?>

						<?php if($GLOBALS['habilitarCadastroFiltroGenerico30'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico30", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							'idsCadastroFiltroGenerico30[]': 
							{
								<?php if($GLOBALS['configCadastroFiltroGenerico30CaixaSelecao'] == 3){ ?>
									notEqual: "0",
									required: false
								<?php }else{ ?>
									required: true
								<?php } ?>
							},
							<?php } ?>
						<?php } ?>
						

						<?php if(in_array("data1", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'data1': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("data2", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'data2': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("data3", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'data3': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("data4", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'data4': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("data5", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'data5': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("data6", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'data6': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("data7", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'data7': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("data8", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'data8': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("data9", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'data9': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("data10", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'data10': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("nome", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'nome': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("altura", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'altura': {
                            required: true,
                            number: true
                        },
						<?php } ?>
						
						<?php if(in_array("peso", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'peso': {
                            required: true,
                            number: true
                        },
						<?php } ?>
						
						<?php if(in_array("razao_social", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'razao_social': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("nome_fantasia", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'nome_fantasia': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("data_nascimento", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'data_nascimento': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("cpf_", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'cpf_': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("rg_", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'rg_': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("cnpj_", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'cnpj_': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("documento", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'documento': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("i_municipal", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'i_municipal': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("i_estadual", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'i_estadual': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("endereco_principal", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'endereco_principal': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("endereco_numero_principal", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'endereco_numero_principal': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("endereco_complemento_principal", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'endereco_complemento_principal': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("bairro_principal", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'bairro_principal': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("cidade_principal", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'cidade_principal': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("estado_principal", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'estado_principal': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("pais_principal", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'pais_principal': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("cep_principal", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'cep_principal': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("ponto_referencia", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'ponto_referencia': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("tel_ddd_principal", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'tel_ddd_principal': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("tel_principal", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'tel_principal': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("cel_ddd_principal", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'cel_ddd_principal': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("cel_principal", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'cel_principal': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("fax_ddd_principal", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'fax_ddd_principal': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("fax_principal", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'fax_principal': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("site_principal", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'site_principal': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("obs_interno", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'obs_interno': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("usuario", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'usuario': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("senha", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'senha': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("imagem", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'ArquivoUpload': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("arquivo1", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'ArquivoUpload1': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("arquivo2", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'ArquivoUpload2': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("arquivo3", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'ArquivoUpload3': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("arquivo4", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'ArquivoUpload4': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("arquivo5", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'ArquivoUpload5': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("mapa_online", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'mapa_online': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("palavras_chave", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'palavras_chave': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("apresentacao", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'apresentacao': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("servicos", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'servicos': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("promocoes", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'promocoes': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("condicoes_comerciais", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'ondicoes_comerciais': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("formas_pagamento", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'formas_pagamento': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("horario_atendimento", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'horario_atendimento': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("situacao_atual", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'situacao_atual': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar1", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar1': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar2", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar2': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar3", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar3': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar4", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar4': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar5", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar5': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar6", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar6': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar7", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar7': {
                            required: true,
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar8", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar8': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar9", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar9': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar10", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar10': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar11", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar11': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar12", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar12': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar13", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar13': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar14", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar14': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar15", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar15': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar16", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar16': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar17", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar17': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar18", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar18': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar19", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar19': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar20", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar20': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar21", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar21': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar22", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar22': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar23", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar23': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar24", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar24': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar25", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar25': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar26", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar26': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar27", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar27': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar28", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar28': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar29", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar29': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar30", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar30': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar31", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar31': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar32", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar32': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar33", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar33': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar34", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar34': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar35", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar35': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar36", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar36': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar37", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar37': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar38", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar38': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar39", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar39': {
                            required: true
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar40", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar40': {
                            required: true
                        },
						<?php } ?>
						
						<?php if($GLOBALS['habilitarCadastroVerificarTermo'] == 1){ ?>
							<?php if(in_array("termo", $arrCadastroFormularioCampos) == true){ ?>
							'termo_compromisso': 
							{
									required: true
							},
							<?php } ?>
						<?php } ?>
						
                        'email_principal': {
                            required: true
                        }
                    },
                    
                    
                    //Mensagens.
                    //----------------------
                    messages: {
                        //n_classificacao: "Please specify your name"//,
						/*
                        n_classificacao: {
                          //required: "Campo obrigatório.",
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica2"); ?>",
                          //regex: "Campo numérico."
                          //number: "Campo numérico."
                          number: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica1"); ?>"
                        },
						*/
						
						//Filtros genérico.
						<?php if($GLOBALS['habilitarCadastroFiltroGenerico01'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico01", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							'idsCadastroFiltroGenerico01[]': 
							{
								<?php if($GLOBALS['configCadastroFiltroGenerico01CaixaSelecao'] == 3){ ?>
									notEqual: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4"); ?>"
								<?php }else{ ?>
									required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4"); ?>"
								<?php } ?>
							},
							<?php } ?>
						<?php } ?>
						
						<?php if($GLOBALS['habilitarCadastroFiltroGenerico02'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico02", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							'idsCadastroFiltroGenerico02[]': 
							{
								<?php if($GLOBALS['configCadastroFiltroGenerico02CaixaSelecao'] == 3){ ?>
									notEqual: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4"); ?>"
								<?php }else{ ?>
									required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4"); ?>"
								<?php } ?>
							},
							<?php } ?>
						<?php } ?>
						
						<?php if($GLOBALS['habilitarCadastroFiltroGenerico03'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico03", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							'idsCadastroFiltroGenerico03[]': 
							{
								<?php if($GLOBALS['configCadastroFiltroGenerico03CaixaSelecao'] == 3){ ?>
									notEqual: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4"); ?>"
								<?php }else{ ?>
									required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4"); ?>"
								<?php } ?>
							},
							<?php } ?>
						<?php } ?>
						
						<?php if($GLOBALS['habilitarCadastroFiltroGenerico04'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico04", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							'idsCadastroFiltroGenerico04[]': 
							{
								<?php if($GLOBALS['configCadastroFiltroGenerico04CaixaSelecao'] == 3){ ?>
									notEqual: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4"); ?>"
								<?php }else{ ?>
									required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4"); ?>"
								<?php } ?>
							},
							<?php } ?>
						<?php } ?>
						
						<?php if($GLOBALS['habilitarCadastroFiltroGenerico05'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico05", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							'idsCadastroFiltroGenerico05[]': 
							{
								<?php if($GLOBALS['configCadastroFiltroGenerico05CaixaSelecao'] == 3){ ?>
									notEqual: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4"); ?>"
								<?php }else{ ?>
									required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4"); ?>"
								<?php } ?>
							},
							<?php } ?>
						<?php } ?>
						
						<?php if($GLOBALS['habilitarCadastroFiltroGenerico06'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico06", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							'idsCadastroFiltroGenerico06[]': 
							{
								<?php if($GLOBALS['configCadastroFiltroGenerico06CaixaSelecao'] == 3){ ?>
									notEqual: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4"); ?>"
								<?php }else{ ?>
									required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4"); ?>"
								<?php } ?>
							},
							<?php } ?>
						<?php } ?>
						
						<?php if($GLOBALS['habilitarCadastroFiltroGenerico07'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico07", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							'idsCadastroFiltroGenerico07[]': 
							{
								<?php if($GLOBALS['configCadastroFiltroGenerico07CaixaSelecao'] == 3){ ?>
									notEqual: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4"); ?>"
								<?php }else{ ?>
									required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4"); ?>"
								<?php } ?>
							},
							<?php } ?>
						<?php } ?>
						
						<?php if($GLOBALS['habilitarCadastroFiltroGenerico08'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico08", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							'idsCadastroFiltroGenerico08[]': 
							{
								<?php if($GLOBALS['configCadastroFiltroGenerico08CaixaSelecao'] == 3){ ?>
									notEqual: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4"); ?>"
								<?php }else{ ?>
									required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4"); ?>"
								<?php } ?>
							},
							<?php } ?>
						<?php } ?>
						
						<?php if($GLOBALS['habilitarCadastroFiltroGenerico09'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico09", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							'idsCadastroFiltroGenerico09[]': 
							{
								<?php if($GLOBALS['configCadastroFiltroGenerico09CaixaSelecao'] == 3){ ?>
									notEqual: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4"); ?>"
								<?php }else{ ?>
									required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4"); ?>"
								<?php } ?>
							},
							<?php } ?>
						<?php } ?>
						
						<?php if($GLOBALS['habilitarCadastroFiltroGenerico10'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico10", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							'idsCadastroFiltroGenerico10[]': 
							{
								<?php if($GLOBALS['configCadastroFiltroGenerico10CaixaSelecao'] == 3){ ?>
									notEqual: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4"); ?>"
								<?php }else{ ?>
									required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4"); ?>"
								<?php } ?>
							},
							<?php } ?>
						<?php } ?>
						
						<?php if($GLOBALS['habilitarCadastroFiltroGenerico11'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico11", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							'idsCadastroFiltroGenerico11[]': 
							{
								<?php if($GLOBALS['configCadastroFiltroGenerico11CaixaSelecao'] == 3){ ?>
									notEqual: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4"); ?>"
								<?php }else{ ?>
									required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4"); ?>"
								<?php } ?>
							},
							<?php } ?>
						<?php } ?>
						
						<?php if($GLOBALS['habilitarCadastroFiltroGenerico12'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico12", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							'idsCadastroFiltroGenerico12[]': 
							{
								<?php if($GLOBALS['configCadastroFiltroGenerico12CaixaSelecao'] == 3){ ?>
									notEqual: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4"); ?>"
								<?php }else{ ?>
									required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4"); ?>"
								<?php } ?>
							},
							<?php } ?>
						<?php } ?>
						
						<?php if($GLOBALS['habilitarCadastroFiltroGenerico13'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico13", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							'idsCadastroFiltroGenerico13[]': 
							{
								<?php if($GLOBALS['configCadastroFiltroGenerico13CaixaSelecao'] == 3){ ?>
									notEqual: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4"); ?>"
								<?php }else{ ?>
									required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4"); ?>"
								<?php } ?>
							},
							<?php } ?>
						<?php } ?>
						
						<?php if($GLOBALS['habilitarCadastroFiltroGenerico14'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico14", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							'idsCadastroFiltroGenerico14[]': 
							{
								<?php if($GLOBALS['configCadastroFiltroGenerico14CaixaSelecao'] == 3){ ?>
									notEqual: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4"); ?>"
								<?php }else{ ?>
									required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4"); ?>"
								<?php } ?>
							},
							<?php } ?>
						<?php } ?>
						
						<?php if($GLOBALS['habilitarCadastroFiltroGenerico15'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico15", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							'idsCadastroFiltroGenerico15[]': 
							{
								<?php if($GLOBALS['configCadastroFiltroGenerico15CaixaSelecao'] == 3){ ?>
									notEqual: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4"); ?>"
								<?php }else{ ?>
									required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4"); ?>"
								<?php } ?>
							},
							<?php } ?>
						<?php } ?>
						
						<?php if($GLOBALS['habilitarCadastroFiltroGenerico16'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico16", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							'idsCadastroFiltroGenerico16[]': 
							{
								<?php if($GLOBALS['configCadastroFiltroGenerico16CaixaSelecao'] == 3){ ?>
									notEqual: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4"); ?>"
								<?php }else{ ?>
									required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4"); ?>"
								<?php } ?>
							},
							<?php } ?>
						<?php } ?>
						
						<?php if($GLOBALS['habilitarCadastroFiltroGenerico17'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico17", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							'idsCadastroFiltroGenerico17[]': 
							{
								<?php if($GLOBALS['configCadastroFiltroGenerico17CaixaSelecao'] == 3){ ?>
									notEqual: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4"); ?>"
								<?php }else{ ?>
									required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4"); ?>"
								<?php } ?>
							},
							<?php } ?>
						<?php } ?>
						
						<?php if($GLOBALS['habilitarCadastroFiltroGenerico18'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico18", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							'idsCadastroFiltroGenerico18[]': 
							{
								<?php if($GLOBALS['configCadastroFiltroGenerico18CaixaSelecao'] == 3){ ?>
									notEqual: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4"); ?>"
								<?php }else{ ?>
									required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4"); ?>"
								<?php } ?>
							},
							<?php } ?>
						<?php } ?>
						
						<?php if($GLOBALS['habilitarCadastroFiltroGenerico19'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico19", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							'idsCadastroFiltroGenerico19[]': 
							{
								<?php if($GLOBALS['configCadastroFiltroGenerico19CaixaSelecao'] == 3){ ?>
									notEqual: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4"); ?>"
								<?php }else{ ?>
									required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4"); ?>"
								<?php } ?>
							},
							<?php } ?>
						<?php } ?>
						
						<?php if($GLOBALS['habilitarCadastroFiltroGenerico20'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico20", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							'idsCadastroFiltroGenerico20[]': 
							{
								<?php if($GLOBALS['configCadastroFiltroGenerico20CaixaSelecao'] == 3){ ?>
									notEqual: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4"); ?>"
								<?php }else{ ?>
									required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4"); ?>"
								<?php } ?>
							},
							<?php } ?>
						<?php } ?>
						
						<?php if($GLOBALS['habilitarCadastroFiltroGenerico21'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico21", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							'idsCadastroFiltroGenerico21[]': 
							{
								<?php if($GLOBALS['configCadastroFiltroGenerico21CaixaSelecao'] == 3){ ?>
									notEqual: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4"); ?>"
								<?php }else{ ?>
									required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4"); ?>"
								<?php } ?>
							},
							<?php } ?>
						<?php } ?>
						
						<?php if($GLOBALS['habilitarCadastroFiltroGenerico22'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico22", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							'idsCadastroFiltroGenerico22[]': 
							{
								<?php if($GLOBALS['configCadastroFiltroGenerico22CaixaSelecao'] == 3){ ?>
									notEqual: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4"); ?>"
								<?php }else{ ?>
									required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4"); ?>"
								<?php } ?>
							},
							<?php } ?>
						<?php } ?>
						
						<?php if($GLOBALS['habilitarCadastroFiltroGenerico23'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico23", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							'idsCadastroFiltroGenerico23[]': 
							{
								<?php if($GLOBALS['configCadastroFiltroGenerico23CaixaSelecao'] == 3){ ?>
									notEqual: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4"); ?>"
								<?php }else{ ?>
									required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4"); ?>"
								<?php } ?>
							},
							<?php } ?>
						<?php } ?>
						
						<?php if($GLOBALS['habilitarCadastroFiltroGenerico24'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico24", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							'idsCadastroFiltroGenerico24[]': 
							{
								<?php if($GLOBALS['configCadastroFiltroGenerico24CaixaSelecao'] == 3){ ?>
									notEqual: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4"); ?>"
								<?php }else{ ?>
									required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4"); ?>"
								<?php } ?>
							},
							<?php } ?>
						<?php } ?>
						
						<?php if($GLOBALS['habilitarCadastroFiltroGenerico25'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico25", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							'idsCadastroFiltroGenerico25[]': 
							{
								<?php if($GLOBALS['configCadastroFiltroGenerico25CaixaSelecao'] == 3){ ?>
									notEqual: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4"); ?>"
								<?php }else{ ?>
									required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4"); ?>"
								<?php } ?>
							},
							<?php } ?>
						<?php } ?>
						
						<?php if($GLOBALS['habilitarCadastroFiltroGenerico26'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico26", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							'idsCadastroFiltroGenerico26[]': 
							{
								<?php if($GLOBALS['configCadastroFiltroGenerico26CaixaSelecao'] == 3){ ?>
									notEqual: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4"); ?>"
								<?php }else{ ?>
									required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4"); ?>"
								<?php } ?>
							},
							<?php } ?>
						<?php } ?>
						
						<?php if($GLOBALS['habilitarCadastroFiltroGenerico27'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico27", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							'idsCadastroFiltroGenerico27[]': 
							{
								<?php if($GLOBALS['configCadastroFiltroGenerico27CaixaSelecao'] == 3){ ?>
									notEqual: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4"); ?>"
								<?php }else{ ?>
									required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4"); ?>"
								<?php } ?>
							},
							<?php } ?>
						<?php } ?>
						
						<?php if($GLOBALS['habilitarCadastroFiltroGenerico28'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico28", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							'idsCadastroFiltroGenerico28[]': 
							{
								<?php if($GLOBALS['configCadastroFiltroGenerico28CaixaSelecao'] == 3){ ?>
									notEqual: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4"); ?>"
								<?php }else{ ?>
									required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4"); ?>"
								<?php } ?>
							},
							<?php } ?>
						<?php } ?>
						
						<?php if($GLOBALS['habilitarCadastroFiltroGenerico29'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico29", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							'idsCadastroFiltroGenerico29[]': 
							{
								<?php if($GLOBALS['configCadastroFiltroGenerico29CaixaSelecao'] == 3){ ?>
									notEqual: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4"); ?>"
								<?php }else{ ?>
									required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4"); ?>"
								<?php } ?>
							},
							<?php } ?>
						<?php } ?>
						
						<?php if($GLOBALS['habilitarCadastroFiltroGenerico30'] == 1){ ?>
							<?php if(in_array("ids_cadastro_filtro_generico30", $arrConfigCadastroCamposObrigatorios) == true){ ?>
							'idsCadastroFiltroGenerico30[]': 
							{
								<?php if($GLOBALS['configCadastroFiltroGenerico30CaixaSelecao'] == 3){ ?>
									notEqual: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4"); ?>"
								<?php }else{ ?>
									required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4"); ?>"
								<?php } ?>
							},
							<?php } ?>
						<?php } ?>
						
						
						<?php if(in_array("data1", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'data1': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("data2", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'data2': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("data3", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'data3': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("data4", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'data4': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("data5", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'data5': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("data6", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'data6': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("data7", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'data7': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("data8", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'data8': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("data9", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'data9': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("data10", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'data10': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("nome", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'nome': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("altura", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'altura': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>",
                          number: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica1"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("peso", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'peso': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>",
                          number: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica1"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("razao_social", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'razao_social': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("nome_fantasia", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'nome_fantasia': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("data_nascimento", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'data_nascimento': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("cpf_", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'cpf_': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("rg_", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'rg_': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("cnpj_", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'cnpj_': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("documento", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'documento': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("i_municipal", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'i_municipal': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("i_estadual", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'i_estadual': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("endereco_principal", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'endereco_principal': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("endereco_numero_principal", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'endereco_numero_principal': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("endereco_complemento_principal", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'endereco_complemento_principal': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("bairro_principal", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'bairro_principal': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("cidade_principal", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'cidade_principal': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("estado_principal", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'estado_principal': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("pais_principal", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'pais_principal': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("cep_principal", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'cep_principal': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("ponto_referencia", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'ponto_referencia': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("tel_ddd_principal", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'tel_ddd_principal': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("tel_principal", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'tel_principal': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("cel_ddd_principal", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'cel_ddd_principal': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("cel_principal", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'cel_principal': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("fax_ddd_principal", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'fax_ddd_principal': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("fax_principal", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'fax_principal': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("site_principal", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'site_principal': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("obs_interno", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'obs_interno': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("usuario", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'usuario': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("senha", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'senha': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("imagem", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'ArquivoUpload': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("arquivo1", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'ArquivoUpload1': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("arquivo2", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'ArquivoUpload2': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("arquivo3", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'ArquivoUpload3': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("arquivo4", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'ArquivoUpload4': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("arquivo5", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'ArquivoUpload5': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("mapa_online", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'mapa_online': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("palavras_chave", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'palavras_chave': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("apresentacao", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'apresentacao': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("servicos", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'servicos': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("promocoes", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'promocoes': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("condicoes_comerciais", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'condicoes_comerciais': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("formas_pagamento", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'formas_pagamento': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("horario_atendimento", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'horario_atendimento': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("situacao_atual", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'situacao_atual': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar1", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar1': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar2", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar2': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar3", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar3': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar4", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar4': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar5", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar5': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar6", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar6': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar7", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar7': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar8", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar8': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar9", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar9': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar10", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar10': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar11", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar11': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar12", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar12': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar13", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar13': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar14", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar14': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar15", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar15': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar16", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar16': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar17", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar17': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar18", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar18': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar19", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar19': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar20", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar20': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>

						<?php if(in_array("informacao_complementar21", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar21': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar22", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar22': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar23", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar23': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar24", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar24': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar25", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar25': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar26", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar26': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar27", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar27': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar28", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar28': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar29", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar29': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar30", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar30': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar31", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar31': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar32", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar32': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar33", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar33': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar34", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar34': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar35", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar35': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar36", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar36': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar37", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar37': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar38", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar38': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar39", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar39': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if(in_array("informacao_complementar40", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                        'informacao_complementar40': {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                        },
						<?php } ?>
						
						<?php if($GLOBALS['habilitarCadastroVerificarTermo'] == 1){ ?>
							<?php if(in_array("termo", $arrCadastroFormularioCampos) == true){ ?>
							'termo_compromisso': 
							{
									required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4"); ?>"
							},
							<?php } ?>
						<?php } ?>
						
                        email_principal: {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
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
    
		<script type="text/javascript">
            //Variável para conter todos os campos que funcionam com o DatePicker.
            //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
            var strDatapickerNascimentoPtCampos = "";
            var strDatapickerNascimentoEnCampos = "";
    
            var strDatapickerAgendaPtCampos = "";
            var strDatapickerAgendaEnCampos = "";
        </script>
        <form name="formCadastro" id="formCadastro" action="SiteCadastroExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="AdmTabelaCampos01">
                
                <?php if($GLOBALS['habilitarCadastroTipo'] == 1){ ?>
                    <?php if(in_array("tipo", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroTipoCadastro"); ?><?php if(in_array("tipo", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div align="left" class="CadastroTexto">
                                <?php 
                                    $arrCadastroTipo = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 1);
                                ?>
                                
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroTipo); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsCadastroTipo[]" type="checkbox" value="<?php echo $arrCadastroTipo[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrCadastroTipo[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroAtividades'] == 1){ ?>
                    <?php if(in_array("atividades", $arrCadastroFormularioCampos) == true){?>
                    <tr>
    
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroAtividades"); ?><?php if(in_array("atividades", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div align="left" class="CadastroTexto">
                                <?php 
                                    $arrCadastroAtividades = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 2);
                                ?>
                                <select id="idsCadastroAtividades[]" name="idsCadastroAtividades[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroAtividades); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrCadastroAtividades[$countArray][0];?>"><?php echo $arrCadastroAtividades[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <tr>
                    <?php if(in_array("nome", $arrCadastroFormularioCampos) == true){?>
                    <td class="CadastroTabelaColuna01">
                        <div align="left" class="CadastroTextoNomeCampo">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroNome"); ?><?php if(in_array("nome", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                        </div>
                    </td>
                    <td class="CadastroTabelaColuna02" <?php if($GLOBALS['habilitarCadastroNClassificacao'] <> 1){ ?> colspan="3" <?php } ?>>
                        <div align="left">
                            <input type="text" name="nome" id="nome" class="CadastroCampoTexto01" maxlength="255" />
                        </div>
                    </td>
                    <?php } ?>
                    <?php if($GLOBALS['habilitarCadastroNClassificacao'] == 1){ ?>
                        <?php if(in_array("n_classificacao", $arrCadastroFormularioCampos) == true){?>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNClassificacao"); ?><?php if(in_array("n_classificacao", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02">
                            <div>
                                <input type="text" name="n_classificacao" id="n_classificacao" class="CadastroCampoNumericoReduzido01" maxlength="10" />
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                </tr>
                
                <?php if($GLOBALS['habilitarCadastroSexo'] == 1 || $GLOBALS['habilitarCadastroPfPj'] == 1){ ?>
                <tr>
                    <?php if($GLOBALS['habilitarCadastroSexo'] == 1){ ?>
                        <?php if(in_array("sexo", $arrCadastroFormularioCampos) == true){?>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroSexo"); ?><?php if(in_array("sexo", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02"<?php if($GLOBALS['habilitarCadastroPfPj'] <> 1){ ?> colspan="3" <?php } ?>>
                            <div align="left" class="CadastroTexto">
                                <select name="sexo" id="sexo" class="CadastroCampoDropDownMenu01">
                                    <option value="1" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroSexo1"); ?></option>
                                    <option value="2"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroSexo2"); ?></option>
                                </select>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
    
                    <?php if($GLOBALS['habilitarCadastroPfPj'] == 1){ ?>
                        <?php if(in_array("pf_pj", $arrCadastroFormularioCampos) == true){?>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroPfPj"); ?><?php if(in_array("pf_pj", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02"<?php if($GLOBALS['habilitarCadastroSexo'] <> 1){ ?> colspan="3"<?php } ?>>
                            <div>
                                <select name="pf_pj" id="pf_pj" class="CadastroCampoDropDownMenu01">
                                    <option value="1" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroPfPj1"); ?></option>
                                    <option value="2"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroPfPj2"); ?></option>
                                </select>
                            </div>
                        </td>
                        <?php } ?>
                    <?php } ?>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroFiltroGenerico01'] == 1){ ?>
                    <?php if(in_array("ids_cadastro_filtro_generico01", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico01Nome'], "IncludeConfig"); ?><?php if(in_array("ids_cadastro_filtro_generico01", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>: 
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div id="divIdsCadastroFiltroGenerico01" class="CadastroTexto">
                                <?php 
                                    $arrCadastroFiltroGenerico01 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 12);
                                ?>
                                
                                <?php if($GLOBALS['configCadastroFiltroGenerico01CaixaSelecao'] == 1){ ?>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico01); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input name="idsCadastroFiltroGenerico01[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico01[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico01[$countArray][1];?>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroFiltroGenerico01CaixaSelecao'] == 2){ ?>
                                    <select id="idsCadastroFiltroGenerico01[]" name="idsCadastroFiltroGenerico01[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico01); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrCadastroFiltroGenerico01[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico01[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select> 
                                    <br />
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroFiltroGenerico01CaixaSelecao'] == 3){ ?>
                                    <select id="idsCadastroFiltroGenerico01[]" name="idsCadastroFiltroGenerico01[]" class="CadastroCampoDropDownMenu01">
                                        <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico01); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrCadastroFiltroGenerico01[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico01[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroFiltroGenerico02'] == 1){ ?>
                    <?php if(in_array("ids_cadastro_filtro_generico02", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico02Nome'], "IncludeConfig"); ?><?php if(in_array("ids_cadastro_filtro_generico02", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>: 
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div id="divIdsCadastroFiltroGenerico02" class="CadastroTexto">
                                <?php 
                                    $arrCadastroFiltroGenerico02 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 13);
                                ?>
                                
                                <?php if($GLOBALS['configCadastroFiltroGenerico02CaixaSelecao'] == 1){ ?>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico02); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input name="idsCadastroFiltroGenerico02[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico02[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico02[$countArray][1];?>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroFiltroGenerico02CaixaSelecao'] == 2){ ?>
                                    <select id="idsCadastroFiltroGenerico02[]" name="idsCadastroFiltroGenerico02[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico02); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrCadastroFiltroGenerico02[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico02[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select> 
                                    <br />
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroFiltroGenerico02CaixaSelecao'] == 3){ ?>
                                    <select id="idsCadastroFiltroGenerico02[]" name="idsCadastroFiltroGenerico02[]" class="CadastroCampoDropDownMenu01">
                                        <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico02); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrCadastroFiltroGenerico02[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico02[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroFiltroGenerico03'] == 1){ ?>
                    <?php if(in_array("ids_cadastro_filtro_generico03", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico03Nome'], "IncludeConfig"); ?><?php if(in_array("ids_cadastro_filtro_generico03", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>: 
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div id="divIdsCadastroFiltroGenerico03" class="CadastroTexto">
                                <?php 
                                    $arrCadastroFiltroGenerico03 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 14);
                                ?>
                                
                                <?php if($GLOBALS['configCadastroFiltroGenerico03CaixaSelecao'] == 1){ ?>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico03); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input name="idsCadastroFiltroGenerico03[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico03[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico03[$countArray][1];?>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroFiltroGenerico03CaixaSelecao'] == 2){ ?>
                                    <select id="idsCadastroFiltroGenerico03[]" name="idsCadastroFiltroGenerico03[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico03); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrCadastroFiltroGenerico03[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico03[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select> 
                                    <br />
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroFiltroGenerico03CaixaSelecao'] == 3){ ?>
                                    <select id="idsCadastroFiltroGenerico03[]" name="idsCadastroFiltroGenerico03[]" class="CadastroCampoDropDownMenu01">
                                        <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico03); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrCadastroFiltroGenerico03[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico03[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
    
                <?php if($GLOBALS['habilitarCadastroFiltroGenerico04'] == 1){ ?>
                    <?php if(in_array("ids_cadastro_filtro_generico04", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico04Nome'], "IncludeConfig"); ?><?php if(in_array("ids_cadastro_filtro_generico04", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>: 
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div id="divIdsCadastroFiltroGenerico04" class="CadastroTexto">
                                <?php 
                                    $arrCadastroFiltroGenerico04 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 15);
                                ?>
                                
                                <?php if($GLOBALS['configCadastroFiltroGenerico04CaixaSelecao'] == 1){ ?>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico04); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input name="idsCadastroFiltroGenerico04[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico04[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico04[$countArray][1];?>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroFiltroGenerico04CaixaSelecao'] == 2){ ?>
                                    <select id="idsCadastroFiltroGenerico04[]" name="idsCadastroFiltroGenerico04[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico04); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrCadastroFiltroGenerico04[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico04[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select> 
                                    <br />
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroFiltroGenerico04CaixaSelecao'] == 3){ ?>
                                    <select id="idsCadastroFiltroGenerico04[]" name="idsCadastroFiltroGenerico04[]" class="CadastroCampoDropDownMenu01">
                                        <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico04); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrCadastroFiltroGenerico04[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico04[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroFiltroGenerico05'] == 1){ ?>
                    <?php if(in_array("ids_cadastro_filtro_generico05", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico05Nome'], "IncludeConfig"); ?><?php if(in_array("ids_cadastro_filtro_generico05", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>: 
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div id="divIdsCadastroFiltroGenerico05" class="CadastroTexto">
                                <?php 
                                    $arrCadastroFiltroGenerico05 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 16);
                                ?>
                                
                                <?php if($GLOBALS['configCadastroFiltroGenerico05CaixaSelecao'] == 1){ ?>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico05); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input name="idsCadastroFiltroGenerico05[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico05[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico05[$countArray][1];?>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroFiltroGenerico05CaixaSelecao'] == 2){ ?>
                                    <select id="idsCadastroFiltroGenerico05[]" name="idsCadastroFiltroGenerico05[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico05); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrCadastroFiltroGenerico05[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico05[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select> 
                                    <br />
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroFiltroGenerico05CaixaSelecao'] == 3){ ?>
                                    <select id="idsCadastroFiltroGenerico05[]" name="idsCadastroFiltroGenerico05[]" class="CadastroCampoDropDownMenu01">
                                        <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico05); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrCadastroFiltroGenerico05[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico05[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroFiltroGenerico06'] == 1){ ?>
                    <?php if(in_array("ids_cadastro_filtro_generico06", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico06Nome'], "IncludeConfig"); ?><?php if(in_array("ids_cadastro_filtro_generico06", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>: 
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div id="divIdsCadastroFiltroGenerico06" class="CadastroTexto">
                                <?php 
                                    $arrCadastroFiltroGenerico06 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 17);
                                ?>
                                
                                <?php if($GLOBALS['configCadastroFiltroGenerico06CaixaSelecao'] == 1){ ?>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico06); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input name="idsCadastroFiltroGenerico06[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico06[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico06[$countArray][1];?>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroFiltroGenerico06CaixaSelecao'] == 2){ ?>
                                    <select id="idsCadastroFiltroGenerico06[]" name="idsCadastroFiltroGenerico06[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico06); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrCadastroFiltroGenerico06[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico06[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select> 
                                    <br />
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroFiltroGenerico06CaixaSelecao'] == 3){ ?>
                                    <select id="idsCadastroFiltroGenerico06[]" name="idsCadastroFiltroGenerico06[]" class="CadastroCampoDropDownMenu01">
                                        <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico06); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrCadastroFiltroGenerico06[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico06[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroFiltroGenerico07'] == 1){ ?>
                    <?php if(in_array("ids_cadastro_filtro_generico07", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico07Nome'], "IncludeConfig"); ?><?php if(in_array("ids_cadastro_filtro_generico07", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>: 
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div id="divIdsCadastroFiltroGenerico07" class="CadastroTexto">
                                <?php 
                                    $arrCadastroFiltroGenerico07 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 18);
                                ?>
                                
                                <?php if($GLOBALS['configCadastroFiltroGenerico07CaixaSelecao'] == 1){ ?>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico07); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input name="idsCadastroFiltroGenerico07[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico07[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico07[$countArray][1];?>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroFiltroGenerico07CaixaSelecao'] == 2){ ?>
                                    <select id="idsCadastroFiltroGenerico07[]" name="idsCadastroFiltroGenerico07[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico07); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrCadastroFiltroGenerico07[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico07[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select> 
                                    <br />
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroFiltroGenerico07CaixaSelecao'] == 3){ ?>
                                    <select id="idsCadastroFiltroGenerico07[]" name="idsCadastroFiltroGenerico07[]" class="CadastroCampoDropDownMenu01">
                                        <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico07); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrCadastroFiltroGenerico07[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico07[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroFiltroGenerico08'] == 1){ ?>
                    <?php if(in_array("ids_cadastro_filtro_generico08", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico08Nome'], "IncludeConfig"); ?><?php if(in_array("ids_cadastro_filtro_generico08", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>: 
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div id="divIdsCadastroFiltroGenerico08" class="CadastroTexto">
                                <?php 
                                    $arrCadastroFiltroGenerico08 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 19);
                                ?>
                                
                                <?php if($GLOBALS['configCadastroFiltroGenerico08CaixaSelecao'] == 1){ ?>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico08); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input name="idsCadastroFiltroGenerico08[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico08[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico08[$countArray][1];?>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroFiltroGenerico08CaixaSelecao'] == 2){ ?>
                                    <select id="idsCadastroFiltroGenerico08[]" name="idsCadastroFiltroGenerico08[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico08); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrCadastroFiltroGenerico08[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico08[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select> 
                                    <br />
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroFiltroGenerico08CaixaSelecao'] == 3){ ?>
                                    <select id="idsCadastroFiltroGenerico08[]" name="idsCadastroFiltroGenerico08[]" class="CadastroCampoDropDownMenu01">
                                        <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico08); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrCadastroFiltroGenerico08[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico08[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroFiltroGenerico09'] == 1){ ?>
                    <?php if(in_array("ids_cadastro_filtro_generico09", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico09Nome'], "IncludeConfig"); ?><?php if(in_array("ids_cadastro_filtro_generico09", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>: 
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div id="divIdsCadastroFiltroGenerico09" class="CadastroTexto">
                                <?php 
                                    $arrCadastroFiltroGenerico09 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 20);
                                ?>
                                
                                <?php if($GLOBALS['configCadastroFiltroGenerico09CaixaSelecao'] == 1){ ?>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico09); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input name="idsCadastroFiltroGenerico09[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico09[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico09[$countArray][1];?>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroFiltroGenerico09CaixaSelecao'] == 2){ ?>
                                    <select id="idsCadastroFiltroGenerico09[]" name="idsCadastroFiltroGenerico09[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico09); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrCadastroFiltroGenerico09[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico09[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select> 
                                    <br />
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroFiltroGenerico09CaixaSelecao'] == 3){ ?>
                                    <select id="idsCadastroFiltroGenerico09[]" name="idsCadastroFiltroGenerico09[]" class="CadastroCampoDropDownMenu01">
                                        <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico09); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrCadastroFiltroGenerico09[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico09[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroFiltroGenerico10'] == 1){ ?>
                    <?php if(in_array("ids_cadastro_filtro_generico10", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico10Nome'], "IncludeConfig"); ?><?php if(in_array("ids_cadastro_filtro_generico10", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>: 
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div id="divIdsCadastroFiltroGenerico10" class="CadastroTexto">
                                <?php 
                                    $arrCadastroFiltroGenerico10 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 21);
                                ?>
                            
                                <?php if($GLOBALS['configCadastroFiltroGenerico10CaixaSelecao'] == 1){ ?>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico10); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input name="idsCadastroFiltroGenerico10[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico10[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrCadastroFiltroGenerico10[$countArray][0], $arrCadastroFiltroGenerico10Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrCadastroFiltroGenerico10[$countArray][1];?>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroFiltroGenerico10CaixaSelecao'] == 2){ ?>
                                    <select id="idsCadastroFiltroGenerico10[]" name="idsCadastroFiltroGenerico10[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico10); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrCadastroFiltroGenerico10[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico10[$countArray][0], $arrCadastroFiltroGenerico10Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico10[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select> 
                                    <br />
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroFiltroGenerico10CaixaSelecao'] == 3){ ?>
                                    <select id="idsCadastroFiltroGenerico10[]" name="idsCadastroFiltroGenerico10[]" class="CadastroCampoDropDownMenu01">
                                        <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico10); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrCadastroFiltroGenerico10[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico10[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
				<?php if($GLOBALS['habilitarCadastroFiltroGenerico11'] == 1){ ?>
					<?php if(in_array("ids_cadastro_filtro_generico11", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico11Nome'], "IncludeConfig"); ?><?php if(in_array("ids_cadastro_filtro_generico11", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>: 
                            </div>
                        </td>
                        <td class="TbFundoClaro" colspan="3">
                            <div id="divIdsCadastroFiltroGenerico11" class="CadastroTexto">
                                <?php 
                                    $arrCadastroFiltroGenerico11 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 60);
                                ?>
                                
                                <?php if($GLOBALS['configCadastroFiltroGenerico11CaixaSelecao'] == 1){ ?>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico11); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input name="idsCadastroFiltroGenerico11[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico11[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico11[$countArray][1];?>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroFiltroGenerico11CaixaSelecao'] == 2){ ?>
                                    <select id="idsCadastroFiltroGenerico11[]" name="idsCadastroFiltroGenerico11[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico11); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrCadastroFiltroGenerico11[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico11[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select> 
                                    <br />
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroFiltroGenerico11CaixaSelecao'] == 3){ ?>
                                    <select id="idsCadastroFiltroGenerico11[]" name="idsCadastroFiltroGenerico11[]" class="AdmCampoDropDownMenu01">
                                        <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico11); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrCadastroFiltroGenerico11[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico11[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroFiltroGenerico12'] == 1){ ?>
					<?php if(in_array("ids_cadastro_filtro_generico12", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico12Nome'], "IncludeConfig"); ?><?php if(in_array("ids_cadastro_filtro_generico12", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>: 
                            </div>
                        </td>
                        <td class="TbFundoClaro" colspan="3">
                            <div id="divIdsCadastroFiltroGenerico12" class="CadastroTexto">
                                <?php 
                                    $arrCadastroFiltroGenerico12 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 61);
                                ?>
                                
                                <?php if($GLOBALS['configCadastroFiltroGenerico12CaixaSelecao'] == 1){ ?>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico12); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input name="idsCadastroFiltroGenerico12[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico12[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico12[$countArray][1];?>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroFiltroGenerico12CaixaSelecao'] == 2){ ?>
                                    <select id="idsCadastroFiltroGenerico12[]" name="idsCadastroFiltroGenerico12[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico12); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrCadastroFiltroGenerico12[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico12[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select> 
                                    <br />
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroFiltroGenerico12CaixaSelecao'] == 3){ ?>
                                    <select id="idsCadastroFiltroGenerico12[]" name="idsCadastroFiltroGenerico12[]" class="AdmCampoDropDownMenu01">
                                        <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico12); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrCadastroFiltroGenerico12[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico12[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroFiltroGenerico13'] == 1){ ?>
					<?php if(in_array("ids_cadastro_filtro_generico13", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico13Nome'], "IncludeConfig"); ?><?php if(in_array("ids_cadastro_filtro_generico13", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>: 
                            </div>
                        </td>
                        <td class="TbFundoClaro" colspan="3">
                            <div id="divIdsCadastroFiltroGenerico13" class="CadastroTexto">
                                <?php 
                                    $arrCadastroFiltroGenerico13 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 62);
                                ?>
                                
                                <?php if($GLOBALS['configCadastroFiltroGenerico13CaixaSelecao'] == 1){ ?>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico13); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input name="idsCadastroFiltroGenerico13[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico13[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico13[$countArray][1];?>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroFiltroGenerico13CaixaSelecao'] == 2){ ?>
                                    <select id="idsCadastroFiltroGenerico13[]" name="idsCadastroFiltroGenerico13[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico13); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrCadastroFiltroGenerico13[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico13[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select> 
                                    <br />
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroFiltroGenerico13CaixaSelecao'] == 3){ ?>
                                    <select id="idsCadastroFiltroGenerico13[]" name="idsCadastroFiltroGenerico13[]" class="AdmCampoDropDownMenu01">
                                        <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico13); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrCadastroFiltroGenerico13[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico13[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroFiltroGenerico14'] == 1){ ?>
					<?php if(in_array("ids_cadastro_filtro_generico14", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico14Nome'], "IncludeConfig"); ?><?php if(in_array("ids_cadastro_filtro_generico14", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>: 
                            </div>
                        </td>
        
        
                        <td class="TbFundoClaro" colspan="3">
                            <div id="divIdsCadastroFiltroGenerico14" class="CadastroTexto">
                                <?php 
                                    $arrCadastroFiltroGenerico14 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 63);
                                ?>
                                
                                <?php if($GLOBALS['configCadastroFiltroGenerico14CaixaSelecao'] == 1){ ?>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico14); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input name="idsCadastroFiltroGenerico14[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico14[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico14[$countArray][1];?>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroFiltroGenerico14CaixaSelecao'] == 2){ ?>
                                    <select id="idsCadastroFiltroGenerico14[]" name="idsCadastroFiltroGenerico14[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico14); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrCadastroFiltroGenerico14[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico14[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select> 
                                    <br />
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroFiltroGenerico14CaixaSelecao'] == 3){ ?>
                                    <select id="idsCadastroFiltroGenerico14[]" name="idsCadastroFiltroGenerico14[]" class="AdmCampoDropDownMenu01">
                                        <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico14); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrCadastroFiltroGenerico14[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico14[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroFiltroGenerico15'] == 1){ ?>
					<?php if(in_array("ids_cadastro_filtro_generico15", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico15Nome'], "IncludeConfig"); ?><?php if(in_array("ids_cadastro_filtro_generico15", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>: 
                            </div>
                        </td>
                        <td class="TbFundoClaro" colspan="3">
                            <div id="divIdsCadastroFiltroGenerico15" class="CadastroTexto">
                                <?php 
                                    $arrCadastroFiltroGenerico15 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 64);
                                ?>
                                
                                <?php if($GLOBALS['configCadastroFiltroGenerico15CaixaSelecao'] == 1){ ?>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico15); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input name="idsCadastroFiltroGenerico15[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico15[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico15[$countArray][1];?>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroFiltroGenerico15CaixaSelecao'] == 2){ ?>
                                    <select id="idsCadastroFiltroGenerico15[]" name="idsCadastroFiltroGenerico15[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico15); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrCadastroFiltroGenerico15[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico15[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select> 
                                    <br />
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroFiltroGenerico15CaixaSelecao'] == 3){ ?>
                                    <select id="idsCadastroFiltroGenerico15[]" name="idsCadastroFiltroGenerico15[]" class="AdmCampoDropDownMenu01">
                                        <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico15); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrCadastroFiltroGenerico15[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico15[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroFiltroGenerico16'] == 1){ ?>
					<?php if(in_array("ids_cadastro_filtro_generico16", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico16Nome'], "IncludeConfig"); ?><?php if(in_array("ids_cadastro_filtro_generico16", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>: 
                            </div>
                        </td>
                        <td class="TbFundoClaro" colspan="3">
                            <div id="divIdsCadastroFiltroGenerico16" class="CadastroTexto">
                                <?php 
                                    $arrCadastroFiltroGenerico16 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 65);
                                ?>
        
                                
                                <?php if($GLOBALS['configCadastroFiltroGenerico16CaixaSelecao'] == 1){ ?>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico16); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input name="idsCadastroFiltroGenerico16[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico16[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico16[$countArray][1];?>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroFiltroGenerico16CaixaSelecao'] == 2){ ?>
                                    <select id="idsCadastroFiltroGenerico16[]" name="idsCadastroFiltroGenerico16[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico16); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrCadastroFiltroGenerico16[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico16[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select> 
                                    <br />
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroFiltroGenerico16CaixaSelecao'] == 3){ ?>
                                    <select id="idsCadastroFiltroGenerico16[]" name="idsCadastroFiltroGenerico16[]" class="AdmCampoDropDownMenu01">
                                        <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico16); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrCadastroFiltroGenerico16[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico16[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroFiltroGenerico17'] == 1){ ?>
					<?php if(in_array("ids_cadastro_filtro_generico17", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico17Nome'], "IncludeConfig"); ?><?php if(in_array("ids_cadastro_filtro_generico17", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>: 
                            </div>
                        </td>
                        <td class="TbFundoClaro" colspan="3">
                            <div id="divIdsCadastroFiltroGenerico17" class="CadastroTexto">
                                <?php 
                                    $arrCadastroFiltroGenerico17 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 66);
                                ?>
                                
                                <?php if($GLOBALS['configCadastroFiltroGenerico17CaixaSelecao'] == 1){ ?>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico17); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input name="idsCadastroFiltroGenerico17[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico17[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico17[$countArray][1];?>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroFiltroGenerico17CaixaSelecao'] == 2){ ?>
                                    <select id="idsCadastroFiltroGenerico17[]" name="idsCadastroFiltroGenerico17[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico17); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrCadastroFiltroGenerico17[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico17[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select> 
                                    <br />
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroFiltroGenerico17CaixaSelecao'] == 3){ ?>
                                    <select id="idsCadastroFiltroGenerico17[]" name="idsCadastroFiltroGenerico17[]" class="AdmCampoDropDownMenu01">
                                        <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico17); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrCadastroFiltroGenerico17[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico17[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroFiltroGenerico18'] == 1){ ?>
					<?php if(in_array("ids_cadastro_filtro_generico18", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico18Nome'], "IncludeConfig"); ?><?php if(in_array("ids_cadastro_filtro_generico18", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>: 
                            </div>
                        </td>
                        <td class="TbFundoClaro" colspan="3">
                            <div id="divIdsCadastroFiltroGenerico18" class="CadastroTexto">
                                <?php 
                                    $arrCadastroFiltroGenerico18 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 67);
                                ?>
                                
                                <?php if($GLOBALS['configCadastroFiltroGenerico18CaixaSelecao'] == 1){ ?>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico18); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input name="idsCadastroFiltroGenerico18[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico18[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico18[$countArray][1];?>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroFiltroGenerico18CaixaSelecao'] == 2){ ?>
                                    <select id="idsCadastroFiltroGenerico18[]" name="idsCadastroFiltroGenerico18[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico18); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrCadastroFiltroGenerico18[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico18[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select> 
                                    <br />
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroFiltroGenerico18CaixaSelecao'] == 3){ ?>
                                    <select id="idsCadastroFiltroGenerico18[]" name="idsCadastroFiltroGenerico18[]" class="AdmCampoDropDownMenu01">
                                        <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico18); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrCadastroFiltroGenerico18[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico18[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroFiltroGenerico19'] == 1){ ?>
					<?php if(in_array("ids_cadastro_filtro_generico19", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico19Nome'], "IncludeConfig"); ?><?php if(in_array("ids_cadastro_filtro_generico19", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>: 
                            </div>
                        </td>
                        <td class="TbFundoClaro" colspan="3">
                            <div id="divIdsCadastroFiltroGenerico19" class="CadastroTexto">
                                <?php 
                                    $arrCadastroFiltroGenerico19 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 68);
                                ?>
                                
                                <?php if($GLOBALS['configCadastroFiltroGenerico19CaixaSelecao'] == 1){ ?>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico19); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input name="idsCadastroFiltroGenerico19[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico19[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico19[$countArray][1];?>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroFiltroGenerico19CaixaSelecao'] == 2){ ?>
                                    <select id="idsCadastroFiltroGenerico19[]" name="idsCadastroFiltroGenerico19[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico19); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrCadastroFiltroGenerico19[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico19[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select> 
                                    <br />
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroFiltroGenerico19CaixaSelecao'] == 3){ ?>
                                    <select id="idsCadastroFiltroGenerico19[]" name="idsCadastroFiltroGenerico19[]" class="AdmCampoDropDownMenu01">
                                        <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico19); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrCadastroFiltroGenerico19[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico19[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroFiltroGenerico20'] == 1){ ?>
					<?php if(in_array("ids_cadastro_filtro_generico20", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico20Nome'], "IncludeConfig"); ?><?php if(in_array("ids_cadastro_filtro_generico20", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>: 
                            </div>
                        </td>
                        <td class="TbFundoClaro" colspan="3">
                            <div id="divIdsCadastroFiltroGenerico20" class="CadastroTexto">
                                <?php 
                                    $arrCadastroFiltroGenerico20 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 69);
                                ?>
                                
                                <?php if($GLOBALS['configCadastroFiltroGenerico20CaixaSelecao'] == 1){ ?>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico20); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input name="idsCadastroFiltroGenerico20[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico20[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico20[$countArray][1];?>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroFiltroGenerico20CaixaSelecao'] == 2){ ?>
                                    <select id="idsCadastroFiltroGenerico20[]" name="idsCadastroFiltroGenerico20[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico20); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrCadastroFiltroGenerico20[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico20[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select> 
                                    <br />
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroFiltroGenerico20CaixaSelecao'] == 3){ ?>
                                    <select id="idsCadastroFiltroGenerico20[]" name="idsCadastroFiltroGenerico20[]" class="AdmCampoDropDownMenu01">
                                        <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico20); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrCadastroFiltroGenerico20[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico20[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroFiltroGenerico21'] == 1){ ?>
					<?php if(in_array("ids_cadastro_filtro_generico21", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico21Nome'], "IncludeConfig"); ?><?php if(in_array("ids_cadastro_filtro_generico21", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>: 
                            </div>
                        </td>
                        <td class="TbFundoClaro" colspan="3">
                            <div id="divIdsCadastroFiltroGenerico21" class="CadastroTexto">
                                <?php 
                                    $arrCadastroFiltroGenerico21 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 70);
                                ?>
                                
                                <?php if($GLOBALS['configCadastroFiltroGenerico21CaixaSelecao'] == 1){ ?>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico21); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input name="idsCadastroFiltroGenerico21[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico21[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico21[$countArray][1];?>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroFiltroGenerico21CaixaSelecao'] == 2){ ?>
                                    <select id="idsCadastroFiltroGenerico21[]" name="idsCadastroFiltroGenerico21[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico21); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrCadastroFiltroGenerico21[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico21[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select> 
                                    <br />
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroFiltroGenerico21CaixaSelecao'] == 3){ ?>
                                    <select id="idsCadastroFiltroGenerico21[]" name="idsCadastroFiltroGenerico21[]" class="AdmCampoDropDownMenu01">
                                        <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico21); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrCadastroFiltroGenerico21[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico21[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroFiltroGenerico22'] == 1){ ?>
					<?php if(in_array("ids_cadastro_filtro_generico22", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico22Nome'], "IncludeConfig"); ?><?php if(in_array("ids_cadastro_filtro_generico22", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>: 
                            </div>
                        </td>
                        <td class="TbFundoClaro" colspan="3">
                            <div id="divIdsCadastroFiltroGenerico22" class="CadastroTexto">
                                <?php 
                                    $arrCadastroFiltroGenerico22 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 71);
                                ?>
                                
                                <?php if($GLOBALS['configCadastroFiltroGenerico22CaixaSelecao'] == 1){ ?>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico22); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input name="idsCadastroFiltroGenerico22[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico22[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico22[$countArray][1];?>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroFiltroGenerico22CaixaSelecao'] == 2){ ?>
                                    <select id="idsCadastroFiltroGenerico22[]" name="idsCadastroFiltroGenerico22[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico22); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrCadastroFiltroGenerico22[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico22[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select> 
                                    <br />
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroFiltroGenerico22CaixaSelecao'] == 3){ ?>
                                    <select id="idsCadastroFiltroGenerico22[]" name="idsCadastroFiltroGenerico22[]" class="AdmCampoDropDownMenu01">
                                        <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico22); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrCadastroFiltroGenerico22[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico22[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroFiltroGenerico23'] == 1){ ?>
					<?php if(in_array("ids_cadastro_filtro_generico23", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico23Nome'], "IncludeConfig"); ?><?php if(in_array("ids_cadastro_filtro_generico23", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>: 
                            </div>
                        </td>
                        <td class="TbFundoClaro" colspan="3">
                            <div id="divIdsCadastroFiltroGenerico23" class="CadastroTexto">
                                <?php 
                                    $arrCadastroFiltroGenerico23 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 72);
                                ?>
                                
                                <?php if($GLOBALS['configCadastroFiltroGenerico23CaixaSelecao'] == 1){ ?>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico23); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input name="idsCadastroFiltroGenerico23[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico23[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico23[$countArray][1];?>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroFiltroGenerico23CaixaSelecao'] == 2){ ?>
                                    <select id="idsCadastroFiltroGenerico23[]" name="idsCadastroFiltroGenerico23[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico23); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrCadastroFiltroGenerico23[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico23[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select> 
                                    <br />
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroFiltroGenerico23CaixaSelecao'] == 3){ ?>
                                    <select id="idsCadastroFiltroGenerico23[]" name="idsCadastroFiltroGenerico23[]" class="AdmCampoDropDownMenu01">
                                        <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico23); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrCadastroFiltroGenerico23[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico23[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroFiltroGenerico24'] == 1){ ?>
					<?php if(in_array("ids_cadastro_filtro_generico24", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico24Nome'], "IncludeConfig"); ?><?php if(in_array("ids_cadastro_filtro_generico24", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>: 
                            </div>
                        </td>
        
        
                        <td class="TbFundoClaro" colspan="3">
                            <div id="divIdsCadastroFiltroGenerico24" class="CadastroTexto">
                                <?php 
                                    $arrCadastroFiltroGenerico24 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 73);
                                ?>
                                
                                <?php if($GLOBALS['configCadastroFiltroGenerico24CaixaSelecao'] == 1){ ?>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico24); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input name="idsCadastroFiltroGenerico24[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico24[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico24[$countArray][1];?>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroFiltroGenerico24CaixaSelecao'] == 2){ ?>
                                    <select id="idsCadastroFiltroGenerico24[]" name="idsCadastroFiltroGenerico24[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico24); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrCadastroFiltroGenerico24[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico24[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select> 
                                    <br />
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroFiltroGenerico24CaixaSelecao'] == 3){ ?>
                                    <select id="idsCadastroFiltroGenerico24[]" name="idsCadastroFiltroGenerico24[]" class="AdmCampoDropDownMenu01">
                                        <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico24); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrCadastroFiltroGenerico24[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico24[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroFiltroGenerico25'] == 1){ ?>
					<?php if(in_array("ids_cadastro_filtro_generico25", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico25Nome'], "IncludeConfig"); ?><?php if(in_array("ids_cadastro_filtro_generico25", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>: 
                            </div>
                        </td>
                        <td class="TbFundoClaro" colspan="3">
                            <div id="divIdsCadastroFiltroGenerico25" class="CadastroTexto">
                                <?php 
                                    $arrCadastroFiltroGenerico25 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 74);
                                ?>
                                
                                <?php if($GLOBALS['configCadastroFiltroGenerico25CaixaSelecao'] == 1){ ?>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico25); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input name="idsCadastroFiltroGenerico25[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico25[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico25[$countArray][1];?>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroFiltroGenerico25CaixaSelecao'] == 2){ ?>
                                    <select id="idsCadastroFiltroGenerico25[]" name="idsCadastroFiltroGenerico25[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico25); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrCadastroFiltroGenerico25[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico25[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select> 
                                    <br />
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroFiltroGenerico25CaixaSelecao'] == 3){ ?>
                                    <select id="idsCadastroFiltroGenerico25[]" name="idsCadastroFiltroGenerico25[]" class="AdmCampoDropDownMenu01">
                                        <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico25); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrCadastroFiltroGenerico25[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico25[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroFiltroGenerico26'] == 1){ ?>
					<?php if(in_array("ids_cadastro_filtro_generico26", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico26Nome'], "IncludeConfig"); ?><?php if(in_array("ids_cadastro_filtro_generico26", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>: 
                            </div>
                        </td>
                        <td class="TbFundoClaro" colspan="3">
                            <div id="divIdsCadastroFiltroGenerico26" class="CadastroTexto">
                                <?php 
                                    $arrCadastroFiltroGenerico26 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 75);
                                ?>
        
                                
                                <?php if($GLOBALS['configCadastroFiltroGenerico26CaixaSelecao'] == 1){ ?>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico26); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input name="idsCadastroFiltroGenerico26[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico26[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico26[$countArray][1];?>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroFiltroGenerico26CaixaSelecao'] == 2){ ?>
                                    <select id="idsCadastroFiltroGenerico26[]" name="idsCadastroFiltroGenerico26[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico26); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrCadastroFiltroGenerico26[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico26[$countArray][1];?></option>
                                        <?php 

                                        }
                                        ?>
                                    </select> 
                                    <br />
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroFiltroGenerico26CaixaSelecao'] == 3){ ?>
                                    <select id="idsCadastroFiltroGenerico26[]" name="idsCadastroFiltroGenerico26[]" class="AdmCampoDropDownMenu01">
                                        <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico26); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrCadastroFiltroGenerico26[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico26[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroFiltroGenerico27'] == 1){ ?>
					<?php if(in_array("ids_cadastro_filtro_generico27", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico27Nome'], "IncludeConfig"); ?><?php if(in_array("ids_cadastro_filtro_generico27", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>: 
                            </div>
                        </td>
                        <td class="TbFundoClaro" colspan="3">
                            <div id="divIdsCadastroFiltroGenerico27" class="CadastroTexto">
                                <?php 
                                    $arrCadastroFiltroGenerico27 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 76);
                                ?>
                                
                                <?php if($GLOBALS['configCadastroFiltroGenerico27CaixaSelecao'] == 1){ ?>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico27); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input name="idsCadastroFiltroGenerico27[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico27[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico27[$countArray][1];?>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroFiltroGenerico27CaixaSelecao'] == 2){ ?>
                                    <select id="idsCadastroFiltroGenerico27[]" name="idsCadastroFiltroGenerico27[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico27); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrCadastroFiltroGenerico27[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico27[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select> 
                                    <br />
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroFiltroGenerico27CaixaSelecao'] == 3){ ?>
                                    <select id="idsCadastroFiltroGenerico27[]" name="idsCadastroFiltroGenerico27[]" class="AdmCampoDropDownMenu01">
                                        <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico27); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrCadastroFiltroGenerico27[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico27[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroFiltroGenerico28'] == 1){ ?>
					<?php if(in_array("ids_cadastro_filtro_generico28", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico28Nome'], "IncludeConfig"); ?><?php if(in_array("ids_cadastro_filtro_generico28", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>: 
                            </div>
                        </td>
                        <td class="TbFundoClaro" colspan="3">
                            <div id="divIdsCadastroFiltroGenerico28" class="CadastroTexto">
                                <?php 
                                    $arrCadastroFiltroGenerico28 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 77);
                                ?>
                                
                                <?php if($GLOBALS['configCadastroFiltroGenerico28CaixaSelecao'] == 1){ ?>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico28); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input name="idsCadastroFiltroGenerico28[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico28[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico28[$countArray][1];?>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroFiltroGenerico28CaixaSelecao'] == 2){ ?>
                                    <select id="idsCadastroFiltroGenerico28[]" name="idsCadastroFiltroGenerico28[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico28); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrCadastroFiltroGenerico28[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico28[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select> 
                                    <br />
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroFiltroGenerico28CaixaSelecao'] == 3){ ?>
                                    <select id="idsCadastroFiltroGenerico28[]" name="idsCadastroFiltroGenerico28[]" class="AdmCampoDropDownMenu01">
                                        <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico28); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrCadastroFiltroGenerico28[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico28[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroFiltroGenerico29'] == 1){ ?>
					<?php if(in_array("ids_cadastro_filtro_generico29", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico29Nome'], "IncludeConfig"); ?><?php if(in_array("ids_cadastro_filtro_generico29", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>: 
                            </div>
                        </td>
                        <td class="TbFundoClaro" colspan="3">
                            <div id="divIdsCadastroFiltroGenerico29" class="CadastroTexto">
                                <?php 
                                    $arrCadastroFiltroGenerico29 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 78);
                                ?>
                                
                                <?php if($GLOBALS['configCadastroFiltroGenerico29CaixaSelecao'] == 1){ ?>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico29); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input name="idsCadastroFiltroGenerico29[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico29[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico29[$countArray][1];?>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroFiltroGenerico29CaixaSelecao'] == 2){ ?>
                                    <select id="idsCadastroFiltroGenerico29[]" name="idsCadastroFiltroGenerico29[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico29); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrCadastroFiltroGenerico29[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico29[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select> 
                                    <br />
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroFiltroGenerico29CaixaSelecao'] == 3){ ?>
                                    <select id="idsCadastroFiltroGenerico29[]" name="idsCadastroFiltroGenerico29[]" class="AdmCampoDropDownMenu01">
                                        <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico29); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrCadastroFiltroGenerico29[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico29[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroFiltroGenerico30'] == 1){ ?>
					<?php if(in_array("ids_cadastro_filtro_generico30", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico30Nome'], "IncludeConfig"); ?><?php if(in_array("ids_cadastro_filtro_generico30", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>: 
                            </div>
                        </td>
                        <td class="TbFundoClaro" colspan="3">
                            <div id="divIdsCadastroFiltroGenerico30" class="CadastroTexto">
                                <?php 
                                    $arrCadastroFiltroGenerico30 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 79);
                                ?>
                                
                                <?php if($GLOBALS['configCadastroFiltroGenerico30CaixaSelecao'] == 1){ ?>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico30); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input name="idsCadastroFiltroGenerico30[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico30[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrCadastroFiltroGenerico30[$countArray][1];?>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroFiltroGenerico30CaixaSelecao'] == 2){ ?>
                                    <select id="idsCadastroFiltroGenerico30[]" name="idsCadastroFiltroGenerico30[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico30); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrCadastroFiltroGenerico30[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico30[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select> 
                                    <br />
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroFiltroGenerico30CaixaSelecao'] == 3){ ?>
                                    <select id="idsCadastroFiltroGenerico30[]" name="idsCadastroFiltroGenerico30[]" class="AdmCampoDropDownMenu01">
                                        <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico30); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrCadastroFiltroGenerico30[$countArray][0];?>"><?php echo $arrCadastroFiltroGenerico30[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
    
                <?php if($GLOBALS['habilitarCadastroAlturaPeso'] == 1){ ?>
                <tr>
                    <?php if(in_array("altura", $arrCadastroFormularioCampos) == true){?>
                    <td class="CadastroTabelaColuna01">
                        <div align="left" class="CadastroTextoNomeCampo">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroAltura"); ?><?php if(in_array("altura", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                        </div>
                    </td>
                    <td class="CadastroTabelaColuna02">
                        <div align="left" class="CadastroTexto">
                            <input type="text" name="altura" id="altura" class="CadastroCampoNumericoReduzido01" maxlength="10" value="0" />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroAlturaMedida"); ?>
                        </div>
                    </td>
                    <?php } ?>
                    <?php if(in_array("peso", $arrCadastroFormularioCampos) == true){?>
                    <td class="CadastroTabelaColuna01">
                        <div align="left" class="CadastroTextoNomeCampo">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroPeso"); ?>:
                        </div>
                    </td>
                    <td class="CadastroTabelaColuna02">
                        <div align="left" class="CadastroTexto">
                            <input type="text" name="peso" id="peso" class="CadastroCampoNumericoReduzido01" maxlength="10" value="0" />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroPesoMedida"); ?>
                         </div>
                    </td>
                    <?php } ?>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroRazaoSocial'] == 1){ ?>
                    <?php if(in_array("razao_social", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroRazaoSocial"); ?><?php if(in_array("razao_social", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div align="left">
                                <input type="text" name="razao_social" id="razao_social" class="CadastroCampoTexto01" maxlength="255" />
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroNomeFantasia'] == 1){ ?>
                    <?php if(in_array("nome_fantasia", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroNomeFantasia"); ?><?php if(in_array("nome_fantasia", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div align="left">
                                <input type="text" name="nome_fantasia" id="nome_fantasia" class="CadastroCampoTexto01" maxlength="255" />
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroDataNascimento'] == 1){ ?>
                    <?php if(in_array("data_nascimento", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroDataNascimento"); ?><?php if(in_array("data_nascimento", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div align="left">
                                <?php //JQuery DatePicker. ?>
                                <?php //---------------------- ?>
                                <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                    <?php if($GLOBALS['configSistemaFormatoData'] == 1){ ?>
                                        <script type="text/javascript">
                                            //Variável para conter todos os campos que funcionam com o DatePicker.
                                            //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                            //var strDatapickerNascimentoPtCampos = "#data_nascimento";
                                            strDatapickerNascimentoPtCampos = strDatapickerNascimentoPtCampos + "#data_nascimento;";
                                        </script>
                                    <?php } ?>
                                    <?php if($GLOBALS['configSistemaFormatoData'] == 2){ ?>
                                        <script type="text/javascript">
                                            //Variável para conter todos os campos que funcionam com o DatePicker.
                                            //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                            //var strDatapickerNascimentoEnCampos = "#data_nascimento";
                                            strDatapickerNascimentoEnCampos = strDatapickerNascimentoEnCampos + "#data_nascimento;";
                                        </script>
                                    <?php } ?>
                                    <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                                
                                    <input type="text" name="data_nascimento" id="data_nascimento" class="CadastroCampoData01" maxlength="10" />
                                    <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                                <?php } ?>
                                <?php //---------------------- ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroData1'] == 1){ ?>
                    <?php if(in_array("data1", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData1'], "IncludeConfig"); ?><?php if(in_array("data1", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div align="left">
                                <?php //JQuery DatePicker. ?>
                                <?php //---------------------- ?>
                                <?php if($GLOBALS['configTipoCampoCadastroData1'] == 1){ ?>
                                    <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                        <?php if($GLOBALS['configSiteFormatoData'] == 1){ ?>
                                            <script type="text/javascript">
                                                //Variável para conter todos os campos que funcionam com o DatePicker.
                                                //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                                //var strDatapickerAgendaPtCampos = "#data1";
                                                strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data1;";
                                            </script>
                                        <?php } ?>
                                        <?php if($GLOBALS['configSiteFormatoData'] == 2){ ?>
                                            <script type="text/javascript">
                                                //Variável para conter todos os campos que funcionam com o DatePicker.
                                                //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                                //var strDatapickerAgendaEnCampos = "#data1";
                                                strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data1;";
                                            </script>
                                        <?php } ?>
                                        <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                                    
                                        <input type="text" name="data1" id="data1" class="CadastroCampoData01" maxlength="10" />
                                        <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                                    <?php } ?>
                                <?php } ?>
                                <?php //---------------------- ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroData2'] == 1){ ?>
                    <?php if(in_array("data2", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData2'], "IncludeConfig"); ?><?php if(in_array("data2", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div align="left">
                                <?php //JQuery DatePicker. ?>
                                <?php //---------------------- ?>
                                <?php if($GLOBALS['configTipoCampoCadastroData2'] == 1){ ?>
                                    <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                        <?php if($GLOBALS['configSiteFormatoData'] == 1){ ?>
                                            <script type="text/javascript">
                                                //Variável para conter todos os campos que funcionam com o DatePicker.
                                                //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                                //var strDatapickerAgendaPtCampos = "#data1";
                                                strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data2;";
                                            </script>
                                        <?php } ?>
                                        <?php if($GLOBALS['configSiteFormatoData'] == 2){ ?>
                                            <script type="text/javascript">
                                                //Variável para conter todos os campos que funcionam com o DatePicker.
                                                //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                                //var strDatapickerAgendaEnCampos = "#data1";
                                                strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data2;";
                                            </script>
                                        <?php } ?>
                                        <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                                    
                                        <input type="text" name="data2" id="data2" class="CadastroCampoData01" maxlength="10" />
                                        <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                                    <?php } ?>
                                <?php } ?>
                                <?php //---------------------- ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroData3'] == 1){ ?>
                    <?php if(in_array("data3", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData3'], "IncludeConfig"); ?><?php if(in_array("data3", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div align="left">
                                <?php //JQuery DatePicker. ?>
                                <?php //---------------------- ?>
                                <?php if($GLOBALS['configTipoCampoCadastroData3'] == 1){ ?>
                                    <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                        <?php if($GLOBALS['configSiteFormatoData'] == 1){ ?>
                                            <script type="text/javascript">
                                                //Variável para conter todos os campos que funcionam com o DatePicker.
                                                //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                                //var strDatapickerAgendaPtCampos = "#data1";
                                                strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data3;";
                                            </script>
                                        <?php } ?>
                                        <?php if($GLOBALS['configSiteFormatoData'] == 2){ ?>
                                            <script type="text/javascript">
                                                //Variável para conter todos os campos que funcionam com o DatePicker.
                                                //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                                //var strDatapickerAgendaEnCampos = "#data1";
                                                strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data3;";
                                            </script>
                                        <?php } ?>
                                        <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                                    
                                        <input type="text" name="data3" id="data3" class="CadastroCampoData01" maxlength="10" />
                                        <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                                    <?php } ?>
                                <?php } ?>
                                <?php //---------------------- ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroData4'] == 1){ ?>
                    <?php if(in_array("data4", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData4'], "IncludeConfig"); ?><?php if(in_array("data4", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div align="left">
                                <?php //JQuery DatePicker. ?>
                                <?php //---------------------- ?>
                                <?php if($GLOBALS['configTipoCampoCadastroData4'] == 1){ ?>
                                    <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                        <?php if($GLOBALS['configSiteFormatoData'] == 1){ ?>
                                            <script type="text/javascript">
                                                //Variável para conter todos os campos que funcionam com o DatePicker.
                                                //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                                //var strDatapickerAgendaPtCampos = "#data1";
                                                strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data4;";
                                            </script>
                                        <?php } ?>
                                        <?php if($GLOBALS['configSiteFormatoData'] == 2){ ?>
                                            <script type="text/javascript">
                                                //Variável para conter todos os campos que funcionam com o DatePicker.
                                                //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                                //var strDatapickerAgendaEnCampos = "#data1";
                                                strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data4;";
                                            </script>
                                        <?php } ?>
                                        <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                                    
                                        <input type="text" name="data4" id="data4" class="CadastroCampoData01" maxlength="10" />
                                        <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                                    <?php } ?>
                                <?php } ?>
                                <?php //---------------------- ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroData5'] == 1){ ?>
                    <?php if(in_array("data5", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData5'], "IncludeConfig"); ?><?php if(in_array("data5", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div align="left">
                                <?php //JQuery DatePicker. ?>
                                <?php //---------------------- ?>
                                <?php if($GLOBALS['configTipoCampoCadastroData5'] == 1){ ?>
                                    <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                        <?php if($GLOBALS['configSiteFormatoData'] == 1){ ?>
                                            <script type="text/javascript">
                                                //Variável para conter todos os campos que funcionam com o DatePicker.
                                                //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                                //var strDatapickerAgendaPtCampos = "#data1";
                                                strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data5;";
                                            </script>
                                        <?php } ?>
                                        <?php if($GLOBALS['configSiteFormatoData'] == 2){ ?>
                                            <script type="text/javascript">
                                                //Variável para conter todos os campos que funcionam com o DatePicker.
                                                //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                                //var strDatapickerAgendaEnCampos = "#data1";
                                                strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data5;";
                                            </script>
                                        <?php } ?>
                                        <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                                    
                                        <input type="text" name="data5" id="data5" class="CadastroCampoData01" maxlength="10" />
                                        <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                                    <?php } ?>
                                <?php } ?>
                                <?php //---------------------- ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroData6'] == 1){ ?>
                    <?php if(in_array("data6", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData6'], "IncludeConfig"); ?><?php if(in_array("data6", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div align="left">
                                <?php //JQuery DatePicker. ?>
                                <?php //---------------------- ?>
                                <?php if($GLOBALS['configTipoCampoCadastroData6'] == 1){ ?>
                                    <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                        <?php if($GLOBALS['configSiteFormatoData'] == 1){ ?>
                                            <script type="text/javascript">
                                                //Variável para conter todos os campos que funcionam com o DatePicker.
                                                //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                                //var strDatapickerAgendaPtCampos = "#data1";
                                                strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data6;";
                                            </script>
                                        <?php } ?>
                                        <?php if($GLOBALS['configSiteFormatoData'] == 2){ ?>
                                            <script type="text/javascript">
                                                //Variável para conter todos os campos que funcionam com o DatePicker.
                                                //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                                //var strDatapickerAgendaEnCampos = "#data1";
                                                strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data6;";
                                            </script>
                                        <?php } ?>
                                        <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                                    
                                        <input type="text" name="data6" id="data6" class="CadastroCampoData01" maxlength="10" />
                                        <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                                    <?php } ?>
                                <?php } ?>
                                <?php //---------------------- ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroData7'] == 1){ ?>
                    <?php if(in_array("data7", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData7'], "IncludeConfig"); ?><?php if(in_array("data7", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div align="left">
                                <?php //JQuery DatePicker. ?>
                                <?php //---------------------- ?>
                                <?php if($GLOBALS['configTipoCampoCadastroData7'] == 1){ ?>
                                    <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                        <?php if($GLOBALS['configSiteFormatoData'] == 1){ ?>
                                            <script type="text/javascript">
                                                //Variável para conter todos os campos que funcionam com o DatePicker.
                                                //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                                //var strDatapickerAgendaPtCampos = "#data1";
                                                strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data7;";
                                            </script>
                                        <?php } ?>
                                        <?php if($GLOBALS['configSiteFormatoData'] == 2){ ?>
                                            <script type="text/javascript">
                                                //Variável para conter todos os campos que funcionam com o DatePicker.
                                                //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                                //var strDatapickerAgendaEnCampos = "#data1";
                                                strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data7;";
                                            </script>
                                        <?php } ?>
                                        <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                                    
                                        <input type="text" name="data7" id="data7" class="CadastroCampoData01" maxlength="10" />
                                        <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                                    <?php } ?>
                                <?php } ?>
                                <?php //---------------------- ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroData8'] == 1){ ?>
                    <?php if(in_array("data8", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData8'], "IncludeConfig"); ?><?php if(in_array("data8", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div align="left">
                                <?php //JQuery DatePicker. ?>
                                <?php //---------------------- ?>
                                <?php if($GLOBALS['configTipoCampoCadastroData8'] == 1){ ?>
                                    <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                        <?php if($GLOBALS['configSiteFormatoData'] == 1){ ?>
                                            <script type="text/javascript">
                                                //Variável para conter todos os campos que funcionam com o DatePicker.
                                                //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                                //var strDatapickerAgendaPtCampos = "#data1";
                                                strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data8;";
                                            </script>
                                        <?php } ?>
                                        <?php if($GLOBALS['configSiteFormatoData'] == 2){ ?>
                                            <script type="text/javascript">
                                                //Variável para conter todos os campos que funcionam com o DatePicker.
                                                //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                                //var strDatapickerAgendaEnCampos = "#data1";
                                                strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data8;";
                                            </script>
                                        <?php } ?>
                                        <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                                    
                                        <input type="text" name="data8" id="data8" class="CadastroCampoData01" maxlength="10" />
                                        <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                                    <?php } ?>
                                <?php } ?>
                                <?php //---------------------- ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroData9'] == 1){ ?>
                    <?php if(in_array("data9", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData9'], "IncludeConfig"); ?><?php if(in_array("data9", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div align="left">
                                <?php //JQuery DatePicker. ?>
                                <?php //---------------------- ?>
                                <?php if($GLOBALS['configTipoCampoCadastroData9'] == 1){ ?>
                                    <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                        <?php if($GLOBALS['configSiteFormatoData'] == 1){ ?>
                                            <script type="text/javascript">
                                                //Variável para conter todos os campos que funcionam com o DatePicker.
                                                //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                                //var strDatapickerAgendaPtCampos = "#data1";
                                                strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data9;";
                                            </script>
                                        <?php } ?>
                                        <?php if($GLOBALS['configSiteFormatoData'] == 2){ ?>
                                            <script type="text/javascript">
                                                //Variável para conter todos os campos que funcionam com o DatePicker.
                                                //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                                //var strDatapickerAgendaEnCampos = "#data1";
                                                strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data9;";
                                            </script>
                                        <?php } ?>
                                        <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                                    
                                        <input type="text" name="data9" id="data9" class="CadastroCampoData01" maxlength="10" />
                                        <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                                    <?php } ?>
                                <?php } ?>
                                <?php //---------------------- ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroData10'] == 1){ ?>
                    <?php if(in_array("data10", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData10'], "IncludeConfig"); ?><?php if(in_array("data10", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div align="left">
                                <?php //JQuery DatePicker. ?>
                                <?php //---------------------- ?>
                                <?php if($GLOBALS['configTipoCampoCadastroData10'] == 1){ ?>
                                    <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                        <?php if($GLOBALS['configSiteFormatoData'] == 1){ ?>
                                            <script type="text/javascript">
                                                //Variável para conter todos os campos que funcionam com o DatePicker.
                                                //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                                //var strDatapickerAgendaPtCampos = "#data1";
                                                strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data10;";
                                            </script>
                                        <?php } ?>
                                        <?php if($GLOBALS['configSiteFormatoData'] == 2){ ?>
                                            <script type="text/javascript">
                                                //Variável para conter todos os campos que funcionam com o DatePicker.
                                                //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                                //var strDatapickerAgendaEnCampos = "#data1";
                                                strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data10;";
                                            </script>
                                        <?php } ?>
                                        <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                                    
                                        <input type="text" name="data10" id="data10" class="CadastroCampoData01" maxlength="10" />
                                        <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                                    <?php } ?>
                                <?php } ?>
                                <?php //---------------------- ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>            
                <?php } ?>            
                
                <?php if($GLOBALS['habilitarCadastroCPFRG'] == 1){ ?>
                <tr>
                    <?php if(in_array("cpf_", $arrCadastroFormularioCampos) == true){?>
                    <td class="CadastroTabelaColuna01">
                        <div align="left" class="CadastroTextoNomeCampo">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroCPF"); ?><?php if(in_array("cpf_", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                        </div>
                    </td>
                    <td class="CadastroTabelaColuna02">
                        <div align="left">
							<?php //alertas ?>
                            <input type="text" name="cpf_" id="cpf_" class="CadastroCampoTexto01" maxlength="255"<?php if($GLOBALS['configCadastroCPFMascara'] == "1") { ?> onkeypress="javascript:mascaraGenerica('###.###.###-##', this, 'formCadastro', 'cpf_');"<?php } ?> />
                            <span id="lblCPFValidacaoAlerta" class="AdmAlerta" style="display: none;">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroCPFInvalido"); ?>
                            </span>
                            <span id="lblCPFExistenteAlerta" class="AdmAlerta" style="display: none;">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroCPFExistente"); ?>
                            </span>
							
                            
							<?php //JQuery - Ajax - CPF Duplicado.?>
                            <?php //----------------------?>
                            <?php if($GLOBALS['configCadastroCPFVerificacaoDuplicado'] == 1){ ?>
                                <script type="text/javascript">
                                    $("#cpf_").keyup(function() {
                                        //Variáveis.
                                        var cpfCampo = $(this);
                                        var cpfConsulta = cpfCampo.val().replace(/\D/g,'');
                                        var cpfExistenteRetorno = "";
                                        
                                        var divProgressBar = "updtProgressCadastro";
                                        var btnSubmit = "btnCadastroIncluir";
                                        var lblAlerta = "lblCPFExistenteAlerta";
                                        
                                        
                                        //Condição para executar somente depois de todos os caractéres do CPF preenchidos.
                                        if(cpfConsulta.length == 11)
                                        {
                                            //Acionamento da poleta.
                                            divShow(divProgressBar);
                                            
                                            
                                            //Ajax - comando.
                                            //http://tinton.com.br.solidcp.temp-address.com/api/ApiCEP.php
                                            //contentType: 'application/json',
                                            //http://api.zippopotam.us/us/90210
                                            //html jsonp json
                                            //success: function(result, success) 
                                            //error: function(result, success) 
                                            //cache: false,
                                            //async: true,
                                            //data: "cepConsulta=" + "02068030",
                                            /**/
                                            $.ajax({
                                                url: "<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiCadastro.php",
                                                dataType: "html",
                                                type: "GET",
                                                data: "cpfConsulta=" + cpfConsulta,
                                                success: function(retornoDadosURL, success) 
                                                {
                                                    //Ocultação da poleta.
                                                    divHide(divProgressBar);
                                                    
                                                    //Definição de valores.
                                                    cpfExistenteRetorno = retornoDadosURL; //0 - não exitente | 1 - existente
                                                    //alert("cpfExistenteRetorno=" + cpfExistenteRetorno);
                                                    
                                                    //Preenchimento de dados.
                                                    if(cpfExistenteRetorno == "0")
                                                    {
                                                        //Mostrar aviso.
                                                        divHide(lblAlerta);
                                                        
                                                        //Habilitar botão.
                                                        document.getElementById(btnSubmit).disabled = false;
                                                    }
                                                    if(cpfExistenteRetorno == "1")
                                                    {
                                                        //Mostrar aviso.
                                                        divShow(lblAlerta);
                                                        
                                                        //Desabilitar botão.
                                                        document.getElementById(btnSubmit).disabled = true; 
                                                    }
                                                },
                                                error: function(retornoDadosURL, success) 
                                                {
                                                    //$(".zip-error").show(); // Ruh row
                                                    //elementoMensagem01('testeAlvo01', "erro");
                                                    divShow(lblAlerta);
                                                }	
                                            });	
                                                
                                                                        
                                            //Degug.
                                            //elementoMensagem01('testeAlvo01', cepNumero);
                                        }
                                        
                                        
                                        //Condição para reabilitar se as informações estiverem sido excluídas.
                                        if(cpfConsulta.length == 0)
                                        {
                                            //Mostrar aviso.
                                            divHide(lblAlerta);
                                            
                                            //Habilitar botão.
                                            document.getElementById(btnSubmit).disabled = false;
                                        }
                                    });						
                                </script>
                            <?php } ?>
                            <?php //----------------------?>
                        </div>
                    </td>
                    <?php } ?>
                    <?php if(in_array("rg_", $arrCadastroFormularioCampos) == true){?>
                    <td class="CadastroTabelaColuna01">
                        <div align="left" class="CadastroTextoNomeCampo">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroRG"); ?><?php if(in_array("rg_", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                        </div>
                    </td>
                    <td class="CadastroTabelaColuna02">
                        <div align="left" class="CadastroTexto">
                            <input type="text" name="rg_" id="rg_" class="CadastroCampoTexto01" maxlength="255" />
                        </div>
                    </td>
                    <?php } ?>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroCNPJ'] == 1){ ?>
                    <?php if(in_array("cnpj_", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroCNPJ"); ?><?php if(in_array("cnpj_", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div align="left">
                                <?php //alertas ?>
                                <input type="text" name="cnpj_" id="cnpj_" class="CadastroCampoTexto01" maxlength="255"<?php if($GLOBALS['configCadastroCNPJMascara'] == "1") { ?> onkeypress="javascript:mascaraGenerica('##.###.###/####-##', this, 'formCadastro', 'cnpj_');"<?php } ?> />
                                <span id="lblCNPJValidacaoAlerta" class="AdmAlerta" style="display: none;">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroCNPJInvalido"); ?>
                                </span>
                                <span id="lblCNPJExistenteAlerta" class="AdmAlerta" style="display: none;">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroCNPJExistente"); ?>
                                </span>
                                
                                
								<?php //JQuery - Ajax - CNPJ Duplicado.?>
                                <?php //----------------------?>
                                <?php if($GLOBALS['configCadastroCNPJVerificacaoDuplicado'] == 1){ ?>
                                    <script type="text/javascript">
                                        $("#cnpj_").keyup(function() {
                                            var cnpjCampo = $(this);
                                            var cnpjConsulta = cnpjCampo.val().replace(/\D/g,'');
                                            var cnpjExistenteRetorno = "";
                                            
                                            var divProgressBar = "updtProgressCadastro";
                                            var btnSubmit = "btnCadastroIncluir";
                                            var lblAlerta = "lblCNPJExistenteAlerta";
                                            
                                            
                                            //Condição para executar somente depois de todos os caractéres do CPF preenchidos.
                                            if(cnpjConsulta.length == 14)
                                            {
                                                //Acionamento da poleta.
                                                divShow(divProgressBar);
                                                
                                                
                                                //Ajax - comando.
                                                //http://tinton.com.br.solidcp.temp-address.com/api/ApiCEP.php
                                                //contentType: 'application/json',
                                                //http://api.zippopotam.us/us/90210
                                                //html jsonp json
                                                //success: function(result, success) 
                                                //error: function(result, success) 
                                                //cache: false,
                                                //async: true,
                                                //data: "cepConsulta=" + "02068030",
                                                /**/
                                                $.ajax({
                                                    url: "<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiCadastro.php",
                                                    dataType: "html",
                                                    type: "GET",
                                                    data: "cnpjConsulta=" + cnpjConsulta,
                                                    success: function(retornoDadosURL, success) 
                                                    {
                                                        //Ocultação da poleta.
                                                        divHide(divProgressBar);
                                                        
                                                        //Definição de valores.
                                                        cnpjExistenteRetorno = retornoDadosURL; //0 - não exitente | 1 - existente
                                                        //alert("cpfExistenteRetorno=" + cpfExistenteRetorno);
                                                        
                                                        //Preenchimento de dados.
                                                        if(cnpjExistenteRetorno == "0")
                                                        {
                                                            //Mostrar aviso.
                                                            divHide(lblAlerta);
                                                            
                                                            //Habilitar botão.
                                                            document.getElementById(btnSubmit).disabled = false;
                                                        }
                                                        if(cnpjExistenteRetorno == "1")
                                                        {
                                                            //Mostrar aviso.
                                                            divShow(lblAlerta);
                                                            
                                                            //Desabilitar botão.
                                                            document.getElementById(btnSubmit).disabled = true; 
                                                        }
                                                    },
                                                    error: function(retornoDadosURL, success) 
                                                    {
                                                        //$(".zip-error").show(); // Ruh row
                                                        //elementoMensagem01('testeAlvo01', "erro");
                                                        divShow(lblAlerta);
                                                    }	
                                                });	
                                                    
                                                                            
                                                //Degug.
                                                //elementoMensagem01('testeAlvo01', cepNumero);
                                            }
                                            
                                            
                                            //Condição para reabilitar se as informações estiverem sido excluídas.
                                            if(cnpjConsulta.length == 0)
                                            {
                                                //Mostrar aviso.
                                                divHide(lblAlerta);
                                                
                                                //Habilitar botão.
                                                document.getElementById(btnSubmit).disabled = false;
                                            }
                                        });						
                                    </script>
                                <?php } ?>
                                <?php //----------------------?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroDocumento'] == 1){ ?>
                    <?php if(in_array("documento", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroDocumento"); ?><?php if(in_array("documento", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div align="left">
                                <input type="text" name="documento" id="documento" class="CadastroCampoTexto01" maxlength="255" />
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroIEstadualIMunicipal'] == 1){ ?>
                <tr>
                    <?php if(in_array("i_municipal", $arrCadastroFormularioCampos) == true){?>
                    <td class="CadastroTabelaColuna01">
                        <div align="left" class="CadastroTextoNomeCampo">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroInscricaoMunicipal"); ?><?php if(in_array("i_municipal", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                        </div>
                    </td>
                    <td class="CadastroTabelaColuna02">
                        <div align="left">
                            <input type="text" name="i_municipal" id="i_municipal" class="CadastroCampoTexto01" maxlength="255" />
                        </div>
                    </td>
                    <?php } ?>
                    <?php if(in_array("i_estadual", $arrCadastroFormularioCampos) == true){?>
                    <td class="CadastroTabelaColuna01">
                        <div align="left" class="CadastroTextoNomeCampo">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroInscricaoEstadual"); ?><?php if(in_array("i_estadual", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                        </div>
                    </td>
                    <td class="CadastroTabelaColuna02">
                        <div align="left" class="CadastroTexto">
                            <input type="text" name="i_estadual" id="i_estadual" class="CadastroCampoTexto01" maxlength="255" />
                        </div>
                    </td>
                    <?php } ?>
                </tr>
                <?php } ?>
                
                
				<?php //Endereço. ?>
                <?php //---------------------- ?>
                <?php if($GLOBALS['configCadastroIncluirLocalizacao'] == 1){ ?>
                <?php if(in_array("cep_principal", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="CadastroTabelaColuna01">
                        <div align="left" class="CadastroTextoNomeCampo">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroCEPPrincipal"); ?><?php if(in_array("cep_principal", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                        </div>
                    </td>
                    <td class="CadastroTabelaColuna02" colspan="3">
                        <div align="left">
                            <?php //alertas ?>
                            <input type="text" name="cep_principal" id="cep_principal" class="CadastroCampoTexto02" maxlength="255"<?php if($GLOBALS['configCadastroCEPMascara'] == "1") { ?> onkeypress="javascript:mascaraGenerica('##.###-###', this, 'formCadastro', 'cep_principal');"<?php } ?> value="<?php echo $cepPrincipal;?>" />
                            <span id="lblCEPAlerta" class="AdmAlerta" style="display: none;">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCEPNaoEncontrado"); ?>
                            </span>
                            
                            
							<?php //JQuery - Ajax - CEP.?>
                            <?php //----------------------?>
                            <?php if($GLOBALS['configCadastroCEPPreenchimento'] == 1){ ?>
                            <script type="text/javascript">
                                $("#cep_principal").keyup(function() {
                                    var cepCampo = $(this);
                                    var cepNumero = cepCampo.val().replace(/\D/g,'');
                                    //alert( "Handler for .keyup() called." );
                                    
                                    
                                    //Condição para executar somente depois de todos os caractéres do CEP preenchidos.
                                    if(cepNumero.length == 8)
                                    {
                                        //Acionamento da poleta.
                                        divShow('updtProgressCadastro');
                                        
                                        
                                        //Consulta.
                                        /*
                                        var xhrAPI = new XMLHttpRequest();
                                        xhrAPI.open("GET", "http://tinton.com.br.solidcp.temp-address.com/api/ApiCEP.php", true);
                                        xhrAPI.onreadystatechange = function() {
                                            if(xhrAPI.readyState == 4) {
                                                //alert(client.responseText);
                                                $("#testeAlvo01").val(xhrAPI.responseText);//teste
                                            };
                                        };
                                        xhrAPI.send();
                                        */
                                        
                                        
                                        //Debug.
                                        /*
                                        var client = new XMLHttpRequest();
                                        client.open("GET", "http://api.zippopotam.us/us/90210", true);
                                        client.onreadystatechange = function() {
                                            if(client.readyState == 4) {
                                                //alert(client.responseText);
                                                $("#testeAlvo01").val(client.responseText);//teste
                                            };
                                        };
                                        client.send();
                                        */
                                        
                                                
                                        //Ajax - comando.
                                        //http://tinton.com.br.solidcp.temp-address.com/api/ApiCEP.php
                                        //contentType: 'application/json',
                                        //http://api.zippopotam.us/us/90210
                                        //html jsonp json
                                        //success: function(result, success) 
                                        //error: function(result, success) 
                                        //cache: false,
                                        //async: true,
                                        //data: "cepConsulta=" + "02068030",
                                        /**/
                                        $.ajax({
                                            /*funcionando.
                                            xhr: function () {
                                                var xhr = new window.XMLHttpRequest();
                                                xhr.upload.addEventListener("progress", function (evt) {
                                                    if (evt.lengthComputable) {
                                                        var percentComplete = evt.loaded / evt.total;
                                                        console.log(percentComplete);
                                                        $('.progress').css({
                                                            width: percentComplete * 100 + '%'
                                                        });
                                                        if (percentComplete === 1) {
                                                            $('.progress').addClass('hide');
                                                        }
                                                    }
                                                }, false);
                                                xhr.addEventListener("progress", function (evt) {
                                                    if (evt.lengthComputable) {
                                                        var percentComplete = evt.loaded / evt.total;
                                                        console.log(percentComplete);
                                                        $('.progress').css({
                                                            width: percentComplete * 100 + '%'
                                                        });
                                                    }
                                                }, false);
                                                return xhr;
                                            },
                                            */
                                            url: "<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiCEP.php",
                                            dataType: "html",
                                            type: "GET",
                                            data: "cepConsulta=" + cepNumero + "&tipoPesquisa=<?php echo $GLOBALS['configCadastroCEPPreenchimento'];?>",
                                            success: function(retornoDadosURL, success) 
                                            {
                                                //Ocultação da poleta.
                                                divHide('updtProgressCadastro');
                                                
                                                //Conversão de dados em json.
                                                var jsonRetornoDadosURL = jQuery.parseJSON(retornoDadosURL);
                                                
                                                //Variáveis.
                                                var retornoLogradouro = jsonRetornoDadosURL.logradouro;
                                                var retornoLogradouroCodigo = jsonRetornoDadosURL.logradouroCodigo;
                                                var retornoBairro = jsonRetornoDadosURL.bairro;
                                                var retornoBairroCodigo = jsonRetornoDadosURL.bairroCodigo;
                                                var retornoCidade = jsonRetornoDadosURL.cidade;
                                                var retornoCidadeCodigo = jsonRetornoDadosURL.cidadeCodigo;
                                                var retornoEstado = jsonRetornoDadosURL.uf;
                                                var retornoEstadoCodigo = jsonRetornoDadosURL.ufCodigo;
                                                var retornoPais = jsonRetornoDadosURL.pais;
                                                var retornoPaisCodigo = jsonRetornoDadosURL.paisCodigo;
                                                
                                                
                                                //Preenchimento de dados.
                                                if(retornoLogradouro)
                                                {
                                                    divHide('lblCEPAlerta');
                                                    $("#endereco_principal").val(retornoLogradouro);
                                                    $("#bairro_principal").val(retornoBairro);
                                                    $("#cidade_principal").val(retornoCidade);
                                                    //$("#testeAlvo04").val(retornoEstado);
                                                    $("#estado_principal").val(retornoEstadoCodigo);
                                                    $("#pais_principal").val(retornoPais);
                                                    
                                                    $("#id_db_cep_tblBairros").val(retornoBairroCodigo);
                                                    $("#id_db_cep_tblCidades").val(retornoCidadeCodigo);
                                                    $("#id_db_cep_tblLogradouros").val(retornoLogradouroCodigo);
                                                    $("#id_db_cep_tblUF").val(retornoEstadoCodigo);
                                                    
                                                }else{
                                                    divShow('lblCEPAlerta');
                                                    
                                                    $("#endereco_principal").val("");
                                                    $("#bairro_principal").val("");
                                                    $("#cidade_principal").val("");
                                                    //$("#testeAlvo04").val(retornoEstado);
                                                    $("#estado_principal").val("");
                                                    $("#pais_principal").val("");
                                                    
                                                    $("#id_db_cep_tblBairros").val("0");
                                                    $("#id_db_cep_tblCidades").val("0");
                                                    $("#id_db_cep_tblLogradouros").val("0");
                                                    $("#id_db_cep_tblUF").val("");
                                                }
                                                
                                                
                                                //$("#testeAlvo01").val(result.logradouro);
                                                //$("#testeAlvo01").val(retornoDadosURL);
                                                
                                                //elementoMensagem01('testeAlvo01', "teste");
                                                
                                                /*
                                                $(".fancy-form div > div").slideDown(); // Show the fields 
                                                $("#city").val(result.city); // Fill the data 
                                                $("#state").val(result.state);
                                                $(".zip-error").hide(); // In case they failed once before 
                                                $("#address-line-1").focus(); // Put cursor where they need it 
                                                */
                                            },
                                            error: function(retornoDadosURL, success) 
                                            {
                                                //$(".zip-error").show(); // Ruh row
                                                //elementoMensagem01('testeAlvo01', "erro");
                                                divShow('lblCEPAlerta');
                                            }	
                                        });	
                                            
                                                                    
                                        //Degug.
                                        //elementoMensagem01('testeAlvo01', cepNumero);
                                    }
                                });						
                            
                            </script>
                            <?php } ?>
                            <?php //----------------------?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                <?php if(in_array("endereco_principal", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="CadastroTabelaColuna01">
                        <div align="left" class="CadastroTextoNomeCampo">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroEnderecoPrincipal"); ?><?php if(in_array("endereco_principal", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                        </div>
                    </td>
                    <td class="CadastroTabelaColuna02" colspan="3">
                        <div align="left">
                            <input type="text" name="endereco_principal" id="endereco_principal" class="CadastroCampoTexto01" maxlength="255" value="<?php echo $enderecoPrincipal;?>" />
                        </div>
                    </td>
                </tr>
                <?php } ?>
                <tr>
                    <?php if(in_array("endereco_numero_principal", $arrCadastroFormularioCampos) == true){?>
                    <td class="CadastroTabelaColuna01">
                        <div align="left" class="CadastroTextoNomeCampo">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroEnderecoNumeroPrincipal"); ?><?php if(in_array("endereco_numero_principal", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                        </div>
                    </td>
                    <td class="CadastroTabelaColuna02">
                        <div align="left">
                            <input type="text" name="endereco_numero_principal" id="endereco_numero_principal" class="CadastroCampoTexto02" maxlength="255" value="<?php echo $enderecoNumeroPrincipal;?>" />
                        </div>
                    </td>
                    <?php } ?>
                    <?php if(in_array("endereco_complemento_principal", $arrCadastroFormularioCampos) == true){?>
                    <td class="CadastroTabelaColuna01">
                        <div align="left" class="CadastroTextoNomeCampo">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroEnderecoComplementoPrincipal"); ?><?php if(in_array("endereco_complemento_principal", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                        </div>
                    </td>
                    <td class="CadastroTabelaColuna02">
                        <div align="left">
                            <input type="text" name="endereco_complemento_principal" id="endereco_complemento_principal" class="CadastroCampoTexto02" maxlength="255" value="<?php echo $enderecoComplementoPrincipal;?>" />
                        </div>
                    </td>
                    <?php } ?>
                </tr>
                <tr>
                    <?php if(in_array("bairro_principal", $arrCadastroFormularioCampos) == true){?>
                    <td class="CadastroTabelaColuna01">
                        <div align="left" class="CadastroTextoNomeCampo">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroBairroPrincipal"); ?><?php if(in_array("bairro_principal", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                        </div>
                    </td>
                    <td class="CadastroTabelaColuna02">
                        <div align="left">
                            <input type="text" name="bairro_principal" id="bairro_principal" class="CadastroCampoTexto01" maxlength="255" value="<?php echo $bairroPrincipal;?>" />
                        </div>
                    </td>
                    <?php } ?>
                    <?php if(in_array("cidade_principal", $arrCadastroFormularioCampos) == true){?>
                    <td class="CadastroTabelaColuna01">
                        <div align="left" class="CadastroTextoNomeCampo">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroCidadePrincipal"); ?><?php if(in_array("cidade_principal", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                        </div>
                    </td>
                    <td class="CadastroTabelaColuna02">
                        <div align="left">
                            <input type="text" name="cidade_principal" id="cidade_principal" class="CadastroCampoTexto01" maxlength="255" value="<?php echo $cidadePrincipal;?>" />
                        </div>
                    </td>
                    <?php } ?>
                </tr>
                <tr>
                    <?php if(in_array("estado_principal", $arrCadastroFormularioCampos) == true){?>
                    <td class="CadastroTabelaColuna01">
                        <div align="left" class="CadastroTextoNomeCampo">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroEstadoPrincipal"); ?><?php if(in_array("estado_principal", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                        </div>
                    </td>
                    <td class="CadastroTabelaColuna02">
                        <div align="left">
                            <input type="text" name="estado_principal" id="estado_principal" class="CadastroCampoTexto02" maxlength="255" value="<?php echo $estadoPrincipal;?>" />
                        </div>
                    </td>
                    <?php } ?>
                    <?php if(in_array("pais_principal", $arrCadastroFormularioCampos) == true){?>
                    <td class="CadastroTabelaColuna01">
                        <div align="left" class="CadastroTextoNomeCampo">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroPaisPrincipal"); ?><?php if(in_array("pais_principal", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                        </div>
                    </td>
                    <td class="CadastroTabelaColuna02">
                        <div align="left">
                            <input type="text" name="pais_principal" id="pais_principal" class="CadastroCampoTexto01" maxlength="255" value="<?php echo $paisPrincipal;?>" />
                        </div>
                    </td>
                    <?php } ?>
                </tr>
                <?php } ?>
                <?php //---------------------- ?>
    
                <?php if($GLOBALS['habilitarCadastroPontoReferencia'] == 1){ ?>
                    <?php if(in_array("ponto_referencia", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroPontoReferencia"); ?><?php if(in_array("ponto_referencia", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div align="left">
                                <textarea name="ponto_referencia" id="ponto_referencia" class="CadastroCampoTextoMultilinha01"></textarea>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if(in_array("email_principal", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="CadastroTabelaColuna01">
                        <div align="left" class="CadastroTextoNomeCampo">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroEmailPrincipal"); ?><?php if(in_array("email_principal", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                        </div>
                    </td>
                    <td class="CadastroTabelaColuna02" colspan="3">
                        <div align="left">
                            <input type="text" name="email_principal" id="email_principal" class="CadastroCampoTexto01" maxlength="255" />
                            <span id="lblEmailPrincipalDuplicadoAlerta" class="AdmAlerta" style="display: none;">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroEmailPrincipalVerificacaoDuplicadoAlerta1"); ?>
                            </span>
                            
							<?php //JQuery - Ajax - e-mail Principal Duplicado.?>
                            <?php //----------------------?>
                            <?php if($GLOBALS['configCadastroEmailVerificacaoDuplicado'] == 1){ ?>
                                <script type="text/javascript">
                                    $("#email_principal").focusout(function() {
                                        //Variáveis.
                                        var emailPrincipalCampo = $(this)
                                        var emailPrincipalConsulta = emailPrincipalCampo.val();
                                        var emailPrincipalRetorno = "";
                                        
                                        var divProgressBar = "updtProgressCadastro";
                                        var btnSubmit = "btnCadastroIncluir";
                                        var lblAlerta = "lblEmailPrincipalDuplicadoAlerta";
                                        
                                        
                                        //Debug.
                                        //alert("Função acionada!" + emailPrincipalConsulta);
                                        
                                        
                                        //Condição para executar somente depois de todos os caractéres do CPF preenchidos.
                                        if(emailPrincipalConsulta.length > 1)
                                        {
                                            //Acionamento da poleta.
                                            divShow(divProgressBar);
                                            
                                            
                                            //Ajax - comando.
                                            //http://tinton.com.br.solidcp.temp-address.com/api/ApiCEP.php
                                            //contentType: 'application/json',
                                            //http://api.zippopotam.us/us/90210
                                            //html jsonp json
                                            //success: function(result, success) 
                                            //error: function(result, success) 
                                            //cache: false,
                                            //async: true,
                                            //data: "cepConsulta=" + "02068030",
                                            /**/
                                            $.ajax({
                                                url: "<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiCadastro.php",
                                                dataType: "html",
                                                type: "GET",
                                                data: "emailPrincipalConsulta=" + emailPrincipalConsulta,
                                                success: function(retornoDadosURL, success) 
                                                {
                                                    //Ocultação da poleta.
                                                    divHide(divProgressBar);
                                                    
                                                    //Definição de valores.
                                                    emailPrincipalRetorno = retornoDadosURL; //0 - não exitente | 1 - existente
                                                    //alert("cpfExistenteRetorno=" + cpfExistenteRetorno);
                                                    
                                                    //Preenchimento de dados.
                                                    if(emailPrincipalRetorno == "0")
                                                    {
                                                        //Mostrar aviso.
                                                        divHide(lblAlerta);
                                                        
                                                        //Habilitar botão.
                                                        document.getElementById(btnSubmit).disabled = false;
                                                    }
                                                    if(emailPrincipalRetorno == "1")
                                                    {
                                                        //Mostrar aviso.
                                                        divShow(lblAlerta);
                                                        
                                                        //Desabilitar botão.
                                                        document.getElementById(btnSubmit).disabled = true; 
                                                    }
                                                },
                                                error: function(retornoDadosURL, success) 
                                                {
                                                    //$(".zip-error").show(); // Ruh row
                                                    //elementoMensagem01('testeAlvo01', "erro");
                                                    divShow(lblAlerta);
                                                }	
                                            });	
                                                
                                                                        
                                            //Degug.
                                            //elementoMensagem01('testeAlvo01', cepNumero);
                                        }
                                        
                                        
                                        //Condição para reabilitar se as informações estiverem sido excluídas.
                                        if(emailPrincipalConsulta.length == 0)
                                        {
                                            //Mostrar aviso.
                                            divHide(lblAlerta);
                                            
                                            //Habilitar botão.
                                            document.getElementById(btnSubmit).disabled = false;
                                        }
                                    });						
                                </script>
                            <?php } ?>
                            <?php //----------------------?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                <?php if(in_array("tel_principal", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="CadastroTabelaColuna01">
                        <div align="left" class="CadastroTextoNomeCampo">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroTel"); ?><?php if(in_array("tel_principal", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                        </div>
                    </td>
                    <td class="CadastroTabelaColuna02" colspan="3">
                        <div align="left" class="CadastroTexto">
                            (<input type="text" name="tel_ddd_principal" id="tel_ddd_principal" class="CadastroCampoDDD01" maxlength="255" />)
                            <input type="text" name="tel_principal" id="tel_principal" class="CadastroCampoTexto01" maxlength="255" />
                        </div>
                    </td>
                </tr>
                <?php } ?>
                <?php if(in_array("cel_principal", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="CadastroTabelaColuna01">
                        <div align="left" class="CadastroTextoNomeCampo">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroCel"); ?><?php if(in_array("cel_principal", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                        </div>
                    </td>
                    <td class="CadastroTabelaColuna02" colspan="3">
                        <div align="left" class="CadastroTexto">
                            (<input type="text" name="cel_ddd_principal" id="cel_ddd_principal" class="CadastroCampoDDD01" maxlength="255" />)
                            <input type="text" name="cel_principal" id="cel_principal" class="CadastroCampoTexto01" maxlength="255" />
                        </div>
                    </td>
                </tr>
                <?php } ?>
                <?php if(in_array("fax_principal", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="CadastroTabelaColuna01">
                        <div align="left" class="CadastroTextoNomeCampo">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroFax"); ?><?php if(in_array("fax_principal", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                        </div>
                    </td>
                    <td class="CadastroTabelaColuna02" colspan="3">
                        <div align="left" class="CadastroTexto">
                            (<input type="text" name="fax_ddd_principal" id="fax_ddd_principal" class="CadastroCampoDDD01" maxlength="255" />)
                            <input type="text" name="fax_principal" id="fax_principal" class="CadastroCampoTexto01" maxlength="255" />
                        </div>
                    </td>
                </tr>
                <?php } ?>
    
                <?php if($GLOBALS['habilitarCadastroSite'] == 1){ ?>
                    <?php if(in_array("site_principal", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroSitePrincipal"); ?><?php if(in_array("site_principal", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div align="left" class="CadastroTexto">
                                <input type="text" name="site_principal" id="site_principal" class="CadastroCampoTexto01" maxlength="255" />
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroNFuncionarios'] == 1){ ?>
                    <?php if(in_array("n_funcionarios", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroNFuncionarios"); ?><?php if(in_array("n_funcionarios", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div align="left">
                                <input type="text" name="n_funcionarios" id="n_funcionarios" class="CadastroCampoNumericoReduzido01" maxlength="255" />
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if(in_array("obs_interno", $arrCadastroFormularioCampos) == true){?>
                <tr>
                    <td class="CadastroTabelaColuna01">
                        <div align="left" class="CadastroTextoNomeCampo">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroObs"); ?><?php if(in_array("obs_interno", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                        </div>
                    </td>
                    <td class="CadastroTabelaColuna02" colspan="3">
                        <div align="left">
                            <textarea name="obs_interno" id="obs_interno" class="CadastroCampoTextoMultilinha01"></textarea>
                        </div>
                    </td>
                </tr>
                <?php } ?>
    
                <?php if($GLOBALS['habilitarCadastroVinculo1'] == 1){ ?>
                    <?php if(in_array("id_tb_cadastro1", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroVinculo1Nome'], "IncludeConfig"); ?><?php if(in_array("id_tb_cadastro1", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div class="CadastroTexto">
                                <?php 
                                    $arrCadastroVinculo1 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbCadastroVinculo1'], $GLOBALS['configIdTbTipoCadastroVinculo1'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoCadastroVinculo1'], $GLOBALS['configCadastroVinculo1Metodo']);
                                ?>
                                <select name="id_tb_cadastro1" id="id_tb_cadastro1" class="CadastroCampoDropDownMenu01">
                                    <option value="0"selected="selected"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroVinculo1); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrCadastroVinculo1[$countArray][0];?>"><?php echo $arrCadastroVinculo1[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroVinculo2'] == 1){ ?>
                    <?php if(in_array("id_tb_cadastro2", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroVinculo2Nome'], "IncludeConfig"); ?><?php if(in_array("id_tb_cadastro2", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div class="CadastroTexto">
                                <?php 
                                    $arrCadastroVinculo2 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbCadastroVinculo2'], $GLOBALS['configIdTbTipoCadastroVinculo2'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoCadastroVinculo2'], $GLOBALS['configCadastroVinculo2Metodo']);
                                ?>
                                <select name="id_tb_cadastro2" id="id_tb_cadastro2" class="CadastroCampoDropDownMenu01">
                                    <option value="0" selected="selected"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroVinculo2); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrCadastroVinculo2[$countArray][0];?>" selected="selected"><?php echo $arrCadastroVinculo2[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroVinculo3'] == 1){ ?>
                    <?php if(in_array("id_tb_cadastro3", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroVinculo3Nome'], "IncludeConfig"); ?><?php if(in_array("id_tb_cadastro3", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div class="CadastroTexto">
                                <?php 
                                    $arrCadastroVinculo3 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbCadastroVinculo3'], $GLOBALS['configIdTbTipoCadastroVinculo3'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoCadastroVinculo3'], $GLOBALS['configCadastroVinculo3Metodo']);
                                ?>
                                <select name="id_tb_cadastro3" id="id_tb_cadastro3" class="CadastroCampoDropDownMenu01">
                                    <option value="0" selected="selected"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroVinculo3); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrCadastroVinculo3[$countArray][0];?>" selected="selected"><?php echo $arrCadastroVinculo3[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
    
                <?php if($GLOBALS['habilitarCadastroStatus'] == 1){ ?>
                    <?php if(in_array("id_tb_cadastro_status", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroStatus"); ?><?php if(in_array("id_tb_cadastro_status", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div class="CadastroTexto">
                                <?php 
                                    $arrCadastroStatus = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 3);
                                ?>
                                <select name="id_tb_cadastro_status" id="id_tb_cadastro_status" class="CadastroCampoDropDownMenu01">
                                    <option value="0" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroStatus); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrCadastroStatus[$countArray][0];?>"><?php echo $arrCadastroStatus[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroAtivacaoMalaDireta'] == 1){ ?>
                    <?php if(in_array("ativacao_mala_direta", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroAtivacaoMalaDireta"); ?><?php if(in_array("ativacao_mala_direta", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div align="left" class="CadastroTexto">
                                <select name="ativacao_mala_direta" id="ativacao_mala_direta" class="CadastroCampoDropDownMenu01">
                                    <option value="0" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao4"); ?></option>
                                    <option value="1"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao5"); ?></option>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroUsuario'] == 1){ ?>
                    <?php if(in_array("usuario", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroUsuario"); ?><?php if(in_array("usuario", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div align="left">
                                <input type="text" name="usuario" id="usuario" class="CadastroCampoTexto01" maxlength="255" />
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroSenha'] == 1){ ?>
                    <?php if(in_array("senha", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroSenha"); ?><?php if(in_array("senha", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div align="left">
								<?php //echo Crypto::DecryptValue(EncryptValue(Funcoes::ConteudoMascaraLeitura($linhaCadastro['senha']), 2), 2);?>
                                <input type="password" name="senha" id="senha" class="CadastroCampoTexto01" maxlength="255" />
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroImagem'] == 1){ ?>
                    <?php if(in_array("imagem", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemImagem"); ?><?php if(in_array("imagem", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                        <div>
                            <table cellpadding="0" cellspacing="0" style="width: 100%;">
                                <tr>
                                    <td width="1">
                                        <input type="file" name="ArquivoUpload1" id="ArquivoUpload1" class="CadastroCampoArquivoUpload01" accept="image/*" capture="camera" />
                                        <div style="position: relative; display: none;">
                                            <img onclick="btoClick_onEvent('ArquivoUpload1')" src="img/btoCadastroImagem.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemImagem"); ?>" style="cursor: pointer;" />
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
				<?php if($GLOBALS['habilitarCadastroArquivo1'] == 1){ ?>
                	<?php if(in_array("arquivo1", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroTituloArquivo1'], "IncludeConfig"); ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div>
                                <input type="file" name="ArquivoUpload1" id="ArquivoUpload1" class="CadastroCampoArquivoUpload01" />
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroArquivo2'] == 1){ ?>
                	<?php if(in_array("arquivo2", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroTituloArquivo2'], "IncludeConfig"); ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div>
                                <input type="file" name="ArquivoUpload2" id="ArquivoUpload2" class="CadastroCampoArquivoUpload01" />
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroArquivo3'] == 1){ ?>
                	<?php if(in_array("arquivo3", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroTituloArquivo3'], "IncludeConfig"); ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div>
                                <input type="file" name="ArquivoUpload3" id="ArquivoUpload3" class="CadastroCampoArquivoUpload01" />
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroArquivo4'] == 1){ ?>
                	<?php if(in_array("arquivo4", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroTituloArquivo4'], "IncludeConfig"); ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div>
                                <input type="file" name="ArquivoUpload4" id="ArquivoUpload4" class="CadastroCampoArquivoUpload01" />
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroArquivo5'] == 1){ ?>
                	<?php if(in_array("arquivo5", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroTituloArquivo5'], "IncludeConfig"); ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div>
                                <input type="file" name="ArquivoUpload5" id="ArquivoUpload5" class="CadastroCampoArquivoUpload01" />
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroMapaOnline'] == 1){ ?>
                    <?php if(in_array("mapa_online", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroMapaOnline"); ?><?php if(in_array("mapa_online", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div align="left" class="CadastroTexto">
                                <textarea name="mapa_online" id="mapa_online" class="CadastroCampoTextoMultilinha01"></textarea>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroPalavrasChave'] == 1){ ?>
                    <?php if(in_array("palavras_chave", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPalavrasChave01"); ?><?php if(in_array("palavras_chave", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div align="left" class="CadastroTexto">
                                <textarea name="palavras_chave" id="palavras_chave" class="CadastroCampoTextoMultilinha01"></textarea>
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPalavrasChave02"); ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroApresentacao'] == 1){ ?>
                    <?php if(in_array("apresentacao", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroApresentacao"); ?><?php if(in_array("apresentacao", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="apresentacao" id="apresentacao" class="AdmCampoTextoMultilinhaConteudo01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#apresentacao").cleditor(
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
                                    <textarea name="apresentacao" id="apresentacao"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#apresentacao").cleditor(
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
                                    <textarea name="apresentacao" id="apresentacao"></textarea>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                <?php if($GLOBALS['habilitarCadastroServicos'] == 1){ ?>
                    <?php if(in_array("servicos", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroServicos"); ?><?php if(in_array("servicos", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="servicos" id="servicos" class="AdmCampoTextoMultilinhaConteudo01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#servicos").cleditor(
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
                                    <textarea name="servicos" id="servicos"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#servicos").cleditor(
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
                                    <textarea name="servicos" id="servicos"></textarea>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                <?php if($GLOBALS['HabilitarCadastroPromocoes'] == 1){ ?>
                    <?php if(in_array("promocoes", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroPromocoes"); ?><?php if(in_array("promocoes", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="promocoes" id="promocoes" class="AdmCampoTextoMultilinhaConteudo01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#promocoes").cleditor(
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
                                    <textarea name="promocoes" id="promocoes"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#promocoes").cleditor(
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
                                    <textarea name="promocoes" id="promocoes"></textarea>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                <?php if($GLOBALS['habilitarCadastroCondicoesComerciais'] == 1){ ?>
                    <?php if(in_array("condicoes_comerciais", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroCondicoesComerciais"); ?><?php if(in_array("condicoes_comerciais", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="condicoes_comerciais" id="condicoes_comerciais" class="AdmCampoTextoMultilinhaConteudo01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#condicoes_comerciais").cleditor(
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
                                    <textarea name="condicoes_comerciais" id="condicoes_comerciais"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#condicoes_comerciais").cleditor(
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
                                    <textarea name="condicoes_comerciais" id="condicoes_comerciais"></textarea>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                <?php if($GLOBALS['habilitarCadastroFormasPagamento'] == 1){ ?>
                    <?php if(in_array("formas_pagamento", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroFormasPagamento"); ?><?php if(in_array("formas_pagamento", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="formas_pagamento" id="formas_pagamento" class="AdmCampoTextoMultilinhaConteudo01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#formas_pagamento").cleditor(
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
                                    <textarea name="formas_pagamento" id="formas_pagamento"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#formas_pagamento").cleditor(
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
                                    <textarea name="formas_pagamento" id="formas_pagamento"></textarea>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroHorarioAtendimento'] == 1){ ?>
                    <?php if(in_array("horario_atendimento", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroHorarioAtendimento"); ?><?php if(in_array("horario_atendimento", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="horario_atendimento" id="horario_atendimento" class="AdmCampoTextoMultilinhaConteudo01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#horario_atendimento").cleditor(
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
                                    <textarea name="horario_atendimento" id="horario_atendimento"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#horario_atendimento").cleditor(
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
                                    <textarea name="horario_atendimento" id="horario_atendimento"></textarea>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                <?php if($GLOBALS['habilitarCadastroSituacaoAtual'] == 1){ ?>
                    <?php if(in_array("situacao_atual", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroSituacaoAtual"); ?><?php if(in_array("situacao_atual", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="situacao_atual" id="situacao_atual" class="AdmCampoTextoMultilinhaConteudo01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#situacao_atual").cleditor(
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
                                    <textarea name="situacao_atual" id="situacao_atual"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#situacao_atual").cleditor(
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
                                    <textarea name="situacao_atual" id="situacao_atual"></textarea>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroIc1'] == 1){ ?>
                    <?php if(in_array("informacao_complementar1", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc1'], "IncludeConfig"); ?><?php if(in_array("informacao_complementar1", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div>
                                <?php if($GLOBALS['configCadastroBoxIc1'] == 1){ ?>
                                    <input type="text" name="informacao_complementar1" id="informacao_complementar1" class="CadastroCampoTexto01" maxlength="255" />
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroBoxIc1'] == 2){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar1" id="informacao_complementar1" class="CadastroCampoTextoMultilinha01"></textarea>
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
                                        <textarea name="informacao_complementar1" id="informacao_complementar1"></textarea>
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
                                        <textarea name="informacao_complementar1" id="informacao_complementar1"></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroIc2'] == 1){ ?>
                    <?php if(in_array("informacao_complementar2", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc2'], "IncludeConfig"); ?><?php if(in_array("informacao_complementar2", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div>
                                <?php if($GLOBALS['configCadastroBoxIc2'] == 1){ ?>
                                    <input type="text" name="informacao_complementar2" id="informacao_complementar2" class="CadastroCampoTexto01" maxlength="255" />
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroBoxIc2'] == 2){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar2" id="informacao_complementar2" class="CadastroCampoTextoMultilinha01"></textarea>
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
                                        <textarea name="informacao_complementar2" id="informacao_complementar2"></textarea>
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
                                        <textarea name="informacao_complementar2" id="informacao_complementar2"></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarCadastroIc3'] == 1){ ?>
                    <?php if(in_array("informacao_complementar3", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc3'], "IncludeConfig"); ?><?php if(in_array("informacao_complementar3", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div>
                                <?php if($GLOBALS['configCadastroBoxIc3'] == 1){ ?>
                                    <input type="text" name="informacao_complementar3" id="informacao_complementar3" class="CadastroCampoTexto01" maxlength="255" />
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroBoxIc3'] == 2){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar3" id="informacao_complementar3" class="CadastroCampoTextoMultilinha01"></textarea>
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
                                        <textarea name="informacao_complementar3" id="informacao_complementar3"></textarea>
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
                                        <textarea name="informacao_complementar3" id="informacao_complementar3"></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarCadastroIc4'] == 1){ ?>
                    <?php if(in_array("informacao_complementar4", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc4'], "IncludeConfig"); ?><?php if(in_array("informacao_complementar4", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div>
                                <?php if($GLOBALS['configCadastroBoxIc4'] == 1){ ?>
                                    <input type="text" name="informacao_complementar4" id="informacao_complementar4" class="CadastroCampoTexto01" maxlength="255" />
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroBoxIc4'] == 2){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar4" id="informacao_complementar4" class="CadastroCampoTextoMultilinha01"></textarea>
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
                                        <textarea name="informacao_complementar4" id="informacao_complementar4"></textarea>
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
                                        <textarea name="informacao_complementar4" id="informacao_complementar4"></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarCadastroIc5'] == 1){ ?>
                    <?php if(in_array("informacao_complementar5", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc5'], "IncludeConfig"); ?><?php if(in_array("informacao_complementar5", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div>
                                <?php if($GLOBALS['configCadastroBoxIc5'] == 1){ ?>
                                    <input type="text" name="informacao_complementar5" id="informacao_complementar5" class="CadastroCampoTexto01" maxlength="255" />
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroBoxIc5'] == 2){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar5" id="informacao_complementar5" class="CadastroCampoTextoMultilinha01"></textarea>
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
                                        <textarea name="informacao_complementar5" id="informacao_complementar5"></textarea>
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
                                        <textarea name="informacao_complementar5" id="informacao_complementar5"></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroIc6'] == 1){ ?>
                    <?php if(in_array("informacao_complementar6", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc6'], "IncludeConfig"); ?><?php if(in_array("informacao_complementar6", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div>
                                <?php if($GLOBALS['configCadastroBoxIc6'] == 1){ ?>
                                    <input type="text" name="informacao_complementar6" id="informacao_complementar6" class="CadastroCampoTexto01" maxlength="255" />
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroBoxIc6'] == 2){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar6" id="informacao_complementar6" class="CadastroCampoTextoMultilinha01"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação básica (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                        
                                        <script type="text/javascript">
                                            //Caixa básica.
                                            $(document).ready(function () {
                                                $("#informacao_complementar6").cleditor(
        
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
                                        <textarea name="informacao_complementar6" id="informacao_complementar6"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação avançada (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $("#informacao_complementar6").cleditor(
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
                                        <textarea name="informacao_complementar6" id="informacao_complementar6"></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroIc7'] == 1){ ?>
                    <?php if(in_array("informacao_complementar7", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc7'], "IncludeConfig"); ?><?php if(in_array("informacao_complementar7", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div>
                                <?php if($GLOBALS['configCadastroBoxIc7'] == 1){ ?>
                                    <input type="text" name="informacao_complementar7" id="informacao_complementar7" class="CadastroCampoTexto01" maxlength="255" />
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroBoxIc7'] == 2){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar7" id="informacao_complementar7" class="CadastroCampoTextoMultilinha01"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação básica (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                        
                                        <script type="text/javascript">
                                            //Caixa básica.
                                            $(document).ready(function () {
                                                $("#informacao_complementar7").cleditor(
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
                                        <textarea name="informacao_complementar7" id="informacao_complementar7"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação avançada (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $("#informacao_complementar7").cleditor(
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
                                        <textarea name="informacao_complementar7" id="informacao_complementar7"></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarCadastroIc8'] == 1){ ?>
                    <?php if(in_array("informacao_complementar8", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc8'], "IncludeConfig"); ?><?php if(in_array("informacao_complementar8", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div>
                                <?php if($GLOBALS['configCadastroBoxIc8'] == 1){ ?>
                                    <input type="text" name="informacao_complementar8" id="informacao_complementar8" class="CadastroCampoTexto01" maxlength="255" />
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroBoxIc8'] == 2){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar8" id="informacao_complementar8" class="CadastroCampoTextoMultilinha01"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação básica (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                        
                                        <script type="text/javascript">
                                            //Caixa básica.
                                            $(document).ready(function () {
                                                $("#informacao_complementar8").cleditor(
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
                                        <textarea name="informacao_complementar8" id="informacao_complementar8"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação avançada (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $("#informacao_complementar8").cleditor(
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
                                        <textarea name="informacao_complementar8" id="informacao_complementar8"></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarCadastroIc9'] == 1){ ?>
                    <?php if(in_array("informacao_complementar9", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc9'], "IncludeConfig"); ?><?php if(in_array("informacao_complementar9", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div>
                                <?php if($GLOBALS['configCadastroBoxIc9'] == 1){ ?>
                                    <input type="text" name="informacao_complementar9" id="informacao_complementar9" class="CadastroCampoTexto01" maxlength="255" />
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroBoxIc9'] == 2){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar9" id="informacao_complementar9" class="CadastroCampoTextoMultilinha01"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação básica (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                        
                                        <script type="text/javascript">
                                            //Caixa básica.
                                            $(document).ready(function () {
                                                $("#informacao_complementar9").cleditor(
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
                                        <textarea name="informacao_complementar9" id="informacao_complementar9"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação avançada (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $("#informacao_complementar9").cleditor(
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
                                        <textarea name="informacao_complementar9" id="informacao_complementar9"></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarCadastroIc10'] == 1){ ?>
                    <?php if(in_array("informacao_complementar10", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc10'], "IncludeConfig"); ?><?php if(in_array("informacao_complementar10", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div>
                                <?php if($GLOBALS['configCadastroBoxIc10'] == 1){ ?>
                                    <input type="text" name="informacao_complementar10" id="informacao_complementar10" class="CadastroCampoTexto01" maxlength="255" />
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroBoxIc10'] == 2){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar10" id="informacao_complementar10" class="CadastroCampoTextoMultilinha01"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação básica (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                        
                                        <script type="text/javascript">
                                            //Caixa básica.
                                            $(document).ready(function () {
                                                $("#informacao_complementar10").cleditor(
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
                                        <textarea name="informacao_complementar10" id="informacao_complementar10"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação avançada (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $("#informacao_complementar10").cleditor(
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
                                        <textarea name="informacao_complementar10" id="informacao_complementar10"></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroIc11'] == 1){ ?>
                    <?php if(in_array("informacao_complementar11", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc11'], "IncludeConfig"); ?><?php if(in_array("informacao_complementar11", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div>
                                <?php if($GLOBALS['configCadastroBoxIc11'] == 1){ ?>
                                    <input type="text" name="informacao_complementar11" id="informacao_complementar11" class="CadastroCampoTexto01" maxlength="255" />
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroBoxIc11'] == 2){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar11" id="informacao_complementar11" class="CadastroCampoTextoMultilinha01"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação básica (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                        
                                        <script type="text/javascript">
                                            //Caixa básica.
                                            $(document).ready(function () {
                                                $("#informacao_complementar11").cleditor(
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
                                        <textarea name="informacao_complementar11" id="informacao_complementar11"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação avançada (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $("#informacao_complementar11").cleditor(
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
                                        <textarea name="informacao_complementar11" id="informacao_complementar11"></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroIc12'] == 1){ ?>
                    <?php if(in_array("informacao_complementar12", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc12'], "IncludeConfig"); ?><?php if(in_array("informacao_complementar12", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div>
                                <?php if($GLOBALS['configCadastroBoxIc12'] == 1){ ?>
                                    <input type="text" name="informacao_complementar12" id="informacao_complementar12" class="CadastroCampoTexto01" maxlength="255" />
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroBoxIc12'] == 2){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar12" id="informacao_complementar12" class="CadastroCampoTextoMultilinha01"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação básica (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                        
                                        <script type="text/javascript">
                                            //Caixa básica.
                                            $(document).ready(function () {
                                                $("#informacao_complementar12").cleditor(
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
                                        <textarea name="informacao_complementar12" id="informacao_complementar12"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação avançada (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $("#informacao_complementar12").cleditor(
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
                                        <textarea name="informacao_complementar12" id="informacao_complementar12"></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarCadastroIc13'] == 1){ ?>
                    <?php if(in_array("informacao_complementar13", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc13'], "IncludeConfig"); ?><?php if(in_array("informacao_complementar13", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div>
                                <?php if($GLOBALS['configCadastroBoxIc13'] == 1){ ?>
                                    <input type="text" name="informacao_complementar13" id="informacao_complementar13" class="CadastroCampoTexto01" maxlength="255" >
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroBoxIc13'] == 2){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar13" id="informacao_complementar13" class="CadastroCampoTextoMultilinha01"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação básica (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                        
                                        <script type="text/javascript">
                                            //Caixa básica.
                                            $(document).ready(function () {
                                                $("#informacao_complementar13").cleditor(
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
                                        <textarea name="informacao_complementar13" id="informacao_complementar13"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação avançada (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $("#informacao_complementar13").cleditor(
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
                                        <textarea name="informacao_complementar13" id="informacao_complementar13"></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarCadastroIc14'] == 1){ ?>
                    <?php if(in_array("informacao_complementar14", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc14'], "IncludeConfig"); ?><?php if(in_array("informacao_complementar14", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div>
                                <?php if($GLOBALS['configCadastroBoxIc14'] == 1){ ?>
                                    <input type="text" name="informacao_complementar14" id="informacao_complementar14" class="CadastroCampoTexto01" maxlength="255" />
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroBoxIc14'] == 2){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar14" id="informacao_complementar14" class="CadastroCampoTextoMultilinha01"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação básica (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                        
                                        <script type="text/javascript">
                                            //Caixa básica.
                                            $(document).ready(function () {
                                                $("#informacao_complementar14").cleditor(
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
                                        <textarea name="informacao_complementar14" id="informacao_complementar14"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação avançada (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $("#informacao_complementar14").cleditor(
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
                                        <textarea name="informacao_complementar14" id="informacao_complementar14"></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarCadastroIc15'] == 1){ ?>
                    <?php if(in_array("informacao_complementar15", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc15'], "IncludeConfig"); ?><?php if(in_array("informacao_complementar15", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div>
                                <?php if($GLOBALS['configCadastroBoxIc15'] == 1){ ?>
                                    <input type="text" name="informacao_complementar15" id="informacao_complementar15" class="CadastroCampoTexto01" maxlength="255" />
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroBoxIc15'] == 2){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar15" id="informacao_complementar15" class="CadastroCampoTextoMultilinha01"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação básica (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                        
                                        <script type="text/javascript">
                                            //Caixa básica.
                                            $(document).ready(function () {
                                                $("#informacao_complementar15").cleditor(
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
                                        <textarea name="informacao_complementar15" id="informacao_complementar15"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação avançada (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $("#informacao_complementar15").cleditor(
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
                                        <textarea name="informacao_complementar15" id="informacao_complementar15"></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroIc16'] == 1){ ?>
                    <?php if(in_array("informacao_complementar16", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc16'], "IncludeConfig"); ?><?php if(in_array("informacao_complementar16", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div>
                                <?php if($GLOBALS['configCadastroBoxIc16'] == 1){ ?>
                                    <input type="text" name="informacao_complementar16" id="informacao_complementar16" class="CadastroCampoTexto01" maxlength="255" />
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroBoxIc16'] == 2){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar16" id="informacao_complementar16" class="CadastroCampoTextoMultilinha01"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação básica (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                        
                                        <script type="text/javascript">
                                            //Caixa básica.
                                            $(document).ready(function () {
                                                $("#informacao_complementar16").cleditor(
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
                                        <textarea name="informacao_complementar16" id="informacao_complementar16"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação avançada (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $("#informacao_complementar16").cleditor(
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
                                        <textarea name="informacao_complementar16" id="informacao_complementar16"></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroIc17'] == 1){ ?>
                    <?php if(in_array("informacao_complementar17", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc17'], "IncludeConfig"); ?><?php if(in_array("informacao_complementar17", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div>
                                <?php if($GLOBALS['configCadastroBoxIc17'] == 1){ ?>
                                    <input type="text" name="informacao_complementar17" id="informacao_complementar17" class="CadastroCampoTexto01" maxlength="255" />
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroBoxIc12'] == 7){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar17" id="informacao_complementar17" class="CadastroCampoTextoMultilinha01"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação básica (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                        
                                        <script type="text/javascript">
                                            //Caixa básica.
                                            $(document).ready(function () {
                                                $("#informacao_complementar17").cleditor(
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
                                        <textarea name="informacao_complementar17" id="informacao_complementar17"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação avançada (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $("#informacao_complementar17").cleditor(
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
                                        <textarea name="informacao_complementar17" id="informacao_complementar17"></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarCadastroIc18'] == 1){ ?>
                    <?php if(in_array("informacao_complementar18", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc18'], "IncludeConfig"); ?><?php if(in_array("informacao_complementar18", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div>
                                <?php if($GLOBALS['configCadastroBoxIc18'] == 1){ ?>
                                    <input type="text" name="informacao_complementar18" id="informacao_complementar18" class="CadastroCampoTexto01" maxlength="255" />
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroBoxIc18'] == 2){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar18" id="informacao_complementar18" class="CadastroCampoTextoMultilinha01"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação básica (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                        
                                        <script type="text/javascript">
                                            //Caixa básica.
                                            $(document).ready(function () {
                                                $("#informacao_complementar18").cleditor(
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
                                        <textarea name="informacao_complementar18" id="informacao_complementar18"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação avançada (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $("#informacao_complementar18").cleditor(
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
                                        <textarea name="informacao_complementar18" id="informacao_complementar18"></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarCadastroIc19'] == 1){ ?>
                    <?php if(in_array("informacao_complementar19", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc19'], "IncludeConfig"); ?><?php if(in_array("informacao_complementar19", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div>
                                <?php if($GLOBALS['configCadastroBoxIc19'] == 1){ ?>
                                    <input type="text" name="informacao_complementar19" id="informacao_complementar19" class="CadastroCampoTexto01" maxlength="255" />
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroBoxIc19'] == 2){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar19" id="informacao_complementar19" class="CadastroCampoTextoMultilinha01"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação básica (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                        
                                        <script type="text/javascript">
                                            //Caixa básica.
                                            $(document).ready(function () {
                                                $("#informacao_complementar19").cleditor(
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
                                        <textarea name="informacao_complementar19" id="informacao_complementar19"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação avançada (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $("#informacao_complementar19").cleditor(
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
                                        <textarea name="informacao_complementar19" id="informacao_complementar19"></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarCadastroIc20'] == 1){ ?>
                    <?php if(in_array("informacao_complementar20", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc20'], "IncludeConfig"); ?><?php if(in_array("informacao_complementar20", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div>
                                <?php if($GLOBALS['configCadastroBoxIc20'] == 1){ ?>
                                    <input type="text" name="informacao_complementar20" id="informacao_complementar20" class="CadastroCampoTexto01" maxlength="255" />
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroBoxIc20'] == 2){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar20" id="informacao_complementar20" class="CadastroCampoTextoMultilinha01"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação básica (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                        
                                        <script type="text/javascript">
                                            //Caixa básica.
                                            $(document).ready(function () {
                                                $("#informacao_complementar20").cleditor(
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
                                        <textarea name="informacao_complementar20" id="informacao_complementar20"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação avançada (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $("#informacao_complementar20").cleditor(
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
                                        <textarea name="informacao_complementar20" id="informacao_complementar20"></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroIc21'] == 1){ ?>
                    <?php if(in_array("informacao_complementar21", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc21'], "IncludeConfig"); ?><?php if(in_array("informacao_complementar21", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div>
                                <?php if($GLOBALS['configCadastroBoxIc21'] == 1){ ?>
                                    <input type="text" name="informacao_complementar21" id="informacao_complementar21" class="CadastroCampoTexto01" maxlength="255" />
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroBoxIc21'] == 2){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar21" id="informacao_complementar21" class="CadastroCampoTextoMultilinha01"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação básica (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                        
                                        <script type="text/javascript">
                                            //Caixa básica.
                                            $(document).ready(function () {
                                                $("#informacao_complementar21").cleditor(
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
                                        <textarea name="informacao_complementar21" id="informacao_complementar21"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação avançada (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $("#informacao_complementar21").cleditor(
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
                                        <textarea name="informacao_complementar21" id="informacao_complementar21"></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroIc22'] == 1){ ?>
                    <?php if(in_array("informacao_complementar22", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc22'], "IncludeConfig"); ?><?php if(in_array("informacao_complementar22", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div>
                                <?php if($GLOBALS['configCadastroBoxIc22'] == 1){ ?>
                                    <input type="text" name="informacao_complementar22" id="informacao_complementar22" class="CadastroCampoTexto01" maxlength="255" />
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroBoxIc22'] == 2){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar22" id="informacao_complementar22" class="CadastroCampoTextoMultilinha01"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação básica (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                        
                                        <script type="text/javascript">
                                            //Caixa básica.
                                            $(document).ready(function () {
                                                $("#informacao_complementar22").cleditor(
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
                                        <textarea name="informacao_complementar22" id="informacao_complementar22"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação avançada (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $("#informacao_complementar22").cleditor(
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
                                        <textarea name="informacao_complementar22" id="informacao_complementar22"></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarCadastroIc23'] == 1){ ?>
                    <?php if(in_array("informacao_complementar23", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc23'], "IncludeConfig"); ?><?php if(in_array("informacao_complementar23", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div>
                                <?php if($GLOBALS['configCadastroBoxIc23'] == 1){ ?>
                                    <input type="text" name="informacao_complementar23" id="informacao_complementar23" class="CadastroCampoTexto01" maxlength="255" />
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroBoxIc23'] == 2){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar23" id="informacao_complementar23" class="CadastroCampoTextoMultilinha01"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação básica (CLEditor).?>
        
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                        
                                        <script type="text/javascript">
                                            //Caixa básica.
                                            $(document).ready(function () {
                                                $("#informacao_complementar23").cleditor(
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
                                        <textarea name="informacao_complementar23" id="informacao_complementar23"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação avançada (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $("#informacao_complementar23").cleditor(
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
                                        <textarea name="informacao_complementar23" id="informacao_complementar23"></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarCadastroIc24'] == 1){ ?>
                    <?php if(in_array("informacao_complementar24", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc24'], "IncludeConfig"); ?><?php if(in_array("informacao_complementar24", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div>
                                <?php if($GLOBALS['configCadastroBoxIc24'] == 1){ ?>
                                    <input type="text" name="informacao_complementar24" id="informacao_complementar24" class="CadastroCampoTexto01" maxlength="255" />
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroBoxIc24'] == 2){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar24" id="informacao_complementar24" class="CadastroCampoTextoMultilinha01"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação básica (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                        
                                        <script type="text/javascript">
                                            //Caixa básica.
                                            $(document).ready(function () {
                                                $("#informacao_complementar24").cleditor(
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
                                        <textarea name="informacao_complementar24" id="informacao_complementar24"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação avançada (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $("#informacao_complementar24").cleditor(
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
                                        <textarea name="informacao_complementar24" id="informacao_complementar24"></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarCadastroIc25'] == 1){ ?>
                    <?php if(in_array("informacao_complementar25", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc25'], "IncludeConfig"); ?><?php if(in_array("informacao_complementar25", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div>
                                <?php if($GLOBALS['configCadastroBoxIc25'] == 1){ ?>
                                    <input type="text" name="informacao_complementar25" id="informacao_complementar25" class="CadastroCampoTexto01" maxlength="255" />
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroBoxIc25'] == 2){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar25" id="informacao_complementar25" class="CadastroCampoTextoMultilinha01"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação básica (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                        
                                        <script type="text/javascript">
                                            //Caixa básica.
                                            $(document).ready(function () {
                                                $("#informacao_complementar25").cleditor(
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
                                        <textarea name="informacao_complementar25" id="informacao_complementar25"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação avançada (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $("#informacao_complementar25").cleditor(
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
                                        <textarea name="informacao_complementar25" id="informacao_complementar25"></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroIc26'] == 1){ ?>
                    <?php if(in_array("informacao_complementar26", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc26']); ?><?php if(in_array("informacao_complementar26", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div>
                                <?php if($GLOBALS['configCadastroBoxIc26'] == 1){ ?>
                                    <input type="text" name="informacao_complementar26" id="informacao_complementar26" class="CadastroCampoTexto01" maxlength="255" />
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroBoxIc26'] == 2){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar26" id="informacao_complementar26" class="CadastroCampoTextoMultilinha01"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação básica (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                        
                                        <script type="text/javascript">
                                            //Caixa básica.
                                            $(document).ready(function () {
                                                $("#informacao_complementar26").cleditor(
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
                                        <textarea name="informacao_complementar26" id="informacao_complementar26"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação avançada (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $("#informacao_complementar26").cleditor(
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
                                        <textarea name="informacao_complementar26" id="informacao_complementar26"></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroIc27'] == 1){ ?>
                    <?php if(in_array("informacao_complementar27", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc27'], "IncludeConfig"); ?><?php if(in_array("informacao_complementar27", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div>
                                <?php if($GLOBALS['configCadastroBoxIc27'] == 1){ ?>
                                    <input type="text" name="informacao_complementar27" id="informacao_complementar27" class="CadastroCampoTexto01" maxlength="255" />
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroBoxIc22'] == 7){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar27" id="informacao_complementar27" class="CadastroCampoTextoMultilinha01"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação básica (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                        
                                        <script type="text/javascript">
                                            //Caixa básica.
                                            $(document).ready(function () {
                                                $("#informacao_complementar27").cleditor(
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
                                        <textarea name="informacao_complementar27" id="informacao_complementar27"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação avançada (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $("#informacao_complementar27").cleditor(
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
                                        <textarea name="informacao_complementar27" id="informacao_complementar27"></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarCadastroIc28'] == 1){ ?>
                    <?php if(in_array("informacao_complementar28", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc28'], "IncludeConfig"); ?><?php if(in_array("informacao_complementar28", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div>
                                <?php if($GLOBALS['configCadastroBoxIc28'] == 1){ ?>
                                    <input type="text" name="informacao_complementar28" id="informacao_complementar28" class="CadastroCampoTexto01" maxlength="255" />
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroBoxIc28'] == 2){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar28" id="informacao_complementar28" class="CadastroCampoTextoMultilinha01"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação básica (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                        
                                        <script type="text/javascript">
                                            //Caixa básica.
                                            $(document).ready(function () {
                                                $("#informacao_complementar28").cleditor(
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
                                        <textarea name="informacao_complementar28" id="informacao_complementar28"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação avançada (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $("#informacao_complementar28").cleditor(
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
                                        <textarea name="informacao_complementar28" id="informacao_complementar28"></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarCadastroIc29'] == 1){ ?>
                    <?php if(in_array("informacao_complementar29", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc29'], "IncludeConfig"); ?><?php if(in_array("informacao_complementar29", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div>
                                <?php if($GLOBALS['configCadastroBoxIc29'] == 1){ ?>
                                    <input type="text" name="informacao_complementar29" id="informacao_complementar29" class="CadastroCampoTexto01" maxlength="255" />
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroBoxIc29'] == 2){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar29" id="informacao_complementar29" class="CadastroCampoTextoMultilinha01"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação básica (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                        
                                        <script type="text/javascript">
                                            //Caixa básica.
                                            $(document).ready(function () {
                                                $("#informacao_complementar29").cleditor(
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
                                        <textarea name="informacao_complementar29" id="informacao_complementar29"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação avançada (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $("#informacao_complementar29").cleditor(
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
                                        <textarea name="informacao_complementar29" id="informacao_complementar29"></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarCadastroIc30'] == 1){ ?>
                    <?php if(in_array("informacao_complementar30", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc30'], "IncludeConfig"); ?><?php if(in_array("informacao_complementar30", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div>
                                <?php if($GLOBALS['configCadastroBoxIc30'] == 1){ ?>
                                    <input type="text" name="informacao_complementar30" id="informacao_complementar30" class="CadastroCampoTexto01" maxlength="255" />
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroBoxIc30'] == 2){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar30" id="informacao_complementar30" class="CadastroCampoTextoMultilinha01"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação básica (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                        
                                        <script type="text/javascript">
                                            //Caixa básica.
                                            $(document).ready(function () {
                                                $("#informacao_complementar30").cleditor(
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
                                        <textarea name="informacao_complementar30" id="informacao_complementar30"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação avançada (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $("#informacao_complementar30").cleditor(
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
                                        <textarea name="informacao_complementar30" id="informacao_complementar30"></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroIc31'] == 1){ ?>
                    <?php if(in_array("informacao_complementar31", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc31'], "IncludeConfig"); ?><?php if(in_array("informacao_complementar31", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div>
                                <?php if($GLOBALS['configCadastroBoxIc31'] == 1){ ?>
                                    <input type="text" name="informacao_complementar31" id="informacao_complementar31" class="CadastroCampoTexto01" maxlength="255" />
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroBoxIc31'] == 2){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar31" id="informacao_complementar31" class="CadastroCampoTextoMultilinha01"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação básica (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                        
                                        <script type="text/javascript">
                                            //Caixa básica.
                                            $(document).ready(function () {
                                                $("#informacao_complementar31").cleditor(
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
                                        <textarea name="informacao_complementar31" id="informacao_complementar31"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação avançada (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $("#informacao_complementar31").cleditor(
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
                                        <textarea name="informacao_complementar31" id="informacao_complementar31"></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroIc32'] == 1){ ?>
                    <?php if(in_array("informacao_complementar32", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc32'], "IncludeConfig"); ?><?php if(in_array("informacao_complementar32", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div>
                                <?php if($GLOBALS['configCadastroBoxIc32'] == 1){ ?>
                                    <input type="text" name="informacao_complementar32" id="informacao_complementar32" class="CadastroCampoTexto01" maxlength="255" />
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroBoxIc32'] == 2){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar32" id="informacao_complementar32" class="CadastroCampoTextoMultilinha01"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação básica (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                        
                                        <script type="text/javascript">
                                            //Caixa básica.
                                            $(document).ready(function () {
                                                $("#informacao_complementar32").cleditor(
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
                                        <textarea name="informacao_complementar32" id="informacao_complementar32"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação avançada (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $("#informacao_complementar32").cleditor(
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
                                        <textarea name="informacao_complementar32" id="informacao_complementar32"></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarCadastroIc33'] == 1){ ?>
                    <?php if(in_array("informacao_complementar33", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc33'], "IncludeConfig"); ?><?php if(in_array("informacao_complementar33", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div>
                                <?php if($GLOBALS['configCadastroBoxIc33'] == 1){ ?>
                                    <input type="text" name="informacao_complementar33" id="informacao_complementar33" class="CadastroCampoTexto01" maxlength="255" />
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroBoxIc33'] == 2){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar33" id="informacao_complementar33" class="CadastroCampoTextoMultilinha01"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação básica (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                        
                                        <script type="text/javascript">
                                            //Caixa básica.
                                            $(document).ready(function () {
                                                $("#informacao_complementar33").cleditor(
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
                                        <textarea name="informacao_complementar33" id="informacao_complementar33"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação avançada (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $("#informacao_complementar33").cleditor(
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
                                        <textarea name="informacao_complementar33" id="informacao_complementar33"></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarCadastroIc34'] == 1){ ?>
                    <?php if(in_array("informacao_complementar34", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc34'], "IncludeConfig"); ?><?php if(in_array("informacao_complementar34", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div>
                                <?php if($GLOBALS['configCadastroBoxIc34'] == 1){ ?>
                                    <input type="text" name="informacao_complementar34" id="informacao_complementar34" class="CadastroCampoTexto01" maxlength="255" />
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroBoxIc34'] == 2){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar34" id="informacao_complementar34" class="CadastroCampoTextoMultilinha01"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação básica (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                        
                                        <script type="text/javascript">
                                            //Caixa básica.
                                            $(document).ready(function () {
                                                $("#informacao_complementar34").cleditor(
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
                                        <textarea name="informacao_complementar34" id="informacao_complementar34"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação avançada (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $("#informacao_complementar34").cleditor(
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
                                        <textarea name="informacao_complementar34" id="informacao_complementar34"></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarCadastroIc35'] == 1){ ?>
                    <?php if(in_array("informacao_complementar35", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc35'], "IncludeConfig"); ?><?php if(in_array("informacao_complementar35", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div>
                                <?php if($GLOBALS['configCadastroBoxIc35'] == 1){ ?>
                                    <input type="text" name="informacao_complementar35" id="informacao_complementar35" class="CadastroCampoTexto01" maxlength="255" />
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroBoxIc35'] == 2){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar35" id="informacao_complementar35" class="CadastroCampoTextoMultilinha01"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação básica (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                        
                                        <script type="text/javascript">
                                            //Caixa básica.
                                            $(document).ready(function () {
                                                $("#informacao_complementar35").cleditor(
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
                                        <textarea name="informacao_complementar35" id="informacao_complementar35"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação avançada (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $("#informacao_complementar35").cleditor(
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
                                        <textarea name="informacao_complementar35" id="informacao_complementar35"></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroIc36'] == 1){ ?>
                    <?php if(in_array("informacao_complementar36", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc36'], "IncludeConfig"); ?><?php if(in_array("informacao_complementar36", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div>
                                <?php if($GLOBALS['configCadastroBoxIc36'] == 1){ ?>
                                    <input type="text" name="informacao_complementar36" id="informacao_complementar36" class="CadastroCampoTexto01" maxlength="255" />
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroBoxIc36'] == 2){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar36" id="informacao_complementar36" class="CadastroCampoTextoMultilinha01"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação básica (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                        
                                        <script type="text/javascript">
                                            //Caixa básica.
                                            $(document).ready(function () {
                                                $("#informacao_complementar36").cleditor(
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
                                        <textarea name="informacao_complementar36" id="informacao_complementar36"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação avançada (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $("#informacao_complementar36").cleditor(
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
                                        <textarea name="informacao_complementar36" id="informacao_complementar36"></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroIc37'] == 1){ ?>
                    <?php if(in_array("informacao_complementar37", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc37'], "IncludeConfig"); ?><?php if(in_array("informacao_complementar37", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div>
                                <?php if($GLOBALS['configCadastroBoxIc37'] == 1){ ?>
                                    <input type="text" name="informacao_complementar37" id="informacao_complementar37" class="CadastroCampoTexto01" maxlength="255" />
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroBoxIc32'] == 7){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar37" id="informacao_complementar37" class="CadastroCampoTextoMultilinha01"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação básica (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                        
                                        <script type="text/javascript">
                                            //Caixa básica.
                                            $(document).ready(function () {
                                                $("#informacao_complementar37").cleditor(
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
                                        <textarea name="informacao_complementar37" id="informacao_complementar37"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação avançada (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $("#informacao_complementar37").cleditor(
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
                                        <textarea name="informacao_complementar37" id="informacao_complementar37"></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarCadastroIc38'] == 1){ ?>
                    <?php if(in_array("informacao_complementar38", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc38'], "IncludeConfig"); ?><?php if(in_array("informacao_complementar38", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div>
                                <?php if($GLOBALS['configCadastroBoxIc38'] == 1){ ?>
                                    <input type="text" name="informacao_complementar38" id="informacao_complementar38" class="CadastroCampoTexto01" maxlength="255" />
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroBoxIc38'] == 2){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar38" id="informacao_complementar38" class="CadastroCampoTextoMultilinha01"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação básica (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                        
                                        <script type="text/javascript">
                                            //Caixa básica.
                                            $(document).ready(function () {
                                                $("#informacao_complementar38").cleditor(
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
                                        <textarea name="informacao_complementar38" id="informacao_complementar38"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação avançada (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $("#informacao_complementar38").cleditor(
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
                                        <textarea name="informacao_complementar38" id="informacao_complementar38"></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarCadastroIc39'] == 1){ ?>
                    <?php if(in_array("informacao_complementar39", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc39'], "IncludeConfig"); ?><?php if(in_array("informacao_complementar39", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div>
                                <?php if($GLOBALS['configCadastroBoxIc39'] == 1){ ?>
                                    <input type="text" name="informacao_complementar39" id="informacao_complementar39" class="CadastroCampoTexto01" maxlength="255" />
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroBoxIc39'] == 2){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar39" id="informacao_complementar39" class="CadastroCampoTextoMultilinha01"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação básica (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                        
                                        <script type="text/javascript">
                                            //Caixa básica.
                                            $(document).ready(function () {
                                                $("#informacao_complementar39").cleditor(
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
                                        <textarea name="informacao_complementar39" id="informacao_complementar39"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação avançada (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $("#informacao_complementar39").cleditor(
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
                                        <textarea name="informacao_complementar39" id="informacao_complementar39"></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarCadastroIc40'] == 1){ ?>
                    <?php if(in_array("informacao_complementar40", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc40'], "IncludeConfig"); ?><?php if(in_array("informacao_complementar40", $arrConfigCadastroCamposObrigatorios) == true){ echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica4Bullet"); } ?>:
                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div>
                                <?php if($GLOBALS['configCadastroBoxIc40'] == 1){ ?>
                                    <input type="text" name="informacao_complementar40" id="informacao_complementar40" class="CadastroCampoTexto01" maxlength="255" />
                                <?php } ?>
                                <?php if($GLOBALS['configCadastroBoxIc40'] == 2){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar40" id="informacao_complementar40" class="CadastroCampoTextoMultilinha01"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação básica (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                        
                                        <script type="text/javascript">
                                            //Caixa básica.
                                            $(document).ready(function () {
                                                $("#informacao_complementar40").cleditor(
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
                                        <textarea name="informacao_complementar40" id="informacao_complementar40"></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação avançada (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $("#informacao_complementar40").cleditor(
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
                                        <textarea name="informacao_complementar40" id="informacao_complementar40"></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroVerificarTermo'] == 1){ ?>
                    <?php if(in_array("termo", $arrCadastroFormularioCampos) == true){?>
                    <tr>
                        <td class="CadastroTabelaColuna01">
                            <div align="left" class="CadastroTextoNomeCampo">

                            </div>
                        </td>
                        <td class="CadastroTabelaColuna02" colspan="3">
                            <div id="divTermoCompromisso" class="CadastroTexto">
                                <input name="termo_compromisso" type="checkbox" value="1" class="AdmCampoCheckBox01" /> 
                                <a href="SiteConteudo.php?idParentConteudo=<?php echo $GLOBALS['configIdTermoPort']; ?>" target="_blank" class="CarrinhoLinks01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroTermosCompromissoLink"); ?>
                                </a>:
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroTermosCompromissoTexto"); ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                
            </table>
            <div align="center">
                <input id="btnCadastroIncluir" type="image" name="submit" value="Submit" src="img/btoProsseguir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoProsseguir"); ?>" />
                
                <input type="hidden" id="id_tb_categorias" name="id_tb_categorias" value="<?php echo $idTbCadastro; ?>" />
                <!--input type="hidden" id="idTbCadastroTemporario" name="idTbCadastroTemporario" value="<?php echo $idTbCadastroTemporario; ?>" /-->
                
                <?php if($GLOBALS['habilitarCadastroTipo'] == 1){ ?>
                    <?php if(in_array("tipo", $arrCadastroFormularioCampos) == false){?>
                    <input type="hidden" id="idsCadastroTipo[]" name="idsCadastroTipo[]" value="<?php echo $idTipoCadastro; ?>" />
					<?php } ?>
                <?php } ?>
                <?php if($GLOBALS['habilitarCadastroAtividades'] == 1){ ?>
                    <?php if(in_array("atividades", $arrCadastroFormularioCampos) == false){?>
                    <input type="hidden" id="idsCadastroAtividades[]" name="idsCadastroAtividades[]" value="<?php echo $idAtividadesCadastro; ?>" />
					<?php } ?>
                <?php } ?>
                
                <input type="hidden" id="id_db_cep_tblBairros" name="id_db_cep_tblBairros" value="0" />
                <input type="hidden" id="id_db_cep_tblCidades" name="id_db_cep_tblCidades" value="0" />
                <input type="hidden" id="id_db_cep_tblLogradouros" name="id_db_cep_tblLogradouros" value="0" />
                <input type="hidden" id="id_db_cep_tblUF" name="id_db_cep_tblUF" value="0" />
                
                <?php if($GLOBALS['habilitarCadastroConfirmacaoAtivacaoEmail'] == 1){ ?>
                    <input type="hidden" id="ativacao" name="ativacao" value="0" />
                <?php }else{ ?>
                    <input type="hidden" id="ativacao" name="ativacao" value="1" />
                <?php } ?>
                
                <input type="hidden" id="ativacao_destaque" name="ativacao_destaque" value="0" />
                <input type="hidden" id="n_visitas" name="n_visitas" value="0" />

                <input type="hidden" id="CEPEntrega" name="CEPEntrega" value="<?php echo $CEPEntrega;?>" />
                <input type="hidden" id="codSedex" name="codSedex" value="<?php echo $codSedex;?>" />
                <input type="hidden" id="valorPedido" name="valorPedido" value="<?php echo $valorPedido;?>" />
                <!--input type="hidden" id="valorFrete" name="valorFrete" value="<?php echo $valorFrete;?>" /-->
                <!--input type="hidden" id="pesoTotalCarrinho" name="pesoTotalCarrinho" value="<?php echo $pesoTotalCarrinho;?>" /-->
                <input type="hidden" id="enderecoCobranca" name="enderecoCobranca" value="<?php echo $enderecoCobranca;?>" />
                
                <input type="hidden" id="endereco_entrega" name="endereco_entrega" value="<?php echo $enderecoEntrega;?>" />
                <input type="hidden" id="endereco_numero_entrega" name="endereco_numero_entrega" value="<?php echo $enderecoNumeroEntrega;?>" />
                <input type="hidden" id="endereco_complemento_entrega" name="endereco_complemento_entrega" value="<?php echo $enderecoComplementoEntrega;?>" />
                <input type="hidden" id="endereco_bairro_entrega" name="endereco_bairro_entrega" value="<?php echo $enderecoBairroEntrega;?>" />
                <input type="hidden" id="endereco_cidade_entrega" name="endereco_cidade_entrega" value="<?php echo $enderecoCidadeEntrega;?>" />
                <input type="hidden" id="endereco_estado_entrega" name="endereco_estado_entrega" value="<?php echo $enderecoEstadoEntrega;?>" />
                <input type="hidden" id="endereco_pais_entrega" name="endereco_pais_entrega" value="<?php echo $enderecoPaisEntrega;?>" />
                
                <input type="hidden" id="idItem" name="idItem" value="<?php echo $idItem;?>" />
                <input type="hidden" id="quantidadeAfiliacao" name="quantidadeAfiliacao" value="<?php echo $quantidadeAfiliacao;?>" />

                <input type="hidden" id="paginaRetorno" name="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                <input type="hidden" id="masterPageSiteSelect" name="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
            </div>
        </form>
    </div>
    <?php //**************************************************************************************?>
    
    
    <?php //Progress bar.?>
    <div id="updtProgressCadastro" class="ProgressBarGenerico01Container" style="display: none;">
        <div class="ProgressBarGenerico01">
            <img src="img/ProgressBar01.gif" border="0" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteImagemProgressBarra"); ?>" />
        </div>
    </div>
<?php 
$pageSite->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php
//Inclusão do template do layout.
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>