<?php
//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeLayout.php";


//Verificação de login Master.
LoginAutenticacao::UsuarioLoginVerificacao();


//Verificação de login Master.
$idTbCadastro = $_GET["idTbCadastro"];
//$idParentCategorias = $_GET["idParentCategorias"];
$idParentCadastro = DbFuncoes::GetCampoGenerico01($idTbCadastro, "tb_cadastro", "id_tb_categorias");
$idParentCategoriasRaiz = $_GET["idParentCategoriasRaiz"];
if($idParentCategoriasRaiz == "")
{
	$idParentCategoriasRaiz = 0;
}

$idTbCadastroUsuario = $_GET["idTbCadastroUsuario"];
if($idTbCadastroUsuario == "")
{
	$idTbCadastroUsuario = 0;
}

$paginaRetorno = $_GET["paginaRetorno"];
if($paginaRetorno == "")
{
	$paginaRetorno = "CadastroIndice.php";
}
$paginaRetornoExclusao = "CadastroEditar.php";
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

$strSqlCadastroDetalhesSelect .= "id_db_cep_tblBairros, ";
$strSqlCadastroDetalhesSelect .= "id_db_cep_tblCidades, ";
$strSqlCadastroDetalhesSelect .= "id_db_cep_tblLogradouros, ";
$strSqlCadastroDetalhesSelect .= "id_db_cep_tblUF, ";

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
		
		$tbCadastroIdDBCepTblBairros = $linhaCadastroDetalhes['id_db_cep_tblBairros'];
		$tbCadastroIdDBCepTblCidades = $linhaCadastroDetalhes['id_db_cep_tblCidades'];
		$tbCadastroIdDBCepTblLogradouros = $linhaCadastroDetalhes['id_db_cep_tblLogradouros'];
		$tbCadastroIdDBCepTblUF = $linhaCadastroDetalhes['id_db_cep_tblUF'];

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
		//$tbCadastroIdTbCadastro1 = $linhaCadastroDetalhes['id_tb_cadastro1'];
		//$tbCadastroIdTbCadastro2 = $linhaCadastroDetalhes['id_tb_cadastro2'];
		//$tbCadastroIdTbCadastro3 = $linhaCadastroDetalhes['id_tb_cadastro3'];
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
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistema"); ?> - <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configNomeCliente'], "IncludeConfig"); ?>
<?php 
$page->cphTitle = ob_get_clean(); 
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
<?php ob_start(); /*cphConteudoCabecalho*/ ?>
    <div align="left" class="TextoTitulo01">
    	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroTituloEditar"); ?> - <?php echo Funcoes::GetCadastroTitulo($tbCadastroNome, $tbCadastroRazaoSocial, $tbCadastroNomeFantasia, 1); ?> - 
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
	
	
	<script type="text/javascript">
        //Variável para conter todos os campos que funcionam com o DatePicker.
        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
		var strDatapickerNascimentoPtCampos = "";
		var strDatapickerNascimentoEnCampos = "";

        var strDatapickerAgendaPtCampos = "";
        var strDatapickerAgendaEnCampos = "";
    </script>
    <form name="formCadastroEditar" id="formCadastroEditar" action="CadastroEditarExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
	
        <table class="TabelaCampos01">
            <tr>
                <td class="TbFundoEscuro" colspan="4">
                    <div align="center" class="Texto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroTbCadastroEditar"); ?>
                        </strong>
                    </div>
                </td>
            </tr>
            
            <?php if($GLOBALS['habilitarCadastroEdicaoCategorias'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemCategoriaVinculada"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div>
						<?php 
                            $arrCategoriasIdParent = DbFuncoes::CategoriasIdParentSelect("13");
                        ?>
                        <select name="id_tb_categorias" id="id_tb_categorias" class="CampoDropDownMenu01">
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
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroTipoCadastro"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left" class="Texto01">
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
                                <input name="idsCadastroTipo[]" type="checkbox" value="<?php echo $arrCadastroTipo[$countArray][0];?>" class="CampoCheckBox01"<?php if(in_array($arrCadastroTipo[$countArray][0], $arrCadastroTipoSelecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrCadastroTipo[$countArray][1];?>
                            </div>
                        <?php 
						}
						?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroAtividades'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroAtividades"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left" class="Texto01">
                        <?php
							//Seleção de ids selecionados para o registro.
							$arrCadastroAtividadesSelecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "2", "", ",", "", "1"));
						?>
                    	<?php 
							$arrCadastroAtividades = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 2);
						?>
                        <select id="idsCadastroAtividades[]" name="idsCadastroAtividades[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
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
            
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroNome"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" <?php if($GLOBALS['habilitarCadastroNClassificacao'] <> 1){ ?> colspan="3" <?php } ?>>
                    <div align="left">
                        <input type="text" name="nome" id="nome" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroNome;?>" />
                    </div>
                </td>
                <?php if($GLOBALS['habilitarCadastroNClassificacao'] == 1){ ?>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNClassificacao"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaColuna01">
                    <div>
                        <input type="text" name="n_classificacao" id="n_classificacao" class="CampoNumerico01" maxlength="10" value="<?php echo $tbCadastroNClassificacao;?>" />
                    </div>
                </td>
                <?php } ?>
            </tr>
            
            <?php if($GLOBALS['habilitarCadastroSexo'] == 1 || $GLOBALS['habilitarCadastroPfPj'] == 1){ ?>
            <tr>
                <?php if($GLOBALS['habilitarCadastroSexo'] == 1){ ?>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroSexo"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro"<?php if($GLOBALS['habilitarCadastroPfPj'] <> 1){ ?> colspan="3"<?php } ?>>
                    <div align="left" class="Texto01">
                        <select name="sexo" id="sexo" class="CampoDropDownMenu01">
                            <option value="1"<?php if($tbCadastroSexo == "1"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroSexo1"); ?></option>
                            <option value="2"<?php if($tbCadastroSexo == "2"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroSexo2"); ?></option>
                        </select>
                    </div>
                </td>
                <?php } ?>

                <?php if($GLOBALS['habilitarCadastroPfPj'] == 1){ ?>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroPfPj"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaColuna01"<?php if($GLOBALS['habilitarCadastroSexo'] <> 1){ ?> colspan="3" <?php } ?>>
                    <div>
                        <select name="pf_pj" id="pf_pj" class="CampoDropDownMenu01">
                            <option value="1"<?php if($tbCadastroPfPj == "1"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroPfPj1"); ?></option>
                            <option value="2"<?php if($tbCadastroPfPj == "2"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroPfPj2"); ?></option>
                        </select>
                    </div>
                </td>
                <?php } ?>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico01'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico01Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
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
                                    <input name="idsCadastroFiltroGenerico01[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico01[$countArray][0];?>" class="CampoCheckBox01"<?php if(in_array($arrCadastroFiltroGenerico01[$countArray][0], $arrCadastroFiltroGenerico01Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrCadastroFiltroGenerico01[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico01CaixaSelecao'] == 2){ ?>
                            <select id="idsCadastroFiltroGenerico01[]" name="idsCadastroFiltroGenerico01[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico01CaixaSelecao'] == 3){ ?>
                            <select id="idsCadastroFiltroGenerico01[]" name="idsCadastroFiltroGenerico01[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
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
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico02'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico02Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
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
                                    <input name="idsCadastroFiltroGenerico02[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico02[$countArray][0];?>" class="CampoCheckBox01"<?php if(in_array($arrCadastroFiltroGenerico02[$countArray][0], $arrCadastroFiltroGenerico02Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrCadastroFiltroGenerico02[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico02CaixaSelecao'] == 2){ ?>
                            <select id="idsCadastroFiltroGenerico02[]" name="idsCadastroFiltroGenerico02[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico02CaixaSelecao'] == 3){ ?>
                            <select id="idsCadastroFiltroGenerico02[]" name="idsCadastroFiltroGenerico02[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
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
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico03'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico03Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
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
                                    <input name="idsCadastroFiltroGenerico03[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico03[$countArray][0];?>" class="CampoCheckBox01"<?php if(in_array($arrCadastroFiltroGenerico03[$countArray][0], $arrCadastroFiltroGenerico03Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrCadastroFiltroGenerico03[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico03CaixaSelecao'] == 2){ ?>
                            <select id="idsCadastroFiltroGenerico03[]" name="idsCadastroFiltroGenerico03[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico03CaixaSelecao'] == 3){ ?>
                            <select id="idsCadastroFiltroGenerico03[]" name="idsCadastroFiltroGenerico03[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
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
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarCadastroFiltroGenerico04'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico04Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
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
                                    <input name="idsCadastroFiltroGenerico04[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico04[$countArray][0];?>" class="CampoCheckBox01"<?php if(in_array($arrCadastroFiltroGenerico04[$countArray][0], $arrCadastroFiltroGenerico04Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrCadastroFiltroGenerico04[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico04CaixaSelecao'] == 2){ ?>
                            <select id="idsCadastroFiltroGenerico04[]" name="idsCadastroFiltroGenerico04[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico04CaixaSelecao'] == 3){ ?>
                            <select id="idsCadastroFiltroGenerico04[]" name="idsCadastroFiltroGenerico04[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
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
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico05'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico05Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
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
                                    <input name="idsCadastroFiltroGenerico05[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico05[$countArray][0];?>" class="CampoCheckBox01"<?php if(in_array($arrCadastroFiltroGenerico05[$countArray][0], $arrCadastroFiltroGenerico05Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrCadastroFiltroGenerico05[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico05CaixaSelecao'] == 2){ ?>
                            <select id="idsCadastroFiltroGenerico05[]" name="idsCadastroFiltroGenerico05[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico05CaixaSelecao'] == 3){ ?>
                            <select id="idsCadastroFiltroGenerico05[]" name="idsCadastroFiltroGenerico05[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
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
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico06'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico06Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
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
                                    <input name="idsCadastroFiltroGenerico06[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico06[$countArray][0];?>" class="CampoCheckBox01"<?php if(in_array($arrCadastroFiltroGenerico06[$countArray][0], $arrCadastroFiltroGenerico06Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrCadastroFiltroGenerico06[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico06CaixaSelecao'] == 2){ ?>
                            <select id="idsCadastroFiltroGenerico06[]" name="idsCadastroFiltroGenerico06[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico06CaixaSelecao'] == 3){ ?>
                            <select id="idsCadastroFiltroGenerico06[]" name="idsCadastroFiltroGenerico06[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
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
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico07'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico07Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
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
                                    <input name="idsCadastroFiltroGenerico07[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico07[$countArray][0];?>" class="CampoCheckBox01"<?php if(in_array($arrCadastroFiltroGenerico07[$countArray][0], $arrCadastroFiltroGenerico07Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrCadastroFiltroGenerico07[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico07CaixaSelecao'] == 2){ ?>
                            <select id="idsCadastroFiltroGenerico07[]" name="idsCadastroFiltroGenerico07[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico07CaixaSelecao'] == 3){ ?>
                            <select id="idsCadastroFiltroGenerico07[]" name="idsCadastroFiltroGenerico07[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
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
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico08'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico08Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
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
                                    <input name="idsCadastroFiltroGenerico08[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico08[$countArray][0];?>" class="CampoCheckBox01"<?php if(in_array($arrCadastroFiltroGenerico08[$countArray][0], $arrCadastroFiltroGenerico08Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrCadastroFiltroGenerico08[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico08CaixaSelecao'] == 2){ ?>
                            <select id="idsCadastroFiltroGenerico08[]" name="idsCadastroFiltroGenerico08[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico08CaixaSelecao'] == 3){ ?>
                            <select id="idsCadastroFiltroGenerico08[]" name="idsCadastroFiltroGenerico08[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
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
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico09'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico09Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
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
                                    <input name="idsCadastroFiltroGenerico09[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico09[$countArray][0];?>" class="CampoCheckBox01"<?php if(in_array($arrCadastroFiltroGenerico09[$countArray][0], $arrCadastroFiltroGenerico09Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrCadastroFiltroGenerico09[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico09CaixaSelecao'] == 2){ ?>
                            <select id="idsCadastroFiltroGenerico09[]" name="idsCadastroFiltroGenerico09[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico09CaixaSelecao'] == 3){ ?>
                            <select id="idsCadastroFiltroGenerico09[]" name="idsCadastroFiltroGenerico09[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
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
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico10'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico10Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
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
                                    <input name="idsCadastroFiltroGenerico10[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico10[$countArray][0];?>" class="CampoCheckBox01"<?php if(in_array($arrCadastroFiltroGenerico10[$countArray][0], $arrCadastroFiltroGenerico10Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrCadastroFiltroGenerico10[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico10CaixaSelecao'] == 2){ ?>
                            <select id="idsCadastroFiltroGenerico10[]" name="idsCadastroFiltroGenerico10[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico10CaixaSelecao'] == 3){ ?>
                            <select id="idsCadastroFiltroGenerico10[]" name="idsCadastroFiltroGenerico10[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico10); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico10[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico10[$countArray][0], $arrCadastroFiltroGenerico10Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico10[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrCadastroFiltroGenerico10)){ ?>
                        	<a href="CadastroManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico11'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico11Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
                        <?php
							//Seleção de ids selecionados para o registro.
							$arrCadastroFiltroGenerico11Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "60", "", ",", "", "1"));
						?>
                    
						<?php 
                            $arrCadastroFiltroGenerico11 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 60);
                        ?>
                        
                        <?php if($GLOBALS['configCadastroFiltroGenerico11CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico11); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsCadastroFiltroGenerico11[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico11[$countArray][0];?>" class="CampoCheckBox01"<?php if(in_array($arrCadastroFiltroGenerico11[$countArray][0], $arrCadastroFiltroGenerico11Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrCadastroFiltroGenerico11[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico11CaixaSelecao'] == 2){ ?>
                            <select id="idsCadastroFiltroGenerico11[]" name="idsCadastroFiltroGenerico11[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico11); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico11[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico11[$countArray][0], $arrCadastroFiltroGenerico11Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico11[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico11CaixaSelecao'] == 3){ ?>
                            <select id="idsCadastroFiltroGenerico11[]" name="idsCadastroFiltroGenerico11[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico11); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico11[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico11[$countArray][0], $arrCadastroFiltroGenerico11Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico11[$countArray][1];?></option>
                                <?php 
                                }

                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrCadastroFiltroGenerico11)){ ?>
                        	<a href="CadastroManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico12'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico12Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
                        <?php
							//Seleção de ids selecionados para o registro.
							$arrCadastroFiltroGenerico12Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "61", "", ",", "", "1"));
						?>
                    
						<?php 
                            $arrCadastroFiltroGenerico12 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 61);
                            //echo "arrCadastroFiltroGenerico12Selecao=" . $arrCadastroFiltroGenerico12Selecao . "<br />";
                            //echo "arrCadastroFiltroGenerico12Selecao[0]=" . $arrCadastroFiltroGenerico12Selecao[0] . "<br />";
							//echo "FiltrosGenericosSelect03=" . DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "13", "", ",", "", "1")  . "<br />";
                            //echo "tbCadastroId=" . $tbCadastroId . "<br />";
                        ?>
                        
                        <?php if($GLOBALS['configCadastroFiltroGenerico12CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico12); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsCadastroFiltroGenerico12[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico12[$countArray][0];?>" class="CampoCheckBox01"<?php if(in_array($arrCadastroFiltroGenerico12[$countArray][0], $arrCadastroFiltroGenerico12Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrCadastroFiltroGenerico12[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico12CaixaSelecao'] == 2){ ?>
                            <select id="idsCadastroFiltroGenerico12[]" name="idsCadastroFiltroGenerico12[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico12); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico12[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico12[$countArray][0], $arrCadastroFiltroGenerico12Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico12[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico12CaixaSelecao'] == 3){ ?>
                            <select id="idsCadastroFiltroGenerico12[]" name="idsCadastroFiltroGenerico12[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico12); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico12[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico12[$countArray][0], $arrCadastroFiltroGenerico12Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico12[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrCadastroFiltroGenerico12)){ ?>
                        	<a href="CadastroManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico13'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico13Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
                        <?php
							//Seleção de ids selecionados para o registro.
							$arrCadastroFiltroGenerico13Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "62", "", ",", "", "1"));
						?>

						<?php 
                            $arrCadastroFiltroGenerico13 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 62);
                        ?>
                        
                        <?php if($GLOBALS['configCadastroFiltroGenerico13CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico13); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsCadastroFiltroGenerico13[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico13[$countArray][0];?>" class="CampoCheckBox01"<?php if(in_array($arrCadastroFiltroGenerico13[$countArray][0], $arrCadastroFiltroGenerico13Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrCadastroFiltroGenerico13[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico13CaixaSelecao'] == 2){ ?>
                            <select id="idsCadastroFiltroGenerico13[]" name="idsCadastroFiltroGenerico13[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico13); $countArray++)
                                {
                                ?>

                                    <option value="<?php echo $arrCadastroFiltroGenerico13[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico13[$countArray][0], $arrCadastroFiltroGenerico13Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico13[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico13CaixaSelecao'] == 3){ ?>
                            <select id="idsCadastroFiltroGenerico13[]" name="idsCadastroFiltroGenerico13[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico13); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico13[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico13[$countArray][0], $arrCadastroFiltroGenerico13Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico13[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrCadastroFiltroGenerico13)){ ?>
                        	<a href="CadastroManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarCadastroFiltroGenerico14'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico14Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
                        <?php
							//Seleção de ids selecionados para o registro.
							$arrCadastroFiltroGenerico14Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "63", "", ",", "", "1"));
						?>
                    
						<?php 
                            $arrCadastroFiltroGenerico14 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 63);
                        ?>
                        
                        <?php if($GLOBALS['configCadastroFiltroGenerico14CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico14); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsCadastroFiltroGenerico14[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico14[$countArray][0];?>" class="CampoCheckBox01"<?php if(in_array($arrCadastroFiltroGenerico14[$countArray][0], $arrCadastroFiltroGenerico14Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrCadastroFiltroGenerico14[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico14CaixaSelecao'] == 2){ ?>
                            <select id="idsCadastroFiltroGenerico14[]" name="idsCadastroFiltroGenerico14[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico14); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico14[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico14[$countArray][0], $arrCadastroFiltroGenerico14Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico14[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico14CaixaSelecao'] == 3){ ?>
                            <select id="idsCadastroFiltroGenerico14[]" name="idsCadastroFiltroGenerico14[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico14); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico14[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico14[$countArray][0], $arrCadastroFiltroGenerico14Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico14[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrCadastroFiltroGenerico14)){ ?>
                        	<a href="CadastroManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico15'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico15Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
                        <?php
							//Seleção de ids selecionados para o registro.
							$arrCadastroFiltroGenerico15Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "64", "", ",", "", "1"));
						?>
                    
						<?php 
                            $arrCadastroFiltroGenerico15 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 64);
                        ?>
                        
                        <?php if($GLOBALS['configCadastroFiltroGenerico15CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico15); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsCadastroFiltroGenerico15[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico15[$countArray][0];?>" class="CampoCheckBox01"<?php if(in_array($arrCadastroFiltroGenerico15[$countArray][0], $arrCadastroFiltroGenerico15Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrCadastroFiltroGenerico15[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico15CaixaSelecao'] == 2){ ?>
                            <select id="idsCadastroFiltroGenerico15[]" name="idsCadastroFiltroGenerico15[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico15); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico15[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico15[$countArray][0], $arrCadastroFiltroGenerico15Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico15[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico15CaixaSelecao'] == 3){ ?>
                            <select id="idsCadastroFiltroGenerico15[]" name="idsCadastroFiltroGenerico15[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico15); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico15[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico15[$countArray][0], $arrCadastroFiltroGenerico15Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico15[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrCadastroFiltroGenerico15)){ ?>
                        	<a href="CadastroManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico16'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico16Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
                        <?php
							//Seleção de ids selecionados para o registro.
							$arrCadastroFiltroGenerico16Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "65", "", ",", "", "1"));
						?>

						<?php 
                            $arrCadastroFiltroGenerico16 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 65);
                        ?>
                        
                        <?php if($GLOBALS['configCadastroFiltroGenerico16CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico16); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsCadastroFiltroGenerico16[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico16[$countArray][0];?>" class="CampoCheckBox01"<?php if(in_array($arrCadastroFiltroGenerico16[$countArray][0], $arrCadastroFiltroGenerico16Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrCadastroFiltroGenerico16[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico16CaixaSelecao'] == 2){ ?>
                            <select id="idsCadastroFiltroGenerico16[]" name="idsCadastroFiltroGenerico16[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico16); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico16[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico16[$countArray][0], $arrCadastroFiltroGenerico16Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico16[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico16CaixaSelecao'] == 3){ ?>
                            <select id="idsCadastroFiltroGenerico16[]" name="idsCadastroFiltroGenerico16[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico16); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico16[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico16[$countArray][0], $arrCadastroFiltroGenerico16Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico16[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrCadastroFiltroGenerico16)){ ?>
                        	<a href="CadastroManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico17'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico17Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
                        <?php
							//Seleção de ids selecionados para o registro.
							$arrCadastroFiltroGenerico17Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "66", "", ",", "", "1"));
						?>
                    
						<?php 
                            $arrCadastroFiltroGenerico17 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 66);
                        ?>
                        
                        <?php if($GLOBALS['configCadastroFiltroGenerico17CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico17); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsCadastroFiltroGenerico17[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico17[$countArray][0];?>" class="CampoCheckBox01"<?php if(in_array($arrCadastroFiltroGenerico17[$countArray][0], $arrCadastroFiltroGenerico17Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrCadastroFiltroGenerico17[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico17CaixaSelecao'] == 2){ ?>
                            <select id="idsCadastroFiltroGenerico17[]" name="idsCadastroFiltroGenerico17[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico17); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico17[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico17[$countArray][0], $arrCadastroFiltroGenerico17Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico17[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico17CaixaSelecao'] == 3){ ?>
                            <select id="idsCadastroFiltroGenerico17[]" name="idsCadastroFiltroGenerico17[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico17); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico17[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico17[$countArray][0], $arrCadastroFiltroGenerico17Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico17[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrCadastroFiltroGenerico17)){ ?>
                        	<a href="CadastroManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico18'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico18Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
                        <?php
							//Seleção de ids selecionados para o registro.
							$arrCadastroFiltroGenerico18Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "67", "", ",", "", "1"));
						?>

						<?php 
                            $arrCadastroFiltroGenerico18 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 67);
                        ?>
                        
                        <?php if($GLOBALS['configCadastroFiltroGenerico18CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico18); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsCadastroFiltroGenerico18[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico18[$countArray][0];?>" class="CampoCheckBox01"<?php if(in_array($arrCadastroFiltroGenerico18[$countArray][0], $arrCadastroFiltroGenerico18Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrCadastroFiltroGenerico18[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico18CaixaSelecao'] == 2){ ?>
                            <select id="idsCadastroFiltroGenerico18[]" name="idsCadastroFiltroGenerico18[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico18); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico18[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico18[$countArray][0], $arrCadastroFiltroGenerico18Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico18[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico18CaixaSelecao'] == 3){ ?>
                            <select id="idsCadastroFiltroGenerico18[]" name="idsCadastroFiltroGenerico18[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico18); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico18[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico18[$countArray][0], $arrCadastroFiltroGenerico18Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico18[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrCadastroFiltroGenerico18)){ ?>
                        	<a href="CadastroManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico19'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico19Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
                        <?php
							//Seleção de ids selecionados para o registro.
							$arrCadastroFiltroGenerico19Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "68", "", ",", "", "1"));
						?>

						<?php 
                            $arrCadastroFiltroGenerico19 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 68);
                        ?>
                        
                        <?php if($GLOBALS['configCadastroFiltroGenerico19CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico19); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsCadastroFiltroGenerico19[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico19[$countArray][0];?>" class="CampoCheckBox01"<?php if(in_array($arrCadastroFiltroGenerico19[$countArray][0], $arrCadastroFiltroGenerico19Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrCadastroFiltroGenerico19[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico19CaixaSelecao'] == 2){ ?>
                            <select id="idsCadastroFiltroGenerico19[]" name="idsCadastroFiltroGenerico19[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico19); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico19[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico19[$countArray][0], $arrCadastroFiltroGenerico19Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico19[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico19CaixaSelecao'] == 3){ ?>
                            <select id="idsCadastroFiltroGenerico19[]" name="idsCadastroFiltroGenerico19[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico19); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico19[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico19[$countArray][0], $arrCadastroFiltroGenerico19Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico19[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrCadastroFiltroGenerico19)){ ?>
                        	<a href="CadastroManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico20'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico20Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
                        <?php
							//Seleção de ids selecionados para o registro.
							$arrCadastroFiltroGenerico20Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "69", "", ",", "", "1"));
						?>
                    
						<?php 
                            $arrCadastroFiltroGenerico20 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 69);
                        ?>
                        
                        <?php if($GLOBALS['configCadastroFiltroGenerico20CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico20); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsCadastroFiltroGenerico20[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico20[$countArray][0];?>" class="CampoCheckBox01"<?php if(in_array($arrCadastroFiltroGenerico20[$countArray][0], $arrCadastroFiltroGenerico20Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrCadastroFiltroGenerico20[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico20CaixaSelecao'] == 2){ ?>
                            <select id="idsCadastroFiltroGenerico20[]" name="idsCadastroFiltroGenerico20[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico20); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico20[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico20[$countArray][0], $arrCadastroFiltroGenerico20Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico20[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico20CaixaSelecao'] == 3){ ?>
                            <select id="idsCadastroFiltroGenerico20[]" name="idsCadastroFiltroGenerico20[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico20); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico20[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico20[$countArray][0], $arrCadastroFiltroGenerico20Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico20[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrCadastroFiltroGenerico20)){ ?>
                        	<a href="CadastroManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico21'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico21Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
                        <?php
							//Seleção de ids selecionados para o registro.
							$arrCadastroFiltroGenerico21Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "70", "", ",", "", "1"));
						?>
                    
						<?php 
                            $arrCadastroFiltroGenerico21 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 70);
                        ?>
                        
                        <?php if($GLOBALS['configCadastroFiltroGenerico21CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico21); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsCadastroFiltroGenerico21[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico21[$countArray][0];?>" class="CampoCheckBox01"<?php if(in_array($arrCadastroFiltroGenerico21[$countArray][0], $arrCadastroFiltroGenerico21Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrCadastroFiltroGenerico21[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico21CaixaSelecao'] == 2){ ?>
                            <select id="idsCadastroFiltroGenerico21[]" name="idsCadastroFiltroGenerico21[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico21); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico21[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico21[$countArray][0], $arrCadastroFiltroGenerico21Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico21[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico21CaixaSelecao'] == 3){ ?>
                            <select id="idsCadastroFiltroGenerico21[]" name="idsCadastroFiltroGenerico21[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico21); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico21[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico21[$countArray][0], $arrCadastroFiltroGenerico21Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico21[$countArray][1];?></option>
                                <?php 
                                }

                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrCadastroFiltroGenerico21)){ ?>
                        	<a href="CadastroManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico22'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico22Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
                        <?php
							//Seleção de ids selecionados para o registro.
							$arrCadastroFiltroGenerico22Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "71", "", ",", "", "1"));
						?>
                    
						<?php 
                            $arrCadastroFiltroGenerico22 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 71);
                            //echo "arrCadastroFiltroGenerico22Selecao=" . $arrCadastroFiltroGenerico22Selecao . "<br />";
                            //echo "arrCadastroFiltroGenerico22Selecao[0]=" . $arrCadastroFiltroGenerico22Selecao[0] . "<br />";
							//echo "FiltrosGenericosSelect03=" . DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "13", "", ",", "", "1")  . "<br />";
                            //echo "tbCadastroId=" . $tbCadastroId . "<br />";
                        ?>
                        
                        <?php if($GLOBALS['configCadastroFiltroGenerico22CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico22); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsCadastroFiltroGenerico22[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico22[$countArray][0];?>" class="CampoCheckBox01"<?php if(in_array($arrCadastroFiltroGenerico22[$countArray][0], $arrCadastroFiltroGenerico22Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrCadastroFiltroGenerico22[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico22CaixaSelecao'] == 2){ ?>
                            <select id="idsCadastroFiltroGenerico22[]" name="idsCadastroFiltroGenerico22[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico22); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico22[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico22[$countArray][0], $arrCadastroFiltroGenerico22Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico22[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico22CaixaSelecao'] == 3){ ?>
                            <select id="idsCadastroFiltroGenerico22[]" name="idsCadastroFiltroGenerico22[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico22); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico22[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico22[$countArray][0], $arrCadastroFiltroGenerico22Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico22[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrCadastroFiltroGenerico22)){ ?>
                        	<a href="CadastroManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico23'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico23Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
                        <?php
							//Seleção de ids selecionados para o registro.
							$arrCadastroFiltroGenerico23Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "72", "", ",", "", "1"));
						?>

						<?php 
                            $arrCadastroFiltroGenerico23 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 72);
                        ?>
                        
                        <?php if($GLOBALS['configCadastroFiltroGenerico23CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico23); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsCadastroFiltroGenerico23[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico23[$countArray][0];?>" class="CampoCheckBox01"<?php if(in_array($arrCadastroFiltroGenerico23[$countArray][0], $arrCadastroFiltroGenerico23Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrCadastroFiltroGenerico23[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico23CaixaSelecao'] == 2){ ?>
                            <select id="idsCadastroFiltroGenerico23[]" name="idsCadastroFiltroGenerico23[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico23); $countArray++)
                                {
                                ?>

                                    <option value="<?php echo $arrCadastroFiltroGenerico23[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico23[$countArray][0], $arrCadastroFiltroGenerico23Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico23[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico23CaixaSelecao'] == 3){ ?>
                            <select id="idsCadastroFiltroGenerico23[]" name="idsCadastroFiltroGenerico23[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico23); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico23[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico23[$countArray][0], $arrCadastroFiltroGenerico23Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico23[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrCadastroFiltroGenerico23)){ ?>
                        	<a href="CadastroManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarCadastroFiltroGenerico24'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico24Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
                        <?php
							//Seleção de ids selecionados para o registro.
							$arrCadastroFiltroGenerico24Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "73", "", ",", "", "1"));
						?>
                    
						<?php 
                            $arrCadastroFiltroGenerico24 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 73);
                        ?>
                        
                        <?php if($GLOBALS['configCadastroFiltroGenerico24CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico24); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsCadastroFiltroGenerico24[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico24[$countArray][0];?>" class="CampoCheckBox01"<?php if(in_array($arrCadastroFiltroGenerico24[$countArray][0], $arrCadastroFiltroGenerico24Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrCadastroFiltroGenerico24[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico24CaixaSelecao'] == 2){ ?>
                            <select id="idsCadastroFiltroGenerico24[]" name="idsCadastroFiltroGenerico24[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico24); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico24[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico24[$countArray][0], $arrCadastroFiltroGenerico24Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico24[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico24CaixaSelecao'] == 3){ ?>
                            <select id="idsCadastroFiltroGenerico24[]" name="idsCadastroFiltroGenerico24[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico24); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico24[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico24[$countArray][0], $arrCadastroFiltroGenerico24Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico24[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrCadastroFiltroGenerico24)){ ?>
                        	<a href="CadastroManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico25'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico25Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
                        <?php
							//Seleção de ids selecionados para o registro.
							$arrCadastroFiltroGenerico25Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "74", "", ",", "", "1"));
						?>
                    
						<?php 
                            $arrCadastroFiltroGenerico25 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 74);
                        ?>
                        
                        <?php if($GLOBALS['configCadastroFiltroGenerico25CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico25); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsCadastroFiltroGenerico25[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico25[$countArray][0];?>" class="CampoCheckBox01"<?php if(in_array($arrCadastroFiltroGenerico25[$countArray][0], $arrCadastroFiltroGenerico25Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrCadastroFiltroGenerico25[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico25CaixaSelecao'] == 2){ ?>
                            <select id="idsCadastroFiltroGenerico25[]" name="idsCadastroFiltroGenerico25[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico25); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico25[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico25[$countArray][0], $arrCadastroFiltroGenerico25Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico25[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico25CaixaSelecao'] == 3){ ?>
                            <select id="idsCadastroFiltroGenerico25[]" name="idsCadastroFiltroGenerico25[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico25); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico25[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico25[$countArray][0], $arrCadastroFiltroGenerico25Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico25[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrCadastroFiltroGenerico25)){ ?>
                        	<a href="CadastroManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico26'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico26Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
                        <?php
							//Seleção de ids selecionados para o registro.
							$arrCadastroFiltroGenerico26Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "75", "", ",", "", "1"));
						?>

						<?php 
                            $arrCadastroFiltroGenerico26 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 75);
                        ?>
                        
                        <?php if($GLOBALS['configCadastroFiltroGenerico26CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico26); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsCadastroFiltroGenerico26[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico26[$countArray][0];?>" class="CampoCheckBox01"<?php if(in_array($arrCadastroFiltroGenerico26[$countArray][0], $arrCadastroFiltroGenerico26Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrCadastroFiltroGenerico26[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico26CaixaSelecao'] == 2){ ?>
                            <select id="idsCadastroFiltroGenerico26[]" name="idsCadastroFiltroGenerico26[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico26); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico26[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico26[$countArray][0], $arrCadastroFiltroGenerico26Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico26[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico26CaixaSelecao'] == 3){ ?>
                            <select id="idsCadastroFiltroGenerico26[]" name="idsCadastroFiltroGenerico26[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico26); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico26[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico26[$countArray][0], $arrCadastroFiltroGenerico26Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico26[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrCadastroFiltroGenerico26)){ ?>
                        	<a href="CadastroManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico27'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico27Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
                        <?php
							//Seleção de ids selecionados para o registro.
							$arrCadastroFiltroGenerico27Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "76", "", ",", "", "1"));
						?>
                    
						<?php 
                            $arrCadastroFiltroGenerico27 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 76);
                        ?>
                        
                        <?php if($GLOBALS['configCadastroFiltroGenerico27CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico27); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsCadastroFiltroGenerico27[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico27[$countArray][0];?>" class="CampoCheckBox01"<?php if(in_array($arrCadastroFiltroGenerico27[$countArray][0], $arrCadastroFiltroGenerico27Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrCadastroFiltroGenerico27[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico27CaixaSelecao'] == 2){ ?>
                            <select id="idsCadastroFiltroGenerico27[]" name="idsCadastroFiltroGenerico27[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico27); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico27[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico27[$countArray][0], $arrCadastroFiltroGenerico27Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico27[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico27CaixaSelecao'] == 3){ ?>
                            <select id="idsCadastroFiltroGenerico27[]" name="idsCadastroFiltroGenerico27[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico27); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico27[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico27[$countArray][0], $arrCadastroFiltroGenerico27Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico27[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrCadastroFiltroGenerico27)){ ?>
                        	<a href="CadastroManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico28'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico28Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
                        <?php
							//Seleção de ids selecionados para o registro.
							$arrCadastroFiltroGenerico28Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "77", "", ",", "", "1"));
						?>

						<?php 
                            $arrCadastroFiltroGenerico28 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 77);
                        ?>
                        
                        <?php if($GLOBALS['configCadastroFiltroGenerico28CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico28); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsCadastroFiltroGenerico28[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico28[$countArray][0];?>" class="CampoCheckBox01"<?php if(in_array($arrCadastroFiltroGenerico28[$countArray][0], $arrCadastroFiltroGenerico28Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrCadastroFiltroGenerico28[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico28CaixaSelecao'] == 2){ ?>
                            <select id="idsCadastroFiltroGenerico28[]" name="idsCadastroFiltroGenerico28[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico28); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico28[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico28[$countArray][0], $arrCadastroFiltroGenerico28Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico28[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico28CaixaSelecao'] == 3){ ?>
                            <select id="idsCadastroFiltroGenerico28[]" name="idsCadastroFiltroGenerico28[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico28); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico28[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico28[$countArray][0], $arrCadastroFiltroGenerico28Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico28[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrCadastroFiltroGenerico28)){ ?>
                        	<a href="CadastroManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico29'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico29Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
                        <?php
							//Seleção de ids selecionados para o registro.
							$arrCadastroFiltroGenerico29Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "78", "", ",", "", "1"));
						?>

						<?php 
                            $arrCadastroFiltroGenerico29 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 78);
                        ?>
                        
                        <?php if($GLOBALS['configCadastroFiltroGenerico29CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico29); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsCadastroFiltroGenerico29[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico29[$countArray][0];?>" class="CampoCheckBox01"<?php if(in_array($arrCadastroFiltroGenerico29[$countArray][0], $arrCadastroFiltroGenerico29Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrCadastroFiltroGenerico29[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico29CaixaSelecao'] == 2){ ?>
                            <select id="idsCadastroFiltroGenerico29[]" name="idsCadastroFiltroGenerico29[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico29); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico29[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico29[$countArray][0], $arrCadastroFiltroGenerico29Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico29[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico29CaixaSelecao'] == 3){ ?>
                            <select id="idsCadastroFiltroGenerico29[]" name="idsCadastroFiltroGenerico29[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico29); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico29[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico29[$countArray][0], $arrCadastroFiltroGenerico29Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico29[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrCadastroFiltroGenerico29)){ ?>
                        	<a href="CadastroManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroFiltroGenerico30'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico30Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
                        <?php
							//Seleção de ids selecionados para o registro.
							$arrCadastroFiltroGenerico30Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "79", "", ",", "", "1"));
						?>
                    
						<?php 
                            $arrCadastroFiltroGenerico30 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 79);
                        ?>
                        
                        <?php if($GLOBALS['configCadastroFiltroGenerico30CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico30); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsCadastroFiltroGenerico30[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico30[$countArray][0];?>" class="CampoCheckBox01"<?php if(in_array($arrCadastroFiltroGenerico30[$countArray][0], $arrCadastroFiltroGenerico30Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrCadastroFiltroGenerico30[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico30CaixaSelecao'] == 2){ ?>
                            <select id="idsCadastroFiltroGenerico30[]" name="idsCadastroFiltroGenerico30[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico30); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico30[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico30[$countArray][0], $arrCadastroFiltroGenerico30Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico30[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroFiltroGenerico30CaixaSelecao'] == 3){ ?>
                            <select id="idsCadastroFiltroGenerico30[]" name="idsCadastroFiltroGenerico30[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico30); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrCadastroFiltroGenerico30[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico30[$countArray][0], $arrCadastroFiltroGenerico30Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico30[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrCadastroFiltroGenerico30)){ ?>
                        	<a href="CadastroManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarCadastroAlturaPeso'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroAltura"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro">
                    <div align="left" class="Texto01">
                        <input type="text" name="altura" id="altura" class="CampoNumerico01" maxlength="10" value="<?php echo $tbCadastroAltura;?>" />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroAlturaMedida"); ?>
                    </div>
                </td>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroPeso"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaColuna01">
                    <div align="left" class="Texto01">
                        <input type="text" name="peso" id="peso" class="CampoNumerico01" maxlength="10" value="<?php echo $tbCadastroPeso;?>" />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroPesoMedida"); ?>
                     </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroRazaoSocial'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroRazaoSocial"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left">
                        <input type="text" name="razao_social" id="razao_social" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroRazaoSocial;?>" />
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroNomeFantasia'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroNomeFantasia"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left">
                        <input type="text" name="nome_fantasia" id="nome_fantasia" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroNomeFantasia;?>" />
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroDataNascimento'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroDataNascimento"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
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
                        
                            <input type="text" name="data_nascimento" id="data_nascimento" class="CampoData01" maxlength="10" value="<?php echo $tbCadastroDataNascimento;?>" />
                            <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                        <?php } ?>
                    	<?php //---------------------- ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroData1'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData1'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left">
						<?php //JQuery DatePicker. ?>
						<?php //---------------------- ?>
                    	<?php if($GLOBALS['configTipoCampoCadastroData1'] == 1){ ?>
                            <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 1){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaPtCampos = "#data1";
                                        strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data1;";
                                    </script>
                                <?php } ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 2){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaEnCampos = "#data1";
                                        strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data1;";
                                    </script>
                                <?php } ?>
                                <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                            
                                <input type="text" name="data1" id="data1" class="CampoData01" maxlength="10" value="<?php echo $tbCadastroData1;?>" />
                                <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                            <?php } ?>
                        <?php } ?>
						<?php //---------------------- ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroData2'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData2'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left">
						<?php //JQuery DatePicker. ?>
						<?php //---------------------- ?>
                    	<?php if($GLOBALS['configTipoCampoCadastroData2'] == 1){ ?>
                            <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 1){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaPtCampos = "#data1";
                                        strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data2;";
                                    </script>
                                <?php } ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 2){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaEnCampos = "#data1";
                                        strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data2;";
                                    </script>
                                <?php } ?>
                                <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                            
                                <input type="text" name="data2" id="data2" class="CampoData01" maxlength="10" value="<?php echo $tbCadastroData2;?>" />
                                <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                            <?php } ?>
                        <?php } ?>
						<?php //---------------------- ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroData3'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData3'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left">
						<?php //JQuery DatePicker. ?>
						<?php //---------------------- ?>
                    	<?php if($GLOBALS['configTipoCampoCadastroData3'] == 1){ ?>
                            <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 1){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaPtCampos = "#data1";
                                        strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data3;";
                                    </script>
                                <?php } ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 2){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaEnCampos = "#data1";
                                        strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data3;";
                                    </script>
                                <?php } ?>
                                <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                            
                                <input type="text" name="data3" id="data3" class="CampoData01" maxlength="10" value="<?php echo $tbCadastroData3;?>" />
                                <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                            <?php } ?>
                        <?php } ?>
						<?php //---------------------- ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroData4'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData4'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left">
						<?php //JQuery DatePicker. ?>
						<?php //---------------------- ?>
                    	<?php if($GLOBALS['configTipoCampoCadastroData4'] == 1){ ?>
                            <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 1){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaPtCampos = "#data1";
                                        strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data4;";
                                    </script>
                                <?php } ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 2){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaEnCampos = "#data1";
                                        strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data4;";
                                    </script>
                                <?php } ?>
                                <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                            
                                <input type="text" name="data4" id="data4" class="CampoData01" maxlength="10" value="<?php echo $tbCadastroData4;?>" />
                                <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                            <?php } ?>
                        <?php } ?>
						<?php //---------------------- ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroData5'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData5'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left">
						<?php //JQuery DatePicker. ?>
						<?php //---------------------- ?>
                    	<?php if($GLOBALS['configTipoCampoCadastroData5'] == 1){ ?>
                            <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 1){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaPtCampos = "#data1";
                                        strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data5;";
                                    </script>
                                <?php } ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 2){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaEnCampos = "#data1";
                                        strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data5;";
                                    </script>
                                <?php } ?>
                                <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                            
                                <input type="text" name="data5" id="data5" class="CampoData01" maxlength="10" value="<?php echo $tbCadastroData5;?>" />
                                <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                            <?php } ?>
                        <?php } ?>
						<?php //---------------------- ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroData6'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData6'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left">
						<?php //JQuery DatePicker. ?>
						<?php //---------------------- ?>
                    	<?php if($GLOBALS['configTipoCampoCadastroData6'] == 1){ ?>
                            <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 1){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaPtCampos = "#data1";
                                        strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data6;";
                                    </script>
                                <?php } ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 2){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaEnCampos = "#data1";
                                        strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data6;";
                                    </script>
                                <?php } ?>
                                <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                            
                                <input type="text" name="data6" id="data6" class="CampoData01" maxlength="10" value="<?php echo $tbCadastroData6;?>" />
                                <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                            <?php } ?>
                        <?php } ?>
						<?php //---------------------- ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroData7'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData7'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left">
						<?php //JQuery DatePicker. ?>
						<?php //---------------------- ?>
                    	<?php if($GLOBALS['configTipoCampoCadastroData7'] == 1){ ?>
                            <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 1){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaPtCampos = "#data1";
                                        strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data7;";
                                    </script>
                                <?php } ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 2){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaEnCampos = "#data1";
                                        strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data7;";
                                    </script>
                                <?php } ?>
                                <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                            
                                <input type="text" name="data7" id="data7" class="CampoData01" maxlength="10" value="<?php echo $tbCadastroData7;?>" />
                                <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                            <?php } ?>
                        <?php } ?>
						<?php //---------------------- ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroData8'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData8'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left">
						<?php //JQuery DatePicker. ?>
						<?php //---------------------- ?>
                    	<?php if($GLOBALS['configTipoCampoCadastroData8'] == 1){ ?>
                            <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 1){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaPtCampos = "#data1";
                                        strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data8;";
                                    </script>
                                <?php } ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 2){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaEnCampos = "#data1";
                                        strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data8;";
                                    </script>
                                <?php } ?>
                                <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                            
                                <input type="text" name="data8" id="data8" class="CampoData01" maxlength="10" value="<?php echo $tbCadastroData8;?>" />
                                <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                            <?php } ?>
                        <?php } ?>
						<?php //---------------------- ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroData9'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData9'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left">
						<?php //JQuery DatePicker. ?>
						<?php //---------------------- ?>
                    	<?php if($GLOBALS['configTipoCampoCadastroData9'] == 1){ ?>
                            <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 1){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaPtCampos = "#data1";
                                        strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data9;";
                                    </script>
                                <?php } ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 2){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaEnCampos = "#data1";
                                        strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data9;";
                                    </script>
                                <?php } ?>
                                <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                            
                                <input type="text" name="data9" id="data9" class="CampoData01" maxlength="10" value="<?php echo $tbCadastroData9;?>" />
                                <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                            <?php } ?>
                        <?php } ?>
						<?php //---------------------- ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroData10'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData10'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left">
						<?php //JQuery DatePicker. ?>
						<?php //---------------------- ?>
                    	<?php if($GLOBALS['configTipoCampoCadastroData10'] == 1){ ?>
                            <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 1){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaPtCampos = "#data1";
                                        strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data10;";
                                    </script>
                                <?php } ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 2){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaEnCampos = "#data1";
                                        strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data10;";
                                    </script>
                                <?php } ?>
                                <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                            
                                <input type="text" name="data10" id="data10" class="CampoData01" maxlength="10" value="<?php echo $tbCadastroData10;?>" />
                                <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                            <?php } ?>
                        <?php } ?>
						<?php //---------------------- ?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarCadastroCPFRG'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroCPF"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro">
                    <div align="left">
                        <input type="text" name="cpf_" id="cpf_" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroCPF;?>"<?php if($GLOBALS['configCadastroCPFMascara'] == "1") { ?> onkeypress="javascript:mascaraGenerica('###.###.###-##', this, 'formCadastroEditar', 'cpf_');"<?php } ?> />
                        <span id="lblCPFValidacaoAlerta" class="TextoAlerta" style="display: none;">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroCPFInvalido"); ?>
                        </span>
                        <span id="lblCPFExistenteAlerta" class="TextoAlerta" style="display: none;">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroCPFExistente"); ?>
                        </span>
                        
                        
                        <?php //JQuery - Ajax - CPF Duplicado.?>
                        <?php //----------------------?>
                        <?php if($GLOBALS['configCadastroCPFVerificacaoDuplicado'] == 1){ ?>
							<?php if($tbCadastroCPF <> ""){ ?>
								<script type="text/javascript">
									//$(document).ready(function () {
										campoDesabilitar('cpf_', 'desabilitar');
									//});	
                                </script>
							<?php } ?>
                        
							<script type="text/javascript">
                                $("#cpf_").keyup(function() {
                                    //Variáveis.
                                    var cpfCampo = $(this);
                                    var cpfConsulta = cpfCampo.val().replace(/\D/g,'');
                                    var cpfExistenteRetorno = "";
                                    
                                    var divProgressBar = "updtProgressGenerico";
                                    var btnSubmit = "btnCadastroEditar";
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
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroRG"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaColuna01">
                    <div align="left" class="Texto01">
                        <input type="text" name="rg_" id="rg_" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroRG;?>" />
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroCNPJ'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroCNPJ"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left">
                        <input type="text" name="cnpj_" id="cnpj_" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroCNPJ;?>"<?php if($GLOBALS['configCadastroCNPJMascara'] == "1") { ?> onkeypress="javascript:mascaraGenerica('##.###.###/####-##', this, 'formCadastroEditar', 'cnpj_');"<?php } ?> />
                        <span id="lblCNPJValidacaoAlerta" class="TextoAlerta" style="display: none;">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroCNPJInvalido"); ?>
                        </span>
                        <span id="lblCNPJExistenteAlerta" class="TextoAlerta" style="display: none;">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroCNPJExistente"); ?>
                        </span>

                        <?php //JQuery - Ajax - CPF Duplicado.?>
                        <?php //----------------------?>
                        <?php if($GLOBALS['configCadastroCNPJVerificacaoDuplicado'] == 1){ ?>
							<?php if($tbCadastroCNPJ <> ""){ ?>
								<script type="text/javascript">
									//$(document).ready(function () {
										campoDesabilitar('cnpj_', 'desabilitar');
									//});	
                                </script>
							<?php } ?>
                            
							<script type="text/javascript">
                                $("#cnpj_").keyup(function() {
                                    var cnpjCampo = $(this);
                                    var cnpjConsulta = cnpjCampo.val().replace(/\D/g,'');
                                    var cnpjExistenteRetorno = "";
                                    
                                    var divProgressBar = "updtProgressGenerico";
                                    var btnSubmit = "btnCadastroEditar";
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
            
            <?php if($GLOBALS['habilitarCadastroDocumento'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroDocumento"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left">
                        <input type="text" name="documento" id="documento" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroDocumento;?>" />
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroIEstadualIMunicipal'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroInscricaoMunicipal"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro">
                    <div align="left">
                        <input type="text" name="i_municipal" id="i_municipal" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroIMunicipal;?>" />
                    </div>
                </td>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroInscricaoEstadual"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaColuna01">
                    <div align="left" class="Texto01">
                        <input type="text" name="i_estadual" id="i_estadual" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroIEstadual;?>" />
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            
            <?php //Endereço. ?>
            <?php //---------------------- ?>
            <?php if($GLOBALS['configCadastroIncluirLocalizacao'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroCEPPrincipal"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left">
                        <input type="text" name="cep_principal" id="cep_principal" class="CampoTexto02" maxlength="255" value="<?php echo $tbCadastroCepPrincipal;?>"<?php if($GLOBALS['configCadastroCEPMascara'] == "1") { ?> onkeypress="javascript:mascaraGenerica('##.###-###', this, 'formCadastroEditar', 'cep_principal');"<?php } ?> />
                        <span id="lblCEPAlerta" class="TextoAlerta" style="display: none;">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCEPNaoEncontrado"); ?>
                        </span>
						
						<?php //alertas ?>
                        <?php //echo "tbCadastroCepPrincipal=" . $tbCadastroCepPrincipal; ?>
                        
                        
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
									divShow('updtProgressGenerico');
									
									
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
											divHide('updtProgressGenerico');
											
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
            
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroEnderecoPrincipal"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left">
                        <input type="text" name="endereco_principal" id="endereco_principal" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroEnderecoPrincipal;?>" />
                    </div>
                </td>
            </tr>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroEnderecoNumeroPrincipal"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro">
                    <div align="left">
                        <input type="text" name="endereco_numero_principal" id="endereco_numero_principal" class="CampoTexto02" maxlength="255" value="<?php echo $tbCadastroEnderecoNumeroPrincipal;?>" />
                    </div>
                </td>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroEnderecoComplementoPrincipal"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaColuna01">
                    <div align="left">
                        <input type="text" name="endereco_complemento_principal" id="endereco_complemento_principal" class="CampoTexto02" maxlength="255" value="<?php echo $tbCadastroEnderecoComplementoPrincipal;?>" />
                    </div>
                </td>
            </tr>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroBairroPrincipal"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro">
                    <div align="left">
                        <input type="text" name="bairro_principal" id="bairro_principal" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroBairroPrincipal;?>" />
                    </div>
                </td>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroCidadePrincipal"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaColuna01">
                    <div align="left">
                        <input type="text" name="cidade_principal" id="cidade_principal" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroCidadePrincipal;?>" />
                    </div>
                </td>
            </tr>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroEstadoPrincipal"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro">
                    <div align="left">
                        <input type="text" name="estado_principal" id="estado_principal" class="CampoTexto02" maxlength="255" value="<?php echo $tbCadastroEstadoPrincipal;?>" />
                    </div>
                </td>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroPaisPrincipal"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaColuna01">
                    <div align="left">
                        <input type="text" name="pais_principal" id="pais_principal" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroPaisPrincipal;?>" />
                    </div>
                </td>
            </tr>
            <?php } ?>
            <?php //---------------------- ?>


            <?php if($GLOBALS['habilitarCadastroPontoReferencia'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroPontoReferencia"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left">
                        <textarea name="ponto_referencia" id="ponto_referencia" class="CampoTextoMultilinha01"><?php echo $tbCadastroPontoReferencia;?></textarea>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroEmailPrincipal"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left">
                        <input type="text" name="email_principal" id="email_principal" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroEmailPrincipal;?>" />
                    </div>
                </td>
            </tr>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroTel"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left" class="Texto01">
                        (<input type="text" name="tel_ddd_principal" id="tel_ddd_principal" class="CampoDDD01" maxlength="255" value="<?php echo $tbCadastroTelDDDPrincipal;?>" />)
                        <input type="text" name="tel_principal" id="tel_principal" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroTelPrincipal;?>" />
                    </div>
                </td>
            </tr>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroCel"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left" class="Texto01">
                        (<input type="text" name="cel_ddd_principal" id="cel_ddd_principal" class="CampoDDD01" maxlength="255" value="<?php echo $tbCadastroCelDDDPrincipal;?>" />)
                        <input type="text" name="cel_principal" id="cel_principal" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroCelPrincipal;?>" />
                    </div>
                </td>
            </tr>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroFax"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left" class="Texto01">
                        (<input type="text" name="fax_ddd_principal" id="fax_ddd_principal" class="CampoDDD01" maxlength="255" value="<?php echo $tbCadastroFaxDDDPrincipal;?>" />)
                        <input type="text" name="fax_principal" id="fax_principal" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroFaxPrincipal;?>" />
                    </div>
                </td>
            </tr>
            
            <?php if($GLOBALS['habilitarCadastroSite'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroSitePrincipal"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left" class="Texto01">
                        <input type="text" name="site_principal" id="site_principal" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroSitePrincipal;?>" />
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroNFuncionarios'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroNFuncionarios"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left">
                        <input type="text" name="n_funcionarios" id="n_funcionarios" class="CampoNumerico01" maxlength="255" value="<?php echo $tbCadastroNFuncionarios;?>" />
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroObs"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left">
                        <textarea name="obs_interno" id="obs_interno" class="CampoTextoMultilinha01"><?php echo $tbCadastroOBSInterno;?></textarea>
                    </div>
                </td>
            </tr>
            
            <?php if($GLOBALS['habilitarCadastroVinculo1'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroVinculo1Nome'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
						<?php 
                            $arrCadastroVinculo1 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbCadastroVinculo1'], $GLOBALS['configIdTbTipoCadastroVinculo1'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoCadastroVinculo1'], $GLOBALS['configCadastroVinculo1Metodo']);
                        ?>
                        <select name="id_tb_cadastro1" id="id_tb_cadastro1" class="CampoDropDownMenu01">
                            <option value="0"<?php if($tbCadastroIdTbCadastro1 == 0){ ?>selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNenhumDropDown"); ?></option>
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
            
            <?php if($GLOBALS['habilitarCadastroVinculo2'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroVinculo2Nome'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
						<?php 
                            $arrCadastroVinculo2 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbCadastroVinculo2'], $GLOBALS['configIdTbTipoCadastroVinculo2'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoCadastroVinculo2'], $GLOBALS['configCadastroVinculo2Metodo']);
                        ?>
                        <select name="id_tb_cadastro2" id="id_tb_cadastro2" class="CampoDropDownMenu01">
                            <option value="0"<?php if($tbCadastroIdTbCadastro2 == 0){ ?>selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNenhumDropDown"); ?></option>
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
            
            <?php if($GLOBALS['habilitarCadastroVinculo3'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroVinculo3Nome'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
						<?php 
                            $arrCadastroVinculo3 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbCadastroVinculo3'], $GLOBALS['configIdTbTipoCadastroVinculo3'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoCadastroVinculo3'], $GLOBALS['configCadastroVinculo3Metodo']);
                        ?>
                        <select name="id_tb_cadastro3" id="id_tb_cadastro3" class="CampoDropDownMenu01">
                            <option value="0"<?php if($tbCadastroIdTbCadastro3 == 0){ ?>selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNenhumDropDown"); ?></option>
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

            <?php if($GLOBALS['habilitarCadastroStatus'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroStatus"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
						<?php 
                            $arrCadastroStatus = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 3);
                        ?>
                        <select name="id_tb_cadastro_status" id="id_tb_cadastro_status" class="CampoDropDownMenu01">
                            <option value="0"<?php if($tbCadastroIdTbCadastroStatus == "0"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
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
            
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao3"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left" class="Texto01">
                        <select name="ativacao" id="ativacao" class="CampoDropDownMenu01">
                            <option value="0"<?php if($tbCadastroAtivacao == "0"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao4"); ?></option>
                            <option value="1"<?php if($tbCadastroAtivacao == "1"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao5"); ?></option>
                        </select>
                    </div>
                </td>
            </tr>
            
            <?php if($GLOBALS['habilitarCadastroAtivacaoMalaDireta'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroAtivacaoMalaDireta"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left" class="Texto01">
                        <select name="ativacao_mala_direta" id="ativacao_mala_direta" class="CampoDropDownMenu01">
                            <option value="0"<?php if($tbCadastroAtivacaoMalaDireta == "0"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao4"); ?></option>
                            <option value="1"<?php if($tbCadastroAtivacaoMalaDireta == "1"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao5"); ?></option>
                        </select>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroUsuario'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroUsuario"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left">
                        <input type="text" name="usuario" id="usuario" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroUsuario;?>" />
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroSenha'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroSenha"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left">
						<?php if($GLOBALS['configCadastroMetodoSenha'] == 2){ ?>
                            <?php if($GLOBALS['configCadastroSenha'] == 1){ ?>
                                <?php //echo Crypto::DecryptValue(EncryptValue(Funcoes::ConteudoMascaraLeitura($linhaCadastro['senha']), 2), 2);?>
                                <input type="password" name="senha" id="senha" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroSenha;?>" />
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroImagem'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemImagem"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                <div>
                    <table cellpadding="0" cellspacing="0" style="width: 100%;">
                        <tr>
                            <td width="1">
                                <input type="file" name="ArquivoUpload" id="ArquivoUpload" class="CampoArquivoUpload01" />
                            </td>
                            
                            <?php if(!empty($tbCadastroImagem)){ //if($tbCategoriasImagem <> ""){?>
                            <td width="1">
                                <img src="<?php echo $GLOBALS['configDiretorioArquivos'];?>/t<?php echo $tbCadastroImagem; ?>?variavelCache=<?php echo date("s"); ?>" alt="<?php echo $tbCadastroImagem; ?>" style="margin-left: 4px;" />
                            </td>
                            <td>
                                <a href="RegistrosArquivosExcluirExe.php?idRegistro=<?php echo $tbCadastroId;?>&strTabela=tb_cadastro&strCampo=imagem<?php echo $queryPadrao;?>" class="LinksExcluir01" style="margin-left: 4px;">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemImagemExcluir"); ?>
                                </a>
                            </td>
                            <?php } ?>
                            
                        </tr>
                    </table>
                </div>
                </td>
            </tr>
            <?php } ?>
            
			<?php if($GLOBALS['habilitarCadastroArquivo1'] == 1){ ?>
			<tr>
				<td class="TbFundoMedio TabelaColuna01">
					<div align="left" class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroTituloArquivo1'], "IncludeConfig"); ?>:
					</div>
				</td>
				<td class="TbFundoClaro" colspan="3">
                    <div class="Texto01" style="white-space: nowrap">
					
                        <table cellpadding="0" cellspacing="0" style="width: 100%;">
                            <tr>
                                <td width="1">
                                    <input type="file" name="ArquivoUpload1" id="ArquivoUpload1" class="CampoArquivoUpload01" />
                                </td>
                                
								<?php if(!empty($tbCadastroArquivo1)){ //if($tbCategoriasImagem <> ""){?>
                                <td width="1">
                                	<?php //Imagem. ?>
                                    <?php if($GLOBALS['configCadastroArquivo1'] == 1){ ?>
                                        <img src="<?php echo $GLOBALS['configDiretorioArquivos'];?>/t<?php echo $tbCadastroArquivo1; ?>?variavelCache=<?php echo date("s"); ?>" alt="<?php echo $tbCadastroArquivo1; ?>" style="margin-left: 4px;" />
                                    <?php } ?>
                                    
                                	<?php //Arquivo. ?>
                                    <?php if($GLOBALS['configCadastroArquivo1'] == 3){ ?>
										<?php 
                                        //Rotina para ajudar a verificar a extensão do arquivo.
                                        $arrArquivoExtensao = explode(".", $tbCadastroArquivo1);
                                        $arquivoExtensao = strtolower(end($arrArquivoExtensao));
                                        ?>
                                        <?php if(strpos($GLOBALS['configImagensFormatos'], $arquivoExtensao) !== false) {?>
                                            <a href="<?php echo "ArquivosDownload.php?nomeArquivo=" . "o" . $tbCadastroArquivo1; //Imagens - incluir 'o' na frente do nome do arquivo.?>" target="_blank" class="ConteudoLinks">
                                                <?php echo $tbCadastroArquivo1; ?>
                                            </a>
                                        <?php }else{ ?>
                                            <a href="<?php echo "ArquivosDownload.php?nomeArquivo=" . $tbCadastroArquivo1;?>" target="_blank" class="ConteudoLinks">
                                                <?php echo $tbCadastroArquivo1; ?>
                                            </a>
                                        <?php } ?>
                                    <?php } ?>
                                </td>
                                <td>
                                    <a href="RegistrosArquivosExcluirExe.php?idRegistro=<?php echo $tbCadastroId;?>&strTabela=tb_cadastro&strCampo=arquivo1<?php echo $queryPadrao;?>" class="LinksExcluir01" style="margin-left: 4px;">
                                        <?php if($GLOBALS['configCadastroArquivo1'] == 1){ ?>
											<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemImagemExcluir"); ?>
                                        <?php } ?>
										<?php if($GLOBALS['configCadastroArquivo1'] == 3){ ?>
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemArquivoExcluir"); ?>
                                        <?php } ?>
                                    </a>
                                </td>
                                <?php } ?>
                                
                            </tr>
                        </table>
					
                    </div>
				</td>
			</tr>
            <?php } ?>
            
			<?php if($GLOBALS['habilitarCadastroArquivo2'] == 1){ ?>
			<tr>
				<td class="TbFundoMedio TabelaColuna01">
					<div align="left" class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroTituloArquivo2'], "IncludeConfig"); ?>:
					</div>
				</td>
				<td class="TbFundoClaro" colspan="3">
                    <div class="Texto01" style="white-space: nowrap">
                        <table cellpadding="0" cellspacing="0" style="width: 100%;">
                            <tr>
                                <td width="1">
                                    <input type="file" name="ArquivoUpload2" id="ArquivoUpload2" class="CampoArquivoUpload01" />
                                </td>
                                
                                <?php if(!empty($tbCadastroArquivo2)){ //if($tbCategoriasImagem <> ""){?>
                                <td width="1">
                                	<?php //Imagem. ?>
                                    <?php if($GLOBALS['configCadastroArquivo2'] == 1){ ?>
                                        <img src="<?php echo $GLOBALS['configDiretorioArquivos'];?>/t<?php echo $tbCadastroArquivo2; ?>?variavelCache=<?php echo date("s"); ?>" alt="<?php echo $tbCadastroArquivo2; ?>" style="margin-left: 4px;" />
									<?php } ?>

                                	<?php //Arquivo. ?>
                                    <?php if($GLOBALS['configCadastroArquivo2'] == 3){ ?>
										<?php 
                                        //Rotina para ajudar a verificar a extensão do arquivo.
                                        $arrArquivoExtensao = explode(".", $tbCadastroArquivo2);
                                        $arquivoExtensao = strtolower(end($arrArquivoExtensao));
                                        ?>
                                        <?php if(strpos($GLOBALS['configImagensFormatos'], $arquivoExtensao) !== false) {?>
                                            <a href="<?php echo "ArquivosDownload.php?nomeArquivo=" . "o" . $tbCadastroArquivo2; //Imagens - incluir 'o' na frente do nome do arquivo.?>" target="_blank" class="ConteudoLinks">
                                                <?php echo $tbCadastroArquivo2; ?>
                                            </a>
                                        <?php }else{ ?>
                                            <a href="<?php echo "ArquivosDownload.php?nomeArquivo=" . $tbCadastroArquivo2;?>" target="_blank" class="ConteudoLinks">
                                                <?php echo $tbCadastroArquivo2; ?>
                                            </a>
                                        <?php } ?>
									<?php } ?>
                                </td>
                                <td>
                                    <a href="RegistrosArquivosExcluirExe.php?idRegistro=<?php echo $tbCadastroId;?>&strTabela=tb_cadastro&strCampo=arquivo2<?php echo $queryPadrao;?>" class="LinksExcluir01" style="margin-left: 4px;">
                                        <?php if($GLOBALS['configCadastroArquivo2'] == 1){ ?>
											<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemImagemExcluir"); ?>
                                        <?php } ?>
										<?php if($GLOBALS['configCadastroArquivo2'] == 3){ ?>
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemArquivoExcluir"); ?>
                                        <?php } ?>
                                    </a>
                                </td>
                                <?php } ?>
                            </tr>
                        </table>
                    </div>
				</td>
			</tr>
            <?php } ?>
            
			<?php if($GLOBALS['habilitarCadastroArquivo3'] == 1){ ?>
			<tr>
				<td class="TbFundoMedio TabelaColuna01">
					<div align="left" class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroTituloArquivo3'], "IncludeConfig"); ?>:
					</div>
				</td>
				<td class="TbFundoClaro" colspan="3">
                    <div class="Texto01" style="white-space: nowrap">
                        <table cellpadding="0" cellspacing="0" style="width: 100%;">
                            <tr>
                                <td width="1">
                                    <input type="file" name="ArquivoUpload3" id="ArquivoUpload3" class="CampoArquivoUpload01" />
                                </td>
                                
                                <?php if(!empty($tbCadastroArquivo3)){ //if($tbCategoriasImagem <> ""){?>
                                <td width="1">
                                	<?php //Imagem. ?>
                                    <?php if($GLOBALS['configCadastroArquivo3'] == 1){ ?>
                                        <img src="<?php echo $GLOBALS['configDiretorioArquivos'];?>/t<?php echo $tbCadastroArquivo3; ?>?variavelCache=<?php echo date("s"); ?>" alt="<?php echo $tbCadastroArquivo3; ?>" style="margin-left: 4px;" />
									<?php } ?>

                                	<?php //Arquivo. ?>
                                    <?php if($GLOBALS['configCadastroArquivo3'] == 3){ ?>
										<?php 
                                        //Rotina para ajudar a verificar a extensão do arquivo.
                                        $arrArquivoExtensao = explode(".", $tbCadastroArquivo3);
                                        $arquivoExtensao = strtolower(end($arrArquivoExtensao));
                                        ?>
                                        <?php if(strpos($GLOBALS['configImagensFormatos'], $arquivoExtensao) !== false) {?>
                                            <a href="<?php echo "ArquivosDownload.php?nomeArquivo=" . "o" . $tbCadastroArquivo3; //Imagens - incluir 'o' na frente do nome do arquivo.?>" target="_blank" class="ConteudoLinks">
                                                <?php echo $tbCadastroArquivo3; ?>
                                            </a>
                                        <?php }else{ ?>
                                            <a href="<?php echo "ArquivosDownload.php?nomeArquivo=" . $tbCadastroArquivo3;?>" target="_blank" class="ConteudoLinks">
                                                <?php echo $tbCadastroArquivo3; ?>
                                            </a>
                                        <?php } ?>
									<?php } ?>
                                </td>
                                <td>
                                    <a href="RegistrosArquivosExcluirExe.php?idRegistro=<?php echo $tbCadastroId;?>&strTabela=tb_cadastro&strCampo=arquivo3<?php echo $queryPadrao;?>" class="LinksExcluir01" style="margin-left: 4px;">
                                        <?php if($GLOBALS['configCadastroArquivo3'] == 1){ ?>
											<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemImagemExcluir"); ?>
                                        <?php } ?>
										<?php if($GLOBALS['configCadastroArquivo3'] == 3){ ?>
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemArquivoExcluir"); ?>
                                        <?php } ?>
                                    </a>
                                </td>
                                <?php } ?>
                            </tr>
                        </table>
                    </div>
				</td>
			</tr>
            <?php } ?>
            
			<?php if($GLOBALS['habilitarCadastroArquivo4'] == 1){ ?>
			<tr>
				<td class="TbFundoMedio TabelaColuna01">
					<div align="left" class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroTituloArquivo4'], "IncludeConfig"); ?>:
					</div>
				</td>
				<td class="TbFundoClaro" colspan="3">
                    <div class="Texto01" style="white-space: nowrap">
                        <table cellpadding="0" cellspacing="0" style="width: 100%;">
                            <tr>
                                <td width="1">
                                    <input type="file" name="ArquivoUpload4" id="ArquivoUpload4" class="CampoArquivoUpload01" />
                                </td>
                                
                                <?php if(!empty($tbCadastroArquivo4)){ //if($tbCategoriasImagem <> ""){?>
                                <td width="1">
                                	<?php //Imagem. ?>
                                    <?php if($GLOBALS['configCadastroArquivo4'] == 1){ ?>
                                        <img src="<?php echo $GLOBALS['configDiretorioArquivos'];?>/t<?php echo $tbCadastroArquivo4; ?>?variavelCache=<?php echo date("s"); ?>" alt="<?php echo $tbCadastroArquivo4; ?>" style="margin-left: 4px;" />
									<?php } ?>

                                	<?php //Arquivo. ?>
                                    <?php if($GLOBALS['configCadastroArquivo4'] == 3){ ?>
										<?php 
                                        //Rotina para ajudar a verificar a extensão do arquivo.
                                        $arrArquivoExtensao = explode(".", $tbCadastroArquivo4);
                                        $arquivoExtensao = strtolower(end($arrArquivoExtensao));
                                        ?>
                                        <?php if(strpos($GLOBALS['configImagensFormatos'], $arquivoExtensao) !== false) {?>
                                            <a href="<?php echo "ArquivosDownload.php?nomeArquivo=" . "o" . $tbCadastroArquivo4; //Imagens - incluir 'o' na frente do nome do arquivo.?>" target="_blank" class="ConteudoLinks">
                                                <?php echo $tbCadastroArquivo4; ?>
                                            </a>
                                        <?php }else{ ?>
                                            <a href="<?php echo "ArquivosDownload.php?nomeArquivo=" . $tbCadastroArquivo4;?>" target="_blank" class="ConteudoLinks">
                                                <?php echo $tbCadastroArquivo4; ?>
                                            </a>
                                        <?php } ?>
									<?php } ?>
                                </td>
                                <td>
                                    <a href="RegistrosArquivosExcluirExe.php?idRegistro=<?php echo $tbCadastroId;?>&strTabela=tb_cadastro&strCampo=arquivo4<?php echo $queryPadrao;?>" class="LinksExcluir01" style="margin-left: 4px;">
                                        <?php if($GLOBALS['configCadastroArquivo4'] == 1){ ?>
											<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemImagemExcluir"); ?>
                                        <?php } ?>
										<?php if($GLOBALS['configCadastroArquivo4'] == 3){ ?>
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemArquivoExcluir"); ?>
                                        <?php } ?>
                                    </a>
                                </td>
                                <?php } ?>
                            </tr>
                        </table>
                    </div>
				</td>
			</tr>
            <?php } ?>
            
			<?php if($GLOBALS['habilitarCadastroArquivo5'] == 1){ ?>
			<tr>
				<td class="TbFundoMedio TabelaColuna01">
					<div align="left" class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroTituloArquivo5'], "IncludeConfig"); ?>:
					</div>
				</td>
				<td class="TbFundoClaro" colspan="3">
                    <div class="Texto01" style="white-space: nowrap">
                        <table cellpadding="0" cellspacing="0" style="width: 100%;">
                            <tr>
                                <td width="1">
                                    <input type="file" name="ArquivoUpload5" id="ArquivoUpload5" class="CampoArquivoUpload01" />
                                </td>
                                
                                <?php if(!empty($tbCadastroArquivo5)){ //if($tbCategoriasImagem <> ""){?>
                                <td width="1">
                                	<?php //Imagem. ?>
                                    <?php if($GLOBALS['configCadastroArquivo5'] == 1){ ?>
                                        <img src="<?php echo $GLOBALS['configDiretorioArquivos'];?>/t<?php echo $tbCadastroArquivo5; ?>?variavelCache=<?php echo date("s"); ?>" alt="<?php echo $tbCadastroArquivo5; ?>" style="margin-left: 4px;" />
									<?php } ?>

                                	<?php //Arquivo. ?>
                                    <?php if($GLOBALS['configCadastroArquivo5'] == 3){ ?>
										<?php 
                                        //Rotina para ajudar a verificar a extensão do arquivo.
                                        $arrArquivoExtensao = explode(".", $tbCadastroArquivo5);
                                        $arquivoExtensao = strtolower(end($arrArquivoExtensao));
                                        ?>
                                        <?php if(strpos($GLOBALS['configImagensFormatos'], $arquivoExtensao) !== false) {?>
                                            <a href="<?php echo "ArquivosDownload.php?nomeArquivo=" . "o" . $tbCadastroArquivo5; //Imagens - incluir 'o' na frente do nome do arquivo.?>" target="_blank" class="ConteudoLinks">
                                                <?php echo $tbCadastroArquivo5; ?>
                                            </a>
                                        <?php }else{ ?>
                                            <a href="<?php echo "ArquivosDownload.php?nomeArquivo=" . $tbCadastroArquivo5;?>" target="_blank" class="ConteudoLinks">
                                                <?php echo $tbCadastroArquivo5; ?>
                                            </a>
                                        <?php } ?>
									<?php } ?>
                                </td>
                                <td>
                                    <a href="RegistrosArquivosExcluirExe.php?idRegistro=<?php echo $tbCadastroId;?>&strTabela=tb_cadastro&strCampo=arquivo5<?php echo $queryPadrao;?>" class="LinksExcluir01" style="margin-left: 4px;">
                                        <?php if($GLOBALS['configCadastroArquivo5'] == 1){ ?>
											<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemImagemExcluir"); ?>
                                        <?php } ?>
										<?php if($GLOBALS['configCadastroArquivo5'] == 3){ ?>
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemArquivoExcluir"); ?>
                                        <?php } ?>
                                    </a>
                                </td>
                                <?php } ?>
                            </tr>
                        </table>
                    </div>
				</td>
			</tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroMapaOnline'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroMapaOnline"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left" class="Texto01">
                        <textarea name="mapa_online" id="mapa_online" class="CampoTextoMultilinha01"><?php echo $tbCadastroMapaOnline;?></textarea>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroPalavrasChave'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemPalavrasChave01"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left" class="Texto01">
                        <textarea name="palavras_chave" id="palavras_chave" class="CampoTextoMultilinha01"><?php echo $tbCadastroPalavrasChave;?></textarea>
                        <br />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemPalavrasChave02"); ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroApresentacao'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroApresentacao"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div>
                        <?php //Sem formatação.?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                            <textarea name="apresentacao" id="apresentacao" class="CampoTextoMultilinhaConteudo"><?php echo $tbCadastroApresentacao;?></textarea>
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
            <?php if($GLOBALS['habilitarCadastroServicos'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroServicos"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div>
                        <?php //Sem formatação.?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                            <textarea name="servicos" id="servicos" class="CampoTextoMultilinhaConteudo"><?php echo $tbCadastroServicos;?></textarea>
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
            <?php if($GLOBALS['HabilitarCadastroPromocoes'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroPromocoes"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div>
                        <?php //Sem formatação.?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                            <textarea name="promocoes" id="promocoes" class="CampoTextoMultilinhaConteudo"><?php echo $tbCadastroPromocoes;?></textarea>
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
            <?php if($GLOBALS['habilitarCadastroCondicoesComerciais'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroCondicoesComerciais"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div>
                        <?php //Sem formatação.?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                            <textarea name="condicoes_comerciais" id="condicoes_comerciais" class="CampoTextoMultilinhaConteudo"><?php echo $tbCadastroCondicoesComerciais;?></textarea>
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
            <?php if($GLOBALS['habilitarCadastroFormasPagamento'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroFormasPagamento"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div>
                        <?php //Sem formatação.?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                            <textarea name="formas_pagamento" id="formas_pagamento" class="CampoTextoMultilinhaConteudo"><?php echo $tbCadastroFormasPagamento;?></textarea>
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
            
            <?php if($GLOBALS['habilitarCadastroHorarioAtendimento'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroHorarioAtendimento"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div>
                        <?php //Sem formatação.?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                            <textarea name="horario_atendimento" id="horario_atendimento" class="CampoTextoMultilinhaConteudo"><?php echo $tbCadastroHorarioAtendimento;?></textarea>
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
            <?php if($GLOBALS['habilitarCadastroSituacaoAtual'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroSituacaoAtual"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div>
                        <?php //Sem formatação.?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                            <textarea name="situacao_atual" id="situacao_atual" class="CampoTextoMultilinhaConteudo"><?php echo $tbCadastroSituacaoAtual;?></textarea>
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
            
            <?php if($GLOBALS['habilitarCadastroIc1'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc1'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc1'] == 1){ ?>
                            <input type="text" name="informacao_complementar1" id="informacao_complementar1" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroIC1;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc1'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar1" id="informacao_complementar1" class="CampoTextoMultilinha01"><?php echo $tbCadastroIC1;?></textarea>
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
            
            <?php if($GLOBALS['habilitarCadastroIc2'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc2'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc2'] == 1){ ?>
                            <input type="text" name="informacao_complementar2" id="informacao_complementar2" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroIC2;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc2'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar2" id="informacao_complementar2" class="CampoTextoMultilinha01"><?php echo $tbCadastroIC2;?></textarea>
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
        
            <?php if($GLOBALS['habilitarCadastroIc3'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc3'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc3'] == 1){ ?>
                            <input type="text" name="informacao_complementar3" id="informacao_complementar3" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroIC3;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc3'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar3" id="informacao_complementar3" class="CampoTextoMultilinha01"><?php echo $tbCadastroIC3;?></textarea>
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
        
            <?php if($GLOBALS['habilitarCadastroIc4'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc4'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc4'] == 1){ ?>
                            <input type="text" name="informacao_complementar4" id="informacao_complementar4" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroIC4;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc4'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar4" id="informacao_complementar4" class="CampoTextoMultilinha01"><?php echo $tbCadastroIC4;?></textarea>
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
        
            <?php if($GLOBALS['habilitarCadastroIc5'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc5'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc5'] == 1){ ?>
                            <input type="text" name="informacao_complementar5" id="informacao_complementar5" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroIC5;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc5'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar5" id="informacao_complementar5" class="CampoTextoMultilinha01"><?php echo $tbCadastroIC5;?></textarea>
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
            
            <?php if($GLOBALS['habilitarCadastroIc6'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc6'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc6'] == 1){ ?>
                            <input type="text" name="informacao_complementar6" id="informacao_complementar6" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroIC6;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc6'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar6" id="informacao_complementar6" class="CampoTextoMultilinha01"><?php echo $tbCadastroIC6;?></textarea>
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
            
            <?php if($GLOBALS['habilitarCadastroIc7'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc7'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc7'] == 1){ ?>
                            <input type="text" name="informacao_complementar7" id="informacao_complementar7" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroIC7;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc7'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar7" id="informacao_complementar7" class="CampoTextoMultilinha01"><?php echo $tbCadastroIC7;?></textarea>
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
        
            <?php if($GLOBALS['habilitarCadastroIc8'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc8'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc8'] == 1){ ?>
                            <input type="text" name="informacao_complementar8" id="informacao_complementar8" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroIC8;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc8'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar8" id="informacao_complementar8" class="CampoTextoMultilinha01"><?php echo $tbCadastroIC8;?></textarea>
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
        
            <?php if($GLOBALS['habilitarCadastroIc9'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc9'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc9'] == 1){ ?>
                            <input type="text" name="informacao_complementar9" id="informacao_complementar9" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroIC9;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc9'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar9" id="informacao_complementar9" class="CampoTextoMultilinha01"><?php echo $tbCadastroIC9;?></textarea>
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
        
            <?php if($GLOBALS['habilitarCadastroIc10'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc10'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc10'] == 1){ ?>
                            <input type="text" name="informacao_complementar10" id="informacao_complementar10" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroIC10;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc10'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar10" id="informacao_complementar10" class="CampoTextoMultilinha01"><?php echo $tbCadastroIC10;?></textarea>
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
            
            <?php if($GLOBALS['habilitarCadastroIc11'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc11'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc11'] == 1){ ?>
                            <input type="text" name="informacao_complementar11" id="informacao_complementar11" class="CampoTexto01" maxlength="255"  value="<?php echo $tbCadastroIC11;?>"/>
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc11'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar11" id="informacao_complementar11" class="CampoTextoMultilinha01"><?php echo $tbCadastroIC11;?></textarea>
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
            
            <?php if($GLOBALS['habilitarCadastroIc12'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc12'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc12'] == 1){ ?>
                            <input type="text" name="informacao_complementar12" id="informacao_complementar12" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroIC12;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc12'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar12" id="informacao_complementar12" class="CampoTextoMultilinha01"><?php echo $tbCadastroIC12;?></textarea>
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
        
            <?php if($GLOBALS['habilitarCadastroIc13'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc13'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc13'] == 1){ ?>
                            <input type="text" name="informacao_complementar13" id="informacao_complementar13" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroIC13;?>">
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc13'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar13" id="informacao_complementar13" class="CampoTextoMultilinha01"><?php echo $tbCadastroIC13;?></textarea>
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
        
            <?php if($GLOBALS['habilitarCadastroIc14'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc14'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc14'] == 1){ ?>
                            <input type="text" name="informacao_complementar14" id="informacao_complementar14" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroIC14;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc14'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar14" id="informacao_complementar14" class="CampoTextoMultilinha01"><?php echo $tbCadastroIC14;?></textarea>
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
        
            <?php if($GLOBALS['habilitarCadastroIc15'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc15'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc15'] == 1){ ?>
                            <input type="text" name="informacao_complementar15" id="informacao_complementar15" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroIC15;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc15'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar15" id="informacao_complementar15" class="CampoTextoMultilinha01"><?php echo $tbCadastroIC15;?></textarea>
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
            
            <?php if($GLOBALS['habilitarCadastroIc16'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc16'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc16'] == 1){ ?>
                            <input type="text" name="informacao_complementar16" id="informacao_complementar16" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroIC16;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc16'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar16" id="informacao_complementar16" class="CampoTextoMultilinha01"><?php echo $tbCadastroIC16;?></textarea>
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
            
            <?php if($GLOBALS['habilitarCadastroIc17'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc17'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc17'] == 1){ ?>
                            <input type="text" name="informacao_complementar17" id="informacao_complementar17" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroIC17;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc12'] == 7){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar17" id="informacao_complementar17" class="CampoTextoMultilinha01"><?php echo $tbCadastroIC17;?></textarea>
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
        
            <?php if($GLOBALS['habilitarCadastroIc18'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc18'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc18'] == 1){ ?>
                            <input type="text" name="informacao_complementar18" id="informacao_complementar18" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroIC18;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc18'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar18" id="informacao_complementar18" class="CampoTextoMultilinha01"><?php echo $tbCadastroIC18;?></textarea>
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
        
            <?php if($GLOBALS['habilitarCadastroIc19'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc19'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc19'] == 1){ ?>
                            <input type="text" name="informacao_complementar19" id="informacao_complementar19" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroIC19;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc19'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar19" id="informacao_complementar19" class="CampoTextoMultilinha01"><?php echo $tbCadastroIC19;?></textarea>
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
        
            <?php if($GLOBALS['habilitarCadastroIc20'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc20'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc20'] == 1){ ?>
                            <input type="text" name="informacao_complementar20" id="informacao_complementar20" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroIC20;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc20'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar20" id="informacao_complementar20" class="CampoTextoMultilinha01"><?php echo $tbCadastroIC20;?></textarea>
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
            
            <?php if($GLOBALS['habilitarCadastroIc21'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc21'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc21'] == 1){ ?>
                            <input type="text" name="informacao_complementar21" id="informacao_complementar21" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroIC21;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc21'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar21" id="informacao_complementar21" class="CampoTextoMultilinha01"><?php echo $tbCadastroIC21;?></textarea>
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
            
            <?php if($GLOBALS['habilitarCadastroIc22'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc22'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc22'] == 1){ ?>
                            <input type="text" name="informacao_complementar22" id="informacao_complementar22" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroIC22;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc22'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar22" id="informacao_complementar22" class="CampoTextoMultilinha01"><?php echo $tbCadastroIC22;?></textarea>
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
        
            <?php if($GLOBALS['habilitarCadastroIc23'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc23'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc23'] == 1){ ?>
                            <input type="text" name="informacao_complementar23" id="informacao_complementar23" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroIC23;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc23'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar23" id="informacao_complementar23" class="CampoTextoMultilinha01"><?php echo $tbCadastroIC23;?></textarea>
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
        
            <?php if($GLOBALS['habilitarCadastroIc24'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc24'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc24'] == 1){ ?>
                            <input type="text" name="informacao_complementar24" id="informacao_complementar24" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroIC24;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc24'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar24" id="informacao_complementar24" class="CampoTextoMultilinha01"><?php echo $tbCadastroIC24;?></textarea>
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
        
            <?php if($GLOBALS['habilitarCadastroIc25'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc25'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc25'] == 1){ ?>
                            <input type="text" name="informacao_complementar25" id="informacao_complementar25" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroIC25;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc25'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar25" id="informacao_complementar25" class="CampoTextoMultilinha01"><?php echo $tbCadastroIC25;?></textarea>
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
            
            <?php if($GLOBALS['habilitarCadastroIc26'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc26'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc26'] == 1){ ?>
                            <input type="text" name="informacao_complementar26" id="informacao_complementar26" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroIC26;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc26'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar26" id="informacao_complementar26" class="CampoTextoMultilinha01"><?php echo $tbCadastroIC26;?></textarea>
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
            
            <?php if($GLOBALS['habilitarCadastroIc27'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc27'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc27'] == 1){ ?>
                            <input type="text" name="informacao_complementar27" id="informacao_complementar27" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroIC27;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc22'] == 7){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar27" id="informacao_complementar27" class="CampoTextoMultilinha01"><?php echo $tbCadastroIC27;?></textarea>
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
        
            <?php if($GLOBALS['habilitarCadastroIc28'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc28'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc28'] == 1){ ?>
                            <input type="text" name="informacao_complementar28" id="informacao_complementar28" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroIC28;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc28'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar28" id="informacao_complementar28" class="CampoTextoMultilinha01"><?php echo $tbCadastroIC28;?></textarea>
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
        
            <?php if($GLOBALS['habilitarCadastroIc29'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc29'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc29'] == 1){ ?>
                            <input type="text" name="informacao_complementar29" id="informacao_complementar29" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroIC29;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc29'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar29" id="informacao_complementar29" class="CampoTextoMultilinha01"><?php echo $tbCadastroIC29;?></textarea>
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
        
            <?php if($GLOBALS['habilitarCadastroIc30'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc30'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc30'] == 1){ ?>
                            <input type="text" name="informacao_complementar30" id="informacao_complementar30" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroIC30;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc30'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar30" id="informacao_complementar30" class="CampoTextoMultilinha01"><?php echo $tbCadastroIC30;?></textarea>
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
            
            <?php if($GLOBALS['habilitarCadastroIc31'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc31'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc31'] == 1){ ?>
                            <input type="text" name="informacao_complementar31" id="informacao_complementar31" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroIC31;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc31'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar31" id="informacao_complementar31" class="CampoTextoMultilinha01"><?php echo $tbCadastroIC31;?></textarea>
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
            
            <?php if($GLOBALS['habilitarCadastroIc32'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc32'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc32'] == 1){ ?>
                            <input type="text" name="informacao_complementar32" id="informacao_complementar32" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroIC32;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc32'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar32" id="informacao_complementar32" class="CampoTextoMultilinha01"><?php echo $tbCadastroIC32;?></textarea>
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
        
            <?php if($GLOBALS['habilitarCadastroIc33'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc33'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc33'] == 1){ ?>
                            <input type="text" name="informacao_complementar33" id="informacao_complementar33" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroIC33;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc33'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar33" id="informacao_complementar33" class="CampoTextoMultilinha01"><?php echo $tbCadastroIC33;?></textarea>
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
        
            <?php if($GLOBALS['habilitarCadastroIc34'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc34'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc34'] == 1){ ?>
                            <input type="text" name="informacao_complementar34" id="informacao_complementar34" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroIC34;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc34'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar34" id="informacao_complementar34" class="CampoTextoMultilinha01"><?php echo $tbCadastroIC34;?></textarea>
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
        
            <?php if($GLOBALS['habilitarCadastroIc35'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc35'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc35'] == 1){ ?>
                            <input type="text" name="informacao_complementar35" id="informacao_complementar35" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroIC35;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc35'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar35" id="informacao_complementar35" class="CampoTextoMultilinha01"><?php echo $tbCadastroIC35;?></textarea>
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
            
            <?php if($GLOBALS['habilitarCadastroIc36'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc36'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc36'] == 1){ ?>
                            <input type="text" name="informacao_complementar36" id="informacao_complementar36" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroIC36;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc36'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar36" id="informacao_complementar36" class="CampoTextoMultilinha01"><?php echo $tbCadastroIC36;?></textarea>
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
            
            <?php if($GLOBALS['habilitarCadastroIc37'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc37'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc37'] == 1){ ?>
                            <input type="text" name="informacao_complementar37" id="informacao_complementar37" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroIC37;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc32'] == 7){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar37" id="informacao_complementar37" class="CampoTextoMultilinha01"><?php echo $tbCadastroIC37;?></textarea>
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
        
            <?php if($GLOBALS['habilitarCadastroIc38'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc38'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc38'] == 1){ ?>
                            <input type="text" name="informacao_complementar38" id="informacao_complementar38" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroIC38;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc38'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar38" id="informacao_complementar38" class="CampoTextoMultilinha01"><?php echo $tbCadastroIC38;?></textarea>
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
        
            <?php if($GLOBALS['habilitarCadastroIc39'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc39'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc39'] == 1){ ?>
                            <input type="text" name="informacao_complementar39" id="informacao_complementar39" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroIC39;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc39'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar39" id="informacao_complementar39" class="CampoTextoMultilinha01"><?php echo $tbCadastroIC39;?></textarea>
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
        
            <?php if($GLOBALS['habilitarCadastroIc40'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc40'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configCadastroBoxIc40'] == 1){ ?>
                            <input type="text" name="informacao_complementar40" id="informacao_complementar40" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroIC40;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configCadastroBoxIc40'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar40" id="informacao_complementar40" class="CampoTextoMultilinha01"><?php echo $tbCadastroIC40;?></textarea>
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
            
        </table>
        <div>
            <div style="float:left;">
                <input type="image" id="btnCadastroEditar" name="submit" value="Submit" src="img/btoAtualizar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoAtualizar"); ?>" />
                
                <input type="hidden" id="idTbCadastro" name="idTbCadastro" value="<?php echo $tbCadastroId; ?>" />
                <?php if($GLOBALS['habilitarCadastroEdicaoCategorias'] == 0){ ?>
					<input type="hidden" id="id_tb_categorias" name="id_tb_categorias" value="<?php echo $tbCadastroIdTbCategorias; ?>" />
                <?php } ?>
				
                <input type="hidden" id="id_db_cep_tblBairros" name="id_db_cep_tblBairros" value="<?php echo $tbCadastroIdDBCepTblBairros;?>" />
                <input type="hidden" id="id_db_cep_tblCidades" name="id_db_cep_tblCidades" value="<?php echo $tbCadastroIdDBCepTblCidades;?>" />
                <input type="hidden" id="id_db_cep_tblLogradouros" name="id_db_cep_tblLogradouros" value="<?php echo $tbCadastroIdDBCepTblLogradouros;?>" />
                <input type="hidden" id="id_db_cep_tblUF" name="id_db_cep_tblUF" value="<?php echo $tbCadastroIdDBCepTblUF;?>" />

                <input type="hidden" id="n_visitas" name="n_visitas" value="<?php echo $tbCadastroNVisitas; ?>" />
                <!--input name="ativacao" type="hidden" id="ativacao" value="<?php echo $tbCadastroAtivacao; ?>" /-->
                <input type="hidden" id="ativacao_destaque" name="ativacao_destaque" value="<?php echo $tbCadastroAtivacaoDestaque; ?>" />
                
				<input type="hidden" id="paginaRetorno" name="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                <input type="hidden" id="masterPageSelect" name="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
            </div>
            <div style="float:right;">
                <a href="<?php echo $paginaRetorno; ?>?idParentCadastro=<?php echo $idParentCadastro; ?>">
                    <img src="img/btoVoltar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoVoltar"); ?>"  />
                </a>
            </div>
        </div>
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


//Inclusão do template do layout.
include_once $page->LayoutSistema;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>