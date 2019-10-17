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
$idsTbCadastro = $_GET["idsTbCadastro"];
//$idParentCategorias = $_GET["idParentCategorias"];
//$idParentCadastro = DbFuncoes::GetCampoGenerico01($idTbCadastro, "tb_cadastro", "id_tb_categorias");
$idTbTurmas = $_GET["idTbTurmas"];

$dataAulaMes = $_GET["dataAulaMes"];
$dataAulaAno = $_GET["dataAulaAno"];

$paginaRetorno = "SiteAdmCadastroRelatorio01.php";
$paginaRetornoExclusao = "SiteAdmCadastroRelatorio01.php";
$variavelRetorno = "idsTbCadastro";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];


//Montagem de query padrão de retorno.
$queryPadrao = "&paginaRetorno=" . $paginaRetorno . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&variavelRetorno=" . $variavelRetorno;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemRelatorio"); ?>
     - 
	<?php echo htmlentities($GLOBALS['configTituloSite']); ?>
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
    
    
	<?php //Informações - Cliente.?>
    <?php //**************************************************************************************?>
    <div class="AdmTexto01" style="position: relative; display: block;">
    	<div style="position: relative; display: block;">
        	<?php echo htmlentities($GLOBALS['configClienteRazaoSocial']); ?> 
        </div>
    	<div style="position: relative; display: block;">
        	<?php echo htmlentities($GLOBALS['configClienteEndereco']); ?> 
        </div>
    	<div style="position: relative; display: block;">
        	<?php echo htmlentities($GLOBALS['configClienteNumero']); ?> 
        </div>
    	<div style="position: relative; display: block;">
        	<?php echo htmlentities($GLOBALS['configClienteComplemento']); ?> 
        </div>
    	<div style="position: relative; display: block;">
        	<?php echo htmlentities($GLOBALS['configClienteBairro']); ?> 
        </div>
    	<div style="position: relative; display: block;">
        	<?php echo htmlentities($GLOBALS['configClienteCidade']); ?> 
        </div>
    	<div style="position: relative; display: block;">
        	<?php echo htmlentities($GLOBALS['configClienteEstado']); ?> 
        </div>
    	<div style="position: relative; display: block;">
        	<?php echo htmlentities($GLOBALS['configClienteCEP']); ?> 
        </div>
    	<div style="position: relative; display: block;">
        	<?php echo htmlentities($GLOBALS['configClienteTel']); ?> 
        </div>
    	<div style="position: relative; display: block;">
        	<?php echo htmlentities($GLOBALS['configClienteEmail']); ?> 
        </div>
    </div>
    <?php //**************************************************************************************?>


	<?php //Informações - Cadastro.?>
    <?php //**************************************************************************************?>
    <?php
		$idTbCadastro = $idsTbCadastro;
	?>
    <div class="AdmTexto01" style="position: relative; display: block;">
    	<div style="position: relative; display: block;">
        	<span style="font-weight: bold;">
				<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroNome"); ?>: 
            </span>
			<?php echo DbFuncoes::GetCampoGenerico01($idTbCadastro, "tb_cadastro", "nome"); ?> 
        </div>
    </div>
    <?php //**************************************************************************************?>
    
    
	<?php //Informações - Turma.?>
    <?php //**************************************************************************************?>
    <?php if($idTbTurmas <> ""){?>
    	<?php
		//Query de pesquisa.
		//----------
		$strSqlTurmasDetalhesSelect = "";
		$strSqlTurmasDetalhesSelect .= "SELECT ";
		//$strSqlTurmasDetalhesSelect .= "* ";
		$strSqlTurmasDetalhesSelect .= "id, ";
		$strSqlTurmasDetalhesSelect .= "id_parent, ";
		$strSqlTurmasDetalhesSelect .= "id_tb_cadastro1, ";
		$strSqlTurmasDetalhesSelect .= "id_tb_cadastro2, ";
		$strSqlTurmasDetalhesSelect .= "id_tb_cadastro3, ";
		$strSqlTurmasDetalhesSelect .= "id_tb_cadastro4, ";
		$strSqlTurmasDetalhesSelect .= "id_tb_cadastro5, ";
		$strSqlTurmasDetalhesSelect .= "n_classificacao, ";
		$strSqlTurmasDetalhesSelect .= "data_criacao, ";
		$strSqlTurmasDetalhesSelect .= "data_inicio, ";
		$strSqlTurmasDetalhesSelect .= "data_final, ";
		$strSqlTurmasDetalhesSelect .= "data1, ";
		$strSqlTurmasDetalhesSelect .= "data2, ";
		$strSqlTurmasDetalhesSelect .= "data3, ";
		$strSqlTurmasDetalhesSelect .= "data4, ";
		$strSqlTurmasDetalhesSelect .= "data5, ";
		$strSqlTurmasDetalhesSelect .= "data6, ";
		$strSqlTurmasDetalhesSelect .= "data7, ";
		$strSqlTurmasDetalhesSelect .= "data8, ";
		$strSqlTurmasDetalhesSelect .= "data9, ";
		$strSqlTurmasDetalhesSelect .= "data10, ";
		$strSqlTurmasDetalhesSelect .= "nome_turma, ";
		$strSqlTurmasDetalhesSelect .= "cod_turma, ";
		$strSqlTurmasDetalhesSelect .= "descricao, ";
		$strSqlTurmasDetalhesSelect .= "id_tb_turmas_status, ";
		$strSqlTurmasDetalhesSelect .= "palavras_chave, ";
		$strSqlTurmasDetalhesSelect .= "valor, ";
		$strSqlTurmasDetalhesSelect .= "valor1, ";
		$strSqlTurmasDetalhesSelect .= "valor2, ";
		$strSqlTurmasDetalhesSelect .= "valor3, ";
		$strSqlTurmasDetalhesSelect .= "valor4, ";
		$strSqlTurmasDetalhesSelect .= "valor5, ";
		$strSqlTurmasDetalhesSelect .= "url1, ";
		$strSqlTurmasDetalhesSelect .= "url2, ";
		$strSqlTurmasDetalhesSelect .= "url3, ";
		$strSqlTurmasDetalhesSelect .= "url4, ";
		$strSqlTurmasDetalhesSelect .= "url5, ";
		$strSqlTurmasDetalhesSelect .= "informacao_complementar1, ";
		$strSqlTurmasDetalhesSelect .= "informacao_complementar2, ";
		$strSqlTurmasDetalhesSelect .= "informacao_complementar3, ";
		$strSqlTurmasDetalhesSelect .= "informacao_complementar4, ";
		$strSqlTurmasDetalhesSelect .= "informacao_complementar5, ";
		$strSqlTurmasDetalhesSelect .= "informacao_complementar6, ";
		$strSqlTurmasDetalhesSelect .= "informacao_complementar7, ";
		$strSqlTurmasDetalhesSelect .= "informacao_complementar8, ";
		$strSqlTurmasDetalhesSelect .= "informacao_complementar9, ";
		$strSqlTurmasDetalhesSelect .= "informacao_complementar10, ";
		$strSqlTurmasDetalhesSelect .= "informacao_complementar11, ";
		$strSqlTurmasDetalhesSelect .= "informacao_complementar12, ";
		$strSqlTurmasDetalhesSelect .= "informacao_complementar13, ";
		$strSqlTurmasDetalhesSelect .= "informacao_complementar14, ";
		$strSqlTurmasDetalhesSelect .= "informacao_complementar15, ";
		$strSqlTurmasDetalhesSelect .= "informacao_complementar16, ";
		$strSqlTurmasDetalhesSelect .= "informacao_complementar17, ";
		$strSqlTurmasDetalhesSelect .= "informacao_complementar18, ";
		$strSqlTurmasDetalhesSelect .= "informacao_complementar19, ";
		$strSqlTurmasDetalhesSelect .= "informacao_complementar20, ";
		$strSqlTurmasDetalhesSelect .= "informacao_complementar21, ";
		$strSqlTurmasDetalhesSelect .= "informacao_complementar22, ";
		$strSqlTurmasDetalhesSelect .= "informacao_complementar23, ";
		$strSqlTurmasDetalhesSelect .= "informacao_complementar24, ";
		$strSqlTurmasDetalhesSelect .= "informacao_complementar25, ";
		$strSqlTurmasDetalhesSelect .= "informacao_complementar26, ";
		$strSqlTurmasDetalhesSelect .= "informacao_complementar27, ";
		$strSqlTurmasDetalhesSelect .= "informacao_complementar28, ";
		$strSqlTurmasDetalhesSelect .= "informacao_complementar29, ";
		$strSqlTurmasDetalhesSelect .= "informacao_complementar30, ";
		$strSqlTurmasDetalhesSelect .= "informacao_complementar31, ";
		$strSqlTurmasDetalhesSelect .= "informacao_complementar32, ";
		$strSqlTurmasDetalhesSelect .= "informacao_complementar33, ";
		$strSqlTurmasDetalhesSelect .= "informacao_complementar34, ";
		$strSqlTurmasDetalhesSelect .= "informacao_complementar35, ";
		$strSqlTurmasDetalhesSelect .= "informacao_complementar36, ";
		$strSqlTurmasDetalhesSelect .= "informacao_complementar37, ";
		$strSqlTurmasDetalhesSelect .= "informacao_complementar38, ";
		$strSqlTurmasDetalhesSelect .= "informacao_complementar39, ";
		$strSqlTurmasDetalhesSelect .= "informacao_complementar40, ";
		$strSqlTurmasDetalhesSelect .= "informacao_complementar41, ";
		$strSqlTurmasDetalhesSelect .= "informacao_complementar42, ";
		$strSqlTurmasDetalhesSelect .= "informacao_complementar43, ";
		$strSqlTurmasDetalhesSelect .= "informacao_complementar44, ";
		$strSqlTurmasDetalhesSelect .= "informacao_complementar45, ";
		$strSqlTurmasDetalhesSelect .= "informacao_complementar46, ";
		$strSqlTurmasDetalhesSelect .= "informacao_complementar47, ";
		$strSqlTurmasDetalhesSelect .= "informacao_complementar48, ";
		$strSqlTurmasDetalhesSelect .= "informacao_complementar49, ";
		$strSqlTurmasDetalhesSelect .= "informacao_complementar50, ";
		$strSqlTurmasDetalhesSelect .= "informacao_complementar51, ";
		$strSqlTurmasDetalhesSelect .= "informacao_complementar52, ";
		$strSqlTurmasDetalhesSelect .= "informacao_complementar53, ";
		$strSqlTurmasDetalhesSelect .= "informacao_complementar54, ";
		$strSqlTurmasDetalhesSelect .= "informacao_complementar55, ";
		$strSqlTurmasDetalhesSelect .= "informacao_complementar56, ";
		$strSqlTurmasDetalhesSelect .= "informacao_complementar57, ";
		$strSqlTurmasDetalhesSelect .= "informacao_complementar58, ";
		$strSqlTurmasDetalhesSelect .= "informacao_complementar59, ";
		$strSqlTurmasDetalhesSelect .= "informacao_complementar60, ";
		$strSqlTurmasDetalhesSelect .= "ativacao, ";
		$strSqlTurmasDetalhesSelect .= "ativacao1, ";
		$strSqlTurmasDetalhesSelect .= "ativacao2, ";
		$strSqlTurmasDetalhesSelect .= "ativacao3, ";
		$strSqlTurmasDetalhesSelect .= "ativacao4, ";
		$strSqlTurmasDetalhesSelect .= "anotacoes_internas, ";
		$strSqlTurmasDetalhesSelect .= "n_visitas, ";
		$strSqlTurmasDetalhesSelect .= "acesso_restrito ";
		$strSqlTurmasDetalhesSelect .= "FROM tb_turmas ";
		$strSqlTurmasDetalhesSelect .= "WHERE id <> 0 ";
		//$strSqlTurmasDetalhesSelect .= "AND id_tb_categorias = :id_tb_categorias ";
		$strSqlTurmasDetalhesSelect .= "AND id = :id ";
		//$strSqlTurmasDetalhesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
		
		
		$statementTurmasDetalhesSelect = $dbSistemaConPDO->prepare($strSqlTurmasDetalhesSelect);
		
		if ($statementTurmasDetalhesSelect !== false)
		{
			$statementTurmasDetalhesSelect->execute(array(
				"id" => $idTbTurmas
			));
		}
		
		//$resultadoTurmasDetalhes = $dbSistemaConPDO->query($strSqlTurmasDetalhesSelect);
		
		$resultadoTurmasDetalhes = $statementTurmasDetalhesSelect->fetchAll();
		
		if (empty($resultadoTurmasDetalhes))
		{
			//echo "Nenhum registro encontrado";
		}else{
			foreach($resultadoTurmasDetalhes as $linhaTurmasDetalhes)
			{
				//Definição das variáveis de detalhes.
				$tbTurmasId = $linhaTurmasDetalhes['id'];
				$tbTurmasIdParent = $linhaTurmasDetalhes['id_parent'];
				
				$tbTurmasIdTbCadastro1 = $linhaTurmasDetalhes['id_tb_cadastro1'];
				$tbTurmasIdTbCadastro2 = $linhaTurmasDetalhes['id_tb_cadastro2'];
				$tbTurmasIdTbCadastro3 = $linhaTurmasDetalhes['id_tb_cadastro3'];
				$tbTurmasIdTbCadastro4 = $linhaTurmasDetalhes['id_tb_cadastro4'];
				$tbTurmasIdTbCadastro5 = $linhaTurmasDetalhes['id_tb_cadastro5'];
				
				$tbTurmasNClassificacao = $linhaTurmasDetalhes['n_classificacao'];
				
				$tbTurmasDataCriacao = Funcoes::DataLeitura01($linhaTurmasDetalhes['data_criacao'], $GLOBALS['configSistemaFormatoData'], "1");
				//$tbTurmasDataAbertura = Funcoes::DataLeitura01($linhaTurmasDetalhes['data_abertura'], $GLOBALS['configSistemaFormatoData'], "1");
				if($linhaTurmasDetalhes['data_inicio'] == NULL)
				{
					$tbTurmasDataInicio = "";
				}else{
					$tbTurmasDataInicio = Funcoes::DataLeitura01($linhaTurmasDetalhes['data_inicio'], $GLOBALS['configSistemaFormatoData'], "1");
				}
				
				if($linhaTurmasDetalhes['data_final'] == NULL)
				{
					$tbTurmasDataFinal = "";
				}else{
					$tbTurmasDataFinal = Funcoes::DataLeitura01($linhaTurmasDetalhes['data_final'], $GLOBALS['configSistemaFormatoData'], "1");
				}
		
				if($linhaTurmasDetalhes['data1'] == NULL)
				{
					$tbTurmasData1 = "";
				}else{
					$tbTurmasData1 = Funcoes::DataLeitura01($linhaTurmasDetalhes['data1'], $GLOBALS['configSistemaFormatoData'], "1");
				}
				if($linhaTurmasDetalhes['data2'] == NULL)
				{
					$tbTurmasData2 = "";
				}else{
					$tbTurmasData2 = Funcoes::DataLeitura01($linhaTurmasDetalhes['data2'], $GLOBALS['configSistemaFormatoData'], "1");
				}
				if($linhaTurmasDetalhes['data3'] == NULL)
				{
					$tbTurmasData3 = "";
				}else{
					$tbTurmasData3 = Funcoes::DataLeitura01($linhaTurmasDetalhes['data3'], $GLOBALS['configSistemaFormatoData'], "1");
				}
				if($linhaTurmasDetalhes['data4'] == NULL)
				{
					$tbTurmasData4 = "";
				}else{
					$tbTurmasData4 = Funcoes::DataLeitura01($linhaTurmasDetalhes['data4'], $GLOBALS['configSistemaFormatoData'], "1");
				}
				if($linhaTurmasDetalhes['data5'] == NULL)
				{
					$tbTurmasData5 = "";
				}else{
					$tbTurmasData5 = Funcoes::DataLeitura01($linhaTurmasDetalhes['data5'], $GLOBALS['configSistemaFormatoData'], "1");
				}
				if($linhaTurmasDetalhes['data6'] == NULL)
				{
					$tbTurmasData6 = "";
				}else{
					$tbTurmasData6 = Funcoes::DataLeitura01($linhaTurmasDetalhes['data6'], $GLOBALS['configSistemaFormatoData'], "1");
				}
				if($linhaTurmasDetalhes['data7'] == NULL)
				{
					$tbTurmasData7 = "";
				}else{
					$tbTurmasData7 = Funcoes::DataLeitura01($linhaTurmasDetalhes['data7'], $GLOBALS['configSistemaFormatoData'], "1");
				}
				if($linhaTurmasDetalhes['data8'] == NULL)
				{
					$tbTurmasData8 = "";
				}else{
					$tbTurmasData8 = Funcoes::DataLeitura01($linhaTurmasDetalhes['data8'], $GLOBALS['configSistemaFormatoData'], "1");
				}
				if($linhaTurmasDetalhes['data9'] == NULL)
				{
					$tbTurmasData9 = "";
				}else{
					$tbTurmasData9 = Funcoes::DataLeitura01($linhaTurmasDetalhes['data9'], $GLOBALS['configSistemaFormatoData'], "1");
				}
				if($linhaTurmasDetalhes['data10'] == NULL)
				{
					$tbTurmasData10 = "";
				}else{
					$tbTurmasData10 = Funcoes::DataLeitura01($linhaTurmasDetalhes['data10'], $GLOBALS['configSistemaFormatoData'], "1");
				}
		
				$tbTurmasNomeTurma = Funcoes::ConteudoMascaraLeitura($linhaTurmasDetalhes['nome_turma']);
				$tbTurmasCodTurma = Funcoes::ConteudoMascaraLeitura($linhaTurmasDetalhes['cod_turma']);
				$tbTurmasDescricao = Funcoes::ConteudoMascaraLeitura($linhaTurmasDetalhes['descricao']);
		
				$tbTurmasIdTbTurmasStatus = $linhaTurmasDetalhes['id_tb_turmas_status'];
				$tbTurmasPalavrasChave = Funcoes::ConteudoMascaraLeitura($linhaTurmasDetalhes['palavras_chave']);
				
				$tbTurmasValor = Funcoes::MascaraValorLer($linhaTurmasDetalhes['valor'], $GLOBALS['configSistemaMoeda']);
				$tbTurmasValor1 = Funcoes::MascaraValorLer($linhaTurmasDetalhes['valor1'], $GLOBALS['configSistemaMoeda']);
				$tbTurmasValor2 = Funcoes::MascaraValorLer($linhaTurmasDetalhes['valor2'], $GLOBALS['configSistemaMoeda']);
				$tbTurmasValor3 = Funcoes::MascaraValorLer($linhaTurmasDetalhes['valor3'], $GLOBALS['configSistemaMoeda']);
				$tbTurmasValor4 = Funcoes::MascaraValorLer($linhaTurmasDetalhes['valor4'], $GLOBALS['configSistemaMoeda']);
				$tbTurmasValor5 = Funcoes::MascaraValorLer($linhaTurmasDetalhes['valor5'], $GLOBALS['configSistemaMoeda']);
				$tbTurmasURL1 = $linhaTurmasDetalhes['url1'];
				$tbTurmasURL2 = $linhaTurmasDetalhes['url2'];
				$tbTurmasURL3 = $linhaTurmasDetalhes['url3'];
				$tbTurmasURL4 = $linhaTurmasDetalhes['url4'];
				$tbTurmasURL5 = $linhaTurmasDetalhes['url5'];
		
				$tbTurmasIC1 = Funcoes::ConteudoMascaraLeitura($linhaTurmasDetalhes['informacao_complementar1']);
				$tbTurmasIC2 = Funcoes::ConteudoMascaraLeitura($linhaTurmasDetalhes['informacao_complementar2']);
				$tbTurmasIC3 = Funcoes::ConteudoMascaraLeitura($linhaTurmasDetalhes['informacao_complementar3']);
				$tbTurmasIC4 = Funcoes::ConteudoMascaraLeitura($linhaTurmasDetalhes['informacao_complementar4']);
				$tbTurmasIC5 = Funcoes::ConteudoMascaraLeitura($linhaTurmasDetalhes['informacao_complementar5']);
				$tbTurmasIC6 = Funcoes::ConteudoMascaraLeitura($linhaTurmasDetalhes['informacao_complementar6']);
				$tbTurmasIC7 = Funcoes::ConteudoMascaraLeitura($linhaTurmasDetalhes['informacao_complementar7']);
				$tbTurmasIC8 = Funcoes::ConteudoMascaraLeitura($linhaTurmasDetalhes['informacao_complementar8']);
				$tbTurmasIC9 = Funcoes::ConteudoMascaraLeitura($linhaTurmasDetalhes['informacao_complementar9']);
				$tbTurmasIC10 = Funcoes::ConteudoMascaraLeitura($linhaTurmasDetalhes['informacao_complementar10']);
				$tbTurmasIC11 = Funcoes::ConteudoMascaraLeitura($linhaTurmasDetalhes['informacao_complementar11']);
				$tbTurmasIC12 = Funcoes::ConteudoMascaraLeitura($linhaTurmasDetalhes['informacao_complementar12']);
				$tbTurmasIC13 = Funcoes::ConteudoMascaraLeitura($linhaTurmasDetalhes['informacao_complementar13']);
				$tbTurmasIC14 = Funcoes::ConteudoMascaraLeitura($linhaTurmasDetalhes['informacao_complementar14']);
				$tbTurmasIC15 = Funcoes::ConteudoMascaraLeitura($linhaTurmasDetalhes['informacao_complementar15']);
				$tbTurmasIC16 = Funcoes::ConteudoMascaraLeitura($linhaTurmasDetalhes['informacao_complementar16']);
				$tbTurmasIC17 = Funcoes::ConteudoMascaraLeitura($linhaTurmasDetalhes['informacao_complementar17']);
				$tbTurmasIC18 = Funcoes::ConteudoMascaraLeitura($linhaTurmasDetalhes['informacao_complementar18']);
				$tbTurmasIC19 = Funcoes::ConteudoMascaraLeitura($linhaTurmasDetalhes['informacao_complementar19']);
				$tbTurmasIC20 = Funcoes::ConteudoMascaraLeitura($linhaTurmasDetalhes['informacao_complementar20']);
				$tbTurmasIC21 = Funcoes::ConteudoMascaraLeitura($linhaTurmasDetalhes['informacao_complementar21']);
				$tbTurmasIC22 = Funcoes::ConteudoMascaraLeitura($linhaTurmasDetalhes['informacao_complementar22']);
				$tbTurmasIC23 = Funcoes::ConteudoMascaraLeitura($linhaTurmasDetalhes['informacao_complementar23']);
				$tbTurmasIC24 = Funcoes::ConteudoMascaraLeitura($linhaTurmasDetalhes['informacao_complementar24']);
				$tbTurmasIC25 = Funcoes::ConteudoMascaraLeitura($linhaTurmasDetalhes['informacao_complementar25']);
				$tbTurmasIC26 = Funcoes::ConteudoMascaraLeitura($linhaTurmasDetalhes['informacao_complementar26']);
				$tbTurmasIC27 = Funcoes::ConteudoMascaraLeitura($linhaTurmasDetalhes['informacao_complementar27']);
				$tbTurmasIC28 = Funcoes::ConteudoMascaraLeitura($linhaTurmasDetalhes['informacao_complementar28']);
				$tbTurmasIC29 = Funcoes::ConteudoMascaraLeitura($linhaTurmasDetalhes['informacao_complementar29']);
				$tbTurmasIC30 = Funcoes::ConteudoMascaraLeitura($linhaTurmasDetalhes['informacao_complementar30']);
				$tbTurmasIC31 = Funcoes::ConteudoMascaraLeitura($linhaTurmasDetalhes['informacao_complementar31']);
				$tbTurmasIC32 = Funcoes::ConteudoMascaraLeitura($linhaTurmasDetalhes['informacao_complementar32']);
				$tbTurmasIC33 = Funcoes::ConteudoMascaraLeitura($linhaTurmasDetalhes['informacao_complementar33']);
				$tbTurmasIC34 = Funcoes::ConteudoMascaraLeitura($linhaTurmasDetalhes['informacao_complementar34']);
				$tbTurmasIC35 = Funcoes::ConteudoMascaraLeitura($linhaTurmasDetalhes['informacao_complementar35']);
				$tbTurmasIC36 = Funcoes::ConteudoMascaraLeitura($linhaTurmasDetalhes['informacao_complementar36']);
				$tbTurmasIC37 = Funcoes::ConteudoMascaraLeitura($linhaTurmasDetalhes['informacao_complementar37']);
				$tbTurmasIC38 = Funcoes::ConteudoMascaraLeitura($linhaTurmasDetalhes['informacao_complementar38']);
				$tbTurmasIC39 = Funcoes::ConteudoMascaraLeitura($linhaTurmasDetalhes['informacao_complementar39']);
				$tbTurmasIC40 = Funcoes::ConteudoMascaraLeitura($linhaTurmasDetalhes['informacao_complementar40']);
				$tbTurmasIC41 = Funcoes::ConteudoMascaraLeitura($linhaTurmasDetalhes['informacao_complementar41']);
				$tbTurmasIC42 = Funcoes::ConteudoMascaraLeitura($linhaTurmasDetalhes['informacao_complementar42']);
				$tbTurmasIC43 = Funcoes::ConteudoMascaraLeitura($linhaTurmasDetalhes['informacao_complementar43']);
				$tbTurmasIC44 = Funcoes::ConteudoMascaraLeitura($linhaTurmasDetalhes['informacao_complementar44']);
				$tbTurmasIC45 = Funcoes::ConteudoMascaraLeitura($linhaTurmasDetalhes['informacao_complementar45']);
				$tbTurmasIC46 = Funcoes::ConteudoMascaraLeitura($linhaTurmasDetalhes['informacao_complementar46']);
				$tbTurmasIC47 = Funcoes::ConteudoMascaraLeitura($linhaTurmasDetalhes['informacao_complementar47']);
				$tbTurmasIC48 = Funcoes::ConteudoMascaraLeitura($linhaTurmasDetalhes['informacao_complementar48']);
				$tbTurmasIC49 = Funcoes::ConteudoMascaraLeitura($linhaTurmasDetalhes['informacao_complementar49']);
				$tbTurmasIC50 = Funcoes::ConteudoMascaraLeitura($linhaTurmasDetalhes['informacao_complementar50']);
				$tbTurmasIC51 = Funcoes::ConteudoMascaraLeitura($linhaTurmasDetalhes['informacao_complementar51']);
				$tbTurmasIC52 = Funcoes::ConteudoMascaraLeitura($linhaTurmasDetalhes['informacao_complementar52']);
				$tbTurmasIC53 = Funcoes::ConteudoMascaraLeitura($linhaTurmasDetalhes['informacao_complementar53']);
				$tbTurmasIC54 = Funcoes::ConteudoMascaraLeitura($linhaTurmasDetalhes['informacao_complementar54']);
				$tbTurmasIC55 = Funcoes::ConteudoMascaraLeitura($linhaTurmasDetalhes['informacao_complementar55']);
				$tbTurmasIC56 = Funcoes::ConteudoMascaraLeitura($linhaTurmasDetalhes['informacao_complementar56']);
				$tbTurmasIC57 = Funcoes::ConteudoMascaraLeitura($linhaTurmasDetalhes['informacao_complementar57']);
				$tbTurmasIC58 = Funcoes::ConteudoMascaraLeitura($linhaTurmasDetalhes['informacao_complementar58']);
				$tbTurmasIC59 = Funcoes::ConteudoMascaraLeitura($linhaTurmasDetalhes['informacao_complementar59']);
				$tbTurmasIC60 = Funcoes::ConteudoMascaraLeitura($linhaTurmasDetalhes['informacao_complementar60']);
				
				$tbTurmasAtivacao = $linhaTurmasDetalhes['ativacao'];
				$tbTurmasAtivacao1 = $linhaTurmasDetalhes['ativacao1'];
				$tbTurmasAtivacao2 = $linhaTurmasDetalhes['ativacao2'];
				$tbTurmasAtivacao3 = $linhaTurmasDetalhes['ativacao3'];
				$tbTurmasAtivacao4 = $linhaTurmasDetalhes['ativacao4'];
				
				$tbTurmasAnotacoesInternas = Funcoes::ConteudoMascaraLeitura($linhaTurmasDetalhes['anotacoes_internas']);
				$tbTurmasNVisitas = $linhaTurmasDetalhes['n_visitas'];
				$tbTurmasAcessoRestrito = $linhaTurmasDetalhes['acesso_restrito'];
				
				//Verificação de erro.
				//echo "tbTurmasId=" . $tbTurmasId . "<br>";
				//echo "tbTurmasProcesso=" . $tbTurmasProcesso . "<br>";
				//echo "tbTurmasIC60=" . $tbTurmasIC60 . "<br>";
			}
		}
		?>
        
        <?php if(!empty($resultadoTurmasDetalhes)){?>
            <div class="AdmTexto01" style="position: relative; display: block;">
                <div style="position: relative; display: block;">
                    <span style="font-weight: bold;">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteTurmasNome"); ?>: 
                    </span>
                    <?php //echo DbFuncoes::GetCampoGenerico01($idTbTurmas, "tb_turmas", "nome_turma"); ?>
                    <?php echo $tbTurmasNomeTurma; ?>
                </div>
                
                <?php if($GLOBALS['habilitarTurmasVinculo1'] == 1){ ?>
                    <div style="position: relative; display: block;">
                        <span style="font-weight: bold;">
                            <?php echo htmlentities($GLOBALS['configTurmasVinculo1Nome']); ?>: 
                        </span>
                        <?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($tbTurmasIdTbCadastro1, "tb_cadastro", "nome"), 
                        DbFuncoes::GetCampoGenerico01($tbTurmasIdTbCadastro1, "tb_cadastro", "razao_social"), 
                        DbFuncoes::GetCampoGenerico01($tbTurmasIdTbCadastro1, "tb_cadastro", "nome_fantasia"), 
                        1)); ?>
                    </div>        
                <?php } ?>
                
				<?php 
                //echo DbFuncoes::GetCampoGenerico01($tbTurmasIdTbCadastro1, "tb_cadastro", "logo"); 
                $tbTurmasIdTbCadastro1Logo = DbFuncoes::GetCampoGenerico01($tbTurmasIdTbCadastro1, "tb_cadastro", "logo");
                ?>
                <?php if($tbTurmasIdTbCadastro1Logo <> ""){ ?>
                    <div style="position: relative; display: block;">
						<?php //Sem pop-up. ?>
                        <?php //if($GLOBALS['configImagemPopUp'] == 0){ ?>
                            <img src="../<?php echo $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos'];?>/<?php echo $tbTurmasIdTbCadastro1Logo;?>" alt="<?php echo $tbTurmasIdTbCadastro1Logo; ?>" />
                        <?php //} ?>
                    </div>
                <?php } ?>

                
                <?php if($GLOBALS['habilitarTurmasVinculo2'] == 1){ ?>
                    <div style="position: relative; display: block;">
                        <span style="font-weight: bold;">
                            <?php echo htmlentities($GLOBALS['configTurmasVinculo2Nome']); ?>: 
                        </span>
                        <?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($tbTurmasIdTbCadastro2, "tb_cadastro", "nome"), 
                        DbFuncoes::GetCampoGenerico01($tbTurmasIdTbCadastro2, "tb_cadastro", "razao_social"), 
                        DbFuncoes::GetCampoGenerico01($tbTurmasIdTbCadastro2, "tb_cadastro", "nome_fantasia"), 
                        1)); ?>
                    </div>        
                <?php } ?>
        
                <?php if($GLOBALS['habilitarTurmasVinculo3'] == 1){ ?>
                    <div style="position: relative; display: block;">
                        <span style="font-weight: bold;">
                            <?php echo htmlentities($GLOBALS['configTurmasVinculo3Nome']); ?>: 
                        </span>
                        <?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($tbTurmasIdTbCadastro3, "tb_cadastro", "nome"), 
                        DbFuncoes::GetCampoGenerico01($tbTurmasIdTbCadastro3, "tb_cadastro", "razao_social"), 
                        DbFuncoes::GetCampoGenerico01($tbTurmasIdTbCadastro3, "tb_cadastro", "nome_fantasia"), 
                        1)); ?>
                    </div>        
                <?php } ?>
        
                <?php if($GLOBALS['habilitarTurmasVinculo4'] == 1){ ?>
                    <div style="position: relative; display: block;">
                        <span style="font-weight: bold;">
                            <?php echo htmlentities($GLOBALS['configTurmasVinculo4Nome']); ?>: 
                        </span>
                        <?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($tbTurmasIdTbCadastro4, "tb_cadastro", "nome"), 
                        DbFuncoes::GetCampoGenerico01($tbTurmasIdTbCadastro4, "tb_cadastro", "razao_social"), 
                        DbFuncoes::GetCampoGenerico01($tbTurmasIdTbCadastro4, "tb_cadastro", "nome_fantasia"), 
                        1)); ?>
                    </div>        
                <?php } ?>
        
                <?php if($GLOBALS['habilitarTurmasVinculo5'] == 1){ ?>
                    <div style="position: relative; display: block;">
                        <span style="font-weight: bold;">
                            <?php echo htmlentities($GLOBALS['configTurmasVinculo5Nome']); ?>: 
                        </span>
                        <?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($tbTurmasIdTbCadastro5, "tb_cadastro", "nome"), 
                        DbFuncoes::GetCampoGenerico01($tbTurmasIdTbCadastro5, "tb_cadastro", "razao_social"), 
                        DbFuncoes::GetCampoGenerico01($tbTurmasIdTbCadastro5, "tb_cadastro", "nome_fantasia"), 
                        1)); ?>
                    </div>        
                <?php } ?>
                
                
                <?php if($GLOBALS['habilitarTurmasFiltroGenerico01'] == 1){ ?>
                    <div style="position: relative; display: block;">
                        <span style="font-weight: bold;">
                            <?php echo htmlentities($GLOBALS['configTurmasFiltroGenerico01Nome']); ?>: 
                        </span>
						<?php 
                        $arrTurmasFiltroGenerico01Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbTurmasId, "tb_turmas_relacao_complemento", "id_tb_turmas", "id_tb_turmas_complemento", "12", "", ",", "", "1"));
                        $arrTurmasFiltroGenerico01 = DbFuncoes::FiltrosGenericosFill01("tb_turmas_complemento", 12);
						$tbTurmasFiltroGenerico01_print = "";
                        ?>
                        <?php 
                        for($countArray = 0; $countArray < count($arrTurmasFiltroGenerico01); $countArray++)
                        {
                        ?>
                            <div>
                                <?php if(in_array($arrTurmasFiltroGenerico01[$countArray][0], $arrTurmasFiltroGenerico01Selecao)){ ?> 
                                    - <?php echo $arrTurmasFiltroGenerico01[$countArray][1];?>
                                    <?php //Armazenamento dos valores em variável. ?>
									<?php
									$tbTurmasFiltroGenerico01_print = $tbTurmasFiltroGenerico01_print . $arrTurmasFiltroGenerico01[$countArray][1] . ", ";
									?>
                                <?php } ?>
                            </div>
                        <?php 
                        }
                        ?>
                        
                        <?php 
						//Tratamento de dados (retirada do espaço e vírgula no fina do texto).
						if($tbTurmasFiltroGenerico01_print <> "")
						{
							$tbTurmasFiltroGenerico01_print = substr($tbTurmasFiltroGenerico01_print, 0, strlen($tbTurmasFiltroGenerico01_print) - 2);
						}
						
						echo Funcoes::IdsFormatar01($tbTurmasFiltroGenerico01_print); 
						?>
                    </div>
				<?php } ?>   
                
                <?php if($GLOBALS['habilitarTurmasIc1'] == 1){ ?>
                    <div style="position: relative; display: block;">
                        <span style="font-weight: bold;">
                            <?php echo htmlentities($GLOBALS['configTituloTurmasIc1']); ?>: 
                        </span>
                        <?php echo $tbTurmasIC1; ?>
                    </div>        
				 <?php } ?>
                 
                <?php if($GLOBALS['habilitarTurmasIc2'] == 1){ ?>
                    <div style="position: relative; display: block;">
                        <span style="font-weight: bold;">
                            <?php echo htmlentities($GLOBALS['configTituloTurmasIc2']); ?>: 
                        </span>
                        <?php echo $tbTurmasIC2; ?>
                    </div>        
				 <?php } ?>

                <?php if($GLOBALS['habilitarTurmasIc3'] == 1){ ?>
                    <div style="position: relative; display: block;">
                        <span style="font-weight: bold;">
                            <?php echo htmlentities($GLOBALS['configTituloTurmasIc3']); ?>: 
                        </span>
                        <?php echo $tbTurmasIC3; ?>
                    </div>        
				 <?php } ?>

                <?php if($GLOBALS['habilitarTurmasIc4'] == 1){ ?>
                    <div style="position: relative; display: block;">
                        <span style="font-weight: bold;">
                            <?php echo htmlentities($GLOBALS['configTituloTurmasIc4']); ?>: 
                        </span>
                        <?php echo $tbTurmasIC4; ?>
                    </div>        
				 <?php } ?>

                <?php if($GLOBALS['habilitarTurmasIc5'] == 1){ ?>
                    <div style="position: relative; display: block;">
                        <span style="font-weight: bold;">
                            <?php echo htmlentities($GLOBALS['configTituloTurmasIc5']); ?>: 
                        </span>
                        <?php echo $tbTurmasIC5; ?>
                    </div>        
				 <?php } ?>

                <?php if($GLOBALS['habilitarTurmasIc6'] == 1){ ?>
                    <div style="position: relative; display: block;">
                        <span style="font-weight: bold;">
                            <?php echo htmlentities($GLOBALS['configTituloTurmasIc6']); ?>: 
                        </span>
                        <?php echo $tbTurmasIC6; ?>
                    </div>        
				 <?php } ?>

                <?php if($GLOBALS['habilitarTurmasIc7'] == 1){ ?>
                    <div style="position: relative; display: block;">
                        <span style="font-weight: bold;">
                            <?php echo htmlentities($GLOBALS['configTituloTurmasIc7']); ?>: 
                        </span>
                        <?php echo $tbTurmasIC7; ?>
                    </div>        
				 <?php } ?>

                <?php if($GLOBALS['habilitarTurmasIc8'] == 1){ ?>
                    <div style="position: relative; display: block;">
                        <span style="font-weight: bold;">
                            <?php echo htmlentities($GLOBALS['configTituloTurmasIc8']); ?>: 
                        </span>
                        <?php echo $tbTurmasIC8; ?>
                    </div>        
				 <?php } ?>

                <?php if($GLOBALS['habilitarTurmasIc9'] == 1){ ?>
                    <div style="position: relative; display: block;">
                        <span style="font-weight: bold;">
                            <?php echo htmlentities($GLOBALS['configTituloTurmasIc9']); ?>: 
                        </span>
                        <?php echo $tbTurmasIC9; ?>
                    </div>        
				 <?php } ?>

                <?php if($GLOBALS['habilitarTurmasIc10'] == 1){ ?>
                    <div style="position: relative; display: block;">
                        <span style="font-weight: bold;">
                            <?php echo htmlentities($GLOBALS['configTituloTurmasIc10']); ?>: 
                        </span>
                        <?php echo $tbTurmasIC10; ?>
                    </div>        
				 <?php } ?>
            </div>
		<?php } ?>
        <?php
		//Limpeza de objetos.
		//----------
		unset($strSqlTurmasDetalhesSelect);
		unset($statementTurmasDetalhesSelect);
		unset($resultadoTurmasDetalhes);
		unset($linhaTurmasDetalhes);
		//----------
		?>		
	<?php } ?>
    <?php //**************************************************************************************?>
    
    
	<?php //Informações - Módulo.?>
    <?php //**************************************************************************************?>
    <?php
	//$idTbModulos = DbFuncoes::GetCampoGenerico01($idTbTurmas, "tb_modulos", "id_parent");
	$idTbModulos = DbFuncoes::GetCampoGenerico04("tb_modulos", "id", "id_parent", $idTbTurmas, "", "", 2);
	?>
    <?php if($idTbModulos <> ""){ ?>
		<?php
        //Query de pesquisa.
        //----------
        $strSqlModulosDetalhesSelect = "";
        $strSqlModulosDetalhesSelect .= "SELECT ";
        //$strSqlModulosDetalhesSelect .= "* ";
        $strSqlModulosDetalhesSelect .= "id, ";
        $strSqlModulosDetalhesSelect .= "id_parent, ";
        $strSqlModulosDetalhesSelect .= "id_tb_cadastro_usuario, ";
        $strSqlModulosDetalhesSelect .= "id_tb_cadastro1, ";
        $strSqlModulosDetalhesSelect .= "id_tb_cadastro2, ";
        $strSqlModulosDetalhesSelect .= "id_tb_cadastro3, ";
        $strSqlModulosDetalhesSelect .= "id_tb_cadastro4, ";
        $strSqlModulosDetalhesSelect .= "id_tb_cadastro5, ";
        $strSqlModulosDetalhesSelect .= "n_classificacao, ";
        $strSqlModulosDetalhesSelect .= "data_criacao, ";
        $strSqlModulosDetalhesSelect .= "data_inicio, ";
        $strSqlModulosDetalhesSelect .= "data_final, ";
        $strSqlModulosDetalhesSelect .= "data1, ";
        $strSqlModulosDetalhesSelect .= "data2, ";
        $strSqlModulosDetalhesSelect .= "data3, ";
        $strSqlModulosDetalhesSelect .= "data4, ";
        $strSqlModulosDetalhesSelect .= "data5, ";
        $strSqlModulosDetalhesSelect .= "data6, ";
        $strSqlModulosDetalhesSelect .= "data7, ";
        $strSqlModulosDetalhesSelect .= "data8, ";
        $strSqlModulosDetalhesSelect .= "data9, ";
        $strSqlModulosDetalhesSelect .= "data10, ";
        $strSqlModulosDetalhesSelect .= "nome_modulo, ";
        $strSqlModulosDetalhesSelect .= "descricao, ";
        $strSqlModulosDetalhesSelect .= "id_tb_modulos_status, ";
        $strSqlModulosDetalhesSelect .= "palavras_chave, ";
        $strSqlModulosDetalhesSelect .= "valor, ";
        $strSqlModulosDetalhesSelect .= "valor1, ";
        $strSqlModulosDetalhesSelect .= "valor2, ";
        $strSqlModulosDetalhesSelect .= "valor3, ";
        $strSqlModulosDetalhesSelect .= "valor4, ";
        $strSqlModulosDetalhesSelect .= "valor5, ";
        $strSqlModulosDetalhesSelect .= "url1, ";
        $strSqlModulosDetalhesSelect .= "url2, ";
        $strSqlModulosDetalhesSelect .= "url3, ";
        $strSqlModulosDetalhesSelect .= "url4, ";
        $strSqlModulosDetalhesSelect .= "url5, ";
        $strSqlModulosDetalhesSelect .= "informacao_complementar1, ";
        $strSqlModulosDetalhesSelect .= "informacao_complementar2, ";
        $strSqlModulosDetalhesSelect .= "informacao_complementar3, ";
        $strSqlModulosDetalhesSelect .= "informacao_complementar4, ";
        $strSqlModulosDetalhesSelect .= "informacao_complementar5, ";
        $strSqlModulosDetalhesSelect .= "informacao_complementar6, ";
        $strSqlModulosDetalhesSelect .= "informacao_complementar7, ";
        $strSqlModulosDetalhesSelect .= "informacao_complementar8, ";
        $strSqlModulosDetalhesSelect .= "informacao_complementar9, ";
        $strSqlModulosDetalhesSelect .= "informacao_complementar10, ";
        $strSqlModulosDetalhesSelect .= "informacao_complementar11, ";
        $strSqlModulosDetalhesSelect .= "informacao_complementar12, ";
        $strSqlModulosDetalhesSelect .= "informacao_complementar13, ";
        $strSqlModulosDetalhesSelect .= "informacao_complementar14, ";
        $strSqlModulosDetalhesSelect .= "informacao_complementar15, ";
        $strSqlModulosDetalhesSelect .= "informacao_complementar16, ";
        $strSqlModulosDetalhesSelect .= "informacao_complementar17, ";
        $strSqlModulosDetalhesSelect .= "informacao_complementar18, ";
        $strSqlModulosDetalhesSelect .= "informacao_complementar19, ";
        $strSqlModulosDetalhesSelect .= "informacao_complementar20, ";
        $strSqlModulosDetalhesSelect .= "informacao_complementar21, ";
        $strSqlModulosDetalhesSelect .= "informacao_complementar22, ";
        $strSqlModulosDetalhesSelect .= "informacao_complementar23, ";
        $strSqlModulosDetalhesSelect .= "informacao_complementar24, ";
        $strSqlModulosDetalhesSelect .= "informacao_complementar25, ";
        $strSqlModulosDetalhesSelect .= "informacao_complementar26, ";
        $strSqlModulosDetalhesSelect .= "informacao_complementar27, ";
        $strSqlModulosDetalhesSelect .= "informacao_complementar28, ";
        $strSqlModulosDetalhesSelect .= "informacao_complementar29, ";
        $strSqlModulosDetalhesSelect .= "informacao_complementar30, ";
        $strSqlModulosDetalhesSelect .= "informacao_complementar31, ";
        $strSqlModulosDetalhesSelect .= "informacao_complementar32, ";
        $strSqlModulosDetalhesSelect .= "informacao_complementar33, ";
        $strSqlModulosDetalhesSelect .= "informacao_complementar34, ";
        $strSqlModulosDetalhesSelect .= "informacao_complementar35, ";
        $strSqlModulosDetalhesSelect .= "informacao_complementar36, ";
        $strSqlModulosDetalhesSelect .= "informacao_complementar37, ";
        $strSqlModulosDetalhesSelect .= "informacao_complementar38, ";
        $strSqlModulosDetalhesSelect .= "informacao_complementar39, ";
        $strSqlModulosDetalhesSelect .= "informacao_complementar40, ";
        $strSqlModulosDetalhesSelect .= "informacao_complementar41, ";
        $strSqlModulosDetalhesSelect .= "informacao_complementar42, ";
        $strSqlModulosDetalhesSelect .= "informacao_complementar43, ";
        $strSqlModulosDetalhesSelect .= "informacao_complementar44, ";
        $strSqlModulosDetalhesSelect .= "informacao_complementar45, ";
        $strSqlModulosDetalhesSelect .= "informacao_complementar46, ";
        $strSqlModulosDetalhesSelect .= "informacao_complementar47, ";
        $strSqlModulosDetalhesSelect .= "informacao_complementar48, ";
        $strSqlModulosDetalhesSelect .= "informacao_complementar49, ";
        $strSqlModulosDetalhesSelect .= "informacao_complementar50, ";
        $strSqlModulosDetalhesSelect .= "informacao_complementar51, ";
        $strSqlModulosDetalhesSelect .= "informacao_complementar52, ";
        $strSqlModulosDetalhesSelect .= "informacao_complementar53, ";
        $strSqlModulosDetalhesSelect .= "informacao_complementar54, ";
        $strSqlModulosDetalhesSelect .= "informacao_complementar55, ";
        $strSqlModulosDetalhesSelect .= "informacao_complementar56, ";
        $strSqlModulosDetalhesSelect .= "informacao_complementar57, ";
        $strSqlModulosDetalhesSelect .= "informacao_complementar58, ";
        $strSqlModulosDetalhesSelect .= "informacao_complementar59, ";
        $strSqlModulosDetalhesSelect .= "informacao_complementar60, ";
        $strSqlModulosDetalhesSelect .= "carga_horaria, ";
        $strSqlModulosDetalhesSelect .= "duracao_aula, ";
        $strSqlModulosDetalhesSelect .= "ativacao, ";
        $strSqlModulosDetalhesSelect .= "ativacao1, ";
        $strSqlModulosDetalhesSelect .= "ativacao2, ";
        $strSqlModulosDetalhesSelect .= "ativacao3, ";
        $strSqlModulosDetalhesSelect .= "ativacao4, ";
        $strSqlModulosDetalhesSelect .= "anotacoes_internas, ";
        $strSqlModulosDetalhesSelect .= "n_visitas, ";
        $strSqlModulosDetalhesSelect .= "acesso_restrito ";
        $strSqlModulosDetalhesSelect .= "FROM tb_modulos ";
        $strSqlModulosDetalhesSelect .= "WHERE id <> 0 ";
        //$strSqlModulosDetalhesSelect .= "AND id_tb_categorias = :id_tb_categorias ";
        $strSqlModulosDetalhesSelect .= "AND id = :id ";
        //$strSqlModulosDetalhesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
        
        
        $statementModulosDetalhesSelect = $dbSistemaConPDO->prepare($strSqlModulosDetalhesSelect);
        
        if ($statementModulosDetalhesSelect !== false)
        {
            $statementModulosDetalhesSelect->execute(array(
                "id" => $idTbModulos
            ));
        }
        
        //$resultadoModulosDetalhes = $dbSistemaConPDO->query($strSqlModulosDetalhesSelect);
        
        $resultadoModulosDetalhes = $statementModulosDetalhesSelect->fetchAll();
        
        if (empty($resultadoModulosDetalhes))
        {
            //echo "Nenhum registro encontrado";
        }else{
            foreach($resultadoModulosDetalhes as $linhaModulosDetalhes)
            {
                //Definição das variáveis de detalhes.
                $tbModulosId = $linhaModulosDetalhes['id'];
                $tbModulosIdParent = $linhaModulosDetalhes['id_parent'];
                $tbModulosIdTbCadastroUsuario = $linhaModulosDetalhes['id_tb_cadastro_usuario'];
                
                $tbModulosIdTbCadastro1 = $linhaModulosDetalhes['id_tb_cadastro1'];
                $tbModulosIdTbCadastro2 = $linhaModulosDetalhes['id_tb_cadastro2'];
                $tbModulosIdTbCadastro3 = $linhaModulosDetalhes['id_tb_cadastro3'];
                $tbModulosIdTbCadastro4 = $linhaModulosDetalhes['id_tb_cadastro4'];
                $tbModulosIdTbCadastro5 = $linhaModulosDetalhes['id_tb_cadastro5'];
                
                $tbModulosNClassificacao = $linhaModulosDetalhes['n_classificacao'];
                
                $tbModulosDataCriacao = Funcoes::DataLeitura01($linhaModulosDetalhes['data_criacao'], $GLOBALS['configSistemaFormatoData'], "1");
                //$tbModulosDataAbertura = Funcoes::DataLeitura01($linhaModulosDetalhes['data_abertura'], $GLOBALS['configSistemaFormatoData'], "1");
                if($linhaModulosDetalhes['data_inicio'] == NULL)
                {
                    $tbModulosDataInicio = "";
                }else{
                    $tbModulosDataInicio = Funcoes::DataLeitura01($linhaModulosDetalhes['data_inicio'], $GLOBALS['configSistemaFormatoData'], "1");
                }
                
                if($linhaModulosDetalhes['data_final'] == NULL)
                {
                    $tbModulosDataFinal = "";
                }else{
                    $tbModulosDataFinal = Funcoes::DataLeitura01($linhaModulosDetalhes['data_final'], $GLOBALS['configSistemaFormatoData'], "1");
                }
        
                if($linhaModulosDetalhes['data1'] == NULL)
                {
                    $tbModulosData1 = "";
                }else{
                    $tbModulosData1 = Funcoes::DataLeitura01($linhaModulosDetalhes['data1'], $GLOBALS['configSistemaFormatoData'], "1");
                }
                if($linhaModulosDetalhes['data2'] == NULL)
                {
                    $tbModulosData2 = "";
                }else{
                    $tbModulosData2 = Funcoes::DataLeitura01($linhaModulosDetalhes['data2'], $GLOBALS['configSistemaFormatoData'], "1");
                }
                if($linhaModulosDetalhes['data3'] == NULL)
                {
                    $tbModulosData3 = "";
                }else{
                    $tbModulosData3 = Funcoes::DataLeitura01($linhaModulosDetalhes['data3'], $GLOBALS['configSistemaFormatoData'], "1");
                }
                if($linhaModulosDetalhes['data4'] == NULL)
                {
                    $tbModulosData4 = "";
                }else{
                    $tbModulosData4 = Funcoes::DataLeitura01($linhaModulosDetalhes['data4'], $GLOBALS['configSistemaFormatoData'], "1");
                }
                if($linhaModulosDetalhes['data5'] == NULL)
                {
                    $tbModulosData5 = "";
                }else{
                    $tbModulosData5 = Funcoes::DataLeitura01($linhaModulosDetalhes['data5'], $GLOBALS['configSistemaFormatoData'], "1");
                }
                if($linhaModulosDetalhes['data6'] == NULL)
                {
                    $tbModulosData6 = "";
                }else{
                    $tbModulosData6 = Funcoes::DataLeitura01($linhaModulosDetalhes['data6'], $GLOBALS['configSistemaFormatoData'], "1");
                }
                if($linhaModulosDetalhes['data7'] == NULL)
                {
                    $tbModulosData7 = "";
                }else{
                    $tbModulosData7 = Funcoes::DataLeitura01($linhaModulosDetalhes['data7'], $GLOBALS['configSistemaFormatoData'], "1");
                }
                if($linhaModulosDetalhes['data8'] == NULL)
                {
                    $tbModulosData8 = "";
                }else{
                    $tbModulosData8 = Funcoes::DataLeitura01($linhaModulosDetalhes['data8'], $GLOBALS['configSistemaFormatoData'], "1");
                }
                if($linhaModulosDetalhes['data9'] == NULL)
                {
                    $tbModulosData9 = "";
                }else{
                    $tbModulosData9 = Funcoes::DataLeitura01($linhaModulosDetalhes['data9'], $GLOBALS['configSistemaFormatoData'], "1");
                }
                if($linhaModulosDetalhes['data10'] == NULL)
                {
                    $tbModulosData10 = "";
                }else{
                    $tbModulosData10 = Funcoes::DataLeitura01($linhaModulosDetalhes['data10'], $GLOBALS['configSistemaFormatoData'], "1");
                }
        
                $tbModulosNomeModulo = Funcoes::ConteudoMascaraLeitura($linhaModulosDetalhes['nome_modulo']);
                $tbModulosDescricao = Funcoes::ConteudoMascaraLeitura($linhaModulosDetalhes['descricao']);
        
                $tbModulosIdTbModulosStatus = $linhaModulosDetalhes['id_tb_modulos_status'];
                $tbModulosPalavrasChave = Funcoes::ConteudoMascaraLeitura($linhaModulosDetalhes['palavras_chave']);
                
                $tbModulosValor = Funcoes::MascaraValorLer($linhaModulosDetalhes['valor'], $GLOBALS['configSistemaMoeda']);
                $tbModulosValor1 = Funcoes::MascaraValorLer($linhaModulosDetalhes['valor1'], $GLOBALS['configSistemaMoeda']);
                $tbModulosValor2 = Funcoes::MascaraValorLer($linhaModulosDetalhes['valor2'], $GLOBALS['configSistemaMoeda']);
                $tbModulosValor3 = Funcoes::MascaraValorLer($linhaModulosDetalhes['valor3'], $GLOBALS['configSistemaMoeda']);
                $tbModulosValor4 = Funcoes::MascaraValorLer($linhaModulosDetalhes['valor4'], $GLOBALS['configSistemaMoeda']);
                $tbModulosValor5 = Funcoes::MascaraValorLer($linhaModulosDetalhes['valor5'], $GLOBALS['configSistemaMoeda']);
                $tbModulosURL1 = $linhaModulosDetalhes['url1'];
                $tbModulosURL2 = $linhaModulosDetalhes['url2'];
                $tbModulosURL3 = $linhaModulosDetalhes['url3'];
                $tbModulosURL4 = $linhaModulosDetalhes['url4'];
                $tbModulosURL5 = $linhaModulosDetalhes['url5'];
        
                $tbModulosIC1 = Funcoes::ConteudoMascaraLeitura($linhaModulosDetalhes['informacao_complementar1']);
                $tbModulosIC2 = Funcoes::ConteudoMascaraLeitura($linhaModulosDetalhes['informacao_complementar2']);
                $tbModulosIC3 = Funcoes::ConteudoMascaraLeitura($linhaModulosDetalhes['informacao_complementar3']);
                $tbModulosIC4 = Funcoes::ConteudoMascaraLeitura($linhaModulosDetalhes['informacao_complementar4']);
                $tbModulosIC5 = Funcoes::ConteudoMascaraLeitura($linhaModulosDetalhes['informacao_complementar5']);
                $tbModulosIC6 = Funcoes::ConteudoMascaraLeitura($linhaModulosDetalhes['informacao_complementar6']);
                $tbModulosIC7 = Funcoes::ConteudoMascaraLeitura($linhaModulosDetalhes['informacao_complementar7']);
                $tbModulosIC8 = Funcoes::ConteudoMascaraLeitura($linhaModulosDetalhes['informacao_complementar8']);
                $tbModulosIC9 = Funcoes::ConteudoMascaraLeitura($linhaModulosDetalhes['informacao_complementar9']);
                $tbModulosIC10 = Funcoes::ConteudoMascaraLeitura($linhaModulosDetalhes['informacao_complementar10']);
                $tbModulosIC11 = Funcoes::ConteudoMascaraLeitura($linhaModulosDetalhes['informacao_complementar11']);
                $tbModulosIC12 = Funcoes::ConteudoMascaraLeitura($linhaModulosDetalhes['informacao_complementar12']);
                $tbModulosIC13 = Funcoes::ConteudoMascaraLeitura($linhaModulosDetalhes['informacao_complementar13']);
                $tbModulosIC14 = Funcoes::ConteudoMascaraLeitura($linhaModulosDetalhes['informacao_complementar14']);
                $tbModulosIC15 = Funcoes::ConteudoMascaraLeitura($linhaModulosDetalhes['informacao_complementar15']);
                $tbModulosIC16 = Funcoes::ConteudoMascaraLeitura($linhaModulosDetalhes['informacao_complementar16']);
                $tbModulosIC17 = Funcoes::ConteudoMascaraLeitura($linhaModulosDetalhes['informacao_complementar17']);
                $tbModulosIC18 = Funcoes::ConteudoMascaraLeitura($linhaModulosDetalhes['informacao_complementar18']);
                $tbModulosIC19 = Funcoes::ConteudoMascaraLeitura($linhaModulosDetalhes['informacao_complementar19']);
                $tbModulosIC20 = Funcoes::ConteudoMascaraLeitura($linhaModulosDetalhes['informacao_complementar20']);
                $tbModulosIC21 = Funcoes::ConteudoMascaraLeitura($linhaModulosDetalhes['informacao_complementar21']);
                $tbModulosIC22 = Funcoes::ConteudoMascaraLeitura($linhaModulosDetalhes['informacao_complementar22']);
                $tbModulosIC23 = Funcoes::ConteudoMascaraLeitura($linhaModulosDetalhes['informacao_complementar23']);
                $tbModulosIC24 = Funcoes::ConteudoMascaraLeitura($linhaModulosDetalhes['informacao_complementar24']);
                $tbModulosIC25 = Funcoes::ConteudoMascaraLeitura($linhaModulosDetalhes['informacao_complementar25']);
                $tbModulosIC26 = Funcoes::ConteudoMascaraLeitura($linhaModulosDetalhes['informacao_complementar26']);
                $tbModulosIC27 = Funcoes::ConteudoMascaraLeitura($linhaModulosDetalhes['informacao_complementar27']);
                $tbModulosIC28 = Funcoes::ConteudoMascaraLeitura($linhaModulosDetalhes['informacao_complementar28']);
                $tbModulosIC29 = Funcoes::ConteudoMascaraLeitura($linhaModulosDetalhes['informacao_complementar29']);
                $tbModulosIC30 = Funcoes::ConteudoMascaraLeitura($linhaModulosDetalhes['informacao_complementar30']);
                $tbModulosIC31 = Funcoes::ConteudoMascaraLeitura($linhaModulosDetalhes['informacao_complementar31']);
                $tbModulosIC32 = Funcoes::ConteudoMascaraLeitura($linhaModulosDetalhes['informacao_complementar32']);
                $tbModulosIC33 = Funcoes::ConteudoMascaraLeitura($linhaModulosDetalhes['informacao_complementar33']);
                $tbModulosIC34 = Funcoes::ConteudoMascaraLeitura($linhaModulosDetalhes['informacao_complementar34']);
                $tbModulosIC35 = Funcoes::ConteudoMascaraLeitura($linhaModulosDetalhes['informacao_complementar35']);
                $tbModulosIC36 = Funcoes::ConteudoMascaraLeitura($linhaModulosDetalhes['informacao_complementar36']);
                $tbModulosIC37 = Funcoes::ConteudoMascaraLeitura($linhaModulosDetalhes['informacao_complementar37']);
                $tbModulosIC38 = Funcoes::ConteudoMascaraLeitura($linhaModulosDetalhes['informacao_complementar38']);
                $tbModulosIC39 = Funcoes::ConteudoMascaraLeitura($linhaModulosDetalhes['informacao_complementar39']);
                $tbModulosIC40 = Funcoes::ConteudoMascaraLeitura($linhaModulosDetalhes['informacao_complementar40']);
                $tbModulosIC41 = Funcoes::ConteudoMascaraLeitura($linhaModulosDetalhes['informacao_complementar41']);
                $tbModulosIC42 = Funcoes::ConteudoMascaraLeitura($linhaModulosDetalhes['informacao_complementar42']);
        
                $tbModulosIC43 = Funcoes::ConteudoMascaraLeitura($linhaModulosDetalhes['informacao_complementar43']);
                $tbModulosIC44 = Funcoes::ConteudoMascaraLeitura($linhaModulosDetalhes['informacao_complementar44']);
                $tbModulosIC45 = Funcoes::ConteudoMascaraLeitura($linhaModulosDetalhes['informacao_complementar45']);
                $tbModulosIC46 = Funcoes::ConteudoMascaraLeitura($linhaModulosDetalhes['informacao_complementar46']);
                $tbModulosIC47 = Funcoes::ConteudoMascaraLeitura($linhaModulosDetalhes['informacao_complementar47']);
                $tbModulosIC48 = Funcoes::ConteudoMascaraLeitura($linhaModulosDetalhes['informacao_complementar48']);
                $tbModulosIC49 = Funcoes::ConteudoMascaraLeitura($linhaModulosDetalhes['informacao_complementar49']);
                $tbModulosIC50 = Funcoes::ConteudoMascaraLeitura($linhaModulosDetalhes['informacao_complementar50']);
                $tbModulosIC51 = Funcoes::ConteudoMascaraLeitura($linhaModulosDetalhes['informacao_complementar51']);
                $tbModulosIC52 = Funcoes::ConteudoMascaraLeitura($linhaModulosDetalhes['informacao_complementar52']);
                $tbModulosIC53 = Funcoes::ConteudoMascaraLeitura($linhaModulosDetalhes['informacao_complementar53']);
                $tbModulosIC54 = Funcoes::ConteudoMascaraLeitura($linhaModulosDetalhes['informacao_complementar54']);
                $tbModulosIC55 = Funcoes::ConteudoMascaraLeitura($linhaModulosDetalhes['informacao_complementar55']);
                $tbModulosIC56 = Funcoes::ConteudoMascaraLeitura($linhaModulosDetalhes['informacao_complementar56']);
                $tbModulosIC57 = Funcoes::ConteudoMascaraLeitura($linhaModulosDetalhes['informacao_complementar57']);
                $tbModulosIC58 = Funcoes::ConteudoMascaraLeitura($linhaModulosDetalhes['informacao_complementar58']);
                $tbModulosIC59 = Funcoes::ConteudoMascaraLeitura($linhaModulosDetalhes['informacao_complementar59']);
                $tbModulosIC60 = Funcoes::ConteudoMascaraLeitura($linhaModulosDetalhes['informacao_complementar60']);
                
                $tbModulosCargaHoraria = $linhaModulosDetalhes['carga_horaria'];
                $tbModulosDuracaoAula = $linhaModulosDetalhes['duracao_aula'];
        
                $tbModulosAtivacao = $linhaModulosDetalhes['ativacao'];
                $tbModulosAtivacao1 = $linhaModulosDetalhes['ativacao1'];
                $tbModulosAtivacao2 = $linhaModulosDetalhes['ativacao2'];
                $tbModulosAtivacao3 = $linhaModulosDetalhes['ativacao3'];
                $tbModulosAtivacao4 = $linhaModulosDetalhes['ativacao4'];
                
                $tbModulosAnotacoesInternas = Funcoes::ConteudoMascaraLeitura($linhaModulosDetalhes['anotacoes_internas']);
                $tbModulosNVisitas = $linhaModulosDetalhes['n_visitas'];
                $tbModulosAcessoRestrito = $linhaModulosDetalhes['acesso_restrito'];
                
                //Verificação de erro.
                //echo "tbModulosId=" . $tbModulosId . "<br>";
                //echo "tbModulosProcesso=" . $tbModulosProcesso . "<br>";
                //echo "tbModulosIC60=" . $tbModulosIC60 . "<br>";
            }
        }
        ?>
        <?php if(!empty($resultadoModulosDetalhes)){?>
            <div class="AdmTexto01" style="position: relative; display: block;">
                <div style="position: relative; display: block;">
                    <span style="font-weight: bold;">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteModulosNome"); ?>:
                    </span>
                    <?php echo $tbModulosNomeModulo; ?> 
                </div>
                
                <?php if($GLOBALS['habilitarModulosFiltroGenerico01'] == 1){ ?>
                    <div style="position: relative; display: block;">
                        <span style="font-weight: bold;">
                            <?php echo htmlentities($GLOBALS['configModulosFiltroGenerico01Nome']); ?>: 
                        </span>
                        <?php 
                        $arrModulosFiltroGenerico01Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbModulosId, "tb_modulos_relacao_complemento", "id_tb_modulos", "id_tb_modulos_complemento", "12", "", ",", "", "1"));
                        $arrModulosFiltroGenerico01 = DbFuncoes::FiltrosGenericosFill01("tb_modulos_complemento", 12);
                        $tbModulosFiltroGenerico01_print = "";
                        ?>
                        <?php 
                        for($countArray = 0; $countArray < count($arrModulosFiltroGenerico01); $countArray++)
                        {
                        ?>
                            <div>
                                <?php if(in_array($arrModulosFiltroGenerico01[$countArray][0], $arrModulosFiltroGenerico01Selecao)){ ?> 
                                    - <?php echo $arrModulosFiltroGenerico01[$countArray][1];?>
                                    <?php //Armazenamento dos valores em variável. ?>
                                    <?php
                                    $tbModulosFiltroGenerico01_print = $tbModulosFiltroGenerico01_print . $arrModulosFiltroGenerico01[$countArray][1] . ", ";
                                    ?>
                                <?php } ?>
                            </div>
                        <?php 
                        }
                        ?>
                        
                        <?php 
                        //Tratamento de dados (retirada do espaço e vírgula no fina do texto).
                        if($tbModulosFiltroGenerico01_print <> "")
                        {
                            $tbModulosFiltroGenerico01_print = substr($tbModulosFiltroGenerico01_print, 0, strlen($tbModulosFiltroGenerico01_print) - 2);
                        }
                        
                        echo Funcoes::IdsFormatar01($tbModulosFiltroGenerico01_print); 
                        ?>
                    </div>
                <?php } ?>
            </div>
		<?php } ?>
		<?php
        //Limpeza de objetos.
        //----------
        unset($strSqlModulosDetalhesSelect);
        unset($statementModulosDetalhesSelect);
        unset($resultadoModulosDetalhes);
        unset($linhaModulosDetalhes);
        //----------
        ?>
    <?php } ?>
    <?php //**************************************************************************************?>
    
    
	<?php //Informações - Aulas.?>
    <?php //**************************************************************************************?>
    <?php
	//$idTbModulos = DbFuncoes::GetCampoGenerico01($idTbTurmas, "tb_modulos", "id_parent");
	$idParentAulas = $idTbModulos;
	?>
    <?php if($idTbModulos <> ""){ ?>
		<?php
        //Query de pesquisa.
        //----------
        $strSqlAulasSelect = "";
        $strSqlAulasSelect .= "SELECT ";
        //$strSqlAulasSelect .= "* ";
        $strSqlAulasSelect .= "id, ";
        $strSqlAulasSelect .= "id_parent, ";
        $strSqlAulasSelect .= "id_tb_cadastro_usuario, ";
        $strSqlAulasSelect .= "id_tb_cadastro1, ";
        $strSqlAulasSelect .= "id_tb_cadastro2, ";
        $strSqlAulasSelect .= "id_tb_cadastro3, ";
        $strSqlAulasSelect .= "id_tb_cadastro4, ";
        $strSqlAulasSelect .= "id_tb_cadastro5, ";
        $strSqlAulasSelect .= "n_classificacao, ";
        $strSqlAulasSelect .= "data_criacao, ";
        $strSqlAulasSelect .= "data_aula, ";
        $strSqlAulasSelect .= "data1, ";
        $strSqlAulasSelect .= "data2, ";
        $strSqlAulasSelect .= "data3, ";
        $strSqlAulasSelect .= "data4, ";
        $strSqlAulasSelect .= "data5, ";
        $strSqlAulasSelect .= "data6, ";
        $strSqlAulasSelect .= "data7, ";
        $strSqlAulasSelect .= "data8, ";
        $strSqlAulasSelect .= "data9, ";
        $strSqlAulasSelect .= "data10, ";
        $strSqlAulasSelect .= "tema, ";
        $strSqlAulasSelect .= "descricao, ";
        $strSqlAulasSelect .= "local, ";
        $strSqlAulasSelect .= "id_tb_aulas_status, ";
        $strSqlAulasSelect .= "palavras_chave, ";
        $strSqlAulasSelect .= "valor, ";
        $strSqlAulasSelect .= "valor1, ";
        $strSqlAulasSelect .= "valor2, ";
        $strSqlAulasSelect .= "valor3, ";
        $strSqlAulasSelect .= "valor4, ";
        $strSqlAulasSelect .= "valor5, ";
        $strSqlAulasSelect .= "url1, ";
        $strSqlAulasSelect .= "url2, ";
        $strSqlAulasSelect .= "url3, ";
        $strSqlAulasSelect .= "url4, ";
        $strSqlAulasSelect .= "url5, ";
        $strSqlAulasSelect .= "informacao_complementar1, ";
        $strSqlAulasSelect .= "informacao_complementar2, ";
        $strSqlAulasSelect .= "informacao_complementar3, ";
        $strSqlAulasSelect .= "informacao_complementar4, ";
        $strSqlAulasSelect .= "informacao_complementar5, ";
        $strSqlAulasSelect .= "informacao_complementar6, ";
        $strSqlAulasSelect .= "informacao_complementar7, ";
        $strSqlAulasSelect .= "informacao_complementar8, ";
        $strSqlAulasSelect .= "informacao_complementar9, ";
        $strSqlAulasSelect .= "informacao_complementar10, ";
        
        $strSqlAulasSelect .= "informacao_complementar11, ";
        $strSqlAulasSelect .= "informacao_complementar12, ";
        $strSqlAulasSelect .= "informacao_complementar13, ";
        $strSqlAulasSelect .= "informacao_complementar14, ";
        $strSqlAulasSelect .= "informacao_complementar15, ";
        $strSqlAulasSelect .= "informacao_complementar16, ";
        $strSqlAulasSelect .= "informacao_complementar17, ";
        $strSqlAulasSelect .= "informacao_complementar18, ";
        $strSqlAulasSelect .= "informacao_complementar19, ";
        $strSqlAulasSelect .= "informacao_complementar20, ";
        $strSqlAulasSelect .= "informacao_complementar21, ";
        $strSqlAulasSelect .= "informacao_complementar22, ";
        $strSqlAulasSelect .= "informacao_complementar23, ";
        $strSqlAulasSelect .= "informacao_complementar24, ";
        $strSqlAulasSelect .= "informacao_complementar25, ";
        $strSqlAulasSelect .= "informacao_complementar26, ";
        $strSqlAulasSelect .= "informacao_complementar27, ";
        $strSqlAulasSelect .= "informacao_complementar28, ";
        $strSqlAulasSelect .= "informacao_complementar29, ";
        $strSqlAulasSelect .= "informacao_complementar30, ";
        $strSqlAulasSelect .= "informacao_complementar31, ";
        $strSqlAulasSelect .= "informacao_complementar32, ";
        $strSqlAulasSelect .= "informacao_complementar33, ";
        $strSqlAulasSelect .= "informacao_complementar34, ";
        $strSqlAulasSelect .= "informacao_complementar35, ";
        $strSqlAulasSelect .= "informacao_complementar36, ";
        $strSqlAulasSelect .= "informacao_complementar37, ";
        $strSqlAulasSelect .= "informacao_complementar38, ";
        $strSqlAulasSelect .= "informacao_complementar39, ";
        $strSqlAulasSelect .= "informacao_complementar40, ";
        $strSqlAulasSelect .= "informacao_complementar41, ";
        $strSqlAulasSelect .= "informacao_complementar42, ";
        $strSqlAulasSelect .= "informacao_complementar43, ";
        $strSqlAulasSelect .= "informacao_complementar44, ";
        $strSqlAulasSelect .= "informacao_complementar45, ";
        $strSqlAulasSelect .= "informacao_complementar46, ";
        $strSqlAulasSelect .= "informacao_complementar47, ";
        $strSqlAulasSelect .= "informacao_complementar48, ";
        $strSqlAulasSelect .= "informacao_complementar49, ";
        $strSqlAulasSelect .= "informacao_complementar50, ";
        $strSqlAulasSelect .= "informacao_complementar51, ";
        $strSqlAulasSelect .= "informacao_complementar52, ";
        $strSqlAulasSelect .= "informacao_complementar53, ";
        $strSqlAulasSelect .= "informacao_complementar54, ";
        $strSqlAulasSelect .= "informacao_complementar55, ";
        $strSqlAulasSelect .= "informacao_complementar56, ";
        $strSqlAulasSelect .= "informacao_complementar57, ";
        $strSqlAulasSelect .= "informacao_complementar58, ";
        $strSqlAulasSelect .= "informacao_complementar59, ";
        $strSqlAulasSelect .= "informacao_complementar60, ";
        $strSqlAulasSelect .= "carga_horaria, ";
        $strSqlAulasSelect .= "ativacao, ";
        $strSqlAulasSelect .= "ativacao1, ";
        $strSqlAulasSelect .= "ativacao2, ";
        $strSqlAulasSelect .= "ativacao3, ";
        $strSqlAulasSelect .= "ativacao4, ";
        $strSqlAulasSelect .= "reposicao, ";
        $strSqlAulasSelect .= "anotacoes_internas, ";
        $strSqlAulasSelect .= "n_visitas, ";
        $strSqlAulasSelect .= "acesso_restrito ";
        
        $strSqlAulasSelect .= "FROM tb_aulas ";
        $strSqlAulasSelect .= "WHERE id <> 0 ";
        if($idParentAulas <> "")
        {
            $strSqlAulasSelect .= "AND id_parent = :id_parent ";
        }
		if($dataAulaMes <> "")
		{
			//$strSqlAulasSelect .= "AND MONTH(data_aula) = " . Funcoes::ConteudoMascaraGravacao01($dataAulaMes) . " ";
			$strSqlAulasSelect .= "AND MONTH(data_aula) = :dataAulaMes ";
		}
		if($dataAulaAno <> "")
		{
			//$strSqlAulasSelect .= "AND YEAR(data_aula) = " . Funcoes::ConteudoMascaraGravacao01($dataAulaAno) . " ";
			$strSqlAulasSelect .= "AND YEAR(data_aula) = :dataAulaAno ";
		}
        $strSqlAulasSelect .= "ORDER BY " . $GLOBALS['configClassificacaoAulas'] . " ";
        //----------
    
    
        //Componentes e parâmetros.
        //----------
        $statementAulasSelect = $dbSistemaConPDO->prepare($strSqlAulasSelect);
        
        if ($statementAulasSelect !== false)
        {
			if($idParentAulas <> "")
			{
				$statementAulasSelect->bindParam(':id_parent', $idParentAulas, PDO::PARAM_STR);
			}
			if($dataAulaMes <> "")
			{
				$statementAulasSelect->bindParam(':dataAulaMes', $dataAulaMes, PDO::PARAM_STR);
			}
			if($dataAulaAno <> "")
			{
				$statementAulasSelect->bindParam(':dataAulaAno', $dataAulaAno, PDO::PARAM_STR);
			}
			$statementAulasSelect->execute();
			
			/*
			$statementAulasSelect->execute(array(
				"id_parent" => $idParentAulas
			));
			*/
        }
        
        //$resultadoAulas = $dbSistemaConPDO->query($strSqlAulasSelect);
        $resultadoAulas = $statementAulasSelect->fetchAll();
        //----------
        ?>
    
    	<?php if(!empty($resultadoAulas)){?>
        <div class="AdmTexto01" style="position: relative; display: block;">
			<?php
            $arrAulasStatus = DbFuncoes::FiltrosGenericosFill01("tb_aulas_complemento", 1);
            
            //Loop pelos resultados.
            foreach($resultadoAulas as $linhaAulas)
            {
            ?>
            <div style="position: relative; display: block;">
                <div style="position: relative; display: block;">
                    <span style="font-weight: bold;">
                        id: 
                    </span>
                    <?php echo $linhaAulas['id'];?>
                </div>
                <div style="position: relative; display: block;">
                    <span style="font-weight: bold;">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAulasTema"); ?>: 
                    </span>
                    <?php echo Funcoes::ConteudoMascaraLeitura($linhaAulas['tema']);?>
                </div>
            </div>
            <?php } ?>
        </div>
		<?php } ?>
		<?php
        //Limpeza de objetos.
        //----------
        unset($strSqlAulasSelect);
        unset($statementAulasSelect);
        unset($resultadoAulas);
        unset($linhaAulas);
        //----------
        ?>
	<?php } ?>
    <?php //**************************************************************************************?>
    
    
	<?php //Informações - Página.?>
    <?php //**************************************************************************************?>
    <?php
	//Seleção.
	/*
	$itensRelacaoRegistrosSelect26 = DbFuncoes::GetCampoGenerico06("tb_itens_relacao_registros", 
	"id_registro", 
	"id_item", 
	$idItem, 
	"", 
	"", 
	1, 
	"", 
	"", 
	"tipo_categoria", 
	"26", 
	"", 
	"");
	*/
	

	//$idParentPaginas = $idTbModulos;
	$idParentPaginas = 3660;
	$idsTbPaginas = DbFuncoes::GetCampoGenerico06("tb_itens_relacao_registros", 
	"id_registro", 
	"id_item", 
	$idTbModulos, 
	"", 
	"", 
	1, 
	"", 
	"", 
	"tipo_categoria", 
	"26", 
	"", 
	"");
	
		
	
	//Verificação de erro - debug.
	//echo "idsTbPaginas=" . $idsTbPaginas . ""
	?>
    <?php if($idsTbPaginas <> ""){ ?>
		<?php
        //Query de pesquisa.
        //----------
        $strSqlPaginasSelect = "";
        $strSqlPaginasSelect .= "SELECT ";
        //$strSqlPaginasSelect .= "* ";
        $strSqlPaginasSelect .= "id, ";
        $strSqlPaginasSelect .= "id_parent, ";
        $strSqlPaginasSelect .= "id_tb_cadastro1, ";
        $strSqlPaginasSelect .= "id_tb_cadastro2, ";
        $strSqlPaginasSelect .= "id_tb_cadastro3, ";
        $strSqlPaginasSelect .= "n_classificacao, ";
        $strSqlPaginasSelect .= "data_criacao, ";
        $strSqlPaginasSelect .= "titulo, ";
        $strSqlPaginasSelect .= "descricao, ";
        $strSqlPaginasSelect .= "palavras_chave, ";
        $strSqlPaginasSelect .= "url1, ";
        $strSqlPaginasSelect .= "url2, ";
        $strSqlPaginasSelect .= "url3, ";
        $strSqlPaginasSelect .= "url4, ";
        $strSqlPaginasSelect .= "url5, ";
        $strSqlPaginasSelect .= "imagem, ";
        $strSqlPaginasSelect .= "arquivo1, ";
        $strSqlPaginasSelect .= "arquivo2, ";
        $strSqlPaginasSelect .= "arquivo3, ";
        $strSqlPaginasSelect .= "arquivo4, ";
        $strSqlPaginasSelect .= "arquivo5, ";
        
        $strSqlPaginasSelect .= "informacao_complementar1, ";
        $strSqlPaginasSelect .= "informacao_complementar2, ";
        $strSqlPaginasSelect .= "informacao_complementar3, ";
        $strSqlPaginasSelect .= "informacao_complementar4, ";
        $strSqlPaginasSelect .= "informacao_complementar5, ";
        $strSqlPaginasSelect .= "informacao_complementar6, ";
        $strSqlPaginasSelect .= "informacao_complementar7, ";
        $strSqlPaginasSelect .= "informacao_complementar8, ";
        $strSqlPaginasSelect .= "informacao_complementar9, ";
        $strSqlPaginasSelect .= "informacao_complementar10, ";
        $strSqlPaginasSelect .= "informacao_complementar11, ";
        $strSqlPaginasSelect .= "informacao_complementar12, ";
        $strSqlPaginasSelect .= "informacao_complementar13, ";
        $strSqlPaginasSelect .= "informacao_complementar14, ";
        $strSqlPaginasSelect .= "informacao_complementar15, ";
        
        $strSqlPaginasSelect .= "ativacao, ";
        $strSqlPaginasSelect .= "ativacao1, ";
        $strSqlPaginasSelect .= "ativacao2, ";
        $strSqlPaginasSelect .= "ativacao3, ";
        $strSqlPaginasSelect .= "ativacao4, ";
        
        $strSqlPaginasSelect .= "n_visitas, ";
        $strSqlPaginasSelect .= "acesso_restrito ";
        
        $strSqlPaginasSelect .= "FROM tb_paginas ";
        $strSqlPaginasSelect .= "WHERE id <> 0 ";
        if($idParentPaginas <> "")
        {
            $strSqlPaginasSelect .= "AND id_parent = :id_parent ";
        }
        if($idsTbPaginas <> "")
        {
            $strSqlPaginasSelect .= "AND id IN (". Funcoes::ConteudoMascaraGravacao01($idsTbPaginas) .") ";
        }
        $strSqlPaginasSelect .= "ORDER BY " . $GLOBALS['configClassificacaoPaginas'] . " ";
        //----------
        
        
        //Componentes e parâmetros.
        //----------
        $statementPaginasSelect = $dbSistemaConPDO->prepare($strSqlPaginasSelect);
        
        if ($statementPaginasSelect !== false)
        {
            $statementPaginasSelect->execute(array(
                "id_parent" => $idParentPaginas
            ));
        }
        
        //$resultadoPaginas = $dbSistemaConPDO->query($strSqlPaginasSelect);
        $resultadoPaginas = $statementPaginasSelect->fetchAll();
        //----------
        
        ?>
        <?php if(!empty($resultadoPaginas)){?>
            <div class="AdmTexto01" style="position: relative; display: block;">
				<?php
                //Loop pelos resultados.
                foreach($resultadoPaginas as $linhaPaginas)
                {
                ?>
                    <div style="position: relative; display: block;">
                        <span style="font-weight: bold;">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPagina"); ?>: 
                        </span>
                        <?php echo Funcoes::ConteudoMascaraLeitura($linhaPaginas['titulo']);?>
                    </div>
					<?php //Imagem.?>
                    <?php if(!empty($linhaPaginas['imagem'])){ ?>
                    <div style="position: relative; display: block;">
                        <img src="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>r<?php echo $linhaPaginas['imagem'];?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaPaginas['titulo']); ?>" />
                    </div>
                    <?php } ?>
                <?php } ?>
            </div>
        <?php } ?>
        
        <?php
        //Limpeza de objetos.
        //----------
        unset($strSqlPaginasSelect);
        unset($statementPaginasSelect);
        unset($resultadoPaginas);
        unset($linhaPaginas);
        //----------
        ?>
	<?php } ?>
    <?php //**************************************************************************************?>
<?php 
$pageSite->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php
//Inclusão do template do layout.
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>