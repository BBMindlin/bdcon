<?php
class ObjetoCadastroDetalhes
{
	//ref: http://php.net/manual/en/language.oop5.php
	//ref: https://www.elated.com/articles/object-oriented-php-delving-deeper-into-properties-and-methods/
	
	//Propriedades.
	//----------------------
	public $tbCadastroId = "";
	public $tbCadastroIdTbCategorias = "";
	public $tbCadastroDataCadastro = "";
	//public $tbCadastroNClassificacao = "";
	
	public $tbCadastroPfPj = "";
	public $tbCadastroPfPj_print = "";

	public $tbCadastroNome = "";
	
	public $tbCadastroSexo = "";
	public $tbCadastroSexo_print = "";
	
	public $tbCadastroAltura = "";
	public $tbCadastroPeso = "";
	public $tbCadastroRazaoSocial = "";
	public $tbCadastroNomeFantasia = "";
	
	public $tbCadastroNomePreferencial = "";
	public $tbCadastroDataNascimento = "";
	public $tbCadastroIdade = "";

	public $tbCadastroCPF = "";
	public $tbCadastroRG = "";
	public $tbCadastroCNPJ = "";
	public $tbCadastroDocumento = "";
	public $tbCadastroIMunicipal = "";
	public $tbCadastroIEstadual = "";
	public $tbCadastroEnderecoPrincipal = "";
	public $tbCadastroEnderecoNumeroPrincipal = "";
	public $tbCadastroEnderecoComplementoPrincipal = "";
	public $tbCadastroBairroPrincipal = "";
	public $tbCadastroCidadePrincipal = "";
	public $tbCadastroEstadoPrincipal = "";
	public $tbCadastroPaisPrincipal = "";
	//public $tbCadastro = $linhaCadastroDetalhes['id_config_bairro'];
	//public $tbCadastro = $linhaCadastroDetalhes['id_config_cidade'];
	//public $tbCadastro = $linhaCadastroDetalhes['id_config_estado'];
	//public $tbCadastro = $linhaCadastroDetalhes['id_config_regiao'];
	//public $tbCadastro = $linhaCadastroDetalhes['id_config_pais'];
	public $tbCadastroIdDBCepTblBairros = "";
	public $tbCadastroIdDBCepTblCidades = "";
	public $tbCadastroIdDBCepTblLogradouros = "";
	public $tbCadastroIdDBCepTblUF = "";
	public $tbCadastroCepPrincipal = "";
	
	public $tbCadastroPontoReferencia = "";
	public $tbCadastroEmailPrincipal = "";
	public $tbCadastroTelDDDPrincipal = "";
	public $tbCadastroTelPrincipal = "";
	public $tbCadastroCelDDDPrincipal = "";
	public $tbCadastroCelPrincipal = "";
	public $tbCadastroFaxDDDPrincipal = "";
	public $tbCadastroFaxPrincipal = "";
	public $tbCadastroSitePrincipal = "";
	public $tbCadastroNFuncionarios = "";
	public $tbCadastroOBSInterno = "";
	
	public $tbCadastroIdTbCadastroStatus = "";
	public $tbCadastroIdTbCadastro1 = "";
	public $tbCadastroIdTbCadastro2 = "";
	public $tbCadastroIdTbCadastro3 = "";
	
	public $tbCadastroAtivacao = "";
	public $tbCadastroAtivacao_print = "";

	public $tbCadastroAtivacaoDestaque = "";
	
	public $tbCadastroAtivacaoMalaDireta = "";
	public $tbCadastroAtivacaoMalaDireta_print = "";
	
	public $tbCadastroUsuario = "";
	
	public $tbCadastroSenha = "";
	
	public $tbCadastroImagem = "";
	public $tbCadastroLogo = "";
	public $tbCadastroBanner = "";
	public $tbCadastroMapa = "";
	public $tbCadastroMapaOnline = "";
	public $tbCadastroPalavrasChave = "";
	public $tbCadastroApresentacao = "";
	public $tbCadastroServicos = "";
	public $tbCadastroPromocoes = "";
	public $tbCadastroCondicoesComerciais = "";
	public $tbCadastroFormasPagamento = "";
	public $tbCadastroHorarioAtendimento = "";
	public $tbCadastroSituacaoAtual = "";
	public $tbCadastroIC1 = "";
	public $tbCadastroIC2 = "";
	public $tbCadastroIC3 = "";
	public $tbCadastroIC4 = "";
	public $tbCadastroIC5 = "";
	public $tbCadastroIC6 = "";
	public $tbCadastroIC7 = "";
	public $tbCadastroIC8 = "";
	public $tbCadastroIC9 = "";
	public $tbCadastroIC10 = "";
	public $tbCadastroIC11 = "";
	public $tbCadastroIC12 = "";
	public $tbCadastroIC13 = "";
	public $tbCadastroIC14 = "";
	public $tbCadastroIC15 = "";
	public $tbCadastroIC16 = "";
	public $tbCadastroIC17 = "";
	public $tbCadastroIC18 = "";
	public $tbCadastroIC19 = "";
	public $tbCadastroIC20 = "";
	public $tbCadastroIC21 = "";
	public $tbCadastroIC22 = "";
	public $tbCadastroIC23 = "";
	public $tbCadastroIC24 = "";
	public $tbCadastroIC25 = "";
	public $tbCadastroIC26 = "";
	public $tbCadastroIC27 = "";
	public $tbCadastroIC28 = "";
	public $tbCadastroIC29 = "";
	public $tbCadastroIC30 = "";
	public $tbCadastroIC31 = "";
	public $tbCadastroIC32 = "";
	public $tbCadastroIC33 = "";
	public $tbCadastroIC34 = "";
	public $tbCadastroIC35 = "";
	public $tbCadastroIC36 = "";
	public $tbCadastroIC37 = "";
	public $tbCadastroIC38 = "";
	public $tbCadastroIC39 = "";
	public $tbCadastroIC40 = "";
	public $tbCadastroNVisitas = "";
	public $tbCadastroOrigemCadastro = "";
	//----------------------
	
	
	//Construtor.
	//**************************************************************************************
	public function __construct()
	{
		
	}
	//**************************************************************************************
	
	
	//Getters.
	//**************************************************************************************
	public function __get($propriedade)
	{

	}
	//**************************************************************************************


	//Setters.
	//**************************************************************************************
	public function __set($propriedade, $valor)
	{
		
	}
	//**************************************************************************************
	
	
	//Overload.
	//**************************************************************************************
	public function __call($nomeMetodo, $argumentos)
	{

	}
	//**************************************************************************************


	//Função para definir valores dos detalhes.
	//**************************************************************************************
    public function CadastroDetalhesResultado($idTbCadastro, $terminal = 0)
    {
		//$terminal: 0 - sistema (backend) | 1 - site (frontend)
		
		if(!empty($idTbCadastro))
		{
			//Pesquisa de informações.
			$resultadoCadastroDetalhes = DbFuncoes::TabelaGenericaFill01_FetchAll("tb_cadastro", 
																					array("id;" . $idTbCadastro . ";i"));
				
			//Definição de valores.																	
			if(empty($resultadoCadastroDetalhes))
			{
				//echo "Nenhum registro encontrado";
			}else{
				foreach($resultadoCadastroDetalhes as $linhaCadastroDetalhes)
				{
					//Definição das variáveis de detalhes.
					$this->tbCadastroId = $linhaCadastroDetalhes['id'];
					$this->tbCadastroIdTbCategorias = $linhaCadastroDetalhes['id_tb_categorias'];
					if($terminal = 0)
					{
						$this->tbCadastroDataCadastro = Funcoes::DataLeitura01($linhaCadastroDetalhes['data_cadastro'], $GLOBALS['configSistemaFormatoData'], "1"); //fazer condição site/sistema
					}
					if($terminal = 1)
					{
						$this->tbCadastroDataCadastro = Funcoes::DataLeitura01($linhaCadastroDetalhes['data_cadastro'], $GLOBALS['configSiteFormatoData'], "1"); //fazer condição site/sistema
					}
					//$this->tbCadastroNClassificacao = $linhaCadastroDetalhes['n_classificacao'];
					
					$this->tbCadastroPfPj = $linhaCadastroDetalhes['pf_pj'];
					$this->tbCadastroPfPj_print = "";
					if($this->tbCadastroPfPj == "1"){
						$this->tbCadastroPfPj_print = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroPfPj1");
					}
					if($this->tbCadastroPfPj == "2"){
						$this->tbCadastroPfPj_print = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroPfPj2");
					}
			
					$this->tbCadastroNome = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['nome']);
					
					$this->tbCadastroSexo = $linhaCadastroDetalhes['sexo'];
					$this->tbCadastroSexo_print = "";
					if($this->tbCadastroSexo == "1"){
						$this->tbCadastroSexo_print = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroSexo1");
					}
					if($this->tbCadastroSexo == "2"){
						$this->tbCadastroSexo_print = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroSexo2");
					}
					
					$this->tbCadastroAltura = $linhaCadastroDetalhes['altura'];
					$this->tbCadastroPeso = $linhaCadastroDetalhes['peso'];
					$this->tbCadastroRazaoSocial = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['razao_social']);
					$this->tbCadastroNomeFantasia = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['nome_fantasia']);
					
					$this->tbCadastroNomePreferencial = Funcoes::GetCadastroTitulo($this->tbCadastroNome,
																			  $this->tbCadastroRazaoSocial,
																			  $this->tbCadastroNomeFantasia,
																			  1);
					
					
					//$this->tbCadastroDataNascimento = $linhaCadastroDetalhes['data_nascimento'];
					//if($GLOBALS['configSiteFormatoData'] == "1"){
						//$this->tbCadastroDataNascimento = date("d",strtotime($linhaCadastroDetalhes['data_nascimento'])) . "/" . date("m",strtotime($linhaCadastroDetalhes['data_nascimento'])) . "/" . date("y",strtotime($linhaCadastroDetalhes['data_nascimento']));
					//}
					//if($GLOBALS['configSiteFormatoData'] == "2"){
						//$this->tbCadastroDataNascimento = date("m",strtotime($linhaCadastroDetalhes['data_nascimento'])) . "/" . date("d",strtotime($linhaCadastroDetalhes['data_nascimento'])) . "/" . date("y",strtotime($linhaCadastroDetalhes['data_nascimento']));
					//}
					//$this->tbCadastroDataNascimento = Funcoes::DataLeitura01($linhaCadastroDetalhes['data_nascimento'], $GLOBALS['configSistemaFormatoData'], "1");
					if($linhaCadastroDetalhes['data_nascimento'] == NULL)
					{
						$this->tbCadastroDataNascimento = "";
						$this->tbCadastroIdade = "";
					}else{
						//$this->tbCadastroDataNascimento = Funcoes::DataLeitura01($linhaCadastroDetalhes['data_nascimento'], $GLOBALS['configSistemaFormatoData'], "1");
						//$this->tbCadastroIdade = Funcoes::DataIntervalo02("y", $this->tbCadastroDataNascimento, $dataAtual);
						//$this->tbCadastroIdade = Funcoes::DataIntervalo02("y", Funcoes::DataLeitura01($linhaCadastroDetalhes['data_nascimento'], $GLOBALS['configSistemaFormatoData'], "10"), $dataAtual);
						
						if($terminal = 0)
						{
							$this->tbCadastroDataNascimento = Funcoes::DataLeitura01($linhaCadastroDetalhes['data_nascimento'], $GLOBALS['configSistemaFormatoData'], "1");
							$this->tbCadastroIdade = Funcoes::DataIntervalo02("y", Funcoes::DataLeitura01($linhaCadastroDetalhes['data_nascimento'], $GLOBALS['configSistemaFormatoData'], "10"), $dataAtual);
						}
						if($terminal = 1)
						{
							$this->tbCadastroDataNascimento = Funcoes::DataLeitura01($linhaCadastroDetalhes['data_nascimento'], $GLOBALS['configSiteFormatoData'], "1");
							$this->tbCadastroIdade = Funcoes::DataIntervalo02("y", Funcoes::DataLeitura01($linhaCadastroDetalhes['data_nascimento'], $GLOBALS['configSiteFormatoData'], "10"), $dataAtual);
						}
					}
			
					$this->tbCadastroCPF = $linhaCadastroDetalhes['cpf_'];
					$this->tbCadastroRG = $linhaCadastroDetalhes['rg_'];
					$this->tbCadastroCNPJ = $linhaCadastroDetalhes['cnpj_'];
					$this->tbCadastroDocumento = $linhaCadastroDetalhes['documento'];
					$this->tbCadastroIMunicipal = $linhaCadastroDetalhes['i_municipal'];
					$this->tbCadastroIEstadual = $linhaCadastroDetalhes['i_estadual'];
					$this->tbCadastroEnderecoPrincipal = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['endereco_principal']);
					$this->tbCadastroEnderecoNumeroPrincipal = $linhaCadastroDetalhes['endereco_numero_principal'];
					$this->tbCadastroEnderecoComplementoPrincipal = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['endereco_complemento_principal']);
					$this->tbCadastroBairroPrincipal = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['bairro_principal']);
					$this->tbCadastroCidadePrincipal = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['cidade_principal']);
					$this->tbCadastroEstadoPrincipal = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['estado_principal']);
					$this->tbCadastroPaisPrincipal = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['pais_principal']);
					//$this->tbCadastro = $linhaCadastroDetalhes['id_config_bairro'];
					//$this->tbCadastro = $linhaCadastroDetalhes['id_config_cidade'];
					//$this->tbCadastro = $linhaCadastroDetalhes['id_config_estado'];
					//$this->tbCadastro = $linhaCadastroDetalhes['id_config_regiao'];
					//$this->tbCadastro = $linhaCadastroDetalhes['id_config_pais'];
					$this->tbCadastroIdDBCepTblBairros = $linhaCadastroDetalhes['id_db_cep_tblBairros'];
					$this->tbCadastroIdDBCepTblCidades = $linhaCadastroDetalhes['id_db_cep_tblCidades'];
					$this->tbCadastroIdDBCepTblLogradouros = $linhaCadastroDetalhes['id_db_cep_tblLogradouros'];
					$this->tbCadastroIdDBCepTblUF = $linhaCadastroDetalhes['id_db_cep_tblUF'];
					$this->tbCadastroCepPrincipal = $linhaCadastroDetalhes['cep_principal'];
					
					$this->tbCadastroPontoReferencia = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['ponto_referencia']);
					$this->tbCadastroEmailPrincipal = $linhaCadastroDetalhes['email_principal'];
					$this->tbCadastroTelDDDPrincipal = $linhaCadastroDetalhes['tel_ddd_principal'];
					$this->tbCadastroTelPrincipal = $linhaCadastroDetalhes['tel_principal'];
					$this->tbCadastroCelDDDPrincipal = $linhaCadastroDetalhes['cel_ddd_principal'];
					$this->tbCadastroCelPrincipal = $linhaCadastroDetalhes['cel_principal'];
					$this->tbCadastroFaxDDDPrincipal = $linhaCadastroDetalhes['fax_ddd_principal'];
					$this->tbCadastroFaxPrincipal = $linhaCadastroDetalhes['fax_principal'];
					$this->tbCadastroSitePrincipal = $linhaCadastroDetalhes['site_principal'];
					$this->tbCadastroNFuncionarios = $linhaCadastroDetalhes['n_funcionarios'];
					$this->tbCadastroOBSInterno = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['obs_interno']);
					
					$this->tbCadastroIdTbCadastroStatus = $linhaCadastroDetalhes['id_tb_cadastro_status'];
					$this->tbCadastroIdTbCadastro1 = $linhaCadastroDetalhes['id_tb_cadastro1'];
					$this->tbCadastroIdTbCadastro2 = $linhaCadastroDetalhes['id_tb_cadastro2'];
					$this->tbCadastroIdTbCadastro3 = $linhaCadastroDetalhes['id_tb_cadastro3'];
					
					$this->tbCadastroAtivacao = $linhaCadastroDetalhes['ativacao'];
					$this->tbCadastroAtivacao_print = "";
					if($this->tbCadastroAtivacao == "0"){
						//$this->tbCadastroAtivacao_print = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao4");
						if($terminal = 0)
						{
							$this->tbCadastroAtivacao_print = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao4");
						}
						if($terminal = 1)
						{
							$this->tbCadastroAtivacao_print = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao4");
						}
					}
					if($this->tbCadastroAtivacao == "1"){
						//$this->tbCadastroAtivacao_print = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao5");
						if($terminal = 0)
						{
							$this->tbCadastroAtivacao_print = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "siteItemAtivacao5");
						}
						if($terminal = 1)
						{
							$this->tbCadastroAtivacao_print = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao5");
						}
					}
			
					$this->tbCadastroAtivacaoDestaque = $linhaCadastroDetalhes['ativacao_destaque'];
					
					$this->tbCadastroAtivacaoMalaDireta = $linhaCadastroDetalhes['ativacao_mala_direta'];
					$this->tbCadastroAtivacao_print = "";
					if($this->tbCadastroAtivacaoMalaDireta == "0"){
						//$this->tbCadastroAtivacaoMalaDireta_print = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao4");
						if($terminal = 0)
						{
							$this->tbCadastroAtivacaoMalaDireta_print = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao4");
						}
						if($terminal = 1)
						{
							$this->tbCadastroAtivacaoMalaDireta_print = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao4");
						}
					}
					if($this->tbCadastroAtivacaoMalaDireta == "1"){
						//$this->tbCadastroAtivacaoMalaDireta_print = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao5");
						if($terminal = 0)
						{
							$this->tbCadastroAtivacaoMalaDireta_print = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao5");
						}
						if($terminal = 1)
						{
							$this->tbCadastroAtivacaoMalaDireta_print = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao5");
						}
					}
					
					$this->tbCadastroUsuario = $linhaCadastroDetalhes['usuario'];
					
					//$this->tbCadastroSenha = $linhaCadastroDetalhes['senha'];
					if($GLOBALS['configCadastroMetodoSenha'] == 2){
						if($GLOBALS['configCadastroSenha'] == 1){
							$this->tbCadastroSenha = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['senha'], 2), 2);
						}
					}
					
					$this->tbCadastroImagem = $linhaCadastroDetalhes['imagem'];
	
					$this->tbCadastroLogo = $linhaCadastroDetalhes['logo'];
					$this->tbCadastroBanner = $linhaCadastroDetalhes['banner'];
					$this->tbCadastroMapa = $linhaCadastroDetalhes['mapa'];
					$this->tbCadastroMapaOnline = $linhaCadastroDetalhes['mapa_online'];
					$this->tbCadastroPalavrasChave = $linhaCadastroDetalhes['palavras_chave'];
					$this->tbCadastroApresentacao = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['apresentacao']);
					$this->tbCadastroServicos = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['servicos']);
					$this->tbCadastroPromocoes = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['promocoes']);
					$this->tbCadastroCondicoesComerciais = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['condicoes_comerciais']);
					$this->tbCadastroFormasPagamento = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['formas_pagamento']);
					$this->tbCadastroHorarioAtendimento = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['horario_atendimento']);
					$this->tbCadastroSituacaoAtual = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['situacao_atual']);
					$this->tbCadastroIC1 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar1']);
					$this->tbCadastroIC2 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar2']);
					$this->tbCadastroIC3 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar3']);
					$this->tbCadastroIC4 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar4']);
					$this->tbCadastroIC5 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar5']);
					$this->tbCadastroIC6 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar6']);
					$this->tbCadastroIC7 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar7']);
					$this->tbCadastroIC8 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar8']);
					$this->tbCadastroIC9 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar9']);
					$this->tbCadastroIC10 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar10']);
					$this->tbCadastroIC11 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar11']);
					$this->tbCadastroIC12 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar12']);
					$this->tbCadastroIC13 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar13']);
					$this->tbCadastroIC14 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar14']);
					$this->tbCadastroIC15 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar15']);
					$this->tbCadastroIC16 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar16']);
					$this->tbCadastroIC17 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar17']);
					$this->tbCadastroIC18 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar18']);
					$this->tbCadastroIC19 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar19']);
					$this->tbCadastroIC20 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar20']);
					$this->tbCadastroIC21 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar21']);
					$this->tbCadastroIC22 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar22']);
					$this->tbCadastroIC23 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar23']);
					$this->tbCadastroIC24 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar24']);
					$this->tbCadastroIC25 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar25']);
					$this->tbCadastroIC26 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar26']);
					$this->tbCadastroIC27 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar27']);
					$this->tbCadastroIC28 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar28']);
					$this->tbCadastroIC29 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar29']);
					$this->tbCadastroIC30 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar30']);
					$this->tbCadastroIC31 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar31']);
					$this->tbCadastroIC32 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar32']);
					$this->tbCadastroIC33 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar33']);
					$this->tbCadastroIC34 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar34']);
					$this->tbCadastroIC35 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar35']);
					$this->tbCadastroIC36 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar36']);
					$this->tbCadastroIC37 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar37']);
					$this->tbCadastroIC38 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar38']);
					$this->tbCadastroIC39 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar39']);
					$this->tbCadastroIC40 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar40']);
					$this->tbCadastroNVisitas = $linhaCadastroDetalhes['n_visitas'];
					$this->tbCadastroOrigemCadastro = $linhaCadastroDetalhes['origem_cadastro'];
					//$tbCategoriasCategoria = Funcoes::ConteudoMascaraLeitura($linhaCategorias['categoria']);
					
					//Verificação de erro - debug.
					//echo "tbCadastroId=" . $tbCadastroId . "<br>";
					//echo "tbCadastroRazaoSocial=" . $tbCadastroRazaoSocial . "<br>";
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
		}
		
		
		//Limpeza.
		//----------------------
		unset($resultadoCadastroDetalhes);
		//----------------------
		
		
		//Verificação de erro - debug.
		//echo "resultadoCadastroDetalhes=";
		//var_dump($resultadoCadastroDetalhes);
		//echo "<br>";
    }
	//**************************************************************************************
	
	
	//Descontrutor.
	//**************************************************************************************
	public function __destruct()
	{
		
	}
	//**************************************************************************************
}
?>