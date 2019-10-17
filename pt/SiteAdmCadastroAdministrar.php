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
//$idParentCategorias = $_GET["idParentCategorias"];
$idParentCadastro = DbFuncoes::GetCampoGenerico01($idTbCadastro, "tb_cadastro", "id_tb_categorias");


$paginaRetorno = "SiteAdmCadastroAdministrar.php";
$paginaRetornoExclusao = "SiteAdmCadastroAdministrar.php";
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
		$tbCadastroDataCadastro = Funcoes::DataLeitura01($linhaCadastroDetalhes['data_cadastro'], $GLOBALS['configSiteFormatoData'], "1");
		//$tbCadastroNClassificacao = $linhaCadastroDetalhes['n_classificacao'];
		
		$tbCadastroPfPj = $linhaCadastroDetalhes['pf_pj'];
		$tbCadastroPfPj_print = "";
		if($tbCadastroPfPj == "1"){
			$tbCadastroPfPj_print = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroPfPj1");
		}
		if($tbCadastroPfPj == "2"){
			$tbCadastroPfPj_print = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroPfPj2");
		}

		$tbCadastroNome = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['nome']);
		
		$tbCadastroSexo = $linhaCadastroDetalhes['sexo'];
		$tbCadastroSexo_print = "";
		if($tbCadastroSexo == "1"){
			$tbCadastroSexo_print = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroSexo1");
		}
		if($tbCadastroSexo == "2"){
			$tbCadastroSexo_print = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroSexo2");
		}
		
		$tbCadastroAltura = $linhaCadastroDetalhes['altura'];
		$tbCadastroPeso = $linhaCadastroDetalhes['peso'];
		$tbCadastroRazaoSocial = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['razao_social']);
		$tbCadastroNomeFantasia = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['nome_fantasia']);
		
		//$tbCadastroDataNascimento = $linhaCadastroDetalhes['data_nascimento'];
		//$tbCadastroDataNascimento = $linhaCadastroDetalhes['data_nascimento'];
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
		
		$tbCadastroIdTbCadastroStatus = $linhaCadastroDetalhes['id_tb_cadastro_status'];
		$tbCadastroIdTbCadastroStatus_print = DbFuncoes::GetCampoGenerico01($tbCadastroIdTbCadastroStatus, "tb_cadastro_complemento", "complemento");
		$tbCadastroIdTbCadastro1 = $linhaCadastroDetalhes['id_tb_cadastro1'];
		$tbCadastroIdTbCadastro2 = $linhaCadastroDetalhes['id_tb_cadastro2'];
		$tbCadastroIdTbCadastro3 = $linhaCadastroDetalhes['id_tb_cadastro3'];
		
		$tbCadastroAtivacao = $linhaCadastroDetalhes['ativacao'];
		$tbCadastroAtivacao_print = "";
		if($tbCadastroAtivacao == "0"){
			$tbCadastroAtivacao_print = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao4");
		}
		if($tbCadastroAtivacao == "1"){
			$tbCadastroAtivacao_print = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao5");
		}

		$tbCadastroAtivacaoDestaque = $linhaCadastroDetalhes['ativacao_destaque'];
		
		$tbCadastroAtivacaoMalaDireta = $linhaCadastroDetalhes['ativacao_mala_direta'];
		$tbCadastroAtivacaoMalaDireta_print = "";
		if($tbCadastroAtivacaoMalaDireta == "0"){
			$tbCadastroAtivacaoMalaDireta_print = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao4");
		}
		if($tbCadastroAtivacaoMalaDireta == "1"){
			$tbCadastroAtivacaoMalaDireta_print = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao5");
		}
		
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
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo Funcoes::GetCadastroTitulo($tbCadastroNome, $tbCadastroRazaoSocial, $tbCadastroNomeFantasia, 1); ?>
     - 
	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloSite'], "IncludeConfig"); ?>
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
	<?php echo Funcoes::GetCadastroTitulo($tbCadastroNome, $tbCadastroRazaoSocial, $tbCadastroNomeFantasia, 1); ?>
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

	<?php //Diagramação 03 - Tabela.?>
    <?php //**************************************************************************************?>
    <div class="AdmTexto01" style="position: relative; display: block;">
        <table width="100%" class="AdmTabelaDados01">
          <tr class="AdmTbFundoEscuro">
            <td colspan="4">
                <div align="center" class="AdmTexto02">
                    <strong>
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroAdministrarTbDetalhes"); ?>
                    </strong>
                </div>
            </td>
          </tr>
    
          <?php if($GLOBALS['habilitarCadastroTipo'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroTipoCadastro"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
				<?php
				//Seleção de ids selecionados para o registro.
				$arrCadastroTipoSelecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "1", "", ",", "", "1"));
				$arrCadastroTipo = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 1);
                ?>
                
                <?php 
                for($countArray = 0; $countArray < count($arrCadastroTipo); $countArray++)
                {
                ?>
                    <div>
                        <?php if(in_array($arrCadastroTipo[$countArray][0], $arrCadastroTipoSelecao)){ ?> 
							- <?php echo $arrCadastroTipo[$countArray][1];?>
                        <?php } ?>
                    </div>
                <?php 
                }
                ?>
            </td>
          </tr>
          <?php } ?>
    
          <?php if($GLOBALS['habilitarCadastroAtividades'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroAtividades"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
				<?php
                //Seleção de ids selecionados para o registro.
                $arrCadastroAtividadesSelecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "2", "", ",", "", "1"));
                $arrCadastroAtividades = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 2);
                ?>
                
                <?php 
                for($countArray = 0; $countArray < count($arrCadastroAtividades); $countArray++)
                {
                ?>
                    <div>
                        <?php if(in_array($arrCadastroAtividades[$countArray][0], $arrCadastroAtividadesSelecao)){ ?> 
							- <?php echo $arrCadastroAtividades[$countArray][1];?>
                        <?php } ?>
                    </div>
                <?php 
                }
                ?>
            </td>
          </tr>
          <?php } ?>
    
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroNome"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
                <?php echo $tbCadastroNome; ?>
            </td>
          </tr>
    
          <?php if($GLOBALS['habilitarCadastroSexo'] == 1 || $GLOBALS['habilitarCadastroPfPj'] == 1){ ?>
          <tr>
            <?php if($GLOBALS['habilitarCadastroSexo'] == 1){ ?>
            <td class="AdmTbFundoMedio TabelaColuna01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroSexo"); ?>:
            </td>
            <td class="AdmTbFundoClaro"<?php if($GLOBALS['habilitarCadastroPfPj'] <> 1){ ?> colspan="3"<?php } ?>>
                <?php echo $tbCadastroSexo_print; ?>
            </td>
            <?php } ?>
            <?php if($GLOBALS['habilitarCadastroPfPj'] == 1){ ?>
            <td class="AdmTbFundoMedio TabelaColuna01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroPfPj"); ?>:
            </td>
            <td class="AdmTbFundoClaro"<?php if($GLOBALS['habilitarCadastroSexo'] <> 1){ ?> colspan="3"<?php } ?>>
                <?php echo $tbCadastroPfPj_print; ?>
            </td>
            <?php } ?>
          </tr>
          <?php } ?>
    
          <?php if($GLOBALS['habilitarCadastroFiltroGenerico01'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico01Nome'], "IncludeConfig"); ?>: 
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
				<?php 
				$arrCadastroFiltroGenerico01Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "12", "", ",", "", "1"));
				$arrCadastroFiltroGenerico01 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 12);
                ?>
				<?php 
                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico01); $countArray++)
                {
                ?>
                    <div>
                        <?php if(in_array($arrCadastroFiltroGenerico01[$countArray][0], $arrCadastroFiltroGenerico01Selecao)){ ?> 
							- <?php echo $arrCadastroFiltroGenerico01[$countArray][1];?>
                        <?php } ?>
                    </div>
                <?php 
                }
                ?>
            </td>
          </tr>
          <?php } ?>
          
          <?php if($GLOBALS['habilitarCadastroFiltroGenerico02'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico02Nome'], "IncludeConfig"); ?>: 
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
				<?php 
				$arrCadastroFiltroGenerico02Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "13", "", ",", "", "1"));
				$arrCadastroFiltroGenerico02 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 13);
                ?>
				<?php 
                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico02); $countArray++)
                {
                ?>
                    <div>
                        <?php if(in_array($arrCadastroFiltroGenerico02[$countArray][0], $arrCadastroFiltroGenerico02Selecao)){ ?> 
							- <?php echo $arrCadastroFiltroGenerico02[$countArray][1];?>
                        <?php } ?>
                    </div>
                <?php 
                }
                ?>
            </td>
          </tr>
          <?php } ?>

          <?php if($GLOBALS['habilitarCadastroFiltroGenerico03'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico03Nome'], "IncludeConfig"); ?>: 
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
				<?php 
				$arrCadastroFiltroGenerico03Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "14", "", ",", "", "1"));
				$arrCadastroFiltroGenerico03 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 14);
                ?>
				<?php 
                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico03); $countArray++)
                {
                ?>
                    <div>
                        <?php if(in_array($arrCadastroFiltroGenerico03[$countArray][0], $arrCadastroFiltroGenerico03Selecao)){ ?> 
							- <?php echo $arrCadastroFiltroGenerico03[$countArray][1];?>
                        <?php } ?>
                    </div>
                <?php 
                }
                ?>
            </td>
          </tr>
          <?php } ?>

          <?php if($GLOBALS['habilitarCadastroFiltroGenerico04'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico04Nome'], "IncludeConfig"); ?>: 
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
				<?php 
				$arrCadastroFiltroGenerico04Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "15", "", ",", "", "1"));
				$arrCadastroFiltroGenerico04 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 15);
                ?>
				<?php 
                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico04); $countArray++)
                {
                ?>
                    <div>
                        <?php if(in_array($arrCadastroFiltroGenerico04[$countArray][0], $arrCadastroFiltroGenerico04Selecao)){ ?> 
							- <?php echo $arrCadastroFiltroGenerico04[$countArray][1];?>
                        <?php } ?>
                    </div>
                <?php 
                }
                ?>
            </td>
          </tr>
          <?php } ?>

          <?php if($GLOBALS['habilitarCadastroFiltroGenerico05'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico05Nome'], "IncludeConfig"); ?>: 
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
				<?php 
				$arrCadastroFiltroGenerico05Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "16", "", ",", "", "1"));
				$arrCadastroFiltroGenerico05 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 16);
                ?>
				<?php 
                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico05); $countArray++)
                {
                ?>
                    <div>
                        <?php if(in_array($arrCadastroFiltroGenerico05[$countArray][0], $arrCadastroFiltroGenerico05Selecao)){ ?> 
							- <?php echo $arrCadastroFiltroGenerico05[$countArray][1];?>
                        <?php } ?>
                    </div>
                <?php 
                }
                ?>
            </td>
          </tr>
          <?php } ?>

          <?php if($GLOBALS['habilitarCadastroFiltroGenerico06'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico06Nome'], "IncludeConfig"); ?>: 
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
				<?php 
				$arrCadastroFiltroGenerico06Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "17", "", ",", "", "1"));
				$arrCadastroFiltroGenerico06 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 17);
                ?>
				<?php 
                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico06); $countArray++)
                {
                ?>
                    <div>
                        <?php if(in_array($arrCadastroFiltroGenerico06[$countArray][0], $arrCadastroFiltroGenerico06Selecao)){ ?> 
							- <?php echo $arrCadastroFiltroGenerico06[$countArray][1];?>
                        <?php } ?>
                    </div>
                <?php 
                }
                ?>
            </td>
          </tr>
          <?php } ?>

          <?php if($GLOBALS['habilitarCadastroFiltroGenerico07'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico07Nome'], "IncludeConfig"); ?>: 
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
				<?php 
				$arrCadastroFiltroGenerico07Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "18", "", ",", "", "1"));
				$arrCadastroFiltroGenerico07 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 18);
                ?>
				<?php 
                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico07); $countArray++)
                {
                ?>
                    <div>
                        <?php if(in_array($arrCadastroFiltroGenerico07[$countArray][0], $arrCadastroFiltroGenerico07Selecao)){ ?> 
							- <?php echo $arrCadastroFiltroGenerico07[$countArray][1];?>
                        <?php } ?>
                    </div>
                <?php 
                }
                ?>
            </td>
          </tr>
          <?php } ?>

          <?php if($GLOBALS['habilitarCadastroFiltroGenerico08'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico08Nome'], "IncludeConfig"); ?>: 
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
				<?php 
					$arrCadastroFiltroGenerico08Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "19", "", ",", "", "1"));
                    $arrCadastroFiltroGenerico08 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 19);
                ?>
				<?php 
                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico08); $countArray++)
                {
                ?>
                    <div>
                        <?php if(in_array($arrCadastroFiltroGenerico08[$countArray][0], $arrCadastroFiltroGenerico08Selecao)){ ?> 
							- <?php echo $arrCadastroFiltroGenerico08[$countArray][1];?>
                        <?php } ?>
                    </div>
                <?php 
                }
                ?>
            </td>
          </tr>
          <?php } ?>

          <?php if($GLOBALS['habilitarCadastroFiltroGenerico09'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico09Nome'], "IncludeConfig"); ?>: 
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
				<?php 
					$arrCadastroFiltroGenerico09Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "20", "", ",", "", "1"));
                    $arrCadastroFiltroGenerico09 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 20);
                ?>
				<?php 
                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico09); $countArray++)
                {
                ?>
                    <div>
                        <?php if(in_array($arrCadastroFiltroGenerico09[$countArray][0], $arrCadastroFiltroGenerico09Selecao)){ ?> 
							- <?php echo $arrCadastroFiltroGenerico09[$countArray][1];?>
                        <?php } ?>
                    </div>
                <?php 
                }
                ?>
            </td>
          </tr>
          <?php } ?>

          <?php if($GLOBALS['habilitarCadastroFiltroGenerico10'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico10Nome'], "IncludeConfig"); ?>: 
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
				<?php 
					$arrCadastroFiltroGenerico10Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "21", "", ",", "", "1"));
                    $arrCadastroFiltroGenerico10 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 21);
                ?>
				<?php 
                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico10); $countArray++)
                {
                ?>
                    <div>
                        <?php if(in_array($arrCadastroFiltroGenerico10[$countArray][0], $arrCadastroFiltroGenerico10Selecao)){ ?> 
							- <?php echo $arrCadastroFiltroGenerico10[$countArray][1];?>
                        <?php } ?>
                    </div>
                <?php 
                }
                ?>
            </td>
          </tr>
          <?php } ?>
    
          <?php if($GLOBALS['habilitarCadastroAlturaPeso'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroAltura"); ?>:
            </td>
            <td class="AdmTbFundoClaro">
                <?php echo $tbCadastroAltura; ?>
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroAlturaMedida"); ?>
            </td>
            <td class="AdmTbFundoMedio TabelaColuna01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroPeso"); ?>:
            </td>
            <td class="AdmTbFundoClaro">
                <?php echo $tbCadastroPeso; ?>
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroPesoMedida"); ?>
            </td>
          </tr>
          <?php } ?>
    
          <?php if($GLOBALS['habilitarCadastroRazaoSocial'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroRazaoSocial"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
                <?php echo $tbCadastroRazaoSocial; ?>
            </td>
          </tr>
          <?php } ?>
    
          <?php if($GLOBALS['habilitarCadastroNomeFantasia'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroNomeFantasia"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
                <?php echo $tbCadastroNomeFantasia; ?>
            </td>
          </tr>
          <?php } ?>
    
          <tr>
            <?php if($GLOBALS['habilitarCadastroDataNascimento'] == 1){ ?>
            <td class="AdmTbFundoMedio TabelaColuna01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroDataNascimento"); ?>:
            </td>
            <td class="AdmTbFundoClaro">
                <?php echo $tbCadastroDataNascimento; ?>
            </td>
            <?php } ?>
            <td class="AdmTbFundoMedio TabelaColuna01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroDataCadastro"); ?>:
            </td>
            <td class="AdmTbFundoClaro"<?php if($GLOBALS['habilitarCadastroDataNascimento'] <> 1){ ?> colspan="3"<?php } ?>>
                <?php echo $tbCadastroDataCadastro; ?>
            </td>
          </tr>
		  
          <?php if($GLOBALS['habilitarCadastroData1'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData1'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
                <?php echo $tbCadastroData1; ?>
            </td>
          </tr>
          <?php } ?>
          
          <?php if($GLOBALS['habilitarCadastroData2'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData2'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
                <?php echo $tbCadastroData2; ?>
            </td>
          </tr>
          <?php } ?>

          <?php if($GLOBALS['habilitarCadastroData3'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData3'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
                <?php echo $tbCadastroData3; ?>
            </td>
          </tr>
          <?php } ?>

          <?php if($GLOBALS['habilitarCadastroData4'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData4'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
                <?php echo $tbCadastroData4; ?>
            </td>
          </tr>
          <?php } ?>

          <?php if($GLOBALS['habilitarCadastroData5'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData5'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
                <?php echo $tbCadastroData5; ?>
            </td>
          </tr>
          <?php } ?>

          <?php if($GLOBALS['habilitarCadastroData6'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData6'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
                <?php echo $tbCadastroData6; ?>
            </td>
          </tr>
          <?php } ?>

          <?php if($GLOBALS['habilitarCadastroData7'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData7'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
                <?php echo $tbCadastroData7; ?>
            </td>
          </tr>
          <?php } ?>

          <?php if($GLOBALS['habilitarCadastroData8'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData8'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
                <?php echo $tbCadastroData8; ?>
            </td>
          </tr>
          <?php } ?>

          <?php if($GLOBALS['habilitarCadastroData9'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData9'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
                <?php echo $tbCadastroData9; ?>
            </td>
          </tr>
          <?php } ?>

          <?php if($GLOBALS['habilitarCadastroData10'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData10'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
                <?php echo $tbCadastroData10; ?>
            </td>
          </tr>
          <?php } ?>
    
          <?php if($GLOBALS['habilitarCadastroCPFRG'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroCPF"); ?>:
            </td>
            <td class="AdmTbFundoClaro">
                <?php echo $tbCadastroCPF; ?>
            </td>
            <td class="AdmTbFundoMedio TabelaColuna01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroRG"); ?>:
            </td>
            <td class="AdmTbFundoClaro">
                <?php echo $tbCadastroRG; ?>
            </td>
          </tr>
          <?php } ?>
    
          <?php if($GLOBALS['habilitarCadastroCNPJ'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroCNPJ"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
                <?php echo $tbCadastroCNPJ; ?>
            </td>
          </tr>
          <?php } ?>
    
          <?php if($GLOBALS['habilitarCadastroDocumento'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroCNPJ"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
            	<?php echo $tbCadastroDocumento; ?>
            </td>
          </tr>
          <?php } ?>
    
          <?php if($GLOBALS['habilitarCadastroIEstadualIMunicipal'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroInscricaoMunicipal"); ?>:
            </td>
            <td class="AdmTbFundoClaro">
            	<?php echo $tbCadastroIMunicipal; ?>
            </td>
            <td class="AdmTbFundoMedio TabelaColuna01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroInscricaoEstadual"); ?>:
            </td>
            <td class="AdmTbFundoClaro">
            	<?php echo $tbCadastroIEstadual; ?>
            </td>
          </tr>
          <?php } ?>
    
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroEnderecoPrincipal"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
            	<?php echo $tbCadastroEnderecoPrincipal; ?>
            </td>
          </tr>
    
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroEnderecoNumeroPrincipal"); ?>:
            </td>
            <td class="AdmTbFundoClaro">
            	<?php echo $tbCadastroEnderecoNumeroPrincipal; ?>
            </td>
            <td class="AdmTbFundoMedio TabelaColuna01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroEnderecoComplementoPrincipal"); ?>:
            </td>
            <td class="AdmTbFundoClaro">
            	<?php echo $tbCadastroEnderecoComplementoPrincipal; ?>
            </td>
          </tr>
    
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroBairroPrincipal"); ?>:
            </td>
            <td class="AdmTbFundoClaro">
            	<?php echo $tbCadastroBairroPrincipal; ?>
            </td>
            <td class="AdmTbFundoMedio TabelaColuna01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroCidadePrincipal"); ?>:
            </td>
            <td class="AdmTbFundoClaro">
            	<?php echo $tbCadastroCidadePrincipal; ?>
            </td>
          </tr>
    
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroEstadoPrincipal"); ?>:
            </td>
            <td class="AdmTbFundoClaro">
            	<?php echo $tbCadastroEstadoPrincipal; ?>
            </td>
            <td class="AdmTbFundoMedio TabelaColuna01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroPaisPrincipal"); ?>:
            </td>
            <td class="AdmTbFundoClaro">
            	<?php echo $tbCadastroPaisPrincipal; ?>
            </td>
          </tr>
    
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroCEPPrincipal"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
            	<?php echo $tbCadastroCepPrincipal; ?>
            </td>
          </tr>
    
          <?php if($GLOBALS['habilitarCadastroPontoReferencia'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroPontoReferencia"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
            	<?php echo $tbCadastroPontoReferencia; ?>
            </td>
          </tr>
          <?php } ?>
    
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroEmailPrincipal"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
            	<a href="mailto:<?php echo $tbCadastroEmailPrincipal; ?>" class="AdmLinks01">
					<?php echo $tbCadastroEmailPrincipal; ?>
                </a>
            </td>
          </tr>
    
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroTel"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
            	<?php if(!empty($tbCadastroTelDDDPrincipal)){ ?>(<?php echo $tbCadastroTelDDDPrincipal; ?>)<?php } ?> 
                <?php echo $tbCadastroTelPrincipal; ?>
            </td>
          </tr>
    
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroCel"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
            	<?php if(!empty($tbCadastroCelDDDPrincipal)){ ?>(<?php echo $tbCadastroCelDDDPrincipal; ?>)<?php } ?> 
                <?php echo $tbCadastroCelPrincipal; ?>
            </td>
          </tr>
    
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroFax"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
            	<?php if(!empty($tbCadastroFaxDDDPrincipal)){ ?>(<?php echo $tbCadastroFaxDDDPrincipal; ?>)<?php } ?> 
                <?php echo $tbCadastroFaxPrincipal; ?>
            </td>
          </tr>
    
          <?php if($GLOBALS['habilitarCadastroSite'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroSitePrincipal"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
            	<a href="<?php echo $tbCadastroSitePrincipal; ?>" target="_blank" class="AdmLinks01">
					<?php echo $tbCadastroSitePrincipal; ?>
                </a>
            </td>
          </tr>
          <?php } ?>
    
          <?php if($GLOBALS['habilitarCadastroNFuncionarios'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroNFuncionarios"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
                <?php echo $tbCadastroNFuncionarios; ?>
            </td>
          </tr>
          <?php } ?>
    
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroObs"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
                <?php echo $tbCadastroOBSInterno; ?>
            </td>
          </tr>
          
          <?php if($GLOBALS['habilitarCadastroVinculo1'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroVinculo1Nome'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
            	<a href="CadastroAdministrar.php?idTbCadastro=<?php echo $tbCadastroIdTbCadastro1; ?>" target="_blank" class="AdmLinks01"> 
					<?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($tbCadastroIdTbCadastro1, "tb_cadastro", "nome"), DbFuncoes::GetCampoGenerico01($tbCadastroIdTbCadastro1, "tb_cadastro", "razao_social"), DbFuncoes::GetCampoGenerico01($tbCadastroIdTbCadastro1, "tb_cadastro", "nome_fantasia"), 1)); ?>
                </a>
            </td>
          </tr>
          <?php } ?>
          <?php if($GLOBALS['habilitarCadastroVinculo2'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroVinculo2Nome'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
            	<a href="CadastroAdministrar.php?idTbCadastro=<?php echo $tbCadastroIdTbCadastro2; ?>" target="_blank" class="AdmLinks01"> 
					<?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($tbCadastroIdTbCadastro2, "tb_cadastro", "nome"), DbFuncoes::GetCampoGenerico01($tbCadastroIdTbCadastro2, "tb_cadastro", "razao_social"), DbFuncoes::GetCampoGenerico01($tbCadastroIdTbCadastro2, "tb_cadastro", "nome_fantasia"), 1)); ?>
                </a>
            </td>
          </tr>
          <?php } ?>
          <?php if($GLOBALS['habilitarCadastroVinculo3'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroVinculo3Nome'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
            	<a href="CadastroAdministrar.php?idTbCadastro=<?php echo $tbCadastroIdTbCadastro3; ?>" target="_blank" class="AdmLinks01"> 
					<?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($tbCadastroIdTbCadastro3, "tb_cadastro", "nome"), DbFuncoes::GetCampoGenerico01($tbCadastroIdTbCadastro3, "tb_cadastro", "razao_social"), DbFuncoes::GetCampoGenerico01($tbCadastroIdTbCadastro3, "tb_cadastro", "nome_fantasia"), 1)); ?>
                </a>
            </td>
          </tr>
          <?php } ?>
    
          <?php if($GLOBALS['habilitarCadastroStatus'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroStatus"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
                <?php echo $tbCadastroIdTbCadastroStatus_print; ?>
            </td>
          </tr>
          <?php } ?>
    
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao3"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
                <?php echo $tbCadastroAtivacao_print; ?>
            </td>
          </tr>
    
          <?php if($GLOBALS['habilitarCadastroAtivacaoMalaDireta'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroAtivacaoMalaDireta"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
                <?php echo $tbCadastroAtivacaoMalaDireta_print; ?>
            </td>
          </tr>
          <?php } ?>
    
          <?php if($GLOBALS['habilitarCadastroUsuario'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroUsuario"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
                <?php echo $tbCadastroUsuario; ?>
            </td>
          </tr>
          <?php } ?>
    
          <?php if($GLOBALS['habilitarCadastroSenha'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroSenha"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
                <?php echo $tbCadastroSenha; ?>
            </td>
          </tr>
          <?php } ?>
    
          <?php if($GLOBALS['habilitarCadastroImagem'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemImagem"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
				<?php if(!empty($tbCadastroImagem)){ //if($tbCategoriasImagem <> ""){?>
                <td width="1">
                    <img src="<?php echo $GLOBALS['configDiretorioArquivos'];?>/r<?php echo $tbCadastroImagem; ?>?variavelCache=<?php echo date("s"); ?>" alt="<?php echo $tbCadastroImagem; ?>" style="margin-left: 4px;" />
                </td>
                <td>
                    <a href="RegistrosArquivosExcluirExe.php?idRegistro=<?php echo $tbCadastroId;?>&strTabela=tb_cadastro&strCampo=imagem<?php echo $queryPadrao;?>" class="LinksExcluir01" style="margin-left: 4px;">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemImagemExcluir"); ?>
                    </a>
                </td>
                <?php } ?>
            </td>
          </tr>
          <?php } ?>
    
          <?php if($GLOBALS['habilitarCadastroLogo'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroLogo"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">


            </td>
          </tr>
          <?php } ?>
    
          <?php if($GLOBALS['habilitarCadastroBanner'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroBanner"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">


            </td>
          </tr>
          <?php } ?>
    
          <?php if($GLOBALS['habilitarCadastroMapa'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroMapaImagem"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">


            </td>
          </tr>
          <?php } ?>
    
          <?php if($GLOBALS['habilitarCadastroMapaOnline'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroMapaImagem"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
                <?php echo $tbCadastroMapaOnline; ?>
            </td>
          </tr>
          <?php } ?>
    
          <?php if($GLOBALS['habilitarCadastroApresentacao'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroApresentacao"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
                <?php echo $tbCadastroApresentacao; ?>
            </td>
          </tr>
          <?php } ?>
    
          <?php if($GLOBALS['habilitarCadastroServicos'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroServicos"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
                <?php echo $tbCadastroServicos; ?>
            </td>
          </tr>
          <?php } ?>
    
          <?php if($GLOBALS['HabilitarCadastroPromocoes'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroPromocoes"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
                <?php echo $tbCadastroPromocoes; ?>
            </td>
          </tr>
          <?php } ?>
    
          <?php if($GLOBALS['habilitarCadastroCondicoesComerciais'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroCondicoesComerciais"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
                <?php echo $tbCadastroCondicoesComerciais; ?>
            </td>
          </tr>
          <?php } ?>
    
          <?php if($GLOBALS['habilitarCadastroFormasPagamento'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroFormasPagamento"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
                <?php echo $tbCadastroFormasPagamento; ?>
            </td>
          </tr>
          <?php } ?>
          
          <?php if($GLOBALS['habilitarCadastroHorarioAtendimento'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroHorarioAtendimento"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
                <?php echo $tbCadastroHorarioAtendimento; ?>
            </td>
          </tr>
          <?php } ?>
    
          <?php if($GLOBALS['habilitarCadastroSituacaoAtual'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroSituacaoAtual"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
                <?php echo $tbCadastroSituacaoAtual; ?>
            </td>
          </tr>
          <?php } ?>
    
          <?php if($GLOBALS['habilitarCadastroIc1'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc1'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
                <?php echo $tbCadastroIC1; ?>
            </td>
          </tr>
          <?php } ?>
    
          <?php if($GLOBALS['habilitarCadastroIc2'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc2'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
                <?php echo $tbCadastroIC2; ?>
            </td>
          </tr>
          <?php } ?>
          
          <?php if($GLOBALS['habilitarCadastroIc3'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc3'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
                <?php echo $tbCadastroIC3; ?>
            </td>
          </tr>
          <?php } ?>
          
          <?php if($GLOBALS['habilitarCadastroIc4'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc4'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
                <?php echo $tbCadastroIC4; ?>
            </td>
          </tr>
          <?php } ?>
          
          <?php if($GLOBALS['habilitarCadastroIc5'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc5'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
                <?php echo $tbCadastroIC5; ?>
            </td>
          </tr>
          <?php } ?>
          
          <?php if($GLOBALS['habilitarCadastroIc6'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc6'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
                <?php echo $tbCadastroIC6; ?>
            </td>
          </tr>
          <?php } ?>
          
          <?php if($GLOBALS['habilitarCadastroIc7'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc7'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
                <?php echo $tbCadastroIC7; ?>
            </td>
          </tr>
          <?php } ?>
          
          <?php if($GLOBALS['habilitarCadastroIc8'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc8'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
                <?php echo $tbCadastroIC8; ?>
            </td>
          </tr>
          <?php } ?>
          
          <?php if($GLOBALS['habilitarCadastroIc9'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc9'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
                <?php echo $tbCadastroIC9; ?>
            </td>
          </tr>
          <?php } ?>
          
          <?php if($GLOBALS['habilitarCadastroIc10'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc10'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
                <?php echo $tbCadastroIC10; ?>
            </td>
          </tr>
          <?php } ?>
          
          <?php if($GLOBALS['habilitarCadastroIc11'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc11'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
                <?php echo $tbCadastroIC11; ?>
            </td>
          </tr>
          <?php } ?>
    
          <?php if($GLOBALS['habilitarCadastroIc12'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc12'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
                <?php echo $tbCadastroIC12; ?>
            </td>
          </tr>
          <?php } ?>
          
          <?php if($GLOBALS['habilitarCadastroIc13'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc13'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
                <?php echo $tbCadastroIC13; ?>
            </td>
          </tr>
          <?php } ?>
          
          <?php if($GLOBALS['habilitarCadastroIc14'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc14'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
                <?php echo $tbCadastroIC14; ?>
            </td>
          </tr>
          <?php } ?>
          
          <?php if($GLOBALS['habilitarCadastroIc15'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc15'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
                <?php echo $tbCadastroIC15; ?>
            </td>
          </tr>
          <?php } ?>
          
          <?php if($GLOBALS['habilitarCadastroIc16'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc16'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
                <?php echo $tbCadastroIC16; ?>
            </td>
          </tr>
          <?php } ?>
          
          <?php if($GLOBALS['habilitarCadastroIc17'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc17'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
                <?php echo $tbCadastroIC17; ?>
            </td>
          </tr>
          <?php } ?>
          
          <?php if($GLOBALS['habilitarCadastroIc18'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc18'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
                <?php echo $tbCadastroIC18; ?>
            </td>
          </tr>
          <?php } ?>
          
          <?php if($GLOBALS['habilitarCadastroIc19'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc19'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
                <?php echo $tbCadastroIC19; ?>
            </td>
          </tr>
          <?php } ?>
          
          <?php if($GLOBALS['habilitarCadastroIc20'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc20'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
                <?php echo $tbCadastroIC20; ?>
            </td>
          </tr>
          <?php } ?>
          
          <?php if($GLOBALS['habilitarCadastroIc31'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc31'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
                <?php echo $tbCadastroIC31; ?>
            </td>
          </tr>
          <?php } ?>
    
          <?php if($GLOBALS['habilitarCadastroIc32'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc32'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
                <?php echo $tbCadastroIC32; ?>
            </td>
          </tr>
          <?php } ?>
          
          <?php if($GLOBALS['habilitarCadastroIc33'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc33'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
                <?php echo $tbCadastroIC33; ?>
            </td>
          </tr>
          <?php } ?>
          
          <?php if($GLOBALS['habilitarCadastroIc34'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc34'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
                <?php echo $tbCadastroIC34; ?>
            </td>
          </tr>
          <?php } ?>
          
          <?php if($GLOBALS['habilitarCadastroIc35'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc35'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
                <?php echo $tbCadastroIC35; ?>
            </td>
          </tr>
          <?php } ?>
          
          <?php if($GLOBALS['habilitarCadastroIc36'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc36'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
                <?php echo $tbCadastroIC36; ?>
            </td>
          </tr>
          <?php } ?>
          
          <?php if($GLOBALS['habilitarCadastroIc37'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc37'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
                <?php echo $tbCadastroIC37; ?>
            </td>
          </tr>
          <?php } ?>
          
          <?php if($GLOBALS['habilitarCadastroIc38'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc38'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
                <?php echo $tbCadastroIC38; ?>
            </td>
          </tr>
          <?php } ?>
          
          <?php if($GLOBALS['habilitarCadastroIc39'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc39'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
                <?php echo $tbCadastroIC39; ?>
            </td>
          </tr>
          <?php } ?>
          
          <?php if($GLOBALS['habilitarCadastroIc40'] == 1){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc40'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
                <?php echo $tbCadastroIC40; ?>
            </td>
          </tr>
          <?php } ?>
          
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroAdministrarFuncoes"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
                [
                <a href="SiteAdmCadastroEditar.php?idTbCadastro=<?php echo $tbCadastroId;?><?php echo $queryPadrao;?>" class="AdmLinks01">
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                </a>
                ]
				<?php if($GLOBALS['habilitarCadastroFotos'] == 1){ ?>
                    [
                    <a href="SiteAdmArquivosIndice.php?idParent=<?php echo $tbCadastroId;?>&tipoArquivo=1&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::GetCadastroTitulo(Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome']), Funcoes::ConteudoMascaraLeitura($linhaCadastro['razao_social']), Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome_fantasia']), 1);?>&detalhe02=" target="_blank" class="AdmLinks01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirFotos"); ?>
                    </a>
                    ] 
                <?php } ?>
                <?php if($GLOBALS['habilitarCadastroVideos'] == 1){ ?>
                    [
                    <a href="SiteAdmArquivosIndice.php?idParent=<?php echo $tbCadastroId;?>&tipoArquivo=2&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::GetCadastroTitulo(Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome']), Funcoes::ConteudoMascaraLeitura($linhaCadastro['razao_social']), Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome_fantasia']), 1);?>&detalhe02=" target="_blank" class="AdmLinks01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirVideos"); ?>
                    </a>
                    ] 
                <?php } ?>
                <?php if($GLOBALS['habilitarCadastroArquivos'] == 1){ ?>
                    [
                    <a href="SiteAdmArquivosIndice.php?idParent=<?php echo $tbCadastroId;?>&tipoArquivo=3&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::GetCadastroTitulo($tbCadastroNome, $tbCadastroRazaoSocial, $tbCadastroNomeFantasia, 1);?>&detalhe02=" target="_blank" class="AdmLinks01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirArquivos"); ?>
                    </a>
                    ] 
                <?php } ?>
                <?php if($GLOBALS['habilitarCadastroZip'] == 1){ ?>
                    [
                    <a href="SiteAdmArquivosIndice.php?idParent=<?php echo $tbCadastroId;?>&tipoArquivo=4&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::GetCadastroTitulo($tbCadastroNome, $tbCadastroRazaoSocial, $tbCadastroNomeFantasia, 1);?>&detalhe02=" target="_blank" class="AdmLinks01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirZip"); ?>
                    </a>
                    ] 
                <?php } ?>
                <?php if($GLOBALS['habilitarCadastroSwfs'] == 1){ ?>
                    [
                    <a href="SiteAdmArquivosIndice.php?idParent=<?php echo $tbCadastroId;?>&tipoArquivo=5&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::GetCadastroTitulo($tbCadastroNome, $tbCadastroRazaoSocial, $tbCadastroNomeFantasia, 1);?>&detalhe02=" target="_blank" class="AdmLinks01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirSWFs"); ?>
                    </a>
                    ] 
                <?php } ?>
                
				<?php if($GLOBALS['habilitarAdministrarPedidosCobrancaAvulsa'] == 1){ ?>
                    [
                    <a href="SiteAdmCadastroCobrancaAvulsa.php?idTbCadastro=<?php echo $idTbCadastro; ?>&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::GetCadastroTitulo($tbCadastroNome, $tbCadastroRazaoSocial, $tbCadastroNomeFantasia, 1);?>&detalhe02=" target="_blank" class="AdmLinks01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroAdministrarPedidosNovoPedido"); ?>
                    </a>
                    ] 
                <?php } ?>
                
				<?php if($GLOBALS['habilitarCadastroOrcamento'] == 1){ ?>
                    [
                    <a href="SiteAdmOrcamento.php?idTbCadastroCliente=<?php echo $idTbCadastro; ?>&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::GetCadastroTitulo($tbCadastroNome, $tbCadastroRazaoSocial, $tbCadastroNomeFantasia, 1);?>&detalhe02=" target="_blank" class="AdmLinks01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroAdministrarOrcamentosNovoOrcamento"); ?>
                    </a>
                    ] 
                <?php } ?>
            </td>
          </tr>
          
          <?php if($GLOBALS['ConfigIdCategoriasConteudoModelo'] <> 0){ ?>
          <tr>
            <td class="AdmTbFundoMedio TabelaColuna01">
				<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroConteudoModelos"); ?>:
            </td>
            <td colspan="3" class="AdmTbFundoClaro">
				<?php 
				$arrCategoriasConteudoModelo = DbFuncoes::CampoGenericoFill01("tb_categorias", 
																	"categoria", 
																	"", 
																	"id_parent", 
																	$GLOBALS['ConfigIdCategoriasConteudoModelo'], 
																	"", 
																	"", 
																	"", 
																	"", 
																	"categoria", 
																	"", 
																	"");
                ?>
				<?php 
                for($countArray = 0; $countArray < count($arrCategoriasConteudoModelo); $countArray++)
                {
                ?>
                    <div>
                        <a href="../<?php echo $GLOBALS['visualizacaoAtivaSistema'];?>/SiteConteudo.php?idParentConteudo=<?php echo $arrCategoriasConteudoModelo[$countArray][0];?>&idTbCadastro=<?php echo $tbCadastroId;?>&masterPageSiteSelect=LayoutSiteImpressao.php" class="AdmLinks01" target="_blank">
                        	- <?php echo $arrCategoriasConteudoModelo[$countArray][1];?>
                        </a>
                    </div>
                <?php 
                }
                ?>
            </td>
          </tr>
          <?php } ?>
        </table>
    </div>
    <?php //**************************************************************************************?>
    
    
	<?php //Comércio eletrônico.?>
	<?php //**************************************************************************************?>
    <?php if($GLOBALS['habilitarAdministrarECommerce'] == 1){ ?>
    <div class="AdmBordaTabela01" style="margin: 20px 0px 0px 0px;">
        <div class="AdmTbFundoEscuro">
            <div align="center" class="AdmTexto02">
                <strong>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroAdministrarPedidosRealizados"); ?>
                </strong>
            </div>
        </div>
        <div style="height: 500px; width: 100%;">
            <iframe class="AdmTabelaIFrame01" src="SiteAdmPedidosIndice.php?idTbCadastroCliente=<?php echo $idTbCadastro; ?>&masterPageSiteSelect=LayoutSiteIFrame.php" scrolling="auto" name="pedidos" frameborder="0" align="left" width="100%" height="100%">
            </iframe>
        </div>
    </div>
	<?php } ?>
	<?php //**************************************************************************************?>
    
    
	<?php //Tarefas.?>
	<?php //**************************************************************************************?>
    <?php if($GLOBALS['habilitarAdministrarCadastroTarefas'] == 1){ ?>
    <div class="AdmBordaTabela01" style="margin: 20px 0px 0px 0px;">
        <div class="AdmTbFundoEscuro">
            <div align="center" class="AdmTexto02">
                <strong>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteTarefasTitulo"); ?>
                </strong>
            </div>
        </div>
        <div style="height: 800px; width: 100%;">
            <iframe class="AdmTabelaIFrame01" src="SiteAdmTarefasIndice.php?idParent=<?php echo $idTbCadastro; ?>&masterPageSiteSelect=LayoutSiteIFrame.php" scrolling="auto" name="tarefas" frameborder="0" align="left" width="100%" height="100%">
            </iframe>
        </div>
    </div>
	<?php } ?>
	<?php //**************************************************************************************?>
    
    
	<?php //Imagens complementares.?>
    <?php //----------------------?>
    <?php 
	//Definição de variáveis do include.
	$includeArquivosImagens_idTbArquivos = $tbCadastroId;
	$includeArquivosImagens_tipoVisualizacao = "1";
	
	$includeArquivosImagens_limiteRegistros = "";
	$includeArquivosImagens_nImagensVisivelScroll = "3";
	$includeArquivosImagens_configImagemZoom = "1";
	?>
    
    <?php include "IncludeArquivosImagens.php";?>
    <?php //----------------------?>
    
    
	<?php //Arquivos complementares.?>
    <?php //----------------------?>
    <?php 
	//Definição de variáveis do include.
	$includeArquivos_idTbArquivos = $tbCadastroId;
	$includeArquivos_tipoVisualizacao = "1";
	$includeArquivos_configArquivosNColunas = "1";
	
	$includeArquivos_limiteRegistros = "";
	$includeArquivos_nImagensVisivelScroll = "1";
	?>
    
    <?php include "IncludeArquivos.php";?>
    <?php //----------------------?>
    
    
	<?php //Páginas.?>
    <?php //----------------------?>
    <?php 
	//Definição de variáveis do include.
	//$includePaginas_idParentPaginas = $tbCadastroId;
	$includePaginas_idParentPaginas = "3481";
	$includePaginas_idsTbPaginas = "";
	
	//$includePaginas_idTbCadastro1 = "";
	$includePaginas_idTbCadastro1 = $tbCadastroId;
	$includePaginas_idsTbCadastro1 = "";
	
	$includePaginas_idTbCadastro2 = "";
	$includePaginas_idsTbCadastro2 = "";
	
	$includePaginas_configTipoDiagramacao = "2";
	$includePaginas_configPaginasNRegistros = "";
	$includePaginas_configClassificacaoPaginas = "";
	?>
    
    <?php include "IncludePaginas.php";?>
    <?php //----------------------?>
    
    
	<?php //Páginas - Vínculo01.?>
	<?php //**************************************************************************************?>
    <?php if($GLOBALS['habilitarPaginasVinculo1'] == 1){ ?>
    <div class="AdmBordaTabela01" style="margin: 20px 0px 0px 0px; display: none;">
        <div class="AdmTbFundoEscuro">
            <div align="center" class="AdmTexto02">
                <strong>
                	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemCadastroVinculado"); ?> (<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPaginasVinculo1Nome'], "IncludeConfig"); ?>)
                </strong>
            </div>
        </div>
        <div style="height: 800px; width: 100%;">
            <iframe class="AdmTabelaIFrame01" src="SiteAdmPaginasIndice.php?idTbCadastro1=<?php echo $tbCadastroId; ?>&masterPageSelect=LayoutSiteSemMenu.php" scrolling="auto" name="paginasCadastro1" frameborder="0" align="left" width="100%" height="100%">
            </iframe>
        </div>
    </div>
	<?php } ?>
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