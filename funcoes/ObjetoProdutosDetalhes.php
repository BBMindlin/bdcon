<?php
class ObjetoProdutosDetalhes
{
	//Instruções.
	//----------------------
	//Detalhes do produto vinculado.
	//$opdProdutoVinculado = null;
	//$opdProdutoVinculado = new ObjetoProdutosDetalhes(); //Criação de objeto com os detalhes do produto.
	
	//Definição dos valores do produto vinculado.
	//$opdProdutoVinculado->ProdutosDetalhesResultado($linhaHistorico['id_parent'], 1); //Detalhes da tabela principal.
	//$opdProdutoVinculado->ProdutosDetalhesComplemento($linhaHistorico['id_parent'], 1); //Detalhes (ids) da tabela complementar.
	//$opdProdutoVinculado->ProdutosDetalhesComplemento_print($linhaHistorico['id_parent'], 1);//Detalhes (ids/complamento) da tabela complementar.
	
	
	//Definição de valores.
	//$tbProdutosId = $opdProdutoVinculado->tbProdutosId;
	//$tbProdutosCodProduto = $opdProdutoVinculado->tbProdutosCodProduto;
	//$tbProdutosProduto = $opdProdutoVinculado->tbProdutosProduto;
	
	
	//Loop pelos resultados (complementos).
	//<?php
	//for($countArray = 0; $countArray < count($opdProdutoVinculado->arrProdutosFiltroGenerico01Selecao_print); $countArray++)
	//{ 
	//>
		//<div>
			//- <?php echo $opdProdutoVinculado->arrProdutosFiltroGenerico01Selecao_print[$countArray]["complemento"];>
		//</div>
	//<?php } >
	//----------------------
	
	
	//Propriedades.
	//----------------------
	public $tbProdutosId = "";
	public $tbProdutosIdTbCategorias = "";
	public $tbProdutosIdTbCadastroUsuario = "";
	public $tbProdutosDataProduto = "";
	public $tbProdutosCodProduto = "";
	public $tbProdutosNClassificacao = "";

	public $tbProdutosProduto = "";
	public $tbProdutosDescricao01 = "";
	public $tbProdutosDescricao02 = "";
	public $tbProdutosDescricao03 = "";
	public $tbProdutosDescricao04 = "";
	public $tbProdutosDescricao05 = "";

	public $tbProdutosIC1 = "";
	public $tbProdutosIC2 = "";
	public $tbProdutosIC3 = "";
	public $tbProdutosIC4 = "";
	public $tbProdutosIC5 = "";
	public $tbProdutosIC6 = "";
	public $tbProdutosIC7 = "";
	public $tbProdutosIC8 = "";
	public $tbProdutosIC9 = "";
	public $tbProdutosIC10 = "";
	public $tbProdutosIC11 = "";
	public $tbProdutosIC12 = "";
	public $tbProdutosIC13 = "";
	public $tbProdutosIC14 = "";
	public $tbProdutosIC15 = "";
	public $tbProdutosIC16 = "";
	public $tbProdutosIC17 = "";
	public $tbProdutosIC18 = "";
	public $tbProdutosIC19 = "";
	public $tbProdutosIC20 = "";
	public $tbProdutosIC21 = "";
	public $tbProdutosIC22 = "";
	public $tbProdutosIC23 = "";
	public $tbProdutosIC24 = "";
	public $tbProdutosIC25 = "";
	public $tbProdutosIC26 = "";
	public $tbProdutosIC27 = "";
	public $tbProdutosIC28 = "";
	public $tbProdutosIC29 = "";
	public $tbProdutosIC30 = "";
	public $tbProdutosIC31 = "";
	public $tbProdutosIC32 = "";
	public $tbProdutosIC33 = "";
	public $tbProdutosIC34 = "";
	public $tbProdutosIC35 = "";
	public $tbProdutosIC36 = "";
	public $tbProdutosIC37 = "";
	public $tbProdutosIC38 = "";
	public $tbProdutosIC39 = "";
	public $tbProdutosIC40 = "";
	public $tbProdutosIC41 = "";
	public $tbProdutosIC42 = "";
	public $tbProdutosIC43 = "";
	public $tbProdutosIC44 = "";
	public $tbProdutosIC45 = "";
	public $tbProdutosIC46 = "";
	public $tbProdutosIC47 = "";
	public $tbProdutosIC48 = "";
	public $tbProdutosIC49 = "";
	public $tbProdutosIC50 = "";

	public $tbProdutosPalavrasChave = "";
	public $tbProdutosValor = "";
	public $tbProdutosValor1 = "";
	public $tbProdutosValor2 = "";
	//public $tbProdutosPeso = Funcoes::MascaraValorLer($linhaProdutosDetalhes['peso'], $GLOBALS['configSistemaMoeda']);
	public $tbProdutosPeso = "";
	
	//public $tbProdutosCoeficiente = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['coeficiente']);
	//public $tbProdutosCoeficiente = Funcoes::MascaraValorLer($linhaProdutosDetalhes['coeficiente'], $GLOBALS['configSistemaMoeda']);
	public $tbProdutosCoeficiente = "";
	public $tbProdutosEstoque = "";
	public $tbProdutosAtivacao = "";
	public $tbProdutosAtivacaoPromocao = "";
	public $tbProdutosAtivacaoHome = "";
	public $tbProdutosAtivacaoHomeCategoria = "";
	public $tbProdutosAcessoRestrito = "";
	
	public $tbProdutosNQuestoesAprovacao = "";
	
	public $tbProdutosIdTbProdutosStatus = "";
	public $tbProdutosIdTbProdutosStatusPrint = "";
	
	public $tbProdutosImagem = "";
	public $tbProdutosAnotacoesInternas = "";
	public $tbProdutosNVisitas = "";


	//Complemento.
	public $arrProdutosTipoSelecao = array();
	public $arrProdutosTipoSelecao_print = array(); //Retornar o campo complemento.

	public $arrProdutosFiltroGenerico01Selecao = array();
	public $arrProdutosFiltroGenerico01Selecao_print = array();
	public $arrProdutosFiltroGenerico02Selecao = array();
	public $arrProdutosFiltroGenerico02Selecao_print = array();
	public $arrProdutosFiltroGenerico03Selecao = array();
	public $arrProdutosFiltroGenerico03Selecao_print = array();
	public $arrProdutosFiltroGenerico04Selecao = array();
	public $arrProdutosFiltroGenerico04Selecao_print = array();
	public $arrProdutosFiltroGenerico05Selecao = array();
	public $arrProdutosFiltroGenerico05Selecao_print = array();
	public $arrProdutosFiltroGenerico06Selecao = array();
	public $arrProdutosFiltroGenerico06Selecao_print = array();
	public $arrProdutosFiltroGenerico07Selecao = array();
	public $arrProdutosFiltroGenerico07Selecao_print = array();
	public $arrProdutosFiltroGenerico08Selecao = array();
	public $arrProdutosFiltroGenerico08Selecao_print = array();
	public $arrProdutosFiltroGenerico09Selecao = array();
	public $arrProdutosFiltroGenerico09Selecao_print = array();
	public $arrProdutosFiltroGenerico10Selecao = array();
	public $arrProdutosFiltroGenerico10Selecao_print = array();
	public $arrProdutosFiltroGenerico11Selecao = array();
	public $arrProdutosFiltroGenerico11Selecao_print = array();
	public $arrProdutosFiltroGenerico12Selecao = array();
	public $arrProdutosFiltroGenerico12Selecao_print = array();
	public $arrProdutosFiltroGenerico13Selecao = array();
	public $arrProdutosFiltroGenerico13Selecao_print = array();
	public $arrProdutosFiltroGenerico14Selecao = array();
	public $arrProdutosFiltroGenerico14Selecao_print = array();
	public $arrProdutosFiltroGenerico15Selecao = array();
	public $arrProdutosFiltroGenerico15Selecao_print = array();
	public $arrProdutosFiltroGenerico16Selecao = array();
	public $arrProdutosFiltroGenerico16Selecao_print = array();
	public $arrProdutosFiltroGenerico17Selecao = array();
	public $arrProdutosFiltroGenerico17Selecao_print = array();
	public $arrProdutosFiltroGenerico18Selecao = array();
	public $arrProdutosFiltroGenerico18Selecao_print = array();
	public $arrProdutosFiltroGenerico19Selecao = array();
	public $arrProdutosFiltroGenerico19Selecao_print = array();
	public $arrProdutosFiltroGenerico20Selecao = array();
	public $arrProdutosFiltroGenerico20Selecao_print = array();
	public $arrProdutosFiltroGenerico21Selecao = array();
	public $arrProdutosFiltroGenerico21Selecao_print = array();
	public $arrProdutosFiltroGenerico22Selecao = array();
	public $arrProdutosFiltroGenerico22Selecao_print = array();
	public $arrProdutosFiltroGenerico23Selecao = array();
	public $arrProdutosFiltroGenerico23Selecao_print = array();
	public $arrProdutosFiltroGenerico24Selecao = array();
	public $arrProdutosFiltroGenerico24Selecao_print = array();
	public $arrProdutosFiltroGenerico25Selecao = array();
	public $arrProdutosFiltroGenerico25Selecao_print = array();
	public $arrProdutosFiltroGenerico26Selecao = array();
	public $arrProdutosFiltroGenerico26Selecao_print = array();
	public $arrProdutosFiltroGenerico27Selecao = array();
	public $arrProdutosFiltroGenerico27Selecao_print = array();
	public $arrProdutosFiltroGenerico28Selecao = array();
	public $arrProdutosFiltroGenerico28Selecao_print = array();
	public $arrProdutosFiltroGenerico29Selecao = array();
	public $arrProdutosFiltroGenerico29Selecao_print = array();
	public $arrProdutosFiltroGenerico30Selecao = array();
	public $arrProdutosFiltroGenerico30Selecao_print = array();
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
    public function ProdutosDetalhesResultado($idTbProdutos, $terminal = 0)
    {
		//$terminal: 0 - sistema (backend) | 1 - site (frontend)
		
		if(!empty($idTbProdutos))
		{
			//Pesquisa de informações.
			$resultadoProdutosDetalhes = DbFuncoes::TabelaGenericaFill01_FetchAll("tb_produtos", 
																					array("id;" . $idTbProdutos . ";i"));
				
			//Definição de valores.	
			if(empty($resultadoProdutosDetalhes))
			{
				//echo "Nenhum registro encontrado";
			}else{
				foreach($resultadoProdutosDetalhes as $linhaProdutosDetalhes)
				{
					//Definição das variáveis de detalhes.
					$this->tbProdutosId = $linhaProdutosDetalhes['id'];
					$this->tbProdutosIdTbCategorias = $linhaProdutosDetalhes['id_tb_categorias'];
					$this->tbProdutosIdTbCadastroUsuario = $linhaProdutosDetalhes['id_tb_cadastro_usuario'];
					//$this->tbProdutosDataProduto = Funcoes::DataLeitura01($linhaProdutosDetalhes['data_produto'], $GLOBALS['configSistemaFormatoData'], "1");
					if($linhaProdutosDetalhes['data_produto'] == NULL)
					{
						$this->tbProdutosDataProduto = "";
					}else{
						$this->tbProdutosDataProduto = Funcoes::DataLeitura01($linhaProdutosDetalhes['data_produto'], $GLOBALS['configSiteFormatoData'], "1");
						
						if($terminal = 0)
						{
							$this->tbProdutosDataProduto = Funcoes::DataLeitura01($linhaProdutosDetalhes['data_produto'], $GLOBALS['configSistemaFormatoData'], "1");
						}
						if($terminal = 1)
						{
							$this->tbProdutosDataProduto = Funcoes::DataLeitura01($linhaProdutosDetalhes['data_produto'], $GLOBALS['configSiteFormatoData'], "1");
						}
					}
					$this->tbProdutosCodProduto = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['cod_produto']);
					$this->tbProdutosNClassificacao = $linhaProdutosDetalhes['n_classificacao'];
			
					$this->tbProdutosProduto = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['produto']);
					$this->tbProdutosDescricao01 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['descricao01']);
					$this->tbProdutosDescricao02 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['descricao02']);
					$this->tbProdutosDescricao03 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['descricao03']);
					$this->tbProdutosDescricao04 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['descricao04']);
					$this->tbProdutosDescricao05 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['descricao05']);
			
					$this->tbProdutosIC1 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar1']);
					$this->tbProdutosIC2 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar2']);
					$this->tbProdutosIC3 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar3']);
					$this->tbProdutosIC4 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar4']);
					$this->tbProdutosIC5 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar5']);
					$this->tbProdutosIC6 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar6']);
					$this->tbProdutosIC7 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar7']);
					$this->tbProdutosIC8 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar8']);
					$this->tbProdutosIC9 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar9']);
					$this->tbProdutosIC10 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar10']);
					$this->tbProdutosIC11 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar11']);
					$this->tbProdutosIC12 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar12']);
					$this->tbProdutosIC13 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar13']);
					$this->tbProdutosIC14 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar14']);
					$this->tbProdutosIC15 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar15']);
					$this->tbProdutosIC16 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar16']);
					$this->tbProdutosIC17 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar17']);
					$this->tbProdutosIC18 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar18']);
					$this->tbProdutosIC19 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar19']);
					$this->tbProdutosIC20 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar20']);
					$this->tbProdutosIC21 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar21']);
					$this->tbProdutosIC22 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar22']);
					$this->tbProdutosIC23 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar23']);
					$this->tbProdutosIC24 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar24']);
					$this->tbProdutosIC25 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar25']);
					$this->tbProdutosIC26 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar26']);
					$this->tbProdutosIC27 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar27']);
					$this->tbProdutosIC28 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar28']);
					$this->tbProdutosIC29 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar29']);
					$this->tbProdutosIC30 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar30']);
					$this->tbProdutosIC31 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar31']);
					$this->tbProdutosIC32 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar32']);
					$this->tbProdutosIC33 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar33']);
					$this->tbProdutosIC34 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar34']);
					$this->tbProdutosIC35 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar35']);
					$this->tbProdutosIC36 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar36']);
					$this->tbProdutosIC37 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar37']);
					$this->tbProdutosIC38 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar38']);
					$this->tbProdutosIC39 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar39']);
					$this->tbProdutosIC40 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar40']);
					$this->tbProdutosIC41 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar41']);
					$this->tbProdutosIC42 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar42']);
					$this->tbProdutosIC43 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar43']);
					$this->tbProdutosIC44 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar44']);
					$this->tbProdutosIC45 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar45']);
					$this->tbProdutosIC46 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar46']);
					$this->tbProdutosIC47 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar47']);
					$this->tbProdutosIC48 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar48']);
					$this->tbProdutosIC49 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar49']);
					$this->tbProdutosIC50 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar50']);
			
					$this->tbProdutosPalavrasChave = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['palavras_chave']);
					$this->tbProdutosValor = Funcoes::MascaraValorLer($linhaProdutosDetalhes['valor'], $GLOBALS['configSistemaMoeda']);
					$this->tbProdutosValor1 = Funcoes::MascaraValorLer($linhaProdutosDetalhes['valor1'], $GLOBALS['configSistemaMoeda']);
					$this->tbProdutosValor2 = Funcoes::MascaraValorLer($linhaProdutosDetalhes['valor2'], $GLOBALS['configSistemaMoeda']);
					//$this->tbProdutosPeso = Funcoes::MascaraValorLer($linhaProdutosDetalhes['peso'], $GLOBALS['configSistemaMoeda']);
					$this->tbProdutosPeso = $linhaProdutosDetalhes['peso'];
					
					//$this->tbProdutosCoeficiente = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['coeficiente']);
					//$this->tbProdutosCoeficiente = Funcoes::MascaraValorLer($linhaProdutosDetalhes['coeficiente'], $GLOBALS['configSistemaMoeda']);
					$this->tbProdutosCoeficiente = $linhaProdutosDetalhes['coeficiente'];
					$this->tbProdutosEstoque = $linhaProdutosDetalhes['estoque'];
					
					$this->tbProdutosAtivacao = $linhaProdutosDetalhes['ativacao'];
					$this->tbProdutosAtivacaoPromocao = $linhaProdutosDetalhes['ativacao_promocao'];
					$this->tbProdutosAtivacaoHome = $linhaProdutosDetalhes['ativacao_home'];
					$this->tbProdutosAtivacaoHomeCategoria = $linhaProdutosDetalhes['ativacao_home_categoria'];
					$this->tbProdutosAcessoRestrito = $linhaProdutosDetalhes['acesso_restrito'];
					
					$this->tbProdutosNQuestoesAprovacao = $linhaProdutosDetalhes['n_questoes_aprovacao'];
					
					$this->tbProdutosIdTbProdutosStatus = $linhaProdutosDetalhes['id_tb_produtos_status'];
					if($this->tbProdutosIdTbProdutosStatus <> 0)
					{
						$this->tbProdutosIdTbProdutosStatusPrint = DbFuncoes::GetCampoGenerico01($this->tbProdutosIdTbProdutosStatus, "tb_produtos_complemento", "complemento");
					}
					
					$this->tbProdutosImagem = $linhaProdutosDetalhes['imagem'];
					$this->tbProdutosAnotacoesInternas = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['anotacoes_internas']);
					$this->tbProdutosNVisitas = $linhaProdutosDetalhes['n_visitas'];
				}
			}
		}
		
		
		//Limpeza.
		//----------------------
		unset($resultadoProdutosDetalhes);
		//----------------------
		
		
		//Verificação de erro - debug.
		//echo "resultadoCadastroDetalhes=";
		//var_dump($resultadoCadastroDetalhes);
		//echo "<br>";
    }
	//**************************************************************************************
	
	
	//Função para definir valores dos complementos.
	//**************************************************************************************
    public function ProdutosDetalhesComplemento($idTbProdutos, $terminal = 0)
    {
		//$terminal: 0 - sistema (backend) | 1 - site (frontend)
		
		//Definição de valores.
		if($GLOBALS['habilitarProdutosTipo'] == 1)
		{	
			$this->arrProdutosTipoSelecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($idTbProdutos, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", "2", "", ",", "", "1"));
		}
		
		if($GLOBALS['habilitarProdutosFiltroGenerico01'] == 1)
		{	
			$this->arrProdutosFiltroGenerico01Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($idTbProdutos, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", "12", "", ",", "", "1"));
		}
		if($GLOBALS['habilitarProdutosFiltroGenerico02'] == 1)
		{	
			$this->arrProdutosFiltroGenerico02Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($idTbProdutos, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", "13", "", ",", "", "1"));
		}
		if($GLOBALS['habilitarProdutosFiltroGenerico03'] == 1)
		{	
			$this->arrProdutosFiltroGenerico03Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($idTbProdutos, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", "14", "", ",", "", "1"));
		}
		if($GLOBALS['habilitarProdutosFiltroGenerico04'] == 1)
		{	
			$this->arrProdutosFiltroGenerico04Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($idTbProdutos, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", "15", "", ",", "", "1"));
		}
		if($GLOBALS['habilitarProdutosFiltroGenerico05'] == 1)
		{	
			$this->arrProdutosFiltroGenerico05Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($idTbProdutos, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", "16", "", ",", "", "1"));
		}
		if($GLOBALS['habilitarProdutosFiltroGenerico06'] == 1)
		{	
			$this->arrProdutosFiltroGenerico06Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($idTbProdutos, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", "17", "", ",", "", "1"));
		}
		if($GLOBALS['habilitarProdutosFiltroGenerico07'] == 1)
		{	
			$this->arrProdutosFiltroGenerico07Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($idTbProdutos, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", "18", "", ",", "", "1"));
		}
		if($GLOBALS['habilitarProdutosFiltroGenerico08'] == 1)
		{	
			$this->arrProdutosFiltroGenerico08Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($idTbProdutos, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", "19", "", ",", "", "1"));
		}
		if($GLOBALS['habilitarProdutosFiltroGenerico09'] == 1)
		{	
			$this->arrProdutosFiltroGenerico09Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($idTbProdutos, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", "20", "", ",", "", "1"));
		}
		if($GLOBALS['habilitarProdutosFiltroGenerico10'] == 1)
		{	
			$this->arrProdutosFiltroGenerico10Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($idTbProdutos, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", "21", "", ",", "", "1"));
		}
		if($GLOBALS['habilitarProdutosFiltroGenerico11'] == 1)
		{	
			$this->arrProdutosFiltroGenerico11Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($idTbProdutos, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", "22", "", ",", "", "1"));
		}
		if($GLOBALS['habilitarProdutosFiltroGenerico12'] == 1)
		{	
			$this->arrProdutosFiltroGenerico12Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($idTbProdutos, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", "23", "", ",", "", "1"));
		}
		if($GLOBALS['habilitarProdutosFiltroGenerico13'] == 1)
		{	
			$this->arrProdutosFiltroGenerico13Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($idTbProdutos, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", "24", "", ",", "", "1"));
		}
		if($GLOBALS['habilitarProdutosFiltroGenerico14'] == 1)
		{	
			$this->arrProdutosFiltroGenerico14Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($idTbProdutos, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", "25", "", ",", "", "1"));
		}
		if($GLOBALS['habilitarProdutosFiltroGenerico15'] == 1)
		{	
			$this->arrProdutosFiltroGenerico15Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($idTbProdutos, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", "26", "", ",", "", "1"));
		}
		if($GLOBALS['habilitarProdutosFiltroGenerico16'] == 1)
		{	
			$this->arrProdutosFiltroGenerico16Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($idTbProdutos, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", "27", "", ",", "", "1"));
		}
		if($GLOBALS['habilitarProdutosFiltroGenerico17'] == 1)
		{	
			$this->arrProdutosFiltroGenerico17Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($idTbProdutos, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", "28", "", ",", "", "1"));
		}
		if($GLOBALS['habilitarProdutosFiltroGenerico18'] == 1)
		{	
			$this->arrProdutosFiltroGenerico18Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($idTbProdutos, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", "29", "", ",", "", "1"));
		}
		if($GLOBALS['habilitarProdutosFiltroGenerico19'] == 1)
		{	
			$this->arrProdutosFiltroGenerico19Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($idTbProdutos, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", "30", "", ",", "", "1"));
		}
		if($GLOBALS['habilitarProdutosFiltroGenerico20'] == 1)
		{	
			$this->arrProdutosFiltroGenerico20Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($idTbProdutos, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", "31", "", ",", "", "1"));
		}
		if($GLOBALS['habilitarProdutosFiltroGenerico21'] == 1)
		{	
			$this->arrProdutosFiltroGenerico21Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($idTbProdutos, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", "32", "", ",", "", "1"));
		}
		if($GLOBALS['habilitarProdutosFiltroGenerico22'] == 1)
		{	
			$this->arrProdutosFiltroGenerico22Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($idTbProdutos, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", "33", "", ",", "", "1"));
		}
		if($GLOBALS['habilitarProdutosFiltroGenerico23'] == 1)
		{	
			$this->arrProdutosFiltroGenerico23Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($idTbProdutos, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", "34", "", ",", "", "1"));
		}
		if($GLOBALS['habilitarProdutosFiltroGenerico24'] == 1)
		{	
			$this->arrProdutosFiltroGenerico24Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($idTbProdutos, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", "35", "", ",", "", "1"));
		}
		if($GLOBALS['habilitarProdutosFiltroGenerico25'] == 1)
		{	
			$this->arrProdutosFiltroGenerico25Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($idTbProdutos, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", "36", "", ",", "", "1"));
		}
		if($GLOBALS['habilitarProdutosFiltroGenerico26'] == 1)
		{	
			$this->arrProdutosFiltroGenerico26Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($idTbProdutos, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", "37", "", ",", "", "1"));
		}
		if($GLOBALS['habilitarProdutosFiltroGenerico27'] == 1)
		{	
			$this->arrProdutosFiltroGenerico27Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($idTbProdutos, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", "38", "", ",", "", "1"));
		}
		if($GLOBALS['habilitarProdutosFiltroGenerico28'] == 1)
		{	
			$this->arrProdutosFiltroGenerico28Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($idTbProdutos, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", "39", "", ",", "", "1"));
		}
		if($GLOBALS['habilitarProdutosFiltroGenerico29'] == 1)
		{	
			$this->arrProdutosFiltroGenerico29Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($idTbProdutos, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", "40", "", ",", "", "1"));
		}
		if($GLOBALS['habilitarProdutosFiltroGenerico30'] == 1)
		{	
			$this->arrProdutosFiltroGenerico30Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($idTbProdutos, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", "41", "", ",", "", "1"));
		}
    }
	//**************************************************************************************
	
	
	//Função para retornar registros dos complementos.
	//**************************************************************************************
    public function ProdutosDetalhesComplemento_print($idTbProdutos, $terminal = 0)
    {
		//$terminal: 0 - sistema (backend) | 1 - site (frontend)
		
											
		//Definição de valores.
		//Carregamento dos registros da tabela auxiliar.
		$resultadoProdutosComplemento = DbFuncoes::TabelaGenericaFill01_FetchAll("tb_produtos_complemento", 
																				NULL, 
																				"complemento", 
																				"");
		
		//Loop pelos resultados.
		foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
		{
			if($GLOBALS['habilitarProdutosTipo'] == 1)
			{	
				//Tipo.
				if($linhaProdutosComplemento["tipo_complemento"] == "2")
				{
					if(in_array($linhaProdutosComplemento["id"], $this->arrProdutosTipoSelecao))
					{
						//$this->arrProdutosTipoSelecao_print[$linhaProdutosComplemento["id"]] = Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]); //Debug.
						//$this->arrProdutosTipoSelecao_print[2]["id"] = $linhaProdutosComplemento["id"]; //Debug.
						//$this->arrProdutosTipoSelecao_print[2]["complemento"] = Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]); //Debug.
						
						//$this->arrProdutosTipoSelecao_print = $this->arrProdutosTipoSelecao_print + array("id" => $linhaProdutosComplemento["id"]);
						//$this->arrProdutosTipoSelecao_print = $this->arrProdutosTipoSelecao_print + array("complemento" => Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]));
						
						//$this->arrProdutosTipoSelecao_print = $this->arrProdutosTipoSelecao_print + array(array("id" => $linhaProdutosComplemento["id"], "complemento" => Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"])));
						
						//array_merge($this->arrProdutosTipoSelecao_print, array("id" => $linhaProdutosComplemento["id"]));
						//array_merge($this->arrProdutosTipoSelecao_print, array("complemento" => Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"])));
						
						//$this->arrProdutosTipoSelecao_print["id"] = $linhaProdutosComplemento["id"];
						//$this->arrProdutosTipoSelecao_print["complemento"] = Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);
						
						array_push($this->arrProdutosTipoSelecao_print, array("id" => $linhaProdutosComplemento["id"], 
																			"complemento" => Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"])
																			));
					}
				}
			}
			
			
			if($GLOBALS['habilitarProdutosFiltroGenerico01'] == 1)
			{	
				if($linhaProdutosComplemento["tipo_complemento"] == "12")
				{
					if(in_array($linhaProdutosComplemento["id"], $this->arrProdutosFiltroGenerico01Selecao))
					{
						array_push($this->arrProdutosFiltroGenerico01Selecao_print, array("id" => $linhaProdutosComplemento["id"], 
																					"complemento" => Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"])
																					));
					}
				}
			}
			
			
			if($GLOBALS['habilitarProdutosFiltroGenerico02'] == 1)
			{	
				if($linhaProdutosComplemento["tipo_complemento"] == "13")
				{
					if(in_array($linhaProdutosComplemento["id"], $this->arrProdutosFiltroGenerico02Selecao))
					{
						array_push($this->arrProdutosFiltroGenerico02Selecao_print, array("id" => $linhaProdutosComplemento["id"], 
																					"complemento" => Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"])
																					));
					}
				}
			}
			
			
			if($GLOBALS['habilitarProdutosFiltroGenerico03'] == 1)
			{	
				if($linhaProdutosComplemento["tipo_complemento"] == "14")
				{
					if(in_array($linhaProdutosComplemento["id"], $this->arrProdutosFiltroGenerico03Selecao))
					{
						array_push($this->arrProdutosFiltroGenerico03Selecao_print, array("id" => $linhaProdutosComplemento["id"], 
																					"complemento" => Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"])
																					));
					}
				}
			}
			
			
			if($GLOBALS['habilitarProdutosFiltroGenerico04'] == 1)
			{	
				if($linhaProdutosComplemento["tipo_complemento"] == "15")
				{
					if(in_array($linhaProdutosComplemento["id"], $this->arrProdutosFiltroGenerico04Selecao))
					{
						array_push($this->arrProdutosFiltroGenerico04Selecao_print, array("id" => $linhaProdutosComplemento["id"], 
																					"complemento" => Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"])
																					));
					}
				}
			}
			
			
			if($GLOBALS['habilitarProdutosFiltroGenerico05'] == 1)
			{	
				if($linhaProdutosComplemento["tipo_complemento"] == "16")
				{
					if(in_array($linhaProdutosComplemento["id"], $this->arrProdutosFiltroGenerico05Selecao))
					{
						array_push($this->arrProdutosFiltroGenerico05Selecao_print, array("id" => $linhaProdutosComplemento["id"], 
																					"complemento" => Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"])
																					));
					}
				}
			}
			
			
			if($GLOBALS['habilitarProdutosFiltroGenerico06'] == 1)
			{	
				if($linhaProdutosComplemento["tipo_complemento"] == "17")
				{
					if(in_array($linhaProdutosComplemento["id"], $this->arrProdutosFiltroGenerico06Selecao))
					{
						array_push($this->arrProdutosFiltroGenerico06Selecao_print, array("id" => $linhaProdutosComplemento["id"], 
																					"complemento" => Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"])
																					));
					}
				}
			}
			
			
			if($GLOBALS['habilitarProdutosFiltroGenerico07'] == 1)
			{	
				if($linhaProdutosComplemento["tipo_complemento"] == "18")
				{
					if(in_array($linhaProdutosComplemento["id"], $this->arrProdutosFiltroGenerico07Selecao))
					{
						array_push($this->arrProdutosFiltroGenerico07Selecao_print, array("id" => $linhaProdutosComplemento["id"], 
																					"complemento" => Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"])
																					));
					}
				}
			}
			
			
			if($GLOBALS['habilitarProdutosFiltroGenerico08'] == 1)
			{	
				if($linhaProdutosComplemento["tipo_complemento"] == "19")
				{
					if(in_array($linhaProdutosComplemento["id"], $this->arrProdutosFiltroGenerico08Selecao))
					{
						//$countArrayFiltroGenerico08 = 0;
						
						/*
						$this->arrProdutosFiltroGenerico08Selecao_print = $this->arrProdutosFiltroGenerico08Selecao_print + array(array("id" => $linhaProdutosComplemento["id"], 
																																		"complemento" => Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"])
																																		));
						*/
						/*
						array_merge($this->arrProdutosFiltroGenerico08Selecao_print, array(array("id" => $linhaProdutosComplemento["id"], 
																								"complemento" => Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"])
																								)));
						
						*/
						/*
						$this->arrProdutosFiltroGenerico08Selecao_print[$countArrayFiltroGenerico08] = array(array("id" => $linhaProdutosComplemento["id"], 
																													"complemento" => Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"])
																													));
						*/
						/**/
						array_push($this->arrProdutosFiltroGenerico08Selecao_print, array("id" => $linhaProdutosComplemento["id"], 
																					"complemento" => Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"])
																					));
																					
						
						/*
						array_push($this->arrProdutosFiltroGenerico08Selecao_print, array(array("id" => $linhaProdutosComplemento["id"], 
																								"complemento" => Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"])
																								)));
						*/
						//$countArrayFiltroGenerico08++;
					}
				}
			}
			
			
			if($GLOBALS['habilitarProdutosFiltroGenerico09'] == 1)
			{	
				if($linhaProdutosComplemento["tipo_complemento"] == "20")
				{
					if(in_array($linhaProdutosComplemento["id"], $this->arrProdutosFiltroGenerico09Selecao))
					{
						array_push($this->arrProdutosFiltroGenerico09Selecao_print, array("id" => $linhaProdutosComplemento["id"], 
																					"complemento" => Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"])
																					));
					}
				}
			}
			
			
			if($GLOBALS['habilitarProdutosFiltroGenerico10'] == 1)
			{	
				if($linhaProdutosComplemento["tipo_complemento"] == "21")
				{
					if(in_array($linhaProdutosComplemento["id"], $this->arrProdutosFiltroGenerico10Selecao))
					{
						array_push($this->arrProdutosFiltroGenerico10Selecao_print, array("id" => $linhaProdutosComplemento["id"], 
																					"complemento" => Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"])
																					));
					}
				}
			}
			
			
			if($GLOBALS['habilitarProdutosFiltroGenerico11'] == 1)
			{	
				if($linhaProdutosComplemento["tipo_complemento"] == "22")
				{
					if(in_array($linhaProdutosComplemento["id"], $this->arrProdutosFiltroGenerico11Selecao))
					{
						array_push($this->arrProdutosFiltroGenerico11Selecao_print, array("id" => $linhaProdutosComplemento["id"], 
																					"complemento" => Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"])
																					));
					}
				}
			}
			
			
			if($GLOBALS['habilitarProdutosFiltroGenerico12'] == 1)
			{	
				if($linhaProdutosComplemento["tipo_complemento"] == "23")
				{
					if(in_array($linhaProdutosComplemento["id"], $this->arrProdutosFiltroGenerico12Selecao))
					{
						array_push($this->arrProdutosFiltroGenerico12Selecao_print, array("id" => $linhaProdutosComplemento["id"], 
																					"complemento" => Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"])
																					));
					}
				}
			}
			
			
			if($GLOBALS['habilitarProdutosFiltroGenerico13'] == 1)
			{	
				if($linhaProdutosComplemento["tipo_complemento"] == "24")
				{
					if(in_array($linhaProdutosComplemento["id"], $this->arrProdutosFiltroGenerico13Selecao))
					{
						array_push($this->arrProdutosFiltroGenerico13Selecao_print, array("id" => $linhaProdutosComplemento["id"], 
																					"complemento" => Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"])
																					));
					}
				}
			}
			
			
			if($GLOBALS['habilitarProdutosFiltroGenerico14'] == 1)
			{	
				if($linhaProdutosComplemento["tipo_complemento"] == "25")
				{
					if(in_array($linhaProdutosComplemento["id"], $this->arrProdutosFiltroGenerico14Selecao))
					{
						array_push($this->arrProdutosFiltroGenerico14Selecao_print, array("id" => $linhaProdutosComplemento["id"], 
																					"complemento" => Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"])
																					));
					}
				}
			}
			
			
			if($GLOBALS['habilitarProdutosFiltroGenerico15'] == 1)
			{	
				if($linhaProdutosComplemento["tipo_complemento"] == "26")
				{
					if(in_array($linhaProdutosComplemento["id"], $this->arrProdutosFiltroGenerico15Selecao))
					{
						array_push($this->arrProdutosFiltroGenerico15Selecao_print, array("id" => $linhaProdutosComplemento["id"], 
																					"complemento" => Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"])
																					));
					}
				}
			}
			
			
			if($GLOBALS['habilitarProdutosFiltroGenerico16'] == 1)
			{	
				if($linhaProdutosComplemento["tipo_complemento"] == "27")
				{
					if(in_array($linhaProdutosComplemento["id"], $this->arrProdutosFiltroGenerico16Selecao))
					{
						array_push($this->arrProdutosFiltroGenerico16Selecao_print, array("id" => $linhaProdutosComplemento["id"], 
																					"complemento" => Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"])
																					));
					}
				}
			}
			
			
			if($GLOBALS['habilitarProdutosFiltroGenerico17'] == 1)
			{	
				if($linhaProdutosComplemento["tipo_complemento"] == "28")
				{
					if(in_array($linhaProdutosComplemento["id"], $this->arrProdutosFiltroGenerico17Selecao))
					{
						array_push($this->arrProdutosFiltroGenerico17Selecao_print, array("id" => $linhaProdutosComplemento["id"], 
																					"complemento" => Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"])
																					));
					}
				}
			}
			
			
			if($GLOBALS['habilitarProdutosFiltroGenerico18'] == 1)
			{	
				if($linhaProdutosComplemento["tipo_complemento"] == "29")
				{
					if(in_array($linhaProdutosComplemento["id"], $this->arrProdutosFiltroGenerico18Selecao))
					{
						array_push($this->arrProdutosFiltroGenerico18Selecao_print, array("id" => $linhaProdutosComplemento["id"], 
																					"complemento" => Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"])
																					));
					}
				}
			}
			
			
			if($GLOBALS['habilitarProdutosFiltroGenerico19'] == 1)
			{	
				if($linhaProdutosComplemento["tipo_complemento"] == "30")
				{
					if(in_array($linhaProdutosComplemento["id"], $this->arrProdutosFiltroGenerico19Selecao))
					{
						array_push($this->arrProdutosFiltroGenerico19Selecao_print, array("id" => $linhaProdutosComplemento["id"], 
																					"complemento" => Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"])
																					));
					}
				}
			}
			
			
			if($GLOBALS['habilitarProdutosFiltroGenerico20'] == 1)
			{	
				if($linhaProdutosComplemento["tipo_complemento"] == "31")
				{
					if(in_array($linhaProdutosComplemento["id"], $this->arrProdutosFiltroGenerico20Selecao))
					{
						array_push($this->arrProdutosFiltroGenerico20Selecao_print, array("id" => $linhaProdutosComplemento["id"], 
																					"complemento" => Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"])
																					));
					}
				}
			}
			
			
			if($GLOBALS['habilitarProdutosFiltroGenerico21'] == 1)
			{	
				if($linhaProdutosComplemento["tipo_complemento"] == "32")
				{
					if(in_array($linhaProdutosComplemento["id"], $this->arrProdutosFiltroGenerico21Selecao))
					{
						array_push($this->arrProdutosFiltroGenerico21Selecao_print, array("id" => $linhaProdutosComplemento["id"], 
																					"complemento" => Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"])
																					));
					}
				}
			}
			
			
			if($GLOBALS['habilitarProdutosFiltroGenerico22'] == 1)
			{	
				if($linhaProdutosComplemento["tipo_complemento"] == "33")
				{
					if(in_array($linhaProdutosComplemento["id"], $this->arrProdutosFiltroGenerico22Selecao))
					{
						array_push($this->arrProdutosFiltroGenerico22Selecao_print, array("id" => $linhaProdutosComplemento["id"], 
																					"complemento" => Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"])
																					));
					}
				}
			}
			
			
			if($GLOBALS['habilitarProdutosFiltroGenerico23'] == 1)
			{	
				if($linhaProdutosComplemento["tipo_complemento"] == "34")
				{
					if(in_array($linhaProdutosComplemento["id"], $this->arrProdutosFiltroGenerico23Selecao))
					{
						array_push($this->arrProdutosFiltroGenerico23Selecao_print, array("id" => $linhaProdutosComplemento["id"], 
																					"complemento" => Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"])
																					));
					}
				}
			}
			
			
			if($GLOBALS['habilitarProdutosFiltroGenerico24'] == 1)
			{	
				if($linhaProdutosComplemento["tipo_complemento"] == "35")
				{
					if(in_array($linhaProdutosComplemento["id"], $this->arrProdutosFiltroGenerico24Selecao))
					{
						array_push($this->arrProdutosFiltroGenerico24Selecao_print, array("id" => $linhaProdutosComplemento["id"], 
																					"complemento" => Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"])
																					));
					}
				}
			}
			
			
			if($GLOBALS['habilitarProdutosFiltroGenerico25'] == 1)
			{	
				if($linhaProdutosComplemento["tipo_complemento"] == "36")
				{
					if(in_array($linhaProdutosComplemento["id"], $this->arrProdutosFiltroGenerico25Selecao))
					{
						array_push($this->arrProdutosFiltroGenerico25Selecao_print, array("id" => $linhaProdutosComplemento["id"], 
																					"complemento" => Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"])
																					));
					}
				}
			}
			
			
			if($GLOBALS['habilitarProdutosFiltroGenerico26'] == 1)
			{	
				if($linhaProdutosComplemento["tipo_complemento"] == "37")
				{
					if(in_array($linhaProdutosComplemento["id"], $this->arrProdutosFiltroGenerico26Selecao))
					{
						array_push($this->arrProdutosFiltroGenerico26Selecao_print, array("id" => $linhaProdutosComplemento["id"], 
																					"complemento" => Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"])
																					));
					}
				}
			}
			
			
			if($GLOBALS['habilitarProdutosFiltroGenerico27'] == 1)
			{	
				if($linhaProdutosComplemento["tipo_complemento"] == "38")
				{
					if(in_array($linhaProdutosComplemento["id"], $this->arrProdutosFiltroGenerico27Selecao))
					{
						array_push($this->arrProdutosFiltroGenerico27Selecao_print, array("id" => $linhaProdutosComplemento["id"], 
																					"complemento" => Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"])
																					));
					}
				}
			}
			
			
			if($GLOBALS['habilitarProdutosFiltroGenerico28'] == 1)
			{	
				if($linhaProdutosComplemento["tipo_complemento"] == "39")
				{
					if(in_array($linhaProdutosComplemento["id"], $this->arrProdutosFiltroGenerico28Selecao))
					{
						array_push($this->arrProdutosFiltroGenerico28Selecao_print, array("id" => $linhaProdutosComplemento["id"], 
																					"complemento" => Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"])
																					));
					}
				}
			}
			
			
			if($GLOBALS['habilitarProdutosFiltroGenerico29'] == 1)
			{	
				if($linhaProdutosComplemento["tipo_complemento"] == "40")
				{
					if(in_array($linhaProdutosComplemento["id"], $this->arrProdutosFiltroGenerico29Selecao))
					{
						array_push($this->arrProdutosFiltroGenerico29Selecao_print, array("id" => $linhaProdutosComplemento["id"], 
																					"complemento" => Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"])
																					));
					}
				}
			}
			
			
			if($GLOBALS['habilitarProdutosFiltroGenerico30'] == 1)
			{	
				if($linhaProdutosComplemento["tipo_complemento"] == "41")
				{
					if(in_array($linhaProdutosComplemento["id"], $this->arrProdutosFiltroGenerico30Selecao))
					{
						array_push($this->arrProdutosFiltroGenerico30Selecao_print, array("id" => $linhaProdutosComplemento["id"], 
																					"complemento" => Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"])
																					));
					}
				}
			}
			
			
			
		}
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