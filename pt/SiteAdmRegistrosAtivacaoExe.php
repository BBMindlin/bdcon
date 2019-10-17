<?php
//Recurso para permitir o redirecionamento (evitar duplicidade de header).
ob_start();


//Importação dos arquivos de configuração.
require_once "../sistema/IncludeConfig.php"; //Deve vir antes do db.
require_once "../sistema/IncludeConexao.php";
require_once "../sistema/IncludeFuncoes.php";
//require_once "IncludeLayout.php";
require_once "IncludeLayoutSite.php";


//Verificação de login de cadastro.
LoginAutenticacao::CadastroLoginVerificacao();


//Resgate de variáveis.
$idRegistro = $_GET["idRegistro"];

$idParent = $_GET["idParent"];
$idParentCategorias = $_GET["idParentCategorias"];
$idParentConteudo = $_GET["idParentConteudo"];
$idParentProdutos = $_GET["idParentProdutos"];
$idParentVeiculos = $_GET["idParentVeiculos"];

$idParentPublicacoes = $_GET["idParentPublicacoes"];
$tipoPublicacao = $_GET["tipoPublicacao"];

$idParentCadastro = $_GET["idParentCadastro"];
$idParentFormularios = $_GET["idParentFormularios"];
$idTbFormularios = $_GET["idTbFormularios"];
$idTbFormulariosCampos = $_GET["idTbFormulariosCampos"];
$idParentPaginas = $_GET["idParentPaginas"];
$idParentProcessos = $_GET["idParentProcessos"];
$idParentFluxo = $_GET["idParentFluxo"];

$idParentForum = $_GET["idParentForum"];
$idTbForumTopicos = $_GET["idTbForumTopicos"];
$idTbForumPostagens = $_GET["idTbForumPostagens"];

$tipoComplemento = $_GET["tipoComplemento"];
$idsProdutosTipo = $_GET["idsProdutosTipo"];

$statusAtivacao = $_GET["statusAtivacao"];
$strCampo = $_GET["strCampo"];
$strTabela = $_GET["strTabela"];

$idTbCadastro = $_GET["idTbCadastro"];
$idTbCadastroUsuario = $_GET["idTbCadastroUsuario"];

$idCePedidos = $_GET["idCePedidos"];

$idCeOrcamentos = $_GET["idCeOrcamentos"];

$paginaRetorno = $_GET["paginaRetorno"];
$masterPageSiteSelect = $_GET["masterPageSiteSelect"];
$mensagemErro = "";
$mensagemSucesso = "";

$paginacaoNumero = $_GET["paginacaoNumero"];
$palavraChave = $_GET["palavraChave"];

$habilitarListagem = $_GET["habilitarListagem"];
$habilitarInclusao = $_GET["habilitarInclusao"];
$habilitarDetalhes = $_GET["habilitarDetalhes"];
$habilitarBusca = $_GET["habilitarBusca"];

$idTbHistoricoStatusSelect = $_GET["idTbHistoricoStatusSelect"];


//Verificação de status.
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
$queryRetorno = "";
$queryRetorno .= "paginacaoNumero=" . $paginacaoNumero;
if($idParent <> "")
{
	$queryRetorno .= "&idParent=" . $idParent;
}
if($idTbHistoricoStatusSelect <> "")
{
	$queryRetorno .= "&idTbHistoricoStatusSelect=" . $idTbHistoricoStatusSelect;
}
if($idParentCategorias <> "")
{
	$queryRetorno .= "&idParentCategorias=" . $idParentCategorias;
}
if($tipoCategoria <> "")
{
	$queryRetorno .= "&tipoCategoria=" . $tipoCategoria;
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
if($idParentBanners <> "")
{
	$queryRetorno .= "&idParentBanners=" . $idParentBanners;
}
if($idTbBanners <> "")
{
	$queryRetorno .= "&idTbBanners=" . $idTbBanners;
}
if($idParentPaginas <> "")
{
	$queryRetorno .= "&idParentPaginas=" . $idParentPaginas;
}
if($idParentProcessos <> "")
{
	$queryRetorno .= "&idParentProcessos=" . $idParentProcessos;
}
if($idParentFluxo <> "")
{
	$queryRetorno .= "&idParentFluxo=" . $idParentFluxo;
}
if($idParentForum <> "")
{
	$queryRetorno .= "&idParentForum=" . $idParentForum;
}
if($idTbForumTopicos <> "")
{
	$queryRetorno .= "&idTbForumTopicos=" . $idTbForumTopicos;
}
if($idTbForumPostagens <> "")
{
	$queryRetorno .= "&idTbForumPostagens=" . $idTbForumPostagens;
}
if($tipoComplemento <> "")
{
	$queryRetorno .= "&tipoComplemento=" . $tipoComplemento;
}
if(!empty($idsProdutosTipo))
{
	$queryRetorno .= "&idsProdutosTipo[0]=" . $idsProdutosTipo[0];
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
if($idTbAulas <> "")
{
	$queryRetorno .= "&idTbAulas=" . $idTbAulas;
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
if($idItem <> "")
{
	$queryRetorno .= "&idItem=" . $idItem;
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
if($detalhe01 <> "")
{
	$queryRetorno .= "&detalhe01=" . $detalhe01;
}
if($detalhe02 <> "")
{
	$queryRetorno .= "&detalhe02=" . $detalhe02;
}
if($mensagemSucesso <> "")
{
	$queryRetorno .= "&mensagemSucesso=" . $mensagemSucesso;
}
if($mensagemErro <> "")
{
	$queryRetorno .= "&mensagemErro=" . $mensagemErro;
}
if($habilitarListagem <> "")
{
	$queryRetorno .= "&habilitarListagem=" . $habilitarListagem;
}
if($habilitarInclusao <> "")
{
	$queryRetorno .= "&habilitarInclusao=" . $habilitarInclusao;
}
if($habilitarDetalhes <> "")
{
	$queryRetorno .= "&habilitarDetalhes=" . $habilitarDetalhes;
}
if($habilitarBusca <> "")
{
	$queryRetorno .= "&habilitarBusca=" . $habilitarBusca;
}
if($masterPageSiteSelect <> "")
{
	$queryRetorno .= "&masterPageSiteSelect=" . $masterPageSiteSelect;
}

$URLRetorno = $configUrl . "/" . $visualizacaoAtivaSistema . "/" . $paginaRetorno . "?" . $queryRetorno;

//$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
/*
$URLRetorno = $configUrl . "/" . $visualizacaoAtivaSistema . "/" . $paginaRetorno . "?" .
"idParentCategorias=" . $idParentCategorias .
"&idParentConteudo=" . $idParentConteudo .
"&idParentPublicacoes=" . $idParentPublicacoes .
"&tipoPublicacao=" . $tipoPublicacao .
"&idParentCadastro=" . $idParentCadastro .
"&idParentFormularios=" . $idParentFormularios .
"&idTbFormularios=" . $idTbFormularios .
"&idTbFormulariosCampos=" . $idTbFormulariosCampos .
"&idParentPaginas=" . $idParentPaginas .
"&idParentProcessos=" . $idParentProcessos .
"&idParentFluxo=" . $idParentFluxo .
"&tipoComplemento=" . $tipoComplemento .
"&idTbCadastro=" . $idTbCadastro .
"&idTbCadastroUsuario=" . $idTbCadastroUsuario .
"&idCePedidos=" . $idCePedidos .
"&idCeOrcamentos=" . $idCeOrcamentos .
"&masterPageSiteSelect=" . $masterPageSiteSelect . 
"&paginacaoNumero=" . $paginacaoNumero .
"&idTbHistoricoStatusSelect=" . $idTbHistoricoStatusSelect .
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