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
$idParentCadastro = DbFuncoes::GetCampoGenerico01($idTbCadastro, "tb_cadastro", "id_tb_categorias");
$idParentCategoriasRaiz = $_GET["idParentCategoriasRaiz"];
if($idParentCategoriasRaiz == "")
{
	$idParentCategoriasRaiz = 0;
}
$campo = $_GET["campo"];

//$paginaRetorno = "CadastroIndice.php";
$paginaRetorno = $_GET["paginaRetorno"];
if($paginaRetorno == "")
{
	$paginaRetorno = "CadastroIndice.php";
}
$paginaRetornoExclusao = "CadastroArquivosComplementares.php";
$variavelRetorno = "idTbCadastro";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];


//Montagem de query padrão de retorno.
$queryPadrao = "&idTbCadastro=" . $idTbCadastro . 
"&campo=" . $campo . 
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
//$strSqlCadastroDetalhesSelect .= "* ";
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
/*
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
*/
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

//Criação de componentes e parâmetros.
//----------
$statementCadastroDetalhesSelect = $dbSistemaConPDO->prepare($strSqlCadastroDetalhesSelect);

if ($statementCadastroDetalhesSelect !== false)
{
	$statementCadastroDetalhesSelect->execute(array(
		"id" => $idTbCadastro
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
		$tbCadastroDataCadastro = $linhaCadastroDetalhes['data_cadastro'];
		//$tbCadastroNClassificacao = $linhaCadastroDetalhes['n_classificacao'];
		$tbCadastroPfPj = $linhaCadastroDetalhes['pf_pj'];
		$tbCadastroNome = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['nome']);
		$tbCadastroSexo = $linhaCadastroDetalhes['sexo'];
		$tbCadastroAltura = $linhaCadastroDetalhes['altura'];
		$tbCadastroPeso = $linhaCadastroDetalhes['peso'];
		$tbCadastroRazaoSocial = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['razao_social']);
		$tbCadastroNomeFantasia = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['nome_fantasia']);
		$tbCadastroNomePreferencial = Funcoes::GetCadastroTitulo($tbCadastroNome, $tbCadastroRazaoSocial, $tbCadastroNomeFantasia, 1);
		
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
			$tbCadastroDataNascimento = Funcoes::DataLeitura01($linhaCadastroDetalhes['data_nascimento'], $GLOBALS['configSistemaFormatoData'], "1");
		}
		/*
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
		*/

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
//echo "idTbCadastro=" . $idTbCadastro . "<br>";
//echo "tbCadastroId=" . $tbCadastroId . "<br>";
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistema"); ?> - <?php echo htmlentities($GLOBALS['configNomeCliente']); ?>
<?php 
$page->cphTitle = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Head.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphHead*/ ?>
	
<?php 
$page->cphHead = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Cabeçalho.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphConteudoCabecalho*/ ?>
    <div align="left" class="TextoTitulo01">
    	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroTituloArquivosComplementares"); ?> - 
        <?php echo $tbCadastroNomePreferencial; ?> - 
        <a href="CategoriasIndice.php?idParentCategorias=<?php echo $idParentCategoriasRaiz; ?>&idParentCategoriasRaiz=<?php echo $idParentCategoriasRaiz; ?>" class="Links04">
        	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemRoot"); ?>
        </a>
        <?php echo DbFuncoes::CategoriasCaminho($idParentCadastro, $idParentCategoriasRaiz, " - ", "Links04", "backend"); ?>
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
    
    <form name="formCadastroArquivosComplementares" id="formCadastroArquivosComplementares" action="CadastroArquivosComplementaresExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
    <table class="TabelaCampos01">
        <tr>
            <td class="TbFundoEscuro" colspan="2">
                <div align="center" class="Texto02">
                    <strong>
                        <?php if($campo == "logo"){ ?>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroLogoInserir"); ?>
						<?php } ?>
                        <?php if($campo == "mapa"){ ?>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroMapaInserir"); ?>
						<?php } ?>
                        <?php if($campo == "banner"){ ?>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroBannerInserir"); ?>
						<?php } ?>
                    </strong>
                </div>
            </td>
        </tr>

        <?php if($campo == "logo"){ ?>
        	<?php if($tbCadastroLogo <> ""){ //if($tbCategoriasImagem <> ""){?>
                <tr>
                    <td class="TbFundoClaro" colspan="4">
                        <div align="center">
                            <img src="<?php echo $GLOBALS['configDiretorioArquivos'];?>/<?php echo $tbCadastroLogo; ?>?variavelCache=<?php echo date("s"); ?>" alt="<?php echo $tbCadastroLogo; ?>" />
                        </div>
                        <div align="center">
                            <a href="RegistrosArquivosExcluirExe.php?idRegistro=<?php echo $tbCadastroId;?>&strTabela=tb_cadastro&strCampo=logo<?php echo $queryPadrao;?>" class="LinksExcluir01">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemImagemExcluir"); ?>
                            </a>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        <?php } ?>

        <tr id="cell_imagem">
            <td class="TbFundoMedio TabelaColuna01">
                <div align="left" class="Texto01">
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemImagem"); ?>:
                </div>
            </td>
            <td class="TbFundoClaro">
                <div>
                    <input type="file" name="ArquivoUpload1" id="ArquivoUpload1" class="CampoArquivoUpload01" />
                </div>
            </td>
        </tr>
    </table>
    <table cellpadding="2" cellspacing="0" width="100%">
        <tr valign="top">
            <td width="50%">
                <input type="image" name="submit" value="Submit" src="img/btoUpload.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoAtualizar"); ?>" />
                
                <input name="idTbCadastro" type="hidden" id="idTbCadastro" value="<?php echo $tbCadastroId; ?>" />
                <input name="campo" type="hidden" id="campo" value="<?php echo $campo; ?>" />
                
				<input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                <input name="masterPageSelect" type="hidden" id="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
            </td>
            <td align="right">
                <a href="<?php echo $paginaRetorno; ?>?idParentCadastro=<?php echo $idParentCadastro; ?>&idTbCadastro=<?php echo $idTbCadastro; ?>">
                    <img src="img/btoVoltar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoVoltar"); ?>"  />
                </a>
            </td>
        </tr>
    </table>
    </form>
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