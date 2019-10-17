<?php
//Recurso para permitir o redirecionamento (evitar duplicidade de header).
ob_start();


//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeUsuarioVerificacao.php";
require_once "IncludeLayout.php";


//Resgate de variáveis.
$id = ContadorUniversal::ContadorUniversalUpdate(1);
$idTbCategorias = $_POST["id_tb_categorias"];

/*$idTbCadastroUsuario = $_POST["idTbCadastroUsuario"];
if($idTbCadastroUsuario == "")
{
	$idTbCadastroUsuario = 0;
}*/

$arrIdsCadastroTipo = $_POST["idsCadastroTipo"];
$arrIdsCadastroAtividades = $_POST["idsCadastroAtividades"];
$arrIdsCadastroFiltroGenerico01 = $_POST["idsCadastroFiltroGenerico01"];
$arrIdsCadastroFiltroGenerico02 = $_POST["idsCadastroFiltroGenerico02"];
$arrIdsCadastroFiltroGenerico03 = $_POST["idsCadastroFiltroGenerico03"];
$arrIdsCadastroFiltroGenerico04 = $_POST["idsCadastroFiltroGenerico04"];
$arrIdsCadastroFiltroGenerico05 = $_POST["idsCadastroFiltroGenerico05"];
$arrIdsCadastroFiltroGenerico06 = $_POST["idsCadastroFiltroGenerico06"];
$arrIdsCadastroFiltroGenerico07 = $_POST["idsCadastroFiltroGenerico07"];
$arrIdsCadastroFiltroGenerico08 = $_POST["idsCadastroFiltroGenerico08"];
$arrIdsCadastroFiltroGenerico09 = $_POST["idsCadastroFiltroGenerico09"];
$arrIdsCadastroFiltroGenerico10 = $_POST["idsCadastroFiltroGenerico10"];
$arrIdsCadastroFiltroGenerico11 = $_POST["idsCadastroFiltroGenerico11"];
$arrIdsCadastroFiltroGenerico12 = $_POST["idsCadastroFiltroGenerico12"];
$arrIdsCadastroFiltroGenerico13 = $_POST["idsCadastroFiltroGenerico13"];
$arrIdsCadastroFiltroGenerico14 = $_POST["idsCadastroFiltroGenerico14"];
$arrIdsCadastroFiltroGenerico15 = $_POST["idsCadastroFiltroGenerico15"];
$arrIdsCadastroFiltroGenerico16 = $_POST["idsCadastroFiltroGenerico16"];
$arrIdsCadastroFiltroGenerico17 = $_POST["idsCadastroFiltroGenerico17"];
$arrIdsCadastroFiltroGenerico18 = $_POST["idsCadastroFiltroGenerico18"];
$arrIdsCadastroFiltroGenerico19 = $_POST["idsCadastroFiltroGenerico19"];
$arrIdsCadastroFiltroGenerico20 = $_POST["idsCadastroFiltroGenerico20"];
$arrIdsCadastroFiltroGenerico21 = $_POST["idsCadastroFiltroGenerico21"];
$arrIdsCadastroFiltroGenerico22 = $_POST["idsCadastroFiltroGenerico22"];
$arrIdsCadastroFiltroGenerico23 = $_POST["idsCadastroFiltroGenerico23"];
$arrIdsCadastroFiltroGenerico24 = $_POST["idsCadastroFiltroGenerico24"];
$arrIdsCadastroFiltroGenerico25 = $_POST["idsCadastroFiltroGenerico25"];
$arrIdsCadastroFiltroGenerico26 = $_POST["idsCadastroFiltroGenerico26"];
$arrIdsCadastroFiltroGenerico27 = $_POST["idsCadastroFiltroGenerico27"];
$arrIdsCadastroFiltroGenerico28 = $_POST["idsCadastroFiltroGenerico28"];
$arrIdsCadastroFiltroGenerico29 = $_POST["idsCadastroFiltroGenerico29"];
$arrIdsCadastroFiltroGenerico30 = $_POST["idsCadastroFiltroGenerico30"];
//print_r($arrIdsCadastroTipo);

$dataCadastro = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");

$nome = Funcoes::ConteudoMascaraGravacao01($_POST["nome"]);

$nClassificacao = $_POST["n_classificacao"];
if($nClassificacao == "")
{
	$nClassificacao = 0;
}

$sexo = $_POST["sexo"];
$pfPj = $_POST["pf_pj"];
$altura = $_POST["altura"];
$peso = $_POST["peso"];
$razaoSocial = Funcoes::ConteudoMascaraGravacao01($_POST["razao_social"]);
$nomeFantasia = Funcoes::ConteudoMascaraGravacao01($_POST["nome_fantasia"]);

$dataNascimento = Funcoes::DataGravacaoSql($_POST["data_nascimento"], $GLOBALS['configSistemaFormatoData']);
if($dataNascimento == "")
{
	$dataNascimento = NULL;	
}

$data1 = Funcoes::DataGravacaoSql($_POST["data1"], $GLOBALS['configSistemaFormatoData']);
if($data1 == "")
{
	$data1 = NULL;	
}
$data2 = Funcoes::DataGravacaoSql($_POST["data2"], $GLOBALS['configSistemaFormatoData']);
if($data2 == "")
{
	$data2 = NULL;	
}
$data3 = Funcoes::DataGravacaoSql($_POST["data3"], $GLOBALS['configSistemaFormatoData']);
if($data3 == "")
{
	$data3 = NULL;	
}
$data4 = Funcoes::DataGravacaoSql($_POST["data4"], $GLOBALS['configSistemaFormatoData']);
if($data4 == "")
{
	$data4 = NULL;	
}
$data5 = Funcoes::DataGravacaoSql($_POST["data5"], $GLOBALS['configSistemaFormatoData']);
if($data5 == "")
{
	$data5 = NULL;	
}
$data6 = Funcoes::DataGravacaoSql($_POST["data6"], $GLOBALS['configSistemaFormatoData']);
if($data6 == "")
{
	$data6 = NULL;	
}
$data7 = Funcoes::DataGravacaoSql($_POST["data7"], $GLOBALS['configSistemaFormatoData']);
if($data7 == "")
{
	$data7 = NULL;	
}
$data8 = Funcoes::DataGravacaoSql($_POST["data8"], $GLOBALS['configSistemaFormatoData']);
if($data8 == "")
{
	$data8 = NULL;	
}
$data9 = Funcoes::DataGravacaoSql($_POST["data9"], $GLOBALS['configSistemaFormatoData']);
if($data9 == "")
{
	$data9 = NULL;	
}
$data10 = Funcoes::DataGravacaoSql($_POST["data10"], $GLOBALS['configSistemaFormatoData']);
if($data10 == "")
{
	$data10 = NULL;	
}

//$cpf_ = $_POST["cpf_"];
$cpf_ = Funcoes::SomenteNum($_POST["cpf_"]);
$rg_ = $_POST["rg_"];
//$cnpj_ = $_POST["cnpj_"];
$cnpj_ = Funcoes::SomenteNum($_POST["cnpj_"]);
$documento = $_POST["documento"];
$iMunicipal = $_POST["i_municipal"];
$iEstadual = $_POST["i_estadual"];

$enderecoPrincipal = $_POST["endereco_principal"];
$enderecoNumeroPrincipal = $_POST["endereco_numero_principal"];
$enderecoComplementoPrincipal = $_POST["endereco_complemento_principal"];
$bairroPrincipal = $_POST["bairro_principal"];
$cidadePrincipal = $_POST["cidade_principal"];
$estadoPrincipal = $_POST["estado_principal"];
$paisPrincipal = $_POST["pais_principal"];

//outras configurações de endereço (db)
$idDBCepTblBairros = $_POST["id_db_cep_tblBairros"];
$idDBCepTblCidades = $_POST["id_db_cep_tblCidades"];
$idDBCepTblLogradouros = $_POST["id_db_cep_tblLogradouros"];
$idDBCepTblUF = $_POST["id_db_cep_tblUF"];

//$cepPrincipal = $_POST["cep_principal"];
$cepPrincipal = Funcoes::SomenteNum($_POST["cep_principal"]);

$pontoReferencia = $_POST["ponto_referencia"];
$emailPrincipal = $_POST["email_principal"];
$telDDDPrincipal = $_POST["tel_ddd_principal"];
//$telPrincipal = $_POST["tel_principal"];
$telPrincipal = Funcoes::FormatarTelefoneGravar($_POST["tel_principal"]);
$celDDDPrincipal = $_POST["cel_ddd_principal"];
//$celPrincipal = $_POST["cel_principal"];
$celPrincipal = Funcoes::FormatarTelefoneGravar($_POST["cel_principal"]);
$faxDDDPrincipal = $_POST["fax_ddd_principal"];
$faxPrincipal = $_POST["fax_principal"];
$sitePrincipal = $_POST["site_principal"];

$nFuncionarios = $_POST["n_funcionarios"];
if($nFuncionarios == "")
{
	$nFuncionarios = 0;
}

$obsInterno = Funcoes::ConteudoMascaraGravacao01($_POST["obs_interno"]);

$idTbCadastro1 = $_POST["id_tb_cadastro1"];
if($idTbCadastro1 == "")
{
	$idTbCadastro1 = 0;
}
$idTbCadastro2 = $_POST["id_tb_cadastro2"];
if($idTbCadastro2 == "")
{
	$idTbCadastro2 = 0;
}
$idTbCadastro3 = $_POST["id_tb_cadastro3"];
if($idTbCadastro3 == "")
{
	$idTbCadastro3 = 0;
}

$idTbCadastroStatus = $_POST["id_tb_cadastro_status"];
if($idTbCadastroStatus == "")
{
	$idTbCadastroStatus = 0;
}
//$idTbCadastroStatus = 0;

$ativacao = $_POST["ativacao"];
$ativacaoDestaque = $_POST["ativacao_destaque"];
if($ativacaoDestaque == "")
{
	$ativacaoDestaque = 0;
}
$ativacaoMalaDireta = $_POST["ativacao_mala_direta"];
if($ativacaoMalaDireta == "")
{
	$ativacaoMalaDireta = 0;
}

$usuario = $_POST["usuario"];
//$senha = $_POST["senha"];
if($GLOBALS['configCadastroMetodoSenha'] == 0)
{
	//$senha = Crypto::EncryptValue(Funcoes::ConteudoMascaraLeitura($_POST["senha"]), 0);
	$senha = Crypto::EncryptValue(Funcoes::ConteudoMascaraGravacao01($_POST["senha"]), 0);
}

if($GLOBALS['configCadastroMetodoSenha'] == 2)
{
	//$senha = Crypto::EncryptValue(Funcoes::ConteudoMascaraLeitura($_POST["senha"]), 2);
	$senha = Crypto::EncryptValue(Funcoes::ConteudoMascaraGravacao01($_POST["senha"]), 2);
	//$senha = Crypto::EncryptValue($_POST["senha"], 2);
}

$mapaOnline = $_POST["mapa_online"];
$palavrasChave = $_POST["palavras_chave"];
$apresentacao = $_POST["apresentacao"];
$servicos = $_POST["servicos"];
$promocoes = $_POST["promocoes"];
$condicoesComerciais = $_POST["condicoes_comerciais"];
$formasPagamento = $_POST["formas_pagamento"];
$horarioAtendimento = $_POST["horario_atendimento"];
$situacaoAtual = $_POST["situacao_atual"];

$informacaoComplementar1 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar1"]);
$informacaoComplementar2 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar2"]);
$informacaoComplementar3 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar3"]);
$informacaoComplementar4 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar4"]);
$informacaoComplementar5 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar5"]);
$informacaoComplementar6 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar6"]);
$informacaoComplementar7 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar7"]);
$informacaoComplementar8 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar8"]);
$informacaoComplementar9 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar9"]);
$informacaoComplementar10 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar10"]);
$informacaoComplementar11 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar11"]);
$informacaoComplementar12 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar12"]);
$informacaoComplementar13 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar13"]);
$informacaoComplementar14 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar14"]);
$informacaoComplementar15 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar15"]);
$informacaoComplementar16 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar16"]);
$informacaoComplementar17 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar17"]);
$informacaoComplementar18 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar18"]);
$informacaoComplementar19 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar19"]);
$informacaoComplementar20 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar20"]);
$informacaoComplementar21 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar21"]);
$informacaoComplementar22 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar22"]);
$informacaoComplementar23 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar23"]);
$informacaoComplementar24 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar24"]);
$informacaoComplementar25 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar25"]);
$informacaoComplementar26 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar26"]);
$informacaoComplementar27 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar27"]);
$informacaoComplementar28 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar28"]);
$informacaoComplementar29 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar29"]);
$informacaoComplementar30 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar30"]);
$informacaoComplementar31 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar31"]);
$informacaoComplementar32 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar32"]);
$informacaoComplementar33 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar33"]);
$informacaoComplementar34 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar34"]);
$informacaoComplementar35 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar35"]);
$informacaoComplementar36 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar36"]);
$informacaoComplementar37 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar37"]);
$informacaoComplementar38 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar38"]);
$informacaoComplementar39 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar39"]);
$informacaoComplementar40 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar40"]);

$paginaRetorno = $_POST["paginaRetorno"];
$mensagemErro = "";
$mensagemSucesso = "";


//CPF - Verificação de registro existente.
//----------
if($GLOBALS['configCadastroCPFVerificacaoDuplicado'] == 1)
{
	if($cpf_ <> "")
	{
		$cpfExistenteRetorno = "";
		$cpfExistenteRetorno = DbFuncoes::GetCampoGenerico06("tb_cadastro", 
															"id", 
															"cpf_", 
															$cpf_, 
															"", 
															"", 
															2, 
															"", 
															"", 
															"", 
															"", 
															"", 
															"");
		if($cpfExistenteRetorno <> "")
		{
			$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroCPFExistente");
			
			
			//Fechamento da conexão.
			$dbSistemaConPDO = null;
			
			
			//Montagem do URL de retorno.
			$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
			"idParentCadastro=" . $idTbCategorias .
			"&mensagemSucesso=" . $mensagemSucesso .
			"&mensagemErro=" . $mensagemErro;
			
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
		}													
	}													
}
//----------


//CNPJ - Verificação de registro existente.
//----------
if($GLOBALS['configCadastroCNPJVerificacaoDuplicado'] == 1)
{
	if($cnpj_ <> "")
	{
		$cnpjExistenteRetorno = "";
		$cnpjExistenteRetorno = DbFuncoes::GetCampoGenerico06("tb_cadastro", 
															"id", 
															"cnpj_", 
															$cnpj_, 
															"", 
															"", 
															2, 
															"", 
															"", 
															"", 
															"", 
															"", 
															"");
		if($cnpjExistenteRetorno <> "")
		{
			$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroCNPJExistente");
			
			
			//Fechamento da conexão.
			$dbSistemaConPDO = null;
			
			
			//Montagem do URL de retorno.
			$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
			"idParentCadastro=" . $idTbCategorias .
			"&mensagemSucesso=" . $mensagemSucesso .
			"&mensagemErro=" . $mensagemErro;
			
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
		}													
	}													
}
//----------


//Inclusão de registro no BD.
//----------
$strSqlCadastroInsert = "";
$strSqlCadastroInsert .= "INSERT INTO tb_cadastro ";
$strSqlCadastroInsert .= "SET ";
$strSqlCadastroInsert .= "id = :id, ";
$strSqlCadastroInsert .= "id_tb_categorias = :id_tb_categorias, ";
$strSqlCadastroInsert .= "data_cadastro = :data_cadastro, ";
$strSqlCadastroInsert .= "pf_pj = :pf_pj, ";
$strSqlCadastroInsert .= "nome = :nome, ";
$strSqlCadastroInsert .= "sexo = :sexo, ";
$strSqlCadastroInsert .= "altura = :altura, ";
$strSqlCadastroInsert .= "peso = :peso, ";
$strSqlCadastroInsert .= "razao_social = :razao_social, ";
$strSqlCadastroInsert .= "nome_fantasia = :nome_fantasia, ";

//if($dataNascimento <> "")
//{
	$strSqlCadastroInsert .= "data_nascimento = :data_nascimento, ";
//}

$strSqlCadastroInsert .= "data1 = :data1, ";
$strSqlCadastroInsert .= "data2 = :data2, ";
$strSqlCadastroInsert .= "data3 = :data3, ";
$strSqlCadastroInsert .= "data4 = :data4, ";
$strSqlCadastroInsert .= "data5 = :data5, ";
$strSqlCadastroInsert .= "data6 = :data6, ";
$strSqlCadastroInsert .= "data7 = :data7, ";
$strSqlCadastroInsert .= "data8 = :data8, ";
$strSqlCadastroInsert .= "data9 = :data9, ";
$strSqlCadastroInsert .= "data10 = :data10, ";

$strSqlCadastroInsert .= "cpf_ = :cpf_, ";
$strSqlCadastroInsert .= "rg_ = :rg_, ";
$strSqlCadastroInsert .= "cnpj_ = :cnpj_, ";
$strSqlCadastroInsert .= "documento = :documento, ";
$strSqlCadastroInsert .= "i_municipal = :i_municipal, ";
$strSqlCadastroInsert .= "i_estadual = :i_estadual, ";

$strSqlCadastroInsert .= "endereco_principal = :endereco_principal, ";
$strSqlCadastroInsert .= "endereco_numero_principal = :endereco_numero_principal, ";
$strSqlCadastroInsert .= "endereco_complemento_principal = :endereco_complemento_principal, ";
$strSqlCadastroInsert .= "bairro_principal = :bairro_principal, ";
$strSqlCadastroInsert .= "cidade_principal = :cidade_principal, ";
$strSqlCadastroInsert .= "estado_principal = :estado_principal, ";
$strSqlCadastroInsert .= "pais_principal = :pais_principal, ";

$strSqlCadastroInsert .= "id_config_bairro = :id_config_bairro, ";
$strSqlCadastroInsert .= "id_config_cidade = :id_config_cidade, ";
$strSqlCadastroInsert .= "id_config_estado = :id_config_estado, ";
$strSqlCadastroInsert .= "id_config_regiao = :id_config_regiao, ";
$strSqlCadastroInsert .= "id_config_pais = :id_config_pais, ";

$strSqlCadastroInsert .= "id_db_cep_tblBairros = :id_db_cep_tblBairros, ";
$strSqlCadastroInsert .= "id_db_cep_tblCidades = :id_db_cep_tblCidades, ";
$strSqlCadastroInsert .= "id_db_cep_tblLogradouros = :id_db_cep_tblLogradouros, ";
$strSqlCadastroInsert .= "id_db_cep_tblUF = :id_db_cep_tblUF, ";

$strSqlCadastroInsert .= "cep_principal = :cep_principal, ";

$strSqlCadastroInsert .= "ponto_referencia = :ponto_referencia, ";
$strSqlCadastroInsert .= "email_principal = :email_principal, ";
$strSqlCadastroInsert .= "tel_ddd_principal = :tel_ddd_principal, ";
$strSqlCadastroInsert .= "tel_principal = :tel_principal, ";
$strSqlCadastroInsert .= "cel_ddd_principal = :cel_ddd_principal, ";
$strSqlCadastroInsert .= "cel_principal = :cel_principal, ";
$strSqlCadastroInsert .= "fax_ddd_principal = :fax_ddd_principal, ";
$strSqlCadastroInsert .= "fax_principal = :fax_principal, ";
$strSqlCadastroInsert .= "site_principal = :site_principal, ";
$strSqlCadastroInsert .= "n_funcionarios = :n_funcionarios, ";
$strSqlCadastroInsert .= "obs_interno = :obs_interno, ";

$strSqlCadastroInsert .= "id_tb_cadastro1 = :id_tb_cadastro1, ";
$strSqlCadastroInsert .= "id_tb_cadastro2 = :id_tb_cadastro2, ";
$strSqlCadastroInsert .= "id_tb_cadastro3 = :id_tb_cadastro3, ";
$strSqlCadastroInsert .= "id_tb_cadastro_status = :id_tb_cadastro_status, ";

//$strSqlCadastroInsert .= "id_tb_cadastro1 = :id_tb_cadastro1, ";

$strSqlCadastroInsert .= "ativacao = :ativacao, ";
$strSqlCadastroInsert .= "ativacao1 = :ativacao1, ";
$strSqlCadastroInsert .= "ativacao2 = :ativacao2, ";
$strSqlCadastroInsert .= "ativacao3 = :ativacao3, ";
$strSqlCadastroInsert .= "ativacao4 = :ativacao4, ";
$strSqlCadastroInsert .= "ativacao_destaque = :ativacao_destaque, ";
$strSqlCadastroInsert .= "ativacao_mala_direta = :ativacao_mala_direta, ";
$strSqlCadastroInsert .= "usuario = :usuario, ";

$strSqlCadastroInsert .= "senha = :senha, ";
//$strSqlCadastroInsert .= "senha = PASSWORD(:senha), ";

//$strSqlCadastroInsert .= "imagem = :imagem, ";
//$strSqlCadastroInsert .= "logo = :logo, ";
//$strSqlCadastroInsert .= "banner = :banner, ";
//$strSqlCadastroInsert .= "mapa = :mapa, ";
$strSqlCadastroInsert .= "mapa_online = :mapa_online, ";
$strSqlCadastroInsert .= "palavras_chave = :palavras_chave, ";
$strSqlCadastroInsert .= "apresentacao = :apresentacao, ";
$strSqlCadastroInsert .= "servicos = :servicos, ";
$strSqlCadastroInsert .= "promocoes = :promocoes, ";
$strSqlCadastroInsert .= "condicoes_comerciais = :condicoes_comerciais, ";
$strSqlCadastroInsert .= "formas_pagamento = :formas_pagamento, ";
$strSqlCadastroInsert .= "horario_atendimento = :horario_atendimento, ";
$strSqlCadastroInsert .= "situacao_atual = :situacao_atual, ";

$strSqlCadastroInsert .= "informacao_complementar1 = :informacao_complementar1, ";
$strSqlCadastroInsert .= "informacao_complementar2 = :informacao_complementar2, ";
$strSqlCadastroInsert .= "informacao_complementar3 = :informacao_complementar3, ";
$strSqlCadastroInsert .= "informacao_complementar4 = :informacao_complementar4, ";
$strSqlCadastroInsert .= "informacao_complementar5 = :informacao_complementar5, ";
$strSqlCadastroInsert .= "informacao_complementar6 = :informacao_complementar6, ";
$strSqlCadastroInsert .= "informacao_complementar7 = :informacao_complementar7, ";
$strSqlCadastroInsert .= "informacao_complementar8 = :informacao_complementar8, ";
$strSqlCadastroInsert .= "informacao_complementar9 = :informacao_complementar9, ";
$strSqlCadastroInsert .= "informacao_complementar10 = :informacao_complementar10, ";
$strSqlCadastroInsert .= "informacao_complementar11 = :informacao_complementar11, ";
$strSqlCadastroInsert .= "informacao_complementar12 = :informacao_complementar12, ";
$strSqlCadastroInsert .= "informacao_complementar13 = :informacao_complementar13, ";
$strSqlCadastroInsert .= "informacao_complementar14 = :informacao_complementar14, ";
$strSqlCadastroInsert .= "informacao_complementar15 = :informacao_complementar15, ";
$strSqlCadastroInsert .= "informacao_complementar16 = :informacao_complementar16, ";
$strSqlCadastroInsert .= "informacao_complementar17 = :informacao_complementar17, ";
$strSqlCadastroInsert .= "informacao_complementar18 = :informacao_complementar18, ";
$strSqlCadastroInsert .= "informacao_complementar19 = :informacao_complementar19, ";
$strSqlCadastroInsert .= "informacao_complementar20 = :informacao_complementar20, ";
$strSqlCadastroInsert .= "informacao_complementar21 = :informacao_complementar21, ";
$strSqlCadastroInsert .= "informacao_complementar22 = :informacao_complementar22, ";
$strSqlCadastroInsert .= "informacao_complementar23 = :informacao_complementar23, ";
$strSqlCadastroInsert .= "informacao_complementar24 = :informacao_complementar24, ";
$strSqlCadastroInsert .= "informacao_complementar25 = :informacao_complementar25, ";
$strSqlCadastroInsert .= "informacao_complementar26 = :informacao_complementar26, ";
$strSqlCadastroInsert .= "informacao_complementar27 = :informacao_complementar27, ";
$strSqlCadastroInsert .= "informacao_complementar28 = :informacao_complementar28, ";
$strSqlCadastroInsert .= "informacao_complementar29 = :informacao_complementar29, ";
$strSqlCadastroInsert .= "informacao_complementar30 = :informacao_complementar30, ";
$strSqlCadastroInsert .= "informacao_complementar31 = :informacao_complementar31, ";
$strSqlCadastroInsert .= "informacao_complementar32 = :informacao_complementar32, ";
$strSqlCadastroInsert .= "informacao_complementar33 = :informacao_complementar33, ";
$strSqlCadastroInsert .= "informacao_complementar34 = :informacao_complementar34, ";
$strSqlCadastroInsert .= "informacao_complementar35 = :informacao_complementar35, ";
$strSqlCadastroInsert .= "informacao_complementar36 = :informacao_complementar36, ";
$strSqlCadastroInsert .= "informacao_complementar37 = :informacao_complementar37, ";
$strSqlCadastroInsert .= "informacao_complementar38 = :informacao_complementar38, ";
$strSqlCadastroInsert .= "informacao_complementar39 = :informacao_complementar39, ";
$strSqlCadastroInsert .= "informacao_complementar40 = :informacao_complementar40, ";

$strSqlCadastroInsert .= "n_visitas = :n_visitas ";


$statementCadastroInsert = $dbSistemaConPDO->prepare($strSqlCadastroInsert);

if ($statementCadastroInsert !== false)
{
	$statementCadastroInsert->execute(array(
		"id" => $id,
		"id_tb_categorias" => $idTbCategorias,
		"data_cadastro" => $dataCadastro,
		"pf_pj" => $pfPj,		
		"nome" => $nome,
		"sexo" => $sexo,
		"altura" => $altura,
		"peso" => $peso,
		"razao_social" => $razaoSocial,
		"nome_fantasia" => $nomeFantasia,
		"data_nascimento" => $dataNascimento,
		"data1" => $data1,
		"data2" => $data2,
		"data3" => $data3,
		"data4" => $data4,
		"data5" => $data5,
		"data6" => $data6,
		"data7" => $data7,
		"data8" => $data8,
		"data9" => $data9,
		"data10" => $data10,
		"cpf_" => $cpf_,
		"rg_" => $rg_,
		"cnpj_" => $cnpj_,
		"documento" => $documento,
		"i_municipal" => $iMunicipal,
		"i_estadual" => $iEstadual,
		"endereco_principal" => $enderecoPrincipal,
		"endereco_numero_principal" => $enderecoNumeroPrincipal,
		"endereco_complemento_principal" => $enderecoComplementoPrincipal,
		"bairro_principal" => $bairroPrincipal,
		"cidade_principal" => $cidadePrincipal,
		"estado_principal" => $estadoPrincipal,
		"pais_principal" => $paisPrincipal,
		"id_config_bairro" => 0,
		"id_config_cidade" => 0,
		"id_config_estado" => 0,
		"id_config_regiao" => 0,
		"id_config_pais" => 0,
		"id_db_cep_tblBairros" => $idDBCepTblBairros,
		"id_db_cep_tblCidades" => $idDBCepTblCidades,
		"id_db_cep_tblLogradouros" => $idDBCepTblLogradouros,
		"id_db_cep_tblUF" => $idDBCepTblUF,
		"cep_principal" => $cepPrincipal,
		"ponto_referencia" => $pontoReferencia,
		"email_principal" => $emailPrincipal,
		"tel_ddd_principal" => $telDDDPrincipal,
		"tel_principal" => $telPrincipal,
		"cel_ddd_principal" => $celDDDPrincipal,
		"cel_principal" => $celPrincipal,
		"fax_ddd_principal" => $faxDDDPrincipal,
		"fax_principal" => $faxPrincipal,
		"site_principal" => $sitePrincipal,
		"n_funcionarios" => $nFuncionarios,
		"obs_interno" => $obsInterno,
		"id_tb_cadastro1" => $idTbCadastro1,
		"id_tb_cadastro2" => $idTbCadastro2,
		"id_tb_cadastro3" => $idTbCadastro3,
		"id_tb_cadastro_status" => $idTbCadastroStatus,
		"ativacao" => $ativacao,
		"ativacao1" => 0,
		"ativacao2" => 0,
		"ativacao3" => 0,
		"ativacao4" => 0,
		"ativacao_destaque" => $ativacaoDestaque,
		"ativacao_mala_direta" => $ativacaoMalaDireta,
		"usuario" => $usuario,
		"senha" => $senha,
		"mapa_online" => $mapaOnline,
		"palavras_chave" => $palavrasChave,
		"apresentacao" => $apresentacao,
		"servicos" => $servicos,
		"promocoes" => $promocoes,
		"condicoes_comerciais" => $condicoesComerciais,
		"formas_pagamento" => $formasPagamento,
		"horario_atendimento" => $horarioAtendimento,
		"situacao_atual" => $situacaoAtual,		
		"informacao_complementar1" => $informacaoComplementar1,
		"informacao_complementar2" => $informacaoComplementar2,
		"informacao_complementar3" => $informacaoComplementar3,
		"informacao_complementar4" => $informacaoComplementar4,
		"informacao_complementar5" => $informacaoComplementar5,
		"informacao_complementar6" => $informacaoComplementar6,
		"informacao_complementar7" => $informacaoComplementar7,
		"informacao_complementar8" => $informacaoComplementar8,
		"informacao_complementar9" => $informacaoComplementar9,
		"informacao_complementar10" => $informacaoComplementar10,
		"informacao_complementar11" => $informacaoComplementar11,
		"informacao_complementar12" => $informacaoComplementar12,
		"informacao_complementar13" => $informacaoComplementar13,
		"informacao_complementar14" => $informacaoComplementar14,
		"informacao_complementar15" => $informacaoComplementar15,
		"informacao_complementar16" => $informacaoComplementar16,
		"informacao_complementar17" => $informacaoComplementar17,
		"informacao_complementar18" => $informacaoComplementar18,
		"informacao_complementar19" => $informacaoComplementar19,
		"informacao_complementar20" => $informacaoComplementar20,
		"informacao_complementar21" => $informacaoComplementar21,
		"informacao_complementar22" => $informacaoComplementar22,
		"informacao_complementar23" => $informacaoComplementar23,
		"informacao_complementar24" => $informacaoComplementar24,
		"informacao_complementar25" => $informacaoComplementar25,
		"informacao_complementar26" => $informacaoComplementar26,
		"informacao_complementar27" => $informacaoComplementar27,
		"informacao_complementar28" => $informacaoComplementar28,
		"informacao_complementar29" => $informacaoComplementar29,
		"informacao_complementar30" => $informacaoComplementar30,
		"informacao_complementar31" => $informacaoComplementar31,
		"informacao_complementar32" => $informacaoComplementar32,
		"informacao_complementar33" => $informacaoComplementar33,
		"informacao_complementar34" => $informacaoComplementar34,
		"informacao_complementar35" => $informacaoComplementar35,
		"informacao_complementar36" => $informacaoComplementar36,
		"informacao_complementar37" => $informacaoComplementar37,
		"informacao_complementar38" => $informacaoComplementar38,
		"informacao_complementar39" => $informacaoComplementar39,
		"informacao_complementar40" => $informacaoComplementar40,
		"n_visitas" => 0
	));
	
	$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus2");
	//Obs: Colocar um flag de verificação de gravação.
}else{
	//echo "erro";
	$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus3");
}


//Limpeza de objetos.
unset($strSqlCadastroInsert);
unset($statementCadastroInsert);
//----------



//Gravação de complementos.
//----------
//Obs: Colocar um flag de verificação de gravação.

//Tipo.
if(!empty($arrIdsCadastroTipo))
{
	//echo "cheio";
	for($countArray = 0; $countArray < count($arrIdsCadastroTipo); $countArray++)
	{
		//echo "arrIdsCadastroTipo=" . $arrIdsCadastroTipo[$countArray] . "<br>";
		//echo "id=" . $id . "<br>";
		//echo "FiltrosGenericosGravar01=" . DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsCadastroTipo[$countArray], "1", "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento") . "<br>";
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsCadastroTipo[$countArray], "1", "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento");
	}
}


//Atividades.
//$arrIdsCadastroAtividades = $_POST["idsCadastroAtividades"];
if(!empty($arrIdsCadastroAtividades))
{
	for($countArray = 0; $countArray < count($arrIdsCadastroAtividades); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsCadastroAtividades[$countArray], "2", "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento");
	}
}


//Filtro genérico 01.
if(!empty($arrIdsCadastroFiltroGenerico01))
{
	for($countArray = 0; $countArray < count($arrIdsCadastroFiltroGenerico01); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsCadastroFiltroGenerico01[$countArray], "12", "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento");
	}
}


//Filtro genérico 02.
if(!empty($arrIdsCadastroFiltroGenerico02))
{
	for($countArray = 0; $countArray < count($arrIdsCadastroFiltroGenerico02); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsCadastroFiltroGenerico02[$countArray], "13", "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento");
	}
}


//Filtro genérico 03.
if(!empty($arrIdsCadastroFiltroGenerico03))
{
	for($countArray = 0; $countArray < count($arrIdsCadastroFiltroGenerico03); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsCadastroFiltroGenerico03[$countArray], "14", "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento");
	}
}


//Filtro genérico 04.
if(!empty($arrIdsCadastroFiltroGenerico04))
{
	for($countArray = 0; $countArray < count($arrIdsCadastroFiltroGenerico04); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsCadastroFiltroGenerico04[$countArray], "15", "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento");
	}
}


//Filtro genérico 05.
if(!empty($arrIdsCadastroFiltroGenerico05))
{
	for($countArray = 0; $countArray < count($arrIdsCadastroFiltroGenerico05); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsCadastroFiltroGenerico05[$countArray], "16", "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento");
	}
}


//Filtro genérico 06.
if(!empty($arrIdsCadastroFiltroGenerico06))
{
	for($countArray = 0; $countArray < count($arrIdsCadastroFiltroGenerico06); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsCadastroFiltroGenerico06[$countArray], "17", "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento");
	}
}


//Filtro genérico 07.
if(!empty($arrIdsCadastroFiltroGenerico07))
{
	for($countArray = 0; $countArray < count($arrIdsCadastroFiltroGenerico07); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsCadastroFiltroGenerico07[$countArray], "18", "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento");
	}
}


//Filtro genérico 08.
if(!empty($arrIdsCadastroFiltroGenerico08))
{
	for($countArray = 0; $countArray < count($arrIdsCadastroFiltroGenerico08); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsCadastroFiltroGenerico08[$countArray], "19", "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento");
	}
}


//Filtro genérico 09.
if(!empty($arrIdsCadastroFiltroGenerico09))
{
	for($countArray = 0; $countArray < count($arrIdsCadastroFiltroGenerico09); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsCadastroFiltroGenerico09[$countArray], "20", "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento");
	}
}


//Filtro genérico 10.
if(!empty($arrIdsCadastroFiltroGenerico10))
{
	for($countArray = 0; $countArray < count($arrIdsCadastroFiltroGenerico10); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsCadastroFiltroGenerico10[$countArray], "21", "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento");
	}
}


//Filtro genérico 11.
if(!empty($arrIdsCadastroFiltroGenerico11))
{
	for($countArray = 0; $countArray < count($arrIdsCadastroFiltroGenerico11); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsCadastroFiltroGenerico11[$countArray], "60", "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento");
	}
}


//Filtro genérico 12.
if(!empty($arrIdsCadastroFiltroGenerico12))
{
	for($countArray = 0; $countArray < count($arrIdsCadastroFiltroGenerico12); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsCadastroFiltroGenerico12[$countArray], "61", "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento");
	}
}


//Filtro genérico 13.
if(!empty($arrIdsCadastroFiltroGenerico13))
{
	for($countArray = 0; $countArray < count($arrIdsCadastroFiltroGenerico13); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsCadastroFiltroGenerico13[$countArray], "62", "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento");
	}
}


//Filtro genérico 14.
if(!empty($arrIdsCadastroFiltroGenerico14))
{
	for($countArray = 0; $countArray < count($arrIdsCadastroFiltroGenerico14); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsCadastroFiltroGenerico14[$countArray], "63", "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento");
	}
}


//Filtro genérico 15.
if(!empty($arrIdsCadastroFiltroGenerico15))
{
	for($countArray = 0; $countArray < count($arrIdsCadastroFiltroGenerico15); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsCadastroFiltroGenerico15[$countArray], "64", "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento");
	}
}


//Filtro genérico 16.
if(!empty($arrIdsCadastroFiltroGenerico16))
{
	for($countArray = 0; $countArray < count($arrIdsCadastroFiltroGenerico16); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsCadastroFiltroGenerico16[$countArray], "65", "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento");
	}
}


//Filtro genérico 17.
if(!empty($arrIdsCadastroFiltroGenerico17))
{
	for($countArray = 0; $countArray < count($arrIdsCadastroFiltroGenerico17); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsCadastroFiltroGenerico17[$countArray], "66", "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento");
	}
}


//Filtro genérico 18.
if(!empty($arrIdsCadastroFiltroGenerico18))
{
	for($countArray = 0; $countArray < count($arrIdsCadastroFiltroGenerico18); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsCadastroFiltroGenerico18[$countArray], "67", "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento");
	}
}


//Filtro genérico 19.
if(!empty($arrIdsCadastroFiltroGenerico19))
{
	for($countArray = 0; $countArray < count($arrIdsCadastroFiltroGenerico19); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsCadastroFiltroGenerico19[$countArray], "68", "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento");
	}
}


//Filtro genérico 20.
if(!empty($arrIdsCadastroFiltroGenerico20))
{
	for($countArray = 0; $countArray < count($arrIdsCadastroFiltroGenerico20); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsCadastroFiltroGenerico20[$countArray], "69", "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento");
	}
}


//Filtro genérico 21.
if(!empty($arrIdsCadastroFiltroGenerico21))
{
	for($countArray = 0; $countArray < count($arrIdsCadastroFiltroGenerico21); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsCadastroFiltroGenerico21[$countArray], "70", "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento");
	}
}


//Filtro genérico 22.
if(!empty($arrIdsCadastroFiltroGenerico22))
{
	for($countArray = 0; $countArray < count($arrIdsCadastroFiltroGenerico22); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsCadastroFiltroGenerico22[$countArray], "71", "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento");
	}
}


//Filtro genérico 23.
if(!empty($arrIdsCadastroFiltroGenerico23))
{
	for($countArray = 0; $countArray < count($arrIdsCadastroFiltroGenerico23); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsCadastroFiltroGenerico23[$countArray], "72", "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento");
	}
}


//Filtro genérico 24.
if(!empty($arrIdsCadastroFiltroGenerico24))
{
	for($countArray = 0; $countArray < count($arrIdsCadastroFiltroGenerico24); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsCadastroFiltroGenerico24[$countArray], "73", "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento");
	}
}


//Filtro genérico 25.
if(!empty($arrIdsCadastroFiltroGenerico25))
{
	for($countArray = 0; $countArray < count($arrIdsCadastroFiltroGenerico25); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsCadastroFiltroGenerico25[$countArray], "74", "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento");
	}
}


//Filtro genérico 26.
if(!empty($arrIdsCadastroFiltroGenerico26))
{
	for($countArray = 0; $countArray < count($arrIdsCadastroFiltroGenerico26); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsCadastroFiltroGenerico26[$countArray], "75", "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento");
	}
}


//Filtro genérico 27.
if(!empty($arrIdsCadastroFiltroGenerico27))
{
	for($countArray = 0; $countArray < count($arrIdsCadastroFiltroGenerico27); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsCadastroFiltroGenerico27[$countArray], "76", "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento");
	}
}


//Filtro genérico 28.
if(!empty($arrIdsCadastroFiltroGenerico28))
{
	for($countArray = 0; $countArray < count($arrIdsCadastroFiltroGenerico28); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsCadastroFiltroGenerico28[$countArray], "77", "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento");
	}
}


//Filtro genérico 29.
if(!empty($arrIdsCadastroFiltroGenerico29))
{
	for($countArray = 0; $countArray < count($arrIdsCadastroFiltroGenerico29); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsCadastroFiltroGenerico29[$countArray], "78", "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento");
	}
}


//Filtro genérico 30.
if(!empty($arrIdsCadastroFiltroGenerico30))
{
	for($countArray = 0; $countArray < count($arrIdsCadastroFiltroGenerico30); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsCadastroFiltroGenerico30[$countArray], "79", "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento");
	}
}
//----------


//Upload de arquivos.
//----------
//Definição do tamanho das imagens.
$arrImagemTamanhos = $GLOBALS['arrImagemCadastro'];
if($GLOBALS['ativacaoImagensPadrao'] == 1)
{
	$arrImagemTamanhos = $GLOBALS['arrImagemPadrao'];
}
//Definição do diretório de upload.
$arquivosDiretorioUpload = $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos'];
$countArquivosUpload = 0;


//Imagem principal.
if(!empty($_FILES["ArquivoUpload"]["name"])) //Verifica se arquivos foram postados.
{
	
	//Definição do nome do arquivo.
	$arrArquivoExtensao = explode(".", $_FILES["ArquivoUpload"]["name"]);
	$arquivoExtensao = strtolower(end($arrArquivoExtensao));
	$arquivoNome = $id . "." . $arquivoExtensao;
	
	
	//Gravação do arquivo original no servidor.
	if(strpos($GLOBALS['configImagensFormatos'], $arquivoExtensao) !== false) {
		$resultadoUpload = Arquivo::ArquivoUpload($id, 
												$_FILES["ArquivoUpload"], 
												$arquivosDiretorioUpload,
												"o" . $arquivoNome);
	}else{
		$resultadoUpload = Arquivo::ArquivoUpload($id, 
												$_FILES["ArquivoUpload"], 
												$arquivosDiretorioUpload,
												"" . $arquivoNome);
	}

	if($resultadoUpload == true){
		//Update do registro com o nome do arquivo.
		$resultadoUpdate = DbUpdate::DbRegistroGenericoUpdate01($arquivoNome, $id, "tb_cadastro", "imagem");
		if ($resultadoUpdate == true) 
		{
			//Verificação de formato do arquivo.
			if(strpos($GLOBALS['configImagensFormatos'], $arquivoExtensao) !== false)
			{
				//Redimensionamento de arquivos.
				Imagem::ImagemRedimensionar01($arrImagemTamanhos, 
											$arquivosDiretorioUpload, 
											$arquivoNome);
			}else{
				$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus19");
				//$mensagemSucesso = "";
			}
			
			$countArquivosUpload = $countArquivosUpload + 1;
		}else{
			$mensagemErro .= $resultadoUpdate;
			//$mensagemSucesso = "";
		}
	}else{
		$mensagemErro .= $resultadoUpload;
		//$mensagemSucesso = "";
	}
}


//Arquivo 1.
if($GLOBALS['habilitarCadastroArquivo1'] == 1)
{
	if(!empty($_FILES["ArquivoUpload1"]["name"])) //Verifica se arquivos foram postados.
	{
		//Definição do nome do arquivo.
		$arrArquivo1Extensao = explode(".", $_FILES["ArquivoUpload1"]["name"]);
		$arquivo1Extensao = strtolower(end($arrArquivo1Extensao));
		$arquivo1Nome = $id . "-1" . "." . $arquivo1Extensao;
		
		
		//Gravação do arquivo original no servidor.
		if(strpos($GLOBALS['configImagensFormatos'], $arquivo1Extensao) !== false) {
			$resultadoUpload1 = Arquivo::ArquivoUpload($id, 
													$_FILES["ArquivoUpload1"], 
													$arquivosDiretorioUpload,
													"o" . $arquivo1Nome);
		}else{
			$resultadoUpload1 = Arquivo::ArquivoUpload($id, 
													$_FILES["ArquivoUpload1"], 
													$arquivosDiretorioUpload,
													"" . $arquivo1Nome);
		}
	
		if($resultadoUpload1 == true){
			//Update do registro com o nome do arquivo.
			$resultadoUpdate1 = DbUpdate::DbRegistroGenericoUpdate01($arquivo1Nome, $id, "tb_cadastro", "arquivo1");
			if ($resultadoUpdate1 == true) 
			{
				//Verificação de formato do arquivo.
				if(strpos($GLOBALS['configImagensFormatos'], $arquivo1Extensao) !== false) {
					//Redimensionamento de arquivos.
					Imagem::ImagemRedimensionar01($arrImagemTamanhos, 
												$arquivosDiretorioUpload, 
												$arquivo1Nome);
				}else{
					$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus19");
					//$mensagemSucesso = "";
				}
				
				$countArquivosUpload = $countArquivosUpload + 1;
			}else{
				$mensagemErro .= $resultadoUpdate1;
				//$mensagemSucesso = "";
			}
		}else{
			$mensagemErro .= $resultadoUpload1;
		}
	}
}


//Arquivo 2.
if($GLOBALS['habilitarCadastroArquivo2'] == 1)
{
	if(!empty($_FILES["ArquivoUpload2"]["name"])) //Verifica se arquivos foram postados.
	{
		//Definição do nome do arquivo.
		$arrArquivo2Extensao = explode(".", $_FILES["ArquivoUpload2"]["name"]);
		$arquivo2Extensao = strtolower(end($arrArquivo2Extensao));
		$arquivo2Nome = $id . "-2" . "." . $arquivo2Extensao;
		
		
		//Gravação do arquivo original no servidor.
		if(strpos($GLOBALS['configImagensFormatos'], $arquivo2Extensao) !== false) {
			$resultadoUpload2 = Arquivo::ArquivoUpload($id, 
													$_FILES["ArquivoUpload2"], 
													$arquivosDiretorioUpload,
													"o" . $arquivo2Nome);
		}else{
			$resultadoUpload2 = Arquivo::ArquivoUpload($id, 
													$_FILES["ArquivoUpload2"], 
													$arquivosDiretorioUpload,
													"" . $arquivo2Nome);
		}
	
		if($resultadoUpload2 == true){
			//Update do registro com o nome do arquivo.
			$resultadoUpdate2 = DbUpdate::DbRegistroGenericoUpdate01($arquivo2Nome, $id, "tb_cadastro", "arquivo2");
			if ($resultadoUpdate2 == true) 
			{
				//Verificação de formato do arquivo.
				if(strpos($GLOBALS['configImagensFormatos'], $arquivo2Extensao) !== false) {
					//Redimensionamento de arquivos.
					Imagem::ImagemRedimensionar01($arrImagemTamanhos, 
												$arquivosDiretorioUpload, 
												$arquivo2Nome);
				}else{
					$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus19");
					//$mensagemSucesso = "";
				}
				
				$countArquivosUpload = $countArquivosUpload + 1;
			}else{
				$mensagemErro .= $resultadoUpdate2;
				//$mensagemSucesso = "";
			}
		}else{
			$mensagemErro .= $resultadoUpload2;
		}
	}
}


//Arquivo 3.
if($GLOBALS['habilitarCadastroArquivo3'] == 1)
{
	if(!empty($_FILES["ArquivoUpload3"]["name"])) //Verifica se arquivos foram postados.
	{
		//Definição do nome do arquivo.
		$arrArquivo3Extensao = explode(".", $_FILES["ArquivoUpload3"]["name"]);
		$arquivo3Extensao = strtolower(end($arrArquivo3Extensao));
		$arquivo3Nome = $id . "-3" . "." . $arquivo3Extensao;
		
		
		//Gravação do arquivo original no servidor.
		if(strpos($GLOBALS['configImagensFormatos'], $arquivo3Extensao) !== false) {
			$resultadoUpload3 = Arquivo::ArquivoUpload($id, 
													$_FILES["ArquivoUpload3"], 
													$arquivosDiretorioUpload,
													"o" . $arquivo3Nome);
		}else{
			$resultadoUpload3 = Arquivo::ArquivoUpload($id, 
													$_FILES["ArquivoUpload3"], 
													$arquivosDiretorioUpload,
													"" . $arquivo3Nome);
		}
	
		if($resultadoUpload3 == true){
			//Update do registro com o nome do arquivo.
			$resultadoUpdate3 = DbUpdate::DbRegistroGenericoUpdate01($arquivo3Nome, $id, "tb_cadastro", "arquivo3");
			if ($resultadoUpdate3 == true) 
			{
				//Verificação de formato do arquivo.
				if(strpos($GLOBALS['configImagensFormatos'], $arquivo3Extensao) !== false) {
					//Redimensionamento de arquivos.
					Imagem::ImagemRedimensionar01($arrImagemTamanhos, 
												$arquivosDiretorioUpload, 
												$arquivo3Nome);
				}else{
					$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus19");
					//$mensagemSucesso = "";
				}
				
				$countArquivosUpload = $countArquivosUpload + 1;
			}else{
				$mensagemErro .= $resultadoUpdate3;
				//$mensagemSucesso = "";
			}
		}else{
			$mensagemErro .= $resultadoUpload3;
		}
	}
}


//Arquivo 4.
if($GLOBALS['habilitarCadastroArquivo4'] == 1)
{
	if(!empty($_FILES["ArquivoUpload4"]["name"])) //Verifica se arquivos foram postados.
	{
		//Definição do nome do arquivo.
		$arrArquivo4Extensao = explode(".", $_FILES["ArquivoUpload4"]["name"]);
		$arquivo4Extensao = strtolower(end($arrArquivo4Extensao));
		$arquivo4Nome = $id . "-4" . "." . $arquivo4Extensao;
		
		
		//Gravação do arquivo original no servidor.
		if(strpos($GLOBALS['configImagensFormatos'], $arquivo4Extensao) !== false) {
			$resultadoUpload4 = Arquivo::ArquivoUpload($id, 
													$_FILES["ArquivoUpload4"], 
													$arquivosDiretorioUpload,
													"o" . $arquivo4Nome);
		}else{
			$resultadoUpload4 = Arquivo::ArquivoUpload($id, 
													$_FILES["ArquivoUpload4"], 
													$arquivosDiretorioUpload,
													"" . $arquivo4Nome);
		}
	
		if($resultadoUpload4 == true){
			//Update do registro com o nome do arquivo.
			$resultadoUpdate4 = DbUpdate::DbRegistroGenericoUpdate01($arquivo4Nome, $id, "tb_cadastro", "arquivo4");
			if ($resultadoUpdate4 == true) 
			{
				//Verificação de formato do arquivo.
				if(strpos($GLOBALS['configImagensFormatos'], $arquivo4Extensao) !== false) {
					//Redimensionamento de arquivos.
					Imagem::ImagemRedimensionar01($arrImagemTamanhos, 
												$arquivosDiretorioUpload, 
												$arquivo4Nome);
				}else{
					$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus19");
					//$mensagemSucesso = "";
				}
				
				$countArquivosUpload = $countArquivosUpload + 1;
			}else{
				$mensagemErro .= $resultadoUpdate4;
				//$mensagemSucesso = "";
			}
		}else{
			$mensagemErro .= $resultadoUpload4;
		}
	}
}


//Arquivo 5.
if($GLOBALS['habilitarCadastroArquivo5'] == 1)
{
	if(!empty($_FILES["ArquivoUpload5"]["name"])) //Verifica se arquivos foram postados.
	{
		//Definição do nome do arquivo.
		$arrArquivo5Extensao = explode(".", $_FILES["ArquivoUpload5"]["name"]);
		$arquivo5Extensao = strtolower(end($arrArquivo5Extensao));
		$arquivo5Nome = $id . "-5" . "." . $arquivo5Extensao;
		
		
		//Gravação do arquivo original no servidor.
		if(strpos($GLOBALS['configImagensFormatos'], $arquivo5Extensao) !== false) {
			$resultadoUpload5 = Arquivo::ArquivoUpload($id, 
													$_FILES["ArquivoUpload5"], 
													$arquivosDiretorioUpload,
													"o" . $arquivo5Nome);
		}else{
			$resultadoUpload5 = Arquivo::ArquivoUpload($id, 
													$_FILES["ArquivoUpload5"], 
													$arquivosDiretorioUpload,
													"" . $arquivo5Nome);
		}
	
		if($resultadoUpload5 == true){
			//Update do registro com o nome do arquivo.
			$resultadoUpdate5 = DbUpdate::DbRegistroGenericoUpdate01($arquivo5Nome, $id, "tb_cadastro", "arquivo5");
			if ($resultadoUpdate5 == true) 
			{
				//Verificação de formato do arquivo.
				if(strpos($GLOBALS['configImagensFormatos'], $arquivo5Extensao) !== false) {
					//Redimensionamento de arquivos.
					Imagem::ImagemRedimensionar01($arrImagemTamanhos, 
												$arquivosDiretorioUpload, 
												$arquivo5Nome);
				}else{
					$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus19");
					//$mensagemSucesso = "";
				}
				
				$countArquivosUpload = $countArquivosUpload + 1;
			}else{
				$mensagemErro .= $resultadoUpdate5;
				//$mensagemSucesso = "";
			}
		}else{
			$mensagemErro .= $resultadoUpload5;
		}
	}
}
//----------


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
//$dbSistemaConMysqli->close();
$dbSistemaConPDO = null;


//Montagem do URL de retorno.
$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
"idParentCadastro=" . $idTbCategorias .
"&mensagemSucesso=" . $mensagemSucesso .
"&mensagemErro=" . $mensagemErro;

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