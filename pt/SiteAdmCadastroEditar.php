<?php
//Importação dos arquivos de configuração.
require_once "../sistema/IncludeConfig.php"; //Deve vir antes do db.
require_once "../sistema/IncludeConexao.php";
require_once "../sistema/IncludeFuncoes.php";
//require_once "IncludeLayout.php";
require_once "IncludeLayoutSite.php";


//Verificação de login de cadastro.
LoginAutenticacao::CadastroLoginVerificacao();


//Resgate de variáveis
$idTbCadastro = $_GET["idTbCadastro"];

//Definição dos campos do formulário de acordo com o tipo de cadastro.
//$idTipoCadastro = $_GET["idTipoCadastro"];
$idTipoCadastro = DbFuncoes::FiltrosGenericosSelect03($idTbCadastro, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "1", "", ",", "", "1");

$configCadastroFormularioCampos = Formularios::CadastroFormulariosCampos($idTipoCadastro);
$arrCadastroFormularioCampos = explode(",", $configCadastroFormularioCampos);
$configCadastroCamposObrigatorios = $GLOBALS['configCadastroCamposObrigatorios'];
$arrConfigCadastroCamposObrigatorios = explode(",", $configCadastroCamposObrigatorios);

$idTbCadastroUsuario = $_GET["idTbCadastroUsuario"];
if($idTbCadastroUsuario == "")
{
	$idTbCadastroUsuario = 0;
}

$paginaRetorno = $_GET["paginaRetorno"];
if($paginaRetorno == "")
{
	$paginaRetorno = "SiteAdmCadastroIndice.php"; //alterar para SiteAdm.php (e incluir no cadastro indice o retorno de página
}
$paginaRetornoExclusao = "SiteAdmCadastroEditar.php";
$variavelRetorno = "idTbCadastro";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];


//Montagem de query padrão de retorno.
$queryPadrao = "&idParentCadastro=" . $idParentCadastro . 
"&idTbCadastroUsuario=" . $idTbCadastroUsuario . 
"&paginaRetorno=" . $paginaRetorno . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&variavelRetorno=" . $variavelRetorno;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Query de pesquisa.
//----------
$strSqlCadastroDetalhesSelect = "";
$strSqlCadastroDetalhesSelect .= "SELECT ";
$strSqlCadastroDetalhesSelect .= "id, ";
$strSqlCadastroDetalhesSelect .= "id_tb_categorias, ";
//$strSqlCadastroDetalhesSelect .= "id_parent_cadastro, ";
$strSqlCadastroDetalhesSelect .= "data_cadastro, ";
$strSqlCadastroDetalhesSelect .= "pf_pj, ";
$strSqlCadastroDetalhesSelect .= "nome, ";
$strSqlCadastroDetalhesSelect .= "sexo, ";
$strSqlCadastroDetalhesSelect .= "altura, ";
$strSqlCadastroDetalhesSelect .= "peso, ";
$strSqlCadastroDetalhesSelect .= "razao_social, ";
$strSqlCadastroDetalhesSelect .= "nome_fantasia, ";

$strSqlCadastroDetalhesSelect .= "data_nascimento, ";
$strSqlCadastroDetalhesSelect .= "data1, ";
$strSqlCadastroDetalhesSelect .= "data2, ";
$strSqlCadastroDetalhesSelect .= "data3, ";
$strSqlCadastroDetalhesSelect .= "data4, ";
$strSqlCadastroDetalhesSelect .= "data5, ";
$strSqlCadastroDetalhesSelect .= "data6, ";
$strSqlCadastroDetalhesSelect .= "data7, ";
$strSqlCadastroDetalhesSelect .= "data8, ";
$strSqlCadastroDetalhesSelect .= "data9, ";
$strSqlCadastroDetalhesSelect .= "data10, ";

$strSqlCadastroDetalhesSelect .= "cpf_, ";
$strSqlCadastroDetalhesSelect .= "rg_, ";
$strSqlCadastroDetalhesSelect .= "cnpj_, ";
$strSqlCadastroDetalhesSelect .= "documento, ";
$strSqlCadastroDetalhesSelect .= "i_municipal, ";
$strSqlCadastroDetalhesSelect .= "i_estadual, ";

$strSqlCadastroDetalhesSelect .= "endereco_principal, ";
$strSqlCadastroDetalhesSelect .= "endereco_numero_principal, ";
$strSqlCadastroDetalhesSelect .= "endereco_complemento_principal, ";
$strSqlCadastroDetalhesSelect .= "bairro_principal, ";
$strSqlCadastroDetalhesSelect .= "cidade_principal, ";
$strSqlCadastroDetalhesSelect .= "estado_principal, ";
$strSqlCadastroDetalhesSelect .= "pais_principal, ";
$strSqlCadastroDetalhesSelect .= "cep_principal, ";

$strSqlCadastroDetalhesSelect .= "ponto_referencia, ";
$strSqlCadastroDetalhesSelect .= "email_principal, ";
$strSqlCadastroDetalhesSelect .= "tel_ddd_principal, ";
$strSqlCadastroDetalhesSelect .= "tel_principal, ";
$strSqlCadastroDetalhesSelect .= "cel_ddd_principal, ";
$strSqlCadastroDetalhesSelect .= "cel_principal, ";
$strSqlCadastroDetalhesSelect .= "fax_ddd_principal, ";
$strSqlCadastroDetalhesSelect .= "fax_principal, ";
$strSqlCadastroDetalhesSelect .= "site_principal, ";
$strSqlCadastroDetalhesSelect .= "n_funcionarios, ";
$strSqlCadastroDetalhesSelect .= "obs_interno, ";
$strSqlCadastroDetalhesSelect .= "id_tb_cadastro_status, ";
//$strSqlCadastroDetalhesSelect .= "id_tb_cadastro, ";
$strSqlCadastroDetalhesSelect .= "id_tb_cadastro1, ";
$strSqlCadastroDetalhesSelect .= "id_tb_cadastro2, ";
$strSqlCadastroDetalhesSelect .= "id_tb_cadastro3, ";
$strSqlCadastroDetalhesSelect .= "ativacao, ";
$strSqlCadastroDetalhesSelect .= "ativacao_destaque, ";
$strSqlCadastroDetalhesSelect .= "ativacao_mala_direta, ";
$strSqlCadastroDetalhesSelect .= "usuario, ";
$strSqlCadastroDetalhesSelect .= "senha, ";

$strSqlCadastroDetalhesSelect .= "imagem, ";
$strSqlCadastroDetalhesSelect .= "logo, ";
$strSqlCadastroDetalhesSelect .= "banner, ";
$strSqlCadastroDetalhesSelect .= "mapa, ";

$strSqlCadastroDetalhesSelect .= "mapa_online, ";
$strSqlCadastroDetalhesSelect .= "palavras_chave, ";
$strSqlCadastroDetalhesSelect .= "apresentacao, ";
$strSqlCadastroDetalhesSelect .= "servicos, ";
$strSqlCadastroDetalhesSelect .= "promocoes, ";
$strSqlCadastroDetalhesSelect .= "condicoes_comerciais, ";
$strSqlCadastroDetalhesSelect .= "formas_pagamento, ";
$strSqlCadastroDetalhesSelect .= "horario_atendimento, ";

$strSqlCadastroDetalhesSelect .= "situacao_atual, ";

$strSqlCadastroDetalhesSelect .= "informacao_complementar1, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar2, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar3, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar4, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar5, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar6, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar7, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar8, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar9, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar10, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar11, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar12, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar13, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar14, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar15, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar16, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar17, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar18, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar19, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar20, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar21, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar22, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar23, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar24, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar25, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar26, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar27, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar28, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar29, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar30, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar31, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar32, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar33, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar34, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar35, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar36, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar37, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar38, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar39, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar40, ";

$strSqlCadastroDetalhesSelect .= "n_visitas ";
$strSqlCadastroDetalhesSelect .= "FROM tb_cadastro ";
$strSqlCadastroDetalhesSelect .= "WHERE id <> 0 ";
//$strSqlCadastroDetalhesSelect .= "AND id_tb_categorias = :id_tb_categorias ";
$strSqlCadastroDetalhesSelect .= "AND id = :id ";
//$strSqlCadastroDetalhesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";


$statementCadastroDetalhesSelect = $dbSistemaConPDO->prepare($strSqlCadastroDetalhesSelect);

if ($statementCadastroDetalhesSelect !== false)
{
	$statementCadastroDetalhesSelect->execute(array(
		"id" => $idTbCadastro
	));
}

//$resultadoCadastroDetalhes = $dbSistemaConPDO->query($strSqlCadastroDetalhesSelect);
$resultadoCadastroDetalhes = $statementCadastroDetalhesSelect->fetchAll();


if (empty($resultadoCadastroDetalhes))
{
	//echo "Nenhum registro encontrado";
}else{
	foreach($resultadoCadastroDetalhes as $linhaCadastroDetalhes)
	{
		//Definição das variáveis de detalhes.
		$tbCadastroId = $linhaCadastroDetalhes['id'];
		$tbCadastroIdTbCategorias = $linhaCadastroDetalhes['id_tb_categorias'];
		$tbCadastroDataCadastro = $linhaCadastroDetalhes['data_cadastro'];
		//$tbCadastroNClassificacao = $linhaCadastroDetalhes['n_classificacao'];
		$tbCadastroPfPj = $linhaCadastroDetalhes['pf_pj'];
		$tbCadastroNome = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['nome']);
		$tbCadastroSexo = $linhaCadastroDetalhes['sexo'];
		$tbCadastroAltura = $linhaCadastroDetalhes['altura'];
		$tbCadastroPeso = $linhaCadastroDetalhes['peso'];
		$tbCadastroRazaoSocial = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['razao_social']);
		$tbCadastroNomeFantasia = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['nome_fantasia']);
		
		//$tbCadastroDataNascimento = $linhaCadastroDetalhes['data_nascimento'];
		//if($GLOBALS['configSiteFormatoData'] == "1"){
			//$tbCadastroDataNascimento = date("d",strtotime($linhaCadastroDetalhes['data_nascimento'])) . "/" . date("m",strtotime($linhaCadastroDetalhes['data_nascimento'])) . "/" . date("y",strtotime($linhaCadastroDetalhes['data_nascimento']));
		//}
		//if($GLOBALS['configSiteFormatoData'] == "2"){
			//$tbCadastroDataNascimento = date("m",strtotime($linhaCadastroDetalhes['data_nascimento'])) . "/" . date("d",strtotime($linhaCadastroDetalhes['data_nascimento'])) . "/" . date("y",strtotime($linhaCadastroDetalhes['data_nascimento']));
		//}
		if($linhaCadastroDetalhes['data_nascimento'] == NULL)
		{
			$tbCadastroDataNascimento = "";
		}else{
			$tbCadastroDataNascimento = Funcoes::DataLeitura01($linhaCadastroDetalhes['data_nascimento'], $GLOBALS['configSiteFormatoData'], "1");
		}
		
		if($linhaCadastroDetalhes['data1'] == NULL)
		{
			$tbCadastroData1 = "";
		}else{
			$tbCadastroData1 = Funcoes::DataLeitura01($linhaCadastroDetalhes['data1'], $GLOBALS['configSistemaFormatoData'], "1");
		}
		if($linhaCadastroDetalhes['data2'] == NULL)
		{
			$tbCadastroData2 = "";
		}else{
			$tbCadastroData2 = Funcoes::DataLeitura01($linhaCadastroDetalhes['data2'], $GLOBALS['configSistemaFormatoData'], "1");
		}
		if($linhaCadastroDetalhes['data3'] == NULL)
		{
			$tbCadastroData3 = "";
		}else{
			$tbCadastroData3 = Funcoes::DataLeitura01($linhaCadastroDetalhes['data3'], $GLOBALS['configSistemaFormatoData'], "1");
		}
		if($linhaCadastroDetalhes['data4'] == NULL)
		{
			$tbCadastroData4 = "";
		}else{
			$tbCadastroData4 = Funcoes::DataLeitura01($linhaCadastroDetalhes['data4'], $GLOBALS['configSistemaFormatoData'], "1");
		}
		if($linhaCadastroDetalhes['data5'] == NULL)
		{
			$tbCadastroData5 = "";
		}else{
			$tbCadastroData5 = Funcoes::DataLeitura01($linhaCadastroDetalhes['data5'], $GLOBALS['configSistemaFormatoData'], "1");
		}
		if($linhaCadastroDetalhes['data6'] == NULL)
		{
			$tbCadastroData6 = "";
		}else{
			$tbCadastroData6 = Funcoes::DataLeitura01($linhaCadastroDetalhes['data6'], $GLOBALS['configSistemaFormatoData'], "1");
		}
		if($linhaCadastroDetalhes['data7'] == NULL)
		{
			$tbCadastroData7 = "";
		}else{
			$tbCadastroData7 = Funcoes::DataLeitura01($linhaCadastroDetalhes['data7'], $GLOBALS['configSistemaFormatoData'], "1");
		}
		if($linhaCadastroDetalhes['data8'] == NULL)
		{
			$tbCadastroData8 = "";
		}else{
			$tbCadastroData8 = Funcoes::DataLeitura01($linhaCadastroDetalhes['data8'], $GLOBALS['configSistemaFormatoData'], "1");
		}
		if($linhaCadastroDetalhes['data9'] == NULL)
		{
			$tbCadastroData9 = "";
		}else{
			$tbCadastroData9 = Funcoes::DataLeitura01($linhaCadastroDetalhes['data9'], $GLOBALS['configSistemaFormatoData'], "1");
		}
		if($linhaCadastroDetalhes['data10'] == NULL)
		{
			$tbCadastroData10 = "";
		}else{
			$tbCadastroData10 = Funcoes::DataLeitura01($linhaCadastroDetalhes['data10'], $GLOBALS['configSistemaFormatoData'], "1");
		}

		//$tbCadastroCPF = $linhaCadastroDetalhes['cpf_'];
		$tbCadastroCPF = Funcoes::FormatarCPFLer($linhaCadastroDetalhes['cpf_']);
		$tbCadastroRG = $linhaCadastroDetalhes['rg_'];
		//$tbCadastroCNPJ = $linhaCadastroDetalhes['cnpj_'];
		$tbCadastroCNPJ = Funcoes::FormatarCNPJLer($linhaCadastroDetalhes['cnpj_']);
		$tbCadastroDocumento = $linhaCadastroDetalhes['documento'];
		$tbCadastroIMunicipal = $linhaCadastroDetalhes['i_municipal'];
		$tbCadastroIEstadual = $linhaCadastroDetalhes['i_estadual'];
		$tbCadastroEnderecoPrincipal = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['endereco_principal']);
		$tbCadastroEnderecoNumeroPrincipal = $linhaCadastroDetalhes['endereco_numero_principal'];
		$tbCadastroEnderecoComplementoPrincipal = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['endereco_complemento_principal']);
		$tbCadastroBairroPrincipal = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['bairro_principal']);
		$tbCadastroCidadePrincipal = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['cidade_principal']);
		$tbCadastroEstadoPrincipal = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['estado_principal']);
		$tbCadastroPaisPrincipal = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['pais_principal']);
		//$tbCadastro = $linhaCadastroDetalhes['id_config_bairro'];
		//$tbCadastro = $linhaCadastroDetalhes['id_config_cidade'];
		//$tbCadastro = $linhaCadastroDetalhes['id_config_estado'];
		//$tbCadastro = $linhaCadastroDetalhes['id_config_regiao'];
		//$tbCadastro = $linhaCadastroDetalhes['id_config_pais'];
		$tbCadastroIdDBCepTblBairros = $linhaCadastroDetalhes['id_db_cep_tblBairros'];
		$tbCadastroIdDBCepTblCidades = $linhaCadastroDetalhes['id_db_cep_tblCidades'];
		$tbCadastroIdDBCepTblLogradouros = $linhaCadastroDetalhes['id_db_cep_tblLogradouros'];
		$tbCadastroIdDBCepTblUF = $linhaCadastroDetalhes['id_db_cep_tblUF'];
		
		//$tbCadastroCepPrincipal = $linhaCadastroDetalhes['cep_principal'];
		$tbCadastroCepPrincipal = Funcoes::FormatarCEPLer($linhaCadastroDetalhes['cep_principal']);

		$tbCadastroPontoReferencia = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['ponto_referencia']);
		$tbCadastroEmailPrincipal = $linhaCadastroDetalhes['email_principal'];
		$tbCadastroTelDDDPrincipal = $linhaCadastroDetalhes['tel_ddd_principal'];
		$tbCadastroTelPrincipal = $linhaCadastroDetalhes['tel_principal'];
		$tbCadastroCelDDDPrincipal = $linhaCadastroDetalhes['cel_ddd_principal'];
		$tbCadastroCelPrincipal = $linhaCadastroDetalhes['cel_principal'];
		$tbCadastroFaxDDDPrincipal = $linhaCadastroDetalhes['fax_ddd_principal'];
		$tbCadastroFaxPrincipal = $linhaCadastroDetalhes['fax_principal'];
		$tbCadastroSitePrincipal = $linhaCadastroDetalhes['site_principal'];
		$tbCadastroNFuncionarios = $linhaCadastroDetalhes['n_funcionarios'];
		$tbCadastroOBSInterno = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['obs_interno']);
		
		$tbCadastroIdTbCadastro1 = $linhaCadastroDetalhes['id_tb_cadastro1'];
		$tbCadastroIdTbCadastro2 = $linhaCadastroDetalhes['id_tb_cadastro2'];
		$tbCadastroIdTbCadastro3 = $linhaCadastroDetalhes['id_tb_cadastro3'];

		$tbCadastroIdTbCadastroStatus = $linhaCadastroDetalhes['id_tb_cadastro_status'];
		$tbCadastroIdTbCadastroStatus_print = DbFuncoes::GetCampoGenerico01($tbCadastroIdTbCadastroStatus, "tb_cadastro_complemento", "complemento");
		$tbCadastroIdTbCadastro1 = $linhaCadastroDetalhes['id_tb_cadastro1'];
		$tbCadastroIdTbCadastro2 = $linhaCadastroDetalhes['id_tb_cadastro2'];
		$tbCadastroIdTbCadastro3 = $linhaCadastroDetalhes['id_tb_cadastro3'];
		$tbCadastroAtivacao = $linhaCadastroDetalhes['ativacao'];
		$tbCadastroAtivacaoDestaque = $linhaCadastroDetalhes['ativacao_destaque'];
		$tbCadastroAtivacaoMalaDireta = $linhaCadastroDetalhes['ativacao_mala_direta'];
		$tbCadastroUsuario = $linhaCadastroDetalhes['usuario'];
		
		//$tbCadastroSenha = $linhaCadastroDetalhes['senha'];
		if($GLOBALS['configCadastroMetodoSenha'] == 2){
        	if($GLOBALS['configCadastroSenha'] == 1){
            	$tbCadastroSenha = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['senha'], 2), 2);
            }
        }
		
		$tbCadastroImagem = $linhaCadastroDetalhes['imagem'];
		$tbCadastroLogo = $linhaCadastroDetalhes['logo'];
		$tbCadastroBanner = $linhaCadastroDetalhes['banner'];
		$tbCadastroMapa = $linhaCadastroDetalhes['mapa'];
		$tbCadastroMapaOnline = $linhaCadastroDetalhes['mapa_online'];
		$tbCadastroPalavrasChave = $linhaCadastroDetalhes['palavras_chave'];
		$tbCadastroApresentacao = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['apresentacao']);
		$tbCadastroServicos = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['servicos']);
		$tbCadastroPromocoes = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['promocoes']);
		$tbCadastroCondicoesComerciais = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['condicoes_comerciais']);
		$tbCadastroFormasPagamento = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['formas_pagamento']);
		$tbCadastroHorarioAtendimento = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['horario_atendimento']);
		$tbCadastroSituacaoAtual = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['situacao_atual']);
		$tbCadastroIC1 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar1']);
		$tbCadastroIC2 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar2']);
		$tbCadastroIC3 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar3']);
		$tbCadastroIC4 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar4']);
		$tbCadastroIC5 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar5']);
		$tbCadastroIC6 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar6']);
		$tbCadastroIC7 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar7']);
		$tbCadastroIC8 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar8']);
		$tbCadastroIC9 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar9']);
		$tbCadastroIC10 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar10']);
		$tbCadastroIC11 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar11']);
		$tbCadastroIC12 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar12']);
		$tbCadastroIC13 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar13']);
		$tbCadastroIC14 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar14']);
		$tbCadastroIC15 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar15']);
		$tbCadastroIC16 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar16']);
		$tbCadastroIC17 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar17']);
		$tbCadastroIC18 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar18']);
		$tbCadastroIC19 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar19']);
		$tbCadastroIC20 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar20']);
		$tbCadastroIC21 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar21']);
		$tbCadastroIC22 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar22']);
		$tbCadastroIC23 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar23']);
		$tbCadastroIC24 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar24']);
		$tbCadastroIC25 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar25']);
		$tbCadastroIC26 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar26']);
		$tbCadastroIC27 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar27']);
		$tbCadastroIC28 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar28']);
		$tbCadastroIC29 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar29']);
		$tbCadastroIC30 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar30']);
		$tbCadastroIC31 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar31']);
		$tbCadastroIC32 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar32']);
		$tbCadastroIC33 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar33']);
		$tbCadastroIC34 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar34']);
		$tbCadastroIC35 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar35']);
		$tbCadastroIC36 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar36']);
		$tbCadastroIC37 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar37']);
		$tbCadastroIC38 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar38']);
		$tbCadastroIC39 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar39']);
		$tbCadastroIC40 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar40']);
		$tbCadastroNVisitas = $linhaCadastroDetalhes['n_visitas'];
		$tbCadastroOrigemCadastro = $linhaCadastroDetalhes['origem_cadastro'];
		//$tbCategoriasCategoria = Funcoes::ConteudoMascaraLeitura($linhaCategorias['categoria']);
		
		//Verificação de erro.
		//echo "tbCadastroId=" . $tbCadastroId . "<br>";
		//echo "id_parent=" . $linhaCategorias['id_parent'] . "<br>";
		//echo "categoria=" . Funcoes::ConteudoMascaraLeitura($linhaCategorias['categoria']) . "<br>";
		
		//echo "id=" . $tbCategoriasId . "<br>";
		//echo "id_parent=" . $tbCategoriasIdParent . "<br>";
		//echo "categoria=" . $tbCategoriasCategoria . "<br>";
		//echo "tbCadastroIC40=" . $tbCadastroIC40 . "<br>";
		//echo "linhaCadastroDetalhes['informacao_complementar40']=" . $linhaCadastroDetalhes['informacao_complementar40'] . "<br>";
		//echo "linhaCadastroDetalhes['data_nascimento']=" . $linhaCadastroDetalhes['data_nascimento'] . "<br>";
		//echo "tbCadastroPfPj=" . $tbCadastroPfPj . "<br>";
		//echo "linhaCadastroDetalhes['pf_pj']=" . $linhaCadastroDetalhes['pf_pj'] . "<br>";
		
		
	}
}


//Verificação de erro.
//echo "idTipoCadastro=" . $idTipoCadastro . "<br>";
//echo "configCadastroFormularioCampos=" . $configCadastroFormularioCampos . "<br>";
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloSite'], "IncludeConfig"); ?> - <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroTituloEditar"); ?>
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
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroTituloEditar"); ?>
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


	<?php //Opções gerais.?>
    <?php //----------------------?>
    <?php 
	//Definição de variáveis do include.
	$includeAdmOpcoes_tipoOpcoes = "1";
	$includeAdmOpcoes_configOpcoes = "";
	?>
    
    <?php include "IncludeAdmOpcoes.php";?>
    <?php //----------------------?>
    
    
    <br />
	<?php //Opções principais.?>
    <?php //----------------------?>
    <?php 
	//Definição de variáveis do include.
	$includeAdmOpcoes_tipoOpcoes = "2";
	$includeAdmOpcoes_configOpcoes = "";
	?>
    
    <?php include "IncludeAdmOpcoes.php";?>
    <?php //----------------------?>

    
    <br />
	<?php //Opções de informações complementares.?>
    <?php //----------------------?>
    <?php 
	//Definição de variáveis do include.
	$includeAdmOpcoes_tipoOpcoes = "ic1";
	$includeAdmOpcoes_configOpcoes = "";
	?>
    
    <?php include "IncludeAdmOpcoes.php";?>
    <?php //----------------------?>


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
            $('#formCadastroEditar').validate({ //Inicialização do plug-in.
            
            
                //Estilo da mensagem de erro.
                //----------------------
                errorClass: "AdmErro",
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
                    <?php if(in_array("data1", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    data1: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("data2", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    data2: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("data3", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    data3: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("data4", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    data4: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("data5", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    data5: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("data6", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    data6: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("data7", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    data7: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("data8", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    data8: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("data9", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    data9: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("data10", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    data10: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("nome", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    nome: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("altura", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    altura: {
                        required: true,
                        number: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("peso", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    peso: {
                        required: true,
                        number: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("razao_social", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    razao_social: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("nome_fantasia", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    nome_fantasia: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("data_nascimento", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    data_nascimento: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("cpf_", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    cpf_: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("rg_", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    rg_: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("cnpj_", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    cnpj_: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("documento", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    documento: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("i_municipal", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    i_municipal: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("i_estadual", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    i_estadual: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("endereco_principal", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    endereco_principal: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("endereco_numero_principal", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    endereco_numero_principal: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("endereco_complemento_principal", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    endereco_complemento_principal: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("bairro_principal", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    bairro_principal: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("cidade_principal", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    cidade_principal: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("estado_principal", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    estado_principal: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("pais_principal", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    pais_principal: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("cep_principal", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    cep_principal: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("ponto_referencia", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    ponto_referencia: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("tel_ddd_principal", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    tel_ddd_principal: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("tel_principal", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    tel_principal: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("cel_ddd_principal", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    cel_ddd_principal: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("cel_principal", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    cel_principal: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("fax_ddd_principal", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    fax_ddd_principal: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("fax_principal", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    fax_principal: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("site_principal", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    site_principal: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("obs_interno", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    obs_interno: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("usuario", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    usuario: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("senha", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    senha: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("imagem", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    ArquivoUpload1: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("mapa_online", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    mapa_online: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("palavras_chave", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    palavras_chave: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("apresentacao", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    apresentacao: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("servicos", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    servicos: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("promocoes", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    promocoes: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("condicoes_comerciais", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    condicoes_comerciais: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("formas_pagamento", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    formas_pagamento: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("horario_atendimento", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    horario_atendimento: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("situacao_atual", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    situacao_atual: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar1", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar1: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar2", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar2: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar3", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar3: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar4", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar4: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar5", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar5: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar6", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar6: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar7", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar7: {
                        required: true,
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar8", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar8: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar9", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar9: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar10", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar10: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar11", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar11: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar12", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar12: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar13", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar13: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar14", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar14: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar15", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar15: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar16", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar16: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar17", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar17: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar18", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar18: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar19", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar19: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar20", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar20: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar21", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar21: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar22", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar22: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar23", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar23: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar24", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar24: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar25", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar25: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar26", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar26: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar27", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar27: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar28", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar28: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar29", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar29: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar30", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar30: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar31", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar31: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar32", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar32: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar33", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar33: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar34", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar34: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar35", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar35: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar36", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar36: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar37", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar37: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar38", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar38: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar39", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar39: {
                        required: true
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar40", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar40: {
                        required: true
                    },
                    <?php } ?>
                    
                    email_principal: {
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
                    <?php if(in_array("data1", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    data1: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("data2", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    data2: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("data3", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    data3: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("data4", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    data4: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("data5", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    data5: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("data6", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    data6: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("data7", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    data7: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("data8", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    data8: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("data9", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    data9: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("data10", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    data10: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("nome", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    nome: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("altura", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    altura: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>",
                      number: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica1"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("peso", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    peso: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>",
                      number: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica1"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("razao_social", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    razao_social: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("nome_fantasia", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    nome_fantasia: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("data_nascimento", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    data_nascimento: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("cpf_", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    cpf_: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("rg_", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    rg_: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("cnpj_", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    cnpj_: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("documento", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    documento: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("i_municipal", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    i_municipal: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("i_estadual", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    i_estadual: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("endereco_principal", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    endereco_principal: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("endereco_numero_principal", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    endereco_numero_principal: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("endereco_complemento_principal", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    endereco_complemento_principal: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("bairro_principal", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    bairro_principal: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("cidade_principal", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    cidade_principal: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>

                    
                    <?php if(in_array("estado_principal", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    estado_principal: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("pais_principal", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    pais_principal: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("cep_principal", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    cep_principal: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("ponto_referencia", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    ponto_referencia: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("tel_ddd_principal", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    tel_ddd_principal: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("tel_principal", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    tel_principal: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("cel_ddd_principal", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    cel_ddd_principal: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("cel_principal", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    cel_principal: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("fax_ddd_principal", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    fax_ddd_principal: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("fax_principal", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    fax_principal: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("site_principal", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    site_principal: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("obs_interno", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    obs_interno: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("usuario", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    usuario: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("senha", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    senha: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("imagem", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    ArquivoUpload1: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("mapa_online", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    mapa_online: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("palavras_chave", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    palavras_chave: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("apresentacao", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    apresentacao: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("servicos", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    servicos: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("promocoes", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    promocoes: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("condicoes_comerciais", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    condicoes_comerciais: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("formas_pagamento", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    formas_pagamento: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("horario_atendimento", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    horario_atendimento: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("situacao_atual", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    situacao_atual: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar1", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar1: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar2", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar2: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar3", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar3: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar4", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar4: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar5", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar5: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar6", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar6: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar7", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar7: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar8", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar8: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar9", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar9: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar10", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar10: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar11", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar11: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar12", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar12: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar13", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar13: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar14", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar14: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar15", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar15: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar16", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar16: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar17", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar17: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar18", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar18: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar19", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar19: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar20", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar20: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>

                    <?php if(in_array("informacao_complementar21", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar21: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar22", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar22: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar23", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar23: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar24", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar24: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar25", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar25: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar26", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar26: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar27", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar27: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar28", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar28: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar29", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar29: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar30", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar30: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar31", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar31: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar32", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar32: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar33", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar33: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar34", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar34: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar35", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar35: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar36", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar36: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar37", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar37: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar38", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar38: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar39", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar39: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
                    <?php } ?>
                    
                    <?php if(in_array("informacao_complementar40", $arrConfigCadastroCamposObrigatorios) == true){ ?>
                    informacao_complementar40: {
                      required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>"
                    },
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
    <form name="formCadastroEditar" id="formCadastroEditar" action="SiteAdmCadastroEditarExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <table class="AdmTabelaCampos01">
            <tr>
                <td class="AdmTbFundoEscuro" colspan="4">
                    <div align="center" class="AdmTexto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroTbCadastroEditar"); ?>
                        </strong>
                    </div>
                </td>
            </tr>
            
            <?php if($GLOBALS['habilitarCadastroEdicaoCategorias'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemCategoriaVinculada"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div>
						<?php 
                            $arrCategoriasIdParent = DbFuncoes::CategoriasIdParentSelect("13");
                        ?>
                        <select name="id_tb_categorias" id="id_tb_categorias" class="AdmCampoDropDownMenu01">
                            <?php 
                            for($countArray = 0; $countArray < count($arrCategoriasIdParent); $countArray++)
                            {
                            ?>
                                <option value="<?php echo $arrCategoriasIdParent[$countArray][0];?>"<?php if(in_array($arrCategoriasIdParent[$countArray][0], $idParentCadastro)){ ?> selected="selected"<?php } ?>><?php echo $arrCategoriasIdParent[$countArray][1];?></option>
                            <?php 
                            }
                            ?>
                        </select>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroTipo'] == 1){ ?>
				<?php if(in_array("tipo", $arrCadastroFormularioCampos) == true){?>
				<tr>
					<td class="AdmTbFundoMedio TabelaColuna01">
						<div align="left" class="AdmTexto01">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroTipoCadastro"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro" colspan="3">
						<div align="left" class="AdmTexto01">
							<?php
								//Seleção de ids selecionados para o registro.
								$arrCadastroTipoSelecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "1", "", ",", "", "1"));
							?>
	
							<?php 
								$arrCadastroTipo = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 1);
							?>
							
							<?php 
							for($countArray = 0; $countArray < count($arrCadastroTipo); $countArray++)
							{
							?>
								<div>
									<input name="idsCadastroTipo[]" type="checkbox" value="<?php echo $arrCadastroTipo[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrCadastroTipo[$countArray][0], $arrCadastroTipoSelecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrCadastroTipo[$countArray][1];?>
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
					<td class="AdmTbFundoMedio TabelaColuna01">
						<div align="left" class="AdmTexto01">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroAtividades"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro" colspan="3">
						<div align="left" class="AdmTexto01">
							<?php
								//Seleção de ids selecionados para o registro.
								$arrCadastroAtividadesSelecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "2", "", ",", "", "1"));
							?>
							<?php 
								$arrCadastroAtividades = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 2);
							?>
							<select id="idsCadastroAtividades[]" name="idsCadastroAtividades[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
								<?php 
								for($countArray = 0; $countArray < count($arrCadastroAtividades); $countArray++)
								{
								?>
									<option value="<?php echo $arrCadastroAtividades[$countArray][0];?>"<?php if(in_array($arrCadastroAtividades[$countArray][0], $arrCadastroAtividadesSelecao)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroAtividades[$countArray][1];?></option>
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
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroNome"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" <?php if($GLOBALS['habilitarCadastroNClassificacao'] <> 1){ ?> colspan="3" <?php } ?>>
                    <div align="left">
                        <input type="text" name="nome" id="nome" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroNome;?>" />
                    </div>
                </td>
				<?php } ?>
                <?php if($GLOBALS['habilitarCadastroNClassificacao'] == 1){ ?>
                	<?php if(in_array("n_classificacao", $arrCadastroFormularioCampos) == true){?>
					<td class="AdmTbFundoMedio TabelaColuna01">
						<div align="left" class="AdmTexto01">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNClassificacao"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro TabelaColuna01">
						<div>
							<input type="text" name="n_classificacao" id="n_classificacao" class="AdmCampoNumerico01" maxlength="10" value="<?php echo $tbCadastroNClassificacao;?>" />
						</div>
					</td>
					<?php } ?>
                <?php } ?>
            </tr>
            
            <?php if($GLOBALS['habilitarCadastroSexo'] == 1 || $GLOBALS['habilitarCadastroPfPj'] == 1){ ?>
            <tr>
                <?php if($GLOBALS['habilitarCadastroSexo'] == 1){ ?>
					<?php if(in_array("sexo", $arrCadastroFormularioCampos) == true){?>
					<td class="AdmTbFundoMedio TabelaColuna01">
						<div align="left" class="AdmTexto01">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroSexo"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro"<?php if($GLOBALS['habilitarCadastroPfPj'] <> 1){ ?> colspan="3" <?php } ?>>
						<div align="left" class="AdmTexto01">
							<select name="sexo" id="sexo" class="AdmCampoDropDownMenu01">
								<option value="1"<?php if($tbCadastroSexo == "1"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroSexo1"); ?></option>
								<option value="2"<?php if($tbCadastroSexo == "2"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroSexo2"); ?></option>
							</select>
						</div>
					</td>
					<?php } ?>
                <?php } ?>

                <?php if($GLOBALS['habilitarCadastroPfPj'] == 1){ ?>
					<?php if(in_array("pf_pj", $arrCadastroFormularioCampos) == true){?>
					<td class="AdmTbFundoMedio TabelaColuna01">
						<div align="left" class="AdmTexto01">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroPfPj"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro TabelaColuna01"<?php if($GLOBALS['habilitarCadastroSexo'] <> 1){ ?> colspan="3"<?php } ?>>
						<div>
							<select name="pf_pj" id="pf_pj" class="AdmCampoDropDownMenu01">
								<option value="1"<?php if($tbCadastroPfPj == "1"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroPfPj1"); ?></option>
								<option value="2"<?php if($tbCadastroPfPj == "2"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroPfPj2"); ?></option>
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
					<td class="AdmTbFundoMedio TabelaColuna01">
						<div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico01Nome'], "IncludeConfig"); ?>: 
						</div>
					</td>
					<td class="AdmTbFundoClaro" colspan="3">
						<div class="AdmTexto01">
							<?php
								//Seleção de ids selecionados para o registro.
								//echo "FiltrosGenericosSelect03=" . FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "12", "", ",", "", "1") . "<br />";
								//echo "FiltrosGenericosSelect03=" . DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "12", "", ",", "", "1") . "<br />";
								//FiltrosGenericosSelect03($idRegistro, $srtTabela, $strCampo, $strCampoComplemento, $strTipoComplemento, $strMarcador, $strSeparador, $tabelaComplemento, $tipoRetorno)
								//FiltrosGenericosSelect03($idRegistro, $strTabela, $strCampo, $strCampoComplemento, $strTipoComplemento, $strMarcador, $strSeparador, $tabelaComplemento, $tipoRetorno)
								
								$arrCadastroFiltroGenerico01Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "12", "", ",", "", "1"));
								//echo "arrCadastroFiltroGenerico01Selecao=" . $arrCadastroFiltroGenerico01Selecao[0] . "<br />";
								//echo "in_array=" . in_array("03", $arrCadastroFiltroGenerico01Selecao) . "<br />";
							?>
						
							<?php 
								$arrCadastroFiltroGenerico01 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 12);
							?>
							
							<?php if($GLOBALS['configCadastroFiltroGenerico01CaixaSelecao'] == 1){ ?>
								<?php 
								for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico01); $countArray++)
								{
								?>
									<div>
										<input name="idsCadastroFiltroGenerico01[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico01[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrCadastroFiltroGenerico01[$countArray][0], $arrCadastroFiltroGenerico01Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrCadastroFiltroGenerico01[$countArray][1];?>
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
										<option value="<?php echo $arrCadastroFiltroGenerico01[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico01[$countArray][0], $arrCadastroFiltroGenerico01Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico01[$countArray][1];?></option>
									<?php 
									}
									?>
								</select> 
								<br />
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
							<?php } ?>
							<?php if($GLOBALS['configCadastroFiltroGenerico01CaixaSelecao'] == 3){ ?>
								<select id="idsCadastroFiltroGenerico01[]" name="idsCadastroFiltroGenerico01[]" class="AdmCampoDropDownMenu01">
									<option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
									<?php 
									for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico01); $countArray++)
									{
									?>
										<option value="<?php echo $arrCadastroFiltroGenerico01[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico01[$countArray][0], $arrCadastroFiltroGenerico01Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico01[$countArray][1];?></option>
									<?php 
									}
									?>
								</select>
							<?php } ?>
							
							<?php if(empty($arrCadastroFiltroGenerico01)){ ?>
								<a href="CadastroManutencao.php" class="Links01">
									<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
								</a>
							<?php } ?>
						</div>
					</td>
				</tr>
				<?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico02'] == 1){ ?>
            	<?php if(in_array("ids_cadastro_filtro_generico02", $arrCadastroFormularioCampos) == true){?>
				<tr>
					<td class="AdmTbFundoMedio TabelaColuna01">
						<div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico02Nome'], "IncludeConfig"); ?>: 
						</div>
					</td>
					<td class="AdmTbFundoClaro" colspan="3">
						<div class="AdmTexto01">
							<?php
								//Seleção de ids selecionados para o registro.
								$arrCadastroFiltroGenerico02Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "13", "", ",", "", "1"));
							?>
						
							<?php 
								$arrCadastroFiltroGenerico02 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 13);
							?>
							
							<?php if($GLOBALS['configCadastroFiltroGenerico02CaixaSelecao'] == 1){ ?>
								<?php 
								for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico02); $countArray++)
								{
								?>
									<div>
										<input name="idsCadastroFiltroGenerico02[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico02[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrCadastroFiltroGenerico02[$countArray][0], $arrCadastroFiltroGenerico02Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrCadastroFiltroGenerico02[$countArray][1];?>
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
										<option value="<?php echo $arrCadastroFiltroGenerico02[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico02[$countArray][0], $arrCadastroFiltroGenerico02Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico02[$countArray][1];?></option>
									<?php 
									}
									?>
								</select> 
								<br />
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
							<?php } ?>
							<?php if($GLOBALS['configCadastroFiltroGenerico02CaixaSelecao'] == 3){ ?>
								<select id="idsCadastroFiltroGenerico02[]" name="idsCadastroFiltroGenerico02[]" class="AdmCampoDropDownMenu01">
									<option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
									<?php 
									for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico02); $countArray++)
									{
									?>
										<option value="<?php echo $arrCadastroFiltroGenerico02[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico02[$countArray][0], $arrCadastroFiltroGenerico02Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico02[$countArray][1];?></option>
									<?php 
									}
									?>
								</select>
							<?php } ?>
							
							<?php if(empty($arrCadastroFiltroGenerico02)){ ?>
								<a href="CadastroManutencao.php" class="Links01">
									<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
								</a>
							<?php } ?>
						</div>
					</td>
				</tr>
				<?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico03'] == 1){ ?>
            	<?php if(in_array("ids_cadastro_filtro_generico03", $arrCadastroFormularioCampos) == true){?>
				<tr>
					<td class="AdmTbFundoMedio TabelaColuna01">
						<div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico03Nome'], "IncludeConfig"); ?>: 
						</div>
					</td>
					<td class="AdmTbFundoClaro" colspan="3">
						<div class="AdmTexto01">
							<?php
								//Seleção de ids selecionados para o registro.
								$arrCadastroFiltroGenerico03Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "14", "", ",", "", "1"));
							?>
	
							<?php 
								$arrCadastroFiltroGenerico03 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 14);
							?>
							
							<?php if($GLOBALS['configCadastroFiltroGenerico03CaixaSelecao'] == 1){ ?>
								<?php 
								for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico03); $countArray++)
								{
								?>
									<div>
										<input name="idsCadastroFiltroGenerico03[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico03[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrCadastroFiltroGenerico03[$countArray][0], $arrCadastroFiltroGenerico03Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrCadastroFiltroGenerico03[$countArray][1];?>
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
										<option value="<?php echo $arrCadastroFiltroGenerico03[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico03[$countArray][0], $arrCadastroFiltroGenerico03Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico03[$countArray][1];?></option>
									<?php 
									}
									?>
								</select> 
								<br />
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
							<?php } ?>
							<?php if($GLOBALS['configCadastroFiltroGenerico03CaixaSelecao'] == 3){ ?>
								<select id="idsCadastroFiltroGenerico03[]" name="idsCadastroFiltroGenerico03[]" class="AdmCampoDropDownMenu01">
									<option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
									<?php 
									for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico03); $countArray++)
									{
									?>
										<option value="<?php echo $arrCadastroFiltroGenerico03[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico03[$countArray][0], $arrCadastroFiltroGenerico03Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico03[$countArray][1];?></option>
									<?php 
									}
									?>
								</select>
							<?php } ?>
							
							<?php if(empty($arrCadastroFiltroGenerico03)){ ?>
								<a href="CadastroManutencao.php" class="Links01">
									<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
								</a>
							<?php } ?>
						</div>
					</td>
				</tr>
				<?php } ?>
            <?php } ?>

            <?php if($GLOBALS['habilitarCadastroFiltroGenerico04'] == 1){ ?>
            	<?php if(in_array("ids_cadastro_filtro_generico04", $arrCadastroFormularioCampos) == true){?>
				<tr>
					<td class="AdmTbFundoMedio TabelaColuna01">
						<div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico04Nome'], "IncludeConfig"); ?>: 
						</div>
					</td>
					<td class="AdmTbFundoClaro" colspan="3">
						<div class="AdmTexto01">
							<?php
								//Seleção de ids selecionados para o registro.
								$arrCadastroFiltroGenerico04Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "15", "", ",", "", "1"));
							?>
						
							<?php 
								$arrCadastroFiltroGenerico04 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 15);
							?>
							
							<?php if($GLOBALS['configCadastroFiltroGenerico04CaixaSelecao'] == 1){ ?>
								<?php 
								for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico04); $countArray++)
								{
								?>
									<div>
										<input name="idsCadastroFiltroGenerico04[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico04[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrCadastroFiltroGenerico04[$countArray][0], $arrCadastroFiltroGenerico04Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrCadastroFiltroGenerico04[$countArray][1];?>
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
										<option value="<?php echo $arrCadastroFiltroGenerico04[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico04[$countArray][0], $arrCadastroFiltroGenerico04Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico04[$countArray][1];?></option>
									<?php 
									}
									?>
								</select> 
								<br />
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
							<?php } ?>
							<?php if($GLOBALS['configCadastroFiltroGenerico04CaixaSelecao'] == 3){ ?>
								<select id="idsCadastroFiltroGenerico04[]" name="idsCadastroFiltroGenerico04[]" class="AdmCampoDropDownMenu01">
									<option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
									<?php 
									for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico04); $countArray++)
									{
									?>
										<option value="<?php echo $arrCadastroFiltroGenerico04[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico04[$countArray][0], $arrCadastroFiltroGenerico04Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico04[$countArray][1];?></option>
									<?php 
									}
									?>
								</select>
							<?php } ?>
							
							<?php if(empty($arrCadastroFiltroGenerico04)){ ?>
								<a href="CadastroManutencao.php" class="Links01">
									<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
								</a>
							<?php } ?>
						</div>
					</td>
				</tr>
				<?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico05'] == 1){ ?>
            	<?php if(in_array("ids_cadastro_filtro_generico05", $arrCadastroFormularioCampos) == true){?>
				<tr>
					<td class="AdmTbFundoMedio TabelaColuna01">
						<div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico05Nome'], "IncludeConfig"); ?>: 
						</div>
					</td>
					<td class="AdmTbFundoClaro" colspan="3">
						<div class="AdmTexto01">
							<?php
								//Seleção de ids selecionados para o registro.
								$arrCadastroFiltroGenerico05Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "16", "", ",", "", "1"));
							?>
						
							<?php 
								$arrCadastroFiltroGenerico05 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 16);
							?>
							
							<?php if($GLOBALS['configCadastroFiltroGenerico05CaixaSelecao'] == 1){ ?>
								<?php 
								for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico05); $countArray++)
								{
								?>
									<div>
										<input name="idsCadastroFiltroGenerico05[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico05[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrCadastroFiltroGenerico05[$countArray][0], $arrCadastroFiltroGenerico05Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrCadastroFiltroGenerico05[$countArray][1];?>
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
										<option value="<?php echo $arrCadastroFiltroGenerico05[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico05[$countArray][0], $arrCadastroFiltroGenerico05Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico05[$countArray][1];?></option>
									<?php 
									}
									?>
								</select> 
								<br />
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
							<?php } ?>
							<?php if($GLOBALS['configCadastroFiltroGenerico05CaixaSelecao'] == 3){ ?>
								<select id="idsCadastroFiltroGenerico05[]" name="idsCadastroFiltroGenerico05[]" class="AdmCampoDropDownMenu01">
									<option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
									<?php 
									for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico05); $countArray++)
									{
									?>
										<option value="<?php echo $arrCadastroFiltroGenerico05[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico05[$countArray][0], $arrCadastroFiltroGenerico05Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico05[$countArray][1];?></option>
									<?php 
									}
									?>
								</select>
							<?php } ?>
							
							<?php if(empty($arrCadastroFiltroGenerico05)){ ?>
								<a href="CadastroManutencao.php" class="Links01">
									<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
								</a>
							<?php } ?>
						</div>
					</td>
				</tr>
				<?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico06'] == 1){ ?>
            	<?php if(in_array("ids_cadastro_filtro_generico06", $arrCadastroFormularioCampos) == true){?>
				<tr>
					<td class="AdmTbFundoMedio TabelaColuna01">
						<div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico06Nome'], "IncludeConfig"); ?>: 
						</div>
					</td>
					<td class="AdmTbFundoClaro" colspan="3">
						<div class="AdmTexto01">
							<?php
								//Seleção de ids selecionados para o registro.
								$arrCadastroFiltroGenerico06Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "17", "", ",", "", "1"));
							?>
	
							<?php 
								$arrCadastroFiltroGenerico06 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 17);
							?>
							
							<?php if($GLOBALS['configCadastroFiltroGenerico06CaixaSelecao'] == 1){ ?>
								<?php 
								for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico06); $countArray++)
								{
								?>
									<div>
										<input name="idsCadastroFiltroGenerico06[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico06[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrCadastroFiltroGenerico06[$countArray][0], $arrCadastroFiltroGenerico06Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrCadastroFiltroGenerico06[$countArray][1];?>
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
										<option value="<?php echo $arrCadastroFiltroGenerico06[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico06[$countArray][0], $arrCadastroFiltroGenerico06Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico06[$countArray][1];?></option>
									<?php 
									}
									?>
								</select> 
								<br />
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
							<?php } ?>
							<?php if($GLOBALS['configCadastroFiltroGenerico06CaixaSelecao'] == 3){ ?>
								<select id="idsCadastroFiltroGenerico06[]" name="idsCadastroFiltroGenerico06[]" class="AdmCampoDropDownMenu01">
									<option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
									<?php 
									for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico06); $countArray++)
									{
									?>
										<option value="<?php echo $arrCadastroFiltroGenerico06[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico06[$countArray][0], $arrCadastroFiltroGenerico06Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico06[$countArray][1];?></option>
									<?php 
									}
									?>
								</select>
							<?php } ?>
							
							<?php if(empty($arrCadastroFiltroGenerico06)){ ?>
								<a href="CadastroManutencao.php" class="Links01">
									<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
								</a>
							<?php } ?>
						</div>
					</td>
				</tr>
				<?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico07'] == 1){ ?>
            	<?php if(in_array("ids_cadastro_filtro_generico07", $arrCadastroFormularioCampos) == true){?>
				<tr>
					<td class="AdmTbFundoMedio TabelaColuna01">
						<div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico07Nome'], "IncludeConfig"); ?>: 
						</div>
					</td>
					<td class="AdmTbFundoClaro" colspan="3">
						<div class="AdmTexto01">
							<?php
								//Seleção de ids selecionados para o registro.
								$arrCadastroFiltroGenerico07Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "18", "", ",", "", "1"));
							?>
						
							<?php 
								$arrCadastroFiltroGenerico07 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 18);
							?>
							
							<?php if($GLOBALS['configCadastroFiltroGenerico07CaixaSelecao'] == 1){ ?>
								<?php 
								for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico07); $countArray++)
								{
								?>
									<div>
										<input name="idsCadastroFiltroGenerico07[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico07[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrCadastroFiltroGenerico07[$countArray][0], $arrCadastroFiltroGenerico07Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrCadastroFiltroGenerico07[$countArray][1];?>
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
										<option value="<?php echo $arrCadastroFiltroGenerico07[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico07[$countArray][0], $arrCadastroFiltroGenerico07Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico07[$countArray][1];?></option>
									<?php 
									}
									?>
								</select> 
								<br />
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
							<?php } ?>
							<?php if($GLOBALS['configCadastroFiltroGenerico07CaixaSelecao'] == 3){ ?>
								<select id="idsCadastroFiltroGenerico07[]" name="idsCadastroFiltroGenerico07[]" class="AdmCampoDropDownMenu01">
									<option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
									<?php 
									for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico07); $countArray++)
									{
									?>
										<option value="<?php echo $arrCadastroFiltroGenerico07[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico07[$countArray][0], $arrCadastroFiltroGenerico07Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico07[$countArray][1];?></option>
									<?php 
									}
									?>
								</select>
							<?php } ?>
							
							<?php if(empty($arrCadastroFiltroGenerico07)){ ?>
								<a href="CadastroManutencao.php" class="Links01">
									<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
								</a>
							<?php } ?>
						</div>
					</td>
				</tr>
				<?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico08'] == 1){ ?>
            	<?php if(in_array("ids_cadastro_filtro_generico08", $arrCadastroFormularioCampos) == true){?>
				<tr>
					<td class="AdmTbFundoMedio TabelaColuna01">
						<div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico08Nome'], "IncludeConfig"); ?>: 
						</div>
					</td>
					<td class="AdmTbFundoClaro" colspan="3">
						<div class="AdmTexto01">
							<?php
								//Seleção de ids selecionados para o registro.
								$arrCadastroFiltroGenerico08Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "19", "", ",", "", "1"));
							?>
	
							<?php 
								$arrCadastroFiltroGenerico08 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 19);
							?>
							
							<?php if($GLOBALS['configCadastroFiltroGenerico08CaixaSelecao'] == 1){ ?>
								<?php 
								for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico08); $countArray++)
								{
								?>
									<div>
										<input name="idsCadastroFiltroGenerico08[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico08[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrCadastroFiltroGenerico08[$countArray][0], $arrCadastroFiltroGenerico08Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrCadastroFiltroGenerico08[$countArray][1];?>
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
										<option value="<?php echo $arrCadastroFiltroGenerico08[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico08[$countArray][0], $arrCadastroFiltroGenerico08Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico08[$countArray][1];?></option>
									<?php 
									}
									?>
								</select> 
								<br />
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
							<?php } ?>
							<?php if($GLOBALS['configCadastroFiltroGenerico08CaixaSelecao'] == 3){ ?>
								<select id="idsCadastroFiltroGenerico08[]" name="idsCadastroFiltroGenerico08[]" class="AdmCampoDropDownMenu01">
									<option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
									<?php 
									for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico08); $countArray++)
									{
									?>
										<option value="<?php echo $arrCadastroFiltroGenerico08[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico08[$countArray][0], $arrCadastroFiltroGenerico08Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico08[$countArray][1];?></option>
									<?php 
									}
									?>
								</select>
							<?php } ?>
							
							<?php if(empty($arrCadastroFiltroGenerico08)){ ?>
								<a href="CadastroManutencao.php" class="Links01">
									<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
								</a>
							<?php } ?>
						</div>
					</td>
				</tr>
				<?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico09'] == 1){ ?>
            	<?php if(in_array("ids_cadastro_filtro_generico09", $arrCadastroFormularioCampos) == true){?>
				<tr>
					<td class="AdmTbFundoMedio TabelaColuna01">
						<div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico09Nome'], "IncludeConfig"); ?>: 
						</div>
					</td>
					<td class="AdmTbFundoClaro" colspan="3">
						<div class="AdmTexto01">
							<?php
								//Seleção de ids selecionados para o registro.
								$arrCadastroFiltroGenerico09Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "20", "", ",", "", "1"));
							?>
	
							<?php 
								$arrCadastroFiltroGenerico09 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 20);
							?>
							
							<?php if($GLOBALS['configCadastroFiltroGenerico09CaixaSelecao'] == 1){ ?>
								<?php 
								for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico09); $countArray++)
								{
								?>
									<div>
										<input name="idsCadastroFiltroGenerico09[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico09[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrCadastroFiltroGenerico09[$countArray][0], $arrCadastroFiltroGenerico09Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrCadastroFiltroGenerico09[$countArray][1];?>
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
										<option value="<?php echo $arrCadastroFiltroGenerico09[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico09[$countArray][0], $arrCadastroFiltroGenerico09Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico09[$countArray][1];?></option>
									<?php 
									}
									?>
								</select> 
								<br />
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
							<?php } ?>
							<?php if($GLOBALS['configCadastroFiltroGenerico09CaixaSelecao'] == 3){ ?>
								<select id="idsCadastroFiltroGenerico09[]" name="idsCadastroFiltroGenerico09[]" class="AdmCampoDropDownMenu01">
									<option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
									<?php 
									for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico09); $countArray++)
									{
									?>
										<option value="<?php echo $arrCadastroFiltroGenerico09[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico09[$countArray][0], $arrCadastroFiltroGenerico09Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico09[$countArray][1];?></option>
									<?php 
									}
									?>
								</select>
							<?php } ?>
							
							<?php if(empty($arrCadastroFiltroGenerico09)){ ?>
								<a href="CadastroManutencao.php" class="Links01">
									<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
								</a>
							<?php } ?>
						</div>
					</td>
				</tr>
				<?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico10'] == 1){ ?>
            	<?php if(in_array("ids_cadastro_filtro_generico10", $arrCadastroFormularioCampos) == true){?>
				<tr>
					<td class="AdmTbFundoMedio TabelaColuna01">
						<div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico10Nome'], "IncludeConfig"); ?>: 
						</div>
					</td>
					<td class="AdmTbFundoClaro" colspan="3">
						<div class="AdmTexto01">
							<?php
								//Seleção de ids selecionados para o registro.
								$arrCadastroFiltroGenerico10Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "21", "", ",", "", "1"));
							?>
						
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
								<select id="idsCadastroFiltroGenerico10[]" name="idsCadastroFiltroGenerico10[]" class="AdmCampoDropDownMenu01">
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
							
							<?php if(empty($arrCadastroFiltroGenerico10)){ ?>
								<a href="CadastroManutencao.php" class="Links01">
									<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
								</a>
							<?php } ?>
						</div>
					</td>
				</tr>
				<?php } ?>
            <?php } ?>

            <?php if($GLOBALS['habilitarCadastroAlturaPeso'] == 1){ ?>
            <tr>
                <?php if(in_array("altura", $arrCadastroFormularioCampos) == true){?>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroAltura"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro">
                    <div align="left" class="AdmTexto01">
                        <input type="text" name="altura" id="altura" class="AdmCampoNumerico01" maxlength="10" value="<?php echo $tbCadastroAltura;?>" />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroAlturaMedida"); ?>
                    </div>
                </td>
				<?php } ?>
                <?php if(in_array("peso", $arrCadastroFormularioCampos) == true){?>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroPeso"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <input type="text" name="peso" id="peso" class="AdmCampoNumerico01" maxlength="10" value="<?php echo $tbCadastroPeso;?>" />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroPesoMedida"); ?>
                     </div>
                </td>
				<?php } ?>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroRazaoSocial'] == 1){ ?>
            	<?php if(in_array("razao_social", $arrCadastroFormularioCampos) == true){?>
				<tr>
					<td class="AdmTbFundoMedio TabelaColuna01">
						<div align="left" class="AdmTexto01">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroRazaoSocial"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro" colspan="3">
						<div align="left">
							<input type="text" name="razao_social" id="razao_social" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroRazaoSocial;?>" />
						</div>
					</td>
				</tr>
				<?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroNomeFantasia'] == 1){ ?>
            	<?php if(in_array("nome_fantasia", $arrCadastroFormularioCampos) == true){?>
				<tr>
					<td class="AdmTbFundoMedio TabelaColuna01">
						<div align="left" class="AdmTexto01">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroNomeFantasia"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro" colspan="3">
						<div align="left">
							<input type="text" name="nome_fantasia" id="nome_fantasia" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroNomeFantasia;?>" />
						</div>
					</td>
				</tr>
				<?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroDataNascimento'] == 1){ ?>
				<?php if(in_array("data_nascimento", $arrCadastroFormularioCampos) == true){?>
				<tr>
					<td class="AdmTbFundoMedio TabelaColuna01">
						<div align="left" class="AdmTexto01">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroDataNascimento"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro" colspan="3">
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
							
								<input type="text" name="data_nascimento" id="data_nascimento" class="AdmCampoData01" maxlength="10" value="<?php echo $tbCadastroDataNascimento;?>" />
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
					<td class="AdmTbFundoMedio TabelaColuna01">
						<div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData1'], "IncludeConfig"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro" colspan="3">
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
								
									<input type="text" name="data1" id="data1" class="AdmCampoData01" maxlength="10" value="<?php echo $tbCadastroData1;?>" />
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
					<td class="AdmTbFundoMedio TabelaColuna01">
						<div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData2'], "IncludeConfig"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro" colspan="3">
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
								
									<input type="text" name="data2" id="data2" class="AdmCampoData01" maxlength="10" value="<?php echo $tbCadastroData2;?>" />
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
					<td class="AdmTbFundoMedio TabelaColuna01">
						<div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData3'], "IncludeConfig"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro" colspan="3">
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
								
									<input type="text" name="data3" id="data3" class="AdmCampoData01" maxlength="10" value="<?php echo $tbCadastroData3;?>" />
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
					<td class="AdmTbFundoMedio TabelaColuna01">
						<div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData4'], "IncludeConfig"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro" colspan="3">
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
								
									<input type="text" name="data4" id="data4" class="AdmCampoData01" maxlength="10" value="<?php echo $tbCadastroData4;?>" />
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
					<td class="AdmTbFundoMedio TabelaColuna01">
						<div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData5'], "IncludeConfig"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro" colspan="3">
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
								
									<input type="text" name="data5" id="data5" class="AdmCampoData01" maxlength="10" value="<?php echo $tbCadastroData5;?>" />
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
					<td class="AdmTbFundoMedio TabelaColuna01">
						<div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData6'], "IncludeConfig"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro" colspan="3">
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
								
									<input type="text" name="data6" id="data6" class="AdmCampoData01" maxlength="10" value="<?php echo $tbCadastroData6;?>" />
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
					<td class="AdmTbFundoMedio TabelaColuna01">
						<div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData7'], "IncludeConfig"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro" colspan="3">
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
								
									<input type="text" name="data7" id="data7" class="AdmCampoData01" maxlength="10" value="<?php echo $tbCadastroData7;?>" />
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
					<td class="AdmTbFundoMedio TabelaColuna01">
						<div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData8'], "IncludeConfig"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro" colspan="3">
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
								
									<input type="text" name="data8" id="data8" class="AdmCampoData01" maxlength="10" value="<?php echo $tbCadastroData8;?>" />
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
					<td class="AdmTbFundoMedio TabelaColuna01">
						<div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData9'], "IncludeConfig"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro" colspan="3">
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
								
									<input type="text" name="data9" id="data9" class="AdmCampoData01" maxlength="10" value="<?php echo $tbCadastroData9;?>" />
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
					<td class="AdmTbFundoMedio TabelaColuna01">
						<div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData10'], "IncludeConfig"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro" colspan="3">
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
								
									<input type="text" name="data10" id="data10" class="AdmCampoData01" maxlength="10" value="<?php echo $tbCadastroData10;?>" />
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
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroCPF"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro">
                    <div align="left">
                        <input type="text" name="cpf_" id="cpf_" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroCPF;?>"<?php if($GLOBALS['configCadastroCPFMascara'] == "1") { ?> onkeypress="javascript:mascaraGenerica('###.###.###-##', this, 'formCadastroEditar', 'cpf_');"<?php } ?> />
                        <?php //alertas ?>
                    </div>
                </td>
				<?php } ?>
                <?php if(in_array("rg_", $arrCadastroFormularioCampos) == true){?>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroRG"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <input type="text" name="rg_" id="rg_" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroRG;?>" />
                    </div>
                </td>
				<?php } ?>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroCNPJ'] == 1){ ?>
            	<?php if(in_array("cnpj_", $arrCadastroFormularioCampos) == true){?>
				<tr>
					<td class="AdmTbFundoMedio TabelaColuna01">
						<div align="left" class="AdmTexto01">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroCNPJ"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro" colspan="3">
						<div align="left">
							<input type="text" name="cnpj_" id="cnpj_" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroCNPJ;?>"<?php if($GLOBALS['configCadastroCNPJMascara'] == "1") { ?> onkeypress="javascript:mascaraGenerica('##.###.###/####-##', this, 'formCadastro', 'cnpj_');"<?php } ?> />
							<?php //alertas ?>
						</div>
					</td>
				</tr>
				<?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroDocumento'] == 1){ ?>
            	<?php if(in_array("documento", $arrCadastroFormularioCampos) == true){?>
				<tr>
					<td class="AdmTbFundoMedio TabelaColuna01">
						<div align="left" class="AdmTexto01">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroDocumento"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro" colspan="3">
						<div align="left">
							<input type="text" name="documento" id="documento" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroDocumento;?>" />
						</div>
					</td>
				</tr>
				<?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroIEstadualIMunicipal'] == 1){ ?>
            <tr>
				<?php if(in_array("i_municipal", $arrCadastroFormularioCampos) == true){?>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroInscricaoMunicipal"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro">
                    <div align="left">
                        <input type="text" name="i_municipal" id="i_municipal" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroIMunicipal;?>" />
                    </div>
                </td>
				<?php } ?>
				<?php if(in_array("i_estadual", $arrCadastroFormularioCampos) == true){?>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroInscricaoEstadual"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <input type="text" name="i_estadual" id="i_estadual" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroIEstadual;?>" />
                    </div>
                </td>
				<?php } ?>
            </tr>
            <?php } ?>
            
            
            <?php //Endereço. ?>
            <?php //---------------------- ?>
			<?php if(in_array("cep_principal", $arrCadastroFormularioCampos) == true){?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroCEPPrincipal"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left">
                        <input type="text" name="cep_principal" id="cep_principal" class="AdmCampoTexto03" maxlength="255" value="<?php echo $tbCadastroCepPrincipal;?>"<?php if($GLOBALS['configCadastroCEPMascara'] == "1") { ?> onkeypress="javascript:mascaraGenerica('##.###-###', this, 'formCadastroEditar', 'cep_principal');"<?php } ?> />
                        <?php //alertas ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
			<?php if(in_array("endereco_principal", $arrCadastroFormularioCampos) == true){?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroEnderecoPrincipal"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left">
                        <input type="text" name="endereco_principal" id="endereco_principal" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroEnderecoPrincipal;?>" />
                    </div>
                </td>
            </tr>
            <?php } ?>
			<?php if(in_array("endereco_numero_principal", $arrCadastroFormularioCampos) == true || in_array("endereco_complemento_principal", $arrCadastroFormularioCampos) == true){?>
            <tr>
                <?php if(in_array("endereco_numero_principal", $arrCadastroFormularioCampos) == true){?>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroEnderecoNumeroPrincipal"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro">
                    <div align="left">
                        <input type="text" name="endereco_numero_principal" id="endereco_numero_principal" class="AdmCampoTexto03" maxlength="255" value="<?php echo $tbCadastroEnderecoNumeroPrincipal;?>" />
                    </div>
                </td>
                <?php } ?>
                <?php if(in_array("endereco_complemento_principal", $arrCadastroFormularioCampos) == true){?>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroEnderecoComplementoPrincipal"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaColuna01">
                    <div align="left">
                        <input type="text" name="endereco_complemento_principal" id="endereco_complemento_principal" class="AdmCampoTexto03" maxlength="255" value="<?php echo $tbCadastroEnderecoComplementoPrincipal;?>" />
                    </div>
                </td>
                <?php } ?>
            </tr>
            <?php } ?>
            <?php if(in_array("bairro_principal", $arrCadastroFormularioCampos) == true || in_array("cidade_principal", $arrCadastroFormularioCampos) == true){?>
            <tr>
                <?php if(in_array("bairro_principal", $arrCadastroFormularioCampos) == true){?>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroBairroPrincipal"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro">
                    <div align="left">
                        <input type="text" name="bairro_principal" id="bairro_principal" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroBairroPrincipal;?>" />
                    </div>
                </td>
                <?php } ?>
                <?php if(in_array("cidade_principal", $arrCadastroFormularioCampos) == true){?>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroCidadePrincipal"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaColuna01">
                    <div align="left">
                        <input type="text" name="cidade_principal" id="cidade_principal" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroCidadePrincipal;?>" />
                    </div>
                </td>
                <?php } ?>
            </tr>
            <?php } ?>
            <?php if(in_array("estado_principal", $arrCadastroFormularioCampos) == true || in_array("pais_principal", $arrCadastroFormularioCampos) == true){?>
            <tr>
                <?php if(in_array("estado_principal", $arrCadastroFormularioCampos) == true){?>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroEstadoPrincipal"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro">
                    <div align="left">
                        <input type="text" name="estado_principal" id="estado_principal" class="AdmCampoTexto03" maxlength="255" value="<?php echo $tbCadastroEstadoPrincipal;?>" />
                    </div>
                </td>
                <?php } ?>
                <?php if(in_array("pais_principal", $arrCadastroFormularioCampos) == true){?>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroPaisPrincipal"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaColuna01">
                    <div align="left">
                        <input type="text" name="pais_principal" id="pais_principal" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroPaisPrincipal;?>" />
                    </div>
                </td>
                <?php } ?>
            </tr>
            <?php } ?>
            <?php //---------------------- ?>

            <?php if($GLOBALS['habilitarCadastroPontoReferencia'] == 1){ ?>
                <?php if(in_array("ponto_referencia", $arrCadastroFormularioCampos) == true){?>
				<tr>
					<td class="AdmTbFundoMedio TabelaColuna01">
						<div align="left" class="AdmTexto01">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroPontoReferencia"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro" colspan="3">
						<div align="left">
							<textarea name="ponto_referencia" id="ponto_referencia" class="AdmCampoTextoMultilinha01"><?php echo $tbCadastroPontoReferencia;?></textarea>
						</div>
					</td>
				</tr>
				<?php } ?>
            <?php } ?>
			
			<?php if(in_array("email_principal", $arrCadastroFormularioCampos) == true){?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroEmailPrincipal"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left">
                        <input type="text" name="email_principal" id="email_principal" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroEmailPrincipal;?>" />
                    </div>
                </td>
            </tr>
            <?php } ?>
			<?php if(in_array("tel_principal", $arrCadastroFormularioCampos) == true){?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroTel"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        (<input type="text" name="tel_ddd_principal" id="tel_ddd_principal" class="AdmCampoDDD01" maxlength="255" value="<?php echo $tbCadastroTelDDDPrincipal;?>" />)
                        <input type="text" name="tel_principal" id="tel_principal" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroTelPrincipal;?>" />
                    </div>
                </td>
            </tr>
            <?php } ?>
			<?php if(in_array("cel_principal", $arrCadastroFormularioCampos) == true){?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroCel"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        (<input type="text" name="cel_ddd_principal" id="cel_ddd_principal" class="AdmCampoDDD01" maxlength="255" value="<?php echo $tbCadastroCelDDDPrincipal;?>" />)
                        <input type="text" name="cel_principal" id="cel_principal" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroCelPrincipal;?>" />
                    </div>
                </td>
            </tr>
            <?php } ?>
			<?php if(in_array("fax_principal", $arrCadastroFormularioCampos) == true){?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroFax"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        (<input type="text" name="fax_ddd_principal" id="fax_ddd_principal" class="AdmCampoDDD01" maxlength="255" value="<?php echo $tbCadastroFaxDDDPrincipal;?>" />)
                        <input type="text" name="fax_principal" id="fax_principal" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroFaxPrincipal;?>" />
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarCadastroSite'] == 1){ ?>
				<?php if(in_array("site_principal", $arrCadastroFormularioCampos) == true){?>
				<tr>
					<td class="AdmTbFundoMedio TabelaColuna01">
						<div align="left" class="AdmTexto01">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroSitePrincipal"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro" colspan="3">
						<div align="left" class="AdmTexto01">
							<input type="text" name="site_principal" id="site_principal" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroSitePrincipal;?>" />
						</div>
					</td>
				</tr>
				<?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroNFuncionarios'] == 1){ ?>
				<?php if(in_array("n_funcionarios", $arrCadastroFormularioCampos) == true){?>
				<tr>
					<td class="AdmTbFundoMedio TabelaColuna01">
						<div align="left" class="AdmTexto01">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroNFuncionarios"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro" colspan="3">
						<div align="left">
							<input type="text" name="n_funcionarios" id="n_funcionarios" class="AdmCampoNumerico01" maxlength="255" value="<?php echo $tbCadastroNFuncionarios;?>" />
						</div>
					</td>
				</tr>
				<?php } ?>
            <?php } ?>
			
			<?php if(in_array("obs_interno", $arrCadastroFormularioCampos) == true){?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroObs"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left">
                        <textarea name="obs_interno" id="obs_interno" class="AdmCampoTextoMultilinha01"><?php echo $tbCadastroOBSInterno;?></textarea>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarCadastroVinculo1'] == 1){ ?>
				<?php if(in_array("id_tb_cadastro1", $arrCadastroFormularioCampos) == true){?>
				<tr>
					<td class="AdmTbFundoMedio TabelaColuna01">
						<div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroVinculo1Nome'], "IncludeConfig"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro" colspan="3">
						<div class="AdmTexto01">
							<?php 
								$arrCadastroVinculo1 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbCadastroVinculo1'], $GLOBALS['configIdTbTipoCadastroVinculo1'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoCadastroVinculo1'], $GLOBALS['configCadastroVinculo1Metodo']);
							?>
							<select name="id_tb_cadastro1" id="id_tb_cadastro1" class="AdmCampoDropDownMenu01">
								<option value="0"<?php if($tbCadastroIdTbCadastro1 == 0){ ?>selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option>
								<?php 
								for($countArray = 0; $countArray < count($arrCadastroVinculo1); $countArray++)
								{
								?>
									<option value="<?php echo $arrCadastroVinculo1[$countArray][0];?>"<?php if($arrCadastroVinculo1[$countArray][0] == $tbCadastroIdTbCadastro1){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroVinculo1[$countArray][1];?></option>
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
					<td class="AdmTbFundoMedio TabelaColuna01">
						<div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroVinculo2Nome'], "IncludeConfig"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro" colspan="3">
						<div class="AdmTexto01">
							<?php 
								$arrCadastroVinculo2 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbCadastroVinculo2'], $GLOBALS['configIdTbTipoCadastroVinculo2'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoCadastroVinculo2'], $GLOBALS['configCadastroVinculo2Metodo']);
							?>
							<select name="id_tb_cadastro2" id="id_tb_cadastro2" class="AdmCampoDropDownMenu01">
								<option value="0"<?php if($tbCadastroIdTbCadastro2 == 0){ ?>selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option>
								<?php 
								for($countArray = 0; $countArray < count($arrCadastroVinculo2); $countArray++)
								{
								?>
									<option value="<?php echo $arrCadastroVinculo2[$countArray][0];?>"<?php if($arrCadastroVinculo2[$countArray][0] == $tbCadastroIdTbCadastro2){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroVinculo2[$countArray][1];?></option>
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
					<td class="AdmTbFundoMedio TabelaColuna01">
						<div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroVinculo3Nome'], "IncludeConfig"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro" colspan="3">
						<div class="AdmTexto01">
							<?php 
								$arrCadastroVinculo3 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbCadastroVinculo3'], $GLOBALS['configIdTbTipoCadastroVinculo3'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoCadastroVinculo3'], $GLOBALS['configCadastroVinculo3Metodo']);
							?>
							<select name="id_tb_cadastro3" id="id_tb_cadastro3" class="AdmCampoDropDownMenu01">
								<option value="0"<?php if($tbCadastroIdTbCadastro3 == 0){ ?>selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option>
								<?php 
								for($countArray = 0; $countArray < count($arrCadastroVinculo3); $countArray++)
								{
								?>
									<option value="<?php echo $arrCadastroVinculo3[$countArray][0];?>"<?php if($arrCadastroVinculo3[$countArray][0] == $tbCadastroIdTbCadastro3){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroVinculo3[$countArray][1];?></option>
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
					<td class="AdmTbFundoMedio TabelaColuna01">
						<div align="left" class="AdmTexto01">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroStatus"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro" colspan="3">
						<div class="AdmTexto01">
							<?php 
								$arrCadastroStatus = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 3);
							?>
							<select name="id_tb_cadastro_status" id="id_tb_cadastro_status" class="AdmCampoDropDownMenu01">
								<option value="0"<?php if($tbCadastroIdTbCadastroStatus == "0"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
								<?php 
								for($countArray = 0; $countArray < count($arrCadastroStatus); $countArray++)
								{
								?>
									<option value="<?php echo $arrCadastroStatus[$countArray][0];?>"<?php if($tbCadastroIdTbCadastroStatus == $arrCadastroStatus[$countArray][0]){?> selected="true"<?php } ?>><?php echo $arrCadastroStatus[$countArray][1];?></option>
								<?php 
								}
								?>
							</select>
						</div>
					</td>
				</tr>
				<?php } ?>
            <?php } ?>
			
			<?php if(in_array("ativacao", $arrCadastroFormularioCampos) == true){?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao3"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <select name="ativacao" id="ativacao" class="AdmCampoDropDownMenu01">
                            <option value="0"<?php if($tbCadastroAtivacao == "0"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao4"); ?></option>
                            <option value="1"<?php if($tbCadastroAtivacao == "1"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao5"); ?></option>
                        </select>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarCadastroAtivacaoMalaDireta'] == 1){ ?>
				<?php if(in_array("ativacao_mala_direta", $arrCadastroFormularioCampos) == true){?>
				<tr>
					<td class="AdmTbFundoMedio TabelaColuna01">
						<div align="left" class="AdmTexto01">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroAtivacaoMalaDireta"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro" colspan="3">
						<div align="left" class="AdmTexto01">
							<select name="ativacao_mala_direta" id="ativacao_mala_direta" class="AdmCampoDropDownMenu01">
								<option value="0"<?php if($tbCadastroAtivacaoMalaDireta == "0"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao4"); ?></option>
								<option value="1"<?php if($tbCadastroAtivacaoMalaDireta == "1"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao5"); ?></option>
							</select>
						</div>
					</td>
				</tr>
				<?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroUsuario'] == 1){ ?>
				<?php if(in_array("usuario", $arrCadastroFormularioCampos) == true){?>
				<tr>
					<td class="AdmTbFundoMedio TabelaColuna01">
						<div align="left" class="AdmTexto01">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroUsuario"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro" colspan="3">
						<div align="left">
							<input type="text" name="usuario" id="usuario" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroUsuario;?>" />
						</div>
					</td>
				</tr>
				<?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroSenha'] == 1){ ?>
				<?php if(in_array("senha", $arrCadastroFormularioCampos) == true){?>
				<tr>
					<td class="AdmTbFundoMedio TabelaColuna01">
						<div align="left" class="AdmTexto01">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroSenha"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro" colspan="3">
						<div align="left">
							<?php if($GLOBALS['configCadastroMetodoSenha'] == 2){ ?>
								<?php if($GLOBALS['configCadastroSenha'] == 1){ ?>
									<?php //echo Crypto::DecryptValue(EncryptValue(Funcoes::ConteudoMascaraLeitura($linhaCadastro['senha']), 2), 2);?>
									<input type="password" name="senha" id="senha" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroSenha;?>" />
								<?php } ?>
							<?php } ?>
						</div>
					</td>
				</tr>
				<?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroImagem'] == 1){ ?>
				<?php if(in_array("imagem", $arrCadastroFormularioCampos) == true){?>
				<tr>
					<td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
						<div align="left" class="AdmTexto01">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemImagem"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
					<div>
						<table cellpadding="0" cellspacing="0" style="width: 100%;">
							<tr>
								<td width="1">
									<input type="file" name="ArquivoUpload1" id="ArquivoUpload1" class="AdmCampoArquivoUpload01" />
								</td>
								
								<?php if(!empty($tbCadastroImagem)){ //if($tbCategoriasImagem <> ""){?>
								<td width="1">
									<img src="../<?php echo $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos'];?>/t<?php echo $tbCadastroImagem; ?>?variavelCache=<?php echo date("s"); ?>" alt="<?php echo $tbCadastroImagem; ?>" style="margin-left: 4px;" />
								</td>
								<td>
									<a href="SiteAdmRegistrosArquivosExcluirExe.php?idRegistro=<?php echo $tbCadastroId;?>&strTabela=tb_cadastro&strCampo=imagem<?php echo $queryPadrao;?>" class="AdmLinksExcluir01" style="margin-left: 4px;">
										<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemImagemExcluir"); ?>
									</a>
								</td>
								<?php } ?>
								
							</tr>
						</table>
					</div>
					</td>
				</tr>
				<?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroMapaOnline'] == 1){ ?>
				<?php if(in_array("mapa_online", $arrCadastroFormularioCampos) == true){?>
				<tr>
					<td class="AdmTbFundoMedio TabelaColuna01">
						<div align="left" class="AdmTexto01">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroMapaOnline"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro" colspan="3">
						<div align="left" class="AdmTexto01">
							<textarea name="mapa_online" id="mapa_online" class="AdmCampoTextoMultilinha01"><?php echo $tbCadastroMapaOnline;?></textarea>
						</div>
					</td>
				</tr>
				<?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroPalavrasChave'] == 1){ ?>
				<?php if(in_array("palavras_chave", $arrCadastroFormularioCampos) == true){?>
				<tr>
					<td class="AdmTbFundoMedio TabelaColuna01">
						<div align="left" class="AdmTexto01">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPalavrasChave01"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro" colspan="3">
						<div align="left" class="AdmTexto01">
							<textarea name="palavras_chave" id="palavras_chave" class="AdmCampoTextoMultilinha01"><?php echo $tbCadastroPalavrasChave;?></textarea>
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
					<td class="AdmTbFundoMedio TabelaColuna01">
						<div align="left" class="AdmTexto01">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroApresentacao"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro" colspan="3">
						<div>
							<?php //Sem formatação.?>
							<?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
								<textarea name="apresentacao" id="apresentacao" class="AdmCampoTextoMultilinhaConteudo01"><?php echo $tbCadastroApresentacao;?></textarea>
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
								<textarea name="apresentacao" id="apresentacao"><?php echo $tbCadastroApresentacao;?></textarea>
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
								<textarea name="apresentacao" id="apresentacao"><?php echo $tbCadastroApresentacao;?></textarea>
							<?php } ?>
						</div>
					</td>
				</tr>
				<?php } ?>
            <?php } ?>
            <?php if($GLOBALS['habilitarCadastroServicos'] == 1){ ?>
				<?php if(in_array("servicos", $arrCadastroFormularioCampos) == true){?>
				<tr>
					<td class="AdmTbFundoMedio TabelaColuna01">
						<div align="left" class="AdmTexto01">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroServicos"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro" colspan="3">
						<div>
							<?php //Sem formatação.?>
							<?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
								<textarea name="servicos" id="servicos" class="AdmCampoTextoMultilinhaConteudo01"><?php echo $tbCadastroServicos;?></textarea>
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
								<textarea name="servicos" id="servicos"><?php echo $tbCadastroServicos;?></textarea>
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
								<textarea name="servicos" id="servicos"><?php echo $tbCadastroServicos;?></textarea>
							<?php } ?>
						</div>
					</td>
				</tr>
				<?php } ?>
            <?php } ?>
            <?php if($GLOBALS['HabilitarCadastroPromocoes'] == 1){ ?>
				<?php if(in_array("promocoes", $arrCadastroFormularioCampos) == true){?>
				<tr>
					<td class="AdmTbFundoMedio TabelaColuna01">
						<div align="left" class="AdmTexto01">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroPromocoes"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro" colspan="3">
						<div>
							<?php //Sem formatação.?>
							<?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
								<textarea name="promocoes" id="promocoes" class="AdmCampoTextoMultilinhaConteudo01"><?php echo $tbCadastroPromocoes;?></textarea>
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
								<textarea name="promocoes" id="promocoes"><?php echo $tbCadastroPromocoes;?></textarea>
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
								<textarea name="promocoes" id="promocoes"><?php echo $tbCadastroPromocoes;?></textarea>
							<?php } ?>
						</div>
					</td>
				</tr>
				<?php } ?>
            <?php } ?>
            <?php if($GLOBALS['habilitarCadastroCondicoesComerciais'] == 1){ ?>
				<?php if(in_array("condicoes_comerciais", $arrCadastroFormularioCampos) == true){?>
				<tr>
					<td class="AdmTbFundoMedio TabelaColuna01">
						<div align="left" class="AdmTexto01">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroCondicoesComerciais"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro" colspan="3">
						<div>
							<?php //Sem formatação.?>
							<?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
								<textarea name="condicoes_comerciais" id="condicoes_comerciais" class="AdmCampoTextoMultilinhaConteudo01"><?php echo $tbCadastroCondicoesComerciais;?></textarea>
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
								<textarea name="condicoes_comerciais" id="condicoes_comerciais"><?php echo $tbCadastroCondicoesComerciais;?></textarea>
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
								<textarea name="condicoes_comerciais" id="condicoes_comerciais"><?php echo $tbCadastroCondicoesComerciais;?></textarea>
							<?php } ?>
						</div>
					</td>
				</tr>
				<?php } ?>
            <?php } ?>
            <?php if($GLOBALS['habilitarCadastroFormasPagamento'] == 1){ ?>
				<?php if(in_array("formas_pagamento", $arrCadastroFormularioCampos) == true){?>
				<tr>
					<td class="AdmTbFundoMedio TabelaColuna01">
						<div align="left" class="AdmTexto01">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroFormasPagamento"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro" colspan="3">
						<div>
							<?php //Sem formatação.?>
							<?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
								<textarea name="formas_pagamento" id="formas_pagamento" class="AdmCampoTextoMultilinhaConteudo01"><?php echo $tbCadastroFormasPagamento;?></textarea>
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
								<textarea name="formas_pagamento" id="formas_pagamento"><?php echo $tbCadastroFormasPagamento;?></textarea>
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
								<textarea name="formas_pagamento" id="formas_pagamento"><?php echo $tbCadastroFormasPagamento;?></textarea>
							<?php } ?>
						</div>
					</td>
				</tr>
				<?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroHorarioAtendimento'] == 1){ ?>
				<?php if(in_array("horario_atendimento", $arrCadastroFormularioCampos) == true){?>
				<tr>
					<td class="AdmTbFundoMedio TabelaColuna01">
						<div align="left" class="AdmTexto01">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroHorarioAtendimento"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro" colspan="3">
						<div>
							<?php //Sem formatação.?>
							<?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
								<textarea name="horario_atendimento" id="horario_atendimento" class="AdmCampoTextoMultilinhaConteudo01"><?php echo $tbCadastroHorarioAtendimento;?></textarea>
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
								<textarea name="horario_atendimento" id="horario_atendimento"><?php echo $tbCadastroHorarioAtendimento;?></textarea>
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
								<textarea name="horario_atendimento" id="horario_atendimento"><?php echo $tbCadastroHorarioAtendimento;?></textarea>
							<?php } ?>
						</div>
					</td>
				</tr>
				<?php } ?>
            <?php } ?>
            <?php if($GLOBALS['habilitarCadastroSituacaoAtual'] == 1){ ?>
				<?php if(in_array("situacao_atual", $arrCadastroFormularioCampos) == true){?>
				<tr>
					<td class="AdmTbFundoMedio TabelaColuna01">
						<div align="left" class="AdmTexto01">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroSituacaoAtual"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro" colspan="3">
						<div>
							<?php //Sem formatação.?>
							<?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
								<textarea name="situacao_atual" id="situacao_atual" class="AdmCampoTextoMultilinhaConteudo01"><?php echo $tbCadastroSituacaoAtual;?></textarea>
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
								<textarea name="situacao_atual" id="situacao_atual"><?php echo $tbCadastroSituacaoAtual;?></textarea>
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
								<textarea name="situacao_atual" id="situacao_atual"><?php echo $tbCadastroSituacaoAtual;?></textarea>
							<?php } ?>
						</div>
					</td>
				</tr>
				<?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroIc1'] == 1){ ?>
				<?php if(in_array("informacao_complementar1", $arrCadastroFormularioCampos) == true){?>
				<tr>
					<td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
						<div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc1'], "IncludeConfig"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
						<div>
							<?php if($GLOBALS['configCadastroBoxIc1'] == 1){ ?>
								<input type="text" name="informacao_complementar1" id="informacao_complementar1" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroIC1;?>" />
							<?php } ?>
							<?php if($GLOBALS['configCadastroBoxIc1'] == 2){ ?>
								<?php //Sem formatação.?>
								<?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
									<textarea name="informacao_complementar1" id="informacao_complementar1" class="AdmCampoTextoMultilinha01"><?php echo $tbCadastroIC1;?></textarea>
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
									<textarea name="informacao_complementar1" id="informacao_complementar1"><?php echo $tbCadastroIC1;?></textarea>
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
									<textarea name="informacao_complementar1" id="informacao_complementar1"><?php echo $tbCadastroIC1;?></textarea>
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
					<td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
						<div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc2'], "IncludeConfig"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
						<div>
							<?php if($GLOBALS['configCadastroBoxIc2'] == 1){ ?>
								<input type="text" name="informacao_complementar2" id="informacao_complementar2" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroIC2;?>" />
							<?php } ?>
							<?php if($GLOBALS['configCadastroBoxIc2'] == 2){ ?>
								<?php //Sem formatação.?>
								<?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
									<textarea name="informacao_complementar2" id="informacao_complementar2" class="AdmCampoTextoMultilinha01"><?php echo $tbCadastroIC2;?></textarea>
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
									<textarea name="informacao_complementar2" id="informacao_complementar2"><?php echo $tbCadastroIC2;?></textarea>
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
									<textarea name="informacao_complementar2" id="informacao_complementar2"><?php echo $tbCadastroIC2;?></textarea>
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
					<td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
						<div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc3'], "IncludeConfig"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
						<div>
							<?php if($GLOBALS['configCadastroBoxIc3'] == 1){ ?>
								<input type="text" name="informacao_complementar3" id="informacao_complementar3" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroIC3;?>" />
							<?php } ?>
							<?php if($GLOBALS['configCadastroBoxIc3'] == 2){ ?>
								<?php //Sem formatação.?>
								<?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
									<textarea name="informacao_complementar3" id="informacao_complementar3" class="AdmCampoTextoMultilinha01"><?php echo $tbCadastroIC3;?></textarea>
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
									<textarea name="informacao_complementar3" id="informacao_complementar3"><?php echo $tbCadastroIC3;?></textarea>
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
									<textarea name="informacao_complementar3" id="informacao_complementar3"><?php echo $tbCadastroIC3;?></textarea>
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
					<td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
						<div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc4'], "IncludeConfig"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
						<div>
							<?php if($GLOBALS['configCadastroBoxIc4'] == 1){ ?>
								<input type="text" name="informacao_complementar4" id="informacao_complementar4" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroIC4;?>" />
							<?php } ?>
							<?php if($GLOBALS['configCadastroBoxIc4'] == 2){ ?>
								<?php //Sem formatação.?>
								<?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
									<textarea name="informacao_complementar4" id="informacao_complementar4" class="AdmCampoTextoMultilinha01"><?php echo $tbCadastroIC4;?></textarea>
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
									<textarea name="informacao_complementar4" id="informacao_complementar4"><?php echo $tbCadastroIC4;?></textarea>
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
									<textarea name="informacao_complementar4" id="informacao_complementar4"><?php echo $tbCadastroIC4;?></textarea>
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
					<td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
						<div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc5'], "IncludeConfig"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
						<div>
							<?php if($GLOBALS['configCadastroBoxIc5'] == 1){ ?>
								<input type="text" name="informacao_complementar5" id="informacao_complementar5" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroIC5;?>" />
							<?php } ?>
							<?php if($GLOBALS['configCadastroBoxIc5'] == 2){ ?>
								<?php //Sem formatação.?>
								<?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
									<textarea name="informacao_complementar5" id="informacao_complementar5" class="AdmCampoTextoMultilinha01"><?php echo $tbCadastroIC5;?></textarea>
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
									<textarea name="informacao_complementar5" id="informacao_complementar5"><?php echo $tbCadastroIC5;?></textarea>
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
									<textarea name="informacao_complementar5" id="informacao_complementar5"><?php echo $tbCadastroIC5;?></textarea>
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
					<td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
						<div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc6'], "IncludeConfig"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
						<div>
							<?php if($GLOBALS['configCadastroBoxIc6'] == 1){ ?>
								<input type="text" name="informacao_complementar6" id="informacao_complementar6" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroIC6;?>" />
							<?php } ?>
							<?php if($GLOBALS['configCadastroBoxIc6'] == 2){ ?>
								<?php //Sem formatação.?>
								<?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
									<textarea name="informacao_complementar6" id="informacao_complementar6" class="AdmCampoTextoMultilinha01"><?php echo $tbCadastroIC6;?></textarea>
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
									<textarea name="informacao_complementar6" id="informacao_complementar6"><?php echo $tbCadastroIC6;?></textarea>
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
									<textarea name="informacao_complementar6" id="informacao_complementar6"><?php echo $tbCadastroIC6;?></textarea>
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
					<td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
						<div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc7'], "IncludeConfig"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
						<div>
							<?php if($GLOBALS['configCadastroBoxIc7'] == 1){ ?>
								<input type="text" name="informacao_complementar7" id="informacao_complementar7" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroIC7;?>" />
							<?php } ?>
							<?php if($GLOBALS['configCadastroBoxIc7'] == 2){ ?>
								<?php //Sem formatação.?>
								<?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
									<textarea name="informacao_complementar7" id="informacao_complementar7" class="AdmCampoTextoMultilinha01"><?php echo $tbCadastroIC7;?></textarea>
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
									<textarea name="informacao_complementar7" id="informacao_complementar7"><?php echo $tbCadastroIC7;?></textarea>
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
									<textarea name="informacao_complementar7" id="informacao_complementar7"><?php echo $tbCadastroIC7;?></textarea>
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
					<td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
						<div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc8'], "IncludeConfig"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
						<div>
							<?php if($GLOBALS['configCadastroBoxIc8'] == 1){ ?>
								<input type="text" name="informacao_complementar8" id="informacao_complementar8" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroIC8;?>" />
							<?php } ?>
							<?php if($GLOBALS['configCadastroBoxIc8'] == 2){ ?>
								<?php //Sem formatação.?>
								<?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
									<textarea name="informacao_complementar8" id="informacao_complementar8" class="AdmCampoTextoMultilinha01"><?php echo $tbCadastroIC8;?></textarea>
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
									<textarea name="informacao_complementar8" id="informacao_complementar8"><?php echo $tbCadastroIC8;?></textarea>
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
									<textarea name="informacao_complementar8" id="informacao_complementar8"><?php echo $tbCadastroIC8;?></textarea>
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
					<td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
						<div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc9'], "IncludeConfig"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
						<div>
							<?php if($GLOBALS['configCadastroBoxIc9'] == 1){ ?>
								<input type="text" name="informacao_complementar9" id="informacao_complementar9" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroIC9;?>" />
							<?php } ?>
							<?php if($GLOBALS['configCadastroBoxIc9'] == 2){ ?>
								<?php //Sem formatação.?>
								<?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
									<textarea name="informacao_complementar9" id="informacao_complementar9" class="AdmCampoTextoMultilinha01"><?php echo $tbCadastroIC9;?></textarea>
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
									<textarea name="informacao_complementar9" id="informacao_complementar9"><?php echo $tbCadastroIC9;?></textarea>
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
									<textarea name="informacao_complementar9" id="informacao_complementar9"><?php echo $tbCadastroIC9;?></textarea>
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
					<td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
						<div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc10'], "IncludeConfig"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
						<div>
							<?php if($GLOBALS['configCadastroBoxIc10'] == 1){ ?>
								<input type="text" name="informacao_complementar10" id="informacao_complementar10" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroIC10;?>" />
							<?php } ?>
							<?php if($GLOBALS['configCadastroBoxIc10'] == 2){ ?>
								<?php //Sem formatação.?>
								<?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
									<textarea name="informacao_complementar10" id="informacao_complementar10" class="AdmCampoTextoMultilinha01"><?php echo $tbCadastroIC10;?></textarea>
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
									<textarea name="informacao_complementar10" id="informacao_complementar10"><?php echo $tbCadastroIC10;?></textarea>
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
									<textarea name="informacao_complementar10" id="informacao_complementar10"><?php echo $tbCadastroIC10;?></textarea>
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
					<td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
						<div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc11'], "IncludeConfig"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
						<div>
							<?php if($GLOBALS['configCadastroBoxIc11'] == 1){ ?>
								<input type="text" name="informacao_complementar11" id="informacao_complementar11" class="AdmCampoTexto02" maxlength="255"  value="<?php echo $tbCadastroIC11;?>"/>
							<?php } ?>
							<?php if($GLOBALS['configCadastroBoxIc11'] == 2){ ?>
								<?php //Sem formatação.?>
								<?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
									<textarea name="informacao_complementar11" id="informacao_complementar11" class="AdmCampoTextoMultilinha01"><?php echo $tbCadastroIC11;?></textarea>
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
									<textarea name="informacao_complementar11" id="informacao_complementar11"><?php echo $tbCadastroIC11;?></textarea>
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
									<textarea name="informacao_complementar11" id="informacao_complementar11"><?php echo $tbCadastroIC11;?></textarea>
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
					<td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
						<div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc12'], "IncludeConfig"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
						<div>
							<?php if($GLOBALS['configCadastroBoxIc12'] == 1){ ?>
								<input type="text" name="informacao_complementar12" id="informacao_complementar12" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroIC12;?>" />
							<?php } ?>
							<?php if($GLOBALS['configCadastroBoxIc12'] == 2){ ?>
								<?php //Sem formatação.?>
								<?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
									<textarea name="informacao_complementar12" id="informacao_complementar12" class="AdmCampoTextoMultilinha01"><?php echo $tbCadastroIC12;?></textarea>
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
									<textarea name="informacao_complementar12" id="informacao_complementar12"><?php echo $tbCadastroIC12;?></textarea>
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
									<textarea name="informacao_complementar12" id="informacao_complementar12"><?php echo $tbCadastroIC12;?></textarea>
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
					<td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
						<div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc13'], "IncludeConfig"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
						<div>
							<?php if($GLOBALS['configCadastroBoxIc13'] == 1){ ?>
								<input type="text" name="informacao_complementar13" id="informacao_complementar13" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroIC13;?>">
							<?php } ?>
							<?php if($GLOBALS['configCadastroBoxIc13'] == 2){ ?>
								<?php //Sem formatação.?>
								<?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
									<textarea name="informacao_complementar13" id="informacao_complementar13" class="AdmCampoTextoMultilinha01"><?php echo $tbCadastroIC13;?></textarea>
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
									<textarea name="informacao_complementar13" id="informacao_complementar13"><?php echo $tbCadastroIC13;?></textarea>
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
									<textarea name="informacao_complementar13" id="informacao_complementar13"><?php echo $tbCadastroIC13;?></textarea>
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
					<td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
						<div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc14'], "IncludeConfig"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
						<div>
							<?php if($GLOBALS['configCadastroBoxIc14'] == 1){ ?>
								<input type="text" name="informacao_complementar14" id="informacao_complementar14" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroIC14;?>" />
							<?php } ?>
							<?php if($GLOBALS['configCadastroBoxIc14'] == 2){ ?>
								<?php //Sem formatação.?>
								<?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
									<textarea name="informacao_complementar14" id="informacao_complementar14" class="AdmCampoTextoMultilinha01"><?php echo $tbCadastroIC14;?></textarea>
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
									<textarea name="informacao_complementar14" id="informacao_complementar14"><?php echo $tbCadastroIC14;?></textarea>
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
									<textarea name="informacao_complementar14" id="informacao_complementar14"><?php echo $tbCadastroIC14;?></textarea>
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
					<td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
						<div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc15'], "IncludeConfig"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
						<div>
							<?php if($GLOBALS['configCadastroBoxIc15'] == 1){ ?>
								<input type="text" name="informacao_complementar15" id="informacao_complementar15" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroIC15;?>" />
							<?php } ?>
							<?php if($GLOBALS['configCadastroBoxIc15'] == 2){ ?>
								<?php //Sem formatação.?>
								<?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
									<textarea name="informacao_complementar15" id="informacao_complementar15" class="AdmCampoTextoMultilinha01"><?php echo $tbCadastroIC15;?></textarea>
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
									<textarea name="informacao_complementar15" id="informacao_complementar15"><?php echo $tbCadastroIC15;?></textarea>
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
									<textarea name="informacao_complementar15" id="informacao_complementar15"><?php echo $tbCadastroIC15;?></textarea>
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
					<td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
						<div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc16'], "IncludeConfig"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
						<div>
							<?php if($GLOBALS['configCadastroBoxIc16'] == 1){ ?>
								<input type="text" name="informacao_complementar16" id="informacao_complementar16" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroIC16;?>" />
							<?php } ?>
							<?php if($GLOBALS['configCadastroBoxIc16'] == 2){ ?>
								<?php //Sem formatação.?>
								<?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
									<textarea name="informacao_complementar16" id="informacao_complementar16" class="AdmCampoTextoMultilinha01"><?php echo $tbCadastroIC16;?></textarea>
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
									<textarea name="informacao_complementar16" id="informacao_complementar16"><?php echo $tbCadastroIC16;?></textarea>
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
									<textarea name="informacao_complementar16" id="informacao_complementar16"><?php echo $tbCadastroIC16;?></textarea>
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
					<td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
						<div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc17'], "IncludeConfig"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
						<div>
							<?php if($GLOBALS['configCadastroBoxIc17'] == 1){ ?>
								<input type="text" name="informacao_complementar17" id="informacao_complementar17" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroIC17;?>" />
							<?php } ?>
							<?php if($GLOBALS['configCadastroBoxIc17'] == 2){ ?>
								<?php //Sem formatação.?>
								<?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
									<textarea name="informacao_complementar17" id="informacao_complementar17" class="AdmCampoTextoMultilinha01"><?php echo $tbCadastroIC17;?></textarea>
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
									<textarea name="informacao_complementar17" id="informacao_complementar17"><?php echo $tbCadastroIC17;?></textarea>
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
									<textarea name="informacao_complementar17" id="informacao_complementar17"><?php echo $tbCadastroIC17;?></textarea>
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
					<td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
						<div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc18'], "IncludeConfig"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
						<div>
							<?php if($GLOBALS['configCadastroBoxIc18'] == 1){ ?>
								<input type="text" name="informacao_complementar18" id="informacao_complementar18" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroIC18;?>" />
							<?php } ?>
							<?php if($GLOBALS['configCadastroBoxIc18'] == 2){ ?>
								<?php //Sem formatação.?>
								<?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
									<textarea name="informacao_complementar18" id="informacao_complementar18" class="AdmCampoTextoMultilinha01"><?php echo $tbCadastroIC18;?></textarea>
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
									<textarea name="informacao_complementar18" id="informacao_complementar18"><?php echo $tbCadastroIC18;?></textarea>
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
									<textarea name="informacao_complementar18" id="informacao_complementar18"><?php echo $tbCadastroIC18;?></textarea>
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
					<td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
						<div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc19'], "IncludeConfig"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
						<div>
							<?php if($GLOBALS['configCadastroBoxIc19'] == 1){ ?>
								<input type="text" name="informacao_complementar19" id="informacao_complementar19" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroIC19;?>" />
							<?php } ?>
							<?php if($GLOBALS['configCadastroBoxIc19'] == 2){ ?>
								<?php //Sem formatação.?>
								<?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
									<textarea name="informacao_complementar19" id="informacao_complementar19" class="AdmCampoTextoMultilinha01"><?php echo $tbCadastroIC19;?></textarea>
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
									<textarea name="informacao_complementar19" id="informacao_complementar19"><?php echo $tbCadastroIC19;?></textarea>
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
									<textarea name="informacao_complementar19" id="informacao_complementar19"><?php echo $tbCadastroIC19;?></textarea>
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
					<td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
						<div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc20'], "IncludeConfig"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
						<div>
							<?php if($GLOBALS['configCadastroBoxIc20'] == 1){ ?>
								<input type="text" name="informacao_complementar20" id="informacao_complementar20" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroIC20;?>" />
							<?php } ?>
							<?php if($GLOBALS['configCadastroBoxIc20'] == 2){ ?>
								<?php //Sem formatação.?>
								<?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
									<textarea name="informacao_complementar20" id="informacao_complementar20" class="AdmCampoTextoMultilinha01"><?php echo $tbCadastroIC20;?></textarea>
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
									<textarea name="informacao_complementar20" id="informacao_complementar20"><?php echo $tbCadastroIC20;?></textarea>
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
									<textarea name="informacao_complementar20" id="informacao_complementar20"><?php echo $tbCadastroIC20;?></textarea>
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
					<td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
						<div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc21'], "IncludeConfig"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
						<div>
							<?php if($GLOBALS['configCadastroBoxIc21'] == 1){ ?>
								<input type="text" name="informacao_complementar21" id="informacao_complementar21" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroIC21;?>" />
							<?php } ?>
							<?php if($GLOBALS['configCadastroBoxIc21'] == 2){ ?>
								<?php //Sem formatação.?>
								<?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
									<textarea name="informacao_complementar21" id="informacao_complementar21" class="AdmCampoTextoMultilinha01"><?php echo $tbCadastroIC21;?></textarea>
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
									<textarea name="informacao_complementar21" id="informacao_complementar21"><?php echo $tbCadastroIC21;?></textarea>
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
									<textarea name="informacao_complementar21" id="informacao_complementar21"><?php echo $tbCadastroIC21;?></textarea>
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
					<td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
						<div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc22'], "IncludeConfig"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
						<div>
							<?php if($GLOBALS['configCadastroBoxIc22'] == 1){ ?>
								<input type="text" name="informacao_complementar22" id="informacao_complementar22" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroIC22;?>" />
							<?php } ?>
							<?php if($GLOBALS['configCadastroBoxIc22'] == 2){ ?>
								<?php //Sem formatação.?>
								<?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
									<textarea name="informacao_complementar22" id="informacao_complementar22" class="AdmCampoTextoMultilinha01"><?php echo $tbCadastroIC22;?></textarea>
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
									<textarea name="informacao_complementar22" id="informacao_complementar22"><?php echo $tbCadastroIC22;?></textarea>
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
									<textarea name="informacao_complementar22" id="informacao_complementar22"><?php echo $tbCadastroIC22;?></textarea>
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
					<td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
						<div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc23'], "IncludeConfig"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
						<div>
							<?php if($GLOBALS['configCadastroBoxIc23'] == 1){ ?>
								<input type="text" name="informacao_complementar23" id="informacao_complementar23" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroIC23;?>" />
							<?php } ?>
							<?php if($GLOBALS['configCadastroBoxIc23'] == 2){ ?>
								<?php //Sem formatação.?>
								<?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
									<textarea name="informacao_complementar23" id="informacao_complementar23" class="AdmCampoTextoMultilinha01"><?php echo $tbCadastroIC23;?></textarea>
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
									<textarea name="informacao_complementar23" id="informacao_complementar23"><?php echo $tbCadastroIC23;?></textarea>
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
									<textarea name="informacao_complementar23" id="informacao_complementar23"><?php echo $tbCadastroIC23;?></textarea>
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
					<td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
						<div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc24'], "IncludeConfig"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
						<div>
							<?php if($GLOBALS['configCadastroBoxIc24'] == 1){ ?>
								<input type="text" name="informacao_complementar24" id="informacao_complementar24" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroIC24;?>" />
							<?php } ?>
							<?php if($GLOBALS['configCadastroBoxIc24'] == 2){ ?>
								<?php //Sem formatação.?>
								<?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
									<textarea name="informacao_complementar24" id="informacao_complementar24" class="AdmCampoTextoMultilinha01"><?php echo $tbCadastroIC24;?></textarea>
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
									<textarea name="informacao_complementar24" id="informacao_complementar24"><?php echo $tbCadastroIC24;?></textarea>
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
									<textarea name="informacao_complementar24" id="informacao_complementar24"><?php echo $tbCadastroIC24;?></textarea>
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
					<td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
						<div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc25'], "IncludeConfig"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
						<div>
							<?php if($GLOBALS['configCadastroBoxIc25'] == 1){ ?>
								<input type="text" name="informacao_complementar25" id="informacao_complementar25" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroIC25;?>" />
							<?php } ?>
							<?php if($GLOBALS['configCadastroBoxIc25'] == 2){ ?>
								<?php //Sem formatação.?>
								<?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
									<textarea name="informacao_complementar25" id="informacao_complementar25" class="AdmCampoTextoMultilinha01"><?php echo $tbCadastroIC25;?></textarea>
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
									<textarea name="informacao_complementar25" id="informacao_complementar25"><?php echo $tbCadastroIC25;?></textarea>
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
									<textarea name="informacao_complementar25" id="informacao_complementar25"><?php echo $tbCadastroIC25;?></textarea>
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
					<td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
						<div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc26']); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
						<div>
							<?php if($GLOBALS['configCadastroBoxIc26'] == 1){ ?>
								<input type="text" name="informacao_complementar26" id="informacao_complementar26" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroIC26;?>" />
							<?php } ?>
							<?php if($GLOBALS['configCadastroBoxIc26'] == 2){ ?>
								<?php //Sem formatação.?>
								<?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
									<textarea name="informacao_complementar26" id="informacao_complementar26" class="AdmCampoTextoMultilinha01"><?php echo $tbCadastroIC26;?></textarea>
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
									<textarea name="informacao_complementar26" id="informacao_complementar26"><?php echo $tbCadastroIC26;?></textarea>
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
									<textarea name="informacao_complementar26" id="informacao_complementar26"><?php echo $tbCadastroIC26;?></textarea>
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
					<td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
						<div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc27'], "IncludeConfig"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
						<div>
							<?php if($GLOBALS['configCadastroBoxIc27'] == 1){ ?>
								<input type="text" name="informacao_complementar27" id="informacao_complementar27" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroIC27;?>" />
							<?php } ?>
							<?php if($GLOBALS['configCadastroBoxIc27'] == 2){ ?>
								<?php //Sem formatação.?>
								<?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
									<textarea name="informacao_complementar27" id="informacao_complementar27" class="AdmCampoTextoMultilinha01"><?php echo $tbCadastroIC27;?></textarea>
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
									<textarea name="informacao_complementar27" id="informacao_complementar27"><?php echo $tbCadastroIC27;?></textarea>
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
									<textarea name="informacao_complementar27" id="informacao_complementar27"><?php echo $tbCadastroIC27;?></textarea>
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
					<td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
						<div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc28'], "IncludeConfig"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
						<div>
							<?php if($GLOBALS['configCadastroBoxIc28'] == 1){ ?>
								<input type="text" name="informacao_complementar28" id="informacao_complementar28" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroIC28;?>" />
							<?php } ?>
							<?php if($GLOBALS['configCadastroBoxIc28'] == 2){ ?>
								<?php //Sem formatação.?>
								<?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
									<textarea name="informacao_complementar28" id="informacao_complementar28" class="AdmCampoTextoMultilinha01"><?php echo $tbCadastroIC28;?></textarea>
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
									<textarea name="informacao_complementar28" id="informacao_complementar28"><?php echo $tbCadastroIC28;?></textarea>
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
									<textarea name="informacao_complementar28" id="informacao_complementar28"><?php echo $tbCadastroIC28;?></textarea>
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
					<td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
						<div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc29'], "IncludeConfig"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
						<div>
							<?php if($GLOBALS['configCadastroBoxIc29'] == 1){ ?>
								<input type="text" name="informacao_complementar29" id="informacao_complementar29" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroIC29;?>" />
							<?php } ?>
							<?php if($GLOBALS['configCadastroBoxIc29'] == 2){ ?>
								<?php //Sem formatação.?>
								<?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
									<textarea name="informacao_complementar29" id="informacao_complementar29" class="AdmCampoTextoMultilinha01"><?php echo $tbCadastroIC29;?></textarea>
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
									<textarea name="informacao_complementar29" id="informacao_complementar29"><?php echo $tbCadastroIC29;?></textarea>
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
									<textarea name="informacao_complementar29" id="informacao_complementar29"><?php echo $tbCadastroIC29;?></textarea>
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
					<td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
						<div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc30'], "IncludeConfig"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
						<div>
							<?php if($GLOBALS['configCadastroBoxIc30'] == 1){ ?>
								<input type="text" name="informacao_complementar30" id="informacao_complementar30" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroIC30;?>" />
							<?php } ?>
							<?php if($GLOBALS['configCadastroBoxIc30'] == 2){ ?>
								<?php //Sem formatação.?>
								<?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
									<textarea name="informacao_complementar30" id="informacao_complementar30" class="AdmCampoTextoMultilinha01"><?php echo $tbCadastroIC30;?></textarea>
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
									<textarea name="informacao_complementar30" id="informacao_complementar30"><?php echo $tbCadastroIC30;?></textarea>
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
									<textarea name="informacao_complementar30" id="informacao_complementar30"><?php echo $tbCadastroIC30;?></textarea>
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
					<td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
						<div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc31'], "IncludeConfig"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
						<div>
							<?php if($GLOBALS['configCadastroBoxIc31'] == 1){ ?>
								<input type="text" name="informacao_complementar31" id="informacao_complementar31" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroIC31;?>" />
							<?php } ?>
							<?php if($GLOBALS['configCadastroBoxIc31'] == 2){ ?>
								<?php //Sem formatação.?>
								<?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
									<textarea name="informacao_complementar31" id="informacao_complementar31" class="AdmCampoTextoMultilinha01"><?php echo $tbCadastroIC31;?></textarea>
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
									<textarea name="informacao_complementar31" id="informacao_complementar31"><?php echo $tbCadastroIC31;?></textarea>
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
									<textarea name="informacao_complementar31" id="informacao_complementar31"><?php echo $tbCadastroIC31;?></textarea>
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
					<td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
						<div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc32'], "IncludeConfig"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
						<div>
							<?php if($GLOBALS['configCadastroBoxIc32'] == 1){ ?>
								<input type="text" name="informacao_complementar32" id="informacao_complementar32" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroIC32;?>" />
							<?php } ?>
							<?php if($GLOBALS['configCadastroBoxIc32'] == 2){ ?>
								<?php //Sem formatação.?>
								<?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
									<textarea name="informacao_complementar32" id="informacao_complementar32" class="AdmCampoTextoMultilinha01"><?php echo $tbCadastroIC32;?></textarea>
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
									<textarea name="informacao_complementar32" id="informacao_complementar32"><?php echo $tbCadastroIC32;?></textarea>
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
									<textarea name="informacao_complementar32" id="informacao_complementar32"><?php echo $tbCadastroIC32;?></textarea>
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
					<td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
						<div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc33'], "IncludeConfig"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
						<div>
							<?php if($GLOBALS['configCadastroBoxIc33'] == 1){ ?>
								<input type="text" name="informacao_complementar33" id="informacao_complementar33" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroIC33;?>" />
							<?php } ?>
							<?php if($GLOBALS['configCadastroBoxIc33'] == 2){ ?>
								<?php //Sem formatação.?>
								<?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
									<textarea name="informacao_complementar33" id="informacao_complementar33" class="AdmCampoTextoMultilinha01"><?php echo $tbCadastroIC33;?></textarea>
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
									<textarea name="informacao_complementar33" id="informacao_complementar33"><?php echo $tbCadastroIC33;?></textarea>
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
									<textarea name="informacao_complementar33" id="informacao_complementar33"><?php echo $tbCadastroIC33;?></textarea>
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
					<td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
						<div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc34'], "IncludeConfig"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
						<div>
							<?php if($GLOBALS['configCadastroBoxIc34'] == 1){ ?>
								<input type="text" name="informacao_complementar34" id="informacao_complementar34" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroIC34;?>" />
							<?php } ?>
							<?php if($GLOBALS['configCadastroBoxIc34'] == 2){ ?>
								<?php //Sem formatação.?>
								<?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
									<textarea name="informacao_complementar34" id="informacao_complementar34" class="AdmCampoTextoMultilinha01"><?php echo $tbCadastroIC34;?></textarea>
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
									<textarea name="informacao_complementar34" id="informacao_complementar34"><?php echo $tbCadastroIC34;?></textarea>
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
									<textarea name="informacao_complementar34" id="informacao_complementar34"><?php echo $tbCadastroIC34;?></textarea>
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
					<td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
						<div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc35'], "IncludeConfig"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
						<div>
							<?php if($GLOBALS['configCadastroBoxIc35'] == 1){ ?>
								<input type="text" name="informacao_complementar35" id="informacao_complementar35" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroIC35;?>" />
							<?php } ?>
							<?php if($GLOBALS['configCadastroBoxIc35'] == 2){ ?>
								<?php //Sem formatação.?>
								<?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
									<textarea name="informacao_complementar35" id="informacao_complementar35" class="AdmCampoTextoMultilinha01"><?php echo $tbCadastroIC35;?></textarea>
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
									<textarea name="informacao_complementar35" id="informacao_complementar35"><?php echo $tbCadastroIC35;?></textarea>
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
									<textarea name="informacao_complementar35" id="informacao_complementar35"><?php echo $tbCadastroIC35;?></textarea>
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
					<td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
						<div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc36'], "IncludeConfig"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
						<div>
							<?php if($GLOBALS['configCadastroBoxIc36'] == 1){ ?>
								<input type="text" name="informacao_complementar36" id="informacao_complementar36" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroIC36;?>" />
							<?php } ?>
							<?php if($GLOBALS['configCadastroBoxIc36'] == 2){ ?>
								<?php //Sem formatação.?>
								<?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
									<textarea name="informacao_complementar36" id="informacao_complementar36" class="AdmCampoTextoMultilinha01"><?php echo $tbCadastroIC36;?></textarea>
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
									<textarea name="informacao_complementar36" id="informacao_complementar36"><?php echo $tbCadastroIC36;?></textarea>
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
									<textarea name="informacao_complementar36" id="informacao_complementar36"><?php echo $tbCadastroIC36;?></textarea>
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
					<td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
						<div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc37'], "IncludeConfig"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
						<div>
							<?php if($GLOBALS['configCadastroBoxIc37'] == 1){ ?>
								<input type="text" name="informacao_complementar37" id="informacao_complementar37" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroIC37;?>" />
							<?php } ?>
							<?php if($GLOBALS['configCadastroBoxIc37'] == 2){ ?>
								<?php //Sem formatação.?>
								<?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
									<textarea name="informacao_complementar37" id="informacao_complementar37" class="AdmCampoTextoMultilinha01"><?php echo $tbCadastroIC37;?></textarea>
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
									<textarea name="informacao_complementar37" id="informacao_complementar37"><?php echo $tbCadastroIC37;?></textarea>
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
									<textarea name="informacao_complementar37" id="informacao_complementar37"><?php echo $tbCadastroIC37;?></textarea>
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
					<td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
						<div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc38'], "IncludeConfig"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
						<div>
							<?php if($GLOBALS['configCadastroBoxIc38'] == 1){ ?>
								<input type="text" name="informacao_complementar38" id="informacao_complementar38" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroIC38;?>" />
							<?php } ?>
							<?php if($GLOBALS['configCadastroBoxIc38'] == 2){ ?>
								<?php //Sem formatação.?>
								<?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
									<textarea name="informacao_complementar38" id="informacao_complementar38" class="AdmCampoTextoMultilinha01"><?php echo $tbCadastroIC38;?></textarea>
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
									<textarea name="informacao_complementar38" id="informacao_complementar38"><?php echo $tbCadastroIC38;?></textarea>
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
									<textarea name="informacao_complementar38" id="informacao_complementar38"><?php echo $tbCadastroIC38;?></textarea>
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
					<td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
						<div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc39'], "IncludeConfig"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
						<div>
							<?php if($GLOBALS['configCadastroBoxIc39'] == 1){ ?>
								<input type="text" name="informacao_complementar39" id="informacao_complementar39" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroIC39;?>" />
							<?php } ?>
							<?php if($GLOBALS['configCadastroBoxIc39'] == 2){ ?>
								<?php //Sem formatação.?>
								<?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
									<textarea name="informacao_complementar39" id="informacao_complementar39" class="AdmCampoTextoMultilinha01"><?php echo $tbCadastroIC39;?></textarea>
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
									<textarea name="informacao_complementar39" id="informacao_complementar39"><?php echo $tbCadastroIC39;?></textarea>
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
									<textarea name="informacao_complementar39" id="informacao_complementar39"><?php echo $tbCadastroIC39;?></textarea>
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
					<td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
						<div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc40'], "IncludeConfig"); ?>:
						</div>
					</td>
					<td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
						<div>
							<?php if($GLOBALS['configCadastroBoxIc40'] == 1){ ?>
								<input type="text" name="informacao_complementar40" id="informacao_complementar40" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroIC40;?>" />
							<?php } ?>
							<?php if($GLOBALS['configCadastroBoxIc40'] == 2){ ?>
								<?php //Sem formatação.?>
								<?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
									<textarea name="informacao_complementar40" id="informacao_complementar40" class="AdmCampoTextoMultilinha01"><?php echo $tbCadastroIC40;?></textarea>
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
									<textarea name="informacao_complementar40" id="informacao_complementar40"><?php echo $tbCadastroIC40;?></textarea>
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
									<textarea name="informacao_complementar40" id="informacao_complementar40"><?php echo $tbCadastroIC40;?></textarea>
								<?php } ?>
							<?php } ?>
						</div>
					</td>
				</tr>
				<?php } ?>
            <?php } ?>
            
        </table>
        <div>
            <div style="float:left;">
                <input type="image" name="submit" value="Submit" src="img/btoAtualizar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoAtualizar"); ?>" />
                
                <input name="idTbCadastro" type="hidden" id="idTbCadastro" value="<?php echo $tbCadastroId; ?>" />
                <?php if($GLOBALS['habilitarCadastroEdicaoCategorias'] == 0){ ?>
                <input name="id_tb_categorias" type="hidden" id="id_tb_categorias" value="<?php echo $tbCadastroIdTbCategorias; ?>" />
                <?php } ?>
                <input name="n_visitas" type="hidden" id="n_visitas" value="<?php echo $tbCadastroNVisitas; ?>" />
                <!--input name="ativacao" type="hidden" id="ativacao" value="<?php echo $tbCadastroAtivacao; ?>" /-->
                <input name="ativacao_destaque" type="hidden" id="ativacao_destaque" value="<?php echo $tbCadastroAtivacaoDestaque; ?>" />
                <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            </div>
            <div style="float:right;">
                <a href="<?php echo $paginaRetorno; ?>?idParentCadastro=<?php echo $idParentCadastro; ?>" style="display: none;">
                    <img src="img/btoVoltar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoVoltar"); ?>"  />
                </a>
                <a href="javascript:history.go(-1);">
                    <img src="img/btoVoltar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoVoltar"); ?>"  />
                </a>
            </div>
        </div>
    </form>
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