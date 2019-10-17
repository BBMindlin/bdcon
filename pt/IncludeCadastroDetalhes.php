<?php
//Definição de variáveis.
$IdTbCadastro = $includeCadastroDetalhes_idTbCadastro;
$ConfigTipoDiagramacao = $includeCadastro_configTipoDiagramacao; //1 - Resumido | 2 - ADM | 3 - Resumo e Configurações

$idTbCadastroUsuarioLogado = "";
$dataAtual = date("Y") . "-" . date("m") . "-" . date("d");


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
//----------


//Componentes.
//----------
$statementCadastroDetalhesSelect = $dbSistemaConPDO->prepare($strSqlCadastroDetalhesSelect);

if ($statementCadastroDetalhesSelect !== false)
{
	$statementCadastroDetalhesSelect->execute(array(
		"id" => $IdTbCadastro
	));
}

//$resultadoCadastroDetalhes = $dbSistemaConPDO->query($strSqlCadastroDetalhesSelect);
$resultadoCadastroDetalhes = $statementCadastroDetalhesSelect->fetchAll();
//----------


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
		//if($GLOBALS['configSiteFormatoData'] == "1"){
			//$tbCadastroDataNascimento = date("d",strtotime($linhaCadastroDetalhes['data_nascimento'])) . "/" . date("m",strtotime($linhaCadastroDetalhes['data_nascimento'])) . "/" . date("y",strtotime($linhaCadastroDetalhes['data_nascimento']));
		//}
		//if($GLOBALS['configSiteFormatoData'] == "2"){
			//$tbCadastroDataNascimento = date("m",strtotime($linhaCadastroDetalhes['data_nascimento'])) . "/" . date("d",strtotime($linhaCadastroDetalhes['data_nascimento'])) . "/" . date("y",strtotime($linhaCadastroDetalhes['data_nascimento']));
		//}
		$tbCadastroDataNascimento = Funcoes::DataLeitura01($linhaCadastroDetalhes['data_nascimento'], $GLOBALS['configSiteFormatoData'], "1");
		if($tbCadastroDataNascimento <> "")
		{
			$tbCadastroIdade = Funcoes::DataIntervalo02("y", $linhaCadastroDetalhes['data_nascimento'], $dataAtual);
		}

		$tbCadastroCPF = $linhaCadastroDetalhes['cpf_'];
		$tbCadastroCPF_print = Funcoes::FormatarValorGenericoLer($linhaCadastroDetalhes['cpf_'], "cpf");
		$tbCadastroRG = $linhaCadastroDetalhes['rg_'];
		$tbCadastroCNPJ = $linhaCadastroDetalhes['cnpj_'];
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
		$tbCadastroCepPrincipal = $linhaCadastroDetalhes['cep_principal'];
		$tbCadastroCepPrincipal_print = Funcoes::FormatarValorGenericoLer($linhaCadastroDetalhes['cep_principal'], "cep");

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
		$tbCadastroAtivacao_print = "";
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

<?php if(!empty($resultadoCadastroDetalhes)){?>
	<?php //Diagramação 1 (Cadastro Detalhes).?>
    <?php //**************************************************************************************?>
    <?php if($ConfigTipoDiagramacao == "1"){ ?>
        <div class="CadastroTitulos">
            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteImoveisInformacoesContato"); ?>
        </div>
    
    	<div class="CadastroDetalhesConteudo" style="position: relative; display: block;">
            <table border="0" cellspacing="4" cellpadding="0">
        
              <?php if($GLOBALS['habilitarCadastroTipo'] == 1){ ?>
              <tr>
                <td>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroTipoCadastro"); ?>:
                </td>
                <td colspan="3">
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
                <td>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroAtividades"); ?>:
                </td>
                <td colspan="3">
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
                <td>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroNome"); ?>:
                </td>
                <td colspan="3">
                    <?php echo $tbCadastroNome; ?>
                </td>
              </tr>
        
              <?php if($GLOBALS['habilitarCadastroSexo'] == 1 || $GLOBALS['habilitarCadastroPfPj'] == 1){ ?>
              <tr>
                <?php if($GLOBALS['habilitarCadastroSexo'] == 1){ ?>
                <td>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroSexo"); ?>:
                </td>
                <td>
                    <?php echo $tbCadastroSexo_print; ?>
                </td>
                <?php } ?>
                <?php if($GLOBALS['habilitarCadastroPfPj'] == 1){ ?>
                <td>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroPfPj"); ?>:
                </td>
                <td>
                    <?php echo $tbCadastroPfPj_print; ?>
                </td>
                <?php } ?>
              </tr>
              <?php } ?>
        
              <?php if($GLOBALS['habilitarCadastroFiltroGenerico01'] == 1){ ?>
              <tr>
                <td>
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico01Nome'], "IncludeConfig"); ?>: 
                </td>
                <td colspan="3">
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
                <td>
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico02Nome'], "IncludeConfig"); ?>: 
                </td>
                <td colspan="3">
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
                <td>
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico03Nome'], "IncludeConfig"); ?>: 
                </td>
                <td colspan="3">
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
                <td>
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico04Nome'], "IncludeConfig"); ?>: 
                </td>
                <td colspan="3">
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
                <td>
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico05Nome'], "IncludeConfig"); ?>: 
                </td>
                <td colspan="3">
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
                <td>
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico06Nome'], "IncludeConfig"); ?>: 
                </td>
                <td colspan="3">
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
                <td>
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico07Nome'], "IncludeConfig"); ?>: 
                </td>
                <td colspan="3">
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
                <td>
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico08Nome'], "IncludeConfig"); ?>: 
                </td>
                <td colspan="3">
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
                <td>
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico09Nome'], "IncludeConfig"); ?>: 
                </td>
                <td colspan="3">
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
                <td>
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico10Nome'], "IncludeConfig"); ?>: 
                </td>
                <td colspan="3">
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
                <td>
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico11Nome'], "IncludeConfig"); ?>: 
                </td>
                <td colspan="3">
                    <?php 
                    $arrCadastroFiltroGenerico11Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "22", "", ",", "", "1"));
                    $arrCadastroFiltroGenerico11 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 22);
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
                <td>
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico12Nome'], "IncludeConfig"); ?>: 
                </td>
                <td colspan="3">
                    <?php 
                    $arrCadastroFiltroGenerico12Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "23", "", ",", "", "1"));
                    $arrCadastroFiltroGenerico12 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 23);
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
                <td>
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico13Nome'], "IncludeConfig"); ?>: 
                </td>
                <td colspan="3">
                    <?php 
                    $arrCadastroFiltroGenerico13Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "24", "", ",", "", "1"));
                    $arrCadastroFiltroGenerico13 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 24);
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
                <td>
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico14Nome'], "IncludeConfig"); ?>: 
                </td>
                <td colspan="3">
                    <?php 
                    $arrCadastroFiltroGenerico14Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "25", "", ",", "", "1"));
                    $arrCadastroFiltroGenerico14 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 25);
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
                <td>
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico15Nome'], "IncludeConfig"); ?>: 
                </td>
                <td colspan="3">
                    <?php 
                    $arrCadastroFiltroGenerico15Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "26", "", ",", "", "1"));
                    $arrCadastroFiltroGenerico15 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 26);
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
                <td>
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico16Nome'], "IncludeConfig"); ?>: 
                </td>
                <td colspan="3">
                    <?php 
                    $arrCadastroFiltroGenerico16Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "27", "", ",", "", "1"));
                    $arrCadastroFiltroGenerico16 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 27);
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
                <td>
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico17Nome'], "IncludeConfig"); ?>: 
                </td>
                <td colspan="3">
                    <?php 
                    $arrCadastroFiltroGenerico17Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "28", "", ",", "", "1"));
                    $arrCadastroFiltroGenerico17 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 28);
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
                <td>
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico18Nome'], "IncludeConfig"); ?>: 
                </td>
                <td colspan="3">
                    <?php 
					$arrCadastroFiltroGenerico18Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "29", "", ",", "", "1"));
					$arrCadastroFiltroGenerico18 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 29);
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
                <td>
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico19Nome'], "IncludeConfig"); ?>: 
                </td>
                <td colspan="3">
                    <?php 
					$arrCadastroFiltroGenerico19Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "30", "", ",", "", "1"));
					$arrCadastroFiltroGenerico19 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 30);
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
                <td>
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico20Nome'], "IncludeConfig"); ?>: 
                </td>
                <td colspan="3">
                    <?php 
					$arrCadastroFiltroGenerico20Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "31", "", ",", "", "1"));
					$arrCadastroFiltroGenerico20 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 31);
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
                <td>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroAltura"); ?>:
                </td>
                <td>
                    <?php echo $tbCadastroAltura; ?>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroAlturaMedida"); ?>
                </td>
                <td>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroPeso"); ?>:
                </td>
                <td>
                    <?php echo $tbCadastroPeso; ?>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroPesoMedida"); ?>
                </td>
              </tr>
              <?php } ?>
        
              <?php if($GLOBALS['habilitarCadastroRazaoSocial'] == 1){ ?>
              <tr>
                <td>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroRazaoSocial"); ?>:
                </td>
                <td colspan="3">
                    <?php echo $tbCadastroRazaoSocial; ?>
                </td>
              </tr>
              <?php } ?>
        
              <?php if($GLOBALS['habilitarCadastroNomeFantasia'] == 1){ ?>
              <tr>
                <td>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroNomeFantasia"); ?>:
                </td>
                <td colspan="3">
                    <?php echo $tbCadastroNomeFantasia; ?>
                </td>
              </tr>
              <?php } ?>
        
              <tr>
                <?php if($GLOBALS['habilitarCadastroDataNascimento'] == 1){ ?>
                <td>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroDataNascimento"); ?>:
                </td>
                <td>
                    <?php echo $tbCadastroDataNascimento; ?>
                </td>
                <?php } ?>
                <td>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroDataCadastro"); ?>:
                </td>
                <td<?php if($GLOBALS['habilitarCadastroDataNascimento'] <> 1){ ?> colspan="3"<?php } ?>>
                    <?php echo $tbCadastroDataCadastro; ?>
                </td>
              </tr>
              
              <?php if($GLOBALS['habilitarCadastroDataNascimento'] == 1){ ?>
				  <?php if($tbCadastroIdade <> ""){ ?>
                  <tr>
                    <td>
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroIdade"); ?>:
                    </td>
                    <td colspan="3">
                        <?php echo $tbCadastroIdade; ?>
                    </td>
                  </tr>
                  <?php } ?>
              <?php } ?>
        
              <?php if($GLOBALS['habilitarCadastroCPFRG'] == 1){ ?>
              <tr>
                <td>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroCPF"); ?>:
                </td>
                <td>
                    <?php echo $tbCadastroCPF; ?>
                </td>
                <td>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroRG"); ?>:
                </td>
                <td>
                    <?php echo $tbCadastroRG; ?>
                </td>
              </tr>
              <?php } ?>
        
              <?php if($GLOBALS['habilitarCadastroCNPJ'] == 1){ ?>
              <tr>
                <td>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroCNPJ"); ?>:
                </td>
                <td colspan="3">
                    <?php echo $tbCadastroCNPJ; ?>
                </td>
              </tr>
              <?php } ?>
        
              <?php if($GLOBALS['habilitarCadastroDocumento'] == 1){ ?>
              <tr>
                <td>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroCNPJ"); ?>:
                </td>
                <td colspan="3">
                    <?php echo $tbCadastroDocumento; ?>
                </td>
              </tr>
              <?php } ?>
        
              <?php if($GLOBALS['habilitarCadastroIEstadualIMunicipal'] == 1){ ?>
              <tr>
                <td>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroInscricaoMunicipal"); ?>:
                </td>
                <td>
                    <?php echo $tbCadastroIMunicipal; ?>
                </td>
                <td>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroInscricaoEstadual"); ?>:
                </td>
                <td>
                    <?php echo $tbCadastroIEstadual; ?>
                </td>
              </tr>
              <?php } ?>
        
              <tr>
                <td>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroEnderecoPrincipal"); ?>:
                </td>
                <td colspan="3">
                    <?php echo $tbCadastroEnderecoPrincipal; ?>
                </td>
              </tr>
        
              <tr>
                <td>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroEnderecoNumeroPrincipal"); ?>:
                </td>
                <td>
                    <?php echo $tbCadastroEnderecoNumeroPrincipal; ?>
                </td>
                <td>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroEnderecoComplementoPrincipal"); ?>:
                </td>
                <td>
                    <?php echo $tbCadastroEnderecoComplementoPrincipal; ?>
                </td>
              </tr>
        
              <tr>
                <td>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroBairroPrincipal"); ?>:
                </td>
                <td>
                    <?php echo $tbCadastroBairroPrincipal; ?>
                </td>
                <td>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroCidadePrincipal"); ?>:
                </td>
                <td>
                    <?php echo $tbCadastroCidadePrincipal; ?>
                </td>
              </tr>
        
              <tr>
                <td>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroEstadoPrincipal"); ?>:
                </td>
                <td>
                    <?php echo $tbCadastroEstadoPrincipal; ?>
                </td>
                <td>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroPaisPrincipal"); ?>:
                </td>
                <td>
                    <?php echo $tbCadastroPaisPrincipal; ?>
                </td>
              </tr>
        
              <tr>
                <td>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroCEPPrincipal"); ?>:
                </td>
                <td colspan="3">
                    <?php echo $tbCadastroCepPrincipal; ?>
                </td>
              </tr>
        
              <?php if($GLOBALS['habilitarCadastroPontoReferencia'] == 1){ ?>
              <tr>
                <td>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroPontoReferencia"); ?>:
                </td>
                <td colspan="3">
                    <?php echo $tbCadastroPontoReferencia; ?>
                </td>
              </tr>
              <?php } ?>
        
              <tr>
                <td>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroEmailPrincipal"); ?>:
                </td>
                <td colspan="3">
                    <a href="mailto:<?php echo $tbCadastroEmailPrincipal; ?>" class="AdmLinks01">
                        <?php echo $tbCadastroEmailPrincipal; ?>
                    </a>
                </td>
              </tr>
        
              <tr>
                <td>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroTel"); ?>:
                </td>
                <td colspan="3">
                    <?php if(!empty($tbCadastroTelDDDPrincipal)){ ?>(<?php echo $tbCadastroTelDDDPrincipal; ?>)<?php } ?> 
                    <?php echo $tbCadastroTelPrincipal; ?>
                </td>
              </tr>
        
              <tr>
                <td>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroCel"); ?>:
                </td>
                <td colspan="3">
                    <?php if(!empty($tbCadastroCelDDDPrincipal)){ ?>(<?php echo $tbCadastroCelDDDPrincipal; ?>)<?php } ?> 
                    <?php echo $tbCadastroCelPrincipal; ?>
                </td>
              </tr>
        
              <tr>
                <td>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroFax"); ?>:
                </td>
                <td colspan="3">
                    <?php if(!empty($tbCadastroFaxDDDPrincipal)){ ?>(<?php echo $tbCadastroFaxDDDPrincipal; ?>)<?php } ?> 
                    <?php echo $tbCadastroFaxPrincipal; ?>
                </td>
              </tr>
        
              <?php if($GLOBALS['habilitarCadastroSite'] == 1){ ?>
              <tr>
                <td>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroSitePrincipal"); ?>:
                </td>
                <td colspan="3">
                    <a href="<?php echo $tbCadastroSitePrincipal; ?>" target="_blank" class="AdmLinks01">
                        <?php echo $tbCadastroSitePrincipal; ?>
                    </a>
                </td>
              </tr>
              <?php } ?>
        
              <?php if($GLOBALS['habilitarCadastroNFuncionarios'] == 1){ ?>
              <tr>
                <td>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroNFuncionarios"); ?>:
                </td>
                <td colspan="3">
                    <?php echo $tbCadastroNFuncionarios; ?>
                </td>
              </tr>
              <?php } ?>
        
              <tr>
                <td>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroObs"); ?>:
                </td>
                <td colspan="3">
                    <?php echo $tbCadastroOBSInterno; ?>
                </td>
              </tr>
              
              <?php if($GLOBALS['habilitarCadastroVinculo1'] == 1){ ?>
              <tr>
                <td>
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroVinculo1Nome'], "IncludeConfig"); ?>:
                </td>
                <td colspan="3">
                    <a href="CadastroAdministrar.php?idTbCadastro=<?php echo $tbCadastroIdTbCadastro1; ?>" target="_blank" class="AdmLinks01"> 
                        <?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($tbCadastroIdTbCadastro1, "tb_cadastro", "nome"), DbFuncoes::GetCampoGenerico01($tbCadastroIdTbCadastro1, "tb_cadastro", "razao_social"), DbFuncoes::GetCampoGenerico01($tbCadastroIdTbCadastro1, "tb_cadastro", "nome_fantasia"), 1)); ?>
                    </a>
                </td>
              </tr>
              <?php } ?>
              <?php if($GLOBALS['habilitarCadastroVinculo2'] == 1){ ?>
              <tr>
                <td>
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroVinculo2Nome'], "IncludeConfig"); ?>:
                </td>
                <td colspan="3">
                    <a href="CadastroAdministrar.php?idTbCadastro=<?php echo $tbCadastroIdTbCadastro2; ?>" target="_blank" class="AdmLinks01"> 
                        <?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($tbCadastroIdTbCadastro2, "tb_cadastro", "nome"), DbFuncoes::GetCampoGenerico01($tbCadastroIdTbCadastro2, "tb_cadastro", "razao_social"), DbFuncoes::GetCampoGenerico01($tbCadastroIdTbCadastro2, "tb_cadastro", "nome_fantasia"), 1)); ?>
                    </a>
                </td>
              </tr>
              <?php } ?>
              <?php if($GLOBALS['habilitarCadastroVinculo3'] == 1){ ?>
              <tr>
                <td>
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroVinculo3Nome'], "IncludeConfig"); ?>:
                </td>
                <td colspan="3">
                    <a href="CadastroAdministrar.php?idTbCadastro=<?php echo $tbCadastroIdTbCadastro3; ?>" target="_blank" class="AdmLinks01"> 
                        <?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($tbCadastroIdTbCadastro3, "tb_cadastro", "nome"), DbFuncoes::GetCampoGenerico01($tbCadastroIdTbCadastro3, "tb_cadastro", "razao_social"), DbFuncoes::GetCampoGenerico01($tbCadastroIdTbCadastro3, "tb_cadastro", "nome_fantasia"), 1)); ?>
                    </a>
                </td>
              </tr>
              <?php } ?>
        
              <?php if($GLOBALS['habilitarCadastroStatus'] == 1){ ?>
              <tr>
                <td>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroStatus"); ?>:
                </td>
                <td colspan="3">
    
    
                </td>
              </tr>
              <?php } ?>
        
              <tr>
                <td>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao3"); ?>:
                </td>
                <td colspan="3">
                    <?php echo $tbCadastroAtivacao_print; ?>
                </td>
              </tr>
        
              <?php if($GLOBALS['habilitarCadastroAtivacaoMalaDireta'] == 1){ ?>
              <tr>
                <td>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroAtivacaoMalaDireta"); ?>:
                </td>
                <td colspan="3">
                    <?php echo $tbCadastroAtivacaoMalaDireta_print; ?>
                </td>
              </tr>
              <?php } ?>
        
              <?php if($GLOBALS['habilitarCadastroUsuario'] == 1){ ?>
              <tr>
                <td>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroUsuario"); ?>:
                </td>
                <td colspan="3">
                    <?php echo $tbCadastroUsuario; ?>
                </td>
              </tr>
              <?php } ?>
        
              <?php if($GLOBALS['habilitarCadastroSenha'] == 1){ ?>
              <tr>
                <td>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroSenha"); ?>:
                </td>
                <td colspan="3">
                    <?php echo $tbCadastroSenha; ?>
                </td>
              </tr>
              <?php } ?>
        
              <?php if($GLOBALS['habilitarCadastroImagem'] == 1){ ?>
              <tr>
                <td>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemImagem"); ?>:
                </td>
                <td colspan="3">
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
                <td>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroLogo"); ?>:
                </td>
                <td colspan="3">
    
    
                </td>
              </tr>
              <?php } ?>
        
              <?php if($GLOBALS['habilitarCadastroBanner'] == 1){ ?>
              <tr>
                <td>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroBanner"); ?>:
                </td>
                <td colspan="3">
    
    
                </td>
              </tr>
              <?php } ?>
        
              <?php if($GLOBALS['habilitarCadastroMapa'] == 1){ ?>
              <tr>
                <td>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroMapaImagem"); ?>:
                </td>
                <td colspan="3">
    
    
                </td>
              </tr>
              <?php } ?>
        
              <?php if($GLOBALS['habilitarCadastroMapaOnline'] == 1){ ?>
              <tr>
                <td>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroMapaImagem"); ?>:
                </td>
                <td colspan="3">
                    <?php echo $tbCadastroMapaOnline; ?>
                </td>
              </tr>
              <?php } ?>
        
              <?php if($GLOBALS['habilitarCadastroApresentacao'] == 1){ ?>
              <tr>
                <td>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroApresentacao"); ?>:
                </td>
                <td colspan="3">
                    <?php echo $tbCadastroApresentacao; ?>
                </td>
              </tr>
              <?php } ?>
        
              <?php if($GLOBALS['habilitarCadastroServicos'] == 1){ ?>
              <tr>
                <td>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroServicos"); ?>:
                </td>
                <td colspan="3">
                    <?php echo $tbCadastroServicos; ?>
                </td>
              </tr>
              <?php } ?>
        
              <?php if($GLOBALS['HabilitarCadastroPromocoes'] == 1){ ?>
              <tr>
                <td>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroPromocoes"); ?>:
                </td>
                <td colspan="3">
                    <?php echo $tbCadastroPromocoes; ?>
                </td>
              </tr>
              <?php } ?>
        
              <?php if($GLOBALS['habilitarCadastroCondicoesComerciais'] == 1){ ?>
              <tr>
                <td>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroCondicoesComerciais"); ?>:
                </td>
                <td colspan="3">
                    <?php echo $tbCadastroCondicoesComerciais; ?>
                </td>
              </tr>
              <?php } ?>
        
              <?php if($GLOBALS['habilitarCadastroFormasPagamento'] == 1){ ?>
              <tr>
                <td>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroFormasPagamento"); ?>:
                </td>
                <td colspan="3">
                    <?php echo $tbCadastroFormasPagamento; ?>
                </td>
              </tr>
              <?php } ?>
              
              <?php if($GLOBALS['habilitarCadastroHorarioAtendimento'] == 1){ ?>
              <tr>
                <td>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroHorarioAtendimento"); ?>:
                </td>
                <td colspan="3">
                    <?php echo $tbCadastroHorarioAtendimento; ?>
                </td>
              </tr>
              <?php } ?>
        
              <?php if($GLOBALS['habilitarCadastroSituacaoAtual'] == 1){ ?>
              <tr>
                <td>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroSituacaoAtual"); ?>:
                </td>
                <td colspan="3">
                    <?php echo $tbCadastroSituacaoAtual; ?>
                </td>
              </tr>
              <?php } ?>
        
              <?php if($GLOBALS['habilitarCadastroIc1'] == 1){ ?>
              <tr>
                <td>
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc1'], "IncludeConfig"); ?>:
                </td>
                <td colspan="3">
                    <?php echo $tbCadastroIC1; ?>
                </td>
              </tr>
              <?php } ?>
        
              <?php if($GLOBALS['habilitarCadastroIc2'] == 1){ ?>
              <tr>
                <td>
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc2'], "IncludeConfig"); ?>:
                </td>
                <td colspan="3">
                    <?php echo $tbCadastroIC2; ?>
                </td>
              </tr>
              <?php } ?>
              
              <?php if($GLOBALS['habilitarCadastroIc3'] == 1){ ?>
              <tr>
                <td>
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc3'], "IncludeConfig"); ?>:
                </td>
                <td colspan="3">
                    <?php echo $tbCadastroIC3; ?>
                </td>
              </tr>
              <?php } ?>
              
              <?php if($GLOBALS['habilitarCadastroIc4'] == 1){ ?>
              <tr>
                <td>
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc4'], "IncludeConfig"); ?>:
                </td>
                <td colspan="3">
                    <?php echo $tbCadastroIC4; ?>
                </td>
              </tr>
              <?php } ?>
              
              <?php if($GLOBALS['habilitarCadastroIc5'] == 1){ ?>
              <tr>
                <td>
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc5'], "IncludeConfig"); ?>:
                </td>
                <td colspan="3">
                    <?php echo $tbCadastroIC5; ?>
                </td>
              </tr>
              <?php } ?>
              
              <?php if($GLOBALS['habilitarCadastroIc6'] == 1){ ?>
              <tr>
                <td>
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc6'], "IncludeConfig"); ?>:
                </td>
                <td colspan="3">
                    <?php echo $tbCadastroIC6; ?>
                </td>
              </tr>
              <?php } ?>
              
              <?php if($GLOBALS['habilitarCadastroIc7'] == 1){ ?>
              <tr>
                <td>
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc7'], "IncludeConfig"); ?>:
                </td>
                <td colspan="3">
                    <?php echo $tbCadastroIC7; ?>
                </td>
              </tr>
              <?php } ?>
              
              <?php if($GLOBALS['habilitarCadastroIc8'] == 1){ ?>
              <tr>
                <td>
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc8'], "IncludeConfig"); ?>:
                </td>
                <td colspan="3">
                    <?php echo $tbCadastroIC8; ?>
                </td>
              </tr>
              <?php } ?>
              
              <?php if($GLOBALS['habilitarCadastroIc9'] == 1){ ?>
              <tr>
                <td>
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc9'], "IncludeConfig"); ?>:
                </td>
                <td colspan="3">
                    <?php echo $tbCadastroIC9; ?>
                </td>
              </tr>
              <?php } ?>
              
              <?php if($GLOBALS['habilitarCadastroIc10'] == 1){ ?>
              <tr>
                <td>
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc10'], "IncludeConfig"); ?>:
                </td>
                <td colspan="3">
                    <?php echo $tbCadastroIC10; ?>
                </td>
              </tr>
              <?php } ?>
              
              <?php if($GLOBALS['habilitarCadastroIc11'] == 1){ ?>
              <tr>
                <td>
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc11'], "IncludeConfig"); ?>:
                </td>
                <td colspan="3">
                    <?php echo $tbCadastroIC11; ?>
                </td>
              </tr>
              <?php } ?>
        
              <?php if($GLOBALS['habilitarCadastroIc12'] == 1){ ?>
              <tr>
                <td>
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc12'], "IncludeConfig"); ?>:
                </td>
                <td colspan="3">
                    <?php echo $tbCadastroIC12; ?>
                </td>
              </tr>
              <?php } ?>
              
              <?php if($GLOBALS['habilitarCadastroIc13'] == 1){ ?>
              <tr>
                <td>
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc13'], "IncludeConfig"); ?>:
                </td>
                <td colspan="3">
                    <?php echo $tbCadastroIC13; ?>
                </td>
              </tr>
              <?php } ?>
              
              <?php if($GLOBALS['habilitarCadastroIc14'] == 1){ ?>
              <tr>
                <td>
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc14'], "IncludeConfig"); ?>:
                </td>
                <td colspan="3">
                    <?php echo $tbCadastroIC14; ?>
                </td>
              </tr>
              <?php } ?>
              
              <?php if($GLOBALS['habilitarCadastroIc15'] == 1){ ?>
              <tr>
                <td>
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc15'], "IncludeConfig"); ?>:
                </td>
                <td colspan="3">
                    <?php echo $tbCadastroIC15; ?>
                </td>
              </tr>
              <?php } ?>
              
              <?php if($GLOBALS['habilitarCadastroIc16'] == 1){ ?>
              <tr>
                <td>
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc16'], "IncludeConfig"); ?>:
                </td>
                <td colspan="3">
                    <?php echo $tbCadastroIC16; ?>
                </td>
              </tr>
              <?php } ?>
              
              <?php if($GLOBALS['habilitarCadastroIc17'] == 1){ ?>
              <tr>
                <td>
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc17'], "IncludeConfig"); ?>:
                </td>
                <td colspan="3">
                    <?php echo $tbCadastroIC17; ?>
                </td>
              </tr>
              <?php } ?>
              
              <?php if($GLOBALS['habilitarCadastroIc18'] == 1){ ?>
              <tr>
                <td>
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc18'], "IncludeConfig"); ?>:
                </td>
                <td colspan="3">
                    <?php echo $tbCadastroIC18; ?>
                </td>
              </tr>
              <?php } ?>
              
              <?php if($GLOBALS['habilitarCadastroIc19'] == 1){ ?>
              <tr>
                <td>
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc19'], "IncludeConfig"); ?>:
                </td>
                <td colspan="3">
                    <?php echo $tbCadastroIC19; ?>
                </td>
              </tr>
              <?php } ?>
              
              <?php if($GLOBALS['habilitarCadastroIc20'] == 1){ ?>
              <tr>
                <td>
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc20'], "IncludeConfig"); ?>:
                </td>
                <td colspan="3">
                    <?php echo $tbCadastroIC20; ?>
                </td>
              </tr>
              <?php } ?>
              
              <?php if($GLOBALS['habilitarCadastroIc31'] == 1){ ?>
              <tr>
                <td>
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc31'], "IncludeConfig"); ?>:
                </td>
                <td colspan="3">
                    <?php echo $tbCadastroIC31; ?>
                </td>
              </tr>
              <?php } ?>
        
              <?php if($GLOBALS['habilitarCadastroIc32'] == 1){ ?>
              <tr>
                <td>
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc32'], "IncludeConfig"); ?>:
                </td>
                <td colspan="3">
                    <?php echo $tbCadastroIC32; ?>
                </td>
              </tr>
              <?php } ?>
              
              <?php if($GLOBALS['habilitarCadastroIc33'] == 1){ ?>
              <tr>
                <td>
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc33'], "IncludeConfig"); ?>:
                </td>
                <td colspan="3">
                    <?php echo $tbCadastroIC33; ?>
                </td>
              </tr>
              <?php } ?>
              
              <?php if($GLOBALS['habilitarCadastroIc34'] == 1){ ?>
              <tr>
                <td>
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc34'], "IncludeConfig"); ?>:
                </td>
                <td colspan="3">
                    <?php echo $tbCadastroIC34; ?>
                </td>
              </tr>
              <?php } ?>
              
              <?php if($GLOBALS['habilitarCadastroIc35'] == 1){ ?>
              <tr>
                <td>
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc35'], "IncludeConfig"); ?>:
                </td>
                <td colspan="3">
                    <?php echo $tbCadastroIC35; ?>
                </td>
              </tr>
              <?php } ?>
              
              <?php if($GLOBALS['habilitarCadastroIc36'] == 1){ ?>
              <tr>
                <td>
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc36'], "IncludeConfig"); ?>:
                </td>
                <td colspan="3">
                    <?php echo $tbCadastroIC36; ?>
                </td>
              </tr>
              <?php } ?>
              
              <?php if($GLOBALS['habilitarCadastroIc37'] == 1){ ?>
              <tr>
                <td>
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc37'], "IncludeConfig"); ?>:
                </td>
                <td colspan="3">
                    <?php echo $tbCadastroIC37; ?>
                </td>
              </tr>
              <?php } ?>
              
              <?php if($GLOBALS['habilitarCadastroIc38'] == 1){ ?>
              <tr>
                <td>
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc38'], "IncludeConfig"); ?>:
                </td>
                <td colspan="3">
                    <?php echo $tbCadastroIC38; ?>
                </td>
              </tr>
              <?php } ?>
              
              <?php if($GLOBALS['habilitarCadastroIc39'] == 1){ ?>
              <tr>
                <td>
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc39'], "IncludeConfig"); ?>:
                </td>
                <td colspan="3">
                    <?php echo $tbCadastroIC39; ?>
                </td>
              </tr>
              <?php } ?>
              
              <?php if($GLOBALS['habilitarCadastroIc40'] == 1){ ?>
              <tr>
                <td>
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc40'], "IncludeConfig"); ?>:
                </td>
                <td colspan="3">
                    <?php echo $tbCadastroIC40; ?>
                </td>
              </tr>
              <?php } ?>
            </table>
        </div>
    <?php } ?>
    <?php //**************************************************************************************?>
    
    
	<?php //Diagramação 2 (Cadastro Detalhes).?>
    <?php //**************************************************************************************?>
    <?php if($ConfigTipoDiagramacao == "2"){ ?>
    	<div class="CadastroDetalhesConteudo" style="position: relative; display: block; overflow: hidden;">
			<?php //Imagem Principal.?>
            <?php if($tbCadastroImagem <> ""){ ?>
                <div align="center">
                    <?php //SlimBox 2 - JQuery.?>
                    <?php if($GLOBALS['configImagemPopUp'] == "1"){ ?>
                        <a href="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>g<?php echo $tbCadastroImagem;?>" rel="lightbox" title="<?php echo $tbCadastroNome; ?>"><img src="<?php echo $GLOBALS['configCaminhoSiteImagens'];?><?php echo $tbCadastroImagem;?>" alt="<?php echo $tbCadastroNome; ?>" /></a>
                    <?php } ?>
                    
                    <?php //Pop-up div com comentários.?>
                    <?php if($GLOBALS['configImagemPopUp'] == "2"){ ?>
    
                    <?php } ?>
                </div>
            <?php } ?>

    		<div align="center" class="CadastroDetalhesSubtitulo">
            	<?php echo $tbCadastroNome; ?>
            </div>
        </div>
    <?php } ?>
    <?php //**************************************************************************************?>
<?php } ?>


<?php
//Limpeza de objetos.
//----------
unset($strSqlCadastroDetalhesSelect);
unset($statementCadastroDetalhesSelect);
unset($resultadoCadastroDetalhes);
unset($linhaCadastroDetalhes);
//----------
?>