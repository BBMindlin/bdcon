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
//$idParentCategorias = $_GET["idParentCategorias"];
$idParentCadastro = DbFuncoes::GetCampoGenerico01($idTbCadastro, "tb_cadastro", "id_tb_categorias");


$paginaRetorno = "CadastroAdministrar.php";
$paginaRetornoExclusao = "CadastroAdministrar.php";
$variavelRetorno = "idTbCadastro";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];


//Montagem de query padrão de retorno.
$queryPadrao = "&idParentCadastro=" . $idParentCadastro . 
"&idTbCadastroUsuario=" . $idTbCadastroUsuario . 
"&paginaRetorno=" . $paginaRetorno . 
"&masterPageSelect=" . $masterPageSelect . 
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

$strSqlCadastroDetalhesSelect .= "pf_pj, ";
$strSqlCadastroDetalhesSelect .= "nome, ";
$strSqlCadastroDetalhesSelect .= "sexo, ";
$strSqlCadastroDetalhesSelect .= "altura, ";
$strSqlCadastroDetalhesSelect .= "peso, ";
$strSqlCadastroDetalhesSelect .= "razao_social, ";
$strSqlCadastroDetalhesSelect .= "nome_fantasia, ";
$strSqlCadastroDetalhesSelect .= "data_nascimento, ";
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
		$tbCadastroDataCadastro = Funcoes::DataLeitura01($linhaCadastroDetalhes['data_cadastro'], $GLOBALS['configSistemaFormatoData'], "1");
		//$tbCadastroNClassificacao = $linhaCadastroDetalhes['n_classificacao'];
		
		$tbCadastroPfPj = $linhaCadastroDetalhes['pf_pj'];
		$tbCadastroPfPj_print = "";
		if($tbCadastroPfPj == "1"){
			$tbCadastroPfPj_print = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroPfPj1");
		}
		if($tbCadastroPfPj == "2"){
			$tbCadastroPfPj_print = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroPfPj2");
		}

		$tbCadastroNome = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['nome']);
		
		$tbCadastroSexo = $linhaCadastroDetalhes['sexo'];
		$tbCadastroSexo_print = "";
		if($tbCadastroSexo == "1"){
			$tbCadastroSexo_print = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroSexo1");
		}
		if($tbCadastroSexo == "2"){
			$tbCadastroSexo_print = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroSexo2");
		}
		
		$tbCadastroAltura = $linhaCadastroDetalhes['altura'];
		$tbCadastroPeso = $linhaCadastroDetalhes['peso'];
		$tbCadastroRazaoSocial = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['razao_social']);
		$tbCadastroNomeFantasia = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['nome_fantasia']);
		
		//$tbCadastroDataNascimento = $linhaCadastroDetalhes['data_nascimento'];
		//$tbCadastroDataNascimento = Funcoes::DataLeitura01($linhaCadastroDetalhes['data_nascimento'], $GLOBALS['configSistemaFormatoData'], "1");
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
			$tbCadastroAtivacao_print = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao4");
		}
		if($tbCadastroAtivacao == "1"){
			$tbCadastroAtivacao_print = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao5");
		}

		$tbCadastroAtivacaoDestaque = $linhaCadastroDetalhes['ativacao_destaque'];
		
		$tbCadastroAtivacaoMalaDireta = $linhaCadastroDetalhes['ativacao_mala_direta'];
		$tbCadastroAtivacaoMalaDireta_print = "";
		if($tbCadastroAtivacaoMalaDireta == "0"){
			$tbCadastroAtivacaoMalaDireta_print = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao4");
		}
		if($tbCadastroAtivacaoMalaDireta == "1"){
			$tbCadastroAtivacaoMalaDireta_print = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao5");
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
    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroAdministrarTitulo"); ?> 
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
            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroAdministrarTitulo"); ?>
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
    
    <div class="Texto01">
        <table width="100%"  border="0" cellspacing="1" cellpadding="4">
          <tr class="TbFundoEscuro">
            <td colspan="4">
                <div align="center" class="Texto02">
                    <strong>
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroAdministrarTbDetalhes"); ?>
                    </strong>
                </div>
            </td>
          </tr>
    
          <?php if($GLOBALS['habilitarCadastroTipo'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroTipoCadastro"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
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
            <td class="TbFundoMedio TabelaColuna01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroAtividades"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
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
            <td class="TbFundoMedio TabelaColuna01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroNome"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
                <?php echo $tbCadastroNome; ?>
            </td>
          </tr>
    
          <?php if($GLOBALS['habilitarCadastroSexo'] == 1 || $GLOBALS['habilitarCadastroPfPj'] == 1){ ?>
          <tr>
            <?php if($GLOBALS['habilitarCadastroSexo'] == 1){ ?>
            <td class="TbFundoMedio TabelaColuna01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroSexo"); ?>:
            </td>
            <td class="TbFundoClaro"<?php if($GLOBALS['habilitarCadastroPfPj'] <> 1){ ?> colspan="3"<?php } ?>>
                <?php echo $tbCadastroSexo_print; ?>
            </td>
            <?php } ?>
            <?php if($GLOBALS['habilitarCadastroPfPj'] == 1){ ?>
            <td class="TbFundoMedio TabelaColuna01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroPfPj"); ?>:
            </td>
            <td class="TbFundoClaro"<?php if($GLOBALS['habilitarCadastroSexo'] <> 1){ ?> colspan="3"<?php } ?>>
                <?php echo $tbCadastroPfPj_print; ?>
            </td>
            <?php } ?>
          </tr>
          <?php } ?>
    
          <?php if($GLOBALS['habilitarCadastroFiltroGenerico01'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico01Nome'], "IncludeConfig"); ?>: 
            </td>
            <td colspan="3" class="TbFundoClaro">
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
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico02Nome'], "IncludeConfig"); ?>: 
            </td>
            <td colspan="3" class="TbFundoClaro">
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
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico03Nome'], "IncludeConfig"); ?>: 
            </td>
            <td colspan="3" class="TbFundoClaro">
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
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico04Nome'], "IncludeConfig"); ?>: 
            </td>
            <td colspan="3" class="TbFundoClaro">
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
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico05Nome'], "IncludeConfig"); ?>: 
            </td>
            <td colspan="3" class="TbFundoClaro">
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
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico06Nome'], "IncludeConfig"); ?>: 
            </td>
            <td colspan="3" class="TbFundoClaro">
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
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico07Nome'], "IncludeConfig"); ?>: 
            </td>
            <td colspan="3" class="TbFundoClaro">
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
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico08Nome'], "IncludeConfig"); ?>: 
            </td>
            <td colspan="3" class="TbFundoClaro">
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
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico09Nome'], "IncludeConfig"); ?>: 
            </td>
            <td colspan="3" class="TbFundoClaro">
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
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico10Nome'], "IncludeConfig"); ?>: 
            </td>
            <td colspan="3" class="TbFundoClaro">
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
          
          <?php if($GLOBALS['habilitarCadastroFiltroGenerico11'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico11Nome'], "IncludeConfig"); ?>: 
            </td>
            <td colspan="3" class="TbFundoClaro">
				<?php 
				$arrCadastroFiltroGenerico11Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "60", "", ",", "", "1"));
				$arrCadastroFiltroGenerico11 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 60);
                ?>
				<?php 
                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico11); $countArray++)
                {
                ?>
                    <div>
                        <?php if(in_array($arrCadastroFiltroGenerico11[$countArray][0], $arrCadastroFiltroGenerico11Selecao)){ ?> 
							- <?php echo $arrCadastroFiltroGenerico11[$countArray][1];?>
                        <?php } ?>
                    </div>
                <?php 
                }
                ?>
            </td>
          </tr>
          <?php } ?>
          
          <?php if($GLOBALS['habilitarCadastroFiltroGenerico12'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico12Nome'], "IncludeConfig"); ?>: 
            </td>
            <td colspan="3" class="TbFundoClaro">
				<?php 
				$arrCadastroFiltroGenerico12Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "61", "", ",", "", "1"));
				$arrCadastroFiltroGenerico12 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 61);
                ?>
				<?php 
                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico12); $countArray++)
                {
                ?>
                    <div>
                        <?php if(in_array($arrCadastroFiltroGenerico12[$countArray][0], $arrCadastroFiltroGenerico12Selecao)){ ?> 
							- <?php echo $arrCadastroFiltroGenerico12[$countArray][1];?>
                        <?php } ?>
                    </div>
                <?php 
                }
                ?>
            </td>
          </tr>
          <?php } ?>

          <?php if($GLOBALS['habilitarCadastroFiltroGenerico13'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico13Nome'], "IncludeConfig"); ?>: 
            </td>
            <td colspan="3" class="TbFundoClaro">
				<?php 
				$arrCadastroFiltroGenerico13Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "62", "", ",", "", "1"));
				$arrCadastroFiltroGenerico13 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 62);
                ?>
				<?php 
                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico13); $countArray++)
                {
                ?>
                    <div>
                        <?php if(in_array($arrCadastroFiltroGenerico13[$countArray][0], $arrCadastroFiltroGenerico13Selecao)){ ?> 
							- <?php echo $arrCadastroFiltroGenerico13[$countArray][1];?>
                        <?php } ?>
                    </div>
                <?php 
                }
                ?>
            </td>
          </tr>
          <?php } ?>

          <?php if($GLOBALS['habilitarCadastroFiltroGenerico14'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico14Nome'], "IncludeConfig"); ?>: 
            </td>
            <td colspan="3" class="TbFundoClaro">
				<?php 
				$arrCadastroFiltroGenerico14Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "63", "", ",", "", "1"));
				$arrCadastroFiltroGenerico14 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 63);
                ?>
				<?php 
                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico14); $countArray++)
                {
                ?>
                    <div>
                        <?php if(in_array($arrCadastroFiltroGenerico14[$countArray][0], $arrCadastroFiltroGenerico14Selecao)){ ?> 
							- <?php echo $arrCadastroFiltroGenerico14[$countArray][1];?>
                        <?php } ?>
                    </div>
                <?php 
                }
                ?>
            </td>
          </tr>
          <?php } ?>

          <?php if($GLOBALS['habilitarCadastroFiltroGenerico15'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico15Nome'], "IncludeConfig"); ?>: 
            </td>
            <td colspan="3" class="TbFundoClaro">
				<?php 
				$arrCadastroFiltroGenerico15Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "64", "", ",", "", "1"));
				$arrCadastroFiltroGenerico15 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 64);
                ?>
				<?php 
                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico15); $countArray++)
                {
                ?>
                    <div>
                        <?php if(in_array($arrCadastroFiltroGenerico15[$countArray][0], $arrCadastroFiltroGenerico15Selecao)){ ?> 
							- <?php echo $arrCadastroFiltroGenerico15[$countArray][1];?>
                        <?php } ?>
                    </div>
                <?php 
                }
                ?>
            </td>
          </tr>
          <?php } ?>

          <?php if($GLOBALS['habilitarCadastroFiltroGenerico16'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico16Nome'], "IncludeConfig"); ?>: 
            </td>
            <td colspan="3" class="TbFundoClaro">
				<?php 
				$arrCadastroFiltroGenerico16Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "65", "", ",", "", "1"));
				$arrCadastroFiltroGenerico16 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 65);
                ?>
				<?php 
                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico16); $countArray++)
                {
                ?>
                    <div>
                        <?php if(in_array($arrCadastroFiltroGenerico16[$countArray][0], $arrCadastroFiltroGenerico16Selecao)){ ?> 
							- <?php echo $arrCadastroFiltroGenerico16[$countArray][1];?>
                        <?php } ?>
                    </div>
                <?php 
                }
                ?>
            </td>
          </tr>
          <?php } ?>

          <?php if($GLOBALS['habilitarCadastroFiltroGenerico17'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico17Nome'], "IncludeConfig"); ?>: 
            </td>
            <td colspan="3" class="TbFundoClaro">
				<?php 
				$arrCadastroFiltroGenerico17Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "66", "", ",", "", "1"));
				$arrCadastroFiltroGenerico17 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 66);
                ?>
				<?php 
                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico17); $countArray++)
                {
                ?>
                    <div>
                        <?php if(in_array($arrCadastroFiltroGenerico17[$countArray][0], $arrCadastroFiltroGenerico17Selecao)){ ?> 
							- <?php echo $arrCadastroFiltroGenerico17[$countArray][1];?>
                        <?php } ?>
                    </div>
                <?php 
                }
                ?>
            </td>
          </tr>
          <?php } ?>

          <?php if($GLOBALS['habilitarCadastroFiltroGenerico18'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico18Nome'], "IncludeConfig"); ?>: 
            </td>
            <td colspan="3" class="TbFundoClaro">
				<?php 
					$arrCadastroFiltroGenerico18Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "67", "", ",", "", "1"));
                    $arrCadastroFiltroGenerico18 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 67);
                ?>
				<?php 
                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico18); $countArray++)
                {
                ?>
                    <div>
                        <?php if(in_array($arrCadastroFiltroGenerico18[$countArray][0], $arrCadastroFiltroGenerico18Selecao)){ ?> 
							- <?php echo $arrCadastroFiltroGenerico18[$countArray][1];?>
                        <?php } ?>
                    </div>
                <?php 
                }
                ?>
            </td>
          </tr>
          <?php } ?>

          <?php if($GLOBALS['habilitarCadastroFiltroGenerico19'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico19Nome'], "IncludeConfig"); ?>: 
            </td>
            <td colspan="3" class="TbFundoClaro">
				<?php 
					$arrCadastroFiltroGenerico19Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "68", "", ",", "", "1"));
                    $arrCadastroFiltroGenerico19 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 68);
                ?>
				<?php 
                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico19); $countArray++)
                {
                ?>
                    <div>
                        <?php if(in_array($arrCadastroFiltroGenerico19[$countArray][0], $arrCadastroFiltroGenerico19Selecao)){ ?> 
							- <?php echo $arrCadastroFiltroGenerico19[$countArray][1];?>
                        <?php } ?>
                    </div>
                <?php 
                }
                ?>
            </td>
          </tr>
          <?php } ?>

          <?php if($GLOBALS['habilitarCadastroFiltroGenerico20'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico20Nome'], "IncludeConfig"); ?>: 
            </td>
            <td colspan="3" class="TbFundoClaro">
				<?php 
					$arrCadastroFiltroGenerico20Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "69", "", ",", "", "1"));
                    $arrCadastroFiltroGenerico20 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 69);
                ?>
				<?php 
                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico20); $countArray++)
                {
                ?>
                    <div>
                        <?php if(in_array($arrCadastroFiltroGenerico20[$countArray][0], $arrCadastroFiltroGenerico20Selecao)){ ?> 
							- <?php echo $arrCadastroFiltroGenerico20[$countArray][1];?>
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
            <td class="TbFundoMedio TabelaColuna01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroAltura"); ?>:
            </td>
            <td class="TbFundoClaro">
                <?php echo $tbCadastroAltura; ?>
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroAlturaMedida"); ?>
            </td>
            <td class="TbFundoMedio TabelaColuna01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroPeso"); ?>:
            </td>
            <td class="TbFundoClaro">
                <?php echo $tbCadastroPeso; ?>
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroPesoMedida"); ?>
            </td>
          </tr>
          <?php } ?>
    
          <?php if($GLOBALS['habilitarCadastroRazaoSocial'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroRazaoSocial"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
                <?php echo $tbCadastroRazaoSocial; ?>
            </td>
          </tr>
          <?php } ?>
    
          <?php if($GLOBALS['habilitarCadastroNomeFantasia'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroNomeFantasia"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
                <?php echo $tbCadastroNomeFantasia; ?>
            </td>
          </tr>
          <?php } ?>
    
          <tr>
            <?php if($GLOBALS['habilitarCadastroDataNascimento'] == 1){ ?>
            <td class="TbFundoMedio TabelaColuna01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroDataNascimento"); ?>:
            </td>
            <td class="TbFundoClaro">
                <?php echo $tbCadastroDataNascimento; ?>
            </td>
            <?php } ?>
            <td class="TbFundoMedio TabelaColuna01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroDataCadastro"); ?>:
            </td>
            <td class="TbFundoClaro"<?php if($GLOBALS['habilitarCadastroDataNascimento'] <> 1){ ?> colspan="3"<?php } ?>>
                <?php echo $tbCadastroDataCadastro; ?>
            </td>
          </tr>
		  
          <?php if($GLOBALS['habilitarCadastroData1'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData1'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
                <?php echo $tbCadastroData1; ?>
            </td>
          </tr>
          <?php } ?>
          
          <?php if($GLOBALS['habilitarCadastroData2'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData2'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
                <?php echo $tbCadastroData2; ?>
            </td>
          </tr>
          <?php } ?>

          <?php if($GLOBALS['habilitarCadastroData3'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData3'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
                <?php echo $tbCadastroData3; ?>
            </td>
          </tr>
          <?php } ?>

          <?php if($GLOBALS['habilitarCadastroData4'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData4'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
                <?php echo $tbCadastroData4; ?>
            </td>
          </tr>
          <?php } ?>

          <?php if($GLOBALS['habilitarCadastroData5'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData5'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
                <?php echo $tbCadastroData5; ?>
            </td>
          </tr>
          <?php } ?>

          <?php if($GLOBALS['habilitarCadastroData6'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData6'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
                <?php echo $tbCadastroData6; ?>
            </td>
          </tr>
          <?php } ?>

          <?php if($GLOBALS['habilitarCadastroData7'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData7'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
                <?php echo $tbCadastroData7; ?>
            </td>
          </tr>
          <?php } ?>

          <?php if($GLOBALS['habilitarCadastroData8'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData8'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
                <?php echo $tbCadastroData8; ?>
            </td>
          </tr>
          <?php } ?>

          <?php if($GLOBALS['habilitarCadastroData9'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData9'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
                <?php echo $tbCadastroData9; ?>
            </td>
          </tr>
          <?php } ?>

          <?php if($GLOBALS['habilitarCadastroData10'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData10'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
                <?php echo $tbCadastroData10; ?>
            </td>
          </tr>
          <?php } ?>
    
          <?php if($GLOBALS['habilitarCadastroCPFRG'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroCPF"); ?>:
            </td>
            <td class="TbFundoClaro">
                <?php echo $tbCadastroCPF; ?>
            </td>
            <td class="TbFundoMedio TabelaColuna01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroRG"); ?>:
            </td>
            <td class="TbFundoClaro">
                <?php echo $tbCadastroRG; ?>
            </td>
          </tr>
          <?php } ?>
    
          <?php if($GLOBALS['habilitarCadastroCNPJ'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroCNPJ"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
                <?php echo $tbCadastroCNPJ; ?>
            </td>
          </tr>
          <?php } ?>
    
          <?php if($GLOBALS['habilitarCadastroDocumento'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroCNPJ"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
            	<?php echo $tbCadastroDocumento; ?>
            </td>
          </tr>
          <?php } ?>
    
          <?php if($GLOBALS['habilitarCadastroIEstadualIMunicipal'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroInscricaoMunicipal"); ?>:
            </td>
            <td class="TbFundoClaro">
            	<?php echo $tbCadastroIMunicipal; ?>
            </td>
            <td class="TbFundoMedio TabelaColuna01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroInscricaoEstadual"); ?>:
            </td>
            <td class="TbFundoClaro">
            	<?php echo $tbCadastroIEstadual; ?>
            </td>
          </tr>
          <?php } ?>
    
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroEnderecoPrincipal"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
            	<?php echo $tbCadastroEnderecoPrincipal; ?>
            </td>
          </tr>
    
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroEnderecoNumeroPrincipal"); ?>:
            </td>
            <td class="TbFundoClaro">
            	<?php echo $tbCadastroEnderecoNumeroPrincipal; ?>
            </td>
            <td class="TbFundoMedio TabelaColuna01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroEnderecoComplementoPrincipal"); ?>:
            </td>
            <td class="TbFundoClaro">
            	<?php echo $tbCadastroEnderecoComplementoPrincipal; ?>
            </td>
          </tr>
    
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroBairroPrincipal"); ?>:
            </td>
            <td class="TbFundoClaro">
            	<?php echo $tbCadastroBairroPrincipal; ?>
            </td>
            <td class="TbFundoMedio TabelaColuna01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroCidadePrincipal"); ?>:
            </td>
            <td class="TbFundoClaro">
            	<?php echo $tbCadastroCidadePrincipal; ?>
            </td>
          </tr>
    
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroEstadoPrincipal"); ?>:
            </td>
            <td class="TbFundoClaro">
            	<?php echo $tbCadastroEstadoPrincipal; ?>
            </td>
            <td class="TbFundoMedio TabelaColuna01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroPaisPrincipal"); ?>:
            </td>
            <td class="TbFundoClaro">
            	<?php echo $tbCadastroPaisPrincipal; ?>
            </td>
          </tr>
    
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroCEPPrincipal"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
            	<?php echo $tbCadastroCepPrincipal; ?>
            </td>
          </tr>
    
          <?php if($GLOBALS['habilitarCadastroPontoReferencia'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroPontoReferencia"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
            	<?php echo $tbCadastroPontoReferencia; ?>
            </td>
          </tr>
          <?php } ?>
    
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroEmailPrincipal"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
            	<a href="mailto:<?php echo $tbCadastroEmailPrincipal; ?>" class="Links01">
					<?php echo $tbCadastroEmailPrincipal; ?>
                </a>
            </td>
          </tr>
    
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroTel"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
            	<?php if(!empty($tbCadastroTelDDDPrincipal)){ ?>(<?php echo $tbCadastroTelDDDPrincipal; ?>)<?php } ?> 
                <?php echo $tbCadastroTelPrincipal; ?>
            </td>
          </tr>
    
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroCel"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
            	<?php if(!empty($tbCadastroCelDDDPrincipal)){ ?>(<?php echo $tbCadastroCelDDDPrincipal; ?>)<?php } ?> 
                <?php echo $tbCadastroCelPrincipal; ?>
            </td>
          </tr>
    
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroFax"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
            	<?php if(!empty($tbCadastroFaxDDDPrincipal)){ ?>(<?php echo $tbCadastroFaxDDDPrincipal; ?>)<?php } ?> 
                <?php echo $tbCadastroFaxPrincipal; ?>
            </td>
          </tr>
    
          <?php if($GLOBALS['habilitarCadastroSite'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroSitePrincipal"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
            	<a href="<?php echo $tbCadastroSitePrincipal; ?>" class="Links01" target="_blank">
					<?php echo $tbCadastroSitePrincipal; ?>
                </a>
            </td>
          </tr>
          <?php } ?>
    
          <?php if($GLOBALS['habilitarCadastroNFuncionarios'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroNFuncionarios"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
                <?php echo $tbCadastroNFuncionarios; ?>
            </td>
          </tr>
          <?php } ?>
    
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroObs"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
                <?php echo $tbCadastroOBSInterno; ?>
            </td>
          </tr>
          
          <?php if($GLOBALS['habilitarCadastroVinculo1'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroVinculo1Nome'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
            	<a href="CadastroAdministrar.php?idTbCadastro=<?php echo $tbCadastroIdTbCadastro1; ?>" target="_blank" class="Links01"> 
					<?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($tbCadastroIdTbCadastro1, "tb_cadastro", "nome"), DbFuncoes::GetCampoGenerico01($tbCadastroIdTbCadastro1, "tb_cadastro", "razao_social"), DbFuncoes::GetCampoGenerico01($tbCadastroIdTbCadastro1, "tb_cadastro", "nome_fantasia"), 1)); ?>
                </a>
            </td>
          </tr>
          <?php } ?>
          <?php if($GLOBALS['habilitarCadastroVinculo2'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroVinculo2Nome'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
            	<a href="CadastroAdministrar.php?idTbCadastro=<?php echo $tbCadastroIdTbCadastro2; ?>" target="_blank" class="Links01"> 
					<?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($tbCadastroIdTbCadastro2, "tb_cadastro", "nome"), DbFuncoes::GetCampoGenerico01($tbCadastroIdTbCadastro2, "tb_cadastro", "razao_social"), DbFuncoes::GetCampoGenerico01($tbCadastroIdTbCadastro2, "tb_cadastro", "nome_fantasia"), 1)); ?>
                </a>
            </td>
          </tr>
          <?php } ?>
          <?php if($GLOBALS['habilitarCadastroVinculo3'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroVinculo3Nome'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
            	<a href="CadastroAdministrar.php?idTbCadastro=<?php echo $tbCadastroIdTbCadastro3; ?>" target="_blank" class="Links01"> 
					<?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($tbCadastroIdTbCadastro3, "tb_cadastro", "nome"), DbFuncoes::GetCampoGenerico01($tbCadastroIdTbCadastro3, "tb_cadastro", "razao_social"), DbFuncoes::GetCampoGenerico01($tbCadastroIdTbCadastro3, "tb_cadastro", "nome_fantasia"), 1)); ?>
                </a>
            </td>
          </tr>
          <?php } ?>
    
          <?php if($GLOBALS['habilitarCadastroStatus'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroStatus"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
                <?php echo $tbCadastroIdTbCadastroStatus_print; ?>
            </td>
          </tr>
          <?php } ?>
    
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao3"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
                <?php echo $tbCadastroAtivacao_print; ?>
            </td>
          </tr>
    
          <?php if($GLOBALS['habilitarCadastroAtivacaoMalaDireta'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroAtivacaoMalaDireta"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
                <?php echo $tbCadastroAtivacaoMalaDireta_print; ?>
            </td>
          </tr>
          <?php } ?>
    
          <?php if($GLOBALS['habilitarCadastroUsuario'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroUsuario"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
                <?php echo $tbCadastroUsuario; ?>
            </td>
          </tr>
          <?php } ?>
    
          <?php if($GLOBALS['habilitarCadastroSenha'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroSenha"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
                <?php echo $tbCadastroSenha; ?>
            </td>
          </tr>
          <?php } ?>
    
          <?php if($GLOBALS['habilitarCadastroImagem'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemImagem"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
            	<img src="<?php echo $GLOBALS['configDiretorioArquivos'];?>/r<?php echo $tbCadastroImagem; ?>?variavelCache=<?php echo date("s"); ?>" alt="<?php echo $tbCadastroImagem; ?>" />
            
            	<table style="display: none;">
                	<tr>
						<?php if(!empty($tbCadastroImagem)){ //if($tbCategoriasImagem <> ""){?>
                        <td width="1">
                            <img src="<?php echo $GLOBALS['configDiretorioArquivos'];?>/r<?php echo $tbCadastroImagem; ?>?variavelCache=<?php echo date("s"); ?>" alt="<?php echo $tbCadastroImagem; ?>" style="margin-left: 4px;" />
                        </td>
                        <td>
                            <a href="RegistrosArquivosExcluirExe.php?idRegistro=<?php echo $tbCadastroId;?>&strTabela=tb_cadastro&strCampo=imagem<?php echo $queryPadrao;?>" class="LinksExcluir01" style="margin-left: 4px;">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemImagemExcluir"); ?>
                            </a>
                        </td>
                        <?php } ?>
                    </tr>
                </table>
            </td>
          </tr>
          <?php } ?>
    
          <?php if($GLOBALS['habilitarCadastroLogo'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroLogo"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">


            </td>
          </tr>
          <?php } ?>
    
          <?php if($GLOBALS['habilitarCadastroBanner'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroBanner"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">


            </td>
          </tr>
          <?php } ?>
    
          <?php if($GLOBALS['habilitarCadastroMapa'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroMapaImagem"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">


            </td>
          </tr>
          <?php } ?>
    
          <?php if($GLOBALS['habilitarCadastroMapaOnline'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroMapaImagem"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
                <?php echo $tbCadastroMapaOnline; ?>
            </td>
          </tr>
          <?php } ?>
    
          <?php if($GLOBALS['habilitarCadastroApresentacao'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroApresentacao"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
                <?php echo $tbCadastroApresentacao; ?>
            </td>
          </tr>
          <?php } ?>
    
          <?php if($GLOBALS['habilitarCadastroServicos'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroServicos"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
                <?php echo $tbCadastroServicos; ?>
            </td>
          </tr>
          <?php } ?>
    
          <?php if($GLOBALS['HabilitarCadastroPromocoes'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroPromocoes"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
                <?php echo $tbCadastroPromocoes; ?>
            </td>
          </tr>
          <?php } ?>
    
          <?php if($GLOBALS['habilitarCadastroCondicoesComerciais'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroCondicoesComerciais"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
                <?php echo $tbCadastroCondicoesComerciais; ?>
            </td>
          </tr>
          <?php } ?>
    
          <?php if($GLOBALS['habilitarCadastroFormasPagamento'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroFormasPagamento"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
                <?php echo $tbCadastroFormasPagamento; ?>
            </td>
          </tr>
          <?php } ?>
          
          <?php if($GLOBALS['habilitarCadastroHorarioAtendimento'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroHorarioAtendimento"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
                <?php echo $tbCadastroHorarioAtendimento; ?>
            </td>
          </tr>
          <?php } ?>
    
          <?php if($GLOBALS['habilitarCadastroSituacaoAtual'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroSituacaoAtual"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
                <?php echo $tbCadastroSituacaoAtual; ?>
            </td>
          </tr>
          <?php } ?>
    
          <?php if($GLOBALS['habilitarCadastroIc1'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc1'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
                <?php echo $tbCadastroIC1; ?>
            </td>
          </tr>
          <?php } ?>
    
          <?php if($GLOBALS['habilitarCadastroIc2'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc2'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
                <?php echo $tbCadastroIC2; ?>
            </td>
          </tr>
          <?php } ?>
          
          <?php if($GLOBALS['habilitarCadastroIc3'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc3'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
                <?php echo $tbCadastroIC3; ?>
            </td>
          </tr>
          <?php } ?>
          
          <?php if($GLOBALS['habilitarCadastroIc4'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc4'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
                <?php echo $tbCadastroIC4; ?>
            </td>
          </tr>
          <?php } ?>
          
          <?php if($GLOBALS['habilitarCadastroIc5'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc5'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
                <?php echo $tbCadastroIC5; ?>
            </td>
          </tr>
          <?php } ?>
          
          <?php if($GLOBALS['habilitarCadastroIc6'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc6'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
                <?php echo $tbCadastroIC6; ?>
            </td>
          </tr>
          <?php } ?>
          
          <?php if($GLOBALS['habilitarCadastroIc7'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc7'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
                <?php echo $tbCadastroIC7; ?>
            </td>
          </tr>
          <?php } ?>
          
          <?php if($GLOBALS['habilitarCadastroIc8'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc8'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
                <?php echo $tbCadastroIC8; ?>
            </td>
          </tr>
          <?php } ?>
          
          <?php if($GLOBALS['habilitarCadastroIc9'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc9'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
                <?php echo $tbCadastroIC9; ?>
            </td>
          </tr>
          <?php } ?>
          
          <?php if($GLOBALS['habilitarCadastroIc10'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc10'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
                <?php echo $tbCadastroIC10; ?>
            </td>
          </tr>
          <?php } ?>
          
          <?php if($GLOBALS['habilitarCadastroIc11'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc11'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
                <?php echo $tbCadastroIC11; ?>
            </td>
          </tr>
          <?php } ?>
    
          <?php if($GLOBALS['habilitarCadastroIc12'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc12'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
                <?php echo $tbCadastroIC12; ?>
            </td>
          </tr>
          <?php } ?>
          
          <?php if($GLOBALS['habilitarCadastroIc13'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc13'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
                <?php echo $tbCadastroIC13; ?>
            </td>
          </tr>
          <?php } ?>
          
          <?php if($GLOBALS['habilitarCadastroIc14'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc14'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
                <?php echo $tbCadastroIC14; ?>
            </td>
          </tr>
          <?php } ?>
          
          <?php if($GLOBALS['habilitarCadastroIc15'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc15'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
                <?php echo $tbCadastroIC15; ?>
            </td>
          </tr>
          <?php } ?>
          
          <?php if($GLOBALS['habilitarCadastroIc16'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc16'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
                <?php echo $tbCadastroIC16; ?>
            </td>
          </tr>
          <?php } ?>
          
          <?php if($GLOBALS['habilitarCadastroIc17'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc17'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
                <?php echo $tbCadastroIC17; ?>
            </td>
          </tr>
          <?php } ?>
          
          <?php if($GLOBALS['habilitarCadastroIc18'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc18'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
                <?php echo $tbCadastroIC18; ?>
            </td>
          </tr>
          <?php } ?>
          
          <?php if($GLOBALS['habilitarCadastroIc19'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc19'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
                <?php echo $tbCadastroIC19; ?>
            </td>
          </tr>
          <?php } ?>
          
          <?php if($GLOBALS['habilitarCadastroIc20'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc20'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
                <?php echo $tbCadastroIC20; ?>
            </td>
          </tr>
          <?php } ?>
          
          <?php if($GLOBALS['habilitarCadastroIc31'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc31'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
                <?php echo $tbCadastroIC31; ?>
            </td>
          </tr>
          <?php } ?>
    
          <?php if($GLOBALS['habilitarCadastroIc32'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc32'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
                <?php echo $tbCadastroIC32; ?>
            </td>
          </tr>
          <?php } ?>
          
          <?php if($GLOBALS['habilitarCadastroIc33'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc33'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
                <?php echo $tbCadastroIC33; ?>
            </td>
          </tr>
          <?php } ?>
          
          <?php if($GLOBALS['habilitarCadastroIc34'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc34'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
                <?php echo $tbCadastroIC34; ?>
            </td>
          </tr>
          <?php } ?>
          
          <?php if($GLOBALS['habilitarCadastroIc35'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc35'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
                <?php echo $tbCadastroIC35; ?>
            </td>
          </tr>
          <?php } ?>
          
          <?php if($GLOBALS['habilitarCadastroIc36'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc36'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
                <?php echo $tbCadastroIC36; ?>
            </td>
          </tr>
          <?php } ?>
          
          <?php if($GLOBALS['habilitarCadastroIc37'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc37'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
                <?php echo $tbCadastroIC37; ?>
            </td>
          </tr>
          <?php } ?>
          
          <?php if($GLOBALS['habilitarCadastroIc38'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc38'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
                <?php echo $tbCadastroIC38; ?>
            </td>
          </tr>
          <?php } ?>
          
          <?php if($GLOBALS['habilitarCadastroIc39'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc39'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
                <?php echo $tbCadastroIC39; ?>
            </td>
          </tr>
          <?php } ?>
          
          <?php if($GLOBALS['habilitarCadastroIc40'] == 1){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc40'], "IncludeConfig"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
                <?php echo $tbCadastroIC40; ?>
            </td>
          </tr>
          <?php } ?>
          
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroAdministrarFuncoes"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
                [
                <a href="CadastroEditar.php?idTbCadastro=<?php echo $tbCadastroId;?><?php echo $queryPadrao;?>" class="Links01">
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                </a>
                ]
				<?php if($GLOBALS['habilitarCadastroFotos'] == 1){ ?>
                    [
                    <a href="ArquivosIndice.php?idParent=<?php echo $tbCadastroId;?>&tipoArquivo=1&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo Funcoes::GetCadastroTitulo(Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome']), Funcoes::ConteudoMascaraLeitura($linhaCadastro['razao_social']), Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome_fantasia']), 1);?>&detalhe02=" target="_blank" class="Links01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserirFotos"); ?>
                    </a>
                    ] 
                <?php } ?>
                <?php if($GLOBALS['habilitarCadastroVideos'] == 1){ ?>
                    [
                    <a href="ArquivosIndice.php?idParent=<?php echo $tbCadastroId;?>&tipoArquivo=2&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo Funcoes::GetCadastroTitulo(Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome']), Funcoes::ConteudoMascaraLeitura($linhaCadastro['razao_social']), Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome_fantasia']), 1);?>&detalhe02=" target="_blank" class="Links01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserirVideos"); ?>
                    </a>
                    ] 
                <?php } ?>
                <?php if($GLOBALS['habilitarCadastroArquivos'] == 1){ ?>
                    [
                    <a href="ArquivosIndice.php?idParent=<?php echo $tbCadastroId;?>&tipoArquivo=3&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo Funcoes::GetCadastroTitulo($tbCadastroNome, $tbCadastroRazaoSocial, $tbCadastroNomeFantasia, 1);?>&detalhe02=" target="_blank" class="Links01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserirArquivos"); ?>
                    </a>
                    ] 
                <?php } ?>
                <?php if($GLOBALS['habilitarCadastroZip'] == 1){ ?>
                    [
                    <a href="ArquivosIndice.php?idParent=<?php echo $tbCadastroId;?>&tipoArquivo=4&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo Funcoes::GetCadastroTitulo($tbCadastroNome, $tbCadastroRazaoSocial, $tbCadastroNomeFantasia, 1);?>&detalhe02=" target="_blank" class="Links01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserirZip"); ?>
                    </a>
                    ] 
                <?php } ?>
                <?php if($GLOBALS['habilitarCadastroSwfs'] == 1){ ?>
                    [
                    <a href="ArquivosIndice.php?idParent=<?php echo $tbCadastroId;?>&tipoArquivo=5&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo Funcoes::GetCadastroTitulo($tbCadastroNome, $tbCadastroRazaoSocial, $tbCadastroNomeFantasia, 1);?>&detalhe02=" target="_blank" class="Links01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserirSWFs"); ?>
                    </a>
                    ] 
                <?php } ?>
                
				<?php if($GLOBALS['habilitarCadastroProcessos'] == 1){ ?>
                    [
                    <a href="ProcessosIndice.php?idParentProcessos=<?php echo $tbCadastroId;?>&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo Funcoes::GetCadastroTitulo($tbCadastroNome, $tbCadastroRazaoSocial, $tbCadastroNomeFantasia, 1);?>&detalhe02=" target="_blank" class="Links01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserirProcessos"); ?>
                    </a>
                    ] 
                <?php } ?>
                
				<?php if($GLOBALS['habilitarAdministrarPedidosCobrancaAvulsa'] == 1){ ?>
                    [
                    <a href="CadastroCobrancaAvulsa.php?idTbCadastro=<?php echo $idTbCadastro; ?>&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo Funcoes::GetCadastroTitulo($tbCadastroNome, $tbCadastroRazaoSocial, $tbCadastroNomeFantasia, 1);?>&detalhe02=" target="_blank" class="Links01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroAdministrarPedidosNovoPedido"); ?>
                    </a>
                    ] 
                <?php } ?>
                
				<?php if($GLOBALS['habilitarCadastroOrcamento'] == 1){ ?>
                    [
                    <a href="Orcamento.php?idTbCadastroCliente=<?php echo $idTbCadastro; ?>&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo Funcoes::GetCadastroTitulo($tbCadastroNome, $tbCadastroRazaoSocial, $tbCadastroNomeFantasia, 1);?>&detalhe02=" target="_blank" class="Links01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroAdministrarOrcamentosNovoOrcamento"); ?>
                    </a>
                    ] 
                <?php } ?>
            </td>
          </tr>
          
          <?php if($GLOBALS['ConfigIdCategoriasConteudoModelo'] <> 0){ ?>
          <tr>
            <td class="TbFundoMedio TabelaColuna01">
				<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroConteudoModelos"); ?>:
            </td>
            <td colspan="3" class="TbFundoClaro">
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
                        <a href="../<?php echo $GLOBALS['visualizacaoAtivaSistema'];?>/SiteConteudo.php?idParentConteudo=<?php echo $arrCategoriasConteudoModelo[$countArray][0];?>&idTbCadastro=<?php echo $tbCadastroId;?>&masterPageSiteSelect=LayoutSiteImpressao.php" class="Links01" target="_blank">
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
    
    
	<?php //Comércio eletrônico.?>
	<?php //**************************************************************************************?>
    <?php if($GLOBALS['habilitarAdministrarECommerce'] == 1){ ?>
    <div class="BordaTabela01" style="margin: 20px 0px 0px 0px;">
        <div class="TbFundoEscuro TbFundoTitulo01">
            <div align="center" class="Texto02">
                <strong>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroAdministrarPedidosRealizados"); ?>
                </strong>
            </div>
        </div>
        <div style="height: 500px; width: 100%;">
            <iframe class="TabelaIFrame01" src="PedidosIndice.php?idTbCadastroCliente=<?php echo $idTbCadastro; ?>&masterPageSelect=LayoutSistemaSemMenu.php" scrolling="auto" name="pedidos" frameborder="0" align="left" width="100%" height="100%">
            </iframe>
        </div>
    </div>
	<?php } ?>
	<?php //**************************************************************************************?>
    
    
	<?php //Hitórico.?>
	<?php //**************************************************************************************?>
    <?php if($GLOBALS['habilitarAdministrarCadastroHistorico'] == 1){ ?>
    <div class="BordaTabela01" style="margin: 20px 0px 0px 0px;">
        <div class="TbFundoEscuro TbFundoTitulo01">
            <div align="center" class="Texto02">
                <strong>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoTitulo"); ?>
                </strong>
            </div>
        </div>
        <div style="height: 800px; width: 100%;">
            <iframe class="TabelaIFrame01" src="HistoricoIndice.php?idParent=<?php echo $idTbCadastro; ?>&masterPageSelect=LayoutSistemaSemMenu.php" scrolling="auto" name="historico" frameborder="0" align="left" width="100%" height="100%">
            </iframe>
        </div>
    </div>
	<?php } ?>
	<?php //**************************************************************************************?>
    
    
	<?php //Contato.?>
	<?php //**************************************************************************************?>
    <?php if($GLOBALS['habilitarAdministrarCadastroContatos'] == 1){ ?>
    <div class="BordaTabela01" style="margin: 20px 0px 0px 0px;">
        <div class="TbFundoEscuro TbFundoTitulo01">
            <div align="center" class="Texto02">
                <strong>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaContatosTitulo"); ?>
                </strong>
            </div>
        </div>
        <div style="height: 800px; width: 100%;">
            <iframe class="TabelaIFrame01" src="CadastroContatosIndice.php?idTbCadastro=<?php echo $idTbCadastro; ?>&masterPageSelect=LayoutSistemaSemMenu.php" scrolling="auto" name="contatos" frameborder="0" align="left" width="100%" height="100%">
            </iframe>
        </div>
    </div>
	<?php } ?>
	<?php //**************************************************************************************?>
    
    
	<?php //Endereços.?>
	<?php //**************************************************************************************?>
    <?php if($GLOBALS['habilitarAdministrarCadastroEnderecos'] == 1){ ?>
    <div class="BordaTabela01" style="margin: 20px 0px 0px 0px;">
        <div class="TbFundoEscuro TbFundoTitulo01">
            <div align="center" class="Texto02">
                <strong>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaEnderecosTitulo"); ?>
                </strong>
            </div>
        </div>
        <div style="height: 800px; width: 100%;">
            <iframe class="TabelaIFrame01" src="CadastroEnderecosIndice.php?idTbCadastro=<?php echo $idTbCadastro; ?>&masterPageSelect=LayoutSistemaSemMenu.php" scrolling="auto" name="contatos" frameborder="0" align="left" width="100%" height="100%">
            </iframe>
        </div>
    </div>
	<?php } ?>
	<?php //**************************************************************************************?>

    
	<?php //Contas bancárias.?>
	<?php //**************************************************************************************?>
    <?php if($GLOBALS['habilitarAdministrarCadastroContasBancarias'] == 1){ ?>
    <div class="BordaTabela01" style="margin: 20px 0px 0px 0px;">
        <div class="TbFundoEscuro TbFundoTitulo01">
            <div align="center" class="Texto02">
                <strong>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroContasBancariasTitulo"); ?>
                </strong>
            </div>
        </div>
        <div style="height: 500px; width: 100%;">
            <iframe class="TabelaIFrame01" src="CadastroContasBancariasIndice.php?idTbCadastro=<?php echo $idTbCadastro; ?>&masterPageSelect=LayoutSistemaSemMenu.php" scrolling="auto" name="contasBancarias" frameborder="0" align="left" width="100%" height="100%">
            </iframe>
        </div>
    </div>
	<?php } ?>
	<?php //**************************************************************************************?>
    
    
	<?php //Tarefas.?>
	<?php //**************************************************************************************?>
    <?php if($GLOBALS['habilitarAdministrarCadastroTarefas'] == 1){ ?>
    <div class="BordaTabela01" style="margin: 20px 0px 0px 0px;">
        <div class="TbFundoEscuro TbFundoTitulo01">
            <div align="center" class="Texto02">
                <strong>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaTarefasTitulo"); ?>
                </strong>
            </div>
        </div>
        <div style="height: 800px; width: 100%;">
            <iframe class="TabelaIFrame01" src="TarefasIndice.php?idParent=<?php echo $idTbCadastro; ?>&masterPageSelect=LayoutSistemaSemMenu.php" scrolling="auto" name="tarefas" frameborder="0" align="left" width="100%" height="100%">
            </iframe>
        </div>
    </div>
	<?php } ?>
	<?php //**************************************************************************************?>
    
    
	<?php //Processos.?>
	<?php //**************************************************************************************?>
    <?php if($GLOBALS['habilitarCadastroProcessos'] == 1){ ?>
    <div class="BordaTabela01" style="margin: 20px 0px 0px 0px;">
        <div class="TbFundoEscuro TbFundoTitulo01">
            <div align="center" class="Texto02">
                <strong>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaProcesso"); ?>
                </strong>
            </div>
        </div>
        <div style="height: 500px; width: 100%;">
            <iframe class="TabelaIFrame01" src="ProcessosIndice.php?idParentProcessos=<?php echo $idTbCadastro; ?>&masterPageSelect=LayoutSistemaSemMenu.php" scrolling="auto" name="pedidos" frameborder="0" align="left" width="100%" height="100%">
            </iframe>
        </div>
    </div>
	<?php } ?>
	<?php //**************************************************************************************?>
<?php 
$page->cphConteudoPrincipal = ob_get_clean(); 
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
?>


<?php 
//Inclusão do template do layout.
include_once $page->LayoutSistema;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>