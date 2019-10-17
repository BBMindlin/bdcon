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
$idTbProdutos = $_GET["idTbProdutos"];
$idParentProdutos = DbFuncoes::GetCampoGenerico01($idTbProdutos, "tb_produtos", "id_tb_categorias");
$idTipoProduto = DbFuncoes::FiltrosGenericosSelect03($idTbProdutos, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", "2", "", ",", "", "1");
$idTipoProduto_print = DbFuncoes::GetCampoGenerico01($idTipoProduto, "tb_produtos_complemento", "complemento");

$idTbCadastroLogado = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura(CookiesFuncoes::CookieValorLer_Login()), 2);
$idTbCadastroUsuario = $idTbCadastroLogado;

$paginaRetorno = "SiteAdmProdutosIndice.php";
$paginaRetornoExclusao = "SiteAdmProdutosEditar.php";
$variavelRetorno = "idTbProdutos";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];

//Manutenção - acesso.
$configManutencaoLink = 3;//0 - não exibir | 1 - página com todos as opções | 2 - página com opções específicas | 3 - ajax
$configManutencaoLinkFlag = true;

//Montagem de query padrão de retorno.
$queryPadrao = "&idParentProdutos=" . $idParentProdutos . 
"&idTbCadastroUsuario=" . $idTbCadastroUsuario . 
"&paginaRetorno=" . $paginaRetorno . 
"&masterPageSiteSelect=" . $masterPageSiteSelect . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&variavelRetorno=" . $variavelRetorno;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Query de pesquisa.
//----------
$strSqlProdutosDetalhesSelect = "";
$strSqlProdutosDetalhesSelect .= "SELECT ";
//$strSqlProdutosDetalhesSelect .= "* ";
$strSqlProdutosDetalhesSelect .= "id, ";
$strSqlProdutosDetalhesSelect .= "id_tb_categorias, ";
$strSqlProdutosDetalhesSelect .= "id_tb_cadastro_usuario, ";
$strSqlProdutosDetalhesSelect .= "data_produto, ";
$strSqlProdutosDetalhesSelect .= "cod_produto, ";
$strSqlProdutosDetalhesSelect .= "n_classificacao, ";
$strSqlProdutosDetalhesSelect .= "produto, ";
$strSqlProdutosDetalhesSelect .= "descricao01, ";
$strSqlProdutosDetalhesSelect .= "descricao02, ";
$strSqlProdutosDetalhesSelect .= "descricao03, ";
$strSqlProdutosDetalhesSelect .= "descricao04, ";
$strSqlProdutosDetalhesSelect .= "descricao05, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar1, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar2, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar3, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar4, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar5, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar6, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar7, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar8, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar9, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar10, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar11, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar12, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar13, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar14, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar15, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar16, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar17, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar18, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar19, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar20, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar21, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar22, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar23, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar24, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar25, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar26, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar27, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar28, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar29, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar30, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar31, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar32, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar33, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar34, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar35, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar36, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar37, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar38, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar39, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar40, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar41, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar42, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar43, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar44, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar45, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar46, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar47, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar48, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar49, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar50, ";
$strSqlProdutosDetalhesSelect .= "palavras_chave, ";
$strSqlProdutosDetalhesSelect .= "valor, ";
$strSqlProdutosDetalhesSelect .= "valor1, ";
$strSqlProdutosDetalhesSelect .= "valor2, ";
$strSqlProdutosDetalhesSelect .= "peso, ";
$strSqlProdutosDetalhesSelect .= "coeficiente, ";
$strSqlProdutosDetalhesSelect .= "estoque, ";
$strSqlProdutosDetalhesSelect .= "ativacao, ";
$strSqlProdutosDetalhesSelect .= "ativacao_promocao, ";
$strSqlProdutosDetalhesSelect .= "ativacao_home, ";
$strSqlProdutosDetalhesSelect .= "ativacao_home_categoria, ";
$strSqlProdutosDetalhesSelect .= "acesso_restrito, ";
$strSqlProdutosDetalhesSelect .= "n_questoes_aprovacao, ";
$strSqlProdutosDetalhesSelect .= "id_tb_produtos_status, ";
$strSqlProdutosDetalhesSelect .= "imagem, ";
$strSqlProdutosDetalhesSelect .= "anotacoes_internas, ";
$strSqlProdutosDetalhesSelect .= "n_visitas ";
$strSqlProdutosDetalhesSelect .= "FROM tb_produtos ";
$strSqlProdutosDetalhesSelect .= "WHERE id <> 0 ";
//$strSqlProdutosDetalhesSelect .= "AND id_tb_categorias = :id_tb_categorias ";
$strSqlProdutosDetalhesSelect .= "AND id = :id ";
//$strSqlProdutosDetalhesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
//----------


//Parâmetros.
//----------
$statementProdutosDetalhesSelect = $dbSistemaConPDO->prepare($strSqlProdutosDetalhesSelect);

if ($statementProdutosDetalhesSelect !== false)
{
	$statementProdutosDetalhesSelect->execute(array(
		"id" => $idTbProdutos
	));
}
//----------


//Definição das variáveis de detalhes.
//----------
//$resultadoProdutosDetalhes = $dbSistemaConPDO->query($strSqlProdutosDetalhesSelect);
$resultadoProdutosDetalhes = $statementProdutosDetalhesSelect->fetchAll();

if (empty($resultadoProdutosDetalhes))
{
	//echo "Nenhum registro encontrado";
}else{
	foreach($resultadoProdutosDetalhes as $linhaProdutosDetalhes)
	{
		//Definição das variáveis de detalhes.
		$tbProdutosId = $linhaProdutosDetalhes['id'];
		$tbProdutosIdTbCategorias = $linhaProdutosDetalhes['id_tb_categorias'];
		$tbProdutosIdTbCadastroUsuario = $linhaProdutosDetalhes['id_tb_cadastro_usuario'];
		//$tbProdutosDataProduto = Funcoes::DataLeitura01($linhaProdutosDetalhes['data_produto'], $GLOBALS['configSistemaFormatoData'], "1");
		if($linhaProdutosDetalhes['data_produto'] == NULL)
		{
			$tbProdutosDataProduto = "";
		}else{
			$tbProdutosDataProduto = Funcoes::DataLeitura01($linhaProdutosDetalhes['data_produto'], $GLOBALS['configSistemaFormatoData'], "1");
		}
		$tbProdutosCodProduto = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['cod_produto']);
		$tbProdutosNClassificacao = $linhaProdutosDetalhes['n_classificacao'];

		$tbProdutosProduto = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['produto']);
		$tbProdutosDescricao01 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['descricao01'], "limpar_br");
		$tbProdutosDescricao02 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['descricao02'], "limpar_br");
		$tbProdutosDescricao03 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['descricao03'], "limpar_br");
		$tbProdutosDescricao04 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['descricao04'], "limpar_br");
		$tbProdutosDescricao05 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['descricao05'], "limpar_br");

		$tbProdutosIC1 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar1'], "limpar_br");
		$tbProdutosIC2 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar2'], "limpar_br");
		$tbProdutosIC3 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar3'], "limpar_br");
		$tbProdutosIC4 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar4'], "limpar_br");
		$tbProdutosIC5 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar5'], "limpar_br");
		$tbProdutosIC6 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar6'], "limpar_br");
		$tbProdutosIC7 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar7'], "limpar_br");
		$tbProdutosIC8 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar8'], "limpar_br");
		$tbProdutosIC9 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar9'], "limpar_br");
		$tbProdutosIC10 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar10'], "limpar_br");
		$tbProdutosIC11 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar11'], "limpar_br");
		$tbProdutosIC12 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar12'], "limpar_br");
		$tbProdutosIC13 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar13'], "limpar_br");
		$tbProdutosIC14 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar14'], "limpar_br");
		$tbProdutosIC15 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar15'], "limpar_br");
		$tbProdutosIC16 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar16'], "limpar_br");
		$tbProdutosIC17 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar17'], "limpar_br");
		$tbProdutosIC18 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar18'], "limpar_br");
		$tbProdutosIC19 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar19'], "limpar_br");
		$tbProdutosIC20 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar20'], "limpar_br");
		$tbProdutosIC21 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar21'], "limpar_br");
		$tbProdutosIC22 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar22'], "limpar_br");
		$tbProdutosIC23 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar23'], "limpar_br");
		$tbProdutosIC24 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar24'], "limpar_br");
		$tbProdutosIC25 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar25'], "limpar_br");
		$tbProdutosIC26 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar26'], "limpar_br");
		$tbProdutosIC27 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar27'], "limpar_br");
		$tbProdutosIC28 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar28'], "limpar_br");
		$tbProdutosIC29 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar29'], "limpar_br");
		$tbProdutosIC30 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar30'], "limpar_br");
		$tbProdutosIC31 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar31'], "limpar_br");
		$tbProdutosIC32 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar32'], "limpar_br");
		$tbProdutosIC33 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar33'], "limpar_br");
		$tbProdutosIC34 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar34'], "limpar_br");
		$tbProdutosIC35 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar35'], "limpar_br");
		$tbProdutosIC36 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar36'], "limpar_br");
		$tbProdutosIC37 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar37'], "limpar_br");
		$tbProdutosIC38 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar38'], "limpar_br");
		$tbProdutosIC39 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar39'], "limpar_br");
		$tbProdutosIC40 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar40'], "limpar_br");
		$tbProdutosIC41 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar41'], "limpar_br");
		$tbProdutosIC42 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar42'], "limpar_br");
		$tbProdutosIC43 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar43'], "limpar_br");
		$tbProdutosIC44 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar44'], "limpar_br");
		$tbProdutosIC45 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar45'], "limpar_br");
		$tbProdutosIC46 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar46'], "limpar_br");
		$tbProdutosIC47 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar47'], "limpar_br");
		$tbProdutosIC48 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar48'], "limpar_br");
		$tbProdutosIC49 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar49'], "limpar_br");
		$tbProdutosIC50 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar50'], "limpar_br");

		$tbProdutosPalavrasChave = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['palavras_chave'], "limpar_br");
		$tbProdutosValor = Funcoes::MascaraValorLer($linhaProdutosDetalhes['valor'], $GLOBALS['configSistemaMoeda']);
		$tbProdutosValor1 = Funcoes::MascaraValorLer($linhaProdutosDetalhes['valor1'], $GLOBALS['configSistemaMoeda']);
		$tbProdutosValor2 = Funcoes::MascaraValorLer($linhaProdutosDetalhes['valor2'], $GLOBALS['configSistemaMoeda']);
		//$tbProdutosPeso = Funcoes::MascaraValorLer($linhaProdutosDetalhes['peso'], $GLOBALS['configSistemaMoeda']);
		$tbProdutosPeso = $linhaProdutosDetalhes['peso'];
		
		//$tbProdutosCoeficiente = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['coeficiente']);
		//$tbProdutosCoeficiente = Funcoes::MascaraValorLer($linhaProdutosDetalhes['coeficiente'], $GLOBALS['configSistemaMoeda']);
		$tbProdutosCoeficiente = $linhaProdutosDetalhes['coeficiente'];
		$tbProdutosEstoque = $linhaProdutosDetalhes['estoque'];
		$tbProdutosAtivacao = $linhaProdutosDetalhes['ativacao'];
		$tbProdutosAtivacaoPromocao = $linhaProdutosDetalhes['ativacao_promocao'];
		$tbProdutosAtivacaoHome = $linhaProdutosDetalhes['ativacao_home'];
		$tbProdutosAtivacaoHomeCategoria = $linhaProdutosDetalhes['ativacao_home_categoria'];
		$tbProdutosAcessoRestrito = $linhaProdutosDetalhes['acesso_restrito'];
		
		$tbProdutosNQuestoesAprovacao = $linhaProdutosDetalhes['n_questoes_aprovacao'];
		$tbProdutosIdTbProdutosStatus = $linhaProdutosDetalhes['id_tb_produtos_status'];
		$tbProdutosImagem = $linhaProdutosDetalhes['imagem'];
		$tbProdutosAnotacoesInternas = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['anotacoes_internas'], "limpar_br");
		$tbProdutosNVisitas = $linhaProdutosDetalhes['n_visitas'];
		//Verificação de erro.
		//echo "tbProdutosId=" . $tbProdutosId . "<br>";
		//echo "tbProdutosProcesso=" . $tbProdutosProcesso . "<br>";
		
	}
}
//----------


//Verificação de erro - debug.
//echo "strSqlVeiculosDetalhesSelect=" . $strSqlVeiculosDetalhesSelect . "<br />";
//echo "idTipoProduto=" . $idTipoProduto . "<br>";
?>
<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloSite'], "IncludeConfig"); ?> - <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosTituloEditar"); ?>
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
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosTituloEditar"); ?>
<?php 
$pageSite->cphTituloLinkAtual = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>
<?php //Conteúdo principal.?>
<?php //**************************************************************************************?>
<?php ob_start(); /*cphConteudoPrincipal*/ ?>

	<!--Box identificação.-->
	<div style="position: absolute; display: block; width: 1014px; height: 668px; margin-top: -334px; margin-left: -507px; top: 50%; left: 50%; border: 1px solid #efe4b0; background-color: #ffffff; /**/">
        
        <!--Box principal.-->
        <div style="position: absolute; display: block; width: 990px; height: 430px; top: 15px; left: 12px; border: 1px solid #000000; background-color: #ddd;">
        	<!--Títulos.-->
            <div style="position: absolute; display: block; /*height: 20px; */top: -8px; left: 13px; border: 1px solid #000000; background-color: #ffffff;">
            	<span class="SiteTitulos01" style="position: relative; display: block; padding: 3px 5px 3px 5px;">
                    <?php echo $idTipoProduto_print;?>
                </span>
            </div>
            
	<script type="text/javascript">
		$(document).ready(function () {
			//Remover todas opções não selecionadas de listbox ao carregar.
			$(function() {
			  $('.AdmCampoFiltroGenericoListBox01').load('change', function() {
				$(this).find('option').not(':selected').remove();
			  });
			});			
			
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
			jQuery.validator.addMethod("accept", function(value, element, param) {
				//return value.match(new RegExp("^" + param + "$"));
				return value.match(new RegExp(param));
			});	
			//**************************************************************************************

				
			//Validação de formulário (JQuery).
			//**************************************************************************************
			$('#formProdutosEditar').validate({ //Inicialização do plug-in.
			
			
				//Estilo da mensagem de erro.
				//----------------------
				errorClass: "TextoErro",
				//----------------------
				
				
				//Validação
				//----------------------
				rules: {
					n_classificacao: {
						required: true,
						//regex: /-?\d+(\.\d{1,3})?/
						number: true
					},
					valor: {
						required: true,
						//regex: /-?\d+(\.\d{1,3})?/
						//regex: /-?[0-9]+(?:\.?[0-9]*)?,?[0-9]+(?:\.?[0-9]*)?/
						//pattern: /-?[0-9]+(?:\.?[0-9]*)?,?[0-9]+(?:\.?[0-9]*)?/
						//pattern: /^(\d+|\d+,\d{1,2})$/
						//pattern: /[0-9]+([\.|,][0-9]+)?/
						accept: "-?[0-9]+(?:\.?[0-9]*)?,?[0-9]+(?:\.?[0-9]*)?"
						//number: true
					},
					valor1: {
						required: true,
						//regex: /-?\d+(\.\d{1,3})?/
						//regex: /-?[0-9]+(?:\.?[0-9]*)?,?[0-9]+(?:\.?[0-9]*)?/
						//pattern: /-?[0-9]+(?:\.?[0-9]*)?,?[0-9]+(?:\.?[0-9]*)?/
						//pattern: /^(\d+|\d+,\d{1,2})$/
						//pattern: /[0-9]+([\.|,][0-9]+)?/
						accept: "-?[0-9]+(?:\.?[0-9]*)?,?[0-9]+(?:\.?[0-9]*)?"
						//number: true
					},
					valor2: {
						required: true,
						//regex: /-?\d+(\.\d{1,3})?/
						//regex: /-?[0-9]+(?:\.?[0-9]*)?,?[0-9]+(?:\.?[0-9]*)?/
						//pattern: /-?[0-9]+(?:\.?[0-9]*)?,?[0-9]+(?:\.?[0-9]*)?/
						//pattern: /^(\d+|\d+,\d{1,2})$/
						//pattern: /[0-9]+([\.|,][0-9]+)?/
						accept: "-?[0-9]+(?:\.?[0-9]*)?,?[0-9]+(?:\.?[0-9]*)?"
						//number: true
					}//,
				},
				
				
				//Mensagens.
				//----------------------
				messages: {
					//n_classificacao: "Please specify your name"//,
					n_classificacao: {
					  //required: "Campo obrigatório.",
					  required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>",
					  //regex: "Campo numérico."
					  //number: "Campo numérico."
					  number: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica1"); ?>"
					},
					valor: {
					  //required: "Campo obrigatório.",
					  required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>",
					  //pattern: "echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica3");"
					  accept: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica3"); ?>"
					  //number: "Campo numérico."
					},
					valor1: {
					  //required: "Campo obrigatório.",
					  required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>",
					  //pattern: "echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica3");"
					  accept: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica3"); ?>"
					  //number: "Campo numérico."
					},
					valor2: {
					  //required: "Campo obrigatório.",
					  required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>",
					  //pattern: "echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica3");"
					  accept: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica3"); ?>"
					  //number: "Campo numérico."
					}//,
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
        var strDatapickerAgendaPtCampos = "";
        var strDatapickerAgendaEnCampos = "";
    </script>
    <form name="formProdutosEditar" id="formProdutosEditar" action="SiteAdmProdutosEditarExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            
            <!--Identificação - Livros.-->
			<?php if($idTipoProduto == "3486"){ ?>
            <div class="AdmTexto01" style="position: absolute; display: block; width: 605px; height: 405px; top: 15px; left: 13px; border: 1px solid #000000;">
				<?php include "SiteAdmProdutosEditarIncludeIdentificacao3486.php"; ?>
            </div>
			<?php } ?>
            <!--Identificação - Livros.-->
            
            
            <!--Identificação - Diplomas.-->
			<?php if($idTipoProduto == "3483"){ ?>
            <div class="AdmTexto01" style="position: absolute; display: block; width: 605px; height: 405px; top: 15px; left: 13px; border: 1px solid #000000;">
				<?php include "SiteAdmProdutosEditarIncludeIdentificacao3483.php"; ?>
            </div>
			<?php } ?>
            <!--Identificação - Diplomas.-->
            
            
            <!--Identificação - Documentos.-->
			<?php if($idTipoProduto == "3484"){ ?>
            <div class="AdmTexto01" style="position: absolute; display: block; width: 605px; height: 405px; top: 15px; left: 13px; border: 1px solid #000000;">
				<?php include "SiteAdmProdutosEditarIncludeIdentificacao3484.php"; ?>
            </div>
			<?php } ?>
            <!--Identificação - Documentos.-->
            
            
            <!--Identificação - Fotografia.-->
			<?php if($idTipoProduto == "3485"){ ?>
            <div class="AdmTexto01" style="position: absolute; display: block; width: 605px; height: 405px; top: 15px; left: 13px; border: 1px solid #000000;">
				<?php include "SiteAdmProdutosEditarIncludeIdentificacao3485.php"; ?>
            </div>
			<?php } ?>
            <!--Identificação - Fotografia.-->
            
            
            <!--Identificação - Mapas.-->
			<?php if($idTipoProduto == "3487"){ ?>
            <div class="AdmTexto01" style="position: absolute; display: block; width: 605px; height: 405px; top: 15px; left: 13px; border: 1px solid #000000;">
				<?php include "SiteAdmProdutosEditarIncludeIdentificacao3487.php"; ?>
            </div>
			<?php } ?>
            <!--Identificação - Mapas.-->
            
            
            <!--Identificação - Obras de Arte.-->
			<?php if($idTipoProduto == "3488"){ ?>
            <div class="AdmTexto01" style="position: absolute; display: block; width: 605px; height: 405px; top: 15px; left: 13px; border: 1px solid #000000;">
				<?php include "SiteAdmProdutosEditarIncludeIdentificacao3488.php"; ?>
            </div>
			<?php } ?>
            <!--Identificação - Obras de Arte.-->
            
            
            <!--Imagens.-->
            <div style="position: absolute; display: block; width: 350px; height: 345px; top: 15px; left: 625px; border: 1px solid #000000; text-align: center;">
            	<?php if(!empty($tbProdutosImagem)){ //if($tbCategoriasImagem <> ""){?>
                	<div align="center" style="position: relative; display: block; width: 100%; margin-top: 40px;">
						<?php //SlimBox 2 - JQuery.?>
                        <?php if($GLOBALS['configImagemPopUp'] == "1"){ ?>
                            <a href="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>g<?php echo $tbProdutosImagem;?>" rel="lightbox" title="<?php echo $tbProdutosProduto; ?>"><img src="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>r<?php echo $tbProdutosImagem;?>" alt="<?php echo $tbProdutosProduto; ?>" /></a>
                        <?php } ?>
                        
                        <?php //Pop-up div com comentários.?>
                        <?php if($GLOBALS['configImagemPopUp'] == "2"){ ?>
            
                        <?php } ?>
                    </div>
                
                    <div style="position: absolute; display: block; bottom: -69px; right: -10px; z-index: 999;">
                        <div class="AdmDivBto01" style="background-image: none; background-color: #c31907; border: 1px solid #000000;">
                            <a href="SiteAdmRegistrosArquivosExcluirExe.php?idRegistro=<?php echo $tbProdutosId;?>&strTabela=tb_produtos&strCampo=imagem<?php echo $queryPadrao;?>" class="AdmLinks02" style="margin-left: 4px;">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemImagemExcluir"); ?>
                            </a>
                        </div>
                    </div>
				<?php } ?>
            </div>
            <!--Imagens.-->

            
            <!--Salvar.-->
            <div class="AdmTexto01" style="position: absolute; display: block; bottom: 8px; left: 625px;">
                <table style="display: none;">
                <?php if($GLOBALS['habilitarProdutosTipo'] == "1"){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
    
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosTipo"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left" class="AdmTexto01">
                            <?php
                            //Seleção de ids selecionados para o registro.
                            $arrProdutosTipoSelecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbProdutosId, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", "2", "", ",", "", "1"));
                            ?>
    
                            <?php 
                            $arrProdutosTipo = DbFuncoes::FiltrosGenericosFill01("tb_produtos_complemento", 2);
                            ?>
                            
                            <?php 
                            for($countArray = 0; $countArray < count($arrProdutosTipo); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsProdutosTipo[]" type="checkbox" value="<?php echo $arrProdutosTipo[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrProdutosTipo[$countArray][0], $arrProdutosTipoSelecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrProdutosTipo[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao3"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left" class="AdmTexto01">
                            <select name="ativacao" id="ativacao" class="AdmCampoDropDownMenu01">
                                <option value="0"<?php if($tbProdutosAtivacao == "0"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao4"); ?></option>
                                <option value="1"<?php if($tbProdutosAtivacao == "1"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao5"); ?></option>
                            </select>
                        </div>
                    </td>
                </tr>
                </table>
            	<div style="position: absolute; display: block; top: 10px; left: 0px;">
                	<div style="position: absolute; display: block; top: -12px; width: 380px;">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemImagem"); ?>: 
                        <input type="file" name="ArquivoUpload1" id="ArquivoUpload1" class="AdmCampoArquivoUpload01" style="width: 308px;" />
                    </div>
                </div>
                
                <div class="AdmDivBto01" onclick="btoClick_onEvent('btoProdutosUpdate');" style="top: 10px;">
                    <a class="AdmLinks01">
                        Salvar
                    </a>
                </div>
                <input id="btoProdutosUpdate" type="image" name="submit" value="Submit" src="img/btoAtualizar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoAtualizar"); ?>" style="display: none;" />
                
                <input type="hidden" id="idTbProdutos" name="idTbProdutos" value="<?php echo $idTbProdutos; ?>" />
                
                <input type="hidden" id="id_tb_categorias" name="id_tb_categorias" value="<?php echo $tbProdutosIdTbCategorias; ?>" />
                <input type="hidden" id="ativacao_promocao" name="ativacao_promocao" value="<?php echo $tbProdutosAtivacaoPromocao; ?>" />
                <input type="hidden" id="ativacao_home" name="ativacao_home" value="<?php echo $tbProdutosAtivacaoHome; ?>" />
                <input type="hidden" id="ativacao_home_categoria" name="ativacao_home_categoria" value="<?php echo $tbProdutosAtivacaoHomeCategoria; ?>" />
                <input type="hidden" id="acesso_restrito" name="acesso_restrito" value="<?php echo $tbProdutosAcessoRestrito; ?>" />
                
                <input type="hidden" id="paginaRetorno" name="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                <input type="hidden" id="masterPageSiteSelect" name="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
                
                <div style="position: absolute; display: inline-block; bottom: -22px; width: 300px;">
                    <div align="left" class="AdmErro">
                        <?php echo $mensagemErro;?>
                    </div>
                    <div align="left" class="AdmSucesso">
                        <?php echo $mensagemSucesso;?>
                    </div>
                    <div align="left" class="AdmAlerta">
                        <?php echo $mensagemAlerta;?>
                    </div>
                </div>
            </div>
            
            
            
    </form>
    <br />
            
            
        </div>
        <!--Box principal.-->
        
        
        <!--Box histórico.-->
        <div style="position: absolute; display: block; width: 990px; height: 170px; top: 460px; left: 12px; border: 1px solid #000000; background-color: #ddd;">
        	<!--Títulos.-->
            <div style="position: absolute; display: block; /*height: 20px; */top: -8px; left: 13px; border: 1px solid #000000; background-color: #ffffff;">
            	<span class="SiteTitulos01" style="position: relative; display: block; padding: 3px 5px 3px 5px;">
                    Ficha T&eacute;cnica de Tratamento
                </span>
            </div>
            
            <!--Conteúdo.-->
            <div style="position: absolute; display: block; top: 15px; left: 13px; width: 100%; height: 160px;">
                <iframe class="AdmTabelaIFrame01" src="SiteAdmHistoricoIndice.php?idParent=<?php echo $idTbProdutos; ?>&masterPageSiteSelect=LayoutSiteIFrame.php" scrolling="no" name="historico" frameborder="0" align="left" width="100%" height="100%">
                </iframe>
            </div>
        </div>
        <!--Box histórico.-->
        
        
        <!--Paginação.-->
        <div class="AdmTexto01" style="position: absolute; display: block; top: 640px; left: 12px; z-index: 1;">
			<?php //Navegação.?>
            <?php //----------------------?>
            <?php 
			$idsTbProdutos = DbFuncoes::GetCampoGenerico07("tb_produtos_relacao_complemento", 
															"id_tb_produtos", 
															"id_tb_produtos_complemento", 
															$idTipoProduto, 
															"", 
															"", 
															1,
															"", 
															"", 
															"tipo_complemento", 
															"2", 
															"", 
															"",
															"", 
															"");
	
			
			
            //Definição de variáveis do include.
            $includeNavegacao_strTabela = "tb_produtos";
			$includeNavegacao_strClassificacao = $GLOBALS['configClassificacaoProdutos'];
            //$includeNavegacao_arrParametrosPesquisa = array("id_tb_categorias;" . $tbProdutosIdTbCategorias . ";i", "ativacao;1;i");
            $includeNavegacao_arrParametrosPesquisa = array("id_tb_categorias;" . $tbProdutosIdTbCategorias . ";i", "id;" . $idsTbProdutos . ";ids");
            $includeNavegacao_registroAtual = $idTbProdutos;
            
            $includeNavegacao_tipoNavegacao = 1; //1 - simples (edição / detalhes)
            
            //$includeNavegacao_paginaDestino = $paginaRetorno;
            $includeNavegacao_paginaDestino = "SiteAdmProdutosEditar.php";
            $includeNavegacao_variavelDestino = $variavelRetorno;
            ?>
            
            <?php include "IncludeNavegacao.php";?>
            <?php //----------------------?>
        </div>
        
        <!--Excluir.-->
		<?php if(CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroUsuario") <> ""){ ?>
			<?php 
			if(DbFuncoes::GetCampoGenerico10("tb_historico", 
												"id", 
												array("id_parent; " . $idTbProdutos . ";i"), 
												"", 
												"", 
												1) == "")
			{
            ?>
            <div align="center" style="position: absolute; display: block; top: 630px; left: 0px; right: 0px; margin-left: auto; margin-right: auto;">
            <form name="formProdutosAcoes" id="formProdutosAcoes" action="SiteAdmRegistrosAcoesExe.php" method="post" class="FormularioTabela01">
                <input name="strTabela" id="strTabela" type="hidden" value="tb_produtos" />
                <input name="idParentProdutos" id="idParentProdutos" type="hidden" value="<?php echo $idParentProdutos; ?>" />
    
                <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php //echo $paginaRetorno; ?>SiteAdm.php" />
                <input name="masterPageSiteSelect" type="hidden" id="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
                <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
                <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
                
                <input name="idsRegistrosExcluir[]" type="checkbox" checked="checked" value="<?php echo $idTbProdutos;?>" class="AdmCampoCheckBox01" style="display: none;" />
            
                <div class="AdmDivBto01" onclick="btoClick_onEvent('btoProdutosExcluirCancelar');" style="background-image: none; background-color: #c31907; border: 1px solid #000000;">
                    <a class="AdmLinks02" style="margin-left: 4px;">
                        Excluir / Cancelar
                    </a>
                </div>
                <input id="btoProdutosExcluirCancelar" type="image" name="submit" value="Submit" src="img/btoExcluir03.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoExcluir"); ?>" style="display: none;" />
            </form>
            </div>
            <?php } ?>
		<?php } ?>
        
        <!--Outras Funções.-->
        <div style="position: absolute; display: block; top: 630px; right: 2px;">
            <div class="AdmDivBto01">
                <a href="SiteAdm.php" class="AdmLinks01">
                    Voltar &agrave; <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAdmPainelTitulo"); ?>
                </a>
            </div>
        </div>
    </div>
	<!--Box identificação.-->
    
    
    <?php //Manutenção - Ajax.?>
    <div id="divManutencaoAjax" class="AdmDivPopupAjaxContainer" style="">
        <div class="AdmDivPopupAjax" style="">
        	<div style="position: absolute; display: block; height: 25px; top: -25px; right: 0px;">
            	<a id="linkManutencaoAjaxFechar" onclick="" class="AdmLinksFechar01" style="cursor: pointer; display: none;">
                    <img src="img/btoFecharJanela.png" border="0" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoFechar"); ?>" />
                </a>
            </div>
            <iframe id="iframeManutencaoAjax" name="iframeManutencaoAjax" src="" class="AdmTabelaIFrame01" scrolling="auto" frameborder="0" width="100%" height="100%">
            </iframe>
        </div>
    </div>
    
    
    <?php //Progress bar.?>
    <div id="updtProgressManutencao" class="ProgressBarGenerico01Container" style="display: none;">
        <div class="ProgressBarGenerico01">
            <img src="img/ProgressBar01.gif" border="0" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteImagemProgressBarra"); ?>" />
        </div>
    </div>
    
    
    <?php //Níveis de usuários.?>
    <?php if($tbProdutosAtivacao == 0 && CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroUsuario") == ""){ ?>
	<script type="text/javascript">
		$(document).ready(function (){
			$(".AdmCampoTexto02").prop("readonly", true); //Transformar todos campos em readonly.
			$(".AdmCampoTexto02").addClass("AdmCampoDesabilitado01"); //Alterar a cor do campo desativado.
			
			$(".AdmCampoTextoMultilinha01").prop("readonly", true); //Transformar todos campos multilinha em readonly.
			$(".AdmCampoTextoMultilinha01").addClass("AdmCampoDesabilitado01"); //Alterar a cor do campo multilinha desativado.
			
			//$(".AdmCampoArquivoUpload01").prop("readonly", true); //Transformar todos campos de upload em readonly.
			$(".AdmCampoArquivoUpload01").prop("disabled", true);
			$(".AdmCampoArquivoUpload01").addClass("AdmCampoDesabilitado01"); //Alterar a cor do campo de upload desativado.
			
			//$(".AdmCampoDropDownMenu01").prop("readonly", true); //Transformar todos dropdowns em readonly.
			$(".AdmCampoDropDownMenu01").prop("disabled", true);//Desabilitar todos dropdowns em readonly.
			$(".AdmCampoDropDownMenu01").addClass("AdmCampoDesabilitado01"); //Alterar a cor do dropdowns desativado.
			
			$(".AdmCampoFiltroGenericoListBox01").prop("disabled", true);//Desabilitar todos listboxs em readonly.
			$(".AdmCampoFiltroGenericoListBox01").addClass("AdmCampoDesabilitado01"); //Alterar a cor do listboxs desativado.
			
			//$(".AdmLinks01").hide();//Ocultar mecanismos de manutenção.
			$('img[src="img/btoManutencao.png"]').hide();
			/*
			$("img").each(function() {
                if (this.src == "img/btoManutencao.png") {
					//if it has source
					$("img").hide();
				}
            });*/
			
			$(".AdmLinksExcluir01").hide();//Ocultar mecanismos de manutenção.
		});	
	</script>
    <?php } ?>
    
	<?php if(CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroUsuario3") <> "" || CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroUsuario4") <> "" || CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroUsuario5") <> ""){ ?>
	<script type="text/javascript">
		$(document).ready(function (){
			$(".AdmCampoTexto02").prop("readonly", true); //Transformar todos campos em readonly.
			$(".AdmCampoTexto02").addClass("AdmCampoDesabilitado01"); //Alterar a cor do campo desativado.
			
			$(".AdmCampoTextoMultilinha01").prop("readonly", true); //Transformar todos campos multilinha em readonly.
			$(".AdmCampoTextoMultilinha01").addClass("AdmCampoDesabilitado01"); //Alterar a cor do campo multilinha desativado.
			
			//$(".AdmCampoArquivoUpload01").prop("readonly", true); //Transformar todos campos de upload em readonly.
			$(".AdmCampoArquivoUpload01").prop("disabled", true);
			$(".AdmCampoArquivoUpload01").addClass("AdmCampoDesabilitado01"); //Alterar a cor do campo de upload desativado.
			
			//$(".AdmCampoDropDownMenu01").prop("readonly", true); //Transformar todos dropdowns em readonly.
			$(".AdmCampoDropDownMenu01").prop("disabled", true);//Desabilitar todos dropdowns em readonly.
			$(".AdmCampoDropDownMenu01").addClass("AdmCampoDesabilitado01"); //Alterar a cor do dropdowns desativado.
			
			$(".AdmCampoFiltroGenericoListBox01").prop("disabled", true);//Desabilitar todos listboxs em readonly.
			$(".AdmCampoFiltroGenericoListBox01").addClass("AdmCampoDesabilitado01"); //Alterar a cor do listboxs desativado.
			
			//$(".AdmLinks01").hide();//Ocultar mecanismos de manutenção.
			$('img[src="img/btoManutencao.png"]').hide();
			/*
			$("img").each(function() {
                if (this.src == "img/btoManutencao.png") {
					//if it has source
					$("img").hide();
				}
            });*/
			
			$(".AdmLinksExcluir01").hide();//Ocultar mecanismos de manutenção.
		});	
	</script>
	<?php } ?>
    
    
	<script type="text/javascript">
		//Retirar br tag dos textareas.
		//$(document).ready(function (){
		(function($){
			//$(".AdmCampoTextoMultilinha01").val().replace(/[<]br[^>]*[>]/gi,"");
			//$(".AdmCampoTextoMultilinha01").text().replace(/[<]br[^>]*[>]/gi,"");
			//$(".AdmCampoTextoMultilinha01").val().rep
			//$(".AdmCampoTextoMultilinha01").load(function() { $(this).text().replace(/[<]br[^>]*[>]/gi,"") })
			
			//$(".AdmCampoTextoMultilinha01").text() = "";
			//$(".AdmCampoTextoMultilinha01").text(""); //funcionando
			
			$(".AdmCampoTextoMultilinha01").text(
				//$(".AdmCampoTextoMultilinha01").text().replace(/[<]br[^>]*[>]/gi,"") //sem ; - funcionando
			);
		})(jQuery);
		//});	
	</script>
<?php 
$pageSite->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>
<?php
//Limpeza de objetos.
//----------
unset($strSqlProdutosDetalhesSelect);
unset($statementProdutosDetalhesSelect);
unset($resultadoProdutosDetalhes);
unset($linhaProdutosDetalhes);
//----------


//Inclusão do template do layout.
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>