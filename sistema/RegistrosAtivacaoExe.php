<?php
//Recurso para permitir o redirecionamento (evitar duplicidade de header).
ob_start();


//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
//require_once "IncludeUsuarioVerificacao.php";
require_once "IncludeLayout.php";


//Verificação de login Master.
LoginAutenticacao::UsuarioLoginVerificacao();


//Verificação de login Master.
$idRegistro = $_GET["idRegistro"];

$idParent = $_GET["idParent"];
$idParentCategorias = $_GET["idParentCategorias"];
$idParentConteudo = $_GET["idParentConteudo"];
$idParentProdutos = $_GET["idParentProdutos"];
$idParentVeiculos = $_GET["idParentVeiculos"];

$idParentPublicacoes = $_GET["idParentPublicacoes"];
$tipoPublicacao = $_GET["tipoPublicacao"];

$idParentCadastro = $_GET["idParentCadastro"];
$idParentAfiliacoes = $_GET["idParentAfiliacoes"];

$idParentFormularios = $_GET["idParentFormularios"];
$idTbFormularios = $_GET["idTbFormularios"];
$idTbFormulariosCampos = $_GET["idTbFormulariosCampos"];

$idTbNewsletter = $_GET["idTbNewsletter"];
$idParentNewsletter = $_GET["idParentNewsletter"];
$idTbNewsletterEmailsAvulsoGrupos = $_GET["idTbNewsletterEmailsAvulsoGrupos"];

$idParentEnquetes = $_GET["idParentEnquetes"];
$idTbEnquetes = $_GET["idTbEnquetes"];
$tipoEnquete = $_GET["tipoEnquete"];

$idTbBanners = $_GET["idTbBanners"];
$idTbForumTopicos = $_GET["idTbForumTopicos"];
$idParentPaginas = $_GET["idParentPaginas"];
$idParentProcessos = $_GET["idParentProcessos"];
$idParentTurmas = $_GET["idParentTurmas"];
$idParentModulos = $_GET["idParentModulos"];
$idParentAulas = $_GET["idParentAulas"];

$statusAtivacao = $_GET["statusAtivacao"];
$strCampo = $_GET["strCampo"];
$strTabela = $_GET["strTabela"];

$idTbCadastro = $_GET["idTbCadastro"];
$idTbCadastro1 = $_GET["idTbCadastro1"];
$idTbCadastroCliente = $_GET["idTbCadastroCliente"];
$idTbCadastroUsuario = $_GET["idTbCadastroUsuario"];

$idCePedidos = $_GET["idCePedidos"];
$tipoRelatorio = $_GET["tipoRelatorio"];

$idCeOrcamentos = $_GET["idCeOrcamentos"];
$idCeOrcamentosItens = $_GET["idCeOrcamentosItens"];

$dataInicial = $_GET["dataInicial"];
$dataFinal = $_GET["dataFinal"];

$paginaRetorno = $_GET["paginaRetorno"];
$masterPageSelect = $_GET["masterPageSelect"];
$mensagemErro = "";
$mensagemSucesso = "";

$paginacaoNumero = $_GET["paginacaoNumero"];
$palavraChave = $_GET["palavraChave"];


//Verificação de status.
//Desativação.
if($statusAtivacao == 1){
	if(DbUpdate::DbRegistroGenericoUpdate01("0", $idRegistro, $strTabela, $strCampo))
	{
		//Automação fluxo de caixa.
		//if($habilitarFluxoContabilizacaoAtivacaoPedidos == 1)
		if($GLOBALS['habilitarFluxoContabilizacaoAtivacaoPedidos'] == 1)
		{
			//Pedidos.
			//----------------------
			if($strTabela == "ce_pedidos")
			{
				//Exclusão de registro do fluxo.
				if(DbExcluir::ExcluirRegistrosGenerico02($idRegistro, 
														"tb_fluxo", 
														"id_item",
														"debito_credito", 
														"1", 
														"", 
														"") == true)
														{
															
														}
			}
			//----------------------

			
			//Pedidos parcelas.
			//----------------------
			if($strTabela == "ce_pedidos_parcelas")
			{
				//Exclusão de registro do fluxo.
				if(DbExcluir::ExcluirRegistrosGenerico02($idRegistro, 
														"tb_fluxo", 
														"id_item",
														"debito_credito", 
														"1", 
														"", 
														"") == true)
														{
															
														}
			}
			//----------------------
		}

		
		$mensagemSucesso = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus11");
	}else{
		$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus12");
	}
}

//Ativação.
if($statusAtivacao == 0){
	if(DbUpdate::DbRegistroGenericoUpdate01("1", $idRegistro, $strTabela, $strCampo))
	{
		//Automação fluxo de caixa.
		//if($habilitarFluxoContabilizacaoAtivacaoPedidos == 1)
		if($GLOBALS['habilitarFluxoContabilizacaoAtivacaoPedidos'] == 1)
		{
			//Pedidos.
			//----------------------
			if($strTabela == "ce_pedidos")
			{
				//Verificação de registro de parcelas.
				if(DbFuncoes::GetCampoGenerico06("ce_pedidos_parcelas", 
												"id", 
												"id_ce_pedidos", 
												$idRegistro, 
												"", 
												"", 
												2,
												"", 
												"", 
												"", 
												"", 
												"", 
												"") == "")
				{
					//Definição de algumas variáveis complementares.
					$tbCadastroId = DbFuncoes::GetCampoGenerico01($idRegistro, "ce_pedidos", "id_tb_cadastro_cliente");
					$cePedidosValor = Funcoes::MascaraValorLer(DbFuncoes::GetCampoGenerico01($idRegistro, "ce_pedidos", "valor_total"), $GLOBALS['configSistemaMoeda']);
					$cePedidosId = $idRegistro;
					$lancamento = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFluxoLancamento1") . " (" . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPedidosNumero") . ": " . $cePedidosId . ")";
	
					//Verificação se já existe registro.
					if(DbFuncoes::GetCampoGenerico06("tb_fluxo", 
													"id", 
													"id_item", 
													$idRegistro, 
													"", 
													"", 
													2,
													"", 
													"", 
													"id_tb_cadastro", 
													$tbCadastroId, 
													"debito_credito", 
													"1") == "")
					{
						//Gravação de registro.
						if(DbInsert::FluxoInsert($idRegistro, 
												$GLOBALS['configIdFluxoContabilizacaoAtivacaoPedidos'], 
												"1", 
												$strTabela, 
												$tbCadastroId, 
												"0", 
												$lancamento, 
												$GLOBALS['configTipoFluxoContabilizacaoAtivacaoPedidos'], 
												$GLOBALS['configStatusFluxoContabilizacaoAtivacaoPedidos'], 
												$cePedidosValor, 
												"", 
												"", 
												"", 
												"", 
												"", 
												"", 
												"", 
												"", 
												"", 
												"", 
												"", 
												"", 
												"", 
												"1", 
												"1") == true)
						{
							//Sucesso.
						}
					}
				}
				
				
			}
			//----------------------

			
			//Pedidos parcelas.
			//----------------------
			if($strTabela == "ce_pedidos_parcelas")
			{
				//Definição de algumas variáveis complementares.
				$tbCadastroId = DbFuncoes::GetCampoGenerico01(DbFuncoes::GetCampoGenerico01($idRegistro, "ce_pedidos_parcelas", "id_ce_pedidos"), "ce_pedidos", "id_tb_cadastro_cliente");
				//$cePedidosParcelasValor = Funcoes::MascaraValorLer(DbFuncoes::GetCampoGenerico01($idRegistro, "ce_pedidos_parcelas", "valor"), $GLOBALS['configSistemaMoeda']);
				if($GLOBALS['habilitarPedidosParcelasValorTotal'] == 1)
				{
					$cePedidosParcelasValor = Funcoes::MascaraValorLer(DbFuncoes::GetCampoGenerico01($idRegistro, "ce_pedidos_parcelas", "valor_total"), $GLOBALS['configSistemaMoeda']);
				}else{
					$cePedidosParcelasValor = Funcoes::MascaraValorLer(DbFuncoes::GetCampoGenerico01($idRegistro, "ce_pedidos_parcelas", "valor"), $GLOBALS['configSistemaMoeda']);
				}
				$cePedidosParcelasId = DbFuncoes::GetCampoGenerico01($idRegistro, "ce_pedidos_parcelas", "id_ce_pedidos");
				$lancamento = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFluxoLancamento1") . " (" . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPedidosNumero") . ": " . $cePedidosParcelasId . ")";
				
				//Verificação se já existe registro.
				if(DbFuncoes::GetCampoGenerico06("tb_fluxo", 
												"id", 
												"id_item", 
												$idRegistro, 
												"", 
												"", 
												2,
												"", 
												"", 
												"id_tb_cadastro", 
												$tbCadastroId, 
												"debito_credito", 
												"1") == "")
				{
					//Gravação de registro.
					if(DbInsert::FluxoInsert($idRegistro, 
											$GLOBALS['configIdFluxoContabilizacaoAtivacaoPedidos'], 
											"1", 
											$strTabela, 
											$tbCadastroId, 
											"0", 
											$lancamento, 
											$GLOBALS['configTipoFluxoContabilizacaoAtivacaoPedidos'], 
											$GLOBALS['configStatusFluxoContabilizacaoAtivacaoPedidos'], 
											$cePedidosParcelasValor, 
											"", 
											"", 
											"", 
											"", 
											"", 
											"", 
											"", 
											"", 
											"", 
											"", 
											"", 
											"", 
											"", 
											"1", 
											"1") == true)
					{
						//Sucesso.
					}
				}
			}
			//----------------------
		}

		
		$mensagemSucesso = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus11");
	}else{
		$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus12");
	}
}


//Fechamento da conexão.
$dbSistemaConPDO = null;


//Montagem do URL de retorno.
//https://stackoverflow.com/questions/4394547/loop-through-variables-with-common-name
/*
$arrQueryRetornoVariaveis = array(
	"idParentCategorias", 
	"idParentConteudo", 
	"masterPageSelect"
);
*/
$queryRetorno = "";
$queryRetorno .= "paginacaoNumero=" . $paginacaoNumero;
if($idParent <> "")
{
	$queryRetorno .= "&idParent=" . $idParent;
}
if($idParentCategorias <> "")
{
	$queryRetorno .= "&idParentCategorias=" . $idParentCategorias;
}
if($idParentConteudo <> "")
{
	$queryRetorno .= "&idParentConteudo=" . $idParentConteudo;
}
if($idParentProdutos <> "")
{
	$queryRetorno .= "&idParentProdutos=" . $idParentProdutos;
}
if($idParentVeiculos <> "")
{
	$queryRetorno .= "&idParentVeiculos=" . $idParentVeiculos;
}
if($idParentPublicacoes <> "")
{
	$queryRetorno .= "&idParentPublicacoes=" . $idParentPublicacoes;
}
if($tipoPublicacao <> "")
{
	$queryRetorno .= "&tipoPublicacao=" . $tipoPublicacao;
}
if($idParentCadastro <> "")
{
	$queryRetorno .= "&idParentCadastro=" . $idParentCadastro;
}
if($idParentAfiliacoes <> "")
{
	$queryRetorno .= "&idParentAfiliacoes=" . $idParentAfiliacoes;
}
if($idParentFormularios <> "")
{
	$queryRetorno .= "&idParentFormularios=" . $idParentFormularios;
}
if($idTbFormularios <> "")
{
	$queryRetorno .= "&idTbFormularios=" . $idTbFormularios;
}
if($idTbFormulariosCampos <> "")
{
	$queryRetorno .= "&idTbFormulariosCampos=" . $idTbFormulariosCampos;
}
if($idTbNewsletter <> "")
{
	$queryRetorno .= "&idTbNewsletter=" . $idTbNewsletter;
}
if($idParentNewsletter <> "")
{
	$queryRetorno .= "&idParentNewsletter=" . $idParentNewsletter;
}
if($idTbNewsletterEmailsAvulsoGrupos <> "")
{
	$queryRetorno .= "&idTbNewsletterEmailsAvulsoGrupos=" . $idTbNewsletterEmailsAvulsoGrupos;
}
if($idParentEnquetes <> "")
{
	$queryRetorno .= "&idParentEnquetes=" . $idParentEnquetes;
}
if($idTbEnquetes <> "")
{
	$queryRetorno .= "&idTbEnquetes=" . $idTbEnquetes;
}
if($tipoEnquete <> "")
{
	$queryRetorno .= "&tipoEnquete=" . $tipoEnquete;
}
if($idTbBanners <> "")
{
	$queryRetorno .= "&idTbBanners=" . $idTbBanners;
}
if($idTbForumTopicos <> "")
{
	$queryRetorno .= "&idTbForumTopicos=" . $idTbForumTopicos;
}
if($idParentPaginas <> "")
{
	$queryRetorno .= "&idParentPaginas=" . $idParentPaginas;
}
if($idParentProcessos <> "")
{
	$queryRetorno .= "&idParentProcessos=" . $idParentProcessos;
}
if($idParentTurmas <> "")
{
	$queryRetorno .= "&idParentTurmas=" . $idParentTurmas;
}
if($idParentModulos <> "")
{
	$queryRetorno .= "&idParentModulos=" . $idParentModulos;
}
if($idParentAulas <> "")
{
	$queryRetorno .= "&idParentAulas=" . $idParentAulas;
}
if($idTbCadastro <> "")
{
	$queryRetorno .= "&idTbCadastro=" . $idTbCadastro;
}
if($idTbCadastro1 <> "")
{
	$queryRetorno .= "&idTbCadastro1=" . $idTbCadastro1;
}
if($idTbCadastroCliente <> "")
{
	$queryRetorno .= "&idTbCadastroCliente=" . $idTbCadastroCliente;
}
if($idTbCadastroUsuario <> "")
{
	$queryRetorno .= "&idTbCadastroUsuario=" . $idTbCadastroUsuario;
}
if($idCePedidos <> "")
{
	$queryRetorno .= "&idCePedidos=" . $idCePedidos;
}
if($idCeOrcamentos <> "")
{
	$queryRetorno .= "&idCeOrcamentos=" . $idCeOrcamentos;
}
if($idCeOrcamentosItens <> "")
{
	$queryRetorno .= "&idCeOrcamentosItens=" . $idCeOrcamentosItens;
}
if($tipoRelatorio <> "")
{
	$queryRetorno .= "&tipoRelatorio=" . $tipoRelatorio;
}
if($dataInicial <> "")
{
	$queryRetorno .= "&dataInicial=" . $dataInicial;
}
if($dataFinal <> "")
{
	$queryRetorno .= "&dataFinal=" . $dataFinal;
}
if($palavraChave <> "")
{
	$queryRetorno .= "&palavraChave=" . $palavraChave;
}
if($mensagemSucesso <> "")
{
	$queryRetorno .= "&mensagemSucesso=" . $mensagemSucesso;
}
if($mensagemErro <> "")
{
	$queryRetorno .= "&mensagemErro=" . $mensagemErro;
}
if($masterPageSelect <> "")
{
	$queryRetorno .= "&masterPageSelect=" . $masterPageSelect;
}

$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" . $queryRetorno;

/*
$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
"idParentCategorias=" . $idParentCategorias .
"&idParentConteudo=" . $idParentConteudo .
"&idParentProdutos=" . $idParentProdutos .
"&idParentPublicacoes=" . $idParentPublicacoes .
"&tipoPublicacao=" . $tipoPublicacao .
"&idParentCadastro=" . $idParentCadastro .
"&idParentAfiliacoes=" . $idParentAfiliacoes .
"&idParentFormularios=" . $idParentFormularios .
"&idTbFormularios=" . $idTbFormularios .
"&idTbFormulariosCampos=" . $idTbFormulariosCampos .
"&idParentEnquetes=" . $idParentEnquetes .
"&idTbEnquetes=" . $idTbEnquetes .
"&tipoEnquete=" . $tipoEnquete .
"&idTbBanners=" . $idTbBanners .
"&idParentPaginas=" . $idParentPaginas .
"&idParentProcessos=" . $idParentProcessos .
"&idParentTurmas=" . $idParentTurmas .
"&idParentModulos=" . $idParentModulos .
"&idParentAulas=" . $idParentAulas .
"&idTbCadastro=" . $idTbCadastro .
"&idTbCadastro1=" . $idTbCadastro1 . 
"&idTbCadastroCliente=" . $idTbCadastroCliente .
"&idTbCadastroUsuario=" . $idTbCadastroUsuario .
"&idCePedidos=" . $idCePedidos .
"&idCeOrcamentos=" . $idCeOrcamentos .
"&idCeOrcamentosItens=" . $idCeOrcamentosItens .
"&tipoRelatorio=" . $tipoRelatorio .
"&masterPageSelect=" . $masterPageSelect .
"&dataInicial=" . $dataInicial . 
"&dataFinal=" . $dataFinal . 
"&paginacaoNumero=" . $paginacaoNumero .
"&palavraChave=" . $palavraChave .
"&mensagemSucesso=" . $mensagemSucesso .
"&mensagemErro=" . $mensagemErro;
*/

//Limpeza do buffer de saída.
///*
while (ob_get_status()) 
{
    ob_end_clean();
}
//*/

//Redirecionamento de página.
//exit();
header("Location: " . $URLRetorno);
die();
?>