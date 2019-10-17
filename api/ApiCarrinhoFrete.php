<?php
//Importação dos arquivos de configuração.
require_once "../sistema/IncludeConfig.php"; //Deve vir antes do db.
require_once "../sistema/IncludeConexao.php";
require_once "../sistema/IncludeFuncoes.php";


//Resgate de variáveis.
$apiFormato = $_GET["apiFormato"]; //json | xml
$apiKey = $_GET["apiKey"];

$cepOrigem = Funcoes::SomenteNum($_GET["cepOrigem"]);
$cepDestino = Funcoes::SomenteNum($_GET["cepDestino"]);

$nCdEmpresa = $_GET["nCdEmpresa"];
$sDsSenha = $_GET["sDsSenha"];

$nVlPeso = $_GET["nVlPeso"]; //KG
if($nVlPeso == "")
{
	$nVlPeso = "1";
}

$nCdFormato = $_GET["nCdFormato"]; //1 – Formato caixa/pacote | 2 – Formato rolo/prisma | 3 - Envelope
if($nCdFormato == "")
{
	$nCdFormato = "1";
}

$nVlComprimento = $_GET["nVlComprimento"];
if($nVlComprimento == "")
{
	$nVlComprimento = "16";
}

$nVlAltura = $_GET["nVlAltura"];
if($nVlAltura == "")
{
	$nVlAltura = "2";
}

$nVlLargura = $_GET["nVlLargura"];
if($nVlLargura == "")
{
	$nVlLargura = "11";
}

$nVlDiametro = $_GET["nVlDiametro"];
if($nVlDiametro == "")
{
	$nVlDiametro = "0";
}

$sCdMaoPropria = $_GET["sCdMaoPropria"];
if($sCdMaoPropria == "")
{
	$sCdMaoPropria = "s";
}

$nVlValorDeclarado = $_GET["nVlValorDeclarado"];
//Limitação de valor declarado.
//ref: https://correios.com.br/precos-e-prazos/servicos-adicionais-nacionais
if(strlen($nVlValorDeclarado) >= 3)
{
	$nVlValorDeclarado = substr($nVlValorDeclarado, 0, (strlen($nVlValorDeclarado)-2));
	if($nVlValorDeclarado > 3000)
	{
		$nVlValorDeclarado = "3000"; //R$ 3.000,00 (PAC) | R$ 10.000,00 (demais encomendas)
	}
}

if($nVlValorDeclarado == "")
{
	$nVlValorDeclarado = "200"; //R$ 200,00 
}


$sCdAvisoRecebimento = $_GET["sCdAvisoRecebimento"];
if($sCdAvisoRecebimento == "")
{
	$sCdAvisoRecebimento = "n";
}

$nCdServico = "";
if($sDsSenha <> "")
{
	$nCdServico .= $GLOBALS['configCarrinhoFreteCorreiosContratoPAC'] . ","; //PAC (com contrato)
	$nCdServico .= $GLOBALS['configCarrinhoFreteCorreiosContratoSedex'] . ","; //SEDEX (com contrato)
	$nCdServico .= $GLOBALS['configCarrinhoFreteCorreiosContratoESedex'] . ","; //eSEDEX (com contrato)
	$nCdServico .= "40126,"; //SEDEX a Cobrar (com contrato)
}else{
	$nCdServico .= "41106,"; //PAC (sem contrato) - 41211 (com contrato) (R$ 28,22)
	$nCdServico .= "40010,"; //SEDEX (sem contrato) - 40010 (R$ 40,12) | 04014 (R$ 40,12)
	$nCdServico .= ""; //eSEDEX (sem contrato)
	$nCdServico .= "40045,"; //SEDEX a Cobrar (sem contrato)
}
$nCdServico .= "40215,"; //SEDEX 10 (sem contrato)
$nCdServico .= "40290"; //SEDEX Hoje (sem contrato)

$fretePACCodigo = "";
$fretePACValor = "";
$fretePACValorMaoPropria = "";
$fretePACValorAvisoRecebimento = "";
$fretePACPrazoEntrega = "";
$fretePACEntregaDomiciliar = "";
$fretePACEntregaSabado = "";

$freteSEDEXCodigo = "";
$freteSEDEXValor = "";
$freteSEDEXValorMaoPropria = "";
$freteSEDEXValorAvisoRecebimento = "";
$freteSEDEXPrazoEntrega = "";
$freteSEDEXEntregaDomiciliar = "";
$freteSEDEXEntregaSabado = "";

$freteESEDEXCodigo = "";
$freteESEDEXValor = "";
$freteESEDEXValorMaoPropria = "";
$freteESEDEXValorAvisoRecebimento = "";
$freteESEDEXPrazoEntrega = "";
$freteESEDEXEntregaDomiciliar = "";
$freteESEDEXEntregaSabado = "";

$freteSEDEXACobrarCodigo = "";
$freteSEDEXACobrarValor = "";
$freteSEDEXACobrarValorMaoPropria = "";
$freteSEDEXACobrarValorAvisoRecebimento = "";
$freteSEDEXACobrarPrazoEntrega = "";
$freteSEDEXACobrarEntregaDomiciliar = "";
$freteSEDEXACobrarEntregaSabado = "";

$freteSEDEX10Codigo = "";
$freteSEDEX10Valor = "";
$freteSEDEX10ValorMaoPropria = "";
$freteSEDEX10ValorAvisoRecebimento = "";
$freteSEDEX10PrazoEntrega = "";
$freteSEDEX10EntregaDomiciliar = "";
$freteSEDEX10EntregaSabado = "";

$freteSEDEXHojeCodigo = "";
$freteSEDEXHojeValor = "";
$freteSEDEXHojeValorMaoPropria = "";
$freteSEDEXHojeValorAvisoRecebimento = "";
$freteSEDEXHojePrazoEntrega = "";
$freteSEDEXHojeEntregaDomiciliar = "";
$freteSEDEXHojeEntregaSabado = "";


if(strlen($cepDestino) == 8)
{
	//Cálculo frete - WebService dos Correios.
	//**************************************************************************************
	//Ref.:
	//https://sounoob.com.br/consultar-frete-utilizando-webservice-dos-correios-php/
	//http://docs.sisecommerce.com.br/perguntas-item/envios-os-codigos-da-tabela-de-consulta-webservice-dos-correios/108
	//https://www.correios.com.br/a-a-z/pdf/calculador-remoto-de-precos-e-prazos/manual-de-implementacao-do-calculo-remoto-de-precos-e-prazos
	if($GLOBALS['configCarrinhoFreteCorreiosMetodo'] == 1)
	{
		$dadosConsulta['nCdEmpresa'] = $nCdEmpresa;
		$dadosConsulta['sDsSenha'] = $sDsSenha;
		$dadosConsulta['sCepOrigem'] = $cepOrigem;
		$dadosConsulta['sCepDestino'] = $cepDestino;
		$dadosConsulta['nVlPeso'] = $nVlPeso;
		$dadosConsulta['nCdFormato'] = $nCdFormato;
		$dadosConsulta['nVlComprimento'] = $nVlComprimento;
		$dadosConsulta['nVlAltura'] = $nVlAltura;
		$dadosConsulta['nVlLargura'] = $nVlLargura;
		$dadosConsulta['nVlDiametro'] = $nVlDiametro;
		$dadosConsulta['sCdMaoPropria'] = $sCdMaoPropria;
		$dadosConsulta['nVlValorDeclarado'] = $nVlValorDeclarado;
		$dadosConsulta['sCdAvisoRecebimento'] = $sCdAvisoRecebimento;
		$dadosConsulta['StrRetorno'] = 'xml';
		//$dadosConsulta['nCdServico'] = '40010';
		//$dadosConsulta['nCdServico'] = '40010,40045,40215,41106';
		$dadosConsulta['nCdServico'] = $nCdServico;
		/*
		$dadosConsulta['nCdServico'] = '04510,41068,'; //PAC (sem contrato)
		$dadosConsulta['nCdServico'] = '41211,41068,'; //PAC (com contrato)
		$dadosConsulta['nCdServico'] .= '04014,40096,40436,40444,40568,40606,'; //SEDEX
		$dadosConsulta['nCdServico'] .= '81019,81019,81868,81833,81850,'; //eSEDEX
		$dadosConsulta['nCdServico'] .= '40010,'; //SEDEX (sem contrato)
		$dadosConsulta['nCdServico'] .= '40045,'; //SEDEX a Cobrar (sem contrato)
		$dadosConsulta['nCdServico'] .= '40126,'; //SEDEX a Cobrar (com contrato)
		$dadosConsulta['nCdServico'] .= '40215,'; //SEDEX 10 (sem contrato)
		$dadosConsulta['nCdServico'] .= '40290,'; //SEDEX Hoje (sem contrato)
		$dadosConsulta['nCdServico'] .= '41106'; //PAC (sem contrato)
		*/
		$dadosConsulta = http_build_query($dadosConsulta);
		
		$urlAPICalculoFrete = 'http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx';
		
		$cConsultaCalculoFrete = curl_init($urlAPICalculoFrete . '?' . $dadosConsulta);
		curl_setopt($cConsultaCalculoFrete, CURLOPT_RETURNTRANSFER, true);
		
		$resultadoConsultaCalculoFrete = curl_exec($cConsultaCalculoFrete);
		$resultadoConsultaCalculoFrete = simplexml_load_string($resultadoConsultaCalculoFrete);
		foreach($resultadoConsultaCalculoFrete -> cServico as $linhaResultadoConsultaCalculoFrete)
		{
			//Os dados de cada serviço estará aqui
			if($linhaResultadoConsultaCalculoFrete -> Erro == 0) {
				if($sDsSenha <> "")
				{
					if($linhaResultadoConsultaCalculoFrete -> Codigo == $GLOBALS['configCarrinhoFreteCorreiosContratoPAC'])
					{
						$fretePACCodigo = (string)$linhaResultadoConsultaCalculoFrete -> Codigo;
						$fretePACValor = (string)$linhaResultadoConsultaCalculoFrete -> Valor;
						$fretePACValorMaoPropria = (string)$linhaResultadoConsultaCalculoFrete -> ValorMaoPropria;
						$fretePACValorAvisoRecebimento = (string)$linhaResultadoConsultaCalculoFrete -> ValorAvisoRecebimento;
						$fretePACPrazoEntrega = (string)$linhaResultadoConsultaCalculoFrete -> PrazoEntrega;
						$fretePACEntregaDomiciliar = (string)$linhaResultadoConsultaCalculoFrete -> EntregaDomiciliar;
						$fretePACEntregaSabado = (string)$linhaResultadoConsultaCalculoFrete -> EntregaSabado;
					}
					
					if($linhaResultadoConsultaCalculoFrete -> Codigo == $GLOBALS['configCarrinhoFreteCorreiosContratoSedex'])
					{
						$freteSEDEXCodigo = (string)$linhaResultadoConsultaCalculoFrete -> Codigo;
						$freteSEDEXValor = (string)$linhaResultadoConsultaCalculoFrete -> Valor;
						$freteSEDEXValorMaoPropria = (string)$linhaResultadoConsultaCalculoFrete -> ValorMaoPropria;
						$freteSEDEXValorAvisoRecebimento = $linhaResultadoConsultaCalculoFrete -> ValorAvisoRecebimento;
						$freteSEDEXPrazoEntrega = (string)$linhaResultadoConsultaCalculoFrete -> PrazoEntrega;
						$freteSEDEXEntregaDomiciliar = (string)$linhaResultadoConsultaCalculoFrete -> EntregaDomiciliar;
						$freteSEDEXEntregaSabado = (string)$linhaResultadoConsultaCalculoFrete -> EntregaSabado;
					}
					
					if($linhaResultadoConsultaCalculoFrete -> Codigo == $GLOBALS['configCarrinhoFreteCorreiosContratoESedex'])
					{
						$freteESEDEXCodigo = "";
						$freteESEDEXValor = "";
						$freteESEDEXValorMaoPropria = "";
						$freteESEDEXValorAvisoRecebimento = "";
						$freteESEDEXPrazoEntrega = "";
						$freteESEDEXEntregaDomiciliar = "";
						$freteESEDEXEntregaSabado = "";
					}
					
					if($linhaResultadoConsultaCalculoFrete -> Codigo == "40126")
					{
						$freteSEDEXACobrarCodigo = (string)$linhaResultadoConsultaCalculoFrete -> Codigo;
						$freteSEDEXACobrarValor = (string)$linhaResultadoConsultaCalculoFrete -> Valor;
						$freteSEDEXACobrarValorMaoPropria = (string)$linhaResultadoConsultaCalculoFrete -> ValorMaoPropria;
						$freteSEDEXACobrarValorAvisoRecebimento = (string)$linhaResultadoConsultaCalculoFrete -> ValorAvisoRecebimento;
						$freteSEDEXACobrarPrazoEntrega = (string)$linhaResultadoConsultaCalculoFrete -> PrazoEntrega;
						$freteSEDEXACobrarEntregaDomiciliar = (string)$linhaResultadoConsultaCalculoFrete -> EntregaDomiciliar;
						$freteSEDEXACobrarEntregaSabado = (string)$linhaResultadoConsultaCalculoFrete -> EntregaSabado;
					}
					
					if($linhaResultadoConsultaCalculoFrete -> Codigo == "40126")
					{
						$freteSEDEX10Codigo = (string)$linhaResultadoConsultaCalculoFrete -> Codigo;
						$freteSEDEX10Valor = (string)$linhaResultadoConsultaCalculoFrete -> Valor;
						$freteSEDEX10ValorMaoPropria = (string)$linhaResultadoConsultaCalculoFrete -> ValorMaoPropria;
						$freteSEDEX10ValorAvisoRecebimento = (string)$linhaResultadoConsultaCalculoFrete -> ValorAvisoRecebimento;
						$freteSEDEX10PrazoEntrega = (string)$linhaResultadoConsultaCalculoFrete -> PrazoEntrega;
						$freteSEDEX10EntregaDomiciliar = (string)$linhaResultadoConsultaCalculoFrete -> EntregaDomiciliar;
						$freteSEDEX10EntregaSabado = (string)$linhaResultadoConsultaCalculoFrete -> EntregaSabado;
					}
					
					if($linhaResultadoConsultaCalculoFrete -> Codigo == "40290")
					{
						$freteSEDEXHojeCodigo = (string)$linhaResultadoConsultaCalculoFrete -> Codigo;
						$freteSEDEXHojeValor = (string)$linhaResultadoConsultaCalculoFrete -> Valor;
						$freteSEDEXHojeValorMaoPropria = (string)$linhaResultadoConsultaCalculoFrete -> ValorMaoPropria;
						$freteSEDEXHojeValorAvisoRecebimento = (string)$linhaResultadoConsultaCalculoFrete -> ValorAvisoRecebimento;
						$freteSEDEXHojePrazoEntrega = (string)$linhaResultadoConsultaCalculoFrete -> PrazoEntrega;
						$freteSEDEXHojeEntregaDomiciliar = (string)$linhaResultadoConsultaCalculoFrete -> EntregaDomiciliar;
						$freteSEDEXHojeEntregaSabado = (string)$linhaResultadoConsultaCalculoFrete -> EntregaSabado;
					}
				}else{
					if($linhaResultadoConsultaCalculoFrete -> Codigo == "41106")
					{
						$fretePACCodigo = (string)$linhaResultadoConsultaCalculoFrete -> Codigo;
						$fretePACValor = (string)$linhaResultadoConsultaCalculoFrete -> Valor;
						$fretePACValorMaoPropria = (string)$linhaResultadoConsultaCalculoFrete -> ValorMaoPropria;
						$fretePACValorAvisoRecebimento = (string)$linhaResultadoConsultaCalculoFrete -> ValorAvisoRecebimento;
						$fretePACPrazoEntrega = (string)$linhaResultadoConsultaCalculoFrete -> PrazoEntrega;
						$fretePACEntregaDomiciliar = (string)$linhaResultadoConsultaCalculoFrete -> EntregaDomiciliar;
						$fretePACEntregaSabado = (string)$linhaResultadoConsultaCalculoFrete -> EntregaSabado;
					}
					
					if($linhaResultadoConsultaCalculoFrete -> Codigo == "40010")
					{
						$freteSEDEXCodigo = (string)$linhaResultadoConsultaCalculoFrete -> Codigo;
						$freteSEDEXValor = (string)$linhaResultadoConsultaCalculoFrete -> Valor;
						$freteSEDEXValorMaoPropria = (string)$linhaResultadoConsultaCalculoFrete -> ValorMaoPropria;
						$freteSEDEXValorAvisoRecebimento = (string)$linhaResultadoConsultaCalculoFrete -> ValorAvisoRecebimento;
						$freteSEDEXPrazoEntrega = (string)$linhaResultadoConsultaCalculoFrete -> PrazoEntrega;
						$freteSEDEXEntregaDomiciliar = (string)$linhaResultadoConsultaCalculoFrete -> EntregaDomiciliar;
						$freteSEDEXEntregaSabado = (string)$linhaResultadoConsultaCalculoFrete -> EntregaSabado;
					}
					
					if($linhaResultadoConsultaCalculoFrete -> Codigo == "")
					{
						$freteESEDEXCodigo = "";
						$freteESEDEXValor = "";
						$freteESEDEXValorMaoPropria = "";
						$freteESEDEXValorAvisoRecebimento = "";
						$freteESEDEXPrazoEntrega = "";
						$freteESEDEXEntregaDomiciliar = "";
						$freteESEDEXEntregaSabado = "";
					}
					
					if($linhaResultadoConsultaCalculoFrete -> Codigo == "40045")
					{
						$freteSEDEXACobrarCodigo = (string)$linhaResultadoConsultaCalculoFrete -> Codigo;
						$freteSEDEXACobrarValor = (string)$linhaResultadoConsultaCalculoFrete -> Valor;
						$freteSEDEXACobrarValorMaoPropria = (string)$linhaResultadoConsultaCalculoFrete -> ValorMaoPropria;
						$freteSEDEXACobrarValorAvisoRecebimento = (string)$linhaResultadoConsultaCalculoFrete -> ValorAvisoRecebimento;
						$freteSEDEXACobrarPrazoEntrega = (string)$linhaResultadoConsultaCalculoFrete -> PrazoEntrega;
						$freteSEDEXACobrarEntregaDomiciliar = (string)$linhaResultadoConsultaCalculoFrete -> EntregaDomiciliar;
						$freteSEDEXACobrarEntregaSabado = (string)$linhaResultadoConsultaCalculoFrete -> EntregaSabado;
					}
					
					if($linhaResultadoConsultaCalculoFrete -> Codigo == "40215")
					{
						$freteSEDEX10Codigo = (string)$linhaResultadoConsultaCalculoFrete -> Codigo;
						$freteSEDEX10Valor = (string)$linhaResultadoConsultaCalculoFrete -> Valor;
						$freteSEDEX10ValorMaoPropria = (string)$linhaResultadoConsultaCalculoFrete -> ValorMaoPropria;
						$freteSEDEX10ValorAvisoRecebimento = (string)$linhaResultadoConsultaCalculoFrete -> ValorAvisoRecebimento;
						$freteSEDEX10PrazoEntrega = (string)$linhaResultadoConsultaCalculoFrete -> PrazoEntrega;
						$freteSEDEX10EntregaDomiciliar = (string)$linhaResultadoConsultaCalculoFrete -> EntregaDomiciliar;
						$freteSEDEX10EntregaSabado = (string)$linhaResultadoConsultaCalculoFrete -> EntregaSabado;
					}
					
					if($linhaResultadoConsultaCalculoFrete -> Codigo == "40290")
					{
						$freteSEDEXHojeCodigo = (string)$linhaResultadoConsultaCalculoFrete -> Codigo;
						$freteSEDEXHojeValor = (string)$linhaResultadoConsultaCalculoFrete -> Valor;
						$freteSEDEXHojeValorMaoPropria = (string)$linhaResultadoConsultaCalculoFrete -> ValorMaoPropria;
						$freteSEDEXHojeValorAvisoRecebimento = (string)$linhaResultadoConsultaCalculoFrete -> ValorAvisoRecebimento;
						$freteSEDEXHojePrazoEntrega = (string)$linhaResultadoConsultaCalculoFrete -> PrazoEntrega;
						$freteSEDEXHojeEntregaDomiciliar = (string)$linhaResultadoConsultaCalculoFrete -> EntregaDomiciliar;
						$freteSEDEXHojeEntregaSabado = (string)$linhaResultadoConsultaCalculoFrete -> EntregaSabado;
					}
				}
				
				
				//Debug.
				/*
				echo $linhaResultadoConsultaCalculoFrete -> Codigo . '<br>';
				echo $linhaResultadoConsultaCalculoFrete -> Valor . '<br>';
				echo $linhaResultadoConsultaCalculoFrete -> PrazoEntrega . '<br>';
				echo $linhaResultadoConsultaCalculoFrete -> ValorMaoPropria . '<br>';
				echo $linhaResultadoConsultaCalculoFrete -> ValorAvisoRecebimento . '<br>';
				echo $linhaResultadoConsultaCalculoFrete -> ValorValorDeclarado . '<br>';
				echo $linhaResultadoConsultaCalculoFrete -> EntregaDomiciliar . '<br>';
				echo $linhaResultadoConsultaCalculoFrete -> EntregaSabado;
				*/
			} else {
				//Debug.
				//echo $linhaResultadoConsultaCalculoFrete -> MsgErro;
			}
			//echo '<hr>';
		}
	}
	//**************************************************************************************
}


//Preparação de array para transformar em json.
$arrStrJson = array(
	"fretePACCodigo" => $fretePACCodigo,
	"fretePACValor" => $fretePACValor,
	"fretePACValorMaoPropria" => $fretePACValorMaoPropria,
	"fretePACValorAvisoRecebimento" => $fretePACValorAvisoRecebimento,
	"fretePACPrazoEntrega" => $fretePACPrazoEntrega,
	"fretePACEntregaDomiciliar" => $fretePACEntregaDomiciliar,
	"freteSEDEXEntregaSabado" => $freteSEDEXEntregaSabado,
	
	"freteSEDEXCodigo" => $freteSEDEXCodigo,
	"freteSEDEXValor" => $freteSEDEXValor,
	"freteSEDEXValorMaoPropria" => $freteSEDEXValorMaoPropria,
	"freteSEDEXValorAvisoRecebimento" => $freteSEDEXValorAvisoRecebimento,
	"freteSEDEXPrazoEntrega" => $freteSEDEXPrazoEntrega,
	"freteSEDEXEntregaDomiciliar" => $freteSEDEXEntregaDomiciliar,
	"freteSEDEXEntregaSabado" => $freteSEDEXEntregaSabado,
	
	"freteESEDEXCodigo" => $freteeSEDEXCodigo,
	"freteESEDEXValor" => $freteeSEDEXValor,
	"freteESEDEXValorMaoPropria" => $freteeSEDEXValorMaoPropria,
	"freteESEDEXValorAvisoRecebimento" => $freteeSEDEXValorAvisoRecebimento,
	"freteESEDEXPrazoEntrega" => $freteeSEDEXPrazoEntrega,
	"freteESEDEXEntregaDomiciliar" => $freteeSEDEXEntregaDomiciliar,
	"freteESEDEXEntregaSabado" => $freteeSEDEXEntregaSabado,
	
	"freteSEDEXACobrarCodigo" => $freteSEDEXACobrarCodigo,
	"freteSEDEXACobrarValor" => $freteSEDEXACobrarValor,
	"freteSEDEXACobrarValorMaoPropria" => $freteSEDEXACobrarValorMaoPropria,
	"freteSEDEXACobrarValorAvisoRecebimento" => $freteSEDEXACobrarValorAvisoRecebimento,
	"freteSEDEXACobrarPrazoEntrega" => $freteSEDEXACobrarPrazoEntrega,
	"freteSEDEXACobrarEntregaDomiciliar" => $freteSEDEXACobrarEntregaDomiciliar,
	"freteSEDEXACobrarEntregaSabado" => $freteSEDEXACobrarEntregaSabado,
	
	"freteSEDEX10Codigo" => $freteSEDEX10Codigo,
	"freteSEDEX10Valor" => $freteSEDEX10Valor,
	"freteSEDEX10ValorMaoPropria" => $freteSEDEX10ValorMaoPropria,
	"freteSEDEX10ValorAvisoRecebimento" => $freteSEDEX10ValorAvisoRecebimento,
	"freteSEDEX10PrazoEntrega" => $freteSEDEX10PrazoEntrega,
	"freteSEDEX10EntregaDomiciliar" => $freteSEDEX10EntregaDomiciliar,
	"freteSEDEX10EntregaSabado" => $freteSEDEX10EntregaSabado,
	
	"freteSEDEXHojeCodigo" => $freteSEDEXHojeCodigo,
	"freteSEDEXHojeValor" => $freteSEDEXHojeValor,
	"freteSEDEXHojeValorMaoPropria" => $freteSEDEXHojeValorMaoPropria,
	"freteSEDEXHojeValorAvisoRecebimento" => $freteSEDEXHojeValorAvisoRecebimento,
	"freteSEDEXHojePrazoEntrega" => $freteSEDEXHojePrazoEntrega,
	"freteSEDEXHojeEntregaDomiciliar" => $freteSEDEXHojeEntregaDomiciliar,
	"freteSEDEXHojeEntregaSabado" => $freteSEDEXHojeEntregaSabado,
);


//Exibição de dados.
//echo json_encode($strJason);
echo json_encode($arrStrJson);


//Debug
//Teste: api/ApiCarrinhoFrete.php?cepOrigem=22631455&cepDestino=05460009&nVlPeso=1&nVlValorDeclarado=200&sCdMaoPropria=n$sCdAvisoRecebimento=n
//echo "{\"post code\": \"90210\", \"country\": \"United States\", \"country abbreviation\": \"US\"}";
//echo json_encode("{\"post code\": \"90210\", \"country\": \"United States\", \"country abbreviation\": \"US\"}");
//echo "CEPFill=" . CEP::CEPFill($cepConsulta, "pais") . "<br />";
//echo "CEPFill=" . $arrStrJson["pais"] . "<br />";

//[{"paisCodigo":"","uf":"S\u00e3o Paulo","ufCodigo":"SP","cidade":"S\u00e3o Paulo","cidadeCodigo":"9668","bairro":"Carandiru","bairroCodigo":"25270","logradouro":"Rua dos Camar\u00e9s","logradouroCodigo":"619633"}]
$dbSistemaConPDO = null;
?>